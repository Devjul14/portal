<?php
class Mpemesanan_bu extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpemesanan_bu(){
        $this->db->join("permintaan_bu rk","po.no_permintaan=rk.no_permintaan","left");
        $this->db->order_by("tanggal_pemesanan","DESC");
        $q = $this->db->get("pemesanan_bu po");
    	return $q;
    }
    function getdatapemesanan_bu($page,$offset){
       	$cari           = $this->session->userdata('cari_nomor');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $supplier       = $this->session->userdata('supplier');
        $this->db->select("po.*,sf.nama_supplier");
        $this->db->join("permintaan_bu rk","po.no_permintaan=rk.no_permintaan","left");
        $this->db->join("supplier_bu sf","sf.kode_supplier=po.supplier");
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
       	$q = $this->db->get("pemesanan_bu po",$page,$offset);
       	return $q;
    }
    function getpemesananbu_detail($kode){
    	$this->db->where("no_pemesanan",$kode);
    	return $this->db->get("pemesanan_bu")->row();
    }
    function simpanpemesanan_bu($action,$no_pemesanan){
      $no_permintaan = $this->input->post("no_permintaan");
      $supplier      = $this->input->post("supplier");
      $pemesanan_ke  = $this->input->post("pemesanan_ke");
      $tanggal_pemesanan       = date("Y-m-d",strtotime($this->input->post("tanggal_pemesanan")));

      $this->db->where("no_permintaan",$no_permintaan);
      $this->db->where("pemesanan_ke",$pemesanan_ke);
      $this->db->where("tanggal_pemesanan",$tanggal_pemesanan);
      $this->db->where("supplier",$supplier);
      $q = $this->db->get("pemesanan_bu")->row();
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
            $this->db->insert("pemesanan_bu",$data);
            return "success-Data berhasil disimpan";
          break;
                    // $jumlah_pemesanan       = $this->input->post("jumlah_pemesanan");
                    // $jumlah_permintaan      = $this->input->post("jumlah_permintaan");
                    // $harga                  = $this->input->post("harga");
                    // foreach ($jumlah_pemesanan as $key => $value) {
                    //     $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
                    //     $this->db->where("kode_bu",$key);
                    //     $q = $this->db->get("itempermintaan_bu");
                    //     $row = $q->row();
                    //     $sisa_permintaan = $row->sisa_jumlah;

                    //     $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
                    //     $this->db->where("kode_bu",$key);
                    //     $this->db->set("sisa_jumlah",($sisa_permintaan-$value));
                    //     $this->db->update("itempermintaan_bu");
                    //     $data1 = array(
                    //                     'no_pemesanan'      => $no_pemesanan,
                    //                     'kode_bu'         => $key, 
                    //                     'jumlah'            => $value,
                    //                     'jumlah_permintaan' => $jumlah_permintaan[$key],
                    //                     'sisa_pengajuan'    => $value,
                    //                     'harga'             => $harga[$key]
                    //                 );  
                    //     $this->db->insert("itempemesanan_bu",$data1);                  
                    // }
        }
      }
    }
    function simpanitempemesanan_bu(){
      // Insert Item Pemesanan
      $data = array(
                      'no_pemesanan'        => $this->input->post("no_pemesanan"),
                      'kode_bu'           => $this->input->post("kode"),
                      'jumlah'              => $this->input->post("jumlah_pemesanan"),
                      'sisa_pengajuan'      => $this->input->post("jumlah_pemesanan"),
                      'harga'               => $this->input->post("harga"),
                      'jumlah_permintaan'   => $this->input->post("jumlah_permintaan"),

                    );
      $this->db->insert("itempemesanan_bu",$data);

      // Select sisa permintaan
      $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
      $this->db->where("kode_bu",$this->input->post("kode"));
      $q = $this->db->get("itempermintaan_bu");
      $row = $q->row();
      $sisa_permintaan = $row->sisa_jumlah;

      // Update sisa permintaan
      $data1 = array(
                      'sisa_jumlah' => ($sisa_permintaan-$this->input->post("jumlah_pemesanan")),
                    );
      $this->db->where("no_permintaan",$this->input->post("no_permintaan"));
      $this->db->where("kode_bu",$this->input->post("kode"));
      $this->db->update("itempermintaan_bu",$data1);

      return "info-".$this->input->post("nama")." berhasil ditambahkan";
    }
  	function getitempemesanan_bu($no_pemesanan){
      $this->db->select("ip.*,o.nama_bu,irk.sisa_jumlah,o.isi,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil");
      $this->db->join("master_bu o","o.kode_bu=ip.kode_bu","left");
      $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
      $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
      $this->db->join("pemesanan_bu po","po.no_pemesanan=ip.no_pemesanan");
      $this->db->join("permintaan_bu rk","rk.no_permintaan=po.no_permintaan");
      $this->db->join("itempermintaan_bu irk","irk.no_permintaan=rk.no_permintaan and ip.kode_bu=irk.kode_bu and irk.kode_bu=o.kode_bu");
  		$this->db->where("ip.no_pemesanan",$no_pemesanan);
  		$q = $this->db->get("itempemesanan_bu ip");
  		return $q;
  	}
  	function getbu(){
      $this->db->select("f.*,sb.nama_satuan as satuan_besar, f.nama_satuan as satuan_kecil");
      $this->db->join("satuanbesar_bu sb","sb.kode_satuan=f.satuan_besar");
      $this->db->join("satuankecil_bu sk","sk.kode_satuan=f.satuan_kecil");
  		$q = $this->db->get("master_bu f");
  		$data = [];
  		foreach ($q->result() as $key) {
  			$data[] = array('id' => $key->kode_bu, 'label' => $key->nama_bu, 'satuan' => $key->satuan_besar, 'satuan_kecil' => $key->satuan_kecil);
  			}
      	return $data;
    }
    function hapuspemesanan_bu($no_permintaan,$no_pemesanan,$password){
      $this->db->where("no_pemesanan",$no_pemesanan);
      $q2 = $this->db->get("pemesanan_bu")->row();
      $nip = $q2->petugas_pemesanan;

      $this->db->where("nip",$nip);
      $this->db->where("password",md5($password));
      $cek = $this->db->get("petugas_pemesanan");
      if ($cek->num_rows() > 0) {
        $this->db->where("no_pemesanan",$no_pemesanan);
        $q = $this->db->get("itempemesanan_bu");
        foreach ($q->result() as $value) {
          $jumlah_pemesanan = $value->jumlah;
          $this->db->where("no_permintaan",$no_permintaan);
          $this->db->where("kode_bu",$value->kode_bu);
          $q1 = $this->db->get("itempermintaan_bu");
          $row = $q1->row();
          $sisa_permintaan = $row->sisa_jumlah;

          $this->db->where("no_permintaan",$no_permintaan);
          $this->db->where("kode_bu",$value->kode_bu);
          $this->db->set("sisa_jumlah",($sisa_permintaan+$jumlah_pemesanan));
          $this->db->update("itempermintaan_bu");
        }

        $this->db->where("no_permintaan",$no_permintaan);
        $this->db->where("no_pemesanan",$no_pemesanan);
        $this->db->delete("pemesanan_bu");

        $this->db->where("no_pemesanan",$no_pemesanan);
        $this->db->delete("itempemesanan_bu");
        return "danger-Data berhasil dihapus";
      }
      else
      {
        return "warning-Password Tidak Sesuai";
      }
      
    }
    function hapusitempemesanan_bu($no_permintaan,$no_pemesanan,$kode_bu){
      // Select Item Permintaan
      $this->db->where("no_permintaan",$no_permintaan);
      $this->db->where("kode_bu",$kode_bu);
      $q = $this->db->get("itempermintaan_bu")->row();
      $sisa_jumlah = $q->sisa_jumlah;

      // Select item Pemesanan
      $this->db->where("no_pemesanan",$no_pemesanan);
      $this->db->where("kode_bu",$kode_bu);
      $q1 = $this->db->get("itempemesanan_bu")->row();
      $jumlah_pemesanan = $q1->jumlah;

      // Update item permintaan
      $this->db->where("no_permintaan",$no_permintaan);
      $this->db->where("kode_bu",$kode_bu);
      $this->db->set("sisa_jumlah",($sisa_jumlah+$jumlah_pemesanan));
      $this->db->update("itempermintaan_bu");

      // Hapus Item Pemesanan
      $this->db->where("no_pemesanan",$no_pemesanan);
      $this->db->where("kode_bu",$kode_bu);
      $this->db->delete("itempemesanan_bu");

      return "danger-Item telah dihapus";
    }
    function getdepo(){
        return $this->db->get("depo_bu");
    }
    function getpermintaan(){
        return $this->db->get("permintaan_bu");
    }
    function getitempermintaan_bu($no_permintaan){
        $this->db->select("ip.*,o.nama_bu,o.isi,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil");
        $this->db->join("master_bu o","o.kode_bu=ip.kode_bu");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->where("ip.no_permintaan",$no_permintaan);
        $q = $this->db->get("itempermintaan_bu ip");
        return $q;
    }
    function getsupplier(){
        return $this->db->get("supplier_bu");
    }
    function getpetugas_pemesanan(){
        return $this->db->get("petugas_bu");
    }
    function getbu_permintaan($no_permintaan){
        $this->db->select("f.*,ip.*,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil");
        $this->db->join("master_bu f","f.kode_bu=ip.kode_bu");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=f.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=f.satuan_kecil");
        $this->db->where("no_permintaan",$no_permintaan);
        $this->db->where("sisa_jumlah<>",0);
        $q = $this->db->get("itempermintaan_bu ip");
        $data = [];
        foreach ($q->result() as $key) {
            $data[] = array('id' => $key->kode_bu, 'label' => $key->nama_bu, 'satuan' => $key->satuan_besar, 'satuan_kecil' => $key->satuan_kecil, 'jumlah_permintaan' =>$key->sisa_jumlah, 'harga' => $key->harga);
            }
        return $data;
    }
}
?>