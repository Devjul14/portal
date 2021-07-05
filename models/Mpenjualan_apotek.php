<?php
class Mpenjualan_apotek extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpenjualan_apotek(){
        $this->db->select("pd.*,nama_depo");
        $this->db->join("depo_obat do","do.kode_depo=pd.depo");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("penjualan_apotek pd");
        return $q;
    }
    function getdatapenjualan_apotek($page,$offset){
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $depo           = $this->session->userdata('depo');
        $cari           = $this->session->userdata('cari_pengajuan');

        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("tanggal>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("tanggal<=",date("Y-m-d",strtotime($tgl2)));
        }
        if ($cari!="") {
            $this->db->like("no_penjualan",$cari);
        }
        if ($depo!="") {
            $this->db->like("depo",$depo);
        }
        $this->db->select("pd.*,nama_depo");
        $this->db->join("depo_obat do","do.kode_depo=pd.depo");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("penjualan_apotek pd",$page,$offset);
        return $q;
    }
    function getpenjualan_apotek_detail($no_penjualan){
    	$this->db->where("no_penjualan",$no_penjualan);
    	return $this->db->get("penjualan_apotek")->row();
    }
    function getitem_penjualan($no_penjualan){
        $this->db->select("ip.*,o.pak2,o.nama,o.pak1,o.isi");
        $this->db->join("farmasi_data_obat o","o.kode=ip.kode_obat","left");
        $this->db->where("ip.no_penjualan",$no_penjualan);
        $q = $this->db->get("item_penjualan ip");
        return $q;
    }
    function simpanpenjualan_apotek($action,$no_penjualan){
        
        switch($action){
            case 'simpan' :
                $data = array(    
                                "no_penjualan"              => $no_penjualan,
                                "tanggal"                   => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"                => $this->input->post("keterangan"),
                                "depo"                      => $this->input->post("depo"),
                                "pembeli"                   => $this->input->post("pembeli"),
                                "no_rm"                     => $this->input->post("no_rm"),
                                "poli_ruangan"              => $this->input->post("poli_ruangan"),
                                "dokter"                    => $this->input->post("dokter"),

                            );
                $this->db->insert("penjualan_apotek",$data);
                return "success-Data berhasil disimpan";
            break;
        }

    }
    function simpanitem_penjualan(){
        $no_penjualan       = $this->input->post("no_penjualan");
        $kode               = $this->input->post("kode");
        $this->db->where("kode_obat",$kode);
        $this->db->where("no_penjualan",$no_penjualan);
        $q = $this->db->get("item_penjualan");
        $row = $q->row();


        $this->db->where("no_penjualan",$no_penjualan);
        $q2 = $this->db->get("penjualan_apotek");
        $row2 = $q2->row();

        $this->db->where("kode_depo",$row2->depo);
        $q3 = $this->db->get("depo_obat");
        $row3 = $q3->row();
        $stok = $row3->stok;

        $this->db->where("kode",$kode);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        $current_stok = $row1->$stok;
        $stok_keluar   = $this->input->post("qty");
        $stok_akhir   = ($current_stok-$stok_keluar);

        $this->db->where("kode",$kode);
        $this->db->set($stok,$stok_akhir);
        $this->db->update("farmasi_data_obat");

        if ($row) {
            $data = array(
                    "qty"                   => ($row->qty+$this->input->post("qty")),
                );
            $this->db->where("kode_obat",$kode);
            $this->db->where("no_penjualan",$no_penjualan);
            $this->db->update("item_penjualan",$data);
            return "info-Data berhasil diedit";
        } else {
            $data = array(
                    "kode_obat"             => $this->input->post("kode"),
                    "no_penjualan"          => $this->input->post("no_penjualan"),
                    "qty"                   => $this->input->post("qty"),
                    "harga"                 => $row1->hrg_jual,
                    "total_harga"           => $this->input->post("qty")*$row1->hrg_jual,

                );
            $this->db->insert("item_penjualan",$data);
            return "success-Data berhasil disimpan";
        }
        
    }
    function hapusitem_penjualan($no_penjualan,$kode_obat){
        $this->db->where("no_penjualan",$no_penjualan);
        $this->db->where("kode_obat",$kode_obat);
        $q = $this->db->get("item_penjualan");
        $row = $q->row();

        $this->db->where("kode",$kode_obat);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        $this->db->where("no_penjualan",$no_penjualan);
        $q2 = $this->db->get("penjualan_apotek");
        $row2 = $q2->row();

        $this->db->where("kode_depo",$row2->depo);
        $q3 = $this->db->get("depo_obat");
        $row3 = $q3->row();
        $stok = $row3->stok;

        $current_stok = $row1->$stok;
        $stok_batal   = $row->qty;
        $stok_akhir   = ($current_stok+$stok_batal);

        $this->db->where("kode",$kode_obat);
        $this->db->set($stok,$stok_akhir);
        $this->db->update("farmasi_data_obat");


        $this->db->where("no_penjualan",$no_penjualan);
        $this->db->where("kode_obat",$kode_obat);
        $this->db->delete("item_penjualan");

        return "danger-Item telah dihapus";
    }
    function getdokter(){
        return $this->db->get("dokter");
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
    function getobat($depo){
        $this->db->where("kode_depo",$depo);
        $q1 = $this->db->get("depo_obat")->row();
        $stok = $q1->stok;
        $q = $this->db->get("farmasi_data_obat");
        $data = [];
        foreach ($q->result() as $key) {
            $data[] = array('id' => $key->kode, 'label' => $key->nama, 'satuan' => $key->pak1, 'satuan_kecil' => $key->pak2, 'stok' => $key->$stok);
        }
        return $data;
    }
    function getpasien(){
        $data = array();
        $this->db->select("no_pasien,nama_pasien");
        $q = $this->db->get("pasien");
        foreach ($q->result() as $val) {
            $data[] = array('no_rm' => $val->no_pasien, 'nama_pasien' => $val->nama_pasien);
        }
        return $data;
    }
    function getaturan_pakai(){
        return $this->db->get("aturan_pakai");
    }
    function getwaktu(){
        return $this->db->get("waktu");
    }
    function gettakaran(){
        return $this->db->get("takaran");
    }
    function getwaktu_lainnya(){
        return $this->db->get("waktu_lainnya");
    }
    function simpanaturan($no_penjualan){
        $q = $this->getitem_penjualan($no_penjualan);
        $aturan_pakai = $this->input->post("aturan_pakai");
        $waktu = $this->input->post("waktu");
        $takaran = $this->input->post("takaran");
        $pagi = $this->input->post("pagi");
        $siang = $this->input->post("siang");
        $sore = $this->input->post("sore");
        $malem = $this->input->post("malem");
        $waktu_lainnya = $this->input->post("waktu_lainnya");
        foreach ($q->result() as $value) {
            $data = array(
                            'aturan_pakai' => $aturan_pakai[$value->kode_obat], 
                            'waktu' => $waktu[$value->kode_obat], 
                            'takaran' => $takaran[$value->kode_obat], 
                            'pagi' => $pagi[$value->kode_obat], 
                            'siang' => $siang[$value->kode_obat], 
                            'sore' => $sore[$value->kode_obat], 
                            'malem' => $malem[$value->kode_obat], 
                            'waktu_lainnya' => $waktu_lainnya[$value->kode_obat], 
                        );
            $this->db->where("kode_obat",$value->kode_obat);
            $this->db->where("no_penjualan",$no_penjualan);
            $this->db->update("item_penjualan",$data);
        }
        $this->db->where("no_penjualan",$no_penjualan);
        $this->db->set("total",$this->input->post("total"));
        $this->db->update("penjualan_apotek");
        return "info-Data berhasil disimpan";
    }
    function cetak_penjualan($no_penjualan){

        $this->db->join("depo_obat d","d.kode_depo=pa.depo");
        $this->db->where("no_penjualan",$no_penjualan);
        $q = $this->db->get("penjualan_apotek pa");
        return $q->row();
    }
    function changeharga(){
        $harga = str_replace(".", "", $this->input->post("value"));
        $this->db->where("no_penjualan",$this->input->post("no_penjualan"));
        $this->db->where("kode_obat",$this->input->post("kode"));
        $this->db->set("harga",$harga);
        $this->db->update("item_penjualan");
    }
}
?>