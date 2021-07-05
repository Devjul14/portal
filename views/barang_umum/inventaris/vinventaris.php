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
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".search").click(function(){
            var cari_distribusi  = $("[name='cari_distribusi']").val();
            var tgl1            = $("[name='tgl1']").val();
            var tgl2            = $("[name='tgl2']").val();
            var depo_tujuan     = $("[name='depo_tujuan']").val();
            $.ajax({
                url: "<?php echo site_url('distribusi_bu/search_inventaris');?>", 
                type: 'POST', 
                data: {cari_distribusi: cari_distribusi, tgl1: tgl1, tgl2: tgl2, depo_tujuan: depo_tujuan}, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".tambah").click(function(){
            window.location = "<?php echo site_url('distribusi_bu/formdistribusi_bu')?>";
            return false;
        });
        $(".edit").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('distribusi_bu/formubah_status')?>/"+id;
            return false;
        });
        $(".updt").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('distribusi_bu/formubah_status')?>/"+id;
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
            window.location = "<?php echo site_url('distribusi_bu/hapusdistribusi_bu')?>/"+id;
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('distribusi_bu/reset_inventaris');?>/";
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
        <div class="box-header with-border">
           <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-12">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Depo / Ruangan</label>
                    <div class="col-md-5">
                        <select class="form-control" name="depo_tujuan" required>
                            <option value="">---</option>
                            <?php
                                foreach ($d1->result() as $dp) {
                                    echo "
                                        <option value='".$dp->kode_ruangan."' ".($dp->kode_ruangan==$this->session->userdata("depo_tujuan") ? "selected" : "").">".$dp->nama_ruangan."</option>
                                    ";
                                }
                            ?>
                            <?php
                                foreach ($d2->result() as $dp2) {
                                    echo "
                                        <option value='".$dp2->kode_."' ".($dp2->kode==$this->session->userdata("depo_tujuan") ? "selected" : "").">".$dp2->keterangan."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl1" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl2" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off"/>
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
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="100" class='text-center'>No</th>
                        <th width="150" class='text-center'>No Distribusi</th>
                        <th class='text-center'>Nama Barang</th>
                        <th width="150" class='text-center'>Status Barang</th>
                        <th width="150" class='text-center'>Depo / Ruangan</th>
                        <th width="100" class='text-center'>Tanggal</th>
                        <th width="100" class='text-center'>#</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    foreach ($q3->result() as $row){
                        $i++;
                        echo "
                            <tr id=data href='".$row->no_distribusi."'>
                                <td>".$i."</td>
                                <td>".$row->no_distribusi."</td>
                                <td>".$row->nama_bu." (".$row->merk.")</td>
                                <td>".$row->nama_status."</td>
                                <td>".$row->nama_ruangan." ".$row->nama_poli." </td>
                                <td>".$row->tanggal."</td>
                                <td><button class='updt btn btn-primary' href='".$row->no_distribusi."/".$row->kode_bu."'> Update Status Barang</button></td>
                            </tr>";
                    }
                ?>
                </tbody>
            </table>
         
        </div>
        <div class="box-footer"> 
            
        </div>
    </div>
</div>
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