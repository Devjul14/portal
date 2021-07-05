
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
<table width = "100%" align="right" border ="0" rules="rows" >
	<tr>
		<td>
			<table  width="100%" align="right" border="0">
				<tr>
					<td colspan="2">RUMAH SAKIT CIREMAI</td>
				</tr>
				<tr>
					<td colspan="2">INSTALASI RAWAT JALAN</td>
				</tr>
				<tr>
					<td colspan="2">JL. KESAMBI NO. 237 - CIREBON Telp. (0231) 238335</td>
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
                        <th class='text-center'>Tanggal/ Jam Cetak Barcode</th>
                        <th class='text-center'>Tanggal/ Jam Scan Barcode</th>
                        <th class='text-center'>Tanggal/ Jam Terima</th>
                        <th class='text-center'>Tanggal/ Jam Pulang</th>
                        <th class='text-center'>Tanggal/ Jam Indeks</th>
                        <th class='text-center'>Tanggal/ Jam Gudang</th>
                        <th class='text-center'>Respond Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    	$respond="";
                        $i = 1;
                        foreach($q->result() as $data){
							$tcb  = date_create($data->tgl_cetakbarcode);
							$tg  = date_create($data->tgl_gudang);
							$diff  = date_diff($tcb, $tg);

                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td class='no_reg text-center'>".$data->no_reg."";
                            echo "<td>".$data->nama_pasien."</td>";
                            echo "<td>".$data->tgl_cetakbarcode."</td>";
                            echo "<td>".$data->tgl_scanbarcode."</td>";
                            echo "<td>".$data->tgl_terima."</td>";
                            echo "<td>".$data->tanggal_pulang."</td>";
                            echo "<td>".$data->tanggal_indeks."</td>";
                            echo "<td>".$data->tgl_gudang."</td>";
                            echo "<td>".$diff->d." Hari, ".$diff->h." Jam, ".$diff->i." Menit, ".$diff->s." Detik,</td>";
                            echo "</tr>";
                            
                        }
                    ?>
                </tbody>
            </table>
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
			<td>&nbsp;</td>
			<td width="25%">&nbsp; INSTALASI RAWAT JALAN</td>
		</tr>
	</table>

</table>
<style type="text/css">
	html, body {
        display: block;
        width: 20cm; height: 13cm;
    }
	.pull-right {
	    float: right;
	}
	.pull-left {
	    float: left;
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