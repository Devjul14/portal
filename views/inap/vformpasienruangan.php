<!-- <script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('inap');?>";
            window.location = url;
            // alert(url);
            return false; 
        });
    });
</script> -->
<?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div>";
    }

?>
<!-- <button class="back btn btn-outline btn-primary  dim" type="button"><i class="fa fa-arrow-left"></i></button> -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <?php echo form_open("inap/simpanpasienruangan/",array("class"=>"form-horizontal"));?>
                    <div class="form-group">
                        <label class="col-sm-2">Kelas</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id_kelas" class="form-control" value="<?=$id_kelas;?>">
                            <input type="text" name="nama_kelas" class="form-control" value="<?=$nama_kelas;?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Ruangan</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id_ruangan" class="form-control" value="<?=$id_ruangan;?>">
                            <input type="text" name="nama_ruangan" class="form-control" value="<?=$nama_ruangan;?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Pasien</label>
                        <div class="col-sm-10">
                            <select name="pasien" class="form-control">
                                <?php  
                                    foreach ($q->result() as $val) {
                                        echo "
                                            <option value='".$val->id."'>".$val->nama."</option>
                                        ";
                                    }
                                ?>
                            </select>
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