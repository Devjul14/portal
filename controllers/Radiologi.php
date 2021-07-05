<?php
class Radiologi extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->Model('Mradiologi');
    $this->load->Model('Mpendaftaran');
    $this->load->Model('Mkasir');
    $this->load->Model('Mgrouper');
    $this->load->Model('Mlab');
    if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
    {
      $this->session->sess_destroy();
      redirect('login','refresh');
    }
  }
  function ralan($current=0,$from=0){
    $data["title"] 				= "Radiologi Rawat Jalan";
    $data['judul'] 				= "Radiologi Rawat Jalan";
    $data["vmenu"] 				= $this->session->userdata("controller")."/vmenu";
    $data["content"] 			= "radiologi/vlistradiologi_ralan";
    $data["username"] 			= $this->session->userdata('nama_user');
    $data['menu']				= "radiologi";
    $data["current"] 			= $current;
    $data["title_header"] 		= "Radiologi Rawat Jalan ";
    $data["total_rows"] 		= $this->Mradiologi->getradiologi_ralan();
    $data["jlayan"]             = $this->Mradiologi->gettotalpasien("LAYAN");
    $data["jbatal"]             = $this->Mradiologi->gettotalpasien("BATAL");
    $data["breadcrumb"] 		= "<li class='active'><strong>Pasien Rawat Jalan</strong></li>";
    $this->load->library('pagination');
    $config['base_url'] 		= base_url().'radiologi/ralan/'.$current;
    $config['total_rows'] 		= $this->Mradiologi->getradiologi_ralan();
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
    $data["q3"] 				= $this->Mradiologi->getpasien_ralan_radiologi($config['per_page'],$from);
    $data["q"]                  = $this->Mradiologi->pilihdokterradiologi();
    $this->load->view('template',$data);
  }
  function getpasien_ralan_radiologi2(){
    $q = $this->Mradiologi->getpasien_ralan_radiologi2();
    echo json_encode($q);
  }
  function cari_radiologiralan(){

    $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
    $this->session->set_userdata('dokter',$this->input->post("dokter"));
    $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
    $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
    $this->session->set_userdata("nama",$this->input->post("cari_nama"));
    $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
    $this->session->set_userdata("status_pasien",$this->input->post("status_pasien"));
  }
  function resetpencarian(){
    $this->session->unset_userdata('kode_dokter');
    $this->session->unset_userdata('dokter');
    $this->session->unset_userdata('tgl1');
    $this->session->unset_userdata('tgl2');
    $this->session->unset_userdata('no_pasien');
    $this->session->unset_userdata('no_rm');
    $this->session->unset_userdata('no_reg');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('kode_ruangan');
    $this->session->unset_userdata('ruangan');
    $this->session->unset_userdata('kode_kelas');
    $this->session->unset_userdata('kelas');
    $this->session->unset_userdata("detail1");
    $this->session->unset_userdata("ekspertisi1");
    $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
  }
  function reset_radiologiralan(){
    $this->session->unset_userdata('kode_dokter');
    $this->session->unset_userdata('dokter');
    $this->session->unset_userdata('tgl1');
    $this->session->unset_userdata('tgl2');
    $this->session->unset_userdata('no_pasien');
    $this->session->unset_userdata('no_rm');
    $this->session->unset_userdata('no_reg');
    $this->session->unset_userdata('nama');
    redirect("radiologi/ralan");
  }
  function cari_radiologiinap(){
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
    $this->session->set_userdata("detail1",$this->input->post("detail1"));
    $this->session->set_userdata("ekspertisi1",$this->input->post("ekspertisi1"));
  }
  function reset_radiologiinap(){
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
    $this->session->unset_userdata("detail1");
    $this->session->unset_userdata("ekspertisi1");
    redirect("radiologi/inap");
  }
  function detailradiologi_ralan($no_pasien,$no_reg){
    $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
    $data['menu']           = "radiologi";
    $data["no_pasien"]      = $no_pasien;
    $data["no_reg"]         = $no_reg;
    $data["title"]          = "Detail Radiologi Rawat Jalan || RS CIREMAI";
    $data["title_header"]   = "Detail Radiologi Rawat Jalan";
    $data["content"]        = "radiologi/vformradiologi_ralan";
    $data["breadcrumb"]     = "<li class='active'><strong>Detail Radiologi Rawat Jalan</strong></li>";
    $data["row"]            = $this->Mradiologi->getralan_detail($no_pasien,$no_reg);
    $data["k"]              = $this->Mradiologi->getkasir($no_reg);
    $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
    $data["t"]              = $this->Mradiologi->gettarif_radiologi();
    $data["d"]              = $this->Mradiologi->getdokter_radiologi();
    $data["d1"]             = $this->Mradiologi->getdokter();
    $data["r"]              = $this->Mradiologi->getradiografer();
    $data["dokter"]         = $this->Mradiologi->getdokter_array();
    $data["radiografer"]    = $this->Mradiologi->getradiografer_array();
    $data["dokter_pengirim"]= $this->Mradiologi->getdokterpengirim_array();
    $this->load->view('template',$data);
  }
  function addtindakan(){
    $this->Mradiologi->addtindakan();
    $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
  }
  function addtindakan_inap(){
    $this->Mradiologi->addtindakan_inap();
    $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
  }
  function batal($no_pasien,$no_reg){
    $message = $this->Mpendaftaran->batal($no_pasien,$no_reg,"radiologi");
    $this->session->set_flashdata("message",$message);
  }
  function hapustindakan_inap(){
    $this->Mradiologi->hapustindakan_inap();
    $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
  }
  function ekspertisi($no_pasien,$no_reg,$id_tindakan=""){
    $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
    $data['menu']           = "radiologi";
    $data["no_pasien"]      = $no_pasien;
    $data["no_reg"]         = $no_reg;
    $data["id_tindakan"]    = $id_tindakan;
    $data["title"]          = "Ekspertisi || RS CIREMAI";
    $data["title_header"]   = "Ekspertisi";
    $data["content"]        = "radiologi/vformekspertisi";
    $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi</strong></li>";
    $data["row"]            = $this->Mradiologi->getralan_detail($no_pasien,$no_reg);
    $data["q"]              = $this->Mradiologi->getekspertisi_detail($no_pasien,$no_reg,$id_tindakan);
    $data["d"]              = $this->Mradiologi->getdokter_radiologi();
    $data["d1"]             = $this->Mradiologi->getdokter();
    $data["r"]              = $this->Mradiologi->getradiografer();
    $data["k2"]             = $this->Mradiologi->getkasir_detail($no_reg,$id_tindakan);
    $data["k"]              = $this->Mradiologi->getkasir($no_reg);
    $this->load->view('template',$data);
  }
  function cekkasir_detail(){
    $q = $this->Mradiologi->cekkasir_detail();
    echo $q->num_rows();
  }
  function ambildatanormal($dokter){
    $data["q"]              = $this->Mradiologi->ambildatanormal($dokter);
    $data["title"]          = "Data Normal || RS CIREMAI";
    $data["title_header"]   = "Data Normal";
    $this->load->view('radiologi/vpilih_datanormal',$data);
  }
  function simpanekspertisi($action){
    $no_pasien = $this->input->post("no_pasien");
    $no_reg = $this->input->post("no_reg");
    $tindakan = $this->input->post("tindakan");
    $message = $this->Mradiologi->simpanekspertisi($action);
    $this->session->set_flashdata("message",$message);
    redirect("radiologi/ekspertisi/".$no_pasien."/".$no_reg."/".$tindakan);
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
    $data["q"]          = $this->Mradiologi->getcetak($no_reg,$no_pasien);
    $data["k"]          = $this->Mradiologi->getcetak_kasir($no_reg,$kode_tindakan);
    $data["e"]          = $this->Mradiologi->getekspertisi_detail($no_pasien,$no_reg,$kode_tindakan);
    $this->load->view('radiologi/vcetakradiologi',$data);
  }
  function inap($current=0,$from=0){
    $data["title"]              = "Radiologi Rawat Inap";
    $data['judul']              = "Radiologi Rawat Inap";
    $data["vmenu"]              = $this->session->userdata("controller")."/vmenu";
    $data["content"]            = "radiologi/vlistradiologi_inap";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "radiologi";
    $data["current"]            = $current;
    $data["title_header"]       = "Radiologi Rawat Inap ";
    $data["total_rows"]         = $this->Mradiologi->getradiologi_inap();
    $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";
    $this->load->library('pagination');
    $config['base_url']         = base_url().'radiologi/inap/'.$current;
    $config['total_rows']       = $this->Mradiologi->getradiologi_inap();
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
    $data["q3"]                 = $this->Mradiologi->getpasien_inap_radiologi($config['per_page'],$from);
    $data["q"]                  = $this->Mradiologi->pilihdokterradiologi();
    $data["d"]             = $this->Mradiologi->getdokter_radiologi();
    $this->load->view('template',$data);
  }
  function getpasien_inap_radiologi1(){
    $q = $this->Mradiologi->getpasien_inap_radiologi1();
    echo json_encode($q);
  }
  function detailradiologi_inap($no_pasien,$no_reg,$tanggal=""){
    $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
    $data['menu']           = "radiologi";
    // if ($tanggal=="") {
    // 	$tanggal = date("d-m-Y");
    // }

    $data["no_pasien"]      = $no_pasien;
    $data["no_reg"]         = $no_reg;
    $data["tanggal"]	    = $tanggal;
    $data["title"]          = "Detail Radiologi Rawat Inap || RS CIREMAI";
    $data["title_header"]   = "Detail Radiologi Rawat Inap";
    $data["content"]        = "radiologi/vformradiologi_inap";
    $data["breadcrumb"]     = "<li class='active'><strong>Detail Radiologi Rawat Inap</strong></li>";
    $data["row"]            = $this->Mradiologi->getinap_detail($no_pasien,$no_reg);
    $data["k"]              = $this->Mradiologi->getkasir_inap($no_reg,$tanggal);
    $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
    $data["t"]              = $this->Mradiologi->gettarif_radiologi();
    $data["d"]              = $this->Mradiologi->getdokter_radiologi();
    $data["d1"]             = $this->Mradiologi->getdokter();
    $data["r"]              = $this->Mradiologi->getradiografer();
    $data["dokter"]         = $this->Mradiologi->getdokter_array();
    $data["h"]         = $this->Mradiologi->getekspertisiradinap_detail_array($no_reg,$tanggal);
    $data["dokter_pengirim"]         = $this->Mradiologi->getdokterpengirim_array();
    $data["radiografer"]    = $this->Mradiologi->getradiografer_array();
    $data["diagnosa"]    = $this->Mradiologi->getdiagnosa($no_reg);
    $this->load->view('template',$data);
  }
  function ekspertisi_inap($no_pasien,$no_reg,$id_tindakan="",$tgl="",$pemeriksaan=""){
    $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
    $data['menu']           = "radiologi";
    $data["no_pasien"]      = $no_pasien;
    $data["no_reg"]         = $no_reg;
    $data["id_tindakan"]    = $id_tindakan;
    $data["pemeriksaan"]    = $pemeriksaan;
    $data["title"]          = "Ekspertisi || RS CIREMAI";
    $data["title_header"]   = "Ekspertisi";
    $data["tgl"]            = $tgl;
    $data["content"]        = "radiologi/vformekspertisi_inap";
    $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi</strong></li>";
    $data["row"]            = $this->Mradiologi->getinap_detail($no_pasien,$no_reg);
    $data["q"]              = $this->Mradiologi->getekspertisiinap_detail($no_pasien,$no_reg,$id_tindakan,$tgl,$pemeriksaan);
    $data["d"]              = $this->Mradiologi->getdokter_radiologi();
    $data["d1"]             = $this->Mradiologi->getdokter();
    $data["r"]              = $this->Mradiologi->getradiografer();
    $data["k"]              = $this->Mradiologi->getkasir_inap($no_reg,"");
    $this->load->view('template',$data);
  }
  function cekkasirinap_detail(){
    $q = $this->Mradiologi->cekkasirinap_detail();
    echo $q->num_rows();
  }
  function getkasir_inap_detail($no_reg,$id_tindakan="",$tgl="",$pemeriksaan=""){
    $q = $this->Mradiologi->getkasir_inap_detail($no_reg,$id_tindakan,$tgl,$pemeriksaan);
    echo json_encode($q);
  }
  function simpanekspertisi_inap($action){
    $no_pasien = $this->input->post("no_rm");
    $no_reg = $this->input->post("no_reg");
    $tindakan = explode("/",$this->input->post("tindakan"));
    $message = $this->Mradiologi->simpanekspertisi_inap($action);
    $this->session->set_flashdata("message",$message);
    redirect("radiologi/ekspertisi_inap/".$no_pasien."/".$no_reg."/".$tindakan[0]."/".$tindakan[3]."/".$tindakan[4]);
  }
  function simpandetail_inap($action){
    $no_pasien = $this->input->post("no_rm");
    $no_reg = $this->input->post("no_reg");
    $tindakan = $this->input->post("tindakan");
    $message = $this->Mradiologi->simpanekspertisi_inap($action);
    $this->session->set_flashdata("message",$message);
    redirect("radiologi/detailradiologi_inap/".$no_pasien."/".$no_reg."/".$tindakan);
  }
  function cetak_inap($no_reg, $no_pasien,$id_tindakan,$tgl,$pemeriksaan){
    $data["no_reg"] = $no_reg;
    $data["no_pasien"] = $no_pasien;
    $data["k"]          = $this->Mradiologi->getcetak_kasir_inap($no_reg,$id_tindakan,$tgl,$pemeriksaan);
    $data["q"]          = $this->Mradiologi->getcetak_inap($no_reg,$no_pasien,$id_tindakan,$tgl);
    $data["tg"]          = $this->Mradiologi->gettanggal($no_reg,$no_pasien,$id_tindakan,$tgl,$pemeriksaan);
    $this->load->view('radiologi/vcetakradiologi_inap',$data);
  }
  function changedata_ralan($jenis){
    $this->Mradiologi->changedata_ralan($jenis);
  }
  function changedata($jenis){
    $this->Mradiologi->changedata($jenis);
  }
  function hapusinap(){
    $this->Mradiologi->hapusinap();
  }
  function hapusralan(){
    $this->Mradiologi->hapusralan();
  }
  function getradiografer(){
    echo json_encode($this->Mradiologi->getradiografer()->result());
  }
  function getdokter_radiologi(){
    echo json_encode($this->Mradiologi->getdokter_radiologi()->result());
  }
  function getdokter(){
    echo json_encode($this->Mradiologi->getdokter()->result());
  }
  function getukuranfoto(){
    echo json_encode($this->Mradiologi->getukuranfoto()->result());
  }
  function terima($no_rm,$no_reg){
    $message = $this->Mradiologi->terima($no_rm,$no_reg);
    $this->session->set_flashdata("message",$message);
    redirect("radiologi/ralan");
  }
  function periksa($no_rm,$no_reg){
    $message = $this->Mradiologi->periksa($no_rm,$no_reg);
    $this->session->set_flashdata("message",$message);
    redirect("radiologi/ralan");
  }
  function respond($no_rm, $no_reg){
    $data["q"]          = $this->Mradiologi->getrespond($no_rm,$no_reg);
    $this->load->view('radiologi/vrespond_time',$data);
    // $data["no_reg"] = $no_reg;
    // $data["diet"]    = $this->Mgizi->getdiet_array();
    // $data["menu"]    = $this->Mgizi->getmenu_array();
  }
  function terima_inap($no_rm,$no_reg){
    $message = $this->Mradiologi->terima_inap($no_rm,$no_reg);
    $this->session->set_flashdata("message",$message);
    redirect("radiologi/inap");
  }
  function periksa_inap($no_rm,$no_reg){
    $message = $this->Mradiologi->periksa_inap($no_rm,$no_reg);
    $this->session->set_flashdata("message",$message);
    redirect("radiologi/inap");
  }
  function respond_inap($no_rm, $no_reg){
    $data["q"]          = $this->Mradiologi->getrespond_inap($no_rm,$no_reg);
    $this->load->view('radiologi/vrespond_timeinap',$data);
    // $data["no_reg"] = $no_reg;
    // $data["diet"]    = $this->Mgizi->getdiet_array();
    // $data["menu"]    = $this->Mgizi->getmenu_array();
  }
  function formuploadpdf_inap($no_pasien,$no_reg){
    $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
    $data['menu']           = "radiologi";
    $data["no_pasien"]      = $no_pasien;
    $data["no_reg"]         = $no_reg;
    $data["title"]          = "Upload PDF Rawat Inap || RS CIREMAI";
    $data["title_header"]   = "Upload PDF Rawat Inap";
    $data["content"]        = "radiologi/vformuploadpdf_inap";
    $data["q"]              = $this->Mgrouper->getfilepdf_inap($no_reg);
    $data["breadcrumb"]     = "<li class='active'><strong>Upload PDF Rawat Inap</strong></li>";
    $data["j"]              = $this->Mlab->getjenisfile();
    $this->load->view('template',$data);
  }
  function uploadpdf_inap(){
    for ($i=0;$i<=100;$i++){
      $n = $i;

      $this->db->select("count(*) as total");
      $this->db->where("no_reg",$this->input->post("no_reg"));

      $q = $this->db->get("pdf_inap")->row();
      if ($q->total==$n){
        $a = $n;
      }
      else{
        $a = 1;
      }
    }
    $config['upload_path']          = './file_pdf/inap/';
    $config['allowed_types']        = 'pdf|jpg|png';
    $config['file_name']            = "Inap-".$this->input->post("no_reg")."-".$this->input->post("jenisfile")."-".$a;

    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('pdf_inap'))
    {
      $message = "danger-Gagal diupload";
      $this->session->set_flashdata("message",$message);
      redirect("radiologi/formuploadpdf_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    else
    {
      $data = array(
        'upload_data' => $this->upload->data('file_name'),
      );
      $nama_file =  $data['upload_data'];
      $message = $this->Mgrouper->uploadpdf_inap($nama_file);
      $this->session->set_flashdata("message",$message);
      redirect("radiologi/formuploadpdf_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
  }
  function formuploadpdf_ralan($no_pasien,$no_reg){
    $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
    $data['menu']           = "radiologi";
    $data["no_pasien"]      = $no_pasien;
    $data["no_reg"]         = $no_reg;
    $data["title"]          = "Upload PDF Rawat Jalan || RS CIREMAI";
    $data["title_header"]   = "Upload PDF Rawat Jalan";
    $data["content"]        = "radiologi/vformuploadpdf_ralan";
    $data["q"]              = $this->Mgrouper->getfilepdf_ralan($no_reg);
    $data["q1"]              = $this->Mgrouper->getfilepdf_noregsebelumnya_ralan($no_reg);
    $data["breadcrumb"]     = "<li class='active'><strong>Upload PDF Rawat Jalan</strong></li>";
    $data["j"]              = $this->Mlab->getjenisfile();
    $this->load->view('template',$data);
  }
  function uploadpdf_ralan(){
    for ($i=0;$i<=100;$i++){
      $n = $i;

      $this->db->select("count(*) as total");
      $this->db->where("no_reg",$this->input->post("no_reg"));

      $q = $this->db->get("pdf_ralan")->row();
      if ($q->total==$n){
        $a = $n;
      }
      else{
        $a = 1;
      }
    }
    $config['upload_path']          = './file_pdf/ralan/';
    $config['allowed_types']        = 'pdf|jpg|png';
    $config['file_name']            = "Ralan-".$this->input->post("no_reg")."-".$this->input->post("jenisfile")."-".$a;

    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload('pdf_ralan'))
    {
      $message = "danger-Gagal diupload";
      $this->session->set_flashdata("message",$message);
      redirect("radiologi/formuploadpdf_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    else
    {
      $data = array(
        'upload_data' => $this->upload->data('file_name'),
      );
      $nama_file =  $data['upload_data'];
      $message = $this->Mgrouper->uploadpdf_ralan($nama_file);
      $this->session->set_flashdata("message",$message);
      redirect("radiologi/formuploadpdf_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
  }
  function rekap_full($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Rekap Radiologi || RS CIREMAI";
    $data["title_header"] = "Rekap Radiologi ";
    $data["content"] = "radiologi/vrekap_full";
    $data["t"] = $this->Mradiologi->gettindakan();
    $data["p"] = $this->Mradiologi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $data["p_inap"] = $this->Mradiologi->rekap_inap_full($tindakan,$tgl1,$tgl2);
    $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
    $this->load->view('template',$data);
  }
  function rekap_ralan($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Rekap Radiologi Ralan || RS CIREMAI";
    $data["title_header"] = "Rekap Radiologi Ralan";
    $data["content"] = "radiologi/vrekap_ralan";
    $data["t"] = $this->Mradiologi->gettindakan();
    $data["p"] = $this->Mradiologi->rekap_ralan($tindakan,$tgl1,$tgl2);
    $data["breadcrumb"]   = "<li class='active'><strong>Rekap Ralan</strong></li>";
    $this->load->view('template',$data);
  }
  function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
    echo json_encode($this->Mradiologi->getpasien_rekap_full($tindakan,$tgl1,$tgl2));
  }
  function getpasien_rekap($tindakan,$tgl1,$tgl2){
    echo json_encode($this->Mradiologi->getpasien_rekap($tindakan,$tgl1,$tgl2));
  }
  function cetakrekap_full($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["title"]        = "Cetak Rekap Radiologi Ralan || RS CIREMAI";
    $data["title_header"] = "Cetak Rekap Radiologi Ralan";
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $data["p_inap"] = $this->Mradiologi->rekap_inap_full($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vcetakrekap_full',$data);
  }
  function cetakrekap_full2($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["title"]        = "Cetak Rekap Radiologi Ralan || RS CIREMAI";
    $data["title_header"] = "Cetak Rekap Radiologi Ralan";
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $data["p_inap"] = $this->Mradiologi->rekap_inap_full($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vcetakrekap_full2',$data);
  }
  function excelrekap_full($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $data["p_inap"] = $this->Mradiologi->rekap_inap_full($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vexcelrekap_full',$data);
  }
  function excelrekap_full2($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_ralan_full($tindakan,$tgl1,$tgl2);
    $data["p_inap"] = $this->Mradiologi->rekap_inap_full($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vexcelrekap_full2',$data);
  }
  function cetakrekap_ralan($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["title"]        = "Cetak Rekap Radiologi Ralan || RS CIREMAI";
    $data["title_header"] = "Cetak Rekap Radiologi Ralan";
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_ralan($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vcetakrekap_ralan',$data);
  }
  function excelrekap_ralan($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_ralan($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vexcelrekap_ralan',$data);
  }
  function rekap_inap($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
    $data['menu']="home";
    $data["title"]        = "Rekap Radiologi Inap || RS CIREMAI";
    $data["title_header"] = "Rekap Radiologi Inap";
    $data["content"] = "radiologi/vrekap_inap";
    $data["t"] = $this->Mradiologi->gettindakan();
    $data["p"] = $this->Mradiologi->rekap_inap($tindakan,$tgl1,$tgl2);
    $data["breadcrumb"]   = "<li class='active'><strong>Rekap Inap</strong></li>";
    $this->load->view('template',$data);
  }
  function cetakrekap_inap($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["title"]        = "Cetak Rekap Radiologi Ralan || RS CIREMAI";
    $data["title_header"] = "Cetak Rekap Radiologi Ralan";
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_inap($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vcetakrekap_inap',$data);
  }
  function excelrekap_inap($tindakan,$tgl1="",$tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["tindakan"] = $tindakan;
    $data["t"] = $this->Mradiologi->gettindakan_cetak($tindakan);
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["p"] = $this->Mradiologi->rekap_inap($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vexcelrekap_inap',$data);
  }
  function getpasien_rekap_inap($tindakan,$tgl1,$tgl2){
    echo json_encode($this->Mradiologi->getpasien_rekap_inap($tindakan,$tgl1,$tgl2));
  }

  function cetakpasien_ralan($tindakan, $tgl1="", $tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["tindakan"] = $tindakan;
    $data["q"]      = $this->Mradiologi->getpasien_rekap($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vcetakpasien_ralan',$data);
  }
  function cetakpasien_full($tindakan, $tgl1="", $tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["tindakan"] = $tindakan;
    $data["q"]      = $this->Mradiologi->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vcetakpasien_full',$data);
  }
  function cetakpasien_inap($tindakan, $tgl1="", $tgl2=""){
    $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["t2"] = $this->Mradiologi->gettindakan_cetak2($tindakan);
    $data["tindakan"] = $tindakan;
    $data["q"]          = $this->Mradiologi->getpasien_rekap_inap($tindakan,$tgl1,$tgl2);
    $this->load->view('radiologi/vcetakpasien_inap',$data);
  }
  function cekusername(){
    $q = $this->db->get_where("radiografer",["username"=>$this->input->post("username"),"password"=>md5($this->input->post("password"))]);
    if ($q->num_rows()>0){
      echo "true";
    } else
    echo "false";
  }
}
?>
