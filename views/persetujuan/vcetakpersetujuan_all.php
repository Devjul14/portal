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
<?php if ($jenis=="ranap") : ?>
<div class='kertas'>
    <h4><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON</b></h4>
    <table class="laporan" width="100%" cellpadding="0">
        <tr>
            <td rowspan="4" align="center" style="vertical-align: middle;">
                <h4><b>SURAT PERNYATAAN PERSETUJUAN PERAWATAN DAN PENGOBATAN</b></h4>
            </td>
            <td width="10%">Nama</td>
            <td width="30%">: <?php echo $q->nama_pasien; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php  echo $q->jenis_kelamin ?>)</td>
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
    </table>
    <h4>Yang bertanda tangan di bawah ini :</h4>
    <table width="100%" class="laporan2">
        <tr>
            <td>Nama</td>
            <td>: <?php echo $q2->nama ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $q2->jk ?>)</td>
            <td rowspan="4">Umur : <?php echo $q2->umur ?> Tahun</td>
        </tr>
        <tr>
            <td>Pekerjaan / Jabatan</td>
            <td>: <?php echo $q2->pekerjaan ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?php echo $q2->alamat ?></td>
        </tr>
        <tr>
            <td>Hubungan dengan pasien</td>
            <td>: <?php echo $q2->hubungan ?></td>
        </tr>
    </table>
    <h3 align="center"><b>Menyatakan</b></h3>
    <table class="laporan2" width="100%">
    	<?php if ($q1->id_gol=="11"): ?>
    		<tr>
	            <td>
	                <input type="checkbox" disabled name="pernyataan0" value="Y" checked="true"> Persetujuan perawatan dan pengobatan dalam pelaksanaan prosedur diagnostik, pelayanan rutin RS dan pengobatan medis umum.
	            </td>
	        </tr>

	        <tr>
	            <td>
	                <input type="checkbox" disabled name="pernyataan1" value="Y" checked="true"> Persetujuan Membayar semua biaya perawatan dan pengobatan pada saat pasien pulang tanpa mengajukan persyaratan apapun.
	            </td>
	        </tr>
            <tr>
	            <td>
	                <input type="checkbox" disabled name="pernyataan4" value="Y" checked="true"> Tidak akan menggunakan fasilitas BPJS atau Perusahaan ......... selama pasien dirawat dan mendapat pelayanan fasilitas pasien umum.
	            </td>
	        </tr>
    	<?php else: ?>
    		<?php if ($q1->naik_kelas=="naik"): ?>
                <tr>
                    <td>
                        <input type="checkbox" disabled name="pernyataan0" value="Y" checked="true"> Persetujuan perawatan dan pengobatan dalam pelaksanaan prosedur diagnostik, pelayanan rutin RS dan pengobatan medis umum.
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" disabled name="pernyataan2" value="Y" checked="true"> Sanggup menunjukan kartu BPJS, atau pengantar dari perusahaan <?php echo $q1->perusahaan;?> dalam waktu selambat-lambatnya 3 x 24 jam hari kerja, sejak pasien dirawat , atau sebelum pasien pulang (jika dirawat kurang dari 3 hari)
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" disabled name="pernyataan3" value="Y" checked="true"> Persetujuan membayar selisih biaya BPJS/ Perusahaan dari kelas <?php echo $q1->hak_kelas;?> ke kelas <?php echo $q1->nama_kelas;?> pada saat pasien pulang tanpa mengajukan persyaratan apapun.
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td>
                        <input type="checkbox" disabled name="pernyataan0" value="Y" checked="true"> Persetujuan perawatan dan pengobatan dalam pelaksanaan prosedur diagnostik, pelayanan rutin RS dan pengobatan medis umum.
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" disabled name="pernyataan2" value="Y" checked="true"> Sanggup menunjukan kartu BPJS, atau pengantar dari perusahaan ............ dalam waktu selambat-lambatnya 3 x 24 jam hari kerja, sejak pasien dirawat , atau sebelum pasien pulang (jika dirawat kurang dari 3 hari)
                    </td>
                </tr>
            <?php endif ?>
    	<?php endif ?>
    </table>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat pernyataan ini kami buat dengan sebenarnya tanpa paksaan dari pihak manapun dan dapat dipergunakan sebagaimana mestinya.</p>
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
                <b>Yang Membuat Pernyataan</b>
            </td>
        </tr>
        <tr>
            <td align="center" >
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
<?php endif ?>
<div class="kertas">
<?php        
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

        $pernyataan     = explode(",", $q3->pernyataan);
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
        <p align="right">RM 01/RI/RSC</p>
    </p>
    <br>
    <h4 align="center"><b>PERSETUJUAN UMUM (GENERAL CONSENT) </b></h4>
    <hr style="border: 1px solid;">
    <p>Yang bertanda tangan di bawah ini :</p>
    <table width="100%" class="laporan2">
        <tr>
            <td>Nama</td>
            <td>: <?php echo $q3->nama ?></td>
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
            <td>No. Telp</td>
            <td>: <?php echo $q3->no_telpon ?></td>
        </tr>
        <tr>
            <td>Hubungan dengan pasien</td>
            <td>: <?php echo $q3->hubungan ?></td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>: <?php echo $q3->nama_pasien ?></td>
        </tr>
        <tr>
            <td>No Rekam Medis</td>
            <td>: <?php echo $q3->no_pasien ?></td>
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
                        • <?php echo $q3->pelepasan_informasi1 ?>
                    </p>
                    <p align="justify">
                        • <?php echo $q3->pelepasan_informasi2 ?>
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
                        • <?php echo $q3->keinginan_privasi1 ?>
                    </p>
                    <p align="justify">
                        • <?php echo $q3->keinginan_privasi2 ?>
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
    <p align="right">
        Cirebon, <?php echo  tgl(date("Y-m-d"),2); ?>
    </p>
    <p align="right">
        Jam <?php echo  date("H:i"); ?>
    </p>
    <br>
    <table class="laporan2" width="100%">
        <tr>
            <td align="center" width="30%">
                <b>Saksi</b>
            </td>
            <td align="center" >
                <b>Pihak Rumah Sakit</b>
            </td>
            <td align="center"  width="30%">
                <b>Pihak Pasien</b>
            </td>
        </tr>
        <tr>
            <td align="center">
                <div class="getttd_saksi"> </div>
                <br>
                <?php echo $q3->saksi ?>
            </td>
            <td align="center">
                <div class="getttd_prm"> </div>
                <br>
                <?php echo $q3->prm ?>
            </td>
            <td align="center">
                <div class="getttd_pernyataan"> </div>
                <br>
                <?php echo $q3->nama ?>
            </td>
        </tr>
    </table>
