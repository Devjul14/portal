<!DOCTYPE html>
<html>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
<body>
<script type="text/javascript">window.print();</script>
<table cellspacing="2" cellpadding="1" width="100%" align="right" border="0">
	<tr>
		<td>
			INSTALASI FARMASI RUMAH SAKIT CIREMAI</font>
		</td>
	</tr>
	<tr>
		<td>
			DEPO : <?php echo $q->nama_depo ?>
		</td>
	</tr>
	<tr>
		<td>
			Jl. Kesambi No. 237 - Cirebon . [<?php echo $this->session->userdata("username"); ?>]
		</td>
	</tr>
</table>
<table cellspacing="2" cellpadding="1"  width="100%" align="right">
	<tr>
		<td>Pasien </td>
		<td>:&nbsp;<?php echo $q->pembeli ?><span class="pull-right"> No RM :&nbsp;<?php echo $q->no_rm ?></span></td>
	</tr>
	<!-- <tr>
		<td>Status Pasien </td>
		<td>:&nbsp;<?php echo $q->golpas ?></td>
	</tr>
	<tr>
		<td>Nota RI </td>
		<td>:&nbsp;<?php echo $q->regis ?></td>
	</tr> -->
</table>
<table cellspacing="2" cellpadding="1"  width="100%" align="right"border="0" rules="rows">
	<thead>
		<th align="center">No. </th>
		<th align="left">Nama Obat </th>
		<th align="right">Satuan </th>
		<th align="right">Qty </th>
		<th align="right">Harga </th>
		<th align="right">Jumlah </th>
	</thead>
	<tbody>
		<?php
			$i=1;
	        foreach ($q1->result() as $row){
	        	echo "<tr>";
	            echo "<td align='center'>".$i."</td>";
	            echo "<td>".$row->nama."</td>";
	            echo "<td align='right'>".$row->pak2."</td>";
	            echo "<td align='right'>".$row->qty."</td>";
	            echo "<td align='right'><span class='pull-left'></span>".number_format($harga,0,',','.')."</td>";
	            echo "<td align='right'><span class='pull-left'></span>".number_format($row->total_harga,0,',','.')."</td>";
	            echo "</tr>";
	        $i++;
	    }
	    ?>
	</tbody>
	
</table>
<hr style="margin-bottom: 1px">
<table width="100%" border="0" rules="rows">
		<tr>
			<th colspan="5" align="center">TOTAL :</th>
			<th align="right"><span class="pull-left"></span><?php echo number_format($q->total,0,',','.'); ?></th>
		</tr>
	</table>
<hr style="margin-bottom: 1px; margin-top: 1px;">
<table cellspacing="2" cellpadding="1"  width="100%">
	<tr>
		<td>Tgl.Cetak : <?php echo date("d/m/Y H:i:s"); ?></td>
		<td align="right">Lapor : <?php echo date("d/m/Y"); ?>&nbsp;<?php echo $q->nota; ?></td>
	</tr>
</table>
<style type="text/css">
	html, body {
        width: 9cm;   
        height: 14cm;  
        display: block;
        /*font-family: "dotmatrik";*/
        font-family: sans-serif;
        margin:0.3cm;
    }
	.pull-right {
	    float: right;
	}
	.pull-left {
	    float: left;
	}
	th, td{
	    /*font-family: "dotmatrik";*/
	    font-family: sans-serif;
	    text-transform: uppercase;
	}
	td {
	    font-size: 10px;
	}
	th {
	    font-size: 10px;
	    font-weight: bold;
	}
	@page {
      size: 9cm 14cm;
      margin:0.3cm;
    }
	.text-right{
	    align:right;
	}
</style>
</body>
</html>