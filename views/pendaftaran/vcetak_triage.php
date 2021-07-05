<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    
    <link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
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
            // window.print();
            getttd1();
            getttd();
            window.print();
        });
        function getttd(){
            var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'.$q->id_dokter_triage);?>";
            $('.ttd_qrcode').qrcode({width: 100,height: 100, text:ttd});
        }

        function getttd1(){
            var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'.$q->id_dokter_igd);?>";
            $('.ttd_qrcode_igd').qrcode({width: 100,height: 100, text:ttd});
        }
</script> 
    <table class="table">
        <tr><td align="right">RM.05.1.1/ RI/ RSC</td></tr>
    </table>
    <table border="1" width="100%" cellspacing="0" cellpadding="1" id="tbl1">
        <tr>
            <td rowspan="4" align="center"><img src="<?php echo base_url("img/Logo.png")?>"> <br><strong>RS Ciremai</strong></td>
            <td align="center" rowspan="4" colspan="3">
                <h4 style="margin-top:0px; margin-bottom: 0px;">ASSESMEN TRIAGE <br> INSTALASI GAWAT DARURAT</h4>
            </td>
            <td><strong>No. Rekam Medik</strong></td>
            <td colspan="10"><strong><?php echo $q->no_rm?></strong></td>
        </tr>
        <tr>
            <td> <strong>No. Registrasi</strong></td>
            <td colspan="10"> <strong><?php echo $q->no_reg?></strong></td>
        </tr>
        <tr>
            <td> <strong>Nama</strong></td>
            <td colspan="10"> <strong><?php echo $q->nama_pasien?></strong></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td colspan="10"> <strong><?php echo $q->tgl_lahir?></strong></td>
        </tr>
        <tr>
            <th align="left" colspan="4">Tanggal Kunjungan : <?php echo date("d-m-Y",strtotime($q->tanggal))?></th>
            <th align="left" colspan="10">Waktu Kunjungan : <?php echo $q->jam?></th>
        </tr>
        <tr>
            <td colspan="10" align="center">    
                <strong>KRITERIA TRIAGE BERDASARKAN AUSTRALIAN TRIAGE SCALE (ATS)*</strong>
            </td>
        </tr>
        
        <?php 
            $warna = "";
            $ats = $q->triage;
            if($ats == "ATS 1 (Merah)"){
                $wrn = "(Merah)";
                $warna = 'id="tbl-red" style="background-color : red;"';
            }else
            if($ats == "ATS 2 (Orange)"){
                $wrn = "(Orange)";
                $warna = 'id="tbl-orange" style="background-color : orange;"';
            }else
            if($ats == "ATS 3 (Kuning)"){
                $wrn = "(Kuning)";
                $warna = 'style="background-color : yellow;"';
            }else
            if($ats == "ATS 4 (Hijau)"){
                $wrn = "(Hijau)";
                $warna = 'style="background-color : green;"';
            }else
            if($ats == "D.O.A (Hitam)"){
                $wrn = "(Hitam)";
                $warna = 'style="background-color : black; color:white;"';
            }
            else{
                $warna = '';
            }
            if($ats == "D.O.A"){
                ?>
                <tr>
                    <th align="center">Triage</th>
                    <th colspan="8" align="center">D.O.A</th>
                <tr>    
                    <td align="left" <?php echo $warna?> ><?php echo $q->triage?></td>
                    <td colspan="8" align="left" <?php echo $warna?>><?php echo $q->doa?></td>
                </tr>
                <?php
                // $warna = 'style="background : black"';
            }else{?>
                    <tr>
                        <th align="center" id="tbl1">Triage</th>
                        <th align="center">Survei Primer</th>
                        <th align="center">Jalan Nafas</th>
                        <th align="center">Pernafasan</th>
                        <th align="center">Sirkulasi</th>
                        <th align="center">Gangguan Fungsi Lain</th>
                        <th align="center">Kesadaran</th>
                        <th align="center">Nyeri</th>
                    </tr>
                    <tr>
                        <td align="center" <?php echo $warna?> ><?php echo $q->triage." ".$wrn;?>  <br> <?php echo $q->waktu?></td>
                        <td align="center" <?php echo $warna?>><?php echo $q->survei_primer?></td>
                        <td align="center" <?php echo $warna?>><?php echo $q->jalan_nafas?></td>
                        <td align="center" <?php echo $warna?>><?php echo $q->pernafasan?></td>
                        <td align="center" <?php echo $warna?>><?php echo $q->sirkulasi?></td>
                        <td align="center" <?php echo $warna?>><?php echo $q->gangguan?></td>
                        <td align="center" <?php echo $warna?>><?php echo $q->kesadaran?></td>
                        <td align="center" <?php echo $warna?>><?php echo $q->nyeri?></td>
                    </tr>
                    <!-- <tr>
                        <th align="center" rowspan="2">TTV</th>
                        <td align="left">TD 1 : <?php echo $q->td?></td>
                        <td align="left">TD 2 : <?php echo $q->td?></td>
                        <td align="left">Nadi : <?php echo $q->nadi?></td>
                        <td align="left">Respirasi : <?php echo $q->respirasi?></td>
                        <td align="left">Suhu : <?php echo $q->suhu?></td>
                        <td colspan="3" align="left">SpO2 : <?php echo $q->spo2?></td>
                    </tr> 
                    <tr>
                        <td align="left">BB : <?php echo $q->bb?></td>
                        <td align="left">TB : <?php echo $q->tb?></td>
                        <td align="left">LK : <?php echo $q->lk?></td>
                        <td align="left">LD : <?php echo $q->ld?></td>
                        <td colspan="4" align="left">LP : <?php echo $q->lp?></td>
                    </tr> -->
                </table>
    <br><?php
            }
        ?>
        
    <table border="1" width="100%" cellspacing="0" cellpadding="1">
        <tr>
            <td colspan="2">Keputusan : <?php echo $q->keputusan?> Jam : <?php echo $q->waktu_keputusan?> WIB</td>
        </tr>
        <!-- <tr>
            <td colspan="2">Anamnesis : <?php echo $q->anamnesis?>
                <br>S : <?php echo $q->s ?>
                <br>O : <?php echo $q->o ?>
                <br>A : <?php echo $q->a ?>
                <br>P : <?php echo $q->p ?>
            </td>
        </tr> -->
        <tr>
            <td>Dokter Triage 
                <br>
                <br>
                <div class="ttd_qrcode"> </div>
                <br>
                <?php echo $q->dokter_triage?>
            </td>
            <td>Perawat Triage 
                <br>
                <br>
                <div class="ttd_qrcode_igd"> </div>
                <br>
                <?php echo $q->petugas_igd?>
            </td>
        </tr>
    </table>
<style>

/*@media print {
    tr {
        background-color: #black !important;
        -webkit-print-color-adjust: exact; 
    }
}

@media print {
    td {
        color: white !important;
    }
}*/
@media print{
  #tbl-red {background-color:red;}
  #tbl-orange {background-color:orange;}
}
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