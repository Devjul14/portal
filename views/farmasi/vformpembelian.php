	<?php
    if ($row){
        $kode = $row->kode;
        $tanggal= $row->tanggal;
		$lunas= $row->lunas;
		$keterangan= $row->keterangan;
		$kode_kas= $row->kode_kas;
        $supplier= $row->nama_supplier;
        $ksupplier= $row->ksupplier;
		$harga_beli= $row->hrg_beli;
		$harga_jual= $row->hrg_jual;
		$data = $q->row();
        $disc_nominal = $data->jumlah_disc;
        $total = $data->jumlah_bayar;
        $disc_persen = round($disc_nominal/($disc_nominal+$total),2)*100;
        // $disabled = "disabled";
        $disabled = "";
        $disabled_print = "";
        // $tgl_pembayaran = "Tanggal pembayaran -> ".date("d-m-Y",strtotime($data->tanggal));
        $tgl_pembayaran = "";
		// $tombol = 
		$readonly="readonly";
        $action = "edit";
    } else {
        $kode =
        $tanggal =
        $lunas =
        $kode_kas =
        $supplier=
        $ksupplier=
        $keterangan =
        $harga_jual =
		$harga_beli = "";
		$disc_nominal = $total = $disc_persen = 0;
        $disabled = $tgl_pembayaran = "";
        $disabled_print = "disabled";
		// $tombol = "<button class='simpan btn btn-primary btn-sm'><i class='fa fa-shopping-cart'></i>&nbsp;Payment<span class='label label-danger' style='position:absolute;margin:-10px 0px 0px -20px'>F8</span></button>
  //                  <button class='hapus btn btn-danger btn-sm'><i class='fa fa-minus'></i>&nbsp;Remove<span class='label label-danger' style='position:absolute;margin:-10px 0px 0px -20px'>F9</span></button>";
        $readonly = "";
        $action = "simpan";
    }
    ?>

