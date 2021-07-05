<?php
    if ($row){
        $tanggal            = date("d-m-Y");
        $nama_pasien        = $row->nama_pasien;
        $no_pasien          = $row->no_pasien;
        $id_gol             = $row->id_gol;
        $id_gol_ket         = $row->keterangan;
        $no_bpjs            = $row->no_bpjs;
        $perusahaan         = $row->perusahaan;       
        $kode_p             = $row->kode_perusahaan;
        $tujuan_poli        = $row->tujuan_poli;
        $nama_poli          = $row->nama_poli;
        $dokter_pengirim    = $row->dokter_pengirim=="" ? $q->dokter_poli : $row->dokter_pengirim;
        $nama_dokter_pengirim    = (isset($dok_all[$dokter_pengirim]) ? $dok_all[$dokter_pengirim] : "---");
        $status_pasien      = $row->status_pasien;
        $jenis              = $row->jenis;
        $dokter_poli        = $row->dokter_poli;
        $nama_dokter        = $row->nama_dokter;
        $diagnosa        = $row->diagnosa;
        $action             = "edit";
        $hide               = "hide";
        $h                  = "";
        $nomor_reg          = $reg_baru;
        $r                  = "disabled";
    } else {
        $nomor_reg          = $no_reg;
        $nama_pasien        = $pasien->nama_pasien;
        $id_gol             = $pasien->id_gol;
        $id_gol_ket         = $pasien->keterangan;
        $no_bpjs            = $pasien->no_bpjs;
        $perusahaan         = $pasien->perusahaan;
        $kode_p             = $pasien->kode_perusahaan;
        $tanggal            = date("d-m-Y");
        $status_pasien      = 
        $jenis              =
        $tujuan_poli        =
        $nama_poli          =
        $dokter_pengirim    = $q->dokter_poli;
        $nama_dokter_pengirim    = (isset($dok_all[$q->dokter_poli]) ? $dok_all[$q->dokter_poli] : "---");
        $action             = "simpan";
        $diagnosa           = "";
        $hide               = "";
        $h                  = "hide";
        $r                  = "";
    }
    // echo $action;
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
        gettotal();
        $("[name='tindakan']").change(function(){
            var no_reg= $("[name='no_reg_baru']").val();
            var jenis= $("[name='jenis']").val();
            var tindakan= $(this).val();
            var dokter_radiologi= $("[name='dokter']").val();
            var radiografer= $("[name='petugas_radiologi']").val();
            var ukuran_foto= $("[name='ukuran_foto']").val();
            var no_foto= $("[name='no_foto']").val();
            var dokter_pengirim= $("[name='pengirim']").val();
            var diagnosa= $("[name='diagnosa']").val();
            $.ajax({
                url : "<?php echo base_url();?>radiologi/addtindakan",
                method : "POST",
                data : {no_reg: no_reg, jenis: jenis, tindakan: tindakan,dokter_radiologi:dokter_radiologi,radiografer:radiografer,nofoto:no_foto,ukuranfoto:ukuran_foto,dokter_pengirim:dokter_pengirim,diagnosa:diagnosa},
                success: function(data){
                     location.reload();
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        $('.hapusrad').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>radiologi/hapusralan",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
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
        $("select[name='tindakan']").select2();
        // $("[name='dokter_poli'], .tindakan").select2();
        $(".perusahaan").click(function(){
        	var url = "<?php echo site_url('pendaftaran/pilihpoli');?>";
        	openCenteredWindow(url);
            return false;
        });
        $(".tujuan").click(function(){
            $("#select").empty();
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
        $(".cancel").click(function(){
            var no_reg = $("input[name='no_reg']").val();
            window.location = "<?php echo site_url('pendaftaran/batalkonsul');?>/"+no_reg;

            // alert(no_reg);
        })
        $(".back").click(function(){
            window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
        })
        $(".cetak").click(function(){
        	var no_pasien = $("input[name='no_pasien']").val();
            var url = "<?php echo site_url('pendaftaran/cetakpasien');?>/"+no_pasien;
            openCenteredWindow(url)
        })
        $(".tindakan").select2();
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>pendaftaran/hapustindakanlab",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $("[name='disc_persen']").keyup(function(evt){
            var subtotal = parseInt($("[name='subtotal']").val().replace(/\D/g,''));
            var disc_persen = parseFloat($(this).val());
            disc_nominal = number_format(disc_persen*subtotal/100,0,',','.');
            $("[name='disc_nominal']").val(disc_nominal);
            gettotal();
            return false;
        });
        $("[name='disc_nominal']").keyup(function(evt){
            if ($(this).val()=="") $("[name='disc_persen']").val("0");
            else {
                var subtotal = parseInt($("[name='subtotal']").val().replace(/\D/g,''));
                var disc_nominal = parseInt($(this).val().replace(/\D/g,''));
                disc_persen = (disc_nominal/subtotal)*100;
                $("[name='disc_persen']").val(disc_persen.toFixed(2));
            }
            gettotal();
            return false;
        });
        $("[name='sharing']").keyup(function(evt){
            gettotal();
            return false;
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('id');
            var dataContent = dataText.text().trim();
            var jenis;
            if (dataText.hasClass("petugas")){
                jenis = "petugas";
            } else 
            if (dataText.hasClass("analys")){
                jenis = "analys";
            } else 
            if (dataText.hasClass("dokter_pengirim")){
                jenis = "dokter_pengirim";
            }
            if (jenis=='petugas'){
                var id_dokter = dataText.attr('id_dokter');
                var result = getdokter(id_dokter);
                var dataInputField = $(result);
            }
            else
            if (jenis=='analys'){
                var analys = dataText.attr('analys');
                var result = getanalys(analys);
                var dataInputField = $(result);
            }
            else
            if (jenis=='dokter_pengirim'){
                var dokter_pengirim = dataText.attr('id_dokter');
                var result = getdokter_pengirim(dokter_pengirim);
                var dataInputField = $(result);
            }
            else
                var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataText.before(dataInputField).hide();
            dataText.before(dataInputField).hide();
            if (jenis=='petugas' || jenis=='analys' || jenis=='dokter_pengirim'){
                dataInputField.select2();
                dataInputField.focus().select().change(function(){
                    var inputval = dataInputField.val()
                    changeData(inputval,kode,jenis);
                    $(this).remove();
                    dataText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        var inputval = dataInputField.val()
                        changeData(inputval,kode,jenis);
                        $(this).remove();
                        dataText.show();
                    }
                });
            } else {
                dataInputField.focus().blur(function(){
                    var inputval = dataInputField.val().replace(/\D/g,'');
                    changeData(inputval,kode);
                    $(this).remove();
                    dateText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        var inputval = dataInputField.val().replace(/\D/g,'');
                        changeData(inputval,kode);
                        $(this).remove();
                        dateText.show();
                    }
                });
            }
        });
    });
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var sharing = $("[name='sharing']").val().replace(/\D/g,'');
        var total = subtotal-disc_nominal-sharing;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    var changeData = function(value,id,jenis){
        $.ajax({
            url: "<?php echo site_url('lab/changedata_ralan');?>", 
            type: 'POST', 
            data: {id: id,value: value, jenis: jenis}, 
            success: function(){
                location.reload();
            }
        });
    };
    function getdokter(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('lab/getdokter');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='petugas' class='selectpetugas form-control'>";
                html += "<option value=''>---Pilih Petugas/Dokter---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.id_dokter+"' "+(val==value.id_dokter ? "selected" : "")+">"+value.nama_dokter+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getdokter_pengirim(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('lab/getdokterall');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='dokter_pengirim' class='selectpengirim form-control'>";
                html += "<option value=''>---Pilih Petugas/Dokter---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.id_dokter+"' "+(val==value.id_dokter ? "selected" : "")+">"+value.nama_dokter+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getanalys(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('lab/getanalys');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='analys' class='selectpetugas form-control'>";
                html += "<option value=''>---Pilih Analys---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.nip+"' "+(val==value.nip ? "selected" : "")+">"+value.nama+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function number_format (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }


</script>
<div class="col-md-12">
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
        if($q1->num_rows()>0){
            $data = $q1->row();
            $disc_nominal = $data->jumlah_disc;
            $sharing = $data->jumlah_sharing;
            $total = $data->jumlah_bayar;
            $disc_persen = round($disc_nominal/($disc_nominal+$sharing+$total),2)*100;
            // $disabled = "disabled";
            $disabled = "";
            $disabled_print = "";
            $tgl_pembayaran = "Tanggal pembayaran -> ".date("d-m-Y",strtotime($data->tanggal));
        } else {
            $disc_nominal = $sharing = $total = $disc_persen = 0;
            $disabled = $tgl_pembayaran = "";
            $disabled_print = "disabled";
        }
    ?>
    <div class="box box-primary">
        <div class="box-body">
        	<div class="col-md-12">
        		<div class="form-horizontal">
    	            <?php
    	                echo form_open("pendaftaran/simpankonsul/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
                    ?>
    	            <div class="form-group">
    	            	<label class="col-md-2 control-label">No. Reg</label>
    	                <div class="col-md-4">
    	                    <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
    	                </div>
    	                <label class="col-md-2 control-label">Tanggal Daftar</label>
    	                <div class="col-md-4">
    	                	<input type="text" class="form-control" name="tanggal" value="<?php echo $tanggal;?>" <?php echo $r; ?>>
    	                </div>
    	            </div>
    	            <div class="form-group">
    	            	<label class="col-md-2 control-label">No. RM</label>
    	                <div class="col-md-10">
    	                    <input type="text" class="form-control" required name="no_pasien" readonly value="<?php echo $id;?>">
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
    	                    <input type="text" class="form-control" readonly name="tujuan" value="<?php echo $tujuan_poli ?>">
    	                </div>
    	                <div class="col-md-2">
    	                    <input type="text" class="form-control" readonly name="kode_tujuan" value="<?php echo $nama_poli ?>">
    	                </div>
    	                  <div class="col-md-1">
    	                    <button class="tujuan btn btn-primary" type='button'>...</button>
    	                </div>
    	            </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Diagnosa</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="diagnosa" value="<?php echo $diagnosa ?>">
                        </div>
                    </div>
                    <?php if ($action=="simpan"): ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Dokter Tujuan</label>
                            <div class="col-md-10">
                                <select class="form-control" name="dokter_poli" id="select">
                                    <option>---Pilih---</option>
                                </select>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Dokter Tujuan</label>
                            <div class="col-md-4">
                                <input type="text" name="dokter_poli" value="<?php echo $dokter_poli ?>" class='form-control' readonly>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="nama_dokter" value="<?php echo $nama_dokter ?>" class='form-control' readonly>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Status</label>
                        <div class="col-md-10">
                            <select class="form-control" name="status_pasien">
                                <option value="LAMA" <?php if ($status_pasien=="LAMA"): ?>
                                    selected
                                <?php endif ?>>LAMA</option>
                                <option value="BARU" <?php if ($status_pasien=="BARU"): ?>
                                    selected
                                <?php endif ?>>BARU</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kelas</label>
                        <div class="col-md-10">
                            <select class="form-control" name="jenis">
                                <option value="R" <?php if ($jenis=="R"): ?>
                                    selected
                                <?php endif ?>>Reguler</option>
                                <option value="E" <?php if ($jenis=="E"): ?>
                                    selected
                                <?php endif ?>>Executive</option>
                            </select>
                        </div>
                    </div>
    	            <div class="form-group">
    	            	<label class="col-md-2 control-label">No Reg Sebelumnya</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" readonly name="no_reg_sebelumnya" value="<?php echo $reg_sebelumnya ?>">
                        </div>
    	                <div class="col-md-4">
    	                    <input type="text" class="form-control" readonly name="poli" value="<?php echo $q->keterangan ?>">
    	                </div>
    	                <div class="col-md-3">
    	                    <input type="text" class="form-control" readonly name="kode_poli" value="<?php echo $q->tujuan_poli ?>">
    	                </div>
    	            </div>
    	            <div class="form-group">
    	            	<label class="col-md-2 control-label">Dokter Pengirim</label>
    	                <div class="col-md-7">
    	                    <input type="text" class="form-control" readonly name="dokter" autocomplete='off' value="<?php echo $nama_dokter_pengirim ?>">
    	                </div>
    	                <div class="col-md-2">
    	                    <input type="text" class="form-control" readonly name="kode_dokter" class="form-control" value="<?php echo $dokter_pengirim ?>">
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
                    <button class="btn btn-primary <?php echo $hide ?>" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="cancel btn btn-danger" type="button"><i class="fa fa-times"></i> Batal</button>
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
    <?php if ($tujuan_poli=="0102034"): ?>
        <div class="box box-primary <?php echo $h ?>">
            <div class="box-body">
                <table class="table table-bordered table-hover " id="myTable" >
                    <thead>
                        <tr class="bg-navy">
                            <th width="10" class='text-center'>No</th>
                            <th class="text-center">Tarif</th>
                            <!-- <th class="text-center">Petugas</th>
                            <th class="text-center">Analys</th>
                            <th class="text-center">Dok. Pengirim</th> -->
                            <th class='text-center'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $subtotal = 0;
                            foreach($k2->result() as $data){
                                $subtotal += $data->jumlah;
                                echo "<tr>";
                                echo "<td>".$i++."</td>";
                                echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                                // echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---")."</td>";
                                // echo "<td class='text-left'>".(isset($analys[$data->analys]) ? $analys[$data->analys] : "---")."</td>";
                                // echo "<td class='text-left'>".(isset($dp[$data->dokter_pengirim]) ? $dp[$data->dokter_pengirim] : "---")."</td>";
                                echo "<td class='text-right'><a href='#' class='dataChange' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th>
                            <th style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th>
                        </tr>
                        <tr>
                            <th colspan="2" style="vertical-align: middle" ><span class="pull-right">Disc</span></th>
                            <th width="250px" style="vertical-align: middle" >
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" name="disc_persen" class="form-control text-right" value="<?php echo $disc_persen;?>">
                                    </div>
                                    <div class="col-sm-7">  
                                        <input type="text" name="disc_nominal" class="form-control text-right" value="<?php echo number_format($disc_nominal,0,',','.');?>">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <?php if ($row->status_bayar=="TAGIH"): ?>
                            <tr>
                                <th colspan="2" style="vertical-align: middle" ><span class="pull-right">Sharing</span></th>
                                <th style="vertical-align: middle" ><input type="text" readonly name="sharing" class="form-control text-right" value="<?php echo number_format($sharing,0,',','.');?>"></th>
                            </tr>
                        <?php else: ?>
                            <input type="hidden" name="sharing">
                        <?php endif ?>
                        <tr>
                            <th colspan="2" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th>
                            <th style="vertical-align: middle" >
                                <input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>">
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                <?php echo form_open("pendaftaran/tambahtindakan",array("id"=>"formsave","class"=>"form-horizontal"));?>
                                    <input type="hidden" name='no_reg' readonly value="<?php echo $reg_baru;?>"/>
                                    <input type="hidden" name='reg_sebelumnya' readonly value="<?php echo $reg_sebelumnya;?>"/>
                                    <input type="hidden" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                                    <input type="hidden" name="jenis" value="<?php echo $row->jenis;?>">
                                    <input type="hidden" name="diagnosa" value="<?php echo $diagnosa;?>">
                                    <input type="hidden" name='dokter' />
                                    <input type="hidden" name='dokter_pengirim'/>
                                    <input type="hidden" name='analys'/>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <select class="form-control tindakan" name="tindakan[]" multiple="multiple">
                                                <?php 
                                                    foreach ($t2->result() as $key) {
                                                        echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                                                    }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                <?php echo form_close();?>   
                            </td>
                            <td width="150" class='text-center'></td>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if ($tujuan_poli=="0102024"): ?>
        <div class="box box-primary <?php echo $h ?>">
            <div class="box-body">
                <table class="table table-bordered table-hover " id="myTable" >
                    <thead>
                        <tr class="bg-navy">
                            <th width="10" class='text-center'>No</th>
                            <th class="text-center">Tarif</th>
                            <th class="text-center">Petugas</th>
                            <th class="text-center">Analys</th>
                            <th class="text-center">Dok. Pengirim</th>
                            <th class='text-center'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $subtotal = 0;
                            foreach($k->result() as $data){
                                $subtotal += $data->jumlah;
                                echo "<tr>";
                                echo "<td>".$i++."</td>";
                                echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                                echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---")."</td>";
                                echo "<td class='text-left'>".(isset($analys[$data->analys]) ? $analys[$data->analys] : "---")."</td>";
                                echo "<td class='text-left'>".(isset($dp[$data->dokter_pengirim]) ? $dp[$data->dokter_pengirim] : "---")."</td>";
                                echo "<td class='text-right'><a href='#' class='dataChange' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th>
                            <th style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="vertical-align: middle" ><span class="pull-right">Disc</span></th>
                            <th width="250px" style="vertical-align: middle" >
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" name="disc_persen" class="form-control text-right" value="<?php echo $disc_persen;?>">
                                    </div>
                                    <div class="col-sm-7">  
                                        <input type="text" name="disc_nominal" class="form-control text-right" value="<?php echo number_format($disc_nominal,0,',','.');?>">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <?php if ($row->status_bayar=="TAGIH"): ?>
                            <tr>
                                <th colspan="5" style="vertical-align: middle" ><span class="pull-right">Sharing</span></th>
                                <th style="vertical-align: middle" ><input type="text" readonly name="sharing" class="form-control text-right" value="<?php echo number_format($sharing,0,',','.');?>"></th>
                            </tr>
                        <?php else: ?>
                            <input type="hidden" name="sharing">
                        <?php endif ?>
                        <tr>
                            <th colspan="5" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th>
                            <th style="vertical-align: middle" >
                                <input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>">
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                                <?php echo form_open("pendaftaran/tambahtindakan",array("id"=>"formsave","class"=>"form-horizontal"));?>
                                    <input type="hidden" name='no_reg' readonly value="<?php echo $reg_baru;?>"/>
                                    <input type="hidden" name='reg_sebelumnya' readonly value="<?php echo $reg_sebelumnya;?>"/>
                                    <input type="hidden" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                                    <input type="hidden" name="jenis" value="<?php echo $row->jenis;?>">
                                    <input type="hidden" name="diagnosa" value="<?php echo $diagnosa;?>">
                                    <input type="hidden" name='dokter'  value="<?php echo $dokter_poli ?>"/>
                                    <input type="hidden" name='dokter_pengirim'   value="<?php echo $dokter_pengirim ?>"/>
                                    <input type="hidden" name='analys'/>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <select class="form-control tindakan" name="tindakan[]" multiple="multiple">
                                                <?php 
                                                    foreach ($t->result() as $key) {
                                                        echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                                                    }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                <?php echo form_close();?>   
                            </td>
                            <td width="150" class='text-center'></td>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if ($tujuan_poli=="0102025"): ?>
        <input type="hidden" name='no_reg_baru' readonly value="<?php echo $reg_baru;?>"/>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-hover " id="myTable" >
                    <thead>
                        <tr class="bg-navy">
                            <th width="10" class='text-center'>No</th>
                            <th class="text-center">Tarif</th>
                            <th class="text-center">Dokter</th>
                            <th class="text-center">Radiografer</th>
                            <th class="text-center">No Foto</th>
                            <th class="text-center">Uk Foto</th>
                            <th class="text-center">Dok. Pengirim</th>
                            <th class='text-center'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $subtotal = 0;
                            foreach($k1->result() as $data){
                                $subtotal += $data->jumlah;
                                echo "<tr>";
                                echo "<td>".$i++."</td>";
                                echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapusrad btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                                echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---")."</td>";
                                echo "<td class='text-left'>".(isset($radiografer[$data->analys]) ? $radiografer[$data->analys] : "---")."</td>";
                                echo "<td class='text-right'>".($data->nofoto=="" ? "---" : $data->nofoto)."</td>";
                                echo "<td class='text-right'>".($data->ukuranfoto=="" ? "---" : $data->ukuranfoto)."</td>";
                                echo "<td class='text-left'>".(isset($dp[$data->dokter_pengirim]) ? $dp[$data->dokter_pengirim] : "---")."</td>";
                                echo "<td class='text-right'><a href='#' class='dataChange' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th>
                            <th style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th>
                        </tr>
                        <tr>
                            <th colspan="7" style="vertical-align: middle" ><span class="pull-right">Disc</span></th>
                            <th width="250px" style="vertical-align: middle" >
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" name="disc_persen" class="form-control text-right" value="<?php echo $disc_persen;?>">
                                    </div>
                                    <div class="col-sm-7">  
                                        <input type="text" name="disc_nominal" class="form-control text-right" value="<?php echo number_format($disc_nominal,0,',','.');?>">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <?php if ($row->status_bayar=="TAGIH"): ?>
                            <tr>
                                <th colspan="7" style="vertical-align: middle" ><span class="pull-right">Sharing</span></th>
                                <th style="vertical-align: middle" ><input type="text" readonly name="sharing" class="form-control text-right" value="<?php echo number_format($sharing,0,',','.');?>"></th>
                            </tr>
                        <?php else: ?>
                            <input type="hidden" name="sharing">
                        <?php endif ?>
                        <tr>
                            <th colspan="7" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th>
                            <th style="vertical-align: middle" >
                                <input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>">
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="box-footer">
                <div class="col-sm-5">
                    <select class="form-control" name="tindakan">
                        <option value="">---Pilih Tindakan---</option>
                        <?php 
                            foreach ($t1->result() as $key) {
                                echo '<option value="'.$key->id_tindakan.'">'.$key->nama_tindakan.'</option>';
                            }
                        ?>
                    </select>    
                </div>
            </div>
        </div>
    <?php else: ?>
        <input type="hidden" name="subtotal">
        <input type="hidden" name="disc_nominal">
        <input type="hidden" name="sharing">
    <?php endif ?>
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