<?php
class Kasir extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mkasir');
		$this->load->Model('Mpasienkb');
		$this->load->Model('Mkia');
		$this->load->Model('Mumum');
		$this->load->Model('Mpendaftaran');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index(){
    	$data["title"] = $this->session->userdata('status_user');
        $data["username"] = $this->session->userdata('username');
	    $data['menu']="pendaftaran";
	    $data['vmenu']="kasir/vmenu";
		$data["content"] = "kasir/vlistpasien";
	    $data["title_header"] = "<h2>Data Pendaftaran</h2>";
	    $data["breadcrumb"] = "<li class='active'><strong>Pendaftaran</strong></li>";
		$q =$this->Mkasir->getjumlahpasien();

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

		$row = $q->row();
		$jmlrec=$row->jumlah;
		$n=$jmlrec/$baris;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] =$this->Mkasir->getpasien($posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
    function listpasien($id_layanan,$id_pendaftaran){
    	switch($id_layanan){
    		case '3' :
    			$data["title"] = $this->session->userdata('status_user');
        		$data["username"] = $this->session->userdata('username');
	    		$data['vmenu']="kasir/vmenu";
				$data['menu']="pendaftaran";
				$data["title_header"] = "<h2>KIA Antenalcare (ANC)</h2>";
	    		$data["breadcrumb"] = "<li class='active'><strong>KIA Antenalcare (ANC)</strong></li>";
	    		$data["content"] = "kasir/vbumildetail";

				$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
				$id_pasien = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row()->id_pasien;
				$data["id_pendaftaran"] = $id_pendaftaran;
				$data["id_layanan"] = $id_layanan;
				$data["id_bumil"] = $id_pasien;
				$id_pasien = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row()->id_pasien;
				$data["q1"] = $this->Mkia->getancdetail($id_pasien,$id_pendaftaran);
				$data["row"] = $this->Mkia->getbumildetail($id_pasien)->row();
				$data["q5"]=$this->Mkia->getresepobat($id_pendaftaran);
				$this->load->view('template',$data);
			break;
			case '1' :
				$data["title"] = $this->session->userdata('status_user');
        		$data["username"] = $this->session->userdata('username');
				$data['vmenu']="kasir/vmenu";
				$data['menu']="pendaftaran";
				$data["title_header"] = "<h2>IGD</h2>";
	    		$data["breadcrumb"] = "<li class='active'><strong>IGD</strong></li>";
				$data["content"] = "kasir/vigddetail";
				
				$q = $this->Mumum->getumum($id_pendaftaran)->row();
    			if ($q) $id_bpumum = $q->id_bpumum; else $id_bpumum = "";
				$data['id_pendaftaran'] = $id_pendaftaran;
				$data["id_layanan"] = $id_layanan;
				$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
				$data["row"] = $this->Mumum->getumum($id_pendaftaran)->row();
				$data["d"] = $this->Mkasir->getparamedis($id_layanan);
				$data["q1"] =$this->Mumum->getumumdetail($id_pendaftaran,$id_bpumum);
				$data["q2"] =$this->Mkasir->getpasienlab($id_layanan,$id_pendaftaran);
				$data["q3"]=$this->Mumum->tindakan_bpumum();
				$data["q4"]=$this->Mumum->status_kasus();
				$data["q5"]=$this->Mumum->getresepobat($id_pendaftaran);
				$this->load->view('template',$data);
			break;
			case '5' :

				$data["title"] = $this->session->userdata('status_user');
        		$data["username"] = $this->session->userdata('username');
				$data['vmenu']="kasir/vmenu";
				$data['menu']="pendaftaran";
				$data["title_header"] = "<h2>Pasien KB</h2>";
	    		$data["breadcrumb"] = "<li class='active'><strong>Pasien KB</strong></li>";
				$data["content"] = "kasir/vpasienkbdetail";
				
				$q = $this->Mpasienkb->getkbid_pasien($id_pendaftaran)->row();
    			if ($q) $id_pasien_kb = $q->id_pasien_kb; else $id_bpumum = "";
				$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
				$data["id_pendaftaran"] = $id_pendaftaran;
				$data["id_pasien_kb"] = $id_pasien_kb;
				$data["row"] = $this->Mpasienkb->getkbdetail($id_pendaftaran,$id_pasien_kb)->row();
				$data["q1"] =$this->Mpasienkb->getstatuskb();
				$this->load->view('template',$data);
			break;
			case '4' :
				$data["title"] = $this->session->userdata('status_user');
        		$data["username"] = $this->session->userdata('username');
				$data['vmenu']="kasir/vmenu";
				$data['menu']="pendaftaran";
				$data["title_header"] = "<h2>MTBM</h2>";
	    		$data["breadcrumb"] = "<li class='active'><strong>MTBM</strong></li>";
				$data["content"] = "kasir/vmtbmadd";
				
				$q = $this->Mkia->getmtbmdetail($id_pendaftaran)->row();
    			if ($q) $id_bayi = $q->id_bayi; else $id_bayi = "";
				$data['id_pendaftaran'] = $id_pendaftaran;
				$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
				$data["id_bayi"] = $id_bayi;
				$data["row"] = $this->Mkia->getmtbmdetail($id_pendaftaran)->row();
				$data["q"] =$this->Mkia->getbayi_imunisasi($id_bayi);
				$this->load->view('template',$data);
			break;
		}
	}
	function cetak($id_layanan,$id_pendaftaran){
		$data["nama_user"] = $this->session->userdata('nama_user');
		switch($id_layanan){
			case '3' :
				$data["title"] = $this->session->userdata('status_user');
				$data['judul'] = "KARTU PEMERIKSAAN IBU HAMIL";
				$data["p"] = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row();
				$id_pasien = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row()->id_pasien;
				$data["id_pendaftaran"] = $id_pendaftaran;
				$data["id_layanan"] = $id_layanan;
				$data["q1"] = $this->Mkia->getancdetail($id_pasien);
				$data["row"] = $this->Mkia->getbumildetail($id_pasien)->row();
				$this->load->view('kasir/vcetakrekam',$data);
			break;
			case '1' :
				$q = $this->Mumum->getumum($id_pendaftaran)->row();
    			if ($q) $id_bpumum = $q->id_bpumum; else $id_bpumum = "";
				$data["title"] = $this->session->userdata('status_user');
				$data['judul'] = "RESUME MEDIK <br>(MEDICAL RECORD)";
				$data['id_pendaftaran'] = $id_pendaftaran;
				$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
				$data["menu"] = "kasir/vmenu";
				$data["row"] = $this->Mumum->getumum($id_pendaftaran)->row();
				$data["d"] = $this->Mkasir->getparamedis($id_layanan);
				$data["q1"] =$this->Mumum->getumumdetail($id_pendaftaran,$id_bpumum);
				$data["q2"] =$this->Mkasir->getpasienlab($id_layanan,$id_pendaftaran);
				$data["q3"]=$this->Mumum->tindakan_bpumum();
				$data["q4"]=$this->Mumum->status_kasus();
				$data["q5"]=$this->Mumum->getresepobat($id_pendaftaran);
				$this->load->view('kasir/vcetakigd',$data);
			break;
		}
	}
	function cetak_kwitansi($id_layanan,$id_pendaftaran){
		$data["nama_user"] = $this->session->userdata('nama_user');
		$data["pt"] = $this->Mkasir->getpuskesmas()->row();
		switch($id_layanan){
			case '3' :
				$data["title"] = $this->session->userdata('status_user');
				$data['judul'] = "KWITANSI KIA";
				$data["p"] = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row();
				$id_pasien = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row()->id_pasien;
				$data["id_pendaftaran"] = $id_pendaftaran;
				$data["id_layanan"] = $id_layanan;
				$data["q1"] = $this->Mkasir->getancdetail($id_pendaftaran,$id_pasien);
				$data["row"] = $this->Mkia->getbumildetail($id_pasien)->row();
				$this->load->view('kasir/vcetakkwitansi',$data);
			break;
			case '1' :
				$data["title"] = $this->session->userdata('status_user');
				$data['judul'] = "KWITANSI IGD";
				$data["p"] = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row();
				$id_pasien = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row()->id_pasien;
				$data["id_pendaftaran"] = $id_pendaftaran;
				$data["id_layanan"] = $id_layanan;
				$data["q1"] =$this->Mumum->getumumdetail($id_pendaftaran,$id_pasien);
				$data["q2"]=$this->Mumum->getresepobat($id_pendaftaran);
				$this->load->view('kasir/vcetakkwitansi_umum',$data);
			break;
			case '5' :
				$data["title"] = $this->session->userdata('status_user');
				$data['judul'] = "KWITANSI KB";
				$data["p"] = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row();
				$id_pasien = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row()->id_pasien;
				$data["id_pendaftaran"] = $id_pendaftaran;
				$data["id_layanan"] = $id_layanan;
				$data["q1"] = $this->Mkasir->getkbdetail($id_pendaftaran,$id_pasien);
				$this->load->view('kasir/vcetakkwitansi',$data);
			break;
			case '4' :
				$data["title"] = $this->session->userdata('status_user');
				$data['judul'] = "KWITANSI IMUNISASI";
				$data["p"] = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row();
				$id_pasien = $this->Mkasir->getdetailpendaftar($id_pendaftaran)->row()->id_pasien;
				$data["id_pendaftaran"] = $id_pendaftaran;
				$data["id_layanan"] = $id_layanan;
				$data["q1"] =$this->Mkasir->getbayi_imunisasi($id_pendaftaran,$id_pasien);
				$this->load->view('kasir/vcetakkwitansi_imun',$data);
			break;
		}
	}
}
?>