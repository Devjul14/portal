<?php
class Petugas extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mpetugas');
        $this->load->Model('Mdokter');
        $this->load->Model('Mkasir');
        $this->load->Model('Mpendaftaran');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
               redirect("login/logout","refresh");
        }
	}
    function kasir(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mpetugas->getkasir();
	    $data['menu']			= "petugas";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/petugas/vkasir";
	    $data["title_header"] 	= "Kasir";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Kasir</strong></li>";
        $this->load->view('template',$data);
    }
    function formkasir($nip=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mpetugas->getkasir_detail($nip);
	    $data["nip"]            = $nip;
	    $data['menu']           = "petugas";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/petugas/vformkasir";
	    $data["title_header"]   = "Form Petugas Kasir";
	    $data["breadcrumb"]     = "<li class='active'><strong>Petugas Kasir</strong></li>";
        $this->load->view('template',$data);
    }
    function simpankasir($aksi){
		$message = $this->Mpetugas->simpankasir($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("petugas/kasir");
	}
	function hapuskasir($id){
		$message = $this->Mpetugas->hapuskasir($id);
        $this->session->set_flashdata("message",$message);
        redirect("petugas/kasir");
    }
    function getttd(){
        $this->db->select("ttd");
        $d = $this->db->get_where("petugas_kasir",["nip"=>$this->input->post("nip")]);
        echo $d->row()->ttd;
    }
    function getttdrm(){
        $this->db->select("ttd");
        $d = $this->db->get_where("petugas_rm",["nip"=>$this->input->post("nip")]);
        echo $d->row()->ttd;
    }
    function getphoto(){
        $this->db->select("photo");
        $d = $this->db->get_where("petugas_kasir",["nip"=>$this->input->post("nip")]);
        echo $d->row()->photo;
    }
     function lab(){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Mpetugas->getlab();
        $data['menu']           = "petugas";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/petugas/lab/vlab";
        $data["title_header"]   = "Petugas Lab";
        $data["breadcrumb"]     = "<li class='active'><strong>Petugas Lab</strong></li>";
        $this->load->view('template',$data);
    }
    function formlab($nip=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Mpetugas->getlab_detail($nip);
        $data["nip"]            = $nip;
        $data['menu']           = "petugas";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/petugas/lab/vformlab";
        $data["title_header"]   = "Form Petugas Lab";
        $data["breadcrumb"]     = "<li class='active'><strong>Petugas Lab</strong></li>";
        $this->load->view('template',$data);
    }
    function simpanlab($aksi){
        $message = $this->Mpetugas->simpanlab($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("petugas/lab");
    }
    function hapuslab($id){
        $message = $this->Mpetugas->hapuslab($id);
        $this->session->set_flashdata("message",$message);
        redirect("petugas/lab");
    }
    function getttd_pa(){
        $this->db->select("ttd");
        $d = $this->db->get_where("analys",["nip"=>$this->input->post("nip")]);
        echo $d->row()->ttd;
    }
    function getphoto_pa(){
        $this->db->select("photo");
        $d = $this->db->get_where("analys",["nip"=>$this->input->post("nip")]);
        echo $d->row()->photo;
    }
    function rekammedis(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mpetugas->getrekammedis();
	    $data['menu']			= "petugas";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/petugas/rekammedis/vrekammedis";
	    $data["title_header"] 	= "Rekam Medis";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Rekam Medis</strong></li>";
        $this->load->view('template',$data);
    }
    function formrekammedis($nip=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mpetugas->getrekammedis_detail($nip);
	    $data["nip"]            = $nip;
	    $data['menu']           = "petugas";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/petugas/rekammedis/vformrekammedis";
	    $data["title_header"]   = "Form Petugas RM";
	    $data["breadcrumb"]     = "<li class='active'><strong>Petugas Kasir</strong></li>";
        $this->load->view('template',$data);
    }
    function simpanrekammedis($aksi){
		$message = $this->Mpetugas->simpanrekammedis($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("petugas/rekammedis");
	}
	function hapusrekammedis($id){
		$message = $this->Mpetugas->hapusrekammedis($id);
        $this->session->set_flashdata("message",$message);
        redirect("petugas/rekammedis");
    }
}
?>