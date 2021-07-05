<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title;?></title>
    <!--jquery-->
    <link href="<?php echo base_url();?>css/jquery-ui-1.7.2.custom.css" rel="stylesheet">
    <!--bootstrap-->
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
    <!--app-->
	<link href="<?php echo base_url();?>css/unicorn.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/print.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/cpanel.css" rel="stylesheet">
</head>
    <!--jquery-->
    <script src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
	<!--app-->
    <script src="<?php echo base_url(); ?>js/script.js"></script>
	<!--jquery ui-->
    <script src="<?php echo base_url(); ?>js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui-1.7.2.custom.min.js"></script>
    <!--bootstrap-->
    <script src="<?php echo base_url(); ?>js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-tab.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-popover.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-button.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-typeahead.js"></script>
<style>
	html,body{
		background:#fcfcfc;
		padding:0px 10px 10px 10px;
		margin:0px;
	}
	table.nonborder td{
		border-top:0;
		font-size:12px;
	}
	table#print{
		font-size:12px;
	}
</style>
<script>
	window.print();
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<div class="row-fluid">
		<div class="span12">
			<table border='0' cellpadding='5' cellspacing='0' width='100%'>
                <tr>
                    <td valign=top>
					<?php 
					echo "
						<font style='font-weight:bold;font-size:20px'>".$pt->nama_puskesmas."</font><br>
						<font>".$pt->alamat."</font>";
					?>
					</td>
					<td width=200px valign=top align=right>
						<?php
						echo $this->tglindo->tgl(date('Y-m-d'),2);
						?>
					</td>
                </tr>
            </table>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="subnav">
				<div class='span12'>
					<div class='text-center'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<table cellspacing=2 cellpadding=2 class=nonborder width=100%>
						<tr valign=top>
							<td width='100'>Asal Klinik</td>
							<td>:&nbsp;&nbsp;<?php echo $p->nama_puskesmas;?></td>
							<td>No. Registrasi</td>
							<td colspan=3>:&nbsp;&nbsp;<?php echo $p->no_pasien;?></td>
						</tr>
						<tr>
							<td>Nama Pasien</td>
							<td>:&nbsp;&nbsp;<?php echo $p->nama_pasien;?></td>
							<td width='100'>Umur</td>
							<td>:&nbsp;&nbsp;<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?></td>
						</tr>
						<tr>
							<td>Nama Ayah</td>
							<td>:&nbsp;&nbsp;<?php echo $p->nama_suami;?></td>
							<td>Umur</td>
							<td>:&nbsp;&nbsp;<?php echo $this->Mpendaftaran->umur($p->tgl_lahir_suami,$p->tanggal);?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:&nbsp;&nbsp;<?php echo $p->alamat;?></td>
							<td>RW</td>
							<td>:&nbsp;&nbsp;<?php echo $p->nama_rw;?>&nbsp;&nbsp;Kelurahan&nbsp;&nbsp;<?php echo $p->nama_kelurahan;?></td>
						</tr>
					</table>
				</div>
			</div>
			<br><br>
			<div class="subnav">
				<div class='span12'>
					<div class='text-center'><h4>IMUNISASI</h4></div>
				</div>
			</div><br>
			<div class="row-fluid">
				<div class='span12'>
					<table cellspacing=2 cellpadding=5 id=print width=100%>
						<tr>
							<th width=20px>No.</th>
							<th>Imunisasi</th>
							<th width=100px align=right>Jumlah</th>
						</tr>
						<?php
							$i = 1;
							$jumlah = 0;
							foreach ($q1->result() as $data) {
								echo "<tr>
										  <td>".$i++."</td>
										  <td>".$data->nama_imunisasi."</td>
										  <td style='text-align:right'>".number_format($data->karcis,0,'.',',')."</td>
									  </tr>";
								$jumlah += $data->karcis;
							}
							echo "<tr>
									<th colspan=2>Jumlah</th>
									<th style='text-align:right'>".number_format($jumlah,0,'.',',')."</th>
								  </tr>";
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class='span12'><br><br>
				<div class='text-right'>
					<h5>Petugas</h5><br><br>
					<h5><?php echo $nama_user;?></h5>
				</div>
			</div>
		</div>
	</div>
</body>