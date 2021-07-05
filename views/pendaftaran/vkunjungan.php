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
        $("input[name='no_kk']").change(function(){
            var no_kk = $(this).val();
            var id_puskesmas = $("select[name='id_puskesmas']").val();
            $("#nama_pasien").load("<?php echo site_url('pendaftaran/getlistpasien');?>/"+id_puskesmas+"/"+no_kk);
            $("#nama_kk").load("<?php echo site_url('pendaftaran/getnamakk');?>/"+id_puskesmas+"/"+no_kk+"/Y");
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
        $("table#cari td a").click(function(){
            close();
            var url = $(this).attr("href");
            window.opener.$("input[name='no_kk']").val(url);
            window.opener.$("input[name='no_kk']").change();
            return false;
        });
        $(".edit").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/umumdetail')?>/"+id+"/edit";
            return false;
        });
        $(".hapus").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/hapuspasien_igd')?>/"+id;
            return false;
        });
    })
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <?php echo form_open("pendaftaran/listkunjungan",array("id"=>"formcari"));?>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-xs-2">Tanggal</label>
                        <div class="col-xs-4">
                            <input type="text" name="tgl" class="form-control" value="<?php echo $tgl?>">
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2">Layanan</label>
                        <div class="col-xs-10">
                            <select name="id_layanan" class="form-control">
                                <?php 
                                    foreach($q2->result() as $row){
                                        echo "<option value='".$row->id_layanan."' ".(($id_layanan==$row->id_layanan) ? "selected" : "").">".$row->layanan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2">Tampilan </label>
                    <div class="col-xs-10">
                        <div class="input-group">
                            <input type="text" name="baris" class="form-control" value="<?php echo $baris?>">
                            <span class="input-group-btn"><button type="submit" name="Submit" class="btn btn-primary"><i class='fa fa-search'></i>&nbsp;View</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-xs-2">Ke Halaman</label>
                    <div class="col-xs-7">
                        <select class="form-control" name="hal">
                            <?php
                                for($i=1;$i<=$npage;$i++){
                                    if($i==$hal) $sel=" selected "; else $sel=""; 
                                    echo "<option value='".$i."'" . $sel ."> $i </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <div class="btn-group">
                            <button class="btn btn-warning" type="button" name="prev"><i class="fa fa-arrow-left"></i> Prev</button>
                            <button class="btn btn-warning" type="button" name="next"><i class="fa fa-arrow-right"></i> Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <div class="box box-primary">
        <?php echo $this->session->flashdata('message');?>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="5%">No</th>
                        <th width="10%">Tanggal</th>
                        <th width="10">No. Pasien</th>
                        <th width="40%">Nama</th>
                        <th width="20%">Alamat</th>
                        <th width="15%">Telp</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = $posisi;
                    $no_kk = '';
                    foreach ($q->result() as $row){
                        $i++;
                        echo "<tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
                              <td class='text-center'>".$i."</td>
                              <td class='text-center'>".date('d-m-Y',strtotime($row->tgl_kunjungan))."</td>";
                        echo "<td class='text-right'>".$row->no_pasien."</td>
                              <td>".$row->nama_pasien."</td>
                              <td>".$row->alamat."</td>
                              <td class='text-center'>".$row->telpon."</td>
                              </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>