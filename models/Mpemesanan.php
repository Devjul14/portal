<?php
class Mpemesanan extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpemesanan_obat(){
        $this->db->join("permintaan_obat rk","po.no_permintaan=rk.no_permintaan","left");
        $this->db->order_by("tanggal_pemesanan","DESC");
        $q = $this->db->get("pemesanan_obat po");
    	return $q;
    }
    function getdatapemesanan_obat($page,$offset){
       	$cari           = $this->session->userdata('cari_nomor');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $supplier       = $this->session->userdata('supplier');
        $this->db->select("po.*,sf.nama_supplier");
        $this->db->join("permintaan_obat rk","po.no_permintaan=rk.no_permintaan","left");
        $this->db->join("supplier_farmasi sf","sf.kode_supplier=po.supplier");
       	if ($cari!="") {
          $this->db->like("po.no_permintaan",$cari);
        }
        if ($tgl1!="" OR $tgl2!="") {
          $this->db->where("po.tanggal_pemesanan>=",date("Y-m-d",strtotime($tgl1)));
          $this->db->where("po.tanggal_pemesanan<=",date("Y-m-d",strtotime($tgl2)));
        }
        if ($supplier!="") {
          $this->db->where("po.supplier",$supplier);
        }
        $this->db->order_by("tanggal_pemesanan","DESC");
       	$q = $this->db->get("pemesanan_obat po",$page,$offset);
       	return $q;
    }
    function getpemesananobat_detail($kode){
    	$this->db->where("no_pemesanan",$kode);
    	return $this->db->get("pemesanan_obat")->row();
    }
    function simpanpemesanan($action,$no_pemesanan){
      $no_permintaan = $this->input->post("no_permintaan");
      $supplier      = $this->input->post("supplier");
      $pemesanan_ke  = $this->input->post("pemesanan_ke");
      $tanggal_pemesanan       = date("Y-m-d",strtotime($this->input->post("tanggal_pemesanan")));

      $this->db->where("no_permintaan",$no_permintaan);
      $this->db->where("pemesanan_ke",$pemesanan_ke);
      $this->db->where("tanggal_pemesanan",$tanggal_pemesanan);
      $this->db->where("supplier",$supplier);
      $q = $this->db->get("pemesanan_obat")->row();
      if ($q) {
        return "danger-Data sudah ada sebelumnya";
      }
      else {
        switch($action){
          case 'simpan' :
            $data = array(
                              "no_pemesanan"          => $no_pemesanan,
                              "no_permintaan"         => $this->input->post("no_permintaan"),
                              "petugas_pemesanan"     => $this->input->post("petugas_pemesanan"),
                              "supplier"              => $this->input->post("supplier"),
                              "pemesanan_ke"          => $this->input->post("pemesanan_ke"),
                              "tanggal_pemesanan"     => date('Y-m-d',strtotime($this->input->post("tanggal_pemesanan"))),
                              "keterangan_pemesanan"  => $this->input->post("keterangan_pemesanan")
                          );
            $this->db->insert("pemesanan_obat",$data);
            return "success-Data berhasil disimpan";
          break;
                    // $jumlah_pemesanan       = $this->input->post("jumlah_pemesanan");
                    // $jumlah_permintaan      = $this->input->post("jumlah_permintaan");
                    // $harga                  = $this->input->post("harga");
                    // foreach ($jumlah_pemesanan as $key => $value) {
                    //     $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
                    //     $this->db->where("kode_obat",$key);
                    //     $q = $this->db->get("item_permintaan");
                    //     $row = $q->row();
                    //     $sisa_permintaan = $row->sisa_jumlah;

                    //     $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
                    //     $this->db->where("kode_obat",$key);
                    //     $this->db->set("sisa_jumlah",($sisa_permintaan-$value));
                    //     $this->db->update("item_permintaan");
                    //     $data1 = array(
                    //                     'no_pemesanan'      => $no_pemesanan,
                    //                     'kode_obat'         => $key, 
                    //                     'jumlah'            => $value,
                    //                     'jumlah_permintaan' => $jumlah_permintaan[$key],
                    //                     'sisa_pengajuan'    => $value,
                    //                     'harga'             => $harga[$key]
                    //                 );  
                    //     $this->db->insert("item_pemesanan",$data1);                  
                    // }
        }
      }
    }
    function simpanitem_pemesanan(){
      // Insert Item Pemesanan
      $data = array(
                      'no_pemesanan'        => $this->input->post("no_pemesanan"),
                      'kode_obat'           => $this->input->post("kode"),
                      'jumlah'              => $this->input->post("jumlah_pemesanan"),
                      'sisa_pengajuan'      => $this->input->post("jumlah_pemesanan"),
                      'harga'               => $this->input->post("harga"),
                      'jumlah_permintaan'   => $this->input->post("jumlah_permintaan"),

                    );
      $this->db->insert("item_pemesanan",$data);

      // Select sisa permintaan
      $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
      $this->db->where("kode_obat",$this->input->post("kode"));
      $q = $this->db->get("item_permintaan");
      $row = $q->row();
      $sisa_permintaan = $row->sisa_jumlah;

      // Update sisa permintaan
      $data1 = array(
                      'sisa_jumlah' => ($sisa_permintaan-$this->input->post("jumlah_pemesanan")),
                    );
      $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
      $this->db->where("kode_obat",$this->input->post("kode"));
      $this->db->update("item_permintaan",$data1);

      return "info-".$this->input->post("nama")." berhasil ditambahkan";
    }
  	function getitem_pemesanan($no_pemesanan){
      $this->db->select("ip.*,o.pak1,,o.pak1,o.nama,irk.sisa_jumlah,o.pak2,o.isi");
      $this->db->join("farmasi_data_obat o","o.kode=ip.kode_obat","left");
      $this->db->join("pemesanan_obat po","po.no_pemesanan=ip.no_pemesanan");
      $this->db->join("permintaan_obat rk","rk.no_permintaan=po.no_permintaan");
      $this->db->join("item_permintaan irk","irk.no_permintaan=rk.no_permintaan and ip.kode_obat=irk.kode_obat and irk.kode_obat=o.kode");
  		$this->db->where("ip.no_pemesanan",$no_pemesanan);
  		$q = $this->db->get("item_pemesanan ip");
  		return $q;
  	}
  	function getobat(){
		$q = $this->db->get("farmasi_data_obat");
		$data = [];
		foreach ($q->result() as $key) {
			$data[] = array('id' => $key->kode, 'label' => $key->nama, 'satuan' => $key->pak1, 'satuan_kecil' => $key->pak1);
			}
    	return $data;
    }
    function hapuspemesanan_obat($no_permintaan,$no_pemesanan,$password){
      $this->db->where("no_pemesanan",$no_pemesanan);
      $q2 = $this->db->get("pemesanan_obat")->row();
      $nip = $q2->petugas_pemesanan;

      $this->db->where("nip",$nip);
      $this->db->where("password",md5($password));
      $cek = $this->db->get("petugas_pemesanan");
      if ($cek->num_rows() > 0) {
        $this->db->where("no_pemesanan",$no_pemesanan);
        $q = $this->db->get("item_pemesanan");
        foreach ($q->result() as $value) {
          $jumlah_pemesanan = $value->jumlah;
          $this->db->where("no_permintaan",$no_permintaan);
          $this->db->where("kode_obat",$value->kode_obat);
          $q1 = $this->db->get("item_permintaan");
          $row = $q1->row();
          $sisa_permintaan = $row->sisa_jumlah;

          $this->db->where("no_permintaan",$no_permintaan);
          $this->db->where("kode_obat",$value->kode_obat);
          $this->db->set("sisa_jumlah",($sisa_permintaan+$jumlah_pemesanan));
          $this->db->update("item_permintaan");
        }

        $this->db->where("no_permintaan",$no_permintaan);
        $this->db->where("no_pemesanan",$no_pemesanan);
        $this->db->delete("pemesanan_obat");

        $this->db->where("no_pemesanan",$no_pemesanan);
        $this->db->delete("item_pemesanan");
        return "danger-Data berhasil dihapus";
      }
      else
      {
        return "warning-Password Tidak Sesuai";
      }
      
    }
    function hapusitem_pemesanan($no_permintaan,$no_pemesanan,$kode_obat){
      // Select Item Permintaan
      $this->db->where("no_permintaan",$no_permintaan);
      $this->db->where("kode_obat",$kode_obat);
      $q = $this->db->get("item_permintaan")->row();
      $sisa_jumlah = $q->sisa_jumlah;

      // Select item Pemesanan
      $this->db->where("no_pemesanan",$no_pemesanan);
      $this->db->where("kode_obat",$kode_obat);
      $q1 = $this->db->get("item_pemesanan")->row();
      $jumlah_pemesanan = $q1->jumlah;

      // Update item permintaan
      $this->db->where("no_permintaan",$no_permintaan);
      $this->db->where("kode_obat",$kode_obat);
      $this->db->set("sisa_jumlah",($sisa_jumlah+$jumlah_pemesanan));
      $this->db->update("item_permintaan");

      // Hapus Item Pemesanan
      $this->db->where("no_pemesanan",$no_pemesanan);
      $this->db->where("kode_obat",$kode_obat);
      $this->db->delete("item_pemesanan");

      return "danger-Item telah dihapus";
    }
    function getdepo(){
        return $this->db->get("depo_obat");
    }
    function getpermintaan(){
        return $this->db->get("permintaan_obat");
    }
    function getitem_permintaan($no_permintaan){
        $this->db->select("ip.*,o.nama as nama_obat,o.pak1,o.pak2,o.isi");
        $this->db->join("farmasi_data_obat o","o.kode=ip.kode_obat");
        $this->db->where("ip.no_permintaan",$no_permintaan);
        $q = $this->db->get("item_permintaan ip");
        return $q;
    }
    function getsupplier(){
        return $this->db->get("supplier_farmasi");
    }
    function getpetugas_pemesanan(){
        return $this->db->get("petugas_pemesanan");
    }
    function getobat_permintaan($no_permintaan){
        $this->db->select("f.*,ip.*");
        $this->db->join("farmasi_data_obat f","f.kode=ip.kode_obat");
        $this->db->where("no_permintaan",$no_permintaan);
        $this->db->where("sisa_jumlah<>",0);
        $q = $this->db->get("item_permintaan ip");
        $data = [];
        foreach ($q->result() as $key) {
            $data[] = array('id' => $key->kode, 'label' => $key->nama, 'satuan' => $key->pak1, 'satuan_kecil' => $key->pak2, 'jumlah_permintaan' =>$key->sisa_jumlah, 'harga' => $key->harga);
            }
        return $data;
    }
}
?>