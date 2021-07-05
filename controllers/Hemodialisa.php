<?php
class Hemodialisa extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mpa');
		$this->load->Model('Mpendaftaran');
        $this->load->Model('Mkasir');
        $this->load->Model('Mlab');
        $this->load->Model('Mhemodialisa');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function rekap_full($tindakan,$tgl1="",$tgl2=""){
      $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
      $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
      $data["tgl1"] = $tgl1;
      $data["tgl2"] = $tgl2;
      $data["tindakan"] = $tindakan;
      $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
      $data['menu']="home";
      $data["title"]        = "Rekap Haemodialisa || RS CIREMAI";
      $data["title_header"] = "Rekap Haemodialisa ";
      $data["content"] = "hemodialisa/vhemarekap_full";
      $data["t"] = $this->Mhemodialisa->gettarif_inap();
      $data["p"] = $this->Mhemodialisa->rekap_ralan_full("0102026",$tgl1,$tgl2);
      $data["p_inap"] = $this->Mhemodialisa->rekap_inap_full("hdl",$tgl1,$tgl2);
      $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
      $this->load->view('template',$data);
    }
    function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
      echo json_encode($this->Mhemodialisa->getpasien_rekap_full($tindakan,$tgl1,$tgl2));
    }
    function cetakpasien_full($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["t2"] = $this->Mhemodialisa->gettindakan_cetak();
        $data["tindakan"] = $tindakan;
        $data["q"] = $this->Mhemodialisa->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('hemodialisa/vcetakpasien_full',$data);
    }
    function cetakrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap Haemodialisa Full || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap Haemodialisa Full";
        $data["t"] = $this->Mhemodialisa->gettarif_inap();
        $data["t2"] = $this->Mhemodialisa->gettindakan_cetak();
        $data["p"] = $this->Mhemodialisa->rekap_ralan_full("0102026",$tgl1,$tgl2);
        $data["p_inap"] = $this->Mhemodialisa->rekap_inap_full("hdl",$tgl1,$tgl2);
        $this->load->view('hemodialisa/vcetakrekap_full',$data);
    }
    function excelrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mhemodialisa->gettarif_inap();
        $data["t2"] = $this->Mhemodialisa->gettindakan_cetak();
        $data["p"] = $this->Mhemodialisa->rekap_ralan_full("0102026",$tgl1,$tgl2);
        $data["p_inap"] = $this->Mhemodialisa->rekap_inap_full("hdl",$tgl1,$tgl2);
        $this->load->view('hemodialisa/vhaemoexcelrekap_full',$data);
    }
}
?>