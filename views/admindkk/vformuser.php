<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('admindkk');?>";
            window.location = url;
            // alert(url);
            return false; 
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
        $id_puskesmas=$q->id_puskesmas;
        $aksi = "edit";
    } else {
        $nip=
        $nama_user=
        $status_user=
        $alamat=
        $id_puskesmas= "";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("admindkk/simpanuser/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Puskesmas</label>
                    <div class="col-sm-10">
                        <select class="form-control m-b" name="id_puskesmas">
                            <?php 
                                foreach($q1->result() as $row){
                                    echo "<option value='".$row->id_puskesmas."' ".($row->id_puskesmas==$id_puskesmas ? "selected" : "").">".$row->nama_puskesmas."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="nip" class="form-control" value="<?=$nip;?>">
                        <input type=hidden name=idlama value='<?=$id;?>'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_user" class="form-control" value="<?=$nama_user;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" class="form-control"><?=$alamat;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="pwd1" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Konfirmasi Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="pwd2" class="form-control">
                    </div>
                </div>           
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="back btn btn-warning" type="reset">Batal</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                <?php echo form_close();?> 
            </div>
        </div>
    </div>