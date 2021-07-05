<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $("[name='foto']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        getimage();
        getphoto();
        $("[name='photo_file']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.photo').attr("src",URL.createObjectURL(event.target.files[0]));
                upload_photo();
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
        $('.btn-file-photo :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label; 
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }  
        });
        $(".back").click(function(){
            var url = "<?php echo site_url('petugas/lab');?>";
            window.location = url;
            return false; 
        });
        
    });
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).on('change', '.btn-file-photo :file', function() {
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
    function upload_photo(){
        var files = document.getElementById("photo_file").files;
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
                $("[name='source_photo']").val(imgdata);
            };
        } else {
            alert("Ukuran foto tidak boleh lebih dari 250 Kb");
        }
    }
    function getimage(){
        var nip = $("[name='nip']").val();
        $.ajax({
            url: "<?php echo base_url();?>/petugas/getttd_pa", 
            type: 'POST', 
            data: {nip:nip},
            success: function(imgdata){
                image = (imgdata=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata;
                $(".gambar").attr('src', image);
                $("[name='source_foto']").val(imgdata);
            }
        });
    }
    function getphoto(){
        var nip = $("[name='nip']").val();
        $.ajax({
            url: "<?php echo base_url();?>/petugas/getphoto_pa", 
            type: 'POST', 
            data: {nip:nip},
            success: function(imgdata){
                image = (imgdata=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata;
                $(".photo").attr('src', image);
                $("[name='source_photo']").val(imgdata);
            }
        });
    }
</script>
<?php
    if ($q) {
        $nama=$q->nama;
        $r = "readonly";
        $ttd = $q->ttd=="" ? "img/default-image_450.png" : "img/ttd/".$q->ttd;
        $aksi = "edit";
    } else {
        $nama="";
        $r = "";
        $aksi = "simpan";
        $ttd = "img/default-image_450.png";
    }
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open_multipart("petugas/simpanlab/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Id Petugas</label>
                    <div class="col-sm-10">
                        <input type="text" name="nip" class="form-control" value="<?=$nip;?>" <?php echo $r;?> >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Petugas</label>
                    <div class="col-sm-10">
                       <input type="text" name="nama" class="form-control" value="<?=$nama;?>">
                    </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label">Tanda tangan</label>
                        <div class="col-sm-2">
                            <div class="product-img">
                                <img class="gambar img-thumbnail" style="width:100%" src="<?php echo base_url().$ttd;?>" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-sm-8">
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-2">
                            <div class="product-img">
                                <img class="photo img-thumbnail" style="width:100%" src="<?php echo base_url().$ttd;?>" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div id="file-photo">
                                <div class="input-group">  
                                    <input type="hidden" name="source_photo">        
                                    <input type="text" class="form-control" readonly>        
                                    <span class="input-group-btn">
                                        <span class="btn btn-warning btn-file-photo"><i class="fa fa-folder-open"></i><input type="file" name="photo_file" id="photo_file" class="form-control"></span>
                                    </span>
                                </div> 
                            </div>
                        </div>
                    </div>             
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="back btn btn-warning" type="reset">Batal</button>
                </div>
            </div>
            <?php echo form_close();?> 
        </div>
    </div>
</div>
<style type="text/css">
    .btn.btn-file-photo > input[type='file'] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        opacity: 0;
        filter: alpha(opacity=0);
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>