<?php
class Mretensi extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function pilihtindakan($kode=""){
    	if ($kode!="") $this->db->like("kode",$kode);
    	return $this->db->get("master_icd9");
    }
    function getretensi_detail($no_rm,$no_retensi){
        
        $this->db->select("r.*,d1.nama as nama_diagnosa1,d2.nama as nama_diagnosa2,d3.nama as nama_diagnosa3,t1.keterangan as nama_tindakan1,t2.keterangan as nama_tindakan2,t3.keterangan as nama_tindakan3");
        $this->db->join("master_icd d1","d1.kode=r.diagnosa1","left");
        $this->db->join("master_icd d2","d2.kode=r.diagnosa2","left");
        $this->db->join("master_icd d3","d3.kode=r.diagnosa3","left");
        $this->db->join("master_icd9 t1","t1.kode=r.tindakan1","left");
        $this->db->join("master_icd9 t2","t2.kode=r.tindakan2","left");
        $this->db->join("master_icd9 t3","t3.kode=r.tindakan3","left");
        $this->db->where("r.no_pasien",$no_rm);
        $this->db->where("r.no_retensi",$no_retensi);
        $q = $this->db->get("retensi_pasien r");
        return $q->row();
    }
    function simpanretensi($action){
        $this->db->where("no_pasien",$this->input->post("no_rm"));
        $q = $this->db->get("pasien")->row();
        switch ($action) {
            case 'simpan':
                $data = array(
                            "no_pasien"         => $q->no_pasien,
                            "id_pasien"         => $q->id_pasien,
                            "id_puskesmas"      => $q->id_puskesmas,
                            "nama_pasien"       => $q->nama_pasien,
                            "agama"             => $q->agama,
                            "nama_pasangan"     => $q->nama_pasangan,
                            "status_kawin"      => $q->status_kawin,
                            "no_bpjs"           => $q->no_bpjs,
                            "nip"               => $q->nip,
                            "alamat"            => $q->alamat,
                            "id_kelurahan"      => $q->id_kelurahan,
                            "id_kecamatan"      => $q->id_kecamatan,
                            "id_kota"           => $q->id_kota,
                            "id_provinsi"       => $q->id_provinsi,
                            "pendidikan"        => $q->pendidikan,
                            "perusahaan"        => $q->perusahaan,
                            "hubungan_keluarga" => $q->hubungan_keluarga,
                            "jenis_kelamin"     => $q->jenis_kelamin,
                            "status_pembayaran" => $q->status_pembayaran,
                            "iskk"              => $q->iskk,
                            "pekerjaan"         => $q->pekerjaan,
                            "tanggal"           => $q->tanggal,
                            "tahun_lahir"       => $q->tahun_lahir,
                            "tgl_lahir"         => $q->tgl_lahir,
                            "umur"              => $q->umur,
                            "nip_user"          => $q->nip_user,
                            "telpon"            => $q->telpon,
                            "id_gol"            => $q->id_gol,
                            "id_pangkat"        => $q->id_pangkat,
                            "id_kesatuan"       => $q->id_kesatuan,
                            "id_cabang"         => $q->id_cabang,
                            "id_ketcabang"      => $q->id_ketcabang,
                            "negara"            => $q->negara,
                            "suku"              => $q->suku,
                            "ktp"               => $q->ktp,
                            "berat_badan"       => $q->berat_badan,
                            "panjang_badan"     => $q->panjang_badan,
                            "kelahiran_ke"      => $q->kelahiran_ke,
                            "tindakan_bayi"     => $q->tindakan_bayi,
                            "kembar"            => $q->kembar,
                            "kelainan_bawaan"   => $q->kelainan_bawaan,
                            "lingkar_kepala"    => $q->lingkar_kepala,
                            "lingkar_dada"      => $q->lingkar_dada,
                            "lingkar_lengan"    => $q->lingkar_lengan,
                            "gol"               => $q->gol,
                            "terakhir_berobat"  => date("Y-m-d",strtotime($this->input->post("terakhir_berobat"))),
                            "alergi"            => $this->input->post("alergi"),
                            "dokter_retensi"    => $this->input->post("dokter_retensi"),
                            "keterangan_retensi"=> $this->input->post("keterangan_retensi"),
                            "tanggal_retensi"   => date("Y-m-d"), 
                            "diagnosa1"         => $this->input->post("diagnosa1"),
                            "diagnosa2"         => $this->input->post("diagnosa2"),
                            "diagnosa3"         => $this->input->post("diagnosa3"),
                            "tindakan1"         => $this->input->post("tindakan1"),
                            "tindakan2"         => $this->input->post("tindakan2"),
                            "tindakan3"         => $this->input->post("tindakan3"),
                            "pelayanan_retensi" => $this->input->post("pelayanan_retensi"),
                            "no_retensi"        => date("dmYHos"),
                        );
                $this->db->insert("retensi_pasien",$data);

                $this->db->where("no_pasien",$this->input->post("no_rm"));
                $this->db->delete("pasien");
                return "success-Data berhasil disimpan";
                break;
            case 'edit':
                $data = array(
                            "terakhir_berobat"  => date("Y-m-d",strtotime($this->input->post("terakhir_berobat"))),
                            "alergi"            => $this->input->post("alergi"),
                            "dokter_retensi"    => $this->input->post("dokter_retensi"),
                            "keterangan_retensi"=> $this->input->post("keterangan_retensi"),
                            "tanggal_retensi"   => date("Y-m-d"), 
                            "diagnosa1"         => $this->input->post("diagnosa1"),
                            "diagnosa2"         => $this->input->post("diagnosa2"),
                            "diagnosa3"         => $this->input->post("diagnosa3"),
                            "tindakan1"         => $this->input->post("tindakan1"),
                            "tindakan2"         => $this->input->post("tindakan2"),
                            "tindakan3"         => $this->input->post("tindakan3"),
                            "pelayanan_retensi" => $this->input->post("pelayanan_retensi"),
                        );
                $this->db->where("no_pasien",$this->input->post("no_rm"));
                $this->db->where("no_retensi",$this->input->post("no_retensi"));
                $this->db->update("retensi_pasien",$data);
                return "info-Data berhasil diedit";
                break;
        }
    }
    function getjumlahpasien_retensi(){
        $this->db->like("nama_pasien",$this->session->flashdata("no_pasien"));
        $this->db->or_like("no_pasien",$this->session->flashdata("no_pasien"));
        $this->db->or_like("no_bpjs",$this->session->flashdata("no_pasien"));
        $query = $this->db->get("retensi_pasien");
        return $query->num_rows();
    }
    function getpasien_retensi($page,$offset){
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        if ($this->session->flashdata("no_pasien")!=""){
            $no_pasien = "000000".$this->session->flashdata("no_pasien");
            $this->db->where("no_pasien",substr($no_pasien,-6));
            $this->db->or_like("nama_pasien",$this->session->flashdata("no_pasien"));
            $this->db->or_like("no_bpjs",$this->session->flashdata("no_pasien"));
        }
        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("date(retensi_pasien.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(retensi_pasien.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        }
        $this->db->order_by("no_pasien");
        $query = $this->db->get("retensi_pasien",$page,$offset);
        return $query;
    }
    function getdokter(){
        return $this->db->get("dokter");
    }
    function getdiagnosa(){
        $this->db->like("kode",$this->input->post("kode"));
        $this->db->or_like("nama",$this->input->post("kode"));
        $q = $this->db->get("master_icd");
        $data = array();
        foreach ($q->result() as $key => $value) {
            $data[] = array('kode' => $value->kode,'nama' => $value->nama);
        }
        return $data;
    }
    function tindakan(){
        $this->db->like("kode",$this->input->post("kode"));
        $this->db->or_like("keterangan",$this->input->post("kode"));
        $q = $this->db->get("master_icd9");
        $data = array();
        foreach ($q->result() as $key => $value) {
            $data[] = array('kode' => $value->kode,'nama' => $value->keterangan);
        }
        return $data;
    }
    function namadiagnosa(){
        $q = $this->db->get_where("master_icd",["kode"=>$this->input->post("kode")]);
        if ($q->num_rows()>0) return $q->row()->nama; else return "-";
    }
    function namatindakan(){
        $q = $this->db->get_where("master_icd9",["kode"=>$this->input->post("kode")]);
        if ($q->num_rows()>0) return $q->row()->keterangan; else return "-";
    }
    function cekpasien($no_rm){
        $this->db->where("no_pasien",$no_rm);
        $q = $this->db->get("pasien");
        return $q->row();
    }
    function data_rm($no_rm,$no_retensi){
        $this->db->where("no_pasien",$no_rm);
        $this->db->where("no_retensi",$no_retensi);
        $q = $this->db->get("retensi_pasien")->row();
        $data = array(
                        "no_pasien"         => $q->no_pasien,
                        "id_pasien"         => $q->id_pasien,
                        "id_puskesmas"      => $q->id_puskesmas,
                        "nama_pasien"       => $q->nama_pasien,
                        "agama"             => $q->agama,
                        "nama_pasangan"     => $q->nama_pasangan,
                        "status_kawin"      => $q->status_kawin,
                        "no_bpjs"           => $q->no_bpjs,
                        "nip"               => $q->nip,
                        "alamat"            => $q->alamat,
                        "id_kelurahan"      => $q->id_kelurahan,
                        "id_kecamatan"      => $q->id_kecamatan,
                        "id_kota"           => $q->id_kota,
                        "id_provinsi"       => $q->id_provinsi,
                        "pendidikan"        => $q->pendidikan,
                        "perusahaan"        => $q->perusahaan,
                        "hubungan_keluarga" => $q->hubungan_keluarga,
                        "jenis_kelamin"     => $q->jenis_kelamin,
                        "status_pembayaran" => $q->status_pembayaran,
                        "iskk"              => $q->iskk,
                        "pekerjaan"         => $q->pekerjaan,
                        "tanggal"           => date("Y-m-d"),
                        "tahun_lahir"       => $q->tahun_lahir,
                        "tgl_lahir"         => $q->tgl_lahir,
                        "umur"              => $q->umur,
                        "nip_user"          => $q->nip_user,
                        "telpon"            => $q->telpon,
                        "id_gol"            => $q->id_gol,
                        "id_pangkat"        => $q->id_pangkat,
                        "id_kesatuan"       => $q->id_kesatuan,
                        "id_cabang"         => $q->id_cabang,
                        "id_ketcabang"      => $q->id_ketcabang,
                        "negara"            => $q->negara,
                        "suku"              => $q->suku,
                        "ktp"               => $q->ktp,
                        "berat_badan"       => $q->berat_badan,
                        "panjang_badan"     => $q->panjang_badan,
                        "kelahiran_ke"      => $q->kelahiran_ke,
                        "tindakan_bayi"     => $q->tindakan_bayi,
                        "kembar"            => $q->kembar,
                        "kelainan_bawaan"   => $q->kelainan_bawaan,
                        "lingkar_kepala"    => $q->lingkar_kepala,
                        "lingkar_dada"      => $q->lingkar_dada,
                        "lingkar_lengan"    => $q->lingkar_lengan,
                        "gol"               => $q->gol,
                        "alergi"            => $q->alergi
                    );
        $this->db->insert("pasien",$data);
        return "success-Data berhasil disimpan";
    }
    function ambil_data($no_rm,$no_retensi,$no_pasien){
        $this->db->where("no_pasien",$no_rm);
        $this->db->where("no_retensi",$no_retensi);
        $q = $this->db->get("retensi_pasien")->row();
        $data = array(
                        "no_pasien"         => $no_pasien,
                        "id_pasien"         => date('dmYHis'),
                        "id_puskesmas"      => $q->id_puskesmas,
                        "nama_pasien"       => $q->nama_pasien,
                        "agama"             => $q->agama,
                        "nama_pasangan"     => $q->nama_pasangan,
                        "status_kawin"      => $q->status_kawin,
                        "no_bpjs"           => $q->no_bpjs,
                        "nip"               => $q->nip,
                        "alamat"            => $q->alamat,
                        "id_kelurahan"      => $q->id_kelurahan,
                        "id_kecamatan"      => $q->id_kecamatan,
                        "id_kota"           => $q->id_kota,
                        "id_provinsi"       => $q->id_provinsi,
                        "pendidikan"        => $q->pendidikan,
                        "perusahaan"        => $q->perusahaan,
                        "hubungan_keluarga" => $q->hubungan_keluarga,
                        "jenis_kelamin"     => $q->jenis_kelamin,
                        "status_pembayaran" => $q->status_pembayaran,
                        "iskk"              => $q->iskk,
                        "pekerjaan"         => $q->pekerjaan,
                        "tanggal"           => date("Y-m-d"),
                        "tahun_lahir"       => $q->tahun_lahir,
                        "tgl_lahir"         => $q->tgl_lahir,
                        "umur"              => $q->umur,
                        "nip_user"          => $q->nip_user,
                        "telpon"            => $q->telpon,
                        "id_gol"            => $q->id_gol,
                        "id_pangkat"        => $q->id_pangkat,
                        "id_kesatuan"       => $q->id_kesatuan,
                        "id_cabang"         => $q->id_cabang,
                        "id_ketcabang"      => $q->id_ketcabang,
                        "negara"            => $q->negara,
                        "suku"              => $q->suku,
                        "ktp"               => $q->ktp,
                        "berat_badan"       => $q->berat_badan,
                        "panjang_badan"     => $q->panjang_badan,
                        "kelahiran_ke"      => $q->kelahiran_ke,
                        "tindakan_bayi"     => $q->tindakan_bayi,
                        "kembar"            => $q->kembar,
                        "kelainan_bawaan"   => $q->kelainan_bawaan,
                        "lingkar_kepala"    => $q->lingkar_kepala,
                        "lingkar_dada"      => $q->lingkar_dada,
                        "lingkar_lengan"    => $q->lingkar_lengan,
                        "gol"               => $q->gol,
                        "alergi"            => $q->alergi
                    );
        $this->db->where("no_pasien",$no_pasien);
        $q1 = $this->db->get("pasien")->row();
        if ($q1) {
            return "danger-Nomor RM duplikat";
        } else {
            $this->db->insert("pasien",$data);
            return "success-Data berhasil disimpan";
        }
    }
    function simpanupload($nama_file){
        $no_pasien = $this->input->post('no_pasien');
        $no_retensi = $this->input->post('no_retensi');
        $data = array(
                        'pdf_retensi' => $nama_file,
                        'tgl_upload' => date("Y-m-d H:i:s"),
                    );
        $this->db->where("no_pasien",$no_pasien);
        $this->db->where("no_retensi",$no_retensi);
        $this->db->update("retensi_pasien",$data);
        return "success-File berhasil diupload";
    }
    function cetakretensi($tgl1,$tgl2){
        $this->db->select("r.*,d.nama_dokter,dg.nama as nama_diagnosa,t.keterangan as nama_tindakan");
        $this->db->join("dokter d","d.id_dokter=r.dokter_retensi","left");
        $this->db->join("master_icd dg","dg.kode=r.diagnosa1","left");
        $this->db->join("master_icd9 t","t.kode=r.tindakan1","left");
        $this->db->where("date(r.tanggal_retensi)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(r.tanggal_retensi)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->order_by("r.tanggal_retensi");
        $query = $this->db->get("retensi_pasien r");
        return $query;
    }
}
?>