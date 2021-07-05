<?php
class Apotek_farmasi extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek_farmasi');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function list_ralan($current=0,$from=0){
		$data["title"]                  = $this->session->userdata('status_user');
		$data['judul']                  = "Apotek Rawat Jalan &nbsp;&nbsp;&nbsp;";
		$data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";;
		$data["content"]                = "farmasi/apotek/vlistralan_apotek";
		$data["username"]               = $this->session->userdata('nama_user');
	    $data['menu']                   = "apotek";
	    $data["current"]                = $current;
	    $data["title_header"]           = "Apotek Rawat Jalan ";
	    $data["p"]                      = $this->Mpendaftaran->getpoli();
	    $data["breadcrumb"]             = "<li class='active'><strong>Apotek Rawat Jalan</strong></li>";		
		$this->load->library('pagination');
        $config['base_url']             = base_url().'apotek_farmasi/list_ralan/'.$current;
        $config['total_rows']           = $this->Mpendaftaran->getpasien_rawatjalan();
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
        $data["igd"]                    = false;
        $this->pagination->initialize($config);
		$data["q3"]                     = $this->Mapotek_farmasi->getpasien_ralan(false,$config['per_page'],$from);
		$this->load->view('template',$data);
    }
    function list_inap($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Apotek Rawat Inap &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";;
        $data["content"]                = "farmasi/apotek/vlistinap_apotek";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "apotek";
        $data["current"]                = $current;
        $data["title_header"]           = "Apotek Rawat Inap ";
        $data["p"]                      = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"]             = "<li class='active'><strong>Apotek Rawat Inap</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'apotek_farmasi/list_inap/'.$current;
        $config['total_rows']           = $this->Mpendaftaran->getpasien_rawatjalan();
        $config['per_page']             = 10;
        $config['full_tag_open']        = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']       = '</ul>';
        $config['cur_tag_open']         = '<li c=active><a>';
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
        $data["igd"]                    = false;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mpendaftaran->getpasien_inap($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function getcaripasien_ralan(){
        $this->session->set_flashdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_flashdata("nama",$this->input->post("cari_nama"));
        $this->session->set_flashdata("no_reg",$this->input->post("cari_noreg"));
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
    function reset_ralan(){
        $this->session->unset_userdata('poli_kode'); 
        $this->session->unset_userdata('poliklinik');
        $this->session->unset_userdata('kode_dokter'); 
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1'); 
        $this->session->unset_userdata('tgl2');
        redirect("apotek_farmasi/list_ralan");
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
        redirect("apotek_farmasi/list_inap");
    }
    function getcaripasien_igd(){
        $this->session->set_flashdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_flashdata("nama",$this->input->post("cari_nama"));
        $this->session->set_flashdata("no_reg",$this->input->post("cari_noreg"));
    }
    function search_igd(){
        $this->session->set_userdata('poli_kode',$this->input->post("poli_kode"));
        $this->session->set_userdata('poliklinik',$this->input->post("poliklinik"));
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
        $this->session->set_userdata('dokter',$this->input->post("dokter"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function reset_igd(){
        $this->session->unset_userdata('poli_kode'); 
        $this->session->unset_userdata('poliklinik');
        $this->session->unset_userdata('kode_dokter'); 
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1'); 
        $this->session->unset_userdata('tgl2');
        redirect("apotek_farmasi/list_igd");
    }
    function viewapotek_ralan($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";;
        $data['menu']           = "apotek";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Apotek Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Apotek Rawat Jalan";
        $data["content"]        = "farmasi/apotek/vviewapotek_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Apotek Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mapotek_farmasi->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek_farmasi->getapotek($no_reg);
        $data["q"]              = $this->Mapotek_farmasi->getapotek_detail($no_reg);
        $data["aturan"]         = $this->Mapotek_farmasi->getaturan_pakai();
        $data["waktu"]          = $this->Mapotek_farmasi->getwaktu_pakai();
        $data["t"]              = $this->Mapotek_farmasi->getobat();
        $data["wl"]             = $this->Mapotek_farmasi->getwaktulainnya();
        $data["tak"]            = $this->Mapotek_farmasi->gettakaran();
        $this->load->view('template',$data);
    }
    function viewapotek_inap($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";;
        $data['menu']           = "apotek";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Apotek Rawat Inap || RS CIREMAI";
        $data["title_header"]   = "Apotek Rawat Inap";
        $data["content"]        = "farmasi/apotek/vviewapotek_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Apotek Rawat Inap</strong></li>";
        $data["row"]            = $this->Mapotek_farmasi->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek_farmasi->getapotek_inap($no_reg);
        $data["q"]              = $this->Mapotek_farmasi->getapotek_detail($no_reg);
        $data["aturan"]         = $this->Mapotek_farmasi->getaturan_pakai();
        $data["waktu"]          = $this->Mapotek_farmasi->getwaktu_pakai();
        $data["t"]              = $this->Mapotek_farmasi->getobat();
        $data["wl"]             = $this->Mapotek_farmasi->getwaktulainnya();
        $data["tak"]            = $this->Mapotek_farmasi->gettakaran();
        $data["dokter"]         = $this->Mapotek_farmasi->getdokter();
        $this->load->view('template',$data);
    }
    function addobat(){
        $this->Mapotek_farmasi->addobat();
        $this->session->set_flashdata("message","success-Obat berhasil ditambahkan");
        redirect("apotek_farmasi/viewapotek_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function addobat_inap(){
        $this->Mapotek_farmasi->addobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil ditambahkan");
        redirect("apotek_farmasi/viewapotek_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function addobat1(){
        $this->Mapotek_farmasi->addobat();
        $this->session->set_flashdata("message","success-Obat berhasil ditambahkan");
        redirect("dokter/apotek_igd/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function simpanwaktu_inap(){
        $this->Mapotek_farmasi->simpanwaktu_inap();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
        redirect("apotek_farmasi/viewapotek_inap/".$this->input->post("no_rm")."/".$this->input->post("no_reg"));
        // redirect("apotek_farmasi/viewapotek_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function simpanwaktu_ralan(){
        $this->Mapotek_farmasi->simpanwaktu_ralan();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
        redirect("apotek_farmasi/viewapotek_ralan/".$this->input->post("no_rm")."/".$this->input->post("no_reg"));
        // redirect("apotek_farmasi/viewapotek_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function changedata($change="qty"){
        $this->Mapotek_farmasi->changedata($change);
    }
    function changedata_inap(){
        $this->Mapotek_farmasi->changedata_inap();
    }
    function hapusobat(){
        $this->Mapotek_farmasi->hapusobat();
        $this->session->set_flashdata("message","danger-Obat berhasil dihapus");
    }
    function hapusobat_inap(){
        $this->Mapotek_farmasi->hapusobat_inap();
        $this->session->set_flashdata("message","danger-Obat berhasil dihapus");
    }
    function simpanobat(){
        $this->Mapotek_farmasi->simpanobat();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
    }
    function simpanobat_inap(){
        $this->Mapotek_farmasi->simpanobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
    }
    // function simpanobat_inap(){
    //     $this->Mapotek_farmasi->simpanwaktu_inap();
    //     $this->session->set_flashdata("message","success-Obat berhasil disimpan");
    // }
    function list_igd($current=0,$from=0){
        $data["title"]              = $this->session->userdata('status_user');
        $data['judul']              = "Pasien IGD &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";;
        $data["content"]            = "farmasi/apotek/vlistigd_apotek";
        $data["username"]           = $this->session->userdata('nama_user');
        $data['menu']               = "apotek";
        $data["current"]            = $current;
        $data["title_header"]       = "Pasien IGD ";
        $data["p"]                  = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"]         = "<li class='active'><strong>Pasien IGD</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']         = base_url().'apotek_farmasi/list_igd/'.$current;
        $config['total_rows']       = $this->Mpendaftaran->getpasien_rawatjalan();
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']   = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['num_links']        = 4;
        $config['uri_segment']      = 4;
        $from = $this->uri->segment(4);
        $data["from"]               = $from;
        $data["igd"]                = true;
        $this->pagination->initialize($config);
        $data["q3"]                 = $this->Mapotek_farmasi->getpasien_ralan(true,$config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function viewapotek_igd($no_pasien,$no_reg){
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";;
        $data['menu']               = "apotek";
        $data["no_pasien"]          = $no_pasien;
        $data["no_reg"]             = $no_reg;
        $data["title"]              = "Apotek IGD || RS CIREMAI";
        $data["title_header"]       = "Apotek IGD";
        $data["content"]            = "farmasi/apotek/vviewapotek_igd";
        $data["breadcrumb"]         = "<li class='active'><strong>Apotek IGD</strong></li>";
        $data["row"]                = $this->Mapotek_farmasi->getralan_detail($no_pasien,$no_reg);
        $data["k"]                  = $this->Mapotek_farmasi->getapotek($no_reg);
        $data["q"]                  = $this->Mapotek_farmasi->getapotek_detail($no_reg);
        $data["aturan"]             = $this->Mapotek_farmasi->getaturan_pakai();
        $data["waktu"]              = $this->Mapotek_farmasi->getwaktu_pakai();
        $data["t"]                  = $this->Mapotek_farmasi->getobat();
        $data["tak"]                = $this->Mapotek_farmasi->gettakaran();
        $data["wl"]                 = $this->Mapotek_farmasi->getwaktulainnya();
        $this->load->view('template',$data);
    }
    function cetak($no_pasien, $no_reg){
        $data["no_reg"]             = $no_reg;
        $data["q"]                  = $this->Mapotek_farmasi->getcetak($no_pasien, $no_reg);
        $data["q1"]                 = $this->Mapotek_farmasi->getapotek($no_reg);
        $this->Mapotek_farmasi->printobat_ralan($no_pasien, $no_reg);
        // $data["nota"]          = $this->Mapotek_farmasi->getnota();
        $this->load->view('farmasi/apotek/vcetakapotek',$data);    
    }
    function cetak_inap($no_pasien,$no_reg,$id_dokter,$tgl1,$tgl2){
        $data["no_reg"]             = $no_reg;
        $data["q"]                  = $this->Mapotek_farmasi->getcetak_inap($no_pasien, $no_reg);
        $data["q1"]                 = $this->Mapotek_farmasi->getapotek_inap_cetak($no_reg,$id_dokter,$tgl1,$tgl2);
        $this->Mapotek_farmasi->printobat_inap($no_pasien, $no_reg);
        // $data["nota"]          = $this->Mapotek_farmasi->getnota_inap();
        $this->load->view('farmasi/apotek/vcetakapotek_inap',$data);    
    }
    function terima($no_rm,$no_reg){
        $message                    = $this->Mapotek_farmasi->terima($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek_farmasi/list_igd");
    }
    function obat($no_rm,$no_reg){
        $message = $this->Mapotek_farmasi->obat($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek_farmasi/list_igd");
    }
    function respond($no_rm, $no_reg){
        $data["q"]                  = $this->Mapotek_farmasi->getrespond($no_rm,$no_reg); 
        $this->load->view('farmasi/apotek/vrespond_time',$data);    
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function terima_ralan($no_rm,$no_reg){
        $message                    = $this->Mapotek_farmasi->terima_ralan($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek_farmasi/list_ralan");
    }
    function obat_ralan($no_rm,$no_reg){
        $message                    = $this->Mapotek_farmasi->obat_ralan($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek_farmasi/list_ralan");
    }
    function respond_ralan($no_rm,$no_reg){
        $data["q"]                  = $this->Mapotek_farmasi->getrespond_ralan($no_rm,$no_reg); 
        $this->load->view('farmasi/apotek/vrespond_timeralan',$data);    
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function terima_inap($no_rm,$no_reg){
        $message = $this->Mapotek_farmasi->terima_inap($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek_farmasi/list_inap");
    }
    function obat_inap($no_rm,$no_reg){
        $message = $this->Mapotek_farmasi->obat_inap($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek_farmasi/list_inap");
    }
    function respond_inap($no_rm,$no_reg){
        $data["q"]          = $this->Mapotek_farmasi->getrespond_inap($no_rm,$no_reg); 
        $this->load->view('farmasi/apotek/vrespond_timeinap',$data);    
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function formuploadpdf($jenis='ralan',$no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";;
        $data['menu']           = "apotek";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Upload PDF ".($jenis=="igd" ? "IGD" : ucfirst($jenis))." || RS CIREMAI";
        $data["title_header"]   = "Upload PDF ".($jenis=="igd" ? "IGD" : ucfirst($jenis));
        $data["content"]        = "farmasi/apotek/vformuploadpdf";
        $data["q"]              = $this->Mapotek_farmasi->getfilepdf($jenis,$no_reg);
        $data["j"]              = $this->Mapotek_farmasi->getjenisfile();
        $data["breadcrumb"]     = "<li class='active'><strong>Upload PDF ".($jenis=="igd" ? "IGD" : ucfirst($jenis))."</strong></li>";
        $data["jenis"]          = $jenis;
        $this->load->view('template',$data);
    }
    function uploadpdf($jenis){
        for ($i=0;$i<=100;$i++){
            $n = $i;

            $this->db->select("count(*) as total");
            $this->db->where("no_reg",$this->input->post("no_reg"));
            if ($jenis=="igd") $jns = "ralan"; else $jns = $jenis;
            $q = $this->db->get("pdfapotek_".$jns)->row();
            if ($q->total==$n){
                $a = $n;
            }
            else{
                $a = 1;
            }
        }
        $config['upload_path']          = './file_pdf/'.$jns.'/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['file_name']            = ucfirst($jenis)."-".$this->input->post("no_reg")."-".$this->input->post("jenisfile")."-".$a;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('pdfapotek'))
        {
            $message = "danger-Gagal diupload";
            $this->session->set_flashdata("message",$message);
            redirect("apotek_farmasi/formuploadpdf/".$jenis."/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
        else
        {
            $data = array(
                            'upload_data' => $this->upload->data('file_name'),
                        );
            $nama_file =  $data['upload_data'];
            $message = $this->Mapotek_farmasi->uploadpdf($jenis,$nama_file);
            $this->session->set_flashdata("message",$message);
            redirect("apotek_farmasi/formuploadpdf/".$jenis."/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
    }
    function laporanharian_ralan($tgl1="",$tgl2=""){
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";;
        $data['menu']           = "apotek";
        if ($tgl1=="") {
            $tanggal1 = date("Y-m-d");
        } else {
            $tanggal1 = $tgl1;
        }
        if ($tgl2=="") {
            $tanggal2 = date("Y-m-d");
        } else {
            $tanggal2 = $tgl2;
        }
        $data["tgl1"]           = $tanggal1;
        $data["tgl2"]           = $tanggal2;
        $data["title"]          = "Laporan Harian Apotek Ralan  || RS CIREMAI";
        $data["title_header"]   = "Laporan Harian Apotek Ralan ";
        $data["content"]        = "farmasi/apotek/vlaporanharian_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Laporan Harian Apotek Ralan </strong></li>";
        $data["q"]              = $this->Mapotek_farmasi->getlaporanharian_ralan($tanggal1,$tanggal2);
        $data["q2"]             = $this->Mapotek_farmasi->getgolongan_ralan($tanggal1,$tanggal2);
        $data["q3"]             = $this->Mapotek_farmasi->getgolonganqty_ralan($tanggal1,$tanggal2);
        $this->load->view('template',$data);
    }
    function laporanharian_inap($tgl1="",$tgl2=""){
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";;
        $data['menu']           = "apotek";
        if ($tgl1=="") {
            $tanggal1 = date("Y-m-d");
        } else {
            $tanggal1 = $tgl1;
        }
        if ($tgl2=="") {
            $tanggal2 = date("Y-m-d");
        } else {
            $tanggal2 = $tgl2;
        }
        $data["tgl1"]           = $tanggal1;
        $data["tgl2"]           = $tanggal2;
        $data["title"]          = "Laporan Harian Apotek Inap  || RS CIREMAI";
        $data["title_header"]   = "Laporan Harian Apotek Inap ";
        $data["content"]        = "farmasi/apotek/vlaporanharian_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Laporan Harian Apotek Inap </strong></li>";
        $data["q"]              = $this->Mapotek_farmasi->getlaporanharian_inap($tanggal1,$tanggal2);
        $data["q2"]             = $this->Mapotek_farmasi->getgolongan_inap($tanggal1,$tanggal2);
        $data["q3"]             = $this->Mapotek_farmasi->getgolonganqty_inap($tanggal1,$tanggal2);
        $this->load->view('template',$data);
    }
    function laporanharian_igd($tgl1="",$tgl2=""){
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";;
        $data['menu']           = "apotek";
        if ($tgl1=="") {
            $tanggal1 = date("Y-m-d");
        } else {
            $tanggal1 = $tgl1;
        }
        if ($tgl2=="") {
            $tanggal2 = date("Y-m-d");
        } else {
            $tanggal2 = $tgl2;
        }
        $data["tgl1"]           = $tanggal1;
        $data["tgl2"]           = $tanggal2;
        $data["title"]          = "Laporan Harian Apotek IGD  || RS CIREMAI";
        $data["title_header"]   = "Laporan Harian Apotek IGD ";
        $data["content"]        = "farmasi/apotek/vlaporanharian_igd";
        $data["breadcrumb"]     = "<li class='active'><strong>Laporan Harian Apotek IGD </strong></li>";
        $data["q"]              = $this->Mapotek_farmasi->getlaporanharian_igd($tanggal1,$tanggal2);
        $data["q2"]             = $this->Mapotek_farmasi->getgolongan_igd($tanggal1,$tanggal2);
        $data["q3"]             = $this->Mapotek_farmasi->getgolonganqty_igd($tanggal1,$tanggal2);

        $data["q4"]             = $this->Mapotek_farmasi->getlaporanharianinap_igd($tanggal1,$tanggal2);
        $data["q5"]             = $this->Mapotek_farmasi->getgolonganinap_igd($tanggal1,$tanggal2);
        $data["q6"]             = $this->Mapotek_farmasi->getgolonganqtyinap_igd($tanggal1,$tanggal2);
        $this->load->view('template',$data);
    }
    function viewterimaapotek_inap($no_pasien,$no_reg){
        $data["vmenu"] = "pendaftaran/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Apotek Rawat Inap";
        $data["content"] = "farmasi/apotek/vviewterimaapotek_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek Rawat Inap</strong></li>";
        $data["row"]              = $this->Mapotek_farmasi->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek_farmasi->getterimaapotek_inap($no_reg);
        $data["q"]              = $this->Mapotek_farmasi->getapotek_detail($no_reg);
        $data["aturan"]         = $this->Mapotek_farmasi->getaturan_pakai();
        $data["waktu"]         = $this->Mapotek_farmasi->getwaktu_pakai();
        $data["wl"]     = $this->Mapotek_farmasi->getwaktulainnya();
        $data["tak"]   = $this->Mapotek_farmasi->gettakaran();
        $this->load->view('template',$data);
    }
    function simpanterimaobat_inap(){
        $this->Mapotek_farmasi->simpanterimaobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil diterima");
    }
    function cekstatus($status,$no_reg){
        $data = array($status => "0000-00-00 00:00:00","no_reg"=>$no_reg);
        $q = $this->db->get("apotek_inap");
        if ($q->num_rows()>0){
            echo "0";
        } else {
            echo "1";
        }
    }
}
?>