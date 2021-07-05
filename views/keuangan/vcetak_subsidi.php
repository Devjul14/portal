<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
</head>
<script>
    $(document).ready(function(){
        window.print();
    });
</script>
<?php
    $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
?>
<table class="laporan" width="100%">
    <thead>
         <tr><th colspan="9" style="border:none;text-align:left">DEPARTEMEN KESEHATAN WILAYAH 03.04.03<br>RUMAH SAKIT TINGKAT III 03.06.01 CIREBON</th></tr>
         <tr><th colspan="9" style="border:none;text-align:center">SUBSIDI RUMAH SAKIT KEPADA PASIEN DINAS<br>PERIODE : <?php echo $bulan[(int)date("m",strtotime($tgl))]." ".date("Y",strtotime($tgl)); ?></th></tr>
        <tr><th colspan="9" style="border:none;text-align:center">&nbsp;</th></tr>
        <tr class="bg-navy">
            <th style="text-align:center;vertical-align:middle" rowspan="3">No.</th>
            <th style="text-align:center;vertical-align:middle" rowspan="3" width="200px">Uraian</th>
            <th style="text-align:center;vertical-align:middle" rowspan="3">Jumlah Pasien Dinas</th>
            <th style="text-align:center;vertical-align:middle" colspan="4">Subsidi Rumah Sakit</th>
            <th style="text-align:center;vertical-align:middle" rowspan="2" colspan="2">Jumlah</th>
        </tr>
        <tr class="bg-navy">
            <th style="text-align:center" colspan="2">Selisih Tarif RS dengan Tarif INA-CBG's</th>
            <th style="text-align:center" colspan="2">Pasien Yang Tidak Bisa Diklaim Ke BPJS (INA-CBG's)</th>
        </tr>
        <tr class="bg-navy">
            <th style="text-align:center;vertical-align:middle">Pasien (orang)</th>
            <th style="text-align:center;vertical-align:middle">Jumlah (Rp)</th>
            <th style="text-align:center;vertical-align:middle">Pasien (orang)</th>
            <th style="text-align:center;vertical-align:middle">Jumlah (Rp)</th>
            <th style="text-align:center;vertical-align:middle">Pasien (orang) (4+6)</th>
            <th style="text-align:center;vertical-align:middle">Jumlah (Rp) (5+7)</th>
        </tr>
        <tr class="bg-navy">
            <th style="text-align:center">1</th>
            <th style="text-align:center">2</th>
            <th style="text-align:center">3</th>
            <th style="text-align:center">4</th>
            <th style="text-align:center">5</th>
            <th style="text-align:center">6</th>
            <th style="text-align:center">7</th>
            <th style="text-align:center">8</th>
            <th style="text-align:center">9</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:center"></td>
            <td>Bulan <?php echo $bulan[(int)date("m",strtotime($tgl))]." ".date("Y",strtotime($tgl)); ?></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:right"></td>
            <td style="text-align:center"></td>
            <td style="text-align:right"></td>
            <td style="text-align:center"></td>
            <td style="text-align:right"></td>
        </tr>
        <tr>
            <td style="text-align:center">1</td>
            <td>Rawat Jalan</td>
            <td style="text-align:center"><?php echo number_format($q["total_ralan"],0);?></td>
            <td style="text-align:center"><?php echo number_format($q["nondinas_ralan"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["nondinas_ralan"]["rupiah"],0,',','.');?></td>
            <td style="text-align:center"><?php echo number_format($q["dinas_ralan"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["dinas_ralan"]["rupiah"],0,',','.');?></td>
            <td style="text-align:center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"],0,',','.');?></td>
        </tr>
        <tr>
            <td style="text-align:center">2</td>
            <td>Rawat Inap</td>
            <td style="text-align:center"><?php echo number_format($q["total_inap"],0);?></td>
            <td style="text-align:center"><?php echo number_format($q["nondinas_inap"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["nondinas_inap"]["rupiah"],0,',','.');?></td>
            <td style="text-align:center"><?php echo number_format($q["dinas_inap"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["dinas_inap"]["rupiah"],0,',','.');?></td>
            <td style="text-align:center"><?php echo number_format($q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></td>
        </tr>
        <tr>
            <td style="text-align:center"></td>
            <td>Jumlah</td>
            <td style="text-align:center"><?php echo number_format($q["total_ralan"]+$q["total_inap"],0);?></td>
            <td style="text-align:center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"],0,',','.');?></td>
            <td style="text-align:center"><?php echo number_format($q["dinas_ralan"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["dinas_ralan"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></td>
            <td style="text-align:center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></td>
            <td style="text-align:right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></td>
        </tr>
        <tr>
            <th style="text-align:center">&nbsp;</th>
            <th>&nbsp;</th>
            <th style="text-align:center">&nbsp;</th>
            <th style="text-align:center">&nbsp;</th>
            <th style="text-align:right">&nbsp;</th>
            <th style="text-align:center">&nbsp;</th>
            <th style="text-align:right">&nbsp;</th>
            <th style="text-align:center">&nbsp;</th>
            <th style="text-align:right">&nbsp;</th>
        </tr>
        <tr>
            <th style="text-align:center"></th>
            <th>Total</th>
            <th style="text-align:center"><?php echo number_format($q["total_ralan"]+$q["total_inap"],0);?></th>
            <th style="text-align:center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"],0);?></th>
            <th style="text-align:right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"],0,',','.');?></th>
            <th style="text-align:center"><?php echo number_format($q["dinas_ralan"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
            <th style="text-align:right"><?php echo number_format($q["dinas_ralan"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></th>
            <th style="text-align:center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
            <th style="text-align:right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></th>
        </tr>
    </tbody>
</table>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
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
    }
    .laporan > thead > tr > th {
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