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
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var golpas = $("[name='golpas']").val();
            var frm = $("[name='frm']").val();
            var poli = $("[name='poli']").val();
            var url = "<?php echo site_url('kasir/cetak_laporan_ralan')?>/"+frm+"/"+tgl1+"/"+tgl2+"/"+golpas+"/"+poli;
            openCenteredWindow(url);
        });
        $("input[name='tgl1']").change(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var depo = $("input[name='depo']").val();
            window.location = "<?php echo site_url("apotek_farmasi/laporanharian");?>/"+depo+"/"+tgl1+"/"+tgl2;
        });
        $("input[name='tgl2']").change(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var depo = $("input[name='depo']").val();
            window.location = "<?php echo site_url("apotek_farmasi/laporanharian");?>/"+depo+"/"+tgl1+"/"+tgl2;
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
                </div>
            </div>
            <table  width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        <input type="hidden" name="depo" value="<?php echo strtolower($depo) ?>">
                        LAPORAN HARIAN APOTEK <?php echo $depo; ?>
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th rowspan="2" width="100">No.</th>
                        <th rowspan="2" width="100">Tanggal</th>
                        <th rowspan="2" width="100">Kode Obat</th>
                        <th rowspan="2" >Nama Obat</th>
                        <th colspan="5" width="200" class="text-center">Golongan Pasien</th>
                        <th rowspan="2" width="200" class="text-center">Jumlah</th>
                    </tr>
                    <tr class="bg-navy">
                        <th>Dinas</th>
                        <th>Umum</th>
                        <th>BPJS</th>
                        <th>Perusahaan</th>
                        <th>Parsial</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($depo="ralan") {
                            $i      = 0;
                            $jdinas=$jumum=$jbpjs=$jperusahaan=$jparsial=$jtotal=0;
                            foreach ($q->result() as $row) {
                                $i++;
                                $dinas      = (isset($q2[$row->kode_obat]["DINAS"]) ? $q2[$row->kode_obat]["DINAS"] : 0);
                                $umum       = (isset($q2[$row->kode_obat]["UMUM"]) ? $q2[$row->kode_obat]["UMUM"] : 0);
                                $bpjs       = (isset($q2[$row->kode_obat]["BPJS"]) ? $q2[$row->kode_obat]["BPJS"] : 0);
                                $perusahaan = (isset($q2[$row->kode_obat]["PERUSAHAAN"]) ? $q2[$row->kode_obat]["PERUSAHAAN"] : 0);
                                $parsial    = (isset($q3[$row->kode_obat]) ? $q3[$row->kode_obat] : 0); 
                                $total      = $dinas+$umum+$bpjs+$perusahaan+$parsial;
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                                echo "<td>".$row->kode_obat."</td>";
                                echo "<td>".$row->nama_obat."</td>";
                                echo "<td class='text-right'>".number_format($dinas,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($umum,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($bpjs,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($perusahaan,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($parsial,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($total,0,',','.')."</td>";
                                echo "</tr>";
                                $jdinas         += $dinas;
                                $jumum          += $umum;
                                $jbpjs          += $bpjs;
                                $jperusahaan    += $perusahaan;
                                $jparsial       += $parsial;
                                $jtotal         += $total;
                            }
                        } else {
                            $i2      = 0;
                            foreach ($q->result() as $row) {
                                $i2++;
                                echo "<tr>";
                                echo "<td>".$i2."</td>";
                                echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                                echo "<td>".$row->kode_obat."</td>";
                                echo "<td>".$row->nama_obat."</td>";
                                echo "<td class='text-right'>".number_format($dinas_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($umum_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($bpjs_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($perusahaan_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($parsial_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($total_inap,0,',','.')."</td>";
                                echo "</tr>";
                            }

                            $i1      = 0;
                            $jdinas_inap=$jumum_inap=$jbpjs_inap=$jperusahaan_inap=$jparsial_inap=$jtotal_inap=0;
                            foreach ($q1->result() as $row1) {
                                $dinas_inap      = (isset($q4[$row1->kode_obat]["DINAS"]) ? $q4[$row1->kode_obat]["DINAS"] : 0);
                                $umum_inap       = (isset($q4[$row1->kode_obat]["UMUM"]) ? $q4[$row1->kode_obat]["UMUM"] : 0);
                                $bpjs            = (isset($q4[$row1->kode_obat]["BPJS"]) ? $q4[$row1->kode_obat]["BPJS"] : 0);
                                $perusahaan_inap = (isset($q4[$row1->kode_obat]["PERUSAHAAN"]) ? $q4[$row1->kode_obat]["PERUSAHAAN"] : 0);
                                $parsial_inap    = (isset($q3[$row1->kode_obat]) ? $q3[$row1->kode_obat] : 0); 
                                $total_inap      = $dinas_inap+$umum_inap+$bpjs_inap+$perusahaan_inap+$parsial;

                                $i1++;
                                echo "<tr>";
                                echo "<td>".$i1."</td>";
                                echo "<td>".date("d-m-Y",strtotime($row1->tanggal))."</td>";
                                echo "<td>".$row1->kode_obat."</td>";
                                echo "<td>".$row1->nama_obat."</td>";
                                echo "<td class='text-right'>".number_format($dinas_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($umum_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($bpjs_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($perusahaan_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($parsial_inap,0,',','.')."</td>";
                                echo "<td class='text-right'>".number_format($total_inap,0,',','.')."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="bg-navy">
                        <td class="text-center" colspan="4">Jumlah</td>
                        <td class="text-right"><?php echo number_format($jdinas,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jumum,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jbpjs,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jperusahaan,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jparsial,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jtotal,0,',','.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>