<table class="table table-striped table-bordered table-hover " id="myTable" >
    <thead>
        <tr class="bg-navy">
            <th width="20px">No</th>
            <th>Nama Layanan</th>
            <th width="130px" class='text-center'>Jumlah</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 0;
        foreach ($q1->result() as $row){
            $i++;
            if(!isset($jumlah[$row->id_layanan])) $jum = 0; else $jum = $jumlah[$row->id_layanan];
            echo "<tr id=data>
                    <td>".$i."</td>
                    <td>".$row->layanan."</td>
                    <td align=center>".$jum."</td>
                 </tr>";
        }
    ?>
    </tbody>
</table>
<br>
<table class="table table-striped table-bordered table-hover " id="myTable1" >
    <thead>
        <tr class="bg-navy">
            <th width="20px">No</th>
            <th>Status Pembayaran</th>
            <th width="130px" class='text-center'>Jumlah</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 0;
        foreach ($q2->result() as $row){
            $i++;
            if(!isset($jml[$row->status_pembayaran])) $jum = 0; else $jum = $jml[$row->status_pembayaran];
            echo "<tr id=data>
                    <td>".$i."</td>
                    <td>".$row->status_pembayaran."</td>
                    <td class='text-center'>".$jum."</td>
                 </tr>";
        }
    ?>
    </tbody>
</table>