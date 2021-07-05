<?php
    $t1 = new DateTime($q1->tgl_keluar);
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
    $umur = $year_diff." Tahun";
    $bulan = array("","I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
?>
<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 1200;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(e){
        $(".cetak").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var jenis = "<?php echo $jenis;?>";
            var url = "<?php echo site_url('pendaftaran/kematian');?>/"+no_reg+"/"+no_rm+"/"+jenis;
            openCenteredWindow(url);
            return false;
        });
        $('.back').click(function(){
            window.location = "<?php echo site_url('suket/listkematian');?>";
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
                        <input type="text" name="nomor_surat" class="form-control" readonly value="<?php echo $q2->nomor_surat ?>/ SKM/ <?php echo $bulan[(int)(date("m",strtotime($q1->tgl_keluar)))]."/ ".date("Y",strtotime($q1->tgl_keluar));?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Pasien</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo $q->nama_pasien ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Reg</label>
                    <div class="col-sm-4">
                        <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $no_reg ?>">
                    </div>
                    <label class="col-sm-2 control-label">No RM</label>
                    <div class="col-sm-3">
                        <input type="text" name="no_rm" class="form-control" readonly value="<?php echo $no_rm ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Umur</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo $umur; ?>">
                    </div>
                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <input type="text" name="no_pasien" class="form-control" readonly value="<?php echo ($q->jenis_kelamin=="L" ? "Laki-Laki" : "Perempuan") ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Meninggal</label>
                    <div class="col-sm-4">
                        <input type="text" name="tgl_keluar" class="form-control" readonly value="<?php echo ($q1->tgl_keluar=="" ? "" : date("d-m-Y",strtotime($q1->tgl_keluar))); ?>">
                    </div>
                    <label class="col-sm-2 control-label">Jam Meninggal</label>
                    <div class="col-sm-3">
                        <input type="text" name="jam_keluar" class="form-control" readonly value="<?php echo ($q1->jam_keluar=="" ? "" : date("H:i",strtotime($q1->jam_keluar))); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Pangkat/ Golongan</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo ($q->nama_pangkat=="" ? "-" : $q->nama_pangkat) ?>">
                    </div>
                    <label class="col-sm-2 control-label">Kesatuan</label>
                    <div class="col-sm-3">
                        <input type="text" name="no_pasien" class="form-control" readonly value="<?php echo ($q->nama_kesatuan=="" ? "-" : $q->nama_kesatuan);?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">NRP/ NIP</label>
                    <div class="col-sm-4">
                        <input type="text" name="nip" class="form-control" readonly value="<?php echo ($q->nip=="" ? "-" : $q->nip) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo $q->alamat; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Diagnosa</label>
                    <div class="col-sm-4">
                        <input type="text" name="diagnosa_akhir" class="form-control" readonly value="<?php echo $q3->diagnosa_akhir; ?>">
                    </div>
                    <label class="col-sm-2 control-label">Dokter</label>
                    <div class="col-sm-3">
                        <input type="text" name="dokter" class="form-control" readonly value="<?php echo $q1->nama_dpjp; ?>">
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
