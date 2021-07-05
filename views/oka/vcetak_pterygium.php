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
    $(document).ready(function() {

    });
</script>
    <?php 
        if ($q) {
            $a = explode(",", $q->pterygium);
            $b = explode(",", $q->petlain);
            $action ="edit";
        }else{

        }
        $t1 = new DateTime('today');
        $t2 = new DateTime($q->tgl_lahir);
        $y  = $t1->diff($t2)->y;
        $m  = $t1->diff($t2)->m;
        $d  = $t1->diff($t2)->d;
    ?>
    <label style="font-size : 13px">DATASEMEN KESEHATAN WILAYAH 03.04.03</label><br><label style="font-size: 13px;">RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</label>
    <center><strong><h4 style="margin-top:0px; margin-bottom: 0px;">LAPORAN OPERASI PTERYGIUM</h4></strong></center>
    <table border="1" width="100%" rules="rows" cellspacing="0" cellpadding="1">
        <tr>
            <th align="left">Nama</th>
            <td colspan="3"> : <?php echo $q->nama?></td>
            <th align="left">Umur</th>
            <td> : <?php echo $y."Tahun&nbsp;&nbsp;/&nbsp;&nbsp;".$q->jk?></td>
            <th align="left">Tanggal Operasi</th>
            <td> : <?php echo $q->tanggal?></td>
        </tr>
        <tr>
            <th align="left">Mata</th>
            <td>
                <label> <input type="checkbox" name="mata1" value="1"  <?php echo (($a[0] == "1") ? "checked" : "")?>>OD &nbsp;&nbsp;<?php echo $b[0]?></label>
            </td>
            <td colspan="2">
                <label><input type="checkbox" name="mata2" value="1" <?php echo (($a[1] == "1") ? "checked" : "")?>>OS&nbsp;&nbsp;<?php echo $b[1]?></label>
            </td>
            <th align="left">Operator</th>
            <td colspan="3">: <?php echo $q->nama_dokter?></td>
        </tr>
        <tr>
            <th align="left">Pemeriksa</th>
            <td colspan="3"> : <?php echo $q->nama_anastesi?></td>
            <th align="left">Asisten</th>
            <td colspan="3"> : <?php echo $q->nama_operasi?></td>
        </tr>
        <tr>
            <th align="left">Jenis Operasi</th>
            <td colspan="2"> : <?php echo $q->tindakan_operasi?></td>
            <th>Anestesi</th>
            <td> : <?php echo $q->jenis_anastesi?></td>
            <th align="left">Anesthesiologist</th>
            <td colspan="2"> : <?php echo $q->nama_danastesi?></td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th align="left">Antiseptik</th>
            <td>
                <label> <input type="checkbox" name="mata3" value="1" <?php echo (($a[2] == "1") ? "checked" : "")?>>Betadin</label>
            </td>
            <td colspan="1">
                <label>
                    <input type="checkbox" name="mata4" value="1" <?php echo (($a[3] == "1") ? "checked" : "")?>>
                    
                </label>
            </td>
            <td>    
                <input type="text" name="lain3" placeholder="Lainnya" class="form-control" value="<?php echo $b[2] ?>">
            </td>
        </tr>
        <tr>
            <th align="left">Speklum</th>
            <td>
                <label> <input type="checkbox" name="mata5" value="1" <?php echo (($a[4] == "1") ? "checked" : "")?>>Wire</label>
            </td>
            <td>
                <label>
                    <input type="checkbox" name="mata6" value="1" <?php echo (($a[5] == "1") ? "checked" : "")?>>
                </label>
            </td>
            <td>    
                <input type="text" name="lain4" class="form-control" value="<?php echo $b[3] ?>">
            </td>
        </tr>
        <tr>
            <th align="left">Kendala Rektus Superior</th>
            <td>
                <label> <input type="checkbox" name="mata9" value="1" <?php echo (($a[8] == "1") ? "checked" : "")?>>Ya</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata10" value="1" <?php echo (($a[9] == "1") ? "checked" : "")?>>Tidak</label>
            </td>
        </tr>
        <tr>
            <th align="left">Benang</th>
            <td>
                <label> <input type="checkbox" name="mata11" value="1" <?php echo (($a[10] == "1") ? "checked" : "")?>>Nylon 10-0</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata12" value="1" <?php echo (($a[11] == "1") ? "checked" : "")?>>VGA 8-0</label>
            </td>
        </tr>
        <tr>
            <th align="left">Cangkok Konjungrivita</th>
            <td>
                <label> <input type="checkbox" name="mata13" value="1" <?php echo (($a[12] == "1") ? "checked" : "")?>>Ya</label>
            </td>
            <td>
                <label>Ukuran</label>
            </td>
            <td>
                <input type="text" name="lain6" class="form-control" value="<?php echo $b[5] ?>">
            </td>
            <td>
                <label><input type="checkbox" name="mata14" value="1" <?php echo (($a[13] == "1") ? "checked" : "")?>>Tidak</label>
            </td>
        </tr>
        <tr>
            <th align="left">Cangkok Membran Amnion</th>
            <td>
                <label> <input type="checkbox" name="mata16" value="1" <?php echo (($a[15] == "1") ? "checked" : "")?>>Ya</label>
            </td>
            <td>
                <label>Ukuran</label>
            </td>
            <td>
                <input type="text" name="lain7" class="form-control" value="<?php echo $b[6] ?>">
            </td>
            <td>
                <label><input type="checkbox" name="mata17" value="1" <?php echo (($a[16] == "1") ? "checked" : "")?>>Tidak</label>
            </td>
        </tr>
        <tr>
            <th align="left">Bare Selera</th>
            <td>
                <label> <input type="checkbox" name="mata19" value="1" <?php echo (($a[18] == "1") ? "checked" : "")?>>Ya</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata20" value="1" <?php echo (($a[19] == "1") ? "checked" : "")?>>Tidak</label>
            </td>
        </tr>
        <tr>
            <th align="left">Subconj Injeksi</th>
            <td >
                <label><input type="checkbox" name="mata23" value="1" <?php echo (($a[22] == "1") ? "checked" : "")?>>Gentamicyn</label>
            </td>
            <td>
                <input type="text" name="lain8" class="form-control" value="<?php echo $b[7] ?>">
            </td>
            <td rowspan="2">
                <label><input type="checkbox" name="mata22" value="1" <?php echo (($a[21] == "1") ? "checked" : "")?>>Tidak</label>
            </td>
        </tr>
        <tr>   
            <td>&nbsp;</td> 
            <td>
                <label><input type="checkbox" name="mata24" value="1" <?php echo (($a[23] == "1") ? "checked" : "")?>>Dexametason &nbsp;</label>
            </td>
            <td>
                <input type="text" name="lain9" class="form-control" value="<?php echo $b[8] ?>">
            </td>
        </tr>
        <tr>
            <td >
                <label for="">Penjahitan</label>
            </td>
            <td colspan="5">
                <input type="text" name="lain10" class="form-control" value="<?php echo $b[9] ?>">
            </td>
        </tr>
        <tr>
            <td colspan="5"><label class="col-md-12 control-label">Keterangan Tambahan :  </label></td>
        </tr>
        <tr>
            <td colspan="5">
                <textarea class="form-control" name="keterangan_tambahan"  cols="10" rows="10"><?php echo $q->keterangan_tambahan ?></textarea>
            </td>
        </tr>
    </table>
    <div style="margin-left: 70%" align="center">
        <label>
            <stong>Operator
            <br><br><br>
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