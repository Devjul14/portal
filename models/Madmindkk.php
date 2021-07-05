<?php

class Madmindkk extends CI_Model{

   function __construct()

    {

        parent::__construct();

    }

    function getsetuprs(){
		$q =  $this->db->get("setup_rs");
		return $q->row();
    }

    function getgolpasien(){
    	$q = $this->db->get("gol_pasien");
    	return $q;
    }

    function getgolpasiendetail($id){
    	$this->db->where("id_gol", $id);
    	$q = $this->db->get("gol_pasien");
    	return $q->row();
    }
      function getkesatuan(){
    	$q = $this->db->get("kesatuan");
    	return $q;
    }

    function getkesatuandetail($id){
    	$this->db->where("id_kesatuan", $id);
    	$q = $this->db->get("kesatuan");
    	return $q->row();
    }

    function getcabang(){
    	$q = $this->db->get("cabang");
    	return $q;
    }

    function getcabangdetail($id){
    	$this->db->where("id_cabang", $id);
    	$q = $this->db->get("cabang");
    	return $q->row();
    }

     function getpangkat(){
     	$this->db->select("p.*, g.keterangan as gol");
     	$this->db->join("gol_pasien g", "g.id_gol = p.id_gol");
    	$q = $this->db->get("pangkat p");
    	return $q;
    }

    function getpangkatdetail($id){
    	$this->db->where("id_pangkat", $id);
    	$q = $this->db->get("pangkat p");
    	return $q->row();
    }
     function getketcabang(){
     	$this->db->select("p.*, g.keterangan as cabang");
     	$this->db->join("cabang g", "g.id_cabang = p.id_cabang");
    	$q = $this->db->get("ket_cabang p");
    	return $q;
    }

    function getketcabangdetail($id){
    	$this->db->where("id_ketcabang", $id);
    	$q = $this->db->get("ket_cabang");
    	return $q->row();
    }

    function simpansetuprs($action,$foto){
    		$nama_file = str_replace('data:image/jpg;base64,', '', $this->input->post("source_foto"));
    		$nama_ttd = str_replace('data:image/jpg;base64,', '', $this->input->post("source_ttd"));
        $nama_ttd_klaim = str_replace('data:image/jpg;base64,', '', $this->input->post("source_ttd_klaim"));
			$data = array(
							'kode_rs' => $this->input->post("kode_rs"),
							'nama_rs' => $this->input->post("nama_rs"),
							'alamat_rs' => $this->input->post("alamat_rs"),
							'telepon_rs' => $this->input->post("telepon_rs"),
							'email_rs' => $this->input->post("email_rs"),
							'foto' => $foto,
							'karumkit' => $this->input->post("karumkit"),
							'foto_karumkit' => $nama_file,
							'ttd_k' => $nama_ttd,
              'nip_petugas_klaim' => $this->input->post("nip_petugas_klaim"),
              'nama_petugas_klaim' => $this->input->post("nama_petugas_klaim"),
							'ttd_petugas_klaim' => $nama_ttd_klaim
						);
			// switch ($action) {
				// case 'simpan':
				// 	$this->db->insert("setup_rs",$data);
				// 	return "success-Data RS berhasil disimpan";
				// 	break;
				// case 'ubah':
					$this->db->where("kode_rs",$this->input->post("id_rs"));
					$this->db->update("setup_rs",$data);
					return "success-Data RS berhasil diubah";
			// 		break;
			// }
	}
	function simpans($action){
            $nama_file = str_replace('data:image/jpg;base64,', '', $this->input->post("source_foto"));
            $nama_ttd = str_replace('data:image/jpg;base64,', '', $this->input->post("source_ttd"));
            $nama_ttd_klaim = str_replace('data:image/jpg;base64,', '', $this->input->post("source_ttd_klaim"));
			$data = array(
							'kode_rs' => $this->input->post("kode_rs"),
							'nama_rs' => $this->input->post("nama_rs"),
							'alamat_rs' => $this->input->post("alamat_rs"),
							'telepon_rs' => $this->input->post("telepon_rs"),
							'email_rs' => $this->input->post("email_rs"),
							'karumkit' => $this->input->post("karumkit"),
                            'foto_karumkit' => $nama_file,
                            'ttd_k' => $nama_ttd,
                            'nip_petugas_klaim' => $this->input->post("nip_petugas_klaim"),
                            'nama_petugas_klaim' => $this->input->post("nama_petugas_klaim"),
              							'ttd_petugas_klaim' => $nama_ttd_klaim
							// 'foto' => $foto

						);
			// switch ($action) {
				// case 'simpan':
				// 	$this->db->insert("setup_rs",$data);
				// 	return "success-Data RS berhasil disimpan";
				// 	break;
				// case 'ubah':
					$this->db->where("kode_rs",$this->input->post("id_rs"));
					$this->db->update("setup_rs",$data);
					return "success-Data RS berhasil diubah";
					// break;
			// }
	}
	function resetsetuprs($id){
			$this->db->where("kode_rs",$id);
			$this->db->delete("setup_rs");
			return "danger-Data RS telah di reset";
	}

