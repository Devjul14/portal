<?php
class Mpermintaan_bu extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getpermintaan_bu(){
        $this->db->select("po.*");
        $this->db->join("rk_bu rk","po.no_renbut=rk.no_renbut","left");
        $this->db->order_by("tanggal","DESC");
        $q = $this->db->get("permintaan_bu po");
    	return $q;
    }
    function getdatapermintaan_bu($page,$offset){
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
       	$q = $this->db->get("permintaan_bu po",$page,$offset);
       	return $q;
    }
    function getpermintaanobat_detail($kode){
    	$this->db->where("no_permintaan",$kode);
    	return $this->db->get("permintaan_bu")->row();
    }
    function simpanpermintaan_bu($action,$no_permintaan){
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
				$this->db->insert("permintaan_bu",$data);
                foreach ($jumlah_kebutuhan as $key => $value) {
                    $this->db->where("no_renbut",$this->input->post("no_renbut"));
                    $this->db->where("kode_bu",$key);
                    $q = $this->db->get("itemrk_bu");
                    $row = $q->row();
                    $sisa_rk = $row->sisa_jumlah;

                    $this->db->where("no_renbut",$this->input->post("no_renbut"));
                    $this->db->where("kode_bu",$key);
                    $this->db->set("sisa_jumlah",($sisa_rk-$value));
                    $this->db->update("itemrk_bu");
                    $data1 = array(
                                    'no_permintaan' => $no_permintaan,
                                    'kode_bu'     => $key, 
                                    'jumlah'        => $value,
                                    'sisa_jumlah'   => $value,
                                    'jumlah_rk'     => $jumlah_rk[$key],
                                    'harga'         => $harga[$key]
                                );
                    $sisa_jumlah = $this->input->post("sisa_jumlah");
                    if ($sisa_jumlah[$key]<$value) {
                        $msg = "danger-Jumlah melebihi rencana kebutuhan";
                    }else{
                        $this->db->insert("itempermintaan_bu",$data1);
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
                                    'kode_bu'     => $key, 
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
        $this->db->select("ip.*,o.nama_bu,irk.sisa_jumlah,sb.nama_satuan as satuan_besar,sk.nama_satuan as satuan_kecil");
        $this->db->join("master_bu o","o.kode_bu=ip.kode_bu","left");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->join("permintaan_bu po","po.no_permintaan=ip.no_permintaan");
        $this->db->join("rk_bu rk","rk.no_renbut=po.no_renbut");
        $this->db->join("itemrk_bu irk","irk.no_renbut=rk.no_renbut and ip.kode_bu=irk.kode_bu and irk.kode_bu=o.kode_bu");
		$this->db->where("ip.no_permintaan",$no_permintaan);
		$q = $this->db->get("itempermintaan_bu ip");
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
        return $this->db->get("depo_bu");
    }
    function getrenbut(){
        return $this->db->get("rk_bu");
    }
    function getitem_rk($no_renbut){
        $this->db->select("rk.*,o.nama_bu,sb.nama_satuan as satuan_besar, sk.nama_satuan as satuan_kecil");
        $this->db->join("master_bu o","o.kode_bu=rk.kode_bu");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->where("rk.no_renbut",$no_renbut);
        $q = $this->db->get("itemrk_bu rk");
        return $q;
    }
    function getrekap_permintaan($tgl1,$tgl2){
        $this->db->select("SUM(irk.jumlah) as jumlah,o.nama_bu,sb.nama_satuan as satuan,irk.harga");
        $this->db->join("permintaan_bu rk","rk.no_permintaan=irk.no_permintaan");
        $this->db->join("master_bu o","o.kode_bu=irk.kode_bu");
        $this->db->join("satuanbesar_bu sb","sb.kode_satuan=o.satuan_besar");
        $this->db->join("satuankecil_bu sk","sk.kode_satuan=o.satuan_kecil");
        $this->db->where("rk.tanggal>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("rk.tanggal<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->group_by("irk.kode_bu");
        $q = $this->db->get("itempermintaan_bu irk");
        return $q;
    }
}
?>