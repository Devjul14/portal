<?php
class Persetujuan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->Model('Mpersetujuan');
	}
	function formpersetujuan($jenis,$no_reg,$no_pasien=null){
		$data["vmenu"]          = "farmasi/vmenu";
		$data['menu']           = "apotek";
		$data["jenis"]          = $jenis;
		$data["no_reg"]         = $no_reg;
		$data["title"]          = "Persetujuan || RS CIREMAI";
		$data["title_header"]   = "Persetujuan";
		$data["breadcrumb"]     = "<li class='active'><strong>Persetujuan</strong></li>";
		$n = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
		if ($n){
			if ($n->petugas_rm!=""){
				redirect("persetujuan/cetakpersetujuan_all/".$no_reg."/".$no_pasien);
			}
		}
		if ($jenis=="ralan"){
			redirect("persetujuan/formpersetujuan_umum/".$jenis."/".$no_reg);
		}
		if ($this->session->userdata('username_pasien') == NULL|| $this->session->userdata('password_pasien') == NULL)
		{
			$this->session->unset_userdata("username_pasien");
			$this->session->unset_userdata("password_pasien");
			$this->session->unset_userdata("no_pasien");
			$data["q1"] = $this->Mpersetujuan->getpasieninap_detail($no_reg);
			$this->load->view('persetujuan/vpersetujuan',$data);
		}
		else{
			$data["q"]              = $this->Mpersetujuan->getpasien_detail();
			$data["q1"]             = $this->Mpersetujuan->getpasieninap_detail($no_reg);
			$data["q2"]             = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
			$this->load->view('persetujuan/vformpersetujuan',$data);
		}
	}
	function formkronologis($jenis,$no_reg,$no_pasien){
		$data["vmenu"]          = "farmasi/vmenu";
		$data['menu']           = "apotek";
		$data["jenis"]          = $jenis;
		$data["no_reg"]         = $no_reg;
		$data["no_rm"]          = $no_pasien;
		$data["title"]          = "Kronologis || RS CIREMAI";
		$data["title_header"]   = "Kronologis";
		$data["breadcrumb"]     = "<li class='active'><strong>Kronologis</strong></li>";
		$data["q3"]             = $this->Mpersetujuan->getttd_kronologis($no_pasien,$no_reg);
		$n = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
		if ($n){
			if ($n->petugas_rm!=""){
				redirect("persetujuan/cetakpersetujuan_all/".$no_reg."/".$no_pasien);
			}
		}
		if ($jenis=="ralan"){
			redirect("persetujuan/formpersetujuan_umum/".$jenis."/".$no_reg);
		}
		if ($this->session->userdata('username_pasien') == NULL|| $this->session->userdata('password_pasien') == NULL)
		{
			$this->session->unset_userdata("username_pasien");
			$this->session->unset_userdata("password_pasien");
			$this->session->unset_userdata("no_pasien");
			$data["q1"] = $this->Mpersetujuan->getpasieninap_detail($no_reg);
			$this->load->view('persetujuan/vpersetujuan',$data);
		}
		else{
			$data["q"]              = $this->Mpersetujuan->getpasien_detail();
			$data["q1"]             = $this->Mpersetujuan->getpasieninap_detail($no_reg);
			$data["q2"]             = $this->Mpersetujuan->getkronologis_detail($no_reg);
			$this->load->view('persetujuan/vformkronologis',$data);
		}
	}
	function formkronologis_ralan($jenis,$no_reg,$no_pasien){
		$data["vmenu"]          = "farmasi/vmenu";
		$data['menu']           = "apotek";
		$data["jenis"]          = $jenis;
		$data["no_reg"]         = $no_reg;
		$data["no_rm"]          = $no_pasien;
		$data["title"]          = "Kronologis || RS CIREMAI";
		$data["title_header"]   = "Kronologis";
		$data["breadcrumb"]     = "<li class='active'><strong>Kronologis</strong></li>";
		if ($this->session->userdata('username_pasien') == NULL|| $this->session->userdata('password_pasien') == NULL)
		{
			$this->session->unset_userdata("username_pasien");
			$this->session->unset_userdata("password_pasien");
			$this->session->unset_userdata("no_pasien");
			$this->load->view('persetujuan/vpersetujuan',$data);
		}
		else{

			$data["q"]              = $this->Mpersetujuan->getpasien_detail2($no_pasien);
			$data["q1"]             = $this->Mpersetujuan->getpasieninap_detail($no_reg);
			$data["q2"]             = $this->Mpersetujuan->getkronologis_ralan($no_reg);
			$this->load->view('persetujuan/vformkronologis_ralan',$data);
		}
	}
	function cekpersetujuan(){
		$jenis           = $this->input->post('jenis');
		$username_pasien = $this->input->post('no_reg');
		$password_pasien = $this->input->post('isi');
		$pilihan         = $this->input->post('pilihan');
		if($this->Mpersetujuan->cekpersetujuan($username_pasien,$password_pasien,$jenis,$pilihan)){
			redirect('persetujuan/formpersetujuan/'.$jenis."/".$username_pasien,'refresh');
		} else {
			$message = "danger-Data tidak ditemukan, Silahkan coba lagi..";
			$this->session->set_flashdata("message", $message);
			redirect('persetujuan/formpersetujuan/'.$jenis."/".$username_pasien);
		}
	}
	function reset($jenis,$no_reg){
		$no_pasien = $this->session->userdata("no_pasien");
		$this->session->unset_userdata("username_pasien");
		$this->session->unset_userdata("password_pasien");
		$this->session->unset_userdata("no_pasien");
		redirect('persetujuan/formpersetujuan/'.$jenis."/".$no_reg."/".$no_pasien);
	}
	function reset_umum($jenis,$no_reg){
		$no_pasien = $this->session->userdata("no_pasien");
		$this->session->unset_userdata("username_pasien");
		$this->session->unset_userdata("password_pasien");
		$this->session->unset_userdata("no_pasien");
		redirect('persetujuan/formpersetujuan/'.$jenis."/".$no_reg."/".$no_pasien);
	}
	function simpanpersetujuan($aksi){
		$jenis           = $this->input->post('jenis');
		$username_pasien = $this->input->post('no_reg');
		$message = $this->Mpersetujuan->simpanpersetujuan($aksi);
		$this->session->set_flashdata("message", $message);
		redirect('persetujuan/formpersetujuan_umum/'.$jenis."/".$username_pasien);
	}
	function simpankronologis($aksi){
		$jenis           = $this->input->post('jenis');
		$username_pasien = $this->input->post('no_reg');
		$no_rm = $this->input->post('no_rm');
		$message = $this->Mpersetujuan->simpankronologis($aksi);
		$this->session->set_flashdata("message", $message);
		redirect('persetujuan/formkronologis/'.$jenis."/".$username_pasien."/".$no_rm);
	}
	function simpankronologis_ralan($aksi){
		$jenis           = $this->input->post('jenis');
		$username_pasien = $this->input->post('no_reg');
		$no_rm = $this->input->post('no_rm');
		$message = $this->Mpersetujuan->simpankronologis_ralan($aksi);
		$this->session->set_flashdata("message", $message);
		redirect('persetujuan/formkronologis_ralan/'.$jenis."/".$username_pasien."/".$no_rm);
	}
	function forminsert_petugas($no_reg,$no_pasien,$jenis){
		$data["no_reg"]     = $no_reg;
		$data["no_pasien"]  = $no_pasien;
		$data["jenis"]      = $jenis;
		$this->load->view("persetujuan/vinsertpetugas_rm",$data);
	}
	function cekpetugas_rm($tabel,$no_reg,$no_pasien){
		$password   = $this->input->post("password_petugas");
		$q 			= $this->Mpersetujuan->cekpetugas_rm($password);
		if ($q->num_rows()>0) {
			$row = $q->row();
			$nip = $row->nip;
			$message = $this->Mpersetujuan->insertpetugas_rm($no_reg,$no_pasien,$nip,$tabel);
			$this->session->set_flashdata("message", $message);
			$this->session->set_userdata("no_reg",$no_reg);
            // redirect("persetujuan/cetakpersetujuan/".$no_reg."/".$no_pasien);
			echo "true";
		} else {
			echo "false";
		}

	}
	function cekpetugas_kronologis($no_reg,$no_pasien){
		$password   = $this->input->post("password_petugas");
		$q 			= $this->Mpersetujuan->cekpetugas_rm($password);
		if ($q->num_rows()>0) {
			echo "true";
		} else {
			echo "false";
		}

	}
    // function insertpetugas_rm($no_reg,$no_pasien,$jenis){
    //     $password   = $this->input->post("password_petugas");
    //     switch ($jenis) {
    //         case 'P':
    //             $q          = $this->Mpersetujuan->cekpetugas_rm($password);
    //             if ($q) {
    //                 $nip = $q->nip;
    //                 $message = $this->Mpersetujuan->insertpetugas_rm($no_reg,$no_pasien,$nip,$jenis);
    //                 $this->session->set_flashdata("message", $message);
    //                 redirect("persetujuan/cetakpersetujuan/".$no_reg."/".$no_pasien);
    //             } else {
    //                 $message =  "danger-Password Salah";
    //                 $this->session->set_flashdata("message", $message);
    //                 redirect("persetujuan/forminsert_petugas/".$no_reg."/".$no_pasien."/".$jenis);
    //             }
    //             break;
    //         case 'U':
    //             $q          = $this->Mpersetujuan->cekpetugas_rm($password);
    //             if ($q) {
    //                 $nip = $q->nip;
    //                 $message = $this->Mpersetujuan->insertpetugas_rm($no_reg,$no_pasien,$nip,$jenis);
    //                 $this->session->set_flashdata("message", $message);
    //                 redirect("persetujuan/cetakpersetujuan_umum/".$no_reg."/".$no_pasien);
    //             } else {
    //                 $message =  "danger-Password Salah";
    //                 $this->session->set_flashdata("message", $message);
    //                 redirect("persetujuan/forminsert_petugas/".$no_reg."/".$no_pasien."/".$jenis);
    //             }
    //             break;
    //     }

    // }
	function cetakpersetujuan($no_reg,$no_pasien){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["q"]         = $this->Mpersetujuan->getpasien_detail2($no_pasien);
		$data["q1"]        = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]        = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
		$this->load->view("persetujuan/vcetakpersetujuan",$data);
	}
	function cetakkronologis($no_reg,$no_pasien){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["q"]         = $this->Mpersetujuan->getpasien_detail2($no_pasien);
		$data["q1"]        = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]        = $this->Mpersetujuan->getkronologis_detail($no_reg);
		$this->load->view("persetujuan/vcetakkronologis",$data);
	}
	function cetakkronologis_ralan($no_reg,$no_pasien){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["q"]              = $this->Mpersetujuan->getpasien_detail2($no_pasien);
		$data["q1"]             = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]             = $this->Mpersetujuan->getkronologis_detail($no_reg);
		$this->load->view("persetujuan/vcetakkronologis_ralan",$data);
	}
	function cetakhak_kewajiban($no_reg,$no_pasien){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["q"]         = $this->Mpersetujuan->getpasien_detail();
		$data["q1"]        = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]        = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
		$this->load->view("persetujuan/vcetakhak_kewajiban",$data);
	}
	function formpersetujuan_umum($jenis,$no_reg){
		$data["vmenu"]          = "farmasi/vmenu";
		$data['menu']           = "apotek";
		$data["jenis"]          = $jenis;
		$data["no_reg"]         = $no_reg;
		$data["title"]          = "Persetujuan Umum || RS CIREMAI";
		$data["title_header"]   = "Persetujuan Umum";
		$data["breadcrumb"]     = "<li class='active'><strong>Persetujuan Umum</strong></li>";
		if ($this->session->userdata('username_pasien') == NULL|| $this->session->userdata('password_pasien') == NULL)
		{
			$this->session->unset_userdata("username_pasien");
			$this->session->unset_userdata("password_pasien");
			$this->session->unset_userdata("no_pasien");
			$this->load->view('persetujuan/vpersetujuan',$data);
		}
		else{
			$data["q"]              = $this->Mpersetujuan->getpasien_detail();
			$data["q1"]             = $this->Mpersetujuan->getpasieninap_detail($no_reg);
			$data["q2"]             = $this->Mpersetujuan->getpersetujuanumum_detail($no_reg);
			$data["q3"]             = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
			$this->load->view('persetujuan/vformpersetujuan_umum',$data);
		}
	}

	function cekpersetujuan_umum(){
		$jenis           = $this->input->post('jenis');
		$username_pasien = $this->input->post('no_reg');
		$password_pasien = $this->input->post('isi');
		$pilihan         = $this->input->post('pilihan');
		if($this->Mpersetujuan->cekpersetujuan($username_pasien,$password_pasien,$jenis,$pilihan)){
			redirect('persetujuan/formpersetujuan_umum/'.$jenis."/".$username_pasien,'refresh');
		} else {
			$message = "danger-Data tidak ditemukan, Silahkan coba lagi..";
			$this->session->set_flashdata("message", $message);
			redirect('persetujuan/formpersetujuan_umum/'.$jenis."/".$username_pasien);
		}
	}
	function simpanpersetujuan_umum($aksi){
		$jenis           = $this->input->post('jenis');
		$username_pasien = $this->input->post('no_reg');
		$message = $this->Mpersetujuan->simpanpersetujuan_umum($aksi);
		$this->session->set_flashdata("message", $message);
		redirect('persetujuan/formpersetujuan_umum/'.$jenis."/".$username_pasien);
	}
	function cetakpersetujuan_umum($no_reg,$no_pasien){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["q"]         = $this->Mpersetujuan->getpasien_detail();
		$data["q1"]        = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]        = $this->Mpersetujuan->getpersetujuanumum_detail($no_reg);
		$this->load->view("persetujuan/vcetakpersetujuan_umum",$data);
	}
	function cetakpernyataan_covid($no_reg,$no_pasien){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["q"]         = $this->Mpersetujuan->getpasien_detail2($no_pasien);
		$data["q1"]        = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]        = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
		$data["q3"]        = $this->Mpersetujuan->getpersetujuanumum_detail($no_reg);
		$this->load->view("persetujuan/vcetakpernyataan_covid",$data);
	}
	function cetakpersetujuan_all($no_reg,$no_pasien,$jenis="ranap"){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["jenis"] = $jenis;
		$data["q"]         = $this->Mpersetujuan->getpasien_detail2($no_pasien);
		$data["q1"]        = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]        = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
		$data["q3"]        = $this->Mpersetujuan->getpersetujuanumum_detail($no_reg);
		$this->load->view("persetujuan/vcetakpersetujuan_all",$data);
	}
	function cetakkonfirmasi_covid($no_reg,$no_pasien,$jenis="ranap"){
		$data["no_reg"]    = $no_reg;
		$data["no_pasien"] = $no_pasien;
		$data["jenis"] = $jenis;
		$data["q"]         = $this->Mpersetujuan->getpasien_detail2($no_pasien);
		$data["q1"]        = $this->Mpersetujuan->getpasieninap_detail($no_reg);
		$data["q2"]        = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
		$data["q3"]        = $this->Mpersetujuan->getpersetujuanumum_detail($no_reg);
		$data["q4"]        = $this->Mpersetujuan->getsetuprs();
		$this->load->view("persetujuan/vcetakkonfirmasi_covid",$data);
	}
	function gettd_saksi($no_reg,$no_pasien){
		$image = "data:image/gif;base64,".$this->Mpersetujuan->getttd_persetujuan($no_reg,$no_pasien)->row()->ttd_saksi;
		echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
	}
	function gettd_pernyataan($no_reg,$no_pasien){
		$image = "data:image/gif;base64,".$this->Mpersetujuan->getttd_persetujuan($no_reg,$no_pasien)->row()->ttd_pernyataan;
		echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
	}
	function gettd_saksi2($no_reg,$no_pasien){
		$image = "data:image/gif;base64,".$this->Mpersetujuan->getttd_persetujuan_umum($no_reg,$no_pasien)->row()->ttd_pernyataan;
		echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
	}
	function gettd_pernyataan2($no_reg,$no_pasien){
		$image = "data:image/gif;base64,".$this->Mpersetujuan->getttd_persetujuan_umum($no_reg,$no_pasien)->row()->ttd_pernyataan;
		echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
	}
}
?>
