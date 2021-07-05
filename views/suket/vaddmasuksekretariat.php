<?php
if ($row) {
    $tanggal = $row->tanggal != "" ? date("d-m-Y", strtotime($row->tanggal)) : "";
    $no_agenda_surat = $row->no_agenda_surat;
    $tanggal_surat = $row->tanggal_surat != "" ? date("d-m-Y", strtotime($row->tanggal_surat)) : "";
    $lampiran = $row->lampiran;
    $pengirim = $row->pengirim;
    $perihal = $row->perihal;
    $disposisi = $row->disposisi;
    $action = "edit";
} else {
    $tanggal = date("d-m-Y");
    $tanggal_surat =
        $no_agenda_surat =
        $lampiran =
        $pengirim =
        $perihal =
        $disposisi = "";
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
        var formattgl = "dd-mm-yy";
        $("[name='tanggal'],[name='tanggal_surat']").datepicker({
            dateFormat: formattgl,
        });
        $(".cetak").click(function() {
            var no_pasien = $("input[name='no_pasien']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_rekmed'); ?>/" + no_pasien;
            openCenteredWindow(url)
        })
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
                    <?php echo form_open("suket/simpansuratmasuksekretariat/" . $action, array("id" => "formsave", "class" => "form-horizontal"));
                    echo "<input type=hidden name='idlama' value='" . $id . "'>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="tanggal" autocomplete="off" value="<?php echo $tanggal; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No Agenda Surat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="no_agenda_surat" autocomplete="off" value="<?php echo $no_agenda_surat; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Masuk Surat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="tanggal_surat" autocomplete="off" value="<?php echo $tanggal_surat; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lampiran</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="lampiran" autocomplete="off" value="<?php echo $lampiran; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pengirim</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="pengirim" autocomplete="off" value="<?php echo $pengirim; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Perihal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="perihal" autocomplete="off" value="<?php echo $perihal; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Disposisi</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="disposisi" autocomplete="off" value="<?php echo $disposisi; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Upload Dokumen</label>
                        <div class="col-sm-9">
                            <div id="file-image">
                                <div class="input-group">
                                    <input type="hidden" name="source_foto">
                                    <input type="text" name="tempfoto" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <span class="btn btn-warning btn-file"><i class="fa fa-folder-open"></i><input type="file" name="foto" id="foto" class="form-control"></span>
                                    </span>
                                </div>
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
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -15px;
    }

    .select2-container--default .select2-selection--single {
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>