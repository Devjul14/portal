<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link media="all" rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
</head>
<script>
    window.print();
</script>
<div class="col-md-12"><h4>Periode <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl1));?></h4></div>
<table class="table table-bordered">
    <thead>
        <tr class="bg-navy">
            <th>No.</th>
            <th>No. RM</th>
            <th>No. Reg</th>
            <th>No. BPJS</th>
            <th>No. SEP</th>
            <th>Nama</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            $total = 0;
            foreach($q as $row){
                echo "<tr>";
                echo "<td>".($i++)."</td>";
                echo "<td>".$row->no_pasien."</td>";
                echo "<td>".$row->no_reg."</td>";
                echo "<td>".$row->no_bpjs."</td>";
                echo "<td>".$row->no_sjp."</td>";
                echo "<td>".$row->nama_pasien."</td>";
                echo "<td class='text-right'>".number_format($row->obat_kronis,0,',','.')."</td>";
                echo "</tr>";
                $total += $row->obat_kronis;
            }
        ?>
    </tbody>
    <tfoot>
        <tr class="bg-navy">
            <th colspan="6">TOTAL</th>
            <th class='text-right'><?php echo number_format($total,0,',','.');?></th>
        </tr>
    </tfoot>
</table>