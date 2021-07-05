<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var id_perawat = $("[name='id_perawat']").val();
            var url = "<?php echo site_url('perawat/militer');?>/"+id_perawat;
            window.location = url;
            return false; 
        });
        var formattgl = "dd-mm-yy";
        $("[name='tanggal']").datepicker({
            dateFormat: formattgl,
        });
    });
</script>
<?php
if ($q) {
    $id             =$q->id;
    $id_perawat     =$q->id_perawat;
    $id_militer     =$q->id_militer;
    $nomor          =$q->nomor;
    $tanggal        = $q->tanggal != "" ? date("d-m-Y", strtotime($q->tanggal)) : "";
    $tahun          =$q->tahun;
    $filepdf        =$q->filepdf;
    $r = "readonly";
    $aksi = "edit";
} else {
    $id=
    $id_militer=
    $nomor=
    $tahun=
    $filepdf=
    $tanggal="";
    $r = "";
    $aksi = "simpan";
}
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open_multipart("perawat/simpanmiliter/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Pendidikan Militer</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_militer">
                  <?php 
                  foreach($m as $row){
                    echo "<option value='".$row->id_militer."' ".($row->id_militer==$id_militer ? "selected" : "").">".$row->keterangan."</option>";
                  }
                  ?>
                  </select> 
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nomor</label>
                <div class="col-sm-3">
                    <input type="hidden" name="id_perawat" class="form-control" value="<?=$id_perawat;?>"  >
                    <input type="hidden" name="id" class="form-control" value="<?=$id;?>"  >
                    <input type="text" name="nomor" class="form-control" value="<?=$nomor;?>"  >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                    <input type="text" name="tanggal" class="form-control" autocomplete="off" value="<?=$tanggal;?>"  >
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
           <div class="form-group">
            <label class="col-sm-2 control-label">Upload File</label>
            <div class="col-sm-3">
              <div id="file-image">
                <div class="input-group">
                  <input type="hidden" name="source_foto">
                  <input type="text" name="tempfoto" class="form-control" readonly value="<?php echo $filepdf; ?>">
                  <span class="input-group-btn">
                    <?php if ($filepdf != "") : ?>
                      <span class="view btn btn-success" href='<?php echo base_url() . "file_pdf/suket/" . $filepdf; ?>'><i class="fa fa-search"></i></span>
                    <?php endif ?>
                    <span class="btn btn-warning btn-file"><i class="fa fa-folder-open"></i><input type="file" name="filepdf" accept="application/pdf,application/jpg,application/png"></span>
                  </span>
                </div>
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