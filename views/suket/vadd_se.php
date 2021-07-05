<?php
if ($row) {
    $tanggal    = $row->tanggal != "" ? date("d-m-Y", strtotime($row->tanggal)) : "";
    $no_surat   = $row->no_surat;
    $asal_surat = $row->asal_surat;
    $uraian     = $row->uraian;
    $ket        = $row->ket;
    $action     = "edit";
} else {
    $tanggal  = date("d-m-Y");
    $no_surat =
    $uraian   =
    $asal_surat     =
    $ket            ="";
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
    
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-horizontal">
                    <?php echo form_open_multipart("suket/simpan_se/" . $action, array("id" => "formsave", "class" => "form-horizontal"));
                    echo "<input type=hidden name='idlama' value='" . $id . "'>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" readonly name="tanggal" value="<?php echo date("d-m-Y"); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. Surat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="no_surat" value="<?php echo $no_surat; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Asal Surat</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="asal_surat" value="<?php echo $asal_surat; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Uraian</label>
                        <div class="col-md-9">
                            <textarea type="text" class="form-control" required name="uraian"><?php echo $uraian; ?></textarea>
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