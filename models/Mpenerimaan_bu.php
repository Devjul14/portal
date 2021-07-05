<?php
class Mpenerimaan_bu extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpenerimaan_bu(){
      $this->db->join("pemesanan_bu rk","po.no_pemesanan=rk.no_pemesanan","left");
      $this->db->order_by("tanggal","DESC");
      $q = $this->db->get("penerimaan_bu po");
    	return $q;
    }
    function getdatapenerimaan_bu($page,$offset){
       	$cari           = $this->session->userdata('cari_nomor');
        $supplier       = $this->session->userdata('supplier');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $this->db->select("po.*");
        $this->db->join("pemesanan_bu rk","po.no_pemesanan=rk.no_pemesanan","left");
       	if ($cari!="") {
          $this->db->like("po.no_pemesanan",$cari);
        }
        if ($tgl1!="" OR $tgl2!="") {
          $this->db->where("po.tanggal>=",date("Y-m-d",strtotime($tgl1)));
          $this->db->where("po.tanggal<=",date("Y-m-d",strtotime($tgl2)));
        }
        if ($supplier!="") {
          $this->db->where("rk.supplier",$supplier);
        }
        $this->db->order_by("po.tanggal","DESC");
       	$q = $this->db->get("penerimaan_bu po",$page,$offset);
       	return $q;
    }
    function getpenerimaanbu_detail($kode){
      $this->db->select("pb.*,s.nama_supplier,pp.nama as nama_petugas");
      $this->db->join("pemesanan_bu po","po.no_pemesanan=pb.no_pemesanan");
      $this->db->join("supplier_bu s","po.supplier=s.kode_supplier");
      $this->db->join("petugas_bu pp","po.petugas_pemesanan=pp.nip");
    	$this->db->where("no_penerimaan",$kode);
    	return $this->db->get("penerimaan_bu pb")->row();
    }
    function simpanpenerimaan_bu($action,$no_penerimaan){
  		switch($action){
  			case 'simpan' :

                  $jumlah_pemesanan       = $this->input->post("jumlah_pemesanan");
                  $jumlah_penerimaan      = $this->input->post("jumlah_penerimaan");
                  $harga                  = $this->input->post("harga");

                  $expire_date            = $this->input->post("expire_date");
                  $batch                  = $this->input->post("batch");
                  $disc                   = $this->input->post("disc");
                  $disc_rupiah            = $this->input->post("disc_rupiah");

                  $jml = $tjml =0;
                  foreach ($jumlah_penerimaan as $key => $value) {
                    $this->db->where("no_pemesanan",$this->input->post("no_pemesanan"));
                    $this->db->where("kode_bu",$key);
                    $q = $this->db->get("itempemesanan_bu");
                    $row = $q->row();
                    $sisa_pemesanan = $row->sisa_pengajuan;

                    $this->db->where("no_pemesanan",$this->input->post("no_pemesanan"));
                    $this->db->where("kode_bu",$key);
                    $this->db->set("sisa_pengajuan",($sisa_pemesanan-$value));
                    $this->db->update("itempemesanan_bu");
                    $tharga = ($value*$harga[$key]);
                    $pajak  = $tharga*(10/100);
                    $pph    = $tharga*(1.5/100);
                    if ($disc[$key]!=0) {
                      $diskon = $disc_rupiah[$key];
                    } else {
                      $diskon = $tharga*($disc[$key]/100);
                    }
                    
                    $data1 = array(
                                    'no_penerimaan'     => $no_penerimaan,
                                    'kode_bu'           => $key, 
                                    'jumlah'            => $value,
                                    'harga'             => $harga[$key],
                                    'disc'              => $disc[$key],
                                    'disc_rupiah'       => $disc_rupiah[$key],
                                    'ppn'               => 10,
                                    'pph22'             => 1.50,
                                    'batch'             => $batch[$key],
                                    'expire_date'       => date('Y-m-d',strtotime($expire_date[$key])),
                                    'total_harga'       => $tharga-$diskon+$pajak,
                                );  
                    $this->db->insert("itempenerimaan_bu",$data1);
                    $jml += $tharga;
                    $tjml += $tharga-$diskon+$pajak; 

                    $this->db->where("kode_bu",$key);
                    $obt = $this->db->get("master_bu")->row();
                    $stok_gudang = $obt->stok;

                    $this->db->where("kode_bu",$key);
                    $this->db->set("stok",($stok_gudang+$value));
                    $this->db->update("master_bu");

                    // if ($harga[$key]>=$harga_obat_lama) {
                    //   $this->db->where("kode",$key);
                    //   $this->db->set("net_apt2",$harga[$key]);
                    //   $this->db->update("farmasi_data_obat");
                    // }
                  }
                  $this->db->where("jumlah",0);
                  $this->db->delete("itempenerimaan_bu");
                  $data = array(
                                "no_penerimaan"         => $no_penerimaan,
                                "no_pemesanan"          => $this->input->post("no_pemesanan"),
                                "no_faktur"             => $this->input->post("no_faktur"),
                                "no_invoice"            => $this->input->post("no_invoice"),
                                "tanggal"               => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "tgl_deadline"          => date('Y-m-d',strtotime($this->input->post("tgl_deadline"))),
                                "tgl_kontrabon"         => date('Y-m-d',strtotime($this->input->post("tgl_kontrabon"))),
                                "keterangan"            => $this->input->post("keterangan"),
                                "asal_barang"           => $this->input->post("asal_barang"),
                                "jumlah"                => $jml,
                                "total"                 => $tjml
                              );
                  $this->db->insert("penerimaan_bu",$data);
                  return "success-Data berhasil disimpan";
  			break;
		  }

	}
	function getitempenerimaan_bu($no_penerimaan){
    $this->db->select("ip.*,o.nama_bu,irk.sisa_pengajuan,o.isi,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil");
    $this->db->join("master_bu o","o.kode_bu=ip.kode_bu","left");
    $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
    $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
    $this->db->join("penerimaan_bu po","po.no_penerimaan=ip.no_penerimaan");
    $this->db->join("pemesanan_bu rk","rk.no_pemesanan=po.no_pemesanan");
    $this->db->join("itempemesanan_bu irk","irk.no_pemesanan=rk.no_pemesanan and ip.kode_bu=irk.kode_bu and irk.kode_bu=o.kode_bu");
		$this->db->where("ip.no_penerimaan",$no_penerimaan);
		$q = $this->db->get("itempenerimaan_bu ip");
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
    function hapuspenerimaan_barang($no_pemesanan,$no_penerimaan){
      // $this->db->where("no_pemesanan",$no_pemesanan);
      // $q2 = $this->db->get("pemesanan_obat")->row();
      // $nip = $q2->petugas_pemesanan;

      // $this->db->where("nip",$nip);
      // $this->db->where("password",md5($password));
      // $cek = $this->db->get("petugas_pemesanan");
      // if ($cek->num_rows() > 0) {
        $this->db->where("no_penerimaan",$no_penerimaan);
        $q = $this->db->get("item_penerimaan");
        foreach ($q->result() as $value) {
          $jumlah_penerimaan = $value->jumlah;
          $this->db->where("no_pemesanan",$no_pemesanan);
          $this->db->where("kode_bu",$value->kode_bu);
          $q1 = $this->db->get("item_pemesanan");
          $row = $q1->row();
          $sisa_pemesanan = $row->sisa_pengajuan;

          $this->db->where("no_pemesanan",$no_pemesanan);
          $this->db->where("kode_bu",$value->kode_bu);
          $this->db->set("sisa_pengajuan",($sisa_pemesanan+$jumlah_penerimaan));
          $this->db->update("item_pemesanan");
        }

        $this->db->where("no_pemesanan",$no_pemesanan);
        $this->db->where("no_penerimaan",$no_penerimaan);
        $this->db->delete("penerimaan_barang");

        $this->db->where("no_penerimaan",$no_penerimaan);
        $this->db->delete("item_penerimaan");
        return "danger-Data berhasil dihapus";
      // }
      // else
      // {
      //   return "warning-Password Tidak Sesuai";
      // }
      
    }
    function getdepo(){
        return $this->db->get("depo_obat");
    }
    function getpemesanan(){
        return $this->db->get("pemesanan_bu");
    }
    function getitempemesanan_bu($no_pemesanan){
        $this->db->select("ip.*,o.nama_bu,o.isi,sb.nama_satuan as satuan_besar,sk.nama_satuan as satuan_kecil");
        $this->db->join("master_bu o","o.kode_bu=ip.kode_bu");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->where("ip.no_pemesanan",$no_pemesanan);
        $q = $this->db->get("itempemesanan_bu ip");
        return $q;
    }
    function getsupplier(){
        return $this->db->get("supplier_bu");
    }
    function getpetugas_pemesanan(){
        return $this->db->get("petugas_pemesanan");
    }
    function getpemesanan_detail($no_pemesanan){
      $this->db->select("po.*,s.nama_supplier,pp.nama as nama_petugas");
      $this->db->join("supplier_bu s","po.supplier=s.kode_supplier");
      $this->db->join("petugas_bu pp","po.petugas_pemesanan=pp.nip");
      $this->db->where("no_pemesanan",$no_pemesanan);
      $q = $this->db->get("pemesanan_bu po");
      return $q->row();
    }
    function getasal_barang(){
      return $this->db->get("asal_barang");
    }
    function getrekap_penerimaan($tgl1,$tgl2){
        $this->db->select("SUM(irk.jumlah) as jumlah,o.nama_bu,sb.nama_satuan as satuan,irk.harga,no_faktur,tanggal,nama_supplier");
        $this->db->join("penerimaan_bu rk","rk.no_penerimaan=irk.no_penerimaan");
        $this->db->join("master_bu o","o.kode_bu=irk.kode_bu");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->join("pemesanan_bu pob","pob.no_pemesanan=rk.no_pemesanan");
        $this->db->join("supplier_bu sf","sf.kode_supplier=pob.supplier");
        $this->db->where("rk.tgl_rekap>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("rk.tgl_rekap<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->group_by("irk.kode_bu");
        $q = $this->db->get("itempenerimaan_bu irk");
        return $q;
    }
    function simpantanggal_rekap($no_penerimaan,$tgl){
      $tanggal = date("Y-m-d",strtotime($tgl));
      $this->db->where("no_penerimaan",$no_penerimaan);
      $this->db->set("tgl_rekap",$tanggal);
      $this->db->update("penerimaan_bu");
      return "success-Tanggal rekap berhasil diinput";
    }
}
?>