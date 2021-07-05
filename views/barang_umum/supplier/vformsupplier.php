	<?php
    if ($row){
        $kode_supplier 		= $row->kode_supplier;
        $nama_supplier		= $row->nama_supplier;
        $alamat_supplier	= $row->alamat_supplier;
        $kota_supplier		= $row->kota_supplier;
        $telepon_supplier	= $row->telepon_supplier;
        $bank_supplier		= $row->bank_supplier;
        $rekening_supplier	= $row->rekening_supplier;
		$readonly			= "readonly";
        $action 			= "edit";
    } else {
        $kode_supplier 		=
        $nama_supplier 		=
        $alamat_supplier	= 
        $kota_supplier		= 
        $telepon_supplier	= 
        $bank_supplier		= 
        $rekening_supplier	= 
        $readonly 			= "";
        $action 			= "simpan";
    }
    ?>

<script>
    $(document).ready(function(){
        $(".batal").click(function(){
            window.location = "<?php echo site_url('master_bu/supplier');?>";
            return false;
        });        
    });
</script>
<?php
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
	<div class="col-xs-12">
		<div class="box box-primary">
			<?php echo form_open('master_bu/simpansupplier/'.$action,array("id"=>"formsubmit"));?>
			<div class="box-body">
				<div class="form-horizontal">
			        <div class="form-group">
		            	<label class="col-md-12 control-label">Kode</label>
		            	<div class="col-md-12">
		            		<input type="text" name="kode_supplier" class="form-control" value="<?php echo $kode_supplier; ?>" <?php echo $readonly ?>>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Nama</label>
		            	<div class="col-md-12">
		            		<input type="text" name="nama_supplier" class="form-control" value="<?php echo $nama_supplier; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Alamat</label>
		            	<div class="col-md-12">
		            		<textarea name="alamat_supplier" class="form-control"><?php echo $alamat_supplier ?></textarea>
		                </div>
		            </div>
		          	<div class="form-group">
		          		<label class="col-md-12 control-label">Kota</label>
		            	<div class="col-md-12">
		            		<input type="text" name="kota_supplier" class="form-control" value="<?php echo $kota_supplier; ?>">
		                </div>
		          	</div>
		          	<div class="form-group">
		          		<label class="col-md-12 control-label">Telepon</label>
		            	<div class="col-md-12">
		            		<input type="text" name="telepon_supplier" class="form-control" value="<?php echo $telepon_supplier; ?>">
		                </div>
		          	</div>
		          	<div class="form-group">
		          		<label class="col-md-12 control-label">Bank</label>
		            	<div class="col-md-12">
		            		<input type="text" name="bank_supplier" class="form-control" value="<?php echo $bank_supplier; ?>">
		                </div>
		          	</div>
		          	<div class="form-group">
		          		<label class="col-md-12 control-label">Rekening</label>
		            	<div class="col-md-12">
		            		<input type="text" name="rekening_supplier" class="form-control" value="<?php echo $rekening_supplier; ?>">
		                </div>
		          	</div>
	            </div>
			</div>
			<div class="box-footer">
				<div class="pull-right">
	                <div class="btn-group">
	                   <button type="submit" class="btn btn-primary btn-md" title="Add"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
	                   <button class="batal btn btn-warning btn-md" title="Batal"><i class="fa fa-undo"></i></button>
	                </div>
	            </div>
			</div>
			<?php echo form_close();?>
		</div>
	<div>
</div>