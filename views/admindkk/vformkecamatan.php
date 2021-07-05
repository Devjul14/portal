<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('admindkk/kecamatan');?>";
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
        $nama_kecamatan = $q->nama_kecamatan;
        $aksi = "edit";
    } else {
        $nama_kecamatan ="";
        $aksi = "simpan";
    }
    // echo $aksi;
?>

    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("admindkk/simpankecamatan/".$aksi,array("class"=>"form-horizontal"));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_kecamatan" class="form-control" value="<?=$nama_kecamatan;?>">
                            <input type="hidden" name="idlama" value='<?=$id;?>'>
                        </div>
                    </div>           
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="back btn btn-warning" type="reset">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
                <?php echo form_close();?> 
            </div>
        </div>
    </div>