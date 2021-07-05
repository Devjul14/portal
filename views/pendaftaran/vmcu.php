<link rel="stylesheet" href="<?php echo base_url();?>plugins/select2/select2.css">
<script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
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
 var mywindow1;
    function openCenteredWindow1(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow1 = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
        var diagnosa = $("[name='diagnosa']").val();
        namadiagnosa(diagnosa,"nama_diagnosa");
        $("[name='nama_diagnosa']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                $("[name='diagnosa']").val('');
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>pendaftaran/getdiagnosa1",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='diagnosa']").val(n[0]);
                return n[1];
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='ulangan']").datepicker({
            dateFormat : formattgl,
        });

        $(".cetak").click(function(){
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_mcu');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $(".cetakresume").click(function(){
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetakmcu_resume');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $(".cetakidentitas").click(function(){
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetakmcu_identitas');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_noreg:cari_noreg},
                url   : "<?php echo site_url('pendaftaran/getcaripasien_ralan');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        // $("[name='diagnosa']").select2();
        $("[name='tindakan']").select2();
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");


    });
    function namadiagnosa(kode,element){
        var data = $.ajax({
                        url : "<?php echo base_url();?>pendaftaran/namadiagnosa",
                        method : "POST",
                        async: false,
                        data : {kode: kode}
                    }).responseText;
        $("[name='"+element+"']").val(data);
    }
