<script>
    var mywindow;

    function openCenteredWindow(url) {
        var width = 1200;
        var height = 500;
        var left = parseInt((screen.availWidth / 2) - (width / 2));
        var top = parseInt((screen.availHeight / 2) - (height / 2));
        var windowFeatures = "width=" + width + ",height=" + height +
            ",status,resizable,left=" + left + ",top=" + top +
            ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }

    function pencarian() {
        var cari_no = $("[name='cari_no']").val();
        var cari_noreg = $("[name='cari_noreg']").val();
        var cari_nama = $("[name='cari_nama']").val();
        $.ajax({
            type: "POST",
            data: {
                cari_no: cari_no,
                cari_nama: cari_nama,
                cari_noreg: cari_noreg
            },
            url: "<?php echo site_url('suket/getcaripasien'); ?>",
            success: function(result) {
                window.location = "<?php echo site_url('suket/listsuratketerangandokter'); ?>";
            },
            error: function(result) {
                alert(result);
            }
        });
    }

    $(document).ready(function(e) {
        $('#myTable').fixedHeaderTable({
            height: '450',
            altClass: 'odd',
            footer: true
        });
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function() {
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".search").click(function() {
            var kode_kelas = $("[name='kode_kelas']").val();
            var kode_ruangan = $("[name='kode_ruangan']").val();
            var kelas = $("[name='kelas']").val();
            var ruangan = $("[name='ruangan']").val();
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var arrayData = {
                kode_kelas: kode_kelas,
                kelas: kelas,
                kode_ruangan: kode_ruangan,
                ruangan: ruangan,
                tgl1: tgl1,
                tgl2: tgl2
            };
            $.ajax({
                url: "<?php echo site_url('pendaftaran/search_inap'); ?>",
                type: 'POST',
                data: arrayData,
                success: function() {
                    location.reload();
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1'],[name='tgl1_ews'],[name='tgl2_ews'],[name='list_tgl1'],[name='list_tgl2']").datepicker({
            dateFormat: formattgl,
        });
        $("input[name='tanggal_kontrol']").datepicker({
            dateFormat: formattgl,
        })
        $("input[name='tgl2']").datepicker({
            dateFormat: formattgl,
        });
        $(".cetak_barcode").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakbarcode_inap'); ?>/" + id + "/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".cetaklistkelahiran").click(function() {
            var tgl1 = $("[name='list_tgl1']").val();
            var tgl2 = $("[name='list_tgl2']").val();
            var url = "<?php echo site_url('suket/cetaklistsuratketerangandokter') ?>/" + tgl1 + "/" + tgl2;
            openCenteredWindow(url);
            return false;
        });
        $(".listkelahiran").click(function() {
            $(".modallistkelahiran").modal("show");
            return false;
        });

        $(".cari_no").click(function() {
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $(".cari_nama").click(function() {
            $(".modal_cari_nama").modal("show");
            $("[name='cari_nama']").focus();
            return false;
        });
        $(".cari_noreg").click(function() {
            $(".modal_cari_noreg").modal("show");
            $("[name='cari_noreg']").focus();
            return false;
        });
        $("[name='cari_nama']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $("[name='cari_no']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $("[name='cari_noreg']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function() {
            pencarian();
            return false;
        });
        $(".reset").click(function() {
            window.location = "<?php echo site_url('suket/reset_keterangandokter'); ?>/";
            return false;
        });
        $(".cetak").click(function() {
          var no_rm = $(".bg-gray").attr("no_rm");
          var no_reg = $(".bg-gray").attr("no_reg");
          var url = "<?php echo site_url("surat/suratketerangandokter");?>/"+no_reg+"/"+no_rm+"/ralan";
          openCenteredWindow(url);
          return false;
        });
        $('.askep').click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var jenis = "ranap";
            var url = "<?php echo site_url('perawat/cetakasuhan'); ?>/" + no_rm + "/" + no_reg + "/" + jenis;
            openCenteredWindow(url);
        });
        $(".detailskd").click(function() {
            var no_rm = $(".bg-gray").attr("no_rm");
            var no_reg = $(".bg-gray").attr("no_reg");
            var jenis = $(".bg-gray").attr("jenis");
            var poli = $(".bg-gray").attr("kode_ruangan");
            if (poli=="0102029"){
              var url = "<?php echo site_url('pendaftaran/cetakmcu_resume') ?>/" + no_reg;
            } else {
              if (jenis=="ranap"){
                var url = "<?php echo site_url('dokter/cetakresumeinap') ?>/" + no_rm + "/" + no_reg;
              } else
              if (jenis=="ralan"){
                var url = "<?php echo site_url('pendaftaran/cetakresume') ?>/" + no_rm;
              }
            }
            openCenteredWindow(url);
            return false;
        });

    });
    $(document).keyup(function(e) {
        if (e.keyCode == 82 && e.altKey) {
            $(".reset").click();
        }
    })

    function tgl_indo(tgl, tipe = 1) {
        var date = tgl.substring(tgl.length, tgl.length - 2);
        if (tipe == 1)
            var bln = tgl.substring(5, 7);
        else
            var bln = tgl.substring(4, 6);
        var thn = tgl.substring(0, 4);
        return date + "-" + bln + "-" + thn;
    }
</script>
<div class="col-xs-12">
    <?php
    if ($this->session->flashdata('message')) {
        $pesan = explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-" . $pesan[0] . "' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>" . $pesan[1] . "</b>
            </div>";
    }

    ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" name="ruangan" class="form-control" readonly value="<?php echo $this->session->userdata('ruangan'); ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_ruangan" class="form-control" readonly value="<?php echo $this->session->userdata('kode_ruangan'); ?>">
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="ruangan btn btn-primary" type='button'>...</button>
                        </div>
                    </div>
                    <label class="col-md-1 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="text" name="kelas" class="form-control" readonly value="<?php echo $this->session->userdata('kelas'); ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_kelas" class="form-control" readonly value="<?php echo $this->session->userdata('kode_kelas'); ?>">
                    </div>
                    <div class="col-md-1">
                        <div class="pull-right">
                            <button class="kelas btn btn-primary" type='button'>...</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl1" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off" />
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl2" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off" />
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="cari_no btn btn-sm btn-primary" type="button">Cari</button>
                    </div>
                    <div class="col-md-1">
                        <button class="reset btn btn-warning btn-sm" type="button"> <i class="fa  fa-refresh"></i>&nbsp;Reset</button>
                    </div>
                    <div class="col-md-4">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable">
                <thead>
                    <tr class="bg-navy">
                        <th width="10%" class='text-center'>No. Surat</th>
                        <th width="10%" class='text-center'>Tgl Lahir</th>
                        <th class='text-center'>Nomor REG</th>
                        <th class="text-center">Nama</th>
                        <th class='text-center'>Alamat</th>
                        <th class='text-center'>Ruangan</th>
                        <th class='text-center'>Kelas</th>
                        <th class='text-center'>Kamar</th>
                        <th width="7%" class='text-center'>No. Bed</th>
                        <th width="150px" class='text-center'>Golongan Pasien</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    krsort($q3["surat"]);
                    foreach ($q3["surat"] as $key => $row) {
                          $data = $q3["master"][$key];
                          if ($data->nama_pasien!=""){
                            $telpon = preg_replace('/0/', '62', $data->telpon, 1);
                            $ind = '<span class="label label-success">ind</span>';
                            $jenis = ($data->kode_kamar == "" ? "ralan" : "ranap");
                            echo "<tr id=data jenis='" . $row->jenis . "' no_rm='" . $row->no_pasien . "' no_reg='" . $row->no_reg . "' telpon='" . $telpon . "' no_bpjs='" . $data->no_bpjs . "' kode_kamar='" . $data->kode_kamar . "' kode_kelas='" . $data->kode_kelas . "' kode_ruangan='" . $data->kode_ruangan . "' no_bed='" . $data->no_bed . "' no_sep='" . $data->no_sjp . "'>";
                            $bulan = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                            $nomor_surat = $row->nomor_surat . "/ BLP/ " . $bulan[(int)(date("m", strtotime($data->tgl_lahir)))] . "/ " . date("Y", strtotime($data->tgl_lahir));
                            echo "<td class='text-center'>" . $nomor_surat . "</td>";
                            echo "<td class='text-center'>" . date("d-m-Y",strtotime($data->tgl_lahir)) . "</td>";
                            echo "<td class='text-center'>" . $row->no_reg . "</td>";
                            echo "<td>" . $data->nama_pasien . "</td>";
                            echo "<td>" . substr($data->alamat, 0, 45) . "</td>";
                            echo "<td>" . $data->nama_ruangan . "</td>";
                            echo "<td>" . $data->nama_kelas . "</td>";
                            echo "<td>" . $data->kode_kamar . "</td>";
                            echo "<td class='text-center'>" . $data->no_bed . "</td>";
                            echo "<td>" . $data->gol_pasien . "</td>";
                            echo "</tr>";
                          }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="bg-navy">
                        <th colspan="8">Jumlah Pasien : <?php echo $total_rows; ?></th>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-xs-12">
                    <div class="pull-right">
                        <button class="listkelahiran btn btn-sm btn-primary" type="button"><i class="fa  fa-file"></i> Rekap</button>
                        <button class="cetak btn btn-sm btn-warning" type="button"> Cetak</button>
                        <button class="detailskd btn btn-sm btn-success" type="button"> <i class="fa  fa-search-plus"></i> Detail</button>
                    </div>
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
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ No. RM/ No. Reg/ No. BPJS/ No. SEP" />
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
                                <input class="form-control" type="text" name="cari_nama" />
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
                                <input class="form-control" type="text" name="cari_noreg" />
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
<div class='modal modallistkelahiran no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Cetak Surat Keterangan Dokter</h4>
            </div>
            <div class='modal-body'>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tanggal</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="list_tgl1" autocomplete="off" />
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="list_tgl2" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <div class="pull-right">
                    <button class="cetaklistkelahiran btn btn-success">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .dropbtn {

        color: white;
        padding: 14px, 5px, 14px, 5px;
        font-size: 14px;
        border: none;
    }

    .dropup {
        position: relative;
        display: inline-block;
    }

    .dropup-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 260px;
        bottom: 31px;
        z-index: 999999;
    }

    .dropup-content a {
        color: black;
        padding: 6px 16px;
        text-decoration: none;
        display: block;
    }

    .dropup-content a:hover {
        background-color: #ccc
    }

    .sidenav a:hover {
        background-color: #ccc
    }

    .sidenav:hover {
        background-color: #ccc
    }

    .dropup:hover .dropup-content,
    .sidenav:hover .dropup-content-sidenav {
        display: block;
    }

    .dropup-content-sidenav {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 260px;
        left: 260px;
        margin-top: -32px;
        z-index: 999999;
    }

    /*.dropup:hover .dropbtn {
      background-color: #2980B9;
    }*/
</style>
