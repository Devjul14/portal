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
    header("Content-Disposition: attachment; filename=Kontribusi Dinas ".$pelayanan."_".$tgl.".xls");
    $html = "";
    $key = 1;
    foreach ($q->result() as $val){
        $html .= "<tr>";
        $html .= "<td>".($key++)."</td>";
        $html .= "<td>".$val->no_reg."</td>";
        $html .= "<td>".$val->nama_pasien."</td>";
        $html .= "<td>".$val->gol_pasien."</td>";
        $html .= "<td>".$val->poliklinik."</td>";
        $html .= "</tr>";
    }
?>
<table class="laporan" border=1 width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Reg</th>
            <th>Nama Pasien</th>
            <th class="text-center">Gol Pasien</th>
            <th class="text-center">Poliklinik</th>
        </tr>
    </thead>
    <tbody class="listdetail">
        <?php echo $html;?>
    </tbody>
</table>