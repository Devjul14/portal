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
            url   : "<?php echo site_url('apotek/getcaripasien_inap');?>",
            success : function(result){
                window.location = "<?php echo site_url('apotek/list_inap');?>";
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
        // $(".search").click(function(){
        //     var kode_kelas = $("[name='kode_kelas']").val();
        //     var kode_ruangan = $("[name='kode_ruangan']").val();
        //     var kelas = $("[name='kelas']").val();
        //     var ruangan = $("[name='ruangan']").val();
        //     var tgl1 = $("[name='tgl1']").val();
        //     var tgl2 = $("[name='tgl2']").val();
        //     var arrayData = {kode_kelas: kode_kelas, kelas: kelas,kode_ruangan: kode_ruangan,ruangan: ruangan,tgl1: tgl1,tgl2: tgl2};
        //     $.ajax({
        //         url: "<?php echo site_url('pendaftaran/search_inap');?>", 
        //         type: 'POST', 
        //         data: arrayData, 
        //         success: function(){
        //             location.reload();
        //         }
        //     });
        // });
        $("input[name='cari_obat']").keypress(function(event){
            if ( event.which == 13 ) {
                event.preventDefault();
                var cari_obat = $(this).val();
                $.ajax({
                    url: "<?php echo site_url('farmasi/search');?>", 
                    type: 'POST', 
                    data: {cari_obat: cari_obat}, 
                    success: function(){
                        location.reload();
                    }
                });
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        // $(".add").click(function(){
        //     window.location = "<?php echo site_url('pendaftaran/addpasienbaru/y/y')?>";
        //     return false;
        // });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            window.location = "<?php echo site_url('pendaftaran/editinap')?>/"+id+"/"+no_reg;
            return false;
        });
        $(".datapasien").click(function(){
            window.location = "<?php echo site_url('pendaftaran')?>";
            return false;
        });
        
        $(".tambah").click(function(){
            window.location = "<?php echo site_url('farmasi/form')?>/";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('farmasi/form')?>/"+id;
            return false;
        });

        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('farmasi/hapusobat')?>/"+id;
            return false;
        });
        $(".view").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('apotek/viewapotek_inap');?>/"+id;
            window.location = url;
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
        	window.location ="<?php echo site_url('farmasi/reset');?>/";
            // location.reload();
            return false;
        });
         $(".cetak").click(function(){
            var no_rm = $(".bg-gray").attr("href");
            var no_reg = $(".bg-gray").attr("no_reg");
            var url = "<?php echo site_url('pendaftaran/cetakinap');?>/"+no_rm+"/"+no_reg;
            openCenteredWindow(url);
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
    });
    $(document).keyup(function(e){
        if (e.keyCode==82 && e.altKey){
            $(".reset").click();
        }
    })
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
                        <th class='text-center'>Barang</th>
                        <th class="text-center">Satuan</th>
                        <!-- <th width ="20%" class='text-center'>Alamat</th> -->
                        <th class='text-center'>Isi</th>
                        <th class='text-center'>Harga Jual</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                    foreach ($q3->result() as $row){
                        echo "<tr id=data href='".$row->kode."'>";
                        echo "<td class='text-center'>".$row->kode."</td>";
                        echo "<td>".$row->nama."</td>";
                        echo "<td>".$row->pak1."</td>";
                        // echo "<td>".$row->alamat."</td>";
                        echo "<td>".$row->isi."</td>";
                        echo "<td>".$row->hrg_jual."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
         
        </div>
        <div class="box-footer"> 
            <div class="form-horizontal">
                <div class="form-group">
                   <label class="col-md-1 control-label">Cari Obat</label>
                    <div class="col-md-4">
                            <input type="text" class="form-control" name="cari_obat" value="<?php echo $this->session->userdata("cari_obat") ?>" autocomplete="off"/>
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
            <div class="pull-right">
                <div class="btn-group">
                    <!-- <button class="cari_no btn btn-success" type="button"> Cari</button> -->
                    <!-- <button class="cari_noreg btn btn-info" type="button"> Cari No REG</button>
                    <button class="cari_nama btn btn-info" type="button"> Cari Nama</button> -->
                    <button class="tambah btn btn-primary" type="button"><i class="fa fa-plus"></i> Tambah</button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
                    <button class="hapus btn btn-danger" type="button"><i class="fa fa-close"></i> Hapus</button>
                    
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
                        <label class="col-sm-2 control-label">No. RM</label>
                        <div class="col-sm-10">
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