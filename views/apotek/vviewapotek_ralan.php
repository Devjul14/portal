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
    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
</head>
<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
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
        // $("[name='obat']").change(function(){
        //     var no_reg= $("[name='no_reg']").val();
        //     var obat= $(this).val();
        //     $.ajax({
        //         url : "<?php echo base_url();?>apotek/addobat",
        //         method : "POST",
        //         data : {no_reg: no_reg, obat: obat},
        //         success: function(data){
        //              location.reload();
        //         },
        //         error: function(result){
        //             console.log(result);
        //         }
        //     });
        // });
        // $('.back').click(function(){
        //     window.location = "<?php echo site_url('apotek/list_ralan');?>";
        // });

        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_noreg:cari_noreg},
                url   : "<?php echo site_url('apotek/getcaripasien_ralan');?>",
                success : function(result){
                    window.location = "<?php echo site_url('apotek/list_ralan');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.print').click(function(){
            var no_rm= $("[name='no_rm']").val();
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('apotek/cetak');?>/"+no_rm+"/"+no_reg;
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
            $.ajax({
                url : "<?php echo base_url();?>apotek/simpanobat",
                method : "POST",
                data : {no_reg: no_reg,disc_nominal: disc_nominal, total: total},
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
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('id');
            var obat = dataText.attr('obat');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            if (dataText.hasClass("qty")){
                var change = "qty";
            } else {
                var change = "qty_obat_kronis";
            }
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,kode,obat,change);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,kode,obat,change);
                }
            });
        });
    });
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var total = subtotal-disc_nominal;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    var changeData = function(value,id,obat,change){
        $.ajax({
            url: "<?php echo site_url('apotek/changedata');?>/"+change, 
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
        // $disabled = "disabled";
        $disabled = "";
        $disabled_print = "";
        // $tgl_pembayaran = "Tanggal pembayaran -> ".date("d-m-Y",strtotime($data->tanggal));
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
                <input type="hidden" name="jenis" value="<?php echo $row->jenis;?>">
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
                        <input type="text" readonly class="form-control" name='status_bayar' readonly value="<?php echo $row->status_bayar;?>"/>
                    </div>
                </div>
                <!-- <div class="form-group">
                    
                </div> -->
                <div class="form-group">
                    <label class="col-md-2 control-label">Poliklinik</label>
                    <div class="col-md-2">
                        <input type="hidden" readonly class="form-control" name='kode_poli' readonly value="<?php echo $row->tujuan_poli;?>"/>
                        <input type="text" readonly class="form-control" name='poliklinik' readonly value="<?php echo $row->poli;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-6">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                </div>
                <!-- <div class="form-group">

                </div> -->
                <!-- <div class="form-group">
                    
                </div> -->
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" rowspan="2" class='text-center'>No</th>
                        <th rowspan="2" class="text-center" width="200">Nama Obat</th>
                        <th rowspan="2" class="text-center" width="200">Aturan Pakai</th>
                        <th rowspan="2" width="200" class="text-center">Waktu</th>
                        <th rowspan="2" class="text-center" width="200">Takaran</th>
                        <th colspan="5" class="text-center" width="500">Cara</th>
                        <th rowspan="2" width="50">#</th>
                        <th width="50" rowspan="2" class="text-center">Qty</th>
                        <th width="100" rowspan="2" class="text-center">Satuan</th>
                        <th width="150" rowspan="2" class='text-center'>Jumlah</th>
                        <th width="150" colspan="2" class='text-center'>Obat Kronis</th>
                    </tr>
                    <tr class="bg-navy">
                        <th width="50">Pagi</th>
                        <th width="50">Siang</th>
                        <th width="50">Sore</th>
                        <th width="50">Malem</th>
                        <th width="50">Waktu Lainnya</th>
                        <th width="50">Qty</th>
                        <th width="100">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1; $n = 1;
                        $subtotal = 0;
                        foreach($k->result() as $data){
                            $subtotal += $data->jumlah;
                            echo form_open("apotek/simpanwaktu_ralan",array("id"=>"formsave","class"=>"form-horizontal"));
                            echo "<input type = 'hidden' name='kode_obat' value='".$data->kode_obat."'>";
                            echo "<input type = 'hidden' name='no_reg' value='".$no_reg."'>";
                            echo "<input type = 'hidden' name='no_rm' value='".$no_pasien."'>";
                            echo "<tr id='data' title='".($n++)."'>";
                            echo "<td>".($i++)."</td>";
                            echo "<td>".$data->nama_obat."<div class='pull-right'><button id='".$data->id."' class='hapus btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td><select class='form-control' name='aturan_pakai'>";
                                    echo "<option value = ''>---</option>";
                                      foreach ($aturan->result() as $key) {
                                            echo "<option value = '".$key->kode."' ".($data->aturan_pakai==$key->kode ? "selected" : "")." >".$key->nama."</option>";
                                        }  
                                echo "</td>";
                                echo "<td><select class='form-control' name='waktu'>";
                                    echo "<option value = ''>---</option>";
                                      foreach ($waktu->result() as $key) {
                                            echo "<option value = '".$key->kode."' ".($data->waktu==$key->kode ? "selected" : "")." >".$key->nama."</option>";
                                        }  
                                echo "</td>";
                                echo "<td><select class='form-control' name='takaran'>";
                                    echo "<option value = ''>---</option>";
                                      foreach ($tak->result() as $tkr) {
                                            echo "<option value = '".$tkr->kode."' ".($data->takaran==$tkr->kode ? "selected" : "")." >".$tkr->nama."</option>";
                                        }  
                                echo "</td>";
                                echo "<td class='text-right'><input class='form-control' class='form-control' type = 'text 'name='pagi' value='".$data->pagi."'></td>";
                                echo "<td class='text-right'><input class='form-control' class='form-control' type = 'text 'name='siang' value='".$data->siang."'></td>";
                                echo "<td class='text-right'><input class='form-control' type = 'text 'name='sore' value='".$data->sore."'></td>";
                                echo "<td class='text-right'><input class='form-control' type = 'text 'name='malem' value='".$data->malem."'></td>";
                                echo "<td><select class='form-control' name='waktu_lainnya'>";
                                    echo "<option value = ''>---</option>";
                                      foreach ($wl->result() as $wk) {
                                            echo "<option value = '".$wk->kode."' ".($data->waktu_lainnya==$wk->kode ? "selected" : "")." >".$wk->nama."</option>";
                                        }  
                                echo "</td>";
                                echo "<td><button type='submit' class='btn btn-success'><i class='fa fa-check'></i></button></td>";
                            echo form_close();
                            echo "<td class='text-right'><a href='#' class='qty dataChange' obat='".$data->kode_obat."' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td class='text-center'>".$data->satuan."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "<td class='text-right'><a href='#' class='qty_obat_kronis dataChange' obat='".$data->kode_obat."' id='".$data->id."'>".$data->qty_obat_kronis."</a></td>";
                            echo "<td class='text-right'>".number_format($data->harga_obat_kronis,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr><th colspan="12" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th><th style="vertical-align: middle"  colspan="4"><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th></tr>
                    <tr>
                        <th colspan="12" style="vertical-align: middle" ><span class="pull-right">Disc</span></th>
                        <th width="250px" style="vertical-align: middle" colspan="4">
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
                    <tr><th colspan="12" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th><th style="vertical-align: middle" colspan="4"><input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>"></th></tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="col-md-9">
                <?php echo form_open("apotek/addobat",array("id"=>"formsave","class"=>"form-horizontal"));?>
                <input type="hidden" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                <input type="hidden" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                <div class="form-group">
                    <div class="col-md-11">
                        <select class="form-control obat" name="obat[]" <?php echo $disabled;?> multiple="multiple">
                            <?php 
                                foreach ($t->result() as $key) {
                                    echo '<option value="'.$key->kode.'">'.$key->nama.'&nbsp;&nbsp;|&nbsp;&nbsp;'.$key->stsisa.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1"><button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></div>
                </div>
                <?php echo form_close();?>
            </div>
            <div class="col-md-3">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                        <button class="lunas btn btn-success" type="button" <?php echo $disabled;?>> Simpan</button>
                        <button class="print btn btn-info" type="button" <?php echo $disabled_print;?>><i class="fa fa-print"></i> Print</button>
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
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #f4f4f4;
    }
</style>