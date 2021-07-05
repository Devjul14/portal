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
            getttd2();
            getttd();
            // window.print();
        });
        function getttd(){
            var ttd = "<?php echo site_url('ttddokter/getttddokter/'.$p->dokter_poli);?>";
            $('.ttd_qrcode_dokter').qrcode({width: 80,height: 80, text:ttd});
        }

        function getttd1(){
            var ttd = "<?php echo site_url('ttddokter/getttdpasien/'.$row->no_pasien);?>";
            $('.ttd_qrcode_pasien').qrcode({width: 80,height: 80, text:ttd});
        }
        function getttd2(){
            var ttd = "<?php echo site_url('ttddokter/getttdperawat/'.$x->pemberi);?>";
            $('.ttd_qrcode_perawat').qrcode({width: 80,height: 80, text:ttd});
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
                <h4 style="margin-top:0px; margin-bottom: 0px;">LEMBAR FORMULIR RAWAT JALAN<br>PERMINTAAN TERAPI</h4>
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
    <?php
        // echo json_encode($parent->result());
        foreach ($parent->result() as $value) {
            echo "<table class='laporan' width='100%'>";
            echo "<tr>";
            echo "<td colspan='6'><b>PERMINTAAN TERAPI</b><br>";
            echo $value->tindakan;
            echo "</td>";
            echo "</tr>";
            echo '<tr>';
            echo '    <th style="text-align:center;vertical-align:middle" rowspan="2">No.</th>';
            echo '    <th style="text-align:center;vertical-align:middle" rowspan="2">Program</th>';
            echo '    <th style="text-align:center;vertical-align:middle" rowspan="2">Tanggal</th>';
            echo '    <th style="text-align:center;vertical-align:middle" colspan="3">Tanda Tangan</th>';
            echo '</tr>';
            echo '<tr>';
            echo '    <th style="text-align:center;vertical-align:middle">Pasien</th>';
            echo '    <th style="text-align:center;vertical-align:middle">Dokter</th>';
            echo '    <th style="text-align:center;vertical-align:middle">Terapis</th>';
            echo '</tr>';
            $i = $n = 1;
            $tindakan = explode(",",$value->kode_tarif);
            foreach ($tindakan as $key => $kode_tarif) {
                echo "<tr>";
                if ($n<=1){
                    echo "<td align='right' rowspan='".count($tindakan)."'>".($i++)."</td>";
                }
                echo "<td>".$tarif[$kode_tarif]."</td>";
                if ($n<=1){
                    echo "<td align='center' rowspan='".count($tindakan)."'>".date("d-m-Y",strtotime($value->tgl_pemeriksaan))."</td>";
                    echo "<td align='center' rowspan='".count($tindakan)."'><div class='ttd_qrcode_pasien'></div><br>".$row->nama_pasien."</td></td>";
                    echo "<td align='center' rowspan='".count($tindakan)."'><div class='ttd_qrcode_dokter'></div><br>".$p->nama_dokter."</td></td>";
                    echo "<td align='center' rowspan='".count($tindakan)."'><div class='ttd_qrcode_perawat'></div><br>".$x[$value->no_reg]->nama_perawat."</td>";
                }
                echo "</tr>";
                $n++;
            }
            foreach ($child[$value->no_reg] as $key => $val) {
                $n = 1;
                $tindakan = explode(",",$val->kode_tarif);
                foreach ($tindakan as $key => $kode_tarif) {
                    echo "<tr>";
                    if ($n<=1){
                        echo "<td align='right' rowspan='".count($tindakan)."'>".($i++)."</td>";
                    }
                    echo "<td>".$tarif[$kode_tarif]."</td>";
                    if ($n<=1){
                        echo "<td align='center' rowspan='".count($tindakan)."'>".date("d-m-Y",strtotime($val->tgl_pemeriksaan))."</td>";
                        echo "<td align='center' rowspan='".count($tindakan)."'><div class='ttd_qrcode_pasien'></div><br>".$row->nama_pasien."</td></td>";
                        echo "<td align='center' rowspan='".count($tindakan)."'><div class='ttd_qrcode_dokter'></div><br>".$p->nama_dokter."</td></td>";
                        echo "<td align='center' rowspan='".count($tindakan)."'><div class='ttd_qrcode_perawat'></div><br>".$x[$val->no_reg]->nama_perawat."</td>";
                    }
                    $n++;
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
    ?>
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