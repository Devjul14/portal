<?php
class Mparkir extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
    function getparkir($page,$offset){
    	$tgl1 = $this->session->userdata("tgl1");
		$tgl2 = $this->session->userdata("tgl2");
    	if ($tgl1!="" || $tgl2!="") {
			$this->db->where("periode>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("periode<=",date("Y-m-d",strtotime($tgl2)));
		}
    	$query = $this->db->get("parkir",$page,$offset);
		return $query;
    }
    function getjumlahparkir(){
    	$tgl1 = $this->session->userdata("tgl1");
		$tgl2 = $this->session->userdata("tgl2");
    	if ($tgl1!="" || $tgl2!="") {
			$this->db->where("periode>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("periode<=",date("Y-m-d",strtotime($tgl2)));
		}
    	$query = $this->db->get("parkir");
		return $query->num_rows();
    }
    function getparkir_detail($id){
    	$this->db->where("id",$id);
    	$query = $this->db->get("parkir");
		return $query;
    }
    function simpan($action){
    	switch ($action) {
    		case 'simpan':
    			$data = array(
    				"id" => date("YmdHis"),
    				"tanggal" => date("Y-m-d H:i:s"),
    				"periode" => date("Y-m-d",strtotime($this->input->post("periode"))),
    				"shift" => $this->input->post("shift"),
                    "pemberi" => $this->input->post("pemberi"),
    				"penerima" => $this->input->post("penerima"),
    				"jumlah" => str_replace(".", "", $this->input->post("jumlah")),
    				"action" => $action
    			);
    			$this->db->insert("parkir",$data);
    			break;
    		
    		case 'edit':
    			$data = array(
    				"tanggal" => date("Y-m-d H:i:s"),
    				"periode" => date("Y-m-d",strtotime($this->input->post("periode"))),
                    "shift" => $this->input->post("shift"),
    				"pemberi" => $this->input->post("pemberi"),
    				"penerima" => $this->input->post("penerima"),
    				"jumlah" => str_replace(".", "", $this->input->post("jumlah")),
    				"action" => $action
    			);
    			$this->db->where("id",$this->input->post("id"));
    			$this->db->update("parkir",$data);
    			break;
    	}
    	return "success-Data berhasil disimpan";
    }
    function hapus($id){
    	$this->db->where("id",$id);
    	$this->db->delete("parkir");
    	return "danger-Data berhasil dihapus";
    }
    function rekap($tgl1,$tgl2){
        $data = array();
        $this->db->select("k.*,sum(k.jumlah) as jumlah,sum(t.jumlah_disc) as jumlah_disc,pr.layan,date(pr.tanggal) as tanggal,pr.gol_pasien as gol_pasien");
        $this->db->where("date(pr.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(pr.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("k.kode_tarif!=","FRM");
        $this->db->join("pasien_ralan pr","pr.no_reg=k.no_reg","inner");
        $this->db->join("transaksi t","t.id=k.id_transaksi and t.no_reg=k.no_reg","left");
        $this->db->order_by("date(pr.tanggal),k.no_reg");
        $this->db->group_by("date(pr.tanggal),pr.gol_pasien");
        $q = $this->db->get("kasir k");
        foreach($q->result() as $row){
            if ($row->gol_pasien==11){
                $str_golpas = "UMUM";
            } else 
            if ($row->gol_pasien>=12 && $row->gol_pasien<=18){
                $str_golpas = "PERUSAHAAN";
            } else {
                $str_golpas = "BPJS";
            }
            if (isset($data["pelayanan_ralan"][$row->tanggal][$str_golpas])){
                $data["pelayanan_ralan"][$row->tanggal][$str_golpas] += $row->jumlah;
            } else {
                $data["pelayanan_ralan"][$row->tanggal][$str_golpas] = $row->jumlah;
            }
        }
        $this->db->select("k.*,sum(k.jumlah) as jumlah,sum(t.jumlah_disc) as jumlah_disc,pr.layan,date(pr.tanggal) as tanggal");
        $this->db->where("date(pr.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(pr.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("k.kode_tarif","FRM");
        $this->db->join("pasien_ralan pr","pr.no_reg=k.no_reg","inner");
        $this->db->join("transaksi_apotek t","t.id=k.id_transaksi and t.no_reg=k.no_reg","left");
        $this->db->order_by("date(pr.tanggal),k.no_reg");
        $this->db->group_by("date(pr.tanggal)");
        $q = $this->db->get("kasir k");
        foreach($q->result() as $row){
            if (isset($data["apotek_ralan"][$row->tanggal])){
                $data["apotek_ralan"][$row->tanggal] += $row->jumlah;
            } else {
                $data["apotek_ralan"][$row->tanggal] = $row->jumlah;
            }
        }
        $this->db->select("p.*,sum(p.jumlah) as jumlah,sum(t.jumlah_disc) as jumlah_disc,pr.layan,date(pr.tanggal) as tanggal");
        $this->db->where("date(pr.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(pr.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->join("pasien_ralan pr","pr.no_reg=p.no_reg","inner");
        $this->db->join("transaksi_parsial t","t.id=p.id_transaksi and t.no_reg=p.no_reg","left");
        $this->db->order_by("date(pr.tanggal),p.no_reg");
        $this->db->group_by("date(pr.tanggal)");
        $q = $this->db->get("parsial p");
        foreach($q->result() as $row){
            if (isset($data["parsial_ralan"][$row->tanggal])){
                $data["parsial_ralan"][$row->tanggal] += $row->jumlah;
            } else {
                $data["parsial_ralan"][$row->tanggal] = $row->jumlah;
            }
        }
        $this->db->select("k.*,sum(k.qty*k.jumlah) as jumlah,sum(t.jumlah_disc) as jumlah_disc,pr.layan,pr.tgl_keluar,pr.id_gol as gol_pasien");
        $this->db->where("pr.tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("pr.tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("k.kode_tarif!=","FRM");
        $this->db->join("pasien_inap pr","pr.no_reg=k.no_reg","inner");
        $this->db->join("transaksi t","t.id=k.id_transaksi and t.no_reg=k.no_reg","left");
        $this->db->order_by("pr.tgl_keluar,k.no_reg");
        $this->db->group_by("pr.tgl_keluar,pr.id_gol");
        $q = $this->db->get("kasir_inap k");
        foreach($q->result() as $row){
            if ($row->gol_pasien==11){
                $str_golpas = "UMUM";
            } else 
            if ($row->gol_pasien>=12 && $row->gol_pasien<=18){
                $str_golpas = "PERUSAHAAN";
            } else {
                $str_golpas = "BPJS";
            }
            if (isset($data["pelayanan_inap"][$row->tgl_keluar][$str_golpas])){
                $data["pelayanan_inap"][$row->tgl_keluar][$str_golpas] += $row->jumlah;
            } else {
                $data["pelayanan_inap"][$row->tgl_keluar][$str_golpas] = $row->jumlah;
            }
        }
        $this->db->select("k.*,sum(k.qty*k.jumlah) as jumlah,sum(t.jumlah_disc) as jumlah_disc,pr.layan,pr.tgl_keluar,pr.id_gol as gol_pasien");
        $this->db->where("pr.tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("pr.tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("k.kode_tarif","FRM");
        $this->db->join("pasien_inap pr","pr.no_reg=k.no_reg","inner");
        $this->db->join("transaksi_apotek t","t.id=k.id_transaksi and t.no_reg=k.no_reg","left");
        $this->db->order_by("pr.tgl_keluar,k.no_reg");
        $this->db->group_by("pr.tgl_keluar");
        $q = $this->db->get("kasir_inap k");
        foreach($q->result() as $row){
            if (isset($data["apotek_inap"][$row->tgl_keluar])){
                $data["apotek_inap"][$row->tgl_keluar] += $row->jumlah;
            } else {
                $data["apotek_inap"][$row->tgl_keluar] = $row->jumlah;
            }
        }
        $this->db->select("p.*,sum(p.jumlah) as jumlah");
        $this->db->where("p.tanggal>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("p.tanggal<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->join("transaksi_parsial t","t.id=p.id_transaksi and t.no_reg=p.no_reg","left");
        $this->db->order_by("p.no_reg");
        $q = $this->db->get("parsial_inap p");
        foreach($q->result() as $row){
            if (isset($data["parsial_ranap"][$row->tanggal])){
                $data["parsial_ranap"][$row->tanggal] += $row->jumlah;
            } else {
                $data["parsial_ranap"][$row->tanggal] = $row->jumlah;
            }
        }
        $this->db->select("i.no_penjualan,sum(i.total_harga) as jumlah,p.tanggal");
        $this->db->where("p.tanggal>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("p.tanggal<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->join("item_penjualan i","i.no_penjualan=p.no_penjualan","inner");
        $this->db->order_by("p.tanggal,p.no_penjualan");
        $this->db->group_by("p.no_penjualan");
        $q = $this->db->get("penjualan_apotek p");
        foreach($q->result() as $row){
            if (isset($data["apotek"][$row->tanggal])){
                $data["apotek"][$row->tanggal] += $row->jumlah;
            } else {
                $data["apotek"][$row->tanggal] = $row->jumlah;
            }
        }
        $this->db->select("pr.blu,pr.cob,pr.tgl_keluar,pr.id_gol as gol_pasien");
        $this->db->where("pr.tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("pr.tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->order_by("pr.tgl_keluar,pr.no_reg");
        $this->db->group_by("pr.tgl_keluar");
        $q = $this->db->get("pasien_inap pr");
        foreach($q->result() as $row){
            if ($row->gol_pasien==11){
                $str_golpas = "UMUM";
            } else 
            if ($row->gol_pasien>=12 && $row->gol_pasien<=18){
                $str_golpas = "PERUSAHAAN";
            } else {
                $str_golpas = "BPJS";
            }
            if (isset($data["blu"][$row->tgl_keluar][$str_golpas])){
                $data["blu"][$row->tgl_keluar][$str_golpas] += $row->blu;
            } else {
                $data["blu"][$row->tgl_keluar][$str_golpas] = $row->blu;
            }
            if (isset($data["cob"][$row->tgl_keluar])){
                $data["cob"][$row->tgl_keluar] += $row->cob;
            } else {
                $data["cob"][$row->tgl_keluar] = $row->cob;
            }
        }
        $this->db->select("sum(jumlah) as jumlah,periode");
        $this->db->where("periode>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("periode<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->order_by("periode");
        $this->db->group_by("periode");
        $q = $this->db->get("parkir");
        foreach($q->result() as $row){
            if (isset($data["parkir"][$row->periode])){
                $data["parkir"][$row->periode] += $row->jumlah;
            } else {
                $data["parkir"][$row->periode] = $row->jumlah;
            }
        }
        return $data;
    }
}
?>