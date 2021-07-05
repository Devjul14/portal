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
                url : "<?php echo base_url();?>kasir/addtindakan_inap/inap",
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
                url : "<?php echo base_url();?>kasir/addtindakan_inap/ambulance",
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
                url : "<?php echo base_url();?>kasir/addtindakan_inap/penunjang",
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
        $("[name='operasi']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var kode_kelas= $("[name='kode_kelas']").val();
            var tanggal= $("[name='tanggal']").val();
            var qty = 1;
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/addtindakan_inap/operasi",
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
        // $('.back').click(function(){
        //     window.location = "<?php echo site_url('kasir/pembayaran_inap');?>";
        // });
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_no:cari_noreg},
                url   : "<?php echo site_url('kasir/getcaripasien_inap');?>",
                success : function(result){
                    window.location = "<?php echo site_url('kasir/pembayaran_inap');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.print').click(function(){
            var no_rm= $("[name='no_rm']").val();
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('kasir/cetakkwitansi_inap');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
        });
        $('.lunas').click(function(){
            $(".modalnotifbayar").modal("show");
            var total = $("[name='total']").val();
            $(".total").html("Rp. "+total);
        });
        $('.sharing').click(function(){
            $(".modalsharing").modal("show");
        });
        $('.hapus_inap').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>kasir/hapusinap",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $('.okbayar').click(function(){
            var username_kasir= $("[name='username_kasir']").val();
            var password_kasir= $("[name='password_kasir']").val();
            if (username_kasir!="" && password_kasir!=""){
                $.ajax({
                    url : "<?php echo base_url();?>kasir/cekpassword",
                    method : "POST",
                    data : {username_kasir: username_kasir, password_kasir: password_kasir},
                    success: function(data){
                        if (data=="1"){
                            var no_reg= $("[name='no_reg']").val();
                            var subtotal= $("[name='subtotal']").val().replace(/\D/g,'');
                            var disc_nominal= $("[name='disc_nominal']").val().replace(/\D/g,'');
                            var dp_nominal= $("[name='dp_nominal']").val().replace(/\D/g,'');
                            var sharing= $("[name='sharing']").val().replace(/\D/g,'');
                            var total= $("[name='total']").val().replace(/\D/g,'');
                            $.ajax({
                                url : "<?php echo base_url();?>kasir/simpantransaksi_inap",
                                method : "POST",
                                data : {no_reg: no_reg,disc_nominal: disc_nominal, dp_nominal: dp_nominal, sharing: sharing, total: total, username_kasir: username_kasir},
                                success: function(data){
                                    location.reload();
                                },
                                error: function(data){
                                    console.log(data);
                                }
                            });
                        } else {
                            alert("Kombinasi username dan password salah !!!");
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            } else {
                alert("Username dan Password wajib diisi !!!");
            }
        });
        $('.oksharing').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var sharing= $("[name='totalsharing']").val().replace(/\D/g,'');
            var blu= $("[name='blu']").val().replace(/\D/g,'');
            var cob= $("[name='cob']").val().replace(/\D/g,'');
            var kode_perusahaan = $("[name='kode_perusahaan']").val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/simpansharing",
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
        $("[name='tindakan_inap'], [name='ambulance'], [name='penunjang'], [name='operasi']").select2();
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
                    dateText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        if (jenis == "qty" || jenis == "lama")
                            var inputval = dataInputField.val()
                        else
                            var inputval = dataInputField.val().replace(/\D/g,'');
                        changeData(inputval,kode,jenis);
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
        $.ajax({
            url: "<?php echo site_url('kasir/changedata_inap');?>",
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
            url: "<?php echo site_url('kasir/getdokter');?>",
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
            url: "<?php echo site_url('kasir/getkamar');?>",
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
                        <input type="text" readonly class="form-control" name='status_bayar' readonly value="<?php echo $row->status_bayar;?>"/>
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
                        if ($row->tgl_keluar=="" || $row->tgl_keluar=="0000-00-00") {
                          $sudahpulang = false;
                        } else {
                          if ($row->id_gol!=11) $sudahpulang = false; else $sudahpulang = true;
                        }
                        $i = 1;
                        $subtotal = 0;
                        foreach($t1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td>&nbsp;</td>";
                            if ($data->kode_tarif=="kmr")
                                echo "<td class='text-left'>".(isset($kamar[$data->kode_petugas]) ? $kamar[$data->kode_petugas] : "")."</a></td>";
                            else
                                echo "<td class='text-left'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."' id_dokter='".$data->kode_petugas."' kode='".$data->kode_tarif."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            echo "<td class='text-right'>".($data->kode_tarif=="swa" || $data->kode_tarif=="ook" || $data->kode_tarif=="alt" ? "<a href='#' class='".$dis." tagihan dataChange' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a>" : number_format($data->jumlah,0,'.','.'))."</td>";
                            echo "<td class='text-right'>".(!($sudahpulang) ? "<a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".number_format($data->qty,2,'.','.')."</a>" : number_format($data->qty,2,'.','.'))."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($t2->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td class='text-left'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "<td class='text-right'>".(!($sudahpulang) ? "<a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".number_format($data->qty,2,'.','.')."</a>" : number_format($data->qty,2,'.','.'))."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($a1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>".$data->kota."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td class='text-right'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."'>".($data->kode_petugas)."</a></td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "<td class='text-right'>".(!($sudahpulang) ? "<a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".$data->qty."</a>" : number_format($data->qty,2,'.','.'))."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($p1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->ket."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td class='text-right'><a href='#' class='".$dis." lama dataChange' id='".$data->id."'>".number_format($data->lama,0,'.','.')."</a></td>";
                            echo "<td class='text-left'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "<td class='text-right'>".(!($sudahpulang) ? "<a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".number_format($data->qty,2,'.','.')."</a>" : number_format($data->qty,2,'.','.'))."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($o1->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td class='text-left'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "<td class='text-right'>".(!($sudahpulang) ? "<a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".number_format($data->qty,2,'.','.')."</a>" : number_format($data->qty,2,'.','.'))."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                            echo "</tr>";
                        }
                        foreach($o2->result() as $data){
                            $subtotal += ($data->jumlah*$data->qty);
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_tindakan."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td class='text-left'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "<td class='text-right'>".(!($sudahpulang) ? "<a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".number_format($data->qty,2,'.','.')."</a>" : number_format($data->qty,2,'.','.'))."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                            echo "</tr>";
                        }
                        // foreach($r1->result() as $data){
                        //     $subtotal += ($data->jumlah*$data->qty);
                        //     echo "<tr>";
                        //     echo "<td>".$i++."</td>";
                        //     echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                        //     echo "<td>".$data->nama_tindakan."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                        //     echo "<td class='text-left'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                        //     echo "<td class='text-right'><a href='#' class='".$dis." tagihan dataChange1' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                        //     echo "<td class='text-right'><a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".number_format($data->qty,0,'.','.')."</a></td>";
                        //     echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                        //     echo "</tr>";
                        // }
                        $total_rad1 = 0;
                        foreach($r1->result() as $datar1){
                            $total_rad1 += $datar1->jumlah;
                        }
                        if ($total_rad1>0){
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y")."</td>";
                            echo "<td colspan=4>Radiologi</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td class='text-right'>".number_format($total_rad1,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        $subtotal += $total_rad1;
                        // foreach($l1->result() as $data){
                        //     $subtotal += ($data->jumlah*$data->qty);
                        //     echo "<tr>";
                        //     echo "<td>".$i++."</td>";
                        //     echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                        //     echo "<td>".$data->nama_tindakan."<div class='pull-right'><button id='".$data->id."' class='".$hide." hapus_inap btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                        //     echo "<td class='text-left'><a href='#' class='".$dis." petugas dataChange' id='".$data->id."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                        //     echo "<td class='text-right'><a href='#' class='".$dis." tagihan dataChange1' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                        //     echo "<td class='text-right'><a href='#' class='".$dis." qty dataChange' id='".$data->id."'>".number_format($data->qty,0,'.','.')."</a></td>";
                        //     echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                        //     echo "</tr>";
                        // }
                        $total_lab1 = 0;
                        foreach($l1->result() as $datal1){
                            $total_lab1 += $datal1->jumlah*$datal1->qty;
                        }
                        if ($total_lab1>0){
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y")."</td>";
                            echo "<td colspan=4>Labotarium</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td class='text-right'>".number_format($total_lab1,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        $subtotal += $total_lab1;

                        $total_pa1 = 0;
                        foreach($pa1->result() as $datal1){
                            $total_pa1 += $datal1->jumlah;
                        }
                        if ($total_pa1>0){
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y")."</td>";
                            echo "<td colspan=4>Patalogi Anatomi</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td class='text-right'>".number_format($total_pa1,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        $subtotal += $total_pa1;

                        $total_gizi1 = 0;
                        foreach($g1->result() as $datal1){
                            $total_gizi1 += $datal1->jumlah;
                        }
                        if ($total_gizi1>0){
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".date("d-m-Y")."</td>";
                            echo "<td colspan=4>Gizi</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td class='text-right'>".number_format($total_gizi1,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        $subtotal += $total_gizi1;
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
                                <button class="sharing btn bg-maroon" type="button" <?php echo $disabled;?>> Sharing</button>
                                <button class="grouper btn btn-primary" type="button"><i class="fa fa-object-group"></i>&nbsp;&nbsp;Grouper</button>
                                <button class="pdf btn bg-navy" type="button"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;LIP</button>
                                <button class="print btn btn-info" type="button" <?php echo $disabled_print;?>><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$sudahpulang) :?>
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" name="tindakan_inap" <?php echo $disabled;?>>
                        <option value="">---Pilih Kamar/Tindakan---</option>
                        <?php
                            foreach ($t->result() as $key) {
                                echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="ambulance" <?php echo $disabled;?>>
                        <option value="">---Pilih Ambulance---</option>
                        <?php
                            foreach ($a->result() as $key) {
                                echo '<option value="'.$key->kode.'">'.$key->kota.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="penunjang" <?php echo $disabled;?>>
                        <option value="">---Pilih Penunjang---</option>
                        <?php
                            foreach ($p->result() as $key) {
                                echo '<option value="'.$key->kode.'">'.$key->ket.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-5">
                    <select class="form-control" name="operasi" <?php echo $disabled;?>>
                        <option value="">---Pilih Operasi---</option>
                        <?php
                            foreach ($o->result() as $key) {
                                echo '<option value="'.$key->kode.'">'.$key->nama_tindakan.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
<div class="modal fade modalnotifbayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy">Yakin akan membayar sejumlah</div>
            <div class="modal-body">
                <h2 class="total"></h2>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12 control-label">Username</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name='username_kasir' required/>
                        </div>
                     </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">Password</label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name='password_kasir' required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="okbayar btn btn-success" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modalsharing" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy">Sharing</div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Total Sharing</label>
                        <div class="col-md-8">
                            <input type="text"  class="form-control" name='totalsharing' value="<?php echo $row->sharing;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">BLU</label>
                        <div class="col-md-8">
                            <input type="text"  class="form-control" name='blu' value="<?php echo $row->blu;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Kodal</label>
                        <div class="col-md-8">
                            <input type="text"  class="form-control" name='kodal' value="<?php echo ($row->sharing-$row->blu);?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">COB</label>
                        <div class="col-md-8">
                            <input type="text"  class="form-control" name='cob' value="<?php echo ($row->cob);?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Perusahaan</label>
                        <div class="col-md-8">
                            <select class="form-control" name='kode_perusahaan' style="width:100%">
                                <option value="">---</option>
                                <?php
                                    foreach($prs->result() as $d_prs){
                                        echo "<option value='".$d_prs->kode." ".($d_prs->kode==$row->kode_perusahaan ? "selected" : "").">".$d_prs->nama."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="oksharing btn btn-success" type="button"><i class='fa fa-save'></i> Simpan</button>
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
