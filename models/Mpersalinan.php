<?php
class Mpersalinan extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getpasien($posisi,$baris){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where ps.nama_pasien like '%".$this->input->post("nama")."%'";
		if($tanggal1!="") { $cond.=" and bp.tgl_persalinan between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql="select bp.*,ps.nama_pasien,ps.no_kk,ps.no_pasien from bumil_persalinan bp ".
		"left join pasien ps on ps.id_pasien=bp.id_bumil ".			
		$cond." order by bp.tgl_persalinan limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getjumlahpasien(){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where ps.nama_pasien like '%".$this->input->post("nama")."%'";
		if($tanggal1!="") { $cond.=" and bp.tgl_persalinan between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql= "select count(*) as jumlah from bumil_persalinan bp 
		       left join pasien ps on ps.id_pasien=bp.id_bumil ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getbumildetail($id_bumil){
		$sql= "select ps.*,bp.*,year(sysdate())-ps.tahun_lahir as umur,pu.nama_puskesmas, ".
				 "ps.nama_pasien,ps.no_kk,ps.no_pasien,ps.id_pasien,ps.id_puskesmas ".
				 "from bumil_persalinan bp ".
				 "left join pasien ps on ps.id_pasien=bp.id_bumil ".
				 "left join puskesmas pu on pu.id_puskesmas=ps.id_puskesmas ".
				 "where bp.id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getrujukan_persalinan($id_pendaftaran,$id_bumil){
		$sql= "select * from rujukan_persalinan where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getkala1($id_pendaftaran,$id_bumil){
		$sql= "select * from kala1 where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getkala2($id_pendaftaran,$id_bumil){
		$sql= "select * from kala2 where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getkala3($id_pendaftaran,$id_bumil){
		$sql= "select * from kala3 where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getkala4($id_pendaftaran,$id_bumil){
		$sql= "select * from kala4 where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getbayi_baru($id_pendaftaran,$id_bumil){
		$sql= "select * from bayi_baru where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getpemeriksaan_bayi($id_pendaftaran,$id_bumil){
		$sql= "select * from pemeriksaan_bayi where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function simpan_rujukan_persalinan($action){
		switch ($action) {
			case 'simpan':
				$sql = "insert into rujukan_persalinan set
						id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						id_bumil='".$this->input->post('id_bumil')."',
						catatan='".$this->input->post('catatan')."',
						alasan_merujuk='".$this->input->post('alasan_merujuk')."',
						pendamping='".$this->input->post('pendamping')."',
						masalah='".$this->input->post('masalah1')."'";
				break;
			
			case 'edit' :
				$sql = "update rujukan_persalinan set 
						catatan='".$this->input->post('catatan')."',
						alasan_merujuk='".$this->input->post('alasan_merujuk')."',
						pendamping='".$this->input->post('pendamping')."',
						masalah='".$this->input->post('masalah1')."' 
						where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
						id_bumil='".$this->input->post('id_bumil')."'";
				break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function simpan_kala1($action){
		switch ($action) {
			case 'simpan':
				$sql = "insert into kala1 set
						id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						id_bumil='".$this->input->post('id_bumil')."',
						lewat_waspada='".$this->input->post('lewat_waspada')."',
						masalah_kala1='".$this->input->post('masalah_kala1')."',
						penatalaksanaan='".$this->input->post('penatalaksanaan')."',
						hasil_kala1='".$this->input->post('hasil_kala1')."'";
				break;
			
			case 'edit' :
				$sql = "update kala1 set 
						lewat_waspada='".$this->input->post('lewat_waspada')."',
						masalah_kala1='".$this->input->post('masalah_kala1')."',
						penatalaksanaan='".$this->input->post('penatalaksanaan')."',
						hasil_kala1='".$this->input->post('hasil_kala1')."' 
						where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
						id_bumil='".$this->input->post('id_bumil')."'";
				break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function simpan_kala2($action){
		switch ($action) {
			case 'simpan':
				$sql = "insert into kala2 set
						id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						id_bumil='".$this->input->post('id_bumil')."',
						episiotomi='".$this->input->post('episiotomi')."',
						pendamping='".$this->input->post('pendamping2')."',
						gawat_janin='".$this->input->post('gawat_janin')."',
						tindakan_kala21='".$this->input->post('tindakan_kala21')."',
						distosia='".$this->input->post('distosia')."',
						tindakan_kala22='".$this->input->post('tindakan_kala22')."',
						hasil_kala2='".$this->input->post('hasil_kala2')."'";
				break;
			
			case 'edit' :
				$sql = "update kala2 set 
						episiotomi='".$this->input->post('episiotomi')."',
						pendamping='".$this->input->post('pendamping2')."',
						gawat_janin='".$this->input->post('gawat_janin')."',
						tindakan_kala21='".$this->input->post('tindakan_kala21')."',
						distosia='".$this->input->post('distosia')."',
						tindakan_kala22='".$this->input->post('tindakan_kala22')."',
						hasil_kala2='".$this->input->post('hasil_kala2')."' 
						where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
						id_bumil='".$this->input->post('id_bumil')."'";
				break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function simpan_kala3($action){
		switch ($action) {
			case 'simpan':
				$sql = "insert into kala3 set
						id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						id_bumil='".$this->input->post('id_bumil')."',
						inisiasi='".$this->input->post('inisiasi')."', 
						alasan_kala31='".$this->input->post('alasan_kala31')."', 
						lama_kala3='".$this->input->post('lama_kala3')."', 
						oksitosin='".$this->input->post('oksitosin')."', 
						alasan_kala32='".$this->input->post('alasan_kala32')."', 
						jepit_tali_pusat='".$this->input->post('jepit_tali_pusat')."', 
						oksitosin2='".$this->input->post('oksitosin2')."', 
						alasan_kala33='".$this->input->post('alasan_kala33')."', 
						penegangan_tali_pusat='".$this->input->post('penegangan_tali_pusat')."', 
						alasan_kala34='".$this->input->post('alasan_kala34')."', 
						masase_fundus_uteri='".$this->input->post('masase_fundus_uteri')."', 
						alasan_kala35='".$this->input->post('alasan_kala35')."', 
						intact='".$this->input->post('intact')."', 
						tindakan_kala31='".$this->input->post('tindakan_kala31')."', 
						plasenta_lebih_30menit='".$this->input->post('plasenta_lebih_30menit')."', 
						tindakan_kala32='".$this->input->post('tindakan_kala32')."', 
						laserasi='".$this->input->post('laserasi')."', 
						tindakan_kala33='".$this->input->post('tindakan_kala33')."', 
						derajat_laserasi='".$this->input->post('derajat_laserasi')."', 
						tindakan_kala34='".$this->input->post('tindakan_kala34')."', 
						alasan_kala36='".$this->input->post('alasan_kala36')."', 
						atoni_uteri='".$this->input->post('atoni_uteri')."', 
						tindakan_kala35='".$this->input->post('tindakan_kala35')."', 
						volume_darah_keluar='".$this->input->post('volume_darah_keluar')."', 
						masalah_kala3='".$this->input->post('masalah_kala3')."', 
						hasil_kala3='".$this->input->post('hasil_kala3')."'";
				break;
			
			case 'edit' :
				$sql = "update kala3 set 
						inisiasi='".$this->input->post('inisiasi')."', 
						alasan_kala31='".$this->input->post('alasan_kala31')."', 
						lama_kala3='".$this->input->post('lama_kala3')."', 
						oksitosin='".$this->input->post('oksitosin')."', 
						alasan_kala32='".$this->input->post('alasan_kala32')."', 
						jepit_tali_pusat='".$this->input->post('jepit_tali_pusat')."', 
						oksitosin2='".$this->input->post('oksitosin2')."', 
						alasan_kala33='".$this->input->post('alasan_kala33')."', 
						penegangan_tali_pusat='".$this->input->post('penegangan_tali_pusat')."', 
						alasan_kala34='".$this->input->post('alasan_kala34')."', 
						masase_fundus_uteri='".$this->input->post('masase_fundus_uteri')."', 
						alasan_kala35='".$this->input->post('alasan_kala35')."', 
						intact='".$this->input->post('intact')."', 
						tindakan_kala31='".$this->input->post('tindakan_kala31')."', 
						plasenta_lebih_30menit='".$this->input->post('plasenta_lebih_30menit')."', 
						tindakan_kala32='".$this->input->post('tindakan_kala32')."', 
						laserasi='".$this->input->post('laserasi')."', 
						tindakan_kala33='".$this->input->post('tindakan_kala33')."', 
						derajat_laserasi='".$this->input->post('derajat_laserasi')."', 
						tindakan_kala34='".$this->input->post('tindakan_kala34')."', 
						alasan_kala36='".$this->input->post('alasan_kala36')."', 
						atoni_uteri='".$this->input->post('atoni_uteri')."', 
						tindakan_kala35='".$this->input->post('tindakan_kala35')."', 
						volume_darah_keluar='".$this->input->post('volume_darah_keluar')."', 
						masalah_kala3='".$this->input->post('masalah_kala3')."', 
						hasil_kala3='".$this->input->post('hasil_kala3')."'
						where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
						id_bumil='".$this->input->post('id_bumil')."'";
				break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function simpan_kala4($action){
		switch ($action) {
			case 'simpan':
				$sql = "insert into kala4 set
						id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						id_bumil='".$this->input->post('id_bumil')."',
						kondisi_umum='".$this->input->post('kondisi_umum')."', 
						tekanan_darah_kala4='".$this->input->post('tekanan_darah_kala4')."', 
						nadi_kala4='".$this->input->post('nadi_kala4')."', 
						napas_kala4='".$this->input->post('napas_kala4')."', 
						masalah_kala4='".$this->input->post('masalah_kala4')."'";
				break;
			
			case 'edit' :
				$sql = "update kala4 set 
						kondisi_umum='".$this->input->post('kondisi_umum')."', 
						tekanan_darah_kala4='".$this->input->post('tekanan_darah_kala4')."', 
						nadi_kala4='".$this->input->post('nadi_kala4')."', 
						napas_kala4='".$this->input->post('napas_kala4')."', 
						masalah_kala4='".$this->input->post('masalah_kala4')."'
						where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
						id_bumil='".$this->input->post('id_bumil')."'";
				break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function simpan_bayi_baru($action){
		switch ($action) {
			case 'simpan':
				$sql = "insert into bayi_baru set
						id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						id_bumil='".$this->input->post('id_bumil')."',
						nama_bayi='".$this->input->post('nama_bayi')."', 
						keadaan_lahir='".$this->input->post('keadaan_lahir')."', 
						resusitasi='".$this->input->post('resusitasi')."', 
						berat_badan='".$this->input->post('berat_badan')."', 
						panjang_badan='".$this->input->post('panjang_badan')."', 
						jk='".$this->input->post('jk')."', 
						nilai_bayi='".$this->input->post('nilai_bayi')."', 
						bayi_lahir='".$this->input->post('bayi_lahir')."', 
						tindakan_bayi='".$this->input->post('tindakan_bayi')."', 
						pemberian_asi='".$this->input->post('pemberian_asi')."', 
						alasan_asi='".$this->input->post('alasan_asi')."', 
						masalah_asi='".$this->input->post('masalah_asi')."'";
				break;
			
			case 'edit' :
				$sql = "update bayi_baru set
						nama_bayi='".$this->input->post('nama_bayi')."', 
						keadaan_lahir='".$this->input->post('keadaan_lahir')."', 
						resusitasi='".$this->input->post('resusitasi')."', 
						berat_badan='".$this->input->post('berat_badan')."', 
						panjang_badan='".$this->input->post('panjang_badan')."', 
						jk='".$this->input->post('jk')."', 
						nilai_bayi='".$this->input->post('nilai_bayi')."', 
						bayi_lahir='".$this->input->post('bayi_lahir')."', 
						tindakan_bayi='".$this->input->post('tindakan_bayi')."', 
						pemberian_asi='".$this->input->post('pemberian_asi')."', 
						alasan_asi='".$this->input->post('alasan_asi')."', 
						masalah_asi='".$this->input->post('masalah_asi')."'
						where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
						id_bumil='".$this->input->post('id_bumil')."'";
				break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function simpan_pemeriksaan_bayi($action){
		switch($action){
			case 'simpan' :
			$sql = "insert into pemeriksaan_bayi set 
					id_pendaftaran='".$this->input->post('id_pendaftaran')."',
					id_bumil='".$this->input->post('id_bumil')."',
					id_bayi='".$this->input->post('id_bayi')."',
					buka_baju='".$this->input->post('buka_baju')."',
					keadaan_umum='".$this->input->post('keadaan_umum')."',
					timbang_bayi='".$this->input->post('timbang_bayi')."',
					ukur_lingkar_kepala='".$this->input->post('ukur_lingkar_kepala')."',
					periksa_kepala='".$this->input->post('periksa_kepala')."',
					periksa_anggota_tubuh='".$this->input->post('periksa_anggota_tubuh')."',
					periksa_dada='".$this->input->post('periksa_dada')."',
					periksa_pusar='".$this->input->post('periksa_pusar')."',
					periksa_genitalia='".$this->input->post('periksa_genitalia')."',
					periksa_anus='".$this->input->post('periksa_anus')."',
					periksa_tubuh_bawah='".$this->input->post('periksa_tubuh_bawah')."',
					periksa_tulang_punggung='".$this->input->post('periksa_tulang_punggung')."'";
			break;
			case 'edit' :
			$sql = "update pemeriksaan_bayi set 
					buka_baju='".$this->input->post('buka_baju')."',
					keadaan_umum='".$this->input->post('keadaan_umum')."',
					timbang_bayi='".$this->input->post('timbang_bayi')."',
					ukur_lingkar_kepala='".$this->input->post('ukur_lingkar_kepala')."',
					periksa_kepala='".$this->input->post('periksa_kepala')."',
					periksa_anggota_tubuh='".$this->input->post('periksa_anggota_tubuh')."',
					periksa_dada='".$this->input->post('periksa_dada')."',
					periksa_pusar='".$this->input->post('periksa_pusar')."',
					periksa_genitalia='".$this->input->post('periksa_genitalia')."',
					periksa_anus='".$this->input->post('periksa_anus')."',
					periksa_tubuh_bawah='".$this->input->post('periksa_tubuh_bawah')."',
					periksa_tulang_punggung='".$this->input->post('periksa_tulang_punggung')."'
					where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
					id_bumil='".$this->input->post('id_bumil')."' and 
					id_bayi='".$this->input->post('id_bayi')."'";
		}
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
}