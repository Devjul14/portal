<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('tarif/tarif_penunjangmedis');?>";
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
        $ket      = $q->ket;
        $tarif    = $q->tarif;
        $rs       = $q->rs;
        $dr       = $q->dr;
        $pt       = $q->pt;
        $st       = $q->st;
        $bb       = $q->bb;
        $r      = "readonly";
        $aksi   = "edit";
    } else {
        $ket   =
        $tarif  =
        $rs =
        $dr =
        $pt =
        $st =
        $bb =
        $r      = "";
        $aksi   = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("tarif/simpan_tarifpenunjangmedis/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Kode</label>
                   <div class="col-sm-10">
                        <input type="text" name="kode" class="form-control" autocomplete="off" value="<?=$kode;?>"  <?php echo $r ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Keterangan</label>
                   <div class="col-sm-10">
                        <input type="text" name="ket" class="form-control" autocomplete="off" value="<?=$ket;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Tarif</label>
                   <div class="col-sm-4">
                        <input type="text" name="tarif" class="form-control" autocomplete="off" value="<?=$tarif;?>">
                    </div>
                    <label class="col-sm-2 control-label">RS</label>
                   <div class="col-sm-4">
                        <input type="text" name="rs" class="form-control" autocomplete="off" value="<?=$rs;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">DR</label>
                   <div class="col-sm-4">
                        <input type="text" name="dr" class="form-control" autocomplete="off" value="<?=$dr;?>">
                    </div>
                    <label class="col-sm-2 control-label">PT</label>
                   <div class="col-sm-4">
                        <input type="text" name="pt" class="form-control" autocomplete="off" value="<?=$pt;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">ST</label>
                   <div class="col-sm-4">
                        <input type="text" name="st" class="form-control" autocomplete="off" value="<?=$st;?>">
                    </div>
                    <label class="col-sm-2 control-label">BB</label>
                   <div class="col-sm-4">
                        <input type="text" name="bb" class="form-control" autocomplete="off" value="<?=$bb;?>">
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