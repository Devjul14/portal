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
		var id = $(".seleksi").attr("href");
		var id_pendaftaran = $("input[name='id_pendaftaran']").val();
		$(".detailanc").load("<?php echo site_url('kia/getanctgl')?>/"+id+"/"+id_pendaftaran);
		$("tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        $("tr#data").click(function(){
        	var id = $(".seleksi").attr("href");
        	var id_pendaftaran = $("input[name='id_pendaftaran']").val();
			$(".detailanc").load("<?php echo site_url('kia/getanctgl')?>/"+id+"/"+id_pendaftaran);
        })
		var formattgl = "dd-mm-yy";
        $("input[name='tgl']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
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
		$(".hapusanc").click(function(){
			var id = $(this).val();
			//alert(id);
			window.location = "<?php echo site_url('kia/hapusanc');?>/"+id;
		});
		$('input.nama_obat').typeahead({
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
		        $("input.id_obat").val(map[item].id);
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
		$id_bumil=
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
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->session->flashdata('message');?>
		<div class="subnav">
		<div class='span12'>
			<div class='text-center'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
		</div>
		</div>
		<div class="widget-box">
		<div class="widget-content">
			<table class="table">
				<tr valign=top>
					<td width='150' class="noborder">Asal Puskesmas</td>
					<td width=10 class="noborder">:</td>
					<td class="noborder"><?php echo $p->nama_puskesmas;?></td>
				</tr>
				<tr>
					<td class="noborder">No. Pasien</td>
					<td class="noborder">:</td>
					<td class="noborder"><?php echo $p->no_pasien;?></td>
				</tr>
				<tr>
					<td class="noborder">Nama Pasien</td>
					<td class="noborder">:</td>
					<td class="noborder"><?php echo $p->nama_pasien;?></td>
				</tr>
				<tr>
					<td class="noborder">Umur</td>
					<td class="noborder">:</td>
					<td class="noborder"><?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?></td>
				</tr>
				<tr>
					<td class="noborder">Daftar Pertama</td>
					<td class="noborder">:</td>
					<td class="noborder"><?php echo date('d-m-Y',strtotime($q2->tanggal));?></td>
				</tr>
			</table>
		</div>
		</div>
		<div class="widget-box">
        	<div class="widget-content tab-content">
				<table cellpadding=5px cellspacing=5px>
					<tr>
						<td width=300px valign=top>
							<div class="widget-box">
								<div class="widget-title"><h5>Tanggal ANC</h5></div>
								<div class="widget-content">
									<table class="table table-bordered">
										<?php
											$i = 0;
											foreach ($q1->result() as $row) {
												$i++;
												echo "<tr id=data href='".$row->id_antenatal_care."''>
														<td>".$i."</td>
														<td>".date("d-m-Y", strtotime($row->tgl))."</td>
														<td width=20px><button type='button' class='hapusanc btn btn-danger' value='".$row->id_pendaftaran."/".$row->id_bumil."/".$row->id_antenatal_care."'><i class='icon-remove'></i></button></td>
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
		</div>
		<?php echo form_close();?>
	</div>
</div>

<?php
echo "
<div class='subnav'>
	<div class='span12'>
		<div class='text-center'><h4>RESEP OBAT</div>
	</div>
</div>
<div class='row-fluid'>
<div class='span12'>
<table id='data colums' class='table table-bordered'>
	<tr>
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
			<input type=hidden name='id_pendaftaran' value='".$id_pendaftaran."'>
			<input type=hidden name='id_bumil' value='".$id_bumil."'>
			<input type=hidden name='id_obat' class='id_obat'>
			<input type=text name='nama_obat' class='span10 nama_obat' autocomplete='off'>
			<button type='button' class='cariobat btn btn-right' style='margin-top:-10'><i class='icon-search'></i>&nbsp;</button>
		</td>
		<td><input type=text name=aturan_pakai class=span12></td>
		<td><input type=text name=jml_pemakaian class=span12></td>
		<td style='text-align:center'><button type=submit name=Submit class=btn><i class='icon-ok'></i>&nbsp;Save</button></td>
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