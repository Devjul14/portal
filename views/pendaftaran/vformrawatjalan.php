<?php
    if ($row->num_rows()>0){
        $row = $row->row();
        $tanggal = date("d-m-Y");
        $nama_pasien = $row->nama_pasien;
        $no_pasien = $row->no_pasien;
        $id_gol = $row->id_gol;
        $id_gol_ket = $row->keterangan;
        $no_bpjs = $row->no_bpjs;
        $perusahaan = $row->perusahaan;       
        $kode_p = $row->kode_perusahaan; 
    } else {
        $tanggal = date("d-m-Y");
        $nama_pasien = 
        $no_pasien = 
        $id_gol =
        $id_gol_ket =  
        $no_bpjs = 
        $perusahaan =        
        $kode_p = "";
    }      
    if($igd){
        $kode_tujuan = "0102030";
        $tujuan = "IGD";
    } else {
        $kode_tujuan = $tujuan = "";
    }
?>
<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
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
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl
        });
        $("[name='dokter_poli'], .tindakan").select2();
        $(".perusahaan").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihpoli');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".tujuan").click(function(){
            // $("#select").empty();
        	var url = "<?php echo site_url('pendaftaran/pilihpoli');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".no_reg").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihnoreg');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".dokter").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihdokter');?>";
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
        $("[name='tanggal']").change(function(){
            var tanggal = $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pendaftaran/getnoreg",
                method : "POST",
                data : {tanggal: tanggal},
                success: function(data){
                    $('[name="no_reg"]').val(data);
                     
                }
            });
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
        // $(".cancel").click(function(){
        //     window.location = "<?php echo site_url('pendaftaran');?>";
        // })
        $('.cancel').click(function(){
            var cari_no = $("[name='no_pasien']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_no:cari_no},
                url   : "<?php echo site_url('pendaftaran/getcaripasien');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $(".cetak").click(function(){
        	var no_pasien = $("input[name='no_pasien']").val();
            var url = "<?php echo site_url('pendaftaran/cetakpasien');?>/"+no_pasien;
            openCenteredWindow(url)
        });
        var kode = $("[name='kode_tujuan']").val();
        $.ajax({
            url : "<?php echo base_url();?>pendaftaran/ambildatadokter",
            dataType: "text",
            method : "POST",
            data : {kode: kode},
            success: function(data){
                $("#select").append(data);
            }
        });
    });
</script>
<div class="col-md-12">
<div class="box box-primary">
    <div class="box-body">
    	<div class="col-md-12">
    		<div class="form-horizontal">
	            <?php
	                echo form_open("pendaftaran/simpanrawatjalan/",array("id"=>"formsave","class"=>"form-horizontal"));
	                echo "<input type='hidden' value='".$igd."' name='igd'>";
                ?>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">No. Reg</label>
	                <div class="col-md-4">
	                    <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
	                </div>
	                <label class="col-md-2 control-label">Tanggal Daftar</label>
	                <div class="col-md-4">
	                	<input type="text" class="form-control" name="tanggal" value="<?php echo $tanggal;?>">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">No. RM</label>
	                <div class="col-md-10">
	                    <input type="text" class="form-control" required name="no_pasien" readonly value="<?php echo $no_pasien;?>">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">Nama</label>
	                <div class="col-md-10">
	                    <input type="text" class="form-control" required name="nama_pasien" readonly value="<?php echo $nama_pasien;?>">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">Gol. Pasien</label>
	                <div class="col-md-10">
                        <input type="hidden" class="form-control" required name="id_gol" readonly value="<?php echo $id_gol;?>">
	                    <input type="text" class="form-control" required name="id_gol_ket" readonly value="<?php echo $id_gol_ket;?>">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">NO BPJS</label>
	                <div class="col-md-10">
	                    <input type="text" class="form-control" required name="no_bpjs" readonly value="<?php echo $no_bpjs;?>">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">No. SJP</label>
	                <div class="col-md-10">
	                    <input type="text" class="form-control" name="no_sjp">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">Perusahaan</label>
	                <div class="col-md-7">
	                    <input type="text" class="form-control" name="perusahaan" readonly value="<?php echo $perusahaan;?>">
	                </div>
	                <div class="col-md-2">
	                    <input type="text" class="form-control" name="kode_perusahaan" readonly value="<?php echo $kode_p;?>">
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">Tujuan Ke</label>
	                <div class="col-md-7">
	                    <input type="text" class="form-control" readonly name="tujuan" value="<?php echo $tujuan;?>">
	                </div>
	                <div class="col-md-2">
	                    <input type="text" class="form-control" readonly name="kode_tujuan" value="<?php echo $kode_tujuan;?>">
	                </div>
	                  <div class="col-md-1">
	                    <button class="tujuan btn btn-primary" type='button'>...</button>
	                </div>
	            </div>
                <?php if ($igd) : ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tindakan</label>
                    <div class="col-md-10">
                        <select class="form-control tindakan" name="tindakan[]" multiple="multiple">
                            <?php 
                                foreach ($tarif->result() as $key) {
                                    echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <?php endif ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">Dokter Tujuan</label>
                    <div class="col-md-10">
                        <select class="form-control" name="dokter_poli" id="select">
                            <!-- <option>---Pilih---</option> -->
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Status</label>
                    <div class="col-md-10">
                        <select class="form-control" name="status_pasien">
                            <option value="LAMA">LAMA</option>
                            <option value="BARU">BARU</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kelas</label>
                    <div class="col-md-10">
                        <select class="form-control" name="jenis">
                            <option value="R">Reguler</option>
                            <option value="E">Executive</option>
                        </select>
                    </div>
                </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">No Reg Sebelumnya</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" readonly name="no_reg_sebelumnya">
                    </div>
	                <div class="col-md-4">
	                    <input type="text" class="form-control" readonly name="poli">
	                </div>
	                <div class="col-md-2">
	                    <input type="text" class="form-control" readonly name="kode_poli">
	                </div>
                    <div class="col-md-1">
	                    <button class="no_reg btn btn-primary" type='button'>...</button>
	                </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-md-2 control-label">Dokter Pengirim</label>
	                <div class="col-md-7">
	                    <input type="text" class="form-control" readonly name="dokter" autocomplete='off'>
	                </div>
	                <div class="col-md-2">
	                    <input type="text" class="form-control" readonly name="kode_dokter">
	                </div>
	                  <div class="col-md-1">
	                    <button class="dokter btn btn-primary" type='button'>...</button>
	                </div>
	            </div>
	            
	        </div>
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
</style>