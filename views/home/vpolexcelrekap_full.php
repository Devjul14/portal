<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rekap_Poliklinik_Ralan".date('YmdHis').".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 style="margin-left: 250px; width: 25cm;" align="center">LAPORAN PEMERIKSAAN POLIKLINIK RAWAT JALAN<br>
    Periode Tanggal : <?php echo $tgl1." - ".$tgl2?></h4>
    <?php 
        if ($tindakan != "all") {
            $pemeriksaan = "Pemeriksaan : ".$t2->keterangan;
        }else{
            $pemeriksaan = "";
        }
    ?>
     <?php echo $pemeriksaan; ?>
    <br>
     <div class="table-responsive">
        <table cellspacing="0" cellpadding="2" border="1" width="100%">
                    <thead>
                        <tr class='bg-navy'>
                            <th class="text-center" style="vertical-align: middle" rowspan="3">No.</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="3">Tindakan</th>
                            <th class="text-center" style="vertical-align: middle" colspan="9">Rawat Jalan</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Jenis</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
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
                    $hide = "";
                    $baru_ralan = $lama_ralan = $reguler_ralan = $eks_ralan =$dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan = 0;
                    foreach($t->result() as $data){
                        $jml = isset($p["tindakan"][$data->kode]) ? $p["tindakan"][$data->kode] : 0;
                        if ($tindakan!="all"){
                            if ($tindakan==$data->kode){
                                if ($jml>0){
                                    $hide = "class='punya text-bold'";
                                } else {
                                    $hide = "";
                                }
                            } else {
                                $hide = "";
                            }
                        } else {
                            if ($jml>0){
                                $hide = "class='punya text-bold'";
                            } else {
                                $hide = "";
                            }
                        }
                        echo "<tr jml='".$jml."' id='data' ".$hide." tindakan='".$data->kode."' nama_tindakan='".$data->keterangan."'>";
                            echo "<td class='text-right'>".($i++)."</td>";
                            echo "<td>".$data->keterangan."</td>";
                            //ralan
                            echo "<td class='text-right'>".(isset($p["BARU"][$data->kode]) ? $p["BARU"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($p["LAMA"][$data->kode]) ? $p["LAMA"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($p["REGULER"][$data->kode]) ? $p["REGULER"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($p["EKSEKUTIF"][$data->kode]) ? $p["EKSEKUTIF"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0)."</td>";
                            $jumlah_ralan = (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)+
                                (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)+
                                (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)+
                                (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                            $baru_ralan += (isset($p["BARU"][$data->kode]) ? $p["BARU"][$data->kode] : 0);
                            $lama_ralan += (isset($p["LAMA"][$data->kode]) ? $p["LAMA"][$data->kode] : 0);
                            $eks_ralan += (isset($p["EKSEKUTIF"][$data->kode]) ? $p["EKSEKUTIF"][$data->kode] : 0);
                            $reguler_ralan += (isset($p["REGULER"][$data->kode]) ? $p["REGULER"][$data->kode] : 0);
                            $dinas_ralan += (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0);
                            $umum_ralan += (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0);
                            $bpjs_ralan += (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0);
                            $prsh_ralan += (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                            echo "<td class='text-right'>".$jumlah_ralan."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class='bg-navy'>
                    <th colspan="2">Jumlah Pasien</th>
                    <th class="text-right"><?php echo $baru_ralan;?></th>
                    <th class="text-right"><?php echo $lama_ralan;?></th>
                    <th class="text-right"><?php echo $reguler_ralan;?></th>
                    <th class="text-right"><?php echo $eks_ralan;?></th>
                    <th class="text-right"><?php echo $dinas_ralan;?></th>
                    <th class="text-right"><?php echo $umum_ralan;?></th>
                    <th class="text-right"><?php echo $bpjs_ralan;?></th>
                    <th class="text-right"><?php echo $prsh_ralan;?></th>
                    <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                </tr>
            </tfoot>
        </table>
    </div>
        
    


<style type="text/css">
    .modal-dialog{
        width:80%;
    }
    html, body {
        display: block;
        font-family: "sans-serif";
        width: 20cm;
         /*height: 13cm;*/
    }

    @page{
        width: 20cm; 
        /*height: 13cm;*/
    }
</style>
