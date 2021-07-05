<?php
class Ttddokter extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mpa');
        $this->load->Model('Mlab');
    }
    function index(){
        echo "";
    }
    function getttddokter($id_dokter){
        $image = "data:image/gif;base64,".$this->Mpa->getttddokter($id_dokter)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdpasien($no_pasien){
        $image = $this->Mpa->getttdpasien($no_pasien)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdkeluarga($no_reg){
        $q = $this->db->get_where("persetujuan", ["no_reg" => $no_reg]);
        if ($q->num_rows()>0){
          $image = $q->row()->ttd_saksi;
          echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
        } echo "";
    }
    function getttddokterlab($id_dokter){
        $image = "data:image/gif;base64,".$this->Mlab->getttddokter($id_dokter)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdperawat($id){
        $image = "data:image/gif;base64,".$this->Mpa->getttddokter($id)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdperawat2($id){
        $image = "data:image/gif;base64,".$this->Mpa->getttdperawat($id)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdkarumkit($id){
        $image = "data:image/gif;base64,".$this->Mpa->getttdkarumkit($id)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdprm($id){
        $image = "data:image/gif;base64,".$this->Mpa->getttdprm($id)->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdklaim(){
        $image = "data:image/gif;base64,".$this->Mpa->getttdkarumkit()->row()->ttd_petugas_klaim;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdpetugas($id){
        $q = $this->db->get_where("petugas_kasir",["nip"=>$id]);
        $image = "data:image/gif;base64,".$q->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdanalys($id){
        $q = $this->db->get_where("analys",["nip"=>$id]);
        $image = "data:image/gif;base64,".$q->row()->ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdpasientindakan($no_reg,$jenis,$no){
        $q = $this->db->get_where("pasien_tindakan_medis",["no_reg"=>$no_reg,"jenis"=>$jenis]);
        $image[0] = "data:image/gif;base64,".$q->row()->ttd;
        $image[1] = "data:image/gif;base64,".$q->row()->ttd2;
        echo "<img src='".$image[$no]."' alt='Product Image' class='img-thumbnail'>";
    }
    function getttdpetugas2($jenis,$id_petugas){
        if ($jenis=="dokter"){
          $ttd = $this->Mpa->getttddokter($id_petugas)->row()->ttd;
        } else {
          $ttd = $this->Mpa->getttdperawat($id_petugas)->row()->ttd;
        }
        $image = "data:image/gif;base64,".$ttd;
        echo "<img src='".$image."' alt='Product Image' class='img-thumbnail'>";
    }
}
?>
