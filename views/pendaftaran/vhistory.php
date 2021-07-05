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
        $(".add").click(function(){
            window.location = "<?php echo site_url('pendaftaran/addpasienbaru/y/y')?>";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('pendaftaran/addpasienbaru/n/n')?>/"+id;
            return false;
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('pendaftaran/hapuspasien')?>/"+id;
            return false;
        });
          $(".rjalan").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('pendaftaran/viewrjalan');?>/"+id;
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
        $("[name='cari_nama']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $("[name='cari_no']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no").click(function(){
            pencarian();
            return false;
        });
        $(".reset").click(function(){
            location.reload();
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
    function pencarian(){
        var cari_no = $("[name='cari_no']").val();
        var cari_nama = $("[name='cari_nama']").val();
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no,cari_nama:cari_nama},
            url   : "<?php echo site_url('pendaftaran/getcaripasien');?>",
            success : function(result){
                window.location = "<?php echo site_url('pendaftaran');?>";
            },
            error: function(result){
                alert(result);
            }
        });
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
                        <th width="15%" class='text-center'>Nomor RM</th>
                        <th width="15%" class='text-center'>Nomor REG</th>
                        <th>Nama</th>
                        <th class='text-center'>Ruangan</th>
                        <th class='text-center'>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($q3->result() as $row){
                        echo "<tr id=data href='".$row->no_pasien."'>";
                        echo "<td class='text-center'>".$row->no_pasien."</td>";
                        echo "<td class='text-center'>".$row->no_reg."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        echo "<td>".$row->kode_ruangan."</td>";
                        echo "<td>".$row->kode_kelas."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <!-- <div class="pull-left">
                <div class="btn-group">
                    <button class="add btn btn-primary" type="button" ><i class="fa fa-plus"></i> Tambah</button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
                    <button class="hapus btn btn-danger" type="button"><i class="fa fa-remove"></i> Retensi</button>
                </div>
                <div class="btn-group">
                    <button class="cari_no btn btn-primary" type="button"> Cari No. RM</button>
                    <button class="cari_nama btn btn-info" type="button"> Cari Nama</button>
                    <button class="reset btn btn-success" type="button"> Reset</button>
                </div>
                <div class="btn-group">
                    <button class="hapus btn btn-info" type="button"> R. Inap</button>
                    <button class="rjalan btn btn-success" type="button"> R. Jalan</button>
                </div>
                <div class="btn-group">
                    <button class="history btn btn-success" type="button"> History</button>
                </div>
            </div> -->
            <div class='pull-right'>
                <?php echo $this->pagination->create_links();?>
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
                                <input class="form-control" type="text" name="cari_no"/>
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