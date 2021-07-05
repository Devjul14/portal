<?php
class Mmaster_bu extends CI_Model{
   	function __construct()
    {
        parent::__construct();
    }
   	function getsupplier_bu(){
		$q = $this->db->get("supplier_bu");
       	return $q;
    }
    function getdata_supplier_bu($page,$offset){
       	$cari = $this->session->userdata('cari_supplier');
       	if ($cari!="") {
       		$this->db->like("nama_supplier",$cari);
       		$this->db->or_like("kode_supplier",$cari);
       	}
       	$q = $this->db->get("supplier_bu",$page,$offset);
       	return $q;
    }
    function getsupplierbu_detail($kode){
    	$this->db->where("kode_supplier",$kode);
    	$q = $this->db->get("supplier_bu");
    	return $q->row();
    }
    function simpansupplier($action){
		$data = array(
			 		"kode_supplier" 		=> $this->input->post("kode_supplier"),
	       			"nama_supplier" 		=> $this->input->post("nama_supplier"),
	        		"alamat_supplier" 		=> $this->input->post("alamat_supplier"),
	        		"kota_supplier" 		=> $this->input->post("kota_supplier"),
	        		"telepon_supplier" 		=> $this->input->post("telepon_supplier"),
	        		"bank_supplier" 		=> $this->input->post("bank_supplier"),
	        		"rekening_supplier" 	=> $this->input->post("rekening_supplier"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("supplier_bu",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_supplier", $this->input->post("kode_supplier"));
				$this->db->update("supplier_bu",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapussupplier($kode){
		$this->db->where("kode_supplier",$kode);
		$this->db->delete("supplier_bu");
		return "danger-Data berhasil dihapus";
	}
	function getkategori(){
		$q = $this->db->get("kategori_bu");
       	return $q;
    }
    function getdata_kategori($page,$offset){
       	$cari = $this->session->userdata('cari_kategori');
       	if ($cari!="") {
       		$this->db->like("nama_kategori",$cari);
       		$this->db->or_like("kode_kategori",$cari);
       	}
       	$q = $this->db->get("kategori_bu",$page,$offset);
       	return $q;
    }
    function getkategori_detail($kode){
    	$this->db->where("kode_kategori",$kode);
    	$q = $this->db->get("kategori_bu");
    	return $q->row();
    }
    function simpankategori($action){
		$data = array(
			 		"kode_kategori" 		=> $this->input->post("kode_kategori"),
	       			"nama_kategori" 		=> $this->input->post("nama_kategori"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("kategori_bu",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_kategori", $this->input->post("kode_kategori"));
				$this->db->update("kategori_bu",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapuskategori($kode){
		$this->db->where("kode_kategori",$kode);
		$this->db->delete("kategori_bu");
		return "danger-Data berhasil dihapus";
	}
	function getsatuan_besar(){
		$q = $this->db->get("satuanbesar_bu");
       	return $q;
    }
    function getdata_satuan_besar($page,$offset){
       	$cari = $this->session->userdata('cari_satuan');
       	if ($cari!="") {
       		$this->db->like("nama_satuan",$cari);
       		$this->db->or_like("kode_satuan",$cari);
       	}
       	$q = $this->db->get("satuanbesar_bu",$page,$offset);
       	return $q;
    }
    function getsatuanbesar_detail($kode){
    	$this->db->where("kode_satuan",$kode);
    	$q = $this->db->get("satuanbesar_bu");
    	return $q->row();
    }
    function simpansatuan_besar($action){
		$data = array(
			 		"kode_satuan" 		=> $this->input->post("kode_satuan"),
	       			"nama_satuan" 		=> $this->input->post("nama_satuan"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("satuanbesar_bu",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_satuan", $this->input->post("kode_satuan"));
				$this->db->update("satuanbesar_bu",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapussatuan_besar($kode){
		$this->db->where("kode_satuan",$kode);
		$this->db->delete("satuanbesar_bu");
		return "danger-Data berhasil dihapus";
	}
	function getsatuan_kecil(){
		$q = $this->db->get("satuankecil_bu");
       	return $q;
    }
    function getdata_satuankecil($page,$offset){
       	$cari = $this->session->userdata('cari_satuankecil');
       	if ($cari!="") {
       		$this->db->like("nama_satuan",$cari);
       		$this->db->or_like("kode_satuan",$cari);
       	}
       	$q = $this->db->get("satuankecil_bu",$page,$offset);
       	return $q;
    }
    function getsatuankecil_detail($kode){
    	$this->db->where("kode_satuan",$kode);
    	$q = $this->db->get("satuankecil_bu");
    	return $q->row();
    }
    function simpansatuan_kecil($action){
		$data = array(
			 		"kode_satuan" 		=> $this->input->post("kode_satuan"),
	       			"nama_satuan" 		=> $this->input->post("nama_satuan"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("satuankecil_bu",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_satuan", $this->input->post("kode_satuan"));
				$this->db->update("satuankecil_bu",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapussatuan_kecil($kode){
		$this->db->where("kode_satuan",$kode);
		$this->db->delete("satuankecil_bu");
		return "danger-Data berhasil dihapus";
	}
	function getbarang_umum(){
		$q = $this->db->get("master_bu");
       	return $q;
    }
    function getdata_barangumum($page,$offset){
       	$cari = $this->session->userdata('cari_barang_umum');
       	if ($cari!="") {
       		$this->db->like("nama_bu",$cari);
       		$this->db->or_like("kode_bu",$cari);
       	}
       	$q = $this->db->get("master_bu",$page,$offset);
       	return $q;
    }
    function getbarangumum_detail($kode){
    	$this->db->where("kode_bu",$kode);
    	$q = $this->db->get("master_bu");
    	return $q->row();
    }
    function simpanbarang_umum($action){
		$data = array(
			 		"kode_bu" 		=> $this->input->post("kode_bu"),
	       			"nama_bu" 		=> $this->input->post("nama_bu"),
	       			"merk" 			=> $this->input->post("merk"),
	       			"kategori_bu"	=> $this->input->post("kategori_bu"),
			        "satuan_besar"	=> $this->input->post("satuan_besar"),
			        "satuan_kecil"	=> $this->input->post("satuan_kecil"),
			        "stok_awal"		=> $this->input->post("stok_awal"),
			        "stok"			=> $this->input->post("stok"),
			        "isi"			=> $this->input->post("isi"),
			        "harga_kecil"	=> $this->input->post("harga_kecil"),
			        "harga_besar"	=> $this->input->post("harga_besar"),
			        "harga_beli"	=> $this->input->post("harga_beli"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("master_bu",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_bu", $this->input->post("kode_bu"));
				$this->db->update("master_bu",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusbarang_umum($kode){
		$this->db->where("kode_bu",$kode);
		$this->db->delete("master_bu");
		return "danger-Data berhasil dihapus";
	}
	function getdepo_bu(){
		$q = $this->db->get("depo_bu");
       	return $q;
    }
    function getdatadepo_bu($page,$offset){
       	$cari = $this->session->userdata('cari_depo');
       	if ($cari!="") {
       		$this->db->like("nama_depor",$cari);
       		$this->db->or_like("kode_depo",$cari);
       	}
       	$q = $this->db->get("depo_bu",$page,$offset);
       	return $q;
    }
    function getdepobu_detail($kode){
    	$this->db->where("kode_supplier",$kode);
    	$q = $this->db->get("supplier_bu");
    	return $q->row();
    }
    function simpandepo_bu($action){
		$data = array(
			 		"kode_depo" 		=> $this->input->post("kode_depo"),
	       			"nama_depo" 		=> $this->input->post("nama_depo")
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("depo_bu",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_depo", $this->input->post("kode_depo"));
				$this->db->update("depo_bu",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusdepo_bu($kode){
		$this->db->where("kode_depo",$kode);
		$this->db->delete("depo_bu");
		return "danger-Data berhasil dihapus";
	}
	function getstatus_bu(){
		$q = $this->db->get("status_bu");
       	return $q;
    }
    function getdata_status_bu($page,$offset){
       	$cari = $this->session->userdata('cari_status');
       	if ($cari!="") {
       		$this->db->like("nama_status",$cari);
       		$this->db->or_like("kode_status",$cari);
       	}
       	$q = $this->db->get("status_bu",$page,$offset);
       	return $q;
    }
    function getstatus_detail($kode){
    	$this->db->where("kode_status",$kode);
    	$q = $this->db->get("status_bu");
    	return $q->row();
    }
    function simpanstatus_bu($action){
		$data = array(
			 		"kode_status" 		=> $this->input->post("kode_status"),
	       			"nama_status" 		=> $this->input->post("nama_status"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("status_bu",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_status", $this->input->post("kode_status"));
				$this->db->update("status_bu",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusstatus_bu($kode){
		$this->db->where("kode_status",$kode);
		$this->db->delete("status_bu");
		return "danger-Data berhasil dihapus";
	}
}
?>