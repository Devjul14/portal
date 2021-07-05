<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('perawat/kursus');?>/"+id_perawat;
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
    $penilai        =$q->penilai;
    $atasan         =$q->atasan;
    $nilai          =$q->nilai;
    $orientasi      =$q->orientasi;
    $integritas     =$q->integritas;
    $komitmen       =$q->komitmen;
    $disiplin       =$q->disiplin;
    $kerjasama      =$q->kerjasama;
    $kepemimpinan   =$q->kepemimpinan;
    $tahun          =$q->tahun;
    $filepdf          =$q->filepdf;
    $r = "readonly";
    $aksi = "edit";
} else {
    $id=
    $penilai=
    $atasan=
    $tahun=
    $nilai=
    $orientasi=
    $integritas=
    $disiplin=
    $kerjasama=
    $kepemimpinan=
    $filepdf=
    $komitmen="";
    $r = "";
    $aksi = "simpan";
}
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open_multipart("perawat/simpanskp/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
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
              <label class="col-sm-2 control-label">Pejabat Penilai</label>
                <div class="col-sm-3">
                    <input type="hidden" name="id_perawat" class="form-control" value="<?=$id_perawat;?>"  >
                    <input type="hidden" name="id" class="form-control" value="<?=$id;?>"  >
                    <input type="text" name="penilai" class="form-control" value="<?=$penilai;?>"  >
                </div>
                <label class="col-sm-2 control-label">Atasan Pejabat Penilai</label>
                <div class="col-sm-3">
                    <input type="text" name="atasan" class="form-control" value="<?=$atasan;?>"  >
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nilai SKP</label>
                <div class="col-sm-3">
                    <input type="number" name="nilai" class="form-control" value="<?=$nilai;?>"  >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Orientasi Pelayanan</label>
                <div class="col-sm-3">
                    <input type="number" name="orientasi" class="form-control" autocomplete="off" value="<?=$orientasi;?>"  >
                </div>
                <label class="col-sm-2 control-label">Integritas</label>
                <div class="col-sm-3">
                    <input type="number" name="integritas" class="form-control" autocomplete="off" value="<?=$integritas;?>"  >
                </div>              
           </div>
           <div class="form-group">
                <label class="col-sm-2 control-label">Komitmen</label>
                <div class="col-sm-3">
                    <input type="number" name="komitmen" class="form-control" autocomplete="off" value="<?=$komitmen;?>"  >
                </div>
                <label class="col-sm-2 control-label">Disiplin</label>
                <div class="col-sm-3">
                    <input type="number" name="disiplin" class="form-control" autocomplete="off" value="<?=$disiplin;?>"  >
                </div>              
           </div>
           <div class="form-group">
                <label class="col-sm-2 control-label">Kerjasama</label>
                <div class="col-sm-3">
                    <input type="number" name="kerjasama" class="form-control" autocomplete="off" value="<?=$kerjasama;?>"  >
                </div>
                <label class="col-sm-2 control-label">Kepemimpinan</label>
                <div class="col-sm-3">
                    <input type="number" name="kepemimpinan" class="form-control" autocomplete="off" value="<?=$kepemimpinan;?>"  >
                </div>              
           </div>
           <div class="form-group">
            <label class="col-sm-2 control-label">File</label>
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