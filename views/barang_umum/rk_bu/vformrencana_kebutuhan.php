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
            window.location = "<?php echo site_url('rk_bu/rencana_kebutuhan')?>";
            return false;
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            window.location = "<?php echo site_url('rk_bu/hapusitemrk')?>/"+kode;
            return false;
        });
        $("[name='periode']").change(function(){
            var kode= $(this).val();
            window.location = "<?php echo site_url('rk_bu/formrencana_kebutuhan')?>/"+kode;
            return false;
        });
    });
</script>
<?php
    if ($q1){
        $no_renbut = $q1->no_renbut;
        $tanggal = date("d-m-Y",strtotime($q1->tanggal));
        $keterangan = $q1->keterangan;
        $status = $q1->status;
        $a = "disabled";
        $action = "edit";
    } else {
        $tanggal = date("d-m-Y");
        $no_renbut = 
        $keterangan = 
        $status = 
        $a = "";
        $action = "simpan";
    }
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
        <?php echo form_open("rk_bu/simpanrencana_kebutuhan/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Renbut
                </label>
                <div class="col-md-2">
                    <input type="text" name="no_renbut" value="<?php echo $no_renbut ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Periode
                </label>
                <div class="col-md-2">
                    <?php if ($action=="simpan"): ?>
                        <select class="form-control" name="periode" required <?php echo $a ?>>
                            <option>---</option>
                            <?php
                                foreach ($pr->result() as $key) {
                                    echo "
                                        <option value='".$key->periode_pengajuan."' ".($key->periode_pengajuan==$periode ? "selected" : "").">".$key->periode_pengajuan."</option>
                                    ";
                                }
                            ?>
                        </select>
                    <?php else: ?>
                        <input type="text" name="periode" class="form-control" value="<?php echo $periode; ?>" disabled>
                    <?php endif ?>
                </div>
                <label class="col-md-2">
                    Tanggal
                </label>
                <div class="col-md-2">
                    <input required type="text" name="tanggal" value="<?php echo $tanggal ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-10">
                   <textarea class="form-control" name="keterangan" <?php echo $a ?>><?php echo $keterangan ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <?php if ($p->row()): ?>
        <?php if ($action=="simpan"): ?>
            <div class="box box-info">
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="50px" class="text-center">Jumlah Pengajuan</th>
                            <th width="100px" class="text-center">Satuan Besar</th>
                            <th width="100px" class="text-center">Satuan Kecil</th>
                            <th width="100px" class="text-center">Isi</th>
                            <th width="100px" class="text-center">Total</th>
                            <th width="100px" class="text-center">HPS</th>
                            <th width="100px" class="text-center">Total HPS</th>
                            <th width="100px" class="text-center">Jumlah Kebutuhan</th>
                        </tr>
                        <?php
                            foreach ($p->result() as $value) {
                                
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu." (".$value->merk.")</td>
                                        <td>".$value->qty."</td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>".$value->satuan_kecil."</td>
                                        <td>".$value->isi."</td>
                                        <td>".($value->qty*$value->isi)."</td>
                                        <td>".number_format($value->hps,0,',','.')."</td>
                                        <td>".number_format(($value->hps)*($value->qty*$value->isi),0,',','.')."</td>
                                        <td>
                                            <input type='number' class='form-control' name='jumlah_kebutuhan[".$value->kode_bu."]' min='".$value->qty."' max='".$value->qty."' value='".$value->qty."'>
                                            <input type='hidden' class='form-control' name='jumlah_pengajuan[".$value->kode_bu."]' value='".$value->sisa_jumlah."'>
                                            <input type='hidden' class='form-control' name='hps[".$value->kode_bu."]' value='".$value->hps."'>
                                            <input type='hidden' class='form-control' name='jumlah_kecil[".$value->kode_bu."]' value='".($value->qty*$value->isi)."'>
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
        <?php else: ?>
            <div class="box box-info">
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Barang</th>
                            <th width="100px" class="text-center">Jumlah Kebutuhan</th>
                            <th width="100px" class="text-center">Satuan Besar</th>
                            <th width="100px" class="text-center">Satuan Kecil</th>
                            <th width="100px" class="text-center">Isi</th>
                            <th width="100px" class="text-center">Total</th>
                            <th width="100px" class="text-center">HPS</th>
                            <th width="100px" class="text-center">Total HPS</th>
                        </tr>
                        <?php
                            foreach ($q->result() as $value) {
                                
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu."</td>
                                        <td>".$value->jumlah."</td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>".$value->satuan_kecil."</td>
                                        <td>".$value->isi."</td>
                                        <td>".($value->jumlah*$value->isi)."</td>
                                        <td>".number_format($value->hps,0,',','.')."</td>
                                        <td>".number_format(($value->hps)*($value->jumlah*$value->isi),0,',','.')."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group pull-right">
                        <button class="back btn btn-success"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>
    <?php echo form_close(); ?>
</div>
