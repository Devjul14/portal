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
    $(document).ready(function(){
        $('.lunas').click(function(){
            $(".modalnotif").modal("show");
            var total = $("[name='total']").val();
            $(".total").html("Rp. "+total);
        });
        gettotal();
        $("[name='tindakan_radiologi']").select2();
        $("[name='tindakan']").select2();
        $("[name='ambulance']").select2();
        $("[name='penunjang']").select2();
        $("[name='gizi']").select2();
        $("[name='lab']").select2();
        $("[name='pa']").select2();
        $("[name='tindakan_inap']").select2();
        

        $("[name='kode_perusahaan']").select2();
        $("[name='totalsharing'],[name='blu'],[name='kodal'],[name='bayarsharing'],[name='dp_nominal'], [name='disc_nominal'], [name='sharing']").mask('000.000.000', {reverse: true});
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");
        $("[name='tindakan_inap']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var kode_kelas= $("[name='kode_kelas']").val();
            var kode_kamar= $("[name='kode_kamar']").val();
            var kode_ruangan= $("[name='kode_ruangan']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/inap",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal,kode_kamar:kode_kamar,kode_ruangan:kode_ruangan},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='ambulance']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var kode_kelas= $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/ambulance",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='penunjang']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var kode_kelas= $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/penunjang",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='tindakan_radiologi']").change(function(){
            var no_reg      = $("[name='no_reg']").val();
            var kode_kelas  = $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/radiologi",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='lab']").change(function(){
            var no_reg      = $("[name='no_reg']").val();
            var kode_kelas  = $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/lab",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='pa']").change(function(){
            var no_reg      = $("[name='no_reg']").val();
            var kode_kelas  = $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/pa",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='gizi']").change(function(){
            var no_reg      = $("[name='no_reg']").val();
            var kode_kelas  = $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/gizi",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='tindakan']").change(function(){
            var no_reg      = $("[name='no_reg']").val();
            var kode_kelas  = $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/addtindakan_inap/ralan",
                method : "POST",
                data : {no_reg: no_reg, kode_kelas: kode_kelas, tindakan: tindakan, qty: qty, tanggal: tanggal},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_no:cari_noreg},
                url   : "<?php echo site_url('parsial/getcaripasien_inap');?>",
                success : function(result){
                    window.location = "<?php echo site_url('parsial/pembayaran_inap');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.print').click(function(){
            var no_rm= $("[name='no_rm']").val();
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('parsial/cetakkwitansi_inap');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
        });
        $('.sharing').click(function(){
            $(".modalsharing").modal("show");
        });
        $('.hapus_r').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>parsial/hapusinap",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $('.okbayar').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var subtotal= $("[name='subtotal']").val().replace(/\D/g,'');
            var disc_nominal= $("[name='disc_nominal']").val().replace(/\D/g,'');
            var dp_nominal= $("[name='dp_nominal']").val().replace(/\D/g,'');
            var sharing= $("[name='sharing']").val().replace(/\D/g,'');
            var total= $("[name='total']").val().replace(/\D/g,'');
            $.ajax({
                url : "<?php echo base_url();?>parsial/simpantransaksi_inap",
                method : "POST",
                data : {no_reg: no_reg,disc_nominal: disc_nominal, dp_nominal: dp_nominal, sharing: sharing, total: total},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $('.oksharing').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var sharing= $("[name='totalsharing']").val().replace(/\D/g,'');
            var blu= $("[name='blu']").val().replace(/\D/g,'');
            var cob= $("[name='cob']").val().replace(/\D/g,'');
            var kode_perusahaan = $("[name='kode_perusahaan']").val();
            $.ajax({
                url : "<?php echo base_url();?>parsial/simpansharing",
                method : "POST",
                data : {no_reg: no_reg,sharing: sharing, blu: blu,cob: cob, kode_perusahaan: kode_perusahaan},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='totalsharing'],[name='blu']").keyup(function(evt){
            getkodal();
        });
        $("[name='dp_persen']").keyup(function(evt){
            var subtotal = parseInt($("[name='subtotal']").val().replace(/\D/g,''));
            var dp_persen = parseFloat($(this).val());
            dp_nominal = number_format(dp_persen*subtotal/100,0,',','.');
            $("[name='dp_nominal']").val(dp_nominal);
            gettotal();
            return false;
        });
        $("[name='dp_nominal']").keyup(function(evt){
            if ($(this).val()=="") $("[name='dp_persen']").val("0");
            else {
                var subtotal = parseInt($("[name='subtotal']").val().replace(/\D/g,''));
                var dp_nominal = parseInt($(this).val().replace(/\D/g,''));
                dp_persen = (dp_nominal/subtotal)*100;
                $("[name='dp_persen']").val(dp_persen.toFixed(2));
            }
            gettotal();
            return false;
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
        $('.pdf').click(function(){
            var no_sep = $("[name='no_sep']").val();
            if (no_sep==""){
                alert("No. SEP belom ada !!");
            } else {
                var url = "<?php echo site_url('grouper/claimprint_inap');?>/"+no_sep;
                openCenteredWindow(url);
            }
        });
        $("[name='sharing']").keyup(function(evt){
            gettotal();
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $(".grouper").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('grouper/viewgrouper_inap');?>/"+no_rm+"/"+no_reg+"/kasir";
            window.location = url;
            return false; 
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('id');
            var dataContent = dataText.text().trim();
            var jenis;
            if (dataText.hasClass("disabled")){
                return false;
            }
            if (dataText.hasClass("qty")){
                jenis = "qty";
            } else 
            if (dataText.hasClass("lama")){
                jenis = "lama";
            } else 
            if (dataText.hasClass("petugas")){
                jenis = "petugas";
            } else 
            if (dataText.hasClass("tagihan")){
                jenis = "tagihan";
            }
            if (jenis=='petugas'){
                var id_dokter = dataText.attr('id_dokter');
                var result = getdokter(id_dokter);
                var dataInputField = $(result);
            }
            else
                var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control '+jenis+'" />');
            // alert(jenis);
            dataText.before(dataInputField).hide();
            if (jenis=='tagihan') dataInputField.mask('000.000.000', {reverse: true});
            if (jenis=='petugas'){
                dataInputField.select2();
                dataInputField.focus().select().change(function(){
                    if (jenis == "qty" || jenis == "lama")
                        var inputval = dataInputField.val()
                    else
                        var inputval = dataInputField.val().replace(/\D/g,'');
                    changeData(inputval,kode,jenis);
                    $(this).remove();
                    dataText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        if (jenis == "qty" || jenis == "lama")
                            var inputval = dataInputField.val()
                        else
                            var inputval = dataInputField.val().replace(/\D/g,'');
                        changeData(inputval,kode,jenis);
                        $(this).remove();
                        dataText.show();
                    }
                });
            }
            else {
                dataInputField.select();
                dataInputField.focus().blur(function(){
                    if (jenis == "qty" || jenis == "lama")
                        var inputval = dataInputField.val()
                    else
                        var inputval = dataInputField.val().replace(/\D/g,'');
                    changeData(inputval,kode,jenis);
                    $(this).remove();
                    dataText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        if (jenis == "qty" || jenis == "lama")
                            var inputval = dataInputField.val()
                        else
                            var inputval = dataInputField.val().replace(/\D/g,'');
                        changeData(inputval,kode,jenis);
                        $(this).remove();
                        dataText.show();
                    }
                });
            }
        });
    });
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var dp_nominal = $("[name='dp_nominal']").val().replace(/\D/g,'');
        var sharing = $("[name='sharing']").val().replace(/\D/g,'');
        var total = subtotal-dp_nominal-disc_nominal-sharing;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    function getkodal(){
        var sharing = $("[name='totalsharing']").val().replace(/\D/g,'');
        var blu = $("[name='blu']").val().replace(/\D/g,'');
        var kodal = sharing-blu;
        $("[name='kodal']").val(number_format(kodal,0,',','.'));
    }
    var changeData = function(value,id,jenis){
        // alert(jenis);
        $.ajax({
            url: "<?php echo site_url('parsial/changedata_inap');?>", 
            type: 'POST', 
            data: {id: id,value: value, jenis: jenis}, 
            success: function(){
                location.reload();
            },
            error: function(data){
                console.log(data);
            }
        });
    };
    function getdokter(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('parsial/getdokter');?>", 
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
    function getkamar(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('parsial/getkamar');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='petugas' class='selectpetugas form-control'>";
                html += "<option value=''>---Pilih Kamar---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.kode_kamar+"' "+(val==value.kode_kamar ? "selected" : "")+">"+value.nama_ruangan+" | "+value.nama_kelas+"</option>";
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
        $dp_nominal = $data->jumlah_dp;
        $sharing = $data->jumlah_sharing;
        $total = $data->jumlah_bayar;
        $disc_persen = round($disc_nominal/($disc_nominal+$sharing+$total),2)*100;
        if ($dp_nominal+$sharing+$total==0)
            $dp_persen = 0;
        else
            $dp_persen = round($dp_nominal/($dp_nominal+$sharing+$total),2)*100;
        // $disabled = "";
        $disabled_print = "";
        $tgl_pembayaran = "Tanggal pembayaran -> ".date("d-m-Y",strtotime($data->tanggal));
    } else {
        $dp_nominal = $dp_persen = $disc_nominal = $sharing = $total = $disc_persen = 0; 
        $tgl_pembayaran = "";
        $disabled_print = "disabled";
    }
    if ($row->tgl_keluar!=""){
        $disabled = $dis = "";
        // $disabled = $dis = "disabled";
        $disabled = 
        $hide = "hide";
    } else {
        $disabled = $hide = $dis = "";
    }
?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
        	<div class="form-horizontal">
                <div class="form-group">
                    <input type="hidden" name="kode_kelas" value="<?php echo $row->kode_kelas;?>">
                    <input type="hidden" name="kode_kamar" value="<?php echo $row->kode_kamar;?>">
                    <input type="hidden" name="kode_kelas" value="<?php echo $row->kode_kelas;?>">
                    <input type="hidden" name="kode_ruangan" value="<?php echo $row->kode_ruangan;?>">
                    <input type="hidden" name="no_sep" value="<?php echo $row->no_sjp;?>">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Status Bayar</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='status_bayar' readonly value="LUNAS"/>
                    </div>
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_ruangan' readonly value="<?php echo $row->nama_ruangan;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_kelas' readonly value="<?php echo $row->nama_kelas;?>"/>
                    </div>
                </div>
                <?php
                    $finish = date("Y-m-d",strtotime($row->tgl_keluar));
                    $start = date("Y-m-d",strtotime($row->tgl_masuk));
                    $durasi= strtotime($finish)-strtotime($start);
                    $hari = $durasi / (60 * 60 * 24);
                ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Masuk</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tgl_masuk' readonly value="<?php echo date("d-m-Y",strtotime($row->tgl_masuk));?>"/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal Keluar</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tgl_keluar' readonly value="<?php echo ($row->tgl_keluar=="" ? "-" : date("d-m-Y",strtotime($row->tgl_keluar)));?>"/>
                    </div>
                    <label class="col-md-2 control-label">Lama (hari)</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='lama' readonly value="<?php echo ($row->tgl_keluar=="" ? "-" : $hari+1);?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
                        <th width="100" class='text-center'>Tanggal</th>
                        <th class="text-center">Tarif</th>
                        <th width="80" class="text-center">Lama (Jam)</th>
                        <th width="250" class="text-center">Petugas</th>
                        <th width="150" class='text-center'>Tagihan</th>
                        <th width="80" class="text-center">Qty</th>
                        <th width="150" class='text-center'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        $subtotal = 0;
                        foreach($tnp->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($pg->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($l1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($pa->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($p1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->ket." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($a1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->kota." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($k1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($k->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan." <div class='pull-right'><button id='".$data->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td></td>";
                            echo "<td>---Pilih Petugas---</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange tagihan' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange qty' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td>".number_format(($data->jumlah*$data->qty),0,'.','.')."</td>";
                            echo "</tr>";
                        }

                    ?>
                </tbody>
                <tfoot>
                    <tr><th colspan="7" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th><th style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th></tr>
                    <tr>
                        <th colspan="7" style="vertical-align: middle" ><span class="pull-right">Down Payment (DP)</span></th>
                        <th width="250px" style="vertical-align: middle" >
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="text" name="dp_persen" class="form-control text-right" value="<?php echo $dp_persen;?>">
                                </div>
                                <div class="col-sm-7">  
                                    <input type="text" name="dp_nominal" class="form-control text-right" value="<?php echo number_format($dp_nominal,0,',','.');?>">
                                </div>
                            </div>
                        </th>
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
                    <tr><th colspan="7" style="vertical-align: middle" ><span class="pull-right">Sharing</span></th><th style="vertical-align: middle" ><input type="text" name="sharing" class="form-control text-right" value="<?php echo number_format($sharing,0,',','.');?>"></th></tr>
                    <tr><th colspan="7" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th><th style="vertical-align: middle" ><input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>"></th></tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="form-horizontal">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Tanggal</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name='tanggal' value="<?php echo date("d-m-Y");?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                                <button class="lunas btn btn-success" type="button" <?php echo $disabled;?>> Bayar</button>
                                <!-- <button class="sharing btn bg-maroon" type="button" <?php echo $disabled;?>> Sharing</button>
                                <button class="grouper btn btn-primary" type="button"><i class="fa fa-object-group"></i>&nbsp;&nbsp;Grouper</button>
                                <button class="pdf btn bg-navy" type="button"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;LIP</button> -->
                                <button class="print btn btn-info" type="button" <?php echo $disabled_print;?>><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-8">
                        <div class="col-sm-3">
                        <select class="form-control" name="tindakan">
                            <option value="">---Tindakan Poliklinik---</option>
                            <?php 
                                foreach ($t->result() as $key) {
                                    echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                                }
                            ?>
                        </select>
                        </div>
                        <div class="col-sm-3">
                        <select class="form-control" name="tindakan_radiologi">
                            <option value="">---Tindakan Radiologi---</option>
                            <?php 
                                foreach ($t1->result() as $key1) {
                                    echo '<option value="'.$key1->id_tindakan.'">'.$key1->nama_tindakan.'</option>';
                                }
                            ?>
                        </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="ambulance">
                                <option value="">---Tindakan Ambulance---</option>
                                <?php 
                                    foreach ($a->result() as $key) {
                                        echo '<option value="'.$key->kode.'">'.$key->kota.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="penunjang">
                                <option value="">---Tindakan Penunjang---</option>
                                <?php 
                                    foreach ($p->result() as $key) {
                                        echo '<option value="'.$key->kode.'">'.$key->ket.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                        <div class="col-sm-3">
                            <select class="form-control" name="tindakan_inap">
                                <option value="">---Tindakan Rawat Inap---</option>
                                <?php 
                                    foreach ($ti->result() as $val) {
                                        echo '<option value="'.$val->kode_tindakan.'">'.$val->nama_tindakan.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="gizi">
                                <option value="">---Tindakan Gizi---</option>
                                <?php 
                                    foreach ($tg->result() as $key) {
                                        echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="lab">
                                <option value="">---Tindakan Lab---</option>
                                <?php 
                                    foreach ($tl->result() as $key1) {
                                        echo '<option value="'.$key1->id_tindakan.'">'.$key1->nama_tindakan.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="pa">
                                <option value="">---Tindakan PA---</option>
                                <?php 
                                    foreach ($tpa->result() as $key) {
                                        echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                                    }
                                ?>
                            </select>
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
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>