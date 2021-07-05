<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('admindkk/layanan');?>";
            window.location = url;
            // alert(url);
            return false; 
        });
    });
</script>
<?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div>";
    }

?>
<?php
    if ($q) {
        $id_layanan=$q->id_layanan;
        $layanan=$q->layanan;
        $karcis=$q->karcis;
        $aksi = "edit";
    } else {
        $id_layanan=
        $layanan=
        $karcis="";
        $aksi = "simpan";
    }
?>
<!-- <button class="back btn btn-outline btn-primary  dim" type="button"><i class="fa fa-arrow-left"></i></button> -->
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("admindkk/simpanlayanan/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Layanan</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_layanan" class="form-control" value="<?=$layanan;?>">
                        <input type="hidden" name="idlama" value='<?=$id_layanan;?>'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Karcis</label>
                    <div class="col-sm-10">
                        <input type="text" name="karcis" class="form-control" value="<?=$karcis;?>">
                    </div>
                </div>           
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="back btn btn-warning" type="reset">Batal</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                <?php echo form_close();?> 
            </div>
        </div>
    </div>