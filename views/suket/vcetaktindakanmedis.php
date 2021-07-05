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
        var ttd = "<?php echo site_url('ttddokter/getttddokter/'.$p->saksirs);?>";
        $('.ttd_dokter').qrcode({width: 80,height: 80, text:ttd});
        var ttd = "<?php echo site_url('ttddokter/getpasientindakan/'.$no_reg."/".$jenis."/0");?>";
        $('.ttd_pasien').qrcode({width: 80,height: 80, text:ttd});
        var ttd = "<?php echo site_url('ttddokter/getpasientindakan/'.$no_reg."/".$jenis."/1");?>";
        $('.ttd_saksi').qrcode({width: 80,height: 80, text:ttd});
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
    // $umur = $year_diff;
    $lahir = new DateTime($q->tgl_lahir);
    $hari_ini = new DateTime();

    $diff = $hari_ini->diff($lahir);
    $umur = $diff->y;
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
<body>
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
<?php if ($tindakan=="kedokteran" && $p->tindakan_kedokteran!="") : ?>
<table class="table no-border laporan">
    <tr>
        <td rowspan=3 style="vertical-align:middle"><h4 align="center"><b>SURAT <?php echo ($p->status_tindakan_kedokteran=="1" ? "PERSETUJUAN" : "PENOLAKAN");?> TINDAKAN KEDOKTERAN</b></h4></td>
        <td>Nama Pasien<span style="float:right">:</span></td><td><?php echo $q->nama_pasien;?></td>
    </tr>
    <tr>
        <td>No RM<span style="float:right">:</span></td><td><?php echo $q->no_pasien;?></td>
    </tr>
    <tr>
        <td>Tgl Lahir<span style="float:right">:</span></td><td><?php echo ($q->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($q->tgl_lahir)));?></td>
    </tr>
</table>
<table class="table no-border laporan">
    <tr>
        <td colspan="3" align="center"><h5><b>PEMBERIAN INFORMASI</b></h5></td>
    </tr>
    <tr>
        <th class="text-center" width=5%>NO.</th>
        <th class="text-center" width=40%>JENIS INFORMASI</th>
        <th class="text-center">ISI INFORMASI</th>
    </tr>
    <?php
        $tindakan = "";
        $kedokteran = explode(",",$p->tindakan_kedokteran);
        $keterangan_kedokteran = explode("|",$p->keterangan_tindakan_kedokteran);
        foreach($kedokteran as $key => $value){
            echo "<tr>";
            echo "<td class='text-center'>".($key+1)."</td>";
            echo "<td>".$tm[$value]."</td>";
            echo "<td>".$keterangan_kedokteran[$key]."</td>";
            echo "</tr>";
            if ($value=="3") $tindakan = $keterangan_kedokteran[$key];
        }
    ?>
</table>
<table class="table no-border laporan">
    <tr>
        <td colspan="2" align="right">Cirebon, Tanggal <?php echo date("d-m-Y",strtotime($p->tanggal));?> Pukul <?php echo date("H:i",strtotime($p->tanggal));?></td>
    </tr>
    <tr>
        <td>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdiskusi</td>
        <td align="center" width="20%">
            Tanda Tangan<br>
            <div class="ttd_dokter"> </div><br><b><?php echo $dp["dokter"][$p->pelaksana_tindakan];?></b>
        </td>
    </tr>
    <tr>
        <td>Dengan ini menyatakan bahwa saya telah menerima informasi dari dokter sebagaimana di atas kemudian  saya beri tanda/paraf di kolom kanannya, dan telah memahaminya</td>
        <td align="center" width="20%">
            Tanda Tangan<br>
            <div class="ttd_pasien"> </div><br><b><?php echo $p->nama;?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2">* Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat</td>
    </tr>
    <tr>
        <td colspan="2" align="center"><h5><b><?php echo ($p->status_tindakan_kedokteran==1 ? "PERSETUJUAN" : "PENOLAKAN");?> TINDAKAN KEDOKTERAN</b></h5></td>
    </tr>
    <tr>
        <td colspan="2">
            Yang bertandatangan di bawah ini, saya<br>
            Nama : <?php echo $p->nama;?><br>
            Umur : <?php echo $p->umur;?>/ <?php echo ($p->jk=="L" ? "Laki-laki" : "Perempuan");?>,<br>
            Alamat : <?php echo $p->alamat;?> <br>
            dengan ini menyatakan <b><?php echo ($p->status_tindakan_kedokteran==1 ? "Persetujuan" : "Penolakan");?></b> untuk dilakukannya tindakan <?php echo $tindakan;?><br>
            terhadap <?php echo ($p->hubungan=="Saya" ? "" : $p->hubungan);?><br>
            Nama : <?php echo $q->nama_pasien;?><br>
            Umur/ Jenis Kelamin : <?php echo $umur."/ ".$jenis_kelamin;?><br>
            Alamat : <?php echo $q->alamat;?><br>
            <ul style="padding-left:20px">
                <li>Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti di atas kepada saya, termasuk risiko dan komplikasi yang mungkin timbul.</li>
                <li>Saya juga menyadari bahwa dokter melakukan suatu upaya dan oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.</li>
            </ul>
        </td>
    </tr>
