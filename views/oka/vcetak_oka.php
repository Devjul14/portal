<!DOCTYPE html>
<html>
<head>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak OK</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />

</head>
	<script>
		window.print(); 
	</script>
	<title></title>
</head>
<body>
<div style="page-break-before:always;">
	<table>
		<tr>
		<table width = "100%" align="right"  border="0">
			<tr>
				<td colspan="2">
					<h4>
						DATASEMEN KESEHATAN WILAYAH 03.04.03 <br>
						RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON
					</h4>
				</td>
				<td><strong>RM 11.1C.d/R/RSC</strong></td>	
			</tr>
		</table>
			<?php
					$t1 = new DateTime('today');
					$t2 = new DateTime($q->tgl_lahir);
					$y  = $t1->diff($t2)->y;
					$m  = $t1->diff($t2)->m;
					$d  = $t1->diff($t2)->d;

				?>			
	<center><h3>LAPORAN OPERASI</h3></center>
	<table width ="100%" align="right" border ="1" >
		<tr>
			<td>
				<table  width="100%" align="right"border="0" >
					<tr>
						<td rowspan="1" colspan="1">Nama</td>
						<td colspan="2"> : <?php echo $q->nama?></td>
						<td>No. Rm </td>
						<td> : <?php echo $q->no_rm?></td>
					</tr>
					<tr>
						<td rowspan="1" colspan="1">Tgl Lahir/Umur</td>
						<td> : <?php echo date("d-m-Y",strtotime($q->tgl_lahir))."&nbsp;(".$y.' tahun '.$m.' bulan '.$d.' hari'.")"?></td>
						<td></td>
						<td>R/Kelas</td>
						<td> : <?php echo $q->ruangan."/".$q->kelas ?></td>
					</tr>
					<tr>
						<td rowspan="1" colspan="1">Dokter</td>
						<td colspan="4"> : <?php echo $q->dokter_op?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" align="right"border="0">
				<tr>
					<td width="25%">Tanggal Operasi </td>
					<td colspan="3"> : <?php echo $q->tanggal ?></td>
				</tr>
				<tr>
					<td>Operator </td>
					<td width="25%"> : <?php echo $q->dokter_op ?></td>
					<td width="25%">Anestesi </td>
					<td width="25%"> : <?php echo $q->dokter_an?></td>
				</tr>
				<tr>
					<td>Operator 2</td>
					<td width="25%" colspan="3"> : <?php echo $q->dokter_op2 ?></td>
				</tr>
				<tr>
					<td>Asisten 1 </td>
					<td width="25%"> : <?php echo $q->asisten_op?></td>
					<td>Asisten 1</td>
					<td width="25%"> : <?php echo $q->asisten_an?></td>
				</tr>
				<tr>
					<td>Asisten 2 </td>
					<td width="25%"> : <?php echo $q->asisten_op2?></td>
					<td>Asisten 2</td>
					<td width="25%"> : <?php echo $q->asisten_an2?></td>
				</tr>
				<tr>
					<td>Kamar Operasi </td>
					<td width="25%" colspan="3"> : <?php echo $q->kamar_operasi?></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" align="right"border="0">
				<tr>
					<td width="25%">Diagnosa Pre Operatif </td>
					<td colspan="3"> : <?php echo $q->pre_diagnosa ?></td>
				</tr>
				<tr>
					<td>Diagnosa Post Operatif </td>
					<td colspan="3"> : <?php echo $q->post_diagnosa ?></td>
				</tr>
				<tr>
					<td>Diagnosa Post Operatif 2</td>
					<td colspan="3"> : <?php echo $q->post_diagnosa2 ?></td>
				</tr>
				<tr>
					<td>Tindakan Operasi </td>
					<td colspan="3"> : <?php echo $q->nama_operasi ?></td>
				</tr>
				<tr>
					<td>Tindakan Operasi 2 </td>
					<td> : <?php echo $q->nama_operasi2 ?></td>
				</tr>
				<tr>
					<td>Jenis Anastesi </td>
					<td colspan="3"> : <?php echo $q->j_anastesi?></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" align="right"border="0">
				<tr>
					<td width="25%">Klasifikasi </td>
					<td colspan="3"> : <?php echo $q->nama_klasifikasi ?></td>
				</tr>
				<tr>
					<td colspan="4">Jaringan yang di eksisi/insisi </td>
				</tr>
				<tr>
					<td>Golongan Operasi</td>
					<td colspan="3"> : <?php echo $q->jenis_operasi ?></td>
				</tr>
				<tr>
					<td>Pemeriksaan PA </td>
					<td colspan="3"> : <?php echo $q->pemeriksaan_pa?></td>
				</tr>
				<tr>
					<td>Jenis Jaringan </td>
					<td> : <?php echo $q->jenis_jaringan?></td>
				</tr>
				<tr>
					<td>Pemeriksaan Cairan </td>
					<td colspan="3"> : <?php echo $q->pemeriksaan_cairan?></td>
				</tr>
				<tr>
					<td>Jenis Pemeriksaan</td>
					<td colspan="3"> : <?php echo $q->jenis_pemeriksaan?></td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
	<table width="100%" border="1" cellpadding="0">
		<tr>
			<td>Jam Mulai Anestesi</td>
			<td>Jam Operasi Mulai</td>
			<td>Jam Operasi Selesai</td>
			<td>Lama Operasi Berlangsung</td>
		</tr>
		<tr>
			<?php 
				// $lama_operasi = date("H:i:s", strtotime($q->jam_keluar)) - date("H:i:s", strtotime($q->jam_masuk));
				$awal  = strtotime($q->jam_masuk); //waktu awal
				$akhir = strtotime($q->jam_keluar); //waktu akhir
				$diff  = $akhir - $awal;
				$jam   = floor($diff / (60 * 60));
				$menit = $diff - $jam * (60 * 60);
				$detik = $diff - $menit * (60 * 60);
			?>
			<td><?php echo $q->jam_anastesi?></td>
			<td><?php echo $q->jam_masuk?></td>
			<td><?php echo $q->jam_keluar?></td>
			<td><?php echo  $jam.' jam, '.floor( $menit / 60 ).' menit'; ?></td>
		</tr>
	</table>
</div>
<div style="page-break-before:always;">
	<h4>Laporan Operasi</h4>
	<textarea name="laporan_operasi" id="" cols="100" rows="45">
		<?php echo $q->laporan ?>
	</textarea>
</div>
<div style="page-break-before:always;">
	<h4>Komplikasi</h4>
	<textarea name="laporan_operasi" id="" cols="100" rows="7">
		<?php echo $q->komplikasi ?>
	</textarea>
	<h4>Instruksi Pasca Bedah</h4>
	<textarea name="laporan_operasi" id="" cols="100" rows="25">
		<?php echo $q->intruksi ?>
	</textarea>	
</div>
<table width="100%">
	<tr>
		<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<!-- <td colspan="2"></td> -->
		<td colspan="2">Cirebon, <?php echo date("d-m-Y");?></td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo date("H:i:s"); ?></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td><strong>Tanda Tangan dokter ahli bedah</strong>
			<br><br><br><br><br></td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td><?php echo $q->dokter_op ?></td>
	</tr>
</table>
	<!-- <table width="100%" align="right">
		<tr>
			<td width="10%">&nbsp;</td>
			<td>Tgl.Cetak  <?php echo date("d/m/Y His")." (".$this->session->userdata("username").")"; ?></td>
		</tr>
	</table> -->
</body>
</html>