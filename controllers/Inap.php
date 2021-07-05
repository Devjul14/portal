<?php

class Inap extends CI_Controller{

    function __construct(){

        parent::__construct();

		$this->load->Model('Mumum');

		$this->load->Model('Minap');

		$this->load->Model('Mpendaftaran');

		$this->load->Model('Mruangan');

        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))

        {

                $this->session->sess_destroy();

				redirect('login','refresh');

        }

    }

    function index(){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="kelas";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vkelas";

	    $data["title_header"] = "<h2>Data Kelas</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Kelas</strong></li>";

	    $data["q"] = $this->Mumum->getkelas();

	    $this->load->view("template",$data);

    }

    function formkelas($id_kelas=null){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="kelas";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vformkelas";

	    $data["title_header"] = "<h2>Form Kelas</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Kelas</strong></li>";

	    $data["id_kelas"] = $id_kelas;

	    $data["q"] = $this->Minap->getkelasdetail($id_kelas);

	    $this->load->view("template",$data);	

    }

    function simpankelas($aksi){

		$message = $this->Minap->simpankelas($aksi);

        $this->session->set_flashdata("message",$message);

        redirect("inap");

	}

	function hapuskelas($id_kelas){

		$message = $this->Minap->hapuskelas($id_kelas);

        $this->session->set_flashdata("message",$message);

        redirect("inap");

	}

	function ruangan($id_kelas="all"){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="ruangan";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vruangan";

	    $data["title_header"] = "<h2>Data Ruangan</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Ruangan</strong></li>";

		$data["id_kelas"] = $id_kelas;

	    $data["q1"] = $this->Mumum->getkelas();

	    $data["q"] = $this->Minap->getruangan($id_kelas);

	    $this->load->view("template",$data);

    }

    function formruangan($id_kelas,$id_ruangan=null){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="ruangan";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vformruangan";

	    $data["title_header"] = "<h2>Form Ruangan</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Ruangan</strong></li>";

		$data["id_kelas"] = $id_kelas;

		$data["id_ruangan"] = $id_ruangan;

		$data["nama_kelas"] = $this->Minap->getkelasdetail($id_kelas)->nama_kelas;

	    $data["q"] = $this->Minap->getruangan_detail($id_kelas,$id_ruangan);

	    $this->load->view("template",$data);

    }

    function simpanruangan($aksi){

		$message = $this->Minap->simpanruangan($aksi);

        $this->session->set_flashdata("message",$message);

        redirect("inap/ruangan/".$this->input->post("id_kelas"));

	}

	function hapusruangan($id_kelas,$id_ruangan){

		$message = $this->Minap->hapusruangan($id_kelas,$id_ruangan);

        $this->session->set_flashdata("message",$message);

        redirect("inap/ruangan/".$id_kelas);

	}

	function pasien($kode_ruangan="---",$kode_kelas="---"){

    	$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
		$data['menu']="pasien";
		$data['vmenu']="inap/vmenu";
	    $data["content"]="inap/vpasien";
	    $data["title_header"] = "<h2>Data Ruangan Untuk Pasien</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>Ruangan Pasien</strong></li>";
	    $data["q"]              = $this->Mruangan->getkamar($kode_ruangan,$kode_kelas);
        $data["q1"]             = $this->Mruangan->getruangan();
        $data["q2"]             = $this->Mruangan->getkelas();
        $data["kode_ruangan"]   = $kode_ruangan;
        $data["kode_kelas"]     = $kode_kelas;
	    $this->load->view("template",$data);


    }

    function ruanganpasien($id_kelas,$id_ruangan){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="pasien";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vdetailruangan";

	    $data["title_header"] = "<h2>Detail Ruangan Pasien</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Ruangan</strong></li>";

		$data["id_kelas"] = $id_kelas;

		$data["id_ruangan"] = $id_ruangan;

		$data["nama_kelas"] = $this->Minap->getkelasdetail($id_kelas)->nama_kelas;

		$data["nama_ruangan"] = $this->Minap->getruangan_detail($id_kelas,$id_ruangan)->nama_ruangan;

	    $data["q"] = $this->Minap->getpasien_inap($id_kelas,$id_ruangan);

	    $this->load->view("template",$data);

    }

    function tambahpasienruangan($id_kelas,$id_ruangan){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="pasien";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vformpasienruangan";

	    $data["title_header"] = "<h2>Tambah Ruangan Pasien</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Ruangan</strong></li>";

		$data["id_kelas"] = $id_kelas;

		$data["id_ruangan"] = $id_ruangan;

		$data["nama_kelas"] = $this->Minap->getkelasdetail($id_kelas)->nama_kelas;

		$data["nama_ruangan"] = $this->Minap->getruangan_detail($id_kelas,$id_ruangan)->nama_ruangan;

		$data["q"] = $this->Minap->getdaftarpasien($id_kelas);

	    $this->load->view("template",$data);

    }

    function simpanpasienruangan(){

		$message = $this->Minap->simpanpasienruangan();

        $this->session->set_flashdata("message",$message);

        $a = $this->input->post("id_kelas")."/".$this->input->post("id_ruangan");

        redirect("inap/ruanganpasien/".$a);

	}

	function pulang($id,$id_kelas,$id_ruangan){

		$message = $this->Minap->pulang($id);

        $this->session->set_flashdata("message",$message);

        redirect("inap/ruanganpasien/".$id_kelas."/".$id_ruangan);

	}

	function perawatanpasien($id,$id_kelas,$id_ruangan){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="pasien";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vperawatan";

	    $data["title_header"] = "<h2>Perawatan Pasien</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Perawatan</strong></li>";

	    $data["id"] = $id;

		$data["id_kelas"] = $id_kelas;

		$data["id_ruangan"] = $id_ruangan;

		$data["nama_kelas"] = $this->Minap->getkelasdetail($id_kelas)->nama_kelas;

		$data["nama_ruangan"] = $this->Minap->getruangan_detail($id_kelas,$id_ruangan)->nama_ruangan;

		$data["nama_pasien"] = $this->Minap->getpasieninap_detail($id)->nama_pasien;

	    $data["q"] = $this->Minap->getpasien_inap($id_kelas,$id_ruangan);

	    $data["q1"] = $this->Minap->gettindakan();

	    $data["q2"] = $this->Minap->gettindakanpasien($id);

	    $this->load->view("template",$data);

    }

    function simpanperawatan(){

		$message = $this->Minap->simpanperawatan();

        $this->session->set_flashdata("message",$message);

        $a = $this->input->post("id_pendaftaran")."/".$this->input->post("id_kelas")."/".$this->input->post("id_ruangan");

        redirect("inap/perawatanpasien/".$a);

	}

	function pindahkamar($id,$id_kelas ="",$id_ruangan =""){

    	$data["title"] = $this->session->userdata('status_user');

        $data["username"] = $this->session->userdata('username');

		$data['menu']="pasien";

		$data['vmenu']="inap/vmenu";

	    $data["content"]="inap/vpindahkamar";

	    $data["title_header"] = "<h2>Pindah Kamar/ Ruangan</h2>";

	    $data["breadcrumb"] = "<li class='active'><strong>Pindah</strong></li>";

	    $data["id"] = $id;

		$data["id_kelas"] = $id_kelas;

		$data["id_ruangan"] = $id_ruangan;

		// $data["nama_kelas"] = $this->Minap->getkelasdetail($id_kelas)->nama_kelas;

		$data["nama_ruangan"] = $this->Minap->getruangan_detail($id_kelas,$id_ruangan)->nama_ruangan;

		$data["nama_pasien"] = $this->Minap->getpasieninap_detail($id)->nama_pasien;

		$data["idpasien"] = $this->Minap->getpasieninap_detail($id)->no_reg;

	    $data["q"] = $this->Minap->getpasien_inap($id_kelas,$id_ruangan);

	    $data["q1"] = $this->Minap->getruangan1();

	    $data["q2"] = $this->Minap->gettindakanpasien($id);

	    $data["q3"] = $this->Minap->getpindahkamar($id);

	    $this->load->view("template",$data);

    }

    function simpanpindahkamar(){

		$message = $this->Minap->simpanpindahkamar();

        $this->session->set_flashdata("message",$message);

        $a = $this->input->post("id_kelas")."/".$this->input->post("id_ruangan");

        redirect("inap/ruanganpasien/".$a);

	}

    

}

?>