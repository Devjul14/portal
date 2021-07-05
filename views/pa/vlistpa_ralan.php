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
        var kode_dokter = $("[name='kode_dokter']").val();
        var dokter = $("[name='dokter']").val();
        var tgl1 = $("[name='tgl1']").val();
        var tgl2 = $("[name='tgl2']").val();
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no,cari_nama:cari_nama,cari_noreg:cari_noreg, tgl1: tgl1,tgl2: tgl2,kode_dokter: kode_dokter,dokter: dokter},
            url   : "<?php echo site_url('pa/cari_paralan');?>",
            success : function(result){
                window.location = "<?php echo site_url('pa/ralan');?>";
            },
            error: function(result){
                alert(result);
            }
        });
    }
    $(document).ready(function(e){
         $(".search").click(function(){
            pencarian();
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".reset").click(function(){
            var url = "<?php echo site_url('pa/reset_paralan');?>";
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
        $("select[name='kode_dokter']").select2();
        $(".detail").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('pa/detailpa_ralan');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".ekspertisi").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('pa/ekspertisi');?>/"+id;
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
                        <th class='text-center'>No. Antrian</th>
                        <th class='text-center'>Nomor RM</th>
                        <th class='text-center'>Nomor REG</th>
                        <th>Nama</th>
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
                    foreach ($q3->result() as $row){
                        if ($row->layan=="0") {
                                $layan = "<label class='label label-primary'>Layan</label>";
                        }else if($row->layan=="1") {
                                $layan = "<label class='label label-success'>Layan</label>";
                        }else{
                                $layan = "<label class='label label-danger'>Batal</label>";
                        }
                        echo "<tr id=data href='".$row->no_pasien."/".$row->no_reg."'>" ;
                        echo "<td class='text-center'>".$row->no_antrian."</td>";
                        echo "<td class='text-center'>".$row->no_pasien."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        echo "<td>".$row->poli_tujuan."</td>";
                        echo "<td>".$row->status_pasien."</td>";
                        echo "<td>".$row->jenis."</td>";
                        echo "<td>".$row->gol_pasien."</td>";
                        echo "<td>".$layan."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr class="bg-navy">
                        <th colspan="9">Jumlah Pasien : <?php echo $total_rows;?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-12">
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
                    <label class="col-md-1">
                        Dokter
                    </label>
                    <div class="col-md-6">
                        <div class="col-md-10">
                            <select class="form-control" name="kode_dokter">
                                <option value="">---</option>
                                <?php
                                    foreach ($q->result() as $val) {
                                        echo "
                                            <option value='".$val->id_dokter."' ".($val->id_dokter==$this->session->userdata("kode_dokter") ? "selected" : "").">".$val->nama_dokter."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="search btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="btn-group pull-left">
                        <button class="reset btn btn-warning"> Reset</button>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="ekspertisi btn btn-success" type="button"> Ekspertisi</button>
                            <button class="cari_no btn btn-info" type="button"> Cari</button>
                            <!-- <button class="cari_noreg btn btn-info" type="button"> Cari No REG</button>
                            <button class="cari_nama btn btn-info" type="button"> Cari Nama</button> -->
                            <button class="detail btn btn-warning" type="button"><i class="fa fa-edit"></i> Detail</button>
                        </div>
                    </div>
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
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ No. RM/ No. Reg/ No. BPJS/ No. SEP"//>
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
                                <input class="form-control" type="text" name="cari_nama">
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
    <div style="width:20cm;height:2.59cm;display: block;margin-left:-5px">
        <div style="float: left;width:3.6cm;padding:2px">
            <table cellspacing="0" cellpadding="0" width="100%" style="font-size:10px;font-family: 'Arial Narrow'">
                <tbody class="konten_print"></tbody>
                <tfoot>
                    <tr><td colspan="2"><br><span class="barcode" id="barcode" style="width:100px;"></span></td></tr>
                </tfoot>
            </table>
        </div>
        <div style="float: left;width:3.6cm;padding:2px">
            <table cellspacing="0" cellpadding="0" width="100%" style="font-size:10px;font-family: 'Arial Narrow'">
                <tbody class="konten_print"></tbody>
                <tfoot>
                    <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
                </tfoot>
            </table>
        </div>
        <div style="float: left;width:3.6cm;padding:2px">
            <table cellspacing="0" cellpadding="0" width="100%" style="font-size:10px;font-family: 'Arial Narrow'">
                <tbody class="konten_print"></tbody>
                <tfoot>
                    <tr><td colspan="2"><br><span class="barcode" id="barcode"></span></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>