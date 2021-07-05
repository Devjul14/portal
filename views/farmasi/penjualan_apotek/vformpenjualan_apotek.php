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
        $("#listdata table tr#data:first").addClass("seleksi");
        $("#listdata2 table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        $("select[name='dokter']").select2();
        $("select[name='poli_ruangan']").select2();
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        var formatperiode = "mm-yy";
        $("input[name='periode_pengajuan']").datepicker({
            dateFormat : formatperiode,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('penjualan_apotek')?>";
            return false;
        });
         $('.print').click(function(){
            var no_penjualan= $("[name='no_penjualan']").val();
            var url = "<?php echo site_url('penjualan_apotek/cetak_penjualan');?>/"+no_penjualan;
            openCenteredWindow(url);
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            window.location = "<?php echo site_url('penjualan_apotek/hapusitem_penjualan')?>/"+kode;
            return false;
        });
        $("[name='nama']").typeahead({

            source: function(query, process) {
                var depo = $("[name='depo']").val();
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>penjualan_apotek/getobat/"+depo,
                    method : "POST",
                    async: false,
                    data : {nama: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label+" | "+ object.satuan+" | "+object.stok);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var kode = n[0];
                $("input[name='kode']").val(kode);
                return n[1];
            }
        });
        $("[name='no_rm']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                if (query.length>=3){
                    var data = $.ajax({
                        url : "<?php echo base_url();?>penjualan_apotek/getpasien",
                        method : "POST",
                        async: false,
                        data : {no_rm: query}
                    }).responseText;
                    console.log(JSON.parse(data));
                    $.each(JSON.parse(data), function(i, object) {
                        map[object.no_rm] = object;
                        objects.push(object.no_rm+" | "+object.nama_pasien);   
                    });
                    process(objects);
                }
            },
            delay: 0,
            updater: function(item) {
                console.log(item);
                var n = item.split(" | ");
                $("[name='pembeli']").val(n[1]);
                    
                return n[0];
            }
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var no_penjualan = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,no_penjualan,kode);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,no_penjualan,kode);
                }
            });
        });
        // $('.dataChange2').click(function(evt) {
        //     evt.preventDefault();
        //     var dataText = $(this);
        //     var no_penjualan = dataText.attr('id');
        //     var kode = dataText.attr('kode');
        //     var dataContent = dataText.text().trim();
        //     var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
        //     dataInputField.select();
        //     dataText.before(dataInputField).hide();
        //     dataInputField.focus().blur(function(){
        //         var inputval = dataInputField.val();
        //         $(this).remove();
        //         changeData2(inputval,no_penjualan,kode);
        //     }).keyup(function(evt) {
        //         if (evt.keyCode == 13) {
        //             var inputval = dataInputField.val();
        //             $(this).remove();
        //             changeData2(inputval,no_penjualan,kode);
        //         }
        //     });
        // });
    });
    var changeData = function(value,no_penjualan,kode){
        $.ajax({
            url: "<?php echo site_url('penjualan_apotek/changeharga');?>", 
            type: 'POST', 
            data: {no_penjualan: no_penjualan,kode: kode, value: value}, 
            success: function(){
               location.reload();
            }
        });
    };
