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
            url   : "<?php echo site_url('kasir/getcaripasien_inap');?>",
            success : function(result){
                location.reload();
                // window.location = "<?php echo site_url('kasir/pembayaran_inap');?>";
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
        $(".search").click(function(){
            var kode_kelas = $("[name='kode_kelas']").val();
            var kode_ruangan = $("[name='kode_ruangan']").val();
            var kelas = $("[name='kelas']").val();
            var ruangan = $("[name='ruangan']").val();
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var arrayData = {kode_kelas: kode_kelas, kelas: kelas,kode_ruangan: kode_ruangan,ruangan: ruangan,tgl1: tgl1,tgl2: tgl2};
            $.ajax({
                url: "<?php echo site_url('kasir/search_inap');?>", 
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
        $("input[name='tanggal_pulang']").datepicker({
            dateFormat : formattgl,
        }).datepicker("setDate", new Date());;
        // $(".add").click(function(){
        //     window.location = "<?php echo site_url('kasir/addpasienbaru/y/y')?>";
        //     return false;
        // });
        $(".bayar").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('kasir/viewpembayaran_inap')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('kasir/hapuspasien')?>/"+id;
            return false;
        });
          $(".rjalan").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('kasir/viewrjalan');?>/"+id;
            // openCenteredWindow(url);
            return false;
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
        $("[name='cari_nama']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $("[name='cari_no']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $("[name='cari_noreg']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_noreg").click(function(){
            pencarian();
            return false;
        });
        $(".reset").click(function(){
            window.location ="<?php echo site_url('kasir/reset_inap');?>/";
            // location.reload();
            return false;
        });
         $(".cetak").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('kasir/cetakinap');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
        });
        $(".pulang").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            $.ajax({
                type  : "POST",
                data  : {no_pasien:no_rm,no_reg:no_reg},
                url   : "<?php echo site_url('kasir/getinap_detail');?>",
                success : function(result){
                    var value = JSON.parse(result);
                    $(".noreg").html(no_reg);
                    $(".formpulang").modal("show");
                    if (value.tgl_keluar!=null){
                        $("[name='no_surat_pulang']").val(value.no_surat_pulang);
                        $("[name='tanggal_pulang']").val(tgl_indo(value.tgl_keluar));
                        $(".status_pasien").html("<span class='label label-danger'>Pasien sudah pulang</span>");
                        $('[name=keadaan_pulang] option[value='+value.keadaan_pulang+']').prop("selected", true);
                        $('[name=status_pulang] option[value='+value.status_pulang+']').prop("selected", true);
                        // $(".simpan_pulang").attr("disabled","disabled");
                        // $("[name='tanggal_pulang']").attr("disabled","disabled");
                        // $("[name='status_pulang']").attr("disabled","disabled");
                        // $("[name='no_surat_pulang']").attr("disabled","disabled");
                    } else {
                        $("[name='no_surat_pulang']").val(no_reg);
                    }
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $(".simpan_pulang").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var kode_kamar = $(".bg-gray").attr("kode_kamar");
            var kode_kelas = $(".bg-gray").attr("kode_kelas");
            var kode_ruangan = $(".bg-gray").attr("kode_ruangan");
            var no_bed = $(".bg-gray").attr("no_bed");
            var tgl_keluar = $("[name='tanggal_pulang']").val();
            var status_pulang = $("[name='status_pulang']").val();
            var no_surat_pulang = $("[name='no_surat_pulang']").val();
            var keadaan_pulang = $("[name='keadaan_pulang']").val();
            $.ajax({
                type  : "POST",
                data  : {no_pasien:no_rm,no_reg:no_reg,tgl_keluar:tgl_keluar,status_pulang:status_pulang,no_surat_pulang:no_surat_pulang,keadaan_pulang:keadaan_pulang,kode_kamar:kode_kamar,kode_kelas:kode_kelas,kode_ruangan:kode_ruangan,no_bed:no_bed},
                url   : "<?php echo site_url('kasir/simpan_pulang');?>",
                success : function(result){
                    location.reload();
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $(".batal_pulang").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var tgl_keluar = $("[name='tanggal_pulang']").val();
            var status_pulang = $("[name='status_pulang']").val();
            var no_surat_pulang = $("[name='no_surat_pulang']").val();
            var keadaan_pulang = $("[name='keadaan_pulang']").val();
            $.ajax({
                type  : "POST",
                data  : {no_pasien:no_rm,no_reg:no_reg,tgl_keluar:tgl_keluar,status_pulang:status_pulang,no_surat_pulang:no_surat_pulang,keadaan_pulang:keadaan_pulang},
                url   : "<?php echo site_url('kasir/batal_pulang');?>",
                success : function(result){
                    location.reload();
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $(".ruangan").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihruangan1');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".kelas").click(function(){
            var url = "<?php echo site_url('pendaftaran/pilihkelas');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".laporan_harian").click(function(){
            var url = "<?php echo site_url('kasir/laporan_inap');?>";
            window.location = url;
            return false;
        });
        $(".parsial").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('parsial/formparsial_inap');?>/"+id+"/"+no_reg;
            window.location = url;
            return false;
        });
    });
    $(document).keyup(function(e){
        if (e.keyCode==82 && e.altKey){
            $(".reset").click();
        }
        // if (e.keyCode==78){
        //     $(".cari_nama").click();
        // }
        // if (e.keyCode==82 && !e.altKey){
        //     $(".cari_no").click();
        // }
    })
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
           

            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10%" class='text-center'>Nomor RM</th>
                        <th width="5%" class='text-center'>Nomor REG</th>
                        <th class="text-center">Nama</th>
                        <!-- <th width ="20%" class='text-center'>Alamat</th> -->
                        <th class='text-center'>Ruangan</th>
                        <th class='text-center'>Kelas</th>
                        <th class='text-center'>Kamar</th>
                        <th class='text-center'>No. Bed</th>
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
                        echo "<tr id=data href='".$row->no_rm."' no_reg='".$row->no_reg."' kode_kamar='".$row->kode_kamar."' kode_kelas='".$row->kode_kelas."' kode_ruangan='".$row->kode_ruangan."' no_bed='".$row->no_bed."'>";
                        echo "<td class='text-center'>".$row->no_rm."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        // echo "<td>".$row->alamat."</td>";
                        echo "<td>".$row->nama_ruangan."</td>";
                        echo "<td>".$row->nama_kelas."</td>";
                        echo "<td>".$row->kode_kamar."</td>";
                        echo "<td>".$row->no_bed."</td>";
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
                    <label class="col-md-1 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" name="ruangan" class="form-control" readonly value="<?php echo $this->session->userdata('ruangan');?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_ruangan" class="form-control" readonly value="<?php echo $this->session->userdata('kode_ruangan');?>">
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="ruangan btn btn-primary" type='button'>...</button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>

                    
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                            <input type="text" class="form-control" name="tgl1" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                            <input type="text" class="form-control" name="tgl2" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off"/>   
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                             <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <label class="col-md-1 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="text" name="kelas" class="form-control" readonly value="<?php echo $this->session->userdata('kelas');?>">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="kode_kelas" class="form-control" readonly value="<?php echo $this->session->userdata('kode_kelas');?>">
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="kelas btn btn-primary" type='button'>...</button>
                        </div>
                    </div>
                    
                </div>

            </div>   
            <div class="pull-left">
                <div class="btn-group">
                    <!-- <button class="add btn btn-primary" type="button" ><i class="fa fa-plus"></i> Tambah</button> -->
                    <!-- <button class="bawah btn btn-info" type="button"><i class="fa fa-remove"></i> Bawah</button> -->
                    <button class="hapus btn btn-danger" type="button"><i class="fa fa-edit"></i> Hapus</button>
                    <button class="reset btn btn-warning" type="button"> <i class="fa fa-refresh"></i> Reset</button>
                    <!-- <button class="hitung btn btn-success" type="button"><i class="fa fa-edit"></i> Hitung</button> -->
                </div>
                <!-- <div class="btn-group">
                    <button class="apotik btn btn-primary" type="button"> Apotik</button>
                    <button class="lab btn btn-info" type="button"> Lab</button>
                    <button class="rad btn btn-warning" type="button"> Rad</button>
                    <button class="scan btn btn-danger" type="button"> Scan</button>
                    <button class="pdf btn btn-success" type="button"> Pdf</button>
                </div> -->
                <!-- <div class="btn-group">
                    <button class="masuk btn btn-info" type="button"> Masuk</button>
                    <button class="pulang btn btn-success" type="button"> Pulang</button>
                </div> -->
                    <!-- <button class="cetak btn btn-primary" type="button"> Cetak</button> -->

                
                <!-- <div class="btn-group">
                    <button class="dataugd btn btn-warning" type="button"> Data UGD</button>
                    <button class="tampil btn btn-danger" type="button"> Tampil</button>
                    <button class="noreg btn btn-success" type="button"> Noreg</button>
                </div> -->
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <!-- <button class="batal_pulang btn bg-navy " type="button"><i class="fa fa-sign-in"></i> Batal Pulang</button> -->
                    <!-- <button class="pulang btn btn-danger" type="button"><i class="fa fa-sign-in"></i> Pulang</button> -->
                    <button class="parsial btn btn-primary" type="button"> Parsial</button>
                    <button class="cari_no btn btn-info type="button"> Cari</button>
                    <button class="laporan_harian btn btn-success" type="button"> Laporan Harian</button>
                    <!-- <button class="cari_nama btn btn-success" type="button"> Cari Nama</button> -->
                    <button class="bayar btn bg-maroon" type="button"> View Pembayaran</button>
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
                                        echo "<option value=".$key->id.">".$key->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tanggal Pulang</label>
                        <div class="col-md-8">
                            <input type="text" name="tanggal_pulang" class="form-control" autocomplete="off">
                            <p class="status_pasien"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">No. Surat Pulang</label>
                        <div class="col-md-8">
                            <input type="text" name="no_surat_pulang" class="form-control" autocomplete="off">
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