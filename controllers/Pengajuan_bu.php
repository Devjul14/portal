<?php
class Pengajuan_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpengajuan_bu');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function pengajuan($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Pengajuan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/pengajuan_bu/vpengajuan_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Pengajuan Barang Umum ";
        $data["breadcrumb"]             = "<li class='active'><strong>Pengajuan Barang Umum</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'pengajuan_bu/pengajuan/'.$current;
        $config['total_rows']           = $this->Mpengajuan_bu->getpengajuan_bu()->num_rows();
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
        $data["q3"]                     = $this->Mpengajuan_bu->getdatapengajuan_bu($config['per_page'],$from);
        $data["dp"]                     = $this->Mpengajuan_bu->getdepo();
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
        redirect('pengajuan_bu/pengajuan_bu');
    }
    function formpengajuan_bu($no_pengajuan=NULL){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Pengajuan Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Pengajuan Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pengajuan Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/pengajuan_bu/vformpengajuan_bu";
        $data["no_pengajuan"]       = $no_pengajuan;
        $data["q1"]                 = $this->Mpengajuan_bu->getpengajuanbu_detail($no_pengajuan);
        $data["d"]                  = $this->Mpengajuan_bu->getdepo();
        $data["q"]                  = $this->Mpengajuan_bu->getitem_pengajuan($no_pengajuan);
        $this->load->view('template',$data);
    }
    function simpanpengajuan($action){
        $no_pengajuan = "PD-".date("YmhHis");
        $no_pengajuan_edit = $this->input->post("no_pengajuan");
        $message = $this->Mpengajuan_bu->simpanpengajuan($action,$no_pengajuan);
        $this->session->set_flashdata("message",$message);
        if ($action=="simpan") {
            redirect("pengajuan_bu/formpengajuan_bu/".$no_pengajuan);
        } else {
            redirect("pengajuan_bu/formpengajuan_bu/".$no_pengajuan_edit);
        }
        
    }
    function simpanitem_pengajuan(){
        $no_pengajuan = $this->input->post("no_pengajuan");
        $message = $this->Mpengajuan_bu->simpanitem_pengajuan();
        $this->session->set_flashdata("message",$message);
        redirect("pengajuan_bu/formpengajuan_bu/".$no_pengajuan);
    }
    function changedata_pengajuan(){
        $this->Mpengajuan_bu->changedata_pengajuan();
    }
    function hapusitem_pengajuan($no_pengajuan,$kode){
        $message = $this->Mpengajuan_bu->hapusitem_pengajuan($no_pengajuan,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("pengajuan_bu/formpengajuan_bu/".$no_pengajuan);
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
        $data["q"]          = $this->Mpengajuan_bu->getrekap_permintaan($tanggal1,$tanggal2);
        $this->load->view("permintaan_obat/vrekappermintaan",$data);
    }
    function getbu(){
        echo json_encode($this->Mpengajuan_bu->getbu());
    }

}
?>