<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Stok Opname-".$kode.".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
	<tr>
		<th colspan='11' align="center">Stok Opname</th>
	</tr>
    <tr>
        <td>Periode</td>
        <td>
            <?php
                $bulan = date("m",strtotime($q->periode));
                Switch ($bulan){
                    case 1 : $bulan="Januari";
                        Break;
                    case 2 : $bulan="Februari";
                        Break;
                    case 3 : $bulan="Maret";
                        Break;
                    case 4 : $bulan="April";
                        Break;
                    case 5 : $bulan="Mei";
                        Break;
                    case 6 : $bulan="Juni";
                        Break;
                    case 7 : $bulan="Juli";
                        Break;
                    case 8 : $bulan="Agustus";
                        Break;
                    case 9 : $bulan="September";
                        Break;
                    case 10 : $bulan="Oktober";
                        Break;
                    case 11 : $bulan="November";
                        Break;
                    case 12 : $bulan="Desember";
                        Break;
                }
                echo $bulan ?> <?php echo date("Y",strtotime($q->periode))
            ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $q->nama_depo ?></td>
    </tr>
    <tr>
        <td>Jenis Barang</td>
        <td><?php echo $nj->nama_jenis ?></td>
    </tr>
</table>
<table border="1">
    <tr class="bg-navy">
        <th width="50px">No</th>
        <th width="100px" class="text-center">Kode Obat</th>
        <th width="300px">Nama Obat</th>
        <th width="150px" class="text-center">Stok Awal</th>
        <th width="100px" class="text-center">Pemasukan</th>
        <th width="100px" class="text-center">Pengeluaran</th>
        <th width="100px" class="text-center">Stok Opname</th>
        <th width="150px" class="text-center">Stok Real</th>
        <th width="100px" class="text-center">Satuan Kecil</th>
        <th width="200px" class="text-center">Jumlah</th>
        <th width="300px" class="text-center">Keterangan</th>
    </tr>
    <?php 
        $i = 0;
        foreach ($so->result() as $val) {
            $i++;
            echo "
                <tr>
                    <td>".$i."</td>
                    <td>".$val->kode_obat."</td>
                    <td>".$val->nama."</td>
                    <td>
                        ".$val->stok_awal."
                    </td>
                    <td>
                        ".$val->stok_pemakaian."
                    </td>
                    <td>
                        ".$val->stok_pemakaian."
                    </td>
                    <td>
                        ".$val->stok_so."
                    </td>
                    <td>
                        ".$val->stok_real."
                    </td>
                    <td>
                        ".$val->satuan_kecil."
                    </td>
                    <td>
                        ".number_format($val->jumlah,0,',','.')."
                    </td>
                    <td>
                        ".$val->keterangan."
                    </td>
                </tr>
            ";
        }
    ?>
</table>
<table border="1">
	<thead>
		<tr class="bg-navy">
            <th rowspan="2" width='15px'>No</th>
            <th rowspan="2">No Peserta</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Alamat</th>
            <th rowspan="2">Jenjang</th>
            <th rowspan="2">Sekolah</th>
            <th rowspan="2">Jurusan</th>
            <th rowspan="2">No Hp</th>
            <th rowspan="2">Email</th>
            
        </tr>
        <tr>
        	
        </tr>
	</thead>
	<tbody>
	</tbody>
</table>