<?php
class Apotek extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mapotek');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function list_ralan($current=0,$from=0){
      $data["title"] = $this->session->userdata('status_user');
      $data['judul'] = "Pasien Rawat Jalan &nbsp;&nbsp;&nbsp;";
      $data["vmenu"] = "pendaftaran/vmenu";
      $data["content"] = "apotek/vlistralan_apotek";
      $data["username"] = $this->session->userdata('nama_user');
      $data['menu']="apotek";
      $data["current"] = $current;
      $data["title_header"] = "Pasien Rawat Jalan ";
      $data["p"] = $this->Mpendaftaran->getpoli();
      $data["breadcrumb"] = "<li class='active'><strong>Pasien Rawat Jalan</strong></li>";
      $this->load->library('pagination');
      $config['base_url'] = base_url().'apotek/list_ralan/'.$current;
      $config['total_rows'] = $this->Mpendaftaran->getpasien_rawatjalan();
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
      $data["igd"] = false;
      $this->pagination->initialize($config);
      $data["q3"] =$this->Mapotek->getpasien_ralan(false,$config['per_page'],$from);
      $this->load->view('template',$data);
    }
    function list_inap($current=0,$from=0){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Pasien Rawat Inap &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = "pendaftaran/vmenu";
        $data["content"] = "apotek/vlistinap_apotek";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="apotek";
        $data["current"] = $current;
        $data["title_header"] = "Pasien Rawat Inap ";
        $data["p"] = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"] = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";
        $this->load->library('pagination');
        $config['base_url'] = base_url().'apotek/list_inap/'.$current;
        $config['total_rows'] = $this->Mpendaftaran->getpasien_rawatjalan();
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
        $data["igd"] = false;
        $this->pagination->initialize($config);
        $data["q3"] =$this->Mpendaftaran->getpasien_inap($config['per_page'],$from);
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
        redirect("apotek/list_ralan");
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
        redirect("apotek/list_inap");
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
        redirect("apotek/list_igd");
    }
    function viewapotek_ralan($no_pasien,$no_reg){
        $data["vmenu"] = "pendaftaran/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek Rawat Jalan || RS CIREMAI";
        $data["title_header"] = "Apotek Rawat Jalan";
        $data["content"] = "apotek/vviewapotek_ralan";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek Rawat Jalan</strong></li>";
        $data["row"]              = $this->Mapotek->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek->getapotek($no_reg);
        $data["q"]              = $this->Mapotek->getapotek_detail($no_reg);
        $data["aturan"]         = $this->Mapotek->getaturan_pakai();
        $data["waktu"]         = $this->Mapotek->getwaktu_pakai();
        $data["t"]  = $this->Mapotek->getobat();
        $data["wl"]     = $this->Mapotek->getwaktulainnya();
        $data["tak"]   = $this->Mapotek->gettakaran();
        $this->load->view('template',$data);
    }
    function viewapotek_inap($no_pasien,$no_reg){
        $data["vmenu"] = "pendaftaran/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Apotek Rawat Inap";
        $data["content"] = "apotek/vviewapotek_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek Rawat Inap</strong></li>";
        $data["row"]              = $this->Mapotek->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek->getapotek_inap($no_reg);
        $data["q"]              = $this->Mapotek->getapotek_detail($no_reg);
        $data["aturan"]         = $this->Mapotek->getaturan_pakai();
        $data["waktu"]         = $this->Mapotek->getwaktu_pakai();
        $data["t"]  = $this->Mapotek->getobat();
        $data["wl"]     = $this->Mapotek->getwaktulainnya();
        $data["tak"]   = $this->Mapotek->gettakaran();
        $data["dokter"]              = $this->Mapotek->getdokter();
        $this->load->view('template',$data);
    }
    function viewterimaapotek_inap($no_pasien,$no_reg){
        $data["vmenu"] = "pendaftaran/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Apotek Rawat Inap";
        $data["content"] = "apotek/vviewterimaapotek_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek Rawat Inap</strong></li>";
        $data["row"]              = $this->Mapotek->getinap_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek->getterimaapotek_inap($no_reg);
        $data["q"]              = $this->Mapotek->getapotek_detail($no_reg);
        $data["aturan"]         = $this->Mapotek->getaturan_pakai();
        $data["waktu"]         = $this->Mapotek->getwaktu_pakai();
        $data["wl"]     = $this->Mapotek->getwaktulainnya();
        $data["tak"]   = $this->Mapotek->gettakaran();
        $this->load->view('template',$data);
    }
    function addobat(){
        $this->Mapotek->addobat();
        $this->session->set_flashdata("message","success-Obat berhasil ditambahkan");
        redirect("apotek/viewapotek_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function addobat_inap(){
        $this->Mapotek->addobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil ditambahkan");
        redirect("apotek/viewapotek_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function addobat1(){
        $this->Mapotek->addobat();
        $this->session->set_flashdata("message","success-Obat berhasil ditambahkan");
        redirect("dokter/apotek_igd/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function simpanwaktu_inap(){
        $this->Mapotek->simpanwaktu_inap();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
        redirect("apotek/viewapotek_inap/".$this->input->post("no_rm")."/".$this->input->post("no_reg"));
        // redirect("apotek/viewapotek_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function simpanwaktu_ralan(){
        $this->Mapotek->simpanwaktu_ralan();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
        redirect("apotek/viewapotek_ralan/".$this->input->post("no_rm")."/".$this->input->post("no_reg"));
        // redirect("apotek/viewapotek_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
    }
    function changedata($change="qty"){
        $this->Mapotek->changedata($change);
    }
    function changedata_inap(){
        $this->Mapotek->changedata_inap();
    }
    function hapusobat(){
        $this->Mapotek->hapusobat();
        $this->session->set_flashdata("message","danger-Obat berhasil dihapus");
    }
    function hapusobat_inap(){
        $this->Mapotek->hapusobat_inap();
        $this->session->set_flashdata("message","danger-Obat berhasil dihapus");
    }
    function simpanobat(){
        $this->Mapotek->simpanobat();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
    }
    function simpanobat_inap(){
        $this->Mapotek->simpanobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil disimpan");
    }
    function simpanterimaobat_inap(){
        $this->Mapotek->simpanterimaobat_inap();
        $this->session->set_flashdata("message","success-Obat berhasil diterima");
    }
    // function simpanobat_inap(){
    //     $this->Mapotek->simpanwaktu_inap();
    //     $this->session->set_flashdata("message","success-Obat berhasil disimpan");
    // }
    function list_igd($current=0,$from=0){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Pasien IGD &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = "pendaftaran/vmenu";
        $data["content"] = "apotek/vlistigd_apotek";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="apotek";
        $data["current"] = $current;
        $data["title_header"] = "Pasien IGD ";
        $data["p"] = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"] = "<li class='active'><strong>Pasien IGD</strong></li>";
        $this->load->library('pagination');
        $config['base_url'] = base_url().'apotek/list_igd/'.$current;
        $config['total_rows'] = $this->Mpendaftaran->getpasien_rawatjalan();
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
        $data["igd"] = true;
        $this->pagination->initialize($config);
        $data["q3"] =$this->Mapotek->getpasien_ralan(true,$config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function viewapotek_igd($no_pasien,$no_reg){
        $data["vmenu"] = "pendaftaran/vmenu";
        $data['menu']="apotek";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Apotek IGD || RS CIREMAI";
        $data["title_header"] = "Apotek IGD";
        $data["content"] = "apotek/vviewapotek_igd";
        $data["breadcrumb"]   = "<li class='active'><strong>Apotek IGD</strong></li>";
        $data["row"]              = $this->Mapotek->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mapotek->getapotek($no_reg);
        $data["q"]              = $this->Mapotek->getapotek_detail($no_reg);
        $data["aturan"]         = $this->Mapotek->getaturan_pakai();
        $data["waktu"]         = $this->Mapotek->getwaktu_pakai();
        $data["t"]  = $this->Mapotek->getobat();
        $data["tak"]   = $this->Mapotek->gettakaran();
        $data["wl"]     = $this->Mapotek->getwaktulainnya();
        $this->load->view('template',$data);
    }
    function cetak($no_pasien, $no_reg){
        $data["no_reg"] = $no_reg;
        $data["q"]          = $this->Mapotek->getcetak($no_pasien, $no_reg);
        $data["q1"]          = $this->Mapotek->getapotek($no_reg);
        $this->Mapotek->printobat_ralan($no_pasien, $no_reg);
        // $data["nota"]          = $this->Mapotek->getnota();
        $this->load->view('apotek/vcetakapotek',$data);
    }
    function cetak_inap($no_pasien,$no_reg,$id_dokter,$tgl1,$tgl2){
        $data["no_reg"] = $no_reg;
        $data["q"]      = $this->Mapotek->getcetak_inap($no_pasien, $no_reg);
        $data["q1"]     = $this->Mapotek->getapotek_inap_cetak($no_reg,$id_dokter,$tgl1,$tgl2);
        $this->Mapotek->printobat_inap($no_pasien, $no_reg);
        // $data["nota"]          = $this->Mapotek->getnota_inap();
        $this->load->view('apotek/vcetakapotek_inap',$data);
    }
    function terima($no_rm,$no_reg){
        $message = $this->Mapotek->terima($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek/list_igd");
    }
    function obat($no_rm,$no_reg){
        $message = $this->Mapotek->obat($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek/list_igd");
    }
    function respond($no_rm, $no_reg){
        $data["q"]          = $this->Mapotek->getrespond($no_rm,$no_reg);
        $this->load->view('apotek/vrespond_time',$data);
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function terima_ralan($no_rm,$no_reg){
        $message = $this->Mapotek->terima_ralan($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek/list_ralan");
    }
    function obat_ralan($no_rm,$no_reg){
        $message = $this->Mapotek->obat_ralan($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek/list_ralan");
    }
    function respond_ralan($no_rm,$no_reg){
        $data["q"]          = $this->Mapotek->getrespond_ralan($no_rm,$no_reg);
        $this->load->view('apotek/vrespond_timeralan',$data);
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function terima_inap($no_rm,$no_reg){
        $message = $this->Mapotek->terima_inap($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek/list_inap");
    }
    function obat_inap($no_rm,$no_reg){
        $message = $this->Mapotek->obat_inap($no_rm,$no_reg);
        $this->session->set_flashdata("message",$message);
        redirect("apotek/list_inap");
    }
    function respond_inap($no_rm,$no_reg){
        $data["q"]          = $this->Mapotek->getrespond_inap($no_rm,$no_reg);
        $this->load->view('apotek/vrespond_timeinap',$data);
        // $data["no_reg"] = $no_reg;
        // $data["diet"]    = $this->Mgizi->getdiet_array();
        // $data["menu"]    = $this->Mgizi->getmenu_array();
    }
    function formuploadpdf($jenis='ralan',$no_pasien,$no_reg){
        $data["vmenu"]          = "pendaftaran/vmenu";
        $data['menu']           = "apotek";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Upload PDF ".($jenis=="igd" ? "IGD" : ucfirst($jenis))." || RS CIREMAI";
        $data["title_header"]   = "Upload PDF ".($jenis=="igd" ? "IGD" : ucfirst($jenis));
        $data["content"]        = "apotek/vformuploadpdf";
        $data["q"]              = $this->Mapotek->getfilepdf($jenis,$no_reg);
        $data["j"]              = $this->Mapotek->getjenisfile();
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
            redirect("apotek/formuploadpdf/".$jenis."/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
        else
        {
            $data = array(
                            'upload_data' => $this->upload->data('file_name'),
                        );
            $nama_file =  $data['upload_data'];
            $message = $this->Mapotek->uploadpdf($jenis,$nama_file);
            $this->session->set_flashdata("message",$message);
            redirect("apotek/formuploadpdf/".$jenis."/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
    }
    function getlistobat(){
      $id = explode("/",$this->input->post("id"));
      $no_reg = $id[1];
      $no_rm = $id[0];
      $data = array();
      $q = $this->db->get_where("pasien",["no_pasien"=>$no_rm])->row();
      $lahir = new DateTime($q->tgl_lahir);
      $hari_ini = new DateTime();
      $diff = $hari_ini->diff($lahir);
      $umur = $diff->y ." Tahun";
      $data["master"] = $q;
      $data["umur"] = $umur;
      $this->db->select("pr.no_reg,p.keterangan as ruangan,d.nama_dokter,d.no_sip");
      $this->db->join("dokter d","d.id_dokter=pr.dokter_poli","inner");
      $this->db->join("poliklinik p","p.kode=pr.tujuan_poli","inner");
      $q = $this->db->get_where("pasien_ralan pr",["no_reg"=>$no_reg])->row();
      $data["detail"] = $q;
      $this->db->select("apotek.*,a.nama as aturan");
      $this->db->join("aturan_pakai a","a.kode=aturan_pakai","left");
      $q = $this->db->get_where("apotek",["no_reg"=>$no_reg]);
      $html = "<h4><b>R/</b></h4><table class='table no-border'>
          <thead>
              <tr class='bg-navy'>
                  <th>List Obat</th>
              </tr>
          </thead>
          <tbody>";
      if ($q->num_rows()>0){
          foreach($q->result() as $val){
              $html .= "<tr>";
              $html .= "<td>".$val->nama_obat."<div class='pull-right'><span class='text-bold' style='font-size:20px'>".$val->qty."<sup style='font-size:9px;'>&nbsp;".$val->satuan."</sup></span></div></br>";
              $html .= ($val->aturan!="" ? "Aturan Pakai ".$val->aturan : "");
              $cara_pakai = (($val->pagi!="" && $val->pagi!=0) ? "Pagi" : "");
              $cara_pakai .= (($val->siang!="" && $val->siang!=0) ? " - Siang" : "");
              $cara_pakai .= (($val->sore!="" && $val->sore!=0) ? " - Sore" : "");
              $cara_pakai .= (($val->malem!="" && $val->malem!=0) ? " - Malam" : "");
              $html .= ($cara_pakai!="" ? "<br>Cara Pakai -> ".$cara_pakai : "");
              $html .= "</td>";
              $html .= "</tr>";
          }
      } else {
          $html .= '<tr>';
          $html .= '<td><div class="alert alert-warning"><h4><i class="icon fa fa-warning"></i>Alert</h4>Belum ada <b>Obat</b> yang diberi</div></td>';
          $html .= '</tr>';
      }
      $html .= "</tbody></table><br><b>Pro :</b>";
      $data["listresep"] = $html;
      $q = $this->db->get_where("assesmen_perawat",["no_reg"=>$no_reg])->row();
      $data["diagnosa"] = $q;
      echo json_encode($data);
    }
}
?>
