<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
</head>
<script>
    $(document).ready(function(){
        window.print();
    });
</script>
<table class="laporan" width="100%">
    <thead>
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
    </thead>
    <tbody>
        <?php
            $no_reg = "";
            $i = 1;
            $jumlah = 0;
            // echo json_encode($q["detail"]);
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
                        // if ($namatd[$ktarif]=="PEMERIKSAAN DOKTER" && $val->gol_pasien==11)
                        if ($val->gol_pasien==11)
                            $bruto = (($tr[$ktarif][$rkey]*$prs)/100)*$tu[$ktarif]/100;  
                        else  
                            $bruto = (($tr[$ktarif][$rkey]*$prs)/100)*$td[$ktarif]/100;
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
                        echo "<tr class='data' id_dokter='".$key."'>";
                        echo "<td class='text-center'>".$key."</td>";
                        echo "<td>".$value."</td>";
                        echo "<td align='right'>".number_format($total_umum_ralan,0,',','.')."</td>";
                        echo "<td align='right'>".number_format($total_bpjs_ralan,0,',','.')."</td>";
                        echo "<td align='right'>".number_format($total_perusahaan_ralan,0,',','.')."</td>";
                        echo "<td align='right'>".number_format($total_umum_ranap,0,',','.')."</td>";
                        echo "<td align='right'>".number_format($total_bpjs_ranap,0,',','.')."</td>";
                        echo "<td align='right'>".number_format($total_perusahaan_ranap,0,',','.')."</td>";
                        echo "<td align='right'>".number_format($total,0,',','.')."</td>";
                        $nominal_pajak = $total*$pajak[$key]/100;
                        echo "<td align='right'>".number_format($nominal_pajak,0,',','.')."</td>";
                        echo "<td align='right'>".number_format($total-$nominal_pajak,0,',','.')."</td>";
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
                    echo "<td class='text-center'>".$key."</td>";
                    echo "<td>".$value."</td>";
                    echo "<td align='right'>".number_format($total_umum_ralan,0,',','.')."</td>";
                    echo "<td align='right'>".number_format($total_bpjs_ralan,0,',','.')."</td>";
                    echo "<td align='right'>".number_format($total_perusahaan_ralan,0,',','.')."</td>";
                    echo "<td align='right'>".number_format($total_umum_ranap,0,',','.')."</td>";
                    echo "<td align='right'>".number_format($total_bpjs_ranap,0,',','.')."</td>";
                    echo "<td align='right'>".number_format($total_perusahaan_ranap,0,',','.')."</td>";
                    echo "<td align='right'>".number_format($total,0,',','.')."</td>";
                    $nominal_pajak = $total*$pajak[$key]/100;
                    echo "<td align='right'>".number_format($nominal_pajak,0,',','.')."</td>";
                    echo "<td align='right'>".number_format($total-$nominal_pajak,0,',','.')."</td>";
                    echo "</tr>";
                }
                $jumlah += ($total-$nominal_pajak);
            }
        ?>
    </tbody>
    <tfoot>
        <tr class="bg-navy">
            <th colspan=10>JUMLAH</th>
            <th style='text-align:right'><?php echo number_format($jumlah,0,',','.');?></th>
        </tr>
    </tfoot>
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