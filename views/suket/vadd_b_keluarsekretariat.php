<?php
if ($row) {
    $tanggal = $row->tanggal != "" ? date("d-m-Y", strtotime($row->tanggal)) : "";
    $no_b_keluar = $row->no_b_keluar;
    $kepada = $row->kepada;
    $asal_surat = $row->asal_surat;
    $perihal = $row->perihal;
    $lampiran = $row->lampiran;
    $filepdf = $row->filepdf;
    $action = "edit";
} else {
    $tanggal = date("d-m-Y");
    $no_b_keluar =
        $kepada =
        $asal_surat =
        $perihal =
        $filepdf =
        $lampiran = "";
    $hidden = "hidden";
    $action = "simpan";
}
?>
<script>
    var mywindow;

    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth / 2) - (width / 2));
        var top = parseInt((screen.availHeight / 2) - (height / 2));
        var windowFeatures = "width=" + width + ",height=" + height +
            ",status,resizable,left=" + left + ",top=" + top +
            ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function() {
        $(".cari_no").click(function() {
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $(".tmb_cari_no").click(function() {
            pencarian();
            return false;
        });
        $(".view").click(function() {
            var url = $(this).attr("href");
            openCenteredWindow(url)
        })
        var formattgl = "dd-mm-yy";
        $("[name='tanggal'],[name='tanggal_surat']").datepicker({
            dateFormat: formattgl,
        });
        $(".cetak").click(function() {
            var no_pasien = $("input[name='no_pasien']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_rekmed'); ?>/" + no_pasien;
            openCenteredWindow(url)
        });
        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }
        });
    });
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <?php if (strlen($id) > 6) : ?>
            <div class="box-header">
                <button class="cari_no btn btn-sm btn-primary" type="button"><i class="fa fa-search"></i> Cari</button>
            </div>
        <?php endif ?>
        <div class="box-body">
            <div class="col-md-12">
                <div class="form-horizontal">
                    <?php echo form_open_multipart("suket/simpansurat_b_keluarsekretariat/" . $action, array("id" => "formsave", "class" => "form-horizontal"));
                    echo "<input type=hidden name='idlama' value='" . $id . "'>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="tanggal" value="<?php echo $tanggal; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. B Keluar</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="no_b_keluar" value="<?php echo $no_b_keluar; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kepada</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="kepada" value="<?php echo $kepada; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Asal Surat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="asal_surat" value="<?php echo $asal_surat; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Perihal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="perihal" value="<?php echo $perihal; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lampiran</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="lampiran" value="<?php echo $lampiran; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Upload Dokumen</label>
                        <div class="col-sm-9">
                            <div id="file-image">
                                <div class="input-group">
                                    <input type="hidden" name="source_foto">
                                    <input type="text" name="tempfoto" class="form-control" readonly value="<?php echo $filepdf; ?>">
                                    <span class="input-group-btn">
                                        <?php if ($filepdf != "") : ?>
                                            <span class="view btn btn-success" href='<?php echo base_url() . "file_pdf/suket/" . $filepdf; ?>'><i class="fa fa-search"></i></span>
                                        <?php endif ?>
                                        <span class="btn btn-warning btn-file"><i class="fa fa-folder-open"></i><input type="file" name="filepdf" accept="application/pdf,application/jpg,application/png"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -15px;
    }

    .select2-container--default .select2-selection--single {
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>