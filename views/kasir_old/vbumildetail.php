<script>
	var mywindow;
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
    $(document).ready(function(){
		$(".tab-content").hide(); //Hide all content
		$("#tab-menu li a:first").addClass("active").show(); //Activate first tab
		$(".tab-content:first").show();
		$('#tab-menu li a').click(function() {
            $("#tab-menu li a").removeClass('active');
            $(this).addClass('active');
            $(".tab-content").hide();
            var activeTab = $(this).attr("href"); //Find the href attribute value to identify the active tab + content
            $(activeTab).show();
            return false;
		});
		var id = $(".seleksi").attr("href");
		$(".detailanc").load("<?php echo site_url('kia/getanctgl')?>/"+id);
		$("tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        $("tr#data").click(function(){
        	var id = $(".seleksi").attr("href");
			$(".detailanc").load("<?php echo site_url('kia/getanctgl')?>/"+id);
        })
        $(".cetak").click(function(){
        	var url = $(this).attr("href");
        	openCenteredWindow(url);
        	return false;
        })
		var formattgl = "dd-mm-yy";
        $("input[name='tgl']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
		$(".save").click(function(){
			$("#formsave").trigger("submit");
			return false;
		});
    })
</script>
<style>
	.table td{
		border-top:0;
		font-size:14px;
	}
</style>
<?php
if ($row){
		$id_puskesmas=$row->id_puskesmas;
		$nama_pasien=$row->nama_pasien;
		$no_kk=$row->no_kk;
		$nama_kk=$row->no_kk;
		$no_pasien=$row->no_pasien;
		$tanggal_periksa=$row->tanggal_periksa;
		$nama_paramedis= $row->nama_paramedis;
		$nama_puskesmas= $row->nama_puskesmas;
		$id_layanan= $row->id_layanan;
		$id_pasien=$row->id_pendaftaran;
		$umur=$row->umur;
		$tinggi_badan= $row->tinggi_badan;
		$lila= $row->lila;
		$tgl_haid_terakhir=$row->tgl_haid_terakhir;
		$tgl_taksiran_persalinan=$row->tgl_taksiran_persalinan;
		$keluhan_utama= $row->keluhan_utama;
		$jml_anak_rencana= $row->jml_anak_rencana;
		$datang_atas_petunjuk= $row->datang_atas_petunjuk;
		$perlakuan_kasar_suami= $row->perlakuan_kasar_suami;
		$keluhan_keputihan= $row->keluhan_keputihan;
		$gravida= $row->gravida;
		$jml_anak_hidup= $row->jml_anak_hidup;
		$jarak_persalinan_akhir= $row->jarak_persalinan_akhir;
		$penolong_persalinan_akhir= $row->penolong_persalinan_akhir;
		$cara_persalinan_akhir= $row->cara_persalinan_akhir;
		$placenta_lahir= $row->placenta_lahir;
		$penggunaan_kntrs_akhir= $row->penggunaan_kntrs_akhir;
		$partus= $row->partus;
		$abortus= $row->abortus;
		$jml_lahir_mati= $row->jml_lahir_mati;
		$ket_rujukan= $row->ket_rujukan;
		$rujukan= $row->rujukan;
	} else {
		$id_puskesmas=
		$nama_pasien=
		$no_kk=
		$nama_kk=
		$no_pasien=
		$tanggal_periksa=
		$nama_paramedis= 
		$nama_puskesmas= 
		$id_pasien=
		$umur=
		$tinggi_badan= 
		$lila= 
		$tgl_haid_terakhir=
		$tgl_taksiran_persalinan=
		$keluhan_utama= 
		$jml_anak_rencana= 
		$datang_atas_petunjuk= 
		$perlakuan_kasar_suami= 
		$keluhan_keputihan= 
		$gravida= 
		$jml_anak_hidup= 
		$jarak_persalinan_akhir= 
		$penolong_persalinan_akhir= 
		$cara_persalinan_akhir= 
		$placenta_lahir= 
		$penggunaan_kntrs_akhir= 
		$partus=
		$abortus= 
		$jml_lahir_mati= 
		$ket_rujukan= 
		$rujukan= "";
	}
