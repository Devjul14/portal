
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
</head>
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
        // var prosedur_masuk = $("[name='prosedur_masuk']").val();
        // if (prosedur_masuk=="UGD"){
        //     $(".formtindakan").removeClass("hide");
        //     $(".select2-container--default").css("width","100%");
        // } else 
        //     $(".formtindakan").addClass("hide");
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
        // $("[name='prosedur_masuk']").change(function(){
        //     var prodedur_masuk = $(this).val();
        //     if (prodedur_masuk=="UGD"){
        //         $(".formtindakan").removeClass("hide");
        //         $(".select2-container--default").css("width","100%");
        //     } else {
        //         $(".formtindakan").addClass("hide");
        //     }
        // })
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
        $("[name='kode_dokter'],[name='petugas_persalinan'],[name='petugas_telapakkaki']").select2();
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
        // $(".cancel").click(function(){
        //     window.location = "<?php echo site_url('pendaftaran/rawat_inap');?>";
        // })
        $('.cancel').click(function(){
            var cari_no = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_no:cari_no},
                url   : "<?php echo site_url('pendaftaran/getcaripasien_inap');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran/rawat_inap');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
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
                            <!-- <span class="input-group-btn">
                                <button class="ruangan btn btn-primary" type='button'>...</button>
                            </span> -->
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
                            <!-- <span class="input-group-btn">
                                <button class="ruangan btn btn-primary" type='button'>...</button>
                            </span> -->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">No Bed</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly name="no_bed" value="<?php echo $row->no_bed ?>">
                            <!-- <span class="input-group-btn">
                                <button class="ruangan btn btn-primary" type='button'>...</button>
                            </span> -->
                        </div>  
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Hak Kelas</label>
                    <div class="col-md-3">
                        <select name="hak_kelas" class="form-control">
                            <option value="1" <?php echo ($row->hak_kelas=="1" ? "selected" : "");?>>Kelas 1</option>
                            <option value="2" <?php echo ($row->hak_kelas=="2" ? "selected" : "");?>>Kelas 2</option>
                            <option value="3" <?php echo ($row->hak_kelas=="3" ? "selected" : "");?>>Kelas 3</option>
                        </select>
                    </div>
                    <label class="col-md-3 control-label">Naik/ Turun</label>
                    <div class="col-md-3">
                        <select name="naik_kelas" class="form-control">
                            <option value="">---</option>
                            <option value="naik" <?php echo ($row->naik_kelas=="naik" ? "selected" : "");?>>Naik</option>
                            <option value="turun" <?php echo ($row->naik_kelas=="turun" ? "selected" : "");?>>Turun</option>
                            <option value="titip" <?php echo ($row->naik_kelas=="titip" ? "selected" : "");?>>Titip</option>
                            <option value="kontribusi_dinas" <?php echo ($row->naik_kelas=="kontribusi_dinas" ? "selected" : "");?>>Kontribusi Dinas</option>
                        </select>
                    </div>
                </div>
            </div>
    	</div>
    	<div class="col-md-6">
    		<div class="form-horizontal">
    			<!-- <div class="form-group">
	            	<label class="col-md-3 control-label">Jumlah</label>
	                <div class="col-md-9">
	                    <input type="text" class="form-control" readonly name="jumlah">
	                </div>
	            </div> -->
                <div class="form-group">
                    <label class="col-md-3 control-label">Prosedur</label>
                    <div class="col-md-9">
                        <!-- <input type="text" class="form-control" name="prosedur_masuk"> -->
                        <select name="prosedur_masuk" class="form-control">
                            <option value="Poliklinik" <?php if ($row->prosedur_masuk=="Poliklinik"): ?>
                                selected
                            <?php endif ?>>Poliklinik</option>
                            <option value="UGD" <?php if ($row->prosedur_masuk=="UGD"): ?>
                                selected
                            <?php endif ?>>IGD</option>
                            <option value="Langsung" <?php if ($row->prosedur_masuk=="Langsung"): ?>
                                selected
                            <?php endif ?>>Langsung</option>
                        </select>
                    </div>
                </div>
                <div class="form-group formtindakan">
                    <label class="col-md-3 control-label">Tindakan</label>
                    <div class="col-md-9">
                        <select class="form-control tindakan block" name="tindakan[]" multiple="multiple">
                            <?php 
                                foreach ($tarif->result() as $key) {
                                    echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Cara Masuk</label>
                    <div class="col-md-9">
                        <!-- <input type="text" class="form-control" name="cara_masuk"> -->
                        <select name="cara_masuk" class="form-control">
                            <option value="Datang Sendiri" <?php if ($row->cara_masuk=="Datang Sendiri"): ?>
                                selected
                            <?php endif ?>>Datang Sendiri</option>
                            <option value="Rujukan RS" <?php if ($row->cara_masuk=="Rujukan RS"): ?>
                                selected
                            <?php endif ?>>Rujukan RS</option>
                            <option value="Rujukan Dokter" 
                            <?php if ($row->cara_masuk=="Rujukan Dokter"): ?>
                                selected
                            <?php endif ?>>Rujukan Dokter</option>
                            <option value="Rujukan Paramedis" <?php if ($row->cara_masuk=="Rujukan Paramedis"): ?>
                                selected
                            <?php endif ?>>Rujukan Paramedis</option>
                            <option value="Rujukan Puskesmas" <?php if ($row->cara_masuk=="Rujukan Puskesmas"): ?>
                                selected
                            <?php endif ?>>Rujukan Puskesmas</option>
                            <option value="Rujukan Kepolisian" <?php if ($row->cara_masuk=="Rujukan Kepolisian"): ?>
                                selected
                            <?php endif ?>>Rujukan Kepolisian</option>
                            <option value="Rujukan Lain" <?php if ($row->cara_masuk=="Rujukan Lain"): ?>
                                selected
                            <?php endif ?>>Rujukan Lain</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Pengirim</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="pengirim" value="<?php echo $row->pengirim ?>">
                    </div>
                    <!-- <div class="col-md-7">
                        <input type="text" class="form-control" readonly name="poli">
                    </div> -->
                    <!-- <div class="col-md-3">
                        <input type="text" class="form-control" readonly name="kode_poli">
                    </div>
                      <div class="col-md-1">
                        <button class="poli btn btn-primary" type='button'>...</button>
                    </div> -->
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Diagnosa</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" readonly name="diagnosa_masuk" autocomplete='off' value="<?php echo $row->nama_diagnosa; ?>">
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kode_diagnosa" value="<?php echo $row->diagnosa_masuk ?>">
                            <span class="input-group-btn">
                                <button class="diagnosa btn btn-primary" type='button'>...</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Dokter</label>
                    <div class="col-md-9">
                        <select name="kode_dokter" class="form-control">
                            <option value="">---</option>
                            <?php 
                                foreach ($q->result() as $key) {
                                    echo "<option value='".$key->id_dokter."' ".($row->dokter==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Dokter/Bidan </label>
                    <div class="col-md-9">
                        <select name="petugas_persalinan" class="form-control">
                            <option value="">---</option>
                            <?php 
                                foreach ($q->result() as $key) {
                                    echo "<option value='dokter|".$key->id_dokter."' ".($row->petugas_persalinan==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                            <?php 
                                foreach ($p->result() as $key) {
                                    echo "<option value='bidan|".$key->id_perawat."' ".($row->petugas_persalinan==$key->id_perawat ? "selected" : "").">".$key->nama_perawat."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Petugas Telapak Kaki </label>
                    <div class="col-md-9">
                        <select name="petugas_telapakkaki" class="form-control">
                            <option value="">---</option>
                            <?php 
                                foreach ($p->result() as $key) {
                                    echo "<option value='".$key->id_perawat."' ".($row->petugas_telapakkaki==$key->id_perawat ? "selected" : "").">".$key->nama_perawat."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Alergi</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="alergi" value="<?php echo $row->alergi ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Penanggung Jawab</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="penanggung_jawab" value="<?php echo $row->penanggung_jawab ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Telepon</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="telepon_pj" value="<?php echo $row->telepon_pj ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Catatan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="catatan_pasien" value="<?php echo $row->catatan_pasien ?>">
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
    .select2 .select2-container .select2-container--default .select2-container--below .select2-container--open{
        width: 100%;
    }
</style>