<?php
if ($row) {
    $tanggal = $row->tanggal != "" ? date("d-m-Y", strtotime($row->tanggal)) : "";
    $no_sprint = $row->no_sprint;
    $nama = $row->nama;
    $nrp = $row->nrp;
    $pangkat = $row->pangkat;
    $jabatan_baru = $row->jabatan_baru;
    $jabatan_lama = $row->jabatan_lama;
    $tmt = $row->tmt != "" ? date("d-m-Y", strtotime($row->tmt)) : "";
    $action = "edit";
} else {
    $tanggal = date("d-m-Y");
    $no_sprint =
        $nama =
        $nrp =
        $pangkat =
        $jabatan_baru =
        $jabatan_lama =
        $tmt =        "";
    $hidden = "hidden";
    $action = "simpan";
}
?>
<script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
<script>
    $(document).ready(function() {
        $("[name='nama'],[name='lama'],[name='baru']").select2();
        $("[name='nama']").change(function() {
            var nip = $(this).val();
            var pangkat = $('option:selected', this).attr("pangkat");
            $("[name='nrp']").val(nip);
            $("[name='pangkat']").val(pangkat);
        })
    });
</script>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <?php echo form_open("suket/addlampiran_sprint/" . $action, array("id" => "formsave", "class" => "form-horizontal"));
                echo "<input type=hidden name='idlama' value='" . $id . "'>";
                ?>
                <table class="table table-bordered table-hover " id="myTable">
                    <thead>
                        <tr class="bg-navy">
                            <th class='text-center'>No Sprint</th>
                            <th class="text-center">Nama</th>
                            <th width=100 class="text-center">Pangkat/Gol</th>
                            <th class="text-center" width="100">NRP/NIP</th>
                            <th class="text-center">Jabatan Lama</th>
                            <th class="text-center">Jabatan Baru</th>
                            <th class="text-center">TMT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <input type="hidden" class="form-control" name="tanggal" readonly value="<?php echo $row->tanggal; ?>">
                            <td><input class="form-control" name="no_sprint" readonly value="<?php echo $row->no_sprint; ?>"></td>
                            <td>
                                <select name="nama" class="form-control" value="<?php echo $row->nama; ?>">
                                    <option value="">--Pilih Perawat--</option>
                                    <?php
                                    foreach ($p->result() as $row) {
                                        echo "<option " . ($row->id_perawat == $nrp ? "selected" : "") . " value='" . $row->id_perawat . "' pangkat='" . $row->pangkat . "'>" . $row->nama_perawat . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input class="form-control" name="pangkat" readonly value="<?php echo $row->pangkat; ?>"></td>
                            <td><input class="form-control" name="nrp" readonly value="<?php echo $row->nrp; ?>"></td>
                            <td>
                                <select name="lama" class="form-control" value="<?php echo $row->jabatan_lama; ?>">
                                    <option value="">---Pilih---</option>
                                    <?php
                                    foreach ($j->result() as $row) {
                                        echo "<option " . ($row->kode_jabatan) . " value='" . $row->kode_jabatan . "'>" . $row->nama_jabatan . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="baru" class="form-control" value="<?php echo $row->$jabatan_baru; ?>">
                                    <option value="">---Pilih---</option>
                                    <?php
                                    foreach ($j->result() as $row) {
                                        echo "<option " . ($row->kode_jabatan) . " value='" . $row->kode_jabatan . "'>" . $row->nama_jabatan . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input class="form-control" name="tmt" readonly value="<?php echo date("d-m-Y", strtotime($row->tmt)); ?>"></td>
                        </tr>
                    </tbody>
                </table>
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

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #3c8dbc;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                color: #f4f4f4;
            }
        </style>