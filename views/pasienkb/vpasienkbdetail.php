<?php
	if ($row){
		$id_pendaftaran=$row->id_pendaftaran;
		$id_puskesmas=$row->id_puskesmas;
		$nama_pasien=$row->nama_pasien;
		$no_kk=$row->no_kk;
		$no_pasien=$row->no_pasien;
		$tanggal_periksa=$row->tanggal_periksa;
		$nama_paramedis=$row->nama_paramedis;
		$nama_puskesmas=$row->nama_puskesmas;
		$id_layanan=$row->id_layanan;
		$umur=$row->umur;
		$no_kode_klinik_k3=$row->no_kode_klinik_k3; 
		$no_seri_kartu=$row->no_seri_kartu;
		$id_status_pesertaKB=$row->id_status_pesertaKB;
		$cara_kb_terakhir=$row->cara_kb_terakhir;
		$jumlah_anak_hidup=$row->jumlah_anak_hidup;
		$jumlah_anak_unhidup=$row->jumlah_anak_unhidup;
		$keadaan_umum=$row->keadaan_umum;
		$tekanan_darah=$row->tekanan_darah;
		$status_kehamilan=$row->status_kehamilan;
		$tgl_haid_terakhir=date('d-m-Y',strtotime($row->tgl_haid_terakhir));
		$berat_badan=$row->berat_badan;
		$status_sakit_kuning=$row->status_sakit_kuning;
		$status_pendarahan=$row->status_pendarahan;
		$status_tumor_payudara=$row->status_tumor_payudara;
		$status_tumor_rahim=$row->status_tumor_rahim;
		$status_tumor_indung=$row->status_tumor_indung;
		$posisi_rahim=$row->posisi_rahim;
		$status_tanda_radang=$row->status_tanda_radang;
		$status_tumor_ganas=$row->status_tumor_ganas;
		$status_diabetes=$row->status_diabetes;
		$status_beku_darah=$row->status_beku_darah;
		$status_orchitis=$row->status_orchitis;
		$alat_kontr_ok=$row->alat_kontr_ok;
		$alat_kontr_ok2=$row->alat_kontr_ok2;
		$tgl_dilayani=date('d-m-Y',strtotime($row->tgl_dilayani));
		$tgl_pesan_kembali=date('d-m-Y',strtotime($row->tgl_pesan_kembali));
		$tgl_dilepas=date('d-m-Y',strtotime($row->tgl_dilepas));
		$pemeriksa=$row->pemeriksa;
		$id_pasien_kb = $row->id_pasien_kb;
		$id_tindakan = $row->id_tindakan;
		$nama_tindakan = $row->nama_tindakan;
		$action = "edit";
	} else {
		$no_seri_kartu=$p->id_card;
		$id_puskesmas=
		$nama_pasien=
		$no_kk=
		$no_pasien=
		$tanggal_periksa=
		$nama_paramedis=
		$nama_puskesmas=
		$id_layanan=
		$umur=
		$no_kode_klinik_k3="";
		$no_seri_kartu=$p->id_card;
		$id_status_pesertaKB=
		$cara_kb_terakhir=
		$jumlah_anak_hidup=
		$jumlah_anak_unhidup=
		$keadaan_umum=
		$tekanan_darah=
		$status_kehamilan=
		$tgl_haid_terakhir=
		$berat_badan=
		$status_sakit_kuning=
		$status_pendarahan=
		$status_tumor_payudara=
		$status_tumor_rahim=
		$status_tumor_indung=
		$posisi_rahim=
		$status_tanda_radang=
		$status_tumor_ganas=
		$status_diabetes=
		$status_beku_darah=
		$status_orchitis=
		$alat_kontr_ok=
		$alat_kontr_ok2=
		$tgl_dilayani=
		$tgl_pesan_kembali=
		$tgl_dilepas=
		$id_tindakan=
		$nama_tindakan=
		$pemeriksa="";
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
    function pad2(number) {
    	return (number < 10 ? '0' : '') + number
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
		$("input[name='tgl_dilayani']").datepicker({
            dateFormat : formattgl
        });
        $("input[name='tgl_pesan_kembali']").datepicker({
            dateFormat : formattgl
        });
        $("input[name='tgl_dilepas']").datepicker({
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
			window.location = "<?php echo site_url('pasienkb/hapuspasienlab');?>/"+id;
		});
		$("input[name='tgl_haid_terakhir']").change(function(){
			$(".taksir_persalinan").click();
		})
		$(".taksir_persalinan").click(function(){
			var t = $("input[name='tgl_haid_terakhir']").val();
			var tgl = t.split("-");
			var bln = parseInt(tgl[1]);
			var hari = parseInt(tgl[0]);
			var thn = parseInt(tgl[2]);
			if (bln>=4){
				thn += 1;
				hari += 7;
				bln -= 3;
			} else {
				hari += 7;
				bln += 9;
			}
			var jml_hari = daysInMonth(bln,thn);
			if (jml_hari<hari) {
				hari -= jml_hari;
				bln += 1;
			}
			tgl_taksir = pad2(hari)+"-"+pad2(bln)+"-"+thn;
			$("input[name='tgl_taksiran_persalinan']").val(tgl_taksir);
			return false;
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
		$("input[name='nama_tindakan']").click(function(){
			$(this).select();
		});
    });
function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}
</script>
<div class="col-xs-12">
	<?php echo $this->session->flashdata('message');?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="col-xs-2 control-label col-xs-3">Asal Puskesmas</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' class='form-control' disabled value="<?php echo $p->nama_puskesmas;?>"></div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label col-xs-3">No. Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' class='form-control' disabled value="<?php echo $p->no_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label col-xs-3">Nama Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' class='form-control' disabled value="<?php echo $p->nama_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label col-xs-3">Umur</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' class='form-control' disabled value="<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	echo form_open("pasienkb/simpankb/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
	echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
	echo "<input type=hidden name=id_pasien_kb value='".$id_pasien_kb."'>";
	?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-3">No. Seri Kartu</label>
						<div class="col-xs-9"><input type=text class='form-control' name='no_seri_kartu' value='<?php echo $no_seri_kartu;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Status Peserta KB</label>
					<div class="col-xs-9">
						<select class='form-control' name="id_status_pesertakb">
							<?php
								foreach ($q1->result() as $data) {
									echo "<option value='".$data->id_status_pesertaKB."' ".($data->id_status_pesertaKB=$id_status_pesertaKB ? "selected" : "").">".$data->nama_status."</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Cara KB terakhir</label>
					<div class="col-xs-9">
						<input type=text class='form-control' name='cara_kb_terakhir' class='input-left' value='<?php echo $cara_kb_terakhir;?>'>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Jumlah Anak Hidup</label>
					<div class="col-xs-9"><input type=text class='form-control' name='jumlah_anak_hidup' value='<?php echo $jumlah_anak_hidup;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Jumlah Anak Lahir Hidup Kemudian Meninggal</label>
					<div class="col-xs-9"><input type=text class='form-control' name='jumlah_anak_unhidup' value='<?php echo $jumlah_anak_unhidup;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Keadaan Umum</label>
					<div class="col-xs-9">
						<select class='form-control' name="keadaan_umum">
							<option value='baik' <?php if ($keadaan_umum=='baik') echo "selected";?>>Baik</option>
							<option value='sedang' <?php if ($keadaan_umum=='sedang') echo "selected";?>>Sedang</option>
							<option value='kurang' <?php if ($keadaan_umum=='kurang') echo "selected";?>>Kurang</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tekanan Darah</label>
					<div class="col-xs-9"><input type=text class='form-control' name='tekanan_darah' value='<?php echo $tekanan_darah;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Status Kehamilan</label>
					<div class="col-xs-9"><input type=text class='form-control' name='status_kehamilan' value='<?php echo $status_kehamilan;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tanggal Haid Terakhir</label>
					<div class="col-xs-9"><input type=text class='form-control' name='tgl_haid_terakhir' value='<?php echo $tgl_haid_terakhir;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Berat Badan</label>
					<div class="col-xs-9"><input type=text class='form-control' name='berat_badan' value='<?php echo $berat_badan;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Sakit Kuning</label>
					<div class="col-xs-9">
						<select class='form-control' name="status_sakit_kuning">
							<option value='T' <?php if ($status_sakit_kuning=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_sakit_kuning=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Pendarahan Pervaginam</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_pendarahan">
							<option value='T' <?php if ($status_pendarahan=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_pendarahan=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tumor Payudara</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_tumor_payudara">
							<option value='T' <?php if ($status_tumor_payudara=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_tumor_payudara=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tumor Rahim</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_tumor_rahim">
							<option value='T' <?php if ($status_tumor_rahim=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_tumor_rahim=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tumor Indung Telur</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_tumor_indung">
							<option value='T' <?php if ($status_tumor_indung=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_tumor_indung=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Posisi Rahim</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="posisi_rahim">
							<option value='retro' <?php if ($posisi_rahim=='retro') echo "selected";?>>Retro</option>
							<option value='antifleksi' <?php if ($posisi_rahim=='antifleksi') echo "selected";?>>Antifleksi</option>
							<option value='porsio' <?php if ($posisi_rahim=='porsio') echo "selected";?>>Porsio</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tandang Radang</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_tanda_radang">
							<option value='T' <?php if ($status_tanda_radang=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_tanda_radang=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tumor Ganas</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_tumor_ganas">
							<option value='T' <?php if ($status_tumor_ganas=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_tumor_ganas=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tanda-tanda Diabetes</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_diabetes">
							<option value='T' <?php if ($status_diabetes=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_diabetes=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Kelainan Pembekuan Darah</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_beku_darah">
							<option value='T' <?php if ($status_beku_darah=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_beku_darah=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Radang Orchitis/ Epididymitis</label>
        		    <div class="col-xs-9">
						<select class='form-control' name="status_orchitis">
							<option value='T' <?php if ($status_orchitis=='T') echo "selected";?>>Tidak</option>
							<option value='Y' <?php if ($status_orchitis=='Y') echo "selected";?>>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Alat Kontrasepsi yang diberikan ke-1</label>
					<div class="col-xs-9"><input type=text class='form-control' name='alat_kontr_ok' value='<?php echo $alat_kontr_ok;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Alat Kontrasepsi yang diberikan ke-2</label>
					<div class="col-xs-9"><input type=text class='form-control' name='alat_kontr_ok2' value='<?php echo $alat_kontr_ok2;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tanggal Dilayani</label>
					<div class="col-xs-9"><input type=text class='form-control' name='tgl_dilayani' value='<?php echo $tgl_dilayani;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tanggal Pesan Kembali</label>
					<div class="col-xs-9"><input type=text class='form-control' name='tgl_pesan_kembali' value='<?php echo $tgl_pesan_kembali;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tanggal Dilepas</label>
					<div class="col-xs-9"><input type=text class='form-control' name='tgl_dilepas' value='<?php echo $tgl_dilepas;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Tindakan</label>
					<div class="col-xs-9">
						<input type=hidden name='id_tindakan' class='id_tindakan' value='<?php echo $id_tindakan;?>'>
						<input type=text class='form-control' name='nama_tindakan' class='input-left nama_tindakan' autocomplete="off" value='<?php echo $nama_tindakan;?>'>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Pemeriksa</label>
					<div class="col-xs-9"><input type=text class='form-control' name='pemeriksa' value='<?php echo $pemeriksa;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">&nbsp;</label>
					<div class="col-xs-9">
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
			<table id="myTable" class="table table-bordered">
				<thead>
					<tr class=bg-navy>
   						<th width="20px" >No</th>
   						<th width=400>Labotarium</th>
   						<th>Keterangan</th>
   						<th width=100 class="text-center">Action</th>
 					</tr>
 				</thead>
 				<tbody>
 					<?php echo form_open("pasienkb/simpanpasienlab",array("id"=>"formsavelab","class"=>"form-horizontal")); ?>
 					<tr>
						<td>&nbsp;</td>
						<td>
							<input type=hidden name="id_pendaftaran" value='<?php echo $id_pendaftaran;?>'>
							<input type=hidden name="id_pasien_kb" value='<?php echo $id_pasien_kb;?>'>
							<input type=hidden name="id_layanan" value='5'>
							<input type=hidden name="id_lab" class="id_lab">
							<div class="input-group">
								<input type=text name="nama_lab" class="nama_lab form-control" autocomplete="off">
								<span class="input-group-btn"><button type='button' class='cari btn btn-info'><i class='fa fa-search'></i></button></span>
							</div>
						</td>
						<td><input type=text class='form-control' name=keterangan class="span12"></td>
						<td style="text-align:center"><button type="submit" name="Submit" class="btn btn-success btn-sm"><i class='fa fa-save'></i>&nbsp;Save</button></td>
					</tr>
					<?php 
						echo form_close();
						$i = 0;
						foreach ($q->result() as $row){
							$i++;
							echo "<tr id='data' class='pasienlab'>
							  <td class=text-center>".$i."</td>
							  <td>".$row->nama_lab."</td>
							  <td>".$row->keterangan."</td>
							  <td class='text-align:center'>
							  	<button type='button' class='hapus btn btn-danger btn-sm' value='".$id_pendaftaran."/".$id_pasien_kb."/".$row->id_pasien_lab."'>
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