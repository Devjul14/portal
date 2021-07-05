<?php
class Massesmen extends CI_Model{
   	function __construct(){
        parent::__construct();
    }
    function getassesmen(){
    	$this->db->select("assesmen.*,luka.keterangan as ket_luka");
    	$this->db->join("luka","luka.kode=assesmen.luka","left");
    	$this->db->where("assesmen.no_reg",$this->input->post("no_reg"));
        $this->db->where("assesmen.asal",$this->input->post("asal"));
        return $this->db->get("assesmen")->result();
    }
    function getluka(){
    	return $this->db->get("luka")->result();
    }
    function getdental(){
        return $this->db->get("dental")->result();
    }
    function getpasien($no_reg){
        $this->db->select("p.no_pasien,p.nama_pasien,pi.no_reg");
        $this->db->join("pasien p","p.no_pasien=pi.no_pasien","inner");
        $this->db->where("pi.no_reg",$no_reg);
        return $this->db->get("pasien_ralan pi");
    }
    function getpasien_inap($no_reg){
        $this->db->select("p.no_pasien,p.nama_pasien,pi.no_reg");
        $this->db->join("pasien p","p.no_pasien=pi.no_rm","inner");
        $this->db->where("pi.no_reg",$no_reg);
        return $this->db->get("pasien_inap pi");
    }
}
?>