</table>
<table class="table no-border laporan2">
    <tr>
        <td colspan="3" align="right">Cirebon, Tanggal <?php echo date("d-m-Y",strtotime($p->tanggal));?></td>
    </tr>
    <tr>
        <td width="30%" align="center">Yang Menyatakan,<br><div class="ttd_pasien"></div><br><b><?php echo $p->nama;?></b></td>
        <td width="40%" align="center">Perawat/ Bidan,<br><div class="ttd_dokter"> </div><br><b><?php echo $dp["dokter"][$p->pelaksana_tindakan];?></b></td>
        <td width="30%" align="center">Saksi,<br><div class="ttd_saksi"></div><br><b><?php echo $p->nama_saksi;?></b></td>
    </tr>
</table>
<?php endif ?>
<?php if ($tindakan=="anestesi" && $p->tindakan_anestesi!="") : ?>
<br>
<table class="table no-border laporan">
    <tr>
        <td rowspan=3 style="vertical-align:middle"><h4 align="center"><b>SURAT <?php echo ($p->status_tindakan_anestesi==1 ? "PERSETUJUAN" : "PENOLAKAN");?> TINDAKAN ANESTESI</b></h4></td>
        <td>Nama Pasien<span style="float:right">:</span></td><td><?php echo $q->nama_pasien;?></td>
    </tr>
    <tr>
        <td>No RM<span style="float:right">:</span></td><td><?php echo $q->no_pasien;?></td>
    </tr>
    <tr>
        <td>Tgl Lahir<span style="float:right">:</span></td><td><?php echo ($q->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($q->tgl_lahir)));?></td>
    </tr>
</table>
<table class="table no-border laporan">
    <tr>
        <td colspan="3" align="center"><h5><b>PEMBERIAN INFORMASI</b></h5></td>
    </tr>
    <tr>
        <th class="text-center" width=5%>NO.</th>
        <th class="text-center" width=40%>JENIS INFORMASI</th>
        <th class="text-center">ISI INFORMASI</th>
    </tr>
    <?php
        $tindakan = "";
        $anestesi = explode(",",$p->tindakan_anestesi);
        $keterangan_anestesi = explode("|",$p->keterangan_tindakan_anestesi);
        foreach($anestesi as $key => $value){
            echo "<tr>";
            echo "<td class='text-center'>".($key+1)."</td>";
            echo "<td>".$tm[$value]."</td>";
            echo "<td>".$keterangan_anestesi[$key]."</td>";
            echo "</tr>";
            if ($value=="3") $tindakan = $keterangan_anestesi[$key];
        }
    ?>