	  function simpangolpasien($action){
			$data = array(
							'keterangan' => $this->input->post("keterangan")
						);
			switch ($action) {
				case 'simpan':
					$this->db->insert("gol_pasien",$data);
					return "success-Data berhasil disimpan";
					break;
				case 'edit':
					$this->db->where("id_gol",$this->input->post("id_gol"));
					$this->db->update("gol_pasien",$data);
					return "success-Data berhasil diubah";
					break;
			}
	}

	function hapusgolpasien($id){
			$this->db->where("id_gol",$id);
			$this->db->delete("gol_pasien");
			return "danger-Data telah di hapus";
	}

	  function simpankesatuan($action){
			$data = array(
							'keterangan' => $this->input->post("keterangan")
						);
			switch ($action) {
				case 'simpan':
					$this->db->insert("kesatuan",$data);
					return "success-Data berhasil disimpan";
					break;
				case 'edit':
					$this->db->where("id_kesatuan",$this->input->post("id_kesatuan"));
					$this->db->update("kesatuan",$data);
					return "success-Data berhasil diubah";
					break;
			}
	}

	function hapuskesatuan($id){
			$this->db->where("id_kesatuan",$id);
			$this->db->delete("kesatuan");
			return "danger-Data telah di hapus";
	}

	function simpancabang($action){
			$data = array(
							'keterangan' => $this->input->post("keterangan")
						);
			switch ($action) {
				case 'simpan':
					$this->db->insert("cabang",$data);
					return "success-Data berhasil disimpan";
					break;
				case 'edit':
					$this->db->where("id_cabang",$this->input->post("id_cabang"));
					$this->db->update("cabang",$data);
					return "success-Data berhasil diubah";
					break;
			}
	}

	function hapuscabang($id){
			$this->db->where("id_cabang",$id);
			$this->db->delete("cabang");
			return "danger-Data telah di hapus";
	}


	function simpanpangkat($action){
			$data = array(
							'id_gol' => $this->input->post("gol"),
							'keterangan' => $this->input->post("keterangan")
						);
			switch ($action) {
				case 'simpan':
					$this->db->insert("pangkat",$data);
					return "success-Data berhasil disimpan";
					break;
				case 'edit':
					$this->db->where("id_pangkat",$this->input->post("id_pangkat"));
					$this->db->update("pangkat",$data);
					return "success-Data berhasil diubah";
					break;
			}
	}

	function hapuspangkat($id){
			$this->db->where("id_pangkat",$id);
			$this->db->delete("pangkat");
			return "danger-Data telah di hapus";
	}
	function simpanketcabang($action){
			$data = array(
							'id_cabang' => $this->input->post("cabang"),
							'keterangan' => $this->input->post("keterangan")
						);
			switch ($action) {
				case 'simpan':
					$this->db->insert("ket_cabang",$data);
					return "success-Data berhasil disimpan";
					break;
				case 'edit':
					$this->db->where("id_ketcabang",$this->input->post("id_ketcabang"));
					$this->db->update("ket_cabang",$data);
					return "success-Data berhasil diubah";
					break;
			}
	}

	function hapusketcabang($id){
			$this->db->where("id_ketcabang",$id);
			$this->db->delete("ket_cabang");
			return "danger-Data telah di hapus";
	}




