<?php

	class Minap extends CI_Model{

	   	function __construct(){

	        parent::__construct();

	    }

	    function getkelasdetail($id){

	    	$q = $this->db->where("kode_kelas",$id);

	    	$q = $this->db->get("kelas");

	    	return $q->row();

	    }
		// function getruangan_detail {
		//     $this->db->select("k.*,r.nama_ruangan,kls.nama_kelas");
		// 	$this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan");
		// 	$this->db->join("kelas kls", "kls.kode_kelas=k.kode_kelas");
		// 	if ($kode_ruangan!="---") {
		// 		$this->db->where("k.kode_ruangan",$kode_ruangan);
		// 	}
		// 	if ($kode_kelas!="---") {
		// 		$this->db->where("k.kode_kelas",$kode_kelas);
		// 	}
		// 	$q = $this->db->get("kamar k");
		// 	return $q;
		// 	}

	    function simpankelas($aksi){

			$data = array(

					'id_kelas' => $this->input->post("id_kelas"), 

					'nama_kelas' => $this->input->post("nama_kelas"), 

					'tarif' => $this->input->post("tarif"), 

					);

			switch ($aksi) {

				case 'simpan':

					$this->db->insert("kelas",$data);

					break;

				case 'edit':

					$this->db->where("id_kelas",$this->input->post("id_kelas"));

					$this->db->update("kelas",$data);

					break;

			}

			return "success-Data kelas berhasil di simpan";

		}

		function hapuskelas($id_kelas){

			$this->db->where("id_kelas",$id_kelas);

			$this->db->delete("kelas");

			return "danger-Data kelas berhasil di hapus";

		}

		function getruangan($id_kelas){

			if ($id_kelas!="all") {

				$q = $this->db->where("kode_kelas",$id_kelas);

			}

			$q = $this->db->get("ruangan");

			return $q;

		// $this->db->select("k.*,r.nama_ruangan,kls.nama_kelas");
		// $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan");
		// $this->db->join("kelas kls", "kls.kode_kelas=k.kode_kelas");
		// if ($kode_ruangan!="---") {
		// 	$this->db->where("k.kode_ruangan",$kode_ruangan);
		// }
		// if ($kode_kelas!="---") {
		// 	$this->db->where("k.kode_kelas",$kode_kelas);
		// }
		// $q = $this->db->get("kamar k");
		// return $q;

		}

		function getruangan1(){
			$this->db->select("r.*, k.no_bed");
			$this->db->join("kamar k","k.kode_ruangan = r.kode_ruangan");
			$q = $this->db->get("ruangan r");

			return $q;
		}

		function getruangan_detail($id_kelas,$id_ruangan){
			$q = $this->db->select("kamar.*, ruangan.nama_ruangan ");
			$q = $this->db->join("ruangan","ruangan.kode_ruangan = kamar.kode_ruangan");
			$q = $this->db->where("kamar.kode_kelas",$id_kelas);
			$q = $this->db->where("kamar.kode_ruangan",$id_ruangan);
			$q = $this->db->get("kamar");
			return $q->row();

		}

		function simpanruangan($aksi){

			$data = array(

					'id_kelas' => $this->input->post("id_kelas"), 

					'id_ruangan' => $this->input->post("id_ruangan"), 

					'nama_ruangan' => $this->input->post("nama_ruangan"), 

					'no_bed' => $this->input->post("no_bed"), 

					);

			switch ($aksi) {

				case 'simpan':

					$this->db->insert("ruangan",$data);

					break;

				case 'edit':

					$this->db->where("id_kelas",$this->input->post("id_kelas"));

					$this->db->where("id_ruangan",$this->input->post("id_ruangan"));

					$this->db->update("ruangan",$data);

					break;

			}

			return "success-Data Ruangan berhasil di simpan";

		}

		function hapusruangan($id_kelas,$id_ruangan){

			$this->db->where("id_kelas",$id_kelas);

			$this->db->where("id_ruangan",$id_ruangan);

			$this->db->delete("ruangan");

			return "danger-Data ruangan berhasil di hapus";

		}

		function getpasien_inap($id_kelas,$id_ruangan){

			$q = $this->db->select("pi.*,r.nama_ruangan,k.nama_kelas,pi.no_reg as idpasienkamar");

			// $q = $this->db->join("pendaftaran_rawatinap p","p.id=pi.id_pendaftaran_inap");

			$q = $this->db->join("ruangan r","r.kode_ruangan=pi.kode_ruangan");

			$q = $this->db->join("kamar km","km.kode_ruangan=pi.kode_ruangan");

			$q = $this->db->join("kelas k","k.kode_kelas=km.kode_kelas");

			$q = $this->db->where("k.kode_kelas",$id_kelas);

			$q = $this->db->where("pi.kode_ruangan",$id_ruangan);

			$q = $this->db->get("pasien_inap pi");

			return $q;

		}

		function getdaftarpasien($id_kelas){

			$q = $this->db->where("kelas",$id_kelas);

			$q = $this->db->get("pendaftaran_rawatinap");

			return $q;

		}

		function simpanpasienruangan(){

			$data = array(

					'tgl_masuk' => date("Y-m-d H:i:s"),

					'id_pendaftaran_inap' => $this->input->post("pasien"),

					'ruangan' => $this->input->post("id_ruangan"),

					'user' => $this->session->userdata("username"),

					'status' => "M",

					);

			$this->db->insert("pasien_inap",$data);

			return "success-Pasien dimasukan ke ruangan ".$this->input->post("nama_ruangan");

		}

		function pulang($id){

			$sql = "update pasien_inap set status='P' where id_pendaftaran_inap='".$id."'";

			$q = $this->db->query($sql);

			$sql1 = "update pendaftaran_rawatinap set tgl_pulang='".date('Y-m-d')."' where id='".$id."' ";

			$q1 = $this->db->query($sql1);

			return "danger-Pasien Sudah Pulang";

		}

		function getpasiendetail($id){

			$q = $this->db->where("id",$id);

			$q = $this->db->get("pendaftaran_rawatinap");

			return $q->row();

		}

		function gettindakan(){

			$q = $this->db->get("tindakan");

			return $q;

		}

		function gettindakanpasien($pasien){

			$q = $this->db->select("p.*,t.nama_tindakan");

			$q = $this->db->join("tindakan t","t.id_tindakan=p.tindakan","inner");

			$q = $this->db->where("id_pendaftaran",$pasien);

			$q = $this->db->get("perawatan_inap p");

			return $q;

		}

		function simpanperawatan(){

			$data = array(

					'tgl' => date("Y-m-d",strtotime($this->input->post("tgl"))),

					'id_pendaftaran' => $this->input->post("id_pendaftaran"),

					'tindakan' => $this->input->post("tindakan"),

					'penindak' => $this->input->post("penindak"),

					);

			$this->db->insert("perawatan_inap",$data);

			return "success-Perawatan berhasil di input";

		}

		function getpasieninap_detail($id){

			$q = $this->db->select("pi.*");

			// $q = $this->db->join("pendaftaran_rawatinap pr","pr.id=pi.id_pendaftaran_inap","inner");

			$q = $this->db->where("pi.no_reg",$id);

			$q = $this->db->get("pasien_inap pi");

			return $q->row();

		}

		function simpanpindahkamar(){

			$data = array(

					'id_pendaftaran' => $this->input->post("id_pendaftaran"), 

					'ruangan_lama' => $this->input->post("id_ruangan"), 

					'ruangan_baru' => $this->input->post("ruang_baru"), 

					'tgl_pindah' => date('Y-m-d',strtotime($this->input->post("tgl_pindah"))), 

					);

			$this->db->insert("pindah_kamar",$data);

			$sql = "update pasien_inap set status='PINDAH' where id='".$this->input->post('id_pendaftaran')."' and ruangan='".$this->input->post('id_ruangan')."'";

			$q = $this->db->query($sql);

			$data1 = array(

					'tgl_masuk' => date('Y-m-d',strtotime($this->input->post("tgl_pindah"))),

					'ruangan' => $this->input->post("ruang_baru"), 

					'id_pendaftaran_inap' => $this->input->post("idpasien"), 

					'user' => $this->session->userdata("username"),

					'status' => 'M',

					);

			$this->db->insert("pasien_inap",$data1);

			return "success-Pasien berhasil di pindah";

		}

		function getpindahkamar($id){

			$q = $this->db->select("pk.*,rl.nama_ruangan as rlama, rb.nama_ruangan as rbaru");

			$q = $this->db->join("ruangan rl","pk.ruangan_lama=rl.kode_ruangan","inner");

			$q = $this->db->join("ruangan rb","pk.ruangan_baru=rb.kode_ruangan","inner");

			$q = $this->db->where("pk.id_pendaftaran",$id);

			$q = $this->db->get("pindah_kamar pk");

			return $q;

		}





	

	}

?>

