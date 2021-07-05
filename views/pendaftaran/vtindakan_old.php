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
    $(document).ready(function(){
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $("select[name='hal']").change(function(){
            $("#formcari").submit();
            return false;
        });
        $("input[name='next']").click(function(){
            var hal = $("select[name='hal']").val();
            hal++;
            $("select[name='hal']").val(hal);
            $("#formcari").submit();
            return false;
        });
        $("input[name='prev']").click(function(){
            var hal = $("select[name='hal']").val();
            hal--;
            $("select[name='hal']").val(hal);
            $("#formcari").submit();
            return false;
        });
        $(".add").click(function(){
            window.location = "<?php echo site_url('pendaftaran/addtindakan')?>";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('pendaftaran/addtindakan')?>/"+id;
            return false;
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('pendaftaran/hapustindakan')?>/"+id;
            return false;
        });
    })
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <?php echo form_open("pendaftaran/tindakan",array("id"=>"formcari"));?>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group"><label class="col-xs-2 control-label">Nama Tindakan</label>
                    <div class="col-xs-10">
                        <input type=text name=nama_tindakan class="form-control" value='<?php echo $nama_tindakan;?>'>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">Tampilan perhalaman</label>
                    <div class="col-xs-10">
                        <div class="input-group">
                            <input type=text name=baris class="form-control" value='<?php echo $baris;?>'>
                            <span class="input-group-btn"><button type="submit" name="Submit" class="btn btn-info" ><i class='fa fa-search'></i>&nbsp;View</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
    </div>
    <?php echo $this->session->flashdata('message');?>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-striped table-bordered" id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="20px" class='text-center'>No</th>
                        <th>Nama Tindakan</th>
                        <th width="130px">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = $posisi;
                    foreach ($q3->result() as $row){
                        $i++;
                        echo "<tr id=data href='".$row->id_tindakan."'>
                              <td class='text-center'>".$i."</td>";
                        echo "<td>".$row->nama_tindakan."</td>";
                        echo "<td class='text-right'>".number_format($row->karcis,0,',','.')."</td>
                              </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="add btn btn-primary" type="button" ><i class="fa fa-plus"></i> Add</button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
                    <button class="hapus btn btn-danger" type="button"><i class="fa fa-times"></i> Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>