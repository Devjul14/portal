
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
        var no_foto = localStorage.getItem("no_foto");
        var ukuran_foto = localStorage.getItem("ukuran_foto");
        var tanggal = localStorage.getItem("tanggal");
        var pemeriksaan = localStorage.getItem("pemeriksaan");
        var dokter = localStorage.getItem("dokter");
        var radiografer = localStorage.getItem("radiografer");
        var radiologi = localStorage.getItem("radiologi");
        var dokter_pengirim = localStorage.getItem("dokter_pengirim");
        $("[name='pemeriksaan']").val(pemeriksaan=="undefined" ? "" : pemeriksaan);
        $("[name='no_foto']").val(no_foto=="undefined" ? "" : no_foto);
        $("[name='ukuran_foto']").val(ukuran_foto=="undefined" ? "" : ukuran_foto);
        $("[name='tanggal']").val(tanggal=="undefined" ? "" : tanggal);
        $("[name='dokter']").val(dokter=="undefined" ? "" : dokter);
        $("[name='radiografer']").val(radiografer=="undefined" ? "" : radiografer);
        $("[name='radiologi']").val(radiologi=="undefined" ? "" : radiologi);
        $("[name='dokter_pengirim']").val(dokter_pengirim=="undefined" ? "" : dokter_pengirim);
        $('.back').click(function(){
            var cari_no = $("[name='no_reg']").val();
            $.ajax({
                type  : "POST",
                data  : {cari_no:cari_no},
                url   : "<?php echo site_url('pendaftaran/getcaripasien_inap');?>",
                success : function(result){
                    window.location = "<?php echo site_url('pendaftaran/rawat_inap');?>";
                },
                error: function(result){
                    alert(result);
                }
            });
        });
        $('.cetak').click(function(){
            var no_reg= $("[name='no_reg']").val();
            var no_pasien = $("input[name='no_rm']").val();
            var t = $("[name='tindakan']").val();
            var tindakan = t.split("/");
            var url = "<?php echo site_url('radiologi/cetak_inap');?>/"+no_reg+"/"+no_pasien+"/"+tindakan[0]+"/"+tindakan[3]+"/"+tindakan[4];
            openCenteredWindow(url);
        });
        $('.lunas').click(function(){
            $(".modalnotif").modal("show");
            var total = $("[name='total']").val();
            $(".total").html("Rp. "+total);
        });
        $("select[name='dokter']").change(function(){
            var rad = $(this).find(':selected').attr('data-id');
            $("input[name='radiologi']").val(rad);
        });
        $("select[name='tindakan']").change(function(){
            var no_reg = $("input[name='no_reg']").val();
            var no_pasien = $("input[name='no_rm']").val();
            var t = $(this).val();
            var tindakan = t.split("/");
            localStorage.setItem("no_foto",tindakan[1]);
            localStorage.setItem("ukuran_foto",tindakan[2]);
            localStorage.setItem("tanggal",tindakan[3]);
            localStorage.setItem("pemeriksaan",tindakan[4]);
            localStorage.removeItem("dokter");
            localStorage.removeItem("radiografer");
            localStorage.removeItem("radiologi");
            localStorage.removeItem("dokter_pengirim");
            $.ajax({
                url : "<?php echo base_url();?>/radiologi/getkasir_inap_detail/"+no_reg+"/"+tindakan[0]+"/"+tindakan[3]+"/"+tindakan[4],
                success: function(data){
                    var result = JSON.parse(data);
                    localStorage.setItem("dokter",result[0]["nama_dokter"]);
                    localStorage.setItem("radiografer",result[0]["nama"]);
                    localStorage.setItem("radiologi",result[0]["radiologi"]);
                    localStorage.setItem("dokter_pengirim",result[0]["dokter_pengirim"]);
                }
            });
            window.location = "<?php echo site_url('pendaftaran/ekspertisiradiologi_inap');?>/"+no_pasien+"/"+no_reg+"/"+tindakan[0]+"/"+tindakan[3]+"/"+tindakan[4];
        });
        $("select[name='dokter']").select2();
        $("select[name='dokter_pengirim']").select2();

        // $("textarea[name='hasil_pemeriksaan']").change(function(){

                // $("textarea[name='hasil_pemeriksaan']").wysihtml5();
        // });

    });
</script>
<?php
    if ($q) {
        $hasil_pemeriksaan      = $q->hasil_pemeriksaan;
        $action     = "edit";
    } else {
        $hasil_pemeriksaan  = "";
        $action = "simpan";
    }

?>
<div class="col-md-12">
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
                        <input type="text" readonly class="form-control" name='nama_pasien' readonly value="<?php echo $row->nama_pasien;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ruangan</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='nama_ruangan' readonly value="<?php echo $row->nama_ruangan;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Kelas</label>
                    <div class="col-md-2">
                        <input type="hidden" readonly class="form-control" name='kode_kelas' readonly value="<?php echo $row->kode_kelas;?>"/>
                        <input type="text" readonly class="form-control" name='nama_kelas' readonly value="<?php echo $row->nama_kelas;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Kamar</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='kode_kamar' readonly value="<?php echo $row->kode_kamar;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Dokter Radiologi</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='dokter' readonly value="<?php echo $row->nama_dokter;?>"/>

                    <input type="hidden" readonly class="form-control" name='dokter_radiologi' readonly value="<?php echo $row->dokter_radiologi;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Radiografer</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='radiografer' readonly value="<?php echo $row->radio;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Dokter Pengirim</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='dokter_pengirim' readonly value="<?php echo $row->peng;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ukuran Foto</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" readonly name='ukuran_foto' />
                    </div>
                    <label class="col-md-1 control-label">No Foto</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" readonly name='no_foto' />
                    </div>
                    <label class="col-md-2 control-label">Tindakan</label>
                    <div class="col-md-3">
                        <select class="form-control"  name="tindakan">
                            <option value="">-----</option>
                            <?php
                                foreach ($k->result() as $kas) {
                                    echo "
                                        <option value='".$kas->id_tindakan."/".$kas->nofoto."/".$kas->ukuranfoto."/".$kas->tanggal."/".$kas->pemeriksaan."' ".($kas->id_tindakan==$id_tindakan && $kas->tanggal == $tgl && $kas->pemeriksaan==$pemeriksaan ? "selected" : "").">".$kas->nama_tindakan." || Tanggal : ".date('d-m-Y',strtotime($kas->tanggal))." || Pemeriksaan ke- ".$kas->pemeriksaan."</option>
                                    ";
                                }
                            ?>
                        </select>
                        <input type="hidden" readonly class="form-control" name='radiologi'/>
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
                    <button class="cetak btn btn-primary" type="button"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-12 control-label">Hasil Pemeriksaan</label>
                <div class="col-md-12">
                    <textarea class="form-control" name="hasil_pemeriksaan" style="max-width: 100%;height:300px;"><?php echo $hasil_pemeriksaan ?></textarea>
                    <!-- <input type="text" name="hasil_pemeriksaan"> -->
                </div>
                <!--  style="max-width: 100%;height:300px" -->
            </div>
        </div>
    </div>
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
