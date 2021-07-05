<?php
class Kia extends CI_Controller{
    function __construct(){
        parent::__construct();
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
		$data["menu"] = "kia";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vbumiladd";
		$data["title_header"] = "KIA - Data Pendaftaran";
	    $data["breadcrumb"] = "<li class='active'><strong>KIA</strong></li>";
		$q =$this->Mkia->getjumlahpasien('N');
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
		if ($jmlrec>0){
			$notif = "<div class=notif><div class='callout callout-warning'>
							<p>Ada <strong class='text-red'>".$jmlrec." pasien</strong> yang belum diperiksa</p>
					  </div>
					  </div>";
		} else $notif = "";
		$data["notif"] = $notif;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] =$this->Mkia->getpasien($posisi,$baris,'N');
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
    function view_kia(){
		$q =$this->Mkia->getjumlahpasien('N');
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
		$data["posisi"] = $posisi;
		$data["q"] =$this->Mumum->getpasien($posisi,$baris,"N");
		$this->load->view('kia/view_kia',$data);
    }
    function notif_kia(){
		$q =$this->Mumum->getjumlahpasien("N");
		$row = $q->row();
		$jmlrec=$row->jumlah;
		echo $jmlrec;
    }
    function cekpendaftaran(){
    	$q =$this->Mkia->getjumlahpasien('N');
    	$row = $q->row();
		$jmlrec=$row->jumlah;
		echo "<div class='notif'>Ada ".$jmlrec." pasien yang belum diperiksa</div>";
    }
	function ancdetailadd($id_pendaftaran,$id_bumil){
		$q = $this->Mkia->getbumildetail($id_bumil);
		if ($q->num_rows()<=0){
        	redirect("kia/bumildetail/".$id_pendaftaran."/".$id_bumil);
    	}
		$q = $this->Mpendaftaran->cekpasien($id_pendaftaran,'isperiksa','Y');
    	if ($q->num_rows()>0){
    		$data["status"] = "view";
    	} else {
    		$data["status"] = "simpan";
    	}
    	$data["title"] = $this->session->userdata('status_user');
    	$data["breadcrumb"] = "<li class='active'><strong>Antenatalcare (ANC)</strong></li>";
		$data['title_header'] = "KIA - Antenatalcare (ANC)";
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["q2"] = $this->Mpendaftaran->getawaldaftar($id_bumil,3)->row();
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["id_bumil"] =$id_bumil;
		$data["q1"] = $this->Mkia->getancdetail($id_bumil);
		$data["row"] = $this->Mkia->getbumildetail($id_bumil)->row();
		$data["content"] = "kia/vancdetailadd";
		$data["q5"]=$this->Mkia->getresepobat($id_pendaftaran);
		$q = $this->Mkia->getobat_autocomplete();
		foreach ($q->result() as $row) {
			$q_obat[] = array(
				"id"=>$row->id_obat,
				"label"=>$row->nama_obat
			);
		}
		$data["q_obat"] = $q_obat;
		$q = $this->Mkia->gettindakan_autocomplete();
		foreach ($q->result() as $row) {
			$q_tindakan[] = array(
				"id"=>$row->id_tindakan,
				"label"=>$row->nama_tindakan
			);
		}
		$this->load->view('template',$data);
	}
	function ancinapadd($id_pendaftaran,$id_bumil,$tab=1){
		$q = $this->Mpendaftaran->cekpasien($id_pendaftaran,'isperiksa','Y');
    	if ($q->num_rows()>0){
    		$data["status"] = "view";
    	} else {
    		$data["status"] = "simpan";
    	}
    	$data["tab"] = 1;
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - Antenatalcare Inap (ANC)";
		$data["breadcrumb"] = "<li class='active'><strong>Antenatalcare Inap (ANC)</strong></li>";
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["vmenu"] = "kia/vmenu";
		$data["menu"] = "bumil";
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["id_bumil"] =$id_bumil;
		$data["row1"] = $this->Mkia->getsubyektif($id_pendaftaran,$id_bumil);
		$data["row2"] = $this->Mkia->getobyektif($id_pendaftaran,$id_bumil);
		$data["row3"] = $this->Mkia->getassesment($id_pendaftaran,$id_bumil);
		$data["q1"] = $this->Mpendaftaran->getawaldaftar($id_bumil,3)->row();
		$data["content"] = "kia/vancinapdetail";
		$this->load->view('template',$data);
	}
	function ancdetailedit($id_pendaftaran,$id_bumil){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - Antenatalcare (ANC)";
		$data["breadcrumb"] = "<li class='active'><strong>Antenatalcare (ANC)</strong></li>";
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["id_bumil"] = $id_bumil;
		$data["q1"] = $this->Mkia->getancdetail($id_bumil);
		$data["row"] = $this->Mkia->getbumildetail($id_bumil)->row();
	    $data["q2"] = $this->Mpendaftaran->getawaldaftar($id_bumil,3)->row();
		$data["content"] = "kia/vancdetailedit";
		$data["q5"]=$this->Mkia->getresepobat($id_pendaftaran);
		$q = $this->Mkia->getobat_autocomplete();
		foreach ($q->result() as $row) {
			$q_obat[] = array(
				"id"=>$row->id_obat,
				"label"=>$row->nama_obat
			);
		}
		$q = $this->Mkia->gettindakan_autocomplete();
		foreach ($q->result() as $row) {
			$q_tindakan[] = array(
				"id"=>$row->id_tindakan,
				"label"=>$row->nama_tindakan
			);
		}
		$data["q_obat"] = $q_obat;
		$this->load->view('template',$data);
	}
	function hapusanc($id_pendaftaran,$id_bumil,$id_antenatal_care){
		$message = $this->Mkia->hapusanc($id_antenatal_care);
        $this->session->set_flashdata("message",$message);
        redirect("kia/ancdetailedit/".$id_pendaftaran."/".$id_bumil);
	}
	function listbumil(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - List Bumil";
		$data["breadcrumb"] = "<li class='active'><strong>List Bumil</strong></li>";
		$data["vmenu"] = "kia/vmenu";
		$data["menu"] = "bumil";
		$data["content"] = "kia/vlistbumil";
		$q =$this->Mkia->getjumlahpasien("Y");

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
		$data["q"] =$this->Mkia->getpasien($posisi,$baris,"Y");
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
    function listpasien_anc(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - List ANC";
		$data["breadcrumb"] = "<li class='active'><strong>List ANC</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vlistpasien_anc";
		$q =$this->Mkia->getjumlahpasien("Y");

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
		$data["q"] =$this->Mkia->getpasien($posisi,$baris,"Y");
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
	function bumildetail($id_pendaftaran,$id_bumil){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA Ibu Hamil - Anamnesa";
		$data["breadcrumb"] = "<li class='active'><strong>Ibu Hamil - Anamnesa</strong></li>";
		$data["menu"] = "bumil";
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["row"] = $this->Mkia->getbumildetail($id_bumil)->row();
		$data["q"] =$this->Mkia->getpasienlab($id_pendaftaran);
		$data["q1"] = $this->Mpendaftaran->getawaldaftar($id_bumil,3)->row();
		$data["vmenu"] = "kia/vmenu";
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["id_bumil"] = $id_bumil;
		$data["content"] = "kia/vbumildetail";
		$this->load->view('template',$data);
	}
	function hapusbumildetail($id_bumil){
		$message = $this->Mkia->hapusbumildetail($id_bumil);
        $this->session->set_flashdata("message",$message);
        redirect("kia/listbumil");
	}
	function simpanresep(){
		$message = $this->Mkia->simpanresep();
        $this->session->set_flashdata("message",$message);
        redirect("kia/ancdetailadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function hapusresep($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapusresep($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/ancdetailadd/".$id_pendaftaran."/".$id_bumil);
	}
	function batalperiksa($id_pendaftaran){
		$message = $this->Mpendaftaran->batalperiksa($id_pendaftaran);
        $this->session->set_flashdata("message",$message);
        redirect("kia");
	}
	function listanc(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - List Bumil";
		$data["breadcrumb"] = "<li class='active'><strong>List Bumil</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vlistbumil";
		$q =$this->Mkia->getjumlahpasien_anc();

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
		$data["q"] =$this->Mkia->getpasien_anc($posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
	function persalinan(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - Tambah Persalinan";
		$data["breadcrumb"] = "<li class='active'><strong>Tambah Persalinan</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vpersalinan";
		$q =$this->Mkia->getjumlahpasien('Y');

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
		$data["q"] =$this->Mkia->getpasien($posisi,$baris,'Y');
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
	function persalinandetail($id_pendaftaran,$id_bumil){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA Persalinan";
		$data["breadcrumb"] = "<li class='active'><strong>Persalinan</strong></li>";
		$data["menu"] = "bumil";
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["row"] = $this->Mkia->getpersalinandetail($id_bumil)->row();
		$data["q"] = $this->Mkia->gettindakan($id_bumil);
		$data["q1"] = $this->Mpendaftaran->getawaldaftar($id_bumil,3)->row();
		$data["vmenu"] = "kia/vmenu";
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["id_bumil"] = $id_bumil;
		$data["tglpersalinan"] = $this->Mkia->getbumildetail($id_bumil)->row()->tgl_taksiran_persalinan;
		$data["content"] = "kia/vpersalinandetail";
		$q = $this->Mumum->gettindakan_autocomplete();
		foreach ($q->result() as $row) {
			$q_tindakan[] = array(
				"id"=>$row->id_tindakan,
				"label"=>$row->nama_tindakan
			);
		}
		$data["q_tindakan"] = $q_tindakan;
		$this->load->view('template',$data);
	}
	function partograf(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - Partograf";
		$data["breadcrumb"] = "<li class='active'><strong>Partograf</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vpartograf";
		$q =$this->Mkia->getjumlahpasien('Y');

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
		$data["q"] =$this->Mkia->getpasien($posisi,$baris,'Y');
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
	function partografdetail($id_pendaftaran,$id_bumil,$tab="tab1"){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA Partograf";
		$data["breadcrumb"] = "<li class='active'><strong>Partograf</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["id_bumil"] = $id_bumil;
		$data["tab"] = $tab;
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["q1"] = $this->Mkia->partograf($id_pendaftaran,$id_bumil);
		$data["q2"] = $this->Mkia->partograf_djj($id_pendaftaran,$id_bumil);
		$data["q3"] = $this->Mkia->partograf_airketuban($id_pendaftaran,$id_bumil);
		$data["q4"] = $this->Mkia->partograf_servik($id_pendaftaran,$id_bumil);
		$data["q5"] = $this->Mkia->partograf_kontraksi($id_pendaftaran,$id_bumil);
		$data["q6"] = $this->Mkia->partograf_akhir($id_pendaftaran,$id_bumil);
		$data["content"] = "kia/vpartografdetail";
		$this->load->view('template',$data);
	}
	function simpan_partograf($action){
		$message = $this->Mkia->simpan_partograf($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function simpan_djj(){
		$message = $this->Mkia->simpan_djj();
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/tab2");
	}
	function simpan_airketuban(){
		$message = $this->Mkia->simpan_airketuban();
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/tab3");
	}
	function simpan_servik(){
		$message = $this->Mkia->simpan_servik();
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/tab4");
	}
	function simpan_kontraksi(){
		$message = $this->Mkia->simpan_kontraksi();
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/tab5");
	}
	function simpan_akhir(){
		$message = $this->Mkia->simpan_akhir();
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil')."/tab6");
	}
	function hapus_djj($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapus_djj($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$id_pendaftaran."/".$id_bumil."/tab2");
	}
	function hapus_airketuban($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapus_airketuban($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$id_pendaftaran."/".$id_bumil."/tab3");
	}
	function hapus_servik($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapus_servik($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$id_pendaftaran."/".$id_bumil."/tab4");
	}
	function hapus_kontraksi($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapus_kontraksi($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$id_pendaftaran."/".$id_bumil."/tab5");
	}
	function hapus_akhir($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapus_akhir($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/partografdetail/".$id_pendaftaran."/".$id_bumil."/tab6");
	}
	function caritindakan(){
		$q =$this->Mkia->getjumlahtindakanbumil();
		$id_aksi = $this->input->post("id_aksi");
		$data["id_aksi"] = $id_aksi;
		$baris = $this->input->post("baris");
		if($baris=="") $baris = 50;

		$hal = $this->input->post("hal");
		if($hal=="") $hal = 1;
		$data['judul'] = "Tindakan terhadap bumil";
		$row = $q->row();
		$jmlrec=$row->jumlah;
		$n=$jmlrec/$baris;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] = $this->Mkia->getaksibumil($posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('kia/vcariaksibumil',$data);
	}
	function carilab(){
		$q =$this->Mkia->getjumlahlab();
		$baris = $this->input->post("baris");
		if($baris=="") $baris = 50;

		$hal = $this->input->post("hal");
		if($hal=="") $hal = 1;
		$data['judul'] = "Labotarium";
		$row = $q->row();
		$jmlrec=$row->jumlah;
		$n=$jmlrec/$baris;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] = $this->Mkia->getlab($posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('kia/vcarilab',$data);
	}
	function cariobat(){
		$q =$this->Mumum->getjumlahobat();
		$baris = $this->input->post("baris");
		if($baris=="") $baris = 50;

		$hal = $this->input->post("hal");
		if($hal=="") $hal = 1;
		$data['judul'] = "Obat";
		$row = $q->row();
		$data["cari"] = $this->input->post('cari');
		$jmlrec=$row->jumlah;
		$n=$jmlrec/$baris;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] = $this->Mumum->getobat($posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('umum/vcariobat',$data);
	}
	function simpananc($action){
		$message = $this->Mkia->simpananc($action);
        $this->session->set_flashdata("message",$message);
        switch($action){
        	case 'simpan' : redirect("kia/ancdetailadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));break;
        	case 'edit' : redirect("kia/ancdetailedit/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));break;
        } 
	}
	function simpanpasienlab(){
		$message = $this->Mkia->simpanpasienlab();
        $this->session->set_flashdata("message",$message);
        redirect("kia/bumildetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function hapuspasienlab($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapuspasienlab($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/bumildetail/".$id_pendaftaran."/".$id_bumil);
	}
	function simpantindakan(){
		$message = $this->Mkia->simpantindakan();
        $this->session->set_flashdata("message",$message);
        redirect("kia/persalinandetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function getanctgl($id="",$id_pendaftaran="",$disable=""){
		$data["row"] = $this->Mkia->getanctgl($id);
		$data["disable"] = $disable;
		$data["id_pendaftaran"] = $id_pendaftaran;
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$q = $this->Mkia->gettindakan_autocomplete();
		foreach ($q->result() as $row) {
			$q_tindakan[] = array(
				"id"=>$row->id_tindakan,
				"label"=>$row->nama_tindakan
			);
		}
		$data["q_tindakan"] = $q_tindakan;
		$this->load->view('kia/vanctgl',$data,"true");
	}
	function simpanbumil($action){
		$message = $this->Mkia->simpanbumil($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/ancdetailadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function simpanpersalinan($action){
		$message = $this->Mkia->simpanpersalinan($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/persalinandetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function hapustindakan($id_pendaftaran,$id_bumil,$id){
		$message = $this->Mkia->hapustindakan($id_bumil,$id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/persalinandetail/".$id_pendaftaran."/".$id_bumil);
	}
	function mtbm(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - MTBM";
		$data["breadcrumb"] = "<li class='active'><strong>MTBM</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vmtbm";
		$q =$this->Mkia->getjumlahpasien_kia(4);

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
		if ($jmlrec>0){
			$notif = "<div class=notif><div class='callout callout-warning'>
							<p>Ada <strong class='text-red'>".$jmlrec." pasien</strong> yang belum diperiksa</p>
					  </div>
					  </div>";
		} else $notif = "";
		$data["notif"] = $notif;
		if ($n==floor($jmlrec/$baris)) $npage=$n; else $npage=floor($jmlrec/$baris)+1;
		if ($npage==0) $npage=1;
		$posisi=($hal-1)*$baris;
		$data["q"] =$this->Mkia->getpasien_kia(4,$posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
    function view_mtbm(){
		$q = $this->Mkia->getjumlahpasien_kia(4);
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
		$data["posisi"] = $posisi;
		$data["q"] = $this->Mkia->getpasien_kia(4,$posisi,$baris);
		$this->load->view('kia/view_mtbm',$data);
    }
    function notif_mtbm(){
		$q = $this->Mkia->getjumlahpasien_kia(4);
		$row = $q->row();
		$jmlrec=$row->jumlah;
		echo $jmlrec;
    }
    function mtbmadd($id_pendaftaran,$id_bayi){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - MTBM";
		$data['id_pendaftaran'] = $id_pendaftaran;
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["breadcrumb"] = "<li class='active'><strong>MTBM</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["id_bayi"] = $id_bayi;
		$data["row"] = $this->Mkia->getmtbmdetail($id_pendaftaran)->row();
		$data["q"] =$this->Mkia->getbayi_imunisasi($id_bayi);
		$data["content"] = "kia/vmtbmadd";
		$q = $this->Mkia->getimunisasi_autocomplete();
        foreach ($q->result() as $row) {
            $q_imunisasi[] = array(
                "id"=>$row->id_imunisasi,
                "label"=>$row->nama_imunisasi
            );
        }
        $data["q_imunisasi"] = $q_imunisasi;
		$this->load->view('template',$data);
	}
	function simpanmtbm($action){
		$message = $this->Mkia->simpanmtbm($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/mtbmadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bayi'));
	}
	function batalperiksamtbm($id_pendaftaran){
		$message = $this->Mpendaftaran->batalperiksa($id_pendaftaran);
        $this->session->set_flashdata("message",$message);
        redirect("kia/mtbm");
	}
	function simpanpasienlab_mtbm(){
		$message = $this->Mkia->simpanpasienlab();
        $this->session->set_flashdata("message",$message);
        redirect("kia/mtbmadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bayi'));
	}
	function simpanimunisasi($action){
		$message = $this->Mkia->simpanimunisasi($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/mtbmadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bayi'));
	}
	function hapuspasienlab_mtbm($id_pendaftaran,$id_bayi,$id){
		$message = $this->Mkia->hapuspasienlab($id);
        $this->session->set_flashdata("message",$message);
        redirect("kia/mtbmadd/".$id_pendaftaran."/".$id_bayi);
	}
	function hapusimunisasi($id_bayi,$id_pendaftaran,$id_imunisasi){
		$message = $this->Mkia->hapusimunisasi($id_bayi,$id_pendaftaran,$id_imunisasi);
        $this->session->set_flashdata("message",$message);
        redirect("kia/mtbmadd/".$id_pendaftaran."/".$id_bayi);
	}
	function listmtbm(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - MTBM";
		$data["breadcrumb"] = "<li class='active'><strong>MTBM</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vlistmtbm";
		$q =$this->Mkia->getjumlahpasien_kia('4','Y');

		$tgl1 = $this->input->post("tgl1");
		if ($tgl1=="") $tgl1 = date('d-m-Y');
		$data["tgl1"] = $tgl1;

		$tgl2 = $this->input->post("tgl2");
		if ($tgl2=="") $tgl2 = date('d-m-Y');
		$data["tgl2"] = $tgl2;

		$nama = $this->input->post("nama");
		$data["nama"] = $nama;

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
		$data["q"] =$this->Mkia->getpasien_kia('4',$posisi,$baris,'Y');
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
    function bblradd($id_pendaftaran,$id_bayi){
    	$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - BBLR";
		$data['id_pendaftaran'] = $id_pendaftaran;
		$data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
		$data["breadcrumb"] = "<li class='active'><strong>BBLR</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["id_bayi"] = $id_bayi;
		$data["row"] = $this->Mkia->getmtbmdetail($id_pendaftaran)->row();
		$data["q"] =$this->Mkia->getbblr($id_pendaftaran,$id_bayi);
		$data["content"] = "kia/vbblradd";
		$data["q1"] = $this->Mkia->getaksibblr_autocomplete();
		$this->load->view('template',$data);
    }
    function detail_bblr($id_aksi_bblr){
    	$q = $this->Mkia->getdetailbblr_autocomplete($id_aksi_bblr);
    	$html = "<select name='id_detail_bblr'>";
        foreach ($q->result() as $row) {
        	$html .= "<option value='".$row->id_detail_bblr."'>".$row->nama_detail_bblr."</option>";
        }
        $html .= "</select>";
        echo $html;
    }
    function simpanbblr(){
		$message = $this->Mkia->simpanbblr();
        $this->session->set_flashdata("message",$message);
        redirect("kia/bblradd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bayi'));
	}
    function hapusbblr($id_pendaftaran,$id_bayi){
    	$message = $this->Mkia->hapusbblr($id_pendaftaran);
        $this->session->set_flashdata("message",$message);
        redirect("kia/bblradd/".$id_pendaftaran."/".$id_bayi);
    }
    function graphic($status,$id_pendaftaran,$id_bumil){
		$ctg = array();
		$d = array();
		$data = array();
    			$data2 = array();
				$data3 = array();
    	switch ($status) {
    		case 'djj' :
    			$jml_series = 1;
		    	$q = $this->Mkia->partograf_djj($id_pendaftaran,$id_bumil);
		    	$n=1;
		    	$tipe = "column";
		    	$subtitle = "Denyut Jantung Janin";
		    	$series_title1 = "Denyut Jantung Janin/ Menit";
		    	$series_title2 = $series_title3 = "";
		    	foreach ($q->result() as $row){
		    		$data[] = (int) $row->denyut_jantung;
		    		$ctg[] = $n."<br>".date('h:i',strtotime($row->jam));
		    		$n++;
		    	}
		    	for($i=$n;$i<=10;$i++){
					$data[] = 0;
					$ctg[] = $i;
				}
				break;
			case 'servik' :
				$jml_series = 3;
				$q = $this->Mkia->partograf_servik($id_pendaftaran,$id_bumil);
		    	$tipe = "line";
		    	$subtitle = "Pembukaan Servik";
		    	$series_title1 = "Waspada";
		    	$series_title2 = "Bertindak";
		    	$series_title3 = "Turun Kepala";
		    	$n=1;
		    	foreach ($q->result() as $row){
		    		$data[] = (int) $row->pembukaan_servik;
		    		if($row->turun_kepala>0)
		    			$data3[] = (int) $row->turun_kepala;
		    		else 
		    			$data3[] = null;
		    		if ($n<4){
		    			$data2[] = null;
		    		} else {
		    			$data2[] = (int) $n;
		    		}
		    		$ctg[] = $n."<br>".date('h:i',strtotime($row->jam));
		    		$n++;
		    	}
		    	for($i=$n;$i<=10;$i++){
					$data[] = null;
					$ctg[] = $i;
					$data2[] = (int) $i;
				}
				break;
			case 'kontraksi' :
				$jml_series = 3;
				$q = $this->Mkia->partograf_kontraksi($id_pendaftaran,$id_bumil);
		    	$tipe = "column";
		    	$subtitle = "Kontraksi";
		    	$series_title1 = "<20";
		    	$series_title2 = "20-40";
		    	$series_title3 = ">40";
		    	$n=1;
		    	foreach ($q->result() as $row){
		    		switch ($row->frekuensi) {
		    			case '<20':
		    				$data[] = (int) $row->kontraksi;
		    				$data2[] = null;
		    				$data3[] = null;
		    				break;
		    			case '20-40':
		    				$data2[] = (int) $row->kontraksi;
		    				$data1[] = null;
		    				$data3[] = null;
		    				break;
		    			case '>40':
		    				$data3[] = (int) $row->kontraksi;
		    				$data1[] = null;
		    				$data2[] = null;
		    				break;

		    		}
		    		$ctg[] = $n."<br>".date('h:i',strtotime($row->jam));
		    		$n++;
		    	}
		    	for($i=$n;$i<=10;$i++){
					$data[] = $data2[] = $data3[] = null;
					$ctg[] = $i;
				}
				break;
		}
		$d = array(
					'jml_series'=>$jml_series,
					'data'=>$data,
					'data2'=>$data2,
					'data3'=>$data3,
					'ctg'=>$ctg,
					'tipe'=>$tipe,
					'subtitle'=>$subtitle,
					'series_title1'=>$series_title1,
					'series_title2'=>$series_title2,
					'series_title3'=>$series_title3
			 	);
		echo $this->load->view('kia/vgraphic',$d,true);
    }
    function listbblr(){
		$data["title"] = $this->session->userdata('status_user');
		$data['title_header'] = "KIA - List BBLR";
		$data["breadcrumb"] = "<li class='active'><strong>BBLR</strong></li>";
		$data["menu"] = "bumil";
		$data["vmenu"] = "kia/vmenu";
		$data["content"] = "kia/vlistbblr";
		$q =$this->Mkia->getjumlahpasien_bblr('4');

		$tgl1 = $this->input->post("tgl1");
		if ($tgl1=="") $tgl1 = date('d-m-Y');
		$data["tgl1"] = $tgl1;

		$tgl2 = $this->input->post("tgl2");
		if ($tgl2=="") $tgl2 = date('d-m-Y');
		$data["tgl2"] = $tgl2;

		$nama = $this->input->post("nama");
		$data["nama"] = $nama;

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
		$data["q"] =$this->Mkia->getpasien_bblr('4',$posisi,$baris);
		$data["npage"] = $npage;
		$data["hal"] = $hal;
		$data["baris"] = $baris;
		$data["posisi"] = $posisi;
		$data["jmlrec"] = $jmlrec;
		$this->load->view('template',$data);
    }
    function simpan_subyektif($action){
		$message = $this->Mkia->simpan_subyektif($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/ancinapadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function simpan_obyektif($action){
		$message = $this->Mkia->simpan_obyektif($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/ancinapadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
	function simpan_assesment($action){
		$message = $this->Mkia->simpan_assesment($action);
        $this->session->set_flashdata("message",$message);
        redirect("kia/ancinapadd/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_bumil'));
	}
}
?>