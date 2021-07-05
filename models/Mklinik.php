<?php
class Mklinik extends CI_Model{
   	function __construct(){
        parent::__construct();
    }
    function getpoliklinik(){
        $data = array();
        $this->db->order_by("kode");
        $q = $this->db->get("poliklinik");
        foreach ($q->result() as $key) {
          $data[] = $key;
        }
        return $data;
    }
    function rekap_ralan_full($tindakan,$tgl1="",$tgl2=""){
        $data = array();
        $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
        $this->db->select("p.status_pasien,p.jenis,p.gol_pasien,p.tujuan_poli,p.panggil");
        if ($tindakan!="all") $this->db->where("p.tujuan_poli =",$tindakan);
        $this->db->where("date(p.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(p.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("p.layan!=",2);
        $sql = $this->db->get("pasien_ralan p");
        foreach ($sql->result() as $key) {
          if (isset($data[$key->tujuan_poli][$key->panggil]))
            $data[$key->tujuan_poli][$key->panggil] += 1;
          else
            $data[$key->tujuan_poli][$key->panggil] = 1;
        }
        return $data;
    }
}
?>
