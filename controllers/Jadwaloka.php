<?php
class Jadwaloka extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Moka');
    }
    function index(){
        $data["q"] = $this->Moka->getjadwal_dashboard();
        $data["qk"] = $this->Moka->getjadwal_fromklinik();
        $data["dokter"] = $this->Moka->gettabel("dokter");
        $data["ruang"] = $this->Moka->gettabel("ruangan");
        $data["kamar"] = $this->Moka->gettabel("kamar");
        $data["micd"] = $this->Moka->gettabel("master_icd");
        $data["o"] = $this->Moka->getoperasi_array();
        $data["ja"] = $this->Moka->gettabel("jenis_anatesi");
        $data["as"] = $this->Moka->gettabel("asisten_operasi");
        $data["poli"] = $this->Moka->gettabel("poliklinik");
        $this->load->view("jadwal/vjadwaloka",$data);
    }  
}
?>