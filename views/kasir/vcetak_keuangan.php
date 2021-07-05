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
		window.print();
	</script>
<body>
    <div class="margin">
    <table  width="100%" class="laporan" border="1">
        <thead>
            <tr>
                <th class="text-center header-laporan" colspan="11">
                    <h3>LAPORAN SHARING</h3>
                    <p>
                        PERIODE <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?>
                    </p>
                </th>
            </tr>
            <tr class="bg-gray">
                <th>No.</th>
                <th>Tanggal</th>
                <th>No Reg</th>
                <th>No RM</th>
                <th>Nama</th>
                <th>Gol. Pasien</th>
                <th class="text-center">Sharing</th>
                <th class="text-center">BLU</th>
                <th class="text-center">Kodal</th>
                <th class="text-center">COB</th>
                <th class="text-center">Perusahaan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no_reg = "";
                $i = 1;
                $jumlah = 0;
                foreach ($q->result() as $row) {
                    if ($row->gol_pasien==11){
                        $str_golpas = "UMUM";
                    } else 
                    if ($row->gol_pasien>=12 && $row->gol_pasien<=18){
                        $str_golpas = "PERUSAHAAN";
                    } else {
                        $str_golpas = "BPJS";
                    }
                    if ($no_reg!=$row->no_reg){
                        if ($golpas!="all"){
                            if ($golpas==$str_golpas){
                                echo "<tr>";
                                echo "<td>".($i++)."</td>";
                                echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                echo "<td>".$row->no_reg."</td>";
                                echo "<td>".$row->no_pasien."</td>";
                                echo "<td>".$row->nama_pasien."</td>";
                                echo "<td>".$row->ket_golpas."</td>";
                                echo "<td style='≈text-align:right'>".number_format($row->sharing,0,',','.')."</td>";
                                echo "<td style='≈text-align:right'>".number_format($row->blu,0,',','.')."</td>";
                                echo "<td style='≈text-align:right'>".number_format($row->sharing-$row->blu,0,',','.')."</td>";
                                echo "<td style='≈text-align:right'>".number_format($row->cob,0,',','.')."</td>";
                                echo "<td>".$row->nama_perusahaan."</td>";
                                echo "</tr>";
                                $jumlah += ($row->sharing-$row->blu);
                            }
                        } else {
                            echo "<tr>";
                            echo "<td>".($i++)."</td>";
                            echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                            echo "<td>".$row->no_reg."</td>";
                            echo "<td>".$row->no_pasien."</td>";
                            echo "<td>".$row->nama_pasien."</td>";
                            echo "<td>".$row->ket_golpas."</td>";
                            echo "<td style='text-align:right'>".number_format($row->sharing,0,',','.')."</td>";
                            echo "<td style='text-align:right'>".number_format($row->blu,0,',','.')."</td>";
                            echo "<td style='text-align:right'>".number_format($row->sharing-$row->blu,0,',','.')."</td>";
                            echo "<td style='≈text-align:right'>".number_format($row->cob,0,',','.')."</td>";
                            echo "<td>".$row->nama_perusahaan."</td>";
                            echo "</tr>";
                            $jumlah += ($row->sharing-$row->blu);
                        }
                    }
                }
            ?>
            <tr class="bg-gray">
                <th colspan=6>JUMLAH</th>
                <th style='text-align:right' colspan=3><?php echo number_format($jumlah,0,',','.');?></th>
                <th colspan=2></th>
            </tr>
        </tbody>
    </table>
</div>
<style type="text/css">
    th.header-laporan,
    td.header-laporan {
        border:0;
    }
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
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
        border-top: 1px solid #ddd;
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .laporan > caption + thead > tr:first-child > th,
    .laporan > colgroup + thead > tr:first-child > th,
    .laporan > thead:first-child > tr:first-child > th,
    .laporan > caption + thead > tr:first-child > td,
    .laporan > colgroup + thead > tr:first-child > td,
    .laporan > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .laporan td,
    .laporan th {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }
</style>