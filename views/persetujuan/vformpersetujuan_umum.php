<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FORM PERSETUJUAN</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery.signature.js"></script>
    <script src="<?php echo base_url();?>js/jquery.ui.touch-punch.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
  </head>
<script>
    var mywindow;
    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function() {
        $("[name='tgl_lahir']").mask("dd-mm-yyyy", {placeholder: 'dd-mm-yyyy'});
    });
        $(".back").click(function(){
            var no_reg  = $("[name='no_reg']").val();
            var jenis   = $("[name='jenis']").val();
            var url     = "<?php echo site_url('persetujuan/reset_umum');?>/"+jenis+"/"+no_reg;
            window.location = url;
            return false; 
        });
        $(".cetak").click(function(){
            var no_reg          = $("[name='no_reg']").val();
            var no_pasien       = $("[name='no_pasien']").val();
            var url = "<?php echo site_url('persetujuan/cetakpersetujuan_umum');?>/"+no_reg+"/"+no_pasien;
            openCenteredWindow(url);
        });
        $(".cetak2").click(function(){
            var no_reg          = $("[name='no_reg']").val();
            var no_pasien       = $("[name='no_pasien']").val();
            var url = "<?php echo site_url('persetujuan/cetakhak_kewajiban');?>/"+no_reg+"/"+no_pasien;
            openCenteredWindow(url);
        });
        $("#signature").signature({syncField: '#signatureJSON'});
        $('#signature').signature('option', 'syncFormat', "PNG");
        $('#signature').draggable();

        $("#signature2").signature({syncField: '#signatureJSON2'});
        $('#signature2').signature('option', 'syncFormat', "PNG");
        $('#signature2').draggable();
    });
</script>
<?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div>";
    }
?>
<?php
    $t1 = new DateTime('today');
    $t2 = new DateTime($q->tgl_lahir);
    $y  = $t1->diff($t2)->y;
    $m  = $t1->diff($t2)->m;
    $d  = $t1->diff($t2)->d;

    list($year,$month,$day) = explode("-",$q->tgl_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) { 
        $year_diff--;
        $month_diff *= (-1);
    }
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    if ($day_diff < 0) { 
        $day_diff *= (-1);
    }
    $umur_pasien = $year_diff." tahun ".$month_diff." bulan ".$day_diff." hari ";

    if ($q2) {
        $nama           = $q2->nama;
        $nama_pasien    = $q2->nama_pasien;
        $jk             = $q2->jk;
        $pekerjaan      = $q2->pekerjaan;
        $alamat         = $q2->alamat;
        $hubungan       = $q2->hubungan;
        $saksi          = $q2->saksi;
        $tgl_lahir      = $q2->tgl_lahir;
        $no_reg         = $q2->no_reg;
        $no_pasien      = $q2->no_pasien;
        $no_telpon      = $q2->no_telpon;
        $pelepasan_informasi1          = $q2->pelepasan_informasi1;
        $pelepasan_informasi2          = $q2->pelepasan_informasi2;
        $keinginan_privasi1          = $q2->keinginan_privasi1;
        $keinginan_privasi2          = $q2->keinginan_privasi2;
        if ($q2->status) $ubah = "readonly"; else $ubah = "";
        $aksi = "edit";
    } else {
        $nama           = $q3->nama;
        $nama_pasien    = $q->nama_pasien;
        $jk             = $q3->jk;
        $pekerjaan      = $q3->pekerjaan;
        $alamat         = $q3->alamat;
        $hubungan       = $q3->hubungan;
        $saksi          = $q3->saksi;
        $umur           = $q3->umur;
        $no_telpon      = $q->telpon; 
        $tgl_lahir      = ""; 
        $pernyataan4    = "";
        $pelepasan_informasi1          = "";
        $pelepasan_informasi2          = "";
        $keinginan_privasi1          = "";
        $keinginan_privasi2          = "";
        $no_reg         = $no_reg;
        $no_pasien      = $this->session->userdata("no_pasien");
        $ubah = "";
        $aksi = "simpan";
    }
    if ($jenis=="ralan"){
        $readonly = "";
    } else {
        $readonly = "readonly";
    }
