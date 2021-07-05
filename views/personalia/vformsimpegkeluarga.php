<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
  $(document).ready(function() {
    $(".back").click(function(){
      var id_perawat = $("[name='id_perawat']").val();
      var url = "<?php echo site_url('perawat/simpeg');?>/"+id_perawat;
      window.location = url;
      return false; 
    });
    var formattgl = "dd-mm-yy";
    $("[name='tgl_lahir']").datepicker({
      dateFormat: formattgl,
    });
  });
</script>
<?php
if ($q) {
  
  $nik            =$q->nik;
  $nama           =$q->nama;
  $kawin          =$q->kawin;
  $jenis_kelamin  =$q->jenis_kelamin;
  $tempat_lahir   =$q->tempat_lahir;
  $pegawai_kemenhan =$q->pegawai_kemenhan;
  $id_pendidikan  =$q->id_pendidikan;
  $bpjs           =$q->bpjs;
  $filepdf        =$q->filepdf;
  $hubungan       =$q->hubungan;
  $tunjangan      =$q->tunjangan;
  $tgl_lahir      = $q->tgl_lahir != "" ? date("d-m-Y", strtotime($q->tgl_lahir)) : "";
  $r = "readonly";
  $aksi = "edit";
} else {
  
  $nik=
  $nama=
  $kawin=
  $jenis_kelamin=
  $tempat_lahir=
  $pegawai_kemenhan=
  $id_pendidikan=
  $bpjs=
  $hubungan=
  $tunjangan=
  $filepdf=
  $tgl_lahir="";
  $r = "";
  $aksi = "simpan";
}
?>
<div class="col-xs-12">
  <div class="box box-primary">
    <div class="box-body">
      <?php echo form_open_multipart("perawat/simpansimpeg/".$aksi,array("class"=>"form-horizontal"));?>
      <div class="form-group">
        <label class="col-sm-2 control-label">NIK</label>
        <div class="col-sm-3">
          <input type="hidden" name="id_perawat" class="form-control" value="<?=$id_perawat;?>"  >
          <input type="text" name="nik" class="form-control" value="<?=$nik;?>"  >
        </div>
        <label class="col-sm-2 control-label">BPJS</label>
        <div class="col-sm-3">
         <input type="text" name="bpjs" class="form-control" value="<?=$bpjs;?>">
       </div>
     </div>
     <div class="form-group">
      <label class="col-sm-2 control-label">Nama</label>
      <div class="col-sm-3">
       <input type="text" name="nama" class="form-control" value="<?=$nama;?>">
     </div>
     <label class="col-sm-2 control-label">Hubungan</label>
     <div class="col-sm-3">
       <select class="form-control" name="hubungan" style="width: 100%">
        <option <?php echo $h1 ?> value="Ayah">Ayah</option>
        <option <?php echo $h2 ?> value="Ibu">Ibu</option>
        <option <?php echo $h3 ?> value="Suami/Istri">Suami/Istri</option>
        <option <?php echo $h4 ?> value="Anak Kandung">Anak Kandung</option>
        <option <?php echo $h5 ?> value="Anak Tiri">Anak Tiri</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Status Kawin</label>
    <div class="col-sm-3">
     <select class="form-control" name="kawin" style="width: 100%">
      <option <?php echo $k1 ?> value="Belum Kawin">Belum Kawin</option>
      <option <?php echo $k2 ?> value="Kawin">Kawin</option>
      <option <?php echo $k3 ?> value="Cerai">Cerai</option>
      <option <?php echo $k4 ?> value="Janda/Duda">Janda / Duda</option>
    </select>
  </div>
  <label class="col-sm-2 control-label">Tunjangan</label>
  <div class="col-sm-3">
   <select class="form-control" name="tunjangan" style="width: 100%">
    <option <?php echo $y ?> value="Ya">Ya</option>
    <option <?php echo $t ?> value="Tidak">Tidak</option>
  </select>
</div>
</div>
<div class="form-group">
  <label class="col-sm-2 control-label">Jenis Kelamin</label>
  <div class="col-sm-3">
   <select class="form-control" name="jenis_kelamin" style="width: 100%">
    <option <?php echo $lk ?> value="Laki-laki">Laki-laki</option>
    <option <?php echo $pr ?> value="Perempuan">Perempuan</option>
  </select>
</div>
<label class="col-sm-2 control-label">Tingkat Pendidikan</label>
<div class="col-sm-3">
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
  <label class="col-sm-2 control-label">Tempat Lahir</label>
  <div class="col-sm-3">
   <input type="text" name="tempat_lahir" class="form-control" value="<?=$tempat_lahir;?>">
 </div>
  <label class="col-sm-2 control-label">Pegawai Kemenhan</label>
  <div class="col-sm-3">
    <select class="form-control" name="pegawai_kemenhan" style="width: 100%">
      <option <?php echo $y ?> value="Ya">Ya</option>
      <option <?php echo $t ?> value="Tidak">Tidak</option>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-2 control-label">Tanggal Lahir</label>
  <div class="col-sm-3">
   <input type="text" name="tgl_lahir" class="form-control" autocomplete="off" value="<?=$tgl_lahir;?>">
 </div>
 <label class="col-sm-2 control-label">NIP / NRP</label>
 <div class="col-sm-3">
   <input type="text" name="nip" class="form-control" value="<?=$nip;?>">
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