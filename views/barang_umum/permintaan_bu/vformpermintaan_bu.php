<script>
    $(document).ready(function(){
        $("#listdata table tr#data:first").addClass("seleksi");
        $("#listdata2 table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        $("select[name='penerima']").select2();
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('permintaan_bu/permintaan_bu')?>";
            return false;
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            window.location = "<?php echo site_url('permintaan_bu/hapusitemrk')?>/"+kode;
            return false;
        });
        $("select[name='no_renbut']").change(function(){
            var kode= $(this).val();
            window.location = "<?php echo site_url('permintaan_bu/formpermintaan_bu')?>/"+kode;
            return false;
        });
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var no_renbut = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,no_renbut,kode);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,no_renbut,kode);
                }
            });
        });
        $('.dataChange2').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var no_renbut = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData2(inputval,no_renbut,kode);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData2(inputval,no_renbut,kode);
                }
            });
        });
    var changeData = function(value,no_renbut,kode){
        $.ajax({
            url: "<?php echo site_url('rk/changedata');?>", 
            type: 'POST', 
            data: {no_renbut: no_renbut,kode: kode, value: value}, 
            success: function(){
               location.reload();
            }
        });
    };
    var changeData2 = function(value,no_renbut,kode){
        $.ajax({
            url: "<?php echo site_url('rk/changedata2');?>", 
            type: 'POST', 
            data: {no_renbut: no_renbut,kode: kode, value: value}, 
            success: function(){
               location.reload();
            }
        });
    };