?>
<div class="col-xs-12 margin">
    <div class="box box-primary">
        <div class="box-header">
            <h3 align="center">PERSETUJUAN UMUM (GENERAL CONSENT)</h3>
        </div>
        <div class="box-body">
            <?php echo form_open("persetujuan/simpanpersetujuan_umum/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pasien</label>
                <div class="col-sm-2">
                    <input type="hidden" name="jenis" value="<?php echo $jenis ?>">
                    <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo $nama_pasien ?>">
                </div>
                <label class="col-sm-2 control-label">No Reg</label>
                <div class="col-sm-2">
                    <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $no_reg ?>">
                </div>
                <label class="col-sm-2 control-label">No RM</label>
                <div class="col-sm-2">
                    <input type="text" name="no_pasien" class="form-control" readonly value="<?php echo $no_pasien ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Umur Pasien</label>
                <div class="col-sm-2">
                    <input type="text" name="umur_pasien" class="form-control" readonly value="<?php echo $umur_pasien ?>">
                </div>
                <label class="col-sm-2 control-label">Ruang</label>
                <div class="col-sm-2">
                    <input type="text" name="ruang" class="form-control" readonly value="<?php echo $q1->nama_ruangan ?>">
                </div>
                <label class="col-sm-2 control-label">Kelas</label>
                <div class="col-sm-2">
                    <input type="text" name="kelas" class="form-control" readonly value="<?php echo $q1->nama_kelas ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <h3>Yang bertanda tangan di bawah ini :</h3>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-2">
                    <input type="text" name="nama"  <?php echo $readonly;?> class="form-control" value="<?php echo $nama ?>">
                </div>
                <label class="col-sm-2 control-label"  <?php echo $readonly;?>>Jenis Kelamin</label>
                <div class="col-sm-2">
                    <select class="form-control" name="jk">
                        <option>----</option>
                        <option value="L" <?php if ($jk=="L"): ?>
                            selected
                        <?php endif ?>>Laki-Laki</option>
                        <option value="P" <?php if ($jk=="P"): ?>
                            selected
                        <?php endif ?>>Perempuan</option>
                    </select>
                </div>
                <label class="col-sm-2 control-label">Tanggal Lahir</label>
                <div class="col-sm-2">
                    <input type="text" name="tgl_lahir" required class="form-control" value="<?php echo ($tgl_lahir=="" ? "" : date("d-m-Y",strtotime($tgl_lahir))); ?>" <?php echo $ubah ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Pekerjaan / Jabatan
                </label>
                <div class="col-sm-10">
                    <input type="text"  <?php echo $readonly;?> name="pekerjaan" class="form-control" value="<?php echo $pekerjaan ?>">
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2">
                    No Telpon
                </label>
                <div class="col-sm-10">
                    
                </div>
            </div> -->
            <input type="hidden" name="no_telpon" required class="form-control" value="<?php echo $no_telpon ?>" <?php echo $readonly;?>>
            <div class="form-group">
                <label class="col-sm-2">
                    Alamat
                </label>
                <div class="col-sm-10">
                    <textarea class="form-control"  <?php echo $readonly;?> name="alamat"><?php echo $alamat ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Hubungan Dengan Pasien
                </label>
                <div class="col-sm-10">
                    <input type="text" name="hubungan"  <?php echo $readonly;?> class="form-control" value="<?php echo $hubungan ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Saksi
                </label>
                <div class="col-sm-10">
                    <input type="text" name="saksi"  <?php echo $readonly;?> class="form-control" value="<?php echo $saksi ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">
                    Saya memberi wewenang kepada rumah sakit untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan saya kepada anggota keluarga / teman saya yaitu
                </label>
                <div class="col-sm-12" style="padding-bottom:15px">
                    <input type="text" required name="pelepasan_informasi1" class="form-control" value="<?php echo $pelepasan_informasi1 ?>" <?php echo $ubah;?>>
                </div>
                <div class="col-sm-12">
                    <input type="text" name="pelepasan_informasi2" class="form-control" value="<?php echo $pelepasan_informasi2 ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">
                    Saya mengizinkan rumah sakit memberi akses bagi keluarga dan handai taulan serta orang-orang yang akan menengok saya kecuali kepada
                </label>
                <div class="col-sm-12" style="padding-bottom:15px">
                    <input type="text" required name="keinginan_privasi1" class="form-control" value="<?php echo $keinginan_privasi1 ?>" <?php echo $ubah;?>>
                </div>
                <div class="col-sm-12">
                    <input type="text" name="keinginan_privasi2" class="form-control" value="<?php echo $keinginan_privasi2 ?>" <?php echo $ubah;?>>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-danger" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Setuju</button>
                    <?php if ($aksi=="edit"): ?>
                        <!-- <button class="cetak btn btn-success" type="button"><i class="fa fa-print"></i> Cetak</button>
                        <button class="cetak2 btn btn-success" type="button"><i class="fa fa-print"></i> Cetak Hak & Kewajiban Pasien</button> -->
                    <?php endif ?>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
</html>
<style type="text/css">
    #signature{
        height: 300px;
        border: 1px solid black;
    }
    #signature2{
        height: 300px;
        border: 1px solid black;
    }
</style>