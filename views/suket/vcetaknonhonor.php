<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/AdminLTE.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
    <!-- <script src="<?php echo base_url(); ?>js/html2pdf.bundle.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>js/html2canvas.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>js/jquery.mask.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script> -->
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
</head>
<script>
$(document).ready(function() {
        getttd_karumkit();
        // window.print();
    });
function getttd_karumkit() {
        var ttd = "<?php echo site_url('ttddokter/getttdkarumkit/'); ?>";
        $('.ttd_karumkit').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
    }
</script>
<?php
function getRomawi($bulan)
{
    switch ($bulan) {
        case 1:
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}
$t1 = new DateTime('today');
$t2 = new DateTime($q->tgl_lahir);
$y  = $t1->diff($t2)->y;
$m  = $t1->diff($t2)->m;
$d  = $t1->diff($t2)->d;

// list($year, $month, $day) = explode("-", $q->tgl_lahir);
// $year_diff  = date("Y") - $year;
// $month_diff = date("m") - $month;
// $day_diff   = date("d") - $day;
// if ($month_diff < 0) {
//     $year_diff--;
//     $month_diff *= (-1);
// } elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
// if ($day_diff < 0) {
//     $day_diff *= (-1);
// }
// $umur = $year_diff;
$lahir = new DateTime($q->tgl_lahir);
$hari_ini = new DateTime();

$diff = $hari_ini->diff($lahir);
$umur = $diff->y;
if ($q->jenis_kelamin == "L") {
    $jenis_kelamin = "Laki-Laki";
} else {
    $jenis_kelamin = "Perempuan";
}
function tgl($tgl, $tipe)
{
    $month = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
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

<body class="page">
    <p>
    <h5>
        <b>
            &nbsp;DETASEMEN KESEHATAN WILAYAH 03.04.03
        </b>
    </h5>
    </p>
    <p>
    <h5>
        <u>
            <b>
                RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI<span style="float:right"><b><u>BENTUK KO-0554</u></b></span>
            </b>
        </u>
    </h5>
    </p>
    <br>
    <table class="table no-border laporan" align="center">
        <tr>
            <td colspan="2" style="vertical-align:middle">
                <h5 align="center"><b><u>SURAT PERINTAH</u></b></h5>
            </td>
        </tr>
        <tr>
            <?php $bulan = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"); ?>
            <td align="center"><?php echo $p1->no_sprint ?>/ SPRINT/ <?php echo $bulan[(int)(date("m", strtotime($p1->tanggal)))] . "/ " . date("Y", strtotime($p1->tanggal)); ?></td>
        </tr>
    </table>
    <table class="table no-border laporan">
        <tr>
            <td>Pertimbangan<span style="float:right">:</span></td>
            <td><?php echo $p1->pertimbangan; ?></td>
        </tr>
        <tr>
            <td>Dasar<span style="float:right">:</span></td>
            <td><?php echo $p1->dasar; ?></td>
        </tr>
        <tr>
        <td align="center"><p>DIPERINTAHKAN</p></td>
        </tr>
        <tr>
            <td>Kepada<span style="float:right">:</span></td>
            <td><?php echo $p1->kepada; ?></td>
        </tr>
        <tr>
            <td>Untuk<span style="float:right">:</span></td>
            <td><?php echo $p1->untuk; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">
                Dikeluarkan di :  Cirebon<br>
                <u>Pada tanggal : <?php echo date("d-m-Y", strtotime($p->tanggal)); ?></u>
                <br>
                <br>
            </td>
        <tr>
            <td>&nbsp;</td>
            <td align="center">
                KEPALA RUMAH SAKIT<br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">
                dr.Andre Novan
                <br>
                Letkol Ckm NRP.11010002201171
            </td>
        </tr>
    </table>
</body>
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

    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
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
    }



    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
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
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #FFFFFF;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 148mm;
        min-height: 210mm;
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 256mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A5;
        margin: 0;
    }

    h5 {
        font-size: 14px;
    }

    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
