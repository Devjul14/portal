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
        $("select[name='depo']").select2();
        $(".search").click(function(){
            var cari_nomor  = $("[name='cari_nomor']").val();
            var depo        = $("[name='depo']").val();
            $.ajax({
                url: "<?php echo site_url('stok_opname/search_nomor');?>", 
                type: 'POST', 
                data: {cari_nomor: cari_nomor,depo: depo}, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".add").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('stok_opname/formstok_opname')?>/"+id;
            return false;
        });
        $(".tambah").click(function(){
            window.location = "<?php echo site_url('stok_opname/formstok_opname')?>/";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('stok_opname/formstok_opname')?>/"+id;
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
            // var password = $("input[name='password']").val()
            window.location = "<?php echo site_url('stok_opname/hapuspenerimaan_barang')?>/"+id;
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('stok_opname/reset_nomor');?>/";
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
                        <th width="150" class='text-center'>Kode Stok Opname</th>
                        <th class='text-center'>Keterangan</th>
                        <th width="150" class='text-center'>Periode</th>
                        <th width="150" class='text-center'>Depo</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    foreach ($q3->result() as $row){
                        $i++;
                        echo "
                            <tr id=data href='".$row->kode_so."'>
                                <td>".$i."</td>
                                <td>".$row->kode_so."</td>
                                <td>".$row->keterangan."</td>
                                <td>".$row->periode."</td>
                                <td>".$row->nama_depo."</td>
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
                    <label class="col-md-2 control-label">Cari Nomor</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="cari_nomor" value="<?php echo $this->session->userdata("cari_nomor") ?>" autocomplete="off"/>
                    </div>
                    <label class="col-md-2">
                        Depo
                    </label>
                    <div class="col-md-4">
                        <select class="form-control" name="depo">
                            <option>----</option>
                            <?php
                                foreach ($dp->result() as $dep) {
                                    echo "
                                        <option value='".$dep->kode_depo."' ".($this->session->userdata("depo")==$dep->kode_depo ? "selected" : "").">".$dep->nama_depo."</option>
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
                            <!-- <button class="hapus btn btn-danger" type="button"><i class="fa fa-close"></i> Hapus</button> -->
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>