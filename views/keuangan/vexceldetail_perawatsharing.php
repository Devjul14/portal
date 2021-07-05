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
        window.close();
    });
</script>
<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Anastesi.xls");
    $row = $q["detail"];
    $tr = $q["tarifrs"];
    $td = $q["tarifasisten"];
    $namatd = $q["namatarifasisten"];
    $gp = $q["golpas"];
    $html = "";
    $i = 1;
    $total = 0;
    $n = 0;
    foreach($row[$id_perawat] as $key => $value){
        foreach($value as $ktarif => $val){
            if ($val->gol_pasien==11){
                $tarif_rs = $tr[$ktarif][$key];
            }
            else{
                $tarif_rs = $val->tarif_rumahsakit;
            }
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
                    $html .= "<td align='right'>".round(($tr[$ktarif][$key]),0)."</td>";
                    $html .= "<td align='center'>".($td[$ktarif])." %</td>";
                    $bruto = ($tr[$ktarif][$key])*($td[$ktarif])/100;
                    $html .= "<td align='right'>".round($bruto,0)."</td>";
                    $total += $bruto;
                    $html .= "</tr>";
                } else {
                    if ($gol_pasien==$str_golpas){
                        $html .= "<tr>";
                        $html .= "<td>".($i++)."</td>";
                        $html .= "<td>".$val->no_reg." | ".$val->nama_pasien."</td>";
                        $html .= "<td align='right'>".round(($tr[$ktarif][$key]),0)."</td>";
                        $html .= "<td align='center'>".($td[$ktarif])." %</td>";
                        $bruto = ($tr[$ktarif][$key])*($td[$ktarif])/100;
                        $html .= "<td align='right'>".round($bruto,0)."</td>";
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
                        $html .= "<td align='right'>".round(($tr[$ktarif][$key]),0)."</td>";
                        $html .= "<td align='center'>".($td[$ktarif])." %</td>";
                        $bruto = ($tr[$ktarif][$key])*($td[$ktarif])/100;
                        $html .= "<td align='right'>".round($bruto,0)."</td>";
                        $total += $bruto;
                        $html .= "</tr>";
                    } else {
                        if ($gol_pasien==$str_golpas){
                            $html .= "<tr>";
                            $html .= "<td>".($i++)."</td>";
                            $html .= "<td>".$val->no_reg." | ".$val->nama_pasien."</td>";
                            $html .= "<td align='right'>".round(($tr[$ktarif][$key]),0)."</td>";
                            $html .= "<td align='center'>".($td[$ktarif])." %</td>";
                            $bruto = ($tr[$ktarif][$key])*($td[$ktarif])/100;
                            $html .= "<td align='right'>".round($bruto,0)."</td>";
                            $total += $bruto;
                            $html .= "</tr>";
                        }
                    }
                }
            }
        }
    }
    $html .= "<tr>";
    $html .= "<td colspan='4'>JUMLAH</td>";
    $html .= "<td align='right'>".round($total,0)."</td>";
    $html .= "</tr>";
?>
<table class="laporan" border=1 width="100%">
    <thead>
        <tr class='bg-navy'>
            <th>No.</th>
            <th>No. Reg/ Nama Pasien</th>
            <th class="text-center">Jasa</th>
            <th class="text-center">Persentase</th>
            <th class="text-center">Jasa Bruto</th>
        </tr>
    </thead>
    <tbody class="listdetail"><?php echo $html;?></tbody>
</table>