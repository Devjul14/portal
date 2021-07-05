	<?php
    if ($row){
        $kode_industri 		= $row->kode_industri;
        $nama_industri		= $row->nama_industri;
        $alamat_industri	= $row->alamat_industri;
        $kota_industri		= $row->kota_industri;
        $telepon_industri	= $row->telepon_industri;
		$readonly			= "readonly";
        $action 			= "edit";
    } else {
        $kode_industri 		=
        $nama_industri 		=
        $alamat_industri	= 
        $kota_industri		= 
        $telepon_industri	= 
        $readonly 			= "";
        $action 			= "simpan";
    }
    ?>

<script>
    $(document).ready(function(){
        $(".batal").click(function(){
            window.location = "<?php echo site_url('farmasi/industri');?>";
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
			<?php echo form_open('farmasi/simpanindustri/'.$action,array("id"=>"formsubmit"));?>
			<div class="box-body">
				<div class="form-horizontal">
			        <div class="form-group">
		            	<label class="col-md-12 control-label">Kode</label>
		            	<div class="col-md-12">
		            		<input type="text" name="kode_industri" class="form-control" value="<?php echo $kode_industri; ?>" <?php echo $readonly ?>>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Nama</label>
		            	<div class="col-md-12">
		            		<input type="text" name="nama_industri" class="form-control" value="<?php echo $nama_industri; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Alamat</label>
		            	<div class="col-md-12">
		            		<textarea name="alamat_industri" class="form-control"><?php echo $alamat_industri ?></textarea>
		                </div>
		            </div>
		          	<div class="form-group">
		          		<label class="col-md-12 control-label">Kota</label>
		            	<div class="col-md-12">
		            		<input type="text" name="kota_industri" class="form-control" value="<?php echo $kota_industri; ?>">
		                </div>
		          	</div>
		          	<div class="form-group">
		          		<label class="col-md-12 control-label">Telepon</label>
		            	<div class="col-md-12">
		            		<input type="text" name="telepon_industri" class="form-control" value="<?php echo $telepon_industri; ?>">
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