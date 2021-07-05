<?php
class Admindkk extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Madmindkk');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
               redirect("login/logout","refresh");
        }
	}
    function index(){
        $data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="user";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vmanajemenuser";
	    $data["q"] = $this->Madmindkk->getmanajemenuser();
	    $data["title_header"] = "Data User Administrator Puskesmas";
	    $data["breadcrumb"] = "<li class='active'><strong>User</strong></li>";
        $this->load->view('template',$data);
    }
    function formuser($id=null){
        $data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="user";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vformuser";
	    $data["id"] = $id;
    	$data["q"] = $this->Madmindkk->getuser($id)->row();
	    $data["q1"] = $this->Madmindkk->getpuskesmas();
	    $data["title_header"] = "Data User Administrator Puskesmas";
	    $data["breadcrumb"] = "<li class='active'><strong>User</strong></li>";
        $this->load->view('template',$data);
    }
	function simpanuser($aksi){
		$message = $this->Madmindkk->simpanuser($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk");
	}
	function hapususer($id){
		$message = $this->Madmindkk->hapususer($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk");
	}
	function kecamatan(){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="kecamatan";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vkecamatan";
	    $data["q"] = $this->Madmindkk->getkecamatan();
	    $data["title_header"] = "Data Kecamatan";
	    $data["breadcrumb"] = "<li class='active'><strong>Kecamatan</strong></li>";
        $this->load->view('template',$data);
    }
	function formkecamatan($id=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="kecamatan";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vformkecamatan";
	    $data["id"] = $id;
	    $data["q"] = $this->Madmindkk->getkecamatandetail($id)->row();
	    $data["title_header"] = "Data Kecamatan";
	    $data["breadcrumb"] = "<li class='active'><strong>Kecamatan</strong></li>";
        $this->load->view('template',$data);
    }
	function simpankecamatan($aksi){
		$message = $this->Madmindkk->simpankecamatan($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/kecamatan");
	}
	// function hapuskecamatan($id){
	// 	$message = $this->Madmindkk->hapuskecamatan($id);
 //        $this->session->set_flashdata("message",$message);
 //        redirect("admindkk/kecamatan");
	// }
	// function kelurahan($id_kecamatan=NULL){
	// 	$data["title"] = $this->session->userdata('status_user');
	// 	$data['judul'] = "Data Kelurahan&nbsp;&nbsp;&nbsp;";
	// 	$data["menu"] = "admindkk/vmenu";
	// 	$data["content"] = "admindkk/vkelurahan";
	// 	$data["id_kecamatan"] = $id_kecamatan;
	// 	$data["q1"] = $this->Madmindkk->getkelurahan($id_kecamatan);
	// 	$data["q2"] = $this->Madmindkk->getkecamatan();
 //        $this->load->view('template',$data);
 //    }
	// function addkelurahan($id=NULL){
	// 	$data["title"] = $this->session->userdata('status_user');
	// 	$data['judul'] = "Tambah Data Kelurahan&nbsp;&nbsp;&nbsp;";
	// 	$data["menu"] = "admindkk/vmenu";
	// 	$data["content"] = "admindkk/vaddkelurahan";
	// 	$data["id"] = $id;
	// 	$data["q1"] = $this->Madmindkk->getkecamatan();
	// 	$data["q2"] = $this->Madmindkk->getkelurahandetail($id);
 //        $this->load->view('template',$data);
 //    }
	// function simpankelurahan($action){
	// 	$message = $this->Madmindkk->simpankelurahan($action);
 //        $this->session->set_flashdata("message",$message);
 //        redirect("admindkk/kelurahan");
	// }
	// function hapuskelurahan($id){
	// 	$message = $this->Madmindkk->hapuskelurahan($id);
 //        $this->session->set_flashdata("message",$message);
 //        redirect("admindkk/kelurahan");
	// }
	function puskesmas($id_kecamatan=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="puskesmas";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vpuskesmas";
	    $data["id_kecamatan"] = $id_kecamatan;
	    $data["q1"] = $this->Madmindkk->getpuskesmas2($id_kecamatan);
		$data["q2"] = $this->Madmindkk->getkecamatan();
	    $data["title_header"] = "Data Puskesmas";
	    $data["breadcrumb"] = "<li class='active'><strong>Puskesmas</strong></li>";
        $this->load->view('template',$data);
    }
	function formpuskesmas($id=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="puskesmas";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vformpuskesmas";
	    $data["id"] = $id;
		$data["q1"] = $this->Madmindkk->getkecamatan();
		$data["q2"] = $this->Madmindkk->getpuskesmasdetail($id)->row();
	    $data["title_header"] = "Data Puskesmas";
	    $data["breadcrumb"] = "<li class='active'><strong>Puskesmas</strong></li>";
        $this->load->view('template',$data);
    }
	function simpanpuskesmas($aksi){
		$message = $this->Madmindkk->simpanpuskesmas($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/puskesmas");
	}
	function hapuspuskesmas($id){
		$message = $this->Madmindkk->hapuspuskesmas($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/puskesmas");
	}
	function layanan(){
        $data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="layanan";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vlayanan";
	    $data["q"] = $this->Madmindkk->getlayanan();
	    $data["title_header"] = "Data Layanan";
	    $data["breadcrumb"] = "<li class='active'><strong>Layanan</strong></li>";
        $this->load->view('template',$data);
    }
	function formlayanan($id=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="layanan";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vformlayanan";
	    $data["id"] = $id;
		$data["q"] = $this->Madmindkk->getlayanandetail($id)->row();
	    $data["title_header"] = "Data Layanan";
	    $data["breadcrumb"] = "<li class='active'><strong>Layanan</strong></li>";
        $this->load->view('template',$data);
    }
	function simpanlayanan($aksi){
		$message = $this->Madmindkk->simpanlayanan($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/layanan");
	}
	function hapuslayanan($id){
		$message = $this->Madmindkk->hapuslayanan($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/layanan");
	}
	function tindakan($id_layanan=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="tindakan";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vtindakan";
	    $data["q2"] = $this->Madmindkk->getlayanan();
	    $data["q1"] = $this->Madmindkk->gettindakan($id_layanan);
	    $data["id_layanan"] = $id_layanan;
	    $data["title_header"] = "Data Tindakan";
	    $data["breadcrumb"] = "<li class='active'><strong>Tindakan</strong></li>";
        $this->load->view('template',$data);
    }
	// function addtindakan($id=NULL){
	// 	$data["title"] = $this->session->userdata('status_user');
	// 	$data['judul'] = "Tambah Data Tindakan&nbsp;&nbsp;&nbsp;";
	// 	$data["menu"] = "admindkk/vmenu";
	// 	$data["content"] = "admindkk/vaddtindakan";
	// 	$data["id"] = $id;
	// 	$data["q1"] = $this->Madmindkk->getlayanan();
	// 	$data["q2"] = $this->Madmindkk->gettindakandetail($id);
 //        $this->load->view('template',$data);
 //    }
	// function simpantindakan($action){
	// 	$message = $this->Madmindkk->simpantindakan($action);
 //        $this->session->set_flashdata("message",$message);
 //        redirect("admindkk/tindakan");
	// }
	// function hapustindakan($id){
	// 	$message = $this->Madmindkk->hapustindakan($id);
 //        $this->session->set_flashdata("message",$message);
 //        redirect("admindkk/tindakan");
	// }
}
?>