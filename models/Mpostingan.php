<?php
class Mpostingan extends CI_Model{
   	function __construct(){
        parent::__construct();
    }
    function getpostingan($page,$offset){
        $this->db->order_by("id");
		$q   = $this->db->get("halaman",$page,$offset);
		return $q;
    }
    function getjumlah_postingan(){
        $q   = $this->db->get("halaman");
		return $q->num_rows();
    }
	function getpostingdetail($id=""){
		$this->db->order_by("id");
		$q   = $this->db->get_where("halaman",["id"=>$id]);
		return $q->row();
	}
	function simpanposting($action){
		$data = array(
					"slug" => $this->input->post("slug"),
					"tanggal" => date("Y-m-d H:i:s"),
					"title" => $this->input->post("title"),
					"content" => $this->input->post("content"),
                    "status" => $this->input->post("status"),
				);
		switch ($action) {
			case 'simpan':
				$this->db->insert("halaman",$data);
				break;
			case 'edit':
				$this->db->where("id",$this->input->post("id"));
				$this->db->update("halaman",$data);
				break;
		}
	}
}
?>   