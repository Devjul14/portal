<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 align="center">LAPORAN PASIEN PEMERIKSAAN RADIOLOGI RAWAT JALAN<br>
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
                        <tr class="bg-navy">
                            <th class="text-center">No. Antrian</th>
                            <th class="text-center">Nomor REG</th>
                            <th class="text-center">Nomor RM</th>
                            <th>Nama</th>
                            <th class="text-center">Tgl Periksa</th>
                            <th class="text-center">Pemeriksaan</th>
                            <th class="text-center">Poliklinik Pengirim</th>
                            <th class="text-center">Dokter Pengirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($q as $value) {
                                echo"
                                    <tr id=data>
                                    <td class='text-center'>".$value->no_antrian."</td>
                                    <td class='text-center'>".$value->no_reg."</td>
                                    <td class='text-center'>".$value->no_pasien."</td>
                                    <td>".$value->nama_pasien."</td>
                                    <td>".$value->tanggal."</td>
                                    <td>".$value->pemeriksaan."</td>
                                    <td>".$value->nama_poli."</td>
                                    <td>".$value->nama_dokter."</td>
                                    </tr>
                                ";
                            }

                        ?>
                    </tbody>
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
