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
            var depo_asal       = $("[name='depo_asal']").val();
            var depo_tujuan     = $("[name='depo_tujuan']").val();
            $.ajax({
                url: "<?php echo site_url('distribusi/search_distribusi');?>", 
                type: 'POST', 
                data: {cari_distribusi: cari_distribusi, tgl1: tgl1, tgl2: tgl2,depo_asal: depo_asal, depo_tujuan: depo_tujuan}, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".tambah").click(function(){
            window.location = "<?php echo site_url('distribusi/formdistribusi_obat')?>";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('distribusi/formdistribusi_obat')?>/"+id;
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
            window.location = "<?php echo site_url('distribusi/hapusdistribusi_obat')?>/"+id;
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('distribusi/reset_distribusi');?>/";
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
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="100" class='text-center'>No</th>
                        <th width="150" class='text-center'>No Distribusi</th>
                        <th class='text-center'>Keterangan</th>
                        <th width="100" class='text-center'>Depo Asal</th>
                        <th width="100" class='text-center'>Depo Tujuan</th>
                        <th width="100" class='text-center'>Tanggal</th>
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
                                <td>".$row->keterangan."</td>
                                <td>".$row->namadepo_asal."</td>
                                <td>".$row->namadepo_tujuan."</td>
                                <td>".$row->tanggal."</td>
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
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="cari_distribusi" value="<?php echo $this->session->userdata("cari_distribusi") ?>" autocomplete="off"/>
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
                    <label class="col-md-1 control-label">Depo Asal</label>
                    <div class="col-md-5">
                        <select class="form-control" name="depo_asal" required>
                            <option value="">---</option>
                            <?php
                                foreach ($d1->result() as $dp) {
                                    echo "
                                        <option value='".$dp->kode_depo."' ".($dp->kode_depo==$this->session->userdata("depo_asal") ? "selected" : "").">".$dp->nama_depo."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-1 control-label">Depo Tujuan</label>
                    <div class="col-md-5">
                        <select class="form-control" name="depo_tujuan" required>
                            <option value="">---</option>
                            <?php
                                foreach ($d2->result() as $dp2) {
                                    echo "
                                        <option value='".$dp2->kode_depo."' ".($dp2->kode_depo==$this->session->userdata("depo_tujuan") ? "selected" : "").">".$dp2->nama_depo."</option>
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