<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Kwitansi</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
</head>
<?php
    $s = $q->row();
?>
<script>
    $(document).ready(function(){
            getttd();
            window.print();
        });
        function getttd(){
            var ttd = "<?php echo site_url('ttddokter/getttdpetugas/'.$s->petugas_kasir);?>";
            $('.ttd_qrcode_petugas').qrcode({width: 100,height: 100, text:ttd});
        }
</script> 
<body>
    <table cellpadding="2" cellspacing="5" width="100%">
        <tr>
            <th align="left">RUMAH SAKIT CIREMAI<br>
                Jl. Kesambi No. 237 - Cirebon<br>
                Telpon. (0231)-238335
            </th>
        </tr>
        <tr>
            <th align="right">No. Registrasi : <?php echo $no_reg;?><br><?php echo $row->ket_gol_pasien;?></th>
        </tr>
        <tr>
            <th>
                <h2>KWITANSI RAWAT INAP</h2>
                <?php
                    if ($q->num_rows()>0){
                        $rq = $q->row();
                        if ($rq->print>0){
                            echo "<h4>(COPY ".$rq->print.")</h4>";
                        }
                    }
                ?>
            </th>
        </tr>
    </table>
    <table cellpadding="2" cellspacing="2" width="100%">
        <tr><td width=200px>Sudah diterima dari<span class="pull-right">:&nbsp;&nbsp;</span></td><td><?php echo $row->nama_pasien;?></td></tr>
        <tr><td>Banyaknya Uang<span class="pull-right">:&nbsp;&nbsp;</span></td><td><?php if ($q->num_rows()>0) { $sql = $q->row();echo $this->terbilang->eja($sql->jumlah_bayar)." Rupiah";} else { echo "-";}?></td></tr>
        <tr><td>Untuk Pembayaran<span class="pull-right">:&nbsp;&nbsp;</span></td><td>Rawat Inap atas Nama Pasien berikut ini :</td></tr>
    </table>
    <table cellpadding="2" cellspacing="2" width="100%">
        <tr>
            <td>Nama Pasien</td>
            <td>No. RM</td>
            <td>Alamat</td>
        </tr>
        <?php
            $finish = date("Y-m-d",strtotime($row->tgl_keluar));
            $start = date("Y-m-d",strtotime($row->tgl_masuk));
            $durasi= strtotime($finish)-strtotime($start);
            $hari = $durasi / (60 * 60 * 24);
            echo " <tr>";
            echo "<td>".$row->nama_pasien."</td>";
            echo "<td>".$row->no_rm."</td>";
            echo "<td>".$row->alamat."</td>";
            echo "</tr>";
            echo " <tr>";
            echo "<td>Tanggal Masuk : ".date("d-m-Y",strtotime($row->tgl_masuk))."</td>";
            echo "<td>Tanggal Bayar : ".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
            echo "<td>Lama : ".($row->tgl_keluar=="" ? "-" : $hari+1)." hari</td>";
            echo "</tr>";
        ?>
    </table>
    <table cellpadding="2" cellspacing="2" width="100%" style="border-bottom: 1px #000000 dashed">
        <tr>
            <th style="border-top: 1px #000000 dashed;border-bottom: 1px #000000 dashed;text-align:right" width="10" class='text-center'>No</th>
            <th style="border-top: 1px #000000 dashed;border-bottom: 1px #000000 dashed" class="text-left">Tanggal</th>
            <th style='border-top: 1px #000000 dashed;border-bottom: 1px #000000 dashed;text-align:left'>Rincian</th>
            <th style='border-top: 1px #000000 dashed;border-bottom: 1px #000000 dashed;text-align:left'>Petugas</th>
            <th style='border-top: 1px #000000 dashed;border-bottom: 1px #000000 dashed;text-align:right'>Tagihan</th>
            <th style='border-top: 1px #000000 dashed;border-bottom: 1px #000000 dashed;text-align:right'>Qty</th>
            <th style='border-top: 1px #000000 dashed;border-bottom: 1px #000000 dashed;text-align:right'>Jumlah</th>
        </tr>
        <?php
            $i = 1;
            $subtotal = 0;
            foreach($t1->result() as $data){
                $subtotal += ($data->jumlah*$data->qty);
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                echo "<td>".ucwords(strtolower($data->nama_tindakan))."</td>";
                if ($data->kode_tarif=="kmr"){
                    echo "<td class='text-left'>".(isset($kamar[$data->kode_petugas]) ? $kamar[$data->kode_petugas] : "")."</a></td>";    
                }
                else{
                    echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "")."</td>";
                }
                echo "<td style='text-align:right'>".number_format($data->jumlah,0,'.','.')."</td>";
                echo "<td style='text-align:right'>".number_format($data->qty,2,'.','.')."</td>";
                echo "<td style='text-align:right'>".number_format($data->jumlah*$data->qty,0,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($t2->result() as $data){
                $subtotal += ($data->jumlah*$data->qty);
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                echo "<td>".ucwords(strtolower($data->nama_tindakan))."</td>";
                echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "")."</td>";
                echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                echo "<td class='text-right'>".number_format($data->qty,2,'.','.')."</a></td>";
                echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,0,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($a1->result() as $data){
                $subtotal += ($data->jumlah*$data->qty);
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                echo "<td>Ambulance (".ucwords(strtolower($data->kota)).")</td>";
                echo "<td style='text-align:right'>".$data->kode_petugas."</td>";
                echo "<td style='text-align:right'>".number_format($data->jumlah,0,'.','.')."</td>";
                echo "<td style='text-align:right'>".$data->qty."</td>";
                echo "<td style='text-align:right'>".number_format($data->jumlah*$data->qty,0,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($p1->result() as $data){
                $subtotal += ($data->jumlah*$data->qty);
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                echo "<td>".ucwords(strtolower($data->ket))."</td>";
                echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "")."</td>";
                echo "<td style='text-align:right'>".number_format($data->jumlah,0,'.','.')."</td>";
                echo "<td style='text-align:right'>".number_format($data->qty,2,'.','.')."</td>";
                echo "<td style='text-align:right'>".number_format($data->jumlah*$data->qty,0,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($o1->result() as $data){
                $subtotal += ($data->jumlah*$data->qty);
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                echo "<td>".$data->nama_tindakan."</td>";
                echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "")."</td>";
                echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                echo "<td class='text-right'>".number_format($data->qty,2,'.','.')."</a></td>";
                echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                echo "</tr>";
            }
            foreach($o2->result() as $data){
                $subtotal += ($data->jumlah*$data->qty);
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                echo "<td>".$data->nama_tindakan."</td>";
                echo "<td class='text-left'>".(isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "")."</a></td>";
                echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                echo "<td class='text-right'>".number_format($data->qty,2,'.','.')."</a></td>";
                echo "<td class='text-right'>".number_format($data->jumlah*$data->qty,2,'.','.')."</td>";
                echo "</tr>";
            }
            $total_rad1 = 0;
            foreach($r1->result() as $datar1){
                $total_rad1 += $datar1->jumlah;
            }
            if ($total_rad1>0){
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y")."</td>";
                echo "<td colspan=4>Radiologi</td>";
                echo "<td class='text-right'>".number_format($total_rad1,0,'.','.')."</td>";
                echo "</tr>";
            }
            $subtotal += $total_rad1;
            $total_lab1 = 0;
            foreach($l1->result() as $datal1){
                $total_lab1 += $datal1->jumlah;
            }
            if ($total_lab1>0){
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y")."</td>";
                echo "<td colspan=4>Labotarium</td>";
                echo "<td class='text-right'>".number_format($total_lab1,0,'.','.')."</td>";
                echo "</tr>";
            }
            $subtotal += $total_lab1;
            $total_pa1 = 0;
            foreach($pa1->result() as $datal1){
                $total_pa1 += $datal1->jumlah;
            }
            if ($total_pa1>0){
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y")."</td>";
                echo "<td colspan=4>Patalogi Anatomi</td>";
                echo "<td class='text-right'>".number_format($total_pa1,0,'.','.')."</td>";
                echo "</tr>";
            }
            $subtotal += $total_pa1;
            $total_gizi1 = 0;
            foreach($g1->result() as $datal1){
                $total_gizi1 += $datal1->jumlah;
            }
            if ($total_gizi1>0){
                echo "<tr>";
                echo "<td style='text-align:right'>".$i++."</td>";
                echo "<td style='text-align:center'>".date("d-m-Y")."</td>";
                echo "<td colspan=4>Gizi</td>";
                echo "<td class='text-right'>".number_format($total_gizi1,0,'.','.')."</td>";
                echo "</tr>";
            }
            $subtotal += $total_gizi1;
        ?>
    </table><br><br><br>
    <table cellpadding="0" cellspacing="2" width="100%">
        <tr>
            <th align="left" rowspan="4" valign="top">
                Cirebon, <?php echo date("d-m-Y");?><br><br>
                <?php 
                    if ($q->num_rows()>0) { 
                        $rq = $q->row();
                        echo '<div class="ttd_qrcode_petugas"></div><br>';
                        echo "<b>".$rq->nama."</b>";
                    } else {
                        echo "<b>KASIR RAWAT INAP</b>";
                    }
                ?>
            </th>
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
            <th align="right"><?php echo number_format($subtotal-$q->jumlah_disc-$q->jumlah_sharing,0,',','.');?></th>
        </tr>
        <?php endif ?>
</body>
<style type="text/css">
        html, body {
            width: 20cm; /* was 8.5in */
            height: 14cm; /* was 5.5in */
            display: block;
        }
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
            text-align:right;
        }
        @page {
          size: 20cm 14cm;
        }
    </style>