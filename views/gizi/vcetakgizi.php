
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
			window.print();
		});

		function getttd(){
			var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'.$k->id_dokter);?>";
            $('.ttd_qrcode').qrcode({width: 80,height: 80, text:ttd});
		}
	</script>
<body>
<table width = "100%" align="right" border ="0" rules="rows" >
	<tr>
		<td>
			<table  width="100%" align="right" border="0">
				<tr>
					<td colspan="2">
						ASUHAN GIZI
					</td>
					<td width="25%">
					<?php echo $q->polik."/".$q->nama_ruangan; ?>
					</td>
					<td></td>
				</tr>
		
				<tr>
					<td colspan="2">RUMAH SAKIT CIREMAI</td>
					<!-- <td width="25%">&nbsp;</td> -->
					<td>No REGISTER </td>
					<td width="25%">:&nbsp;<?php echo $no_reg ?></td>
				</tr>
				<tr>
					<td colspan="2">JL. KESAMBI NO. 237 - CIREBON Telp. (0231) 238335</td>
					<!-- <td></td> -->
					<td>Tgl.Cetak </td>
					<td width="25%">:&nbsp; <?php echo date("d/m/Y H:i:s"); ?></td>
					
				</tr>
			</table>
		</td>
	</tr>
	<tr><td>
		<table width="100%" align="right">
		<tr>
			
				<td width="25%">PEMERIKSAAN </td>
				<td width="25%"> :&nbsp;<?php echo $q->nama_tindakan ?></td>
				
				<td width="25%">DIAGNOSA MEDIS </td>
				<td width="25%"> :&nbsp;<?php echo $k->nofoto ?></td>
		
			</tr>
		</table>
	</td></tr>
	<?php
				$t1 = new DateTime('today');
				$t2 = new DateTime($q->tgl_lahir);
				$y  = $t1->diff($t2)->y;
				$m  = $t1->diff($t2)->m;
				$d  = $t1->diff($t2)->d;

			?>			
	<tr>
		<td>
			
			<table width="100%" align="right"border="0">
			<tr>
				<td>NAMA PASIEN </td>
				<td width="25%"> :&nbsp;<?php echo $q->nama_pasien ?></td>
				<!-- <td width="25%">:&nbsp;</td> -->
				<td>NO REKMED </td>
				<td width="25%"> :&nbsp;<?php echo $q->no_rekmed ?></td>
				<!-- <td width="25%">:&nbsp;</td> -->
			</tr>
			<tr>
				<td>JENIS KELAMIN </td>
				<td width="25%"> :&nbsp;<?php echo $q->jenis_kelamin ?></td>
				<!-- <td width="25%">:&nbsp;</td> -->
				<td>GOL PASIEN </td>
				<td width="25%"> :&nbsp;<?php echo $q->golpas ?></td>
				<!-- <td width="25%">:&nbsp;</td> -->
			</tr>
			<tr>
				<td width="25%">Umur </td>
				<td width="25%"> :&nbsp;<?php echo ("$y tahun $m bulan $d hari") ?></td>
				<td>DOK PENGIRIM </td>
				<td width="25%"> :&nbsp;<?php echo $k->dokter_pengirim ?></td>
			</tr>
			
		</table>
		</font>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border = '1' >
                <thead>
                </thead>
                <tbody>

                    <tr>
                        <th width="10" colspan="2" class='text-center'>FORMULIR ASUHAN GIZI</th>
                    </tr>
                    <?php
                        $i = 0;
                        $kode_judul = $kode_tindakan = "";

                        $tgl1_print = $tgl2_print = "";
                        foreach($a->result() as $data){
                            // $tgl1_print = $tgl1_print=="" ? date("d-m-Y",strtotime($data->tanggal)) : $tgl1_print;
                            // $tgl2_print = date("d-m-Y",strtotime($data->tanggal));
                            // if ($kode_judul!=$data->kode_judul) {
                            //     echo "<tr class='bg-orange'>";
                            //     echo "<td colspan='7'>".$data->judul."</td>";
                            //     $kode_judul = $data->kode_judul;
                            //     $i = 0;
                            // }
                            // if ($data->jenis_kelamin=="L") {
                            //     $rujukan = $data->pria;
                            // } else {
                            //     $rujukan = $data->wanita;
                            // }
                            $i++;
                            // if ($kode_tindakan!=$data->kode_tindakan){
                            //     $nama_tindakan = $data->nama_tindakan;
                            //     $kode_tindakan = $data->kode_tindakan;
                            // } else {
                            //     $nama_tindakan = "";
                            // }
                            // if ($data->no_urut == "59") {
                            //     $nama_tindakan = "Sediment";   
                            // }
                            echo "<tr>";
                            echo "<td class='text-center'>".$data->asuhan."</td>";
                            echo "</tr><tr>";
                            echo "<td>
                                    <textarea class='form-control' style='size:11px;max-width: 100%;height:225px; border-style: none; border: none;' name='hasil_pemeriksaan[".$data->kode."]'>".(isset($hasil_pemeriksaan[$data->kode]) ? $hasil_pemeriksaan[$data->kode]->hasil_pemeriksaan : "")."</textarea></td>";
                            // echo "<td><textarea class='form-control' name='hasil_pemeriksaan[".$data->kode."]' value='".(isset($hasil_pemeriksaan[$data->kode][$data->pemeriksaan]) ? $hasil_pemeriksaan[$data->kode][$data->pemeriksaan]->hasil_pemeriksaan : "")."'>".$as->hasil_pemeriksaan."</textarea></td>";

                            // echo "<td>
                            //         <textarea class='form-control' name='hasil_pemeriksaan[".$data->kode."]'>".(isset($hasil_pemeriksaan[$data->kode][$data->pemeriksaan]) ? $hasil_pemeriksaan[$data->kode][$data->pemeriksaan]->hasil_pemeriksaan : "")."</textarea></td>";
                            echo "</tr>";
                        }
                        $tgl1_print = $tgl1_print=="" ? date("d-m-Y") : $tgl1_print;
                        $tgl2_print = $tgl2_print=="" ? date("d-m-Y") : $tgl2_print;
                    ?>
                </tbody>
            </table>
			<!-- <table width="100%">
				
				<tr>
					<td  colspan="4">
						<textarea class="form-control" style="max-width: 100%;height:335px; border-style: none; border: none;">Sejawat YTH <?php echo $k->dokter_pengirim ?>

