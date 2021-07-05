<?php
class Antrian extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mantrian');
    }
    function index(){
        $data["p"] = $this->Mantrian->getpoli();
        $this->load->view('antrian/vantrian',$data);
    }
    function getgolpasien(){
        $d = $this->Mantrian->getgolpasien();
        echo json_encode($d);
    }
    function getdokter(){
        $d = $this->Mantrian->getdokter();
        echo json_encode($d);
    }
    function maks(){
        $d = $this->Mantrian->maks();
        echo json_encode($d);
    }
    function getpasien(){
        $d = $this->Mantrian->getpasien();
        echo json_encode($d);
    }
    function getpasien_online(){
        $d = $this->Mantrian->getpasien_online();
        echo json_encode($d);
    }
    function getnoregsebelumnya(){
        $d = $this->Mantrian->getnoregsebelumnya();
        echo json_encode($d);
    }
    function simpan_pasien(){
        $d = $this->Mantrian->simpan_pasien();
        echo json_encode($d);
    }
}
?>
