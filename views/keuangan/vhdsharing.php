<script>
	function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ajaxStart(function () {
        $('.loading').show();
    }).ajaxStop(function () {
        $('.loading').hide();
        $(".modaldetail").modal("show");
    });
	$(document).ready(function(e){
        $("[name='poli']").select2();
		var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".print").click(function(){
            var id = $(".bg-gray").attr("href");
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('keuangan/cetak_feesharing')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var frm = $("[name='frm']").val();
            window.location = "<?php echo site_url("keuangan/hdsharing");?>/"+tgl1+"/"+tgl2;
        });
        $('tr.data').click(function(){
            listpasien();
        });
        $(".cetakdetail").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('keuangan/cetakdetail_hdsharing')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".exceldetail").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('keuangan/exceldetail_hdsharing')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
    });  
    function listpasien(){
        $(".listdetail").html("");
        var tgl1 = $("[name='tgl1']").val();
        var tgl2 = $("[name='tgl2']").val();
        var html = "";
        var total = 0;
        var jumlah = 0;
        var valdokter = 0;
        $.ajax({
            async: false,
            url : "<?php echo base_url();?>keuangan/gethdsharing",
            method : "POST",
            data : {tgl1: tgl1, tgl2: tgl2},
            success: function(data){
                console.log(data);
                var row = JSON.parse(data);
                var i = 1;
                var subtotal = 0;
                var total_jumlah = 0;
                var semua = 0;
                var semua_total = 0;
                var total_dokter = 0;
                var total_perawat = 0;
                var total_administrasi = 0;
                var total_bhp = 0;
                var total_rumahsakit = 0;
                // html += "<tr class='bg-orange'>";
                // html += "<td class='text-bold' colspan='9'>RAWAT JALAN</td>";
                // html += "</tr>";
                $.each(row["tarif"],function(key,value){
                    var jumlah = parseInt(row["jumlah"][key]);
                    valdokter = value.dokter;
                    subtotal = (value.dokter!=undefined ? value.dokter*jumlah/100 : 0)+
                    (value.perawat!=undefined ? value.perawat*jumlah/100 : 0)+
                    (value.administrasi!=undefined ? value.administrasi*jumlah/100 : 0)+
                    (value.bhp!=undefined ? value.bhp*jumlah/100 : 0)+
                    (value.rumahsakit!=undefined ? value.rumahsakit*jumlah/100 : 0);
                    html += "<tr>";
                    html += "<td>"+(i++)+"</td>";
                    html += "<td>"+(key=="hdl" ? "Rawat Inap" : "Rawat Jalan")+"</td>";
                    html += "<td class='text-right'>"+number_format(jumlah,0)+"</td>";
                    html += "<td class='text-right'>"+(value.dokter!=undefined ? number_format(value.dokter*jumlah/100,0) : "-")+"</td>";
                    html += "<td class='text-right'>"+(value.perawat!=undefined ? number_format(value.perawat*jumlah/100,0) : "-")+"</td>";
                    html += "<td class='text-right'>"+(value.administrasi!=undefined ? number_format(value.administrasi*jumlah/100,0) : "-")+"</td>";
                    html += "<td class='text-right'>"+(value.bhp!=undefined ? number_format(value.bhp*jumlah/100,0) : "-")+"</td>";
                    html += "<td class='text-right'>"+(value.rumahsakit!=undefined ? number_format(value.rumahsakit*jumlah/100,0) : "-")+"</td>";
                    html += "<td class='text-right'>"+(number_format(subtotal,0))+"</td>";
                    html += "</tr>";
                    total += parseInt(subtotal);
                    total_jumlah += parseInt(jumlah);
                    total_dokter += parseInt(value.dokter)*jumlah/100;
                    total_perawat += parseInt(value.perawat)*jumlah/100;
                    total_administrasi += parseInt(value.administrasi)*jumlah/100;
                    total_bhp += parseInt(value.bhp)*jumlah/100;
                    total_rumahsakit += parseInt(value.rumahsakit)*jumlah/100;
                });
                semua += total_jumlah;
                semua_total += total;
                html += "<tr class='bg-orange'>";
                html += "<td colspan='2'>JUMLAH</td>";
                html += "<td class='text-right'>"+number_format(total_jumlah,0)+"</td>";
                html += "<td class='text-right'>"+number_format(total_dokter,0)+"</td>";
                html += "<td class='text-right'>"+number_format(total_perawat,0)+"</td>";
                html += "<td class='text-right'>"+number_format(total_administrasi,0)+"</td>";
                html += "<td class='text-right'>"+number_format(total_bhp,0)+"</td>";
                html += "<td class='text-right'>"+number_format(total_rumahsakit,0)+"</td>";
                html += "<td class='text-right'>"+number_format(total,0)+"</td>";
                html += "</tr>";
                $(".listdetail").html(html);
            },
            error: function(data){
                console.log(data);
            }
        });
        $.ajax({
            url : "<?php echo base_url();?>keuangan/getdokter_hd",
            method : "POST",
            success: function(data){
                var listdokter = JSON.parse(data);
                var html = "";
                var i = 1;
                $.each(listdokter,function(key,value){
                    html += "<tr>";
                    html += "<td class='text-right' width='20px'>"+(i++)+"</td>";
                    html += "<td>"+value.id_dokter+"</td>";
                    html += "<td>"+value.nama_dokter+"</td>";
                    var persen = (valdokter*total/100)*(parseInt(value.persentase)/100);
                    html += "<td class='text-right'>"+number_format(persen,0)+"</td>";
                    html += "</tr>";
                });
                $(".listdokter").html(html);
            }
        })
    }
    function number_format (number, decimals, dec_point=",", thousands_sep=".") {
        // Strip all characters but numerical ones.
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
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
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
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                            <input type="text" class="form-control" name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" autocomplete="off"/>   
                    </div>
                    <div class="col-md-2"><button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i> Search</button></div>
                </div>
            </div>
            <table  width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        HAEMODIALISA
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr class="bg-navy">
                            <th colspan=3 class="text-center">Rawat Jalan</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle" >Subotal</th>
                            <th colspan=3 class="text-center">Rawat Inap</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle" >Subotal</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle" >Total</th>
                        </tr>
                        <tr class="bg-navy">
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">P</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">P</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no_reg = "";
                            $i = 1;
                            $jumlah = 0;
                            $total = 0;
                            $total_umum_ralan = 
                            $total_bpjs_ralan = 
                            $total_perusahaan_ralan = 
                            $total_umum_ranap = 
                            $total_bpjs_ranap = 
                            $total_perusahaan_ranap = 0;
                            foreach($q["jml_ralan"] as $kode_tarif => $val){
                                foreach($val as $golpas => $bruto){
                                    if ($golpas=="UMUM")
                                        $total_umum_ralan += $bruto;
                                    else if ($golpas=="BPJS")
                                        $total_bpjs_ralan += $bruto;
                                    else if ($golpas=="PERUSAHAAN")
                                        $total_perusahaan_ralan += $bruto;
                                }
                            }
                            foreach($q["jml_ranap"] as $kode_tarif => $val){
                                foreach($val as $golpas => $bruto){
                                    if ($golpas=="UMUM")
                                        $total_umum_ranap += $bruto;
                                    else if ($golpas=="BPJS")
                                        $total_bpjs_ranap += $bruto;
                                    else if ($golpas=="PERUSAHAAN")
                                        $total_perusahaan_ranap += $bruto;
                                }
                            }
                            $total_ralan = $total_umum_ralan+$total_bpjs_ralan+$total_perusahaan_ralan;
                            $total_ranap = $total_umum_ranap+$total_bpjs_ranap+$total_perusahaan_ranap;
                            $total = $total_umum_ralan+$total_bpjs_ralan+$total_perusahaan_ralan+$total_umum_ranap+$total_bpjs_ranap+$total_perusahaan_ranap;
                            echo "<tr class='data'>";
                            echo "<td class='text-right'>".number_format($total_umum_ralan,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_bpjs_ralan,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_perusahaan_ralan,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_ralan,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_umum_ranap,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_bpjs_ranap,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_perusahaan_ranap,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_ranap,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total,0,',','.')."</td>";
                            echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:90%">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                Detail Tindakan
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="cetakdetail btn btn-sm btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
                                <button type="button" class="exceldetail btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive">
                    <input type="hidden" name="id_dokter">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class='bg-navy'>
                                <th>No.</th>
                                <th class="text-center">Tindakan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Dokter</th>
                                <th class="text-center">Perawat</th>
                                <th class="text-center">Administrasi</th>
                                <th class="text-center">BHP</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="listdetail">
                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class='bg-navy'>
                                <th>No.</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Jasa</th>
                            </tr>
                        </thead>
                        <tbody class="listdokter">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='loading modal'>
    <div class='text-center align-middle' style="margin-top: 200px">
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
        <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
            <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url();?>/img/load.gif" width="150px"></div>
            <div style="font-size:20px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Loading</div>
        </div>
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
    </div>
</div>