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
    <h4><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON</b></h4>
    <table class="laporan" width="100%">
        <tr>
            <td rowspan="4" align="center" style="vertical-align: middle;">
                <h4><b>SURAT PERNYATAAN PERSETUJUAN PERAWATAN DAN PENGOBATAN</b></h4>
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
	        	        <input type="checkbox" disabled name="pernyataan2" value="Y" checked="true"> Sanggup menunjukan kartu BPJS, atau pengantar dari perusahaan ............ dalam waktu selambat-lambatnya 3 x 24 jam hari kerja, sejak pasien dirawat , atau sebelum pasien pulang (jika dirawat kurang dari 3 hari)
	        	    </td>
	        	</tr>
	        	<tr>
			        <td>
			            <input type="checkbox" disabled name="pernyataan3" value="Y" checked="true"> Persetujuan membayar selisih biaya BPJS/ Perusahaan dari kelas .................... ke kelas .................. pada saat pasien pulang tanpa mengajukan persyaratan apapun.
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