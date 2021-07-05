<?php
class Laporan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->Model('Mlaporan');
    $this->load->Model('Mpendaftaran');
    $this->load->Model('Mkasir');
    if (($this->session->userdata('username') == NULL) || ($this->session->userdata('password') == NULL)) {
      $this->session->sess_destroy();
      redirect('login', 'refresh');
    }
  }
  function list_rl2a($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL2A Rawat Inap";
    $data['judul']              = "RL2A Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/rl2a/vlistlap_rl2a";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "RL2A Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";
    $data["q"]                  = $this->Mlaporan->geticd();
    $data["p"]                  = $this->Mlaporan->getrl2a($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function rl2a($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL2A Rawat Inap";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "RL2A Rawat Inap ";
    $data["q"]                  = $this->Mlaporan->geticd();
    $data["p"]                  = $this->Mlaporan->getrl2a($tgl1, $tgl2);
    $this->load->view('laporan/rl2a/vlap_rl2a', $data);
  }
  function list_rl2a_ralan($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL2B Rawat Jalan";
    $data['judul']              = "RL2B Rawat Jalan";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/rl2a/vlistlap_rl2a_ralan";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "RL2B Rawat Jalan ";
    $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Jalan</strong></li>";
    $data["q"]                  = $this->Mlaporan->geticd();
    $data["p"]                  = $this->Mlaporan->getrl2a_ralan($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function rl2a_ralan($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL2B Rawat Jalan";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "RL2B Rawat Jalan ";
    $data["q"]                  = $this->Mlaporan->geticd();
    $data["p"]                  = $this->Mlaporan->getrl2a_ralan($tgl1, $tgl2);
    $this->load->view('laporan/rl2a/vlap_rl2a_ralan', $data);
  }
  function list_rl2a1($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL2A1 Rawat Inap";
    $data['judul']              = "RL2A1 Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/rl2a1/vlistlap_rl2a1";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "RL2A1 Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";
    $data["q"]                  = $this->Mlaporan->geticd_rl2a1();
    $data["p"]                  = $this->Mlaporan->getrl2a1($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function rl2a1($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL2A 1 Rawat Inap";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "RL2A 1 Rawat Inap ";
    $data["q"]                  = $this->Mlaporan->geticd_rl2a1();
    $data["p"]                  = $this->Mlaporan->getrl2a1($tgl1, $tgl2);
    $this->load->view('laporan/rl2a1/vlap_rl2a1', $data);
  }
  function list_rl3a($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL3A Rawat Inap";
    $data['judul']              = "RL3A Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/rl3a/vlistlap_rl3a";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "RL3A Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";
    $data["p"]                  = $this->Mlaporan->getrl3a($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function daftarpasien($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "Daftar Pasien Rawat Inap";
    $data['judul']              = "Daftar Pasien Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/daftarpasien/vdaftarpasien";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Daftar Pasien Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Inap</strong></li>";
    $data["q"]                  = $this->Mlaporan->geticd();
    $data["p"]                  = $this->Mlaporan->getrl2a($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function cetakdaftarpasien($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "Daftar Pasien Rawat Inap";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "Daftar Pasien Rawat Inap ";
    $data["q"]                  = $this->Mlaporan->geticd();
    $data["p"]                  = $this->Mlaporan->getrl2a($tgl1, $tgl2);
    $this->load->view('laporan/daftarpasien/vcetakdaftarpasien', $data);
  }
  function xkr15($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "XKR 15 Rawat Inap";
    $data['judul']              = "XKR 15 Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/xkr15/vxkr15";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "XKR 15 Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>XKR 15 Rawat Inap</strong></li>";
    $data["p"]                  = $this->Mlaporan->getxkr5($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function cetakxkr15($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]        = "XKR 15 Rawat Inap";
    $data["username"]     = $this->session->userdata('nama_user');
    $data["title_header"] = "XKR 15 Rawat Inap";
    $data["p"]                  = $this->Mlaporan->getxkr5($tgl1, $tgl2);
    $this->load->view('laporan/xkr15/vcetakxkr15', $data);
  }
  function xkr14($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "XKR 14 Rawat Inap";
    $data['judul']              = "XKR 14 Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/xkr14/vxkr14";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "XKR 14 Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>XKR 14 Rawat Inap</strong></li>";
    $data["nh"]                  = $this->Mlaporan->getxkr14("NORMAL", "hidup", $tgl1, $tgl2);
    $data["nm"]                  = $this->Mlaporan->getxkr14("NORMAL", "mati", $tgl1, $tgl2);
    $data["ph"]                  = $this->Mlaporan->getxkr14("PREMATUR", "hidup", $tgl1, $tgl2);
    $data["pm"]                  = $this->Mlaporan->getxkr14("PREMATUR", "mati", $tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function cetakxkr14($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]        = "XKR 14 Rawat Inap";
    $data["username"]     = $this->session->userdata('nama_user');
    $data["title_header"] = "XKR 14 Rawat Inap";
    $data["nh"]           = $this->Mlaporan->getxkr14("NORMAL", "hidup", $tgl1, $tgl2);
    $data["nm"]           = $this->Mlaporan->getxkr14("NORMAL", "mati", $tgl1, $tgl2);
    $data["ph"]           = $this->Mlaporan->getxkr14("PREMATUR", "hidup", $tgl1, $tgl2);
    $data["pm"]           = $this->Mlaporan->getxkr14("PREMATUR", "mati", $tgl1, $tgl2);
    $this->load->view('laporan/xkr14/vcetakxkr14', $data);
  }
  function xkr13($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "XKR 13 Rawat Inap";
    $data['judul']              = "XKR 13 Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/xkr13/vxkr13";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "XKR 13 Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>XKR 13 Rawat Inap</strong></li>";
    $data["n"]                  = $this->Mlaporan->getxkr13(0, $tgl1, $tgl2);
    $data["p"]                  = $this->Mlaporan->getxkr13(1, $tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function cetakxkr13($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]        = "XKR 13 Rawat Inap";
    $data["username"]     = $this->session->userdata('nama_user');
    $data["title_header"] = "XKR 13 Rawat Inap";
    $data["n"]                  = $this->Mlaporan->getxkr13(0, $tgl1, $tgl2);
    $data["p"]                  = $this->Mlaporan->getxkr13(1, $tgl1, $tgl2);
    $this->load->view('laporan/xkr13/vcetakxkr13', $data);
  }
  function search()
  {
    $this->session->set_userdata('tgl1', $this->input->post("tgl1"));
    $this->session->set_userdata('tgl2', $this->input->post("tgl2"));
  }
  function reset()
  {
    $this->session->unset_userdata('tgl1');
    $this->session->unset_userdata('tgl2');
    redirect("laporan/list_rl2a");
  }
  function malaria($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "Malaria Rawat Inap";
    $data['judul']              = "Malaria Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/malaria/vmalaria";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Malaria Rawat Inap ";
    $data["breadcrumb"]         = "<li class='active'><strong>Malaria Rawat Inap</strong></li>";
    $data["p"]                  = $this->Mlaporan->getmalaria($tgl1, $tgl2);
    $data["s"]                  = $this->Mlaporan->getmalariasebelumnya($tgl1);
    $data["n"]                  = $this->Mlaporan->getmalariapengobatan($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function cetakmalaria($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]        = "Malaria Rawat Inap";
    $data["username"]     = $this->session->userdata('nama_user');
    $data["title_header"] = "Malaria Rawat Inap";
    $data["p"]                  = $this->Mlaporan->getmalaria($tgl1, $tgl2);
    $this->load->view('laporan/malaria/vcetakmalaria', $data);
  }
  function covid($tgl1 = "", $tgl2 = "", $golpas = "all", $tingkat_status = "all")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["golpas"] = $golpas;
    $data["tingkat_status"] = $tingkat_status;
    $data["gp"] = $this->Mlaporan->golpasien();
    $data["title"]              = "Laporan Covid";
    $data['judul']              = "Laporan Covid";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/covid/vlaporan_covid";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Laporan Harian Covid-19";
    $data["breadcrumb"]         = "<li class='active'><strong>Laporan Covid</strong></li>";
    $data["n"]                  = $this->Mlaporan->getcovid($tgl1, $tgl2, $golpas, $tingkat_status);
    $data["p"]                  = $this->Mlaporan->getpasienigd($tgl1, $tgl2, $golpas, $tingkat_status);
    $this->load->view('template', $data);
  }
  function cetakcovid($tgl1 = "", $tgl2 = "", $golpas = "all", $tingkat_status = "all")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "Laporan Covid";
    $data['judul']              = "Laporan Covid";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "Laporan Harian Covid-19";
    $data["n"]                  = $this->Mlaporan->getcovid($tgl1, $tgl2, $golpas, $tingkat_status);
    $data["p"]                  = $this->Mlaporan->getpasienigd($tgl1, $tgl2, $golpas, $tingkat_status);
    $this->load->view('laporan/covid/vcetak_covid', $data);
  }
  function rl12_indikator($parent = "", $tahun = "")
  {
    $tahun = $tahun == "" ? date("Y") : $tahun;
    $data["parent"] = $parent;
    $data["tahun"] = $tahun;
    $data["title"]              = "Laporan RL 1.2 Indikator";
    $data['judul']              = "Laporan RL 1.2 Indikator";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/vlaporan_rl12_indikator";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Laporan RL 1.2 Indikator";
    $data["breadcrumb"]         = "<li class='active'><strong>Laporan RL 1.2 Indikator</strong></li>";
    $this->load->view('template', $data);
  }
  function rl2_ketenagaan($parent = "", $tahun = "")
  {
    $tahun = $tahun == "" ? date("Y") : $tahun;
    $parent = $parent == "" ? $this->Mlaporan->getkualifikasi_pendidikan_parent()->row()->kode : $parent;
    $data["parent"] = $parent;
    $data["tahun"] = $tahun;
    $data["title"]              = "Laporan RL2 Ketenagaan";
    $data['judul']              = "Laporan RL2 Ketenagaan";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/vlaporan_rl2_ketenagaan";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Laporan RL2 Ketenagaan";
    $data["breadcrumb"]         = "<li class='active'><strong>Laporan RL2 Ketenagaan</strong></li>";
    $data["n"]          = $this->Mlaporan->getkualifikasi_pendidikan_parent();
    $data["k"]          = $this->Mlaporan->getkualifikasi_pendidikan($parent);
    $data["p"]                  = $this->Mlaporan->getrl2_ketenagaan($tahun);
    $this->load->view('template', $data);
  }
  function cetak_rl2_ketenagaan($tahun = "")
  {
    $tahun = $tahun == "" ? date("d-m-Y") : $tahun;
    $data["tahun"] = $tahun;
    $data["title"]              = "Laporan Covid";
    $data['judul']              = "Laporan Covid";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "Laporan Harian Covid-19";
    $data["k"]          = $this->Mlaporan->getkualifikasi_pendidikan("all");
    $data["p"]                  = $this->Mlaporan->getrl2_ketenagaan($tahun);
    $this->load->view('laporan/vcetak_rl2_ketenagaan', $data);
  }
  function simpanrl2_ketenagaan()
  {
    $message = $this->Mlaporan->simpanrl2_ketenagaan();
    // echo json_encode($this->input->post("keadaan_laki_0_12"));
    redirect("laporan/rl2_ketenagaan/" . $this->input->post("parent") . "/" . $this->input->post("tahun"));
  }
  function rl32_rawatdarurat($tahun = "")
  {
    $tahun = $tahun == "" ? date("Y") : $tahun;
    $data["tahun"] = $tahun;
    $data["title"]              = "Laporan RL3.2 Rawat Darurat";
    $data['judul']              = "Laporan RL3.2 Rawat Darurat";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/vlaporan_rl32_rawatdarurat";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Laporan RL3.2 Rawat Darurat";
    $data["breadcrumb"]         = "<li class='active'><strong>Laporan RL3.2 Rawat Darurat</strong></li>";
    $data["k"]          = $this->Mlaporan->getkeputusan();
    $data["q"]          = $this->Mlaporan->rl32_rawatdarurat($tahun);
    $this->load->view('template', $data);
  }
  function cetak_rl32_rawatdarurat($tahun = "")
  {
    $tahun = $tahun == "" ? date("Y") : $tahun;
    $data["tahun"] = $tahun;
    $data["title"]              = "Laporan RL3.2 Rawat Darurat";
    $data['judul']              = "Laporan RL3.2 Rawat Darurat";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "Laporan RL3.2 Rawat Darurat";
    $data["k"]          = $this->Mlaporan->getkeputusan();
    $data["q"]          = $this->Mlaporan->rl32_rawatdarurat($tahun);
    $this->load->view('laporan/vcetak_rl32_rawatdarurat', $data);
  }
  function inos_harian($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl1));
    $tgl2 = $tgl2 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl2));
    $data["title"]              = "Inos Harian Rawat Inap";
    $data["title_header"]      = "Inos Harian Rawat Inap";
    $data["judul"]              = "Inos Harian Rawat Inap";
    $data["q"]                = $this->Mpendaftaran->getjenisinos();
    $data["row"]              = $this->Mlaporan->getpasien_inos($tgl1, $tgl2);
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/vinos_harian";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["tgl1"]               = $tgl1;
    $data["tgl2"]               = $tgl2;
    $data["breadcrumb"]         = "<li class='active'><strong>Inos Harian Rawat Inap</strong></li>";
    $this->load->view('template', $data);
  }
  function cetakinos_harian($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl1));
    $tgl2 = $tgl2 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl2));
    $data["title"]  = "Inos Harian Rawat Inap";
    $data["tgl1"]   = $tgl1;
    $data["tgl2"]   = $tgl2;
    $data["q"]    = $this->Mpendaftaran->getjenisinos();
    $data["row"]  = $this->Mlaporan->getpasien_inos($tgl1, $tgl2);
    $this->load->view('laporan/vcetakinos_harian', $data);
  }
  function excelinos_harian($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl1));
    $tgl2 = $tgl2 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl2));
    $data["title"]  = "Inos Harian Rawat Inap";
    $data["tgl1"]               = $tgl1;
    $data["tgl2"]               = $tgl2;
    $data["q"]    = $this->Mpendaftaran->getjenisinos();
    $data["row"]  = $this->Mlaporan->getpasien_inos($tgl1, $tgl2);
    $this->load->view('laporan/vexcelinos_harian', $data);
  }
  function inos_bulanan($ruangan = "all", $b = "")
  {
    $data["title"]              = "Inos Bulanan Rawat Inap";
    $data["title_header"]       = "Inos Bulanan Rawat Inap";
    $data["judul"]              = "Inos Bulanan Rawat Inap";
    $data["r"]                  = $this->Mlaporan->getruangan();
    $b = ($b == "" ? date("m") : $b);
    $data["b"]                  = $b;
    $data["bagian"]             = $ruangan;
    $data["q"]                  = $this->Mlaporan->getinos($ruangan, $b, date("Y"));
    // $data["bln"]                = $this->Mlaporan->getbulan_inos($b, date("Y"));
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/vinos_bulanan";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["breadcrumb"]         = "<li class='active'><strong>Inos Bulanan Rawat Inap</strong></li>";
    $this->load->view('template', $data);
  }
  function cetakinos_bulanan($ruangan = "all", $b = "")
  {
    $data["title"]              = "Inos Bulanan Rawat Inap";
    $data["r"]                  = $this->Mlaporan->getruangan();
    $b = ($b == "" ? date("m") : $b);
    $data["b"]                  = $b;
    $data["bagian"]             = $ruangan;
    $data["q"]                  = $this->Mlaporan->getinos($ruangan, $b, date("Y"));
    $this->load->view('laporan/vcetakinos_bulanan', $data);
  }
  function excelinos_bulanan($ruangan = "all", $b = "")
  {
    $data["title"]              = "Inos Bulanan Rawat Inap";
    $data["r"]                  = $this->Mlaporan->getruangan();
    $b = ($b == "" ? date("m") : $b);
    $data["b"]                  = $b;
    $data["bagian"]             = $ruangan;
    $data["q"]                  = $this->Mlaporan->getinos($ruangan, $b, date("Y"));
    $this->load->view('laporan/vexcelinos_bulanan', $data);
  }
  function kunjunganralan($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "Kunjungan Rawat Jalan";
    $data['judul']              = "Kunjungan Rawat Jalan";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/kunjungan/ralan/vkunjunganralan";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Kunjungan Rawat Jalan";
    $data["breadcrumb"]         = "<li class='active'><strong>Kunjungan Rawat Jalan</strong></li>";
    $data["q"]                  = $this->Mlaporan->kunjunganralan($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function cetakkunjunganralan($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl1));
    $tgl2 = $tgl2 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl2));
    $data["title"]              = "Kunjungan Rawat Jalan";
    $data["tgl1"]               = $tgl1;
    $data["tgl2"]               = $tgl2;
    $data["q"]                  = $this->Mlaporan->kunjunganralan($tgl1, $tgl2);
    $this->load->view('laporan/kunjungan/ralan/vcetakkunjunganralan', $data);
  }
  function excelkunjunganralan($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl1));
    $tgl2 = $tgl2 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl2));
    $data["title"]              = "Kunjungan Rawat Jalan";
    $data["tgl1"]               = $tgl1;
    $data["tgl2"]               = $tgl2;
    $data["q"]                  = $this->Mlaporan->kunjunganralan($tgl1, $tgl2);
    $this->load->view('laporan/kunjungan/ralan/vexcelkunjunganralan', $data);
  }
  function kunjunganranap($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "Kunjungan Rawat Inap";
    $data['judul']              = "Kunjungan Rawat Inap";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/kunjungan/ranap/vkunjunganranap";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Kunjungan Rawat Inap";
    $data["breadcrumb"]         = "<li class='active'><strong>Kunjungan Rawat Inap</strong></li>";
    $data["q"]                  = $this->Mlaporan->kunjunganranap($tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function cetakkunjunganranap($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl1));
    $tgl2 = $tgl2 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl2));
    $data["title"]              = "Kunjungan Rawat Inap";
    $data["tgl1"]               = $tgl1;
    $data["tgl2"]               = $tgl2;
    $data["q"]                  = $this->Mlaporan->kunjunganranap($tgl1, $tgl2);
    $this->load->view('laporan/kunjungan/ranap/vcetakkunjunganranap', $data);
  }
  function excelkunjunganranap($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl1));
    $tgl2 = $tgl2 == "" ? date("Y-m-d") : date("Y-m-d", strtotime($tgl2));
    $data["title"]              = "Kunjungan Rawat Inap";
    $data["tgl1"]               = $tgl1;
    $data["tgl2"]               = $tgl2;
    $data["q"]                  = $this->Mlaporan->kunjunganranap($tgl1, $tgl2);
    $this->load->view('laporan/kunjungan/ranap/vexcelkunjunganranap', $data);
  }
  function laporanradlab($tindakan = "lab", $tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "Laporan Lab dan Radiologi";
    $data['judul']              = "Laporan Lab dan Radiologi";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/vlaporanradlab";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "Laporan Lab dan Radiologi";
    $data["breadcrumb"]         = "<li class='active'><strong>Laporan Lab dan Radiologi</strong></li>";
    $data["p"]                  = $this->Mlaporan->gettindakan($tindakan);
    $data["q"]                  = $this->Mlaporan->laporanradlab($tindakan, $tgl1, $tgl2);
    $this->load->view('template', $data);
  }
  function list_rl12($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL1.2 Rawat Jalan";
    $data['judul']              = "RL1.2 Rawat Jalan";
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/rl12/vlistlap_rl12";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["title_header"]       = "RL1.2 Rawat Jalan ";
    $data["breadcrumb"]         = "<li class='active'><strong>Pasien Rawat Jalan</strong></li>";
    $data["q"]                  = $this->Mlaporan->getlaprl12_kunjungan($tgl1, $tgl2);
    $data["q1"]                  = $this->Mlaporan->getlaprl12_pengunjung($tgl1, $tgl2);
    $data["p"]                  = $this->Mlaporan->getpoliklinik();
    $this->load->view('template', $data);
  }
  function rl12($tgl1 = "", $tgl2 = "")
  {
    $tgl1 = $tgl1 == "" ? date("d-m-Y") : $tgl1;
    $tgl2 = $tgl2 == "" ? date("d-m-Y") : $tgl2;
    $data["tgl1"] = $tgl1;
    $data["tgl2"] = $tgl2;
    $data["title"]              = "RL1.2 Rawat Jalan";
    $data["username"]           = $this->session->userdata('nama_user');
    $data["title_header"]       = "RL1.2 Rawat Jalan ";
    // $data["q"]                  = $this->Mlaporan->geticd_rl2a1();
    // $data["p"]                  = $this->Mlaporan->getrl2a1($tgl1, $tgl2);
    $this->load->view('laporan/rl12/vlap_rl12', $data);
  }
  function sensusharian($ruangan = "all", $b = "")
  {
    $data["title"]              = "Sensus Harian Rawat Inap";
    $data["title_header"]       = "Sensus Harian Rawat Inap";
    $data["judul"]              = "Sensus Harian Rawat Inap";
    $data["r"]                  = $this->Mlaporan->getruangan();
    $b = ($b == "" ? date("m") : $b);
    $data["b"]                  = $b;
    $data["bagian"]             = $ruangan;
    $data["q"]                  = $this->Mlaporan->sensusharian($ruangan, $b, date("Y"));
    $data["vmenu"]              = "pendaftaran/vmenu";
    $data["content"]            = "laporan/vsensusharian";
    $data["username"]           = $this->session->userdata('nama_user');
    $data['menu']               = "laporan";
    $data["breadcrumb"]         = "<li class='active'><strong>Sensus Harian Rawat Inap</strong></li>";
    $this->load->view('template', $data);
  }
  function cetaksensus_harian($ruangan = "all", $b = "")
  {
    $data["title"]              = "Sensus Harian";
    $data["r"]                  = $this->Mlaporan->getruangan();
    $b = ($b == "" ? date("m") : $b);
    $data["b"]                  = $b;
    $data["bagian"]             = $ruangan;
    $data["q"]                  = $this->Mlaporan->sensusharian($ruangan, $b, date("Y"));
    $this->load->view('laporan/vcetaksensus_harian', $data);
  }
  function excelsensus_harian($ruangan = "all", $b = "")
  {
    $data["title"]              = "Sensus Harian";
    $data["r"]                  = $this->Mlaporan->getruangan();
    $b = ($b == "" ? date("m") : $b);
    $data["b"]                  = $b;
    $data["bagian"]             = $ruangan;
    $data["q"]                  = $this->Mlaporan->sensusharian($ruangan, $b, date("Y"));
    $this->load->view('laporan/vexcelsensus_harian', $data);
  }
}
