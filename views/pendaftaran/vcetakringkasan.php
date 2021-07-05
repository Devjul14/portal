<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
</head>
<script>
    $(document).ready(function(){
        var dokter_jaga = "<?php echo $dokter[$pi->dokter];?>";
        getttd(".dokter_jaga",dokter_jaga);
        var dokter_ruangan = "<?php echo $dokter[$pi->dokter_ruangan];?>";
        getttd(".dokter_ruangan",dokter_ruangan);
        var dokter_dpjp = "<?php echo $dokter[$pi->dpjp];?>";
        getttd(".dokter_dpjp",dokter_dpjp);
        // window.print();
    });
    function getttd(element,kode){
        var ttd = "<?php echo site_url('ttddokter/getttddokterlab');?>/"+kode;
        $(element).qrcode({width: 80,height: 80, text:ttd});
    }
</script>
<p align="right" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <small>RM 01//RI/RSC</small>
</p>
<?php
    $t1 = new DateTime('today');
    $t2 = new DateTime($p->tgl_lahir);
    $y  = $t1->diff($t2)->y;
    $m  = $t1->diff($t2)->m;
    $d  = $t1->diff($t2)->d;
    $tgl1 = new DateTime($pi->tgl_masuk);
    $tgl2 = new DateTime('today');
    $rawat = $tgl2->diff($tgl1)->days+1;
