<!DOCTYPE html>
<html>
<head>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak RETENSI</title>
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
						DATASEMEN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KESEHATAN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WILAYAH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 03.04.03 <br>
						RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON
					</h4>
				</td>
			</tr>
		</table>
	<center>
		<h3>RETENSI REKAM MEDIS</h3>
		<h4><?php echo $tgl1 ?> s/d <?php echo $tgl2 ?></h4>
		<br>
	</center>
	<table width="100%" class="table-bordered">
        <thead>
            <tr>
            	<td width="50"><b>No</b></td>
                <td width="100"><b>Nomor RM</b></td>
                <td><b>Nama</b></td>
                <td width="200"><b>Terakhir Berobat</b></td>
                <td width="150"><b>Diagnosa</b></td>
                <td width="250"><b>Tindakan /Operasi</b></td>
                <td width="150"><b>Dokter</b></td>	
                <td width="150"><b>Alergi</b></td>
                <td width="200"><b>Keterangan</b></td>
            </tr>
        </thead>
        <tbody>
	        <?php
	        	$i =0;
	            foreach ($q->result() as $row){
	            	$i++;
	                echo "<tr id=data href='".$row->no_pasien."/".$row->no_retensi."' nama='".$row->nama_pasien."' status_pinjam='".$row->status_pinjam."'>";
	                echo "<td>".$i."</td>";
	                echo "<td>".$row->no_pasien."</td>";
	                echo "<td>".$row->nama_pasien."</td>";
	                echo "<td>".date('d-m-Y',strtotime($row->terakhir_berobat))."</td>";
	                echo "<td>".$row->nama_diagnosa."</td>";
	                echo "<td>".$row->nama_tindakan."</td>";
	                echo "<td>".$row->nama_dokter."</td>";
	                echo "<td>".$row->alergi."</td>";
	                echo "<td>&nbsp;</td>";
	                echo "</tr>";
	            }
	        ?>
        </tbody>
    </table>
</div>
</body>
</html>