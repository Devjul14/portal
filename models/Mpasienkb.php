<?php
class Mpasienkb extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
	function getstatuspembayaran(){
       $sql = "select * from status_pembayaran order by status_pembayaran";
       $query = $this->db->query($sql);
	   return $query;
	}
	function getpasien($id_layanan,$posisi,$baris,$isperiksa="N"){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' and isperiksa='".$isperiksa."' 
		       and ps.nama_pasien like '%".$this->input->post("nama")."%'";
		$cond.=" and p.id_layanan='".$id_layanan."' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql="select p.*,ps.nama_pasien,ps.no_kk,ps.no_pasien,l.layanan,pm.nama_paramedis from pendaftaran p ".
		"left join pasien ps on ps.id_pasien=p.id_pasien ".
		"left join layanan l on l.id_layanan=p.id_layanan ".
		"left join paramedis pm on pm.id_paramedis=p.id_paramedis ".				
		$cond." order by p.tanggal desc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getjumlahpasien($id_layanan,$isperiksa="N"){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' and isperiksa='".$isperiksa."'
		       and nama_pasien like '%".$this->input->post("nama")."%'";
		$cond.=" and p.id_layanan='".$id_layanan."' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql= "select count(*) as jumlah from pendaftaran p 
		       left join pasien ps on ps.id_pasien=p.id_pasien ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getkbdetail($id_pendaftaran,$id_pasien_kb){
		$sql= "select kb.*,year(sysdate())-ps.tahun_lahir as umur,pu.nama_puskesmas,pd.id_paramedis, pa.nama_paramedis,pd.tanggal as tanggal_periksa ,".
				"ps.nama_pasien,ps.no_kk,ps.no_pasien,ps.id_pasien,ps.id_puskesmas, pd.id_layanan, t.nama_tindakan,t.karcis,kb.keadaan_umum as keluhan ".
				"from pasien_1_kb kb ".
				"left join pendaftaran pd on pd.id_pendaftaran=kb.id_pendaftaran ".
				"left join pasien ps on ps.id_pasien=pd.id_pasien ".
				"left join puskesmas pu on pu.id_puskesmas=ps.id_puskesmas ".
				"left join paramedis pa on pa.id_paramedis=pd.id_paramedis ".
			    "left join tindakan t on t.id_tindakan=kb.id_tindakan ".
				"where kb.id_pasien_kb='".$id_pasien_kb."' and kb.id_pendaftaran='".$id_pendaftaran."'";		
		$query = $this->db->query($sql);
		return $query;
	}
	function getkbid_pasien($id_pendaftaran){
		$sql= "select kb.* ".
				"from pasien_1_kb kb ".
				"where kb.id_pendaftaran='".$id_pendaftaran."'";		
		$query = $this->db->query($sql);
		return $query;
	}
	function getstatuskb(){
		$sql = "select * from status_kb";
		$query = $this->db->query($sql);
		return $query;
	}
	function simpankb($action){
		switch ($action){
		case 'simpan' :
		$strsql="insert pasien_1_kb set
					id_pasien_kb='".$this->input->post('id_pasien_kb')."',
					id_pendaftaran='".$this->input->post('id_pendaftaran')."', 
					no_kode_klinik_k3='".$this->input->post('no_kode_klinik_k3')."', 
					no_seri_kartu='".$this->input->post('no_seri_kartu')."',
					id_status_pesertakb='".$this->input->post('id_status_pesertakb')."',
					cara_kb_terakhir='".$this->input->post('cara_kb_terakhir')."',
					jumlah_anak_hidup='".$this->input->post('jumlah_anak_hidup')."',
					jumlah_anak_unhidup='".$this->input->post('jumlah_anak_unhidup')."',
					keadaan_umum='".$this->input->post('keadaan_umum')."',
					tekanan_darah='".$this->input->post('tekanan_darah')."',
					status_kehamilan='".$this->input->post('status_kehamilan')."',
					tgl_haid_terakhir='".date('Y-m-d',strtotime($this->input->post('tgl_haid_terakhir')))."',
					berat_badan='".$this->input->post('berat_badan')."',
					status_sakit_kuning='".$this->input->post('status_sakit_kuning')."',
					status_pendarahan='".$this->input->post('status_pendarahan')."',
					status_tumor_payudara='".$this->input->post('status_tumor_payudara')."',
					status_tumor_rahim='".$this->input->post('status_tumor_rahim')."',
					status_tumor_indung='".$this->input->post('status_tumor_indung')."',
					posisi_rahim='".$this->input->post('posisi_rahim')."',
					status_tanda_radang='".$this->input->post('status_tanda_radang')."',
					status_tumor_ganas='".$this->input->post('status_tumor_ganas')."',
					status_diabetes='".$this->input->post('status_diabetes')."',
					status_beku_darah='".$this->input->post('status_beku_darah')."',
					status_orchitis='".$this->input->post('status_orchitis')."',
					alat_kontr_ok='".$this->input->post('alat_kontr_ok')."',
					alat_kontr_ok2='".$this->input->post('alat_kontr_ok2')."',
					tgl_dilayani='".date('Y-m-d',strtotime($this->input->post('tgl_dilayani')))."',
					tgl_pesan_kembali='".date('Y-m-d',strtotime($this->input->post('tgl_pesan_kembali')))."',
					tgl_dilepas='".date('Y-m-d',strtotime($this->input->post('tgl_dilepas')))."',
					id_tindakan='".$this->input->post('id_tindakan')."',
					pemeriksa='".$this->input->post('pemeriksa')."'";
		break;
		case 'edit' :
			$strsql="update pasien_1_kb set
					no_kode_klinik_k3='".$this->input->post('no_kode_klinik_k3')."', 
					no_seri_kartu='".$this->input->post('no_seri_kartu')."',
					id_status_pesertakb='".$this->input->post('id_status_pesertakb')."',
					cara_kb_terakhir='".$this->input->post('cara_kb_terakhir')."',
					jumlah_anak_hidup='".$this->input->post('jumlah_anak_hidup')."',
					jumlah_anak_unhidup='".$this->input->post('jumlah_anak_unhidup')."',
					keadaan_umum='".$this->input->post('keadaan_umum')."',
					tekanan_darah='".$this->input->post('tekanan_darah')."',
					status_kehamilan='".$this->input->post('status_kehamilan')."',
					tgl_haid_terakhir='".date('Y-m-d',strtotime($this->input->post('tgl_haid_terakhir')))."',
					berat_badan='".$this->input->post('berat_badan')."',
					status_sakit_kuning='".$this->input->post('status_sakit_kuning')."',
					status_pendarahan='".$this->input->post('status_pendarahan')."',
					status_tumor_payudara='".$this->input->post('status_tumor_payudara')."',
					status_tumor_rahim='".$this->input->post('status_tumor_rahim')."',
					status_tumor_indung='".$this->input->post('status_tumor_indung')."',
					posisi_rahim='".$this->input->post('posisi_rahim')."',
					status_tanda_radang='".$this->input->post('status_tanda_radang')."',
					status_tumor_ganas='".$this->input->post('status_tumor_ganas')."',
					status_diabetes='".$this->input->post('status_diabetes')."',
					status_beku_darah='".$this->input->post('status_beku_darah')."',
					status_orchitis='".$this->input->post('status_orchitis')."',
					alat_kontr_ok='".$this->input->post('alat_kontr_ok')."',
					alat_kontr_ok2='".$this->input->post('alat_kontr_ok2')."',
					tgl_dilayani='".date('Y-m-d',strtotime($this->input->post('tgl_dilayani')))."',
					tgl_pesan_kembali='".date('Y-m-d',strtotime($this->input->post('tgl_pesan_kembali')))."',
					tgl_dilepas='".date('Y-m-d',strtotime($this->input->post('tgl_dilepas')))."',
					id_tindakan='".$this->input->post('id_tindakan')."',
					pemeriksa='".$this->input->post('pemeriksa')."' 
					where id_pasien_kb='".$this->input->post('id_pasien_kb')."'";
		break;
		}
		$this->db->query($strsql);
		$sql = "update pendaftaran set isperiksa='Y' where id_pendaftaran='".$this->input->post('id_pendaftaran')."'";
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function hapuskbdetail($id_pasien_kb){
		$sql = "delete from pasien_1_kb where id_pasien_kb='".$id_pasien_kb."'";
		$this->db->query($sql);
		$sql = "update pendaftaran set iscatat='N',isperiksa='N' where id_pasien='".$id_pasien_kb."'";
		$this->db->query($sql);
		return "<div class='alert alert-danger'>Data berhasil dihapus..</div>";
	}
}