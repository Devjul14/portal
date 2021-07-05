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
        getttd();
        getttd_perawat();
        getttd_perawat2();
        getttd_perawatigd();
		window.print();
    });

    function getttd(){
        var ttd = "<?php echo site_url('ttddokter/getttdpasien/'.$no_pasien);?>";
        $('.pasien_qrcode').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_perawat(){
        var ttd = "<?php echo site_url('ttddokter/getttdperawat/'.$ap->pemberi);?>";
        $('.ttd_pemberi').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_perawat2(){
        var ttd = "<?php echo site_url('ttddokter/getttdperawat/'.$ap->penerima);?>";
        $('.ttd_penerima').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_perawatigd(){
        var ttd = "<?php echo site_url('ttddokter/getttdperawat/'.$tg->petugas_igd);?>";
        $('.ttd_perawatigd').qrcode({width: 80,height: 80, text:ttd});
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
    <h4 align="center"><b>HAK DAN KEWAJIBAN PASIEN </b></h4>
    <h4 align="center">(Sesuai PMK No. 4 tahun 2018)</h4>
    <br>
    <p align="center">
        <b>
            Hal-Hal yang menjadi hak pasien / keluarga adalah :
        </b>
    </p>
    <p>
        1.  Pasien berhak memperoleh informasi mengenai tata tertib dan peraturan yang berlaku di Rumah Sakit
    </p>
    <p>
        2.  Pasien berhak memperoleh informasi tentang hak dan kewajiban Pasien;
    </p>
    <p>
        3.  Pasien berhak mengajukan pengaduan atas kualitas pelayanan yang didapatkan;
    </p>
    <p>
        4.  Pasien berhak memilih dokter, dokter gigi, dan kelas perawatan sesuai dengan keinginannya dan peraturan yang berlaku di Rumah Sakit;
    </p>
    <p>
        5.  Pasien berhak meminta konsultasi tentang penyakit yang dideritanya kepada dokter lain yang mempunyai Surat Izin Praktik (SIP) baik di dalam maupun di luar Rumah Sakit;
    </p>
    <p>
        6.  Pasien berhak mendapatkan privasi dan kerahasiaan penyakit yang diderita termasuk data medisnya;
    </p>
    <p>
        7.  Pasien berhak mendapat informasi yang meliputi diagnosis dan tata cara tindakan medis, tujuan tindakan medis, alternatif tindakan, risiko dan komplikasi yang mungkin terjadi, dan prognosis terhadap tindakan yang dilakukan serta perkiraan biaya pengobatan;
    </p>
    <p>
        8.  Pasien berhak memberikan persetujuan atau menolak atas tindakan yang akan dilakukan oleh Tenaga Kesehatan terhadap penyakit yang dideritanya;
    </p>
    <p>
        9.  Pasien berhak didampingi keluarganya dalam keadaan kritis;
    </p>
    <p>
        10. Pasien berhak menjalankan ibadah sesuai agama atau kepercayaan yang dianutnya selama hal itu tidak mengganggu Pasien lainnya;
    </p>
    <p>
        11. Pasien berhak memperoleh keamanan dan keselamatan dirinya selama dalam perawatan di Rumah Sakit;
    </p>
    <p>
        12. Pasien berhak mengajukan usul, saran, perbaikan atas perlakuan Rumah Sakit terhadap dirinya;
    </p>
    <p>
        13. Pasien berhak memperoleh layanan yang manusiawi, adil, jujur, dan tanpa diskriminasi
    </p>
    <p>
        14. Pasien berhak memperoleh layanan kesehatan yang bermutu sesuai dengan standar profesi dan standar prosedur operasional;
    </p>
    <p>
        15. Pasien berhak memperoleh layanan yang efektif dan efisien sehingga Pasien terhindar dari kerugian fisik dan materi;
    </p>
    <p>
        16. Pasien berhak menolak pelayanan bimbingan rohani yang tidak sesuai dengan agama dan kepercayaan yang dianutnya;
    </p>
    <p>
        17. Pasien berhak menggugat dan/atau menuntut Rumah Sakit apabila Rumah Sakit diduga memberikan pelayanan yang tidak sesuai dengan standar baik secara perdata ataupun pidana; dan
    </p>
    <p>
        18. Pasien berhak mengeluhkan pelayanan Rumah Sakit yang tidak sesuai dengan standar pelayanan melalui media cetak dan elektronik sesuai dengan ketentuan peraturan perundang-undangan.
    </p>
    <br>
    <p align="center">
        <b>
            Hal-Hal yang menjadi hak pasien / keluarga adalah :
        </b>
    </p>
    <p>
        1.  Mematuhi peraturan yang berlaku di rumah sakit
    </p>
    <p>
        2.  Menggunakan fasilitas Rumah Sakit secara bertanggung jawab;
    </p>
    <p>
        3.  Menghormati hak Pasien lain, pengunjung dan hak Tenaga Kesehatan serta petugas lainnya yang bekerja di Rumah Sakit ;
    </p>
    <p>
        4.  Memberikan informasi yang jujur, lengkap dan akurat sesuai dengan kemampuan dan pengetahuannya tentang masalah kesehatannya;
    </p>
    <p>
        5.  Memberikan informasi mengenai kemampuan finansial dan jaminan kesehatan yang dimilikinya;
    </p>
    <p>
        6.  Mematuhi rencana terapi yang direkomendasikan oleh Tenaga Kesehatan di Rumah Sakit dan disetujui oleh Pasien yang bersangkutan setelah mendapatkan penjelasan sesuai dengan ketentuan peraturan perundang-undangan;
    </p>
    <p>
        7.  Menerima segala konsekuensi atas keputusan pribadinya untuk menolak rencana terapi yang direkomendasikan oleh Tenaga Kesehatan dan/atau tidak mematuhi petunjuk yang diberikan oleh Tenaga Kesehatan untuk penyembuhan penyakit atau masalah kesehatannya; dan
    </p>
    <p>
        8.  Memberikan imbalan jasa atas pelayanan yang diterima.
    </p>

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
</style><!DOCTYPE html>
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