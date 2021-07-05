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
    });
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
                        <label class="col-sm-2">Umur</label>
                        <div class="col-sm-10">
                            <input type=text name='umur' class="form-control" value='<?php echo  $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tanggal Periksa</label>
                        <div class="col-sm-10">
                            <input type="text" name="tekanan_darah" value="<?=$tgl_periksa;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Berat Badan</label>
                        <div class="col-sm-10">
                            <input type="text" name="berat_badan" value="<?=$berat_badan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Suhu Tubuh</label>
                        <div class="col-sm-10">
                            <input type="text" name="suhu_tubuh" value="<?=$suhu_tubuh;?>" class="form-control">
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
        <div class="ibox float-e-margins">
            <div class="ibox-content" >
            	<div class="form-horizontal">            	
            		<div class='form-group'>
                        <div class='col-sm-4'></div>
                        <label class='col-sm-4'><h3 align=center>Imunisasi</h3></label>
                        <div class='col-sm-4'></div>
                    </div>
	            	<table class="table table-bordered" id="data-colums">
	            		<tr>
					   		<th width="20px" class="text-center">No</th>
					   		<th colspan=2 class="text-center">Imunisasi</th>
					 	</tr>
					 	<?php
							$i = 0;
							foreach ($q->result() as $row){
								$i++;
								echo "
								<tr id='data' class='pasienlab'>
								  <td align=center>".$i."</td>
								  <td width=150px>".date('d-m-Y',strtotime($row->tanggal))."</td>
								  <td>".$row->nama_imunisasi."</td>
								</tr>";
							}
						?>
	            	</table>
            	</div>
            </div>
        </div>
    </div>
</div>