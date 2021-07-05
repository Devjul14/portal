<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
    });
</script>
<table id="myTable" class="table table-bordered">
	<thead>
		<tr class="bg-navy">
		   <th width="49px">No</th>
		   <th width="100px" class="text-center">Tanggal</th>
		   <th width="69px">No. KK</th>
		   <th width="130px">No. Pasien</th>
		   <th>Nama</th>
		   <th width="50px" class="text-center">P</th>
		   <th width="50px" class="text-center">C</th>
		   <th width="100px" class="text-center">Layanan</th>
		   <th width="100px" class="text-center">Medis</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i = $posisi;
			$no_kk = '';
			foreach ($q->result() as $row){
				$i++;
				echo "<tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
					  <td class='text-center'>".$i."</td>
					  <td class='text-center'>".date("d-m-Y",strtotime($row->tanggal))."</td>";
				if ($no_kk<>$row->no_kk){ 
					echo "<td class='text-center'>".$row->no_kk."</td>";
					$no_kk = $row->no_kk;
				}
				else
					echo "<td class='text-center'>&nbsp;</td>";
				echo "<td class='text-center'>".$row->no_pasien."</td>
					  <td>".anchor("kia/mtbmadd/".$row->id_pendaftaran."/".$row->id_pasien,$row->nama_pasien,array("class"=>"btn btn-sm btn-success"))."&nbsp;&nbsp;".
							anchor("kia/batalperiksamtbm/".$row->id_pendaftaran,"BATAL",array("class"=>"btn btn-danger btn-sm"))."</td>
					  <td class='text-center'>".$row->isperiksa."</td>
					  <td class='text-center'>".$row->iscatat."</td>
					  <td class='text-center'>".$row->layanan."</td>
					  <td class='text-center'>".$row->nama_paramedis."</td>
					  </tr>";
			}
		?>
	</tbody>
</table>