?>
<table class="laporan" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" style="vertical-align:middle">
            <img src="<?php echo base_url("img/Logo.png")?>"><br><b>RS CIREMAI</b>
        </td>
        <td align="center" style="vertical-align: middle;">
            <h4>RINGKASAN<br>MASUK DAN KELUAR</h4>
        </td>
        <td colspan="3">
            <table class="no-border" width=100%>
                <tr>
                    <td>No. Rekam Medis</td>
                    <td><?php echo $no_rm;?></td>
                </tr>
                <tr>
                    <td>No. Registrasi</td>
                    <td><?php echo $no_reg;?></td>
                </tr>
                <tr>
                    <td>Dirawat yang ke</td>
                    <td><?php echo $dirawatke;?></td>
                </tr>
                <tr>
                    <td>Ruang/ Kelas/ Kamar</td>
                    <td>
                        <?php
                            $i = 1;
                            foreach ($lp->result() as $key) {
                                echo ($i++).". ".$key->nama_ruangan."/ ".$key->nama_kelas."/ ".$key->kode_kamar_lama."-".$key->no_bed_lama."<br>";
                            }
                            echo ($i++).". ".$pi->nama_ruangan."/ ".$pi->nama_kelas."/ ".$pi->kode_kamar."-".$pi->no_bed."<br>";
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <table class="no-border" width=100%>
                <tr>
                    <td>Nama Pasien</td><td>:</td><td><?php echo $p->nama_pasien;?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir/ Umur</td><td>:</td><td><?php echo date("d-m-Y",strtotime($p->tgl_lahir))."/ ".$y." tahun";?></td>
                </tr>
                <tr>
                    <td>Agama</td><td>:</td><td><?php echo $p->agama;?></td>
                </tr>
                <tr>
                    <td>Status Kawin</td><td>:</td><td><?php echo $p->status_kawin;?></td>
                </tr>
                <tr>
                    <td>Kebangsaan</td><td>:</td><td><?php echo $p->negara;?></td>
                </tr>
                <tr>
                    <td>Gol. Darah</td><td>:</td><td><?php echo $p->gol;?></td>
                </tr>
                <tr>
                    <td>Gol. Pasien</td><td>:</td><td><?php echo $p->keterangan;?></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="no-border" width=100%>
                <tr>
                    <td>Pekerjaan</td><td>:</td><td><?php echo $p->pekerjaan;?></td>
                </tr>
                <tr>
                    <td>Pangkat</td><td>:</td><td><?php echo $p->pangkat;?></td>
                </tr>
                <tr>
                    <td>NRP/ NIP</td><td>:</td><td><?php echo $p->nip;?></td>
                </tr>
                <tr>
                    <td>No. BPJS</td><td>:</td><td><?php echo $p->no_bpjs;?></td>
                </tr>
                <tr>
                    <td>Perusahaan</td><td>:</td><td><?php echo $p->nama_perusahaan;?></td>
                </tr>
                <tr>
                    <td>Alamat/ Kesatuan</td><td>:</td><td><?php echo $p->alamat."/ ".$p->kesatuan;?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <table class="no-border" width=100%>
                <tr>
                    <td colspan="3">Nama Orang Tua/ Keluarga terdekat : <?php echo $p->nama_pasangan;?></td>
                </tr>
                <tr>
                    <td width="100px">Pekerjaan</td><td>:</td><td><?php echo ($p->pekerjaan_ayah=="" ? "-" : $p->pekerjaan_ibu);?></td>
                </tr>
                <tr>
                    <td>Alamat</td><td>:</td><td><?php echo $p->alamat;?></td>
                </tr>
                <tr>
                    <td>No. Telepon</td><td>:</td><td><?php echo $p->telpon;?></td>
                </tr>
            </table>
        </td>
        <td style="padding:0px">
            <table class="no-border" width=100%>
                <tr>
                    <td>Cara Masuk RS/ Rujukan</td><td>:</td><td><?php echo $pi->cara_masuk;?></td>
                </tr>
                <tr>
                    <td>Tanggal/ Jam Masuk</td><td>:</td><td><?php echo date("d-m-Y",strtotime($pi->tgl_masuk))." / Jam : ".$pi->jam_masuk;?></td>
                </tr>
                <tr>
                    <td>Tanggal/ Jam Keluar</td><td>:</td><td><?php echo ($pi->tgl_keluar=="" ? "-" : date("d-m-Y",strtotime($pi->tgl_keluar))." / Jam : ".$pi->jam_keluar);?></td>
                </tr>
                <tr>
                    <td>Lama dirawat</td><td>:</td><td><?php echo $rawat;?> hari</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan=3>
            Kejadian infeksi selama perawatan di RS :
            <ul>
            <?php
                foreach ($inos->result() as $key) {
                    echo "<li>".$key->keterangan."</li>";
                }
                if ($inos->num_rows()<=0) {
                    echo "<li>Nihil</li>";
                }
            ?>
            </ul>
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <b>Diagnosis Sementara</b>
            <p><?php echo $ad->a;?></p>
        </td>
        <td align="center">
            Dokter Jaga/ Poliklinik
            <br>
            <span class="dokter_jaga"></span>
            <br>
            <?php echo $dokter[$pi->dokter];?>
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <ul>
                <?php
                    echo "<li><b>Diagnosis Utama</b> : ". ($rp->diagnosa_akhir=="" ? "" : $rp->diagnosa_akhir)."</li>";
                    echo "<li><b>Diagnosis Sekunder</b> : ". ($rp->diagnosa_tambahan=="" ? "" : $rp->diagnosa_tambahan)."</li>";
                    echo "<li><b>Komplikasi</b> : ". ($rp->komplikasi=="" ? "" : $rp->komplikasi)."</li>";
                ?>
            </ul>
        </td>
        <td align="center">
            Kode ICD-10<br>
            <div style="float:left">
            <ul>
                <?php
                    foreach ($icd10->result() as $key) {
                        echo "<li>".$key->kode."</li>";
                    }
                ?>
            </ul>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <b>Operasi/ Tindakan</b> : <?php echo $oka->nama_operasi;?>
        </td>
        <td align="center">
            Kode ICD-9 CM<br>
            <div style="float:left">
            <ul>
                <?php
                    foreach ($icd9->result() as $key) {
                        echo "<li>".$key->kode."</li>";
                    }
                ?>
            </ul>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan=3>Keadaan Pulang : <?php echo $pi->keadaan_pulang;?></td>
    </tr>
    <tr>
        <td colspan=3>Ijin Keluar : <?php echo $pi->status_pulang;?></td>
    </tr>
    <tr>
        <td colspan=3>Keterangan : <br><?php echo $pi->status_pulang;?></td>
    </tr>
    <tr>
        <td align='center'>
            Dokter Ruangan
            <br>
            <span class="dokter_ruangan"></span>
            <br>
            <?php echo $dokter[$pi->dokter_ruangan];?>
        </td>
        <td align='center'>
            Dokter ahli yang merawat<br>
            <div style="float:left">
            <ol style="text-align:left">
                <?php
                    $dk = array();
                    foreach($d_ahli->result() as $row){
                        if ($row->kode_petugas!=$pi->dpjp){
                          if (!isset($dk[$row->kode_petugas])){
                            echo "<li>".$dokter[$row->kode_petugas]."</li>";
                          }
                          $dk[$row->kode_petugas] = $row->kode_petugas;
                        }
                    }
                ?>
            </ol>
            </div>
        </td>
        <td align='center'>
            Dokter Penanggung Jawab Pasien
            <br>
            <span class="dokter_dpjp"></span>
            <br>
            <?php echo $dokter[$pi->dpjp];?>
        </td>
    </tr>
</table>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        border-spacing: 0px;
        width: 100%;
        max-width: 100%;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    .laporan > thead > tr > th,
    .laporan > tbody > tr > th,
    .laporan > tfoot > tr > th,
    .laporan > thead > tr > td,
    .laporan > tbody > tr > td,
    .laporan > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .laporan > caption + thead > tr:first-child > th,
    .laporan > colgroup + thead > tr:first-child > th,
    .laporan > thead:first-child > tr:first-child > th,
    .laporan > caption + thead > tr:first-child > td,
    .laporan > colgroup + thead > tr:first-child > td,
    .laporan > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .laporan td,
    .laporan th {
        padding: 0px;
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }
    .no-border {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    .no-border > thead > tr > th,
    .no-border > tbody > tr > th,
    .no-border > tfoot > tr > th,
    .no-border > thead > tr > td,
    .no-border > tbody > tr > td,
    .no-border > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 2px solid #ddd;
    }
    .no-border > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .no-border > caption + thead > tr:first-child > th,
    .no-border > colgroup + thead > tr:first-child > th,
    .no-border > thead:first-child > tr:first-child > th,
    .no-border > caption + thead > tr:first-child > td,
    .no-border > colgroup + thead > tr:first-child > td,
    .no-border > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .no-border > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .no-border td,
    .no-border th {
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }

</style>
</html>
