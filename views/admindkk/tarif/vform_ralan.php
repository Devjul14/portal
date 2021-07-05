<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('tarif/tarif_ralan');?>";
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
        $nama_tindakan   = $q->nama_tindakan;
        $reguler         = $q->reguler;
        $executive       = $q->executive;
        $r      = "readonly";
        $aksi   = "edit";
    } else {
        $nama_tindakan   =
        $reguler  =
        $executive =
        $r      = "";
        $aksi   = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("tarif/simpan_tarifralan/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Kode</label>
                   <div class="col-sm-10">
                        <input type="text" name="kode_tindakan" class="form-control" autocomplete="off" value="<?=$kode_tindakan;?>"  <?php echo $r ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Tindakan</label>
                   <div class="col-sm-10">
                        <input type="text" name="nama_tindakan" class="form-control" autocomplete="off" value="<?=$nama_tindakan;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Reguler</label>
                   <div class="col-sm-4">
                        <input type="text" name="reguler" class="form-control" autocomplete="off" value="<?$reguler;?>">
                    </div>
                    <label class="col-sm-2 control-label">Executive</label>
                   <div class="col-sm-4">
                        <input type="text" name="executive" class="form-control" autocomplete="off" value="<?$executive;?>">
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