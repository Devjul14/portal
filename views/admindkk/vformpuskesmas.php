<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('admindkk/puskesmas');?>";
            window.location = url;
            return false; 
        });
        $("select[name='id_kecamatan']").select2();
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
        $id_puskesmas=$q2->id_puskesmas;
        $id_kecamatan=$q2->id_kecamatan;
        $nama_puskesmas=$q2->nama_puskesmas;
        $alamat=$q2->alamat;
        $nama_puskesmas=$q2->nama_puskesmas;
        $kepala=$q2->kepala;
        $nip=$q2->nip;
        $telepon=$q2->telepon;
        $aksi = "edit";
    } else {
        $id_puskesmas=
        $id_kecamatan=
        $nama_puskesmas=
        $alamat=
        $nama_puskesmas=
        $kepala=
        $nip=
        $telepon="";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("admindkk/simpanpuskesmas/".$aksi,array("class"=>"form-horizontal"));?>
                    <input type="hidden" name="idlama" value='<?=$id_puskesmas;?>'>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <select name="id_kecamatan" class="form-control">
                                <?php 
                                    foreach($q1->result() as $row){
                                        echo "<option value='".$row->id_kecamatan."' ".($id_kecamatan==$row->id_kecamatan ? "selected" : "").">".$row->nama_kecamatan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Puskesmas</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_puskesmas" class="form-control" value="<?=$nama_puskesmas;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat"><?=$alamat;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon 1</label>
                        <div class="col-sm-10">
                            <input type="text" name="telepon" class="form-control" value="<?=$telepon;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon 2</label>
                        <div class="col-sm-10">
                            <input type="text" name="nip" class="form-control" value="<?=$nip;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kepala Puskesmas</label>
                        <div class="col-sm-10">
                            <input type="text" name="kepala" class="form-control" value="<?=$kepala;?>">
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