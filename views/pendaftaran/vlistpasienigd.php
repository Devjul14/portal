<style>
    .dropbtn {

        color: white;
        padding: 14px, 8px, 14px, 8px;
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
        min-width: 160px;
        bottom: 31px;
        z-index: 1;
    }

    .dropup-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropup-content a:hover {
        background-color: #ccc
    }

    .dropup:hover .dropup-content {
        display: block;
    }

    /*.dropup:hover .dropbtn {
      background-color: #2980B9;
    }*/
</style>
<script>
    var mywindow;

    function openCenteredWindow(url) {
        var width = 1000;
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
            url: "<?php echo site_url('dokter/getcaripasien_inap'); ?>",
            success: function(result) {
                window.location = "<?php echo site_url('dokter/pasienigd'); ?>";
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
        $('.pdf').click(function() {
            var no_sep = $(".bg-gray").attr("no_sep");
            if (no_sep == "") {
                alert("Pasien belum memiliki SEP");
            } else {
                var url = "<?php echo site_url('grouper/claimprint_inap'); ?>/" + no_sep;
                openCenteredWindow(url);
            }
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
                url: "<?php echo site_url('dokter/search_ralan'); ?>",
                type: 'POST',
                data: arrayData,
                success: function() {
                    location.reload();
                }
            });
        });
        $(".pulang").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type: "POST",
                data: {
                    no_pasien: no_rm,
                    no_reg: no_reg
                },
                url: "<?php echo site_url('kasir/getinap_detail'); ?>",
                success: function(result) {
                    var value = JSON.parse(result);
                    console.log(value);
                    $(".noreg").html(no_reg);
                    $(".formpulang").modal("show");
                    $("[name='no_sep']").val(value.no_sjp);
                    $("[name='jam_pulang']").val("<?php echo date("H:i"); ?>");
                    if (value.tgl_keluar != null) {
                        $("[name='no_surat_pulang']").val(value.no_surat_pulang);
                        $("[name='tanggal_pulang']").val(tgl_indo(value.tgl_keluar));
                        $(".status_pasien").html("<span class='label label-danger'>Pasien sudah pulang</span>");
                        $('[name=keadaan_pulang] option[value=' + value.keadaan_pulang + ']').prop("selected", true);
                        $('[name=status_pulang] option[value=' + value.status_pulang + ']').prop("selected", true);
                    } else {
                        $("[name='no_surat_pulang']").val(no_reg);
                        $("[name='tanggal_pulang']").val('');
                        $(".status_pasien").html("");
                        $('[name=keadaan_pulang] option[value=1]').prop("selected", true);
                        $('[name=status_pulang] option[value=1]').prop("selected", true);
                    }
                },
                error: function(result) {
                    alert(result);
                }
            });
        });
        $(".migrasi").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type: "POST",
                data: {
                    no_pasien: no_rm,
                    no_reg: no_reg
                },
                url: "<?php echo site_url('dokter/cekpasien'); ?>",
                success: function(result) {
                    var value = JSON.parse(result);
                    $(".modal_cekpasien").modal("show");
                    $("[name='no_rm']").val(no_rm);
                    $("[name='no_reg']").val(no_reg);
                    $("[name='nama_pasien']").val(value.nama_pasien);
                },
                error: function(result) {
                    console.log(result);
                }
            });
        });
        $(".lanjut").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type: "POST",
                data: {
                    no_pasien: no_rm,
                    no_reg: no_reg
                },
                url: "<?php echo site_url('dokter/migrasi_ralan'); ?>",
                success: function(result) {
                    location.reload();
                },
                error: function(result) {
                    console.log(result);
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat: formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat: formattgl,
        });
        var tgl_masuk = $(".bg-gray").attr("tgl_masuk");
        $("input[name='tanggal_pulang']").datepicker({
            dateFormat: formattgl,
            minDate: new Date(tgl_masuk),
        }).datepicker("setDate", new Date());
        // $(".add").click(function(){
        //     window.location = "<?php echo site_url('pendaftaran/addpasienbaru/y/y') ?>";
        //     return false;
        // });
        $(".cetak_barcode").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakbarcode_inap'); ?>/" + id + "/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".pindahkamar").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/pindahkamar') ?>/" + id + "/" + no_reg;
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
        $(".inos").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/inos') ?>/" + id + "/" + no_reg;
            return false;
        });
        $(".inos_harian").click(function() {
            var url = "<?php echo site_url('pendaftaran/inos_harian') ?>";
            openCenteredWindow(url);
            return false;
        });
        $(".upload").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/formuploadpdf_inap'); ?>/" + id + "/" + no_reg;
            window.location = url;
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
        $(".permintaan").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('dokter/detaillab_ralan'); ?>/" + id + "/" + no_reg;
            window.location = url;
            return false;
        });

        $(".permintaanradiologi").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('dokter/detailradiologi_ralan'); ?>/" + id + "/" + no_reg;
            window.location = url;
            return false;
        });

        $(".permintaangizi").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('dokter/detailgizi_ralan'); ?>/" + id + "/" + no_reg;
            window.location = url;
            return false;
        });

        $(".permintaanpa").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('dokter/detailpa_ralan'); ?>/" + id + "/" + no_reg;
            window.location = url;
            return false;
        });
        $(".laporan_operasi").click(function() {
            var id = $(".bg-gray").attr("kode_oka");
            window.location = "<?php echo site_url('pendaftaran/formoka') ?>/" + id;
            return false;
        });
        // $(".laporan_operasi").click(function(){
        //     var no_reg = $(".bg-gray").attr("no_reg");
        //     var url = "<?php echo site_url('pendaftaran/cetak_operasi') ?>/"+no_reg;
        //     openCenteredWindow(url);
        //     return false;
        // });
        $(".datapasien").click(function() {
            window.location = "<?php echo site_url('pendaftaran') ?>";
            return false;
        });
        $(".rujukan").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/rujukan_pasien_ralan') ?>/" + no_rm + "/" + no_reg + "/ralan";
            return false;
        });
        $(".sebabkematian").click(function() {
            var no_rm = $(".bg-gray").attr("no_pasien");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/sebabkematian_ralan') ?>/" + no_rm + "/" + no_reg + "/ralan";
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
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function() {
            pencarian();
            return false;
        });
        $(".reset").click(function() {
            $.ajax({
                url: "<?php echo site_url('dokter/reset_igd'); ?>",
                success: function(result) {
                    location.reload();
                },
                error: function(result) {
                    alert(result);
                }
            });
            return false;
        });
        $(".cetak").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakinap'); ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
        });
        $(".triage").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/triage_inap') ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".tambah").click(function() {
            window.location = "<?php echo site_url('pendaftaran/tambahtriage_inap') ?>";
            return false;
        });
        $(".igd").click(function() {
            window.location = "<?php echo site_url('pendaftaran/igd_inap') ?>";
            return false;
        });
        $(".edit").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/igd') ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".send").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/send_inap') ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".visit").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/visit_inap') ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".konsul").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/konsul_inap') ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".jawaban_konsul").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/jawabankonsul_inap') ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".rtpelayanan").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/rtpelayanan_inap') ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".indeks").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/indeks_inap') ?>/" + id + "/" + no_reg;
            return false;
        });
        $(".ruangan").click(function() {
            var url = "<?php echo site_url('pendaftaran/pilihruangan1'); ?>";
            openCenteredWindow(url);
            return false;
        });
        $(".kelas").click(function() {
            var url = "<?php echo site_url('pendaftaran/pilihkelas'); ?>";
            openCenteredWindow(url);
            return false;
        });
        $(".ekspertisiradiologi").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/ekspertisiradiologi_ralan'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".sep").click(function() {
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_bpjs = $(".bg-gray").attr("no_bpjs");
            window.location = "<?php echo site_url('sep/formsep_inap') ?>/" + id + "/" + no_reg + "/" + no_bpjs;
            return false;
        });
        $(".ekspertisilab").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/ekspertisilab_ralan'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".ekspertisipa").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/ekspertisipa_ralan'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".ekspertisigizi").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/ekspertisigizi_ralan'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".simpan_pulang").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var kode_kamar = $(".bg-gray").attr("kode_kamar");
            var kode_kelas = $(".bg-gray").attr("kode_kelas");
            var kode_ruangan = $(".bg-gray").attr("kode_ruangan");
            var no_bed = $(".bg-gray").attr("no_bed");
            var tgl_keluar = $("[name='tanggal_pulang']").val();
            var jam_keluar = $("[name='jam_pulang']").val();
            var status_pulang = $("[name='status_pulang']").val();
            var no_surat_pulang = $("[name='no_surat_pulang']").val();
            var keadaan_pulang = $("[name='keadaan_pulang']").val();
            var no_sep = $("[name='no_sep']").val();
            $.ajax({
                type: "POST",
                data: {
                    no_pasien: no_rm,
                    no_reg: no_reg,
                    tgl_keluar: tgl_keluar,
                    status_pulang: status_pulang,
                    no_surat_pulang: no_surat_pulang,
                    keadaan_pulang: keadaan_pulang,
                    kode_kamar: kode_kamar,
                    kode_kelas: kode_kelas,
                    kode_ruangan: kode_ruangan,
                    no_bed: no_bed,
                    no_sep: no_sep,
                    jam_keluar: jam_keluar
                },
                url: "<?php echo site_url('kasir/simpan_pulang'); ?>",
                success: function(result) {
                    location.reload();
                },
                error: function(result) {
                    alert(result);
                }
            });
        });
        $(".apotek").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('dokter/apotek_ralan'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".hapus").click(function() {
            $(".rejected").show();
        });
        // $(".reject").click(function(){
        //     $(".rejected").show();
        // });
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
        // if (e.keyCode==78){
        //     $(".cari_nama").click();
        // }
        // if (e.keyCode==82 && !e.altKey){
        //     $(".cari_no").click();
        // }
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
<div class='modal rejected'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-red">
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION</h4>
            </div>
            <div class='modal-body'>
                <p>Yakin akan Hapus ?</p>
            </div>
            <div class='modal-footer'>
                <button class="ya_rejected btn btn-sm btn-danger">Ya</button>
                <button class="tidak_rejected btn btn-sm btn-success">Tidak</button>
            </div>
        </div>
    </div>
