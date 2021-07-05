<!DOCTYPE html>
<html>

<head>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cetak Inap</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/print.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/AdminLTE.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/defaultTheme.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/select2/select2.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/skins/_all-skins.min.css">
        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.fixedheadertable.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
        <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />

    </head>
    <script>
        // window.print();
    </script>
    <title></title>
</head>

<body>
    <table width="100%" align="right">
        <tr>
            <td>
                <h3>
                    RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON
                </h3>
            </td>
        </tr>
    </table>

    <table width="100%" align="right" border="1">
        <tr>
            <td>
                <table width="100%" align="right" border="0">
                    <tr>
                        <td colspan="2">
                            <h4>REKAM MEDIS RAWAT INAP</h4>
                        </td>
                        <td width="25%">
                            <h4>No. REKAM MEDIS</h4>
                        </td>
                        <td>
                            <h4>: <?php echo $q2->no_rm ?></h4>
                        </td>
                    </tr>

                    <tr>
                        <td>Perawatan Ke </td>
                        <td width="25%">:&nbsp;</td>
                        <td>
                            <h4>No REGISTRASI </h4>
                        </td>
                        <td width="25%">
                            <h4>:&nbsp;<?php echo $no_reg ?></h4>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="right">
                    <tr>
                        <?php
                        $t1 = new DateTime('today');
                        $t2 = new DateTime($q->tgl_lahir);
                        $y  = $t1->diff($t2)->y;
                        $m  = $t1->diff($t2)->m;
                        $d  = $t1->diff($t2)->d;

                        ?>
                        <td width="25%">Nama Pasien </td>
                        <td width="25%"> :&nbsp;<?php echo $q1->nama_pasien ?></td>
                        <td width="25%">Umur </td>
                        <td width="25%"> :&nbsp;<?php echo date("d-m-Y", strtotime($q->tgl_lahir)) . "&nbsp;(" . $y . ' tahun ' . $m . ' bulan ' . $d . ' hari' . ")" ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="right" border="0">
                    <tr>
                        <td>Jenis Kelamin </td>
                        <td width="25%"> :&nbsp;<?php echo $q3->jenis_kelamin ?></td>
                        <td>Status Kawin </td>
                        <td width="25%"> :&nbsp;<?php echo $q1->status_kawin ?></td>
                    </tr>
                    <tr>
                        <td>Suku Bangsa </td>
                        <td width="25%"> :&nbsp;<?php echo $q2->negara ?> / <?php echo $q->suku ?></td>
                        <td>Agama </td>
                        <td width="25%"> :&nbsp;<?php echo $q->agama ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan </td>
                        <td width="25%"> :&nbsp;<?php echo $q->pekerjaan ?></td>
                        <td>Pendidikan </td>
                        <td width="25%"> :&nbsp;<?php echo $q->pendidikan ?></td>
                    </tr>
                    <tr>
                        <td>Nama Suami / Ayah </td>
                        <td width="25%"> :&nbsp;<?php echo $q->nama_pasangan; ?></td>
                        <td>Nama Istri / Ibu </td>
                        <td width="25%"> :&nbsp;<?php echo $q->ibu; ?></td>
                    </tr>
                    <tr>
                        <td>Golongan Pasien </td>
                        <td width="25%"> :&nbsp;<?php echo $q->golpas ?></td>
                        <td>Pangkat </td>
                        <td width="25%"> :&nbsp;<?php echo $q->nama_pangkat ?></td>
                    </tr>
                    <tr>
                        <td width="25%"> &nbsp;</td>
                        <td width="25%"> &nbsp;</td>
                        <td>No. Askes </td>
                        <td width="25%"> :&nbsp;<?php echo $q->no_bpjs ?></td>
                    </tr>
                    <tr>
                        <td width="25%"> &nbsp;</td>
                        <td width="25%"> &nbsp;</td>
                        <td>NRP/NBI/NIP </td>
                        <td width="25%"> :&nbsp;<?php echo $q->nip ?></td>
                    </tr>
                    <tr>
                        <td width="25%"> &nbsp;</td>
                        <td width="25%"> &nbsp;</td>
                        <td>Perusahaan</td>
                        <td width="25%"> :&nbsp;<?php echo $q->nama_perusahaan ?></td>
                    </tr>
                    <tr>
                        <td>Alamat / Kesatuan </td>
                        <td colspan="3" width="25%"> :&nbsp;<?php echo $q->alamat ?></td>

                    </tr>
                    <tr>
                        <td>Kecamatan </td>
                        <td width="25%"> :&nbsp; <?php echo $q->nama_kecamatan ?></td>
                        <td>Kota / Kabupaten </td>
                        <td width="25%"> :&nbsp; <?php echo $q->nama_kota ?></td>
                    </tr>
                    <tr>
                        <td>Provinsi </td>
                        <td width="25%"> :&nbsp; <?php echo $q->nama_provinsi ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="right">
                    <tr>
                        <td width="25%">Tanggal Masuk </td>
                        <td width="25%"> :&nbsp;<?php echo $q->tanggal ?></td>
                        <td width="25%">Golongan Askes </td>
                        <td width="25%"> :&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Jam Masuk </td>
                        <td width="25%"> :&nbsp;<?php echo $q->jam_masuk ?></td>
                        <td>Hak Kelas </td>
                        <td width="25%"> :&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kelas </td>
                        <td width="25%"> :&nbsp;<?php echo $q->nama_kelas ?></td>
                        <td>Selisih Askes </td>
                        <td width="25%"> :&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Ruangan </td>
                        <td width="25%"> :&nbsp;<?php echo $q->nama_ruangan ?></td>
                        <td>Tanggal Keluar </td>
                        <td width="25%"> :&nbsp;</td>
                    </tr>
                    <tr>
                        <td>No. Kamar </td>
                        <td width="25%"> :&nbsp;<?php echo $q->nama_kamar ?></td>
                        <td>Jam Keluar </td>
                        <td width="25%"> :&nbsp;</td>
                    </tr>
                    <tr>
                        <td>No Bed </td>
                        <td width="25%"> :&nbsp;<?php echo $q->no_bed ?> </td>
                        <td></td>
                        <td width="25%"> &nbsp;</td>
                    </tr>

                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table width="100%" align="right">
                    <tr>
                        <td>Prosedur Masuk </td>
                        <td width="25%"> :&nbsp;<?php echo $q->prosedur_masuk ?></td>
                        <td>Cara Masuk </td>
                        <td width="25%"> :&nbsp;<?php echo $q->cara_masuk ?></td>
                    </tr>
                    <tr>
                        <td width="25%"> &nbsp;</td>
                        <td width="25%"> &nbsp;</td>
                        <td>Pengirim </td>
                        <td width="25%"> :&nbsp;<?php echo $q->pengirim ?></td>
                    </tr>
                    <tr>
                        <td width="25%"> &nbsp;</td>
                        <td width="25%"> &nbsp;</td>
                        <td width="25%">Dokter </td>
                        <td width="25%"> :&nbsp;<?php echo $q->nama_dokter ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>

                <table width="100%" align="right">
                    <tr>
                        <td width="25%">Diagnosa Masuk </td>
                        <td width="25%"> :&nbsp;<?php echo $q->mcd_nama ?></td>
                        <td width="25%"> &nbsp;</td>
                        <td width="25%"> &nbsp;</td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="right">
                    <tr>
                        <td width="25%">Alergi Terhadap </td>
                        <td width="25%"> :&nbsp;<?php echo $q->alergi ?></td>
                        <td></td>
                        <td width="25%"> &nbsp;</td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="right">
                    <tr>
                        <td rowspan="2">Keterangan </td>
                        <td rowspan="2" colspan="4" width="25%"> :&nbsp;</td>
                        <td></td>
                        <td width="25%"> &nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="25%"> &nbsp;</td>
                        <td></td>
                        <td width="25%"> &nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="right">
                    <tr>
                        <td rowspan="2">Catatan Pasien </td>
                        <td rowspan="2" colspan="4" width="25%"> :&nbsp;</td>
                        <td><?php echo $q->catatan_pasien; ?></td>
                        <td width="25%"> &nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="25%"> &nbsp;</td>
                        <td></td>
                        <td width="25%"> &nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" align="right">
                    <tr>
                        <td width="25%">Penanggung Jawab </td>
                        <td width="25%"> :&nbsp; <?php echo $q->penanggung_jawab ?></td>
                        <td width="25%">No Hp </td>
                        <td width="25%"> : <?php echo $q->telepon_pj ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <table width="100%" align="right">
            <tr>
                <td width="10%">&nbsp;</td>
                <td>Tgl.Cetak <?php echo date("d/m/Y His") . " (" . $this->session->userdata("username") . ")"; ?></td>
            </tr>
        </table>
</body>

</html>