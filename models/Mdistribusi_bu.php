<?php
class Mdistribusi_bu extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getdistribusi_bu(){
        $this->db->select("do.*,r.nama_ruangan,p.keterangan");
        $this->db->join("ruangan r","r.kode_ruangan=do.tujuan");
        $this->db->join("poliklinik p","p.kode=do.tujuan");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("distribusi_bu do");
        return $q;
    }
    function getdatadistribusi_bu($page,$offset){
        $no_distribusi  = $this->session->userdata('cari_distribusi');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $tujuan         = $this->session->userdata('depo_tujuan');
        if ($no_distribusi!="") {
            $this->db->like("no_distribusi",$no_distribusi);
        }
        if ($tujuan!="") {
            $this->db->like("tujuan",$tujuan);
        }
        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("date(tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        }
        $this->db->select("do.*,r.nama_ruangan,p.keterangan as nama_poli");
        $this->db->join("ruangan r","r.kode_ruangan=do.tujuan","left");
        $this->db->join("poliklinik p","p.kode=do.tujuan","left");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("distribusi_bu do",$page,$offset);
        return $q;
    }
    function getdistribusibu_detail($no_distribusi){
        $this->db->select("do.*,r.nama_ruangan,p.keterangan as nama_poli");
        $this->db->join("ruangan r","r.kode_ruangan=do.tujuan","left");
        $this->db->join("poliklinik p","p.kode=do.tujuan","left");
        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("distribusi_bu do");
        return $q->row();
    }
    function getdepo(){
        return $this->db->get("depo_obat");
    }
    function getpoliklinik(){
        return $this->db->get("poliklinik");
    }
    function getruangan(){
        return $this->db->get("ruangan");
    }
    function getitem_distribusi($no_distribusi){
        $this->db->select("rk.*,o.*,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil,stok,stok_awal,s.nama_status");
        $this->db->join("master_bu o","o.kode_bu=rk.kode_bu","left");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar","left");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil","left");
        $this->db->join("status_bu s","s.kode_status=rk.kode_status","left");
        $this->db->where("rk.no_distribusi",$no_distribusi);
        $q = $this->db->get("itemdistribusi_bu rk");
        return $q;
    }
    function simpandistribusi_bu($action,$no_distribusi){
        
        switch($action){
            case 'simpan' :
                $data = array(    
                                "no_distribusi"             => $no_distribusi,
                                "tanggal"                   => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"                => $this->input->post("keterangan"),
                                "tujuan"                    => $this->input->post("depo_tujuan"),

                            );
                $this->db->insert("distribusi_bu",$data);
                return "success-Data berhasil disimpan";
            break;
            // case 'edit' :
            //     $data = array(    
            //                     "keterangan_pengajuan"      => $this->input->post("keterangan_pengajuan"),
            //                     "depo"                      => $this->input->post("depo"),
            //                 );
            //     $this->db->where("no_distribusi", $this->input->post("no_distribusi"));
            //     $this->db->update("pengajuan_depo",$data);
            //     return "info-Data berhasil diubah";
            // break;
        }

    }
    function getbu(){
        $this->db->select("o.*,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->where("stok>",0);
        $q = $this->db->get("master_bu o");
        $data = [];
        foreach ($q->result() as $key) {
            $data[] = array('id' => $key->kode_bu, 'label' => $key->nama_bu, 'satuan' => $key->satuan_besar, 'satuan_kecil' => $key->satuan_kecil, 'stok' => $key->stok);
            }
        return $data;
    }
    function simpanitem_distribusi(){
        $no_distribusi       = $this->input->post("no_distribusi");
        $kode                = $this->input->post("kode");
        $depo_tujuan         = $this->input->post("depo_tujuan");

        $this->db->where("kode_bu",$kode);
        $this->db->where("no_distribusi",$no_distribusi);
        $q = $this->db->get("itemdistribusi_bu");
        $row = $q->row();

        $this->db->where("kode_bu",$kode);
        $q1 = $this->db->get("master_bu");
        $row1 = $q1->row();

        if ($row) {
            $data = array(
                    "qty" => ($row->qty+1)
                );
            $this->db->where("kode_bu",$kode);
            $this->db->where("no_distribusi",$no_distribusi);
            $this->db->update("itemdistribusi_bu",$data);

            $dt1 = array("stok" =>  ($row1->stok-1) );
            $this->db->where("kode_bu",$kode);
            $this->db->update("master_bu",$dt1);


            return "info-Data berhasil diedit";
        } else {
            $data = array(
                        "kode_bu"           => $this->input->post("kode"),
                        "no_distribusi"     => $this->input->post("no_distribusi"),
                        "qty"               => 1
                    );
            $this->db->insert("itemdistribusi_bu",$data);

            $dt1 = array("stok" =>  ($row1->stok-1) );
            $this->db->where("kode_bu",$kode);
            $this->db->update("master_bu",$dt1);
            return "success-Data berhasil disimpan";
        }
        

        $this->db->where("kode_depo",$depo_asal);
        $q2 = $this->db->get("depo_obat");
        $rw2 = $q2->row();
        $stok_depo_asal = $rw2->stok;

        $this->db->where("kode_depo",$depo_tujuan);
        $q3 = $this->db->get("depo_obat");
        $rw3 = $q3->row();
        $stok_depo_tujuan = $rw3->stok;

        $this->db->where("kode",$kode);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();


        if ($row) {
            

            $dt = array($stok_depo_asal =>  ($row1->$stok_depo_asal-1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt);

            $dt1 = array($stok_depo_tujuan =>  ($row1->$stok_depo_tujuan+1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt1);

            
        } else {
            

            $dt = array($stok_depo_asal =>  ($row1->$stok_depo_asal-1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt);

            $dt1 = array($stok_depo_tujuan =>  ($row1->$stok_depo_tujuan+1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt1);

            
        }
        
    }
    function changedata_distribusi(){
        $kode                = $this->input->post("kode");
        $qty                 = $this->input->post("value");
        $no_distribusi       = $this->input->post("no_distribusi");
        $depo_tujuan         = $this->input->post("depo_tujuan");


        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->where("kode_bu",$kode);
        $q = $this->db->get("itemdistribusi_bu")->row();
        $qty_lama = $q->qty;

        //Ambil Data
        $this->db->where("kode_bu",$kode);
        $q1 = $this->db->get("master_bu");
        $row1 = $q1->row();

        
        $dt = array("stok" =>  ($row1->stok+$qty_lama) );
        $this->db->where("kode_bu",$kode);
        $this->db->update("master_bu",$dt);

        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->where("kode_bu",$kode);
        $this->db->set("qty",$qty);
        $this->db->update("itemdistribusi_bu");

        //Ambil Data
        $this->db->where("kode_bu",$kode);
        $q2 = $this->db->get("master_bu");
        $row2 = $q2->row();

         //Kurangi stok master
        $stok_akhir = $row2->stok-$this->input->post("value");
        $dt2 = array("stok" => $stok_akhir);
        $this->db->where("kode_bu",$kode);
        $this->db->update("master_bu",$dt2);

    }
    function hapusitem_distribusi($no_distribusi,$kode,$depo_tujuan){
        //Qty Lama
        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->where("kode_bu",$kode);
        $q = $this->db->get("itemdistribusi_bu")->row();
        $qty_lama = $q->qty;

        //Ambil Data
        $this->db->where("kode_bu",$kode);
        $q1 = $this->db->get("master_bu");
        $row1 = $q1->row();

        //Balikin Stok ke master
        $dt = array("stok" =>  ($row1->stok+$qty_lama) );
        $this->db->where("kode_bu",$kode);
        $this->db->update("master_bu",$dt);

        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->where("kode_bu",$kode);
        $this->db->delete("itemdistribusi_bu");


        return "danger-Item berhasil dihapus";
    }
    function hapusdistribusi_obat($no_distribusi){

        // Ambil data depo asal & depo tujuan
        $this->db->where("no_distribusi",$no_distribusi);
        $q = $this->db->get("distribusi_obat")->row();
        $depo_asal      = $q->depo_asal;
        $depo_tujuan    = $q->depo_tujuan;

        //Ambil data stok dari depo
        $this->db->where("kode_depo",$depo_asal);
        $q1 = $this->db->get("depo_obat");
        $rw1 = $q1->row();
        $stok_depo_asal = $rw1->stok;

        $this->db->where("kode_depo",$depo_tujuan);
        $q2 = $this->db->get("depo_obat");
        $rw2 = $q2->row();
        $stok_depo_tujuan = $rw2->stok;

        $this->db->where("no_distribusi",$no_distribusi);
        $q3 = $this->db->get("item_distribusi");

        foreach ($q3->result() as $value) {
            $this->db->where("kode",$value->kode_obat);
            $q4 = $this->db->get("farmasi_data_obat");
            $row4 = $q4->row();

            $dt = array($stok_depo_asal =>  ($row4->$stok_depo_asal+$value->qty) );
            $this->db->where("kode",$value->kode_obat);
            $this->db->update("farmasi_data_obat",$dt);

            $dt1 = array($stok_depo_tujuan =>  ($row4->$stok_depo_tujuan-$value->qty) );
            $this->db->where("kode",$value->kode_obat);
            $this->db->update("farmasi_data_obat",$dt1);

            $this->db->where("no_distribusi",$no_distribusi);
            $this->db->where("kode_obat",$value->kode_obat);
            $this->db->delete("item_distribusi");
        }

        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->delete("distribusi_obat");
        return "danger-Data berhasil dihapus";
    }
    function getstok_depo($no_distribusi){
        //Ambil distribusi obat
        $this->db->where("no_distribusi",$no_distribusi);
        $q1 = $this->db->get("distribusi_obat")->row();
        $depo_asal = $q1->depo_asal;

        //Ambil depo
        $this->db->where("kode_depo",$depo_asal);
        $q2 = $this->db->get("depo_obat")->row();
        $stok_depo = $q2->stok;

        return $stok_depo;
    }
    function getinventaris(){
        $this->db->select("rk.*,o.*,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil,stok,stok_awal,s.nama_status,nama_ruangan,p.keterangan as nama_poli,db.tanggal");
        $this->db->join("distribusi_bu db","db.no_distribusi=rk.no_distribusi");
        $this->db->join("ruangan r","r.kode_ruangan=db.tujuan","left");
        $this->db->join("poliklinik p","p.kode=db.tujuan","left");
        $this->db->join("master_bu o","o.kode_bu=rk.kode_bu","left");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar","left");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil","left");
        $this->db->join("status_bu s","s.kode_status=rk.kode_status","left");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("itemdistribusi_bu rk");
        return $q;
    }
    function getinventaris_data($page,$offset){
        $no_distribusi  = $this->session->userdata('cari_distribusi');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $tujuan         = $this->session->userdata('depo_tujuan');
        if ($no_distribusi!="") {
            $this->db->like("no_distribusi",$no_distribusi);
        }
        if ($tujuan!="") {
            $this->db->like("tujuan",$tujuan);
        }
        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("date(tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        }
        $this->db->select("rk.*,o.*,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil,stok,stok_awal,s.nama_status,nama_ruangan,p.keterangan as nama_poli,db.tanggal");
        $this->db->join("distribusi_bu db","db.no_distribusi=rk.no_distribusi");
        $this->db->join("ruangan r","r.kode_ruangan=db.tujuan","left");
        $this->db->join("poliklinik p","p.kode=db.tujuan","left");
        $this->db->join("master_bu o","o.kode_bu=rk.kode_bu","left");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar","left");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil","left");
        $this->db->join("status_bu s","s.kode_status=rk.kode_status","left");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("itemdistribusi_bu rk",$page,$offset);
        return $q;
    }
    function getstatus_bu(){
        return $this->db->get("status_bu");
    }
    function getinventaris_detail($no_distribusi,$kode_bu){
        $this->db->select("ib.*,sb.nama_status");
        $this->db->join("status_bu sb","sb.kode_status=ib.kode_status");
        $q = $this->db->get("itemdistribusi_bu ib");
        return $q->row();
    }
    function simpanubahstatus(){
        $data = array(  

                        "id_ubah"                   => date("YmdHis"),
                        "no_distribusi"             => $this->input->post("no_distribusi"),
                        "kode_bu"                   => $this->input->post("kode_bu"),
                        "status_lama"               => $this->input->post("status_lama"),
                        "status_baru"               => $this->input->post("status_baru"),

                    );
        $this->db->insert("ubah_status",$data);

        $data1 = array(  
                        "kode_status"               => $this->input->post("status_baru"),

                    );
        $this->db->where("no_distribusi",$this->input->post("no_distribusi"));
        $this->db->where("kode_bu",$this->input->post("kode_bu"));
        $this->db->update("itemdistribusi_bu",$data1);
        return "success-Data berhasil disimpan";
    }
    function gethistory(){
        $q = $this->db->get("ubah_status");
        return $q;
    }
    function gethistory_data($page,$offset){
        $no_distribusi  = $this->session->userdata('cari_distribusi');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $tujuan         = $this->session->userdata('depo_tujuan');
        if ($no_distribusi!="") {
            $this->db->like("no_distribusi",$no_distribusi);
        }
        if ($tujuan!="") {
            $this->db->like("tujuan",$tujuan);
        }
        if ($tgl1!="" OR $tgl2!="") {
            $this->db->like("date(tanggal)>=",date("Ymd",strtotime($tgl1)));
            $this->db->like("date(tanggal)<=",date("Ymd",strtotime($tgl2)));
        }
        $this->db->select("us.*,sb1.nama_status as status_lama, sb2.nama_status as status_baru,mb.nama_bu,mb.merk");
        $this->db->join("distribusi_bu db","db.no_distribusi=us.no_distribusi");
        $this->db->join("status_bu sb1","sb1.kode_status=us.status_lama");
        $this->db->join("status_bu sb2","sb2.kode_status=us.status_baru");
        $this->db->join("master_bu mb",",mb.kode_bu=us.kode_bu");
        $q = $this->db->get("ubah_status us",$page,$offset);
        return $q;
    }
}
?>