</div>
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
                        <th width="10%" class='text-center'>Nomor RM</th>
                        <th width="10%" class='text-center'>Nomor REG</th>
                        <th class="text-center">Nama</th>
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
                    foreach ($q3->result() as $row) {
                        if ($row->layan == "0") {
                            $layan = "<label class='label label-primary'>Layan</label>";
                        } else if ($row->layan == "1") {
                            $layan = "<label class='label label-success'>Layan</label>";
                        } else {
                            $layan = "<label class='label label-danger'>Batal</label>";
                        }
                        echo "<tr id=data href='" . $row->no_pasien . "' no_reg='" . $row->no_reg . "'>";
                        echo "<td class='text-center'>" . $row->no_pasien . "</td>";
                        echo "<td class='text-center'>" . $row->no_reg . "</td>";
                        echo "<td>" . $row->nama_pasien . "</td>";
                        echo "<td>" . $row->poli_asal . "</td>";
                        echo "<td>" . $row->poli_tujuan . "</td>";
                        echo "<td>" . $row->status_pasien . "</td>";
                        echo "<td>" . $row->jenis . "</td>";
                        echo "<td>" . $row->gol_pasien . "</td>";
                        echo "<td>" . $layan . "</td>";
                        echo "</tr>";
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
            <div class="form-horizontal">
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
                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="pull-left">
                        <button class="rujukan btn btn-sm bg-purple" type="button"> Rujukan</button>
                        <button class="sebabkematian btn btn-sm btn-danger" type="button"> Sebab Kematian</button>
                    </div>
                    <div class="pull-right">
                        <button class="reset btn btn-sm btn-warning" type="button"> Reset</button>
                        <div class="dropup">
                            <button class="dropbtn btn bg-aqua">Lab</button>
                            <div class="dropup-content">
                                <a class="ekspertisilab">Hasil</a>
                                <a class="permintaan">Permintaan</a>
                            </div>
                        </div>
                        <div class="dropup">
                            <button class="dropbtn btn bg-green">Radiologi</button>
                            <div class="dropup-content">
                                <a class="ekspertisiradiologi">Hasil</a>
                                <a class="permintaanradiologi">Permintaan</a>
                            </div>
                        </div>
                        <div class="dropup">
                            <button class="dropbtn btn bg-navy">Gizi</button>
                            <div class="dropup-content">
                                <a class="ekspertisigizi">Hasil</a>
                                <a class="permintaangizi">Permintaan</a>
                            </div>
                        </div>

                        <div class="dropup">
                            <button class="dropbtn btn bg-yellow">PA</button>
                            <div class="dropup-content">
                                <a class="ekspertisipa">Hasil</a>
                                <a class="permintaanpa">Permintaan</a>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button class="apotek btn btn-sm btn-success" type="button"> Apotek</button>
                            <button class="cari_no btn btn-sm btn-primary" type="button"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="pull-right">
                        <button class="migrasi btn btn-sm btn-primary" type="button">Migrasi</button>
                        <button class="edit btn btn-sm btn-success" type="button">Edit</button>
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
<div class='modal modal_cekpasien no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Yakin akan migrasi pasien ke rawat inap ?</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No Reg</label>
                        <div class="col-sm-3">
                            <input class="form-control" readonly type="text" name="no_reg" />
                        </div>
                        <label class="col-sm-3 control-label">No RM</label>
                        <div class="col-sm-3">
                            <input class="form-control" readonly type="text" name="no_rm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Pasien</label>
                        <div class="col-sm-9">
                            <input class="form-control" readonly type="text" name="nama_pasien" />
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <div class="pull-right">
                    <button type="button" class="lanjut btn btn-primary">Lanjut</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="formpulang modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update <b><span class="noreg"></span></b></h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Keadaan Pulang</label>
                        <div class="col-md-8">
                            <select name="keadaan_pulang" class="form-control">
                                <?php
                                foreach ($k->result() as $key) {
                                    echo "<option value=" . $key->id . ">" . $key->keterangan . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Status Pulang</label>
                        <div class="col-md-8">
                            <select name="status_pulang" class="form-control">
                                <?php
                                foreach ($sp->result() as $key) {
                                    echo "<option value='" . $key->id . "'>" . $key->keterangan . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tanggal Pulang</label>
                        <div class="col-md-5">
                            <input type="text" name="tanggal_pulang" readonly class="form-control" autocomplete="off">
                            <p class="status_pasien"></p>
                        </div>
                        <div class="col-md-3"><input type="text" name="jam_pulang" class="form-control" autocomplete="off" placeholder="00:00"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No. Surat Pulang</label>
                        <div class="col-md-8">
                            <input type="text" name="no_surat_pulang" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No. SEP</label>
                        <div class="col-md-8">
                            <input type="text" name="no_sep" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="simpan_pulang btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>