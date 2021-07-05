<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 align="center">LAPORAN PASIEN PEMERIKSAAN RADIOLOGI RAWAT JALAN DAN RAWAT INAP<br>
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
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Kamar</th>
                            <th class="text-center">Dokter Pengirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($q as $value) {
                                $no_antrian = $value->no_antrian;
                                $no_pasien = $value->no_pasien;
                                $nama_poli = $value->nama_poli;
                                $nama_ruangan = $value->nama_ruangan;
                                $nama_kelas = $value->nama_kelas;
                                $nama_kamar = $value->nama_kamar;
                                echo"
                                    <tr id=data>
                                    <td class='text-center'>".($no_antrian == "undefined" || $no_antrian == ""  ? "-" : $no_antrian)."</td>
                                    <td class='text-center'>".$value->no_reg."</td>
                                    <td class='text-center'>".($no_pasien == "undefined" || $no_pasien == ""  ? "-" : $no_pasien)."</td>
                                    <td>".$value->nama_pasien."</td>
                                    <td>".$value->tanggal."</td>
                                    <td>".$value->pemeriksaan."</td>
                                    <td>".($nama_poli == "undefined" || $nama_poli == ""  ? "-" : $nama_poli)."</td>
                                    <td>".($nama_ruangan == "undefined" || $nama_ruangan == "" ? "-" : $nama_ruangan)."</td>
                                    <td>".($nama_kelas == "undefined" || $nama_kelas == "" ? "-" : $nama_kelas)."</td>
                                    <td>".($nama_kamar == "undefined" || $nama_kamar == "" ? "-" : $nama_kamar)."</td>
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
