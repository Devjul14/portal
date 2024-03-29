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
        window.print();
    });
    function getttd_prm(){
        var ttd = "<?php echo site_url('ttddokter/getttdprm/'.$q2->petugas_rm);?>";
        $('.getttd_prm').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_saksi(){
        var ttd = "<?php echo site_url('persetujuan/getttd_saksi2/'.$no_reg.'/'.$no_pasien);?>";
        $('.getttd_saksi').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_pernyataan(){
        var ttd = "<?php echo site_url('persetujuan/getttd_pernyataan2/'.$no_reg.'/'.$no_pasien);?>";
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
<div class='kertas'>
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
    <hr style="border: 1px solid;">
    <h4 align="center"><b>SURAT PERYATAAN INFORMASI PASIEN TERKAIT COVID-19</b></h4>
    <table width="100%" class="laporan2">
        <tr>
            <td>Bahwa yang bertanda-tangan di bawah ini</td>
            <td>: </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: <?php echo $q2->nama ?> </td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>: <?php echo date("d-m-Y",strtotime($q3->tgl_lahir)) ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?php echo $q3->alamat ?></td>
        </tr>
        <tr>
            <td>No Telp</td>
            <td>: <?php echo $q3->no_telpon ?></td>
        </tr>
        <tr>
            <td>Selaku <?php echo $q2->hubungan ?> atas nama pasien di bawah ini</td>
            <td>: </td>
        </tr>
        <tr>
            <td>No RM</td>
            <td>: <?php echo $no_pasien ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: <?php echo $q->nama_pasien ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>: <?php echo date("d-m-Y",strtotime($q->tgl_lahir)) ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?php echo $q->alamat ?></td>
        </tr>
    </table>
    <p align="justify">
        Menyatakan bahwa saya memberikan informasi dan keluhan masalah kesehatan pasien dengan jujur. lengkap, dan sebenar-benamya tidak ada yang kami tutup-tutupi atau kami sembunyikan,<b>TERUTAMA HAL YANG TERKAIT DENGAN COVID-19. </b>
    </p>
    <p align="justify">
        Apabila di kemudian bari ditemukan bukti/ fakta bahwa saya berbohong atau tidak jujur mengenai hal ini, maka saya bersedia untuk :
    </p>
    <p align="justify">
        Dîlaporkan ke pihak  <b>KEPOLISIAN</b> atas kebohongan yang saya berikan dengan dugaan tindak
    </p>
    <p align="justify">
        <ol>
            <li align="justify">
                Memberikan keterangan palsu secara lisan & tertulis  berdasarkan Pasal 242 ayat (1 ) dan ayat (3) Kitab Undang-Undang Hukum Pidana (KUHP).
            </li>
            <li align="justify">
                Pemalsuan isi surat pernyataan pasien beradasarkan Pasal 263 ayat (1) Kitab Undang-Undang Hukum Pidana (KUHP).
            </li>
            <li align="justify">
                Sengaja menghalangi pelaksanaan penanggulangan wabah berdasarkan Pasal 14 Undang - Undang Nomor 4 Tahun 1964 Tentang Wabah Penyakit Menular.
            </li>
            <li align="justify">
                Tidak mematuhi penyelenggaraan kekarantinaan kesehatan dan / atau menghalang-halangi penyelenggaraan kekarantinaan kesehatan sehingga menyebabkan Kedaruratan Kesehatan Masyarakat berdasarkan Pasal 93 Undang-Undang Nomor 6 Tahun 2018 Tentang Kekarantinaan Kesehatan.
            </li>
        </ol>
    </p>
    <p align="justify">
        Demikian surat pernyataan ini saya buat, pernyataan ini beriaku selama pasien berobat di RS Ciremai dan mempunyai kekuatan hukum mengikat sehingga dapat dipergunakan sebagaimana mestinya. 
    </p>
    <p align="right">
        Cirebon, <?php echo  tgl(date("Y-m-d"),2); ?>
    </p>
    <table class="laporan2" width="100%">
        <tr>
            <td align="center" width="30%">
                <b>Saksi</b>
            </td>
            <td align="center" >
                <b>Petugas RM</b>
            </td>
            <td align="center" width="30%">
                <b>Yang Menyatakan</b>
            </td>
        </tr>
        <tr>
            <td align="center">
                <div class="getttd_saksi"> </div>
                <br>
                <?php echo $q2->saksi ?>
            </td>
            <td align="center">
                <div class="getttd_prm"> </div>
                <br>
                <?php echo $q2->prm ?>
            </td>
            <td align="center">
                <div class="getttd_saksi"> </div>
                <br>
                <?php echo $q2->nama ?>
            </td>
        </tr>
    </table>
</div>   
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
        padding: 2px;
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
        padding: 2px;
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
    .kertas {
        width: 21cm;
        min-height: 29.7cm;
        padding: 2cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    /* @page {
        size: A4;
        margin: 0;
    } */

    @media print {
        .kertas {
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