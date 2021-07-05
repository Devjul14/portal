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
         $("[name='tindakan_radiologi']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var tindakan_radiologi= $(this).val();
            // alert(radiografer);
            $.ajax({
                url : "<?php echo base_url();?>pendaftaran/addtindakan_inapradiologi",
                method : "POST",
                data : {no_reg: no_reg, tindakan_radiologi: tindakan_radiologi},
                success: function(data){
                     location.reload();
                }
            });
        });
         $("[name='tindakan_lab']").change(function(){
            var no_reg= $("[name='no_reg']").val();
            var tindakan_lab= $(this).val();
            // alert(radiografer);
            $.ajax({
                url : "<?php echo base_url();?>pendaftaran/addtindakan_inaplab",
                method : "POST",
                data : {no_reg: no_reg, tindakan_lab: tindakan_lab},
                success: function(data){
                     location.reload();
                }
            });
        });
        $("[name='jenis_nyeri']").hide();
        $("[name='lokasi']").hide();
        $("[name='frekuensi']").hide();
        $("[name='durasi']").hide();
        $("[name='diantar']").hide();
        $("[name='rujuk_ke']").hide();
        $("[name='alasan_rujuk']").hide();
        $("[name='skrining_gizi2']").hide();
        // $("[name='kelainan1']").hide();
        $(".tindakan").hide();

        // $("[name='tindakan_lab']").hide();
        $("[name='pemeriksaan_fisik1']").change(function(){
            if ($("[name='pemeriksaan_fisik1']").attr("checked", true)){
                $("[name='kelainan1']").hide();
            }
            else if ($("[name='pemeriksaan_fisik1']").attr("checked", false)){
                $("[name='kelainan1']").show();
            }
        });
        $("[name='pemeriksaan_fisik2']").change(function(){
            if ($("[name='pemeriksaan_fisik2']").attr("checked", true)){
                $("[name='kelainan2']").hide();
            }
            else if ($("[name='pemeriksaan_fisik2']").attr("checked", false)){
                $("[name='kelainan2']").show();
            }
        });
        $("[name='pemeriksaan_fisik3']").change(function(){
            if ($("[name='pemeriksaan_fisik3']").attr("checked", true)){
                $("[name='kelainan3']").hide();
            }
            else if ($("[name='pemeriksaan_fisik3']").attr("checked", false)){
                $("[name='kelainan3']").show();
            }
        });
        $("[name='pemeriksaan_fisik4']").change(function(){
            if ($("[name='pemeriksaan_fisik4']").attr("checked", true)){
                $("[name='kelainan4']").hide();
            }
            else if ($("[name='pemeriksaan_fisik4']").attr("checked", false)){
                $("[name='kelainan4']").show();
            }
        });
        $("[name='pemeriksaan_fisik5']").change(function(){
            if ($("[name='pemeriksaan_fisik5']").attr("checked", true)){
                $("[name='kelainan5']").hide();
            }
            else if ($("[name='pemeriksaan_fisik5']").attr("checked", false)){
                $("[name='kelainan5']").show();
            }
        });
        $("[name='pemeriksaan_fisik6']").change(function(){
            if ($("[name='pemeriksaan_fisik6']").attr("checked", true)){
                $("[name='kelainan6']").hide();
            }
            else if ($("[name='pemeriksaan_fisik6']").attr("checked", false)){
                $("[name='kelainan6']").show();
            }
        });
        $("[name='pemeriksaan_fisik7']").change(function(){
            if ($("[name='pemeriksaan_fisik7']").attr("checked", true)){
                $("[name='kelainan7']").hide();
            }
            else if ($("[name='pemeriksaan_fisik7']").attr("checked", false)){
                $("[name='kelainan7']").show();
            }
        });
        $("[name='pemeriksaan_fisik8']").change(function(){
            if ($("[name='pemeriksaan_fisik8']").attr("checked", true)){
                $("[name='kelainan8']").hide();
            }
            else if ($("[name='pemeriksaan_fisik8']").attr("checked", false)){
                $("[name='kelainan8']").show();
            }
        });
        $("[name='pemeriksaan_fisik9']").change(function(){
            if ($("[name='pemeriksaan_fisik9']").attr("checked", true)){
                $("[name='kelainan9']").hide();
            }
            else if ($("[name='pemeriksaan_fisik9']").attr("checked", false)){
                $("[name='kelainan9']").show();
            }
        });
        $("[name='pemeriksaan_fisik10']").change(function(){
            if ($("[name='pemeriksaan_fisik10']").attr("checked", true)){
                $("[name='kelainan10']").hide();
            }
            else if ($("[name='pemeriksaan_fisik10']").attr("checked", false)){
                $("[name='kelainan10']").show();
            }
        });
        $("[name='pemeriksaan_fisik11']").change(function(){
            if ($("[name='pemeriksaan_fisik11']").attr("checked", true)){
                $("[name='kelainan11']").hide();
            }
            else if ($("[name='pemeriksaan_fisik11']").attr("checked", false)){
                $("[name='kelainan11']").show();
            }
        });
        $("[name='nyeri']").change(function(){
            if ($("[name='nyeri']").val() == "YA"){
                $("[name='jenis_nyeri']").show();
                $("[name='lokasi']").show();
                $("[name='frekuensi']").show();
                $("[name='durasi']").show();
            }else if($("[name='nyeri']").val() != "YA"){
                $("[name='jenis_nyeri']").hide();
                $("[name='lokasi']").hide();
                $("[name='frekuensi']").hide();
                $("[name='durasi']").hide();
            }
        });
        $("[name='kedatangan']").change(function(){
            if ($("[name='kedatangan']").val() == "Diantar Oleh"){
                $("[name='diantar']").show();
            }else if($("[name='kedatangan']").val() != "Diantar Oleh"){
                $("[name='diantar']").hide();
            }
        });
        $("[name='tindak_lanjut']").change(function(){
            if ($("[name='tindak_lanjut']").val() == "Rujuk"){
                $("[name='rujuk_ke']").show();
                $("[name='alasan_rujuk']").show();
            }else if($("[name='tindak_lanjut']").val() != "Rujuk"){
                $("[name='rujuk_ke']").hide();
                $("[name='alasan_rujuk']").hide();
            }
        });
        $("[name='skrining_gizi']").change(function(){
            if ($("[name='skrining_gizi']").val() == "> 2"){
                $("[name='skrining_gizi2']").show();
            }else if($("[name='skrining_gizi']").val() != " > 2"){
                $("[name='skrining_gizi2']").hide();
            }
        });
        $("[name='pemeriksaan_penunjang1']").change(function(){
            if ($("[name='pemeriksaan_penunjang1']").val() == "Radiologi"){
                $(".tindakan").show();
                $(".tindakan_radiologi").show();
                $(".tindakan_lab").hide();
            }else if($("[name='pemeriksaan_penunjang1']").val() == "Lab"){
                $(".tindakan").show();
                $(".tindakan_lab").show();
                $(".tindakan_radiologi").hide();
            }else if($("[name='pemeriksaan_penunjang1']").val() == "Penunjang"){
                $(".tindakan").show();
                $(".penunjang").show();
                $(".tindakan_lab").hide();
                $(".tindakan_radiologi").hide();
            }else{
                $(".tindakan").hide();
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal_masuk']").datepicker({
            dateFormat : formattgl,
        });
        $('.back').click(function(){
            window.location = "<?php echo site_url('pendaftaran/rawat_inapdokter');?>";
            
        });
        $('.cetak').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('pendaftaran/cetaktriage_inap');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $('.terapi').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var no_rm= $("[name='no_rm']").val();
            window.location ="<?php echo site_url('pendaftaran/apotek_inapigd');?>/"+no_rm+"/"+no_reg;
            return false;
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
            var url = "<?php echo site_url('pendaftaran/ambiltriage');?>/";
            openCenteredWindow(url);
            return false;
        });
        $("select[name='dokter']").change(function(){
            var rad = $(this).find(':selected').attr('data-id');
            $("input[name='radiologi']").val(rad);
        });
        
        $("select[name='tindakan_radiologi']").select2();
        $("select[name='tindakan_lab']").select2();
        $("select[name='terapi1']").select2();
        $("select[name='penunjang']").select2();
        $("select[name='keputusan']").select2();

        // $("textarea[name='hasil_pemeriksaan']").change(function(){
    
                // $("textarea[name='hasil_pemeriksaan']").wysihtml5();
        // });

    });
</script>
<?php
    if ($q1) {
        $nama_pasien      = $q->nama_pasien;
    } else {
        $nama_pasien  = "";
        
    }

?>
<div class="col-md-12">
    <?php
        echo form_open("pendaftaran/simpanpasientriage_inap/".$no_reg,array("id"=>"formsave","class"=>"form-horizontal"));
    ?>
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
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='nama_pasien' value="<?php echo $nama_pasien;?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-left">
                <div class="form-group">
                    <div class="col-md-12">
                        <!-- <button class="ambil btn btn-warning">
                            Pilih Triage
                        </button> -->
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<div class="modal fade modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy">Yakin akan membayar sejumlah</div>
            <div class="modal-body">
                <h2 class="total"></h2>
            </div>
            <div class="modal-footer">
                <button class="okbayar btn btn-success" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
    #hp{
    
    }
</style>