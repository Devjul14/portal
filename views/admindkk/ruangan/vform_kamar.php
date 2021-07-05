<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('ruangan/kamar');?>";
            window.location = url;
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
        $kode_ruangan   = $q->kode_ruangan;
        $kode_kelas     = $q->kode_kelas;
        $nama_kamar     = $q->nama_kamar;
        $no_bed         = $q->no_bed;
        $tarif_kamar    = $q->tarif_kamar;
        $r              = "readonly";
        $aksi           = "edit";
    } else {
        $kode_ruangan   =
        $kode_kelas     =
        $nama_kamar     =
        $no_bed         =
        $tarif_kamar    =
        $r              = "";
        $aksi           = "simpan";
    }
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("ruangan/simpankamar/".$aksi,array("class"=>"form-horizontal"));?>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Kode Kamar</label>
                   <div class="col-sm-10">
                        <input type="text" name="kode_kamar" class="form-control" value="<?=$kode_kamar;?>"  <?php echo $r ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nomor Bed</label>
                   <div class="col-sm-10">
                        <input type="text" name="no_bed" class="form-control" value="<?=$no_bed;?>" <?php echo $r ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ruangan</label>
                    <div class="col-sm-10">
                        <select name="kode_ruangan" class="form-control">
                            <?php
                                foreach ($q1->result() as $val1) {
                                    echo "
                                        <option value='".$val1->kode_ruangan."' ".($kode_ruangan==$val1->kode_ruangan ? "selected" : "").">".$val1->nama_ruangan."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Kelas</label>
                    <div class="col-sm-10">
                        <select name="kode_kelas" class="form-control">
                            <?php
                                foreach ($q2->result() as $val2) {
                                    echo "
                                        <option value='".$val2->kode_kelas."' ".($kode_kelas==$val2->kode_kelas ? "selected" : "").">".$val2->nama_kelas."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Kamar</label>
                   <div class="col-sm-10">
                        <input type="text" name="nama_kamar" class="form-control" value="<?=$nama_kamar;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tarif Kamar</label>
                   <div class="col-sm-10">
                        <input type="number" name="tarif_kamar" class="form-control" value="<?=$tarif_kamar;?>">
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