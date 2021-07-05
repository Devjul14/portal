<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/AdminLTE.css">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
    <!-- <script src="<?php echo base_url(); ?>js/html2pdf.bundle.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>js/html2canvas.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>js/jquery.mask.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script> -->
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
</head>
<script>
    $(document).ready(function() {
        getttd_dokter();
        // window.print();
    });

    function getttd_dokter() {
        var ttd = "<?php echo site_url('ttddokter/getttddokter/' . $pi->dpjp); ?>";
        $('.ttd_dokter').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
        var ttd = "<?php echo site_url('ttddokter/getpasientindakan/' . $no_reg . "/" . $jenis . "/0"); ?>";
        $('.ttd_pasien').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
        var ttd = "<?php echo site_url('ttddokter/getpasientindakan/' . $no_reg . "/" . $jenis . "/1"); ?>";
        $('.ttd_saksi').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
    }
</script>
<?php
function getRomawi($bulan)
{
    switch ($bulan) {
        case 1:
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}
$t1 = new DateTime('today');
$t2 = new DateTime($q->tgl_lahir);
$y  = $t1->diff($t2)->y;
$m  = $t1->diff($t2)->m;
$d  = $t1->diff($t2)->d;

$lahir = new DateTime($q->tgl_lahir);
$hari_ini = new DateTime();

$diff = $hari_ini->diff($lahir);
$umur = $diff->y ." Tahun";
$umur .= $diff->m ." Bulan ";
$umur .= $diff->d ." Hari";

if ($q->jenis_kelamin == "L") {
    $jenis_kelamin = "Laki-Laki";
} else {
    $jenis_kelamin = "Perempuan";
}
function tgl($tgl, $tipe)
{
    $month = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
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

?>

<body class="page">
    <p>
    <h5>
        <b>
            &nbsp;DETASEMEN KESEHATAN WILAYAH 03.04.03
        </b>
    </h5>
    </p>
    <p>
    <h5>
        <u>
            <b>
                RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI<span style="float:right"><b><u>BENTUK KO-0554</u></b></span>
            </b>
        </u>
    </h5>
    </p>
    <br>
    <table class="table no-border laporan" align="center">
        <tr>
            <td colspan="2" style="vertical-align:middle">
                <h5 align="center"><b><u>SURAT ISTIRAHAT SAKIT</u></b></h5>
            </td>
        </tr>
        <tr>
            <?php $bulan = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"); ?>
            <td width="50%" align="right">No.<span style="float:right">:</span></td>
            <td><?php echo $p->nomor_surat ?>/ IST/ <?php echo $bulan[(int)(date("m", strtotime($pi->tgl_keluar)))] . "/ " . date("Y", strtotime($pi->tgl_keluar)); ?></td>
        </tr>
    </table>
    <p style="font-size:12px">Diberikan istirahat kepada :</p>
    <table class="table no-border laporan">
        <tr>
            <td width=200px>Nama Penderita<span style="float:right">:</span></td>
            <td><?php echo $q->nama_pasien; ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir / Umur<span style="float:right">:</span></td>
            <td><?php echo date("d-m-Y",strtotime($q->tgl_lahir))." / ".$umur; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin<span style="float:right">:</span></td>
            <td><?php echo ($q->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan"); ?></td>
        </tr>
        <tr>
            <td>Nama Suami/ Ayah<span style="float:right">:</span></td>
            <td><?php echo (($q->nama_pasangan == "" || $q->nama_pasangan == "0") ? "-" : $q->nama_pasangan); ?></td>
        </tr>
        <tr>
            <td>Pangkat/ Golongan<span style="float:right">:</span></td>
            <td><?php echo ($q->nama_pangkat == "" ? "-" : $q->nama_pangkat); ?></td>
        </tr>
        <tr>
            <td>NRP/ NBI/ NIP<span style="float:right">:</span></td>
            <td><?php echo ($q->nip == "" ? "-" : $q->nip); ?></span></td>
        </tr>
        <!-- <tr>
            <td>Jabatan<span style="float:right">:</span></td>
            <td><?php echo ($q->nama_kesatuan == "" ? "-" : $q->nama_kesatuan); ?></td>
        </tr> -->
        <tr>
            <td>Alamat Rumah<span style="float:right">:</span></td>
            <td><?php echo $q->alamat; ?></td>
        </tr>
        <tr>
            <td>Alamat<span style="float:right">:</span></td>
            <td style="font-weight:bold"><?php echo strtoupper($p->kepada); ?></td>
        </tr>
        <tr>
            <td>Selama<span style="float:right">:</span></td>
            <td><?php echo $p->selama; ?> Hari</td>
        </tr>
        <tr>
            <td>Mulai tanggal<span style="float:right">:</span></td>
            <td><?php echo date("d-m-Y",strtotime($p->mulai)); ?></td>
        </tr>
        <tr>
            <td>Sampai tanggal<span style="float:right">:</span></td>
            <td><?php echo date("d-m-Y",strtotime($p->sampai)); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">
                <?php
                  $bulan = array(
                    "",
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "Nopember",
                    "Desember"
                  );
                ?>
                <br><br>
                Cirebon, <?php echo date("d", strtotime($pi->tgl_keluar))." ".$bulan[(int)date("m", strtotime($pi->tgl_keluar))]." ".date("Y", strtotime($pi->tgl_keluar)); ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">
                <b>A.n KEPALA RUMAH SAKIT</b><br>
                <b>Dokter</b><br>
                <span class="ttd_dokter"></span><br>
                <?php echo $pi->nama_dpjp; ?><br>
                SIP : <?php echo $pi->no_sip; ?>
            </td>
        </tr>
    </table>
</body>
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

    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
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
    }



    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
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
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #FFFFFF;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 148mm;
        min-height: 210mm;
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 256mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A5;
        margin: 0;
    }

    h5 {
        font-size: 14px;
    }

    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
