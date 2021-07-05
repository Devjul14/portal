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
		var tgl = $(".seleksi").attr("href");
		var id_bumil = $("input[name='id_bumil']").val();
		$(".detailanc").load("<?php echo site_url('kia/getanctgl')?>/"+id_bumil+"/"+tgl);
		$("tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
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
		$(".save1").click(function(){
			$("#formsave1").trigger("submit");
			return false;
		});
		$(".save2").click(function(){
			$("#formsave2").trigger("submit");
			return false;
		});
		$(".hapus2").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapus_djj');?>/"+id;
			return false;
		});
		$(".save3").click(function(){
			$("#formsave3").trigger("submit");
			return false;
		});
		$(".hapus3").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapus_airketuban');?>/"+id;
			return false;
		});
		$(".save4").click(function(){
			$("#formsave4").trigger("submit");
			return false;
		});
		$(".hapus4").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapus_servik');?>/"+id;
			return false;
		});
		$(".save5").click(function(){
			$("#formsave5").trigger("submit");
			return false;
		});
		$(".hapus5").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapus_kontraksi');?>/"+id;
			return false;
		});
		$(".save6").click(function(){
			$("#formsave6").trigger("submit");
			return false;
		});
		$(".hapus6").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapus_akhir');?>/"+id;
			return false;
		});
		$(".view_graphic_djj").click(function(){
			var url = "<?php echo site_url('kia/graphic').'/djj/'.$id_pendaftaran.'/'.$id_bumil;?>";
			$(".graphic_content").load(url);
		});
		$(".view_graphic_servik").click(function(){
			var url = "<?php echo site_url('kia/graphic').'/servik/'.$id_pendaftaran.'/'.$id_bumil;?>";
			$(".graphic_content").load(url);
		});
		$(".view_graphic_kontraksi").click(function(){
			var url = "<?php echo site_url('kia/graphic').'/kontraksi/'.$id_pendaftaran.'/'.$id_bumil;?>";
			$(".graphic_content").load(url);
		});
    })
</script>
<style>
	td.noborder{
		border:0;
	}
</style>
<?php
if ($q1){
	$jam_datang = $q1->jam_datang;
	$ketuban_pecah_jam = $q1->ketuban_pecah_jam;
	$mules_jam = $q1->mules_jam;
	$jam_datang = $q1->jam_datang;
	$action = "edit";
} else {
	$jam_datang = $ketuban_pecah_jam = $mules_jam = $jam_datang = ""; $action = "simpan";
}

