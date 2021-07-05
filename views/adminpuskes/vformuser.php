<script>
    $(document).ready(function() {
    //     // $("#myTable").fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
    //     $("table tr#data:first").addClass("bg-gray");
    //     $("table tr#data ").click(function(){
    //         $("tr#data").setSelection(4, true);
    //     });
        $(".back").click(function(){
            var url = "<?php echo site_url('adminpuskes');?>";
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
    if ($q2) {
        $nip=$q2->nip;
        $nama_user=$q2->nama_user;
        $status_user=$q2->status_user;
        $alamat=$q2->alamat;
        $aksi = "edit";
    } else {
        $nip=
        $nama_user=
        $status_user=
        $alamat= "";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
<!-- <button class="back btn btn-outline btn-primary  dim" type="button"><i class="fa fa-arrow-left"></i></button> -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?php echo $title_header; ?>
            </div>
            <div class="ibox-content">
                <?php echo form_open("adminpuskes/simpanuser/".$aksi,array("class"=>"form-horizontal"));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status User</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status_user">
                                <?php 
                                    foreach($q->result() as $row){
                                        echo "<option value='".$row->id."' ".($row->id==$status_user ? "selected" : "").">".$row->status_user."</option>";
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
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="back btn btn-white" type="reset">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                <?php echo form_close();?>            
            </div>
        </div>
    </div>
</div>