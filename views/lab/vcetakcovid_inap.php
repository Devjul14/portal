
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

		function getttd(){
			var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'.$q->id_dokter);?>";
            $('.ttd_qrcode').qrcode({width: 80,height: 80, text:ttd});
		}
        function getttd1(){
			var ttd = "<?php echo site_url('ttddokter/getttdanalys/'.$q1->row()->analys);?>";
            $('.ttd_qrcode_analys').qrcode({width: 80,height: 80, text:ttd});
		}
	</script>
<body>
<?php
	$t1 = new DateTime('today');
	$t2 = new DateTime($q->tgl_lahir);
	$y  = $t1->diff($t2)->y;
	$m  = $t1->diff($t2)->m;
	$d  = $t1->diff($t2)->d;
?>
<table width = "100%" align="right" border ="0" rules="rows" cellpadding="0" cellspacing="0" >
	<tr>
		<td>
			<table width="100%" align="right" border="0" cellpadding="0" cellspacing="0" style="padding: -5px; margin-top: -5px; margin-bottom: -1px;">
				<tr  style="margin-bottom: -5px;">
					<td colspan="2">
						<strong>LABORATORIUM KLINIK</strong>
					</td>
					<td width="25%">
						<strong>PASIEN RAWAT INAP  </strong>
					</td>
					<td>&nbsp;:&nbsp;<?php echo $q->nama_ruangan ?></td>
				</tr>
		
				<tr style="margin-bottom: -5px;">
					<td colspan="2">RUMAH SAKIT CIREMAI</td>
					<td>No.Register </td>
					<td width="25%">&nbsp;:&nbsp;<?php echo $no_reg ?></td>
				</tr>
				<tr style="margin-bottom: -5px;">
					<td colspan="2">JL. KESAMBI NO. 237 - CIREBON Telp. (0231) 238335</td>
					<td>Tgl.Cetak </td>
					<td width="25%">&nbsp;:&nbsp;<?php echo date("d/m/Y");?> Jam : <?php echo date("H:i:s"); ?></td>
				</tr>
				<tr style="margin-bottom: -5px;">
					<td colspan="2"></td>
					<td><strong>NO.AMBIL/TELP</strong></td>
					<td width="25%">&nbsp;<strong>:&nbsp;/<?php echo $q->telpon ?></strong></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" align="right">
				<tr>
					<td align ="center" width="25%"><font size="4"><strong> HASIL PEMERIKSAAN LABORATORIUM BIOMOLEKULER</strong></font></td>
				</tr>
			</table>
		</td>
	</tr>			
	<tr>
		<td>
			<table width="100%" align="right"border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
				<tr>
					<td>NAMA PASIEN <span style="float: right; ">:&nbsp;</span> </td>
					<td width="25%" style="border-bottom:1px solid #fff; border-left:1px solid #fff; border-top:1px solid transparent;  overflow:hidden; white-space:nowrap; color: black;"><?php echo $q->nama_pasien ?></td>
					<td>NO REKMED <span style="float: right;">:&nbsp;</span></td>
					<td width="25%"><?php echo $q->no_rm ?></td>
				</tr>
				<tr>
					<td>JENIS KELAMIN <span style="float: right;">:&nbsp;</span></td>
					<td width="25%"><?php echo $q->jenis_kelamin ?></td>
					<td>GOL PASIEN <span style="float: right;">:&nbsp;</span></td>
					<td width="25%"><?php echo $q->golpas ?></td>
				</tr>
				<tr>
					<td width="25%">UMUR <span style="float: right;">:&nbsp;</span></td>
					<td width="25%"><?php echo ("$y tahun $m bulan $d hari") ?></td>
					<td>ALAMAT<span style="float: right;">:&nbsp;</span></td>
					<td width="25%" class="ai" maxlength="20" style=" border-bottom:1px solid #fff; border-left:1px solid #fff; border-top:1px solid transparent; text-overflow:ellipsis; overflow:hidden; white-space:nowrap; color: black;"><?php echo $q->alamat ?></td>
				</tr>
				<tr>
					<td style='vertical-align:top'>PENGIRIM <span style="float: right;">:&nbsp;</span></td>
					<td width="25%"><?php echo $q1->row()->dokter_pengirim;?></td>
					<td style='vertical-align:top'>TANGGAL PENERIMAAN <span style="float: right;">:&nbsp;</span></td>
					<td width="25%"><?php echo ($q1->row()->terima_lab=="0000-00-00 00:00:00" ? "-" : date("d-m-Y",strtotime($q1->row()->terima_lab))); ?></td>
				</tr>
				<tr>
                    <td style='vertical-align:top'>JENIS SPESIMEN <span style="float: right;">:&nbsp;</span></td>
					<td width="25%"><?php echo $q1->row()->nama_swab;?></td>
					<td style='vertical-align:top'>TANGGAL PEMERIKSAAN<span style="float: right;">:&nbsp;</span></td>
					<td width="25%" style=" border-bottom:1px solid #fff; border-left:1px solid #fff; border-top:1px solid transparent; text-overflow:ellipsis; overflow:hidden; white-space:nowrap; color: black;"><?php echo ($q1->row()->periksa_lab=="0000-00-00 00:00:00" ? date("d-m-Y",strtotime($q1->row()->terima_lab)) : date("d-m-Y",strtotime($q1->row()->periksa_lab)));?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table cellspacing="2" cellpadding="1"  width="100%" align="right" border="1">
				<thead>
					<tr>
						<td <?php if($jenis=="covid") echo 'rowspan="2"';?>  align="center"><strong>Kode </strong></td>
						<td <?php if($jenis=="covid") echo 'rowspan="2"';?>  align="center"><strong>Metode </strong></td>
						<td <?php if($jenis=="covid") echo 'rowspan="2"';?>  align="center"><strong>Swab ke</strong></td>
                        <?php if($jenis=="covid") :?>
						<td align="center" colspan="3"><strong>CT </strong></td>
                        <?php endif ?>
						<td <?php if($jenis=="covid") echo 'rowspan="2"';?>  align="center"><strong>Hasil Pemeriksaan</strong></td>
                        <?php if($jenis!="covid") :?>
                        <td <?php if($jenis=="covid") echo 'rowspan="2"';?>  class='text-center'>Nilai Rujukan</td>
                        <?php endif ?>
					</tr>
                    <?php if($jenis=="covid") :?>
					<tr>
						<td align="center"><strong>ORF 1AB</strong></td>
						<td align="center"><strong>GENE N</strong></td>
						<td align="center"><strong>GENE E</strong></td>
					</tr>
                    <?php endif ?>
				</thead>
				<tbody>
					<?php
						foreach ($q1->result() as $row){
                            $rujukan = "";
                            if ($jenis_kelamin=="L") {
						        $rujukan = $row->pria;
						    } else {
						        $rujukan = $row->wanita;
						    }
							echo "<tr>";
							echo "<td align='center'>".$row->kode."</td>";
							echo "<td align='center'>RT-PCR SARS COV-2</td>";
                            echo "<td align='center'>".$row->pemeriksaan."</td>";
                            if($jenis=="covid") {
                                echo "<td align='center'>".$row->rp."</td>";
                                echo "<td align='center'>".$row->n1."</td>";
                                echo "<td align='center'>".$row->n2."</td>";
                            }
							echo "<td align='center' ".(strtolower($row->hasil)=="positif" ? "style='color:red'" : "").">".strtoupper($row->hasil)."</td>";
                            if($jenis!="covid") {
                                echo "<td align='center'>".$rujukan."</td>";
                            }
                            echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</td>
	</tr>
</table>
<hr>

	<table width="100%" align="right">
		<tr>
			<td width="25%" align="center" style="border-top:1px solid">DIPERIKSA OLEH <br>	
				<br><div class="ttd_qrcode_analys"></div>
			</td>
			<td width="25%" align="center" style="border-top:1px solid">DIVERIFIKASI OLEH <br>	
				<br><div class="ttd_qrcode"></div>
			</td>
			<td width="25%" align="center" style="border-top:1px solid">Cirebon,&nbsp; <?php echo ($q1->row()->periksa_lab=="0000-00-00 00:00:00" ? date("d-m-Y",strtotime($q1->row()->terima_lab." +1 day")) : date("d-m-Y",strtotime($q1->row()->periksa_lab." +1 day")));?>
				<br>&nbsp;&nbsp;PENANGGUNG JAWAB LAB
				<br>&nbsp;&nbsp;LAB PCR RS CIREMAI<br>
                <div class="ttd_qrcode"></div>
			</td>
		</tr>
		<tr>
			<td width="25%" align="center"> <?php echo $q1->row()->namaanalys ?></td>
			<td width="25%" align="center"> Pelda Suparno, Amd.AK/ Ka LAB</td>
			<td width="25%" align="center"> <?php echo $q1->row()->nama_dokter; ?></td>
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
		/* width: 20cm;  */
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