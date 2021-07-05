<?php
class Pa extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mpa');
		$this->load->Model('Mpendaftaran');
        $this->load->Model('Mkasir');
        $this->load->Model('Mlab');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function ralan($current=0,$from=0){
		$data["title"] 				= "Patologi Anatomi Rawat Jalan";
		$data['judul'] 				= "Patologi Anatomi Rawat Jalan";
		$data["vmenu"] 				= $this->session->userdata("controller")."/vmenu";
		$data["content"] 			= "pa/vlistpa_ralan";
		$data["username"] 			= $this->session->userdata('nama_user');
	    $data['menu']				= "pa";
	    $data["current"] 			= $current;
	    $data["title_header"] 		= "Patologi Anatomi Rawat Jalan ";
	    $data["total_rows"] 		= $this->Mpa->getpa_ralan();
	    $data["breadcrumb"] 		= "<li class='active'><strong>PA Rawat Jalan</strong></li>";		
		$this->load->library('pagination');
        $config['base_url'] 		= base_url().'pa/ralan/'.$current;
        $config['total_rows'] 		= $this->Mpa->getpa_ralan();
        $config['per_page'] 		= 10;
        $config['full_tag_open']	= '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] 	= '</ul>';
        $config['cur_tag_open'] 	= '<li class=active><a>';
        $config['cur_tag_close']	= '</a></li>';
        $config['num_tag_open'] 	= '<li>';
        $config['num_tag_close'] 	= '</li>';
        $config['prev_tag_open'] 	= '<li>';
        $config['prev_tag_close'] 	= '</li>';
        $config['next_tag_open'] 	= '<li>';
        $config['next_tag_close'] 	= '</li>';
        $config['first_tag_open'] 	= '<li>';
        $config['first_tag_close'] 	= '</li>';
        $config['last_tag_open'] 	= '<li>';
        $config['last_tag_close'] 	= '</li>';
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 4;
        $from						= $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"] 				= $from;
		$data["q3"] 				= $this->Mpa->getpasien_ralan_pa($config['per_page'],$from);
        $data["q"]                  = $this->Mpa->pilihdokterpa();
		$this->load->view('template',$data);
    }
    function cari_paralan(){
        
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter")); 
        $this->session->set_userdata('dokter',$this->input->post("dokter")); 
        $this->session->set_userdata('tgl1',$this->input->post("tgl1")); 
        $this->session->set_userdata('tgl2',$this->input->post("tgl2")); 
        $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
        $this->session->set_userdata("status_pasien",$this->input->post("status_pasien"));
    }
    function reset_paralan(){
        $this->session->unset_userdata('kode_dokter'); 
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1'); 
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        $this->session->unset_userdata('no_rm'); 
        $this->session->unset_userdata('no_reg');
        $this->session->unset_userdata('nama');
        redirect("pa/ralan");
    }
    function cari_painap(){
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter")); 
        $this->session->set_userdata('dokter',$this->input->post("dokter")); 
        $this->session->set_userdata('tgl1',$this->input->post("tgl1")); 
        $this->session->set_userdata('tgl2',$this->input->post("tgl2")); 
        $this->session->set_userdata('kode_ruangan',$this->input->post("kode_ruangan")); 
        $this->session->set_userdata('ruangan',$this->input->post("ruangan")); 
        $this->session->set_userdata('kode_kelas',$this->input->post("kode_kelas")); 
        $this->session->set_userdata('kelas',$this->input->post("kelas")); 
        $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
    }
    function reset_painap(){
        $this->session->unset_userdata('kode_dokter'); 
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1'); 
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata("no_pasien");
        $this->session->unset_userdata("nama");
        $this->session->unset_userdata("no_reg");
        redirect("pa/inap");
    }
    function detailpa_ralan($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "pa";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Patologi Anatomi Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Detail Patologi Anatomi Rawat Jalan";
        $data["content"]        = "pa/vformpa_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Pa Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mpa->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mpa->getkasir($no_reg);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]              = $this->Mpa->gettarif_pa();
        $data["d"]              = $this->Mpa->getdokter_pa();
        $data["d1"]             = $this->Mpa->getdokter();
        $data["r"]              = $this->Mpa->getpetugaspa();
        $data["dokter"]         = $this->Mpa->getdokter_array();
        $data["petugas_pa"]    = $this->Mpa->getpetugas_array();
        $data["dokter_pengirim"]= $this->Mpa->getdokterpengirim_array();
        $this->load->view('template',$data);
    }
    function addtindakan(){
        $this->Mpa->addtindakan();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_inap(){
        $this->Mpa->addtindakan_inap();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function hapustindakan_inap(){
        $this->Mradiologi->hapustindakan_inap();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function ekspertisi($no_pasien,$no_reg,$kode_tindakan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "pa";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["kode_tindakan"]    = $kode_tindakan;
        $data["title"]          = "Ekspertisi || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi";
        $data["content"]        = "pa/vformekspertisi";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi</strong></li>";
        $data["row"]            = $this->Mpa->getralan_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mpa->getekspertisi_detail($no_pasien,$no_reg,$kode_tindakan);
        $data["d"]              = $this->Mpa->getdokter_pa();
        $data["d1"]             = $this->Mpa->getdokter();
        $data["r"]              = $this->Mpa->getpetugaspa();
        $data["k2"]             = $this->Mpa->getkasir_detail($no_reg,$kode_tindakan);
        $data["k"]              = $this->Mpa->getkasir($no_reg);
        $this->load->view('template',$data);
    }
    function ambildatanormal($dokter){
        $data["q"]              = $this->Mpa->ambildatanormal($dokter);
        $data["title"]          = "Data Normal || RS CIREMAI";
        $data["title_header"]   = "Data Normal";
        $this->load->view('radiologi/vpilih_datanormal',$data);
    }
    function simpanekspertisi($action){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $tindakan = $this->input->post("tindakan");
        $message = $this->Mpa->simpanekspertisi($action);
        $this->session->set_flashdata("message",$message);
        redirect("pa/ekspertisi/".$no_pasien."/".$no_reg."/".$tindakan);
    }
    function simpanradiologi(){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $message = $this->Mradiologi->simpanradiologi();
        $this->session->set_flashdata("message",$message);
        redirect("radiologi/detailradiologi_ralan/".$no_pasien."/".$no_reg);
    }
    function cetak($no_reg, $no_pasien,$kode_tindakan){
        $data["no_reg"] = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]          = $this->Mpa->getcetak($no_reg,$no_pasien);
        $data["k"]          = $this->Mpa->getcetak_kasir($no_reg,$kode_tindakan);
        $this->load->view('pa/vcetakpa',$data);    
    }
    function inap($current=0,$from=0){
        $data["title"]              = "Panatologi Anatomi Rawat Inap";
        $data['judul']              = "Panatologi Anatomi Rawat Inap";
        $data["vmenu"]              = $this->session->userdata("controller")."/vmenu";
        $data["content"]            = "pa/vlistpa_inap";
        $data["username"]           = $this->session->userdata('nama_user');
        $data['menu']               = "pa";
        $data["current"]            = $current;
        $data["title_header"]       = "Panatologi Anatomi Rawat Inap ";
        $data["total_rows"]         = $this->Mpa->getpa_inap();
        $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']         = base_url().'pa/inap/'.$current;
        $config['total_rows']       = $this->Mpa->getpa_inap();
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']   = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['num_links']        = 4;
        $config['uri_segment']      = 4;
        $from                       = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]               = $from;
        $data["q3"]                 = $this->Mpa->getpasien_inap_pa($config['per_page'],$from);
        $data["q"]                  = $this->Mpa->pilihdokterpa();
        $this->load->view('template',$data);
    }
    function detailpa_inap($no_pasien,$no_reg,$tanggal=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "pa";
        // if ($tanggal=="") {
        // 	$tanggal = date("d-m-Y");
        // }
        
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["tanggal"]	    = $tanggal;
        $data["title"]          = "Detail Panatologi Anatomi Rawat Inap || RS CIREMAI";
        $data["title_header"]   = "Detail Panatologi Anatomi Rawat Inap";
        $data["content"]        = "pa/vformpa_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Panatologi Anatomi Rawat Inap</strong></li>";
        $data["row"]            = $this->Mpa->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mpa->getkasir_inap($no_reg,$tanggal);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]              = $this->Mpa->gettarif_pa();
        $data["d"]              = $this->Mpa->getdokter_pa();
        $data["d1"]             = $this->Mpa->getdokter();
        $data["r"]              = $this->Mpa->getpetugaspa();
        $data["dokter"]         = $this->Mpa->getdokter_array();
        $data["dokter_pengirim"]         = $this->Mpa->getdokterpengirim_array();
        $data["petugas_pa"]    = $this->Mpa->getpetugas_array();
        $this->load->view('template',$data);
    }
    function ekspertisi_inap($no_pasien,$no_reg,$id_tindakan="",$tgl="", $pemeriksaan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "pa";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["kode_tindakan"]  = $id_tindakan;
        $data["pemeriksaan"]    = $pemeriksaan;
        $data["title"]          = "Ekspertisi || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi";
        $data["tgl"]            = $tgl;
        $data["content"]        = "pa/vformekspertisi_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi</strong></li>";
        $data["row"]            = $this->Mpa->getinap_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mpa->getekspertisiinap_detail($no_pasien,$no_reg,$id_tindakan,$tgl,$pemeriksaan);
        $data["d"]              = $this->Mpa->getdokter_pa();
        $data["d1"]             = $this->Mpa->getdokter();
        $data["r"]              = $this->Mpa->getpetugaspa();
        $data["k"]              = $this->Mpa->getkasir_inap($no_reg,"");
        $this->load->view('template',$data);
    }
    function getkasir_inap_detail($no_reg,$id_tindakan="",$tgl="",$pemeriksaan=""){
        $q = $this->Mpa->getkasir_inap_detail($no_reg,$id_tindakan,$tgl,$pemeriksaan);
        echo json_encode($q);
    }
    function simpanekspertisi_inap($action){
        $no_pasien = $this->input->post("no_rm");
        $no_reg = $this->input->post("no_reg");
        $tindakan = explode("/",$this->input->post("tindakan"));
        $message = $this->Mpa->simpanekspertisi_inap($action);
        $this->session->set_flashdata("message",$message);
        redirect("pa/ekspertisi_inap/".$no_pasien."/".$no_reg."/".$tindakan[0]."/".$tindakan[3]."/".$tindakan[4]);
    }
    function simpandetail_inap($action){
        $no_pasien = $this->input->post("no_rm");
        $no_reg = $this->input->post("no_reg");
        $tindakan = $this->input->post("tindakan");
        $message = $this->Mpa->simpanekspertisi_inap($action);
        $this->session->set_flashdata("message",$message);
        redirect("pa/detailpa_inap/".$no_pasien."/".$no_reg."/".$tindakan);
    }
    function cetak_inap($no_reg, $no_pasien,$id_tindakan,$tgl,$pemeriksaan){
        $data["no_reg"] = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["k"]          = $this->Mpa->getcetak_kasir_inap($no_reg,$id_tindakan,$tgl,$pemeriksaan);
        $data["q"]          = $this->Mpa->getcetak_inap($no_reg,$no_pasien,$id_tindakan,$tgl);
        $data["tg"]          = $this->Mpa->gettanggal($no_reg,$no_pasien,$id_tindakan,$tgl,$pemeriksaan);
        $this->load->view('pa/vcetakpa_inap',$data);    
    }
    function changedata_ralan($jenis){
        $this->Mpa->changedata_ralan($jenis);
    }
    function changedata($jenis){
        $this->Mpa->changedata($jenis);
    }
    function hapusinap(){
        $this->Mpa->hapusinap();
    }
    function hapusralan(){
        $this->Mpa->hapusralan();
    }
    function getpetugas_pa(){
        echo json_encode($this->Mpa->getpetugaspa()->result());
    }
    function getdokter_pa(){
        echo json_encode($this->Mpa->getdokter_pa()->result());
    }
    function getdokter(){
        echo json_encode($this->Mpa->getdokter()->result());
    }
    function getttddokter($id_dokter){
        $image = "data:image/gif;base64,".$this->Mpa->getttddokter($id_dokter)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail' style='width:100px;height:100px'>";
    }
    function rekap_full($tindakan,$tgl1="",$tgl2=""){
      $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
      $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
      $data["tgl1"] = $tgl1;
      $data["tgl2"] = $tgl2;
      $data["tindakan"] = $tindakan;
      $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
      $data['menu']="home";
      $data["title"]        = "Rekap Patologi Anatomi || RS CIREMAI";
      $data["title_header"] = "Rekap Patologi Anatomi ";
      $data["content"] = "pa/vparekap_full";
      $data["t"] = $this->Mpa->gettarif_pa();
      $data["p"] = $this->Mpa->rekap_ralan_full($tindakan,$tgl1,$tgl2);
      $data["p_inap"] = $this->Mpa->rekap_inap_full($tindakan,$tgl1,$tgl2);
      $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
      $this->load->view('template',$data);
    }
    function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
      echo json_encode($this->Mpa->getpasien_rekap_full($tindakan,$tgl1,$tgl2));
    }
    function cetakpasien_full($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["t2"] = $this->Mpa->gettindakan_cetak2($tindakan);
        $data["tindakan"] = $tindakan;
        $data["q"] = $this->Mpa->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('pa/vcetakpasien_full',$data);
    }
    function cetakrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap Patologi Anatomi Full || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap Patologi Anatomi Full";
        $data["t"] = $this->Mpa->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mpa->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mpa->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mpa->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('pa/vcetakrekap_full',$data);
    }
    function cetakrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Patologi Anatomi Full || RS CIREMAI";
        $data["title_header"] = "Cetak Patologi Anatomi Full";
        $data["t"] = $this->Mpa->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mpa->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mpa->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mpa->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('pa/vcetakrekap_full2',$data);
    }
    function excelrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mpa->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mpa->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mpa->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mpa->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('pa/vpaexcelrekap_full',$data);
    }
    function excelrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mpa->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mpa->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mpa->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mpa->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('pa/vpaexcelrekap_full2',$data);
    }
}
?>