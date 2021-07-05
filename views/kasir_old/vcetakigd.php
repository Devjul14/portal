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
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
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
	}
</style>
<?php
	$tgl_kunjungan = date('d-m-Y');
	if ($row){
		$id_bpumum = $row->id_bpumum;
		$nip = $row->nip;
		$ket_rujukan = $row->ket_rujukan;
		$rowujukan = $row->rujukan;
		$umur = $row->umur;
		$id_paramedis = $row->id_paramedis;
		$tekanan_darah = $row->tekanan_darah;
		$berat_badan = $row->berat_badan;
		$keluhan = $row->keluhan;
		$action = "edit";
	} else {
		$nip = 
		$ket_rujukan = 
		$rujukan = 
		$umur = 
		$id_paramedis = 
		$tekanan_darah =
		$keluhan =
		$berat_badan = "";
		$action = "simpan";
	}
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-content">
					<div class='text-center'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
				</div>
			</div>
			<div class="widget-box">
				<div class="widget-content">
					<table class="nobordertop table">
						<tr valign=top>
							<td width='150'>Asal Puskesmas</td>
							<td width=10>:</td>
							<td><?php echo $p->nama_puskesmas;?></td>
						</tr>
						<tr>
							<td>No. Pasien</td>
							<td>:</td>
							<td><?php echo $p->no_pasien;?></td>
						</tr>
						<tr>
							<td>Nama Pasien</td>
							<td>:</td>
							<td><?php echo $p->nama_pasien;?></td>
						</tr>
						<tr>
							<td>Umur</td>
							<td>:</td>
							<td><?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>&nbsp;&nbsp;&nbsp;&nbsp;Jenis Kelamin : <?php echo ($p->jenis_kelamin=="P" ? "Perempuan" : "Laki-laki");?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td><?php echo $p->alamat;?></td>
						</tr>
						<tr>
							<td>Diperiksa di</td>
							<td>:</td>
							<td>Klinik Pratama Bersalin Akbid Muhammadiyah</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Dari tanggal</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Diagnosa terakhir</td>
							<td>:</td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td>Anamnese</td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td>Pemeriksaan Fisik</td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td>Lab./USG/EKG/CTG</td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td>Diagnose Kerja</td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td>Pengobatan/ Therapi/ Tindakan</td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td>Prognose</td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
						<tr>
							<td>Anjuran</td>
							<td></td>
							<td>
								...........................................................................
								...........................................................................
								...........................................................................
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="content">
				<div class='span12' style='background-color:#ffffff;'>
						<div class='text-right' style='width:300;float:right;'>
							Cirebon, .............................................................................&nbsp;&nbsp;
							<div class='text-center'>
								<br>Dokter yang merawat,<br><br><br><br>
								(...........................................)
							</div> 
						</div>
				</div>
			</div>

<!--
			<div class="widget-box">
				<div class="widget-content form-horizontal">
					<div class="control-group">
						<label class="control-label">Dokter</label>
						<div class="controls">
							<select name="nip">
								<?php
									foreach ($d->result() as $row) {
										echo "<option value='".$row->id_paramedis."'>".$row->nama_paramedis."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Tekanan Darah</label>
						<div class="controls">
							<input type=text name='tekanan_darah' value='<?php echo $tekanan_darah;?>'>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Berat Badan</label>
						<div class="controls">
							<input type=text name='berat_badan' value='<?php echo $berat_badan;?>'>&nbsp;&nbsp;Kg
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Keluhan</label>
						<div class="controls">
							<input type=text name='keluhan' value='<?php echo $keluhan;?>'>&nbsp;
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Kunjungan Berikutnya</label>
						<div class="controls">
							<input type=text name='tgl_kunjungan' value='<?php echo $tgl_kunjungan;?>'>&nbsp;
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Tempat Rujukan/ RSBM</label>
						<div class="controls">
							<table>
							<tr>
							<td width=200>
								<select name='rujukan'>
									<?php echo $this->Mpendaftaran->rujukan($rujukan);?>
								</select>
							</td>
							<td width=650><input type=text name='ket_rujukan' value='<?php echo $ket_rujukan;?>'>
							</td></tr></table>
						</div>
					</div>
				</div>
			</div>

			<?php 
				if ($q1->num_rows>0){
				echo "
					<div class='subnav'>
						<div class='span12'>
							<div class='text-center'><h4>PENYAKIT</div>
						</div>
					</div>
					<div class='row-fluid'>
					<div class='span12'>
					<table id='colums' class='table table-bordered'>
						<tr>
				   			<th width='20px' >No</th>
				   			<th>Nama Penyakit</th>
				   			<th width=200>Tindakan</th>
				   			<th width=200>Status Kasus</th>
				 		</tr>
				 ";
						$i = 0;
						foreach ($q1->result() as $row){
							$i++;
							echo "<tr class='pasienlab'>
							  <td align=center>".$i."</td>
							  <td>".$row->nama_penyakit."</td>
							  <td>".$row->nama_tindakan."</td>
							  <td>".$row->status_kasus."</td>
							  </tr>";
						}
				echo "
				</table>
				</div>
				</div><br>";
				}
				if ($q2->num_rows>0){
				echo "
				<div class='subnav'>
					<div class='span12'>
						<div class='text-center'><h4>LABOTARIUM</div>
					</div>
				</div>
				<div class='row-fluid'>
				<div class='span12'>
				<table id='data colums' class='table table-bordered'>
					<?php echo form_close();?>
					<tr>
				   		<th width='20px' >No</th>
				   		<th width=400>Labotarium</th>
				   		<th>Keterangan</th>
				 	</tr>";
						$i = 0;
						foreach ($q2->result() as $row){
							$i++;
							echo "<tr class='pasienlab'>
							  <td align=center>".$i."</td>
							  <td>".$row->nama_lab."</td>
							  <td>".$row->keterangan."</td>
							  </tr>";
						}
				echo "
				</table>
				</div>
				</div><br>";
				}
				if ($q5->num_rows>0){
				echo "
				<div class='subnav'>
					<div class='span12'>
						<div class='text-center'><h4>RESEP OBAT</div>
					</div>
				</div>
				<div class='row-fluid'>
				<div class='span12'>
				<table id='data colums' class='table table-bordered'>
					<?php echo form_close();?>
					<tr>
				   		<th width='20px' >No</th>
				   		<th>Obat</th>
				   		<th>Aturan Pakai</th>
				   		<th width=100>Dosis</th>
				 	</tr>";
						$i = 0;
						foreach ($q5->result() as $row){
							$i++;
							echo "<tr class='pasienlab'>
							  <td align=center>".$i."</td>
							  <td>".$row->nama_obat."</td>
							  <td>".$row->aturan_pakai."</td>
							  <td>".$row->jml_pemakaian."</td>
							  </tr>";
						}
				echo "
				</table>
				</div>
				</div>";
				}
			?>
-->
		</div>
	</div>

</body>