<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('dokter/jadwal_dokter');?>";
            window.location = url;
            return false;
        });
           var formattgl = "yy-mm-dd";
        $("input[name='tgl_sip']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });

        $("#lama, #baru").keyup(function() {
            var lama  = $("#lama").val();
            var baru = $("#baru").val();

            var total = parseInt(lama) + parseInt(baru);
            $("#total").val(total);
        });
        $("#lama1, #baru1").keyup(function() {
            var lama  = $("#lama1").val();
            var baru = $("#baru1").val();

            var total = parseInt(lama) + parseInt(baru);
            $("#total1").val(total);
        });
        $("#lama2, #baru2").keyup(function() {
            var lama  = $("#lama2").val();
            var baru = $("#baru2").val();

            var total = parseInt(lama) + parseInt(baru);
            $("#total2").val(total);
        });
        $("#lama3, #baru3").keyup(function() {
            var lama  = $("#lama3").val();
            var baru = $("#baru3").val();

            var total = parseInt(lama) + parseInt(baru);
            $("#total3").val(total);
        });
        $("#lama4, #baru4").keyup(function() {
            var lama  = $("#lama4").val();
            var baru = $("#baru4").val();

            var total = parseInt(lama) + parseInt(baru);
            $("#total4").val(total);
        });
        $("#lama5, #baru5").keyup(function() {
            var lama  = $("#lama5").val();
            var baru = $("#baru5").val();

            var total = parseInt(lama) + parseInt(baru);
            $("#total5").val(total);
        });
        $("#lama6, #baru6").keyup(function() {
            var lama  = $("#lama6").val();
            var baru = $("#baru6").val();

            var total = parseInt(lama) + parseInt(baru);
            $("#total6").val(total);
        });
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
    if ($q) {
        $id_jdokter=$q->id_jdokter;
        $dokter=$q->id_dokter;
        $poli=$q->id_poli;
        $waktu=$q->waktu;
        $hari=$q->hari;
        $har = explode(",", $hari);
        $har1 = $har[1];
        $har2 = $har[2];
        $har3 = $har[3];
        $har4 = $har[4];
        $har5 = $har[5];
        $har6 = $har[6];
        $har0 = $har[0];

        $jam = explode(",", $q->jam);
        $j1 = $jam[1];
        $j2 = $jam[2];
        $j3 = $jam[3];
        $j4 = $jam[4];
        $j5 = $jam[5];
        $j6 = $jam[6];
        $j0 = $jam[0];

        $jam2 = explode(",", $q->jam2);
        $jm1 = $jam2[1];
        $jm2 = $jam2[2];
        $jm3 = $jam2[3];
        $jm4 = $jam2[4];
        $jm5 = $jam2[5];
        $jm6 = $jam2[6];
        $jm0 = $jam2[0];

        $lama = explode(",", $q->lama);
        $l1 = $lama[1];
        $l2 = $lama[2];
        $l3 = $lama[3];
        $l4 = $lama[4];
        $l5 = $lama[5];
        $l6 = $lama[6];
        $l0 = $lama[0];

        $baru = explode(",", $q->baru);
        $b1 = $baru[1];
        $b2 = $baru[2];
        $b3 = $baru[3];
        $b4 = $baru[4];
        $b5 = $baru[5];
        $b6 = $baru[6];
        $b0 = $baru[0];

        $r = "readonly";
        $aksi = "edit";
    } else {
        $id_jdokter=
        $dokter=
        $poli=
        $waktu=
        $har1=
        $har2=
        $har3=
        $har4=
        $har5=
        $har6=
        $har0=
        $j1=
        $j2=
        $j3=
        $j4=
        $j5=
        $j6=
        $j0=
        $jm1=
        $jm2=
        $jm3=
        $jm4=
        $jm5=
        $jm6=
        $jm0=
        $l1=
        $l2=
        $l3=
        $l4=
        $l5=
        $l6=
        $l0=
        $b1=
        $b2=
        $b3=
        $b4=
        $b5=
        $b6=
        $b0=
        $r = "";
        $aksi = "simpan";
    }
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open("dokter/simpanjadwaldokter/".$aksi,array("class"=>"form-horizontal"));?>
            <input type="hidden" name="id_jdokter" value='<?=$id_jdokter;?>'>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Dokter</label>
                <div class="col-sm-10">
                    <select name="nama_dokter" class="form-control">
                     <?php
                         foreach ($q1->result() as $value) {
                           echo "<option value='".$value->id_dokter."'".($dokter==$value->id_dokter ? "selected" : "").">".$value->nama_dokter."</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Poli</label>
                <div class="col-sm-10">
                    <select name="nama_poli" class="form-control">
                     <?php
                         foreach ($q2->result() as $value) {
                           echo "<option value='".$value->kode."'".($poli==$value->kode ? "selected" : "").">".$value->keterangan."</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Waktu</label>
                <div class="col-sm-10">
                    <select name="waktu" class="form-control">
                        <option value="PAGI" <?php echo $w1;?>>Pagi</option>
                        <option value="SORE" <?php echo $w2;?>>Sore</option>
                    </select>
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Hari</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="hari1" value="1" <?php if ($har1==1): ?>
                        checked
                    <?php endif ?>> Senin
                    <input type="checkbox" name="hari2" value="1" <?php if ($har2==1): ?>
                        checked
                    <?php endif ?>> Selasa
                    <input type="checkbox" name="hari3" value="1" <?php if ($har3==1): ?>
                        checked
                    <?php endif ?>> Rabu
                    <input type="checkbox" name="hari4" value="1" <?php if ($har4==1): ?>
                        checked
                    <?php endif ?>> Kamis
                    <input type="checkbox" name="hari5" value="1" <?php if ($har5==1): ?>
                        checked
                    <?php endif ?>> Jumat
                    <input type="checkbox" name="hari6" value="1" <?php if ($har6==1): ?>
                        checked
                    <?php endif ?>> Sabtu
                    <input type="checkbox" name="hari0" value="1" <?php if ($har0==1): ?>
                        checked
                    <?php endif ?>> Minggu
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jam Senin</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jam_senin" value="<?=$j1;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="text-center form-control" value="-" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jm_senin" value="<?=$jm1;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="lama" name="l_senin" placeholder="Lama" value="<?=$l1;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="baru" name="b_senin" placeholder="Baru" value="<?=$b1;?>">
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="total" readonly placeholder="Total">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jam Selasa</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jam_selasa" value="<?=$j2;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="text-center form-control" value="-" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jm_selasa" value="<?=$jm2;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="lama1" name="l_selasa" placeholder="Lama" value="<?=$l2;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="baru1" name="b_selasa" placeholder="Baru" value="<?=$b2;?>">
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="total1" readonly placeholder="Total">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jam Rabu</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jam_rabu" value="<?=$j3;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="text-center form-control" value="-" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jm_rabu" value="<?=$jm3;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="lama2" name="l_rabu" placeholder="Lama" value="<?=$l3;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="baru2" name="b_rabu" placeholder="Baru" value="<?=$b3;?>">
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="total2" readonly placeholder="Total">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jam Kamis</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jam_kamis" value="<?=$j4;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="text-center form-control" value="-" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jm_kamis" value="<?=$jm4;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="lama3" name="l_kamis" placeholder="Lama" value="<?=$l4;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="baru3" name="b_kamis" placeholder="Baru" value="<?=$b4;?>">
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="total3" readonly placeholder="Total">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jam Jumat</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jam_jumat" value="<?=$j5;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="text-center form-control" value="-" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jm_jumat" value="<?=$jm5;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="lama4" name="l_jumat" placeholder="Lama" value="<?=$l5;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="baru4" name="b_jumat" placeholder="Baru" value="<?=$b5;?>">
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="total4" readonly placeholder="Total">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jam Sabtu</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jam_sabtu" value="<?=$j6;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="text-center form-control" value="-" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jm_sabtu" value="<?=$jm6;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="lama5" name="l_sabtu" placeholder="Lama" value="<?=$l6;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="baru5" name="b_sabtu" placeholder="Baru" value="<?=$b6;?>">
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="total5" readonly placeholder="Total">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jam Minggu</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jam_minggu" value="<?=$j0;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="text-center form-control" value="-" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="jm_minggu" value="<?=$jm0;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="lama6" name="l_minggu" placeholder="Lama" value="<?=$l0;?>">
                </div>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="baru6" name="b_minggu" placeholder="Baru" value="<?=$b0;?>">
                </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="total6" readonly placeholder="Total">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                     <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="back btn btn-warning" type="reset">Batal</button>

                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
