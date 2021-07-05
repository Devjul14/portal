<?php
    if ($row){
        $kode 					= $row->kode;
        $nama					= $row->nama;
        $satuan_besar			= $row->pak1;
        $satuan_kecil			= $row->pak2;
        $kode_jenis				= $row->kelkd;
        $kode_klasifikasi		= $row->pabkd;
        $kode_kategori			= $row->katkd;
        $kode_golongan			= $row->golkd;
        $isi					= $row->isi;
        $kode_simak				= $row->kode_simak;
        // $harga_beli				= $row->hrg_beli;
        // $harga_jual				= $row->hrg_jual;
		$readonly				= "readonly";
        $action 				= "edit";
    } else {
    	$kode 					= $kd_obat;
    	$kode_simak				=
        $nama					= 
        $satuan_besar			= 
        $satuan_kecil			= 
        $kode_jenis				= 
        $kode_kategori			= 
        $kode_golongan			=
        $kode_klasifikasi		= 
        $isi					= 
        // $harga_beli				= 
        // $harga_jual				= 
        $readonly 				= "";
        $action 				= "simpan";
    }
?>

<script>
    $(document).ready(function(){
        $(".batal").click(function(){
            window.location = "<?php echo site_url('farmasi/masterobat');?>";
            return false;
        });
        var formattgl = "yy-mm-dd";
        $("input[name='tanggal_kadaluwarsa']").datepicker({
            dateFormat : formattgl,
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
			<?php echo form_open('farmasi/simpanmaster_obat/'.$action,array("id"=>"formsubmit"));?>
			<div class="box-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2">
							Kode
						</label>
						<div class="col-md-4">
							<input type="text"  class='form-control' name="kode" value="<?php echo $kode ?>" readonly>
						</div>
						<label class="col-md-2">
							Nama
						</label>
						<div class="col-md-4">
							<input type="text"  class='form-control' name="nama" value="<?php echo $nama ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2">
							Satuan Besar
						</label>
						<div class="col-md-4">
							<select class="form-control" name="satuan_besar">
								<?php
									foreach ($sb->result() as $sb) {
										echo "
											<option value='".$sb->kode_satuan."' ".($sb->kode_satuan==$kode_satuan ? "selected" : "").">".$sb->nama_satuan."</option>
										";
									}
								?>
							</select>
						</div>
						<label class="col-md-2">
							Satuan Kecil
						</label>
						<div class="col-md-4">
							<select class="form-control" name="satuan_kecil">
								<?php
									foreach ($sk->result() as $sk) {
										echo "
											<option value='".$sk->kode_satuan."' ".($sk->kode_satuan==$kode_satuan ? "selected" : "").">".$sk->nama_satuan."</option>
										";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2">
							Kategori
						</label>
						<div class="col-md-4">
							<select class="form-control" name="kode_kategori">
								<?php
									foreach ($k->result() as $kat) {
										echo "
											<option value='".$kat->kode_kategori."' ".($kat->kode_kategori==$kode_kategori ? "selected" : "").">".$kat->nama_kategori."</option>
										";
									}
								?>
							</select>
						</div>
						<label class="col-md-2">
							Golongan
						</label>
						<div class="col-md-4">
							<select class="form-control" name="kode_golongan">
								<?php
									foreach ($g->result() as $gol) {
										echo "
											<option value='".$gol->kode_golongan."' ".($gol->kode_golongan==$kode_golongan ? "selected" : "").">".$gol->nama_golongan."</option>
										";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2">
							Kode Simak
						</label>
						<div class="col-md-4">
							<input type="text"  class='form-control' name="kode_simak" value="<?php echo $kode_simak ?>">
						</div>
						<label class="col-md-2">
							Isi
						</label>
						<div class="col-md-4">
							<input type="number"  class='form-control' name="isi" value="<?php echo $isi ?>">
						</div>
					</div>
					<!-- <div class="form-group">
						<label class="col-md-2">
							Harga Beli
						</label>
						<div class="col-md-4">
							<input type="text" name="harga_beli" class="form-control" value="<?php echo $harga_beli?>">
						</div>
						<label class="col-md-2">
							Harga Jual
						</label>
						<div class="col-md-4">
							<input type="text" name="harga_jual" class="form-control" value="<?php echo $harga_jual?>">
						</div>
					</div> -->
					<div class="form-group">
						<label class="col-md-2">
							Jenis
						</label>
						<div class="col-md-4">
							<select class="form-control" name="kode_jenis">
								<?php
									foreach ($j->result() as $jen) {
										echo "
											<option value='".$jen->kode_jenis."' ".($jen->kode_jenis==$kode_jenis ? "selected" : "").">".$jen->nama_jenis."</option>
										";
									}
								?>
							</select>
						</div>
						<label class="col-md-2">
							Klasifikasi
						</label>
						<div class="col-md-4">
							<select class="form-control" name="kode_klasifikasi">
								<?php
									foreach ($klas->result() as $klas) {
										echo "
											<option value='".$klas->kode_klasifikasi."' ".($klas->kode_klasifikasi==$kode_klasifikasi ? "selected" : "").">".$klas->nama_klasifikasi."</option>
										";
									}
								?>
							</select>
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