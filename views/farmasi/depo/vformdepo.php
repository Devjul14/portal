	<?php
    if ($row){
        $kode_depo 		= $row->kode_depo;
        $nama_depo		= $row->nama_depo;
		$readonly			= "readonly";
        $action 			= "edit";
    } else {
        $kode_depo 		=
        $nama_depo 		=
        $readonly 			= "";
        $action 			= "simpan";
    }
    ?>

<script>
    $(document).ready(function(){
        $(".batal").click(function(){
            window.location = "<?php echo site_url('farmasi/depo');?>";
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
			<?php echo form_open('farmasi/simpandepo/'.$action,array("id"=>"formsubmit"));?>
			<div class="box-body">
				<div class="form-horizontal">
			        <div class="form-group">
		            	<label class="col-md-12 control-label">Kode</label>
		            	<div class="col-md-12">
		            		<input type="text" name="kode_depo" class="form-control" value="<?php echo $kode_depo; ?>" <?php echo $readonly ?>>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Nama</label>
		            	<div class="col-md-12">
		            		<input type="text" name="nama_depo" class="form-control" value="<?php echo $nama_depo; ?>">
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