<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('dokter/view');?>";
            window.location = url;
            return false; 
        });
        getimage();
        getphoto();
           var formattgl = "yy-mm-dd";
        $("input[name='tgl_sip']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
        $("[name='foto']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        $("[name='photo_file']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.photo').attr("src",URL.createObjectURL(event.target.files[0]));
                upload_photo();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        // $("select[name='id_kecamatan']").select2();
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
        var id_dokter = $("[name='id_dokter']").val();
        $.ajax({
            url: "<?php echo base_url();?>/dokter/getttd", 
            type: 'POST', 
            data: {id_dokter:id_dokter},
            success: function(imgdata){
                image = (imgdata=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata;
                $(".gambar").attr('src', image);
            }
        });
    }
    function getphoto(){
        var id_dokter = $("[name='id_dokter']").val();
        $.ajax({
            url: "<?php echo base_url();?>/dokter/getphoto", 
            type: 'POST', 
            data: {id_dokter:id_dokter},
            success: function(imgdata){
                image = (imgdata=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata;
                $(".photo").attr('src', image);
                $("[name='source_photo']").val(imgdata);
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
<?php
    if ($q) {
        $id_dokter=$q->id_dokter;
        $nama_dokter=$q->nama_dokter;
        $gelar_depan=$q->gelar_depan;
        $gelar_belakang=$q->gelar_belakang;
        $kelompok_dokter=$q->kelompok_dokter;
        $no_sip=$q->no_sip;
        $no_str=$q->no_str;
        $tgl_sip=$q->tgl_sip;
        $jk=$q->jk;
        $no_telp=$q->no_telp;
        $alamat=$q->alamat;
        $gelar_depan = $q->gelar_depan;
        $gelar_belakang = $q->gelar_belakang;
        $r = "readonly";
        $ttd = $q->ttd=="" ? "img/default-image_450.png" : "img/ttd/".$q->ttd;
        $aksi = "edit";
    } else {
        $gelar_depan = 
        $gelar_belakang = 
        $id_dokter=
        $nama_dokter=
        $kelompok_dokter=
        $no_sip=
        $no_str=
        $tgl_sip=
        $jk=
        $no_telp=
        $alamat="";
        $gd1= $gd2= $gd3=
        $gb1= $gb2= $gb3=
        $r = "";
        $ttd = "img/default-image_450.png";
        $aksi = "simpan";
    }
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open_multipart("dokter/simpandokter/".$aksi,array("class"=>"form-horizontal"));?>
                  <div class="form-group">
                       <label class="col-sm-2 control-label">ID Dokter</label>
                       <div class="col-sm-10">
                            <input type="text" name="id_dokter" class="form-control" value="<?=$id_dokter;?>"  <?php echo $r ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Dokter</label>
                       <div class="col-sm-10">
                            <input type="text" name="nama_dokter" class="form-control" value="<?=$nama_dokter;?>">
                        </div>
                   </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Gelar Depan</label>
                        <div class="col-sm-10">
                            <select name="gelar_depan" class="form-control">
                                <?php
                                    foreach ($d->result() as $dep) {
                                        echo "
                                            <option value='".$dep->id_gelar."' ".($dep->id_gelar==$gelar_depan ? "selected" : "").">".$dep->id_gelar." || ".$dep->nama_gelar."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Gelar belakang</label>
                        <div class="col-sm-10">
                            <select name="gelar_belakang" class="form-control">
                                <?php
                                    foreach ($b->result() as $bel) {
                                        echo "
                                            <option value='".$bel->id_gelar."' ".($bel->id_gelar==$gelar_depan ? "selected" : "").">".$bel->id_gelar." || ".$bel->nama_gelar."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelompok Dokter</label>
                        <div class="col-sm-10">
                            <select name="kelompok_dokter" class="form-control">
                             <?php
                                 foreach ($kel->result() as $value) {
                                   echo "<option value='".$value->id_kelompok."'".($kelompok_dokter==$value->id_kelompok ? "selected" : "").">".$value->nama_kelompok."</option>";
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No SIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_sip" value="<?=$no_sip;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No STR</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="no_str" value="<?=$no_str;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tgl SIP</label>
                        <div class="col-sm-10">
                             <input type="hidden"  value="<?php echo date("d-m-Y");?>">
                            <input type="text" class="tgl form-control" name="tgl_sip" value="<?=$tgl_sip;?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                       <div class="col-sm-10">
                            <textarea class="form-control" name="alamat"><?=$alamat;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon </label>
                        <div class="col-sm-10">
                            <input type="text" name="no_telp" class="form-control" value="<?=$no_telp;?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="password" name="password">
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