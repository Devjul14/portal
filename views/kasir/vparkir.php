<script type="text/javascript">
    $(document).ready(function(e){
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $('#myTable').fixedHeaderTable({ height: '450', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('parkir/formparkir');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".tambah").click(function(){
            var url = "<?php echo site_url('parkir/formparkir');?>";
            window.location = url;
            return false; 
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('parkir/hapus');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".reset").click(function(){
            var url = "<?php echo site_url('parkir/reset_parkir');?>";
            window.location = url;
            return false;
        });
        $(".search").click(function(){
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            var arrayData = {tgl1: tgl1,tgl2: tgl2};
            $.ajax({
                url: "<?php echo site_url('parkir/search_parkir');?>", 
                type: 'POST', 
                data: arrayData, 
                success: function(){
                    location.reload();
                }
            });
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
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="15%" class='text-center'>Periode</th>
                        <th width="25px" class='text-center'>Shift</th>
                        <th class='text-center'>Pemberi</th>
                        <th class='text-center'>Penerima</th>
                        <th class='text-center'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($q->result() as $row){
                        echo "<tr id=data href='".$row->id."'>" ;
                        echo "<td class='text-center'>".$row->periode."</td>";
                        echo "<td class='text-center'>".$row->shift."</td>";
                        echo "<td>".$row->pemberi."</td>";
                        echo "<td>".$row->penerima."</td>";
                        echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-6">
                        <div class='pull-right'>
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">
                        Tanggal
                    </label>
                    <div class="col-md-2">
                        <input type="text" name="tgl1" class="form-control" value="<?php echo $this->session->userdata("tgl1") ?>" autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <input type="text" name="tgl2" class="form-control" value="<?php echo $this->session->userdata("tgl2") ?>" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="search btn btn-primary"><i class="fa fa-search"></i></button>
                            </span>
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
                    <button class="tambah btn btn-info" type="button"><i class="fa fa-plus"></i></button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i></button>
                    <button class="hapus btn btn-danger" type="button"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>