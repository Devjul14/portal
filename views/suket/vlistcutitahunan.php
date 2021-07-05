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
        $(".add").click(function() {
            window.location = "<?php echo site_url('suket/addcutitahunan/y/y/y') ?>";
            return false;
        });
        $(".edit").click(function() {
            var id = $(".bg-gray").attr("nomor");
            window.location = "<?php echo site_url('suket/addcutitahunan') ?>/" + id;
            return false;
        });

        $(".cetakrekapcuti").click(function() {
            var tgl1 = $("[name='list_tgl1']").val();
            var tgl2 = $("[name='list_tgl2']").val();
            var url = "<?php echo site_url('suket/cetakrekapcuti') ?>/" + tgl1 + "/" + tgl2;
            openCenteredWindow(url);
            return false;
        });
        $(".rekap").click(function() {
            $(".modalrekap").modal("show");
            return false;
        });
        $(".cari_no").click(function() {
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $(".cari_tanggal").click(function() {
            $(".modal_cari_tanggal").modal("show");
            $("[name='cari_tanggal']").focus();
            return false;
        });
        $("[name='cari_tanggal']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $("[name='cari_no']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $(".tmb_cari_tanggal, .tmb_cari_no").click(function() {
            pencarian();
            return false;
        });
        $(".reset").click(function() {
            var url = "<?php echo site_url('suket/resetcuti'); ?>";
            window.location = url;
        });
        $(".pengajuan").click(function() {
            var id = $(".bg-gray").attr("nomor");
            var url = "<?php echo site_url('suket/pengajuancuti'); ?>/" + id;
            openCenteredWindow(url);
            return false;
        });
        $(".cetakhonor").click(function() {
            var id = $(".bg-gray").attr("nomor");
            var url = "<?php echo site_url('suket/cutihonor'); ?>/" + id;
            openCenteredWindow(url);
            return false;
        });
        $(".cetaknonhonor").click(function() {
            var id = $(".bg-gray").attr("nomor");
            var url = "<?php echo site_url('suket/cutinon_honor'); ?>/" + id;
            openCenteredWindow(url);
            return false;
        });
    });

    function pencarian() {
        var cari_no = $("[name='cari_no']").val();
        var cari_tanggal = $("[name='cari_tanggal']").val();
        $.ajax({
            type: "POST",
            data: {
                cari_no: cari_no,
                cari_tanggal: cari_tanggal
            },
            url: "<?php echo site_url('suket/getcarinocuti'); ?>",
            success: function(result) {
                window.location = "<?php echo site_url('suket/listcutitahunan'); ?>";
            },
            error: function(result) {
                alert(result);
            }
        });
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
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable">
                <thead>
                    <tr class="bg-navy">
                        <th width="15%" class='text-center'>Nomor</th>
                        <th class='text-center'>Nama</th>
                        <th class='text-center'>NRP / NIP / NRK</th>
                        <th class='text-center'>Pangkat</th>
                        <th class='text-center'>Jabatan</th>
                        <th class='text-center'>Keperluan</th>
                        <th class='text-center'>Tujuan</th>
                        <th class='text-center'>TGL Berangkat</th>
                        <th class='text-center'>TGL Kembali</th>
                        <th class='text-center'>Ket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = '';
                    foreach ($q3->result() as $row) {
                        echo "<tr id=data nomor='" . $row->nomor . "' tanggal='" . date("d/m/Y", strtotime($row->tanggal)) . "' tgl_berangkat='" . date("d/m/Y", strtotime($row->tgl_berangkat)) . "' tgl_kembali='" . date("d/m/Y", strtotime($row->tgl_kembali)) . "' nama='" . $row->nama . "' pangkat='" . $row->pangkat . "' nrp='" . $row->nrp . "' jabatan='" . $row->jabatan . "' tujuan='" . $row->tujuan . "' keperluan='" . $row->keperluan . "' ket='" . $row->ket . "'>";
                        //echo "<td class='text-center'>" . date("d-m-Y", strtotime($row->tanggal)) . "</td>";
                        echo "<td class='text-center'>" . $row->nomor . "</td>";
                        echo "<td class='text-center'>" . $row->nama . "</td>";
                        echo "<td class='text-center'>" . $row->nrp . "</td>";
                        echo "<td class='text-center'>" . $row->pangkat . "</td>";
                        echo "<td class='text-center'>" . $row->jabatan . "</td>";
                        echo "<td class='text-center'>" . $row->keperluan . "</td>";
                        echo "<td class='text-center'>" . $row->tujuan . "</td>";
                        echo "<td class='text-center'>" . date("d-m-Y", strtotime($row->tgl_berangkat)) . "</td>";
                        echo "<td class='text-center'>" . date("d-m-Y", strtotime($row->tgl_kembali)) . "</td>";
                        echo "<td class='text-center'>" . $row->ket . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="bg-navy">
                        <th colspan="8">Jumlah Surat : <?php echo $total_rows; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <!-- <div class='pull-right'>
                <?php echo $this->pagination->create_links(); ?>
            </div> -->
            <div class="pull-left">
                <div class="btn-group">
                    <button class="add btn btn-primary" type="button"><i class="fa fa-plus"></i> Tambah</button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
                </div>
                <div class="btn-group">
                    <button class="cari_no btn btn-primary" type="button"><i class="fa  fa-search"></i> Cari</button>
                    <button class="reset btn btn-success" type="button"><i class="fa  fa-refresh"></i> Reset</button>
                </div>
                <div class="btn-group">
                    <button class="rekap btn btn-info" type="button"><i class="fa  fa-file"></i> Rekap</button>
                    <button class="pengajuan btn bg-purple" type="button"><i class="fa  fa-pencil-square-o"></i> Pengajuan</button>
                    <button class="cetakhonor btn btn-warning" type="button"><i class="fa  fa-print"></i> Cetak Honor</button>
                    <button class="cetaknonhonor btn bg-olive" type="button"><i class="fa  fa-print"></i> Cetak Non Honor</button>
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
                                <input class="form-control" type="text" name="cari_no" placeholder="Nomor" />
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
<div class='modal modal_cari_tanggal no-print' role="dialog">
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
                                <input class="form-control" type="text" name="cari_tanggal" />
                                <span class="input-group-btn">
                                    <button class="tmb_cari_tanggal btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modalrekap no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Rekap Cuti Tahunan</h4>
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
                    <button class="cetakrekapcuti btn btn-success">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class='loading modal'>
    <div class='text-center align-middle' style="margin-top: 200px">
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
        <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
            <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url(); ?>/img/load.gif" width="150px"></div>
            <div style="font-size:20px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Loading</div>
        </div>
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
    </div>
</div>
<style>
    #signature {
        width: 100%;
        height: 300px;
        border: 1px solid black;
    }
</style>