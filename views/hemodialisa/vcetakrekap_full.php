<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4  align="center">LAPORAN PEMERIKSAAN PATOLOGI ANATOMI
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
                            <th class="text-center" style="vertical-align: middle" colspan="7">Rawat Jalan</th>
                            <th class="text-center" style="vertical-align: middle" colspan="5">Rawat inap</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="3">Total</th>
                        </tr>
                        <tr class='bg-navy'>

                            <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th class="text-center">BARU</th>
                            <th class="text-center">LAMA</th>
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
                            $baru_ralan = $lama_ralan = $dr_ralan = $manual_ralan = $dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
                            $dr_inap = $manual_inap = $dinas__inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
                            foreach($t->result() as $data){
                                $jml = isset($p["tindakan"]["0102026"]) ? $p["tindakan"]["0102026"] : 0;
                                $jml_inap = isset($p_inap["tindakan"][$data->kode_tindakan]) ? $p_inap["tindakan"][$data->kode_tindakan] : 0;
                                // if ($tindakan!="all"){
                                //     if ($tindakan==$data->kode_tindakan){
                                //         if ($jml>0 || $jml_inap>0){
                                //             $hide = "class='punya text-bold'";
                                //         } else {
                                //             $hide = "class='hide'";
                                //         }
                                //     } else {
                                //         $hide = "class='hide'";
                                //     }
                                // } else {
                                //     if ($jml>0 || $jml_inap>0){
                                //         $hide = "class='punya text-bold'";
                                //     } else {
                                //         $hide = "class='hide'";
                                //     }
                                // }
                                if ($jml>0 || $jml_inap>0) {
                                    $hide = "class='punya text-bold'";
                                } else {
                                    $hide = "class='hide'";
                                }
                                echo "<tr jml='".$jml."' jml_inap='".$jml_inap."' id='data' ".$hide." tindakan='".$data->kode_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                                echo "<td class='text-right'>".($i++)."</td>";
                                echo "<td>".$data->nama_tindakan."</td>";
                                //ralan
                                echo "<td class='text-right'>".(isset($p["BARU"]["0102026"]) ? $p["BARU"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["LAMA"]["0102026"]) ? $p["LAMA"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["DINAS"]["0102026"]) ? $p["DINAS"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["UMUM"]["0102026"]) ? $p["UMUM"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["BPJS"]["0102026"]) ? $p["BPJS"]["0102026"] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p["PRSH"][$data->kode_tindakan]) ? $p["PRSH"]["0102026"] : 0)."</td>";
                                $jumlah_ralan = (isset($p["DINAS"]["0102026"]) ? $p["DINAS"]["0102026"] : 0)+
                                          (isset($p["UMUM"]["0102026"]) ? $p["UMUM"]["0102026"] : 0)+
                                          (isset($p["BPJS"]["0102026"]) ? $p["BPJS"]["0102026"] : 0)+
                                          (isset($p["PRSH"]["0102026"]) ? $p["PRSH"]["0102026"] : 0);
                                $baru_ralan += (isset($p["BARU"]["0102026"]) ? $p["BARU"]["0102026"] : 0);
                                $lama_ralan += (isset($p["LAMA"]["0102026"]) ? $p["LAMA"]["0102026"] : 0);
                                $dinas_ralan += (isset($p["DINAS"]["0102026"]) ? $p["DINAS"]["0102026"] : 0);
                                $umum_ralan += (isset($p["UMUM"]["0102026"]) ? $p["UMUM"]["0102026"] : 0);
                                $bpjs_ralan += (isset($p["BPJS"]["0102026"]) ? $p["BPJS"]["0102026"] : 0);
                                $prsh_ralan += (isset($p["PRSH"]["0102026"]) ? $p["PRSH"]["0102026"] : 0);
                                echo "<td class='text-right'>".$jumlah_ralan."</td>";
                                //inap
                                // echo "<td class='text-right'>".(isset($p_inap["DR"][$data->kode_tindakan]) ? $p_inap["DR"][$data->kode_tindakan] : 0)."</td>";
                                // echo "<td class='text-right'>".(isset($p_inap["MANUAL"][$data->kode_tindakan]) ? $p_inap["MANUAL"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["DINAS"][$data->kode_tindakan]) ? $p_inap["DINAS"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["UMUM"][$data->kode_tindakan]) ? $p_inap["UMUM"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["BPJS"][$data->kode_tindakan]) ? $p_inap["BPJS"][$data->kode_tindakan] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($p_inap["PRSH"][$data->kode_tindakan]) ? $p_inap["PRSH"][$data->kode_tindakan] : 0)."</td>";
                                $jumlah_inap = (isset($p_inap["DINAS"][$data->kode_tindakan]) ? $p_inap["DINAS"][$data->kode_tindakan] : 0)+
                                          (isset($p_inap["UMUM"][$data->kode_tindakan]) ? $p_inap["UMUM"][$data->kode_tindakan] : 0)+
                                          (isset($p_inap["BPJS"][$data->kode_tindakan]) ? $p_inap["BPJS"][$data->kode_tindakan] : 0)+
                                          (isset($p_inap["PRSH"][$data->kode_tindakan]) ? $p_inap["PRSH"][$data->kode_tindakan] : 0);
                                // $dr_inap += (isset($p_inap["DR"][$data->kode_tindakan]) ? $p_inap["DR"][$data->kode_tindakan] : 0);
                                // $manual_inap += (isset($p_inap["MANUAL"][$data->kode_tindakan]) ? $p_inap["MANUAL"][$data->kode_tindakan] : 0);
                                $dinas_inap += (isset($p_inap["DINAS"][$data->kode_tindakan]) ? $p_inap["DINAS"][$data->kode_tindakan] : 0);
                                $umum_inap += (isset($p_inap["UMUM"][$data->kode_tindakan]) ? $p_inap["UMUM"][$data->kode_tindakan] : 0);
                                $bpjs_inap += (isset($p_inap["BPJS"][$data->kode_tindakan]) ? $p_inap["BPJS"][$data->kode_tindakan] : 0);
                                $prsh_inap += (isset($p_inap["PRSH"][$data->kode_tindakan]) ? $p_inap["PRSH"][$data->kode_tindakan] : 0);
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
                            <th class="text-right"><?php echo $dinas_ralan;?></th>
                            <th class="text-right"><?php echo $umum_ralan;?></th>
                            <th class="text-right"><?php echo $bpjs_ralan;?></th>
                            <th class="text-right"><?php echo $prsh_ralan;?></th>
                            <th class="text-right"><?php echo ($dinas_ralan+$umum_ralan+$bpjs_ralan+$prsh_ralan);?></th>
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
        <div align="right"> dr.Irwan, Sp.PD</div>
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
