<?php
class Poliklinik extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mpoliklinik');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
               redirect("login/logout","refresh");
        }
	}
    function view(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mpoliklinik->getpoliklinik();
	    $data['menu']			= "poliklinik";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/poliklinik/vpoliklinik";
	    $data["title_header"] 	= "Poliklinik";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Poliklinik</strong></li>";
        $this->load->view('template',$data);
    }
    function formpoliklinik($id=null){
        $data["title"] = $this->session->userdata('status_user');
        // $data["username"] = $this->session->userdata('username');
	    $data['menu']="poliklinik";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/poliklinik/vformpoliklinik";
	    $data["id"] = $id;
        $data["q1"] = $this->Mpoliklinik->getpoliklinik();
    	$data["q"] = $this->Mpoliklinik->getpoliklinikdetail($id);
	    $data["title_header"] = "Form Poliklinik";
	    $data["breadcrumb"] = "<li class='active'><strong>Poliklinik</strong></li>";
        $this->load->view('template',$data);
    }
    function simpanpoliklinik($aksi){
        $message = $this->Mpoliklinik->simpanpoliklinik($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("poliklinik/view");
    }
    function hapuspoliklinik($id){
        $message = $this->Mpoliklinik->hapuspoliklinik($id);
        $this->session->set_flashdata("message",$message);
        redirect("poliklinik/view");
    }

}

?>