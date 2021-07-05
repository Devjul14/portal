<style type="text/css">
    .seleksi{
        background-color: #cfd7e6;
    }
</style>
<script>
    $(document).ready(function() {
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
        $(".edit").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/umumdetail')?>/"+id+"/edit";
            return false;
        });
        $(".inap").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/inap')?>/"+id;
            return false;
        });
        $(".hapus").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/hapuspasien_igd')?>/"+id;
            return false;
        });
    });
</script>
    <div class="col-lg-12">
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
            <div class="box-body" >
                <div class="form-horizontal">
                <?php echo form_open("umum/listumum",array("id"=>"formcari"));?>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tanggal</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" name="tgl1" class="form-control" value="<?php echo $tgl1?>">
                                <span class="input-group-addon">s.d</span>
                                <input type="text" name="tgl2" class="form-control" value="<?php echo $tgl2?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tampilkan Perhalaman</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" name="baris" class="form-control" value="<?=$baris;?>">
                                <span class="input-group-btn"><button class="btn btn-success" type="submit"><i class="fa fa-search"></i> View</button></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Ke Halaman</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="hal">
                                <?php
                                    for($i=1;$i<=$npage;$i++){
                                        if($i==$hal) $sel=" selected "; else $sel=""; 
                                        echo "<option value='".$i."'" . $sel ."> $i </option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="box-footer">
                <div class="text-center">
                    <div class="btn-group">
                        <button class="btn btn-warning" type="button" name="prev"><i class="fa fa-arrow-left"></i> Prev</button>
                        <button class="btn btn-warning" type="button" name="next"><i class="fa fa-arrow-right"></i> Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-hover" id="myTable">
                    <thead>
                        <tr class="bg-navy">
                          <th width="50px">No</th>
                           <th width="100px">Tgl</th>
                           <th width="130px">No. Pasien</th>
                           <th>Nama</th>
                           <th width="400px">Diagnosa Penyakit</th>
                           <th width="100px">Action</th>
                           <th width="100px">Rawat Inap</th>
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
                                        <td class='text-center'>".$i."</td>
                                      <td class='text-center'>".$row->tanggal."</td>";
                                echo "<td align=right>".$row->no_pasien."</td>
                                      <td>".$row->nama_pasien."</td>
                                      <td class='text-center'>&nbsp;</td>
                                      <td class='text-center'>
                                        <button type='button' class='edit btn btn-success btn-sm' value='".$row->id_pendaftaran."'>
                                            <i class='fa fa-edit'></i>
                                        </button>
                                        <button type='button' class='hapus btn btn-danger btn-sm' value='".$row->id_pendaftaran."/".$row->id_pasien."'>
                                            <i class='fa fa-trash'></i>
                                        </button>
                                      </td>
                                      <td class='text-center'>
                                        <button type='button' class='inap btn btn-primary btn-sm' value='".$row->id_pendaftaran."'>
                                            <i class='fa fa-bed'></i>
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