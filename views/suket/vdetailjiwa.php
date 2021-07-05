<?php
$t1 = new DateTime($q1->tanggal);
$t2 = new DateTime($q->tgl_lahir);
$y  = $t1->diff($t2)->y;
$m  = $t1->diff($t2)->m;
$d  = $t1->diff($t2)->d;

list($year, $month, $day) = explode("-", $q->tgl_lahir);
$year_diff  = date("Y") - $year;
$month_diff = date("m") - $month;
$day_diff   = date("d") - $day;
if ($month_diff < 0) {
    $year_diff--;
    $month_diff *= (-1);
} elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
if ($day_diff < 0) {
    $day_diff *= (-1);
}
$umur = $year_diff . " Tahun";
$bulan = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
?>
<script>
    var mywindow;

    function openCenteredWindow(url) {
        var width = 1200;
        var height = 500;
        var left = parseInt((screen.availWidth / 2) - (width / 2));
        var top = parseInt((screen.availHeight / 2) - (height / 2));
        var windowFeatures = "width=" + width + ",height=" + height +
            ",status,resizable,left=" + left + ",top=" + top +
            ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(e) {
        $(".cetak").click(function() {
            var no_rm = "<?php echo $no_rm; ?>";
            var no_reg = "<?php echo $no_reg; ?>";
            var jenis = "<?php echo $jenis; ?>";
            var url = "<?php echo site_url('pendaftaran/cetakjiwa'); ?>/" + no_reg + "/" + no_rm + "/" + jenis;
            openCenteredWindow(url);
            return false;
        });
        $('.back').click(function() {
            window.location = "<?php echo site_url('suket/listjiwa'); ?>";
        });
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">No. Surat</label>
                    <div class="col-sm-9">
                        <input type="text" name="nomor_surat" class="form-control" readonly value="<?php echo $q2->nomor_surat ?>/ SKN/ <?php echo $bulan[(int)(date("m", strtotime($q2->tgl_insert)))] . "/ " . date("Y", strtotime($q2->tgl_insert)); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Pasien</label>
                    <div class="col-sm-4">
                        <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $q->nama_pasien; ?>">
                    </div>
                    <?php
                    $hari = date("w", strtotime($q->tgl_lahir));
                    $h = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                    ?>
                    <label class="col-sm-2 control-label">Taggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" name="umur_ibu" class="form-control" readonly value="<?php echo $h[$hari] . ", " . ($q->tgl_lahir == "" ? "" : date("d-m-Y", strtotime($q->tgl_lahir))); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Pekerjaan</label>
                    <div class="col-sm-4">
                        <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $q->nama_pekerjaan; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" name="no_pasien" class="form-control" readonly value="<?php echo $q->alamat; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Hasil 1</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="hasil1" value="<?php echo $q2->hasil1 ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Hasil 2</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="hasil2" readonly value="<?php echo $q2->hasil2 ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Keperluan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="untuk" readonly value="<?php echo $q2->untuk ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sampai Tanggal</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="tanggal" readonly value="<?php echo date("d-m-Y", strtotime($q2->batastgl)) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dokter</label>
                            <div class="col-sm-9">
                                <input type="text" name="dokter" class="form-control" readonly value="Dr. Luhur Artsonugroho, Sp. KJ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn-sm back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="btn-sm cetak btn btn-primary" type="button"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>