<?php
if ($row) {
    $tanggal    = $row->tanggal != "" ? date("d-m-Y", strtotime($row->tanggal)) : "";
    $tgl_awal   = $row->tgl_awal != "" ? date("d-m-Y", strtotime($row->tgl_awal)) : "";
    $tgl_akhir  = $row->tgl_akhir != "" ? date("d-m-Y", strtotime($row->tgl_akhir)) : "";
    $no_surat   = $row->no_surat;
    $asal_surat = $row->asal_surat;
    $perihal    = $row->perihal;
    $ket        = $row->ket;
    $kepada     = $row->kepada;
    $action     = "edit";
} else {
    $tanggal  = date("d-m-Y");
    $tgl_awal =
    $tgl_akhir=
    $no_surat =
        $asal_surat     =
        $perihal        =
        $ket            =
        $kepada         = "";
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

        var formattgl = "dd-mm-yy";
        $("[name='tgl_awal'],[name='tgl_akhir']").datepicker({
            dateFormat: formattgl,
        });
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-horizontal">
                    <?php echo form_open_multipart("suket/simpanmou/" . $action, array("id" => "formsave", "class" => "form-horizontal"));
                    echo "<input type=hidden name='idlama' value='" . $id . "'>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. Surat</label>
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" readonly name="tanggal" value="<?php echo date("d-m-Y"); ?>">
                            <input type="text" class="form-control" required name="no_surat" value="<?php echo $no_surat; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Awal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" autocomplete="off" required name="tgl_awal" value="<?php echo $tgl_awal; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Akhir</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" autocomplete="off" required name="tgl_akhir" value="<?php echo $tgl_akhir; ?>">
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
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kepada</label>
                        <div class="col-md-9">
                            <textarea type="text" class="form-control" required name="kepada"><?php echo $kepada; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-9">
                            <textarea type="text" class="form-control" required name="ket"><?php echo $ket; ?></textarea>
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
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -15px;
    }

    .select2-container--default .select2-selection--single {
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>