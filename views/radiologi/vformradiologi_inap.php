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
        $("[name='bayarsharing'], [name='disc_nominal'], [name='sharing']").mask('000.000.000', {reverse: true});
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");
        $("[name='tindakan']").change(function(){
            var asal= $("[name='asal']").val();
            var no_reg= $("[name='no_reg']").val();
            var kode_kelas= $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var pemeriksaan= $("[name='pemeriksaan']").val();
            var dokter_radiologi= $("[name='dokter_radiologi']").val();
            var radiografer= $("[name='radiografer']").val();
            var dokter_pengirim= $("[name='pengirim']").val();
            var diagnosa= $("[name='diagnosa']").val();
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>radiologi/addtindakan_inap",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan,tanggal: tanggal, pemeriksaan: pemeriksaan,dokter_radiologi:dokter_radiologi,radiografer:radiografer,dokter_pengirim:dokter_pengirim,diagnosa:diagnosa,asal:asal},
                success: function(data){
                     location.reload();
                }
            });
        });
        // $('.back').click(function(){
        //     window.location = "<?php echo site_url('radiologi/inap');?>";
        // });
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_noreg:cari_noreg},
                url   : "<?php echo site_url('radiologi/cari_radiologiinap');?>",
                success : function(result){
                    window.location = "<?php echo site_url('radiologi/inap');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.search').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var no_pasien= $("[name='no_rm']").val();
            var tanggal = $("input[name='tanggal']").val();
            window.location = "<?php echo site_url('radiologi/detailradiologi_inap');?>/"+no_pasien+"/"+no_reg+"/"+tanggal;
        });
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            $("[name='idhapus']").val(id);
            $(".modalhapus").modal("show");
        });
        $('.yahapus').click(function(){
            var id= $("[name='idhapus']").val();
            var username= $("[name='username']").val();
            var password= $("[name='password']").val();
            $.ajax({
                url : "<?php echo base_url();?>radiologi/cekusername",
                method : "POST",
                data : {username: username,password: password},
                success: function(data){
                    if (data=="true"){
                        hapus(id,username);
                    } else {
                        alert("Username dan password salah !!!");
                    }
                }
            });
        });
        $(".cetakbarcode").click(function(){
            var no_rm  = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url    = "<?php echo site_url('pendaftaran/cetakbarcode_inap');?>/"+no_rm+"/"+no_reg+"/"+"RADIOLOGI";
            openCenteredWindow(url);
            return false;
        });
        $('.okbayar').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var subtotal= $("[name='subtotal']").val().replace(/\D/g,'');
            var disc_nominal= $("[name='disc_nominal']").val().replace(/\D/g,'');
            var sharing= $("[name='sharing']").val().replace(/\D/g,'');
            var total= $("[name='total']").val().replace(/\D/g,'');
            $.ajax({
                url : "<?php echo base_url();?>kasir/simpantransaksi",
                method : "POST",
                data : {no_reg: no_reg,disc_nominal: disc_nominal, sharing: sharing, total: total},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
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
        $("[name='tindakan']").select2();
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('id');
            if (dataText.hasClass("jumlah")){
                var jenis = "jumlah";
            } else
            if (dataText.hasClass("nofoto")){
                var jenis = "nofoto";
            } else
            if (dataText.hasClass("ukuranfoto")){
                var jenis = "ukuranfoto";
            } else
            if (dataText.hasClass("nofoto1")){
                var jenis = "nofoto1";
            } else
            if (dataText.hasClass("ukuranfoto1")){
                var jenis = "ukuranfoto1";
            } else
            if (dataText.hasClass("petugas")){
                jenis = "petugas";
            }  else
            if (dataText.hasClass("kali")){
                jenis = "kali";
            } else
            if (dataText.hasClass("dokter_pengirim")){
                jenis = "dokter_pengirim";
            } else
            if (dataText.hasClass("radiografer")){
                jenis = "radiografer";
            } else
            if (dataText.hasClass("diagnosa")){
                jenis = "diagnosa";
            }  else
            if (dataText.hasClass("asal")){
                jenis = "asal";
            }
            if (jenis=='petugas'){
                var id_dokter = dataText.attr('id_dokter');
                var result = getdokter(id_dokter);
                var dataInputField = $(result);
            } else
            if (jenis=='dokter_pengirim'){
                var id_dokter = dataText.attr('id_dokter');
                var result = getdokter_pengirim(id_dokter);
                var dataInputField = $(result);
            } else
            if (jenis=='radiografer'){
                var radiografer = dataText.attr('radiografer');
                var result = getradiografer(radiografer);
                var dataInputField = $(result);
            } else
            if (jenis=='asal'){
                var asal = dataText.attr('asal');
                var result = getasal(asal);
                var dataInputField = $(result);
            } else
            if (jenis=='ukuranfoto'){
                var ukuranfoto = dataText.attr('ukuranfoto');
                var result = getukuranfoto(ukuranfoto);
                var dataInputField = $(result);
            } else
            if (jenis=='ukuranfoto1'){
                var ukuranfoto1 = dataText.attr('ukuranfoto1');
                var result = getukuranfoto1(ukuranfoto1);
                var dataInputField = $(result);
            } else
            if (jenis=='kali'){
                var kali = dataText.attr('kali');
                var result = getkali(kali);
                var dataInputField = $(result);
            }
            else
                var dataContent = dataText.text().trim();
            dataText.before(dataInputField).hide();
            if (jenis=='petugas' || jenis=='radiografer' || jenis=='dokter_pengirim' || jenis=='asal'  || jenis=='ukuranfoto'  || jenis=='ukuranfoto1' || jenis=='kali'){
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
                var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
                dataText.before(dataInputField).hide();
                dataInputField.focus().blur(function(){
                    if (jenis=="jumlah")
                        var inputval = dataInputField.val().replace(/\D/g,'');
                    else
                       var inputval = dataInputField.val();
                    changeData(inputval,kode,jenis);
                    $(this).remove();
                    dateText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        if (jenis=="jumlah")
                            var inputval = dataInputField.val().replace(/\D/g,'');
                        else
                            var inputval = dataInputField.val();
                        changeData(inputval,kode,jenis);
                        $(this).remove();
                        dateText.show();
                    }
                });
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $("[name='pengirim']").select2();
    });
    function hapus(id,username){
        $.ajax({
            url : "<?php echo base_url();?>radiologi/hapusinap",
            method : "POST",
            data : {id: id,username:username},
            success: function(data){
                 location.reload();
            }
        });
    }
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var sharing = $("[name='sharing']").val().replace(/\D/g,'');
        var total = subtotal-disc_nominal-sharing;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    var changeData = function(value,id,jenis){
        var no_reg= $("[name='no_reg']").val();
        $.ajax({
            url: "<?php echo site_url('radiologi/changedata');?>/"+jenis,
            type: 'POST',
            data: {id: id,value: value,no_reg:no_reg},
            success: function(){
                location.reload();
            }
        });
    };
    function getdokter(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('radiologi/getdokter_radiologi');?>",
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
    function getasal(val){
        var result = false;
        $.ajax({
            url: location.href,
            type: 'POST',
            async: false,
            success: function(data){
                var html = "<select name='asal' class='selectpetugas form-control'>";
                html += "<option value=''>---Pilih Asal---</option>";
                html += "<option value='DR'>DR</option>";
                html += "<option value='MANUAL'>MANUAL</option>";
                // $.each(JSON.parse(data), function(key, value){
                //     html += "<option value='"+value.nip+"' "+(val==value.nip ? "selected" : "")+">"+value.nama+"</option>";
                // })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getukuranfoto(val){
        var result = false;
        // var asal= $("[name='asal']").val('asal');
        var ukuranfoto = $("[name='ukuranfoto']").val('ukuranfoto');
        $.ajax({
            url: "<?php echo site_url('radiologi/getukuranfoto');?>",
            type: 'POST',
            async: false,
            success: function(data){
                var html = "<select name='ukuranfoto' class='selectpetugas form-control'>";
                    html += "<option value=''>---Pilih Ukuran Foto---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.ukuranfoto+"' "+(val==value.ukuranfoto ? "selected" : "")+">"+value.ukuranfoto+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getukuranfoto1(val){
        var result = false;
        // var asal= $("[name='asal']").val('asal');
        var ukuranfoto1 = $("[name='ukuranfoto1']").val('ukuranfoto1');
        $.ajax({
            url: "<?php echo site_url('radiologi/getukuranfoto');?>",
            type: 'POST',
            async: false,
            success: function(data){
                var html = "<select name='ukuranfoto1' class='selectpetugas form-control'>";
                    html += "<option value=''>---Pilih Ukuran Foto---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.ukuranfoto+"' "+(val==value.ukuranfoto ? "selected" : "")+">"+value.ukuranfoto+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getkali(val){
        var result = false;
        $.ajax({
            url: location.href,
            type: 'POST',
            async: false,
            success: function(data){
                var html = "<select name='kali' class='selectkali form-control'>";
                html += "<option value=''>---Berapa Kali---</option>";
                // $.each(JSON.parse(data), function(key, value){
                //     html += "<option value='"+value.id_dokter+"' "+(val==value.id_dokter ? "selected" : "")+">"+value.nama_dokter+"</option>";
                // })
                for (let index = 1; index <= 10; index++) {
                    html += "<option value='"+index+"'>"+index+"</option>";
                }
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getdokter_pengirim(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('radiologi/getdokter');?>",
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
    function getradiografer(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('radiologi/getradiografer');?>",
            type: 'POST',
            async: false,
            success: function(data){
                var html = "<select name='radiografer' class='selectpetugas form-control'>";
                html += "<option value=''>---Pilih Radiografer---</option>";
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
<?php
    if($q->num_rows()>0){
        $data = $q->row();
        $disc_nominal = $data->jumlah_disc;
        $sharing = $data->jumlah_sharing;
        $total = $data->jumlah_bayar;
        $disc_persen = round($disc_nominal/($disc_nominal+$sharing+$total),2)*100;
        // $disabled = "disabled";
        $disabled = "";
        $disabled_print = "";
        $tgl_pembayaran = "Tanggal pembayaran -> ".date("d-m-Y",strtotime($data->tanggal));
        $aksi = "edit";
    } else {
        $aksi = "simpan";
        $disc_nominal = $sharing = $total = $disc_persen = 0;
        $disabled = $tgl_pembayaran = "";
        $disabled_print = "disabled";
    }
?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php
                 // echo form_open("radiologi/simpandetail_inap/".$aksi,array("id"=>"formsave","class"=>"form-horizontal"));
            ?>
        	<div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_ruangan' readonly value="<?php echo $row->nama_ruangan;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="hidden" readonly class="form-control" name='kode_kelas' readonly value="<?php echo $row->kode_kelas;?>"/>
                        <input type="text" readonly class="form-control" name='nama_kelas' readonly value="<?php echo $row->nama_kelas;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kamar</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='kode_kamar' readonly value="<?php echo $row->kode_kamar;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Dokter Radiologi</label>
                    <div class="col-md-2">
                        <select class="form-control" name="dokter_radiologi">
                            <?php
                                foreach ($d->result() as $dk) {
                                    echo "
                                        <option value='".$dk->id_dokter."' ".($dk->id_dokter==$row->dokter_poli ? "selected" : "")." data-id='".$dk->radiologi."'>".$dk->nama_dokter."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-1 control-label">Radiografer</label>
                    <div class="col-md-2">
                        <select class="form-control" name="radiografer">
                            <?php
                                foreach ($r->result() as $rg) {
                                    echo "
                                        <option value='".$rg->nip."' ".($rg->nip==$row->radiografer ? "selected" : "").">".$rg->nama."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Dokter Pengirim</label>
                    <div class="col-md-3">
                        <!-- <input type="text" readonly class="form-control"  name='dokter' readonly value="<?php echo $row->nama_dokter;?>"/> -->
                        <select class="form-control" name="pengirim">
                            <?php
                                foreach ($d1->result() as $dk1) {
                                    echo "
                                        <option value='".$dk1->id_dokter."' ".($dk1->id_dokter==$row->pengirim ? "selected" : "").">".$dk1->nama_dokter."</option>
                                    ";
                                }
                            ?>
                        </select>
                        <input type="hidden" readonly class="form-control" name='radiologi' readonly value="<?php echo $row->radiologi;?>"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="box-footer">
            <div class="pull-right">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div> -->
        <?php //echo form_close(); ?>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
                        <th width="100" class='text-center'>Tanggal</th>
                        <th class="text-center">Tindakan</th>
                        <th class="text-center">Dokter</th>
                        <th class="text-center">Radiografer</th>
                        <th width="100" class="text-center">Asal</th>
                        <th class="text-center">No Foto</th>
                        <!-- <th class="text-center">Uk Foto</th> -->
                        <!-- <th class="text-center">No Foto 1</th> -->
                        <th width="100" class="text-center">Uk Foto </th>
                        <th class="text-center">Kali</th>
                        <th class="text-center">Dok. Pengirim</th>
                        <th class="text-center">Diagnosa</th>
                        <th class='text-center'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        $subtotal = 0;
                        foreach($k->result() as $data){
                            $hasil = (isset($h[$data->kode_tarif][$data->pemeriksaan][$data->tanggal]) ? $h[$data->kode_tarif][$data->pemeriksaan][$data->tanggal] : "-");
                            if ($hasil=="" || $hasil=="-") {
                                $btn = "<div class='pull-right'><button id='".$data->id."' class='hapus btn btn-sm btn-danger'><i class='fa fa-minus'></i></div>";
                            }else{
                                $btn = "";
                            }
                            $subtotal += $data->jumlah;
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan." ".$btn."</td>";
                            echo "<td class='text-left'><a href='#' class='petugas dataChange' id='".$data->id."/".$data->tanggal."/".$data->pemeriksaan."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            echo "<td class='text-left'><a href='#' class='radiografer dataChange' id='".$data->id."/".$data->tanggal."/".$data->pemeriksaan."' radiografer='".$data->analys."'>".($data->analys=="" ? "---Pilih Radiografer---" : (isset($radiografer[$data->analys]) ? $radiografer[$data->analys] : "---Pilih Radiografer---") )."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange asal' id='".$data->id."'>".($data->asal=="" ? "---Pilih Asal Foto---" : $data->asal)."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange nofoto' id='".$data->id."'>".($data->nofoto=="" ? "-" : $data->nofoto)."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange ukuranfoto' id='".$data->id."' ukuranfoto='".$data->ukuranfoto."'>".($data->ukuranfoto=="" || $data->ukuranfoto== null ? "---Pilih Ukuran Foto---" : $data->ukuranfoto)."</a></td>";
                            // echo "<td class='text-right'><a href='#' class='dataChange nofoto1' id='".$data->id."'>".($data->nofoto1=="" ? "-" : $data->nofoto1)."</a></td>";
                            // echo "<td class='text-right'><a href='#' class='dataChange ukuranfoto1' id='".$data->id."'>".($data->ukuranfoto1=="" || $data->ukuranfoto1== null ? "---Pilih Ukuran Foto---" : $data->ukuranfoto1)."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange kali' id='".$data->id."'>".($data->kali=="" ? "---Berapa Kali---" : $data->kali)."</a></td>";
                            echo "<td class='text-left'><a href='#' class='dokter_pengirim dataChange' id='".$data->id."/".$data->tanggal."/".$data->pemeriksaan."' id_dokter='".$data->dokter_pengirim."'>".($data->dokter_pengirim=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter_pengirim[$data->dokter_pengirim]) ? $dokter_pengirim[$data->dokter_pengirim] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            echo "<td><a href='#' class='diagnosa dataChange' id='".$data->id."'>".($data->diagnosa=="" ? "-" : $data->diagnosa)."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange jumlah' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr><th colspan="11" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th><th style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th></tr>
                    <tr>
                        <th colspan="11" style="vertical-align: middle" ><span class="pull-right">Disc</span></th>
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
                    <tr><th colspan="11" style="vertical-align: middle" ><span class="pull-right">Sharing</span></th><th style="vertical-align: middle" ><input type="text" name="sharing" class="form-control text-right" value="<?php echo number_format($sharing,0,',','.');?>"></th></tr>
                    <tr><th colspan="11" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th><th style="vertical-align: middle" ><input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>"></th></tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="row">
              <?php
              if ($row->tgl_keluar=="" || $row->tgl_keluar=="0000-00-00") {
                $sudahpulang = false;
              } else {
                if ($row->id_gol!=11) $sudahpulang = false; else $sudahsudahpulang = true;
              }
              ?>
              <?php if (!$sudahpulang) :?>
                <div class="col-sm-2">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Tanggal</label>
                            <div class="col-md-8">
                                <input type="text"  class="form-control" name='tanggal'  value="<?php echo $tanggal;?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-8 control-label" style="text-align: right">Pemeriksaan ke-</label>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name='pemeriksaan' min="1" value="1" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="tindakan" <?php echo $disabled;?>>
                        <option value="">---Pilih Tindakan---</option>
                        <?php
                            foreach ($t->result() as $key) {
                                echo '<option value="'.$key->id_tindakan.'">'.$key->nama_tindakan.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-5">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Diagnosa</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name='diagnosa' value="<?php echo $diagnosa;?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
              <?php endif ?>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                            <button class="cetakbarcode btn btn-primary" type="button"><i class="fa fa-barcode"></i> Cetak Barcode</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-navy">Yakin akan membayar sejumlah</div>
                <div class="modal-body">
                    <h2 class="total"></h2>
                </div>
                <div class="modal-footer">
                    <button class="okbayar btn btn-success" type="button">OK</button>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade modalhapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy">Yakin akan menghapus data</div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Username</label>
                        <div class="col-md-10">
                            <input type="hidden" class="form-control" name='idhapus'/>
                            <input type="text" class="form-control" name='username'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name='password'/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="yahapus btn btn-success" type="button">Ya</button>
                <button class="tidakhapus btn btn-danger" type="button">Tidak</button>
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
