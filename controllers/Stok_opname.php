<?php
class Stok_opname extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mstok_opname');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
    function list_stokopname($current=0,$from=0){
        $data["title"]                  = $this->session->userdata('status_user');
        $data['judul']                  = "Stok Opname &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]                  = $this->session->userdata("controller") . "/vmenu";
        $data["content"]                = "farmasi/stok_opname/vstok_opname";
        $data["username"]               = $this->session->userdata('nama_user');
        $data['menu']                   = "transaksi";
        $data["current"]                = $current;
        $data["title_header"]           = "Stok Opname";
        $data["breadcrumb"]             = "<li class='active'><strong>Stok Opname</strong></li>";        
        $this->load->library('pagination');
        $config['base_url']             = base_url().'penerimaan/stok_opname/'.$current;
        $config['total_rows']           = $this->Mstok_opname->getstok_opname()->num_rows();
        $config['per_page']             = 20;
        $config['full_tag_open']        = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']       = '</ul>';
        $config['cur_tag_open']         = '<li class=active><a>';
        $config['cur_tag_close']        = '</a></li>';
        $config['num_tag_open']         = '<li>';
        $config['num_tag_close']        = '</li>';
        $config['prev_tag_open']        = '<li>';
        $config['prev_tag_close']       = '</li>';
        $config['next_tag_open']        = '<li>';
        $config['next_tag_close']       = '</li>';
        $config['first_tag_open']       = '<li>';
        $config['first_tag_close']      = '</li>';
        $config['last_tag_open']        = '<li>';
        $config['last_tag_close']       = '</li>';
        $config['num_links']            = 4;
        $config['uri_segment']          = 4;
        $from                           = $this->uri->segment(4);
        $data["from"]                   = $from;
        $this->pagination->initialize($config);
        $data["q3"]                     = $this->Mstok_opname->getdatastok_opname($config['per_page'],$from);
        $data["dp"]                     = $this->Mstok_opname->getdepo();
        $this->load->view('template',$data);
    }
    function search_nomor(){
        $this->session->set_userdata("cari_nomor",$this->input->post("cari_nomor"));
        $this->session->set_userdata("depo", $this->input->post("depo"));
    }
    function reset_nomor(){
        $this->session->unset_userdata("cari_nomor");
        $this->session->unset_userdata("depo");
        redirect('stok_opname/list_stokopname');
    }
    function formstok_opname($kode=0,$jenis=""){
        $search = $this->input->post("search");
        $data["title"]              = $this->session->userdata('status_user');
        $data["username"]           = $this->session->userdata('username');
        $data['judul']              = "Stok Opname &nbsp;&nbsp;&nbsp;";
        $data["vmenu"]              = $this->session->userdata("controller") . "/vmenu";
        $data["menu"]               = "transaksi";
        $data["title_header"]       = "Stok Opname ";
        $data["breadcrumb"]         = "<li class='active'><strong>Stok Opname</strong></li>";
        $data["content"]            = "farmasi/stok_opname/vformstok_opname";
        $data["kode"]				= $kode;
        if ($jenis=="") $jenis = $this->Mstok_opname->getjenis_obat()->row()->kode_jenis;
        $data["jenis"]              = $jenis;
        $data["search"]             = $search;
        $data["d"]					= $this->Mstok_opname->getdepo();
        $q = $this->Mstok_opname->getstokopname_detail($kode);
        $data["q"]					= $q;
        $data["q1"]					= $this->Mstok_opname->cekitem_so($kode,$jenis);
        $data["jo"]                 = $this->Mstok_opname->getjenis_obat();
        // $this->load->library('pagination');
        // $config['base_url'] = base_url().'stok_opname/formstok_opname/'.$kode."/".$from;
        // if ($kode!="")
        //     $config['total_rows'] = $this->Mstok_opname->jumlahobat($jenis);
        // else 
        //     $config['total_rows'] = $this->Mstok_opname->jumlahitem_so($kode);
        // $config['per_page'] = 100;
        // $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        // $config['full_tag_close'] = '</ul>';
        // $config['cur_tag_open'] = '<li class=active><a>';
        // $config['cur_tag_close'] = '</a></li>';
        // $config['num_tag_open'] = '<li>';
        // $config['num_tag_close'] = '</li>';
        // $config['prev_tag_open'] = '<li>';
        // $config['prev_tag_close'] = '</li>';
        // $config['next_tag_open'] = '<li>';
        // $config['next_tag_close'] = '</li>';
        // $config['first_tag_open'] = '<li>';
        // $config['first_tag_close'] = '</li>';
        // $config['last_tag_open'] = '<li>';
        // $config['last_tag_close'] = '</li>';
        // $config['num_links'] = 3;
        // $config['uri_segment'] = 5;
        // $from = $this->uri->segment(5);
        // $data["from"] = $from;
        // $data["per_page"] = $config['per_page'];
        // $this->pagination->initialize($config);
        $data["o"]                  = $this->Mstok_opname->getobat($jenis);
        $data["so"]                 = $this->Mstok_opname->getitem_so($kode,$jenis);
        if ($kode!=""){
            $data["stok_awal"]          = $this->Mstok_opname->getstok_awal($kode);
            $data["stok_pengeluaran"]   = $this->Mstok_opname->getstok_pengeluaran($kode);
            $data["stok_pemasukan"]     = $this->Mstok_opname->getstok_pemasukan($kode);
            $data["s_awal"]             = $this->Mstok_opname->gets_awal($kode);
            $data["cekstok_awal"]       = $this->Mstok_opname->cekstok_awal($kode);
        }
        $this->load->view('template',$data);
    }
    function simpanstok_opname($action){
        $message = $this->Mstok_opname->simpanstok_opname($action);
        $this->session->set_flashdata("message",$message);
        redirect("stok_opname/formstok_opname/".$this->input->post('kode_so'));
    }
    function hapuspenerimaan_barang($no_pemesanan,$no_penerimaan){
        $message = $this->Mstok_opname->hapuspenerimaan_barang($no_pemesanan,$no_penerimaan);
        $this->session->set_flashdata("message",$message);
        redirect("penerimaan/penerimaan_barang");
    }
    function simpanitem_so($kode){
        $message = $this->Mstok_opname->simpanitem_so($kode);
        $this->session->set_flashdata("message",$message);
        $jenis_obat = $this->input->post("jenis_obat");
        $search = $this->input->post("search");
        redirect("stok_opname/formstok_opname/".$kode."/".$jenis_obat."/".$search);
    }
    function cetak($kode,$jenis="",$search=""){
        $data["kode"]   			= $kode;
        $data["jenis"]   			= $jenis;
        $data["search"]				= $search;
        $data["q"]					= $this->Mstok_opname->getstokopname_detail($kode);
        $data["q1"]					= $this->Mstok_opname->cekitem_so($kode,$jenis);
        $data["o"]					= $this->Mstok_opname->getobat($jenis,$search);
        $data["so"]					= $this->Mstok_opname->getitem_so($kode,$jenis,$search);
        $data["nj"]					= $this->Mstok_opname->getjenis_obat_detail($jenis);
        if ($kode!="") {
            $data["stok_awal"]          = $this->Mstok_opname->getstok_awal($kode);
            $data["stok_pengeluaran"]   = $this->Mstok_opname->getstok_pengeluaran($kode);
            $data["stok_pemasukan"]     = $this->Mstok_opname->getstok_pemasukan($kode);
            $data["s_awal"]             = $this->Mstok_opname->gets_awal($kode);
            $data["cekstok_awal"]       = $this->Mstok_opname->cekstok_awal($kode);
        }
        $this->load->view("farmasi/stok_opname/vcetak",$data);
    }
    function excel($kode,$jenis="",$search=""){
        $data["kode"]   			= $kode;
        $data["jenis"]   			= $jenis;
        $data["search"]				= $search;
        $data["q"]					= $this->Mstok_opname->getstokopname_detail($kode);
        $data["q1"]					= $this->Mstok_opname->cekitem_so($kode,$jenis);
        $data["o"]					= $this->Mstok_opname->getobat($jenis,$search);
        $data["so"]					= $this->Mstok_opname->getitem_so($kode,$jenis,$search);
        $data["nj"]					= $this->Mstok_opname->getjenis_obat_detail($jenis);
        if ($kode!="") {
            $data["stok_awal"]          = $this->Mstok_opname->getstok_awal($kode);
            $data["stok_pengeluaran"]   = $this->Mstok_opname->getstok_pengeluaran($kode);
            $data["stok_pemasukan"]     = $this->Mstok_opname->getstok_pemasukan($kode);
            $data["s_awal"]             = $this->Mstok_opname->gets_awal($kode);
            $data["cekstok_awal"]       = $this->Mstok_opname->cekstok_awal($kode);
        }
        $this->load->view("farmasi/stok_opname/vexcel",$data);
    }

}
?>