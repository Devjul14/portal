<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Kunjungan Ralan.xls");
?>
<table class="laporan" width="100%" border=1 >
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
                echo "<td>=\"".$row->no_bpjs."\"</td>";
                echo "<td>=\"".$row->no_pasien."\"</td>";
                echo "<td>".$row->nama_pasien."</td>";
                echo "<td>".$row->kode."</td>";
                echo "<td>".$row->briging."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>