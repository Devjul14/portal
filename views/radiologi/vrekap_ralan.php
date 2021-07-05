<script>

var mywindow;
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
    $(document).ajaxStart(function() {
        $(".loading").show();
    }).ajaxStop(function() {
        $(".loading").hide();
    });
    $(document).ready(function() {
        $('.warna').each(function() {
            $('tr:odd',  this).addClass('disabled');
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl
        });
        $("[name='tindakan']").select2();
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl
        });
        $(".cetak").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            var url = "<?php echo site_url('radiologi/cetakrekap_ralan')?>/"+tindakan+"/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".cetak_pasien").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan_pasien']").val();
            var url = "<?php echo site_url('radiologi/cetakpasien_ralan')?>/"+tindakan+"/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".excel").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            var url = "<?php echo site_url('radiologi/excelrekap_ralan')?>/"+tindakan+"/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".cari").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            window.location = "<?php echo site_url("radiologi/rekap_ralan");?>/"+tindakan+"/"+tgl1+"/"+tgl2;
        });
        $(".bg-blue").click(function(){
            $(".modal_view_pasien").modal("show");
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $(this).attr("tindakan");
            var nama_tindakan = $(this).attr("nama_tindakan");
            $.ajax({
                url: "<?php echo site_url("radiologi/getpasien_rekap");?>/"+tindakan+"/"+tgl1+"/"+tgl2, 
                success: function(result){
                    console.log(result);
                    $(".nama_tindakan").html(nama_tindakan);
                    content  = '<table class="table table-bordered table-hover " id="myTable" >';
                    content += '<thead>';
                    content += '    <tr class="bg-navy">';
                    content += '        <th class="text-center">No. Antrian</th>';
                    content += '        <th class="text-center">Nomor REG</th>';
                    content += '        <th class="text-center">Nomor RM</th>';
                    content += '        <th>Nama</th>';
                    content += '        <th class="text-center">Tgl Periksa</th>';
                    content += '        <th class="text-center">Pemeriksaan</th>';
                    content += '        <th class="text-center">Poliklinik Pengirim</th>';
                    content += '        <th class="text-center">Dokter Pengirim</th>';
                    content += '    </tr>';
                    content += '</thead>';
                    content += '<tbody>';
                    var layan = "";
                    $.each(JSON.parse(result), function(key, value){
                        if (value.layan=="0") {
                                layan = "<label class='label label-primary'>Layan</label>";
                        }else if(value.layan=="1") {
                                layan = "<label class='label label-success'>Layan</label>";
                        }else{
                                layan = "<label class='label label-danger'>Batal</label>";
                        }
                        content += "<tr id=data>" ;
                        content += "<td class='text-center'>"+value.no_antrian+"</td>";
                        content += "<td class='text-center'>"+value.no_reg+"</td>";
                        content += "<td class='text-center'>"+value.no_pasien+"</td>";
                        content += "<td>"+value.nama_pasien+"</td>";
                        content += "<td>"+value.tanggal+"</td>";
                        content += "<td>"+value.pemeriksaan+"</td>";
                        content += "<td>"+value.nama_poli+"</td>";
                        content += "<td>"+value.nama_dokter+"</td>";
                        content += "</tr>";
                    });
                    content += '</tbody>';
                    content += '</table>';
                    content += '<input type="hidden" name="tindakan_pasien" value='+tindakan+'>';
                    $(".list-pasien").html(content);
                },
                error: function(result){
                    console.log(result);
                }
            });
            return false;
        });
    });
