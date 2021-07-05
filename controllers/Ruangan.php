<?php
class Ruangan extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mruangan');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
               redirect("login/logout","refresh");
        }
	}
    function view(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mruangan->getruangan();
	    $data['menu']			= "ruangan";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/ruangan/vruangan";
	    $data["title_header"] 	= "Ruangan";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Ruangan</strong></li>";
        $this->load->view('template',$data);
    }
    function formruangan($kode_ruangan=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mruangan->getruangan_detail($kode_ruangan);
	    $data["kode_ruangan"]   = $kode_ruangan;
	    $data['menu']           = "ruangan";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/ruangan/vform_ruangan";
	    $data["title_header"]   = "Form Ruangan";
	    $data["breadcrumb"]     = "<li class='active'><strong>Ruangan</strong></li>";
        $this->load->view('template',$data);
    }
	function simpanruangan($aksi){
		$message = $this->Mruangan->simpanruangan($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("ruangan/view");
	}
	function hapusruangan($id){
		$message = $this->Mruangan->hapusruangan($id);
        $this->session->set_flashdata("message",$message);
        redirect("ruangan/view");
	}
    function kelas(){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Mruangan->getkelas();
        $data['menu']           = "ruangan";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/ruangan/vkelas";
        $data["title_header"]   = "Kelas";
        $data["breadcrumb"]     = "<li class='active'><strong>Kelas</strong></li>";
        $this->load->view('template',$data);
    }
    function formkelas($kode_kelas=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Mruangan->getkelas_detail($kode_kelas);
        $data["kode_kelas"]   = $kode_kelas;
        $data['menu']           = "ruangan";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/ruangan/vform_kelas";
        $data["title_header"]   = "Form Kelas";
        $data["breadcrumb"]     = "<li class='active'><strong>Kelas</strong></li>";
        $this->load->view('template',$data);
    }
    function simpankelas($aksi){
        $message = $this->Mruangan->simpankelas($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("ruangan/kelas");
    }
    function hapuskelas($id){
        $message = $this->Mruangan->hapuskelas($id);
        $this->session->set_flashdata("message",$message);
        redirect("ruangan/kelas");
    }
    function kamar($kode_ruangan="---",$kode_kelas="---"){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Mruangan->getkamar($kode_ruangan,$kode_kelas);
        $data["q1"]             = $this->Mruangan->getruangan();
        $data["q2"]             = $this->Mruangan->getkelas();
        $data["kode_ruangan"]   = $kode_ruangan;
        $data["kode_kelas"]     = $kode_kelas;
        $data['menu']           = "ruangan";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/ruangan/vkamar";
        $data["title_header"]   = "Kamar";
        $data["breadcrumb"]     = "<li class='active'><strong>Kamar</strong></li>";
        $this->load->view('template',$data);
    }
    function formkamar($kode_kamar="",$no_bed=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Mruangan->getkamar_detail($kode_kamar,$no_bed);
        $data["q1"]             = $this->Mruangan->getruangan();
        $data["q2"]             = $this->Mruangan->getkelas();
        $data["kode_kamar"]     = $kode_kamar;
        $data["no_bed"]         = $no_bed;
        $data['menu']           = "ruangan";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/ruangan/vform_kamar";
        $data["title_header"]   = "Form Kamar";
        $data["breadcrumb"]     = "<li class='active'><strong>Kamar</strong></li>";
        $this->load->view('template',$data);
    }
    function simpankamar($aksi){
        $message = $this->Mruangan->simpankamar($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("ruangan/kamar");
    }
    function hapuskamar($id,$no_bed){
        $message = $this->Mruangan->hapuskamar($id,$no_bed);
        $this->session->set_flashdata("message",$message);
        redirect("ruangan/kamar");
    }

}

?>