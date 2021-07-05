<script>
    $(document).ready(function(){
        getdiagnosis_fungsional();
        getdiagnosis_medis();
        getkoding();
        getketerangansuspek();
        $(".kode_tarif").select2();
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_no:cari_noreg},
                url   : "<?php echo site_url('pendaftaran/getcaripasien');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('tr#data').dblclick(function(){
            var id = $(this).attr("href");
            $.ajax({
                type  : "POST",
                url   : "<?php echo site_url('pendaftaran/getujifungsidetail');?>/"+id,
                success : function(result){
                    var data = JSON.parse(result)[0];
                    $("[name='id_tindakan']").val(id);
                    $("[name='tindakan']").val(data.tindakan);
                    $("[name='koding']").val(data.koding);
                    $("[name='hasil']").val(data.hasil);
                    $("[name='rekomendasi']").val(data.rekomendasi);
                    $("[name='kesimpulan']").val(data.kesimpulan);
                    $("[name='kode_diagnosis_fungsional']").val(data.diagnosa_fungsional);
                    $("[name='kode_diagnosis_medis']").val(data.diagnosa_medis);
                    getdiagnosis_fungsional();
                    getdiagnosis_medis();
                    getkoding();
                    $(".modelujifungsi").modal("hide");
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.btnujifungsi').click(function(){
            $(".modelujifungsi").modal("show");
        });
        $("[name='suspek_kerja']").change(function(){
            getketerangansuspek();
        })
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
    function getketerangansuspek(){
        var suspek_kerja = $("[name='suspek_kerja']").val();
        if (suspek_kerja=="0"){
            $("[name='keterangan_suspek']").addClass("hide");
        } else {
            $("[name='keterangan_suspek']").removeClass("hide");
        }
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
    function getkoding(){
        var kode = $("[name='koding']").val();
        $.ajax({
            url : "<?php echo base_url();?>pendaftaran/geticd9detail",
            method : "POST",
            data : {kode: kode},
            success: function(data){
                var n = JSON.parse(data);
                $("[name='koding_string']").val(n[0]["label"]);
            },
            error: function(data){
                console.log(data);
            }
        });
    }
</script>
<?php
    $t1 = new DateTime('today');
    $t2 = new DateTime($row->tgl_lahir);
    $y  = $t1->diff($t2)->y;
    $m  = $t1->diff($t2)->m;
    $d  = $t1->diff($t2)->d;
    if ($q->num_rows()>0){
        $dat = $q->row();
        $id_tindakan = $dat->id_tindakan;
        $tindakan = $dat->tindakan;
        $koding = $dat->koding;
        $tgl_pemeriksaan = date("d-m-Y", strtotime($dat->tgl_pemeriksaan));
        $kode_diagnosis_fungsional = $dat->kode_diagnosis_fungsional;
        $kode_diagnosis_medis = $dat->kode_diagnosis_medis;
        $hasil = $dat->hasil;
        $kesimpulan = $dat->kesimpulan;
        $rekomendasi = $dat->rekomendasi;
        $evaluasi = $dat->evaluasi;
        $suspek_kerja = $dat->suspek_kerja;
        $keterangan_suspek = $dat->keterangan_suspek;
        $action = "edit";
        $kode_tarif = $dat->kode_tarif;
        $kt = explode(",",$kode_tarif);
    } else 
    if ($q1->num_rows()>0){
        $dat = $q1->row();
        $id_tindakan = $dat->id_tindakan;
        $tindakan = $dat->tindakan;
        $koding = $dat->koding;
        $tgl_pemeriksaan = date("d-m-Y");
        $kode_diagnosis_fungsional = $dat->kode_diagnosis_fungsional;
        $kode_diagnosis_medis = $dat->kode_diagnosis_medis;
        $hasil = $dat->hasil;
        $kesimpulan = $dat->kesimpulan;
        $rekomendasi = $dat->rekomendasi;
        $evaluasi = $dat->evaluasi;
        $suspek_kerja = $dat->suspek_kerja;
        $keterangan_suspek = $dat->keterangan_suspek;
        $action = "simpan";
        $kode_tarif = $dat->kode_tarif;
        $kt = explode(",",$kode_tarif);
    } else {
        $tgl_pemeriksaan = date("d-m-Y",strtotime($q2->tanggal));
        $id_tindakan = 
        $tindakan = 
        $koding = 
        $kode_diagnosis_fungsional = 
        $kode_diagnosis_medis = 
        $hasil = 
        $kesimpulan = 
        $rekomendasi = 
        $suspek_kerja = 
        $keterangan_suspek = 
        $kode_tarif = 
        $evaluasi = "";
        $action = "simpan";
    }
?>
<div class="col-md-12">
    <div class="box box-primary">
        <?php echo form_open("pendaftaran/simpanujifungsi/".$action);?>
        <div class="box-body">
        	<div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-4 control-label">Lembar Hasil Tindakan Uji Fungsi/ Prosedur KFR</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="hidden" name='id_tindakan' value="<?php echo $id_tindakan;?>"/>
                            <input type="text" class="form-control" readonly name='tindakan' value="<?php echo $tindakan;?>"/>
                            <span class="input-group-btn"><button type="button" class="btnujifungsi btn btn-primary text-bold">...</button></span>
                        </div>
                    </div>
                    <label class="col-md-1 control-label">Koding</label>
                    <div class="col-md-4">
                        <input type="hidden" name='koding' value="<?php echo $koding;?>"/>
                        <input type="text" class="form-control" name='koding_string' autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">No. RM</label>
                    <div class="col-md-4">
                        <input type="text" readonly class="form-control" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-4">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-4">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">L/ P</label>
                    <div class="col-md-4">
                        <input type="text" readonly class="form-control" name='jenis_kelamin' readonly value="<?php echo $row->jenis_kelamin;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tgl Lahir/ Usia</label>
                    <div class="col-md-4">
                        <input type="text" readonly class="form-control" name='tgl_lahir' readonly value="<?php echo date("d-m-Y",strtotime($row->tgl_lahir))."/ ".$y." tahun";?>"/>
                    </div>
                    <label class="col-md-2 control-label">Tgl Pemeriksaan</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name='tgl_pemeriksaan' value="<?php echo $tgl_pemeriksaan;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Alamat/ Telpon</label>
                    <div class="col-md-4">
                        <textarea type="text" class="form-control" name='alamat' readonly><?php echo $row->alamat." - ".$row->telpon;?></textarea>
                    </div>
                    <label class="col-md-2 control-label">Diagnosis Fungsional</label>
                    <div class="col-md-4">
                        <input type="hidden" name='kode_diagnosis_fungsional'  value="<?php echo $kode_diagnosis_fungsional;?>"/>
                        <input type="text" class="form-control" name='diagnosis_fungsional' autocomplete="off"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Diagnosis Medis</label>
                    <div class="col-md-4">
                        <input type="hidden" name='kode_diagnosis_medis' value="<?php echo $kode_diagnosis_medis;?>"/>
                        <input type="text" class="form-control" name='diagnosis_medis'/>
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
                <div class="form-group">
                    <label class="col-md-2 control-label">Tindakan</label>
                    <div class="col-md-10">
                        <select class="form-control kode_tarif" name='kode_tarif[]' multiple="multiple">
                            <?php 
                                foreach ($tarif as $kode_tindakan => $nama_tindakan) {
                                    $findme = strpos($kode_tarif, $kode_tindakan);
                                    echo "<option value='".$kode_tindakan."' ".($findme===false ? "" : "selected").">".$nama_tindakan."</option>";
                                }
                            ?>
                        <select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Evaluasi</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name='evaluasi'><?php echo $evaluasi;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Suspek Penyakit Akibat Kerja</label>
                    <div class="col-md-2">
                        <select name="suspek_kerja" class="form-control">
                            <option value="0" <?php echo ($suspek_kerja=="0" ? "selected" : "");?>>Tidak</option>
                            <option value="1" <?php echo ($suspek_kerja=="1" ? "selected" : "");?>>Ya</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <textarea type="text" class="form-control" name='keterangan_suspek'><?php echo $keterangan_suspek;?></textarea>
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
<div class="modal fade modelujifungsi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:80%">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                List Uji Fungsi
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead>
                            <tr class="bg-navy">
                                <th style="vertical-align:middle;" width="50">No</th>
                                <th style="vertical-align:middle;width:200px" class="text-center">Tindakan</th>
                                <th style="vertical-align:middle;width:200px" class="text-center">Koding</th>
                                <th style="vertical-align:middle;width:400px" class="text-center">Diagnosa Fungsional</th>
                                <th style="vertical-align:middle;width:900px" class="text-center">Diagnosa Medis</th>
                                <th style="vertical-align:middle;width:400px" class="text-center">Hasil</th>
                                <th style="vertical-align:middle;width:400px" class="text-center">Kesimpulan</th>
                                <th style="vertical-align:middle;width:400px" class="text-center">Rekomendasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $i=0;
                                foreach ($u->result() as $data) {
                                    $i++;
                                    echo "<tr id=data href='".$data->id."'>
                                            <td>".$i."</td>
                                            <td>".$data->tindakan."</td>
                                            <td>".$icd9[$data->koding]."</td>
                                            <td>".$icd[$data->diagnosa_fungsional]."</td>
                                            <td>".$icd[$data->diagnosa_medis]."</td>
                                            <td>".$data->hasil."</td>
                                            <td>".$data->kesimpulan."</td>
                                            <td>".$data->rekomendasi."</td>
                                        </tr>";
                                }
                            ?>
                        </tbody>
                </table>
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
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #f4f4f4;
    }
</style>