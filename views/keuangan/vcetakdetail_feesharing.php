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
<?php
    $row = $q["detail"];
    $tr = $q["tarifrs"];
    $td = $q["tarifdokter"];
    $tu = $q["tarifdokterumum"];
    $namatd = $q["namatarifdokter"];
    $gp = $q["golpas"];
    $html = "";
    $i = 1;
    $total = 0;
    $n = 0;
    foreach($row[$id_dokter] as $key =>$value){
        foreach($value as $ktarif =>$val){
            if ($val->gol_pasien==11){
                $tarif_rs = $tr[$ktarif][$key];
            }
            else{
                $tarif_rs = $val->tarif_rumahsakit;
            }
            $persen = $val->tarif_bpjs/$tarif_rs*100;
            if ($val->tarif_bpjs=="") $persen = 100; 
            if ($val->gol_pasien!=11){
                $n++;
            }
            if ($val->gol_pasien==11){
                $str_golpas = "UMUM";
            } else 
            if ($val->gol_pasien>=12 && $val->gol_pasien<=18){
                $str_golpas = "PERUSAHAAN";
            } else {
                $str_golpas = "BPJS";
            }
            if ($pelayanan=="all"){
                if ($gol_pasien=="all"){
                    $html .= "<tr>";
                    $html .= "<td>".($i++)."</td>";
                    $html .= "<td>".$val->no_reg." | ".$val->nama_pasien."</td>";
                    $html .= "<td>".$ktarif." | ".$namatd[$ktarif]."</td>";
                    $html .= "<td align='right' style='align:right'>".number_format($val->tarif_bpjs,0,',','.')."</td>";
                    $html .= "<td align='right' style='align:right'>".number_format($tarif_rs,0,',','.')."</td>";
                    $html .= "<td align='right' style='align:right'>".number_format($tr[$ktarif][$key],0,',','.')."</td>";
                    $html .= "<td align='center' style='align:center'>".($persen>100 ? 100 : round($persen,2))." %</td>";
                    $prs = $persen>100 ? "100" : round($persen,2);
                    if ($namatd[$ktarif]=="PEMERIKSAAN DOKTER" && $str_golpas=="UMUM"){
                        $bruto = ($tr[$ktarif][$key]*$prs/100)*($tu[$ktarif])/100;
                    } else
                        $bruto = ($tr[$ktarif][$key]*$prs/100)*($td[$ktarif])/100;
                    $html .= "<td align='right' style='align:right'>".number_format($bruto,0,',','.')."</td>";
                    $total += $bruto;
                    $html .= "</tr>";
                } else {
                    if ($gol_pasien==$str_golpas){
                        $html .= "<tr>";
                        $html .= "<td>".($i++)."</td>";
                        $html .= "<td>".$val->no_reg." | ".$val->nama_pasien."</td>";
                        $html .= "<td>".$ktarif." | ".$namatd[$ktarif]."</td>";
                        $html .= "<td align='right' style='align:right'>".number_format($val->tarif_bpjs,0,',','.')."</td>";
                        $html .= "<td align='right' style='align:right'>".number_format($tarif_rs,0,',','.')."</td>";
                        $html .= "<td align='right' style='align:right'>".number_format($tr[$ktarif][$key],0,',','.')."</td>";
                        $html .= "<td align='center' style='align:center'>".($persen>100 ? 100 : round($persen,2))." %</td>";
                        $prs = $persen>100 ? "100" : round($persen,2);
                        if ($namatd[$ktarif]=="PEMERIKSAAN DOKTER" && $str_golpas=="UMUM"){
                            $bruto = ($tr[$ktarif][$key]*$prs/100)*($tu[$ktarif])/100;
                        } else
                            $bruto = ($tr[$ktarif][$key]*$prs/100)*($td[$ktarif])/100;
                        $html .= "<td align='right' style='align:right'>".number_format($bruto,0,',','.')."</td>";
                        $total += $bruto;
                        $html .= "</tr>";
                    }
                }
            } else {
                if ($pelayanan==$val->pelayanan){
                    if ($gol_pasien=="all"){
                        $html .= "<tr>";
                        $html .= "<td>".($i++)."</td>";
                        $html .= "<td>".$val->no_reg." | ".$val->nama_pasien."</td>";
                        $html .= "<td>".$ktarif." | ".$namatd[$ktarif]."</td>";
                        $html .= "<td align='right' style='align:right'>".number_format($val->tarif_bpjs,0,',','.')."</td>";
                        $html .= "<td align='right' style='align:right'>".number_format($tarif_rs,0,',','.')."</td>";
                        $html .= "<td align='right' style='align:right'>".number_format($tr[$ktarif][$key],0,',','.')."</td>";
                        $html .= "<td align='center' style='align:center'>".($persen>100 ? 100 : round($persen,2))." %</td>";
                        $prs = $persen>100 ? "100" : round($persen,2);
                        if ($namatd[$ktarif]=="PEMERIKSAAN DOKTER" && $str_golpas=="UMUM"){
                            $bruto = ($tr[$ktarif][$key]*$prs/100)*($tu[$ktarif])/100;
                        } else
                            $bruto = ($tr[$ktarif][$key]*$prs/100)*($td[$ktarif])/100;
                        $html .= "<td align='right' style='align:right'>".number_format($bruto,0,',','.')."</td>";
                        $total += $bruto;
                        $html .= "</tr>";
                    } else {
                        if ($gol_pasien==$str_golpas){
                            $html .= "<tr>";
                            $html .= "<td>".($i++)."</td>";
                            $html .= "<td>".$val->no_reg." | ".$val->nama_pasien."</td>";
                            $html .= "<td>".$ktarif." | ".$namatd[$ktarif]."</td>";
                            $html .= "<td align='right' style='align:right'>".number_format($val->tarif_bpjs,0,',','.')."</td>";
                            $html .= "<td align='right' style='align:right'>".number_format($tarif_rs,0,',','.')."</td>";
                            $html .= "<td align='right' style='align:right'>".number_format($tr[$ktarif][$key],0,',','.')."</td>";
                            $html .= "<td align='center' style='align:center'>".($persen>100 ? 100 : round($persen,2))." %</td>";
                            $prs = $persen>100 ? "100" : round($persen,2);
                            if ($namatd[$ktarif]=="PEMERIKSAAN DOKTER" && $str_golpas=="UMUM"){
                                $bruto = ($tr[$ktarif][$key]*$prs/100)*($tu[$ktarif])/100;
                            } else
                                $bruto = ($tr[$ktarif][$key]*$prs/100)*($td[$ktarif])/100;
                            $html .= "<td align='right' style='align:right'>".number_format($bruto,0,',','.')."</td>";
                            $total += $bruto;
                            $html .= "</tr>";
                        }
                    }
                }
            }
        }
    }
    $html .= "<tr>";
    $html .= "<td colspan='7'>JUMLAH</td>";
    $html .= "<td align='right' style='align:right'>".number_format($total,0,',','.')."</td>";
    $html .= "</tr>";
?>
<table class="laporan" width="100%">
    <thead>
        <tr>
            <th>No.</th>
            <th>No. Reg/ Nama Pasien</th>
            <th style="align:center" class="text-center">Tindakan</th>
            <th style="align:center" class="text-center">Tarif BPJS</th>
            <th style="align:center" class="text-center">Tarif RS</th>
            <th style="align:center" class="text-center">Jasa</th>
            <th style="align:center" class="text-center">Persentase</th>
            <th style="align:center" class="text-center">Jasa Bruto</th>
        </tr>
    </thead>
    <tbody class="listdetail">
        <?php echo $html;?>
    </tbody>
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