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
		$(".tab-content").hide(); //Hide all content
		$("#tab-menu li a:first").addClass("active").show(); //Activate first tab
		$(".tab-content:first").show();
		$('#tab-menu li a').click(function() {
            $("#tab-menu li a").removeClass('active');
            $(this).addClass('active');
            $(".tab-content").hide();
            var activeTab = $(this).attr("href"); //Find the href attribute value to identify the active tab + content
            $(activeTab).show();
            return false;
		});
		var id = $(".bg-gray").attr("href");
		var id_pendaftaran = $("input[name='id_pendaftaran']").val();
		$(".detailanc").load("<?php echo site_url('kia/getanctgl')?>/"+id+"/"+id_pendaftaran+"/disabled");
		$("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $("tr#data").click(function(){
        	var id_pendaftaran = $("input[name='id_pendaftaran']").val();
        	var id = $(".bg-gray").attr("href");
			$(".detailanc").load("<?php echo site_url('kia/getanctgl')?>/"+id+"/"+id_pendaftaran+"/disabled");
        })
		var formattgl = "dd-mm-yy";
        $("input[name='tgl']").datepicker({
            dateFormat : formattgl
        });
        $("input[name='tgl_kunjungan']").datepicker({
            dateFormat : formattgl
        });
		$(".save").click(function(){
			$("#formsave").trigger("submit");
			return false;
		});
		$(".cariobat").click(function(){
			var url = "<?php echo site_url('umum/cariobat');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".cari").click(function(){
			var url = "<?php echo site_url('kia/caritindakan');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".hapusresep").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapusresep');?>/"+id;
		});
		$('[name="nama_obat"]').typeahead({
		    source: function(query, process) {
		        objects = [];
		        map = {};
		        var data = <?php echo json_encode($q_obat); ?>// Or get your JSON dynamically and load it into this variable
		        $.each(data, function(i, object) {
		            map[object.label] = object;
		            objects.push(object.label);
		        });
		        process(objects);
		    },
		    updater: function(item) {
		        $("[name='id_obat']").val(map[item].id);
		        return map[item].label;
		    }
		}); 
    })
</script>
<?php
if ($row){
		$id_bumil=$row->id_bumil;
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
		$umur=$row->umur;
		$tinggi_badan= $row->tinggi_badan;
		$lila= $row->lila;
		$tgl_haid_terakhir=$row->tgl_haid_terakhir;
		$tgl_taksiran_persalinan=$row->tgl_taksiran_persalinan;
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
		$umur=
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
	}
?>
<script>
function hitungSelisihHari(tgl1, tgl2){
	    // varibel miliday sebagai pembagi untuk menghasilkan hari
	    var miliday = 24 * 60 * 60 * 1000;
	    //buat object Date
	    var tanggal1 = new Date(tgl1);
	    var tanggal2 = new Date(tgl2);
	    // Date.parse akan menghasilkan nilai bernilai integer dalam bentuk milisecond
	    var tglPertama = Date.parse(tanggal1);
	    var tglKedua = Date.parse(tanggal2);
	    var selisih = (tglKedua - tglPertama) / miliday;
	    return selisih;
    };
function umurkehamilan(t1,t2){
		var hasil = 277-hitungSelisihHari(t1,t2);
		var ke_bulan = parseInt(hasil/30);
		var sisa = hasil%30;
		if (sisa>0) {
			sisa = sisa+' hari'; 
		} else sisa ='';
		var umur = ke_bulan+' bulan '+sisa;
		return umur;
	};
$(document).ready(function(){
	var t2 = "<?php echo date('Y-m-d',strtotime($tgl_taksiran_persalinan));?>";
	var t1 = "<?php echo date('Y-m-d');?>";
	var umur = umurkehamilan(t1,t2);
	$("input class='form-control'[name='umur_kehamilan']").val(umur);
	$('input class='form-control'.nama_tindakan').typeahead({
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
		        $("input class='form-control'.id_tindakan").val(map[item].id);
		        return map[item].label;
		    }
		});
});
</script>
<?php
	$button = anchor("kia", "<i class='fa fa-arrow-left'></i>&nbsp;Back",array("class"=>"tambah btn btn-warning"));
	if ($status=="simpan"){
		$button .= anchor("#", "<i class='fa fa-save'></i>&nbsp;Save",array("class"=>"save btn btn-info"));
		$disabled = "";
	} else $disabled = "disabled";
