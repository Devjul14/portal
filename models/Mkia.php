<?php
class Mkia extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
	function getstatuspembayaran(){
       $sql = "select * from status_pembayaran order by status_pembayaran";
       $query = $this->db->query($sql);
	   return $query;
	}
	function getpasien($posisi,$baris,$isperiksa="N"){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' and isperiksa='".$isperiksa."' 
		       and ps.nama_pasien like '%".$this->input->post("nama")."%'";
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
	function getjumlahpasien($isperiksa="N"){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' and isperiksa='".$isperiksa."'
		       and nama_pasien like '%".$this->input->post("nama")."%'";
		$cond.=" and p.id_layanan='".$this->session->userdata('id_layanan')."' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql= "select count(*) as jumlah from pendaftaran p 
		       left join pasien ps on ps.id_pasien=p.id_pasien ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getbumildetail($id_bumil){
		$sql= "select bp.*,year(sysdate())-ps.tahun_lahir as umur,pu.nama_puskesmas,pd.id_paramedis, pa.nama_paramedis,pd.tanggal as tanggal_periksa ,".
				 "ps.nama_pasien,ps.no_kk,ps.no_pasien,ps.id_pasien,ps.id_puskesmas, pd.id_layanan ".
				 "from bumil bp ".
				 "left join pendaftaran pd on pd.id_pendaftaran=bp.id_pendaftaran ".
				 "left join pasien ps on ps.no_pasien=pd.id_pasien ".
				 "left join puskesmas pu on pu.id_puskesmas=ps.id_puskesmas ".
				 "left join paramedis pa on pa.id_paramedis=pd.id_paramedis ".
				 "where bp.id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getsubyektifdata($id_pendaftaran,$id_bumil){
		$sql= "select sb.* ".
				 "from subyektif_bumil sb ".
				 "left join pendaftaran pd on pd.id_pendaftaran=bp.id_pendaftaran ".
				 "left join pasien ps on ps.no_pasien=pd.id_pasien ".
				 "left join puskesmas pu on pu.id_puskesmas=ps.id_puskesmas ".
				 "left join paramedis pa on pa.id_paramedis=pd.id_paramedis ".
				 "where sb.id_pendaftaran='".$id_pendaftaran."' and sb.id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getpersalinandetail($id_bumil){
		$sql="select * from bumil_persalinan where id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getjumlahtindakanbumil(){
		$sql=	"select count(*) as jumlah from tindakan";
		$query = $this->db->query($sql);
		return $query;
	}
	function getjumlahlab(){
		$sql=	"select count(*) as jumlah from lab";
		$query = $this->db->query($sql);
		return $query;
	}
	function gettindakanbumil($posisi,$baris){
		$cond = "";
		if ($this->input->post('id_aksi')!="") {
			$cond .= " where id_aksi='".$this->input->post('id_aksi')."'";
		}
		$sql=	"select * from detail_bumil ".$cond." order by id_detail_bumil asc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getlab($posisi,$baris){
		$sql=	"select * from lab order by id_lab asc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getaksibumil($posisi,$baris){
		$sql=	"select * from tindakan limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function gettindakan_autocomplete(){
		$sql=	"select * from tindakan";
		$query = $this->db->query($sql);
		return $query;
	}
	function simpananc($action){
		switch ($action){
		case 'simpan' :
		$strsql="insert into detail_antenatal_care
				set 
					id_bumil='".$this->input->post('id_bumil')."',
					id_pendaftaran='".$this->input->post('id_pendaftaran')."',
					keluhan='".$this->input->post('keluhan')."',
					tgl='".date('Y-m-d',strtotime($this->input->post('tgl')))."',
					tekanan_darah='".$this->input->post('tekanan_darah')."',
					berat_badan='".$this->input->post('berat_badan')."',
					umur_kehamilan='".$this->input->post('umur_kehamilan')."',
					tinggi_fundus='".$this->input->post('tinggi_fundus')."',
					letak_janin='".$this->input->post('letak_janin')."',
					denyut_jantung_janin='".$this->input->post('denyut_jantung_janin')."',
					hb='".$this->input->post('hb')."',
					gol_darah='".$this->input->post('gol_darah')."',
					tindakan='".$this->input->post('tindakan')."',
					penyuluhan='".$this->input->post('penyuluhan')."',
					nadi='".$this->input->post('nadi')."',
					keterangan='".$this->input->post('keterangan.')."',
					tgl_kunjungan='".date('Y-m-d',strtotime($this->input->post('tgl_kunjungan')))."'";
		break;
		case 'edit' :
		$strsql="update detail_antenatal_care
				set 
					keluhan='".$this->input->post('keluhan')."',
					tekanan_darah='".$this->input->post('tekanan_darah')."',
					berat_badan='".$this->input->post('berat_badan')."',
					umur_kehamilan='".$this->input->post('umur_kehamilan')."',
					tgl='".date('Y-m-d',strtotime($this->input->post('tgl')))."',
					tinggi_fundus='".$this->input->post('tinggi_fundus')."',
					letak_janin='".$this->input->post('letak_janin')."',
					denyut_jantung_janin='".$this->input->post('denyut_jantung_janin')."',
					hb='".$this->input->post('hb')."',
					gol_darah='".$this->input->post('gol_darah')."',
					tindakan='".$this->input->post('tindakan')."',
					penyuluhan='".$this->input->post('penyuluhan')."',
					nadi='".$this->input->post('nadi')."',
					keterangan='".$this->input->post('keterangan.')."',
					tgl_kunjungan='".date('Y-m-d',strtotime($this->input->post('tgl_kunjungan')))."' 
					where id_antenatal_care='".$this->input->post('id_antenatal_care')."'";
		break;
		}
		$this->db->query($strsql);
		$sql = "update pendaftaran set isperiksa='Y' where id_pendaftaran='".$this->input->post('id_pendaftaran')."'";
		$this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function getnopasien($id_pendaftaran){
		$sql = "select b.no_pasien from pendaftaran a 
				inner join pasien b on(b.id_pasien=a.id_pasien)
				where id_pendaftaran='".$id_pendaftaran."'";
		$query = $this->db->query($sql)->row();
		return $query->no_pasien;
	}
	function getancdetail($id_bumil){
		$strsql = "select a.*,t.nama_tindakan,t.karcis from detail_antenatal_care a
				   left join tindakan t on(t.id_tindakan=a.tindakan)
		           where a.id_bumil='".$id_bumil."'";
		$q = $this->db->query($strsql);
		return $q;
	}
	function getobat_autocomplete(){
		$sql=	"select * from obat";
		$query = $this->db->query($sql);
		return $query;
	}
	function getanctgl($id){
		$strsql = "select a.*,t.nama_tindakan from detail_antenatal_care a 
					left join tindakan t on(t.id_tindakan=a.tindakan)
					where a.id_antenatal_care='".$id."'";
		$q = $this->db->query($strsql);
		return $q->row();
	}
	function simpanbumil($action){
		switch ($action){
			case 'simpan' :
			$strsql="insert into bumil set 
			id_bumil='".$this->input->post('id_bumil')."',
			id_pendaftaran='".$this->input->post('id_pendaftaran')."',
		 	tinggi_badan='".$this->input->post('tinggi_badan')."', 
	     	lila='".$this->input->post('lila')."',
	     	tgl_haid_terakhir='".date('Y-m-d',strtotime($this->input->post('tgl_haid_terakhir')))."',
	     	tgl_taksiran_persalinan='".date('Y-m-d',strtotime($this->input->post('tgl_taksiran_persalinan')))."',
	    	keluhan_utama='".$this->input->post('keluhan_utama')."',
	    	jml_anak_rencana='".$this->input->post('jml_anak_rencana')."',
	   	 	datang_atas_petunjuk='".$this->input->post('datang_atas_petunjuk')."',
	     	perlakuan_kasar_suami='".$this->input->post('perlakuan_kasar_suami')."',
	     	keluhan_keputihan='".$this->input->post('keluhan_keputihan')."',
	     	gravida='".$this->input->post('gravida')."',
		 	partus='".$this->input->post('partus')."',
		 	abortus='".$this->input->post('abortus')."',
	     	jml_anak_hidup='".$this->input->post('jml_anak_hidup')."',
		 	jml_lahir_mati='".$this->input->post('jml_lahir_mati')."',
	     	jarak_persalinan_akhir='".$this->input->post('jarak_persalinan_akhir')."',
	     	penolong_persalinan_akhir='".$this->input->post('penolong_persalinan_akhir')."',
	     	cara_persalinan_akhir='".$this->input->post('cara_persalinan_akhir')."',
	     	placenta_lahir='".$this->input->post('placenta_lahir')."',
	     	penggunaan_kntrs_akhir='".$this->input->post('penggunaan_kntrs_akhir')."',
		 	ket_rujukan='".$this->input->post('ket_rujukan')."',
		 	rujukan='".$this->input->post('rujukan')."'";
			break;
			case 'edit' :
			$strsql="update bumil set 
		 	tinggi_badan='".$this->input->post('tinggi_badan')."', 
	     	lila='".$this->input->post('lila')."',
	     	tgl_haid_terakhir='".date('Y-m-d',strtotime($this->input->post('tgl_haid_terakhir')))."',
	     	tgl_taksiran_persalinan='".date('Y-m-d',strtotime($this->input->post('tgl_taksiran_persalinan')))."',
	     	keluhan_utama='".$this->input->post('keluhan_utama')."',
	     	jml_anak_rencana='".$this->input->post('jml_anak_rencana')."',
	     	datang_atas_petunjuk='".$this->input->post('datang_atas_petunjuk')."',
	     	perlakuan_kasar_suami='".$this->input->post('perlakuan_kasar_suami')."',
	     	keluhan_keputihan='".$this->input->post('keluhan_keputihan')."',
	     	gravida='".$this->input->post('gravida')."',
		 	partus='".$this->input->post('partus')."',
		 	abortus='".$this->input->post('abortus')."',
	     	jml_anak_hidup='".$this->input->post('jml_anak_hidup')."',
		 	jml_lahir_mati='".$this->input->post('jml_lahir_mati')."',
	     	jarak_persalinan_akhir='".$this->input->post('jarak_persalinan_akhir')."',
	     	penolong_persalinan_akhir='".$this->input->post('penolong_persalinan_akhir')."',
	     	cara_persalinan_akhir='".$this->input->post('cara_persalinan_akhir')."',
	     	placenta_lahir='".$this->input->post('placenta_lahir')."',
	     	penggunaan_kntrs_akhir='".$this->input->post('penggunaan_kntrs_akhir')."',
		 	ket_rujukan='".$this->input->post('ket_rujukan')."',
		 	rujukan='".$this->input->post('rujukan')."'
		 	where id_bumil='".$this->input->post('id_bumil')."'";
			break;
		}
		$this->db->query($strsql);
		$sql = "update pendaftaran set iscatat='Y' where id_pendaftaran='".$this->input->post('id_pendaftaran')."'";
		$this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapusbumildetail($id_bumil){
		$sql = "delete from bumil where id_bumil='".$id_bumil."'";
		$this->db->query($sql);
		$sql = "delete from detail_antenatal_care where id_bumil='".$id_bumil."'";
		$this->db->query($sql);
		$sql = "update pendaftaran set iscatat='N',isperiksa='N' where id_pasien='".$id_bumil."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function getpasienlab($id_pendaftaran){
		$sql = "select b.id_pasien_lab,b.id_lab,a.nama_lab,b.keterangan from pasien_lab b 
   				left join lab a on a.id_lab=b.id_lab where b.id_pendaftaran='".$id_pendaftaran."' 
   				and id_layanan=".$this->session->userdata("id_layanan")." order by b.id_pendaftaran desc";
   		$q = $this->db->query($sql);
   		return $q;
	}
	function gettindakan($id_bumil){
		$sql = "select b.*, a.nama_tindakan from bumil_persalinan_2 b 
   				left join tindakan a on (a.id_tindakan=b.id_detail_bumil) 
				where b.id_bumil='".$id_bumil."'";
   		$q = $this->db->query($sql);
   		return $q;
	}
	function getbayi_imunisasi($id_bayi){
		$sql = "select b.*, p.tanggal,i.nama_imunisasi,i.karcis from bayi_imunisasi b 
   				left join pendaftaran p on (p.id_pendaftaran=b.id_pendaftaran) 
				left join imunisasi i on(i.id_imunisasi=b.id_imunisasi)
				where b.id_bayi='".$id_bayi."'";
   		$q = $this->db->query($sql);
   		return $q;
	}
	function simpanpasienlab(){
		if ($this->input->post('id_lab')==""){
			$sql = "insert into lab set nama_lab='".$this->input->post('nama_lab')."'";
			$this->db->query($sql);
			$sql = "select * from lab where nama_lab='".$this->input->post('nama_lab')."'";
			$q = $this->db->query($sql)->row();
			$id_lab = $q->id_lab;
		} else $id_lab = $this->input->post('id_lab');
		$sql = "insert into pasien_lab set 
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_lab='".$id_lab."',
				keterangan='".$this->input->post('keterangan')."',
				id_layanan='".$this->session->userdata('id_layanan')."'";
		$this->db->query($sql);
		return "success- berhasil disimpan..";
	}
	function simpanimunisasi(){
		$sql = "insert into bayi_imunisasi set 
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_bayi='".$this->input->post('id_bayi')."',
				id_imunisasi='".$this->input->post('id_imunisasi')."'";
		$this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function simpantindakan(){
		if ($this->input->post('id_detail_bumil')==""){
			$sql = "insert into tindakan set nama_tindakan='".$this->input->post('nama_detail_bumil')."'";
			$this->db->query($sql);
			$sql = "select * from tindakan where nama_tindakan='".$this->input->post('nama_detail_bumil')."'";
			$q = $this->db->query($sql)->row();
			$id_tindakan = $q->id_tindakan;
		} else $id_tindakan = $this->input->post('id_detail_bumil');
		$sql="insert into bumil_persalinan_2 
        		 set id_bumil='".$this->input->post('id_bumil')."',
        		 id_detail_bumil='".$id_tindakan."',
        		 nilai_id_detail_bumil='".$this->input->post('nilai_id_detail_bumil')."' ";
        $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapuspasienlab($id){
		$sql = "delete from pasien_lab where id_pasien_lab='".$id."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function hapusimunisasi($id_bayi,$id_pendaftaran,$id_imunisasi){
		$sql = "delete from bayi_imunisasi where id_imunisasi='".$id_imunisasi."' and id_pendaftaran='".$id_pendaftaran."' and id_bayi='".$id_bayi."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function hapustindakan($id_bumil,$id){
		$sql = "delete from bumil_persalinan_2 where id_bumil='".$id_bumil."' and id_detail_bumil='".$id."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function simpanpersalinan($action){
		switch ($action) {
		case 'simpan':
			$strsql = "insert into bumil_persalinan set
					   id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				   	   id_bumil='".$this->input->post('id_bumil')."',
				   	   tgl_persalinan='".date('Y-m-d',strtotime($this->input->post('tgl_persalinan')))."',
				       waktu_jam='".$this->input->post('waktu_jam')."',
				       usia_klinis='".$this->input->post('usia_klinis')."',
				       usia_hpht='".$this->input->post('usia_hpht')."'";
			break;
		case 'edit' :
			$strsql = "update bumil_persalinan set
				   	   tgl_persalinan='".date('Y-m-d',strtotime($this->input->post('tgl_persalinan')))."',
				       waktu_jam='".$this->input->post('waktu_jam')."',
				       usia_klinis='".$this->input->post('usia_klinis')."',
				       usia_hpht='".$this->input->post('usia_hpht')."' where 
				       id_pendaftaran='".$this->input->post('id_pendaftaran')."' and 
				       id_bumil='".$this->input->post('id_bumil')."'";
			break;
		}
		$this->db->query($strsql);
		return "success-Data berhasil disimpan..";
	}
	function getjumlahpasien_kia($id_layanan,$isperiksa='N'){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' and isperiksa='".$isperiksa."' ";
		$cond.=" and p.id_layanan='".$id_layanan."' ";
		$cond.=" and ps.nama_pasien like '%".$this->input->post('nama')."%' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql= "select count(*) as jumlah from pendaftaran p 
				left join pasien ps on ps.id_pasien=p.id_pasien ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getpasien_kia($id_layanan,$posisi,$baris,$isperiksa='N'){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' and isperiksa='".$isperiksa."' ";
		$cond.=" and p.id_layanan='".$id_layanan."' ";
		$cond.=" and ps.nama_pasien like '%".$this->input->post('nama')."%' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql="select p.*,ps.nama_pasien,ps.no_kk,ps.no_pasien,l.layanan,pm.nama_paramedis from pendaftaran p ".
		"left join pasien ps on ps.id_pasien=p.id_pasien ".
		"left join layanan l on l.id_layanan=p.id_layanan ".
		"left join paramedis pm on pm.id_paramedis=p.id_paramedis ".				
		$cond." order by p.tanggal desc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getpasien_bblr($id_layanan,$posisi,$baris){
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
		$cond.=" and p.id_layanan='".$id_layanan."' ";
		$cond.=" and ps.nama_pasien like '%".$this->input->post('nama')."%' ";
		$sql="select p.*,ps.nama_pasien,ps.no_kk,ps.no_pasien,l.layanan,pm.nama_paramedis from bblr b ".
		"inner join pendaftaran p on p.id_pendaftaran=b.id_pendaftaran ".
		"inner join pasien ps on ps.id_pasien=p.id_pasien ".
		"left join layanan l on l.id_layanan=p.id_layanan ".
		"left join paramedis pm on pm.id_paramedis=p.id_paramedis ".				
		$cond." order by p.tanggal desc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function getjumlahpasien_bblr($id_layanan){
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
		$cond.=" and p.id_layanan='".$id_layanan."' ";
		$cond.=" and ps.nama_pasien like '%".$this->input->post('nama')."%' ";
		$sql= "select count(*) as jumlah from bblr b 
				inner join pendaftaran p on p.id_pendaftaran=b.id_pendaftaran 
				inner join pasien ps on ps.id_pasien=p.id_pasien ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getmtbmdetail($id_pendaftaran){
		$sql="select bp.*,pu.nama_puskesmas,pd.id_paramedis,pd.id_pendaftaran, pa.nama_paramedis,pd.tanggal as tanggal_periksa ,".
				"ps.nama_pasien,ps.tgl_lahir,ps.no_kk,ps.no_pasien,ps.id_pasien,ps.id_puskesmas, pd.id_layanan ".
				"from bayi_mtbm bp ".
				"left join pendaftaran pd on pd.id_pendaftaran=bp.id_pendaftaran ".
				"left join pasien ps on ps.id_pasien=pd.id_pasien ".
				"left join puskesmas pu on pu.id_puskesmas=ps.id_puskesmas ".
				"left join paramedis pa on pa.id_paramedis=pd.id_paramedis ".
				"where pd.id_pendaftaran='".$id_pendaftaran."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function simpanmtbm($action){
		switch ($action){
			case 'simpan' :
			$strsql="insert into bayi_mtbm set
					id_bayi='".$this->input->post('id_bayi')."', 
					id_pendaftaran='".$this->input->post('id_pendaftaran')."', 
					umur='".$this->input->post('umur')."',
		 			tgl_periksa='".date('d-m-Y',strtotime($this->input->post('tgl_periksa')))."',
	     			berat_badan='".$this->input->post('berat_badan')."',
	     			suhu_tubuh='".$this->input->post('suhu_tubuh')."',
	     			rujukan='".$this->input->post('rujukan')."',
	     			ket_rujukan='".$this->input->post('ket_rujukan')."'";
			break;
			case 'edit' :
			$strsql="update bayi_mtbm set 
					umur='".$this->input->post('umur')."',
		 			tgl_periksa='".date('d-m-Y',strtotime($this->input->post('tgl_periksa')))."',
	     			berat_badan='".$this->input->post('berat_badan')."',
	     			suhu_tubuh='".$this->input->post('suhu_tubuh')."',
	     			rujukan='".$this->input->post('rujukan')."',
	     			ket_rujukan='".$this->input->post('ket_rujukan')."'
		 			where id_bayi='".$this->input->post('id_bayi')."'";
			break;
		}
		$this->db->query($strsql);
		$sql = "update pendaftaran set iscatat='Y',isperiksa='Y' where id_pendaftaran='".$this->input->post('id_pendaftaran')."'";
		$this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function cekpasien($id_pendaftaran,$cek,$status){
		$sql = "select * from pendaftaran 
				where id_pendaftaran='".$id_pendaftaran."' and ".$cek."='".$status."'";
		$q = $this->db->query($sql);
		return $q;
	}
	function hapuspasien_mtbm($id_pendaftaran){
		$sql = "delete from bayi_mtbm where id_pendaftaran='".$id_pendaftaran."'";
		$this->db->query($sql);
		$sql = "update pendaftaran set isperiksa='N', iscatat='N' where id_pendaftaran='".$id_pendaftaran."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function getjumlahpasien_mtbm(){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql= "select count(*) as jumlah from bayi_mtbm b
			   inner join pendaftaran p on(p.id_pendaftaran=b.id_pendaftaran) ".$cond;
		$query = $this->db->query($sql);
		return $query;
	}
	function getpasien_mtbm($posisi,$baris){
		$tanggal1=$this->input->post("tgl1");
		$tanggal2=$this->input->post("tgl2");
		if($tanggal1=="") $tanggal1=date("Y-m-d"); else $tanggal1=date('Y-m-d',strtotime($tanggal1));
		if($tanggal2=="") $tanggal2=date("Y-m-d"); else $tanggal2=date('Y-m-d',strtotime($tanggal2));
		$cond =" where p.id_puskesmas='".$this->session->userdata('id_puskesmas')."' ";
		if($tanggal1!="") { $cond.=" and p.tanggal between '".$tanggal1."' and '".$tanggal2."'"; }
		$sql= "select * from bayi_mtbm b
			   inner join pendaftaran p on(p.id_pendaftaran=b.id_pendaftaran) 
			   inner join pasien ps on(ps.id_pasien=p.id_pasien) ".$cond." 
			   order by p.tanggal desc limit ".$posisi.",".$baris;
		$query = $this->db->query($sql);
		return $query;
	}
	function partograf($id_pendaftaran,$id_bumil){
		$sql = "select * from partograf where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	function partograf_airketuban($id_pendaftaran,$id_bumil){
		$sql = "select * from partograf_airketuban where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function partograf_djj($id_pendaftaran,$id_bumil){
		$sql = "select * from partograf_djj where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function partograf_kontraksi($id_pendaftaran,$id_bumil){
		$sql = "select * from partograf_kontraksi where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function partograf_servik($id_pendaftaran,$id_bumil){
		$sql = "select * from partograf_servik where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function partograf_akhir($id_pendaftaran,$id_bumil){
		$sql = "select * from partograf_akhir where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function simpan_djj(){
		$sql = "insert into partograf_djj set 
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_bumil='".$this->input->post('id_bumil')."',
				denyut_jantung='".$this->input->post('denyut_jantung')."',
				jam='".$this->input->post('jam')."'";
		$query = $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapus_djj($id){
		$sql = "delete from partograf_djj where id='".$id."'";
		$query = $this->db->query($sql);
		return "danger-Data berhasil disimpan..";
	}
	function simpan_airketuban(){
		$sql = "insert into partograf_airketuban set 
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_bumil='".$this->input->post('id_bumil')."',
				air_ketuban='".$this->input->post('air_ketuban')."',
				penyusupan='".$this->input->post('penyusupan')."',
				jam='".$this->input->post('jam')."'";
		$query = $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapus_airketuban($id){
		$sql = "delete from partograf_airketuban where id='".$id."'";
		$query = $this->db->query($sql);
		return "danger-Data berhasil disimpan..";
	}
	function simpan_servik(){
		$sql = "insert into partograf_servik set 
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_bumil='".$this->input->post('id_bumil')."',
				pembukaan_servik='".$this->input->post('pembukaan_servik')."',
				turun_kepala='".$this->input->post('turun_kepala')."',
				jam='".$this->input->post('jam')."'";
		$query = $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapus_servik($id){
		$sql = "delete from partograf_servik where id='".$id."'";
		$query = $this->db->query($sql);
		return "danger-Data berhasil disimpan..";
	}
	function simpan_kontraksi(){
		$sql = "insert into partograf_kontraksi set 
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_bumil='".$this->input->post('id_bumil')."',
				frekuensi='".$this->input->post('frekuensi')."',
				kontraksi='".$this->input->post('kontraksi')."',
				jam='".$this->input->post('jam')."'";
		$query = $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapus_kontraksi($id){
		$sql = "delete from partograf_kontraksi where id='".$id."'";
		$query = $this->db->query($sql);
		return "danger-Data berhasil disimpan..";
	}
	function simpan_akhir(){
		$sql = "insert into partograf_akhir set 
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_bumil='".$this->input->post('id_bumil')."',
				sistol='".$this->input->post('sistol')."',
				diastol='".$this->input->post('diastol')."',
				nadi='".$this->input->post('nadi')."',
				temperatur='".$this->input->post('temperatur')."',
				urin_protein='".$this->input->post('urin_protein')."',
				urin_aseton='".$this->input->post('urin_aseton')."',
				urin_volume='".$this->input->post('urin_volume')."',
				makan='".$this->input->post('makan')."',
				minum='".$this->input->post('minum')."',
				jam='".$this->input->post('jam')."'";
		$query = $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapus_akhir($id){
		$sql = "delete from partograf_akhir where id='".$id."'";
		$query = $this->db->query($sql);
		return "danger-Data berhasil disimpan..";
	}
	function simpan_partograf($action){
		switch ($action) {
			case 'simpan': 
					$sql = "insert into partograf set 
							id_pendaftaran='".$this->input->post('id_pendaftaran')."',
							id_bumil='".$this->input->post('id_bumil')."',
							ketuban_pecah_jam='".$this->input->post('ketuban_pecah_jam')."',
							mules_jam='".$this->input->post('mules_jam')."',
							jam_datang='".$this->input->post('jam_datang')."'";
					break;
			case 'edit' :
					$sql = "update partograf set 
							ketuban_pecah_jam='".$this->input->post('ketuban_pecah_jam')."',
							mules_jam='".$this->input->post('mules_jam')."',
							jam_datang='".$this->input->post('jam_datang')."'
							where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and id_bumil='".$this->input->post('id_bumil')."'";
					break;
		}
		$query = $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function simpanresep(){
		if ($this->input->post('id_obat')==""){
			$sql = "insert into obat set nama_obat='".$this->input->post('nama_obat')."',satuan='BH', kategori_obat='OBAT'";
			$this->db->query($sql);
			$sql = "select * from obat where nama_obat='".$this->input->post('nama_obat')."'";
			$q = $this->db->query($sql)->row();
			$id_obat = $q->id_obat;
		} else $id_obat = $this->input->post('id_obat');
		$sql = "insert into bumil_resep set
		        id_pendaftaran='".$this->input->post('id_pendaftaran')."',
		        id_obat='".$id_obat."',
		        aturan_pakai='".$this->input->post('aturan_pakai')."',
		        jml_pemakaian='".$this->input->post('jml_pemakaian')."'";
		$this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapusresep($id){
		$sql = "delete from bumil_resep where id_resep='".$id."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function getresepobat($id_pendaftaran){
		$sql = "select br.*,o.*,p.tanggal from bumil_resep br
				inner join obat o on(o.id_obat=br.id_obat)
				inner join pendaftaran p on(p.id_pendaftaran=br.id_pendaftaran)
				where br.id_pendaftaran='".$id_pendaftaran."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getaksibblr_autocomplete(){
		$sql = "select * from aksi_bblr";
		$query = $this->db->query($sql);
		return $query;
	}
	function getimunisasi_autocomplete(){
		$sql = "select * from imunisasi";
		$query = $this->db->query($sql);
		return $query;
	}
	function getbblr($id_pendaftaran,$id_bayi){
		$sql = "select b.*,d.nama_detail_bblr,a.nama_aksi_bblr from bblr b
				inner join detail_bblr d on(d.id_detail_bblr=b.id_detail_bblr)
				inner join aksi_bblr a on(a.id_aksi_bblr=d.id_aksi_bblr)
				where b.id_pendaftaran='".$id_pendaftaran."' and b.id_bayi='".$id_bayi."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function getdetailbblr_autocomplete($id_detail_bumil){
		$sql = "select * from detail_bblr where id_aksi_bblr='".$id_detail_bumil."'";
		$query = $this->db->query($sql);
		return $query;
	}
	function simpanbblr(){
		$sql = "insert into bblr set
				id_pendaftaran='".$this->input->post('id_pendaftaran')."',
				id_bayi='".$this->input->post('id_bayi')."',
				id_detail_bblr='".$this->input->post('id_detail_bblr2')."',
				nilai_detail_bblr='".$this->input->post('nilai_detail_bblr')."'";
		$query = $this->db->query($sql);
		return "success-Data berhasil disimpan..";
	}
	function hapusbblr($id){
		$sql = "delete from bblr where id_pendaftaran='".$id."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function hapusanc($id_antenatal_care){
		$sql = "delete from detail_antenatal_care where id_antenatal_care='".$id_antenatal_care."'";
		$this->db->query($sql);
		return "danger-Data berhasil dihapus..";
	}
	function simpan_subyektif($action){
		switch ($action){
			case 'simpan' :
					$sql = "insert into subyektif_bumil set 
						  id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						  id_bumil='".$this->input->post('id_bumil')."',
						  gravita='".$this->input->post('gravita')."',
						  partus='".$this->input->post('partus')."',
						  abortus='".$this->input->post('abortus')."',
						  umur_kehamilan='".$this->input->post('umur_kehamilan')."',
						  kontraksi_mulai_jam='".$this->input->post('kontraksi_mulai_jam')."',
						  kontraksi_tiap='".$this->input->post('kontraksi_tiap')."',
						  lama_kontraksi='".$this->input->post('lama_kontraksi')."',
						  rasa_kontraksi='".$this->input->post('rasa_kontraksi')."',
						  ketuban='".$this->input->post('ketuban')."',
						  warna_cairan='".$this->input->post('warna_cairan')."',
						  pendarahan='".$this->input->post('pendarahan')."',
						  volume_pendarahan='".$this->input->post('volume_pendarahan')."',
						  kondisi_pasien='".$this->input->post('kondisi_pasien')."',
						  keluhan='".$this->input->post('keluhan')."',
						  waktu='".$this->input->post('waktu')."'
						 ";
			break;
			case 'edit' :
					$sql = "update subyektif_bumil set 
						  gravita='".$this->input->post('gravita')."',
						  partus='".$this->input->post('partus')."',
						  abortus='".$this->input->post('abortus')."',
						  umur_kehamilan='".$this->input->post('umur_kehamilan')."',
						  kontraksi_mulai_jam='".$this->input->post('kontraksi_mulai_jam')."',
						  kontraksi_tiap='".$this->input->post('kontraksi_tiap')."',
						  lama_kontraksi='".$this->input->post('lama_kontraksi')."',
						  rasa_kontraksi='".$this->input->post('rasa_kontraksi')."',
						  ketuban='".$this->input->post('ketuban')."',
						  warna_cairan='".$this->input->post('warna_cairan')."',
						  pendarahan='".$this->input->post('pendarahan')."',
						  volume_pendarahan='".$this->input->post('volume_pendarahan')."',
						  kondisi_pasien='".$this->input->post('kondisi_pasien')."',
						  keluhan='".$this->input->post('keluhan')."',
						  waktu='".$this->input->post('waktu')."' 
						  where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and id_bumil='".$this->input->post("id_bumil")."'
						 ";
			break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-success'>Data berhasil disimpan..";
	}
	function simpan_obyektif($action){
		switch ($action){
			case 'simpan' :
					$sql = "insert into obyektif_bumil set 
						  id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						  id_bumil='".$this->input->post('id_bumil')."',
						  tekanan_darah='".$this->input->post('tekanan_darah')."',
						  nadi='".$this->input->post('nadi')."',
						  suhu='".$this->input->post('suhu')."',
						  pernafasan='".$this->input->post('pernafasan')."',
						  keadaan_umum='".$this->input->post('keadaan_umum')."',
						  penurunan_kepala='".$this->input->post('penurunan_kepala')."',
						  djj='".$this->input->post('djj')."',
						  kontraksi_persepuluhmenit='".$this->input->post('kontraksi_persepuluhmenit')."',
						  lama_kontraksi='".$this->input->post('lama_kontraksi')."',
						  pembukaan='".$this->input->post('pembukaan')."',
						  penurunan='".$this->input->post('penurunan')."',
						  posisi_kepala='".$this->input->post('posisi_kepala')."',
						  penyusupan='".$this->input->post('penyusupan')."',
						  ketuban2='".$this->input->post('ketuban2')."',
						  warna_cairan2='".$this->input->post('warna_cairan2')."',
						  pendarahan2='".$this->input->post('pendarahan2')."',
						  catatan='".$this->input->post('catatan')."',
						  waktu='".$this->input->post('waktu')."'
						 ";
			break;
			case 'edit' :
					$sql = "update obyektif_bumil set 
						  tekanan_darah='".$this->input->post('tekanan_darah')."',
						  nadi='".$this->input->post('nadi')."',
						  suhu='".$this->input->post('suhu')."',
						  pernafasan='".$this->input->post('pernafasan')."',
						  keadaan_umum='".$this->input->post('keadaan_umum')."',
						  penurunan_kepala='".$this->input->post('penurunan_kepala')."',
						  djj='".$this->input->post('djj')."',
						  kontraksi_persepuluhmenit='".$this->input->post('kontraksi_persepuluhmenit')."',
						  lama_kontraksi='".$this->input->post('lama_kontraksi')."',
						  pembukaan='".$this->input->post('pembukaan')."',
						  penurunan='".$this->input->post('penurunan')."',
						  posisi_kepala='".$this->input->post('posisi_kepala')."',
						  penyusupan='".$this->input->post('penyusupan')."',
						  ketuban2='".$this->input->post('ketuban2')."',
						  warna_cairan2='".$this->input->post('warna_cairan2')."',
						  pendarahan2='".$this->input->post('pendarahan2')."',
						  catatan='".$this->input->post('catatan')."',
						  waktu='".$this->input->post('waktu')."' 
						  where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and id_bumil='".$this->input->post("id_bumil")."'
						 ";
			break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-success'>Data berhasil disimpan..";
	}
	function simpan_assesment($action){
		switch ($action){
			case 'simpan' :
					$sql = "insert into assesment_bumil set 
						  id_pendaftaran='".$this->input->post('id_pendaftaran')."',
						  id_bumil='".$this->input->post('id_bumil')."',
						  gravita='".$this->input->post('gravita')."',
						  partus='".$this->input->post('partus')."',
						  abortus='".$this->input->post('abortus')."',
						  umur_kehamilan='".$this->input->post('umur_kehamilan')."',
						  kala='".$this->input->post('kala')."',
						  status='".$this->input->post('status')."',
						  catatan='".$this->input->post('catatan')."',
						  waktu='".$this->input->post('waktu')."'
						 ";
			break;
			case 'edit' :
					$sql = "update assesment_bumil set 
						  gravita='".$this->input->post('gravita')."',
						  partus='".$this->input->post('partus')."',
						  abortus='".$this->input->post('abortus')."',
						  umur_kehamilan='".$this->input->post('umur_kehamilan')."',
						  kala='".$this->input->post('kala')."',
						  status='".$this->input->post('status')."',
						  catatan='".$this->input->post('catatan')."',
						  waktu='".$this->input->post('waktu')."' 
						  where id_pendaftaran='".$this->input->post('id_pendaftaran')."' and id_bumil='".$this->input->post("id_bumil")."'
						 ";
			break;
		}
		$this->db->query($sql);
		return "<div class='alert alert-success'>Data berhasil disimpan..";
	}
	function getsubyektif($id_pendaftaran,$id_bumil){
		$sql = "select * from subyektif_bumil where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$q = $this->db->query($sql);
		return $q;
	}
	function getobyektif($id_pendaftaran,$id_bumil){
		$sql = "select * from obyektif_bumil where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$q = $this->db->query($sql);
		return $q;
	}
	function getassesment($id_pendaftaran,$id_bumil){
		$sql = "select * from assesment_bumil where id_pendaftaran='".$id_pendaftaran."' and id_bumil='".$id_bumil."'";
		$q = $this->db->query($sql);
		return $q;
	}
}
?>