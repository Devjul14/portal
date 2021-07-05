<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title id="juduls">PENDAFTARAN ONLINE</title>
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
    <script src="<?php echo base_url();?>js/domtoimage.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        startTime();
        gettanggal();
        localStorage.removeItem('status');
        $("[name='nohp']").keyup(function(e){
            var nohp = $(this).val();
            if (nohp.length>=11){
                $(".next_home").removeAttr("disabled");
            } else {
                $(".next_home").attr("disabled","disabled");
            }
        });
        $("[name='tgl']").datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0, 
        }).datepicker('setDate', 'today');
        $(".next_home").click(function(){
            $(".home").removeClass("hide");
            $(".nohp").addClass("hide");
            localStorage.setItem('nohp',$("[name='nohp']").val());
            localStorage.setItem('tgl',$("[name='tgl']").val());
        });
        $(".lama").click(function(){
            $(".home").addClass("hide");
            $(".poli").removeClass("hide");
            $(".dokter").addClass("hide");
            $(".daftar").addClass("hide");
            localStorage.setItem('status','LAMA');
            localStorage.removeItem('kode');
            localStorage.removeItem('dokter');
            localStorage.removeItem('golpasien');
            localStorage.removeItem('status_bayar');
        });
        $(".baru").click(function(){
            $(".home").addClass("hide");
            $(".poli").removeClass("hide");
            $(".dokter").addClass("hide");
            $(".daftar").addClass("hide");
            localStorage.setItem('status','BARU');
            localStorage.removeItem('kode');
            localStorage.removeItem('dokter');
            localStorage.removeItem('golpasien');
            localStorage.removeItem('status_bayar');
        });
        $(".back").click(function(){
            $(".poli").addClass("hide");
            $(".dokter").addClass("hide");
            $(".home").removeClass("hide");
            $(".daftar").addClass("hide");
            localStorage.removeItem('kode');
            localStorage.removeItem('dokter');
            localStorage.removeItem('status');
        });
        $('.listdokter').on('click',".back_poli",function(){
            $(".poli").removeClass("hide");
            $(".dokter").addClass("hide");
            $(".home").addClass("hide");
            $(".daftar").addClass("hide");
            localStorage.removeItem('dokter');
        });
        $('.listdokter').on('click',".lanjut",function(){
            var status = localStorage.getItem('status');
            if (status=="LAMA"){
                $(".daftar").removeClass("hide");
                $("[name='no_rm']").focus();
            } else {
                getgolpasien();
                $(".golpasien").removeClass("hide");
            }
            $(".poli").addClass("hide");
            $(".dokter").addClass("hide");
            $(".home").addClass("hide");
            var dokter = $(this).attr("kode");
            localStorage.setItem('dokter',dokter);
        });
        $('.listgolpasien').on('click',".lanjut_golpasien",function(){
            $(".pilih_kelas").modal("show");
            $(".poli").addClass("hide");
            $(".dokter").addClass("hide");
            $(".home").addClass("hide");
            var golpasien = $(this).attr("kode");
            var status_bayar = $(this).attr("status_bayar");
            localStorage.setItem('golpasien',golpasien);
            localStorage.setItem('status_bayar',status_bayar);
        });
        $(".pilihpoli").click(function(){
            $(".home").addClass("hide");
            $(".poli").addClass("hide");
            $(".dokter").removeClass("hide");
            var kode = $(this).attr("kode");
            localStorage.setItem('kode',kode);
            getdokter(kode);
        });
        $("[name='no_rm']").keypress(function(e){
            // var no_rm = "00000"+$(this).val();
            var no_rm = $(this).val();
            var kode = localStorage.getItem("kode");
            var tgl = localStorage.getItem("tgl");
            if (e.which==13){
                // no_rm = no_rm.substring(no_rm.length-6);
                // $(this).val(no_rm);
                $.ajax({
                    url: "<?php echo site_url('antrian/getpasien_online')?>", 
                    type: 'POST', 
                    data: {no_pasien:no_rm,poli:kode,tgl_daftar:tgl},
                    success: function(result){
                        var value = JSON.parse(result);
                        if (value!=null){
                            if (value=="ada"){
                                alert("Anda telah mendaftar di poli yang sama");
                                $(".simpan_daftar").attr("disabled","disabled");
                            } else {
                                var nama_pasien = value.nama_pasien;
                                $(".nama_pasien").removeClass("hide");
                                $("[name='nama_pasien']").val(nama_pasien);
                                $("[name='no_rm']").val(value.no_pasien);
                                $(".simpan_daftar").removeAttr("disabled");
                            }
                        } else {
                            $(".nama_pasien").addClass("hide");
                            $("[name='nama_pasien']").val();
                            $(".simpan_daftar").attr("disabled","disabled");
                            alert("Data tidak di temukan");
                        }
                    },
                    error: function(result){
                        console.log(result);
                    }
                });

            }
        });
        $('.daftar').on('click',".back_dokter",function(){
            $(".poli").addClass("hide");
            $(".dokter").removeClass("hide");
            $(".home").addClass("hide");
            $(".daftar").addClass("hide");
            $(".regsebelumnya").addClass("hide");
            localStorage.removeItem('dokter');
            localStorage.removeItem('golpasien');
        });
        $('.daftar').on('click',".btnnoregsebelumnya",function(){
            var no_reg = $(this).attr("no_reg");
            $("[name='noregsebelumnya']").val(no_reg);
            $(".pilih_kelas").modal("show");
        });
        $('.daftar').on('click',".back_daftar",function(){
            $(".regsebelumnya").addClass("hide");
        });
        $('.listgolpasien').on('click',".back_dokter",function(){
            $(".poli").addClass("hide");
            $(".dokter").removeClass("hide");
            $(".home").addClass("hide");
            $(".golpasien").addClass("hide");
            $(".daftar").addClass("hide");
            localStorage.removeItem('dokter');
            localStorage.removeItem('golpasien');
            localStorage.removeItem('status_bayar');
        });
        $('.daftar').on('click',".simpan_daftar",function(){
            var poli = localStorage.getItem("kode");
            if (poli=="0102024" || poli=="0102025"){
                var no_rm = $("[name='no_rm']").val();
                var table = "";
                table += "<tr class='bg-navy'>";
                table += "<th class='text-right'>TANGGAL</th>";
                table += "<th class='text-left'>NO. REG</th>";
                table += "</tr>";
                $(".regsebelumnya").removeClass("hide");
                $.ajax({
                    url: "<?php echo site_url('antrian/getnoregsebelumnya')?>", 
                    type: 'POST', 
                    data: {no_pasien:no_rm},
                    success: function(result){
                        $.each(JSON.parse(result), function(key, val){
                            var t = val.tanggal;
                            var tgl = t.split(" ");
                            table += "<tr>";
                            table += "<td class='text-right'><button class='btnnoregsebelumnya btn btn-warning' no_reg='"+val.no_reg+"'>"+tgl_indo(tgl[0])+" "+tgl[1]+"</button></td>";
                            table += "<td class='text-left'><button class='btnnoregsebelumnya btn btn-success' no_reg='"+val.no_reg+"'>"+val.no_reg+"</button></td>";
                            table += "</tr>";
                        });
                        $(".list_regsebelumnya").html(table);
                    },
                    error: function(result){
                        console.log(result);
                    }
                });
            } else {
                $(".pilih_kelas").modal("show");
            }
        });
        $("tr.pol").click(function(){
            $("tr.pol").removeClass("bg-blue");
            $(this).addClass("bg-blue");
        });
        $(".reguler").click(function(){
            simpan("R");
        });
        $(".executive").click(function(){
            simpan("E");
        });
    });
    function getdokter(kode){
        $.ajax({
            url: "<?php echo site_url('antrian/getdokter')?>", 
            type: 'POST', 
            success: function(result){
                var content = "";
                var ada = 0;
                var tgl = localStorage.getItem("tgl").split("-");
                var tgl_daftar = tgl[2]+"/"+tgl[1]+"/"+tgl[0];
                var day = new Date(tgl_daftar);
                day = day.getDay();
                console.log(day);
                $.each(JSON.parse(result), function(key0, val0){
                    $.each(val0, function(key, value){
                        if (value["hari"]!=null){
                            var hari = value["hari"];
                            hari = hari.split(",");
                            var jam1 = value["jam"];
                            if (jam1!=null)
                            jam_1 = jam1.split(",");
                            var jam2 = value["jam2"];
                            if (jam2!=null)
                            jam_2 = jam2.split(",");
                            if (hari[day]=="1"){
                                if (kode==key0){
                                    ada++;
                                    jam_1 = jam_1[day]==undefined ? "" : jam_1[day];
                                    jam_2 = jam_2[day]==undefined ? "" : jam_2[day];
                                    content += "<tr class='pol'>";
                                    content += "<td><button class='back_poli btn btn-lg btn-warning'><i class='fa fa-angle-double-left'></i></button></td>";
                                    content += "<td style='vertical-align:middle'>"+value["nama_dokter"]+" ("+jam_1+")</td>";
                                    content += "<td class='text-right'><button class='lanjut btn btn-lg btn-success' kode='"+value["id_dokter"]+"'><i class='fa fa-angle-double-right'></i></button></td>";
                                    content += "</tr>";
                                }
                            }
                        }
                    });
                });
                if (!ada){
                    content += "<tr class='pol'>";
                    content += "<td><button class='back_poli btn btn-lg btn-warning'><i class='fa fa-angle-double-left'></i></button></td>";
                    content += "<td style='vertical-align:middle'>&nbsp;</td>";
                    content += "<td class='text-right'>&nbsp;</td>";
                    content += "</tr>";
                }
                $(".listdokter").html(content);
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function getgolpasien(){
        $.ajax({
            url: "<?php echo site_url('antrian/getgolpasien')?>", 
            type: 'POST', 
            success: function(result){
                var content = "";
                var ada = 0;
                $.each(JSON.parse(result), function(key, value){
                        ada++;
                        content += "<tr class='pol'>";
                        content += "<td><button class='back_dokter btn btn-lg btn-warning'><i class='fa fa-angle-double-left'></i></button></td>";
                        content += "<td style='vertical-align:middle'>"+value.keterangan+"</td>";
                        content += "<td class='text-right'><button class='lanjut_golpasien btn btn-lg btn-success' kode='"+value.id_gol+"' status_bayar='"+value.status+"'><i class='fa fa-angle-double-right'></i></button></td>";
                        content += "</tr>";
                });
                if (!ada){
                    content += "<tr class='pol'>";
                    content += "<td><button class='back_dokter btn btn-lg btn-warning'><i class='fa fa-angle-double-left'></i></button></td>";
                    content += "<td style='vertical-align:middle'>&nbsp;</td>";
                    content += "<td class='text-right'>&nbsp;</td>";
                    content += "</tr>";
                }
                $(".listgolpasien").html(content);
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function simpan(jenis){
        $('.invoice').removeClass("hide");
        var status_pasien = localStorage.getItem("status");
        var kode = localStorage.getItem("kode");
        var dokter = localStorage.getItem("dokter");
        var golpasien = localStorage.getItem("golpasien");
        var status_bayar = localStorage.getItem("status_bayar");
        var tgl = localStorage.getItem("tgl");
        var nohp = localStorage.getItem("nohp");
        var no_pasien = $("[name='no_rm']").val();
        var noregsebelumnya = $("[name='noregsebelumnya']").val();
        $.ajax({
            url: "<?php echo site_url('online/simpan_pasien')?>", 
            type: 'POST', 
            data: {tgl_daftar:tgl, nohp: nohp, no_pasien: no_pasien,poli: kode, dokter: dokter, jenis: jenis, status_pasien: status_pasien, golpasien: golpasien, status_bayar: status_bayar, noregsebelumnya: noregsebelumnya},
            success: function(result){
                $('.terimakasih').modal("show");
                var value = JSON.parse(result);
                var content = "";
                $(".barcode").barcode(value.no_reg,"code39",{showHRI: false,barHeight:25});
                content += '<tr><td colspan="2">'+value.nama_dokter+' <span style="float:right;font-size:15px">('+value.no_antrian+')</span></td></tr>';
                content += '<tr><td colspan="2">'+value.poli+' ('+value.jumlah_pasien+')<span style="float:right">('+value.jenis+')</span></td></tr>';
                content += '<tr><td width="100px">No. RM</td><td>: '+value.no_pasien+'</td></tr>';
                content += '<tr><td>No. Registrasi</td><td>: '+value.no_reg+'</td></tr>';
                content += '<tr><td>Nama</td><td>: '+value.nama_pasien+'</td></tr>';
                // html2canvas(document.getElementById("barcode")).then(function(canvas) {
                //     var imagedata = canvas.toDataURL('image/jpg');
                //     content += '<tr><td colspan="2"><br><img src="'+imagedata+'"></td></tr>';
                // });
                $(".konten_print").html(content);
                var divToPrint=document.getElementById("invoice");
                // newWin= window.open("");
                // newWin.document.write(divToPrint.outerHTML);
                // newWin.print();
                // newWin.close();
                // $('.invoice').addClass("hide");
                // $('.invoice').printThis({canvas:true});
                var opt = {
                    margin: 5,
                    filename: 'pendaftaran.pdf'
                };
                var string = $(".invoice").html();
                var page = document.getElementById('invoice');
                // html2pdf().from(string).set(opt).outputPdf();
                domtoimage.toPng(divToPrint)
                    .then(function (dataUrl) {
                        var img = new Image();
                        img.src = dataUrl;
                        html2pdf().from(img).set(opt).save();
                    })
                    .catch(function (error) {
                        console.error('oops, something went wrong!', error);
                    });
                $(".pilih_kelas").modal("hide");
                $(".nohp").removeClass("hide");
                $('.daftar').addClass("hide");
                $('.golpasien').addClass("hide");
                $(".nama_pasien").addClass("hide");
                $("[name='nama_pasien']").val();
                $(".simpan_daftar").attr("disabled","disabled");
                setTimeout(function(){
                    $('.terimakasih').modal("hide");
                    $('.invoice').addClass("hide");
                }, 3500);
                localStorage.removeItem('kode');
                localStorage.removeItem('dokter');
                localStorage.removeItem('status');
                localStorage.removeItem('golpasien');
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function hidediv(){
        // $('.invoice').addClass("hide");
    }
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        $(".clock").html(h + ":" + m + ":" + s);
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
    function gettanggal(){
        var d = new Date();
        var weekday = new Array(7);
        weekday[0] = "Minggu";
        weekday[1] = "Senin";
        weekday[2] = "Selasa";
        weekday[3] = "Rabu";
        weekday[4] = "Kamis";
        weekday[5] = "Jumat";
        weekday[6] = "Sabtu";
        var month = new Array();
        month[0] = "Jan";
        month[1] = "Feb";
        month[2] = "Mar";
        month[3] = "Apr";
        month[4] = "Mei";
        month[5] = "Jun";
        month[6] = "Jul";
        month[7] = "Agust";
        month[8] = "Sept";
        month[9] = "Okt";
        month[10] = "Nov";
        month[11] = "Des";
        $(".tanggal").html(weekday[d.getDay()]+", "+d.getDate()+" "+month[d.getMonth()]+" "+d.getFullYear());
    }
    function tgl_indo(tgl,tipe=1){
        var date = tgl.substring(tgl.length,tgl.length-2);
        if (tipe==1)
            var bln = tgl.substring(5,7);
        else
            var bln = tgl.substring(4,6);
        var thn = tgl.substring(0,4);
        return date+"-"+bln+"-"+thn;
    }
</script>
<body class="skin-blue layout-top-nav fixed">
    <input type="hidden" name="id">
    <div class="wrapper">
        <div class="main-header">
            <div class="atas">
                <div class="col-lg-3 col-xs-2 col-sm-2">
                    <div class="logo_atas"><img src="<?php echo base_url();?>img/hesti.png"></div>
                </div>
                <div class="col-lg-6 col-xs-8 col-sm-8">
                    <div class="judul">
                        PENDAFTARAN ONLINE
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
            <div class="video">
                <video width="100%" class="video_player" loop autoplay controls>
                    <source src="<?php echo base_url();?>/video/rsciremai.webm" type="video/webm"></source>
                </video>
            </div>
            <section class="content">
                <div class="bawah row">
                    <div class="nohp">
                        <div class="login-box">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="nohp" placeholder="Nomor Handphone/ Telpon" autocomplete="off">
                                        <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback text-bold text-center">Tanggal Daftar</div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="tgl" placeholder="Tanggal Daftar" autocomplete="off">
                                        <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12"><button class="next_home btn btn-success btn-lg btn-block" disabled><i class="fa fa-edit"></i>&nbsp;&nbsp;<small>DAFTAR via WEB / BROWSER</small></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="login-box text-center">
                            <div class="form-group has-feedback">
                                <b style="color:white">Download Aplikasi</b><br>
                                <a href="https://drive.google.com/file/d/1hOYp5X216TRvCUr_gQWZmijtHBlm8LYA/view?usp=drivesdk"><img src="<?php echo base_url();?>/img/google_play.png" style="width:200px"></a>
                            </div>
                        </div>
                    </div>
                    <div class="home hide">
                        <div class="col-lg-6 col-xs-6 col-sm-6">
                            <div class="alert">
                                <p class="text-center">
                                    <a class="baru" href="#">
                                        <img class="tombol" src="<?php echo base_url();?>img/baru.png">
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-xs-6 col-sm-6">
                            <div class="alert">
                                <p class="text-center">
                                    <a class="finger" href="#">
                                        <img class="tombol" src="<?php echo base_url();?>img/fp.png">
                                    </a>
                                </p>
                            </div>
                        </div> -->
                        <div class="col-lg-6 col-xs-6 col-sm-6">
                            <div class="alert">
                                <p class="text-center">
                                    <a class="lama" href="#">
                                        <img class="tombol" src="<?php echo base_url();?>img/lama.png">
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="poli hide">
                        <div class="login-box">
                            <div class="box box-solid">
                                <div class="box-header text-center bg-navy"><h3 class="box-title">POLIKLINIK</h3></div>
                                <div class="box-body">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        <?php
                                            foreach($p->result() as $data){
                                                echo "<tr class='pol'>";
                                                echo "<td><button class='back btn btn-lg btn-warning'><i class='fa fa-angle-double-left'></i></button></td>";
                                                echo "<td style='vertical-align:middle'>".$data->keterangan."</td>";
                                                echo "<td class='text-right'><button kode='".$data->kode."' class='pilihpoli btn btn-lg btn-success'><i class='fa fa-angle-double-right'></i></button></td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dokter hide">
                        <div class="login-box">
                            <div class="box box-solid">
                                <div class="box-header text-center bg-navy"><h3 class="box-title">NAMA DOKTER</h3></div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody class="listdokter"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="golpasien hide">
                        <div class="login-box">
                            <div class="box box-solid">
                                <div class="box-header text-center bg-navy"><h3 class="box-title">GOL. PASIEN</h3></div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody class="listgolpasien"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="daftar hide">
                        <div class="login-box">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="no_rm" placeholder="Nomor RM/ BPJS/ NIK" autocomplete="off">
                                        <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
                                    </div>
                                    <div class="nama_pasien form-group hide has-feedback">
                                        <input type="text" class="form-control" name="nama_pasien" readonly autocomplete="off">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                    <div class="regsebelumnya hide">
                                        <input name="noregsebelumnya" type="text" class="form-control" readonly>
                                        <table class="table table-striped table-hover">
                                            <tbody class="list_regsebelumnya"></tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6"><button class="back_dokter btn btn-warning btn-lg btn-block"><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;KEMBALI</button></div>
                                        <div class="col-xs-6"><button class="simpan_daftar btn btn-success btn-lg btn-block" disabled><i class="fa fa-edit"></i>&nbsp;&nbsp;DAFTAR</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer" id="footers">
            <div class="pull-right hidden-xs"></div>
            <strong>Copyright &copy; 2019 <a href="#">TRUSTME</a></strong>
        </footer>
    </div>
    <div class='loading modal'>
        <div class='text-center align-middle' style="margin-top: 200px">
            <div class="col-xs-3 col-sm-3 col-lg-5"></div>
            <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
                <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url();?>img/load.gif" width="150px"></div>
                <div style="font-size:12px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Harap menunggu, data sedang diproses</div>
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-5"></div>
        </div>
    </div>
    <div class="modal fade pilih_kelas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                </div> -->
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-lg-6 col-xs-6 col-sm-6">
                                <div class="alert">
                                    <p class="text-center">
                                        <a class="reguler" href="#">
                                            <img class="tombol img-thumbnail img-circle" src="<?php echo base_url();?>img/reguler.png">
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-6 col-sm-6 pull-right">
                                <div class="alert">
                                    <p class="text-center">
                                        <a class="executive" href="#">
                                            <img class="tombol img-thumbnail img-circle" src="<?php echo base_url();?>img/executive.png">
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="invoice no-border hide" id="invoice">
        <table cellspacing="0" cellpadding="0" width="90%" style="font-size:12px">
            <thead>
                <tr><td colspan="2"><img src="<?php echo base_url();?>img/siliwangi.png" style="width:50px"></td></tr>
            </thead>
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
                <tr><td colspan="2"><br>RS CIREMAI pilihan utama prajurit, pns dan keluarga serta masyarakat diwilayah Korem 063/SGJ</td></tr>
            </tfoot>
        </table>
    </section>
    <div class='terimakasih modal'>
            <div class='text-center align-middle' style="margin-top: 200px">
                <div class="col-xs-3 col-sm-3 col-lg-5"></div>
                <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
                    <div style="font-size:18px;font-weight:bold;color:#696969;">
                        Terima kasih telah mendaftar online.
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-lg-5"></div>
            </div>
        </div>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/app.js"></script>
    <script src="<?php echo base_url();?>js/demo.js"></script>
    <style type="text/css">
        .navbar-nav > .notifications-menu > .dropdown-menu > li .menu, .navbar-nav > .messages-menu > .dropdown-menu > li .menu, .navbar-nav > .tasks-menu > .dropdown-menu > li .menu {
            max-height: 420px;
        }
        .invoice {
            width:10cm;
        }
        .invoice td{
            font-size: 10px;
        }
        .content-wrapper{
            background: url("img/rsciremai.png") no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
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
            font-size: 40px;
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
            padding: 0px 0px 40px;
        }
        .login-box,
        .register-box {
          width: 700px;
          margin: 0 auto;
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
        img.tombol{
            width: 450px;
        }
        .img-thumbnail{
            border:0px;
        }
        tr.pol td{
            font-size: 25px;
            font-weight: bold;
        }
        .modal{
            padding-top: 10%;
        }
        .modal-footer, .modal-content {
            background-color: transparent;
            border:0px;
        }
        .btn{
            border-radius: 30px;
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
            .login-box,
            .register-box {
              width: 80%;
              margin: 7% auto;
            }
            tr.pol td{
                font-size: 15px;
                font-weight: bold;
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
