<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('user/user_login');?>";
            window.location = url;
            return false; 
        });
           var formattgl = "yy-mm-dd";
        $("input[name='tgl_sip']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
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
        $nip=$q->nip;
        $nama_user=$q->nama_user;
        $status_user=$q->status_user;
        $alamat=$q->alamat;
        $pwd=$q->pwd;
        $r = "readonly";
        $aksi = "edit";
    } else {
        $nip=
        $nama_user=
        $status_user=
        $alamat=
        $pwd=
        $r = "";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("user/simpanuser_login/".$aksi,array("class"=>"form-horizontal"));?>
                    <input type="hidden" name="nip" value='<?=$nip;?>'>
                  <div class="form-group">
                       <label class="col-sm-2 control-label">NIP</label>
                       <div class="col-sm-10">
                            <input type="text" name="nip" class="form-control" value="<?=$nip;?>"  <?php echo $r ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama User</label>
                       <div class="col-sm-10">
                            <input type="text" name="nama_user" class="form-control" value="<?=$nama_user;?>">
                        </div>
                   </div>
             
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status User</label>
                        <div class="col-sm-10">
                            <select name="status_user" class="form-control">
                             <?php
                                 foreach ($stat->result() as $value) {
                                   echo "<option value='".$value->id."'".($status_user==$value->id ? "selected" : "").">".$value->status_user."</option>";
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                       <div class="col-sm-10">
                            <textarea class="form-control" name="alamat"><?=$alamat;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password </label>
                        <div class="col-sm-10">
                            <input type="text" name="pwd" class="form-control" value="<?=$pwd;?>">
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