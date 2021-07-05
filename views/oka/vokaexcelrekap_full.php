<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rekap_Oka_Full".date('YmdHis').".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 style="margin-left: 250px; width: 25cm;" align="center">LAPORAN PEMERIKSAAN OKA RAWAT JALAN DAN RAWAT INAP <br>
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
            </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $hide = "";
                            $eks_ralan = $dr_ralan = $manual_ralan = $dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                            $eks_inap = $dr_inap = $manual_inap = $dinas__inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
                            // foreach($t->result() as $data){
                            foreach($t["kode"] as $data){    
                                $jml = isset($p["tindakan"][$data->kode]) ? $p["tindakan"][$data->kode] : 0;
                                $jml_inap = isset($p_inap["tindakan"][$data->kode]) ? $p_inap["tindakan"][$data->kode] : 0;
                                if ($tindakan!="all"){
                                    if ($tindakan==$data->kode){
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
                                echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode."' nama_tindakan='".$data->nama_tindakan."'>";
                                echo "<td class='text-right'>".($i++)."</td>";
                                echo "<td>".$data->nama_tindakan."</td>";
                                //ralan
                                // echo "<td class='text-right'>".(isset($p["DR"][$data->kode_tindakan]) ? $p["DR"][$data->kode_tindakan] : 0)."</td>";
                                // echo "<td class='text-right'>".(isset($p["MANUAL"][$data->kode_tindakan]) ? $p["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                                // echo "<td class='text-right'>".(isset($p["EKS"][$data->kode_tindakan]) ? $p["EKS"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0)."</td>";
                                $jumlah_ralan = (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)+
                                          (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)+
                                          (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)+
                                          (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                                // $eks_ralan += (isset($p["EKS"][$data->kode_tindakan]) ? $p["EKS"][$data->kode_tindakan] : 0);
                                // $dr_ralan += (isset($p["DR"][$data->kode_tindakan]) ? $p["DR"][$data->kode_tindakan] : 0);
                                // $manual_ralan += (isset($p["MANUAL"][$data->kode_tindakan]) ? $p["MANUAL"][$data->kode_tindakan] : 0);
                                $dinas_ralan += (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0);
                                $umum_ralan += (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0);
                                $bpjs_ralan += (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0);
                                $prsh_ralan += (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                                echo "<td class='text-right'>".$jumlah_ralan."</td>";
                                //inap
                                // echo "<td class='text-right'>".(isset($p_inap["DR"][$data->kode_tindakan]) ? $p_inap["DR"][$data->kode_tindakan] : 0)."</td>";
                                // echo "<td class='text-right'>".(isset($p_inap["MANUAL"][$data->kode_tindakan]) ? $p_inap["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                                // echo "<td class='text-right'>".(isset($p_inap["PEMERIKSAAN"][$data->kode_tindakan]) ? $p_inap["PEMERIKSAAN"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["DINAS"][$data->kode]) ? $p_inap["DINAS"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0)."</td>";
                                $jumlah_inap = (isset($p_inap["DINAS"][$data->kode]) ? $p_inap["DINAS"][$data->kode] : 0)+
                                          (isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0)+
                                          (isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0)+
                                          (isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0);
                                // $eks_inap += (isset($p_inap["PEMERIKSAAN"][$data->kode]) ? $p_inap["PEMERIKSAAN"][$data->kode] : 0);
                                // $dr_inap += (isset($p_inap["DR"][$data->kode]) ? $p_inap["DR"][$data->kode] : 0);
                                // $manual_inap += (isset($p_inap["MANUAL"][$data->kode]) ? $p_inap["MANUAL"][$data->kode] : 0);
                                $dinas_inap += (isset($p_inap["DINAS"][$data->kode]) ? $p_inap["DINAS"][$data->kode] : 0);
                                $umum_inap += (isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0);
                                $bpjs_inap += (isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0);
                                $prsh_inap += (isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0);
                                echo "<td class='text-right'>".$jumlah_inap."</td>";
                                echo "<td class='text-right'>".($jumlah_ralan+$jumlah_inap)."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                            <th colspan="2">Jumlah Pasien</th>
                            <!-- <th class="text-right"><?php echo $dr_ralan;?></th>
                            <th class="text-right"><?php echo $manual_ralan;?></th>
                            <th class="text-right"><?php echo $eks_ralan;?></th> -->
                            <th class="text-right"><?php echo $dinas_ralan;?></th>
                            <th class="text-right"><?php echo $umum_ralan;?></th>
                            <th class="text-right"><?php echo $bpjs_ralan;?></th>
                            <th class="text-right"><?php echo $prsh_ralan;?></th>
                            <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
                            <!-- <th class="text-right"><?php echo $dr_inap;?></th>
                            <th class="text-right"><?php echo $manual_inap;?></th>
                            <th class="text-right"><?php echo $eks_inap;?></th> -->
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
        <div align="right">OKA</div>
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
