<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
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
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
  </head>
<script>
    $(document).ready(function(){
            getttd();
            window.print();
        });

        function getttd(){
            var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'.$q->id_dokter);?>";
            $('.ttd_qrcode').qrcode({width: 80,height: 80, text:ttd});
        }
</script>
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
        $umur = $year_diff." tahun ".$month_diff." bulan ".$day_diff." hari ";
    ?>
    <table class="laporan" width="100%">
        <tr>
            <td rowspan="5" align="center">
                <img src="<?php echo base_url("img/Logo.png")?>"><br><b>RS CIREMAI</b>
            </td>
            <td rowspan="5" align="center" style="vertical-align: middle;">
                <h4>PEMERIKSAAN FISIK (MCU)</h4>
            </td>
            <td width="20%">No. RM</td><td>:</td><td><?php echo $q->no_pasien;?></td>
        </tr>
        <tr>
            <td>No. REG </td><td>:</td><td><?php echo $q->no_reg;?></td>
        </tr>
        <tr>
            <td>Nama </td><td>:</td><td><?php echo $q->nama_pasien;?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td><td>:</td><td><?php echo ($q->tgl_lahir!="" ? date("d-m-Y",strtotime($q->tgl_lahir)) : "")."/ ".$umur;?></td>
        </tr>
        <tr>
            <td>Alamat </td><td>:</td><td><?php echo $q->alamat;?></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <th colspan='3' align="left">ANAMNESE</th>
        </tr>
        <tr>
            <th colspan='3' align="left">Riwayat Penyakit</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><li>Keluhan yang dirasakan sekarang</li></td>
            <td>: <?php echo $q1->keluhan_penyakit ?>, <?php echo $q1->ket_keluhan_penyakit ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><li>Penyakit berat yang pernah diderita</li></td>
            <td>: <?php echo $q1->penyakit_berat ?>, <?php echo $q1->ket_penyakit_berat ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><li>Alergi</li></td>
            <td>: <?php echo $q1->alergi ?>, <?php echo $q1->ket_alergi ?></td>
        </tr>
        <tr>
            <th colspan="6">Kebiasaan</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
               <li>Merokok</li>
            </td>
            <td colspan="3">
                : <?php echo $q1->merokok ?>, <?php echo $q1->ket_merokok ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <li>Obat Rutin</li>
            </td>
            <td colspan="3">
                : <?php echo $q1->obat_rutin ?>, <?php echo $q1->ket_obat_rutin ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <li>Olahraga</li>
            </td>
            <td colspan="3">
                :  <?php echo $q1->olahraga ?>
            </td>
        </tr>
        <tr>
            <th colspan="2">Riwayat Penyakit Keluarga</th>
            <td colspan="3">
                : <?php echo $q1->riwayat_penyakitkel ?>, <?php echo $q1->ket_riwayat_penyakitkel ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <li>Makan / Minum</li>
            </td>
            <td colspan="3">
                : <?php echo $q1->makan_minum ?>, <?php echo $q1->ket_makan_minum ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th colspan="6">STATUS GENERALIS</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                Tinggi Badan
            </td>
            <td>
                : <?php echo $q1->tinggi_badan ?> cm
            </td>
            <td>
                Berat Badan
            </td>
            <td>
                : <?php echo $q1->berat_badan ?> Kg
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                Tekanan Darah
            </td>
            <td>
                : <?php echo $q1->tekanan_darah ?> Mm Hg
            </td>
            <td>
                Nadi
            </td>
            <td>
                : <?php echo $q1->nadi ?> x/Menit
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                Anemik
            </td>
            <td>
               : <?php echo $q1->anemik ?>
            </td>
            <td>
                Respirasi
            </td>
            <td>
                : <?php echo $q1->respirasi ?> x/Menit
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                Ikterik
            </td>
            <td>
                : <?php echo $q1->ikterik ?>
            </td>
            <td>
                Body Mass Index (BMI)
            </td>
            <td>
                :
                <?php
                    $tb     = ($q1->tinggi_badan/100);
                    $bb     = $q1->berat_badan;

                    $tb2    = pow($tb,2);
                    $bmi    = round($bb/$tb2,1);

                    echo $bmi." (".$q2->keterangan.")";
                ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th colspan="6">STATUS LOKALIS</th>
        </tr>
        <tr>
            <th colspan="6">Kepala</th>
        </tr>
        <tr>
            <td colspan="6">Mata</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Kenal Warna</td>
            <td>
                : <?php echo $q1->kenal_warna ?>, <?php echo $q1->ket_kenal_warna ?>
            </td>
            <td>
                Baca
            </td>
            <td>
                Visus OD : <?php echo $q1->visus_od ?> OS : <?php echo $q1->visus_os ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                Juling
            </td>
            <td colspan="3">
                : <?php echo $q1->juling ?> , <?php echo $q1->ket_juling ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">Mulut</td>
            <td>Telinga</td>
            <td>
                : <?php echo $q1->telinga ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Mucosa</td>
            <td colspan="3">
                : <?php echo $q1->mucosa ?>, <?php echo $q1->ket_mucosa ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Tonsil</td>
            <td>
                : <?php echo $q1->tonsil ?>, <?php echo $q1->ket_tonsil ?>
            </td>
            <td style="vertical-align:top">Gigi<span style="float:right">:</span></td>
            <td><?php echo $q1->gigi ?>, <?php echo $q1->ket_gigi ?></td>
        </tr>
        <tr>
            <td colspan="6">Leher</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Struma</td>
            <td>
                : <?php echo $q1->struma ?>, <?php echo $q1->ket_struma ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>JVP</td>
            <td>
                : <?php echo $q1->jvp ?> , <?php echo $q1->ket_jvp ?>
            </td>
            <th>Perut</th>
            <td>
               : <?php echo $q1->perut ?>, <?php echo $q1->ket_perut ?>
            </td>
        </tr>
        <tr>
            <th colspan="3">Dada</th>
            <td>Dinding Perut</td>
            <td>
                : <?php echo $q1->dinding_perut ?>, <?php echo $q1->ket_dinding_perut ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Dinding Thorax</td>
            <td>
                : <?php echo $q1->dinding_thorax ?>, <?php echo $q1->ket_dinding_thorax ?>
            </td>
            <td>Nyeri tekan</td>
            <td>
                : <?php echo $q1->nyeri_tekan ?>, <?php echo $q1->ket_nyeri_tekan ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Diam</td>
            <td>
                : <?php echo $q1->diam ?>, <?php echo $q1->ket_diam ?>
            </td>
            <td>Tumor</td>
            <td>
                : <?php echo $q1->tumor ?>, <?php echo $q1->ket_tumor ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Bernafas</td>
            <td>
                : <?php echo $q1->bernafas ?>, <?php echo $q1->ket_bernafas ?>
            </td>
            <td>Hernia</td>
            <td>
                : <?php echo $q1->hernia ?>, <?php echo $q1->ket_hernia ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Paru-paru</td>
            <td>
                : <?php echo $q1->paru_paru ?>, <?php echo $q1->ket_paru_paru ?>
            </td>
            <td>Hati</td>
            <td>
                : <?php echo $q1->hati ?>, <?php echo $q1->ket_hati ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Suara Nafas</td>
            <td>
                : <?php echo $q1->suara_nafas ?>, <?php echo $q1->ket_suara_nafas ?>
            </td>
            <td>Limpa</td>
            <td>
                : <?php echo $q1->limpa ?>, <?php echo $q1->ket_limpa ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Ronchi/Wheezing</td>
            <td>
                 : <?php echo $q1->ronchi ?>, <?php echo $q1->ket_ronchi ?>
            </td>
            <td>Suara Usus</td>
            <td>
                : <?php echo $q1->suara_usus ?>, <?php echo $q1->ket_suara_usus ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">Jantung</td>
            <td>Bekas Operasi</td>
            <td>
                : <?php echo $q1->bekas_operasi ?>, <?php echo $q1->ket_bekas_operasi ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Suara Jantung</td>
            <td>
                : <?php echo $q1->suara_jantung ?>, <?php echo $q1->ket_suara_jantung ?>
            </td>
            <td>Kulit</td>
            <td>
                : <?php echo $q1->kulit ?>, <?php echo $q1->ket_kulit ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Irama Jantung</td>
            <td >
                : <?php echo $q1->irama_jantung ?>, <?php echo $q1->ket_irama_jantung ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>EKG Jantung</td>
            <td >
                : <?php echo $q1->ekg_jantung ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Treadmill</td>
            <td >
                : <?php echo $q1->treadmill ?>
            </td>
        </tr>
        <tr>
            <th colspan="3">Anggota Gerak</th>
            <th colspan="2">Lain-lain</th>
        </tr>
        <tr>
            <td colspan="2">Tonus Otot</td>
            <td>
                : <?php echo $q1->tonus_otot ?>, <?php echo $q1->ket_tonus_otot ?>
            </td>
            <td>Hemoroid</td>
            <td>
                : <?php echo $q1->hemoroid ?>, <?php echo $q1->ket_hemoroid ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Parese/Paralyse</td>
            <td>
                : <?php echo $q1->parese ?>, <?php echo $q1->ket_parese ?>
            </td>
            <td>Varises</td>
            <td>
                : <?php echo $q1->varises ?>, <?php echo $q1->ket_varises ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Tremor</td>
            <td>
                : <?php echo $q1->tremor ?>, <?php echo $q1->ket_tremor ?>
            </td>
            <td>Varicocel</td>
            <td>
                : <?php echo $q1->varicocel ?>, <?php echo $q1->ket_varicocel ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Atrofi</td>
            <td>
                : <?php echo $q1->atrofi ?>, <?php echo $q1->ket_atrofi ?>
            </td>
            <td>Hepar</td>
            <td>: <?php echo $q1->hepar ?>, <?php echo $q1->ket_hepar ?>

            </td>
        </tr>
        <tr>
            <td colspan="2">Oederma</td>
            <td>
                : <?php echo $q1->oederma ?>, <?php echo $q1->ket_oederma ?>
            </td>
            <td>Lien</td>
            <td>: <?php echo $q1->lien ?>, <?php echo $q1->ket_lien ?>

            </td>
        </tr>
        <tr>
            <td colspan="2">Postur Tubuh</td>
            <td>
                : <?php echo $q1->postur_tubuh ?>, <?php echo $q1->ket_postur_tubuh ?>
            </td>
            <td>Ekstremitas Atas</td>
            <td>
                : <?php echo $q1->atas ?>, <?php echo $q1->ket_atas ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Kaki</td>
            <td>
                : <?php echo $q1->kaki ?>, <?php echo $q1->ket_kaki ?>
            </td>
            <td>Ekstremitas Bawah</td>
            <td>
                : <?php echo $q1->bawah ?>, <?php echo $q1->ket_bawah ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Tangan</td>
            <td colspan="3">
                : <?php echo $q1->tangan ?>, <?php echo $q1->ket_tangan ?>
            </td>
        </tr>
    </table>
<style>
    *{
        padding-left : 5px;
        padding-right: 5px;
    }
    table, td,th{
        font-family: sans-serif;
        /*padding: 0px; margin:0px;*/
        /*font-size: 13px;*/
    }
    /*input.text{
        height:5px;
    }*/
</style>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan > thead > tr > th,
    .laporan > tbody > tr > th,
    .laporan > tfoot > tr > th,
    .laporan > thead > tr > td,
    .laporan > tbody > tr > td,
    .laporan > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .laporan > caption + thead > tr:first-child > th,
    .laporan > colgroup + thead > tr:first-child > th,
    .laporan > thead:first-child > tr:first-child > th,
    .laporan > caption + thead > tr:first-child > td,
    .laporan > colgroup + thead > tr:first-child > td,
    .laporan > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .laporan td,
    .laporan th {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }
</style>
