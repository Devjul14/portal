<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('user/status_user');?>";
            window.location = url;
            return false; 
        });
        
    });
</script>
<?php
    if ($q) {
        $status_user=$q->status_user;
        $controller=$q->controller;
        $r = "readonly";
        $aksi = "edit";
    } else {
        $status_user=
        $controller=
        $r = "";
        $aksi = "simpan";
    }
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open("user/simpanstatus_user/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                    <input type="hidden" name="id" class="form-control" value="<?=$id;?>">
                    <label class="col-sm-2 control-label">Status User</label>
                    <div class="col-sm-10">
                       <input type="text" name="status_user" class="form-control" value="<?=$status_user;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Controller</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="controller">
                            <?php
                                foreach ($q1->result() as $val1) {
                                    echo "
                                        <option value='".$val1->id_controller."' ".($val1->id_controller==$controller ? "selected" : "").">".$val1->nama_controller."</option>
                                    ";
                                }
                            ?>
                        </select>
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