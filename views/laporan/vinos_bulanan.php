<script>
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth / 2) - (width / 2));
        var top = parseInt((screen.availHeight / 2) - (height / 2));
        var windowFeatures = "width=" + width + ",height=" + height +
            ",status,resizable,left=" + left + ",top=" + top +
            ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function() {
        $("[name='bulan']").change(function() {
            var bln = $(this).val();
            var url = "<?php echo site_url('laporan/inos_bulanan'); ?>/" + bln;
            window.location = url;
            return false;
        });
        $("[name='ruangan'], [name='bulan']").change(function() {
            var bln = $("[name='bulan']").val();
            var ruangan = $("[name='ruangan']").val();
            var url = "<?php echo site_url('laporan/inos_bulanan'); ?>/" + ruangan + "/" + bln;
            window.location = url;
            return false;
        });
        $(".print").click(function() {
            var bln = $("[name='bulan']").val();
            var ruangan = $("[name='ruangan']").val();
            var url = "<?php echo site_url('laporan/cetakinos_bulanan'); ?>/" + ruangan + "/" + bln;
            openCenteredWindow(url);
            // alert(url);
            return false;
        });
        $(".excel").click(function() {
            var bln = $("[name='bulan']").val();
            var ruangan = $("[name='ruangan']").val();
            var url = "<?php echo site_url('laporan/excelinos_bulanan'); ?>/" + ruangan + "/" + bln;
            window.location = url;
            // alert(url);
            return false;
        });
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Bulan</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="bulan">
                            <?php
                            $bln = array(
                                "",
                                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"
                            );
                            foreach ($bln as $key => $value) {
                                if ($key > 0)
                                    echo "<option value='" . $key . "' " . ($b == $key ? "selected" : "") . ">" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    // $b = date("m");
                    $tahun = date("Y");
                    $jml = cal_days_in_month(CAL_GREGORIAN, $b, $tahun);
                    ?>
                    <div class="col-md-2">
                        <div class="btn-group">
                            <button type="button" class="print btn btn-sm btn-info"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
                            <button type="button" class="excel btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Nama Ruangan</label>
                    <div class="col-md-3">
                        <select class="form-control" name="ruangan">
                            <?php
                            echo "<option value='all' " . ($ruangan == "all" ? "selected" : "") . ">ALL</option>";
                            foreach ($r as $kode => $key) {
                                echo "<option value='" . $key->kode_bagian . "' " . ($bagian == $key->kode_bagian ? "selected" : "") . ">" . $key->nama_ruangan . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <table width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        INOS BULANAN
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2">PERIODE : <?php echo date("F Y"); ?></td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="width:2000px">
                    <thead>
                        <tr class="bg-navy">
                            <th style="vertical-align:middle" class="text-center" rowspan="3" width='150'>Tanggal</th>
                            <th style="vertical-align:middle" width="150" class='text-center' rowspan="3">Ruang</th>
                            <th style="vertical-align:middle" width="50" class='text-center' rowspan="3">Pasien Lama</th>
                            <th style="vertical-align:middle" width="50" class='text-center' rowspan="3">Pasien Baru</th>
                            <th style="vertical-align:middle" width="50" class="text-center" rowspan="2" colspan="2">Pasien Tirah Baring</th>
                            <th width="50" class="text-center" colspan="11">Jumlah</th>
                            <th style="vertical-align:middle" width="50" class="text-center" rowspan="2" colspan="2">Pasien Yang Dioperasi</th>
                            <th style="vertical-align:middle" width="50" class="text-center" rowspan="3">Ket</th>
                        </tr>
                        <tr class="bg-navy">
                            <th width="50" class="text-center" colspan="4">Pasien Yang Terpasang</th>
                            <th width="50" class="text-center" colspan="7">Pasien Terinfeksi</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th width="50" class='text-center'>Ya</th>
                            <th width="50" class='text-center'>Tidak</th>
                            <th width="50" class='text-center'>INFUS</th>
                            <th width="50" class='text-center'>CVC</th>
                            <th width="50" class='text-center'>UC</th>
                            <th width="50" class='text-center'>VENTILATOR</th>
                            <th width="50" class='text-center'>DKU</th>
                            <th width="50" class='text-center'>HAP</th>
                            <th width="50" class='text-center'>IADP</th>
                            <th width="50" class='text-center'>IDO</th>
                            <th width="50" class='text-center'>ILI</th>
                            <th width="50" class='text-center'>ISK</th>
                            <th width="50" class='text-center'>VAP</th>
                            <th width="50" class='text-center'>Ya</th>
                            <th width="50" class='text-center'>Tidak</th>
                        <tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $i++;
                        // echo json_encode($q["lama"]);
                        // echo json_encode($q["baru"]["kosong"]);
                        for ($d = 1; $d <= $jml; $d++) {
                            echo "<tr id=data>";
                            $bl = substr("00" . $b, -2);
                            $dt = substr("00" . $d, -2);
                            $tanggal = date("Y") . "-" . $bl . "-" . $dt;
                            $tgl = date("d-m-Y", strtotime($tanggal));
                            echo "<td class='text-center'>" . $tgl . "</td>";
                            echo "<td class='text-center'>" . ($bagian == "all" ? "ALL" : $r[$bagian]->nama_ruangan) . "</td>";
                            $lama = 0;
                            $baru = isset($q["baru"][date("Y-m-d", strtotime($tanggal))]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))] : 0;
                            foreach ($q["lama"] as $key => $value) {
                                if (date("Y-m-d", strtotime($key)) > date("Y-m-d", strtotime($tanggal))) {
                                    foreach ($value as $key2 => $value2) {
                                        if ((date("Y-m-d", strtotime($key2)) < date("Y-m-d", strtotime($tanggal)))) { $lama += $value2;}
                                    }
                                }
                                if ($key=="kosong"){
                                  foreach ($value as $key2 => $value2) {
                                    if (date("Y-m-d",strtotime($tanggal))==date("Y-m-d") || date("Y-m-d", strtotime($key2)) < date("Y-m-d",strtotime($tanggal))) {
                                      if (date("Y-m-d", strtotime($key2)) < date("Y-m-d", strtotime($tanggal))) { $lama += $value2;}
                                    }
                                  }
                                }
                            }
                            if (date("Y-m-d",strtotime($tanggal))>date("Y-m-d")) {$lama = 0;}
                            echo "<td class='text-center'>" . $lama . "</td>";
                            echo "<td class='text-center'>" . $baru . "</td>";
                            echo "<td class='text-center'>" . $q["tirahya"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["tirahtdk"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["infus"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["cvc"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["uc"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["ventilator"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["DKU"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["HAP"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["IADP"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["IDO"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["ILI"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["ISK"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["VAP"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["operasiya"][$tgl] . "</td>";
                            echo "<td class='text-center'>" . $q["operasitdk"][$tgl] . "</td>";
                            echo "<td class='text-center'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
