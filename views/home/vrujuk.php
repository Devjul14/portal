<div class="col-md-12">
  <div class="box-body no-padding">
      <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped">
              <thead>
                  <tr class='bg-orange'>
                      <th class="text-center">No</th>
                      <th class="text-center">Ruang</th>
                      <th class="text-center">RM</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">DX</th>
                      <th class="text-center">DPJP</th>
                      <th class="text-center" width=150px>Tgl Masuk</th>
                      <th class="text-center" width=150px>Tgl/Jam Berangkat</th>
                      <th class="text-center">Alamat/Kesatuan</th>
                      <th class="text-center">RS Tujuan</th>
                      <th class="text-center">Ket</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($p["list"] as $no_rm => $value) {
                    foreach ($value as $no_reg => $row) {
                      echo "<tr>";
                      echo "<td>".($i++)."</td>";
                      echo "<td>".$p["ruangan"][$no_rm][$no_reg]."</td>";
                      echo "<td>".$no_rm."</td>";
                      echo "<td>".$row->nama_pasien."</td>";
                      echo "<td>".$p["br"][$no_rm][$no_reg]->diagnosa."</td>";
                      echo "<td>".$p["dpjp"][$no_rm][$no_reg]."</td>";
                      echo "<td class='text-center'>".date("d-m-Y",strtotime($row->tgl_masuk))."</td>";
                      echo "<td class='text-center'>".date("d-m-Y",strtotime($row->tgl_keluar))."/ ".date("H:i",strtotime($row->jam_keluar))."</td>";
                      echo "<td>".$p["master"][$no_rm][$no_reg]."</td>";
                      echo "<td>".$p["br"][$no_rm][$no_reg]->dikirim."</td>";
                      echo "<td>".$p["br"][$no_rm][$no_reg]->alasan."</td>";
                      echo "</tr>";
                    }
                  }
                ?>
              </tbody>
            </table>
        </div>
    </div>
</div>
