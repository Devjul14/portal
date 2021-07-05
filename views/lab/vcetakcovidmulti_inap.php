
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
		$(document).ready(function(){
			getttd();
            getttd1();
			window.print();
		});

		function getttd(id){
			var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'+id);?>";
            $('.ttd_qrcode').qrcode({width: 80,height: 80, text:ttd});
		}
        function getttd1($id){
			var ttd = "<?php echo site_url('ttddokter/getttdanalys/'+id);?>";
            $('.ttd_qrcode_analys').qrcode({width: 80,height: 80, text:ttd});
		}
	</script>
<body>
<table width = "100%" align="right" border ="0" rules="rows" cellpadding="0" cellspacing="0" >
	<tr>
		<td>
			<table width="100%" align="right" border="0" cellpadding="0" cellspacing="0" style="padding: -5px; margin-top: -5px; margin-bottom: -1px;">
				<tr  style="margin-bottom: -5px;">
					<td colspan="2">
						<strong>LABORATORIUM KLINIK</strong>
					</td>
					<td width="25%">
						<strong>ASAL SAMPEL  </strong>
					</td>
					<td>&nbsp;:&nbsp;<?php echo $q->nama_ruangan ?></td>
				</tr>
		
				<tr style="margin-bottom: -5px;">
					<td colspan="2">RUMAH SAKIT CIREMAI</td>
					<td>Alamat</td>
					<td width="25%">&nbsp;:&nbsp;<?php echo $no_reg ?></td>
				</tr>
				<tr style="margin-bottom: -5px;">
					<td colspan="2">JL. KESAMBI NO. 237 - CIREBON Telp. (0231) 238335</td>
					<td>Jenis Pemeriksaan </td>
					<td width="25%">&nbsp;:&nbsp;Identifikasi Materi Genetik SARS-nCoV-2</td>
				</tr>
				<tr style="margin-bottom: -5px;">
					<td colspan="2"></td>
					<td><strong>Metode</strong></td>
					<td width="25%">&nbsp;<strong>:&nbsp;Real Time Polymerase Chain Reaction (RT-PCR) with CDC Guideline</strong></td>
				</tr>
                <tr style="margin-bottom: -5px;">
					<td colspan="2"></td>
					<td><strong>Tanggal Terima</strong></td>
					<td width="25%">&nbsp;<strong>:&nbsp;</strong></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" align="right">
				<tr>
					<td align ="center" width="25%"><font size="4"><strong> HASIL PEMERIKSAAN LABORATORIUM </strong></font></td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>
			<table cellspacing="2" cellpadding="1"  width="100%" align="right" border="1">
				<thead>
					<tr>
						<td rowspan="2" align="center" width="10"><strong>No </strong></td>
						<td rowspan="2" align="center"><strong>Kode </strong></td>
						<td rowspan="2" align="center"><strong>Nama </strong></td>
						<td rowspan="2" align="center"><strong>JK </strong></td>
						<td rowspan="2" align="center"><strong>Tgl Lahir </strong></td>
						<td rowspan="2" align="center"><strong>Umur </strong></td>
						<td rowspan="2" align="center"><strong>Alamat </strong></td>
						<td rowspan="2" align="center"><strong>Metode </strong></td>
						<td align="center" colspan="3"><strong>CT </strong></td>
						<td rowspan="2" colspan="2" align="center"><strong>Hasil Pemeriksaan</strong></td>
					</tr>
					<tr>
						<td align="center"><strong>N1</strong></td>
						<td align="center"><strong>N2</strong></td>
						<td align="center"><strong>RP</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($no_reg as $key => $value) {
							$i++;
							$tgl_lahir = (isset($q1[$value]->tgl_lahir) ? $q1[$value]->tgl_lahir : "");
							list($year,$month,$day) = explode("-",$tgl_lahir);
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
					        $umur = $year_diff." tahun";

							echo "<tr>";
							echo "<td>".$i.".</td>";
							echo "<td>".(isset($q1[$value]->kode) ? $q1[$value]->kode : "")."</td>";
							echo "<td>".(isset($q1[$value]->nama_pasien) ? $q1[$value]->nama_pasien : "")."</td>";
							echo "<td>".(isset($q1[$value]->jk) ? $q1[$value]->jk : "")."</td>";
							echo "<td>".(isset($q1[$value]->tgl_lahir) ? $q1[$value]->tgl_lahir : "")."</td>";
							echo "<td>".($tgl_lahir ? $umur : "-")."</td>";
							echo "<td>".(isset($q1[$value]->alamat) ? $q1[$value]->alamat : "")."</td>";
							echo "<td>CDC</td>";
							echo "<td>".(isset($q1[$value]->n1) ? $q1[$value]->n1 : "")."</td>";
							echo "<td>".(isset($q1[$value]->n2) ? $q1[$value]->n2 : "")."</td>";
							echo "<td>".(isset($q1[$value]->rp) ? $q1[$value]->rp : "")."</td>";
							echo "<td>Nasoparing Hidung</td>";
							echo "<td>".(isset($q1[$value]->hasil) ? $q1[$value]->hasil : "")."</td>";
							echo "</tr>";

							echo "<input type='hidden' name='no_reg' value='".$value."'>";
							echo "<input type='text' name='id_dokter' value='".(isset($q1[$value]->id_dokter) ? $q1[$value]->id_dokter : "")."'>";
							echo "<input type='text' name='id_analys' value='".(isset($q1[$value]->id_analys) ? $q1[$value]->id_analys : "")."'>";
						}
						// foreach ($q1->result() as $row){
						// 	echo "<tr>";
						// 	echo "<td align='center'>".$row->kode."</td>";
						// 	echo "<td align='center'>CDC</td>";
						// 	echo "<td>".$row->n1."</td>";
						// 	echo "<td>".$row->n2."</td>";
						// 	echo "<td>".$row->rp."</td>";
						// 	echo "<td align='center'>Nasopari Hidung</td>";
						// 	echo "<td align='center'>".$row->hasil."</td>";
						// 	echo "</tr>";
						// }
					?>
				</tbody>
			</table>
		</td>
	</tr>