    function getmanajemenuser(){

		$this->db->select("u.*,p.nama_puskesmas");

		$this->db->join("puskesmas p","p.id_puskesmas=u.id_puskesmas","left");

		$this->db->order_by("p.nama_puskesmas,u.nip","asc");

        $query = $this->db->get_where("user u",array("u.status_user"=>"15"));

		return $query;

	}

	function getpuskesmas(){

       $this->db->order_by("id_kecamatan,id_puskesmas","asc");

       $query = $this->db->get("puskesmas");

	   return $query;

	}

	function getuser($id){

       $q = $this->db->get_where("user",array("nip"=>$id));

	   return $q;

	}

	function simpanuser($aksi){

		$data = array(

				"nip" => $this->input->post('nip'),

				"nama_user" => $this->input->post('nama_user'),

				"status_user" => "15",

				"alamat" => $this->input->post('alamat'),

				"id_puskesmas" => $this->input->post('id_puskesmas'),

				"pwd" => $this->input->post('pwd1'));

		switch ($aksi) {

			case 'simpan' : $this->db->insert("user",$data);

							break;

			case 'edit' : 	$this->db->where("nip",$this->input->post('idlama'));

							$this->db->update("user",$data);

							break;

		}

		$msg  = "success-Data User berhasil di simpan";

		return $msg;

	}

	function hapususer($id){

       $this->db->where("nip",$id);

       $this->db->delete("user");

	   return "danger-Data User berhasil di hapus";

	}

	function getkecamatan(){

		$this->db->order_by("nama_kecamatan","asc");

        $query = $this->db->get("kecamatan");

		return $query;

	}

	function getkecamatandetail($id){

        $query = $this->db->get_where("kecamatan",array("id_kecamatan"=>$id));

		return $query;

	}

	function simpankecamatan($action){

		$data = array("nama_kecamatan"=>$this->input->post('nama_kecamatan'));

		switch ($action) {

			case 'simpan' : $this->db->insert("kecamatan",$data);

							break;

			case 'edit' : 	$this->db->where("id_kecamatan",$this->input->post('idlama'));

							$this->db->update("kecamatan",$data);

							break;

		}

		return "success-Data Kecamatan berhasil di simpan";

	}

	function hapuskecamatan($id){

       $this->db->where("id_kecamatan",$id);

       $this->db->delete("kecamatan");

	   return "info-Data berhasil di hapus";

	}

	function getkelurahan($id_kecamatan=NULL){

		$this->db->select("a.*,b.nama_kecamatan");

		$this->db->join("kecamatan b","b.id_kecamatan=a.id_kecamatan","inner");

		if ($id_kecamatan<>NULL) $this->db->where("a.id_kecamatan",$id_kecamatan);

		$this->db->order_by("nama_kecamatan,nama_kelurahan","asc");

        $query = $this->db->get("kelurahan a");

		return $query;

	}

	function getrw($id_kecamatan,$id_kelurahan){

		$this->db->order_by("nama_rw","asc");

        $query = $this->db->get_where("rw",array("id_kecamatan"=>$id_kecamatan,"id_kelurahan"=>$id_kelurahan));

		return $query;

	}

	function getkelurahandetail($id){

        $query = $this->db->get_where("kelurahan",array("id_kelurahan"=>$id));

		return $query;

	}

	function simpankelurahan($action){

		switch ($action) {

		case 'simpan' : $sql = "insert into kelurahan set

								id_kecamatan='".$this->input->post('id_kecamatan')."',

								nama_kelurahan='".$this->input->post('nama_kelurahan')."'";

						break;

		case 'edit' : $sql = "update kelurahan set

							  id_kecamatan='".$this->input->post('id_kecamatan')."',

							  nama_kelurahan='".$this->input->post('nama_kelurahan')."' where id_kelurahan='".$this->input->post('idlama')."'";

						break;

		}

		$this->db->query($sql);

		$msg  = "<span class='message info'>Data berhasil di input</span>";

		return $msg;

	}

	function hapuskelurahan($id){

       $sql = "delete from kelurahan where id_kelurahan='".$id."'";

       $this->db->query($sql);

	   $msg  = "<span class='message info'>Data berhasil di hapus</span>";

	   return $msg;

	}

