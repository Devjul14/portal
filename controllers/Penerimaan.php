<?php
class Penerimaan extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpenerimaan');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function penerimaan_barang($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Penerimaan Barang &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";;
        $data["content"]                = "farmasi/penerimaan_barang/vpenerimaan_barang";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi";
        $data["current"]                = $current;
        $data["title_header"]           = "Penerimaan Barang";
        $data["breadcrumb"]             = "<li class='active'><strong>Penerimaan Barang</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'penerimaan/penerimaan_barang/'.$current;
        $config['total_rows']           = $this->Mpenerimaan->getpenerimaan_barang()->num_rows();
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
        $data["q3"]                     = $this->Mpenerimaan->getdatapenerimaan_barang($config['per_page'],$from);
        $data["sp"]                     = $this->Mpenerimaan->getsupplier();
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
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("supplier");
        redirect('penerimaan/penerimaan_barang');
    }
    function formpenerimaan_barang($no_pemesanan=NULL,$no_penerimaan=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Penerimaan Barang &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";;
        $data["menu"]               = "transaksi";
        $data["title_header"]       = "Penerimaan Barang ";
        $data["breadcrumb"]         = "<li class='active'><strong>Penerimaan Barang</strong></li>";
        $data["content"]            = "farmasi/penerimaan_barang/vformpenerimaan_barang";
        $data["no_pemesanan"]		= $no_pemesanan;
        $data["no_penerimaan"]		= $no_penerimaan;
        $data["q1"]                 = $this->Mpenerimaan->getpenerimaanbarang_detail($no_penerimaan);
        $data["q"]                  = $this->Mpenerimaan->getitem_penerimaan($no_penerimaan);
        $data["rk"]					= $this->Mpenerimaan->getpemesanan();
        $data["irk"]				= $this->Mpenerimaan->getitem_pemesanan($no_pemesanan);
        $data["q2"]                 = $this->Mpenerimaan->getpemesanan_detail($no_pemesanan);
        $data["as"]                  = $this->Mpenerimaan->getasal_barang();
        $this->load->view('template',$data);
    }
    function simpanpenerimaan($action){
    	$no_penerimaan = "DO-".date("YmdHis");
        $message = $this->Mpenerimaan->simpanpenerimaan($action,$no_penerimaan);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan/formpenerimaan_barang/".$this->input->post('no_pemesanan')."/".$no_penerimaan);
    }
    function hapuspenerimaan_barang($no_pemesanan,$no_penerimaan){
        $message = $this->Mpenerimaan->hapuspenerimaan_barang($no_pemesanan,$no_penerimaan);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan/penerimaan_barang");
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
        $data["q"]          = $this->Mpenerimaan->getrekap_penerimaan($tanggal1,$tanggal2);
        $this->load->view("farmasi/penerimaan_barang/vrekappenerimaan",$data);
    }
    function simpantanggal_rekap($no_penerimaan,$tgl){
        $message = $this->Mpenerimaan->simpantanggal_rekap($no_penerimaan,$tgl);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan/penerimaan_barang");
    }

}
?>