<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function() {
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $(".cancel").click(function(){
            var kode = $("input[name='kode_oka']").val();
            window.location = "<?php echo site_url('oka/formoka')?>/"+kode;
            return false;
        });
        $(".cetak").click(function(){
            var kode = $("input[name='kode_oka']").val();
            var url = "<?php echo site_url('oka/cetak_pterygium')?>/"+kode;
            openCenteredWindow(url);
            return false;
        });

        $("[name='mata3']").change(function(){
            if ($("[name='mata3']").attr("checked", true)){
                $("[name='lain3']").attr("disabled", "disabled");
            }
        });
        $("[name='mata4']").change(function(){
            if ($("[name='mata4']").attr("checked", true)){
                $("[name='lain3']").removeAttr("disabled");
            }
        });
        $("[name='mata5']").change(function(){
            if ($("[name='mata5']").attr("checked", true)){
                $("[name='lain4']").attr("disabled", "disabled");
            }
        });
        $("[name='mata6']").change(function(){
            if ($("[name='mata6']").attr("checked", true)){
                $("[name='lain4']").removeAttr("disabled");
            }
        });
    });
</script>
    <?php 
        if ($q) {
            $a = explode(",", $q->pterygium);
            $b = explode(",", $q->petlain);
            $keterangan_tambahan = $q->keterangan_tambahan;
            $action ="edit";
        }else{

        }
    ?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <?php
                    echo form_open("oka/simpanpterygium/", array("id"=>"formsave","class"=>"form-horizontal"));
                ?>
                    <input type="hidden" name="kode_oka" value="<?php echo $kode?>">
                <div class="form-group">
                    <label class="col-md-2 control-label">Mata</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata1" value="1"  <?php echo (($a[0] == "1") ? "checked" : "")?>>OD</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain1" class="form-control" value="<?php echo $b[0] ?>">
                    </div>    
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata2" value="1" <?php echo (($a[1] == "1") ? "checked" : "")?>>OS</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain2" class="form-control" value="<?php echo $b[1] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Antiseptik</label>
                    <div class="col-md-2 control-label checkbox">
                       <label> <input type="checkbox" name="mata3" value="1" <?php echo (($a[2] == "1") ? "checked" : "")?>>Betadin</label>
                    </div>  
                    <div class="col-md-2 control-label checkbox">
                        <label>
                            <input type="checkbox" name="mata4" value="1" <?php echo (($a[3] == "1") ? "checked" : "")?>>
                            <input type="text" name="lain3" placeholder="Lainnya" class="form-control" value="<?php echo $b[2] ?>">
                        </label>
                    </div>
                    <div class="col-md-2 control-label checkbox">
                    </div>  
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Spekulum</label>
                    <div class="col-md-2 control-label checkbox">
                       <label> <input type="checkbox" name="mata5" value="1" <?php echo (($a[4] == "1") ? "checked" : "")?>>Wire</label>
                    </div>  
                    <div class="col-md-2 control-label checkbox">
                        <label>
                            <input type="checkbox" name="mata6" value="1" <?php echo (($a[5] == "1") ? "checked" : "")?>>
                            <input type="text" name="lain4" class="form-control" value="<?php echo $b[3] ?>">
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kendala Rektus Superior</label>
                    <div class="col-md-2 control-label checkbox">
                       <label> <input type="checkbox" name="mata9" value="1" <?php echo (($a[8] == "1") ? "checked" : "")?>>Ya</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata10" value="1" <?php echo (($a[9] == "1") ? "checked" : "")?>>Tidak</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Benang</label>
                    <div class="col-md-2 control-label checkbox">
                       <label> <input type="checkbox" name="mata11" value="1" <?php echo (($a[10] == "1") ? "checked" : "")?>>Nylon 10-0</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata12" value="1" <?php echo (($a[11] == "1") ? "checked" : "")?>>VGA 8-0</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Cangkok Konjungrivita</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata13" value="1" <?php echo (($a[12] == "1") ? "checked" : "")?>>Ya</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label>Ukuran</label>
                    </div>
                    <div class="col-md-2 control-label checkbox">
                        <input type="text" name="lain6" class="form-control" value="<?php echo $b[5] ?>">
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata14" value="1" <?php echo (($a[13] == "1") ? "checked" : "")?>>Tidak</label>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Cangkok Membran Amnion</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata16" value="1" <?php echo (($a[15] == "1") ? "checked" : "")?>>Ya</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label>Ukuran</label>
                    </div>
                    <div class="col-md-2 control-label checkbox">
                        <input type="text" name="lain7" class="form-control" value="<?php echo $b[6] ?>">
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata17" value="1" <?php echo (($a[16] == "1") ? "checked" : "")?>>Tidak</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Bare Selera</label>
                    <div class="col-md-2 control-label checkbox">
                       <label> <input type="checkbox" name="mata19" value="1" <?php echo (($a[18] == "1") ? "checked" : "")?>>Ya</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata20" value="1" <?php echo (($a[19] == "1") ? "checked" : "")?>>Tidak</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Subconj Injeksi</label>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata23" value="1" <?php echo (($a[22] == "1") ? "checked" : "")?>>Gentamicyn</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain8" class="form-control" value="<?php echo $b[7] ?>">
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata24" value="1" <?php echo (($a[23] == "1") ? "checked" : "")?>>Dexametason &nbsp;</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain9" class="form-control" value="<?php echo $b[8] ?>">
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata22" value="1" <?php echo (($a[21] == "1") ? "checked" : "")?>>Tidak</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Penjahitan  </label>
                    <div class="col-md-8 control-label checkbox">
                        <input type="text" name="lain10" class="form-control" value="<?php echo $b[9] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Keterangan Tambahan :  </label>
                </div>
                <div class="form-group">
                    <div class="col-md-12">   
                        <textarea class="form-control" name="keterangan_tambahan"  cols="10" rows="10"><?php echo $keterangan_tambahan ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">   
    <div class="box-box primary">
        <div class="box-body">
            <div class="pull-right">
                <textarea class="form-control hidden" name="laporan" style="max-width: 100%;height:300px;"><?php echo $q->laporan ?></textarea>
                <button class="cetak btn btn-warning" type="button"><i class="fa fa-save"></i> Cetak</button>
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="cancel btn btn-danger" type="button"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>