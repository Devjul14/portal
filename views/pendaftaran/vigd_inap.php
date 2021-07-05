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
    $(document).ready(function(){
        $("[name='dokter1'],[name='dokter2'],[name='dokter3']").select2();
        if ($("[name='pemeriksaan_fisik1']").val()=="1"){
            $("[name='kelainan1']").hide();
        }
        else {
            $("[name='kelainan1']").show();
        }
        if ($("[name='pemeriksaan_fisik2']").val()=="1"){
            $("[name='kelainan2']").hide();
        }
        else {
            $("[name='kelainan2']").show();
        }
        if ($("[name='pemeriksaan_fisik3']").val()=="1"){
            $("[name='kelainan3']").hide();
        }
        else {
            $("[name='kelainan3']").show();
        }
        if ($("[name='pemeriksaan_fisik4']").val()=="1"){
            $("[name='kelainan4']").hide();
        }
        else {
            $("[name='kelainan4']").show();
        }
        if ($("[name='pemeriksaan_fisik5']").val()=="1"){
            $("[name='kelainan5']").hide();
        }
        else {
            $("[name='kelainan5']").show();
        }
        if ($("[name='pemeriksaan_fisik6']").val()=="1"){
            $("[name='kelainan6']").hide();
        }
        else {
            $("[name='kelainan6']").show();
        }
        if ($("[name='pemeriksaan_fisik7']").val()=="1"){
            $("[name='kelainan7']").hide();
        }
        else {
            $("[name='kelainan7']").show();
        }
        if ($("[name='pemeriksaan_fisik8']").val()=="1"){
            $("[name='kelainan8']").hide();
        }
        else {
            $("[name='kelainan8']").show();
        }
        if ($("[name='pemeriksaan_fisik9']").val()=="1"){
            $("[name='kelainan9']").hide();
        }
        else {
            $("[name='kelainan9']").show();
        }
        if ($("[name='pemeriksaan_fisik10']").val()=="1"){
            $("[name='kelainan10']").hide();
        }
        else {
            $("[name='kelainan10']").show();
        }
        if ($("[name='pemeriksaan_fisik11']").val()=="1"){
            $("[name='kelainan11']").hide();
        }
        else {
            $("[name='kelainan11']").show();
        }
        $("[name='jenis_nyeri']").hide();
        $("[name='lokasi']").hide();
        $("[name='frekuensi']").hide();
        $("[name='durasi']").hide();
        $("[name='diantar']").hide();
        $("[name='rujuk_ke']").hide();
        $("[name='alasan_rujuk']").hide();
        $("[name='skrining_gizi2']").hide();
        $("[name='pemeriksaan_fisik1']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan1']").hide();
            }
            else {
                $("[name='kelainan1']").show();
            }
        });
        $(".upload").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var id = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/formuploadpdf_inap');?>/"+no_rm+"/"+id;
            window.location = url;
            return false; 
        });
        $("[name='pemeriksaan_fisik2']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan2']").hide();
            }
            else {
                $("[name='kelainan2']").show();
            }
        });
        $("[name='pemeriksaan_fisik3']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan3']").hide();
            }
            else {
                $("[name='kelainan3']").show();
            }
        });
        $("[name='pemeriksaan_fisik4']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan4']").hide();
            }
            else {
                $("[name='kelainan4']").show();
            }
        });
        $("[name='pemeriksaan_fisik5']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan5']").hide();
            }
            else {
                $("[name='kelainan5']").show();
            }
        });
        $("[name='pemeriksaan_fisik6']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan6']").hide();
            }
            else {
                $("[name='kelainan6']").show();
            }
        });
        $("[name='pemeriksaan_fisik7']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan7']").hide();
            }
            else {
                $("[name='kelainan7']").show();
            }
        });
        $("[name='pemeriksaan_fisik8']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan8']").hide();
            }
            else {
                $("[name='kelainan8']").show();
            }
        });
        $("[name='pemeriksaan_fisik9']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan9']").hide();
            }
            else {
                $("[name='kelainan9']").show();
            }
        });
        $("input[name='gcs']").on('input', function () {
            var gcs = $("[name='kesadaran']").val();
            var min = 0; var max=100;
            if (gcs=="Compos Metis") { min=14; max=15 } else 
            if (gcs=="Apatis") { min=12; max=13 } else 
            if (gcs=="Somnolen") { min=10; max=11 } else 
            if (gcs=="Delirium") { min=7; max=9 } else 
            if (gcs=="Sopor") { min=4; max=6 } else 
            if (gcs=="Coma") { min=3; max=3 }
            var value = $(this).val();
            if ((value !== '') && (value.indexOf('.') === -1)) {
                $(this).val(Math.max(Math.min(value, max), min));
            }
        });
        $("[name='pemeriksaan_fisik10']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan10']").hide();
            }
            else {
                $("[name='kelainan10']").show();
            }
        });
        $("[name='pemeriksaan_fisik11']").change(function(){
            if ($(this).val()=="1"){
                $("[name='kelainan11']").hide();
            }
            else {
                $("[name='kelainan11']").show();
            }
        });
        if ($("[name='nyeri']").val() == "YA"){
            $("[name='jenis_nyeri']").show();
            $("[name='lokasi']").show();
            $("[name='frekuensi']").show();
            $("[name='durasi']").show();
        } else {
            $("[name='jenis_nyeri']").hide();
            $("[name='lokasi']").hide();
            $("[name='frekuensi']").hide();
            $("[name='durasi']").hide();
        }
        // if ($("[name='kedatangan']").val() == "Diantar Oleh"){
        //     $("[name='diantar']").show();
        // } else {
        //     $("[name='diantar']").hide();
        // }
        // if ($("[name='kedatangan']").val() == "Diantar Oleh"){
        //     $("[name='diantar']").show();
        // } else {
        //     $("[name='diantar']").hide();
        // }
        if ($("[name='tindak_lanjut']").val() == "Rujuk"){
            $("[name='rujuk_ke']").show();
            $("[name='alasan_rujuk']").show();
        } else {
            $("[name='rujuk_ke']").hide();
            $("[name='alasan_rujuk']").hide();
        }
        if ($("[name='skrining_gizi']").val() == "> 2"){
            $("[name='skrining_gizi2']").show();
        } else {
            $("[name='skrining_gizi2']").hide();
        }
        $("[name='nyeri']").change(function(){
            if ($("[name='nyeri']").val() == "YA"){
                $("[name='jenis_nyeri']").show();
                $("[name='lokasi']").show();
                $("[name='frekuensi']").show();
                $("[name='durasi']").show();
            }else if($("[name='nyeri']").val() != "YA"){
                $("[name='jenis_nyeri']").hide();
                $("[name='lokasi']").hide();
                $("[name='frekuensi']").hide();
                $("[name='durasi']").hide();
            }
        });
        // $("[name='kedatangan']").change(function(){
        //     if ($("[name='kedatangan']").val() == "Diantar Oleh"){
        //         $("[name='diantar']").show();
        //     }else if($("[name='kedatangan']").val() != "Diantar Oleh"){
        //         $("[name='diantar']").hide();
        //     }
        // });
        $("[name='tindak_lanjut']").change(function(){
            if ($("[name='tindak_lanjut']").val() == "Rujuk"){
                $("[name='rujuk_ke']").show();
                $("[name='alasan_rujuk']").show();
            }else if($("[name='tindak_lanjut']").val() != "Rujuk"){
                $("[name='rujuk_ke']").hide();
                $("[name='alasan_rujuk']").hide();
            }
        });
        $("[name='skrining_gizi']").change(function(){
            if ($("[name='skrining_gizi']").val() == "> 2"){
                $("[name='skrining_gizi2']").show();
            }else if($("[name='skrining_gizi']").val() != " > 2"){
                $("[name='skrining_gizi2']").hide();
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal_masuk']").datepicker({
            dateFormat : formattgl,
        });
        $('.back').click(function(){
            window.location = "<?php echo site_url('dokter/rawat_inapdokter_ranap');?>";
            
        });
        $('.cetak').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var id_dokter= $("[name='dokter_igd']").val();
            var url = "<?php echo site_url('dokter/cetakigdinap');?>/"+no_reg+"/"+id_dokter;
            openCenteredWindow(url);
        });
        $('.terapi').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var no_rm= $("[name='no_rm']").val();
            var id_dokter= $("[name='dokter_igd']").val();
            if(id_dokter==""){
                alert("Dokter IGD pada menu triage wajib diisi");
            } else {
                window.location ="<?php echo site_url('dokter/apotek_igdinap');?>/"+no_rm+"/"+no_reg+"/"+id_dokter;
                return false;
            }
        });
        $('.anatomi').click(function(){
            var no_rm= $("[name='no_rm']").val();
            var no_reg= $("[name='no_reg']").val();
            window.location ="<?php echo site_url('assesmen/getanatomi_inap');?>/"+no_reg;
            return false;
        });
        $('.lunas').click(function(){
            $(".modalnotif").modal("show");
            var total = $("[name='total']").val();
            $(".total").html("Rp. "+total);
        });
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>kasir/hapustindakan",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $(".ambil").click(function(){
            var url = "<?php echo site_url('dokter/ambiltriage');?>/";
            openCenteredWindow(url);
            return false;
        });
        $("select[name='dokter']").change(function(){
            var rad = $(this).find(':selected').attr('data-id');
            $("input[name='radiologi']").val(rad);
        });
         // $(".Books_Illustrations").select2("val", ["a", "c"]);
        $(".tindakan_radiologi").select2();
        $(".tindakan_lab").select2();
        $(".penunjang").select2();
        $("select[name='kedatangan']").select2();
        $("select[name='terapi1']").select2();
        $("select[name='keputusan']").select2();

        // $("textarea[name='hasil_pemeriksaan']").change(function(){
    
                // $("textarea[name='hasil_pemeriksaan']").wysihtml5();
        // });

    });
