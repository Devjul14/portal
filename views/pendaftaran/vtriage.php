
<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
        $("[name='rujuk_ke']").hide();
        $("[name='alasan_rujuk']").hide();
        $("[name='tindak_lanjut']").change(function(){
            if ($("[name='tindak_lanjut']").val() == "rujuk"){
                $("[name='rujuk_ke']").show();
                $("[name='alasan_rujuk']").show();
            }else if($("[name='tindak_lanjut']").val() != "rujuk"){
                $("[name='rujuk_ke']").hide();
                $("[name='alasan_rujuk']").hide();
            }
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $('.back').click(function(){
            window.location = "<?php echo site_url('dokter/rawat_inapdokter');?>";
            
        });
        $('.cetak').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var url = "<?php echo site_url('dokter/cetaktriage');?>/"+no_reg;
            openCenteredWindow(url);
        });
        $('.lunas').click(function(){
            $(".modalnotif").modal("show");
            var total = $("[name='total']").val();
            $(".total").html("Rp. "+total);
        });
        $('.hapus').click(function(){
            var id= $(this).attr("id");
            $.ajax({
                url : "<?php echo base_url();?>kasir/hapustindakan",
                method : "POST",
                data : {id: id},
                success: function(data){
                     location.reload();
                }
            });
        });
        $(".ambil").click(function(){
            var url = "<?php echo site_url('dokter/ambiltriage');?>/";
            openCenteredWindow(url);
            return false;
        });
        $("select[name='dokter']").change(function(){
            var rad = $(this).find(':selected').attr('data-id');
            $("input[name='radiologi']").val(rad);
        });
        $("[name='triage']").keydown(function(){
            // var rad = $(this).find(':selected').attr('data-id');
            var triage = $(this).val();
            if(triage != "D.O.A"){
            $("#doa").hidden();
            }
        });
        
        $("select[name='dokter_triage']").select2();
        $("select[name='dokter_igd']").select2();
        $("select[name='petugas_igd']").select2();
        $("select[name='keputusan']").select2();

        // $("textarea[name='hasil_pemeriksaan']").change(function(){
    
                // $("textarea[name='hasil_pemeriksaan']").wysihtml5();
        // });

    });
</script>
<?php
    if ($q1) {
        $triage      = $q1->triage;
        $waktu      = $q1->waktu;
        $jalan_nafas      = $q1->jalan_nafas;
        $survei_primer      = $q1->survei_primer;
        $pernafasan      = $q1->pernafasan;
        $sirkulasi      = $q1->sirkulasi;
        $gangguan      = $q1->gangguan;
        $kesadaran      = $q1->kesadaran;
        $nyeri      = $q1->nyeri;
        $waktu_keputusan      = $q1->waktu_keputusan;
        $anamnesis      = $q1->anamnesis;
        $td      = $q1->td;
        $td2      = $q1->td2;
        $nadi      = $q1->nadi;
        $respirasi      = $q1->respirasi;
        $suhu      = $q1->suhu;
        $spo2      = $q1->spo2;
        $bb      = $q1->bb;
        $tb      = $q1->tb;
        $s      = $q1->s;
        $o      = $q1->o;
        $a      = $q1->a;
        $p      = $q1->p;
        $tanggal      = $q1->tanggal;
        $jam      = $q1->jam;
        $jam_doa      = $q1->jam_doa;
        $nama_pasien = $q1->nama_pasien;
        $doa = $q1->doa;
        $rujuk_ke = $q1->rujuk_ke;
        $tindak_lanjut = $q1->tindak_lanjut;
        $alasan_rujuk = $q1->alasan_rujuk;
        $nama_kelas = 
        $nama_ruangan = 
        $kode_kelas =
        $kode_kamar ="";
    } else {
        $triage  = "";
        $waktu_keputusan   = date("H:i:s");
        $waktu      =
        $jalan_nafas      =
        $survei_primer      =
        $pernafasan      =
        $sirkulasi      =
        $gangguan      =
        $kesadaran      =
        $nyeri      =
        $anamnesis      =
        $td      =
        $td2      =
        $nadi      =
        $respirasi      =
        $suhu      =
        $spo2      =
        $bb      =
        $tb      =
        $s      =
        $o      =
        $a      =
        $p      =
        $doa =
        $jam_doa =
        $nama_kelas = 
        $nama_pasien = 
        $nama_ruangan = 
        $kode_kelas =
        $rujuk_ke =
        $alasan_rujuk =
        $tindak_lanjut =
        $kode_kamar = "";
        $tanggal      = date("d-m-Y");
        $jam      = date("H:i:s");
        
    }

