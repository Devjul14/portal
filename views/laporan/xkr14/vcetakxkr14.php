<!DOCTYPE html>
<html>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
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
	<script>
		window.print();
	</script>
<body>
<body>
<div class="col-xs-12">
	<table  width="100%" align="right" border="0">
	    <tr>
	        <td class="text-center" colspan="2">
	            LAPORAN KELAHIRAN
	        </td>
	        <td></td>
	    </tr>
	    <?php
	        $bulan = array(
	                    "",
	                    "JANUARI",
	                    "FEBRUARI",
	                    "MARET",
	                    "APRIL",
	                    "MEI",
	                    "JUNI",
	                    "JULI",
	                    "AGUSTUS",
	                    "SEPTEMBER",
	                    "OKTOBER",
	                    "NOPEMBER",
	                    "DESEMBER"
	                );
	    ?>
	    <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
	    <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
	</table>
	<br>
	<table border="1" class="laporan" width="100%">
	    <thead>
	        <tr>
	            <td rowspan="3" class='text-center'>No</td>
	            <td rowspan="3" class='text-center'>STATUS</td>
	            <td class='text-center' colspan="4">SEBAB KELAHIRAN</td>
	            <td rowspan="3" class="text-center">KETERANGAN</td>
	        </tr>
	        <tr>
	            <td class='text-center' colspan="2">NORMAL</td>
	            <td class='text-center' colspan="2">PREMATUR</td>
	        </tr>
	        <tr>
	            <td class='text-center'>HIDUP</td>
	            <td class='text-center'>MATI 0-7 Hr.</td>
	            <td class='text-center'>HIDUP</td>
	            <td class='text-center'>MATI</td>
	        </tr>
	        <tr>
	            <?php
	                for($i = 1; $i <= 7 ; $i++){
	                    echo "<td class='text-center'>".$i."</td>";
	                }
	            ?>
	        </tr>
	    </thead>
	    <tbody>
	        <tr>
	            <td class='text-right'>1.</td>
	            <td>Anak Anggota TNI Angkatan Sendiri</td>
	            <td class="text-right"><?php echo (isset($nh["ANAKTNI"]) ? $nh["ANAKTNI"] : "");?></td>
	            <td class="text-right"><?php echo (isset($nm["ANAKTNI"]) ? $nm["ANAKTNI"] : "");?></td>
	            <td class="text-right"><?php echo (isset($ph["ANAKTNI"]) ? $ph["ANAKTNI"] : "");?></td>
	            <td class="text-right"><?php echo (isset($pm["ANAKTNI"]) ? $pm["ANAKTNI"] : "");?></td>
	            <td></td>
	        </tr>
	        <tr>
	            <td class='text-right'>2.</td>
	            <td>Anak Karyawan Sipil Angkatan Sendiri</td>
	            <td class="text-right"><?php echo (isset($nh["ANAKKARYAWANSIPIL"]) ? $nh["ANAKKARYAWANSIPIL"] : "");?></td>
	            <td class="text-right"><?php echo (isset($nm["ANAKKARYAWANSIPIL"]) ? $nm["ANAKKARYAWANSIPIL"] : "");?></td>
	            <td class="text-right"><?php echo (isset($ph["ANAKKARYAWANSIPIL"]) ? $ph["ANAKKARYAWANSIPIL"] : "");?></td>
	            <td class="text-right"><?php echo (isset($pm["ANAKKARYAWANSIPIL"]) ? $pm["ANAKKARYAWANSIPIL"] : "");?></td>
	            <td></td>
	        </tr>
	        <tr>
	            <td class='text-right'>3.</td>
	            <td>Anak Anggota Angkatan Lain</td>
	            <td class="text-right"><?php echo (isset($nh["ANAKANGGOTALAIN"]) ? $nh["ANAKANGGOTALAIN"] : "");?></td>
	            <td class="text-right"><?php echo (isset($nm["ANAKANGGOTALAIN"]) ? $nm["ANAKANGGOTALAIN"] : "");?></td>
	            <td class="text-right"><?php echo (isset($ph["ANAKANGGOTALAIN"]) ? $ph["ANAKANGGOTALAIN"] : "");?></td>
	            <td class="text-right"><?php echo (isset($pm["ANAKANGGOTALAIN"]) ? $pm["ANAKANGGOTALAIN"] : "");?></td>
	            <td></td>
	        </tr>
	        <tr>
	            <td class='text-right'>4.</td>
	            <td>Anak Anggota BPJS</td>
	            <td class="text-right"><?php echo (isset($nh["ANAKANGGOTABPJS"]) ? $nh["ANAKANGGOTABPJS"] : "");?></td>
	            <td class="text-right"><?php echo (isset($nm["ANAKANGGOTABPJS"]) ? $nm["ANAKANGGOTABPJS"] : "");?></td>
	            <td class="text-right"><?php echo (isset($ph["ANAKANGGOTABPJS"]) ? $ph["ANAKANGGOTABPJS"] : "");?></td>
	            <td class="text-right"><?php echo (isset($pm["ANAKANGGOTABPJS"]) ? $pm["ANAKANGGOTABPJS"] : "");?></td>
	            <td></td>
	        </tr>
	        <tr>
	            <td class='text-right'>5.</td>
	            <td>Purnawirawan</td>
	            <td class="text-right"><?php echo (isset($nh["ANAKPURN"]) ? $nh["ANAKPURN"] : "");?></td>
	            <td class="text-right"><?php echo (isset($nm["ANAKPURN"]) ? $nm["ANAKPURN"] : "");?></td>
	            <td class="text-right"><?php echo (isset($ph["ANAKPURN"]) ? $ph["ANAKPURN"] : "");?></td>
	            <td class="text-right"><?php echo (isset($pm["ANAKPURN"]) ? $pm["ANAKPURN"] : "");?></td>
	            <td></td>
	        </tr>
	        <tr>
	            <td class='text-right'>6.</td>
	            <td>Umum</td>
	            <td class="text-right"><?php echo (isset($nh["ANAKUMUM"]) ? $nh["ANAKUMUM"] : "");?></td>
	            <td class="text-right"><?php echo (isset($nm["ANAKUMUM"]) ? $nm["ANAKUMUM"] : "");?></td>
	            <td class="text-right"><?php echo (isset($ph["ANAKUMUM"]) ? $ph["ANAKUMUM"] : "");?></td>
	            <td class="text-right"><?php echo (isset($pm["ANAKUMUM"]) ? $pm["ANAKUMUM"] : "");?></td>
	            <td></td>
	        </tr>
	        <tr>
	            <td class='text-right'>7.</td>
	            <td>JUMLAH</td>
	            <?php
	                $total_hidup1 = (isset($nh["ANAKTNI"]) ? $nh["ANAKTNI"] : 0)+
	                                (isset($nh["ANAKKARYAWANSIPIL"]) ? $nh["ANAKKARYAWANSIPIL"] : 0)+
	                                (isset($nh["ANAKANGGOTABPJS"]) ? $nh["ANAKANGGOTABPJS"] : 0)+
	                                (isset($nh["ANAKPURN"]) ? $nh["ANAKPURN"] : 0)+
	                                (isset($nh["ANAKUMUM"]) ? $nh["ANAKUMUM"] : 0);
	                $total_hidup2 = (isset($nm["ANAKTNI"]) ? $nm["ANAKTNI"] : 0)+
	                                (isset($nm["ANAKKARYAWANSIPIL"]) ? $nm["ANAKKARYAWANSIPIL"] : 0)+
	                                (isset($nm["ANAKANGGOTABPJS"]) ? $nm["ANAKANGGOTABPJS"] : 0)+
	                                (isset($nm["ANAKPURN"]) ? $nm["ANAKPURN"] : 0)+
	                                (isset($nm["ANAKUMUM"]) ? $nm["ANAKUMUM"] : 0);
	                $total_mati1 =  (isset($ph["ANAKTNI"]) ? $ph["ANAKTNI"] : 0)+
	                                (isset($ph["ANAKKARYAWANSIPIL"]) ? $ph["ANAKKARYAWANSIPIL"] : 0)+
	                                (isset($ph["ANAKANGGOTABPJS"]) ? $ph["ANAKANGGOTABPJS"] : 0)+
	                                (isset($ph["ANAKPURN"]) ? $ph["ANAKPURN"] : 0)+
	                                (isset($ph["ANAKUMUM"]) ? $ph["ANAKUMUM"] : 0);
	                $total_mati2 =  (isset($pm["ANAKTNI"]) ? $pm["ANAKTNI"] : 0)+
	                                (isset($pm["ANAKKARYAWANSIPIL"]) ? $pm["ANAKKARYAWANSIPIL"] : 0)+
	                                (isset($pm["ANAKANGGOTABPJS"]) ? $pm["ANAKANGGOTABPJS"] : 0)+
	                                (isset($pm["ANAKPURN"]) ? $pm["ANAKPURN"] : 0)+
	                                (isset($pm["ANAKUMUM"]) ? $pm["ANAKUMUM"] : 0);
	            ?>
	            <td class='text-right'><?php echo number_format($total_hidup1,0,',','.');?></td>
	            <td class='text-right'><?php echo number_format($total_hidup2,0,',','.');?></td>
	            <td class='text-right'><?php echo number_format($total_mati1,0,',','.');?></td>
	            <td class='text-right'><?php echo number_format($total_mati2,0,',','.');?></td>
	            <td></td>
	        </tr>
	    </tbody>
	</table>
</div>
<style type="text/css">
	html, body {
        /*display: block;*/
        /*font-family: "dotmatrik";*/
        /*width: 20cm; height: 13cm;*/
    }
	.pull-right {
	    float: right;
	}
	.pull-left {
	    float: left;
	}
	th, td{
	    /*font-family: "dotmatrik";*/
	}
	td {
	    font-size: 8px;
	}
	th {
	    font-size: 8px;
	    font-weight: bold;
	}
	.text-right{
	    /*align:right;*/
	}
	textarea{
		/*font-size: 12px;*/
	}
	/*@page{
		width: 20cm; height: 13cm;
	}*/
</style>
</body>
</html>