</script>
<?php
    $t1 = new DateTime('today');
    $t2 = new DateTime($q->tgl_lahir);
    $y  = $t1->diff($t2)->y;
    $m  = $t1->diff($t2)->m;
    $d  = $t1->diff($t2)->d;
    if($row){
        $keluhan_penyakit      = $row->keluhan_penyakit;
        $penyakit_berat        = $row->penyakit_berat;
        $alergi                = $row->alergi;
        $merokok               = $row->merokok;
        $obat_rutin            = $row->obat_rutin;
        $olahraga              = $row->olahraga;
        $riwayat_penyakitkel   = $row->riwayat_penyakitkel;
        $ket_keluhan_penyakit      = $row->ket_keluhan_penyakit;
        $ket_penyakit_berat        = $row->ket_penyakit_berat;
        $ket_alergi                = $row->ket_alergi;
        $ket_merokok               = $row->ket_merokok;
        $ket_obat_rutin            = $row->ket_obat_rutin;
        $ket_riwayat_penyakitkel   = $row->ket_riwayat_penyakitkel;
        $makan_minum           = $row->makan_minum;
        $ket_makan_minum           = $row->ket_makan_minum;
        $tinggi_badan          = $row->tinggi_badan;
        $berat_badan           = $row->berat_badan;
        $tekanan_darah         = $row->tekanan_darah;
        $nadi                  = $row->nadi;
        $anemik                = $row->anemik;
        $respirasi             = $row->respirasi;
        $ikterik               = $row->ikterik;
        $rate_rr               = $row->rate_rr;
        $kenal_warna           = $row->kenal_warna;
        $visus_od              = $row->visus_od;
        $visus_os              = $row->visus_os;
        $juling                = $row->juling;
        $ket_juling                = $row->ket_juling;
        $telinga               = $row->telinga;
        $mucosa                = $row->mucosa;
        $ket_mucosa                = $row->ket_mucosa;
        $tonsil                = $row->tonsil;
        $ket_tonsil                = $row->ket_tonsil;
        $gigi                  = $row->gigi;
        $struma                = $row->struma;
        $ket_struma                = $row->ket_struma;
        $jvp                   = $row->jvp;
        $perut                 = $row->perut;
        $dinding_perut         = $row->dinding_perut;
        $nyeri_tekan           = $row->nyeri_tekan;
        $tumor                 = $row->tumor;
        $hernia                = $row->hernia;
        $hati                  = $row->hati;
        $limpa                 = $row->limpa;
        $suara_usus            = $row->suara_usus;
        $bekas_operasi         = $row->bekas_operasi;
        $kulit                 = $row->kulit;
        $dinding_thorax        = $row->dinding_thorax;
        $ket_jvp                   = $row->ket_jvp;
        $ket_perut                 = $row->ket_perut;
        $ket_dinding_perut         = $row->ket_dinding_perut;
        $ket_nyeri_tekan           = $row->ket_nyeri_tekan;
        $ket_tumor                 = $row->ket_tumor;
        $ket_limpa                 = $row->ket_limpa;
        $ket_suara_usus            = $row->ket_suara_usus;
        $ket_bekas_operasi         = $row->ket_bekas_operasi;
        $ket_kulit                 = $row->ket_kulit;
        $ket_dinding_thorax        = $row->ket_dinding_thorax;
        $diam                  = $row->diam;
        $bernafas              = $row->bernafas;
        $paru_paru             = $row->paru_paru;
        $suara_nafas           = $row->suara_nafas;
        $ronchi                = $row->ronchi;
        $suara_jantung         = $row->suara_jantung;
        $ket_paru_paru             = $row->ket_paru_paru;
        $ket_suara_nafas           = $row->ket_suara_nafas;
        $ket_ronchi                = $row->ket_ronchi;
        $ket_suara_jantung         = $row->ket_suara_jantung;
        $irama_jantung         = $row->irama_jantung;
        $ekg_jantung         = $row->ekg_jantung;
        $treadmill         = $row->treadmill;
        $tonus_otot            = $row->tonus_otot;
        $parese                = $row->parese;
        $tremor                = $row->tremor;
        $atrofi                = $row->atrofi;
        $oederma               = $row->oederma;
        $postur_tubuh          = $row->postur_tubuh;
        $kaki                  = $row->kaki;
        $tangan                = $row->tangan;
        $hemoroid              = $row->hemoroid;
        $varises               = $row->varises;
        $ket_tonus_otot            = $row->ket_tonus_otot;
        $ket_parese                = $row->ket_parese;
        $ket_tremor                = $row->ket_tremor;
        $ket_atrofi                = $row->ket_atrofi;
        $ket_oederma               = $row->ket_oederma;
        $ket_postur_tubuh          = $row->ket_postur_tubuh;
        $ket_kaki                  = $row->ket_kaki;
        $ket_tangan                = $row->ket_tangan;
        $ket_hemoroid              = $row->ket_hemoroid;
        $ket_varises               = $row->ket_varises;
        $varicocel             = $row->varicocel;
        $ket_varicocel             = $row->ket_varicocel;

        $atas                  = $row->atas;
        $bawah                 = $row->bawah;
        $ket_atas                  = $row->ket_atas;
        $ket_bawah                 = $row->ket_bawah;
        $lab                   = $row->lab;
        $kesimpulan            = $row->kesimpulan;
        $hepar                 = $row->hepar;
        $ket_hepar             = $row->ket_hepar;
        $lien                  = $row->lien;
        $ket_lien              = $row->ket_lien;
        $ekstremitas           = $row->ekstremitas;
        $ket_kenal_warna       = $row->ket_kenal_warna;
        $ket_gigi              = $row->ket_gigi;
        $ket_diam              = $row->ket_diam;
        $ket_bernafas          = $row->ket_bernafas;
        $ket_hernia            = $row->ket_hernia;
        $ket_hati              = $row->ket_hati;
        $ket_irama_jantung     = $row->ket_irama_jantung;
        $genetalia             = $row->genetalia;
        $ket_genetalia             = $row->ket_genetalia;
        $aksi                  = "edit";
    } else {
        $nadi                  = $q1->nadi;
        $respirasi             = $q1->respirasi;
        $tekanan_darah         = $q1->td;
        $tinggi_badan          = $q1->tb;
        $berat_badan           = $q1->bb;
        $keluhan_penyakit      =
        $ekg_jantung           =
        $treadmill             =
        $penyakit_berat        =
        $alergi                =
        $merokok               =
        $obat_rutin            =
        $olahraga              =
        $riwayat_penyakitkel   =
        $makan_minum           =
        $ket_keluhan_penyakit      =
        $ket_penyakit_berat        =
        $ket_alergi                =
        $ket_merokok               =
        $ket_obat_rutin            =
        $ket_riwayat_penyakitkel   =
        $ket_makan_minum           =
        $anemik                =
        $ikterik               =
        $rate_rr               =
        $kenal_warna           =
        $visus_od              =
        $visus_os              =
        $juling                =
        $ket_juling                =
        $telinga               =
        $mucosa                =
        $tonsil                =
        $ket_mucosa                =
        $ket_tonsil                =
        $gigi                  =
        $struma                =
        $ket_struma                =
        $jvp                   =
        $perut                 =
        $dinding_perut         =
        $nyeri_tekan           =
        $tumor                 =
        $hernia                =
        $hati                  =
        $limpa                 =
        $suara_usus            =
        $bekas_operasi         =
        $kulit                 =
        $dinding_thorax        =
        $ket_jvp                   =
        $ket_perut                 =
        $ket_dinding_perut         =
        $ket_nyeri_tekan           =
        $ket_tumor                 =
        $ket_hernia                =
        $ket_hati                  =
        $ket_limpa                 =
        $ket_suara_usus            =
        $ket_bekas_operasi         =
        $ket_kulit                 =
        $ket_dinding_thorax        =
        $diam                  =
        $bernafas              =
        $paru_paru             =
        $suara_nafas           =
        $ronchi                =
        $suara_jantung         =
        $ket_paru_paru             =
        $ket_suara_nafas           =
        $ket_ronchi                =
        $ket_suara_jantung         =
        $irama_jantung         =
        $tonus_otot            =
        $parese                =
        $tremor                =
        $atrofi                =
        $oederma               =
        $postur_tubuh          =
        $kaki                  =
        $tangan                =
        $hemoroid              =
        $varises               =
        $ket_tonus_otot            =
        $ket_parese                =
        $ket_tremor                =
        $ket_atrofi                =
        $ket_oederma               =
        $ket_postur_tubuh          =
        $ket_kaki                  =
        $ket_tangan                =
        $ket_hemoroid              =
        $ket_varises               =
        $varicocel             =
        $ket_varicocel             =

        $ekg                   =
        $hepar                 =
        $lien                  =
        $ket_hepar                 =
        $ket_lien                  =
        $ket_atas                  =
        $ket_bawah                 =
        $lab                   =
        $kesimpulan            =

        $ket_kenal_warna       =
        $ket_gigi              =
        $ket_diam              =
        $ket_bernafas          =
        $ket_hernia            =
        $ket_hati              =
        $ket_irama_jantung     =
        $genetalia             =
        $ket_genetalia         = 
        $ekstremitas           = "";
        $aksi = "simpan";
    }
