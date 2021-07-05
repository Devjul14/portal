<?php
class Assesmen extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Mlab');
		$this->load->Model('Mpendaftaran');
        $this->load->Model('Mkasir');
        $this->load->Model('Mgrouper');
        $this->load->Model('Massesmen');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function getanatomi($no_reg,$asal="assesmen"){
        $data["title"]    = "Assesmen";
        $data['judul']    = "Assesmen";
        $data["vmenu"]    = "pendaftaran/vmenu";
        $data["content"]  = "pendaftaran/vassesmen";
        $data["title_header"] = "Assesmen ";
        $data["breadcrumb"]   = "<li class='active'><strong>Assesmen</strong></li>";
        $data["username"] = $this->session->userdata('nama_user');
        $data['asal'] = $asal;
        $data['menu']     = "pendaftaran";
        $data['q'] = $this->Massesmen->getpasien($no_reg);
        $this->load->view('template',$data);
    }
    function getanatomi_ralan($no_reg,$asal="assesmen"){
        $data["title"]    = "Assesmen";
        $data['judul']    = "Assesmen";
        $data["vmenu"]    = "pendaftaran/vmenu";
        $data["content"]  = "pendaftaran/vassesmen_ralan";
        $data["title_header"] = "Assesmen ";
        $data["breadcrumb"]   = "<li class='active'><strong>Assesmen</strong></li>";
        $data["username"] = $this->session->userdata('nama_user');
        $data['asal'] = $asal;
        $data['menu']     = "pendaftaran";
        $data['q'] = $this->Massesmen->getpasien($no_reg);
        $this->load->view('template',$data);
    }
    function simpan(){
        $this->db->where("no_reg",$this->input->post("no_reg"));
        $this->db->where("asal",$this->input->post("asal"));
        $this->db->delete("assesmen");
        $item = $this->input->post("item");
        foreach($item as $key => $value){
            $this->db->insert("assesmen",$value);
        }
    }
    function simpan_dental(){
        $item = $this->input->post("item");
        $q = $this->db->get_where("pasien_dental",["no_reg"=>$this->input->post("no_reg"),"indeks"=>$this->input->post("indeks")]);
        if ($q->num_rows()<=0){
            foreach($item as $key => $value){
                $this->db->insert("pasien_dental",$value);
            }
        } else {
            foreach($item as $key => $value){
                $this->db->where("no_reg",$this->input->post("no_reg"));
                $this->db->where("indeks",$this->input->post("indeks"));
                $this->db->update("pasien_dental",$value);
            }
        }
    }
    function getanatomi_inap($no_reg,$asal="assesmen"){
        $data["title"]    = "Assesmen";
        $data['judul']    = "Assesmen";
        $data["vmenu"]    = "pendaftaran/vmenu";
        $data["content"]  = "pendaftaran/vassesmen_inap";
        $data["title_header"] = "Assesmen ";
        $data["breadcrumb"]   = "<li class='active'><strong>Assesmen</strong></li>";
        $data["username"] = $this->session->userdata('nama_user');
        $data["asal"] = $asal;
        $data['menu']     = "pendaftaran";
        $data['q'] = $this->Massesmen->getpasien_inap($no_reg);
        $this->load->view('template',$data);
    }
    function getassesmen(){
        $q = $this->Massesmen->getassesmen();
        echo json_encode($q);
    }
    function getluka(){
        $q = $this->Massesmen->getluka();
        echo json_encode($q);
    }
    function getdental(){
        $q = $this->Massesmen->getdental();
        echo json_encode($q);
    }
    function getpasien_dental(){
        $this->db->select("pd.*,pr.no_pasien,d.color");
        $this->db->where("pr.no_pasien",$this->input->post("no_rm"));
        $this->db->join("pasien_ralan pr","pr.no_reg=pd.no_reg","inner");
        $this->db->join("dental d","d.kode=pd.kode_tindakan","inner");
        $q = $this->db->get("pasien_dental pd");
        echo json_encode($q->result());
    }
    function getpasien_dental_detail($no_reg=""){
        $this->db->order_by("pr.tanggal","desc");
        $this->db->select("pd.*,d.color,date(pr.tanggal) as tanggal,pr.no_pasien,d.keterangan as keterangan_tindakan");
        if ($no_reg!=""){
            $this->db->where("pr.no_reg",$no_reg);
        }
        $this->db->where("pr.no_pasien",$this->input->post("no_rm"));
        $this->db->where("pd.nomor_gigi",$this->input->post("nomor"));
        $this->db->join("pasien_ralan pr","pr.no_reg=pd.no_reg","inner");
        $this->db->join("dental d","d.kode=pd.kode_tindakan","inner");
        $q = $this->db->get("pasien_dental pd");
        echo json_encode($q->result());
    }
    function getdental_ralan($no_reg,$asal="assesmen"){
        $data["title"]    = "Odontogram";
        $data['judul']    = "Odontogram";
        $data["vmenu"]    = "pendaftaran/vmenu";
        $data["content"]  = "pendaftaran/vdental_ralan";
        $data["title_header"] = "Odontogram ";
        $data["breadcrumb"]   = "<li class='active'><strong>Odontogram</strong></li>";
        $data["username"] = $this->session->userdata('nama_user');
        $data['asal'] = $asal;
        $data['menu']     = "pendaftaran";
        $data['q'] = $this->Massesmen->getpasien($no_reg);
        $data['d'] = $this->Massesmen->getdental();
        $this->load->view('template',$data);
    }
    function geticd10(){
        echo json_encode($this->Mgrouper->geticd10());
    }
}
?>