	function getpuskesmas2($id_kecamatan=NULL){

		$sql = "select a.*,b.nama_kecamatan from puskesmas a inner join kecamatan b on(b.id_kecamatan=a.id_kecamatan) ";

		if ($id_kecamatan<>NULL) $sql .= " where a.id_kecamatan='".$id_kecamatan."' ";

		$sql .= "order by nama_kecamatan,nama_puskesmas";

        $query = $this->db->query($sql);

		return $query;

	}

	function getpuskesmasdetail($id){

		$sql = "select * from puskesmas where id_puskesmas='".$id."'";

        $query = $this->db->query($sql);

		return $query;

	}

	function simpanpuskesmas($aksi){

		switch ($aksi) {

		case 'simpan' : $sql = "insert into puskesmas set

								id_puskesmas='".$this->input->post('id_puskesmas')."',

								id_kecamatan='".$this->input->post('id_kecamatan')."',

								nama_puskesmas='".$this->input->post('nama_puskesmas')."',

								alamat='".$this->input->post('alamat')."',

								kepala='".$this->input->post('kepala')."',

								telepon='".$this->input->post('telepon')."',

								nip='".$this->input->post('nip')."'";

						break;

		case 'edit' : $sql = "update puskesmas set

							  id_kecamatan='".$this->input->post('id_kecamatan')."',

							  nama_puskesmas='".$this->input->post('nama_puskesmas')."',

							  alamat='".$this->input->post('alamat')."',

							  kepala='".$this->input->post('kepala')."',

							  telepon='".$this->input->post('telepon')."',

							  nip='".$this->input->post('nip')."' where id_puskesmas='".$this->input->post('idlama')."'";

						break;

		}

		$this->db->query($sql);

		$msg  = "success-Data Puskesmas berhasil di simpan";

		return $msg;

	}

	function hapuspuskesmas($id){

       $sql = "delete from puskesmas where id_puskesmas='".$id."'";

       $this->db->query($sql);

	   $msg  = "danger-Data Puskesmas berhasil di hapus";

	   return $msg;

	}

	function getlayanan(){

		$sql = "select * from layanan order by layanan";

        $query = $this->db->query($sql);

		return $query;

	}

	function getlayanandetail($id){

		$sql = "select * from layanan where id_layanan='".$id."'";

        $query = $this->db->query($sql);

		return $query;

	}

	function simpanlayanan($aksi){

		switch ($aksi) {

		case 'simpan' : $sql = "insert into layanan set

								id_layanan='".$this->input->post('id_layanan')."',

								layanan='".$this->input->post('nama_layanan')."',

								karcis='".$this->input->post('karcis')."'";

						break;

		case 'edit' : $sql = "update layanan set

							  layanan='".$this->input->post('nama_layanan')."',

							  karcis='".$this->input->post('karcis')."' where id_layanan='".$this->input->post('idlama')."'";

						break;

		}

		$this->db->query($sql);

		$msg  = "success-Data Layanan berhasil di simpan";

		return $msg;

	}

	function hapuslayanan($id){

       $sql = "delete from layanan where id_layanan='".$id."'";

       $this->db->query($sql);

	   $msg  = "danger-Data Layanan berhasil di hapus";

	   return $msg;

	}

	function gettindakan($id_layanan=NULL){

		$sql = "select a.*,b.layanan from tindakan a inner join layanan b on(b.id_layanan=a.id_layanan) ";

		if ($id_layanan<>NULL) $sql .= " where a.id_layanan='".$id_layanan."' ";

		$sql .= "order by layanan,tindakan";

        $query = $this->db->query($sql);

		return $query;

	}

	function gettindakandetail($id){

		$sql = "select * from tindakan where id_tindakan='".$id."'";

        $query = $this->db->query($sql);

		return $query;

	}

	function simpantindakan($action){

		switch ($action) {

		case 'simpan' : $sql = "insert into tindakan set

								id_layanan='".$this->input->post('id_layanan')."',

								tindakan='".$this->input->post('tindakan')."',

								karcis='".$this->input->post('karcis')."'";

						break;

		case 'edit' : $sql = "update tindakan set

							  id_layanan='".$this->input->post('id_layanan')."',

							  tindakan='".$this->input->post('tindakan')."',

							  karcis='".$this->input->post('karcis')."' where id_tindakan='".$this->input->post('idlama')."'";

						break;

		}

		$this->db->query($sql);

		$msg  = "<span class='message info'>Data berhasil di input</span>";

		return $msg;

	}