?>	
	<div class="col-xs-12">
		<?php echo $this->session->flashdata('message');?>
		<div class="box box-primary">
			<div class="box-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-xs-3">Asal Puskesmas</label>
						<div class="col-xs-9"><?php echo $p->nama_puskesmas;?></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">No. Pasien</label>
						<div class="col-xs-9"><?php echo $p->no_pasien;?></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Nama Pasien</label>
						<div class="col-xs-9"><?php echo $p->nama_pasien;?></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Umur</label>
						<div class="col-xs-9"><?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?></div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">Daftar Pertama</label>
						<div class="col-xs-9"><?php echo date('d-m-Y',strtotime($q2->tanggal));?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="nav-tabs-custom">
			<div class="box-tools pull-left">
				<div class="col-xs-12" style="margin-top: 5px">
					<div class="pull-right">
						<div class="btn-group">
							<?php echo $button;?>
						</div>
					</div>
				</div>
			</div>
            <ul class="nav nav-tabs pull-right">
            	<li class=""><a data-toggle="tab" href="#tab3">Anamnesa</a></li>
            	<li class="<?php echo ($status=='view' ? 'active' : '');?>"><a data-toggle="tab" href="#tab2">Detail ANC</a></li>
               	<li class="<?php echo ($status=='simpan' ? 'active' : '');?>"><a data-toggle="tab" href="#tab1">Antenalcare (ANC)</a></li>
            </ul>
            <div class="tab-content">
            	<div id="tab1" class="tab-pane <?php echo ($status=='simpan' ? 'active' : '');?>">
					<?php
						echo form_open("kia/simpananc/simpan",array("id"=>"formsave","class"=>"form-horizontal"));
						echo "<input class='form-control' type=hidden name=id_bumil value='".$id_bumil."'>";
						echo "<input class='form-control' type=hidden name=id_pendaftaran value='".$id_pendaftaran."'>";
					?>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-xs-3">Tanggal</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='tgl' value='<?php echo date('d-m-Y');?>'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Keluhan</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='keluhan'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Tekanan Darah</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='tekanan_darah'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Berat Badan</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='berat_badan'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Umur Kehamilan</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='umur_kehamilan'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Tinggi Fundus</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='tinggi_fundus'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Latak Janin</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='letak_janin'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Denyut Jantung Janin</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='denyut_jantung_janin'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Nadi</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='nadi'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">HB</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='hb'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Golongan Darah</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='golongan_darah'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Tindakan</label>
								<div class="col-xs-9">
									<input type=hidden name='tindakan' class='id_tindakan'>
									<div class="input-group">
										<input class='form-control' type=text <?php echo $disabled;?> name='nama_tindakan' class='form-control nama_tindakan' autocomplete="off">
										<span class='input-group-btn'><button type='button' class='cari btn btn-info'><i class='fa fa-search'></i>&nbsp;</button></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Penyuluhan</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='penyuluhan'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Keterangan</label>
								<div class="col-xs-9"><input class='form-control' type=text <?php echo $disabled;?> name='keterangan'></div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Kunjungan Berikutnya</label>
								<div class="col-xs-9">
									<input class='form-control' type=text name='tgl_kunjungan'  <?php echo $disabled;?> value='<?php echo ($p->tgl_kunjungan=='' ? date('d-m-Y') : date('d-m-Y',strtotime($p->tgl_kunjungan)));?>'>&nbsp;
								</div>
							</div>
						</div>
				</div>
				<div id="tab2" class="tab-pane <?php echo ($status=='view' ? 'active' : '');?>">
					<table class="table no-border">
						<tr>
							<td width=300px valign=top>
								<div class="box box-primary">
									<div class="box-header"><h5>Tanggal ANC</h5></div>
									<div class="box-body">
										<table class="table table-bordered table-striped">
											<?php
												$i = 0;
												foreach ($q1->result() as $row) {
													$i++;
													echo "<tr id=data href='".$row->id_antenatal_care."''>
															<td>".$i."</td>
															<td>".date("d-m-Y", strtotime($row->tgl))."</td>
													  	  </tr>";
												}
											?>
										</table>
									</div>
								</div>
							</td>
							<td valign=top width=900px>
								<div class='detailanc'></div>
							</div>
							</td>
						</tr>
					</table>
				</div>
				<div id="tab3" class="tab-pane">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-3">Tinggi Badan</label>
							<div class="col-xs-3">
								<input class="form-control" type=text disabled name='tinggi_badan' value='<?php echo $tinggi_badan;?>'>
							</div>
							<div class="col-xs-3"><span style='line-height: 30px'>LILA (cm)</span></div>
							<div class="col-xs-3"><input class="form-control" type=text name='lila' disabled value='<?php echo $lila;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tanggal Haid Terakhir</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='tgl_haid_terakhir' value='<?php echo $tgl_haid_terakhir;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tanggal Penaksiran Persalinan</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='tgl_taksiran_persalinan' value='<?php echo $tgl_taksiran_persalinan;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Keluhan Utana</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='keluhan_utama' value='<?php echo $keluhan_utama;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jumlah Anak Yang direncanakan</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='jml_anak_rencana' value='<?php echo $jml_anak_rencana;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Datang Atas Petunjuk</label>
							<div class="col-xs-9">
								<select name='datang_atas_petunjuk' disabled class="form-control">
									<option value='Suami' <?php echo (($datang_atas_petunjuk == 'Suami') ? "selected" : "")?>>Suami</option>
									<option value='Kader' <?php echo (($datang_atas_petunjuk == 'Kader') ? "selected" : "")?>>Kader</option>
									<option value='Petugas' <?php echo (($datang_atas_petunjuk == 'Petugas') ? "selected" : "")?>>Petugas</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Adakah Perlakuan Kasar Suami</label>
							<div class="col-xs-9">
								<select name='perlakuan_kasar_suami' disabled class="form-control">
									<option value='Tidak'>Tidak</option>
									<option value='Ada'>Ada</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Adakah Keluhan Keputihan</label>
							<div class="col-xs-9">
								<select name='keluhan_keputihan' disabled class="form-control">
									<option value='Tidak'>Tidak</option>
									<option value='Ada'>Ada</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Kehamilan</label>
							<div class="col-xs-9">
								<table>
									<tr>
										<td width=100><input class="form-control" type=text disabled name='gravida' value='<?php echo $gravida;?>'></td><td>&nbsp;&nbsp;Gravida&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td width=100><input class="form-control" type=text disabled name='partus' value='<?php echo $partus;?>'></td><td>&nbsp;&nbsp;Partus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td width=100><input class="form-control" type=text disabled name='abortus' value='<?php echo $abortus;?>'></td><td>&nbsp;&nbsp;Abortus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jumlah Yang Hidup</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='jml_anak_hidup' value='<?php echo $jml_anak_hidup;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jumlah Yang Meninggal</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='jml_lahir_mati' value='<?php echo $jml_lahir_mati;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Jarak Persalinan Terakhir</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='jarak_persalinan_akhir' value='<?php echo $jarak_persalinan_akhir;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Penolong persalinan terakhir</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='penolong_persalinan_akhir' value='<?php echo $penolong_persalinan_akhir;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Riwayat persalinan lalu</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='cara_persalinan_akhir' value='<?php echo $cara_persalinan_akhir;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Placenta lahir dengan</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='placenta_lahir' value='<?php echo $placenta_lahir;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Penggunaan kontrasepsi sebelum kelahiran ini</label>
							<div class="col-xs-9"><input class="form-control" type=text disabled name='penggunaan_kntrs_akhir' value='<?php echo $penggunaan_kntrs_akhir;?>'></div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3">Tempat Rujukan/ RSBM</label>
							<div class="col-xs-4">
								<select name='rujukan' disabled class="form-control">
									<?php echo $this->Mpendaftaran->rujukan($rujukan);?>
								</select>
							</div>
							<div class="col-xs-5"><input class="form-control" type=text disabled name='ket_rujukan' value='<?php echo $ket_rujukan;?>'></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close();
			echo "
			<div class='box box-primary'>
				<div class='box-header'><h4>RESEP OBAT</h4></div>
				<div class='box-body'>
					<table id='data colums' class='table table-bordered table-striped'>
						<tr class='bg-navy'>
					   		<th width='20px' >No</th>
					   		<th>Obat</th>
					   		<th width=400>Aturan Pakai</th>
					   		<th width=200>Jumlah</th>
					   		<th width=100>Action</th>
					 	</tr>";
			 	echo form_open("kia/simpanresep",array("id"=>"formsavelab","class"=>"form-horizontal"));
			 	echo "
			 	<tr>
					<td>&nbsp;</td>
					<td>
						<input class='form-control' type=hidden name='id_pendaftaran' value='".$id_pendaftaran."'>
						<input class='form-control' type=hidden name='id_bumil' value='".$id_bumil."'>
						<input class='form-control' type=hidden name='id_obat' class='id_obat'>
						<div class='input-group'>
							<input class='form-control' type=text name='nama_obat' class='nama_obat' autocomplete='off'>
							<span class='input-group-btn'><button type='button' class='cariobat btn btn-info'><i class='fa fa-search'></i></button></span>
						</div>
					</td>
					<td><input class='form-control' type=text name='aturan_pakai'></td>
					<td><input class='form-control' type=text name=jml_pemakaian></td>
					<td style='text-align:center'><button type=submit name=Submit class='btn btn-success'><i class='icon-ok'></i>&nbsp;Save</button></td>
				</tr>";
				echo form_close();
					$i = 0;
					foreach ($q5->result() as $row){
						$i++;
						echo "<tr class='pasienlab'>
						  <td align=center>".$i."</td>
						  <td>".$row->nama_obat."</td>
						  <td>".$row->aturan_pakai."</td>aturan_pakai
						  <td>".$row->jml_pemakaian."</td>
						  <td style='text-align:center'>
						  	<button type='button' class='hapusresep btn btn-danger' value='".$id_pendaftaran."/".$id_bumil."/".$row->id_resep."'>
						  		<i class='icon-remove'></i>
						  	</button>
						  </td>
						  </tr>";
					}
			echo "
			</table>
			</div>
			</div>";
			?>
	</div>