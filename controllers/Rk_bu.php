<?php
class Rk_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mrk_bu');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function rencana_kebutuhan($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Rencana Kebutuhan &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/rk_bu/vrencana_kebutuhan";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Rencana Kebutuhan ";
        $data["breadcrumb"]             = "<li class='active'><strong>Rencana Kebutuhan</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'rk_bu/rencana_kebutuhan/'.$current;
        $config['total_rows']           = $this->Mrk_bu->getrencana_kebutuhan()->num_rows();
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
        $data["q3"]                     = $this->Mrk_bu->getdatarencana_kebutuhan($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function search_nomor(){
        $this->session->set_userdata("cari_nomor",$this->input->post("cari_nomor"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
    }
    function reset_nomor(){
        $this->session->unset_userdata("cari_nomor");
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        redirect('rk_bu/rencana_kebutuhan');
    }
    function formrencana_kebutuhan($periode=null,$kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Rencana Kebutuhan &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Rencana Kebutuhan ";
        $data["periode"]			= $periode;
        $data["breadcrumb"]         = "<li class='active'><strong>Rencana Kebutuhan</strong></li>";
        $data["content"]            = "barang_umum/rk_bu/vformrencana_kebutuhan";
        $data["q1"]                 = $this->Mrk_bu->getrencanakebutuhan_detail($kode);
        $data["q"]                  = $this->Mrk_bu->getitem_rk($kode);
        $data["pr"]                  = $this->Mrk_bu->getperiode();
        $data["p"]					= $this->Mrk_bu->getpengajuan_depo($periode);
        $this->load->view('template',$data);
    }
    function simpanmaster($action){
        $no_renbut = "RB-".date("YmhHis");
        $message = $this->Mrk_bu->simpanmaster($action,$no_renbut);
        $this->session->set_flashdata("message",$message);
        redirect("rk_bu/formrencana_kebutuhan/".$no_renbut);
    }
    function hapusrencana_kebutuhan($periode,$kode){
        $message = $this->Mrk_bu->hapusrencana_kebutuhan($periode,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("rk_bu/rencana_kebutuhan");
    }
    function getobat(){
        echo json_encode($this->Mrk_bu->getobat());
    }
    function simpanitem_rk(){
        $this->Mrk_bu->simpanitem_rk();
    }
    function changedata(){
        $this->Mrk_bu->changedata();
    }
    function changedata2(){
        $this->Mrk_bu->changedata2();
    }
    function hapusiteMrk_bu($no_renbut,$kode){
        $message = $this->Mrk_bu->hapusiteMrk_bu($no_renbut,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("rk_bu/formrencana_kebutuhan/".$no_renbut);
    }
    function simpanrencana_kebutuhan($action){
    	$no_renbut = "RB-".date("YmdHis");
        $message = $this->Mrk_bu->simpanrencana_kebutuhan($action,$no_renbut);
        $this->session->set_flashdata("message",$message);
        redirect("rk_bu/formrencana_kebutuhan/".$this->input->post('periode')."/".$no_renbut);
    }
    function rekap_renbut($tgl1="",$tgl2=""){
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
        $data["q"]          = $this->Mrk_bu->getrekap_renbut($tanggal1,$tanggal2);
        $this->load->view("barang_umum/rk_bu/vrekaprenbut",$data);
    }
}
?>