
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
		// window.print();
	</script>
<body>
<table width = "100%" align="right" border ="0" rules="rows" >
	<tr>
		<td>
			<table  width="100%" align="right" border="0">
				<tr>
					<td colspan="2">
						INSTALASI RADIOLOGI
					</td>
					<td></td>
				</tr>
		
				<tr>
					<td colspan="2">RUMAH SAKIT CIREMAI</td>
					<!-- <td width="25%">&nbsp;</td> -->
					
				</tr>
				<tr>
					<td colspan="2">JL. KESAMBI NO. 237 - CIREBON Telp. (0231) 238335</td>
					<!-- <td></td> -->
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr>
                        <th width="10" class='text-center'>No</th>
                        <th class='text-center'>Nomor REG</th>
                        <th >Nama</th>
                        <th class='text-center'>Tanggal/ Jam Daftar</th>
                        <th class='text-center'>Jam Pengaajuan</th>
                        <th class='text-center'>Jam Foto</th>
                        <th class="text-center">Jam Ekspertisi</th>
                        <th class="text-center">Respond Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    	$respond="";
                    	// $date = new DateTime($jam_lab);
						//$now = new DateTime($terima);
                        $i = 1;
                        foreach($q->result() as $data){

                        //$jam_lab = date('H:i:s', strtotime($data->jam_lab));
                    	//$terima = date('H:i:s', strtotime($data->terima_lab));
                    	//$diff = $jam_lab - $terima;
                    	//$jam   = floor($diff / (60 * 60));
						//$menit = $diff - $jam * (60 * 60);
						//$detik = $diff - ($jam.$menit) * (60 * 60);
						$t1 = new DateTime($data->jam_radiologi);
						$t2 = new DateTime($data->terima_radiologi);
						// if ($t1 == "0000-00-00 00:00:00"){
						// 	$is  = $t1->diff($t2)->i;
						// 	$s  = $t1->diff($t2)->s;	
						// }
						$h  = $t1->diff($t2)->h;
						$is  = $t1->diff($t2)->i;
						$s  = $t1->diff($t2)->s;

                        	if($data->tanggal == ''){
                        		$tanggal1 = "--";
                        	}
                        	else{
                        		$tanggal1 = date("d-m-Y",strtotime($data->tanggal));
                        	}

                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td class='no_reg text-center'>".$data->no_reg."";
                            echo "<td>".$data->nama_pasien."</td>";
                            echo "<td>".$tanggal1."</td>";
                        	echo "<td>".date("H:i:s",strtotime($data->terima_radiologi))."</td>";
                        	echo "<td>".date("H:i:s",strtotime($data->periksa_radiologi))."</td>";
                            echo "<td>".date("H:i:s",strtotime($data->jam_radiologi))."</td>";
                            echo "<td>".$h.' jam ,'.$is.' menit, '.$s.' detik'."</td>";
                            echo "</tr>";
                            
                        }
                    ?>
                </tbody>
            </table>
			<!-- <table width="100%">
				
				<tr>
					<td  colspan="4"><font size="10">
						<textarea class="form-control" style="size:11px;max-width: 100%;height:335px; border-style: none; border: none;">Sejawat YTH <?php echo $k->dokter_pengirim ?>

<?php echo $q->hasil_pemeriksaan ?></textarea></font>
					</td>
				</tr>
			<tr>
					<td></td>
					<td width="25%"> &nbsp;</td>
					<td></td>
					<td width="25%"> &nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td width="25%"> &nbsp;</td>
					<td></td>
					<td width="25%"> &nbsp;</td>
				</tr>
				
				
			</table> -->
		</td>
		
	</tr>
	<table border="1" rules="rows" width="100%">
		<tr>
			<td></td>
		</tr>
	</table>
	<table width="100%" align="right">
		<tr>
			<td>&nbsp;</td>
			<td width="25%">&nbsp; <?php echo date("d-m-Y", strtotime('today')); ?></td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;</td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;</td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;Instalasi Radiologi</td>
		</tr>
	</table>

</table>
<style type="text/css">
	html, body {
        display: block;
        /*font-family: "dotmatrik";*/
        width: 20cm; height: 13cm;
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
	    font-size: 12px;
	}
	th {
	    font-size: 12px;
	    font-weight: bold;
	}
	.text-right{
	    align:right;
	}
	textarea{
		font-size: 12px;
	}
	@page{
		width: 20cm; height: 13cm;
	}
</style>
</body>
</html>