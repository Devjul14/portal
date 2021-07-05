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
    header("Content-Disposition: attachment; filename=HD.xls");
    $i = 1;
    $html = "";
    $subtotal = 0;
    $total_jumlah = 0;
    $semua = 0;
    $semua_total = 0;
    $total_dokter = 0;
    $total_perawat = 0;
    $total_administrasi = 0;
    $total_bhp = 0;
    $total_rumahsakit = 0;
    foreach($row["tarif"] as $key => $value){
        $jumlah = $row["jumlah"][$key];
        $valdokter = $value->dokter;
        $subtotal = ($value->dokter!="" ? $value->dokter*$jumlah/100 : 0)+
        ($value->perawat!="" ? $value->perawat*$jumlah/100 : 0)+
        ($value->administrasi!="" ? $value->administrasi*$jumlah/100 : 0)+
        ($value->bhp!="" ? $value->bhp*$jumlah/100 : 0)+
        ($value->rumahsakit!="" ? $value->rumahsakit*$jumlah/100 : 0);
        $html .= "<tr>";
        $html .= "<td>".($i++)."</td>";
        $html .= "<td>".($key=="hdl" ? "Rawat Inap" : "Rawat Jalan")."</td>";
        $html .= "<td style='align:right'>".round($jumlah,0)."</td>";
        $html .= "<td style='align:right'>".($value->dokter!="" ? round($value->dokter*$jumlah/100,0) : 0)."</td>";
        $html .= "<td style='align:right'>".($value->perawat!="" ? round($value->perawat*$jumlah/100,0) : 0)."</td>";
        $html .= "<td style='align:right'>".($value->administrasi!="" ? round($value->administrasi*$jumlah/100,0) : 0)."</td>";
        $html .= "<td style='align:right'>".($value->bhp!="" ? round($value->bhp*$jumlah/100,0) : 0)."</td>";
        $html .= "<td style='align:right'>".($value->rumahsakit!="" ? round($value->rumahsakit*$jumlah/100,0) : 0)."</td>";
        $html .= "<td style='align:right'>".(round($subtotal,0))."</td>";
        $html .= "</tr>";
        $total += ($subtotal);
        $total_jumlah += $jumlah;
        $total_dokter += ($value->dokter)*$jumlah/100;
        $total_perawat += ($value->perawat)*$jumlah/100;
        $total_administrasi += ($value->administrasi)*$jumlah/100;
        $total_bhp += ($value->bhp)*$jumlah/100;
        $total_rumahsakit += ($value->rumahsakit)*$jumlah/100;
    }
    $semua += $total_jumlah;
    $semua_total += $total;
    $html .= "<tr class='bg-orange'>";
    $html .= "<td colspan='2'>JUMLAH</td>";
    $html .= "<td style='align:right'>".round($total_jumlah,0)."</td>";
    $html .= "<td style='align:right'>".round($total_dokter,0)."</td>";
    $html .= "<td style='align:right'>".round($total_perawat,0)."</td>";
    $html .= "<td style='align:right'>".round($total_administrasi,0)."</td>";
    $html .= "<td style='align:right'>".round($total_bhp,0)."</td>";
    $html .= "<td style='align:right'>".round($total_rumahsakit,0)."</td>";
    $html .= "<td style='align:right'>".round($total,0)."</td>";
    $html .= "</tr>";
    $html2 = "";
    $i = 1;
    foreach($row2 as $key => $value){
        $html2 .= "<tr>";
        $html2 .= "<td style='align:right' width='20px'>".($i++)."</td>";
        $html2 .= "<td>".$value->id_dokter."</td>";
        $html2 .= "<td>".$value->nama_dokter."</td>";
        $persen = ($valdokter*$total/100)*($value->persentase)/100;
        $html2 .= "<td style='align:right'>".round($persen,0)."</td>";
        $html2 .= "</tr>";
    };
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
<table class="laporan" border=1 width="100%">
    <thead>
        <tr class='bg-navy'>
            <th>No.</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Jasa</th>
        </tr>
    </thead>
    <tbody class="listdokter"><?php echo $html2;?></tbody>
</table>