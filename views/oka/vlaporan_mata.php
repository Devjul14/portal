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
            var url = "<?php echo site_url('oka/cetak_mata')?>/"+kode;
            openCenteredWindow(url);
            return false;
        });
    });
</script>
    <?php 
        if ($q) {
            $a = explode(",", $q->mata);
            $b = explode(",", $q->lain);
            $action ="edit";
        }else{

        }
    ?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <?php
                    echo form_open("oka/simpanmata/", array("id"=>"formsave","class"=>"form-horizontal"));
                ?>
                    <input type="hidden" name="kode_oka" value="<?php echo $kode?>">
                <div class="form-group">
                    <label class="col-md-2 control-label">Mata</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata1" value="1"  <?php echo (($a[0] == "1") ? "checked" : "")?>>OD</label>
                    </div>
                    <div class="col-md-2 control-label checkbox">
                        <input type="text" name="lain13" class="form-control" value="<?php echo $b[12] ?>">
                    </div>    
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata2" value="1" <?php echo (($a[1] == "1") ? "checked" : "")?>>OS</label>
                    </div>
                    <div class="col-md-2 control-label checkbox">
                        <input type="text" name="lain14" class="form-control" value="<?php echo $b[13] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ekstaksi Lensa</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata3" value="1" <?php echo (($a[2] == "1") ? "checked" : "")?>>Phaco</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata4" value="1" <?php echo (($a[3] == "1") ? "checked" : "")?>>SICS</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata5" value="1" <?php echo (($a[4] == "1") ? "checked" : "")?>>ECCE</label>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Anesthesi</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata6" value="1" <?php echo (($a[5] == "1") ? "checked" : "")?>>Subtenon</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata7" value="1" <?php echo (($a[6] == "1") ? "checked" : "")?>>Topikal</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata8" value="1" <?php echo (($a[7] == "1") ? "checked" : "")?>>NU</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata9" value="1" <?php echo (($a[8] == "1") ? "checked" : "")?>>Peribulbar</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata10" value="1" <?php echo (($a[9] == "1") ? "checked" : "")?>>Lidocain 2%</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata11" value="1" <?php echo (($a[10] == "1") ? "checked" : "")?>>Murcain 0,5%</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata12" value="1" <?php echo (($a[11] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>  
                    <div class="col-md-2 control-label checkbox">
                        <input type="text" name="lain1" class="form-control" value="<?php echo $b[0] ?>">
                    </div>  
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Akinese</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata13" value="1" <?php echo (($a[12] == "1") ? "checked" : "")?>>O'Brien</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata14" value="1" <?php echo (($a[13] == "1") ? "checked" : "")?>>Van Lini</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata15" value="1" <?php echo (($a[14] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>  
                    <div class="col-md-2 control-label checkbox">
                        <input type="text" name="lain2" class="form-control" value="<?php echo $b[1] ?>" >
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Flat Konungtiva</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata16" value="1" <?php echo (($a[15] == "1") ? "checked" : "")?>>Basis Fomiks</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata17" value="1" <?php echo (($a[16] == "1") ? "checked" : "")?>>Basis Limbal</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Inssisi</label>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain3" class="form-control" value="<?php echo $b[2] ?>" >
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata18" value="1" <?php echo (($a[17] == "1") ? "checked" : "")?>>Kornea</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata19" value="1" <?php echo (($a[18] == "1") ? "checked" : "")?>>Lambus</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata20" value="1" <?php echo (($a[19] == "1") ? "checked" : "")?>>Tanpa Jahitan</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata21" value="1" <?php echo (($a[20] == "1") ? "checked" : "")?>>Linier</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata22" value="1" <?php echo (($a[21] == "1") ? "checked" : "")?>>Frown</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata23" value="1" <?php echo (($a[22] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain4" class="form-control" value="<?php echo $b[3] ?>" >
                    </div>  
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Alat</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata24" value="1" <?php echo (($a[23] == "1") ? "checked" : "")?>>Pisau Bedah</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata25" value="1" <?php echo (($a[24] == "1") ? "checked" : "")?>>Silet</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata26" value="1" <?php echo (($a[25] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain5" class="form-control" value="<?php echo $b[4] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Diskesi Lameter (Tunnel) Alat</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata27" value="1" <?php echo (($a[26] == "1") ? "checked" : "")?>>Disc Blade</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata28" value="1" <?php echo (($a[27] == "1") ? "checked" : "")?>>Cressent knife</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata29" value="1" <?php echo (($a[28] == "1") ? "checked" : "")?>>One Port</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata30" value="1" <?php echo (($a[29] == "1") ? "checked" : "")?>>Side Port</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata31" value="1" <?php echo (($a[30] == "1") ? "checked" : "")?>>Stab Knife</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata32" value="1" <?php echo (($a[31] == "1") ? "checked" : "")?>>Keratome knife</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata33" value="1" <?php echo (($a[32] == "1") ? "checked" : "")?>>Two Port</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata34" value="1" <?php echo (($a[34] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain6" class="form-control" value="<?php echo $b[5] ?>" >
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kapsulotomi Anterior</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata35" value="1" <?php echo (($a[35] == "1") ? "checked" : "")?>>Can Opener</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata36" value="1" <?php echo (($a[36] == "1") ? "checked" : "")?>>Cristmas Tree</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata37" value="1" <?php echo (($a[37] == "1") ? "checked" : "")?>>Linear</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata38" value="1" <?php echo (($a[38] == "1") ? "checked" : "")?>>C.C.C</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata39" value="1" <?php echo (($a[39] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain7" class="form-control" value="<?php echo $b[6] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">EKEK -espresi nukleus</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata40" value="1" <?php echo (($a[40] == "1") ? "checked" : "")?>>Teknik Bimanual</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata41" value="1" <?php echo (($a[41] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain8" class="form-control" value="<?php echo $b[7] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Lain - Lain</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata42" value="1" <?php echo (($a[42] == "1") ? "checked" : "")?>>EKIK</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata43" value="1" <?php echo (($a[43] == "1") ? "checked" : "")?>>I - A</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata44" value="1" <?php echo (($a[44] == "1") ? "checked" : "")?>>CLE</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata45" value="1" <?php echo (($a[45] == "1") ? "checked" : "")?>>Kapsulomi Posterior</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata46" value="1" <?php echo (($a[46] == "1") ? "checked" : "")?>>Irdektomi Jam</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain9" class="form-control" value="<?php echo $b[8] ?>">
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata47" value="1" <?php echo (($a[47] == "1") ? "checked" : "")?>>Sinechiolysis</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata48" value="1" <?php echo (($a[48] == "1") ? "checked" : "")?>>Spinterotomi</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata49" value="1" <?php echo (($a[49] == "1") ? "checked" : "")?>>Jahitan Iris</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata50" value="1" <?php echo (($a[50] == "1") ? "checked" : "")?>>Virektomi Anterior</label>
                    </div>  
                    <div class="col-md-2 control-label checkbox">
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata51" value="1" <?php echo (($a[51] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>

                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain10" class="form-control" value="<?php echo $b[9] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Cairan Irigasi</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata52" value="1" <?php echo (($a[52] == "1") ? "checked" : "")?>>RL</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata53" value="1" <?php echo (($a[53] == "1") ? "checked" : "")?>>B.S.S</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata54" value="1" <?php echo (($a[54] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain11" class="form-control" value="<?php echo $b[10] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Fhaco</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata55" value="1" <?php echo (($a[55] == "1") ? "checked" : "")?>>Metode 1 Tangan</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata56" value="1" <?php echo (($a[56] == "1") ? "checked" : "")?>>Metode 2 Tangan</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata57" value="1" <?php echo (($a[57] == "1") ? "checked" : "")?>>Cara BMB</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata58" value="1" <?php echo (($a[58] == "1") ? "checked" : "")?>>Cara BMD</label>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">L.I.O</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata60" value="1" <?php echo (($a[59] == "1") ? "checked" : "")?>>B.M.B</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata61" value="1" <?php echo (($a[60] == "1") ? "checked" : "")?>>B.M.D</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata62" value="1" <?php echo (($a[61] == "1") ? "checked" : "")?>>Diputar</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata63" value="1" <?php echo (($a[62] == "1") ? "checked" : "")?>>Tidak Diputar</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata64" value="1" <?php echo (($a[63] == "1") ? "checked" : "")?>>Horizontal</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata65" value="1" <?php echo (($a[64] == "1") ? "checked" : "")?>>J Loop</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata66" value="1" <?php echo (($a[65] == "1") ? "checked" : "")?>>C Loop</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata67" value="1" <?php echo (($a[66] == "1") ? "checked" : "")?>>Dilipat</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata68" value="1" <?php echo (($a[67] == "1") ? "checked" : "")?>>Sulcus Silindris</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata69" value="1" <?php echo (($a[68] == "1") ? "checked" : "")?>>Dalam Kantung Kapsul / In The Bag</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata87" value="1" <?php echo (($a[86] == "1") ? "checked" : "")?>>Diluar Kantung Kapsul</label>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Cairan Viskoclastik</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata70" value="1" <?php echo (($a[69] == "1") ? "checked" : "")?>>Healon</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata71" value="1" <?php echo (($a[70] == "1") ? "checked" : "")?>>Viscoat</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata72" value="1" <?php echo (($a[71] == "1") ? "checked" : "")?>>Starvisc</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata73" value="1" <?php echo (($a[72] == "1") ? "checked" : "")?>>Catgel</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata74" value="1" <?php echo (($a[73] == "1") ? "checked" : "")?>>Survisc</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <label><input type="checkbox" name="mata75" value="1" <?php echo (($a[74] == "1") ? "checked" : "")?>>Rohtovisc</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Benang</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata76" value="1" <?php echo (($a[75] == "1") ? "checked" : "")?>>Vicry 8-0</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata77" value="1" <?php echo (($a[76] == "1") ? "checked" : "")?>>VGA 8-0</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata78" value="1" <?php echo (($a[77] == "1") ? "checked" : "")?>>Ethylon 10-0</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata79" value="1" <?php echo (($a[78] == "1") ? "checked" : "")?>>Dermalon 10-0</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">TIO Pra Bedah</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata80" value="1" <?php echo (($a[79] == "1") ? "checked" : "")?>><17,3 mmHg</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata81" value="1" <?php echo (($a[80] == "1") ? "checked" : "")?>>>20,6 mmHg</label>
                    </div>  
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Komplikasi</label>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata82" value="1" <?php echo (($a[81] == "1") ? "checked" : "")?>>Tidak</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata83" value="1" <?php echo (($a[82] == "1") ? "checked" : "")?>>Ada</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata84" value="1" <?php echo (($a[83] == "1") ? "checked" : "")?>>Prolaps Viterus</label>
                    </div>  
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata85" value="1" <?php echo (($a[84] == "1") ? "checked" : "")?>>Pendarahan</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                       <label> <input type="checkbox" name="mata86" value="1" <?php echo (($a[85] == "1") ? "checked" : "")?>>Lain - Lain</label>
                    </div>
                    <div class="col-md-1 control-label checkbox">
                        <input type="text" name="lain12" class="form-control" value="<?php echo $b[11] ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Keterangan : </label>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">C.C.C</label>
                    <label class="col-md-3 control-label">Cintinous Curiviliner Capsul</label>
                    <label class="col-md-1 control-label">CLE</label>
                    <label class="col-md-3 control-label">Clear Lens Extractive</label>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">EKEK</label>
                    <label class="col-md-3 control-label">Ekstraksi Katarak ekstra Kapsul</label>
                    <label class="col-md-1 control-label">LIO</label>
                    <label class="col-md-3 control-label">Lensa Intra Okuler</label>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">EKIK</label>
                    <label class="col-md-3 control-label">Ekstraksi Katarak Intra Kapsul</label>
                    <label class="col-md-1 control-label">BMB</label>
                    <label class="col-md-3 control-label">Bilik Mata Belakang</label>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">I-A</label>
                    <label class="col-md-3 control-label">Irigasi Aspirasi</label>
                    <label class="col-md-1 control-label">BMD</label>
                    <label class="col-md-3 control-label">Bilik Mata Depan</label>
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