	<?php
    if ($row){
        $kode = $row->kode;
        $nama= $row->nama;
		$satuan= $row->pak1;
		$hpp= $row->hpp;
		$isi= $row->isi;
		$harga_beli= $row->hrg_beli;
		$harga_jual= $row->hrg_jual;
		$batch= $row->batch;
		$disc= $row->disc;
		$harga_satuan= $row->harga_satuan;
		$harga_gross= $row->harga_gross;
		$jumlah= $row->jumlah;
		$readonly="readonly";
        $action = "edit";
    } else {
        $kode =
        $nama =
        $satuan =
        $isi =
        $hpp =
        $harga_jual =
		$harga_beli = 
		$batch =
		$disc =
		$harga_satuan=
		$harga_gross=
		$jumlah=
        $readonly = "";
        $action = "simpan";
    }
    ?>

<script>
    $(document).ready(function(){
        $(".batal").click(function(){
            window.location = "<?php echo site_url('farmasi/master');?>";
            return false;
        });
        var formattgl = "yyyy-mm-dd";
        
        
    });
</script>
<?php
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
	<div class="col-xs-12">
		<div class="box box-primary">
			<?php echo form_open('farmasi/simpanobat/'.$action,array("id"=>"formsubmit"));?>
			<div class="box-body">
				<div class="form-horizontal">
			        <div class="form-group">
		            	<label class="col-md-2 control-label">Kode</label>
		            	<div class="col-md-4">
		            		<input type="text" name="kode" class="form-control" value="<?php echo $kode; ?>">
		                </div>
		                <label class="col-md-2 control-label">Nama</label>
		            	<div class="col-md-4">
		            		<input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-2 control-label">Satuan Besar</label>
		            	<div class="col-md-4">
		            		<select name='satuan' class="form-control" >
									<?php
										foreach ($q2->result() as $data){
											echo "<option value='".$data->satuan_besar."' ".(($satuan == $data->satuan_besar) ? "selected" : "").">".$data->satuan_besar."</option>";
										}
									?>
								</select>
		                </div>
		                <label class="col-md-2 control-label">Satuan Kecil</label>
		            	<div class="col-md-4">
		            		<select name='satuan' class="form-control" >
									<?php
										foreach ($q1->result() as $data){
											echo "<option value='".$data->satuan."' ".(($satuan == $data->satuan) ? "selected" : "").">".$data->satuan."</option>";
										}
									?>
								</select>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-2 control-label">Isi</label>
		            	<div class="col-md-4">
		            		<input type="text" name="isi" class="form-control" value="<?php echo $isi; ?>">
		                </div>
		                <label class="col-md-2 control-label">Harga beli</label>
		            	<div class="col-md-4">
		            		<input type="text" name="harga_beli" class="form-control" value="<?php echo $harga_beli; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-md-2 control-label">HPP</label>
		            	<div class="col-md-4">
		            		<input type="text" name="hpp" class="form-control" value="<?php echo $hpp; ?>">
		                </div>
		            	<label class="col-md-2 control-label">Harga Jual</label>
		            	<div class="col-md-4">
		            		<input type="text" name="harga_jual" class="form-control" value="<?php echo $harga_jual; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-md-2 control-label">Harga Satuan</label>
		            	<div class="col-md-4">
		            		<input type="text" name="harga_satuan" class="form-control" value="<?php echo $harga_satuan; ?>">
		                </div>
		            	<label class="col-md-2 control-label">Gross</label>
		            	<div class="col-md-4">
		            		<input type="text" name="harga_gross" class="form-control" value="<?php echo $harga_gross; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-md-2 control-label">Jumlah</label>
		            	<div class="col-md-4">
		            		<input type="text" name="jumlah" class="form-control" value="<?php echo $jumlah; ?>">
		                </div>
		            	<label class="col-md-2 control-label">Disc</label>
		            	<div class="col-md-4">
		            		<input type="text" name="disc" class="form-control" value="<?php echo $disc; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-md-2 control-label">Batch</label>
		            	<div class="col-md-4">
		            		<input type="text" name="batch" class="form-control" value="<?php echo $batch; ?>">
		                </div>
		            </div>
	            </div>
			</div>
			<div class="box-footer">
				<div class="pull-right">
	                <div class="btn-group">
	                   <button type="submit" class="simpan btn btn-primary btn-md" title="Add"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
	                   <button class="batal btn btn-warning btn-md" title="Batal"><i class="fa fa-undo"></i></button>
	                </div>
	            </div>
			</div>
			<?php echo form_close();?>
		</div>
	<div>
</div>