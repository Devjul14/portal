<!DOCTYPE html>
<html>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
<script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script>
	window.print();
</script>
<body>
    <div class="col-xs-12">
        <table class="table" width="100%">
            <tr>
                <th>Laporan Pasien Rawat Jalan</th>
                <th class='text-right'>Periode <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2));?></th>
            </tr>
        </table>
        <table border="1" class="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">No.</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Poliklinik</th>
                    <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                    <th class="text-center" style="vertical-align: middle" colspan="2">Jenis</th>
                    <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                </tr>
                <tr>
                    <th class="text-center">Baru</th>
                    <th class="text-center">Lama</th>
                    <th class="text-center">Reguler</th>
                    <th class="text-center">Eksekutif</th>
                    <th class="text-center">D</th>
                    <th class="text-center">U</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PRSH</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    $baru = $lama = $reguler = $eksekutif = $dinas = $umum = $bpjs = $prsh = 0;
                    foreach($p->result() as $data){
                        echo "<tr>";
                        echo "<td class='text-right'>".($i++)."</td>";
                        echo "<td>".$data->keterangan."</td>";
                        echo "<td class='text-right'>".(isset($poli["BARU"][$data->kode]) ? $poli["BARU"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($poli["LAMA"][$data->kode]) ? $poli["LAMA"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($poli["REGULER"][$data->kode]) ? $poli["REGULER"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($poli["EKSEKUTIF"][$data->kode]) ? $poli["EKSEKUTIF"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($poli["DINAS"][$data->kode]) ? $poli["DINAS"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($poli["UMUM"][$data->kode]) ? $poli["UMUM"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($poli["BPJS"][$data->kode]) ? $poli["BPJS"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($poli["PRSH"][$data->kode]) ? $poli["PRSH"][$data->kode] : 0)."</td>";
                        $jumlah = (isset($poli["DINAS"][$data->kode]) ? $poli["DINAS"][$data->kode] : 0)+
                                  (isset($poli["UMUM"][$data->kode]) ? $poli["UMUM"][$data->kode] : 0)+
                                  (isset($poli["BPJS"][$data->kode]) ? $poli["BPJS"][$data->kode] : 0)+
                                  (isset($poli["PRSH"][$data->kode]) ? $poli["PRSH"][$data->kode] : 0);
                        $baru += (isset($poli["BARU"][$data->kode]) ? $poli["BARU"][$data->kode] : 0);
                        $lama += (isset($poli["LAMA"][$data->kode]) ? $poli["LAMA"][$data->kode] : 0);
                        $reguler += (isset($poli["REGULER"][$data->kode]) ? $poli["REGULER"][$data->kode] : 0);
                        $eksekutif += (isset($poli["EKSEKUTIF"][$data->kode]) ? $poli["EKSEKUTIF"][$data->kode] : 0);
                        $dinas += (isset($poli["DINAS"][$data->kode]) ? $poli["DINAS"][$data->kode] : 0);
                        $umum += (isset($poli["UMUM"][$data->kode]) ? $poli["UMUM"][$data->kode] : 0);
                        $bpjs += (isset($poli["BPJS"][$data->kode]) ? $poli["BPJS"][$data->kode] : 0);
                        $prsh += (isset($poli["PRSH"][$data->kode]) ? $poli["PRSH"][$data->kode] : 0);
                        echo "<td class='text-right'>".$jumlah."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Jumlah Pasien</th>
                    <th class="text-right"><?php echo $baru;?></th>
                    <th class="text-right"><?php echo $lama;?></th>
                    <th class="text-right"><?php echo $reguler;?></th>
                    <th class="text-right"><?php echo $eksekutif;?></th>
                    <th class="text-right"><?php echo $dinas;?></th>
                    <th class="text-right"><?php echo $umum;?></th>
                    <th class="text-right"><?php echo $bpjs;?></th>
                    <th class="text-right"><?php echo $prsh;?></th>
                    <th class="text-right"><?php echo ($dinas+$umum+$bpjs+$prsh);?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
