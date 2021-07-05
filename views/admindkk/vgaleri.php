<script>
    $(document).ready(function(){
    	$(".delete").click(function(){
    		id = $(this).attr("kode");
    		var url = "<?php echo site_url('admindkk/hapusfoto');?>/"+id;
    		window.location = url;
    		return false;
    	})
		$("[name='foto']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
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
</script>
<div class="col-xs-12">
	<?php
		if($this->session->flashdata('message')){
			$pesan=explode('-', $this->session->flashdata('message'));
			echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<b>".$pesan[1]."</b>
			</div>";
		}
	?>
	<div class="box box-primary">
		<?php echo form_open_multipart('admindkk/simpangaleri',array("id"=>"formsubmit","class"=>"form-horizontal"));?>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label class="col-sm-12 control-label">Foto</label>
				    	<div class="col-sm-12">
				    	    <div class="product-img">
				    	        <img class="gambar img-thumbnail" style="width:100%" src="<?php echo base_url();?>img/default-image_450.png" alt="Product Image">
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
				<div class="col-sm-9">
					<table class='table table-striped'>
						<tr>
							<th width='20px'>No.</th>
							<th>Galeri</th>
							<th width='20px'>#</th>
						</tr>
						<?php
							$i = 1;
							foreach ($q->result() as $key) {
								$foto = 'data:image/gif;base64,'.$key->foto;
								echo "<tr>";
								echo "<td>".($i++)."</td>";
								echo "<td><img src='".$foto."' alt='Product Image' class='img-thumbnail' style='width:100px'></td>";
								echo "<td><button type='button' class='delete btn btn-sm btn-danger' kode='".$key->id."'><i class='fa fa-minus'></i></button>";
								echo "</tr>";
							}
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="box-footer">
		   <button type=submit class="simpan btn btn-primary btn-md" title="Add"><i class="fa fa-save"></i> Simpan</button>
		</div>
		<?php echo form_close();?>
	</div>
</div>