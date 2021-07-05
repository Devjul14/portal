<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    function pencarian(){
        var cari_no = $("[name='cari_no']").val();
        var cari_noreg = $("[name='cari_noreg']").val();
        var cari_nama = $("[name='cari_nama']").val();
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no,cari_nama:cari_nama,cari_noreg:cari_noreg},
            url   : "<?php echo site_url('apotek/getcaripasien_ralan');?>",
            success : function(result){
                window.location = "<?php echo site_url('apotek/list_ralan');?>";
            },
            error: function(result){
                alert(result);
            }
        });
    }
    $(document).ready(function(e){
        $(".search").click(function(){
            var poli_kode = $("[name='poli_kode']").val();
            var poliklinik = $("[name='poliklinik']").val();
            var kode_dokter = $("[name='kode_dokter']").val();
            var dokter = $("[name='dokter']").val();
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var arrayData = {poli_kode: poli_kode, poliklinik: poliklinik,kode_dokter: kode_dokter,dokter: dokter,tgl1: tgl1,tgl2: tgl2};
            $.ajax({
                url: "<?php echo site_url('apotek/search_ralan');?>",
                type: 'POST',
                data: arrayData,
                success: function(){
                    location.reload();
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".reset").click(function(){
            var url = "<?php echo site_url('apotek/reset_ralan');?>";
            window.location = url;
            return false;
        });
        $(".pdf").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('apotek/formuploadpdf');?>/ralan/"+id;
            window.location = url;
            return false;
        });
        $(".cetak_barcode").click(function(){
            getpasien();
            return false;
        });
        $(".view").click(function(){
            var id = $(".bg-gray").attr("href");
            var igd = "<?php echo $igd;?>";
            if (igd=="1"){
                var url = "<?php echo site_url('apotek/viewapotek_igd');?>/"+id;
            } else {
                var url = "<?php echo site_url('apotek/viewapotek_ralan');?>/"+id;
            }
            window.location = url;
            return false;
        });
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".cari_no").click(function(){
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $(".cari_nama").click(function(){
            $(".modal_cari_nama").modal("show");
            $("[name='cari_nama']").focus();
            return false;
        });
        $(".cari_noreg").click(function(){
            $(".modal_cari_noreg").modal("show");
            $("[name='cari_noreg']").focus();
            return false;
        });
        $("[name='cari_nama'], [name='cari_no'], [name='cari_noreg']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function(){
            pencarian();
            return false;
        });
        $(".poli").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihpoli');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".dokter").click(function(){
            var kode_poli = $("input[name='poli_kode']").val()
            var url = "<?php echo site_url('pendaftaran/pilihdokterpoli');?>/"+kode_poli;
            openCenteredWindow(url);
            return false;
        });
        $(".terima").click(function(){
            var id = $(".bg-gray").attr("href");
            $.ajax({
                type: "POST",
                data: {id: id},
                url: "<?php echo site_url('apotek/getlistobat'); ?>",
                success: function(result) {
                  $(".modal_listobat").modal("show");
                  var row = JSON.parse(result);
                  $(".no_rm").html(row["master"].no_pasien);
                  $(".nama_pasien").html(row["master"].nama_pasien);
                  $(".alamat").html(row["master"].alamat);
                  $(".telpon").html(row["master"].telpon);
                  $(".bb").html(row["master"].berat_badan);
                  $(".umur").html(row["umur"]);
                  $(".ruangan").html(row["detail"].ruangan);
                  $(".no_reg").html(row["detail"].no_reg);
                  $(".no_resep").html(row["detail"].no_reg);
                  $(".no_sip").html(row["detail"].no_sip);
                  $(".nama_dokter").html(row["detail"].nama_dokter);
                  $(".listresep").html(row["listresep"]);
                  $(".diagnosa").html(row["diagnosa"].a);
                },
                error: function(result) {
                    alert(result);
                }
            });
            // return false;
        });
        $(".terima1").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('apotek/terima_ralan')?>/"+id;
            return false;
        });
        $(".obat").click(function(){
            var id = $(".bg-gray").attr("href");
            var phone       = $(".bg-gray").attr("telpon");
            var jenis = "ralan";
            if (phone==""){
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                text += "Untuk *Tanda tangan* bukti pengambilan obat klik link dibawah ini%0A";
                text += "http://rsciremai.ddns.net/rsciremai/surat/ttdobat/"+no_pasien+"/"+jenis;
                var url = "https://api.whatsapp.com/send?phone="+phone+"&text="+text;
                openCenteredWindow(url);
                window.location = "<?php echo site_url('apotek/obat_ralan')?>/"+id;
                return false;
            }
        });
        $(".respond").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('apotek/respond_ralan')?>/"+id;
            openCenteredWindow(url);
        });
    });
