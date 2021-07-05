<script>
    $(document).ready(function(){
        $("#listdata table tr#data:first").addClass("seleksi");
        $("#listdata2 table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('distribusi_bu/distribusi')?>";
            return false;
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            var depo_tujuan = $("[name='depo_tujuan']").val();
            window.location = "<?php echo site_url('distribusi_bu/hapusitem_distribusi')?>/"+kode+"/"+depo_tujuan;
            return false;
        });
        $("[name='nama']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>distribusi_bu/getbu",
                    method : "POST",
                    async: false,
                    data : {nama: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label+" | "+ object.satuan+" | "+ object.stok);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var no_distribusi= $("[name='no_distribusi']").val();
                var kode = n[0];
                // alert(no_distribusi);
                var depo_tujuan = $("[name='depo_tujuan']").val();
                $.ajax({
                    url : "<?php echo base_url();?>distribusi_bu/simpanitem_distribusi",
                    method : "POST",
                    data : {kode: kode,no_distribusi: no_distribusi,depo_tujuan: depo_tujuan},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
                return n[0];
            }
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var depo_tujuan = $("[name='depo_tujuan']").val();
            var no_distribusi = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,no_distribusi,kode,depo_tujuan);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,no_distribusi,kode,depo_tujuan);
                }
            });
        });
    });
    var changeData = function(value,no_distribusi,kode,depo_tujuan){
        $.ajax({
            url: "<?php echo site_url('distribusi_bu/changedata_distribusi');?>", 
            type: 'POST', 
            data: {no_distribusi: no_distribusi,kode: kode, value: value, depo_tujuan: depo_tujuan}, 
            success: function(){
               location.reload();
            }
        });
    };
</script>
<?php
    if ($q1){
        $no_distribusi  = $q1->no_distribusi;
        $tanggal        = date("d-m-Y",strtotime($q1->tanggal));
        $keterangan     = $q1->keterangan;
        $status         = $q1->status;
        $depo_tujuan    = $q1->tujuan;
        $a              = "disabled";
        $action         = "edit";
    } else {
        $tanggal        = date("d-m-Y");
        $no_distribusi  = 
        $depo_tujuan    =
        $keterangan     = 
        $status         = 
        $a              = "";
        $action         = "simpan";
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
        <?php echo form_open("distribusi_bu/simpandistribusi_bu/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Distribusi
                </label>
                <div class="col-md-4">
                   <input type="text" name="no_distribusi" value="<?php echo $no_distribusi ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Tanggal
                </label>
                <div class="col-md-4">
                    <input required type="text" name="tanggal" value="<?php echo $tanggal ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Tujuan
                </label>
                <div class="col-md-4">
                    <select class="form-control" name="depo_tujuan" required <?php echo $a ?>>
                        <option value="">---</option>
                        <?php
                            foreach ($d1->result() as $dp) {
                                echo "
                                    <option value='".$dp->kode_ruangan."' ".($dp->kode_ruangan==$depo_tujuan ? "selected" : "").">".$dp->nama_ruangan."</option>
                                ";
                            }
                        ?>
                        <?php
                            foreach ($d2->result() as $dp2) {
                                echo "
                                    <option value='".$dp2->kode_."' ".($dp2->kode==$depo_tujuan ? "selected" : "").">".$dp2->keterangan."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-4">
                   <textarea class="form-control" name="keterangan" required <?php echo $a ?>><?php echo $keterangan ?></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php if ($action=="edit"): ?>
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
        <?php if ($q1): ?>
        <div class="box box-info">
            <div class="box-body">
                <?php if ($status=="1"): ?>
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="50px" class="text-center">Jumlah</th>
                            <th width="100px" class="text-center">Satuan Besar</th>
                            <th width="100px" class="text-center">Satuan Kecil</th>
                            <th width="100px" class="text-center">Status</th>
                            <th width="100px" class="text-center">Isi</th>
                            <th width="100px" class="text-center">Total</th>
                        </tr>
                        <?php
                            foreach ($q->result() as $value) {
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu."</td>
                                        <td>".$value->jumlah."</td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>".$value->satuan_kecil."</td>
                                        <td>".$value->nama_status."</td>
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
                            <th width="50px" class="text-center">Jumlah</th>
                            <th width="100px" class="text-center">Satuan Besar</th>
                            <th width="100px" class="text-center">Status</th>
                            <th width="50px" class="text-center">#</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" class="form-control" name="kode" >
                                <input type="text" name="nama" class="form-control"  autocomplete=off></td>
                            <td width="50px">&nbsp;</td>
                        </tr>
                        <?php
                            foreach ($q->result() as $value) {
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu."</td>
                                        <td class='text-center'>
                                            <a href='#' class='qty dataChange' kode='".$value->kode_bu."' id='".$value->no_distribusi."'>".$value->qty."</a>
                                        </td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>".$value->nama_status."</td>
                                        <td class='text-center'><button class='hapus btn btn-danger' href='".$value->no_distribusi."/".$value->kode_bu."'><i class='fa fa-trash'></></button</td>

                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>
    </div>
</div>
