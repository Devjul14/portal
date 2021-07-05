<?php
class Jadwaloka extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Mhome');
    }
    function index(){
        $data["r"]              = $this->Mhome->getruangan();
        // $data["p"]              = $this->Mhome->getpoliklinik();
        // $data["poli"]           = $this->Mhome->getpasien_poli2();
        $data["kelas"]          = $this->Mhome->getkelas();
        $data["bed"]            = $this->Mhome->getbed();
        $data["inap"]           = $this->Mhome->getpasien_inap();
        $data["inap2"]          = $this->Mhome->getpasien_inap2();
        $data["breadcrumb"]     = "<li class='active'><strong>Pelayanan</strong></li>";
        // $data["total_pasien"]   = $this->Mhome->gettotalpasien();
        $this->load->view('bedmapping/vbedmapping',$data);
    }  
}
?>