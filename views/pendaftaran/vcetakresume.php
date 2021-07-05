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
        getttd();
        window.print();
    });
    function getttd(){
        $.each($(".ttd_dpjp"), function(key, value) {
            var id_dokter = $(this).attr("id_dokter");
            var ttd = "<?php echo site_url('ttddokter/getttddokterlab/');?>/"+id_dokter;
            $(this).qrcode({width: 100,height: 100, text:ttd});
        });

    }
</script>
<?php
    list($year,$month,$day) = explode("-",$q1->tgl_lahir);
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
        <td rowspan="3" align="center">
            <img src="<?php echo base_url("img/Logo.png")?>"><br><b>RS CIREMAI</b>
        </td>
        <td rowspan="3" align="center" style="vertical-align: middle;">
            <h4>RESUME PASIEN RAWAT JALAN BERKELANJUTAN</h4>
        </td>
        <td>Nama</td><td>:</td><td><?php echo $q1->nama_pasien;?></td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td><td>:</td><td><?php echo ($q1->tgl_lahir!="" ? date("d-m-Y",strtotime($q1->tgl_lahir)) : "")."/ ".$umur;?></td>
    </tr>
    <tr>
        <td>No. RM </td><td>:</td><td><?php echo $q1->no_pasien;?></td>
    </tr>
</table>
<table class="laporan" width="100%">
    <thead>
        <tr>
            <th style="vertical-align: middle">No</th>
            <th style="vertical-align: middle">Tgl, Jam Kunjungan</th>
            <th style="vertical-align: middle">Poliklinik yang dituju</th>
            <th style="vertical-align: middle">Diagnosa</th>
            <th style="vertical-align: middle">Pengobatan Saat ini</th>
            <th style="vertical-align: middle">Alergi</th>
            <th style="vertical-align: middle">Tindakan/Operasi dan Rawat Inap dimasa lalu</th>
            <th style="vertical-align: middle">Paraf DPJP</th>
            <th style="vertical-align: middle">ICD X/IX</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($q["ralan"] as $key => $val) {
            $no = $key+1;
            echo "<tr>";
            echo "<td>".($no)."</td>";
            echo "<td>".date("d-m-Y H:i",strtotime($val->tanggal))."</td>";
            echo "<td>".$val->nama_poli."</td>";
            echo "<td>".$val->a."</td>";
            echo "<td>";
            echo "<ul style='margin-left:-20px'>";
            if (isset($q["terapi"][$val->no_reg])){
                foreach($q["terapi"][$val->no_reg] as $key1 => $val1){
                    echo "<li>".$val1->nama_obat." ".$val1->qty." ".$val1->satuan." | ".($val1->aturan_pakai=='' ? "-" : $val1->aturan_pakai)."</li>";
                };
            } else {
                echo "-";
            }
            echo "</ul>";
            echo "</td>";
            echo "<td>".($val->riwayat_alergi=="" ? "-" : $val->riwayat_alergi)."</td>";
            echo "<td>";
            echo "<ul style='margin-left:-20px'>";
            if (isset($q["kasir"][$val->no_reg])){
                $koma = "";
                foreach($q["kasir"][$val->no_reg] as $key1 => $val1){
                    if ($val1->nama_tindakan1!=""){
                        $nama_tindakan = $val1->nama_tindakan1;
                    } else
                    if ($val1->nama_tindakan2!=""){
                        $nama_tindakan = $val1->nama_tindakan2;
                    } else {
                        $nama_tindakan = $val1->nama_tindakan3;
                    }
                    if ($nama_tindakan!=""  && $nama_tindakan!='PEMERIKSAAN DOKTER'){
                        echo "<li>".$nama_tindakan." -> ".$val1->hasil."</li>";
                    }
                };
            } else {
                echo "-";
            }
            echo "</ul>";
            echo "</td>";
            echo "<td align='center'><div class='ttd_dpjp id_dokter='".$val->dokter_poli."'></div><br>".$val->nama_dokter."</td>";
            echo "<td>";
            if (isset($q["grouper_icd9"][$val->no_reg])){
                $koma = "";
                foreach($q["grouper_icd9"][$val->no_reg] as $key1 => $val1){
                    echo $koma.$val1->kode;
                    $koma = ", ";
                };
            }
            if (isset($q["grouper_icd10"][$val->no_reg])){
                $koma = "";
                foreach($q["grouper_icd10"][$val->no_reg] as $key1 => $val1){
                    echo $koma.$val1->kode;
                    $koma = ", ";
                };
            }
            if (isset($q["grouper_icd9"][$val->no_reg]) && isset($q["grouper_icd10"][$val->no_reg])){
                echo "-";
            }
            echo "</td>";
            echo "</tr>";

        }
        ?>
    </tbody>
</table>
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
