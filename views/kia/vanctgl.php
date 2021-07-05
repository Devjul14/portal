<?php
	if ($row){
		$id_antenatal_care = $row->id_antenatal_care;
		$tgl = date('d-m-Y',strtotime($row->tgl));
		$id_bumil = $row->id_bumil;
		$keluhan = $row->keluhan;
		$tekanan_darah = $row->tekanan_darah;
		$berat_badan = $row->berat_badan;
		$umur_kehamilan = $row->umur_kehamilan;
		$tinggi_fundus = $row->tinggi_fundus;
		$letak_janin = $row->letak_janin;
		$denyut_jantung_janin = $row->denyut_jantung_janin;
		$hb = $row->hb;
		$gol_darah = $row->gol_darah;
		$tindakan = $row->tindakan;
		$nama_tindakan = $row->nama_tindakan;
		$penyuluhan = $row->penyuluhan;
		$keterangan = $row->keterangan;
		$nadi = $row->nadi;
		$tgl_kunjungan = date('d-m-Y',strtotime($row->tgl_kunjungan));
	} else {
		$id_antenatal_care =
		$id_bumil = 
		$keluhan = 
		$tekanan_darah = 
		$berat_badan = 
		$umur_kehamilan = 
		$tinggi_fundus = 
		$letak_janin = 
		$denyut_jantung_janin = 
		$hb = 
		$gol_darah =
		$tindakan =
		$nama_tindakan =
		$penyuluhan = 
		$nadi = 
		$keterangan = "";
		$tgl = $tgl_kunjungan = date('d-m-Y');
	}
?>
<script>
$(document).ready(function(){
	var formattgl = "dd-mm-yy";
        $("input[name='tgl_kunjungan']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
			$("input[name='tgl']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
	$('input.nama_tindakan').typeahead({
		    source: function(query, process) {
		        objects = [];
		        map = {};
		        var data = <?php echo json_encode($q_tindakan); ?>// Or get your JSON dynamically and load it into this variable
		        $.each(data, function(i, object) {
		            map[object.label] = object;
		            objects.push(object.label);
		        });
		        process(objects);
		    },
		    updater: function(item) {
		        $("input.id_tindakan").val(map[item].id);
		        return map[item].label;
		    }
		});
});
</script>
<div class="box box-primary">
	<div class="box-header"><h5>Detail ANC</h5></div>
	<div class="box-body">
		<div class="form-horizontal">
		<?php echo form_open("kia/simpananc/edit",array("id"=>"formsave","class"=>"form-horizontal"));?>
		<input type="hidden" name="id_antenatal_care" value="<?php echo $id_antenatal_care;?>">
		<input type="hidden" name="id_bumil" value="<?php echo $id_bumil;?>">
		<input type="hidden" name="id_pendaftaran" value="<?php echo $id_pendaftaran;?>">
		<div class="form-group">
			<label class="col-xs-4 control-label">Tanggal Daftar</label>
			<div class="col-xs-8">
				<input type=text class='form-control' name='tgl'  <?php echo $disable;?> value='<?php echo $tgl;?>'>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Keluhan</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="keluhan" value='<?php echo $keluhan;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Tekanan Darah</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="tekanan_darah" value='<?php echo $tekanan_darah;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Berat Badan</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="berat_badan" value='<?php echo $berat_badan;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Umur Kehamilan</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="umur_kehamilan" value='<?php echo $umur_kehamilan;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Tinggi Fundus</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="tinggi_fundus" value='<?php echo $tinggi_fundus;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Letak Janin</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="letak_janin" value='<?php echo $letak_janin;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Denyut Jantung Janin</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="denyut_jantung" value='<?php echo $denyut_jantung_janin;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Nadi</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="nadi" value='<?php echo $nadi;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">HB</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="nb" value='<?php echo $hb;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Golongan Darah</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="gol_darah" value='<?php echo $gol_darah;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Tindakan</label>
			<div class="col-xs-8">
				<input type=hidden name='tindakan' class='id_tindakan' value='<?php echo $tindakan;?>'>
				<input type=text class='form-control' <?php echo $disable;?> name='nama_tindakan' value='<?php echo $nama_tindakan;?>' class='input-left nama_tindakan' autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Penyuluhan</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="penyuluhan" value='<?php echo $penyuluhan;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Keterangan</label>
			<div class="col-xs-8"><input type=text class='form-control' <?php echo $disable;?> name="keterangan" value='<?php echo $keterangan;?>'></div>
		</div>
		<div class="form-group">
			<label class="col-xs-4 control-label">Kunjungan Berikutnya</label>
			<div class="col-xs-8">
				<input type=text class='form-control' name='tgl_kunjungan'  <?php echo $disable;?> value='<?php echo $tgl_kunjungan;?>'>&nbsp;
			</div>
		</div>
		<?php 
		if ($disable==""){
			echo "
				<div class='control-group'>
					<label class='control-label'>&nbsp;</label>
					<div class='controls'>
						<button type='submit' class='edit btn'><i class='icon-edit'></i>&nbsp;Simpan</button>
					</div>
				</div>
			";
		}
		echo form_close();
		?>
	</div>
</div>