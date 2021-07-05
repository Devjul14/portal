<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('admindkk/ketcabang');?>";
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
        $keterangan=$q->keterangan;
        $id_cabang = $q->id_cabang;
        $action = "edit";
    } else {
        $id_cabang=
        $keterangan="";
        $action = "simpan";
    }
    // echo $action;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("admindkk/simpanketcabang/".$action,array("class"=>"form-horizontal"));?>               
               <input type="text" name="id_ketcabang" hidden value="<?php echo $id_ketcabang;?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Cabang</label>
                   <div class="col-sm-10">
                        <select name="cabang" class="form-control">           
                            <?php
                                foreach ($q1->result() as $val1) {
                                    echo "
                                        <option value='".$val1->id_cabang."' ".($id_cabang==$val1->id_cabang ? "selected" : "").">".$val1->keterangan."</option>
                                    ";
                                }
                            ?>
                        </select>
                        
                        </select>
                    </div>
               </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ket Cabang</label>
                   <div class="col-sm-10">
                        <input type="text" name="keterangan" class="form-control" value="<?=$keterangan;?>">
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