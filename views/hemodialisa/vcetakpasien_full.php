<script>
    $(document).ready(function() {
        window.print();
    });
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <h4 align="center">LAPORAN PASIEN PEMERIKSAAN HAEMODIALISA<br>
    Periode Tanggal : <?php echo $tgl1." - ".$tgl2?></h4>
    
    <?php 
        $pemeriksaan = "Pemeriksaan : ".$t2->nama_tindakan;
        echo $pemeriksaan; ?>
    <br>
    <div class="table-responsive">
        <table cellspacing="0" cellpadding="2" border="1" width="100%">
                    <thead>
                        <tr class="bg-navy">
                            <th class="text-center">Nomor REG</th>
                            <th class="text-center">Nomor RM</th>
                            <th>Nama</th>
                            <th class="text-center">Tgl Periksa</th>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Kamar</th>
                            <th class="text-center">Dokter Pengirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                foreach ($q["list"] as $value) {
                                    $master = ($q["master"][$value->no_reg]);
                                    $pol = ($q["pol"][$value->no_reg]);
                                    $ruangan = ($q["ruangan"][$value->no_reg]);
                                    $kelas = ($q["kelas"][$value->no_reg]);
                                    $kamar = ($q["kamar"][$value->no_reg]);
                                    $dokter = ($q["dokter"][$value->no_reg]);
                                    echo"
                                        <tr id=data>
                                        <td class='text-center'>".$value->no_reg."</td>
                                        <td class='text-center'>".$value->no_pasien."</td>
                                        <td>".$master->nama_pasien."</td>
                                        <td class='text-center'>".$value->tanggal."</td>
                                        <td class='text-center'>".($pol->keterangan == "undefined" || $pol->keterangan == "" ? "" : $pol->keterangan).($ruangan->nama_ruangan == "undefined" || $ruangan->nama_ruangan == "" ? "" : $ruangan->nama_ruangan)."</td>
                                        <td class='text-center'>".($kelas->nama_kelas == "undefined" || $kelas->nama_kelas == ""  ? "-" : $kelas->nama_kelas)."</td>
                                        <td class='text-center'>".($kamar->nama_kamar == "undefined" || $kamar->nama_kamar == ""  ? "-" : $kamar->nama_kamar)."</td>
                                        <td class='text-center'>".$dokter->nama_dokter."</td>
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
