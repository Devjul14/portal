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
            window.location = "<?php echo site_url('grouper/grouper_ralan');?>";
        });

        // $('.back').click(function(){
        //     var cari_noreg = $("[name='no_reg']").val();
        //     $.ajax({
        //         type  : "POST",
        //         data  : {cari_noreg:cari_noreg},
        //         url   : "<?php echo site_url('grouper/getcaripasien_ralan');?>",
        //         success : function(result){
        //             window.location = "<?php echo site_url('grouper/grouper_ralan');?>";
        //         },
        //         error: function(result){
        //             alert(result);
        //         }
        //     });
        // });
        $(".covid").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('perawat/cetakcovid');?>/"+no_rm+"/"+no_reg+"/igd";
            openCenteredWindow(url);
            return false;
        });
        $(".triage").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('dokter/cetaktriage');?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".assesment").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('dokter/cetakigd');?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_mata").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_mata')?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_tindakan").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var poli = $("[name='tujuan_poli']").val();
            window.location = "<?php echo site_url('pendaftaran/laporan_tindakan');?>/"+id+"/"+no_reg+"/"+poli;
            return false;
        });
        $(".cetakujifungsi").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetakujifungsi')?>/"+id+"/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".cetakujifungsi2").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetakujifungsi2')?>/"+id+"/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".cetakrehab").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetakrehab')?>/"+id+"/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_pterygium").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetak_pterygium')?>/"+no_reg;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_operasi").click(function(){
            var id = $("[name='no_rm']").val();
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
            if (no_sep==""){
                alert("Pasien belum memiliki SEP");
            } else {
                var url = "<?php echo site_url('sep/cetaksep');?>/"+no_reg+"/"+no_rm+"/"+no_bpjs+"/"+no_sep;
                openCenteredWindow(url);
            }
            return false;
        });
        $(".obat").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('grouper/apotek_ralan');?>/"+no_rm+"/"+no_reg;
            window.location = url;
            return false; 
        });
        $(".upload").click(function(){
            var no_rm = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            var url = "<?php echo site_url('grouper/formuploadpdf_ralan');?>/"+no_rm+"/"+no_reg;
            window.location = url;
            return false; 
        });
        $(".cppt").click(function(){
            var id = $("[name='no_rm']").val();
            var url = "<?php echo site_url('pendaftaran/cppt_ralan');?>/"+id;
            openCenteredWindow(url);
        });
        $(".view_pembayaran").click(function(){
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location = "<?php echo site_url('grouper/viewpembayaran_ralan')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisiradiologi").click(function(){
            
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('grouper/ekspertisiradiologi_ralan');?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisilab").click(function(){
            
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('grouper/ekspertisilab_ralan');?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisipa").click(function(){
            
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('grouper/ekspertisipa_ralan');?>/"+id+"/"+no_reg;
            return false;
        });
        $(".ekspertisigizi").click(function(){
            
            var id = $("[name='no_rm']").val();
            var no_reg = $("[name='no_reg']").val();
            window.location ="<?php echo site_url('grouper/ekspertisigizi_ralan');?>/"+id+"/"+no_reg;
            return false;
        });
        $('.pdf').click(function(){
            var no_sep = $("[name='no_sep']").val();
            if (no_sep==""){
                alert("Pasien belum memiliki SEP");
            } else {
                var url = "<?php echo site_url('grouper/claimprint_ralan');?>/"+no_sep;
                openCenteredWindow(url);
            }
        });
        $(".cetakresume").click(function(){
            var id = $("[name='no_rm']").val();
            var url = "<?php echo site_url('pendaftaran/cetakresume');?>/"+id;
            openCenteredWindow(url)
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
                    url : "<?php echo base_url();?>grouper/hapus_icd10",
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
                    url : "<?php echo base_url();?>grouper/hapus_icd9",
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
                    url : "<?php echo base_url();?>grouper/edit_urut",
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
                    url : "<?php echo base_url();?>grouper/simpan_icd10",
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
                    url : "<?php echo base_url();?>grouper/edit_icd10",
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
                    url : "<?php echo base_url();?>grouper/simpan_icd9",
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
                    url : "<?php echo base_url();?>grouper/edit_icd9",
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
                <?php echo form_open("grouper/newclaim_ralan");?>
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                        <input type="hidden" name='tujuan_poli' value="<?php echo $row->tujuan_poli;?>"/>
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
                    <label class="col-md-1 control-label">No. SEP</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_sep' value="<?php echo $row->no_sjp;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='tanggal' value="<?php echo $row->tanggal;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Lahir</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tgl_lahir' value="<?php echo ($row->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($row->tgl_lahir)));?>" autocomplete="off"/>
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
                        <button class="pdf btn btn-success" type="button">
                            <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;LIP
                        </button>
                        <button class="upload btn btn-primary" type="button">
                            <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF
                        </button>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="pull-right">
                        <div class="dropup">
                            <button class="dropbtn btn bg-maroon" type="button">ERM</button>
                            <div class="dropup-content">
                                <a class="triage"> Triage</a>
                                <a class="assesment"> Assesment Medis IGD</a>
                                <a class="perawat"> Assesment Keperawatan</a>
                                <a class="covid"> Covid</a>
                                <a class="cetaksep"> SEP</a>
                                <a class="cetakresume"> Resume</a>
                                <a class="cppt"> CPPT</a>
                                <a class="laporan_tindakan"> Laporan Tindakan</a>
                                <a class="laporan_operasi"> Laporan Operasi</a>
                                <a class="laporan_mata"> Laporan Ops Mata (Katarak)</a>
                                <a class="laporan_pterygium"> Laporan Ops Mata (Pterygium)</a>
                                <a class="cetakujifungsi"> Uji Fungsi</a>
                                <a class="cetakujifungsi2"> Permintaan Terapis</a>
                                <a class="cetakrehab"> Rehabilitas Rajal</a>
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
    <!--  <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
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
                        foreach($k->result() as $data){
                            $subtotal += $data->jumlah;
                            echo "<tr id='data' title='".($n++)."'>";
                            echo "<td>".($i++)."</td>";
                            echo "<td>".$data->nama_obat."<div class='pull-right'></div></td>";
                            echo "<td class='text-right'>".$data->qty."</td>";
                            echo "<td class='text-center'>".$data->satuan."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "</tr>";
                        }
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
      z-index: 99999;
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
</style>