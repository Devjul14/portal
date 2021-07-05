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
        <tr class="bg-navy">
            <th>No.</th>
            <th>No. SEP</th>
            <th>Tgl. SEP</th>
            <th>RIRJ</th>
            <th>No. Kartu</th>
            <th>MR</th>
            <th>Nama Pasien</th>
            <th>Diagnosa</th>
            <th>Poli</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            foreach($q->result() as $row){
                echo "<tr>";
                echo "<td>".($i++)."</td>";
                echo "<td>".$row->no_sjp."</td>";
                echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                echo "<td>RJ</td>";
                echo "<td>".$row->no_bpjs."</td>";
                echo "<td>".$row->no_pasien."</td>";
                echo "<td>".$row->nama_pasien."</td>";
                echo "<td>".$row->kode."</td>";
                echo "<td>".$row->briging."</td>";
                echo "</tr>";
            }
        ?>
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