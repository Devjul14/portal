<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
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
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open("persetujuan/cekpersetujuan_umum/".$aksi,array("class"=>"form-horizontal"));?>
            <div class="form-group">
               <label class="col-sm-2 control-label">Jenis Pilihan</label>
               <div class="col-sm-4">
                    <select class="form-control" name="pilihan">
                        <option value="">---</option>
                        <option value="NIK">NIK</option>
                        <option value="HP">No HP</option>
                        <option value="BPJS">No BPJS</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="isi" class="form-control">
                    <input type="hidden" name="no_reg" class="form-control" value="<?php echo $no_reg ?>">
                    <input type="hidden" name="jenis" class="form-control" value="<?php echo $jenis ?>">
                </div>
            </div>
       </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Submit</button>
                </div>
            </div>
            <?php echo form_close();?> 
        </div>
    </div>
</div>  