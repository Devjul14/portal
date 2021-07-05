<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('tarif/tarif_lab');?>";
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
        // $kode_tindakan   = $q->$kode_tindakan;
        $nama_tindakan   = $q->nama_tindakan;
        $reguler         = $q->reguler;
        $executive       = $q->executive;
        $supervip        = $q->supervip;
        $vip             = $q->vip;
        $kelas_1         = $q->kelas_1;
        $kelas_2         = $q->kelas_2;
        $kelas_3         = $q->kelas_3;
        $icu             = $q->icu;
        $r      = "readonly";
        $aksi   = "edit";
    } else {
        // $kode_tindakan   =
        $nama_tindakan   =
        $reguler  =
        $executive =
        $supervip =
        $vip =
        $kelas_1 =
        $kelas_2 =
        $kelas_3 =
        $icu =
        $r      = "";
        $aksi   = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("tarif/simpan_tariflab/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Kode</label>
                   <div class="col-sm-10">
                   <!-- <input type="text" name="id_tindakan" class="form-control" autocomplete="off" value="<?=$id_tindakan;?>" > -->
                        <input type="text" name="kode_tindakan" class="form-control" autocomplete="off" value="<?=$kode_tindakan;?>" <?php echo $r ?>>
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
                        <input type="text" name="reguler" class="form-control" autocomplete="off" value="<?=$reguler;?>">
                    </div>
                    <label class="col-sm-2 control-label">Executive</label>
                   <div class="col-sm-4">
                        <input type="text" name="executive" class="form-control" autocomplete="off" value="<?=$executive;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Super VIP</label>
                   <div class="col-sm-4">
                        <input type="text" name="supervip" class="form-control" autocomplete="off" value="<?=$supervip;?>">
                    </div>
                    <label class="col-sm-2 control-label">VIP</label>
                   <div class="col-sm-4">
                        <input type="text" name="vip" class="form-control" autocomplete="off" value="<?=$vip;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Kelas 1</label>
                   <div class="col-sm-4">
                        <input type="text" name="kelas_1" class="form-control" autocomplete="off" value="<?=$kelas_1;?>">
                    </div>
                    <label class="col-sm-2 control-label">Kelas 2</label>
                   <div class="col-sm-4">
                        <input type="text" name="kelas_2" class="form-control" autocomplete="off" value="<?=$kelas_2;?>">
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Kelas 3</label>
                   <div class="col-sm-4">
                        <input type="text" name="kelas_3" class="form-control" autocomplete="off" value="<?=$kelas_3;?>">
                    </div>
                    <label class="col-sm-2 control-label">ICU</label>
                   <div class="col-sm-4">
                        <input type="text" name="icu" class="form-control" autocomplete="off" value="<?=$icu;?>">
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