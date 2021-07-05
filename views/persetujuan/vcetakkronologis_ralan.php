<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
    
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
</head>
<script>
    $(document).ready(function(){
        getttd_saksi();
        getttd_pernyataan();
        getttd_prm();
		// window.print();
    });

    function getttd_prm(){
        var ttd = "<?php echo site_url('ttddokter/getttdprm/'.$q2->petugas_rm);?>";
        $('.getttd_prm').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_saksi(){
        var ttd = "<?php echo site_url('persetujuan/getttd_saksi/'.$no_reg.'/'.$no_pasien);?>";
        $('.getttd_saksi').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_pernyataan(){
        var ttd = "<?php echo site_url('persetujuan/getttd_pernyataan/'.$no_reg.'/'.$no_pasien);?>";
        $('.getttd_pernyataan').qrcode({width: 80,height: 80, text:ttd});
    }
</script>
<?php        
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


$t1 = new DateTime('today');
$t2 = new DateTime($q->tgl_lahir);
$y  = $t1->diff($t2)->y;
$m  = $t1->diff($t2)->m;
$d  = $t1->diff($t2)->d;

list($year,$month,$day) = explode("-",$q->tgl_lahir);
$year_diff  = date("Y") - $year;
$month_diff = date("m") - $month;
$day_diff   = date("d") - $day;
if ($month_diff < 0) { 
$year_diff--;
$month_diff *= (-1);
}
elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
if ($day_diff < 0) { 
$day_diff *= (-1);
}
$umur = $year_diff." tahun ".$month_diff." bulan ".$day_diff." hari ";

$pernyataan     = explode(",", $q2->pernyataan);
$pernyataan0    = $pernyataan[0];
$pernyataan1    = $pernyataan[1];
$pernyataan2    = $pernyataan[2];
$pernyataan3    = $pernyataan[3];
$pernyataan4    = $pernyataan[4];
?>
<h4><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON</b></h4>
<table class="laporan" width="100%">
    <tr>
        <td rowspan="4" align="center" style="vertical-align: middle;">
            <h4><b>SURAT KETERANGAN KRONOLOGIS</b></h4>
        </td>
        <td width="10%">Nama</td>
        <td width="30%">: <?php echo $q->nama_pasien; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php  echo $q->jk ?>)</td>
        <td width="10%">No. RM</td>
        <td width="30%">: <?php echo $no_pasien;?></td>
    </tr>
    <tr>
        <td>Umur</td> 
        <td>: <?php echo $umur; ?></td>
        <td>No Reg</td>
        <td> : <?php echo $no_reg ?></td>
    </tr>
    <tr>
        <td>Ruang : <?php echo $q1->nama_ruangan ?> </td>
        <td>Kelas : <?php echo $q1->nama_kelas ?></td>
        <td>Kamar : <?php echo $q1->nama_kamar ?></td>
        <td>BED : <?php echo $q1->no_bed ?></td>
    </tr>
</table><table width="100%">
    <tr>
        <th colspan='3' align="left">Yang bertanda tangan di bawah ini :</th>
    </tr>
    <tr>        
            <td>Nama <span style="float:right;">:</td><td> <?php echo $q2->nama ?></td>
        </tr>
        <tr>
            <td>Alamat <span style="float:right;">:</td><td> <?php echo $q2->alamat ?></td>
        </tr>
        <tr>
            <td>No Hp <span style="float:right;">:</td><td> <?php echo $q2->telpon ?></td>
        </tr>
        <tr>
            <td>Hubungan dengan pasien <span style="float:right;">:</td><td> <?php echo $q2->hubungan ?></td>
        </tr>
        <tr>
            <th colspan='3' align="left">Dengan ini menyatakan bahwa pasien :</th>
        </tr>
            <tr>
                <td>Nama <span style="float:right;">:</td><td> <?php echo $q->nama_pasien ?></td>
            </tr>
            <tr>
                <td>No Kartu BPJS <span style="float:right;">:</td><td> <?php echo $q->no_bpjs ?></td>
            </tr>
            <tr>
                <td>No Rm <span style="float:right;">:</td><td> <?php echo $no_pasien ?></td>
            </tr>
            <tr>
                <td>Tanggal Mulai Rawat <span style="float:right;">:</td><td> <?php echo date("d-m-Y",strtotime($q->tanggal)) ?></td>
            </tr>
            <tr>
                <th colspan='3' align="left">Dirawat di RS Ciremai diakibatkan oleh kejadian <b>trauma/bukan kecelakaan lalu lintas</b> dengan kronologis (urutan kejadian) sebagai berikut :</th>
            </tr>
        <tr>
            <tr>
                <td>Hari <span style="float:right;">:</td><td> <?php echo $q2->hari ?></td>
            </tr>
        </tr>
        <tr>
            <tr>
                <td>Tanggal Kejadian <span style="float:right;">:</td><td> <?php echo date("d-m-Y",strtotime($q2->tanggal)) ?></td>
            </tr>
        </tr>
        <tr>
            <tr>
                <td>Waktu <span style="float:right;">:</td><td> <?php echo $q2->waktu ?></td>
            </tr>
        </tr>
        <tr>
            <tr>
                <td>Lokasi <span style="float:right;">:</td><td> <?php echo $q2->lokasi ?></td>
            </tr>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;<?php echo $q2->kronologis ?></td>
        </tr>
    </table>
    <p>Demikian surat kronologis ini saya tulis dan nyatakan dengan sebenar-benarnya sesuai kejadian sesungguhnya, <b>serta dapat dipertanggung jawabkan sesuai hukum yang berlaku.</b> Dan bila dikemudian hari diperlukan keterangan lebih lanjut <i>dari BPJS Kesehatan maupun pihak pemeriksa lainnya</i> saya siap memberikan informasi.</p>
    <p align="right">
        Cirebon, <?php echo  tgl(date("Y-m-d"),2); ?>
    </p>
    <table class="laporan2" width="100%">
        <tr>
            <td align="center"  >
                <b>Saksi</b>
            </td>
            <td align="center" >
                <b>Yang Membuat Pernyataan</b>
            </td>
            <td align="center" >
                <b>Petugas RM</b>
            </td>
        </tr>
        <tr>
            <td align="center">
                <div class="getttd_saksi"> </div>
                <br>
                <?php echo $q2->saksi ?>
            </td>
            <td align="center">
                <div class="getttd_saksi"> </div>
                <br>
                <?php echo $q2->nama ?>
            </td>
            <td align="center">
                <div class="getttd_prm"> </div>
                <br>
                <?php echo $q2->prm ?>
            </td>
        </tr>
    </table>
    <style type="text/css">
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
    .laporan3 {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
        padding: 1px;
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
            padding: 4px;
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
            font-size: 14px;
        }
        .laporan2 {
            border-collapse: collapse !important;
            background-color: transparent;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
        }
        .laporan2 > thead > tr > th,
        .laporan2 > tbody > tr > th,
        .laporan2 > tfoot > tr > th,
        .laporan2 > thead > tr > td,
        .laporan2 > tbody > tr > td,
        .laporan2 > tfoot > tr > td {
            padding: 4px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 0px solid #ddd;
        }
        .laporan2 > thead > tr > th {
            margin-bottom: 20px;
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
    </style>