<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Kwitansi</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
</head>
<body>
    <table cellpadding="2" cellspacing="5" width="100%">
        <tr>
            <th align="left">RUMAH SAKIT CIREMAI<br>
                Jl. Kesambi No. 237 - Cirebon<br>
                Telpon. (0231)-238335
            </th>
        </tr>
        <tr>
            <th align="right">No. Registrasi : <?php echo $no_reg;?><br><?php echo ($row->ket_gol_pasien=="" ? $row->ket_gol_pasien1 : $row->ket_gol_pasien);?></th>
        </tr>
        <tr><th><h2>KWITANSI RAWAT JALAN</h2></th></tr>
    </table>
    <table cellpadding="2" cellspacing="2" width="100%">
        <tr><td width=200px>Sudah diterima dari<span class="pull-right">:&nbsp;&nbsp;</span></td><td><?php echo $row->nama_pasien;?></td></tr>
        <tr><td>Banyaknya Uang<span class="pull-right">:&nbsp;&nbsp;</span></td><td><?php if ($q->num_rows()>0) { $sql = $q->row();echo $this->terbilang->eja($sql->jumlah_bayar)." Rupiah";} else { echo "-";}?></td></tr>
        <tr><td>Untuk Pembayaran<span class="pull-right">:&nbsp;&nbsp;</span></td><td>Pemeriksaan dan Pengobatan atas Nama Pasien berikut ini :</td></tr>
    </table>
    <table cellpadding="2" cellspacing="2" width="100%">
        <tr>
            <td>Nama Pasien</td>
            <td>No. RM</td>
            <td>Alamat</td>
            <td>Pelayanan</td>
        </tr>
        <?php
            echo " <tr>";
            echo "<td>".$row->nama_pasien."</td>";
            echo "<td>".$row->no_pasien."</td>";
            echo "<td>".$row->alamat."</td>";
            echo "<td>".$row->poli."</td>";
            echo "</tr>";
        ?>
    </table>
    <table cellpadding="2" cellspacing="2" width="100%">
        <tr>
            <td>Dengan pemeriksaan sebagai berikut :</td>
            <td align="right">Tarif Rp.</td>
            <td align="right">Bayar Rp.</td>
        </tr>
        <?php
            $i = 1;
            $subtotal = 0;
            foreach($k->result() as $data){
                $subtotal += $data->jumlah;
                echo "<tr>";
                echo "<td>".($i++).". ".$data->nama_tindakan."</td>";
                echo "<td align='right'>".($q->num_rows()<=0 ? "<a href='#' class='dataChange' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a>" : number_format($data->jumlah,0,'.','.'))."</td>";
                echo "<td align='right'>".number_format($data->bayar,0,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($k1->result() as $data1){
                $subtotal += $data1->jumlah;
                echo "<tr>";
                echo "<td>".$i++.". ".$data1->nama_tindakan."</td>";
                echo "<td align='right'>".number_format($data1->jumlah,0,'.','.')."</td>";
                echo "<td align='right'>".number_format($data1->jumlah,0,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($k2->result() as $data2){
                $subtotal += $data2->jumlah;
                echo "<tr>";
                echo "<td>".$i++.". ".$data2->nama_tindakan."</td>";
                echo "<td align='right'>".number_format($data2->jumlah,0,'.','.')."</td>";
                echo "<td align='right'>".number_format($data2->jumlah,0,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($p1->result() as $data2){
                $subtotal += $data2->jumlah;
                echo "<tr>";
                echo "<td>".$i++.". ".$data2->ket."</td>";
                echo "<td align='right'>".number_format($data2->jumlah,0,'.','.')."</td>";
                echo "<td align='right'>".number_format($data2->jumlah,0,'.','.')."</td>";
                echo "</tr>";
            }
            $total_lab1 = 0;
            foreach($l1->result() as $datal1){
                $total_lab1 += $datal1->jumlah;
            }
            if ($total_lab1>0){
                echo "<tr>";
                echo "<td>".$i++.". Labotarium</td>";
                echo "<td align='right'>".number_format($total_lab1,0,'.','.')."</td>";
                echo "<td align='right'>".number_format($total_lab1,0,'.','.')."</td>";
                echo "</tr>";
            }
            $subtotal += $total_lab1;
            // $total_lab2 = 0;
            // foreach($l2->result() as $datal2){
            //     $total_lab2 += $datal2->jumlah;
            // }
            // if ($total_lab2>0){
            //     echo "<tr>";
            //     echo "<td>".$i++.". Labotarium (IGD)</td>";
            //     echo "<td align='right'>".number_format($total_lab2,0,'.','.')."</td>";
            //     echo "<td align='right'>".number_format($total_lab2,0,'.','.')."</td>";
            //     echo "</tr>";
            // }
            // $subtotal += $total_lab2;
            foreach($a1->result() as $data){
                $subtotal += $data->jumlah;
                echo "<tr>";
                echo "<td>".$i++.". ".$data->kota."</td>";
                echo "<td align='right'>".number_format($data->jumlah,0,'.','.')."</td>";
                echo "</tr>";
            }
        ?>
    </table><br><br><br>
    <table cellpadding="0" cellspacing="2" width="100%">
        <tr>
            <td align="left" rowspan="4" valign="top">
                Cirebon, <?php echo date("d-m-Y");?><br><br><br>
                <b>KASIR RAWAT JALAN</b>
            </td>
            <th align="right">Subtotal</th>
            <th>: Rp. </th>
            <th align="right"><?php echo number_format($subtotal,0,',','.');?></th>
        </tr>
        <?php 
            if ($q->num_rows()>0) : 
            $q = $q->row();
        ?>
        <tr>
            <th align="right">Disc</th>
            <th>: Rp. </th>
            <th align="right"><?php echo number_format($q->jumlah_disc,0,',','.');?></th>
        </tr>
        <tr>
            <th align="right">BPJS/ Perusahaan</th>
            <th>: Rp. </th>
            <th align="right"><?php echo number_format($q->jumlah_sharing,0,',','.');?></th>
        </tr>
        <tr>
            <th align="right">Total Bayar</th>
            <th>: Rp. </th>
            <th align="right"><?php echo number_format($q->jumlah_bayar,0,',','.');?></th>
        </tr>
        <?php endif ?>
</body>
<style type="text/css">
        .pull-right {
            float: right;
        }
        th, td{
            font-family: sans-serif;
        }
        td {
            font-size: 12px;
        }
        th {
            font-size: 12px;
        }
        .text-right{
            align:right;
        }
    </style>