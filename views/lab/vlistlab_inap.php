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
            url   : "<?php echo site_url('lab/getcaripasien_inap');?>",
            success : function(result){
                window.location = "<?php echo site_url('lab/inap');?>";
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
            if ($(this).hasClass("bg-gray")){
                $(this).removeClass("bg-gray");
            } else {
                $(this).addClass("bg-gray");
            }
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
                url: "<?php echo site_url('lab/search_labinap');?>", 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                }
            });
        });
        $('.cetak_covid').click(function(){
            var koma = "";
            var noreg = {};
            $.each($(".bg-gray"),function(key, value){
                var kode = $(this).attr("no_reg");
                noreg[kode] = kode;
            });
            $.ajax({
                url: "<?php echo site_url('lab/postnoreg');?>", 
                type: 'POST', 
                data: {noreg:noreg}, 
                success: function(){
                    openCenteredWindow("<?php echo site_url('lab/cetakcovidmulti_inap');?>");
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
        //     window.location = "<?php echo site_url('lab/addpasienbaru/y/y')?>";
        //     return false;
        // });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('lab/editinap')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".datapasien").click(function(){
            window.location = "<?php echo site_url('lab')?>";
            return false;
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('lab/hapuspasien')?>/"+id;
            return false;
        });
          $(".rjalan").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('lab/viewrjalan');?>/"+id;
            // openCenteredWindow(url);
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
        	window.location ="<?php echo site_url('lab/reset_inap');?>/";
            // location.reload();
            return false;
        });
         $(".cetak").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('lab/cetakinap');?>/"+no_rm+"/"+no_reg;
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
        $(".detail").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('lab/detaillab_inap');?>/"+id+"/"+no_reg;
            window.location = url;
            return false; 
        });
        $(".rekap").click(function(){
            var url = "<?php echo site_url('lab/labrekap_inap');?>/all";
            window.location = url;
            return false; 
        });
        $(".upload").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('lab/formuploadpdf_inap');?>/"+id+"/"+no_reg;
            window.location = url;
            return false; 
        });
        $(".ekspertisi").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type  : "POST",
                data  : {no_reg:no_reg},
                url   : "<?php echo site_url('lab/cekkasirinap_detail');?>",
                success : function(result){
                    var jml = parseInt(result);
                    if (jml>0){
                        alert("Tidak dapat melakukan ekspertisi, lengkapi data terlebih dahulu");
                    } else {
                        var id = $(".bg-gray").attr("href");
                        var url = "<?php echo site_url('lab/ekspertisi_inap');?>/"+id+"/"+no_reg;
                        window.location = url;
                    }
                },
                error: function(result){
                    console.log(result);
                }
            });
            return false;
        });
        $(".terima").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('lab/terima_inap')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".periksa").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('lab/periksa_inap')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".respond").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('lab/respond_inap')?>/"+id+"/"+no_reg;
            openCenteredWindow(url);
        });
    });
    $(document).keyup(function(e){
        if (e.keyCode==82 && e.altKey){
            $(".reset").click();
        }
        // if (e.keyCode==78){
        //     $(".cari_nama").click();
        // }
        // if (e.keyCode==82 && !e.altKey){
        //     $(".cari_no").click();
        // }
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
                        echo "<tr id=data href='".$row->no_rm."' no_reg='".$row->no_reg."'>";
                        echo "<td class='text-center'>".$row->no_rm."</td>";
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
                <tfoot>
                    <tr class="bg-navy">
                        <th colspan="9">Jumlah Pasien : <?php echo $total_rows;?></th>
                    </tr>
                </tfoot>
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
            <div class="row">
                <div class="col-xs-4">
                    <div class="btn-group pull-left">
                        <button class="reset btn btn-warning"> Reset</button>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="cetak_covid btn btn-danger" type="button"><i class="fa fa-print"></i> Cetak Covid</button>
                            <button class="rekap btn bg-maroon" type="button">Rekap</button>
                            <button class="upload btn btn-primary" type="button">PDF</button>
                            <button class="respond btn btn-warning" type="button"> Respond Time</button>
                            <button class="ekspertisi btn btn-success" type="button"> Ekspertisi</button>
                            <button class="periksa btn bg-teal" type="button"> Pemeriksaan</button>
                            <button class="detail btn bg-navy" type="button"> Terima</button>
                            <button class="cari_no btn btn-info" type="button"> Cari</button>
                            <!-- <button class="cari_noreg btn btn-info" type="button"> Cari No REG</button>
                            <button class="cari_nama btn btn-info" type="button"> Cari Nama</button> -->
                            <!-- <button class="detail btn btn-warning" type="button"><i class="fa fa-edit"></i> Detail</button> -->
                        </div>
                    </div>
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
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ No. RM/ No. Reg/ No. BPJS/ No. SEP"//>
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
                                <input class="form-control" type="text" name="cari_nama" placeholder="Nama/ No. RM/ No. Reg/ No. BPJS/ No. SEP"/>
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