<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <!-- <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script> -->
    <!-- <script src="<?php echo base_url();?>js/html2canvas.js"></script> -->
    <!-- <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>js/bootstrap.min.js"></script> -->
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
  </head>
<script>
    $(document).ready(function(){
        getttd_dokter();
		// window.print();
    });

    function getttd_dokter(){
        var ttd = "<?php echo site_url('ttddokter/getttddokter/'.$q1->dokter);?>";
        $('.ttd_dokter').qrcode({width: 80,height: 80, text:ttd});
    }
</script>
<?php
    function getRomawi($bulan){
        switch ($bulan){
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

    // list($year,$month,$day) = explode("-",$q->tgl_lahir);
    // $year_diff  = date("Y") - $year;
    // $month_diff = date("m") - $month;
    // $day_diff   = date("d") - $day;
    // if ($month_diff < 0) {
    //     $year_diff--;
    //     $month_diff *= (-1);
    // }
    // elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    // if ($day_diff < 0) {
    //     $day_diff *= (-1);
    // }
    // $umur_thn = $year_diff;
    $lahir = new DateTime($q->tgl_lahir);
    $hari_ini = new DateTime();

    $diff = $hari_ini->diff($lahir);
    $umur_thn = $diff->y;

    if ($q->jenis_kelamin=="L") {
    	$jenis_kelamin = "Laki-Laki";
    } else {
    	$jenis_kelamin = "Perempuan";
    }
    function tgl($tgl,$tipe){
        $month = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
        $xmonth = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nop","Des");
        $hari = substr($tgl,0,10);
        $jam = substr($tgl,11,5);
        $m = (int)(substr($tgl,5,2));
        $tmp = substr($tgl,8,2)." ".$month[$m]." ".substr($tgl,0,4);
        if ($tipe == 1)
        {
            $tmp = $tmp." - ".$jam;
        }
        elseif ($tipe == 2)
        {
            $tmp = $tmp;
        }
        if (substr($tgl,0,4)=='0000')
        {
            return "";
        }
        else
        {
            return $tmp;
        }
    }

?>
<body class="page">
<h5><b>DETASEMEN KESEHATAN WILAYAH 03.04.03</b></h5>
<u><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</b></u>
<br><br>
<p style="text-align:center"><b>SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK<br>ATAS DATA PESERTA MENINGGAL DI FASILITAS KESEHATAN<br>NOMOR <?php echo $nomor;?></b></p>
<br>
<p>
Yang bertanda tangan di bawah ini :
<table cellpadding=5 cellspacing=5 width=100%>
    <tr>
        <td>Nama</td><td>: <?php echo $rs->karumkit;?></td>
    </tr>
    <tr>
        <td>Pangkat/ NRP</td><td>: <?php echo $rs->pangkat."/ ".$rs->nrp;?></td>
    </tr>
    <tr>
        <td>Jabatan</td><td>: Kepala Rumah Sakit Tk. III 03.06.01 Ciremai</td>
    </tr>
</table>
Dengan ini menyatakan dan bertanggung jawab secara penuh atas kebenaran data peserta JKN-KIS yang telah dinyatakan meninggal di Rumkit Tk. III 03.06.01 Ciremai sebagai berikut :
</p>
<table class="laporan">
    <thead>
        <tr>
            <th width="50px" style="vertical-align:middle" class='text-center'>No.</th>
            <th style="vertical-align:middle" class='text-center'>No. Kartu</th>
            <th style="vertical-align:middle" class="text-center">Nama</th>
            <th style="vertical-align:middle" class="text-center">No. RM</th>
            <th style="vertical-align:middle" class='text-center'>No. SEP</th>
            <th style="vertical-align:middle" class='text-center'>Tanggal</th>
            <th style="vertical-align:middle" class='text-center'>No. Surat Kematian</th>
            <th width="200px" style="vertical-align:middle" class='text-center'>Diagnosa</th>
        </tr>
    </thead>
    <tbody>
    <?php
        ksort($q);
        $i = 1;
        foreach ($q as $key => $row) {
            $ind = '<span class="label label-success">ind</span>';
            echo "<tr>";
            $bulan = array("","I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
            $nomor_surat = $row->nomor_surat."/ SKM/ ".$bulan[(int)(date("m",strtotime($row->tgl_keluar)))]."/ ".date("Y",strtotime($row->tgl_keluar));
            echo "<td style='vertical-align:top' class='text-center'>".($i++)."</td>";
            echo "<td style='vertical-align:top' class='text-center'>".$row->no_bpjs."</td>";
            echo "<td style='vertical-align:top'>".$row->nama_pasien."</td>";
            echo "<td style='vertical-align:top' align='center'>".$row->no_rm."</td>";
            echo "<td style='vertical-align:top' align='center'>".$row->no_sjp."</td>";
            echo "<td style='vertical-align:top' align='center'>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
            echo "<td style='vertical-align:top' class='text-center'>".$nomor_surat."</td>";
            echo "<td style='vertical-align:top'>".$row->diagnosa_akhir."</td>";
            echo "</tr>";
        }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="7">&nbsp;</th>
            <th class="text-center">
                <?php
                    $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
                ?>
                Cirebon, <?php echo date("d")." ".$bulan[(int)date("m")]." ".date("Y");?>
                <br>Yang bertanda tangan<br><br><br><br><br><br><br><br><br><br>
                <?php echo $rs->karumkit;?><br><?php echo $rs->pangkat. " NRP. ".$rs->nrp;?>
            </th>
        </tr>
    </tfoot>
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
    .header-laporan > thead > tr > th,
    .header-laporan > tbody > tr > th,
    .header-laporan > tfoot > tr > th,
    .header-laporan > thead > tr > td,
    .header-laporan > tbody > tr > td,
    .header-laporan > tfoot > tr > td {
        padding: 0px;
        vertical-align: middle;
        border-top: 0px solid #ddd;
        font-family: sans-serif;
        font-size: 12px;
    }
    .borderyes{
        border: 1px solid #000 !important;
    }
    .laporan > thead > tr > th,
    .laporan > tbody > tr > th,
    .laporan > tfoot > tr > th,
    .laporan > thead > tr > td,
    .laporan > tbody > tr > td{
        padding: 3px;
        line-height: 1.42857143;
        vertical-align: middle;
        font-family: sans-serif;
        font-size: 12px;
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }
    .laporan > tbody > tr > th,
    .laporan > tbody > tr > td{
        background-color: #fff !important;
        border-left: 1px solid #000 !important;
        border-right: 1px solid #000 !important;
    }
    .laporan > thead > tr > th,
    .laporan > thead > tr > td{
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }
    .laporan > tfoot > tr > td{
        padding: 3px;
        line-height: 1.42857143;
        vertical-align: middle;
        border-top: 1px solid #ddd;
        font-family: sans-serif;
        font-size: 10px;
    }
    .laporan > tbody{
        border-bottom: 1px solid #000 !important;
    }
    .laporan > tfoot > tr > td{
        border-top: 1px solid #000 !important;
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
    .listresume th.noborder{
        border-color: #fff;
    }
    .laporan > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .ttd {
        position: relative;
        top:0px;
        right: 0px;
    }
    .ttd img.ttd2{
        width:100px;
        height: 100px;
        opacity: 0.8;
    }
    .ttd img.cap{
        position: absolute;
        width:100px;
        height: 100px;
        right:50px;
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
        .borderno{
            border:0px;
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
        .laporan > tbody > tr > td{
            padding: 3px;
            line-height: 1.42857143;
            vertical-align: top;
            font-family: sans-serif;
            font-size: 10px;
            background-color: #fff !important;
            border: 0px solid #000 !important;
        }
        .laporan > tbody > tr > th,
        .laporan > tbody > tr > td{
            background-color: #fff !important;
            border-left: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
        }
        .laporan > thead > tr > th,
        .laporan > thead > tr > td{
            background-color: #fff !important;
            border: 1px solid #000 !important;
            vertical-align:middle;
        }
        .laporan > tfoot > tr > td{
            padding: 3px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            font-family: sans-serif;
            font-size: 10px;
        }
        .laporan > tbody{
            border-bottom: 1px solid #000 !important;
        }
        .laporan > tfoot > tr > td{
            border-top: 1px solid #000 !important;
        }
        .laporan > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
    }
</style>
