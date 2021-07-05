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
		window.print();
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
                RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI
            </b>
        </u>
    </h5>
</p>
<br>
<h4 align="center"><b><u>SURAT KETERANGAN</u></b></h4>
<p align="center"><b>Nomor : <?php echo $id ?> / SK / <?php echo getRomawi($q2->bulan); ?> / <?php echo $q2->tahun ?></b></p>
<hr style="border: 1px solid;">
<p>Yang bertanda tangan di bawah ini :</p>
<table class="table no-border">
    <tr>
        <td width="30%">Nama<span class='pull-right'>:</span></td><td> <?php echo $q1->nama_dokter ?></td>
    </tr>
    <tr>
        <td>Jabatan<span class='pull-right'>:</span></td><td> <?php echo $q1->jenis_kelompok ?> <?php echo $q1->nama_kelompok ?></td>
    </tr>
    <tr>
        <td>SIP<span class='pull-right'>:</span></td><td> <?php echo $q1->no_sip ?></td>
    </tr>
    <tr>
        <td>Alamat<span class='pull-right'>:</span></td><td> <?php echo $q3->alamat_rs ?></td>
    </tr>
</table>
<br>
<p>Menerangkan bahwa :</p>
<table class="table no-border">
    <tr>
        <td width="30%">Nama<span class='pull-right'>:</span></td><td> <?php echo $q->nama_pasien ?></td>
    </tr>
    <tr>
        <td>No RM<span class='pull-right'>:</span></td><td> <?php echo $no_pasien ?></td>
    </tr>
    <tr>
        <td>Umur<span class='pull-right'>:</span></td><td> <?php echo $umur_thn ?> Tahun</td>
    </tr>
    <tr>
        <td>Jenis Kelamin<span class='pull-right'>:</span></td><td> <?php echo $jenis_kelamin; ?></td>
    </tr>
    <tr>
        <td>Alamat Rumah<span class='pull-right'>:</span></td><td> <?php echo $q->alamat; ?></td>
    </tr>
</table>
<br>
    <?php
        $t1 = new DateTime($q1->tgl_masuk);
        $t2 = new DateTime($q1->tgl_keluar);
        $d = $t2->diff($t1)->days + 1;
    ?>
	<p>Menerangkan bahwa :</p>
    <table class="table no-border">
        <tr>
    		<td>1.</td>
            <td>Yang bersangkutan sudah selesai melakukan isolasi di Rumah Sakit TK. III 03.06. 01 Ciremai Cirebon selama <?php echo $d ?> hari terhitung sejak  <?php echo date("d-m-Y",strtotime($q1->tgl_masuk)) ?> sampai dengan tanggal <?php echo date("d-m-Y",strtotime($q1->tgl_keluar)) ?></td>
        </tr>
        <tr>
    		<td>2.</td>
            <td>Pemeriksaan Penunjang :
    	        <table class="table table-hover table-bordered table-striped">
    	            <thead>
    	                <tr class='bg-navy'>
    	                	<th class="text-center" style="vertical-align: middle" rowspan="2">No</th>
    	                    <th class="text-center" style="vertical-align: middle" rowspan="2">Tindakan</th>
    	                </tr>
    	                <tr class='bg-navy'>
    	                	<?php
    	                    	for($i=0;$i<5;$i++){
    	                    		echo '<th class="text-center" style="vertical-align: middle">Tanggal</th>';
    	                    		echo '<th class="text-center" style="vertical-align: middle">Hasil</th>';
    	                    	}
    	                    ?>
    	                </tr>
    	            </thead>
    	            <tbody>
    	                <?php
    	                	$n = 1;
    	                	// echo json_encode($swab);
                            foreach ($swab["list"] as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>".($n++)."</td>";
                                    echo "<td>".$value[0]->nama_tindakan."</td>";
                                    $tanggal = "";
                                        for($i=0;$i<5;$i++){
                                            if (isset($value[$i])){
                                                $r = $value[$i];
                                                $tanggal = date("d-m-Y",strtotime($r->tanggal));
                                                $hasil = $r->hasil;
                                            } else {
                                                $tanggal = $hasil = "";
                                            }
                                            echo '<td class="text-center" style="vertical-align: middle">'.$tanggal.'</td>';
                                            echo '<td class="text-center" style="vertical-align: middle">'.$hasil.'</td>';
                                        }
                                    echo "</tr>";

                            }
    	                ?>
    	            </tbody>
    	        </table>
    		</td>
        </tr>
        <tr>
            <td>3.</td>
            <td class="col-xs-10">Kondisi pulang pasien sudah dalam keadaan sehat dan tidak ada keluhan</td>
        </tr>
    </table>
<p>
	Demikian Surat Keterangan ini dibuat untuk digunakan sebagaimana mestinya
</p>
<br>
<br>
<br>
<table class="table no-border laporan2">
	<tr>
		<td align="center" width="40%">
            &nbsp;
        </td>
        <td align="center" width="40%">
            &nbsp;
        </td>
        <td>
            Cirebon, <?php echo  tgl(date("Y-m-d"),2); ?>
            <p>Yang Menyatakan</p>
        </td>
	</tr>
    <tr>
        <td align="center">
            &nbsp;
        </td>
        <td align="center">

        </td>
        <td>
            <div class="ttd_dokter"> </div>
            <br>
            <?php echo $q1->nama_dokter ?>
            <br>
            Sip.<?php echo $q1->no_sip ?>
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



    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan2 > thead > tr > th,
    .laporan2 > tbody > tr > th,
    .laporan2 > tfoot > tr > th,
    .laporan2 > thead > tr > td,
    .laporan2 > tbody > tr > td,
    .laporan2 > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
    }
    .laporan2 > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 0px solid #ddd;
    }
    .laporan2 > caption + thead > tr:first-child > th,
    .laporan2 > colgroup + thead > tr:first-child > th,
    .laporan2 > thead:first-child > tr:first-child > th,
    .laporan2 > caption + thead > tr:first-child > td,
    .laporan2 > colgroup + thead > tr:first-child > td,
    .laporan2 > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan2 > tbody + tbody {
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
      background-color: #FAFAFA;
      font: 12pt "Tahoma";
    }

    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .page {
      width: 21cm;
      min-height: 29.7cm;
      padding: 2cm;
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
      size: A4;
      margin: 0;
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
