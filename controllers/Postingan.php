<?php
class Postingan extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Mpostingan');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL)){
               redirect("login/logout","refresh");
        }
    }
    function posting($current=0,$from=0){
        $data["title"] = $this->session->userdata('status_user');
        $data['judul'] = "Info/ Promosi &nbsp;&nbsp;&nbsp;";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content"] = "postingan/vpostingan";
        $data["username"] = $this->session->userdata('nama_user');
        $data['menu']="postingan";
        $data["current"] = $current;
        $data["title_header"] = "Info/ Promosi ";
        $data["breadcrumb"] = "<li class='active'><strong>Info/ Promosi</strong></li>";     
        $this->load->library('pagination');
        $config['base_url'] = base_url().'postingan/posting/'.$current;
        $config['total_rows'] = $this->Mpostingan->getjumlah_postingan();
        $config['per_page'] = 50;
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
        $data['total_rows'] = $config['total_rows'];
        $this->pagination->initialize($config);
        $data["q"] = $this->Mpostingan->getpostingan($config['per_page'],$from);
        $this->session->unset_userdata("temp");
        $this->load->view('template',$data);
    }
    function formposting($id=""){
        $data["title"] = $this->session->userdata('status_user');
        $data["menu"]="master";
        $data["vmenu"] = $this->session->userdata("controller")."/vmenu";
        $data["content_header"] = "Info/ Promosi";
        $data["title_header"] = "Info/ Promosi<small>Form</small>";
        $data["breadcrumb"] = "<li class='active'>Info/ Promosi</li>";
        $data["username"] = $this->session->userdata('username');
        $data["content"] = "postingan/vformpostingan";
        $data["row"] = $this->Mpostingan->getpostingdetail($id);
        $data["title_toolbar"] = "Info/ Promosi";
        $this->load->view('template',$data);
    }
    function simpanposting($action){
        $message = $this->Mpostingan->simpanposting($action);
        $this->session->set_flashdata("message",$message);
        redirect("postingan/posting");
    }
    function hapus(){
        $this->db->where("id",$this->input->post("id"));
        $this->db->delete("halaman");
        redirect("postingan/posting");
    }
}
?>