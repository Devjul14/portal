<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('tarif/tarif_inap');?>";
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
        $nama_tindakan  = $q->nama_tindakan;
        $kelas1         = $q->kelas1;
        $kelas2         = $q->kelas2;
        $kelas3         = $q->kelas3;
        $vip3           = $q->vip3;
        $vip2           = $q->vip2;
        $vip1           = $q->vip1;
        $vip            = $q->vip;
        $vip_deluxe     = $q->vip_deluxe;
        $vip_premium    = $q->vip_premium;
        $vip_executive  = $q->vip_executive;
        $icu            = $q->icu;
        $nicu           = $q->nicu;
        $bayi           = $q->bayi;
        $isolasi        = $q->isolasi;
        $r      = "readonly";
        $aksi   = "edit";
    } else {
        $nama_tindakan   =
        $kelas1 =
        $kelas2 =
        $kelas3 =
        $vip3 =
        $vip2 =
        $vip1 =
        $vip =
        $vip_deluxe =
        $vip_executive =
        $vip_premium =
        $icu =
        $nicu =
        $bayi =
        $isolasi =
        $r      = "";
        $aksi   = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("tarif/simpan_tarifinap/".$aksi,array("class"=>"form-horizontal"));?>
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
                    <label class="col-sm-2 control-label">Kelas 1</label>
                   <div class="col-sm-4">
                        <input type="text" name="kelas1" class="form-control" autocomplete="off" value="<?=$kelas1;?>">
                    </div>
                    <label class="col-sm-2 control-label">Kelas 2</label>
                   <div class="col-sm-4">
                        <input type="text" name="kelas2" class="form-control" autocomplete="off" value="<?=$kelas2;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Kelas 3</label>
                   <div class="col-sm-4">
                        <input type="text" name="kelas3" class="form-control" autocomplete="off" value="<?=$kelas3;?>">
                    </div>
                    <label class="col-sm-2 control-label">VIP</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip" class="form-control" autocomplete="off" value="<?=$vip;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">VIP 3</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip3" class="form-control" autocomplete="off" value="<?=$vip3;?>">
                    </div>
                    <label class="col-sm-2 control-label">VIP 2</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip2" class="form-control" autocomplete="off" value="<?=$vip2;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">VIP 1</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip1" class="form-control" autocomplete="off" value="<?=$vip1;?>">
                    </div>
                    <label class="col-sm-2 control-label">VIP Deluxe</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip_deluxe" class="form-control" autocomplete="off" value="<?=$vip_deluxe;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">VIP Premium</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip_premium" class="form-control" autocomplete="off" value="<?=$vip_premium;?>">
                    </div>
                    <label class="col-sm-2 control-label">VIP Executive</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip_executive" class="form-control" autocomplete="off" value="<?=$vip_executive;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">ICU</label>
                   <div class="col-sm-4">
                        <input type="text" name="icu" class="form-control" autocomplete="off" value="<?=$icu;?>">
                    </div>
                    <label class="col-sm-2 control-label">Nicu</label>
                   <div class="col-sm-4">
                        <input type="text" name="nicu" class="form-control" autocomplete="off" value="<?=$nicu;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Bayi</label>
                   <div class="col-sm-4">
                        <input type="text" name="bayi" class="form-control" autocomplete="off" value="<?=$bayi;?>">
                    </div>
                    <label class="col-sm-2 control-label">Isolasi</label>
                   <div class="col-sm-4">
                        <input type="text" name="isolasi" class="form-control" autocomplete="off" value="<?=$isolasi;?>">
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