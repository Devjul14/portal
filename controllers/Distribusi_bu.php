<?php
class Distribusi_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Madmindkk');
        $this->load->Model('Mpendaftaran');
        $this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        $this->load->Model('Mdistribusi_bu');
        $this->load->Model('Mpermintaan');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
                redirect('login','refresh');
        }
    }
    function distribusi($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Distribusi Barang &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/distribusi_bu/vdistribusi_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Distribusi Barang ";
        $data["breadcrumb"]             = "<li class='active'><strong>Distribusi Barang</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'distribusi/distribusi_obat/'.$current;
        $config['total_rows']           = $this->Mdistribusi_bu->getdistribusi_bu()->num_rows();
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
        $data["q3"]                     = $this->Mdistribusi_bu->getdatadistribusi_bu($config['per_page'],$from);
        $data["d1"]                 = $this->Mdistribusi_bu->getruangan();
        $data["d2"]                 = $this->Mdistribusi_bu->getpoliklinik();        
        $this->load->view('template',$data);
    }
    function formdistribusi_bu($no_distribusi=NULL){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Distribusi Barang &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Distribusi Barang ";
        $data["breadcrumb"]         = "<li class='active'><strong>Distribusi Barang</strong></li>";
        $data["content"]            = "barang_umum/distribusi_bu/vformdistribusi_bu";
        $data["no_distribusi"]      = $no_distribusi;
        $data["q1"]                 = $this->Mdistribusi_bu->getdistribusibu_detail($no_distribusi);
        $data["d1"]                 = $this->Mdistribusi_bu->getruangan();
        $data["d2"]                 = $this->Mdistribusi_bu->getpoliklinik();
        $data["q"]                  = $this->Mdistribusi_bu->getitem_distribusi($no_distribusi);
        // $data["sd"]                 = $this->Mdistribusi_bu->getstok_depo($no_distribusi);
        $this->load->view('template',$data);
    }
    function simpandistribusi_bu($action){
        $no_distribusi      = "DS-".date("YmhHis");
        $no_distribusi_edit = $this->input->post("no_distribusi");
        $message = $this->Mdistribusi_bu->simpandistribusi_bu($action,$no_distribusi);
        $this->session->set_flashdata("message",$message);
        if ($action=="simpan") {
            redirect("distribusi_bu/formdistribusi_bu/".$no_distribusi);
        } else {
            redirect("distribusi_bu/formdistribusi_bu/".$no_distribusi_edit);
        }   
    }
    function getbu(){
        echo json_encode($this->Mdistribusi_bu->getbu());
    }
    function simpanitem_distribusi(){
        $this->Mdistribusi_bu->simpanitem_distribusi();
    }
    function changedata_distribusi(){
        $this->Mdistribusi_bu->changedata_distribusi();
    }
    function hapusitem_distribusi($no_distribusi,$kode,$depo_tujuan){
        $message = $this->Mdistribusi_bu->hapusitem_distribusi($no_distribusi,$kode,$depo_tujuan);
        $this->session->set_flashdata("message",$message);
        redirect("distribusi_bu/formdistribusi_bu/".$no_distribusi);
    }
    function hapusdistribusi_obat($no_distribusi){
        $message = $this->Mdistribusi_bu->hapusdistribusi_obat($no_distribusi);
        $this->session->set_flashdata("message",$message);
        redirect("distribusi_bu/distribusi");
    }
    function search_distribusi(){
        $this->session->set_userdata("cari_distribusi", $this->input->post("cari_distribusi"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("depo_tujuan", $this->input->post("depo_tujuan"));
    }
    function reset_distribusi(){
        $this->session->unset_userdata("cari_distribusi");
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("depo_asal");
        $this->session->unset_userdata("depo_tujuan"); 
        redirect('distribusi_bu/distribusi');
    }
    function inventaris($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Inventaris &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/inventaris/vinventaris";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "Inventaris ";
        $data["breadcrumb"]             = "<li class='active'><strong>Inventaris</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'distribusi/distribusi_obat/'.$current;
        $config['total_rows']           = $this->Mdistribusi_bu->getinventaris()->num_rows();
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
        $data["q3"]                     = $this->Mdistribusi_bu->getinventaris_data($config['per_page'],$from);
        $data["d1"]                     = $this->Mdistribusi_bu->getruangan();
        $data["d2"]                     = $this->Mdistribusi_bu->getpoliklinik();        
        $this->load->view('template',$data);
    }
    function search_inventariS(){
        $this->session->set_userdata("cari_distribusi", $this->input->post("cari_distribusi"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("depo_tujuan", $this->input->post("depo_tujuan"));
    }
    function reset_inventaris(){
        $this->session->unset_userdata("cari_distribusi");
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("depo_asal");
        $this->session->unset_userdata("depo_tujuan"); 
        redirect('distribusi_bu/inventaris');
    }
    function formubah_status($no_distribusi,$kode_bu){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Ubah Status &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi_bu";
        $data["title_header"]       = "Ubah Status ";
        $data["breadcrumb"]         = "<li class='active'><strong>Ubah Status</strong></li>";
        $data["content"]            = "barang_umum/inventaris/vformubah_status";
        $data["no_distribusi"]      = $no_distribusi;
        $data["kode_bu"]            = $kode_bu;
        $data["sb"]                 = $this->Mdistribusi_bu->getstatus_bu();
        $data["q"]                  = $this->Mdistribusi_bu->getinventaris_detail($no_distribusi,$kode_bu);
        $this->load->view('template',$data);
    }
    function simpanubahstatus(){
        $message = $this->Mdistribusi_bu->simpanubahstatus();
        $this->session->set_flashdata("message",$message);
        redirect("distribusi_bu/inventaris/".$no_distribusi);   
    }
    function history($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "History &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/inventaris/vhistory";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi_bu";
        $data["current"]                = $current;
        $data["title_header"]           = "History ";
        $data["breadcrumb"]             = "<li class='active'><strong>History</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'distribusi/distribusi_obat/'.$current;
        $config['total_rows']           = $this->Mdistribusi_bu->gethistory()->num_rows();
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
        $data["q3"]                     = $this->Mdistribusi_bu->gethistory_data($config['per_page'],$from);
        $data["d1"]                     = $this->Mdistribusi_bu->getruangan();
        $data["d2"]                     = $this->Mdistribusi_bu->getpoliklinik();        
        $this->load->view('template',$data);
    }
    function search_history(){
        $this->session->set_userdata("cari_distribusi", $this->input->post("cari_distribusi"));
        $this->session->set_userdata("tgl1", $this->input->post("tgl1"));
        $this->session->set_userdata("tgl2", $this->input->post("tgl2"));
        $this->session->set_userdata("depo_tujuan", $this->input->post("depo_tujuan"));
    }
    function reset_history(){
        $this->session->unset_userdata("cari_distribusi");
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        $this->session->unset_userdata("depo_asal");
        $this->session->unset_userdata("depo_tujuan"); 
        redirect('distribusi_bu/history');
    }
}
?>