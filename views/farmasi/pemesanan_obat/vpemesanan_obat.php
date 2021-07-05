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
        $("select[name='supplier']").select2();
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".search").click(function(){
            var cari_nomor  = $("[name='cari_nomor']").val();
            var tgl1        = $("[name='tgl1']").val();
            var tgl2        = $("[name='tgl2']").val();
            var supplier    = $("[name='supplier']").val();
            $.ajax({
                url: "<?php echo site_url('pemesanan/search_nomor');?>", 
                type: 'POST', 
                data: {cari_nomor: cari_nomor,tgl1: tgl1, tgl2 : tgl2, supplier : supplier}, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".add").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('pemesanan/formpemesanan_obat')?>/"+id;
            return false;
        });
        $(".tambah").click(function(){
            window.location = "<?php echo site_url('pemesanan/formpemesanan_obat')?>/";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('pemesanan/formpemesanan_obat')?>/"+id;
            return false;
        });
        $(".hapus").click(function(){
            $(".modal").show();
        });
        $(".tidak").click(function(){
            $(".modal").hide();
        });
        $(".ya").click(function(){
            var id = $(".bg-gray").attr("href");
            var password = $("input[name='password']").val()
            window.location = "<?php echo site_url('pemesanan/hapuspemesanan_obat')?>/"+id+"/"+password;
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('pemesanan/reset_nomor');?>/";
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
    });
</script>
<div class='modal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Password Dibutuhkan</h4>
            </div>
            <div class='modal-body'>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password Petugas Pemesan">
            </div>
            <div class='modal-footer'>
                <button class="ya btn btn-sm btn-danger">Ya</button>
                <button class="tidak btn btn-sm btn-success">Tidak</button>
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
                        <th width="150" class='text-center'>No Pemesanan</th>
                        <th width="150" class='text-center'>No Permintaan</th>
                        <th class='text-center'>Keterangan</th>
                        <th width="200" class='text-center'>Supplier</th>
                        <th width="100" class='text-center'>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    foreach ($q3->result() as $row){
                        $i++;
                        echo "
                            <tr id=data href='".$row->no_permintaan."/".$row->no_pemesanan."'>
                                <td>".$i."</td>
                                <td>".$row->no_pemesanan."</td>
                                <td>".$row->no_permintaan."</td>
                                <td>".$row->keterangan_pemesanan."</td>
                                <td>".$row->nama_supplier."</td>
                                <td>".$row->tanggal_pemesanan."</td>
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
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl1" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl2" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-1 control-label">Supplier</label>
                    <div class="col-md-3">
                        <select class="form-control" name="supplier" required>
                            <option value="">----</option>
                            <?php
                                foreach ($s->result() as $sup) {
                                    echo "
                                        <option value='".$sup->kode_supplier."' ".($sup->kode_supplier==$this->session->supplier ? "selected" : "" ).">".$sup->nama_supplier."</option>
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