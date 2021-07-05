<?php
	if ($row){
		$id_bumil=$row->id_bumil;
		$id_pendaftaran=$row->id_pendaftaran;
		$id_puskesmas=$row->id_puskesmas;
		$nama_pasien=$row->nama_pasien;
		$no_kk=$row->no_kk;
		$nama_kk=$row->no_kk;
		$no_pasien=$row->no_pasien;
		$tanggal_periksa=$row->tanggal_periksa;
		$nama_paramedis= $row->nama_paramedis;
		$nama_puskesmas= $row->nama_puskesmas;
		$id_layanan= $row->id_layanan;
		$id_pasien=$row->id_pendaftaran;
		$tinggi_badan= $row->tinggi_badan;
		$lila= $row->lila;
		$tgl_haid_terakhir=date('d-m-Y',strtotime($row->tgl_haid_terakhir));
		$tgl_taksiran_persalinan=date('d-m-Y',strtotime($row->tgl_taksiran_persalinan));
		$keluhan_utama= $row->keluhan_utama;
		$jml_anak_rencana= $row->jml_anak_rencana;
		$datang_atas_petunjuk= $row->datang_atas_petunjuk;
		$perlakuan_kasar_suami= $row->perlakuan_kasar_suami;
		$keluhan_keputihan= $row->keluhan_keputihan;
		$gravida= $row->gravida;
		$jml_anak_hidup= $row->jml_anak_hidup;
		$jarak_persalinan_akhir= $row->jarak_persalinan_akhir;
		$penolong_persalinan_akhir= $row->penolong_persalinan_akhir;
		$cara_persalinan_akhir= $row->cara_persalinan_akhir;
		$placenta_lahir= $row->placenta_lahir;
		$penggunaan_kntrs_akhir= $row->penggunaan_kntrs_akhir;
		$partus= $row->partus;
		$abortus= $row->abortus;
		$jml_lahir_mati= $row->jml_lahir_mati;
		$ket_rujukan= $row->ket_rujukan;
		$rujukan= $row->rujukan;
		$action = "edit";
	} else {
		$id_puskesmas=
		$nama_pasien=
		$no_kk=
		$nama_kk=
		$no_pasien=
		$tanggal_periksa=
		$nama_paramedis= 
		$nama_puskesmas= 
		$id_layanan= 
		$id_pasien=
		$tinggi_badan= 
		$lila= 
		$tgl_haid_terakhir=
		$tgl_taksiran_persalinan=
		$keluhan_utama= 
		$jml_anak_rencana= 
		$datang_atas_petunjuk= 
		$perlakuan_kasar_suami= 
		$keluhan_keputihan= 
		$gravida= 
		$jml_anak_hidup= 
		$jarak_persalinan_akhir= 
		$penolong_persalinan_akhir= 
		$cara_persalinan_akhir= 
		$placenta_lahir= 
		$penggunaan_kntrs_akhir= 
		$partus=
		$abortus= 
		$jml_lahir_mati= 
		$ket_rujukan= 
		$rujukan= "";
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
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
		$("input[name='tgl_taksiran_persalinan']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
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
			window.location = "<?php echo site_url('kia/hapuspasienlab');?>/"+id;
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
					<label class="col-xs-2 control-label">Asal Puskesmas</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' disabled value="<?php echo $p->nama_puskesmas;?>"></div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label">No. Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' disabled value="<?php echo $p->no_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label">Nama Pasien</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' disabled value="<?php echo $p->nama_pasien;?>"></div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label">Umur</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' disabled value="<?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>"></div>
				</div>
				<div class="form-group">
					<label class="col-xs-2 control-label">Daftar Pertama</label>
					<div class="col-xs-10"><input type=text class='form-control' class='form-control' disabled value="<?php echo date('d-m-Y',strtotime($q1->tanggal));?>"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	echo form_open("kia/simpanbumil/".$action,array("id"=>"formsave","class"=>"form-horizontal"));
	echo "<input type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
	echo "<input type=hidden name=id_bumil value='".$id_bumil."'>";
	?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="col-xs-2 control-label">Tinggi Badan</label>
					<div class="col-xs-4"><input type=text class='form-control' class='form-control' value="<?php echo $tinggi_badan;?>"></div>
					<label class="col-xs-2 control-label">LILA (cm)</label>
					<div class="col-xs-4"><input type=text class='form-control' name='lila' value='<?php echo $lila;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Tanggal Haid Terakhir</label>
					<div class="col-xs-10"><input type=text class='form-control' name='tgl_haid_terakhir' value='<?php echo $tgl_haid_terakhir;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Tanggal Penaksiran Persalinan</label>
					<div class="col-xs-10">
						<input type=text class='form-control' name='tgl_taksiran_persalinan' class='input-left' value='<?php echo $tgl_taksiran_persalinan;?>'>
						<button type='button' class='taksir_persalinan btn btn-right'><i class='icon-search'></i>&nbsp;</button>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Keluhan Utama</label>
					<div class="col-xs-10"><input type=text class='form-control' name='keluhan_utama' value='<?php echo $keluhan_utama;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Jumlah Anak Yang direncanakan</label>
					<div class="col-xs-10"><input type=text class='form-control' name='jml_anak_rencana' value='<?php echo $jml_anak_rencana;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Datang Atas Petunjuk</label>
					<div class="col-xs-10">
						<select name='datang_atas_petunjuk' class="form-control">
							<option value='Suami' <?php echo (($datang_atas_petunjuk == 'Suami') ? "selected" : "")?>>Suami</option>
							<option value='Kader' <?php echo (($datang_atas_petunjuk == 'Kader') ? "selected" : "")?>>Kader</option>
							<option value='Petugas' <?php echo (($datang_atas_petunjuk == 'Petugas') ? "selected" : "")?>>Petugas</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Adakah Perlakuan Kasar Suami</label>
					<div class="col-xs-10">
						<select name='perlakuan_kasar_suami' class="form-control">
							<option value='Tidak'>Tidak</option>
							<option value='Ada'>Ada</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Adakah Keluhan Keputihan</label>
					<div class="col-xs-10">
						<select name='keluhan_keputihan' class="form-control">
							<option value='Tidak'>Tidak</option>
							<option value='Ada'>Ada</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Kehamilan</label>
					<div class="col-xs-2"><input type=text class='form-control' name='gravida' value='<?php echo $gravida;?>'></div>
					<label class="control-label col-xs-1">Gravida</label>
					<div class="col-xs-2"><input type=text class='form-control' name='partus' value='<?php echo $partus;?>'></div>
					<label class="control-label col-xs-1">Partus</label>
					<div class="col-xs-2"><input type=text class='form-control' name='abortus' value='<?php echo $abortus;?>'></div>
					<label class="control-label col-xs-1">Abortus</label>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Jumlah Yang Hidup</label>
					<div class="col-xs-10"><input type=text class='form-control' name='jml_anak_hidup' value='<?php echo $jml_anak_hidup;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Jumlah Yang Meninggal</label>
					<div class="col-xs-10"><input type=text class='form-control' name='jml_lahir_mati' value='<?php echo $jml_lahir_mati;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Jarak Persalinan Terakhir</label>
					<div class="col-xs-10"><input type=text class='form-control' name='jarak_persalinan_akhir' value='<?php echo $jarak_persalinan_akhir;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Penolong persalinan terakhir</label>
					<div class="col-xs-10"><input type=text class='form-control' name='penolong_persalinan_akhir' value='<?php echo $penolong_persalinan_akhir;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Riwayat persalinan lalu</label>
					<div class="col-xs-10"><input type=text class='form-control' name='cara_persalinan_akhir' value='<?php echo $cara_persalinan_akhir;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Placenta lahir dengan</label>
					<div class="col-xs-10"><input type=text class='form-control' name='placenta_lahir' value='<?php echo $placenta_lahir;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Penggunaan kontrasepsi sebelum kelahiran ini</label>
					<div class="col-xs-10"><input type=text class='form-control' name='penggunaan_kntrs_akhir' value='<?php echo $penggunaan_kntrs_akhir;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Tempat Rujukan/ RSBM</label>
					<div class="col-xs-4">
						<select name='rujukan' class="form-control">
							<?php echo $this->Mpendaftaran->rujukan($rujukan);?>
						</select>
					</div>
					<div class="col-xs-6"><input type=text class='form-control' name='ket_rujukan' value='<?php echo $ket_rujukan;?>'></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Yang Merujuk</label>
					<div class="col-xs-10"><input type=text class='form-control' value='<?php echo $datang_atas_petunjuk;?>'></div>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<div class="btn-group">
				<?php
					echo anchor("kia/listbumil", "<i class='fa fa-arrow-left'></i>&nbsp;Back",array("class"=>"tambah btn btn-warning"));
					echo anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"save btn btn-primary"));
				?>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
	<div class="box box-primary">
		<div class="box-body">
			<table id="data colums" class="table table-bordered">
				<tr class="bg-navy">
   					<th width="20px">No</th>
   					<th width="400px">Labotarium</th>
   					<th>Keterangan</th>
   					<th width="100px">Action</th>
 				</tr>
 				<?php echo form_open("kia/simpanpasienlab",array("id"=>"formsavelab","class"=>"form-horizontal")); ?>
 				<tr>
 					<td>&nbsp;</td>
					<td>
						<input type=hidden name="id_pendaftaran" value='<?php echo $id_pendaftaran;?>'>
						<input type=hidden name="id_bumil" value='<?php echo $id_bumil;?>'>
						<input type=hidden name="id_lab">
						<div class="input-group">
							<input type=text class='form-control' name="nama_lab">
							<span class="input-group-btn"><button type='button' class='cari btn btn-info'><i class='fa fa-search'></i></button></span>
						</div>
					</td>
					<td><input type=text class='form-control' name=keterangan class="span12"></td>
					<td class="text-center"><button type="submit" name="Submit" class="btn btn-success"><i class='fa fa-save'></i>&nbsp;Save</button></td>
				</tr>
				<?php 
					echo form_close();
					$i = 0;
					foreach ($q->result() as $row){
						$i++;
						echo "<tr id='data' class='pasienlab'>
						  <td align=center>".$i."</td>
						  <td>".$row->nama_lab."</td>
						  <td>".$row->keterangan."</td>
						  <td style='text-align:center'>
						  	<button type='button' class='hapus btn btn-danger' value='".$id_pendaftaran."/".$id_bumil."/".$row->id_pasien_lab."'>
						  		<i class='icon-remove'></i>
						  	</button>
						  </td>
						  </tr>";
					}
				?>
			</table>
		</div>
	</div>
</div>