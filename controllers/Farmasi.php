<?php
class Farmasi extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        $this->load->Model('Mfarmasi');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index(){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Home &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "dashboard";
        $data["title_header"]       = "Home ";
        $data["breadcrumb"]         = "<li class='active'><strong>Home</strong></li>";
        $data["content"]            = "farmasi/vhomefarmasi";
        $this->load->view('template',$data);
    }
    function master($current=0,$from=0){
		$data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Master Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["content"] = "farmasi/vobat";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="farmasi";
        $data["current"] = $current;
        $data["title_header"] = "Master Obat ";
        $data["p"] = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"] = "<li class='active'><strong>Master Obat</strong></li>";        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'farmasi/master/'.$current;
        $config['total_rows'] = $this->Mfarmasi->getobat_master()->num_rows();
        $config['per_page'] = 50;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class=active><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $from = $this->uri->segment(4);
        $data["from"] = $from;
        $this->pagination->initialize($config);
        $data["q3"] =$this->Mfarmasi->getobat_m($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function pembelian($current=0,$from=0){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Pembelian Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["content"] = "farmasi/vpembelian";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="farmasi";
        $data["current"] = $current;
        $data["title_header"] = "Pembelian Obat ";
        $data["p"] = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"] = "<li class='active'><strong>Pembelian Obat</strong></li>";        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'farmasi/master/'.$current;
        $config['total_rows'] = $this->Mfarmasi->getpembelian_master()->num_rows();
        $config['per_page'] = 50;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class=active><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $from = $this->uri->segment(4);
        $data["from"] = $from;
        $this->pagination->initialize($config);
        $data["q3"] =$this->Mfarmasi->getpembelian($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function form($kode=null){
        $data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
        $data['judul'] = "Master Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]="farmasi";
        $data["title_header"] = "Master Obat ";
        $data["breadcrumb"] = "<li class='active'>Barang</li>";
        $data["content"] = "farmasi/vformobat";
        $data["title_toolbar"] = "Barang";
        $data["row"] = $this->Mfarmasi->getobat_detail($kode);
        // $data["r_stok"] = $this->Mbarang->getstokdetail($id);
        $data["q1"] = $this->Mfarmasi->getsatuan();
        $data["q2"] = $this->Mfarmasi->getsatuan_besar();
        // $data["q3"] = $this->Mbarang->getsatuanjual();
        // $data["q11"] = $this->Mbarang->getkategoribarang();
        $this->load->view('template',$data);
    }
    function formpembelian($kode=null){
        $data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
        $data['judul'] = "Form Pembelian Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["kode"] = $kode;
        $data["menu"]="farmasi";
        $data["title_header"] = "Form Pembelian Obat ";
        $data["breadcrumb"] = "<li class='active'>Barang</li>";
        $data["content"] = "farmasi/vformpembelian";
        $data["title_toolbar"] = "Barang";
        $data["row"] = $this->Mfarmasi->getobat_detail($kode);
        $data["k"] = $this->Mfarmasi->getitem_pembelian($kode);
        $data["q1"] = $this->Mfarmasi->getsatuan();
        $data["q2"] = $this->Mfarmasi->getsatuan_besar();
        $data["t"]  = $this->Mfarmasi->getobat();
        $data["j"]              = $this->Mfarmasi->getitem_pembelian($kode);
        // $data["q3"] = $this->Mbarang->getsatuanjual();
        // $data["q11"] = $this->Mbarang->getkategoribarang();
        $this->load->view('template',$data);
    }
    function search_obat(){
        $message = $this->input->post("cari_obat");
        $this->session->set_userdata("cari_obat",$message);
    }
    function resetmaster_obat(){
        $this->session->unset_userdata("cari_obat");
        redirect('farmasi/masterobat');
    }
    function search(){
        $this->session->set_flashdata("cari_nama",$this->input->post("cari_nama"));
        $this->session->set_flashdata("tgl1",$this->input->post("tgl1"));
        $this->session->set_flashdata("tgl2",$this->input->post("tgl2"));
    }
    function getcaripasien_inap(){
        $this->session->set_flashdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_flashdata("nama",$this->input->post("cari_nama"));
        $this->session->set_flashdata("no_reg",$this->input->post("cari_noreg"));
    }
    function search_ralan(){
        $this->session->set_userdata('poli_kode',$this->input->post("poli_kode"));
        $this->session->set_userdata('poliklinik',$this->input->post("poliklinik"));
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
        $this->session->set_userdata('dokter',$this->input->post("dokter"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function reset(){
        $this->session->unset_userdata('cari_obat');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        redirect("farmasi/master");
    }
    function viewapotek_ralan($no_pasien,$no_reg){
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek Rawat Jalan || RS CIREMAI";
        $data["title_header"] = "Apotek Rawat Jalan";
        $data["content"] = "apotek/vviewapotek_ralan";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek Rawat Jalan</strong></li>";
        $data["row"]              = $this->Mapotek->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek->getapotek($no_reg);
        $data["q"]              = $this->Mapotek->getapotek_detail($no_reg);
        $data["t"]  = $this->Mapotek->getobat();
        $this->load->view('template',$data);
    }
    function viewapotek_inap($no_pasien,$no_reg){
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Apotek Rawat Inap";
        $data["content"] = "apotek/vviewapotek_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek Rawat Inap</strong></li>";
        $data["row"]              = $this->Mapotek->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek->getapotek_inap($no_reg);
        $data["j"]              = $this->Mapotek->getitem_pembelian($no_reg);
        $data["q"]              = $this->Mapotek->getapotek_detail($no_reg);
        $data["t"]  = $this->Mapotek->getobat();
        $this->load->view('template',$data);
    }
    function addobat(){
        $this->Mfarmasi->addobat();
        redirect("farmasi/formpembelian/".$this->input->post("kode"));
    }
    function addobat_inap(){
        $this->Mapotek->addobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil ditambahkan");
        redirect("apotek/viewapotek_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function changedata(){
        $this->Mapotek->changedata();
    }
    function changedata_inap(){
        $this->Mapotek->changedata_inap();
    }
    function hapusobat($kode){
        $this->Mfarmasi->hapusobat($kode);
        $this->session->set_flashdata("message","danger-Obat berhasil dihapus");
        redirect("farmasi/master");
    }
    function hapusobat_inap(){
        $this->Mapotek->hapusobat_inap();
        $this->session->set_flashdata("message","danger-Obat berhasil dihapus");
    }

    function simpanobat($action){
        $this->Mfarmasi->simpanobat($action);
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
        redirect("farmasi/master");
    }
    function simpanobat_inap(){
        $this->Mapotek->simpanobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
    }
    function list_igd($current=0,$from=0){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Pasien IGD &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["content"] = "apotek/vlistigd_apotek";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="apotek";
        $data["current"] = $current;
        $data["title_header"] = "Pasien IGD ";
        $data["p"] = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"] = "<li class='active'><strong>Pasien IGD</strong></li>";        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'apotek/list_igd/'.$current;
        $config['total_rows'] = $this->Mpendaftaran->getpasien_rawatjalan()->num_rows();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class=active><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $from = $this->uri->segment(4);
        $data["from"] = $from;
        $data["igd"] = true;
        $this->pagination->initialize($config);
        $data["q3"] =$this->Mapotek->getpasien_ralan(true,$config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function viewapotek_igd($no_pasien,$no_reg){
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek IGD || RS CIREMAI";
        $data["title_header"] = "Apotek IGD";
        $data["content"] = "apotek/vviewapotek_igd";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek IGD</strong></li>";
        $data["row"]              = $this->Mapotek->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek->getapotek($no_reg);
        $data["q"]              = $this->Mapotek->getapotek_detail($no_reg);
        $data["t"]  = $this->Mapotek->getobat();
        $this->load->view('template',$data);
    }
    function cetak($no_pasien, $no_reg){
        $data["no_reg"] = $no_reg;
        $data["q"]          = $this->Mapotek->getcetak($no_pasien, $no_reg);
        $data["q1"]          = $this->Mapotek->getapotek($no_reg);
        // $data["nota"]          = $this->Mapotek->getnota();
        $this->load->view('apotek/vcetakapotek',$data);    
    }
    function cetak_inap($no_pasien, $no_reg,$tgl1,$tgl2){
        $data["no_reg"] = $no_reg;
        $data["q"]          = $this->Mapotek->getcetak_inap($no_pasien, $no_reg);
        $data["q1"]          = $this->Mapotek->getapotek_inap($no_reg,$tgl1,$tgl2);
        // $data["nota"]          = $this->Mapotek->getnota_inap();
        $this->load->view('apotek/vcetakapotek_inap',$data);    
    }
    function industri($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Industri Farmasi";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/industri/vindustri";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Industri Farmasi";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Industri Farmasi</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/industri/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getindustrifarmasi()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_industri($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_industri(){
        $this->session->unset_userdata('cari_industri');
        redirect("farmasi/industri");
    }
    function cari_industri(){
        $this->session->set_userdata("cari_industri",$this->input->post("cari_industri"));
    }
    function formindustri($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Industri Farmasi &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Industri Farmasi ";
        $data["breadcrumb"]         = "<li class='active'><strong>Industri Farmasi</strong></li>";
        $data["content"]            = "farmasi/industri/vformindustri";
        $data["row"]                = $this->Mfarmasi->getindustrifarmasi_detail($kode);
        $this->load->view('template',$data);
    }
    function simpanindustri($action){
        $message = $this->Mfarmasi->simpanindustri($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/industri");
    }
    function hapusindustri($kode){
        $message = $this->Mfarmasi->hapusindustri($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/industri");
    }
    function masterobat($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Master Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/master_obat/vobat";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["current"]                = $current;
        $data["title_header"]           = "Master Obat ";
        $data["p"]                      = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"]             = "<li class='active'><strong>Master Obat</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/master/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getmaster_obat()->num_rows();
        $config['per_page']             = 50;
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
        $data["q3"]                     = $this->Mfarmasi->getdatamaster_obat($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function formmaster_obat($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Master Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Master Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Master Obat</strong></li>";
        $data["content"]            = "farmasi/master_obat/vformobat";
        $data["row"]                = $this->Mfarmasi->getmasterobat_detail($kode);
        $data["sb"]                 = $this->Mfarmasi->getsatuanobat_besar();
        $data["sk"]                 = $this->Mfarmasi->getsatuanobat_kecil();
        $data["k"]                  = $this->Mfarmasi->getkategoriobat();
        $data["g"]                  = $this->Mfarmasi->getgolonganobat();
        $data["j"]                  = $this->Mfarmasi->getjenisobat();
        $data["ind"]                = $this->Mfarmasi->getindustrifarmasi();
        $data["l"]                  = $this->Mfarmasi->getlokasi_obat();
        $data["kd_obat"]            = $this->Mfarmasi->getkode_obat();
        $data["klas"]               = $this->Mfarmasi->getklasifikasiobat();
        $this->load->view('template',$data);
    }
    function simpanmaster_obat($action){
        $message = $this->Mfarmasi->simpanmaster_obat($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/masterobat");
    }
    function hapusmaster_obat($kode){
        $message = $this->Mfarmasi->hapusmaster_obat($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/masterobat");
    }
    function supplier($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Supplier Farmasi";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/supplier/vsupplier";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Supplier Farmasi";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Supplier Farmasi</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/supplier/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getsupplierfarmasi()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_supplier($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_supplier(){
        $this->session->unset_userdata('cari_supplier');
        redirect("farmasi/supplier");
    }
    function cari_supplier(){
        $this->session->set_userdata("cari_supplier",$this->input->post("cari_supplier"));
    }
    function formsupplier($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Supplier Farmasi &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Supplier Farmasi ";
        $data["breadcrumb"]         = "<li class='active'><strong>Supplier Farmasi</strong></li>";
        $data["content"]            = "farmasi/supplier/vformsupplier";
        $data["row"]                = $this->Mfarmasi->getsupplierfarmasi_detail($kode);
        $this->load->view('template',$data);
    }
    function simpansupplier($action){
        $message = $this->Mfarmasi->simpansupplier($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/supplier");
    }
    function hapussupplier($kode){
        $message = $this->Mfarmasi->hapussupplier($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/supplier");
    }

    function kategori($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Kategori Obat";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/kategori/vkategori";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Kategori Obat";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Kategori Obat</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/kategori/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getkategoriobat()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_kategori($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_kategori(){
        $this->session->unset_userdata('cari_kategori');
        redirect("farmasi/kategori");
    }
    function cari_kategori(){
        $this->session->set_userdata("cari_kategori",$this->input->post("cari_kategori"));
    }
    function formkategori($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Kategori Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Kategori Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Kategori Obat</strong></li>";
        $data["content"]            = "farmasi/kategori/vformkategori";
        $data["row"]                = $this->Mfarmasi->getkategoriobat_detail($kode);
        $this->load->view('template',$data);
    }
    function simpankategori($action){
        $message = $this->Mfarmasi->simpankategori($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/kategori");
    }
    function hapuskategori($kode){
        $message = $this->Mfarmasi->hapuskategori($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/kategori");
    }

    function satuan($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Satuan Besar";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/satuan/vsatuan";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Satuan Besar";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Satuan Besar</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/satuan/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getsatuanobat()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_satuan($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_satuan(){
        $this->session->unset_userdata('cari_satuan');
        redirect("farmasi/satuan");
    }
    function cari_satuan(){
        $this->session->set_userdata("cari_satuan",$this->input->post("cari_satuan"));
    }
    function formsatuan($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Satuan Besar &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Satuan Besar ";
        $data["breadcrumb"]         = "<li class='active'><strong>Satuan Besar</strong></li>";
        $data["content"]            = "farmasi/satuan/vformsatuan";
        $data["row"]                = $this->Mfarmasi->getsatuanobat_detail($kode);
        $this->load->view('template',$data);
    }
    function simpansatuan($action){
        $message = $this->Mfarmasi->simpansatuan($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/satuan");
    }
    function hapussatuan($kode){
        $message = $this->Mfarmasi->hapussatuan($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/satuan");
    }

    function satuan_kecil($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Satuan Kecil";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/satuan/vsatuan_kecil";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Satuan Kecil";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Satuan Kecil</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/satuan_kecil/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getsatuan_kecil()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_satuankecil($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_satuankecil(){
        $this->session->unset_userdata('cari_satuankecil');
        redirect("farmasi/satuan_kecil");
    }
    function cari_satuankecil(){
        $this->session->set_userdata("cari_satuankecil",$this->input->post("cari_satuankecil"));
    }
    function formsatuan_kecil($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Satuan Kecil &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Satuan Kecil ";
        $data["breadcrumb"]         = "<li class='active'><strong>Satuan Kecil</strong></li>";
        $data["content"]            = "farmasi/satuan/vformsatuan_kecil";
        $data["row"]                = $this->Mfarmasi->getsatuankecil_detail($kode);
        $this->load->view('template',$data);
    }
    function simpansatuan_kecil($action){
        $message = $this->Mfarmasi->simpansatuan_kecil($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/satuan_kecil");
    }
    function hapussatuan_kecil($kode){
        $message = $this->Mfarmasi->hapussatuan_kecil($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/satuan_kecil");
    }

    function jenis($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Jenis Obat";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/jenis/vjenis";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Jenis Obat";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Jenis Obat</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/jenis/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getjenisobat()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_jenis($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_jenis(){
        $this->session->unset_userdata('cari_jenis');
        redirect("farmasi/jenis");
    }
    function cari_jenis(){
        $this->session->set_userdata("cari_jenis",$this->input->post("cari_jenis"));
    }
    function formjenis($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Jenis Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Jenis Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Jenis Obat</strong></li>";
        $data["content"]            = "farmasi/jenis/vformjenis";
        $data["row"]                = $this->Mfarmasi->getjenisobat_detail($kode);
        $this->load->view('template',$data);
    }
    function simpanjenis($action){
        $message = $this->Mfarmasi->simpanjenis($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/jenis");
    }
    function hapusjenis($kode){
        $message = $this->Mfarmasi->hapusjenis($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/jenis");
    }

    function golongan($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Golongan Obat";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/golongan/vgolongan";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Golongan Obat";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Golongan Obat</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/golongan/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getgolonganobat()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_golongan($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_golongan(){
        $this->session->unset_userdata('cari_golongan');
        redirect("farmasi/golongan");
    }
    function cari_golongan(){
        $this->session->set_userdata("cari_golongan",$this->input->post("cari_golongan"));
    }
    function formgolongan($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Golongan Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Golongan Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Golongan Obat</strong></li>";
        $data["content"]            = "farmasi/golongan/vformgolongan";
        $data["row"]                = $this->Mfarmasi->getgolonganobat_detail($kode);
        $this->load->view('template',$data);
    }
    function simpangolongan($action){
        $message = $this->Mfarmasi->simpangolongan($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/golongan");
    }
    function hapusgolongan($kode){
        $message = $this->Mfarmasi->hapusgolongan($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/golongan");
    }

    function metode_racik($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Metode Racik";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/metode_racik/vmetode_racik";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Metode Racik";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Metode Racik</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/metode_racik/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getmetode_racik()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_metoderacik($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_metoderacik(){
        $this->session->unset_userdata('cari_metoderacik');
        redirect("farmasi/metode_racik");
    }
    function cari_metoderacik(){
        $this->session->set_userdata("cari_metoderacik",$this->input->post("cari_metoderacik"));
    }
    function formmetode_racik($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Metode Racik &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Metode Racik ";
        $data["breadcrumb"]         = "<li class='active'><strong>Metode Racik</strong></li>";
        $data["content"]            = "farmasi/metode_racik/vformmetode_racik";
        $data["row"]                = $this->Mfarmasi->getmetoderacik_detail($kode);
        $this->load->view('template',$data);
    }
    function simpanmetode_racik($action){
        $message = $this->Mfarmasi->simpanmetode_racik($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/metode_racik");
    }
    function hapusmetode_racik($kode){
        $message = $this->Mfarmasi->hapusmetode_racik($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/metode_racik");
    }
    function klasifikasi($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Klasifikasi Obat";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/klasifikasi/vklasifikasi";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Klasifikasi Obat";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Klasifikasi Obat</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/klasifikasi/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getklasifikasiobat()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_klasifikasi($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function simpanklasifikasi($action){
        $message = $this->Mfarmasi->simpanklasifikasi($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/klasifikasi");
    }
    function hapusklasifikasi($kode){
        $message = $this->Mfarmasi->hapusklasifikasi($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/klasifikasi");
    }
    function reset_klasifikasi(){
        $this->session->unset_userdata('cari_klasifikasi');
        redirect("farmasi/klasifikasi");
    }
    function cari_klasifikasi(){
        $this->session->set_userdata("cari_kategori",$this->input->post("cari_klasifikasi"));
    }
    function formklasifikasi($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Klasifikasi Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Klasifikasi Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Klasifikasi Obat</strong></li>";
        $data["content"]            = "farmasi/klasifikasi/vformklasifikasi";
        $data["row"]                = $this->Mfarmasi->getklasifikasi_detail($kode);
        $this->load->view('template',$data);
    }
    function depo($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Depo Obat";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/depo/vdepo";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "master";
        $data["title_header"]           = "Depo Obat";
        $data["current"]                = $current;
        $data["breadcrumb"]             = "<li class='active'><strong>Depo Obat</strong></li>";
        $this->load->library('pagination');
        $config['base_url']             = base_url().'farmasi/depo/'.$current;
        $config['total_rows']           = $this->Mfarmasi->getdepoobat()->num_rows();
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
        $data["q3"]                     = $this->Mfarmasi->getdata_depo($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function reset_depo(){
        $this->session->unset_userdata('cari_depo');
        redirect("farmasi/depo");
    }
    function cari_depo(){
        $this->session->set_userdata("cari_depo",$this->input->post("cari_depo"));
    }
    function formdepo($kode=null){
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Depo Obat &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "master";
        $data["title_header"]       = "Depo Obat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Depo Obat</strong></li>";
        $data["content"]            = "farmasi/depo/vformdepo";
        $data["row"]                = $this->Mfarmasi->getdepo_detail($kode);
        $this->load->view('template',$data);
    }
    function simpandepo($action){
        $message = $this->Mfarmasi->simpandepo($action);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/depo");
    }
    function hapusdepo($kode){
        $message = $this->Mfarmasi->hapusdepo($kode);
        $this->session->set_flashdata("message",$message);
        redirect("farmasi/depo");
    }
}
?>