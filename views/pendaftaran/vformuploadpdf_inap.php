
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

    });
</script>
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
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open_multipart("pendaftaran/uploadpdf_inap",array("id"=>"formsave","class"=>"form-horizontal")) ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Jenis File</label>
                        <div class="col-md-10">
                            <select class="form-control" name="jenisfile">
                                <?php
                                    foreach ($j->result() as $key) {
                                        echo "<option value='".$key->nama."'>".$key->nama."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">File PDF</label>
                        <div class="col-md-10">
                            <input type="hidden" name="no_reg" value="<?php echo $no_reg ?>">
                            <input type="hidden" name="no_pasien" value="<?php echo $no_pasien ?>">
                            <input type="file" name="pdf_inap" accept="application/pdf,application/jpg">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button class="btn btn-primary" type="submit">Upload</button>
                            </div>
                        </div>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-hover " id="myTable" >
                    <thead>
                        <tr class="bg-navy">
                            <th width="10" class='text-center'>No</th>
                            <th class="text-center">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach($q->result() as $val){
                                $i++;
                                echo "<tr id='data' title=''>";
                                echo "<td>".$i."</td>";
                                echo "<td><a href='".base_url()."file_pdf/inap/".$val->file_pdf."' target='blank'>".$val->file_pdf."</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>