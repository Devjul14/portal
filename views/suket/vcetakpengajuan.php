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
    $t1 = new DateTime($q1->tgl_berangkat);
    $t2 = new DateTime($q1->tgl_kembali);
    $y  = $t1->diff($t2)->y;
    $m  = $t1->diff($t2)->m;
    $d  = $t1->diff($t2)->d;
    list($yearb,$monthb,$dayb) = explode("-",$q1->tgl_berangkat);
    list($yeark,$monthk,$dayk) = explode("-",$q1->tgl_kembali);
    $year_diff  = $yeark - $yearb;
    $month_diff = $monthk - $monthb;
    $day_diff   = $dayk - $dayb + 1;
    if ($month_diff < 0) {
        $year_diff--;
        $month_diff *= (-1);
    }
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    if ($day_diff < 0) {
        $day_diff *= (-1);
    }
    $selama = $day_diff." hari";
?>
<body class="page">
    <table class="table no-border laporan">
    <tr colspan="2">
        <td>
            <p>Cirebon, <?php echo date("d-m-Y", strtotime($p1->tanggal)); ?><p>
            Perihal : <u>Permohonan Ijin / Cuti</u></p>
        </td>
        <td>&nbsp;</td>
        <td align="left">
            <p>Kepada</p>
            <p>Yth. Kepala Rumah Sakit
                <br> Tk.III 03.06.01 Ciremai
                <br> Di
                <br> Tempat </p>
        </td>
    </tr>
    <tr>

    </tr>
    </table>
    <p>1. Yang bertanda tangan dibawah ini:</p>
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
    <p>2. Dengan ini mengajukan Ijin / Cuti Bersalin / Cuti tahun <?php echo date("Y"); ?> selama <?php echo $selama; ?> hari kerja, terhitung mulai tanggal <?php echo date("d-m-Y", strtotime($p1->tgl_berangkat)); ?> s/d <?php echo date("d-m-Y", strtotime($p1->tgl_kembali)); ?></p>
    <p>3. Selama melaksanakan Ijin / Cuti beralamatkan <?php echo $p1->tujuan; ?></p>
    <p>4. Alasan permohonan Ijin / Cuti Bersalin / Cuti Tahunan untuk <?php echo $p1->keperluan; ?></p>
    <p>5. Demikian permohonan Ijin ini kami buat untuk pertimbangan sebagaimana mestinya.</p>
    <table class="table no-border laporan">
        <tr align="left" >
            <td>&nbsp;</td>
            <td align="center">
                Mengetahui<br>
                Ka Unit / Bangsal<br>
                <br>
                <br>
            </td>
            <td>&nbsp;</td>      
            <td align="center">
                 Hormat Saya
            </td>
        </tr>
        <tr align="right">
            <td>&nbsp;</td>
            <td align="center">
                Pkt/Gol NRP/NIP/NRK<br>
                <br>
                <br>
                <br>
            </td>
            <td>&nbsp;</td>      
            <td align="center">
                Pkt/Gol NRP/NIP/NRK
            </td>
        </tr>
    </table>
    <table class="cuti" border="1" width="100%">
        <tr>
            <th colspan="3">Catatan : Pertimbangan atasan langsung</th>
            <th rowspan="2" align="center">WAKA</th>
        </tr>
        <tr>
            <th align="center">PARAF URPAM</th>
            <th align="center">PARAF UPRES</th>
            <th align="center">PARAF KABIDUM</th>
        </tr>
        <tr>
            <th height="80"></th>
            <th height="80"></th>
            <th height="80"></th>
            <th height="80"></th>
        </tr>
        <tr>
            <th colspan="2" height="200">
            Catatan :<br>
            1. Tanggal terakhir Ijin / Cuti TA <?php echo date("Y") ?><br>
                &nbsp;&nbsp;&nbsp;a.&ensp;&ensp;&ensp;sd&ensp;&ensp;&ensp;selama&nbsp;&nbsp;&nbsp;    hari<br>
                &nbsp;&nbsp;&nbsp;b.&ensp;&ensp;&ensp;sd&ensp;&ensp;&ensp;selama&nbsp;&nbsp;&nbsp;    hari<br>
            2. Absensi<br>
                &nbsp;&nbsp;a.Sakit<br>
                &nbsp;&nbsp;b.Ijin<br>
                &nbsp;&nbsp;c.TL<br>
                &nbsp;&nbsp;d.TK</th>
            <th colspan="2" height="200">
                Keputusan pejabat yang<br>
berwenang memberikan Ijin / Cuti<br>
    &ensp;&ensp;&ensp;Karumkit Tk.III 03.06.01 Ciremai<br>
                        <br><br><br><br>


&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;dr. Andre Novan<br>
    &ensp;&ensp;&ensp;Letkol Ckm NRP 1101002201171
            </th>
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
    p {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    .laporan {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    .cuti {
        width: 100%;
        max-width: 100%;
        margin-bottom: 10px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .laporan>thead>tr>th,
    .laporan>tbody>tr>th,
    .laporan>tfoot>tr>th,
    .laporan>thead>tr>td,
    .laporan>tbody>tr>td,
    .laporan>tfoot>tr>td {
        padding: 3px;
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
