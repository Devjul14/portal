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
            var backpage = "<?php echo $backpage;?>";
            if (backpage=="kasir"){
                var no_rm = $("[name='no_rm']").val();
                var no_reg = $("[name='no_reg']").val();
                window.location = "<?php echo site_url('kasir/viewpembayaran_inap');?>/"+no_rm+"/"+no_reg;
            } else {
                window.location = "<?php echo site_url('grouper/grouper_inap');?>";
            }
        });
        $(".obat").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('grouper/apotek_inap');?>/"+no_rm+"/"+no_reg;
            window.location = url;
            return false;
        });
        // $('.back').click(function(){
        //     var cari_noreg = $("[name='no_reg']").val();
        //     $.ajax({
        //         type  : "POST",
        //         data  : {cari_noreg:cari_noreg},
        //         url   : "<?php echo site_url('grouper/caripasien_inap');?>",
        //         success : function(result){
        //             window.location = "<?php echo site_url('grouper/grouper_inap');?>";
        //         },
        //         error: function(result){
        //             alert(result);
        //         }
        //     });
        // });
        $(".triage").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('dokter/cetaktriage');?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".assesment").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var id_dokter = $("[name='id_dokter']").val();
            var url = "<?php echo site_url('dokter/cetakigdinap');?>/"+no_reg+"/"+id_dokter;
            openCenteredWindow(url);
            return false;
        });
        $(".perawat").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('perawat/cetakassesmen');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".covid").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('perawat/cetakcovid');?>/"+no_rm+"/"+no_reg+"/ranap";
            openCenteredWindow(url);
            return false;
        });
        $(".konfirmasi_covid").click(function() {
            var no_pasien = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('persetujuan/cetakkonfirmasi_covid'); ?>/" + no_reg + "/" + no_pasien;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_tindakan").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location = "<?php echo site_url('pendaftaran/laporan_tindakaninap');?>/"+no_rm+"/"+no_reg;
            return false;
        });
        $(".laporan_mata").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_mata')?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_pterygium").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_pterygium')?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".erm_sebabkematian").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('dokter/cetaksebabkematian');?>/"+no_reg+"/"+no_rm;
            openCenteredWindow(url);
            // var status_pulang = $("[name='status_pulang']").val();
            // if (status_pulang==4){
            //   var url = "<?php echo site_url('dokter/cetaksebabkematian');?>/"+no_reg+"/"+no_rm;
            //   openCenteredWindow(url);
            // } else {
            //   alert("Status pasien tidak meninggal");
            // }
        });
        $(".konfirmasi_covid").click(function() {
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('persetujuan/cetakkonfirmasi_covid'); ?>/" + no_reg + "/" + no_rm;
            openCenteredWindow(url);
            return false;
            // var no_pasien = $(".bg-gray").attr("href");
            // var no_reg = $(".bg-gray").attr("no_reg");
            // var url = "<?php echo site_url('persetujuan/forminsert_petugas'); ?>/"+no_reg+"/"+no_pasien+"/"+"U";
            // openCenteredWindow(url);
            // return false;
        });
        $(".cppt").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cppt_ranap');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
        });
        $(".laporan_operasi").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_operasi')?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".cetaksep").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var no_bpjs = $("[name='no_bpjs']").val();
            var no_sep = $("[name='no_sep']").val();
            if (no_sep=="")
                alert("No SEP belum ada");
            else {
                var url = "<?php echo site_url('sep/cetaksep_inap');?>/"+no_reg+"/"+no_rm+"/"+no_bpjs+"/"+no_sep;
                openCenteredWindow(url);
            }
            return false;
        });
        $(".view_pembayaran").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location = "<?php echo site_url('grouper/viewpembayaran_inap')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisiradiologi").click(function(){

            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('grouper/ekspertisiradiologi_inap');?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisilab").click(function(){

            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('lab/ekspertisi_inap');?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisipa").click(function(){

            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('grouper/ekspertisipa_inap');?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisigizi").click(function(){

            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('grouper/ekspertisigizi_inap');?>/"+id+"/"+no_reg;
            return false;
        });
        $('.pdf').click(function(){
            var no_sep = $("[name='no_sep']").val();
            if (no_sep==""){
                alert("Pasien belum memiliki SEP");
            } else {
                var url = "<?php echo site_url('grouper/claimprint_inap');?>/"+no_sep;
                openCenteredWindow(url);
            }
        });
        $(".upload").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('grouper/formuploadpdf_inap');?>/"+no_rm+"/"+no_reg;
            window.location = url;
            return false;
        });
        var kode_kelas_bpjs = $("[name='kode_kelas_bpjs']").val();
        var kode_kamar = $("[name='kamar']").val();
        if (kode_kelas_bpjs!="vip"){
            $("[name='add_payment_pct']").val("0");
            $("[name='add_payment_pct']").attr("readonly","readonly");
        } else {
            // $("[name='add_payment_pct']").val("0");
            $("[name='add_payment_pct']").attr("readonly",false);
        }
        if (kode_kamar!="BAYI"){
            $("[name='birth_weight']").val("0");
            $("[name='birth_weight']").attr("readonly","readonly");
        }
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
        $("[name='dpjp']").select2();
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
                    url : "<?php echo base_url();?>grouper/hapus_inap_icd10",
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
                    url : "<?php echo base_url();?>grouper/hapus_inap_icd9",
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
                    url : "<?php echo base_url();?>grouper/edit_urut_inap",
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
                console.log(item);
                var n = item.split(" | ");
                var no_reg= $("[name='no_reg']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>grouper/simpan_inap_icd10",
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
                var no_reg= $("[name='no_reg']").val();
                var id= $("[name='id']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>grouper/edit_inap_icd10",
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
        $(".resume").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('dokter/cetakresumeinap')?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".ringkasan").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetakringkasan')?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $("[name='icd9']").typeahead({
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
                var no_reg= $("[name='no_reg']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>grouper/simpan_inap_icd9",
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
                var no_reg= $("[name='no_reg']").val();
                var id= $("[name='id']").val();
                var kode = n[0];
                $.ajax({
                    url : "<?php echo base_url();?>grouper/edit_inap_icd9",
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
                <?php echo form_open("grouper/newclaim_inap");?>
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="hidden" name='kode_kelas_bpjs' value="<?php echo $row->kode_kelas_bpjs;?>"/>
                        <input type="hidden" name='kode_kelas' value="<?php echo $row->kode_kelas;?>"/>
                        <input type="hidden" name='kode_ruangan' value="<?php echo $row->kode_ruangan;?>"/>
                        <input type="hidden" name='naik_kelas' value="<?php echo $row->naik_kelas;?>"/>
                        <input type="hidden" name='backpage' value="<?php echo $backpage;?>"/>
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_ruangan' readonly value="<?php echo $row->nama_ruangan;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_kelas' value="<?php echo $row->nama_kelas;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kamar</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='kamar' value="<?php echo $row->kode_kamar;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">No. BPJS</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_bpjs' readonly value="<?php echo $row->no_bpjs;?>"/>
                    </div>
                    <label class="col-md-2 control-label">No. SEP</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_sep' value="<?php echo $row->no_sjp;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tanggal' value="<?php echo ($row->tgl_masuk=="" ? "" : date("d-m-Y",strtotime($row->tgl_masuk)));?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Lahir</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tgl_lahir' value="<?php echo ($row->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($row->tgl_lahir)));?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal Pulang</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tgl_keluar' value="<?php echo ($row->tgl_keluar=="" ? "" : date("d-m-Y",strtotime($row->tgl_keluar)));?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-2 control-label">DPJP</label>
                    <input type="hidden" name="id_dokter" value="<?php echo $row->dokter;?>">
                    <div class="col-md-2">
                        <select name="dpjp" class="form-control">
                            <?php
                                foreach ($dokter->result() as $key) {
                                    echo "<option value='".$key->id_dokter."' ".($row->dpjp===$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Add Payment PCT</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='add_payment_pct' value="<?php echo $row->add_payment_pct;?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-2 control-label">Birth Weight</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='birth_weight' value="<?php echo $row->birth_weight;?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-2 control-label">Hak Kelas</label>
                    <div class="col-md-2">
                        <select name="hak_kelas" class="form-control">
                            <option value="1" <?php echo ($row->hak_kelas=="1" ? "selected" : "");?>>Kelas 1</option>
                            <option value="2" <?php echo ($row->hak_kelas=="2" ? "selected" : "");?>>Kelas 2</option>
                            <option value="3" <?php echo ($row->hak_kelas=="3" ? "selected" : "");?>>Kelas 3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Status Pulang</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='status_pulang' readonly value="<?php echo $row->ket_status_pulang;?>" autocomplete="off"/>
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
                        echo "<a href='#' class='dat' id='".$i."' kode='".$key->id."'>".$icd10[$key->kode]."&nbsp;<b>".$key->kode."</b></a>";
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
                        if ($key->kode!=""){
                            $i++;
                            echo "<li>";
                            echo "<a href='#' class='dat2' id='".$i."' kode='".$key->id."'>".$icd9[$key->kode]."&nbsp;<b>".$key->kode."</b></a>";
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
                    }
                ?>
            </ul>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-2">
                    <div class="pull-left">
                        <button class="pdf btn btn-success" type="button"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;LIP</button>
                        <button class="upload btn btn-primary" type="button">
                            <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF
                        </button>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="pull-right">
                        <!-- <button class="back btn btn-warning" type="submit"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Grouper</button> -->
                        <div class="dropup">
                            <button class="dropbtn btn bg-maroon">ERM</button>
                            <div class="dropup-content">
                                <a class="triage"> Triage</a>
                                <a class="assesment"> Assesment Medis IGD</a>
                                <a class="perawat"> Assesment Keperawatan</a>
                                <a class="covid"> Covid</a>
                                <a class="konfirmasi_covid"> Cetak Konfirmasi Covid</a>
                                <a class="cetaksep"> SEP</a>
                                <a class="cppt"> CPPT</a>
                                <a class="laporan_tindakan"> Laporan Tindakan</a>
                                <a class="laporan_operasi"> Laporan Operasi</a>
                                <a class="resume"> Resume</a>
                                <a class="ringkasan"> Ringkasan Masuk & Keluar</a>
                                <a class="laporan_mata"> Laporan Ops Mata (Katarak)</a>
                                <a class="laporan_pterygium"> Laporan Ops Mata (Pterygium)</a>
                                <a class="erm_sebabkematian"> Sebab Kematian</a>
                                <a class="konfirmasi_covid"> Cetak Konfirmasi Covid</a>
                            </div>
                        </div>
                        <div class="btn-group">
                            <!-- <button class="laporan_tindakan btn btn btn-primary" type="button"> Laporan Tindakan</button>
                            <button class="laporan_operasi btn btn-warning" type="button">Laporan Operai</button>
                            <button class="laporan_mata btn btn-info" type="button">Laporan Ops Mata</button> -->
                            <button class="obat btn btn-success" type="button"> Obat</button>
                            <button class="view_pembayaran btn bg-teal" type="button"><i class="fa fa-dollar"></i> Billing</button>
                            <button class="ekspertisigizi btn bg-navy" type="button">Gizi</button>
                            <button class="ekspertisipa btn bg-yellow" type="button">PA</button>
                            <button class="ekspertisilab btn bg-aqua" type="button">Lab</button>
                            <button class="ekspertisiradiologi btn bg-green" type="button">Radiologi</button>
                        </div>
                        <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-object-group"></i>&nbsp;&nbsp;Grouper</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
                        <th width=100 class="text-center">Tanggal</th>
                        <th class="text-center">Nama Obat</th>
                        <th width=80 class="text-center">Qty</th>
                        <th width=100 class="text-center">Satuan</th>
                        <th width="150" class='text-center'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1; $n = 1;
                        $subtotal = 0;
                        $tgl1_print = $tgl2_print = "";
                        foreach($k->result() as $data){
                            $tgl1_print = $tgl1_print=="" ? date("d-m-Y",strtotime($data->tanggal)) : $tgl1_print;
                            $tgl2_print = date("d-m-Y",strtotime($data->tanggal));
                            $subtotal += $data->jumlah;
                            echo "<tr id='data' title='".($n++)."'>";
                            echo "<td>".($i++)."</td>";
                            echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                            echo "<td>".$data->nama_obat."<div class='pull-right'></div></td>";
                            echo "<td class='text-right'>".$data->qty."</td>";
                            echo "<td class='text-center'>".$data->satuan."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                        $tgl1_print = $tgl1_print=="" ? date("d-m-Y") : $tgl1_print;
                        $tgl2_print = $tgl2_print=="" ? date("d-m-Y") : $tgl2_print;
                    ?>
                </tbody>
            </table>
        </div>
    </div> -->
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-horizontal">
                    <?php
                        $total = 0;
                        foreach ($g1->result() as $key) {
                            $jml = (isset($hasil[$key->kode]) ? $hasil[$key->kode] : 0);
                            $tarif11 = (isset($hasil["tarif11"]) ? $hasil["tarif11"] : 0);
                            if ($key->kode=="tarif05") $jml -= $tarif11;
                            $total += $jml;
                            echo '<div class="form-group">';
                            echo '    <label class="col-md-6 control-label">'.$key->keterangan.'</label>';
                            echo '    <div class="col-md-6">';
                            echo '        <div class="input-group">';
                            echo '          <span class="input-group-addon">Rp.</span>';
                            echo '          <input type="text" readonly class="form-control text-right" name="'.$key->kode_bpjs.'" value="'.number_format($jml,0,',','.').'"/>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-horizontal">
                    <?php
                        foreach ($g2->result() as $key) {
                            $jml = (isset($hasil[$key->kode]) ? $hasil[$key->kode] : 0);
                            $tarif11 = (isset($hasil["tarif11"]) ? $hasil["tarif11"] : 0);
                            if ($key->kode=="tarif05") $jml -= $tarif11;
                            $total += $jml;
                            echo '<div class="form-group">';
                            echo '    <label class="col-md-5 control-label">'.$key->keterangan.'</label>';
                            echo '    <div class="col-md-7">';
                            echo '        <div class="input-group">';
                            echo '          <span class="input-group-addon">Rp.</span>';
                            echo '          <input type="text" readonly class="form-control text-right" name="'.$key->kode_bpjs.'" value="'.number_format($jml,0,',','.').'"/>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-horizontal">
                    <?php
                        foreach ($g3->result() as $key) {
                            $jml = (isset($hasil[$key->kode]) ? $hasil[$key->kode] : 0);
                            $tarif11 = (isset($hasil["tarif11"]) ? $hasil["tarif11"] : 0);
                            if ($key->kode=="tarif05") $jml -= $tarif11;
                            $total += $jml;
                            echo '<div class="form-group">';
                            echo '    <label class="col-md-5 control-label">'.$key->keterangan.'</label>';
                            echo '    <div class="col-md-7">';
                            echo '        <div class="input-group">';
                            echo '          <span class="input-group-addon">Rp.</span>';
                            echo '          <input type="text" readonly class="form-control text-right" name="'.$key->kode_bpjs.'" value="'.number_format($jml,0,',','.').'"/>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-horizontal">
                        <div class="form-group text-bold">
                            <label class="col-md-3 control-label">TOTAL</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="text" name="total" readonly class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>"/>
                                </div>
                            </div>
                        </div>
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
      min-width: 250px;
      bottom: 31px;
      z-index: 1;
    }

    .dropup-content a {
      color: black;
      padding: 5px 16px;
      text-decoration: none;
      display: block;
    }

    .dropup-content a:hover {background-color: #ccc}

    .dropup:hover .dropup-content {
      display: block;
    }

    /*.dropup:hover .dropbtn {
      background-color: #2980B9;
    }*/
</style>
