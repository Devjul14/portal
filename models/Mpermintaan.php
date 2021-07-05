<?php
class Mpermintaan extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpermintaan_obat(){
        $this->db->select("po.*");
        $this->db->join("rencana_kebutuhan rk","po.no_renbut=rk.no_renbut","left");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("permintaan_obat po");
    	return $q;
    }
    function getdatapermintaan_obat($page,$offset){
       	$cari           = $this->session->userdata('cari_nomor');
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
        $this->db->select("po.*");
        $this->db->join("rencana_kebutuhan rk","po.no_renbut=rk.no_renbut","left");
       	if ($cari!="") {
            $this->db->like("po.no_permintaan",$cari);
        }
        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("po.tanggal>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("po.tanggal<=",date("Y-m-d",strtotime($tgl2)));
        }
        $this->db->order_by("po.tanggal","DESC");
       	$q = $this->db->get("permintaan_obat po",$page,$offset);
       	return $q;
    }
    function getpermintaanobat_detail($kode){
    	$this->db->where("no_permintaan",$kode);
    	return $this->db->get("permintaan_obat")->row();
    }
    function simpanpermintaan($action,$no_permintaan){
		switch($action){
			case 'simpan' :
                $data = array(
                                "no_permintaan"     => $no_permintaan,
                                "no_renbut"         => $this->input->post("no_renbut"),
                                "pegawai"           => $this->input->post("pegawai"),
                                "depo"              => $this->input->post("depo"),
                                "tanggal"           => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"        => $this->input->post("keterangan")
                            );
                $jumlah_kebutuhan   = $this->input->post("jumlah_kebutuhan");
                $jumlah_rk          = $this->input->post("jumlah_rk");
                $harga              = $this->input->post("harga");
				$this->db->insert("permintaan_obat",$data);
                foreach ($jumlah_kebutuhan as $key => $value) {
                    $this->db->where("no_renbut",$this->input->post("no_renbut"));
                    $this->db->where("kode_obat",$key);
                    $q = $this->db->get("item_rk");
                    $row = $q->row();
                    $sisa_rk = $row->sisa_jumlah;

                    $this->db->where("no_renbut",$this->input->post("no_renbut"));
                    $this->db->where("kode_obat",$key);
                    $this->db->set("sisa_jumlah",($sisa_rk-$value));
                    $this->db->update("item_rk");
                    $data1 = array(
                                    'no_permintaan' => $no_permintaan,
                                    'kode_obat'     => $key, 
                                    'jumlah'        => $value,
                                    'sisa_jumlah'   => $value,
                                    'jumlah_rk'     => $jumlah_rk[$key],
                                    'harga'         => $harga[$key]
                                );
                    $sisa_jumlah = $this->input->post("sisa_jumlah");
                    if ($sisa_jumlah[$key]<$value) {
                        $msg = "danger-Jumlah melebihi rencana kebutuhan";
                    }else{
                        $this->db->insert("item_permintaan",$data1);
				        $msg = "success-Data berhasil disimpan";
                    }
                    
                }
                return $msg;
			break;
			case 'edit' :
                $data = array(
                                "pegawai"           => $this->input->post("pegawai"),
                                "depo"              => $this->input->post("depo"),
                                "tanggal"           => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"        => $this->input->post("keterangan")
                            );
                $jumlah_kebutuhan   = $this->input->post("jumlah_kebutuhan");
                $jumlah_rk          = $this->input->post("jumlah_rk");
                $harga              = $this->input->post("harga");

                $this->db->where("no_permintaan", $this->input->post("no_permintaan"));
                $this->db->delete("item_permintaan");

				$this->db->where("no_renbut", $this->input->post("no_renbut"));
                $this->db->where("no_permintaan", $this->input->post("no_permintaan"));
				$this->db->update("permintaan_obat",$data);

                foreach ($jumlah_kebutuhan as $key => $value) {
                    $data1 = array(
                                    'no_permintaan' => $this->input->post("no_permintaan"),
                                    'kode_obat'     => $key, 
                                    'jumlah'        => $value,
                                    'sisa_jumlah'   => $value,
                                    'jumlah_rk'     => $jumlah_rk[$key],
                                    'harga'         => $harga[$key]
                                );
                    $sisa_jumlah = $this->input->post("sisa_jumlah");
                    if ($sisa_jumlah[$key]<$value) {
                        $msg = "danger-Jumlah melebihi rencana kebutuhan";
                    }else{
                        $this->db->insert("item_permintaan",$data1);
                        $msg = "info-Data berhasil diubah";
                    }
                }
                return $msg;
			break;
		}

	}
	function getitem_permintaan($no_permintaan){
        $this->db->select("ip.*,o.pak1,,o.pak1,o.nama,irk.sisa_jumlah");
        $this->db->join("farmasi_data_obat o","o.kode=ip.kode_obat","left");
        $this->db->join("permintaan_obat po","po.no_permintaan=ip.no_permintaan");
        $this->db->join("rencana_kebutuhan rk","rk.no_renbut=po.no_renbut");
        $this->db->join("item_rk irk","irk.no_renbut=rk.no_renbut and ip.kode_obat=irk.kode_obat and irk.kode_obat=o.kode");
		$this->db->where("ip.no_permintaan",$no_permintaan);
		$q = $this->db->get("item_permintaan ip");
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
    function changedata(){
        $this->db->where("no_renbut",$this->input->post("no_renbut"));
        $this->db->where("kode_obat",$this->input->post("kode"));
        $this->db->set("jumlah",$this->input->post("value"));
        $this->db->update("item_rk");
    }
    function changedata2(){
        $this->db->where("no_renbut",$this->input->post("no_renbut"));
        $this->db->where("kode_obat",$this->input->post("kode"));
        $this->db->set("hps",$this->input->post("value"));
        $this->db->update("item_rk");
    }
    function hapusitemrk($no_renbut,$kode){
        $this->db->where("no_renbut",$no_renbut);
        $this->db->where("kode_obat",$kode);
        $this->db->delete("item_rk");
        return "danger-Data berhasil dihapus";
    }
    function hapuspermintaan_obat($no_renbut,$no_permintaan){
        $this->db->where("no_permintaan",$no_permintaan);
        $q = $this->db->get("item_permintaan");
        foreach ($q->result() as $value) {
            $jumlah_permintaan = $value->jumlah;
            $this->db->where("no_renbut",$no_renbut);
            $this->db->where("kode_obat",$value->kode_obat);
            $q1 = $this->db->get("item_rk");
            $row = $q1->row();
            $sisa_renbut = $row->sisa_jumlah;

            $this->db->where("no_renbut",$no_renbut);
            $this->db->where("kode_obat",$value->kode_obat);
            $this->db->set("sisa_jumlah",($sisa_renbut+$jumlah_permintaan));
            $this->db->update("item_rk");
        }


        $this->db->where("no_renbut",$no_renbut);
        $this->db->where("no_permintaan",$no_permintaan);
        $this->db->delete("permintaan_obat");

        $this->db->where("no_permintaan",$no_permintaan);
        $this->db->delete("item_permintaan");
        return "danger-Data berhasil dihapus";
    }
    function getdepo(){
        return $this->db->get("depo_obat");
    }
    function getrenbut(){
        return $this->db->get("rencana_kebutuhan");
    }
    function getitem_rk($no_renbut){
        $this->db->select("rk.*,o.nama,o.pak1");
        $this->db->join("farmasi_data_obat o","o.kode=rk.kode_obat");
        $this->db->where("rk.no_renbut",$no_renbut);
        $q = $this->db->get("item_rk rk");
        return $q;
    }
    function getpengajuan_depo(){
        $this->db->select("pd.*,nama_depo");
        $this->db->join("depo_obat do","do.kode_depo=pd.depo");
        $this->db->order_by("tanggal_pengajuan","DESC");
        $q = $this->db->get("pengajuan_depo pd");
        return $q;
    }
    function getdatapengajuan_depo($page,$offset){
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
        $this->db->join("depo_obat do","do.kode_depo=pd.depo");
        $this->db->order_by("tanggal_pengajuan","DESC");
        $q = $this->db->get("pengajuan_depo pd",$page,$offset);
        return $q;
    }
    function getpengajuandepo_detail($kode){
        $this->db->where("no_pengajuan",$kode);
        return $this->db->get("pengajuan_depo")->row();
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
                $this->db->insert("pengajuan_depo",$data);
                return "success-Data berhasil disimpan";
            break;
            case 'edit' :
                $data = array(    
                                "keterangan_pengajuan"      => $this->input->post("keterangan_pengajuan"),
                                "depo"                      => $this->input->post("depo"),
                            );
                $this->db->where("no_pengajuan", $this->input->post("no_pengajuan"));
                $this->db->update("pengajuan_depo",$data);
                return "info-Data berhasil diubah";
            break;
        }

    }
    function getitem_pengajuan($no_pengajuan){
        $this->db->select("rk.*,o.pak2,o.nama,o.pak1,o.isi");
        $this->db->join("farmasi_data_obat o","o.kode=rk.kode_obat","left");
        $this->db->where("rk.no_pengajuan",$no_pengajuan);
        $q = $this->db->get("item_pengajuan rk");
        return $q;
    }
    function simpanitem_pengajuan(){
        $no_pengajuan       = $this->input->post("no_pengajuan");
        $kode               = $this->input->post("kode");
        $this->db->where("kode_obat",$kode);
        $this->db->where("no_pengajuan",$no_pengajuan);
        $q = $this->db->get("item_pengajuan");
        $row = $q->row();

        $this->db->where("kode",$kode);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();
        if ($row) {
            $data = array(
                    "jumlah"                => ($row->jumlah+$this->input->post("jumlah_pengajuan")),
                    "jumlah_kecil"          => (($row->jumlah+$this->input->post("jumlah_pengajuan"))*$row1->isi),
                    "sisa_jumlah"           => ($row->jumlah+$this->input->post("jumlah_pengajuan")),
                    "sisa_jumlah_kecil"     => (($row->jumlah+$this->input->post("jumlah_pengajuan"))*$row1->isi)
                );
            $this->db->where("kode_obat",$kode);
            $this->db->where("no_pengajuan",$no_pengajuan);
            $this->db->update("item_pengajuan",$data);
            return "info-Data berhasil diedit";
        } else {
            $data = array(
                    "kode_obat"             => $this->input->post("kode"),
                    "no_pengajuan"          => $this->input->post("no_pengajuan"),
                    "hps"                   => $row1->net_apt2,
                    "jumlah"                => $this->input->post("jumlah_pengajuan"),
                    "jumlah_kecil"          => ($this->input->post("jumlah_pengajuan")*$row1->isi),
                    "sisa_jumlah"           => $this->input->post("jumlah_pengajuan"),
                    "sisa_jumlah_kecil"     => ($this->input->post("jumlah_pengajuan")*$row1->isi)
                );
            $this->db->insert("item_pengajuan",$data);
            return "success-Data berhasil disimpan";
        }
        
    }
    function changedata_pengajuan(){
        $this->db->where("kode",$this->input->post("kode"));
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        $data = array(
                        'jumlah'        => $this->input->post("value"),
                        'jumlah_kecil'  => ($row1->isi*$this->input->post("value")),
                        'sisa_jumlah'        => $this->input->post("value"),
                        'sisa_jumlah_kecil'  => ($row1->isi*$this->input->post("value"))
                    );
        $this->db->where("no_pengajuan",$this->input->post("no_pengajuan"));
        $this->db->where("kode_obat",$this->input->post("kode"));
        $this->db->update("item_pengajuan",$data);
    }
    function changedata_pengajuan2(){
        $this->db->where("kode",$this->input->post("kode"));
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        $this->db->where("no_pengajuan",$this->input->post("no_pengajuan"));
        $this->db->where("kode_obat",$this->input->post("kode"));
        $this->db->set("hps",$this->input->post("value"));
        $this->db->update("item_pengajuan");
        if ($this->input->post("value") > $row1->net_apt2) {
            $this->db->where("kode",$this->input->post("kode"));
            $this->db->set("net_apt2",$this->input->post("value"));
            $this->db->update("farmasi_data_obat");
        }

    }
    function hapusitem_pengajuan($no_pengajuan,$kode_obat){
        $this->db->where("no_pengajuan",$no_pengajuan);
        $this->db->where("kode_obat",$kode_obat);
        $this->db->delete("item_pengajuan");

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
}
?>