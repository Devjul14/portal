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
    $(document).ready(function(){
        $(".cetak").click(function(){
            var kode         = $("[name='kode_so']").val();
            var jenis        = $("[name='jenis_obat']").val();
            var search       = $("[name='search']").val();
            var url          = "<?php echo site_url('stok_opname/cetak')?>/"+kode+"/"+jenis+"/"+search;
            openCenteredWindow(url);
            return false;
        });
        $(".excel").click(function(){
            var kode         = $("[name='kode_so']").val();
            var jenis        = $("[name='jenis_obat']").val();
            var search       = $("[name='search']").val();
            var url          = "<?php echo site_url('stok_opname/excel')?>/"+kode+"/"+jenis+"/"+search;
            window.location  = url;
            return false;
        });
        $("#listdata table tr#data:first").addClass("seleksi");
        $("#listdata2 table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        $("select[name='petugas_pemesanan']").select2();
        $("select[name='supplier']").select2();
        var formattgl = "yy-mm";
        $("input[name='periode']").datepicker({
            dateFormat : formattgl,
        });
        $(".expire_date").datepicker({
            dateFormat : formattgl,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('stok_opname/list_stokopname')?>";
            return false;
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            window.location = "<?php echo site_url('stok_opname/hapusitemrk')?>/"+kode;
            return false;
        });
        $("select[name='jenis_obat']").change(function(){
            var jenis       = $(this).val();
            var kode        =  $("input[name='kode_so']").val();
            // var search      =  $("input[name='search']").val();
            window.location = "<?php echo site_url('stok_opname/formstok_opname')?>/"+kode+"/"+jenis;
            return false;
        });
        $(".cari").click(function(){
            var jenis       =  $("select[name='jenis_obat']").val();
            var kode        =  $("input[name='kode_so']").val();
            var search      =  $("input[name='search']").val();
            window.location = "<?php echo site_url('stok_opname/formstok_opname')?>/"+kode+"/"+jenis+"/"+search;
            return false;
        });
        $(".smpn").click(function(){
            $("#formsimpan2").submit();
        });
    });
</script>
<?php
    if ($q){
        $kode_so    = $q->kode_so;
        $periode    = $q->periode;
        $keterangan = $q->keterangan;
        $depo       = $q->depo;
        $r          = "readonly";
        $dis        = "disabled";
        $action     = "edit";
    } else {
        $kode_so    = date("dmYHis");
        $periode    = 
        $keterangan = 
        $r          =
        $dis        =
        $depo       = "";
        $action     = "simpan";
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
        <?php echo form_open("stok_opname/simpanstok_opname/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    Kode Stok Opname
                </label>
                <div class="col-md-2">
                    <input required type="text" name="kode_so" value="<?php echo $kode_so ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Periode
                </label>
                <div class="col-md-2">
                    <input required type="text" name="periode" value="<?php echo $periode ?>" class='form-control' autocomplete='off' <?php echo $r ?>>
                </div>
                <label class="col-md-2">
                    Depo
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="depo" required <?php echo $dis ?>>
                        <option value="">----</option>
                        <?php
                            foreach ($d->result() as $dep) {
                                echo "
                                    <option value='".$dep->kode_depo."' ".($dep->kode_depo==$depo ? "selected" : "").">".$dep->nama_depo."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-10">
                    <textarea class="form-control" name="keterangan" <?php echo $r ?>><?php echo $keterangan ?></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-left">
                <button type="button" class="cetak btn btn-info"> Cetak</button>
                <button type="button" class="excel btn btn-success"> Excel</button>
            </div>
            <div class="pull-right">
                <button class="btn btn-success"> Simpan</button>
                <button type="button" class="back btn btn-warning"> Kembali</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <?php if ($action=="edit"): ?>
        <?php if ($q1): ?>
            <?php echo form_open("stok_opname/simpanitem_so/".$kode,array("id"=>"formsimpan2","class"=>"form-horizontal"));?>
            <!-- <input type="hidden" name="from" value="<?php echo $from;?>">
            <input type="hidden" name="per_page" value="<?php echo $per_page;?>"> -->
            <div class="box box-info">
                <div class="box-header">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Jenis Obat</label>
                        <div class="col-md-4">
                            <select class="form-control" name="jenis_obat">
                                <option value="">----</option>
                                <?php
                                    foreach ($jo->result() as $val) {
                                        echo "
                                            <option value='".$val->kode_jenis."'  ".($jenis==$val->kode_jenis ? "selected" : "").">".$val->nama_jenis."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Search</label>
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control" value="<?php echo $search ?>">
                        </div>
                        <div class="col-md-1">
                           <button class="cari btn btn-success" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th width="50px">No</th>
                            <th width="100px" class="text-center">Kode Obat</th>
                            <th width="300px">Nama Obat</th>
                            <th width="150px" class="text-center">Stok Awal</th>
                            <th width="100px" class="text-center">Pemasukan</th>
                            <th width="100px" class="text-center">Pengeluaran</th>
                            <th width="100px" class="text-center">Stok Opname</th>
                            <th width="150px" class="text-center">Stok Real</th>
                            <th width="100px" class="text-center">Satuan Kecil</th>
                            <th width="200px" class="text-center">Jumlah</th>
                            <th width="300px" class="text-center">Keterangan</th>
                        </tr>
                        <?php 
                            $i = 0;
                            foreach ($so->result() as $val) {
                                $i++;
                                echo "
                                    <tr>
                                        <td>".$i."</td>
                                        <td>".$val->kode_obat."</td>
                                        <td>".$val->nama."</td>
                                        <td>
                                            <input type='text' name='stok_awal[".$val->kode_obat."]' class='form-control' readonly value='".$val->stok_awal."'>
                                        </td>
                                        <td>
                                            <input type='text' name='stok_pemasukan[".$val->kode_obat."]' class='form-control' readonly value='".$val->stok_pemasukan."'>
                                        </td>
                                        <td>
                                            <input type='text' name='stok_pemakaian[".$val->kode_obat."]' class='form-control' readonly value='".$val->stok_pemakaian."'>
                                        </td>
                                        <td>
                                            <input type='text' name='stok_so[".$val->kode_obat."]' class='form-control' readonly value='".$val->stok_so."'>
                                        </td>
                                        <td>
                                            <input type='text' class='form-control' name='stok_real[".$val->kode_obat."]' readonly value='".$val->stok_real."'>
                                        </td>
                                        <td>
                                            <input type='text' name='satuan_kecil[".$val->kode_obat."]' class='form-control' readonly value='".$val->satuan_kecil."'>
                                        </td>
                                        <td '>
                                            <input type='text' name='jumlah[".$val->kode_obat."]' class='form-control' readonly value='".number_format($val->jumlah,0,',','.')."'>
                                        </td>
                                        <td>
                                            <input type='text' name='keterangan[".$val->kode_obat."]' class='form-control' readonly value='".$val->keterangan."'>
                                        </td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                </div>  
                <!-- <div class="form-group">
                    <div class="col-md-7"></div>
                    <div class="col-md-5 pull-right">
                        <?php echo $this->pagination->create_links();?>
                    </div>
                </div> -->
            </div>
        <?php else: ?>
            <?php echo form_open("stok_opname/simpanitem_so/".$kode,array("id"=>"formsimpan2","class"=>"form-horizontal"));?>
            <div class="box box-info">
                <div class="box-header">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="smpn btn btn-primary" type="button"> Simpan</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Jenis Obat</label>
                        <div class="col-md-4">
                            <select class="form-control" name="jenis_obat">
                                <option value="">----</option>
                                <?php
                                    foreach ($jo->result() as $val) {
                                        echo "
                                            <option value='".$val->kode_jenis."'  ".($jenis==$val->kode_jenis ? "selected" : "").">".$val->nama_jenis."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Search</label>
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control" value="<?php echo $search ?>">
                        </div>
                        <div class="col-md-1">
                           <button class="cari btn btn-success" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th width="50px">No</th>
                            <th width="100px" class="text-center">Kode Obat</th>
                            <th width="300px">Nama Obat</th>
                            <th width="150px" class="text-center">Stok Awal</th>
                            <th width="100px" class="text-center">Pemasukan</th>
                            <th width="100px" class="text-center">Pengeluaran</th>
                            <th width="100px" class="text-center">Stok Opname</th>
                            <th width="150px" class="text-center">Stok Real</th>
                            <th width="100px" class="text-center">Satuan Kecil</th>
                            <th width="200px" class="text-center">Jumlah</th>
                            <th width="300px" class="text-center">Keterangan</th>
                        </tr>
                        <?php 
                            $i = 0;
                            foreach ($o->result() as $value) {
                                $c_awal         = (isset($cekstok_awal[$value->kode]) ? $cekstok_awal[$value->kode] : 0);
                                $sawal          = (isset($s_awal[$value->kode]) ? $s_awal[$value->kode] : $c_awal);

                                $s_pemasukan    = (isset($stok_pemasukan[$value->kode]) ? $stok_pemasukan[$value->kode] : 0);
                                $s_pemakaian    = (isset($stok_pengeluaran[$value->kode]) ? $stok_pengeluaran[$value->kode] : 0);

                                if ($s_pemakaian==0.10) {
                                    $s_pemakaian = 1;
                                }else{
                                    $s_pemakaian = $s_pemakaian;
                                }
                                $stokopname     = ($sawal+$s_pemasukan-$s_pemakaian);
                                $jumlah         = $stokopname*$value->net_apt2;

                                // if ($sawal>0 || $s_pemasukan>0 || $s_pemakaian>0) {
                                    $i++;
                                   echo "
                                    <tr>
                                        <td>".$i."</td>
                                        <td>".$value->kode."</td>
                                        <td>".$value->nama."</td>
                                        <td>
                                            <input type='text' name='stok_awal[".$value->kode."]' class='form-control' value='".$sawal."' readonly>
                                            <input type='hidden' name='kode_obat[]' class='form-control' value='".$value->kode."' readonly>
                                            <input type='hidden' name='pak2[".$value->kode."]' class='form-control' value='".$value->pak2."'>
                                        </td>
                                        <td>
                                            <input type='text' name='stok_pemasukan[".$value->kode."]' class='form-control' readonly value='".number_format($s_pemasukan,0)."'>
                                        </td>
                                        <td>
                                            <input type='text' name='stok_pemakaian[".$value->kode."]' class='form-control' readonly value='".number_format($s_pemakaian,0)."'>
                                        </td>
                                        <td>
                                            <input type='text' name='stok_so[".$value->kode."]' class='form-control' readonly value='".$stokopname."'>
                                        </td>
                                        <td>
                                            <input type='text' name='stok_real[".$value->kode."]' class='form-control' value='".$stokopname."'>
                                        </td>
                                        <td>
                                            <input type='text' name='satuan_kecil[".$value->kode."]' class='form-control' readonly value='".$value->pak2."'>
                                        </td>
                                        <td>
                                            <input type='text' name='jumlah[".$value->kode."]' class='form-control' readonly value='".number_format($jumlah,0,',','.')."'>
                                        </td>
                                        <td>
                                            <input type='text' name='keterangan[".$value->kode."]' class='form-control'>
                                            <input type='hidden' name='harga[".$value->kode."]' class='form-control' readonly value='".$value->net_apt2."'>
                                        </td>
                                    </tr>
                                ";
                                // }
                            }
                        ?>
                    </table>
                </div>
            </div>   
            <!-- <div class="form-group">
                <div class="col-md-7"></div>
                <div class="col-md-5 pull-right">
                    <?php echo $this->pagination->create_links();?>
                </div>
            </div> -->
            <?php echo form_close(); ?>         
        <?php endif ?>
    <?php endif ?>
</div>
