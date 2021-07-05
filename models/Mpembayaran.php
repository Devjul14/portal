<?php
class Mpembayaran extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpembayaran_barang(){
      $this->db->join("pembayaran_barang pb","pb.no_penerimaan=po.no_penerimaan","left");
      $this->db->order_by("po.tgl_deadline","DESC");
      $q = $this->db->get("penerimaan_barang po");
      return $q;
    }
    function getdatapembayaran_barang($page,$offset){
      $cari = $this->session->userdata('cari_nomor');
      $this->db->select("po.*,pb.no_pembayaran");
      $this->db->join("pembayaran_barang pb","pb.no_penerimaan=po.no_penerimaan","left");
      if ($cari!="") {
          $this->db->like("po.no_penerimaan",$cari);
      }
      $this->db->order_by("po.tgl_deadline","DESC");
      $q = $this->db->get("penerimaan_barang po",$page,$offset);
      return $q;
    }
    function getitem_penerimaan($no_penerimaan){
      $this->db->select("ip.*,o.pak1,,o.pak1,o.nama,irk.sisa_pengajuan,o.pak2,o.isi");
      $this->db->join("farmasi_data_obat o","o.kode=ip.kode_obat","left");
      $this->db->join("penerimaan_barang po","po.no_penerimaan=ip.no_penerimaan");
      $this->db->join("pemesanan_obat rk","rk.no_pemesanan=po.no_pemesanan");
      $this->db->join("item_pemesanan irk","irk.no_pemesanan=rk.no_pemesanan and ip.kode_obat=irk.kode_obat and irk.kode_obat=o.kode");
      $this->db->where("ip.no_penerimaan",$no_penerimaan);
      $q = $this->db->get("item_penerimaan ip");
      return $q;
    }
    function getpenerimaanbarang_detail($kode){
      $this->db->select("pb.*,s.nama_supplier,pp.nama as nama_petugas");
      $this->db->join("pemesanan_obat po","po.no_pemesanan=pb.no_pemesanan");
      $this->db->join("supplier_farmasi s","po.supplier=s.kode_supplier");
      $this->db->join("petugas_pemesanan pp","po.petugas_pemesanan=pp.nip");
      $this->db->where("no_penerimaan",$kode);
      return $this->db->get("penerimaan_barang pb")->row();
    }
    function simpanpembayaran($no_pembayaran){
      $this->db->where("no_pembayaran",$no_pembayaran);
      $q = $this->db->get("pembayaran_barang")->row();
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
        $this->db->insert("pembayaran_barang",$data);

        $this->db->where("no_penerimaan",$this->input->post("no_penerimaan"));
        $this->db->set("status","1");
        $this->db->update("penerimaan_barang");
        return "success-Pembayaran Berhasil"; 
      }
    }
    function getpembayaran_detail($no_pembayaran){
      $this->db->select("pb.*,pen.*,pb.tanggal,pb.keterangan");
      $this->db->join("penerimaan_barang pen","pen.no_penerimaan=pb.no_penerimaan");
      $this->db->where("no_pembayaran",$no_pembayaran);
      $q = $this->db->get("pembayaran_barang pb");
      return $q->row();
    }
}
?>