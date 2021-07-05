<?php
class Penerimaan_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpenerimaan_bu');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function penerimaan($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Penerimaan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/penerimaan_bu/vpenerimaan_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Penerimaan Barang Umum";
        $data["breadcrumb"]             = "<li class='active'><strong>Penerimaan Barang Umum</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'penerimaan_bu/penerimaan/'.$current;
        $config['total_rows']           = $this->Mpenerimaan_bu->getpenerimaan_bu()->num_rows();
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
        $data["q3"]                     = $this->Mpenerimaan_bu->getdatapenerimaan_bu($config['per_page'],$from);
        $data["sp"]                     = $this->Mpenerimaan_bu->getsupplier();
        $this->load->view('template',$data);
    }
    function search_nomor(){
        $this->session->set_userdata("cari_nomor",$this->input->post("cari_nomor"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("supplier", $this->input->post("supplier"));
    }
    function reset_nomor(){
        $this->session->unset_userdata("cari_nomor");
        $this->session->unset_userdata("tg1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("supplier");
        redirect('penerimaan_bu/penerimaan');
    }
    function formpenerimaan_bu($no_pemesanan=NULL,$no_penerimaan=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Penerimaan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Penerimaan Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Penerimaan Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/penerimaan_bu/vformpenerimaan_bu";
        $data["no_pemesanan"]		= $no_pemesanan;
        $data["no_penerimaan"]		= $no_penerimaan;
        $data["q1"]                 = $this->Mpenerimaan_bu->getpenerimaanbu_detail($no_penerimaan);
        $data["q"]                  = $this->Mpenerimaan_bu->getitempenerimaan_bu($no_penerimaan);
        $data["rk"]					= $this->Mpenerimaan_bu->getpemesanan();
        $data["irk"]				= $this->Mpenerimaan_bu->getitempemesanan_bu($no_pemesanan);
        $data["q2"]                 = $this->Mpenerimaan_bu->getpemesanan_detail($no_pemesanan);
        $data["as"]                  = $this->Mpenerimaan_bu->getasal_barang();
        $this->load->view('template',$data);
    }
    function simpanpenerimaan_bu($action){
    	$no_penerimaan = "DO-".date("YmdHis");
        $message = $this->Mpenerimaan_bu->simpanpenerimaan_bu($action,$no_penerimaan);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan_bu/formpenerimaan_bu/".$this->input->post('no_pemesanan')."/".$no_penerimaan);
    }
    function hapuspenerimaan_barang($no_pemesanan,$no_penerimaan){
        $message = $this->Mpenerimaan_bu->hapuspenerimaan_barang($no_pemesanan,$no_penerimaan);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan_bu/penerimaan");
    }
    function rekap_penerimaan($tgl1="",$tgl2=""){
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
        $data["q"]          = $this->Mpenerimaan_bu->getrekap_penerimaan($tanggal1,$tanggal2);
        $this->load->view("barang_umum/penerimaan_bu/vrekappenerimaan_bu",$data);
    }
    function simpantanggal_rekap($no_penerimaan,$tgl){
        $message = $this->Mpenerimaan_bu->simpantanggal_rekap($no_penerimaan,$tgl);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan_bu/penerimaan");
    }

}
?>