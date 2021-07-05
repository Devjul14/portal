<?php
class Tarif extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mtarif');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
               redirect("login/logout","refresh");
        }
	}
    function tarif_ambulance(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_ambulance();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_ambulance";
	    $data["title_header"] 	= "Tarif Ambulance";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Ambulance</strong></li>";
        $this->load->view('template',$data);
    }
    function form_ambulance($kode=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->getambulance_detail($kode);
	    $data["kode"]           = $kode;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_ambulance";
	    $data["title_header"]   = "Form Tarif Ambulance";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
    function simpan_tarifambulance($aksi){
		$message = $this->Mtarif->simpan_tarifambulance($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_ambulance");
	}
    function tarif_gizi(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_gizi();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_gizi";
	    $data["title_header"] 	= "Tarif Gizi";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Gizi</strong></li>";
        $this->load->view('template',$data);
    }
    function form_gizi($kode_tindakan=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->getgizi_detail($kode_tindakan);
	    $data["kode_tindakan"]  = $kode_tindakan;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_gizi";
	    $data["title_header"]   = "Form Tarif Gizi";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
    function simpan_tarifgizi($aksi){
		$message = $this->Mtarif->simpan_tarifgizi($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_gizi");
	}
    function tarif_inap(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_inap();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_inap";
	    $data["title_header"] 	= "Tarif Inap";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Inap</strong></li>";
        $this->load->view('template',$data);
    }
    function form_inap($kode_tindakan=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->gettarifinap_detail($kode_tindakan);
	    $data["kode_tindakan"]  = $kode_tindakan;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_inap";
	    $data["title_header"]   = "Form Tarif Inap";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
	function simpan_tarifinap($aksi){
		$message = $this->Mtarif->simpan_tarifinap($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_inap");
	}
	function tarif_lab(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_lab();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_lab";
	    $data["title_header"] 	= "Tarif Lab";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Lab</strong></li>";
        $this->load->view('template',$data);
    }
	function form_lab($kode_tindakan=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->getlab_detail($kode_tindakan);
	    $data["kode_tindakan"]    = $kode_tindakan;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_lab";
	    $data["title_header"]   = "Form Tarif Lab";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
	function simpan_tariflab($aksi){
		$message = $this->Mtarif->simpan_tariflab($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_lab");
	}
	function tarif_operasi(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_operasi();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_operasi";
	    $data["title_header"] 	= "Tarif Operasi";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Operasi</strong></li>";
        $this->load->view('template',$data);
    }
	function form_operasi($kode=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->gettarifoperasi_detail($kode);
	    $data["kode"]  			= $kode;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_operasi";
	    $data["title_header"]   = "Form Tarif Operasi";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
	function simpan_tarifoperasi($aksi){
		$message = $this->Mtarif->simpan_tarifoperasi($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_operasi");
	}
	function tarif_pa(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_pa();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_pa";
	    $data["title_header"] 	= "Tarif PA";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif PA</strong></li>";
        $this->load->view('template',$data);
    }
	function form_pa($kode_tindakan=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->getpa_detail($kode_tindakan);
	    $data["kode_tindakan"]  = $kode_tindakan;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_pa";
	    $data["title_header"]   = "Form Tarif PA";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
	function simpan_tarifpa($aksi){
		$message = $this->Mtarif->simpan_tarifpa($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_pa");
	}
	function tarif_penunjangmedis(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_penunjangmedis();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_penunjangmedis";
	    $data["title_header"] 	= "Tarif Penunjang Medis";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Penunjang Medis</strong></li>";
        $this->load->view('template',$data);
    }
	function form_penunjangmedis($kode=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->getpm_detail($kode);
	    $data["kode"]  			= $kode;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_penunjangmedis";
	    $data["title_header"]   = "Form Tarif Penunjang Medis";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
	function simpan_tarifpenunjangmedis($aksi){
		$message = $this->Mtarif->simpan_tarifpenunjangmedis($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_penunjangmedis");
	}
	function tarif_radiologi(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_radiologi();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_radiologi";
	    $data["title_header"] 	= "Tarif Radiologi";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Radiologi</strong></li>";
        $this->load->view('template',$data);
    }
	function form_radiologi($id_tindakan=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->getradiologi_detail($id_tindakan);
	    $data["id_tindakan"]  			= $id_tindakan;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_radiologi";
	    $data["title_header"]   = "Form Tarif Radiologi";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
	function simpan_tarifradiologi($aksi){
		$message = $this->Mtarif->simpan_tarifradiologi($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_radiologi");
	}
	function tarif_ralan(){
        $data["title"]			= $this->session->userdata('status_user');
        $data["username"] 		= $this->session->userdata('username');
	    $data["q"] 				= $this->Mtarif->gettarif_ralan();
	    $data['menu']			= "tarif";
	    $data['vmenu']			= "admindkk/vmenu";
	    $data["content"]		= "admindkk/tarif/vt_ralan";
	    $data["title_header"] 	= "Tarif Ralan";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Tarif Ralan</strong></li>";
        $this->load->view('template',$data);
    }
	function form_ralan($kode_tindakan=""){
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
    	$data["q"]              = $this->Mtarif->getralan_detail($kode_tindakan);
	    $data["kode_tindakan"]  = $kode_tindakan;
	    $data['menu']           = "tarif";
	    $data['vmenu']          = "admindkk/vmenu";
	    $data["content"]        = "admindkk/tarif/vform_ralan";
	    $data["title_header"]   = "Form Tarif Ralan";
	    $data["breadcrumb"]     = "<li class='active'><strong>Tarif</strong></li>";
        $this->load->view('template',$data);
    }
	function simpan_tarifralan($aksi){
		$message = $this->Mtarif->simpan_tarifralan($aksi);
        $this->session->set_flashdata("message",$message);
        redirect("tarif/tarif_ralan");
	}
}

?>