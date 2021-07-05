<?php
class Lab extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mlab');
		$this->load->Model('Mpendaftaran');
        $this->load->Model('Mkasir');
        $this->load->Model('Mgrouper');
        $this->load->Model('Mpa');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function ralan($current=0,$from=0){
		$data["title"] 				= "Lab Rawat Jalan";
		$data['judul'] 				= "Lab Rawat Jalan";
		$data["vmenu"] 				= $this->session->userdata("controller")."/vmenu";
		$data["content"] 			= "lab/vlistlab_ralan";
		$data["username"] 			= $this->session->userdata('nama_user');
	    $data['menu']				= "lab";
	    $data["current"] 			= $current;
	    $data["title_header"] 		= "Lab Rawat Jalan ";
	    $data["total_rows"] 		= $this->Mlab->getlab_ralan();
        $data["jlayan"]             = $this->Mlab->gettotalpasien("LAYAN");
        $data["jbatal"]             = $this->Mlab->gettotalpasien("BATAL");
	    $data["breadcrumb"] 		= "<li class='active'><strong>Lab Rawat Jalan</strong></li>";
		$this->load->library('pagination');
        $config['base_url'] 		= base_url().'lab/ralan/'.$current;
        $config['total_rows'] 		= $this->Mlab->getlab_ralan();
        $config['per_page'] 		= 10;
        $config['full_tag_open']	= '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] 	= '</ul>';
        $config['cur_tag_open'] 	= '<li class=active><a>';
        $config['cur_tag_close']	= '</a></li>';
        $config['num_tag_open'] 	= '<li>';
        $config['num_tag_close'] 	= '</li>';
        $config['prev_tag_open'] 	= '<li>';
        $config['prev_tag_close'] 	= '</li>';
        $config['next_tag_open'] 	= '<li>';
        $config['next_tag_close'] 	= '</li>';
        $config['first_tag_open'] 	= '<li>';
        $config['first_tag_close'] 	= '</li>';
        $config['last_tag_open'] 	= '<li>';
        $config['last_tag_close'] 	= '</li>';
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 4;
        $from						= $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"] 				= $from;
		$data["q3"] 				= $this->Mlab->getpasien_ralan_lab($config['per_page'],$from);
        $data["q"]                  = $this->Mlab->pilihdokterlab();
		$this->load->view('template',$data);
    }
     function inap($current=0,$from=0){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Lab Rawat Inap &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "lab/vlistlab_inap";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="lab";
        $data["current"] = $current;
        $data["title_header"] = "Lab Rawat Inap ";
        $data["total_rows"] = $this->Mlab->getlab_rawatinap();
        $data["breadcrumb"] = "<li class='active'><strong>Lab Rawat Inap</strong></li>";
        $this->load->library('pagination');
        $config['base_url'] = base_url().'lab/inap/'.$current;
        $config['total_rows'] = $this->Mlab->getlab_rawatinap();
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
        $data["q3"] =$this->Mlab->getlab_inap($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function cari_labralan(){
        $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
        $this->session->set_userdata("status_pasien",$this->input->post("status_pasien"));
    }
    function getcaripasien_inap(){
        $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
    }
    function batal($no_pasien,$no_reg){
        $message = $this->Mpendaftaran->batal($no_pasien,$no_reg,"labotarium");
        $this->session->set_flashdata("message",$message);
    }
    function reset_labralan(){
        $this->session->unset_userdata('no_pasien');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('no_reg');
        $this->session->unset_userdata('status_pasien');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('kode_dokter');
        $this->session->unset_userdata('dokter');
        redirect("lab/ralan");
    }
    function reset_inap(){
        $this->session->unset_userdata('no_pasien');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('no_reg');
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        redirect("lab/inap");
    }
    function search_labralan(){
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
        $this->session->set_userdata('dokter',$this->input->post("dokter"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
      function search_labinap(){
        $this->session->set_userdata('kode_kelas',$this->input->post("kode_kelas"));
        $this->session->set_userdata('kelas',$this->input->post("kelas"));
        $this->session->set_userdata('kode_ruangan',$this->input->post("kode_ruangan"));
        $this->session->set_userdata('ruangan',$this->input->post("ruangan"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function detaillab_ralan($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "lab";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Lab Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Detail Lab Rawat Jalan";
        $data["content"]        = "lab/vformlab_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Lab Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mlab->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mlab->getkasir($no_reg);
        $data["kr"]              = $this->Mlab->getkasir_ekspertisi_array($no_reg);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]              = $this->Mlab->gettarif_lab();
        $data["m"]              = $this->Mlab->getswab_lab();
        $data["d"]              = $this->Mlab->getdokter_lab();
        $data["dk"]             = $this->Mlab->getdokterall();
        $data["r"]              = $this->Mlab->getanalys();
        $data["dokter"]         = $this->Mlab->getdokter_array();
        $data["analys"]         = $this->Mlab->getanalys_array();
        $data["dokter_pengirim"]= $this->Mlab->getdokterpengirim_array();
        $this->Mlab->terima($no_pasien,$no_reg);
        $this->load->view('template',$data);
    }
    function detaillab_inap($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "lab";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Lab Rawat Inap || RS CIREMAI";
        $data["title_header"]   = "Detail Lab Rawat Inap";
        $data["content"]        = "lab/vformlab_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Lab Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mlab->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mlab->getkasir_inap($no_reg);
        $data["kr"]             = $this->Mlab->getkasir_inap_ekspertisi_array($no_reg);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]              = $this->Mlab->gettarif_lab();
        $data["m"]              = $this->Mlab->getswab_lab();
        $data["d"]              = $this->Mlab->getdokter_lab();
        $data["dk"]             = $this->Mlab->getdokterall();
        $data["r"]              = $this->Mlab->getanalys();
        $data["ms"]              = $this->Mlab->getmetode_swab_array();
        $data["dokter"]         = $this->Mlab->getdokter_array();
        $data["analys"]         = $this->Mlab->getanalys_array();
        $data["dokter_pengirim"]= $this->Mlab->getdokterpengirim_array();
        $this->load->view('template',$data);
    }
    function addtindakan(){
        $this->Mlab->addtindakan();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
        redirect("lab/detaillab_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function addtindakan_inap(){
        $this->Mlab->addtindakan_inap();
        $this->session->set_flashdata("message","success-Tarif berhasil ditambahkan");
        redirect("lab/detaillab_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function ekspertisi($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "lab";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Ekspertisi || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi";
        $data["content"]        = "lab/vformekspertisi";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi</strong></li>";
        $data["row"]            = $this->Mlab->getralan_detail1($no_pasien,$no_reg);
        $data["q"]              = $this->Mlab->getekspertisi_detail($no_reg);
        $data["d"]              = $this->Mlab->getdokter_lab();
        $data["r"]              = $this->Mlab->getanalys();
        $data["k"]              = $this->Mlab->getlab_normal($no_reg);
        $data["hasil"]          = $this->Mlab->getekspertisilab_detail_array($no_reg);
        // $data["x"]              = $this->Mlab->getekspertisilab_detail($no_reg);
        $this->load->view('template',$data);
    }
    function ambildatanormal($dokter){
        $data["q"]              = $this->Mlab->ambildatanormal($dokter);
        $data["title"]          = "Data Normal || RS CIREMAI";
        $data["title_header"]   = "Data Normal";
        $this->load->view('lab/vpilih_datanormal',$data);
    }
    function changedata_ralan(){
        $q = $this->db->get_where("perawat",["id_perawat"=>$this->input->post("value")])->row();
        if ($this->input->post("jenis")=="analys"){
            if ($this->input->post("value")!=""){
                if ($q->password==md5($this->input->post("password"))){
                    $this->Mlab->changedata_ralan();
                } else {
                    $this->session->set_flashdata("message","danger-Password tidak sesuai ");
                }
            } else {
                $this->Mlab->changedata_ralan();
            }
        } else {
            $this->Mlab->changedata_ralan();
        }
    }
    function checkpassword(){
        $q = $this->db->get_where("analys",["nip"=>$this->input->post("value")])->row();
        if ($q->password==md5($this->input->post("password"))){
            echo "true";
        } else {
            echo "false";
        }
    }
    function changedata_inap(){
       $q = $this->db->get_where("perawat",["id_perawat"=>$this->input->post("value")])->row();
        if ($this->input->post("jenis")=="analys"){
            if ($this->input->post("value")!=""){
                if ($q->password==md5($this->input->post("password"))){
                    $this->Mlab->changedata_inap();
                } else {
                    $this->session->set_flashdata("message","danger-Password tidak sesuai ");
                }
            } else {
                $this->Mlab->changedata_inap();
            }
        } else {
            $this->Mlab->changedata_inap();
        }
    }
    function simpanekspertisi($action){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $message = $this->Mlab->simpanekspertisi($action);
        $this->session->set_flashdata("message",$message);
        redirect("lab/ekspertisi/".$no_pasien."/".$no_reg);
    }
    function simpanekspertisi_inap($action){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $t = $this->input->post("tanggal_pemeriksaan");
        $message = $this->Mlab->simpanekspertisi_inap($action);
        $this->session->set_flashdata("message",$message);
        redirect("lab/ekspertisi_inap/".$no_pasien."/".$no_reg."/".$t);
    }
    function simpanlab($jenis_pasien=""){
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $message = $this->Mlab->simpanlab($jenis_pasien);
        $this->session->set_flashdata("message",$message);
        if ($jenis_pasien=="inap"){
            redirect("lab/detaillab_inap/".$no_pasien."/".$no_reg);
        } else {
            redirect("lab/detaillab_ralan/".$no_pasien."/".$no_reg);
        }
    }
    function ekspertisi_inap($no_pasien,$no_reg,$tanggal="",$pemeriksaan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "lab";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["tgl"]            = $tanggal;
        $data["pemeriksaan"]    = $pemeriksaan;
        $data["title"]          = "Ekspertisi Inap || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi Inap";
        $data["content"]        = "lab/vformekspertisi_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi Inap</strong></li>";
        $data["row"]            = $this->Mlab->getinap_detail1($no_pasien,$no_reg,$tanggal,$pemeriksaan);
        // $data["q"]              = $this->Mlab->getekspertisiinap_detail($no_reg);
        // $data["d"]              = $this->Mlab->getdokter_lab();
        // $data["r"]              = $this->Mlab->getanalys();
        $data["k"]              = $this->Mlab->getlabinap_normal($no_reg,$tanggal,$pemeriksaan);
        $data["hasil"]          = $this->Mlab->getekspertisilabinap_detail_array($no_reg,$tanggal,$pemeriksaan);
        // $data["x"]              = $this->Mlab->getekspertisilabinap_detail($no_reg,$tanggal,$pemeriksaan);
        $data["ks"]             = $this->Mlab->getkasir_inap_ekspertisi($no_reg);
        $this->load->view('template',$data);
    }
    function cetak($no_reg){
        $data["no_reg"] = $no_reg;
        $data["q"]          = $this->Mlab->getcetak($no_reg);
        $data["analys"]     = $this->Mlab->getanalys_array();
        $data["q1"]          = $this->Mlab->getekspertisilab_detail($no_reg);
        $data["h"]              = $this->Mlab->getheader();
        // $data["k"]              = $this->Mlab->getekspertisilab_detailcetak($no_reg);
        $data["k"]              = $this->Mlab->getlab_normal($no_reg);
        $data["hasil"]          = $this->Mlab->getekspertisilab_detail_array($no_reg);
        $this->load->view('lab/vcetaklab',$data);
    }
    function cetak_covid($no_reg){
        $data["jenis"]      = "covid";
        $data["no_reg"]     = $no_reg;
        $data["q"]          = $this->Mlab->getcetak($no_reg);
        $data["q1"]         = $this->Mlab->getekspertisilab_detail_covid($no_reg);
        $data["swabke"]       = $this->Mlab->getswabke($no_reg);
        $data["k"]          = $this->Mlab->getlab_normal($no_reg);
        $data["hasil"]      = $this->Mlab->getekspertisilab_detail_array($no_reg);
        $this->load->view('lab/vcetakcovid',$data);
    }
    function cetak_covid2($no_reg,$jenis_kelamin){
        $data["jenis"]      = "covid2";
        $data["no_reg"]     = $no_reg;
        $data["jenis_kelamin"]     = $jenis_kelamin;
        $data["q"]          = $this->Mlab->getcetak($no_reg);
        $data["q1"]         = $this->Mlab->getekspertisilab_detail_covid($no_reg);
        $data["swabke"]       = $this->Mlab->getswabke($no_reg);
        // $data["k"]          = $this->Mlab->getlab_normal($no_reg);
        $data["hasil"]      = $this->Mlab->getekspertisilab_detail_array($no_reg);
        $this->load->view('lab/vcetakcovid',$data);
    }
    function cetak_covidp2($no_reg,$jenis_kelamin){
        $data["jenis"]      = "covid2";
        $data["no_reg"]     = $no_reg;
        $data["jenis_kelamin"]     = $jenis_kelamin;
        $data["q"]          = $this->Mlab->getcetak($no_reg);
        $data["q1"]         = $this->Mlab->getekspertisilab_detail_covid($no_reg);
        $data["swabke"]       = $this->Mlab->getswabke($no_reg);
        // $data["k"]          = $this->Mlab->getlab_normal($no_reg);
        $data["hasil"]      = $this->Mlab->getekspertisilab_detail_array($no_reg);
        $this->load->view('lab/vcetakcovid',$data);
    }
    function cetakinap($no_reg,$t="",$pemeriksaan=""){
        $data["no_reg"] = $no_reg;
        $data["q"]          = $this->Mlab->getcetakinap($no_reg);
        $data["dokter"]          = $this->Mlab->getdokter_array();
        $data["analys"]          = $this->Mlab->getanalys_array();
        $data["q1"]          = $this->Mlab->getekspertisilabinap_detail($no_reg,$t,$pemeriksaan);
        // $data["k"]              = $this->Mlab->getekspertisilabinap_detail($no_reg,$t,$pemeriksaan);
        $data["h"]              = $this->Mlab->getheader();
        $data["k1"]              = $this->Mlab->getlabinap_normal($no_reg,$t,$pemeriksaan);
        $data["gt"]              = $this->Mlab->gettanggal($no_reg,$t,$pemeriksaan);
        $this->load->view('lab/vcetaklabinap',$data);
    }
    function cetakinap_all($no_reg){
        $data["no_reg"] = $no_reg;
        $data["q"]          = $this->Mlab->getcetakinap($no_reg);
        $data["dokter"]          = $this->Mlab->getdokter_array();
        $data["analys"]          = $this->Mlab->getanalys_array();
        $data["q1"]          = $this->Mlab->getekspertisilabinap_detail($no_reg);
        // $data["k"]              = $this->Mlab->getekspertisilabinap_detail($no_reg,$t,$pemeriksaan);
        $data["h"]              = $this->Mlab->getheader();
        $data["k1"]              = $this->Mlab->getlabinap_normal($no_reg);
        $data["gt"]              = $this->Mlab->gettanggal($no_reg);
        $data["hs"]          = $this->Mlab->getekspertisilabinap_detail_array($no_reg);
        $this->load->view('lab/vcetaklabinap_all',$data);
    }
    function cetakinap_all_covid($no_reg){
        $data["no_reg"] = $no_reg;
        $data["q"]          = $this->Mlab->getcetakinap($no_reg);
        $data["dokter"]          = $this->Mlab->getdokter_array();
        $data["analys"]          = $this->Mlab->getanalys_array();
        $data["q1"]          = $this->Mlab->getekspertisilabinap_detail($no_reg);
        // $data["k"]              = $this->Mlab->getekspertisilabinap_detail($no_reg,$t,$pemeriksaan);
        $data["h"]              = $this->Mlab->getheader();
        $data["k1"]              = $this->Mlab->getlabinap_normal($no_reg);
        $data["gt"]              = $this->Mlab->gettanggal($no_reg);
        $data["hs"]          = $this->Mlab->getekspertisilabinap_detail_array($no_reg);
        $this->load->view('lab/vcetaklabinap_all_covid',$data);
    }
    function cetakcovid_inap($no_reg,$t="",$pemeriksaan=""){
        $data["jenis"]      = "covid";
        $data["no_reg"]     = $no_reg;
        $data["q"]          = $this->Mlab->getcetakinap($no_reg);
        $data["q1"]         = $this->Mlab->getekspertisilabinap_detail_covid($no_reg,$t,$pemeriksaan);
        // $data["k"]       = $this->Mlab->getekspertisilabinap_detail($no_reg,$t,$pemeriksaan);
        $data["swabke"]       = $this->Mlab->getswabinapke($no_reg);
        $data["k1"]         = $this->Mlab->getlabinap_normal($no_reg,$t,$pemeriksaan);
        $data["gt"]         = $this->Mlab->gettanggal($no_reg,$t,$pemeriksaan);
        $this->load->view('lab/vcetakcovid_inap',$data);
    }
    function cetakcovid_inap2($no_reg,$t="",$pemeriksaan="",$jenis_kelamin="L"){
        $data["jenis"]      = "covid2";
        $data["no_reg"]     = $no_reg;
        $data["jenis_kelamin"] = $jenis_kelamin;
        $data["q"]          = $this->Mlab->getcetakinap($no_reg);
        $data["q1"]         = $this->Mlab->getekspertisilabinap_detail_covid($no_reg,$t,$pemeriksaan);
        // $data["k"]       = $this->Mlab->getekspertisilabinap_detail($no_reg,$t,$pemeriksaan);
        $data["swabke"]       = $this->Mlab->getswabinapke($no_reg);
        $data["k1"]         = $this->Mlab->getlabinap_normal($no_reg,$t,$pemeriksaan);
        $data["gt"]         = $this->Mlab->gettanggal($no_reg,$t,$pemeriksaan);
        $this->load->view('lab/vcetakcovid_inap',$data);
    }
    function cetakcovidmulti_inap(){
        $data["q"]          = $this->Mlab->getcetakinap_multi();
        $no_reg				= $this->session->userdata("nr");
        $data["no_reg"] 	= $no_reg;
        $data["q1"]     	= $this->Mlab->getekspertisilabinap_detail_covid_multi();
        // var_dump($this->Mlab->getekspertisilabinap_detail_covid_multi());
        $this->load->view('lab/vcetakcovidmulti_inap',$data);
    }
    function postnoreg(){
        $this->session->set_userdata("nr",$this->input->post("noreg"));
    }
    function cetakpasien_ralan($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["tindakan"] = $tindakan;
        $data["q"]      = $this->Mlab->getpasien_rekap($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakpasien_ralan',$data);
    }
    function cetakpasien_inap($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["tindakan"] = $tindakan;
        $data["q"]          = $this->Mlab->getpasien_rekap_inap($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakpasien_inap',$data);
    }
    function hapusinap(){
        $this->Mlab->hapusinap();
    }
    function hapusralan(){
        $this->Mlab->hapusralan();
    }
    function getanalys(){
        echo json_encode($this->Mlab->getanalys()->result());
    }
    function getdokter(){
        echo json_encode($this->Mlab->getdokter()->result());
    }
    function getmetode(){
        echo json_encode($this->Mlab->getmetode()->result());
    }
    function getdokterall(){
        echo json_encode($this->Mlab->getdokterall()->result());
    }
    function terima($no_rm,$no_reg){
        $message = $this->Mlab->terima($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("lab/ralan");
    }
    function periksa($no_rm,$no_reg){
        $message = $this->Mlab->periksa($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("lab/ralan");
    }
    function respond($no_rm,$no_reg){
        $data["q"]          = $this->Mlab->getrespond($no_rm,$no_reg);
        $this->load->view('lab/vrespond_time',$data);
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function terima_inap($no_rm,$no_reg){
        $message = $this->Mlab->terima_inap($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("lab/inap");
    }
    function periksa_inap($no_rm,$no_reg){
        $message = $this->Mlab->periksa_inap($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("lab/inap");
    }
    function respond_inap($no_rm,$no_reg){
        $data["q"]          = $this->Mlab->getrespond_inap($no_rm,$no_reg);
        $this->load->view('lab/vrespond_timeinap',$data);
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function formuploadpdf_inap($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "lab";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Upload PDF Rawat Inap || RS CIREMAI";
        $data["title_header"]   = "Upload PDF Rawat Inap";
        $data["content"]        = "lab/vformuploadpdf_inap";
        $data["q"]              = $this->Mgrouper->getfilepdf_inap($no_reg);
        $data["j"]              = $this->Mlab->getjenisfile();
        $data["breadcrumb"]     = "<li class='active'><strong>Upload PDF Rawat Inap</strong></li>";
        $this->load->view('template',$data);
    }
    function uploadpdf_inap(){
        for ($i=0;$i<=100;$i++){
            $n = $i;

            $this->db->select("count(*) as total");
            $this->db->where("no_reg",$this->input->post("no_reg"));

            $q = $this->db->get("pdf_inap")->row();
            if ($q->total==$n){
                $a = $n;
            }
            else{
                $a = 1;
            }
        }
        $config['upload_path']          = './file_pdf/inap/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['file_name']            = "Inap-".$this->input->post("no_reg")."-".$this->input->post("jenisfile")."-".$a;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('pdf_inap'))
        {
            $message = "danger-Gagal diupload";
            $this->session->set_flashdata("message",$message);
            redirect("lab/formuploadpdf_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
        else
        {
            $data = array(
                            'upload_data' => $this->upload->data('file_name'),
                        );
            $nama_file =  $data['upload_data'];
            $message = $this->Mgrouper->uploadpdf_inap($nama_file);
            $this->session->set_flashdata("message",$message);
            redirect("lab/formuploadpdf_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
    }
    function formuploadpdf_ralan($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "lab";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Upload PDF Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Upload PDF Rawat Jalan";
        $data["content"]        = "lab/vformuploadpdf_ralan";
        $data["q"]              = $this->Mgrouper->getfilepdf_ralan($no_reg);
        $data["breadcrumb"]     = "<li class='active'><strong>Upload PDF Rawat Jalan</strong></li>";
        $data["j"]              = $this->Mlab->getjenisfile();
        $this->load->view('template',$data);
    }
    function uploadpdf_ralan(){
        for ($i=0;$i<=100;$i++){
            $n = $i;

            $this->db->select("count(*) as total");
            $this->db->where("no_reg",$this->input->post("no_reg"));

            $q = $this->db->get("pdf_ralan")->row();
            if ($q->total==$n){
                $a = $n;
            }
            else{
                $a = 1;
            }
        }
        $config['upload_path']          = './file_pdf/ralan/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['file_name']            = "Ralan-".$this->input->post("no_reg")."-".$this->input->post("jenisfile")."-".$a;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('pdf_ralan'))
        {
            $message = "danger-Gagal diupload";
            $this->session->set_flashdata("message",$message);
            redirect("lab/formuploadpdf_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
        else
        {
            $data = array(
                            'upload_data' => $this->upload->data('file_name'),
                        );
            $nama_file =  $data['upload_data'];
            $message = $this->Mgrouper->uploadpdf_ralan($nama_file);
            $this->session->set_flashdata("message",$message);
            redirect("lab/formuploadpdf_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
    }
    function labrekap_ralan($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="home";
        $data["title"]        = "Rekap Lab Ralan || RS CIREMAI";
        $data["title_header"] = "Rekap Lab Ralan";
        $data["content"] = "lab/vlabrekap_ralan";
        $data["t"] = $this->Mlab->gettindakan();
        $data["p"] = $this->Mlab->labrekap_ralan($tindakan,$tgl1,$tgl2);
        $data["breadcrumb"]   = "<li class='active'><strong>Rekap Ralan</strong></li>";
        $this->load->view('template',$data);
    }
    function getpasien_rekap($tindakan,$tgl1,$tgl2){
        echo json_encode($this->Mlab->getpasien_rekap($tindakan,$tgl1,$tgl2));
    }
    function getpasien_rekap_inap($tindakan,$tgl1,$tgl2){
        echo json_encode($this->Mlab->getpasien_rekap_inap($tindakan,$tgl1,$tgl2));
    }
    function cetakrekap_ralan($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap Lab Ralan || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap Lab Ralan";
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->labrekap_ralan($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakrekaplab_ralan',$data);
    }
    function excelrekap_ralan($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->labrekap_ralan($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vexcelrekaplab_ralan',$data);
    }
    function labrekap_inap($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="home";
        $data["title"]        = "Rekap Lab Inap || RS CIREMAI";
        $data["title_header"] = "Rekap Lab Inap";
        $data["content"] = "lab/vlabrekap_inap";
        $data["t"] = $this->Mlab->gettindakan();
        $data["p"] = $this->Mlab->labrekap_inap($tindakan,$tgl1,$tgl2);
        $data["breadcrumb"]   = "<li class='active'><strong>Rekap Inap</strong></li>";
        $this->load->view('template',$data);
    }
    function cetakrekap_inap($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap Lab Ralan || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap Lab Ralan";
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->labrekap_inap($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakrekaplab_inap',$data);
    }
    function excelrekap_inap($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->labrekap_inap($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vexcelrekaplab_inap',$data);
    }
    function getttddokter($id_dokter){
        $image = "data:image/gif;base64,".$this->Mlab->getttddokter($id_dokter)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail' style='width:100px;height:100px'>";
    }
    function cekusername(){
        $q = $this->db->get_where("perawat",["id_perawat"=>$this->input->post("username"),"password"=>md5($this->input->post("password")),"bagian"=>"0102024"]);
        if ($q->num_rows()>0){
            echo "true";
        } else
            echo "false";
    }
    function cekkasir_detail(){
        $q = $this->Mlab->cekkasir_detail();
        echo $q->num_rows();
    }
    function cekkasirinap_detail(){
        $q = $this->Mlab->cekkasirinap_detail();
        echo $q->num_rows();
    }
    function rekap_full($tindakan,$tgl1="",$tgl2=""){
      $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
      $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
      $data["tgl1"] = $tgl1;
      $data["tgl2"] = $tgl2;
      $data["tindakan"] = $tindakan;
      $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
      $data['menu']="home";
      $data["title"]        = "Rekap Lab || RS CIREMAI";
      $data["title_header"] = "Rekap Lab ";
      $data["content"] = "lab/vlabrekap_full";
      $data["t"] = $this->Mlab->gettindakan();
      $data["p"] = $this->Mlab->rekap_ralan_full($tindakan,$tgl1,$tgl2);
      $data["p_inap"] = $this->Mlab->rekap_inap_full($tindakan,$tgl1,$tgl2);
      $data["breadcrumb"]   = "<li class='active'><strong>Rekap Full</strong></li>";
      $this->load->view('template',$data);
    }
    function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
      echo json_encode($this->Mlab->getpasien_rekap_full($tindakan,$tgl1,$tgl2));
    }
    function cetakpasien_full($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["tindakan"] = $tindakan;
        $data["q"] = $this->Mlab->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakpasien_full',$data);
    }
    function cetakpasien_fullk($tindakan, $tgl1="", $tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["tindakan"] = $tindakan;
        $data["q"] = $this->Mlab->getpasien_rekap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakpasien_fullk',$data);
    }
    function cetakrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap Radiologi Ralan || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap Radiologi Ralan";
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mlab->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakrekap_full',$data);
    }
    function cetakrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["title"]        = "Cetak Rekap Radiologi Ralan || RS CIREMAI";
        $data["title_header"] = "Cetak Rekap Radiologi Ralan";
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mlab->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vcetakrekap_full2',$data);
    }
    function excelrekap_full($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mlab->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vlabexcelrekap_full',$data);
      }
      function excelrekap_full2($tindakan,$tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("d-m-Y") : $tgl1;
        $tgl2 = $tgl2=="" ? date("d-m-Y") : $tgl2;
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["tindakan"] = $tindakan;
        $data["t"] = $this->Mlab->gettindakan_cetak($tindakan);
        $data["t2"] = $this->Mlab->gettindakan_cetak2($tindakan);
        $data["p"] = $this->Mlab->rekap_ralan_full($tindakan,$tgl1,$tgl2);
        $data["p_inap"] = $this->Mlab->rekap_inap_full($tindakan,$tgl1,$tgl2);
        $this->load->view('lab/vlabexcelrekap_full2',$data);
      }
}
?>
