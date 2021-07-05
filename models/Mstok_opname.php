<?php
class Mstok_opname extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    function getstok_opname(){
      $q = $this->db->get("stok_opname");
      return $q;
    }
    function getdatastok_opname($page,$offset){
        $cari           = $this->session->userdata('cari_nomor');
        $depo           = $this->session->userdata('depo');
        if ($cari!="") {
          $this->db->like("so.kode_so",$cari);
        }
        if ($depo!="") {
          $this->db->where("depo",$depo);
        }
        $this->db->join("depo_obat do","do.kode_depo=so.depo");
        $this->db->order_by("periode","DESC");
        $q = $this->db->get("stok_opname so",$page,$offset);
        return $q;
    }
    function getdepo(){
      return $this->db->get("depo_obat");
    }
    function getstok_awal($kode){
      $this->db->where("kode_so",$kode);
      $q = $this->db->get("stok_opname")->row();
      $depo = $q->depo;

      $this->db->where("kode_depo",$depo);
      $q1 = $this->db->get("depo_obat")->row();
      $stok = $q1->stok."_awal";

      return $stok;
    }
    function getstokopname_detail($kode){
      $this->db->select("so.*,dp.nama_depo");
      $this->db->join("depo_obat dp","dp.kode_depo=so.depo");
      $this->db->where("kode_so",$kode);
      $q = $this->db->get("stok_opname so");
      return $q->row();
    }
    function cekitem_so($kode,$jenis){
      $this->db->select("io.*");
      $this->db->join("farmasi_data_obat f","f.kode=io.kode_obat");
      $this->db->where("kode_so",$kode);
      if ($jenis!="") {
        $this->db->where("kelkd",$jenis);
      }
      $q = $this->db->get("item_so io");
      return $q->row();
    }
    function simpanstok_opname($action){
      switch ($action) {
        case 'simpan':

            $this->db->where("periode",$this->input->post("periode"));
            $this->db->where("depo",$this->input->post("depo"));
            $q = $this->db->get("stok_opname");
            $row = $q->row();
            if ($row) {
              return "danger-Data sudah ada sebelumnya";
            } else {
              $data = array(
                            'kode_so'     => $this->input->post("kode_so"), 
                            'periode'     => $this->input->post("periode"), 
                            'depo'        => $this->input->post("depo"), 
                            'keterangan'  => $this->input->post("keterangan"),
                        );
              $this->db->insert("stok_opname",$data);
              return "success-Data berhasil disimpan";
            }
          break;
          case 'edit':
            
          break;
      }
    }
    function getobat($jenis){
      if ($jenis!="") {
        $this->db->where("kelkd",$jenis);
      }
      if ($this->input->post("search") !="") {
        $this->db->where("kelkd",$jenis);
        $this->db->group_start();
        $this->db->like("kode",$this->input->post("search"),"after");
        $this->db->or_like("nama",$this->input->post("search"),"after");
        $this->db->group_end();
      }
      $this->db->order_by("nama");
      $q1 = $this->db->get("farmasi_data_obat");
      return $q1;
    }
    function jumlahobat($jenis){
      if ($jenis!="") {
        $this->db->where("kelkd",$jenis);
      }
      $q1 = $this->db->get("farmasi_data_obat");
      return $q1->num_rows();
    }
    function simpanitem_so($kode){
      $this->db->where("kode_so",$kode);
      $k1= $this->db->get("stok_opname")->row();
      $depo = $k1->depo;
      $this->db->where("kode_depo",$depo);
      $k2 = $this->db->get("depo_obat")->row();
      $stok = $k2->stok;

      $stok_awal        = $this->input->post("stok_awal");
      $stok_pemasukan   = $this->input->post("stok_pemasukan");
      $stok_pemakaian   = $this->input->post("stok_pemakaian");
      $stok_real        = $this->input->post("stok_real");
      $stok_so          = $this->input->post("stok_so");
      $keterangan       = $this->input->post("keterangan");
      $satuan_kecil     = $this->input->post("satuan_kecil");
      $harga            = $this->input->post("harga");
      $jenis            = $this->input->post("jenis_obat");
      $search           = $this->input->post("search");
      $pak2           = $this->input->post("pak2");
      // $o                = $this->getobat($jenis);
      $ko = $this->input->post("kode_obat");
      foreach ($ko as $key => $kodeobat) {
        // if ($stok_awal[$val->kode]>0 || $stok_pemasukan[$val->kode]>0 || $stok_pemakaian[$val->kode]>0) {
            $hrg = isset($harga[$kodeobat]) ? $harga[$kodeobat] : 0;
            $data[] = array(
                          'kode_so'         => $kode, 
                          'kode_obat'       => $kodeobat,
                          'stok_awal'       => $stok_awal[$kodeobat],
                          'stok_pemasukan'  => $stok_pemasukan[$kodeobat],
                          'stok_pemakaian'  => $stok_pemakaian[$kodeobat],
                          'stok_real'       => (isset($stok_real[$kodeobat]) ? $stok_real[$kodeobat] : "0"),
                          'stok_so'         => $stok_so[$kodeobat],
                          'keterangan'      => isset($keterangan[$kodeobat]) ? $keterangan[$kodeobat] : "",
                          'satuan_kecil'    => $pak2[$kodeobat],
                          'jumlah'          => ((int)($stok_real[$kodeobat])*(int)($hrg)),
                  );
          // $data2 = array(
          //               $stok   => $stok_real[$val->kode],
          //             );
          // $this->db->where("kode",$val->kode);
          // $this->db->update("farmasi_data_obat",$data2);
      }
      // $this->db->transStart();
      $this->db->insert_batch("item_so",$data);
      // $this->db->transComplete();
      return "info-Stok Opname Berhasil disimpan <small>(".count($ko)." record)</small>";
    }
    function getitem_so($kode,$jenis){
      $search = $this->input->post("search");
      $this->db->select("is.*,f.nama");
      $this->db->join("farmasi_data_obat f","f.kode=is.kode_obat","inner");
      $this->db->where("kode_so",$kode);
      if ($jenis != "") {
        $this->db->where("kelkd",$jenis);
      }
      if ($search!="") {
        $this->db->group_start();
        $this->db->like("kode",$search,"after");
        $this->db->or_like("nama",$search,"after");
        $this->db->group_end();
      }
      $this->db->order_by("nama");
      $q = $this->db->get("item_so is");
      return $q;
    }
    function jumlahitem_so($kode){
      $this->db->select("is.*,f.nama");
      $this->db->join("farmasi_data_obat f","f.kode=is.kode_obat","inner");
      $this->db->where("kode_so",$kode);
      $q = $this->db->get("item_so is");
      return $q->num_rows();
    }
    function getstok_pengeluaran($kode){
      $this->db->where("kode_so",$kode);
      $row = $this->db->get("stok_opname")->row();
      $periode = $row->periode;
      $depo = $row->depo;
      switch ($depo) {
        case 'D-GUDANG':
          $d = array();
          $this->db->select("sum(id.qty) as total,id.kode_obat");
          $this->db->join("distribusi_obat db","db.no_distribusi=id.no_distribusi");
          $this->db->where("depo_asal","D-GUDANG");
          $this->db->like("tanggal",$periode,'after');
          $this->db->order_by("kode_obat");
          $q1 = $this->db->get("item_distribusi id");
          foreach ($q1->result() as $val) {
            $d[$val->kode_obat] = $val->total;
          }
          return $d;
          break;
        case 'D-INAP':
          $d = array();
          $this->db->select("sum(qty) as total,kode_obat");
          $this->db->where("depo","ranap");
          $this->db->like("tanggal",$periode,'after');
          $this->db->group_by("kode_obat");
          $this->db->order_by("kode_obat");
          $q1 = $this->db->get("apotek_inap");
          foreach ($q1->result() as $val) {
            $d[$val->kode_obat] = $val->total;
          }
          return $d;
          break;
        case 'D-RALAN':
          $d = array();
          $p = date('my',strtotime($periode));
          $this->db->select("sum(qty) as total,kode_obat");
          $this->db->where("depo","ralan");
          $this->db->where("SUBSTRING(apt.`id`, 3, 4)='".$p."' ");
          $this->db->group_by("kode_obat");
          $this->db->order_by("kode_obat");
          $q1 = $this->db->get("apotek apt");
          foreach ($q1->result() as $val) {
            $d[$val->kode_obat] = $val->total;
          }
          return $d;
          break;
        case 'D-UGD':
          $d = array();
          $d1 = array();
          $p = date('my',strtotime($periode));
          $this->db->select("sum(qty) as total,kode_obat");
          $this->db->where("depo","igd");
          $this->db->where("SUBSTRING(apt.`id`, 3, 4)='".$p."' ");
          $this->db->group_by("kode_obat");
          $this->db->order_by("kode_obat");
          $q1 = $this->db->get("apotek apt");
          foreach ($q1->result() as $val) {
            $d[$val->kode_obat] = $val->total;
          }
          $this->db->select("sum(qty) as total,kode_obat");
          $this->db->where("depo","igd");
          $this->db->like("tanggal",$periode,'after');
          $this->db->group_by("kode_obat");
          $this->db->order_by("kode_obat");
          $q2 = $this->db->get("apotek_inap");
          foreach ($q2->result() as $value) {
            $d1[$value->kode_obat] = $value->total;
          }
          return ($d+$d1);
          break;
      }
      
      
    }
    function getstok_pemasukan($kode){
      $this->db->where("kode_so",$kode);
      $row = $this->db->get("stok_opname")->row();
      $periode = $row->periode;

      $depo = $row->depo;

      if ($depo=="D-GUDANG") {
        $d = array();
        $this->db->select("sum(ip.jumlah) as total,kode_obat");
        $this->db->join("penerimaan_barang pb","pb.no_penerimaan=ip.no_penerimaan");
        $this->db->like("tanggal",$periode,'after');
        $this->db->order_by("kode_obat");
        $q1 = $this->db->get("item_penerimaan ip");
        foreach ($q1->result() as $val) {
          $d[$val->kode_obat] = $val->total;
        }
        
      } 
      else {
        $d = array();
        $this->db->select("sum(id.qty) as total,kode_obat");
        $this->db->join("distribusi_obat db","db.no_distribusi=id.no_distribusi");
        $this->db->where("depo_tujuan",$depo);
        $this->db->like("tanggal",$periode,'after');
        $this->db->order_by("kode_obat");
        $q1 = $this->db->get("item_distribusi id");
        foreach ($q1->result() as $val) {
          $d[$val->kode_obat] = $val->total;
        }
      }
      return $d;
    }
    function getjenis_obat(){
      return $this->db->get("jenis_obat");
    }
    function gets_awal($kode){
      $this->db->where("kode_so",$kode);
      $q1 = $this->db->get("stok_opname")->row();
      $depo = $q1->depo;

      $d = array();
      $this->db->select("stok_real,kode_obat");
      $this->db->join("item_so is","is.kode_so=so.kode_so");
      $this->db->where("depo",$depo);
      $this->db->order_by("periode","desc");
      $q = $this->db->get("stok_opname so");
      foreach ($q->result() as $val) {
        $d[$val->kode_obat] = $val->stok_real;
      }
      return $d;
    }
    function cekstok_awal($kode){
      $this->db->where("kode_so",$kode);
      $q1 = $this->db->get("stok_opname")->row();
      $depo = $q1->depo;
      $periode = $q1->periode;

      $this->db->where("kode_depo",$depo);
      $q2 = $this->db->get("depo_obat")->row();
      $stok = $q2->stok."_awal";

      $d = array();
      $this->db->like("tgawal",$periode,"after");
      $q = $this->db->get("farmasi_data_obat");
      foreach ($q->result() as $val) {
        $d[$val->kode] = $val->$stok;
      }
      return $d;
    }
    function getjenis_obat_detail($kode_jenis){
      $this->db->where("kode_jenis",$kode_jenis);
      return $this->db->get("jenis_obat")->row();
    }
}
?>