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
    $(document).keyup(function(e){
        if (e.ctrlKey && e.which == 81){
            var dataText = $(".bg-gray a.pagi");
            var kode = dataText.attr('id');
            var obat = dataText.attr('obat');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                changeData(inputval,kode,obat);
                $(this).remove();
                dateText.show();
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    changeData(inputval,kode,obat);
                    $(this).remove();
                    dateText.show();
                }
            });
        } else 
        if (e.ctrlKey && e.which == 81){
            var dataText = $(".bg-gray a.qty");
            var kode = dataText.attr('id');
            var obat = dataText.attr('obat');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                changeData(inputval,kode,obat);
                $(this).remove();
                dateText.show();
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    changeData(inputval,kode,obat);
                    $(this).remove();
                    dateText.show();
                }
            });
        } else 
        if (e.which == 40 || e.which == 50){
            var height = $("tr#data").height();
            var heightTR = $("table#myTable tr").height();
            var isi = Math.round(height/heightTR);
            var current = parseInt($("table#myTable tr.bg-gray").attr("title"));
            var i = parseInt(current/isi);
            if (current>=$("table#myTable tr").size()) current = $("table#myTable tr").size()-1;
            $("table tr#data").removeClass("bg-gray");
            $("table tr#data").eq(current++).addClass("bg-gray");
            if (current>=(i*isi)){
                $("tbody").scrollTop(i*height);
            }
            $("tbody").scrollTop();
            return false;
        } else 
        if (e.which == 38 || e.which == 56){
            var height = $("tr#data").height();
            var heightTR = $("table#myTable tr").height();
            var isi = Math.round(height/heightTR);
            var current = parseInt($("table#myTable tr.bg-gray").attr("title"));
            var cur = current-2;
            if (cur<0) cur = 0;
            var i = parseInt(cur/isi);
            $("table tr#data").removeClass("bg-gray");
            $("table tr#data").eq(cur).addClass("bg-gray");
            if (current>=(i*isi)){
                $("tr#data").scrollTop(i*height);
            }
            $("tr#data").scrollTop();
        }
    });
    $(document).ready(function(){
        gettotal();
        $("[name='bayarsharing'], [name='disc_nominal'], [name='sharing']").mask('000.000.000', {reverse: true});
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");
        $("table tr#data:first").addClass("bg-gray");
        $("table tr#data").click(function(){
            $("tr#data").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal'],[name='tgl1_print'],[name='tgl2_print']").datepicker({
            dateFormat : formattgl,
        });
        $('.back').click(function(){
            var no_rm= $("[name='no_pasien']").val();
            var no_reg= $("[name='no_reg']").val();
            window.location = "<?php echo site_url('dokter/igd/');?>"+no_rm+"/"+no_reg;
        });
        $('.print').click(function(){
            var no_rm= $("[name='no_pasien']").val();
            var no_reg= $("[name='no_reg']").val();
            var tgl1_print= $("[name='tgl1_print']").val();
            var tgl2_print= $("[name='tgl2_print']").val();
            var url = "<?php echo site_url('apotek/cetak_inap');?>/"+no_rm+"/"+no_reg+"/"+tgl1_print+"/"+tgl2_print;
            openCenteredWindow(url);
        });
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>apotek/hapusobat",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $('.lunas').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var subtotal= $("[name='subtotal']").val().replace(/\D/g,'');
            var disc_nominal= $("[name='disc_nominal']").val().replace(/\D/g,'');
            var total= $("[name='total']").val().replace(/\D/g,'');
            var tanggal= $("[name='tanggal']").val();
            $.ajax({
                url : "<?php echo base_url();?>apotek/simpanobat_inap",
                method : "POST",
                data : {no_reg: no_reg,disc_nominal: disc_nominal, total: total,tanggal:tanggal},
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
        $(".obat").select2();
        $("[name='aturan_pakai']").select2();
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('id');
            var obat = dataText.attr('obat');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,kode,obat);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,kode,obat);
                }
            });
        });
        $("[name='obat']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>dokter/getfarmasiobat",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.id] = object;
                        objects.push(object.id+" | "+object.label);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='obat']").val(n[0]);
                return n[0];
            }
        });
    });
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var total = subtotal-disc_nominal;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    var changeData = function(value,id,obat){
        $.ajax({
            url: "<?php echo site_url('apotek/changedata');?>", 
            type: 'POST', 
            data: {id: id,obat: obat, value: value}, 
            success: function(){
               location.reload();
            }
        });
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
        $total = $data->jumlah_bayar;
        $disc_persen = round($disc_nominal/($disc_nominal+$total),2)*100;
        $disabled = "";
        $disabled_print = "";
        $tgl_pembayaran = "";
    } else {
        $disc_nominal = $total = $disc_persen = 0;
        $disabled = $tgl_pembayaran = "";
        $disabled_print = "disabled";
    }
