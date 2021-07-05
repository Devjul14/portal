<?php
class Mpengajuan_bu extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getdepo(){
        return $this->db->get("depo_bu");
    }
    function getpengajuan_bu(){
        $this->db->select("pd.*,nama_depo");
        $this->db->join("depo_obat do","do.kode_depo=pd.depo");
        $this->db->order_by("tanggal_pengajuan","DESC");
        $q = $this->db->get("pengajuan_bu pd");
        return $q;
    }
    function getdatapengajuan_bu($page,$offset){
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $depo           = $this->session->userdata('depo');
        $cari           = $this->session->userdata('cari_pengajuan');

        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("tanggal_pengajuan>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("tanggal_pengajuan<=",date("Y-m-d",strtotime($tgl2)));
        }
        if ($cari!="") {
            $this->db->like("no_pengajuan",$cari);
        }
        if ($depo!="") {
            $this->db->like("depo",$depo);
        }
        $this->db->select("pd.*,nama_depo");
        $this->db->join("depo_bu do","do.kode_depo=pd.depo");
        $this->db->order_by("tanggal_pengajuan","DESC");
        $q = $this->db->get("pengajuan_bu pd",$page,$offset);
        return $q;
    }
    function getpengajuanbu_detail($kode){
        $this->db->where("no_pengajuan",$kode);
        return $this->db->get("pengajuan_bu")->row();
    }
    function simpanpengajuan($action,$no_pengajuan){
        
        switch($action){
            case 'simpan' :
                $data = array(    
                                "no_pengajuan"              => $no_pengajuan,
                                "tanggal_pengajuan"         => date('Y-m-d',strtotime($this->input->post("tanggal_pengajuan"))),
                                "keterangan_pengajuan"      => $this->input->post("keterangan_pengajuan"),
                                "depo"                      => $this->input->post("depo"),
                                "periode_pengajuan"         => $this->input->post("periode_pengajuan"),

                            );
                $this->db->insert("pengajuan_bu",$data);
                return "success-Data berhasil disimpan";
            break;
            case 'edit' :
                $data = array(    
                                "keterangan_pengajuan"      => $this->input->post("keterangan_pengajuan"),
                                "depo"                      => $this->input->post("depo"),
                            );
                $this->db->where("no_pengajuan", $this->input->post("no_pengajuan"));
                $this->db->update("pengajuan_bua",$data);
                return "info-Data berhasil diubah";
            break;
        }

    }
    function getitem_pengajuan($no_pengajuan){
        $this->db->select("rk.*,o.nama_bu,sb.nama_satuan as satuan_besar,sk.nama_satuan as satuan_kecil,o.isi");
        $this->db->join("master_bu o","o.kode_bu=rk.kode_bu","inner");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->where("rk.no_pengajuan",$no_pengajuan);
        $q = $this->db->get("itempengajuan_bu rk");
        return $q;
    }
    function simpanitem_pengajuan(){
        $no_pengajuan       = $this->input->post("no_pengajuan");
        $kode               = $this->input->post("kode");
        $this->db->where("kode_bu",$kode);
        $this->db->where("no_pengajuan",$no_pengajuan);
        $q = $this->db->get("itempengajuan_bu");
        $row = $q->row();

        $this->db->where("kode_bu",$kode);
        $q1 = $this->db->get("master_bu");
        $row1 = $q1->row();
        if ($row) {
            $data = array(
                    "jumlah"                => ($row->jumlah+$this->input->post("jumlah_pengajuan")),
                    "jumlah_kecil"          => (($row->jumlah+$this->input->post("jumlah_pengajuan"))*$row1->isi),
                    "sisa_jumlah"           => ($row->jumlah+$this->input->post("jumlah_pengajuan")),
                    "sisa_jumlah_kecil"     => (($row->jumlah+$this->input->post("jumlah_pengajuan"))*$row1->isi)
                );
            $this->db->where("kode_bu",$kode);
            $this->db->where("no_pengajuan",$no_pengajuan);
            $this->db->update("itempengajuan_bu",$data);
            return "info-Data berhasil diedit";
        } else {
            $data = array(
                    "kode_bu"               => $this->input->post("kode"),
                    "no_pengajuan"          => $this->input->post("no_pengajuan"),
                    "hps"                   => $row1->harga_beli,
                    "jumlah"                => $this->input->post("jumlah_pengajuan"),
                    "jumlah_kecil"          => ($this->input->post("jumlah_pengajuan")*$row1->isi),
                    "sisa_jumlah"           => $this->input->post("jumlah_pengajuan"),
                    "sisa_jumlah_kecil"     => ($this->input->post("jumlah_pengajuan")*$row1->isi)
                );
            $this->db->insert("itempengajuan_bu",$data);
            return "success-Data berhasil disimpan";
        }
        
    }
    function changedata_pengajuan(){
        $this->db->where("kode_bu",$this->input->post("kode"));
        $q1 = $this->db->get("master_bu");
        $row1 = $q1->row();

        $data = array(
                        'jumlah'                => $this->input->post("value"),
                        'jumlah_kecil'          => ($row1->isi*$this->input->post("value")),
                        'sisa_jumlah'           => $this->input->post("value"),
                        'sisa_jumlah_kecil'     => ($row1->isi*$this->input->post("value"))
                    );
        $this->db->where("no_pengajuan",$this->input->post("no_pengajuan"));
        $this->db->where("kode_bu",$this->input->post("kode"));
        $this->db->update("itempengajuan_bu",$data);
    }
    function hapusitem_pengajuan($no_pengajuan,$kode_bu){
        $this->db->where("no_pengajuan",$no_pengajuan);
        $this->db->where("kode_bu",$kode_bu);
        $this->db->delete("itempengajuan_bu");

        return "danger-Item telah dihapus";
    }
    function getrekap_permintaan($tgl1,$tgl2){
        $this->db->select("SUM(irk.jumlah) as jumlah,obt.nama,pak1 as satuan,irk.harga");
        $this->db->join("permintaan_obat rk","rk.no_permintaan=irk.no_permintaan");
        $this->db->join("farmasi_data_obat obt","obt.kode=irk.kode_obat");
        $this->db->where("rk.tanggal>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("rk.tanggal<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->group_by("irk.kode_obat");
        $q = $this->db->get("item_permintaan irk");
        return $q;
    }
    function getbu(){
        $this->db->select("mb.*,sb.nama_satuan as satuan_besar,sk.nama_satuan as satuan_kecil");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=mb.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=mb.satuan_kecil");
        $q = $this->db->get("master_bu mb");
        $data = [];
        foreach ($q->result() as $key) {
            $data[] = array('id' => $key->kode_bu, 'label' => $key->nama_bu, 'satuan' => $key->satuan_besar, 'satuan_kecil' => $key->satuan_besar);
            }
        return $data;
    }
}
?>