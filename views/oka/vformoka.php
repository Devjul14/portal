<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 700;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function() {
        // $("[name='diagnosa']").select2();
        // $("[name='post_diagnosa']").select2();
        $("[name='klasifikasi']").select2();
        $("[name='dokter_operasi']").select2();
        $("[name='dokter_operasi2']").select2();
        $("[name='dokter_anastesi']").select2();
        $("[name='kamar_operasi']").select2();
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        var diagnosa = $("[name='diagnosa']").val();
        namadiagnosa(diagnosa,"nama_diagnosa");
        var post_diagnosa = $("[name='post_diagnosa']").val();
        namadiagnosa(post_diagnosa,"nama_post_diagnosa");
        var post_diagnosa2 = $("[name='post_diagnosa2']").val();
        namadiagnosa(post_diagnosa2,"nama_post_diagnosa2");
        var operasi = $("[name='operasi']").val();
        namaoperasi(operasi,"nama_operasi");
        $(".cetak").click(function(){
            var kode_oka = $("[name='kode_oka']").val();
            var url = "<?php echo site_url('oka/cetak')?>/"+kode_oka;
            openCenteredWindow(url);            
            return false;
        });
        $(".simpan_laporan").click(function(){
            var laporan = $("[name='laporan']").val();
            var kode_oka = $("[name='kode_oka']").val();
            var arrayData = {laporan: laporan};
            $.ajax({
                url: "<?php echo site_url('oka/laporan');?>/"+kode_oka, 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                    // window.location = "<?php echo site_url('oka/laporan');?>/"+kode_oka;
                }
            });
        });
        $(".simpan_komplikasi").click(function(){
            var komplikasi = $("[name='komplikasi']").val();
            var kode_oka = $("[name='kode_oka']").val();
            var arrayData = {komplikasi: komplikasi};
            $.ajax({
                url: "<?php echo site_url('oka/komplikasi');?>/"+kode_oka, 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                    // window.location = "<?php echo site_url('oka/komplikasi');?>/"+kode_oka;
                }
            });
        });
        $(".simpan_intruksi").click(function(){
            var intruksi = $("[name='intruksi']").val();
            var kode_oka = $("[name='kode_oka']").val();
            var arrayData = {intruksi: intruksi};
            $.ajax({
                url: "<?php echo site_url('oka/intruksi');?>/"+kode_oka, 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                    // window.location = "<?php echo site_url('oka/intruksi');?>/"+kode_oka;
                }
            });
        });
        $(".cancel").click(function(){
            window.location = "<?php echo site_url('oka')?>";
            return false;
        });
        $("[name='laporan']").typeahead(function(){
            var laporan = $(this).val();
            $("[name = 'laporan_n']").val(laporan);
        });
        $(".laporan").click(function(){
            $(".laporan_m").show();
        });
        $(".tidak_laporan").click(function(){
            $(".laporan_m").hide();
        });
        $(".komplikasi").click(function(){
            $(".komplikasi_m").show();
        });
        $(".tidak_komplikasi").click(function(){
            $(".komplikasi_m").hide();
        });
        $(".intruksi").click(function(){
            $(".intruksi_m").show();
        });
        $(".tidak_intruksi").click(function(){
            $(".intruksi_m").hide();
        });
        $(".laporan_mata").click(function(){
            var kode_oka = $("[name='kode_oka']").val();
            window.location = "<?php echo site_url('oka/laporan_mata');?>/"+kode_oka;
            return false;
        });
        $(".pterygium").click(function(){
            var kode_oka = $("[name='kode_oka']").val();
            window.location = "<?php echo site_url('oka/laporan_pterygium');?>/"+kode_oka;
            return false;
        });
        $("[name='no_rm']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var pelayanan = $("[name='pelayanan']").val();
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>oka/getpasien",
                        method : "POST",
                        async: false,
                        data : {no_rm: query,pelayanan: pelayanan}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.no_rm] = object;
                        if (pelayanan == "RALAN") {
                            objects.push(object.no_reg+" | "+object.no_rm+" | "+object.nama_pasien +" | "+object.jk +" | "+object.poliklinik+" | "+object.jenis+" | "+object.kode_poli);
                        }
                        else{
                            objects.push(object.no_reg+" | "+object.no_rm+" | "+object.nama_pasien +" | "+object.jk +" | "+object.kode_ruangan+"-"+object.nama_ruangan+" | "+object.kode_kelas+"-"+object.nama_kelas+" | "+object.nama_kamar+" | "+object.no_bed);   
                        }
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                var pelayanan = $("[name='pelayanan']").val();
                if (pelayanan == "RALAN") {
                    $("[name='no_rm']").val(n[1]);
                    $("[name='no_reg']").val(n[0]);
                    $("[name='nama']").val(n[2]);
                    $("[name='jk']").val(n[3]);
                    $("[name='klinik']").val(n[4]);
                    $("[name='kode_poli']").val(n[6]);
                    $("[name='jenis']").val(n[5]);
                    // if($("[name='jk']").val(n[3]) == "L"){
                    //         $("[name='jk']").val(n[3]).val("Laki - Laki");
                    // }
                    // else{
                    //         $("[name='jk']").val(n[3]).val("Perempuan");   
                    // }
                }else{
                    $("[name='no_rm']").val(n[1]);
                    $("[name='no_reg']").val(n[0]);
                    $("[name='nama']").val(n[2]);
                    $("[name='jk']").val(n[3]);
                    var r = n[4].split("-");
                    $("[name='kode_ruangan']").val(r[0]);
                    $("[name='ruangan']").val(r[1]);
                    var k = n[5].split("-");
                    $("[name='kode_kelas']").val(k[0]);
                    $("[name='kelas']").val(k[1]);
                    $("[name='kamar']").val(n[6]);
                    $("[name='no_bed']").val(n[7]);
                    // if($("[name='jk']").val(n[3]) == "L"){
                    //         $("[name='jk']").val(n[3]).val("Laki - Laki");
                    // }
                    // else{
                    //         $("[name='jk']").val(n[3]).val("Perempuan");   
                    // }
                }
                    
                return n[1];
            }
        });
        $("[name='nama_operasi']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var pelayanan = $("[name='pelayanan']").val();
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>oka/getoperasi",
                        method : "POST",
                        async: false,
                        data : {kode: query, pelayanan: pelayanan}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.kode] = object;
                        objects.push(object.kode+" | "+object.nama_tindakan+" | "+object.id_cabang_operasi);
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='operasi']").val(n[0]);
                $("[name='nama_operasi']").val(n[1]);
                $("[name='jenis_operasi']").val(n[2]);
                return n[1];
            }
        });
        $("[name='nama_diagnosa']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                $("[name='diagnosa']").val('');
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>oka/getdiagnosa_operasi",
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
        $("[name='nama_post_diagnosa']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                $("[name='post_diagnosa']").val('');
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>oka/getdiagnosa_operasi",
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
                $("[name='post_diagnosa']").val(n[0]);
                return n[1];
            }
        });
        $("[name='nama_post_diagnosa2']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>oka/getdiagnosa_operasi",
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
                $("[name='post_diagnosa2']").val(n[0]);
                return n[1];
            }
        });

    });
    function namadiagnosa(kode,element){
        var data = $.ajax({
                        url : "<?php echo base_url();?>oka/namadiagnosa",
                        method : "POST",
                        async: false,
                        data : {kode: kode}
                    }).responseText;
        $("[name='"+element+"']").val(data);
    }
    function namaoperasi(kode,element){
        var pelayanan = $("[name='pelayanan']").val();
        var data = $.ajax({
                        url : "<?php echo base_url();?>oka/namaoperasi",
                        method : "POST",
                        async: false,
                        data : {kode: kode,pelayanan: pelayanan}
                    }).responseText;
        $("[name='"+element+"']").val(data);
    }
