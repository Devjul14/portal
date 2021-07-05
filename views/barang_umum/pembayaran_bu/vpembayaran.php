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
        $(".search").click(function(){
            var cari_nomor = $("[name='cari_nomor']").val();
            $.ajax({
                url: "<?php echo site_url('penerimaan/search_nomor');?>", 
                type: 'POST', 
                data: {cari_nomor: cari_nomor}, 
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
        $(".viewbayar").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('pembayaran_bu/formpembayaran')?>/"+id;
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
            window.location = "<?php echo site_url('penerimaan/hapuspenerimaan_barang')?>/"+id;
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('pembayaran_bu/reset_nomor');?>/";
            return false;
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
                        <th width="150" class='text-center'>No Pembayaran</th>
                        <th width="150" class='text-center'>No Penerimaan</th>
                        <th width="150" class='text-center'>No Faktur</th>
                        <th width="150" class='text-center'>No Invoice</th>
                        <th width="150" class='text-center'>Total</th>
                        <th class='text-center'>Keterangan</th>
                        <th width="100" class='text-center'>Tanggal Deadline</th>
                        <th width="100" class='text-center'>Tanggal Kontrabon</th>
                        <th width="100" class='text-center'></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    foreach ($q3->result() as $row){
                        $i++;
                        if ($row->status=="0") {
                            $no_pembayaran = "<td><label class='label label-danger'>Belum Dibayarkan</label></td>";
                        } else {
                            $no_pembayaran = "<td>".$row->no_pembayaran."</td>";
                        }
                        
                        echo "
                            <tr id=data href='".$row->no_penerimaan."/".$row->no_pembayaran."'>
                                <td>".$i.".</td>
                                    ".$no_pembayaran."
                                <td>".$row->no_penerimaan."</td>
                                <td>".$row->no_faktur."</td>
                                <td>".$row->no_invoice."</td>
                                <td>".number_format($row->total,0,',','.')."</td>
                                <td>".$row->keterangan."</td>
                                <td>".date('d-m-Y',strtotime($row->tgl_deadline))."</td>
                                <td>".date('d-m-Y',strtotime($row->tgl_kontrabon))."</td>
                                <td>
                                    <button class='viewbayar btn btn-success' href='".$row->no_penerimaan."/".$row->no_pembayaran."'>View Pembayaran</button>
                                </td>
                            </tr>";
                    }
                ?>
                </tbody>
            </table>
         
        </div>
        <div class="box-footer"> 
            <div class="form-horizontal">
                <div class="form-group">
                   <label class="col-md-1 control-label">Cari Nomor</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="cari_nomor" value="<?php echo $this->session->userdata("cari_nomor") ?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                             <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="pull-left">
                <div class="btn-group">
                    <button class="reset btn btn-warning"> Reset</button>
                </div>
            </div>
            <!-- <div class="pull-right">
                <div class="btn-group">
                    <button class="tambah btn btn-primary" type="button"><i class="fa fa-plus"></i> Tambah</button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> View</button>
                    <button class="hapus btn btn-danger" type="button"><i class="fa fa-close"></i> Hapus</button>
                    
                </div>
            </div> -->
        </div>
    </div>
</div>