<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rekap_Radiologi_Inap".date('YmdHis').".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 align="center">LAPORAN PEMERIKSAAN RADIOLOGI RAWAT INAP <br>
    Periode Tanggal : <?php echo $tgl1."-".$tgl2?></h4>
    <?php 
        if ($tindakan != "all") {
            $pemeriksaan = "Pemeriksaan : ".$t2->nama_tindakan;
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
                    <th class="text-center" style="vertical-align: middle" rowspan="2">No.</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Tindakan</th>
                    <th class="text-center" style="vertical-align: middle" colspan="2">Asal</th>
                    <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                </tr>
                <tr class='bg-navy'>
                    <th class="text-center" >Dr</th>
                    <th class="text-center" >Manual</th>
                    <th class="text-center" width="5%">D</th>
                    <th class="text-center" width="5%">U</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PRSH</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    $hide = "";
                    $dr = $manual = $dinas = $umum = $bpjs = $prsh = 0;
                    foreach($t->result() as $data){
                        if ($tindakan!="all"){
                            if ($tindakan==$data->id_tindakan){
                                $hide = "";
                            } else {
                                $hide = "class='hide'";
                            }
                        } else {
                            $jml = isset($p["tindakan"][$data->id_tindakan]) ? $p["tindakan"][$data->id_tindakan] : 0;
                            if ($jml>0){
                                $hide = "class='bg-blue text-bold'";
                            } else {
                                $hide = "";
                            }
                        }
                        echo "<tr ".$hide." tindakan='".$data->id_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                        echo "<td class='text-right'>".($i++)."</td>";
                        echo "<td>".$data->nama_tindakan."</td>";
                        echo "<td class='text-right'>".(isset($p["DR"][$data->id_tindakan]) ? $p["DR"][$data->id_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["MANUAL"][$data->id_tindakan]) ? $p["MANUAL"][$data->id_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0)."</td>";
                        $jumlah = (isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0)+
                                  (isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0)+
                                  (isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0)+
                                  (isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0);
                        $dr += (isset($p["DR"][$data->id_tindakan]) ? $p["DR"][$data->id_tindakan] : 0);
                        $manual += (isset($p["MANUAL"][$data->id_tindakan]) ? $p["MANUAL"][$data->id_tindakan] : 0);
                        $dinas += (isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0);
                        $umum += (isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0);
                        $bpjs += (isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0);
                        $prsh += (isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0);
                        echo "<td class='text-right'>".$jumlah."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class='bg-navy'>
                    <th colspan="2">Jumlah Pasien</th>
                    <th class="text-right"><?php echo $dr;?></th>
                    <th class="text-right"><?php echo $manual;?></th>
                    <th class="text-right"><?php echo $dinas;?></th>
                    <th class="text-right"><?php echo $umum;?></th>
                    <th class="text-right"><?php echo $bpjs;?></th>
                    <th class="text-right"><?php echo $prsh;?></th>
                    <th class="text-right"><?php echo ($dinas+$umum+$bpjs+$prsh);?></th>
                </tr>
            </tfoot>
        </table>
        <div align="right"> Penanggung Jawab</div>
        <br>
        <br>
        <br>
        <div align="right"> Radiologi</div>
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
