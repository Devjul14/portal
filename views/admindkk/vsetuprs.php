<?php
	if ($q){
		$kode_rs = $q->kode_rs;
        $nama_rs = $q->nama_rs;

        $alamat_rs = $q->alamat_rs;
        $telepon_rs = $q->telepon_rs;
        $email_rs = $q->email_rs;
        $foto = $q->foto;
        $karumkit = $q->karumkit;
        $nama_k = $q->nama_k;
        $h = "";
        $ttd = $q->ttd_k=="" ? "img/default-image_450.png" : "img/ttd/".$q->ttd_k;
				$nama_petugas_klaim = $q->nama_petugas_klaim;
        $nip_petugas_klaim = $q->nip_petugas_klaim;
        $ttd_petugas_klaim = $q->ttd_petugas_klaim== "" ? "img/default-image_450.png" : "img/ttd/".$q->ttd_petugas_klaim;
        $action 		= "ubah";
    } else {
    	$kode_rs = "";
        $nama_rs = "";
        $ttd = "img/default-image_450.png";
        $alamat_rs = "";
        $telepon_rs = "";
        $email_rs = "";
        $karumkit = "";
        $nama_k = "";
        $foto = "";
				$nama_petugas_klaim = "";
        $nip_petugas_klaim = "";
        $ttd_petugas_klaim = "";
        $h = "hidden";
        $action = "simpan";
    }
?>
 <!-- <meta name="viewport" content="width=device-width"> -->
