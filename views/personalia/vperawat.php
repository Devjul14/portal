<script src="<?php echo base_url();?>js/jquery.signature.js"></script>
<!-- <script src="<?php echo base_url();?>js/jquery.ui.touch-punch.min.js"></script> -->
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
        $(".add").click(function(){
            window.location = "<?php echo site_url('personalia/addperawatbaru')?>";
            return false;
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location = "<?php echo site_url('personalia/addperawatbaru')?>/"+id;
            return false;
        });
        $(".migrasi").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('pendaftaran/migrasi');?>/"+id;
            // openCenteredWindow(url);
            return false;
        });
        $(".inap").click(function(){
            var id = $(".bg-gray").attr("href");
            var status = $(".bg-gray").attr("status_pinjam");
            if(status == 1){
                alert("No RM Sedang Dipinjam")
            } else {
                window.location ="<?php echo site_url('pendaftaran/viewinap');?>/"+id;
            }
            return false;
        });
        $(".history").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('pendaftaran/viewhistory');?>/"+id;
            // openCenteredWindow(url);
            return false;
        });
        $(".jadwal").click(function(){
            window.location ="<?php echo site_url('personalia/jadwal_perawat');?>";
            return false;
        });
        $(".simpeg").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/simpeg');?>/"+id;
            return false;
        });
        $(".pendidikan").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/pendidikan');?>/"+id;
            return false;
        });
        $(".pangkat").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/riwayat_pangkat');?>/"+id;
            return false;
        });
        $(".diklat").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/diklat');?>/"+id;
            return false;
        });
        $(".militer").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/militer');?>/"+id;
            return false;
        });
        $(".penugasan").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/penugasan');?>/"+id;
            return false;
        });
        $(".kursus").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/kursus');?>/"+id;
            return false;
        });
        $(".skp").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/skp');?>/"+id;
            return false;
        });
        $(".jabatan").click(function(){
            var id = $(".bg-gray").attr("href");
            window.location ="<?php echo site_url('perawat/jabatan');?>/"+id;
            return false;
        });

        $(".cari_no").click(function() {

            $(".modal_cari_no").modal("show");
            $("[name='cari_no']").focus();
            
            return false;
        });
        $(".cari_nama").click(function() {
            $(".modal_cari_nama").modal("show");
            $("[name='cari_nama']").focus();
            return false;
        });
        $(".cari_nip").click(function() {
            $(".modal_cari_nip").modal("show");
            $("[name='cari_nip']").focus();
            return false;
        });
        $("[name='cari_nama']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $("[name='cari_no']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $("[name='cari_nip']").keyup(function(e) {
            if (e.keyCode == 13) pencarian();
        });
        $(".tmb_cari_nama, .tmb_cari_no, .tmb_cari_nip").click(function() {
            pencarian();
            return false;
        });
        $(".reset").click(function(){
            var url = "<?php echo site_url('personalia/reset');?>";
            window.location = url;
        });
        $(".cetak").click(function() {
            var id      = $(".bg-gray").attr("href");
            var url     = "<?php echo site_url('personalia/cetak_perawat'); ?>/" + id;
            openCenteredWindow(url);
            return false;
        });
    });
    function pencarian() {
            var cari_no = $("[name='cari_no']").val();
            var cari_nip = $("[name='cari_nip']").val();
            var cari_nama = $("[name='cari_nama']").val();
            $.ajax({
                type: "POST",
                data: {
                    cari_no: cari_no,
                    cari_nama: cari_nama,
                    cari_nip: cari_nip
                },
                url: "<?php echo site_url('personalia/getcari_perawat'); ?>",
                success: function(result) {
                    window.location = "<?php echo site_url('personalia'); ?>";
                },
                error: function(result) {
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
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="15%" class='text-center'>NIP</th>
                        <th>Nama</th>
                        <th width="15%" class='text-center'>KTP</th>
                        <th class='text-center'>Jenis Kelamin</th>
                        <th class='text-center'>Alamat</th>
                        <th class='text-center'>Status Pegawai</th>
                        <th class='text-center'>Jenis Tenaga</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no_kk = '';
                    foreach ($q3->result() as $row){
                        $jk = $row->jenis_kelamin ;
                        $njt = $row->namajenis_tenaga;
                        // $pangkat = $row->keterangan;
                        echo "<tr id=data href='".$row->id_perawat."' nama='".$row->nama_perawat."' status_pinjam='".$row->status_pinjam."'>";
                        echo "<td class='text-center'>".$row->id_perawat."</td>";
                        echo "<td>".$row->nama_perawat."</td>";
                        echo "<td class='text-center'>".$row->ktp."</td>";
                        echo "<td class='text-center'>".($jk=="L" ? "Laki-Laki" : ($jk=="P" ? "Perempuan" : "-" ))."</td>";
                        echo "<td>".$row->alamat."</td>";
                        echo "<td>".$row->keterangan."</td>";
                        echo "<td>".($njt=="" || $njt=="null" ? "-" : ($njt))."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="pull-left">
                <div class="btn-group">
                    <button class="add btn btn-success" type="button" ><i class="fa fa-plus"></i> Tambah</button>
                    <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
                    <button class="cari_no btn btn-primary" type="button"> Cari</button>
                    <button class="reset btn btn-danger" type="button"> Reset</button>
                    <button class="cetak btn bg-purple" type="button"><i class="fa fa-print"></i> Cetak</button>
                </div>
                <!-- <div class="btn-group"> -->
                    
                    <!-- <button class="ugd btn btn-danger" type="button"> IGD</button>
                    <button class="resume btn btn-success" type="button"> History</button>
                    <button class="migrasi btn btn-info" type="button"> Migrasi</button>
                    <button class="pinjam btn btn-warning" type="button"> Pinjam</button> -->
                <!-- </div> -->
                <div class="btn-group">
                    <button class="jadwal btn btn-info" type="button">Jadwal</button>
                    <button class="simpeg btn bg-maroon" type="button"> Keluarga</button>
                    <button class="pendidikan btn bg-navy" type="button">Pendidikan</button>
                    <button class="pangkat btn bg-blue" type="button">Pangkat</button>
                    <button class="diklat btn bg-purple" type="button">Diklat</button>
                    <button class="militer btn btn-info" type="button">Pendidikan Militer</button>
                    <button class="penugasan btn bg-olive" type="button">Penugasan</button>
                    <button class="kursus btn btn-primary" type="button">Kursus</button>
                    <button class="skp btn bg-purple" type="button">SKP</button>
                    <button class="jabatan btn bg-navy" type="button">Jabatan</button>
                </div>
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
                                <input class="form-control" type="text" name="cari_no" placeholder="Nama/ NIK/ NIP" />
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
<div class='modal modal_cari_nama no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_nama"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_nama btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari_nip no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NIP</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari_nip"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari_nip btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#signature{
    width: 100%;
    height: 300px;
    border: 1px solid black;
}
</style>
