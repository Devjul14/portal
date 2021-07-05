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
        $(".cetak").click(function(){
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var url = "<?php echo site_url('retensi/cetakretensi');?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url)
        })
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        var formattgl = "dd-mm-yy";
        var formattgl1 = "yy-mm-dd";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".data_rm").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('retensi/data_rm');?>/"+id;
            return false;
        });
        $(".ambil_data").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('retensi/ambil_data');?>/"+id;
            return false;
        });
        $(".add").click(function(){
            window.location = "<?php echo site_url('pendaftaran/addpasienbaru/y/y/y')?>";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('retensi/formretensi')?>/"+id;
            return false;
        });
        $(".upload").click(function(){
            var id = $(this).attr("href");
            window.location = "<?php echo site_url('retensi/formupload')?>/"+id;
            return false;
        });
        
        $(".cari").click(function(){
            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            return false;
        });
        $("[name='cari_no']").keyup(function(e){
            if (e.keyCode==13) pencarian();
        });
        $(".tmb_cari_no").click(function(){
            pencarian();
            return false;
        });
        $(".reset").click(function(){
            location.reload();
        });
        $(".search").click(function(){
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var arrayData = {tgl1: tgl1,tgl2: tgl2,};
            $.ajax({
                url: "<?php echo site_url('retensi/search_pasien');?>", 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                }
            });
        });
        $(".reset").click(function(){
            window.location = "<?php echo site_url('retensi/reset_pasien')?>";
            return false;
        });

    });
    $(document).keyup(function(e){
        if (e.keyCode==82 && e.altKey){
            $(".reset").click();
        }
    })
    function pencarian(){
        var cari_no = $("[name='cari_no']").val();
        $.ajax({
            type  : "POST",
            data  : {cari_no:cari_no},
            url   : "<?php echo site_url('retensi/getcaripasien');?>",
            success : function(result){
                window.location = "<?php echo site_url('retensi');?>";
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
        <div class="box-header">
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
                            <button class="cari btn btn-success" type="button"><i class="fa fa-search"></i> Cari</button>
                        </div>
                        <div class="btn-group">
                            <button class="ambil_data btn btn-primary" type="button"> Kembalikan Data</button>
                            <button class="data_rm btn btn-danger" type="button"> Kembalikan RM & Data</button>
                        </div>  
                        <button class="cetak btn btn-success"> Cetak</button>
                        <button class="reset btn btn-warning"> Refresh</button>
                    </div>
                    <label class="col-md-1">
                        Tanggal
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="tgl1" class="form-control" value="<?php echo $tgl1 ?>" autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="tgl2" class="form-control" value="<?php echo $tgl2 ?>" autocomplete="off">
                    </div>
                    <div class="col-md-1">
                        <button class="search btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="15%" class='text-center'>Nomor RM</th>
                        <th width="200">Nama</th>
                        <th class='text-center'>Alamat</th>
                        <th width="200" class='text-center'>No. BPJS</th>
                        <th width="150" class='text-center'>Dokumen</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($q3->result() as $row){

                        if ($row->pdf_retensi=="" || $row->pdf_retensi==NULL) {
                            $btn = "<button href='".$row->no_pasien."/".$row->no_retensi."' class='upload btn btn-primary'>Upload</button>";
                        } else {
                            $btn = "<a href='".base_url()."file_pdf/retensi/".$row->pdf_retensi."' target='blank'>Lihat File</a>";
                        }
                        

                        echo "<tr id=data href='".$row->no_pasien."/".$row->no_retensi."' nama='".$row->nama_pasien."' status_pinjam='".$row->status_pinjam."'>";
                        echo "<td class='text-center'>".$row->no_pasien."</td>";
                        echo "<td>".$row->nama_pasien."</td>";
                        echo "<td>".$row->alamat."</td>";
                        echo "<td>".$row->no_bpjs."</td>";
                        echo "<td>".$btn."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
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
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ No. RM/ No. BPJS" />
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
