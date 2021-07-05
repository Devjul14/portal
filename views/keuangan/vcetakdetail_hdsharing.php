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
    $i = 1;
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
        $html .= "<td align='right'>".number_format($jumlah,0)."</td>";
        $html .= "<td align='right'>".($value->dokter!="" ? number_format($value->dokter*$jumlah/100,0,',','.') : 0)."</td>";
        $html .= "<td align='right'>".($value->perawat!="" ? number_format($value->perawat*$jumlah/100,0,',','.') : 0)."</td>";
        $html .= "<td align='right'>".($value->administrasi!="" ? number_format($value->administrasi*$jumlah/100,0,',','.') : 0)."</td>";
        $html .= "<td align='right'>".($value->bhp!="" ? number_format($value->bhp*$jumlah/100,0,',','.') : 0)."</td>";
        $html .= "<td align='right'>".($value->rumahsakit!="" ? number_format($value->rumahsakit*$jumlah/100,0,',','.') : 0)."</td>";
        $html .= "<td align='right'>".(number_format($subtotal,0,',','.'))."</td>";
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
    $html .= "<td align='right'>".number_format($total_jumlah,0,',','.')."</td>";
    $html .= "<td align='right'>".number_format($total_dokter,0,',','.')."</td>";
    $html .= "<td align='right'>".number_format($total_perawat,0,',','.')."</td>";
    $html .= "<td align='right'>".number_format($total_administrasi,0,',','.')."</td>";
    $html .= "<td align='right'>".number_format($total_bhp,0,',','.')."</td>";
    $html .= "<td align='right'>".number_format($total_rumahsakit,0,',','.')."</td>";
    $html .= "<td align='right'>".number_format($total,0,',','.')."</td>";
    $html .= "</tr>";
    $html2 = "";
    $i = 1;
    foreach($row2 as $key => $value){
        $html2 .= "<tr>";
        $html2 .= "<td align='right' width='20px'>".($i++)."</td>";
        $html2 .= "<td>".$value->id_dokter."</td>";
        $html2 .= "<td>".$value->nama_dokter."</td>";
        $persen = ($valdokter*$total/100)*($value->persentase)/100;
        $html2 .= "<td align='right'>".number_format($persen,0,',','.')."</td>";
        $html2 .= "</tr>";
    };
?>
<table class="laporan" width="100%">
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
<table class="laporan" width="100%">
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