?>
<div class="col-md-12">
    <?php
        echo form_open("dokter/simpantriage_inap/".$no_reg,array("id"=>"formsave","class"=>"form-horizontal"));
    ?>
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
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">No. Reg</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
                    </div>
                    <label class="col-md-1 control-label">No. RM</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nama Pasien</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='nama_pasien' value="<?php echo $nama_pasien;?>"/>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_ruangan' readonly value="<?php echo $nama_ruangan ?>"/>
                    </div>
                    <label class="col-md-1 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="hidden" readonly class="form-control" name='kode_kelas' readonly value="<?php echo $kode_kelas;?>"/>
                        <input type="text" readonly class="form-control" name='nama_kelas' readonly value="<?php echo $nama_kelas;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kamar</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='kode_kamar' readonly value="<?php echo $kode_kamar;?>"/>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-md-2 control-label">Dokter IGD</label>
                    <div class="col-md-2">
                        <select class="form-control"  name="dokter_igd">
                            <option value="">-----</option>
                            <?php
                                foreach ($dokterigd->result() as $key) {
                                    echo "
                                        <option value='".$key->id_dokter."' ".($key->id_dokter==$q1->dokter_igd ? "selected" : "").">".$key->nama_dokter."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-1 control-label">Perawat / Bidan Triage</label>
                    <div class="col-md-2">
                        <select class="form-control"  name="petugas_igd">
                            <option value="">-----</option>
                            <?php
                                foreach ($petugas_igd->result() as $key) {
                                    echo "
                                        <option value='".$key->id_perawat."' ".($key->id_perawat==$q1->petugas_igd ? "selected" : "").">".$key->nama_perawat."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-2 control-label">Dokter Triage</label>
                    <div class="col-md-3">
                        <select class="form-control"  name="dokter_triage">
                            <option value="">-----</option>
                            <?php
                                foreach ($dokter->result() as $key) {
                                    echo "
                                        <option value='".$key->id_dokter."' ".($key->id_dokter==$q1->dokter_triage ? "selected" : "").">".$key->nama_dokter."</option>
                                    ";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <div class="form-group">
                    <div class="col-md-12">
                        <button class="ambil btn btn-warning">
                            Pilih Triage
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">Triage</label>
                    <div class="col-md-2">
                        <input type="hidden" class="form-control" name='kode_triage' value="<?php echo $no_reg;?>"/>
                        <input type="text" class="form-control" name='triage' value="<?php echo $triage;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Waktu</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='waktu' value="<?php echo $waktu;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Survei Primer</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='survei_primer' value="<?php echo $survei_primer;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jalan Nafas</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='jalan_nafas' value="<?php echo $jalan_nafas;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Kesadaran</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='kesadaran' value="<?php echo $kesadaran;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Nyeri</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='nyeri' value="<?php echo $nyeri;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Kunjungan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='tanggal' value="<?php echo $tanggal;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Waktu Kunjungan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='jam' value="<?php echo $jam;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Waktu Keputusan</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name='waktu_keputusan' value="<?php echo $waktu_keputusan;?>"/>
                    </div>
                    <div class="col-md-2">
                        <select name="keputusan" class="form-control">
                            <option value="">-----</option>
                                <?php
                                    foreach ($keputusan->result() as $key) {
                                        echo "
                                            <option value='".$key->kode."' ".($key->kode==$q1->keputusan ? "selected" : "").">".$key->nama."</option>
                                        ";
                                    }
                                ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">Pernafasan</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="pernafasan" style="max-width: 100%;height:160px;"><?php echo $pernafasan ?></textarea>
                    </div>
                    <label class="col-md-2 control-label">Sirkulasi</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="sirkulasi" style="max-width: 100%;height:160px;"><?php echo $sirkulasi?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Gangguan</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="gangguan" style="max-width: 100%;height:160px;"><?php echo $gangguan?></textarea>
                    </div>
                    <div id="doa">
                        <label class="col-md-2 control-label">D.O.A</label>
                        <div class="col-md-4">
                            <textarea class="form-control" name="doa" style="max-width: 100%;height:160px;"><?php echo $doa ?></textarea>
                        </div>
                    </div>
                    <!-- <label class="col-md-2 control-label">Anamnesis</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="anamnesis" style="max-width: 100%;height:160px;"><?php echo $anamnesis ?></textarea>
                    </div> -->
                </div>
                <!-- <div class="form-group">
                    <label class="col-md-2 control-label">S</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="s" style="max-width: 100%;height:160px;"><?php echo $s ?></textarea>
                    </div>
                    <label class="col-md-2 control-label">O</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="o" style="max-width: 100%;height:160px;"><?php echo $o ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">A</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="a" style="max-width: 100%;height:160px;"><?php echo $a ?></textarea>
                    </div>
                    <label class="col-md-2 control-label">P</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="p" style="max-width: 100%;height:160px;"><?php echo $p ?></textarea>
                    </div>
                </div> -->
                <?php 
                    if($tindak_lanjut){

                    }
                ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tindak Lanjut</label>
                    <div class="col-md-4">
                        <select name="tindak_lanjut" class="form-control" <?php echo ($tindak_lanjut!="" ? "disabled" : "");?>>
                            <option value="ralan" <?php echo ($tindak_lanjut=="ralan" ? "selected" : "");?>>Rawat Jalan</option>
                            <option value="ranap" <?php echo ($tindak_lanjut=="ranap" ? "selected" : "");?>>Rawat Inap</option>
                            <option value="rujuk" <?php echo ($tindak_lanjut=="rujuk" ? "selected" : "");?>>Rujuk</option>
                        </select>     
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='rujuk_ke' placeholder="Rujuk Ke" value="<?php echo $rujuk_ke;?>"/>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name='alasan_rujuk' placeholder="alasan_rujuk" value="<?php echo $alasan_rujuk;?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="cetak btn btn-primary" type="button"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<div class="modal fade modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy">Yakin akan membayar sejumlah</div>
            <div class="modal-body">
                <h2 class="total"></h2>
            </div>
            <div class="modal-footer">
                <button class="okbayar btn btn-success" type="button">OK</button>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: -15px;
    }
    .select2-container--default .select2-selection--single{
        padding: 16px 0px;
        border-color: #d2d6de;
    }
    #hp{
    
    }
</style>