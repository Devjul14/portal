<?php
class Home extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('Mlogin');
    $this->load->model('Mhome');
    $this->load->model('Mhemodialisa');
    $this->load->model('Moka');
    $this->load->model('Mradiologi');
    $this->load->model('Mgizi');
    $this->load->model('Mpendaftaran');
    $this->load->model('Mlab');
    $this->load->model('Mpa');
    if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
    {
      redirect("login/logout","refresh");
    }
  }
  function index($tgl1="",$tgl2=""){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Dashboard || RS CIREMAI";
    $data["title_header"] = "Dashboard";
    $data["content"] = "vhome";
    $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
    $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
    $data["breadcrumb"]   = "<li class='active'><strong>Dashboard</strong></li>";
    $data["total_pasien"] = $this->Mhome->gettotalpasien();
    $data["pasien_thn"] = $this->Mhome->gettotalpasienthn();
    $data["pasien_bln"] = $this->Mhome->gettotalpasienbln();
    $data["pasien_day"] = $this->Mhome->gettotalpasienday();
    $data["bor"] = $this->Mhome->getbor();
    $data["borc"] = $this->Mhome->getbor_covid();
    $data["graph"] = json_encode($this->Mhome->getpasien());
    $data["poli"] = json_encode($this->Mhome->getpasien_poli());
    $data["lab"] = json_encode($this->Mhome->gettindakan($tgl1,$tgl2));
    $this->load->view('template',$data);
  }
  function pelayanan($tgl1="",$tgl2=""){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Dashboard || RS CIREMAI";
    $data["title_header"] = "Rawat Inap";
    $tgl1 = $tgl1=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl1));
    $tgl2 = $tgl2=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl2));
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["content"] = "home/vpelayanan";
    $data["r"] = $this->Mhome->getruangan();
    $data["p"] = $this->Mhome->getpoliklinik();
    $data["poli"] = $this->Mhome->getpasien_poli2($tgl1,$tgl2);
    $data["igd"] = $this->Mhome->getpasienigdinap($tgl1,$tgl2);
    $data["kelas"] = $this->Mhome->getkelas();
    $data["kls_tt"] = $this->Mhome->getkelas_rinap_pasien();
    $data["bed"] = $this->Mhome->getbed();
    $data["inap"] = $this->Mhome->getpasien_inap();
    $data["inap_kelas"] = $this->Mhome->getpasien_inap_jenis_kelas();
    $data["inap2"] = $this->Mhome->getpasien_inap2($tgl1,$tgl2);
    $data["inap2_kelas"] = $this->Mhome->getpasien_inap2_kelas($tgl1,$tgl2);
    $data["inap_denkes"] = $this->Mhome->getpasien_denkes_rumkit();
    $data["inap_nondenkes"] = $this->Mhome->getpasien_nondenkes();
    $data["inaplama"] = $this->Mhome->getpasien_inaplama();
    $data["breadcrumb"]   = "<li class='active'><strong>Rawat Inap</strong></li>";
    $data["total_pasien"] = $this->Mhome->gettotalpasien();
    $this->load->view('template',$data);
  }
  function igd($tgl1="",$tgl2=""){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Dashboard || RS CIREMAI";
    $data["title_header"] = "Pelayanan";
    $tgl1 = $tgl1=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl1));
    $tgl2 = $tgl2=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl2));
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["content"] = "home/vrekapigd";
    $data["r"] = $this->Mhome->getruangan();
    $data["p"] = $this->Mhome->getpoliklinik();
    $data["poli"] = $this->Mhome->getpasien_poli2($tgl1,$tgl2);
    $data["igd"] = $this->Mhome->getpasienigdinap($tgl1,$tgl2);
    $data["breadcrumb"]   = "<li class='active'><strong>Pelayanan</strong></li>";
    $data["total_pasien"] = $this->Mhome->gettotalpasien();
    $this->load->view('template',$data);
  }
  function covid($tgl1="",$tgl2=""){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Dashboard || RS CIREMAI";
    $data["title_header"] = "Covid-19";
    $tgl1 = $tgl1=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl1));
    $tgl2 = $tgl2=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl2));
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["content"] = "home/vcovid19";
    $data["r"] = $this->Mhome->getruangan();
    $data["rc"] = $this->Mhome->getruangan_covid();
    $data["p"] = $this->Mhome->getpoliklinik();
    $data["covid"] = $this->Mhome->getpasien_covid($tgl1,$tgl2);
    $data["poli"] = $this->Mhome->getpasien_poli2($tgl1,$tgl2);
    $data["igd"] = $this->Mhome->getpasienigdinap($tgl1,$tgl2);
    $data["kelas"] = $this->Mhome->getkelas();
    $data["bed"] = $this->Mhome->getbed_covid();
    $data["inap"] = $this->Mhome->getpasien_inap_covid();
    $data["swab"] = $this->Mhome->getswab();
    $data["inap2"] = $this->Mhome->getpasien_inap2_covid($tgl1,$tgl2);
    $data["breadcrumb"]   = "<li class='active'><strong>Covid-19</strong></li>";
    $data["total_pasien"] = $this->Mhome->gettotalpasien();
    $this->load->view('template',$data);
  }
  function listpasieninap(){
    echo json_encode($this->Mhome->getlistpasien_inap());
  }
  function listpasieninap_kelas(){
    echo json_encode($this->Mhome->getlistpasien_inap_kelas());
  }
  function listpasienralan_igd(){
    echo json_encode($this->Mhome->getlistpasien_ralan_igd());
  }
  function listpasieninap_igd(){
    echo json_encode($this->Mhome->getlistpasien_inap_igd());
  }
  function listpasieninap_covid(){
    echo json_encode($this->Mhome->getlistpasien_inap_covid());
  }
  function listpasieninap2(){
    echo json_encode($this->Mhome->getlistpasien_inap2());
  }
  function listpasieninap2_kelas(){
    echo json_encode($this->Mhome->getlistpasien_inap2_kelas());
  }
  function listpasieninap2_covid(){
    echo json_encode($this->Mhome->getlistpasien_inap2_covid());
  }
  function listpasieninap3_covid(){
    echo json_encode($this->Mhome->getlistpasien_inap3_covid());
  }
  function cetak_ralan($tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl1));
    $tgl2 = $tgl2=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl2));
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["r"] = $this->Mhome->getruangan();
    $data["p"] = $this->Mhome->getpoliklinik();
    $data["poli"] = $this->Mhome->getpasien_poli2($tgl1,$tgl2);
    $this->load->view('home/vcetak_ralan',$data);
  }
  function prosedur_masuk(){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Dashboard || RS CIREMAI";
    $data["title_header"] = "Dashboard";
    $data["content"] = "home/vprosedur_masuk";
    $data["breadcrumb"]   = "<li class='active'><strong>Dashboard</strong></li>";
    // $data["pasien_thn"] = $this->Mhome->gettotalpasienthn();
    // $data["pasien_bln"] = $this->Mhome->gettotalpasienbln();
    // $data["pasien_day"] = $this->Mhome->gettotalpasienday();
    // $data["total_pasien"] = $this->Mhome->gettotalpasien();
    $data["ugd"] = $this->Mhome->getpasien_ugd();
    $data["langsung"] = $this->Mhome->getpasien_langsung();
    $data["poliklinik"] = $this->Mhome->getpasien_poliklinik();
    $data["graph"] = json_encode($this->Mhome->getpasien_prosedur());
    $data["graph_tahun"] = json_encode($this->Mhome->getpasien_prosedurtahun());
    $data["poli"] = json_encode($this->Mhome->getpasien_poli());
    $data["q"]    = $this->Mhome->getpasien_prosedur2();
    $data["q1"]	  = $this->Mhome->getpasien_prosedurtahun2();
    $data["q2"]	  = $this->Mhome->getpasien_prosedurtoday();
    $this->load->view('template',$data);
  }
  function cara_masuk(){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Dashboard || RS CIREMAI";
    $data["title_header"] = "Dashboard";
    $data["content"] = "home/vcara_masuk";
    $data["breadcrumb"]   = "<li class='active'><strong>Dashboard</strong></li>";
    $data["sendiri"] = $this->Mhome->getpasien_sendiri();
    $data["rs"] = $this->Mhome->getpasien_rs();
    $data["dokter"] = $this->Mhome->getpasien_dokter();
    $data["paramedis"] = $this->Mhome->getpasien_paramedis();
    $data["puskesmas"] = $this->Mhome->getpasien_puskesmas();
    $data["kepolisian"] = $this->Mhome->getpasien_kepolisian();
    $data["lain"] = $this->Mhome->getpasien_lain();
    $data["graph"] = json_encode($this->Mhome->getpasien_cara());
    $data["graph_tahun"] = json_encode($this->Mhome->getpasien_caratahun());
    $data["poli"] = json_encode($this->Mhome->getpasien_poli());
    $data["q"]    = $this->Mhome->getcarapasien_masuk();
    $data["q1"]    = $this->Mhome->getcarapasien_masuktahun();
    $data["q2"]    = $this->Mhome->getcarapasien_masuktoday();
    $this->load->view('template',$data);
  }
  function indeksalamat($tgl="",$kota="3274"){
    $data["vmenu"] 						= $this->session->userdata("controller")."/vmenu";
    $data['menu']						= "home";
    $tgl                                = $tgl == "" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl));
    $bulan                              = date("m",strtotime($tgl));
    $tahun                              = date("Y",strtotime($tgl));
    $data["tgl"]                        = $tgl;
    $data["bulan"] 					    = $bulan;
    $data["tahun"] 					    = $tahun;
    $data["kota"]                       = $kota;
    $data["title"]        				= "Indeks Alamat|| RS CIREMAI";
    $data["title_header"] 				= "Indeks Alamat";
    $data["content"] 					= "home/vindeksalamat";
    $data["breadcrumb"]   				= "<li class='active'><strong>Indeks Alamat</strong></li>";
    $data["row"]              			= $this->Mpendaftaran->persenpelayanan($bulan,$tahun);
    $data["p"]                          = json_encode($this->Mpendaftaran->persenperwilayah($kota));
    $data["row_pi"]              		= $this->Mpendaftaran->persenpelayanan_inap($bulan,$tahun);
    $data["pi"]                         = json_encode($this->Mpendaftaran->persenperwilayah_inap($kota));
    $this->load->view('template',$data);
  }
  function rekap_full($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Rekap Rawat Jalan || RS CIREMAI";
    $data["title_header"] = "Rekap Rawat Jalan ";
    $data["content"] = "home/vpolirekap_full";
    $data["t"] = $this->Mhome->getpoliklinikrekap();
    $data["p"] = $this->Mhome->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
    $this->load->view('template',$data);
  }
  function rekap_full_new($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Rekap Rawat Jalan || RS CIREMAI";
    $data["title_header"] = "Rekap Rawat Jalan ";
    $data["content"] = "home/vpolirekap_new";
    $data["t"] = $this->Mhome->getpoliklinikrekap();
    $data["p"] = $this->Mhome->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
    $this->load->view('template',$data);
  }
  function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
    echo json_encode( $this->Mhome->getpasien_rekap_full($tindakan,$tgl1,$tgl2));
  }
  function cetakpasien_full($tindakan, $tgl1="", $tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["t2"] = $this->Mhome->gettindakan_cetak2($tindakan);
    $data["tindakan"] = $tindakan;
    $data["q"] = $this->Mhome->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
    $this->load->view('home/vcetakpasien_full',$data);
  }
  function cetakrekap_full($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["title"]        = "Cetak Rekap Rawat Jalan || RS CIREMAI";
    $data["title_header"] = "Cetak Rekap Rawat Jalan";
    $data["t"] = $this->Mhome->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mhome->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mhome->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $this->load->view('home/vcetakrekap_full',$data);
  }
  //view blum dibuat
  // function cetakrekap_full2($tindakan,$tgl1="",$tgl2=""){
  //     $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
  //     $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
  //     $data["tgl1"] = $tgl1;
  //     $data["tgl2"] = $tgl2;
  //     $data["tindakan"] = $tindakan;
  //     $data["title"]        = "Cetak Gizi Full || RS CIREMAI";
  //     $data["title_header"] = "Cetak Gizi Full";
  //     $data["t"] = $this->Mgizi->gettindakan_cetak($tindakan);
  //     $data["t2"] = $this->Mgizi->gettindakan_cetak2($tindakan);
  //     $data["p"] = $this->Mgizi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
  //     $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
  //     $this->load->view('gizi/vcetakrekap_full2',$data);
  // }
  function excelrekap_full($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["t"] = $this->Mhome->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mhome->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mhome->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    // $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
    $this->load->view('home/vpolexcelrekap_full',$data);
  }
  function changedata_simulasi(){
    switch ($this->input->post("jenis")) {
      case 'koding':
      $data = array("koding"=>str_replace(".", "", $this->input->post("value")));
      $koding = str_replace(".", "", $this->input->post("value"));
      $billing = 0;
      break;
      case 'billing':
      $data = array("billing"=>str_replace(".", "", $this->input->post("value")));
      $billing = str_replace(".", "", $this->input->post("value"));
      $koding = 0;
      break;
    }
    $q = $this->db->get_where("simulasi_koding",["no_reg"=>$this->input->post("no_reg")]);
    if($q->num_rows()>0){
      $this->db->where("no_reg",$this->input->post("no_reg"));
      $this->db->update("simulasi_koding",$data);
    } else {
      $data = array("no_reg"=>$this->input->post("no_reg"),"koding"=>$koding,"billing"=>$billing);
      $this->db->insert("simulasi_koding",$data);
    }
  }
  function pasienrujuk(){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Pasien Rujuk || RS CIREMAI";
    $data["title_header"] = "Pasien Rujuk ";
    $data["content"] = "home/vrujuk";
    $data["p"] = $this->Mhome->getpasienrujuk();
    $data["breadcrumb"]   = "<li class='active'><strong>Pasien Rujuk</strong></li>";
    $this->load->view('template',$data);
  }
  function kontrole(){
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Kontrole || RS CIREMAI";
    $data["title_header"] = "Kontrole ";
    $data["content"] = "home/vkontrole";
    $data["row"] = $this->Mhome->getkontrole();
    $data["breadcrumb"]   = "<li class='active'><strong>Kontrole</strong></li>";
    $this->load->view('template',$data);
  }
  function simpankontrole($action){
    $message = $this->Mhome->simpankontrole($action);
    $this->session->set_flashdata("message",$message);
    redirect("home/kontrole");
  }
  function cetakkontrole($tgl=""){
    $tgl1 = $tgl=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl));
    $tgl2 = $tgl=="" ? date("d-m-Y") : date("d-m-Y",strtotime($tgl));
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Kontrole || RS CIREMAI";
    $data["title_header"] = "Kontrole ";
    $data["r"] = $this->Mhome->getruangan_kontrole();
    $data["rg"] = $this->Mhome->getruangan();
    // $data["p"] = $this->Mhome->getpoliklinik();
    // $data["poli"] = $this->Mhome->getpasien_poli2($tgl1,$tgl2);
    // $data["igd"] = $this->Mhome->getpasienigdinap($tgl1,$tgl2);
    // $data["kelas"] = $this->Mhome->getkelas();
    // $data["kls_tt"] = $this->Mhome->getkelas_rinap_pasien();
    // $data["bed"] = $this->Mhome->getbed();
    $data["inap"] = $this->Mhome->getpasien_inap_kontrole($tgl1);
    $data["inap3"] = $this->Mhome->getpasien_inap3_kontrole();
    $data["t"] = $this->Mhome->getpoliklinikrekap();
    $data["ralan"] = $this->Mhome->rekap_ralan_full("all",$tgl1,$tgl2);
    $data["inap2"] = $this->Mhome->getpasien_inap2($tgl1,$tgl2);
    // $data["inap2_kelas"] = $this->Mhome->getpasien_inap2_kelas($tgl1,$tgl2);
    $data["inap_denkes"] = $this->Mhome->getpasien_denkes_rumkit();
    $data["poli"] = $this->Mhome->getpasien_poli2($tgl1,$tgl2);
    $data["igd"] = $this->Mhome->getpasienigdinap($tgl1,$tgl2);
    $data["to"] = $this->Moka->gettindakan_full_rekap();
    $data["p"] = $this->Moka->rekap_ralan_full("all",$tgl1,$tgl2);
    $data["p_inap"] = $this->Moka->rekap_inap_full("all",$tgl1,$tgl2);
    $data["th"] = $this->Mhemodialisa->gettarif_inap();
    $data["ph"] = $this->Mhemodialisa->rekap_ralan_full("0102026",$tgl1,$tgl2);
    $data["ph_inap"] = $this->Mhemodialisa->rekap_inap_full("hdl",$tgl1,$tgl2);
    $data["inap_nondenkes"] = $this->Mhome->getpasien_nondenkes();
    $data["inaplama"] = $this->Mhome->getpasien_inaplama();
    $data["kt"] = $this->Mhome->getkontrole();
    $data["prujuk"] = $this->Mhome->getpasienrujuk();
    $data["m"] = $this->Mhome->getlistpasienmeninggal($tgl1,$tgl2);
    $data["tr"] = $this->Mradiologi->gettindakan();
    $data["prad"] = $this->Mradiologi->rekap_ralan_full("all",$tgl1,$tgl2);
    $data["prad_inap"] = $this->Mradiologi->rekap_inap_full("all",$tgl1,$tgl2);
    $data["tl"] = $this->Mlab->gettindakan();
    $data["plab"] = $this->Mlab->rekap_ralan_full("all",$tgl1,$tgl2);
    $data["plab_inap"] = $this->Mlab->rekap_inap_full("all",$tgl1,$tgl2);
    $data["tpa"] = $this->Mpa->gettarif_pa();
    $data["ppa"] = $this->Mpa->rekap_ralan_full("all",$tgl1,$tgl2);
    $data["ppa_inap"] = $this->Mpa->rekap_inap_full("all",$tgl1,$tgl2);
    $data["tg"] = $this->Mgizi->gettarif_gizi();
    $data["pg"] = $this->Mgizi->rekap_ralan_full("all",$tgl1,$tgl2);
    $data["pg_inap"] = $this->Mgizi->rekap_inap_full("all",$tgl1,$tgl2);
    $data["q2"]    = $this->Mhome->getcarapasien_masuktoday();
    $data["q3"]	  = $this->Mhome->getpasien_prosedurtoday();
    $data["breadcrumb"]   = "<li class='active'><strong>Kontrole</strong></li>";
    $this->load->view('home/vcetakkontrole',$data);
  }
  function cekpassword(){
    $q = $this->db->get_where("perawat",["password"=>md5($this->input->post("password")),"kontrole"=>1]);
    if ($q->num_rows()>0) {
      $row = $q->row();
      echo $row->id_perawat;
    } else echo "";
  }
  function rekap_pasienranap(){
    $data = array();
    $this->db->select("p2.id_gol,r.kode_ruangan_a,count(*) as jumlah,gp.jenis as jenis,gp.pensiunan");
    $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
    $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
    $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
    $this->db->where("isnull(tgl_keluar)",1);
    $this->db->group_by("p2.id_gol,r.kode_ruangan_a");
    $p = $this->db->get("pasien_inap p2");
    foreach ($p->result() as $key) {
      if ($key->jenis=="DINAS"){
        if (isset($data["DINAS"][$key->kode_ruangan_a]))
        $data["DINAS"][$key->kode_ruangan_a] += $key->jumlah;
        else
        $data["DINAS"][$key->kode_ruangan_a] =  $key->jumlah;
        if ($key->pensiunan){
          if (isset($data["DINAS_PUR"][$key->kode_ruangan_a]))
          $data["DINAS_PUR"][$key->kode_ruangan_a] += $key->jumlah;
          else
          $data["DINAS_PUR"][$key->kode_ruangan_a] =  $key->jumlah;
        } else {
          if (isset($data["DINAS_A"][$key->kode_ruangan_a]))
          $data["DINAS_A"][$key->kode_ruangan_a] += $key->jumlah;
          else
          $data["DINAS_A"][$key->kode_ruangan_a] =  $key->jumlah;
        }
      } else
      if ($key->jenis=="UMUM"){
        if (isset($data["UMUM"][$key->kode_ruangan_a]))
        $data["UMUM"][$key->kode_ruangan_a] +=  $key->jumlah;
        else
        $data["UMUM"][$key->kode_ruangan_a] =  $key->jumlah;
      } else
      if ($key->jenis=="BPJS"){
        if (isset($data["BPJS"][$key->kode_ruangan_a]))
        $data["BPJS"][$key->kode_ruangan_a] +=  $key->jumlah;
        else
        $data["BPJS"][$key->kode_ruangan_a] =  $key->jumlah;
      } else
      if ($key->jenis=="PERUSAHAAN"){
        if (isset($data["PRSH"][$key->kode_ruangan_a]))
        $data["PRSH"][$key->kode_ruangan_a] +=  $key->jumlah;
        else
        $data["PRSH"][$key->kode_ruangan_a] =  $key->jumlah;
      }
    }
    $now = date("Y-m-d");
    $this->db->select("r.kode_ruangan_a,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
    $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
    $this->db->where("isnull(tgl_keluar)",1);
    $p = $this->db->get("pasien_inap p2");
    foreach ($p->result() as $key) {
      if (isset($data["HP"][$key->kode_ruangan_a]))
      $data["HP"][$key->kode_ruangan_a] += $key->hp;
      else
      $data["HP"][$key->kode_ruangan_a] =  $key->hp;
    }
    $list = array();
    $this->db->select("r.kode_ruangan_a,k.kode_ruangan,r.nama_ruangan,kl.nama_kelas,k.kode_kelas,count(*) as bed");
    $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
    $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
    $this->db->group_by("r.kode_ruangan_a");
    $this->db->order_by("k.kode_ruangan,r.nama_ruangan");
    $r = $this->db->get("kamar k");
    foreach ($r->result() as $row) {
      $n = $this->db->get_where("rekap_pasienranap",["tanggal"=>date("Y-m-d"),"kode_ruangan"=>$row->kode_ruangan_a]);
      $dinas = (isset($data["DINAS"][$row->kode_ruangan_a]) ? $data["DINAS"][$row->kode_ruangan_a] : 0);
      $umum = (isset($data["UMUM"][$row->kode_ruangan_a]) ? $data["UMUM"][$row->kode_ruangan_a] : 0);
      $bpjs = (isset($data["BPJS"][$row->kode_ruangan_a]) ? $data["BPJS"][$row->kode_ruangan_a] : 0);
      $prsh = (isset($data["PRSH"][$row->kode_ruangan_a]) ? $data["PRSH"][$row->kode_ruangan_a] : 0);
      $bed = $row->bed;
      $list = array(
        "tanggal" => date("Y-m-d"),
        "kode_ruangan" => $row->kode_ruangan_a,
        "tt" => $row->bed,
        "dinas_a" => (isset($data["DINAS_A"][$row->kode_ruangan_a]) ? $data["DINAS_A"][$row->kode_ruangan_a] : 0),
        "dinas_pur" => (isset($data["DINAS_PUR"][$row->kode_ruangan_a]) ? $data["DINAS_PUR"][$row->kode_ruangan_a] : 0),
        "umum" => (isset($data["UMUM"][$row->kode_ruangan_a]) ? $data["UMUM"][$row->kode_ruangan_a] : 0),
        "bpjs" => (isset($data["BPJS"][$row->kode_ruangan_a]) ? $data["BPJS"][$row->kode_ruangan_a] : 0),
        "prsh" => (isset($data["PRSH"][$row->kode_ruangan_a]) ? $data["PRSH"][$row->kode_ruangan_a] : 0),
        "hari_perawatan" =>(isset($data["HP"][$row->kode_ruangan_a]) ? $data["HP"][$row->kode_ruangan_a] : 0),
        "bor" => ($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_pasienranap",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d"));
        $this->db->where("kode_ruangan",$row->kode_ruangan_a);
        $this->db->update("rekap_pasienranap",$list);
      }
    }
  }
  //view blum dibuat
  // function excelrekap_full2($tindakan,$tgl1="",$tgl2=""){
  //   $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
  //   $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
  //   $data["tgl1"] = $tgl1;
  //   $data["tgl2"] = $tgl2;
  //   $data["tindakan"] = $tindakan;
  //   $data["t"] = $this->Mgizi->gettindakan_cetak($tindakan);
  //   $data["t2"] = $this->Mgizi->gettindakan_cetak2($tindakan);
  //   $data["p"] = $this->Mgizi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
  //   $data["p_inap"] = $this->Mgizi->rekap_inap_full($tindakan,$tgl1,$tgl2);
  //   $this->load->view('gizi/vpaexcelrekap_full2',$data);
  // }
}
?>
