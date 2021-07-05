<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title id="juduls">PENDAFTARAN VAKSINASI</title>
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
    <script src="<?php echo base_url();?>js/jquery.signature.js"></script>
    <script src="<?php echo base_url();?>js/jquery.ui.touch-punch.min.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $("[name='propinsi'],[name='kotakabupaten'],[name='kecamatan'],[name='desa']").select2();
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        startTime();
        gettanggal();
        localStorage.removeItem('status');
        $(".daftar").click(function(){
            $(".home").addClass("hide");
            $(".formpendaftaran").removeClass("hide");
            getpropinsi();
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
        $("[name='propinsi']").change(function(){
          var propinsi = $(this).val();
          getkota(propinsi);
        })
        $("[name='kotakabupaten']").change(function(){
          var kota = $(this).val();
          getkecamatan(kota);
        })
        $("[name='kecamatan']").change(function(){
          var kecamatan = $(this).val();
          getdesa(kecamatan);
        })
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
            $("#signature").signature({syncField: '#signatureJSON'});
            $('#signature').signature('option', 'syncFormat', "PNG");
            $('#signature').draggable();
        });
        $('.listgolpasien').on('click',".lanjut_golpasien",function(){
            // $(".pilih_kelas").modal("show");
            $(".poli").addClass("hide");
            $(".dokter").addClass("hide");
            $(".home").addClass("hide");
            var golpasien = $(this).attr("kode");
            var status_bayar = $(this).attr("status_bayar");
            localStorage.setItem('golpasien',golpasien);
            localStorage.setItem('status_bayar',status_bayar);
            simpan("R");
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
            // var no_rm = "0000000000"+$(this).val();
            var no_rm = $(this).val();
            var kode = localStorage.getItem("kode");
            if (e.which==13){
                $.ajax({
                    url: "<?php echo site_url('antrian/getpasien')?>",
                    type: 'POST',
                    data: {no_pasien:no_rm,poli:kode},
                    success: function(result){
                        var value = JSON.parse(result);
                        if (value!=null){
                            if (value=="ada"){
                                alert("Anda telah mendaftar di poli yang sama");
                                $(".simpan_daftar").attr("disabled","disabled");
                            } else {
                                no_rm = value.no_pasien;
                                $("[name='no_rm']").val(no_rm);
                                var nama_pasien = value.nama_pasien;
                                $(".nama_pasien").removeClass("hide");
                                $("[name='nama_pasien']").val(nama_pasien);
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
            // $(".pilih_kelas").modal("show");
            simpan("R");
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
                        table += "<tr>";
                        table += "<td class='text-right'>&nbsp;</td>";
                        table += "<td class='text-left'><button class='btnnoregsebelumnya btn btn-info' no_reg=''>Tanpa No Reg Sebelumnya</button></td>";
                        table += "</tr>";
                        $(".list_regsebelumnya").html(table);
                    },
                    error: function(result){
                        console.log(result);
                    }
                });
            } else {
                // $(".pilih_kelas").modal("show");
                simpan("R");
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
                var day = new Date();
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
        var no_pasien = $("[name='no_rm']").val();
        var noregsebelumnya = $("[name='noregsebelumnya']").val();
        var ttd = $("[name='ttd']").val();
        ttd = ttd.replace("data:image/png;base64,","");
        $.ajax({
            url: "<?php echo site_url('antrian/simpan_pasien')?>",
            type: 'POST',
            data: {no_pasien: no_pasien,poli: kode, dokter: dokter, jenis: jenis, status_pasien: status_pasien, golpasien: golpasien, status_bayar: status_bayar, noregsebelumnya: noregsebelumnya, ttd: ttd},
            success: function(result){
                var value = JSON.parse(result);
                var content = "";
                $(".barcode").barcode(value.no_reg,"code39",{showHRI: false,barHeight:25});
                content += '<tr><td colspan="2">'+value.nama_dokter+' <span style="float:right;font-size:15px">(Nurse : '+value.no_nurse+')</span></td></tr>';
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
                newWin= window.open("");
                newWin.document.write(divToPrint.outerHTML);
                newWin.print();
                newWin.close();
                // $('.invoice').addClass("hide");
                // $('.invoice').printThis({canvas:true});
                var opt = {
                    margin: 5,
                    filename: 'myfile.pdf'
                };
                var string = $(".invoice").html();
                // var page = document.getElementById('invoice');
                // html2pdf().from(string).set(opt).outputPdf();
                // html2pdf().from(divToPrint.outerHTML).set(opt).save();
                $(".pilih_kelas").modal("hide");
                $(".home").removeClass("hide");
                $('.invoice').addClass("hide");
                $('.daftar').addClass("hide");
                $('.golpasien').addClass("hide");
                $(".nama_pasien").addClass("hide");
                $("[name='nama_pasien']").val();
                $(".simpan_daftar").attr("disabled","disabled");
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
    function getpropinsi(){
      $.ajax({
          url: "<?php echo site_url('vaksinasi/getpropinsi')?>",
          type: 'POST',
          success: function(result){
            console.log(result);
            var row = JSON.parse(result);
            $("[name='propinsi']").html('').select2({data:row,placeholder:"Pilih Propinsi"});
          }
      });
    }
    function getkota(id){
      $.ajax({
          url: "<?php echo site_url('vaksinasi/getkota')?>",
          data: {propinsi:id},
          type: 'POST',
          success: function(result){
            console.log(result);
            var row = JSON.parse(result);
            $("[name='kotakabupaten']").html('').select2({data:row,placeholder:"Pilih Kota/ Kabupaten"});
          }
      });
    }
    function getkecamatan(id){
      $.ajax({
          url: "<?php echo site_url('vaksinasi/getkecamatan')?>",
          data: {kota:id},
          type: 'POST',
          success: function(result){
            console.log(result);
            var row = JSON.parse(result);
            $("[name='kecamatan']").html('').select2({data:row,placeholder:"Pilih Kecamatan"});
          }
      });
    }
    function getdesa(id){
      $.ajax({
          url: "<?php echo site_url('vaksinasi/getdesa')?>",
          data: {kecamatan:id},
          type: 'POST',
          success: function(result){
            console.log(result);
            var row = JSON.parse(result);
            $("[name='desa']").html('').select2({data:row,placeholder:"Pilih Desa"});
          }
      });
    }
</script>
<body class="skin-blue layout-top-nav fixed">
    <input type="hidden" name="id">
    <div class="wrapper">
        <div class="main-header">
            <div class="atas">
                <div class="col-lg-9 col-xs-8 col-sm-8">
                    <div class="judul pull-right">
                        PENDAFTARAN VAKSINASI COVID-19
                        <span class="tanggal"></span>
                        <span class="clock"></span>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-4 col-sm-4">
                    <div class="logo_atas"><img src="<?php echo base_url();?>img/hesti.png"><br><small style="font-size:8px">Denkesyah 03.04.03 Cirebon</small></div>
                </div>
            </div>
        </div>
        <div class="content-wrapper" style="background-color:white">
            <section class="content" style="background-color:white">
                <div class="bawah row">
                  <div class="home">
                    <div class="row">
                      <div class="alert" style="border-radius: 90px">
                        <a class="menu daftar" href="#">
                          <p class="text-center">
                            <img src="<?php echo base_url();?>img/vaccination.png" style="width:120px">
                          </p>
                          <div class="menutitle">Daftar Vaksinasi 1</div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="formpendaftaran hide">
                    <div class="col-xs-12">
                        <div class="box box-solid">
                          <div class="box-header with-border"><h3 class="box-title">Form Pendaftaran</h3></div>
                          <div class="box-body">
                              <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" autocomplete="off" required name="nama_pasien">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">No. HP</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" autocomplete="off" required name="nohp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">NIK</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" autocomplete="off" required name="nik">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Lahir</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" required name="tgl_lahir" autocomplete="off" placeholder="00-00-0000">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Propinsi</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" required name="propinsi"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kota/ Kabupaten</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" required name="kotakabupaten" style="width:100%"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kecamatan</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" required name="kecamatan" style="width:100%"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Desa</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" required name="desa" style="width:100%"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" autocomplete="off" required name="alamat">
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="box-footer">
                            <button class="btn btn-success btn-block btn-flat">DAFTAR</button>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </section>
        </div>
        <footer class="main-footer" id="footers">
            <div class="pull-right hidden-xs"></div>
            <strong>Copyright &copy; 2021 <a href="#">Denkesyah 03.04.03 Cirebon</a></strong>
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
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:12px">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </section>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/app.js"></script>
    <script src="<?php echo base_url();?>js/demo.js"></script>
    <style type="text/css">
        .navbar-nav > .notifications-menu > .dropdown-menu > li .menu, .navbar-nav > .messages-menu > .dropdown-menu > li .menu, .navbar-nav > .tasks-menu > .dropdown-menu > li .menu {
            max-height: 420px;
        }
        .invoice{
            width:4cm;
        }
        .home {
            width: 560px;
            margin: 7% auto;
        }
        .invoice td{
            font-size: 10px;
        }
        a.menu{
            font-size:100px;
        }
        .content-wrapper{
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .menutitle{
            text-align: center;
            font-size: 20px;
            min-height: 40px;
            padding-top:20px;
            font-weight: bold;
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
            text-align: right;
            margin: 50px 0px;
            font-size: 40px;
            font-weight: bold;
            display: block;
        }
        .tanggal{
            text-align: right;
            font-size: 15px;
            font-weight: bold;
            display: block;
        }
        .clock{
            text-align: right;
            font-size: 15px;
            font-weight: bold;
            display: block;
        }
        .atas{
            background: url("img/bg-vaksinasi.jpg") no-repeat 30% center fixed;
            padding: 40px 0px;
            height:200px;
        }
        .bg::before {
            content: "";
            background: url("img/background_bawah.jpg") no-repeat center right fixed;
            position: absolute;
            opacity: 0.3;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }
        .bawah{
            padding: 120px 0px 40px;
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
        @media (min-width: 395px) and (max-width: 500px)  {
          .alert{
              margin: 0px 80px 0px 0px;
          }
        }
        @media (max-width: 799px) {
            .judul{
                text-align: right;
                margin: 0px;
                font-size: 17px;
                font-weight: bold;
                display: block;
            }
            .atas{
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
            .tanggal, .clock{
                font-size:10px;
            }
            .alert{
                margin: 0px auto;
            }
            .alert a{
          		color: #313233;
          		text-decoration: none;
          		margin: 0px auto;
          		text-align: center;
          	}
        }
        @media (min-width: 800px) and (max-width: 1300px) {
            .judul{
                text-align: center;
                margin: 20px 0px;
                font-size: 30px;
                font-weight: bold;
                display: block;
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
        #signature{
            height: 300px;
            border: 1px solid black;
        }
    </style>
</body>
