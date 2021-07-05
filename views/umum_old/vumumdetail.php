<?php
    if ($r){
        $id_bpumum = $r->id_bpumum;
        $id_pendaftaran = $r->id_pendaftaran;
        $nip = $r->nip;
        $ket_rujukan = $r->ket_rujukan;
        $rujukan = $r->rujukan;
        $umur = $r->umur;
        $id_paramedis = $r->id_paramedis;
        $tekanan_darah = $r->tekanan_darah;
        $berat_badan = $r->berat_badan;
        $keluhan = $r->keluhan;
        $tgl_kunjungan = date('d-m-Y',strtotime($r->tgl_kunjungan));
        $action = "edit";
    } else {
        $tgl_kunjungan = date('d-m-Y');
        $nip = 
        $ket_rujukan = 
        $rujukan = 
        $umur = 
        $id_paramedis = 
        $tekanan_darah =
        $keluhan =
        $berat_badan = "";
        $action = "simpan";
    }
?>
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
    $(document).ready(function() {
        var formattgl = "dd-mm-yyyy";
        $("input[name='tgl_kunjungan']").datepicker({ format : formattgl });
        $(".cari").click(function(){
            var url = "<?php echo site_url('umum/caripenyakit');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".carilab").click(function(){
            var url = "<?php echo site_url('kia/carilab');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".cariobat").click(function(){
            var url = "<?php echo site_url('umum/cariobat');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".cari_tindakan").click(function(){
            var url = "<?php echo site_url('kia/caritindakan');?>";
            openCenteredWindow(url);
            return false;
        });
        $(".hapuspenyakit").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/hapuspenyakit');?>/"+id;
        });
        $(".hapuspasienlab").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/hapuspasienlab');?>/"+id;
        });
        $(".hapusresep").click(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('umum/hapusresep');?>/"+id;
        });
        $(':input.nama_penyakit').typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = <?php echo json_encode($q_penyakit); ?>// Or get your JSON dynamically and load it into this variable
                $.each(data, function(i, object) {
                    map[object.label] = object;
                    objects.push(object.label);
                });
                process(objects);
            },
            updater: function(item) {
                $("input.id_penyakit").val(map[item].id);
                return map[item].label;
            }
        }); 
        $('input.nama_tindakan').typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = <?php echo json_encode($q_tindakan); ?>// Or get your JSON dynamically and load it into this variable
                $.each(data, function(i, object) {
                    map[object.label] = object;
                    objects.push(object.label);
                });
                process(objects);
            },
            updater: function(item) {
                $("input.id_tindakan").val(map[item].id);
                return map[item].label;
            }
        }); 
        $('input.nama_obat').typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = <?php echo json_encode($q_obat); ?>// Or get your JSON dynamically and load it into this variable
                $.each(data, function(i, object) {
                    map[object.label] = object;
                    objects.push(object.label);
                });
                process(objects);
            },
            updater: function(item) {
                $("input.id_obat").val(map[item].id);
                return map[item].label;
            }
        }); 
        $('input.nama_lab').typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = <?php echo json_encode($q_lab); ?>// Or get your JSON dynamically and load it into this variable
                $.each(data, function(i, object) {
                    map[object.label] = object;
                    objects.push(object.label);
                });
                process(objects);
            },
            updater: function(item) {
                $("input.id_lab").val(map[item].id);
                return map[item].label;
            }
        }); 
    });
