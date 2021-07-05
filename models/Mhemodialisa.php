<?php
	class Mhemodialisa extends CI_Model{
	   function __construct()
	    {
	        parent::__construct();
	    }
	    function rekap_ralan_full($tindakan,$tgl1="",$tgl2=""){
			$data = array();
			$tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
			$tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
			// $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
			// $q = $this->db->get("rekap_haemodialisa");
			// if($q->num_rows()<=0){
				$this->db->select("p.status_pasien,p.jenis,p.gol_pasien,p.tujuan_poli,g.pensiunan");

				// $this->db->where("layan!=",2);
				// if ($tindakan!="all") {
				// 	$this->db->where("k.kode_tarif",$tindakan);
				// } else {
				// 	$this->db->like("k.kode_tarif","PA",'after');
				// }
				$this->db->join("gol_pasien g","g.id_gol=p.gol_pasien","inner");
				$this->db->where("p.tujuan_poli =",$tindakan);
				$this->db->where("date(p.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
				$this->db->where("date(p.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
				// $this->db->order_by("jumlah","desc");
				// $this->db->group_by("kode_tarif");
				$sql = $this->db->get("pasien_ralan p");
				foreach ($sql->result() as $key) {
					if (isset($data["tindakan"][$key->tujuan_poli]))
					$data["tindakan"][$key->tujuan_poli] += 1;
					else
					$data["tindakan"][$key->tujuan_poli] = 1;
					if ($key->jenis=="R"){
						if (isset($data["REGULER"][$key->tujuan_poli]))
						$data["REGULER"][$key->tujuan_poli] += 1;
						else
						$data["REGULER"][$key->tujuan_poli] = 1;
					} else
					if ($key->jenis=="E"){
						if (isset($data["EKSEKUTIF"][$key->kode_tarif]))
						$data["EKSEKUTIF"][$key->tujuan_poli] += 1;
						else
						$data["EKSEKUTIF"][$key->tujuan_poli] = 1;
					}
					if ($key->status_pasien=="BARU"){
						if (isset($data["BARU"][$key->kode_tarif]))
						$data["BARU"][$key->tujuan_poli] += 1;
						else
						$data["BARU"][$key->tujuan_poli] = 1;
					} else
					if ($key->status_pasien=="LAMA"){
						if (isset($data["LAMA"][$key->tujuan_poli]))
						$data["LAMA"][$key->tujuan_poli] += 1;
						else
						$data["LAMA"][$key->tujuan_poli] = 1;
					}
					// if ($key->asal=="DR"){
					// 	if (isset($data["DR"][$key->tujuan_poli]))
					// 	$data["DR"][$key->tujuan_poli] += 1;
					// 	else
					// 	$data["DR"][$key->tujuan_poli] = 1;
					// } else
					// if ($key->asal=="MANUAL"){
					// 	if (isset($data["MANUAL"][$key->kode_tarif]))
					// 	$data["MANUAL"][$key->tujuan_poli] += 1;
					// 	else
					// 	$data["MANUAL"][$key->tujuan_poli] = 1;
					// }
					if (($key->gol_pasien>=404 && $key->gol_pasien<=410) || ($key->gol_pasien>=415 && $key->gol_pasien<=417) || ($key->gol_pasien==3133)){
						if (isset($data["DINAS"][$key->tujuan_poli]))
						$data["DINAS"][$key->tujuan_poli] += 1;
						else
						$data["DINAS"][$key->tujuan_poli] = 1;
						if ($key->pensiunan){
							if (isset($data["DINAS_PUR"][$key->tujuan_poli]))
							$data["DINAS_PUR"][$key->tujuan_poli] += 1;
							else
							$data["DINAS_PUR"][$key->tujuan_poli] = 1;
						} else {
							if (isset($data["DINAS_A"][$key->tujuan_poli]))
							$data["DINAS_A"][$key->tujuan_poli] += 1;
							else
							$data["DINAS_A"][$key->tujuan_poli] = 1;
						}
					} else
					if ($key->gol_pasien==11){
						if (isset($data["UMUM"][$key->kode_tarif]))
						$data["UMUM"][$key->tujuan_poli] += 1;
						else
						$data["UMUM"][$key->tujuan_poli] = 1;
					} else
					if (($key->gol_pasien>=400 && $key->gol_pasien<=403) || ($key->gol_pasien>=411 && $key->gol_pasien<=414) || ($key->gol_pasien>=418 && $key->gol_pasien<=420)){
						if (isset($data["BPJS"][$key->tujuan_poli]))
						$data["BPJS"][$key->tujuan_poli] += 1;
						else
						$data["BPJS"][$key->tujuan_poli] = 1;
					} else
					if (($key->gol_pasien==12) || ($key->gol_pasien==13) || ($key->gol_pasien>=16 && $key->gol_pasien<=18)){
						if (isset($data["PRSH"][$key->tujuan_poli]))
						$data["PRSH"][$key->tujuan_poli] += 1;
						else
						$data["PRSH"][$key->tujuan_poli] = 1;
					}
				}
			// } else {
			// 	foreach ($q->result() as $key) {
			// 		$data["BARU"]["0102026"] = $key->baru_ralan;
			// 		$data["LAMA"]["0102026"] = $key->lama_ralan;
			// 		$data["REGULER"]["0102026"] = $key->reguler_ralan;
			// 		$data["EKSEKUTIF"]["0102026"] = $key->eksekutif_ralan;
			// 		$data["DINAS_A"]["0102026"] = $key->dinas_a_ralan;
			// 		$data["DINAS_PUR"]["0102026"] = $key->dinas_pur_ralan;
			// 		$data["UMUM"]["0102026"] = $key->umum_ralan;
			// 		$data["BPJS"]["0102026"] = $key->bpjs_ralan;
			// 		$data["PRSH"]["0102026"] = $key->prsh_ralan;
			// 	}
			// }
			return $data;
		}
	function rekap_inap_full($tindakan,$tgl1="",$tgl2=""){
		$data = array();
		$tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
		// $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
		// $q = $this->db->get("rekap_haemodialisa");
		// if($q->num_rows()<=0){
			$this->db->select("k.kode_tarif,k.asal,pa.id_gol,k.jam_radiologi,g.pensiunan");
			// if ($tindakan!="all") {
			// 	$this->db->where("k.kode_tarif",$tindakan);
			// } else {
			// 	$this->db->like("k.kode_tarif","PA",'after');
			// }
			$this->db->where("k.kode_tarif =","$tindakan");
			$this->db->where("date(k.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
			$this->db->where("date(k.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
			$this->db->join("kasir_inap k","k.no_reg=p.no_reg","inner");
			$this->db->join("pasien pa","pa.no_pasien = p.no_rm","left");
			$this->db->join("gol_pasien g","g.id_gol=p.id_gol","inner");
			// $this->db->order_by("jumlah","desc");
			// $this->db->group_by("kode_tarif");
			$sql = $this->db->get("pasien_inap p");
			foreach ($sql->result() as $key) {
				if (isset($data["tindakan"][$key->kode_tarif]))
				$data["tindakan"][$key->kode_tarif] += 1;
				else
				$data["tindakan"][$key->kode_tarif] = 1;

				if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
					if (isset($data["DINAS"][$key->kode_tarif]))
					$data["DINAS"][$key->kode_tarif] += 1;
					else
					$data["DINAS"][$key->kode_tarif] = 1;
					if ($key->pensiunan){
						if (isset($data["DINAS_PUR"][$key->tujuan_poli]))
						$data["DINAS_PUR"][$key->tujuan_poli] += 1;
						else
						$data["DINAS_PUR"][$key->tujuan_poli] = 1;
					} else {
						if (isset($data["DINAS_A"][$key->tujuan_poli]))
						$data["DINAS_A"][$key->tujuan_poli] += 1;
						else
						$data["DINAS_A"][$key->tujuan_poli] = 1;
					}
				} else
				if ($key->id_gol==11){
					if (isset($data["UMUM"][$key->kode_tarif]))
					$data["UMUM"][$key->kode_tarif] += 1;
					else
					$data["UMUM"][$key->kode_tarif] = 1;
				} else
				if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
					if (isset($data["BPJS"][$key->kode_tarif]))
					$data["BPJS"][$key->kode_tarif] += 1;
					else
					$data["BPJS"][$key->kode_tarif] = 1;
				} else
				if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
					if (isset($data["PRSH"][$key->kode_tarif]))
					$data["PRSH"][$key->kode_tarif] += 1;
					else
					$data["PRSH"][$key->kode_tarif] = 1;
				}
				if ($key->asal=="DR"){
					if (isset($data["DR"][$key->kode_tarif]))
					$data["DR"][$key->kode_tarif] += 1;
					else
					$data["DR"][$key->kode_tarif] = 1;
				} else
				if ($key->asal=="MANUAL"){
					if (isset($data["MANUAL"][$key->kode_tarif]))
					$data["MANUAL"][$key->kode_tarif] += 1;
					else
					$data["MANUAL"][$key->kode_tarif] = 1;
				}
				// if ($key->jam_radiologi!="0000-00-00 00:00:00"){
				// 	if (isset($data["PEMERIKSAAN"][$key->kode_tarif]))
				// 	$data["PEMERIKSAAN"][$key->kode_tarif] += 1;
				// 	else
				// 	$data["PEMERIKSAAN"][$key->kode_tarif] = 1;
				// }
			}
		// } else {
		// 	foreach($q->result() as $key){
		// 		$data["BARU"]["hdl"] = $key->baru_inap;
		// 		$data["LAMA"]["hdl"] = $key->lama_inap;
		// 		$data["REGULER"]["hdl"] = $key->reguler_inap;
		// 		$data["EKSEKUTIF"]["hdl"] = $key->eksekutif_inap;
		// 		$data["DINAS_A"]["hdl"] = $key->dinas_a_inap;
		// 		$data["DINAS_PUR"]["hdl"] = $key->dinas_pur_inap;
		// 		$data["UMUM"]["hdl"] = $key->umum_inap;
		// 		$data["BPJS"]["hdl"] = $key->bpjs_inap;
		// 		$data["PRSH"]["hdl"] = $key->prsh_inap;
		// 	}
		// }
		return $data;
	}
	function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
			$data = array();
			//ralan
			$this->db->select("pr.tanggal,pr.no_pasien,pr.no_reg,pr.tujuan_poli,pr.dari_poli,pr.dokter_pengirim,pr.layan");
			$this->db->where("pr.tujuan_poli","0102026");
			$this->db->where("date(pr.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
			$this->db->where("date(pr.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
			$this->db->order_by('pr.tanggal', 'DESC');
			// $this->db->where("k.kode_tarif",$tindakan);
			// $this->db->join("kasir k","k.no_reg=pr.no_reg","inner");
			//$this->db->order_by("pr.no_reg");

			$query = $this->db->get("pasien_ralan pr");
			foreach ($query->result() as $row) {

				// $this->db->where("k.no_reg",$row->no_reg);
				// $q = $this->db->get("kasir k");
				// if ($q->num_rows()>0){
				$data["list"][$row->no_reg] = $row;
				// $data["kasir"][$row->no_reg] = $q->row();
				$q = $this->db->get_where("pasien",["no_pasien"=>$row->no_pasien]);
				$data["master"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("poliklinik",["kode"=>$row->tujuan_poli]);
				$data["pol2"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("poliklinik",["kode"=>$row->dari_poli]);
				$data["pol"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("dokter",["id_dokter"=>$row->dokter_pengirim]);
				$data["dokter"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
    //             $q = $this->db->order_by('hasil','desc')->get_where("ekspertisi_lab",["no_reg"=>$row->no_reg , "kode_tindakan"=>"$tindakan" ]);
    //             //$q = $this->db->get_where("ekspertisi_lab",["no_reg"=>$row->no_reg]);
				// $data["ekspertisi_lab"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				// }
			}
			//ranap
			$this->db->select("k.no_reg,k.dokter_pengirim,pi.kode_ruangan,pi.kode_kelas,pi.kode_kamar,pi.status_pulang,pi.no_rm as no_pasien, k.pemeriksaan, k.tanggal");
			$this->db->where("k.kode_tarif","hdl");
			$this->db->where("date(k.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
			$this->db->where("date(k.tanggal)<=",date("Y-m-d",strtotime($tgl2)));;
			//$this->db->order_by("k.no_reg");
			$this->db->join("kasir_inap k","k.no_reg=pi.no_reg","inner");
			$this->db->order_by('k.tanggal', 'DESC');
			$query = $this->db->get("pasien_inap pi");
			foreach ($query->result() as $row) {
				$data["list"][$row->no_reg] = $row;
				$q = $this->db->get_where("pasien",["no_pasien"=>$row->no_pasien]);
				$data["master"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("status_pulang s",["s.id"=>$row->status_pulang]);
				$data["status_pulang"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("ruangan r",["r.kode_ruangan"=> $row->kode_ruangan]);
				$data["ruangan"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("kelas kls",["kls.kode_kelas"=>$row->kode_kelas]);
				$data["kelas"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("kamar kmr",["kmr.kode_kamar"=>$row->kode_kamar,"kmr.kode_kelas"=>$row->kode_kelas, "kmr.kode_ruangan"=>$row->kode_ruangan]);
				$data["kamar"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
				$q = $this->db->get_where("dokter",["id_dokter"=>$row->dokter_pengirim]);
				$data["dokter"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
    //             $q = $this->db->order_by('hasil','desc')->get_where("ekspertisi_labinap",["no_reg"=>$row->no_reg , "kode_tindakan"=>"$tindakan" ]);
				// $data["ekspertisi_lab"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
			}
			return $data;
		}
		function gettindakan_cetak(){
			$this->db->where("kode_tindakan", "hdl");
			return $this->db->get("tarif_inap")->row();
		}
		function gettarif_ralan(){
			$this->db->where("kode_tindakan", "T173");
			$this->db->or_where("kode_tindakan", "T292");
			return $this->db->get("tarif_ralan");
		}
		function gettarif_inap(){
			$this->db->where("kode_tindakan", "hdl");
			return $this->db->get("tarif_inap");
		}

	}
?>
