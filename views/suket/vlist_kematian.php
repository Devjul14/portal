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
                window.location = "<?php echo site_url('suket/listkematian'); ?>";
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
        $("input[name='tgl1'],[name='tgl1_ews'],[name='tgl2_ews'],[name='list_tgl1'],[name='list_tgl2'],[name='listbpjs_tgl1'],[name='listbpjs_tgl2']").datepicker({
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
        $(".cetaklistkematian").click(function() {
            var tgl1 = $("[name='list_tgl1']").val();
            var tgl2 = $("[name='list_tgl2']").val();
            var url = "<?php echo site_url('suket/cetaklistkematian') ?>/" + tgl1 + "/" + tgl2;
            openCenteredWindow(url);
            return false;
        });
        $(".cetaklistkematianbpjs").click(function() {
            var tgl1 = $("[name='listbpjs_tgl1']").val();
            var tgl2 = $("[name='listbpjs_tgl2']").val();
            var nomor = $("[name='no_b_keluar']").val();
            $.ajax({
                url: "<?php echo site_url('suket/tempno'); ?>",
                type: 'POST',
                data: {
                    nomor: nomor
                },
                success: function() {
                    var url = "<?php echo site_url('suket/cetaklistkematianbpjs') ?>/" + tgl1 + "/" + tgl2;
                    openCenteredWindow(url);
                }
            });
            return false;
        });
        $(".detailkematian").click(function() {
            var no_rm = $(".bg-gray").attr("no_rm");
            var no_reg = $(".bg-gray").attr("no_reg");
            var jenis = $(".bg-gray").attr("jenis");
            var url = "<?php echo site_url('suket/detailkematian') ?>/" + no_rm + "/" + no_reg + "/" + jenis;
            window.location = url;
            return false;
        });
        $(".pindahstatus").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/pindahstatus') ?>/" + id + "/" + no_reg;
            return false;
        });
        $(".view_pembayaran").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/viewpembayaran_inap') ?>/" + id + "/" + no_reg;
            return false;
        });
        $(".edit").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/editinap') ?>/" + id + "/" + no_reg;
            return false;
        });
        $(".laporan_tindakan").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/laporan_tindakaninap'); ?>/" + id + "/" + no_reg;
            return false;
        });
        $(".laporan_mata").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetak_mata') ?>/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_pterygium").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetak_pterygium') ?>/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_operasi").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetak_operasi') ?>/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".cetak").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_rm = $(".bg-gray").attr("no_rm");
            var url = "<?php echo site_url('surat/cetakkematian') ?>/" + no_reg + "/" + no_rm + "/asli";
            openCenteredWindow(url);
            return false;
        });
        $(".datapasien").click(function() {
            window.location = "<?php echo site_url('pendaftaran') ?>";
            return false;
        });
        // $(".hapus").click(function(){
        //     var id = $(".bg-gray").attr("no_reg");
        //     window.location = "<?php echo site_url('pendaftaran/hapuspasien_inap') ?>/"+id;
        //     return false;
        // });
        $(".rjalan").click(function() {
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('pendaftaran/viewrjalan'); ?>/" + id;
            // openCenteredWindow(url);
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
        $(".listkematian").click(function() {
            $(".modallistkematian").modal("show");
            return false;
        });
        $(".rekapbpjs").click(function() {
            $(".modallistkematianbpjs").modal("show");
            return false;
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function() {
            pencarian();
            return false;
        });
        $(".reset").click(function() {
            window.location = "<?php echo site_url('suket/reset_pasienkematian'); ?>/";
            // location.reload();
            return false;
        });
        $('.askep').click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var jenis = "ranap";
            var url = "<?php echo site_url('perawat/cetakasuhan'); ?>/" + no_rm + "/" + no_reg + "/" + jenis;
            openCenteredWindow(url);
        });
        $('.asbid').click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('perawat/cetakkebidanan'); ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
        });
        $(".tmb_persetujuan").click(function() {
            // var no_pasien = $("[name='no_pasien_p']").val();
            // var no_reg = $("[name='no_reg_p']").val();
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var password_petugas = $("[name='password_petugas']").val();
            var ada = "";
            $.ajax({
                type: "POST",
                data: {
                    password_petugas: password_petugas
                },
                async: false,
                url: "<?php echo site_url('persetujuan/cekpetugas_rm/persetujuan'); ?>/" + no_reg + "/" + no_pasien,
                success: function(result) {
                    ada = result;
                },
                error: function(result) {
                    console.log(result);
                }
            });
            if (ada == "true") {
                var site = "<?php echo site_url('persetujuan/cetakpersetujuan'); ?>/" + no_reg + "/" + no_pasien;
                openCenteredWindow(site);
                $("[name='password_petugas").val("");
                $(".modal_persetujuan").modal("hide");
            } else {
                alert("Password yang Anda masukan salah");
            }
            return false;
        });
        $(".hapus").click(function() {
            $(".rejected").show();
        });
        $(".tidak_rejected").click(function() {
            $(".rejected").hide();
        });
        $(".ya_rejected").click(function() {
            var id = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/hapuspasien_inap') ?>/" + id;
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
                        <button class="reset btn btn-warning btn-sm" type="button"><i class="fa  fa-refresh"></i> Reset</button>
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
                        <th class='text-center'>Nomor REG</th>
                        <th class="text-center">Nama</th>
                        <th class='text-center'>Alamat</th>
                        <th class='text-center'>Ruangan</th>
                        <th class='text-center'>Kelas</th>
                        <th class='text-center'>Kamar</th>
                        <th width="7%" class='text-center'>No. Bed</th>
                        <th class='text-center'>Golongan Pasien</th>
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
                            $nomor_surat = $row->nomor_surat . "/ SKM/ " . $bulan[(int)(date("m", strtotime($data->tgl_keluar)))] . "/ " . date("Y", strtotime($data->tgl_keluar));
                            echo "<td class='text-center'>" . $nomor_surat . "</td>";
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
                        <th colspan="7">Jumlah Pasien : <?php echo $total_rows; ?></th>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-xs-12">
                    <div class="pull-right">
                        <button class="rekapbpjs btn btn-sm bg-blue" type="button"><i class="fa fa-file"></i> Rekap BPJS</button>
                        <button class="listkematian btn btn-sm btn-primary" type="button"><i class="fa fa-file"></i> Rekap</button>
                        <button class="detailkematian btn btn-sm btn-success" type="button"><i class="fa  fa-search-plus"></i> Detail</button>
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
<div class='modal modal_ews no-print' role="dialog" style="z-index:999999">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;<span class="judul_ews">EWS</span></h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal Periksa</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <input class="form-control" type="hidden" name="jenis_ews" />
                                <div class="col-xs-6"><input class="form-control" type="text" name="tgl1_ews" value="<?php echo date("d-m-Y"); ?>" /></div>
                                <div class="col-xs-6"><input class="form-control" type="text" name="tgl2_ews" value="<?php echo date("d-m-Y"); ?>" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="cetak_ews btn btn-success">Cetak</button>
            </div>
        </div>
    </div>
</div>
<div class='modal modallistkematian no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Cetak Surat Kematian</h4>
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
                    <button class="cetaklistkematian btn btn-success">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modallistkematianbpjs no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Cetak Surat Kematian (BPJS)</h4>
            </div>
            <div class='modal-body'>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tanggal</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="listbpjs_tgl1" autocomplete="off" />
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="listbpjs_tgl2" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">No. B Keluar</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="no_b_keluar" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <div class="pull-right">
                    <button class="cetaklistkematianbpjs btn btn-success">Cetak</button>
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
