<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/html2canvas.js"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('personalia');?>";
            window.location = url;
            return false; 
        });
    });
</script>
<?php
    if ($row) {
        $id_perawat     = $row->id_perawat;
        $nama_perawat   = $row->nama_perawat;
        $agama          = $row->agama;
        if ($row->agama=="ISLAM") $ag1 = "selected"; else $ag1 = "";
        if ($row->agama=="PROTESTAN") $ag2 = "selected"; else $ag2 = "";
        if ($row->agama=="KRISTEN") $ag3 = "selected"; else $ag3 = "";
        if ($row->agama=="HINDU") $ag4 = "selected"; else $ag4 = "";
        if ($row->agama=="BUDHA") $ag5 = "selected"; else $ag5 = "";
        if ($row->agama=="KONG HU CHU") $ag6 = "selected"; else $ag6 = "";
        if ($row->agama=="LAINNYA") $ag7 = "selected"; else $ag7 = "";
        $id_jtp         = $row->id_jtp;
        $no_bpjs        = $row->no_bpjs;
        $no_telepon     = $row->no_telepon;
        $ktp            = $row->ktp;
        $tgl_lahir      = $row->tgl_lahir;
        $jenis_kelamin  = $row->jenis_kelamin;
        $alamat         = $row->alamat;
        $status_kawin   = $row->status_kawin;
        $id_pendidikan  = $row->id_pendidikan;
        $id_pangkat     = $row->id_pangkat;
        $no_rek         = $row->no_rek;
        $id_bank        = $row->id_bank;
        $no_str         = $row->no_str;
        $tgl_str        = $row->tgl_str;
        $no_sip         = $row->no_sip;
        $tgl_sip        = $row->tgl_sip;
        $no_kta         = $row->no_kta;
        $npwp           = $row->npwp;
        $no_label       = $row->no_label;
        $no_pns         = $row->no_pns;
        $kode_pos       = $row->kode_pos;
        $email          = $row->email;
        $tb             = $row->tb;
        $bb             = $row->bb;
        $peci           = $row->peci;
        $baju           = $row->baju;
        $sepatu         = $row->sepatu;
        $ciri_khusus    = $row->ciri_khusus;
        $bentuk_muka    = $row->bentuk_muka;
        $jenis_rambut   = $row->jenis_rambut;
        $warna_rambut   = $row->warna_rambut;
        $gol_darah      = $row->gol_darah;
        $suku           = $row->suku;
        $no_karis       = $row->no_karis;
        $no_ktpa        = $row->no_ktpa;
        $no_kpi         = $row->no_kpi;
        $no_regis       = $row->no_regis;
        $no_randis      = $row->no_randis;
        $r = "readonly";
        $aksi = "edit";
    } else {
        $id_perawat = 
        $nama_perawat=
        $agama=
        $id_jtp=
        $no_bpjs=
        $no_telepon=
        $ktp=
        $tgl_lahir=
        $jenis_kelamin=
        $alamat=
        $status_kawin=
        $id_pendidikan=
        $id_pangkat=
        $no_rek=
        $id_bank=
        $no_str=
        $tgl_str=
        $no_sip=
        $tgl_sip=
        $no_kta=
        $npwp=
        $no_label=
        $no_pns=
        $kode_pos=
        $email=
        $tb=
        $bb=
        $peci=
        $baju=
        $sepatu=
        $ciri_khusus=
        $bentuk_muka=
        $jenis_rambut=
        $warna_rambut=
        $gol_darah=
        $suku=
        $no_karis=
        $no_ktpa=
        $no_kpi=
        $no_regis=
        $no_randis=
        $r = "";
        $aksi = "simpan";
    }
