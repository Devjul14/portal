<?php
class Displayantrian extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Mhome');
    }
    function index(){
        $data["r"]              = $this->Mhome->getruangan();
        // $data["p"]              = $this->Mhome->getpoliklinik();
        $data["kelas"]          = $this->Mhome->getkelas();
        $data["bed"]            = $this->Mhome->getbed();
        $data["inap"]           = $this->Mhome->getpasien_inap();
        $data["inap2"]          = $this->Mhome->getpasien_inap2();
        $data["breadcrumb"]     = "<li class='active'><strong>Pelayanan</strong></li>";
        // $data["total_pasien"]   = $this->Mhome->gettotalpasien();
        $this->load->view('antrian/vdisplay',$data);
    } 
    function antrian($poli,$dokter=""){
        $data["p"]              = $this->Mhome->getpoliklinik_detail($poli);
        $data["dp"]              = $this->Mhome->getdokterpoli($poli);
        $data["q"]          = $this->Mhome->dispaypasien_poli($poli,$dokter);
        $data["d"]          = $this->Mhome->getdokter($dokter);
        $data["dokter"]     = $dokter;
        $data["poli"]     = $poli;
        $this->load->view('antrian/vpanggilantrian',$data);
    } 
    function getpanggil(){
        // $this->db->order_by("no_antrian","desc");
        // $this->db->where("tujuan_poli",$this->input->post("poli"));
        // $this->db->where("no_antrian!=","");
        // $this->db->where("dokter_poli",$this->input->post("dokter"));
        // $this->db->where("panggil",1);
        // $q = $this->db->get("pasien_ralan");
        $this->db->where("poli",$this->input->post("poli"));
        $this->db->where("dokter",$this->input->post("dokter"));
        $this->db->where("tanggal",date("Y-m-d"));
        // $this->db->where("tanggal","2020-08-07");
        $q = $this->db->get("panggil_pasien");
        echo json_encode($q->row());
    } 
    function sedangpanggil(){
        $this->db->select("p.*,d.nama_dokter");
        $this->db->where("p.poli",$this->input->post("poli"));
        $this->db->where("tanggal",date("Y-m-d"));
        // $this->db->where("p.tanggal","2020-08-07");
        $this->db->where("p.panggil",1);
        $this->db->join("dokter d","d.id_dokter=p.dokter","inner");
        $q = $this->db->get("panggil_pasien p");
        echo json_encode($q->row());
    } 
    function simpanpanggil(){
        $this->db->where("poli",$this->input->post("poli"));
        $this->db->where("dokter",$this->input->post("dokter"));
        $this->db->where("tanggal",date("Y-m-d"));
        // $this->db->where("tanggal","2020-08-07");
        $q = $this->db->get("panggil_pasien");
        $this->db->where("poli",$this->input->post("poli"));
        $this->db->where("tanggal",date("Y-m-d"));
        // $this->db->where("tanggal","2020-08-07");
        $this->db->update("panggil_pasien",["panggil"=>0]);
        if ($q->num_rows()>0){
            $this->db->where("poli",$this->input->post("poli"));
            $this->db->where("dokter",$this->input->post("dokter"));
            $this->db->where("tanggal",date("Y-m-d"));
            // $this->db->where("tanggal","2020-08-07");
            $this->db->update("panggil_pasien",["no_antrian"=>$this->input->post("no_antrian"),"jam"=>date("H:i:s"),"panggil"=>1,"no_reg"=>$this->input->post("no_reg")]);
        } else {
            $data = array(
                        "tanggal" => date("Y-m-d"),
                        // "tanggal" => "2020-08-07",
                        "poli" => $this->input->post("poli"),
                        "dokter" => $this->input->post("dokter"),
                        "no_antrian" => $this->input->post("no_antrian"),
                        "no_reg" => $this->input->post("no_reg"),
                        "jam" => date("H:i:s"),
                        "panggil" => 1
                    );
            $this->db->insert("panggil_pasien",$data);
        }
        $this->db->where("no_reg",$this->input->post("no_reg"));
        $this->db->update("pasien_ralan",["panggil"=>1]);
    }
    function getpoli(){
        $this->db->order_by("keterangan");
        $q = $this->db->get("poliklinik");
        echo json_encode($q->result());
    }
    function getdokterpoli(){
        $this->db->join("jadwal_dokter j","jadwal_dokter j on j.id_dokter=d.id_dokter","inner");
        $this->db->where("j.id_poli",$this->input->post("poli"));
        $q = $this->db->get("dokter d");
        echo json_encode($q->result());
    }
    function getdokterpoli1(){
        $harike = date('w');
        $this->db->join("jadwal_dokter j","jadwal_dokter j on j.id_dokter=d.id_dokter","inner");
        $this->db->where("j.id_poli",$this->input->post("poli"));
        $this->db->where("substring_index(substring_index(hari,',',".($harike+1)."),',',-1)",1);
        $q = $this->db->get("dokter d");
        echo json_encode($q->result());
    }
}
?>