</script>
<div class="col-xs-12">
    <?php
        if($this->session->flashdata('message')){
            $pesan=explode('-', $this->session->flashdata('message'));
            echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>".$pesan[1]."</b>
            </div>";
        }

    ?>
    <div class="box box-primary">
        <div class="box-header">
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="15%" class='text-center'>Nomor RM</th>
                        <th width="15%" class='text-center'>Nomor REG</th>
                        <th>Nama</th>
                        <th class='text-center'>Poli Asal</th>
                        <th class='text-center'>Poli Tujuan</th>
                        <th class='text-center'>Status Pasien</th>
                        <th class='text-center'>Jenis Pasien</th>
                        <th class='text-center'>Golongan Pasien</th>
                        <th class='text-center'>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                    $no_kk = '';
                    $bayar = '';
                    foreach ($q3->result() as $row){
                        switch ($row->status_bayar) {
                            case '':
                                $bayar = "<label class='label label-warning'>--</label>";
                                break;
                            case 'TAGIH':
                                $bayar = "<label class='label label-danger'>TAGIH</label>";
                                break;
                            case 'LUNAS':
                                $bayar = "<label class='label label-success'>LUNAS</label>";
                                break;
                            case 'SHARING':
                                $bayar = "<label class='label label-info'>SHARING</label>";
                                break;
                        }
                        $telpon = preg_replace('/0/', '62', $row->telpon, 1);
                        $icon_terima = ($row->tanggal_terimaapotek==="0000-00-00 00:00:00" ? "<i class='fa fa-edit text-blue'></i>" : "");
                        $icon_obat = ($row->tanggal_obatapotek==="0000-00-00 00:00:00" ? "<i class='fa fa-edit text-green'></i>" : "");
                        $icon_printobat = ($row->tanggal_printobat==="0000-00-00 00:00:00" ? "<i class='fa fa-print text-green'></i>" : "");
                        echo "<tr id=data href='".$row->no_pasien."/".$row->no_reg."' telpon='".$telpon."'>" ;
                        echo "<td class='text-center'>".$icon_obat." ".$icon_printobat." ".$icon_terima." ".$row->no_pasien."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        echo "<td>".$row->poli_asal."</td>";
                        echo "<td>".$row->poli_tujuan."</td>";
                        echo "<td>".$row->status_pasien."</td>";
                        echo "<td>".$row->jenis."</td>";
                        echo "<td>".$row->gol_pasien."</td>";
                        echo "<td>".$bayar."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1">
                        Poliklinik
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="poliklinik" class="form-control" readonly value="<?php echo $this->session->userdata("poliklinik") ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="poli_kode" class="form-control" readonly value="<?php echo $this->session->userdata("poli_kode") ?>">
                    </div>
                    <div class="col-md-1">
                        <button class="poli btn btn-primary">...</button>
                    </div>
                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">
                        Tanggal
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="tgl1" class="form-control" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="tgl2" class="form-control" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off">
                    </div>
                    <div class="col-md-1">
                        <button class="search btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                    <label class="col-md-1">
                        Dokter
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="dokter" class="form-control" readonly value="<?php echo $this->session->userdata("dokter") ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_dokter" class="form-control" readonly value="<?php echo $this->session->userdata("kode_dokter") ?>">
                    </div>
                    <div class="col-md-1">
                        <button class="dokter btn btn-primary">...</button>
                    </div>
                </div>
            </div>
            <div class="pull-left">
                <div class="btn-group">
                    <button class="reset btn btn-warning"> Reset</button>
                    <!-- <button class="batal btn btn-danger"> Batal</button> -->
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <button class="cari_no btn btn-info" type="button"> Cari</button>
                    <!-- <button class="cari_noreg btn btn-info" type="button"> Cari No REG</button> -->
                    <button class="pdf btn bg-maroon" type="button"> PDF</button>
                    <button class="respond btn btn-success" type="button"><i class="fa fa-edit"></i> Respond Time</button>
                    <button class="obat btn btn-primary" type="button"><i class="fa fa-edit"></i> Obat</button>
                    <button class="view btn btn-warning" type="button"><i class="fa fa-edit"></i> View Apotek</button>
                    <button class="terima btn btn-info" type="button"><i class="fa fa-edit"></i> Terima</button>
                    <!-- <button class="cetak_barcode btn btn-danger" type="button"><i class="fa fa-print"></i> Cetak Barcode</button> -->

                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_no no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No. RM</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ No. RM/ No. Reg/ No. BPJS/ No. SEP"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_no btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_nama no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_nama"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_nama btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_noreg no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No Reg</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_noreg"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_noreg btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_listobat' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;List Resep</h4>
            </div>
            <div class='modal-body'>
                <div class="page">
                  <p>
                  <h5>
                      <b>DETASEMEN KESEHATAN WILAYAH 03.04.03</b>
                      <br>
                      <u><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</b></u>
                  </h5>
                  </p>
                  <table class="table no-border laporan" align="center">
                      <tr>
                        <td colspan="2">&nbsp;</td>
                        <td style="vertical-align:middle">No. Resep<span class='pull-right'>:</span></td>
                        <td><span class="no_resep"></span></td>
                      </tr>
                      <tr>
                        <td>Ruang/ Poli<span class='pull-right'>:</span></td>
                        <td><span class="ruangan"></span></td>
                        <td colspan="2">Cirebon, <?php echo date("d-m-Y");?></td>
                      </tr>
                      <tr>
                        <td width='130px'>Dokter<span class='pull-right'>:</span></td>
                        <td width='200px'><span class="nama_dokter"></span></td>
                        <td width='100px'>No. SIP<span class='pull-right'>:</span></td>
                        <td><span class="no_sip"></span></td>
                      </tr>
                      <!-- <tr>
                        <td>Alergi<span class='pull-right'>:</span></td>
                        <td><span class="alergi"></span></td>
                        <td colspan="2"></td>
                      </tr> -->
                      <tr>
                        <td colspan="4"><span class="listresep"></span></td>
                      </tr>
                      <tr>
                        <td>Nama Pasien<span class='pull-right'>:</span></td>
                        <td colspan="3"><span class="nama_pasien"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Umur : <span class="umur"></span>&nbsp;&nbsp;&nbsp;&nbsp;BB : <span class="bb"></span></td>
                      </tr>
                      <tr>
                        <td>Diagnosa<span class='pull-right'>:</span></td>
                        <td><span class="diagnosa"></span></td>
                        <td colspan="2">No. RM : <span class="no_rm"></span></td>
                      </tr>
                      <tr>
                        <td>Register<span class='pull-right'>:</span></td>
                        <td colspan="3"><span class="no_reg"></span></td>
                      </tr>
                      <tr>
                        <td>Alamat<span class='pull-right'>:</span></td>
                        <td colspan="3"><span class="alamat"></span></td>
                      </tr>
                      <tr>
                        <td>No. Telp/ HP<span class='pull-right'>:</span></td>
                        <td colspan="3"><span class="telpon"></span></td>
                      </tr>
                  </table>
                </div>
            </div>
            <div class='modal-footer'>
              <div class="pull-right">
                  <button class="terima1 btn btn-success">Terima</button>
              </div>
            </div>
        </div>
    </div>
</div>
<section class="invoice no-border hide" id="invoice">
    <table cellspacing="0" cellpadding="0" width="100%">
    <tr><td>
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:5px;font-family: 'Arial Narrow'">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </td>
    <td>
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:5px;font-family: 'Arial Narrow'">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </td>
    <td>
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:5px;font-family: 'Arial Narrow'">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </td></tr>
    </table>
</section>
<style>
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .laporan>thead>tr>th,
    .laporan>tbody>tr>th,
    .laporan>tfoot>tr>th,
    .laporan>thead>tr>td,
    .laporan>tbody>tr>td,
    .laporan>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

    .laporan>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }

    .laporan>caption+thead>tr:first-child>th,
    .laporan>colgroup+thead>tr:first-child>th,
    .laporan>thead:first-child>tr:first-child>th,
    .laporan>caption+thead>tr:first-child>td,
    .laporan>colgroup+thead>tr:first-child>td,
    .laporan>thead:first-child>tr:first-child>td {
        border-top: 0;
    }

    .laporan>tbody+tbody {
        border-top: 2px solid #ddd;
    }

    .laporan td,
    .laporan th {
        background-color: #fff !important;
    }



    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .laporan2>thead>tr>th,
    .laporan2>tbody>tr>th,
    .laporan2>tfoot>tr>th,
    .laporan2>thead>tr>td,
    .laporan2>tbody>tr>td,
    .laporan2>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
    }

    .laporan2>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 0px solid #ddd;
    }

    .laporan2>caption+thead>tr:first-child>th,
    .laporan2>colgroup+thead>tr:first-child>th,
    .laporan2>thead:first-child>tr:first-child>th,
    .laporan2>caption+thead>tr:first-child>td,
    .laporan2>colgroup+thead>tr:first-child>td,
    .laporan2>thead:first-child>tr:first-child>td {
        border-top: 0;
    }

    .laporan2>tbody+tbody {
        border-top: 0px solid #ddd;
    }

    .laporan2 td,
    .laporan2 th {
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }

    .page {
        width: 148mm;
        min-height: 140mm;
        padding: 0.5cm;
        margin: 0.5cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 256mm;
        outline: 2cm #FFEAEA solid;
    }

    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
