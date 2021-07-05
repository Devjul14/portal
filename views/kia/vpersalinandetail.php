<?php
	if ($row){
		$tgl_persalinan=date('d-m-Y',strtotime($row->tgl_persalinan));
		$waktu_jam=$row->waktu_jam;
		$usia_klinis=$row->usia_klinis;
		$usia_hpht=$row->usia_hpht;
		$action = "edit";
	} else {
		$tgl_persalinan= date('d-m-Y',strtotime($tglpersalinan));
		$waktu_jam=
		$usia_klinis=
		$usia_hpht= "";
		$action='simpan';
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
		$("input[name='tgl_persalinan']").datepicker({
            dateFormat : formattgl
        });
		$(".cari").click(function(){
			var url = "<?php echo site_url('kia/caritindakan');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".save").click(function(){
			$('#formsave').trigger("submit");
			return false;
		});
		$(".hapus").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapustindakan');?>/"+id;
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
    })
</script>
<style>
	td.noborder{
		border-top:0;
	}
</style>
<div class="col-xs-12">
	<?php echo $this->session->flashdata('message');?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-2">Asal Puskesmas</label>
    				<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $p->nama_puskesmas;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">No. Pasien</label>
    				<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $p->no_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Nama Pasien</label>
    				<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $p->nama_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Umur</label>
    				<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Daftar Pertama</label>
    				<div class="col-xs-10"><input type="text" class="form-control" readonly value="<?php echo date('d-m-Y',strtotime($q1->tanggal));?>"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
		echo form_open("kia/simpanpersalinan/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
		echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
		echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
	?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-2">Tanggal Persalinan</label>
					<div class="col-xs-10"><input type=text name='tgl_persalinan' value='<?php echo $tgl_persalinan;?>' class="form-control"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Waktu Persalinan</label>
					<div class="col-xs-10"><input type=text name='waktu_jam' value='<?php echo $waktu_jam;?>' class="form-control"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Usia Klinis</label>
					<div class="col-xs-10"><input type=text name='usia_klinis' value='<?php echo $usia_klinis;?>' class="form-control"></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Usia HPHT</label>
					<div class="col-xs-10"><input type=text name='usia_hpht' value='<?php echo $usia_hpht;?>' class="form-control"></div>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<div class="btn-group">
				<?php
					echo anchor("kia/persalinan", "<i class='fa fa-arrow-left'></i>&nbsp;Back",array("class"=>"tambah btn btn-warning"));
					echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"save btn btn-success"));
				?>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
	<div class="box box-primary">
		<div class="box-body">
			<table class="table table-bordered">
				<thead>
				<tr class="bg-navy">
					<th width=20>No</th>
					<th>Tindakan</th>
					<th>Keterangan</th>
					<th width=100>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
					echo form_open("kia/simpantindakan",array("id"=>"formsavetindakan","class"=>"form-horizontal"));
					echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
					echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";	
				?>
				<tr>
					<td>&nbsp;</td>
					<td width=400>
						<input type=hidden name=id_detail_bumil class="id_tindakan">
						<div class="input-group">
							<input type=text name=nama_detail_bumil class='nama_tindakan form-control' autocomplete="off">
							<span class="input-group-btn"><button type='button' class='cari btn btn-info'><i class='fa fa-search'></i></button></span>
						</div>
					<td><input type=text name=nilai_id_detail_bumil class="form-control"></td>
					<td><button type="submit" name="Submit" class="btn btn-success"><i class='fa fa-save'></i>&nbsp;Save</button></td>
				</tr>
				<?php 
					echo form_close();
					$i = 0;
					foreach ($q->result() as $row){
						$i++;
						echo "<tr id='data' class='pasienlab'>
						  <td align=center>".$i."</td>
						  <td>".$row->nama_tindakan."</td>
						  <td>".$row->nilai_id_detail_bumil."</td>
						  <td style='text-align:center'>
						  	<button type='button' class='hapus btn btn-danger btn-sm' value='".$id_pendaftaran."/".$id_bumil."/".$row->id_detail_bumil."'>
						  		<i class='fa fa-remove'></i>
						  	</button>
						  </td>
						  </tr>";
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>