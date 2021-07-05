<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('inap');?>";
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
        $nama_kelas = $q->nama_kelas;
        $tarif = $q->tarif;
        $a = "readonly";
        $aksi = "edit";
    } else {
        $tarif =
        $a = 
        $nama_kelas ="";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
<!-- <button class="back btn btn-outline btn-primary  dim" type="button"><i class="fa fa-arrow-left"></i></button> -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <?php echo form_open("inap/simpankelas/".$aksi,array("class"=>"form-horizontal"));?>
                    <div class="form-group">
                        <label class="col-sm-2">Id Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" name="id_kelas" class="form-control" value="<?=$id_kelas;?>" <?=$a;?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Nama Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_kelas" class="form-control" value="<?=$nama_kelas;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tarif</label>
                        <div class="col-sm-10">
                            <input type="text" name="tarif" class="form-control" value="<?=$tarif;?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="back btn btn-white" type="reset">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                <?php echo form_close();?>            
            </div>
        </div>
    </div>
</div>