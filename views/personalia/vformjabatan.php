<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('perawat/jabatan');?>/"+id_perawat;
            window.location = url;
            return false; 
        });
        var formattgl = "dd-mm-yy";
        $("[name='tmt'],[name='tgl_skep']").datepicker({
            dateFormat: formattgl,
        });
    });
</script>
<?php
if ($q) {
    $id             =$q->id;
    $id_perawat     =$q->id_perawat;
    $jabatan        =$q->jabatan;
    $tmt            =$q->tmt != "" ? date("d-m-Y", strtotime($q->tmt)) : "";
    $no_kep         =$q->no_kep;
    $tgl_skep       =$q->tgl_skep != "" ? date("d-m-Y", strtotime($q->tgl_skep)) : "";
    $r = "readonly";
    $aksi = "edit";
} else {
    $id=
    $jabatan=
    $tmt=
    $no_kep=
    $tgl_skep="";
    $r = "";
    $aksi = "simpan";
}
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open_multipart("perawat/simpanjabatan/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-10">
                  <input type="hidden" name="id_perawat" class="form-control" value="<?=$id_perawat;?>"  >
                  <input type="hidden" name="id" class="form-control" value="<?=$id;?>"  >
                  <select class="form-control" name="jabatan">
                    <?php 
                    foreach($jab as $row){
                      echo "<option value='".$row->kode_jabatan."' ".($row->keterangan==$jabatan ? "selected" : "").">".$row->keterangan."</option>";
                    }
                    ?>
                  </select> 
              </div>
            </div>
            <div class="form-group">
                  <label class="col-sm-2 control-label">TMT</label>
                  <div class="col-sm-5">
                    <input type="text" name="tmt" class="form-control" autocomplete="off" value="<?=$tmt;?>"  >
                  </div>
              </div>
            <div class="form-group">
                  <label class="col-sm-2 control-label">No Kep</label>
                  <div class="col-sm-5">
                    <input type="text" name="no_kep" class="form-control" value="<?=$no_kep;?>"  >
                  </div>
              </div>
            <div class="form-group">
                  <label class="col-sm-2 control-label">TGL Skep</label>
                  <div class="col-sm-5">
                    <input type="text" name="tgl_skep" class="form-control" autocomplete="off" value="<?=$tgl_skep;?>"  >
                  </div>
              </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">File Ijasah</label>
              <div class="col-sm-5">
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