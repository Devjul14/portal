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
        // $pekerjaan      = $q2->pekerjaan;
        $alamat         = $q2->alamat;
        $hubungan       = $q2->hubungan;
        $saksi          = $q2->saksi;
        $umur           = $q2->umur;
        $no_reg         = $q2->no_reg;
        $no_pasien      = $q2->no_pasien;
        $setuju         = $q2->setuju=="setuju" ? "SETUJU" : "TIDAK SETUJU";
        $ttd_saksi      = $q2->ttd_saksi;
        $ttd_pernyataan = $q2->ttd_pernyataan;
        if ($q2->status) $ubah = "readonly"; else $ubah = "";
        $aksi = "edit";
    } else {
        $nama           = "";
        $nama_pasien    = $q->nama_pasien;
        $jk             = "";
        // $pekerjaan      = "";
        $alamat         = "";
        $hubungan       = "";
        $saksi          = "";
        $umur           = ""; 
        $setuju         = "";
        $ttd_saksi      = "";
        $ttd_pernyataan = "";
        $no_reg         = $no_reg;
        $no_pasien      = $no_pasien;
        $ubah = "";
        $aksi = "simpan";
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
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
        $("#signature").signature({syncField: '#signatureJSON'});
        $('#signature').signature('option', 'syncFormat', "PNG");
        $('#signature').draggable();

        $("#signature2").signature({syncField: '#signatureJSON2'});
        $('#signature2').signature('option', 'syncFormat', "PNG");
        $('#signature2').draggable();
        $(".setuju").click(function(){
            $("[name='setuju']").val("setuju");
            $(".formsave").submit();
        });
        $(".tdksetuju").click(function(){
            $("[name='setuju']").val("tdksetuju");
            $(".modal-alasan").modal("show");
        });
        $(".simpan").click(function(){
            var alasan = $("[name='alasan']").val();
            $("[name='alasan_tdksetuju']").val(alasan);
            $(".formsave").submit();
        });
        getttd()
        $(".back").click(function(){
            var no_reg  = $("[name='no_reg']").val();
            var jenis   = $("[name='jenis']").val();
            var url     = "<?php echo site_url('persetujuan/reset');?>/"+jenis+"/"+no_reg;
            window.location = url;
            return false; 
        });
        $(".cetak").click(function(){
            var no_reg          = $("[name='no_reg']").val();
            var no_pasien       = $("[name='no_pasien']").val();
            var url = "<?php echo site_url('surat/cetakpemulasaran');?>/"+no_reg+"/"+no_pasien;
            openCenteredWindow(url);
        });
    });
    function getttd(){
        var ttd_saksi = "<?php echo $ttd_saksi;?>";
        var ttd_pernyataan = "<?php echo $ttd_pernyataan;?>";
        $('#signature').signature('enable').signature('draw', ttd_saksi);
        $('#signature2').signature('enable').signature('draw', ttd_pernyataan);
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
<div class="col-xs-12 margin">
    <div class="box box-primary">
        <div class="box-header">
            <h3>SURAT PERNYATAAN</h3>
        </div>
        <div class="box-body">
            <?php echo form_open("surat/simpanpemulasaran/".$aksi,array("class"=>"form-horizontal formsave"));?>
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
                    <input type="text" required name="nama" class="form-control" value="<?php echo $nama ?>" <?php echo $ubah;?>>
                </div>
                <label class="col-sm-2 control-label">Jenis Kelamin</label>
                <div class="col-sm-2">
                    <select class="form-control" name="jk" required <?php echo $ubah;?>>
                        <option>----</option>
                        <option value="L" <?php if ($jk=="L"): ?>
                            selected
                        <?php endif ?>>Laki-Laki</option>
                        <option value="P" <?php if ($jk=="P"): ?>
                            selected
                        <?php endif ?>>Perempuan</option>
                    </select>
                </div>
                <label class="col-sm-2 control-label">Umur</label>
                <div class="col-sm-2">
                    <input type="text" required name="umur" class="form-control" value="<?php echo $umur ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2">
                    Pekerjaan / Jabatan
                </label>
                <div class="col-sm-10">
                    <input type="text" required name="pekerjaan" class="form-control" value="<?php echo $pekerjaan ?>" <?php echo $ubah;?>>
                </div>
            </div> -->
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
                <label class="col-sm-2">
                    Saksi
                </label>
                <div class="col-sm-10">
                    <input type="text" required name="saksi" class="form-control" value="<?php echo $saksi ?>" <?php echo $ubah;?>>
                </div>
            </div>
            <?php if ($setuju!="") : ?>
            <div class="form-group">
                <label class="col-sm-2">
                    Menyatakan
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $setuju ?>" readonly>
                </div>
            </div>
            <?php endif ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <h4>Tanda Tangan Pembuat Pernyataan</h4>
                    <input type="hidden" name="ttd_pernyataan" id="signatureJSON2">
                    <div id="signature2"></div>
                </div>
                <div class="col-xs-12">
                    <h4>Tanda Tangan Saksi</h4>
                    <input type="hidden" name="ttd_saksi" id="signatureJSON">
                    <div id="signature"></div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <!-- <button class="back btn btn-danger" type="button"><i class="fa fa-arrow-left"></i> Back</button> -->
                    <input type="hidden" name="setuju">
                    <input type="hidden" name="alasan_tdksetuju">
                    <?php if ($aksi=="simpan"): ?>
                    <button class="setuju btn btn-primary" type="button"><i class="fa fa-check"></i> Setuju</button>
                    <button class="tdksetuju btn btn-danger" type="button"><i class="fa fa-remove"></i> Tdk Setuju</button>
                    <?php endif ?>
                    <?php if ($aksi=="edit"): ?>
                        <button class="cetak btn btn-success" type="button"><i class="fa fa-print"></i> Cetak</button>
                    <?php endif ?>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<div class='modal modal-alasan no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Alasan Tidak Setuju</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <textarea class="form-control" name="alasan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type='button'class="simpan btn btn-success">Simpan</button>
            </div>
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
</style>