
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
        var petugas_pa = localStorage.getItem("petugas_pa");
        var pa = localStorage.getItem("pa");
        var dokter_pengirim = localStorage.getItem("dokter_pengirim");
        $("[name='pemeriksaan']").val(pemeriksaan=="undefined" ? "" : pemeriksaan);
        $("[name='no_foto']").val(no_foto=="undefined" ? "" : no_foto);
        $("[name='ukuran_foto']").val(ukuran_foto=="undefined" ? "" : ukuran_foto);
        $("[name='tanggal']").val(tanggal=="undefined" ? "" : tanggal);
        $("[name='dokter']").val(dokter=="undefined" ? "" : dokter);
        $("[name='petugas_pa']").val(petugas_pa=="undefined" ? "" : petugas_pa);
        $("[name='pa']").val(pa=="undefined" ? "" : pa);
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
            var url = "<?php echo site_url('pa/cetak_inap');?>/"+no_reg+"/"+no_pasien+"/"+tindakan[0]+"/"+tindakan[3]+"/"+tindakan[4];
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
            var dokter = $("input[name='pa']").val();
            var url = "<?php echo site_url('pa/ambildatanormal');?>/"+dokter;
            openCenteredWindow(url);
            return false;
        });
        $("select[name='dokter']").change(function(){
            var rad = $(this).find(':selected').attr('data-id');
            $("input[name='pa']").val(rad);
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
            localStorage.removeItem("petugas_pa");
            localStorage.removeItem("pa");
            localStorage.removeItem("dokter_pengirim");
            $.ajax({
                url : "<?php echo base_url();?>/pa/getkasir_inap_detail/"+no_reg+"/"+tindakan[0]+"/"+tindakan[3]+"/"+tindakan[4],
                success: function(data){
                    var result = JSON.parse(data);
                    localStorage.setItem("dokter",result[0]["nama_dokter"]);
                    localStorage.setItem("petugas_pa",result[0]["nama"]);
                    localStorage.setItem("pa",result[0]["pa"]);
                    localStorage.setItem("dokter_pengirim",result[0]["dokter_pengirim"]);
                }
            });
            window.location = "<?php echo site_url('pa/ekspertisi_inap');?>/"+no_pasien+"/"+no_reg+"/"+tindakan[0]+"/"+tindakan[3]+"/"+tindakan[4];
        });

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
        echo form_open("pa/simpanekspertisi_inap/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
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
                    <label class="col-md-2 control-label">Dokter PA</label>
                    <div class="col-md-2">
                        <input type="text" disabled class="form-control" name='dokter' readonly value="<?php echo $row->nama_dokter;?>"/>
                        
                    <input type="hidden" readonly class="form-control" name='dokter_pa' readonly value="<?php echo $row->dokter_pa;?>"/>
                    </div>
                    <label class="col-md-1 control-label">Petugas PA</label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control" name='petugas_pa' readonly value="<?php echo $row->radio;?>"/>
                    </div>
                    <label class="col-md-2 control-label">Dokter Pengirim</label>
                    <div class="col-md-3">
                        <input type="text" readonly class="form-control" name='dokter_pengirim' readonly value="<?php echo $row->peng;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Ukuran</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" readonly name='ukuran_foto' />
                    </div>
                    <label class="col-md-1 control-label">Nomor</label>
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
                                        <option value='".$kas->kode_tindakan."/".$kas->nofoto."/".$kas->ukuranfoto."/".$kas->tanggal."/".$kas->pemeriksaan."' ".($kas->kode_tindakan==$kode_tindakan && $kas->tanggal == $tgl && $kas->pemeriksaan==$pemeriksaan ? "selected" : "").">".$kas->nama_tindakan." || Tanggal : ".date('d-m-Y',strtotime($kas->tanggal))." || Pemeriksaan ke- ".$kas->pemeriksaan."</option>
                                    ";
                                }
                            ?>
                        </select>
                        <input type="hidden" readonly class="form-control" name='pa'/>
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