<?php

class Mpoliklinik extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getpoliklinik(){
		$q = $this->db->get("poliklinik ");
		return $q;
	}

	function getpoliklinikdetail($id){
		$this->db->where("kode", $id);
		$q = $this->db->get("poliklinik");
		return $q->row();
	}

	function simpanpoliklinik($aksi){
		$data = array(
				"kode" => $this->input->post('kode_poliklinik'),
				"keterangan" => $this->input->post('nama_poliklinik'),
				"briging" => $this->input->post('briging'),
				"hari_buka" => $this->input->post('hari_buka'),
				"status" => $this->input->post('status')
				
			);
		switch ($aksi) {
			case 'simpan' : 
					$q = $this->getpoliklinikdetail($this->input->post('kode_poliklinik'));
						if ($q) {
							$msg  = "danger-Data poliklinik sudah ada sebelumnya";
							return $msg;
						} else {
							$this->db->insert("poliklinik",$data);
							$msg  = "success-Data poliklinik berhasil di simpan";
							return $msg;
						}			
							break;
			case 'edit' : 	$this->db->where("kode",$this->input->post('kode_poliklinik'));
							$this->db->update("poliklinik",$data);
							break;
		}
		$msg  = "success-Data poliklinik berhasil di simpan";
		return $msg;
	}
	function hapuspoliklinik($id){
       $this->db->where("kode",$id);
       $this->db->delete("poliklinik");
	   return "danger-Data poliklinik berhasil di hapus";
		}
	}