?>
<div class="col-md-12">
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
        echo form_open("pendaftaran/simpanmcu/".$aksi,array("id"=>"formsave","class"=>"form-horizontal"));
    ?>
    <!-- <input type="hidden" name="no_pemeriksaan" value="<?php echo $no_pemeriksaan ?>"> -->
    <div class="box box-primary">
        <div class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_pasien' readonly value="<?php echo $q->nama_pasien;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tgl Lahir / Umur</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_pasien' readonly value="<?php echo $q->tgl_lahir.' / '.$y;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Dari Klinik</label>
                    <div class="col-md-2">
                        <input type="hidden" class="form-control" name='tujuan_poli' readonly value="<?php echo $q->tujuan_poli;?>"/>
                        <input type="text" class="form-control" name='dari_klinik' readonly value="<?php echo $q->poli;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Pelayanan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_pasien' readonly value="Rawat Jalan"/>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="form-horizontal">
            <div class="box-body">
                <table class="table table-bordered no-border">
                    <tr>
                        <th colspan="4"><u>ANAMNESE</u></th>
                    </tr>
                    <tr>
                        <th colspan="4">Riwayat Penyakit</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Keluhan yang dirasakan sekarang
                        </td>
                        <td>
                            <select name="keluhan_penyakit" class="form-control">
                                <option value="Ada" <?php if ($keluhan_penyakit=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($keluhan_penyakit=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_keluhan_penyakit" value="<?php echo $ket_keluhan_penyakit;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Penyakit berat yang pernah diderita
                        </td>
                        <td>
                            <select name="penyakit_berat" class="form-control">
                                <option value="Ada" <?php if ($penyakit_berat=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($penyakit_berat=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_penyakit_berat" value="<?php echo $ket_penyakit_berat;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Alergi
                        </td>
                        <td>
                            <select name="alergi" class="form-control">
                                <option value="Ada" <?php if ($alergi=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($alergi=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_alergi" value="<?php echo $ket_alergi;?>"></td>
                    </tr>
                    <tr>
                        <th colspan="4">Kebiasaan</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Merokok
                        </td>
                        <td>
                            <select name="merokok" class="form-control">
                                <option value="Pernah" <?php if ($merokok=="Pernah"): ?>
                                    selected
                                <?php endif ?>>Pernah</option>
                                <option value="Tidak Pernah" <?php if ($merokok=="Tidak Pernah"): ?>
                                    selected
                                <?php endif ?>>Tidak Pernah</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_merokok" value="<?php echo $ket_merokok;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Obat Rutin
                        </td>
                        <td>
                            <select name="obat_rutin" class="form-control">
                                <option value="Ada" <?php if ($obat_rutin=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($obat_rutin=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_obat_rutin" value="<?php echo $ket_obat_rutin;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Olahraga
                        </td>
                        <td>
                            <input type="text" name="olahraga" class="form-control" value="<?php echo $olahraga ?>">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Riwayat Penyakit Keluarga</th>
                        <td>
                            <select name="riwayat_penyakitkel" class="form-control">
                               <option value="Ada" <?php if ($riwayat_penyakitkel=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($riwayat_penyakitkel=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_riwayat_penyakitkel" value="<?php echo $ket_riwayat_penyakitkel;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Makan / Minum
                        </td>
                        <td>
                            <select name="makan_minum" class="form-control">
                               <option value="Teratur" <?php if ($makan_minum=="Teratur"): ?>
                                    selected
                                <?php endif ?>>Teratur</option>
                                <option value="Tidak Teratur" <?php if ($makan_minum=="Tidak Teratur"): ?>
                                    selected
                                <?php endif ?>>Tidak Teratur</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_makan_minum" value="<?php echo $ket_makan_minum;?>"></td>
                    </tr>
                    <tr>
                        <th colspan="4"><u>STATUS GENERALIS</u></th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Tinggi Badan
                        </td>
                        <td colspan="2">
                            <input type="text" name="tinggi_badan" class="form-control" value="<?php echo $tinggi_badan ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Berat Badan
                        </td>
                        <td colspan="2">
                            <input type="text" name="berat_badan" class="form-control" value="<?php echo $berat_badan ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Tekanan Darah
                        </td>
                        <td colspan="2">
                            <input type="text" name="tekanan_darah" class="form-control" value="<?php echo $tekanan_darah ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Nadi
                        </td>
                        <td colspan="2">
                            <input type="text" name="nadi" class="form-control" value="<?php echo $nadi ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Anemik
                        </td>
                        <td colspan="2">
                            <input type="text" name="anemik" class="form-control" value="<?php echo $anemik ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Respirasi
                        </td>
                        <td colspan="2">
                            <input type="text" name="respirasi" class="form-control" value="<?php echo $respirasi ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Ikterik
                        </td>
                        <td colspan="2">
                            <input type="text" name="ikterik" class="form-control" value="<?php echo $ikterik ?>">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4"><u>STATUS LOKALIS</u></th>
                    </tr>
                    <tr>
                        <th colspan="4">Kepala</th>
                    </tr>
                    <tr>
                        <td colspan="4">Mata</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Kenal Warna</td>
                        <td>
                            <select name="kenal_warna" class="form-control">
                                <option value="Baik" <?php if ($kenal_warna=="Baik"): ?>
                                    selected
                                <?php endif ?>>Baik</option>
                                <option value="Tidak Baik" <?php if ($kenal_warna=="Tidak Baik"): ?>
                                    selected
                                <?php endif ?>>Tidak Baik</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_kenal_warna" value="<?php echo $ket_kenal_warna;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Visus OD
                        </td>
                        <td>
                            <input type="text" name="visus_od" class="form-control" value="<?php echo $visus_od ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            VISUS OS
                        </td>
                        <td>
                            <input type="text" name="visus_os" class="form-control" value="<?php echo $visus_od ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            Juling
                        </td>
                        <td>
                            <select name="juling" class="form-control">
                                <option value="Ada" <?php if ($juling=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($juling=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_juling" value="<?php echo $ket_juling;?>"></td>
                    </tr>
                    <tr>
                        <td>Mulut</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Telinga</td>
                        <td>
                            <input type="text" name="telinga" class="form-control" value="<?php echo $telinga ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Mucosa</td>
                        <td>
                            <select name="mucosa" class="form-control">
                                <option value="Normal" <?php if ($mucosa=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($mucosa=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_mucosa" value="<?php echo $ket_mucosa;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Tonsil</td>
                        <td>
                            <select name="tonsil" class="form-control">
                                <option value="Normal" <?php if ($tonsil=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($tonsil=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_tonsil" value="<?php echo $ket_tonsil;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Gigi</td>
                        <td>
                            <select name="gigi" class="form-control">
                                <option value="Normal" <?php if ($gigi=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($gigi=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_gigi" value="<?php echo $ket_gigi;?>"></td>
                    </tr>
                    <tr>
                        <td>Leher</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Struma</td>
                        <td>
                            <select name="struma" class="form-control">
                                <option value="Normal" <?php if ($struma=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($struma=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_struma" value="<?php echo $ket_struma;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>JVP</td>
                        <td>
                            <select name="jvp" class="form-control">
                                <option value="Normal" <?php if ($jvp=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($jvp=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_jvp" value="<?php echo $ket_jvp;?>"></td>
                    </tr>
                    <tr>
                        <td>Dada</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Dinding Thorax</td>
                        <td>
                            <select name="dinding_thorax" class="form-control">
                                <option value="Normal" <?php if ($dinding_thorax=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($dinding_thorax=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_dinding_thorax" value="<?php echo $ket_dinding_thorax;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Diam</td>
                        <td>
                            <select name="irama_jantung" class="form-control">
                                <option value="Simetris" <?php if ($irama_jantung=="Simetris"): ?>
                                    selected
                                <?php endif ?>>Simetris</option>
                                <option value="Tidak Simetris" <?php if ($irama_jantung=="Tidak Simetris"): ?>
                                    selected
                                <?php endif ?>>Tidak Simetris</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_diam" value="<?php echo $ket_diam;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Bernafas</td>
                        <td>
                            <select name="bernafas" class="form-control">
                                <option value="Simetris" <?php if ($bernafas=="Simetris"): ?>
                                    selected
                                <?php endif ?>>Simetris</option>
                                <option value="Tidak Simetris" <?php if ($bernafas=="Tidak Simetris"): ?>
                                    selected
                                <?php endif ?>>Tidak Simetris</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_bernafas" value="<?php echo $ket_bernafas;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Paru-paru</td>
                        <td>
                            <select name="paru_paru" class="form-control">
                                <option value="Normal" <?php if ($paru_paru=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($paru_paru=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_paru_paru" value="<?php echo $ket_paru_paru;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Suara Nafas</td>
                        <td>
                            <select name="suara_nafas" class="form-control">
                                <option value="Normal" <?php if ($suara_nafas=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($suara_nafas=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_suara_nafas" value="<?php echo $ket_suara_nafas;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Ronchi/Wheezing</td>
                        <td>
                            <select name="ronchi" class="form-control">
                                <option value="Ada" <?php if ($ronchi=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($ronchi=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_ronchi" value="<?php echo $ket_ronchi;?>"></td>
                    </tr>
                    <tr>
                        <td>Jantung</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Suara Jantung</td>
                        <td>
                            <select name="suara_jantung" class="form-control">
                                <option value="Normal" <?php if ($suara_jantung=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($suara_jantung=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_suara_jantung" value="<?php echo $ket_suara_jantung;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Irama Jantung</td>
                        <td>
                            <select name="diam" class="form-control">
                                <option value="Dalam Batas Normal" <?php if ($diam=="Dalam Batas Normal"): ?>
                                    selected
                                <?php endif ?>>Dalam Batas Normal</option>
                                <option value="Tidak Dalam Batas Normal" <?php if ($diam=="Tidak Dalam Batas Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Dalam Batas Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_irama_jantung" value="<?php echo $ket_irama_jantung;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>EKG Jantung</td>
                        <td colspan="2">
                            <input type="text" class="form-control" name="ekg_jantung" value="<?php echo $ekg_jantung;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Treadmill</td>
                        <td colspan="2">
                            <input type="text" class="form-control" name="treadmill" value="<?php echo $treadmill;?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Perut</td>
                        <td>
                            <select name="perut" class="form-control">
                                <option value="Normal" <?php if ($perut=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($perut=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_perut" value="<?php echo $ket_perut;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Dinding Perut</td>
                        <td>
                            <select name="dinding_perut" class="form-control">
                                <option value="Ada" <?php if ($dinding_perut=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($dinding_perut=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_dinding_perut" value="<?php echo $ket_dinding_perut;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Nyeri tekan</td>
                        <td>
                            <select name="nyeri_tekan" class="form-control">
                                <option value="Ada" <?php if ($nyeri_tekan=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($nyeri_tekan=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_nyeri_tekan" value="<?php echo $ket_nyeri_tekan;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Tumor</td>
                        <td>
                            <select name="tumor" class="form-control">
                                <option value="Tidak Ada" <?php if ($tumor=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                                <option value="Ada" <?php if ($tumor=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_tumor" value="<?php echo $ket_tumor;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Hernia</td>
                        <td>
                            <select name="hernia" class="form-control">
                              <option value="Tidak Ada" <?php if ($hernia=="Tidak Ada"): ?>
                                  selected
                              <?php endif ?>>Tidak Ada</option>
                                <option value="Ada" <?php if ($hernia=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_hernia" value="<?php echo $ket_hernia;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Hati</td>
                        <td>
                            <select name="hati" class="form-control">
                                <option value="Dalam Batas Normal" <?php if ($hati=="Dalam Batas Normal"): ?>
                                    selected
                                <?php endif ?>>Dalam Batas Normal</option>
                                <option value="Tidak Dalam Batas Normal" <?php if ($hati=="Tidak Dalam Batas Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Dalam Batas Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_hati" value="<?php echo $ket_hati;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Limpa</td>
                        <td>
                            <select name="limpa" class="form-control">
                              <option value="Dalam Batas Normal" <?php if ($hati=="Dalam Batas Normal"): ?>
                                  selected
                              <?php endif ?>>Dalam Batas Normal</option>
                              <option value="Tidak Dalam Batas Normal" <?php if ($hati=="Tidak Dalam Batas Normal"): ?>
                                  selected
                              <?php endif ?>>Tidak Dalam Batas Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_limpa" value="<?php echo $ket_limpa;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Suara Usus</td>
                        <td>
                            <select name="suara_usus" class="form-control">
                              <option value="Dalam Batas Normal" <?php if ($hati=="Dalam Batas Normal"): ?>
                                  selected
                              <?php endif ?>>Dalam Batas Normal</option>
                              <option value="Tidak Dalam Batas Normal" <?php if ($hati=="Tidak Dalam Batas Normal"): ?>
                                  selected
                              <?php endif ?>>Tidak Dalam Batas Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_suara_usus" value="<?php echo $ket_suara_usus;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Bekas Operasi</td>
                        <td>
                            <select name="bekas_operasi" class="form-control">
                              <option value="Tidak Ada" <?php if ($bekas_operasi=="Tidak Ada"): ?>
                                  selected
                              <?php endif ?>>Tidak Ada</option>
                                <option value="Ada" <?php if ($bekas_operasi=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_bekas_operasi" value="<?php echo $ket_bekas_operasi;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Kulit</td>
                        <td>
                            <select name="kulit" class="form-control">
                              <option value="Dalam Batas Normal" <?php if ($hati=="Dalam Batas Normal"): ?>
                                  selected
                              <?php endif ?>>Dalam Batas Normal</option>
                              <option value="Tidak Dalam Batas Normal" <?php if ($hati=="Tidak Dalam Batas Normal"): ?>
                                  selected
                              <?php endif ?>>Tidak Dalam Batas Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_kulit" value="<?php echo $ket_kulit;?>"></td>
                    </tr>
                    <tr>
                        <th colspan="4">Anggota Gerak</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Tonus Otot</td>
                        <td>
                            <select name="tonus_otot" class="form-control">
                                <option value="Normal" <?php if ($tonus_otot=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($tonus_otot=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_tonus_otot" value="<?php echo $ket_tonus_otot;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Parese/Paralyse</td>
                        <td>
                            <select name="parese" class="form-control">
                                <option value="Ada" <?php if ($parese=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($parese=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_parese" value="<?php echo $ket_parese;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Tremor</td>
                        <td>
                            <select name="tremor" class="form-control">
                                <option value="Ada" <?php if ($tremor=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($tremor=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_tremor" value="<?php echo $ket_tremor;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Atrofi</td>
                        <td>
                            <select name="atrofi" class="form-control">
                                <option value="Ada" <?php if ($atrofi=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($atrofi=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_atrofi" value="<?php echo $ket_atrofi;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Oederma</td>
                        <td>
                            <select name="oederma" class="form-control">
                                <option value="Ada" <?php if ($oederma=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($oederma=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_oederma" value="<?php echo $ket_oederma;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Postur Tubuh</td>
                        <td>
                            <select name="postur_tubuh" class="form-control">
                                <option value="Normal" <?php if ($postur_tubuh=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($postur_tubuh=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_postur_tubuh" value="<?php echo $ket_postur_tubuh;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Kaki</td>
                        <td>
                            <select name="kaki" class="form-control">
                                <option value="Normal" <?php if ($kaki=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($kaki=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_kaki" value="<?php echo $ket_kaki;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Tangan</td>
                        <td>
                            <select name="tangan" class="form-control">
                                <option value="Normal" <?php if ($tangan=="Normal"): ?>
                                    selected
                                <?php endif ?>>Normal</option>
                                <option value="Tidak Normal" <?php if ($tangan=="Tidak Normal"): ?>
                                    selected
                                <?php endif ?>>Tidak Normal</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_tangan" value="<?php echo $ket_tangan;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">GENETALIA</td>
                        <td>
                            <select name="genetalia" class="form-control">
                                <option value="Ada" <?php if ($hemoroid=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($hemoroid=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_genetalia" value="<?php echo $ket_genetalia;?>"></td>
                    </tr>
                    <tr>
                        <th colspan="4">Lain-lain</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Hemoroid</td>
                        <td>
                            <select name="hemoroid" class="form-control">
                                <option value="Ada" <?php if ($hemoroid=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($hemoroid=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_hemoroid" value="<?php echo $ket_hemoroid;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Varises</td>
                        <td>
                            <select name="varises" class="form-control">
                                <option value="Ada" <?php if ($varises=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($varises=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ket_varises" value="<?php echo $ket_varises;?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Varicocel</td>
                        <td>
                            <select name="varicocel" class="form-control">
                                <option value="Ada" <?php if ($varicocel=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($varicocel=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="ket_varicocel" class="form-control" value="<?php echo $ket_varicocel ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Hepar</td>
                        <td>
                            <select name="hepar" class="form-control">
                                <option value="Ada" <?php if ($hepar=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($hepar=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="ket_hepar" class="form-control" value="<?php echo $ket_hepar ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Lien</td>
                        <td>
                            <select name="lien" class="form-control">
                                <option value="Ada" <?php if ($lien=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($lien=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="ket_lien" class="form-control" value="<?php echo $ket_lien ?>">
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>&nbsp;</td>
                        <td>Ekstremitas</td>
                        <td>
                            <input type="text" name="ekstremitas" class="form-control" value="<?php echo $ekstremitas ?>">
                        </td>
                    </tr> -->
                    <tr>
                        <td>&nbsp;</td>
                        <td>Ekstremitas Atas</td>
                        <td>
                            <select name="atas" class="form-control">
                                <option value="Ada" <?php if ($atas=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($atas=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="ket_atas" class="form-control" value="<?php echo $ket_atas ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Ekstremitas Bawah</td>
                        <td>
                            <select name="bawah" class="form-control">
                                <option value="Ada" <?php if ($bawah=="Ada"): ?>
                                    selected
                                <?php endif ?>>Ada</option>
                                <option value="Tidak Ada" <?php if ($bawah=="Tidak Ada"): ?>
                                    selected
                                <?php endif ?>>Tidak Ada</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="ket_bawah" class="form-control" value="<?php echo $ket_bawah ?>">
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Lab</td>
                        <td>
                            <input type="text" name="lab" class="form-control" value="<?php echo $lab ?>">
                        </td>
                    </tr> -->
                    <tr>
                        <td>&nbsp;</td>
                        <td>Kesimpulan</td>
                        <td>
                            <textarea class="form-control" name="kesimpulan"><?php echo $kesimpulan ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <?php if ($aksi=="edit"): ?>
                        <button class="cetakidentitas btn btn-primary" type="button"> Cetak Identitas</button>
                        <button class="cetak btn btn-success" type="button"> Cetak</button>
                        <button class="cetakresume btn btn-info" type="button"> Cetak Resume</button>
                    <?php endif ?>
                    <button class="btn btn-primary" type="submit"> Simpan</button>
                    <button class="back btn btn-warning" type="button"> Back</button>
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
    .table > tbody > tr > td {
        vertical-align: middle;
    }
</style>
