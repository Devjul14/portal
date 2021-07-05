<?php

class Admindkk extends CI_Controller{

    function __construct(){

        parent::__construct();

        $this->load->Model('Madmindkk');

        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))

        {

               redirect("login/logout","refresh");

        }

	}

    function index(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="setup";
	    $data['vmenu']="admindkk/vmenu";
	    $data["content"]="admindkk/vsetuprs";
	    $data["q"] = $this->Madmindkk->getsetuprs();
	    $data["title_header"] = "Setup Rumah Sakit";
	    $data["breadcrumb"] = "<li class='active'><strong>Setup Rumah Sakit</strong></li>";
        $this->load->view('template',$data);
    }
    function galeri(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="galeri";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/vgaleri";
        $data["q"] = $this->Madmindkk->getgaleri();
        $data["title_header"] = "Galeri";
        $data["breadcrumb"] = "<li class='active'><strong>Galeri</strong></li>";
        $this->load->view('template',$data);
    }
      function home(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="home";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="vhome";
        $data["title_header"] = "Home";
        $data["breadcrumb"] = "<li class='active'><strong>Home</strong></li>";
        $this->load->view('template',$data);
    }
        function simpansetup($action)
    {
		$config['upload_path']          = './assets/foto/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG';
        $config['max_size']             = 10000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['overwrite']  			= TRUE;
        $config['file_name']            = "Logo";
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('foto'))
        {
            $message = $this->Madmindkk->simpans($action);
            // $message = "error";
        }
        else
        {
            $data = array(
            				'upload_data' => $this->upload->data('file_name')
            			);
            $nama_file =  $data['upload_data'];
            $message = $this->Madmindkk->simpansetuprs($action,$nama_file);
         }
        $this->session->set_flashdata("message",$message);
        redirect("admindkk");
    }
	function resetstup($kode)
	{
        $message = $this->Madmindkk->resetsetuprs($kode);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk");
    }

    function golpasien(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/golpasien/vgol_pasien";
        $data["q"] = $this->Madmindkk->getgolpasien();
        $data["title_header"] = "Golongan Pasien";
        $data["breadcrumb"] = "<li class='active'><strong>Golongan Pasien</strong></li>";
        $this->load->view('template',$data);
    }
    function formgolpasien($id=""){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/golpasien/vform_golpasien";
        $data["title_header"] = "Gol Pasien";
        $data["id_gol"]     = $id;
        $data["q"] = $this->Madmindkk->getgolpasiendetail($id);
        $data["breadcrumb"] = "<li class='active'><strong>Form Gol Pasien</strong></li>";
        $this->load->view('template',$data);
    }

    function pangkat(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/pangkat/vpangkat";
        $data["q"] = $this->Madmindkk->getpangkat();
        $data["title_header"] = "Pangkat";
        $data["breadcrumb"] = "<li class='active'><strong>Pangkat</strong></li>";
        $this->load->view('template',$data);
    }
    function formpangkat($id=""){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/pangkat/vformpangkat";
        $data["title_header"] = "Form Pangkat";
        $data["id_pangkat"] = $id;
        $data["q"] = $this->Madmindkk->getpangkatdetail($id);
        $data["q1"] = $this->Madmindkk->getgolpasien();
        $data["breadcrumb"] = "<li class='active'><strong>Form Pangkat</strong></li>";
        $this->load->view('template',$data);
    }

   function kesatuan(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/kesatuan/vkesatuan";
        $data["q"] = $this->Madmindkk->getkesatuan();
        $data["title_header"] = "Kesatuan";
        $data["breadcrumb"] = "<li class='active'><strong>Kesatuan</strong></li>";
        $this->load->view('template',$data);
    }
    function formkesatuan($id=""){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/kesatuan/vformkesatuan";
        $data["title_header"] = "Form Kesatuan";
        $data["id_kesatuan"] = $id;
        $data["q"] = $this->Madmindkk->getkesatuandetail($id);
        $data["breadcrumb"] = "<li class='active'><strong>Form Kesatuan</strong></li>";
        $this->load->view('template',$data);
    }

    function cabang(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/cabang/vcabang";
        $data["q"] = $this->Madmindkk->getcabang();
        $data["title_header"] = "Cabang";
        $data["breadcrumb"] = "<li class='active'><strong>Cabang</strong></li>";
        $this->load->view('template',$data);
    }
    function formcabang($id=""){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/cabang/vformcabang";
        $data["title_header"] = "Form Cabang";
        $data["id_cabang"] = $id;
        $data["q"] = $this->Madmindkk->getcabangdetail($id);
        $data["breadcrumb"] = "<li class='active'><strong>Form Cabang</strong></li>";
        $this->load->view('template',$data);
    }

   function ketcabang(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/cabang/vketcabang";
        $data["q"] = $this->Madmindkk->getketcabang();
        $data["title_header"] = "Ket Cabang";
        $data["breadcrumb"] = "<li class='active'><strong>Ket Cabang</strong></li>";
        $this->load->view('template',$data);
    }
    function formketcabang($id=""){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/cabang/vformketcabang";
        $data["title_header"] = "Form Ket Cabang";
        $data["id_ketcabang"] = $id;
        $data["q"] = $this->Madmindkk->getketcabangdetail($id);
        $data["q1"] = $this->Madmindkk->getcabang();
        $data["breadcrumb"] = "<li class='active'><strong>Form Ket Cabang</strong></li>";
        $this->load->view('template',$data);
    }


    function simpangolpasien($action)
    {
        $message = $this->Madmindkk->simpangolpasien($action);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/golpasien");
    }

    function hapusgolpasien($id)
    {
        $message = $this->Madmindkk->hapusgolpasien($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/golpasien");
    }

      function simpanpangkat($action)
    {
        $message = $this->Madmindkk->simpanpangkat($action);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/pangkat");
    }

    function hapuspangkat($id)
    {
        $message = $this->Madmindkk->hapuspangkat($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/pangkat");
    }
      function simpankesatuan($action)
    {
        $message = $this->Madmindkk->simpankesatuan($action);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/kesatuan");
    }

    function hapuskesatuan($id)
    {
        $message = $this->Madmindkk->hapuskesatuan($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/kesatuan");
    }

      function simpancabang($action)
    {
        $message = $this->Madmindkk->simpancabang($action);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/cabang");
    }

    function hapuscabang($id)
    {
        $message = $this->Madmindkk->hapuscabang($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/cabang");
    }

      function simpanketcabang($action)
    {
        $message = $this->Madmindkk->simpanketcabang($action);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/ketcabang");
    }

    function hapusketcabang($id)
    {
        $message = $this->Madmindkk->hapusketcabang($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/ketcabang");
    }
    function getfoto(){
        $this->db->select("foto_karumkit");
        $d = $this->db->get("setup_rs");
        echo $d->row()->foto_karumkit;
    }
    function getttd(){
        $this->db->select("ttd_k");
        $d = $this->db->get("setup_rs");
        echo $d->row()->ttd_k;
    }
    function getttd_klaim(){
        $this->db->select("ttd_petugas_klaim");
        $d = $this->db->get("setup_rs");
        echo $d->row()->ttd_petugas_klaim;
    }
    function simpangaleri(){
        $message = $this->Madmindkk->simpangaleri();
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/galeri");
    }
    function hapusfoto($id)
    {
        $message = $this->Madmindkk->hapusfoto($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/galeri");
    }
    function soap(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/soap/vsoap";
        $data["q"] = $this->Madmindkk->getsoap();
        $data["title_header"] = "SOAP";
        $data["breadcrumb"] = "<li class='active'><strong>SOAP</strong></li>";
        $this->load->view('template',$data);
    }
    function formsoap($id=""){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/soap/vformsoap";
        $data["title_header"] = "Form SOAP";
        $data["id"] = $id;
        $data["q"] = $this->Madmindkk->getsoapdetail($id);
        $data["breadcrumb"] = "<li class='active'><strong>Form SOAP</strong></li>";
        $this->load->view('template',$data);
    }
    function simpansoap($action){
        $message = $this->Madmindkk->simpansoap($action);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/soap");
    }
    function hapussoap($id){
        $message = $this->Madmindkk->hapussoap($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/soap");
    }
    function ujifungsi(){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/ujifungsi/vujifungsi";
        $data["q"] = $this->Madmindkk->getujifungsi();
        $data["icd"] = $this->Madmindkk->icd10();
        $data["icd9"] = $this->Madmindkk->icd9();
        $data["title_header"] = "Uji Fungsi";
        $data["breadcrumb"] = "<li class='active'><strong>Uji Fungsi</strong></li>";
        $this->load->view('template',$data);
    }
    function formujifungsi($id=""){
        $data["title"] = "ADMINISTRATOR";
        $data["username"] = $this->session->userdata('username');
        $data['menu']="master";
        $data['vmenu']="admindkk/vmenu";
        $data["content"]="admindkk/ujifungsi/vformujifungsi";
        $data["title_header"] = "Form Uji Fungsi";
        $data["id"] = $id;
        $data["q"] = $this->Madmindkk->getujifungsidetail($id);
        $data["breadcrumb"] = "<li class='active'><strong>Form Uji Fungsi</strong></li>";
        $this->load->view('template',$data);
    }
    function simpanujifungsi($action){
        $message = $this->Madmindkk->simpanujifungsi($action);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/ujifungsi");
    }
    function hapusujifungsi($id){
        $message = $this->Madmindkk->hapusujifungsi($id);
        $this->session->set_flashdata("message",$message);
        redirect("admindkk/ujifungsi");
    }
    function liburnasional($b=1,$tahun="")
    {
        $data["title"]            = $this->session->userdata('status_user');
        $data["username"]         = $this->session->userdata('username');
        $data['menu']             = "liburnasional";
        $data['vmenu']            = "admindkk/vmenu";
        $data["content"]          = "admindkk/vliburnasional";
        $data["title_header"]     = "Libur Nasional";
        $data["b"]                = $b;
        $tahun                    = ($tahun=="" ? date("Y") : $tahun);
        $data["t"]                = $tahun;
        $data["q"]                = $this->Madmindkk->getliburnasional($b,$tahun);
        $data["libur"]                = $this->Madmindkk->getliburnasional_array();
        $data["breadcrumb"]       = "<li class='active'><strong>Libur Nasional</strong></li>";
        $this->load->view('template', $data);
    }
    function simpanliburnasional(){
      $q = $this->db->get_where("liburnasional",["tanggal"=>date("Y-m-d",strtotime($this->input->post("tanggal")))]);
      $data = array(
        "tanggal" => date("Y-m-d",strtotime($this->input->post("tanggal"))),
        "keterangan" => $this->input->post("keterangan")
      );
      if ($q->num_rows()>0){
        $this->db->where("tanggal",date("Y-m-d",strtotime($this->input->post("tanggal"))));
        $this->db->update("liburnasional",$data);
      } else {
        $this->db->insert("liburnasional",$data);
      }
    }
    function getliburnasional($tgl){
      $q = $this->db->get_where("liburnasional",["tanggal"=>date("Y-m-d",strtotime($tgl))]);
      echo json_encode($q->row());
    }
    function komentar()
    {
        $data["title"]            = $this->session->userdata('status_user');
        $data["username"]         = $this->session->userdata('username');
        $data['menu']             = "komentar";
        $data['vmenu']            = "admindkk/vmenu";
        $data["content"]          = "admindkk/vkomentar";
        $data["title_header"]     = "Komentar";
        $data["breadcrumb"]       = "<li class='active'><strong>Komentar</strong></li>";
        $this->load->view('template', $data);
    }
    function getparent(){
      $q = $this->db->get_where("komentar",["isnull(parent)"=>1]);
      echo json_encode($q->result());
    }
    function getmessage(){
      $data = array();
      $q = $this->db->get_where("komentar",["id"=>$this->input->post("id")]);
      $data["parent"] = $q->result();
      $q = $this->db->get_where("komentar",["parent"=>$this->input->post("id")]);
      $data["child"] = $q->result();
      echo json_encode($data);
    }
    function simpankomentar(){
      $data = array(
        "id" => date("YmdHis"),
        "nama" => "Administrator",
        "parent" => $this->input->post("chatId"),
        "tanggal" => date("Y-m-d H:i:s"),
        "jawab" => $this->input->post("jawab"),
        "admin" => 1
      );
      $this->db->insert("komentar",$data);
    }
}

?>
