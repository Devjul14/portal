<?php
class Persalinan extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mkia');
		$this->load->Model('Mpersalinan');
		$this->load->Model('Mpendaftaran');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - List Persalinan";
		$data["breadcrumb"] = "<li class='active'><strong>List Persalinan</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "persalinan/vlistpersalinan";
		$q =$this->Mpersalinan->getjumlahpasien();
		
		$tgl1 = $this->input->post("tgl1");
		if ($tgl1=="") $tgl1 = date('d-m-Y');
		$data["tgl1"] = $tgl1;

		$tgl2 = $this->input->post("tgl2");
		if ($tgl2=="") $tgl2 = date('d-m-Y');
		$data["tgl2"] = $tgl2;

		$baris = $this->input->post("baris");
		if($baris=="") $baris = 50;

		$hal = $this->input->post("hal");
		if($hal=="") $hal = 1;
		$nama = $this->input->post("nama");
		$data["nama"] = $nama;
		$row = $q->row();
		$jmlrec=$row->jumlah;
		$n=$jmlrec/$baris;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] =$this->Mpersalinan->getpasien($posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
    function catatan_persalinan($id_pendaftaran,$id_bumil,$tab="1"){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - Catatan Persalinan";
		$data["breadcrumb"] = "<li class='active'><strong>Catatan Persalinan</strong></li>";
		$data["p"] = $this->Mpersalinan->getbumildetail($id_bumil)->row();
		$data["row1"] = $this->Mpersalinan->getrujukan_persalinan($id_pendaftaran,$id_bumil);
		$data["row2"] = $this->Mpersalinan->getkala1($id_pendaftaran,$id_bumil);
		$data["row3"] = $this->Mpersalinan->getkala2($id_pendaftaran,$id_bumil);
		$data["row4"] = $this->Mpersalinan->getkala3($id_pendaftaran,$id_bumil);
		$data["row5"] = $this->Mpersalinan->getkala4($id_pendaftaran,$id_bumil);
		$data["row6"] = $this->Mpersalinan->getbayi_baru($id_pendaftaran,$id_bumil);
		$data["row7"] = $this->Mpersalinan->getpemeriksaan_bayi($id_pendaftaran,$id_bumil);
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["id_bumil"] = $id_bumil;
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["tab"] = $tab;
		$data["content"] = "persalinan/vcatatan_persalinan";
		$this->load->view('template',$data);
	}
	function simpan_rujukan_persalinan($action){
		$message = $this->Mpersalinan->simpan_rujukan_persalinan($action);
        $this->session->set_flashdata("message",$message);
        redirect("persalinan/catatan_persalinan/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/1");
	}
	function simpan_kala1($action){
		$message = $this->Mpersalinan->simpan_kala1($action);
        $this->session->set_flashdata("message",$message);
        redirect("persalinan/catatan_persalinan/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/2");
	}
	function simpan_kala2($action){
		$message = $this->Mpersalinan->simpan_kala2($action);
        $this->session->set_flashdata("message",$message);
        redirect("persalinan/catatan_persalinan/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/3");
	}
	function simpan_kala3($action){
		$message = $this->Mpersalinan->simpan_kala3($action);
        $this->session->set_flashdata("message",$message);
        redirect("persalinan/catatan_persalinan/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/4");
	}
	function simpan_kala4($action){
		$message = $this->Mpersalinan->simpan_kala4($action);
        $this->session->set_flashdata("message",$message);
        redirect("persalinan/catatan_persalinan/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/5");
	}
	function simpan_bayi_baru($action){
		$message = $this->Mpersalinan->simpan_bayi_baru($action);
        $this->session->set_flashdata("message",$message);
        redirect("persalinan/catatan_persalinan/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/6");
	}
	function simpan_pemeriksaan_bayi($action){
		$message = $this->Mpersalinan->simpan_pemeriksaan_bayi($action);
        $this->session->set_flashdata("message",$message);
        redirect("persalinan/catatan_persalinan/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/7");
	}
}
?>