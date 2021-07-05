<!DOCTYPE html>
<html>
<head>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Inap</title>
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
    <script>
        window.print();
    </script>
    <title></title>
</head>
<body>
    <table  width="100%" align="center" border="0">
        <tr>
            <td class="text-center" colspan="2">
                INSTALASI RAWAT INAP
            </td>
            <td></td>
        </tr>

        <tr>
            <td class="text-center" colspan="2">KEJADIAN INFEKSI RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</td>
        </tr>
        <tr>
            <?php
                $tgl2 = $this->session->userdata("tgl2")=="" ? date("Y-m-d") : $this->session->userdata("tgl2"); 
                $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");?>
            <td class="text-center" colspan="2">BULAN : <?php echo strtoupper($bulan[date("m",strtotime($tgl2))]); ?></td>
        </tr>
    </table>
    <br>
    <table border="1" cellspacing="0" cellpadding="1" align="center">
        <thead>
            <tr>
                <td rowspan="2" class='text-center' width="30px">No</td>
                <td rowspan="2" class='text-center' width="150px">Nama</td>
                <td rowspan="2" class='text-center' width="100px">Diagnosa Penyakit</td>
                <td rowspan="2" class='text-center' width="100px">JK / Umur</td>
                <td rowspan="2" class='text-center' width="100px">NO RM</td>
                <td rowspan="2" class='text-center' width="100px">Tgl Masuk</td>
                <td rowspan="2" class='text-center' width="100px">Tgl Keluar</td>
                <td colspan="<?php echo ($q->num_rows()*2);?>" class='text-center'>Jenis Infeksi Rumah Sakit</td>
            </tr>
            <tr>
                <?php
                    foreach ($q->result() as $value) {
                        echo "
                            <td class='text-center'>".$value->kode."</td>
                            <td class='text-center'>Tgl Kejadian</td>
                        ";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=0;
                foreach ($row["data"] as $key => $value) {
                    $t1 = new DateTime('today');
                    $t2 = new DateTime($value->tgl_lahir);
                    $y  = $t1->diff($t2)->y;
                    $m  = $t1->diff($t2)->m;
                    $d  = $t1->diff($t2)->d;

                    $i++;
                    echo "
                        <tr id=data>
                            <td>".$i."</td>
                            <td>".$value->nama_pasien."</td>
                            <td>".$value->diagnosa_penyakit."</td>
                            <td class='text-center'>".$value->jenis_kelamin." / ".$y.' Tahun'."</td>
                            <td>".$value->no_rm."</td>
                            <td class='text-center'>".date('d-m-Y',strtotime($value->tgl_masuk))."</td>
                            <td class='text-center'>".($value->tgl_keluar ? date('d-m-Y',strtotime($value->tgl_keluar)) : "-")."</td>";
                        foreach ($q->result() as $val) {
                            $inos = isset($row["inos"][$key][$val->kode]) ? $row["inos"][$key][$val->kode] : "";
                            if ($inos!=""){
                                echo "
                                    <td class='text-center'>".$inos->spesialisasi."</td>
                                    <td class='text-center'>".date("d-m-Y",strtotime($inos->tgl_inos))."</td>
                                ";
                            } else {
                                echo "
                                    <td class='text-center'>-</td>
                                    <td class='text-center'>-</td>
                                ";
                            }
                        }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>