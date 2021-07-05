	<?php
    if ($row){
        $kode_bu 			= $row->kode_bu;
        $nama_bu			= $row->nama_bu;
        $merk				= $row->merk;
        $kategori_bu		= $row->kategori_bu;
        $satuan_besar		= $row->satuan_besar;
        $satuan_kecil		= $row->satuan_kecil;
        $stok_awal			= $row->stok_awal;
        $stok				= $row->stok;
        $harga_kecil		= $row->harga_kecil;
        $harga_besar		= $row->harga_besar;
        $harga_beli			= $row->harga_beli;
        $isi				= $row->isi;
		$readonly			= "readonly";
        $action 			= "edit";
    } else {
        $kode_bu 			=
        $nama_bu 			=
        $merk 				= 
        $kategori_bu		= 
        $satuan_besar		= 
        $satuan_kecil		= 
        $stok_awal			= 
        $stok				= 
        $harga_kecil		= 
        $harga_besar		= 
        $harga_beli			= 
        $isi				=
        $readonly 			= "";
        $action 			= "simpan";
    }
    ?>

<script>
    $(document).ready(function(){
        $(".batal").click(function(){
            window.location = "<?php echo site_url('master_bu/barang_umum');?>";
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
			<?php echo form_open('master_bu/simpanbarang_umum/'.$action,array("id"=>"formsubmit"));?>
			<div class="box-body">
				<div class="form-horizontal">
			        <div class="form-group">
		            	<label class="col-md-12 control-label">Kode</label>
		            	<div class="col-md-12">
		            		<input type="text" name="kode_bu" class="form-control" value="<?php echo $kode_bu; ?>" <?php echo $readonly ?>>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Nama</label>
		            	<div class="col-md-12">
		            		<input type="text" name="nama_bu" class="form-control" value="<?php echo $nama_bu; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Merk</label>
		            	<div class="col-md-12">
		            		<input type="text" name="merk" class="form-control" value="<?php echo $merk; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Kategori</label>
		            	<div class="col-md-12">
		            		<select class="form-control" name="kategori_bu">
		            			<option>---</option>
		            			<?php
		            				foreach ($k->result() as $kat) {
		            					echo "<option value='".$kat->kode_kategori."' ".($kat->kode_kategori==$kategori_bu ? "selected" : "").">".$kat->nama_kategori."</option>";
		            				}
		            			?>
		            		</select>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Satuan Besar</label>
		            	<div class="col-md-12">
		            		<select class="form-control" name="satuan_besar">
		            			<option>---</option>
		            			<?php
		            				foreach ($sb->result() as $sab) {
		            					echo "<option value='".$sab->kode_satuan."' ".($sab->kode_satuan==$satuan_besar ? "selected" : "").">".$sab->nama_satuan."</option>";
		            				}
		            			?>
		            		</select>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Satuan Kecil</label>
		            	<div class="col-md-12">
		            		<select class="form-control" name="satuan_kecil">
		            			<option>---</option>
		            			<?php
		            				foreach ($sk->result() as $sak) {
		            					echo "<option value='".$sak->kode_satuan."' ".($sak->kode_satuan==$satuan_kecil ? "selected" : "").">".$sak->nama_satuan."</option>";
		            				}
		            			?>
		            		</select>
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Stok Awal</label>
		            	<div class="col-md-12">
		            		<input type="number" name="stok_awal" class="form-control" value="<?php echo $stok_awal; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Stok</label>
		            	<div class="col-md-12">
		            		<input type="number" name="stok" class="form-control" value="<?php echo $stok; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Isi</label>
		            	<div class="col-md-12">
		            		<input type="number" name="isi" class="form-control" value="<?php echo $isi; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Harga Satuan Kecil</label>
		            	<div class="col-md-12">
		            		<input type="number" name="harga_kecil" class="form-control" value="<?php echo $harga_kecil; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Harga Satuan Besar</label>
		            	<div class="col-md-12">
		            		<input type="number" name="harga_besar" class="form-control" value="<?php echo $harga_besar; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		            	<label class="col-md-12 control-label">Harga Beli</label>
		            	<div class="col-md-12">
		            		<input type="number" name="harga_beli" class="form-control" value="<?php echo $harga_beli; ?>">
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