<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");

        $(".back").click(function(){
            window.location = "<?php echo site_url('pendaftaran/rawat_inap');?>";
        })
        $(".editinos").click(function(){
            var id = $(this).attr("href");
            // var no_pasien = $("[name='no_pasien']").val();
            // var no_reg = $("[name='no_reg']").val();
            window.location = "<?php echo site_url('pendaftaran/inos');?>/"+id;
            
        })
        $(".hapusinos").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('pendaftaran/hapusinos');?>/"+id;
        })
    });
    $(document).on('keyup keypress', "[name='kode_diagnosa']", function(e) {
        if(e.keyCode == 13) {
            e.preventDefault();
            $(".diagnosa").click();
            return false;
        }
    });
</script>
<?php
  if ($q2->num_rows()>0){
    $row = $q2->row();
    $nama_pasien  = $p->nama_pasien;
    $jenis_inos   = $row->jenis_inos;
    $spesialisasi = $row->spesialisasi;
    $pasien_tirah = $row->pasien_tirah;
    $oprasi       = $row->oprasi;
    $terpasang    = explode(",", $row->terpasang);
    $aksi = "edit";
  } else {
    $jenis_inos =
    $spesialisasi =
    $pasien_tirah =
    $oprasi =
    $terpasang = "";
    $aksi = "simpan";
  }
?>
<div class="col-md-12">
    <?php
        if($this->session->flashdata('message')){
            $pesan=explode('-', $this->session->flashdata('message'));
            echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>".$pesan[1]."</b>
            </div>";
        }

    ?>
    <div class="box box-primary">
        <div class="box-body">
            <?php
                echo form_open("pendaftaran/simpaninos/".$aksi, array("id"=>"formsave","class"=>"form-horizontal"));
            ?>
        	<div class="form-group">
            	<label class="col-md-2 control-label">No. Reg</label>
                <div class="col-md-2">
                    <input type="hidden" class="form-control" required name="kode_inos" readonly value="<?php echo $kode_inos;?>">
                    <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                </div>
                <label class="col-md-2 control-label">No. RM</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" required name="no_pasien" readonly value="<?php echo $id;?>">
                </div>
                <label class="col-md-2 control-label">Nama Pasien</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" required name="nama_pasien" readonly value="<?php echo $p->nama_pasien;?>"<?php echo $row->nama_pasien;?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Jenis INOS</label>
                <div class="col-md-4">
                    <select class="form-control" name="jenis_inos">
                        <?php
                            foreach ($q->result() as $val) {
                                echo "
                                    <option value='".$val->kode."'>".$val->keterangan."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2 control-label">Spesialisasi</label>
                <div class="col-md-4">
                    <select class="form-control" name="spesialisasi">
                        <?php
                            foreach ($s->result() as $sp) {
                                echo "
                                    <option value='".$sp->kode."'>".$sp->keterangan."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Pasien Tirah Baring</label>
                <div class="col-md-4">
                    <select class="form-control" name="pasien_tirah" style="width: 100%">
                        <option <?php echo $y ?> value="Ya">Ya</option>
                        <option <?php echo $t ?> value="Tidak">Tidak</option>
                    </select>
                </div>
                <label class="col-md-2 control-label">Pasien Yang Dioperasi</label>
                <div class="col-md-4">
                    <select class="form-control" name="oprasi" style="width: 100%">
                        <option <?php echo $y ?> value="Ya">Ya</option>
                        <option <?php echo $t ?> value="Tidak">Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Pasien Yang Terpasang</label>
                <div class="col-sm-6"><br>
                    <div class="form-check">
                        <input type="checkbox" name="terpasang1" value="INFUS" <?php echo (isset($terpasang[0]) && $terpasang[0] != "" ? "checked" : "");?>>
                        <label class="form-check-label">INFUS</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="terpasang2" value="CVC" <?php echo (isset($terpasang[1]) && $terpasang[1] != "" ? "checked" : "");?>>
                        <label class="form-check-label">CVC</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="terpasang3" value="UC" <?php echo (isset($terpasang[2]) && $terpasang[2] != "" ? "checked" : "");?>>
                        <label class="form-check-label">UC</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="terpasang4" value="VENTILATOR" <?php echo (isset($terpasang[3]) && $terpasang[3] != "" ? "checked" : "");?>>
                        <label class="form-check-label">VENTILATOR</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="terpasang5" value="NGT" <?php echo (isset($terpasang[4]) && $terpasang[4] != "" ? "checked" : "");?>>
                        <label class="form-check-label">NGT</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="terpasang6" value="OGT" <?php echo (isset($terpasang[5]) && $terpasang[5] != "" ? "checked" : "");?>>
                        <label class="form-check-label">OGT</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="back btn btn-danger" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table tab
            le-bordered table-hover table-bordered " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="50" style="vertical-align:middle" class='text-center' rowspan="2">No</th>
                        <th width="50" style="vertical-align:middle" class='text-center' rowspan="2">Jenis INOS</th>
                        <th width="50" style="vertical-align:middle" class="text-center" rowspan="2">Tanggal & Jam</th>
                        <th width="50" class="text-center" rowspan="2">Pasien Tirah Baring</th>
                        <th width="50" class="text-center" colspan="4">Pasien Yang Terpasang</th>
                        <th width="50" style="vertical-align:middle" class="text-center" rowspan="2">Pasien Yang Dioperasi</th>
                        <th width="50" style="vertical-align:middle" class="text-center" rowspan="2">#</th>
                    </tr>
                    <tr class='bg-navy'>
                        <th width="50" class='text-center'>INFUS</th>
                        <th width="50" class='text-center'>CVC</th>
                        <th width="50" class='text-center'>UC</th>
                        <th width="50" class='text-center'>VENTILATOR</th>
                    <tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    foreach ($q1->result() as $row1){
                    $terpasang = explode(",",$row1->terpasang);
                        $i++;
                        echo "<tr id=data>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row1->keterangan."</td>";
                        echo "<td>".$row1->tanggal."</td>";
                        echo "<td>".$row1->pasien_tirah."</td>";
                        echo "<td class='text-center'>".(isset($terpasang[0]) && $terpasang[0] != "" ? "<i class='fa fa-check-square' style='color:green' >" : "")."</i></td>";
                        echo "<td class='text-center'>".(isset($terpasang[1]) && $terpasang[1] != "" ? "<i class='fa fa-check-square' style='color:green'>" : "")."</i></td>";
                        echo "<td class='text-center'>".(isset($terpasang[2]) && $terpasang[2] != "" ? "<i class='fa fa-check-square' style='color:green'>" : "")."</i></td>";
                        echo "<td class='text-center'>".(isset($terpasang[3]) && $terpasang[3] != "" ? "<i class='fa fa-check-square' style='color:green'>" : "")."</i></td>";
                        echo "<td>".$row1->oprasi."</td>";
                        echo "<td class='text-center'><button href='".$row1->no_pasien."/".$row1->no_reg."/".$row1->kode_inos."' class='hapusinos btn btn-danger' type='button'><i class='fa fa-trash'></i></button>&nbsp;&nbsp;<button href='".$row1->no_pasien."/".$row1->no_reg."/".$row1->kode_inos."' class='editinos btn btn-warning' type='button'><i class='fa fa-edit'></i></button></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
        </div>
    </div>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #f4f4f4;
    }
    .select2 .select2-container .select2-container--default .select2-container--below .select2-container--open{
        width: 100%;
    }
</style>