<?php echo $q->hasil_pemeriksaan ?></textarea>
					</td>
				</tr> -->
		<!-- 		<tr>
					<td></td>
					<td width="25%"> &nbsp;</td>
					<td></td>
					<td width="25%"> &nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td width="25%"> &nbsp;</td>
					<td></td>
					<td width="25%"> &nbsp;</td>
				</tr> -->
				
				
			<!-- </table> -->
		</td>
		
	</tr>
	<table border="1" rules="rows" width="100%">
		<tr>
			<td></td>
		</tr>
	</table>
</table>
	<table width="100%" align="right">
		<tr>
			<td>&nbsp;</td>
			<td width="25%">&nbsp;Cirebon &nbsp; <?php echo date("d-m-Y H:i:s", strtotime($q->tglp)); ?></td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;</td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;<div class="ttd_qrcode"></div></td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;<?php echo $k->nama_dokter ?></td>
		</tr>
	</table>

<style type="text/css">
	html, body {
        display: block;
        font-family: sans-serif;
        width: 20cm; height: 13cm;
    }
	.pull-right {
	    float: right;
	}
	.pull-left {
	    float: left;
	}
	th, td{
	    font-family: sans-serif;
	}
	td {
	    font-size: 11px;
	}
	th {
	    font-size: 11px;
	    font-weight: bold;
	}
	.text-right{
	    align:right;
	}
	textarea{
		font-size: 11px;
		font-family: sans-serif;
	}
	@page{
		width: 20cm; height: 13cm;
	}
</style>
</body>
</html>