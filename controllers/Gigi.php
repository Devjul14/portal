<?php
class Gigi extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mgigi');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index(){
		$data["title"] = $this->session->userdata('status_user');
		$data['judul'] = "BP Gigi - Data Pendaftaran&nbsp;&nbsp;&nbsp;";
		$data["menu"] = "gigi/vmenu";
		$data["content"] = "gigi/vdaftarpasien";
		$q =$this->Mgigi->getjumlahpasien();

		$tgl1 = $this->input->post("tgl1");
		if ($tgl1=="") $tgl1 = date('Y-m-d');
		$data["tgl1"] = $tgl1;

		$tgl2 = $this->input->post("tgl2");
		if ($tgl2=="") $tgl2 = date('Y-m-d');
		$data["tgl2"] = $tgl2;

		$baris = $this->input->post("baris");
		if($baris=="") $baris = 50;

		$hal = $this->input->post("hal");
		if($hal=="") $hal = 1;

		$row = $q->row();
		$jmlrec=$row->jumlah;
		$n=$jmlrec/$baris;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] =$this->Mgigi->getpasien($posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
}
?>