</script>
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="form-horizontal">
                <div class="col-xs-12 col-lg-4">
                    <div class="row">
                        <div class="col-xs-12 col-lg-11">
                            <div class="form-group">
                                <label class="col-xs-4 control-label">Tindakan</label>
                                <div class="col-xs-8">
                                        <select name="tindakan" class="form-control">
                                            <option value="all">ALL</option>
                                            <?php
                                                foreach ($t->result() as $key) {
                                                    echo "<option value='".$key->id_tindakan."' ".($tindakan==$key->id_tindakan ? "selected" : "").">".$key->nama_tindakan."</option>";
                                                 } 
                                            ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="row">
                        <div class="col-xs-12 col-lg-11">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" type="text" class="form-control" placeHolder="Tanggal ke-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" type="text" class="form-control" placeHolder="Tanggal ke-2">
                            <span class="input-group-btn">
                                <button  title="Cari" type="button" class="cari btn btn-md btn-primary"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal pull-right">
                    <button class="cetak btn btn-primary"><span class="fa fa-print"></span> Cetak</button>
                    <button class="excel btn btn-success"><span class="fa fa-list"></span> Excel</button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-navy'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">No.</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Tindakan</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Jenis</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th class="text-center">DR</th>
                            <th class="text-center">MANUAL</th>
                            <th class="text-center">Baru</th>
                            <th class="text-center">Lama</th>
                            <th class="text-center">Reguler</th>
                            <th class="text-center">Eksekutif</th>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $hide = "";
                            $dr = $manual = $baru = $lama = $reguler = $eksekutif = $dinas = $umum = $bpjs = $prsh = 0;
                            foreach($t->result() as $data){
                                $jml = isset($p["tindakan"][$data->id_tindakan]) ? $p["tindakan"][$data->id_tindakan] : 0;
                                if ($tindakan!="all"){
                                    if ($tindakan==$data->id_tindakan){
                                        if ($jml>0){
                                            $hide = "class='bg-blue text-bold'";
                                        } else {
                                            $hide = "";
                                        }
                                    } else {
                                        $hide = "class='hide'";
                                    }
                                } else {
                                    if ($jml>0){
                                        $hide = "class='bg-blue text-bold'";
                                    } else {
                                        $hide = "";
                                    }
                                }
                                echo "<tr ".$hide." tindakan='".$data->id_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                                echo "<td class='text-right'>".($i++)."</td>";
                                echo "<td>".$data->nama_tindakan."</td>";
                                echo "<td class='text-right'>".(isset($p["DR"][$data->id_tindakan]) ? $p["DR"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["MANUAL"][$data->id_tindakan]) ? $p["MANUAL"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["BARU"][$data->id_tindakan]) ? $p["BARU"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["LAMA"][$data->id_tindakan]) ? $p["LAMA"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["REGULER"][$data->id_tindakan]) ? $p["REGULER"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["EKSEKUTIF"][$data->id_tindakan]) ? $p["EKSEKUTIF"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0)."</td>";
                                $jumlah = (isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0)+
                                          (isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0)+
                                          (isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0)+
                                          (isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0);
                                $dr += (isset($p["DR"][$data->id_tindakan]) ? $p["DR"][$data->id_tindakan] : 0);
                                $manual += (isset($p["MANUAL"][$data->id_tindakan]) ? $p["MANUAL"][$data->id_tindakan] : 0);
                                $baru += (isset($p["BARU"][$data->id_tindakan]) ? $p["BARU"][$data->id_tindakan] : 0);
                                $lama += (isset($p["LAMA"][$data->id_tindakan]) ? $p["LAMA"][$data->id_tindakan] : 0);
                                $reguler += (isset($p["REGULER"][$data->id_tindakan]) ? $p["REGULER"][$data->id_tindakan] : 0);
                                $eksekutif += (isset($p["EKSEKUTIF"][$data->id_tindakan]) ? $p["EKSEKUTIF"][$data->id_tindakan] : 0);
                                $dinas += (isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0);
                                $umum += (isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0);
                                $bpjs += (isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0);
                                $prsh += (isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0);
                                echo "<td class='text-right'>".$jumlah."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                            <th colspan="2">Jumlah Pasien</th>
                            <th class="text-right"><?php echo $dr;?></th>
                            <th class="text-right"><?php echo $manual;?></th>
                            <th class="text-right"><?php echo $baru;?></th>
                            <th class="text-right"><?php echo $lama;?></th>
                            <th class="text-right"><?php echo $reguler;?></th>
                            <th class="text-right"><?php echo $eksekutif;?></th>
                            <th class="text-right"><?php echo $dinas;?></th>
                            <th class="text-right"><?php echo $umum;?></th>
                            <th class="text-right"><?php echo $bpjs;?></th>
                            <th class="text-right"><?php echo $prsh;?></th>
                            <th class="text-right"><?php echo ($dinas+$umum+$bpjs+$prsh);?></th>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>
    </div>
</div>
<div class='modal modal_view_pasien no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-user"></i>&nbsp;&nbsp;List Pasien&nbsp;<span class="nama_tindakan"></span></h4>
            </div>
            <div class='modal-body'>
                <div class="list-pasien table-responsive"></div>
                <div>
                    <button class="cetak_pasien btn btn-primary">Cetak</button>
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
<style type="text/css">
    .modal-dialog{
        width:80%;
    }
</style>\