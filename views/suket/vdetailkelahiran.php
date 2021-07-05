<?php
$t1 = new DateTime($q1->tgl_keluar);
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
            var url = "<?php echo site_url('pendaftaran/cetakkelahiran'); ?>/" + no_reg + "/" + no_rm + "/"+ jenis;
            openCenteredWindow(url);
            return false;
        });
        $(".cetak2").click(function() {
            var no_rm = "<?php echo $no_rm; ?>";
            var no_reg = "<?php echo $no_reg; ?>";
            var jenis = "<?php echo $jenis; ?>";
            var url = "<?php echo site_url('pendaftaran/cetakkelahiran2'); ?>/" + no_reg + "/" + no_rm + "/" +jenis;
            openCenteredWindow(url);
            return false;
        });
        $('.back').click(function() {
            window.location = "<?php echo site_url('suket/listkelahiran'); ?>";
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
                        <input type="text" name="nomor_surat" class="form-control" readonly value="<?php echo $q2->nomor_surat ?>/ SKM/ <?php echo $bulan[(int)(date("m", strtotime($q->tgl_lahir)))] . "/ " . date("Y", strtotime($q->tgl_lahir)); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Istri</label>
                    <div class="col-sm-4">
                        <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $q->ibu; ?>">
                    </div>
                    <label class="col-sm-2 control-label">Umur</label>
                    <?php
                    if ($q->tgllahir_ibu == "1970-01-01" || $q->tgllahir_ibu == "") {
                        $umur_ibu = "-";
                    } else {
                        list($year, $month, $day) = explode("-", $q->tgllahir_ibu);
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
                        $umur_ibu = $year_diff . " Tahun";
                    }
                    ?>
                    <div class="col-sm-3">
                        <input type="text" name="umur_ibu" class="form-control" readonly value="<?php echo $umur_ibu ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Suami</label>
                    <div class="col-sm-4">
                        <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $q->nama_pasangan; ?>">
                    </div>
                </div>
                <?php
                $hari = date("w", strtotime($q->tgl_lahir));
                $h = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" name="tgl_keluar" class="form-control" readonly value="<?php echo $h[$hari] . ", " . ($q->tgl_lahir == "" ? "" : date("d-m-Y", strtotime($q->tgl_lahir))); ?>">
                    </div>
                    <label class="col-sm-2 control-label">Jam Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" name="jam_keluar" class="form-control" readonly value="<?php echo ($q->jamlahir == "" ? "" : date("H:i", strtotime($q->jamlahir))); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <input type="text" name="no_pasien" class="form-control" readonly value="<?php echo ($q->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan") ?>">
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
                            <label class="col-md-3 control-label">Berat Badan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="berat_badan" value="<?php echo $q->berat_badan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Panjang Badan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="panjang_badan" readonly value="<?php echo $q->panjang_badan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kelahiran Ke</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kelahiran" readonly value="<?php echo $q->kelahiran_ke ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tindakan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="tindakan" readonly value="<?php echo $q->tindakan_bayi ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kembar</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kembar" readonly value="<?php echo $q->kembar ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kelainan Bawaan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kelainan_bawaan" readonly value="<?php echo $q->kelainan_bawaan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Kepala</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_kepala" readonly value="<?php echo $q->lingkar_kepala ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Dada</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_dada" readonly value="<?php echo $q->lingkar_dada ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Lengan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_lengan" readonly value="<?php echo $q->lingkar_lengan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Perut</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_perut" readonly value="<?php echo $q->lingkar_perut ?>">
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
                    <button class="btn-sm cetak2 btn btn-success" type="button"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>