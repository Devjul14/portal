<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
 var mywindow1;
    function openCenteredWindow1(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow1 = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){

        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");
         $('#gol_pas').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pendaftaran/ambildata_pangkat",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html +='<option>--Pilih--</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id_pangkat+'>'+data[i].keterangan+'</option>';
                    }
                    $('.pangkat').html(html);
                     
                }
            });
        });
        $(".tindakan").select2();
        $(".perusahaan").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihpoli');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".ruangan").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihruangan');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".kamar").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihkamar');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".poli").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihpolid');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".kelas").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihkelas');?>";
        	openCenteredWindow(url);
            return false;
        });
        $("[name='kode_dokter']").select2();
        $(".dokter").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihdokter');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".diagnosa").click(function(){
            var kode = $("[name='kode_diagnosa']").val()
            var url = "<?php echo site_url('pendaftaran/pilihdiagnosa');?>/"+kode;
            openCenteredWindow(url);
            return false;
        });
        $(".desa").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihwilayah');?>/Desa";
        	openCenteredWindow(url);
            return false;
        });
        $(".kecamatan").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihwilayah');?>/Kecamatan";
        	openCenteredWindow(url);
            return false;
        });
        $(".kota").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihwilayah');?>/Kota";
        	openCenteredWindow(url);
            return false;
        });
        $(".provinsi").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihwilayah');?>/Provinsi";
        	openCenteredWindow(url);
            return false;
        });
         $('#cabang').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pendaftaran/ambildata_ketcabang",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option>'+data[i].keterangan+'</option>';
                    }
                    $('.ketcabang').html(html);
                     
                }
            });
        });
        var pekerjaan = $("select[name='pekerjaan']").val();
        if (pekerjaan=="PNS"){
            var url = "<?php echo site_url('pendaftaran/getgol_pekerjaan');?>";
            $("#gol_pekerjaan").load(url);
        }
        $("select[name='pekerjaan']").change(function(){
            var pekerjaan = $(this).val();
            if (pekerjaan=="PNS"){
                var url = "<?php echo site_url('pendaftaran/getgol_pekerjaan');?>";
                $("#gol_pekerjaan").load(url);
            } else { $("#gol_pekerjaan").html("<select name='pekerjaan'></select>")}
            return false;
        });
        $(".cancel").click(function(){
            window.location = "<?php echo site_url('pendaftaran/rawat_inap');?>";
        })
        $(".cetak").click(function(){
        	var no_pasien = $("input[name='no_pasien']").val();
            var no_reg = $("input[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetakinap');?>/"+no_pasien+"/"+no_reg;
            openCenteredWindow(url)
        })
    });
    $(document).on('keyup keypress', "[name='kode_diagnosa']", function(e) {
        if(e.keyCode == 13) {
            e.preventDefault();
            $(".diagnosa").click();
            return false;
        }
    });
</script>
<div class="col-md-12">
<div class="box box-primary">
    <div class="box-body">
    	<div class="col-md-6">
    		<div class="form-horizontal">
	            <?php
	                echo form_open("pendaftaran/editrawatinap/",array("id"=>"formsave","class"=>"form-horizontal"));
	            ?>
	            
            	<div class="form-group">
	            	<label class="col-md-3 control-label">No. Reg</label>
	                <div class="col-md-9">
	                    <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
	                </div>
	            </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tgl. Masuk</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="tgl_masuk" readonly value="<?php echo $row->tgl_masuk;?>">
                    </div>
                    <label class="col-md-3 control-label">Tgl. keluar</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="tgl_keluar" readonly value="<?php echo $row->tgl_keluar;?>">
                    </div>
                </div>
	            <div class="form-group">
	            	<label class="col-md-3 control-label">No. RM</label>
	                <div class="col-md-9">
	                    <input type="text" class="form-control" required name="no_pasien" readonly value="<?php echo $id;?>">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-3 control-label">Nama Pasien</label>
	                <div class="col-md-9">
	                    <input type="text" class="form-control" required name="nama_pasien" readonly value="<?php echo $row->nama_pasien;?>">
	                </div>
	            </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Gol. Pasien</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" required name="id_gol" readonly value="<?php echo $row->id_gol;?>">
                    </div>
                </div>
	            <div class="form-group">
                    <label class="col-md-3 control-label">Ruangan</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" readonly name="ruangan" value="<?php echo $row->ruangan ?>">
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly name="kode_ruangan" value="<?php echo $row->kode_ruangan ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Kelas</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" readonly name="kelas" value="<?php echo $row->kelas ?>">
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly name="kode_kelas" value="<?php echo $row->kode_kelas ?>">
                            <!-- <span class="input-group-btn">
                                <button class="ruangan btn btn-primary" type='button'>...</button>
                            </span> -->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Kamar</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" readonly name="kamar"  value="<?php echo $row->kode_kamar ?>">
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly name="kode_kamar" value="<?php echo $row->kode_kamar ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">No Bed</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly name="no_bed" value="<?php echo $row->no_bed ?>">
                        </div>  
                    </div>
                </div>
            </div>
    	</div>
    	<div class="col-md-6">

    	</div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <div class="btn-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                <button class="cetak btn btn-success" type="button"><i class="fa fa-save"></i> Cetak</button>
                <button class="cancel btn btn-danger" type="button"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
        <?php echo form_close();?>
    </div>
</div>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #f4f4f4;
    }
    .select2 .select2-container .select2-container--default .select2-container--below .select2-container--open{
        width: 100%;
    }
</style>