<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 align="center">REKAP OKA<br>
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
                    <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                </tr>
                <tr class='bg-navy'>
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
                    $dinas = $umum = $bpjs = $prsh = 0;
                    foreach($t->result() as $data){
                        if ($tindakan!="all"){
                            if ($tindakan==$data->kode){
                                $hide = "";
                            } else {
                                $hide = "class='hide'";
                            }
                        } else {
                            $jml = isset($p["tindakan"][$data->kode]) ? $p["tindakan"][$data->kode] : 0;
                            if ($jml>0){
                                $hide = "class='bg-blue text-bold'";
                            } else {
                                $hide = "";
                            }
                        }
                        echo "<tr ".$hide." tindakan='".$data->kode."' nama_tindakan='".$data->nama_tindakan."'>";
                        echo "<td class='text-right'>".($i++)."</td>";
                        echo "<td>".$data->nama_tindakan."</td>";
                        echo "<td class='text-right'>".(isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0)."</td>";
                        $jumlah = (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)+
                                  (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)+
                                  (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)+
                                  (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                        $dinas += (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0);
                        $umum += (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0);
                        $bpjs += (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0);
                        $prsh += (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
                        echo "<td class='text-right'>".$jumlah."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class='bg-navy'>
                    <th colspan="2">Jumlah Pasien</th>
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
        <div align="right"> OKA</div>
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