</script>
<?php
    if ($q1){
        $no_permintaan = $q1->no_permintaan;
        $tanggal = date("d-m-Y",strtotime($q1->tanggal));
        $keterangan = $q1->keterangan;
        $status = $q1->status;
        $depo = $q1->depo;
        $pegawai = $q1->pegawai;
        $a = "disabled";
        $action = "edit";
    } else {
        $tanggal = date("d-m-Y"); 
        $no_permintaan = 
        $depo = 
        $pegawai =
        $keterangan = 
        $status = 
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
        <?php echo form_open("permintaan_bu/simpanpermintaan_bu/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Renbut
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="no_renbut" required <?php echo $a ?>>
                        <option value="">----</option>
                        <?php
                            foreach ($rk->result() as $renbut) {
                                echo "
                                    <option value='".$renbut->no_renbut."' ".($renbut->no_renbut==$no_renbut ? "selected" : "" ).">".$renbut->no_renbut." || ".$renbut->tanggal." || ".$renbut->keterangan."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    No Permintaan
                </label>
                <div class="col-md-2">
                    <input type="text" name="no_permintaan" value="<?php echo $no_permintaan ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Tanggal
                </label>
                <div class="col-md-2">
                    <input required type="text" name="tanggal" value="<?php echo $tanggal ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-10">
                   <textarea class="form-control" name="keterangan" <?php echo $a ?> ><?php echo $keterangan ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <?php if ($action=="simpan"): ?>
        <?php if ($no_renbut!=""): ?>
            <div class="box box-info">
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="100px" class="text-center">Jumlah Kebutuhan</th>
                            <th width="100px" class="text-center">Sisa</th>
                            <th width="100px" class="text-center">Satuan</th>
                            <th width="100px" class="text-center">HPS</th>
                            <th width="100px" class="text-center">Jumlah Permintaan</th>
                        </tr>
                        <?php
                            $sj = 0;
                            foreach ($irk->result() as $item) {
                                if ($item->sisa_jumlah>0) {
                                    $jumlah = "<input type='number' class='form-control' name='jumlah_kebutuhan[".$item->kode_bu."]' max='".$item->sisa_jumlah."' value='".$item->sisa_jumlah."'>";
                                } else {
                                    $jumlah = "-";
                                }
                                
                                echo "
                                    <tr>
                                        <td>".$item->nama_bu." (".$item->merk.")</td>
                                        <td>".$item->jumlah."</td>
                                        <td>".$item->sisa_jumlah."</td>
                                        <td>".$item->satuan_besar."</td>
                                        <td>".number_format($item->hps,0,',','.')."</td>
                                        <td>
                                            ".$jumlah."
                                            <input type='hidden' class='form-control' name='jumlah_rk[".$item->kode_bu."]' value='".$item->jumlah."'>
                                            <input type='hidden' class='form-control' name='harga[".$item->kode_bu."]' value='".$item->hps."'>
                                            <input type='hidden' class='form-control' name='sisa_jumlah[".$item->kode_bu."]' value='".$item->sisa_jumlah."'>
                                        </td>
                                    </tr>
                                ";
                                $sj += $item->sisa_jumlah;
                            }
                        ?>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group pull-right">
                         <?php if ($sj!=0): ?>
                            <button class="save btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                        <?php endif ?>
                        <button class="back btn btn-success"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php else: ?>
        <?php if ($ip->row()): ?>
            <div class="box box-info">
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="100px" class="text-center">Jumlah Kebutuhan</th>
                            <th width="100px" class="text-center">Sisa</th>
                            <th width="100px" class="text-center">Satuan</th>
                            <th width="100px" class="text-center">HPS</th>
                            <th width="100px" class="text-center">Jumlah Permintaan</th>
                        </tr>
                        <!-- <input type='hidden' class='form-control' name='sisa_jumlah[".$item->kode_bu."]' value='".$item->sisa_jumlah."'> -->
                        <!-- <input type='number' class='form-control' name='jumlah_kebutuhan[".$item->kode_bu."]' value='".$item->jumlah."' >
                        <input type='hidden' class='form-control' name='jumlah_rk[".$item->kode_bu."]' value='".$item->jumlah_rk."'> -->
                        <?php
                            foreach ($ip->result() as $item) {
                                echo "
                                    <tr>
                                        <td>".$item->nama_bu."</td>
                                        <td>".$item->jumlah_rk."</td>
                                        <td>".$item->sisa_jumlah."</td>
                                        <td>".$item->satuan_besar."</td>
                                        <td>".number_format($item->harga,0,',','.')."</td>
                                        <td>
                                            ".$item->jumlah."
                                           
                                        </td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group pull-right">
                        <!-- <button class="save btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button> -->
                        <button class="back btn btn-success"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="box box-info">
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="100px" class="text-center">Jumlah Kebutuhan</th>
                            <th width="100px" class="text-center">Sisa</th>
                            <th width="100px" class="text-center">Satuan</th>
                            <th width="100px" class="text-center">HPS</th>
                            <th width="100px" class="text-center">Jumlah Permintaan</th>
                        </tr>
                        <?php
                            foreach ($irk->result() as $item) {
                                if ($item->jumlah>1) {
                                    $jumlah = "<input type='number' class='form-control' name='jumlah_kebutuhan[".$item->kode_bu."]' max='".$item->sisa_jumlah."'>";
                                } else {
                                    $jumlah = $item->jumlah;
                                }
                                
                                echo "
                                    <tr>
                                        <td>".$item->nama_bu."</td>
                                        <td>".$item->jumlah."</td>
                                        <td>".$item->sisa_jumlah."</td>
                                        <td>".$item->satuan_besar."</td>
                                        <td>".number_format($item->hps,0,',','.')."</td>
                                        <td>
                                            ".$jumlah."
                                            <input type='hidden' class='form-control' name='jumlah_rk[".$item->kode_bu."]' value='".$item->jumlah."'>
                                            <input type='hidden' class='form-control' name='harga[".$item->kode_bu."]' value='".$item->hps."'>
                                            <input type='hidden' class='form-control' name='sisa_jumlah[".$item->kode_bu."]' value='".$item->sisa_jumlah."'>
                                        </td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group pull-right">
                        <button class="save btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                        <button class="back btn btn-success"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>
    <?php echo form_close(); ?>
</div>
