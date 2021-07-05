<?php

class User extends CI_Controller{

    function __construct(){

        parent::__construct();

        $this->load->Model('Muser');

        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))

        {

               redirect("login/logout","refresh");

        }

	}

    function status_user(){
        $data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="user";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/user/vstatus_user";
	    $data["q"] = $this->Muser->getstatus_user();
	    $data["title_header"] = "Status User";
	    $data["breadcrumb"] = "<li class='active'><strong>Status User</strong></li>";
        $this->load->view('template',$data);
    }
    function formstatus_user($id=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Muser->getstatususer_detail($id);
        $data["q1"]             = $this->Muser->getcontroller();
        $data["id"]             = $id;
        $data['menu']           = "user";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/user/vformstatus_user";
        $data["title_header"]   = "Form Status User";
        $data["breadcrumb"]     = "<li class='active'><strong>Status User</strong></li>";
        $this->load->view('template',$data);
    }
    function simpanstatus_user($aksi){
        $message = $this->Muser->simpanstatus_user($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("user/status_user");
    }
    function hapusstatus_user($id){
        $message = $this->Muser->hapusstatus_user($id);
        $this->session->set_flashdata("message",$message);
        redirect("user/status_user");
    }

    function user_login(){
        $data["title"] = "User Login";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="user";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/user/vuser_login";
        $data["q"] = $this->Muser->getuser_login();
        $data["title_header"] = "User Login";
        $data["breadcrumb"] = "<li class='active'><strong>User Login</strong></li>";
        $this->load->view('template',$data);
    }
    function formuser_login($id=""){
        $data["title"]          = "Form User Login";
        $data["username"]       = $this->session->userdata('username');
        $data["q"]              = $this->Muser->getuserlogin_detail($id);
        $data["stat"]             = $this->Muser->getstatususer();
        $data["id"]             = $id;
        $data['menu']           = "user";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "admindkk/user/vformuser_login";
        $data["title_header"]   = "Form User Login";
        $data["breadcrumb"]     = "<li class='active'><strong>User Login</strong></li>";
        $this->load->view('template',$data);
    }
    function simpanuser_login($aksi){
        $message = $this->Muser->simpanuser_login($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("user/user_login");
    }
    function hapususer_login($id){
        $message = $this->Muser->hapususer_login($id);
        $this->session->set_flashdata("message",$message);
        redirect("user/user_login");
    }

}

?>