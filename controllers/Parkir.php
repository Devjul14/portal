<?php
class Parkir extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mparkir');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index($current=0,$from=0){
        $data["title"] = "Parkir || RS CIREMAI";
        $data['judul'] = "Parkir";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "kasir/vparkir";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="kasir";
        $data["current"] = $current;
        $data["title_header"] = "Parkir ";
        $data["breadcrumb"] = "<li class='active'><strong>Parkir</strong></li>";     
        $this->load->library('pagination');
        $config['base_url'] = base_url().'parkir/index/'.$current;
        $config['total_rows'] = $this->Mparkir->getjumlahparkir();
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
        $this->pagination->initialize($config);
        $data["q"] =$this->Mparkir->getparkir($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function formparkir($id=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="kasir";
        $data["id"] = $id;
        $data["title"]        = "Form Parkir || RS CIREMAI";
        $data["title_header"] = "Form Parkir";
        $data["content"] = "kasir/vformparkir";
        $data["breadcrumb"]   = "<li class='active'><strong>Form Parkir</strong></li>";
        $data["q"] = $this->Mparkir->getparkir_detail($id);
        $this->load->view('template',$data);
    }
    function simpan($action){
        $message = $this->Mparkir->simpan($action);
        $this->session->set_flashdata("message",$message);
        redirect("parkir");
    }
    function hapus($id){
        $message = $this->Mparkir->hapus($id);
        $this->session->set_flashdata("message",$message);
        redirect("parkir");
    }
    function search_parkir(){
        $this->session->set_userdata("tgl1",$this->input->post("tgl1"));
        $this->session->set_userdata("tgl2",$this->input->post("tgl2"));
    }
    function reset_parkir(){
        $this->session->unset_userdata("tgl1");
        $this->session->unset_userdata("tgl2");
        redirect("parkir");
    }
    function rekap($tgl1="",$tgl2=""){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="kasir";
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["title"]        = "Rekap || RS CIREMAI";
        $data["title_header"] = "Rekap";
        $data["content"] = "kasir/vrekap_kasir";
        $data["breadcrumb"]   = "<li class='active'><strong>Rekap</strong></li>";
        $data["q"] = $this->Mparkir->rekap($tgl1,$tgl2);
        $this->load->view('template',$data);
    }
    function simpantemprekap(){
        $this->session->set_userdata("hasil",$this->input->post("hasil"));
    }
    function cetak_rekap($tgl1="",$tgl2=""){
        $tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["title"]        = "Rekap Harian || RS CIREMAI";
        $data["title_header"] = "Rekap Harian";
        $data["h"] = json_decode($this->session->userdata("hasil"));
        $this->load->view('kasir/vcetak_rekap',$data);
    }
}
?>