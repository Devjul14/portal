<?php
class Klinik extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Mklinik');
	}
    function index($tindakan="all",$tgl1="",$tgl2=""){
      $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
      $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
      $data["tgl1"] = $tgl1;
      $data["tgl2"] = $tgl2;
      $data["tindakan"] = $tindakan;
      $data['menu']="home";
      $data["title"]        = "Rekap Rawat Jalan || RS CIREMAI";
      $data["title_header"] = "Rekap Rawat Jalan ";
      $data["t"] = $this->Mklinik->getpoliklinik();
      $data["p"] = $this->Mklinik->rekap_ralan_full($tindakan,$tgl1,$tgl2);
      $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
      $this->load->view('home/vklinik',$data);
    }
  }
  ?>
