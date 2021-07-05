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
?>
<body class="page">
    <table class="table no-border laporan">
    <tr colspan="2">
        <td>
            <p>Nomor : 
                <?php $bulan = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"); ?>
                SC/ <?php echo $bulan[(int)(date("m", strtotime($p1->tanggal)))] . "/ " . date("Y", strtotime($p1->tanggal)); ?>
            </p>
            <p>Kalsifikasi : Biasa</p>
            <p>Lampiran : 1 (satu)</p>
            <p>Perihal : <u>Permohonan Ijin / Cuti</u><br></p>
        </td>
        <td>&nbsp;</td>
        <td align="left">
            <p>Cirebon, <?php echo date("d-m-Y", strtotime($p1->tanggal)); ?><p>
            <p>Kepada</p>
            <p>Yth. Komandan Denkesyah 03.04.03
                <br> Cirebon
                <br> Di
                <br> Cirebon </p>
        </td>
    </tr>
    <tr>

    </tr>
    </table>
    <p>1. Dasar permohonan cuti dari PNS II/c <?php echo $p1->nama; ?> NIP <?php echo $p1->nrp; ?> Rumkit Tk.III 03.04.03 Ciremai Tanggal <?php echo date("d-m-Y", strtotime($p1->tanggal)); ?></p>
    <p>2. Sehubungan dengan hal tersebut diatas, dengan ini diajukan permohonan cuti atas nama : </p>
    <table class="table no-border laporan">
        <tr>
            <td>&nbsp;&nbsp;a. Nama<span style="float:right">:</span></td>
            <td><?php echo $p1->nama; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;b. Pangkat<span style="float:right">:</span></td>
            <td><?php echo $p1->pangkat; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;c. NRP/NIP/NRK<span style="float:right">:</span></td>
            <td><?php echo $p1->nrp; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;d. Jabatan<span style="float:right">:</span></td>
            <td><?php echo $p1->jabatan; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;e. Kesatuan<span style="float:right">:</span></td>
            <td>Rumkit Tk.III 03.04.03 Ciremai<br>Denkesyah 03.04.04 Cirebon Kesdam III/Slw</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;f. Tujuan<span style="float:right">:</span></td>
            <td><?php echo $p1->tujuan; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;g. Keperluan<span style="float:right">:</span></td>
            <td><?php echo $p1->keperluan; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;h. Berangkat<span style="float:right">:</span></td>
            <td><?php echo date("d-m-Y", strtotime($p1->tgl_berangkat)); ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;i. Kembali<span style="float:right">:</span></td>
            <td><?php echo date("d-m-Y", strtotime($p1->tgl_kembali)); ?></td>
        </tr>
    </table>
    <p>3. Demikian mohon dimaklumi.</p>
    <table class="table no-border laporan">
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
                <?php echo $p->karumkit; ?>
                <br>
                <?php echo $p->pangkat; ?> NRP.<?php echo $p->nrp; ?>
            </td>
        </tr>
        <tr>
            <td align="left">
                Tembusan :
                <br>
            <u>Kaurtuud Rumkit Tk.III 03.06.01 Ciremai</u>
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
    p {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    th {
        font-family: sans-serif;
        /*padding: 0px; margin:0px;*/
        /*font-size: 13px;*/
    }

    .laporan {
        width: 100%;
        max-width: 100%;
        height : auto ;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    
    .laporan>thead>tr>th,
    .laporan>tbody>tr>th,
    .laporan>tfoot>tr>th,
    .laporan>thead>tr>td,
    .laporan>tbody>tr>td,
    .laporan>tfoot>tr>td {
        padding: 2px;
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
        border: 1px;
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
