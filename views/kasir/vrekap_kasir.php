<script>
    function openCenteredWindow(url) {
        var width = 1200;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(e){
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".print").click(function(){
            var hasil = $("[name='hasil']").val();
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            $.ajax({
                url : "<?php echo site_url('parkir/simpantemprekap');?>",
                method : "POST",
                data : {hasil: hasil},
                success: function(){
                    console.log(hasil);
                    var site = "<?php echo site_url('parkir/cetak_rekap');?>/"+tgl1+"/"+tgl2;
                    openCenteredWindow(site);
                },
                error: function(data){
                    console.log(data);
                }
            });

        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("parkir/rekap");?>/"+tgl1+"/"+tgl2;
        });
    });
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
                    <div class="col-md-1">
                        <button class="print btn btn-success pull-right" type = "button" ><i class="fa fa-print"></i>&nbsp;Cetak</button>   
                    </div>
                </div>
            </div>
            <table  width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        REKAP HARIAN
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <input type="hidden" name="hasil" value='<?php echo json_encode($q);?>'>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr class="bg-navy">
                            <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal</th>
                            <th class="text-center" colspan="5">Pelayanan Rajal</th>
                            <th class="text-center" colspan="5">Pelayanan Ranap</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Apotek</th>
                            <th class="text-center" colspan="2">Sharing</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">COB</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Parkir</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Total</th>
                        </tr>
                        <tr class="bg-navy">
                            <th class="text-center">BPJS</th>
                            <th class="text-center">Umum</th>
                            <th class="text-center">Perusahaan</th>
                            <th class="text-center" style="vertical-align: middle">Apotek</th>
                            <th class="text-center" style="vertical-align: middle">Parsial</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">Umum</th>
                            <th class="text-center">Perusahaan</th>
                            <th class="text-center" style="vertical-align: middle">Apotek</th>
                            <th class="text-center" style="vertical-align: parsial">Apotek</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">Perusahaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no_reg = "";
                            $i = 1;
                            $jumlah = 0;
                            $finish = date("Y-m-d",strtotime($tgl2));
                            $start = date("Y-m-d",strtotime($tgl1));
                            $durasi= strtotime($finish)-strtotime($start);
                            $hari = $durasi / (60 * 60 * 24);
                            $hari += 1;
                            for($i=0;$i<$hari;$i++){
                                $tgl = date('Y-m-d', strtotime($start . " + ".$i." day"));
                                $bpjs_ralan = (isset($q["pelayanan_ralan"][$tgl]["BPJS"]) ? $q["pelayanan_ralan"][$tgl]["BPJS"] : 0);
                                $umum_ralan = (isset($q["pelayanan_ralan"][$tgl]["UMUM"]) ? $q["pelayanan_ralan"][$tgl]["UMUM"] : 0);
                                $perusahaan_ralan = (isset($q["pelayanan_ralan"][$tgl]["PERUSAHAAN"]) ? $q["pelayanan_ralan"][$tgl]["PERUSAHAAN"] : 0);
                                $bpjs_inap = (isset($q["pelayanan_inap"][$tgl]["BPJS"]) ? $q["pelayanan_inap"][$tgl]["BPJS"] : 0);
                                $umum_inap = (isset($q["pelayanan_inap"][$tgl]["UMUM"]) ? $q["pelayanan_inap"][$tgl]["UMUM"] : 0);
                                $perusahaan_inap = (isset($q["pelayanan_inap"][$tgl]["PERUSAHAAN"]) ? $q["pelayanan_inap"][$tgl]["PERUSAHAAN"] : 0);
                                $bpjs_blu = (isset($q["blu"][$tgl]["BPJS"]) ? $q["blu"][$tgl]["BPJS"] : 0);
                                $perusahaan_blu = (isset($q["blu"][$tgl]["PERUSAHAAN"]) ? $q["blu"][$tgl]["PERUSAHAAN"] : 0);
                                $cob = (isset($q["cob"][$tgl]) ? $q["cob"][$tgl]: 0);
                                $parsial_ralan = (isset($q["parsial_ralan"][$tgl]) ? number_format($q["parsial_ralan"][$tgl],0,',','.') : 0);
                                $parsial_ranap = (isset($q["parsial_ranap"][$tgl]) ? number_format($q["parsial_ranap"][$tgl],0,',','.') : 0);
                                $apotek_ralan = (isset($q["apotek_ralan"][$tgl]) ? number_format($q["apotek_ralan"][$tgl],0,',','.') : 0);
                                $apotek_inap = (isset($q["apotek_inap"][$tgl]) ? number_format($q["apotek_inap"][$tgl],0,',','.') : 0);
                                echo "<tr>";
                                echo "<td class='text-right'>".($i+1)."</td>";
                                echo "<td>".date("d-m-Y",strtotime($tgl))."</td>";
                                echo "<td class='text-right'>".(isset($q["pelayanan_ralan"][$tgl]["BPJS"]) ? number_format($q["pelayanan_ralan"][$tgl]["BPJS"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["pelayanan_ralan"][$tgl]["UMUM"]) ? number_format($q["pelayanan_ralan"][$tgl]["UMUM"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["pelayanan_ralan"][$tgl]["PERUSAHAAN"]) ? number_format($q["pelayanan_ralan"][$tgl]["PERUSAHAAN"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["apotek_ralan"][$tgl]) ? number_format($q["apotek_ralan"][$tgl],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["parsial_ralan"][$tgl]) ? number_format($q["parsial_ralan"][$tgl],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["pelayanan_inap"][$tgl]["BPJS"]) ? number_format($q["pelayanan_inap"][$tgl]["BPJS"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["pelayanan_inap"][$tgl]["UMUM"]) ? number_format($q["pelayanan_inap"][$tgl]["UMUM"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["pelayanan_inap"][$tgl]["PERUSAHAAN"]) ? number_format($q["pelayanan_inap"][$tgl]["PERUSAHAAN"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["apotek_inap"][$tgl]) ? number_format($q["apotek_inap"][$tgl],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["parsial_ranap"][$tgl]) ? number_format($q["parsial_ranap"][$tgl],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["apotek"][$tgl]) ? number_format($q["apotek"][$tgl],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["blu"][$tgl]["BPJS"]) ? number_format($q["blu"][$tgl]["BPJS"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["blu"][$tgl]["PERUSAHAAN"]) ? number_format($q["blu"][$tgl]["PERUSAHAAN"],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["cob"][$tgl]) ? number_format($q["cob"][$tgl],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".(isset($q["parkir"][$tgl]) ? number_format($q["parkir"][$tgl],0,',','.') : 0)."</td>";
                                echo "<td class='text-right'>".number_format($bpjs_ralan+$umum_ralan+$perusahaan_ralan+$bpjs_inap+$umum_inap+$perusahaan_inap+$bpjs_blu+$perusahaan_blu+$cob,0,',','.')."</td>";
                                echo "</tr>";
                                $jumlah += ($bpjs_ralan+$umum_ralan+$perusahaan_ralan+$bpjs_inap+$umum_inap+$perusahaan_inap+$bpjs_blu+$perusahaan_blu+$cob+$parsial_ralan+$parsial_ranap+$apotek_ralan+$apotek_inap);
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-navy">
                            <th colspan=17>JUMLAH</th>
                            <th class="text-right"><?php echo number_format($jumlah,0,',','.');?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>