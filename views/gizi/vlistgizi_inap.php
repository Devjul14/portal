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
        var kode_ruangan = $("[name='kode_ruangan']").val();
        var ruangan = $("[name='ruangan']").val();
        var isi = $("[name='isi']").val();
        var kode_kelas = $("[name='kode_kelas']").val();
        var kelas = $("[name='kelas']").val();
        var tgl1 = $("[name='tgl1']").val();
        var tgl2 = $("[name='tgl2']").val();
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no,cari_nama:cari_nama,cari_noreg:cari_noreg, tgl1: tgl1,tgl2: tgl2,kode_ruangan: kode_ruangan,ruangan: ruangan,isi: isi,kode_kelas: kode_kelas,kelas: kelas},
            url   : "<?php echo site_url('gizi/cari_giziinap');?>",
            success : function(result){
                window.location = "<?php echo site_url('gizi/inap');?>";
            },
            error: function(result){
                alert(result);
            }
        });
    }
    $(document).ready(function(e){
        localStorage.removeItem("no_foto");
        localStorage.removeItem("ukuran_foto");
        localStorage.removeItem("dokter");
        localStorage.removeItem("petugas_gizi");
        localStorage.removeItem("pa");
        localStorage.removeItem("dokter_pengirim");
        $(".search").click(function(){
            pencarian();
        });
        $(".cppt").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('dokter/cppt')?>/"+no_rm;
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".reset").click(function(){
            var url = "<?php echo site_url('gizi/reset_giziinap');?>";
            window.location = url;
            return false;
        });
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
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
        $(".ekspertisilab").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('pendaftaran/ekspertisilab_inap');?>/"+no_rm;
            return false;
        });
        $(".cari_noreg").click(function(){
            $(".modal_cari_noreg").modal("show");
            $("[name='cari_noreg']").focus();
            return false;
        });
        $("[name='cari_nama'], [name='cari_no'], [name='cari_noreg']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function(){
            pencarian();
            return false;
        });
        
        $(".detail").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('gizi/detailgizi_inap');?>/"+id;
            window.location = url;
            return false; 
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
        $(".isi").click(function(){
            var url = "<?php echo site_url('gizi/pilihisi');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".ekspertisi").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('gizi/ekspertisi_inap');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".makan").click(function(){
            // var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('gizi/makan');?>/";
            window.location = url;
            return false; 
        });
    });
</script>
<?php 
    if($q3){
        if ($this->session->userdata("isi")=="ISI") $is1 = "selected"; else $is1 = "";
        if ($this->session->userdata("isi")=="KOSONG") $is2 = "selected"; else $is2 = "";
    }
    else{
        $is1 = $is2= "";
    }
?>
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
        <div class="box-header">
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th class='text-center'>Nomor RM</th>
                        <th class='text-center'>Nomor REG</th>
                        <th>Nama</th>
                        <th class='text-center'>Ruangan</th>
                        <th class='text-center'>Kelas</th>
                        <th class='text-center'>Kamar</th>
                        <th class='text-center'>No. Bed</th>
                        <th class='text-center'>Golongan Pasien</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    $no_kk = '';
                    foreach ($q3->result() as $row){
                        echo "<tr id=data href='".$row->no_rm."/".$row->no_reg."'>" ;
                        echo "<td class='text-center'>".$row->no_rm."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
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
                        <input type="text" name="ruangan" class="form-control" readonly value="<?php echo $this->session->userdata("ruangan") ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_ruangan" class="form-control" readonly value="<?php echo $this->session->userdata("kode_ruangan") ?>">
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="ruangan btn btn-primary" type='button'>...</button>
                        </div>
                    </div>
                    <label class="col-md-1 control-label">Status</label>
                    <div class="col-md-2">
                        <select class="form-control" name="isi">
                            <option value="">-----</option>
                            <option value="ISI" <?php echo $is1 ?>>ISI</option>
                            <option value="KOSONG" <?php echo $is2 ?>>KOSONG</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-1">
                        <input type="text" name="isi" class="form-control" readonly value="<?php echo $this->session->userdata("isi") ?>">
                    </div> --><!-- 
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="isi btn btn-primary" type='button'>...</button>
                        </div>
                    </div> -->
                    <div class="col-md-3">
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
                        <input type="text" name="kelas" class="form-control" readonly value="<?php echo $this->session->userdata("kelas") ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_kelas" class="form-control" readonly value="<?php echo $this->session->userdata("kode_kelas") ?>">
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
                            <button class="ekspertisilab btn btn-info"> Lab</button>
                            <button class="makan btn bg-maroon" type="button"> Makan Pasien</button>
                            <button class="ekspertisi btn btn-success" type="button"> Ekspertisi</button>
                            <button class="cppt btn bg-navy" type="button">CPPT</button>
                            <button class="detail btn btn-warning" type="button"><i class="fa fa-edit"></i> Detail</button>
                            <button class="cari_no btn btn-info" type="button"> Cari</button>
                            <!-- <button class="cari_noreg btn btn-info" type="button"> Cari No REG</button> -->
                            <!-- <button class="cari_nama btn btn-info" type="button"> Cari Nama</button> -->
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
                        <div class="col-sm-12">
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
<section class="invoice no-border hide" id="invoice">
    <div style="width:20cm;height:2.59cm;display: block;margin-left:-5px">
        <div style="float: left;width:3.6cm;padding:2px">
            <table cellspacing="0" cellpadding="0" width="100%" style="font-size:10px;font-family: 'Arial Narrow'">
                <tbody class="konten_print"></tbody>
                <tfoot>
                    <tr><td colspan="2"><br><span class="barcode" id="barcode" style="width:100px;"></span></td></tr>
                </tfoot>
            </table>
        </div>
        <div style="float: left;width:3.6cm;padding:2px">
            <table cellspacing="0" cellpadding="0" width="100%" style="font-size:10px;font-family: 'Arial Narrow'">
                <tbody class="konten_print"></tbody>
                <tfoot>
                    <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
                </tfoot>
            </table>
        </div>
        <div style="float: left;width:3.6cm;padding:2px">
            <table cellspacing="0" cellpadding="0" width="100%" style="font-size:10px;font-family: 'Arial Narrow'">
                <tbody class="konten_print"></tbody>
                <tfoot>
                    <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>