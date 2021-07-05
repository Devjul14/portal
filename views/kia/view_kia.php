<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
    });
</script>
<table id="myTable" class="table table-bordered">
	<thead>
		<tr class="bg-navy">
			<th width="49">No</th>
			<th class="text-center" width="100">Tanggal</th>
			<th width="69">No. KK</th>
			<th class="text-center" width="100">No. Pasien</th>
			<th>Nama</th>
			<th class="text-center" width="20">P</th>
			<th class="text-center" width="20">C</th>
			<th class="text-center" width="130">Layanan</th>
			<th class="text-center" width="100">Medis</th>
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
					  <td>"
					  		."<strong>".$row->nama_pasien."</strong>&nbsp;&nbsp;"
					  		."<div class='pull-right'>"
					  		.anchor("kia/ancdetailadd/".$row->id_pendaftaran."/".$row->id_pasien,"PERIKSA",array("class"=>"btn btn-sm btn-info"))."&nbsp;&nbsp;"
					  		.anchor("kia/ancinapadd/".$row->id_pendaftaran."/".$row->id_pasien,"INAP",array("class"=>"btn  btn-sm btn-success"))."&nbsp;&nbsp;"
					  		.anchor("kia/batalperiksa/".$row->id_pendaftaran,"BATAL",array("class"=>"btn  btn-sm btn-danger"))
					  		."</div>".
					  "</td>
					  <td class='text-center'>".$row->isperiksa."</td>
					  <td class='text-center'>".$row->iscatat."</td>
					  <td class='text-center'>".$row->layanan."</td>
					  <td class='text-center'>".$row->nama_paramedis."</td>
					  </tr>";
			}
		?>
	</tbody>
</table>