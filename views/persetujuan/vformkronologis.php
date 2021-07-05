<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KRONOLOGIS</title>
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
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat: formattgl,
        });
        $("#signature").signature({syncField: '#signatureJSON'});
        $('#signature').signature('option', 'syncFormat', "PNG");
        $('#signature').draggable();

        $("#signature2").signature({syncField: '#signatureJSON2'});
        $('#signature2').signature('option', 'syncFormat', "PNG");
        $('#signature2').draggable();

        $("#signature3").signature({syncField: '#signatureJSON3'});
        $('#signature3').signature('option', 'syncFormat', "PNG");
        $('#signature3').draggable();
        getttd();
        $(".back").click(function(){
            var no_reg  = $("[name='no_reg']").val();
            var jenis   = $("[name='jenis']").val();
            var url     = "<?php echo site_url('persetujuan/reset');?>/"+jenis+"/"+no_reg;
            window.location = url;
            return false;
        });
        $(".cetak").click(function(){
            var no_reg          = $("[name='no_reg']").val();
            var no_pasien       = $("[name='no_rm']").val();
            var url = "<?php echo site_url('persetujuan/cetakkronologis');?>/"+no_reg+"/"+no_pasien;
            openCenteredWindow(url);
        });
    });
    function getttd(){
        var ttd_saksi = "<?php echo $q3->ttd;?>";
        var ttd_pernyataan = "<?php echo $q3->ttd2;?>";
        var ttd_petugasrm = "<?php echo $q3->ttd3;?>";
        $('#signature').signature('enable').signature('draw', ttd_saksi);
        $('#signature2').signature('enable').signature('draw', ttd_pernyataan);
        $('#signature3').signature('enable').signature('draw', ttd_petugasrm);
    }
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
    $telpon         = $q2->telpon;
    $alamat         = $q2->alamat;
    $hubungan       = $q2->hubungan;
    $hari           = $q2->hari;
    $tanggal        = $q2->tanggal;
    $waktu          = $q2->waktu;
    $lokasi         = $q2->lokasi;
    $kronologis     = $q2->kronologis;
    $no_reg         = $q2->no_reg;
    $no_rm          = $q1->no_rm;
    if ($q2->status) $ubah = "readonly"; else $ubah = "";
    $aksi = "edit";

} else {
    $nama           = "";
    $nama_pasien    = $q1->nama_pasien;
    $telpon         = "";
    $alamat         = "";
    $hubungan       = "";
    $hari           = "";
    $tanggal        = "";
    $waktu          = "";
    $lokasi         = "";
    $kronologis     = "";
    $ubah = "";
    $aksi = "simpan";
}

?>
<div class="col-xs-12 margin">
    <div class="box box-primary">
        <div class="box-header">
            <h3>SURAT KETERANGAN KRONOLOGIS</h3>
            <h3>KASUS TRAUMA/NON KECELAKAAN LALU LINTAS</h3>
        </div>
        <div class="box-body">
            <?php echo form_open("persetujuan/simpankronologis/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <div class="col-sm-12">
                    <p>Yang bertanda tangan di bawah ini :</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-2">
                    <input type="text" required name="nama" class="form-control" value="<?php echo $nama ?>" <?php echo $ubah;?>>
                </div>
                <label class="col-sm-2 control-label">No Hp</label>
                <div class="col-sm-2">
                    <input type="text" required name="telpon" class="form-control" value="<?php echo $telpon ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Alamat
                </label>
                <div class="col-sm-10">
                    <textarea required class="form-control" name="alamat" <?php echo $ubah;?>><?php echo $alamat ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Hubungan Dengan Pasien
                </label>
                <div class="col-sm-10">
                    <input type="text" required name="hubungan" class="form-control" value="<?php echo $hubungan ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <p>Dengan ini menyatakan bahwa pasien :</p>
                </div>
            </div>
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
                    <input type="text" name="no_rm" class="form-control" readonly value="<?php echo $no_rm ?>">
                </div>
            </div>
            <div class="form-group">
                <!-- <label class="col-sm-2 control-label">Umur Pasien</label>
                <div class="col-sm-2">
                    <input type="text" name="umur_pasien" class="form-control" readonly value="<?php echo $umur_pasien ?>">
                </div> -->
                <label class="col-sm-2 control-label">Ruang</label>
                <div class="col-sm-2">
                    <input type="text" name="ruang" class="form-control" readonly value="<?php echo $q1->nama_ruangan ?>">
                </div>
                <label class="col-sm-2 control-label">Kelas</label>
                <div class="col-sm-2">
                    <input type="text" name="kelas" class="form-control" readonly value="<?php echo $q1->nama_kelas ?>">
                </div>
                <label class="col-sm-2 control-label">Tanggal Mulai Rawat</label>
                <div class="col-sm-2">
                    <input type="text" name="tgl_masuk" class="form-control" readonly value="<?php echo date("d-m-Y", strtotime($q1->tgl_masuk)) ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <p>Di Rawat di rs Ciremai diakibatkan oleh kejadian <b>trauma/bukan kecelakaan lalu lintas</b> dengan kronologis (urutan kejadian) sebagai berikut :</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Hari
                </label>
                <div class="col-sm-10">
                    <input type="text" required name="hari" class="form-control" value="<?php echo $hari ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Tanggal
                </label>
                <div class="col-sm-10">
                    <input type="text" required autocomplete="off" name="tanggal" class="form-control" value="<?php echo $tanggal ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Waktu Kejadian
                </label>
                <div class="col-sm-10">
                    <input type="text" required name="waktu" class="form-control" value="<?php echo $waktu ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Lokasi Kejadian
                </label>
                <div class="col-sm-10">
                    <input type="text" required name="lokasi" class="form-control" value="<?php echo $lokasi ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea type="text" required name="kronologis" class="form-control" placeholder="isi kronologis !" ><?php echo $ubah;?><?php echo $kronologis ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <p>Demikian surat kronologis ini saya tulis dan nyatakan dengan sebenar-benarnya sesuai kejadian sesungguhnya, <b>serta dapat dipertanggung jawabkan sesuai hukum yang berlaku.</b> Dan bila dikemudian hari diperrlukan keterangan lebih lanjut dari <i>BPJS Kesehatan maupun pihak pemeriksa lainnya</i> saya siap memberikan informasi.</p>
                </div>
            </div>
            <div class="col-xs-12">
                <p>Tanda Tangan Pembuat Pernyataan</p>
                <input type="hidden" name="ttd_pernyataan" id="signatureJSON2">
                <div id="signature2"></div>
            </div>
            <div class="col-xs-12">
                <p>Tanda Tangan Saksi</p>
                <input type="hidden" name="ttd_saksi" id="signatureJSON">
                <div id="signature"></div>
            </div>
            <div class="col-xs-12">
                <p>Tanda Tangan Petugas RM</p>
                <input type="hidden" name="ttd_petugasrm" id="signatureJSON3">
                <div id="signature3"></div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-danger" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Setuju</button>
                    <?php if ($aksi=="edit"): ?>
                        <button class="cetak btn btn-success" type="button"><i class="fa fa-print"></i> Cetak</button>
                    <?php endif ?>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<style type="text/css">
    #signature{
        width: 100%;
        height: 300px;
        border: 1px solid black;
    }

    #signature2{
        width: 100%;
        height: 300px;
        border: 1px solid black;
    }
    #signature3{
        width: 100%;
        height: 300px;
        border: 1px solid black;
    }
</style>
