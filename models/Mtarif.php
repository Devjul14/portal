<?php

class Mtarif extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function gettarif_ambulance(){
		$q = $this->db->get("tarif_ambulance");
		return $q;
	}
    function getambulance_detail($kode){
		$this->db->where("kode", $kode);
		$q = $this->db->get("tarif_ambulance");
		return $q->row();
	}
    function simpan_tarifambulance($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode"  => $this->input->post('kode'),
					"kota"  => $this->input->post('kota'),
                    "tarif" => $this->input->post('tarif')
				);
				$q = $this->getambulance_detail($this->input->post('kode'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_ambulance",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"kota"  => $this->input->post('kota'),
                    "tarif" => $this->input->post('tarif')					
				);
				$this->db->where("kode",$this->input->post('kode'));			
				$this->db->update("tarif_ambulance",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
    function gettarif_gizi(){
		$q = $this->db->get("tarif_gizi");
		return $q;
	}
    function getgizi_detail($kode_tindakan){
		$this->db->where("kode_tindakan", $kode_tindakan);
		$q = $this->db->get("tarif_gizi");
		return $q->row();
	}
    function simpan_tarifgizi($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode_tindakan"  => $this->input->post('kode_tindakan'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "isolasi"        => $this->input->post('isolasi'),
                    "icu"            => $this->input->post('icu')
				);
				$q = $this->getgizi_detail($this->input->post('kode_tindakan'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_gizi",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "isolasi"        => $this->input->post('isolasi'),
                    "icu"            => $this->input->post('icu')
				);
				$this->db->where("kode_tindakan",$this->input->post('kode_tindakan'));			
				$this->db->update("tarif_gizi",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
    function gettarif_inap(){
		$q = $this->db->get("tarif_inap");
		return $q;
	}
    function gettarifinap_detail($kode_tindakan){
		$this->db->where("kode_tindakan", $kode_tindakan);
		$q = $this->db->get("tarif_inap");
		return $q->row();
	}
	function simpan_tarifinap($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode_tindakan"  => $this->input->post('kode_tindakan'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "kelas1"         => $this->input->post('kelas1'),
                    "kelas2"         => $this->input->post('kelas2'),
                    "kelas3"         => $this->input->post('kelas3'),
					"vip1"        	 => $this->input->post('vip1'),
                    "vip2"        	 => $this->input->post('vip2'),
                    "vip3"        	 => $this->input->post('vip3'),
                    "vip"            => $this->input->post('vip'),
                    "vip_deluxe"     => $this->input->post('vip_deluxe'),
                    "vip_premium"    => $this->input->post('vip_premium'),
                    "vip_executive"  => $this->input->post('vip_executive'),
                    "icu"            => $this->input->post('icu'),
                    "nicu"        	 => $this->input->post('nicu'),
                    "bayi"        	 => $this->input->post('bayi'),
                    "isolasi"        => $this->input->post('isolasi'),
				);
				$q = $this->gettarifinap_detail($this->input->post('kode_tindakan'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_inap",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "kelas1"         => $this->input->post('kelas1'),
                    "kelas2"         => $this->input->post('kelas2'),
                    "kelas3"         => $this->input->post('kelas3'),
					"vip1"        	 => $this->input->post('vip1'),
                    "vip2"        	 => $this->input->post('vip2'),
                    "vip3"        	 => $this->input->post('vip3'),
                    "vip"            => $this->input->post('vip'),
                    "vip_deluxe"     => $this->input->post('vip_deluxe'),
                    "vip_premium"    => $this->input->post('vip_premium'),
                    "vip_executive"  => $this->input->post('vip_executive'),
                    "icu"            => $this->input->post('icu'),
                    "nicu"        	 => $this->input->post('nicu'),
                    "bayi"        	 => $this->input->post('bayi'),
                    "isolasi"        => $this->input->post('isolasi'),
				);
				$this->db->where("kode_tindakan",$this->input->post('kode_tindakan'));			
				$this->db->update("tarif_inap",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
	function gettarif_lab(){
		$q = $this->db->get("tarif_lab");
		return $q;
	}
	function getlab_detail($kode_tindakan){
		$this->db->where("kode_tindakan", $kode_tindakan);
		$q = $this->db->get("tarif_lab");
		return $q->row();
	}
	function simpan_tariflab($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					// "id_tindakan"    => $this->input->post('id_tindakan'),
					"kode_tindakan"  => $this->input->post('kode_tindakan'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "icu"            => $this->input->post('icu')
				);
				$q = $this->getlab_detail($this->input->post('kode_tindakan'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_lab",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"kode_tindakan"  => $this->input->post('kode_tindakan'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "icu"            => $this->input->post('icu')
				);
				$this->db->where("kode_tindakan",$this->input->post('kode_tindakan'));			
				$this->db->update("tarif_lab",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
	function gettarif_operasi(){
		$q = $this->db->get("tarif_operasi");
		return $q;
	}
	function gettarifoperasi_detail($kode){
		$this->db->where("kode", $kode);
		$q = $this->db->get("tarif_operasi");
		return $q->row();
	}
	function simpan_tarifoperasi($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode"  	     => $this->input->post('kode'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "kelas1"         => $this->input->post('kelas1'),
                    "kelas2"         => $this->input->post('kelas2'),
                    "kelas3"         => $this->input->post('kelas3'),
					"vip1"        	 => $this->input->post('vip1'),
                    "vip2"        	 => $this->input->post('vip2'),
                    "vip3"        	 => $this->input->post('vip3'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip_deluxe"     => $this->input->post('vip_deluxe'),
                    "vip_premium"    => $this->input->post('vip_premium'),
                    "vip_executive"  => $this->input->post('vip_executive'),
                    "icu"            => $this->input->post('icu'),
                    "nicu"        	 => $this->input->post('nicu'),
                    "bayi"        	 => $this->input->post('bayi'),
				);
				$q = $this->gettarifoperasi_detail($this->input->post('kode'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_operasi",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "kelas1"         => $this->input->post('kelas1'),
                    "kelas2"         => $this->input->post('kelas2'),
                    "kelas3"         => $this->input->post('kelas3'),
					"vip1"        	 => $this->input->post('vip1'),
                    "vip2"        	 => $this->input->post('vip2'),
                    "vip3"        	 => $this->input->post('vip3'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip_deluxe"     => $this->input->post('vip_deluxe'),
                    "vip_premium"    => $this->input->post('vip_premium'),
                    "vip_executive"  => $this->input->post('vip_executive'),
                    "icu"            => $this->input->post('icu'),
                    "nicu"        	 => $this->input->post('nicu'),
                    "bayi"        	 => $this->input->post('bayi')
				);
				$this->db->where("kode",$this->input->post('kode'));			
				$this->db->update("tarif_operasi",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
	function gettarif_pa(){
		$q = $this->db->get("tarif_pa");
		return $q;
	}
	function getpa_detail($kode_tindakan){
		$this->db->where("kode_tindakan", $kode_tindakan);
		$q = $this->db->get("tarif_pa");
		return $q->row();
	}
	function simpan_tarifpa($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode_tindakan"  => $this->input->post('kode_tindakan'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "isolasi"        => $this->input->post('isolasi'),
                    "icu"            => $this->input->post('icu')
				);
				$q = $this->getpa_detail($this->input->post('kode_tindakan'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_pa",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "isolasi"        => $this->input->post('isolasi'),
                    "icu"            => $this->input->post('icu')
				);
				$this->db->where("kode_tindakan",$this->input->post('kode_tindakan'));			
				$this->db->update("tarif_pa",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
	function gettarif_penunjangmedis(){
		$q = $this->db->get("tarif_penunjang_medis");
		return $q;
	}
	function getpm_detail($kode){
		$this->db->where("kode", $kode);
		$q = $this->db->get("tarif_penunjang_medis");
		return $q->row();
	}
	function simpan_tarifpenunjangmedis($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode"  		 => $this->input->post('kode'),
					"ket"  			 => $this->input->post('ket'),
                    "tarif"          => $this->input->post('tarif'),
                    "rs"      		 => $this->input->post('rs'),
                    "dr"       		 => $this->input->post('dr'),
                    "pt"             => $this->input->post('pt'),
                    "st"        	 => $this->input->post('st'),
                    "bb"        	 => $this->input->post('bb')
				);
				$q = $this->getpm_detail($this->input->post('kode'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_penunjang_medis",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"ket"  			 => $this->input->post('ket'),
                    "tarif"          => $this->input->post('tarif'),
                    "rs"      		 => $this->input->post('rs'),
                    "dr"       		 => $this->input->post('dr'),
                    "pt"             => $this->input->post('pt'),
                    "st"        	 => $this->input->post('st'),
                    "bb"        	 => $this->input->post('bb')
				);
				$this->db->where("kode",$this->input->post('kode'));			
				$this->db->update("tarif_penunjang_medis",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
	function gettarif_radiologi(){
		$q = $this->db->get("tarif_radiologi");
		return $q;
	}
	function getradiologi_detail($id_tindakan){
		$this->db->where("id_tindakan", $id_tindakan);
		$q = $this->db->get("tarif_radiologi");
		return $q->row();
	}
	function simpan_tarifradiologi($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"id_tindakan"  => $this->input->post('id_tindakan'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "isolasi"        => $this->input->post('isolasi'),
                    "icu"            => $this->input->post('icu')
				);
				$q = $this->getradiologi_detail($this->input->post('id_tindakan'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_radiologi",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive'),
                    "supervip"       => $this->input->post('supervip'),
                    "vip"            => $this->input->post('vip'),
                    "kelas_1"        => $this->input->post('kelas_1'),
                    "kelas_2"        => $this->input->post('kelas_2'),
                    "kelas_3"        => $this->input->post('kelas_3'),
                    "isolasi"        => $this->input->post('isolasi'),
                    "icu"            => $this->input->post('icu')
				);
				$this->db->where("id_tindakan",$this->input->post('id_tindakan'));			
				$this->db->update("tarif_radiologi",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
	function gettarif_ralan(){
		$q = $this->db->get("tarif_ralan");
		return $q;
	}
	function getralan_detail($kode_tindakan){
		$this->db->where("kode_tindakan", $kode_tindakan);
		$q = $this->db->get("tarif_ralan");
		return $q->row();
	}
	function simpan_tarifralan($aksi){
		switch ($aksi) {
			case 'simpan' : 
				$data = array(
					"kode_tindakan"  => $this->input->post('kode_tindakan'),
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive')
				);
				$q = $this->getralan_detail($this->input->post('kode_tindakan'));
				if ($q) {
					$msg  = "danger-Data sudah ada sebelumnya";
					return $msg;
				} else {
					$this->db->insert("tarif_ralan",$data);
					$msg  = "success-Data berhasil di simpan";
					return $msg;
				}
				
							break;
			case 'edit' : 	
				$data = array(
					"nama_tindakan"  => $this->input->post('nama_tindakan'),
                    "reguler"        => $this->input->post('reguler'),
                    "executive"      => $this->input->post('executive')
				);
				$this->db->where("kode_tindakan",$this->input->post('kode_tindakan'));			
				$this->db->update("tarif_ralan",$data);
				$msg  = "success-Data berhasil di ubah";
				return $msg;
							break;
		}
	}
}

?>