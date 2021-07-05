<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
    });
</script>
<table class="table table-bordered table-hover" id="myTable">
  <thead>
      <tr class="bg-navy">
         <th width="20" class="text-center">No</th>
         <th width="100" class="text-center">Tgl</th>
         <th width="69" class="text-center">No. KK</th>
         <th width="120" class="text-center">No. Pasien</th>
         <th class="text-center">Nama</th>
         <th width="50" class="text-center">P</th>
         <th width="50" class="text-center">C</th>
         <th width="140" class="text-center">Layanan</th>
         <th width="100" class="text-center">Medis</th>
       </tr>
  </thead>
  <tbody>
      <?php
          $i = $posisi;
          $no_kk = '';
          foreach ($q->result() as $row){
              $i++;
              echo "<tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
                    <td align=center>".$i."</td>
                    <td align=center>".date("d-m-Y",strtotime($row->tanggal))."</td>";
              if ($no_kk<>$row->no_kk){ 
                  echo "<td align=center>".$row->no_kk."</td>";
                  $no_kk = $row->no_kk;
              }
              else
                  echo "<td class=text-center>&nbsp;</td>";
              echo "<td class=text-center>".$row->no_pasien."</td>
                    <td>".anchor("umum/umumdetail/".$row->id_pendaftaran,$row->nama_pasien,array("class"=>"btn btn-sm btn-success"))."&nbsp;&nbsp;"
                         .anchor("umum/batalperiksa/".$row->id_pendaftaran,"BATAL",array("class"=>"btn btn-sm btn-danger"))."</td>
                    <td class=text-center>".$row->isperiksa."</td>
                    <td class=text-center>".$row->iscatat."</td>
                    <td class=text-center>".$row->layanan."</td>
                    <td class=text-center>".$row->nama_paramedis."</td>
                    </tr>";
          }
      ?>
  </tbody>
</table>