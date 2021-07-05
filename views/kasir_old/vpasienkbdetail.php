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
function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}
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
                        <label class="col-sm-2">No Seri Kartu</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_seri_kartu" value="<?=$no_seri_kartu;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Status Peserta KB</label>
                        <div class="col-sm-10">
                            <select name="status_peserta_kb" class="form-control">
								<?php
									foreach ($q1->result() as $data) {
										echo "<option value='".$data->id_status_pesertaKB."' ".($data->id_status_pesertaKB=$id_status_pesertaKB ? "selected" : "").">".$data->nama_status."</option>";
									}
								?>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Cara KB Terakhir</label>
                        <div class="col-sm-10">
                            <input type="text" name="cara_kb_terakhir" value="<?=$cara_kb_terakhir;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Jumlah Anak Hidup</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah_anak_hidup" value="<?=$jumlah_anak_hidup;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Jumlah Anak Lahir Hidup Kemudian Meninggal</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah_anak_unhidup" value="<?=$jumlah_anak_unhidup;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Keadaan Umum</label>
                        <div class="col-sm-10">
                            <select name="keadaan_umum" class="form-control">
								<option value='baik' <?php if ($keadaan_umum=='baik') echo "selected";?>>Baik</option>
								<option value='sedang' <?php if ($keadaan_umum=='sedang') echo "selected";?>>Sedang</option>
								<option value='kurang' <?php if ($keadaan_umum=='kurang') echo "selected";?>>Kurang</option>
							</select>
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
                        <label class="col-sm-2">Status Kehamilan</label>
                        <div class="col-sm-10">
                            <input type="text" name="status_kehamilan" value="<?=$status_kehamilan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tanggal Haid Terakhir</label>
                        <div class="col-sm-10">
                            <input type="text" name="tgl_haid_terakhir" value="<?=$tgl_haid_terakhir;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Berat Badan</label>
                        <div class="col-sm-10">
                            <input type="text" name="berat_badan" value="<?=$berat_badan;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Sakit Kuning</label>
                        <div class="col-sm-10">
                            <select name="status_sakit_kuning" class="form-control">
								<option value='T' <?php if ($status_sakit_kuning=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_sakit_kuning=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Pendarahan Pervaginam</label>
                        <div class="col-sm-10">
                            <select name="status_pendarahan" class="form-control">
								<option value='T' <?php if ($status_pendarahan=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_pendarahan=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tumor Payudara</label>
                        <div class="col-sm-10">
                            <select name="status_tumor_payudara" class="form-control">
								<option value='T' <?php if ($status_tumor_payudara=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_tumor_payudara=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tumor Rahim</label>
                        <div class="col-sm-10">
                            <select name="status_tumor_rahim" class="form-control">
								<option value='T' <?php if ($status_tumor_rahim=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_tumor_rahim=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tumor Indung Telur</label>
                        <div class="col-sm-10">
                            <select name="status_tumor_indung" class="form-control">
								<option value='T' <?php if ($status_tumor_indung=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_tumor_indung=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Posisi Rahim</label>
                        <div class="col-sm-10">
                            <select name="posisi_rahim" class="form-control">
								<option value='retro' <?php if ($posisi_rahim=='retro') echo "selected";?>>Retro</option>
								<option value='antifleksi' <?php if ($posisi_rahim=='antifleksi') echo "selected";?>>Antifleksi</option>
								<option value='porsio' <?php if ($posisi_rahim=='porsio') echo "selected";?>>Porsio</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tandang Randang</label>
                        <div class="col-sm-10">
                            <select name="status_tanda_radang" class="form-control">
								<option value='T' <?php if ($status_tanda_radang=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_tanda_radang=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tumor Ganas</label>
                        <div class="col-sm-10">
                            <select name="status_tumor_ganas" class="form-control">
								<option value='T' <?php if ($status_tumor_ganas=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_tumor_ganas=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tumor Ganas</label>
                        <div class="col-sm-10">
                            <select name="status_tumor_ganas" class="form-control">
								<option value='T' <?php if ($status_tumor_ganas=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_tumor_ganas=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Status Diabetes</label>
                        <div class="col-sm-10">
                            <select name="status_diabetes" class="form-control">
								<option value='T' <?php if ($status_diabetes=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_diabetes=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Kelainan Pembekuan Darah</label>
                        <div class="col-sm-10">
                            <select name="status_beku_darah" class="form-control">
								<option value='T' <?php if ($status_beku_darah=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_beku_darah=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Radang Orchitis/ Epididymitis</label>
                        <div class="col-sm-10">
                            <select name="status_orchitis" class="form-control">
								<option value='T' <?php if ($status_orchitis=='T') echo "selected";?>>Tidak</option>
								<option value='Y' <?php if ($status_orchitis=='Y') echo "selected";?>>Ya</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Alat Kontrasepsi yang diberikan ke-1</label>
                        <div class="col-sm-10">
                            <input type=text class="form-control" name='alat_kontr_ok' value='<?php echo $alat_kontr_ok;?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Alat Kontrasepsi yang diberikan ke-2</label>
                        <div class="col-sm-10">
                            <input type=text class="form-control" name='alat_kontr_ok2' value='<?php echo $alat_kontr_ok2;?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tanggal Dilayani</label>
                        <div class="col-sm-10">
                            <input type=text class="form-control" name='tgl_dilayani' value='<?php echo $tgl_dilayani;?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tanggal Dilepas</label>
                        <div class="col-sm-10">
                            <input type=text class="form-control" name='tgl_dilepas' value='<?php echo $tgl_dilepas;?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tindakan</label>
                        <div class="col-sm-10">
                            <input type=hidden name='id_tindakan' class='id_tindakan' value='<?php echo $id_tindakan;?>'>
							<input type=text class="form-control" name='nama_tindakan' class='input-left nama_tindakan' autocomplete="off" value='<?php echo $nama_tindakan;?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Pemeriksa</label>
                        <div class="col-sm-10">
                            <input type=text class="form-control" name='pemeriksa' value='<?php echo $pemeriksa;?>'>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>