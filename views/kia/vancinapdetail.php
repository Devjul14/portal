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
		$(".simpan_subyektif").click(function(){
			$("#form_simpan_subyektif").trigger("submit");
			return false;
		});
		$(".simpan_obyektif").click(function(){
			$("#form_simpan_obyektif").trigger("submit");
			return false;
		});
		$(".simpan_assesment").click(function(){
			$("#form_simpan_assesment").trigger("submit");
			return false;
		});
		$(".cariobat").click(function(){
			var url = "<?php echo site_url('umum/cariobat');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".cari").click(function(){
			var url = "<?php echo site_url('kia/caritindakan');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".hapusresep").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapusresep');?>/"+id;
		});
    })
</script>
<style>
	td.noborder{
		border-top:0;
	}
</style>
<?php 
if ($row1->num_rows()>0){
	$row = $row1->row();
	$id_pendaftaran = $row->id_pendaftaran;
	$id_bumil = $row->id_bumil;
	$gravita1 = $row->gravita;
	$partus1 = $row->partus;
	$abortus1 = $row->abortus;
	$umur_kehamilan1 = $row->umur_kehamilan;
	$kontraksi_mulai_jam = $row->kontraksi_mulai_jam;
	$kontraksi_tiap = $row->kontraksi_tiap;
	$lama_kontraksi1 = $row->lama_kontraksi;
	$rasa_kontraksi = $row->rasa_kontraksi;
	$ketuban = $row->ketuban;
	$warna_cairan = $row->warna_cairan;
	$pendarahan = $row->pendarahan;
	$volume_pendarahan = $row->volume_pendarahan;
	$kondisi_pasien = $row->kondisi_pasien;
	$keluhan = $row->keluhan;
	$waktu1 = $row->waktu;
	$action1 = "edit";
} else {
	$gravita1=
	$partus1=
	$abortus1=
	$umur_kehamilan1=
	$kontraksi_mulai_jam=
	$kontraksi_tiap=
	$lama_kontraksi1=
	$rasa_kontraksi=
	$ketuban=
	$warna_cairan=
	$pendarahan=
	$volume_pendarahan=
	$kondisi_pasien=
	$keluhan=
	$waktu1="";
	$action1 = "simpan";
}

if ($row2->num_rows()>0){
	$row = $row2->row();
	$id_pendaftaran = $row->id_pendaftaran;
	$id_bumil = $row->id_bumil;
	$tekanan_darah = $row->tekanan_darah;
	$nadi = $row->nadi;
	$suhu = $row->suhu;
	$pernafasan = $row->pernafasan;
	$keadaan_umum = $row->keadaan_umum;
	$penurunan_kepala = $row->penurunan_kepala;
	$djj = $row->djj;
	$kontraksi_persepuluhmenit = $row->kontraksi_persepuluhmenit;
	$lama_kontraksi2 = $row->lama_kontraksi;
	$pembukaan = $row->pembukaan;
	$penurunan = $row->penurunan;
	$posisi_kepala = $row->posisi_kepala;
	$penyusupan = $row->penyusupan;
	$ketuban2 = $row->ketuban2;
	$warna_cairan2 = $row->warna_cairan2;
	$pendarahan2 = $row->pendarahan2;
	$catatan2 = $row->catatan;
	$waktu2 = $row->waktu;
	$action2="edit";
} else {
	$tekanan_darah=
	$nadi=
	$suhu=
	$pernafasan=
	$keadaan_umum=
	$penurunan_kepala=
	$djj=
	$kontraksi_persepuluhmenit=
	$lama_kontraksi2=
	$pembukaan=
	$penurunan=
	$posisi_kepala=
	$penyusupan=
	$ketuban2=
	$warna_cairan2=
	$pendarahan2=
	$catatan2=
	$waktu2="";
	$action2="simpan";
}

