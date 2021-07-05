<?php
class Adminpuskes extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Madminpuskes');
		$this->load->Model('Madmindkk');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index(){
    	$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="user";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vmanajemenuser";
	    $data["q"] = $this->Madminpuskes->getpuskesuser();
	    $data["title_header"] = "<h2>Data User</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>User</strong></li>";
        $this->load->view('template',$data);
    }
    function formuser($id=null){
    	$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="user";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vformuser";
	    $data["id"] = $id;
		$data["q"] = $this->Madminpuskes->getstatus_user();
		$data["q2"] = $this->Madminpuskes->getpuskesuserdetail($id)->row();
	    $data["title_header"] = "<h2>Data User</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>User</strong></li>";
        $this->load->view('template',$data);
    }
	function simpanuser($aksi){
		$message = $this->Madminpuskes->simpanuser($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes");
	}
	function hapususer($id){
		$message = $this->Madminpuskes->hapususer($id);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes");
	}
	function posyandu(){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="posyandu";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vposyandu";
	    $data["q1"] = $this->Madminpuskes->getposyandu();
	    $data["title_header"] = "<h2>Data Posyandu</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>Posyandu</strong></li>";
        $this->load->view('template',$data);
    }
	function formposyandu($id=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="posyandu";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vformposyandu";
	    $data["id"] = $id;
		$data["q1"] = $this->Madmindkk->getkecamatan();
		$data["q2"] = $this->Madminpuskes->getposyandudetail($id)->row();
	    $data["title_header"] = "<h2>Data Posyandu</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>Posyandu</strong></li>";
        $this->load->view('template',$data);
    }
	function simpanposyandu($aksi){
		$message = $this->Madminpuskes->simpanposyandu($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes/posyandu");
	}
	function hapusposyandu($id){
		$message = $this->Madminpuskes->hapusposyandu($id);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes/posyandu");
	}
	function binaan(){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="binaan";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vbinaan";
		$data["q1"] = $this->Madminpuskes->getsdbinaan();
	    $data["title_header"] = "<h2>Data SD Binaan</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>SD Binaan</strong></li>";
        $this->load->view('template',$data);
    }
	function formbinaan($id=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="binaan";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vformbinaan";
		$data["id"] = $id;
		$data["q1"] = $this->Madmindkk->getkecamatan();
		$data["q2"] = $this->Madminpuskes->getsdbinaandetail($id)->row();
	    $data["title_header"] = "<h2>Data SD Binaan</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>SD Binaan</strong></li>";
        $this->load->view('template',$data);
    }
    function simpanbinaan($aksi){
		$message = $this->Madminpuskes->simpanbinaan($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes/binaan");
	}
	function hapusbinaan($id){
		$message = $this->Madminpuskes->hapusbinaan($id);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes/binaan");
	}
	function paramedis($id_jenisparamedis=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="paramedis";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vparamedis";
		$data["id_jenisparamedis"] = $id_jenisparamedis;
		$data["q1"] = $this->Madminpuskes->getparamedis($id_jenisparamedis);
		$data["q2"] = $this->Madminpuskes->getjenisparamedis();
	    $data["title_header"] = "<h2>Data Paramedis</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>Paramedis</strong></li>";
        $this->load->view('template',$data);
    }
	function formparamedis($id=NULL){
		$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="paramedis";
	    $data['vmenu']="adminpuskes/vmenu";
	    $data["content"]="adminpuskes/vformparamedis";
		$data["id"] = $id;
		$data["q1"] = $this->Madminpuskes->getjenisparamedis();
		$data["q2"] = $this->Madminpuskes->getparamedisdetail($id)->row();
		$data["q3"] = $this->Madmindkk->getlayanan();
	    $data["title_header"] = "<h2>Data Paramedis</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>Paramedis</strong></li>";
        $this->load->view('template',$data);
    }
	function simpanparamedis($aksi){
		$message = $this->Madminpuskes->simpanparamedis($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes/paramedis");
	}
	function hapusparamedis($id){
		$message = $this->Madminpuskes->hapusparamedis($id);
        $this->session->set_flashdata("message",$message);
        redirect("adminpuskes/paramedis");
	}
	function getkelurahan($id_kecamatan,$id_kelurahan=NULL){
		$q = $this->Madmindkk->getkelurahan($id_kecamatan);
		$html = "<script>
				 $(document).ready(function(){
					var id_kecamatan = $(\"select[name='id_kecamatan']\").val();
					var id_kelurahan = $(\"select[name='id_kelurahan']\").val();
					var url = \"".site_url('adminpuskes/getrw')."/\"+id_kecamatan+\"/\"+id_kelurahan;
					$(\"#rw\").load(url);
					$(\"select[name='id_kelurahan']\").change(function(){
						var id_kecamatan = $(\"select[name='id_kecamatan']\").val();
						var id_kelurahan = $(this).val();
						var url = \"".site_url('adminpuskes/getrw')."/\"+id_kecamatan+\"/\"+id_kelurahan;
						$(\"#rw\").load(url);
						return false;
					});
				});</script>";
		$html .= "<select name='id_kelurahan' class='form-control'>";
			foreach($q->result() as $row){
				if ($id_kelurahan==$row->id_kelurahan) $seleksi = "selected"; else $seleksi = "";
				$html .= "<option value='".$row->id_kelurahan."' ".$seleksi.">".$row->nama_kelurahan."</option>";
			}
		$html .= "</select>";
		echo $html;
	}
	function getrw($id_kecamatan,$id_kelurahan,$id_rw=NULL){
		$q = $this->Madmindkk->getrw($id_kecamatan,$id_kelurahan);
		$html = "<select name='id_rw' class='form-control'>";
			foreach($q->result() as $row){
				if ($id_rw==$row->id_rw) $seleksi = "selected"; else $seleksi = "";
				$html .= "<option value='".$row->id_rw."' ".$seleksi.">".$row->nama_rw."</option>";
			}
		$html .= "</select>";
		echo $html;
	}
}
?>