</table>
<table class="table no-border laporan">
    <tr>
        <td colspan="2" align="right">Cirebon, Tanggal <?php echo date("d-m-Y",strtotime($p->tanggal));?> Pukul <?php echo date("H:i",strtotime($p->tanggal));?></td>
    </tr>
    <tr>
        <td>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdiskusi</td>
        <td align="center" width="20%">
            Tanda Tangan<br>
            <div class="ttd_dokter"> </div><br><b><?php echo $dp["dokter"][$p->pelaksana_tindakan];?></b>
        </td>
    </tr>
    <tr>
        <td>Dengan ini menyatakan bahwa saya telah menerima informasi dari dokter sebagaimana di atas kemudian  saya beri tanda/paraf di kolom kanannya, dan telah memahaminya</td>
        <td align="center" width="20%">
            Tanda Tangan<br>
            <div class="ttd_pasien"> </div><br><b><?php echo $p->nama;?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2">* Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat</td>
    </tr>
    <tr>
        <td colspan="2" align="center"><h5><b><?php echo ($p->status_tindakan_anestesi==1 ? "PERSETUJUAN" : "PENOLAKAN");?> TINDAKAN ANESTESI</b></h5></td>
    </tr>
    <tr>
        <td colspan="2">
            Yang bertandatangan di bawah ini,<br>
            Nama : <?php echo $p->nama;?><br>
            Umur  : <?php echo $p->umur;?>/ <?php echo ($p->jk=="L" ? "Laki-laki" : "Perempuan");?>,<br>
            Alamat : <?php echo $p->alamat;?> <br>
            dengan ini menyatakan <b><?php echo ($p->status_tindakan_anestesi==1 ? "Persetujuan" : "Penolakan");?></b> untuk dilakukannya tindakan <?php echo $tindakan;?><br>
            terhadap <?php echo ($p->hubungan=="Saya" ? "" : $p->hubungan);?><br>
            Nama : <?php echo $q->nama_pasien;?><br>
            Umur/ Jenis Kelamin : <?php echo $umur."/ ".$jenis_kelamin;?><br>
            Alamat : <?php echo $q->alamat;?><br>
            <ul style="padding-left:20px">
                <li>Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti di atas kepada saya, termasuk risiko dan komplikasi yang mungkin timbul.</li>
                <li>Saya juga menyadari bahwa dokter melakukan suatu upaya dan oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.</li>
            </ul>
        </td>
    </tr>
</table>
<table class="table no-border laporan2">
    <tr>
        <td colspan="3" align="right">Cirebon, Tanggal <?php echo date("d-m-Y",strtotime($p->tanggal));?></td>
    </tr>
    <tr>
        <td width="30%" align="center">Yang Menyatakan,<br><div class="ttd_pasien"> </div><br><b><?php echo $p->nama;?></b></td>
        <td width="40%" align="center">Perawat/ Bidan,<br><div class="ttd_dokter"> </div><br><b><?php echo $dp["dokter"][$p->pelaksana_tindakan];?></b></td>
        <td width="30%" align="center">Saksi,<br><div class="ttd_saksi"> </div><br><b><?php echo $p->nama_saksi;?></b></td>
</table>
<?php endif ?>

<?php if ($tindakan=="transfusi" && $p->tindakan_transfusi!="") : ?>
<br>
<table class="table no-border laporan">
    <tr>
        <td rowspan=3 style="vertical-align:middle"><h4 align="center"><b>SURAT <?php echo ($p->status_tindakan_transfusi==1 ? "PERSETUJUAN" : "PENOLAKAN");?> TINDAKAN TRANSFUSI</b></h4></td>
        <td>Nama Pasien<span style="float:right">:</span></td><td><?php echo $q->nama_pasien;?></td>
    </tr>
    <tr>
        <td>No RM<span style="float:right">:</span></td><td><?php echo $q->no_pasien;?></td>
    </tr>
    <tr>
        <td>Tgl Lahir<span style="float:right">:</span></td><td><?php echo ($q->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($q->tgl_lahir)));?></td>
    </tr>