if ($row3->num_rows()>0){
	$row = $row3->row();
	$id_pendaftaran = $row->id_pendaftaran;
	$id_bumil = $row->id_bumil;
	$gravita2 = $row->gravita;
	$partus2 = $row->partus;
	$abortus2 = $row->abortus;
	$umur_kehamilan2 = $row->umur_kehamilan;
	$kala = $row->kala;
	$status = $row->status;
	$catatan3 = $row->catatan;
	$waktu3 = $row->waktu;
	$action3 = "edit";
} else {
	$gravita2=
	$partus2=
	$abortus2=
	$umur_kehamilan2=
	$kala=
	$status=
	$catatan3=
	$waktu3="";
	$action3="simpan";
}
?>
<script>
function hitungSelisihHari(tgl1, tgl2){
	    // varibel miliday sebagai pembagi untuk menghasilkan hari
	    var miliday = 24 * 60 * 60 * 1000;
	    //buat object Date
	    var tanggal1 = new Date(tgl1);
	    var tanggal2 = new Date(tgl2);
	    // Date.parse akan menghasilkan nilai bernilai integer dalam bentuk milisecond
	    var tglPertama = Date.parse(tanggal1);
	    var tglKedua = Date.parse(tanggal2);
	    var selisih = (tglKedua - tglPertama) / miliday;
	    return selisih;
    };
function umurkehamilan(t1,t2){
		var hasil = 277-hitungSelisihHari(t1,t2);
		var ke_bulan = parseInt(hasil/30);
		var sisa = hasil%30;
		if (sisa>0) {
			sisa = sisa+' hari'; 
		} else sisa ='';
		var umur = ke_bulan+' bulan '+sisa;
		return umur;
	};
