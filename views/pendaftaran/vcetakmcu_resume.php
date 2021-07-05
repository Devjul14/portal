<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
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
            getttd();
            window.print();
        });

        function getttd(){
            var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'.$q->id_dokter);?>";
            $('.ttd_qrcode').qrcode({width: 80,height: 80, text:ttd});
        }
</script>
    <?php

        $t1 = new DateTime('today');
        $t2 = new DateTime($q->tgl_lahir);
        $y  = $t1->diff($t2)->y;
        $m  = $t1->diff($t2)->m;
        $d  = $t1->diff($t2)->d;

        list($year,$month,$day) = explode("-",$q->tgl_lahir);
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
            <td rowspan="5" align="center">
                <img src="<?php echo base_url("img/Logo.png")?>"><br><b>RS CIREMAI</b>
            </td>
            <td rowspan="5" align="center" width="150px" style="vertical-align: middle;">
                <h4>RESUME (MCU)</h4>
            </td>
            <td width="20%">No. RM</td><td>:</td><td><?php echo $q->no_pasien;?></td>
        </tr>
        <tr>
            <td>No. REG </td><td>:</td><td><?php echo $q->no_reg;?></td>
        </tr>
        <tr>
            <td>Nama </td><td>:</td><td><?php echo $q->nama_pasien;?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td><td>:</td><td><?php echo ($q->tgl_lahir!="" ? date("d-m-Y",strtotime($q->tgl_lahir)) : "")."/ ".$umur;?></td>
        </tr>
        <tr>
            <td>Alamat </td><td>:</td><td><?php echo $q->alamat;?></td>
        </tr>
    </table>
    <br>
    <br>
    <table width="100%" class="laporan">
        <tr>
            <td align="center" width="40%"><u><b>PEMERIKSAAN FISIK</b></u></td>
            <td colspan="3" align="center" width="60%"><u><b>HASIL PEMERIKSAAN</b></u></td>
        </tr>
        <tr>
            <th><u>KEPALA</u></th>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;-&nbsp;Mata</td>
            <td colspan="3">: Visus OD : <?php echo $q1->visus_od ?> OS : <?php echo $q1->visus_os ?></td>
        </tr>
        <tr>
            <td>&nbsp;-&nbsp;Buta Warna</td>
            <td colspan="3">
                <?php
                    if ($q1->kenal_warna=="Baik") {
                       echo ": Tidak";
                    } else {
                       echo ": Iya";
                    }
                ?>
                , <?php echo $q1->ket_kenal_warna ?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;-&nbsp;THT</td>
            <td colspan="3">: <?php echo $q1->telinga ?></td>
        </tr>
        <tr>
            <td>&nbsp;-&nbsp;Gigi</td>
            <td colspan="3">: <?php echo $q1->gigi ?>, <?php echo $q1->ket_gigi ?></td>
        </tr>
        <tr>
            <th><u>DADA</u></th>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;Foto Thorax</td>
            <td colspan="3"><textarea class="form-control" style="max-width: 100%;height:200px; font-size: 12px" readonly><?php echo $q2->hasil_pemeriksaan ?></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;EKG / Jantung</td>
            <td colspan="3">: <?php echo $q1->ekg_jantung ?></td>
        </tr>
        <tr>
            <td>&nbsp;Treadmill</td>
            <td colspan="3">: <?php echo $q1->treadmill ?></td>
        </tr>
        <tr>
            <th><u>ABDOMEN</u></th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td><u>Hepar</u></td>
            <td colspan="3">: <?php echo $q1->hepar ?>, <?php echo $q1->ket_hepar ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><u>Lien</u></td>
            <td colspan="3">: <?php echo $q1->lien ?>, <?php echo $q1->ket_lien ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-weight:bold"><u>Genetalia</u></td>
            <td colspan="3">: Varicocel : <?php echo $q1->varicocel ?>, <?php echo $q1->ket_varicocel ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-weight:bold"><u>Kulit</u></td>
            <td colspan="3">: <?php echo $q1->kulit ?>, <?php echo $q1->ket_kulit ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-weight:bold"><u>Bekas Operasi</u></td>
            <td colspan="3">: <?php echo $q1->bekas_operasi ?>, <?php echo $q1->ket_bekas_operasi ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <!-- <tr>
            <td><u>Ekstremitas</u></td>
            <td colspan="3">: <?php echo $q1->ekstremitas ?></td>
        </tr> -->
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <th><u>EKSTREMITAS ATAS</u></th>
            <td colspan="3">: <?php echo $q1->atas ?> , <?php echo $q1->ket_atas ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <th><u>EKSTREMITAS BAWAH</u></th>
            <td colspan="3">: <?php echo $q1->bawah ?> , <?php echo $q1->ket_bawah ?></td>
        </tr>
        <tr>
            <th><u>LAIN-LAIN</u></th>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><u>Hemoroid</u></td>
            <td colspan="3">: <?php echo $q1->hemoroid ?> , <?php echo $q1->ket_hemoroid ?></td>
        </tr>
        <tr>
            <td><u>Varises</u></td>
            <td colspan="3">: <?php echo $q1->varises ?> , <?php echo $q1->ket_varises ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold">&nbsp;LABORATORIUM</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <?php
            $sdata="";
            $i=1;$n=1;
            $judul = "";
            $namaanalys = "";
            $nama_tindakan= "";
            foreach ($k1->result() as $row){
                $merah = "";
                $hasil = (float)$row->hasil;
                if ($row->min_kritis!=""){
                    if ($hasil<=$row->min_kritis)
                        $merah = "red";
                }
                if ($row->max_kritis!=""){
                    if ($hasil>=$row->max_kritis)
                        $merah = "red";
                }
                if ($row->kode=="N008"){
                    if (strtolower($row->hasil)!=strtolower($row->normal))
                        $merah = "red";
                    else
                        $merah = "";
                }
                if ($namaanalys!="") $namaanalys = $row->namaanalys;
                if ($row->jenis_kelamin=="L") {
                    $rujukan = $row->pria;
                } else {
                    $rujukan = $row->wanita;
                }
                if ($judul!=$row->judul){
                    $i = 1;
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td colspan='3'>".$n++.". ".$row->judul."</td>";
                    echo "<tr>";
                    $judul = $row->judul;
                }
                echo "<tr>";
                echo "<td>&nbsp;</td>";
                echo "<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row->nama."</td>";
                echo "<td align='left'><label class='text-".$merah."'>".$row->hasil."&nbsp;".$row->satuan."</label></td>";
                echo "<td align='left'>".$rujukan."</td>";
                echo "</tr>";
                $i++;

            }
        ?>
        <tr>
            <th><u>KESIMPULAN</u></th>
            <td colspan="3">: <?php echo $q1->kesimpulan ?></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td align="center" colspan="3">
        		Dokter Pemeriksa
        		<br>
                <br>
        		<div class="ttd_qrcode"> </div>
        		<br>
        		<?php echo $dk->nama_dokter ?>
        		<br>
        		Sip <?php echo $dk->no_sip ?>
        	</td>
        </tr>
    </table>
<style>
    *{
        padding-left : 5px;
        padding-right: 5px;
    }
    table, td,th{
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
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }
</style>
