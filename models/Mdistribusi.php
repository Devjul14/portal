<?php
class Mdistribusi extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getdistribusi_obat(){
        $this->db->select("do.*,d1.nama_depo as namadepo_asal,d2.nama_depo as namadepo_tujuan,");
        $this->db->join("depo_obat d1","d1.kode_depo=do.depo_asal");
        $this->db->join("depo_obat d2","d2.kode_depo=do.depo_tujuan");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("distribusi_obat do");
        return $q;
    }
    function getdatadistribusi_obat($page,$offset){
        $no_distribusi  = $this->session->userdata('cari_distribusi');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $depo_asal      = $this->session->userdata('depo_asal');
        $depo_tujuan    = $this->session->userdata('depo_tujuan');
        if ($no_distribusi!="") {
            $this->db->like("no_distribusi",$no_distribusi);
        }
        if ($depo_asal!="") {
            $this->db->like("depo_asal",$depo_asal);
        }
        if ($depo_tujuan!="") {
            $this->db->like("depo_tujuan",$depo_tujuan);
        }
        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("date(tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        }
        $this->db->select("do.*,d1.nama_depo as namadepo_asal,d2.nama_depo as namadepo_tujuan,");
        $this->db->join("depo_obat d1","d1.kode_depo=do.depo_asal");
        $this->db->join("depo_obat d2","d2.kode_depo=do.depo_tujuan");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("distribusi_obat do",$page,$offset);
        return $q;
    }
    function getdistribusiobat_detail($no_distribusi){
        $this->db->select("do.*,d1.nama_depo as namadepo_asal,d2.nama_depo as namadepo_tujuan,");
        $this->db->join("depo_obat d1","d1.kode_depo=do.depo_asal");
        $this->db->join("depo_obat d2","d2.kode_depo=do.depo_tujuan");
        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("distribusi_obat do");
        return $q->row();
    }
    function getdepo(){
        return $this->db->get("depo_obat");
    }
    function getitem_distribusi($no_distribusi){
        //Ambil distribusi obat
        $this->db->where("no_distribusi",$no_distribusi);
        $q1 = $this->db->get("distribusi_obat")->row();
        $depo_asal = $q1->depo_asal;

        //Ambil depo
        $this->db->where("kode_depo",$depo_asal);
        $q2 = $this->db->get("depo_obat")->row();
        $stok_depo = $q2->stok;


        $this->db->select("rk.*,o.pak2,o.nama,o.pak1,o.isi,o.$stok_depo");
        $this->db->join("farmasi_data_obat o","o.kode=rk.kode_obat","left");
        $this->db->where("rk.no_distribusi",$no_distribusi);
        $q = $this->db->get("item_distribusi rk");
        return $q;
    }
    function simpandistribusi($action,$no_distribusi){
        
        switch($action){
            case 'simpan' :
                $data = array(    
                                "no_distribusi"             => $no_distribusi,
                                "tanggal"                   => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"                => $this->input->post("keterangan"),
                                "depo_asal"                 => $this->input->post("depo_asal"),
                                "depo_tujuan"               => $this->input->post("depo_tujuan"),

                            );
                $this->db->insert("distribusi_obat",$data);
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
    function getobat($depo){
        $this->db->where("kode_depo",$depo);
        $q1 = $this->db->get("depo_obat")->row();
        $stok_depo = $q1->stok;

        $this->db->where($stok_depo."<>",0);
        $q = $this->db->get("farmasi_data_obat");
        $data = [];
        foreach ($q->result() as $key) {
            $data[] = array('id' => $key->kode, 'label' => $key->nama, 'satuan' => $key->pak1, 'satuan_kecil' => $key->pak2, 'stok' => $key->$stok_depo);
            }
        return $data;
    }
    function simpanitem_distribusi(){
        $no_distribusi       = $this->input->post("no_distribusi");
        $kode                = $this->input->post("kode");
        $depo_asal           = $this->input->post("depo_asal");
        $depo_tujuan         = $this->input->post("depo_tujuan");

        $this->db->where("kode_depo",$depo_asal);
        $q2 = $this->db->get("depo_obat");
        $rw2 = $q2->row();
        $stok_depo_asal = $rw2->stok;

        $this->db->where("kode_depo",$depo_tujuan);
        $q3 = $this->db->get("depo_obat");
        $rw3 = $q3->row();
        $stok_depo_tujuan = $rw3->stok;

        $this->db->where("kode_obat",$kode);
        $this->db->where("no_distribusi",$no_distribusi);
        $q = $this->db->get("item_distribusi");
        $row = $q->row();

        $this->db->where("kode",$kode);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();


        if ($row) {
            $data = array(
                    "qty" => ($row->qty+1)
                );
            $this->db->where("kode_obat",$kode);
            $this->db->where("no_distribusi",$no_distribusi);
            $this->db->update("item_distribusi",$data);

            $dt = array($stok_depo_asal =>  ($row1->$stok_depo_asal-1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt);

            $dt1 = array($stok_depo_tujuan =>  ($row1->$stok_depo_tujuan+1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt1);

            return "info-Data berhasil diedit";
        } else {
            $data = array(
                    "kode_obat"         => $this->input->post("kode"),
                    "no_distribusi"     => $this->input->post("no_distribusi"),
                    "qty"               => 1
                );
            $this->db->insert("item_distribusi",$data);

            $dt = array($stok_depo_asal =>  ($row1->$stok_depo_asal-1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt);

            $dt1 = array($stok_depo_tujuan =>  ($row1->$stok_depo_tujuan+1) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt1);

            return "success-Data berhasil disimpan";
        }
        
    }
    function changedata_distribusi(){
        $kode                = $this->input->post("kode");
        $qty                 = $this->input->post("value");
        $no_distribusi       = $this->input->post("no_distribusi");
        $depo_asal           = $this->input->post("depo_asal");
        $depo_tujuan         = $this->input->post("depo_tujuan");


        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->where("kode_obat",$kode);
        $q = $this->db->get("item_distribusi")->row();
        $qty_lama = $q->qty;

        //Ambil Data
        $this->db->where("kode",$kode);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        //Stok depo asal
        $this->db->where("kode_depo",$depo_asal);
        $q2 = $this->db->get("depo_obat");
        $rw2 = $q2->row();
        $stok_depo_asal = $rw2->stok;

        //Stok depo tujuan
        $this->db->where("kode_depo",$depo_tujuan);
        $q3 = $this->db->get("depo_obat");
        $rw3 = $q3->row();
        $stok_depo_tujuan = $rw3->stok;

        $qty2             = $this->input->post("value");
        $sd               = $this->input->post("sd");


        if ($qty2<$sd) {
            //Balikin Stok ke master
            $dt = array($stok_depo_asal =>  ($row1->$stok_depo_asal+$qty_lama) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt);

            $dt1 = array($stok_depo_tujuan =>  ($row1->$stok_depo_tujuan-$qty_lama) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt1);
            
            $this->db->where("no_distribusi",$no_distribusi);
            $this->db->where("kode_obat",$kode);
            $this->db->set("qty",$qty);
            $this->db->update("item_distribusi");
            
            //Ambil Data
            $this->db->where("kode",$kode);
            $q2 = $this->db->get("farmasi_data_obat");
            $row2 = $q2->row();

            $this->db->where("kode_depo",$depo_asal);
            $q4 = $this->db->get("depo_obat");
            $rw4 = $q4->row();
            $stok_depo_asal2 = $rw4->stok;

            $this->db->where("kode_depo",$depo_tujuan);
            $q5 = $this->db->get("depo_obat");
            $rw5 = $q5->row();
            $stok_depo_tujuan2 = $rw5->stok;

            //Kurangi stok master
            $dt2 = array($stok_depo_asal2 =>  ($row2->$stok_depo_asal2-$this->input->post("value")) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt2);

            $dt3 = array($stok_depo_tujuan2 =>  ($row2->$stok_depo_tujuan2+$this->input->post("value")) );
            $this->db->where("kode",$kode);
            $this->db->update("farmasi_data_obat",$dt3);
        }


    }
    function hapusitem_distribusi($no_distribusi,$kode,$depo_asal,$depo_tujuan){
        //Qty Lama
        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->where("kode_obat",$kode);
        $q = $this->db->get("item_distribusi")->row();
        $qty_lama = $q->qty;

        //Ambil Data
        $this->db->where("kode",$kode);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        $this->db->where("kode_depo",$depo_asal);
        $q2 = $this->db->get("depo_obat");
        $rw2 = $q2->row();
        $stok_depo_asal = $rw2->stok;

        $this->db->where("kode_depo",$depo_tujuan);
        $q3 = $this->db->get("depo_obat");
        $rw3 = $q3->row();
        $stok_depo_tujuan = $rw3->stok;


        //Balikin Stok ke master
        $dt = array($stok_depo_asal =>  ($row1->$stok_depo_asal+$qty_lama) );
        $this->db->where("kode",$kode);
        $this->db->update("farmasi_data_obat",$dt);

        $dt1 = array($stok_depo_tujuan =>  ($row1->$stok_depo_tujuan-$qty_lama) );
        $this->db->where("kode",$kode);
        $this->db->update("farmasi_data_obat",$dt1);

        $this->db->where("no_distribusi",$no_distribusi);
        $this->db->where("kode_obat",$kode);
        $this->db->delete("item_distribusi");


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
}
?>