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
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no},
            url   : "<?php echo site_url('oka/getcaripasien');?>",
            success : function(result){
                location.reload();
                // window.location = "<?php echo site_url('pendaftaran/rawat_jalan');?>";
            },
            error: function(result){
                alert(result);
            }
        });
    }
    $(document).ready(function(e){
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".search").click(function(){
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var pelayanan = $("[name='pelayanan']").val();
            var status_pasien = $("select[name='status_pasien']").val();
            var arrayData = {tgl1: tgl1,tgl2: tgl2, pelayanan:pelayanan};
            $.ajax({
                url: "<?php echo site_url('oka/search');?>", 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".rekap").click(function(){
            var url = "<?php echo site_url('oka/rekap');?>/all";
            window.location = url;
            return false; 
        });
        $(".reset").click(function(){
            window.location = "<?php echo site_url('oka/reset')?>";
            return false;
        });
        $(".add").click(function(){
            // var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('oka/formoka')?>";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('oka/formoka')?>/"+id;
            return false;
        });
        $(".batal").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('oka/batal')?>/"+id;
            return false;
        });
        $(".jadwal").click(function(){
            var url = "<?php echo site_url('oka/jadwal')?>";
            openCenteredWindow(url);
            return false;
        });

        $(".cetak_pasien").click(function(){
            var url = "<?php echo site_url('oka/cetak_pasien')?>";
            openCenteredWindow(url);
            return false;
        });
        $(".hapus").click(function(){
            $(".rejected").show();
        });
        // $(".reject").click(function(){
        //     $(".rejected").show();
        // });
        $(".tidak_approved").click(function(){
            $(".approved").hide();
        });
        $(".tidak_rejected").click(function(){
            $(".rejected").hide();
        });
        $(".ya_rejected").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('oka/hapus')?>/"+id;
            return false;
        });
        $(".cetak").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('oka/cetak')?>/"+id;
            openCenteredWindow(url);            
            return false;
        });
        $(".cari_no").click(function(){
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $("[name='cari_no']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_no").click(function(){
            pencarian();
            return false;
        });
    });
    function tgl_indo(tgl,tipe=1){
        var date = tgl.substring(tgl.length,tgl.length-2);
        if (tipe==1)
            var bln = tgl.substring(5,7);
        else
            var bln = tgl.substring(4,6);
        var thn = tgl.substring(0,4);
        return date+"-"+bln+"-"+thn;
    }
</script>
<?php 
    $pel = $this->session->userdata("pelayanan");
    if ($pel=="RALAN") {
        $pr = "selected";
        $pi = "";
    }else if($pel=="RANAP"){
        $pr = "";
        $pi = "selected";
    }else{
        $pr = "";
        $pi = "";
    }
?>
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
<div class='modal rejected'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-red"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION</h4></div>
            <div class='modal-body'>
                <p>Yakin akan Hapus ?</p>
            </div>
            <div class='modal-footer'>
                <button class="ya_rejected btn btn-sm btn-danger">Ya</button>
                <button class="tidak_rejected btn btn-sm btn-success">Tidak</button>
            </div>
        </div>
    </div>
