<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery.signature.js"></script>
    <script src="<?php echo base_url();?>js/jquery.ui.touch-punch.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
  </head>
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
    $(document).ready(function() {
        $("#signature").signature({syncField: '#signatureJSON'});
        $('#signature').signature('option', 'syncFormat', "PNG");
        $('#signature').draggable();
        // getimage();
        $("#signature2").signature({syncField: '#signatureJSON2'});
        $('#signature2').signature('option', 'syncFormat', "PNG");
        $('#signature2').draggable();
        $(".back").click(function(){
            var no_reg  = $("[name='no_reg']").val();
            var jenis   = $("[name='jenis']").val();
            var url     = "<?php echo site_url('persetujuan/reset');?>/"+jenis+"/"+no_reg;
            window.location = url;
            return false;
        });
        $(".cetak").click(function(){
            var no_reg          = $("[name='no_reg']").val();
            var no_pasien       = $("[name='no_pasien']").val();
            var jenis   = $("[name='jenis']").val();
            var url = "<?php echo site_url('surat/cetaktindakanmedis');?>/"+no_reg+"/"+no_pasien+"/"+jenis;
            openCenteredWindow(url);
        });
    });
</script>
<?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='col-xs-12'><div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div></div>";
    }
?>
<?php
    $t1 = new DateTime('today');
    $t2 = new DateTime($q->tgl_lahir);
    $y  = $t1->diff($t2)->y;
    $m  = $t1->diff($t2)->m;
    $d  = $t1->diff($t2)->d;

    list($year,$month,$day) = explode("-",$q->tgl_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) {
        $year_diff--;
        $month_diff *= (-1);
    }
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    if ($day_diff < 0) {
        $day_diff *= (-1);
    }
    $umur_pasien = $year_diff." tahun ".$month_diff." bulan ".$day_diff." hari ";
