<?php
class Master_bu extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mmaster_bu');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function supplier($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Supplier Barang Umum";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/supplier/vsupplier";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master_bu";
        $data["title_header"]           = "Supplier Barang Umum";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Supplier Barang Umum</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'master_bu/supplier/'.$current;
        $config['total_rows']           = $this->Mmaster_bu->getsupplier_bu()->num_rows();
        $config['per_page']             = 10;
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
        $from = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mmaster_bu->getdata_supplier_bu($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_supplier(){
        $this->session->unset_userdata('cari_supplier');
        redirect("master_bu/supplier");
    }
    function cari_supplier(){
        $this->session->set_userdata("cari_supplier",$this->input->post("cari_supplier"));
    }
    function formsupplier($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Supplier Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master_bu";
        $data["title_header"]       = "Supplier Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Supplier Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/supplier/vformsupplier";
        $data["row"]                = $this->Mmaster_bu->getsupplierbu_detail($kode);
        $this->load->view('template',$data);
    }
    function simpansupplier($action){
        $message = $this->Mmaster_bu->simpansupplier($action);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/supplier");
    }
    function hapussupplier($kode){
        $message = $this->Mmaster_bu->hapussupplier($kode);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/supplier");
    }
    function kategori($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Kategori Barang Umum";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/kategori/vkategori";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master_bu";
        $data["title_header"]           = "Kategori Barang Umum";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Kategori Barang Umum</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'master_bu/kategori/'.$current;
        $config['total_rows']           = $this->Mmaster_bu->getkategori()->num_rows();
        $config['per_page']             = 10;
        $config['full_tag_open']        = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']       = '</ul>';
        $config['cur_tag_open']         = '<li class=active><a>';
        $config['cur_tag_close']        = '</a></li>';
        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';
        $config['num_links']            = 4;
        $config['uri_segment']          = 4;
        $from = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mmaster_bu->getdata_kategori($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_kategori(){
        $this->session->unset_userdata('cari_kategori');
        redirect("master_bu/kategori");
    }
    function cari_kategori(){
        $this->session->set_userdata("cari_kategori",$this->input->post("cari_kategori"));
    }
    function formkategori($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Kategori Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master_bu";
        $data["title_header"]       = "Kategori Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Kategori Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/kategori/vformkategori";
        $data["row"]                = $this->Mmaster_bu->getkategori_detail($kode);
        $this->load->view('template',$data);
    }
    function simpankategori($action){
        $message = $this->Mmaster_bu->simpankategori($action);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/kategori");
    }
    function hapuskategori($kode){
        $message = $this->Mmaster_bu->hapuskategori($kode);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/kategori");
    }
    function satuan_besar($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Satuan Besar";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/satuan_besar/vsatuan";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master_bu";
        $data["title_header"]           = "Satuan Besar";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Satuan Besar</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'master_bu/satuan/'.$current;
        $config['total_rows']           = $this->Mmaster_bu->getsatuan_besar()->num_rows();
        $config['per_page']             = 10;
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
        $from = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mmaster_bu->getdata_satuan_besar($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_satuan_besar(){
        $this->session->unset_userdata('cari_satuan_besar');
        redirect("master_bu/satuan");
    }
    function cari_satuan_besar(){
        $this->session->set_userdata("cari_satuan_besar",$this->input->post("cari_satuan_besar"));
    }
    function formsatuan_besar($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Satuan Besar &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master_bu";
        $data["title_header"]       = "Satuan Besar ";
        $data["breadcrumb"]         = "<li class='active'><strong>Satuan Besar</strong></li>";
        $data["content"]            = "barang_umum/satuan_besar/vformsatuan";
        $data["row"]                = $this->Mmaster_bu->getsatuanbesar_detail($kode);
        $this->load->view('template',$data);
    }
    function simpansatuan_besar($action){
        $message = $this->Mmaster_bu->simpansatuan_besar($action);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/satuan_besar");
    }
    function hapussatuan_besar($kode){
        $message = $this->Mmaster_bu->hapussatuan_besar($kode);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/satuan_besar");
    }
    function satuan_kecil($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Satuan Kecil";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/satuan_kecil/vsatuan_kecil";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master_bu";
        $data["title_header"]           = "Satuan Kecil";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Satuan Kecil</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'master_bu/satuan_kecil/'.$current;
        $config['total_rows']           = $this->Mmaster_bu->getsatuan_kecil()->num_rows();
        $config['per_page']             = 10;
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
        $from = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mmaster_bu->getdata_satuankecil($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_satuankecil(){
        $this->session->unset_userdata('cari_satuankecil');
        redirect("master_bu/satuan_kecil");
    }
    function cari_satuankecil(){
        $this->session->set_userdata("cari_satuankecil",$this->input->post("cari_satuankecil"));
    }
    function formsatuan_kecil($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Satuan Kecil &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master_bu";
        $data["title_header"]       = "Satuan Kecil ";
        $data["breadcrumb"]         = "<li class='active'><strong>Satuan Kecil</strong></li>";
        $data["content"]            = "barang_umum/satuan_kecil/vformsatuan_kecil";
        $data["row"]                = $this->Mmaster_bu->getsatuankecil_detail($kode);
        $this->load->view('template',$data);
    }
    function simpansatuan_kecil($action){
        $message = $this->Mmaster_bu->simpansatuan_kecil($action);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/satuan_kecil");
    }
    function hapussatuan_kecil($kode){
        $message = $this->Mmaster_bu->hapussatuan_kecil($kode);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/satuan_kecil");
    }
    function barang_umum($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Barang Umum";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/master_bu/vmaster_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master_bu";
        $data["title_header"]           = "Barang Umum";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Barang Umum</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'master_bu/barang_umum/'.$current;
        $config['total_rows']           = $this->Mmaster_bu->getbarang_umum()->num_rows();
        $config['per_page']             = 10;
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
        $from = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mmaster_bu->getdata_barangumum($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_barang_umum(){
        $this->session->unset_userdata('cari_barang_umum');
        redirect("master_bu/barang_umum");
    }
    function cari_barang_umum(){
        $this->session->set_userdata("cari_barang_umum",$this->input->post("cari_barang_umum"));
    }
    function formbarang_umum($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master_bu";
        $data["title_header"]       = "Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/master_bu/vformmaster_bu";
        $data["row"]                = $this->Mmaster_bu->getbarangumum_detail($kode);
        $data["k"]                  = $this->Mmaster_bu->getkategori();
        $data["sb"]                 = $this->Mmaster_bu->getsatuan_besar();
        $data["sk"]                 = $this->Mmaster_bu->getsatuan_kecil();
        $this->load->view('template',$data);
    }
    function simpanbarang_umum($action){
        $message = $this->Mmaster_bu->simpanbarang_umum($action);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/barang_umum");
    }
    function hapusbarang_umum($kode){
        $message = $this->Mmaster_bu->hapusbarang_umum($kode);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/barang_umum");
    }
    function depo_bu($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Depo Barang Umum";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/depo_bu/vdepo_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master_bu";
        $data["title_header"]           = "Depo Barang Umum";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Depo Barang Umum</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'master_bu/depo_bu/'.$current;
        $config['total_rows']           = $this->Mmaster_bu->getdepo_bu()->num_rows();
        $config['per_page']             = 10;
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
        $from = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mmaster_bu->getdatadepo_bu($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_depo(){
        $this->session->unset_userdata('cari_depo');
        redirect("master_bu/depo_bu");
    }
    function cari_depo(){
        $this->session->set_userdata("cari_depo",$this->input->post("cari_depo"));
    }
    function formdepo_bu($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Depo Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master_bu";
        $data["title_header"]       = "Depo Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Depo Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/depo_bu/vformdepo_bu";
        $data["row"]                = $this->Mmaster_bu->getdepobu_detail($kode);
        $this->load->view('template',$data);
    }
    function simpandepo_bu($action){
        $message = $this->Mmaster_bu->simpandepo_bu($action);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/depo_bu");
    }
    function hapusdepo_bu($kode){
        $message = $this->Mmaster_bu->hapusdepo_bu($kode);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/depo_bu");
    }
    function status_bu($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Status Barang Umum";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "barang_umum/status_bu/vstatus_bu";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master_bu";
        $data["title_header"]           = "Status Barang Umum";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Status Barang Umum</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'master_bu/status_bu/'.$current;
        $config['total_rows']           = $this->Mmaster_bu->getstatus_bu()->num_rows();
        $config['per_page']             = 10;
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
        $from = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mmaster_bu->getdata_status_bu($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_status(){
        $this->session->unset_userdata('cari_status');
        redirect("master_bu/status_bu");
    }
    function cari_status(){
        $this->session->set_userdata("cari_status",$this->input->post("cari_status"));
    }
    function formstatus_bu($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Status Barang Umum &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master_bu";
        $data["title_header"]       = "Status Barang Umum ";
        $data["breadcrumb"]         = "<li class='active'><strong>Status Barang Umum</strong></li>";
        $data["content"]            = "barang_umum/status_bu/vformstatus_bu";
        $data["row"]                = $this->Mmaster_bu->getstatus_detail($kode);
        $this->load->view('template',$data);
    }
    function simpanstatus_bu($action){
        $message = $this->Mmaster_bu->simpanstatus_bu($action);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/status_bu");
    }
    function hapusstatus_bu($kode){
        $message = $this->Mmaster_bu->hapusstatus_bu($kode);
        $this->session->set_flashdata("message",$message);
        redirect("master_bu/status_bu");
    }
}
?>