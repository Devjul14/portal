<?php

class Mruangan extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getruangan(){
		$q = $this->db->get("ruangan");
		return $q;
	}

	function getruangan_detail($kode_ruangan){
		$this->db->where("kode_ruangan", $kode_ruangan);
		$q = $this->db->get("ruangan");
		return $q->row();
	}
	function simpanruangan($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode_ruangan" => $this->input->post('kode_ruangan'),
					"nama_ruangan" => $this->input->post('nama_ruangan')
				);
				$q = $this->getruangan_detail($this->input->post('kode_ruangan'));
				if ($q) {
					$msg  = "danger-Data Ruangan sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("ruangan",$data);
					$msg  = "success-Data Ruangan berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_ruangan" => $this->input->post('nama_ruangan')
					
				);
				$this->db->where("kode_ruangan",$this->input->post('kode_ruangan'));			
				$this->db->update("ruangan",$data);
				$msg  = "success-Data Ruangan berhasil di ubah";
				return $msg;
							break;
		}
	}
	function hapusruangan($kode_ruangan){
       $this->db->where("kode_ruangan",$kode_ruangan);
       $this->db->delete("ruangan");
	   return "danger-Data Ruangan berhasil di hapus";
	}
	function getkelas(){
		$q = $this->db->get("kelas");
		return $q;
	}

	function getkelas_detail($kode_kelas){
		$this->db->where("kode_kelas", $kode_kelas);
		$q = $this->db->get("kelas");
		return $q->row();
	}
	function simpankelas($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode_kelas" => $this->input->post('kode_kelas'),
					"nama_kelas" => $this->input->post('nama_kelas')
				);
				$q = $this->getkelas_detail($this->input->post('kode_kelas'));
				if ($q) {
					$msg  = "danger-Data Kelas sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("kelas",$data);
					$msg  = "success-Data Kelas berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_kelas" => $this->input->post('nama_kelas')
					
				);
				$this->db->where("kode_kelas",$this->input->post('kode_kelas'));			
				$this->db->update("kelas",$data);
				$msg  = "success-Data Kelas berhasil di ubah";
				return $msg;
							break;
		}
	}
	function hapuskelas($kode_kelas){
       $this->db->where("kode_kelas",$kode_kelas);
       $this->db->delete("kelas");
	   return "danger-Data Kelas berhasil di hapus";
	}
	function getkamar($kode_ruangan,$kode_kelas){
		$this->db->select("k.*,r.nama_ruangan,kls.nama_kelas");
		$this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan");
		$this->db->join("kelas kls", "kls.kode_kelas=k.kode_kelas");
		if ($kode_ruangan!="---") {
			$this->db->where("k.kode_ruangan",$kode_ruangan);
		}
		if ($kode_kelas!="---") {
			$this->db->where("k.kode_kelas",$kode_kelas);
		}
		$q = $this->db->get("kamar k");
		return $q;
		
	}
	function getkamar_kosong($kode_ruangan,$kode_kelas){
		$this->db->select("k.*,r.nama_ruangan,kls.nama_kelas");
		$this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan");
		$this->db->join("kelas kls", "kls.kode_kelas=k.kode_kelas");
		if ($kode_ruangan!="---") {
			$this->db->where("k.kode_ruangan",$kode_ruangan);
		}
		if ($kode_kelas!="---") {
			$this->db->where("k.kode_kelas",$kode_kelas);
		}
		$this->db->where("status_kamar","KOSONG");
		$q = $this->db->get("kamar k");
		return $q;
		
	}
	function getkamar_detail($kode_kamar,$no_bed){
		$this->db->where("kode_kamar",$kode_kamar);
		$this->db->where("no_bed",$no_bed);
		$q = $this->db->get("kamar");
		return $q->row();
	}
	function simpankamar($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode_kamar" => $this->input->post('kode_kamar'),
					"kode_ruangan" => $this->input->post('kode_ruangan'),
					"kode_kelas" => $this->input->post('kode_kelas'),
					"nama_kamar" => $this->input->post('nama_kamar'),
					"no_bed" => $this->input->post('no_bed'),
					"tarif_kamar" => $this->input->post('tarif_kamar'),
				);
				$this->db->where("no_bed",$this->input->post('no_bed'));
				$this->db->where("kode_kamar",$this->input->post('kode_kamar'));
				$q = $this->db->get("kamar")->row();
				if ($q) {
					$msg  = "danger-Data Kamar sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("kamar",$data);
					$msg  = "success-Data Kamar berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"kode_ruangan" => $this->input->post('kode_ruangan'),
					"kode_kelas" => $this->input->post('kode_kelas'),
					"nama_kamar" => $this->input->post('nama_kamar'),
					"tarif_kamar" => $this->input->post('tarif_kamar'),
					
				);
				$this->db->where("kode_kamar",$this->input->post('kode_kamar'));	
				$this->db->where("no_bed",$this->input->post('no_bed'));
				$this->db->update("kamar",$data);
				$msg  = "success-Data Kamar berhasil di ubah";
				return $msg;
							break;
		}
	}
	function hapuskamar($kode_kamar,$no_bed){
       $this->db->where("kode_kamar",$kode_kamar);
       $this->db->where("no_bed",$no_bed);
       $this->db->delete("kamar");
	   return "danger-Data Kamar berhasil di hapus";
	}
}

?>