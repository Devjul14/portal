<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    function pencarian(){
        var cari_no = $("[name='cari_no']").val();
        var cari_noreg = $("[name='cari_noreg']").val();
        var cari_nama = $("[name='cari_nama']").val();
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no,cari_nama:cari_nama,cari_noreg:cari_noreg},
            url   : "<?php echo site_url('apotek_farmasi/getcaripasien_inap');?>",
            success : function(result){
                window.location = "<?php echo site_url('apotek_farmasi/list_inap');?>";
            },
            error: function(result){
                alert(result);
            }
        });
    }

    $(document).ready(function(e){
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".laporan_harian").click(function(){
            var igd = "<?php echo $igd;?>";
            var url = "<?php echo site_url('apotek_farmasi/laporanharian_inap');?>";
            window.location = url;
            return false; 
        });
        $(".search").click(function(){
            var kode_kelas = $("[name='kode_kelas']").val();
            var kode_ruangan = $("[name='kode_ruangan']").val();
            var kelas = $("[name='kelas']").val();
            var ruangan = $("[name='ruangan']").val();
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var arrayData = {kode_kelas: kode_kelas, kelas: kelas,kode_ruangan: kode_ruangan,ruangan: ruangan,tgl1: tgl1,tgl2: tgl2};
            $.ajax({
                url: "<?php echo site_url('pendaftaran/search_inap');?>", 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                }
            });
        });
        $.each($(".tanggal_terimaapotek"), function(key,value){
            var no_reg = $(this).attr("no_reg");
            $.ajax({
                url: "<?php echo site_url('apotek_farmasi/cekstatus/tanggal_terimaapotek/');?>/"+no_reg, 
                type: 'POST', 
                success: function(e){
                    if (e=="0"){
                        $(".tanggal_terimaapotek_"+no_reg).append("<i class='fa fa-edit text-blue'></i>");
                    } else {
                        $(".tanggal_terimaapotek_"+no_reg).append("");
                    }
                }
            });
        });
        $.each($(".tanggal_obatapotek"), function(key,value){
            var no_reg = $(this).attr("no_reg");
            $.ajax({
                url: "<?php echo site_url('apotek_farmasi/cekstatus/tanggal_obatapotek/');?>/"+no_reg, 
                type: 'POST', 
                success: function(e){
                    if (e=="0"){
                        $(".tanggal_obatapotek_"+no_reg).append("<i class='fa fa-edit text-green'></i>");
                    } else {
                        $(".tanggal_obatapotek_"+no_reg).append("");
                    }
                }
            });
        });
        $.each($(".tanggal_printobat"), function(key,value){
            var no_reg = $(this).attr("no_reg");
            $.ajax({
                url: "<?php echo site_url('apotek_farmasi/cekstatus/tanggal_printobat/');?>/"+no_reg, 
                type: 'POST', 
                success: function(e){
                    if (e=="0"){
                        $(".tanggal_printobat_"+no_reg).append("<i class='fa fa-print text-blue'></i>");
                    } else {
                        $(".tanggal_printobat_"+no_reg).append("");
                    }
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        // $(".add").click(function(){
        //     window.location = "<?php echo site_url('pendaftaran/addpasienbaru/y/y')?>";
        //     return false;
        // });
        $(".pdf").click(function(){
            var id = $(".bg-gray").attr("href"); 
            var url = "<?php echo site_url('apotek_farmasi/formuploadpdf');?>/inap/"+id;
            window.location = url;
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/editinap')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".datapasien").click(function(){
            window.location = "<?php echo site_url('pendaftaran')?>";
            return false;
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('pendaftaran/hapuspasien')?>/"+id;
            return false;
        });
        $(".view").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('apotek_farmasi/viewapotek_inap');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".cari_no").click(function(){
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $(".cari_nama").click(function(){
            $(".modal_cari_nama").modal("show");
            $("[name='cari_nama']").focus();
            return false;
        });
        $(".cari_noreg").click(function(){
            $(".modal_cari_noreg").modal("show");
            $("[name='cari_noreg']").focus();
            return false;
        });
        $("[name='cari_nama']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $("[name='cari_no']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $("[name='cari_noreg']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function(){
            pencarian();
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('apotek_farmasi/reset_inap');?>/";
            // location.reload();
            return false;
        });
         $(".cetak").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakinap');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
        });
        $(".ruangan").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihruangan1');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".kelas").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihkelas');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".viewterima").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('apotek_farmasi/viewterimaapotek_inap');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".terima").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('apotek_farmasi/terima_inap')?>/"+id;
            return false;
        });
        $(".obat").click(function(){
            var id = $(".bg-gray").attr("href");
            var phone       = $(".bg-gray").attr("telpon");
            var jenis = "inap";
            if (phone==""){
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                text += "Untuk *Tanda tangan* bukti pengambilan obat klik link dibawah ini%0A";
                text += "http://rsciremai.ddns.net/rsciremai/surat/ttdobat/"+no_pasien+"/"+jenis;
                var url = "https://api.whatsapp.com/send?phone="+phone+"&text="+text;
                openCenteredWindow(url);
                window.location = "<?php echo site_url('apotek_farmasi/obat_inap')?>/"+id;
                return false;
            }
        });
        $(".respond").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('apotek_farmasi/respond_inap')?>/"+id;
            openCenteredWindow(url);
        });
    });
    $(document).keyup(function(e){
        if (e.keyCode==82 && e.altKey){
            $(".reset").click();
        }
    })
