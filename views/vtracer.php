<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title id="juduls">TRACER</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>js/select2/select2.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.js"></script>
    <script src="<?php echo base_url();?>js/slimScroll/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script src="<?php echo base_url();?>js/select2/select2.js"></script>
    <script src="<?php echo base_url();?>js/printThis.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        startTime();
    });
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        $(".clock").html(h + ":" + m + ":" + s);
        getjob();
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
    function mulai(){
        document.getElementById('tracer').pause();
        document.getElementById('tracer').currentTime=0;
        document.getElementById('tracer').play();
    }
    function getjob(){
        $('.invoice').removeClass("hide");
        $.ajax({
            url: "<?php echo site_url('tracer/getjob')?>", 
            type: 'POST', 
            success: function(result){
                var val = JSON.parse(result);
                var value = val["data"];
                if (val["status"]>0){
                    mulai();
                    var content = "";
                    var jumlah_pasien = "000"+value.jumlah_pasien;
                    $(".barcode").barcode(value.no_reg,"code39",{showHRI: false,barHeight:25});
                    content += '<tr><td colspan="2">'+value.nama_dokter+' ('+value.no_antrian+')</td></tr>';
                    content += '<tr><td colspan="2">'+value.nama_poli+' ('+(jumlah_pasien.substring(jumlah_pasien.length - 3, jumlah_pasien.length))+')<span style="float:right">('+value.jenis+')</span></td></tr>';
                    content += '<tr><td width="100px">No. RM</td><td>: '+value.no_pasien+'</td></tr>';
                    content += '<tr><td>No. Registrasi</td><td>: '+value.no_reg+'</td></tr>';
                    content += '<tr><td>Nama</td><td>: '+value.nama_pasien+'</td></tr>';
                    $(".konten_print").html(content);
                    var divToPrint=document.getElementById("invoice");
                    newWin= window.open("");
                    newWin.document.write(divToPrint.outerHTML);
                    newWin.print();
                    newWin.close();
                    $('.invoice').addClass("hide");
                }
            },
            error: function(result){
                console.log(result);
            }
        });
    }
</script>
<body class="skin-blue layout-top-nav fixed">
    <audio id="tracer" src="<?php echo base_url();?>rekaman/tracer.mp3"></audio>
    <input type="hidden" name="id">
    <div class="wrapper">
        <div class="main-header">
            <div class="atas">
                <div class="col-lg-3 col-xs-2 col-sm-2">
                    <div class="logo_atas"><img src="<?php echo base_url();?>img/hesti.png"></div>
                </div>
                <div class="col-lg-6 col-xs-8 col-sm-8">
                    <div class="judul">
                        TRACER
                        <span class="tanggal text-green"></span>
                        <span class="clock text-green"></span>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-2 col-sm-2">
                    <div class="logo_atas pull-right"><img src="<?php echo base_url();?>img/siliwangi.png"></div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <section class="content"></section>
        </div>
        <footer class="main-footer" id="footers">
            <div class="pull-right hidden-xs"></div>
            <strong>Copyright &copy; 2019 <a href="#">TRUSTME</a></strong>
        </footer>
    </div>
    <section class="invoice no-border hide" id="invoice">
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:12px">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </section>
    <style type="text/css">
        .navbar-nav > .notifications-menu > .dropdown-menu > li .menu, .navbar-nav > .messages-menu > .dropdown-menu > li .menu, .navbar-nav > .tasks-menu > .dropdown-menu > li .menu {
            max-height: 420px;
        }
        .content-wrapper{
            background: url("img/rsciremai.png") no-repeat; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            position: fixed;
            top:0px;
            bottom: 0px;
            left: 0px;
            right: 0px;
        }
        .menutitle{
            text-align: center;
            font-size: 16px;
            min-height: 40px;
            padding-top:20px;
            font-weight: bold;
            color: #e0e0e0;
        }
        .alert{
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f4f4f4;
        }
        .alert p{
            margin-top: 20px;
        }
        .judul{
            text-align: center;
            margin: 20px 0px;
            font-size: 50px;
            font-weight: bold;
            display: block;
            color: red;
        }
        .tanggal{
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            display: block;
            color: #e0e0e0;
        }
        .clock{
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            display: block;
            color: #e0e0e0;
        }
        .atas{
            background-color: black;
            padding: 40px 0px;
            height:200px;
        }
        .bawah{
            padding: 140px 0px 40px;
        }
        .login-box,
        .register-box {
          width: 700px;
          margin: 7% auto;
        }
        .alert{
            background-color: transparent;
            border:0px;
        }
        .main-footer {
            position: fixed;
            z-index: 1030;
            bottom: 0px;
            right: 0px;
            left: 0px;
        }
        .logo_atas img{
            width: 120px;
        }
        .img-thumbnail{
            border:0px;
        }
        @media (max-width: 799px) {
            .judul{
                text-align: center;
                margin: 20px 0px;
                font-size: 17px;
                font-weight: bold;
                display: block;
                color: red;
            }
            .atas{
                background-color: black;
                padding: 20px 0px;
                height:130px;
            }
            .bawah{
                padding: 30px 0px;
            }
            .logo_atas img{
                width: 80px;
            }
            img.tombol{
                width: 200px;
            }
        }
        @media (min-width: 800px) and (max-width: 1300px) {
            .judul{
                text-align: center;
                margin: 20px 0px;
                font-size: 30px;
                font-weight: bold;
                display: block;
                color: red;
            }
            .atas{
                background-color: black;
                padding: 20px 0px;
                height:150px;
            }
            img.tombol{
                width: 250px;
            }
        }
    </style>
</body>