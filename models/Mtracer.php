<?php
class Mtracer extends CI_Model{
   	function __construct(){
        parent::__construct();
    }
    function getjob(){
    	$this->db->where("j.status","0");
        $this->db->where("date(tanggal)",date("Y-m-d"));
    	$q = $this->db->get("jobprinter j");
    	return array("status"=>$q->num_rows(),"data" => $q->row());
    }
    function getdone($no_reg){
    	$this->db->where("no_reg",$no_reg);
    	$q = $this->db->update("jobprinter",["status"=>1]);
    }
}
?>