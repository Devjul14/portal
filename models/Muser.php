<?php

class Muser extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getstatus_user(){
    	$this->db->select("s.*,c.nama_controller as controller");
    	$this->db->join("controller c","c.id_controller=s.controller");
		$q = $this->db->get("status_user s");
		return $q;
	}
	function getuser_login(){
		$q = $this->db->get("user");
		return $q;
	}
	function getuserlogin_detail($id){
		$this->db->where("nip", $id);
		$q = $this->db->get("user");
		return $q->row();
	}
	function getstatususer(){
		$q = $this->db->get("status_user");
		return $q;
	}

	function getstatususer_detail($id){
		$this->db->where("id", $id);
		$q = $this->db->get("status_user");
		return $q->row();
	}
	function getcontroller(){
       $query = $this->db->get("controller");
	   return $query;
	}
	function getuser($id){
       $q = $this->db->get_where("user",array("nip"=>$id));
	   return $q;
	}
	function simpanstatus_user($aksi){
		$data = array(
			"status_user" => $this->input->post('status_user'),
			"controller" => $this->input->post('controller')
		);
		switch ($aksi) {
			case 'simpan' : 
				$this->db->insert("status_user",$data);
							break;
			case 'edit' : 	
				$this->db->where("id",$this->input->post('id'));			
				$this->db->update("status_user",$data);
							break;
		}
		return "success-Data berhasil di simpan";
	}
	function hapusstatus_user($id){
       $this->db->where("id",$id);
       $this->db->delete("status_user");
	   return "danger-Data berhasil di hapus";
	}

	function simpanuser_login($aksi){
		$data = array(
			"nip" => $this->input->post('nip'),
			"nama_user" => $this->input->post('nama_user'),
			"status_user" => $this->input->post('status_user'),
			"alamat" => $this->input->post('alamat'),
			"pwd" => md5($this->input->post('pwd'))
		);
		switch ($aksi) {
			case 'simpan' : 
				$this->db->insert("user",$data);
							break;
			case 'edit' : 	
				$this->db->where("nip",$this->input->post('nip'));			
				$this->db->update("user",$data);
							break;
		}
		return "success-Data berhasil di simpan";
	}
	function hapususer_login($id){
       $this->db->where("nip",$id);
       $this->db->delete("user");
	   return "danger-Data berhasil di hapus";
	}
}

?>