</script>
    <?php 
        if($q){
            $kode_oka = $q->kode_oka;
            $no_rm = $q->no_rm;
            $no_reg = $q->no_reg;
            $nama = $q->nama;
            $jk = $q->jk;
            $jenis = $q->jenis;
            $kode_poli = $q->kode_poli;
            $klinik = $q->klinik;
            $ruangan = $q->nama_ruangan;
            $kode_kelas = $q->kelas;
            $kelas = $q->nama_kelas;
            $kamar = $q->kamar;
            $diagnosa_pre = $q->diagnosa;
            $diagnosa_post = $q->diagnosa_post;
            $jam_anastesi = $q->jam_anastesi;
            $jam_masuk = $q->jam_masuk;
            $jam_keluar = $q->jam_keluar;
            $operasi = $q->operasi;
            $jenis_operasi = $q->jenis_operasi;
            $dokter_operasi = $q->dokter_operasi;
            $dokter_anastesi = $q->dokter_anastesi;
            $kamar_operasi1 = $q->kamar_operasi;
            $asisten_operasi = $q->asisten_operasi;
            $asisten_operasi2 = $q->asisten_operasi2;
            $asisten_anastesi = $q->asisten_anastesi;
            $asisten_anastesi2 = $q->asisten_anastesi2;
            $jenis_anastesi = $q->jenis_anastesi;
            $klasifikasi1 = $q->klasifikasi;
            $komplikasi = $q->komplikasi;
            $laporan = $q->laporan;
            $intruksi = $q->intruksi;
            $diagnosa_post2 = $q->diagnosa_post2;
            $operasi2 = $q->operasi2;
            $dokter_operasi2 = $q->dokter_operasi2;
            $tanggal = $q->tanggal;
            $jenis_pemeriksaan = $q->jenis_pemeriksaan;
            $asa = $q->asa;
            $no_bed = $q->no_bed;
            $action = "edit";
            if ($q->pelayanan =="RALAN") {
                $ralan = "selected";
                $inap = "";
            }else{
                $ralan = "";
                $inap = "selected";
            }
        }
        else{
            $kode_oka =
            $no_rm =
            $no_reg =
            $nama =
            $jk =
            $kode_poli = 
            $klinik =
            $ruangan =
            $kode_kelas = 
            $kelas =
            $jenis = 
            $kamar =
            $diagnosa_pre =
            $diagnosa_post = "";
            $jam_anastesi = date("H:i:s");
            $jam_masuk = date("H:i:s");
            $jam_keluar =
            $operasi =
            $jenis_operasi =
            $dokter_operasi =
            $dokter_anastesi =
            $kamar_operasi1 =
            $asisten_operasi =
            $asisten_operasi2 =
            $asisten_anastesi =
            $asisten_anastesi2 =
            $jenis_anastesi =
            $komplikasi =
            $laporan =
            $intuksi =
            $diagnosa_post2 =
            $operasi2 =
            $dokter_operasi2 = "";
            $tanggal = date("d-m-Y");
            $jenis_pemeriksaan =
            $asa = 
            $no_bed = 
            $ralan =
            $inap =
            $klasifikasi1 = "";
            $action = "simpan";
        }
    ?>
    <style> 
      .dropbtn {
      color: white;
      padding: 14px,8px,14px,8px;
      font-size: 14px;
      border: none;
    }

    .dropup {
      position: relative;
      display: inline-block;
    }

    .dropup-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      bottom: 31px;
      z-index: 1;
    }

    .dropup-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropup-content a:hover {background-color: #ccc}

    .dropup:hover .dropup-content {
      display: block;
    }

    </style>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
    		<div class="form-horizontal">
                <?php
                    echo form_open("oka/simpanoka/".$action, array("id"=>"formsave","class"=>"form-horizontal"));
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Pelayanan</label>
                    <div class="col-md-2">
                        <select class="form-control" name="pelayanan">
                            <option value="RALAN" <?php echo $ralan?>>RAWAT JALAN</option>
                            <option value="RANAP" <?php echo $inap?>>RAWAT INAP</option>
                        </select>
                    </div>  
                    <label class="col-md-2 control-label">NO RM</label>
                    <div class="col-md-2">
                        <input type="hidden" name="kode_oka" value="<?php echo $kode_oka ?>">
                        <input type="hidden" name="jenis" value="<?php echo $jenis ?>">
                        <input type="text" name="no_rm" autocomplete="off" class="form-control" value="<?php echo $no_rm ?>">
                    </div>  
                    <label class="col-md-2 control-label">NO REG</label>
                    <div class="col-md-2">
                        <input type="text" name="no_reg" readonly class="form-control" value="<?php echo $no_reg ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Nama</label>
                    <div class="col-md-2 control-label">
                        <input type="text" name="nama" readonly class="form-control" value="<?php echo $nama ?>">
                    </div>  
                    <label class="col-md-2 control-label">JK</label>
                    <div class="col-md-2 control-label">
                        <input type="text" name="jk" readonly class="form-control" value="<?php echo $jk ?>">
                    </div>  
                    <label class="col-md-2 control-label">Klinik</label>
                    <div class="col-md-2 control-label">
                        <input type="hidden" name="kode_poli" value="<?php echo $kode_poli;?>">
                        <input type="text" name="klinik" readonly class="form-control" value="<?php echo $klinik ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2 control-label">
                        <input type="hidden" name="kode_ruangan">
                        <input type="text" name="ruangan" readonly class="form-control" value="<?php echo $ruangan ?>">
                    </div>  
                    <label class="col-md-2 control-label">Kelas</label>
                    <div class="col-md-2 control-label">
                        <input type="hidden" name="kode_kelas" value="<?php echo $kode_kelas;?>">
                        <input type="text" name="kelas" readonly class="form-control" value="<?php echo $kelas ?>">
                    </div>  
                    <label class="col-md-2 control-label">Kamar</label>
                    <div class="col-md-2 control-label">
                        <input type="hidden" name="no_bed" value="<?php echo $no_bed ?>">
                        <input type="text" name="kamar" readonly class="form-control" value="<?php echo $kamar ?>">
                    </div>  
                </div>
                <div class="form-group">
                    <?php 
                        $time = date("H:i:s");
                    ?>
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2 control-label">
                        <input type="text" name="tanggal" value ="<?php echo date("d-m-Y", strtotime($tanggal)) ?>" class="form-control">
                    </div>  
                    <label class="col-md-1 control-label">Jam Anastesi</label>
                    <div class="col-md-2 control-label">
                        <input type="time" name="jam_anastesi" value ="<?php echo $jam_anastesi; ?>" class="form-control">
                    </div>  
                    <label class="col-md-1 control-label">Jam Masuk</label>
                    <div class="col-md-2 control-label">
                        <input type="time" name="jam_masuk" value ="<?php echo $jam_masuk; ?>" class="form-control">
                    </div>  
                    <label class="col-md-1 control-label">Jam Keluar</label>
                    <div class="col-md-2 control-label">
                        <input type="time" name="jam_keluar" value ="<?php echo $jam_keluar; ?>" class="form-control">
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
                    <label class="col-md-6 control-label">Diagnosa Pre Operasi</label>
                    <div class="col-md-6 control-label">
                        <input type="hidden" name="diagnosa" value="<?php echo $diagnosa_pre ?>">
                        <input type="text" name="nama_diagnosa" autocomplete="off" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Diagnosa Post Operasi</label>
                    <div class="col-md-6 control-label">
                        <input type="hidden" name="post_diagnosa" value="<?php echo $diagnosa_post ?>">
                        <input type="text" name="nama_post_diagnosa" autocomplete="off" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Diagnosa Post Operasi 2</label>
                    <div class="col-md-6 control-label">
                        <input type="hidden" name="post_diagnosa2" value="<?php echo $diagnosa_post2 ?>">
                        <input type="text" name="nama_post_diagnosa2" autocomplete="off" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Klasifikasi</label>
                    <div class="col-md-6 control-label">
                        <select name="klasifikasi" class="form-control">
                            <?php 
                                foreach ($klasifikasi->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($klasifikasi1==$key->kode ? "selected" : "").">".$key->nama."</option>";
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
            <h3 class="box-title">OPERASI</h3>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-6 control-label">Operasi</label>
                    <div class="col-md-6 control-label">
                        <input type="hidden" name="operasi" value="<?php echo $operasi ?>">
	                    <input type="text" name="nama_operasi" autocomplete="off" class="form-control">
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Operasi 2</label>
                    <div class="col-md-6 control-label">
                        <select name="operasi2" class="form-control">
                            <option value=""></option>
                            <?php 
                                foreach ($tarif_operasi->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($operasi2==$key->kode ? "selected" : "").">".$key->nama_tindakan."</option>";
                                }
                            ?>
                        </select>
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Jenis Operasi</label>
                        <div class="col-md-6 control-label">
                            <input type="text" name="jenis_operasi" class="form-control" value="<?php echo $jenis_operasi ?>" readonly>
                        </div>    
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Kamar Operasi</label>
                    <div class="col-md-6 control-label">
                        <select name="kamar_operasi" class="form-control">
                            <?php 
                                foreach ($kamar_operasi->result() as $key) {
                                    echo "<option value='".$key->nama."' ".($kamar_operasi1==$key->nama ? "selected" : "").">".$key->nama."</option>";
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
            <h3 class="box-title">OPERASI</h3>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-6 control-label">Dokter Operasi</label>
                    <div class="col-md-6 control-label">
                        <select name="dokter_operasi" class="form-control">
                            <?php 
                                foreach ($dokter->result() as $key) {
                                    echo "<option value='".$key->id_dokter."' ".($dokter_operasi==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Dokter Operasi 2</label>
                    <div class="col-md-6 control-label">
                        <select name="dokter_operasi2" class="form-control">
                            <option value=""></option>
                            <?php 
                                foreach ($dokter->result() as $key) {
                                    echo "<option value='".$key->id_dokter."' ".($dokter_operasi2==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                        </select>
                    </div>   
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Asisten Operasi 1</label>
                    <div class="col-md-6 control-label">
                        <select name="asisten_operasi" class="form-control">
                            <option value=""></option>
                            <?php 
                                foreach ($asisten_op->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($asisten_operasi==$key->kode ? "selected" : "").">".$key->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Asisten Operasi 2</label>
                    <div class="col-md-6 control-label">
                        <select name="asisten_operasi2" class="form-control">
                            <option value=""></option>
                            <?php 
                                foreach ($asisten_op->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($asisten_operasi2==$key->kode ? "selected" : "").">".$key->nama."</option>";
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
            <h3 class="box-title">ANASTESI</h3>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-6 control-label">Jenis Anastesi</label>
                    <div class="col-md-6 control-label">
                        <select name="jenis_anastesi" class="form-control">
                            <?php 
                                foreach ($jenis_anatesi->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($jenis_anastesi==$key->kode ? "selected" : "").">".$key->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Dokter Anastesi</label>
                    <div class="col-md-6 control-label">
                        <select name="dokter_anastesi" class="form-control">
                            <?php 
                                foreach ($dokter_anastesi1->result() as $key) {
                                    echo "<option value='".$key->id_dokter."' ".($dokter_anastesi==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                        </select>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Asisten Anastesi 1</label>
                    <div class="col-md-6 control-label">
                        
                        <select name="asisten_anastesi" class="form-control">
                            <option value=""></option>
                            <?php 
                                foreach ($asisten_an->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($asisten_anastesi==$key->kode ? "selected" : "").">".$key->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">Asisten Anastesi 2</label>
                    <div class="col-md-6 control-label">
                        <select name="asisten_anastesi2" class="form-control">
                            <option value=""></option>
                            <?php 
                                foreach ($asisten_an->result() as $key) {
                                    echo "<option value='".$key->kode."' ".($asisten_anastesi2==$key->kode ? "selected" : "").">".$key->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-md-6 control-label">ASA</label>
                    <div class="col-md-6 control-label">
                        
                        <select name="asa" class="form-control">
                            <option value=""></option>
                            <?php 
                                for ($i=1;$i<=5;$i++) {
                                    echo "<option value='".$i."' ".($asa==$i ? "selected" : "").">".$i."</option>";
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
            <div class="form-horizontal">   
                    <div class="form-group">   
                        <div class="col-md-6">   
                            <h3 class="box-title">PEMERIKSAAN</h3>
                        </div>
                        <div class="col-md-6">   
                            <select name="pemeriksaan" id="" class="form-control">
                                <option value="Tidak">Tidak Ada</option>
                                <option value="Ya PA">Patologi Anatomi</option>
                                <option value="Ya Cairan">Cairan</option>
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
            <div class="form-horizontal">   
                <div class="form-group">  
                    <div class="col-md-3">
                        <h4>Jenis</h4>
                    </div>
                    <div class="col-md-9">   
                        <input type="text" class="form-control" name="jenis_pemeriksaan" value="<?php echo $jenis_pemeriksaan?>">
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
                <?php if ($action=="edit"):?>
                <button class="cetak btn btn-success"><i class="fa fa-print"></i> Cetak</button>
                <?php endif ?>
                <!-- <button class="laporan_mata btn btn-primary" type="button"><i class="fa fa-file"></i> Laporan Mata</button> -->
                <div class="dropup">
                    <button class="dropbtn btn btn-primary" type="button"><i class="fa fa-file"></i> Laporan Mata</button>
                    <div class="dropup-content">
                        <a class="laporan_mata">Katarak</a>
                        <a class="pterygium">Pterygium</a>
                    </div>
                </div>
                <button class="laporan btn btn-warning" type="button"><i class="fa fa-file"></i> Laporan Operasi</button>
                <button class="komplikasi btn bg-maroon" type="button"><i class="fa fa-file"></i> Komplikasi</button>
                <button class="intruksi btn bg-teal" type="button"><i class="fa fa-file"></i> Intruksi Pasca Operasi</button>
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="cancel btn btn-danger" type="button"><i class="fa fa-times"></i> Cancel</button>
                </div>
                <textarea class="form-control hidden" name="laporan_n" style="max-width: 100%;height:300px;"><?php echo $laporan ?></textarea>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<div class='modal laporan_m'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION !</h4></div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12 control-label">Laporan Operasi</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="laporan" style="max-width: 100%;height:300px;"><?php echo $laporan ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button class="simpan_laporan btn btn-sm btn-success">Simpan</button>
                <button class="tidak_laporan btn btn-sm btn-warning">Keluar</button>
            </div>
        </div>
    </div>
</div>

<div class='modal komplikasi_m'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION !</h4></div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12 control-label">Komplikasi</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="komplikasi" style="max-width: 100%;height:300px;"><?php echo $komplikasi ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button class="simpan_komplikasi btn btn-sm btn-success">Simpan</button>
                <button class="tidak_komplikasi btn btn-sm btn-warning">Keluar</button>
            </div>
        </div>
    </div>
</div>

<div class='modal intruksi_m'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION !</h4></div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12 control-label">Intruksi Pasca Operasi</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="intruksi" style="max-width: 100%;height:300px;"><?php echo $intruksi ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button class="simpan_intruksi btn btn-sm btn-success">Simpan</button>
                <button class="tidak_intruksi btn btn-sm btn-warning">Keluar</button>
            </div>
        </div>
    </div>
</div>