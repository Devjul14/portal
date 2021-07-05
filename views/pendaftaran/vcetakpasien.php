<!DOCTYPE html>
<html>
<head>
	<script>
		window.print();
	</script>
	<title></title>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="35%"></td>
			<td width="35%"></td>
			<td width="20%"><?php echo $q->no_pasien ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td><?php echo date("d/m/Y") ?></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td><?php echo strtoupper($q->nama_pasien) ?></td>
			<td>TGL LAHIR : <?php echo date("d/m/Y",strtotime($q->tgl_lahir)); ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo strtoupper($q->jenis_kelamin) ?></td>
			<td></td>
			<td>
				<?php
					$dob = strtotime($q->tgl_lahir);
					$current_time = time();

					$age_years = date('Y',$current_time) - date('Y',$dob);
					$age_months = date('m',$current_time) - date('m',$dob);
					$age_days = date('d',$current_time) - date('d',$dob);

					if ($age_days<0) {
					    $days_in_month = date('t',$current_time);
					    $age_months--;
					    $age_days= $days_in_month+$age_days;
					}

					if ($age_months<0) {
					    $age_years--;
					    $age_months = 12+$age_months;
					}
					echo $age_years." TAHUN";
				?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo strtoupper($q->status_kawin) ?></td>
			<td></td>
			<td><?php echo strtoupper($q->pendidikan) ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo strtoupper($q->pekerjaan) ?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo strtoupper($q->nama_pasangan) ?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $q->nama_golongan; ?></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br>
	<br>
	<table width="100%">
		<tr>
			<td width="10%">&nbsp;</td>
			<td><?php echo $q->alamat; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $q->telpon; ?></td>
		</tr>
	</table>
	<br>
	<br>
	<table width="100%">
		<tr>
			<td width="10%">&nbsp;</td>
			<td>Tgl.Cetak : <?php echo date("d/m/Y H:i:s")." (".$this->session->userdata("username").")"; ?></td>
		</tr>
	</table>
</body>
</html>