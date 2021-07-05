<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/select2/select2.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url(); ?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url(); ?>js/html2canvas.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.watermark.js"></script>
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
</head>
<script>
    $(document).ready(function() {
        getttd_saksi();
        getttd_pernyataan();
        getttd_prm();
        $('img.watermark').watermark({
            text: 'GOOGLE.COM',
            textWidth: 100
        });
        window.print();
    });

    function getttd_prm() {
        var ttd = "<?php echo site_url('ttddokter/getttdprm/' . $q2->petugas_rm); ?>";
        $('.getttd_prm').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
    }

    function getttd_saksi() {
        var ttd = "<?php echo site_url('persetujuan/getttd_saksi/' . $no_reg . '/' . $no_pasien); ?>";
        $('.getttd_saksi').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
    }

    function getttd_pernyataan() {
        var ttd = "<?php echo site_url('persetujuan/getttd_pernyataan/' . $no_reg . '/' . $no_pasien); ?>";
        $('.getttd_pernyataan').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
    }
</script>
<?php if ($status == "copied") : ?>
    <img src="<?php echo base_url() . "/img/watermark.png"; ?>" class="watermark">
<?php endif ?>
<?php
function tgl($tgl, $tipe)
{
    $month = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $xmonth = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des");
    $hari = substr($tgl, 0, 10);
    $jam = substr($tgl, 11, 5);
    $m = (int)(substr($tgl, 5, 2));
    $tmp = substr($tgl, 8, 2) . " " . $month[$m] . " " . substr($tgl, 0, 4);
    if ($tipe == 1) {
        $tmp = $tmp . " - " . $jam;
    } elseif ($tipe == 2) {
        $tmp = $tmp;
    }
    if (substr($tgl, 0, 4) == '0000') {
        return "";
    } else {
        return $tmp;
    }
}


$t1 = new DateTime('today');
$t2 = new DateTime($q->tgl_lahir);
$y  = $t1->diff($t2)->y;
$m  = $t1->diff($t2)->m;
$d  = $t1->diff($t2)->d;

list($year, $month, $day) = explode("-", $q->tgl_lahir);
$year_diff  = date("Y") - $year;
$month_diff = date("m") - $month;
$day_diff   = date("d") - $day;
if ($month_diff < 0) {
    $year_diff--;
    $month_diff *= (-1);
} elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
if ($day_diff < 0) {
    $day_diff *= (-1);
}
$umur = $year_diff;

$pernyataan     = explode(",", $q2->pernyataan);
$pernyataan0    = $pernyataan[0];
$pernyataan1    = $pernyataan[1];
$pernyataan2    = $pernyataan[2];
$pernyataan3    = $pernyataan[3];
$pernyataan4    = $pernyataan[4];
?>
<h5>
    <b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI<br>
        <u>DETASEMEN KESEHATAN WILAYAH 03.04.03</u>
    </b>
</h5>
<table class="laporan2" border="1" align="center">
    <tr>
        <td>
            <h4><b>SURAT KETERANGAN KELAHIRAN</b></h4>
        </td>
        <td>No. Rekam Medis :</td>
    </tr>
    <tr>
        <td>
            <p align="left">
                <?php $bulan = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"); ?>
                Nomor : <?php echo $q2->nomor_surat ?>/ SKK/ <?php echo $bulan[(int)(date("m", strtotime($q->tgl_lahir)))] . "/ " . date("Y", strtotime($q->tgl_lahir)); ?>
            </p>
        </td>
        <td>No. Registrasi :</td>
    </tr>

</table>
<p align="center">
    <b>Yang bertanda tangan di bawah ini :</b>
</p>
<table width="100%" class="laporan2">
    <tr>
        <td width="40%"><b>Nama</b></td>
        <td colspan="2">: <?php echo $q1->nama_perawat ?></td>
    </tr>
    <tr>
        <td><b>Propesi</b></td>
        <td colspan="2">: Bidan / Perawat</td>
    </tr>
</table>
<p align="center">
    <b>Menerangkan pada :</b>
