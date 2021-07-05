<style type="text/css">
    .seleksi{
        background-color: #cfd7e6;
    }
</style>
<script>
   $(document).ready(function(){
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
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
        var formattgl = "dd-mm-yyyy";
        $("input[name='tgl1']").datepicker({ format : formattgl });
        $("input[name='tgl2']").datepicker({ format : formattgl });

        $("table#cari td a").click(function(){
            close();
            var url = $(this).attr("href");
            window.opener.$("input[name='no_kk']").val(url);
            window.opener.$("input[name='no_kk']").change();
            return false;
        });
        $(".view").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('kasir/listpasien')?>/"+id;
            return false;
        });
    })
</script>
<?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div>";
    }

?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content" >
                <div class="form-horizontal">
                <?php echo form_open("kasir",array("id"=>"formcari"));?>
                    <div class="form-group">
                        <label class="col-sm-2">Tanggal</label>
                        <div class="col-sm-2">
                            <input type="text" name="tgl1" class="form-control" value="<?=$tgl1?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="tgl2" class="form-control" value="<?=$tgl2?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tampilkan Perhalaman</label>
                        <div class="col-sm-4">
                            <input type="text" name="baris" class="form-control" value="<?=$baris;?>">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-outline btn-success  dim" type="submit"><i class="fa fa-search"></i> View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2">Ke Halaman</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="hal">
                                <?php
                                    for($i=1;$i<=$npage;$i++){
                                        if($i==$hal) $sel=" selected "; else $sel=""; 
                                        echo "<option value='".$i."'" . $sel ."> $i </option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-outline btn-warning" type="button" name="prev"><i class="fa fa-arrow-left"></i> Prev</button>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-outline btn-warning" type="button" name="next"><i class="fa fa-arrow-right"></i> Next</button>
                        </div>
                    </div>
                </div>                
            </div>
            <?php echo form_close(); ?>
            <div class="ibox-content">
                <table class="table table-bordered table-hover" id="myTable">
                    <thead>
                        <tr>
                           <th width="20" >No</th>
                           <th width="100" >Tgl</th>
                           <th width="83" >No. Pasien</th>
                           <th>Nama</th>
                           <th width="300" >Layanan (Poli)</th>
                           <th width="100" >Action</th>
                         </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = $posisi;
                            $no_kk = '';
                            foreach ($q->result() as $row){
                                $i++;
                                echo "
                                    <tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
                                        <td align=center>".$i."</td>
                                        <td align=center>".$row->tanggal."</td>
                                        <td align=right>".$row->no_pasien."</td>
                                        <td>".$row->nama_pasien."</td>
                                        <td align=center>".$row->layanan."</td>
                                        <td style='text-align:center'>
                                            <button type='button' class='view btn btn-success' value='".$row->id_layanan."/".$row->id_pendaftaran."'>
                                                <i class='fa fa-edit'></i>
                                            </button>
                                        </td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>