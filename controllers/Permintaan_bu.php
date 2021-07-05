<?php
class Permintaan_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpermintaan_bu');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function permintaan_bu($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Permintaan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/permintaan_bu/vpermintaan_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Permintaan Barang Umum ";
        $data["breadcrumb"]             = "<li class='active'><strong>Permintaan Barang Umum</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'permintaan_bu/permintaan_bu/'.$current;
        $config['total_rows']           = $this->Mpermintaan_bu->getpermintaan_bu()->num_rows();
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
        $data["q3"]                     = $this->Mpermintaan_bu->getdatapermintaan_bu($config['per_page'],$from);
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
        redirect('permintaan_bu/permintaan_bu');
    }
    function formpermintaan_bu($no_renbut=NULL,$kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Permintaan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Permintaan Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Permintaan Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/permintaan_bu/vformpermintaan_bu";
        $data["no_renbut"]			= $no_renbut;
        $data["no_permintaan"]		= $kode;
        $data["q1"]                 = $this->Mpermintaan_bu->getpermintaanobat_detail($kode);
        $data["q"]                  = $this->Mpermintaan_bu->getitem_permintaan($kode);
        $data["d"]					= $this->Mpermintaan_bu->getdepo();
        $data["rk"]					= $this->Mpermintaan_bu->getrenbut();
        $data["irk"]				= $this->Mpermintaan_bu->getitem_rk($no_renbut);
        $data["ip"]					= $this->Mpermintaan_bu->getitem_permintaan($kode);
        $this->load->view('template',$data);
    }
    function simpanpermintaan_bu($action){
    	$no_permintaan = "PO-".date("YmdHis");
        $message = $this->Mpermintaan_bu->simpanpermintaan_bu($action,$no_permintaan);
        $this->session->set_flashdata("message",$message);
        redirect("permintaan_bu/formpermintaan_bu/".$this->input->post('no_renbut')."/".$no_permintaan);
    }
    function hapuspermintaan_bu($no_renbut,$no_permintaan){
        $message = $this->Mpermintaan_bu->hapuspermintaan_bu($no_renbut,$no_permintaan);
        $this->session->set_flashdata("message",$message);
        redirect("permintaan_bu/permintaan_bu");
    }
    function getobat(){
        echo json_encode($this->Mpermintaan_bu->getobat());
    }
    function simpanitem_rk(){
        $this->Mpermintaan_bu->simpanitem_rk();
    }
    function changedata(){
        $this->Mpermintaan_bu->changedata();
    }
    function changedata2(){
        $this->Mpermintaan_bu->changedata2();
    }
    function hapusiteMpermintaan($no_renbut,$kode){
        $message = $this->Mpermintaan_bu->hapusiteMpermintaan($no_renbut,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("rk/formrencana_kebutuhan/".$no_renbut);
    }
    function pengajuan_depo($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Pengajuan Depo &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "pengajuan_depo/vpengajuan_depo";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Pengajuan Depo ";
        $data["breadcrumb"]             = "<li class='active'><strong>Pengajuan Depo</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'permintaan_bu/pengajuan_depo/'.$current;
        $config['total_rows']           = $this->Mpermintaan_bu->getpengajuan_depo()->num_rows();
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
        $data["q3"]                     = $this->Mpermintaan_bu->getdatapengajuan_depo($config['per_page'],$from);
        $data["dp"]                     = $this->Mpermintaan_bu->getdepo();
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
        redirect('permintaan_bu/pengajuan_depo');
    }
    function formpengajuan_depo($no_pengajuan=NULL){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Pengajuan Depo &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Pengajuan Depo ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pengajuan Depo</strong></li>";
        $data["content"]            = "pengajuan_depo/vformpengajuan_depo";
        $data["no_pengajuan"]       = $no_pengajuan;
        $data["q1"]                 = $this->Mpermintaan_bu->getpengajuandepo_detail($no_pengajuan);
        $data["d"]                  = $this->Mpermintaan_bu->getdepo();
        $data["q"]                  = $this->Mpermintaan_bu->getitem_pengajuan($no_pengajuan);
        $this->load->view('template',$data);
    }
    function simpanpengajuan($action){
        $no_pengajuan = "PD-".date("YmhHis");
        $no_pengajuan_edit = $this->input->post("no_pengajuan");
        $message = $this->Mpermintaan_bu->simpanpengajuan($action,$no_pengajuan);
        $this->session->set_flashdata("message",$message);
        if ($action=="simpan") {
            redirect("permintaan_bu/formpengajuan_depo/".$no_pengajuan);
        } else {
            redirect("permintaan_bu/formpengajuan_depo/".$no_pengajuan_edit);
        }
        
    }
    function simpanitem_pengajuan(){
        $no_pengajuan = $this->input->post("no_pengajuan");
        $message = $this->Mpermintaan_bu->simpanitem_pengajuan();
        $this->session->set_flashdata("message",$message);
        redirect("permintaan_bu/formpengajuan_depo/".$no_pengajuan);
    }
    function changedata_pengajuan(){
        $this->Mpermintaan_bu->changedata_pengajuan();
    }
    function changedata_pengajuan2(){
        $this->Mpermintaan_bu->changedata_pengajuan2();
    }
    function hapusitem_pengajuan($no_pengajuan,$kode){
        $message = $this->Mpermintaan_bu->hapusitem_pengajuan($no_pengajuan,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("permintaan_bu/formpengajuan_depo/".$no_pengajuan);
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
        $data["q"]          = $this->Mpermintaan_bu->getrekap_permintaan($tanggal1,$tanggal2);
        $this->load->view("barang_umum/permintaan_bu/vrekappermintaan",$data);
    }

}
?>