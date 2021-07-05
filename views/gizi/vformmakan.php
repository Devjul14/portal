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
           var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $("[name='bayarsharing'], [name='disc_nominal'], [name='sharing']").mask('000.000.000', {reverse: true});
        $("table#form td:even").css("text-align", "right");
        $("table#form td:odd").css("background-color", "white");
        $("[name='waktu']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var tanggal= $("[name='tanggal']").val();
            var wak= $("[name='wak']").val();
            var waktu= $(this).val();
            // alert(no_reg);
            $.ajax({
                url : "<?php echo base_url();?>gizi/addtindakan_makan",
                method : "POST",
                data : {no_reg: no_reg, waktu: waktu,tanggal: tanggal,wak: wak},
                // data : {waktu: waktu},
                success: function(data){
                     location.reload();
                }
            });
        });
        $('.cetak').click(function(){
            var url = "<?php echo site_url('gizi/cetakmakan');?>/";
            openCenteredWindow(url);
        });
        $('.barcode').click(function(){
            var url = "<?php echo site_url('gizi/cetakbarcode');?>/";
            openCenteredWindow(url);
        });
        $('.back').click(function(){
            window.location = "<?php echo site_url('gizi/inap');?>";
        });
        $('.hapusmakan').click(function(){
            window.location = "<?php echo site_url('gizi/hapusmakan');?>";
        });
        $('.search').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var no_pasien= $("[name='no_rm']").val();
            var tanggal = $("input[name='tanggal']").val();
            window.location = "<?php echo site_url('gizi/detailpa_inap');?>/"+no_pasien+"/"+no_reg+"/"+tanggal;
        });
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>gizi/hapusinap",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $("[name='waktu']").select2();
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('id');
            if (dataText.hasClass("jumlah")){
                var jenis = "jumlah";
            } else 
            if (dataText.hasClass("nofoto")){
                var jenis = "nofoto";
            } else 
            if (dataText.hasClass("ukuranfoto")){
                var jenis = "ukuranfoto";
            } else 
            if (dataText.hasClass("menu")){
                jenis = "menu";
            } else 
            if (dataText.hasClass("dokter_pengirim")){
                jenis = "dokter_pengirim";
            } else 
            if (dataText.hasClass("diet")){
                jenis = "diet";
            }
            if (jenis=='menu'){
                var kd = dataText.attr('kd');
                var result = getmenu(kd);
                var dataInputField = $(result);
            } else 
            if (jenis=='dokter_pengirim'){
                var id_dokter = dataText.attr('id_dokter');
                var result = getdokter_pengirim(id_dokter);
                var dataInputField = $(result);
            }
            else
            if (jenis=='diet'){
                var diet = dataText.attr('diet');
                var result = getdiet(diet);
                var dataInputField = $(result);
            }
            else
                var dataContent = dataText.text().trim();
            dataText.before(dataInputField).hide();
            if (jenis=='menu' || jenis=='diet' || jenis=='dokter_pengirim'){
                dataInputField.select2();
                dataInputField.focus().select().change(function(){
                    var inputval = dataInputField.val()
                    changeData(inputval,kode,jenis);
                    $(this).remove();
                    dataText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        var inputval = dataInputField.val()
                        changeData(inputval,kode,jenis);
                        $(this).remove();
                        dataText.show();
                    }
                });
            } else {
                var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
                dataText.before(dataInputField).hide();
                dataInputField.focus().blur(function(){
                    if (jenis=="jumlah")
                        var inputval = dataInputField.val().replace(/\D/g,'');
                    else
                       var inputval = dataInputField.val(); 
                    changeData(inputval,kode,jenis);
                    $(this).remove();
                    dateText.show();
                }).keyup(function(evt) {
                    if (evt.keyCode == 13) {
                        if (jenis=="jumlah")
                            var inputval = dataInputField.val().replace(/\D/g,'');
                        else
                            var inputval = dataInputField.val();
                        changeData(inputval,kode,jenis);
                        $(this).remove();
                        dateText.show();
                    }
                });
            }
        });
     
        $("[name='pengirim']").select2();
    });
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var sharing = $("[name='sharing']").val().replace(/\D/g,'');
        var total = subtotal-disc_nominal-sharing;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    var changeData = function(value,id,jenis){
        var no_reg= $("[name='no_reg']").val();
        $.ajax({
            url: "<?php echo site_url('gizi/changedata_makan');?>/"+jenis, 
            type: 'POST', 
            data: {id: id,value: value,no_reg:no_reg}, 
            success: function(){
                location.reload();
            }
        });
    };
    function getmenu(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('gizi/getmenu');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='menu' class='selectmenu form-control'>";
                html += "<option value=''>---Pilih Menu Makan---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.kd+"' "+(val==value.kd ? "selected" : "")+">"+value.ket+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getdokter_pengirim(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('gizi/getdokter');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='dokter_pengirim' class='selectpengirim form-control'>";
                html += "<option value=''>---Pilih menu/Dokter---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.id_dokter+"' "+(val==value.id_dokter ? "selected" : "")+">"+value.nama_dokter+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
    function getdiet(val){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('gizi/getdiet');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='diet' class='selectdiet form-control'>";
                html += "<option value=''>---Pilih Diet Makan---</option>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.kd+"' "+(val==value.kd ? "selected" : "")+">"+value.ket+"</option>";
                })
                html += "</select>";
                result = html;
            }
        });
        return result;
    };
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
    <div class="box box-primary">
        <div class="box-body">
            <?php
                 // echo form_open("gizi/simpandetail_inap/".$aksi,array("id"=>"formsave","class"=>"form-horizontal"));
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tanggal</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name='tanggal' autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <select class="form-control" name="waktu" <?php echo $disabled;?>>
                        <option value="" align="text-center">---Pilih Waktu Makan---</option>
                        <?php 
                            foreach ($t->result() as $key) {
                                echo '<option value="'.$key->kode.'">'.$key->makan.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        	
                
                </div>
            </div>
        </div>
        <!-- <div class="box-footer">
            <div class="pull-right">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div> -->
        <?php //echo form_close(); ?>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
                        <th width="100" class='text-center'>Tanggal</th>
                        <th class="text-center">Waktu</th>
                        <th class='text-center'>Nomor REG</th>
                        <th >Nama</th>
                        <th class='text-center'>Ruangan</th>
                        <th class='text-center'>Kelas</th>
                        <th class='text-center'>Kamar</th>
                        <th class='text-center'>No. Bed</th>
                        <th class="text-center">Diet</th>
                        <th class="text-center">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach($q3->result() as $data){
                        	if($data->tgw == ''){
                        		$tanggal1 = "--";
                        	}
                        	else{
                        		$tanggal1 = date("d-m-Y",strtotime($data->tgw));
                        	}
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td>".$tanggal1."</td>";
                            echo "<td class='text-center'>".$data->waktu."</td>";
                            echo "<input type='hidden' class='form-control' name='wak' id='".$data->waktu."' value='".$data->waktu."'></td>";
                            echo "<td class='no_reg text-center'>".$data->no_reg."";
                            // echo "<input type='hidden' name='no_reg' class='text-center' value='".$data->no_reg."'></td>";
                            echo "<input type='hidden' class='form-control' name='no_reg' id='".$data->no_reg."' value='".$data->no_reg."'></td>";
                            echo "<td>".$data->nama_pasien."</td>";
                            echo "<td>".$data->nama_ruangan."</td>";
                            echo "<td>".$data->nama_kelas."</td>";
                            echo "<td>".$data->kode_kamar."</td>";
                            echo "<td>".$data->no_bed."</td>";
                            echo "<td class='text-left'><a href='#' class='diet dataChange' id='".$data->no_reg."' diet='".$data->diet."'>".($data->diet=="" ? "--Pilih Diet data--" : (isset($diet[$data->diet]) ? $diet[$data->diet] : "--Pilih Diet data--") )."</a></td>";
                            echo "<td class='text-left'><a href='#' class='menu dataChange' id='".$data->no_reg."' menu='".$data->menu."'>".($data->menu=="" ? "--Pilih Menu data--" : (isset($menu[$data->menu]) ? $menu[$data->menu] : "--Pilih Menu Makan--") )."</a></td>";
                            echo "</tr>";
                            // echo "<td>".$data->nama_tindakan.($aksi=='simpan' ? 
                            //     "<div class='pull-right'>
                            //         <button id='".$data->id."' class='hapus btn btn-sm btn-danger'>
                            //             <i class='fa fa-minus'></i>
                            //         </div>":"")."</td>";
                            // echo "<td class='text-left'><a href='#' class='petugas dataChange' id='".$data->id."/".$data->tanggal."/".$data->pemeriksaan."' id_dokter='".$data->kode_petugas."'>".($data->kode_petugas=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter[$data->kode_petugas]) ? $dokter[$data->kode_petugas] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            // echo "<td class='text-left'><a href='#' class='petugas_gizi dataChange' id='".$data->id."/".$data->tanggal."/".$data->pemeriksaan."' petugas_gizi='".$data->analys."'>".($data->analys=="" ? "---Pilih Petugas Gizi---" : (isset($petugas_gizi[$data->analys]) ? $petugas_gizi[$data->analys] : "---Pilih Petugas Gizi---") )."</a></td>";
                            // echo "<td class='text-right'><a href='#' class='dataChange nofoto' id='".$data->id."'>".($data->nofoto=="" ? "-" : $data->nofoto)."</a></td>";
                            // echo "<td class='text-right'><a href='#' class='dataChange ukuranfoto' id='".$data->id."'>".($data->ukuranfoto=="" ? "-" : $data->ukuranfoto)."</a></td>";
                            // echo "<td class='text-left'><a href='#' class='dokter_pengirim dataChange' id='".$data->id."/".$data->tanggal."/".$data->pemeriksaan."' id_dokter='".$data->dokter_pengirim."'>".($data->dokter_pengirim=="" ? "---Pilih Petugas/Dokter---" : (isset($dokter_pengirim[$data->dokter_pengirim]) ? $dokter_pengirim[$data->dokter_pengirim] : "---Pilih Petugas/Dokter---") )."</a></td>";
                            // echo "<td class='text-right'><a href='#' class='dataChange jumlah' id='".$data->id."'>".number_format($data->jumlah,0,'.','.')."</a></td>";
                            
                        }
                    ?>
                </tbody>
                
                <tfoot>
                    <tr class="bg-navy">
                        <th colspan="12">Jumlah Pasien : <?php echo $total_rows;?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="row">
                
                <div class="col-sm-1">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="cetak btn btn-info" type="button">Cetak</button>
                            <button class="barcode btn btn-success" type="button">Barcode</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="pull-left">
                        <div class="btn-group">
                            <button class="hapusmakan btn btn-danger" type="button">Hapus</button>
                        </div>
                    </div>
                </div>


                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
            </div>
        </div>
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
</style>