	function hapustindakan($id){

       $sql = "delete from tindakan where id_tindakan='".$id."'";

       $this->db->query($sql);

	   $msg  = "<span class='message info'>Data berhasil di hapus</span>";

	   return $msg;

	}

	function getstatususer(){

		$sql = "select * from status_user order by id";

		$query = $this->db->query($sql);

		return $query;

	}
	function simpangaleri(){
		$nama_file = str_replace('data:image/jpg;base64,', '', $this->input->post("source_foto"));
		$data = array("foto"=>$nama_file);
		$this->db->insert("foto_rs",$data);
		return "success-Data berhasil di simpan";
	}
	function getgaleri(){
		return $this->db->get("foto_rs");
	}
	function hapusfoto($id){
		$this->db->where("id",$id);
		$this->db->delete("foto_rs");
		return "danger-Data berhasil dihapus";
	}
	function getsoap(){
		return $this->db->get("soap_perawat");
	}
	function getsoapdetail($id){
    	$this->db->where("id", $id);
    	$q = $this->db->get("soap_perawat");
    	return $q->row();
    }
	function simpansoap($action){
		$data = array(
					's' => $this->input->post("s"),
					'o' => $this->input->post("o"),
					'a' => $this->input->post("a"),
					'p' => $this->input->post("p"),
					'tujuan' => $this->input->post("tujuan"),
				);
		switch ($action) {
			case 'simpan':
				$this->db->insert("soap_perawat",$data);
				return "success-Data berhasil disimpan";
				break;
			case 'edit':
				$this->db->where("id",$this->input->post("id"));
				$this->db->update("soap_perawat",$data);
				return "success-Data berhasil diubah";
				break;
		}
	}
	function hapussoap($id){
		$this->db->where("id",$id);
		$this->db->delete("soap_perawat");
		return "danger-Data telah di hapus";
	}
	function getujifungsi(){
		return $this->db->get("ujifungsi");
	}
	function getujifungsidetail($id){
		return $this->db->get_where("ujifungsi",["id" => $id]);
	}
	function simpanujifungsi($action){
        $idlama = $this->input->post("idlama");
        $data = array(
                    "tindakan" => $this->input->post("tindakan"),
                    "koding" => $this->input->post("koding"),
                    "diagnosa_fungsional" => $this->input->post("kode_diagnosis_fungsional"),
                    "diagnosa_medis" => $this->input->post("kode_diagnosis_medis"),
                    "hasil" => $this->input->post("hasil"),
                    "kesimpulan" => $this->input->post("kesimpulan"),
                    "rekomendasi" => $this->input->post("rekomendasi")
                );
        switch ($action) {
            case 'simpan':
                $this->db->insert("ujifungsi",$data);
                break;
            case 'edit':
                $this->db->where("id",$idlama);
                $this->db->update("ujifungsi",$data);
                break;
        }
        return "success-Data berhasil disimpan";
	}
	function hapusujifungsi($id){
		$this->db->where("id",$id);
		$this->db->delete("ujifungsi");
		return "danger-Data telah di hapus";
	}
	function icd10(){
		$data = array();
		$q = $this->db->get("master_icd");
		foreach ($q->result() as $value) {
			$data[$value->kode] = $value->nama;
		}
    	return $data;
	}
	function icd9(){
		$data = array();
		$q = $this->db->get("master_icd9");
		foreach ($q->result() as $value) {
			$data[$value->kode] = $value->keterangan;
		}
    	return $data;
    }
    function getliburnasional($b,$t){
      $this->db->where("month(tanggal)",$b);
      $this->db->where("year(tanggal)",$t);
      $d = $this->db->get("liburnasional");
      return $d;
    }
    function getliburnasional_array(){
      $d = $this->db->get("liburnasional");
      $data = array();
      foreach ($d->result() as $key) {
        $data[$key->tanggal] = $key->keterangan;
      }
      return $data;
    }
}
?>
