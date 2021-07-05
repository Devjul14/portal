<?php
class Mpembayaran_bu extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpembayaran_bu(){
      $this->db->join("pembayaran_bu pb","pb.no_penerimaan=po.no_penerimaan","left");
      $this->db->order_by("po.tgl_deadline","DESC");
      $q = $this->db->get("penerimaan_bu po");
      return $q;
    }
    function getdatapembayaran_bu($page,$offset){
      $cari = $this->session->userdata('cari_nomor');
      $this->db->select("po.*,pb.no_pembayaran");
      $this->db->join("pembayaran_bu pb","pb.no_penerimaan=po.no_penerimaan","left");
      if ($cari!="") {
          $this->db->like("po.no_penerimaan",$cari);
      }
      $this->db->order_by("po.tgl_deadline","DESC");
      $q = $this->db->get("penerimaan_bu po",$page,$offset);
      return $q;
    }
    function getitem_penerimaan($no_penerimaan){
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
    function getpenerimaanbu_detail($kode){
      $this->db->select("pb.*,s.nama_supplier,pp.nama as nama_petugas");
      $this->db->join("pemesanan_bu po","po.no_pemesanan=pb.no_pemesanan");
      $this->db->join("supplier_bu s","po.supplier=s.kode_supplier");
      $this->db->join("petugas_bu pp","po.petugas_pemesanan=pp.nip");
      $this->db->where("no_penerimaan",$kode);
      return $this->db->get("penerimaan_bu pb")->row();
    }
    function simpanpembayaran($no_pembayaran){
      $this->db->where("no_pembayaran",$no_pembayaran);
      $q = $this->db->get("pembayaran_bu")->row();
      if ($q) {
        return "danger-Sudah Dibayar sebelumnya"; 
      } else {
       $data = array(
                      'no_pembayaran'     => $no_pembayaran,
                      'no_penerimaan'     => $this->input->post("no_penerimaan"), 
                      'tanggal'           => date("Y-m-d"),
                      'jumlah_bayar'      => $this->input->post("jumlah_bayar"),

                      'nama_bayar'        => $this->input->post("nama_bayar"),
                      'pangkat_bayar'     => $this->input->post("pangkat_bayar"),
                      'nrp_bayar'         => $this->input->post("nrp_bayar"),
                      'jabatan_bayar'     => $this->input->post("jabatan_bayar"),

                      'nama_penerima'     => $this->input->post("nama_penerima"),
                      'pangkat_penerima'  => $this->input->post("pangkat_penerima"),
                      'jabatan_penerima'  => $this->input->post("jabatan_penerima"),
                      'alamat_penerima'   => $this->input->post("alamat_penerima"),

                      'tahun_anggaran'    => $this->input->post("tahun_anggaran"),
                      'mata_anggaran'     => $this->input->post("mata_anggaran"),
                      'jenis_pengeluaran' => $this->input->post("jenis_pengeluaran"),
                      'terima_dari'       => $this->input->post("terima_dari"),
                      'keperluan'         => $this->input->post("keperluan"),
                      'keterangan'        => $this->input->post("keterangan"),
                    );
        $this->db->insert("pembayaran_bu",$data);

        $this->db->where("no_penerimaan",$this->input->post("no_penerimaan"));
        $this->db->set("status","1");
        $this->db->update("penerimaan_bu");
        return "success-Pembayaran Berhasil"; 
      }
    }
    function getpembayaran_detail($no_pembayaran){
      $this->db->select("pb.*,pen.*,pb.tanggal,pb.keterangan");
      $this->db->join("penerimaan_bu pen","pen.no_penerimaan=pb.no_penerimaan");
      $this->db->where("no_pembayaran",$no_pembayaran);
      $q = $this->db->get("pembayaran_bu pb");
      return $q->row();
    }
}
?>