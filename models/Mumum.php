<?php
class Mumum extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
	function getstatuspembayaran(){
       $sql = "select * from status_pembayaran order by status_pembayaran";
       $query = $this->db->query($sql);
	   return $query;
	}
	function getpasien($posisi,$baris,$isperiksa='N'){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."'  and isperiksa='".$isperiksa."' and nama_pasien like '%".$this->input->post('nama')."%'";
		$cond.=" and p.id_layanan='".$this->session->userdata('id_layanan')."' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql="select p.*,ps.nama_pasien,ps.no_kk,ps.no_pasien,l.layanan,pm.nama_paramedis from pendaftaran p ".
		"left join pasien ps on ps.id_pasien=p.id_pasien ".
		"left join layanan l on l.id_layanan=p.id_layanan ".
		"left join paramedis pm on pm.id_paramedis=p.id_paramedis ".				
		$cond." order by p.tanggal desc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getjumlahpasien($isperiksa='N'){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."'  and isperiksa='".$isperiksa."' and nama_pasien like '%".$this->input->post('nama')."%'";
		$cond.=" and p.id_layanan='".$this->session->userdata('id_layanan')."' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql= "select count(*) as jumlah from pendaftaran p 
				left join pasien ps on ps.id_pasien=p.id_pasien ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getjumlahpenyakit(){
		$cond = "";
		if ($this->input->post('cari')!="") {
			$cond .= " where nama_penyakit like '%".$this->input->post('cari')."%'";
		}
		$sql=	"select count(*) as jumlah from penyakit ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getpenyakit($posisi,$baris){
		$sql=	"select * from penyakit 
				where nama_penyakit like '%".$this->input->post('cari')."%' order by id_penyakit asc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getpenyakit_autocomplete(){
		$sql=	"select * from penyakit";
		$query = $this->db->query($sql);
		return $query;
	}
	function tindakan_bpumum(){
		$sql = "select * from bpumum_tindakan order by nama_tindakan";
		$query = $this->db->query($sql);
		return $query;
	}
	function gettindakan_autocomplete(){
		$sql=	"select * from tindakan";
		$query = $this->db->query($sql);
		return $query;
	}
	function status_kasus(){
		$sql = "select * from status_kasus order by status_kasus";
		$query = $this->db->query($sql);
		return $query;
	}
	function getumumdetail($id_pendaftaran,$id_bpumum){
		$sql = "select bp.*,pe.nama_penyakit,t.nama_tindakan,t.karcis, b.keluhan from detail_bpumum bp ".
				"left join bpumum b on b.id_bpumum=bp.id_bpumum and b.id_pendaftaran=bp.id_pendaftaran ".
   				"left join penyakit pe on pe.id_penyakit=bp.id_penyakit ".
   				"left join tindakan t on(t.id_tindakan=bp.id_tindakan) ".	
				"where bp.id_bpumum='".$id_bpumum."' and bp.id_pendaftaran='".$id_pendaftaran."' order by bp.id_detail desc";
		$query = $this->db->query($sql);
		return $query;
	}
	function getumum($id_pendaftaran){
		$sql = "select bp.*,pu.nama_puskesmas,pd.id_paramedis, pa.nama_paramedis,pd.tanggal as tanggal_periksa ,".
				"ps.nama_pasien,ps.no_kk,ps.no_pasien,ps.id_puskesmas, pd.id_layanan ".
				"from bpumum bp ".
				"left join pendaftaran pd on pd.id_pendaftaran=bp.id_pendaftaran ".
				"left join pasien ps on ps.id_pasien=pd.id_pasien ".
				"left join puskesmas pu on pu.id_puskesmas=ps.id_puskesmas ".
				"left join paramedis pa on pa.id_paramedis=pd.id_paramedis ".
				"where bp.id_pendaftaran='".$id_pendaftaran."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getparamedis(){
		$sql = "select * from paramedis 
		        where id_puskesmas='".$this->session->userdata('id_puskesmas')."' 
		        and id_layanan='".$this->session->userdata('id_layanan')."' order by nama_paramedis";
		$query = $this->db->query($sql);
		return $query;
	}
	function getpasienlab($id_pendaftaran){
		$sql = "select b.id_pasien_lab,b.id_lab,a.nama_lab,b.keterangan from pasien_lab b 
   				left join lab a on a.id_lab=b.id_lab where b.id_pendaftaran='".$id_pendaftaran."' 
   				and id_layanan=".$this->session->userdata("id_layanan")." order by b.id_pendaftaran desc";
   		$q = $this->db->query($sql);
   		return $q;
	}
	function simpanumum($action){
		switch ($action) {
			case 'simpan':
			$sql="insert into bpumum 
        		 set id_bpumum = '".$this->input->post('id_bpumum')."',
        		 id_pendaftaran='".$this->input->post('id_pendaftaran')."',
        		 nip='".$this->input->post('nip')."',
        		 tekanan_darah='".$this->input->post('tekanan_darah')."',
        		 berat_badan='".$this->input->post('berat_badan')."',
        		 rujukan='".$this->input->post('rujukan')."',
        		 ket_rujukan='".$this->input->post('ket_rujukan')."',
        		 keluhan='".$this->input->post('keluhan')."',
        		 umur='".$this->input->post('umur')."',
        		 tgl_kunjungan='".date('Y-m-d',strtotime($this->input->post('tgl_kunjungan')))."'";
        	break;
        	case 'edit' :
        	$sql="update bpumum 
        		 set
        		 nip='".$this->input->post('nip')."',
        		 tekanan_darah='".$this->input->post('tekanan_darah')."',
        		 berat_badan='".$this->input->post('berat_badan')."',
        		 rujukan='".$this->input->post('rujukan')."',
        		 ket_rujukan='".$this->input->post('ket_rujukan')."',
        		 keluhan='".$this->input->post('keluhan')."',
        		 umur='".$this->input->post('umur')."',
        		 tgl_kunjungan='".date('Y-m-d',strtotime($this->input->post('tgl_kunjungan')))."' where id_bpumum='".$this->input->post('id_bpumum')."'";
        	break;
    	}	
        $this->db->query($sql);
		return "success-Data berhasil disimpan...";
	}
	function simpanpenyakit_pasien(){
		if ($this->input->post('id_penyakit')==""){
			$sql = "insert into penyakit set nama_penyakit='".$this->input->post('nama_penyakit')."'";
			$this->db->query($sql);
			$sql = "select * from penyakit where nama_penyakit='".$this->input->post('nama_penyakit')."'";
			$q = $this->db->query($sql)->row();
			$id_penyakit = $q->id_penyakit;
		} else {
			$id_penyakit = $this->input->post('id_penyakit');
		}
		if ($this->input->post('id_tindakan')==""){
			$sql = "insert into tindakan set nama_tindakan='".$this->input->post('nama_tindakan')."'";
			$this->db->query($sql);
			$sql = "select * from tindakan where nama_tindakan='".$this->input->post('nama_tindakan')."'";
			$q = $this->db->query($sql)->row();
			$id_tindakan = $q->id_tindakan;
		} else {
			$id_tindakan = $this->input->post('id_tindakan');
		}
		$sql = "insert into detail_bpumum set
		        id_bpumum='".$this->input->post('id_bpumum')."',
		        id_pendaftaran='".$this->input->post('id_pendaftaran')."',
		        id_penyakit='".$id_penyakit."',
		        id_tindakan='".$id_tindakan."',
		        status_kasus='".$this->input->post('status_kasus')."'";
		$this->db->query($sql);
		return "success-Data berhasil disimpan...";
	}
	function hapuspenyakit($id){
		$sql = "delete from detail_bpumum where id_detail='".$id."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus...";
	}
	function simpanresep(){
		if ($this->input->post('id_obat')==""){
			$sql = "insert into obat set nama_obat='".$this->input->post('nama_obat')."',satuan='BH', kategori_obat='OBAT'";
			$this->db->query($sql);
			$sql = "select * from obat where nama_obat='".$this->input->post('nama_obat')."'";
			$q = $this->db->query($sql)->row();
			$id_obat = $q->id_obat;
		} else $id_obat = $this->input->post('id_obat');
		$sql = "insert into bpumum_resep set
		        id_pendaftaran='".$this->input->post('id_pendaftaran')."',
		        id_obat='".$id_obat."',
		        aturan_pakai='".$this->input->post('aturan_pakai')."',
		        jml_pemakaian='".$this->input->post('jml_pemakaian')."'";
		$this->db->query($sql);
		return "<div class='alert alert-info'>Data berhasil disimpan..</div>";
	}
	function getjumlahobat(){
		$cond = "";
		if ($this->input->post('cari')!="") {
			$cond .= " where nama_obat like '%".$this->input->post('cari')."%'";
		}
		$sql=	"select count(*) as jumlah from obat ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getobat($posisi,$baris){
		$sql=	"select * from obat 
				where nama_obat like '%".$this->input->post('cari')."%' order by id_obat asc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getobat_autocomplete(){
		$sql=	"select * from obat";
		$query = $this->db->query($sql);
		return $query;
	}
	function getresepobat($id_pendaftaran){
		$sql = "select * from bpumum_resep br
				inner join obat o on(o.id_obat=br.id_obat)
				where br.id_pendaftaran='".$id_pendaftaran."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function hapusresep($id){
		$sql = "delete from bpumum_resep where id_resep='".$id."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus...";
	}
	function hapuspasien_igd($id_pendaftaran,$id){
		$sql = "delete from bpumum where id_pendaftaran='".$id_pendaftaran."' and id_bpumum='".$id."'";
		$this->db->query($sql);
		$sql = "delete from bpumum_resep where id_pendaftaran='".$id_pendaftaran."'";
		$this->db->query($sql);
		$sql = "delete from detail_bpumum where id_bpumum='".$id."'";
		$this->db->query($sql);
		$sql = "delete from pasien_lab where id_pendaftaran='".$id_pendaftaran."'";
		$this->db->query($sql);
		$sql = "update pendaftaran set isperiksa='N',iscatat='N' where id_pendaftaran='".$id_pendaftaran."' and id_pasien='".$id."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus...";
	}
	function simpanpenyakit(){
		$sql = "insert into penyakit set nama_penyakit='".$this->input->post('nama_penyakit')."'";
		$this->db->query($sql);
	}
	function simpanobat(){
		$sql = "insert into obat set nama_obat='".$this->input->post('nama_obat')."',satuan='BH', kategori_obat='OBAT'";
		$this->db->query($sql);
	}
	function getlab_autocomplete(){
		$sql = "select * from lab";
		$q = $this->db->query($sql);
		return $q;
	}
	function getinap($id_pendaftaran){
		$q = $this->db->where("id_pendaftaran",$id_pendaftaran);
		$q = $this->db->get("pendaftaran_rawatinap");
		return $q->row();
	}
	function getpasien2($id_pendaftaran){
		$q = $this->db->select("p.*,ps.*,kec.nama_kecamatan,kel.nama_kelurahan");
		$q = $this->db->join("pasien ps","ps.id_pasien=p.id_pasien","inner");
		$q = $this->db->join("kecamatan kec","kec.id_kecamatan=ps.id_kecamatan","left");
		$q = $this->db->join("kelurahan kel","kel.id_kelurahan=ps.id_kelurahan","left");
		$q = $this->db->where("id_pendaftaran",$id_pendaftaran);
		$q = $this->db->get("pendaftaran p");
		return $q->row();
	}
	function getkelas(){
		$q = $this->db->order_by("nama_kelas");
		$q = $this->db->get("kelas");
		return $q;
	}
	function simpaninap(){
		$data = array(
				'id_pendaftaran' => $this->input->post("id_pendaftaran"),
				'nama' => $this->input->post("nama"),
				'jk' => $this->input->post("jk"),
				'alamat' => $this->input->post("alamat"),
				'kota' => $this->input->post("kota"),
				'kecamatan' => $this->input->post("kecamatan"),
				'kelurahan' => $this->input->post("kelurahan"),
				'rw' => $this->input->post("rw"),
				'rt' => $this->input->post("rt"),
				'telp' => $this->input->post("telp"),
				'tempat_lahir' => $this->input->post("tempat_lahir"),
				'tgl_daftar' => $this->input->post("tgl_masuk"),
				'tgl_lahir' => date('Y-m-d',strtotime($this->input->post("tgl_lahir"))),
				'agama' => $this->input->post("agama"),
				'penanggung' => $this->input->post("penanggung"),
				'hubungan' => $this->input->post("hubungan"),
				'kelas' => $this->input->post("kelas"),
				'pembayaran' => $this->input->post("pembayaran"),
				'total_biaya' => $this->input->post("total_biaya"),
				);
		$this->db->insert('pendaftaran_rawatinap',$data);
		return "success-Pasien di rujuk ke rawat inap";
	}
}