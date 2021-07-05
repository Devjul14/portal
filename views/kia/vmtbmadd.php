<?php
	if ($row){
		$id_pendaftaran=$row->id_pendaftaran;
		$id_puskesmas=$row->id_puskesmas;
		$nama_pasien=$row->nama_pasien;
		$no_kk=$row->no_kk;
		$no_pasien=$row->no_pasien;
		$tgl_periksa=date('d-m-Y',strtotime($row->tgl_periksa));
		$nama_puskesmas=$row->nama_puskesmas;
		$id_layanan=$row->id_layanan;
		$ket_rujukan=$row->ket_rujukan;
		$rujukan=$row->rujukan;
		$tgl_lahir=$row->tgl_lahir;
		$berat_badan=$row->berat_badan;
		$suhu_tubuh=$row->suhu_tubuh;
		$action = "edit";
	} else {
		$id_puskesmas=
		$nama_pasien=
		$no_kk=
		$no_pasien=
		$nama_puskesmas=
		$id_layanan=
		$ket_rujukan=
		$rujukan=
		$tgl_lahir=
		$berat_badan=
		$suhu_tubuh="";
		$tgl_periksa=date('d-m-Y');
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
    $(document).ready(function(){
		$("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
		var formattgl = "dd-mm-yy";
        $("input[name='tgl_haid_terakhir']").datepicker({
            dateFormat : formattgl
        });
		$("input[name='tgl_taksiran_persalinan']").datepicker({
            dateFormat : formattgl
        });
        $(".save").click(function(){
        	$("#formsave").trigger("submit");
        	return false;
        });
        $(".cari").click(function(){
			var url = "<?php echo site_url('kia/carilab');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".hapus").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapusimunisasi');?>/"+id;
		});
		$(".bblr").click(function(){
			var id_pendaftaran = $("input[name='id_pendaftaran']").val();
			var id_bayi = $("input[name='id_bayi']").val();
			window.location = "<?php echo site_url('kia/bblradd');?>/"+id_pendaftaran+"/"+id_bayi;
		});
		$('input.nama_imunisasi').typeahead({
		    source: function(query, process) {
		        objects = [];
		        map = {};
		        var data = <?php echo json_encode($q_imunisasi); ?>// Or get your JSON dynamically and load it into this variable
		        $.each(data, function(i, object) {
		            map[object.label] = object;
		            objects.push(object.label);
		        });
		        process(objects);
		    },
		    updater: function(item) {
		        $("input.id_imunisasi").val(map[item].id);
		        return map[item].label;
		    }
		});
		$('input.nama_imunisasi').click(function(){
			$(this).select();
		});
    })
</script>
<div class="col-xs-12">
	<?php echo $this->session->flashdata('message');?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-3 col-xs-2">Asal Puskesmas</label>
					<div class="col-xs-10"><input type=text class='form-control' class="form-control" readonly value="<?php echo $p->nama_puskesmas;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3 col-xs-2">No. Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' class="form-control" readonly value="<?php echo $p->no_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3 col-xs-2">Nama Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' class="form-control" readonly value="<?php echo $p->nama_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3 col-xs-2">Umur</label>
					<div class="col-xs-10">
						<div class="input-group">
							<input type=text class='form-control' class="form-control" readonly value="<?php echo  $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>">
							<span class='input-group-addon'>tahun</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	echo form_open("kia/simpanmtbm/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
	echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
	echo "<input type=hidden name=id_bayi value='".$id_bayi."'>";
	?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-2">Umur</label>
					<div class="col-xs-10"><input type=text class="form-control" name='umur' value='<?php echo  $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Tanggal Periksa</label>
					<div class="col-xs-10"><input type=text class="form-control" name='tgl_periksa' value='<?php echo $tgl_periksa;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Berat Badan</label>
					<div class="col-xs-2">
						<div class="input-group">
							<input type=text name='berat_badan' class="form-control" class='input-left' value='<?php echo $berat_badan;?>'>
							<span class='input-group-addon'>Kg</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Suhu Tubuh</label>
					<div class="col-xs-10"><input type=text class="form-control" name='suhu_tubuh' value='<?php echo $suhu_tubuh;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Tempat Rujukan/ RSBM</label>
					<div class="col-xs-5">
						<select name='rujukan' class="form-control">
							<?php echo $this->Mpendaftaran->rujukan($rujukan);?>
						</select>
					</div>
					<div class="col-xs-5">
						<input type=text name='ket_rujukan' value='<?php echo $ket_rujukan;?>' class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">&nbsp;</label>
					<div class="col-xs-10">
						<div class="btn-group">
						<?php
							echo anchor("kia/listbumil", "<i class='fa fa-arrow-left'></i>&nbsp;Back",array("class"=>"tambah btn btn-warning"));
							echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"save btn btn-success"));
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
	<div class="box box-primary">
		<div class="box-body">
			<table class="table table-bordered">
				<tr class="bg-navy">
   					<th width="20px">No</th>
   					<th width="100px">Tanggal</th>
   					<th>Imunisasi</th>
   					<th width=100>Action</th>
 				</tr>
 				<?php echo form_open("kia/simpanimunisasi",array("id"=>"formsavelab","class"=>"form-horizontal")); ?>
 				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<input type=hidden name="id_pendaftaran" value='<?php echo $id_pendaftaran;?>'>
						<input type=hidden name="id_bayi" value='<?php echo $id_bayi;?>'>
						<input type=hidden name="id_imunisasi" class="id_imunisasi">
						<div class="input-group">
							<input type=text name="nama_imunisasi" class="form-control nama_imunisasi" autocomplete="off">
							<span class="input-group-btn"><button type='button' class='cari btn btn-info'><i class='fa fa-search'></i></button></span>
						</div>
					</td>
					<td class="text-align:center"><button type="submit" name="Submit" class="btn btn-success btn-sm"><i class='fa fa-save'></i>&nbsp;Save</button></td>
				</tr>
				<?php echo form_close();?>
				<?php
					$i = 0;
					foreach ($q->result() as $row){
						$i++;
						echo "<tr id='data' class='pasienlab'>
						  <td align=center>".$i."</td>
						  <td>".date('d-m-Y',strtotime($row->tanggal))."</td>
						  <td>".$row->nama_imunisasi."</td>
						  <td style='text-align:center'>
						  	<button type='button' class='hapus btn btn-danger' value='".$id_bayi."/".$id_pendaftaran."/".$row->id_imunisasi."'>
						  		<i class='icon-remove'></i>
						  	</button>
						  </td>
						  </tr>";
					}
				?>
			</table>
	</div>
</div>