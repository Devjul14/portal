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
    $(document).ready(function(){
        var formattgl = "dd-mm-yy";
        $("input[name='terakhir_berobat']").datepicker({
            dateFormat : formattgl,
        });
        var diagnosa1 = $("name[diagnosa1]").val();
        var diagnosa2 = $("name[diagnosa2]").val();
        var diagnosa3 = $("name[diagnosa3]").val();
        var tindakan1 = $("name[tindakan1]").val();
        var tindakan2 = $("name[tindakan2]").val();
        var tindakan3 = $("name[tindakan3]").val();
        // namadiagnosa(diagnosa1,"nama_diagnosa1");
        // namadiagnosa(diagnosa2,"nama_diagnosa2");
        // namadiagnosa(diagnosa3,"nama_diagnosa3");
        // namatindakan(tindakan1,"nama_tindakan1");
        // namatindakan(tindakan2,"nama_tindakan2");
        // namatindakan(tindakan3,"nama_tindakan3");
        $("[name='dokter_retensi']").select2();
        $("[name='nama_diagnosa1']").typeahead({
            source: function(query, process) {
                objects = [];
                $("[name='diagnosa1']").val('');
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>retensi/getdiagnosa",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='diagnosa1']").val(n[0]);
                return n[1];
            }
        });
        $("[name='nama_diagnosa2']").typeahead({
            source: function(query, process) {
                objects = [];
                $("[name='diagnosa2']").val('');
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>retensi/getdiagnosa",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='diagnosa2']").val(n[0]);
                return n[1];
            }
        });
        $("[name='nama_diagnosa3']").typeahead({
            source: function(query, process) {
                objects = [];
                $("[name='diagnosa3']").val('');
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>retensi/getdiagnosa",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='diagnosa3']").val(n[0]);
                return n[1];
            }
        });
        $("[name='nama_tindakan1']").typeahead({
            source: function(query, process) {
                objects = [];
                $("[name='tindakan1']").val('');
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>retensi/tindakan",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='tindakan1']").val(n[0]);
                return n[1];
            }
        });
        $("[name='nama_tindakan2']").typeahead({
            source: function(query, process) {
                objects = [];
                $("[name='tindakan2']").val('');
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>retensi/tindakan",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='tindakan2']").val(n[0]);
                return n[1];
            }
        });
        $("[name='nama_tindakan3']").typeahead({
            source: function(query, process) {
                objects = [];
                $("[name='tindakan3']").val('');
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>retensi/tindakan",
                        method : "POST",
                        async: false,
                        data : {kode: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='tindakan3']").val(n[0]);
                return n[1];
            }
        });
    });
    function namadiagnosa(kode,element){
        var data = $.ajax({
            url : "<?php echo base_url();?>retensi/namadiagnosa",
            method : "POST",
            async: false,
            data : {kode: kode}
        }).responseText;
        $("[name='"+element+"']").val(data);
    }
    function namatindakan(kode,element){
        var data = $.ajax({
            url : "<?php echo base_url();?>retensi/namatindakan",
            method : "POST",
            async: false,
            data : {kode: kode}
        }).responseText;
        $("[name='"+element+"']").val(data);
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
    <?php
        if ($q) {
            $terakhir_berobat = date("d-m-Y",strtotime($q->terakhir_berobat));
            $alergi = $q->alergi;
            $dokter_retensi = $q->dokter_retensi;
            $diagnosa1 = $q->diagnosa1;
            $diagnosa2 = $q->diagnosa2;
            $diagnosa3 = $q->diagnosa3;
            $tindakan1 = $q->tindakan1;
            $tindakan2 = $q->tindakan2;
            $tindakan3 = $q->tindakan3;
            $nama_diagnosa1 = $q->nama_diagnosa1;
            $nama_diagnosa2 = $q->nama_diagnosa2;
            $nama_diagnosa3 = $q->nama_diagnosa3;
            $nama_tindakan1 = $q->nama_tindakan1;
            $nama_tindakan2 = $q->nama_tindakan2;
            $nama_tindakan3 = $q->nama_tindakan3;
            $nama_pasien = $q->nama_pasien;
            $alamat =  $q->alamat;
            $action = "edit";
        } else {
            $terakhir_berobat = date("d-m-Y");
            $diagnosa1 = 
            $diagnosa2 = 
            $diagnosa3 =
            $tindakan1 = 
            $tindakan2 = 
            $tindakan3 =
            $nama_diagnosa1 = 
            $nama_diagnosa2 = 
            $nama_diagnosa3 = 
            $nama_tindakan1 = 
            $nama_tindakan2 = 
            $nama_tindakan3 = 
            $dokter_retensi =  "";
            $nama_pasien = $row->nama_pasien;
            $alergi = $row->alergi;
            $alamat = $row->alamat;
            $action = "simpan";
        }
        // echo $action;
          
    ?>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <?php echo form_open("retensi/simpanretensi/".$action);?>
                <input type="hidden" name="no_retensi" value="<?php echo $no_retensi;?>">
                <div class="form-group">
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-3">
                        <input type="text" required readonly class="form-control" name='no_rm' readonly value="<?php echo $no_rm;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Nama Pasien</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $nama_pasien;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Alamat Pasien</label>
                    <div class="col-md-3">
                        <textarea class="form-control" name="alamat" readonly><?php echo $alamat ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Terakhir Berobat</label>
                    <div class="col-md-3">
                        <input type="text" required class="form-control" name='terakhir_berobat'  value="<?php echo date("d-m-Y",strtotime($terakhir_berobat));?>"/>
                    </div>
                    <label class="col-md-1 control-label">Alergi</label>
                    <div class="col-md-3">
                        <input type="text" required  class="form-control" name='alergi' value="<?php echo $alergi;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Dokter</label>
                    <div class="col-md-3">
                        <select class="form-control" name="dokter_retensi">
                            <option value="">----</option>
                            <?php 
                                foreach ($d->result() as $key) {
                                    echo "<option value='".$key->id_dokter."' ".($dokter_retensi==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">DIAGNOSA</h3>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 control-label">Diagnosa 1</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="diagnosa1" readonly value="<?php echo $diagnosa1;?>">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nama_diagnosa1" value="<?php echo $nama_diagnosa1 ?>" autocomplete='off'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Diagnosa 2</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="diagnosa2" readonly value="<?php echo $diagnosa2;?>">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nama_diagnosa2" value="<?php echo $nama_diagnosa2 ?>" autocomplete='off'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Diagnosa 3</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="diagnosa3" readonly value="<?php echo $diagnosa3;?>">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nama_diagnosa3" value="<?php echo $nama_diagnosa3 ?>" autocomplete='off'>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">TINDAKAN</h3>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 control-label">Tindakan 1</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tindakan1" readonly value="<?php echo $tindakan1;?>">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nama_tindakan1" value="<?php echo $nama_tindakan1 ?>" autocomplete='off'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tindakan 2</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tindakan2" readonly value="<?php echo $tindakan2;?>">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nama_tindakan2" value="<?php echo $nama_tindakan2 ?>" autocomplete='off'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tindakan 3</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tindakan3" readonly value="<?php echo $tindakan1;?>">
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nama_tindakan3" value="<?php echo $nama_tindakan3 ?>" autocomplete='off'>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit">
                Simpan
            </button>
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