<script>
	    	 function tampilkanPreview(gambar,idpreview){
//                membuat objek gambar
                var gb = gambar.files;
//                loop untuk merender gambar
                for (var i = 0; i < gb.length; i++){
//                    bikin variabel
                    var gbPreview = gb[i];
                    var imageType = /image.*/;
                    var preview=document.getElementById(idpreview);
                    var reader = new FileReader();
                    if (gbPreview.type.match(imageType)) {
//                        jika tipe data sesuai
                        preview.file = gbPreview;
                        reader.onload = (function(element) {
                            return function(e) {
                                element.src = e.target.result;
                            };
                        })(preview);
    //                    membaca data URL gambar
                        reader.readAsDataURL(gbPreview);
                    }else{
//                        jika tipe data tidak sesuai
                        alert("Type file tidak sesuai. Khusus image.");
                    }
                }
            }
    $(document).ready(function(){


    	getimage();
        $(".reset").click(function(){
			$(".modal").show();
		});
		$(".tidak").click(function(){
			$(".modal").hide();
		});
		$(".ya").click(function(){
			var id = $("[name='kode_rs']").val();
			window.location="<?php echo site_url('admindkk/resetsetup');?>/"+id;
		});
		$("[name='foto']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
		$("[name='ttd']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar_ttd').attr("src",URL.createObjectURL(event.target.files[0]));
                upload_ttd();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
				$("[name='ttd_klaim']").change(function(event){
		            if (event.target.files[0].size<=250000){
		                $('.gambar_ttd_klaim').attr("src",URL.createObjectURL(event.target.files[0]));
		                upload_ttd_klaim();
		            } else {
		                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
		            }
		        });
		$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
    });
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    function upload(){
        var files = document.getElementById("foto").files;
        var totalsize = 0;
        if (files.length > 0) {
          var file = files[0];
          totalsize = files[0].size;
        }
        if (totalsize<=250000){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var imagedata = reader.result;
                var imgdata = imagedata.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
                $("[name='source_foto']").val(imgdata);
            };
        } else {
            alert("Ukuran foto tidak boleh lebih dari 250 Kb");
        }
    }
    function upload_ttd(){
        var files = document.getElementById("ttd").files;
        var totalsize = 0;
        if (files.length > 0) {
          var file = files[0];
          totalsize = files[0].size;
        }
        if (totalsize<=250000){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var imagedata = reader.result;
                var imgdata = imagedata.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
                $("[name='source_ttd']").val(imgdata);
            };
        } else {
            alert("Ukuran foto tidak boleh lebih dari 250 Kb");
        }
    }
		function upload_ttd_klaim(){
        var files = document.getElementById("ttd_klaim").files;
        var totalsize = 0;
        if (files.length > 0) {
          var file = files[0];
          totalsize = files[0].size;
        }
        if (totalsize<=250000){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var imagedata = reader.result;
                var imgdata = imagedata.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
                $("[name='source_ttd_klaim']").val(imgdata);
            };
        } else {
            alert("Ukuran foto tidak boleh lebih dari 250 Kb");
        }
    }
    function getimage(){
        $.ajax({
            url: "<?php echo base_url();?>/admindkk/getfoto",
            type: 'POST',
            success: function(imgdata){
                image = (imgdata=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata;
                $(".gambar").attr('src', image);
                $("[name='source_foto']").val(imgdata);
            }
        });
        $.ajax({
            url: "<?php echo base_url();?>/admindkk/getttd",
            type: 'POST',
            success: function(imgdata){
                image = (imgdata=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata;
                $(".gambar_ttd").attr('src', image);
                $("[name='source_ttd']").val(imgdata);
            }
        });
				$.ajax({
            url: "<?php echo base_url();?>/admindkk/getttd_klaim",
            type: 'POST',
            success: function(imgdata){
                image = (imgdata=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata;
                $(".gambar_ttd_klaim").attr('src', image);
                $("[name='source_ttd_klaim']").val(imgdata);
            }
        });
    }
</script>
<?php
	if($this->session->flashdata('message')){
		$pesan=explode('-', $this->session->flashdata('message'));
		echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<b>".$pesan[1]."</b>
		</div>";
	}
?>
<div class='modal'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION</h4></div>
			<div class='modal-body'>Yakin akan menghapus data ?</div>
			<div class='modal-footer'>
				<button class="ya btn btn-sm btn-danger">Ya</button>
				<button class="tidak btn btn-sm btn-success">Tidak</button>
			</div>
		</div>
	</div>
</div>

	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header"></div>
			<?php echo form_open_multipart('admindkk/simpansetup/'.$action,array("id"=>"formsubmit","class"=>"form-horizontal"));?>
			<input type="hidden" name="id_rs" value="<?php echo $kode_rs; ?>" />
			<div class="box-body">
				<div class="form-group">
					<label class="col-sm-12 control-label">Kode RS</label>
					<div class="col-sm-12">
						<input class="form-control" type="text" required name="kode_rs" value="<?php echo $kode_rs; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label">Nama RS</label>
					<div class="col-sm-12">
						<input class="form-control" type="text" required name="nama_rs" value="<?php echo $nama_rs; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12 control-label">Alamat</label>
					<div class="col-sm-12">
						<textarea class="form-control" name="alamat_rs"><?php echo $alamat_rs; ?></textarea>
					</div>
				</div>

					<div class="form-group">
					<label class="col-sm-12 control-label">Telepon</label>
					<div class="col-sm-12">
						<input class="form-control" type="text" required name="telepon_rs" value="<?php echo $telepon_rs; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-12 control-label">Email</label>
					<div class="col-sm-12">
						<input class="form-control" type="text" required name="email_rs" value="<?php echo $email_rs; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label">Kepala RS</label>
					<div class="col-sm-12">
						<input class="form-control" type="text" required name="karumkit" value="<?php echo $karumkit; ?>" />
					</div>
				</div>
				<div class="row">
                    <div class="col-sm-3">
                    	<div class="form-group">
                    		<label class="col-sm-12 control-label">Foto Kepala RS</label>
                        	<div class="col-sm-12">
                        	    <div class="product-img">
                        	        <img class="gambar img-thumbnail" style="width:100%" alt="Product Image">
                        	    </div>
                        	</div>
                        	<div class="col-sm-12">
                        	    <div id="file-image">
                        	        <div class="input-group">
                        	            <input type="hidden" name="source_foto">
                        	            <input type="text" name="tempfoto" class="form-control" readonly>
                        	            <span class="input-group-btn">
                        	                <span class="btn btn-warning btn-file"><i class="fa fa-folder-open"></i><input type="file" name="foto" id="foto" class="form-control"></span>
                        	            </span>
                        	        </div>
                        	    </div>
                        	</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="form-group">
							<label class="col-sm-12 control-label">Logo</label>
							<div class="col-sm-12">
								<input type="file" name="foto" accept="image/*"  onchange="tampilkanPreview(this,'preview')">
								<img id="preview" src="<?php echo base_url();?>assets/foto/<?php echo $foto;?>" class="img-thumbnail" width="256px" height="256px">
							</div>
						</div>
					</div>
                </div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label class="col-sm-12 control-label">Kasub Bidang Keperawatan</label>
									<div class="col-sm-12">
										<input class="form-control" type="text" required name="nama_k" value="<?php echo $nama_k; ?>" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-8">
										<div class="form-group">
											<label class="col-sm-12 control-label">Tanda Tangan</label>
											<div class="col-sm-12">
												<div class="product-img">
													<img class="gambar_ttd img-thumbnail" style="width:100%" src="<?php echo base_url().$ttd;?>" alt="Product Image">
												</div>
											</div>
											<div class="col-sm-12">
												<div id="file-image">
													<div class="input-group">
														<input type="hidden" name="source_ttd">
														<input type="text" name="tempfoto" class="form-control" readonly>
														<span class="input-group-btn">
															<span class="btn btn-warning btn-file"><i class="fa fa-folder-open"></i><input type="file" name="ttd" id="ttd" class="form-control"></span>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label class="col-sm-12 control-label">NIP Administrasi Klaim</label>
								<div class="col-sm-12">
									<input class="form-control" type="text" required name="nip_petugas_klaim" value="<?php echo $nip_petugas_klaim; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-12 control-label">Administrasi Klaim</label>
								<div class="col-sm-12">
									<input class="form-control" type="text" required name="nama_petugas_klaim" value="<?php echo $nama_petugas_klaim; ?>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-8">
									<div class="form-group">
										<label class="col-sm-12 control-label">Tanda Tangan Administrasi Klaim</label>
										<div class="col-sm-12">
											<div class="product-img">
												<img class="gambar_ttd_klaim img-thumbnail" style="width:100%" src="<?php echo base_url().$ttd_petugas_klaim;?>" alt="Product Image">
											</div>
										</div>
										<div class="col-sm-12">
											<div id="file-image">
												<div class="input-group">
													<input type="hidden" name="source_ttd_klaim">
													<input type="text" name="tempfoto" class="form-control" readonly>
													<span class="input-group-btn">
														<span class="btn btn-warning btn-file"><i class="fa fa-folder-open"></i><input type="file" name="ttd_klaim" id="ttd_klaim" class="form-control"></span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			<div class="box-footer">
               <button type=submit class="simpan btn btn-primary btn-md" title="Add"><i class="fa fa-save"></i> Simpan</button>
				<div class="pull-right">
	                <div class="btn-group">
	                   <button class="reset btn btn-danger btn-md <?php echo $h; ?>" type="button"><i class="fa fa-times"></i> Reset</button>
	                </div>
	            </div>
			</div>
			<?php
				echo form_close();
			?>
		</div>
	<div>
