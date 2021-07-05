<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
        $('.back').click(function(){
            var cari_no = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_no:cari_no},
                url   : "<?php echo site_url('pendaftaran/getcaripasien_inap');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran/rawat_inap');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        var formattgl = "dd-mm-yy";
        $("[name='tgl1_print'],[name='tgl2_print']").datepicker({
            dateFormat : formattgl,
        });
        $("select[name='tanggal_pemeriksaan']").change(function(){
            var no_reg = $("input[name='no_reg']").val();
            var no_pasien = $("input[name='no_pasien']").val();
            var t = $(this).val();
            window.location = "<?php echo site_url('pendaftaran/ekspertisilab_inap');?>/"+no_pasien+"/"+no_reg+"/"+t;
        });
        $('.cetak').click(function(){
            var no_reg= $("[name='no_reg']").val();
            // var tgl1_print= $("[name='tgl1_print']").val();
            // var tgl2_print= $("[name='tgl2_print']").val();
            var t = $("select[name='tanggal_pemeriksaan']").val();
            if (t==""){
                alert("Pilih tanggal pemeriksaan !!!");
            } else {
                var url = "<?php echo site_url('lab/cetakinap');?>/"+no_reg+"/"+t;
                openCenteredWindow(url);
            }
        });
        $('.cetak_covid').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var t = $("select[name='tanggal_pemeriksaan']").val();
            if (t==""){
                alert("Pilih tanggal pemeriksaan !!!");
            } else {
                var url = "<?php echo site_url('lab/cetakcovid_inap');?>/"+no_reg+"/"+t;
                openCenteredWindow(url);
                //window.location = "<?php echo site_url('lab/cetakcovid_inap');?>/"+no_reg+"/"+t;
            }
            // $(".formcetak").modal("show");
        });
        $('.cetak_covid2').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var jenis_kelamin= $("[name='jenis_kelamin']").val();
            var t = $("select[name='tanggal_pemeriksaan']").val();
            if (t==""){
                alert("Pilih tanggal pemeriksaan !!!");
            } else {
                var url = "<?php echo site_url('lab/cetakcovid_inap2');?>/"+no_reg+"/"+t+"/"+jenis_kelamin;
                openCenteredWindow(url);
                //window.location = "<?php echo site_url('lab/cetakcovid_inap2');?>/"+no_reg+"/"+t+"/"+jenis_kelamin;
            }
            // $(".formcetak").modal("show");
        });
    });
    
</script>
<div class="col-md-12">
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
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='nama_pasien' readonly value="<?php echo $row['pasien']->nama_pasien;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_ruangan' readonly value="<?php echo $row['ruangan']->nama_ruangan;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="hidden" readonly class="form-control" name='kode_kelas' readonly value="<?php echo $row['kelas']->kode_kelas;?>"/>
                        <input type="text" readonly class="form-control" name='nama_kelas' readonly value="<?php echo $row['kelas']->nama_kelas;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kamar</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='kode_kamar' readonly value="<?php echo $row['kamar']->kode_kamar;?>"/>
                    </div>
                </div>  
                <div class="form-group">
                    <label class="col-md-2 control-label">Dokter</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='dokter' readonly value="<?php echo $row['pasieninap']->nama_dokter;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Analys</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='analys' readonly value="<?php echo $row['pasieninap']->namaanalys;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Tanggal Pemeriksaan</label>
                    <div class="col-md-3">
                        <select class="form-control"  name="tanggal_pemeriksaan">
                            <option value="">-----</option>
                            <?php
                                foreach ($ks->result() as $kas) {
                                    echo "
                                        <option value='".$kas->tanggal."/".$kas->pemeriksaan."' ".($kas->pemeriksaan==$pemeriksaan && $kas->tanggal == $tgl ? "selected" : "")."> Tanggal : ".date('d-m-Y',strtotime($kas->tanggal))." || Pemeriksaan ke- ".$kas->pemeriksaan."</option>
                                    ";

                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
   </div>
   
    <div class="box box-primary">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover " id="myTable" >
                    <thead>
                        <tr class="bg-navy">
                            <th width="10" class='text-center'>No</th>
                            <th width="100px" class="text-center">Tanggal</th>
                            <th class="text-center">Nama Tindakan</th>
                            <th width="300" class='text-center'>Jenis Pemeriksaan</th>
                            <th width="100" class='text-center'>Hasil</th>
                            <th width="100" class='text-center'>Satuan</th>
                            <th width="200" class='text-center'>Nilai Rujukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            $kode_judul = $kode_tindakan = "";

                            $tgl1_print = $tgl2_print = "";
                            foreach($k->result() as $data){
                                $tgl1_print = $tgl1_print=="" ? date("d-m-Y",strtotime($data->tanggal)) : $tgl1_print;
                                $tgl2_print = date("d-m-Y",strtotime($data->tanggal));
                                if ($kode_judul!=$data->kode_judul) {
                                    echo "<tr class='bg-orange'>";
                                    echo "<td colspan='7'>".$data->judul."</td>";
                                    $kode_judul = $data->kode_judul;
                                    $i = 0;
                                }
                                if ($data->jenis_kelamin=="L") {
                                    $rujukan = $data->pria;
                                } else {
                                    $rujukan = $data->wanita;
                                }
                                $i++;
                                if ($kode_tindakan!=$data->kode_tindakan){
                                    $nama_tindakan = $data->nama_tindakan;
                                    $kode_tindakan = $data->kode_tindakan;
                                } else {
                                    $nama_tindakan = "";
                                }
                                // if ($data->no_urut == "59") {
                                //     $nama_tindakan = "Sediment";   
                                // }
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".date("d-m-Y",strtotime($data->tanggal))."</td>";
                                // echo "<td>".$data->tanggal."</td>";
                                echo "<td>".$nama_tindakan."</td>";
                                echo "<td>".$data->nama."</td>";
                                echo "<td>".(isset($hasil[$data->kode][$data->pemeriksaan][$data->tanggal]) ? $hasil[$data->kode][$data->pemeriksaan][$data->tanggal]->hasil : "")."</td>";
                                echo "<td>".$data->satuan."</td>";
                                echo "<td>".$rujukan."</td>";
                                echo "</tr>";
                            }
                            $tgl1_print = $tgl1_print=="" ? date("d-m-Y") : $tgl1_print;
                            $tgl2_print = $tgl2_print=="" ? date("d-m-Y") : $tgl2_print;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <div class="box-footer">
        <div class="pull-right">
            <div class="btn-group">
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="cetak_covid2 btn bg-maroon" type="button"><i class="fa fa-print"></i> Cetak Covid 2</button>
                    <button class="cetak_covid btn btn-danger" type="button"><i class="fa fa-print"></i> Cetak Covid</button>
                    <button class="cetak btn btn-primary" type="button"><i class="fa fa-print"></i> Cetak</button>
            </div>
                
            </div>
        </div>
    </div>
</div>