</p>
<table width="100%" class="laporan2">
    <tr>
        <td width="40%"><b>Pada Hari</b></td>
        <td colspan="2">
            <?php
            $hari = date("w", strtotime($q->tgl_lahir));
            $h = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
            ?>: <?php echo $h[$hari]; ?>
        </td>
    </tr>
    <tr>
        <td width="40%"><b>Tanggal</b></td>
        <td colspan="2">
            : <?php echo date("d-m-Y", strtotime($q->tgl_lahir)) ?>
        </td>
    </tr>
    <tr>
        <td width="40%"><b>Jam</b></td>
        <td>
            : <?php echo date("H:i", strtotime($q->jamlahir)); ?>
        </td>
    </tr>
</table>
<br>
<table width="100%" class="laporan2">
    <tr>
        <b> Bahwa kami telah saya telah mengambil sidik :</b>
        <td width="40%"><b>Nama</b></td>
        <td>: <?php echo $q->nama_pasien ?></td>
        <td colspan="2"><b>Berat Badan</b></td>
        <td>: <?php echo $q->berat_badan ?></td>

    </tr>
    <tr>
        <td width="40%"><b>Jenis Kelamin</b></td>
        <td>: <?php echo ($q->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan"); ?></td>
        <td colspan="2"><b>Panjang Badan</b></td>
        <td>: <?php echo $q->panjang_badan ?></td>

    </tr>
    <tr>
        <td width="40%"><b>Kelahiran Ke</b></td>
        <td>: <?php echo $q->kelahiran_ke ?></td>
        <td colspan="2"> <b>Lingkar Kepala</b></td>
        <td>: <?php echo $q->lingkar_kepala ?></td>
    </tr>
    <tr>
        <td width="40%"><b>Tindakan</b></td>
        <td>: <?php echo $q->tindakan_bayi ?></td>
        <td colspan="2"> <b>Lingkar Dada</b></td>
        <td>: <?php echo $q->lingkar_dada ?></td>
    </tr>
    <tr>
        <td width="40%"><b>Kembar</b></td>
        <td>: <?php echo $q->kembar ?></td>
        <td colspan="2"> <b>Lingkar Lengan</b></td>
        <td>: <?php echo $q->lingkar_lengan ?></td>
    </tr>
    <tr>
        <td width="40%"><b>Kelainan Bawaan</b></td>
        <td>: <?php echo $q->kelainan_bawaan ?></td>
        <td colspan="2"> <b>Lingkar Perut</b></td>
        <td>: <?php echo $q->lingkar_perut ?></td>
    </tr>
</table>
<br>
<p align="center">
    <b>Anak Dari </b>
</p>
<br>
<table class="table-trigger" border="1" align="center">
    <tr>
        <td align="center" colspan="2"><b>Ibu</b></td>
        <td align="center" colspan="2"><b>Bapak</b></td>
    </tr>
    <tr>
        <td><b>Nama </b></td>
        <td><?php echo $q->ibu; ?></td>
        <td><b>Nama </b></td>
        <td><?php echo $q->nama_pasangan; ?></td>
    </tr>
    <tr>
        <td><b>Umur</b></td>
        <td>
            <?php
            if ($q->tgllahir_ibu == "1970-01-01" || $q->tgllahir_ibu == "") {
                $umur = "-";
            } else {
                list($year, $month, $day) = explode("-", $q->tgllahir_ibu);
                $year_diff  = date("Y") - $year;
                $month_diff = date("m") - $month;
                $day_diff   = date("d") - $day;
                if ($month_diff < 0) {
                    $year_diff--;
                    $month_diff *= (-1);
                } elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
                if ($day_diff < 0) {
                    $day_diff *= (-1);
                }
                $umur = $year_diff . " Tahun";
            }
            echo $umur;
            ?>
        </td>
        <td><b>Umur</b></td>
        <td>
            <?php
            if ($q->tgllahir_ayah == "1970-01-01" || $q->tgllahir_ayah == "") {
                $umur = "-";
            } else {
                list($year, $month, $day) = explode("-", $q->tgllahir_ayah);
                $year_diff  = date("Y") - $year;
                $month_diff = date("m") - $month;
                $day_diff   = date("d") - $day;
                if ($month_diff < 0) {
                    $year_diff--;
                    $month_diff *= (-1);
                } elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
                if ($day_diff < 0) {
                    $day_diff *= (-1);
                }
                $umur = $year_diff . " Tahun";
            }
            echo $umur;
            ?>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><b>Pekerjaan</b></td>
        <td> <?php echo ($q->pekerjaan_ibu == "" ? "-" : $q->pekerjaan_ibu) ?></td>
        <td><b>Pekerjaan</b></td>
        <td> <?php echo ($q->pekerjaan_ayah == "" ? "-" : $q->pekerjaan_ayah) ?></td>
    </tr>
    <tr>
        <td><b>No KTP / ASKES</b></td>
        <td> <?php echo ($q->nik_ibu == "" ? "-" : $q->nik_ibu); ?></td>
        <td><b>No KTP / ASKES</b></td>
        <td> <?php echo ($q->nik_ayah == "" ? "-" : $q->nik_ayah); ?></td>
    </tr>
    <tr>
        <td><b>Alamat</b></td>
        <td> <?php echo $q->alamat ?></td>
        <td><b>Alamat</b></td>
        <td> <?php echo $q->alamat ?></td>
    </tr>
</table>
<br>
<br>
<br>
<p align="right">
    Cirebon, <?php echo  tgl(date("Y-m-d", strtotime($q->tgl_lahir)), 2); ?>
</p>
<table class="laporan2" width="100%">
    <tr>
        <td align="right" width="50%">
        </td>
        <td align="right">
            <b>An. Kepala Rumah Sakit Ciremai<br>Kasub Bidang Keperawatan</b>
        </td>
    </tr>
    <tr>
        <td align="right">

        </td>
        <td align="right">
            <div class="getttd_saksi"> </div>
            <br>
            <?php echo $q3->nama_k . "<br>" . $q3->pangkat_k . " " . $q3->golongan_k . " " . $q3->nip_k;  ?>
        </td>
    </tr>
</table>
<style>
    * {
        padding-left: 5px;
        padding-right: 5px;
    }

    table,
    td,
    th {
        font-family: sans-serif;
        /*padding: 0px; margin:0px;*/
        /*font-size: 13px;*/
    }

    /*input.text{
        height:5px;
    }*/
</style>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }

    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }

    .laporan>thead>tr>th,
    .laporan>tbody>tr>th,
    .laporan>tfoot>tr>th,
    .laporan>thead>tr>td,
    .laporan>tbody>tr>td,
    .laporan>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .laporan>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }

    .laporan>caption+thead>tr:first-child>th,
    .laporan>colgroup+thead>tr:first-child>th,
    .laporan>thead:first-child>tr:first-child>th,
    .laporan>caption+thead>tr:first-child>td,
    .laporan>colgroup+thead>tr:first-child>td,
    .laporan>thead:first-child>tr:first-child>td {
        border-top: 0;
    }

    .laporan>tbody+tbody {
        border-top: 2px solid #ddd;
    }

    .laporan td,
    .laporan th {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }



    .laporan2 {
        border-collapse: collapse !important;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }

    .laporan2>thead>tr>th,
    .laporan2>tbody>tr>th,
    .laporan2>tfoot>tr>th,
    .laporan2>thead>tr>td,
    .laporan2>tbody>tr>td,
    .laporan2>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
    }

    .laporan2>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 0px solid #ddd;
    }

    .laporan2>caption+thead>tr:first-child>th,
    .laporan2>colgroup+thead>tr:first-child>th,
    .laporan2>thead:first-child>tr:first-child>th,
    .laporan2>caption+thead>tr:first-child>td,
    .laporan2>colgroup+thead>tr:first-child>td,
    .laporan2>thead:first-child>tr:first-child>td {
        border-top: 0;
    }

    .laporan2>tbody+tbody {
        border-top: 0px solid #ddd;
    }

    .laporan2 td,
    .laporan2 th {
        border: 0px solid #000 !important;
    }

    .watermark {
        position: absolute;
        top: 300px;
        left: 200px;
        z-index: -99;
        opacity: 0.5;
        width: 300px;
    }
</style>