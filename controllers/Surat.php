<?php
class Surat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Msurat');
        $this->load->Model('Msuket');
        $this->load->Model('Mdokter');
        $this->load->Model('Mlab');
        $this->load->Model('Msep');
        $this->load->Model('Mperawat');
        $this->load->Model('Mpendaftaran');
    }
    function pulpak($jenis, $no_reg, $no_pasien = null)
    {
        $data["vmenu"]          = "farmasi/vmenu";
        $data['menu']           = "apotek";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Surat Pulang Paksa || RS CIREMAI";
        $data["title_header"]   = "Surat Pulang Paksa";
        $data["breadcrumb"]     = "<li class='active'><strong>Surat Pulang Paksa</strong></li>";
        $n = $this->Mpersetujuan->getpersetujuan_detail($no_reg);
        $this->load->view('persetujuan/vformpersetujuan', $data);
    }
    function pemulasaran($no_reg, $no_pasien, $jenis)
    {
        $data["vmenu"]          = "farmasi/vmenu";
        $data['menu']           = "apotek";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Pemulasaran || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]             = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]             = $this->Msurat->getpemulasaran_detail($no_reg);
        $this->load->view('pemulasaran/vformpemulasaran', $data);
    }
    function pulang_paksa($no_reg, $no_pasien, $jenis)
    {
        $data["vmenu"]          = "farmasi/vmenu";
        $data['menu']           = "apotek";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Surat Pulang Paksa || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]             = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]             = $this->Msurat->getpulangpaksa_detail($no_reg);
        $data["ttd"]            = $this->Msurat->getttd($no_reg, $jenis);
        $this->load->view('pulang/vformpulangpaksa', $data);
    }
    function rujukan_pasien($no_reg, $no_pasien, $jenis)
    {
        $data["vmenu"]          = "farmasi/vmenu";
        $data['menu']           = "dokter";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Rujukan Pasien || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]             = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]             = $this->Msurat->getrujukan_pasien($no_reg);
        $data["ttd"]            = $this->Msurat->getttd($no_reg, $jenis);
        $this->load->view('dokter/vformrujukanpasien', $data);
    }
    function simpanpulangpaksa($aksi)
    {
        $jenis           = $this->input->post('jenis');
        $no_reg          = $this->input->post('no_reg');
        $no_pasien       = $this->input->post('no_pasien');
        $message = $this->Msurat->simpanpulangpaksa($aksi);
        $this->session->set_flashdata("message", $message);
        redirect('surat/pulang_paksa/' . $no_reg . "/" . $no_pasien . "/" . $jenis);
    }
    function cetakpulangpaksa($no_reg, $no_pasien)
    {
        $data["no_reg"]    = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getpulangpaksa_detail($no_reg);
        $this->load->view("pulang/vcetakpulangpaksa", $data);
    }
    function cetakrujukanpasien($no_reg, $no_pasien)
    {
        $data["no_reg"]    = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getrujukanpasien_detail($no_reg);
        $this->load->view("pulang/vcetakpulangpaksa", $data);
    }
    function simpanpemulasaran($aksi)
    {
        $jenis           = $this->input->post('jenis');
        $no_reg          = $this->input->post('no_reg');
        $no_pasien       = $this->input->post('no_pasien');
        $message = $this->Msurat->simpanpemulasaran($aksi);
        $this->session->set_flashdata("message", $message);
        redirect('surat/pemulasaran/' . $no_reg . "/" . $no_pasien . "/" . $jenis);
    }
    function cetakpemulasaran($no_reg, $no_pasien)
    {
        $data["no_reg"]    = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getpemulasaran_detail($no_reg);
        $this->load->view("pemulasaran/vcetakpemulasaran", $data);
    }
    function kematian($no_reg, $no_pasien, $jenis)
    {
        $this->Msurat->simpankematian($no_reg, $no_pasien, $jenis);
        redirect("surat/cetakkematian/" . $no_reg . "/" . $no_pasien . "/" . $jenis);
    }
    function cetakkematian($no_reg, $no_pasien, $jenis, $status = "copied")
    {
        $data["status"]    = $status;
        $data["no_reg"]    = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        if ($jenis == "ranap") {
            $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        } else {
            $data["q1"]        = $this->Msurat->getpasienralan_detail($no_reg);
        }
        $data["q2"]        = $this->Msurat->getkematian_detail($no_reg);
        $data["q3"]        = $this->Msurat->getsetup_rs();
        $this->load->view("kematian/vcetakkematian", $data);
    }
    function cetakmasukperawatan($no_reg, $no_pasien, $status = "copied")
    {
        $data["status"]    = $status;
        $data["no_reg"]    = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getberitamasukperawatan($no_reg);
        $data["q3"]        = $this->Msurat->getsetup_rs();
        $this->load->view("suket/vdetailmasukperawatan", $data);
    }
    function sebabkematian($no_reg, $no_pasien, $jenis)
    {
        $data["no_reg"]    = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getkematian_detail($no_reg);
        $data["q3"]        = $this->Msurat->getsetup_rs();
        $this->load->view("kematian/vcetaksebabkematian", $data);
    }
    function kelahiran($no_reg, $no_pasien, $jenis)
    {
        $this->Msurat->simpankelahiran($no_reg, $no_pasien, $jenis);
        redirect("surat/cetakkelahiran/" . $no_reg . "/" . $no_pasien);
    }
    function cetakkelahiran($no_reg, $no_pasien)
    {
        $data["status"]    = "copied";
        $data["no_reg"]    = $no_reg;
        $data["no_pasien"] = $no_pasien;
        $data["q"]         = $this->Msurat->getpasien_detail($no_pasien);
        $data["q1"]        = $this->Msurat->getpasieninap_detail($no_reg);
        $data["q2"]        = $this->Msurat->getkelahiran_detail($no_reg);
        $data["q3"]        = $this->Msurat->getsetup_rs();
        $this->load->view("kelahiran/vcetakkelahiran", $data);
    }
    function suketisolasi($no_pasien, $no_reg, $jenis)
    {
        $id = $this->Msuket->simpansuket_isolasi($no_pasien, $no_reg, $jenis);
        redirect("surat/cetaksuket_isolasi/" . $no_pasien . "/" . $no_reg . "/" . $id . "/" . $jenis);
    }
    function suketbebascovid($no_pasien, $no_reg, $jenis)
    {
        $id = $this->Msuket->simpansuket_bebascovid($no_pasien, $no_reg, $jenis);
        redirect("surat/cetaksuket_bebascovid/" . $no_pasien . "/" . $no_reg . "/" . $id . "/" . $jenis);
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
    function cetaksuket_bebascovid($no_reg, $no_pasien, $id, $jenis)
    {
        $data["no_pasien"]          = $no_pasien;
        $data["no_reg"]             = $no_reg;
        $data["id"]                 = $id;
        if ($jenis == "ranap") {
            $data["q"]                  = $this->Msuket->getpasien_detail($no_pasien);
            $data["q1"]                 = $this->Msuket->getpasien_inap($no_reg);
            $data["q2"]                 = $this->Msuket->getsuket_detail($id, "suket_bebascovid");
            $data["q3"]                 = $this->Msuket->getalamat_rs();
        } else {
            $data["q"]                  = $this->Msuket->getpasien_detail($no_pasien);
            $data["q1"]                 = $this->Msuket->getpasien_ralan($no_reg);
            $data["q2"]                 = $this->Msuket->getsuket_detail($id, "suket_bebascovid");
            $data["q3"]                 = $this->Msuket->getalamat_rs();
        }
        $data["swab"] = $this->Msuket->getswab($jenis, $no_reg);
        $this->load->view("suket/vcetaksuket_bebascovid", $data);
    }
    function cetakresumeralan($no_pasien, $no_reg, $nobpjs, $nosep = "")
    {
        $data["no_pasien"]         = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["nosep"]             = $nosep;
        $data["nobpjs"]         = $nobpjs;
        $data["m"]              = $this->Msep->getdiagnosa_ralan($no_reg);
        $data["tr"]              = $this->Msep->gettriage($no_reg);
        $data["t"]              = $this->Msep->gettindakan_ralan($no_reg);
        $data["k"]              = $this->Msep->getkeadaan_ralan($no_reg);
        $data["o"]              = $this->Msep->getterapi_ralan($no_reg);
        $data["p"]              = $this->Msep->getpasien($no_pasien);
        $data["rujukan"]        = ($this->carisep($nosep) != "" ? $this->carisep($nosep) : "");
        $this->load->view('pendaftaran/vcetaksep', $data);
    }
    function cetakresumeinap($no_pasien, $no_reg)
    {
        $data["no_pasien"]  = $no_pasien;
        $data["no_reg"]     = $no_reg;
        $data["q"]                = $this->Mdokter->getlaporan_tindakaninap($no_pasien, $no_reg);
        $data["p"]                = $this->Mdokter->getresume_pulang($no_pasien, $no_reg);
        $data["r"]                = $this->Mdokter->getriwayat_pasien_inap($no_reg);
        $data["rad"]                = $this->Mdokter->getradinap($no_reg);
        $data["pa"]                = $this->Mdokter->getpainap($no_reg);
        $data["ad"]                = $this->Mdokter->getpasien_igdinap($no_reg);
        $data["q1"]     = $this->Mperawat->cetakassesmen_perawat($no_reg)->row();
        $data["ok"]                = $this->Mdokter->getokadetail($no_reg);
        $data["ob"]                = $this->Mdokter->getapotekinap_resume($no_reg);
        $data["kp"]             = $this->Mdokter->getkeadaanpulang();
        $data["dpjp"]             = $this->Mdokter->getdpjp_poli();
        $data["k"]              = $this->Mlab->getlabinap_normal($no_reg);
        $data["hasil"]          = $this->Mlab->getekspertisilabinap_detail_array($no_reg);
        $this->load->view('dokter/vcetakresumeinap', $data);
    }
    function addpasienbaru($id_pasien = NULL, $no_reg = NULL)
    {
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Pendaftaran Pasien Baru&nbsp;&nbsp;&nbsp;";
        $data['menu'] = "user";
        $data["username"] = $this->session->userdata('nama_user');
        $data["title_header"] = "Identitas Pasien";
        $data["breadcrumb"] = "<li class='active'><strong>Identitas Pasien</strong></li>";
        $data["idlama"] = $id_pasien;
        $data["no_reg"] = $no_reg;
        $data["row"] = $this->Mpendaftaran->getdetailpasien($id_pasien);
        $data["l"] = $this->Mpendaftaran->getlock("ralan", $no_reg);
        $data["pi"] = $this->Mpendaftaran->getdetailpasien($id_pasien);
        $data["q1"] = $this->Mpendaftaran->getstatus_keluarga();
        $data["q2"] = $this->Mpendaftaran->getjenis_kelamin();
        $data["q4"] = $this->Mpendaftaran->getpendidikan();
        $data["q5"] = $this->Mpendaftaran->getpekerjaan();
        $data["q6"] = $this->Mpendaftaran->getgolongan();
        $data["q8"] = $this->Mpendaftaran->getstatuspembayaran();
        $data["k"] = $this->Mpendaftaran->getkesatuan();
        $data["k1"] = $this->Mpendaftaran->getgolpasien();
        $data["k3"] = $this->Mpendaftaran->getcabang();
        $data['provinsi'] = json_decode($this->ambil_province())->rajaongkir->results;
        $data["kw"] = $this->Mpendaftaran->getkawin();
        $data["h"] = $this->Mpendaftaran->gethubungankeluarga();
        $data["s"] = $this->Mpendaftaran->getsuku();
        $this->load->view('suket/vaddpasienbaru', $data);
    }
    function ambil_province($id = "")
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/province?id=" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: c54c2237da96b5b342eded2febe37665"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
    function ambil_kota($prov = "")
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=" . $prov . "&id=",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "key: c54c2237da96b5b342eded2febe37665"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
    function ambil_kecamatan($city = "")
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=" . $city . "&id=",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "key: c54c2237da96b5b342eded2febe37665"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
    function simpanpasienbaru($action)
    {
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $message = $this->Mpendaftaran->simpanpasienbaru($action);
        $this->db->where("no_reg", $no_reg);
        $this->db->update("pasien_ralan", ["lock" => 1]);
        $this->session->set_flashdata("message", $message);
        $m = explode("-", $message);
        $this->session->set_flashdata('no_pasien', $m[2]);
        redirect("surat/addpasienbaru/" . $m[2] . "/" . $no_reg);
    }
    function addpasienbaru_inap($id_pasien = NULL, $no_reg = NULL)
    {
        $data['judul'] = "Pendaftaran Pasien Baru&nbsp;&nbsp;&nbsp;";
        $data["title_header"] = "Identitas Pasien Rawat Inap";
        $data["breadcrumb"] = "<li class='active'><strong>Identitas Pasien Rawat Inap</strong></li>";
        $data["idlama"] = $id_pasien;
        $data["no_reg"] = $no_reg;
        $data["row"] = $this->Mpendaftaran->getdetailpasien($id_pasien);
        $data["l"] = $this->Mpendaftaran->getlock("ranap", $no_reg);
        $data["q1"] = $this->Mpendaftaran->getstatus_keluarga();
        $data["q2"] = $this->Mpendaftaran->getjenis_kelamin();
        $data["q4"] = $this->Mpendaftaran->getpendidikan();
        $data["q5"] = $this->Mpendaftaran->getpekerjaan();
        $data["q6"] = $this->Mpendaftaran->getgolongan();
        $data["q8"] = $this->Mpendaftaran->getstatuspembayaran();
        $data["k"] = $this->Mpendaftaran->getkesatuan();
        $data["k1"] = $this->Mpendaftaran->getgolpasien();
        $data["k3"] = $this->Mpendaftaran->getcabang();
        $data['provinsi'] = json_decode($this->ambil_province())->rajaongkir->results;
        $data["kw"] = $this->Mpendaftaran->getkawin();
        $data["h"] = $this->Mpendaftaran->gethubungankeluarga();
        $data["s"] = $this->Mpendaftaran->getsuku();
        $this->load->view('suket/vaddpasienbaru_inap', $data);
    }
    function simpanpasienbaru_inap($action)
    {
        $no_pasien = $this->input->post("no_pasien");
        $no_reg = $this->input->post("no_reg");
        $message = $this->Mpendaftaran->simpanpasienbaru_inap($action);
        $this->session->set_flashdata("message", $message);
        $this->db->where("no_reg", $no_reg);
        $this->db->update("pasien_inap", ["lock" => 1]);
        $m = explode("-", $message);
        $this->session->set_flashdata('no_pasien', $m[2]);
        redirect("surat/addpasienbaru_inap/" . $m[2] . "/" . $no_reg);
    }
    function carisep($nosep)
    {
        $result = json_decode($this->api_vclaim("SEP_" . $nosep));
        return $result->response;
    }
    function api_vclaim($url)
    {
        $data = "20337";
        $secretKey = "4tW3926623";
        date_default_timezone_set('UTC');
        $url = str_replace("_", "/", $url);
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $data . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/" . $url;
        $curl = curl_init();
        $header = array(
            "X-cons-id" => $data,
            "X-signature" => $encodedSignature,
            "X-timestamp" => $tStamp
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "X-cons-id: " . $data . " ",
                "X-signature: " . $encodedSignature . " ",
                "X-timestamp: " . $tStamp,
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    function ttdobat($no_pasien, $no_reg, $jenis)
    {
        $data["vmenu"]          = "surat/vmenu";
        $data['menu']           = "apotek";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Pemulasaran || RS CIREMAI";
        $data["q"]                  = $this->Msuket->getpasien_detail($no_pasien);
        if ($jenis == "ralan") {
            $data["q1"]                 = $this->Msuket->getpasien_ralan($no_reg);
        } else {
            $data["q1"]                 = $this->Msuket->getpasien_inap($no_reg);
        }
        $this->load->view('persetujuan/vttdobat', $data);
    }
    function simpanttdobat()
    {
        $message = $this->Msuket->simpanttdobat();
        $this->session->set_flashdata("message", $message);
        redirect('surat/ttdobat/' . $this->input->post("no_pasien") . "/" . $this->input->post("no_reg") . "/" . $this->input->post("jenis"));
    }
    function artikel($slug)
    {
        $q = $this->db->get_where("halaman", ["slug" => $slug]);
        $data["row"] = $q->row();
        $this->load->view("suket/vartikel", $data);
    }
    function tindakanmedis($no_reg, $no_pasien, $jenis)
    {
        $data['menu']           = "tindakanmedis";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Surat Tindakan Medis || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        $data["dok"] = $this->Mpendaftaran->getdokter();
        $data["dp"] = $this->Mpendaftaran->getdokterperawat();
        $data["p"] = $this->Msurat->getpasien_tindakan($no_reg, $jenis);
        $data["tm"] = $this->Msurat->gettindakan_medis();
        $data["ttd"] = $this->Msurat->getttd($no_reg, $jenis);
        $this->load->view('suket/vformtindakanmedis', $data);
    }
    function beritamasukperawatan($no_reg, $no_pasien, $jenis)
    {
        $data['menu']           = "beritamasukperawatan";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Berita Masuk Perawatan || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        $data["pi"] = $this->Msurat->getpasieninap_detail($no_reg);
        $data["ad"]        = $this->Mpendaftaran->getassesmen_dokter($no_reg);
        $data["dok"] = $this->Mpendaftaran->getdokter();
        $data["dp"] = $this->Mpendaftaran->getdokterperawat();
        $data["p"] = $this->Msurat->getpasien_masukperawatan($no_reg, $jenis);
        $data["ttd"] = $this->Msurat->getttd($no_reg, $jenis);
        $this->load->view('suket/vcetakberitamasukperawatan', $data);
    }
    function beritalepasperawatan($no_reg, $no_pasien, $jenis)
    {
        $data['menu']           = "beritalepasperawatan";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Berita Lepas Perawatan || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        $data["pi"] = $this->Msurat->getpasieninap_detail($no_reg);
        $data["dok"] = $this->Mpendaftaran->getdokter();
        $data["dp"] = $this->Mpendaftaran->getdokterperawat();
        $data["rp"]        = $this->Mdokter->getresume_pulang($no_pasien, $no_reg);
        $data["p"] = $this->Msurat->getpasien_lepasperawatan($no_reg, $jenis);
        $data["ttd"] = $this->Msurat->getttd($no_reg, $jenis);
        $this->load->view('suket/vcetakberitalepasperawatan', $data);
    }
    function suratketerangandokter($no_reg, $no_pasien, $jenis)
    {
        $data['menu']           = "suratketerangandokter";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Surat Keterangan Dokter || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        if ($jenis == "ralan") {
            $data["pi"]                 = $this->Msurat->getpasienralan_detail($no_reg);
        } else {
            $data["pi"] = $this->Msurat->getpasieninap_detail($no_reg);
        }
        $data["dok"] = $this->Mpendaftaran->getdokter();
        $data["dp"] = $this->Mpendaftaran->getdokterperawat();
        $data["p"] = $this->Msurat->getpasien_keterangandokter($no_reg, $jenis);
        $data["ttd"] = $this->Msurat->getttd($no_reg, $jenis);
        $data["ap"] = $this->Msurat->getassesmen_dokter($no_reg, $jenis);
        $this->load->view('suket/vcetaksuratketerangandokter', $data);
    }
    function suratistirahatsakit($no_reg, $no_pasien, $jenis)
    {
        $data['menu']           = "suratistirahatsakit";
        $data["jenis"]          = $jenis;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Surat Istirahat Sakit || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        if ($jenis == "ralan") {
            $data["pi"]                 = $this->Msurat->getpasienralan_detail($no_reg);
        } else {
            $data["pi"] = $this->Msurat->getpasieninap_detail($no_reg);
        }

        $data["dok"] = $this->Mpendaftaran->getdokter();
        $data["dp"] = $this->Mpendaftaran->getdokterperawat();
        $data["p"] = $this->Msurat->getpasien_suratistirahatsakit($no_reg, $jenis);
        $data["ttd"] = $this->Msurat->getttd($no_reg, $jenis);
        $this->load->view('suket/vcetaksuratistirahatsakit', $data);
    }
    function cetaktindakanmedis($no_reg, $no_pasien, $jenis, $tindakan = "")
    {
        $data['menu']           = "tindakanmedis";
        $data["jenis"]          = $jenis;
        $data["tindakan"]       = $tindakan;
        $data["no_reg"]         = $no_reg;
        $data["no_pasien"]      = $no_pasien;
        $data["title"]          = "Surat Tindakan Medis || RS CIREMAI";
        $data["q"]              = $this->Msurat->getpasien_detail($no_pasien);
        $data["dok"] = $this->Mpendaftaran->getdokter();
        $data["dp"] = $this->Mpendaftaran->getdokterperawat();
        $data["p"] = $this->Msurat->getpasien_tindakan($no_reg, $jenis);
        $data["tm"] = $this->Msurat->gettindakan_medis();
        $data["ttd"] = $this->Msurat->getttd($no_reg, $jenis);
        $this->load->view('suket/vcetaktindakanmedis', $data);
    }
    function simpantindakanmedis()
    {
        $message = $this->Msurat->simpantindakanmedis();
        $this->session->set_flashdata("message", $message);
        redirect('surat/tindakanmedis/' . $this->input->post("no_reg") . "/" . $this->input->post("no_pasien") . "/" . $this->input->post("jenis"));
    }
    function getttd()
    {
        $this->db->where("no_reg", $this->input->post("no_reg"));
        $this->db->where("no_pasien", $this->input->post("no_pasien"));
        $q = $this->db->get("pemulasaran")->row();
        echo json_encode($q);
    }
}
