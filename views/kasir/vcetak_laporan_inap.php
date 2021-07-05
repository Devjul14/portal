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
    <table  width="100%" class="laporan">
        <thead>
            <tr>
                <th class="text-center header-laporan" colspan="7" style="border:none;">
                    <h3>LAPORAN <?php echo ($frm==0 ? "RAWAT INAP" : ($frm==1 ?"APOTEK" : "PARSIAL"));?></h3>
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
                <th class="text-center">Jumlah</th>
                <?php if($frm=="all") :?>
                <th class="text-center">Sharing</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $no_reg = "";
                $i = 1;
                $jumlah = 0;
                $blu = 0;
                if ($frm=="all" || $frm==0 || $frm==1 || $frm==2){
                    foreach ($q->result() as $row) {
                        if ($row->gol_pasien==11){
                            $str_golpas = "UMUM";
                        } else 
                        if ($row->gol_pasien>=12 && $row->gol_pasien<=18){
                            $str_golpas = "PERUSAHAAN";
                        } else {
                            $str_golpas = "BPJS";
                        }
                        if ($golpas!="all"){
                            if ($golpas==$str_golpas){
                                echo "<tr>";
                                echo "<td>".($i++)."</td>";
                                echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                echo "<td>".$row->no_reg."</td>";
                                echo "<td>".$row->no_pasien."</td>";
                                echo "<td>".$row->nama_pasien."</td>";
                                echo "<td>".$row->ket_golpas."</td>";
                                echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                if ($frm=="all")
                                    echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                echo "</tr>";
                                $jumlah += $row->jumlah;
                                $blu += $row->blu;
                            }
                        } else {
                            echo "<tr>";
                            echo "<td>".($i++)."</td>";
                            echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                            echo "<td>".$row->no_reg."</td>";
                            echo "<td>".$row->no_pasien."</td>";
                            echo "<td>".$row->nama_pasien."</td>";
                            echo "<td>".$row->ket_golpas."</td>";
                            echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                            if ($frm=="all")
                                    echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                            echo "</tr>";
                            $jumlah += $row->jumlah;
                            $blu += $row->blu;
                        }
                    }
                }  
                if ($frm=="all" || $frm==1){
                    if ($golpas=="all" || $golpas=="UMUM"){
                        foreach ($a->result() as $row) {
                            $str_golpas = "UMUM";
                            echo "<tr>";
                            echo "<td>".($i++)."</td>";
                            echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                            echo "<td>".$row->no_reg."</td>";
                            echo "<td>".$row->no_rm."</td>";
                            echo "<td>".$row->nama_pasien."</td>";
                            echo "<td>".$str_golpas."</td>";
                            echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                            echo "</tr>";
                            $jumlah += $row->jumlah;
                        }
                    }
                }  
                if ($frm=="all" || $frm==3){
                    foreach ($p->result() as $row) {
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
                                    echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                    if ($frm=="all")
                                        echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                    echo "</tr>";
                                    $jumlah += $row->jumlah;
                                    $blu += $row->blu;
                                }
                            } else {
                                echo "<tr>";
                                echo "<td>".($i++)."</td>";
                                echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                echo "<td>".$row->no_reg."</td>";
                                echo "<td>".$row->no_pasien."</td>";
                                echo "<td>".$row->nama_pasien."</td>";
                                echo "<td>".$row->ket_golpas."</td>";
                                echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                if ($frm=="all")
                                        echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                echo "</tr>";
                                $jumlah += $row->jumlah;
                                $blu += $row->blu;
                            }
                        }
                    }
                }
            ?>
            <tr class="bg-gray">
                <th colspan=6>JUMLAH</th>
                <th class="text-right"><?php echo number_format($jumlah,0,',','.');?></th>
                <?php
                    if ($frm=="all"){
                        echo "<th class='text-right'>".number_format($blu,0,',','.')."</th>";
                    }
                ?>
            </tr>
        </tbody>
    </table>
</div>
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