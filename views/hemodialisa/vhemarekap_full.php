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
            var url = "<?php echo site_url('hemodialisa/cetakrekap_full')?>/"+"all"+"/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".cetak_pasien").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan_pasien']").val();
            var url = "<?php echo site_url('hemodialisa/cetakpasien_full')?>/"+tindakan+"/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".semua").click(function(){
          if ($(this).is(":checked")) {
              $("tr#data").removeClass('hide');
          } else {
              $.each($("tr#data"), function( index, value ) {
                if (!$(this).hasClass('text-bold')){
                  $(this).addClass('hide');
                }
              })
          }
        })
        $(".excel").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            var url = "<?php echo site_url('hemodialisa/excelrekap_full')?>/"+"all"+"/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".cari").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $("[name='tindakan']").val();
            window.location = "<?php echo site_url("hemodialisa/rekap_full");?>/"+"all"+"/"+tgl1+"/"+tgl2;
        });
       $(".punya").click(function(){
            $(".modal_view_pasien").modal("show");
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var tindakan = $(this).attr("tindakan");
            var nama_tindakan = $(this).attr("nama_tindakan");
                $.ajax({
                    url: "<?php echo site_url("hemodialisa/getpasien_rekap_full");?>/"+tindakan+"/"+tgl1+"/"+tgl2,
                    success: function(result){
                        result = JSON.parse(result);
                        $(".nama_tindakan").html(nama_tindakan);
                        content  = '<table class="table table-bordered table-hover " id="myTable" >';
                        content += '<thead>';
                        content += '    <tr class="bg-navy">';
                        // content += '        <th class="text-center">No. Antrian</th>';
                        content += '        <th class="text-center">Nomor REG</th>';
                        content += '        <th class="text-center">Nomor RM</th>';
                        content += '        <th>Nama</th>';
                        content += '        <th class="text-center">Tgl Periksa</th>';
                        content += '        <th class="text-center">Ruang</th>';
                        content += '        <th class="text-center">Kelas</th>';
                        content += '        <th class="text-center">Kamar</th>';
                        content += '        <th class="text-center">Dokter Pengirim</th>';
                        content += '    </tr>';
                        content += '</thead>';
                        content += '<tbody>';
                        var layan = "";
                        $.each(result["list"], function(key, val){
                            // var kasir = (result["kasir"][val.no_reg]);
                            var master = (result["master"][val.no_reg]);
                            // var pol2 = (result["pol2"][val.no_reg]);
                            var dokter = (result["dokter"][val.no_reg]);
                            if (val.layan=="0") {
                                    layan = "<label class='label label-primary'>Layan</label>";
                            }else if(val.layan=="1") {
                                    layan = "<label class='label label-success'>Layan</label>";
                            }else{
                                    layan = "<label class='label label-danger'>Batal</label>";
                            }
                            content += "<tr id=data>" ;
                            // content += "<td class='text-center'>"+(value.no_antrian == undefined || value.no_antrian == "" ? "-" : value.no_antrian)+"</td>";
                            content += "<td class='text-center'>"+val.no_reg+"</td>";
                            content += "<td class='text-center'>"+(val.no_pasien == undefined || val.no_pasien == "" ? "-" : val.no_pasien)+"</td>";
                            content += "<td>"+master.nama_pasien+"</td>";
                            content += "<td>"+val.tanggal+"</td>";
                            content += "<td>"+(result["pol"] == undefined || result["pol"][val.no_reg] == undefined || result["pol"][val.no_reg] == "" ? "" : result["pol"][val.no_reg].keterangan)+""+(result["ruangan"] == undefined || result["ruangan"][val.no_reg] == undefined ? "-" : result["ruangan"][val.no_reg].nama_ruangan)+"</td>";
                            content += "<td>"+(result["kelas"] == undefined || result["kelas"][val.no_reg] == undefined ? "-" : result["kelas"][val.no_reg].nama_kelas)+"</td>";
                            content += "<td>"+(result["kamar"] == undefined || result["kamar"][val.no_reg] == undefined ? "-" : result["kamar"][val.no_reg].nama_kamar)+"</td>";
                            content += "<td>"+(dokter.nama_dokter == undefined ? "-" : dokter.nama_dokter)+"</td>";
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
                <!-- <div class="col-xs-12 col-lg-4">
                    <div class="row">
                        <div class="col-xs-12 col-lg-11">
                            <div class="form-group">
                                 <label class="col-xs-4 control-label">Tindakan</label>
                                <div class="col-xs-8">
                                         <select name="tindakan" class="form-control">
                                            <option value="all">ALL</option>
                                            <?php
                                                foreach ($t->result() as $key) {
                                                    echo "<option value='".$key->kode_tindakan."' ".($tindakan==$key->kode_tindakan ? "selected" : "").">".$key->nama_tindakan."</option>";
                                                 }
                                            ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-xs-12 col-lg-6">
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
                <div class="form-horizontal">
                    <div class="pull-left">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <div class="checkbox">
                            <!-- <label><input type="checkbox" class="semua">Semua</label> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="pull-right">
                      <button class="excel btn btn-success"><span class="fa fa-list"></span> Excel</button>
                      <button class="cetak btn btn-primary"><span class="fa fa-print"></span> Cetak</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class='bg-navy'>
                            <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="3">Tindakan</th>
                            <th class="text-center" style="vertical-align: middle" colspan="7">Rawat Jalan</th>
                            <th class="text-center" style="vertical-align: middle" colspan="5">Rawat inap</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="3">Total</th>
                        </tr>
                        <tr class='bg-navy'>

                            <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th class="text-center">BARU</th>
                            <th class="text-center">LAMA</th>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
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
                            $baru_ralan = $lama_ralan = $dr_ralan = $manual_ralan = $dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                            $dr_inap = $manual_inap = $dinas__inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
                            foreach($t->result() as $data){
                                $jml = isset($p["tindakan"]["0102026"]) ? $p["tindakan"]["0102026"] : 0;
                                $jml_inap = isset($p_inap["tindakan"][$data->kode_tindakan]) ? $p_inap["tindakan"][$data->kode_tindakan] : 0;
                                // if ($tindakan!="all"){
                                //     if ($tindakan==$data->kode_tindakan){
                                //         if ($jml>0 || $jml_inap>0){
                                //             $hide = "class='punya text-bold'";
                                //         } else {
                                //             $hide = "class='hide'";
                                //         }
                                //     } else {
                                //         $hide = "class='hide'";
                                //     }
                                // } else {
                                //     if ($jml>0 || $jml_inap>0){
                                //         $hide = "class='punya text-bold'";
                                //     } else {
                                //         $hide = "class='hide'";
                                //     }
                                // }
                                if ($jml>0 || $jml_inap>0) {
                                    $hide = "class='punya text-bold'";
                                } else {
                                    $hide = "class='hide'";
                                }
                                echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                                echo "<td class='text-right'>".($i++)."</td>";
                                echo "<td>".$data->nama_tindakan."</td>";
                                //ralan
                                echo "<td class='text-right'>".(isset($p["BARU"]["0102026"]) ? $p["BARU"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["LAMA"]["0102026"]) ? $p["LAMA"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["DINAS"]["0102026"]) ? $p["DINAS"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["UMUM"]["0102026"]) ? $p["UMUM"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["BPJS"]["0102026"]) ? $p["BPJS"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["PRSH"]["0102026"]) ? $p["PRSH"]["0102026"] : 0)."</td>";
                                $jumlah_ralan = (isset($p["DINAS"]["0102026"]) ? $p["DINAS"]["0102026"] : 0)+
                                          (isset($p["UMUM"]["0102026"]) ? $p["UMUM"]["0102026"] : 0)+
                                          (isset($p["BPJS"]["0102026"]) ? $p["BPJS"]["0102026"] : 0)+
                                          (isset($p["PRSH"]["0102026"]) ? $p["PRSH"]["0102026"] : 0);
                                $baru_ralan += (isset($p["BARU"]["0102026"]) ? $p["BARU"]["0102026"] : 0);
                                $lama_ralan += (isset($p["LAMA"]["0102026"]) ? $p["LAMA"]["0102026"] : 0);
                                $dinas_ralan += (isset($p["DINAS"]["0102026"]) ? $p["DINAS"]["0102026"] : 0);
                                $umum_ralan += (isset($p["UMUM"]["0102026"]) ? $p["UMUM"]["0102026"] : 0);
                                $bpjs_ralan += (isset($p["BPJS"]["0102026"]) ? $p["BPJS"]["0102026"] : 0);
                                $prsh_ralan += (isset($p["PRSH"]["0102026"]) ? $p["PRSH"]["0102026"] : 0);
                                echo "<td class='text-right'>".$jumlah_ralan."</td>";
                                //inap
                                // echo "<td class='text-right'>".(isset($p_inap["DR"][$data->kode_tindakan]) ? $p_inap["DR"][$data->kode_tindakan] : 0)."</td>";
                                // echo "<td class='text-right'>".(isset($p_inap["MANUAL"][$data->kode_tindakan]) ? $p_inap["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["DINAS"][$data->kode_tindakan]) ? $p_inap["DINAS"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["UMUM"][$data->kode_tindakan]) ? $p_inap["UMUM"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["BPJS"][$data->kode_tindakan]) ? $p_inap["BPJS"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["PRSH"][$data->kode_tindakan]) ? $p_inap["PRSH"][$data->kode_tindakan] : 0)."</td>";
                                $jumlah_inap = (isset($p_inap["DINAS"][$data->kode_tindakan]) ? $p_inap["DINAS"][$data->kode_tindakan] : 0)+
                                          (isset($p_inap["UMUM"][$data->kode_tindakan]) ? $p_inap["UMUM"][$data->kode_tindakan] : 0)+
                                          (isset($p_inap["BPJS"][$data->kode_tindakan]) ? $p_inap["BPJS"][$data->kode_tindakan] : 0)+
                                          (isset($p_inap["PRSH"][$data->kode_tindakan]) ? $p_inap["PRSH"][$data->kode_tindakan] : 0);
                                // $dr_inap += (isset($p_inap["DR"][$data->kode_tindakan]) ? $p_inap["DR"][$data->kode_tindakan] : 0);
                                // $manual_inap += (isset($p_inap["MANUAL"][$data->kode_tindakan]) ? $p_inap["MANUAL"][$data->kode_tindakan] : 0);
                                $dinas_inap += (isset($p_inap["DINAS"][$data->kode_tindakan]) ? $p_inap["DINAS"][$data->kode_tindakan] : 0);
                                $umum_inap += (isset($p_inap["UMUM"][$data->kode_tindakan]) ? $p_inap["UMUM"][$data->kode_tindakan] : 0);
                                $bpjs_inap += (isset($p_inap["BPJS"][$data->kode_tindakan]) ? $p_inap["BPJS"][$data->kode_tindakan] : 0);
                                $prsh_inap += (isset($p_inap["PRSH"][$data->kode_tindakan]) ? $p_inap["PRSH"][$data->kode_tindakan] : 0);
                                echo "<td class='text-right'>".$jumlah_inap."</td>";
                                echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                            <th colspan="2">Jumlah Pasien</th>
                            <th class="text-right"><?php echo $baru_ralan;?></th>
                            <th class="text-right"><?php echo $lama_ralan;?></th>
                            <th class="text-right"><?php echo $dinas_ralan;?></th>
                            <th class="text-right"><?php echo $umum_ralan;?></th>
                            <th class="text-right"><?php echo $bpjs_ralan;?></th>
                            <th class="text-right"><?php echo $prsh_ralan;?></th>
                            <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                            <th class="text-right"><?php echo $dinas_inap;?></th>
                            <th class="text-right"><?php echo $umum_inap;?></th>
                            <th class="text-right"><?php echo $bpjs_inap;?></th>
                            <th class="text-right"><?php echo $prsh_inap;?></th>
                            <th class="text-right"><?php echo ($dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                            <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan+$dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
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
