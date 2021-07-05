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
<body class="page">
    <h5><b>DETASEMEN KESEHATAN WILAYAH 03.04.03</b></h5>
    <u><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</b></u>
    <br>
    <br>
    <p align="center"><b>NOMINATIF TIM KENDALI MUTU DAN KENDALI BIAYA RUMKIT TK.III 03.06.01 CIREMAI</b></p>
    <br>
    <table class="laporan">
        <thead>
            <tr>
                <th style="vertical-align:middle" width="10%" class='text-center'>No. Sprint</th>
                <th style="vertical-align:middle" class='text-center'>Nama</th>
                <th style="vertical-align:middle" class='text-center'>NRP</th>
                <th style="vertical-align:middle" class="text-center">Pangkat</th>
                <th style="vertical-align:middle" class='text-center'>Jabatan</th>
                <th style="vertical-align:middle" class='text-center'>TIM</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($p1->result() as $key => $row) {
                echo "<tr id=data href='" . $row->no_sprint . "' nama='" . $row->nama . "' ta_tmt='" . date("Y/m/d", strtotime($row->ta_tmt)) . "' nrp='" . $row->nrp . "' ket='" . $row->ket . "' pangkat='" . $row->pangkat . "' jabatan_lama='" . $row->nama_jabatan_lama . "' jabatan_baru='" . $row->nama_jabatan_baru . "'>";
                echo "<td class='text-center'>" . $no_sprint . "</td>";
                echo "<td class='text-center'>" . $row->nama . "</td>";
                echo "<td class='text-center'>" . $row->nrp . "</td>";
                echo "<td class='text-center'>" . $row->pangkat . "</td>";
                echo "<td class='text-center'>" . $row->jabatan . "</td>";
                echo "<td class='text-center'>" . $row->tim . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <table align="right">
        <tr>
            <td align="center">
                Dikeluarkan di :  Cirebon<br>
                <u>Pada tanggal : <?php echo date("d-m-Y", strtotime($p->tanggal)); ?></u>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td align="center">
                KEPALA RUMAH SAKIT<br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td align="center">
                <?php echo $t->karumkit ; ?>
                <br>
                <?php echo $t->pangkat ; ?> NRP.<?php echo $t->nrp ; ?>
            </td>
        </tr>
    </table>
</body>
<style type="text/css">
    .header-laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
    }

    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    .header-laporan>thead>tr>th,
    .header-laporan>tbody>tr>th,
    .header-laporan>tfoot>tr>th,
    .header-laporan>thead>tr>td,
    .header-laporan>tbody>tr>td,
    .header-laporan>tfoot>tr>td {
        padding: 0px;
        vertical-align: middle;
        border-top: 0px solid #ddd;
        font-family: sans-serif;
        font-size: 10px;
    }

    .borderyes {
        border: 1px solid #000 !important;
    }

    .laporan>thead>tr>th,
    .laporan>tbody>tr>th,
    .laporan>tfoot>tr>th,
    .laporan>thead>tr>td,
    .laporan>tbody>tr>td {
        padding: 3px;
        line-height: 1.42857143;
        vertical-align: middle;
        font-family: sans-serif;
        font-size: 10px;
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }

    .laporan>tbody>tr>th,
    .laporan>tbody>tr>td {
        background-color: #fff !important;
        border-left: 1px solid #000 !important;
        border-right: 1px solid #000 !important;
    }

    .laporan>thead>tr>th,
    .laporan>thead>tr>td {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }

    .laporan>tfoot>tr>td {
        padding: 3px;
        line-height: 1.42857143;
        vertical-align: middle;
        border-top: 1px solid #ddd;
        font-family: sans-serif;
        font-size: 10px;
    }

    .laporan>tbody {
        border-bottom: 1px solid #000 !important;
    }

    .laporan>tfoot>tr>td {
        border-top: 1px solid #000 !important;
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

    .listresume th.noborder {
        border-color: #fff;
    }

    .laporan>tbody+tbody {
        border-top: 2px solid #ddd;
    }

    .ttd {
        position: relative;
        top: 0px;
        right: 0px;
    }

    .ttd img.ttd2 {
        width: 100px;
        height: 100px;
        opacity: 0.8;
    }

    .ttd img.cap {
        position: absolute;
        width: 100px;
        height: 100px;
        right: 50px;
        opacity: 0.5;
    }

    .top-left {
        position: absolute;
        left: 0px;
        top: 0px;
    }

    .bottom-left {
        position: absolute;
        bottom: 0px;
        left: 0px;
    }

    .bottom-right {
        position: absolute;
        bottom: 0px;
        right: 0px;
    }

    .top-right {
        position: absolute;
        top: 0px;
        right: 0px;
    }

    .page {
        width: 26cm;
        min-height: 21cm;
        padding: 0.5cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

    }

    @page {
        size: A4;
        margin: 10;
    }

    @media print {
        .borderno {
            border: 0px;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: auto;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }

        .laporan>tbody>tr>td {
            padding: 3px;
            line-height: 1.42857143;
            vertical-align: top;
            font-family: sans-serif;
            font-size: 10px;
            background-color: #fff !important;
            border: 0px solid #000 !important;
        }

        .laporan>tbody>tr>th,
        .laporan>tbody>tr>td {
            background-color: #fff !important;
            border-left: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
        }

        .laporan>thead>tr>th,
        .laporan>thead>tr>td {
            background-color: #fff !important;
            border: 1px solid #000 !important;
            vertical-align: middle;
        }

        .laporan>tfoot>tr>td {
            padding: 3px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            font-family: sans-serif;
            font-size: 10px;
        }

        .laporan>tbody {
            border-bottom: 1px solid #000 !important;
        }

        .laporan>tfoot>tr>td {
            border-top: 1px solid #000 !important;
        }

        .laporan>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
    }
</style>
