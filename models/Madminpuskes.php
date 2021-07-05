<?php
class Madminpuskes extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getpuskesuser(){
            $sql = "select u.*,s.status_user from user u 
					inner join status_user s on (s.id=u.status_user)
					where u.status_user<>'15' and u.id_puskesmas='".$this->session->userdata('id_puskesmas')."'
					order by u.nip";
            $query = $this->db->query($sql);
			return $query;
	}
	function getstatus_user(){
       $sql = "select * from status_user where id<14 order by status_user";
       $query = $this->db->query($sql);
	   return $query;
	}
	function getpuskesuserdetail($id){
       $sql = "select * from user where nip='".$id."' and id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
       $query = $this->db->query($sql);
	   return $query;
	}
	function simpanuser($aksi){
		$sql = "select * from status_user where id='".$this->input->post('status_user')."'";
		$query = $this->db->query($sql)->row();
		$id_layanan = $query->id_layanan;
		switch ($aksi) {
		case 'simpan' : $sql = "insert into user set 
								nip='".$this->input->post('nip')."',
								nama_user='".$this->input->post('nama_user')."',
								status_user='".$this->input->post('status_user')."',
								alamat='".$this->input->post('alamat')."',
								id_puskesmas='".$this->session->userdata('id_puskesmas')."',
								id_layanan='".$id_layanan."',
								pwd=md5('".$this->input->post('pwd1')."') ";
						break;
		case 'edit' : $sql = "update user set 
								nip='".$this->input->post('nip')."',
								nama_user='".$this->input->post('nama_user')."',
								status_user='".$this->input->post('status_user')."',
								alamat='".$this->input->post('alamat')."',
								id_layanan='".$id_layanan."',
								pwd=md5('".$this->input->post('pwd1')."') where nip='".$this->input->post('idlama')."' and id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "success-Data User berhasil di simpan";
		return $msg;
	}
	function hapususer($id){
       $sql = "delete from user where nip='".$id."' and id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
       $this->db->query($sql);
	   $msg  = "danger-Data User berhasil di hapus";
	   return $msg;
	}
	function getjenisparamedis(){
       $sql = "select * from jenis_paramedis order by jenis_paramedis";
       $query = $this->db->query($sql);
	   return $query;
	}
	function getparamedis($id_jenisparamedis=NULL){
       $sql = "select a.*,b.jenis_paramedis as nama_jenis_paramedis, c.layanan from paramedis a 
				inner join jenis_paramedis b on (b.id_jenisparamedis=a.jenis_paramedis)
				inner join layanan c on (c.id_layanan=a.id_layanan)
				where a.id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
	   if ($id_jenisparamedis<>"") $sql .= " and a.jenis_paramedis='".$id_jenisparamedis."'";
       $query = $this->db->query($sql);
	   return $query;
	}
	function getparamedisdetail($id_paramedis){
       $sql = "select * from paramedis where id_paramedis='".$id_paramedis."'";
       $query = $this->db->query($sql);
	   return $query;
	}
	function simpanparamedis($aksi){
		switch ($aksi) {
		case 'simpan' : $sql = "insert into paramedis set 
								nip='".$this->input->post('nip')."',
								nama_paramedis='".$this->input->post('nama_paramedis')."',
								jenis_paramedis='".$this->input->post('jenis_paramedis')."',
								alamat='".$this->input->post('alamat')."',
								hp='".$this->input->post('hp')."',
								kota='".$this->input->post('kota')."',
								telp='".$this->input->post('telp')."',
								id_puskesmas='".$this->session->userdata('id_puskesmas')."',
								id_layanan='".$this->input->post('id_layanan')."'";
						break;
		case 'edit' : $sql = "update paramedis set 
								nip='".$this->input->post('nip')."',
								nama_paramedis='".$this->input->post('nama_paramedis')."',
								jenis_paramedis='".$this->input->post('jenis_paramedis')."',
								alamat='".$this->input->post('alamat')."',
								hp='".$this->input->post('hp')."',
								kota='".$this->input->post('kota')."',
								telp='".$this->input->post('telp')."',
								id_puskesmas='".$this->session->userdata('id_puskesmas')."',
								id_layanan='".$this->input->post('id_layanan')."' where id_paramedis='".$this->input->post('idlama')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "success-Data Paramedis berhasil di simpan";
		return $msg;
	}
	function hapusparamedis($id){
       $sql = "delete from paramedis where id_paramedis='".$id."'";
       $this->db->query($sql);
	   $msg  = "danger-Data Paramedis berhasil di hapus";
	   return $msg;
	}
	function getsdbinaan(){
       $sql = "select a.*,b.nama_kecamatan,c.nama_kelurahan from sd a 
				left join kecamatan b on (b.id_kecamatan=a.id_kecamatan)
				left join kelurahan c on (c.id_kelurahan=a.id_kelurahan)
				where a.id_puskesmas='".$this->session->userdata('id_puskesmas')."' order by id_kecamatan,id_kelurahan,nama_sd";
       $query = $this->db->query($sql);
	   return $query;
	}
	function getsdbinaandetail($id_sdbinaan){
       $sql = "select * from sd where id_sd='".$id_sdbinaan."'";
       $query = $this->db->query($sql);
	   return $query;
	}
	function simpanbinaan($aksi){
		switch ($aksi) {
		case 'simpan' : $sql = "insert into sd set 
								nama_sd='".$this->input->post('nama_sd')."',
								id_kecamatan='".$this->input->post('id_kecamatan')."',
								id_kelurahan='".$this->input->post('id_kelurahan')."',
								id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
						break;
		case 'edit' : $sql = "update sd set 
								nama_sd='".$this->input->post('nama_sd')."',
								id_kecamatan='".$this->input->post('id_kecamatan')."',
								id_kelurahan='".$this->input->post('id_kelurahan')."',
								id_puskesmas='".$this->session->userdata('id_puskesmas')."' where id_sd='".$this->input->post('idlama')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "success-Data SD Binaan berhasil di simpan";
		return $msg;
	}
	function getposyandu(){
       $sql = "select a.*,b.nama_kecamatan,c.nama_kelurahan,d.nama_rw from posyandu a 
				left join kecamatan b on (b.id_kecamatan=a.id_kecamatan)
				left join kelurahan c on (c.id_kelurahan=a.id_kelurahan)
				left join rw d on (d.id_rw=a.id_rw)
				where a.id_puskesmas='".$this->session->userdata('id_puskesmas')."' order by id_kecamatan,id_kelurahan,id_rw,nama_posyandu";
       $query = $this->db->query($sql);
	   return $query;
	}
	function hapusbinaan($id){
       $sql = "delete from sd where id_sd='".$id."'";
       $this->db->query($sql);
	   $msg  = "danger-Data SD Binaan berhasil di hapus";
	   return $msg;
	}
	function getposyandudetail($id_posyandu){
       $sql = "select * from posyandu where id_posyandu='".$id_posyandu."'";
       $query = $this->db->query($sql);
	   return $query;
	}
	function simpanposyandu($aksi){
		switch ($aksi) {
		case 'simpan' : $sql = "insert into posyandu set 
								nama_posyandu='".$this->input->post('nama_posyandu')."',
								id_kecamatan='".$this->input->post('id_kecamatan')."',
								id_kelurahan='".$this->input->post('id_kelurahan')."',
								id_rw='".$this->input->post('id_rw')."',
								id_puskesmas='".$this->session->userdata('id_puskesmas')."'";
						break;
		case 'edit' : $sql = "update posyandu set 
								nama_posyandu='".$this->input->post('nama_posyandu')."',
								id_kecamatan='".$this->input->post('id_kecamatan')."',
								id_kelurahan='".$this->input->post('id_kelurahan')."',
								id_rw='".$this->input->post('id_rw')."',
								id_puskesmas='".$this->session->userdata('id_puskesmas')."' where id_posyandu='".$this->input->post('idlama')."'";
						break;
		}
		$this->db->query($sql);
		$msg  = "success-Data Posyandu berhasil di simpan";
		return $msg;
	}
	function hapusposyandu($id){
       $sql = "delete from posyandu where id_posyandu='".$id."'";
       $this->db->query($sql);
	   $msg  = "danger-Data Posyandu berhasil di hapusposyandu";
	   return $msg;
	}
}
?>