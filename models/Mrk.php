<?php
class Mrk extends CI_Model{
  	function __construct()
    {
        parent::__construct();
    }
    function getrencana_kebutuhan(){
        $this->db->order_by("tanggal","DESC");
    	return $this->db->get("rencana_kebutuhan");
    }
    function getdatarencana_kebutuhan($page,$offset){
        $tgl1           = $this->session->userdata('tgl1');
        $tgl2           = $this->session->userdata('tgl2');
       	$cari           = $this->session->userdata('cari_nomor');
        if ($tgl1!="" OR $tgl2!="") {
            $this->db->where("tanggal>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("tanggal<=",date("Y-m-d",strtotime($tgl2)));
        }
        if ($cari!="") {
            $this->db->like("no_renbut",$cari);
        }
        $this->db->order_by("tanggal","DESC");
       	$q = $this->db->get("rencana_kebutuhan",$page,$offset);
       	return $q;
    }
    function getrencanakebutuhan_detail($kode){
    	$this->db->where("no_renbut",$kode);
    	return $this->db->get("rencana_kebutuhan")->row();
    }
    function simpanmaster($action,$no_renbut){
		
		switch($action){
			case 'simpan' :
                $data = array(    
                                "no_renbut"     => $no_renbut,
                                "tanggal"       => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"    => $this->input->post("keterangan")
                            );
				$this->db->insert("rencana_kebutuhan",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
                $data = array(    
                                "tanggal"       => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"    => $this->input->post("keterangan")
                            );
				$this->db->where("no_renbut", $this->input->post("no_renbut"));
				$this->db->update("rencana_kebutuhan",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function getitem_rk($no_renbut){
        $this->db->select("rk.*,o.pak2,o.nama,o.pak1,o.isi");
        $this->db->join("farmasi_data_obat o","o.kode=rk.kode_obat","left");
		$this->db->where("rk.no_renbut",$no_renbut);
		$q = $this->db->get("item_rk rk");
		return $q;
	}
	function getobat(){
		$q = $this->db->get("farmasi_data_obat");
		$data = [];
		foreach ($q->result() as $key) {
			$data[] = array('id' => $key->kode, 'label' => $key->nama, 'satuan' => $key->pak1, 'satuan_kecil' => $key->pak2);
			}
    	return $data;
    }
    function simpanitem_rk(){
    	$no_renbut 			= $this->input->post("no_renbut");
    	$kode 	            = $this->input->post("kode");
    	$this->db->where("kode_obat",$kode);
    	$this->db->where("no_renbut",$no_renbut);
    	$q = $this->db->get("item_rk");
        $row = $q->row();

        $this->db->where("kode",$kode);
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();
    	if ($row) {
    		$data = array(
    				"jumlah" 		=> ($row->jumlah+1),
                    "jumlah_kecil"  => (($row->jumlah+1)*$row1->isi),
                    "sisa_jumlah"        => ($row->jumlah+1),
                    "sisa_jumlah_kecil"  => (($row->jumlah+1)*$row1->isi)
    			);
    		$this->db->where("kode_obat",$kode);
    		$this->db->where("no_renbut",$no_renbut);
    		$this->db->update("item_rk",$data);
    		return "info-Data berhasil diedit";
    	} else {
    		$data = array(
    				"kode_obat" 	=> $this->input->post("kode"),
    				"no_renbut" 	=> $this->input->post("no_renbut"),
                    "hps"           => $row1->net_apt,
    				"jumlah" 	    => 1,
                    "jumlah_kecil"  => (1*$row1->isi),
                    "sisa_jumlah"        => 1,
                    "sisa_jumlah_kecil"  => (1*$row1->isi)
    			);
    		$this->db->insert("item_rk",$data);
    		return "success-Data berhasil disimpan";
    	}
    	
    }
    function changedata(){
        $this->db->where("kode",$this->input->post("kode"));
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        $data = array(
                        'jumlah'        => $this->input->post("value"),
                        'jumlah_kecil'  => ($row1->isi*$this->input->post("value")),
                        'sisa_jumlah'        => $this->input->post("value"),
                        'sisa_jumlah_kecil'  => ($row1->isi*$this->input->post("value"))
                    );
        $this->db->where("no_renbut",$this->input->post("no_renbut"));
        $this->db->where("kode_obat",$this->input->post("kode"));
        $this->db->update("item_rk",$data);
    }
    function changedata2(){
        $this->db->where("kode",$this->input->post("kode"));
        $q1 = $this->db->get("farmasi_data_obat");
        $row1 = $q1->row();

        $this->db->where("no_renbut",$this->input->post("no_renbut"));
        $this->db->where("kode_obat",$this->input->post("kode"));
        $this->db->set("hps",$this->input->post("value"));
        $this->db->update("item_rk");
        if ($this->input->post("value") > $row1->net_apt) {
            $this->db->where("kode",$this->input->post("kode"));
            $this->db->set("net_apt",$this->input->post("value"));
            $this->db->update("farmasi_data_obat");
        }

    }
    function hapusrencana_kebutuhan($periode,$no_renbut){
        $this->db->where("periode",$periode);
        $this->db->where("no_renbut",$no_renbut);
        $this->db->delete("rencana_kebutuhan");

        $this->db->where("no_renbut",$no_renbut);
        $this->db->delete("item_rk");

        $this->db->where("periode_pengajuan",$periode);
        $this->db->set("status_pengajuan",0);
        $this->db->update("pengajuan_depo");
        return "danger-Data berhasil dihapus";
    }
    function hapusitemrk($no_renbut,$kode_obat){
        $this->db->where("no_renbut",$no_renbut);
        $this->db->where("kode_obat",$kode_obat);
        $this->db->delete("item_rk");

        return "danger-Item telah dihapus";
    }
    function getpengajuan_depo($periode){
        $this->db->select("p.*,ip.*,,o.pak2,o.nama as nama_obat,o.pak1,o.isi,sum(ip.jumlah) as qty");
        $this->db->join("pengajuan_depo p","p.no_pengajuan=ip.no_pengajuan");
        $this->db->join("farmasi_data_obat o","o.kode=ip.kode_obat");
        $this->db->where("p.periode_pengajuan",$periode);
        // $this->db->where("p.status_pengajuan",0);
        $this->db->group_by("kode_obat");
        $q = $this->db->get("item_pengajuan ip");
        return $q;
    }
    function getperiode(){
        $this->db->where("status_pengajuan",0);
        $this->db->group_by("periode_pengajuan");
        return $this->db->get("pengajuan_depo");
    }
    function simpanrencana_kebutuhan($action,$no_renbut){
        switch($action){
            case 'simpan' :
                $data = array(
                                "no_renbut"     => $no_renbut,
                                "periode"       => $this->input->post("periode"),
                                "tanggal"       => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"    => $this->input->post("keterangan")
                            );
                $this->db->insert("rencana_kebutuhan",$data);

                $jumlah_kebutuhan   = $this->input->post("jumlah_kebutuhan");
                $hps                = $this->input->post("hps");
                $jumlah_kecil       = $this->input->post("jumlah_kecil");

                foreach ($jumlah_kebutuhan as $key => $value) {
                    $data1 = array(
                                    'no_renbut'         => $no_renbut,
                                    'kode_obat'         => $key,
                                    'jumlah'            => $value,
                                    'hps'               => $hps[$key],
                                    'sisa_jumlah'       => $value,
                                    'jumlah_kecil'      => $jumlah_kecil[$key],
                                    'sisa_jumlah_kecil' => $jumlah_kecil[$key]
                                );
                    $this->db->insert("item_rk",$data1);
                }
                $this->db->where("periode_pengajuan",$this->input->post("periode"));
                $this->db->set("status_pengajuan",1);
                $this->db->update("pengajuan_depo");

                return "success-Data berhasil disimpan";
            break;
            case 'edit' :
                $data = array(
                                "tanggal"       => date('Y-m-d',strtotime($this->input->post("tanggal"))),
                                "keterangan"    => $this->input->post("keterangan")
                            );
                $this->db->where("no_renbut",$this->input->post('no_renbut'));
                $this->db->update("rencana_kebutuhan",$data);
                return "success-Data berhasil disimpan";
            break;
        }
    }
    function getrekap_renbut($tgl1,$tgl2){
        $this->db->select("SUM(irk.jumlah) as jumlah,obt.nama,pak1 as satuan,irk.hps,rk.periode");
        $this->db->join("rencana_kebutuhan rk","rk.no_renbut=irk.no_renbut");
        $this->db->join("farmasi_data_obat obt","obt.kode=irk.kode_obat");
        $this->db->where("rk.tanggal>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("rk.tanggal<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->group_by("irk.kode_obat");
        $q = $this->db->get("item_rk irk");
        return $q;
    }
}
?>