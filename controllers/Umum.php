<?php
class Umum extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mumum');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index(){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Home &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = "umum/vmenu";
        $data["menu"]               = "dashboard";
        $data["title_header"]       = "Home ";
        $data["breadcrumb"]         = "<li class='active'><strong>Home</strong></li>";
        $data["content"]            = "umum/vhomeumum";
        $this->load->view('template',$data);
    }
}
?>