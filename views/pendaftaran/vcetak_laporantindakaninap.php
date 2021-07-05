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
    ?>
    <label style="font-size : 13px">DATASEMEN KESEHATAN WILAYAH 03.04.03</label><br><label style="font-size: 13px;">RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</label>
    <center><strong><h4 style="margin-top:0px; margin-bottom: 0px;">LAPORAN TINDAKAN RAWAT INAP
        <br>(JENIS TINDAKAN : <?php echo $q->nama_tindakan;?>)</h4></strong></center>
    <table border="1" width="100%" rules="rows" cellspacing="0" cellpadding="1">
        <tr>
            <th align="left">No RM</th>
            <td colspan="1"> : <?php echo $q->no_rm?></td>
            <th align="left">No Reg</th>
            <td colspan="7"> : <?php echo $q->no_reg ?></td>
        </tr>
        
        <tr>
            <th align="left">Nama</th>
            <td colspan="1"> : <?php echo $q->nama_pasien?></td>
            <th align="left">Asisten</th>
            <td colspan="5"> : <?php echo $q->asisten?></td>
        </tr>
        <tr>
            <th align="left">Tanggal Lahir / Umur</th>
            <td colspan="1"> : <?php echo date("d-m-Y",strtotime($q->tgl_lahir))." / ".$y?></td>
            <th align="left">Diagnosa</th>
            <td colspan="5"> : <?php echo $q->diagnosa ?></td>
        </tr>
        <tr>
            <th align="left">Dokter</th>
            <td colspan="1"> : <?php echo $q->nama_dokter?></td>
            <th align="left">Jenis Anastesi</th>
            <td colspan="5"> : <?php echo $q->jenis_anastesi ?></td>
        </tr>
        <tr>
            <th align="left">Ruangan</th>
            <td colspan="1"> : <?php echo $q->nama_ruangan?></td>
            <th align="left">Kelas</th>
            <td colspan="5"> : <?php echo $q->nama_kelas ?></td>
        </tr>

        <tr>    
            <th align="left">Tanggal Tindakan</th>
            <td> : <?php echo date("d-m-Y",strtotime($q->tanggal_operasi))?></td>
            <th align="left">Tanggal Ulangan :</th>
            <td> : <?php echo date("d-m-Y",strtotime($q->tanggal_ulangan))?></td>
        </tr>
        <tr>    
            <th align="left">Jam Mulai</th>
            <td> : <?php echo $q->jam_masuk?></td>
            <th align="left">Jam Keluar</th>
            <td> : <?php echo $q->jam_keluar?></td>
        </tr>

        <tr>    
            <th align="left">Keterangan</th>
            <td colspan="3"> : <?php echo $q->keterangan?></td>
        </tr>
        <tr>    
            <th colspan="7" align="center"><center>Laporan</center></th>
        </tr>
        <tr>    
            <td colspan="6">
                <textarea name="" id="" cols="105" rows="10"> <?php echo $q->laporan_operasi?></textarea>
            </td>
        </tr>
    </table>
    <div style="margin-left: 70%" align="center">
        <label>
            <stong>Operator
            <br><br>
            <div class="ttd_qrcode"> </div>
            <br>

            <?php echo $q->nama_dokter?></stong>
    </label>
    </div>
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