?>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->session->flashdata('message');?>
		<div class="subnav">
		<div class='span12'>
			<div class='text-center'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
		</div>
		</div>
		<div class="widget-box">
		<div class="widget-content">
			<table class="table">
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
					<td><?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?></td>
				</tr>
			</table>
		</div>
		</div>
		<div class="subnav">
			<div class='span8'>
				<ul class="nav nav-pills">
			       <?php
						echo "<li>".anchor("kasir/cetak/".$id_layanan."/".$id_pendaftaran, "<i class='icon-print'></i>&nbsp;Cetak",array("class"=>"cetak"))."</li>";
						echo "<li>".anchor("kasir/cetak_kwitansi/".$id_layanan."/".$id_pendaftaran, "<i class='icon-print'></i>&nbsp;Cetak Kwitansi",array("class"=>"cetak"))."</li>";
					?>			
			    </ul>
			</div>
		</div>
		<div class="widget-box">
        	<div class="widget-title">
            	<ul class="nav nav-tabs">
                	<li class="active"><a data-toggle="tab" href="#tab1">Detail ANC</a></li>
                	<li class=""><a data-toggle="tab" href="#tab2">Anamnesa</a></li>
                	<li class=""><a data-toggle="tab" href="#tab3">Resep Obat</a></li>
            	</ul>
        	</div>
        	<div class="widget-content tab-content">
				<div id="tab1" class="tab-pane active">
					<table cellpadding=5px cellspacing=5px>
						<tr>
							<td width=300px valign=top>
								<div class="widget-box">
									<div class="widget-title"><h5>Tanggal ANC</h5></div>
									<div class="widget-content">
										<table class="table table-bordered">
											<?php
												$i = 0;
												foreach ($q1->result() as $row) {
													$i++;
													echo "<tr id=data href='".$row->id_antenatal_care."/".$id_pendaftaran."'>
															<td>".$i."</td>
															<td>".date("d-m-Y", strtotime($row->tgl))."</td>
													  	  </tr>";
												}
											?>
										</table>
									</div>
								</div>
							</td>
							<td valign=top width=900px>
								<div class='detailanc'></div>
							</div>
							</td>
						</tr>
					</table>
            	</div>
            	<div id="tab2" class="tab-pane">
            		<div class="widget-box">
						<div class="widget-content form-horizontal">
							<div class="control-group">
								<label class="control-label">Tinggi Badan</label>
								<div class="controls">
									<table>
										<tr>
											<td><input type=text disabled name='tinggi_badan' value='<?php echo $tinggi_badan;?>'></td>
											<td width=100>LILA (cm)</td>
											<td><input type=text name='lila' disabled value='<?php echo $lila;?>'></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal Haid Terakhir</label>
								<div class="controls"><input type=text disabled name='tgl_haid_terakhir' value='<?php echo date("d-m-Y",strtotime($tgl_haid_terakhir));?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal Penaksiran Persalinan</label>
								<div class="controls"><input type=text disabled name='tgl_taksiran_persalinan' value='<?php echo date("d-m-Y",strtotime($tgl_taksiran_persalinan));?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Keluhan Utama</label>
								<div class="controls"><input type=text disabled name='keluhan_utama' value='<?php echo $keluhan_utama;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Jumlah Anak Yang direncanakan</label>
								<div class="controls"><input type=text disabled name='jml_anak_rencana' value='<?php echo $jml_anak_rencana;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Datang Atas Petunjuk</label>
								<div class="controls">
									<select name='datang_atas_petunjuk' disabled>
										<option value='Suami' <?php echo (($datang_atas_petunjuk == 'Suami') ? "selected" : "")?>>Suami</option>
										<option value='Kader' <?php echo (($datang_atas_petunjuk == 'Kader') ? "selected" : "")?>>Kader</option>
										<option value='Petugas' <?php echo (($datang_atas_petunjuk == 'Petugas') ? "selected" : "")?>>Petugas</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Adakah Perlakuan Kasar Suami</label>
								<div class="controls">
									<select name='perlakuan_kasar_suami' disabled>
										<option value='Tidak'>Tidak</option>
										<option value='Ada'>Ada</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Adakah Keluhan Keputihan</label>
								<div class="controls">
									<select name='keluhan_keputihan' disabled>
										<option value='Tidak'>Tidak</option>
										<option value='Ada'>Ada</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Kehamilan</label>
								<div class="controls">
									<table>
										<tr>
											<td width=100><input type=text disabled name='gravida' value='<?php echo $gravida;?>'></td><td>Gravida&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td width=100><input type=text disabled name='partus' value='<?php echo $partus;?>'></td><td>Partus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td width=100><input type=text disabled name='abortus' value='<?php echo $abortus;?>'></td><td>Abortus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jumlah Yang Hidup</label>
								<div class="controls"><input type=text disabled name='jml_anak_hidup' value='<?php echo $jml_anak_hidup;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Jumlah Yang Meninggal</label>
								<div class="controls"><input type=text disabled name='jml_lahir_mati' value='<?php echo $jml_lahir_mati;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Jarak Persalinan Terakhir</label>
								<div class="controls"><input type=text disabled name='jarak_persalinan_akhir' value='<?php echo $jarak_persalinan_akhir;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Penolong persalinan terakhir</label>
								<div class="controls"><input type=text disabled name='penolong_persalinan_akhir' value='<?php echo $penolong_persalinan_akhir;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Riwayat persalinan lalu</label>
								<div class="controls"><input type=text disabled name='cara_persalinan_akhir' value='<?php echo $cara_persalinan_akhir;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Placenta lahir dengan</label>
								<div class="controls"><input type=text disabled name='placenta_lahir' value='<?php echo $placenta_lahir;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Penggunaan kontrasepsi sebelum kelahiran ini</label>
								<div class="controls"><input type=text disabled name='penggunaan_kntrs_akhir' value='<?php echo $penggunaan_kntrs_akhir;?>'></div>
							</div>
							<div class="control-group">
								<label class="control-label">Tempat Rujukan/ RSBM</label>
								<div class="controls">
									<table>
										<tr>
											<td width=200>
												<select name='rujukan' disabled>
													<?php echo $this->Mpendaftaran->rujukan($rujukan);?>
												</select>
											</td>
											<td width=650><input type=text disabled name='ket_rujukan' value='<?php echo $ket_rujukan;?>'></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
            	</div>
            	<div id="tab3" class="tab-pane">
            		<div class="widget-box">
	            		<?php
							echo "
							<table id='data colums' class='table table-bordered'>
								<tr>
							   		<th width='20px' >No</th>
							   		<th>Tanggal</th>
							   		<th>Obat</th>
							   		<th width=400>Dosis</th>
							 	</tr>";
									$i = 0;
									foreach ($q5->result() as $row){
										$i++;
										echo "<tr class='pasienlab'>
												  <td align=center>".$i."</td>
												  <td>".$this->tglindo->tgl($row->tanggal,'2')."</td>
												  <td>".$row->nama_obat."</td>
												  <td>".$row->aturan_pakai."</td>
												  <td>".$row->jml_pemakaian."</td>
										  	  </tr>";
									}
							echo "</table>";
						?>
					</div>
            	</div>	
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>