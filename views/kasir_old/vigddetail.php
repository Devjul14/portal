<?php
	$tgl_kunjungan = date('d-m-Y');
	if ($row){
		$id_bpumum = $row->id_bpumum;
		$nip = $row->nip;
		$ket_rujukan = $row->ket_rujukan;
		$rowujukan = $row->rujukan;
		$umur = $row->umur;
		$id_paramedis = $row->id_paramedis;
		$tekanan_darah = $row->tekanan_darah;
		$berat_badan = $row->berat_badan;
		$keluhan = $row->keluhan;
		$action = "edit";
	} else {
		$nip = 
		$ket_rujukan = 
		$rujukan = 
		$umur = 
		$id_paramedis = 
		$tekanan_darah =
		$keluhan =
		$berat_badan = "";
		$action = "simpan";
	}
	// echo $action;
?>
<script>
	var mywindow;
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 800;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
		$("tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
		var formattgl = "dd-mm-yyyy";
        $("input[name='tgl_haid_terakhir']").datepicker({ format : formattgl });
        $("input[name='tgl_taksiran_persalinan']").datepicker({ format : formattgl });

        $(".save").click(function(){
        	$("#formsave").trigger("submit");
        	return false;
        });
        $(".cari").click(function(){
			var url = "<?php echo site_url('umum/caripenyakit');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".carilab").click(function(){
			var url = "<?php echo site_url('kia/carilab');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".cariobat").click(function(){
			var url = "<?php echo site_url('umum/cariobat');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".hapuspenyakit").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('umum/hapuspenyakit');?>/"+id;
		});
		$(".hapuspasienlab").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('umum/hapuspasienlab');?>/"+id;
		});
		$(".hapusresep").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('umum/hapusresep');?>/"+id;
		});
		$(".cetak").click(function(){
        	var id = $(this).attr("href");
        	var url = "<?php echo site_url('kasir/cetak')?>/"+id;
        	openCenteredWindow(url);
        	return false;
        })
        $(".cetakkwi").click(function(){
        	var id = $(this).attr("href");
        	var url = "<?php echo site_url('kasir/cetak_kwitansi')?>/"+id;
        	openCenteredWindow(url);
        	return false;
        })
    })
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content" >
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2">Asal Puskesmas</label>
                        <div class="col-sm-1">
                            :
                        </div>
                        <div class="col-sm-4">
                             <?=$p->nama_puskesmas;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">No. Pasien</label>
                        <div class="col-sm-1">
                            :
                        </div>
                        <div class="col-sm-4">
                             <?=$p->no_pasien;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Nama Pasien</label>
                        <div class="col-sm-1">
                            :
                        </div>
                        <div class="col-sm-4">
                             <?=$p->nama_pasien;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Umur</label>
                        <div class="col-sm-1">
                            :
                        </div>
                        <div class="col-sm-4">
                             <?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
        	<div class="ibox-title">
        		<div class="form-horizontal">
        			<div class="form-group">
        				<div class="col-sm-4">
        					<button class="cetak btn btn-primary btn-outline" href="<?=$id_layanan.'/'.$id_pendaftaran?>"><i class="fa fa-print"></i> Cetak</button>
        					<button class="cetakkwi btn btn-success btn-outline" href="<?=$id_layanan.'/'.$id_pendaftaran?>"><i class="fa fa-print"></i> Cetak Kwitansi</button>
        				</div>
        			</div>
        		</div>
        	</div>
            <div class="ibox-content" >
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2">Dokter</label>
                        <div class="col-sm-10">
                            <select name="nip" class="form-control">
                                <?php
                                    foreach ($d->result() as $row) {
                                        echo "<option value='".$row->id_paramedis."' ".($nip=$row->id_paramedis ? "selected" : "").">".$row->nama_paramedis."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tekanan Darah</label>
                        <div class="col-sm-10">
                            <input type="text" name="tekanan_darah" value="<?=$tekanan_darah;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Berat Badan</label>
                        <div class="col-sm-10">
                            <input type="text" name="berat_badan" value="<?=$berat_badan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Keluhan</label>
                        <div class="col-sm-10">
                            <input type="text" name="keluhan" value="<?=$keluhan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Kunjungan Berikutnya</label>
                        <div class="col-sm-10">
                            <input type="text" name="tgl_kunjungan" value="<?=$tgl_kunjungan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tempat Rujukan / RSBM</label>
                        <div class="col-sm-10">
                            <select name='rujukan' class="form-control">
                            <?php echo $this->Mpendaftaran->rujukan($rujukan);?>
                        </select>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-lg-12'>
        <div class='ibox float-e-margins'>
            <div class='ibox-content'>
                <div class='form-horizontal'>
                	<?php 
                		if ($q1){

                			//PENYAKIT
                			echo "
                				<div class='form-group'>
	                                <div class='col-sm-4'></div>
	                                <label class='col-sm-4'><h3 align=center>Penyakit</h3></label>
	                                <div class='col-sm-4'></div>
	                            </div>
	                            <table class='table table-bordered' id='colums'>
	                                <tr>
	                                    <th width='20px' >No</th>
	                                    <th>Nama Penyakit</th>
	                                    <th width=200>Tindakan</th>
	                                    <th width=200>Status Kasus</th>
	                                </tr>
                			";
            				$i = 0;
							foreach ($q1->result() as $row){
								$i++;
								echo "
									<tr class='pasienlab'>
									  <td align=center>".$i."</td>
									  <td>".$row->nama_penyakit."</td>
									  <td>".$row->nama_tindakan."</td>
									  <td>".$row->status_kasus."</td>
									 </tr>";
								}
							echo "
								</table>
								<div class='hr-line-dashed'></div>";
                		}
                		if ($q2){

                			//Laboratorium
	                        echo "
	                            <div class='form-group'>
	                                <div class='col-sm-4'></div>
	                                <label class='col-sm-4'><h3 align=center>Laboratorium</h3></label>
	                                <div class='col-sm-4'></div>
	                            </div>
	                            <table id='data colums' class='table table-bordered'>
		                            <tr>
		                                <th width='20px' >No</th>
		                                <th width=400>Labotarium</th>
   										<th>Keterangan</th>
		                            </tr>
	                        ";
	                        $i = 0;
							foreach ($q2->result() as $row){
								$i++;
								echo "
									<tr class='pasienlab'>
									  <td align=center>".$i."</td>
									  <td>".$row->nama_lab."</td>
									  <td>".$row->keterangan."</td>
									  </tr>";
							}
							echo "
								</table>
								<div class='hr-line-dashed'></div>";
                		}

                		if ($q5){

                			//Obat
	                        echo "
	                            <div class='form-group'>
	                                <div class='col-sm-4'></div>
	                                <label class='col-sm-4'><h3 align=center>Resep Obat</h3></label>
	                                <div class='col-sm-4'></div>
	                            </div>
	                            <table id='data colums' class='table table-bordered'>
		                            <tr>
		                                <th width='20px' >No</th>
								   		<th>Obat</th>
								   		<th>Aturan Pakai</th>
								   		<th width=100>Dosis</th>
		                            </tr>
	                        ";
	                        $i = 0;
							foreach ($q5->result() as $row){
								$i++;
								echo "
									<tr class='pasienlab'>
									  <td align=center>".$i."</td>
									  <td>".$row->nama_obat."</td>
									  <td>".$row->aturan_pakai."</td>
									  <td>".$row->jml_pemakaian."</td>
									  </tr>";
							}
							echo "
								</table>
								<div class='hr-line-dashed'></div>";
                		}

                	?>
                </div>
            </div>
        </div>
    </div>
</div>