</script>
<?php
    for ($i=0;$i<=11;$i++){
        $pemeriksaan_fisik[$i] = 1;
    }
    if ($q1) {
        $dokter_poli = $q1->dokter_igd;
        $tanggal_masuk      = $t->tanggal;
        $jam_masuk      = $t->jam;
        $jam_periksa      = $t->waktu_keputusan;
        $jam_keluar_igd      = $q1->jam_keluar_igd;
        $nyeri      = $q1->nyeri;
        $jenis_nyeri      = $q1->jenis_nyeri;
        $resiko_jatuh      = $q1->resiko_jatuh;
        $skrining_gizi      = $q1->skrining_gizi;
        $keluhan_utama      = $q1->keluhan_utama;
        $kronologis_kejadian      = $q1->kronologis_kejadian;
        $anamnesa      = $q1->anamnesa;
        $riwayat_penyakit      = $q1->riwayat_penyakit;
        $obat_dikonsumsi      = $q1->obat_dikonsumsi;
        $skrining_gizi2 = $q1->skrining_gizi2; 
        $pemeriksaan_penunjang      = $q1->penunjang;
        $diagnosis_kerja     = $q1->diagnosis_kerja;
        $dd     = $q1->dd;
        $terapi     = $q1->terapi;
        $observasi     = $q1->observasi;
        $waktu     = $q1->waktu;
        $assesment     = $q1->assesment;
        $s = $q1->s;
        $o = $q1->o;
        $a     = $q1->a;
        $p     = $q1->p;
        $tindak_lanjut     = $q1->tindak_lanjut;
        $ruang     = $q1->ruang;
        $rujuk_ke     = $q1->rujuk_ke;
        $alasan_rujuk     = $q1->alasan_rujuk;
        $lokasi     = $q1->lokasi;
        $pengirim     = $q1->pengirim;
        $frekuensi     = $q1->frekuensi;
        $durasi     = $q1->durasi;
        $kedatangan     = $q1->kedatangan;
        $diantar     = $q1->diantar;
        $riwayat_alergi     = $q1->riwayat_alergi;
        $tindakan_radiologi     = $q1->tindakan_radiologi;
        $tindakan_lab     = $q1->tindakan_lab;
        $nama_pasien = $q1->nama_pasien;
        $kelainan = explode("|", $q1->kelainan);
        $kesadaran = $q1->kesadaran;
        $e = $q1->e;
        $v = $q1->v;
        $m = $q1->m;
        if ($q1->pemeriksaan_fisik!="")
        $pemeriksaan_fisik = explode(",", $q1->pemeriksaan_fisik);
        $jam_meninggal      = $q1->jam_meninggal;
        $nama_kelas = 
        $nama_ruangan = 
        $kode_kelas =
        $kode_kamar ="";
        $gcs = $q1->gcs;
    } else {
        $dokter_poli = "";
        $tanggal_masuk  = "";
        $gcs = "";
        $jam_masuk      =
        $jam_periksa      =
        $jam_keluar_igd      =
        $nyeri      =
        $jenis_nyeri =
        $resiko_jatuh      =
        $skrining_gizi      =
        $keluhan_utama      =
        $kronologis_kejadian      =
        $anamnesa   =
        $riwayat_penyakit      =
        $obat_dikonsumsi      =
        $pemeriksaan_penunjang      =
        $diagnosis_kerja     =
        $dd     =
        $terapi     =
        $observasi     =
        $waktu     =
        $assesment     =
        $pengirim =
        $s = 
        $o = 
        $a     =
        $p     =
        $jam_meninggal = 
        $tindak_lanjut     =
        $ruang     =
        $rujuk_ke     =
        $alasan_rujuk     =
        $lokasi     =
        $frekuensi     =
        $durasi     =
        $kedatangan = 
        $riwayat_alergi     =
        $diantar =
        $tindakan_radiologi =
        $tindakan_lab = 
        $nama_kelas = 
        $nama_pasien = 
        $nama_ruangan = 
        $kode_kelas =
        $skrining_gizi2 = 
        $kesadaran =  
        $e = $v = $m = 
        $kode_kamar = "";
    }
    if ($p1->num_rows()>0){
        $p1 = $p1->row();
        $td      = $p1->td;
        $td2      = $p1->td2;
        $nadi      = $p1->nadi;
        $respirasi      = $p1->respirasi;
        $suhu      = $p1->suhu;
        $spo2      = $p1->spo2;
        $bb      = $p1->bb;
        $tb      = $p1->tb;
        $tglgejala = explode(",", $p1->tglgejala);
        $tglresiko = explode(",", $p1->tglresiko);
        $status = $p1->status;
        $prov = $p1->prov;
        $kota = $p1->kota;
        $tingkat_status = $p1->tingkat_status;
        $status_assesmen = $p1->status_assesmen;
    } else {
        $td      =
        $td2      =
        $nadi      =
        $respirasi      =
        $suhu      =
        $spo2      =
        $bb      =
        $status = 
        $prov = 
        $kota = 
        $tglgejala = 
        $tglresiko = 
        $tingkat_status =
        $status_assesmen =
        $tb      = "";
    }
    list($year,$month,$day) = explode("-",$q1->tgl_lahir);
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
?>
<div class="col-md-12">
    <?php
        echo form_open("dokter/simpanigdinap/".$no_reg,array("id"=>"formsave","class"=>"form-horizontal"));
    ?>
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
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="hidden" readonly class="form-control" name='dokter_igd' readonly value="<?php echo $dokter_poli;?>"/>
                        <input type="hidden" readonly class="form-control" name='tanggal_masuk' readonly value="<?php echo $tanggal_masuk;?>"/>
                        <input type="hidden" readonly class="form-control" name='jam_masuk' readonly value="<?php echo $jam_masuk;?>"/>
                        <input type="hidden" readonly class="form-control" name='jam_periksa' readonly value="<?php echo $jam_periksa;?>"/>
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_pasien' value="<?php echo $nama_pasien;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Umur</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='umur' value="<?php echo $umur;?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Kedatangan</label>
                <div class="col-md-4">
                    <select name="kedatangan" class="form-control">
                            <option value="Datang Sendiri" <?php if ($q1->kedatangan=="Datang Sendiri"): ?>
                                selected
                            <?php endif ?>>Datang Sendiri</option>
                            <option value="Rujukan RS" <?php if ($q1->kedatangan=="Rujukan RS"): ?>
                                selected
                            <?php endif ?>>Rujukan RS</option>
                            <option value="Rujukan Dokter" 
                            <?php if ($q1->kedatangan=="Rujukan Dokter"): ?>
                                selected
                            <?php endif ?>>Rujukan Dokter</option>
                            <option value="Rujukan Paramedis" <?php if ($q1->kedatangan=="Rujukan Paramedis"): ?>
                                selected
                            <?php endif ?>>Rujukan Paramedis</option>
                            <option value="Rujukan Puskesmas" <?php if ($q1->kedatangan=="Rujukan Puskesmas"): ?>
                                selected
                            <?php endif ?>>Rujukan Puskesmas</option>
                            <option value="Rujukan Kepolisian" <?php if ($q1->kedatangan=="Rujukan Kepolisian"): ?>
                                selected
                            <?php endif ?>>Rujukan Kepolisian</option>
                            <option value="Rujukan Lain" <?php if ($q1->kedatangan=="Rujukan Lain"): ?>
                                selected
                            <?php endif ?>>Rujukan Lain</option>
                        </select>
                </div>
                <label class="col-md-2 control-label">Pengirim</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name='pengirim' value="<?php echo $pengirim;?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">TD Kanan</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" readonly name='td' value="<?php echo $td;?>"/>
                </div>
                <label class="col-md-1 control-label">TD Kiri</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" readonly name='td2' value="<?php echo $td2;?>"/>
                </div>
                <label class="col-md-2 control-label">Nadi</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" readonly name='nadi' value="<?php echo $nadi;?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Respirasi</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" readonly name='respirasi' value="<?php echo $respirasi;?>"/>
                </div>
                <label class="col-md-1 control-label">Suhu</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" readonly name='suhu' value="<?php echo $suhu;?>"/>
                </div>
                <label class="col-md-2 control-label">SpO2</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" readonly name='spo2' value="<?php echo $spo2;?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">BB</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" readonly readonly name='bb' value="<?php echo $bb;?>"/>
                </div>
                <label class="col-md-1 control-label">TB</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" readonly name='tb' value="<?php echo $tb;?>"/>
                </div>
                <label class="col-md-2 control-label">Jam Meninggal</label>
                <div class="col-md-3">
                    <input type="time" class="form-control" name='jam_meninggal' value="<?php echo $jam_meninggal;?>"/>
                </div>
            </div> 
            <div class='form-group'>
                <label class='col-md-2 control-label'>Demam</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='tglgejala' readonly value='<?php echo $tglgejala[1];?>'/>
                </div>
                <label class='col-md-1 control-label'>Panas</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='tglgejala' readonly value='<?php echo $tglgejala[2];?>'/>
                </div>
                <label class='col-md-2 control-label'>Batuk</label>
                <div class='col-md-3'>
                    <input type='text' class='form-control tglgejala' readonly name='tglgejala' value='<?php echo $tglgejala[3];?>'/>
                </div>
            </div> 
            <div class='form-group'>
                <label class='col-md-2 control-label'>Pilek</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='tglgejala' readonly value='<?php echo $tglgejala[4];?>'/>
                </div>
                <label class='col-md-1 control-label'>Sesak</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='tglgejala' readonly value='<?php echo $tglgejala[5];?>'/>
                </div>
                <label class='col-md-2 control-label'>Sakit Tenggorokan</label>
                <div class='col-md-3'>
                    <input type='text' class='form-control' name='tglgejala' readonly value='<?php echo $tglgejala[6];?>'/>
                </div>
            </div> 
            <div class='form-group'>
                <label class='col-md-2 control-label'>Riwayat perjalanan / Singgah</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='tglresiko' readonly value='<?php echo $tglresiko[0];?>'/>
                </div>
                <label class='col-md-1 control-label'>s.d</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='tglresiko' readonly value='<?php echo $tglresiko[1];?>'/>
                </div>
                <label class='col-md-2 control-label'>Diare</label>
                <div class='col-md-3'>
                    <input type='text' class='form-control' name='tglgejala' readonly value='<?php echo $tglgejala[0];?>'/>
                </div>
            </div>
            <div class='form-group'>
                <label class='col-md-2 control-label'>Propinsi</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='prov' readonly value='<?php echo $prov;?>'/>
                </div>
                <label class='col-md-1 control-label'>Kota</label>
                <div class='col-md-7'>
                    <input type='text' class='form-control' name='kota' readonly value='<?php echo $kota;?>'/>
                </div>
            </div> 
            <div class='form-group'>
                <label class='col-md-2 control-label'>Status</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='status' readonly value='<?php echo $status;?>'/>
                </div>
                <label class='col-md-3 control-label'>Riwayat kontak COVID-19</label>
                <div class='col-md-5'>
                    <input type='text' class='form-control' name='tglresiko' readonly value='<?php echo $tglresiko[2];?>'/>
                </div>
            </div> 
            <div class='form-group'>
                <label class='col-md-2 control-label'>Tingkat Status</label>
                <div class='col-md-2'>
                    <input type='text' class='form-control' name='tingkat_status' readonly value='<?php echo $tingkat_status;?>'/>
                </div>
                <label class='col-md-3 control-label'>Status Assesment</label>
                <div class='col-md-5'>
                    <input type='text' class='form-control' name='status_assesmen' readonly value='<?php echo $status_assesmen;?>'/>
                </div>
            </div> 
            <div class="form-group">
                <label class="col-md-2 control-label">Kesadaran</label>
                <div class="col-md-6">
                    <select name="kesadaran" id="" class="form-control">
                        <option value="">---</option>
                        <option value="Compos Metis"  <?php echo ($kesadaran=="Compos Metis" ? "selected" : "");?>>Compos Metis</option>
                        <option value="Apatis"  <?php echo ($kesadaran=="Apatis" ? "selected" : "");?>>Apatis</option>
                        <option value="Somnolen"  <?php echo ($kesadaran=="Somnolen" ? "selected" : "");?>>Somnolen</option>
                        <option value="Delirium"  <?php echo ($kesadaran=="Delirium" ? "selected" : "");?>>Delirium</option>
                        <option value="Sopor"  <?php echo ($kesadaran=="Sopor" ? "selected" : "");?>>Sopor</option>
                        <option value="Coma"  <?php echo ($kesadaran=="Coma" ? "selected" : "");?>>Coma</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <input type="number" class="form-control" placeholder="GCS" name='gcs' value="<?php echo $gcs;?>"/>
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control" placeholder="E" name='e' value="<?php echo $e;?>"/>
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control" placeholder="V" name='v' value="<?php echo $v;?>"/>
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control" placeholder="M" name='m' value="<?php echo $m;?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nyeri</label>
                <div class="col-md-2">
                    <select name="nyeri" id="" class="form-control">
                        <option value="">---</option>
                        <option value="YA"  <?php echo ($nyeri=="YA" ? "selected" : "");?>>YA</option>
                        <option value="TIDAK"  <?php echo ($nyeri=="TIDAK" ? "selected" : "");?>>Tidak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="jenis_nyeri" id="" class="form-control">
                        <option value="Nyeri Akut" <?php echo ($jenis_nyeri=="Nyeri Akut" ? "selected" : "");?>>Nyeri Akut</option>
                        <option value="Nyeri Kronis" <?php echo ($jenis_nyeri=="Nyeri Kronis" ? "selected" : "");?>>Nyeri Kronis</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Lokasi" name='lokasi' value="<?php echo $lokasi;?>"/>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Frekuensi" name='frekuensi' value="<?php echo $frekuensi;?>"/>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Durasi" name='durasi' value="<?php echo $durasi;?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Resiko Jatuh</label>
                <div class="col-md-4">
                    <select name="resiko_jatuh" id="" class="form-control">
                        <option value="">---</option>
                        <option value="Resiko Rendah Morse (0-24)" <?php echo ($resiko_jatuh=="Resiko Rendah Morse (0-24)" ? "selected" : "");?>>Resiko Rendah Morse (0-24)</option>
                        <option value="Resiko Sedang Morse (25-50)" <?php echo ($resiko_jatuh=="Resiko Sedang Morse (25-50)" ? "selected" : "");?>>Resiko Sedang Morse (25-50)</option>
                        <option value="Resiko Tinggi Morse (>= 51)" <?php echo ($resiko_jatuh=="Resiko Tinggi Morse (>= 51)" ? "selected" : "");?>>Resiko Tinggi Morse (>= 51)</option>
                        <option value="Resiko Rendah Humpty Dumpty (7-11)" <?php echo ($resiko_jatuh=="Resiko Rendah Humpty Dumpty (7-11)" ? "selected" : "");?>>Resiko Rendah Humpty Dumpty (7-11)</option>
                        <option value="Resiko Tinggi Humpty Dumpty (>= 12)" <?php echo ($resiko_jatuh=="Resiko Tinggi Humpty Dumpty (>= 12)" ? "selected" : "");?>>Resiko Tinggi Humpty Dumpty (>= 12)</option>
                    </select>
                </div>
                <label class="col-md-2 control-label">Riwayat Alergi</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name='riwayat_alergi' value="<?php echo $riwayat_alergi;?>"/>
                </div>
            </div>
            <div class="form-group">
                
                <label class="col-md-2 control-label">Skrining Gizi Awal</label>
                <div class="col-md-4">
                    <select name="skrining_gizi" id="" class="form-control">
                        <option value="">---</option>
                        <option value="< 2" <?php echo ($skrining_gizi=="< 2" ? "selected" : "");?>> > 2</option>
                        <option value="> 2" <?php echo ($skrining_gizi=="> 2" ? "selected" : "");?>> < 2 / Diagnosis khusus sudah dilaporkan ke tim terapi Gizi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="skrining_gizi2" id="" class="form-control">
                        <option value="">---</option>
                        <option value="Ya" <?php echo ($skrining_gizi2=="Ya" ? "selected" : "");?>>Ya</option>
                        <option value="Tidak" <?php echo ($skrining_gizi2=="Tidak" ? "selected" : "");?>>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tindakan Radiologi</label>
                <div class="col-md-2">
                    <select class="form-control tindakan_radiologi"  name="tindakan_radiologi[]" multiple="multiple">
                        <option value="">-----</option>
                        <?php
                            foreach ($radiologi->result() as $key) {
                                $t = explode(",", $tindakan_radiologi);
                                if (count($t)>0){
                                    foreach ($t as $k => $value) {
                                        echo "<option value='".$key->id_tindakan."' ".($key->id_tindakan==$value ? "selected" : "").">".$key->nama_tindakan."</option>";
                                    }
                                } else {
                                    echo "<option value='".$key->id_tindakan."' ".($key->id_tindakan==$tindakan_radiologi ? "selected" : "").">".$key->nama_tindakan."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2 control-label">Tindakan Lab</label>
                <div class="col-md-2">
                    <select class="form-control tindakan_lab" name="tindakan_lab[]" multiple="multiple">
                        <option value="">-----</option>
                        <?php
                            foreach ($lab->result() as $key) {
                                $t = explode(",", $tindakan_lab);
                                if (count($t)>0){
                                    foreach ($t as $k => $value) {
                                        echo "<option value='".$key->kode_tindakan."' ".($key->kode_tindakan==$value ? "selected" : "").">".$key->nama_tindakan."</option>";
                                    }
                                } else {
                                    echo "<option value='".$key->kode_tindakan."' ".($key->kode_tindakan==$tindakan_lab ? "selected" : "").">".$key->nama_tindakan."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2 control-label">Tindakan Lain Lain</label>
                <div class="col-md-2">
                    <select class="form-control penunjang"  name="penunjang[]" multiple="multiple">
                        <option value="">-----</option>
                        <?php
                            foreach ($tarif_penunjang_medis->result() as $key) {
                                $t = explode(",", $pemeriksaan_penunjang);
                                if (count($t)>0){
                                    foreach ($t as $k => $value) {
                                        echo "<option value='".$key->kode."' ".($key->kode==$value ? "selected" : "").">".$key->ket."</option>";
                                    }
                                } else {
                                    echo "<option value='".$key->kode."' ".($key->kode==$pemeriksaan_penunjang ? "selected" : "").">".$key->ket."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <!-- <label class="col-md-2 control-label">Keluhan Utama</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="keluhan_utama" style="max-width: 100%;height:100px;"><?php echo $keluhan_utama ?></textarea>
                </div> -->
                <label class="col-md-2 control-label">Kronologis Kejadian</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="kronologis_kejadian" style="max-width: 100%;height:100px;"><?php echo $kronologis_kejadian?></textarea>
                </div>
                <!-- <label class="col-md-2 control-label">Anamnesa</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="anamnesa" style="max-width: 100%;height:100px;"><?php echo $anamnesa?></textarea>
                </div> -->
                <label class="col-md-2 control-label">Riwayat Penyakit</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="riwayat_penyakit" style="max-width: 100%;height:100px;"><?php echo $riwayat_penyakit ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Obat - obatan yang dikonsumsi</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="obat_dikonsumsi" style="max-width: 100%;height:100px;"><?php echo $obat_dikonsumsi ?></textarea>
                </div>
                <label class="col-md-2 control-label">Observasi</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="observasi" style="max-width: 100%;height:100px;"><?php echo $observasi ?></textarea>
                </div>
                <!-- <label class="col-md-2 control-label">Pemeriksaan Penunjang</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="pemeriksaan_penunjang" style="max-width: 100%;height:100px;"><?php //echo $pemeriksaan_penunjang ?></textarea>
                </div> -->
            </div>
            <!-- <div class="form-group">
                <label class="col-md-2 control-label">Diagnosis Kerja</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="diagnosis_kerja" style="max-width: 100%;height:100px;"><?php echo $diagnosis_kerja ?></textarea>
                </div>
                <label class="col-md-2 control-label">DD</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="dd" style="max-width: 100%;height:100px;"><?php echo $dd ?></textarea>
                </div>
            </div> -->
            <!-- <div class="form-group"> -->
                <!-- <label class="col-md-2 control-label">Terapi</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="terapi" style="max-width: 100%;height:50px;"><?php echo $terapi ?></textarea>
                </div> -->
            <!-- </div> -->
            <div class="form-group">
                <label class="col-md-2 control-label">Waktu</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="waktu" style="max-width: 100%;height:50px;"><?php echo $waktu ?></textarea>
                </div>
                <!-- <label class="col-md-2 control-label">Assesment</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="assesment" style="max-width: 100%;height:50px;"><?php echo $assesment ?></textarea>
                </div> -->
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">S</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="s"  style="max-width: 100%;height:160px;"><?php echo $s ?></textarea>
                </div>
                <label class="col-md-2 control-label">O</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="o"  style="max-width: 100%;height:160px;"><?php echo $o ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">A</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="a" style="max-width: 100%;height:160px;"><?php echo $a ?></textarea>
                </div>
                <label class="col-md-2 control-label">P</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="p" style="max-width: 100%;height:160px;"><?php echo $p ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="form-group">
                <label class="col-md-2 control-label">Pemeriksaan Fisik</label>
                <label class="col-md-8 control-label">Kelainan/ Keluhan</label>
                <label class="col-md-2 control-label"></label>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kepala</label>
                <div class="col-md-2">
                    <select class="form-control" name="pemeriksaan_fisik1">
                        <option value="0" <?php echo ($pemeriksaan_fisik[0]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[0]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan1' value="<?php echo (isset($kelainan[0]) ? $kelainan[0] : '');?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Mata</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik2">
                        <option value="0" <?php echo ($pemeriksaan_fisik[1]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[1]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan2' value="<?php echo (isset($kelainan[1]) ? $kelainan[1] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">THT</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik3">
                        <option value="0" <?php echo ($pemeriksaan_fisik[2]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[2]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan3' value="<?php echo (isset($kelainan[2]) ? $kelainan[2] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Gigi Mulut</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik4">
                        <option value="0" <?php echo ($pemeriksaan_fisik[3]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[3]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan4' value="<?php echo (isset($kelainan[3]) ? $kelainan[3] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Leher</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik5">
                        <option value="0" <?php echo ($pemeriksaan_fisik[4]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[4]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan5' value="<?php echo (isset($kelainan[4]) ? $kelainan[4] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Thoraks</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik6">
                        <option value="0" <?php echo ($pemeriksaan_fisik[5]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[5]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan6' value="<?php echo (isset($kelainan[5]) ? $kelainan[5] : '');?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Abdomen</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik7">
                        <option value="0" <?php echo ($pemeriksaan_fisik[6]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[6]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan7' value="<?php echo (isset($kelainan[6]) ? $kelainan[6] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Ekstremitas Atas</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik8">
                        <option value="0" <?php echo ($pemeriksaan_fisik[7]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[7]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan8' value="<?php echo (isset($kelainan[7]) ? $kelainan[7] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Ekstremitas Bawah</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik9">
                        <option value="0" <?php echo ($pemeriksaan_fisik[8]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[8]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan9' value="<?php echo (isset($kelainan[8]) ? $kelainan[8] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Genitalia</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik10">
                        <option value="0" <?php echo ($pemeriksaan_fisik[9]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[9]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan10' value="<?php echo (isset($kelainan[9]) ? $kelainan[9] : '');?>"/>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Anus</label>
                <div class="col-md-2">
                     <select class="form-control" name="pemeriksaan_fisik11">
                        <option value="0" <?php echo ($pemeriksaan_fisik[10]==0 ? "selected" : "");?>>Tidak Normal</option>
                        <option value="1" <?php echo ($pemeriksaan_fisik[10]==1 || $pemeriksaan_fisik[0]=="" ? "selected" : "");?>>Normal</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name='kelainan11' value="<?php echo (isset($kelainan[10]) ? $kelainan[10] : '');?>"/>
                </div>
            </div>
            <?php
                $doktersp = array();
                $dijawab = array();
                $via = array();
                foreach ($sp->result() as $value) {
                    $doktersp[] = $value;
                    // $doktersp[] = $value->dokter_konsul;
                    // $dijawab[$value->dokter_konsul] = $value->dijawab;
                    // $via[$value->dokter_konsul] = $value->via;
                } 
            ?>
            <input type="hidden" name="dokter1_lama" value="<?php echo (isset($doktersp[0]) ? $doktersp[0]->dokter_konsul : "");?>">
            <input type="hidden" name="dokter2_lama" value="<?php echo (isset($doktersp[1]) ? $doktersp[1]->dokter_konsul : "");?>">
            <input type="hidden" name="dokter3_lama" value="<?php echo (isset($doktersp[2]) ? $doktersp[2]->dokter_konsul : "");?>">
            <div class="form-group">
                <label class="col-md-2 control-label">Dokter SP 1</label>
                <div class="col-md-2">
                    <select name="dokter1" class="form-control">
                        <option value="">---</option>
                        <?php 
                            foreach ($dokter->result() as $key){
                                echo "<option value = '".$key->id_dokter."' ".(isset($doktersp[0]) ? ($key->id_dokter==$doktersp[0]->dokter_konsul ? "selected" : "") : "").">".$key->nama_dokter."</option>";
                            }    
                        ?>
                    </select>
                </div>
                <label class="col-md-2 control-label">Via</label>
                <div class="col-md-2">
                    <select name="via1" class="form-control">
                        <option <?php echo (isset($doktersp[0]) ? ($doktersp[0]->via=="" ? "selected" : "") : "");?> value="">---</option>
                        <option <?php echo (isset($doktersp[0]) ? ($doktersp[0]->via=="Whatsapp" ? "selected" : "") : "");?> value="Whatsapp">Whatsapp</option>
                        <option <?php echo (isset($doktersp[0]) ? ($doktersp[0]->via=="Telpon" ? "selected" : "") : "");?> value="Telpon">Telpon</option>
                        <option <?php echo (isset($doktersp[0]) ? ($doktersp[0]->via=="Tatap Langsung" ? "selected" : "") : "");?> value="Tatap Langsung">Tatap Langsung</option>
                        <option <?php echo (isset($doktersp[0]) ? ($doktersp[0]->via=="Diruangan" ? "selected" : "") : "");?> value="Diruangan">Diruangan</option>
                    </select>
                </div>
                <div class="dijawab1">
                    <label class="col-md-2 control-label">Dijawab</label>
                    <div class="col-md-2">
                        <select name="dijawab1" class="form-control">
                            <option value="0" <?php echo (isset($doktersp[0]) ? ($doktersp[0]->dijawab==0 ? "selected" : "") : "");?>>Belom</option>
                            <option value="1" <?php echo (isset($doktersp[0]) ? ($doktersp[0]->dijawab==1 ? "selected" : "") : "");?>>Sudah</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Dokter SP 2</label>
                <div class="col-md-2">
                    <select name="dokter2" class="form-control">
                        <option value="">---</option>
                        <?php 
                            foreach ($dokter->result() as $key){
                                echo "<option value = '".$key->id_dokter."' ".(isset($doktersp[1]) ? ($key->id_dokter==$doktersp[1]->dokter_konsul ? "selected" : "") : "").">".$key->nama_dokter."</option>";
                            }    
                        ?>
                    </select>
                </div>
                <label class="col-md-2 control-label">Via</label>
                <div class="col-md-2">
                    <select name="via2" class="form-control">
                        <option <?php echo (isset($doktersp[1]) ? ($doktersp[1]->via=="" ? "selected" : "") : "");?> value="">---</option>
                        <option <?php echo (isset($doktersp[1]) ? ($doktersp[1]->via=="Whatsapp" ? "selected" : "") : "");?> value="Whatsapp">Whatsapp</option>
                        <option <?php echo (isset($doktersp[1]) ? ($doktersp[1]->via=="Telpon" ? "selected" : "") : "");?> value="Telpon">Telpon</option>
                        <option <?php echo (isset($doktersp[1]) ? ($doktersp[1]->via=="Tatap Langsung" ? "selected" : "") : "");?> value="Tatap Langsung">Tatap Langsung</option>
                        <option <?php echo (isset($doktersp[1]) ? ($doktersp[1]->via=="Diruangan" ? "selected" : "") : "");?> value="Diruangan">Diruangan</option>
                    </select>
                </div>
                <div class="dijawab2">
                    <label class="col-md-2 control-label">Dijawab</label>
                    <div class="col-md-2">
                        <select name="dijawab2" class="form-control">
                            <option value="0" <?php echo (isset($doktersp[1]) ? ($doktersp[1]->dijawab==0 ? "selected" : "") : "");?>>Belom</option>
                            <option value="1" <?php echo (isset($doktersp[1]) ? ($doktersp[1]->dijawab==1 ? "selected" : "") : "");?>>Sudah</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Dokter SP 3</label>
                <div class="col-md-2">
                    <select name="dokter3" class="form-control">
                        <option value="">---</option>
                        <?php 
                            foreach ($dokter->result() as $key){
                                echo "<option value = '".$key->id_dokter."' ".(isset($doktersp[2]) ? ($key->id_dokter==$doktersp[2]->dokter_konsul ? "selected" : "") : "").">".$key->nama_dokter."</option>";
                            }    
                        ?>
                    </select>
                </div>
                <label class="col-md-2 control-label">Via</label>
                <div class="col-md-2">
                    <select name="via3" class="form-control">
                        <option <?php echo (isset($doktersp[2]) ? ($doktersp[2]->via=="" ? "selected" : "") : "");?> value="">---</option>
                        <option <?php echo (isset($doktersp[2]) ? ($doktersp[2]->via=="Whatsapp" ? "selected" : "") : "");?> value="Whatsapp">Whatsapp</option>
                        <option <?php echo (isset($doktersp[2]) ? ($doktersp[2]->via=="Telpon" ? "selected" : "") : "");?> value="Telpon">Telpon</option>
                        <option <?php echo (isset($doktersp[2]) ? ($doktersp[2]->via=="Tatap Langsung" ? "selected" : "") : "");?> value="Tatap Langsung">Tatap Langsung</option>
                        <option <?php echo (isset($doktersp[2]) ? ($doktersp[2]->via=="Diruangan" ? "selected" : "") : "");?> value="Diruangan">Diruangan</option>
                    </select>
                </div>
                <div class="dijawab3">
                    <label class="col-md-2 control-label">Dijawab</label>
                    <div class="col-md-2">
                        <select name="dijawab3" class="form-control">
                            <option value="0" <?php echo (isset($doktersp[2]->dijawab) ? ($doktersp[2]->dijawab==0 ? "selected" : "") : "");?>>Belom</option>
                            <option value="1" <?php echo (isset($doktersp[2]->dijawab) ? ($doktersp[2]->dijawab==1 ? "selected" : "") : "");?>>Sudah</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-left">
                <div class="btn-group">
                    <button class="anatomi btn bg-navy" type="button">Anatomi</button>
                    <button class="terapi btn bg-maroon" type="button">Terapi</button>
                    <button class="upload btn btn-md btn-primary" type="button"> PDF</button>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="cetak btn btn-primary" type="button"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php echo form_close(); ?>
</div>
<div class="modal fade modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy">Yakin akan membayar sejumlah</div>
            <div class="modal-body">
                <h2 class="total"></h2>
            </div>
            <div class="modal-footer">
                <button class="okbayar btn btn-success" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff;
    }
</style>