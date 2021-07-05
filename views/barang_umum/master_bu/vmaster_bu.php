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
        $(".search").click(function(event){
            var cari_barang_umum = $("input[name='cari_barang_umum']").val();
            $.ajax({
                url: "<?php echo site_url('master_bu/cari_barang_umum');?>", 
                type: 'POST', 
                data: {cari_barang_umum: cari_barang_umum}, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".tambah").click(function(){
            window.location = "<?php echo site_url('master_bu/formbarang_umum')?>/";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('master_bu/formbarang_umum')?>/"+id;
            return false;
        });

        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('master_bu/hapusbarang_umum')?>/"+id;
            return false;
        });
        $(".reset").click(function(){
        	window.location ="<?php echo site_url('master_bu/reset_barang_umum');?>/";
            return false;
        });
        $(".cetak").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakinap');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
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
                        <th width="10%" class='text-center'>Kode</th>
                        <th class='text-center'>Nama</th>
                        <th width="30%" class='text-center'>Merk</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=1;
                    foreach ($q3->result() as $row){
                        echo "<tr id=data href='".$row->kode_bu."'>";
                        echo "<td>".$row->kode_bu."</td>";
                        echo "<td>".$row->nama_bu."</td>";
                        echo "<td>".$row->merk."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
         
        </div>
        <div class="box-footer"> 
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">Cari Kategori</label>

                    <div class="col-md-4">
                        <input type="text" class="form-control" name="cari_barang_umum" value="<?php echo $this->session->userdata("cari_barang_umum") ?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-1">
                        <div class="pull-left">
                            <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-4">
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
            <div class="pull-right">
                <div class="btn-group">
                    <button class="tambah btn btn-primary" type="button"><i class="fa fa-plus"></i> Tambah</button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
                    <button class="hapus btn btn-danger" type="button"><i class="fa fa-close"></i> Hapus</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>