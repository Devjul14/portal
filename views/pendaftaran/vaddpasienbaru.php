<?php
    if ($row) {
        $jamlahir = $row->jamlahir;
        $tanggal = $row->tanggal!="" ? date("d-m-Y",strtotime($row->tanggal)) : "";
        $nama_pasien = $row->nama_pasien;
        $agama = $row->agama;
        $no_pasien = $row->no_pasien;
        $no_bpjs = $row->no_bpjs;
        $iskk = $row->iskk;
        $hubungan_keluarga = $row->hubungan_keluarga;
        $jenis_kelamin = $row->jenis_kelamin;
        $status_kawin = $row->status_kawin;
        $alamat = $row->alamat;
        $id_kecamatan = $row->id_kecamatan;
        $id_kelurahan = $row->id_kelurahan;
        $id_kota = $row->id_kota;
        $id_provinsi = $row->id_provinsi;
        $nama_kecamatan = $row->nama_kecamatan;
        $nama_kelurahan = $row->nama_kelurahan;
        $nama_kota = $row->nama_kota;
        $nama_provinsi = $row->nama_provinsi;
        // $tgl_lahir = date("d-m-Y",strtotime($row->tgl_lahir));
        $tgl_lahir = $row->tgl_lahir;
        $pendidikan = $row->pendidikan;
        $pekerjaan = $row->pekerjaan;
        $golongan = $row->gol;
        $telpon = $row->telpon;
        $nama_pasangan = $row->nama_pasangan;
        $tgllahir_ayah = $row->tgllahir_ayah=="" || $row->tgllahir_ayah=="1970-01-01" ? "" : date("d-m-Y",strtotime($row->tgllahir_ayah));
        $pekerjaan_ayah = $row->pekerjaan_ayah;
        $ibu = $row->ibu;
        $tgllahir_ibu = $row->tgllahir_ibu=="" || $row->tgllahir_ibu=="1970-01-01" ? "" : date("d-m-Y",strtotime($row->tgllahir_ibu));
        $pekerjaan_ibu = $row->pekerjaan_ibu;
        $nip = $row->nip;
        $ktp = $row->ktp;
        $gol_pas = $row->id_gol;
        $cabang = $row->id_cabang;
        $ketcabang = $row->id_ketcabang;
        $suku = $row->suku;
        $negara = $row->negara;
        $kode_perusahaan = $row->perusahaan;
        $nama_perusahaan = $row->nama_perusahaan;
        $id_pangkat = $row->id_pangkat;
        $nama_pangkat = $row->nama_pangkat;
        $id_kesatuan = $row->id_kesatuan;
        if ($row->agama=="ISLAM") $ag1 = "selected"; else $ag1 = "";
        if ($row->agama=="PROTESTAN") $ag2 = "selected"; else $ag2 = "";
        if ($row->agama=="KRISTEN") $ag3 = "selected"; else $ag3 = "";
        if ($row->agama=="HINDU") $ag4 = "selected"; else $ag4 = "";
        if ($row->agama=="BUDHA") $ag5 = "selected"; else $ag5 = "";
        if ($row->agama=="KONG HU CHU") $ag6 = "selected"; else $ag6 = "";
        if ($row->agama=="LAINNYA") $ag7 = "selected"; else $ag7 = "";
        if ($row->berat_badan!=NULL) $by = "checked"; else $by = "";
        $nama_kesatuan = $row->nama_kesatuan;
        $berat_badan = $row->berat_badan;
        $panjang_badan = $row->panjang_badan;
        $kelahiran_ke = $row->kelahiran_ke;
        $tindakan_bayi = $row->tindakan_bayi;
        $kembar = $row->kembar;
        $kelainan_bawaan = $row->kelainan_bawaan;
        $lingkar_kepala = $row->lingkar_kepala;
        $lingkar_dada = $row->lingkar_dada;
        $lingkar_lengan = $row->lingkar_lengan;
        $lingkar_perut = $row->lingkar_perut;
        $id_kesatuan = $row->id_kesatuan;
        $hidden = "";
        $action = "edit";
    } else {
        $jamlahir = "";
        $tanggal = date("d-m-Y"); 
        $id_pangkat =
        $nama_pangkat =  
        $agama =
        $id_kesatuan =
        $nama_kesatuan =  
        $kode_perusahaan = 
        $nama_perusahaan = 
        $nama_kecamatan = 
        $nama_kelurahan = 
        $nama_kota = 
        $nama_provinsi = 
        $suku = 
        $negara =
        $no_pasien =
        $nama_pasien = 
        $no_bpjs = 
        $hubungan_keluarga =
        $jenis_kelamin = 
        $status_kawin =
        $alamat = 
        $id_provinsi = 
        $id_kota = 
        $id_kecamatan = 
        $id_kelurahan = 
        $tgl_lahir =
        $pendidikan = 
        $telpon =
        $pekerjaan = 
        $nama_pasangan = 
        $tgllahir_ayah =
        $pekerjaan_ayah = 
        $ibu =
        $tgllahir_ibu = 
        $pekerjaan_ibu = 
        $nip = 
        $ktp = 
        $gol_pas=
        $cabang=
        $nama_kesatuan = 
        $berat_badan = 
        $panjang_badan = 
        $kelahiran_ke = 
        $tindakan_bayi = 
        $kembar = 
        $kelainan_bawaan = 
        $lingkar_kepala = 
        $lingkar_dada = 
        $lingkar_lengan = 
        $lingkar_perut =
        $by =
        $ag1= $ag2= $ag3= $ag4= $ag5= $ag6= $ag7=
        $ketcabang=
        $golongan = "";
        $hidden = "hidden";
        $action = "simpan";
    }
    if ($q7->num_rows() >0) {
        $row = $q7->row();
        $nama_kk = $row->nama_pasien;
        $no_kk = $row->no_kk;
        $nopasien = explode('.',$row->no_pasien);
        $no_pasien1 = $nopasien[0];
        $no_pasien2 = $this->Mpendaftaran->getno_pasien_baru($no_kk);
    } else {
        $no_kk = $nama_kk = "";
    }
