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
            url   : "<?php echo site_url('kasir/getcaripasien_inap');?>",
            success : function(result){
                location.reload();
                // window.location = "<?php echo site_url('kasir/pembayaran_inap');?>";
            },
            error: function(result){
                alert(result);
            }
        });
    }
    function rekap_inap(){
        $(".list_rekap").html("");
        var tgl1_rekap = $("[name='tgl1_rekap']").val();
        var tgl2_rekap = $("[name='tgl2_rekap']").val();
        var resume = $("[name='resume']").val();
        $.ajax({
            type  : "POST",
            data  : {tgl1_rekap:tgl1_rekap,tgl2_rekap:tgl2_rekap,resume:resume},
            url   : "<?php echo site_url('grouper/rekap_inap');?>",
            success : function(result){
                var html = '<table class="table table-hover table-striped" id="myTable_rekap">';
                html += '<thead>';
                html += '    <tr class="bg-navy">';
                html += '        <th>No.</th>';
                html += '        <th width=100px>No. RM</th>';
                html += '        <th>No. Reg</th>';
                html += '        <th>No. BPJS</th>';
                html += '        <th>No. SEP</th>';
                html += '        <th>Nama</th>';
                html += '        <th width="120px">Kode Grouper</th>';
                html += '        <th width="300px">File PDF</th>';
                html += '        <th>Tarif BPJS</th>';
                html += '        <th>Tarif RS</th>';
                html += '    </tr>';
                html += '</thead>';
                html += '<tbody>';
                var i = 1;
                console.log(result);
                $.each(JSON.parse(result),function(key,value){
                    html += "<tr>";
                    html += "<td>"+(i++)+"</td>";
                    html += "<td>"+value.no_pasien+"</td>";
                    html += "<td>"+value.no_reg+"</td>";
                    html += "<td>"+(value.no_bpjs==null ? "-" : value.no_bpjs)+"</td>";
                    html += "<td>"+(value.no_sjp==null ? "-" : value.no_sjp)+"</td>";
                    html += "<td>"+value.nama_pasien+"</td>";
                    html += "<td>"+(value.kode_eclaim==null ? "-" : value.kode_eclaim)+"</td>";
                    html += "<td>"+(value.file_pdf==null ? "-" : value.file_pdf)+"</td>";
                    html += "<td class='text-right'>"+(value.tarif_bpjs==null ? "-" : value.sharing==null ? number_format(value.tarif_bpjs,0) : number_format(parseInt(value.tarif_bpjs)+parseInt(value.sharing)))+"</td>";
                    html += "<td class='text-right'>"+(value.tarif_rumahsakit==null ? "-" : number_format(value.tarif_rumahsakit,0))+"</td>";
                    html += "</tr>";
                });
                html += '</tbody>';
                $(".list_rekap").html(html);
                $(".jumlah").html("<b>TOTAL "+ (i-1) +" Record</b>");
                $('#myTable_rekap').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function number_format (number, decimals, dec_point=",", thousands_sep=".") {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    $(document).ajaxStart(function () {
        $('.loading').show();
    }).ajaxStop(function () {
        $('.loading').hide();
    });
    $(document).ready(function(e){
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".rekap").click(function(){
            $(".modal_rekap").modal("show");
            return false; 
        });
        $(".print_rekap").click(function(){
            var tgl1 = $("[name='tgl1_rekap']").val();
            var tgl2 = $("[name='tgl2_rekap']").val();
            var resume = $("[name='resume']").val();
            var url = "<?php echo site_url('grouper/cetak_rekap_inap');?>/"+tgl1+"/"+tgl2+"/"+resume;
            openCenteredWindow(url);
            return false;
        });
        $(".search_rekap").click(function(){
            rekap_inap();
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
                url: "<?php echo site_url('grouper/search_inap');?>", 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1'], input[name='tgl1_rekap']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2'], input[name='tgl2_rekap']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tanggal_pulang']").datepicker({
            dateFormat : formattgl,
        }).datepicker("setDate", new Date());
        $(".view").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('grouper/viewgrouper_inap');?>/"+no_rm+"/"+no_reg;
            window.location = url;
            return false; 
        });
        // $(".obat").click(function(){
        //     var no_rm = $(".bg-gray").attr("href");
        //     var no_reg = $(".bg-gray").attr("no_reg");
        //     var url = "<?php echo site_url('grouper/apotek_inap');?>/"+no_rm+"/"+no_reg;
        //     window.location = url;
        //     return false; 
        // });
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
        $(".laporan_mata").click(function(){
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('grouper/cetak_mata')?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_operasi").click(function(){
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('grouper/cetak_operasi')?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".reset").click(function(){
            window.location ="<?php echo site_url('kasir/reset_inap');?>/";
            return false;
        });
         $(".cetak").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('kasir/cetakinap');?>/"+no_rm+"/"+no_reg;
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
        $(".triage").click(function(){
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('dokter/cetaktriage');?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".assesment").click(function(){
            var no_reg = $(".bg-gray").attr("no_reg");
            var id_dokter = $(".bg-gray").attr("id_dokter");
            var url = "<?php echo site_url('dokter/cetakigdinap');?>/"+no_reg+"/"+id_dokter;
            openCenteredWindow(url);
            return false;
        });
        $(".perawat").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var id_dokter = $(".bg-gray").attr("id_dokter");
            var url = "<?php echo site_url('perawat/cetakassesmen');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".covid").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var id_dokter = $(".bg-gray").attr("id_dokter");
            var url = "<?php echo site_url('perawat/cetakcovid');?>/"+no_rm+"/"+no_reg+"/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".cetaksep").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_bpjs = $(".bg-gray").attr("no_bpjs");
            var no_sep = $(".bg-gray").attr("no_sep");
            var url = "<?php echo site_url('sep/cetaksep_inap');?>/"+no_reg+"/"+no_rm+"/"+no_bpjs+"/"+no_sep;
            openCenteredWindow(url);
            return false;
        });
    });
    $(document).keyup(function(e){
        if (e.keyCode==82 && e.altKey){
            $(".reset").click();
        }
    })
    function tgl_indo(tgl,tipe=1){
        var date = tgl.substring(tgl.length,tgl.length-2);
        if (tipe==1)
            var bln = tgl.substring(5,7);
        else
            var bln = tgl.substring(4,6);
        var thn = tgl.substring(0,4);
        return date+"-"+bln+"-"+thn;
    }
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
                        <th class='text-center'>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no_kk = '';
                    $bayar = '';
                    foreach ($q3->result() as $row){
                        switch ($row->status_bayar) {
                            case '':
                                $bayar = "<label class='label label-warning'>--</label>";
                                break;
                            case 'TAGIH':
                                $bayar = "<label class='label label-danger'>TAGIH</label>";
                                break;
                            case 'LUNAS':
                                $bayar = "<label class='label label-success'>LUNAS</label>";
                                break;
                            case 'SHARING':
                                $bayar = "<label class='label label-info'>SHARING</label>";
                                break;
                        }
                        echo "<tr id=data href='".$row->no_rm."' id_dokter='".$row->dokter."' no_reg='".$row->no_reg."' no_bpjs='".$row->no_bpjs."'  no_sep='".$row->no_sjp."' kode_kamar='".$row->kode_kamar."' kode_kelas='".$row->kode_kelas."' kode_ruangan='".$row->kode_ruangan."' no_bed='".$row->no_bed."'>";
                        echo "<td class='text-center'>".$row->no_rm."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        // echo "<td>".$row->alamat."</td>";
                        echo "<td>".$row->nama_ruangan."</td>";
                        echo "<td>".$row->nama_kelas."</td>";
                        echo "<td>".$row->kode_kamar."</td>";
                        echo "<td>".$row->no_bed."</td>";
                        echo "<td>".$bayar."</td>";
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
                    <button class="reset btn btn-warning" type="button"> <i class="fa fa-refresh"></i> Reset</button>
                    <button class="rekap btn btn-primary"> Rekap</button>
                </div>
                <div class="dropup">
                    <button class="dropbtn btn bg-maroon">ERM</button>
                    <div class="dropup-content">
                        <a class="triage"> Triage</a>
                        <a class="assesment"> Assesment Medis IGD</a>
                        <a class="perawat"> Assesment Keperawatan</a>
                        <a class="covid"> Covid</a>
                        <a class="cetaksep"> SEP</a>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    
                    <button class="cari_no btn btn-primary" type="button"> Cari</button>
                    <!-- <button class="cari_noreg btn btn-info" type="button"> Cari No REG</button> -->
                    <!-- <button class="obat btn btn-success" type="button"> Obat</button> -->
                    <button class="view btn bg-maroon" type="button"> View Grouper</button>
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
<div class="formpulang modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update <b><span class="noreg"></span></b></h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Keadaan Pulang</label>
                        <div class="col-md-8">
                            <select name="keadaan_pulang" class="form-control">
                                <?php
                                    foreach ($k->result() as $key) {
                                        echo "<option value=".$key->id.">".$key->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Status Pulang</label>
                        <div class="col-md-8">
                            <select name="status_pulang" class="form-control">
                                <?php
                                    foreach ($sp->result() as $key) {
                                        echo "<option value=".$key->id.">".$key->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tanggal Pulang</label>
                        <div class="col-md-8">
                            <input type="text" name="tanggal_pulang" class="form-control" autocomplete="off">
                            <p class="status_pasien"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No. Surat Pulang</label>
                        <div class="col-md-8">
                            <input type="text" name="no_surat_pulang" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>     
            </div>
            <div class="modal-footer">
                <button class="simpan_pulang btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_rekap no-print' role="dialog">
    <div class='modal-dialog' style="width:1200px">
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class='form-horizontal'>
                    <div class="form-group">
                        <label class="col-md-2 control-label">
                            Tanggal
                        </label>
                        <div class="col-md-2">
                            <input type="text" name="tgl1_rekap" class="form-control" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="tgl2_rekap" class="form-control" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">
                        </div>
                        <label class="col-md-2 control-label">Resume</label>
                        <div class="col-md-2">
                            <select class="form-control" name="resume">
                                <option value="1">ADA</option>
                                <option value="0">TIDAK ADA</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="search_rekap btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-body no-padding'>
                <div class="list_rekap table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-navy">
                                <th>No.</th>
                                <th width='100px'>No. RM</th>
                                <th>No. Reg</th>
                                <th>No. BPJS</th>
                                <th>No. SEP</th>
                                <th>Nama</th>
                                <th>Kode Grouper</th>
                                <th>File PDF</th>
                                <th>Tarif BPJS</th>
                                <th>Tarif RS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                for ($i=1;$i<=10;$i++) {
                                    echo "<tr>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "<td>&nbsp;</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class='modal-footer'>
                <div class="pull-left"><span class="jumlah"></span></div>
                <button class="print_rekap btn btn-success">Print</button>
            </div>
        </div>
    </div>
</div>
<div class='loading modal'>
    <div class='text-center align-middle' style="margin-top: 200px">
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
        <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
            <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url();?>/img/load.gif" width="150px"></div>
            <div style="font-size:20px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Loading</div>
        </div>
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
    </div>
</div>
<style>
    .dropbtn {
      
      color: white;
      padding: 14px,8px,14px,8px;
      font-size: 14px;
      border: none;
    }

    .dropup {
      position: relative;
      display: inline-block;
    }

    .dropup-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      bottom: 31px;
      z-index: 1;
    }

    .dropup-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropup-content a:hover {background-color: #ccc}

    .dropup:hover .dropup-content {
      display: block;
    }

    /*.dropup:hover .dropbtn {
      background-color: #2980B9;
    }*/
</style>