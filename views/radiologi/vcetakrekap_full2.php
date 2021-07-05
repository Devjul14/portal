<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 style="margin-left: 250px; width: 25cm;" align="center">LAPORAN PEMERIKSAAN RADIOLOGI
    RAWAT JALAN DAN RAWAT INAP <br>
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
                $eks_inap = $dr_inap = $manual_inap = $dinas__inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
                foreach($t->result() as $data){
                    $jml = isset($p["tindakan"][$data->id_tindakan]) ? $p["tindakan"][$data->id_tindakan] : 0;
                    $jml_inap = isset($p_inap["tindakan"][$data->id_tindakan]) ? $p_inap["tindakan"][$data->id_tindakan] : 0;
                    if ($tindakan!="all"){
                        if ($tindakan==$data->id_tindakan){
                            if ($jml>0 || $jml_inap>0){
                                $hide = "class='punya text-bold'";
                            } else {
                                $hide = "class='hide' style='display : none;'";
                            }
                        } else {
                            $hide = "class='hide' style='display : none;'";
                        }
                    } else {
                        if ($jml>0 || $jml_inap>0){
                            $hide = "class='punya text-bold'";
                        } else {
                            $hide = "class='hide' style='display : none;'";
                        }
                    }
                echo "<tr ".$hide." tindakan='".$data->id_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                    echo "<td class='text-right'>".($i++)."</td>";
                    echo "<td>".$data->nama_tindakan."</td>";
                    //ralan
                    echo "<td class='text-right'>".(isset($p["DR"][$data->id_tindakan]) ? $p["DR"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p["MANUAL"][$data->id_tindakan]) ? $p["MANUAL"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p["EKS"][$data->id_tindakan]) ? $p["EKS"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0)."</td>";
                    $jumlah_ralan = (isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0)+
                    (isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0)+
                    (isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0)+
                    (isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0);
                    $eks_ralan += (isset($p["EKS"][$data->id_tindakan]) ? $p["EKS"][$data->id_tindakan] : 0);
                    $dr_ralan += (isset($p["DR"][$data->id_tindakan]) ? $p["DR"][$data->id_tindakan] : 0);
                    $manual_ralan += (isset($p["MANUAL"][$data->id_tindakan]) ? $p["MANUAL"][$data->id_tindakan] : 0);
                    $dinas_ralan += (isset($p["DINAS"][$data->id_tindakan]) ? $p["DINAS"][$data->id_tindakan] : 0);
                    $umum_ralan += (isset($p["UMUM"][$data->id_tindakan]) ? $p["UMUM"][$data->id_tindakan] : 0);
                    $bpjs_ralan += (isset($p["BPJS"][$data->id_tindakan]) ? $p["BPJS"][$data->id_tindakan] : 0);
                    $prsh_ralan += (isset($p["PRSH"][$data->id_tindakan]) ? $p["PRSH"][$data->id_tindakan] : 0);
                    echo "<td class='text-right'>".$jumlah_ralan."</td>";
                    //inap
                    echo "<td class='text-right'>".(isset($p_inap["DR"][$data->id_tindakan]) ? $p_inap["DR"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p_inap["MANUAL"][$data->id_tindakan]) ? $p_inap["MANUAL"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p_inap["PEMERIKSAAN"][$data->id_tindakan]) ? $p_inap["PEMERIKSAAN"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p_inap["DINAS"][$data->id_tindakan]) ? $p_inap["DINAS"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p_inap["UMUM"][$data->id_tindakan]) ? $p_inap["UMUM"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p_inap["BPJS"][$data->id_tindakan]) ? $p_inap["BPJS"][$data->id_tindakan] : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p_inap["PRSH"][$data->id_tindakan]) ? $p_inap["PRSH"][$data->id_tindakan] : 0)."</td>";
                    $jumlah_inap = (isset($p_inap["DINAS"][$data->id_tindakan]) ? $p_inap["DINAS"][$data->id_tindakan] : 0)+
                    (isset($p_inap["UMUM"][$data->id_tindakan]) ? $p_inap["UMUM"][$data->id_tindakan] : 0)+
                    (isset($p_inap["BPJS"][$data->id_tindakan]) ? $p_inap["BPJS"][$data->id_tindakan] : 0)+
                    (isset($p_inap["PRSH"][$data->id_tindakan]) ? $p_inap["PRSH"][$data->id_tindakan] : 0);
                    $eks_inap += (isset($p_inap["PEMERIKSAAN"][$data->id_tindakan]) ? $p_inap["PEMERIKSAAN"][$data->id_tindakan] : 0);
                    $dr_inap += (isset($p_inap["DR"][$data->id_tindakan]) ? $p_inap["DR"][$data->id_tindakan] : 0);
                    $manual_inap += (isset($p_inap["MANUAL"][$data->id_tindakan]) ? $p_inap["MANUAL"][$data->id_tindakan] : 0);
                    $dinas_inap += (isset($p_inap["DINAS"][$data->id_tindakan]) ? $p_inap["DINAS"][$data->id_tindakan] : 0);
                    $umum_inap += (isset($p_inap["UMUM"][$data->id_tindakan]) ? $p_inap["UMUM"][$data->id_tindakan] : 0);
                    $bpjs_inap += (isset($p_inap["BPJS"][$data->id_tindakan]) ? $p_inap["BPJS"][$data->id_tindakan] : 0);
                    $prsh_inap += (isset($p_inap["PRSH"][$data->id_tindakan]) ? $p_inap["PRSH"][$data->id_tindakan] : 0);
                    echo "<td class='text-right'>".$jumlah_inap."</td>";
                    echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                echo "</tr>";
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
