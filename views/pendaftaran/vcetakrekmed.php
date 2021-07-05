<!DOCTYPE html>
<html>
<head>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
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
<table>
	<tr>
	<table width = "100%" align="right"  rules="cols">
		<tr>
			<td>
				<h3>
					RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON
				</h3>
			</td>
		</tr>
	</table>

<table width ="100%" align="right" border ="1" >
	<tr>
		<td>
			<table  width="100%" align="right"border="0" >
				<tr>
					<td rowspan="2" colspan="2">
						<center><h4>REKAM MEDIS RAWAT JALAN</h4></center>
					</td>
					<td width="25%"><h4>No. Rekam Medis</h4></td>
					<td><h4>: <?php echo $q->no_rekmed ?></h4></td>
				</tr>
		
				<tr>
					<td><h4>Tgl. Rekam Medis </h4></td>
					<td width="25%"><h4>:&nbsp;<?php echo $q->trk ?></h4></td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr><td>
		<table width="100%" align="right">
		<tr>
			<?php
				$t1 = new DateTime('today');
				$t2 = new DateTime($q->tgl_lahir);
				$y  = $t1->diff($t2)->y;
				$m  = $t1->diff($t2)->m;
				$d  = $t1->diff($t2)->d;

			?>			
				<td width="25%">Nama Pasien </td>
				<td width="25%"> :&nbsp;<?php echo $q->nama_pasien ?></td>
				<td width="25%"></td>
				<td width="25%"></td>
			</tr>
		</table>
	</td></tr>
	<tr>
		<td>
			<table width="100%" align="right"border="0">
			<tr>
				<td>Jenis Kelamin </td>
				<td width="25%"> :&nbsp;<?php echo $q->jenis_kelamin ?></td>
				<td width="25%">Umur </td>
				<td width="25%"> :&nbsp;<?php echo date("d-m-Y",strtotime($q->tgl_lahir))."&nbsp;(".$y.' tahun '.$m.' bulan '.$d.' hari'.")" ?></td>
			</tr>
			<tr>
				<td>Status Kawin </td>
				<td width="25%"> :&nbsp;<?php echo $q->status_kawin ?></td>
				<td>Pendidikan </td>
				<td width="25%"> :&nbsp;<?php echo $q->pendidikan ?></td>
			</tr>
			<tr>
				<td>Pekerjaan </td>
				<td width="25%"> :&nbsp;<?php echo $q->pekerjaan ?></td>
				<td>Agama</td>
				<td width="25%"> :&nbsp;<?php echo $q->agama ?></td>
			</tr>
			<tr>
				<td>Nama Suami / Istri</td>
				<td width="25%"> :&nbsp;<?php echo $q->nama_pasangan ?></td>
				<td  width="25%"> &nbsp;</td>
				<td  width="25%"> &nbsp;</td>
				<!-- <td>Nama Istri / Ibu </td>
				<td width="25%"> :&nbsp;<?php echo $q->nama_pasangan ?></td> -->
			</tr>
			<tr>
				<td>Golongan Pasien </td>
				<td width="25%"> :&nbsp;<?php echo $q->nama_golongan ?></td>
				<td>Pangkat </td>
				<td width="25%"> :&nbsp;<?php echo $q->pangkat ?></td>
			</tr>
			<tr>
				<td  width="25%"> &nbsp;</td>
				<td  width="25%"> &nbsp;</td>
				<td>NRP/NBI/NIP </td>
				<td width="25%"> :&nbsp;<?php echo $q->nip ?></td>
			</tr>
			<tr>
				<td  width="25%"> &nbsp;</td>
				<td  width="25%"> &nbsp;</td>
				<td>No. Askes </td>
				<td width="25%"> :&nbsp;<?php echo $q->no_bpjs ?></td>
			</tr>
			<tr>
				<td  width="25%"> &nbsp;</td>
				<td  width="25%"> &nbsp;</td>
				<td>Perusahaan</td>
				<td width="25%"> :&nbsp;<?php echo $q->nama_perusahaan ?></td>
			</tr>
			<tr>
				<td>Alamat / Kesatuan </td>
				<td colspan="3" width="25%"> :&nbsp;<?php echo $q->alamat ?></td>
				
			</tr>
		</table>
		</td>
	</tr>
	
	<tr>
		<td>
		
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" align="right">
			<tr>
				<td width="25%" rowspan="2">Alergi Terhadap </td>
				<td width="25%"> :&nbsp;<?php echo $q->alergi ?></td>
				<td></td>
				<td width="25%"> &nbsp;</td>
			</tr>
			<tr>
				<td width="25%"> </td>
				<td width="25%">&nbsp;</td>
				<td></td>
				<td width="25%"> &nbsp;</td>
			</tr>
			
	</table>
		</td>
	</tr>
	<!-- <table width="100%" align="right">
		<tr>
			<td width="10%">&nbsp;</td>
			<td>Tgl.Cetak  <?php echo date("d/m/Y His")." (".$this->session->userdata("username").")"; ?></td>
		</tr>
	</table> -->
</body>
</html>