$(document).ready(function(){
	var t2 = "<?php echo date('Y-m-d',strtotime($tgl_taksiran_persalinan));?>";
	var t1 = "<?php echo date('Y-m-d');?>";
	var umur = umurkehamilan(t1,t2);
	$("input[name='umur_kehamilan']").val(umur);
});
</script>
	<div class="col-xs-12">
		<?php echo $this->session->flashdata('message');?>
		<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-2">Asal Puskesmas</label>
					<div class="col-xs-10"><input type=text class='form-control' disabled value="<?php echo $p->nama_puskesmas;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">No. Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' disabled value="<?php echo $p->no_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Nama Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' disabled value="<?php echo $p->nama_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Umur</label>
					<div class="col-xs-10"><input type=text class='form-control' disabled value="<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Daftar Pertama</label>
					<div class="col-xs-10"><input type=text class='form-control' disabled value="<?php echo date('d-m-Y',strtotime($q1->tanggal));?>"></div>
				</div>
			</div>
			<div class="nav-tabs-custom">
            	<ul class="nav nav-tabs pull-right">
            		<li class="<?php echo ($tab=='3' ? 'active' : '');?>"><a data-toggle="tab" href="#tab3">Assesment</a></li>
            		<li class="<?php echo ($tab=='2' ? 'active' : '');?>"><a data-toggle="tab" href="#tab2">Obyektif Data</a></li>
                	<li class="<?php echo ($tab=='1' ? 'active' : '');?>"><a data-toggle="tab" href="#tab1">Subyektif Data</a></li>
            	</ul>
        		<div class="tab-content">
            		<div id="tab1" class="tab-pane <?php echo ($tab=='1' ? 'active' : '');?>">
						<?php
							echo form_open("kia/simpan_subyektif/".$action1,array("id"=>"form_simpan_subyektif","class"=>"form-horizontal"));
							echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
							echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
						?>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-xs-2 control-label">Waktu</label>
								<div class="col-xs-4">
									<input type=text class='form-control' name='waktu' value="<?php echo $waktu1;?>">
								</div>
								<label class="col-xs-1 control-label"><span class="pull-right">G</span></label>
								<div class="col-xs-1">
									<input type=text class='form-control' name='gravita' value="<?php echo $gravita1;?>"> 
								</div>
								<label class="col-xs-1 control-label"><span class="pull-right">P</span></label>
								<div class="col-xs-1">
									<input type=text class='form-control' name='partus' value="<?php echo $partus1;?>"> 
								</div>
								<label class="col-xs-1 control-label"><span class="pull-right">A</span></label>
								<div class="col-xs-1">
									<input type=text class='form-control' name='abortus' value="<?php echo $abortus1;?>"> 
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Umur kehamilan</label>
								<div class="col-xs-10">
									<div class="input-group">
										<input type=text class='form-control' name='umur_kehamilan' value="<?php echo $umur_kehamilan1;?>">
										<span class='input-group-addon'>minggu</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Kontraksi mulai pada jam</label>
								<div class="col-xs-10"> 
									<div class="input-group">
								 		<input type=text class='form-control' name='kontraksi_mulai_jam'  value="<?php echo $kontraksi_mulai_jam;?>">
								 		<span class="input-group-addon">waktu</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Pasien mengatakan bahwa kontraksinya terjadi setiap</label>
								<div class="col-xs-10"> 
								 	<input type=text class='form-control' name='kontraksi_tiap' value="<?php echo $kontraksi_tiap;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Berlangsung selama</label>
								<div class="col-xs-10"> 
									<div class="input-group">
										<input type=text class='form-control' name='lama_kontraksi'  value="<?php echo $lama_kontraksi1;?>">
										<span class="input-group-addon">detik</span> 
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">dan terasa</label>
								<div class="col-xs-10"> 
									<select name=rasa_kontraksi class='form-control'>
										<option value='lebih kuat'>lebih kuat</option>
										<option value='lebih lemah'>lebih lemah</optiom>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Ketubannya</label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='ketuban'  value="<?php echo $ketuban;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">dan warna cairan</label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='warna_cairan'  value="<?php echo $warna_cairan;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Pasien melaporkan</label>
								<div class="col-xs-10">
									<select name='pendarahan' class='form-control'>
										<option value='Y' <?php echo ($pendarahan=="Y" ? "selected" : "");?> >Ada</option>
										<option value='T' <?php echo ($pendarahan=="N" ? "selected" : "");?> >Tidak Ada</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Pendarahannya</label>
								<div class="col-xs-10">
									<select name=volume_pendarahan class='form-control'>
								 		<option value='sedikit' <?php echo ($volume_pendarahan=="sedikit" ? "selected" : "");?> >sedikit</option>
								 		<option value='sedang' <?php echo ($volume_pendarahan=="sedang" ? "selected" : "");?> >sedang</option>
								 		<option value='banyak' <?php echo ($volume_pendarahan=="banyak" ? "selected" : "");?> >banyak</option>
								 	</select>
								 </div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Pasien</label>
								<div class="col-xs-10">
									<select name='kondisi_pasien' class='form-control'>
										<option value='cukup istirahat' <?php echo ($kondisi_pasien=="cukup_istirahat" ? "selected" : "");?> >cukup istirahat</option>
										<option value='lelah' <?php echo ($kondisi_pasien=="lelah" ? "selected" : "");?> >lelah</option>
										<option value='sangat lelah' <?php echo ($kondisi_pasien=="sangat_lelah" ? "selected" : "");?> >sangat lelah</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">&nbsp;</label>
								<div class="col-xs-10">
									<div class="btn-group">
										<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"btn btn-warning simpan_subyektif"));?>
									</div>
								</div>
							</div>
							<?php echo form_close();?>
						</div>
					</div>
					<div id="tab2" class="tab-pane <?php echo ($tab=='2' ? 'active' : '');?>">
						<?php
							echo form_open("kia/simpan_obyektif/".$action2,array("id"=>"form_simpan_obyektif","class"=>"form-horizontal"));
							echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
							echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
						?>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-xs-2 control-label">Tekanan Darah </label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='tekanan_darah' value="<?php echo $tekanan_darah;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Nadi </label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='nadi' value="<?php echo $nadi;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Suhu</label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='suhu' value="<?php echo $suhu;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Pernafasan </label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='pernafasan' value="<?php echo $pernafasan;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Keadaan Umum </label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='keadaan_umum' value="<?php echo $keadaan_umum;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Penurunan kepala atau bagian yang turun </label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='penurunan_kepala' value="<?php echo $penurunan_kepala;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Denyut Jantung Janin </label>
								<div class="col-xs-10">
									<div class="input-group">
										<input type=text class='form-control' name='djj' value="<?php echo $djj;?>"> 
										<span class="input-group-addon">/menit</span> 
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Kontraksi </label>
								<div class="col-xs-10">
									<div class="input-group">
										<input type=text class='form-control' name='kontraksi_persepuluhmenit' value="<?php echo $kontraksi_persepuluhmenit;?>">
										<span class="input-group-addon">/ 10 menit</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">berlangsung selama </label>
								<div class="col-xs-10">
									<div class="input-group">
										<input type=text class='form-control' name='lama_kontraksi' value="<?php echo $lama_kontraksi2;?>">
										<span class="input-group-addon">detik</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Pembukaan </label>
								<div class="col-xs-10">
									<div class="input-group">
										<input type=text class='form-control' name='pembukaan' value="<?php echo $pembukaan;?>">
										<span class="input-group-addon">cm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Penurunan </label>
								<div class="col-xs-10">
									<select name=penurunan class='form-control'>
										<option value='Hodge' <?php echo ($penurunan=="hodge" ? "selected" : "");?> >Hodge</option>
										<option value='Station' <?php echo ($penurunan=="station" ? "selected" : "");?> >Station</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Posisi kepala</label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='posisi_kepala' value="<?php echo $posisi_kepala;?>"posisi_kepala>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Penyusupan</label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='penyusupan' value="<?php echo $penyusupan;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Ketuban </label>
								<div class="col-xs-10">
									<select name=ketuban2 class='form-control'>
										<option value='ruptur'>ruptur</option>
										<option value='utuh'>utuh</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Warna Cairan </label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='warna_cairan2' value="<?php echo $warna_cairan2;?>"warna_cairan2>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Pendarahan </label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='pendarahan2' value="<?php echo $pendarahan2;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Catatan :</label>
								<div class="col-xs-10">										
									<textarea name='catatan' class='form-control'></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">&nbsp;</label>
								<div class="col-xs-10">
									<div class="btn-group">
										<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"btn btn-warning simpan_obyektif"));?>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close();?>
            		</div>
            		<div id="tab3" class="tab-pane <?php echo ($tab=='3' ? 'active' : '');?>">
						<?php
							echo form_open("kia/simpan_assesment/".$action3,array("id"=>"form_simpan_assesment","class"=>"form-horizontal"));
							echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
							echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
						?>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-xs-2 control-label">Umur kehamilan</label>
								<div class="col-xs-2">
									<input type=text class='form-control' name='umur_kehamilan' value="<?php echo $umur_kehamilan2;?>">
								</div>
								<label class="col-xs-1 control-label">G</label>
								<div class="col-xs-1">
									<input type=text class='form-control' name='gravita' value="<?php echo $gravita2;?>"> 
								</div>
								<label class="col-xs-1 control-label">P</label>
								<div class="col-xs-2">
									<input type=text class='form-control' name='partus' value="<?php echo $partus2;?>"> 
								</div>
								<label class="col-xs-1 control-label">A</label>
								<div class="col-xs-2">
									<input type=text class='form-control' name='abortus' value="<?php echo $abortus2;?>"> 
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Kala</label>
								<div class="col-xs-10">
									<input type=text class='form-control' name='kala' value="<?php echo $kala;?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Status</label>
								<div class="col-xs-10">
									<select name=status class='form-control'>
										<option value='normal' <?php echo ($status=="normal" ? "selected" : "");?> >normal</option>
										<option value='abnormal1' <?php echo ($status=="abnormal1" ? "selected" : "");?> >Abnormal I</option>
										<option value='abnormal2' <?php echo ($status=="abnormal2" ? "selected" : "");?> >Abnormal II</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">Catatan :</label>
								<div class="col-xs-10">										
									<textarea name='catatan' class='form-control'><?php echo $catatan3;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-2 control-label">&nbsp;</label>
								<div class="col-xs-10">
									<div class="btn-group">
										<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"btn btn-warning simpan_assesment"));?>
									</div>
								</div>
							</div>
						</div>
            		</div>
				</div>
			</option>
		</div>
		<?php echo form_close();?>
	</div>
</div>