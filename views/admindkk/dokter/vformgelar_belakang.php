<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('dokter/kelompok');?>";
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
        $id_gelar=$q->id_gelar;
        $nama_gelar=$q->nama_gelar;
        $r = "readonly";
        $aksi = "edit";
    } else {
        $id_gelar=
        $nama_gelar=
        $r = "";
        $aksi = "simpan";
    }
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("dokter/simpangelar_belakang/".$aksi,array("class"=>"form-horizontal"));?>
                    <input type="hidden" name="id_gelar" value='<?=$id_gelar;?>'>
                  <div class="form-group">
                       <label class="col-sm-2 control-label">Id Gelar</label>
                       <div class="col-sm-10">
                            <input required type="text" name="id_gelar" class="form-control" value="<?=$id_gelar;?>"  <?php echo $r ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Gelar</label>
                       <div class="col-sm-10">
                            <input required type="text" name="nama_gelar" class="form-control" value="<?=$nama_gelar;?>">
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