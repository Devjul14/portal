<?php
class Madmindkk extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getmanajemenuser(){
		$this->db->select("u.*,p.nama_puskesmas");
		$this->db->join("puskesmas p","p.id_puskesmas=u.id_puskesmas","left");
		$this->db->order_by("p.nama_puskesmas,u.nip","asc");
        $query = $this->db->get_where("user u",array("u.status_user"=>"15"));
		return $query;
	}
	function getpuskesmas(){
       $this->db->order_by("id_kecamatan,id_puskesmas","asc");
       $query = $this->db->get("puskesmas");
	   return $query;
	}
	function getuser($id){
       $q = $this->db->get_where("user",array("nip"=>$id));
	   return $q;
	}
	function simpanuser($aksi){
		$data = array(
				"nip" => $this->input->post('nip'),
				"nama_user" => $this->input->post('nama_user'),
				"status_user" => "15",
				"alamat" => $this->input->post('alamat'),
				"id_puskesmas" => $this->input->post('id_puskesmas'),
				"pwd" => $this->input->post('pwd1'));
		switch ($aksi) {
			case 'simpan' : $this->db->insert("user",$data);
							break;
			case 'edit' : 	$this->db->where("nip",$this->input->post('idlama'));
							$this->db->update("user",$data);
							break;
		}
		$msg  = "success-Data User berhasil di simpan";
		return $msg;
	}
	function hapususer($id){
       $this->db->where("nip",$id);
       $this->db->delete("user");
	   return "danger-Data User berhasil di hapus";
	}
	function getkecamatan(){
		$this->db->order_by("nama_kecamatan","asc");
        $query = $this->db->get("kecamatan");
		return $query;
	}
	function getkecamatandetail($id){
        $query = $this->db->get_where("kecamatan",array("id_kecamatan"=>$id));
		return $query;
	}
	function simpankecamatan($action){
		$data = array("nama_kecamatan"=>$this->input->post('nama_kecamatan'));
		switch ($action) {
			case 'simpan' : $this->db->insert("kecamatan",$data);
							break;
			case 'edit' : 	$this->db->where("id_kecamatan",$this->input->post('idlama'));
							$this->db->update("kecamatan",$data);
							break;
		}
		return "success-Data Kecamatan berhasil di simpan";
	}
	function hapuskecamatan($id){
       $this->db->where("id_kecamatan",$id);
       $this->db->delete("kecamatan");
	   return "info-Data berhasil di hapus";
	}
	function getkelurahan($id_kecamatan=NULL){
		$this->db->select("a.*,b.nama_kecamatan");
		$this->db->join("kecamatan b","b.id_kecamatan=a.id_kecamatan","inner");
		if ($id_kecamatan<>NULL) $this->db->where("a.id_kecamatan",$id_kecamatan);
		$this->db->order_by("nama_kecamatan,nama_kelurahan","asc");
        $query = $this->db->get("kelurahan a");
		return $query;
	}
	function getrw($id_kecamatan,$id_kelurahan){
		$this->db->order_by("nama_rw","asc");
        $query = $this->db->get_where("rw",array("id_kecamatan"=>$id_kecamatan,"id_kelurahan"=>$id_kelurahan));
		return $query;
	}
	function getkelurahandetail($id){
        $query = $this->db->get_where("kelurahan",array("id_kelurahan"=>$id));
		return $query;
	}
	function simpankelurahan($action){
		switch ($action) {
		case 'simpan' : $sql = "insert into kelurahan set 
								id_kecamatan='".$this->input->post('id_kecamatan')."',
								nama_kelurahan='".$this->input->post('nama_kelurahan')."'";
						break;
		case 'edit' : $sql = "update kelurahan set 
							  id_kecamatan='".$this->input->post('id_kecamatan')."',
							  nama_kelurahan='".$this->input->post('nama_kelurahan')."' where id_kelurahan='".$this->input->post('idlama')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "<span class='message info'>Data berhasil di input</span>";
		return $msg;
	}
	function hapuskelurahan($id){
       $sql = "delete from kelurahan where id_kelurahan='".$id."'";
       $this->db->query($sql);
	   $msg  = "<span class='message info'>Data berhasil di hapus</span>";
	   return $msg;
	}
	function getpuskesmas2($id_kecamatan=NULL){
		$sql = "select a.*,b.nama_kecamatan from puskesmas a inner join kecamatan b on(b.id_kecamatan=a.id_kecamatan) ";
		if ($id_kecamatan<>NULL) $sql .= " where a.id_kecamatan='".$id_kecamatan."' ";
		$sql .= "order by nama_kecamatan,nama_puskesmas";
        $query = $this->db->query($sql);
		return $query;
	}
	function getpuskesmasdetail($id){
		$sql = "select * from puskesmas where id_puskesmas='".$id."'";
        $query = $this->db->query($sql);
		return $query;
	}
	function simpanpuskesmas($aksi){
		switch ($aksi) {
		case 'simpan' : $sql = "insert into puskesmas set 
								id_puskesmas='".$this->input->post('id_puskesmas')."',
								id_kecamatan='".$this->input->post('id_kecamatan')."',
								nama_puskesmas='".$this->input->post('nama_puskesmas')."',
								alamat='".$this->input->post('alamat')."',
								kepala='".$this->input->post('kepala')."',
								telepon='".$this->input->post('telepon')."',
								nip='".$this->input->post('nip')."'";
						break;
		case 'edit' : $sql = "update puskesmas set 
							  id_kecamatan='".$this->input->post('id_kecamatan')."',
							  nama_puskesmas='".$this->input->post('nama_puskesmas')."',
							  alamat='".$this->input->post('alamat')."',
							  kepala='".$this->input->post('kepala')."',
							  telepon='".$this->input->post('telepon')."',
							  nip='".$this->input->post('nip')."' where id_puskesmas='".$this->input->post('idlama')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "success-Data Puskesmas berhasil di simpan";
		return $msg;
	}
	function hapuspuskesmas($id){
       $sql = "delete from puskesmas where id_puskesmas='".$id."'";
       $this->db->query($sql);
	   $msg  = "danger-Data Puskesmas berhasil di hapus";
	   return $msg;
	}
	function getlayanan(){
		$sql = "select * from layanan order by layanan";
        $query = $this->db->query($sql);
		return $query;
	}
	function getlayanandetail($id){
		$sql = "select * from layanan where id_layanan='".$id."'";
        $query = $this->db->query($sql);
		return $query;
	}
	function simpanlayanan($aksi){
		switch ($aksi) {
		case 'simpan' : $sql = "insert into layanan set 
								id_layanan='".$this->input->post('id_layanan')."',
								layanan='".$this->input->post('nama_layanan')."',
								karcis='".$this->input->post('karcis')."'";
						break;
		case 'edit' : $sql = "update layanan set 
							  layanan='".$this->input->post('nama_layanan')."',
							  karcis='".$this->input->post('karcis')."' where id_layanan='".$this->input->post('idlama')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "success-Data Layanan berhasil di simpan";
		return $msg;
	}
	function hapuslayanan($id){
       $sql = "delete from layanan where id_layanan='".$id."'";
       $this->db->query($sql);
	   $msg  = "danger-Data Layanan berhasil di hapus";
	   return $msg;
	}
	function gettindakan($id_layanan=NULL){
		$sql = "select a.*,b.layanan from tindakan a inner join layanan b on(b.id_layanan=a.id_layanan) ";
		if ($id_layanan<>NULL) $sql .= " where a.id_layanan='".$id_layanan."' ";
		$sql .= "order by layanan,tindakan";
        $query = $this->db->query($sql);
		return $query;
	}
	function gettindakandetail($id){
		$sql = "select * from tindakan where id_tindakan='".$id."'";
        $query = $this->db->query($sql);
		return $query;
	}
	function simpantindakan($action){
		switch ($action) {
		case 'simpan' : $sql = "insert into tindakan set 
								id_layanan='".$this->input->post('id_layanan')."',
								tindakan='".$this->input->post('tindakan')."',
								karcis='".$this->input->post('karcis')."'";
						break;
		case 'edit' : $sql = "update tindakan set 
							  id_layanan='".$this->input->post('id_layanan')."',
							  tindakan='".$this->input->post('tindakan')."',
							  karcis='".$this->input->post('karcis')."' where id_tindakan='".$this->input->post('idlama')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "<span class='message info'>Data berhasil di input</span>";
		return $msg;
	}
	function hapustindakan($id){
       $sql = "delete from tindakan where id_tindakan='".$id."'";
       $this->db->query($sql);
	   $msg  = "<span class='message info'>Data berhasil di hapus</span>";
	   return $msg;
	}
	function getstatususer(){
		$sql = "select * from status_user order by id";
		$query = $this->db->query($sql);
		return $query;
	}
}
?>