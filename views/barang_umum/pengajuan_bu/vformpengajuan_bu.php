<script>
    $(document).ready(function(){
        $("#listdata table tr#data:first").addClass("seleksi");
        $("#listdata2 table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal_pengajuan']").datepicker({
            dateFormat : formattgl,
        });
        var formatperiode = "mm-yy";
        $("input[name='periode_pengajuan']").datepicker({
            dateFormat : formatperiode,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('pengajuan_bu/pengajuan')?>";
            return false;
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            window.location = "<?php echo site_url('pengajuan_bu/hapusitem_pengajuan')?>/"+kode;
            return false;
        });
        $("[name='nama']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>pengajuan_bu/getbu",
                    method : "POST",
                    async: false,
                    data : {nama: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label+" | "+ object.satuan);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var kode = n[0];
                $("input[name='kode']").val(kode);
                return n[1];
            }
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var no_pengajuan = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,no_pengajuan,kode);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,no_pengajuan,kode);
                }
            });
        });
    });
    var changeData = function(value,no_pengajuan,kode){
        // alert(kode);
        $.ajax({
            url: "<?php echo site_url('pengajuan_bu/changedata_pengajuan');?>", 
            type: 'POST', 
            data: {no_pengajuan: no_pengajuan,kode: kode, value: value}, 
            success: function(){
               location.reload();
            }
        });
    };
</script>
<?php
    if ($q1){
        $no_pengajuan           = $q1->no_pengajuan;
        $tanggal_pengajuan      = date("d-m-Y",strtotime($q1->tanggal_pengajuan));
        $keterangan_pengajuan   = $q1->keterangan_pengajuan;
        $status_pengajuan       = $q1->status_pengajuan;
        $depo                   = $q1->depo;
        $periode_pengajuan      = $q1->periode_pengajuan;
        $a                      = "disabled";
        $action                 = "edit";
    } else {
        $tanggal_pengajuan = date("d-m-Y");
        $no_pengajuan = 
        $depo = 
        $periode_pengajuan =
        $keterangan_pengajuan = 
        $status_pengajuan = 
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
        <?php echo form_open("pengajuan_bu/simpanpengajuan/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Pengajuan
                </label>
                <div class="col-md-4">
                   <input type="text" name="no_pengajuan" value="<?php echo $no_pengajuan ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Tanggal
                </label>
                <div class="col-md-4">
                    <input required type="text" name="tanggal_pengajuan" value="<?php echo $tanggal_pengajuan ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Depo
                </label>
                <div class="col-md-4">
                    <select class="form-control" name="depo" required <?php echo $a ?>>
                        <option value="">---</option>
                        <?php
                            foreach ($d->result() as $dp) {
                                echo "
                                    <option value='".$dp->kode_depo."' ".($dp->kode_depo==$depo ? "selected" : "").">".$dp->nama_depo."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    Periode
                </label>
                <div class="col-md-4">
                    <input required type="text" name="periode_pengajuan" value="<?php echo $periode_pengajuan ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-10">
                   <textarea class="form-control" name="keterangan_pengajuan" required <?php echo $a ?>><?php echo $keterangan_pengajuan ?></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php if ($status_pengajuan=="1"): ?>
                <div class="btn-group pull-right">
                    <button class="back btn btn-success" type="button"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                </div>
            <?php else: ?>
                <div class="btn-group pull-right">
                    <button class="save btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                    <button class="back btn btn-success"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                </div>
            <?php endif ?>
        </div>
        <?php echo form_close(); ?>
    </div>
    <?php if ($q1): ?>
        <div class="box box-info">
            <?php echo form_open("pengajuan_bu/simpanitem_pengajuan",array("id"=>"formsimpan","class"=>"form-horizontal"));?>
            <input type="hidden" name="no_pengajuan" value="<?php echo $no_pengajuan; ?>">
            <div class="box-body">
                <?php if ($status_pengajuan=="1"): ?>
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="50px" class="text-center">Jumlah</th>
                            <th width="100px" class="text-center">Satuan Besar</th>
                            <th width="100px" class="text-center">Satuan Kecil</th>
                            <th width="100px" class="text-center">Isi</th>
                            <th width="100px" class="text-center">Total</th>
                            <!-- <th width="100px" class="text-center">HPS</th> -->
                        </tr>
                                        <!-- <td>".number_format($value->hps,0,',','.')."</td> -->
                        <?php
                            foreach ($q->result() as $value) {
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu." (".$value->merk.")</td>
                                        <td>".$value->jumlah."</td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>".$value->satuan_kecil."</td>
                                        <td>".$value->isi."</td>
                                        <td>".($value->jumlah*$value->isi)."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                <?php else: ?>
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="100px" class="text-center">Jumlah</th>
                            <th width="100px" class="text-center">Satuan Besar</th>
                            <th width="100px" class="text-center">Satuan Kecil</th>
                            <th width="100px" class="text-center">Isi</th>
                            <th width="100px" class="text-center">Total</th>
                            <!-- <th width="100px" class="text-center">HPS</th> -->
                            <th width="50px" class="text-center">#</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" class="form-control" name="kode" >
                                <input type="text" name="nama" class="form-control"  autocomplete='off' required></td>
                            <td width="100px">
                                <input type="number" name="jumlah_pengajuan" class="form-control" autocomplete="off" required>
                            </td>
                            <td width="50px">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i>
                                </button>
                            </td>
                            <td width="50px">&nbsp;</td>
                            <td width="50px">&nbsp;</td>
                        </tr>
                        <!-- <td class='text-center'>
                                            <a href='#' class='hps dataChange2' kode='".$value->kode_obat."' id='".$value->no_pengajuan."'>".$value->hps."</a>
                                        </td> -->
                        <?php
                            foreach ($q->result() as $value) {
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu."</td>
                                        <td class='text-center'>
                                            <a href='#' class='qty dataChange' kode='".$value->kode_bu."' id='".$value->no_pengajuan."'>".$value->jumlah."</a>
                                        </td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>".$value->satuan_kecil."</td>
                                        <td>".$value->isi."</td>
                                        <td>".$value->jumlah_kecil."</td>
                                        <td class='text-center'><button class='hapus btn btn-danger' href='".$value->no_pengajuan."/".$value->kode_bu."'><i class='fa fa-trash'></></button</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                <?php endif ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    <?php endif ?>
</div>