</div>
<div class="kertas">
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
</div>
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
<div class='kertas'>
    <h4><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON</b></h4>
    <table class="laporan" width="100%" cellpadding="0">
        <tr>
            <td rowspan="4" align="center" style="vertical-align: middle;">
                <h4><b>SURAT PERSETUJUAN / KONFIRMASI PENGGANTIAN PEMBAYARAN JAMINAN COVID -19</b></h4>
            </td>
            <td width="10%">Nama</td>
            <td width="30%">: <?php echo $q->nama_pasien; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php  echo $q->jenis_kelamin ?>)</td>
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
    </table>
    <h4>Yang bertanda tangan di bawah ini :</h4>
    <table width="100%" class="laporan2">
        <tr>
            <td>Nama</td>
            <td>: <?php echo $q2->nama ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $q2->jk ?>)</td>
            <td rowspan="4">Umur : <?php echo $q2->umur ?> Tahun</td>
        </tr>
        <tr>
            <td>No Identitas</td>
            <td>: <?php echo $q->ktp ?></td>
        </tr>
        <tr>
            <td>Pekerjaan / Jabatan</td>
            <td>: <?php echo $q2->pekerjaan ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?php echo $q2->alamat ?></td>
        </tr>
        <tr>
            <td>Hubungan dengan pasien</td>
            <td>: <?php echo $q2->hubungan ?></td>
        </tr>
    </table>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sesuai dengan Keputusan Mentri Kesehatan Nomor HK.01.07/MENKES/4344/2021 tentang Petunjuk Teknis Klaim Penggantian Biaya Pelayanan Pasien Corona Virus Disease 2019 (COVID-19) bagi Rumah Sakit Penyelenggara Corona Virus Disease 2019 (COVID-19), maka selama saya/keluarga saya dirawat di RS TK III CIREMAI CIREBON untuk kasus COVID-19 dan tidak dipungut biaya pelayanan kesehatan yang telah diberikan oleh pihak rumah sakit. </p>
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
                <b>Yang Membuat Pernyataan</b>
            </td>
        </tr>
        <tr>
            <td align="center" >
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