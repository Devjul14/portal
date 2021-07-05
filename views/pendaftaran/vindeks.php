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
 var mywindow1;
    function openCenteredWindow1(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow1 = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
        $("[name='bayarsharing'], [name='disc_nominal'], [name='sharing']").mask('000.000.000', {reverse: true});
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");
        $('.back').click(function(){
            window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
        });
        $('.pdf').click(function(){
            var no_sep = $("[name='no_sep']").val();
            var url = "<?php echo site_url('grouper/claimprint_ralan');?>/"+no_sep;
            openCenteredWindow(url);
        });
        $('.dat').click(function(){
            var i = $(this).attr("id");
            if ($("."+i).is(":hidden")){
                $(".list").fadeOut("slow");
                $(".list2").fadeOut("slow");
            }
            var kode = $(this).attr("kode");
            $("[name='id']").val(kode);
            $("."+i).toggle("slow");
            return false;
        });
        $('.dat2').click(function(){
            var i = $(this).attr("id");
            if ($(".n"+i).is(":hidden")){
                $(".list").fadeOut("slow");
                $(".list2").fadeOut("slow");
            }
            var kode = $(this).attr("kode");
            $("[name='id']").val(kode);
            $(".n"+i).toggle("slow");
            return false;
        });
        $('.hapus').click(function(){
            var id = $(this).attr("id");
            $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/hapus_indeksicd10",
                    method : "POST",
                    data : {id: id},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            return false;
        });
        $('.hapus2').click(function(){
            var id = $(this).attr("id");
            $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/hapus_indeksicd9",
                    method : "POST",
                    data : {id: id},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            return false;
        });
        $('.urut').change(function(){
            var id = $("[name='id']").val();
            var urut = $(this).val();
            var no_reg= $("[name='no_reg']").val();
            $.ajax({
                    url : "<?php echo base_url();?>grouper/edit_indeks_urut",
                    method : "POST",
                    data : {id: id,urut:urut, no_reg: no_reg},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal'],input[name='tgl_lahir']").datepicker({
            dateFormat : formattgl,
        });
        $("[name='icd10']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/geticd10",
                    method : "POST",
                    async: false,
                    data : {kode: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                var no_reg= $("[name='no_reg']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/simpan_indeksicd10",
                    method : "POST",
                    data : {no_reg: no_reg, kode: kode},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
                return n[0];
            }
        });
        $("[name='edit_icd10']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/geticd10",
                    method : "POST",
                    async: false,
                    data : {kode: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var no_reg= $("[name='no_reg']").val();
                var id= $("[name='id']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/edit_indeksicd10",
                    method : "POST",
                    data : {no_reg: no_reg, kode: kode, id: id},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
                return n[0];
            }
        });
        $("[name='icd9']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/geticd9",
                    method : "POST",
                    async: false,
                    data : {kode: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var no_reg= $("[name='no_reg']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/simpan_indeksicd9",
                    method : "POST",
                    data : {no_reg: no_reg, kode: kode},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
                return n[0];
            }
        });
        $("[name='edit_icd9']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/geticd9",
                    method : "POST",
                    async: false,
                    data : {kode: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var no_reg= $("[name='no_reg']").val();
                var id= $("[name='id']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>pendaftaran/edit_indeksicd9",
                    method : "POST",
                    data : {no_reg: no_reg, kode: kode, id: id},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
                return n[0];
            }
        });
    });
    function number_format (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
<div class="col-md-12">
    <?php 
        if($this->session->flashdata('message')){
            $pesan=explode('|', $this->session->flashdata('message'));
            echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b style='font-size:25px'>".$pesan[1]."</b>
            </div>";
        }
    ?>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">No. BPJS</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_bpjs' readonly value="<?php echo $row->no_bpjs;?>"/>
                    </div>
                    <!-- <label class="col-md-1 control-label">No. SEP</label>
                    <div class="col-md-2">
                        <input type="hidden" class="form-control" name='no_sep' value="<?php echo $row->no_sjp;?>"/>
                    </div> -->
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                        <input readonly type="text" class="form-control" name='tanggal' value="<?php echo $row->tanggal;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal Lahir</label>
                    <div class="col-md-3">
                        <input readonly type="text" class="form-control" name='tgl_lahir' value="<?php echo ($row->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($row->tgl_lahir)));?>" autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Keadaan Pulang</label>
                    <div class="col-md-2">
                        <select name="keadaan_pulang" class="form-control" disabled>
                            <option value="">---</option>
                            <?php
                                foreach ($k->result() as $key) {
                                    echo "<option value=".$key->id." ".($row->keadaan_pulang==$key->id ? "selected" : "").">".$key->keterangan."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-1 control-label">Ijin Pulang</label>
                    <div class="col-md-2">
                        <select name="status_pulang" class="form-control" disabled>
                            <option value="">---</option>
                            <?php
                                foreach ($sp->result() as $key) {
                                    echo "<option value=".$key->id." ".($row->status_pulang==$key->id ? "selected" : "").">".$key->keterangan."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Tanggal Pulang</label>
                    <div class="col-md-3">
                        <input readonly type="text" class="form-control" name='tgl_lahir' value="<?php echo ($row->tanggal_pulang=="" ? "" : date("d-m-Y H:i:s",strtotime($row->tanggal_pulang)));?>" autocomplete="off"/>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">DIAGNOSA</h3>
            <div class="col-sm-5 pull-right">
                <input type="text" name="icd10" class="form-control" placeholder="search..." autocomplete="off">
            </div>
        </div>
        <div class="box-body">
            <div class="col-sm-6">
            <input type="hidden" name="id">
            <ul>
                <?php
                    $i = 0;
                    foreach ($i10->result() as $key) {
                        $i++;
                        echo "<li>";
                        echo "<a href='#' class='dat' id='".$i."' kode='".$key->id."'>".$key->nama."&nbsp;<b>".$key->kode."</b></a>";
                        echo "</li>";
                        echo "<li type='none' class='list ".$i."' style='display:none'>";
                        echo "<div class='row' style='padding:5px 0px'>";
                        echo "<div class='col-sm-8'>";
                        echo "<div class='row'>";
                        echo "<div class='col-sm-7'>";
                        echo "<input type='text' name='edit_icd10' class='form-control col-xs-3 input-sm' autocomplete='off'>";
                        echo "</div>";
                        echo "<div class='col-sm-5'>";
                        echo "<select name='urut_".$key->id."' class='urut form-control'>";
                        echo "<option value='1' ".($key->urut=="1" ? "selected" : "").">Primary</option>";
                        echo "<option value='2' ".($key->urut=="2" ? "selected" : "").">Sekunder</option>";
                        echo "</select>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-sm-4'>";
                        echo "<button class='hapus btn btn-sm btn-danger' id='".$key->id."'>Delete</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</li>";
                    }
                ?>
            </ul>
            </div>
        </div>
    </div> 
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">PROCEDURE</h3>
            <div class="col-sm-5 pull-right">
                <input type="text" name="icd9" class="form-control" placeholder="search..." autocomplete="off">
            </div>
        </div>
        <div class="box-body">
            <div class="col-sm-8">
            <ul>
                <?php
                    $i = 0;
                    foreach ($i9->result() as $key) {
                        $i++;
                        echo "<li>";
                        echo "<a href='#' class='dat2' id='".$i."' kode='".$key->id."'>".$key->keterangan."&nbsp;<b>".$key->kode."</b></a>";
                        echo "</li>";
                        echo "<li type='none' class='list2 n".$i."' style='display:none'>";
                        echo "<div class='row' style='padding:5px 0px'>";
                        echo "<div class='col-sm-8'>";
                        echo "<input type='text' name='edit_icd9' class='form-control col-xs-3 input-sm' autocomplete='off'>";
                        echo "</div>";
                        echo "<div class='col-sm-4'>";
                        echo "<div class='pull-right'>";
                        echo "<button class='hapus2 btn btn-sm btn-danger' id='".$key->id."'>Delete</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</li>";
                    }
                ?>
            </ul>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-6">
                    <!-- <div class="pull-left">
                        <button class="pdf btn btn-success" type="button"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF</button>
                    </div> -->
                </div>
                <div class="col-sm-6">
                    <div class="pull-right">
                        <button class="back btn btn-warning" type="button"></i>&nbsp;&nbsp;Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>