<link rel="stylesheet" href="<?php echo base_url();?>plugins/select2/select2.css">
<script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
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
        var diagnosa = $("[name='diagnosa']").val();
        namadiagnosa(diagnosa,"nama_diagnosa");
        $("[name='nama_diagnosa']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                $("[name='diagnosa']").val('');
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>pendaftaran/getdiagnosa1",
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
                $("[name='diagnosa']").val(n[0]);
                return n[1];
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='ulangan']").datepicker({
            dateFormat : formattgl,
        });

        $(".cetak").click(function(){
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_laporantindakaninap');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_noreg:cari_noreg},
                url   : "<?php echo site_url('pendaftaran/getcaripasien_ralan');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.addtindakan').click(function(){
            var tindakan = $("[name='tindakan']").val();
            var pemeriksaanke = $("[name='pemeriksaanke']").val();
            var tanggal = $("[name='tanggal']").val();
            var jam_masuk = $("[name='jam_masuk']").val();
            var jam_keluar = $("[name='jam_keluar']").val();
            var ulangan = $("[name='ulangan']").val();
            $.ajax({
                type  : "POST",
                data  : {tindakan:tindakan,pemeriksaanke: pemeriksaanke, tanggal: tanggal, jam_masuk: jam_masuk, jam_keluar: jam_keluar, ulangan: ulangan},
                url   : "<?php echo site_url('pendaftaran/tmbtindakan');?>",
                success : function(result){
                    location.reload();
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.hpstindakan').click(function(){
            var kode = $(this).attr("kode");
            $.ajax({
                type  : "POST",
                data  : {kode:kode},
                url   : "<?php echo site_url('pendaftaran/hpstindakan');?>",
                success : function(result){
                    location.reload();
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        // $("[name='diagnosa']").select2();
        $(".tindakan").select2();
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");


    });
    function namadiagnosa(kode,element){
        var data = $.ajax({
                        url : "<?php echo base_url();?>pendaftaran/namadiagnosa",
                        method : "POST",
                        async: false,
                        data : {kode: kode}
                    }).responseText;
        $("[name='"+element+"']").val(data);
    }
</script>
<?php
    $t1 = new DateTime('today');
    $t2 = new DateTime($q->tgl_lahir);
    $y  = $t1->diff($t2)->y;
    $m  = $t1->diff($t2)->m;
    $d  = $t1->diff($t2)->d;
    if($q){
        // $nama = $q->nama;
    } else {

    }
?>
<div class="col-md-12">
    <div class="box box-primary">
        <?php
            echo form_open("pendaftaran/simpanlaporan_tindakaninap",array("id"=>"formsave","class"=>"form-horizontal"));
        ?>
        <div class="form-horizontal">
            <div class="box-body">
            	<div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_pasien' readonly value="<?php echo $q->nama_pasien;?>"/>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="col-md-2 control-label">Poliklinik</label>
                    <div class="col-md-20">
                        <input type="hidden" class="form-control" name='kode_poli' readonly value="<?php echo $row->tujuan_poli;?>"/>
                        <input type="text" class="form-control" name='poliklinik' readonly value="<?php echo $row->poli;?>"/>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-md-2 control-label">Tgl Lahir / Umur</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_pasien' readonly value="<?php echo $q->tgl_lahir.' / '.$y;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='ruangan' readonly value="<?php echo $q->nama_ruangan;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='nama_pasien' readonly value="<?php echo $q->nama_kelas?>"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label">Diagnosa</label>
                    <div class="col-md-2">
                        <input type="hidden" class="form-control" name='diagnosa'  value="<?php echo $q->diagnosa?>"/>
                        <input type="text" class="form-control" name='nama_diagnosa' autocomplete="off"/>
                    </div>
                    <label class="col-md-2 control-label">Dokter</label>
                    <div class="col-md-2">
                        <select name="dokter" class="form-control">
                            <?php
                                foreach ($dokter->result() as $key) {
                                    echo "<option value='".$key->id_dokter."' ".($q->dokter_operasi==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Asisten</label>
                    <div class="col-md-2">
                        <select name="asisten" class="form-control">
                            <?php
                                foreach ($asisten->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($q->asisten_operasi==$key->kode ? "selected" : "").">".$key->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <label class="col-md-2 control-label">Jenis Anestesi</label>
                    <div class="col-md-2">
                        <select name="jenis_anastesi" class="form-control">
                            <?php
                                foreach ($anastesi->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($q->jenis_anastesi==$key->kode ? "selected" : "").">".$key->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Pemeriksaan Penunjang</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='pemeriksaan_penunjang' value="<?php echo $q->pemeriksaan_penunjang;?>"/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Tindakan</label>
                  <div class="col-md-2">
                      <select name="tindakan" class="form-control tindakan">
                          <?php
                              foreach ($tindakan->result() as $key) {
                                echo "<option value='".$key->kode_tindakan."'>".$key->nama_tindakan."</option>";
                              }
                          ?>
                      </select>
                  </div>
                  <label class="col-md-2 control-label">Pemeriksaan ke</label>
                  <div class="col-md-2">
                      <input type="number" class="form-control" name='pemeriksaanke'/>
                  </div>
                  <label class="col-md-2 control-label">Tanggal</label>
                  <div class="col-md-2">
                      <input type="text" class="form-control" autocomplete="off" name='tanggal'/>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jam Masuk</label>
                    <div class="col-md-2">
                        <input type="time" class="form-control" name='jam_masuk'/>
                    </div>
                    <label class="col-md-2 control-label">Jam Keluar</label>
                    <div class="col-md-2">
                        <input type="time" class="form-control" name='jam_keluar'/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal Ulangan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" autocomplete="off" name='ulangan'/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">&nbsp;</div>
                    <div class="col-md-2"><button type="button" class="addtindakan btn btn-primary btn-sm">Add Tindakan</button></div>
                </div>
                <?php if ($this->session->userdata("temptindakan")!="") : ?>
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <tr class="bg-navy">
                              <th>Tindakan</th>
                              <th class='text-center'>Pemeriksaan</th>
                              <th class='text-center'>Tanggal</th>
                              <th class='text-center'>Jam Masuk</th>
                              <th class='text-center'>Jam Keluar</th>
                              <th class='text-center'>Tgl Ulangan</th>
                            </tr>
                            <?php
                              $temp = $this->session->userdata("temptindakan");
                              foreach ($temp as $key => $value) {
                                echo "<tr>";
                                echo "<td>".$tdk[$value["tindakan"]]."&nbsp;<button type='button' kode='".$value["tindakan"]."' class='hpstindakan btn btn-danger btn-sm'><i class='fa fa-minus'></i></button></td>";
                                echo "<td class='text-center'>".$value["pemeriksaanke"]."</td>";
                                echo "<td class='text-center'>".$value["tanggal"]."</td>";
                                echo "<td class='text-center'>".$value["jam_masuk"]."</td>";
                                echo "<td class='text-center'>".$value["jam_keluar"]."</td>";
                                echo "<td class='text-center'>".$value["ulangan"]."</td>";
                                echo "</tr>";
                              }
                            ?>
                        </table>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <label class="col-md-1 control-label">Keterangan</label>
                    <div class="col-md-11">
                        <input type="text" class="form-control" name='keterangan' value="<?php echo $q->keterangan;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label">Laporan</label>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea name="laporan_operasi" cols="175" class="form-control" rows="10"><?php echo $q->laporan_operasi?></textarea>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button class="cetak btn btn-success" type="button"> Cetak</button>
                    <button class="btn btn-primary" type="submit"> Simpan</button>
                    <button class="back btn btn-warning" type="button"> Back</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="modal fade modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-navy">Yakin akan membayar sejumlah</div>
                <div class="modal-body">
                    <h2 class="total"></h2>
                </div>
                <div class="modal-footer">
                    <button class="okbayar btn btn-success" type="button">OK</button>
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
        color: #fff;
    }
</style>
