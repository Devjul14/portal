<?php
class Grouper extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Madmindkk');
		$this->load->Model('Mpendaftaran');
		$this->load->Model('Mkasir');
        $this->load->Model('Mgrouper');
        $this->load->Model('Mgizi');
        $this->load->Model('Mradiologi');
        $this->load->Model('Mapotek');
        $this->load->Model('Mpa');
        $this->load->Model('Mlab');
        $this->load->Model('Moka');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL)){
            $this->session->sess_destroy();
			redirect('login','refresh');
        }
    }
    function grouper_ralan($current=0,$from=0){
		$data["title"] = "Grouper Rawat Jalan || RS CIREMAI";
		$data['judul'] = "Grouper Rawat Jalan &nbsp;&nbsp;&nbsp;";
		$data["vmenu"] = $this->session->userdata("controller")."/vmenu";
		$data["content"] = "grouper/vlistrawatjalan";
		$data["username"] = $this->session->userdata('nama_user');
	    $data['menu']="grouper";
	    $data["current"] = $current;
	    $data["title_header"] = "Grouper Rawat Jalan ";
	    $data["p"] = $this->Mpendaftaran->getpoli();
	    $data["breadcrumb"] = "<li class='active'><strong>Grouper Rawat Jalan</strong></li>";
		$this->load->library('pagination');
        $config['base_url'] = base_url().'grouper/grouper_ralan/'.$current;
        $config['total_rows'] = $this->Mgrouper->getjumlahpasien_ralan();
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
		$data["q3"] =$this->Mgrouper->getpasien_ralan($config['per_page'],$from);
		$this->load->view('template',$data);
    }
    function grouper_inap($current=0,$from=0){
        $data["title"] = "Grouper Rawat Inap || RS CIREMAI";
        $data['judul'] = "Grouper Rawat Inap &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "grouper/vlistrawatinap";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="grouper";
        $data["current"] = $current;
        $data["title_header"] = "Grouper Rawat Inap ";
        $data["p"] = $this->Mpendaftaran->getpoli();
        $data["breadcrumb"] = "<li class='active'><strong>Grouper Rawat Inap</strong></li>";
        $this->load->library('pagination');
        $config['base_url'] = base_url().'grouper/grouper_inap/'.$current;
        $config['total_rows'] = $this->Mgrouper->getjumlahpasien_inap();
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
        $data["k"] = $this->Mkasir->getkeadaan_pulang();
        $data["sp"] = $this->Mkasir->getstatus_pulang();
        $data["q3"] =$this->Mgrouper->getpasien_inap($config['per_page'],$from);
        $this->load->view('template',$data);
    }
    function getcaripasien_ralan(){
        $this->session->set_userdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
    }
    function getcaripasien_inap(){
        $this->session->set_userdata("no_rm",$this->input->post("cari_no"));
        $this->session->set_userdata("nama",$this->input->post("cari_nama"));
        $this->session->set_userdata("no_reg",$this->input->post("cari_noreg"));
    }
    function reset_ralan(){
        $this->session->unset_userdata('no_pasien');
        $this->session->unset_userdata('poli_kode');
        $this->session->unset_userdata('poliklinik');
        $this->session->unset_userdata('kode_dokter');
        $this->session->unset_userdata('dokter');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        redirect("grouper/grouper_ralan");
    }
    function search_ralan(){
        $this->session->set_userdata('poli_kode',$this->input->post("poli_kode"));
        $this->session->set_userdata('poliklinik',$this->input->post("poliklinik"));
        $this->session->set_userdata('kode_dokter',$this->input->post("kode_dokter"));
        $this->session->set_userdata('dokter',$this->input->post("dokter"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function search_inap(){
        $this->session->set_userdata('kode_kelas',$this->input->post("kode_kelas"));
        $this->session->set_userdata('kelas',$this->input->post("kelas"));
        $this->session->set_userdata('kode_ruangan',$this->input->post("kode_ruangan"));
        $this->session->set_userdata('ruangan',$this->input->post("ruangan"));
        $this->session->set_userdata('tgl1',$this->input->post("tgl1"));
        $this->session->set_userdata('tgl2',$this->input->post("tgl2"));
    }
    function reset_inap(){
        $this->session->unset_userdata('no_rm');
        $this->session->unset_userdata('kode_kelas');
        $this->session->unset_userdata('kelas');
        $this->session->unset_userdata('kode_ruangan');
        $this->session->unset_userdata('ruangan');
        $this->session->unset_userdata('tgl1');
        $this->session->unset_userdata('tgl2');
        redirect("grouper/grouper_inap");
    }
    function viewgrouper_ralan($no_pasien,$no_reg){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="grouper";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"] = "Grouper Rawat Jalan || RS CIREMAI";
        $data["title_header"] = "Grouper Rawat Jalan";
        $data["content"] = "grouper/vviewgrouper_ralan";
        $data["breadcrumb"]   = "<li class='active'><strong>Grouper Rawat Jalan</strong></li>";
        $data["row"] = $this->Mgrouper->getralan_detail($no_pasien,$no_reg);
        $data["g1"] = $this->Mgrouper->getgrouper(6,0);
        $data["g2"] = $this->Mgrouper->getgrouper(6,6);
        $data["g3"] = $this->Mgrouper->getgrouper(6,12);
        $data["k"]              = $this->Mapotek->getapotek($no_reg);
        $data["hasil"] = $this->Mgrouper->getgrouper_ralan($no_reg);
        $icd9 = $this->Mgrouper->geticd9_array();
        $icd10 = $this->Mgrouper->geticd10_array();
        $data["icd10"] = $icd10;
        $data["icd9"] = $icd9;
        $data["i10"] = $this->Mgrouper->geticd10_ralan($no_reg);
        $data["i9"] = $this->Mgrouper->geticd9_ralan($no_reg,$icd9);
        $this->load->view('template',$data);
    }
    function viewgrouper_inap($no_pasien,$no_reg,$backpage="grouper"){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="grouper";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["backpage"] = $backpage;
        $data["title"] = "Grouper Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Grouper Rawat Inap";
        $data["content"] = "grouper/vviewgrouper_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Grouper Rawat Inap</strong></li>";
        $data["row"] = $this->Mgrouper->getinap_detail($no_pasien,$no_reg);
        $data["g1"] = $this->Mgrouper->getgrouper(6,0);
        $data["g2"] = $this->Mgrouper->getgrouper(6,6);
        $data["g3"] = $this->Mgrouper->getgrouper(6,12);
        $data["k"]  = $this->Mapotek->getapotek_inap($no_reg);
        $data["hasil"] = $this->Mgrouper->getgrouper_inap($no_reg);
        $data["i10"] = $this->Mgrouper->geticd10_inap($no_reg);
        $icd9 = $this->Mgrouper->geticd9_array();
        $data["icd9"] = $icd9;
        $data["i9"] = $this->Mgrouper->geticd9_inap($no_reg,$icd9);
        $data["icd10"] = $this->Mgrouper->geticd10_array();
        $data["dokter"] = $this->Mgrouper->getdokter();
        $this->load->view('template',$data);
    }
    function simpan_icd10(){
        $this->Mgrouper->simpan_icd10();
    }
    function simpan_indeks_icd10(){
        $this->Mgrouper->simpan_indeksicd10();
    }
    function edit_icd10(){
        $this->Mgrouper->edit_icd10();
    }
    function edit_indeks_icd10(){
        $this->Mgrouper->edit_indeksicd10();
    }
    function hapus_icd10(){
        $this->Mgrouper->hapus_icd10();
    }
    function hapus_indeks_icd10(){
        $this->Mgrouper->hapus_indeksicd10();
    }
    function simpan_inap_icd10(){
        $this->Mgrouper->simpan_inap_icd10();
    }
    function edit_inap_icd10(){
        $this->Mgrouper->edit_inap_icd10();
    }
    function hapus_inap_icd10(){
        $this->Mgrouper->hapus_inap_icd10();
    }
    function simpan_icd9(){
        $this->Mgrouper->simpan_icd9();
    }
    function simpan_indeks_icd9(){
        $this->Mgrouper->simpan_indeksicd9();
    }
    function edit_icd9(){
        $this->Mgrouper->edit_icd9();
    }
    function edit_indeks_icd9(){
        $this->Mgrouper->edit_indeksicd9();
    }
    function hapus_icd9(){
        $this->Mgrouper->hapus_icd9();
    }
    function hapus_indeks_icd9(){
        $this->Mgrouper->hapus_indeksicd9();
    }
    function simpan_inap_icd9(){
        $this->Mgrouper->simpan_inap_icd9();
    }
    function edit_inap_icd9(){
        $this->Mgrouper->edit_inap_icd9();
    }
    function hapus_inap_icd9(){
        $this->Mgrouper->hapus_inap_icd9();
    }
    function edit_urut(){
        $this->Mgrouper->edit_urut();
    }
    function edit_urut_inap(){
        $this->Mgrouper->edit_urut_inap();
    }
    function edit_indeks_urut(){
        $this->Mgrouper->edit_indeks_urut();
    }
    function edit_indeks_urut_inap(){
        $this->Mgrouper->edit_indeks_urut_inap();
    }
    function geticd10(){
        echo json_encode($this->Mgrouper->geticd10());
    }
    function geticd9(){
        echo json_encode($this->Mgrouper->geticd9());
    }
    function inacbg_encrypt($data, $key) {
        $key = hex2bin($key);
        if (mb_strlen($key, "8bit") !== 32) {
            throw new Exception("Needs a 256-bit key!");
        }
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        $iv = openssl_random_pseudo_bytes($iv_size); // dengan catatan dibawah
        $encrypted = openssl_encrypt($data,"aes-256-cbc",$key,OPENSSL_RAW_DATA,$iv );
        $signature = mb_substr(hash_hmac("sha256",$encrypted,$key,true),0,10,"8bit");
        $encoded = chunk_split(base64_encode($signature.$iv.$encrypted));
        return $encoded;
    }
    function inacbg_decrypt($str, $strkey){
        $key = hex2bin($strkey);
        if (mb_strlen($key, "8bit") !== 32) {
            throw new Exception("Needs a 256-bit key!");
        }
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        $decoded = base64_decode($str);
        $signature = mb_substr($decoded,0,10,"8bit");
        $iv = mb_substr($decoded,10,$iv_size,"8bit");
        $encrypted = mb_substr($decoded,$iv_size+10,NULL,"8bit");
        $calc_signature = mb_substr(hash_hmac("sha256",$encrypted,$key,true),0,10,"8bit");
        if(!$this->inacbg_compare($signature,$calc_signature)) {
            return "SIGNATURE_NOT_MATCH"; /// signature doesn't match
        }
        $decrypted = openssl_decrypt($encrypted,"aes-256-cbc",$key,OPENSSL_RAW_DATA,$iv);
        return $decrypted;
    }
    function inacbg_compare($a, $b) {
        if (strlen($a) !== strlen($b)) return false;
        $result = 0;
        for($i = 0; $i < strlen($a); $i ++) {
            $result |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $result == 0;
    }
    function newclaim_ralan(){
        $nomor_kartu = $this->input->post("no_bpjs");
        $tanggal = $this->input->post("tanggal");
        $nomor_sep = $this->input->post("no_sep");
        $nomor_rm = $this->input->post("no_rm");
        $no_reg = $this->input->post("no_reg");
        $nama_pasien = $this->input->post("nama_pasien");
        $tgl_lahir = $this->input->post("tgl_lahir");
        $nik = "3209152808830010";
        $this->Mgrouper->updatesep_ralan($no_reg,$nomor_sep);
        $this->Mgrouper->updatetgllahir_ralan($nomor_rm,$tgl_lahir);
        $q = $this->Mgrouper->getralan_detail($nomor_rm,$no_reg);
        $method = array(
                    "method"=>"reedit_claim",
                );
        $data = array("nomor_sep" => $nomor_sep);
        $m = $this->get_eklaim($method,$data);
        $message = "edit-".$m["metadata"]["message"];
        $method = array(
                    "method"=>"delete_claim",
                );
        $data = array("nomor_sep" => $nomor_sep,"coder_nik" => $nik);
        $m = $this->get_eklaim($method,$data);
        $message .= "delete-".$m["metadata"]["message"];
        $method = array("method"=>"new_claim");
        $data = array(
            "nomor_kartu" => $nomor_kartu,
            "nomor_sep" => $nomor_sep,
            "nomor_rm" => $nomor_rm,
            "nama_pasien" => $nama_pasien,
            "tgl_lahir" => $q->tgl_lahir." 02:00:00",
            "gender" => ($q->jenis_kelamin=="L" ? "1" : "2")
        );
        $m = $this->get_eklaim($method,$data);
        $message .= "new-".$m["metadata"]["message"];
        $method = array(
                    "method"=>"set_claim_data",
                    "nomor_sep" => $nomor_sep
                );
        $diag = $this->Mgrouper->geticd10_ralan($no_reg);
        $diagnosa = $koma = "";
        foreach ($diag->result() as $value) {
            $diagnosa .= $koma.$value->kode;
            $koma = "#";
        }
        $icd9 = $this->Mgrouper->geticd9_array();
        $pro = $this->Mgrouper->geticd9_ralan($no_reg,$icd9);
        $procedure = $koma = "";
        foreach ($pro->result() as $value) {
            $procedure .= $koma.$value->kode;
            $koma = "#";
        }
        $data = array(
                "nomor_sep" => $nomor_sep,
                "nomor_kartu" => $nomor_kartu,
                "tgl_masuk" => $tanggal,
                "tgl_pulang" => $tanggal,
                "jenis_rawat" => "2",
                "kelas_rawat" => "0",
                // "adl_sub_acute" => "15",
                // "adl_chronic" => "12",
                // "icu_indikator" => "1",
                // "icu_los" => "2",
                // "ventilator_hour" => "5",
                // "upgrade_class_ind" => "1",
                // "upgrade_class_class" => "vip",
                // "upgrade_class_los" => "5",
                // "add_payment_pct" => "35",
                // "birth_weight" => "0",
                "discharge_status" => "1",
                "diagnosa" => $diagnosa,
                "procedure" => $procedure,
                "tarif_poli_eks" => "175000",
                "nama_dokter" => $q->nama_dokter,
                "kode_tarif" => "BP",
                "payor_id" => "3",
                "payor_cd" => "JKN",
                "cob_cd" => $q->kode_perusahaan,
                "coder_nik" => $nik
            );
        $data["tarif_rs"] = array(
                "prosedur_non_bedah" => str_replace(".","",$this->input->post("prosedur_non_bedah")),
                "prosedur_bedah" => str_replace(".","",$this->input->post("prosedur_bedah")),
                "konsultasi" => str_replace(".","",$this->input->post("konsultasi")),
                "tenaga_ahli" => str_replace(".","",$this->input->post("tenaga_ahli")),
                "keperawatan" => str_replace(".","",$this->input->post("keperawatan")),
                "penunjang" => str_replace(".","",$this->input->post("penunjang")),
                "radiologi" => str_replace(".","",$this->input->post("radiologi")),
                "laboratorium" => str_replace(".","",$this->input->post("laboratorium")),
                "pelayanan_darah" => str_replace(".","",$this->input->post("pelayanan_darah")),
                "rehabilitasi" => str_replace(".","",$this->input->post("rehabilitasi")),
                "kamar" => str_replace(".","",$this->input->post("kamar")),
                "rawat_intensif" => str_replace(".","",$this->input->post("rawat_intensif")),
                "obat" => str_replace(".","",$this->input->post("obat")),
                "obat_kronis" => str_replace(".","",$this->input->post("obat_kronis")),
                "obat_kemoterapi" => str_replace(".","",$this->input->post("obat_kemoterapi")),
                "alkes" => str_replace(".","",$this->input->post("alkes")),
                "bmhp" => str_replace(".","",$this->input->post("bmhp")),
                "sewa_alat" => str_replace(".","",$this->input->post("sewa_alat"))
        );
        $m = $this->get_eklaim($method,$data);
        $message .= "set-".$m["metadata"]["message"];
        $method = array(
                    "method"=>"grouper",
                    "stage" => 1
                );
        $data = array("nomor_sep" => $nomor_sep);
        $msg = $this->get_eklaim($method,$data);
        $message .= "grouper1-".$msg["metadata"]["message"];
        $method = array(
                    "method"=>"grouper",
                    "stage" => 2
                );
        $data = array("nomor_sep" => $nomor_sep);
        $m = $this->get_eklaim($method,$data);
        $message .= "grouper2-".$m["metadata"]["message"];
        $method = array(
                    "method"=>"claim_final",
                );
        $data = array(
                "nomor_sep" => $nomor_sep,
                "coder_nik" => $nik
                );
        $m = $this->get_eklaim($method,$data);
        $message .= "claim_final-".$m["metadata"]["message"];
        $method = array(
                    "method"=>"send_claim_individual",
                );
        $data = array("nomor_sep" => $nomor_sep);
        $m = $this->get_eklaim($method,$data);
        $message .= "send-".$m["metadata"]["message"];
        $msg1 = $msg["response"]["cbg"];
        if (isset($msg1["code"])){
            $kode_eclaim = str_replace('"','',json_encode($msg1["code"]));
            $tarif_bpjs = str_replace('"','',json_encode($msg1["tariff"]));
            $tarif_rumahsakit = str_replace(".", "", $this->input->post("total"));
            $tarif_obat_kronis = str_replace(".", "", $this->input->post("obat_kronis"));
            $this->session->set_flashdata("message","success|".str_replace('"','',json_encode($msg1["code"]))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".str_replace('"','',json_encode($msg1["description"]))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format(str_replace('"','',json_encode($msg1["tariff"])),0,',','.'));
            $this->Mgrouper->updatepasien_ralan($no_reg,$kode_eclaim,$tarif_bpjs,$tarif_rumahsakit,$tarif_obat_kronis);
        } else {
            $this->session->set_flashdata("message","success|".$message);
        }
        redirect("grouper/viewgrouper_ralan/".$nomor_rm."/".$no_reg);
    }
    function newclaim_inap(){
        $nomor_kartu = $this->input->post("no_bpjs");
        $tanggal = $this->input->post("tanggal");
        $nomor_sep = $this->input->post("no_sep");
        $nomor_rm = $this->input->post("no_rm");
        $no_reg = $this->input->post("no_reg");
        $nama_pasien = $this->input->post("nama_pasien");
        $tgl_lahir = $this->input->post("tgl_lahir");
        $tanggal = $this->input->post("tanggal");
        $tgl_keluar = $this->input->post("tgl_keluar");
        $kode_kelas_bpjs = $this->input->post("kode_kelas_bpjs");
        $kode_kelas = $this->input->post("kode_kelas");
        $kode_ruangan = $this->input->post("kode_ruangan");
        $naik_kelas = $this->input->post("naik_kelas");
        $dpjp = $this->input->post("dpjp");
        $add_payment_pct = $this->input->post("add_payment_pct");
        $hak_kelas = $this->input->post("hak_kelas");
        $birth_weight = $this->input->post("birth_weight");
        $nik = "3209152808830010";
        $this->Mgrouper->updatepasienpct_inap($no_reg,$add_payment_pct);
        $this->Mgrouper->updatesep_inap($no_reg,$nomor_sep);
        $this->Mgrouper->updatebayi_inap($no_reg,$birth_weight);
        $this->Mgrouper->updatedpjp_inap($no_reg,$dpjp);
        $this->Mgrouper->updatehakkelas_inap($no_reg,$hak_kelas);
        $this->Mgrouper->updatetgllahir_inap($nomor_rm,$tgl_lahir);
        $q = $this->Mgrouper->getinap_detail($nomor_rm,$no_reg);
        $method = array(
                    "method"=>"reedit_claim",
                );
        $data = array("nomor_sep" => $nomor_sep);
        $m = $this->get_eklaim($method,$data);
        $message = "edit-".$m["metadata"]["message"].", ";
        $method = array(
                    "method"=>"delete_claim",
                );
        $data = array("nomor_sep" => $nomor_sep,"coder_nik" => $nik);
        $m = $this->get_eklaim($method,$data);
        $message .= "delete-".$m["metadata"]["message"].", ";
        $method = array("method"=>"new_claim");
        $data = array(
            "nomor_kartu" => $nomor_kartu,
            "nomor_sep" => $nomor_sep,
            "nomor_rm" => $nomor_rm,
            "nama_pasien" => $nama_pasien,
            "tgl_lahir" => $q->tgl_lahir." 02:00:00",
            "gender" => ($q->jenis_kelamin=="L" ? "1" : "2")
        );
        $m = $this->get_eklaim($method,$data);
        $message .= "new-".$m["metadata"]["message"].", ";
        $method = array(
                    "method"=>"set_claim_data",
                    "nomor_sep" => $nomor_sep
                );
        $diag = $this->Mgrouper->geticd10_inap($no_reg);
        $diagnosa = $koma = "";
        foreach ($diag->result() as $value) {
            $diagnosa .= $koma.$value->kode;
            $koma = "#";
        }
        $icd9 = $this->Mgrouper->geticd9_array();
        $pro = $this->Mgrouper->geticd9_inap($no_reg,$icd9);
        $procedure = $koma = "";
        foreach ($pro->result() as $value) {
            $procedure .= $koma.$value->kode;
            $koma = "#";
        }
        $icu = $icu_los = 0;
        $upgrade_class = 0;
        $upgrade_class_class = "";
        $upgrade_class_los = "";
        $n = $this->db->get_where("kasir_inap",["kode_tarif"=>"kmr","no_reg"=>$no_reg]);
        foreach ($n->result() as $key) {
            $b = explode("-", $key->kode_petugas);
            if (isset($b[1])){
                $k = $this->db->get_where("kelas",["kode_kelas"=>$b[1]])->row();
                $upgrade_class_class = $k->kode_kelas_bpjs;
                if ($k->kode_kelas_bpjs=="icu") {
                    $icu = 1;
                    $n = $this->db->get_where("kasir_inap",["kode_tarif"=>"kmr","no_reg"=>$no_reg,"kode_petugas"=>$key->kode_petugas]);
                    if ($n->num_rows()>0){
                        $r = $n->row();
                        $icu_los = $r->qty;
                    }
                }
                if ($naik_kelas=="naik") {
                    $upgrade_class = 1;
                    $n = $this->db->get_where("kasir_inap",["kode_tarif"=>"kmr","no_reg"=>$no_reg,"kode_petugas"=>$b[0]."-".$b[1]])->row();
                    $upgrade_class_los = $n->qty;
                }
            }
        }
        $this->db->select("sum(lama) as lama");
        $n = $this->db->get_where("kasir_inap",["kode_tarif"=>"P006","no_reg"=>$no_reg]);
        if ($n->num_rows()>0){
            $r = $n->row();
            $ventilator_hour = $r->lama;
        } else {
            $ventilator_hour = 0;
        }
        $data = array(
                "nomor_sep" => $nomor_sep,
                "nomor_kartu" => $nomor_kartu,
                "tgl_masuk" => date("Y-m-d",strtotime($tanggal)),
                "tgl_pulang" => date("Y-m-d",strtotime($tgl_keluar)),
                "jenis_rawat" => "1",
                "kelas_rawat" => $q->hak_kelas,
                "adl_sub_acute" => "-",
                "adl_chronic" => "-",
                "icu_indikator" => $icu,
                "icu_los" => $icu_los,
                "ventilator_hour" => $ventilator_hour,
                "upgrade_class_ind" => $upgrade_class,
                "upgrade_class_class" => $upgrade_class_class,
                "upgrade_class_los" => $upgrade_class_los,
                "add_payment_pct" => $add_payment_pct,
                "birth_weight" => $birth_weight,
                "discharge_status" => $q->id_bpjs,
                "diagnosa" => $diagnosa,
                "procedure" => $procedure,
                // "tarif_poli_eks" => "175000",
                "nama_dokter" => $q->nama_dokter,
                "kode_tarif" => "BP",
                "payor_id" => "3",
                "payor_cd" => "JKN",
                "cob_cd" => $q->kode_perusahaan,
                "coder_nik" => $nik
            );
        $data["tarif_rs"] = array(
                "prosedur_non_bedah" => str_replace(".","",$this->input->post("prosedur_non_bedah")),
                "prosedur_bedah" => str_replace(".","",$this->input->post("prosedur_bedah")),
                "konsultasi" => str_replace(".","",$this->input->post("konsultasi")),
                "tenaga_ahli" => str_replace(".","",$this->input->post("tenaga_ahli")),
                "keperawatan" => str_replace(".","",$this->input->post("keperawatan")),
                "penunjang" => str_replace(".","",$this->input->post("penunjang")),
                "radiologi" => str_replace(".","",$this->input->post("radiologi")),
                "laboratorium" => str_replace(".","",$this->input->post("laboratorium")),
                "pelayanan_darah" => str_replace(".","",$this->input->post("pelayanan_darah")),
                "rehabilitasi" => str_replace(".","",$this->input->post("rehabilitasi")),
                "kamar" => str_replace(".","",$this->input->post("kamar")),
                "rawat_intensif" => str_replace(".","",$this->input->post("rawat_intensif")),
                "obat" => str_replace(".","",$this->input->post("obat")),
                "obat_kronis" => str_replace(".","",$this->input->post("obat_kronis")),
                "obat_kemoterapi" => str_replace(".","",$this->input->post("obat_kemoterapi")),
                "alkes" => str_replace(".","",$this->input->post("alkes")),
                "bmhp" => str_replace(".","",$this->input->post("bmhp")),
                "sewa_alat" => str_replace(".","",$this->input->post("sewa_alat"))
        );
        $m = $this->get_eklaim($method,$data);
        $message .= "set-".$m["metadata"]["message"].", ";
        $method = array(
                    "method"=>"grouper",
                    "stage" => 1
                );
        $data = array("nomor_sep" => $nomor_sep);
        $msg = $this->get_eklaim($method,$data);
        $message .= "grouper1-".$msg["metadata"]["message"].", ";
        $method = array(
                    "method"=>"grouper",
                    "stage" => 2
                );
        $data = array("nomor_sep" => $nomor_sep);
        $m = $this->get_eklaim($method,$data);
        $message .= "grouper2-".$m["metadata"]["message"].", ";
        $method = array(
                    "method"=>"claim_final",
                );
        $data = array(
                "nomor_sep" => $nomor_sep,
                "coder_nik" => $nik
                );
        $m = $this->get_eklaim($method,$data);
        $message .= "claim_final-".$m["metadata"]["message"].", ";
        $method = array(
                    "method"=>"send_claim_individual",
                );
        $data = array("nomor_sep" => $nomor_sep);
        $m = $this->get_eklaim($method,$data);
        $message .= "send-".$m["metadata"]["message"];
        $msg1 = $msg["response"]["cbg"];
        if (isset($msg1["code"])){
            $kode_eclaim = str_replace('"','',json_encode($msg1["code"]));
            $tarif_bpjs = str_replace('"','',json_encode($msg1["tariff"]));
            $tarif_rumahsakit = str_replace(".", "", $this->input->post("total"));
            $tarif_obat_kronis = str_replace(".", "", $this->input->post("obat_kronis"));
            $this->session->set_flashdata("message","success|".str_replace('"','',json_encode($msg1["code"]))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".str_replace('"','',json_encode($msg1["description"]))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format(str_replace('"','',json_encode($msg1["tariff"])),0,',','.'));
            $this->Mgrouper->updatepasien_inap($no_reg,$kode_eclaim,$tarif_bpjs,$tarif_rumahsakit,$tarif_obat_kronis);
        } else {
            $this->session->set_flashdata("message","success|".$message);
        }
        redirect("grouper/viewgrouper_inap/".$nomor_rm."/".$no_reg."/".$this->input->post("backpage"));
    }
    function claimprint_ralan($nomor_sep){
        $method = array(
                    "method"=>"claim_print",
                );
        $data = array(
            "nomor_sep" => $nomor_sep,
        );
        $msg = $this->get_eklaim($method,$data);
        $pdf = base64_decode($msg["data"]);
        $this->Mgrouper->updatepdf_ralan($nomor_sep,$msg["data"]);
        // file_put_contents("klaim.pdf",$pdf);
        header("Content-type:application/pdf");
        // header("Content-Disposition:attachment;filename=klaim.pdf");
        echo $pdf;

    }
    function claimprint_inap($nomor_sep){
        $method = array(
                    "method"=>"claim_print",
                );
        $data = array(
            "nomor_sep" => $nomor_sep,
        );
        $msg = $this->get_eklaim($method,$data);
        $pdf = base64_decode($msg["data"]);
        $this->Mgrouper->updatepdf_inap($nomor_sep,$msg["data"]);
        // file_put_contents("klaim.pdf",$pdf);
        header("Content-type:application/pdf");
        // header("Content-Disposition:attachment;filename=klaim.pdf");
        echo $pdf;

    }
    function get_eklaim($method,$data){
        $eklaim = $this->Mgrouper->get_eklaim();
        $key = $eklaim->key;
        $ws_query["metadata"] = $method;
        $ws_query["data"] = $data;
        $json_request = json_encode($ws_query);
        $payload = $this->inacbg_encrypt($json_request,$key);
        $header = array("Content-Type: application/x-www-form-urlencoded");
        $url = $eklaim->url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);
        $first = strpos($response, "\n")+1;
        $last = strrpos($response, "\n")-1;
        $response = substr($response,$first,strlen($response) - $first - $last);
        $response = $this->inacbg_decrypt($response,$key);
        $msg = json_decode($response,true);
        return $msg;
        // echo $msg;
        // $pdf = base64_decode($msg["data"]);
        // file_put_contents("klaim.pdf",$pdf);
        // header("Content-type:application/pdf");
        // header("Content-Disposition:attachment;filename=klaim.pdf");
        // echo $pdf;
    }
    function viewpembayaran_inap($no_pasien,$no_reg){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="grouper";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Pembayaran Rawat Inap || RS CIREMAI";
        $data["title_header"] = "Pembayaran Rawat Inap";
        $data["content"] = "grouper/vviewpembayaran_inap";
        $data["breadcrumb"]   = "<li class='active'><strong>Pembayaran Rawat Inap</strong></li>";
        $data["row"]              = $this->Mkasir->getinap_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t1"] = $this->Mkasir->getkasir_inap($no_reg);
        $data["t2"] = $this->Mkasir->getkasir_igd($no_reg);
        $data["a1"] = $this->Mkasir->getkasir_ambulance($no_reg);
        $data["p1"] = $this->Mkasir->getkasir_penunjang($no_reg);
        $data["o1"] = $this->Mkasir->getkasir_operasi($no_reg);
        $data["o2"] = $this->Mkasir->getkasir_opr($no_reg);
        $data["l1"] = $this->Mkasir->getkasir_lab($no_reg);
        $data["r1"] = $this->Mkasir->getkasir_inap_radiologi($no_reg);
        $data["pa1"] = $this->Mkasir->getkasir_inap_pa($no_reg);
        $data["t"]  = $this->Mkasir->gettindakan_inap();
        $data["a"]  = $this->Mkasir->getambulance();
        $data["o"]  = $this->Mkasir->getoperasi();
        $data["dokter"]  = $this->Mkasir->getdokter_array();
        $data["kamar"]  = $this->Mkasir->getkamar_array();
        $data["p"]  = $this->Mkasir->getpenunjang_medis();
        $this->load->view('template',$data);
    }
    function viewpembayaran_ralan($no_pasien,$no_reg){
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data['menu']="kasir";
        $data["no_pasien"] = $no_pasien;
        $data["no_reg"] = $no_reg;
        $data["title"]        = "Pembayaran Rawat Jalan || RS CIREMAI";
        $data["title_header"] = "Pembayaran Rawat Jalan";
        $data["content"] = "grouper/vviewpembayaran_ralan";
        $data["breadcrumb"]   = "<li class='active'><strong>Pembayaran Rawat Jalan</strong></li>";
        $data["row"]              = $this->Mkasir->getralan_detail($no_pasien,$no_reg);
        $data["k"]              = $this->Mkasir->getkasir($no_reg);
        $data["k1"]              = $this->Mkasir->getkasir_radiologi($no_reg);
        $data["k2"]              = $this->Mkasir->getkasir_radiologi2($no_reg);
        $data["pa1"]              = $this->Mkasir->getkasir_pa($no_reg);
        $data["p1"]              = $this->Mkasir->getkasir_penunjang_ralan($no_reg);
        $data["q"]              = $this->Mkasir->getkasir_detail($no_reg);
        $data["t"]  = $this->Mkasir->gettindakan($no_reg);
        $data["a"]  = $this->Mkasir->getambulance();
        $data["l1"] = $this->Mkasir->getkasirralan_lab($no_reg);
        $data["l2"] = $this->Mkasir->getkasirralan_lab2($no_reg);
        $data["a1"] = $this->Mkasir->getkasir_ambulance_ralan($no_reg);
        $data["t1"]  = $this->Mkasir->gettindakan_radiologi();
        $data["p"]  = $this->Mkasir->getpenunjang_medis();
        $this->load->view('template',$data);
    }
    function ekspertisigizi_inap($no_pasien,$no_reg,$id_tindakan="",$tgl="", $pemeriksaan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["kode_tindakan"]  = $id_tindakan;
        $data["pemeriksaan"]    = $pemeriksaan;
        $data["title"]          = "Ekspertisi Gizi || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi Gizi";
        $data["tgl"]            = $tgl;
        $data["content"]        = "grouper/vformekspertisigizi_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi Gizi</strong></li>";
        $data["row"]            = $this->Mgizi->getinap_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mgizi->getekspertisiinap_detail($no_pasien,$no_reg,$id_tindakan,$tgl,$pemeriksaan);
        $data["d"]              = $this->Mgizi->getdokter_gizi();
        $data["d1"]             = $this->Mgizi->getdokter();
        $data["r"]              = $this->Mgizi->getpetugasgizi();
        $data["k"]              = $this->Mgizi->getkasir_inap($no_reg,"");
        $data["hasil_pemeriksaan"]          = $this->Mgizi->getekspertisigiziinap_detail_array($no_reg,$tgl,$pemeriksaan);
        $data["as"]              = $this->Mgizi->gethasuhan($no_reg,$tgl,$pemeriksaan);
        $data["a"]              = $this->Mgizi->getasuhan($no_reg,$tgl,$pemeriksaan);
        $this->load->view('template',$data);
    }
    function ekspertisipa_inap($no_pasien,$no_reg,$id_tindakan="",$tgl="", $pemeriksaan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["kode_tindakan"]  = $id_tindakan;
        $data["pemeriksaan"]    = $pemeriksaan;
        $data["title"]          = "Ekspertisi PA || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi PA";
        $data["tgl"]            = $tgl;
        $data["content"]        = "grouper/vformekspertisipa_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi PA</strong></li>";
        $data["row"]            = $this->Mpa->getinap_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mpa->getekspertisiinap_detail($no_pasien,$no_reg,$id_tindakan,$tgl,$pemeriksaan);
        $data["d"]              = $this->Mpa->getdokter_pa();
        $data["d1"]             = $this->Mpa->getdokter();
        $data["r"]              = $this->Mpa->getpetugaspa();
        $data["k"]              = $this->Mpa->getkasir_inap($no_reg,"");
        $this->load->view('template',$data);
    }
    function ekspertisilab_inap($no_pasien,$no_reg,$tanggal="",$pemeriksaan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["tgl"]            = $tanggal;
        $data["pemeriksaan"]    = $pemeriksaan;
        $data["title"]          = "Ekspertisi Lab || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi Lab";
        $data["content"]        = "grouper/vformekspertisilab_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi Lab</strong></li>";
        $data["row"]            = $this->Mlab->getinap_detail1($no_pasien,$no_reg,$tanggal,$pemeriksaan);
        $data["q"]              = $this->Mlab->getekspertisiinap_detail($no_reg);
        $data["d"]              = $this->Mlab->getdokter_lab();
        $data["r"]              = $this->Mlab->getanalys();
        $data["k"]              = $this->Mlab->getlabinap_normal($no_reg,$tanggal,$pemeriksaan);
        $data["hasil"]          = $this->Mlab->getekspertisilabinap_detail_array($no_reg,$tanggal,$pemeriksaan);
        $data["x"]              = $this->Mlab->getekspertisilabinap_detail($no_reg,$tanggal,$pemeriksaan);
        $data["ks"]             = $this->Mlab->getkasir_inap_ekspertisi($no_reg);
        $this->load->view('template',$data);
    }
    function ekspertisiradiologi_inap($no_pasien,$no_reg,$id_tindakan="",$tgl="",$pemeriksaan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["id_tindakan"]    = $id_tindakan;
        $data["pemeriksaan"]    = $pemeriksaan;
        $data["title"]          = "Ekspertisi Radiologi || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi Radiologi";
        $data["tgl"]            = $tgl;
        $data["content"]        = "grouper/vformekspertisiradiologi_inap";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi Radiologi</strong></li>";
        $data["row"]            = $this->Mradiologi->getinap_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mradiologi->getekspertisiinap_detail($no_pasien,$no_reg,$id_tindakan,$tgl,$pemeriksaan);
        $data["d"]              = $this->Mradiologi->getdokter_radiologi();
        $data["d1"]             = $this->Mradiologi->getdokter();
        $data["r"]              = $this->Mradiologi->getradiografer();
        $data["k"]              = $this->Mradiologi->getkasir_inap($no_reg,"");
        $this->load->view('template',$data);
    }
    function apotek_ralan($no_pasien,$no_reg){
        $data["vmenu"]                      = $this->session->userdata("controller")."/vmenu";
        $data['menu']                       = "ralan";
        $data["no_pasien"]                  = $no_pasien;
        $data["no_reg"]                     = $no_reg;
        $data["title"]                      = "Apotek Rawat Jalan || RS CIREMAI";
        $data["title_header"]               = "Apotek Rawat Jalan";
        $data["content"]                    = "grouper/vviewapotek_ralan";
        $data["breadcrumb"]                 = "<li class='active'><strong>Apotek Rawat Jalan</strong></li>";
        $data["row"]                        = $this->Mapotek->getralan_detail($no_pasien,$no_reg);
        $data["k"]                          = $this->Mapotek->getapotek($no_reg);
        $data["q"]                          = $this->Mapotek->getapotek_detail($no_reg);
        $data["t"]                          = $this->Mapotek->getobat();
        $this->load->view('template',$data);
    }
    function apotek_inap($no_pasien,$no_reg){
        $data["vmenu"]                      = $this->session->userdata("controller")."/vmenu";
        $data['menu']                       = "ralan";
        $data["no_pasien"]                  = $no_pasien;
        $data["no_reg"]                     = $no_reg;
        $data["title"]                      = "Apotek Rawat Inap || RS CIREMAI";
        $data["title_header"]               = "Apotek Rawat Inap";
        $data["content"]                    = "grouper/vviewapotek_inap";
        $data["breadcrumb"]                 = "<li class='active'><strong>Apotek Rawat Inap</strong></li>";
        $data["row"]                        = $this->Mapotek->getinap_detail($no_pasien,$no_reg);
        $data["k"]                          = $this->Mapotek->getapotek_inap($no_reg);
        $data["q"]                          = $this->Mapotek->getapotek_detail($no_reg);
        $data["t"]                          = $this->Mapotek->getobat();
        $this->load->view('template',$data);
    }
    function ekspertisiradiologi_ralan($no_pasien,$no_reg,$id_tindakan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["id_tindakan"]    = $id_tindakan;
        $data["title"]          = "Ekspertisi Radiologi Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi Radiologi Rawat Jalan";
        $data["content"]        = "grouper/vformekspertisiradiologi_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi Radiologi Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mradiologi->getralan_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mradiologi->getekspertisi_detail($no_pasien,$no_reg,$id_tindakan);
        $data["d"]              = $this->Mradiologi->getdokter_radiologi();
        $data["d1"]             = $this->Mradiologi->getdokter();
        $data["r"]              = $this->Mradiologi->getradiografer();
        $data["k2"]             = $this->Mradiologi->getkasir_detail($no_reg,$id_tindakan);
        $data["k"]              = $this->Mradiologi->getkasir($no_reg);
        $this->load->view('template',$data);
    }
    function ekspertisilab_ralan($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Ekspertisi Lab Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi Lab Rawat Jalan";
        $data["content"]        = "pendaftaran/vformekspertisilab_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi Lab Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mlab->getralan_detail1($no_pasien,$no_reg);
        $data["q"]              = $this->Mlab->getekspertisi_detail($no_reg);
        $data["d"]              = $this->Mlab->getdokter_lab();
        $data["r"]              = $this->Mlab->getanalys();
        $data["k"]              = $this->Mlab->getlab_normal($no_reg);
        $data["hasil"]          = $this->Mlab->getekspertisilab_detail_array($no_reg);
        $data["x"]              = $this->Mlab->getekspertisilab_detail($no_reg);
        $this->load->view('template',$data);
    }
    function ekspertisipa_ralan($no_pasien,$no_reg,$kode_tindakan=""){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["kode_tindakan"]  = $kode_tindakan;
        $data["title"]          = "Ekspertisi PA Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Ekspertisi PA Rawat Jalan";
        $data["content"]        = "pendaftaran/vformekspertisipa_ralan";
        $data["breadcrumb"]     = "<li class='active'><strong>Ekspertisi PA Rawat Jalan</strong></li>";
        $data["row"]            = $this->Mpa->getralan_detail($no_pasien,$no_reg);
        $data["q"]              = $this->Mpa->getekspertisi_detail($no_pasien,$no_reg,$kode_tindakan);
        $data["d"]              = $this->Mpa->getdokter_pa();
        $data["d1"]             = $this->Mpa->getdokter();
        $data["r"]              = $this->Mpa->getpetugaspa();
        $data["k2"]             = $this->Mpa->getkasir_detail($no_reg,$kode_tindakan);
        $data["k"]              = $this->Mpa->getkasir($no_reg);
        $this->load->view('template',$data);
    }
    function ekspertisigizi_ralan($no_pasien,$no_reg,$kode_tindakan=""){
        $data["vmenu"]                      = $this->session->userdata("controller")."/vmenu";
        $data['menu']                       = "grouper";
        $data["no_pasien"]                  = $no_pasien;
        $data["no_reg"]                     = $no_reg;
        $data["kode_tindakan"]              = $kode_tindakan;
        $data["title"]                      = "Ekspertisi Gizi || RS CIREMAI";
        $data["title_header"]               = "Ekspertisi Gizi";
        $data["content"]                    = "pendaftaran/vformekspertisigizi_ralan";
        $data["breadcrumb"]                 = "<li class='active'><strong>Ekspertisi Gizi</strong></li>";
        $data["row"]                        = $this->Mgizi->getralan_detail($no_pasien,$no_reg);
        $data["q"]                          = $this->Mgizi->getekspertisi_detail($no_pasien,$no_reg,$kode_tindakan);
        $data["d"]                          = $this->Mgizi->getdokter_gizi();
        $data["d1"]                         = $this->Mgizi->getdokter();
        $data["r"]                          = $this->Mgizi->getpetugasgizi();
        $data["k2"]                         = $this->Mgizi->getkasir_detail($no_reg,$kode_tindakan);
        $data["k"]                          = $this->Mgizi->getkasir($no_reg);
        $data["hasil_pemeriksaan"]          = $this->Mgizi->getekspertisigizi_detail_array($no_reg,$kode_tindakan);
        $data["a"]                          = $this->Mgizi->getasuhan_ralan($no_reg,$kode_tindakan);
        $this->load->view('template',$data);
    }
    function formuploadpdf_ralan($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Upload PDF Rawat Jalan || RS CIREMAI";
        $data["title_header"]   = "Upload PDF Rawat Jalan";
        $data["content"]        = "grouper/vformuploadpdf_ralan";
        $data["q"]              = $this->Mgrouper->getfilepdf_ralan($no_reg);
        $data["q1"]              = $this->Mgrouper->getfilepdf_noregsebelumnya_ralan($no_reg);
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
            redirect("grouper/formuploadpdf_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
        else
        {
            $data = array(
                            'upload_data' => $this->upload->data('file_name'),
                        );
            $nama_file =  $data['upload_data'];
            $message = $this->Mgrouper->uploadpdf_ralan($nama_file);
            $this->session->set_flashdata("message",$message);
            redirect("grouper/formuploadpdf_ralan/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
    }
    function formuploadpdf_inap($no_pasien,$no_reg){
        $data["vmenu"]          = $this->session->userdata("controller")."/vmenu";
        $data['menu']           = "grouper";
        $data["no_pasien"]      = $no_pasien;
        $data["no_reg"]         = $no_reg;
        $data["title"]          = "Upload PDF Rawat Inap || RS CIREMAI";
        $data["title_header"]   = "Upload PDF Rawat Inap";
        $data["content"]        = "grouper/vformuploadpdf_inap";
        $data["q"]              = $this->Mgrouper->getfilepdf_inap($no_reg);
        $data["breadcrumb"]     = "<li class='active'><strong>Upload PDF Rawat Inap</strong></li>";
        $data["j"]              = $this->Mlab->getjenisfile();
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
            redirect("grouper/formuploadpdf_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
        else
        {
            $data = array(
                            'upload_data' => $this->upload->data('file_name'),
                        );
            $nama_file =  $data['upload_data'];
            $message = $this->Mgrouper->uploadpdf_inap($nama_file);
            $this->session->set_flashdata("message",$message);
            redirect("grouper/formuploadpdf_inap/".$this->input->post("no_pasien")."/".$this->input->post("no_reg"));
        }
    }
    function cetak_mata($kode=""){
        $data["kode"]               = $kode;
        $data["q"]                  = $this->Moka->getlaporan_mataoka($kode);
        $this->load->view('oka/vcetak_mata',$data);
    }
    function cetak_operasi($kode=""){
        $data["q"] = $this->Moka->getcetakoka($kode);
        $this->load->view("oka/vcetak_oka",$data);
    }
    function rekap_ralan(){
        $q = $this->Mgrouper->rekap_ralan();
        echo json_encode($q);
    }
    function cetak_rekap_ralan($tgl1,$tgl2){
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Mgrouper->cetak_rekap_ralan($tgl1,$tgl2);
        $this->load->view('grouper/vcetak_rekap_ralan',$data);
    }
    function rekap_inap(){
        $q = $this->Mgrouper->rekap_inap();
        echo json_encode($q);
    }
    function cetak_rekap_inap($tgl1,$tgl2,$resume){
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Mgrouper->cetak_rekap_inap($tgl1,$tgl2,$resume);
        $this->load->view('grouper/vcetak_rekap_inap',$data);
    }
    function cekgrouper(){
        $this->db->select("no_reg,no_reg_sebelumnya,tarif_rumahsakit");
        $this->db->where("no_reg_sebelumnya!=","");
        $this->db->where("date(tanggal)>=","2020-04-01");
        $this->db->where("date(tanggal)<=","2020-04-30");
        $q = $this->db->get("pasien_ralan");
        $data = array();
        $total = 0;
        foreach($q->result() as $row){
            $this->db->select("k.no_reg,sum(k.jumlah) as jumlah");
            $h = $this->db->get_where("kasir k",["k.no_reg"=>$row->no_reg_sebelumnya]);
            foreach ($h->result() as $hrow){
                $total +=  $hrow->jumlah;
            }
            $this->db->select("k.no_reg,sum(k.jumlah) as jumlah");
            $h = $this->db->get_where("kasir k",["k.no_reg"=>$row->no_reg]);
            foreach ($h->result() as $hrow){
                $total +=  $hrow->jumlah;
            }
            $data[$row->no_reg_sebelumnya] = array(
                "jumlah" => $total,
                "tarif_rumahsakit" =>$row->tarif_rumahsakit
            );
        }
        echo json_encode($data);
    }
    function rekaplupis(){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Rekap Lupis &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "grouper/vrekaplupis";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="grouper";
        $data["title_header"] = "Rekap Lupis";
        $data["breadcrumb"] = "<li class='active'><strong>Rekap Lupis</strong></li>";
        $this->load->view('template',$data);
    }
    function getrekaplupis(){
        $q = $this->Mgrouper->getrekaplupis();
        echo json_encode($q);
    }
    function getrekaplupis_inap(){
        $q = $this->Mgrouper->getrekaplupis_inap();
        echo json_encode($q);
    }
    function cetak_rekaplupis($tgl1,$tgl2){
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Mgrouper->cetak_rekaplupis($tgl1,$tgl2);
        $this->load->view('grouper/vcetakrekaplupis',$data);
    }
    function rekapobatkronis(){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Rekap Obat Kronis&nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "grouper/vrekapobatkronis";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="grouper";
        $data["title_header"] = "Rekap Obat Kronis";
        $data["breadcrumb"] = "<li class='active'><strong>Rekap Obat Kronis</strong></li>";
        $this->load->view('template',$data);
    }
    function getrekapobatkronis(){
        $q = $this->Mgrouper->getrekapobatkronis();
        echo json_encode($q);
    }
    function cetak_rekapobatkronis($tgl1,$tgl2){
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;
        $data["q"] = $this->Mgrouper->cetak_rekapobatkronis($tgl1,$tgl2);
        $this->load->view('grouper/vcetakrekapobatkronis',$data);
    }
    function rekap_klaim(){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Rekap Klaim &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "grouper/vrekap_klaim";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="grouper";
        $data["title_header"] = "Rekap Klaim";
        $data["rk"] = $this->Mgrouper->rekap_klaim();
        $data["breadcrumb"] = "<li class='active'><strong>Rekap Klaim</strong></li>";
        $this->load->view('template',$data);
    }
    function viewfile(){
      $contents= file($this->input->post("files"));
      $kolom = 0;
      $html = "<table class='table table-striped'>";
      foreach ($contents as $key => $value) {
        $isi = explode("\t",$value);
        $html .= "<tr ".($key<=0 ? "class='bg-navy'" : "").">";
        foreach ($isi as $key1 => $value1) {
          $html .= "<td>".$value1."</td>";
        }
        $kolom++;
        $html .= "</tr>";
      }
      $html .= "<tr class='bg-navy'>";
      $html .= "<th colspan='".$kolom."'>Ada ".($key)." berkas</th>";
      $html .= "</tr>";
      $html .= "</table>";
      echo $html;
    }
    function simpanfile(){
      $contents= file($this->input->post("files"));
      $kolom = 0;
      $header = array();
      foreach ($contents as $key => $value) {
        if ($key>0) break;
        $isi = explode("\t",$value);
        foreach ($isi as $key1 => $value1) {
          $header[$key1] =  $value1;
        }
      }
      $query = "";
      foreach ($contents as $key => $value) {
        if ($key>0){
          $isi = explode("\t",$value);
          $query = "insert into rekap_klaim set ";
          $koma = "";
          foreach ($isi as $key1 => $value1) {
            if (strpos($header[$key1], 'DATE') !== false) {
              $value1 = substr($value1,6,4)."-".substr($value1,3,2)."-".substr($value1,0,2);
            }
            if (strpos($header[$key1], 'KEMO') !== false) {
              $value1 = preg_replace('/\s+/', '', $value1);
            }
            $query .= $koma." ".$header[$key1]." = '".$value1."'";
            $koma = ",";
          }
          $this->db->query($query);
        }
      }
    }
    function getrk_detail($no_rm=""){
        $this->db->select("ADMISSION_DATE as admission_date, STATUS as status,MRN as mrn, NAMA_PASIEN as nama_pasien, MRN as no_rm, TARIF_RS as tarif_rs, TARIF_INACBG as tarif_bpjs,STATUS as status");
        $this->db->where("month(ADMISSION_DATE)",$this->input->post("bln"));
        $q = $this->db->get("rekap_klaim");
        $html = "<table class='table table-hover table-bordered'>";
        $html .= "<tr class='bg-navy'>";
        $html .= "<th class='text-center'>No. RM</th>";
        $html .= "<th class='text-center'>Nama Pasien</th>";
        $html .= "<th class='text-center'>Tarif RS</th>";
        $html .= "<th class='text-center'>Tarif BPJS</th>";
        $html .= "<th class='text-center'>Status</th>";
        $html .= "<tr>";
        foreach($q->result() as $row){
          if ($no_rm!=""){
            if ($no_rm==$row->no_rm){
              $html .= "<tr>";
              $html .= "<td class='text-center'>".$row->no_rm."</td>";
              $html .= "<td>".$row->nama_pasien."</td>";
              $html .= "<td class='text-right'>".number_format($row->tarif_rs,0,',','.')."</td>";
              $html .= "<td class='text-right'>".number_format($row->tarif_bpjs,0,',','.')."</td>";
              $html .= "<td class='text-center' width='130px'><a href='#' class='dataChange' mrn='".$row->mrn."' admission_date='".$row->admission_date."' status='".$row->status."'><div class='label label-".($row->status=="diterima" ? "success" : ($row->status=="ditolak" ? "danger" : "warning"))."'>".strtoupper($row->status)."</div></a></td>";
              $html .= "<tr>";
            }
          } else {
            $html .= "<tr>";
            $html .= "<td class='text-center'>".$row->no_rm."</td>";
            $html .= "<td>".$row->nama_pasien."</td>";
            $html .= "<td class='text-right'>".number_format($row->tarif_rs,0,',','.')."</td>";
            $html .= "<td class='text-right'>".number_format($row->tarif_bpjs,0,',','.')."</td>";
            $html .= "<td class='text-center' width='130px'><a href='#' class='dataChange' mrn='".$row->mrn."' admission_date='".$row->admission_date."' status='".$row->status."'><div class='label label-".($row->status=="diterima" ? "success" : ($row->status=="ditolak" ? "danger" : "warning"))."'>".strtoupper($row->status)."</div></a></td>";
            $html .= "<tr>";
          }
        }
        $html .= "</table>";
        echo $html;
    }
    function ubahrk(){
      $this->db->where("MRN",$this->input->post("mrn"));
      $this->db->where("ADMISSION_DATE",$this->input->post("admission_date"));
      $this->db->update("rekap_klaim",["STATUS"=>$this->input->post("value")]);
    }
    function caripasien(){
      $cari = $this->input->post("cari");
      if ($cari!="") {
        $this->db->like("MRN",$cari);
        $this->db->or_like("NAMA_PASIEN",$cari);
      }
      $q = $this->db->get("rekap_klaim");
      if ($q->num_rows()>0){
        $row = $q->row();
        echo $row->MRN;
      } else{
        echo "kosong";
      }
    }
}
?>
