<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('admindkk/soap');?>";
            window.location = url;
            return false; 
        });
        $(".textarea").wysihtml5({
            toolbar: {
                "fa": false,
                "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": false, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": false, //Button which allows you to edit the generated HTML. Default false
                "link": false, //Button to insert a link. Default true
                "image": false, //Button to insert an image. Default true,
                "color": false, //Button to change color of font  
                "blockquote": false, //Blockquote  
            }
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
        $s=$q->s;
        $o=$q->o;
        $a=$q->a;
        $p=$q->p;
        $tujuan = $q->tujuan;
        $action = "edit";
    } else {
        $s=$o=$a=$p=$tujuan="";
        $action = "simpan";
    }
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("admindkk/simpansoap/".$action,array("class"=>"form-horizontal"));?>               
                <input type="text" name="id" hidden value="<?php echo $id;?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">S</label>
                   <div class="col-sm-4">
                        <textarea name="s" class="textarea form-control"><?=$s;?></textarea>
                    </div>
                    <label class="col-sm-2 control-label">O</label>
                   <div class="col-sm-4">
                        <textarea name="o" class="textarea form-control"><?=$o;?></textarea>
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">A</label>
                   <div class="col-sm-4">
                        <textarea name="a" class="textarea form-control"><?=$a;?></textarea>
                    </div>
                    <label class="col-sm-2 control-label">P</label>
                   <div class="col-sm-4">
                        <textarea name="p" class="textarea form-control"><?=$p;?></textarea>
                    </div>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">Tujuan</label>
                    <div class="col-sm-4">
                        <textarea name="tujuan" class="textarea form-control"><?=$tujuan;?></textarea>
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