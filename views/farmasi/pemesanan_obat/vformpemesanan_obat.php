<script>
    $(document).ready(function(){
        $("#listdata table tr#data:first").addClass("seleksi");
        $("#listdata2 table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        $("select[name='petugas_pemesanan']").select2();
        $("select[name='supplier']").select2();
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal_pemesanan']").datepicker({
            dateFormat : formattgl,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('pemesanan/pemesanan_obat')?>";
            return false;
        });
        $(".hapus_item").click(function(){
            var kode_obat = $(this).attr("href");
            $("[name='kode_hapus']").val(kode_obat);
            $(".modal").show();
        });
        $(".tidak").click(function(){
            $(".modal").hide();
        });
        $(".ya").click(function(){
            var kode_obat       = $("[name='kode_hapus']").val();
            var no_pemesanan    = $("[name='no_pemesanan']").val()
            var no_permintaan   = $("[name='no_permintaan']").val()
            window.location     = "<?php echo site_url('pemesanan/hapusitem_pemesanan')?>/"+no_permintaan+"/"+no_pemesanan+"/"+kode_obat;
            return false;
        });
        $("select[name='no_permintaan']").change(function(){
            var kode= $(this).val();
            window.location = "<?php echo site_url('pemesanan/formpemesanan_obat')?>/"+kode;
            return false;
        });
        $("[name='nama']").typeahead({
            source: function(query, process) {
                var no_permintaan= $("[name='no_permintaan']").val();
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>pemesanan/getobat_permintaan/"+no_permintaan,
                    method : "POST",
                    async: false,
                    data : {nama: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label+" | "+object.satuan+" | "+object.jumlah_permintaan+" | "+object.harga);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var kode = n[0];
                var jumlah_permintaan = n[3];
                var harga = n[4]
                $("input[name='kode']").val(kode);
                $("input[name='jumlah_pemesanan']").val(jumlah_permintaan);
                $("input[name='harga']").val(harga);
                $("input[name='jumlah_permintaan']").val(jumlah_permintaan);
                $("input[name='jumlah_pemesanan']").on('input', function () {
                    var value = $(this).val();
                    if ((value !== '') && (value.indexOf('.') === -1)) {
                        $(this).val(Math.max(Math.min(value, jumlah_permintaan), 1));
                    }
                });
                return n[1];
            }
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var no_permintaan = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,no_permintaan,kode);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,no_permintaan,kode);
                }
            });
        });
        $('.dataChange2').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var no_permintaan = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData2(inputval,no_permintaan,kode);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData2(inputval,no_permintaan,kode);
                }
            });
        });
    });
    var changeData = function(value,no_permintaan,kode){
        $.ajax({
            url: "<?php echo site_url('rk/changedata');?>", 
            type: 'POST', 
            data: {no_permintaan: no_permintaan,kode: kode, value: value}, 
            success: function(){
               location.reload();
            }
        });
    };
    var changeData2 = function(value,no_permintaan,kode){
        $.ajax({
            url: "<?php echo site_url('rk/changedata2');?>", 
            type: 'POST', 
            data: {no_permintaan: no_permintaan,kode: kode, value: value}, 
            success: function(){
               location.reload();
            }
        });
    };
</script>
<?php
    if ($q1){
        $no_pemesanan = $q1->no_pemesanan;
        $tanggal_pemesanan = date("d-m-Y",strtotime($q1->tanggal_pemesanan));
        $keterangan_pemesanan = $q1->keterangan_pemesanan;
        $status = $q1->status;
        $supplier = $q1->supplier;
        $petugas_pemesanan = $q1->petugas_pemesanan;
        $pemesanan_ke = $q1->pemesanan_ke;
        $a = "disabled";
        $action = "edit";
    } else {
        $tanggal_pemesanan =  date("d-m-Y");
        $no_pemesanan = 
        $supplier = 
        $petugas_pemesanan =
        $keterangan_pemesanan = 
        $status = 
        $pemesanan_ke  =
        $a = "";
        $action = "simpan";
    }
    // echo $action;
