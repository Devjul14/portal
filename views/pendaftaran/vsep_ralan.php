<script>
    var mywindow;
    function openCenteredWindow(url) {
        var width = 1000;
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
        $("input[name='tglkejadian'],input[name='tglkunjungan2']").datepicker({
            dateFormat : formattgl,
        });
        kabupaten();
        kecamatan();
        $("[name='kdpropinsi']").change(function(){
            kabupaten();
            kecamatan();
        });
        $("[name='kdpropinsi']").select2();
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            var cari_norm = $("[name='no_rm']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_noreg:cari_noreg},
                url   : "<?php echo site_url('sep/getcaripasien_ralan');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $("[name='kdkabupaten']").change(function(){
            kecamatan();
        })
        $("[name='lakalantas']").change(function(){
            var status = $(this).val();
            if (status==0){
                $(".lakalantas").addClass("hide");
            } else {
                $(".lakalantas").removeClass("hide");
            }
            $("[name='kdpropinsi']").select2();
            $("[name='kdkabupaten']").select2();
            $("[name='kdkecamatan']").select2();
        });
        $(".cetak").click(function(){
            var no_reg = $("[name='no_reg']").val();
            var no_rm = $("[name='no_rm']").val();
            var no_bpjs = $("[name='no_bpjs']").val();
            var nosep = $("[name='nosep']").val();
            var ppkasal = $("[name='ppkasal']").val();
            var asalrujukan = $("[name='asalrujukan']").val();
            var n = ppkasal.split(" | ");
            var url = "<?php echo site_url('sep/cetaksep');?>/"+no_reg+"/"+no_rm+"/"+no_bpjs+"/"+nosep+"/"+asalrujukan+"/"+n[0];
            openCenteredWindow(url);
            return false;
        });
        $("[name='pilih']").change(function(){
            var status = $(this).val();
            if (status==1){
                $(".pilih").addClass("hide");
                $("[name='ppkasal']").val("");
            } else {
                $(".pilih").removeClass("hide");
            }
        });
        $("[name='ppkasal']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var kode2 = $("[name='asalrujukan']").val();
                var data = $.ajax({
                    url : "<?php echo base_url();?>sep/ppkasal/"+query+"/"+kode2,
                    method : "POST",
                    async: false,
                    data : {kode: query}
                }).responseText;
                data = JSON.parse(data);
                $.each(data.faskes, function(i, object) {
                    map[object.id] = object;
                    objects.push(object.kode+" | "+object.nama);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                return item;
            }
        });
        $("[name='diag_awal2']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>sep/diag_awal/"+query,
                    method : "POST",
                    async: false,
                    data : {kode: query}
                }).responseText;
                data = JSON.parse(data);
                $.each(data.diagnosa, function(i, object) {
                    map[object.id] = object;
                    objects.push(object.kode+" | "+object.nama);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                return item;
            }
        });
    });
    function kabupaten(){
        var propinsi = $("[name='kdpropinsi']").val();
        $.ajax({
            url : "<?php echo base_url();?>sep/kabupaten/"+propinsi,
            method : "POST",
            success: function(data){
                $('[name=kdkabupaten]').find('option').remove();
                $('[name=kdkabupaten]').append($('<option>', {
                        value: "",
                        text: "---Pilih Kabupaten---"
                    }));
                $.each(JSON.parse(data), function(i, object) {
                    $('[name=kdkabupaten]').append($('<option>', {
                        value: object.kode,
                        text: object.nama
                    }));
                });
                $("[name='kdpropinsi']").select2();
                $("[name='kdkabupaten']").select2();
                $("[name='kdkecamatan']").select2();
            }
        })
    }
    function kecamatan(){
        var kabupaten = $("[name='kdkabupaten']").val();
        $.ajax({
            url : "<?php echo base_url();?>sep/kecamatan/"+kabupaten,
            method : "POST",
            success: function(data){
                $('[name=kdkecamatan]').find('option').remove();
                $('[name=kdkecamatan]').append($('<option>', {
                        value: "",
                        text: "---Pilih Kecamatan---"
                    }));
                $.each(JSON.parse(data), function(i, object) {
                    $('[name=kdkecamatan]').append($('<option>', {
                        value: object.kode,
                        text: object.nama
                    }));
                });
                $("[name='kdpropinsi']").select2();
                $("[name='kdkabupaten']").select2();
                $("[name='kdkecamatan']").select2();
            }
        })
    }
