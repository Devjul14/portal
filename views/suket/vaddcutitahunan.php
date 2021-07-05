<script src="<?php echo base_url() . 'assets/js/jquery-3.3.1.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<?php
if ($row) {
    $tanggal = $row->tanggal != "" ? date("d-m-Y", strtotime($row->tanggal)) : "";
    $nomor = $row->nomor;
    $tgl_berangkat = $row->tgl_berangkat != "" ? date("d-m-Y", strtotime($row->tgl_berangkat)) : "";
    $tgl_kembali = $row->tgl_kembali != "" ? date("d-m-Y", strtotime($row->tgl_kembali)) : "";
    $pangkat = $row->pangkat;
    $nrp = $row->nrp;
    $jabatan = $row->jabatan;
    $keperluan = $row->keperluan;
    $tujuan = $row->tujuan;
    $ket = $row->ket;
    $action = "edit";
} else {
    $tanggal = date("d-m-Y");
    $tgl_berangkat =
        $tgl_kembali =
        $nomor =
        $pangkat =
        $nrp =
        $jabatan =
        $keperluan =
        $tujuan =
        $ket = "";
    $hidden = "hidden";
    $action = "simpan";
}
?>
<script type="text/javascript">
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
        $("[name='tgl_kembali'],[name='tgl_berangkat']").datepicker({
            dateFormat: formattgl,
        });
        $("[name='nama']").select2();
        $("[name='nama']").change(function() {
            var nip = $(this).val();
            var jabatan = $('option:selected', this).attr("jabatan");
            var pangkat = $('option:selected', this).attr("pangkat");
            $("[name='nrp']").val(nip);
            $("[name='jabatan']").val(jabatan);
            $("[name='pangkat']").val(pangkat);
        })
        $("#nama").autocomplete({
            source: "<?php echo site_url('suket/getcutiperawat'); ?>"
        });

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
                    <?php echo form_open("suket/simpancutitahunan/" . $action, array("id" => "formsave", "class" => "form-horizontal"));
                    echo "<input type=hidden name='idlama' value='" . $id . "'>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nomor</label>
                        <div class="col-md-3">
                            <input type="hidden" class="form-control" required name="tanggal" autocomplete="off" value="<?php echo $tanggal; ?>">
                            <input type="text" class="form-control" readonly name="nomor" autocomplete="off" value="<?php echo $nomor; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama</label>
                        <div class="col-md-3">
                            <!-- <input type="text" id="nama" autocomplete="off" class="form-control" value="<?php echo $nama ?>"> -->
                            <select name="nama" class="form-control" value="<?php echo $nama; ?>"">
                                <option value="">--Pilih Perawat--</option>
                                <?php
                                foreach ($p->result() as $row) {
                                    echo "<option " . ($row->id_perawat == $nrp ? "selected" : "") . " value='" . $row->id_perawat . "' jabatan='" . $row->jabatan . "' pangkat='" . $row->pangkat . "'>" . $row->nama_perawat . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class=" form-group">
                                <label class="col-md-3 control-label">Pangkat</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" readonly name="pangkat" autocomplete="off" value="<?php echo $pangkat; ?>">
                                </div>
                                <label class="col-md-2 control-label">NRP / NIP / NRK</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" readonly name="nrp" autocomplete="off" value="<?php echo $nrp; ?>">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jabatan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" readonly name="jabatan" autocomplete="off" value="<?php echo $jabatan; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Keperluan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" required name="keperluan" autocomplete="off" value="<?php echo $keperluan; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tujuan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" required name="tujuan" autocomplete="off" value="<?php echo $tujuan; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tanggal Berangkat</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" required name="tgl_berangkat" autocomplete="off" value="<?php echo $tgl_berangkat; ?>">
                            </div>
                            <label class="col-md-2 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" required name="tgl_kembali" autocomplete="off" value="<?php echo $tgl_kembali; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Keterangan</label>
                            <div class="col-md-8">
                                <textarea type="text" class="form-control" required name="ket" autocomplete="off" value="<?php echo $ket; ?>"></textarea> 
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