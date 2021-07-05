<!DOCTYPE html>
<html>
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
	<script>
		window.print();
	</script>
<body>
    <div class="margin">
    <table  width="100%" class="laporan" border="1">
        <thead>
            <tr>
                <th colspan="15" class="text-center header-laporan" colspan="7">
                    <h3>REKAP HARIAN</h3>
                    <p>
                        PERIODE <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?>
                    </p>
                </th>
            </tr>
            <tr class="bg-navy">
                <th rowspan="2" class="text-center" style="vertical-align: middle">No.</th>
                <th rowspan="2" class="text-center" style="vertical-align: middle">Tanggal</th>
                <th class="text-center" colspan="5">Pelayanan Rajal</th>
                <th class="text-center" colspan="5">Pelayanan Ranap</th>
                <th class="text-center" style="vertical-align: middle" rowspan="2">Apotek</th>
                <th class="text-center" colspan="2">Sharing</th>
                <th rowspan="2" class="text-center" style="vertical-align: middle">COB</th>
                <th rowspan="2" class="text-center" style="vertical-align: middle">Parkir</th>
                <th rowspan="2" class="text-center" style="vertical-align: middle">Total</th>
            </tr>
            <tr class="bg-navy">
                <th class="text-center">BPJS</th>
                <th class="text-center">Umum</th>
                <th class="text-center">Perusahaan</th>
                <th class="text-center" style="vertical-align: middle">Apotek</th>
                <th class="text-center" style="vertical-align: middle">Parsial</th>
                <th class="text-center">BPJS</th>
                <th class="text-center">Umum</th>
                <th class="text-center">Perusahaan</th>
                <th class="text-center" style="vertical-align: middle">Apotek</th>
                <th class="text-center" style="vertical-align: middle">Parsial</th>
                <th class="text-center">BPJS</th>
                <th class="text-center">Perusahaan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $q = array();
                foreach ($h->pelayanan_ralan as $tgl => $value) {
                    foreach ($value as $status => $val) {
                        $q["pelayanan_ralan"][$tgl][$status] = $val;
                    }
                }
                foreach ($h->apotek_ralan as $key => $value) {
                    $q["apotek_ralan"][$key] = $value;
                }
                foreach ($h->pelayanan_inap as $tgl => $value) {
                    foreach ($value as $status => $val) {
                        $q["pelayanan_inap"][$tgl][$status] = $val;
                    }
                }
                foreach ($h->blu as $tgl => $value) {
                    foreach ($value as $status => $val) {
                        $q["blu"][$tgl][$status] = $val;
                    }
                }
                foreach ($h->cob as $key => $value) {
                    $q["cob"][$key] = $value;
                }
                foreach ($h->apotek_inap as $key => $value) {
                    $q["apotek_inap"][$key] = $value;
                }
                foreach ($h->apotek as $key => $value) {
                    $q["apotek"][$key] = $value;
                }
                foreach ($h->parkir as $key => $value) {
                    $q["parkir"][$key] = $value;
                }
                $no_reg = "";
                $i = 1;
                $jumlah = 0;
                $finish = date("Y-m-d",strtotime($tgl2));
                $start = date("Y-m-d",strtotime($tgl1));
                $durasi= strtotime($finish)-strtotime($start);
                $hari = $durasi / (60 * 60 * 24);
                $hari += 1;
                for($i=0;$i<$hari;$i++){
                    $tgl = date('Y-m-d', strtotime($start . " + ".$i." day"));
                    $bpjs_ralan = (isset($q["pelayanan_ralan"][$tgl]["BPJS"]) ? $q["pelayanan_ralan"][$tgl]["BPJS"] : 0);
                    $umum_ralan = (isset($q["pelayanan_ralan"][$tgl]["UMUM"]) ? $q["pelayanan_ralan"][$tgl]["UMUM"] : 0);
                    $perusahaan_ralan = (isset($q["pelayanan_ralan"][$tgl]["PERUSAHAAN"]) ? $q["pelayanan_ralan"][$tgl]["PERUSAHAAN"] : 0);
                    $bpjs_inap = (isset($q["pelayanan_inap"][$tgl]["BPJS"]) ? $q["pelayanan_inap"][$tgl]["BPJS"] : 0);
                    $umum_inap = (isset($q["pelayanan_inap"][$tgl]["UMUM"]) ? $q["pelayanan_inap"][$tgl]["UMUM"] : 0);
                    $perusahaan_inap = (isset($q["pelayanan_inap"][$tgl]["PERUSAHAAN"]) ? $q["pelayanan_inap"][$tgl]["PERUSAHAAN"] : 0);
                    $bpjs_blu = (isset($q["blu"][$tgl]["BPJS"]) ? $q["blu"][$tgl]["BPJS"] : 0);
                    $perusahaan_blu = (isset($q["blu"][$tgl]["PERUSAHAAN"]) ? $q["blu"][$tgl]["PERUSAHAAN"] : 0);
                    $cob = (isset($q["cob"][$tgl]) ? $q["cob"][$tgl]: 0);
                    $parsial_ralan = (isset($q["parsial_ralan"][$tgl]) ? number_format($q["parsial_ralan"][$tgl],0,',','.') : 0);
                    $parsial_ranap = (isset($q["parsial_ranap"][$tgl]) ? number_format($q["parsial_ranap"][$tgl],0,',','.') : 0);
                    $apotek_ralan = (isset($q["apotek_ralan"][$tgl]) ? number_format($q["apotek_ralan"][$tgl],0,',','.') : 0);
                    $apotek_inap = (isset($q["apotek_inap"][$tgl]) ? number_format($q["apotek_inap"][$tgl],0,',','.') : 0);
                    echo "<tr>";
                    echo "<td class='text-right'>".($i+1)."</td>";
                    echo "<td>".date("d-m-Y",strtotime($tgl))."</td>";
                    echo "<td class='text-right'>".(isset($q["pelayanan_ralan"][$tgl]["BPJS"]) ? number_format($q["pelayanan_ralan"][$tgl]["BPJS"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["pelayanan_ralan"][$tgl]["UMUM"]) ? number_format($q["pelayanan_ralan"][$tgl]["UMUM"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["pelayanan_ralan"][$tgl]["PERUSAHAAN"]) ? number_format($q["pelayanan_ralan"][$tgl]["PERUSAHAAN"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["apotek_ralan"][$tgl]) ? number_format($q["apotek_ralan"][$tgl],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["parsial_ralan"][$tgl]) ? number_format($q["parsial_ralan"][$tgl],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["pelayanan_inap"][$tgl]["BPJS"]) ? number_format($q["pelayanan_inap"][$tgl]["BPJS"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["pelayanan_inap"][$tgl]["UMUM"]) ? number_format($q["pelayanan_inap"][$tgl]["UMUM"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["pelayanan_inap"][$tgl]["PERUSAHAAN"]) ? number_format($q["pelayanan_inap"][$tgl]["PERUSAHAAN"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["apotek_inap"][$tgl]) ? number_format($q["apotek_inap"][$tgl],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["parsial_ranap"][$tgl]) ? number_format($q["parsial_ranap"][$tgl],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["apotek"][$tgl]) ? number_format($q["apotek"][$tgl],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["blu"][$tgl]["BPJS"]) ? number_format($q["blu"][$tgl]["BPJS"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["blu"][$tgl]["PERUSAHAAN"]) ? number_format($q["blu"][$tgl]["PERUSAHAAN"],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["cob"][$tgl]) ? number_format($q["cob"][$tgl],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".(isset($q["parkir"][$tgl]) ? number_format($q["parkir"][$tgl],0,',','.') : 0)."</td>";
                    echo "<td class='text-right'>".number_format($bpjs_ralan+$umum_ralan+$perusahaan_ralan+$bpjs_inap+$umum_inap+$perusahaan_inap+$bpjs_blu+$perusahaan_blu+$cob,0,',','.')."</td>";
                    echo "</tr>";
                    $jumlah += ($bpjs_ralan+$umum_ralan+$perusahaan_ralan+$bpjs_inap+$umum_inap+$perusahaan_inap+$bpjs_blu+$perusahaan_blu+$cob+$parsial_ralan+$parsial_ranap+$apotek_ralan+$apotek_inap);
                }
            ?>
        </tbody>
        <tfoot>
            <tr class="bg-navy">
                <th colspan=15>JUMLAH</th>
                <th class="text-right"><?php echo number_format($jumlah,0,',','.');?></th>
            </tr>
        </tfoot>
    </table>
</div>
</body>
<style type="text/css">
    .laporan th,
    .laporan td {
        padding: 10px;
    }
    th.header-laporan,
    td.header-laporan {
        border:0;
    }
    .laporan td{
        vertical-align: top;
    }
</style>