<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('tarif/tarif_ambulance');?>";
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
        $kota   = $q->kota;
        $tarif  = $q->tarif;
        $r      = "readonly";
        $aksi   = "edit";
    } else {
        $kota   =
        $tarif  =
        $r      = "";
        $aksi   = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("tarif/simpan_tarifambulance/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Kode</label>
                   <div class="col-sm-10">
                        <input type="text" name="kode" class="form-control" autocomplete="off" value="<?=$kode;?>"  <?php echo $r ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kota</label>
                   <div class="col-sm-10">
                        <input type="text" name="kota" class="form-control" autocomplete="off" value="<?=$kota;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Tarif</label>
                   <div class="col-sm-10">
                        <input type="text" name="tarif" class="form-control" autocomplete="off" value="<?=$tarif;?>">
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