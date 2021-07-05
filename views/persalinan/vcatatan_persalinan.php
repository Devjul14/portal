<?php 
if ($row1->num_rows()>0){
	$row = $row1->row();
	$catatan=$row->catatan;
	$alasan_merujuk=$row->alasan_merujuk;
	$pendamping=$row->pendamping;
	$masalah1=$row->masalah;
	$action1 = "edit";
} else {
	$catatan=
	$alasan_merujuk=
	$pendamping=
	$masalah1= "";
	$action1 = "simpan";
}

if ($row2->num_rows()>0){
	$row = $row2->row();
	$lewat_waspada=$row->lewat_waspada;
	$masalah_kala1=$row->masalah_kala1;
	$penatalaksanaan=$row->penatalaksanaan;
	$hasil_kala1=$row->hasil_kala1;
	$action2="edit";
} else {
	$lewat_waspada=
	$masalah_kala1=
	$penatalaksanaan=
	$hasil_kala1="";
	$action2="simpan";
}

if ($row3->num_rows()>0){
	$row = $row3->row();
	$episiotomi=$row->episiotomi;
	$pendamping2=$row->pendamping;
	$gawat_janin=$row->gawat_janin;
	$tindakan_kala21=$row->tindakan_kala21;
	$distosia=$row->distosia;
	$tindakan_kala22=$row->tindakan_kala22;
	$hasil_kala2=$row->hasil_kala2;
	$action3 = "edit";
} else {
	$episiotomi=
	$pendamping2=
	$gawat_janin=
	$tindakan_kala21=
	$distosia=
	$tindakan_kala22=
	$hasil_kala2="";
	$action3="simpan";
}

if ($row4->num_rows()>0){
	$row = $row4->row();
	$inisiasi=$row->inisiasi;
	$alasan_kala31=$row->alasan_kala31;
	$lama_kala3=$row->lama_kala3;
	$oksitosin=$row->oksitosin;
	$alasan_kala32=$row->alasan_kala32;
	$jepit_tali_pusat=$row->jepit_tali_pusat;
	$oksitosin2=$row->oksitosin2;
	$alasan_kala33=$row->alasan_kala33;
	$penegangan_tali_pusat=$row->penegangan_tali_pusat;
	$alasan_kala34=$row->alasan_kala34;
	$masase_fundus_uteri=$row->masase_fundus_uteri;
	$alasan_kala35=$row->alasan_kala35;
	$intact=$row->intact;
	$tindakan_kala31=$row->tindakan_kala31;
	$plasenta_lebih_30menit=$row->plasenta_lebih_30menit;
	$tindakan_kala32=$row->tindakan_kala32;
	$laserasi=$row->laserasi;
	$tindakan_kala33=$row->tindakan_kala33;
	$derajat_laserasi=$row->derajat_laserasi;
	$tindakan_kala34=$row->tindakan_kala34;
	$alasan_kala36=$row->alasan_kala36;
	$atoni_uteri=$row->atoni_uteri;
	$tindakan_kala35=$row->tindakan_kala35;
	$volume_darah_keluar=$row->volume_darah_keluar;
	$masalah_kala3=$row->masalah_kala3;
	$hasil_kala3=$row->hasil_kala3;
	$action4 = "edit";
} else {
	$inisiasi=
	$alasan_kala31=
	$lama_kala3=
	$oksitosin=
	$alasan_kala32=
	$jepit_tali_pusat=
	$oksitosin2=
	$alasan_kala33=
	$penegangan_tali_pusat=
	$alasan_kala34=
	$masase_fundus_uteri=
	$alasan_kala35=
	$intact=
	$tindakan_kala31=
	$plasenta_lebih_30menit=
	$tindakan_kala32=
	$laserasi=
	$tindakan_kala33=
	$derajat_laserasi=
	$tindakan_kala34=
	$alasan_kala36=
	$atoni_uteri=
	$tindakan_kala35=
	$volume_darah_keluar=
	$masalah_kala3=
	$hasil_kala3= "";
	$action4 = "simpan";
}

if($row5->num_rows()>0){
	$row = $row5->row();
	$kondisi_umum=$row->kondisi_umum;
	$tekanan_darah_kala4=$row->tekanan_darah_kala4;
	$nadi_kala4=$row->nadi_kala4;
	$napas_kala4=$row->napas_kala4;
	$masalah_kala4=$row->masalah_kala4;
	$action5="edit";
} else {
	$kondisi_umum=
	$tekanan_darah_kala4=
	$nadi_kala4=
	$napas_kala4=
	$masalah_kala4="";
	$action5="simpan";
}

