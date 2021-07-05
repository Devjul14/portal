<?php
class Pembayaran_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpembayaran_bu');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function pembayaran($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Pembayaran Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/pembayaran_bu/vpembayaran";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Pembayaran Barang Umum";
        $data["breadcrumb"]             = "<li class='active'><strong>Pembayaran Barang Umum</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'pembayaran_bu/pembayaran/'.$current;
        $config['total_rows']           = $this->Mpembayaran_bu->getpembayaran_bu()->num_rows();
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
        $data["q3"]                     = $this->Mpembayaran_bu->getdatapembayaran_bu($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function search_nomor(){
        $message = $this->input->post("cari_nomor");
        $this->session->set_userdata("cari_nomor",$message);
    }
    function reset_nomor(){
        $this->session->unset_userdata("cari_nomor");
        redirect('pembayaran_bu/pembayaran_barang');
    }
    function formpembayaran($no_penerimaan,$no_pembayaran=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Pembayaran &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = " ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pembayaran</strong></li>";
        $data["content"]            = "barang_umum/pembayaran_bu/vformpembayaran";
        $data["no_penerimaan"]		= $no_penerimaan;
        $data["no_pembayaran"]		= $no_pembayaran;
        $data["q"]                  = $this->Mpembayaran_bu->getitem_penerimaan($no_penerimaan);
        $data["row"]                = $this->Mpembayaran_bu->getpenerimaanbu_detail($no_penerimaan);
        $data["q1"]                 = $this->Mpembayaran_bu->getpembayaran_detail($no_pembayaran);
        $this->load->view('template',$data);
    }
    function simpanpembayaran(){
    	$no_pembayaran = "PB-".date("YmdHis");
        $message = $this->Mpembayaran_bu->simpanpembayaran($no_pembayaran);
        $this->session->set_flashdata("message",$message);
        redirect("pembayaran_bu/formpembayaran/".$this->input->post('no_penerimaan')."/".$no_pembayaran);
    }
    function hapuspenerimaan_barang($no_pemesanan,$no_penerimaan){
        $message = $this->Mpembayaran_bu->hapuspenerimaan_barang($no_pemesanan,$no_penerimaan);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan/penerimaan_barang");
    }
    function cetak_kwitansi($no_penerimaan,$no_pembayaran=""){
        $data["no_penerimaan"]   	= $no_penerimaan;
        $data["no_pembayaran"]   	= $no_pembayaran;
        $data["q"]          		= $this->Mpembayaran_bu->getpembayaran_detail($no_pembayaran);
        $data["row"]                = $this->Mpembayaran_bu->getpenerimaanbu_detail($no_penerimaan);
        $this->load->view("barang_umum/pembayaran_bu/vcetak_kwitansi",$data);
    }

}
?>