?>
<div class="col-xs-12 margin">
    <div class="box box-primary">
        <div class="box-body">
            <?php if (!$p->lock) echo form_open("surat/simpantindakanmedis",array("class"=>"form-horizontal")); else echo "<div class='form-horizontal'>";?>
            <div class="row">
                <div class="col-xs-6"><h3>SURAT PERSETUJUAN TINDAKAN KEDOKTERAN</h3></div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Pasien</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="jenis" value="<?php echo $jenis ?>">
                            <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo $q->nama_pasien ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No Reg</label>
                        <div class="col-sm-4">
                            <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $no_reg ?>">
                        </div>
                        <label class="col-sm-2 control-label">No RM</label>
                        <div class="col-sm-3">
                            <input type="text" name="no_pasien" class="form-control" readonly value="<?php echo $no_pasien ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo ($q->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($q->tgl_lahir))); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Yang bertandatangan di bawah ini,</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" required name="nama" class="form-control" value="<?php echo $p->nama ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Umur</label>
                        <div class="col-sm-3">
                            <input type="text" required name="umur" class="form-control" value="<?php echo $p->umur ?>">
                        </div>
                        <label class="col-sm-3 control-label">Jenis Kelamin</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="jk">
                                <option value="">---Pilih JK---</option>
                                <option value="L" <?php echo ($p->jk=="L" ? "selected" : "");?>>Laki-laki</option>
                                <option value="P" <?php echo ($p->jk=="P" ? "selected" : "");?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" required name="alamat" class="form-control" value="<?php echo $p->alamat ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Hubungan dengan pasien</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="hubungan">
                                <option value="">---Pilih---</option>
                                <option value="Saya" <?php echo ($p->hubungan=="Saya" ? "selected" : "");?>>Saya</option>
                                <option value="Ayah" <?php echo ($p->hubungan=="Ayah" ? "selected" : "");?>>Ayah</option>
                                <option value="Ibu" <?php echo ($p->hubungan=="Ibu" ? "selected" : "");?>>Ibu</option>
                                <option value="Anak" <?php echo ($p->hubungan=="Anak" ? "selected" : "");?>>Anak</option>
                                <option value="Saudara" <?php echo ($p->hubungan=="Saudara" ? "selected" : "");?>>Saudara</option>
                                <option value="Paman" <?php echo ($p->hubungan=="Paman" ? "selected" : "");?>>Paman</option>
                                <option value="Bibi" <?php echo ($p->hubungan=="Bibi" ? "selected" : "");?>>Bibi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Saksi</label>
                        <div class="col-sm-9">
                            <input type="text" required name="nama_saksi" class="form-control" value="<?php echo $p->nama_saksi ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Bahwa saya telah menerima informasi dari dokter dan telah memahaminya</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pelaksana Tindakan</label>
                        <div class="col-sm-9">
                            <select name="pelaksana_tindakan" class="form-control" style="width: 100%" disabled>
                                <?php
                                    foreach ($dok->result() as $key) {
                                        echo "<option value=".$key->id_dokter." ".($p->pelaksana_tindakan==$key->id_dokter ? "selected" : "").">".$key->nama_dokter."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pemberi Informasi</label>
                        <div class="col-sm-9">
                            <select name="pemberi_informasi" class="form-control" style="width: 100%" disabled>
                                <?php
                                    foreach ($dp["dokter"] as $key => $value) {
                                        echo "<option value='dokter/".$key."' ".($p->kategori_pemberi_informasi."/".$p->pemberi_informasi=='dokter/'.$key ? "selected" : "").">".$value."</option>";
                                    }
                                    foreach ($dp["perawat"] as $key => $value) {
                                        echo "<option value='perawat/".$key."' ".($p->kategori_pemberi_informasi."/".$p->pemberi_informasi=='perawat/'.$key ? "selected" : "").">".$value."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <?php if ($p->tindakan_kedokteran!="") :?>
                            <table class="table table-bordered table-striped">
                                <tr class="bg-orange">
                                    <th class="text-center" colspan="3">TINDAKAN KEDOKTERAN</th>
                                </tr>
                                <tr class="bg-blue">
                                    <th class="text-center" width=5%>NO.</th>
                                    <th class="text-center" width=40%>JENIS INFORMASI</th>
                                    <th class="text-center">ISI INFORMASI</th>
                                </tr>
                                <?php
                                    $tindakan = "Kedokteran";
                                    $kedokteran = explode(",",$p->tindakan_kedokteran);
                                    $keterangan_kedokteran = explode("|",$p->keterangan_tindakan_kedokteran);
                                    foreach($kedokteran as $key => $value){
                                        echo "<tr>";
                                        echo "<td class='text-center'>".($key+1)."</td>";
                                        echo "<td>".$tm[$value]."</td>";
                                        echo "<td>".$keterangan_kedokteran[$key]."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </table>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dengan ini menyatakan</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="status_tindakan_kedokteran" required>
                                        <option value="">---Pilih---</option>
                                        <option value="1" <?php echo ($p->status_tindakan_kedokteran=="1" ? "selected" : "");?>>Persetujuan</option>
                                        <option value="0" <?php echo ($p->status_tindakan_kedokteran=="0" ? "selected" : "");?>>Penolakan</option>
                                    </select>
                                </div>
                                <label class="col-sm-6 control-label">Untuk dilakukan <span class='text-red'>Tindakan <?php echo $tindakan;?></label></span>
                            </div>
                            <?php endif ?>
                            <?php if ($p->tindakan_anestesi!="") :?>
                            <table class="table table-bordered table-striped">
                                <tr class="bg-orange">
                                    <th class="text-center" colspan="3">TINDAKAN ANESTESI</th>
                                </tr>
                                <tr class="bg-blue">
                                    <th class="text-center" width=5%>NO.</th>
                                    <th class="text-center" width=40%>JENIS INFORMASI</th>
                                    <th class="text-center">ISI INFORMASI</th>
                                </tr>
                                <?php
                                    $tindakan = "Anestesi";
                                    $anestesi = explode(",",$p->tindakan_anestesi);
                                    $keterangan_anestesi = explode("|",$p->keterangan_tindakan_anestesi);
                                    foreach($anestesi as $key => $value){
                                        echo "<tr>";
                                        echo "<td class='text-center'>".($key+1)."</td>";
                                        echo "<td>".$tm[$value]."</td>";
                                        echo "<td>".$keterangan_anestesi[$key]."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </table>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dengan ini menyatakan</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="status_tindakan_anestesi" required>
                                        <option value="">---Pilih---</option>
                                        <option value="1" <?php echo ($p->status_tindakan_anestesi=="1" ? "selected" : "");?>>Persetujuan</option>
                                        <option value="0" <?php echo ($p->status_tindakan_anestesi=="0" ? "selected" : "");?>>Penolakan</option>
                                    </select>
                                </div>
                                <label class="col-sm-6 control-label">Untuk dilakukan <span class='text-red'>Tindakan <?php echo $tindakan;?></label></span>
                            </div>
                            <?php endif ?>
                            <?php if ($p->tindakan_transfusi!="") :?>
                            <table class="table table-bordered table-striped">
                                <tr class="bg-orange">
                                    <th class="text-center" colspan="3">TINDAKAN TRANSFUSI</th>
                                </tr>
                                <tr class="bg-blue">
                                    <th class="text-center" width=5%>NO.</th>
                                    <th class="text-center" width=40%>JENIS INFORMASI</th>
                                    <th class="text-center">ISI INFORMASI</th>
                                </tr>
                                <?php
                                    $tindakan = "Tranfusi";
                                    $transfusi = explode(",",$p->tindakan_transfusi);
                                    $keterangan_transfusi = explode("|",$p->keterangan_tindakan_transfusi);
                                    foreach($transfusi as $key => $value){
                                        echo "<tr>";
                                        echo "<td class='text-center'>".($key+1)."</td>";
                                        echo "<td>".$tm[$value]."</td>";
                                        echo "<td>".$keterangan_transfusi[$key]."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </table>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dengan ini menyatakan</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="status_tindakan_transfusi" required>
                                        <option value="">---Pilih---</option>
                                        <option value="1" <?php echo ($p->status_tindakan_transfusi=="1" ? "selected" : "");?>>Persetujuan</option>
                                        <option value="0" <?php echo ($p->status_tindakan_transfusi=="0" ? "selected" : "");?>>Penolakan</option>
                                    </select>
                                </div>
                                <label class="col-sm-6 control-label">Untuk dilakukan <span class='text-red'>Tindakan <?php echo $tindakan;?></label></span>
                            </div>
                            <?php endif ?>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="col-xs-12 control-label">Tanda Tangan Pembuat Pernyataan</h4>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input type="hidden" name="ttd_pernyataan" id="signatureJSON">
                                        <?php if ($p->lock) :?> <img class="img-thumbnail" style="height:50%" alt="Product Image" src="<?php echo $ttd->ttd;?>">
                                        <?php else : ?>
                                        <div id="signature"></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="col-xs-12 control-label">Tanda Tangan Saksi</h4>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input type="hidden" name="ttd_saksi" id="signatureJSON2">
                                        <?php if ($p->lock) :?> <img class="img-thumbnail" style="height:50%" alt="Product Image" src="<?php echo $ttd->ttd2;?>">
                                        <?php else : ?>
                                        <div id="signature2"></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($p->lock) echo "</div>";?>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                    <?php if (!$p->lock) : ?>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Submit</button>
                    <?php endif ?>
                    <?php if ($p->lock) : ?>
                        <button class="cetak btn btn-success" type="button"><i class="fa fa-print"></i> Cetak</button>
                    <?php endif ?>
                </div>
            </div>
            <?php if (!$p->lock) echo form_close();?>
        </div>
    </div>
</div>
<style type="text/css">
    #signature{
        width: 100%;
        height: 300px;
        border: 1px solid black;
    }

    #signature2{
        width: 100%;
        height: 300px;
        border: 1px solid black;
    }
</style>
