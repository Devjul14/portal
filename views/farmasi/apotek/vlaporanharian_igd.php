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
            window.location = "<?php echo site_url("apotek_farmasi/laporanharian_ralan");?>/"+tgl1+"/"+tgl2;
        });
        $("input[name='tgl2']").change(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("apotek_farmasi/laporanharian_ralan");?>/"+tgl1+"/"+tgl2;
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
                        LAPORAN HARIAN APOTEK IGD
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th rowspan="3" width="100">No.</th>
                        <th rowspan="3" width="100">Tanggal</th>
                        <th rowspan="3" width="100">Kode Obat</th>
                        <th rowspan="3" >Nama Obat</th>
                        <th colspan="8" width="200" class="text-center">Golongan Pasien</th>
                        <th width="200" colspan="2" class="text-center">Jumlah</th>
                    </tr>
                    <tr class="bg-navy">
                        <th class='text-center' colspan="2">Dinas</th>
                        <th class='text-center' colspan="2">Umum</th>
                        <th class='text-center' colspan="2">BPJS</th>
                        <th class='text-center' colspan="2">Perusahaan</th>
                        <td rowspan="2">Total Jumlah</td>
                        <td rowspan="2">Total Qty</td>
                    </tr>
                    <tr class="bg-navy">
                        <td>Jumlah</td>
                        <td>Qty</td>
                        <td>Jumlah</td>
                        <td>Qty</td>
                        <td>Jumlah</td>
                        <td>Qty</td>
                        <td>Jumlah</td>
                        <td>Qty</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i      = 0;
                        $jdinas = $jumum=$jbpjs=$jperusahaan=$jtotal=0;
                        $jdinas_qty = $jumum_qty=$jbpjs_qty=$jperusahaan_qty=$jtotal_qty=0;
                        foreach ($q->result() as $row) {
                            $i++;
                            $dinas      = (isset($q2[$row->kode_obat]["DINAS"]) ? $q2[$row->kode_obat]["DINAS"] : 0);
                            $umum       = (isset($q2[$row->kode_obat]["UMUM"]) ? $q2[$row->kode_obat]["UMUM"] : 0);
                            $bpjs       = (isset($q2[$row->kode_obat]["BPJS"]) ? $q2[$row->kode_obat]["BPJS"] : 0);
                            $perusahaan = (isset($q2[$row->kode_obat]["PERUSAHAAN"]) ? $q2[$row->kode_obat]["PERUSAHAAN"] : 0);

                            $dinas_qty      = (isset($q3[$row->kode_obat]["DINAS"]) ? $q3[$row->kode_obat]["DINAS"] : 0);
                            $umum_qty       = (isset($q3[$row->kode_obat]["UMUM"]) ? $q3[$row->kode_obat]["UMUM"] : 0);
                            $bpjs_qty       = (isset($q3[$row->kode_obat]["BPJS"]) ? $q3[$row->kode_obat]["BPJS"] : 0);
                            $perusahaan_qty = (isset($q3[$row->kode_obat]["PERUSAHAAN"]) ? $q3[$row->kode_obat]["PERUSAHAAN"] : 0);

                            $total          = $dinas+$umum+$bpjs+$perusahaan;
                            $total_qty      = $dinas_qty+$umum_qty+$bpjs_qty+$perusahaan;
                            echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                            echo "<td>".$row->kode_obat."</td>";
                            echo "<td>".$row->nama_obat."</td>";
                            echo "<td class='text-right'>".number_format($dinas,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($dinas_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($umum,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($umum_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($bpjs,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($bpjs_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($perusahaan,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($perusahaan_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($total_qty,0,',','.')."</td>";
                            echo "</tr>";
                            $jdinas         += $dinas;
                            $jumum          += $umum;
                            $jbpjs          += $bpjs;
                            $jperusahaan    += $perusahaan;
                            $jtotal         += $total;

                            $jdinas_qty             += $dinas_qty;
                            $jumum_qty              += $umum_qty;
                            $jbpjs_qty              += $bpjs_qty;
                            $jperusahaan_qty        += $perusahaan_qty;
                            $jtotal_qty             += $total_qty;
                        }
                        $jdinasinapigd = $jumuminapigd=$jbpjsinapigd=$jperusahaaninapigd=$jtotalinapigd=0;
                        $jdinasinapigd_qty = $jumuminapigd_qty=$jbpjsinapigd_qty=$jperusahaaninapigd_qty=$jtotalinapigd_qty=0;
                        foreach ($q4->result() as $row1) {
                            $i++;
                            $dinasinapigd      = (isset($q5[$row1->kode_obat]["DINAS"]) ? $q5[$row1->kode_obat]["DINAS"] : 0);
                            $umuminapigd       = (isset($q5[$row1->kode_obat]["UMUM"]) ? $q5[$row1->kode_obat]["UMUM"] : 0);
                            $bpjsinapigd       = (isset($q5[$row1->kode_obat]["BPJS"]) ? $q5[$row1->kode_obat]["BPJS"] : 0);
                            $perusahaaninapigd = (isset($q5[$row1->kode_obat]["PERUSAHAAN"]) ? $q5[$row1->kode_obat]["PERUSAHAAN"] : 0);

                            $dinasinapigd_qty      = (isset($q6[$row1->kode_obat]["DINAS"]) ? $q6[$row1->kode_obat]["DINAS"] : 0);
                            $umuminapigd_qty       = (isset($q6[$row1->kode_obat]["UMUM"]) ? $q6[$row1->kode_obat]["UMUM"] : 0);
                            $bpjsinapigd_qty       = (isset($q6[$row1->kode_obat]["BPJS"]) ? $q6[$row1->kode_obat]["BPJS"] : 0);
                            $perusahaaninapigd_qty = (isset($q6[$row1->kode_obat]["PERUSAHAAN"]) ? $q6[$row1->kode_obat]["PERUSAHAAN"] : 0);

                            $totalinapigd          = $dinasinapigd+$umuminapigd+$bpjsinapigd+$perusahaan;
                            $totalinapigd_qty      = $dinasinapigd_qty+$umuminapigd_qty+$bpjsinapigd_qty+$perusahaaninapigd_qty;
                            echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td>".date("d-m-Y",strtotime($row1->tanggal))."</td>";
                            echo "<td>".$row1->kode_obat."</td>";
                            echo "<td>".$row1->nama_obat."</td>";
                            echo "<td class='text-right'>".number_format($dinasinapigd,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($dinasinapigd_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($umuminapigd,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($umuminapigd_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($bpjsinapigd,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($bpjsinapigd_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($perusahaaninapigd,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($perusahaaninapigd_qty,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($totalinapigd,0,',','.')."</td>";
                            echo "<td class='text-right'>".number_format($totalinapigd_qty,0,',','.')."</td>";
                            echo "</tr>";
                            $jdinasinapigd         += $dinasinapigd;
                            $jumuminapigd          += $umuminapigd;
                            $jbpjsinapigd          += $bpjsinapigd;
                            $jperusahaaninapigd    += $perusahaaninapigd;
                            $jtotalinapigd         += $totalinapigd;

                            $jdinasinapigd_qty             += $dinasinapigd_qty;
                            $jumuminapigd_qty              += $umuminapigd_qty;
                            $jbpjsinapigd_qty              += $bpjsinapigd_qty;
                            $jperusahaaninapigd_qty        += $perusahaaninapigd_qty;
                            $jtotalinapigd_qty             += $totalinapigd_qty;
                        }
                        $jdinas2            = ($jdinas+$jdinasinapigd);
                        $jdinas_qty2        = ($jdinas_qty2+$jdinasinapigd_qty);
                        $jumum2             = ($jumum+$jumuminapigd);
                        $jumum_qty2         = ($jumum_qty2+$jumuminapigd_qty);
                        $jbpjs2             = ($jbpjs+$jbpjsinapigd);
                        $jbpjs_qty2         = ($jbpjs_qty2+$jbpjsinapigd_qty);
                        $jperusahaan2       = ($jperusahaan+$jperusahaaninapigd);
                        $jperusahaan_qty2   = ($jperusahaan_qty2+$jperusahaaninapigd_qty);
                        $jtotal2            = ($jtotal+$jtotalinapigd);
                        $jtotal_qty2        = ($jtotal_qty2+$jtotalinapigd_qty);

                    ?>
                </tbody>
                    <tfoot>
                    <tr class="bg-navy">
                        <td class="text-center" colspan="4">Jumlah</td>
                        <td class="text-right"><?php echo number_format($jdinas2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jdinas_qty2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jumum2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jumum_qty2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jbpjs2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jbpjs_qty2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jperusahaan2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jperusahaan_qty2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jtotal2,0,',','.') ?></td>
                        <td class="text-right"><?php echo number_format($jtotal_qty2,0,',','.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>