<?php
class Mpetugas extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getkasir(){
    	return $this->db->get("petugas_kasir");
    }
    function getkasir_detail($id){
        $q = $this->db->get_where("petugas_kasir",["nip"=>$id]);
        return $q->row();
    }
    function simpankasir($aksi){
		$nama_file = str_replace('data:image/jpg;base64,', '', $this->input->post("source_foto"));
		$nama_photo = str_replace('data:image/jpg;base64,', '', $this->input->post("source_photo"));
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"nip" => $this->input->post('nip'),
					"nama" => $this->input->post('nama'),
					"ttd" => $nama_file,
					"photo" => $nama_photo
				);
				$q = $this->getkasir_detail($this->input->post('nip'));
				if ($q) {
					$msg  = "danger-NIP Petugas Kasir sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("petugas_kasir",$data);
					$msg  = "success-Data Petugas Kasir berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama" => $this->input->post('nama'),
					"ttd" => $nama_file,
					"photo" => $nama_photo
				);
				$this->db->where("nip",$this->input->post('nip'));			
				$this->db->update("petugas_kasir",$data);
				$msg  = "success-Data Petugas Kasir berhasil di ubah";
				return $msg;
				break;
		}
	}
	function hapuskasir($nip){
       $this->db->where("nip",$nip);
       $this->db->delete("petugas_kasir");
	   return "danger-Data Petugas Kasir berhasil di hapus";
	}
	function getlab(){
        return $this->db->get("analys");
    }
    function getlab_detail($id){
        $q = $this->db->get_where("analys",["nip"=>$id]);
        return $q->row();
    }
    function simpanlab($aksi){
		$nama_file = str_replace('data:image/jpg;base64,', '', $this->input->post("source_foto"));
		$nama_photo = str_replace('data:image/jpg;base64,', '', $this->input->post("source_photo"));
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"nip" => $this->input->post('nip'),
					"nama" => $this->input->post('nama'),
					"ttd" => $nama_file,
					"photo" => $nama_photo
				);
				$q = $this->getkasir_detail($this->input->post('nip'));
				if ($q) {
					$msg  = "danger-NIP Petugas Lab sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("analys",$data);
					$msg  = "success-Data Petugas Lab berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama" => $this->input->post('nama'),
					"ttd" => $nama_file,
					"photo" => $nama_photo
				);
				$this->db->where("nip",$this->input->post('nip'));			
				$this->db->update("analys",$data);
				$msg  = "success-Data Petugas Lab berhasil di ubah";
				return $msg;
				break;
		}
	}
	function hapuslab($nip){
       $this->db->where("nip",$nip);
       $this->db->delete("analys");
	   return "danger-Data Petugas Lab berhasil di hapus";
    }
    function getrekammedis(){
    	return $this->db->get("petugas_rm");
    }
    function getrekammedis_detail($id){
        $q = $this->db->get_where("petugas_rm",["nip"=>$id]);
        return $q->row();
    }
    function simpanrekammedis($aksi){
		$nama_file = str_replace('data:image/jpg;base64,', '', $this->input->post("source_foto"));
		$nama_photo = str_replace('data:image/jpg;base64,', '', $this->input->post("source_photo"));
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"nip" => $this->input->post('nip'),
					"nama" => $this->input->post('nama'),
					"ttd" => $nama_file,
					"photo" => $nama_photo
				);
				$q = $this->getrekammedis_detail($this->input->post('nip'));
				if ($q) {
					$msg  = "danger-NIP Petugas RM sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("petugas_rm",$data);
					$msg  = "success-Data Petugas Kasir berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama" => $this->input->post('nama'),
					"ttd" => $nama_file,
					"photo" => $nama_photo
				);
				$this->db->where("nip",$this->input->post('nip'));			
				$this->db->update("petugas_rm",$data);
				$msg  = "success-Data Petugas Kasir berhasil di ubah";
				return $msg;
				break;
		}
	}
	function hapusrekammedis($nip){
       $this->db->where("nip",$nip);
       $this->db->delete("petugas_rm");
	   return "danger-Data Petugas RM berhasil di hapus";
	}
}
?>