</div>                
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10%" class='text-center'>Nomor RM</th>
                        <th class='text-center'>Nomor REG</th>
                        <th class="text-center">Nama</th>
                        <th class='text-center'>Alamat</th>
                        <th class='text-center'>Gol Pasien</th>
                        <th class='text-center'>Pelayanan</th>
                        <th class='text-center' width="15%">Ruangan / Klinik</th>
                        <th class='text-center'>Kelas</th>
                        <th class='text-center'>Kamar</th>
                        <th width="7%" class='text-center'>No. Bed</th>
                        <th class='text-center'>Layan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($q->result() as $value) {
                            if ($value->layan=="0") {
                                $layan = "<label class='label label-primary'></label>";
                            }else if($value->layan=="1") {
                                $layan = "<label class='label label-success'>Layan</label>";
                            }else{
                                $layan = "<label class='label label-danger'>Batal</label>";
                            }
                            echo "
                                <tr id=data href='".$value->kode_oka."' nama ='".$value->nama."'>
                                    <td>".$value->no_rm."</td>
                                    <td>".$value->no_reg."</td>
                                    <td>".$value->nama."</td>
                                    <td>".$value->alamat."</td>
                                    <td>".$value->gol_pasien."</td>
                                    <td>".$value->pelayanan."</td>
                                    <td>".(isset($ruangan[$value->ruangan]) ? $ruangan[$value->ruangan] : "")." / ".$value->klinik."</td>
                                    <td>".(isset($kelas[$value->kelas]) ? $kelas[$value->kelas] : "")."</td>
                                    <td>".(isset($kamar[$value->kamar]) ? $kamar[$value->kamar] : "")."</td>
                                    <td>".$value->no_bed."</td>
                                    <td>".$layan."</td>
                                </tr>
                            ";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="bg-navy">
                        <th colspan="7">Jumlah Pasien : <?php echo $total_rows;?></th>
                        <th>Layan : <?php echo $jlayan;?></th>
                        <th>Batal : <?php echo $jbatal;?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <?php echo $this->pagination->create_links();?>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Tanggal</label>
                            <div class="col-md-4"><input type="text" name="tgl1" class="form-control" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off"></div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="tgl2" class="form-control" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off">
                                    <span class="input-group-btn"><button class="search btn btn-primary"><i class="fa fa-search"></i></button></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4 control-label"><span class="text-left">Pelayanan</span></label>
                            <div class="col-md-8">
                                <select name="pelayanan" class="form-control">
                                    <option value="">-----</option>
                                    <option value="RALAN" <?php echo $pr ?>>RALAN</option>
                                    <option value="RANAP" <?php echo $pi ?>>RANAP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="btn-group pull-left">
                        <button class="cetak_pasien btn btn-sm btn-primary"><i class="fa fa-calendar"></i> Rekap Pasien</button>
                        <button class="jadwal btn btn-sm btn-warning"><i class="fa fa-calendar"></i> Jadwal</button>
                        <button class="rekap btn btn-sm btn-success"><i class="fa fa-calendar"></i> Rekap</button>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="btn-group pull-right">
                        <button class="batal btn btn-sm bg-maroon">Batal</button>
                        <button class="add btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                        <button class="edit btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit</button>
                        <button class="hapus btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Hapus</button>
                        <button class="cetak btn btn-sm btn-success"><i class="fa fa-print"></i> Cetak</button>
                        <button class="cari_no btn btn-sm btn-primary"><i class="fa fa-search"></i> Cari</button>
                        <button class="reset btn btn-sm btn-warning"><i class="fa fa-file"></i> Reset</button>
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
                                <input class="form-control" type="text" name="cari_no" placeholder="Kode Oka/Nama"/>
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
<div class="formpulang modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Update <b><span class="noreg"></span></b></h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Keadaan Pulang</label>
                        <div class="col-md-8">
                            <select name="keadaan_pulang" class="form-control">
                                <?php
                                    foreach ($k->result() as $key) {
                                        echo "<option value=".$key->id.">".$key->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Status Pulang</label>
                        <div class="col-md-8">
                            <select name="status_pulang" class="form-control">
                                <?php
                                    foreach ($sp->result() as $key) {
                                        echo "<option value='".$key->id."'>".$key->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tanggal Pulang</label>
                        <div class="col-md-5">
                            <input type="text" name="tanggal_pulang" readonly class="form-control" autocomplete="off">
                            <p class="status_pasien"></p>
                        </div>
                        <div class="col-md-3"><input type="text" name="jam_pulang" class="form-control" autocomplete="off" placeholder="00:00"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No. Surat Pulang</label>
                        <div class="col-md-8">
                            <input type="text" name="no_surat_pulang" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No. SEP</label>
                        <div class="col-md-8">
                            <input type="text" name="no_sep" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>     
            </div>
            <div class="modal-footer">
                <button class="simpan_pulang btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>