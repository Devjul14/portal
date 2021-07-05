<?php
class Vaksinasi extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mantrian');
    }
    function index(){
        $this->load->view('vaksinasi/vvaksinasi',$data);
    }
    function getpropinsi(){
      $q = $this->db->get("propinsi");
      $data = array();
      $data[] = array("id"=>'',"text"=>'');
      foreach ($q->result() as $key) {
        $data[] = array("id"=>$key->id,"text"=>$key->name);
      }
      echo json_encode($data);
    }
    function getkota(){
      $q = $this->db->get_where("kotakabupaten",["province_id"=>$this->input->post("propinsi")]);
      $data = array();
      $data[] = array("id"=>'',"text"=>'');
      foreach ($q->result() as $key) {
        $data[] = array("id"=>$key->id,"text"=>$key->name);
      }
      echo json_encode($data);
    }
    function getkecamatan(){
      $q = $this->db->get_where("kecamatan",["regency_id"=>$this->input->post("kota")]);
      $data = array();
      $data[] = array("id"=>'',"text"=>'');
      foreach ($q->result() as $key) {
        $data[] = array("id"=>$key->id,"text"=>$key->name);
      }
      echo json_encode($data);
    }
    function getdesa(){
      $q = $this->db->get_where("desa",["district_id"=>$this->input->post("kecamatan")]);
      $data = array();
      $data[] = array("id"=>'',"text"=>'');
      foreach ($q->result() as $key) {
        $data[] = array("id"=>$key->id,"text"=>$key->name);
      }
      echo json_encode($data);
    }
}
?>