</script>
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body" >
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asal Puskesmas</label>
                        <div class="col-sm-4">
                             <input type="text" class="form-control" readonly value="<?=$p->nama_puskesmas;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No. Pasien</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" readonly value="<?=$p->no_pasien;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Pasien</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" readonly value="<?=$p->nama_pasien;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Umur</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" readonly value="<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body" >
                <?php  
                    echo form_open("umum/simpanumum/".$action,array("id"=>"formsave_pasien","class"=>"form-horizontal"));
                    echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
                    echo "<input type=hidden name=id_bpumum value='".$id_bpumum."'>";
                    echo "<input type=hidden name=umur value='".$this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal)."'>";
                ?>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dokter</label>
                        <div class="col-sm-10">
                            <select name="nip" class="form-control">
                                <?php
                                    foreach ($d->result() as $row) {
                                        echo "<option value='".$row->id_paramedis."' ".($nip=$row->id_paramedis ? "selected" : "").">".$row->nama_paramedis."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tekanan Darah</label>
                        <div class="col-sm-10">
                            <input type="text" name="tekanan_darah" value="<?=$tekanan_darah;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Berat Badan</label>
                        <div class="col-sm-10">
                            <input type="text" name="berat_badan" value="<?=$berat_badan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Keluhan</label>
                        <div class="col-sm-10">
                            <input type="text" name="keluhan" value="<?=$keluhan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kunjungan Berikutnya</label>
                        <div class="col-sm-10">
                            <input type="text" name="tgl_kunjungan" value="<?=$tgl_kunjungan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tempat Rujukan / RSBM</label>
                        <div class="col-sm-10">
                            <select name='rujukan' class="form-control">
                            <?php echo $this->Mpendaftaran->rujukan($rujukan);?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <div class="btn-group">
                                <button class="back btn btn-warning" type="reset">Batal</button>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class='col-lg-12'>
                <?php  
                    if ($r){
                        echo "<div class='box box-primary'>
                        <div class='box-body'>
                        <div class='box-header'><h3 class='box-title'>Penyakit</h3></div>";
                        echo "
                            <table class='table table-bordered' id='colums'>
                                <tr class='bg-navy'>
                                    <th width='20px' >No</th>
                                    <th>Nama Penyakit</th>
                                    <th width=200>Tindakan</th>
                                    <th width=200>Status Kasus</th>
                                    <th width=100>Action</th>
                                </tr>                                            
                         ";
                         echo form_open("umum/simpanpenyakit_pasien",array("id"=>"formsavelab","class"=>"form-horizontal"));
                         echo "
                                <tr>
                                    <td>&nbsp;</td>
                                    <td width=500px>
                                        <input type=hidden name='id_bpumum' value='".$id_bpumum."'>
                                        <input type=hidden name='id_penyakit' class='id_penyakit'>
                                        <input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>
                                        <div class='input-group'>
                                            <input type=text name='nama_penyakit' class='form-control nama_penyakit' autocomplete='off'>
                                            <span class='input-group-btn'><button class='cari btn btn-success'><i class='fa fa-search'></i></button></span>
                                        </div>
                                    </td>
                                    <td width=400px>        
                                        <input type=hidden name='id_tindakan' class='id_tindakan'>
                                        <div class='input-group'>
                                            <input type=text name='nama_tindakan' class='form-control nama_tindakan' autocomplete='off'>
                                            <span class='input-group-btn'><button class='cari_tindakan btn btn-success'><i class='fa fa-search'></i></button></span>
                                        </div>
                                    </td>
                                    <td width=50px>
                                        <select name='status_kasus' class='form-control'>";
                                            foreach ($q4->result() as $row) {
                                                echo "<option value='".$row->status_kasus."'>".$row->status_kasus."</option>";
                                            }
                                echo "
                                        </select>
                                    </td>
                                    <td style='text-align:center' width=50px>
                                        <button type='submit' name='Submit' class='btn btn-success'><i class='fa fa-save'></i></button>
                                    </td>
                                </tr>";
                        echo form_close();
                        $i = 0;
                        foreach ($q1->result() as $row){
                            $i++;
                            echo "
                                <tr class='pasienlab'>
                                  <td align=center>".$i."</td>
                                  <td>".$row->nama_penyakit."</td>
                                  <td>".$row->nama_tindakan."</td>
                                  <td>".$row->status_kasus."</td>
                                  <td style='text-align:center'>
                                    <button type='button' class='hapuspenyakit btn btn-danger' value='".$id_pendaftaran."/".$row->id_detail."'>
                                            <i class='fa fa-trash'></i>
                                    </button>
                                  </td>
                                </tr>";
                        }
                        echo"
                            </table>
                            <div class='hr-line-dashed'></div>
                </div>
            </div>";
            echo "<div class='box box-primary'>
                    <div class='box-body'>
                        <div class='box-header'><h3 class='box-title'>Laboratorium</h3></div>
                        <div class='box-body'>
                            <table id='data colums' class='table table-bordered'>
                            <?php echo form_close();?>
                            <tr class='bg-navy'>
                                <th width='20px' >No</th>
                                <th width=400>Labotarium</th>
                                <th>Keterangan</th>
                                <th width=100>Action</th>
                            </tr>";
                        echo form_open("umum/simpanpasienlab",array("id"=>"formsavelab","class"=>"form-horizontal"));
                        echo "
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <input type=hidden name='id_pendaftaran' value='".$id_pendaftaran."'>
                                    <input type=hidden name='id_bpumum' value='".$id_bpumum."'>
                                    <input type=hidden name='id_lab' class='id_lab'>
                                    <div class='input-group'>
                                        <input type=text name='nama_lab' class='form-control nama_lab' autocomplete='off'>
                                        <span class='input-group-btn'><button type='button' class='carilab btn btn-success'><i class='fa fa-search'></i></button></span>
                                    </div>
                                </td>
                                <td><input type=text name=keterangan class=form-control></td>
                                <td style='text-align:center'>
                                    <button type=submit name=Submit class='btn btn-success'><i class='fa fa-save'></i></button>
                                </td>
                            </tr>";
                        echo form_close();
                        $i = 0;
                        foreach ($q2->result() as $row){
                            $i++;
                            echo "
                            <tr class='pasienlab'>
                              <td align=center>".$i."</td>
                              <td>".$row->nama_lab."</td>
                              <td>".$row->keterangan."</td>
                              <td style='text-align:center'>
                                <button type='button' class='hapuspasienlab btn btn-danger' value='".$id_pendaftaran."/".$row->id_pasien_lab."'>
                                    <i class='fa fa-trash'></i>
                                </button>
                              </td>
                            </tr>";
                        }
                        echo"
                            </table>
                    </div>
                </div>
            </div>";
            echo "<div class='box box-primary'>
                    <div class='box-body'>
                        <div class='box-header'><h3 class='box-title'>Resep Obat</h3></div>
                            <div class='box-body'>
                                <table id='data colums' class='table table-bordered'>
                                    <tr class='bg-navy'>
                                        <th width='20px'>No</th>
                                        <th>Obat</th>
                                        <th width=400>Aturan Pakai</th>
                                        <th width=300>Dosis</th>
                                        <th width=100>Action</th>
                                    </tr>";
                        echo form_open("umum/simpanresep",array("id"=>"formsavelab","class"=>"form-horizontal"));
                        echo "
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type=hidden name='id_pendaftaran' value='".$id_pendaftaran."'>
                                        <input type=hidden name='id_bpumum' value='".$id_bpumum."'>
                                        <input type=hidden name='id_obat' class='id_obat'>
                                        <div class='input-group'>
                                            <input type=text name='nama_obat' class='form-control nama_obat' autocomplete='off'>
                                            <span class='input-group-btn'><button type='button' class='cariobat btn btn-success'><i class='fa fa-search'></i></button></span>
                                        </div>
                                    </td>
                                    <td><input type=text name=aturan_pakai class=form-control></td>
                                    <td><input type=text name=jml_pemakaian class=form-control></td>
                                    <td style='text-align:center'>
                                        <button type=submit name=Submit class='btn btn-success'><i class='fa fa-save'></i>
                                        </button>
                                    </td>
                                </tr>";
                        echo form_close();
                        $i = 0;
                        foreach ($q5->result() as $row){
                            $i++;
                            echo "
                                <tr class='pasienlab'>
                                    <td align=center>".$i."</td>
                                    <td>".$row->nama_obat."</td>
                                    <td>".$row->aturan_pakai."</td>
                                    <td>".$row->jml_pemakaian."</td>
                                    <td style='text-align:center'>
                                        <button type='button' class='hapusresep btn btn-danger' value='".$id_pendaftaran."/".$row->id_resep."'>
                                            <i class='fa fa-trash'></i>
                                        </button>
                                    </td>
                              </tr>";
                        }
                        echo "
                            </table>
                        </div>
                    </div>
                </div>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>