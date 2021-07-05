<script>
    $(document).ready(function() {
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
        $(".nama").select2({
          placeholder: "Nama Perawat",
          allowClear: true
        });
        
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
        $(".cetak").click(function() {
            var no_sprint = "<?php echo $no_sprint; ?>";
            var url = "<?php echo site_url('suket/cetakkegiatan'); ?>/" + no_sprint;
            openCenteredWindow(url);
            return false;
        });
        $(".lampiran").click(function() {
            var no_sprint = "<?php echo $no_sprint; ?>";
            var url = "<?php echo site_url('suket/cetaklampiran_kegiatan'); ?>/" + no_sprint;
            openCenteredWindow(url);
            return false;
        });
    });
</script>
<?php
if ($row->num_rows() > 0) {
    $row1           = $row->row();
    $no_sprint      = $row1->no_sprint;
    $nrp            = $row1->nrp;
    $tim            = $row1->$tim;
    $action = "edit";
} else { 
    $nrp =
    $tim = "";
    $action = "simpan";
}
?>
<div class="col-md-12">
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
                        <th width="10" class='text-center'>No Sprint</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NRP</th>
                        <th class="text-center">Pangkat</th>
                        <th class="text-center">Jabatan </th>
                        <th class='text-center'>TIM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($row->result() as $row) {
                        echo "<tr id=data no_sprint='" . $row->no_sprint . "' tmt='" . date("d/m/Y", strtotime($row->tmt)) . "' nrp='" . $row->nrp . "'>";
                        echo "<td class='text-center'>" . $row->no_sprint . "</td>";
                        echo "<td class='text-center'>" . $row->nama . "</td>";
                        echo "<td class='text-center'>" . $row->nrp . "</td>";
                        echo "<td class='text-center'>" . $row->pangkat . "</td>";
                        echo "<td class='text-center'>" . $row->jabatan . "</td>";
                        echo "<td class='text-center'>" . $row->tim . "</td>"; 
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center" colspan="7">
                            <?php echo form_open("suket/addkegiatan/" . $action, array("id" => "formsave", "class" => "form-horizontal")); ?>
                            <input type="hidden" name='no_sprint' readonly value="<?php echo $no_sprint; ?>" />

                            <div class="row">
                                <div class="col-md-2">
                                    <select class="form-control nama" name="nrp">
                                        <option value=""></option>
                                        <?php
                                        foreach ($p->result() as $key) {
                                            echo '<option value="' . $key->id_perawat . '">' . $key->nama_perawat . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text-center" name="tim" placeholder="          Ketik TIM">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="cetak btn btn-warning" type="button"><i class="fa fa-print"></i> Cetak</button>
                        <button class="lampiran btn bg-purple" type="button"><i class="fa fa-print"></i> Lampiran</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>