?>
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
    function getAge(dateString) {
	    var today = new Date();
	    var DOB = new Date(dateString);
	    var totalMonths = (today.getFullYear() - DOB.getFullYear()) * 12 + today.getMonth() - DOB.getMonth();
	    totalMonths += today.getDay() < DOB.getDay() ? -1 : 0;
	    var years = today.getFullYear() - DOB.getFullYear();
	    if (DOB.getMonth() > today.getMonth())
	        years = years - 1;
	    else if (DOB.getMonth() === today.getMonth())
	        if (DOB.getDate() > today.getDate())
	            years = years - 1;

	    
	    var days;
	    var months;

	    if (DOB.getDate() > today.getDate()) {
	        months = (totalMonths % 12);
	        if (months == 0)
	            months = 11;
	        var x = today.getMonth();
	        switch (x) {
	            case 1:
	            case 3:
	            case 5:
	            case 7:
	            case 8:
	            case 10:
	            case 12: {
	                var a = DOB.getDate() - today.getDate();
	                days = 31 - a;
	                break;
	            }
	            default: {
	                var a = DOB.getDate() - today.getDate();
	                days = 30 - a;
	                break;
	            }
	        }
	    }
	    else {
	        days = today.getDate() - DOB.getDate();
	        if (DOB.getMonth() === today.getMonth())
	            months = (totalMonths % 12);
	        else
	            months = (totalMonths % 12);
	    }
	    var age = years + ' Tahun ' + months + ' Bulan ' + days + ' Hari';
	    return age;
	}
    $(document).on('change', '.btn_kakikiri :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.strlen : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).on('change', '.btn_kakikanan :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.strlen : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).on('change', '.btn_ibujari_kiri :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.strlen : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).on('change', '.btn_ibujari_kanan :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.strlen : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).ready(function(){
        getimage();
        myFunction();
        $(".lanjut").click(function(){
            prosessinkron();
            return false;
        });
        $("[name='foto_kakikiri']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar_kakikiri').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        $('.btn_kakikiri :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label; 
            if( input.strlen ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }  
        });
        $("[name='foto_kakikanan']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar_kakikanan').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        $('.btn_kakikanan :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label; 
            if( input.strlen ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }  
        });
        $("[name='foto_ibujari_kiri']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar_ibujari_kiri').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        $('.btn_ibujari_kiri :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label; 
            if( input.strlen ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }  
        });
        $("[name='foto_ibujari_kanan']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.gambar_ibujari_kanan').attr("src",URL.createObjectURL(event.target.files[0]));
                upload();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        $('.btn_ibujari_kanan :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label; 
            if( input.strlen ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }  
        });
    	var tgl_lahir = $("input[name='tgl_lahir']").val();
    	$("input[name='umur_view']").val(getAge(tgl_lahir));
    	$("input[name='umur']").val(getAge(tgl_lahir));
		
		$("input[name='tgl_lahir']").change(function(){
        	$("input[name='umur_view']").val(getAge($(this).val()));
    		$("input[name='umur']").val(getAge($(this).val()));
        });    	
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");

        $(".perusahaan").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihperusahaan');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".pangkat").click(function(){
        	var id_gol = $("select[name='gol_pas']").val();
        	var url = "<?php echo site_url('pendaftaran/pilihpangkat');?>/"+id_gol;
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
        $(".cari_no").click(function(){
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $(".tmb_cari_no").click(function(){
            pencarian();
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
                    for(i=0; i<data.strlen; i++){
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
            var url = "<?php echo site_url('pendaftaran/cetak_rekmed');?>/"+no_pasien;
            openCenteredWindow(url)
        })
    });
    function getimage(){
        var no_pasien = $("input[name='no_pasien']").val();
        $.ajax({
            url: "<?php echo base_url();?>/pendaftaran/getfoto", 
            type: 'POST', 
            data:{no_pasien:no_pasien},
            success: function(result){
                var imgdata = JSON.parse(result);
                console.log(result);
                if (no_pasien==""){
                    image1 = "<?php echo base_url();?>img/default-image_450.png";
                    $(".gambar_kakikiri").attr('src', image1);
                    image2 ="<?php echo base_url();?>img/default-image_450.png";
                    $(".gambar_kakikanan").attr('src', image2);
                    image3 = "<?php echo base_url();?>img/default-image_450.png";
                    $(".gambar_ibujari_kiri").attr('src', image3);
                    image4 = "<?php echo base_url();?>img/default-image_450.png";
                    $(".gambar_ibujari_kanan").attr('src', image4);
                } else {
                    image1 = (imgdata["kakikiri"]==null || imgdata["kakikiri"]=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata["kakikiri"];
                    $(".gambar_kakikiri").attr('src', image1);
                    image2 = (imgdata["kakikanan"]==null || imgdata["kakikanan"]=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata["kakikanan"];
                    $(".gambar_kakikanan").attr('src', image2);
                    image3 = (imgdata["ibujari_kiri"]==null || imgdata["ibujari_kiri"]=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata["ibujari_kiri"];
                    $(".gambar_ibujari_kiri").attr('src', image3);
                    image4 = (imgdata["ibujari_kanan"]==null || imgdata["ibujari_kanan"]=="") ? "<?php echo base_url();?>img/default-image_450.png" : 'data:image/gif;base64,'+imgdata["ibujari_kanan"];
                    $(".gambar_ibujari_kanan").attr('src', image4);
                }
            }
        });
    }
    function pencarian(){
        var cari_no = $("[name='cari_no']").val();
        var html = "";
        $(".ljt").addClass("hide");
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no},
            url   : "<?php echo site_url('pendaftaran/sinkronpasien');?>",
            success : function(result){
                var value = JSON.parse(result);
                html += "<div class='clearfix'>&nbsp;</div>";
                html += "<table class='table table-stripped'>";
                html += "<tr class='bg-navy'><th>Nama</th><th>Tgl Lahir</th><th>Alamat</th></tr>";
                html += "<tr><td width='180px'>"+value.nama_pasien+"</td><td width='100px'>"+value.tgl_lahir+"</td><td>"+value.alamat+"</td></tr>";
                html += "</table>";
                if (value.nama_pasien!=null){
                    $(".ljt").removeClass("hide");
                    $("[name='hasil_no_rm']").val(value.no_pasien);
                    $("[name='hasil_nama_pasien']").val(value.nama_pasien);
                    $("[name='hasil_id_gol']").val(value.id_gol);
                }
                $(".hasil_cari").html(html);
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function prosessinkron(){
        var no_rm = $("[name='hasil_no_rm']").val();
        var no_reg = $("[name='idlama']").val();
        var nama_pasien = $("[name='hasil_nama_pasien']").val();
        var id_gol = $("[name='hasil_id_gol']").val();
        var html = "";
        $(".ljt").addClass("hide");
        $.ajax({
            type  : "POST",
            data  : {no_rm:no_rm,no_reg:no_reg,nama_pasien:nama_pasien,id_gol:id_gol},
            url   : "<?php echo site_url('pendaftaran/prosessinkron/ralan');?>",
            success : function(result){
                var ur = "<?php echo site_url('pendaftaran/addpasienbaru/n/n/n');?>/"+no_rm+"/"+no_reg;
                window.location = ur;
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function myFunction() {
		  // Get the checkbox
		  var checkBox = document.getElementById("myCheck");
		  // Get the output text
		  var text = document.getElementById("text");

		  // If the checkbox is checked, display the output text
		  if (checkBox.checked == true){
		    text.style.display = "block";
		  } else {
		    text.style.display = "none";
		  }
		}
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <?php if (strlen($idlama)>6):?>
        <div class="box-header">
            <button class="cari_no btn btn-sm btn-primary" type="button"><i class="fa fa-search"></i> Cari</button>
        </div>
        <?php endif ?>
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-horizontal">
                    <?php
                        echo form_open("pendaftaran/simpanpasienbaru/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
                        echo "<input type=hidden name='iskk' value='".$iskk."'>";
                        echo "<input type=hidden name='baru' value='".$baru."'>";
                        echo "<input type=hidden name='no_kk' value='".$no_kk."'>";
                        echo "<input type=hidden name='idlama' value='".$idlama."'>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. RM</label>
                        <div class="col-md-2">
                            <input type="text" readonly class="form-control" name='no_pasien' value="<?php echo $no_pasien;?>"/>
                        </div>
                        <label class="col-md-2 control-label">Tgl Daftar</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="tanggal" value="<?php echo $tanggal;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="nama_pasien" value="<?php echo $nama_pasien;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Agama</label>
                        <div class="col-md-9">
                            <select name ="agama" class="form-control">
                                <option <?php echo $ag1 ?> value = "ISLAM">ISLAM</option>
                                <option <?php echo $ag2 ?> value = "PROTESTAN">PROTESTAN</option>
                                <option <?php echo $ag3 ?> value = "KATOLIK">KATOLIK</option>
                                <option <?php echo $ag4 ?> value = "HINDU">HINDU</option>
                                <option <?php echo $ag5 ?> value = "BUDHA">BUDHA</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Gol.Pas</label>
                        <div class="col-md-9">
                            <select name="gol_pas" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php
                                    foreach ($k1->result() as $val1) {
                                        echo "
                                            <option value='".$val1->id_gol."' ".($gol_pas==$val1->id_gol ? "selected" : "").">".$val1->keterangan."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. BPJS / ASKES</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="no_bpjs" value="<?php echo $no_bpjs;?>">
                            <input type="hidden" class="form-control" required name="no_reg" value="<?php echo $no_reg;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Telpon</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="telpon" value="<?php echo $telpon;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">NIP/ NRP</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nip" value="<?php echo $nip;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">KTP</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ktp" value="<?php echo $ktp;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tgl.Lahir</label>
                        <div class="col-md-4">
                            <input type="hidden" name="umur" class="form-control" readonly>
                            <input type="text" id="age" name="umur_view" class="form-control" readonly>
                        </div>
                        <div class="col-md-5">
                            <input type="date" class="form-control" name="tgl_lahir" value='<?php echo $tgl_lahir?>' autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Kelamin</label>
                        <div class="col-md-9">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($q2->result() as $row){
                                        echo "<option value='".$row->jenis_kelamin."' ".($row->jenis_kelamin==$jenis_kelamin ? "selected" : "").">".$row->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nikah</label>
                        <div class="col-md-9">
                            <select name="status_kawin" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($kw->result() as $kawin){
                                        echo "<option value='".$kawin->kode."' ".($kawin->kode==$status_kawin ? "selected" : "").">".$kawin->nama."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Desa/Lurah</label>
                        <div class="col-md-7">
                            <input type="hidden" name="id_kelurahan" class="form-control" readonly value="<?php echo $id_kelurahan; ?>">
                            <input type="text" name="kelurahan" class="form-control" readonly value="<?php echo $nama_kelurahan; ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right">
                                <button class="desa btn btn-primary" type='button'>...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kecamatan</label>
                        <div class="col-md-7">
                            <input type="hidden" name="id_kecamatan" class="form-control" readonly value="<?php echo $id_kecamatan; ?>">
                            <input type="text" name="kecamatan" class="form-control" readonly value="<?php echo $nama_kecamatan; ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right">
                                <button class="kecamatan btn btn-primary" type='button'>...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kota/Kab</label>
                        <div class="col-md-7">
                            <input type="hidden" name="id_kota" class="form-control" readonly value="<?php echo $id_kota; ?>">
                            <input type="text" name="kota" class="form-control" readonly value="<?php echo $nama_kota; ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right">
                                <button class="kota btn btn-primary" type='button'>...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Provinsi</label>
                        <div class="col-md-7">
                            <input type="hidden" name="id_provinsi" class="form-control" readonly value="<?php echo $id_provinsi; ?>">
                            <input type="text" name="provinsi" class="form-control" readonly value="<?php echo $nama_provinsi; ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right">
                                <button class="provinsi btn btn-primary" type='button'>...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Negara</label>
                        <div class="col-md-9">
                            <select class="form-control" name="negara">
                                <option value="">--Pilih--</option>
                                <option value="INDONESIA" <?php if ($negara=="INDONESIA"): ?>
                                    selected
                                <?php endif ?>>Indonesia</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Suku</label>
                        <div class="col-md-9">
                            <select class="form-control" name="suku">
                                <option value="">--Pilih--</option>
                                <?php
                                    foreach ($s->result() as $sk) {
                                        echo "
                                            <option value='".$sk->suku."' ".($sk->suku==$suku ? "selected" : "").">".$sk->suku."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat Lengkap</label>
                        <div class="col-md-9">
                            <textarea name="alamat" cols="30" class="form-control"><?php echo $alamat;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pendidikan</label>
                        <div class="col-md-9">
                            <select name="pendidikan" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($q4->result() as $row){
                                        echo "<option value='".$row->idx."' ".($pendidikan==$row->idx ? "selected" : "").">".$row->pendidikan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Perusahaan</label>
                        <div class="col-md-5">
                            <input type="text" name="perusahaan" class="form-control" readonly value="<?php echo $nama_perusahaan ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="kode_perusahaan" class="form-control" readonly value="<?php echo $kode_perusahaan ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right">
                                <button class="perusahaan btn btn-primary" type='button'>...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pangkat</label>
                        <div class="col-md-5">
                            <input type="text" name="nama_pangkat" class="form-control" readonly value="<?php echo $nama_pangkat; ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="pangkat" class="form-control" readonly value="<?php echo $id_pangkat ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right">
                                <button class="pangkat btn btn-primary" type='button'>...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kesatuan</label>
                        <div class="col-md-5">
                            <input type="text" name="nama_kesatuan" class="form-control" readonly value="<?php echo $nama_kesatuan ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="kesatuan" class="form-control" readonly value="<?php echo $id_kesatuan ?>">
                        </div>
                        <div class="col-md-2">
                            <div class="pull-right">
                                <button class="pangkat btn btn-primary" type='button'>...</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Cabang</label>
                        <div class="col-md-9">
                            <select name="cabang" id="cabang" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php
                                    foreach ($k3->result() as $val1) {
                                        echo "
                                            <option value='".$val1->id_cabang."' ".($cabang_==$val1->id_cabang ? "selected" : "").">".$val1->keterangan."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ket. Cabang</label>
                        <div class="col-md-9">
                            <select name="ketcabang" id="ketcabang" class="ketcabang form-control">
                                <option value="">--Pilih--</option>
                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hub.Kel</label>
                        <div class="col-md-9">
                            <select name="hubungan_keluarga" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($h->result() as $hub){
                                        echo "<option value='".$hub->kode."' ".($hub->kode==$hubungan_keluarga ? "selected" : "").">".$hub->nama."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pekerjaan</label>
                        <div class="col-md-9">
                            <select name="pekerjaan" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($q5->result() as $row){
                                        echo "<option value='".$row->pekerjaan."' ".($row->pekerjaan==$pekerjaan ? "selected" : "").">".$row->pekerjaan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <input type="checkbox" id="myCheck" onclick="myFunction()" name="bayi"<?php echo $by ?> > 
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="bayi1" value="Bayi" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="coba" id="text" style="display:none">
        <div class="box box-primary" id="text">
            <div class="box-header"><h3 class="box-title">Identitas Bayi</h3></div>
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jam Lahir</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="jamlahir" value="<?php echo $jamlahir ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Berat Badan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="berat_badan" value="<?php echo $berat_badan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Panjang Badan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="panjang_badan" value="<?php echo $panjang_badan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kelahiran Ke</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kelahiran" value="<?php echo $kelahiran_ke ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tindakan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="tindakan" value="<?php echo $tindakan_bayi ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kembar</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kembar" value="<?php echo $kembar ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kelainan Bawaan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kelainan_bawaan" value="<?php echo $kelainan_bawaan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Kepala</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_kepala" value="<?php echo $lingkar_kepala ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Dada</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_dada" value="<?php echo $lingkar_dada ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Lengan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_lengan" value="<?php echo $lingkar_lengan ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lingkar Perut</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lingkar_perut" value="<?php echo $lingkar_perut ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3 class="box-title">Foto Telapak Tangan/Kaki Bayi</h3></div>
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label class="col-md-12 control-label">Telapak Kaki Kiri</label>
                                <div class="col-md-12">
                                    <div class="product-img">
                                        <img class="gambar_kakikiri img-thumbnail" style="width:100%" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="file-image">
                                        <div class="input-group">         
                                            <input type="hidden" name="sourcefoto_kakikiri"> 
                                            <input type="text" name="tempfoto" class="form-control" readonly>        
                                            <span class="input-group-btn">
                                                <span class="btn btn-warning btn-file btn_kakikiri"><i class="fa fa-folder-open"></i><input type="file" name="foto_kakikiri" id="foto_kakikiri" class="form-control"></span>
                                            </span>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label class="col-md-12 control-label">Telapak Kaki Kanan</label>
                                <div class="col-md-12">
                                    <div class="product-img">
                                        <img class="gambar_kakikanan img-thumbnail" style="width:100%" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="file-image">
                                        <div class="input-group">         
                                            <input type="hidden" name="sourcefoto_kakikkanan"> 
                                            <input type="text" name="tempfoto" class="form-control" readonly>        
                                            <span class="input-group-btn">
                                                <span class="btn btn-warning btn-file btn_kakikanan"><i class="fa fa-folder-open"></i><input type="file" name="foto_kakikanan" id="foto_kakikanan" class="form-control"></span>
                                            </span>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label class="col-md-12 control-label">Ibu Jari Kiri</label>
                                <div class="col-md-12">
                                    <div class="product-img">
                                        <img class="gambar_ibujari_kiri img-thumbnail" style="width:100%" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="file-image">
                                        <div class="input-group">         
                                            <input type="hidden" name="sourcefoto_ibujari_kiri"> 
                                            <input type="text" name="tempfoto" class="form-control" readonly>        
                                            <span class="input-group-btn">
                                                <span class="btn btn-warning btn-file btn_ibujari_kiri"><i class="fa fa-folder-open"></i><input type="file" name="foto_ibujari_kiri" id="foto_ibujari_kiri" class="form-control"></span>
                                            </span>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label class="col-md-12 control-label">Ibu Jari Kanan</label>
                                <div class="col-md-12">
                                    <div class="product-img">
                                        <img class="gambar_ibujari_kanan img-thumbnail" style="width:100%" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="file-image">
                                        <div class="input-group">         
                                            <input type="hidden" name="sourcefoto_kakikkanan"> 
                                            <input type="text" name="tempfoto" class="form-control" readonly>        
                                            <span class="input-group-btn">
                                                <span class="btn btn-warning btn-file btn_ibujari_kanan"><i class="fa fa-folder-open"></i><input type="file" name="foto_ibujari_kanan" id="foto_ibujari_kanan" class="form-control"></span>
                                            </span>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Identitas Pasangan/ Orangtua</h3></div>
        <div class="box-body">
            <div class="col-xs-12">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Suami/ Ayah</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_pasangan" value="<?php echo $nama_pasangan;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tanggal Lahir Suami/ Ayah</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="tgllahir_ayah" value="<?php echo $tgllahir_ayah;?>" placeholder="00-00-0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pekerjaan Suami/ Ayah</label>
                        <div class="col-md-10">
                            <select name="pekerjaan_ayah" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($q5->result() as $row){
                                        echo "<option value='".$row->pekerjaan."' ".($row->pekerjaan==$pekerjaan_ayah ? "selected" : "").">".$row->pekerjaan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">NIK Suami/ Ayah</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nikpasangan" value="<?php echo $nikpasangan;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Istri/ Ibu</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="ibu" value="<?php echo $ibu;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tanggal Lahir Istri/ Ibu</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="tgllahir_ibu" value="<?php echo $tgllahir_ibu;?>" placeholder="00-00-0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pekerjaan Istri/ Ibu</label>
                        <div class="col-md-10">
                            <select name="pekerjaan_ibu" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($q5->result() as $row){
                                        echo "<option value='".$row->pekerjaan."' ".($row->pekerjaan==$pekerjaan_ibu ? "selected" : "").">".$row->pekerjaan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">NIK Ibu</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nikibu" value="<?php echo $nikibu;?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php if (strlen($idlama)>6):?>
            <button class="cari_no btn btn-sm btn-primary" type="button"><i class="fa fa-search"></i> Cari</button>
            <?php endif ?>
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="<?php echo $hidden; ?> cetak btn btn-success" type="button"><i class="fa fa-save"></i> Cetak</button>
                    <button class="cancel btn btn-danger" type="button"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<div class='modal modal_cari_no no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_no" placeholder="No. KTP/ No. BPJS/ No. SEP"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_no btn btn-success">Cari</button>
                                </span>
                            </div>
                            <div class="hasil_cari"></div>
                            <div class="ljt hide">
                            	<div class="pull-right"> 
                                	<input type="hidden" name="hasil_no_rm"/>
                                    <input type="hidden" name="hasil_nama_pasien"/>
                                    <input type="hidden" name="hasil_id_gol"/>
                                	<button class="lanjut btn btn-success">Lanjutkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</style>