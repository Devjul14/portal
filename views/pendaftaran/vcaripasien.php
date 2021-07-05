<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Pasien</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/logo.ico" type="image/x-icon" />
<script>
    $(document).ready(function(){
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("table#cari tr:odd").css("background-color", "#d5e8ff");
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
        var formattgl = "yy-mm-dd";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
        $("a.nokk").click(function(){
            close();
            var url = $(this).attr("href");
            window.opener.$("input[name='no_kk']").val(url);
            window.opener.$("input[name='no_kk']").change();
            return false;
        });
    });
</script>
</head>

<body>
<div class="row margin">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("pendaftaran/caripasien/".$id_puskesmas,array("id"=>"formcari"));?>
                <div class="form-horizontal">
                    <div class="form-group"><label class="col-xs-3 control-label">Jenis Kelamin</label>
                        <div class="col-xs-9">
                            <select name=jenis_kelamin class="form-control">
                            <option value="">---Pilih---</option>
                                <?php
                                    foreach ($q1->result() as $row){
                                        if ($jenis_kelamin==$row->jenis_kelamin) $seleksi = "selected"; else $seleksi = "";
                                        echo "<option value='".$row->jenis_kelamin."' ".$seleksi.">".$row->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Status Pembayaran</label>
                        <div class="col-xs-9">
                            <select name="status_pembayaran" class="form-control">
                              <option value="">---Pilih---</option>
                                <?php 
                                    foreach($q2->result() as $row){
                                        if ($status_pembayaran==$row->status_pembayaran) $seleksi = "selected"; else $seleksi = "";
                                        echo "<option value='".$row->status_pembayaran."' ".$seleksi.">".$row->status_pembayaran."</option>";
                                    }
                                ?>
                              </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-xs-3 control-label">Tanggal Daftar</label>
                        <div class="col-xs-9">
                            <div class="row">
                                <div class="col-xs-6"><input type=text name=tgl1 class="form-control" value='<?php echo $tgl1;?>'></div>
                                <div class="col-xs-6"><input type=text name=tgl2 class="form-control" value='<?php echo $tgl2;?>'></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">&nbsp;</label>
                        <div class="col-xs-9"><input type="checkbox" name="iskk" <?php echo $chk; ?> value="Y"> Hanya ditampilkan KK</div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Tampilan perhalaman</label>
                        <div class="col-xs-9">
                            <div class="input-group">
                                <input type=text name=baris class="form-control" value='<?php echo $baris;?>'>
                                <span class="input-group-btn"><button type="submit" name="Submit" class="btn btn-info"><i class='fa fa-search'></i>&nbsp;View</button></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-xs-3 control-label">Ke Halaman</label>
                        <div class="col-xs-5">
                            <select name=hal style="width:100" class="form-control">
                            <?php
                                for($i=1;$i<=$npage;$i++){
                                    if($i==$hal) $sel=" selected "; else $sel=""; 
                                    echo "<option value='".$i."'" . $sel ."> $i </option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <div class="btn-group">
                                <button name=prev class="btn btn-warning">Prev</button>
                                <button name=next class="btn btn-warning">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover " id="myTable" >
                    <thead>
                        <tr class="bg-navy">
                            <th width="49">No</th>
                            <th width="69">No. KK</th>
                            <th width="83">No. Pasien</th>
                            <th width="224">Nama</th>
                            <th width="43">KK</th>
                            <th width="110">Status Pemb.</th>
                            <th width="79" class='text-center'>Hub. Kel</th>
                            <th width="85" class='text-center'>Tgl. daftar</th> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = $posisi;
                        $no_kk = '';
                        foreach ($q3->result() as $row){
                            $i++;
                            echo "<tr>
                                  <td align=center>".$i."</td>";
                            if ($no_kk<>$row->no_kk){ 
                                echo "<td align=center><a href='".$row->no_kk."' class='nokk btn btn-small btn-info'>".$row->no_kk."</a></td>";
                                $no_kk = $row->no_kk;
                            }
                            else
                                echo "<td align=center>&nbsp;</td>";
                            echo "<td align=right>".$row->no_pasien."</td>
                                  <td>".$row->nama_pasien."</td>
                                  <td align=center>".$row->iskk."</td>
                                  <td align=center>".$row->status_pembayaran."</td>
                                  <td align=center>".$row->status_keluarga."</td>
                                  <td align=center>".date("d-m-Y",strtotime($row->tanggal))."</td>
                                  </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Mainly scripts -->
<!-- <script src="<?php echo base_url();?>js/jquery-2.1.1.js"></script> -->
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url();?>js/inspinia.js"></script>
<script src="<?php echo base_url();?>js/plugins/pace/pace.min.js"></script>

<script src="<?php echo base_url();?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

</body>

</html>
