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
        window.print();
    });
</script>
<table class="laporan" width="100%">
    <thead>
        <tr><th style='border:none' align="center" colspan="<?php echo ($q->num_rows()*2+7);?>">INOS HARIAN<br>
        PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?><br>
        TAHUN : <?php echo date("Y",strtotime($tgl1))?></th></tr>
        <tr class="bg-navy">
            <th rowspan="2" align='center' style='vertical-align:middle'>No</th>
            <th rowspan="2" align='center' style='vertical-align:middle'>Nama</th>
            <th rowspan="2" align='center' style='vertical-align:middle'>Diagnosa Penyakit</th>
            <th rowspan="2" align='center' style='vertical-align:middle'>JK / Umur</th>
            <th rowspan="2" align='center' style='vertical-align:middle'>NO RM</th>
            <th rowspan="2" align='center' style='vertical-align:middle'>Tgl Masuk</th>
            <th rowspan="2" align='center' style='vertical-align:middle'>Tgl Keluar</th>
            <th colspan="<?php echo ($q->num_rows()*2);?>" align='center' width="<?php echo ($q->num_rows()*2*100)."px";?>">Jenis Infeksi Rumah Sakit</th>
        </tr>
        <tr class="bg-navy">
            <?php
                foreach ($q->result() as $value) {
                    echo "
                        <th align='center' style='vertical-align:middle'>".$value->kode."</th>
                        <th align='center' style='vertical-align:middle'>Tgl Kejadian</th>
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
                        <td align='center'>".$value->jenis_kelamin." / ".$y.' Tahun'."</td>
                        <td>".$value->no_rm."</td>
                        <td align='center'>".date('d-m-Y',strtotime($value->tgl_masuk))."</td>
                        <td align='center'>".($value->tgl_keluar ? date('d-m-Y',strtotime($value->tgl_keluar)) : "-")."</td>";
                    foreach ($q->result() as $val) {
                        $inos = isset($row["inos"][$key][$val->kode]) ? $row["inos"][$key][$val->kode] : "";
                        if ($inos!=""){
                            echo "
                                <td align='center'>".$inos->spesialisasi."</td>
                                <td align='center'>".date("d-m-Y",strtotime($inos->tgl_inos))."</td>
                            ";
                        } else {
                            echo "
                                <td align='center'>-</td>
                                <td align='center'>-</td>
                            ";
                        }
                    }
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