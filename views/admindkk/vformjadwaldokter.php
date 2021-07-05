<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('dokter/view');?>";
            window.location = url;
            return false; 
        });
           var formattgl = "yy-mm-dd";
        $("input[name='tgl_sip']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
        // $("select[name='id_kecamatan']").select2();
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
        $id_jdokter=$q->id_jdokter;
        $dokter=$q->nama_dokter;
        $poli=$q->nama_poli;
        $waktu=$q->waktu;
        $hari=$q->hari;
        $jam=$q->jam;
        if ($q->waktu=="padi") $w1 = "selected"; else $w1 = "";
        if ($q->waktu=="sore") $w2 = "selected"; else $w2 = "";
       
        $r = "readonly";
        $aksi = "edit";
    } else {
        $id_jdokter=
        $dokter=
        $poli=
        $waktu=
        $hari=
        $jam=
        $w1= $w2=
        $r = "";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("dokter/simpanjadwaldokter/".$aksi,array("class"=>"form-horizontal"));?>
                    <input type="hidden" name="id_jdokter" value='<?=$id_jdokter;?>'>
                   <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Dokter</label>
                        <div class="col-sm-10">
                            <select name="nama_dokter" class="form-control">
                             <?php
                                 foreach ($q1->result() as $value) {
                                   echo "<option value='".$value->id_dokter."'".($dokter==$value->id_dokter ? "selected" : "").">".$value->nama_dokter."</option>";
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Poli</label>
                        <div class="col-sm-10">
                            <select name="nama_poli" class="form-control">
                             <?php
                                 foreach ($q2->result() as $value) {
                                   echo "<option value='".$value->kode."'".($poli==$value->kode ? "selected" : "").">".$value->keterangan."</option>";
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Waktu</label>
                        <div class="col-sm-10">
                          <select name="waktu" class="form-control">                        
                            <option value="pagi" <?php echo $w1;?>>Pagi</option>
                            <option value="pagi" <?php echo $w2;?>>Sore</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hari</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="hari" value="<?=$hari;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jam</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jam" value="<?=$jam;?>">
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