<script>
    $(document).ready(function(){
        $(".back").click(function(){
            window.location = "<?php echo site_url('retensi')?>";
            return false;
        });
    });
</script>
<div class="col-md-12">
    <?php 
        if($this->session->flashdata('message')){
            $pesan=explode('|', $this->session->flashdata('message'));
            echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b style='font-size:25px'>".$pesan[1]."</b>
            </div>";
        }
    ?>
<div class="col-md-12">
    <div class="row">
        <div class="box box-primary">
            <?php echo form_open_multipart("retensi/simpanupload");?>
            <div class="box-body">
                <div class="form-horizontal">
                    <input type="hidden" name="no_retensi" value="<?php echo $no_retensi;?>">
                    <input type="hidden" name="no_pasien" value="<?php echo $no_pasien;?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="file" class="form-control" name="file_retensi">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary" type="submit">
                    Upload
                </button>
                <div class="pull-right">
                    <button class="back btn btn-danger">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>