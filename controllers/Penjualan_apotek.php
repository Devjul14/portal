<?php
class Penjualan_apotek extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mpenjualan_apotek');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Penjualan Apotek &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";;
        $data["content"]                = "farmasi/penjualan_apotek/vpenjualan_apotek";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "apotek";
        $data["current"]                = $current;
        $data["title_header"]           = "Penjualan Apotek ";
        $data["breadcrumb"]             = "<li class='active'><strong>Penjualan Apotek</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'penjualan_apotek/'.$current;
        $config['total_rows']           = $this->Mpenjualan_apotek->getpenjualan_apotek()->num_rows();
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
        $data["q3"]                     = $this->Mpenjualan_apotek->getdatapenjualan_apotek($config['per_page'],$from);
        $data["dp"]                     = $this->Mpenjualan_apotek->getdepo();
        $this->load->view('template',$data);
    }
    function search_penjualan(){
        $this->session->set_userdata("cari_penjualan",$this->input->post("cari_penjualan"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("depo", $this->input->post("depo"));
    }
    function reset_penjualan(){
        $this->session->unset_userdata("cari_penjualan");
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        redirect('penjualan_apotek');
    }
    function formpenjualan_apotek($no_penjualan=NULL){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Penjualan Apotek &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";;
        $data["menu"]               = "apotek";
        $data["title_header"]       = "Penjualan Apotek ";
        $data["breadcrumb"]         = "<li class='active'><strong>Penjualan Apotek</strong></li>";
        $data["content"]            = "farmasi/penjualan_apotek/vformpenjualan_apotek";
        $data["no_penjualan"]       = $no_penjualan;
        $data["d"]                  = $this->Mpenjualan_apotek->getdepo();
        $data["q"]                  = $this->Mpenjualan_apotek->getitem_penjualan($no_penjualan);
        $data["q1"]                 = $this->Mpenjualan_apotek->getpenjualan_apotek_detail($no_penjualan);
        $data["dk"]                 = $this->Mpenjualan_apotek->getdokter();
        $data["r"]                  = $this->Mpenjualan_apotek->getruangan();
        $data["poli"]               = $this->Mpenjualan_apotek->getpoliklinik();
        $data["ap"]                 = $this->Mpenjualan_apotek->getaturan_pakai();
        $data["w"]                  = $this->Mpenjualan_apotek->getwaktu();
        $data["t"]                  = $this->Mpenjualan_apotek->gettakaran();
        $data["wl"]                 = $this->Mpenjualan_apotek->getwaktu_lainnya();
        $this->load->view('template',$data);
    }
    function simpanpenjualan_apotek($action){
        $no_penjualan = "PJL-".$this->input->post("depo").date("YmhHis");
        $no_penjualan_edit = $this->input->post("no_penjualan");
        $message = $this->Mpenjualan_apotek->simpanpenjualan_apotek($action,$no_penjualan);
        $this->session->set_flashdata("message",$message);
        if ($action=="simpan") {
            redirect("penjualan_apotek/formpenjualan_apotek/".$no_penjualan);
        } else {
            redirect("penjualan_apotek/formpenjualan_apotek/".$no_penjualan_edit);
        }
        
    }
    function simpanitem_penjualan(){
        $no_penjualan = $this->input->post("no_penjualan");
        $message = $this->Mpenjualan_apotek->simpanitem_penjualan();
        $this->session->set_flashdata("message",$message);
        redirect("penjualan_apotek/formpenjualan_apotek/".$no_penjualan);
    }
    function simpanaturan(){
        $no_penjualan = $this->input->post("no_penjualan");
        $message = $this->Mpenjualan_apotek->simpanaturan($no_penjualan);
        $this->session->set_flashdata("message",$message);
        redirect("penjualan_apotek/formpenjualan_apotek/".$no_penjualan);
    }
    function changeharga(){
        $this->Mpenjualan_apotek->changeharga();
    }
    function changedata_pengajuan2(){
        $this->Mpenjualan_apotek->changedata_pengajuan2();
    }
    function hapusitem_penjualan($no_penjualan,$kode){
        $message = $this->Mpenjualan_apotek->hapusitem_penjualan($no_penjualan,$kode);
        $this->session->set_flashdata("message",$message);
        redirect("penjualan_apotek/formpenjualan_apotek/".$no_penjualan);
    }
    function getobat($depo){
        echo json_encode($this->Mpenjualan_apotek->getobat($depo));
    }
    function getpasien(){
        echo json_encode($this->Mpenjualan_apotek->getpasien());
    }
    function cetak_penjualan($no_penjualan){
        $data["no_penjualan"]       = $no_penjualan;
        $data["q"]                  = $this->Mpenjualan_apotek->cetak_penjualan($no_penjualan);
        $data["q1"]                 = $this->Mpenjualan_apotek->getitem_penjualan($no_penjualan);
        // $data["nota"]          = $this->Mapotek_farmasi->getnota_inap();
        $this->load->view('farmasi/penjualan_apotek/vcetak_penjualan',$data);    
    }

}
?>