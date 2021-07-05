<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FORM PERSETUJUAN</title>
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
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery.signature.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
  </head>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('ruangan/kamar');?>";
            window.location = url;
            return false; 
        });
    });
</script>
<?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div>";
    }
?>
<body class="hold-transition lockscreen">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="#" style="font-size:30px;"><b>FORM</b>PERSETUJUAN</a>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="lockscreen-name" style="font-size:12px;text-align:right;margin-right:55px"><?php echo $q1->nama_pasien;?></div>
        <div class="lockscreen-item">
            <div class="lockscreen-image">
                <img src="<?php echo base_url();?>img/Logo.png" alt="User Image">
            </div>
            <?php echo form_open("persetujuan/cekpersetujuan/".$aksi,array("class"=>"lockscreen-credentials"));?>
            <!-- <select class="form-control" name="pilihan">
                <option value="">---</option>
                <option value="NIK">NIK</option>
                <option value="HP">No HP</option>
                <option value="BPJS">No BPJS</option>
            </select> -->
            <div class="input-group">
                <input type="text" name="isi" class="form-control" placeholder="nik / hp / no. bpjs">
                <div class="input-group-btn">
                    <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
                <input type="hidden" name="no_reg" class="form-control" value="<?php echo $no_reg ?>">
                <input type="hidden" name="jenis" class="form-control" value="<?php echo $jenis ?>">
            </div>
            <?php echo form_close();?> 
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="help-block text-center"><small>Masukan NIK/ No. HP/ No. BPJS yang terdaftar sebagai verifikasi data</small></div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="lockscreen-footer text-center">
            Copyright © 2020 <b><a href="https://rsciremai.com">RS Ciremai Cirebon</a></b><br>
            All rights reserved
        </div>
    </div>
</body>
</html>