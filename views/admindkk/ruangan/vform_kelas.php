<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('ruangan/kelas');?>";
            window.location = url;
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
        $nama_kelas=$q->nama_kelas;
        $r = "readonly";
        $aksi = "edit";
    } else {
        $nama_kelas=
        $r = "";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("ruangan/simpankelas/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Kode Kelas</label>
                   <div class="col-sm-10">
                        <input type="text" name="kode_kelas" class="form-control" value="<?=$kode_kelas;?>"  <?php echo $r ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Kelas</label>
                   <div class="col-sm-10">
                        <input type="text" name="nama_kelas" class="form-control" value="<?=$nama_kelas;?>">
                    </div>
               </div>
           </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                         <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        <button class="back btn btn-warning" type="reset">Batal</button>
                       
                    </div>
                </div>
                <?php echo form_close();?> 
            </div>
        </div>
    </div>  