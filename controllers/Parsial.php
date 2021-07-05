<?php
class Parsial extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mparsial');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function formparsial_ralan($no_pasien,$no_reg){
        $data["vmenu"]            = $this->session->userdata("controller")."/vmenu";
        $data['menu']             = "kasir";
        $data["no_pasien"]        = $no_pasien;
        $data["no_reg"]           = $no_reg;
        $data["title"]            = "Parsial Rawat Jalan || RS CIREMAI";
        $data["title_header"]     = "Parsial Rawat Jalan";
        $data["content"]          = "parsial/vformparsial";
        $data["breadcrumb"]       = "<li class='active'><strong>Parsial Rawat Jalan</strong></li>";
        $data["a"]                = $this->Mparsial->getambulance();
        $data["t1"]               = $this->Mparsial->gettindakan_radiologi();
        $data["p"]                = $this->Mparsial->getpenunjang_medis();
        $data["t"]                = $this->Mparsial->gettindakan($no_reg);
        $data["tg"]               = $this->Mparsial->gettindakan_gizi($no_reg);
        $data["tl"]               = $this->Mparsial->gettarif_lab($no_reg);
        $data["tpa"]              = $this->Mparsial->gettarif_pa($no_reg);

        $data["pg"]               = $this->Mparsial->getparsial_gizi($no_reg);
        $data["l1"]               = $this->Mparsial->getparsialralan_lab($no_reg);
        $data["pa"]               = $this->Mparsial->getparsial_pa($no_reg);
        $data["p1"]               = $this->Mparsial->getparsial_penunjang_ralan($no_reg);
        $data["a1"]               = $this->Mparsial->getparsial_ambulance_ralan($no_reg);
        $data["k1"]               = $this->Mparsial->getparsial_radiologi($no_reg);
        $data["k"]                = $this->Mparsial->getparsial($no_reg);

        $data["row"]              = $this->Mparsial->getralan_detail($no_pasien,$no_reg);
        $data["k2"]               = $this->Mparsial->getparsial_radiologi2($no_reg);
        $data["q"]                = $this->Mparsial->getparsial_detail($no_reg);
        $data["l2"]               = $this->Mparsial->getparsialralan_lab2($no_reg);
        $this->load->view('template',$data);
    }
    function addtindakan(){
        $this->Mparsial->addtindakan();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_penunjang(){
        $this->Mparsial->addtindakan_penunjang();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_ambulance(){
        $this->Mparsial->addtindakan_ambulance();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_radiologi(){
        $this->Mparsial->addtindakan_radiologi();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_gizi(){
        $this->Mparsial->addtindakan_gizi();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_lab(){
        $this->Mparsial->addtindakan_lab();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_pa(){
        $this->Mparsial->addtindakan_pa();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function hapustindakan(){
        $this->Mparsial->hapustindakan();
        $this->session->set_flashdata("message","danger-Tarif berhasil dihapus");
    }
    function simpantransaksi(){
        $this->Mparsial->simpantransaksi();
        $this->session->set_flashdata("message","success-Tarif berhasil dibayar");
    }
    function cetakkwitansi($no_pasien,$no_reg){
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["row"]            = $this->Mparsial->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mparsial->getparsial($no_reg);
        $data["k1"]             = $this->Mparsial->getparsial_radiologi($no_reg);
        $data["k2"]             = $this->Mparsial->getparsial_radiologi2($no_reg);
        $data["q"]              = $this->Mparsial->getparsial_detail($no_reg);
        $data["l1"]             = $this->Mparsial->getparsialralan_lab($no_reg);
        $data["l2"]             = $this->Mparsial->getparsialralan_lab2($no_reg);
        $data["p1"]             = $this->Mparsial->getparsial_penunjang_ralan($no_reg);
        $data["a1"]             = $this->Mparsial->getparsial_ambulance_ralan($no_reg);
        $data["t"]              = $this->Mparsial->gettindakan($no_reg);
        $this->load->view('parsial/vcetakkwitansi',$data);
    }
    function formparsial_inap($no_pasien,$no_reg){
        $data["vmenu"]            = $this->session->userdata("controller")."/vmenu";
        $data['menu']             = "kasir";
        $data["no_pasien"]        = $no_pasien;
        $data["no_reg"]           = $no_reg;
        $data["title"]            = "Parsial Rawat Inap || RS CIREMAI";
        $data["title_header"]     = "Parsial Rawat Inap";
        $data["content"]          = "parsial/vformparsial_inap";
        $data["breadcrumb"]       = "<li class='active'><strong>Parsial Rawat Inap</strong></li>";
        $data["a"]                = $this->Mparsial->getambulance();
        $data["t1"]               = $this->Mparsial->gettindakan_radiologi();
        $data["p"]                = $this->Mparsial->getpenunjang_medis();
        $data["t"]                = $this->Mparsial->gettarif_ralan();
        $data["tg"]               = $this->Mparsial->gettindakan_gizi($no_reg);
        $data["tl"]               = $this->Mparsial->gettarif_lab($no_reg);
        $data["tpa"]              = $this->Mparsial->gettarif_pa($no_reg);
        $data["ti"]               = $this->Mparsial->gettindakan_inap();

        $data["pg"]               = $this->Mparsial->getparsial_gizi_inap($no_reg);
        $data["l1"]               = $this->Mparsial->getparsialinap_lab($no_reg);
        $data["pa"]               = $this->Mparsial->getparsial_inap_pa($no_reg);
        $data["p1"]               = $this->Mparsial->getparsial_penunjang_inap($no_reg);
        $data["a1"]               = $this->Mparsial->getparsial_ambulance_inap($no_reg);
        $data["k1"]               = $this->Mparsial->getparsial_inap_radiologi($no_reg);
        $data["k"]                = $this->Mparsial->getparsial_poli($no_reg);
        $data["tnp"]              = $this->Mparsial->getparsial_inap($no_reg);

        $data["row"]              = $this->Mparsial->getinap_detail($no_pasien,$no_reg);
        $data["k2"]               = $this->Mparsial->getparsial_radiologi2($no_reg);
        $data["q"]                = $this->Mparsial->getparsial_detail($no_reg);
        $data["l2"]               = $this->Mparsial->getparsialralan_lab2($no_reg);
        $this->load->view('template',$data);
    }
    function addtindakan_inap($jenis){
        $this->Mparsial->addtindakan_inap($jenis);
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function parsial_ralan($current=0,$from=0){
		$data["title"] = $this->session->userdata('status_user');
		$data['judul'] = "Parsial Rawat Jalan &nbsp;&nbsp;&nbsp;";
		$data["vmenu"] = $this->session->userdata("controller")."/vmenu";
		$data["content"] = "parsial/vparsial";
		$data["username"] = $this->session->userdata('nama_user');
	    $data['menu']="kasir";
	    $data["current"] = $current;
	    $data["title_header"] = "Parsial Rawat Jalan ";
	    $data["p"] = $this->Mpendaftaran->getpoli();
	    $data["breadcrumb"] = "<li class='active'><strong>Parsial Rawat Jalan</strong></li>";		
		$this->load->library('pagination');
        $config['base_url'] = base_url().'kasir/parsial_ralan/'.$current;
        $config['total_rows'] = $this->Mparsial->getjumlahpasien_ralan();
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
		$data["q3"] =$this->Mparsial->getpasien_ralan($config['per_page'],$from);
		$this->load->view('template',$data);
    }
    function pembayaran_inap($current=0,$from=0){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Kasir Rawat Inap &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "kasir/vlistrawatinap";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="kasir";
        $data["current"] = $current;
        $data["title_header"] = "Kasir Rawat Inap ";
        $data["p"] = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"] = "<li class='active'><strong>Kasir Rawat Inap</strong></li>";        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'kasir/pembayaran_inap/'.$current;
        $config['total_rows'] = $this->Mparsial->getjumlahpasien_inap();
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
        $data["k"] = $this->Mparsial->getkeadaan_pulang();
        $data["sp"] = $this->Mparsial->getstatus_pulang();
        $data["q3"] =$this->Mparsial->getpasien_inap($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function getcaripasien_ralan(){
    	$this->session->set_flashdata("no_pasien",$this->input->post("cari_no"));
    	$this->session->set_flashdata("nama",$this->input->post("cari_nama"));
    	$this->session->set_flashdata("no_reg",$this->input->post("cari_noreg"));
    }
    function getcaripasien_inap(){
    	$this->session->set_flashdata("no_rm",$this->input->post("cari_no"));
    	$this->session->set_flashdata("nama",$this->input->post("cari_nama"));
    	$this->session->set_flashdata("no_reg",$this->input->post("cari_noreg"));
    }
    function reset_ralan(){
        $this->session->unset_userdata('poli_kode'); 
        $this->session->unset_userdata('poliklinik');
        $this->session->unset_userdata('kode_dokter'); 
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1'); 
        $this->session->unset_userdata('tgl2');
        redirect("kasir/pembayaran_ralan");
    }
    function search_ralan(){
        $this->session->set_userdata('poli_kode',$this->input->post("poli_kode"));
        $this->session->set_userdata('poliklinik',$this->input->post("poliklinik"));
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
        $this->session->set_userdata('dokter',$this->input->post("dokter"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function search_inap(){
        $this->session->set_userdata('kode_kelas',$this->input->post("kode_kelas"));
        $this->session->set_userdata('kelas',$this->input->post("kelas"));
        $this->session->set_userdata('kode_ruangan',$this->input->post("kode_ruangan"));
        $this->session->set_userdata('ruangan',$this->input->post("ruangan"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function reset_inap(){
        $this->session->unset_userdata('kode_kelas'); 
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan'); 
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1'); 
        $this->session->unset_userdata('tgl2');
        redirect("kasir/pembayaran_inap");
    }
    function viewpembayaran_inap($no_pasien,$no_reg){
		$data["vmenu"] = $this->session->userdata("controller")."/vmenu";
		$data['menu']="kasir";
		$data["no_pasien"] = $no_pasien;
		$data["no_reg"] = $no_reg;
        $data["title"]        = "Pembayaran Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Pembayaran Rawat Inap";
        $data["content"] = "kasir/vviewpembayaran_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Pembayaran Rawat Inap</strong></li>";
        $data["row"]			  = $this->Mparsial->getinap_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mparsial->getkasir_detail($no_reg);
        $data["t1"] = $this->Mparsial->getkasir_inap($no_reg);
        $data["t2"] = $this->Mparsial->getkasir_igd($no_reg);
        $data["a1"] = $this->Mparsial->getkasir_ambulance($no_reg);
        $data["p1"] = $this->Mparsial->getkasir_penunjang($no_reg);
        $data["o1"] = $this->Mparsial->getkasir_operasi($no_reg);
        $data["o2"] = $this->Mparsial->getkasir_opr($no_reg);
        $data["l1"] = $this->Mparsial->getkasir_lab($no_reg);
        $data["g1"] = $this->Mparsial->getkasir_gizi($no_reg);
        $data["r1"] = $this->Mparsial->getkasir_inap_radiologi($no_reg);
        $data["pa1"] = $this->Mparsial->getkasir_inap_pa($no_reg);
        $data["t"]  = $this->Mparsial->gettindakan_inap();
        $data["a"]  = $this->Mparsial->getambulance();
        $data["o"]  = $this->Mparsial->getoperasi();
        $data["prs"]  = $this->Mparsial->getperusahaan();
        $data["dokter"]  = $this->Mparsial->getdokter_array();
        $data["kamar"]  = $this->Mparsial->getkamar_array();
        $data["p"]  = $this->Mparsial->getpenunjang_medis();
        $this->load->view('template',$data);
    }
    function hapusinap(){
        $this->Mparsial->hapusinap();
        $this->session->set_flashdata("message","danger-Tarif berhasil dihapus");
    }
    function changedata(){
        $this->Mparsial->changedata();
    }
    function changedata_inap(){
        $this->Mparsial->changedata_inap();
    }
    function getdokter(){
        echo json_encode($this->Mparsial->getdokter());
    }
    function getkamar(){
        echo json_encode($this->Mparsial->getkamar());
    }
    function simpantransaksi_inap(){
        $this->Mparsial->simpantransaksi_inap();
        $this->session->set_flashdata("message","success-Tarif berhasil dibayar");
    }
    function cetakkwitansi_inap($no_pasien,$no_reg){
        $data["no_pasien"]    = $no_pasien;
        $data["no_reg"]       = $no_reg;
        $data["row"]          = $this->Mparsial->getinap_detail($no_pasien,$no_reg);
        $data["q"]            = $this->Mparsial->getparsial_detail($no_reg);
        $data["t1"]           = $this->Mparsial->getparsial_inap($no_reg);
        $data["t2"]           = $this->Mparsial->getparsial_igd($no_reg);
        $data["a1"]           = $this->Mparsial->getparsial_ambulance_inap($no_reg);
        $data["p1"]           = $this->Mparsial->getparsial_penunjang_inap($no_reg);
        $data["l1"]           = $this->Mparsial->getparsialinap_lab($no_reg);
        $data["r1"]           = $this->Mparsial->getparsial_inap_radiologi($no_reg);
        // $data["dokter"]       = $this->Mparsial->getdokter_array();
        $this->load->view('parsial/vcetakkwitansi_inap',$data);
    }
    function getinap_detail(){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        echo json_encode($this->Mparsial->getinap_detail($no_pasien,$no_reg));
    }
    function simpan_pulang(){
        // $this->updatesep();
        $this->Mparsial->simpan_pulang();
    }
    function batal_pulang(){
        $this->Mparsial->batal_pulang();
    }
    function updatesep(){
        $no_sep = $this->input->post("no_sep");
        $sp = explode("/",$this->input->post("status_pulang"));
        $tgl_keluar = $this->input->post("tgl_keluar");
        $jam_keluar = $this->input->post("jam_keluar");
        $arr["request"]["t_sep"] = array(
                "noSep" => $no_sep,
                "tglPulang" => date("Y-m-d",strtotime($tgl_keluar))." ".date("H:i:s",strtotime($jam_keluar)),
                "Status" => "1",
                "user" => "SUNANTO"
            );
        $data = "20337";
        $secretKey = "4tW3926623";
        date_default_timezone_set('UTC');
        $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Sep/updtglplg";
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $curl = curl_init();
        $header = array(
                "X-cons-id : ".$data.",
                X-signature : ".$encodedSignature.",
                X-timestamp : ".$tStamp.",
                Content-Type: Application/x-www-form-urlencoded",
        );
        $json = json_encode($arr);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "X-cons-id: ".$data." ",
                "X-signature: ".$encodedSignature." ",
                "X-timestamp: ".$tStamp." ",
                "Content-Type: Application/x-www-form-urlencoded ",
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $msg = json_decode($response,true); 
        // var_dump($msg);
        $this->session->set_flashdata("message","success|".$msg["metaData"]["message"]);
    }
    function laporan_ralan($frm="all",$tgl1="",$tgl2="",$golpas="all",$poli="all"){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="kasir";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["frm"] = $frm;
        $data["poli"] = $poli;
        $data["golpas"] = $golpas;
        $data["p"] = $this->Mparsial->getpoliklinik();
        $data["title"]        = "Laporan Rawat Jalan || RS CIREMAI";
        $data["title_header"] = "Laporan Rawat Jalan";
        $data["content"] = "kasir/vlaporan_ralan";
        $data["breadcrumb"]   = "<li class='active'><strong>Laporan Rawat Jalan</strong></li>";
        $data["q"] = $this->Mparsial->laporan_ralan($tgl1,$tgl2,$frm,$poli);
        $data["a"] = $this->Mparsial->laporan_apotek($tgl1,$tgl2,$frm,$poli);
        $this->load->view('template',$data);
    }
    function cetak_laporan_ralan($frm="all",$tgl1="",$tgl2="",$golpas="all",$poli="all"){
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["golpas"] = $golpas;
        $data["frm"] = $frm;
        $data["poli"] = $poli;
        $data["title"]        = "Laporan Rawat Jalan || RS CIREMAI";
        $data["title_header"] = "Laporan Rawat Jalan";
        $data["q"] = $this->Mparsial->laporan_ralan($tgl1,$tgl2,$frm,$poli);
        $data["a"] = $this->Mparsial->laporan_apotek($tgl1,$tgl2,$frm,$poli);
        $this->load->view('kasir/vcetak_laporan_ralan',$data);
    }
    function laporan_inap($frm="all",$tgl1="",$tgl2="",$golpas="all"){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="kasir";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["frm"] = $frm;
        $data["golpas"] = $golpas;
        $data["title"]        = "Laporan Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Laporan Rawat Inap";
        $data["content"] = "kasir/vlaporan_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Laporan Rawat Inap</strong></li>";
        $data["q"] = $this->Mparsial->laporan_inap($tgl1,$tgl2,$frm);
        $data["a"] = $this->Mparsial->laporan_apotek($tgl1,$tgl2,$frm,"all","ranap");
        $this->load->view('template',$data);
    }
    function cetak_laporan_inap($frm="all",$tgl1="",$tgl2="",$golpas="all"){
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["golpas"] = $golpas;
        $data["frm"] = $frm;
        $data["title"]        = "Laporan Rawat Jalan || RS CIREMAI";
        $data["title_header"] = "Laporan Rawat Jalan";
        $data["q"] = $this->Mparsial->laporan_inap($tgl1,$tgl2,$frm);
        $data["a"] = $this->Mparsial->laporan_apotek($tgl1,$tgl2,$frm,"all","ranap");
        $this->load->view('kasir/vcetak_laporan_inap',$data);
    }
    function simpansharing(){
        $data = array(
                    "sharing" => $this->input->post("sharing"),
                    "blu" => $this->input->post("blu"),
                    "cob" => $this->input->post("cob"),
                    "kode_perusahaan" => $this->input->post("kode_perusahaan"),
                );
        $this->db->where("no_reg",$this->input->post("no_reg"));
        $this->db->update("pasien_inap",$data);
    }
    function keuangan($tgl1="",$tgl2="",$golpas="all"){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="kasir";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["frm"] = $frm;
        $data["golpas"] = $golpas;
        $data["title"]        = "Laporan Sharing || RS CIREMAI";
        $data["title_header"] = "Laporan Sharing";
        $data["content"] = "kasir/vkeuangan";
        $data["breadcrumb"]   = "<li class='active'><strong>Laporan Sharing</strong></li>";
        $data["q"] = $this->Mparsial->keuangan($tgl1,$tgl2);
        $this->load->view('template',$data);
    }
    function cetak_keuangan($tgl1="",$tgl2="",$golpas="all"){
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["golpas"] = $golpas;
        $data["title"]        = "Laporan Sharing || RS CIREMAI";
        $data["title_header"] = "Laporan Sharing";
        $data["q"] = $this->Mparsial->keuangan($tgl1,$tgl2);
        $this->load->view('kasir/vcetak_keuangan',$data);
    }
    function feesharing($tgl1="",$tgl2=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="kasir";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["title"]        = "Laporan Sharing || RS CIREMAI";
        $data["title_header"] = "Laporan Sharing";
        $data["content"] = "kasir/vfeesharing";
        $data["breadcrumb"]   = "<li class='active'><strong>Laporan Sharing</strong></li>";
        $data["q"] = $this->Mparsial->feesharing($tgl1,$tgl2);
        $data["d"] = $this->Mparsial->getdokter_array();
        $this->load->view('template',$data);
    }
}
?>