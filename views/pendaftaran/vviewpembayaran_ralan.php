
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
    $('.modalpassword').on('shown.bs.modal', function () {
        $(".password").focus();
    })
    $(document).ready(function(){
        gettotal();
        $("[name='bayarsharing'],[name='dp_nominal'], [name='disc_nominal'], [name='sharing']").mask('000.000.000', {reverse: true});
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");
        $("[name='tindakan']").change(function(){
            $(".modalpassword").modal("show");
            $("[name='jenis_password']").val("tindakan");
            
        });
        $('.okpassword').click(function(){
            var password = $("[name='password']").val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/cekpassword_tindakan",
                method : "POST",
                data : {password: password},
                success: function(data){
                    if (data=="1")
                        add();
                    else
                        alert("Password tidak sesuai");
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $("[name='penunjang']").change(function(){
            $(".modalpassword").modal("show");
            $("[name='jenis_password']").val("penunjang");
            $("[name='idtindakan']").val($(this).val());
        });
        $("[name='tindakan_radiologi']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var jenis= $("[name='jenis']").val();
            var tindakan= $(this).val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/addtindakan_radiologi",
                method : "POST",
                data : {no_reg: no_reg, jenis: jenis, tindakan: tindakan},
                success: function(data){
                     location.reload();
                }
            });
        });
        $('.back').click(function(){
            window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
        });
        // $('.back').click(function(){
        //     var cari_no = $("[name='no_rm']").val();
        //     $.ajax({
        //         type  : "POST",
        //         data  : {cari_no:cari_no},
        //         url   : "<?php echo site_url('pendaftaran/getcaripasien_ralan');?>",
        //         success : function(result){
        //             window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
        //         },
        //         error: function(result){
        //             alert(result);
        //         }
        //     });
        // });
        $('.print').click(function(){
            var no_rm= $("[name='no_rm']").val();
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('kasir/cetakkwitansi');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
        });
        $('.lunas').click(function(){
            $(".modalnotif").modal("show");
            var total = $("[name='total']").val();
            $(".total").html("Rp. "+total);
        });
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            alert(id);
            $("[name='jenis_password']").val("hapustindakan");
            $("[name='idtindakan']").val(id);
            $(".modalpassword").modal("show");
        });
        $('.hapus_r').click(function(){
            var id= $(this).attr("id");
            $("[name='jenis_password']").val("hapusradiologi");
            $("[name='idtindakan']").val(id);
            $(".modalpassword").modal("show");
        });
        $('.okbayar').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var subtotal= $("[name='subtotal']").val().replace(/\D/g,'');
            var disc_nominal= $("[name='disc_nominal']").val().replace(/\D/g,'');
            var dp_nominal= $("[name='dp_nominal']").val().replace(/\D/g,'');
            if ($("[name='sharing']").hasClass="hide")
                var sharing = 0;
            else
                var sharing = $("[name='sharing']").val().replace(/\D/g,'');
            var total= $("[name='total']").val().replace(/\D/g,'');
            $.ajax({
                url : "<?php echo base_url();?>kasir/simpantransaksi",
                method : "POST",
                data : {no_reg: no_reg,disc_nominal: disc_nominal,dp_nominal: dp_nominal, sharing: sharing, total: total},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
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
        $("[name='sharing']").keyup(function(evt){
            gettotal();
            return false;
        });
        $("[name='tindakan_radiologi']").select2();
        $("[name='tindakan']").select2();
        $("[name='ambulance']").select2();
        $("[name='penunjang']").select2();
        $("[name='ambulance']").change(function(){
            $(".modalpassword").modal("show");
            $("[name='jenis_password']").val("ambulance");
            $("[name='idtindakan']").val($(this).val());
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('id');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataText.before(dataInputField).hide();
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
        });
    });
    function add(){
        var jenis_password = $("[name='jenis_password']").val();
        if (jenis_password=="tindakan"){
            var no_reg= $("[name='no_reg']").val();
            var jenis= $("[name='jenis']").val();
            var tindakan= $("[name='tindakan']").val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/addtindakan",
                method : "POST",
                data : {no_reg: no_reg, jenis: jenis, tindakan: tindakan},
                success: function(data){
                    location.reload();
                }
            });
        } else
        if (jenis_password=="hapustindakan"){
            var idtindakan= $("[name='idtindakan']").val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/hapustindakan",
                method : "POST",
                data : {id: idtindakan},
                success: function(data){
                     location.reload();
                }
            });
        } else
        if (jenis_password=="hapusradiologi"){
            var idtindakan= $("[name='idtindakan']").val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/hapustindakan",
                method : "POST",
                data : {id: idtindakan},
                success: function(data){
                     location.reload();
                }
            });
        } else
        if (jenis_password=="penunjang"){
            var no_reg= $("[name='no_reg']").val();
            var jenis= $("[name='jenis']").val();
            var tindakan= $("[name='idtindakan']").val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/addtindakan_penunjang",
                method : "POST",
                data : {no_reg: no_reg, jenis: jenis, tindakan: tindakan},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        } else
        if (jenis_password=="ambulance"){
            var tindakan= $("[name='idtindakan']").val();
            var no_reg= $("[name='no_reg']").val();
            $.ajax({
                url : "<?php echo base_url();?>kasir/addtindakan_ambulance",
                method : "POST",
                data : {no_reg: no_reg, tindakan: tindakan},
                success: function(data){
                     location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
    }
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var dp_nominal = $("[name='dp_nominal']").val().replace(/\D/g,'');
        if ($("[name='sharing']").hasClass="hide")
            var sharing = 0;
        else
            var sharing = $("[name='sharing']").val().replace(/\D/g,'');
        var total = subtotal-dp_nominal-disc_nominal-sharing;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    var changeData = function(value,id){
        $.ajax({
            url: "<?php echo site_url('kasir/changedata');?>", 
            type: 'POST', 
            data: {id: id,value: value}, 
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
        $dp_nominal = $data->jumlah_dp;
        $sharing = $data->jumlah_sharing;
        $total = $data->jumlah_bayar;
        $disc_persen = round($disc_nominal/($disc_nominal+$sharing+$total),2)*100;
        $dp_persen = round($dp_nominal/($dp_nominal+$sharing+$total),2)*100;
        // $disabled = "disabled";
        $disabled = "";
        $disabled_print = "";
        $tgl_pembayaran = "Tanggal pembayaran -> ".date("d-m-Y",strtotime($data->tanggal));
    } else {
        $dp_nominal = $dp_persen = $disc_nominal = $sharing = $total = $disc_persen = 0;
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
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
                        <th class="text-center">Tarif</th>
                        <th width="150" class='text-center'>Tagihan</th>
                        <!-- <th width="150" class='text-center'>Bayar</th>
                        <th width="150" class='text-center'>Jumlah</th> -->
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
                            echo "<td>".$data->nama_tindakan.($data->kategori!='pdf' ? "<div class='pull-right'><button id='".$data->id."' class='hapus btn btn-sm btn-danger'><i class='fa fa-minus'></i></div>":"")."</td>";
                            echo "<td class='text-right'><a href='#' class='dataChange' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            echo "</tr>";
                        }
                        foreach($k1->result() as $data1){
                            $subtotal += $data1->jumlah;
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".$data1->nama_tindakan." <div class='pull-right'><button id='".$data1->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange' id='".$data1->id."'>".number_format($data1->jumlah,0,'.','.')."</a></td>";
                            echo "</tr>";
                        }
                        foreach($k2->result() as $data2){
                            $subtotal += $data2->jumlah;
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".$data2->nama_tindakan." <div class='pull-right'><button id='".$data2->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange' id='".$data2->id."'>".number_format($data2->jumlah,0,'.','.')."</a></td>";
                            echo "</tr>";
                        }
                        foreach($p1->result() as $data2){
                            $subtotal += $data2->jumlah;
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".$data2->ket." <div class='pull-right'><button id='".$data2->id."' class='hapus_r btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td class='text-right'><a href='#' class='dataChange' id='".$data2->id."'>".number_format($data2->jumlah,0,'.','.')."</a></td>";
                            echo "</tr>";
                        }
                        $total_lab1 = 0;
                        foreach($l1->result() as $datal1){
                            $total_lab1 += $datal1->jumlah;
                        }
                        if ($total_lab1>0){
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>Labotarium</td>";
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
                            echo "<td>Patologi Anatomi</td>";
                            echo "<td class='text-right'>".number_format($total_pa1,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        $subtotal += $total_pa1;
                        // $total_lab2 = 0;
                        // foreach($l2->result() as $datal2){
                        //     $total_lab2 += $datal2->jumlah;
                        // }
                        // if ($total_lab2>0){
                        //     echo "<tr>";
                        //     echo "<td>".$i++."</td>";
                        //     echo "<td>Labotarium (IGD)</td>";
                        //     echo "<td class='text-right'>".number_format($total_lab2,0,'.','.')."</td>";
                        //     echo "</tr>";
                        // }
                        // $subtotal += $total_lab2;
                        foreach($a1->result() as $data){
                            $subtotal += $data->jumlah;
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".$data->kota."<div class='pull-right'><button id='".$data->id."' class='hapus btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            // echo "<td class='text-right'><a href='#' class='petugas dataChange' id='".$data->id."'>".($data->kode_petugas)."</a></td>";
                            echo "<td class='text-right'><a href='#' class='tagihan dataChange' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            // echo "<td class='text-right'><a href='#' class='qty dataChange' id='".$data->id."'>".$data->qty."</a></td>";
                            // echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr><th colspan="2" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th><th style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th></tr>
                    <tr>
                        <th colspan="2" style="vertical-align: middle" ><span class="pull-right">Down Payment (DP)</span></th>
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
                    <?php if($row->status_bayar=="TAGIH"):?>
                    <tr><th colspan="2" style="vertical-align: middle" ><span class="pull-right">Sharing</span></th><th style="vertical-align: middle" ><input type="text" name="sharing" class="form-control text-right" value="<?php echo number_format($sharing,0,',','.');?>"></th></tr>
                    <?php endif ?>
                    <tr><th colspan="2" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th><th style="vertical-align: middle" ><input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>"></th></tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="col-sm-8">
                <div class="col-sm-4">
                <select class="form-control" name="tindakan">
                    <option value="">---Tindakan Poliklinik---</option>
                    <?php 
                        foreach ($t->result() as $key) {
                            echo '<option value="'.$key->kode_tindakan.'">'.$key->nama_tindakan.'</option>';
                        }
                    ?>
                </select>
                </div>
                <!-- <div class="col-sm-4">
                <select class="form-control" name="tindakan_radiologi">
                    <option value="">---Tindakan Radiologi---</option>
                    <?php 
                        foreach ($t1->result() as $key1) {
                            echo '<option value="'.$key1->id_tindakan.'">'.$key1->nama_tindakan.'</option>';
                        }
                    ?>
                </select>
                </div> -->
                <div class="col-sm-4">
                    <select class="form-control" name="ambulance">
                        <option value="">---Pilih Ambulance---</option>
                        <?php 
                            foreach ($a->result() as $key) {
                                echo '<option value="'.$key->kode.'">'.$key->kota.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="penunjang">
                        <option value="">---Pilih Penunjang---</option>
                        <?php 
                            foreach ($p->result() as $key) {
                                echo '<option value="'.$key->kode.'">'.$key->ket.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
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
<div class="modal fade modalpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy">Masukan Password</div>
            <div class="modal-body">
                <input type="hidden" name="idtindakan">
                <input type="hidden" name="jenis_password">
                <input type="password" name="password" class="form-control password">
            </div>
            <div class="modal-footer">
                <button class="okpassword btn btn-success" type="button">OK</button>
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