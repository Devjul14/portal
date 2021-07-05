<?php
class Keuangan extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mkeuangan');
		$this->load->Model('Mkasir');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index($tgl=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
		$data['menu']="keuangan";
        $data["title"]        = "Pajak Dokter || RS CIREMAI";
        $data["title_header"] = "Pajak Dokter";
        $data["content"] = "keuangan/vpajak";
        $tgl = $tgl=="" ? date("Y-m")."-01" : date("Y-m-d",strtotime("01-".$tgl));
        $data["tgl"] = $tgl;
        $data["breadcrumb"]   = "<li class='active'><strong>Pajak Dokter</strong></li>";
        $data["d"]  = $this->Mkeuangan->getdokter();
        $data["p"] = $this->Mkeuangan->getpajak($tgl);
        $tgl1 = date("Y-m-d",strtotime($tgl));
        $hari = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime($tgl)), date("Y",strtotime($tgl)));
        $tgl2 = date("Y-m",strtotime($tgl))."-".$hari;
        $data["q"] = $this->Mkeuangan->feesharing($tgl1,$tgl2);
        $this->load->view('template',$data);
    }
    function simpan(){
        $message = $this->Mkeuangan->simpan();
        redirect("keuangan");
    }
    function feesharing($tgl1="",$tgl2=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="keuangan";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["title"]        = "Pembagian Jasa Medis || RS CIREMAI";
        $data["title_header"] = "Pembagian Jasa Medis";
        $data["content"] = "keuangan/vfeesharing";
        $data["breadcrumb"]   = "<li class='active'><strong>Pembagian Jasa Medis</strong></li>";
        $data["q"] = $this->Mkeuangan->feesharing($tgl1,$tgl2);
        $data["d"] = $this->Mkeuangan->getdokter_array();
        $data["pajak"] = $this->Mkeuangan->getpajakdokter($tgl1);
        $this->load->view('template',$data);
    }
    function cetak_feesharing($tgl1,$tgl2){
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Mkeuangan->feesharing($tgl1,$tgl2);
        $data["d"] = $this->Mkeuangan->getdokter_array();
        $data["pajak"] = $this->Mkeuangan->getpajakdokter($tgl1);
        $this->load->view('keuangan/vcetak_feesharing',$data);
    }
    function cetakdetail_feesharing($tgl1,$tgl2,$id_dokter,$gol_pasien,$pelayanan){
        $data["id_dokter"] = $id_dokter;
        $data["q"] = $this->Mkeuangan->feesharing($tgl1,$tgl2);
        $data["gol_pasien"] = $gol_pasien;
        $data["pelayanan"] = $pelayanan;
        $this->load->view('keuangan/vcetakdetail_feesharing',$data);
    }
    function exceldetail_feesharing($tgl1,$tgl2,$id_dokter,$gol_pasien,$pelayanan){
        $data["id_dokter"] = $id_dokter;
        $data["q"] = $this->Mkeuangan->feesharing($tgl1,$tgl2);
        $data["gol_pasien"] = $gol_pasien;
        $data["pelayanan"] = $pelayanan;
        $this->load->view('keuangan/vexceldetail_feesharing',$data);
    }
    function excel_feesharing($tgl1,$tgl2){
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Mkeuangan->feesharing($tgl1,$tgl2);
        $data["d"] = $this->Mkeuangan->getdokter_array();
        $data["pajak"] = $this->Mkeuangan->getpajakdokter($tgl1);
        $this->load->view('keuangan/vexcel_feesharing',$data);
    }
    function pointsharing($tgl1="",$tgl2=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="keuangan";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["title"]        = "Point || RS CIREMAI";
        $data["title_header"] = "Point";
        $data["content"] = "keuangan/vpointsharing";
        $data["breadcrumb"]   = "<li class='active'><strong>Point</strong></li>";
        $data["q"] = $this->Mkeuangan->pointsharing($tgl1,$tgl2);
        $this->load->view('template',$data);
    }
    function cetakdetail_point($tgl1,$tgl2){
        $data["row"] = $this->Mkeuangan->pointsharing($tgl1,$tgl2);
        $this->load->view('keuangan/vcetakdetail_point',$data);
    }
    function exceldetail_point($tgl1,$tgl2){
        $data["row"] = $this->Mkeuangan->pointsharing($tgl1,$tgl2);
        $this->load->view('keuangan/vexceldetail_point',$data);
    }
    function hdsharing($tgl1="",$tgl2=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="keuangan";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["title"]        = "HEMODIALISA || RS CIREMAI";
        $data["title_header"] = "HEMODIALISA";
        $data["content"] = "keuangan/vhdsharing";
        $data["breadcrumb"]   = "<li class='active'><strong>HEMODIALISA</strong></li>";
        $data["q"] = $this->Mkeuangan->hdsharing($tgl1,$tgl2);
        $this->load->view('template',$data);
    }
    function cetakdetail_hdsharing($tgl1,$tgl2){
        $data["row"] = $this->Mkeuangan->hdsharing($tgl1,$tgl2);
        $data["row2"] = $this->Mkeuangan->getdokter_hd();
        $this->load->view('keuangan/vcetakdetail_hdsharing',$data);
    }
    function exceldetail_hdsharing($tgl1,$tgl2){
        $data["row"] = $this->Mkeuangan->hdsharing($tgl1,$tgl2);
        $data["row2"] = $this->Mkeuangan->getdokter_hd();
        $this->load->view('keuangan/vexceldetail_hdsharing',$data);
    }
    function getdokter_hd(){
        echo json_encode($this->Mkeuangan->getdokter_hd());
    }
    function getpointsharing(){
        echo json_encode($this->Mkeuangan->pointsharing());
    }
    function gethdsharing(){
        echo json_encode($this->Mkeuangan->hdsharing());
    }
    function perawatsharing($tgl1="",$tgl2=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="keuangan";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["title"]        = "Pembagian Jasa Asisten Anaestesi || RS CIREMAI";
        $data["title_header"] = "Pembagian Jasa Asisten Anaestesi";
        $data["content"] = "keuangan/vperawatsharing";
        $data["breadcrumb"]   = "<li class='active'><strong>Pembagian Jasa Asisten Anaestesi</strong></li>";
        $data["q"] = $this->Mkeuangan->perawatsharing($tgl1,$tgl2);
        $data["d"] = $this->Mkeuangan->getperawat_array();
        // $data["pajak"] = $this->Mkeuangan->getpajakdokter($tgl1);
        $this->load->view('template',$data);
    }
    function cetakdetail_perawatsharing($tgl1,$tgl2,$id_perawat,$gol_pasien,$pelayanan){
        $data["q"] = $this->Mkeuangan->perawatsharing($tgl1,$tgl2);
        $data["d"] = $this->Mkeuangan->getperawat_array();
        $data["gol_pasien"] = $gol_pasien;
        $data["pelayanan"] = $pelayanan;
        $data["id_perawat"] = $id_perawat;
        $this->load->view('keuangan/vcetakdetail_perawatsharing',$data);
    }
    function exceldetail_perawatsharing($tgl1,$tgl2,$id_perawat,$gol_pasien,$pelayanan){
        $data["q"] = $this->Mkeuangan->perawatsharing($tgl1,$tgl2);
        $data["d"] = $this->Mkeuangan->getperawat_array();
        $data["gol_pasien"] = $gol_pasien;
        $data["pelayanan"] = $pelayanan;
        $data["id_perawat"] = $id_perawat;
        $this->load->view('keuangan/vexceldetail_perawatsharing',$data);
    }
    function subsidi($tgl=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="keuangan";
        $tgl = $tgl=="" ? date("Y-m")."-01" : date("Y-m-d",strtotime("01-".$tgl));
        $data["tgl"] = $tgl;
        $data["title"]        = "Subsidi Rumah Sakit Kepada Pasien Dinas || RS CIREMAI";
        $data["title_header"] = "Subsidi Rumah Sakit Kepada Pasien Dinas";
        $data["content"] = "keuangan/vsubsidi";
        $tgl1 = date("Y-m-d",strtotime($tgl));
        $hari = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime($tgl)), date("Y",strtotime($tgl)));
        $tgl2 = date("Y-m",strtotime($tgl))."-".$hari;
        $data["breadcrumb"]   = "<li class='active'><strong>Subsidi Rumah Sakit Kepada Pasien Dinas</strong></li>";
        $data["q"] = $this->Mkeuangan->subsidi($tgl1,$tgl2);
        $this->load->view('template',$data);
    }
    function cetak_subsidi($tgl){
        $tgl = $tgl=="" ? date("Y-m")."-01" : date("Y-m-d",strtotime("01-".$tgl));
        $data["tgl"] = $tgl;
        $tgl1 = date("Y-m-d",strtotime($tgl));
        $hari = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime($tgl)), date("Y",strtotime($tgl)));
        $tgl2 = date("Y-m",strtotime($tgl))."-".$hari;
        $data["q"] = $this->Mkeuangan->subsidi($tgl1,$tgl2);
        $this->load->view('keuangan/vcetak_subsidi',$data);
    }
    function excel_subsidi($tgl){
        $tgl = $tgl=="" ? date("Y-m")."-01" : date("Y-m-d",strtotime("01-".$tgl));
        $data["tgl"] = $tgl;
        $tgl1 = date("Y-m-d",strtotime($tgl));
        $hari = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime($tgl)), date("Y",strtotime($tgl)));
        $tgl2 = date("Y-m",strtotime($tgl))."-".$hari;
        $data["q"] = $this->Mkeuangan->subsidi($tgl1,$tgl2);
        $this->load->view('keuangan/vexcel_subsidi',$data);
    }
    function detailpasien(){
        $q = $this->Mkeuangan->detailpasien();
        echo json_encode($q->result());
    }
    function cetakdetail_subsidi($tgl,$pelayanan){
        $q = $this->Mkeuangan->detailpasien($tgl,$pelayanan);
        $data["q"] = $q;
        $data["pelayanan"] = $pelayanan;
        $data["tgl"] = $tgl;
        $this->load->view('keuangan/vcetakdetail_subsidi',$data);
    }
    function exceldetail_subsidi($tgl,$pelayanan){
        $q = $this->Mkeuangan->detailpasien($tgl,$pelayanan);
        $data["q"] = $q;
        $data["pelayanan"] = $pelayanan;
        $data["tgl"] = $tgl;
        $this->load->view('keuangan/vexceldetail_subsidi',$data);
    }
}
?>