<?php
class Suket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Msuket');
        $this->load->Model('Msurat');
        if (($this->session->userdata('username') == NULL) || ($this->session->userdata('password') == NULL)) {
            redirect("login/logout", "refresh");
        }
    }
    function cetaksuket_isolasi($no_pasien, $no_reg, $id, $jenis)
    {
        $data["no_pasien"]          = $no_pasien;
        $data["no_reg"]             = $no_reg;
        $data["id"]                 = $id;
        if ($jenis == "ranap") {
            $data["q"]                  = $this->Msuket->getpasien_detail($no_pasien);
            $data["q1"]                 = $this->Msuket->getpasien_inap($no_reg);
            $data["q2"]                 = $this->Msuket->getsuket_detail($id, "surat_keterangan");
            $data["q3"]                 = $this->Msuket->getalamat_rs();
        } else {
            $data["q"]                  = $this->Msuket->getpasien_detail($no_pasien);
            $data["q1"]                 = $this->Msuket->getpasien_ralan($no_reg);
            $data["q2"]                 = $this->Msuket->getsuket_detail($id, "surat_keterangan");
            $data["q3"]                 = $this->Msuket->getalamat_rs();
        }
        $data["swab"] = $this->Msuket->getswab($jenis, $no_reg);
        $this->load->view("suket/vcetaksuket_isolasi", $data);
    }
    function suketisolasi($no_pasien, $no_reg, $jenis)
    {
        $id = $this->Msuket->simpansuket_isolasi($no_pasien, $no_reg, $jenis);
        redirect("suket/cetaksuket_isolasi/" . $no_pasien . "/" . $no_reg . "/" . $id . "/" . $jenis);
    }
    function cetaksuket_bebascovid($no_pasien, $no_reg, $id, $jenis)
    {
        $data["no_pasien"]          = $no_pasien;
        $data["no_reg"]             = $no_reg;
        $data["id"]                 = $id;
        if ($jenis == "ranap") {
            $data["q"]                  = $this->Msuket->getpasien_detail($no_pasien);
            $data["q1"]                 = $this->Msuket->getpasien_inap($no_reg);
            $data["q2"]                 = $this->Msuket->getsuket_covid($no_reg, $no_pasien, "suket_bebascovid");
            $data["q3"]                 = $this->Msuket->getalamat_rs();
        } else {
            $data["q"]                  = $this->Msuket->getpasien_detail($no_pasien);
            $data["q1"]                 = $this->Msuket->getpasien_ralan($no_reg);
            $data["q2"]                 = $this->Msuket->getsuket_covid($no_reg, $no_pasien, "suket_bebascovid");
            $data["q3"]                 = $this->Msuket->getalamat_rs();
        }
        $data["swab"] = $this->Msuket->getswab($jenis, $no_reg);
        $this->load->view("suket/vcetaksuket_bebascovid", $data);
    }
    function getswab()
    {
        $data = $this->Msuket->getswab($this->input->post("jenis"), $this->input->post("no_reg"));
        echo $data["terakhir"]->hasil;
    }
    function suketbebascovid($no_pasien, $no_reg, $jenis)
    {
        if ($jenis == "ralan") {
            $q = $this->db->get_where("pasien_ralan", ["no_reg_sebelumnya" => $no_reg]);
            if ($q->num_rows() > 0) {
                $r = $q->row();
                $no_reg = $r->no_reg;
            }
        }
        $id = $this->Msuket->simpansuket_bebascovid($no_pasien, $no_reg, $jenis);
        redirect("suket/cetaksuket_bebascovid/" . $no_pasien . "/" . $no_reg . "/" . $id . "/" . $jenis);
    }
    function listkematian($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Surat Kematian";
        $data['judul']                 = "Rekap Surat Kematian";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlist_kematian";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Surat Kematian ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Jalan</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listkematian/' . $current;
        $config['total_rows']         = $this->Msuket->jumlah_kematian();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getpasien_kematian($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function detailkematian($no_pasien, $no_reg, $jenis = "ranap")
    {
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data['menu']           = "urset";
        $data["no_rm"]          = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Kematian || RS CIREMAI";
        $data["title_header"]   = "Detail Kematian";
        $data["title_header"]   = "Detail Kematian";
        $data["content"]        = "suket/vdetailkematian";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Kematian</strong></li>";
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        if ($jenis == "ranap") {
            $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
            $data["q3"]        = $this->Msurat->resumepasien($no_reg);
        } else {
            $data["q1"]        = $this->Msurat->getpasienralan_detail($no_reg);
            $data["q3"]        = $this->Msurat->resumepasien($no_reg);
        }
        $data["jenis"] = $jenis;
        $data["q2"]        = $this->Msurat->getkematian_detail($no_reg);
        $this->load->view('template', $data);
    }
    function listkelahiran($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Surat Kelahiran";
        $data['judul']                 = "Rekap Surat Kelahiran";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistkelahiran";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Surat Kelahiran ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Jalan</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listkelahiran/' . $current;
        $config['total_rows']         = $this->Msuket->jumlah_kelahiran();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getpasien_kelahiran($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listberitamasukperawatan($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Berita Masuk Perawatan";
        $data['judul']                 = "Rekap Berita Masuk Perawatan";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlist_beritamasukperawatan";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Berita Masuk Perawatan ";
        $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Jalan</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listberitamasukperawatan/' . $current;
        $config['total_rows']         = $this->Msuket->jumlah_beritamasukperawatan();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getmasukperawatan($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listberitalepasperawatan($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Berita Lepas Perawatan";
        $data['judul']                 = "Rekap Berita Lepas Perawatan";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistberitalepasperawatan";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Berita Lepas Perawatan ";
        $data["breadcrumb"]         = "<li class='active'><strong>Berita Lepas Perawatan</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listberitalepasperawatan/' . $current;
        $config['total_rows']         = $this->Msuket->jumlah_beritalepasperawatan();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getberitalepasperawatan($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listsuratistirahatsakit($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Surat Istirahat Sakit";
        $data['judul']                 = "Rekap Surat Istirahat Sakit";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistsuratistirahatsakit";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Surat Istirahat Sakit ";
        $data["breadcrumb"]         = "<li class='active'><strong>Surat Istirahat Sakit</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listsuratistirahatsakit/' . $current;
        $config['total_rows']         = $this->Msuket->jumlah_suratistirahatsakit();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getsuratistirahatsakit($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listsuratketerangandokter($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Surat Keterangan Dokter";
        $data['judul']                 = "Rekap Surat Keterangan Dokter";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistsuratketerangandokter";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Surat Keterangan Dokter ";
        $data["breadcrumb"]         = "<li class='active'><strong>Surat Keterangan Dokter</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listsuratketerangandokter/' . $current;
        $config['total_rows']         = $this->Msuket->jumlah_suratketerangandokter();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getsuratketerangandokter($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listsuratmasuksekretariat()
    {
        $data["title"]                 = "Rekap Surat Masuk Sekretariat";
        $data['judul']                 = "Rekap Surat Masuk Sekretariat";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistsuratmasuksekretariat";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["title_header"]         = "Rekap Surat Masuk Sekretariat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Surat Masuk Sekretariat</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']         = $this->Msuket->jumlah_suratmasuksekretariat();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getsurat_masuk_sekretariat();
        $this->load->view('template', $data);
    }
    function listsurat_b_keluarsekretariat()
    {
        $data["title"]                 = "Rekap Surat B Keluar Sekretariat";
        $data['judul']                 = "Rekap Surat B Keluar Sekretariat";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistsurat_b_keluarsekretariat";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["title_header"]         = "Rekap Surat B Keluar Sekretariat ";
        $data["breadcrumb"]         = "<li class='active'><strong>Surat B Keluar Sekretariat</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']         = $this->Msuket->jumlah_b_keluarsekretariat();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getsurat_b_keluarsekretariat();
        $this->load->view('template', $data);
    }
    function listsprin_keluar()
    {
        $data["title"]                 = "Rekap Sprint Keluar";
        $data['judul']                 = "Rekap Sprint Keluar";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistsprin_keluar";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["title_header"]         = "Rekap Sprint Keluar ";
        $data["breadcrumb"]         = "<li class='active'><strong>Sprint Keluar</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']         = $this->Msuket->jumlah_sprintkeluar();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getsprin_keluar();
        $this->load->view('template', $data);
    }
    function listnarkoba($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Surat Keterangan Narkoba";
        $data['judul']                 = "Rekap Surat Keterangan Narkoba";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistnarkoba";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Surat Keterangan Narkoba ";
        $data["breadcrumb"]         = "<li class='active'><strong>Surat Keterangan Narkoba</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listnarkoba/' . $current;
        $config['total_rows']         = $this->Msuket->jumlahsurat_narkoba();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getnarkoba($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listjiwa($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Surat Keterangan Sehat Jiwa";
        $data['judul']                 = "Rekap Surat Keterangan Sehat Jiwa";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistjiwa";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Surat Keterangan Sehat Jiwa ";
        $data["breadcrumb"]         = "<li class='active'><strong>Surat Keterangan Sehat Jiwa</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listjiwa/' . $current;
        $config['total_rows']         = $this->Msuket->jumlahsurat_jiwa();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getjiwa($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listrujukan_ralan($current = 0, $from = 0)
    {
        $data["title"]                 = "Rekap Rujukan Pasien";
        $data['judul']                 = "Rekap Rujukan Pasien";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistrujukan";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["current"]             = $current;
        $data["title_header"]         = "Rekap Rujukan Pasien ";
        $data["breadcrumb"]         = "<li class='active'><strong>Rekap Rujukan Pasien</strong></li>";
        $this->load->library('pagination');
        $config['base_url']         = base_url() . 'suket/listrujukan_ralan/' . $current;
        $config['total_rows']         = $this->Msuket->jumlahsurat_rujukan();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getrujukan($config['per_page'], $from);
        $this->load->view('template', $data);
    }
    function listcutitahunan()
    {
        $data["title"]                 = "Rekap Cuti Tahunan";
        $data['judul']                 = "Rekap Cuti Tahunan";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]             = "suket/vlistcutitahunan";
        $data["username"]             = $this->session->userdata('nama_user');
        $data['menu']                = "urset";
        $data["title_header"]         = "Rekap Cuti Tahunan ";
        $data["breadcrumb"]         = "<li class='active'><strong>Surat Masuk Sekretariat</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']         = $this->Msuket->jumlah_cutitahunan();
        $data["total_rows"]         = $config['total_rows'];
        $config['per_page']         = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']     = '</ul>';
        $config['cur_tag_open']     = '<li class=active><a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']     = '</li>';
        $config['prev_tag_open']     = '<li>';
        $config['prev_tag_close']     = '</li>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']     = '</li>';
        $config['first_tag_open']     = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']     = '</li>';
        $config['num_links']         = 4;
        $config['uri_segment']         = 4;
        $from                        = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                 = $from;
        $data["q3"]                 = $this->Msuket->getcutitahunan();
        $this->load->view('template', $data);
    }
    function addcutitahunan($id = "")
    {
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Form Pengajuan Cuti&nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["content"] = "suket/vaddcutitahunan";
        $data['menu'] = "user";
        $data["username"] = $this->session->userdata('nama_user');
        $data["title_header"] = "Form Pengajuan Cuti";
        $data["breadcrumb"] = "<li class='active'><strong>Form Pengajuan Cuti</strong></li>";
        $data["id"] = $id;
        $data["row"] = $this->Msuket->getdetailcutitahunan($id);
        $data["p"] = $this->Msuket->getperawat();
        $this->load->view('template', $data);
    }
    function getcutiperawat()
    {
        if (isset($_GET['term'])) {
            $result = $this->Msuket->getcutiperawat($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->nama_perawat;
                echo json_encode($arr_result);
            }
        }
    }
    function simpancutitahunan($action)
    {
        $nomor = $this->input->post("nomor");
        $message = $this->Msuket->simpancutitahunan($action);
        $this->db->where("nomor", $nomor);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('nomor');
        redirect("suket/listcutitahunan");
    }
    function pengajuancuti($id)
    {
        $data["status"]           = "status";
        $data["nomor"]            = $id;
        $data["p1"]               = $this->Msuket->getpengajuan($id);
        $data["p"]                = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetakpengajuan", $data);
    }
    function cutihonor($id)
    {
        $data["status"]           = "status";
        $data["nomor"]            = $id;
        $data["p1"]               = $this->Msuket->getpengajuan($id);
        $data["p"]                = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetakhonor", $data);
    }
    function cutinon_honor($id)
    {
        $data["status"]           = "status";
        $data["nomor"]            = $id;
        $data["p1"]               = $this->Msuket->getpengajuan($id);
        $data["p"]                = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetaknon_honor", $data);
    }
    function detailkelahiran($no_pasien, $no_reg, $jenis = "ranap")
    {
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data['menu']           = "urset";
        $data["no_rm"]          = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["jenis"]          = $jenis;
        $data["title"]          = "Detail Kelahiran || RS CIREMAI";
        $data["title_header"]   = "Detail Kelahiran";
        $data["content"]        = "suket/vdetailkelahiran";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Kelahiran</strong></li>";
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getkelahiran_detail($no_reg);
        $data["q3"]        = $this->Msurat->resumepasien($no_reg);
        $this->load->view('template', $data);
    }
    function detailberitamasuk($no_pasien, $no_reg)
    {
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data['menu']           = "urset";
        $data["no_rm"]          = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Berita Masuk Perawatan || RS CIREMAI";
        $data["title_header"]   = "Detail Berita Masuk Perawatan";
        $data["content"]        = "suket/vdetailberitamasuk";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Berita Masuk Perawatan</strong></li>";
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getberitamasuk_detail($no_reg);
        $data["q3"]        = $this->Msurat->getberitamasukperawatan($no_pasien, $no_reg);
        $this->load->view('template', $data);
    }
    function detailnarkoba($no_pasien, $no_reg, $jenis = "ranap")
    {
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data['menu']           = "urset";
        $data["no_rm"]          = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Narkoba || RS CIREMAI";
        $data["title_header"]   = "Detail Narkoba";
        $data["title_header"]   = "Detail Narkoba";
        $data["content"]        = "suket/vdetailnarkoba";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Narkoba</strong></li>";
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        if ($jenis == "ranap") {
            $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        } else {
            $data["q1"]        = $this->Msurat->getpasienralan_detail($no_reg);
        }
        $data["jenis"] = $jenis;
        $data["q2"]        = $this->Msurat->getnarkoba_detail($no_reg);
        $this->load->view('template', $data);
    }
    function detailjiwa($no_pasien, $no_reg, $jenis = "ranap")
    {
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data['menu']           = "urset";
        $data["no_rm"]          = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Detail Jiwa || RS CIREMAI";
        $data["title_header"]   = "Detail Jiwa";
        $data["title_header"]   = "Detail Jiwa";
        $data["content"]        = "suket/vdetailjiwa";
        $data["breadcrumb"]     = "<li class='active'><strong>Detail Jiwa</strong></li>";
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        if ($jenis == "ranap") {
            $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        } else {
            $data["q1"]        = $this->Msurat->getpasienralan_detail($no_reg);
        }
        $data["jenis"] = $jenis;
        $data["q2"]        = $this->Msurat->getjiwa_detail($no_reg);
        $this->load->view('template', $data);
    }
    function getcaripasien()
    {
        $this->session->set_flashdata("no_pasien", $this->input->post("cari_no"));
        $this->session->set_flashdata("nama", $this->input->post("cari_nama"));
        $this->session->set_flashdata("no_reg", $this->input->post("cari_noreg"));
    }
    function getcarinoagenda_surat()
    {
        $this->session->set_flashdata("no_agenda_surat", $this->input->post("cari_no"));
    }
    function getcarino_b_keluar()
    {
        $this->session->set_flashdata("no_b_keluar", $this->input->post("cari_no"));
    }
    function getcarino_sprint_keluar()
    {
        $this->session->set_flashdata("no_sprint", $this->input->post("cari_no"));
    }
    function getcarinocuti()
    {
        $this->session->set_flashdata("nomor", $this->input->post("cari_no"));
    }
    function getcarino_mou()
    {
        $this->session->set_flashdata("no_surat", $this->input->post("cari_no"));
    }
    function getcarino_ba()
    {
        $this->session->set_flashdata("no_surat", $this->input->post("cari_no"));
    }
    function getcarino_se()
    {
        $this->session->set_flashdata("no_surat", $this->input->post("cari_no"));
    }
    function getcarino_nokep()
    {
        $this->session->set_flashdata("no_surat", $this->input->post("cari_no"));
    }
    function getcarino_noketkeluar()
    {
        $this->session->set_flashdata("no_surat", $this->input->post("cari_no"));
    }
    function getcarino_kontrak()
    {
        $this->session->set_flashdata("no_surat", $this->input->post("cari_no"));
    }
    function reset_pasienkematian()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listkematian");
    }
    function reset_pasienkelahiran()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listkelahiran");
    }
    function reset_keterangandokter()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listsuratketerangandokter");
    }
    function reset_surat_istirahat_sakit()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listsuratistirahatsakit");
    }
    function reset_berita_lepas_perawatan()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listberitalepasperawatan");
    }
    function reset_pasienmasukperawatan()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listberitamasukperawatan");
    }
    function reset_narkoba()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listnarkoba");
    }
    function reset_jiwa()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listjiwa");
    }
    function reset_rujukan()
    {
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        $this->session->unset_userdata('no_pasien');
        redirect("suket/listrujukan_ralan");
    }
    function resetsuratmasuksekretariat()
    {
        $this->session->unset_userdata('no_agenda_surat');
        redirect("suket/listsuratmasuksekretariat");
    }
    function resetno_b_keluar()
    {
        $this->session->unset_userdata('no_b_keluar');
        redirect("suket/listsurat_b_keluarsekretariat");
    }
    function resetno_sprint_keluar()
    {
        $this->session->unset_userdata('no_sprint');
        redirect("suket/listsprin_keluar");
    }
    function resetcuti()
    {
        $this->session->unset_userdata('nomor');
        redirect("suket/listcutitahunan");
    }
    function resetmou()
    {
        $this->session->unset_userdata('no_surat');
        redirect("suket/listmou");
    }
    function reset_ba()
    {
        $this->session->unset_userdata('no_surat');
        redirect("suket/list_ba");
    }
    function reset_se()
    {
        $this->session->unset_userdata('no_surat');
        redirect("suket/list_se");
    }
    function reset_nokep()
    {
        $this->session->unset_userdata('no_surat');
        redirect("suket/list_nokep");
    }
    function reset_noketkeluar()
    {
        $this->session->unset_userdata('no_surat');
        redirect("suket/list_noketkeluar");
    }
    function reset_kontrak()
    {
        $this->session->unset_userdata('no_surat');
        redirect("suket/list_kontrak");
    }
    function cetaklistkematian($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistkematian($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistkematian", $data);
    }
    function cetaklistkematianbpjs($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["nomor"] = $this->session->flashdata('nomor');
        $data["q"] = $this->Msuket->cetaklistkematianbpjs($tgl1, $tgl2);
        $data["rs"] = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetaklistkematianbpjs", $data);
    }
    function cetaklistkelahiran($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistkelahiran($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistkelahiran", $data);
    }
    function cetaklistberitamasukperawatan($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistberitamasukperawatan($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistberitamasukperawatan", $data);
    }

    function cetaklistberitalepasperawatan($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistberitalepasperawatan($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistberitalepasperawatan", $data);
    }

    function cetaklistsuratistirahatsakit($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistsuratistirahatsakit($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistsuratistirahatsakit", $data);
    }

    function cetaklistsuratketerangandokter($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistsuratketerangandokter($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistsuratketerangandokter", $data);
    }
    function cetaklistmasuksekretariat($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistmasuksekretariat($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistmasuksekretariat", $data);
    }
    function cetaklist_bkeluar($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklist_bkeluar($tgl1, $tgl2);
        $this->load->view("suket/vcetaklist_bkeluar", $data);
    }
    function cetaklistsprint_keluar($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistsprint_keluar($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistsprint_keluar", $data);
    }
    function cetaklistnarkoba($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistnarkoba($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistnarkoba", $data);
    }
    function cetaklistjiwa($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistjiwa($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistjiwa", $data);
    }
    function cetaklistrujukan($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistrujukan($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistrujukan", $data);
    }
    function cetakrekapcuti($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetakrekapcuti($tgl1, $tgl2);
        $this->load->view("suket/vcetakrekapcuti", $data);
    }
    function cetaklistmou($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistmou($tgl1, $tgl2);
        $this->load->view("suket/vcetaklistmou", $data);
    }
    function cetaklistno_ba($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistno_ba($tgl1, $tgl2);
        $this->load->view("suket/vcetaklist_ba", $data);
    }
    function cetaklistno_se($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklistno_se($tgl1, $tgl2);
        $this->load->view("suket/vcetaklist_se", $data);
    }
    function cetaklist_nokep($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklist_nokep($tgl1, $tgl2);
        $this->load->view("suket/vcetaklist_nokep", $data);
    }
    function cetaklist_noketkeluar($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklist_noketkeluar($tgl1, $tgl2);
        $this->load->view("suket/vcetaklist_noketkeluar", $data);
    }
    function cetaklist_kontrak($tgl1, $tgl2)
    {
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Msuket->cetaklist_kontrak($tgl1, $tgl2);
        $this->load->view("suket/vcetaklist_kontrak", $data);
    }
    function tempno()
    {
        $this->session->set_flashdata('nomor', $this->input->post("nomor"));
    }

    function addsuratmasuksekretariat($id = "")
    {
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Surat Masuk Sekretariat&nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["content"] = "suket/vaddmasuksekretariat";
        $data['menu'] = "user";
        $data["username"] = $this->session->userdata('nama_user');
        $data["title_header"] = "Surat Masuk Sekretariat";
        $data["breadcrumb"] = "<li class='active'><strong>Surat Masuk Sekretariat</strong></li>";
        $data["id"] = $id;
        $data["row"] = $this->Msuket->getdetailsurat_masuk_sekretariat($id);
        $this->load->view('template', $data);
    }
    function simpansuratmasuksekretariat($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketmasuk-" . $this->input->post("no_agenda_surat");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_agenda_surat = $this->input->post("no_agenda_surat");
        $message = $this->Msuket->simpansuratmasuksekretariat($action, $nama_file);
        $this->db->where("no_agenda_surat", $no_agenda_surat);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_agenda_surat');
        redirect("suket/listsuratmasuksekretariat");
    }
    function addsurat_b_keluarsekretariat($id = "")
    {
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Surat B Keluar Sekretariat&nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["content"] = "suket/vadd_b_keluarsekretariat";
        $data['menu'] = "user";
        $data["username"] = $this->session->userdata('nama_user');
        $data["title_header"] = "Surat B Keluar Sekretariat";
        $data["breadcrumb"] = "<li class='active'><strong>Surat B Keluar Sekretariat</strong></li>";
        $data["id"] = $id;
        $data["row"] = $this->Msuket->getdetailsurat_b_keluarsekretariat($id);
        $this->load->view('template', $data);
    }
    function simpansurat_b_keluarsekretariat($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_b_keluar");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_b_keluar = $this->input->post("no_b_keluar");
        $message = $this->Msuket->simpansurat_b_keluarsekretariat($action, $nama_file);
        $this->db->where("no_b_keluar", $no_b_keluar);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_b_keluar');
        redirect("suket/listsurat_b_keluarsekretariat");
    }

    function addsprint_keluar($id = "")
    {
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Sprint Keluar&nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller") . "/vmenu";
        $data["content"] = "suket/vaddsprint_keluar";
        $data['menu'] = "user";
        $data["username"] = $this->session->userdata('nama_user');
        $data["title_header"] = "Sprint Keluar";
        $data["breadcrumb"] = "<li class='active'><strong>Sprint Keluar</strong></li>";
        $data["id"] = $id;
        $data["row"] = $this->Msuket->getdetailsprint($id);
        $this->load->view('template', $data);
    }

    function simpansprint_keluar($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_sprint");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_sprint = $this->input->post("no_sprint");
        $message = $this->Msuket->simpansprint_keluar($action, $nama_file);
        $this->db->where("no_sprint", $no_sprint);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_sprint');
        redirect("suket/listsprin_keluar");
    }

    function getperawat()
    {
        echo json_encode($this->Msuket->sprintperawat());
    }
    function lampiran_sprint($id)
    {
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data['menu']           = "suket";
        $data["no_sprint"]      = $id;
        $data["title"]          = "Lampiran Sprint || RS CIREMAI";
        $data["title_header"]   = "Lampiran Sprint";
        $data["content"]        = "suket/vformsprint";
        $data["breadcrumb"]     = "<li class='active'><strong>Lampiran Sprint</strong></li>";
        $data["row"]            = $this->Msuket->getdetaillampiran_sprint($id);
        $data["p"]            = $this->Msuket->getperawat();
        $data["j"]            = $this->Msuket->getjabatan();
        $this->load->view('template', $data);
    }
    function lampiran_kegiatan($id)
    {
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data['menu']           = "suket";
        $data["no_sprint"]      = $id;
        $data["title"]          = "Lampiran Kegiatan || RS CIREMAI";
        $data["title_header"]   = "Lampiran Kegiatan";
        $data["content"]        = "suket/vformkegiatan";
        $data["breadcrumb"]     = "<li class='active'><strong>Lampiran Kegiatan</strong></li>";
        $data["row"]            = $this->Msuket->getkegiatan($id);
        $data["p"]            = $this->Msuket->getperawat();
        $this->load->view('template', $data);
    }
    function addsprintperawat($action)
    {
        $message = $this->Msuket->addsprintperawat($action);
        $this->session->set_flashdata("message", $message);
        redirect("suket/lampiran_sprint/" . $this->input->post('no_sprint'));
    }
    function addkegiatan($action)
    {
        $message = $this->Msuket->addkegiatan($action);
        $this->session->set_flashdata("message", $message);
        redirect("suket/lampiran_kegiatan/" . $this->input->post('no_sprint'));
    }
    function cetaksprint()
    {
        $data["status"]           = "status";
        $data["no_sprint"]        = $no_sprint;
        $data["p1"]               = $this->Msuket->getsuratsprint();
        $data["p"]                = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetaksprint", $data);
    }
    function cetaklampiran($id)
    {
        $data["status"]           = "status";
        $data["no_sprint"]        = $id;
        $data["p1"]               = $this->Msuket->getcetaksprintkeluar($id);
        $data["p"]               = $this->Msuket->getsuratsprint();
        $data["t"]                = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetaklistlampiran", $data);
    }
    function cetakkegiatan()
    {
        $data["status"]           = "status";
        $data["no_sprint"]        = $no_sprint;
        $data["p1"]               = $this->Msuket->getsuratsprint();
        $data["p"]                = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetakkegiatan", $data);
    }
    function cetaklampiran_kegiatan($id)
    {
        $data["status"]           = "status";
        $data["no_sprint"]        = $id;
        $data["p1"]               = $this->Msuket->getkegiatan($id);
        $data["p"]                = $this->Msuket->getsuratsprint();
        $data["t"]                = $this->Msuket->getalamat_rs();
        $this->load->view("suket/vcetaklistkegiatan", $data);
    }
    function listmou()
    {
        $data["title"]                 = "Perjanjian MOU";
        $data['judul']                 = "Perjanjian MOU";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]               = "suket/vlistmou";
        $data["username"]              = $this->session->userdata('nama_user');
        $data['menu']                  = "urset";
        $data["title_header"]          = "Perjanjian MOU ";
        $data["breadcrumb"]            = "<li class='active'><strong>Perjanjian MOU</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']          = $this->Msuket->jumlah_mou();
        $data["total_rows"]            = $config['total_rows'];
        $config['per_page']            = 10;
        $config['full_tag_open']       = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']      = '</ul>';
        $config['cur_tag_open']        = '<li class=active><a>';
        $config['cur_tag_close']       = '</a></li>';
        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']       = '</li>';
        $config['prev_tag_open']       = '<li>';
        $config['prev_tag_close']      = '</li>';
        $config['next_tag_open']       = '<li>';
        $config['next_tag_close']      = '</li>';
        $config['first_tag_open']      = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']       = '<li>';
        $config['last_tag_close']      = '</li>';
        $config['num_links']           = 4;
        $config['uri_segment']         = 4;
        $from                          = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                  = $from;
        $data["q3"]                    = $this->Msuket->getmou();
        $this->load->view('template', $data);
    }
    function addmou($id = "")
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data['judul']          = "MOU&nbsp;&nbsp;&nbsp;";
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data["content"]        = "suket/vaddmou";
        $data['menu']           = "user";
        $data["username"]       = $this->session->userdata('nama_user');
        $data["title_header"]   = "MOU";
        $data["breadcrumb"]     = "<li class='active'><strong>MOU</strong></li>";
        $data["id"]             = $id;
        $data["row"]            = $this->Msuket->getdetailmou($id);
        $this->load->view('template', $data);
    }
    function simpanmou($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_surat");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_surat = $this->input->post("no_surat");
        $message = $this->Msuket->simpanmou($action, $nama_file);
        $this->db->where("no_surat", $no_surat);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_surat');
        redirect("suket/listmou");
    }
    function list_ba()
    {
        $data["title"]                 = "NO B.A";
        $data['judul']                 = "NO B.A";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]               = "suket/vlist_ba";
        $data["username"]              = $this->session->userdata('nama_user');
        $data['menu']                  = "urset";
        $data["title_header"]          = "NO B.A ";
        $data["breadcrumb"]            = "<li class='active'><strong>NO B.A</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']          = $this->Msuket->jumlah_ba();
        $data["total_rows"]            = $config['total_rows'];
        $config['per_page']            = 10;
        $config['full_tag_open']       = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']      = '</ul>';
        $config['cur_tag_open']        = '<li class=active><a>';
        $config['cur_tag_close']       = '</a></li>';
        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']       = '</li>';
        $config['prev_tag_open']       = '<li>';
        $config['prev_tag_close']      = '</li>';
        $config['next_tag_open']       = '<li>';
        $config['next_tag_close']      = '</li>';
        $config['first_tag_open']      = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']       = '<li>';
        $config['last_tag_close']      = '</li>';
        $config['num_links']           = 4;
        $config['uri_segment']         = 4;
        $from                          = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                  = $from;
        $data["q3"]                    = $this->Msuket->get_ba();
        $this->load->view('template', $data);
    }
    function add_ba($id = "")
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data['judul']          = "NO B.A&nbsp;&nbsp;&nbsp;";
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data["content"]        = "suket/vadd_ba";
        $data['menu']           = "user";
        $data["username"]       = $this->session->userdata('nama_user');
        $data["title_header"]   = "NO B.A";
        $data["breadcrumb"]     = "<li class='active'><strong>NO B.A</strong></li>";
        $data["id"]             = $id;
        $data["row"]            = $this->Msuket->getdetail_ba($id);
        $this->load->view('template', $data);
    }
    function simpan_ba($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_surat");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_surat = $this->input->post("no_surat");
        $message = $this->Msuket->simpan_ba($action, $nama_file);
        $this->db->where("no_surat", $no_surat);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_surat');
        redirect("suket/list_ba");
    }
    function list_se()
    {
        $data["title"]                 = "BUKU SE KELUAR";
        $data['judul']                 = "BUKU SE KELUAR";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]               = "suket/vlist_se";
        $data["username"]              = $this->session->userdata('nama_user');
        $data['menu']                  = "urset";
        $data["title_header"]          = "BUKU SE KELUAR ";
        $data["breadcrumb"]            = "<li class='active'><strong>BUKU SE KELUAR</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']          = $this->Msuket->jumlah_se();
        $data["total_rows"]            = $config['total_rows'];
        $config['per_page']            = 10;
        $config['full_tag_open']       = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']      = '</ul>';
        $config['cur_tag_open']        = '<li class=active><a>';
        $config['cur_tag_close']       = '</a></li>';
        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']       = '</li>';
        $config['prev_tag_open']       = '<li>';
        $config['prev_tag_close']      = '</li>';
        $config['next_tag_open']       = '<li>';
        $config['next_tag_close']      = '</li>';
        $config['first_tag_open']      = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']       = '<li>';
        $config['last_tag_close']      = '</li>';
        $config['num_links']           = 4;
        $config['uri_segment']         = 4;
        $from                          = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                  = $from;
        $data["q3"]                    = $this->Msuket->get_se();
        $this->load->view('template', $data);
    }
    function add_se($id = "")
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data['judul']          = "SE Keluar&nbsp;&nbsp;&nbsp;";
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data["content"]        = "suket/vadd_se";
        $data['menu']           = "user";
        $data["username"]       = $this->session->userdata('nama_user');
        $data["title_header"]   = "SE Keluar";
        $data["breadcrumb"]     = "<li class='active'><strong>SE Keluar</strong></li>";
        $data["id"]             = $id;
        $data["row"]            = $this->Msuket->getdetail_ba($id);
        $this->load->view('template', $data);
    }
    function simpan_se($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_surat");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_surat = $this->input->post("no_surat");
        $message = $this->Msuket->simpan_se($action, $nama_file);
        $this->db->where("no_surat", $no_surat);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_surat');
        redirect("suket/list_se");
    }
    function list_nokep()
    {
        $data["title"]                 = "Buku NO Kep";
        $data['judul']                 = "Buku NO Kep";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]               = "suket/vlist_nokep";
        $data["username"]              = $this->session->userdata('nama_user');
        $data['menu']                  = "urset";
        $data["title_header"]          = "Buku NO Kep ";
        $data["breadcrumb"]            = "<li class='active'><strong>Buku NO Kep</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']          = $this->Msuket->jumlah_nokep();
        $data["total_rows"]            = $config['total_rows'];
        $config['per_page']            = 10;
        $config['full_tag_open']       = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']      = '</ul>';
        $config['cur_tag_open']        = '<li class=active><a>';
        $config['cur_tag_close']       = '</a></li>';
        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']       = '</li>';
        $config['prev_tag_open']       = '<li>';
        $config['prev_tag_close']      = '</li>';
        $config['next_tag_open']       = '<li>';
        $config['next_tag_close']      = '</li>';
        $config['first_tag_open']      = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']       = '<li>';
        $config['last_tag_close']      = '</li>';
        $config['num_links']           = 4;
        $config['uri_segment']         = 4;
        $from                          = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                  = $from;
        $data["q3"]                    = $this->Msuket->get_nokep();
        $this->load->view('template', $data);
    }
    function add_nokep($id = "")
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data['judul']          = "NO Kep&nbsp;&nbsp;&nbsp;";
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data["content"]        = "suket/vadd_nokep";
        $data['menu']           = "user";
        $data["username"]       = $this->session->userdata('nama_user');
        $data["title_header"]   = "NO Kep";
        $data["breadcrumb"]     = "<li class='active'><strong>NO Kep</strong></li>";
        $data["id"]             = $id;
        $data["row"]            = $this->Msuket->getdetail_nokep($id);
        $this->load->view('template', $data);
    }
    function simpan_nokep($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_surat");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_surat = $this->input->post("no_surat");
        $message = $this->Msuket->simpan_nokep($action, $nama_file);
        $this->db->where("no_surat", $no_surat);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_surat');
        redirect("suket/list_nokep");
    }
    function list_noketkeluar()
    {
        $data["title"]                 = "Buku NO Ket Keluar";
        $data['judul']                 = "Buku NO Ket Keluar";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]               = "suket/vlist_noketkeluar";
        $data["username"]              = $this->session->userdata('nama_user');
        $data['menu']                  = "urset";
        $data["title_header"]          = "Buku NO Ket Keluar ";
        $data["breadcrumb"]            = "<li class='active'><strong>Buku NO Ket Keluar</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']          = $this->Msuket->jumlah_noketkeluar();
        $data["total_rows"]            = $config['total_rows'];
        $config['per_page']            = 10;
        $config['full_tag_open']       = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']      = '</ul>';
        $config['cur_tag_open']        = '<li class=active><a>';
        $config['cur_tag_close']       = '</a></li>';
        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']       = '</li>';
        $config['prev_tag_open']       = '<li>';
        $config['prev_tag_close']      = '</li>';
        $config['next_tag_open']       = '<li>';
        $config['next_tag_close']      = '</li>';
        $config['first_tag_open']      = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']       = '<li>';
        $config['last_tag_close']      = '</li>';
        $config['num_links']           = 4;
        $config['uri_segment']         = 4;
        $from                          = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                  = $from;
        $data["q3"]                    = $this->Msuket->get_noketkeluar();
        $this->load->view('template', $data);
    }
    function add_noketkeluar($id = "")
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data['judul']          = "NO Ket Keluar&nbsp;&nbsp;&nbsp;";
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data["content"]        = "suket/vadd_noketkeluar";
        $data['menu']           = "user";
        $data["username"]       = $this->session->userdata('nama_user');
        $data["title_header"]   = "NO Ket Keluar";
        $data["breadcrumb"]     = "<li class='active'><strong>NO Ket Keluar</strong></li>";
        $data["id"]             = $id;
        $data["row"]            = $this->Msuket->getdetail_noketkeluar($id);
        $this->load->view('template', $data);
    }
    function simpan_noketkeluar($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_surat");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_surat = $this->input->post("no_surat");
        $message = $this->Msuket->simpan_noketkeluar($action, $nama_file);
        $this->db->where("no_surat", $no_surat);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_surat');
        redirect("suket/list_noketkeluar");
    }
    function list_kontrak()
    {
        $data["title"]                 = "Buku SP-Kontrak";
        $data['judul']                 = "Buku SP-Kontrak";
        $data["vmenu"]                 = $this->session->userdata("controller") . "/vmenu";
        $data["content"]               = "suket/vlist_kontrak";
        $data["username"]              = $this->session->userdata('nama_user');
        $data['menu']                  = "urset";
        $data["title_header"]          = "Buku SP-Kontrak ";
        $data["breadcrumb"]            = "<li class='active'><strong>Buku SP-Kontrak</strong></li>";
        $this->load->library('pagination');
        $config['total_rows']          = $this->Msuket->jumlah_kontrak();
        $data["total_rows"]            = $config['total_rows'];
        $config['per_page']            = 10;
        $config['full_tag_open']       = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']      = '</ul>';
        $config['cur_tag_open']        = '<li class=active><a>';
        $config['cur_tag_close']       = '</a></li>';
        $config['num_tag_open']        = '<li>';
        $config['num_tag_close']       = '</li>';
        $config['prev_tag_open']       = '<li>';
        $config['prev_tag_close']      = '</li>';
        $config['next_tag_open']       = '<li>';
        $config['next_tag_close']      = '</li>';
        $config['first_tag_open']      = '<li>';
        $config['first_tag_close']     = '</li>';
        $config['last_tag_open']       = '<li>';
        $config['last_tag_close']      = '</li>';
        $config['num_links']           = 4;
        $config['uri_segment']         = 4;
        $from                          = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data["from"]                  = $from;
        $data["q3"]                    = $this->Msuket->get_kontrak();
        $this->load->view('template', $data);
    }
    function add_kontrak($id = "")
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data['judul']          = "SP-Kontrak&nbsp;&nbsp;&nbsp;";
        $data["vmenu"]          = $this->session->userdata("controller") . "/vmenu";
        $data["content"]        = "suket/vadd_kontrak";
        $data['menu']           = "user";
        $data["username"]       = $this->session->userdata('nama_user');
        $data["title_header"]   = "SP-Kontrak";
        $data["breadcrumb"]     = "<li class='active'><strong>SP-Kontrak</strong></li>";
        $data["id"]             = $id;
        $data["row"]            = $this->Msuket->getdetail_kontrak($id);
        $this->load->view('template', $data);
    }
    function simpan_kontrak($action)
    {
        $config['upload_path']          = './file_pdf/suket/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = "suketkeluar-" . $this->input->post("no_surat");
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepdf')) {
            $data = array(
                'upload_data' => $this->upload->data('file_name'),
            );
            $nama_file =  $data['upload_data'];
            $this->session->set_flashdata("message", $message);
        } else {
            $nama_file = "";
        }
        $no_surat = $this->input->post("no_surat");
        $message = $this->Msuket->simpan_kontrak($action, $nama_file);
        $this->db->where("no_surat", $no_surat);
        $this->session->set_flashdata("message", $message);
        $this->session->set_flashdata('no_surat');
        redirect("suket/list_kontrak");
    }
}
