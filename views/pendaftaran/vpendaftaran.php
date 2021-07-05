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
        var id_layanan = $("select[name='id_layanan']").val();
        var status_pembayaran = $("select[name='status_pembayaran']").val();
        $("#karcis").load("<?php echo site_url('pendaftaran/karcis')?>/"+id_layanan+"/"+status_pembayaran);
        $(".save").click(function(){
            $("#formsave").trigger("submit");
            return false;
        });
        $(".cari").click(function(){
            var id = $("select[name='id_puskesmas']").val();
            var url = "<?php echo site_url('pendaftaran/caripasien');?>/"+id;
            openCenteredWindow(url);
            return false;
        });
        $("select[name='id_layanan']").change(function(){
            var id_layanan = $(this).val();
            var status_pembayaran = $("select[name='status_pembayaran']").val();
            $("#karcis").load("<?php echo site_url('pendaftaran/karcis')?>/"+id_layanan+"/"+status_pembayaran);
            return false;
        });
        $("select[name='status_pembayaran']").change(function(){
            var id_layanan = $("select[name='id_layanan']").val();
            var status_pembayaran = $(this).val();
            $("#karcis").load("<?php echo site_url('pendaftaran/karcis')?>/"+id_layanan+"/"+status_pembayaran);
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
                dateFormat : formattgl,
                autoclose: true
            });
        $(':input.nama_pasien').typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = <?php echo json_encode($q5); ?>// Or get your JSON dynamically and load it into this variable
                $.each(data, function(i, object) {
                    map[object.label] = object;
                    objects.push(object.label);
                });
                process(objects);
            },
            updater: function(item) {
                $("input.nama_pasien").val(map[item].label);
                $("input.id_pasien").val(map[item].id);
                var id_pasien = map[item].id;
                var url = "<?php echo site_url('pendaftaran/getdetailpasien');?>/"+id_pasien;
                $("#detail_pasien").load(url);
                changeData('id_pasien',id_pasien);
                return map[item].label;
            }
        });   
        $(".caripasien").click(function(){
            var cari = $("input[name='id_card']").val();
            changeData('id_card',cari);
        });
        $("input[name='id_card']").keypress(function(event){
            if ( event.which == 13 ) {
                $(".caripasien").click();
            }
        });
    });
    var changeData = function(strkode,strcari){
    var arrayData = {kode: strkode, cari:strcari};
    $.ajax({
        url: "<?php echo site_url('pendaftaran/datapasien');?>", 
        type: 'POST', 
        data: arrayData, 
        success: function(b){
            switch (strkode){
                case 'id_card' :
                    if (b==""){
                        alert("Data Tidak Ditemukan");
                        location.reload();
                    } else {
                        var pasien = b.split("-");
                        var url = "<?php echo site_url('pendaftaran/getdetailpasien');?>/"+pasien[0];
                        $("input.nama_pasien").val(pasien[1]);
                        $("#detail_pasien").load(url);
                    }
                break;
                case 'id_pasien' :
                    $("input[name='id_card']").val(b);
                break;
            }
        }
    });
};
</script>
<div class="col-xs-12">
    <?php
        if($this->session->flashdata('message')){
            $pesan=explode('-', $this->session->flashdata('message'));
            echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <b>".$pesan[1]."</b>
            </div>";
        }
    ?>
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open("pendaftaran/simpanpendaftaran",array("id"=>"formsave","class"=>"form-horizontal"));?>
                <div class="form-group"><label class="col-sm-2 control-label">Tgl Daftar</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="tanggal" value="<?php echo date('d-m-Y');?>"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Asal Klinik</label>
                    <div class="col-sm-10">
                        <select name="id_puskesmas" class="form-control">
                        <?php 
                            foreach($q1->result() as $row){
                                echo "<option value='".$row->id_puskesmas."'>".$row->nama_puskesmas."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Asal Pasien</label>
                    <div class="col-sm-10">
                        <select name="asal_pasien"  class="form-control">
                        <?php 
                            foreach($q4->result() as $row){
                                echo "<option value='".$row->id."'>".$row->asal_pasien."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Nama KK</label>
                    <div class="col-sm-10"><span id=nama_kk><input type="text" class="form-control" name="namakk" disabled></span></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">ID Card</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                        <input type="text" class="form-control" name="id_card" autocomplete="off">
                        <span class="input-group-btn"> <button type="button" class="caripasien btn btn-primary"><i class="fa fa-search"></i></button> </span>
                        </div>
                    <!-- <input type="text" class="form-control" name="id_card" autocomplete="off"><button class="caripasien btn btn-success  dim" type="button"><i class="fa fa-search"></i></button> -->
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Nama Pasien</label>
                    <div class="col-sm-10"><input type="text" class="form-control nama_pasien" name="nama_pasien" autocomplete="off"><input type="hidden" name="id_pasien" class='input-left id_pasien' autocomplete="off"></div>
                </div>
                <span id="detail_pasien">
                <div class="form-group"><label class="col-sm-2 control-label">No. Pasien</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="no_pasien"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Pembayaran</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="pembayaran"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="alamat"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Kecamatan</label>
                    <div class="col-sm-10"><input type="text" class="form-control" name="kecamatan"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Kelurahan</label>
                    <div class="col-sm-10"><input type="text" class="form-control"  name="kelurahan"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">RW</label>
                    <div class="col-sm-10"><input type="text" class="form-control"  name="rw"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Status Pembayaran</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-6">
                                <select name="status_pembayaran" class="form-control">
                                <?php 
                                    foreach($q3->result() as $row){
                                        echo "<option value='".$row->status_pembayaran."'>".$row->status_pembayaran."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-6"><span id='karcis'></span></div>
                        </div>
                    </div>
                </div>
                </span>
                <div class="form-group"><label class="col-sm-2 control-label">Layanan</label>
                    <div class="col-sm-10">
                        <select name="id_layanan" class="form-control m-b">
                        <?php 
                            foreach($q2->result() as $row){
                                echo "<option value='".$row->id_layanan."'>".$row->layanan."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>                
        </div>
        <div class="box-footer">
            <div class="form-group">
                <div class="btn-group pull-right">
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <button class="cancel btn btn-warning">Cancel</button>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>