</script>
<?php
    // var_dump($rujukan); 
    $pelayanan = isset($rujukan->pelayanan->kode) ? $rujukan->pelayanan->kode : "";
    $hakkelas = isset($rujukan->peserta->hakKelas->kode) ? $rujukan->peserta->hakKelas->kode : "";
    $tglkunjungan = isset($rujukan->tglKunjungan) ? $rujukan->tglKunjungan : "";
    $norujukan = isset($rujukan->noKunjungan) ? $rujukan->noKunjungan : "";
    $provperujuk = isset($rujukan->provPerujuk->kode) ? $rujukan->provPerujuk->kode : "";
    $diag_awal = isset($rujukan->diagnosa->kode) ? $rujukan->diagnosa->kode : "";
    $polirujukan = isset($rujukan->poliRujukan->kode) ? $rujukan->poliRujukan->kode : "";
    $cob = isset($rujukan->peserta->cob->noAsuransi) ? ($rujukan->peserta->cob->noAsuransi==null ? 0 : 1) : "";
?>
<div class="col-md-12">
    <?php 
        if($this->session->flashdata('message')){
            $pesan=explode('|', $this->session->flashdata('message'));
            echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>".$pesan[1]."</b>
            </div>";
        }
    ?>
    <div class="box box-primary">
        <?php echo form_open("sep/getsep");?>
        <div class="box-body">
        	<div class="form-horizontal">
                <input type="hidden" name='telpon' value="<?php echo $row->telpon;?>"/>
                <input type="hidden" name="jenis" value="<?php echo $row->jenis;?>">
                <input type="hidden" name='diag_awal' value="<?php echo $diag_awal;?>"/>
                <input type="hidden" name="pelayanan" value="<?php echo $pelayanan;?>">
                <input type="hidden" name="hakkelas" value="<?php echo $hakkelas;?>">
                <input type="hidden" name="tglkunjungan" value="<?php echo $tglkunjungan;?>">
                <input type="hidden" name="norujukan" value="<?php echo $norujukan;?>">
                <input type="hidden" name="provperujuk" value="<?php echo $provperujuk;?>">
                <input type="hidden" name="polirujukan" value="<?php echo $polirujukan;?>">
				<input type="hidden" name="dpjp" value="<?php echo $row->dokter_poli;?>">
                <input type="hidden" name="cob" value="<?php echo $cob;?>">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. BPJS</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_bpjs' readonly value="<?php echo $row->no_bpjs;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Asal Rujukan</label>
                    <div class="col-md-2">
                        <select class="form-control" name="asalrujukan">
                            <option value="1">Faskes 1</option>
                            <option value="2">Faskes 2</option>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Kecelakaan lalu lintas</label>
                    <div class="col-md-2">
                        <select class="form-control" name="lakalantas">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Pilih</label>
                    <div class="col-md-2">
                        <select class="form-control" name="pilih">
                            <option value="1">Rujukan</option>
                            <option value="2">Rujukan Manual/ IGD</option>
                        </select>
                    </div>
                    <div class="pilih hide">
                        <label class="col-md-2 control-label">Diagnosa Awal</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name='diag_awal2' autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group pilih hide">
                    <label class="col-md-2 control-label">Tanggal Kunjungan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tglkunjungan2' value='<?php echo date("d-m-Y");?>'/>
                    </div>
                    <label class="col-md-2 control-label">PPK Asal Pasien</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name='ppkasal' autocomplete="off"/>
                    </div>
                </div>
                <div class="lakalantas hide">
                <div class="form-group">
                    <label class="col-md-2 control-label">Penjamin</label>
                    <div class="col-md-2">
                        <select class="form-control" name="penjamin">
                            <option value="1">Jasa raharja PTPJS</option>
                            <option value="2">BPJS Ketenagakerjaana</option>
                            <option value="3">TASPEN PT</option>
                            <option value="4">ASABRI PT</option>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Tanggal Kejadian</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tglkejadian' autocomplete="off"  value="<?php echo date("d-m-Y");?>"/>
                    </div>
                    <label class="col-md-2 control-label">Keterangan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='keterangan'/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Suplesi</label>
                    <div class="col-md-2">
                        <select class="form-control" name="suplesi">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">No. Suplesi</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nosepsuplesi'/>
                    </div>
                    <label class="col-md-2 control-label">Kode Propinsi</label>
                    <div class="col-md-2">
                        <select class="form-control" name="kdpropinsi">
                            <?php
                                foreach($propinsi as $key => $value){
                                    echo "<option value='".$value->kode."'>".$value->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kode Kabupaten</label>
                    <div class="col-md-2">
                        <select class="form-control" name="kdkabupaten">
                            
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Kode Kecamatan</label>
                    <div class="col-md-2">
                        <select class="form-control" name="kdkecamatan"></select>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-3">
                    <div class="pull-left">
                        <div class="input-group">
                            <input type="text" name="nosep" class="form-control" value="<?php echo $row->no_sjp;?>" <?php echo ($row->no_sjp!="" ? "readonly" : "");?>>
                            <span class="input-group-btn">
                              <button type="button" class="cetak btn btn-info btn-flat">Print</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="pull-right">
                        <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
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