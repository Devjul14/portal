<?php
class Distribusi extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mdistribusi');
        $this->load->Model('Mpermintaan');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function distribusi_obat($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Distribusi Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";;
        $data["content"]                = "farmasi/distribusi_obat/vdistribusi_obat";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi";
        $data["current"]                = $current;
        $data["title_header"]           = "Distribusi Obat ";
        $data["breadcrumb"]             = "<li class='active'><strong>Distribusi Obat</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'distribusi/distribusi_obat/'.$current;
        $config['total_rows']           = $this->Mdistribusi->getdistribusi_obat()->num_rows();
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
        $data["q3"]                     = $this->Mdistribusi->getdatadistribusi_obat($config['per_page'],$from);
        $data["d1"]                 	= $this->Mdistribusi->getdepo();
        $data["d2"]                 	= $this->Mdistribusi->getdepo();
        $this->load->view('template',$data);
    }
    function formdistribusi_obat($no_distribusi=NULL){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Distribusi Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";;
        $data["menu"]               = "transaksi";
        $data["title_header"]       = "Distribusi Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Distribusi Obat</strong></li>";
        $data["content"]            = "farmasi/distribusi_obat/vformdistribusi_obat";
        $data["no_distribusi"]      = $no_distribusi;
        $data["q1"]                 = $this->Mdistribusi->getdistribusiobat_detail($no_distribusi);
        $data["d1"]                 = $this->Mdistribusi->getdepo();
        $data["d2"]                 = $this->Mdistribusi->getdepo();
        $data["q"]                  = $this->Mdistribusi->getitem_distribusi($no_distribusi);
        $data["sd"]                 = $this->Mdistribusi->getstok_depo($no_distribusi);
        $this->load->view('template',$data);
    }
    function simpandistribusi($action){
        $no_distribusi      = "DS-".date("YmhHis");
        $no_distribusi_edit = $this->input->post("no_distribusi");
        $message = $this->Mdistribusi->simpandistribusi($action,$no_distribusi);
        $this->session->set_flashdata("message",$message);
        if ($action=="simpan") {
            redirect("distribusi/formdistribusi_obat/".$no_distribusi);
        } else {
            redirect("distribusi/formdistribusi_obat/".$no_distribusi_edit);
        }   
    }
    function getobat($depo){
        echo json_encode($this->Mdistribusi->getobat($depo));
    }
    function simpanitem_distribusi(){
        $this->Mdistribusi->simpanitem_distribusi();
    }
    function changedata_distribusi(){
        $this->Mdistribusi->changedata_distribusi();
    }
    function hapusitem_distribusi($no_distribusi,$kode,$depo_asal,$depo_tujuan){
        $message = $this->Mdistribusi->hapusitem_distribusi($no_distribusi,$kode,$depo_asal,$depo_tujuan);
        $this->session->set_flashdata("message",$message);
        redirect("distribusi/formdistribusi_obat/".$no_distribusi);
    }
    function hapusdistribusi_obat($no_distribusi){
        $message = $this->Mdistribusi->hapusdistribusi_obat($no_distribusi);
        $this->session->set_flashdata("message",$message);
        redirect("distribusi/distribusi_obat");
    }
    function search_distribusi(){
        $this->session->set_userdata("cari_distribusi", $this->input->post("cari_distribusi"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("depo_asal", $this->input->post("depo_asal"));
        $this->session->set_userdata("depo_tujuan", $this->input->post("depo_tujuan"));
    }
    function reset_distribusi(){
        $this->session->unset_userdata("cari_distribusi");
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("depo_asal");
       	$this->session->unset_userdata("depo_tujuan"); 
        redirect('distribusi/distribusi_obat');
    }
}
?>