?>
<div class='modal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION</h4></div>
            <div class='modal-body'>Yakin akan menghapus data ?</div>
            <div class='modal-footer'>
                <button class="ya btn btn-sm btn-danger">Ya</button>
                <button class="tidak btn btn-sm btn-success">Tidak</button>
                <input type="hidden" name="kode_hapus">
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <?php 
        if($this->session->flashdata('message')){
            $pesan = explode('-', $this->session->flashdata('message'));
            echo "
                <div class='alert alert-".$pesan[0]."' alert-dismissable>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b style='font-size:25px'>".$pesan[1]."</b>
                </div>";
        }
    ?>
    <div class="box box-info">
        <?php echo form_open("pemesanan/simpanpemesanan/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Permintaan
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="no_permintaan" <?php echo $a ?>>
                        <option value="">----</option>
                        <?php
                            foreach ($rk->result() as $perm) {
                                echo "
                                    <option value='".$perm->no_permintaan."' ".($perm->no_permintaan==$no_permintaan ? "selected" : "" ).">".$perm->no_permintaan." || ".$perm->tanggal." || ".$perm->keterangan."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    No Pemesanan
                </label>
                <div class="col-md-2">
                    <input type="text" name="no_pemesanan" value="<?php echo $no_pemesanan ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Tanggal
                </label>
                <div class="col-md-2">
                    <input required type="text" name="tanggal_pemesanan" value="<?php echo $tanggal_pemesanan ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Supplier
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="supplier" required <?php echo $a ?>>
                        <option value="">----</option>
                        <?php
                            foreach ($s->result() as $sup) {
                                echo "
                                    <option value='".$sup->kode_supplier."' ".($sup->kode_supplier==$supplier ? "selected" : "" ).">".$sup->nama_supplier."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    Petugas Pemesanan
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="petugas_pemesanan" required <?php echo $a ?>>
                        <option value="">----</option>
                        <?php
                            foreach ($pp->result() as $pet) {
                                echo "
                                    <option value='".$pet->nip."' ".($pet->nip==$petugas_pemesanan ? "selected" : "" ).">".$pet->nama."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    Pemesanan Ke-
                </label>
                <div class="col-md-2">
                    <input type="number" name="pemesanan_ke" value="<?php echo $pemesanan_ke ?>" class='form-control' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-10">
                   <textarea class="form-control" name="keterangan_pemesanan" required <?php echo $a ?> ><?php echo $keterangan_pemesanan ?></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <?php if ($action=="simpan"): ?>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                <?php endif ?>
                <button class="back btn btn-warning" type="button">Back</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <div class="box box-info">
        <?php echo form_open("pemesanan/simpanitem_pemesanan",array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <input type="hidden" name="no_pemesanan" value="<?php echo $no_pemesanan ?>">
        <input type="hidden" name="no_permintaan" value="<?php echo $no_permintaan ?>">
        <input type="hidden" name="harga">
        <input type="hidden" name="jumlah_permintaan">
        <div class="box box-body">
            <table class="table table-striped table-bordered" id="data">
                <tr class="bg-navy">
                    <th>Nama Obat</th>
                    <th width="100px" class="text-center">Jumlah pemesanan</th>
                    <th width="100px" class="text-center">Satuan Besar</th>
                    <th width="100px" class="text-center">Satuan Kecil</th>
                    <th width="100px" class="text-center">Isi</th>
                    <th width="100px" class="text-center">Total</th>
                    <th width="100px" class="text-center">Harga</th>
                    <th width="100px" class="text-center">Total Harga</th>
                    <th width="50px" class="text-center"></th>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" class="form-control" name="kode" >
                        <input type="text" name="nama" class="form-control"  autocomplete=off required></td>
                    <td width="50px">
                        <input type="number" name="jumlah_pemesanan" class="form-control" autocomplete="off" required>
                    </td>
                    <td width="50px">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i>
                        </button>
                    </td>
                    <td width="50px">&nbsp;</td>
                    <td width="50px">&nbsp;</td>
                </tr>
                <?php
                    foreach ($q->result() as $value) {
                        echo "
                            <tr>
                                <td>".$value->nama."</td>
                                <td>".$value->jumlah."</td>
                                <td>".$value->pak1."</td>
                                <td>".$value->pak2."</td>
                                <td>".$value->isi."</td>
                                <td>".($value->jumlah*$value->isi)."</td>
                                <td>".number_format($value->harga,0,',','.')."</td>
                                <td>".number_format(($value->harga)*($value->jumlah),0,',','.')."</td>
                                <td>
                                    <button class='hapus_item btn btn-danger' type='button' href='".$value->kode_obat."'><i class='fa fa-minus'></i></button>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
