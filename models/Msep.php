<?php
class Msep extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getralan_detail($no_pasien,$no_reg){
        $this->db->select("pr.*,p.telpon,p.no_bpjs,p.alamat,p.nama_pasien,pl.keterangan as poli,g.keterangan as ket_gol_pasien,g1.keterangan as ket_gol_pasien1,d.nama_dokter");
        $this->db->join("pasien p","pr.no_pasien=p.no_pasien");
        $this->db->join("poliklinik pl","pl.kode=pr.tujuan_poli");
        $this->db->join("gol_pasien g","g.id_gol=pr.gol_pasien","left");
        $this->db->join("gol_pasien g1","g1.id_gol=p.id_gol","left");
		$this->db->join("dokter d","d.id_dokter=pr.dokter_poli","left");
        $this->db->where("pr.no_pasien",$no_pasien);
        $this->db->where("pr.no_reg",$no_reg);
        $q = $this->db->get("pasien_ralan pr");
        return $q->row();
    }
	function getinap_detail($no_pasien,$no_reg){
        $this->db->select("pr.*,p.telpon,p.no_bpjs,p.alamat,p.nama_pasien,g.keterangan as ket_gol_pasien,d.nama_dokter,ru.nama_ruangan");
        $this->db->join("pasien p","pr.no_rm=p.no_pasien");
        $this->db->join("gol_pasien g","g.id_gol=pr.id_gol","left");
		$this->db->join("dokter d","d.id_dokter=pr.dpjp","left");
		$this->db->join("kamar ka","ka.kode_kamar=pr.kode_kamar","left");
		$this->db->join("ruangan ru","ru.kode_ruangan=pr.kode_ruangan","left");
        $this->db->where("pr.no_rm",$no_pasien);
        $this->db->where("pr.no_reg",$no_reg);
        $q = $this->db->get("pasien_inap pr");
        return $q->row();
    }
    function updatesep($no_reg,$nosep){
        $this->db->where("no_reg",$no_reg);
        $this->db->update("pasien_ralan",array("no_sjp"=>$nosep));
    }
	function updatesep_inap($no_reg,$nosep){
        $this->db->where("no_reg",$no_reg);
        $this->db->update("pasien_inap",array("no_sjp"=>$nosep));
    }
    function getpasien($no_rm){
        return $this->db->get_where("pasien",["no_pasien"=>$no_rm])->row();
    }
    function getdiagnosa_ralan($no_reg){
        $this->db->select("g.kode,m.nama");
        $this->db->join("master_icd m","m.kode=g.kode");
        return $this->db->get_where("grouper_ralan_icd10 g",["no_reg"=>$no_reg]);
    }
    function gettindakan_ralan($no_reg){
        $this->db->select("g.kode,m.keterangan as nama");
        $this->db->join("master_icd9 m","m.kode=g.kode");
        return $this->db->get_where("grouper_ralan_icd9 g",["no_reg"=>$no_reg]);
    }
    function getterapi_ralan($no_reg){
        $this->db->select("a.nama_obat,a.qty,a.satuan,ap.nama as aturan_pakai");
        $this->db->join("aturan_pakai ap","ap.kode=a.aturan_pakai","left");
        return $this->db->get_where("apotek a",["no_reg"=>$no_reg]);
    }
    function gettriage($no_reg){
        return $this->db->get_where("pasien_triage",["no_reg"=>$no_reg])->row();
    }
    function getkeadaan_ralan($no_reg){
        $this->db->select("keadaan_pulang,tanggal_ulangan,dokter_poli,d.nama_dokter");
        $this->db->join("dokter d","d.id_dokter=p.dokter_poli","left");
        return $this->db->get_where("pasien_ralan p",["no_reg"=>$no_reg])->row();
    }
	function getpasien_inap($no_pasien,$no_reg){
        $this->db->select("pr.*,p.telpon,p.no_bpjs,p.alamat,p.tgl_lahir,p.nama_pasien,g.keterangan as ket_gol_pasien,d.nama_dokter,ru.nama_ruangan");
        $this->db->join("pasien p","pr.no_rm=p.no_pasien");
        $this->db->join("gol_pasien g","g.id_gol=pr.id_gol","left");
		$this->db->join("dokter d","d.id_dokter=pr.dpjp","left");
		$this->db->join("kamar ka","ka.kode_kamar=pr.kode_kamar","left");
		$this->db->join("ruangan ru","ru.kode_ruangan=pr.kode_ruangan","left");
        $this->db->where("pr.no_rm",$no_pasien);
        $this->db->where("pr.no_reg",$no_reg);
        $q = $this->db->get("pasien_inap pr");
        return $q->row();
    }
    function getkeluargapasien($no_pasien,$no_reg){
      $q = $this->db->get_where("persetujuan",["no_pasien"=>$no_pasien,"no_reg"=>$no_reg]);
      return $q->row();
    }
}
?>
