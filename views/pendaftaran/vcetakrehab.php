<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo base_url();?>css/print.css"> 
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
</head>
<script>
    $(document).ready(function(){
            getttd1();
            getttd();
            window.print();
        });
        function getttd(){
            var ttd = "<?php echo site_url('ttddokter/getttddokter/'.$p->dokter_poli);?>";
            $('.ttd_qrcode_dokter').qrcode({width: 100,height: 100, text:ttd});
        }

        function getttd1(){
            var ttd = "<?php echo site_url('ttddokter/getttdperawat/'.$t->petugas_igd);?>";
            $('.ttd_qrcode_perawat').qrcode({width: 100,height: 100, text:ttd});
        }
</script> 
<section class="margin">
    <?php
        list($year,$month,$day) = explode("-",$row->tgl_lahir);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($month_diff < 0) { 
            $year_diff--;
            $month_diff *= (-1);
        }
        elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
        if ($day_diff < 0) { 
            $day_diff *= (-1);
        }
        $umur = $year_diff." tahun ".$month_diff." bulan ".$day_diff." hari ";
    ?>
    <table class="laporan" width="100%">
        <tr>
            <td rowspan="6" align="center" style="vertical-align:middle"><img src="<?php echo base_url("img/Logo.png")?>"><br><b>RS CIREMAI</b></td>
            <td rowspan="6" align="center" style="vertical-align:middle">
                <h4 style="margin-top:0px; margin-bottom: 0px;">LEMBAR FORMULIR RAWAT JALAN<br>LAYANAN KEDOKTERAN FISIK DAN REHABILITASI</h4>
            </td>
            <td style="width:150px">No. RM </td>
            <td style="width:250px"><?php echo $row->no_pasien;?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?php echo $row->nama_pasien;?></td>
        </tr>
        <tr>
            <td>L/P</td>
            <td><?php echo ($row->jenis_kelamin=="L" ? "Laki-laki" : ($row->jenis_kelamin=="P" ? "Perempuan" : "-"));?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir/ Usia</td>
            <td><?php echo date("d-m-Y",strtotime($row->tgl_lahir))."/ ".$umur;?></td>
        </tr>
        <tr>
            <td>Alamat/ Telpon</td>
            <td><?php echo $row->alamat."/ ".$row->telpon?></td>
        </tr>
    </table>
    <table class="laporan" width="100%">
        <tr>
            <td>Tanggal Pelayanan</td>
            <td><?php echo date("d-m-Y",strtotime($q->tgl_pemeriksaan));?></td>
        </tr>
        <tr>
            <td>Anamnesa</td>
            <td><?php echo $a->s."<br>".$a->o;?></td>
        </tr>
        <tr>
            <td>Pemeriksaan Fisik dan Uji Fungsi</td>
            <td><?php echo $q->tindakan;?></td>
        </tr>
        <tr>
            <td>Diagnosa Medis (ICD-10)</td>
            <td><?php echo $q->kode_diagnosis_medis." - ".$icd[$q->kode_diagnosis_medis];?></td>
        </tr>
        <tr>
            <td>Diagnosa Fungsi (ICD-10)</td>
            <td><?php echo $q->kode_diagnosis_fungsional." - ".$icd[$q->kode_diagnosis_fungsional];?></td>
        </tr>
        <tr>
            <td>Pemeriksaan Penunjang</td>
            <td><?php echo $a->a."<br>".$a->p;?></td>
        </tr>
        <tr>
            <td>Tata Laksana KFR (ICD-9)</td>
            <td><?php echo $q->koding." - ".$icd9[$q->koding];?></td>
        </tr>
        <tr>
            <td>Anjuran</td>
            <td><?php echo $q->rekomendasi;?></td>
        </tr>
        <tr>
            <td>Evaluasi</td>
            <td><?php echo $q->evaluasi;?></td>
        </tr>
        <tr>
            <td>Suspek Penyakit Akibat Kerja</td>
            <td><?php echo ($q->suspek_kerja=="1" ? "Ya, ".$q->keterangan_suspek : "Tidak");?></td>
        </tr>
        <tr>
            <td colspan="2" style="border:none" align="right">Tanda Tangan<br><br><div class="ttd_qrcode_dokter"></div><br><?php echo $p->nama_dokter;?></td>
        </tr>
    </table>
</section>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
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
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
    }
    .laporan td,
    .laporan th {
        background-color: #fff;
        border: 1px solid #000;
    }
    .laporan td.no-border,
    .laporan th.no-border {
        background-color: #fff !important;
        border: none;
    }
</style>