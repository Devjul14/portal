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
                        LAPORAN KEMATIAN
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
                        <td rowspan="2" class='text-center'>No</td>
                        <td rowspan="2" colspan="3" class='text-center'>GOLONGAN PERSONAL</td>
                        <td class='text-center' colspan="3">SEBAB KEMATIAN</td>
                        <td rowspan="2" class="text-center">JUMLAH</td>
                        <td rowspan="2" class="text-center">KETERANGAN</td>
                    </tr>
                    <tr>
                        <td class="text-center">CIDERA TEMPUR</td>
                        <td class="text-center">KECELAKAAN BUKAN TEMPUR</td>
                        <td class="text-center">SAKIT UMUM</td>
                    <tr>
                        <?php
                            for($i = 1; $i <= 7 ; $i++){
                                if ($i==2){
                                    echo "<td class='text-center' colspan='3'>".$i."</td>";
                                } else {
                                    echo "<td class='text-center'>".$i."</td>";
                                }
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="5" class='text-right'>1.</td>
                        <td rowspan="5">BPJS TNI AD</td>
                        <td rowspan="3">MILITER</td>
                        <td>SATPUR</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["SATPUR"]) ? $n["SATPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATPUR"]) ? $p["SATPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($n["SATPUR"]) ? $n["SATPUR"] : 0)+(isset($p["SATPUR"]) ? $p["SATPUR"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SATBANPUR</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["SATBANPUR"]) ? $n["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($n["SATBANPUR"]) ? $n["SATBANPUR"] : 0)+(isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SATBANMIN</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["SATBANMIN"]) ? $n["SATBANMIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATBANMIN"]) ? $p["SATBANMIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($n["SATBANMIN"]) ? $n["SATBANMIN"] : 0)+(isset($p["SATBANMIN"]) ? $p["SATBANMIN"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["SIPILTNIAD"]) ? $n["SIPILTNIAD"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SIPILTNIAD"]) ? $p["SIPILTNIAD"] : "");?></td>
                        <td class="text-right"><?php echo (isset($n["SIPILTNIAD"]) ? $n["SIPILTNIAD"] : 0)+(isset($p["SIPILTNIAD"]) ? $p["SIPILTNIAD"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["KELTNIAD"]) ? $n["KELTNIAD"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["KELTNIAD"]) ? $p["KELTNIAD"] : "");?></td>
                        <td class="text-right"><?php echo (isset($n["KELTNIAD"]) ? $n["KELTNIAD"] : 0)+(isset($p["KELTNIAD"]) ? $p["KELTNIAD"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3" class='text-right'>2.</td>
                        <td rowspan="3">BPJS TNI LAIN</td>
                        <td colspan="2">MILITER</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["MILLAIN"]) ? $n["MILLAIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["MILLAIN"]) ? $p["MILLAIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($n["MILLAIN"]) ? $n["MILLAIN"] : 0)+(isset($p["MILLAIN"]) ? $p["MILLAIN"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["SIPILLAIN"]) ? $n["SIPILLAIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SIPILLAIN"]) ? $p["SIPILLAIN"] : "");?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td class="text-right"></td>
                        <td class="text-right"><?php echo (isset($n["KELLAIN"]) ? $n["KELLAIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["KELLAIN"]) ? $p["KELLAIN"] : "");?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- <tr>
                        <td rowspan="3" class='text-right'>3.</td>
                        <td rowspan="3">BPJS TNI AU</td>
                        <td colspan="2">MILITER</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">JUMLAH</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3" class='text-right'>4.</td>
                        <td rowspan="3">POLRI</td>
                        <td colspan="2">MILITER</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">JUMLAH</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td class="text-right">5.</td>
                        <td colspan="3">PURNAWIRAWAN</td>
                        <td class="text-right"></td>
                        <td class='text-right'><?php echo (isset($n["PURNBPJS"]) ? $n["PURNBPJS"] : "");?></td>
                        <td class='text-right'><?php echo (isset($p["PURNBPJS"]) ? $p["PURNBPJS"] : "");?></td>
                        <td class='text-right'><?php echo (isset($n["PURNBPJS"]) ? $n["PURNBPJS"] : 0)+(isset($p["PURNBPJS"]) ? $p["PURNBPJS"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-right">6.</td>
                        <td colspan="3">BPJS DAN ASKES SELAIN TNI</td>
                        <td class="text-right"></td>
                        <td class='text-right'><?php echo (isset($n["UMUMBPJS"]) ? $n["UMUMBPJS"] : "");?></td>
                        <td class='text-right'><?php echo (isset($p["UMUMBPJS"]) ? $p["UMUMBPJS"] : "");?></td>
                        <td class='text-right'><?php echo (isset($n["UMUMBPJS"]) ? $n["UMUMBPJS"] : 0)+(isset($p["UMUMBPJS"]) ? $p["UMUMBPJS"] : 0);?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-right">7.</td>
                        <td colspan="3">UMUM DAN PERUSAHAAN</td>
                        <td class="text-right"></td>
                        <td class='text-right'><?php echo (isset($n["UMUMBPJS"]) ? $n["UMUMBPJS"] : "");?></td>
                        <td class='text-right'><?php echo (isset($p["UMUMPERUSAHAAN"]) ? $p["UMUMPERUSAHAAN"] : "");?></td>
                        <td class='text-right'><?php echo (isset($n["UMUMBPJS"]) ? $n["UMUMBPJS"] : 0)+(isset($p["UMUMPERUSAHAAN"]) ? $p["UMUMPERUSAHAAN"] : 0)?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">JUMLAH</td>
                        <?php
                            $totala = (isset($n["SATPUR"]) ? $n["SATPUR"] : 0)+
                                      (isset($n["SATBANPUR"]) ? $n["SATBANPUR"] : 0)+
                                      (isset($n["SATBANMIN"]) ? $n["SATBANMIN"] : 0)+
                                      (isset($n["SIPILTNIAD"]) ? $n["SIPILTNIAD"] : 0)+
                                      (isset($n["KELTNIAD"]) ? $n["KELTNIAD"] : 0)+
                                      (isset($n["MILLAIN"]) ? $n["MILLAIN"] : 0)+
                                      (isset($n["SIPILLAIN"]) ? $n["SIPILLAIN"] : 0)+
                                      (isset($n["KELLAIN"]) ? $n["KELLAIN"] : 0)+
                                      (isset($n["PURNBPJS"]) ? $n["PURNBPJS"] : 0)+
                                      (isset($n["UMUMBPJS"]) ? $n["UMUMBPJS"] : 0)+
                                      (isset($n["UMUMPERUSAHAAN"]) ? $n["UMUMPERUSAHAAN"] : 0);
                            $totalb = (isset($p["SATPUR"]) ? $p["SATPUR"] : 0)+
                                      (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : 0)+
                                      (isset($p["SATBANMIN"]) ? $p["SATBANMIN"] : 0)+
                                      (isset($p["SIPILTNIAD"]) ? $p["SIPILTNIAD"] : 0)+
                                      (isset($p["KELTNIAD"]) ? $p["KELTNIAD"] : 0)+
                                      (isset($p["MILLAIN"]) ? $p["MILLAIN"] : 0)+
                                      (isset($p["SIPILLAIN"]) ? $p["SIPILLAIN"] : 0)+
                                      (isset($p["KELLAIN"]) ? $p["KELLAIN"] : 0)+
                                      (isset($p["PURNBPJS"]) ? $p["PURNBPJS"] : 0)+(isset($p["UMUMBPJS"]) ? $p["UMUMBPJS"] : 0)+(isset($p["UMUMPERUSAHAAN"]) ? $p["UMUMPERUSAHAAN"] : 0);
                        ?>
                        <td class="text-right"></td>
                        <td class='text-right'><?php echo number_format($totala,0,',','.');?></td>
                        <td class='text-right'><?php echo number_format($totalb,0,',','.');?></td>
                        <td class='text-right'><?php echo number_format($totala+$totalb,0,',','.');?></td>
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