if ($row6->num_rows()>0){
	$row = $row6->row();
	$nama_bayi=$row->nama_bayi;
	$keadaan_lahir=$row->keadaan_lahir;
	$resusitasi=$row->resusitasi;
	$berat_badan=$row->berat_badan;
	$panjang_badan=$row->panjang_badan;
	$jk=$row->jk;
	$nilai_bayi=$row->nilai_bayi;
	$bayi_lahir=$row->bayi_lahir;
	$tindakan_bayi=$row->tindakan_bayi;
	$tdk = explode(",", $tindakan_bayi);
	$pemberian_asi=$row->pemberian_asi;
	$alasan_asi=$row->alasan_asi;
	$masalah_asi=$row->masalah_asi;
	$action6 = "edit";
} else {
	$nama_bayi=
	$keadaan_lahir=
	$resusitasi=
	$berat_badan=
	$panjang_badan=
	$jk=
	$nilai_bayi="";
	$bayi_lahir="Normal";
	$tdk[0] = $tdk[1] = $tdk[2] = $tdk[3] = "";
	$tindakan_bayi=
	$pemberian_asi=
	$alasan_asi=
	$masalah_asi="";
	$action6 = "simpan";
}

if ($row7->num_rows()>0){
	$row = $row7->row();
	$buka_baju=$row->buka_baju;
	$keadaan_umum=$row->keadaan_umum;
	$timbang_bayi=$row->timbang_bayi;
	$ukur_lingkar_kepala=$row->ukur_lingkar_kepala;
	$periksa_kepala=$row->periksa_kepala;
	$periksa_anggota_tubuh=$row->periksa_anggota_tubuh;
	$periksa_dada=$row->periksa_dada;
	$periksa_pusar=$row->periksa_pusar;
	$periksa_genitalia=$row->periksa_genitalia;
	$periksa_anus=$row->periksa_anus;
	$periksa_tubuh_bawah=$row->periksa_tubuh_bawah;
	$periksa_tulang_punggung=$row->periksa_tulang_punggung;
	$action7 = "edit";
} else {
	$buka_baju=
	$keadaan_umum=
	$timbang_bayi=
	$ukur_lingkar_kepala=
	$periksa_kepala=
	$periksa_anggota_tubuh=
	$periksa_dada=
	$periksa_pusar=
	$periksa_genitalia=
	$periksa_anus=
	$periksa_tubuh_bawah=
	$periksa_tulang_punggung="";
	$action7= "simpan";
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
		var bayi_lahir = "<?php echo $bayi_lahir;?>";
		switch (bayi_lahir){
			case 'Normal' : $("#cacat").hide();$("#asfiksia").hide();$("#normal").show();break;
			case 'Asfiksia' : $("#cacat").hide();$("#asfiksia").show();$("#normal").hide();break;
			case 'Cacat Bawaan' : $("#cacat").show();$("#asfiksia").hide();$("#normal").hide();break;
			case 'Hipotermi' : $("#cacat").show();$("#asfiksia").hide();$("#normal").hide();break;
		}
		$(".form_simpan_rujukan_persalinan").click(function(){
			$("#form_simpan_rujukan_persalinan").trigger("submit");
			return false;
		});
		$(".form_simpan_kala1").click(function(){
			$("#form_simpan_kala1").trigger("submit");
			return false;
		});
		$(".form_simpan_kala2").click(function(){
			$("#form_simpan_kala2").trigger("submit");
			return false;
		});
		$(".form_simpan_kala3").click(function(){
			$("#form_simpan_kala3").trigger("submit");
			return false;
		});
		$(".form_simpan_kala4").click(function(){
			$("#form_simpan_kala4").trigger("submit");
			return false;
		});
		$(".form_simpan_bayi_baru").click(function(){
			$("#form_simpan_bayi_baru").trigger("submit");
			return false;
		});
		$(".form_simpan_pemeriksaan_bayi").click(function(){
			$("#form_simpan_pemeriksaan_bayi").trigger("submit");
			return false;
		});
		$(".bayi_lahir").click(function(){
		    var bayi_lahir = $(this).attr("data");
			switch (bayi_lahir){
				case 'Normal' : $("#cacat").hide();$("#asfiksia").hide();$("#normal").show();break;
				case 'Asfiksia' : $("#cacat").hide();$("#asfiksia").show();$("#normal").hide();break;
				case 'Cacat Bawaan' : $("#cacat").show();$("#asfiksia").hide();$("#normal").hide();break;
				case 'Hipotermi' : $("#cacat").show();$("#asfiksia").hide();$("#normal").hide();break;
			}
		});
		$('div[data-toggle="buttons-checkbox"] .btn').click(function(){
		    $('input[name="' + $(this).parent().attr('id') + '"]').val($(this).val());
		});
		$('div[id="tindakan_bayi_normal"] .btn').click(function(){
			$("input[name='tindakan_bayi']").val();
		    $('div[id="tindakan_bayi_asfiksia"] .btn').removeClass('active');
		});
		$('div[id="tindakan_bayi_asfiksia"] .btn').click(function(){
			$("input[name='tindakan_bayi']").val();
		    $('div[id="tindakan_bayi_normal"] .btn').removeClass('active');
		});
		$("#form_simpan_bayi_baru").submit(function(){
			status = status("bayi_lahir");
			switch (status){
				case 'Normal' : $("input[name='tindakan_bayi']").val(seleksi('tindakan_bayi_normal'));break;
				case 'Asfiksia' : $("input[name='tindakan_bayi']").val(seleksi('tindakan_bayi_asfiksia'));break;
			}
		});
    });
