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
    <p>
        <h5>
            <b>
                &nbsp;DETASEMEN KESEHATAN WILAYAH 03.04.03
            </b>
            <div class="pull-right">RM 01/RI/RSC</div>
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
    <h4 align="center"><b>PERSETUJUAN UMUM (GENERAL CONSENT) </b></h4>
    <hr style="border: 1px solid;">
    <p>Yang bertanda tangan di bawah ini :</p>
    <table width="100%" class="laporan2">
        <tr>
            <td>Nama</td>
            <td>: <?php echo $q2->nama ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>: <?php echo date("d-m-Y",strtotime($q2->tgl_lahir)) ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?php echo $q2->alamat ?></td>
        </tr>
        <tr>
            <td>No. Telp</td>
            <td>: <?php echo $q2->no_telpon ?></td>
        </tr>
        <tr>
            <td>Hubungan dengan pasien</td>
            <td>: <?php echo $q2->hubungan ?></td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>: <?php echo $q2->nama_pasien ?></td>
        </tr>
        <tr>
            <td>No Rekam Medis</td>
            <td>: <?php echo $q2->no_pasien ?></td>
        </tr>
    </table>
    <hr style="border: 1px solid;">
    <h5 align="center"><b>Selaku Pasien / Keluarga Pasien RS. Tingkat III 03.06.01 Ciremai dengan ini menyatakan persetujuan :</b></h5>
    <br>
    <table class="laporan2" width="100%">
        <tr>
            <td width="50%">
                A.  PELEPASAN INFORMASI (RELEASE OF INFORMATION) 
                    <p align="justify">
                        1.  Saya memberi wewenang kepada rumah sakit untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan bila diperlukan untuk memproses klaim asuransi /perusahaan dan atau lembaga pemerintah.
                    </p>
                    <p align="justify">
                        2.  Saya memberi wewenang kepada rumah sakit untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan saya kepada anggota keluarga / teman saya yaitu :
                    </p>
                    <p align="justify">
                        • <?php echo $q2->pelepasan_informasi1 ?>
                    </p>
                    <p align="justify">
                        • <?php echo $q2->pelepasan_informasi2 ?>
                    </p>
                B.  KEINGINAN PRIVASI (PRIVACY DESIRE)
                    <p align="justify">
                        1.  Saya memahami informasi yang ada di dalam diri saya, termasuk diagnosis, hasil laboratorium dan hasil tes diagnostik yang akan digunakan untuk perawatan medis, rumah sakit akan menjamin kerahasiannya.
                    </p>
                    <p align="justify">
                        2.  Pasien dapat ditunggu oleh 1 orang anggota keluarga, apabila dibutuhkan lebih dari 1 penunggu harus ada persetujuan dari petugas ruangan.
                    </p>
                    <p align="justify">
                        3.  Saya mengizinkan rumah sakit memberi akses bagi keluarga dan handai taulan serta orang-orang yang akan menengok saya kecuali kepada :
                    </p>
                    <p align="justify">
                        • <?php echo $q2->keinginan_privasi1 ?>
                    </p>
                    <p align="justify">
                        • <?php echo $q2->keinginan_privasi2 ?>
                    </p>
                C.  BARANG BERHARGA MILIK PRIBADI (WORTHY OF PERSONAL)
                    <p align="justify">
                        1.  Saya telah memahami bahwa rumah sakit tidak bertanggung jawab atas semua kehilangan barang-barang milik saya, dan saya pribadi bertanggung jawab atas barang-barang berharga yang saya bawa ke rumah sakit kecuali dititipkan ke rumah sakit.
                    </p>
                    <p align="justify">
                        2.  Barang berharga yang dapat dititipkan ke rumah sakit adalah uang dan dokumen yang berhubungan dengan proses perawatan di rumah sakit.
                    </p>
                D.  PERNYATAAN PASIEN (STATEMENT OF PATIENT)
                    <p align="justify">
                        Saya mengerti dan memahami bahwa :
                    </p>
                    <p align="justify">
                        1.  Saya memiliki kewajiban untuk memberikan informasi yang akurat dan lengkap tentang keluhan sakit sekarang, riwayat medis yang lalu, hospitalisasi, medikasi / pengobatan dan hal – hal lain yang berkaitan dengan kesehatan saya.
                    </p>
                    <p align="justify">
                        2.  Saya memiliki hak untuk mengajukan pertanyaan tentang pengobatan yang diusulkan (termasuk identitas setiap orang yang memberikan atau mengamati pengobatan ) setiap saat.
                    </p>
            </td>
            <td>
                <p align="justify">
                    3.  Saya memiliki hak untuk menyetujui atau menolak setiap prosedur / terapi.
                </p>
                <p align="justify">
                    4.  Saya mengerti bahwa banyak dokter dan perawat rumah sakit yang bukan karyawan  tetapi staf independen/tamu yang telah diberikan kewenangan untuk menggunakan fasilitas untuk perawatan dan pengobatan pasien mereka.
                </p>
                <p align="justify">
                    5.  Saya bersedia mematuhi aturan rumah sakit tentang dokter yang bertanggung jawab untuk perawatan saya selama dalam perawatan di rumah sakit jika diperlukan.
                </p>
                <p align="justify">
                    6.  Saya bersedia memenuhi kelengkapan data dan administrasi, dalam bentuk dokumen audio visual  jika diperlukan.
                </p>
                <p align="justify">
                    7.  Saya bersedia mengikuti aturan tentang alur penanganan complain di Rumah Sakit Ciremai.
                </p>
                <p align="justify">
                    8.  Saya memberi izin pelepasan informasi kesehatan pribadi saya sebagai sumber data sekunder untuk keperluan riset dan penelitian.
                </p>
                <p align="justify">
                    9.  Saya mengerti bahwa ada mahasiswa yang diberikan izin untuk melaksanakan praktik klinik di bawah bimbingan pembimbing klinik rumah sakit.
                </p>
                <p align="justify">
                    10. Apabila saya terlibat dalam penelitian atau prosedur eksperimental, maka hal tersebut hanya dapat dilakukan dengan sepengetahuan dan persetujuan saya.
                </p>
                <p align="justify">
                    11. Saya sudah membaca hak dan kewajiban pasien di Rumah Sakit Ciremai, apabila membutuhkan informasi tambahan saya akan menghubungi Staf Rumah Sakit.
                </p>
                <p align="justify">
                    12. Saya bersedia mengikuti tata tertib peraturan yang ada di Rumah Sakit Ciremai.
                </p>
                E.  PERSETUJUAN UNTUK PENGOBATAN (CONSENT FOR TREATMENT)      
                 
                <p align="justify">
                    1.  Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis, saya mengizinkan dokter dan profesional kesehatan  lainnya untuk melakukan prosedur diagnostik dan untuk memberikan pengobatan medis seperti yang diperlukan dalam penilaian professional mereka. Prosedur diagnostik dan perawatan medis tidak terbatas pada elektrokardiogram, X-ray, tes darah, terapi fisik dan pemberian obat.    
                </p>
                <p align="justify">
                    2.  Saya sadar bahwa praktik kedokteran dan bedah bukanlah ilmu pasti dan saya mengakui bahwa tidak ada jaminan atas hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yang di lakukan kepada saya, termasuk pada hasil pengobatan yang tidak diharapkan.
                </p>
                <p align="justify">
                    3.  Pasien hanya diperbolehkan pulang  seizin dokter yang merawat dan memiliki surat pulang rawat.
                </p>
                <p align="justify">
                    4.  Pasien yang pulang tanpa seizin dokter dinyatakan pulang paksa dan diwajibkan membuat surat penolakan dirawat.
                </p>
                <p align="justify">
                    5.  Rumah Sakit tidak menyarankan untuk membawa dan menyimpan makanan dari luar Rumah Sakit.
                </p>
            </td>
        </tr>
    </table>
    <hr style="border: 1px solid;">
    <table class="laporan2" width="100%">
        <tr>
            <td rowspan="3">Waktu Jam Besuk</td>
            <td>Siang</td>
            <td>: Jam 11.00 s/d 13.00 WIB</td>
            <td rowspan="3">Hari Minggu / Libur</td>
            <td>Siang</td>
            <td>: Jam 10.00 s/d 13.00 WIB</td>
        </tr>
        <tr>
            <td>Sore</td>
            <td>: Jam 17.00 s/d 19.00 WIB</td>
            <td>Sore</td>
            <td>: Jam 17.00 s/d 19.00 WIB</td>
        </tr>
        <tr>
            <td>Khusus</td>
            <td colspan="2">: Apabila ada kepentingan khusus setelah mendapatkan izin dari Satpam</td>
        </tr>
    </table>
    <p>Demikian saya / atas nama pasien tersebut diatas telah membaca serta memahami surat persetujuan umum ini, saya bersedia memenuhi ketentuan persetujuan tersebut diatas dan apabila saya melanggar ketentuan tersebut, maka saya siap menerima sanksi sesuai dengan ketentuan yang berlaku di Rumah Sakit Ciremai, berupa :</p>
    <p>
        1. Teguran Lisan
    </p>
    <p>
        2. Teguran tertulis berupa pernyataan
    </p>
    <p>
        3. Penarikan pengaduan apabila saya mengadukan komplain langsung kepada media massa/tidak sesuai dengan prosedur Rumah Sakit Ciremai
    </p>
    <table class="laporan2" width="100%">
        <tr>
            <td width="80%">&nbsp;</td>
            <td>
                Cirebon
            </td>
            <td>
                <?php echo  tgl(date("Y-m-d"),2); ?>        
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Jam</td>
            <td><?php echo date("H:i") ?> WIB</td>
        </tr>
    </table>
    <br>
    <table class="laporan2" width="100%">
        <tr>
            <td align="center"  >
                <b>Saksi</b>
            </td>
            <td align="center" >
                <b>Pihak Pasien</b>
            </td>
            <td align="center" >
                <b>Pihak Rumah Sakit</b>
            </td>
        </tr>
        <tr>
            <td align="center">
                <div class="getttd_saksi"> </div>
                <br>
                <?php echo $q2->saksi ?>
            </td>
            <td align="center">
                <div class="getttd_pernyataan"> </div>
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
</style>