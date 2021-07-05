<?php
class Retensi extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mretensi');
		$this->load->Model('Mpendaftaran');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index($current=0,$from=0){
		$data["title"] = $this->session->userdata('status_user');
		$data['judul'] = "Retensi Pasien&nbsp;&nbsp;&nbsp;";
		$data["vmenu"] = $this->session->userdata("controller")."/vmenu";
		$data["content"] = "retensi/vretensi";
		$data["username"] = $this->session->userdata('nama_user');
	    $data['menu']="retensi";
	    $data["current"] = $current;
	    $data["title_header"] = "Retensi Pasien";
	    $data["breadcrumb"] = "<li class='active'><strong>Retensi Pasien</strong></li>";		
		$this->load->library('pagination');
        $config['base_url'] = base_url().'retensi/index/'.$current;
        $config['total_rows'] = $this->Mretensi->getjumlahpasien_retensi();
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
        if ($this->session->userdata('tgl1')=="") {
            $tgl1 = date('d-m-Y');
        }else{
            $tgl1 = $this->session->userdata('tgl1');
        }
        if ($this->session->userdata('tgl2')=="") {
            $tgl2 = date('d-m-Y');
        }else{
            $tgl2 = $this->session->userdata('tgl2');
        }
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
		$data["q3"] =$this->Mretensi->getpasien_retensi($config['per_page'],$from);
		$this->load->view('template',$data);
    }
    function formretensi($no_rm,$no_retensi=""){
		$data["title"] 			= $this->session->userdata('status_user');
		$data['judul'] 			= "Retensi Pasien&nbsp;&nbsp;&nbsp;";
		$data["vmenu"] 			= $this->session->userdata("controller")."/vmenu";
		$data['menu']			= "user";
		$data["content"] 		= "retensi/vform_retensi";
		$data["username"] 		= $this->session->userdata('nama_user');
	    $data["title_header"] 	= "Retensi Pasien";
	    $data["breadcrumb"] 	= "<li class='active'><strong>Retensi Pasien</strong></li>";		
	    $data["no_rm"]			= $no_rm;
	    $data["no_retensi"]		= $no_retensi;
		$data["row"] 			= $this->Mpendaftaran->getdetailpasien($no_rm);
		$data["q"] 				= $this->Mretensi->getretensi_detail($no_rm,$no_retensi);
        $data["d"] = $this->Mretensi->getdokter();
        $this->load->view('template',$data);
    }
    function pilihdiagnosa($kode="",$urut=""){
    	$data["urut"]			= $urut;
	    $data["q"] 				= $this->Mpendaftaran->pilihdiagnosa($kode);
        $data["title"]			= "Diagnosa || RS CIREMAI";
	    $data["title_header"] 	= "Diagnosa";
        $this->load->view('retensi/vpilih_diagnosa',$data);
    }
    function pilihtindakan($kode="",$urut=""){
    	$data["urut"]			= $urut;
	    $data["q"] 				= $this->Mretensi->pilihtindakan($kode);
        $data["title"]			= "Tindakan || RS CIREMAI";
	    $data["title_header"] 	= "Tindakan";
        $this->load->view('retensi/vpilih_tindakan',$data);
    }
    function simpanretensi($action){
		$message = $this->Mretensi->simpanretensi($action);
        $this->session->set_flashdata("message",$message);
        redirect("retensi");        
	}
    function getdiagnosa(){
        echo json_encode($this->Mretensi->getdiagnosa());
    }
    function tindakan(){
        echo json_encode($this->Mretensi->tindakan());
    }
    function namadiagnosa(){
        echo $this->Mretensi->namadiagnosa();
    }
    function namatindakan(){
        echo $this->Mretensi->namatindakan();
    }
    function getcaripasien(){
        $this->session->set_flashdata("no_pasien",$this->input->post("cari_no"));
    }
    function data_rm($no_rm,$no_retensi){
        $q = $this->Mretensi->cekpasien($no_rm);
        if ($q) {
            $message = "danger-Nomor RM  telah terpakai";
            $this->session->set_flashdata("message",$message);
            redirect("retensi");
        } else {
            $message = $this->Mretensi->data_rm($no_rm,$no_retensi);
            $this->session->set_flashdata("message",$message);
            $this->session->set_flashdata("no_pasien",$no_rm);
            redirect("pendaftaran");         
        }  
    }
    function ambil_data($no_rm,$no_retensi){
        $no_pasien = $this->Mpendaftaran->getno_pasien_baru();
        $message = $this->Mretensi->ambil_data($no_rm,$no_retensi,$no_pasien);
        $this->session->set_flashdata("message",$message);
        $this->session->set_flashdata("no_pasien",$no_pasien);
        redirect("pendaftaran");    
    }
    function search_pasien(){
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function reset_pasien(){
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        redirect('retensi');
    }
    function formupload($no_pasien,$no_retensi){
        $data["title"]          = $this->session->userdata('status_user');
        $data['judul']          = "Upload Dokumen&nbsp;&nbsp;&nbsp;";
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "user";
        $data["content"]        = "retensi/vformupload";
        $data["username"]       = $this->session->userdata('nama_user');
        $data["title_header"]   = "Upload Dokumen";
        $data["breadcrumb"]     = "<li class='active'><strong>Upload Dokumen</strong></li>";        
        $data["no_pasien"]          = $no_pasien;
        $data["no_retensi"]     = $no_retensi;
        $this->load->view('template',$data);
    }
    function simpanupload(){
        $no_pasien = $this->input->post('no_pasien');
        $no_retensi = $this->input->post('no_retensi');

        $config['upload_path']          = './file_pdf/retensi/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['file_name']            = "Retensi-".$no_pasien."_".$no_retensi;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file_retensi'))
        {
            $message = "danger-Gagal diupload";
            $this->session->set_flashdata("message",$message);
            redirect("retensi/formupload/".$no_pasien."/".$no_retensi);
        }
        else
        {
            $data = array(
                            'upload_data' => $this->upload->data('file_name'),
                        );
            $nama_file =  $data['upload_data'];
            $message = $this->Mretensi->simpanupload($nama_file);
            $this->session->set_flashdata("message",$message);
            redirect("retensi");
        }
    }
    function cetakretensi($tgl1,$tgl2){
        $data["tgl1"]  = $tgl1;
        $data["tgl2"]  = $tgl2;
        $data["q"]          = $this->Mretensi->cetakretensi($tgl1,$tgl2);
        $this->load->view('retensi/vcetak',$data);    
    }
}
?>