function seleksi(id){
	var selected="";
	var koma="";
	$('[name="'+id+'"]').each(function(){
		if (this.checked){
			selected += koma+$(this).val();
			koma = ",";
		}
	});
    return selected;
}
function status(id){
	var selected="";
	$('[name="'+id+'"]').each(function(){
		if (this.checked){
			selected = $(this).val();
		}
	});
    return selected;
}
</script>
	<div class="col-xs-12">
		<?php echo $this->session->flashdata('message');?>
		<div class="box box-primary">
			<div class="box-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-xs-3 col-xs-2">Asal Puskesmas</label>
						<div class="col-xs-10"><input type=text class='form-control' class="form-control" readonly value="<?php echo $p->nama_puskesmas;?>"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3 col-xs-2">No. Pasien</label>
						<div class="col-xs-10"><input type=text class='form-control' class="form-control" readonly value="<?php echo $p->no_pasien;?>"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3 col-xs-2">Nama Pasien</label>
						<div class="col-xs-10"><input type=text class='form-control' class="form-control" readonly value="<?php echo $p->nama_pasien;?>"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3 col-xs-2">Umur</label>
						<div class="col-xs-10">
							<div class="input-group">
								<input type=text class='form-control' class="form-control" readonly value="<?php echo $p->umur;?>">
								<span class='input-group-addon'>tahun</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
				<li class="<?php echo ($tab=='1' ? 'active' : '');?>"><a data-toggle="tab" href="#tab1">Catatan Awal</a></li>
				<li class="<?php echo ($tab=='2' ? 'active' : '');?>"><a data-toggle="tab" href="#tab2">Kala I</a></li>
				<li class="<?php echo ($tab=='3' ? 'active' : '');?>"><a data-toggle="tab" href="#tab3">Kala II</a></li>
				<li class="<?php echo ($tab=='4' ? 'active' : '');?>"><a data-toggle="tab" href="#tab4">Kala III</a></li>
				<li class="<?php echo ($tab=='5' ? 'active' : '');?>"><a data-toggle="tab" href="#tab5">Kala IV</a></li>
				<li class="<?php echo ($tab=='6' ? 'active' : '');?>"><a data-toggle="tab" href="#tab6">Bayi Baru</a></li>
				<li class="<?php echo ($tab=='7' ? 'active' : '');?>"><a data-toggle="tab" href="#tab7">Pemeriksaan Bayi</a></li>
            </ul>
        	<div class="tab-content">
            	<div id="tab1" class="tab-pane <?php echo ($tab=='1' ? 'active' : '');?>">
					<?php
						echo form_open("persalinan/simpan_rujukan_persalinan/".$action1,array("id"=>"form_simpan_rujukan_persalinan","class"=>"form-horizontal"));
						echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Catatan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='catatan' value="<?php echo $catatan;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Alasan Merujuk</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_merujuk' value="<?php echo $alasan_merujuk;?>"> 
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Pendamping pada saat merujuk</label>
							<div class="col-xs-9">
								<select class='form-control' name="pendamping">
									<option value="Bidan" <?php echo ($pendamping=="Bidan" ? "selected" : "");?> >Bidan</optiom>
									<option value="Dukun" <?php echo ($pendamping=="Dukun" ? "selected" : "");?> >Dukun</optiom>
									<option value="Teman" <?php echo ($pendamping=="Teman" ? "selected" : "");?> >Teman</optiom>
									<option value="Keluarga" <?php echo ($pendamping=="Keluarga" ? "selected" : "");?> >Keluarga</optiom>
									<option value="Suami" <?php echo ($pendamping=="Suami" ? "selected" : "");?> >Suami</optiom>
									<option value="Tidak ada" <?php echo ($pendamping=="Tidak ada" ? "selected" : "");?> >Tidak ada</optiom>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Masalah dalam kehamilan/ persalinan ini</label>
							<div class="col-xs-9">
								<select class='form-control' name="masalah1">
									<option value="Gawat Darurat" <?php echo ($masalah1=="Gawat Darurat" ? "selected" : "");?> >Gawat Darurat</optiom>
									<option value="Infeksi" <?php echo ($masalah1=="Infeksi" ? "selected" : "");?> >Infeksi</optiom>
									<option value="Pendarahan" <?php echo ($masalah1=="Pendarahan" ? "selected" : "");?> >Pendarahan</optiom>
									<option value="PMCTC" <?php echo ($masalah1=="PMCTC" ? "selected" : "");?> >PMCTC</optiom>
									<option value="HDK" <?php echo ($masalah1=="HDK" ? "selected" : "");?> >HDK</optiom>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">&nbsp;</label>
							<div class="col-xs-9">
								<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"form_simpan_rujukan_persalinan btn btn-success"));?>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<div id="tab2" class="tab-pane <?php echo ($tab=='2' ? 'active' : '');?>">
					<?php
						echo form_open("persalinan/simpan_kala1/".$action2,array("id"=>"form_simpan_kala1","class"=>"form-horizontal"));
						echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Partogram melewati garis waspada</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($lewat_waspada=="Y" ? "active" : "");?>">
    									<input type="radio" name="lewat_waspada" id="lewat_waspada" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($lewat_waspada=="N" ? "active" : "");?>">
    									<input type="radio" name="lewat_waspada" id="lewat_waspada" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Masalah lain</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='masalah_kala1' value="<?php echo $masalah_kala1;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Penatalaksanaan masalah</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='penatalaksanaan' value="<?php echo $penatalaksanaan;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Hasil</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='hasil_kala1' value="<?php echo $hasil_kala1;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">&nbsp;</label>
							<div class="col-xs-9">
								<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"form_simpan_kala1 btn btn-success"));?>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<div id="tab3" class="tab-pane <?php echo ($tab=='3' ? 'active' : '');?>">
					<?php
						echo form_open("persalinan/simpan_kala2/".$action3,array("id"=>"form_simpan_kala2","class"=>"form-horizontal"));
						echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Episiotomi</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($episiotomi=="Y" ? "active" : "");?>">
    									<input type="radio" name="episiotomi" id="episiotomi" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($episiotomi=="N" ? "active" : "");?>">
    									<input type="radio" name="episiotomi" id="episiotomi" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Pendamping pada saat persalinan</label>
							<div class="col-xs-9">
								<select class='form-control' name="pendamping2">
									<option value="Bidan" <?php echo ($pendamping2=="Bidan" ? "selected" : "");?> >Bidan</optiom>
									<option value="Dukun" <?php echo ($pendamping2=="Dukun" ? "selected" : "");?> >Dukun</optiom>
									<option value="Teman" <?php echo ($pendamping2=="Teman" ? "selected" : "");?> >Teman</optiom>
									<option value="Keluarga" <?php echo ($pendamping2=="Keluarga" ? "selected" : "");?> >Keluarga</optiom>
									<option value="Suami" <?php echo ($pendamping2=="Suami" ? "selected" : "");?> >Suami</optiom>
									<option value="Tidak ada" <?php echo ($pendamping2=="Tidak ada" ? "selected" : "");?> >Tidak ada</optiom>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Gawat Janin</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($gawat_janin=="Y" ? "active" : "");?>">
    									<input type="radio" name="gawat_janin" id="gawat_janin" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($gawat_janin=="N" ? "active" : "");?>">
    									<input type="radio" name="gawat_janin" id="gawat_janin" value="N" autocomplete="off"> Tidak
  									</label>
  									<label class="btn btn-default <?php echo ($gawat_janin=="Pemantauan DJJ" ? "active" : "");?>">
    									<input type="radio" name="gawat_janin" id="gawat_janin" value="N" autocomplete="off"> Pemantauan DJJ
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tindakan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='tindakan_kala21' value="<?php echo $tindakan_kala21;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Distosia bahu</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($distosia=="Y" ? "active" : "");?>">
    									<input type="radio" name="distosia" id="distosia" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($distosia=="N" ? "active" : "");?>">
    									<input type="radio" name="distosia" id="distosia" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tindakan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='tindakan_kala22' value="<?php echo $tindakan_kala22;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Masalah lain. Penatalaksaan masalah tsb dan hasilnya</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='hasil_kala2' value="<?php echo $hasil_kala2;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">&nbsp;</label>
							<div class="col-xs-9">
								<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"form_simpan_kala2 btn btn-success"));?>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<div id="tab4" class="tab-pane <?php echo ($tab=='4' ? 'active' : '');?>">
					<?php
						echo form_open("persalinan/simpan_kala3/".$action4,array("id"=>"form_simpan_kala3","class"=>"form-horizontal"));
						echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Inisiasi Menyusui dini</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($inisiasi=="Y" ? "active" : "");?>">
    									<input type="radio" name="inisiasi" id="inisiasi" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($inisiasi=="N" ? "active" : "");?>">
    									<input type="radio" name="inisiasi" id="inisiasi" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Alasannya</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_kala31' value="<?php echo $alasan_kala31;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">lama Kala III</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='lama_kala3' value="<?php echo $lama_kala3;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Pemberian Oksitosin 10 U im ?</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($oksitosin=="Y" ? "active" : "");?>">
    									<input type="radio" name="oksitosin" id="oksitosin" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($oksitosin=="N" ? "active" : "");?>">
    									<input type="radio" name="oksitosin" id="oksitosin" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Keterangan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_kala32' value="<?php echo $alasan_kala32;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Penjepit tali pusat</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='jepit_tali_pusat' value="<?php echo $jepit_tali_pusat;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Pemberian ulang Oksitosin (2x) ?</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($oksitosin2=="Y" ? "active" : "");?>">
    									<input type="radio" name="oksitosin2" id="oksitosin2" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($oksitosin2=="N" ? "active" : "");?>">
    									<input type="radio" name="oksitosin2" id="oksitosin2" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Penegangan tali pusat terkendali ?</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($penegangan_tali_pusat=="Y" ? "active" : "");?>">
    									<input type="radio" name="penegangan_tali_pusat" id="penegangan_tali_pusat" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($penegangan_tali_pusat=="N" ? "active" : "");?>">
    									<input type="radio" name="penegangan_tali_pusat" id="penegangan_tali_pusat" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Alasan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_kala34' value="<?php echo $alasan_kala34;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Masase Fundus uteri ?</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($masase_fundus_uteri=="Y" ? "active" : "");?>">
    									<input type="radio" name="masase_fundus_uteri" id="masase_fundus_uteri" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($masase_fundus_uteri=="N" ? "active" : "");?>">
    									<input type="radio" name="masase_fundus_uteri" id="masase_fundus_uteri" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Alasan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_kala35' value="<?php echo $alasan_kala35;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Plasenta lahir lengkap (intact) ?</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($intact=="Y" ? "active" : "");?>">
    									<input type="radio" name="intact" id="intact" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($intact=="N" ? "active" : "");?>">
    									<input type="radio" name="intact" id="intact" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tindakan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='tindakan_kala31' value="<?php echo $tindakan_kala31;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Plasenta tidak lahir > 30 menit ?</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($plasenta_lebih_30menit=="Y" ? "active" : "");?>">
    									<input type="radio" name="plasenta_lebih_30menit" id="plasenta_lebih_30menit" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($plasenta_lebih_30menit=="N" ? "active" : "");?>">
    									<input type="radio" name="plasenta_lebih_30menit" id="plasenta_lebih_30menit" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tindakan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='tindakan_kala32' value="<?php echo $tindakan_kala32;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Laserasi</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($laserasi=="Y" ? "active" : "");?>">
    									<input type="radio" name="laserasi" id="laserasi" value="Y" autocomplete="off"> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($laserasi=="N" ? "active" : "");?>">
    									<input type="radio" name="laserasi" id="laserasi" value="N" autocomplete="off"> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tindakan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='tindakan_kala33' value="<?php echo $tindakan_kala33;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jika Laserasi Perineum, derajat</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($derajat_laserasi=="1" ? "active" : "");?>">
    									<input type="radio" name="derajat_laserasi" id="derajat_laserasi" value="1" autocomplete="off"> 1
  									</label>
  									<label class="btn btn-default <?php echo ($derajat_laserasi=="2" ? "active" : "");?>">
    									<input type="radio" name="derajat_laserasi" id="derajat_laserasi" value="2" autocomplete="off"> 2
  									</label>
  									<label class="btn btn-default <?php echo ($derajat_laserasi=="3" ? "active" : "");?>">
    									<input type="radio" name="derajat_laserasi" id="derajat_laserasi" value="4" autocomplete="off"> 3
  									</label>
  									<label class="btn btn-default <?php echo ($derajat_laserasi=="4" ? "active" : "");?>">
    									<input type="radio" name="derajat_laserasi" id="derajat_laserasi" value="4" autocomplete="off"> 4
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jika Laserasi Perineum</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($tindakan_kala34=="Y" ? "active" : "");?>">
    									<input type="radio" name="tindakan_kala34" id="tindakan_kala34" value="Penjahitan" autocomplete="off"> Penjahitan
  									</label>
  									<label class="btn btn-default <?php echo ($tindakan_kala34=="N" ? "active" : "");?>">
    									<input type="radio" name="tindakan_kala34" id="tindakan_kala34" value="Tidak dijahit" autocomplete="off"> Tidak dijahit
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Alasan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_kala36' value="<?php echo $alasan_kala36;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Atoni uteri</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($atoni_uteri=="Y" ? "active" : "");?>">
    									<input type="radio" name="atoni_uteri" id="atoni_uteri" value="Penjahitan" autocomplete="off"> Penjahitan
  									</label>
  									<label class="btn btn-default <?php echo ($atoni_uteri=="N" ? "active" : "");?>">
    									<input type="radio" name="atoni_uteri" id="atoni_uteri" value="Tidak dijahit" autocomplete="off"> Tidak dijahit
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Alasan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_kala35' value="<?php echo $alasan_kala35;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jumlah darah yang keluar/ pendarahan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='volume_darah_keluar' value="<?php echo $volume_darah_keluar;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Masalah dan penatalaksanaan masalah tersebut</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='masalah_kala3' value="<?php echo $masalah_kala3;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Hasilnya</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='hasil_kala3' value="<?php echo $hasil_kala3;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">&nbsp;</label>
							<div class="col-xs-9">
								<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"form_simpan_kala3 btn btn-success"));?>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<div id="tab5" class="tab-pane <?php echo ($tab=='5' ? 'active' : '');?>">
					<?php
						echo form_open("persalinan/simpan_kala4/".$action5,array("id"=>"form_simpan_kala4","class"=>"form-horizontal"));
						echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Kondisi Umum</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='kondisi_umum' value="<?php echo $kondisi_umum;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tekanan Darah</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='tekanan_darah_kala4' value="<?php echo $tekanan_darah_kala4;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Nadi</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='nadi_kala4' value="<?php echo $nadi_kala4;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Masalah dan penatalaksanaan masalah tersebut</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='masalah_kala4' value="<?php echo $masalah_kala4;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">&nbsp;</label>
							<div class="col-xs-9">
								<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"form_simpan_kala4 btn btn-success"));?>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<div id="tab6" class="tab-pane <?php echo ($tab=='6' ? 'active' : '');?>">
					<?php
						echo form_open("persalinan/simpan_bayi_baru/".$action6,array("id"=>"form_simpan_bayi_baru","class"=>"form-horizontal"));
						echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Berat Badan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='berat_badan' value="<?php echo $berat_badan;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Panjang Badan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='panjang_badan' value="<?php echo $panjang_badan;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jenis Kelamin</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($jk=="L" ? "active" : "");?>">
    									<input type="radio" name="jk" id="jk" value="L" autocomplete="off" <?php echo ($jk=="L" ? "checked" : "");?>> Laki-laki
  									</label>
  									<label class="btn btn-default <?php echo ($jk=="P" ? "active" : "");?>">
    									<input type="radio" name="jk" id="jk" value="P" autocomplete="off" <?php echo ($jk=="P" ? "checked" : "");?>> Perempuan
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Penilaian bayi baru lahir</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($nilai_bayi=="baik" ? "active" : "");?>">
    									<input type="radio" name="nilai_bayi" id="nilai_bayi" value="baik" autocomplete="off" <?php echo ($nilai_bayi=="baik" ? "checked" : "");?>> Baik
  									</label>
  									<label class="btn btn-default <?php echo ($nilai_bayi=="ada penyulit" ? "active" : "");?>">
    									<input type="radio" name="nilai_bayi" id="nilai_bayi" value="ada penyulit" autocomplete="off" <?php echo ($nilai_bayi=="ada penyulit" ? "checked" : "");?>> Ada Penyulit
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Bayi Lahir</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label data="Normal" class="bayi_lahir btn btn-default <?php echo ($bayi_lahir=="Normal" ? "active" : "");?>">
    									<input type="radio" name="bayi_lahir" id="bayi_lahir" value="Normal" autocomplete="off" <?php echo ($bayi_lahir=="Normal" ? "checked" : "");?>> Normal
  									</label>
  									<label data="Asfiksia" class="bayi_lahir btn btn-default <?php echo ($bayi_lahir=="Asfiksia" ? "active" : "");?>">
    									<input type="radio" name="bayi_lahir" id="bayi_lahir" value="Asfiksia" autocomplete="off" <?php echo ($bayi_lahir=="Asfiksia" ? "checked" : "");?>> Asfiksia
  									</label>
  									<label data="Cacat Bawaan" class="bayi_lahir btn btn-default <?php echo ($bayi_lahir=="Cacat Bawaan" ? "active" : "");?>">
    									<input type="radio" name="bayi_lahir" id="bayi_lahir" value="Cacat Bawaan" autocomplete="off" <?php echo ($bayi_lahir=="Cacat Bawaan" ? "checked" : "");?>> Cacat Bawaan
  									</label>
  									<label data="Hipotermi" class="bayi_lahir btn btn-default <?php echo ($bayi_lahir=="Hipotermi" ? "active" : "");?>">
    									<input type="radio" name="bayi_lahir" id="bayi_lahir" value="Hipotermi" autocomplete="off" <?php echo ($bayi_lahir=="Hipotermi" ? "checked" : "");?>> Hipotermi
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tindakan</label>
							<div class="col-xs-9">
								<div class="col-xs-12">
									<span id=normal>
										<div class="form-group">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Mengeringkan")!==false ? "active" : "");?>">
   													<input type="checkbox" name="tindakan_bayi_normal" autocomplete="off" value="Mengeringkan" <?php echo (strpos($tindakan_bayi,"Mengeringkan")!==false ? "checked" : "");?>> Mengeringkan
  												</label>
  												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Menghangatkan")!==false ? "active" : "");?>">
    												<input type="checkbox" name="tindakan_bayi_normal" autocomplete="off" value="Menghangatkan" <?php echo (strpos($tindakan_bayi,"Menghangatkan")!==false ? "checked" : "");?>> Menghangatkan
  												</label>
  												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Rangsangan Taktil")!==false ? "active" : "");?>">
    												<input type="checkbox" name="tindakan_bayi_normal" autocomplete="off" value="Rangsangan Taktil" <?php echo (strpos($tindakan_bayi,"Rangsangan Taktil")!==false ? "checked" : "");?>> Rangsangan Taktil
  												</label>
  												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Memastikan ImD")!==false ? "active" : "");?>">
    												<input type="checkbox" name="tindakan_bayi_normal" autocomplete="off" value="Memastikan ImD" <?php echo (strpos($tindakan_bayi,"Memastikan ImD")!==false ? "checked" : "");?>> Memastikan ImD
  												</label>
  											</div>
  										</div>
									</span>
									<span id=asfiksia>
										<div class="form-group">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Mengeringkan")!==false ? "active" : "");?>">
   													<input type="checkbox" name="tindakan_bayi_asfiksia" autocomplete="off" value="Mengeringkan"> Mengeringkan
  												</label>
  												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Rangsang Taktil")!==false ? "active" : "");?>">
    												<input type="checkbox" name="tindakan_bayi_asfiksia" autocomplete="off" value="Rangsang Taktil"> Rangsang Taktil
  												</label>
  												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Pakaian/ Selimut bayi dan tempatkan disisi ibu")!==false ? "active" : "");?>">
    												<input type="checkbox" name="tindakan_bayi_asfiksia" autocomplete="off" value="Pakaian/ Selimut bayi dan tempatkan disisi ibu"> Pakaian/ Selimut bayi dan tempatkan disisi ibu
  												</label>
  												<label class="btn btn-default <?php echo (strpos($tindakan_bayi,"Menghangatkan")!==false ? "active" : "");?>">
    												<input type="checkbox" name="tindakan_bayi_asfiksia" autocomplete="off" value="Menghangatkan"> Menghangatkan
  												</label>
											</div>
										</div>
									</span>
								</div>
								<span id=cacat>
									<input type=text class='form-control' name='tindakan_bayi' value="<?php echo $tindakan_bayi;?>">
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Pemberian Asi setelah jam pertama bayi lahir</label>
							<div class="col-xs-9">
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default <?php echo ($pemberian_asi=="Y" ? "active" : "");?>">
    									<input type="radio" name="pemberian_asi" id="pemberian_asi" value="Y" autocomplete="off" <?php echo ($pemberian_asi=="Y" ? "checked" : "");?>> Ya
  									</label>
  									<label class="btn btn-default <?php echo ($pemberian_asi=="N" ? "active" : "");?>">
    									<input type="radio" name="pemberian_asi" id="pemberian_asi" value="N" autocomplete="off" <?php echo ($pemberian_asi=="N" ? "checked" : "");?>> Tidak
  									</label>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Alasan</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='alasan_asi' value="<?php echo $alasan_asi;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Masalah lain</label>
							<div class="col-xs-9">
								<input type=text class='form-control' name='masalah_asi' value="<?php echo $masalah_asi;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">&nbsp;</label>
							<div class="col-xs-9">
								<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"form_simpan_bayi_baru btn btn-success"));?>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
				<div id="tab7" class="tab-pane <?php echo ($tab=='7' ? 'active' : '');?>">
					<?php
						echo form_open("persalinan/simpan_pemeriksaan_bayi/".$action7,array("id"=>"form_simpan_pemeriksaan_bayi","class"=>"form-horizontal"));
						echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Buka Baju Bayi</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($buka_baju=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="buka_baju" autocomplete="off" value="Y" <?php echo ($buka_baju=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Cek keadaan umum bayi</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($keadaan_umum=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="keadaan_umum" autocomplete="off" value="Y" <?php echo ($keadaan_umum=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Timbang Bayi</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($timbang_bayi=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="timbang_bayi" autocomplete="off" value="Y" <?php echo ($timbang_bayi=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Ukur lingkar kepala</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($ukur_lingkar_kepala=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="ukur_lingkar_kepala" autocomplete="off" value="Y" <?php echo ($ukur_lingkar_kepala=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Periksa kepala</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_kepala=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_kepala" autocomplete="off" value="Y" <?php echo ($periksa_kepala=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Periksa Anggota Tubuh</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_anggota_tubuh=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_anggota_tubuh" autocomplete="off" value="Y" <?php echo ($periksa_anggota_tubuh=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Periksa Dada</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_dada=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_dada" autocomplete="off" value="Y" <?php echo ($periksa_dada=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Periksa pusar</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_pusar=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_pusar" autocomplete="off" value="Y" <?php echo ($periksa_pusar=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Periksa Genitalia</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_genitalia=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_genitalia" autocomplete="off" value="Y" <?php echo ($periksa_genitalia=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Cek apakah anus berfungsi baik</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_anus=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_anus" autocomplete="off" value="Y" <?php echo ($periksa_anus=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Periksa anggota tubuh bagian bawah</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_tubuh_bawah=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_tubuh_bawah" autocomplete="off" value="Y" <?php echo ($periksa_tubuh_bawah=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Periksa tulang punggung</label>
							<div class="col-xs-9">
								<div class="form-group">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php echo ($periksa_tulang_punggung=="Y" ? "active" : "");?>">
   											<input type="checkbox" name="periksa_tulang_punggung" autocomplete="off" value="Y" <?php echo ($periksa_tulang_punggung=="Y" ? "checked" : "");?>> Ya
  										</label>
  									</div>
  								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">&nbsp;</label>
							<div class="col-xs-9">
								<?php echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"form_simpan_pemeriksaan_bayi btn btn-success"));?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>