<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />

</head>
<body>
<script>
    window.print();
</script>
<h3>Rekap Jadwal OKA</h3>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th class='text-center'>No</th>
                <th width="10%" class='text-center'>Hari</th>
                <th class='text-center'>Tanggal</th>
                <th class="text-center">Nama</th>
                <th class='text-center'>Umur</th>
                <th class='text-center'>Jenis Kelamin</th>
                <th class='text-center'>No. RM</th>
                <th class='text-center'>Golongan Pasien</th>
                <th class='text-center'>Ruangan</th>
                <th class='text-center'>Kamar</th>
                <th class='text-center'>Diagnosa</th>
                <th class='text-center'>Operasi</th>
                <th class='text-center'>Gol Operasi</th>
                <th class='text-center'>Jam Masuk</th>
                <th class='text-center'>Jam Keluar</th>
                <th class='text-center'>Anestesi</th>
                <th class='text-center'>Asa</th>
                <th class='text-center'>Jenis Anatesi</th>
                <th class='text-center'>Operator</th>
                <th class='text-center'>asisten Operasi</th>
                <th class='text-center'>Kamar Operasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                
            ?>
            <?php
            $i =0;
                foreach ($q->result() as $value) {
                    $i++;
                    $tgl=substr($value->tanggal,8,2);
                    $bln=substr($value->tanggal,5,2);
                    $thn=substr($value->tanggal,0,4);
                    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
                    switch($info){
                        case '0': $hari = "Minggu"; break;
                        case '1': $hari = "Senin"; break;
                        case '2': $hari = "Selasa"; break;
                        case '3': $hari = "Rabu"; break;
                        case '4': $hari = "Kamis"; break;
                        case '5': $hari = "Jumat"; break;
                        case '6': $hari = "Sabtu"; break;
                    };
                    $t1 = new DateTime('today');
                    $t2 = new DateTime($value->tgl_lahir);
                    $y  = $t1->diff($t2)->y;
                    $m  = $t1->diff($t2)->m;
                    $d  = $t1->diff($t2)->d;
                    echo "
                        <tr id=data href='".$value->kode_oka."' nama ='".$value->nama."'>
                            <td>".$i."</td>
                            <td>".$hari."</td>
                            <td>".date("d-m-Y",strtotime($value->tanggal))."</td>
                            <td>".$value->nama."</td>
                            <td>".$y.' Tahun '."</td>
                            <td>".$value->jk."</td>
                            <td>".$value->no_rm."</td>
                            <td>".$value->gol_pasien."</td>
                            <td>".(isset($ruang[$value->ruangan]) ? $ruang[$value->ruangan] : "")."</td>
                            <td>".(isset($kamar[$value->kamar]) ? $kamar[$value->kamar] : "")."</td>
                            <td>".$micd[$value->diagnosa]." (".$value->diagnosa.")</td>
                            <td>".$o[$value->operasi]["nama_tindakan"]."</td>
                            <td>".$value->jenis_operasi."</td>
                            <td>".$value->jam_masuk."</td>
                            <td>".$value->jam_keluar."</td>
                            <td>".(isset($dokter[$value->dokter_anastesi]) ? $dokter[$value->dokter_anastesi] : "")."</td>
                            <td>".$value->asa."</td>
                            <td>".(isset($ja[$value->jenis_anastesi]) ? $ja[$value->jenis_anastesi] : "")."</td>
                            <td>".(isset($dokter[$value->dokter_operasi]) ? $dokter[$value->dokter_operasi] : "")."</td>
                            <td>".(isset($as[$value->asisten_operasi]) ? $as[$value->asisten_operasi] : "")."</td>
                            <td>".$value->kamar_operasi."</td>

                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
<style>
    html, body {
        display: block;
        /*font-family: "sans-serif";*/
        /*width: 20cm;*/
         /*height: 13cm;*/
    }
    .pull-right {
        float: right;
    }
    .pull-left {
        float: left;
    }
    td {
        font-size: 12px;
    }
    th {
        font-size: 12px;
        font-weight: bold;
    }
    .text-right{
        align:right;
    }
    hr{
        color: black;
    }
    textarea{
        font-size: 13px;
    }
    @page{
        /*width: 20cm; */
        /*height: 13cm;*/
    }
</style>