?>
<div class="col-xs-12">
    <div class="box box-primary">        
        <div class="box-body">
            <div class="col-md-6">
                <div class="form-horizontal">
                    <?php echo form_open_multipart("personalia/simpanperawatbaru/".$aksi,array("class"=>"form-horizontal"));?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nip</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="id_perawat" value="<?php echo $id_perawat;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" required name="nama_perawat" value="<?php echo $nama_perawat;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat Lengkap</label>
                        <div class="col-md-9">
                            <textarea name="alamat" cols="30" class="form-control"><?php echo $alamat;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Agama</label>
                        <div class="col-md-9">
                            <select name ="agama" class="form-control">
                                <option <?php echo $ag1 ?> value = "ISLAM">ISLAM</option>
                                <option <?php echo $ag2 ?> value = "PROTESTAN">PROTESTAN</option>
                                <option <?php echo $ag3 ?> value = "KATOLIK">KATOLIK</option>
                                <option <?php echo $ag4 ?> value = "HINDU">HINDU</option>
                                <option <?php echo $ag5 ?> value = "BUDHA">BUDHA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Suku</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="suku" value="<?php echo $suku;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Telpon</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="no_telepon" value="<?php echo $no_telepon;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">KTP</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ktp" value="<?php echo $ktp;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. BPJS / ASKES</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="no_bpjs" value="<?php echo $no_bpjs;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No STR</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="no_str" value="<?php echo $no_str;?>">
                        </div>
                        <label class="col-md-2 control-label">Tgl STR</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="tgl_str" value='<?php echo $tgl_str?>' autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No SIP</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="no_sip" value="<?php echo $no_sip;?>">
                        </div>
                        <label class="col-md-2 control-label">Tgl SIP</label>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="tgl_sip" value='<?php echo $tgl_sip?>' autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">NPWP</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="npwp" value="<?php echo $npwp;?>">
                        </div>
                        <label class="col-md-2 control-label">No KTA</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="no_kta" value="<?php echo $no_kta;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No Label</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="no_label" value="<?php echo $no_label;?>">
                        </div>
                        <label class="col-md-2 control-label">No Karpeg</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="no_pns" value="<?php echo $no_pns;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No KARIS</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="no_karis" value="<?php echo $no_karis;?>">
                        </div>
                        <label class="col-md-2 control-label">No KTPA</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="no_ktpa" value="<?php echo $no_ktpa;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No Kartu KPI</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="no_kpi" value="<?php echo $no_kpi;?>">
                        </div>
                        <label class="col-md-2 control-label">No REGISTRASI</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="no_regis" value="<?php echo $no_regis;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No Randis</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="no_randis" value="<?php echo $no_randis;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tgl.Lahir</label>
                        <div class="col-md-5">
                            <input type="date" class="form-control" name="tgl_lahir" value='<?php echo $tgl_lahir?>' autocomplete='off'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Tenaga</label>
                        <div class="col-md-9">
                            <select name="id_jtp" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($k1perawat as $row){
                                        echo "<option value='".$row->id_jtp."' ".($row->id_jtp==$id_jtp ? "selected" : "").">".$row->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">No Rekening</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="no_rek" value="<?php echo $no_rek;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Bank</label>
                        <div class="col-md-9">
                            <select name="id_bank" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($b as $row){
                                        echo "<option value='".$row->id_bank."' ".($row->id_bank==$id_bank ? "selected" : "").">".$row->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kode Pos</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="kode_pos" value="<?php echo $kode_pos;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="@" value="<?php echo $email;?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Kelamin</label>
                        <div class="col-md-9">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($q2 as $row){
                                        echo "<option value='".$row->jenis_kelamin."' ".($row->jenis_kelamin==$jenis_kelamin ? "selected" : "").">".$row->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nikah</label>
                        <div class="col-md-9">
                            <select name="status_kawin" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($kw as $kawin){
                                        echo "<option value='".$kawin->kode."' ".($kawin->kode==$status_kawin ? "selected" : "").">".$kawin->nama."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pendidikan</label>
                        <div class="col-md-9">
                            <select name="id_pendidikan" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($q4 as $row){
                                        echo "<option value='".$row->idx."' ".($row->idx==$id_pendidikan ? "selected" : "").">".$row->pendidikan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pangkat</label>
                        <div class="col-md-9">
                            <select name="id_pangkat" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php 
                                    foreach($p as $row){
                                        echo "<option value='".$row->kode_pangkat."' ".($row->kode_pangkat==$id_pangkat ? "selected" : "").">".$row->keterangan."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tinggi Badan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="tb" value="<?php echo $tb;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Berat Badan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="bb" value="<?php echo $bb;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ukuran Peci</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="peci" value="<?php echo $peci;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ukuran Baju</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="baju" value="<?php echo $baju;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ukuran Sepatu</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="sepatu" value="<?php echo $sepatu;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ciri Khusus</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="ciri_khusus" value="<?php echo $ciri_khusus;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Bentuk Muka</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="bentuk_muka" value="<?php echo $bentuk_muka;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Rambut</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="jenis_rambut" value="<?php echo $jenis_rambut;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Warna Rambut</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="warna_rambut" value="<?php echo $warna_rambut;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Golongan Darah</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="gol_darah" value="<?php echo $gol_darah;?>">
                        </div>
                    </div>
                </div>
            </div>
        <div class="box-footer">
            <div class="pull-right">
              <div class="btn-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                <button class="back btn btn-warning" type="reset">Batal</button>
              </div>
            </div>
            <?php echo form_close();?> 
          </div>
        </div>
      </div>
  </div>

      <style type="text/css">
        .btn.btn-file-photo > input[type='file'] {
          position: absolute;
          top: 0;
          right: 0;
          min-width: 100%;
          min-height: 100%;
          font-size: 100px;
          text-align: right;
          opacity: 0;
          filter: alpha(opacity=0);
          outline: none;
          background: white;
          cursor: inherit;
          display: block;
        }
      </style>