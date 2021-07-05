<?php
class Gizi extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mgizi');
		$this->load->Model('Mpendaftaran');
        $this->load->Model('Mkasir');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function ralan($current=0,$from=0){
		$data["title"] 				= "Gizi Rawat Jalan";
		$data['judul'] 				= "Gizi Rawat Jalan";
		$data["vmenu"] 				= $this->session->userdata("controller")."/vmenu";
		$data["content"] 			= "gizi/vlistgizi_ralan";
		$data["username"] 			= $this->session->userdata('nama_user');
	    $data['menu']				= "gizi";
	    $data["current"] 			= $current;
	    $data["title_header"] 		= "Gizi Rawat Jalan ";
	    $data["total_rows"] 		= $this->Mgizi->getgizi_ralan();
	    $data["breadcrumb"] 		= "<li class='active'><strong>Gizi Rawat Jalan</strong></li>";
		$this->load->library('pagination');
        $config['base_url'] 		= base_url().'gizi/ralan/'.$current;
        $config['total_rows'] 		= $this->Mgizi->getgizi_ralan();
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
		$data["q3"] 				= $this->Mgizi->getpasien_ralan_gizi($config['per_page'],$from);
        $data["q"]                  = $this->Mgizi->pilihdoktergizi();
		$this->load->view('template',$data);
    }
    function cari_giziralan(){

        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
        $this->session->set_userdata('dokter',$this->input->post("dokter"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
        $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
        $this->session->set_userdata("status_pasien",$this->input->post("status_pasien"));
    }
    function reset_giziralan(){
        $this->session->unset_userdata('kode_dokter');
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        $this->session->unset_userdata('no_rm');
        $this->session->unset_userdata('no_reg');
        $this->session->unset_userdata('nama');
        redirect("gizi/ralan");
    }
    function cari_giziinap(){
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
        $this->session->set_userdata('dokter',$this->input->post("dokter"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
        $this->session->set_userdata('kode_ruangan',$this->input->post("kode_ruangan"));
        $this->session->set_userdata('ruangan',$this->input->post("ruangan"));
        $this->session->set_userdata('kode_kelas',$this->input->post("kode_kelas"));
        $this->session->set_userdata('isi',$this->input->post("isi"));
        $this->session->set_userdata('kelas',$this->input->post("kelas"));
        $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
    }
    function reset_giziinap(){
        $this->session->unset_userdata('kode_dokter');
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('isi');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata("no_pasien");
        $this->session->unset_userdata("nama");
        $this->session->unset_userdata("no_reg");
        redirect("gizi/inap");
    }
    function detailgizi_ralan($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "gizi";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Gizi Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Detail Gizi Rawat Jalan";
        $data["content"]        = "gizi/vformgizi_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Gizi Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mgizi->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mgizi->getkasir($no_reg);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]              = $this->Mgizi->gettarif_gizi();
        $data["d"]              = $this->Mgizi->getdokter_gizi();
        $data["d1"]             = $this->Mgizi->getdokter();
        $data["r"]              = $this->Mgizi->getpetugasgizi();
        $data["dokter"]         = $this->Mgizi->getdokter_array();
        $data["petugas_gizi"]    = $this->Mgizi->getpetugas_array();
        $data["dokter_pengirim"]= $this->Mgizi->getdokterpengirim_array();
        $this->load->view('template',$data);
    }
    function addtindakan(){
        $this->Mgizi->addtindakan();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_inap(){
        $this->Mgizi->addtindakan_inap();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function addtindakan_makan(){
        $this->Mgizi->addtindakan_makan();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function hapustindakan_inap(){
        $this->Mradiologi->hapustindakan_inap();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
    function ekspertisi($no_pasien,$no_reg,$kode_tindakan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "gizi";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["kode_tindakan"]    = $kode_tindakan;
        $data["title"]          = "Ekspertisi || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi";
        $data["content"]        = "gizi/vformekspertisi";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi</strong></li>";
        $data["row"]            = $this->Mgizi->getralan_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mgizi->getekspertisi_detail($no_pasien,$no_reg,$kode_tindakan);
        $data["d"]              = $this->Mgizi->getdokter_gizi();
        $data["d1"]             = $this->Mgizi->getdokter();
        $data["r"]              = $this->Mgizi->getpetugasgizi();
        $data["k2"]             = $this->Mgizi->getkasir_detail($no_reg,$kode_tindakan);
        $data["k"]              = $this->Mgizi->getkasir($no_reg);
        $data["hasil_pemeriksaan"]          = $this->Mgizi->getekspertisigizi_detail_array($no_reg,$kode_tindakan);
        $data["a"]              = $this->Mgizi->getasuhan_ralan($no_reg,$kode_tindakan);
        $this->load->view('template',$data);
    }
    function ambildatanormal($dokter){
        $data["q"]              = $this->Mgizi->ambildatanormal($dokter);
        $data["title"]          = "Data Normal || RS CIREMAI";
        $data["title_header"]   = "Data Normal";
        $this->load->view('radiologi/vpilih_datanormal',$data);
    }
    function siMgizinekspertisi($action){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $tindakan = $this->input->post("tindakan");
        $message = $this->Mgizi->siMgizinekspertisi($action);
        $this->session->set_flashdata("message",$message);
        redirect("gizi/ekspertisi/".$no_pasien."/".$no_reg."/".$tindakan);
    }
    function siMgizinradiologi(){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $message = $this->Mradiologi->siMgizinradiologi();
        $this->session->set_flashdata("message",$message);
        redirect("radiologi/detailradiologi_ralan/".$no_pasien."/".$no_reg);
    }
    function cetak($no_reg, $no_pasien,$kode_tindakan){
        $data["no_reg"] = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]          = $this->Mgizi->getcetak($no_reg,$no_pasien);
        $data["k"]          = $this->Mgizi->getcetak_kasir($no_reg,$kode_tindakan);
        $data["hasil_pemeriksaan"]          = $this->Mgizi->getekspertisigizi_detail_array($no_reg,$kode_tindakan);
        $data["a"]              = $this->Mgizi->getasuhan_ralan($no_reg,$kode_tindakan);
        $this->load->view('gizi/vcetakgizi',$data);
    }
    function inap($current=0,$from=0){
        $data["title"]              = "Gizi Rawat Inap";
        $data['judul']              = "Gizi Rawat Inap";
        $data["vmenu"]              = $this->session->userdata("controller")."/vmenu";
        $data["content"]            = "gizi/vlistgizi_inap";
        $data["username"]           = $this->session->userdata('nama_user');
        $data['menu']               = "gizi";
        $data["current"]            = $current;
        $data["title_header"]       = "Gizi Rawat Inap ";
        $data["total_rows"]         = $this->Mgizi->getgizi_inap();
        $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url().'gizi/inap/'.$current;
        $config['total_rows']       = $this->Mgizi->getgizi_inap();
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
        $data["q3"]                 = $this->Mgizi->getpasien_inap_gizi($config['per_page'],$from);
        $data["q"]                  = $this->Mgizi->pilihdoktergizi();
        $this->load->view('template',$data);
    }
    function detailgizi_inap($no_pasien,$no_reg,$tanggal=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "gizi";
        // if ($tanggal=="") {
        // 	$tanggal = date("d-m-Y");
        // }

        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["tanggal"]	    = $tanggal;
        $data["title"]          = "Detail Gizi Rawat Inap || RS CIREMAI";
        $data["title_header"]   = "Detail Gizi Rawat Inap";
        $data["content"]        = "gizi/vformgizi_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Gizi Rawat Inap</strong></li>";
        $data["row"]            = $this->Mgizi->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mgizi->getkasir_inap($no_reg,$tanggal);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]              = $this->Mgizi->gettarif_gizi();
        $data["d"]              = $this->Mgizi->getdokter_gizi();
        $data["d1"]             = $this->Mgizi->getdokter();
        $data["r"]              = $this->Mgizi->getpetugasgizi();
        $data["dokter"]         = $this->Mgizi->getdokter_array();
        $data["dokter_pengirim"]         = $this->Mgizi->getdokterpengirim_array();
        $data["petugas_gizi"]    = $this->Mgizi->getpetugas_array();
        $this->load->view('template',$data);
    }
    function ekspertisi_inap($no_pasien,$no_reg,$id_tindakan="",$tgl="", $pemeriksaan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "gizi";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["kode_tindakan"]  = $id_tindakan;
        $data["pemeriksaan"]    = $pemeriksaan;
        $data["title"]          = "Ekspertisi || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi";
        $data["tgl"]            = $tgl;
        $data["content"]        = "gizi/vformekspertisi_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi</strong></li>";
        $data["row"]            = $this->Mgizi->getinap_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mgizi->getekspertisiinap_detail($no_pasien,$no_reg,$id_tindakan,$tgl,$pemeriksaan);
        $data["d"]              = $this->Mgizi->getdokter_gizi();
        $data["d1"]             = $this->Mgizi->getdokter();
        $data["r"]              = $this->Mgizi->getpetugasgizi();
        $data["k"]              = $this->Mgizi->getkasir_inap($no_reg,"");
        $data["hasil_pemeriksaan"]          = $this->Mgizi->getekspertisigiziinap_detail_array($no_reg,$tgl,$pemeriksaan);
        $data["as"]              = $this->Mgizi->gethasuhan($no_reg,$tgl,$pemeriksaan);
        $data["a"]              = $this->Mgizi->getasuhan($no_reg,$tgl,$pemeriksaan);
        $this->load->view('template',$data);
    }
    function getkasir_inap_detail($no_reg,$id_tindakan="",$tgl="",$pemeriksaan=""){
        $q = $this->Mgizi->getkasir_inap_detail($no_reg,$id_tindakan,$tgl,$pemeriksaan);
        echo json_encode($q);
    }
    function simpanekspertisi_inap($action){
        $no_pasien = $this->input->post("no_rm");
        $no_reg = $this->input->post("no_reg");
        $tindakan = explode("/",$this->input->post("tindakan"));
        $message = $this->Mgizi->simpanekspertisi_inap($action);
        $this->session->set_flashdata("message",$message);
        redirect("gizi/ekspertisi_inap/".$no_pasien."/".$no_reg."/".$tindakan[0]."/".$tindakan[3]."/".$tindakan[4]);
    }
    function simpangizidetail_inap($action){
        $no_pasien = $this->input->post("no_rm");
        $no_reg = $this->input->post("no_reg");
        $tindakan = $this->input->post("tindakan");
        $message = $this->Mgizi->siMgizinekspertisi_inap($action);
        $this->session->set_flashdata("message",$message);
        redirect("gizi/detailpa_inap/".$no_pasien."/".$no_reg."/".$tindakan);
    }
    function cetak_inap($no_reg, $no_pasien,$id_tindakan,$tgl,$pemeriksaan){
        $data["no_reg"] = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["k"]          = $this->Mgizi->getcetak_kasir_inap($no_reg,$id_tindakan,$tgl,$pemeriksaan);
        $data["q"]          = $this->Mgizi->getcetak_inap($no_reg,$no_pasien,$id_tindakan,$tgl);
        $data["tg"]          = $this->Mgizi->gettanggal($no_reg,$no_pasien,$id_tindakan,$tgl,$pemeriksaan);
        $data["hasil_pemeriksaan"]          = $this->Mgizi->getekspertisigiziinap_detail_array($no_reg,$tgl,$pemeriksaan);
        $data["a"]              = $this->Mgizi->getasuhan($no_reg,$tgl,$pemeriksaan);
        $this->load->view('gizi/vcetakgizi_inap',$data);
        }
    function changedata_ralan($jenis){
        $this->Mgizi->changedata_ralan($jenis);
    }
    function changedata($jenis){
        $this->Mgizi->changedata($jenis);
    }
    function changedata_makan($jenis){
        $this->Mgizi->changedata_makan($jenis);
    }
    function hapusinap(){
        $this->Mgizi->hapusinap();
    }
    function hapusralan(){
        $this->Mgizi->hapusralan();
    }
    function getpetugas_gizi(){
        echo json_encode($this->Mgizi->getpetugasgizi()->result());
    }
    function getdiet(){
        echo json_encode($this->Mgizi->getdiet()->result());
    }
    function getmenu(){
        echo json_encode($this->Mgizi->getmenu()->result());
    }
    function getdokter_gizi(){
        echo json_encode($this->Mgizi->getdokter_gizi()->result());
    }
    function getdokter(){
        echo json_encode($this->Mgizi->getdokter()->result());
    }
    function makan($current=0,$from=0,$tanggal=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "gizi";
        $data["title"]          = "Detail Gizi Rawat Inap || RS CIREMAI";
        $data["title_header"]   = "Detail Gizi Rawat Inap";
        $data["content"]        = "gizi/vformmakan";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Makan Gizi Rawat Inap</strong></li>";
        $data["total_rows"]         = $this->Mgizi->getgizi_inap();
        $data["current"]            = $current;
        $data["tanggal"]            = $tanggal;
        // $data["row"]            = $this->Mgizi->getinap_detail($no_pasien,$no_reg);
        // $data["k"]              = $this->Mgizi->getkasir_inap($no_reg,$tanggal);
        // $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]              = $this->Mgizi->getmakan();
        $data["d"]              = $this->Mgizi->getdokter_gizi();
        $data["d1"]             = $this->Mgizi->getdokter();
        $data["r"]              = $this->Mgizi->getpetugasgizi();
        $data["dokter"]         = $this->Mgizi->getdokter_array();
        $data["dokter_pengirim"]         = $this->Mgizi->getdokterpengirim_array();
        $data["diet"]    = $this->Mgizi->getdiet_array();
        $data["menu"]    = $this->Mgizi->getmenu_array();
        // $data["no_reg1"]    = $this->Mgizi->getnoreg_array();
        $this->load->library('pagination');
        $config['base_url']         = base_url().'gizi/makan/'.$current;
        $config['total_rows']       = $this->Mgizi->getgizi_inap();
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
        $data["q3"]                 = $this->Mgizi->getpasien_inap_makan($config['per_page'],$from);
        // $data["q3"]                 = $this->Mgizi->getpasien_inap_gizi($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function cetakmakan(){
        // $data["no_reg"] = $no_reg;
        $data["diet"]    = $this->Mgizi->getdiet_array();
        $data["menu"]    = $this->Mgizi->getmenu_array();
        $data["q"]          = $this->Mgizi->getcetakmakan();
        $this->load->view('gizi/vcetakmakan',$data);
    }
    function cetakbarcode(){
        // $data["no_reg"] = $no_reg;
        $data["diet"]    = $this->Mgizi->getdiet_array();
        $data["menu"]    = $this->Mgizi->getmenu_array();
        $data["q"]          = $this->Mgizi->getcetakmakan();
        // $data["q1"]          = $this->Mgizi->getcetakmakanreg();
        $this->load->view('gizi/vcetakmakan_barcode',$data);
    }
    function pilihisi(){
        $data["q"]              = $this->Mgizi->getisi();
        $data["title"]          = "Status Kamar || RS CIREMAI";
        $data["title_header"]   = "Status Kamar";
        $this->load->view('gizi/vpilihisi',$data);
    }
    function hapusmakan(){
        $this->Mgizi->hapusmakan();
        redirect("gizi/makan");
        // $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
    }
     function rekap_full($tindakan,$tgl1="",$tgl2=""){
      $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
      $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
      $data["tgl1"] = $tgl1;
      $data["tgl2"] = $tgl2;
      $data["tindakan"] = $tindakan;
      $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
      $data['menu']="home";
      $data["title"]        = "Rekap Gizi || RS CIREMAI";
      $data["title_header"] = "Rekap Gizi ";
      $data["content"] = "gizi/vgizirekap_full";
      $data["t"] = $this->Mgizi->gettarif_gizi();
      $data["p"] = $this->Mgizi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
      $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
      $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
      $this->load->view('template',$data);
    }
    function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
      echo json_encode( $this->Mgizi->getpasien_rekap_full($tindakan,$tgl1,$tgl2));
    }
    function cetakpasien_full($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["t2"] = $this->Mgizi->gettindakan_cetak2($tindakan);
        $data["tindakan"] = $tindakan;
        $data["q"] = $this->Mgizi->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('gizi/vcetakpasien_full',$data);
    }
    function cetakrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap Gizi Full || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap Gizi Full";
        $data["t"] = $this->Mgizi->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mgizi->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mgizi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('gizi/vcetakrekap_full',$data);
    }
    function cetakrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Gizi Full || RS CIREMAI";
        $data["title_header"] = "Cetak Gizi Full";
        $data["t"] = $this->Mgizi->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mgizi->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mgizi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('gizi/vcetakrekap_full2',$data);
    }
    function excelrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mgizi->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mgizi->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mgizi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('gizi/vpaexcelrekap_full',$data);
      }
      function excelrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mgizi->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mgizi->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mgizi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('gizi/vpaexcelrekap_full2',$data);
      }
}
?>
