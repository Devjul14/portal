<!DOCTYPE html>
<html>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-barcode.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
<script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script>
  // window.print();
  $(document).ready(function() {
      getttd_perawat();
  });
  function getttd_perawat() {
      var ttd = "<?php echo site_url('ttddokter/getttdperawat2/' . $kt->id_perawat); ?>";
      $('.ttd_perawat').qrcode({
          width: 80,
          height: 80,
          text: ttd
      });
    }
</script>
<body>
    <div class="col-xs-12">
        <h3 class="text-center">LAPORAN KONTROLE</h3>
        <h3>1. Instalasi Rawat Inap</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr>
                  <th style="vertical-align: middle" class="text-center" rowspan="3">No</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="3" colspan="2">Ruangan</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="3">TT</th>
                  <!-- <th style="vertical-align: middle" class="text-center" rowspan="3">Nama Perawat</th> -->
                  <th style="vertical-align: middle" class="text-center" colspan="9">Keterangan</th>
                </tr>
                <tr>
                  <th style="vertical-align: middle" class="text-center" colspan="2">D</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">U</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">BPJS</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">PRSH</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">Jumlah</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">HP</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">BOR</th>
                </tr>
                <tr>
                  <th style="vertical-align: middle" class="text-center">Aktif</th>
                  <th style="vertical-align: middle" class="text-center">Purn</th>
                </th>
            </thead>
            <tbody>
              <?php
              $dinas_a = $dinas_pur = $umum = $bpjs = $prsh = 0;
              $jml_dinas_a = $jml_dinas_pur = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = $jlm_hp = 0;
              $i = 0;
              $kr = "";
              foreach ($r as $kode_ruangan_a => $value) {
                foreach ($value as $kode_kelas => $row) {
                  if ($row->kode_ruangan!=19){
                      $dinas_a = (isset($inap["DINAS_A"][$kode_ruangan_a][$kode_kelas]) ? $inap["DINAS_A"][$kode_ruangan_a][$kode_kelas] : 0);
                      $dinas_pur = (isset($inap["DINAS_PUR"][$kode_ruangan_a][$kode_kelas]) ? $inap["DINAS_PUR"][$kode_ruangan_a][$kode_kelas] : 0);
                      $umum = (isset($inap["UMUM"][$kode_ruangan_a][$kode_kelas]) ? $inap["UMUM"][$kode_ruangan_a][$kode_kelas] : 0);
                      $bpjs = (isset($inap["BPJS"][$kode_ruangan_a][$kode_kelas]) ? $inap["BPJS"][$kode_ruangan_a][$kode_kelas] : 0);
                      $prsh = (isset($inap["PRSH"][$kode_ruangan_a][$kode_kelas]) ? $inap["PRSH"][$kode_ruangan_a][$kode_kelas] : 0);
                      $bed = $row->bed;
                      if ($kr!=$kode_ruangan_a) {
                        $nama_ruangan = str_replace("ISOLASI", "", $row->nama_ruangan);
                        $i++;
                        $no = $i;
                      } else {
                        $nama_ruangan = $no = "";
                      }
                      echo "<tr class='data' ruangan='".$kode_ruangan_a."'>";
                      if ($nama_ruangan!=""){
                        echo "<td rowspan='".count($value)."'>".$no."</td>";
                        echo "<td rowspan='".count($value)."'>".$nama_ruangan."</td>";
                      }
                      echo "<td>".$row->nama_kelas."</td>";
                      echo "<td class='text-right'>".$row->bed."</td>";
                      // echo "<td class='text-right'></td>";
                      echo "<td class='text-right'>".$dinas_a."</td>";
                      echo "<td class='text-right'>".$dinas_pur."</td>";
                      echo "<td class='text-right'>".$umum."</td>";
                      echo "<td class='text-right'>".$bpjs."</td>";
                      echo "<td class='text-right'>".$prsh."</td>";
                      echo "<td class='text-right'>".($dinas_a+$dinas_pur+$umum+$bpjs+$prsh)."</td>";
                      echo "<td class='text-right'>".(int)$inap["HP"][$kode_ruangan_a][$kode_kelas]."</td>";
                      echo "<td class='text-right'>".($bed>0 ? number_format(($dinas_a+$dinas_pur+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                      echo "</tr>";
                      $kr = $kode_ruangan_a;
                      $jml_dinas_a += $dinas_a;
                      $jml_dinas_pur += $dinas_pur;
                      $jml_umum += $umum;
                      $jml_bpjs += $bpjs;
                      $jml_prsh += $prsh;
                      $jml_bed += $bed;
                      $jml_hp += (isset($inap["HP"][$kode_ruangan_a][$kode_kelas]) ? $inap["HP"][$kode_ruangan_a][$kode_kelas] : 0);
                  }
                }
              }
              ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Jumlah Pasien</th>
                    <th class='text-right'><?php echo $jml_bed;?></th>
                    <th class='text-right'><?php echo $jml_dinas_a;?></th>
                    <th class='text-right'><?php echo $jml_dinas_pur;?></th>
                    <th class='text-right'><?php echo $jml_umum;?></th>
                    <th class='text-right'><?php echo $jml_bpjs;?></th>
                    <th class='text-right'><?php echo $jml_prsh;?></th>
                    <th class='text-right'><?php echo ($jml_dinas_a+$jml_dinas_pur+$jml_umum+$jml_bpjs+$jml_prsh);?></th>
                    <th class='text-right'><?php echo $jml_hp;?></th>
                    <th class='text-right'><?php echo($jml_bed>0 ? number_format(($jml_dinas_a+$jml_dinas_pur+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)?> %</th>
                </tr>
            </tfoot>
        </table>
        <h3>2. Instalasi Rawat Jalan</h3>
          <table border="1" class="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Poliklinik</th>
                    <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                    <th class="text-center" style="vertical-align: middle" colspan="2">Jenis</th>
                    <th class="text-center" style="vertical-align: middle" colspan="5">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Jumlah</th>
                </tr>
                <tr class='bg-navy'>
                    <th style="vertical-align: middle" rowspan="2" class="text-center">Baru</th>
                    <th style="vertical-align: middle" rowspan="2" class="text-center">Lama</th>
                    <th style="vertical-align: middle" rowspan="2" class="text-center">Reguler</th>
                    <th style="vertical-align: middle" rowspan="2" class="text-center">Eksekutif</th>
                    <th style="vertical-align: middle" colspan="2" class="text-center">D</th>
                    <th style="vertical-align: middle" rowspan="2" class="text-center">U</th>
                    <th style="vertical-align: middle" rowspan="2" class="text-center">BPJS</th>
                    <th style="vertical-align: middle" rowspan="2" class="text-center">PRSH</th>
                </tr>
                <tr class='bg-navy'>
                    <th class="text-center">Aktif</th>
                    <th class="text-center">Purn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    $hide = "";
                    $baru_ralan = $lama_ralan = $reguler_ralan = $eks_ralan =$dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan = 0;
                    foreach($t->result() as $data){
                        echo "<tr jml='".$jml."' id='data' ".$hide." tindakan='".$data->kode."' nama_tindakan='".$data->keterangan."'>";
                        echo "<td class='text-right'>".($i++)."</td>";
                        echo "<td>".$data->keterangan."</td>";
                            echo "<td class='text-right'>".(isset($ralan["BARU"][$data->kode]) ? $ralan["BARU"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["LAMA"][$data->kode]) ? $ralan["LAMA"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["REGULER"][$data->kode]) ? $ralan["REGULER"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["EKSEKUTIF"][$data->kode]) ? $ralan["EKSEKUTIF"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["DINAS_A"][$data->kode]) ? $ralan["DINAS_A"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["DINAS_PUR"][$data->kode]) ? $ralan["DINAS_PUR"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["UMUM"][$data->kode]) ? $ralan["UMUM"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["BPJS"][$data->kode]) ? $ralan["BPJS"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($ralan["PRSH"][$data->kode]) ? $ralan["PRSH"][$data->kode] : 0)."</td>";
                        $jumlah_ralan = (isset($ralan["DINAS"][$data->kode]) ? $ralan["DINAS"][$data->kode] : 0)+
                                  (isset($ralan["UMUM"][$data->kode]) ? $ralan["UMUM"][$data->kode] : 0)+
                                  (isset($ralan["BPJS"][$data->kode]) ? $ralan["BPJS"][$data->kode] : 0)+
                                  (isset($ralan["PRSH"][$data->kode]) ? $ralan["PRSH"][$data->kode] : 0);
                        $baru_ralan += (isset($ralan["BARU"][$data->kode]) ? $ralan["BARU"][$data->kode] : 0);
                        $lama_ralan += (isset($ralan["LAMA"][$data->kode]) ? $ralan["LAMA"][$data->kode] : 0);
                        $eks_ralan += (isset($ralan["EKSEKUTIF"][$data->kode]) ? $ralan["EKSEKUTIF"][$data->kode] : 0);
                        $reguler_ralan += (isset($ralan["REGULER"][$data->kode]) ? $ralan["REGULER"][$data->kode] : 0);
                        $dinas_ralan += (isset($ralan["DINAS"][$data->kode]) ? $ralan["DINAS"][$data->kode] : 0);
                        $dinas_a_ralan += (isset($ralan["DINAS_A"][$data->kode]) ? $ralan["DINAS_A"][$data->kode] : 0);
                        $dinas_pur_ralan += (isset($ralan["DINAS_PUR"][$data->kode]) ? $ralan["DINAS_PUR"][$data->kode] : 0);
                        $umum_ralan += (isset($ralan["UMUM"][$data->kode]) ? $ralan["UMUM"][$data->kode] : 0);
                        $bpjs_ralan += (isset($ralan["BPJS"][$data->kode]) ? $ralan["BPJS"][$data->kode] : 0);
                        $prsh_ralan += (isset($ralan["PRSH"][$data->kode]) ? $ralan["PRSH"][$data->kode] : 0);
                        echo "<td class='text-right'>".$jumlah_ralan."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah Pasien</th>
                    <th class="text-right"><?php echo $baru_ralan;?></th>
                    <th class="text-right"><?php echo $lama_ralan;?></th>
                    <th class="text-right"><?php echo $reguler_ralan;?></th>
                    <th class="text-right"><?php echo $eks_ralan;?></th>
                    <th class="text-right"><?php echo $dinas_a_ralan;?></th>
                    <th class="text-right"><?php echo $dinas_pur_ralan;?></th>
                    <th class="text-right"><?php echo $umum_ralan;?></th>
                    <th class="text-right"><?php echo $bpjs_ralan;?></th>
                    <th class="text-right"><?php echo $prsh_ralan;?></th>
                    <th class="text-right"><?php echo ($dinas_a_ralan+$dinas_pur_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                </tr>
            </tfoot>
        </table>
        <h3>3. Instalasi Gadar</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-navy'>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Instalasi Gadar</th>
                    <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                    <th class="text-center" style="vertical-align: middle" colspan="2">Jenis</th>
                    <th class="text-center" style="vertical-align: middle" colspan="5">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Jumlah</th>
                </tr>
                <tr class='bg-navy'>
                    <th rowspan="2" class="text-center">Baru</th>
                    <th rowspan="2" class="text-center">Lama</th>
                    <th rowspan="2" class="text-center">Reguler</th>
                    <th rowspan="2" class="text-center">Eksekutif</th>
                    <th colspan="2" class="text-center">D</th>
                    <th rowspan="2" class="text-center">U</th>
                    <th rowspan="2" class="text-center">BPJS</th>
                    <th rowspan="2" class="text-center">PRSH</th>
                </tr>
                <tr>
                  <th class="text-center">AKTIF</th>
                  <th class="text-center">PURN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $baru = $lama = $reguler = $eksekutif = $dinas_a = $dinas_pur = $umum = $bpjs = $prsh = 0;
                    echo "<tr class='ralan'>";
                    echo "<td class='text-right'>1. </td>";
                    echo "<td>Rawat Jalan</td>";
                    echo "<td class='text-right'>".(isset($poli["BARU"]["0102030"]) ? $poli["BARU"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["LAMA"]["0102030"]) ? $poli["LAMA"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["REGULER"]["0102030"]) ? $poli["REGULER"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["EKSEKUTIF"]["0102030"]) ? $poli["EKSEKUTIF"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["DINAS_A"]["0102030"]) ? $poli["DINAS_A"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["DINAS_PUR"]["0102030"]) ? $poli["DINAS_PUR"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0)."</td>";
                    $jumlah = (isset($poli["DINAS_A"]["0102030"]) ? $poli["DINAS_A"]["0102030"] : 0)+
                              (isset($poli["DINAS_PUR"]["0102030"]) ? $poli["DINAS_PUR"]["0102030"] : 0)+
                              (isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0)+
                              (isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0)+
                              (isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0);
                    $baru += (isset($poli["BARU"]["0102030"]) ? $poli["BARU"]["0102030"] : 0);
                    $lama += (isset($poli["LAMA"]["0102030"]) ? $poli["LAMA"]["0102030"] : 0);
                    $reguler += (isset($poli["REGULER"]["0102030"]) ? $poli["REGULER"]["0102030"] : 0);
                    $eksekutif += (isset($poli["EKSEKUTIF"]["0102030"]) ? $poli["EKSEKUTIF"]["0102030"] : 0);
                    $dinas_a += (isset($poli["DINAS_A"]["0102030"]) ? $poli["DINAS_A"]["0102030"] : 0);
                    $dinas_pur += (isset($poli["DINAS_PUR"]["0102030"]) ? $poli["DINAS_PUR"]["0102030"] : 0);
                    $umum += (isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0);
                    $bpjs += (isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0);
                    $prsh += (isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0);
                    echo "<td class='text-right'>".$jumlah."</td>";
                    echo "</tr>";
                    echo "<tr class='ranap'>";
                    echo "<td class='text-right'>2.</td>";
                    echo "<td>Rawat Inap</td>";
                    echo "<td class='text-right'>".(isset($igd["BARU"]) ? $igd["BARU"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["LAMA"]) ? $igd["LAMA"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["REGULER"]) ? $igd["REGULER"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["EKSEKUTIF"]) ? $igd["EKSEKUTIF"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["DINAS_A"]) ? $igd["DINAS_A"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["DINAS_PUR"]) ? $igd["DINAS_PUR"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["UMUM"]) ? $igd["UMUM"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["BPJS"]) ? $igd["BPJS"] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($igd["PRSH"]) ? $igd["PRSH"] : 0)."</td>";
                    $jumlah = (isset($igd["DINAS_A"]) ? $igd["DINAS_A"] : 0)+
                              (isset($igd["DINAS_PUR"]) ? $igd["DINAS_PUR"] : 0)+
                              (isset($igd["UMUM"]) ? $igd["UMUM"] : 0)+
                              (isset($igd["BPJS"]) ? $igd["BPJS"] : 0)+
                              (isset($igd["PRSH"]) ? $igd["PRSH"] : 0);
                    $baru += (isset($igd["BARU"]) ? $igd["BARU"] : 0);
                    $lama += (isset($igd["LAMA"]) ? $igd["LAMA"] : 0);
                    $reguler += (isset($igd["REGULER"]) ? $igd["REGULER"] : 0);
                    $eksekutif += (isset($igd["EKSEKUTIF"]) ? $igd["EKSEKUTIF"] : 0);
                    $dinas_a += (isset($igd["DINAS_A"]) ? $igd["DINAS_A"] : 0);
                    $dinas_pur += (isset($igd["DINAS_PUR"]) ? $igd["DINAS_PUR"] : 0);
                    $umum += (isset($igd["UMUM"]) ? $igd["UMUM"] : 0);
                    $bpjs += (isset($igd["BPJS"]) ? $igd["BPJS"] : 0);
                    $prsh += (isset($igd["PRSH"]) ? $igd["PRSH"] : 0);
                    echo "<td class='text-right'>".$jumlah."</td>";
                    echo "</tr>";
                ?>
            </tbody>
            <tfoot>
                <tr class='bg-navy'>
                    <th colspan="2">Jumlah Pasien</th>
                    <th class="text-right"><?php echo $baru;?></th>
                    <th class="text-right"><?php echo $lama;?></th>
                    <th class="text-right"><?php echo $reguler;?></th>
                    <th class="text-right"><?php echo $eksekutif;?></th>
                    <th class="text-right"><?php echo $dinas_a;?></th>
                    <th class="text-right"><?php echo $dinas_pur;?></th>
                    <th class="text-right"><?php echo $umum;?></th>
                    <th class="text-right"><?php echo $bpjs;?></th>
                    <th class="text-right"><?php echo $prsh;?></th>
                    <th class="text-right"><?php echo ($dinas_a+$dinas_pur+$umum+$bpjs+$prsh);?></th>
                </tr>
            </tfoot>
        </table>
        <h3>4. Instalasi Kamar Bedah</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-navy'>
                    <!-- <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th> -->
                    <!-- <th class="text-center" style="vertical-align: middle" rowspan="3">Tindakan</th> -->
                    <th class="text-center" style="vertical-align: middle" colspan="6">Rawat Jalan</th>
                    <th class="text-center" style="vertical-align: middle" colspan="6">Rawat inap</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="4">Total</th>
                </tr>
                <tr class='bg-navy'>

                    <!-- <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th> -->
                    <!-- <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th> -->
                    <th class="text-center" style="vertical-align: middle" colspan="5">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Jumlah</th>
                    <!-- <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th> -->
                    <!-- <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th> -->
                    <th class="text-center" style="vertical-align: middle" colspan="5">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Jumlah</th>
                </tr>
                <tr class='bg-navy'>
                    <!-- <th class="text-center">DR</th>
                    <th class="text-center">MANUAL</th> -->
                    <th colspan="2" class="text-center">D</th>
                    <th rowspan="2" class="text-center">U</th>
                    <th rowspan="2" class="text-center">BPJS</th>
                    <th rowspan="2" class="text-center">PRSH</th>
                    <!-- <th class="text-center">DR</th>
                    <th class="text-center">MANUAL</th> -->
                    <th colspan="2" class="text-center">D</th>
                    <th rowspan="2" class="text-center">U</th>
                    <th rowspan="2" class="text-center">BPJS</th>
                    <th rowspan="2" class="text-center">PRSH</th>
                </tr>
                <tr>
                  <th class="text-center">AKTIF</th>
                  <th class="text-center">PURN</th>
                  <th class="text-center">AKTIF</th>
                  <th class="text-center">PURN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    $hide = "";
                    $eks_ralan = $dr_ralan = $manual_ralan = $dinas_a_ralan = $dinas_pur_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                    $eks_inap = $dr_inap = $manual_inap = $dinas_a_inap = $dinas_pur_inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
                    foreach($to["kode"] as $data){
                        $jml = isset($p["tindakan"][$data->kode]) ? $p["tindakan"][$data->kode] : 0;
                        $jml_inap = isset($p_inap["tindakan"][$data->kode]) ? $p_inap["tindakan"][$data->kode] : 0;
                        // echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode."' nama_tindakan='".$data->nama_tindakan."'>";
                        // echo "<td class='text-right'>".($i++)."</td>";
                        // echo "<td>".$data->nama_tindakan."</td>";
                        // echo "<td class='text-right'>".(isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)."</td>";
                        // echo "<td class='text-right'>".(isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)."</td>";
                        // echo "<td class='text-right'>".(isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)."</td>";
                        // echo "<td class='text-right'>".(isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0)."</td>";
                        $jumlah_ralan = (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)+
                                  (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)+
                                  (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)+
                                  (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                        $dinas_a_ralan += (isset($p["DINAS_A"][$data->kode]) ? $p["DINAS_A"][$data->kode] : 0);
                        $dinas_pur_ralan += (isset($p["DINAS_PUR"][$data->kode]) ? $p["DINAS_PUR"][$data->kode] : 0);
                        $umum_ralan += (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0);
                        $bpjs_ralan += (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0);
                        $prsh_ralan += (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                        // echo "<td class='text-right'>".$jumlah_ralan."</td>";
                        // echo "<td class='text-right'>".(isset($p_inap["DINAS"][$data->kode]) ? $p_inap["DINAS"][$data->kode] : 0)."</td>";
                        // echo "<td class='text-right'>".(isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0)."</td>";
                        // echo "<td class='text-right'>".(isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0)."</td>";
                        // echo "<td class='text-right'>".(isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0)."</td>";
                        $jumlah_inap = (isset($p_inap["DINAS"][$data->kode]) ? $p_inap["DINAS"][$data->kode] : 0)+
                                  (isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0)+
                                  (isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0)+
                                  (isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0);
                        $dinas_a_inap += (isset($p_inap["DINAS_A"][$data->kode]) ? $p_inap["DINAS_A"][$data->kode] : 0);
                        $dinas_pur_inap += (isset($p_inap["DINAS_PUR"][$data->kode]) ? $p_inap["DINAS_PUR"][$data->kode] : 0);
                        $umum_inap += (isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0);
                        $bpjs_inap += (isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0);
                        $prsh_inap += (isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0);
                        // echo "<td class='text-right'>".$jumlah_inap."</td>";
                        // echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                        // echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class='bg-navy'>
                    <!-- <th colspan="2">Jumlah Pasien</th> -->
                    <th class="text-right"><?php echo $dinas_a_ralan;?></th>
                    <th class="text-right"><?php echo $dinas_pur_ralan;?></th>
                    <th class="text-right"><?php echo $umum_ralan;?></th>
                    <th class="text-right"><?php echo $bpjs_ralan;?></th>
                    <th class="text-right"><?php echo $prsh_ralan;?></th>
                    <th class="text-right"><?php echo ($dinas_a_ralan+$dinas_pur_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                    <th class="text-right"><?php echo $dinas_a_inap;?></th>
                    <th class="text-right"><?php echo $dinas_pur_inap;?></th>
                    <th class="text-right"><?php echo $umum_inap;?></th>
                    <th class="text-right"><?php echo $bpjs_inap;?></th>
                    <th class="text-right"><?php echo $prsh_inap;?></th>
                    <th class="text-right"><?php echo ($dinas_a_inap+$dinas_pur_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                    <th class="text-right"><?php echo ($dinas_a_ralan+$dinas_pur_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan+$dinas_a_inap+$dinas_pur_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                </tr>
            </tfoot>
        </table>
        <h3>5. Instalasi Haemodialisa</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-navy'>
                    <th class="text-center" style="vertical-align: middle" rowspan="4">No.</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="4">Tindakan</th>
                    <th class="text-center" style="vertical-align: middle" colspan="8">Rawat Jalan</th>
                    <th class="text-center" style="vertical-align: middle" colspan="6">Rawat inap</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="4">Total</th>
                </tr>
                <tr class='bg-navy'>

                    <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                    <th class="text-center" style="vertical-align: middle" colspan="5">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Jumlah</th>
                    <th class="text-center" style="vertical-align: middle" colspan="5">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="3">Jumlah</th>
                </tr>
                <tr class='bg-navy'>
                    <th rowspan="2" class="text-center">BARU</th>
                    <th rowspan="2" class="text-center">LAMA</th>
                    <th colspan="2" class="text-center">D</th>
                    <th rowspan="2" class="text-center">U</th>
                    <th rowspan="2" class="text-center">BPJS</th>
                    <th rowspan="2" class="text-center">PRSH</th>
                    <th colspan="2" class="text-center">D</th>
                    <th rowspan="2" class="text-center">U</th>
                    <th rowspan="2" class="text-center">BPJS</th>
                    <th rowspan="2" class="text-center">PRSH</th>
                </tr>
                <tr>
                  <th class="text-center">AKTIF</th>
                  <th class="text-center">PURN</th>
                  <th class="text-center">AKTIF</th>
                  <th class="text-center">PURN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    $hide = "";
                    $baru_ralan = $lama_ralan = $dr_ralan = $manual_ralan = $dinas_a_ralan = $dinas_pur_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                    $dr_inap = $manual_inap = $dinas_a_inap = $dinas_pur_inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
                    foreach($th->result() as $data){
                        $jml = isset($ph["tindakan"]["0102026"]) ? $ph["tindakan"]["0102026"] : 0;
                        $jml_inap = isset($ph_inap["tindakan"][$data->kode_tindakan]) ? $ph_inap["tindakan"][$data->kode_tindakan] : 0;
                        echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                        echo "<td class='text-right'>".($i++)."</td>";
                        echo "<td>".$data->nama_tindakan."</td>";
                        //ralan
                        echo "<td class='text-right'>".(isset($ph["BARU"]["0102026"]) ? $ph["BARU"]["0102026"] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph["LAMA"]["0102026"]) ? $ph["LAMA"]["0102026"] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph["DINAS_A"]["0102026"]) ? $ph["DINAS_A"]["0102026"] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph["DINAS_PUR"]["0102026"]) ? $ph["DINAS_PUR"]["0102026"] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph["UMUM"]["0102026"]) ? $ph["UMUM"]["0102026"] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph["BPJS"]["0102026"]) ? $ph["BPJS"]["0102026"] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph["PRSH"]["0102026"]) ? $ph["PRSH"]["0102026"] : 0)."</td>";
                        $jumlah_ralan = (isset($ph["DINAS"]["0102026"]) ? $ph["DINAS"]["0102026"] : 0)+
                                  (isset($ph["UMUM"]["0102026"]) ? $ph["UMUM"]["0102026"] : 0)+
                                  (isset($ph["BPJS"]["0102026"]) ? $ph["BPJS"]["0102026"] : 0)+
                                  (isset($ph["PRSH"]["0102026"]) ? $ph["PRSH"]["0102026"] : 0);
                        $baru_ralan += (isset($ph["BARU"]["0102026"]) ? $ph["BARU"]["0102026"] : 0);
                        $lama_ralan += (isset($ph["LAMA"]["0102026"]) ? $ph["LAMA"]["0102026"] : 0);
                        $dinas_a_ralan += (isset($ph["DINAS_A"]["0102026"]) ? $ph["DINAS_A"]["0102026"] : 0);
                        $dinas_pur_ralan += (isset($ph["DINAS_PUR"]["0102026"]) ? $ph["DINAS_PUR"]["0102026"] : 0);
                        $umum_ralan += (isset($ph["UMUM"]["0102026"]) ? $ph["UMUM"]["0102026"] : 0);
                        $bpjs_ralan += (isset($ph["BPJS"]["0102026"]) ? $ph["BPJS"]["0102026"] : 0);
                        $prsh_ralan += (isset($ph["PRSH"]["0102026"]) ? $ph["PRSH"]["0102026"] : 0);
                        echo "<td class='text-right'>".$jumlah_ralan."</td>";
                        //inap
                        // echo "<td class='text-right'>".(isset($ph_inap["DR"][$data->kode_tindakan]) ? $ph_inap["DR"][$data->kode_tindakan] : 0)."</td>";
                        // echo "<td class='text-right'>".(isset($ph_inap["MANUAL"][$data->kode_tindakan]) ? $ph_inap["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph_inap["DINAS_A"][$data->kode_tindakan]) ? $ph_inap["DINAS_A"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph_inap["DINAS_PUR"][$data->kode_tindakan]) ? $ph_inap["DINAS_PUR"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph_inap["UMUM"][$data->kode_tindakan]) ? $ph_inap["UMUM"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph_inap["BPJS"][$data->kode_tindakan]) ? $ph_inap["BPJS"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($ph_inap["PRSH"][$data->kode_tindakan]) ? $ph_inap["PRSH"][$data->kode_tindakan] : 0)."</td>";
                        $jumlah_inap = (isset($ph_inap["DINAS"][$data->kode_tindakan]) ? $ph_inap["DINAS"][$data->kode_tindakan] : 0)+
                                  (isset($ph_inap["UMUM"][$data->kode_tindakan]) ? $ph_inap["UMUM"][$data->kode_tindakan] : 0)+
                                  (isset($ph_inap["BPJS"][$data->kode_tindakan]) ? $ph_inap["BPJS"][$data->kode_tindakan] : 0)+
                                  (isset($ph_inap["PRSH"][$data->kode_tindakan]) ? $ph_inap["PRSH"][$data->kode_tindakan] : 0);
                        // $dr_inap += (isset($ph_inap["DR"][$data->kode_tindakan]) ? $ph_inap["DR"][$data->kode_tindakan] : 0);
                        // $manual_inap += (isset($ph_inap["MANUAL"][$data->kode_tindakan]) ? $ph_inap["MANUAL"][$data->kode_tindakan] : 0);
                        $dinas_a_inap += (isset($ph_inap["DINAS_A"][$data->kode_tindakan]) ? $ph_inap["DINAS_A"][$data->kode_tindakan] : 0);
                        $dinas_pur_inap += (isset($ph_inap["DINAS_PUR"][$data->kode_tindakan]) ? $ph_inap["DINAS_PUR"][$data->kode_tindakan] : 0);
                        $umum_inap += (isset($ph_inap["UMUM"][$data->kode_tindakan]) ? $ph_inap["UMUM"][$data->kode_tindakan] : 0);
                        $bpjs_inap += (isset($ph_inap["BPJS"][$data->kode_tindakan]) ? $ph_inap["BPJS"][$data->kode_tindakan] : 0);
                        $prsh_inap += (isset($ph_inap["PRSH"][$data->kode_tindakan]) ? $ph_inap["PRSH"][$data->kode_tindakan] : 0);
                        echo "<td class='text-right'>".$jumlah_inap."</td>";
                        echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class='bg-navy'>
                    <th colspan="2">Jumlah Pasien</th>
                    <th class="text-right"><?php echo $baru_ralan;?></th>
                    <th class="text-right"><?php echo $lama_ralan;?></th>
                    <th class="text-right"><?php echo $dinas_a_ralan;?></th>
                    <th class="text-right"><?php echo $dinas_pur_ralan;?></th>
                    <th class="text-right"><?php echo $umum_ralan;?></th>
                    <th class="text-right"><?php echo $bpjs_ralan;?></th>
                    <th class="text-right"><?php echo $prsh_ralan;?></th>
                    <th class="text-right"><?php echo ($dinas_a_ralan+$dinas_pur_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                    <th class="text-right"><?php echo $dinas_a_inap;?></th>
                    <th class="text-right"><?php echo $dinas_pur_inap;?></th>
                    <th class="text-right"><?php echo $umum_inap;?></th>
                    <th class="text-right"><?php echo $bpjs_inap;?></th>
                    <th class="text-right"><?php echo $prsh_inap;?></th>
                    <th class="text-right"><?php echo ($dinas_a_inap+$dinas_pur_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                    <th class="text-right"><?php echo ($dinas_a_ralan+$dinas_pur_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan+$dinas_a_inap+$dinas_pur_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                </tr>
            </tfoot>
        </table>
        <h3>6. Laporan Pasien Pulang</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-green'>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Ruangan</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">TT</th>
                    <th class="text-center" style="vertical-align: middle" colspan="4">Pulang Sehat</th>
                    <th class="text-center" style="vertical-align: middle" colspan="4">Pulang Paksa</th>
                    <th class="text-center" style="vertical-align: middle" colspan="4">Rujuk RS Lain</th>
                    <th class="text-center" style="vertical-align: middle" colspan="4">Meninggal</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">HP</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                </tr>
                <tr class='bg-green'>
                    <th class="text-center">D</th>
                    <th class="text-center">U</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PRSH</th>
                    <th class="text-center">D</th>
                    <th class="text-center">U</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PRSH</th>
                    <th class="text-center">D</th>
                    <th class="text-center">U</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PRSH</th>
                    <th class="text-center">D</th>
                    <th class="text-center">U</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PRSH</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $dinas = array();
                    $umum = array();
                    $bpjs = array();
                    $prsh = array();
                    $status = array();
                    $total = 0;
                    $jumlah = 0;
                    $jml_hp = 0;
                    foreach($rg->result() as $data){
                        if ($data->kode_ruangan!=19){
                            echo "<tr class='data2' ruangan='".$data->kode_ruangan_a."'>";
                            echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
                            echo "<td class='text-right'>".$data->bed."</td>";
                            echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][1]) ? $inap2["DINAS"][$data->kode_ruangan_a][1] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][1]) ? $inap2["UMUM"][$data->kode_ruangan_a][1] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][1]) ? $inap2["BPJS"][$data->kode_ruangan_a][1] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][1]) ? $inap2["PRSH"][$data->kode_ruangan_a][1] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][2]) ? $inap2["DINAS"][$data->kode_ruangan_a][2] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][2]) ? $inap2["UMUM"][$data->kode_ruangan_a][2] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][2]) ? $inap2["BPJS"][$data->kode_ruangan_a][2] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][2]) ? $inap2["PRSH"][$data->kode_ruangan_a][2] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][3]) ? $inap2["DINAS"][$data->kode_ruangan_a][3] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][3]) ? $inap2["UMUM"][$data->kode_ruangan_a][3] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][3]) ? $inap2["BPJS"][$data->kode_ruangan_a][3] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][3]) ? $inap2["PRSH"][$data->kode_ruangan_a][3] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][4]) ? $inap2["DINAS"][$data->kode_ruangan_a][4] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][4]) ? $inap2["UMUM"][$data->kode_ruangan_a][4] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][4]) ? $inap2["BPJS"][$data->kode_ruangan_a][4] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][4]) ? $inap2["PRSH"][$data->kode_ruangan_a][4] : 0)."</td>";
                            $jumlah = (isset($inap2["DINAS"][$data->kode_ruangan_a][1]) ? $inap2["DINAS"][$data->kode_ruangan_a][1] : 0)
                                      +(isset($inap2["UMUM"][$data->kode_ruangan_a][1]) ? $inap2["UMUM"][$data->kode_ruangan_a][1] : 0)
                                      +(isset($inap2["BPJS"][$data->kode_ruangan_a][1]) ? $inap2["BPJS"][$data->kode_ruangan_a][1] : 0)
                                      +(isset($inap2["PRSH"][$data->kode_ruangan_a][1]) ? $inap2["PRSH"][$data->kode_ruangan_a][1] : 0)
                                      +(isset($inap2["DINAS"][$data->kode_ruangan_a][2]) ? $inap2["DINAS"][$data->kode_ruangan_a][2] : 0)
                                      +(isset($inap2["UMUM"][$data->kode_ruangan_a][2]) ? $inap2["UMUM"][$data->kode_ruangan_a][2] : 0)
                                      +(isset($inap2["BPJS"][$data->kode_ruangan_a][2]) ? $inap2["BPJS"][$data->kode_ruangan_a][2] : 0)
                                      +(isset($inap2["PRSH"][$data->kode_ruangan_a][2]) ? $inap2["PRSH"][$data->kode_ruangan_a][2] : 0)
                                      +(isset($inap2["DINAS"][$data->kode_ruangan_a][3]) ? $inap2["DINAS"][$data->kode_ruangan_a][3] : 0)
                                      +(isset($inap2["UMUM"][$data->kode_ruangan_a][3]) ? $inap2["UMUM"][$data->kode_ruangan_a][3] : 0)
                                      +(isset($inap2["BPJS"][$data->kode_ruangan_a][3]) ? $inap2["BPJS"][$data->kode_ruangan_a][3] : 0)
                                      +(isset($inap2["PRSH"][$data->kode_ruangan_a][3]) ? $inap2["PRSH"][$data->kode_ruangan_a][3] : 0)
                                      +(isset($inap2["DINAS"][$data->kode_ruangan_a][4]) ? $inap2["DINAS"][$data->kode_ruangan_a][4] : 0)
                                      +(isset($inap2["UMUM"][$data->kode_ruangan_a][4]) ? $inap2["UMUM"][$data->kode_ruangan_a][4] : 0)
                                      +(isset($inap2["BPJS"][$data->kode_ruangan_a][4]) ? $inap2["BPJS"][$data->kode_ruangan_a][4] : 0)
                                      +(isset($inap2["PRSH"][$data->kode_ruangan_a][4]) ? $inap2["PRSH"][$data->kode_ruangan_a][4] : 0);
                            echo "<td class='text-right'>".(int)$inap2["HP"][$data->kode_ruangan_a]."</td>";
                            echo "<td class='text-right'>".$jumlah."</td>";
                            echo "</tr>";
                            $total += $data->bed;
                            for($i=1;$i<=4;$i++){
                                if (isset($dinas[$i]))
                                    $dinas[$i] += (isset($inap2["DINAS"][$data->kode_ruangan_a][$i]) ? $inap2["DINAS"][$data->kode_ruangan_a][$i] : 0);
                                else
                                    $dinas[$i] = (isset($inap2["DINAS"][$data->kode_ruangan_a][$i]) ? $inap2["DINAS"][$data->kode_ruangan_a][$i] : 0);
                                if (isset($umum[$i]))
                                    $umum[$i] += (isset($inap2["UMUM"][$data->kode_ruangan_a][$i]) ? $inap2["UMUM"][$data->kode_ruangan_a][$i] : 0);
                                else
                                    $umum[$i] = (isset($inap2["UMUM"][$data->kode_ruangan_a][$i]) ? $inap2["UMUM"][$data->kode_ruangan_a][$i] : 0);
                                if (isset($bpjs[$i]))
                                    $bpjs[$i] += (isset($inap2["BPJS"][$data->kode_ruangan_a][$i]) ? $inap2["BPJS"][$data->kode_ruangan_a][$i] : 0);
                                else
                                    $bpjs[$i] = (isset($inap2["BPJS"][$data->kode_ruangan_a][$i]) ? $inap2["BPJS"][$data->kode_ruangan_a][$i] : 0);
                                if (isset($prsh[$i]))
                                    $prsh[$i] += (isset($inap2["PRSH"][$data->kode_ruangan_a][$i]) ? $inap2["PRSH"][$data->kode_ruangan_a][$i] : 0);
                                else
                                    $prsh[$i] = (isset($inap2["PRSH"][$data->kode_ruangan_a][$i]) ? $inap2["PRSH"][$data->kode_ruangan_a][$i] : 0);
                            }
                            $jml_hp += (isset($inap2["HP"][$data->kode_ruangan_a]) ? $inap2["HP"][$data->kode_ruangan_a] : 0);
                        }
                    }
                    echo "<tr class='bg-green'>";
                            echo "<th>Jumlah</th>";
                            echo "<th class='text-right'>".$total."</th>";
                            echo "<th class='text-right'>".(isset($dinas[1]) ? $dinas[1] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($umum[1]) ? $umum[1] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($bpjs[1]) ? $bpjs[1] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($prsh[1]) ? $prsh[1] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($dinas[2]) ? $dinas[2] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($umum[2]) ? $umum[2] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($bpjs[2]) ? $bpjs[2] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($prsh[2]) ? $prsh[2] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($dinas[3]) ? $dinas[3] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($umum[3]) ? $umum[3] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($bpjs[3]) ? $bpjs[3] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($prsh[3]) ? $prsh[3] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($dinas[4]) ? $dinas[4] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($umum[4]) ? $umum[4] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($bpjs[4]) ? $bpjs[4] : 0)."</th>";
                            echo "<th class='text-right'>".(isset($prsh[4]) ? $prsh[4] : 0)."</th>";
                            $jumlah = (isset($dinas[1]) ? $dinas[1] : 0)+
                                      (isset($umum[1]) ? $umum[1] : 0)+
                                      (isset($bpjs[1]) ? $bpjs[1] : 0)+
                                      (isset($prsh[1]) ? $prsh[1] : 0)+
                                      (isset($dinas[2]) ? $dinas[2] : 0)+
                                      (isset($umum[2]) ? $umum[2] : 0)+
                                      (isset($bpjs[2]) ? $bpjs[2] : 0)+
                                      (isset($prsh[2]) ? $prsh[2] : 0)+
                                      (isset($dinas[3]) ? $dinas[3] : 0)+
                                      (isset($umum[3]) ? $umum[3] : 0)+
                                      (isset($bpjs[3]) ? $bpjs[3] : 0)+
                                      (isset($prsh[3]) ? $prsh[3] : 0)+
                                      (isset($dinas[4]) ? $dinas[4] : 0)+
                                      (isset($umum[4]) ? $umum[4] : 0)+
                                      (isset($bpjs[4]) ? $bpjs[4] : 0)+
                                      (isset($prsh[4]) ? $prsh[4] : 0);
                            echo "<th class='text-right'>".$jml_hp."</th>";
                            echo "<th class='text-right'>".$jumlah."</th>";
                            echo "</tr>";
                ?>
            </tbody>
        </table>
        <h3>7. Anggota Keluarga Denkes dan Rumkit Yang Dirawat</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-orange'>
                    <th class="text-center">No</th>
                    <th class="text-center">Ruang</th>
                    <th class="text-center">Kamar</th>
                    <th class="text-center">RM</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">JK</th>
                    <th class="text-center">Umur</th>
                    <th class="text-center">Hubungan Keluarga</th>
                    <th class="text-center">Pangkat</th>
                    <th class="text-center">Kesatuan</th>
                    <th class="text-center">Diagnosa Medis</th>
                    <th class="text-center">Dokter</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach($inap_denkes['list'] as $key){
                            echo "<tr>";
                            $kamar = ($inap_denkes["kamar"][$key->no_reg]);
                            $pangkat = ($inap_denkes["pangkat"][$key->no_reg]);
                            $diagnosa_medis = ($inap_denkes["diagnosa_medis"][$key->no_reg]);
                            $diagnosa_medis_2 = ($inap_denkes["diagnosa_medis_2"][$key->no_reg]);
                            $id_dokter = ($inap_denkes["id_dokter"][$key->no_reg]);
                            echo "<td class='text-center'>".$no++."</td>";
                            echo "<td >".str_replace("ISOLASI", "", $key->ruangan)."</td>";
                            echo "<td class='text-center'>".$kamar->nama_kamar." ".$kamar->no_bed."</td>";
                            echo "<td class='text-center'>".$key->no_rm."</td>";
                            echo "<td >".$key->nama_pasien."</td>";
                            echo "<td class='text-center'>".$key->jenis_kelamin."</td>";
                            echo "<td class='text-center'>".(date("Y") - date("Y",strtotime($key->tahun)))."th"."</td>";
                            echo "<td class='text-center'>".($key->hubungan_keluarga == "1" ? "PS" : "").($key->hubungan_keluarga == "2" ? "AD Ayah ".$key->nama_pasangan." Ibu ".$key->ibu : "").($key->hubungan_keluarga == "3" ?"S/I D ".($key->nama_pasangan!="" || $key->nama_pasangan!=null ? $key->nama_pasangan : $key->ibu) : "")."</td>";
                            echo "<td class='text-center'>".$pangkat->keterangan." ".$key->nip."</td>";
                            echo "<td class='text-left'>".substr($key->alamat,0,25)."</td>";
                            echo "<td class='text-center'>".($diagnosa_medis_2->diagnosa_akhir == ""? $diagnosa_medis->a : $diagnosa_medis_2->diagnosa_akhir)."</td>";
                            if ($key->masuk == "IGD" || $key->masuk == "UGD") {
                                echo "<td >". $id_dokter->nama_dokter."</td>";
                            } else {
                                echo "<td >".$key->nama_dokter."</td>";
                            }
                            echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <h3>8. Laporan Penderita Dinas/ Keluarga TNI Lain Yang Di Rawat</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-orange'>
                    <th class="text-center">No</th>
                    <th class="text-center">Ruang</th>
                    <th class="text-center">Kamar</th>
                    <th class="text-center">RM</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">JK</th>
                    <th class="text-center">Umur</th>
                    <th class="text-center">Hubungan Keluarga</th>
                    <th class="text-center">Pangkat</th>
                    <th class="text-center">Kesatuan</th>
                    <th class="text-center">Diagnosa Medis</th>
                    <th class="text-center">Dokter</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    // $dinas = $umum = $bpjs = $prsh = 0;
                    // $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = $jlm_hp = 0;
                    $no = 1;
                    foreach($inap_nondenkes['list'] as $key){
                            // $bed = $key->bed;
                            // $dinas = (isset($inap_kelas["DINAS"][$key->kode_kelas_dashboard]) ? $inap_kelas["DINAS"][$key->kode_kelas_dashboard] : 0);
                            // $umum = (isset($inap_kelas["UMUM"][$key->kode_kelas_dashboard]) ? $inap_kelas["UMUM"][$key->kode_kelas_dashboard] : 0);
                            // $bpjs = (isset($inap_kelas["BPJS"][$key->kode_kelas_dashboard]) ? $inap_kelas["BPJS"][$key->kode_kelas_dashboard] : 0);
                            // $prsh = (isset($inap_kelas["PRSH"][$key->kode_kelas_dashboard]) ? $inap_kelas["PRSH"][$key->kode_kelas_dashboard] : 0);
                            if (!isset($inap_denkes['list'][$key->no_reg])){
                              echo "<tr>";
                              $kamar = ($inap_nondenkes["kamar"][$key->no_reg]);
                              $pangkat = ($inap_nondenkes["pangkat"][$key->no_reg]);
                              $diagnosa_medis = ($inap_nondenkes["diagnosa_medis"][$key->no_reg]);
                              $diagnosa_medis_2 = ($inap_nondenkes["diagnosa_medis_2"][$key->no_reg]);
                              $id_dokter = ($inap_nondenkes["id_dokter"][$key->no_reg]);
                              echo "<td class='text-center'>".$no++."</td>";
                              echo "<td >".str_replace("ISOLASI", "", $key->ruangan)."</td>";
                              echo "<td class='text-center'>".$kamar->nama_kamar." ".$kamar->no_bed."</td>";
                              echo "<td class='text-center'>".$key->no_rm."</td>";
                              echo "<td >".$key->nama_pasien."</td>";
                              echo "<td class='text-center'>".$key->jenis_kelamin."</td>";
                              echo "<td class='text-center'>".(date("Y") - date("Y",strtotime($key->tahun)))."th"."</td>";
                              echo "<td class='text-center'>".($key->hubungan_keluarga == "1" ? "PS" : "").($key->hubungan_keluarga == "2" ? "AD Ayah ".$key->nama_pasangan." Ibu ".$key->ibu : "").($key->hubungan_keluarga == "3" ?"S/I D ".$key->nama_pasangan : "")."</td>";

                              echo "<td class='text-center'>".$pangkat->keterangan." ".$key->nip."</td>";
                              echo "<td class='text-left'>".substr($key->alamat,0,25)."</td>";
                              echo "<td class='text-center'>".($diagnosa_medis->a == ""? $diagnosa_medis_2->diagnosa_akhir : $diagnosa_medis->a)."</td>";
                              if ($key->masuk == "IGD" || $key->masuk == "UGD") {
                                  echo "<td >". $id_dokter->nama_dokter."</td>";
                              }else{
                                  echo "<td >".$key->nama_dokter."</td>";
                              }
                              echo "</tr>";
                          }
                    }
                ?>
            </tbody>
        </table>
        <h3>9. Laporan Pasien Rawat Lama</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-maroon'>
                    <th class="text-center">No</th>
                    <th class="text-center" width="100px">Tgl Masuk</th>
                    <th class="text-center" width="125px">Ruangan</th>
                    <th class="text-center" width="100px">No. RM</th>
                    <th class="text-center" width="250px">Nama Pasien</th>
                    <th class="text-center">Diagnosa</th>
                    <th class="text-center" width="200px">Dokter DPJP</th>
                    <th class="text-center" width="70px">HP</th>
                    <th class="text-center">Koding</th>
                    <th class="text-center">Billing</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach($inaplama['list'] as $key){
                      $t1 = new DateTime('today');
                      $t2 = new DateTime($key->tgl_masuk);
                      $hp = $t1->diff($t2)->d;
                      if (!$key->covid){
                        if (($hp+1)>=6){
                          echo "<tr>";
                          $diagnosa_medis = ($inaplama["diagnosa_medis"][$key->no_reg]);
                          $diagnosa_medis_2 = ($inaplama["diagnosa_medis_2"][$key->no_reg]);
                          $id_dokter = ($inaplama["id_dokter"][$key->no_reg]);
                          echo "<td class='text-center'>".$no++."</td>";
                          echo "<td class='text-center'>".date("d-m-Y",strtotime($key->tgl_masuk))."</td>";
                          echo "<td >".$key->ruangan."</td>";
                          echo "<td class='text-center'>".$key->no_rm."</td>";
                          echo "<td >".$key->nama_pasien."</td>";
                          echo "<td>".($diagnosa_medis->a == ""? $diagnosa_medis_2->diagnosa_akhir : $diagnosa_medis->a)."</td>";
                          if ($key->masuk == "IGD" || $key->masuk == "UGD") {
                              echo "<td >". $id_dokter->nama_dokter."</td>";
                          }else{
                              echo "<td >".$key->nama_dokter."</td>";
                          }
                          echo "<td class='text-center'>".($hp+1)." hari</td>";
                          echo "<td class='text-right'>".number_format($inaplama["simulasi"][$key->no_reg]->koding,0,',','.')."</td>";
                          echo "<td class='text-right'>".number_format($inaplama["simulasi"][$key->no_reg]->billing,0,',','.')."</td>";
                        }
                      }
                    }
                ?>
            </tbody>
        </table>
        <h3>10. Laporan Pasien Meninggal</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-orange'>
                    <th class="text-center">No</th>
                    <th class="text-center">Ruang</th>
                    <th class="text-center">RM</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">DX</th>
                    <th class="text-center">DPJP</th>
                    <th class="text-center" width="100px">Tgl Masuk</th>
                    <th class="text-center" width=150px>Tgl/Jam Meninggal</th>
                    <th class="text-center">Alamat/Kesatuan</th>
                    <th class="text-center">Ket</th>
                </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                foreach ($m["list"] as $no_rm => $value) {
                  foreach ($value as $no_reg => $row) {
                    echo "<tr>";
                    echo "<td>".($i++)."</td>";
                    echo "<td>".$m["ruangan"][$no_rm][$no_reg]."</td>";
                    echo "<td>".$no_rm."</td>";
                    echo "<td>".$m["master"][$no_rm][$no_reg]->nama_pasien."</td>";
                    echo "<td>".$m["dx"][$no_rm][$no_reg]."</td>";
                    echo "<td>".$m["dpjp"][$no_rm][$no_reg]."</td>";
                    echo "<td class='text-center'>".date("d-m-Y",strtotime($row->tgl_masuk))."</td>";
                    echo "<td class='text-center'>".date("d-m-Y H:i",strtotime($row->tgl_keluar))."</td>";
                    echo "<td>".$m["master"][$no_rm][$no_reg]->alamat."</td>";
                    echo "<td></td>";
                    echo "</tr>";
                  }
                }
                if (count($m["list"])<=0){
                  echo "<tr><td colspan='11'>NIHIL</td></tr>";
                }
              ?>
            </tbody>
          </table>
        <h3>11. Laporan Pasien Rujuk</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr class='bg-orange'>
                    <th class="text-center">No</th>
                    <th class="text-center">Ruang</th>
                    <th class="text-center">RM</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">DX</th>
                    <th class="text-center">DPJP</th>
                    <th class="text-center">Tgl Masuk</th>
                    <th class="text-center">Tgl/Jam Berangkat</th>
                    <th class="text-center">Alamat/Kesatuan</th>
                    <th class="text-center">RS Tujuan</th>
                    <th class="text-center">Ket</th>
                </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                foreach ($prujuk["list"] as $no_rm => $value) {
                  foreach ($value as $no_reg => $row) {
                    echo "<tr>";
                    echo "<td>".($i++)."</td>";
                    echo "<td>".$prujuk["ruangan"][$no_rm][$no_reg]."</td>";
                    echo "<td>".$no_rm."</td>";
                    echo "<td>".$row->nama_pasien."</td>";
                    echo "<td>".$prujuk["br"][$no_rm][$no_reg]->diagnosa."</td>";
                    echo "<td>".$prujuk["dpjp"][$no_rm][$no_reg]."</td>";
                    echo "<td>".date("d-m-Y",strtotime($row->tgl_masuk))."</td>";
                    echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."/ ".date("H:i",strtotime($row->jam_keluar))."</td>";
                    echo "<td>".$prujuk["master"][$no_rm][$no_reg]."</td>";
                    echo "<td>".$prujuk["br"][$no_rm][$no_reg]->dikirim."</td>";
                    echo "<td>".$prujuk["br"][$no_rm][$no_reg]->alasan."</td>";
                    echo "</tr>";
                  }
                }
                if (count($prujuk["list"])<=0){
                  echo "<tr><td colspan='11'>NIHIL</td></tr>";
                }
              ?>
            </tbody>
          </table>
          <h3>12. Laporan Pasien Radiologi</h3>
          <table border="1" class="table" width="100%">
              <thead>
                  <tr class='bg-navy'>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Tindakan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="8">Rawat Jalan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="8">Rawat inap</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Total</th>
                  </tr>
                  <tr class='bg-navy'>

                      <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                      <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                  </tr>
                  <tr class='bg-navy'>
                      <th class="text-center">DR</th>
                      <th class="text-center">MANUAL</th>
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                      <th class="text-center">DR</th>
                      <th class="text-center">MANUAL</th>
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      $i = 1;
                      $hide = "";
                      $eks_ralan = $dr_ralan = $manual_ralan = $dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                      $eks_inap = $dr_inap = $manual_inap = $dinas_inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
                      foreach($tr->result() as $data){
                          $jml = isset($prad["tindakan"][$data->id_tindakan]) ? $prad["tindakan"][$data->id_tindakan] : 0;
                          $jml_inap = isset($prad_inap["tindakan"][$data->id_tindakan]) ? $prad_inap["tindakan"][$data->id_tindakan] : 0;
                          if ($jml>0 || $jml_inap>0){
                            // echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->id_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                            // echo "<td class='text-right'>".($i++)."</td>";
                            // echo "<td>".$data->nama_tindakan."</td>";
                            //ralan
                            // echo "<td class='text-right'>".(isset($prad["DR"][$data->id_tindakan]) ? $prad["DR"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad["MANUAL"][$data->id_tindakan]) ? $prad["MANUAL"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad["EKS"][$data->id_tindakan]) ? $prad["EKS"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad["DINAS"][$data->id_tindakan]) ? $prad["DINAS"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad["UMUM"][$data->id_tindakan]) ? $prad["UMUM"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad["BPJS"][$data->id_tindakan]) ? $prad["BPJS"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad["PRSH"][$data->id_tindakan]) ? $prad["PRSH"][$data->id_tindakan] : 0)."</td>";
                            $jumlah_ralan = (isset($prad["DINAS"][$data->id_tindakan]) ? $prad["DINAS"][$data->id_tindakan] : 0)+
                                      (isset($prad["UMUM"][$data->id_tindakan]) ? $prad["UMUM"][$data->id_tindakan] : 0)+
                                      (isset($prad["BPJS"][$data->id_tindakan]) ? $prad["BPJS"][$data->id_tindakan] : 0)+
                                      (isset($prad["PRSH"][$data->id_tindakan]) ? $prad["PRSH"][$data->id_tindakan] : 0);
                            $eks_ralan += (isset($prad["EKS"][$data->id_tindakan]) ? $prad["EKS"][$data->id_tindakan] : 0);
                            $dr_ralan += (isset($prad["DR"][$data->id_tindakan]) ? $prad["DR"][$data->id_tindakan] : 0);
                            $manual_ralan += (isset($prad["MANUAL"][$data->id_tindakan]) ? $prad["MANUAL"][$data->id_tindakan] : 0);
                            $dinas_ralan += (isset($prad["DINAS"][$data->id_tindakan]) ? $prad["DINAS"][$data->id_tindakan] : 0);
                            $umum_ralan += (isset($prad["UMUM"][$data->id_tindakan]) ? $prad["UMUM"][$data->id_tindakan] : 0);
                            $bpjs_ralan += (isset($prad["BPJS"][$data->id_tindakan]) ? $prad["BPJS"][$data->id_tindakan] : 0);
                            $prsh_ralan += (isset($prad["PRSH"][$data->id_tindakan]) ? $prad["PRSH"][$data->id_tindakan] : 0);
                            // echo "<td class='text-right'>".$jumlah_ralan."</td>";
                            //inap
                            // echo "<td class='text-right'>".(isset($prad_inap["DR"][$data->id_tindakan]) ? $prad_inap["DR"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad_inap["MANUAL"][$data->id_tindakan]) ? $prad_inap["MANUAL"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad_inap["PEMERIKSAAN"][$data->id_tindakan]) ? $prad_inap["PEMERIKSAAN"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad_inap["DINAS"][$data->id_tindakan]) ? $prad_inap["DINAS"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad_inap["UMUM"][$data->id_tindakan]) ? $prad_inap["UMUM"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad_inap["BPJS"][$data->id_tindakan]) ? $prad_inap["BPJS"][$data->id_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($prad_inap["PRSH"][$data->id_tindakan]) ? $prad_inap["PRSH"][$data->id_tindakan] : 0)."</td>";
                            $jumlah_inap = (isset($prad_inap["DINAS"][$data->id_tindakan]) ? $prad_inap["DINAS"][$data->id_tindakan] : 0)+
                                      (isset($prad_inap["UMUM"][$data->id_tindakan]) ? $prad_inap["UMUM"][$data->id_tindakan] : 0)+
                                      (isset($prad_inap["BPJS"][$data->id_tindakan]) ? $prad_inap["BPJS"][$data->id_tindakan] : 0)+
                                      (isset($prad_inap["PRSH"][$data->id_tindakan]) ? $prad_inap["PRSH"][$data->id_tindakan] : 0);
                            $eks_inap += (isset($prad_inap["PEMERIKSAAN"][$data->id_tindakan]) ? $prad_inap["PEMERIKSAAN"][$data->id_tindakan] : 0);
                            $dr_inap += (isset($prad_inap["DR"][$data->id_tindakan]) ? $prad_inap["DR"][$data->id_tindakan] : 0);
                            $manual_inap += (isset($prad_inap["MANUAL"][$data->id_tindakan]) ? $prad_inap["MANUAL"][$data->id_tindakan] : 0);
                            $dinas_inap += (isset($prad_inap["DINAS"][$data->id_tindakan]) ? $prad_inap["DINAS"][$data->id_tindakan] : 0);
                            $umum_inap += (isset($prad_inap["UMUM"][$data->id_tindakan]) ? $prad_inap["UMUM"][$data->id_tindakan] : 0);
                            $bpjs_inap += (isset($prad_inap["BPJS"][$data->id_tindakan]) ? $prad_inap["BPJS"][$data->id_tindakan] : 0);
                            $prsh_inap += (isset($prad_inap["PRSH"][$data->id_tindakan]) ? $prad_inap["PRSH"][$data->id_tindakan] : 0);
                            // echo "<td class='text-right'>".$jumlah_inap."</td>";
                            // echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                            // echo "</tr>";
                          }
                      }
                  ?>
              </tbody>
              <tfoot>
                  <tr class='bg-navy'>
                      <th colspan="2">Jumlah Pasien</th>
                      <th class="text-right"><?php echo $dr_ralan;?></th>
                      <th class="text-right"><?php echo $manual_ralan;?></th>
                      <th class="text-right"><?php echo $eks_ralan;?></th>
                      <th class="text-right"><?php echo $dinas_ralan;?></th>
                      <th class="text-right"><?php echo $umum_ralan;?></th>
                      <th class="text-right"><?php echo $bpjs_ralan;?></th>
                      <th class="text-right"><?php echo $prsh_ralan;?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                      <th class="text-right"><?php echo $dr_inap;?></th>
                      <th class="text-right"><?php echo $manual_inap;?></th>
                      <th class="text-right"><?php echo $eks_inap;?></th>
                      <th class="text-right"><?php echo $dinas_inap;?></th>
                      <th class="text-right"><?php echo $umum_inap;?></th>
                      <th class="text-right"><?php echo $bpjs_inap;?></th>
                      <th class="text-right"><?php echo $prsh_inap;?></th>
                      <th class="text-right"><?php echo ($dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan+$dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                  </tr>
              </tfoot>
          </table>
          <h3>13. Laporan Pasien Laboratorium</h3>
          <table border="1" class="table" width="100%">
              <thead>
                  <tr class='bg-navy'>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Tindakan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="6">Rawat Jalan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="6">Rawat inap</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Total</th>
                  </tr>
                  <tr class='bg-navy'>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                  </tr>
                  <tr class='bg-navy'>
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      $i = 1;
                      $hide = "";
                      $eks_ralan = $dr_ralan = $manual_ralan = $dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                      $eks_inap = $dr_inap = $manual_inap = $dinas_inap = $umum_inap = $bpjs_inap = $prsh_inap = $jumlah_ralan = $jumlah_inap = 0;
                      foreach($tl->result() as $data){
                          $jml = isset($plab["tindakan"][$data->kode_tindakan]) ? $plab["tindakan"][$data->kode_tindakan] : 0;
                          $jml_inap = isset($plab_inap["tindakan"][$data->kode_tindakan]) ? $plab_inap["tindakan"][$data->kode_tindakan] : 0;
                          if ($jml>0 || $jml_inap>0){
                          // echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                          // echo "<td class='text-right'>".($i++)."</td>";
                          // echo "<td>".$data->nama_tindakan."</td>";
                          // //ralan
                          // echo "<td class='text-right'>".(isset($plab["EKS"][$data->kode_tindakan]) ? $plab["EKS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab["DINAS"][$data->kode_tindakan]) ? $plab["DINAS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab["UMUM"][$data->kode_tindakan]) ? $plab["UMUM"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab["BPJS"][$data->kode_tindakan]) ? $plab["BPJS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab["PRSH"][$data->kode_tindakan]) ? $plab["PRSH"][$data->kode_tindakan] : 0)."</td>";
                          $jumlah_ralan = (isset($plab["DINAS"][$data->kode_tindakan]) ? $plab["DINAS"][$data->kode_tindakan] : 0)+
                                    (isset($plab["UMUM"][$data->kode_tindakan]) ? $plab["UMUM"][$data->kode_tindakan] : 0)+
                                    (isset($plab["BPJS"][$data->kode_tindakan]) ? $plab["BPJS"][$data->kode_tindakan] : 0)+
                                    (isset($plab["PRSH"][$data->kode_tindakan]) ? $plab["PRSH"][$data->kode_tindakan] : 0);
                          $eks_ralan += (isset($plab["EKS"][$data->kode_tindakan]) ? $plab["EKS"][$data->kode_tindakan] : 0);
                          $dr_ralan += (isset($plab["DR"][$data->kode_tindakan]) ? $plab["DR"][$data->kode_tindakan] : 0);
                          $manual_ralan += (isset($plab["MANUAL"][$data->kode_tindakan]) ? $plab["MANUAL"][$data->kode_tindakan] : 0);
                          $dinas_ralan += (isset($plab["DINAS"][$data->kode_tindakan]) ? $plab["DINAS"][$data->kode_tindakan] : 0);
                          $umum_ralan += (isset($plab["UMUM"][$data->kode_tindakan]) ? $plab["UMUM"][$data->kode_tindakan] : 0);
                          $bpjs_ralan += (isset($plab["BPJS"][$data->kode_tindakan]) ? $plab["BPJS"][$data->kode_tindakan] : 0);
                          $prsh_ralan += (isset($plab["PRSH"][$data->kode_tindakan]) ? $plab["PRSH"][$data->kode_tindakan] : 0);
                          // echo "<td class='text-right'>".$jumlah_ralan." ".($data->kode_tindakan=="L158" || $data->kode_tindakan=="L160" || $data->kode_tindakan=="L047"  ? "(".(isset($plab["positif"][$data->kode_tindakan]) ? $plab["positif"][$data->kode_tindakan] : 0).",".(isset($plab["negatif"][$data->kode_tindakan]) ? $plab["negatif"][$data->kode_tindakan] : 0).")" : "")."</td>";
                          //inap
                          // echo "<td class='text-right'>".(isset($plab_inap["PEMERIKSAAN"][$data->kode_tindakan]) ? $plab_inap["PEMERIKSAAN"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab_inap["DINAS"][$data->kode_tindakan]) ? $plab_inap["DINAS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab_inap["UMUM"][$data->kode_tindakan]) ? $plab_inap["UMUM"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab_inap["BPJS"][$data->kode_tindakan]) ? $plab_inap["BPJS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($plab_inap["PRSH"][$data->kode_tindakan]) ? $plab_inap["PRSH"][$data->kode_tindakan] : 0)."</td>";
                          $jumlah_inap = (isset($plab_inap["DINAS"][$data->kode_tindakan]) ? $plab_inap["DINAS"][$data->kode_tindakan] : 0)+
                                    (isset($plab_inap["UMUM"][$data->kode_tindakan]) ? $plab_inap["UMUM"][$data->kode_tindakan] : 0)+
                                    (isset($plab_inap["BPJS"][$data->kode_tindakan]) ? $plab_inap["BPJS"][$data->kode_tindakan] : 0)+
                                    (isset($plab_inap["PRSH"][$data->kode_tindakan]) ? $plab_inap["PRSH"][$data->kode_tindakan] : 0);
                          $eks_inap += (isset($plab_inap["PEMERIKSAAN"][$data->kode_tindakan]) ? $plab_inap["PEMERIKSAAN"][$data->kode_tindakan] : 0);
                          $dr_inap += (isset($plab_inap["DR"][$data->kode_tindakan]) ? $plab_inap["DR"][$data->kode_tindakan] : 0);
                          $manual_inap += (isset($plab_inap["MANUAL"][$data->kode_tindakan]) ? $plab_inap["MANUAL"][$data->kode_tindakan] : 0);
                          $dinas_inap += (isset($plab_inap["DINAS"][$data->kode_tindakan]) ? $plab_inap["DINAS"][$data->kode_tindakan] : 0);
                          $umum_inap += (isset($plab_inap["UMUM"][$data->kode_tindakan]) ? $plab_inap["UMUM"][$data->kode_tindakan] : 0);
                          $bpjs_inap += (isset($plab_inap["BPJS"][$data->kode_tindakan]) ? $plab_inap["BPJS"][$data->kode_tindakan] : 0);
                          $prsh_inap += (isset($plab_inap["PRSH"][$data->kode_tindakan]) ? $plab_inap["PRSH"][$data->kode_tindakan] : 0);
                          // echo "<td class='text-right'>".
                          $jumlah_inap." ".($data->kode_tindakan=="L158" || $data->kode_tindakan=="L160" || $data->kode_tindakan=="L047" ? "(".(isset($plab_inap["positif"][$data->kode_tindakan]) ? $plab_inap["positif"][$data->kode_tindakan] : 0).",".(isset($plab_inap["negatif"][$data->kode_tindakan]) ? $plab_inap["negatif"][$data->kode_tindakan] : 0).")" : "")."</td>";
                          // echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                          // echo "</tr>";
                          }
                      }
                  ?>
              </tbody>
              <tfoot>
                  <tr class='bg-navy'>
                      <th colspan="2">Jumlah Pasien</th>
                      <th class="text-right"><?php echo $eks_ralan;?></th>
                      <th class="text-right"><?php echo $dinas_ralan;?></th>
                      <th class="text-right"><?php echo $umum_ralan;?></th>
                      <th class="text-right"><?php echo $bpjs_ralan;?></th>
                      <th class="text-right"><?php echo $prsh_ralan;?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                      <th class="text-right"><?php echo $eks_inap;?></th>
                      <th class="text-right"><?php echo $dinas_inap;?></th>
                      <th class="text-right"><?php echo $umum_inap;?></th>
                      <th class="text-right"><?php echo $bpjs_inap;?></th>
                      <th class="text-right"><?php echo $prsh_inap;?></th>
                      <th class="text-right"><?php echo ($dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan+$dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                  </tr>
              </tfoot>
          </table>
          <h3>14. Laporan Patologi Anatomi</h3>
          <table border="1" class="table" width="100%">
              <thead>
                  <tr class='bg-navy'>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Tindakan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="6">Rawat Jalan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="6">Rawat inap</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Total</th>
                  </tr>
                  <tr class='bg-navy'>

                      <!-- <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th> -->
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                      <!-- <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th> -->
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                  </tr>
                  <tr class='bg-navy'>
                      <!-- <th class="text-center">DR</th>
                      <th class="text-center">MANUAL</th> -->
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                      <!-- <th class="text-center">DR</th>
                      <th class="text-center">MANUAL</th> -->
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      $i = 1;
                      $hide = "";
                      $eks_ralan = $dr_ralan = $manual_ralan = $dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                      $eks_inap = $dr_inap = $manual_inap = $dinas_inap = $umum_inap = $bpjs_inap = $prsh_inap = $jumlah_ralan = $jumlah_inap = 0;
                      foreach($tpa->result() as $data){
                          $jml = isset($ppa["tindakan"][$data->kode_tindakan]) ? $ppa["tindakan"][$data->kode_tindakan] : 0;
                          $jml_inap = isset($ppa_inap["tindakan"][$data->kode_tindakan]) ? $ppa_inap["tindakan"][$data->kode_tindakan] : 0;
                          if ($jml>0 || $jml_inap>0){
                            // echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                            // echo "<td class='text-right'>".($i++)."</td>";
                            // echo "<td>".$data->nama_tindakan."</td>";
                            //ralan
                            // echo "<td class='text-right'>".(isset($ppa["DR"][$data->kode_tindakan]) ? $ppa["DR"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa["MANUAL"][$data->kode_tindakan]) ? $ppa["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa["EKS"][$data->kode_tindakan]) ? $ppa["EKS"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa["DINAS"][$data->kode_tindakan]) ? $ppa["DINAS"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa["UMUM"][$data->kode_tindakan]) ? $ppa["UMUM"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa["BPJS"][$data->kode_tindakan]) ? $ppa["BPJS"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa["PRSH"][$data->kode_tindakan]) ? $ppa["PRSH"][$data->kode_tindakan] : 0)."</td>";
                            $jumlah_ralan = (isset($ppa["DINAS"][$data->kode_tindakan]) ? $ppa["DINAS"][$data->kode_tindakan] : 0)+
                                      (isset($ppa["UMUM"][$data->kode_tindakan]) ? $ppa["UMUM"][$data->kode_tindakan] : 0)+
                                      (isset($ppa["BPJS"][$data->kode_tindakan]) ? $ppa["BPJS"][$data->kode_tindakan] : 0)+
                                      (isset($ppa["PRSH"][$data->kode_tindakan]) ? $ppa["PRSH"][$data->kode_tindakan] : 0);
                            $eks_ralan += (isset($ppa["EKS"][$data->kode_tindakan]) ? $ppa["EKS"][$data->kode_tindakan] : 0);
                            $dr_ralan += (isset($ppa["DR"][$data->kode_tindakan]) ? $ppa["DR"][$data->kode_tindakan] : 0);
                            $manual_ralan += (isset($ppa["MANUAL"][$data->kode_tindakan]) ? $ppa["MANUAL"][$data->kode_tindakan] : 0);
                            $dinas_ralan += (isset($ppa["DINAS"][$data->kode_tindakan]) ? $ppa["DINAS"][$data->kode_tindakan] : 0);
                            $umum_ralan += (isset($ppa["UMUM"][$data->kode_tindakan]) ? $ppa["UMUM"][$data->kode_tindakan] : 0);
                            $bpjs_ralan += (isset($ppa["BPJS"][$data->kode_tindakan]) ? $ppa["BPJS"][$data->kode_tindakan] : 0);
                            $prsh_ralan += (isset($ppa["PRSH"][$data->kode_tindakan]) ? $ppa["PRSH"][$data->kode_tindakan] : 0);
                            // echo "<td class='text-right'>".$jumlah_ralan."</td>";
                            //inap
                            // echo "<td class='text-right'>".(isset($ppa_inap["DR"][$data->kode_tindakan]) ? $ppa_inap["DR"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa_inap["MANUAL"][$data->kode_tindakan]) ? $ppa_inap["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa_inap["PEMERIKSAAN"][$data->kode_tindakan]) ? $ppa_inap["PEMERIKSAAN"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa_inap["DINAS"][$data->kode_tindakan]) ? $ppa_inap["DINAS"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa_inap["UMUM"][$data->kode_tindakan]) ? $ppa_inap["UMUM"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa_inap["BPJS"][$data->kode_tindakan]) ? $ppa_inap["BPJS"][$data->kode_tindakan] : 0)."</td>";
                            // echo "<td class='text-right'>".(isset($ppa_inap["PRSH"][$data->kode_tindakan]) ? $ppa_inap["PRSH"][$data->kode_tindakan] : 0)."</td>";
                            $jumlah_inap = (isset($ppa_inap["DINAS"][$data->kode_tindakan]) ? $ppa_inap["DINAS"][$data->kode_tindakan] : 0)+
                                      (isset($ppa_inap["UMUM"][$data->kode_tindakan]) ? $ppa_inap["UMUM"][$data->kode_tindakan] : 0)+
                                      (isset($ppa_inap["BPJS"][$data->kode_tindakan]) ? $ppa_inap["BPJS"][$data->kode_tindakan] : 0)+
                                      (isset($ppa_inap["PRSH"][$data->kode_tindakan]) ? $ppa_inap["PRSH"][$data->kode_tindakan] : 0);
                            $eks_inap += (isset($ppa_inap["PEMERIKSAAN"][$data->kode_tindakan]) ? $ppa_inap["PEMERIKSAAN"][$data->kode_tindakan] : 0);
                            $dr_inap += (isset($ppa_inap["DR"][$data->kode_tindakan]) ? $ppa_inap["DR"][$data->kode_tindakan] : 0);
                            $manual_inap += (isset($ppa_inap["MANUAL"][$data->kode_tindakan]) ? $ppa_inap["MANUAL"][$data->kode_tindakan] : 0);
                            $dinas_inap += (isset($ppa_inap["DINAS"][$data->kode_tindakan]) ? $ppa_inap["DINAS"][$data->kode_tindakan] : 0);
                            $umum_inap += (isset($ppa_inap["UMUM"][$data->kode_tindakan]) ? $ppa_inap["UMUM"][$data->kode_tindakan] : 0);
                            $bpjs_inap += (isset($ppa_inap["BPJS"][$data->kode_tindakan]) ? $ppa_inap["BPJS"][$data->kode_tindakan] : 0);
                            $prsh_inap += (isset($ppa_inap["PRSH"][$data->kode_tindakan]) ? $ppa_inap["PRSH"][$data->kode_tindakan] : 0);
                            // echo "<td class='text-right'>".$jumlah_inap."</td>";
                            // echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                            // echo "</tr>";
                          }
                      }
                  ?>
              </tbody>
              <tfoot>
                  <tr class='bg-navy'>
                      <th colspan="2">Jumlah Pasien</th>
                      <!-- <th class="text-right"><?php echo $dr_ralan;?></th>
                      <th class="text-right"><?php echo $manual_ralan;?></th> -->
                      <th class="text-right"><?php echo $eks_ralan;?></th>
                      <th class="text-right"><?php echo $dinas_ralan;?></th>
                      <th class="text-right"><?php echo $umum_ralan;?></th>
                      <th class="text-right"><?php echo $bpjs_ralan;?></th>
                      <th class="text-right"><?php echo $prsh_ralan;?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                      <!-- <th class="text-right"><?php echo $dr_inap;?></th>
                      <th class="text-right"><?php echo $manual_inap;?></th> -->
                      <th class="text-right"><?php echo $eks_inap;?></th>
                      <th class="text-right"><?php echo $dinas_inap;?></th>
                      <th class="text-right"><?php echo $umum_inap;?></th>
                      <th class="text-right"><?php echo $bpjs_inap;?></th>
                      <th class="text-right"><?php echo $prsh_inap;?></th>
                      <th class="text-right"><?php echo ($dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan+$dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                  </tr>
              </tfoot>
          </table>
          <h3>15. Laporan Gizi</h3>
          <table border="1" class="table" width="100%">
              <thead>
                  <tr class='bg-navy'>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Tindakan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="6">Rawat Jalan</th>
                      <th class="text-center" style="vertical-align: middle" colspan="6">Rawat inap</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="3">Total</th>
                  </tr>
                  <tr class='bg-navy'>

                      <!-- <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th> -->
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                      <!-- <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th> -->
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Ekspertisi</th>
                      <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                      <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                  </tr>
                  <tr class='bg-navy'>
                      <!-- <th class="text-center">DR</th>
                      <th class="text-center">MANUAL</th> -->
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                      <!-- <th class="text-center">DR</th>
                      <th class="text-center">MANUAL</th> -->
                      <th class="text-center">D</th>
                      <th class="text-center">U</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">PRSH</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      $i = 1;
                      $hide = "";
                      $eks_ralan = $dr_ralan = $manual_ralan = $dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                      $eks_inap = $dr_inap = $manual_inap = $dinas_inap = $umum_inap = $bpjs_inap = $prsh_inap = $jumlah_ralan = $jumlah_inap = 0;
                      foreach($tg->result() as $data){
                          $jml = isset($pg["tindakan"][$data->kode_tindakan]) ? $pg["tindakan"][$data->kode_tindakan] : 0;
                          $jml_inap = isset($pg_inap["tindakan"][$data->kode_tindakan]) ? $pg_inap["tindakan"][$data->kode_tindakan] : 0;
                          if ($tindakan!="all"){
                              if ($tindakan==$data->kode_tindakan){
                                  if ($jml>0 || $jml_inap>0){
                                      $hide = "class='punya text-bold'";
                                  } else {
                                      $hide = "class='hide'";
                                  }
                              } else {
                                  $hide = "class='hide'";
                              }
                          } else {
                              if ($jml>0 || $jml_inap>0){
                                  $hide = "class='punya text-bold'";
                              } else {
                                  $hide = "class='hide'";
                              }
                          }
                          // echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                          // echo "<td class='text-right'>".($i++)."</td>";
                          // echo "<td>".$data->nama_tindakan."</td>";
                          //ralan
                          // echo "<td class='text-right'>".(isset($pg["DR"][$data->kode_tindakan]) ? $pg["DR"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg["MANUAL"][$data->kode_tindakan]) ? $pg["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg["EKS"][$data->kode_tindakan]) ? $pg["EKS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg["DINAS"][$data->kode_tindakan]) ? $pg["DINAS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg["UMUM"][$data->kode_tindakan]) ? $pg["UMUM"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg["BPJS"][$data->kode_tindakan]) ? $pg["BPJS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg["PRSH"][$data->kode_tindakan]) ? $pg["PRSH"][$data->kode_tindakan] : 0)."</td>";
                          $jumlah_ralan = (isset($pg["DINAS"][$data->kode_tindakan]) ? $pg["DINAS"][$data->kode_tindakan] : 0)+
                                    (isset($pg["UMUM"][$data->kode_tindakan]) ? $pg["UMUM"][$data->kode_tindakan] : 0)+
                                    (isset($pg["BPJS"][$data->kode_tindakan]) ? $pg["BPJS"][$data->kode_tindakan] : 0)+
                                    (isset($pg["PRSH"][$data->kode_tindakan]) ? $pg["PRSH"][$data->kode_tindakan] : 0);
                          $eks_ralan += (isset($pg["EKS"][$data->kode_tindakan]) ? $pg["EKS"][$data->kode_tindakan] : 0);
                          $dr_ralan += (isset($pg["DR"][$data->kode_tindakan]) ? $pg["DR"][$data->kode_tindakan] : 0);
                          $manual_ralan += (isset($pg["MANUAL"][$data->kode_tindakan]) ? $pg["MANUAL"][$data->kode_tindakan] : 0);
                          $dinas_ralan += (isset($pg["DINAS"][$data->kode_tindakan]) ? $pg["DINAS"][$data->kode_tindakan] : 0);
                          $umum_ralan += (isset($pg["UMUM"][$data->kode_tindakan]) ? $pg["UMUM"][$data->kode_tindakan] : 0);
                          $bpjs_ralan += (isset($pg["BPJS"][$data->kode_tindakan]) ? $pg["BPJS"][$data->kode_tindakan] : 0);
                          $prsh_ralan += (isset($pg["PRSH"][$data->kode_tindakan]) ? $pg["PRSH"][$data->kode_tindakan] : 0);
                          // echo "<td class='text-right'>".$jumlah_ralan."</td>";
                          //inap
                          // echo "<td class='text-right'>".(isset($pg_inap["DR"][$data->kode_tindakan]) ? $pg_inap["DR"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg_inap["MANUAL"][$data->kode_tindakan]) ? $pg_inap["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg_inap["PEMERIKSAAN"][$data->kode_tindakan]) ? $pg_inap["PEMERIKSAAN"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg_inap["DINAS"][$data->kode_tindakan]) ? $pg_inap["DINAS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg_inap["UMUM"][$data->kode_tindakan]) ? $pg_inap["UMUM"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg_inap["BPJS"][$data->kode_tindakan]) ? $pg_inap["BPJS"][$data->kode_tindakan] : 0)."</td>";
                          // echo "<td class='text-right'>".(isset($pg_inap["PRSH"][$data->kode_tindakan]) ? $pg_inap["PRSH"][$data->kode_tindakan] : 0)."</td>";
                          $jumlah_inap = (isset($pg_inap["DINAS"][$data->kode_tindakan]) ? $pg_inap["DINAS"][$data->kode_tindakan] : 0)+
                                    (isset($pg_inap["UMUM"][$data->kode_tindakan]) ? $pg_inap["UMUM"][$data->kode_tindakan] : 0)+
                                    (isset($pg_inap["BPJS"][$data->kode_tindakan]) ? $pg_inap["BPJS"][$data->kode_tindakan] : 0)+
                                    (isset($pg_inap["PRSH"][$data->kode_tindakan]) ? $pg_inap["PRSH"][$data->kode_tindakan] : 0);
                          $eks_inap += (isset($pg_inap["PEMERIKSAAN"][$data->kode_tindakan]) ? $pg_inap["PEMERIKSAAN"][$data->kode_tindakan] : 0);
                          $dr_inap += (isset($pg_inap["DR"][$data->kode_tindakan]) ? $pg_inap["DR"][$data->kode_tindakan] : 0);
                          $manual_inap += (isset($pg_inap["MANUAL"][$data->kode_tindakan]) ? $pg_inap["MANUAL"][$data->kode_tindakan] : 0);
                          $dinas_inap += (isset($pg_inap["DINAS"][$data->kode_tindakan]) ? $pg_inap["DINAS"][$data->kode_tindakan] : 0);
                          $umum_inap += (isset($pg_inap["UMUM"][$data->kode_tindakan]) ? $pg_inap["UMUM"][$data->kode_tindakan] : 0);
                          $bpjs_inap += (isset($pg_inap["BPJS"][$data->kode_tindakan]) ? $pg_inap["BPJS"][$data->kode_tindakan] : 0);
                          $prsh_inap += (isset($pg_inap["PRSH"][$data->kode_tindakan]) ? $pg_inap["PRSH"][$data->kode_tindakan] : 0);
                          // echo "<td class='text-right'>".$jumlah_inap."</td>";
                          // echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                          // echo "</tr>";
                      }
                  ?>
              </tbody>
              <tfoot>
                  <tr class='bg-navy'>
                      <th colspan="2">Jumlah Pasien</th>
                      <!-- <th class="text-right"><?php echo $dr_ralan;?></th>
                      <th class="text-right"><?php echo $manual_ralan;?></th> -->
                      <th class="text-right"><?php echo $eks_ralan;?></th>
                      <th class="text-right"><?php echo $dinas_ralan;?></th>
                      <th class="text-right"><?php echo $umum_ralan;?></th>
                      <th class="text-right"><?php echo $bpjs_ralan;?></th>
                      <th class="text-right"><?php echo $prsh_ralan;?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                      <!-- <th class="text-right"><?php echo $dr_inap;?></th>
                      <th class="text-right"><?php echo $manual_inap;?></th> -->
                      <th class="text-right"><?php echo $eks_inap;?></th>
                      <th class="text-right"><?php echo $dinas_inap;?></th>
                      <th class="text-right"><?php echo $umum_inap;?></th>
                      <th class="text-right"><?php echo $bpjs_inap;?></th>
                      <th class="text-right"><?php echo $prsh_inap;?></th>
                      <th class="text-right"><?php echo ($dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                      <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan+$dinas_inap+$umum_inap+$bpjs_inap+$prsh_inap);?></th>
                  </tr>
              </tfoot>
          </table>
        <h3>16. Laporan Cara Masuk Rawat Inap</h3>
        <table border="1" class="table" width="100%">
          <tr>
            <th style="vertical-align:middle"  class="text-center" rowspan="2">Cara Masuk</th>
            <th class="text-center" colspan="2">D</th>
            <th style="vertical-align:middle"  class="text-center" rowspan="2">U</th>
            <th style="vertical-align:middle"  class="text-center" rowspan="2">BPJS</th>
            <th style="vertical-align:middle"  class="text-center" rowspan="2">PRSH</th>
            <th style="vertical-align:middle"  class="text-center" rowspan="2">Jumlah</th>
          </tr>
          <tr>
            <th class="text-center">AKTIF</th>
            <th class="text-center">PUR</th>
          </tr>
          <?php
            $jumlah_sendiri = 0;
            $jumlah_sendiri += (isset($q2["Datang Sendiri"]["DINAS_A"]) ? $q2["Datang Sendiri"]["DINAS_A"] : 0);
            $jumlah_sendiri += (isset($q2["Datang Sendiri"]["DINAS_PUR"]) ? $q2["Datang Sendiri"]["DINAS_PUR"] : 0);
            $jumlah_sendiri += (isset($q2["Datang Sendiri"]["UMUM"]) ? $q2["Datang Sendiri"]["UMUM"] : 0);
            $jumlah_sendiri += (isset($q2["Datang Sendiri"]["BPJS"]) ? $q2["Datang Sendiri"]["BPJS"] : 0);
            $jumlah_sendiri += (isset($q2["Datang Sendiri"]["PERUSAHAAN"]) ? $q2["Datang Sendiri"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Sendiri</th>
            <th class="text-center"><?php echo (isset($q2["Datang Sendiri"]["DINAS_A"]) ? $q2["Datang Sendiri"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Datang Sendiri"]["DINAS_PUR"]) ? $q2["Datang Sendiri"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Datang Sendiri"]["UMUM"]) ? $q2["Datang Sendiri"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Datang Sendiri"]["BPJS"]) ? $q2["Datang Sendiri"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Datang Sendiri"]["PERUSAHAAN"]) ? $q2["Datang Sendiri"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_sendiri;?></th>
          </tr>
          <?php
            $jumlah_rs = 0;
            $jumlah_rs += (isset($q2["Rujukan RS"]["DINAS_A"]) ? $q2["Rujukan RS"]["DINAS_A"] : 0);
            $jumlah_rs += (isset($q2["Rujukan RS"]["DINAS_PUR"]) ? $q2["Rujukan RS"]["DINAS_PUR"] : 0);
            $jumlah_rs += (isset($q2["Rujukan RS"]["UMUM"]) ? $q2["Rujukan RS"]["UMUM"] : 0);
            $jumlah_rs += (isset($q2["Rujukan RS"]["BPJS"]) ? $q2["Rujukan RS"]["BPJS"] : 0);
            $jumlah_rs += (isset($q2["Rujukan RS"]["PERUSAHAAN"]) ? $q2["Rujukan RS"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Rujukan RS</th>
            <th class="text-center"><?php echo (isset($q2["Rujukan RS"]["DINAS_A"]) ? $q2["Rujukan RS"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan RS"]["DINAS_PUR"]) ? $q2["Rujukan RS"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan RS"]["UMUM"]) ? $q2["Rujukan RS"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan RS"]["BPJS"]) ? $q2["Rujukan RS"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan RS"]["PERUSAHAAN"]) ? $q2["Rujukan RS"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_rs;?></th>
          </tr>
          <?php
            $jumlah_dokter = 0;
            $jumlah_dokter += (isset($q2["Rujukan Dokter"]["DINAS_A"]) ? $q2["Rujukan Dokter"]["DINAS_A"] : 0);
            $jumlah_dokter += (isset($q2["Rujukan Dokter"]["DINAS_PUR"]) ? $q2["Rujukan Dokter"]["DINAS_PUR"] : 0);
            $jumlah_dokter += (isset($q2["Rujukan Dokter"]["UMUM"]) ? $q2["Rujukan Dokter"]["UMUM"] : 0);
            $jumlah_dokter += (isset($q2["Rujukan Dokter"]["BPJS"]) ? $q2["Rujukan Dokter"]["BPJS"] : 0);
            $jumlah_dokter += (isset($q2["Rujukan Dokter"]["PERUSAHAAN"]) ? $q2["Rujukan Dokter"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Rujukan Dokter</th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Dokter"]["DINAS_A"]) ? $q2["Rujukan Dokter"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Dokter"]["DINAS_PUR"]) ? $q2["Rujukan Dokter"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Dokter"]["UMUM"]) ? $q2["Rujukan Dokter"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Dokter"]["BPJS"]) ? $q2["Rujukan Dokter"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Dokter"]["PERUSAHAAN"]) ? $q2["Rujukan Dokter"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_dokter;?></th>
          </tr>
          <?php
            $jumlah_paramedis = 0;
            $jumlah_paramedis += (isset($q2["Rujukan Dokter"]["DINAS_A"]) ? $q2["Rujukan Paramedis"]["DINAS_A"] : 0);
            $jumlah_paramedis += (isset($q2["Rujukan Paramedis"]["DINAS_PUR"]) ? $q2["Rujukan Paramedis"]["DINAS_PUR"] : 0);
            $jumlah_paramedis += (isset($q2["Rujukan Paramedis"]["UMUM"]) ? $q2["Rujukan Paramedis"]["UMUM"] : 0);
            $jumlah_paramedis += (isset($q2["Rujukan Paramedis"]["BPJS"]) ? $q2["Rujukan Paramedis"]["BPJS"] : 0);
            $jumlah_paramedis += (isset($q2["Rujukan Paramedis"]["PERUSAHAAN"]) ? $q2["Rujukan Paramedis"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Rujukan Paramedis</th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Dokter"]["DINAS_A"]) ? $q2["Rujukan Paramedis"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Paramedis"]["DINAS_PUR"]) ? $q2["Rujukan Paramedis"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Paramedis"]["UMUM"]) ? $q2["Rujukan Paramedis"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Paramedis"]["BPJS"]) ? $q2["Rujukan Paramedis"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Paramedis"]["PERUSAHAAN"]) ? $q2["Rujukan Paramedis"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_paramedis;?></th>
          </tr>
          <?php
            $jumlah_puskesmas = 0;
            $jumlah_puskesmas += (isset($q2["Rujukan Puskesmas"]["DINAS_A"]) ? $q2["Rujukan Puskesmas"]["DINAS_A"] : 0);
            $jumlah_puskesmas += (isset($q2["Rujukan Puskesmas"]["DINAS_PUR"]) ? $q2["Rujukan Puskesmas"]["DINAS_PUR"] : 0);
            $jumlah_puskesmas += (isset($q2["Rujukan Puskesmas"]["UMUM"]) ? $q2["Rujukan Puskesmas"]["UMUM"] : 0);
            $jumlah_puskesmas += (isset($q2["Rujukan Puskesmas"]["BPJS"]) ? $q2["Rujukan Puskesmas"]["BPJS"] : 0);
            $jumlah_puskesmas += (isset($q2["Rujukan Puskesmas"]["PERUSAHAAN"]) ? $q2["Rujukan Puskesmas"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Rujukan Puskesmas</th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Puskesmas"]["DINAS_A"]) ? $q2["Rujukan Puskesmas"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Puskesmas"]["DINAS_PUR"]) ? $q2["Rujukan Puskesmas"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Puskesmas"]["UMUM"]) ? $q2["Rujukan Puskesmas"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Puskesmas"]["BPJS"]) ? $q2["Rujukan Puskesmas"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Puskesmas"]["PERUSAHAAN"]) ? $q2["Rujukan Puskesmas"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_puskesmas;?></th>
          </tr>
          <?php
            $jumlah_lain = 0;
            $jumlah_lain += (isset($q2["Rujukan Lain"]["DINAS_A"]) ? $q2["Rujukan Lain"]["DINAS_A"] : 0);
            $jumlah_lain += (isset($q2["Rujukan Lain"]["DINAS_PUR"]) ? $q2["Rujukan Lain"]["DINAS_PUR"] : 0);
            $jumlah_lain += (isset($q2["Rujukan Lain"]["UMUM"]) ? $q2["Rujukan Lain"]["UMUM"] : 0);
            $jumlah_lain += (isset($q2["Rujukan Lain"]["BPJS"]) ? $q2["Rujukan Lain"]["BPJS"] : 0);
            $jumlah_lain += (isset($q2["Rujukan Lain"]["PERUSAHAAN"]) ? $q2["Rujukan Lain"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Rujukan Lain</th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Lain"]["DINAS_A"]) ? $q2["Rujukan Lain"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Lain"]["DINAS_PUR"]) ? $q2["Rujukan Lain"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Lain"]["UMUM"]) ? $q2["Rujukan Lain"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Lain"]["BPJS"]) ? $q2["Rujukan Lain"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q2["Rujukan Lain"]["PERUSAHAAN"]) ? $q2["Rujukan Lain"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_lain;?></th>
          </tr>
        </table>
        <h3>17. Laporan Prosedur Masuk Harian Rawat Inap</h3>
        <table border="1" class="table" width="100%">
          <tr>
            <th style="vertical-align:middle" class="text-center" rowspan="2">Prosedur Masuk</th>
            <th class="text-center" colspan="2">D</th>
            <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
            <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
            <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
            <th style="vertical-align:middle" class="text-center" rowspan="2">Jumlah</th>
          </tr>
          <tr>
            <th class="text-center">AKTIF</th>
            <th class="text-center">PUR</th>
          </tr>
          <?php
            $jumlah_igd = 0;
            $jumlah_igd += (isset($q3["UGD"]["DINAS_A"]) ? $q3["UGD"]["DINAS_A"] : 0);
            $jumlah_igd += (isset($q3["UGD"]["DINAS_PUR"]) ? $q3["UGD"]["DINAS_PUR"] : 0);
            $jumlah_igd += (isset($q3["UGD"]["UMUM"]) ? $q3["UGD"]["UMUM"] : 0);
            $jumlah_igd += (isset($q3["UGD"]["BPJS"]) ? $q3["UGD"]["BPJS"] : 0);
            $jumlah_igd += (isset($q3["UGD"]["PERUSAHAAN"]) ? $q3["UGD"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>IGD</th>
            <th class="text-center"><?php echo (isset($q3["UGD"]["DINAS_A"]) ? $q3["UGD"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["UGD"]["DINAS_PUR"]) ? $q3["UGD"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["UGD"]["UMUM"]) ? $q3["UGD"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["UGD"]["BPJS"]) ? $q3["UGD"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["UGD"]["PERUSAHAAN"]) ? $q3["UGD"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_igd;?></th>
          </tr>
          <?php
            $jumlah_langsung = 0;
            $jumlah_langsung += (isset($q3["Langsung"]["DINAS_A"]) ? $q3["Langsung"]["DINAS_A"] : 0);
            $jumlah_langsung += (isset($q3["Langsung"]["DINAS_PUR"]) ? $q3["Langsung"]["DINAS_PUR"] : 0);
            $jumlah_langsung += (isset($q3["Langsung"]["UMUM"]) ? $q3["Langsung"]["UMUM"] : 0);
            $jumlah_langsung += (isset($q3["Langsung"]["BPJS"]) ? $q3["Langsung"]["BPJS"] : 0);
            $jumlah_langsung += (isset($q3["Langsung"]["PERUSAHAAN"]) ? $q3["Langsung"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Langsung</th>
            <th class="text-center"><?php echo (isset($q3["Langsung"]["DINAS_A"]) ? $q3["Langsung"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Langsung"]["DINAS_PUR"]) ? $q3["Langsung"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Langsung"]["UMUM"]) ? $q3["Langsung"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Langsung"]["BPJS"]) ? $q3["Langsung"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Langsung"]["PERUSAHAAN"]) ? $q3["Langsung"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_langsung;?></th>
          </tr>
          <?php
            $jumlah_poliklinik = 0;
            $jumlah_poliklinik += (isset($q3["Poliklinik"]["DINAS_A"]) ? $q3["Poliklinik"]["DINAS_A"] : 0);
            $jumlah_poliklinik += (isset($q3["Poliklinik"]["DINAS_PUR"]) ? $q3["Poliklinik"]["DINAS_PUR"] : 0);
            $jumlah_poliklinik += (isset($q3["Poliklinik"]["UMUM"]) ? $q3["Poliklinik"]["UMUM"] : 0);
            $jumlah_poliklinik += (isset($q3["Poliklinik"]["BPJS"]) ? $q3["Poliklinik"]["BPJS"] : 0);
            $jumlah_poliklinik += (isset($q3["Poliklinik"]["PERUSAHAAN"]) ? $q3["Poliklinik"]["PERUSAHAAN"] : 0);
          ?>
          <tr>
            <th>Poliklinik</th>
            <th class="text-center"><?php echo (isset($q3["Poliklinik"]["DINAS_A"]) ? $q3["Poliklinik"]["DINAS_A"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Poliklinik"]["DINAS_PUR"]) ? $q3["Poliklinik"]["DINAS_PUR"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Poliklinik"]["UMUM"]) ? $q3["Poliklinik"]["UMUM"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Poliklinik"]["BPJS"]) ? $q3["Poliklinik"]["BPJS"] : "-");?></th>
            <th class="text-center"><?php echo (isset($q3["Poliklinik"]["PERUSAHAAN"]) ? $q3["Poliklinik"]["PERUSAHAAN"] : "-");?></th>
            <th class="text-center"><?php echo $jumlah_poliklinik;?></th>
          </tr>
        </table>
        <h3>18. Pasien Baru Rawat Inap</h3>
        <table border="1" class="table" width="100%">
            <thead>
                <tr>
                  <th style="vertical-align: middle" class="text-center" rowspan="3">No</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="3" colspan="2">Ruangan</th>
                  <!-- <th style="vertical-align: middle" class="text-center" rowspan="3">Nama Perawat</th> -->
                  <th style="vertical-align: middle" class="text-center" colspan="9">Keterangan</th>
                </tr>
                <tr>
                  <th style="vertical-align: middle" class="text-center" colspan="2">D</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">U</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">BPJS</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">PRSH</th>
                  <th style="vertical-align: middle" class="text-center" rowspan="2">Jumlah</th>
                </tr>
                <tr>
                  <th style="vertical-align: middle" class="text-center">Aktif</th>
                  <th style="vertical-align: middle" class="text-center">Purn</th>
                </th>
            </thead>
            <tbody>
              <?php
              $dinas_a = $dinas_pur = $umum = $bpjs = $prsh = 0;
              $jml_dinas_a = $jml_dinas_pur = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = $jlm_hp = 0;
              $i = 0;
              $kr = "";
              foreach ($r as $kode_ruangan_a => $value) {
                foreach ($value as $kode_kelas => $row) {
                  if ($row->kode_ruangan!=19){
                      $dinas_a = (isset($inap3["DINAS_A"][$kode_ruangan_a][$kode_kelas]) ? $inap3["DINAS_A"][$kode_ruangan_a][$kode_kelas] : 0);
                      $dinas_pur = (isset($inap3["DINAS_PUR"][$kode_ruangan_a][$kode_kelas]) ? $inap3["DINAS_PUR"][$kode_ruangan_a][$kode_kelas] : 0);
                      $umum = (isset($inap3["UMUM"][$kode_ruangan_a][$kode_kelas]) ? $inap3["UMUM"][$kode_ruangan_a][$kode_kelas] : 0);
                      $bpjs = (isset($inap3["BPJS"][$kode_ruangan_a][$kode_kelas]) ? $inap3["BPJS"][$kode_ruangan_a][$kode_kelas] : 0);
                      $prsh = (isset($inap3["PRSH"][$kode_ruangan_a][$kode_kelas]) ? $inap3["PRSH"][$kode_ruangan_a][$kode_kelas] : 0);
                      $bed = $row->bed;
                      if ($kr!=$kode_ruangan_a) {
                        $nama_ruangan = str_replace("ISOLASI", "", $row->nama_ruangan);
                        $i++;
                        $no = $i;
                      } else {
                        $nama_ruangan = $no = "";
                      }
                      echo "<tr class='data' ruangan='".$kode_ruangan_a."'>";
                      if ($nama_ruangan!=""){
                        echo "<td rowspan='".count($value)."'>".$no."</td>";
                        echo "<td rowspan='".count($value)."'>".$nama_ruangan."</td>";
                      }
                      echo "<td>".$row->nama_kelas."</td>";
                      // echo "<td class='text-right'></td>";
                      echo "<td class='text-right'>".$dinas_a."</td>";
                      echo "<td class='text-right'>".$dinas_pur."</td>";
                      echo "<td class='text-right'>".$umum."</td>";
                      echo "<td class='text-right'>".$bpjs."</td>";
                      echo "<td class='text-right'>".$prsh."</td>";
                      echo "<td class='text-right'>".($dinas_a+$dinas_pur+$umum+$bpjs+$prsh)."</td>";
                      echo "</tr>";
                      $kr = $kode_ruangan_a;
                      $jml_dinas_a += $dinas_a;
                      $jml_dinas_pur += $dinas_pur;
                      $jml_umum += $umum;
                      $jml_bpjs += $bpjs;
                      $jml_prsh += $prsh;
                      $jml_bed += $bed;
                      $jml_hp += (isset($inap3["HP"][$kode_ruangan_a][$kode_kelas]) ? $inap3["HP"][$kode_ruangan_a][$kode_kelas] : 0);
                  }
                }
              }
              ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Jumlah Pasien</th>
                    <th class='text-right'><?php echo $jml_dinas_a;?></th>
                    <th class='text-right'><?php echo $jml_dinas_pur;?></th>
                    <th class='text-right'><?php echo $jml_umum;?></th>
                    <th class='text-right'><?php echo $jml_bpjs;?></th>
                    <th class='text-right'><?php echo $jml_prsh;?></th>
                    <th class='text-right'><?php echo ($jml_dinas_a+$jml_dinas_pur+$jml_umum+$jml_bpjs+$jml_prsh);?></th>
                </tr>
            </tfoot>
        </table>
        <h3>19. Laporan Lain-Lain</h3>
        <table border="1" class="table" width="100%">
            <tr>
              <td>Kerusakan : <br><?php echo $kt->kerusakan;?></td>
            </tr>
            <tr>
              <td>Lain-lain : <br><?php echo $kt->lainlain;?></td>
            </tr>
        </table>
        <table border="0" class="table" width="100%">
          <tr>
            <td width="50%">&nbsp;</td>
            <td align="center">
              Cirebon, <?php echo date("d-m-Y").", Jam ".date("H:i")."<br>Kontrole"; ?>
              <br><br>
              <span class="ttd_perawat"></span><br><br><?php echo $kt->nama_perawat;?>
            </td>
          </tr>
        </table>
    </div>
</html>
