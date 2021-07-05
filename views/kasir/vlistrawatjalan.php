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
    function pencarian(){
        var cari_no = $("[name='cari_no']").val();
        var cari_noreg = $("[name='cari_noreg']").val();
        var cari_nama = $("[name='cari_nama']").val();
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no,cari_nama:cari_nama,cari_noreg:cari_noreg},
            url   : "<?php echo site_url('kasir/getcaripasien_ralan');?>",
            success : function(result){
                window.location = "<?php echo site_url('kasir/pembayaran_ralan');?>";
            },
            error: function(result){
                alert(result);
            }
        });
    }
    $(document).ready(function(e){
        $(".search").click(function(){
            var poli_kode = $("[name='poli_kode']").val();
            var poliklinik = $("[name='poliklinik']").val();
            var kode_dokter = $("[name='kode_dokter']").val();
            var dokter = $("[name='dokter']").val();
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var arrayData = {poli_kode: poli_kode, poliklinik: poliklinik,kode_dokter: kode_dokter,dokter: dokter,tgl1: tgl1,tgl2: tgl2};
            $.ajax({
                url: "<?php echo site_url('kasir/search_ralan');?>", 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".reset").click(function(){
            var url = "<?php echo site_url('kasir/reset_ralan');?>";
            window.location = url;
            return false;
        });
        $(".cetak_barcode").click(function(){
            getpasien();
            return false;
        });
        $(".view").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('kasir/viewpembayaran_ralan');?>/"+id;
            window.location = url;
            return false; 
        });
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".cari_no").click(function(){
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $(".cari_nama").click(function(){
            $(".modal_cari_nama").modal("show");
            $("[name='cari_nama']").focus();
            return false;
        });
        $(".cari_noreg").click(function(){
            $(".modal_cari_noreg").modal("show");
            $("[name='cari_noreg']").focus();
            return false;
        });
        $("[name='cari_nama'], [name='cari_no'], [name='cari_noreg']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function(){
            pencarian();
            return false;
        });
        $(".poli").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihpoli');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".dokter").click(function(){
            var kode_poli = $("input[name='poli_kode']").val()
            var url = "<?php echo site_url('pendaftaran/pilihdokterpoli');?>/"+kode_poli;
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_harian").click(function(){
            var url = "<?php echo site_url('kasir/laporan_ralan');?>";
            window.location = url;
            return false;
        });
        $(".parsial").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('parsial/formparsial_ralan');?>/"+id;
            window.location = url;
            return false;
        });
    });
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
        <div class="box-header">
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="15%" class='text-center'>Nomor RM</th>
                        <th width="15%" class='text-center'>Nomor REG</th>
                        <th>Nama</th>
                        <th class='text-center'>Poli Asal</th>
                        <th class='text-center'>Poli Tujuan</th>
                        <th class='text-center'>Status Pasien</th>
                        <th class='text-center'>Jenis Pasien</th>
                        <th class='text-center'>Golongan Pasien</th>
                        <th class='text-center'>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    $no_kk = '';
                    $bayar = '';
                    foreach ($q3->result() as $row){
                        switch ($row->status_bayar) {
                            case '':
                                $bayar = "<label class='label label-warning'>--</label>";
                                break;
                            case 'TAGIH':
                                $bayar = "<label class='label label-danger'>TAGIH</label>";
                                break;
                            case 'LUNAS':
                                $bayar = "<label class='label label-success'>LUNAS</label>";
                                break;
                            case 'SHARING':
                                $bayar = "<label class='label label-info'>SHARING</label>";
                                break;
                        }
                        echo "<tr id=data href='".$row->no_pasien."/".$row->no_reg."'>" ;
                        echo "<td class='text-center'>".$row->no_pasien."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        echo "<td>".$row->poli_asal."</td>";
                        echo "<td>".$row->poli_tujuan."</td>";
                        echo "<td>".$row->status_pasien."</td>";
                        echo "<td>".$row->jenis."</td>";
                        echo "<td>".$row->gol_pasien."</td>";
                        echo "<td>".$bayar."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1">
                        Poliklinik
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="poliklinik" class="form-control" readonly value="<?php echo $this->session->userdata("poliklinik") ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="poli_kode" class="form-control" readonly value="<?php echo $this->session->userdata("poli_kode") ?>">
                    </div>
                    <div class="col-md-1">
                        <button class="poli btn btn-primary">...</button>
                    </div>
                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">
                        Tanggal
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="tgl1" class="form-control" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="tgl2" class="form-control" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off">
                    </div>
                    <div class="col-md-1">
                        <button class="search btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                    <label class="col-md-1">
                        Dokter
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="dokter" class="form-control" readonly value="<?php echo $this->session->userdata("dokter") ?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_dokter" class="form-control" readonly value="<?php echo $this->session->userdata("kode_dokter") ?>">
                    </div>
                    <div class="col-md-1">
                        <button class="dokter btn btn-primary">...</button>
                    </div>
                </div>
            </div>
            <div class="pull-left">
                <div class="btn-group">
                    <button class="reset btn btn-warning"> Reset</button>
                    <!-- <button class="batal btn btn-danger"> Batal</button> -->
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <button class="parsial btn btn-primary" type="button"> Parsial</button>
                    <button class="cari_no btn btn-info" type="button"> Cari</button>
                    <button class="laporan_harian btn btn-success" type="button"> Laporan Harian</button>
                    <!-- <button class="cari_nama btn btn-info" type="button"> Cari Nama</button> -->
                    <button class="view btn btn-warning" type="button"><i class="fa fa-edit"></i> View Pembayaran</button>
                    <!-- <button class="cetak_barcode btn btn-danger" type="button"><i class="fa fa-print"></i> Cetak Barcode</button> -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_no no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ No. RM/ No. Reg/ No. BPJS/ No. SEP"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_no btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_nama no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_nama"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_nama btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_noreg no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No Reg</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_noreg"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_noreg btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="invoice no-border hide" id="invoice">
    <table cellspacing="0" cellpadding="0" width="100%">
    <tr><td>
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:5px;font-family: 'Arial Narrow'">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </td>
    <td>
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:5px;font-family: 'Arial Narrow'">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </td>
    <td>
        <table cellspacing="0" cellpadding="0" width="100%" style="font-size:5px;font-family: 'Arial Narrow'">
            <tbody class="konten_print"></tbody>
            <tfoot>
                <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
            </tfoot>
        </table>
    </td></tr>
    </table>
</section>