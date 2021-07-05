<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url(); ?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url(); ?>js/html2canvas.js"></script>
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />
</head>
<script>
    $(document).ready(function() {
        // window.print();
    });
</script>
<?php $bln = array(
    "",
    "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"
); ?>

<body class="page">
    <h5><b>DETASEMEN KESEHATAN WILAYAH 03.04.03</b></h5>
    <u><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</b></u>
    <p align="center">INOS BULANAN</br>
        <!-- <?php echo ($ruangan == "ALL" ? $ruangan : "RUANGAN " . $bagian); ?> </br> -->
        BULAN <?php echo strtoupper($bln[$b]) . " " . date("Y"); ?>
    </p>
    <br>
    <table class="laporan" width="100%">
        <?php
        // $b = date("m");
        $tahun = date("Y");
        $jml = cal_days_in_month(CAL_GREGORIAN, $b, $tahun);
        ?>
        <thead>
            <tr class="bg-navy">
                <th style="vertical-align:middle" class="text-center" rowspan="3" width='150'>Tanggal</th>
                <th style="vertical-align:middle" width="150" class='text-center' rowspan="3">Ruang</th>
                <th style="vertical-align:middle" width="50" class='text-center' rowspan="3">Pasien Lama</th>
                <th style="vertical-align:middle" width="50" class='text-center' rowspan="3">Pasien Baru</th>
                <th style="vertical-align:middle" width="50" class="text-center" rowspan="2" colspan="2">Pasien Tirah Baring</th>
                <th width="50" class="text-center" colspan="11">Jumlah</th>
                <th style="vertical-align:middle" width="50" class="text-center" rowspan="2" colspan="2">Pasien Yang Dioperasi</th>
                <th style="vertical-align:middle" width="50" class="text-center" rowspan="3">Ket</th>
            </tr>
            <tr class="bg-navy">
                <th width="50" class="text-center" colspan="4">Pasien Yang Terpasang</th>
                <th width="50" class="text-center" colspan="7">Pasien Terinfeksi</th>
            </tr>
            <tr class='bg-navy'>
                <th width="50" class='text-center'>Ya</th>
                <th width="50" class='text-center'>Tidak</th>
                <th width="50" class='text-center'>INFUS</th>
                <th width="50" class='text-center'>CVC</th>
                <th width="50" class='text-center'>UC</th>
                <th width="50" class='text-center'>VENTILATOR</th>
                <th width="50" class='text-center'>DKU</th>
                <th width="50" class='text-center'>HAP</th>
                <th width="50" class='text-center'>IADP</th>
                <th width="50" class='text-center'>IDO</th>
                <th width="50" class='text-center'>ILI</th>
                <th width="50" class='text-center'>ISK</th>
                <th width="50" class='text-center'>VAP</th>
                <th width="50" class='text-center'>Ya</th>
                <th width="50" class='text-center'>Tidak</th>
            <tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $i++;
            for ($d = 1; $d <= $jml; $d++) {
                echo "<tr id=data>";
                $bl = substr("00" . $b, -2);
                $dt = substr("00" . $d, -2);
                $tanggal = date("Y") . "-" . $bl . "-" . $dt;
                $tgl = date("d-m-Y", strtotime($tanggal));
                echo "<td class='text-center'>" . $tgl . "</td>";
                echo "<td class='text-center'>" . ($bagian == "all" ? "ALL" : $r[$bagian]->nama_ruangan) . "</td>";
                $lama = 0;
                $baru = isset($q["baru"][date("Y-m-d", strtotime($tanggal))]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))] : 0;
                foreach ($q["lama"] as $key => $value) {
                    if (date("Y-m-d", strtotime($key)) > date("Y-m-d", strtotime($tanggal))) {
                        foreach ($value as $key2 => $value2) {
                            if ((date("Y-m-d", strtotime($key2)) < date("Y-m-d", strtotime($tanggal)))) { $lama += $value2; }
                        }
                    }
                    if ($key=="kosong") {
                        foreach ($value as $key2 => $value2) {
                            if (date("Y-m-d", strtotime($tanggal)) == date("Y-m-d") || date("Y-m-d", strtotime($key2)) < date("Y-m-d", strtotime($tanggal))) {
                                if (date("Y-m-d", strtotime($key2)) < date("Y-m-d", strtotime($tanggal))) { $lama += $value2;}
                            }
                        }
                    }
                }
                if (date("Y-m-d", strtotime($tanggal))>date("Y-m-d")) { $lama = 0;}
                echo "<td class='text-center'>" . $lama . "</td>";
                echo "<td class='text-center'>" . $baru . "</td>";
                echo "<td class='text-center'>" . $q["tirahya"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["tirahtdk"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["infus"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["cvc"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["uc"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["ventilator"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["DKU"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["HAP"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["IADP"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["IDO"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["ILI"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["ISK"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["VAP"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["operasiya"][$tgl] . "</td>";
                echo "<td class='text-center'>" . $q["operasitdk"][$tgl] . "</td>";
                echo "<td class='text-center'></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
<style type="text/css">
    * {
        font-family: sans-serif;
        margin-bottom: 20px;
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
    }

    .laporan>thead>tr>th {
        vertical-align: bottom;
    }

    .laporan td,
    .laporan th {
        background-color: #fff;
        border: 1px solid #000;
    }

    .laporan td.no-border,
    .laporan th.no-border {
        background-color: #fff !important;
        border: none;
    }
</style>