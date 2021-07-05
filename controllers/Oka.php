<?php
class Oka extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Moka');
        $this->load->Model('Mpa');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index($current=0,$from=0){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Kamar Operasi &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller")."/vmenu";
        $data["menu"]               = "oka";
        $data["title_header"]       = "Kamar Operasi ";
        $data["breadcrumb"]         = "<li class='active'><strong>Kamar Operasi</strong></li>";
        $data["content"]            = "oka/voka";
        $data["total_rows"]         = $this->Moka->getoka_jumlah();
        $data["jlayan"]             = $this->Moka->getoka_jumlah("1");
        $data["jbatal"]             = $this->Moka->getoka_jumlah("2");
        $this->load->library('pagination');
        $config['base_url'] = base_url().'oka/index/'.$current;
        $config['total_rows'] = $this->Moka->getoka_jumlah();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class=active><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $from = $this->uri->segment(4);
        $data["from"] = $from;
        $this->pagination->initialize($config);
        $data["ruangan"] = $this->Moka->gettabel("ruangan");
        $data["kelas"] = $this->Moka->gettabel("kelas");
        $data["kamar"] = $this->Moka->gettabel("kamar");
        $data["q"] = $this->Moka->getoka($config['per_page'],$from);
        $this->session->unset_userdata('laporan'); 
        $this->session->unset_userdata('komplikasi'); 
        $this->session->unset_userdata('intruksi'); 
        $this->session->unset_userdata('kode_oka'); 
        $this->load->view('template',$data);
    }
    function formoka($kode=""){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Kamar Operasi &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller")."/vmenu";
        $data["menu"]               = "oka";
        $data["title_header"]       = "Kamar Operasi ";
        $data["kode"]				= $kode;
        $data["q"]					= $this->Moka->getoka_detail($kode);
        $data["diagnosa"]           = $this->Moka->getdiagnosa();
        $data["dokter"]             = $this->Moka->getdokter();
        $data["dokter_anastesi1"]    = $this->Moka->getdokter_anastesi();
        $data["tarif_operasi"]      = $this->Moka->gettarif_operasi();
        // $data["kamar"]              = $this->Moka->getkamar();
        $data["kamar_operasi"]      = $this->Moka->getkamar_operasi();
        $data["jenis_anatesi"]      = $this->Moka->getjenis_anatesi();
        $data["klasifikasi"]        = $this->Moka->getklasifikasi();
        $data["asisten_op"]         = $this->Moka->getasisten_op();
        $data["asisten_an"]         = $this->Moka->getasisten_an();
        $data["breadcrumb"]         = "<li class='active'><strong>Kamar Operasi</strong></li>";
        $data["content"]            = "oka/vformoka";
        $this->load->view('template',$data);
    }
    function laporan_mata($kode=""){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Laporan Operasi Katarak Dewasa &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller")."/vmenu";
        $data["menu"]               = "oka";
        $data["title_header"]       = "LAPORAN MATA";
        $data["kode"]               = $kode;
        $data["q"]                  = $this->Moka->getoka_detail($kode);
        $data["diagnosa"]           = $this->Moka->getdiagnosa();
        $data["dokter"]             = $this->Moka->getdokter();
        $data["dokter_anastesi1"]    = $this->Moka->getdokter_anastesi();
        $data["tarif_operasi"]      = $this->Moka->gettarif_operasi();
        // $data["kamar"]              = $this->Moka->getkamar();
        $data["kamar_operasi"]      = $this->Moka->getkamar_operasi();
        $data["jenis_anatesi"]      = $this->Moka->getjenis_anatesi();
        $data["klasifikasi"]        = $this->Moka->getklasifikasi();
        $data["asisten_op"]         = $this->Moka->getasisten_op();
        $data["asisten_an"]         = $this->Moka->getasisten_an();
        $data["breadcrumb"]         = "<li class='active'><strong>Laporan Mata</strong></li>";
        $data["content"]            = "oka/vlaporan_mata";
        $this->load->view('template',$data);
    }
    function cetak_mata($kode=""){
        $data["kode"]               = $kode;
        $data["q"]                  = $this->Moka->getlaporan_mata($kode);
        $this->load->view('oka/vcetak_mata',$data);
    }
    function laporan_pterygium($kode=""){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Laporan Operasi Katarak Dewasa &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller")."/vmenu";
        $data["menu"]               = "oka";
        $data["title_header"]       = "LAPORAN PTERYGIUM";
        $data["kode"]               = $kode;
        $data["q"]                  = $this->Moka->getoka_detail($kode);
        $data["diagnosa"]           = $this->Moka->getdiagnosa();
        $data["dokter"]             = $this->Moka->getdokter();
        $data["dokter_anastesi1"]    = $this->Moka->getdokter_anastesi();
        $data["tarif_operasi"]      = $this->Moka->gettarif_operasi();
        // $data["kamar"]              = $this->Moka->getkamar();
        $data["kamar_operasi"]      = $this->Moka->getkamar_operasi();
        $data["jenis_anatesi"]      = $this->Moka->getjenis_anatesi();
        $data["klasifikasi"]        = $this->Moka->getklasifikasi();
        $data["asisten_op"]         = $this->Moka->getasisten_op();
        $data["asisten_an"]         = $this->Moka->getasisten_an();
        $data["breadcrumb"]         = "<li class='active'><strong>Laporan Pterygium</strong></li>";
        $data["content"]            = "oka/vlaporan_pterygium";
        $this->load->view('template',$data);
    }
    function cetak_pterygium($kode=""){
        $data["kode"]               = $kode;
        $data["q"]                  = $this->Moka->getlaporan_pterygium($kode);
        $this->load->view('oka/vcetak_pterygium',$data);
    }
    function cetak($kode=""){
        $data["q"] = $this->Moka->getcetak($kode);
        $this->load->view("oka/vcetak_oka",$data);
    }
    function jadwal(){
        $data["q"] = $this->Moka->getjadwal();
        $data["dokter"] = $this->Moka->gettabel("dokter");
        $data["ruang"] = $this->Moka->gettabel("ruangan");
        $data["kamar"] = $this->Moka->gettabel("kamar");
        $data["micd"] = $this->Moka->gettabel("master_icd");
        $data["o"] = $this->Moka->getoperasi_array();
        $data["ja"] = $this->Moka->gettabel("jenis_anatesi");
        $data["as"] = $this->Moka->gettabel("asisten_operasi");
        $this->load->view("oka/vjadwal",$data);
    }
    function cetak_pasien(){ 
        $tgl1 = ($this->session->userdata("tgl1")=="" ? date("Y-m-d") : $this->session->userdata("tgl1"));
        $tgl2 = ($this->session->userdata("tgl2")=="" ? date("Y-m-d") : $this->session->userdata("tgl2"));
        $data["tgl1"] = date("d-m-Y",strtotime($tgl1));
        $data["tgl2"] = date("d-m-Y",strtotime($tgl2));
        $data["dokter"] = $this->Moka->gettabel("dokter");
        $data["master"] = $this->Moka->gettabel("master_icd");
        $data["q"] = $this->Moka->getcetak_pasien();
        $this->load->view("oka/vcetakpasien_op",$data);
    }
    function simpanoka($action){
        $kode = $this->Moka->simpanoka($action);
        $this->session->set_flashdata("message",$message);
        // if ($action == "edit") {
            redirect("oka");
        // }
        // else{
            // redirect("oka/formoka/".$kode);
        // }
    }
    function laporan($kode){
        // $laporan = $this->input->post("laporan");
        $this->session->set_userdata('laporan',$this->input->post("laporan"));
        $message = $this->Moka->simpanlaporan($kode);
        $this->session->set_flashdata("message",$message);
        redirect("oka");
    }
    function komplikasi($kode){
        $this->session->set_userdata('komplikasi',$this->input->post("komplikasi"));
        $message = $this->Moka->simpankomplikasi($kode);
        $this->session->set_flashdata("message",$message);
        redirect("oka");
    }
    function intruksi($kode){
        $this->session->set_userdata('intruksi',$this->input->post("intruksi"));
        $message = $this->Moka->simpanintruksi($kode);
        $this->session->set_flashdata("message",$message);
        redirect("oka");
    }
    function hapus($kode){
        $message = $this->Moka->hapus($kode);
        $this->session->set_flashdata("message",$message);
        redirect("oka");
    }
    function getpasien(){
        echo json_encode($this->Moka->getpasien());
    }
    function getoperasi(){
        echo json_encode($this->Moka->getoperasi());
    }
    function getdiagnosa_operasi(){
        echo json_encode($this->Moka->getdiagnosa_operasi());
    }
    function search(){
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
        $this->session->set_userdata('pelayanan',$this->input->post("pelayanan"));
    }
    function getcaripasien(){
        $this->session->set_userdata("cari_no",$this->input->post("cari_no"));
    }
     function reset(){
        $this->session->unset_userdata('cari_no'); 
        $this->session->unset_userdata('tgl1'); 
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('pelayanan');
        redirect("oka");
    }
    function rekap($tindakan,$tgl1="",$tgl2="", $pelayanan="", $dokter_operasi="", $dokter_anastesi=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["pelayanan"] = $pelayanan;
        $data["tindakan"] = $tindakan;
        $data["dokter_operasi1"] = $dokter_operasi;
        $data["dokter_anastesi1"] = $dokter_anastesi;
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="home";
        $data["title"]        = "Rekap OKA || RS CIREMAI";
        $data["title_header"] = "Rekap OKA";
        $data["content"] = "oka/vrekap";
        $data["t"] = $this->Moka->gettindakan();
        $data["dokter_operasi"] = $this->Moka->getdokter();
        $data["dokter_anastesi"] = $this->Moka->getdokter_anastesi();
        $data["p"] = $this->Moka->getrekap($tindakan,$tgl1,$tgl2,$pelayanan,$dokter_operasi,$dokter_anastesi);
        $data["breadcrumb"]   = "<li class='active'><strong>Rekap OKA</strong></li>";
        $this->load->view('template',$data);
    }
    function cetakrekap($tindakan,$tgl1="",$tgl2="", $pelayanan="",$dokter_operasi="", $dokter_anastesi=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["pelayanan"] = $pelayanan;
        $data["tindakan"] = $tindakan;
        $data["dokter_operasi1"] = $dokter_operasi;
        $data["dokter_anastesi1"] = $dokter_anastesi;
        $data["t"] = $this->Moka->gettindakan();
        $data["t2"] = $this->Moka->gettindakan2($tindakan);
        $data["p"] = $this->Moka->getrekap($tindakan,$tgl1,$tgl2,$pelayanan,$dokter_operasi,$dokter_anastesi);
        $this->load->view('oka/vcetakrekap',$data);
    }
    function excelrekap($tindakan,$tgl1="",$tgl2="", $pelayanan="",$dokter_operasi="", $dokter_anastesi=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["pelayanan"] = $pelayanan;
        $data["tindakan"] = $tindakan;
        $data["dokter_operasi1"] = $dokter_operasi;
        $data["dokter_anastesi1"] = $dokter_anastesi;
        $data["t"] = $this->Moka->gettindakan();
        $data["t2"] = $this->Moka->gettindakan2($tindakan);
        $data["p"] = $this->Moka->getrekap($tindakan,$tgl1,$tgl2,$pelayanan,$dokter_operasi,$dokter_anastesi);
        $this->load->view('oka/vexcelrekap',$data);
    }
    function cetakpasien($tindakan,$tgl1="",$tgl2="", $pelayanan="",$dokter_operasi="", $dokter_anastesi=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["pelayanan"] = $pelayanan;
        $data["tindakan"] = $tindakan;
        $data["dokter_operasi1"] = $dokter_operasi;
        $data["dokter_anastesi1"] = $dokter_anastesi;
        $data["t"] = $this->Moka->gettindakan();
        $data["t2"] = $this->Moka->gettindakan2($tindakan);
        $data["q"] = $this->Moka->getpasien_rekap_inap($tindakan,$tgl1,$tgl2,$pelayanan,$dokter_operasi,$dokter_anastesi);
        $this->load->view('oka/vcetakpasien',$data);
    }
    function namadiagnosa(){
    	echo $this->Moka->namadiagnosa();
    }
    function namaoperasi(){
        echo $this->Moka->namaoperasi();
    }
    function getpasien_rekap_inap($tindakan,$tgl1,$tgl2,$pelayanan,$dokter_operasi="", $dokter_anastesi=""){
        echo json_encode($this->Moka->getpasien_rekap_inap($tindakan,$tgl1,$tgl2,$pelayanan,$dokter_operasi,$dokter_anastesi));
    }
    function simpanmata(){
    	$kode = $this->input->post("kode_oka");
        $message = $this->Moka->simpan_mata();
        $this->session->set_flashdata("message",$message);
        redirect("oka/laporan_mata/".$kode);
    }
    function simpanpterygium(){
        $kode = $this->input->post("kode_oka");
        $message = $this->Moka->simpan_pterygium();
        $this->session->set_flashdata("message",$message);
        redirect("oka/laporan_pterygium/".$kode);
    }
    function batal($kode){
        $message = $this->Moka->batal($kode);
        $this->session->set_flashdata("message",$message);
        redirect("oka");
    }
    function rekap_full($tindakan,$tgl1="",$tgl2=""){
      $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
      $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
      $data["tgl1"] = $tgl1;
      $data["tgl2"] = $tgl2;
      $data["tindakan"] = $tindakan;
      $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
      $data['menu']="home";
      $data["title"]        = "Rekap OKA || RS CIREMAI";
      $data["title_header"] = "Rekap OKA ";
      $data["content"] = "oka/vokarekap_full";
      // $data["t"] = $this->Moka->gettindakan();
      $data["t"] = $this->Moka->gettindakan_full_rekap();
      $data["p"] = $this->Moka->rekap_ralan_full($tindakan,$tgl1,$tgl2);
      $data["p_inap"] = $this->Moka->rekap_inap_full($tindakan,$tgl1,$tgl2);
      $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
      $this->load->view('template',$data);
    }
    function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
      echo json_encode($this->Moka->getpasien_rekap_full($tindakan,$tgl1,$tgl2));
    }
    function cetakpasien_full($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t2"] = $this->Moka->gettindakan_full_rekap_cetak($tindakan);
        $data["q"] = $this->Moka->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('oka/vcetakpasien_full',$data);
    }
    function cetakrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap OKA Full || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap OKA Full";        
        $data["t"] = $this->Moka->gettindakan_full_rekap();
        $data["t2"] = $this->Moka->gettindakan_full_rekap_cetak($tindakan);
        $data["p"] = $this->Moka->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Moka->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('oka/vcetakrekap_full',$data);
    }
    function cetakrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap OKA Full || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap OKA Full";        
        $data["t"] = $this->Moka->gettindakan_full_rekap();
        $data["t2"] = $this->Moka->gettindakan_full_rekap_cetak($tindakan);
        $data["p"] = $this->Moka->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Moka->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('oka/vcetakrekap_full2',$data);
    }
    function excelrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Moka->gettindakan_full_rekap();
        $data["t2"] = $this->Moka->gettindakan_full_rekap_cetak($tindakan);
        $data["p"] = $this->Moka->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Moka->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('oka/vokaexcelrekap_full',$data);
    }
    function excelrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Moka->gettindakan_full_rekap();
        $data["t2"] = $this->Moka->gettindakan_full_rekap_cetak($tindakan);
        $data["p"] = $this->Moka->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Moka->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('oka/vokaexcelrekap_full2',$data);
    }
}
?>