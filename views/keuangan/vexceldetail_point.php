<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
</head>
<script>
    $(document).ready(function(){
        window.close();
    });
</script>
<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=POINT.xls");
    $i = 1;
    $subtotal = 0;
    $total = 0;
    $total_jumlah = 0;

    $total_dokter = 0;
    $total_perawat = 0;
    $total_administrasi = 0;
    $total_bhp = 0;
    $total_rumahsakit = 0;

    $total_dokter_ralan = 0;
    $total_perawat_ralan = 0;
    $total_administrasi_ralan = 0;
    $total_bhp_ralan = 0;
    $total_rumahsakit_ralan = 0;

    $total_dokter_ranap = 0;
    $total_perawat_ranap = 0;
    $total_administrasi_ranap = 0;
    $total_bhp_ranap = 0;
    $total_rumahsakit_ranap = 0;
    $semua = 0;
    $semua_total = 0;
    $html  = "<tr class='bg-orange'>";
    $html .= "<td class='text-bold' colspan='9'>RAWAT JALAN</td>";
    $html .= "</tr>";
    foreach($row["tarif"] as $key => $value){
        $jumlah = $row["jumlah"][$key];
        $subtotal = ($value->dokter!="" ? $value->dokter*$jumlah/100 : 0)+
        ($value->perawat!="" ? $value->perawat*$jumlah/100 : 0)+
        ($value->administrasi!="" ? $value->administrasi*$jumlah/100 : 0)+
        ($value->bhp!="" ? $value->bhp*$jumlah/100 : 0)+
        ($value->rumahsakit!="" ? $value->rumahsakit*$jumlah/100 : 0);
        $html .= "<tr>";
        $html .= "<td>".($i++)."</td>";
        $html .= "<td>".$key." | ".$value->nama_tindakan."</td>";
        $html .= "<td class='text-right'>".round($jumlah,0)."</td>";
        $html .= "<td class='text-right'>".($value->dokter!="" ? round($value->dokter*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->perawat!="" ? round($value->perawat*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->administrasi!="" ? round($value->administrasi*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->bhp!="" ? round($value->bhp*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->rumahsakit!="" ? round($value->rumahsakit*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".round($subtotal,0)."</td>";
        $html .= "</tr>";
        $total += $subtotal;
        $total_jumlah += $jumlah;
        $total_dokter_ralan += ($value->dokter!="" ? ($value->dokter)*$jumlah/100 : 0);
        $total_perawat_ralan += ($value->perawat!="" ? ($value->perawat)*$jumlah/100 : 0);
        $total_administrasi_ralan += ($value->administrasi!="" ? ($value->administrasi)*$jumlah/100 : 0);
        $total_bhp_ralan += ($value->bhp!="" ? ($value->bhp)*$jumlah/100 : 0);
        $total_rumahsakit_ralan += ($value->rumahsakit!="" ? ($value->rumahsakit)*$jumlah/100 :0);
    }
    $semua += $total_jumlah;
    $semua_total += $total;
    $html .= "<tr class='bg-orange'>";
    $html .= "<td colspan='2'>JUMLAH</td>";
    $html .= "<td class='text-right'>".round($total_jumlah,0)."</td>";
    $html .= "<td class='text-right'>".round($total_dokter_ralan,0)."</td>";
    $html .= "<td class='text-right'>".round($total_perawat_ralan,0)."</td>";
    $html .= "<td class='text-right'>".round($total_administrasi_ralan,0)."</td>";
    $html .= "<td class='text-right'>".round($total_bhp_ralan,0)."</td>";
    $html .= "<td class='text-right'>".round($total_rumahsakit_ralan,0)."</td>";
    $html .= "<td class='text-right'>".round($total,0)."</td>";
    $html .= "</tr>";
    $i = 1;
    $subtotal = 0;
    $total = 0;
    $total_jumlah = 0;
    $html .= "<tr class='bg-orange'>";
    $html .= "<td class='text-bold' colspan='9'>RAWAT INAP</td>";
    $html .= "</tr>";
    foreach($row["tarifranap"] as $key => $value){
        $jumlah = $row["jumlahranap"][$key];
        $subtotal = ($value->dokter!="" ? $value->dokter*$jumlah/100 : 0)+
        ($value->perawat!="" ? $value->perawat*$jumlah/100 : 0)+
        ($value->administrasi!="" ? $value->administrasi*$jumlah/100 : 0)+
        ($value->bhp!="" ? $value->bhp*$jumlah/100 : 0)+
        ($value->rumahsakit!="" ? $value->rumahsakit*$jumlah/100 : 0);
        $html .= "<tr>";
        $html .= "<td>".($i++)."</td>";
        $html .= "<td>".$key." | ".$value->nama_tindakan."</td>";
        $html .= "<td class='text-right'>".round($jumlah,0)."</td>";
        $html .= "<td class='text-right'>".($value->dokter!="" ? round($value->dokter*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->perawat!="" ? round($value->perawat*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->administrasi!="" ? round($value->administrasi*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->bhp!="" ? round($value->bhp*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".($value->rumahsakit!="" ? round($value->rumahsakit*$jumlah/100,0) : 0)."</td>";
        $html .= "<td class='text-right'>".round($subtotal,0)."</td>";
        $html .= "</tr>";
        $total += $subtotal;
        $total_jumlah += $jumlah;
        $total_dokter_ranap += ($value->dokter!="" ? ($value->dokter)*$jumlah/100 : 0);
        $total_perawat_ranap += ($value->perawat!="" ? ($value->perawat)*$jumlah/100 : 0);
        $total_administrasi_ranap += ($value->administrasi!="" ? ($value->administrasi)*$jumlah/100 : 0);
        $total_bhp_ranap += ($value->bhp!="" ? ($value->bhp)*$jumlah/100 : 0);
        $total_rumahsakit_ranap += ($value->rumahsakit!="" ? ($value->rumahsakit)*$jumlah/100 :0);
    }
    $semua += $total_jumlah;
    $semua_total += $total;
    $html .= "<tr class='bg-orange'>";
    $html .= "<td colspan='2'>JUMLAH</td>";
    $html .= "<td class='text-right'>".round($total_jumlah,0)."</td>";
    $html .= "<td class='text-right'>".round($total_dokter_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_perawat_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_administrasi_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_bhp_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_rumahsakit_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total,0)."</td>";
    $html .= "</tr>";
    $html .= "<tr class='bg-orange'>";
    $html .= "<td colspan='2'>TOTAL JUMLAH</td>";
    $html .= "<td class='text-right'>".round($semua,0)."</td>";
    $html .= "<td class='text-right'>".round($total_dokter_ralan+$total_dokter_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_perawat_ralan+$total_perawat_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_administrasi_ralan+$total_administrasi_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_bhp_ralan+$total_bhp_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($total_rumahsakit_ralan+$total_rumahsakit_ranap,0)."</td>";
    $html .= "<td class='text-right'>".round($semua_total,0)."</td>";
    $html .= "</tr>";
?>
<table class="laporan" border=1 width="100%">
    <thead>
        <tr class='bg-navy'>
            <th>No.</th>
            <th class="text-center">Tindakan</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Dokter</th>
            <th class="text-center">Perawat</th>
            <th class="text-center">Administrasi</th>
            <th class="text-center">BHP</th>
            <th class="text-center">RS</th>
            <th class="text-center">Subtotal</th>
        </tr>
    </thead>
    <tbody class="listdetail"><?php echo $html;?></tbody>
</table>