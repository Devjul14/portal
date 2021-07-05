<script>
    $(document).ready(function() {
        var formattgl = "dd-mm-yy";
        $("input[name='tgl_lahir']").datepicker({ dateFormat : formattgl });
        $("input[name='tgl2']").datepicker({ dateFormat : formattgl });
    });
</script>
<!-- <?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div>";
    }

?> -->
<?php  
    $nama = $q1->nama_pasien;
    $jk = $q1->jenis_kelamin;
    $alamat = $q1->alamat;
    $kecamatan = $q1->nama_kecamatan; 
    $kelurahan = $q1->nama_kelurahan;
    $telp = $q1->telpon;
    $tgl_lahir = date('d-m-Y',strtotime($q1->tgl_lahir));
    $tgl_masuk = date('Y-m-d H:i:s');
?>
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body" >
                <div class="form-horizontal">
                    
                    <?php echo form_open("umum/simpaninap",array("id"=>"formcari"));?>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Pasien</label>
                        <div class="col-sm-4">
                            <input type="text" name="nama" class="form-control" value="<?=$nama;?>" readonly>
                            <input type="hidden" name="id_pendaftaran" class="form-control" value="<?=$id_pendaftaran;?>">
                            <input type="hidden" name="tgl_mask" class="form-control" value="<?=$tgl_masuk;?>">
                        </div>
                        <label class="control-label col-sm-2">Jenis Kelamin</label>
                        <div class="col-sm-4">
                            <select name="jk" class="form-control">
                                <option value="L" <?php if ($jk=="L"): ?>
                                    selected
                                <?php endif ?>>Laki-laki</option>

                                <option value="P" <?php if ($jk=="P"): ?>
                                    selected
                                <?php endif ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat"><?=$alamat;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Kota</label>
                        <div class="col-sm-2">
                            <input type="text" name="kota" class="form-control">
                        </div>
                        <label class="control-label col-sm-2" >Kecamatan</label>
                        <div class="col-sm-2">
                            <input type="text" name="kecamatan" class="form-control" value="<?=$kecamatan?>" readonly>
                        </div>
                        <label class="control-label col-sm-2">Kelurahan</label>
                        <div class="col-sm-2">
                            <input type="text" name="kelurahan" class="form-control" value="<?=$kelurahan?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">RW</label>
                        <div class="col-sm-2">
                            <input type="text" name="rt" class="form-control">
                        </div>
                        <label class="control-label col-sm-2">RT</label>
                        <div class="col-sm-2">
                            <input type="text" name="rw" class="form-control">
                        </div>
                        <label class="control-label col-sm-2">Telp</label>
                        <div class="col-sm-2">
                            <input type="text" name="telp" class="form-control" value="<?=$telp?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tempat Lahir</label>
                        <div class="col-sm-2">
                            <input type="text" name="tempat_lahir" class="form-control">
                        </div>
                        <label class="control-label col-sm-2">Tgl Lahir</label>
                        <div class="col-sm-2">
                            <input type="text" name="tgl_lahir" class="form-control" value="<?=$tgl_lahir?>">
                        </div>
                        <label class="control-label col-sm-2">Agama</label>
                        <div class="col-sm-2">
                            <input type="text" name="agama" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Penanggung</label>
                        <div class="col-sm-4">
                            <input type="text" name="penanggung" class="form-control">
                        </div>
                        <label class="control-label col-sm-2">Hubungan</label>
                        <div class="col-sm-4">
                            <input type="text" name="hubungan" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Kelas</label>
                        <div class="col-sm-10">
                            <select name="kelas" class="form-control">
                                <?php  
                                    foreach ($q3->result() as $kls) {
                                        echo "
                                            <option value='".$kls->id_kelas."'>".$kls->nama_kelas."  (".$kls->tarif.")</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Pembayaran</label>
                        <div class="col-sm-4">
                            <select name="pembayaran" class="form-control">
                                <?php  
                                    foreach ($q2->result() as $dt) {
                                        echo "
                                            <option value='".$dt->status_pembayaran."'>".$dt->status_pembayaran."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="control-label col-sm-2">Total Biaya</label>
                        <div class="col-sm-4">
                            <input type="text" name="total_biaya" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="back btn btn-warning" type="reset">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>