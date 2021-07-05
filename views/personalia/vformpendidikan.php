<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
      $(".back").click(function(){
        var id_perawat = $("[name='id_perawat']").val();
        var url = "<?php echo site_url('perawat/pendidikan');?>/"+id_perawat;
        window.location = url;
        return false; 
      });
        var formattgl = "dd-mm-yy";
        $("[name='tgl_lulus']").datepicker({
            dateFormat: formattgl,
        });
    });
</script>
<?php
if ($q) {
    $id             =$q->id;
    $id_perawat     =$q->id_perawat;
    $nama_sekolah   =$q->nama_sekolah;
    $id_pendidikan  =$q->id_pendidikan;
    $negara         =$q->negara;
    $no_ijasah      =$q->no_ijasah;
    $tahun          =$q->tahun;
    $gelar_depan    =$q->gelar_depan;
    $gelar_belakang =$q->gelar_belakang;
    $tgl_lulus      = $q->tgl_lulus != "" ? date("d-m-Y", strtotime($q->tgl_lulus)) : "";
    $r = "readonly";
    $aksi = "edit";
} else {
    $id=
    $nama_sekolah=
    $id_pendidikan=
    $negara=
    $no_ijasah=
    $tahun=
    $gelar_depan=
    $gelar_belakang=
    $tgl_lulus="";
    $r = "";
    $aksi = "simpan";
}
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open_multipart("perawat/simpanpendidikan/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tingkat Pendidikan</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_pendidikan">
                    <?php 
                    foreach($pend as $row){
                      echo "<option value='".$row->idx."' ".($row->idx==$id_pendidikan ? "selected" : "").">".$row->pendidikan."</option>";
                    }
                    ?>
                  </select> 
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Sekolah</label>
                <div class="col-sm-3">
                    <input type="hidden" name="id_perawat" class="form-control" value="<?=$id_perawat;?>"  >
                    <input type="hidden" name="id" class="form-control" value="<?=$id;?>"  >
                    <input type="text" name="nama_sekolah" class="form-control" value="<?=$nama_sekolah;?>"  >
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
                <label class="col-sm-2 control-label">Tanggal Lulus</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_lulus" class="form-control" autocomplete="off" value="<?=$tgl_lulus;?>"  >
                </div>
                <label class="col-sm-2 control-label">Nomor Ijasah</label>
                <div class="col-sm-3">
                   <input type="text" name="no_ijasah" class="form-control" value="<?=$no_ijasah;?>">
               </div>
           </div>
           <div class="form-group">
                <label class="col-sm-2 control-label">Gelar Depan</label>
                <div class="col-sm-3">
                    <input type="text" name="gelar_depan" class="form-control" value="<?=$gelar_depan;?>"  >
                </div>
                <label class="col-sm-2 control-label">Gelar Belakang</label>
                <div class="col-sm-3">
                   <input type="text" name="gelar_belakang" class="form-control" value="<?=$gelar_belakang;?>">
               </div>
             </div>
             <div class="form-group">
              <label class="col-sm-2 control-label">File Ijasah</label>
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