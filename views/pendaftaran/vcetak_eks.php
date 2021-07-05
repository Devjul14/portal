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
        var formattgl = "dd-mm-yy";
        $("[name='tgl1_print'],[name='tgl2_print']").datepicker({
            dateFormat : formattgl,
        });
        // $("select[name='tanggal_pemeriksaan']").change(function(){
        //     var no_reg = $("input[name='no_reg']").val();
        //     var no_pasien = $("input[name='no_pasien']").val();
        //     var t = $(this).val();
        //     window.location = "<?php echo site_url('pendaftaran/ekspertisi_inap');?>/"+no_pasien+"/"+no_reg+"/"+t;
        // });
        $('.cetak_covid').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var t = $("select[name='tanggal_pemeriksaan']").val();
            if (t==""){
                alert("Pilih tanggal pemeriksaan !!!");
            } else {
                // var url = "<?php echo site_url('lab/cetakcovid_inap');?>/"+no_reg+"/"+t;
                // openCenteredWindow(url);
                window.location = "<?php echo site_url('lab/cetakcovid_inap');?>/"+no_reg+"/"+t;
            }
            // $(".formcetak").modal("show");
        });
        $('.cetak_covid2').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var jenis_kelamin= $("[name='jenis_kelamin']").val();
            var t = $("select[name='tanggal_pemeriksaan']").val();
            if (t==""){
                alert("Pilih tanggal pemeriksaan !!!");
            } else {
                // var url = "<?php echo site_url('lab/cetakcovid_inap2');?>/"+no_reg+"/"+t+"/"+jenis_kelamin;
                // openCenteredWindow(url);
                window.location = "<?php echo site_url('lab/cetakcovid_inap2');?>/"+no_reg+"/"+t+"/"+jenis_kelamin;
            }
            // $(".formcetak").modal("show");
        });
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
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal Pemeriksaan</label>
                <div class="col-md-5">
                    <input type="hidden" class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    <input type="hidden" class="form-control" name='jenis_kelamin' readonly value="<?php echo $row['pasien']->jenis_kelamin;?>"/>
                    <input type="hidden" class="form-control" name='no_pasien' readonly value="<?php echo $row['pasien']->no_pasien;?>"/>
                    <!-- <input type="hidden" class="form-control" name='nama_pasien' readonly value="<?php echo $row['pasien']->nama_pasien;?>"/> -->
                    <select class="form-control"  name="tanggal_pemeriksaan">
                        <option value="">-----</option>
                        <?php
                            foreach ($ks->result() as $kas) {
                                echo "
                                    <option value='".$kas->tanggal."/".$kas->pemeriksaan."' ".($kas->pemeriksaan==$pemeriksaan && $kas->tanggal == $tgl ? "selected" : "")."> Tanggal : ".date('d-m-Y',strtotime($kas->tanggal))." || Pemeriksaan ke- ".$kas->pemeriksaan."</option>
                                ";

                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                        <button class="cetak_covid2 btn bg-maroon" type="button"><i class="fa fa-print"></i> Cetak Covid 2</button>
                        <button class="cetak_covid btn btn-danger" type="button"><i class="fa fa-print"></i> Cetak Covid</button>
                </div>        
            </div>
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
</style>