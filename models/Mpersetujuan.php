<?php
class Mpersetujuan extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    function cekpersetujuan($username_pasien,$password_pasien,$jenis,$pilihan){
        switch ($pilihan) {
            case 'NIK':
            $this->db->where("p.ktp",$password_pasien);
            break;
            case 'HP':
            $this->db->where("p.telpon",$password_pasien);
            break;
            case 'BPJS':
            $this->db->where("p.no_bpjs",$password_pasien);
            break;

        }
        if ($jenis=="ranap") {
            $this->db->where("no_reg",$username_pasien);
            $this->db->join("pasien p","pi.no_rm=p.no_pasien");
            $q = $this->db->get("pasien_inap pi");
        } else {
            $this->db->where("no_reg",$username_pasien);
            $this->db->join("pasien p","pi.no_pasien=p.no_pasien");
            $q = $this->db->get("pasien_ralan pi");
        }
        $row = $q->row();
        if ($q->num_rows() > 0){
            $userdata = array (
                'username_pasien'   => $username_pasien,
                'password_pasien'   => $password_pasien,
                'no_pasien'         => $row->no_pasien,
            );
            $q->free_result();
            $this->session->set_userdata($userdata);
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    function getpasien_detail(){
        $this->db->where("no_pasien",$this->session->userdata("no_pasien"));
        $q = $this->db->get("pasien");
        return $q->row();
    }
    function getpasien_detail2($no_pasien){
        $this->db->where("no_pasien",$no_pasien);
        $q = $this->db->get("pasien");
        return $q->row();
    }
    function getpasieninap_detail($no_reg){
        $this->db->select("pi.*,r.nama_ruangan,k.nama_kelas,p.nama_pasien,kmr.nama_kamar,kmr.no_bed,p.perusahaan,gol.keterangan");
        $this->db->join("ruangan r","r.kode_ruangan=pi.kode_ruangan");
        $this->db->join("kelas k","k.kode_kelas=pi.kode_kelas");
        $this->db->join("kamar kmr","kmr.kode_kamar=pi.kode_kamar");
        $this->db->join("gol_pasien gol","gol.id_gol=pi.id_gol");
        $this->db->join("pasien p","p.no_pasien=pi.no_rm");
        $this->db->where("no_reg",$no_reg);
        $q = $this->db->get("pasien_inap pi");
        return $q->row();
    }
    function getpasienralan($no_pasien)
    {
        $this->db->select("pi.*,p.nama_pasien as nama_pasien");
        $this->db->join("pasien p","p.no_pasien=pi.no_pasien","inner");
        $this->db->where("no_pasien", $no_pasien);
        $q = $this->db->get("pasien_ralan pi");
        return $q->row();
    }
    function getpersetujuan_detail($no_reg){
        $this->db->select("p.*,pr.nama as prm");
        $this->db->join("petugas_rm pr","pr.nip=p.petugas_rm","left");
        $this->db->where("no_reg",$no_reg);
        $q = $this->db->get("persetujuan p");
        return $q->row();
    }
    function getkronologis_detail($no_reg){
        $this->db->select("k.*,pr.nama as prm");
        $this->db->join("petugas_rm pr","pr.nip=k.petugas_rm","left");
        $this->db->where("no_reg",$no_reg);
        $q = $this->db->get("kronologis k");
        return $q->row();
    }
    function getpersetujuanumum_detail($no_reg){
        $this->db->select("p.*,pr.nama as prm");
        $this->db->join("petugas_rm pr","pr.nip=p.petugas_rm","left");
        $this->db->where("no_reg",$no_reg);
        $q = $this->db->get("persetujuan_umum p");
        return $q->row();
    }
    function getkronologis_ralan($no_reg){
        $this->db->select("p.*,pr.nama as prm");
        $this->db->join("petugas_rm pr","pr.nip=p.petugas_rm","left");
        $this->db->where("no_reg",$no_reg);
        $q = $this->db->get("kronologis_ralan p");
        return $q->row();
    }
    function simpanpersetujuan($aksi){
        // $prt    = (isset($this->input->post("pernyataan0")=="" ? "N" , $this->input->post("pernyataan0")));
        // $prt1   = ($this->input->post("pernyataan1")=="" ? "N" , $this->input->post("pernyataan1"));
        // $prt2   = ($this->input->post("pernyataan2")=="" ? "N" , $this->input->post("pernyataan2"));
        // $prt3   = ($this->input->post("pernyataan3")=="" ? "N" , $this->input->post("pernyataan3"));
        // $prt4   = ($this->input->post("pernyataan4")=="" ? "N" , $this->input->post("pernyataan4"));
        $pernyataan = $this->input->post("pernyataan0").",".$this->input->post("pernyataan1").",".$this->input->post("pernyataan2").",".$this->input->post("pernyataan3").",".$this->input->post("pernyataan4");
        $q = $this->db->get_where("pasien_ttd",["no_pasien"=>$this->input->post("no_pasien")]);
        if ($q->num_rows()<=0){
            $d = array(
                "no_pasien" => $this->input->post("no_pasien"),
                "ttd" => "data:image/png;base64,".$this->input->post("ttd_pernyataan"),
                "ttd2" => "data:image/png;base64,".$this->input->post("ttd_saksi")
            );
            $this->db->insert("pasien_ttd",$d);
        }
        switch ($aksi) {
            case 'simpan':
            $data = array(
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'jk'             => $this->input->post("jk"),
                'pekerjaan'      => $this->input->post("pekerjaan"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'saksi'          => $this->input->post("saksi"),
                'umur'           => $this->input->post("umur"),
                'no_reg'         => $this->input->post("no_reg"),
                'no_pasien'      => $this->input->post("no_pasien"),
                'pernyataan'     => $pernyataan,
                'ttd_saksi'      =>"data:image/png;base64,".$this->input->post("ttd_saksi"),
                'ttd_pernyataan' =>"data:image/png;base64,".$this->input->post("ttd_pernyataan"),
            );
            $this->db->insert("persetujuan",$data);
            return "success-Data berhasil disimpan";
            break;
            case 'edit':
            $data = array(
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'jk'             => $this->input->post("jk"),
                'pekerjaan'      => $this->input->post("pekerjaan"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'saksi'          => $this->input->post("saksi"),
                'umur'           => $this->input->post("umur"),
                'ttd_saksi'      =>"data:image/png;base64,".$this->input->post("ttd_saksi"),
                'ttd_pernyataan' =>"data:image/png;base64,".$this->input->post("ttd_pernyataan"),
                'pernyataan'     => $pernyataan,
            );
            $this->db->where("no_reg",$this->input->post("no_reg"));
            $this->db->update("persetujuan",$data);
            return "info-Data berhasil diubah";
            break;

        }
    }
    function simpankronologis($aksi){
        $q = $this->db->get_where("ttd_pasienkronologis",["no_pasien"=>$this->input->post("no_rm"),"no_reg"=>$this->input->post("no_reg")]);
        if ($q->num_rows()<=0){
            $d = array(
                "no_pasien" => $this->input->post("no_rm"),
                'no_reg'         => $this->input->post("no_reg"),
                "ttd" => $this->input->post("ttd_pernyataan"),
                "ttd2" => $this->input->post("ttd_saksi"),
                "ttd3" => $this->input->post("ttd_petugasrm")
            );
            $this->db->insert("ttd_pasienkronologis",$d);
        }
        switch ($aksi) {
            case 'simpan':
            $data = array(
                'id'             => date("dmYHis"),
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'telpon'         => $this->input->post("telpon"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'hari'           => $this->input->post("hari"),
                'tanggal'        => date("Y-m-d",strtotime($this->input->post("tanggal"))),
                'waktu'          => $this->input->post("waktu"),
                'lokasi'         => $this->input->post("lokasi"),
                'kronologis'     => $this->input->post("kronologis"),
                'no_reg'         => $this->input->post("no_reg"),
                'no_pasien'      => $this->input->post("no_rm")
            );
            $this->db->insert("kronologis",$data);
            return "success-Data berhasil disimpan";
            break;
            case 'edit':
            $data = array(
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'telpon'         => $this->input->post("telpon"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'hari'           => $this->input->post("hari"),
                'tanggal'        => date("Y-m-d",strtotime($this->input->post("tanggal"))),
                'waktu'          => $this->input->post("waktu"),
                'lokasi'         => $this->input->post("lokasi"),
                'kronologis'     => $this->input->post("kronologis")
            );
            $this->db->where("no_reg",$this->input->post("no_reg"));
            $this->db->update("kronologis",$data);
            return "info-Data berhasil diubah";
            break;

        }
    }
    function simpankronologis_ralan($aksi){
        $q = $this->db->get_where("ttd_pasienkronologis",["no_pasien"=>$this->input->post("no_rm"),"no_reg"=>$this->input->post("no_reg")]);
        if ($q->num_rows()<=0){
            $d = array(
                "no_pasien" => $this->input->post("no_rm"),
                'no_reg'         => $this->input->post("no_reg"),
                "ttd" => $this->input->post("ttd_pernyataan"),
                "ttd2" => $this->input->post("ttd_saksi"),
                "ttd3" => $this->input->post("ttd_petugasrm")
            );
            $this->db->insert("ttd_pasienkronologis",$d);
        }
        switch ($aksi) {
            case 'simpan':
            $data = array(
                'id'             => date("dmYHis"),
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'telpon'         => $this->input->post("telpon"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'hari'           => $this->input->post("hari"),
                'tanggal'        => date("Y-m-d",strtotime($this->input->post("tanggal"))),
                'waktu'          => $this->input->post("waktu"),
                'lokasi'         => $this->input->post("lokasi"),
                'kronologis'     => $this->input->post("kronologis"),
                'no_reg'         => $this->input->post("no_reg"),
                'no_pasien'      => $this->input->post("no_rm")
            );
            $this->db->insert("kronologis",$data);
            return "success-Data berhasil disimpan";
            break;
            case 'edit':
            $data = array(
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'telpon'         => $this->input->post("telpon"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'hari'           => $this->input->post("hari"),
                'tanggal'        => date("Y-m-d",strtotime($this->input->post("tanggal"))),
                'waktu'          => $this->input->post("waktu"),
                'lokasi'         => $this->input->post("lokasi"),
                'kronologis'     => $this->input->post("kronologis")
            );
            $this->db->where("no_reg",$this->input->post("no_reg"));
            $this->db->update("kronologis",$data);
            return "info-Data berhasil diubah";
            break;

        }
    }
    function simpanpersetujuan_umum($aksi){
        // $prt    = (isset($this->input->post("pernyataan0")=="" ? "N" , $this->input->post("pernyataan0")));
        // $prt1   = ($this->input->post("pernyataan1")=="" ? "N" , $this->input->post("pernyataan1"));
        // $prt2   = ($this->input->post("pernyataan2")=="" ? "N" , $this->input->post("pernyataan2"));
        // $prt3   = ($this->input->post("pernyataan3")=="" ? "N" , $this->input->post("pernyataan3"));
        // $prt4   = ($this->input->post("pernyataan4")=="" ? "N" , $this->input->post("pernyataan4"));
        // $pernyataan = $this->input->post("pernyataan0").",".$this->input->post("pernyataan1").",".$this->input->post("pernyataan2").",".$this->input->post("pernyataan3").",".$this->input->post("pernyataan4");
        switch ($aksi) {
            case 'simpan':
            $data = array(
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'jk'             => $this->input->post("jk"),
                'pekerjaan'      => $this->input->post("pekerjaan"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'saksi'          => $this->input->post("saksi"),
                'tgl_lahir'      => date("Y-m-d",strtotime($this->input->post("tgl_lahir"))),
                'no_reg'         => $this->input->post("no_reg"),
                'no_pasien'      => $this->input->post("no_pasien"),
                'no_telpon'      => $this->input->post("no_telpon"),
                'pelepasan_informasi1'          => $this->input->post('pelepasan_informasi1'),
                'pelepasan_informasi2'          => $this->input->post('pelepasan_informasi2'),
                'keinginan_privasi1'          => $this->input->post('keinginan_privasi1'),
                'keinginan_privasi2'          => $this->input->post('keinginan_privasi2'),
                'ttd_saksi'      =>"data:image/png;base64,".$this->input->post("ttd_saksi"),
                'ttd_pernyataan' =>"data:image/png;base64,".$this->input->post("ttd_pernyataan"),
            );
            $this->db->insert("persetujuan_umum",$data);
            return "success-Data berhasil disimpan";
            break;
            case 'edit':
            $data = array(
                'nama'           => $this->input->post("nama"),
                'nama_pasien'    => $this->input->post("nama_pasien"),
                'jk'             => $this->input->post("jk"),
                'pekerjaan'      => $this->input->post("pekerjaan"),
                'alamat'         => $this->input->post("alamat"),
                'hubungan'       => $this->input->post("hubungan"),
                'saksi'          => $this->input->post("saksi"),
                'tgl_lahir'      => date("Y-m-d",strtotime($this->input->post("tgl_lahir"))),
                'no_telpon'      => $this->input->post("no_telpon"),
                'pelepasan_informasi1'          => $this->input->post('pelepasan_informasi1'),
                'pelepasan_informasi2'          => $this->input->post('pelepasan_informasi2'),
                'keinginan_privasi1'          => $this->input->post('keinginan_privasi1'),
                'keinginan_privasi2'          => $this->input->post('keinginan_privasi2'),
                'ttd_saksi'      =>"data:image/png;base64,".$this->input->post("ttd_saksi"),
                'ttd_pernyataan' =>"data:image/png;base64,".$this->input->post("ttd_pernyataan"),
            );
            $this->db->where("no_reg",$this->input->post("no_reg"));
            $this->db->update("persetujuan_umum",$data);
            return "info-Data berhasil diubah";
            break;

        }
    }
    function cekpetugas_rm($password){
        $this->db->where("password",md5($password));
        $q = $this->db->get("petugas_rm");
        return $q;
    }
    function cekpetugas_kronologis($password){
        $this->db->where("password",md5($password));
        $q = $this->db->get("petugas_rm");
        return $q;
    }
    function insertpetugas_rm($no_reg,$no_pasien,$nip,$tabel){
        $data = array(
            'petugas_rm' => $nip,
        );
        $this->db->where("no_reg",$no_reg);
        $this->db->where("no_pasien",$no_pasien);
        $this->db->update($tabel,$data);
        return "success-Perawat berhasil di insert";

    }
    function getttd_persetujuan($no_reg,$no_pasien){
        $this->db->select("ttd_saksi,ttd_pernyataan");
        $this->db->where("no_reg",$no_reg);
        $this->db->where("no_pasien",$no_pasien);
        $q = $this->db->get("persetujuan");
        return $q;
    }
    function getttd_persetujuan_umum($no_reg,$no_pasien){
        $this->db->select("ttd_saksi,ttd_pernyataan");
        $this->db->where("no_reg",$no_reg);
        $this->db->where("no_pasien",$no_pasien);
        $q = $this->db->get("persetujuan_umum");
        return $q;
    }
    function getttd_kronologis($no_rm,$no_reg){
        $this->db->where("no_reg",$no_reg);
        $this->db->where("no_pasien",$no_rm);
        $q = $this->db->get("ttd_pasienkronologis");
        return $q->row();
    }
    function getsetuprs(){
      $this->db->select("nip_petugas_klaim,nama_petugas_klaim,ttd_petugas_klaim");
  		$q =  $this->db->get("setup_rs");
  		return $q->row();
    }
}
?>
