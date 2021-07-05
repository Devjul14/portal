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
            url: "<?php echo site_url('pendaftaran/getcaripasien_inap'); ?>",
            success: function(result) {
                window.location = "<?php echo site_url('pendaftaran/rawat_inap'); ?>";
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
        $(".tindakan_kedokteran").change(function() {
            var keterangan_kedokteran = "";
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type: "POST",
                data: {
                    no_reg: no_reg
                },
                url: "<?php echo site_url('pendaftaran/getpasien_tindakan'); ?>",
                success: function(result) {
                    var val = JSON.parse(result);
                    var result = val[0];
                    var keterangan_kedokteran_array = {};
                    if (result != undefined) {
                        $.each(result.keterangan_tindakan_kedokteran.split("|"), function(i, e) {
                            keterangan_kedokteran_array[i] = e;
                        });
                    }
                    $.each($(".tindakan_kedokteran option:selected"), function(i, e) {
                        keterangan_kedokteran += '<div class="form-group">';
                        keterangan_kedokteran += '    <label class="col-md-4 control-label">&nbsp;&nbsp;' + (i + 1) + ". " + e.text + '</label>';
                        keterangan_kedokteran += '    <div class="col-md-8">';
                        keterangan_kedokteran += '        <input type="text" name="keterangan_kedokteran" class="form-control ket_kedokteran" value="' + (keterangan_kedokteran_array[i] == undefined ? "" : keterangan_kedokteran_array[i]) + '">';
                        keterangan_kedokteran += '    </div>';
                        keterangan_kedokteran += '</div>';
                    });
                    $(".keterangan_kedokteran").html(keterangan_kedokteran);
                }
            });
        });
        $(".tindakan_anestesi").change(function() {
            var keterangan_anestesi = "";
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type: "POST",
                data: {
                    no_reg: no_reg
                },
                url: "<?php echo site_url('pendaftaran/getpasien_tindakan'); ?>",
                success: function(result) {
                    var val = JSON.parse(result);
                    var result = val[0];
                    var keterangan_anestesi_array = {};
                    if (result != undefined) {
                        $.each(result.keterangan_tindakan_anestesi.split("|"), function(i, e) {
                            keterangan_anestesi_array[i] = e;
                        });
                    }
                    $.each($(".tindakan_anestesi option:selected"), function(i, e) {
                        keterangan_anestesi += '<div class="form-group">';
                        keterangan_anestesi += '    <label class="col-md-4 control-label">&nbsp;&nbsp;' + (i + 1) + ". " + e.text + '</label>';
                        keterangan_anestesi += '    <div class="col-md-8">';
                        keterangan_anestesi += '        <input type="text" name="keterangan_anestesi" class="form-control ket_anestesi" value="' + (keterangan_anestesi_array[i] == undefined ? "" : keterangan_anestesi_array[i]) + '">';
                        keterangan_anestesi += '    </div>';
                        keterangan_anestesi += '</div>';
                    });
                    $(".keterangan_anestesi").html(keterangan_anestesi);
                }
            });
        });
        $(".tindakan_transfusi").change(function() {
            var keterangan_transfusi = "";
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type: "POST",
                data: {
                    no_reg: no_reg
                },
                url: "<?php echo site_url('pendaftaran/getpasien_tindakan'); ?>",
                success: function(result) {
                    var val = JSON.parse(result);
                    var result = val[0];
                    var keterangan_transfusi_array = {};
                    if (result != undefined) {
                        $.each(result.keterangan_tindakan_transfusi.split("|"), function(i, e) {
                            keterangan_transfusi_array[i] = e;
                        });
                    }
                    $.each($(".tindakan_transfusi option:selected"), function(i, e) {
                        keterangan_transfusi += '<div class="form-group">';
                        keterangan_transfusi += '    <label class="col-md-4 control-label">&nbsp;&nbsp;' + (i + 1) + ". " + e.text + '</label>';
                        keterangan_transfusi += '    <div class="col-md-8">';
                        keterangan_transfusi += '        <input type="text" name="keterangan_transfusi" class="form-control ket_transfusi" value="' + (keterangan_transfusi_array[i] == undefined ? "" : keterangan_transfusi_array[i]) + '">';
                        keterangan_transfusi += '    </div>';
                        keterangan_transfusi += '</div>';
                    });
                    $(".keterangan_transfusi").html(keterangan_transfusi);
                }
            });
        });
        $(".berita_perawatan").click(function() {
            var no_pasien = $(".bg-gray").attr("no_pasien");
            var no_reg = $(".bg-gray").attr("no_reg");
            $("input[name='no_reg_masuk_perawatan']").val(no_reg);
            $("[name='kepada_masuk_perawatan']").val("");
            $(".modal-masuk-perawatan").modal("show");
            $.ajax({
                type: "POST",
                data: {
                    no_reg: no_reg
                },
                url: "<?php echo site_url('pendaftaran/getpasien_masuk_perawatan'); ?>",
                success: function(result) {
                    var val = JSON.parse(result);
                    var result = val[0];
                    $("[name='kepada_masuk_perawatan']").val(result.kepada);
                },
            });
        });
        $(".berita_lepas_perawatan").click(function() {
            var no_pasien = $(".bg-gray").attr("no_pasien");
            var no_reg = $(".bg-gray").attr("no_reg");
            $("input[name='no_reg_berita_lepas_perawatan']").val(no_reg);
            $(".modal-berita-lepas-perawatan").modal("show");
            $.ajax({
                type: "POST",
                data: {
                    no_reg: no_reg
                },
                url: "<?php echo site_url('pendaftaran/getpasien_lepas_perawatan'); ?>",
                success: function(result) {
                    var val = JSON.parse(result);
                    var result = val[0];
                    $("[name='kepada_berita_lepas_perawatan']").val(result.kepada);
                },
            });
        });
        $(".surat_istirahat_sakit").click(function() {
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $("input[name='no_reg_surat_istirahat_sakit']").val(no_reg);
            $(".modal-surat-istirahat-sakit").modal("show");
            $("[name='kepada_surat_istirahat_sakit']").val("");
            $("[name='selama_surat_istirahat_sakit']").val("");
            $("[name='mulai_surat_istirahat_sakit']").val("");
            $("[name='sampai_surat_istirahat_sakit']").val("");
            $.ajax({
                type: "POST",
                data: {
                    no_reg: no_reg,
                    no_rm: no_pasien
                },
                url: "<?php echo site_url('pendaftaran/getpasien_istirahat_sakit'); ?>",
                success: function(result) {
                    var val = JSON.parse(result);
                    var result = val[0];
                    $("[name='kepada_surat_istirahat_sakit']").val(result.kepada);
                    $("[name='selama_surat_istirahat_sakit']").val(result.selama);
                    $("[name='mulai_surat_istirahat_sakit']").val(tgl_indo(result.mulai));
                    $("[name='sampai_surat_istirahat_sakit']").val(tgl_indo(result.sampai));
                },
            });
        });
        $(".tindakan_medis").click(function() {
            var no_pasien = $(".bg-gray").attr("no_pasien");
            var no_reg = $(".bg-gray").attr("no_reg");
            $(".modal-tindakan-medis").modal("show");
            $("input[name='no_reg_tindakan']").val(no_reg);
            $("[name='pelaksana_tindakan']").val("");
            $("[name='pemberi_informasi']").val("");
            $("[name='saksirs']").val("");
            $("[name='nama']").val("");
            $("[name='umur']").val("");
            $("[name='alamat']").val("");
            $("[name='tindakan_kedokteran']").val("");
            $("[name='tindakan_anestesi']").val("");
            $("[name='tindakan_transfusi']").val("");
            $(".keterangan_kedokteran").html("");
            $(".keterangan_anestesi").html("");
            $(".keterangan_transfusi").html("");
            $("[name='pelaksana_tindakan'],[name='pemberi_informasi'],[name='tindakan_kedokteran'],[name='tindakan_anestesi'],[name='tindakan_transfusi'],[name='saksirs']").select2();
            $.ajax({
                type: "POST",
                data: {
                    no_reg: no_reg
                },
                url: "<?php echo site_url('pendaftaran/getpasien_tindakan'); ?>",
                success: function(result) {
                    var val = JSON.parse(result);
                    var result = val[0];
                    $("[name='pelaksana_tindakan'] option[value='" + result.pelaksana_tindakan + "']").prop("selected", true);
                    $("[name='pemberi_informasi'] option[value='" + result.kategori_pemberi_informasi + "/" + result.pemberi_informasi + "']").prop("selected", true);
                    $("[name='saksirs'] option[value='" + result.kategori_saksirs + "/" + result.saksirs + "']").prop("selected", true);
                    $("[name='nama']").val(result.nama);
                    $("[name='umur']").val(result.umur);
                    $("[name='alamat']").val(result.alamat);
                    var keterangan_kedokteran_array = {};
                    $.each(result.keterangan_tindakan_kedokteran.split("|"), function(i, e) {
                        keterangan_kedokteran_array[i] = e;
                    });
                    var keterangan_anestesi_array = {};
                    $.each(result.keterangan_tindakan_anestesi.split("|"), function(i, e) {
                        keterangan_anestesi_array[i] = e;
                    });
                    var keterangan_transfusi_array = {};
                    $.each(result.keterangan_tindakan_transfusi.split("|"), function(i, e) {
                        keterangan_transfusi_array[i] = e;
                    });
                    var keterangan_kedokteran_array = {};
                    $.each(result.keterangan_tindakan_kedokteran.split("|"), function(i, e) {
                        keterangan_kedokteran_array[i] = e;
                    });
                    $.each(result.tindakan_kedokteran.split(","), function(i, e) {
                        $(".tindakan_kedokteran option[value='" + e + "']").prop("selected", true);
                    });
                    var keterangan_kedokteran = "";
                    $.each($(".tindakan_kedokteran option:selected"), function(i, e) {
                        keterangan_kedokteran += '<div class="form-group">';
                        keterangan_kedokteran += '    <label class="col-md-4 control-label">&nbsp;&nbsp;' + (i + 1) + ". " + e.text + '</label>';
                        keterangan_kedokteran += '    <div class="col-md-8">';
                        keterangan_kedokteran += '        <input type="text" name="keterangan" class="form-control ket_kedokteran" value="' + (keterangan_kedokteran_array[i] == undefined ? "" : keterangan_kedokteran_array[i]) + '">';
                        keterangan_kedokteran += '    </div>';
                        keterangan_kedokteran += '</div>';
                    });
                    $(".keterangan_kedokteran").html(keterangan_kedokteran);
                    $.each(result.tindakan_anestesi.split(","), function(i, e) {
                        $(".tindakan_anestesi option[value='" + e + "']").prop("selected", true);
                    });
                    var keterangan_anestesi = "";
                    $.each($(".tindakan_anestesi option:selected"), function(i, e) {
                        keterangan_anestesi += '<div class="form-group">';
                        keterangan_anestesi += '    <label class="col-md-4 control-label">&nbsp;&nbsp;' + (i + 1) + ". " + e.text + '</label>';
                        keterangan_anestesi += '    <div class="col-md-8">';
                        keterangan_anestesi += '        <input type="text" name="keterangan" class="form-control ket_anestesi" value="' + (keterangan_anestesi_array[i] == undefined ? "" : keterangan_anestesi_array[i]) + '">';
                        keterangan_anestesi += '    </div>';
                        keterangan_anestesi += '</div>';
                    });
                    $(".keterangan_anestesi").html(keterangan_anestesi);
                    $.each(result.tindakan_transfusi.split(","), function(i, e) {
                        $(".tindakan_transfusi option[value='" + e + "']").prop("selected", true);
                    });
                    var keterangan_transfusi = "";
                    $.each($(".tindakan_transfusi option:selected"), function(i, e) {
                        keterangan_transfusi += '<div class="form-group">';
                        keterangan_transfusi += '    <label class="col-md-4 control-label">&nbsp;&nbsp;' + (i + 1) + ". " + e.text + '</label>';
                        keterangan_transfusi += '    <div class="col-md-8">';
                        keterangan_transfusi += '        <input type="text" name="keterangan" class="form-control ket_transfusi" value="' + (keterangan_transfusi_array[i] == undefined ? "" : keterangan_transfusi_array[i]) + '">';
                        keterangan_transfusi += '    </div>';
                        keterangan_transfusi += '</div>';
                    });
                    $(".keterangan_transfusi").html(keterangan_transfusi);
                    $("[name='status_tindakan_anestesi'] option[value='" + result.status_tindakan_anestesi + "']").prop("selected", true);
                    $("[name='status_tindakan_kedokteran'] option[value='" + result.status_tindakan_kedokteran + "']").prop("selected", true);
                    $("[name='pelaksana_tindakan'],[name='pemberi_informasi'],[name='tindakan_kedokteran'],[name='tindakan_anestesi'],[name='tindakan_transfusi'],[name='saksirs']").select2();
                },
                error: function(result) {
                    console.log(result);
                    $("[name='pelaksana_tindakan'],[name='pemberi_informasi'],[name='tindakan_kedokteran'],[name='tindakan_anestesi'],[name='tindakan_transfusi'],[name='saksirs']").select2();
                }
            });
return false;
});
$(".simpan_masuk_perawatan").click(function() {
    var no_pasien = $(".bg-gray").attr("href");
    var no_reg = $("[name='no_reg_masuk_perawatan']").val();
    var kepada = $("[name='kepada_masuk_perawatan']").val();
    $.ajax({
        type: "POST",
        data: {
            jenis: "ranap",
            no_reg: no_reg,
            kepada: kepada,
            no_pasien: no_pasien
        },
        url: "<?php echo site_url('pendaftaran/simpan_berita_perawatan'); ?>",
        success: function(result) {
            alert("Data berhasil disimpan");
                    // location.reload();
                },
                error: function(result) {
                    console.log(result);
                }
            });
    return false;
});
$(".simpan_berita_lepas_perawatan").click(function() {
    var no_pasien = $(".bg-gray").attr("href");
    var no_reg = $("[name='no_reg_berita_lepas_perawatan']").val();
    var kepada = $("[name='kepada_berita_lepas_perawatan']").val();
    $.ajax({
        type: "POST",
        data: {
            jenis: "ranap",
            no_reg: no_reg,
            kepada: kepada,
            no_pasien: no_pasien
        },
        url: "<?php echo site_url('pendaftaran/simpan_berita_lepas_perawatan'); ?>",
        success: function(result) {
            alert("Data berhasil disimpan");
                    // location.reload();
                },
                error: function(result) {
                    console.log(result);
                }
            });
    return false;
});
$(".simpan_surat_istirahat_sakit").click(function() {
    var no_pasien = $(".bg-gray").attr("href");
    var no_reg = $("[name='no_reg_surat_istirahat_sakit']").val();
    var kepada = $("[name='kepada_surat_istirahat_sakit']").val();
    var selama = $("[name='selama_surat_istirahat_sakit']").val();
    var mulai = $("[name='mulai_surat_istirahat_sakit']").val();
    var sampai = $("[name='sampai_surat_istirahat_sakit']").val();
    $.ajax({
        type: "POST",
        data: {
            jenis: "ranap",
            no_reg: no_reg,
            no_pasien: no_pasien,
            kepada: kepada,
            selama: selama,
            mulai: mulai,
            sampai: sampai
        },
        url: "<?php echo site_url('pendaftaran/simpan_surat_istirahat_sakit'); ?>",
        success: function(result) {
            alert("Data berhasil disimpan");
        },
        error: function(result) {
            console.log(result);
        }
    });
    return false;
});
$(".simpan_tindakan").click(function() {
    var no_reg = $("[name='no_reg_tindakan']").val();
    var pelaksana_tindakan = $("[name='pelaksana_tindakan']").val();
    var pemberi_informasi = $("[name='pemberi_informasi']").val();
    var saksirs = $("[name='saksirs']").val();
    var tindakan_kedokteran = $("[name='tindakan_kedokteran']").val();
    var status_tindakan_kedokteran = $("[name='status_tindakan_kedokteran']").val();
    var status_tindakan_anestesi = $("[name='status_tindakan_anestesi']").val();
    var tindakan_anestesi = $("[name='tindakan_anestesi']").val();
    var tindakan_transfusi = $("[name='tindakan_transfusi']").val();
    var nama = $("[name='nama']").val();
    var umur = $("[name='umur']").val();
    var alamat = $("[name='alamat']").val();
    var keterangan_kedokteran = "";
    var space = "";
    $.each($(".keterangan_kedokteran .ket_kedokteran"), function(i, e) {
        keterangan_kedokteran += space + $(this).val();
        space = "|";
    });
    var keterangan_anestesi = "";
    var space = "";
    $.each($(".keterangan_anestesi .ket_anestesi"), function(i, e) {
        keterangan_anestesi += space + $(this).val();
        space = "|";
    });
    var keterangan_transfusi = "";
    var space = "";
    $.each($(".keterangan_transfusi .ket_transfusi"), function(i, e) {
        keterangan_transfusi += space + $(this).val();
        space = "|";
    });
    $.ajax({
        type: "POST",
        data: {
            jenis: "ranap",
            no_reg: no_reg,
            pelaksana_tindakan: pelaksana_tindakan,
            pemberi_informasi: pemberi_informasi,
            saksirs: saksirs,
            nama: nama,
            umur: umur,
            alamat: alamat,
            tindakan_kedokteran: tindakan_kedokteran,
            tindakan_anestesi: tindakan_anestesi,
            status_tindakan_kedokteran: status_tindakan_kedokteran,
            status_tindakan_anestesi: status_tindakan_anestesi,
            tindakan_transfusi: tindakan_transfusi,
            keterangan_kedokteran: keterangan_kedokteran,
            keterangan_anestesi: keterangan_anestesi,
            keterangan_transfusi: keterangan_transfusi
        },
        url: "<?php echo site_url('pendaftaran/simpan_tindakan_medis'); ?>",
        success: function(result) {
            alert("Data berhasil disimpan");
                    // location.reload();
                },
                error: function(result) {
                    console.log(result);
                }
            });
    return false;
});
$(".pulang_paksa").click(function() {
    var phone = $(".bg-gray").attr("telpon");
    var petugas_rm = $(".bg-gray").attr("petugas_rm");
    var jenis = "ranap";
    if (phone == "") {
        alert("No. HP belum terisi");
    } else {
        var no_reg = $(".bg-gray").attr("no_reg_encrypt");
        var no_pasien = $(".bg-gray").attr("href");
        var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
        if (petugas_rm != "") {
            text += "Untuk *Download* surat pulang paksa klik link dibawah ini%0A%0A";
        } else {
            text += "Untuk surat pulang paksa klik link dibawah ini%0A%0A";
        }
        text += "http://rsciremai.ddns.net/rsciremai/surat/pulang_paksa/" + no_reg + "/" + no_pasien + "/" + jenis;
        var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
        openCenteredWindow(url);
        return false;
    }
});
$('.selectall_tindakankedokteran').click(function() {
    var cek = $('.tindakan_kedokteran').find(":selected").text();
    if (cek == "") {
        $('select.tindakan_kedokteran > option').prop('selected', 'selected');
        $(".tindakan_kedokteran").trigger("change");
    } else {
        $('select.tindakan_kedokteran > option').prop('selected', '');
        $(".tindakan_kedokteran").trigger("change");
    }
});
$('.selectall_tindakananestesi').click(function() {
    var cek = $('.tindakan_anestesi').find(":selected").text();
    if (cek == "") {
        $('select.tindakan_anestesi > option').prop('selected', 'selected');
        $(".tindakan_anestesi").trigger("change");
    } else {
        $('select.tindakan_anestesi > option').prop('selected', '');
        $(".tindakan_anestesi").trigger("change");
    }
});
$('.selectall_tindakantransfusi').click(function() {
    var cek = $('.tindakan_transfusi').find(":selected").text();
    if (cek == "") {
        $('select.tindakan_transfusi > option').prop('selected', 'selected');
        $(".tindakan_transfusi").trigger("change");
    } else {
        $('select.tindakan_transfusi > option').prop('selected', '');
        $(".tindakan_transfusi").trigger("change");
    }
});
$(".artikel").click(function() {
    $(".modal_artikel").modal("show");
    $("[name='artikel']").focus();
    return false;
});
$(".send_artikel").click(function() {
    var phone = $(".bg-gray").attr("telpon");
    var slug = $("[name='artikel']").val();
    var jenis = "ralan";
    if (phone == "") {
        alert("No. HP belum terisi");
    } else {
        var no_reg = $(".bg-gray").attr("no_reg");
        var no_pasien = $(".bg-gray").attr("no_pasien");
        var text = "Selamat datang di Rumah Sakit Ciremai.%0A";
        text += "Untuk mendapatkan informasi dari kami klik link dibawah ini%0A%0A";
        text += "http://rsciremai.ddns.net/rsciremai/surat/artikel/" + slug;
        var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
        openCenteredWindow(url);
        return false;
    }
});
$(".pemulasaran").click(function() {
    var phone = $(".bg-gray").attr("telpon");
    var petugas_rm = $(".bg-gray").attr("petugas_rm");
    var jenis = "ranap";
    if (phone == "") {
        alert("No. HP belum terisi");
    } else {
        var no_reg = $(".bg-gray").attr("no_reg_encrypt");
        var no_pasien = $(".bg-gray").attr("href");
        var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
        if (petugas_rm != "") {
            text += "Untuk *Download* surat pemulasaran klik link dibawah ini%0A%0A";
        } else {
            text += "Untuk surat pemulasaran klik link dibawah ini%0A%0A";
        }
        text += "http://rsciremai.ddns.net/rsciremai/surat/pemulasaran/" + no_reg + "/" + no_pasien + "/" + jenis;
        var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
        openCenteredWindow(url);
        return false;
    }
});
$(".send_tindakan").click(function() {
    var phone = $(".bg-gray").attr("telpon");
    var petugas_rm = $(".bg-gray").attr("petugas_rm");
    var jenis = "ranap";
    if (phone == "") {
        alert("No. HP belum terisi");
    } else {
        var no_reg = $(".bg-gray").attr("no_reg");
        var no_pasien = $(".bg-gray").attr("href");
        var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
        text += "Klik link dibawah ini untuk Form Persetujuan%0A";
        text += "http://rsciremai.ddns.net/rsciremai/surat/tindakanmedis/" + no_reg + "/" + no_pasien + "/" + jenis;
        var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
        openCenteredWindow(url);
        return false;
    }
});
$(".send_masuk_perawatan").click(function() {
    var phone = $(".bg-gray").attr("telpon");
    var petugas_rm = $(".bg-gray").attr("petugas_rm");
    var jenis = "ranap";
    if (phone == "") {
        alert("No. HP belum terisi");
    } else {
        var no_reg = $(".bg-gray").attr("no_reg");
        var no_pasien = $(".bg-gray").attr("href");
        var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
        text += "Klik link dibawah ini untuk Form Persetujuan%0A";
        text += "http://rsciremai.ddns.net/rsciremai/surat/beritamasukperawatan/" + no_reg + "/" + no_pasien + "/" + jenis;
        var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
        openCenteredWindow(url);
        return false;
    }
});
        // $(".send_surat_keterangan_dokter").click(function() {
        //     var phone = $(".bg-gray").attr("telpon");
        //     var petugas_rm = $(".bg-gray").attr("petugas_rm");
        //     var jenis = "ranap";
        //     if (phone == "") {
        //         alert("No. HP belum terisi");
        //     } else {
        //         var no_reg = $(".bg-gray").attr("no_reg");
        //         var no_pasien = $(".bg-gray").attr("href");
        //         var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
        //         text += "Klik link dibawah ini untuk Form Persetujuan%0A";
        //         text += "http://rsciremai.ddns.net/rsciremai/surat/suratketerangandokter/" + no_reg + "/" + no_pasien + "/" + jenis;
        //         var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
        //         openCenteredWindow(url);
        //     }
        // });
        $(".send_berita_lepas_perawatan").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                text += "Klik link dibawah ini untuk Form Persetujuan%0A";
                text += "http://rsciremai.ddns.net/rsciremai/surat/beritalepasperawatan/" + no_reg + "/" + no_pasien + "/" + jenis;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
        });
        $(".send_surat_istirahat_sakit").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                text += "Klik link dibawah ini untuk Form Persetujuan%0A";
                text += "http://rsciremai.ddns.net/rsciremai/surat/suratistirahatsakit/" + no_reg + "/" + no_pasien + "/" + jenis;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
            }
        });
        $(".surat_tindakan_kedokteran").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_rm = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('surat/cetaktindakanmedis'); ?>/" + no_reg + "/" + no_rm + "/ranap/kedokteran";
            openCenteredWindow(url);
            return false;
        });
        $(".general_concent").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_rm = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('persetujuan/cetakpersetujuan_all'); ?>/" + no_reg + "/" + no_rm;
            openCenteredWindow(url);
            return false;
        });
        $(".surat_tindakan_anestesi").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_rm = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('surat/cetaktindakanmedis'); ?>/" + no_reg + "/" + no_rm + "/ranap/anestesi";
            openCenteredWindow(url);
            return false;
        });
        $(".surat_tindakan_transfusi").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_rm = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('surat/cetaktindakanmedis'); ?>/" + no_reg + "/" + no_rm + "/ranap/transfusi";
            openCenteredWindow(url);
            return false;
        });
        $(".surat_kematian").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var ket_pulang = $(".bg-gray").attr("ket_pulang");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                if (ket_pulang == "Meninggal") {
                    var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                    var no_pasien = $(".bg-gray").attr("href");
                    var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                    if (petugas_rm != "") {
                        text += "Untuk *Download* surat keterangan kematian klik link dibawah ini%0A%0A";
                    } else {
                        text += "Untuk surat keterangan kematian klik link dibawah ini%0A%0A";
                    }
                    text += "http://rsciremai.ddns.net/rsciremai/surat/kematian/" + no_reg + "/" + no_pasien + "/" + jenis;
                    var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                    openCenteredWindow(url);
                    return false;
                } else {
                    alert("Pasien Tidak Meninggal");
                }
            }
        });
        $(".surat_kelahiran").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var berat_badan = $(".bg-gray").attr("berat_badan");
            if (berat_badan != "") {
                var jenis = "ranap";
                if (phone == "") {
                    alert("No. HP belum terisi");
                } else {
                    var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                    var no_pasien = $(".bg-gray").attr("href");
                    var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                    if (petugas_rm != "") {
                        text += "Untuk *Download* surat keterangan kelahiran klik link dibawah ini%0A%0A";
                    } else {
                        text += "Untuk surat keterangan kelahiran klik link dibawah ini%0A%0A";
                    }
                    text += "http://rsciremai.ddns.net/rsciremai/surat/kelahiran/" + no_reg + "/" + no_pasien + "/" + jenis;
                    var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                    openCenteredWindow(url);
                    return false;
                }
            } else {
                alert("Pasien bukan bayi");
            }
        });
        $(".whatsapp").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                if (petugas_rm != "") {
                    text += "Untuk *Download* persetujuan perawatan dan tindakan klik link dibawah ini%0A%0A";
                } else {
                    text += "Untuk persetujuan perawatan dan tindakan klik link dibawah ini%0A%0A";
                }
                text += "http://rsciremai.ddns.net/rsciremai/persetujuan/formpersetujuan/" + jenis + "/" + no_reg + "/" + no_pasien;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
        });
        $(".kronologi").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                if (petugas_rm != "") {
                    text += "Untuk *Download* persetujuan perawatan dan tindakan klik link dibawah ini%0A%0A";
                } else {
                    text += "Untuk persetujuan perawatan dan tindakan klik link dibawah ini%0A%0A";
                }
                text += "http://rsciremai.ddns.net/rsciremai/persetujuan/formkronologis/" + jenis + "/" + no_reg + "/" + no_pasien;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
        });
        $(".lengkapidata_wa").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                text += "Untuk *Lengkapi Data* klik link dibawah ini%0A%0A";
                text += "http://rsciremai.ddns.net/rsciremai/surat/addpasienbaru_inap/" + no_pasien + "/" + no_reg;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
        });
        $(".surat_isolasi").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                if (petugas_rm != "") {
                    text += "Untuk *Download* surat keterangan selesai isolasi  klik link dibawah ini%0A%0A";
                } else {
                    text += "Untuk surat keterangan selesai isolasi  klik link dibawah ini%0A%0A";
                }
                text += "http://rsciremai.ddns.net/rsciremai/surat/suketisolasi/" + no_pasien + "/" + no_reg + "/" + jenis;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
        });
        $(".surat_bebascovid").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                if (petugas_rm != "") {
                    text += "Untuk *Download* surat keterangan bebas covid klik link dibawah ini%0A%0A";
                } else {
                    text += "Untuk surat keterangan bebas covid klik link dibawah ini%0A%0A";
                }
                text += "http://rsciremai.ddns.net/rsciremai/surat/suketbebascovid/" + no_reg + "/" + no_pasien + "/" + jenis;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
        });
        $(".pemulasaran_covid").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                if (petugas_rm != "") {
                    text += "Untuk *Download* surat keterangan bebas covid klik link dibawah ini%0A%0A";
                } else {
                    text += "Untuk surat keterangan bebas covid klik link dibawah ini%0A%0A";
                }
                text += "http://rsciremai.ddns.net/rsciremai/pendaftaran/pemulsaran_covid/" + no_reg + "/" + no_pasien + "/" + jenis;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
        });
        $(".kirim_resume").click(function() {
            var phone = $(".bg-gray").attr("telpon");
            var petugas_rm = $(".bg-gray").attr("petugas_rm");
            var jenis = "ranap";
            if (phone == "") {
                alert("No. HP belum terisi");
            } else {
                var no_reg = $(".bg-gray").attr("no_reg_encrypt");
                var no_pasien = $(".bg-gray").attr("href");
                var text = "Selamat datang di Rumah Sakit Ciremai kami petugas pendaftaran RS Ciremai.%0A";
                if (petugas_rm != "") {
                    text += "Untuk resume klik link dibawah ini%0A%0A";
                } else {
                    text += "Untuk *Download* resume klik link dibawah ini%0A%0A";
                }
                text += "http://rsciremai.ddns.net/rsciremai/surat/cetakresumeinap/" + no_pasien + "/" + no_reg;
                var url = "https://api.whatsapp.com/send?phone=" + phone + "&text=" + text;
                openCenteredWindow(url);
                return false;
            }
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
        $(".cetaksep").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_bpjs = $(".bg-gray").attr("no_bpjs");
            var no_sep = $(".bg-gray").attr("no_sep");
            var url = "<?php echo site_url('sep/cetaksep_inap'); ?>/" + no_reg + "/" + no_rm + "/" + no_bpjs + "/" + no_sep;
            openCenteredWindow(url);
            return false;
        });
        $(".cppt").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cppt_ranap'); ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
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
        $(".news").click(function() {
            $(".modal_ews").modal("show");
            $(".judul_ews").html("NEWS");
            $("[name='jenis_ews']").val("NEWS");
        });
        $(".pews").click(function() {
            $(".modal_ews").modal("show");
            $(".judul_ews").html("PEWS");
            $("[name='jenis_ews']").val("PEWS");
        });
        $(".meows").click(function() {
            $(".modal_ews").modal("show");
            $(".judul_ews").html("MEOWS");
            $("[name='jenis_ews']").val("MEOWS");
        });
        $(".cetak_ews").click(function() {
            var jenis = $("[name='jenis_ews']").val();
            if (jenis == "NEWS") {
                var no_rm = $(".bg-gray").attr("href");
                var no_reg = $(".bg-gray").attr("no_reg");
                var tgl1 = $("[name='tgl1_ews']").val();
                var tgl2 = $("[name='tgl2_ews']").val();
                var url = "<?php echo site_url('perawat/cetaknews'); ?>/" + no_rm + "/" + no_reg + "/" + tgl1 + "/" + tgl2;
            } else
            if (jenis == "PEWS") {
                var no_rm = $(".bg-gray").attr("href");
                var no_reg = $(".bg-gray").attr("no_reg");
                var tgl1 = $("[name='tgl1_ews']").val();
                var tgl2 = $("[name='tgl2_ews']").val();
                var url = "<?php echo site_url('perawat/cetakpews'); ?>/" + no_rm + "/" + no_reg + "/" + tgl1 + "/" + tgl2;
            } else
            if (jenis == "MEOWS") {
                var no_rm = $(".bg-gray").attr("href");
                var no_reg = $(".bg-gray").attr("no_reg");
                var tgl1 = $("[name='tgl1_ews']").val();
                var tgl2 = $("[name='tgl2_ews']").val();
                var url = "<?php echo site_url('perawat/cetakmeows'); ?>/" + no_rm + "/" + no_reg + "/" + tgl1 + "/" + tgl2;
            }
            openCenteredWindow(url);
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
                    $("[name='jam_kontrol']").val("<?php echo date("H:i"); ?>");
                    if (value.tgl_keluar != null) {
                        $("[name='no_surat_pulang']").val(value.no_surat_pulang);
                        $("[name='tanggal_pulang']").val(tgl_indo(value.tgl_keluar));
                        $("[name='jam_pulang']").val(value.jam_keluar);
                        $("[name='tanggal_kontrol']").val(tgl_indo(value.tgl_kontrol));
                        $("[name='jam_kontrol']").val(value.jam_kontrol);
                        $(".status_pasien").html("<span class='label label-danger'>Pasien sudah pulang</span>");
                        $('[name=dpjp] option[value=' + value.dpjp + ']').prop("selected", true);
                        $('[name=keadaan_pulang] option[value=' + value.keadaan_pulang + ']').prop("selected", true);
                        $('[name="transport_pulang"] option[value="' + value.transport_pulang + '"]').prop("selected", true);
                        $('[name=status_pulang] option[value=' + value.status_pulang + ']').prop("selected", true);
                    } else {
                        $("[name='no_surat_pulang']").val(no_reg);
                        $("[name='tanggal_pulang']").val('');
                        $("[name='tanggal_kontrol']").val('');
                        $(".status_pasien").html("");
                        $('[name=keadaan_pulang] option[value=1]').prop("selected", true);
                        $('[name=transport_pulang] option[value=1]').prop("selected", true);
                        $('[name=status_pulang] option[value=1]').prop("selected", true);
                    }
                    $("[name='dpjp']").select2();
                },
                error: function(result) {
                    alert(result);
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1'],[name='tgl1_ews'],[name='tgl2_ews']").datepicker({
            dateFormat: formattgl,
        });
        $("[name='mulai_surat_istirahat_sakit'],[name='sampai_surat_istirahat_sakit']").datepicker({
            dateFormat: formattgl,
            onSelect: function() {
                if (($("[name='mulai_surat_istirahat_sakit']").val() != "") && ($("[name='sampai_surat_istirahat_sakit']").val() != "")) {
                    var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
                    var firstDate = new Date(tgl_barat($("[name='mulai_surat_istirahat_sakit']").val()));
                    var secondDate = new Date(tgl_barat($("[name='sampai_surat_istirahat_sakit']").val()));
                    var diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));
                    $("[name='selama_surat_istirahat_sakit']").val(diffDays + 1);
                }
            }
        });
        $("input[name='tanggal_kontrol']").datepicker({
            dateFormat: formattgl,
        })
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
            var statuspulang = $(".bg-gray").attr("status_pulang");
            if (statuspulang!=""){
              alert("Pasien sudah pulang");
            } else {
              var id = $(".bg-gray").attr("href");
              var no_reg = $(".bg-gray").attr("no_reg");
              window.location = "<?php echo site_url('pendaftaran/pindahkamar') ?>/" + id + "/" + no_reg;
            }
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
        $(".triage").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('dokter/cetaktriage'); ?>/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".assesment").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var id_dokter = $(".bg-gray").attr("id_dokter");
            var url = "<?php echo site_url('dokter/cetakigdinap'); ?>/" + no_reg + "/" + id_dokter;
            openCenteredWindow(url);
            return false;
        });
        $(".perawat").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var id_dokter = $(".bg-gray").attr("id_dokter");
            var url = "<?php echo site_url('perawat/cetakassesmen'); ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".covid").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var id_dokter = $(".bg-gray").attr("id_dokter");
            var url = "<?php echo site_url('perawat/cetakcovid'); ?>/" + no_rm + "/" + no_reg + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".sksi").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('suket/suketisolasi'); ?>/" + no_rm + "/" + no_reg + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".skbc").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('suket/suketbebascovid'); ?>/" + no_rm + "/" + no_reg + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".erm_pulang").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('surat/pulang_paksa'); ?>/" + no_reg + "/" + no_rm + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".erm_case_manager").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('perawat/cetakform_ab'); ?>/" + no_reg + "/" + no_rm;
            openCenteredWindow(url);
            return false;
        });
        $(".erm_pemulasaran").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('surat/pemulasaran'); ?>/" + no_reg + "/" + no_rm + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".erm_kelahiran").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var berat_badan = $(".bg-gray").attr("berat_badan");
            if (berat_badan != "") {
                var url = "<?php echo site_url('pendaftaran/cetakkelahiran'); ?>/" + no_reg + "/" + no_rm + "/ranap";
                openCenteredWindow(url);
            } else {
                alert("Pasien bukan bayi");
            }
            return false;
        });
        $(".erm_beritamasukperawatan").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('surat/beritamasukperawatan'); ?>/" + no_reg + "/" + no_rm + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".erm_beritalepasperawatan").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('surat/beritalepasperawatan'); ?>/" + no_reg + "/" + no_rm + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".erm_suratketerangandokter").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('surat/suratketerangandokter'); ?>/" + no_reg + "/" + no_rm + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".erm_suratistirahatsakit").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('surat/suratistirahatsakit'); ?>/" + no_reg + "/" + no_rm + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".erm_kematian").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var ket_pulang = $(".bg-gray").attr("ket_pulang");
            if (ket_pulang == "Meninggal") {
                var url = "<?php echo site_url('pendaftaran/kematian'); ?>/" + no_reg + "/" + no_rm + "/ranap";
                openCenteredWindow(url);
            } else {
                alert("Pasien Tidak Meninggal");
            }
            return false;
        });
        $(".erm_pemulasaran_covid").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var ket_pulang = $(".bg-gray").attr("ket_pulang");
            if (ket_pulang == "Meninggal") {
                var url = "<?php echo site_url('pendaftaran/pemulsaran_covid'); ?>/" + no_reg + "/" + no_rm + "/ranap";
                openCenteredWindow(url);
            } else {
                alert("Pasien Tidak Meninggal");
            }
            return false;
        });
        $(".erm_sebabkematian").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var status_pulang = $(".bg-gray").attr("status_pulang");
            if (status_pulang==4){
              var url = "<?php echo site_url('dokter/cetaksebabkematian');?>/"+no_reg+"/"+no_rm;
              openCenteredWindow(url);
            } else {
              alert("Status pasien tidak meninggal");
            }
        });
        $(".erm_rujukan").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('surat/rujukan_pasien'); ?>/" + no_reg + "/" + no_rm + "/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".persetujuan").click(function() {
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $(".modal_persetujuan").modal("show");
            $("[name='password_petugas']").focus();
            $("[name='no_pasien_p']").val(no_pasien);
            $("[name='no_reg_p']").val(no_reg);
            return false;
            // var url = "<?php echo site_url('persetujuan/forminsert_petugas'); ?>/"+no_reg+"/"+no_pasien+"/"+"P";
            // openCenteredWindow(url);
            // return false;
        });
        $(".persetujuan_umum").click(function() {
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $(".modal_persetujuan_umum").modal("show");
            $("[name='password_petugas']").focus();
            $("[name='no_pasien_p']").val(no_pasien);
            $("[name='no_reg_p']").val(no_reg);
            return false;
            // var no_pasien = $(".bg-gray").attr("href");
            // var no_reg = $(".bg-gray").attr("no_reg");
            // var url = "<?php echo site_url('persetujuan/forminsert_petugas'); ?>/"+no_reg+"/"+no_pasien+"/"+"U";
            // openCenteredWindow(url);
            // return false;
        });
        $(".pernyataan_covid").click(function() {
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('persetujuan/cetakpernyataan_covid'); ?>/" + no_reg + "/" + no_pasien;
            openCenteredWindow(url);
            return false;
            // var no_pasien = $(".bg-gray").attr("href");
            // var no_reg = $(".bg-gray").attr("no_reg");
            // var url = "<?php echo site_url('persetujuan/forminsert_petugas'); ?>/"+no_reg+"/"+no_pasien+"/"+"U";
            // openCenteredWindow(url);
            // return false;
        });
        $(".konfirmasi_covid").click(function() {
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('persetujuan/cetakkonfirmasi_covid'); ?>/" + no_reg + "/" + no_pasien;
            openCenteredWindow(url);
            return false;
            // var no_pasien = $(".bg-gray").attr("href");
            // var no_reg = $(".bg-gray").attr("no_reg");
            // var url = "<?php echo site_url('persetujuan/forminsert_petugas'); ?>/"+no_reg+"/"+no_pasien+"/"+"U";
            // openCenteredWindow(url);
            // return false;
        });
        $(".cetakkronologi").click(function() {
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $(".modal_kronologi").modal("show");
            $("[name='password_kronologis']").focus();
            $("[name='no_pasien_p']").val(no_pasien);
            $("[name='no_reg_p']").val(no_reg);
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

        $(".cetakcovid").click(function() {
            var no_reg = $(".bg-gray").attr("no_reg");
            var no_pasien = $(".bg-gray").attr("href");
            // $(".modal_cetak_covid").modal("show");
            // $("[name='cetak_covid']").focus();
            var url = "<?php echo site_url('pendaftaran/ekspertisi_inap'); ?>/" + no_pasien + "/" + no_reg ;
            openCenteredWindow(url);
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
            window.location = "<?php echo site_url('pendaftaran/reset_inap'); ?>/";
            // location.reload();
            return false;
        });
        $(".cetak").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakinap'); ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
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
        $(".tmb_kronologi").click(function() {
            // var no_pasien = $("[name='no_pasien_p']").val();
            // var no_reg = $("[name='no_reg_p']").val();
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var password_kronologis = $("[name='password_kronologis']").val();
            $.ajax({
                type: "POST",
                data: {
                    password_petugas: password_kronologis
                },
                url: "<?php echo site_url('persetujuan/cekpetugas_kronologis'); ?>/" + no_reg + "/" + no_pasien,
                success: function(ada) {
                    if (ada == "true") {
                        var site = "<?php echo site_url('persetujuan/cetakkronologis'); ?>/" + no_reg + "/" + no_pasien;
                        openCenteredWindow(site);
                        $("[name='password_kronologis").val("");
                        $(".modal_kronologi").modal("hide");
                    } else {
                        alert("Password yang Anda masukan salah");
                    }
                },
                error: function(result) {
                    console.log(result);
                }
            });
            return false;
        });
        $(".tmb_persetujuan_umum").click(function() {
            // var no_pasien = $("[name='no_pasien_p']").val();
            // var no_reg = $("[name='no_reg_p']").val();
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var password_petugas = $("[name='password_petugas_umum']").val();
            var ada = "";
            $.ajax({
                type: "POST",
                data: {
                    password_petugas: password_petugas
                },
                async: false,
                url: "<?php echo site_url('persetujuan/cekpetugas_rm/persetujuan_umum'); ?>/" + no_reg + "/" + no_pasien,
                success: function(result) {
                    ada = result;
                },
                error: function(result) {
                    console.log(result);
                }
            });
            if (ada == "true") {
                var site = "<?php echo site_url('persetujuan/cetakpersetujuan_umum'); ?>/" + no_reg + "/" + no_pasien;
                openCenteredWindow(site);
                $("[name='password_petugas_umum").val("");
                $(".modal_persetujuan_umum").modal("hide");
            } else {
                alert("Password yang Anda masukan salah");
            }
        });
        $(".layani").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/layani_inap') ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".resume").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('dokter/cetakresumeinap') ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
            return false;
        });

        $(".ringkasan").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakringkasan') ?>/" + no_rm + "/" + no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".send").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var back = "rawat_inap";
            window.location = "<?php echo site_url('pendaftaran/send_inap') ?>/" + no_rm + "/" + no_reg + "/" + back;
            return false;
        });
        $(".terima_ruangan").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/terima_ruangan') ?>/" + no_rm + "/" + no_reg;
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
            window.location = "<?php echo site_url('pendaftaran/ekspertisiradiologi_inap'); ?>/" + no_rm + "/" + no_reg;
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
            window.location = "<?php echo site_url('pendaftaran/ekspertisilab_inap'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".ekspertisipa").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/ekspertisipa_inap'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".ekspertisigizi").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/ekspertisigizi_inap'); ?>/" + no_rm + "/" + no_reg;
            return false;
        });
        $(".lengkapidata").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/addpasienbaru_inap/n/n/n'); ?>/" + no_rm + "/" + no_reg;
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
            var tgl_kontrol = $("[name='tanggal_kontrol']").val();
            var jam_keluar = $("[name='jam_pulang']").val();
            var jam_kontrol = $("[name='jam_kontrol']").val();
            var status_pulang = $("[name='status_pulang']").val();
            var no_surat_pulang = $("[name='no_surat_pulang']").val();
            var keadaan_pulang = $("[name='keadaan_pulang']").val();
            var transport_pulang = $("[name='transport_pulang']").val();
            var dpjp = $("[name='dpjp']").val();
            var no_sep = $("[name='no_sep']").val();
            if (tgl_keluar != "" && jam_keluar != "" && status_pulang != "" && no_surat_pulang != "" && keadaan_pulang != "" && dpjp != "" && no_sep != "") {
                $(".modal_formpulang").modal("show");
            } else {
                alert("Lengkapi data dengan benar !!!");
            }
        });
        $(".tmb_formpulang").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var kode_bagian = $(".bg-gray").attr("kode_bagian");
            var kode_kamar = $(".bg-gray").attr("kode_kamar");
            var kode_kelas = $(".bg-gray").attr("kode_kelas");
            var kode_ruangan = $(".bg-gray").attr("kode_ruangan");
            var no_bed = $(".bg-gray").attr("no_bed");
            var tgl_keluar = $("[name='tanggal_pulang']").val();
            var tgl_kontrol = $("[name='tanggal_kontrol']").val();
            var jam_keluar = $("[name='jam_pulang']").val();
            var jam_kontrol = $("[name='jam_kontrol']").val();
            var status_pulang = $("[name='status_pulang']").val();
            var no_surat_pulang = $("[name='no_surat_pulang']").val();
            var keadaan_pulang = $("[name='keadaan_pulang']").val();
            var transport_pulang = $("[name='transport_pulang']").val();
            var password = $("[name='password_formpulang']").val();
            var dpjp = $("[name='dpjp']").val();
            var no_sep = $("[name='no_sep']").val();
            if (tgl_keluar != "" && jam_keluar != "" && status_pulang != "" && no_surat_pulang != "" && keadaan_pulang != "" && dpjp != "" && no_sep != "") {
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
                        jam_keluar: jam_keluar,
                        jam_kontrol: jam_kontrol,
                        dpjp: dpjp,
                        transport_pulang: transport_pulang,
                        tgl_kontrol: tgl_kontrol,
                        password: password,
                        kode_bagian: kode_bagian
                    },
                    url: "<?php echo site_url('kasir/simpan_pulang'); ?>",
                    success: function(result) {
                        if (result=="false"){
                          alert("Password tidak sesuai");
                      } else {
                          location.reload();
                      }
                  },
                  error: function(result) {
                    alert(result);
                }
            });
            } else {
                alert("Lengkapi data dengan benar !!!");
            }
        });
        $(".apotek").click(function() {
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/apotek_inap'); ?>/" + no_rm + "/" + no_reg;
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
        getcek_gk()
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

function tgl_barat(tgl, tipe = 1) {
    var date = tgl.substring(0, 2);
    if (tipe == 1)
        var bln = tgl.substring(3, 5);
    else
        var bln = tgl.substring(4, 6);
    var thn = tgl.substring(tgl.length, tgl.length - 4);
    return thn + "-" + bln + "-" + date;
}

function getDates(startDate, endDate) {
    if (($("[name='mulai_surat_istirahat_sakit']").val() != "") && ($("[name='sampai_surat_istirahat_sakit']").val() != "")) {
            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date($("[name='mulai_surat_istirahat_sakit']").val());
            var secondDate = new Date($("[name='sampai_surat_istirahat_sakit']").val());
            var diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));
            $("[name='selama_surat_istirahat_sakit']").val(diffDays);
        }
    };
    function getcek_gk(){
        var row = {}
        $.each($("tr#data"), function( key, value ) {
            row[key] = $(this).attr("gk");
        });
        $.ajax({
            type  : "POST",
            data  : {row:row},
            url   : "<?php echo site_url('pendaftaran/getcek_gk');?>",
            success : function(result){
                var dat = JSON.parse(result);
                console.log(result);
                $.each(dat, function( key, value ) {
                    var text = value!="0" ? "<i class='fa fa-check label-success'></i>" : "";
                    $(".gk_"+key).html(text);
                });
            },
            error: function(result){
                console.log(result);
            }
        });
        return false;
    };
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
                        <button class="reset btn btn-warning btn-sm" type="button"> Reset</button>
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
                        <th width="10%" class='text-center'>Nomor RM</th>
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
                    foreach ($q3->result() as $row) {
                        if (isset($ttd[$row->no_reg])) {
                            // $cek = "<i class='fa fa-check label-success'></i>";
                            $petugas_rm = $ttd[$row->no_reg];
                        } else {
                            $cek = $petugas_rm = "";
                        }
                        $cek = "<span class='gk_".$row->no_rm."_".$row->no_reg."'><i class='fa fa-refresh fa-spin'></i></span>";
                        $telpon = preg_replace('/0/', '62', $row->telpon, 1);
                        $ind = '<span class="label label-success">ind</span>';
                        echo "<tr id=data gk='".$row->no_rm . "_" . $row->no_reg."' href='" . $row->no_rm . "' kode_bagian='".$row->kode_bagian."' berat_badan='" . $row->berat_badan . "' ket_pulang='" . $row->ket_pulang . "' petugas_rm='" . $petugas_rm . "' no_reg_encrypt='" . $row->no_reg . "' telpon='" . $telpon . "' id_dokter='" . $row->dokter . "' no_reg='" . $row->no_reg . "' no_bpjs='" . $row->no_bpjs . "' kode_kamar='" . $row->kode_kamar . "' kode_kelas='" . $row->kode_kelas . "' kode_ruangan='" . $row->kode_ruangan . "' no_bed='" . $row->no_bed . "' no_sep='" . $row->no_sjp . "' jenis_kelamin='" . $row->jenis_kelamin . "' tgl_masuk='" . date("Y/m/d", strtotime($row->tgl_masuk)) . "' status_pulang='".$row->status_pulang."'>";
                        echo "<td class='text-center'>" . $cek . " " . $row->no_rm . "</td>";
                        echo "<td class='text-center'>" . $row->no_reg . "</td>";
                        echo "<td>" . $row->nama_pasien . "</td>";
                        echo "<td>" . substr($row->alamat, 0, 45) . "</td>";
                        echo "<td>" . $row->nama_ruangan . "</td>";
                        echo "<td>" . $row->nama_kelas . "</td>";
                        echo "<td>" . $row->kode_kamar . "</td>";
                        echo "<td class='text-center'>" . $row->no_bed . "</td>";
                        echo "<td>" . $row->gol_pasien . "</td>";
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
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropup">
                        <button class="dropbtn btn btn-sm btn-success">Ruangan</button>
                        <div class="dropup-content">
                            <a class="pindahkamar"> Pindah Kamar</a>
                            <a class="pindahstatus"> Pindah Status</a>
                            <a class="pulang"> Pulang</a>
                            <a class="inos"> Inos</a>
                            <a class="terima_ruangan"> Terima Ruangan</a>
                            <a class="send"> Send</a>
                            <a class="layani"> Layani</a>
                        </div>
                    </div>
                    <div class="dropup">
                        <button class="dropbtn btn btn-sm btn-primary">Rekam Medis</button>
                        <div class="dropup-content">
                            <a class="sep"> Buat SEP</a>
                            <a class="cetak_barcode"> Barcode</a>
                            <a class="edit"> Edit</a>
                            <a class="datapasien"> Data Pasien</a>
                            <a class="lengkapidata"> Lengkapi Data</a>
                            <a class="indeks"> Indeks</a>
                            <a class="hapus"> Hapus</a>
                        </div>
                    </div>
                    <div class="dropup">
                        <button class="dropbtn btn btn-sm btn-warning">Ekspertisi</button>
                        <div class="dropup-content">
                            <a class="apotek"> Apotek</a>
                            <a class="view_pembayaran"> Billing</a>
                            <a class="ekspertisigizi">Gizi</a>
                            <a class="ekspertisipa">PA</a>
                            <a class="ekspertisilab">Lab</a>
                            <a class="ekspertisiradiologi">Radiologi</a>
                            <!-- <a class="cetakcovid">Cetak Covid</a> -->
                        </div>
                    </div>
                    <div class="dropup">
                        <button class="dropbtn btn btn-sm bg-maroon">ERM</button>
                        <div class="dropup-content">
                            <a class="triage"> Triage</a>
                            <div class="sidenav">
                                <a class="cetak"> Assesment<i class='fa fa-angle-right pull-right'></i></a>
                                <div class="dropup-content-sidenav">
                                    <a class="assesment"> Assesment Medis IGD</a>
                                    <a class="perawat"> Assesment Keperawatan</a>
                                </div>
                            </div>
                            <a class="askep"> Askep</a>
                            <a class="asbid"> Asbid</a>
                            <div class="sidenav">
                                <a class="cetak"> EWS<i class='fa fa-angle-right pull-right'></i></a>
                                <div class="dropup-content-sidenav">
                                    <a class="news"> NEWS</a>
                                    <a class="pews"> PEWS</a>
                                    <a class="meows"> MEOWS</a>
                                </div>
                            </div>
                            <a class="covid"> Covid</a>
                            <a class="cetaksep"> SEP</a>
                            <a class="cppt"> CPPT</a>
                            <a class="resume"> Resume</a>
                            <a class="erm_sebabkematian"> Sebab Kematian</a>
                            <a class="ringkasan"> Ringkasan Masuk & Keluar</a>
                            <a class="pdf"> LIP</a>
                            <div class="sidenav">
                                <a class="cetak"> Laporan<i class='fa fa-angle-right pull-right'></i></a>
                                <div class="dropup-content-sidenav">
                                    <a class="laporan_tindakan"> Laporan Tindakan</a>
                                    <a class="laporan_operasi"> Laporan Operasi</a>
                                    <a class="laporan_mata"> Laporan Ops Mata (Katarak)</a>
                                    <a class="laporan_pterygium"> Laporan Ops Mata (Pterygium)</a>
                                </div>
                            </div>
                            <div class="sidenav">
                                <a class="cetak"> Surat<i class='fa fa-angle-right pull-right'></i></a>
                                <div class="dropup-content-sidenav">
                                    <a class="sksi"> Surat Keterangan Selesai ISOLASI</a>
                                    <a class="skbc"> Surat Keterangan Bebas Covid</a>
                                    <a class="erm_pulang"> Pulang Paksa</a>
                                    <a class="erm_pemulasaran"> Pemulasaran</a>
                                    <a class="erm_pemulasaran_covid"> Suket Pemulsaran Covid</a>
                                    <a class="erm_kematian"> Surat Kematian</a>
                                    <a class="erm_kelahiran"> Surat Kelahiran</a>
                                    <a class="erm_beritamasukperawatan"> Berita Masuk Perawatan</a>
                                    <a class="erm_beritalepasperawatan"> Berita Lepas Perawatan</a>
                                    <a class="erm_suratistirahatsakit"> Surat Istirahat Sakit</a>
                                    <a class="erm_rujukan"> Rujukan Pasien</a>
                                </div>
                            </div>
                            <div class="sidenav">
                                <a class="cetak"> Cetak<i class='fa fa-angle-right pull-right'></i></a>
                                <div class="dropup-content-sidenav">
                                    <a class="persetujuan"> Cetak Persetujuan</a>
                                    <a class="persetujuan_umum"> Cetak Persetujuan Umum</a>
                                    <a class="pernyataan_covid"> Cetak Pernyataan Covid</a>
                                    <a class="konfirmasi_covid"> Cetak Konfirmasi Covid</a>
                                    <a class="cetakkronologi"> Cetak Kronologis</a>
                                </div>
                            </div>
                            <div class="sidenav">
                                <a class="cetak"> IC<i class='fa fa-angle-right pull-right'></i></a>
                                <div class="dropup-content-sidenav">
                                    <!-- <a class="general_concent"> General Concent</a> -->
                                    <a class="surat_tindakan_kedokteran"> Surat Persetujuan Tindakan Kedokteran</a>
                                    <a class="surat_tindakan_anestesi"> Surat Persetujuan Tindakan Anestesi</a>
                                    <a class="surat_tindakan_transfusi"> Surat Persetujuan Tindakan Transfusi</a>
                                </div>
                            </div>
                            <a class="erm_case_manager"> Case Manager</a>
                        </div>
                    </div>
                    <button class="rtpelayanan btn btn-sm btn-success" type="button">Respon Time Pelayanan</button>
                    <button class="upload btn btn-sm btn-primary" type="button">PDF</button>
                    <!-- <button class="whatsapp btn btn-sm btn-success" type="button"><i class="fa fa-whatsapp"></i>&nbsp;Send Whatsapp</button> -->
                    <div class="dropup">
                        <button class="btn btn-sm btn-success"><i class="fa fa-whatsapp"></i> Send Whatsapp</button>
                        <div class="dropup-content">
                            <a class="lengkapidata_wa"> Lengkapi Data</a>
                            <a class="whatsapp"> General Concent</a>
                            <a class="kronologi"> Kronologi</a>
                            <a class="artikel"> Info/ Promosi</a>
                            <a class="surat_isolasi"> Surat Keterangan Selesai ISOLASI</a>
                            <a class="surat_bebascovid">Surat Keterangan Bebas COVID</a>
                            <a class="pemulasaran_covid">Suket Pemulasaran COVID</a>
                            <a class="kirim_resume"> Resume</a>
                            <a class="pulang_paksa"> Pulang Paksa</a>
                            <a class="pemulasaran"> Pemulasaran</a>
                            <a class="surat_kematian"> Surat Kematian</a>
                            <a class="surat_kelahiran"> Surat Kelahiran</a>
                            <a class="tindakan_medis"> Tindakan Medis</a>
                            <a class="berita_perawatan"> Berita Masuk Perawatan</a>
                            <!-- <a class="send_surat_keterangan_dokter"> Surat Keterangan Dokter</a> -->
                            <a class="berita_lepas_perawatan"> Berita Lepas Perawatan</a>
                            <a class="surat_istirahat_sakit"> Surat Istirahat Sakit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_persetujuan no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Petugas RM</h4>
            </div>
            <div class='modal-body'>
                <!-- <?php
                        echo form_open("persetujuan/cekpetugas_rm/persetujuan", array("id" => "formsave"));
                        ?> -->
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input class="form-control" type="hidden" name="no_reg_p" />
                                        <input class="form-control" type="hidden" name="no_pasien_p" />
                                        <input class="form-control" type="password" name="password_petugas" placeholder="Masukan password petugas rm" />
                                        <span class="input-group-btn">
                                            <button class="tmb_persetujuan btn btn-success" type="button">Ok</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <?php echo form_close(); ?> -->
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal_kronologi no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Petugas RM</h4>
                    </div>
                    <div class='modal-body'>
                <!-- <?php
                        echo form_open("persetujuan/cekpetugas_rm/persetujuan", array("id" => "formsave"));
                        ?> -->
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input class="form-control" type="hidden" name="no_reg_p" />
                                        <input class="form-control" type="hidden" name="no_pasien_p" />
                                        <input class="form-control" type="password" name="password_kronologis" placeholder="Masukan password petugas rm" />
                                        <span class="input-group-btn">
                                            <button class="tmb_kronologi btn btn-success" type="button">Ok</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <?php echo form_close(); ?> -->
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal_persetujuan_umum no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Petugas RM</h4>
                    </div>
                    <div class='modal-body'>
                <!-- <?php
                        echo form_open("persetujuan/cekpetugas_rm/persetujuan_umum", array("id" => "formsave"));
                        ?> -->
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input class="form-control" type="hidden" name="no_reg_p" />
                                        <input class="form-control" type="hidden" name="no_pasien_p" />
                                        <input class="form-control" type="password" name="password_petugas_umum" placeholder="Masukan password petugas rm" />
                                        <span class="input-group-btn">
                                            <button class="tmb_persetujuan_umum btn btn-success">Ok</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <?php echo form_close(); ?> -->
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal_cetak_covid no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian Tanggal Pemeriksaan Cetak Covid</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label class="control-label">Tanggal Pemeriksaan</label>
                                        <select class="form-control"  name="tanggal_pemeriksaan">
                                            <!-- <option value="">-----</option> -->
                                            <?php
                                        // foreach ($ks->result() as $kas) {
                                        //     echo "
                                        //         <option value='".$kas->tanggal."/".$kas->pemeriksaan."' ".($kas->pemeriksaan==$pemeriksaan && $kas->tanggal == $tgl ? "selected" : "")."> Tanggal : ".date('d-m-Y',strtotime($kas->tanggal))." || Pemeriksaan ke- ".$kas->pemeriksaan."</option>
                                        //     ";

                                        // }
                                            ?>
                                        </select>
                                        <span class="input-group-btn">
                                            <!-- <button class="tmb_cari_no btn btn-success">Cari</button> -->
                                        </span>
                                    </div>
                                </div>
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
                                <label class="col-md-4 control-label">DPJP</label>
                                <div class="col-md-8">
                                    <select name="dpjp" class="form-control" style="width: 100%">
                                        <?php
                                        foreach ($dok->result() as $key) {
                                            echo "<option value=" . $key->id_dokter . ">" . $key->nama_dokter . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
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
                                <label class="col-md-4 control-label">Transportasi Pulang</label>
                                <div class="col-md-8">
                                    <select name="transport_pulang" class="form-control">
                                        <?php
                                        echo "<option value='Ambulans'>Ambulans</option>";
                                        echo "<option value='Mobil Pribadi'>Mobil Pribadi</option>";
                                        echo "<option value='Motor'>Motor</option>";
                                        echo "<option value='Becak'>Becak</option>";
                                        echo "<option value='Lain-lain'>Lain-lain</option>";
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
                                <label class="col-md-4 control-label">Tanggal Kontrol</label>
                                <div class="col-md-5">
                                    <input type="text" name="tanggal_kontrol" readonly class="form-control" autocomplete="off">
                                </div>
                                <div class="col-md-3"><input type="text" name="jam_kontrol" class="form-control" autocomplete="off"></div>
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
                        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal_artikel no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Artikel</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-sm-12">
                                <select class="form-control" name='artikel'>
                                    <?php
                                    foreach ($artikel->result() as $row) {
                                        echo "<option value='" . $row->slug . "'>" . $row->title . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="pull-right">
                            <button class="send_artikel btn btn-success">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal-masuk-perawatan no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Berita Masuk Perawatan</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kepada</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="no_reg_masuk_perawatan">
                                    <input type="text" name="kepada_masuk_perawatan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="pull-right">
                            <button class="simpan_masuk_perawatan btn btn-success">Simpan</button>
                            <button class="send_masuk_perawatan btn btn-success">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal-tindakan-medis no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Tindakan Medis</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Pelaksana Tindakan</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="no_reg_tindakan">
                                    <select name="pelaksana_tindakan" class="form-control" style="width: 100%">
                                        <?php
                                        foreach ($dok->result() as $key) {
                                            echo "<option value=" . $key->id_dokter . ">" . $key->nama_dokter . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Pemberi Informasi</label>
                                <div class="col-md-8">
                                    <select name="pemberi_informasi" class="form-control" style="width: 100%">
                                        <?php
                                        foreach ($dp["dokter"] as $key => $value) {
                                            echo "<option value='dokter/" . $key . "'>" . $value . "</option>";
                                        }
                                        foreach ($dp["perawat"] as $key => $value) {
                                            echo "<option value='perawat/" . $key . "'>" . $value . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Perawat/ Bidan</label>
                                <div class="col-md-8">
                                    <select name="saksirs" class="form-control" style="width: 100%">
                                        <?php
                                        foreach ($dp["dokter"] as $key => $value) {
                                            echo "<option value='dokter/" . $key . "'>" . $value . "</option>";
                                        }
                                        foreach ($dp["perawat"] as $key => $value) {
                                            echo "<option value='perawat/" . $key . "'>" . $value . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tindakan Kedokteran</label>
                                <div class="col-md-1"><button class="selectall_tindakankedokteran btn btn-success btn-sm"><i class="fa fa-check"></i></button></div>
                                <div class="col-md-7">
                                    <select name="tindakan_kedokteran" class="form-control tindakan_kedokteran" multiple="multiple" style="width: 100%">
                                        <?php
                                        foreach ($tm->result() as $key) {
                                            echo "<option value=" . $key->id . ">" . $key->keterangan . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <span class='keterangan_kedokteran'></span>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tindakan Anestesi</label>
                                <div class="col-md-1"><button class="selectall_tindakananestesi btn btn-success btn-sm"><i class="fa fa-check"></i></button></div>
                                <div class="col-md-7">
                                    <select name="tindakan_anestesi" class="form-control tindakan_anestesi" multiple="multiple" style="width: 100%">
                                        <?php
                                        foreach ($tm->result() as $key) {
                                            echo "<option value=" . $key->id . ">" . $key->keterangan . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <span class='keterangan_anestesi'></span>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tindakan Transfusi</label>
                                <div class="col-md-1"><button class="selectall_tindakantransfusi btn btn-success btn-sm"><i class="fa fa-check"></i></button></div>
                                <div class="col-md-7">
                                    <select name="tindakan_transfusi" class="form-control tindakan_transfusi" multiple="multiple" style="width: 100%">
                                        <?php
                                        foreach ($tm->result() as $key) {
                                            echo "<option value=" . $key->id . ">" . $key->keterangan . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <span class='keterangan_transfusi'></span>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="pull-right">
                            <button class="simpan_tindakan btn btn-success">Simpan</button>
                            <button class="send_tindakan btn btn-success">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal-berita-lepas-perawatan no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Berita Lepas Perawatan</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kepada</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="no_reg_berita_lepas_perawatan">
                                    <input type="text" class="form-control" name="kepada_berita_lepas_perawatan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="pull-right">
                            <button class="simpan_berita_lepas_perawatan btn btn-success">Simpan</button>
                            <button class="send_berita_lepas_perawatan btn btn-success">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal-surat-istirahat-sakit no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Surat Istirahat Sakit</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Alamat yang dituju</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="no_reg_surat_istirahat_sakit">
                                    <input type="text" class="form-control" name="kepada_surat_istirahat_sakit">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Selama</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="selama_surat_istirahat_sakit" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mulai Tanggal</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="mulai_surat_istirahat_sakit">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">sampai Tanggal</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="sampai_surat_istirahat_sakit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="pull-right">
                            <button class="simpan_surat_istirahat_sakit btn btn-success">Simpan</button>
                            <button class="send_surat_istirahat_sakit btn btn-success">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal modal_formpulang no-print' role="dialog">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Perawat Ruangan</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password_formpulang" placeholder="Masukan password perawat ruangan" />
                                        <span class="input-group-btn">
                                            <button class="tmb_formpulang btn btn-success" type="button">Ok</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
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

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                margin-top: -15px;
            }

            .select2-container--default .select2-selection--single {
                padding: 16px 0px;
                border-color: #d2d6de;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #3c8dbc;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                color: #f4f4f4;
            }
        </style>
