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
	}
</style>
<script>
	window.print();
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<div class="row-fluid">
		<div class="span12">
			<div class="subnav">
				<div class='span12'>
					<div class='text-center'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
				</div>
			</div>
			<div class="widget-box">
				<div class="widget-content">
					<table class="table">
						<tr valign=top>
							<td width='100'>Asal Klinik</td>
							<td colspan=3>:&nbsp;&nbsp;<?php echo $p->nama_puskesmas;?></td>
						</tr>
						<tr>
							<td>No. Registrasi</td>
							<td colspan=3>:&nbsp;&nbsp;<?php echo $p->no_pasien;?></td>
						</tr>
						<tr>
							<td>Nama Ibu</td>
							<td>:&nbsp;&nbsp;<?php echo $p->nama_pasien;?></td>
							<td width='70'>Umur</td>
							<td>:&nbsp;&nbsp;<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?></td>
						</tr>
						<tr>
							<td>Nama Suami</td>
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
			<div class="widget-box">
				<div class="widget-content">
					<table class="table">
						<tr>
							<td width='150'>Tinggi Badan (cm)</td>
							<td>:&nbsp;&nbsp;<?php echo $row->tinggi_badan;?></td>
							<td width='150'>LILA (cm)</td>
							<td>:&nbsp;&nbsp;<?php echo $row->lila;?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="widget-box">
				<div class="widget-content">
					<table class="table nonborder">
						<tr>
							<td width='2px'>1.</td>
							<td width='250px'>
								Fungsi Reproduksi<br>
								Hari Pertama Haid Terakhir : <?php echo date('d M Y',strtotime($row->tgl_haid_terakhir));?><br>
								Hari Taksiran Persalinan : <?php echo date('d M Y',strtotime($row->tgl_taksiran_persalinan));?><br>
							</td>
							<td width='2px' rowspan='3'>4.</td>
							<td width='350px' rowspan='3'>
								Riwayat Obstetri :<br>
								G : <?php echo $row->gravida;?>&nbsp;&nbsp;&nbsp;
								P : <?php echo $row->partus;?>&nbsp;&nbsp;&nbsp;
								A : <?php echo $row->abortus;?><br>
								Jumlah Anak Hidup : <?php echo $row->jml_anak_hidup;?><br>
								Jumlah Lahir Mati : <?php echo $row->jml_lahir_mati;?><br>
								Jarak Persalinan Terakhir (tahun) : <?php echo $row->jarak_persalinan_akhir;?><br>
								Penolong Persalinan Terakhir : <?php echo $row->penolong_persalinan_akhir;?><br>
								Cara Persalinan Terakhir : <?php echo $row->cara_persalinan_akhir;?><br>
								Placenta lahir dengan : <?php echo $row->placenta_lahir;?><br>
								Penggunaan kontrasepsi sebelum kelahiran ini <br>
								Sebutkan : <?php echo $row->penggunaan_kntrs_akhir;?>
							</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>
								Kehamilan Sekarang, Keluhan Utama : <?php echo $row->keluhan_utama;?>
							</td>
						<tr>
							<td>3.</td>
							<td>
								Berapa anak yang direncakan : <?php echo $row->jml_anak_rencana;?><br>
								Datang atas petunjuk : <?php echo $row->datang_atas_petunjuk;?><br>
								Adakah Perlakuan Kasar dari Suami : <?php echo ($row->perlakuan_kasar_suami='T' ? 'Tidak Ada' : 'Ada');?><br>
								Adakah Keluhan Keputihan : <?php echo ($row->keluhan_keputihan='T' ? 'Tidak Ada' : 'Ada');?><br>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="subnav">
				<div class='span12'>
					<div class='text-center'><h4>PEMERIKSAAN ANTENATAL</h4></div>
				</div>
			</div>
			<div class="row-fluid">
				<div class='span12'><br>
					<table cellspacing=2 cellpadding=5 id=print>
						<tr>
							<th rowspan=2>Tgl</th>
							<th rowspan=2>Keluhan Skrng</th>
							<th rowspan=2>Tekanan Darah</th>
							<th rowspan=2>Berat Badan</th>
							<th rowspan=2>Umur Kehamilan</th>
							<th rowspan=2>Tinggi Fundus</th>
							<th rowspan=2>Letak Janin</th>
							<th rowspan=2>Denyut Jantung Janin</th>
							<th colspan=2>LABORATORIUM</th>
							<th rowspan=2>Pemeriksaan Khusus</th>
							<th rowspan=2>Tindakan & Terapi</th>
						</tr>
						<tr>
							<th>HB</th>
							<th>Gol. Darah</th>
						</tr>
						<?php
							foreach ($q1->result() as $data) {
								echo "<tr>
										  <td>".date('d-m-y',strtotime($data->tgl))."&nbsp;</td>
										  <td>".$data->keluhan."&nbsp;</td>
										  <td>".$data->tekanan_darah."&nbsp;</td>
										  <td>".$data->berat_badan."&nbsp;</td>
										  <td>".$data->umur_kehamilan."&nbsp;</td>
										  <td>".$data->tinggi_fundus."&nbsp;</td>
										  <td>".$data->letak_janin."&nbsp;</td>
										  <td>".$data->denyut_jantung_janin."&nbsp;</td>
										  <td>".$data->hb."&nbsp;</td>
										  <td>".$data->gol_darah."&nbsp;</td>
										  <td>".$data->penyuluhan."&nbsp;</td>
										  <td>".$data->nama_tindakan."&nbsp;</td>
									  </tr>";
							}
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