<?php
    if ($q->num_rows()>0){
        $dat = $q->row();
        $tindakan = $dat->tindakan;
        $koding = $dat->koding;
        $kode_diagnosis_fungsional = $dat->diagnosa_fungsional;
        $kode_diagnosis_medis = $dat->diagnosa_medis;
        $hasil = $dat->hasil;
        $kesimpulan = $dat->kesimpulan;
        $rekomendasi = $dat->rekomendasi;
        $action = "edit";
    } else {
        $tindakan = 
        $koding = 
        $kode_diagnosis_fungsional = 
        $kode_diagnosis_medis = 
        $hasil = 
        $kesimpulan = 
        $rekomendasi = "";
        $action = "simpan";
    }
?>
<script>
    $(document).ready(function(){
        getdiagnosis_fungsional();
        getdiagnosis_medis();
        getkoding();
        $('.back').click(function(){
           window.location = "<?php echo site_url('admindkk/ujifungsi');?>";
            
        });
        $("[name='diagnosis_fungsional']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>grouper/geticd10",
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
                $("[name='kode_diagnosis_fungsional']").val(n[0]);
                return n[1];
            }
        });
        $("[name='diagnosis_medis']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>grouper/geticd10",
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
                $("[name='kode_diagnosis_medis']").val(n[0]);
                return n[1];
            }
        });
        $("[name='koding_string']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>grouper/geticd9",
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
                $("[name='koding']").val(n[0]);
                return n[1];
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl_pemeriksaan']").datepicker({
            dateFormat : formattgl,
        });
    });
    function getkoding(){
        var kode = $("[name='koding']").val();
        $.ajax({
            url : "<?php echo base_url();?>pendaftaran/geticd9detail",
            method : "POST",
            data : {kode: kode},
            success: function(data){
                var n = JSON.parse(data);
                console.log(n);
                $("[name='koding_string']").val(n[0]["label"]);
            },
            error: function(data){
                console.log(data);
            }
        });
    }
    function getdiagnosis_fungsional(){
        var kode = $("[name='kode_diagnosis_fungsional']").val();
        $.ajax({
            url : "<?php echo base_url();?>pendaftaran/geticd10detail",
            method : "POST",
            data : {kode: kode},
            success: function(data){
                var n = JSON.parse(data);
                $("[name='diagnosis_fungsional']").val(n[0]["label"]);
            },
            error: function(data){
                console.log(data);
            }
        });
    }
    function getdiagnosis_medis(){
        var kode = $("[name='kode_diagnosis_medis']").val();
        $.ajax({
            url : "<?php echo base_url();?>pendaftaran/geticd10detail",
            method : "POST",
            data : {kode: kode},
            success: function(data){
                var n = JSON.parse(data);
                $("[name='diagnosis_medis']").val(n[0]["label"]);
            },
            error: function(data){
                console.log(data);
            }
        });
    }
</script>
<div class="col-md-12">
    <div class="box box-primary">
        <?php echo form_open("admindkk/simpanujifungsi/".$action);?>
        <input type="hidden" name="idlama" value="<?php echo $id;?>">
        <div class="box-body">
        	<div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-4 control-label">Lembar Hasil Tindakan Uji Fungsi/ Prosedur KFR</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name='tindakan' value="<?php echo $tindakan;?>"/>
                            <span class="input-group-btn"><button type="button" class="btn btn-primary text-bold">...</button></span>
                        </div>
                    </div>
                    <label class="col-md-1 control-label">Koding</label>
                    <div class="col-md-4">
                        <input type="hidden" name='koding' value="<?php echo $koding;?>"/>
                        <input type="text" class="form-control" name='koding_string' autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Diagnosis Fungsional</label>
                    <div class="col-md-4">
                        <input type="hidden" name='kode_diagnosis_fungsional' value="<?php echo $kode_diagnosis_fungsional;?>"/>
                        <input type="text" class="form-control" name='diagnosis_fungsional' autocomplete="off"/>
                    </div>
                    <label class="col-md-2 control-label">Diagnosis Medis</label>
                    <div class="col-md-4">
                        <input type="hidden" name='kode_diagnosis_medis' value="<?php echo $kode_diagnosis_medis;?>"/>
                        <input type="text" class="form-control" name='diagnosis_medis' autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Hasil Yang didapat</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name='hasil'><?php echo $hasil;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kesimpulan</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name='kesimpulan'><?php echo $kesimpulan;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Rekomendasi</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name='rekomendasi'><?php echo $rekomendasi;?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="simpan btn btn-success" type="submit"> Simpan</button>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
    </div>
</div>