$tab1 = $tab2 = $tab3 = $tab4 = $tab5 = $tab6 = ""; 
switch ($tab) {
	case 'tab1': $tab1 = "active"; break;
	case 'tab2': $tab2 = "active"; break;
	case 'tab3': $tab3 = "active"; break;
	case 'tab4': $tab4 = "active"; break;
	case 'tab5': $tab5 = "active"; break;
	case 'tab6': $tab6 = "active"; break;
}
?>
	<div class="col-xs-12">
		<?php echo $this->session->flashdata('message');?>
		<div class="box box-primary">
			<div class="box-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-xs-2 col-xs-2">Asal Puskesmas</label>
    					<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $p->nama_puskesmas;?>"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2 col-xs-2">No. Pasien</label>
    					<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $p->no_pasien;?>"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2 col-xs-2">Nama Pasien</label>
    					<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $p->nama_pasien;?>"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-2 col-xs-2">Umur</label>
    					<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-body">
				<div class="nav-tabs-custom">
            		<ul class="nav nav-tabs">
                		<li class="<?php echo $tab1;?>"><a data-toggle="tab" href="#tab1">Data Detail</a></li>
                		<li class="<?php echo $tab2;?>"><a data-toggle="tab" href="#tab2">Denyut Jantung</a></li>
                		<li class="<?php echo $tab3;?>"><a data-toggle="tab" href="#tab3">Air Ketuban</a></li>
                		<li class="<?php echo $tab4;?>"><a data-toggle="tab" href="#tab4">Pemb. Servik</a></li>
                		<li class="<?php echo $tab5;?>"><a data-toggle="tab" href="#tab5">Kontraksi</a></li>
                		<li class="<?php echo $tab6;?>"><a data-toggle="tab" href="#tab6">Tekanan Darah</a></li>
            		</ul>
        			<div class="tab-content">
						<div id="tab1" class="tab-pane <?php echo $tab1;?>">
							<div class="widget-box">
								<?php
									echo form_open("kia/simpan_partograf/".$action,array("id"=>"formsave1","class"=>"form-horizontal"));
									echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
									echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
								?>
								<div class="form-horizontal">
									<div class="form-group">
										<label class="control-label col-xs-3">Tanggal</label>
										<div class="col-xs-9">
											<input type=text class='form-control' disabled name='tgl' value='<?php echo date("d-m-Y",strtotime($p->tanggal));?>'>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Jam datang</label>
										<div class="col-xs-9">
											<input type=text class='form-control' name='jam_datang' value='<?php echo $jam_datang;?>'>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Ketuban Pecah sejak jam</label>
										<div class="col-xs-9">
											<input type=text class='form-control' name='ketuban_pecah_jam' value='<?php echo $ketuban_pecah_jam;?>'>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-3">Mules sejak jam</label>
										<div class="col-xs-9">
											<input type=text class='form-control' name='mules_jam' value='<?php echo $mules_jam;?>'>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-3">&nbsp;</label>
										<div class="col-xs-9">
											<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Simpan",array("class"=>"save1 btn btn-success"));?>
										</div>
									</div>
								</div>
								<?php echo form_close();?>
							</div>
            			</div>
            			<div id="tab2" class="tab-pane <?php echo $tab2;?>">
            				<div class="row">
								<div class="col-xs-6">
									<?php
										echo form_open("kia/simpan_djj",array("id"=>"formsave2","class"=>"form-horizontal"));
										echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
										echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
									?>
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-xs-3">Denyut Jantung</label>
											<div class="col-xs-9">
												<input type=text class='form-control' name='denyut_jantung'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">Jam Periksa</label>
											<div class="col-xs-9">
												<input type=text class='form-control' name='jam'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">&nbsp;</label>
											<div class="col-xs-9">
												<?php
													echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Simpan",array("class"=>"save2 btn btn-success"));
												?>	
												<a data-toggle="modal" href="#myModalgraphic" class='view_graphic_djj btn btn-warning'><i class="fa fa-signal"></i>&nbsp;View Graphic</a>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
								<div class="col-xs-6">
									<table class="table table-bordered">
										<tr class="bg-navy">
											<th width="5px">No.</th>
											<th>Jam Periksa</th>
											<th>Denyut Jantung</th>
											<th></th>
										</tr>
										<?php
											$n=1;
											foreach ($q2->result() as $d) {
												echo "<tr>
														 <td>".$n++."</td>
														 <td>".$d->jam."</td>
														 <td>".$d->denyut_jantung."</td>
														 <td><button type='button' class='hapus2 btn btn-sm btn-danger' value='".$id_pendaftaran."/".$id_bumil."/".$d->id."'><i class='fa fa-remove'></i></button></td>
													  </tr>";
											}
											for ($i=$n;$i<=5;$i++){
												echo "<tr>
															<td>".$i."</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
													  </tr>
													 ";
											}
										?>
									</table>
								</div>
							</div>
            			</div>
            			<div id="tab3" class="tab-pane <?php echo $tab3;?>">
            				<div class="row">
								<div class="col-xs-6">
									<?php
										echo form_open("kia/simpan_airketuban",array("id"=>"formsave3","class"=>"form-horizontal"));
										echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
										echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
									?>
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-xs-3">Air Ketuban</label>
											<div class="col-xs-9">
												<input type=text class='form-control' name='air_ketuban'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">Penyusupan</label>
											<div class="col-xs-9">
												<input type=text class='form-control' name='penyusupan'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">Jam Periksa</label>
											<div class="col-xs-9">
												<input type=text class='form-control' name='jam'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">&nbsp;</label>
											<div class="col-xs-9">
												<?php echo anchor("#", "<i class='icon-ok'></i>&nbsp;Simpan",array("class"=>"save3 btn btn-success"));?>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
								<div class="col-xs-6">
									<table class='table table-bordered'>
										<tr class="bg-navy">
											<th width="5px">No.</th>
											<th>Jam Periksa</th>
											<th>Air Ketuban</th>
											<th>Penyusupan</th>
											<th></th>
										</tr>
										<?php
											$n=1;
											foreach ($q3->result() as $d) {
												echo "<tr>
														 <td>".$n++."</td>
														 <td>".$d->jam."</td>
														 <td>".$d->air_ketuban."</td>
														 <td>".$d->penyusupan."</td>
														 <td><button type='button' class='hapus3 btn btn-sm btn-danger' value='".$id_pendaftaran."/".$id_bumil."/".$d->id."'><i class='icon-remove'></i></button></td>
													  </tr>";
											}
											for ($i=$n;$i<=5;$i++){
												echo "<tr>
															<td>".$i."</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
													  </tr>
													 ";
											}
										?>
									</table>
								</div>
							</div>
            			</div>
            			<div id="tab4" class="tab-pane <?php echo $tab4;?>">
            				<div class="row">
								<div class="col-xs-6">
									<?php
										echo form_open("kia/simpan_servik",array("id"=>"formsave4","class"=>"form-horizontal"));
										echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
										echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
									?>
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-xs-4">Pembukaan Servik</label>
											<div class="col-xs-8">
												<select name='pembukaan_servik' class="form-control">
													<?php 
														for ($i=10;$i>=4;$i--){
															echo "<option value='".$i."'>".$i."</option>";
														}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Turun Kepala</label>
											<div class="col-xs-8">
												<select name='turun_kepala' class="form-control">
													<?php 
														for ($i=1;$i<=3;$i++){
															echo "<option value='".$i."'>".$i."</option>";
														}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Jam Periksa</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='jam' class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">&nbsp;</label>
											<div class="col-xs-8">
												<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Simpan",array("class"=>"save4 btn btn-success"));?>		
												<a data-toggle="modal" href="#myModalgraphic" class='view_graphic_servik btn btn-warning'><i class="fa fa-signal"></i>&nbsp;View Graphic</a>
											</div>
										</div>
									</div>
								</div>
								<?php echo form_close();?>
								<div class="col-xs-6">
									<table class="table table-bordered">
										<tr class="bg-navy">
											<th width="5px">No.</th>
											<th>Jam Periksa</th>
											<th>Pembukaan ke-</th>
											<th>Turun Kepala</th>
											<th></th>
										</tr>
										<?php
											$n=1;
											foreach ($q4->result() as $d) {
												echo "<tr>
														 <td>".$n++."</td>
														 <td>".$d->jam."</td>
														 <td>".$d->pembukaan_servik."</td>
														 <td>".$d->turun_kepala."</td>
														 <td><button type='button' class='hapus4 btn btn-danger' value='".$id_pendaftaran."/".$id_bumil."/".$d->id."'><i class='icon-remove'></i></button></td>
													  </tr>";
											}
											for ($i=$n;$i<=5;$i++){
												echo "<tr>
															<td>".$i."</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
													  </tr>
													 ";
											}
										?>
									</table>
								</div>
							</div>
            			</div>
            			<div id="tab5" class="tab-pane <?php echo $tab5;?>">
            				<div class="row">
								<div class="col-xs-6">
									<?php
										echo form_open("kia/simpan_kontraksi",array("id"=>"formsave5","class"=>"form-horizontal"));
										echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
										echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
									?>
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-xs-3">Frekuensi</label>
											<div class="col-xs-9">
												<select name='frekuensi' class="form-control">
													<option value='<20'>&lt;20</option>
													<option value='20-40'>20-40</option>
													<option value=">40">&gt;40</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">Kontraksi</label>
											<div class="col-xs-9">
												<select name='kontraksi' class="form-control">
													<?php
														for($i=1;$i<=5;$i++){
															echo "<option value='".$i."'>".$i."</option>";
														}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">Jam Periksa</label>
											<div class="col-xs-9">
												<input type=text class='form-control' name='jam'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-3">&nbsp;</label>
											<div class="col-xs-9">
												<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Simpan",array("class"=>"save5 btn btn-success"));?>			
												<a data-toggle="modal" href="#myModalgraphic" class='view_graphic_kontraksi btn btn-warning'><i class="fa fa-signal"></i>&nbsp;View Graphic</a>	
											</div>
										</div>
									</div>
								</div>
								<?php echo form_close();?>
								<div class="col-xs-6">
									<table class="table table-bordered">
										<tr class="bg-navy">
											<th width="5px">No.</th>
											<th>Jam Periksa</th>
											<th>Kontraksi</th>
											<th>Frekuensi</th>
											<th></th>
										</tr>
										<?php
											$n=1;
											foreach ($q5->result() as $d) {
												echo "<tr>
														 <td>".$n++."</td>
														 <td>".$d->jam."</td>
														 <td>".$d->kontraksi."</td>
														 <td>".$d->frekuensi."</td>
														 <td><button type='button' class='hapus5 btn btn-danger' value='".$id_pendaftaran."/".$id_bumil."/".$d->id."'><i class='icon-remove'></i></button></td>
													  </tr>";
											}
											for ($i=$n;$i<=5;$i++){
												echo "<tr>
															<td>".$i."</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
													  </tr>
													 ";
											}
										?>
									</table>
								</div>
							</div>
            			</div>
            			<div id="tab6" class="tab-pane <?php echo $tab6;?>">
            				<div class="row">
								<div class="col-xs-4">
									<?php
										echo form_open("kia/simpan_akhir",array("id"=>"formsave6","class"=>"form-horizontal"));
										echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
										echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
									?>
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-xs-4">Tekanan Darah</label>
											<div class="col-xs-3">
												<input type=text class='form-control' name='sistol'>
											</div>
											<label class="control-label col-xs-1"> / </label> 
											<div class="col-xs-4">	
												<input type=text class='form-control' name='diastol'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Nadi</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='nadi'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Temperatur</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='temperatur'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Protein (urin)</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='protein'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Aseton (urin)</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='aseton'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Volume (urin)</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='volume'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Makan</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='makan'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Minum</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='minum'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">Jam Periksa</label>
											<div class="col-xs-8">
												<input type=text class='form-control' name='jam'>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-xs-4">&nbsp;</label>
											<div class="col-xs-8">
												<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Simpan",array("class"=>"save6 btn btn-success"));?>
											</div>
										</div>
									</div>
									<?php echo form_close();?>
								</div>
								<div class="col-xs-8">
									<table class="table table-bordered">
										<tr class="bg-navy">
											<th>No.</th>
											<th>Jam</th>
											<th>TD</th>
											<th>Nadi</th>
											<th>Temperatur</th>
											<th>Protein</th>
											<th>Aseton</th>
											<th>Volume</th>
											<th>Makan</th>
											<th>Minum</th>
											<th>&nbsp;</th>
										</tr>
										<?php
											$n=1;
											foreach ($q6->result() as $d) {
												echo "<tr>
														 <td class='text-center'>".$n++."</td>
														 <td>".$d->jam."</td>
														 <td>".$d->sistol."/".$d->diastol."</td>
														 <td>".$d->nadi."</td>
														 <td>".$d->temperatur."</td>
														 <td>".$d->urin_protein."</td>
														 <td>".$d->urin_aseton."</td>
														 <td>".$d->urin_volume."</td>
														 <td>".$d->makan."</td>
														 <td>".$d->minum."</td>
														 <td><button type='button' class='hapus6 btn btn-danger' value='".$id_pendaftaran."/".$id_bumil."/".$d->id."'><i class='icon-remove'></i></button></td>
													  </tr>";
											}
											for ($i=$n;$i<=10;$i++){
												echo "<tr>
															<td>".$i."</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
													  </tr>
													 ";
											}
										?>
									</table>
								</div>
							</div>
            			</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class='modal hide fade' id="myModalgraphic" style='width:630px'>
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
		<h3><?php echo $judul;?></h3>
	</div>
	<div class='modal-body'>
		<div class="graphic_content"></div>
	</div>
</div>