<script>
	 $(document).keyup(function(e){
        if (e.ctrlKey && e.which == 81){
            var dataText = $(".bg-gray a.qty");
            var kode = dataText.attr('kode');
            var obat = dataText.attr('obat');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                changeData(inputval,kode,obat);
                $(this).remove();
                dateText.show();
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    changeData(inputval,kode,obat);
                    $(this).remove();
                    dateText.show();
                }
            });
        } else 
        if (e.which == 40 || e.which == 50){
            var height = $("tr#data").height();
            var heightTR = $("table#myTable tr").height();
            var isi = Math.round(height/heightTR);
            var current = parseInt($("table#myTable tr.bg-gray").attr("title"));
            var i = parseInt(current/isi);
            if (current>=$("table#myTable tr").size()) current = $("table#myTable tr").size()-1;
            $("table tr#data").removeClass("bg-gray");
            $("table tr#data").eq(current++).addClass("bg-gray");
            if (current>=(i*isi)){
                $("tbody").scrollTop(i*height);
            }
            $("tbody").scrollTop();
            return false;
        } else 
        if (e.which == 38 || e.which == 56){
            var height = $("tr#data").height();
            var heightTR = $("table#myTable tr").height();
            var isi = Math.round(height/heightTR);
            var current = parseInt($("table#myTable tr.bg-gray").attr("title"));
            var cur = current-2;
            if (cur<0) cur = 0;
            var i = parseInt(cur/isi);
            $("table tr#data").removeClass("bg-gray");
            $("table tr#data").eq(cur).addClass("bg-gray");
            if (current>=(i*isi)){
                $("tr#data").scrollTop(i*height);
            }
            $("tr#data").scrollTop();
        }
    });
    $(document).ready(function(){
        $(".keluar").click(function(){
            window.location = "<?php echo site_url('farmasi/pembelian');?>";
            return false;
        });
        var formattgl = "yyyy-mm-dd";
        $(".obat").select2();
        $("[name='disc_persen']").keyup(function(evt){
            var subtotal = parseInt($("[name='subtotal']").val().replace(/\D/g,''));
            var disc_persen = parseFloat($(this).val());
            disc_nominal = number_format(disc_persen*subtotal/100,0,',','.');
            $("[name='disc_nominal']").val(disc_nominal);
            gettotal();
            return false;
        });
        $("[name='disc_nominal']").keyup(function(evt){
            if ($(this).val()=="") $("[name='disc_persen']").val("0");
            else {
                var subtotal = parseInt($("[name='subtotal']").val().replace(/\D/g,''));
                var disc_nominal = parseInt($(this).val().replace(/\D/g,''));
                disc_persen = (disc_nominal/subtotal)*100;
                $("[name='disc_persen']").val(disc_persen.toFixed(2));
            }
            gettotal();
            return false;
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('kode');
            var obat = dataText.attr('obat');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,kode,obat);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,kode,obat);
                }
            });
        });
        
    });
    function gettotal(){
        var subtotal = $("[name='subtotal']").val().replace(/\D/g,'');
        var disc_nominal = $("[name='disc_nominal']").val().replace(/\D/g,'');
        var total = subtotal-disc_nominal;
        $("[name='total']").val(number_format(total,0,',','.'));
    }
    var changeData = function(value,id,obat){
        $.ajax({
            url: "<?php echo site_url('farmasi/changedata');?>", 
            type: 'POST', 
            data: {id: id,obat: obat, value: value}, 
            success: function(){
               location.reload();
            }
        });
    };
    function number_format (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
<?php
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
	<div class="col-xs-12">
		<div class="box box-primary">
			<?php echo form_open('farmasi/simpanpembelian/'.$action,array("id"=>"formsubmit"));?>
			<div class="box-body">
				<div class="form-horizontal">
				<div class="col-xs-8">
			        <div class="form-group">
		            	<label class="col-md-1 control-label">no</label>
		            	<div class="col-md-4">
		            		<input type="text" name="kode" class="form-control" value="<?php echo $kode; ?>">
		                </div>
		                <label class="col-md-2 control-label">Tunai / Kredit</label>
		            	<div class="col-md-5">
		            		<input type="text" name="lunas" class="form-control" value="<?php echo $lunas; ?>">
		                </div>
		            </div>
		            <!-- <div class="form-group">
		            	<label class="col-md-2 control-label">Satuan Besar</label>
		            	<div class="col-md-4">
		            		<select name='satuan' class="form-control" >
									<?php
										foreach ($q2->result() as $data){
											echo "<option value='".$data->satuan_besar."' ".(($satuan == $data->satuan_besar) ? "selected" : "").">".$data->satuan_besar."</option>";
										}
									?>
								</select>
		                </div>
		                <label class="col-md-2 control-label">Satuan Kecil</label>
		            	<div class="col-md-4">
		            		<select name='satuan' class="form-control" >
									<?php
										foreach ($q1->result() as $data){
											echo "<option value='".$data->satuan."' ".(($satuan == $data->satuan) ? "selected" : "").">".$data->satuan."</option>";
										}
									?>
								</select>
		                </div>
		            </div> -->
		            <div class="form-group">
		            	<label class="col-md-1 control-label">Tanggal</label>
		            	<div class="col-md-4">
		            		<input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
		                </div>
		                <label class="col-md-2 control-label">Supplier</label>
		            	<div class="col-md-1">
		            		<input type="text" name="ksupplier" class="form-control" value="<?php echo $ksupplier; ?>">
		                </div>
		            	<div class="col-md-4">
		            		<input type="text" name="supplier" class="form-control" value="<?php echo $supplier; ?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-md-1 control-label">Ket</label>
		            	<div class="col-md-4">
		            		<input type="text" name="keterangan" class="form-control" value="<?php echo $keterangan; ?>">
		                </div>
		            	<label class="col-md-2 control-label">Kode Kas</label>
		            	<div class="col-md-5">
		            		<input type="text" name="kode_kas" class="form-control" value="<?php echo $kode_kas; ?>">
		                </div>
		            </div>
		        </div>
		         <div class="col-xs-4">
		            <div class="form-group">
			            <div class="col-md-12">
	                        <div class="alert alert-success total pull-right col-md-12"><h5><b>TOTAL<span class="grandtotal pull-right">0</span></b></h5></div>
	                        
	                    </div>
                	</div>
                </div>
	            </div>
			</div>
			<div class="box-footer">
				<div class="pull-right">
					<div class="btn-group pull-right">
	                        	<button class='simpan btn btn-primary btn'><i class='fa fa-shopping-cart'></i>&nbsp;Payment<span class='label label-danger' style='position:absolute;margin:-10px 0px 0px -20px'>F8</span></button>

                   				<button class='hapus btn btn-danger btn'><i class='fa fa-minus'></i>&nbsp;Remove<span class='label label-danger' style='position:absolute;margin:-10px 0px 0px -20px'>F9</span></button>
	                        	<?php
	                        		// echo $tombol;
									echo "<button class='keluar btn btn-warning btn'><i class='fa fa-undo'></i></button>";
								?>
							</div>
	            </div>
			</div>
			<?php echo form_close();?>
		</div>
	<div>
	<div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class="bg-navy">
                        <th width="10" class='text-center'>No</th>
                        <th class="text-center">Nama Obat</th>
                        <th width=80 class="text-center">Qty</th>
                        <th width=100 class="text-center">Satuan</th>
                        <th width="150" class='text-center'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1; $n = 1;
                        $subtotal = 0;
                        foreach($j->result() as $data){
                            $subtotal += $data->jumlah;
                            echo "<tr id='data' title='".($n++)."'>";
                            echo "<td>".($i++)."</td>";
                            echo "<td>".$data->nama_obat."<div class='pull-right'><button id='".$data->id."' class='hapus btn btn-sm btn-danger'><i class='fa fa-minus'></i></div></td>";
                            echo "<td class='text-right'><a href='#' class='qty dataChange' obat='".$data->kode_obat."' id='".$data->id."'>".$data->qty."</a></td>";
                            echo "<td class='text-center'>".$data->satuan."</td>";
                            echo "<td class='text-right'>".number_format($data->jumlah,0,'.','.')."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr><th colspan="4" style="vertical-align: middle" ><span class="pull-right">Subtotal</span></th><th style="vertical-align: middle" ><input type="text" readonly name="subtotal" class="form-control text-right" value="<?php echo number_format($subtotal,0,',','.');?>"></th></tr>
                    <tr>
                        <th colspan="4" style="vertical-align: middle" ><span class="pull-right">Disc</span></th>
                        <th width="250px" style="vertical-align: middle" >
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="text" name="disc_persen" class="form-control text-right" value="<?php echo $disc_persen;?>">
                                </div>
                                <div class="col-sm-7">  
                                    <input type="text" name="disc_nominal" class="form-control text-right" value="<?php echo number_format($disc_nominal,0,',','.');?>">
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr><th colspan="4" style="vertical-align: middle" ><?php echo $tgl_pembayaran;?><span class="pull-right">Total</span></th><th style="vertical-align: middle" ><input type="text" readonly name="total" class="form-control text-right" value="<?php echo number_format($total,0,',','.');?>"></th></tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="col-md-9">
                <?php echo form_open("farmasi/addobat",array("id"=>"formsave","class"=>"form-horizontal"));?>
                <input type="text" name='kode' readonly value="<?php echo $kode;?>"/>
                <div class="form-group">
                    <div class="col-md-11">
                        <select class="form-control obat" name="obat[]" <?php echo $disabled;?> multiple="multiple">
                            <?php 
                                foreach ($t->result() as $key) {
                                    echo '<option value="'.$key->kode.'">'.$key->nama.'&nbsp;&nbsp;|&nbsp;&nbsp;'.$key->stsisa.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1"><button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></div>
                </div>
                <?php echo form_close();?>
            </div>
            <div class="col-md-3">
                <div class="pull-right">
<!--                     <div class="btn-group">
                        <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                        <button class="lunas btn btn-success" type="button" <?php echo $disabled;?>> Simpan</button>
                        <button class="print btn btn-info" type="button" <?php echo $disabled_print;?>><i class="fa fa-print"></i> Print</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>