<?php
class Pinjam extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mlab');
		$this->load->Model('Mradiologi');
		$this->load->Model('Mkasir');
		$this->load->Model('Mpa');
		$this->load->Model('Mgizi');
		$this->load->Model('Mpinjam');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
	function index($current=0,$from=0){
		$data["title"] = $this->session->userdata('status_user');
		$data['judul'] = "Identitas Pasien&nbsp;&nbsp;&nbsp;";
		$data["vmenu"] = "pendaftaran/vmenu";
		$data["content"] = "pendaftaran/vpasienbaru";
		$data["username"] = $this->session->userdata('nama_user');
	    $data['menu']="user";
	    $data["current"] = $current;
	    $data["title_header"] = "Identitas Pasien";
	    $data["breadcrumb"] = "<li class='active'><strong>Identitas Pasien</strong></li>";		
		$this->load->library('pagination');
        $config['base_url'] = base_url().'pendaftaran/index/'.$current;
        $config['total_rows'] = $this->Mpendaftaran->getjumlahpasien();
        $config['per_page'] = 20;
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
        $config['num_links'] = 1;
        $config['uri_segment'] = 4;
        $from = $this->uri->segment(4);
        $data["from"] = $from;
        $this->pagination->initialize($config);
		$data["q3"] =$this->Mpendaftaran->getpasien($config['per_page'],$from);
		$this->load->view('template',$data);
    }
    function getpasien_detail(){
        $no_pasien = $this->input->post("no_pasien");
        echo json_encode($this->Mpinjam->getpinjam($no_pasien));
    }
	function simpan_pinjam(){
		$message = $this->Mpinjam->simpanpinjam();
        $this->session->set_flashdata("message",$message);
        redirect("pendaftaran");
	}
	function selesai_pinjam(){
		$message = $this->Mpinjam->selesaipinjam();
        $this->session->set_flashdata("message",$message);
        redirect("pendaftaran");
	}
}
?>