<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var id_perawat = $("[name='id_perawat']").val();
            var url = "<?php echo site_url('perawat/riwayat_pangkat');?>/"+id_perawat;
            window.location = url;
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("[name='tmt'],[name='sk_tgl'],[name='bkn_tgl']").datepicker({
            dateFormat: formattgl,
        });
    });
</script>
<?php
if ($q) {
    $id             =$q->id;
    $id_perawat     =$q->id_perawat;
    $id_kenaikan    =$q->id_kenaikan;
    $id_pangkat     =$q->id_pangkat;
    $tmt            = $q->tmt != "" ? date("d-m-Y", strtotime($q->tmt)) : "";
    $sk_tgl         = $q->sk_tgl != "" ? date("d-m-Y", strtotime($q->sk_tgl)) : "";
    $bkn_tgl        = $q->bkn_tgl != "" ? date("d-m-Y", strtotime($q->bkn_tgl)) : "";
    $sk_no          =$q->sk_no;
    $bkn_no         =$q->bkn_no;
    $filepdf        =$q->filepdf;
    $kredit_utama    =$q->kredit_utama;
    $kredit_tambahan =$q->kredit_tambahan;
    $status_pangkat  =explode(",",$q->status_pangkat);
    $r = "readonly";
    $aksi = "edit";
} else {
    $id=
    $id_kenaikan=
    $id_pangkat=
    $tmt =
    $sk_tgl =
    $sk_no=
    $bkn_tgl =
    $bkn_no=
    $filepdf=
    $kredit_utama=
    $kredit_tambahan=
    $status_pangkat="";
    $r = "";
    $aksi = "simpan";
}
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open_multipart("perawat/simpanpangkat/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kenaikan</label>
                <div class="col-sm-10">
                  <input type="hidden" name="id_perawat" class="form-control" value="<?=$id_perawat;?>"  >
                  <input type="hidden" name="id" class="form-control" value="<?=$id;?>"  >
                  <select class="form-control" name="id_kenaikan">
                  <?php 
                  foreach($k as $row){
                    if ($c->num_rows()<=0){
                      if ($row->id_kenaikan==12){
                        echo "<option value='".$row->id_kenaikan."' ".($row->id_kenaikan==$id_kenaikan ? "selected" : "").">".$row->keterangan."</option>";
                      }
                    } else {
                      if ($row->id_kenaikan!=12){
                        echo "<option value='".$row->id_kenaikan."' ".($row->id_kenaikan==$id_kenaikan ? "selected" : "").">".$row->keterangan."</option>";
                    }
                  }
                }
                  ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Pangkat</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_pangkat">
                  <?php
                  foreach($p as $row){
                    echo "<option value='".$row->kode_pangkat."' ".($row->kode_pangkat==$kode_pangkat ? "selected" : "").">".$row->keterangan."</option>";
                  }
                  ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">TMT</label>
                <div class="col-sm-3">
                    <input type="text" name="tmt" class="form-control" autocomplete="off" value="<?=$tmt;?>"  >
                </div>
           </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">SK Tanggal</label>
                <div class="col-sm-3">
                    <input type="text" name="sk_tgl" class="form-control" autocomplete="off" value="<?=$sk_tgl;?>"  >
                </div>
                <label class="col-sm-2 control-label">SK No</label>
                <div class="col-sm-3">
                   <input type="text" name="sk_no" class="form-control" value="<?=$sk_no;?>">
               </div>
           </div>
           <div class="form-group">
                <label class="col-sm-2 control-label">BKN Tanggal</label>
                <div class="col-sm-3">
                    <input type="text" name="bkn_tgl" class="form-control" autocomplete="off" value="<?=$bkn_tgl;?>"  >
                </div>
                <label class="col-sm-2 control-label">BKN No</label>
                <div class="col-sm-3">
                   <input type="text" name="bkn_no" class="form-control" value="<?=$bkn_no;?>">
               </div>
           </div>
           <div class="form-group">
                <label class="col-sm-2 control-label">Angka Kredit Utama</label>
                <div class="col-sm-3">
                    <input type="text" name="kredit_utama" class="form-control" value="<?=$kredit_utama;?>"  >
                </div>
                <label class="col-sm-2 control-label">Angka Kredit Tambahan</label>
                <div class="col-sm-3">
                   <input type="text" name="kredit_tambahan" class="form-control" value="<?=$kredit_tambahan;?>">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-2 control-label">Pangkat Awal Anda?</label>
               <div class="col-sm-10">
                 <input type="checkbox" name="awal" value="Pangkat Awal" <?php echo (isset($status_pangkat[0]) && $status_pangkat[0] != "" ? "checked" : "");?>>
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-2 control-label">Pangkat Anda Saat ini?</label>
               <div class="col-sm-10">
                 <input type="checkbox" name="saatini" value="Pangkat Saat Ini" <?php echo (isset($status_pangkat[1]) && $status_pangkat[1] != "" ? "checked" : "");?>>
               </div>
           </div>
           <div class="form-group">
            <label class="col-sm-2 control-label">SK File</label>
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
