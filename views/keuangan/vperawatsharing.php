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
            window.location = "<?php echo site_url("keuangan/perawatsharing");?>/"+tgl1+"/"+tgl2;
        });
        $("[name='gol_pasien'], [name='pelayanan']").change(function(){
            var id_perawat = $("[name='id_perawat']").val();
            listpasien(id_perawat);
        })
        $('tr.data').click(function(){
            var id_perawat = $(this).attr("id_perawat");
            $("[name='id_perawat']").val(id_perawat);
            listpasien(id_perawat);
        });
        $(".cetakdetail").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var gol_pasien = $("[name='gol_pasien']").val();
            var pelayanan = $("[name='pelayanan']").val();
            var id_perawat = $("[name='id_perawat']").val();
            var url = "<?php echo site_url('keuangan/cetakdetail_perawatsharing')?>/"+tgl1+"/"+tgl2+"/"+id_perawat+"/"+gol_pasien+"/"+pelayanan;
            openCenteredWindow(url);
        });
        $(".exceldetail").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var gol_pasien = $("[name='gol_pasien']").val();
            var pelayanan = $("[name='pelayanan']").val();
            var id_perawat = $("[name='id_perawat']").val();
            var url = "<?php echo site_url('keuangan/exceldetail_perawatsharing')?>/"+tgl1+"/"+tgl2+"/"+id_perawat+"/"+gol_pasien+"/"+pelayanan;
            openCenteredWindow(url);
        });
    });  
    function listpasien(id_perawat){
        $(".modaldetail").modal("show");
        $(".listdetail").html("");
        var gol_pasien = $("[name='gol_pasien']").val();
        var pelayanan = $("[name='pelayanan']").val();
        var row = <?php echo json_encode($q["detail"]) ?>;
        var tr = <?php echo json_encode($q["tarifrs"]) ?>;
        var td = <?php echo json_encode($q["tarifasisten"]) ?>;
        var namatd = <?php echo json_encode($q["namatarifasisten"]) ?>;
        var gp = <?php echo json_encode($q["golpas"]) ?>;
        var html = "";
        var i = 1;
        var total = 0;
        var n = 0;
        $.each(row[id_perawat],function(key,value){
            $.each(value,function(ktarif,val){
                if (val.gol_pasien==11){
                    var tarif_rs = tr[ktarif][key];
                }
                else{
                    var tarif_rs = val.tarif_rumahsakit;
                }
                if (val.tarif_bpjs==null) var persen = 100; 
                // if (parseInt(persen)>100) persen = 100;
                if (val.gol_pasien!=11){
                    n++;
                }
                if (val.gol_pasien==11){
                    var str_golpas = "UMUM";
                } else 
                if (val.gol_pasien>=12 && val.gol_pasien<=18){
                    var str_golpas = "PERUSAHAAN";
                } else {
                    var str_golpas = "BPJS";
                }
                if (pelayanan=="all"){
                    if (gol_pasien=="all"){
                        html += "<tr>";
                        html += "<td>"+(i++)+"</td>";
                        html += "<td>"+val.no_reg+" | "+val.nama_pasien+"</td>";
                        html += "<td class='text-right'>"+number_format(parseInt(tr[ktarif][key]),0)+"</td>";
                        html += "<td class='text-center'>"+parseFloat(td[ktarif])+" %</td>";
                        var bruto = parseInt(tr[ktarif][key])*parseFloat(td[ktarif])/100;
                        html += "<td class='text-right'>"+number_format(bruto,0)+"</td>";
                        total += bruto;
                        html += "</tr>";
                    } else {
                        if (gol_pasien==str_golpas){
                            html += "<tr>";
                            html += "<td>"+(i++)+"</td>";
                            html += "<td>"+val.no_reg+" | "+val.nama_pasien+"</td>";
                            html += "<td class='text-right'>"+number_format(parseInt(tr[ktarif][key]),0)+"</td>";
                            html += "<td class='text-center'>"+parseFloat(td[ktarif])+" %</td>";
                            var bruto = parseInt(tr[ktarif][key])*parseFloat(td[ktarif])/100;
                            html += "<td class='text-right'>"+number_format(bruto,0)+"</td>";
                            total += bruto;
                            html += "</tr>";
                        }
                    }
                } else {
                    if (pelayanan==val.pelayanan){
                        if (gol_pasien=="all"){
                            html += "<tr>";
                            html += "<td>"+(i++)+"</td>";
                            html += "<td>"+val.no_reg+" | "+val.nama_pasien+"</td>";
                            html += "<td class='text-right'>"+number_format(parseInt(tr[ktarif][key]),0)+"</td>";
                            html += "<td class='text-center'>"+parseFloat(td[ktarif])+" %</td>";
                            var bruto = parseInt(tr[ktarif][key])*parseFloat(td[ktarif])/100;
                            html += "<td class='text-right'>"+number_format(bruto,0)+"</td>";
                            total += bruto;
                            html += "</tr>";
                        } else {
                            if (gol_pasien==str_golpas){
                                html += "<tr>";
                                html += "<td>"+(i++)+"</td>";
                                html += "<td>"+val.no_reg+" | "+val.nama_pasien+"</td>";
                                html += "<td class='text-right'>"+number_format(parseInt(tr[ktarif][key]),0)+"</td>";
                                html += "<td class='text-center'>"+parseFloat(td[ktarif])+" %</td>";
                                var bruto = parseInt(tr[ktarif][key])*parseFloat(td[ktarif])/100;
                                html += "<td class='text-right'>"+number_format(bruto,0)+"</td>";
                                total += bruto;
                                html += "</tr>";
                            }
                        }
                    }
                }
            });
        });
        html += "<tr>";
        html += "<td colspan='4'>JUMLAH</td>";
        html += "<td class='text-right'>"+number_format(total,0)+"</td>";
        html += "</tr>";
        $(".listdetail").html(html);
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
                        PEMBAGIAN JASA ASISTEN ANAESTESI
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
                            <th class="text-center" style="vertical-align:middle" rowspan="2">Kode</th>
                            <th class="text-center" style="vertical-align:middle" rowspan="2">Nama Asisten</th>
                            <!-- <th colspan=3 class="text-center">Rawat Jalan</th> -->
                            <th colspan=3 class="text-center">Rawat Inap</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle" >Total</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle" >Pajak</th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle" >Jasa</th>
                        </tr>
                        <tr class="bg-navy">
                            <!-- <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">P</th> -->
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
                            // echo json_encode($q["detail"]);
                            $row = $q["detail"];
                            $tr = $q["tarifrs"];
                            $td = $q["tarifasisten"];
                            $gp = $q["golpas"];
                            foreach($d as $key => $value){
                                $total = 0;
                                $total_umum_ralan = $total_bpjs_ralan = $total_perusahaan_ralan = 0;
                                $total_umum_ranap = $total_bpjs_ranap = $total_perusahaan_ranap = 0;
                                foreach($row[$key] as $rkey => $rvalue){
                                    foreach($rvalue as $ktarif => $val){
                                        if ($val->gol_pasien==11){
                                            $tarif_rs = $tr[$ktarif][$rkey];
                                        }
                                        else{
                                            $tarif_rs = $val->tarif_rumahsakit;
                                        }
                                        $bruto = $tr[$ktarif][$rkey]*$td[$ktarif]/100;
                                        $total += $bruto;
                                        if ($val->pelayanan=="ralan"){
                                            if ($val->gol_pasien==11){
                                                $total_umum_ralan += $bruto;
                                            } else 
                                            if ($val->gol_pasien>=12 && $val->gol_pasien<=18){
                                                $total_perusahaan_ralan += $bruto;
                                            } else {
                                                $total_bpjs_ralan += $bruto;
                                            }
                                        } else {
                                            if ($val->gol_pasien==11){
                                                $total_umum_ranap += $bruto;
                                            } else 
                                            if ($val->gol_pasien>=12 && $val->gol_pasien<=18){
                                                $total_perusahaan_ranap += $bruto;
                                            } else {
                                                $total_bpjs_ranap += $bruto;
                                            }
                                        }
                                    }
                                }
                                if ($golpas!="all"){
                                    if ($golpas==$str_golpas){
                                        $umum_ralan = $q["pelayanan_ralan"][$key]["UMUM"];
                                        $bpjs_ralan = $q["pelayanan_ralan"][$key]["BPJS"];
                                        $perusahaan_ralan = $q["pelayanan_ralan"][$key]["PERUSAHAAN"];
                                        $umum_inap = $q["pelayanan_inap"][$key]["UMUM"];
                                        $bpjs_inap = $q["pelayanan_inap"][$key]["BPJS"];
                                        $perusahaan_inap = $q["pelayanan_inap"][$key]["PERUSAHAAN"];
                                        // $total = $umum_ralan+$umum_inap+$bpjs_ralan+$bpjs_inap+$perusahaan_ralan+$perusahaan_inap;
                                        echo "<tr class='data' id_perawat='".$key."'>";
                                        echo "<td class='text-center'>".$key."</td>";
                                        echo "<td>".$value."</td>";
                                        // echo "<td class='text-right'>".number_format($total_umum_ralan,0,',','.')."</td>";
                                        // echo "<td class='text-right'>".number_format($total_bpjs_ralan,0,',','.')."</td>";
                                        // echo "<td class='text-right'>".number_format($total_perusahaan_ralan,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($total_umum_ranap,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($total_bpjs_ranap,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($total_perusahaan_ranap,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($total,0,',','.')."</td>";
                                        $nominal_pajak = $total*$pajak[$key]/100;
                                        echo "<td class='text-right'>".number_format($nominal_pajak,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($total-$nominal_pajak,0,',','.')."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    $umum_ralan = $q["pelayanan_ralan"][$key]["UMUM"];
                                    $bpjs_ralan = $q["pelayanan_ralan"][$key]["BPJS"];
                                    $perusahaan_ralan = $q["pelayanan_ralan"][$key]["PERUSAHAAN"];
                                    $umum_inap = $q["pelayanan_inap"][$key]["UMUM"];
                                    $bpjs_inap = $q["pelayanan_inap"][$key]["BPJS"];
                                    $perusahaan_inap = $q["pelayanan_inap"][$key]["PERUSAHAAN"];
                                    $total = $umum_ralan+$umum_inap+$bpjs_ralan+$bpjs_inap+$perusahaan_ralan+$perusahaan_inap;
                                    echo "<tr class='data' id_perawat='".$key."'>";
                                    echo "<td class='text-center'>".$key."</td>";
                                    echo "<td>".$value."</td>";
                                    // echo "<td class='text-right'>".number_format($total_umum_ralan,0,',','.')."</td>";
                                    // echo "<td class='text-right'>".number_format($total_bpjs_ralan,0,',','.')."</td>";
                                    // echo "<td class='text-right'>".number_format($total_perusahaan_ralan,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($total_umum_ranap,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($total_bpjs_ranap,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($total_perusahaan_ranap,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($total,0,',','.')."</td>";
                                    $nominal_pajak = $total*$pajak[$key]/100;
                                    echo "<td class='text-right'>".number_format($nominal_pajak,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($total-$nominal_pajak,0,',','.')."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-navy">
                            <th colspan=5>JUMLAH</th>
                            <th style='text-align:right' colspan=3><?php echo number_format($jumlah,0,',','.');?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:90%">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                Detail Pasien
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Gol. Pasien</label>
                                <div class="col-md-4">
                                    <select class="form-control" name='gol_pasien'>
                                        <option value="all">---ALL---</option>
                                        <option value="UMUM">UMUM</option>
                                        <option value="BPJS">BPJS</option>
                                        <option value="PERUSAHAAN">PERUSAHAAN</option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label">Pelayanan</label>
                                <div class="col-md-4">
                                    <select class="form-control" name='pelayanan'>
                                        <option value="all">---ALL---</option>
                                        <option value="ralan">Rawat Jalan</option>
                                        <option value="ranap">Rawat Inap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="cetakdetail btn btn-sm btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
                                <button type="button" class="exceldetail btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel</button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                </div>
                <div class="table-responsive">
                    <input type="hidden" name="id_perawat">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class='bg-navy'>
                                <th>No.</th>
                                <th>No. Reg/ Nama Pasien</th>
                                <th class="text-center">Jasa</th>
                                <th class="text-center">Persentase</th>
                                <!-- <th>Pajak</th> -->
                                <th class="text-center">Jasa Bruto</th>
                            </tr>
                        </thead>
                        <tbody class="listdetail">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>