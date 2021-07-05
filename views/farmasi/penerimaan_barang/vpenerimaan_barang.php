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
    $(document).ready(function(e){
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $("select[name='supplier']").select2();
        $(".search").click(function(){
            var cari_nomor  = $("[name='cari_nomor']").val();
            var supplier    = $("[name='supplier']").val();
            var tgl1        = $("[name='tgl1']").val();
            var tgl2        = $("[name='tgl2']").val();
            $.ajax({
                url: "<?php echo site_url('penerimaan/search_nomor');?>", 
                type: 'POST', 
                data: {cari_nomor: cari_nomor,tgl1: tgl1, tgl2 : tgl2,supplier: supplier}, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".add").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('penerimaan/formpenerimaan_barang')?>/"+id;
            return false;
        });
        $(".tambah").click(function(){
            window.location = "<?php echo site_url('penerimaan/formpenerimaan_barang')?>/";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('penerimaan/formpenerimaan_barang')?>/"+id;
            return false;
        });
        $(".hapus").click(function(){
            $("#modal").show();
        });
        $(".tidak").click(function(){
            $("#modal").hide();
        });
        $(".ya").click(function(){
            var id = $(".bg-gray").attr("href");
            // var password = $("input[name='password']").val()
            window.location = "<?php echo site_url('penerimaan/hapuspenerimaan_barang')?>/"+id;
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('penerimaan/reset_nomor');?>/";
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });

        $(".rekap").click(function(){
            var tgl1        = $("[name='tgl1']").val();
            var tgl2        = $("[name='tgl2']").val();
            var url         = "<?php echo site_url('penerimaan/rekap_penerimaan')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
            return false;
        });
        $(".rkp_tgl").click(function(){
            var id = $(this).attr("href");
            $("input[name='no_penerimaan']").val(id);
            $("#modal_rekap").show();
        });
        $(".batal").click(function(){
            $("#modal_rekap").hide();
        });
        $(".simpan").click(function(){
            var tgl = $("input[name='tgl_rekap']").val();
            var no_penerimaan = $("input[name='no_penerimaan']").val();
            window.location = "<?php echo site_url('penerimaan/simpantanggal_rekap')?>/"+no_penerimaan+"/"+tgl;
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl_rekap']" ).datepicker({
            dateFormat : formattgl,
        });
    });
</script>
<div class='modal' id="modal">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Hapus</h4>
            </div>
            <div class='modal-body'>
                Yakin akan menghapus data?
            </div>
            <div class='modal-footer'>
                <button class="ya btn btn-sm btn-danger">Ya</button>
                <button class="tidak btn btn-sm btn-success">Tidak</button>
            </div>
        </div>
    </div>
</div>
<div class='modal' id="modal_rekap">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Tanggal Rekap</h4>
            </div>
            <div class='modal-body'>
               <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12">
                            Tanggal Rekap
                        </label>
                        <div class="col-md-12">
                            <input type="text" name="tgl_rekap" class="form-control" autocomplete="off" value="<?php echo date("d-m-Y") ?>">  
                            <input type="hidden" name="no_penerimaan" class="form-control">  
                        </div>
                    </div>
               </div>
            </div>
            <div class='modal-footer'>
                <button class="simpan btn btn-sm btn-success">Simpan</button>
                <button class="batal btn btn-sm btn-danger">Batal</button>
            </div>
        </div>
    </div>
</div>
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
                        <th width="100" class='text-center'>No</th>
                        <th width="150" class='text-center'>No Penerimaan</th>
                        <th width="150" class='text-center'>No Pemesanan</th>
                        <th class='text-center'>Keterangan</th>
                        <th width="100" class='text-center'>Tanggal</th>
                        <th width="200" class='text-center'>Tgl Rekap</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    foreach ($q3->result() as $row){
                        if ($row->tgl_rekap==NULL || $row->tgl_rekap=="") {
                            $btn = "<button href='".$row->no_penerimaan."' class='rkp_tgl btn btn-success'>
                                        Input
                                    </button>";
                        } else {
                            $btn = $row->tgl_rekap;
                        }
                        
                        $i++;
                        echo "
                            <tr id=data href='".$row->no_pemesanan."/".$row->no_penerimaan."'>
                                <td>".$i."</td>
                                <td>".$row->no_penerimaan."</td>
                                <td>".$row->no_pemesanan."</td>
                                <td>".$row->keterangan."</td>
                                <td>".$row->tanggal."</td>
                                <td class='text-center'>".$btn."</td>
                            </tr>";
                    }
                ?>
                </tbody>
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
                    <label class="col-md-1 control-label">Cari Nomor</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="cari_nomor" value="<?php echo $this->session->userdata("cari_nomor") ?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl1" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl2" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-1">
                        Supplier
                    </label>
                    <div class="col-md-2">
                        <select class="form-control" name="supplier">
                            <option value="">----</option>
                            <?php
                                foreach ($sp->result() as $sup) {
                                    echo "
                                        <option value='".$sup->kode_supplier."' ".($this->session->userdata("supplier")==$sup->kode_supplier ? "selected" : "").">".$sup->nama_supplier."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 pull-left">
                        <div class="pull-left">
                            <button class="search btn btn-primary" type="button">Cari</button>
                            <button class="reset btn btn-warning"> Reset</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <button class="rekap btn btn-success" type="button"> Rekap</button>
                            <button class="tambah btn btn-primary" type="button"><i class="fa fa-plus"></i> Tambah</button>
                            <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> View</button>
                            <button class="hapus btn btn-danger" type="button"><i class="fa fa-close"></i> Hapus</button>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>