</table>
<table class="table no-border laporan">
    <tr>
        <td colspan="3" align="center"><h5><b>PEMBERIAN INFORMASI</b></h5></td>
    </tr>
    <tr>
        <th class="text-center" width=5%>NO.</th>
        <th class="text-center" width=40%>JENIS INFORMASI</th>
        <th class="text-center">ISI INFORMASI</th>
    </tr>
    <?php
        $tindakan = "";
        $transfusi = explode(",",$p->tindakan_transfusi);
        $keterangan_transfusi = explode("|",$p->keterangan_tindakan_transfusi);
        foreach($transfusi as $key => $value){
            echo "<tr>";
            echo "<td class='text-center'>".($key+1)."</td>";
            echo "<td>".$tm[$value]."</td>";
            echo "<td>".$keterangan_transfusi[$key]."</td>";
            echo "</tr>";
            if ($value=="3") $tindakan = $keterangan_transfusi[$key];
        }
    ?>
</table>
<table class="table no-border laporan">
    <tr>
        <td colspan="2" align="right">Cirebon, Tanggal <?php echo date("d-m-Y",strtotime($p->tanggal));?> Pukul <?php echo date("H:i",strtotime($p->tanggal));?></td>
    </tr>
    <tr>
        <td>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdiskusi</td>
        <td align="center" width="20%">
            Tanda Tangan<br>
            <div class="ttd_dokter"> </div><br><b><?php echo $dp["dokter"][$p->pelaksana_tindakan];?></b>
        </td>
    </tr>
    <tr>
        <td>Dengan ini menyatakan bahwa saya telah menerima informasi dari dokter sebagaimana di atas kemudian  saya beri tanda/paraf di kolom kanannya, dan telah memahaminya</td>
        <td align="center" width="20%">
            Tanda Tangan<br>
            <div class="ttd_pasien"> </div><br><b><?php echo $p->nama;?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2">* Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat</td>
    </tr>
    <tr>
        <td colspan="2" align="center"><h5><b><?php echo ($p->keterangan_tindakan_transfusi!="" ? "PERSETUJUAN" : "PENOLAKAN");?> TINDAKAN TRANSFUSI</b></h5></td>
    </tr>
    <tr>
        <td colspan="2">
            Yang bertandatangan di bawah ini,<br>
            Nama : <?php echo $p->nama;?><br>
            Umur  : <?php echo $p->umur;?>/ <?php echo ($p->jk=="L" ? "Laki-laki" : "Perempuan");?>,<br>
            Alamat : <?php echo $p->alamat;?> <br>
            dengan ini menyatakan <b><?php echo ($p->status_tindakan_transfusi==1 ? "Persetujuan" : "Penolakan");?></b> untuk dilakukannya tindakan <?php echo $tindakan;?><br>
            terhadap <?php echo ($p->hubungan=="Saya" ? "" : $p->hubungan);?><br>
            Nama : <?php echo $q->nama_pasien;?><br>
            Umur/ Jenis Kelamin : <?php echo $umur."/ ".$jenis_kelamin;?><br>
            Alamat : <?php echo $q->alamat;?><br>
            <ul style="padding-left:20px">
                <li>Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti di atas kepada saya, termasuk risiko dan komplikasi yang mungkin timbul.</li>
                <li>Saya juga menyadari bahwa dokter melakukan suatu upaya dan oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.</li>
            </ul>
        </td>
    </tr>
</table>
<table class="table no-border laporan2">
    <tr>
        <td colspan="3" align="right">Cirebon, Tanggal <?php echo date("d-m-Y",strtotime($p->tanggal));?></td>
    </tr>
    <tr>
        <td width="30%" align="center">Yang Menyatakan,<br><div class="ttd_pasien"> </div><br><b><?php echo $p->nama;?></b></td>
        <td width="40%" align="center">Perawat/ Bidan,<br><div class="ttd_dokter"> </div><br><b><?php echo $dp["dokter"][$p->saksirs];?></b></td>
        <td width="30%" align="center">Saksi,<br><div class="ttd_saksi"> </div><br><b><?php echo $p->nama_saksi;?></b></td>
</table>
<?php endif ?>
</body>
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
      background-color: #FFFFFF;
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