</script>
<div class="col-xs-12">
    <?php
        if($this->session->flashdata('message')){
            $pesan=explode('-', $this->session->flashdata('message'));
            echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>".$pesan[1]."</b>
            </div>";
        }

    ?>
                
    <div class="box box-primary">
        <div class="box-body">
           

            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10%" class='text-center'>Nomor RM</th>
                        <th width="5%" class='text-center'>Nomor REG</th>
                        <th class="text-center">Nama</th>
                        <!-- <th width ="20%" class='text-center'>Alamat</th> -->
                        <th class='text-center'>Ruangan</th>
                        <th class='text-center'>Kelas</th>
                        <th class='text-center'>Kamar</th>
                        <th class='text-center'>No. Bed</th>
                        <th class='text-center'>Golongan Pasien</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($q3->result() as $row){
                        // $icon_terima = ($row->tanggal_terimaapotek==="0000-00-00 00:00:00" ? "<i class='fa fa-edit text-blue'></i>" : "");
                        // $icon_obat = ($row->tanggal_obatapotek==="0000-00-00 00:00:00" ? "<i class='fa fa-edit text-green'></i>" : "");
                        // $icon_printobat = ($row->tanggal_printobat==="0000-00-00 00:00:00" ? "<i class='fa fa-print text-green'></i>" : "");
                        $icon_terima = "<span class='tanggal_terimaapotek tanggal_terimaapotek_".$row->no_reg."' no_reg='".$row->no_reg."'></span>";
                        $icon_obat = "<span class='tanggal_obatapotek tanggal_obatapotek_".$row->no_reg."' no_reg='".$row->no_reg."'></span>";
                        $icon_printobat = "<span class='tanggal_printobat tanggal_printobat_".$row->no_reg."' no_reg='".$row->no_reg."'></span>";
                        echo "<tr id=data href='".$row->no_rm."/".$row->no_reg."' telpon='".$row->telpon."'>";
                        echo "<td class='text-center'>".$icon_obat." ".$icon_printobat." ".$icon_terima." ".$row->no_rm."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        // echo "<td>".$row->alamat."</td>";
                        echo "<td>".$row->nama_ruangan."</td>";
                        echo "<td>".$row->nama_kelas."</td>";
                        echo "<td>".$row->kode_kamar."</td>";
                        echo "<td>".$row->no_bed."</td>";
                        echo "<td>".$row->gol_pasien."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
         
        </div>
        <div class="box-footer"> 
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" name="ruangan" class="form-control" readonly value="<?php echo $this->session->userdata('ruangan');?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_ruangan" class="form-control" readonly value="<?php echo $this->session->userdata('kode_ruangan');?>">
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="ruangan btn btn-primary" type='button'>...</button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>

                    
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                            <input type="text" class="form-control" name="tgl1" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                            <input type="text" class="form-control" name="tgl2" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off"/>   
                    </div>
					<div class="col-md-1">
                        <div class="pull-left">
		                     <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <label class="col-md-1 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="text" name="kelas" class="form-control" readonly value="<?php echo $this->session->userdata('kelas');?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_kelas" class="form-control" readonly value="<?php echo $this->session->userdata('kode_kelas');?>">
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="kelas btn btn-primary" type='button'>...</button>
                        </div>
                    </div>
                    
                </div>

            </div>   
            <div class="pull-left">
                <div class="btn-group">
                    <button class="reset btn btn-warning"> Reset</button>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <button class="cari_no btn btn-info" type="button"> Cari</button>
                    <button class="laporan_harian btn btn-success" type="button"> Laporan Harian</button>
                    <button class="pdf btn bg-maroon" type="button"> PDF</button>
                    <button class="respond btn btn-success" type="button"><i class="fa fa-edit"></i> Respond Time</button>
                    <button class="obat btn btn-primary" type="button"><i class="fa fa-edit"></i> Obat</button>
                    <button class="viewterima btn btn-warning" type="button"><i class="fa fa-edit"></i> Terima</button>
                    <button class="view btn btn-info" type="button"><i class="fa fa-edit"></i> View Apotek</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_no no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No. RM</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ No. RM/ No. Reg/ No. BPJS/ No. SEP"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_no btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_nama no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_nama"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_nama btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_noreg no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No Reg</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_noreg"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_noreg btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>