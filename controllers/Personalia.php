<?php
class Personalia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Mperawat');
        $this->load->Model('Mdokter');
        $this->load->Model('Mkasir');
        $this->load->Model('Mhome');
        $this->load->Model('Madmindkk');
        $this->load->Model('Mpendaftaran');
        $this->load->Model('Mpersonalia');
        if (($this->session->userdata('username') == NULL) || ($this->session->userdata('password') == NULL)) {
            redirect("login/logout", "refresh");
        }
    }
    function getcari_perawat()
    {
        $this->session->set_flashdata("id_perawat", $this->input->post("cari_nip"));
        $this->session->set_flashdata("id_perawat", $this->input->post("cari_nama"));
        $this->session->set_flashdata("id_perawat", $this->input->post("cari_no"));
    }
    function reset()
    {
        $this->session->unset_userdata('id_perawat');
        redirect("personalia");
    }
    function index()
    {
        $data["title"]            = $this->session->userdata('status_user');
        $data["username"]         = $this->session->userdata('username');
        $data["q3"]               = $this->Mpersonalia->getperawat();
        $data['menu']             = "personalia";
        $data['vmenu']            = "admindkk/vmenu";
        $data["content"]          = "personalia/vperawat";
        $data["title_header"]     = "Perawat";
        $data["breadcrumb"]       = "<li class='active'><strong>Perawat</strong></li>";
        $this->load->view('template', $data);
    }
    function addperawatbaru($id_perawat = "")
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data["row"]            = $this->Mpersonalia->getdetailperawat($id_perawat);
        $data["p"]              = $this->Mpersonalia->getpangkat();
        $data["b"]              = $this->Mpersonalia->getbank();
        $data["q2"]             = $this->Mpersonalia->getjenis_kelamin();
        $data["q4"]             = $this->Mpersonalia->getpendidikan();
        $data["k1perawat"]      = $this->Mpersonalia->getjenis_tenaga_perawat();
        $data["kw"]             = $this->Mpersonalia->getkawin();
        $data["id_perawat"]     = $id_perawat;
        $data['menu']           = "personalia";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "personalia/vaddperawatbaru";
        $data["title_header"]   = "Identitas Perawat";
        $data["breadcrumb"]     = "<li class='active'><strong>Perawat</strong></li>";
        $this->load->view('template', $data);
    }
    function simpanperawatbaru($aksi)
    {
        $message = $this->Mpersonalia->simpanperawatbaru($aksi);
        $this->session->set_flashdata("message", $message);
        redirect("personalia");
    }

    function jadwal_perawat($b = "", $bagian = "")
    {
        $data["title"]            = $this->session->userdata('status_user');
        $data["username"]         = $this->session->userdata('username');
        $data["q"]                = $this->Mpersonalia->getjadwalperawat();
        $data['menu']             = "personalia";
        $data['vmenu']            = "admindkk/vmenu";
        $data["content"]          = "personalia/vjadwal_perawat";
        $data["title_header"]     = "Jadwal Perawat";
        $b = $b == "" ? date("m") : $b;
        $data["b"]                = $b;
        $data["q"]                = $this->Mpersonalia->getjadwalperawat_array($b, date("Y"));
        $data["breadcrumb"]       = "<li class='active'><strong>Jadwal Perawat</strong></li>";
        $data["bagian"]           = ($bagian == "" ? $this->Mpersonalia->getbagian()->row()->kode_bagian : $bagian);
        $data["p"]             = $this->Mpersonalia->getperawat_bagian($data["bagian"]);
        $data["bag"]             = $this->Mpersonalia->getbagian();
        $data["libur"]                = $this->Madmindkk->getliburnasional_array();
        $this->load->view('template', $data);
    }
    function formjadwalperawat($id = null, $id_ruangan = null)
    {
        $data["title"]          = $this->session->userdata('status_user');
        $data["username"]       = $this->session->userdata('username');
        $data['menu']           = "personalia";
        $data['vmenu']          = "admindkk/vmenu";
        $data["content"]        = "personalia/vformjadwalperawat";
        $data["id_perawat"]     = $id;
        $data["id_ruangan"]     = $id_ruangan;
        $data["q1"]             = $this->Mpersonalia->getjadwalperawat();
        $data["p"]              = $this->Mpersonalia->getperawat2();
        // $data["q"]              = $this->Mpersonalia->getjadwalperawatdetail($id);
        $data["title_header"]   = "Form Jadwal Perawat";
        $data["breadcrumb"]     = "<li class='active'><strong>Jadwal Perawat</strong></li>";
        $this->load->view('template', $data);
    }
    function simpanjadwalperawat()
    {
        $message = $this->Mpersonalia->simpanjadwalperawat();
        $this->session->set_flashdata("message", $message);
        redirect("personalia/jadwal_perawat");
    }
    function hapusjadwalperawat($id, $ruangan)
    {
        $message = $this->Mpersonalia->hapusjadwalperawat($id, $ruangan);
        $this->session->set_flashdata("message", $message);
        redirect("personalia/jadwal_perawat");
    }
    function getjadwalperawatdetail()
    {
        $id_perawat = $this->input->post("id_perawat");
        $ruangan = $this->input->post("id_ruangan");
        $bulan = $this->input->post("bulan");
        $tahun = $this->input->post("tahun");
        $jml = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $hasil = $this->Mpersonalia->getjadwalperawatdetail($id_perawat, $ruangan, $bulan, $tahun);
        $html = "";
        if ($hasil->tanggal)
            $tanggal = json_decode($hasil->tanggal, true);
        else
            $tanggal = array();
        for ($i = 1; $i <= $jml; $i++) {
            $html .= '<div class="form-group">';
            $html .= '<label class="col-sm-2 control-label">Tanggal ' . $i . '</label>';
            $html .= '<div class="col-sm-10">';
            $html .= '    <input type="checkbox" name="shift1_' . $i . '" ' . (isset($tanggal["tgl" . $i]["shift1"]) ? ($tanggal["tgl" . $i]["shift1"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Shift 1';
            $html .= '    <input type="checkbox" name="shift2_' . $i . '" ' . (isset($tanggal["tgl" . $i]["shift2"]) ? ($tanggal["tgl" . $i]["shift2"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Shift 2';
            $html .= '    <input type="checkbox" name="lepas_' . $i . '" ' . (isset($tanggal["tgl" . $i]["lepas"]) ? ($tanggal["tgl" . $i]["lepas"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Lepas';
            $html .= '    <input type="checkbox" name="libur_' . $i . '" ' . (isset($tanggal["tgl" . $i]["libur"]) ? ($tanggal["tgl" . $i]["libur"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Libur';
            $html .= '    <input type="checkbox" name="sakit_' . $i . '" ' . (isset($tanggal["tgl" . $i]["sakit"]) ? ($tanggal["tgl" . $i]["sakit"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Sakit';
            $html .= '    <input type="checkbox" name="cuti_' . $i . '" ' . (isset($tanggal["tgl" . $i]["cuti"]) ? ($tanggal["tgl" . $i]["cuti"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Cuti';
            $html .= '    <input type="checkbox" name="dd_' . $i . '" ' . (isset($tanggal["tgl" . $i]["dd"]) ? ($tanggal["tgl" . $i]["dd"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Dinas Dalam';
            $html .= '    <input type="checkbox" name="dl_' . $i . '" ' . (isset($tanggal["tgl" . $i]["dl"]) ? ($tanggal["tgl" . $i]["dl"] == "on" ? "checked" : "") : "") . '>&nbsp;&nbsp;Dinas Luar';
            $html .= '</div>';
            $html .= '</div>';
        }
        echo $html;
    }
    function cetakjadwal($b = 1, $bagian = "")
    {
        $data["b"]                = $b;
        $data["q"]                = $this->Mpersonalia->getjadwalperawat_array($b, date("Y"));
        $data["breadcrumb"]       = "<li class='active'><strong>Jadwal Perawat</strong></li>";
        $data["bagian"]           = ($bagian == "" ? $this->Mpersonalia->getbagian()->row()->kode_bagian : $bagian);
        $data["p"]                = $this->Mpersonalia->getperawat_bagian($data["bagian"]);
        $data["bag"]              = $this->Mpersonalia->getbagian();
        $data["bg"]               = $this->Mpersonalia->getbagian_array();
        $data["libur"]            = $this->Madmindkk->getliburnasional_array();
        $this->load->view("personalia/vcetakjadwal_perawat", $data);
    }
    function liburnasional($b = 1, $tahun = "")
    {
        $data["title"]            = $this->session->userdata('status_user');
        $data["username"]         = $this->session->userdata('username');
        $data['menu']             = "liburnasional";
        $data['vmenu']            = "admindkk/vmenu";
        $data["content"]          = "admindkk/vliburnasional";
        $data["title_header"]     = "Libur Nasional";
        $data["b"]                = $b;
        $tahun                    = ($tahun == "" ? date("Y") : $tahun);
        $data["t"]                = $tahun;
        $data["q"]                = $this->Madmindkk->getliburnasional($b, $tahun);
        $data["libur"]            = $this->Madmindkk->getliburnasional_array();
        $data["breadcrumb"]       = "<li class='active'><strong>Libur Nasional</strong></li>";
        $this->load->view('template', $data);
    }
    function cetak_perawat($id)
    {
        $data["status"]           = "status";
        $data["id_perawat"]       = $id;
        $data["p"]                = $this->Mpersonalia->getcetak_perawat($id);
        $data["rs"]               = $this->Mpersonalia->getkarumkit();
        $data["pkt"]              = $this->Mpersonalia->getriwayatpangkat($id);
        $data["pns"]              = $this->Mpersonalia->getpangkat_cpns($id);
        $data["awl"]              = $this->Mpersonalia->getpangkat_awal($id);
        $data["jab"]              = $this->Mpersonalia->getriwayatjabatan($id);
        $data["pend"]             = $this->Mpersonalia->getriwayatpendidikan($id);
        $data["dik"]              = $this->Mpersonalia->getriwayatdiklat($id);
        $data["kur"]              = $this->Mpersonalia->getriwayatkursus($id);
        $data["m"]                = $this->Mpersonalia->getriwayatmiliter($id);
        $data["pg"]               = $this->Mpersonalia->getriwayatpenugasan($id);
        $data["kel"]              = $this->Mpersonalia->getriwayatkeluarga($id);
        $this->load->view("personalia/vcetak_perawat", $data);
    }
    function d_pangkat()
    {
        $data["title"]            = $this->session->userdata('status_user');
        $data["username"]         = $this->session->userdata('username');
        $data['menu']             = "personalia";
        $data['vmenu']            = "admindkk/vmenu";
        $data["content"]          = "personalia/vd_pangkat";
        $data["title_header"]     = "Pangkat";
        $data["p"]                = $this->Mpersonalia->getpangkat_dahsboard();
        $this->load->view('template', $data);
    }
    function listpangkat_dashboard(){
      echo json_encode($this->Mhome->getlistpasien_inap_kelas());
    }
}
