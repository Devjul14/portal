<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('perawat/penugasan');?>/"+id_perawat;
            window.location = url;
            return false; 
        });
    });
</script>
<?php
if ($q) {
    $id             =$q->id;
    $id_perawat     =$q->id_perawat;
    $id_provinsi    =$q->id_provinsi;
    $id_kota        =$q->id_kota;
    $uraian        = $q->uraian;
    $tahun          =$q->tahun;
    $r = "readonly";
    $aksi = "edit";
} else {
    $id=
    $id_provinsi=
    $id_kota=
    $tahun=
    $uraian="";
    $r = "";
    $aksi = "simpan";
}
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open_multipart("perawat/simpanpenugasan/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Provinsi</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_provinsi">
                  <?php foreach($p as $row){
                  echo '<option value="'. $row->id.'">'.$row->name.'</option>';
                  }?>
                  </select> 
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kota</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_kota">
                  <?php foreach($k as $row){
                  echo '<option value="'. $row->id.'">'.$row->name.'</option>';
                  }?>
                  </select> 
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Uraian</label>
                <div class="col-sm-3">
                    <input type="hidden" name="id_perawat" class="form-control" value="<?=$id_perawat;?>"  >
                    <input type="hidden" name="id" class="form-control" value="<?=$id;?>"  >
                    <textarea type="text" name="uraian" class="form-control" autocomplete="off" value="<?=$uraian;?>"><?=$uraian;?></textarea>
                </div>
              <label class="col-sm-2 control-label">Tahun</label>
                <div class="col-sm-3">
                <select name="tahun" class="form-control" value="<?=$tahun;?>">
                     <?php
                         for ($tahun=date("Y"); $tahun >=date("Y")-30 ; $tahun--) {
                           echo "<option value='".$tahun."'>".$tahun."</option>";
                        }
                      ?>
                </select>
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
      <style type="text/css">
        .btn.btn-file-photo > input[type='file'] {
          position: absolute;
          top: 0;
          right: 0;
          min-width: 100%;
          min-height: 100%;
          font-size: 100px;
          text-align: right;
          opacity: 0;
          filter: alpha(opacity=0);
          outline: none;
          background: white;
          cursor: inherit;
          display: block;
        }
      </style>