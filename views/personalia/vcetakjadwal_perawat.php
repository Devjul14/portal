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
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon"
    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
</head>
<script>
    $(document).ready(function() {
        // getttd_dokter();
        window.print();
    });

    function getttd_dokter() {
        var ttd = "<?php echo site_url('ttddokter/getttddokter/' . $q1->dokter); ?>";
        $('.ttd_dokter').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
    }
</script>
<?php
$bln = array("",
         "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
?>
<body class="page">
    <h5><b>DETASEMEN KESEHATAN WILAYAH 03.04.03</b></h5>
    <u><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</b></u>
    <p align="center"><b>DAFTAR JAGA</b></br>
    <b> <?php echo ($bagian=="kontrole" ? $bg[$bagian] : "RUANGAN ".$bg[$bagian]); ?> </b></br>
    <b> BULAN <?php echo strtoupper($bln[$b])." ".date("Y"); ?> </b>
    </p>
    <br>
    <table class="laporan">
      <thead>
        <tr>
          <?php
          $tahun = date("Y");
          $jml = cal_days_in_month(CAL_GREGORIAN, $b, $tahun);
          ?>
          <th style="vertical-align:middle" width="10%" class='text-center' rowspan="2">No</th>
          <th style="vertical-align:middle" class='text-center' rowspan="2">Nama Perawat</th>
          <th style="vertical-align:middle" class='text-center' colspan="<?php echo $jml;?>">Tanggal</th>
          <tr >
            <?php
            for ($i = 1; $i <=$jml; $i++) {
              $bg = "";
              $bl = substr("00".$b,-2);
              $dt = substr("00".$i,-2);
              $tanggal = date("Y")."-".$bl."-".$dt;
              $hari = date("w",strtotime($tanggal));
              if ($hari==0)
              $bg = "#f0aea780";
              else if($hari==6){
                $bg = "#0173b76e";
              }
              $bg = isset($libur[$tanggal]) ? "#f0aea780'" : $bg;
              echo "<th class='text-center' width='50px' style='background-color:".$bg."'>".$i."</th>";
            }
            ?>
          </tr>
        </tr>
      </thead>
      <tbody>
          <?php
              $i=0;
              foreach ($p->result() as $data) {
                if ($bagian=="kontrole"){
                  $i++;
                  echo "<tr id=data href='".$data->id_perawat."'>
                  <td>".$i."</td>
                  <td>".$data->nama_perawat."</td>";
                  for ($d = 1; $d <=$jml; $d++) {
                    $bl = substr("00".$b,-2);
                    $dt = substr("00".$d,-2);
                    $tanggal = date("Y")."-".$bl."-".$dt;
                    $hari = date("w",strtotime($tanggal));
                    $hasil = $bg = "";
                    if ($q[$bagian][$data->id_perawat]["tgl".$d]["shift1"]=="on")
                    $hasil = "P";
                    else if ($q[$bagian][$data->id_perawat]["tgl".$d]["shift2"]=="on")
                    $hasil = "X";
                    else if ($q[$bagian][$data->id_perawat]["tgl".$d]["lepas"]=="on")
                    $hasil = "LP";
                    else if ($q[$bagian][$data->id_perawat]["tgl".$d]["libur"]=="on"){
                      $hasil = "L";
                    }
                    else if ($q[$bagian][$data->id_perawat]["tgl".$d]["sakit"]=="on"){
                      $hasil = "S";
                    }
                    else if ($q[$bagian][$data->id_perawat]["tgl".$d]["cuti"]=="on"){
                      $hasil = "C";
                    }
                    if ($hari==0)
                    $bg = "#f0aea780";
                    else if($hari==6){
                      $bg = "#0173b76e";
                    }
                    $bg = isset($libur[$tanggal]) ? "#f0aea780'" : $bg;
                    echo "<th class='text-center' style='background-color:".$bg."'>".$hasil."</th>";
                  }
                  echo "</tr>";
                } else {
                  if ($data->kontrole==0){
                    $i++;
                    echo "<tr id=data href='".$data->id_perawat."'>
                    <td>".$i."</td>
                    <td>".$data->nama_perawat."</td>";
                    for ($d = 1; $d <=$jml; $d++) {
                      $bl = substr("00".$b,-2);
                      $dt = substr("00".$d,-2);
                      $tanggal = date("Y")."-".$bl."-".$dt;
                      $hari = date("w",strtotime($tanggal));
                      $hasil = $bg = "";
                      if ($q[$bagian][$data->id_perawat]["tgl".$d]["shift1"]=="on")
                      $hasil = "P";
                      else if ($q[$bagian][$data->id_perawat]["tgl".$d]["shift2"]=="on")
                      $hasil = "X";
                      else if ($q[$bagian][$data->id_perawat]["tgl".$d]["lepas"]=="on")
                      $hasil = "LP";
                      else if ($q[$bagian][$data->id_perawat]["tgl".$d]["libur"]=="on"){
                        $hasil = "L";
                      }
                      else if ($q[$bagian][$data->id_perawat]["tgl".$d]["sakit"]=="on"){
                        $hasil = "S";
                      }
                      else if ($q[$bagian][$data->id_perawat]["tgl".$d]["cuti"]=="on"){
                        $hasil = "C";
                      }
                      if ($hari==0)
                      $bg = "#f0aea780";
                      else if($hari==6){
                        $bg = "#0173b76e";
                      }
                      $bg = isset($libur[$tanggal]) ? "#f0aea780'" : $bg;
                      echo "<th class='text-center' style='background-color:".$bg."'>".$hasil."</th>";
                    }
                    echo "</tr>";
                  }
                }
              }
          ?>
      </tbody>
    </table>
</body>
<style type="text/css">
    .header-laporan {
        border-collapse: collapse !important;
        /* background-color: transparent; */
        width: 80%;
        max-width: 80%;
    }
    .laporan {
        border-collapse: collapse !important;
        /* background-color: transparent; */
        width: 80%;
        max-width: 80%;
        margin-bottom: 20px;
    }
    .header-laporan > thead > tr > th,
    .header-laporan > tbody > tr > th,
    .header-laporan > tfoot > tr > th,
    .header-laporan > thead > tr > td,
    .header-laporan > tbody > tr > td,
    .header-laporan > tfoot > tr > td {
        padding: 0px;
        vertical-align: top;
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
        padding: 1px 4px;
        line-height: 1.42857143;
        vertical-align: top;
        font-family: sans-serif;
        font-size: 12px;
        /* background-color: #fff !important; */
        border: 1px solid #000 !important;
    }
    .laporan > tbody > tr > th,
    .laporan > tbody > tr > td{
        /* background-color: #fff !important; */
        border-left: 1px solid #000 !important;
        border-right: 1px solid #000 !important;
    }
    .laporan > thead > tr > th,
    .laporan > thead > tr > td{
        /* background-color: #fff !important; */
        border: 1px solid #000 !important;
    }
    .laporan > tfoot > tr > td{
        padding: 3px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        font-family: sans-serif;
        font-size: 12px;
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
        width: 24cm;
        min-height: 26cm;
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

    }
    @page {
        size: A4;
        margin: 10 10;
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
        .header-laporan {
            border-collapse: collapse !important;
            background-color: transparent;
            width: 80%;
            max-width: 80%;
        }
        .laporan {
            border-collapse: collapse !important;
            /* background-color: transparent; */
            width: 80%;
            max-width: 80%;
            margin-bottom: 20px;
        }
        .laporan > tbody > tr > td{
            padding: 1px 4px;
            line-height: 1.42857143;
            vertical-align: top;
            font-family: sans-serif;
            font-size: 12px;
            /* background-color: #fff !important; */
            border: 1px solid #000 !important;
        }
        .laporan > tbody > tr > th,
        .laporan > tbody > tr > td{
            /* background-color: #fff !important; */
            border-left: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
        }
        .laporan > thead > tr > th,
        .laporan > thead > tr > td{
            /* background-color: #fff !important; */
            border: 1px solid #000 !important;
        }
        .laporan > tfoot > tr > td{
            padding: 3px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            font-family: sans-serif;
            font-size: 12px;
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
