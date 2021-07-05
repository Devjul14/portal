<?php
class Pemesanan_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpemesanan_bu');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function pemesanan($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Pemesanan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/pemesanan_bu/vpemesanan_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Pemesanan Barang Umum";
        $data["breadcrumb"]             = "<li class='active'><strong>Pemesanan Barang Umum</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'pemesanan_bu/pemesanan/'.$current;
        $config['total_rows']           = $this->Mpemesanan_bu->getpemesanan_bu()->num_rows();
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
        $data["q3"]                     = $this->Mpemesanan_bu->getdatapemesanan_bu($config['per_page'],$from);
        $data["s"]                      = $this->Mpemesanan_bu->getsupplier();
        $this->load->view('template',$data);
    }
    function search_nomor(){
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("cari_nomor",$this->input->post("cari_nomor"));
        $this->session->set_userdata("supplier",$this->input->post("supplier"));
    }
    function reset_nomor(){
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("cari_nomor");
        $this->session->unset_userdata("supplier");
        redirect('pemesanan_bu/pemesanan');
    }
    function formpemesanan_bu($no_permintaan=NULL,$no_pemesanan=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Pemesanan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Pemesanan Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pemesanan Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/pemesanan_bu/vformpemesanan_bu";
        $data["no_permintaan"]		= $no_permintaan;
        $data["no_pemesanan"]		= $no_pemesanan;
        $data["q1"]                 = $this->Mpemesanan_bu->getpemesananbu_detail($no_pemesanan);
        $data["q"]                  = $this->Mpemesanan_bu->getitempemesanan_bu($no_pemesanan);
        $data["rk"]					= $this->Mpemesanan_bu->getpermintaan();
        $data["irk"]				= $this->Mpemesanan_bu->getitempermintaan_bu($no_permintaan);
        $data["s"]                  = $this->Mpemesanan_bu->getsupplier();
        $data["pp"]                 = $this->Mpemesanan_bu->getpetugas_pemesanan();
        $this->load->view('template',$data);
    }
    function simpanpemesanan_bu($action){
    	$no_pemesanan = "PN-".date("YmdHis");
        $message = $this->Mpemesanan_bu->simpanpemesanan_bu($action,$no_pemesanan);
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan_bu/formpemesanan_bu/".$this->input->post('no_permintaan')."/".$no_pemesanan);
    }
    function hapuspemesanan_bu($no_permintaan,$no_pemesanan,$password){
        $message = $this->Mpemesanan_bu->hapuspemesanan_bu($no_permintaan,$no_pemesanan,$password);
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan_bu/pemesanan");
    }
    function getbu_permintaan($no_permintaan){
        echo json_encode($this->Mpemesanan_bu->getbu_permintaan($no_permintaan));
    }
    function simpanitempemesanan_bu(){
    	$no_permintaan = $this->input->post("no_permintaan");
    	$no_pemesanan = $this->input->post("no_pemesanan");
        $message = $this->Mpemesanan_bu->simpanitempemesanan_bu();
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan_bu/formpemesanan_bu/".$no_permintaan."/".$no_pemesanan);
    }
    function hapusitem_pemesanan($no_permintaan,$no_pemesanan,$kode_obat){
        $message = $this->Mpemesanan_bu->hapusitem_pemesanan($no_permintaan,$no_pemesanan,$kode_obat);
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan_bu/formpemesanan_bu/".$no_permintaan."/".$no_pemesanan);
    }

}
?>