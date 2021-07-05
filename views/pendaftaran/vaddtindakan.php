<?php
	if ($row) {
		$id = $row->id_tindakan;
		$nama_tindakan = $row->nama_tindakan;
		$karcis = $row->karcis;
		$action = "edit";
	} else {
		$tanggal = date("d-m-Y"); 
		$id =
		$nama_tindakan =
		$karcis = 
		$golongan = "";
		$action = "simpan";
	}
?>
<?php echo $this->session->flashdata('message');?>
<?php
	echo form_open("pendaftaran/simpantindakan/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
	echo "<input type=hidden name='idlama' value='".$id."'>";
?>
<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
  			<div class="form-group">
  				<label class="col-xs-2 control-label">Nama Tindakan</label>
        	    <div class="col-xs-10"><input type="text" class="form-control" name="nama_tindakan" value="<?php echo $nama_tindakan;?>"></div>
  			</div>
  			<div class="form-group">
  				<label class="col-xs-2 control-label">Jumlah</label>
				<div class="col-xs-10"><input type="text" class="form-control" name="karcis" value="<?php echo $karcis;?>"></div>
			</div>
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<div class="btn-group">
					<button class="add btn btn-primary" type="submit" ><i class="fa fa-save"></i> Save</button>
				</div>
			</div>
		</div>
  	</div>
</div>
<?php echo form_close();?>
