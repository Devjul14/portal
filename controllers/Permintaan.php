<?php
class Permintaan extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpermintaan');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function permintaan_obat($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Permintaan Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = "farmasi/vmenu";
        $data["content"]                = "farmasi/permintaan_obat/vpermintaan_obat";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi";
        $data["current"]                = $current;
        $data["title_header"]           = "Permintaan Obat ";
        $data["breadcrumb"]             = "<li class='active'><strong>Permintaan Obat</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'permintaan/permintaan_obat/'.$current;
        $config['total_rows']           = $this->Mpermintaan->getpermintaan_obat()->num_rows();
        $config['per_page']             = 20;
        $config['full_tag_open']        = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']       = '</ul>';
        $config['cur_tag_open']         = '<li class=active><a>';
        $config['cur_tag_close']        = '</a></li>';
        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';
        $config['num_links']            = 4;
        $config['uri_segment']          = 4;
        $from                           = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mpermintaan->getdatapermintaan_obat($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function search_nomor(){
        $this->session->set_userdata("cari_nomor",$this->input->post("cari_nomor"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
    }
    function reset_nomor(){
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("cari_nomor");
        redirect('permintaan/permintaan_obat');
    }
    function formpermintaan_obat($no_renbut=NULL,$kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Permintaan Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = "farmasi/vmenu";
        $data["menu"]               = "transaksi";
        $data["title_header"]       = "Permintaan Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Permintaan Obat</strong></li>";
        $data["content"]            = "farmasi/permintaan_obat/vformpermintaan_obat";
        $data["no_renbut"]			= $no_renbut;
        $data["no_permintaan"]		= $kode;
        $data["q1"]                 = $this->Mpermintaan->getpermintaanobat_detail($kode);
        $data["q"]                  = $this->Mpermintaan->getitem_permintaan($kode);
        $data["d"]					= $this->Mpermintaan->getdepo();
        $data["rk"]					= $this->Mpermintaan->getrenbut();
        $data["irk"]				= $this->Mpermintaan->getitem_rk($no_renbut);
        $data["ip"]					= $this->Mpermintaan->getitem_permintaan($kode);
        $this->load->view('template',$data);
    }
    function simpanpermintaan($action){
    	$no_permintaan = "PO-".date("YmdHis");
        $message = $this->Mpermintaan->simpanpermintaan($action,$no_permintaan);
        $this->session->set_flashdata("message",$message);
        redirect("permintaan/formpermintaan_obat/".$this->input->post('no_renbut')."/".$no_permintaan);
    }
    function hapuspermintaan_obat($no_renbut,$no_permintaan){
        $message = $this->Mpermintaan->hapuspermintaan_obat($no_renbut,$no_permintaan);
        $this->session->set_flashdata("message",$message);
        redirect("permintaan/permintaan_obat");
    }
    function getobat(){
        echo json_encode($this->Mpermintaan->getobat());
    }
    function simpanitem_rk(){
        $this->Mpermintaan->simpanitem_rk();
    }
    function changedata(){
        $this->Mpermintaan->changedata();
    }
    function changedata2(){
        $this->Mpermintaan->changedata2();
    }
    function hapusiteMpermintaan($no_renbut,$kode){
        $message = $this->Mpermintaan->hapusiteMpermintaan($no_renbut,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("rk/formrencana_kebutuhan/".$no_renbut);
    }
    function pengajuan_depo($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Pengajuan Depo &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = "farmasi/vmenu";
        $data["content"]                = "farmasi/pengajuan_depo/vpengajuan_depo";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi";
        $data["current"]                = $current;
        $data["title_header"]           = "Pengajuan Depo ";
        $data["breadcrumb"]             = "<li class='active'><strong>Pengajuan Depo</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'permintaan/pengajuan_depo/'.$current;
        $config['total_rows']           = $this->Mpermintaan->getpengajuan_depo()->num_rows();
        $config['per_page']             = 20;
        $config['full_tag_open']        = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']       = '</ul>';
        $config['cur_tag_open']         = '<li class=active><a>';
        $config['cur_tag_close']        = '</a></li>';
        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';
        $config['num_links']            = 4;
        $config['uri_segment']          = 4;
        $from                           = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mpermintaan->getdatapengajuan_depo($config['per_page'],$from);
        $data["dp"]                     = $this->Mpermintaan->getdepo();
        $this->load->view('template',$data);
    }
    function search_pengajuan(){
        $this->session->set_userdata("cari_pengajuan",$this->input->post("cari_pengajuan"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("depo", $this->input->post("depo"));
    }
    function reset_pengajuan(){
        $this->session->unset_userdata("cari_pengajuan");
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        redirect('permintaan/pengajuan_depo');
    }
    function formpengajuan_depo($no_pengajuan=NULL){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Pengajuan Depo &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = "farmasi/vmenu";
        $data["menu"]               = "transaksi";
        $data["title_header"]       = "Pengajuan Depo ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pengajuan Depo</strong></li>";
        $data["content"]            = "farmasi/pengajuan_depo/vformpengajuan_depo";
        $data["no_pengajuan"]       = $no_pengajuan;
        $data["q1"]                 = $this->Mpermintaan->getpengajuandepo_detail($no_pengajuan);
        $data["d"]                  = $this->Mpermintaan->getdepo();
        $data["q"]                  = $this->Mpermintaan->getitem_pengajuan($no_pengajuan);
        $this->load->view('template',$data);
    }
    function simpanpengajuan($action){
        $no_pengajuan = "PD-".date("YmhHis");
        $no_pengajuan_edit = $this->input->post("no_pengajuan");
        $message = $this->Mpermintaan->simpanpengajuan($action,$no_pengajuan);
        $this->session->set_flashdata("message",$message);
        if ($action=="simpan") {
            redirect("permintaan/formpengajuan_depo/".$no_pengajuan);
        } else {
            redirect("permintaan/formpengajuan_depo/".$no_pengajuan_edit);
        }
        
    }
    function simpanitem_pengajuan(){
        $no_pengajuan = $this->input->post("no_pengajuan");
        $message = $this->Mpermintaan->simpanitem_pengajuan();
        $this->session->set_flashdata("message",$message);
        redirect("permintaan/formpengajuan_depo/".$no_pengajuan);
    }
    function changedata_pengajuan(){
        $this->Mpermintaan->changedata_pengajuan();
    }
    function changedata_pengajuan2(){
        $this->Mpermintaan->changedata_pengajuan2();
    }
    function hapusitem_pengajuan($no_pengajuan,$kode){
        $message = $this->Mpermintaan->hapusitem_pengajuan($no_pengajuan,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("permintaan/formpengajuan_depo/".$no_pengajuan);
    }
    function rekap_permintaan($tgl1="",$tgl2=""){
        if ($tgl1=="") {
            $tanggal1 = date('d-m-Y');
        } else {
            $tanggal1 = $tgl1;
        }
        if ($tgl2=="") {
            $tanggal2 = date('d-m-Y');
        } else {
            $tanggal2 = $tgl2;
        }
        $data["tanggal1"]   = $tanggal1;
        $data["tanggal2"]   = $tanggal2;
        $data["q"]          = $this->Mpermintaan->getrekap_permintaan($tanggal1,$tanggal2);
        $this->load->view("farmasi/permintaan_obat/vrekappermintaan",$data);
    }

}
?>