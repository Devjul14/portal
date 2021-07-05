<?php
class Mpinjam extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
	function getpinjam($no_pasien){
		$this->db->select("p.*, pa.tanggal as tanggal_pinjam, pa.nama_peminjam, pa.keterangan as alasan_pinjam, pa.unit");
		// $this->db->join("pasien p","pr.no_rm=p.no_pasien");
		// $this->db->join("gol_pasien g","g.id_gol=pr.id_gol","left");
		// $this->db->join("ruangan r","r.kode_ruangan=pr.kode_ruangan","left");
		$this->db->join("pinjam pa","pa.no_pasien=p.no_pasien","left");
		$this->db->where("p.no_pasien",$no_pasien);
		$q = $this->db->get("pasien p");
		return $q->row();
	}
	function simpanpinjam(){
			$data = array(
						'no_pasien' => $this->input->post("no_pasien"), 
						'nama_peminjam' => $this->input->post("nama_peminjam"), 
						'tanggal' => date("Y-m-d H:i:s"),
						'unit' => $this->input->post("unit"), 
						'keterangan' => $this->input->post("alasan_pinjam")
					);
			$this->db->insert("pinjam",$data);
			$data1 = array(
						'status_pinjam' => 1
					);
			$this->db->where("no_pasien", $this->input->post("no_pasien"));
			$this->db->update("pasien",$data1);
		}
	function selesaipinjam(){
			$data1 = array(
						'tanggal_kembali' => date("Y-m-d H:i:s")
					);
			$this->db->where("no_pasien", $this->input->post("no_pasien"));
			$this->db->update("pinjam",$data1);
			$data1 = array(
						'status_pinjam' => NULL
					);
			$this->db->where("no_pasien", $this->input->post("no_pasien"));
			$this->db->update("pasien",$data1);
		}
	function addtindakan(){
		$t = $this->db->get_where("tarif_ralan",["kode_tindakan" => $this->input->post("tindakan")]);
		if ($t->num_rows()>0){
			$data = $t->row();
			if ($this->input->post('jenis')=="R") $tarif = $data->reguler; else $tarif = $data->executive;
			$data = array(
						"id" => date("dmyHis"),
						"no_reg" => $this->input->post("no_reg"),
						"kode_tarif" => $this->input->post("tindakan"),
						"jumlah" => $tarif
					);
			$this->db->insert("kasir",$data);
		}
	}
	function addtindakan_penunjang(){
		$t = $this->db->get_where("tarif_penunjang_medis",["kode" => $this->input->post("tindakan")]);
		if ($t->num_rows()>0){
			$data = $t->row();
			$tarif = $data->tarif;			
			$data = array(
						"id" => date("dmyHis"),
						"no_reg" => $this->input->post("no_reg"),
						"kode_tarif" => $this->input->post("tindakan"),
						"jumlah" => $tarif
					);
			$this->db->insert("kasir",$data);
		}
	}
	function addtindakan_ambulance(){
		$t = $this->db->get_where("tarif_ambulance",["kode" => $this->input->post("tindakan")]);
		if ($t->num_rows()>0){
			$data = $t->row();
			$tarif = $data->tarif;			
			$data = array(
						"id" => date("dmyHis"),
						"no_reg" => $this->input->post("no_reg"),
						"kode_tarif" => $this->input->post("tindakan"),
						"jumlah" => $tarif
					);
			$this->db->insert("kasir",$data);
		}
	}
	function hapustindakan(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->delete("kasir");
	}
	function hapusinap(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->delete("kasir_inap");
	}
	function changedata(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->update("kasir",["jumlah"=>$this->input->post("value")]);
	}
}