<script>
    $(document).ready(function() {
      $(".back").click(function(){
          var url = "<?php echo site_url('dokter/rawat_jalandokter');?>";
          window.location = url;
          return false;
      });
    });
</script>
<div class="col-md-12">
    <?php
    if ($this->session->flashdata('message')) {
        $pesan = explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-" . $pesan[0] . "' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>" . $pesan[1] . "</b>
            </div>";
    }

    ?>
    <?php
    if ($q) {
        $instruksi_medik  = explode(",",$q->instruksi_medik);
        $heparinisasi1    = $q->heparinisasi1;
        $heparinisasi2    = $q->heparinisasi2;
        $heparinisasi3    = $q->heparinisasi3;
        $heparinisasi4    = $q->heparinisasi4;
        $heparinisasi5    = $q->heparinisasi5;
        $heparinisasi6    = $q->heparinisasi6;
        $diagnosa_kerja   = $q->diagnosa_kerja;
        $pengobatan_tindakan = explode(",",$q->pengobatan_tindakan);
        $dischart_planning   = explode(",",$q->dischart_planning);
        $akses_vaskuler      = $q->akses_vaskuler;
        $aksi = "edit";
    } else {
        $instruksi_medik         =
        $heparinisasi1=
        $heparinisasi2=
        $heparinisasi3=
        $heparinisasi4=
        $heparinisasi5=
        $heparinisasi6=
        $diagnosa_kerja=
        $pengobatan_tindakan=
        $dischart_planning=
        $akses_vaskuler= "";
        $no_reg         = $no_reg;
        $no_pasien      = $no_pasien;
        $ubah = "";
        $aksi = "simpan";
    }
    // var_dump($aksi);
     ?>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <?php echo form_open_multipart("dokter/simpanhd/" . $aksi, array("id" => "formsave", "class" => "form-horizontal")) ?>
                <div class="form-group">
                    <label class="col-md-1 control-label">No. Reg</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>" />
                    </div>
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='no_pasien' readonly value="<?php echo $no_pasien; ?>" />
                    </div>
                    <label class="col-md-1 control-label">Nama Pasien</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='nama_pasien' value="<?php echo $q1->nama_pasien1; ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
            <h5 class="box-title" value="<?php echo $instruksi_medik ?>" <?php echo $ubah; ?>><b>INSTRUKSI MEDIK</b></h5>
            <div class="form-group">
                <div class="col-sm-2">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik1" value="Inisiasi" <?php echo (isset($instruksi_medik[0]) && $instruksi_medik[0] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Inisiasi</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik2" value="Akut" <?php echo (isset($instruksi_medik[1]) && $instruksi_medik[1] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Akut</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik3" value="Rutin" <?php echo (isset($instruksi_medik[2]) && $instruksi_medik[2] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Rutin</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik4" value="Pre-OP" <?php echo (isset($instruksi_medik[3]) && $instruksi_medik[3] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Pre-OP</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik5" value="SLED" <?php echo (isset($instruksi_medik[4]) && $instruksi_medik[4] != "" ? "checked" : "");?>>
                        <label class="form-check-label">SLED</label>
                    </div>
                    <div class="form-check">
                        <div class="col-sm-8">
                            <input type="text" name="instruksi_medik6" placeholder="..." class="form-control" <?php echo (isset($instruksi_medik[5]) && $instruksi_medik[5] != "" ? "value='".$instruksi_medik[5]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik7" value="Dialisat" <?php echo (isset($instruksi_medik[6]) && $instruksi_medik[6] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Dialisat</label>
                    </div>
                    <div class="form-check">
                        <label class="col-md-1 control-label">TD</label>
                        <div class="col-sm-8">
                            <input type="text" name="instruksi_medik8" placeholder="..." class="form-control" <?php echo (isset($instruksi_medik[7]) && $instruksi_medik[7] != "" ? "value='".$instruksi_medik[7]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik9" value="Bicarbonat" <?php echo (isset($instruksi_medik[8]) && $instruksi_medik[8] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Bicarbonat</label>
                    </div>
                    <div class="form-check">
                        <label class="col-md-1 control-label">QB</label>
                        <div class="col-sm-8">
                            <input type="text" name="instruksi_medik10" placeholder="ml/mnt" class="form-control" <?php echo (isset($instruksi_medik[9]) && $instruksi_medik[9] != "" ? "value='".$instruksi_medik[9]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="instruksi_medik11" value="Prog Profiling" <?php echo (isset($instruksi_medik[10]) && $instruksi_medik[10] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Prog Profiling</label>
                    </div>
                    <div class="form-check">
                        <label class="col-md-1 control-label">QD</label>
                        <div class="col-sm-8">
                            <input type="text" name="instruksi_medik12" placeholder="ml/mnt" class="form-control" <?php echo (isset($instruksi_medik[11]) && $instruksi_medik[11] != "" ? "value='".$instruksi_medik[11]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        <label class="col-md-5 control-label">UF-Goal</label>
                        <div class="col-sm-7">
                            <input type="text" name="instruksi_medik13" placeholder="..." class="form-control" <?php echo (isset($instruksi_medik[12]) && $instruksi_medik[12] != "" ? "value='".$instruksi_medik[12]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        <label class="col-md-5 control-label">Conductifity</label>
                        <div class="col-sm-7">
                            <input type="text" name="instruksi_medik14" placeholder="..." class="form-control" <?php echo (isset($instruksi_medik[13]) && $instruksi_medik[13] != "" ? "value='".$instruksi_medik[13]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        <label class="col-md-5 control-label">Na</label>
                        <div class="col-sm-7">
                            <input type="text" name="instruksi_medik15" placeholder="..." class="form-control" <?php echo (isset($instruksi_medik[14]) && $instruksi_medik[14] != "" ? "value='".$instruksi_medik[14]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        <label class="col-md-5 control-label">Temperatur</label>
                        <div class="col-sm-7">
                            <input type="text" name="instruksi_medik16" placeholder="..." class="form-control" <?php echo (isset($instruksi_medik[15]) && $instruksi_medik[15] != "" ? "value='".$instruksi_medik[15]."'" : "");?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        <label class="col-md-1 control-label">UF</label>
                        <div class="col-sm-8">
                            <input type="text" name="instruksi_medik17" placeholder="..." class="form-control" <?php echo (isset($instruksi_medik[16]) && $instruksi_medik[16] != "" ? "value='".$instruksi_medik[16]."'" : "");?>>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
            <h5 class="box-title"><b>HEPARINISASI</b></h5>
                <div class="form-group">
                    <label class="col-md-2 control-label">Dosis Sirkulasi</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="ui/jam" name='heparinisasi1' value="<?php echo $heparinisasi1; ?>" <?php echo $ubah; ?>/>
                    </div>
                    <label class="col-md-2 control-label">Dosis Maintanance : continue :</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="ui/jam" name='heparinisasi2' value="<?php echo $heparinisasi2; ?>" <?php echo $ubah; ?>/>
                    </div>
                    <label class="col-md-2 control-label">Intermitten</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="ui/jam" name='heparinisasi3' value="<?php echo $heparinisasi3; ?>" <?php echo $ubah; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">LMPH</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="..." name='heparinisasi4' value="<?php echo $heparinisasi4; ?>" <?php echo $ubah; ?>/>
                    </div>
                    <label class="col-md-2 control-label">Tanpa Heparin, penyebab :</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="..." name='heparinisasi5' value="<?php echo $heparinisasi5; ?>" <?php echo $ubah; ?>/>
                    </div>
                    <label class="col-md-2 control-label">Program  bilas NaCl 0,9 % 100cc /jam / ½ jam</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="..." name='heparinisasi6' value="<?php echo $heparinisasi6; ?>" <?php echo $ubah; ?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Diagnosa Kerja :</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name='diagnosa_kerja' value="<?php echo $diagnosa_kerja; ?>" <?php echo $ubah; ?>/>
                    </div>
                </div>
            <h5 class="box-title" value="<?php echo $pengobatan_tindakan ?>" <?php echo $ubah; ?>><b>Pengobatan dan Tindakan</b></h5>
            <div class="form-group">
                <div class="col-sm-2">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan1" value="HD Rutin" <?php echo (isset($pengobatan_tindakan[0]) && $pengobatan_tindakan[0] != "" ? "checked" : "");?>>
                        <label class="form-check-label">HD Rutin</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan2" value="Asam Folat 2x1" <?php echo (isset($pengobatan_tindakan[1]) && $pengobatan_tindakan[1] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Asam Folat 2x1</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan3" value="Bicnat Tab 3x1" <?php echo (isset($pengobatan_tindakan[2]) && $pengobatan_tindakan[2] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Bicnat Tab 3x1</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan4" value="Calos 2X1" <?php echo (isset($pengobatan_tindakan[3]) && $pengobatan_tindakan[3] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Calos 2x1</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan5" value="Epodion 3000iu" <?php echo (isset($pengobatan_tindakan[4]) && $pengobatan_tindakan[4] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Epodion 3000iu</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan6" value="Rhinofer 1 ampul" <?php echo (isset($pengobatan_tindakan[5]) && $pengobatan_tindakan[5] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Rhinofer 1 ampul</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan7" value="Amlodipin 10mg 1x1 tab" <?php echo (isset($pengobatan_tindakan[6]) && $pengobatan_tindakan[6] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Amlodipin 10mg 1x1 tab</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pengobatan_tindakan8" value="Ranitidine tab 2x1" <?php echo (isset($pengobatan_tindakan[7]) && $pengobatan_tindakan[7] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Ranitidine tab 2x1</label>
                    </div>
                    <div class="form-check">
                        <div class="col-sm-8">
                            <input type="text" name="pengobatan_tindakan9" placeholder="..." class="form-control" <?php echo (isset($pengobatan_tindakan[8]) && $pengobatan_tindakan[8] != "" ? "value='".$pengobatan_tindakan[8]."'" : "");?>>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="box-title" value="<?php echo $dischart_planning ?>" <?php echo $ubah; ?>><b>DISCHART PLANNING</b></h5>
            <div class="form-group">
                <div class="col-sm-5">
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dischart_planning1" value="Perawatan Akses" <?php echo (isset($dischart_planning[0]) && $dischart_planning[0] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Perawatan Akses</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dischart_planning2" value="Pasien boleh pulang dan kembali pada" <?php echo (isset($dischart_planning[1]) && $dischart_planning[1] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Pasien boleh pulang dan kembali pada</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dischart_planning3" value="Anjurkan untuk taat diet dengan kenaikan berat badan maksimal 2kg" <?php echo (isset($dischart_planning[2]) && $dischart_planning[2] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Anjurkan untuk taat diet dengan kenaikan berat badan maksimal 2kg</label>
                    </div>
                    <div class="form-check">
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dischart_planning4" value="Pasien masuk rawat inap" <?php echo (isset($dischart_planning[3]) && $dischart_planning[3] != "" ? "checked" : "");?>>
                        <label class="form-check-label">Pasien masuk rawat inap</label>
                    </div>
                    <div class="form-check">
                        <div class="col-sm-8">
                            <input type="text" name="dischart_planning5" placeholder="..." class="form-control" <?php echo (isset($dischart_planning[4]) && $dischart_planning[4] != "" ? "value='".$dischart_planning[4]."'" : "");?>>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                    <label class="col-md-2 control-label">Akses Vaskuler oleh :</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name='akses_vaskuler' value="<?php echo $akses_vaskuler; ?>" <?php echo $ubah; ?>/>
                    </div>
            </div>
        </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                    <button class="back btn btn-warning" type="reset">Batal</button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