</table>
<hr>
	<table width="100%" align="right">
		<tr>
			<td width="25%" align="center" style="border-top:1px solid">PENANGGUNG JAWAB <br>	
			<br><div class="ttd_qrcode"></div></td>
			<!-- <td width="25%" align="center">&nbsp;Cirebon <?php echo date("d-m-Y H:i:s"); ?> -->
			<td width="25%" align="center" style="border-top:1px solid">&nbsp;Cirebon <?php echo date("d-m-Y", strtotime($gt->tglp)) ?>
				<br>&nbsp;&nbsp;PETUGAS LAB<br>
                <div class="ttd_qrcode_analys"></div>
			</td>
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
				<td width="25%" align="center"> <?php echo $nama_dokter ?>
				</td>
				<td width="25%" align="center"> <?php echo $namaanalys; ?></td>
		</tr>
	</table>

<style type="text/css">
	html, body {
        display: block;
        font-family: "sans-serif";
        width: 20cm;
         /*height: 13cm;*/
    }
	.pull-right {
	    float: right;
	}
	.pull-left {
	    float: left;
	}
	th, td{
	    font-family: "sans-serif";
	}
	td {
	    font-size: 13px;
	}
	th {
	    font-size: 13px;
	    font-weight: bold;
	}
	.text-right{
	    align:right;
	}
	hr{
		color: black;
	}
	textarea{
		font-size: 13px;
	}
	@page{
		width: 20cm; 
		/*height: 13cm;*/
	}
	.a{
    table-layout:fixed;
	}

	.ai{
    overflow:hidden;
	}
</style>
</body>
</html>