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
        $("[name='dokter_operasi']").select2();
        $("[name='dokter_anastesi']").select2();
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl
        });
        $(".cetak").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            var pelayanan = $("[name='pelayanan']").val();
            var dokter_operasi = $("[name='dokter_operasi']").val();
            var dokter_anastesi = $("[name='dokter_anastesi']").val();
            var url = "<?php echo site_url('oka/cetakrekap')?>/"+tindakan+"/"+tgl1+"/"+tgl2+"/"+pelayanan+"/"+dokter_operasi+"/"+dokter_anastesi;
            openCenteredWindow(url);
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('oka')?>";
            return false;
        });
        $(".cetak_pasien").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $(".bg-blue").attr("tindakan");
            var pelayanan = $("[name='pelayanan']").val();
            var dokter_operasi = $("[name='dokter_operasi']").val();
            var dokter_anastesi = $("[name='dokter_anastesi']").val();
            var url = "<?php echo site_url('oka/cetakpasien')?>/"+tindakan+"/"+tgl1+"/"+tgl2+"/"+pelayanan+"/"+dokter_operasi+"/"+dokter_anastesi;
            openCenteredWindow(url);
        });
        
        $(".excel").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            var pelayanan = $("[name='pelayanan']").val();
            var dokter_operasi = $("[name='dokter_operasi']").val();
            var dokter_anastesi = $("[name='dokter_anastesi']").val();
            var url = "<?php echo site_url('oka/excelrekap')?>/"+tindakan+"/"+tgl1+"/"+tgl2+"/"+pelayanan+"/"+dokter_operasi+"/"+dokter_anastesi;
            openCenteredWindow(url);
        });
        $(".cari").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            var pelayanan = $("[name='pelayanan']").val();
            var dokter_operasi = $("[name='dokter_operasi']").val();
            var dokter_anastesi = $("[name='dokter_anastesi']").val();
            window.location = "<?php echo site_url("oka/rekap");?>/"+tindakan+"/"+tgl1+"/"+tgl2+"/"+pelayanan+"/"+dokter_operasi+"/"+dokter_anastesi;
        });
        $(".bg-blue").click(function(){
            $(".modal_view_pasien").modal("show");
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $(this).attr("tindakan");
            var pelayanan = $(this).attr("pelayanan");
            var dokter_operasi = $("[name='dokter_operasi']").val();
            var dokter_anastesi = $("[name='dokter_anastesi']").val();
            var nama_tindakan = $(this).attr("nama_tindakan");
            // if (tindakan == "RANAP") {}
            $.ajax({
                url: "<?php echo site_url("oka/getpasien_rekap_inap");?>/"+tindakan+"/"+tgl1+"/"+tgl2+"/"+pelayanan+"/"+dokter_operasi+"/"+dokter_anastesi, 
                success: function(result){
                    console.log(result);
                    $(".nama_tindakan").html(nama_tindakan);
                    content  = '<table class="table table-bordered table-hover " id="myTable" >';
                    content += '<thead>';
                    content += '    <tr class="bg-navy">';
                    content += '        <th class="text-center">Nomor REG</th>';
                    content += '        <th class="text-center">Nomor RM</th>';
                    content += '        <th>Nama</th>';
                    content += '        <th class="text-center">Tgl Periksa</th>';
                    content += '        <th class="text-center">Kamar Operasi</th>';
                    content += '        <th class="text-center">Dokter Operasi</th>';
                    content += '    </tr>';
                    content += '</thead>';
                    content += '<tbody>';
                    var layan = "";
                    $.each(JSON.parse(result), function(key, value){
                        content += "<tr id=data>" ;
                        content += "<td class='text-center'>"+value.no_reg+"</td>";
                        content += "<td class='text-center'>"+value.no_rm+"</td>";
                        content += "<td>"+value.nama_pasien+"</td>";
                        content += "<td class='text-center'>"+value.tanggal+"</td>";
                        content += "<td>"+value.kamar_operasi+"</td>";
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
<?php 
    if ($pelayanan == "RANAP") {
        $lan = "";
        $nap = "selected";
    }
    else if ($pelayanan == "RALAN") {
        $lan = "selected";
        $nap = "";
    }else{
        $lan=
        $nap="";
    }
?>
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="form-horizontal">
                <div class="col-xs-12 col-lg-6">
                    <div class="row">
                        <div class="col-xs-12 col-lg-11">
                            <div class="form-group">
                                <label class="col-xs-4 control-label">Tindakan</label>
                                <div class="col-xs-8">
                                    <select name="tindakan" class="form-control">
                                        <option value="all">ALL</option>
                                        <?php
                                            foreach ($t->result() as $key) {
                                                echo "<option value='".$key->kode."' ".($tindakan==$key->kode ? "selected" : "").">".$key->nama_tindakan."</option>";
                                             } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="control-label col-xs-4">Pelayanan</label>
                            <div class="col-xs-6">   
                                <select name="pelayanan" id="" class="form-control">
                                    <option value="all">ALL</option>
                                    <option value="RALAN" <?php echo $lan ?>>RALAN</option>
                                    <option value="RANAP" <?php echo $nap ?>>RANAP</option>
                                </select>
                            </div>
                            <div class="col-xs-2">   
                                <button  title="Cari" type="button" class="cari btn btn-md btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                                <!-- <span class="input-group-btn"> -->
                                <!-- </span> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="control-label col-xs-4">Dokter Operasi</label>
                            <div class="col-xs-8">   
                                <select name="dokter_operasi" class="form-control">
                                    <option value="all">ALL</option>
                                    <?php
                                        foreach ($dokter_operasi->result() as $key) {
                                            echo "<option value='".$key->id_dokter."' ".($dokter_operasi1==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                         } 
                                    ?>
                                </select>
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
                
                <div class="col-xs-12 col-lg-6">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="control-label col-xs-4">Dokter Anastesi</label>
                            <div class="col-xs-8">   
                                <select name="dokter_anastesi" class="form-control">
                                    <option value="all">ALL</option>
                                    <?php
                                        foreach ($dokter_anastesi->result() as $key) {
                                            echo "<option value='".$key->id_dokter."' ".($dokter_anastesi1==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                         } 
                                    ?>
                                </select>
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
                                    <input name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" type="text" class="form-control" placeHolder="Tanggal ke-2">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal pull-right">
                    <button class="back btn btn-warning"><span class="fa fa-arrow-left"></span> Back</button>
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
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
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
                            $dinas = $umum = $bpjs = $prsh = 0;
                            foreach($t->result() as $data){
                                $jml = isset($p["tindakan"][$data->kode]) ? $p["tindakan"][$data->kode] : 0;
                                if ($tindakan!="all"){
                                    if ($tindakan==$data->kode){
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
                                echo "<tr ".$hide." tindakan='".$data->kode."' nama_tindakan='".$data->nama_tindakan."'>";
                                echo "<td class='text-right'>".($i++)."</td>";
                                echo "<td>".$data->nama_tindakan."</td>";
                                echo "<td class='text-right'>".(isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0)."</td>";
                                $jumlah = (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)+
                                          (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)+
                                          (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)+
                                          (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                                $dinas += (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0);
                                $umum += (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0);
                                $bpjs += (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0);
                                $prsh += (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                                echo "<td class='text-right'>".$jumlah."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                            <th colspan="2">Jumlah Pasien</th>
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
                <div class="list-pasien table-responsive">
                </div>
                <div>
                    <button class = "cetak_pasien btn btn-primary">Cetak</button>
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