</script>
<?php
    if ($q1){
        $no_penjualan           = $q1->no_penjualan;
        $tanggal                = date("d-m-Y",strtotime($q1->tanggal));
        $keterangan             = $q1->keterangan;
        $status_penjualan       = $q1->status_penjualan;
        $depo                   = $q1->depo;
        $pembeli                = $q1->pembeli;
        $total                  = $q1->total;
        $dokter                 = $q1->dokter;
        $no_rm                  = $q1->no_rm;
        $poli_ruangan           = $q->poli_ruangan;
        $a                      = "disabled";
        $action                 = "edit";
    } else {
        $tanggal                = date("d-m-Y");
        $dokter                 = 
        $no_rm                  =
        $no_penjualan           = 
        $depo                   = 
        $pembeli                =
        $keterangan             = 
        $status_penjualan       = 
        $total                  =
        $poli_ruangan           =
        $a                      = "";
        $action                 = "simpan";
    }
    // echo $action;
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
        <?php echo form_open("penjualan_apotek/simpanpenjualan_apotek/".$action,array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Penjualan
                </label>
                <div class="col-md-2">
                   <input type="text" name="no_penjualan" value="<?php echo $no_penjualan ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Tanggal
                </label>
                <div class="col-md-2">
                    <input required type="text" name="tanggal" value="<?php echo $tanggal ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
                <label class="col-md-2">
                    No RM
                </label>
                <div class="col-md-2">
                    <input required type="text" name="no_rm" value="<?php echo $no_rm ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Nama Pembeli
                </label>
                <div class="col-md-2">
                    <input required type="text" name="pembeli" value="<?php echo $pembeli ?>" class='form-control' autocomplete='off' <?php echo $a ?>>
                </div>
                <label class="col-md-2">
                    Asal Pasien
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="poli_ruangan" required <?php echo $a ?>>
                        <option value="">---</option>
                        <?php
                            foreach ($poli->result() as $pol) {
                                echo "
                                    <option value='".$pol->kode."' ".($pol->kode==$poli_ruangan ? "selected" : "").">".$pol->keterangan."</option>
                                ";
                            }
                        ?>
                        <?php
                            foreach ($r->result() as $ruang) {
                                echo "
                                    <option value='".$ruang->kode_ruangan."' ".($ruang->kode_ruangan==$poli_ruangan ? "selected" : "").">RUANG ".$ruang->nama_ruangan."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    Dokter
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="dokter" required <?php echo $a ?>>
                        <option value="">---</option>
                        <?php
                            foreach ($dk->result() as $dkr) {
                                echo "
                                    <option value='".$dkr->id_dokter."' ".($dkr->id_dokter==$dokter ? "selected" : "").">".$dkr->nama_dokter."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Depo
                </label>
                <div class="col-md-2">
                    <select class="form-control" name="depo" required <?php echo $a ?>>
                        <option value="">---</option>
                        <?php
                            foreach ($d->result() as $dp) {
                                echo "
                                    <option value='".$dp->kode_depo."' ".($dp->kode_depo==$depo ? "selected" : "").">".$dp->nama_depo."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">
                    Keterangan
                </label>
                <div class="col-md-2">
                   <textarea class="form-control" name="keterangan" <?php echo $a ?>><?php echo $keterangan ?></textarea>
                </div>
                <label class="col-md-2">
                    Total
                </label>
                <div class="col-md-2">
                   <input required type="text" name="total" value="<?php echo $total ?>" class='form-control' autocomplete='off' readonly>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php if ($status_penjualan=="1"): ?>
                <div class="btn-group pull-right">
                    <button class="back btn btn-success" type="button"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                </div>
            <?php else: ?>
                <div class="btn-group pull-right">
                    <button class="save btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                    <button class="back btn btn-success"><i class="fa fa-arrow-left">&nbsp;&nbsp;</i>Back</button>
                </div>
            <?php endif ?>
        </div>
        <?php echo form_close(); ?>
    </div>
    <?php if ($q1): ?>
        <div class="box box-info">
            <?php echo form_open("penjualan_apotek/simpanitem_penjualan",array("id"=>"formsimpan","class"=>"form-horizontal"));?>
            <input type="hidden" name="no_penjualan" value="<?php echo $no_penjualan; ?>">
            <div class="box-body">
                <?php if ($status_penjualan=="1"): ?>
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Obat</th>
                            <th width="50px" class="text-center">Jumlah</th>
                            <th width="100px" class="text-center">Harga</th>
                            <th width="100px" class="text-center">Total1</th>
                        </tr>
                        <?php
                            foreach ($q->result() as $value) {
                                echo "
                                    <tr>
                                        <td>".$value->nama."</td>
                                        <td>".$value->qty."</td>
                                        <td>Rp. ".number_format($value->harga,0,',','.')."</td>
                                        <td>Rp. ".number_format($value->qty*$value->harga,0,',','.')."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                <?php else: ?>
                    <table class="table table-striped table-bordered" id="data">
                        <tr class="bg-navy">
                            <th>Nama Obat</th>
                            <th width="50px" class="text-center">Jumlah</th>
                            <th width="100px" class="text-center">Harga</th>
                            <th width="100px" class="text-center">Total</th>
                            <th width="100px" class="text-center">Aturan Pakai</th>
                            <th width="100px" class="text-center">Waktu</th>
                            <th width="100px" class="text-center">Takaran</th>
                            <th width="100px" class="text-center">Pagi</th>
                            <th width="100px" class="text-center">Siang</th>
                            <th width="100px" class="text-center">Sore</th>
                            <th width="100px" class="text-center">Malem</th>
                            <th width="100px" class="text-center">Waktu Lainnya</th>
                            <th width="100px" class="text-center">#</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" class="form-control" name="kode" >
                                <input type="text" name="nama" class="form-control"  autocomplete='off' required></td>
                            <td width="100px">
                                <input type="number" name="qty" class="form-control" autocomplete="off" required>
                            </td>
                            <td width="50px">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i>
                                </button>
                            </td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                            <td width="100px">&nbsp;</td>
                        </tr>
            <?php echo form_close(); ?>
            			<?php echo form_open("penjualan_apotek/simpanaturan",array("id"=>"formsimpan","class"=>"form-horizontal"));?>
                        <?php
                            echo "
                            	<input type='hidden' name='no_penjualan' class='form-control' value='".$no_penjualan."'>
                            ";
                            $j =0;
                            foreach ($q->result() as $value) {
                                $j += $value->qty*$value->harga;
                            	echo "
                            		<input type='hidden' name='kode_obat' class='form-control' value='".$value->kode_obat."'>
                            	";
                                echo "
                                    <tr>
                                        <td>".$value->nama."</td>
                                        <td>".$value->qty."</td>
                                        <td>
                                            <a href='#' class='hrg dataChange' kode='".$value->kode_obat."' id='".$value->no_penjualan."'>".number_format($value->harga,0,',','.')."</a>
                                        </td>
                                        <td>Rp. ".number_format($value->qty*$value->harga,0,',','.')."</td>
                                        <td>
                                        ";
                                        echo "
                                        	<select class='form-control' name='aturan_pakai[".$value->kode_obat."]'>";
	                                        	foreach ($ap->result() as $apakai) {
	                                        		echo "<option value='".$apakai->kode."' ".($apakai->kode==$value->aturan_pakai ? "selected" : "").">".$apakai->nama."</option>";
	                                        	}
	                                    echo "</select>";
                                     	echo "</td>";
                                     	echo "
                                        <td>
                                        ";
                                        echo "
                                        	<select class='form-control' name='waktu[".$value->kode_obat."]'>";
	                                        	foreach ($w->result() as $wk) {
	                                        		echo "<option value='".$wk->kode."' ".($wk->kode==$value->waktu ? "selected" : "").">".$wk->nama."</option>";
	                                        	}
	                                    echo "</select>";
                                     	echo "</td>";
                                     	echo "
                                        <td>
                                        ";
                                        echo "
                                        	<select class='form-control' name='takaran[".$value->kode_obat."]'>";
	                                        	foreach ($t->result() as $tak) {
	                                        		echo "<option value='".$tak->kode."' ".($tak->kode==$value->takran ? "selected" : "").">".$tak->nama."</option>";
	                                        	}
	                                    echo "</select>";
                                     	echo "</td>";
                                     	echo "
                                        <td><input type='text' class='form-control' name='pagi[".$value->kode_obat."]' value='".$value->pagi."'></td>
                                        <td><input type='text' class='form-control' name='siang[".$value->kode_obat."]' value='".$value->siang."'></td>
                                        <td><input type='text' class='form-control' name='sore[".$value->kode_obat."]' value='".$value->sore."'></td>
                                        <td><input type='text' class='form-control' name='malem[".$value->kode_obat."]' value='".$value->malem."'></td>
                                        <td>";
                                        echo "
                                        	<select class='form-control' name='waktu_lainnya[".$value->kode_obat."]'>";
	                                        	foreach ($wl->result() as $wkl) {
	                                        		echo "<option value='".$wkl->kode."' ".($wkl->kode==$value->waktu_lainnya ? "selected" : "").">".$wkl->nama."</option>";
	                                        	}
	                                    echo "</select>";
                                     	echo "</td>";
                                     	echo "

                                        <td class='text-center'><button class='hapus btn btn-danger' href='".$value->no_penjualan."/".$value->kode_obat."'><i class='fa fa-trash'></></button</td>
                                    </tr>
                                ";
                            }
                        ?>
                        <input type="hidden" name="total" class="form-control" value="<?php echo $j ?>">
                        <tr>
                        	<td colspan="12">
                        		<button class="btn btn-primary"> Simpan</button>
                        	</td>
                        	<td>
                        		<button type="button" class="print btn btn-success"> Cetak</button>
                        	</td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>
</div>
