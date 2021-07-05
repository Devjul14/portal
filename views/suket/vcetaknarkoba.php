<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/select2/select2.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url(); ?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url(); ?>js/html2canvas.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
</head>
<script>
    $(document).ready(function(){
        getttd_dokter();
        window.print();
    });
    function getttd_dokter(){
        var ttd = "<?php echo site_url('ttddokter/getttddokter/'.$q1->id_dokter);?>";
        $('.getttd_dokter').qrcode({width: 80,height: 80, text:ttd});
    }
</script>
<?php
function tgl($tgl, $tipe)
{
    $month = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $xmonth = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des");
    $hari = substr($tgl, 0, 10);
    $jam = substr($tgl, 11, 5);
    $m = (int)(substr($tgl, 5, 2));
    $tmp = substr($tgl, 8, 2) . " " . $month[$m] . " " . substr($tgl, 0, 4);
    if ($tipe == 1) {
        $tmp = $tmp . " - " . $jam;
    } elseif ($tipe == 2) {
        $tmp = $tmp;
    }
    if (substr($tgl, 0, 4) == '0000') {
        return "";
    } else {
        return $tmp;
    }
}
?>
<h5>
    <b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI<br>
        <u>DETASEMEN KESEHATAN WILAYAH 03.04.03</u>
    </b>
</h5>
<br>
<p>
<h4 align="center"><b><u>SURAT KETERANGAN PEMERIKSAAN NARKOBA</u></b></h4>
</p>
<p align="center">
    <?php $bulan = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"); ?>
    No : <?php echo $q2->nomor_surat ?>/ SKBN/ <?php echo $bulan[(int)(date("m", strtotime($q2->tgl_insert)))] . "/ " . date("Y", strtotime($q2->tgl_insert)); ?>
</p>
<br>
<br>
<br>
<p>Yang bertanda tangan di bawah ini : <b><?php echo $q1->nama_dokter;?></b> RST Ciremai Cirebon dengan ini menerangkan bahwa :</p>
<table width="100%" class="laporan2">
    <tr>
        <td>Nama Pasien</td>
        <td>: <?php echo $q->nama_pasien ?></td>
    </tr>
    <tr>
        <?php
        $hari = date("w", strtotime($q->tgl_lahir));
        $h = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        ?>
        <td>Tanggal Lahir</td>
        <td> : <?php echo $h[$hari] . ", " . ($q->tgl_lahir == "" ? "" : date("d-m-Y", strtotime($q->tgl_lahir))); ?></td>
        </td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td colspan="2">: <?php echo $q->pekerjaan ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td colspan="2">: <?php echo $q->alamat ?></td>
    </tr>
</table>

<table width="100%" class="laporan2">
    <p>Setelah dilakukan pemeriksaan kejiwaan secara seksama pada tanggal <?php echo date("d-m-Y", strtotime($q2->tgl_insert)) ?> di Klinik Jiwa RST.Ciremai Cirebon didapatkan hasil sebagai berikut :</p>
    <tr>
        <td>
          <ol>
            <li>Anamnesis<br><?php echo $q2->anamnesis ?></li>
            <li>Pemeriksaan Fisik<br><?php echo $q2->fisik ?></li>
            <li>Pemeriksaan Laboratorium Urine <?php echo (isset($q2) ? "(Tanggal ".date("d-m-Y", strtotime($q2->tgl_insert)).")" : "") ?>
            <br><?php
            echo "<ul style='margin-left:20px'>";
            foreach ($narkoba as $key => $value) {
                echo "<li>" . $value->nama_tindakan . " dengan hasil <b>" . strtoupper($value->hasil) . "</b></li>";
            }
            echo "</ul>";
            ?>
            </li>
          </ol>
        </td>
    </tr>
</table>
<br>
<p> Surat ini dipergunakan untuk : <b>--<?php echo $q2->untuk ?>--</b></p>
<p> Surat keterangan ini berlaku sampai dengan tanggal : <b><?php echo date("d-m-Y", strtotime($q2->batastgl)) ?></b></p>
<table class="laporan2" width="100%">
    <tr>
        <td align="center" width="50%"></td>
        <td align="center">
            Cirebon, <?php echo  tgl(date("Y-m-d", strtotime($q2->tgl_insert)), 2); ?>
        </td>
    </tr>
    <tr>
        <td align="center">
        </td>
        <td align="center">
            <b>An. Kepala Rumah Sakit Ciremai<br>Dokter yang memeriksa</b>
        </td>
    </tr>
    <tr>
        <td align="center">

        </td>
        <td align="center">
            <!-- <div class="getttd_saksi"> </div> -->
            <div class="getttd_dokter"> </div>
            <br>
            <b><?php echo $q1->nama_dokter;?></b>
            <br>
            <b>Sip. <?php echo $q1->no_sip;?></b>
        </td>
    </tr>
</table>
<style>
    * {
        padding-left: 5px;
        padding-right: 5px;
    }

    table,
    td,
    th {
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

    .laporan>thead>tr>th,
    .laporan>tbody>tr>th,
    .laporan>tfoot>tr>th,
    .laporan>thead>tr>td,
    .laporan>tbody>tr>td,
    .laporan>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .laporan>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }

    .laporan>caption+thead>tr:first-child>th,
    .laporan>colgroup+thead>tr:first-child>th,
    .laporan>thead:first-child>tr:first-child>th,
    .laporan>caption+thead>tr:first-child>td,
    .laporan>colgroup+thead>tr:first-child>td,
    .laporan>thead:first-child>tr:first-child>td {
        border-top: 0;
    }

    .laporan>tbody+tbody {
        border-top: 2px solid #ddd;
    }

    .laporan td,
    .laporan th {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }



    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }

    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }

    .laporan2>thead>tr>th,
    .laporan2>tbody>tr>th,
    .laporan2>tfoot>tr>th,
    .laporan2>thead>tr>td,
    .laporan2>tbody>tr>td,
    .laporan2>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
    }

    .laporan2>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 0px solid #ddd;
    }

    .laporan2>caption+thead>tr:first-child>th,
    .laporan2>colgroup+thead>tr:first-child>th,
    .laporan2>thead:first-child>tr:first-child>th,
    .laporan2>caption+thead>tr:first-child>td,
    .laporan2>colgroup+thead>tr:first-child>td,
    .laporan2>thead:first-child>tr:first-child>td {
        border-top: 0;
    }

    .laporan2>tbody+tbody {
        border-top: 0px solid #ddd;
    }

    .laporan2 td,
    .laporan2 th {
        border: 0px solid #000 !important;
    }

    .watermark {
        position: absolute;
        top: 300px;
        left: 200px;
        z-index: -99;
        opacity: 0.5;
        width: 300px;
    }
</style>
