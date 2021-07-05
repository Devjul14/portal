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
        // $('.back').click(function(){
        //     window.location = "<?php echo site_url('lab/ralan');?>";
        // });
        $('.back').click(function(){
            var cari_noreg = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_noreg:cari_noreg},
                url   : "<?php echo site_url('lab/cari_labralan');?>",
                success : function(result){
                    window.location = "<?php echo site_url('lab/ralan');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.cetak').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('lab/cetak');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $('.cetak_covid').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('lab/cetak_covid');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $('.cetak_covid2').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var jenis_kelamin= $("[name='jenis_kelamin']").val();
            var url = "<?php echo site_url('lab/cetak_covid2');?>/"+no_reg+"/"+jenis_kelamin;
            openCenteredWindow(url);
        });
        $('.lunas').click(function(){
            $(".modalnotif").modal("show");
            var total = $("[name='total']").val();
            $(".total").html("Rp. "+total);
        });
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>kasir/hapustindakan",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $(".ambil").click(function(){
            var tindakan = $("select[name='tindakan']").val();
            var url = "<?php echo site_url('lab/ambildatanormal');?>/"+tindakan;
            openCenteredWindow(url);
            return false;
        });
        $("select[name='dokter']").change(function(){
            var rad = $(this).find(':selected').attr('data-id');
            $("input[name='radiologi']").val(rad);
        });
        $("select[name='tindakan']").change(function(){
            var no_reg = $("input[name='no_reg']").val();
            var no_pasien = $("input[name='no_pasien']").val();
            var tindakan = $(this).val();
            window.location = "<?php echo site_url('lab/ekspertisi');?>/"+no_pasien+"/"+no_reg+"/"+tindakan;
        });
        $("select[name='dokter']").select2();
        $('#formsave').submit(function (e) {
			var dokter = $("[name='dokter']").val();
			var analys = $("[name='analys']").val();
			if (dokter=="" || analys==""){
				alert("Dokter dan Analys isi terlebih dahulu");
				e.preventDefault();
			} else {
                return;
            }
			return false;
		})
    });
</script>
<?php
    if ($q) {
        $action     = "edit";
    } else {
        $action = "simpan";
    }
    // echo $action;

?>
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
    <?php
        echo form_open("lab/simpanekspertisi/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
    ?>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2 control-label">No. Reg</label>
                <div class="col-md-2">
                    <input type="hidden" name="jenis_kelamin" value="<?php echo $row->jenis_kelamin;?>">
                    <input type="text" class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                </div>
                <label class="col-md-1 control-label">No. RM</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name='no_pasien' readonly value="<?php echo $no_pasien;?>"/>
                </div>
                <label class="col-md-2 control-label">Nama Pasien</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Dokter</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name='dokter' readonly value="<?php echo $row->nama_dokter;?>"/>
                </div>
                <label class="col-md-2 control-label">Analys</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name='analys' readonly value="<?php echo $row->namaanalys;?>"/>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
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
                        foreach($k->result() as $data){
                            if ($kode_judul!=$data->kode_judul) {
                                echo "<tr class='bg-orange'>";
                                echo "<td colspan='6'>".$data->judul."</td>";
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
                            echo "<td>".$nama_tindakan."</td>";
                            $input_n1n2rp  = "<div class='row'><div class='col-md-4'>ORF 1AB<input type='text' class='form-control' name='rp[".$data->kode."]' value='".(isset($hasil[$data->kode]) ? $hasil[$data->kode]->rp : "")."'></div>";
                            $input_n1n2rp .= "<div class='col-md-4'>GENE N<input type='text' class='form-control' name='n1[".$data->kode."]' value='".(isset($hasil[$data->kode]) ? $hasil[$data->kode]->n1 : "")."'></div>";
                            $input_n1n2rp .= "<div class='col-md-4'>GENE E<input type='text' class='form-control' name='n2[".$data->kode."]' value='".(isset($hasil[$data->kode]) ? $hasil[$data->kode]->n2 : "")."'></div></div>";
                            echo "<td>".$data->nama."<br>".($data->kode_tindakan=="L158" ? $input_n1n2rp : "")."</td>";
                            echo "<td>".(strlen($data->kode)<4 ? "" : "<input type='text' class='form-control' name='hasil[".$data->kode."]' value='".(isset($hasil[$data->kode]) ? $hasil[$data->kode]->hasil : "")."'>")."</td>";
                            echo "<td>".$data->satuan."</td>";
                            echo "<td>".$rujukan."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="cetak_covid2 btn bg-maroon" type="button"><i class="fa fa-print"></i> Cetak Covid 2</button>
                    <button class="cetak_covid btn btn-danger" type="button"><i class="fa fa-print"></i> Cetak Covid</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="cetak btn btn-primary" type="button"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
</style>