?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Status Bayar</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='status_bayar' readonly value="<?php echo (isset($row) ? $row->status_bayar : "");?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-10">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo (isset($row) ? $row->nama_pasien : "");?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <?php echo form_open("dokter/addobat",array("id"=>"formsave_obat","class"=>"form-horizontal"));?>
                <input type="hidden" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                <input type="hidden" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tanggal</label>
                        <div class="col-md-8">
                            <input type="text"  class="form-control" name='tanggal'  value="<?php echo date("d-m-Y");?>" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Obat</label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" name="obat" class="form-control" autocomplete="off">
                                </div>
                                <div class="col-md-1"><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" rowspan="2" class='text-center'>No</th>
                        <th width=200px rowspan="2" class="text-center">Tanggal</th>
                        <th width=500px  rowspan="2" class="text-center">Nama Obat</th>
                        <th rowspan="2" class="text-center" width="200">Aturan Pakai</th>
                        <th rowspan="2" width="200" class="text-center">Waktu</th>
                        <th colspan="5" class="text-center">Cara</th>
                        <th rowspan="2" class="text-center">Qty</th>
                        <th rowspan="2" class="text-center">Satuan</th>
                        <th width=350px rowspan="2" class="text-center">Jumlah</th>
                        <th rowspan="2">&nbsp;</th>
                    </tr>
                    <tr class="bg-navy">
                        <th>Pagi</th>
                        <th>Siang</th>
                        <th>Sore</th>
                        <th>Malem</th>
                        <th>Lainnya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1; $n = 1;
                        $subtotal = 0;
                        $tgl1_print = $tgl2_print = "";

                        foreach($k->result() as $data){
                            $tgl = substr($data->id,0,4);
                            $tgl1_print = $tgl1_print=="" ? date("d-m-Y",strtotime($tgl)) : $tgl1_print;
                            $tgl2_print = date("d-m-Y",strtotime($tgl));
                            $subtotal += $data->jumlah;
                            echo form_open("dokter/simpanwaktu",array("id"=>"formsave","class"=>"form-horizontal"));
                                echo "<input type = 'hidden' name='kode_obat' value='".$data->kode_obat."'>";
                                echo "<input type = 'hidden' name='tanggal_obat' value='".date("Y-m-d",strtotime($tgl))."'>";
                                echo "<input type = 'hidden' name='no_reg' value='".$no_reg."'>";
                                echo "<input type = 'hidden' name='no_rm' value='".$no_pasien."'>";
                                echo "<tr id='data' title='".($n++)."'>";
                                echo "<td>".($i++)."</td>";
                                echo "<td>".date("d-m-Y",strtotime($tgl))."</td>";
                                echo "<td>".$data->nama_obat."<div class='pull-right'><button type='submit' class='btn btn-xs btn-success'><i class='fa fa-check'></i></button></div></td>";
                                echo "<td><select class='form-control' name='aturan_pakai' style='width:100%'>";
                                        echo "<option value = ''>---</option>";
                                      foreach ($aturan->result() as $key) {
                                            echo "<option value = '".$key->kode."' ".($data->aturan_pakai==$key->kode ? "selected" : "")." >".$key->nama."</option>";
                                        }  
                                echo "</td>";
                                echo "<td><select class='form-control' name='waktu' style='width:100%'>";
                                        echo "<option value = ''>---</option>";
                                      foreach ($waktu->result() as $key) {
                                            echo "<option value = '".$key->kode."' ".($data->waktu==$key->kode ? "selected" : "")." >".$key->nama."</option>";
                                        }  
                                echo "</td>";
                                // echo "<td class='text-right'><input class='form-control' type = 'text 'name='waktu' value='".$data->waktu."'></td>";
                                echo "<td class='text-right' style='width:200px'><input class='form-control' class='form-control' type = 'text 'name='pagi' value='".$data->pagi."'></td>";
                                echo "<td class='text-right' style='width:200px'><input class='form-control' type = 'text 'name='siang' value='".$data->siang."'></td>";
                                echo "<td class='text-right' style='width:200px'><input class='form-control' type = 'text 'name='sore' value='".$data->sore."'></td>";
                                echo "<td class='text-right' style='width:200px'><input class='form-control' type = 'text 'name='malem' value='".$data->malem."'></td>";
                                echo "<td style='width:300px'><select class='form-control' name='waktu_lainnya' style='width:100%'>";
                                    echo "<option value = ''>---</option>";
                                      foreach ($wl->result() as $wk) {
                                            echo "<option value = '".$wk->kode."' ".($data->waktu_lainnya==$wk->kode ? "selected" : "")." >".$wk->nama."</option>";
                                        }  
                                echo "</td>";
                            echo form_close();
                            echo "<td class='text-right' width='100px'><a href='#' class='qty dataChange' obat='".$data->kode_obat."' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td class='text-center'>".$data->satuan."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "<td><button id='".$data->id."' class='hapus btn btn-xs btn-danger'><i class='fa fa-minus'></i></td>";
                            echo "</tr>";
                        }
                        $tgl1_print = $tgl1_print=="" ? date("d-m-Y") : $tgl1_print;
                        $tgl2_print = $tgl2_print=="" ? date("d-m-Y") : $tgl2_print;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="btn-group pull-right">
                                        <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                                        <button class="lunas btn btn-success" type="button" <?php echo $disabled;?>> Simpan</button>
                                    </div>
                                </div>
                                <div class="col-md-8 pull-right">
                                    <div class="row">
                                        <div class="col-md-5"><input type="text"  class="form-control" name='tgl1_print'  value="<?php echo date("d-m-Y",strtotime($tgl1_print));?>" autocomplete="off"></div>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <input type="text"  class="form-control" name='tgl2_print'  value="<?php echo date("d-m-Y",strtotime($tgl2_print));?>" autocomplete="off">
                                                <span class="input-group-btn"><button class="print btn btn-info" type="button" <?php echo $disabled_print;?>><i class="fa fa-print"></i></button></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th colspan="2" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th>
                        <th colspan="2" style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th></tr>
                    <tr>
                        <th colspan="12" style="vertical-align: middle" ><span class="pull-right">Disc</span></th>
                        <th colspan='2' style="vertical-align: middle" >
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
                    <tr><th colspan="12" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th>
                    <th colspan='2' style="vertical-align: middle" ><input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>"></th></tr>
                </tfoot>
            </table>
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
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #f4f4f4;
    }
</style>