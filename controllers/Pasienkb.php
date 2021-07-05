<?php
class Pasienkb extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mkia');
		$this->load->Model('Mumum');
		$this->load->Model('Mpendaftaran');
        $this->load->Model('Mpasienkb');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function index(){
        $data["title"] = $this->session->userdata('status_user');
        $data['title_header'] = "KIA - Pasien KB";
        $data["menu"] = "kb";
        $data["vmenu"] = "kia/vmenu";
        $data["content"] = "pasienkb/vpasienkb";
        $data["breadcrumb"] = "<li class='active'><strong>Pasien KB</strong></li>";
        $q =$this->Mpasienkb->getjumlahpasien('5','N');

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
        $data["q"] =$this->Mpasienkb->getpasien('5',$posisi,$baris,'N');
        $data["npage"] = $npage;
        $data["hal"] = $hal;
        $data["baris"] = $baris;
        $data["posisi"] = $posisi;
        $data["jmlrec"] = $jmlrec;
        $this->load->view('template',$data);
    }
    function view_kb(){
        $q = $this->Mpasienkb->getjumlahpasien('5','N');
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
        $data["q"] = $this->Mpasienkb->getpasien('5',$posisi,$baris,'N');
        $this->load->view('pasienkb/view_kb',$data);
    }
    function notif_kb(){
        $q = $this->Mpasienkb->getjumlahpasien('5','N');
        $row = $q->row();
        $jmlrec=$row->jumlah;
        echo $jmlrec;
    }
    function pasienkbdetail($id_pendaftaran,$id_pasien_kb){
        $q = $this->Mpendaftaran->cekpasien($id_pendaftaran,'isperiksa','Y');
        if ($q->num_rows()>0){
            $data["status"] = "view";
        } else {
            $data["status"] = "simpan";
        }
        $data["title"] = $this->session->userdata('status_user');
        $data['title_header'] = "KIA - Pasien KB";
        $data["breadcrumb"] = "<li class='active'><strong>Pasien KB</strong></li>";
        $data["p"] = $this->Mpendaftaran->getdetailpendaftar($id_pendaftaran)->row();
        $data["menu"] = "kb";
        $data["vmenu"] = "kia/vmenu";
        $data["id_pendaftaran"] = $id_pendaftaran;
        $data["id_pasien_kb"] = $id_pasien_kb;
        $data["row"] = $this->Mpasienkb->getkbdetail($id_pendaftaran,$id_pasien_kb)->row();
        $data["content"] = "pasienkb/vpasienkbdetail";
        $data["q"] =$this->Mkia->getpasienlab($id_pendaftaran);
        $data["q1"] =$this->Mpasienkb->getstatuskb();
        $q = $this->Mumum->getlab_autocomplete();
        foreach ($q->result() as $row) {
            $q_lab[] = array(
                "id"=>$row->id_lab,
                "label"=>$row->nama_lab
            );
        }
		$q = $this->Mkia->gettindakan_autocomplete();
		foreach ($q->result() as $row) {
			$q_tindakan[] = array(
				"id"=>$row->id_tindakan,
				"label"=>$row->nama_tindakan
			);
		}
        $data["q_lab"] = $q_lab;
		$data["q_tindakan"] = $q_tindakan;
        $this->load->view('template',$data);
    }
    function simpankb($action){
        $message = $this->Mpasienkb->simpankb($action);
        $this->session->set_flashdata("message",$message);
        redirect("pasienkb/pasienkbdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_pasien_kb'));
    }
    function listkb(){
        $data["title"] = $this->session->userdata('status_user');
        $data['title_header'] = "KIA - List Pasien KB";
        $data["breadcrumb"] = "<li class='active'><strong>List Pasien KB</strong></li>";
        $data["menu"] = "kb";
        $data["vmenu"] = "kia/vmenu";
        $data["content"] = "pasienkb/vlistkb";
        $q =$this->Mpasienkb->getjumlahpasien("5","Y");

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
        $data["q"] =$this->Mpasienkb->getpasien("5",$posisi,$baris,"Y");
        $data["npage"] = $npage;
        $data["hal"] = $hal;
        $data["baris"] = $baris;
        $data["posisi"] = $posisi;
        $data["jmlrec"] = $jmlrec;
        $this->load->view('template',$data);
    }
    function simpanpasienlab(){
        $message = $this->Mkia->simpanpasienlab();
        $this->session->set_flashdata("message",$message);
        redirect("pasienkb/pasienkbdetail/".$this->input->post('id_pendaftaran')."/".$this->input->post('id_pasien_kb'));
    }
    function hapuspasienlab($id_pendaftaran,$id_pasien_kb,$id){
        $message = $this->Mkia->hapuspasienlab($id);
        $this->session->set_flashdata("message",$message);
        redirect("pasienkb/pasienkbdetail/".$id_pendaftaran."/".$id_pasien_kb);
    }
    function hapuskbdetail($id_pasien_kb){
        $message = $this->Mpasienkb->hapuskbdetail($id_pasien_kb);
        $this->session->set_flashdata("message",$message);
        redirect("kia/listbumil");
    }
	function batalperiksa($id_pendaftaran){
		$message = $this->Mpendaftaran->batalperiksa($id_pendaftaran);
        $this->session->set_flashdata("message",$message);
        redirect("pasienkb");
	}
}?>