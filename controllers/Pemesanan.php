<?php
class Pemesanan extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpemesanan');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function pemesanan_obat($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Pemesanan Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";;
        $data["content"]                = "farmasi/pemesanan_obat/vpemesanan_obat";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi";
        $data["current"]                = $current;
        $data["title_header"]           = "Pemesanan Obat";
        $data["breadcrumb"]             = "<li class='active'><strong>Pemesanan Obat</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'pemesanan/pemesanan_obat/'.$current;
        $config['total_rows']           = $this->Mpemesanan->getpemesanan_obat()->num_rows();
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
        $data["q3"]                     = $this->Mpemesanan->getdatapemesanan_obat($config['per_page'],$from);
        $data["s"]                      = $this->Mpemesanan->getsupplier();
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
        redirect('pemesanan/pemesanan_obat');
    }
    function formpemesanan_obat($no_permintaan=NULL,$no_pemesanan=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Pemesanan Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";;
        $data["menu"]               = "transaksi";
        $data["title_header"]       = "Pemesanan Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pemesanan Obat</strong></li>";
        $data["content"]            = "farmasi/pemesanan_obat/vformpemesanan_obat";
        $data["no_permintaan"]		= $no_permintaan;
        $data["no_pemesanan"]		= $no_pemesanan;
        $data["q1"]                 = $this->Mpemesanan->getpemesananobat_detail($no_pemesanan);
        $data["q"]                  = $this->Mpemesanan->getitem_pemesanan($no_pemesanan);
        $data["rk"]					= $this->Mpemesanan->getpermintaan();
        $data["irk"]				= $this->Mpemesanan->getitem_permintaan($no_permintaan);
        $data["s"]                  = $this->Mpemesanan->getsupplier();
        $data["pp"]                 = $this->Mpemesanan->getpetugas_pemesanan();
        $this->load->view('template',$data);
    }
    function simpanpemesanan($action){
    	$no_pemesanan = "PN-".date("YmdHis");
        $message = $this->Mpemesanan->simpanpemesanan($action,$no_pemesanan);
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan/formpemesanan_obat/".$this->input->post('no_permintaan')."/".$no_pemesanan);
    }
    function hapuspemesanan_obat($no_permintaan,$no_pemesanan,$password){
        $message = $this->Mpemesanan->hapuspemesanan_obat($no_permintaan,$no_pemesanan,$password);
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan/pemesanan_obat");
    }
    function getobat_permintaan($no_permintaan){
        echo json_encode($this->Mpemesanan->getobat_permintaan($no_permintaan));
    }
    function simpanitem_pemesanan(){
    	$no_permintaan = $this->input->post("no_permintaan");
    	$no_pemesanan = $this->input->post("no_pemesanan");
        $message = $this->Mpemesanan->simpanitem_pemesanan();
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan/formpemesanan_obat/".$no_permintaan."/".$no_pemesanan);
    }
    function hapusitem_pemesanan($no_permintaan,$no_pemesanan,$kode_obat){
        $message = $this->Mpemesanan->hapusitem_pemesanan($no_permintaan,$no_pemesanan,$kode_obat);
        $this->session->set_flashdata("message",$message);
        redirect("pemesanan/formpemesanan_obat/".$no_permintaan."/".$no_pemesanan);
    }

}
?>