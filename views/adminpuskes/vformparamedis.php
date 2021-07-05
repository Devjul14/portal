<script>
    $(document).ready(function() {
    //     // $("#myTable").fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
    //     $("table tr#data:first").addClass("bg-gray");
    //     $("table tr#data ").click(function(){
    //         $("tr#data").setSelection(4, true);
    //     });
        $(".back").click(function(){
            var url = "<?php echo site_url('adminpuskes/paramedis');?>";
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
        $id_puskesmas=$q2->id_puskesmas;
        $id_paramedis=$q2->id_paramedis;
        $id_layanan=$q2->id_layanan;
        $nama_paramedis=$q2->nama_paramedis;
        $jenis_paramedis=$q2->jenis_paramedis;
        $alamat=$q2->alamat;
        $nip=$q2->nip;
        $kota=$q2->kota;
        $hp=$q2->hp;
        $telp=$q2->telp;
        $aksi = "edit";
    } else {
        $id_puskesmas=
        $id_paramedis=
        $id_layanan=
        $nama_paramedis=
        $alamat=
        $nip=
        $kota=
        $hp=
        $telp="";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?php echo $title_header; ?>
            </div>
            <div class="ibox-content">
                <?php echo form_open("adminpuskes/simpanparamedis/".$aksi,array("class"=>"form-horizontal"));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status User</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_paramedis">
                                <?php 
                                    foreach($q1->result() as $row){
                                        echo "<option value='".$row->id_jenisparamedis."' ".($jenis_paramedis==$row->id_jenisparamedis ? "selected" : "").">".$row->jenis_paramedis."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Layanan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_layanan">
                                <?php 
                                    foreach($q3->result() as $row){
                                        echo "<option value='".$row->id_layanan."' ".($id_layanan==$row->id_layanan ? "selected" : "").">".$row->layanan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" name="nip" class="form-control" value="<?=$nip;?>">
                            <input type=hidden name=idlama value='<?=$id_paramedis;?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Paramedis</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_paramedis" class="form-control" value="<?=$nama_paramedis;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control"><?=$alamat;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kota</label>
                        <div class="col-sm-10">
                            <input type="text" name="kota" class="form-control" value="<?=$kota;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" name="telp" class="form-control" value="<?=$telp;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Handphone</label>
                        <div class="col-sm-10">
                            <input type="text" name="hp" class="form-control" value="<?=$hp;?>">
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