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
        $("input[name='tanggal'], input[name='tgl_deadline'], input[name='tgl_kontrabon']" ).datepicker({
            dateFormat : formattgl,
        });
        $(".expire_date").datepicker({
            dateFormat : formattgl,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('penerimaan_bu/penerimaan')?>";
            return false;
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            window.location = "<?php echo site_url('penerimaan_bu/hapusitemrk')?>/"+kode;
            return false;
        });
        $("select[name='no_pemesanan']").change(function(){
            var kode= $(this).val();
            window.location = "<?php echo site_url('penerimaan_bu/formpenerimaan_bu')?>/"+kode;
            return false;
        });
    });
</script>
<?php
    if ($q1){
        $jumlah = number_format($q1->jumlah,0,',','.');
        $total = number_format($q1->total,0,',','.');
        $asal_barang = $q1->asal_barang;
        $no_faktur = $q1->no_faktur;
        $no_invoice = $q1->no_invoice;

        $no_penerimaan = $q1->no_penerimaan;
        $tanggal = date("d-m-Y",strtotime($q1->tanggal));
        $tgl_deadline = date("d-m-Y",strtotime($q1->tgl_deadline));
        $tgl_kontrabon = date("d-m-Y",strtotime($q1->tgl_kontrabon));
        $keterangan = $q1->keterangan;
        $status = $q1->status;
        $supplier = $q1->nama_supplier;
        $petugas_pemesanan = $q1->nama_petugas;
        $a = "disabled";
        $action = "edit";
    } else {
        $asal_barang= 
        $jumlah  = $total = 
        $no_faktur = $no_invoice = "";
        $tanggal = date("d-m-Y");
        $tgl_deadline = date("d-m-Y");
        $tgl_kontrabon = date("d-m-Y");
        $supplier = (isset($q2->nama_supplier) ? $q2->nama_supplier : "");
        $petugas_pemesanan = (isset($q2->nama_petugas) ? $q2->nama_petugas : "");
        $no_penerimaan = 
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
        <?php echo form_open("penerimaan_bu/simpanpenerimaan_bu/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Pemesanan
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="no_pemesanan" <?php echo $a ?>>
                        <option value="">----</option>
                        <?php
                            foreach ($rk->result() as $pem) {
                                echo "
                                    <option value='".$pem->no_pemesanan."' ".($pem->no_pemesanan==$no_pemesanan ? "selected" : "" ).">".$pem->no_pemesanan." || ".$pem->tanggal_pemesanan." || ".$pem->keterangan_pemesanan."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    No Penerimaan
                </label>
                <div class="col-md-2">
                    <input type="text" name="no_penerimaan" value="<?php echo $no_penerimaan ?>" class='form-control' readonly>
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
                    No Faktur
                </label>
                <div class="col-md-4">
                    <input type="text" name="no_faktur"  value="<?php echo $no_faktur ?>" class="form-control" required <?php echo $a; ?>>
                </div>
                <label class="col-md-2">
                    No Invoice
                </label>
                <div class="col-md-4">
                    <input type="text" name="no_invoice" value="<?php echo $no_invoice ?>"  class="form-control" required <?php echo $a; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Tanggal Deadline
                </label>
                <div class="col-md-4">
                    <input type="text" name="tgl_deadline"  value="<?php echo $tgl_deadline ?>" class="form-control" required <?php echo $a; ?>>
                </div>
                <label class="col-md-2">
                    Tangal Kontrabon 
                </label>
                <div class="col-md-4">
                    <input type="text" name="tgl_kontrabon" value="<?php echo $tgl_kontrabon ?>"  class="form-control" required <?php echo $a; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                   Asal Barang
                </label>
                <div class="col-md-10">
                    <select class="form-control" name="asal_barang" <?php echo $a ?>>
                        <option value="">----</option>
                        <?php
                            foreach ($as->result() as $asl) {
                                echo "
                                    <option value='".$asl->kode."' ".($asl->kode==$asal_barang ? "selected" : "" ).">".$asl->nama."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Supplier
                </label>
                <div class="col-md-4">
                    <input type="text" name="supplier" class="form-control" disabled value="<?php echo $supplier ?>">
                </div>
                <label class="col-md-2">
                    Petugas Pemesanan
                </label>
                <div class="col-md-4">
                    <input type="text" name="petugas_pemesanan" class="form-control" disabled value="<?php echo $petugas_pemesanan ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-10">
                   <textarea class="form-control" name="keterangan" required <?php echo $a ?> ><?php echo $keterangan ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Jumlah
                </label>
                <div class="col-md-4">
                   <input type="text" name="jumlah" class="form-control" disabled value="<?php echo $jumlah ?>">
                </div>
                <label class="col-md-2">
                    Total <small>(*Include Pajak & Diskon)</small>
                </label>
                <div class="col-md-4">
                   <input type="text" name="total" class="form-control" disabled value="<?php echo $total ?>">
                </div>
            </div>
        </div>
    </div>
    <?php if ($irk->row()): ?>
        <?php if ($action=="simpan"): ?>
            <div class="box box-info">
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th rowspan="2">Nama Obat</th>
                            <th rowspan="2" width="50px" class="text-center">Jumlah Pemesanan</th>
                            <th rowspan="2" width="50px" class="text-center">Sisa Pemesanan</th>
                            <th rowspan="2" width="100px" class="text-center">Satuan Besar</th>
                            <th rowspan="2" width="100px" class="text-center">Harga</th>
                            <th rowspan="2" width="100px" class="text-center">Batch</th>
                            <th rowspan="2" width="100px" class="text-center">ED</th>
                            <th colspan="2" width="100px" class="text-center">Disc</th>
                            <th rowspan="2" width="100px" class="text-center">Jumlah Penerimaan</th>
                            <th rowspan="2" width="100px" class="text-center">Total Harga <small>(*Include Pajak & Discount)</small></th>
                        </tr>
                        <tr class="bg-navy">
                            <td>%</td>
                            <td>Rp</td>
                        </tr>
                        <?php
                        	$sj = 0;
                            foreach ($irk->result() as $value) {
                                if ($value->sisa_pengajuan!=0) {
                                    $jumlah = "<input type='number' class='form-control' name='jumlah_penerimaan[".$value->kode_bu."]' max='".$value->sisa_pengajuan."' value='".$value->sisa_pengajuan."'>";
                                    $batch = "<input type='text' class='form-control' name='batch[".$value->kode_bu."]'>";
                                    $expire_date = "<input type='text' class='form-control expire_date' name='expire_date[".$value->kode_bu."]'>";
                                    $disc = "<input type='number' class='form-control' name='disc[".$value->kode_bu."]' placeholder='%' value='0'>";
                                    $disc_rupiah = "<input type='number' class='form-control' name='disc_rupiah[".$value->kode_bu."]' value='0'>";
                                    $harga = "<input type='number' class='form-control' name='harga[".$value->kode_bu."]' value='".$value->harga."'>";
                                } else {
                                    $harga = 
                                    $jumlah = 
                                    $batch  = 
                                    $expire_date = 
                                    $disc_rupiah =
                                    $disc = "-";
                                }
                                
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu." (".$value->merk.")</td>
                                        <td>".$value->jumlah."</td>
                                        <td>".$value->sisa_pengajuan."</td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>
                                            ".$harga."
                                        </td>
                                        <td>
                                            ".$batch."
                                            <input type='hidden' class='form-control' name='jumlah_pemesanan[".$value->kode_bu."]' value='".$value->jumlah."'>
                                        </td>
                                        <td>
                                            ".$expire_date."
                                        </td>
                                        <td>
                                            ".$disc."
                                        </td>
                                        <td>
                                            ".$disc_rupiah."
                                        </td>
                                        <td>
                                            ".$jumlah."
                                        </td>
                                        <td>-</td>
                                    </tr>
                                ";
                                $sj += $value->sisa_pengajuan;
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
        <?php else: ?>
            <div class="box box-info">
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Obat</th>
                            <th width="100px" class="text-center">Satuan Besar</th>
                            <th width="100px" class="text-center">Harga</th>
                            <th width="100px" class="text-center">Batch</th>
                            <th width="100px" class="text-center">ED</th>
                            <th colspan='2' width="100px" class="text-center">Disc</th>
                            <th width="100px" class="text-center">Jumlah Penerimaan</th>
                            <th width="100px" class="text-center">Total Harga  <small>(*Include Pajak & Discount)</small></th>
                        </tr>
                        <?php
                            foreach ($q->result() as $value) {
                                echo "
                                    <tr>
                                        <td>".$value->nama_bu."</td>
                                        <td>".$value->satuan_besar."</td>
                                        <td>".number_format($value->harga,0,',','.')."</td>
                                        <td>".$value->batch."</td>
                                        <td>".date("d-m-Y",strtotime($value->expire_date))."</td>
                                        <td>".$value->disc."%</td>
                                        <td>".number_format($value->disc_rupiah,0,',','.')."</td>
                                        <td>".$value->jumlah."</td>
                                        <td>".number_format($value->total_harga,0,',','.')."</td>
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
