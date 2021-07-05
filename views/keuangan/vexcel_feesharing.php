<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Pembagian Jasa Medis.xls");
?>
<table class="laporan" border=1 width="100%">
        <tr><th class="no-border" align='center' colspan="11">PEMBAGIAN JASA MEDIS</th></tr>
        <tr><th class="no-border" align='center' colspan="11">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></th></tr>
        <tr><th class="no-border" align='center' colspan="11">TAHUN : <?php echo date("Y",strtotime($tgl1))?></th></tr>
        <tr>
            <th align='center' style="vertical-align:middle" rowspan="2">ID Dokter</th>
            <th align='center' style="vertical-align:middle" rowspan="2">Nama Dokter</th>
            <th colspan=3 align='center'>Rawat Jalan</th>
            <th colspan=3 align='center'>Rawat Inap</th>
            <th rowspan="2" align='center' style="vertical-align:middle" >Total</th>
            <th rowspan="2" align='center' style="vertical-align:middle" >Pajak</th>
            <th rowspan="2" align='center' style="vertical-align:middle" >Jasa</th>
        </tr>
        <tr class="bg-navy">
            <th align='center'>U</th>
            <th align='center'>BPJS</th>
            <th align='center'>P</th>
            <th align='center'>U</th>
            <th align='center'>BPJS</th>
            <th align='center'>P</th>
        </tr>
        <?php
            $no_reg = "";
            $i = 1;
            $jumlah = 0;
            $row = $q["detail"];
            $tr = $q["tarifrs"];
            $td = $q["tarifdokter"];
            $tu = $q["tarifdokterumum"];
            $gp = $q["golpas"];
            $namatd = $q["namatarifdokter"];
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
                        $persen = ($val->tarif_bpjs/$tarif_rs)*100;
                        if ($val->tarif_bpjs=="") $persen = 100;
                        $prs = $persen>100 ? 100 : round($persen,2);
                        if ($namatd[$ktarif]=="PEMERIKSAAN DOKTER" && $val->gol_pasien==11)
                            $bruto = round((($tr[$ktarif][$rkey]*$prs)/100)*$tu[$ktarif]/100,0);  
                        else  
                            $bruto = round((($tr[$ktarif][$rkey]*$prs)/100)*$td[$ktarif]/100,0);
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
                        echo "<tr class='data'>";
                        echo "<td style='align:center'>=\"".$key."\"</td>";
                        echo "<td>".$value."</td>";
                        echo "<td align='right'>".$total_umum_ralan."</td>";
                        echo "<td align='right'>".$total_bpjs_ralan."</td>";
                        echo "<td align='right'>".$total_perusahaan_ralan."</td>";
                        echo "<td align='right'>".$total_umum_ranap."</td>";
                        echo "<td align='right'>".$total_bpjs_ranap."</td>";
                        echo "<td align='right'>".$total_perusahaan_ranap."</td>";
                        echo "<td align='right'>".$total."</td>";
                        $nominal_pajak = round($total*$pajak[$key]/100,0);
                        echo "<td align='right'>".$nominal_pajak."</td>";
                        echo "<td align='right'>".($total-$nominal_pajak)."</td>";
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
                    echo "<tr class='data' id_dokter='".$key."'>";
                    echo "<td style='align:center'>=\"".$key."\"</td>";
                    echo "<td>".$value."</td>";
                    echo "<td align='right'>".$total_umum_ralan."</td>";
                    echo "<td align='right'>".$total_bpjs_ralan."</td>";
                    echo "<td align='right'>".$total_perusahaan_ralan."</td>";
                    echo "<td align='right'>".$total_umum_ranap."</td>";
                    echo "<td align='right'>".$total_bpjs_ranap."</td>";
                    echo "<td align='right'>".$total_perusahaan_ranap."</td>";
                    echo "<td align='right'>".$total."</td>";
                    $nominal_pajak = round($total*$pajak[$key]/100,0);
                    echo "<td align='right'>".$nominal_pajak."</td>";
                    echo "<td align='right'>".($total-$nominal_pajak)."</td>";
                    echo "</tr>";
                }
                $jumlah += ($total-$nominal_pajak);
            }
        ?>
        <tr>
            <th colspan=10>JUMLAH</th>
            <th style='text-align:right'><?php echo round($jumlah,0);?></th>
        </tr>
</table>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    .laporan > thead > tr > th,
    .laporan > tbody > tr > th,
    .laporan > tfoot > tr > th,
    .laporan > thead > tr > td,
    .laporan > tbody > tr > td,
    .laporan > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
    }
    .laporan td,
    .laporan th {
        background-color: #fff;
        border: 1px solid #000;
    }
    .laporan td.no-border,
    .laporan th.no-border {
        background-color: #fff !important;
        border: none;
    }
</style>