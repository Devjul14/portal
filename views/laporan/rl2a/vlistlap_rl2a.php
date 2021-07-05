<script>
	function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
	$(document).ready(function(e){
		// window.print();
		var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
            $(".print").click(function(){
            var id = $(".bg-gray").attr("href");
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('laporan/rl2a')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("laporan/list_rl2a");?>/"+tgl1+"/"+tgl2;
        });
        // $(".search").click(function(){
        //     var tgl1 = $("[name='tgl1']").val();
        //     var tgl2 = $("[name='tgl2']").val();
        //     var arrayData = {tgl1: tgl1,tgl2: tgl2};
        //     $.ajax({
        //         url: "<?php echo site_url('laporan/search');?>", 
        //         type: 'POST', 
        //         data: arrayData, 
        //         success: function(){
        //             location.reload();
        //         }
        //     });
        // });
    });  
</script>
<body>
<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="col-md-1 control-label">Tanggal</label>
	                    <div class="col-md-2">
	                            <input type="text" class="form-control" name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" autocomplete="off"/>
	                    </div>
	                    <div class="col-md-2">
	                            <input type="text" class="form-control" name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" autocomplete="off"/>   
	                    </div>
						<div class="col-md-1">
	                        <div class="pull-left">
			                     <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
	                        </div>
	                    </div>
	                    <div class="col-md-6">
		                    <button class="print btn btn-success pull-right" type = "button" ><i class="fa fa-print"></i>&nbsp;Cetak</button>	
		                </div>
				</div>
			</div>
			<table  width="100%" align="right" border="0">
				<tr>
					<td class="text-center" colspan="2">
						DATA KEADAAN MORBIDITAS PASIEN RAWAT INAP RUMAH SAKIT
					</td>
					<td></td>
				</tr>
				<?php
					$bulan = array(
								"",
								"JANUARI",
								"FEBRUARI",
								"MARET",
								"APRIL",
								"MEI",
								"JUNI",
								"JULI",
								"AGUSTUS",
								"SEPTEMBER",
								"OKTOBER",
								"NOPEMBER",
								"DESEMBER"
							);
				?>
				<tr>
					<td class="text-center" colspan="2">BULAN : <?php echo $bulan[(int)date("m",strtotime($tgl1))]; ?></td>
				</tr>
				<tr>
					<td class="text-center" colspan="2">TAHUN : 2019</td>
				</tr>
			</table>
					<br>
				<table border="1" cellspacing="0" cellpadding="1">
		                <thead>
		                    <tr>
			                    <td rowspan = "4" class='text-center'>No</td>
			                    <td width="5%" rowspan = "4" class='text-center'>No DTD</td>
			                    <td class='text-center' width="10%" rowspan = "4">No Daftar Terinci</td>
			                    <td width ="25%" rowspan = "4" class="text-center">Golongan Sebab - Sebab Sakit</td>
			                    <td colspan = "15" class='text-center'>Pasien Menurut Golongan Status</td>
			                    <td colspan ="9"class='text-center'>PASIEN KELUAR (HIDUP & MATI) MENURUT GOL UMUM</td>
			                    <td colspan="2" class='text-center'>PASIEN KELUAR (HIDUP & MATI) MENURUT SEX </td>
			                    <td rowspan="4" class="text-center">JUMLAH PASIEN <br>KELUAR (29+30)</td>
			                    <td rowspan="4" class="text-center">JUMLAH PASIEN<br>KELUAR MATI</td>
		                    </tr>
		                    <tr>
		                    	<td colspan="6" class="text-center">ANGKATAN DARAT</td>
		                    	<td colspan="4" class="text-center">ANGKATAN LAIN</td>
		                    	<td colspan="3" class="text-center">BPJS</td>
		                    	<td colspan="1" rowspan="3" class="text-center">UMUM / PERU SAHAAN</td>
		                    	<td colspan="1" rowspan="3" class="text-center">JML</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">0-28 HR</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">28 HR - < 1TH</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">1 - 4 THN</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">5 - 14 TH</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">16 - 25 TH</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">26 - 44 TH</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">45 - 64 TH</td>
		                    	<td width="2.5%" rowspan="3" class="text-center">≥ 65 TH</td>
		                    	<td width="2.5%"rowspan="3" class="text-center">JML</td>
		                    	<td rowspan="3" class="text-center">LK</td>
		                    	<td rowspan="3" class="text-center">PR</td>
		                    </tr>
		                    <tr>
		                    	<td width="2%" colspan="3" class="text-center">MIL</td>
		                    	<td width="2%" rowspan="2" class="text-center">SIPIL</td>
		                    	<td width="2%" rowspan="2" class="text-center">KEL</td>
		                    	<td width="2%" rowspan="2" class="text-center">JML</td>
		                    	<td width="2%" rowspan="2" class="text-center">MIL</td>
		                    	<td width="2%" rowspan="2" class="text-center">SIPIL</td>
		                    	<td width="2%" rowspan="2" class="text-center">KEL</td>
		                    	<td width="2%" rowspan="2" class="text-center">JML</td>
		                    	<td width="2%" rowspan="2" class="text-center">PURN</td>
		                    	<td width="2%" rowspan="2" class="text-center">UMUM</td>
		                    	<td width="2%" rowspan="2" class="text-center">JML</td>
		                    </tr>
		                    <tr>
		                    	<td>SAT PUR</td>
							    <td>SAT BANPUR</td>
							    <td>SAT BANMIN</td>
		                    </tr>
		                </thead>
		                <tbody>
		                	<tr>
		                		<?php
		                		 for($i = 1; $i <= 32 ; $i++){
		                			echo "<td class='text-center'>".$i."</td>";
		                			}
		                			// echo "<td class='text-center'>".$satpur."</td>";
		                		  ?>
		                	</tr>

		                    <?php 
		                        $i = 2; 
		                        $jml = 0;
		                        $t_satpur =0;
								$t_satbanpur =0;
								$t_satbanmin =0;
								$t_tniad =0;
								$t_keltniad =0;
								$t_jml =0;
								$t_millain =0;
								$t_kellain =0;
								$t_sipillain =0;
								$t_jml_lain =0;
								$t_purnbpjs =0;
								$t_umumbpjs =0;
								$t_jml_bpjs =0;
								$t_umumper =0;
								$t_pasien =0;
								$t_h2 =0;
								$t_h3 =0;
								$t_h4 =0;
								$t_h5 =0;
								$t_h6 =0;
								$t_h7 =0;
								$t_h8 =0;
								$t_jml_hari =0;
								$t_laki =0;
								$t_perempuan =0;
								$t_jml_baru =0;
								$t_meninggal =0;
								// $hide = "";
		                         foreach($q->result() as $data){
		                         	// if ($tindakan!="all"){
                            //         if ($tindakan==$data->kode_tindakan){
                            //             $hide = "";
                            //         } else {
                            //             $hide = "class='hide'";
                            //         }
                            //     } else {
                            //         $jml = isset($p["tindakan"][$data->kode_tindakan]) ? $p["tindakan"][$data->kode_tindakan] : 0;
                            //         if ($jml>0){
                            //             $hide = "class='bg-blue text-bold'";
                            //         } else {
                            //             $hide = "";
                            //         }
                            //     }
		                            echo "<tr tindakan='".$data->kode."' nama_tindakan='".$data->nama."'>";
		                            echo "<td class='text-center'>".$i++."</td>";
		                            echo "<td>".$data->no_dtd."</td>";
		                            echo "<td>".$data->no_daftar."</td>";
		                            echo "<td>".$data->golongan_sebab."</td>";
		                            // echo "<input type='hidden' name='kode' value='".$data->kode."'></td>";
		                            echo "<td class='text-center'>".(isset($p["SATPUR"][$data->no_dtd]) ? $p["SATPUR"][$data->no_dtd] : 0)."</td>";
		                            echo "<td class='text-center'>".(isset($p["SATBANPUR"][$data->no_dtd]) ? $p["SATBANPUR"][$data->no_dtd] : 0)."</td>";
		                            echo "<td class='text-center'>".(isset($p["SATBANMIN"][$data->no_dtd]) ? $p["SATBANMIN"][$data->no_dtd] : 0)."</td>";
		                            echo "<td class='text-center'>".(isset($p["SIPILTNIAD"][$data->no_dtd]) ? $p["SIPILTNIAD"][$data->no_dtd] : 0)."</td>";
		                            echo "<td class='text-center'>".(isset($p["KELTNIAD"][$data->no_dtd]) ? $p["KELTNIAD"][$data->no_dtd] : 0)."</td>";
		                            $jumlah_ad = (isset($p["SATPUR"][$data->no_dtd]) ? $p["SATPUR"][$data->no_dtd] : 0)+
                                          (isset($p["SATBANPUR"][$data->no_dtd]) ? $p["SATBANPUR"][$data->no_dtd] : 0)+
                                          (isset($p["SATBANMIN"][$data->no_dtd]) ? $p["SATBANMIN"][$data->no_dtd] : 0)+
                                          (isset($p["SIPILTNIAD"][$data->no_dtd]) ? $p["SIPILTNIAD"][$data->no_dtd] : 0)+
                                          (isset($p["KELTNIAD"][$data->no_dtd]) ? $p["KELTNIAD"][$data->no_dtd] : 0);
                                    echo "<td class='text-center'>".$jumlah_ad."</td>";
		                            echo "<td class='text-center'>".(isset($p["MILLAIN"][$data->no_dtd]) ? $p["MILLAIN"][$data->no_dtd] : 0)."</td>";
		                            echo "<td class='text-center'>".(isset($p["SIPILLAIN"][$data->no_dtd]) ? $p["SIPILLAIN"][$data->no_dtd] : 0)."</td>";
		                            echo "<td class='text-center'>".(isset($p["KELLAIN"][$data->no_dtd]) ? $p["KELLAIN"][$data->no_dtd] : 0)."</td>";
		                            $jumlah_lain = (isset($p["MILLAIN"][$data->no_dtd]) ? $p["MILLAIN"][$data->no_dtd] : 0)+
                                          (isset($p["SIPILLAIN"][$data->no_dtd]) ? $p["SIPILLAIN"][$data->no_dtd] : 0)+
                                          (isset($p["KELLAIN"][$data->no_dtd]) ? $p["KELLAIN"][$data->no_dtd] : 0);
                                    echo "<td class='text-center'>".$jumlah_lain."</td>";
		                            echo "<td class='text-center'>".(isset($p["PURNBPJS"][$data->no_dtd]) ? $p["PURNBPJS"][$data->no_dtd] : 0)."</td>";
		                            echo "<td class='text-center'>".(isset($p["UMUMBPJS"][$data->no_dtd]) ? $p["UMUMBPJS"][$data->no_dtd] : 0)."</td>";
		                            $jumlah_bpjs = (isset($p["PURNBPJS"][$data->no_dtd]) ? $p["PURNBPJS"][$data->no_dtd] : 0)+
                                          (isset($p["UMUMBPJS"][$data->no_dtd]) ? $p["UMUMBPJS"][$data->no_dtd] : 0);
                                    echo "<td class='text-center'>".$jumlah_bpjs."</td>";
                                    echo "<td class='text-center'>".(isset($p["UMUMPERUSAHAAN"][$data->no_dtd]) ? $p["UMUMPERUSAHAAN"][$data->no_dtd] : 0)."</td>";
                                    $jumlah_umum = isset($p["UMUMPERUSAHAAN"][$data->no_dtd]) ? $p["UMUMPERUSAHAAN"][$data->no_dtd] : 0;
                                    echo "<td class='text-center'>".($jumlah_ad+$jumlah_lain+$jumlah_bpjs+$jumlah_umum)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI1"][$data->no_dtd]) ? $p["HARI1"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI2"][$data->no_dtd]) ? $p["HARI2"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI3"][$data->no_dtd]) ? $p["HARI3"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI8"][$data->no_dtd]) ? $p["HARI8"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI4"][$data->no_dtd]) ? $p["HARI4"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI5"][$data->no_dtd]) ? $p["HARI5"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI6"][$data->no_dtd]) ? $p["HARI6"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["HARI7"][$data->no_dtd]) ? $p["HARI7"][$data->no_dtd] : 0)."</td>";
                                    $jumlah_hari = (isset($p["HARI1"][$data->no_dtd]) ? $p["HARI1"][$data->no_dtd] : 0)+
                                          (isset($p["HARI2"][$data->no_dtd]) ? $p["HARI2"][$data->no_dtd] : 0)+
                                          (isset($p["HARI3"][$data->no_dtd]) ? $p["HARI3"][$data->no_dtd] : 0)+
                                          (isset($p["HARI8"][$data->no_dtd]) ? $p["HARI8"][$data->no_dtd] : 0)+
                                          (isset($p["HARI4"][$data->no_dtd]) ? $p["HARI4"][$data->no_dtd] : 0)+
                                          (isset($p["HARI5"][$data->no_dtd]) ? $p["HARI5"][$data->no_dtd] : 0)+
                                          (isset($p["HARI6"][$data->no_dtd]) ? $p["HARI6"][$data->no_dtd] : 0)+
                                          (isset($p["HARI7"][$data->no_dtd]) ? $p["HARI7"][$data->no_dtd] : 0);
                                    echo "<td class='text-center'>".$jumlah_hari."</td>";
                                    echo "<td class='text-center'>".(isset($p["LAKI"][$data->no_dtd]) ? $p["LAKI"][$data->no_dtd] : 0)."</td>";
                                    echo "<td class='text-center'>".(isset($p["PEREMPUAN"][$data->no_dtd]) ? $p["PEREMPUAN"][$data->no_dtd] : 0)."</td>";
                                    $kasus_baru = (isset($p["HARI6"][$data->no_dtd]) ? $p["HARI6"][$data->no_dtd] : 0)+
                                          (isset($p["HARI7"][$data->no_dtd]) ? $p["HARI7"][$data->no_dtd] : 0);
                                    $pasien_keluar = ((isset($p["LAKI"][$data->no_dtd]) ? $p["LAKI"][$data->no_dtd] : 0)+(isset($p["PEREMPUAN"][$data->no_dtd]) ? $p["PEREMPUAN"][$data->no_dtd] : 0));
                                    echo "<td class='text-center'>".$pasien_keluar."</td>";
                                    $meninggal = (isset($p["MENINGGAL"][$data->no_dtd]) ? $p["MENINGGAL"][$data->no_dtd] : 0);
                                    echo "<td class='text-center'>".$meninggal."</td>";
		                            echo "</tr>";
		                            
			                        $t_satpur += (isset($p["SATPUR"][$data->no_dtd]) ? $p["SATPUR"][$data->no_dtd] : 0);
									$t_satbanpur += (isset($p["SATBANPUR"][$data->no_dtd]) ? $p["SATBANPUR"][$data->no_dtd] : 0);
									$t_satbanmin += (isset($p["SATBANMIN"][$data->no_dtd]) ? $p["SATBANMIN"][$data->no_dtd] : 0);
									$t_tniad += (isset($p["SIPILTNIAD"][$data->no_dtd]) ? $p["SIPILTNIAD"][$data->no_dtd] : 0);
									$t_keltniad += (isset($p["KELTNIAD"][$data->no_dtd]) ? $p["KELTNIAD"][$data->no_dtd] : 0);
									$t_jml += $jumlah_ad;
									$t_millain += (isset($p["MILLAIN"][$data->no_dtd]) ? $p["MILLAIN"][$data->no_dtd] : 0);
									$t_kellain += (isset($p["KELLAIN"][$data->no_dtd]) ? $p["KELLAIN"][$data->no_dtd] : 0);
									$t_sipillain += (isset($p["SIPILLAIN"][$data->no_dtd]) ? $p["SIPILLAIN"][$data->no_dtd] : 0);
									$t_jml_lain += $jumlah_lain;
									$t_purnbpjs += (isset($p["PURNBPJS"][$data->no_dtd]) ? $p["PURNBPJS"][$data->no_dtd] : 0);
									$t_umumbpjs += (isset($p["UMUMBPJS"][$data->no_dtd]) ? $p["UMUMBPJS"][$data->no_dtd] : 0);
									$t_jml_bpjs += $jumlah_bpjs;
									$t_umumper += (isset($p["UMUMPERUSAHAAN"][$data->no_dtd]) ? $p["UMUMPERUSAHAAN"][$data->no_dtd] : 0);
									$t_pasien += (isset($p["HARI1"][$data->no_dtd]) ? $p["HARI1"][$data->no_dtd] : 0);;
									$t_h2 += (isset($p["HARI2"][$data->no_dtd]) ? $p["HARI2"][$data->no_dtd] : 0);
									$t_h3 += (isset($p["HARI3"][$data->no_dtd]) ? $p["HARI3"][$data->no_dtd] : 0);
									$t_h4 += (isset($p["HARI8"][$data->no_dtd]) ? $p["HARI8"][$data->no_dtd] : 0);
									$t_h5 += (isset($p["HARI4"][$data->no_dtd]) ? $p["HARI4"][$data->no_dtd] : 0);
									$t_h6 += (isset($p["HARI5"][$data->no_dtd]) ? $p["HARI5"][$data->no_dtd] : 0);
									$t_h7 += (isset($p["HARI6"][$data->no_dtd]) ? $p["HARI6"][$data->no_dtd] : 0);
									$t_h8 += (isset($p["HARI7"][$data->no_dtd]) ? $p["HARI7"][$data->no_dtd] : 0);
									$t_jml_hari += $jumlah_hari;
									$t_laki += (isset($p["LAKI"][$data->no_dtd]) ? $p["LAKI"][$data->no_dtd] : 0);
									$t_perempuan += (isset($p["PEREMPUAN"][$data->no_dtd]) ? $p["PEREMPUAN"][$data->no_dtd] : 0);
									$t_meninggal += (isset($p["MENINGGAL"][$data->no_dtd]) ? $p["MENINGGAL"][$data->no_dtd] : 0);
		                         }
		                    ?>
		                    <tr>
		                    	<td colspan="4" class="text-center">Jumlah</td>
		                    	<td class='text-center'><?php echo $t_satpur; ?></td>
	                            <td class='text-center'><?php echo $t_satbanpur; ?></td>
	                            <td class='text-center'><?php echo $t_satbanmin; ?></td>
	                            <td class='text-center'><?php echo $t_tniad; ?></td>
	                            <td class='text-center'><?php echo $t_keltniad; ?></td>
	                            <td class='text-center'><?php echo $t_jml; ?></td>
	                            <td class='text-center'><?php echo $t_millain; ?></td>
	                            <td class='text-center'><?php echo $t_kellain; ?></td>
	                            <td class='text-center'><?php echo $t_sipillain; ?></td>
	                            <td class='text-center'><?php echo $t_jml_lain; ?></td>
	                            <td class='text-center'><?php echo $t_purnbpjs; ?></td>
	                            <td class='text-center'><?php echo $t_umumbpjs; ?></td>
	                            <td class='text-center'><?php echo $t_jml_bpjs; ?></td>
	                            <td class='text-center'><?php echo $t_umumper; ?></td>
	                            <td class='text-center'><?php echo ($t_jml+$t_jml_lain+$t_jml_bpjs+$t_umumper); ?></td>
	                            <td class='text-center'><?php echo $t_pasien; ?></td>
	                            <td class='text-center'><?php echo $t_h2; ?></td>
	                            <td class='text-center'><?php echo $t_h3; ?></td>
	                            <td class='text-center'><?php echo $t_h4; ?></td>
	                            <td class='text-center'><?php echo $t_h5; ?></td>
	                            <td class='text-center'><?php echo $t_h6; ?></td>
	                            <td class='text-center'><?php echo $t_h7; ?></td>
	                            <td class='text-center'><?php echo $t_h8; ?></td>
	                            <td class='text-center'><?php echo $t_jml_hari; ?></td>
	                            <td class='text-center'><?php echo $t_laki; ?></td>
	                            <td class='text-center'><?php echo $t_perempuan; ?></td>
	                            <td class='text-center'><?php echo ($t_laki+$t_perempuan); ?></td>
		                    	<td class="text-center"><?php echo $t_meninggal; ?></td>
		                    </tr>
		                </tbody>
		            </table>
		</div>
	</div>
</div>
<style type="text/css">
	html, body {
        /*display: block;*/
        /*font-family: "dotmatrik";*/
        /*width: 20cm; height: 13cm;*/
    }
	.pull-right {
	    float: right;
	}
	.pull-left {
	    float: left;
	}
	th, td{
	    /*font-family: "dotmatrik";*/
	}
	td {
	    font-size: 8px;
	}
	th {
	    font-size: 8px;
	    font-weight: bold;
	}
	.text-right{
	    /*align:right;*/
	}
	textarea{
		/*font-size: 12px;*/
	}
	/*@page{
		width: 20cm; height: 13cm;
	}*/
</style>
</body>
</html>