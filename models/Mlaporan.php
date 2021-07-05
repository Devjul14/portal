<?php
class Mlaporan extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function geticd()
	{
		$this->db->group_by("golongan_sebab");
		$this->db->order_by("no_dtd");
		$q = $this->db->get("master_icd m");
		return $q;
	}
	function geticd_rl2a1()
	{
		$this->db->group_by("golongan_sebab");
		$this->db->where("rl2a1", 1);
		$this->db->order_by("no_dtd");
		$q = $this->db->get("master_icd m");
		return $q;
	}
	function geticd2()
	{
		$this->db->group_by("golongan_sebab");
		$this->db->order_by("no_dtd");
		$q = $this->db->get("master_icd m");
		return $q;
	}
	function getrl2a($tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("m.no_dtd as kode,id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah");
		$this->db->where("date(pi.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->where("i.urut", 1);
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("master_icd m", "m.kode=i.kode", "inner");
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("i.kode,i.no_reg");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			$t1 = new DateTime('today');
			$t2 = new DateTime($key->tgl_lahir);
			$y  = $t1->diff($t2)->y;
			$m  = $t1->diff($t2)->m;
			$d  = $t1->diff($t2)->d;
			if ($key->id_gol == "404" && $key->id_cabang == "1") {
				if (isset($data["SATPUR"][$key->kode]))
					$data["SATPUR"][$key->kode] += $key->jumlah;
				else
					$data["SATPUR"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"][$key->kode]))
					$data["SATBANPUR"][$key->kode] += $key->jumlah;
				else
					$data["SATBANPUR"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"][$key->kode]))
					$data["SATBANMIN"][$key->kode] += $key->jumlah;
				else
					$data["SATBANMIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "408") {
				if (isset($data["SIPILTNIAD"][$key->kode]))
					$data["SIPILTNIAD"][$key->kode] += $key->jumlah;
				else
					$data["SIPILTNIAD"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "415") {
				if (isset($data["KELTNIAD"][$key->kode]))
					$data["KELTNIAD"][$key->kode] += $key->jumlah;
				else
					$data["KELTNIAD"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"][$key->kode]))
					$data["MILLAIN"][$key->kode] += $key->jumlah;
				else
					$data["MILLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELLAIN"][$key->kode]))
					$data["KELLAIN"][$key->kode] += $key->jumlah;
				else
					$data["KELLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["SIPILLAIN"][$key->kode]))
					$data["SIPILLAIN"][$key->kode] += $key->jumlah;
				else
					$data["SIPILLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "412" || $key->id_gol == "413") {
				if (isset($data["PURNBPJS"][$key->kode]))
					$data["PURNBPJS"][$key->kode] += $key->jumlah;
				else
					$data["PURNBPJS"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420") {
				if (isset($data["UMUMBPJS"][$key->kode]))
					$data["UMUMBPJS"][$key->kode] += $key->jumlah;
				else
					$data["UMUMBPJS"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18") {
				if (isset($data["UMUMPERUSAHAAN"][$key->kode]))
					$data["UMUMPERUSAHAAN"][$key->kode] += $key->jumlah;
				else
					$data["UMUMPERUSAHAAN"][$key->kode] = $key->jumlah;
			}
			if ($key->jk == "L") {
				if (isset($data["LAKI"][$key->kode]))
					$data["LAKI"][$key->kode] += $key->jumlah;
				else
					$data["LAKI"][$key->kode] = $key->jumlah;
			} else
			    if ($key->jk == "P") {
				if (isset($data["PEREMPUAN"][$key->kode]))
					$data["PEREMPUAN"][$key->kode] += $key->jumlah;
				else
					$data["PEREMPUAN"][$key->kode] = $key->jumlah;
			}
			if ($y == "0" && $m == "0" && $d < "28") {
				if (isset($data["HARI1"][$key->kode]))
					$data["HARI1"][$key->kode] += $key->jumlah;
				else
					$data["HARI1"][$key->kode] = $key->jumlah;
			} else
			    if ($y < "1" && $m < "12" && $d >= "28") {
				if (isset($data["HARI2"][$key->kode]))
					$data["HARI2"][$key->kode] += $key->jumlah;
				else
					$data["HARI2"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "4" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI3"][$key->kode]))
					$data["HARI3"][$key->kode] += $key->jumlah;
				else
					$data["HARI3"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "14" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI8"][$key->kode]))
					$data["HARI8"][$key->kode] += $key->jumlah;
				else
					$data["HARI8"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "25" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI4"][$key->kode]))
					$data["HARI4"][$key->kode] += $key->jumlah;
				else
					$data["HARI4"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "44" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI5"][$key->kode]))
					$data["HARI5"][$key->kode] += $key->jumlah;
				else
					$data["HARI5"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "64" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI6"][$key->kode]))
					$data["HARI6"][$key->kode] += $key->jumlah;
				else
					$data["HARI6"][$key->kode] = $key->jumlah;
			} else
			    if ($y >= "65" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI7"][$key->kode]))
					$data["HARI7"][$key->kode] += $key->jumlah;
				else
					$data["HARI7"][$key->kode] = $key->jumlah;
			}
			if ($key->status_pulang == "4") {
				if (isset($data["MENINGGAL"][$key->kode]))
					$data["MENINGGAL"][$key->kode] += $key->jumlah;
				else
					$data["MENINGGAL"][$key->kode] = $key->jumlah;
			}
			// var_dump($d);
		}
		return $data;
	}
	function getrl2a_ralan($tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("i.kode,id_cabang,pi.gol_pasien as id_gol,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah");
		$this->db->where("date(pi.tanggal)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tanggal)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->where("i.urut", 1);
		$this->db->join("indeks_ralan_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->join("pasien p", "p.no_pasien=pi.no_pasien", "inner");
		// $this->db->join("master_icd m","m.kode=i.kode","inner");
		// $this->db->order_by("jumlah","desc");
		$this->db->group_by("i.kode,pi.gol_pasien,p.jenis_kelamin,p.tgl_lahir");
		$sql = $this->db->get("pasien_ralan pi");
		foreach ($sql->result() as $key) {
			$kode = $this->db->get_where("master_icd", ["kode" => $key->kode])->row()->no_dtd;
			$t1 = new DateTime('today');
			$t2 = new DateTime($key->tgl_lahir);
			$y  = $t1->diff($t2)->y;
			$m  = $t1->diff($t2)->m;
			$d  = $t1->diff($t2)->d;
			if ($key->id_gol == "404" && $key->id_cabang == "1") {
				if (isset($data["SATPUR"][$kode]))
					$data["SATPUR"][$kode] += $key->jumlah;
				else
					$data["SATPUR"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"][$kode]))
					$data["SATBANPUR"][$kode] += $key->jumlah;
				else
					$data["SATBANPUR"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"][$kode]))
					$data["SATBANMIN"][$kode] += $key->jumlah;
				else
					$data["SATBANMIN"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "408") {
				if (isset($data["SIPILTNIAD"][$kode]))
					$data["SIPILTNIAD"][$kode] += $key->jumlah;
				else
					$data["SIPILTNIAD"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "415") {
				if (isset($data["KELTNIAD"][$kode]))
					$data["KELTNIAD"][$kode] += $key->jumlah;
				else
					$data["KELTNIAD"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"][$kode]))
					$data["MILLAIN"][$kode] += $key->jumlah;
				else
					$data["MILLAIN"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELLAIN"][$kode]))
					$data["KELLAIN"][$kode] += $key->jumlah;
				else
					$data["KELLAIN"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["SIPILLAIN"][$kode]))
					$data["SIPILLAIN"][$kode] += $key->jumlah;
				else
					$data["SIPILLAIN"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "412" || $key->id_gol == "413") {
				if (isset($data["PURNBPJS"][$kode]))
					$data["PURNBPJS"][$kode] += $key->jumlah;
				else
					$data["PURNBPJS"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420") {
				if (isset($data["UMUMBPJS"][$kode]))
					$data["UMUMBPJS"][$kode] += $key->jumlah;
				else
					$data["UMUMBPJS"][$kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18") {
				if (isset($data["UMUMPERUSAHAAN"][$kode]))
					$data["UMUMPERUSAHAAN"][$kode] += $key->jumlah;
				else
					$data["UMUMPERUSAHAAN"][$kode] = $key->jumlah;
			}
			if ($key->jk == "L") {
				if (isset($data["LAKI"][$kode]))
					$data["LAKI"][$kode] += $key->jumlah;
				else
					$data["LAKI"][$kode] = $key->jumlah;
			} else
			    if ($key->jk == "P") {
				if (isset($data["PEREMPUAN"][$kode]))
					$data["PEREMPUAN"][$kode] += $key->jumlah;
				else
					$data["PEREMPUAN"][$kode] = $key->jumlah;
			}
			if ($y == "0" && $m == "0" && $d < "28") {
				if (isset($data["HARI1"][$kode]))
					$data["HARI1"][$kode] += $key->jumlah;
				else
					$data["HARI1"][$kode] = $key->jumlah;
			} else
			    if ($y < "1" && $m < "12" && $d >= "28") {
				if (isset($data["HARI2"][$kode]))
					$data["HARI2"][$kode] += $key->jumlah;
				else
					$data["HARI2"][$kode] = $key->jumlah;
			} else
			    if ($y <= "4" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI3"][$kode]))
					$data["HARI3"][$kode] += $key->jumlah;
				else
					$data["HARI3"][$kode] = $key->jumlah;
			} else
			    if ($y <= "14" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI8"][$kode]))
					$data["HARI8"][$kode] += $key->jumlah;
				else
					$data["HARI8"][$kode] = $key->jumlah;
			} else
			    if ($y <= "25" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI4"][$kode]))
					$data["HARI4"][$kode] += $key->jumlah;
				else
					$data["HARI4"][$kode] = $key->jumlah;
			} else
			    if ($y <= "44" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI5"][$kode]))
					$data["HARI5"][$kode] += $key->jumlah;
				else
					$data["HARI5"][$kode] = $key->jumlah;
			} else
			    if ($y <= "64" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI6"][$kode]))
					$data["HARI6"][$kode] += $key->jumlah;
				else
					$data["HARI6"][$kode] = $key->jumlah;
			} else
			    if ($y >= "65" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI7"][$kode]))
					$data["HARI7"][$kode] += $key->jumlah;
				else
					$data["HARI7"][$kode] = $key->jumlah;
			}
		}
		return $data;
	}
	function getrl2a1($tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("m.no_dtd as kode,id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah");
		$this->db->where("date(pi.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->where("i.urut", 1);
		$this->db->where("m.rl2a1", 1);
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("master_icd m", "m.kode=i.kode", "inner");
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("i.kode,i.no_reg");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			$t1 = new DateTime('today');
			$t2 = new DateTime($key->tgl_lahir);
			$y  = $t1->diff($t2)->y;
			$m  = $t1->diff($t2)->m;
			$d  = $t1->diff($t2)->d;
			if ($key->id_gol == "404" && $key->id_cabang == "1") {
				if (isset($data["SATPUR"][$key->kode]))
					$data["SATPUR"][$key->kode] += $key->jumlah;
				else
					$data["SATPUR"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"][$key->kode]))
					$data["SATBANPUR"][$key->kode] += $key->jumlah;
				else
					$data["SATBANPUR"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"][$key->kode]))
					$data["SATBANMIN"][$key->kode] += $key->jumlah;
				else
					$data["SATBANMIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "408") {
				if (isset($data["SIPILTNIAD"][$key->kode]))
					$data["SIPILTNIAD"][$key->kode] += $key->jumlah;
				else
					$data["SIPILTNIAD"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "415") {
				if (isset($data["KELTNIAD"][$key->kode]))
					$data["KELTNIAD"][$key->kode] += $key->jumlah;
				else
					$data["KELTNIAD"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"][$key->kode]))
					$data["MILLAIN"][$key->kode] += $key->jumlah;
				else
					$data["MILLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELLAIN"][$key->kode]))
					$data["KELLAIN"][$key->kode] += $key->jumlah;
				else
					$data["KELLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["SIPILLAIN"][$key->kode]))
					$data["SIPILLAIN"][$key->kode] += $key->jumlah;
				else
					$data["SIPILLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "412" || $key->id_gol == "413") {
				if (isset($data["PURNBPJS"][$key->kode]))
					$data["PURNBPJS"][$key->kode] += $key->jumlah;
				else
					$data["PURNBPJS"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420") {
				if (isset($data["UMUMBPJS"][$key->kode]))
					$data["UMUMBPJS"][$key->kode] += $key->jumlah;
				else
					$data["UMUMBPJS"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18") {
				if (isset($data["UMUMPERUSAHAAN"][$key->kode]))
					$data["UMUMPERUSAHAAN"][$key->kode] += $key->jumlah;
				else
					$data["UMUMPERUSAHAAN"][$key->kode] = $key->jumlah;
			}
			if ($key->jk == "L") {
				if (isset($data["LAKI"][$key->kode]))
					$data["LAKI"][$key->kode] += $key->jumlah;
				else
					$data["LAKI"][$key->kode] = $key->jumlah;
			} else
			    if ($key->jk == "P") {
				if (isset($data["PEREMPUAN"][$key->kode]))
					$data["PEREMPUAN"][$key->kode] += $key->jumlah;
				else
					$data["PEREMPUAN"][$key->kode] = $key->jumlah;
			}
			if ($y == "0" && $m == "0" && $d < "28") {
				if (isset($data["HARI1"][$key->kode]))
					$data["HARI1"][$key->kode] += $key->jumlah;
				else
					$data["HARI1"][$key->kode] = $key->jumlah;
			} else
			    if ($y < "1" && $m < "12" && $d >= "28") {
				if (isset($data["HARI2"][$key->kode]))
					$data["HARI2"][$key->kode] += $key->jumlah;
				else
					$data["HARI2"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "4" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI3"][$key->kode]))
					$data["HARI3"][$key->kode] += $key->jumlah;
				else
					$data["HARI3"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "14" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI8"][$key->kode]))
					$data["HARI8"][$key->kode] += $key->jumlah;
				else
					$data["HARI8"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "25" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI4"][$key->kode]))
					$data["HARI4"][$key->kode] += $key->jumlah;
				else
					$data["HARI4"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "44" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI5"][$key->kode]))
					$data["HARI5"][$key->kode] += $key->jumlah;
				else
					$data["HARI5"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "64" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI6"][$key->kode]))
					$data["HARI6"][$key->kode] += $key->jumlah;
				else
					$data["HARI6"][$key->kode] = $key->jumlah;
			} else
			    if ($y >= "65" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI7"][$key->kode]))
					$data["HARI7"][$key->kode] += $key->jumlah;
				else
					$data["HARI7"][$key->kode] = $key->jumlah;
			}
			if ($key->status_pulang == "4") {
				if (isset($data["MENINGGAL"][$key->kode]))
					$data["MENINGGAL"][$key->kode] += $key->jumlah;
				else
					$data["MENINGGAL"][$key->kode] = $key->jumlah;
			}
		}
		return $data;
	}
	function getrl3a($tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("m.no_dtd,m.no_daftar,m.golongan_sebab,m.no_dtd as kode,id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah");
		$this->db->where("date(pi.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->where("i.urut", 1);
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("master_icd m", "m.kode=i.kode", "inner");
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("i.kode,i.no_reg");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			$t1 = new DateTime('today');
			$t2 = new DateTime($key->tgl_lahir);
			$y  = $t1->diff($t2)->y;
			$m  = $t1->diff($t2)->m;
			$d  = $t1->diff($t2)->d;
			$data["master"][$key->kode] = $key;
			if (isset($data["jumlah"][$key->kode]))
				$data["jumlah"][$key->kode] += $key->jumlah;
			else
				$data["jumlah"][$key->kode] = $key->jumlah;
			if ($key->id_gol == "404" && $key->id_cabang == "1") {
				if (isset($data["SATPUR"][$key->kode]))
					$data["SATPUR"][$key->kode] += $key->jumlah;
				else
					$data["SATPUR"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"][$key->kode]))
					$data["SATBANPUR"][$key->kode] += $key->jumlah;
				else
					$data["SATBANPUR"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "404" && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"][$key->kode]))
					$data["SATBANMIN"][$key->kode] += $key->jumlah;
				else
					$data["SATBANMIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "408") {
				if (isset($data["SIPILTNIAD"][$key->kode]))
					$data["SIPILTNIAD"][$key->kode] += $key->jumlah;
				else
					$data["SIPILTNIAD"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "415") {
				if (isset($data["KELTNIAD"][$key->kode]))
					$data["KELTNIAD"][$key->kode] += $key->jumlah;
				else
					$data["KELTNIAD"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"][$key->kode]))
					$data["MILLAIN"][$key->kode] += $key->jumlah;
				else
					$data["MILLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELLAIN"][$key->kode]))
					$data["KELLAIN"][$key->kode] += $key->jumlah;
				else
					$data["KELLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["SIPILLAIN"][$key->kode]))
					$data["SIPILLAIN"][$key->kode] += $key->jumlah;
				else
					$data["SIPILLAIN"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "412" || $key->id_gol == "413") {
				if (isset($data["PURNBPJS"][$key->kode]))
					$data["PURNBPJS"][$key->kode] += $key->jumlah;
				else
					$data["PURNBPJS"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420") {
				if (isset($data["UMUMBPJS"][$key->kode]))
					$data["UMUMBPJS"][$key->kode] += $key->jumlah;
				else
					$data["UMUMBPJS"][$key->kode] = $key->jumlah;
			} else
			    if ($key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18") {
				if (isset($data["UMUMPERUSAHAAN"][$key->kode]))
					$data["UMUMPERUSAHAAN"][$key->kode] += $key->jumlah;
				else
					$data["UMUMPERUSAHAAN"][$key->kode] = $key->jumlah;
			}
			if ($key->jk == "L") {
				if (isset($data["LAKI"][$key->kode]))
					$data["LAKI"][$key->kode] += $key->jumlah;
				else
					$data["LAKI"][$key->kode] = $key->jumlah;
			} else
			    if ($key->jk == "P") {
				if (isset($data["PEREMPUAN"][$key->kode]))
					$data["PEREMPUAN"][$key->kode] += $key->jumlah;
				else
					$data["PEREMPUAN"][$key->kode] = $key->jumlah;
			}
			if ($y == "0" && $m == "0" && $d < "28") {
				if (isset($data["HARI1"][$key->kode]))
					$data["HARI1"][$key->kode] += $key->jumlah;
				else
					$data["HARI1"][$key->kode] = $key->jumlah;
			} else
			    if ($y < "1" && $m < "12" && $d >= "28") {
				if (isset($data["HARI2"][$key->kode]))
					$data["HARI2"][$key->kode] += $key->jumlah;
				else
					$data["HARI2"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "4" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI3"][$key->kode]))
					$data["HARI3"][$key->kode] += $key->jumlah;
				else
					$data["HARI3"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "14" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI8"][$key->kode]))
					$data["HARI8"][$key->kode] += $key->jumlah;
				else
					$data["HARI8"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "25" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI4"][$key->kode]))
					$data["HARI4"][$key->kode] += $key->jumlah;
				else
					$data["HARI4"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "44" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI5"][$key->kode]))
					$data["HARI5"][$key->kode] += $key->jumlah;
				else
					$data["HARI5"][$key->kode] = $key->jumlah;
			} else
			    if ($y <= "64" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI6"][$key->kode]))
					$data["HARI6"][$key->kode] += $key->jumlah;
				else
					$data["HARI6"][$key->kode] = $key->jumlah;
			} else
			    if ($y >= "65" && $m <= "12" && $d <= "32") {
				if (isset($data["HARI7"][$key->kode]))
					$data["HARI7"][$key->kode] += $key->jumlah;
				else
					$data["HARI7"][$key->kode] = $key->jumlah;
			}
			if ($key->status_pulang == "4") {
				if (isset($data["MENINGGAL"][$key->kode]))
					$data["MENINGGAL"][$key->kode] += $key->jumlah;
				else
					$data["MENINGGAL"][$key->kode] = $key->jumlah;
			}
		}
		return $data;
	}
	function getxkr5($tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah, sum(datediff(date(tgl_keluar), date(tgl_masuk))) as selisih");
		$this->db->where("date(pi.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("pi.id_gol");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "1") {
				if (isset($data["SATPUR"]))
					$data["SATPUR"] += $key->jumlah;
				else
					$data["SATPUR"] = $key->jumlah;
				if (isset($data["S-SATPUR"]))
					$data["S-SATPUR"] += $key->selisih;
				else
					$data["S-SATPUR"] = $key->selisih;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"]))
					$data["SATBANPUR"] += $key->jumlah;
				else
					$data["SATBANPUR"] = $key->jumlah;
				if (isset($data["S-SATBANPUR"]))
					$data["S-SATBANPUR"] += $key->selisih;
				else
					$data["S-SATBANPUR"] = $key->selisih;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"]))
					$data["SATBANMIN"] += $key->jumlah;
				else
					$data["SATBANMIN"] = $key->jumlah;
				if (isset($data["S-SATBANMIN"]))
					$data["S-SATBANMIN"] += $key->selisih;
				else
					$data["S-SATBANMIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "408") {
				if (isset($data["SIPILTNIAD"]))
					$data["SIPILTNIAD"] += $key->jumlah;
				else
					$data["SIPILTNIAD"] = $key->jumlah;
				if (isset($data["S-SIPILTNIAD"]))
					$data["S-SIPILTNIAD"] += $key->selisih;
				else
					$data["S-SIPILTNIAD"] = $key->selisih;
			} else
			    if ($key->id_gol == "415") {
				if (isset($data["KELTNIAD"]))
					$data["KELTNIAD"] += $key->jumlah;
				else
					$data["KELTNIAD"] = $key->jumlah;
				if (isset($data["S-KELTNIAD"]))
					$data["S-KELTNIAD"] += $key->selisih;
				else
					$data["S-KELTNIAD"] = $key->selisih;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"]))
					$data["MILLAIN"] += $key->jumlah;
				else
					$data["MILLAIN"] = $key->jumlah;
				if (isset($data["S-MILLAIN"]))
					$data["S-MILLAIN"] += $key->selisih;
				else
					$data["S-MILLAIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELLAIN"]))
					$data["KELLAIN"] += $key->jumlah;
				else
					$data["KELLAIN"] = $key->jumlah;
				if (isset($data["S-KELLAIN"]))
					$data["S-KELLAIN"] += $key->selisih;
				else
					$data["S-KELLAIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["SIPILLAIN"]))
					$data["SIPILLAIN"] += $key->jumlah;
				else
					$data["SIPILLAIN"] = $key->jumlah;
				if (isset($data["S-SIPILLAIN"]))
					$data["S-SIPILLAIN"] += $key->selisih;
				else
					$data["S-SIPILLAIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "412" || $key->id_gol == "413") {
				if (isset($data["PURNBPJS"]))
					$data["PURNBPJS"] += $key->jumlah;
				else
					$data["PURNBPJS"] = $key->jumlah;
				if (isset($data["S-PURNBPJS"]))
					$data["S-PURNBPJS"] += $key->selisih;
				else
					$data["S-PURNBPJS"] = $key->selisih;
			} else
			    if ($key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420") {
				if (isset($data["UMUMBPJS"]))
					$data["UMUMBPJS"] += $key->jumlah;
				else
					$data["UMUMBPJS"] = $key->jumlah;
				if (isset($data["S-UMUMBPJS"]))
					$data["S-UMUMBPJS"] += $key->selisih;
				else
					$data["S-UMUMBPJS"] = $key->selisih;
			} else
			    if ($key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18") {
				if (isset($data["UMUMPERUSAHAAN"]))
					$data["UMUMPERUSAHAAN"] += $key->jumlah;
				else
					$data["UMUMPERUSAHAAN"] = $key->jumlah;
				if (isset($data["S-UMUMPERUSAHAAN"]))
					$data["S-UMUMPERUSAHAAN"] += $key->selisih;
				else
					$data["S-UMUMPERUSAHAAN"] = $key->selisih;
			}
			if ($key->jk == "L") {
				if (isset($data["LAKI"]))
					$data["LAKI"] += $key->jumlah;
				else
					$data["LAKI"] = $key->jumlah;
			} else
			    if ($key->jk == "P") {
				if (isset($data["PEREMPUAN"]))
					$data["PEREMPUAN"] += $key->jumlah;
				else
					$data["PEREMPUAN"] = $key->jumlah;
			}
			if ($key->status_pulang == "4") {
				if (isset($data["MENINGGAL"]))
					$data["MENINGGAL"] += $key->jumlah;
				else
					$data["MENINGGAL"] = $key->jumlah;
			}
		}
		return $data;
	}
	function getxkr14($status, $status_pulang, $tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("pi.birth_weight,id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah, sum(datediff(date(tgl_keluar), date(tgl_masuk))) as selisih");
		$this->db->where("date(pi.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->group_start();
		$this->db->where("i.kode", "P00.9");
		$this->db->or_where("i.kode", "P03.4");
		$this->db->or_where("i.kode", "P03.3");
		$this->db->group_end();
		if ($status == "PREMATUR") {
			$this->db->where("pi.birth_weight<", 2500);
		} else {
			$this->db->where("pi.birth_weight>=", 2500);
		}
		$this->db->where("i.urut", 1);
		if ($status_pulang == "mati")
			$this->db->where("pi.status_pulang", 4);
		else
			$this->db->where("pi.status_pulang!=", 4);
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("pi.id_gol");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			if (($key->id_gol == "404" || $key->id_gol == "415")) {
				if (isset($data["ANAKTNI"]))
					$data["ANAKTNI"] += $key->jumlah;
				else
					$data["ANAKTNI"] = $key->jumlah;
			}
			if ($key->id_gol == "408") {
				if (isset($data["ANAKKARYAWANSIPIL"]))
					$data["ANAKKARYAWANSIPIL"] += $key->jumlah;
				else
					$data["ANAKKARYAWANSIPIL"] = $key->jumlah;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406" || $key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["ANAKANGGOTALAIN"]))
					$data["ANAKANGGOTALAIN"] += $key->jumlah;
				else
					$data["ANAKANGGOTALAIN"] = $key->jumlah;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406" || $key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["ANAKANGGOTALAIN"]))
					$data["ANAKANGGOTALAIN"] += $key->jumlah;
				else
					$data["ANAKANGGOTALAIN"] = $key->jumlah;
			} else
			    if ($key->id_gol == "400" || $key->id_gol == "401" || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420") {
				if (isset($data["ANAKANGGOTABPJS"]))
					$data["ANAKANGGOTABPJS"] += $key->jumlah;
				else
					$data["ANAKANGGOTABPJS"] = $key->jumlah;
			} else
			    if ($key->id_gol == "412" || $key->id_gol == "413") {
				if (isset($data["ANAKPURN"]))
					$data["ANAKPURN"] += $key->jumlah;
				else
					$data["ANAKPURN"] = $key->jumlah;
			} else
			    if ($key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18") {
				if (isset($data["ANAKUMUM"]))
					$data["ANAKUMUM"] += $key->jumlah;
				else
					$data["ANAKUMUM"] = $key->jumlah;
			}
		}
		return $data;
	}
	function getxkr13($kode, $tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah, sum(datediff(date(tgl_keluar), date(tgl_masuk))) as selisih");
		$this->db->where("date(pi.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->where("i.urut", 1);
		if ($kode == 0) {
			$this->db->like("i.kode", "S", "after");
		} else {
			$this->db->not_like("i.kode", "S", "after");
		}
		$this->db->where("pi.status_pulang", 4);
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("pi.id_gol");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "1") {
				if (isset($data["SATPUR"]))
					$data["SATPUR"] += $key->jumlah;
				else
					$data["SATPUR"] = $key->jumlah;
				if (isset($data["S-SATPUR"]))
					$data["S-SATPUR"] += $key->selisih;
				else
					$data["S-SATPUR"] = $key->selisih;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"]))
					$data["SATBANPUR"] += $key->jumlah;
				else
					$data["SATBANPUR"] = $key->jumlah;
				if (isset($data["S-SATBANPUR"]))
					$data["S-SATBANPUR"] += $key->selisih;
				else
					$data["S-SATBANPUR"] = $key->selisih;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"]))
					$data["SATBANMIN"] += $key->jumlah;
				else
					$data["SATBANMIN"] = $key->jumlah;
				if (isset($data["S-SATBANMIN"]))
					$data["S-SATBANMIN"] += $key->selisih;
				else
					$data["S-SATBANMIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "408") {
				if (isset($data["SIPILTNIAD"]))
					$data["SIPILTNIAD"] += $key->jumlah;
				else
					$data["SIPILTNIAD"] = $key->jumlah;
				if (isset($data["S-SIPILTNIAD"]))
					$data["S-SIPILTNIAD"] += $key->selisih;
				else
					$data["S-SIPILTNIAD"] = $key->selisih;
			} else
			    if ($key->id_gol == "415") {
				if (isset($data["KELTNIAD"]))
					$data["KELTNIAD"] += $key->jumlah;
				else
					$data["KELTNIAD"] = $key->jumlah;
				if (isset($data["S-KELTNIAD"]))
					$data["S-KELTNIAD"] += $key->selisih;
				else
					$data["S-KELTNIAD"] = $key->selisih;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"]))
					$data["MILLAIN"] += $key->jumlah;
				else
					$data["MILLAIN"] = $key->jumlah;
				if (isset($data["S-MILLAIN"]))
					$data["S-MILLAIN"] += $key->selisih;
				else
					$data["S-MILLAIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELLAIN"]))
					$data["KELLAIN"] += $key->jumlah;
				else
					$data["KELLAIN"] = $key->jumlah;
				if (isset($data["S-KELLAIN"]))
					$data["S-KELLAIN"] += $key->selisih;
				else
					$data["S-KELLAIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["SIPILLAIN"]))
					$data["SIPILLAIN"] += $key->jumlah;
				else
					$data["SIPILLAIN"] = $key->jumlah;
				if (isset($data["S-SIPILLAIN"]))
					$data["S-SIPILLAIN"] += $key->selisih;
				else
					$data["S-SIPILLAIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "412" || $key->id_gol == "413") {
				if (isset($data["PURNBPJS"]))
					$data["PURNBPJS"] += $key->jumlah;
				else
					$data["PURNBPJS"] = $key->jumlah;
				if (isset($data["S-PURNBPJS"]))
					$data["S-PURNBPJS"] += $key->selisih;
				else
					$data["S-PURNBPJS"] = $key->selisih;
			} else
			    if ($key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420") {
				if (isset($data["UMUMBPJS"]))
					$data["UMUMBPJS"] += $key->jumlah;
				else
					$data["UMUMBPJS"] = $key->jumlah;
				if (isset($data["S-UMUMBPJS"]))
					$data["S-UMUMBPJS"] += $key->selisih;
				else
					$data["S-UMUMBPJS"] = $key->selisih;
			} else
			    if ($key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18") {
				if (isset($data["UMUMPERUSAHAAN"]))
					$data["UMUMPERUSAHAAN"] += $key->jumlah;
				else
					$data["UMUMPERUSAHAAN"] = $key->jumlah;
				if (isset($data["S-UMUMPERUSAHAAN"]))
					$data["S-UMUMPERUSAHAAN"] += $key->selisih;
				else
					$data["S-UMUMPERUSAHAAN"] = $key->selisih;
			}
			if ($key->jk == "L") {
				if (isset($data["LAKI"]))
					$data["LAKI"] += $key->jumlah;
				else
					$data["LAKI"] = $key->jumlah;
			} else
			    if ($key->jk == "P") {
				if (isset($data["PEREMPUAN"]))
					$data["PEREMPUAN"] += $key->jumlah;
				else
					$data["PEREMPUAN"] = $key->jumlah;
			}
			if ($key->status_pulang == "4") {
				if (isset($data["MENINGGAL"]))
					$data["MENINGGAL"] += $key->jumlah;
				else
					$data["MENINGGAL"] = $key->jumlah;
			}
		}
		return $data;
	}
	function getmalaria($tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah, sum(datediff(date(tgl_keluar), date(tgl_masuk))) as selisih");
		$this->db->where("date(pi.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->group_start();
		$this->db->like("i.kode", "B50", "after");
		$this->db->or_like("i.kode", "B51", "after");
		$this->db->or_like("i.kode", "B52", "after");
		$this->db->or_like("i.kode", "B53", "after");
		$this->db->or_like("i.kode", "B54", "after");
		$this->db->group_end();
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("pi.id_gol");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "1") {
				if (isset($data["SATPUR"]))
					$data["SATPUR"] += $key->jumlah;
				else
					$data["SATPUR"] = $key->jumlah;
				if ($key->status_pulang == "4") {
					if (isset($data["MENINGGAL"]["SATPUR"]))
						$data["MENINGGAL"]["SATPUR"] += $key->jumlah;
					else
						$data["MENINGGAL"]["SATPUR"] = $key->jumlah;
				}
				if ($key->status_pulang == "1") {
					if (isset($data["SEMBUH"]["SATPUR"]))
						$data["SEMBUH"]["SATPUR"] += $key->jumlah;
					else
						$data["SEMBUH"]["SATPUR"] = $key->jumlah;
				}
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["SATPUR"]))
						$data["PENGOBATAN"]["SATPUR"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["SATPUR"] = $key->jumlah;
				}
				if (isset($data["S-SATPUR"]))
					$data["S-SATPUR"] += $key->selisih;
				else
					$data["S-SATPUR"] = $key->selisih;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"]))
					$data["SATBANPUR"] += $key->jumlah;
				else
					$data["SATBANPUR"] = $key->jumlah;
				if ($key->status_pulang == "4") {
					if (isset($data["MENINGGAL"]["SATBANPUR"]))
						$data["MENINGGAL"]["SATBANPUR"] += $key->jumlah;
					else
						$data["MENINGGAL"]["SATBANPUR"] = $key->jumlah;
				}
				if ($key->status_pulang == "1") {
					if (isset($data["SEMBUH"]["SATBANPUR"]))
						$data["SEMBUH"]["SATBANPUR"] += $key->jumlah;
					else
						$data["SEMBUH"]["SATBANPUR"] = $key->jumlah;
				}
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["SATBANPUR"]))
						$data["PENGOBATAN"]["SATBANPUR"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["SATBANPUR"] = $key->jumlah;
				}
				if (isset($data["S-SATBANPUR"]))
					$data["S-SATBANPUR"] += $key->selisih;
				else
					$data["S-SATBANPUR"] = $key->selisih;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"]))
					$data["SATBANMIN"] += $key->jumlah;
				else
					$data["SATBANMIN"] = $key->jumlah;
				if ($key->status_pulang == "4") {
					if (isset($data["MENINGGAL"]["SATBANMIN"]))
						$data["MENINGGAL"]["SATBANMIN"] += $key->jumlah;
					else
						$data["MENINGGAL"]["SATBANMIN"] = $key->jumlah;
				}
				if ($key->status_pulang == "1") {
					if (isset($data["SEMBUH"]["SATBANMIN"]))
						$data["SEMBUH"]["SATBANMIN"] += $key->jumlah;
					else
						$data["SEMBUH"]["SATBANMIN"] = $key->jumlah;
				}
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["SATBANMIN"]))
						$data["PENGOBATAN"]["SATBANMIN"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["SATBANMIN"] = $key->jumlah;
				}
				if (isset($data["S-SATBANMIN"]))
					$data["S-SATBANMIN"] += $key->selisih;
				else
					$data["S-SATBANMIN"] = $key->selisih;
			} else
			    if ($key->id_gol == "408" || $key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["PNS"]))
					$data["PNS"] += $key->jumlah;
				else
					$data["PNS"] = $key->jumlah;
				if ($key->status_pulang == "4") {
					if (isset($data["MENINGGAL"]["PNS"]))
						$data["MENINGGAL"]["PNS"] += $key->jumlah;
					else
						$data["MENINGGAL"]["PNS"] = $key->jumlah;
				}
				if ($key->status_pulang == "1") {
					if (isset($data["SEMBUH"]["PNS"]))
						$data["SEMBUH"]["PNS"] += $key->jumlah;
					else
						$data["SEMBUH"]["PNS"] = $key->jumlah;
				}
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["PNS"]))
						$data["PENGOBATAN"]["PNS"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["PNS"] = $key->jumlah;
				}
				if (isset($data["S-PNS"]))
					$data["S-PNS"] += $key->selisih;
				else
					$data["S-PNS"] = $key->selisih;
			} else
			    if ($key->id_gol == "415" || $key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELUARGA"]))
					$data["KELUARGA"] += $key->jumlah;
				else
					$data["KELUARGA"] = $key->jumlah;
				if ($key->status_pulang == "4") {
					if (isset($data["MENINGGAL"]["KELUARGA"]))
						$data["MENINGGAL"]["KELUARGA"] += $key->jumlah;
					else
						$data["MENINGGAL"]["KELUARGA"] = $key->jumlah;
				}
				if ($key->status_pulang == "1") {
					if (isset($data["SEMBUH"]["KELUARGA"]))
						$data["SEMBUH"]["KELUARGA"] += $key->jumlah;
					else
						$data["SEMBUH"]["KELUARGA"] = $key->jumlah;
				}
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["KELUARGA"]))
						$data["PENGOBATAN"]["KELUARGA"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["KELUARGA"] = $key->jumlah;
				}
				if (isset($data["S-KELUARGA"]))
					$data["S-KELUARGA"] += $key->selisih;
				else
					$data["S-KELUARGA"] = $key->selisih;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"]))
					$data["MILLAIN"] += $key->jumlah;
				else
					$data["MILLAIN"] = $key->jumlah;
				if ($key->status_pulang == "4") {
					if (isset($data["MENINGGAL"]["MILLAIN"]))
						$data["MENINGGAL"]["MILLAIN"] += $key->jumlah;
					else
						$data["MENINGGAL"]["MILLAIN"] = $key->jumlah;
				}
				if ($key->status_pulang == "1") {
					if (isset($data["SEMBUH"]["MILLAIN"]))
						$data["SEMBUH"]["MILLAIN"] += $key->jumlah;
					else
						$data["SEMBUH"]["MILLAIN"] = $key->jumlah;
				}
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["MILLAIN"]))
						$data["PENGOBATAN"]["MILLAIN"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["MILLAIN"] = $key->jumlah;
				}
				if (isset($data["S-MILLAIN"]))
					$data["S-MILLAIN"] += $key->selisih;
				else
					$data["S-MILLAIN"] = $key->selisih;
			} else
			    if (
				$key->id_gol == "412" || $key->id_gol == "413" ||
				$key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420" ||
				$key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18"
			) {
				if (isset($data["UMUM"]))
					$data["UMUM"] += $key->jumlah;
				else
					$data["UMUM"] = $key->jumlah;
				if ($key->status_pulang == "4") {
					if (isset($data["MENINGGAL"]["UMUM"]))
						$data["MENINGGAL"]["UMUM"] += $key->jumlah;
					else
						$data["MENINGGAL"]["UMUM"] = $key->jumlah;
				}
				if ($key->status_pulang == "1") {
					if (isset($data["SEMBUH"]["UMUM"]))
						$data["SEMBUH"]["UMUM"] += $key->jumlah;
					else
						$data["SEMBUH"]["UMUM"] = $key->jumlah;
				}
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["UMUM"]))
						$data["PENGOBATAN"]["UMUM"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["UMUM"] = $key->jumlah;
				}
				if (isset($data["S-UMUM"]))
					$data["S-UMUM"] += $key->selisih;
				else
					$data["S-UMUM"] = $key->selisih;
			}
		}
		return $data;
	}
	function getmalariapengobatan($tgl1 = "", $tgl2 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$tgl2 = $tgl2 == "" ? date("Y-m-d") : $tgl2;
		$this->db->select("id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah, sum(datediff(date(tgl_keluar), date(tgl_masuk))) as selisih");
		$this->db->where("date(pi.tgl_masuk)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pi.tgl_masuk)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->group_start();
		$this->db->like("i.kode", "B50", "after");
		$this->db->or_like("i.kode", "B51", "after");
		$this->db->or_like("i.kode", "B52", "after");
		$this->db->or_like("i.kode", "B53", "after");
		$this->db->or_like("i.kode", "B54", "after");
		$this->db->group_end();
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("pi.id_gol");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "1") {
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["SATPUR"]))
						$data["PENGOBATAN"]["SATPUR"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["SATPUR"] = $key->jumlah;
				}
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "2") {
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["SATBANPUR"]))
						$data["PENGOBATAN"]["SATBANPUR"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["SATBANPUR"] = $key->jumlah;
				}
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "3") {
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["SATBANMIN"]))
						$data["PENGOBATAN"]["SATBANMIN"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["SATBANMIN"] = $key->jumlah;
				}
			} else
			    if ($key->id_gol == "408" || $key->id_gol == "409" || $key->id_gol == "410") {
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["PNS"]))
						$data["PENGOBATAN"]["PNS"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["PNS"] = $key->jumlah;
				}
			} else
			    if ($key->id_gol == "415" || $key->id_gol == "416" || $key->id_gol == "417") {
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["KELUARGA"]))
						$data["PENGOBATAN"]["KELUARGA"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["KELUARGA"] = $key->jumlah;
				}
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["MILLAIN"]))
						$data["PENGOBATAN"]["MILLAIN"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["MILLAIN"] = $key->jumlah;
				}
			} else
			    if (
				$key->id_gol == "412" || $key->id_gol == "413" ||
				$key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420" ||
				$key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18"
			) {
				if ($key->status_pulang == "") {
					if (isset($data["PENGOBATAN"]["UMUM"]))
						$data["PENGOBATAN"]["UMUM"] += $key->jumlah;
					else
						$data["PENGOBATAN"]["UMUM"] = $key->jumlah;
				}
			}
		}
		return $data;
	}

	function getmalariasebelumnya($tgl1 = "")
	{
		$data = array();
		$tgl1 = $tgl1 == "" ? date("Y-m-d") : $tgl1;
		$this->db->select("id_cabang,pi.id_gol,pi.status_pulang,p.tgl_lahir,p.jenis_kelamin as jk,count(*) as jumlah, sum(datediff(date(tgl_keluar), date(tgl_masuk))) as selisih");
		$this->db->where("date(pi.tgl_keluar)<", date("Y-m-d", strtotime($tgl1)));
		$this->db->join("pasien p", "p.no_pasien=pi.no_rm", "inner");
		$this->db->join("indeks_inap_icd10 i", "i.no_reg=pi.no_reg", "inner");
		$this->db->group_start();
		$this->db->like("i.kode", "B50", "after");
		$this->db->or_like("i.kode", "B51", "after");
		$this->db->or_like("i.kode", "B52", "after");
		$this->db->or_like("i.kode", "B53", "after");
		$this->db->or_like("i.kode", "B54", "after");
		$this->db->group_end();
		$this->db->order_by("jumlah", "desc");
		$this->db->group_by("pi.id_gol");
		$sql = $this->db->get("pasien_inap pi");
		foreach ($sql->result() as $key) {
			if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "1") {
				if (isset($data["SATPUR"]))
					$data["SATPUR"] += $key->jumlah;
				else
					$data["SATPUR"] = $key->jumlah;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "2") {
				if (isset($data["SATBANPUR"]))
					$data["SATBANPUR"] += $key->jumlah;
				else
					$data["SATBANPUR"] = $key->jumlah;
			} else
			    if (($key->id_gol == "404" || $key->id_gol == "415") && $key->id_cabang == "3") {
				if (isset($data["SATBANMIN"]))
					$data["SATBANMIN"] += $key->jumlah;
				else
					$data["SATBANMIN"] = $key->jumlah;
			} else
			    if ($key->id_gol == "408" || $key->id_gol == "409" || $key->id_gol == "410") {
				if (isset($data["PNS"]))
					$data["PNS"] += $key->jumlah;
				else
					$data["PNS"] = $key->jumlah;
			} else
			    if ($key->id_gol == "415" || $key->id_gol == "416" || $key->id_gol == "417") {
				if (isset($data["KELUARGA"]))
					$data["KELUARGA"] += $key->jumlah;
				else
					$data["KELUARGA"] = $key->jumlah;
			} else
			    if ($key->id_gol == "405" || $key->id_gol == "406") {
				if (isset($data["MILLAIN"]))
					$data["MILLAIN"] += $key->jumlah;
				else
					$data["MILLAIN"] = $key->jumlah;
			} else
			    if (
				$key->id_gol == "412" || $key->id_gol == "413" ||
				$key->id_gol == "400" || $key->id_gol == "401"  || $key->id_gol == "402" || $key->id_gol == "403" || $key->id_gol == "407" || $key->id_gol == "411" || $key->id_gol == "414" || $key->id_gol == "418" || $key->id_gol == "419" || $key->id_gol == "420" ||
				$key->id_gol == "11" || $key->id_gol == "12" || $key->id_gol == "13" || $key->id_gol == "16" || $key->id_gol == "17" || $key->id_gol == "18"
			) {
				if (isset($data["UMUM"]))
					$data["UMUM"] += $key->jumlah;
				else
					$data["UMUM"] = $key->jumlah;
			}
		}
		return $data;
	}
	function getcovid($tgl1, $tgl2, $golpas = "all", $tingkat_status = "all")
	{
		$this->db->select("p.nama_pasien,p.hubungan_keluarga,p.telpon,p.ktp,pk.pekerjaan,p.nama_pasangan,p.tgl_lahir,p.jenis_kelamin,p.alamat,d.name as kecamatan,v.name as kelurahan,ap.no_reg,ap.status,pr.name as province,r.name as kota,ap.tglresiko,ap.suhu,ap.gejala,ap.tglgejala,ap.tujuan,ap.td,ap.td2,ap.nadi,ap.respirasi,ap.spo2,ap.bb,ap.tb,ap.tanggal,ap.jam");
		$this->db->where("ap.tanggal>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("ap.tanggal<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->where("ap.status!=", "");
		if ($golpas != "all") $this->db->where("ap.status", $golpas);
		if ($tingkat_status != "all") $this->db->where("ap.tingkat_status", $tingkat_status);
		$this->db->where("ap.shift", "igd");
		$this->db->join("pasien_triage pt", "pt.no_reg=ap.no_reg", "inner");
		$this->db->join("pasien p", "p.no_pasien=pt.no_rm", "inner");
		$this->db->join("pekerjaan pk", "pk.idx=p.pekerjaan", "left");
		$this->db->join("districts d", "d.id=p.id_kecamatan", "left");
		$this->db->join("villages v", "v.id=p.id_kelurahan", "left");
		$this->db->join("provinces pr", "pr.id=ap.prov", "left");
		$this->db->join("regencies r", "r.id=ap.kota", "left");
		$this->db->order_by("ap.tanggal,ap.jam");
		$q = $this->db->get("assesmen_perawat ap");
		return $q;
	}
	function getpasienigd($tgl1, $tgl2, $golpas = "all", $tingkat_status = "all")
	{
		$this->db->where("ap.tanggal>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("ap.tanggal<=", date("Y-m-d", strtotime($tgl2)));
		if ($golpas != "all") $this->db->where("ap.status", $golpas);
		if ($tingkat_status != "all") $this->db->where("ap.tingkat_status", $tingkat_status);
		$q = $this->db->get("assesmen_perawat ap");
		$data = array();
		foreach ($q->result() as $key) {
			if ($key->jenis == "ranap") {
				$n = $this->db->get_where("pasien_igdinap", ["no_reg" => $key->no_reg]);
				$data["ket"][$key->no_reg] = $n->row();
				$n = $this->db->get_where("ekspertisi_radinap", ["no_reg" => $key->no_reg]);
				$data["rad"][$key->no_reg] = $n->row();
				$this->db->select("l.*,e.*,t.nama_tindakan, j.judul");
				$this->db->join("lab_normal l", "l.kode_tindakan=e.kode_tindakan and l.kode=e.kode_labnormal");
				$this->db->join("tarif_lab t", "t.kode_tindakan=e.kode_tindakan and t.kode_tindakan=l.kode_tindakan");
				$this->db->join("lab_judul j", "j.kode_judul=e.kode_judul and j.kode_judul=l.kode_judul");
				$this->db->where("e.no_reg", $key->no_reg);
				$this->db->where("e.pemeriksaan", 1);
				$this->db->order_by("e.kode_judul,l.no_urut");
				$n = $this->db->get("ekspertisi_labinap e");
				$data["lab"][$key->no_reg] = $n;
			} else {
				$n = $this->db->get_where("pasien_igd", ["no_reg" => $key->no_reg]);
				$data["ket"][$key->no_reg] = $n->row();
				$n = $this->db->get_where("ekspertisi", ["no_reg" => $key->no_reg]);
				$data["rad"][$key->no_reg] = $n->row();
				$this->db->select("l.*,e.*,t.nama_tindakan,j.judul");
				$this->db->join("lab_normal l", "l.kode_tindakan=e.kode_tindakan and l.kode=e.kode_labnormal");
				$this->db->join("tarif_lab t", "t.kode_tindakan=e.kode_tindakan and t.kode_tindakan=l.kode_tindakan");
				$this->db->join("lab_judul j", "j.kode_judul=e.kode_judul and j.kode_judul=l.kode_judul");
				$this->db->where("e.no_reg", $key->no_reg);
				$this->db->order_by("l.no_urut");
				$n = $this->db->get("ekspertisi_lab e");
				$data["lab"][$key->no_reg] = $n;
			}
		}
		return $data;
	}
	function golpasien()
	{
		return $this->db->get("gol_pasien_covid");
	}
	function getkualifikasi_pendidikan_parent()
	{
		return $this->db->get_where("kualifikasi_pendidikan", ["parent" => 0]);
	}
	function getkeputusan()
	{
		$this->db->group_by("laporan");
		$q = $this->db->get("keputusan");
		$data = array();
		$string = array("", "Bedah", "Non Bedah", "Kebidanan", "Psikiater", "Anak");
		foreach ($q->result() as $key) {
			$data[$key->laporan] = $string[$key->laporan];
		}
		return $data;
	}
	function getkualifikasi_pendidikan($parent)
	{
		$data = array();
		$this->db->order_by("kode");
		$this->db->where("parent", 0);
		if ($parent != "all")
			$this->db->where("kode", $parent);
		$q = $this->db->get("kualifikasi_pendidikan");
		foreach ($q->result() as $row) {
			$data["parent"][$row->kode] = $row;
		}
		if ($parent != "all")
			$this->db->where("parent", $parent);
		$q = $this->db->get("kualifikasi_pendidikan");
		foreach ($q->result() as $row) {
			$data["child"][$row->parent][$row->kode] = $row;
		}
		return $data;
	}
	function getrl2_ketenagaan($tahun)
	{
		$q = $this->db->get_where("rl2_ketenagaan", ["tahun" => $tahun]);
		$data = array();
		foreach ($q->result() as $key) {
			$data[$key->parent][$key->kode] = $key;
		}
		return $data;
	}
	function simpanrl2_ketenagaan()
	{
		$this->db->where("tahun", $this->input->post("tahun"));
		$this->db->where("parent", $this->input->post("parent"));
		$this->db->delete("rl2_ketenagaan");
		$this->db->where("tahun", $this->input->post("tahun"));
		$this->db->where("kode", $this->input->post("parent"));
		$this->db->delete("rl2_ketenagaan");
		$this->db->order_by("kode");
		$this->db->where("kode", $this->input->post("parent"));
		$this->db->or_where("parent", $this->input->post("parent"));
		$q = $this->db->get("kualifikasi_pendidikan");
		$data = array();
		foreach ($q->result() as $row) {
			$data[] = array(
				"tahun" => $this->input->post("tahun"),
				"parent" => $row->parent,
				"kode" => $row->kode,
				"keadaan_laki" => $this->input->post("keadaan_laki_" . $row->parent . "_" . $row->kode),
				"keadaan_perempuan" => $this->input->post("keadaan_perempuan_" . $row->parent . "_" . $row->kode),
				"kebutuhan_laki" => $this->input->post("kebutuhan_laki_" . $row->parent . "_" . $row->kode),
				"kebutuhan_perempuan" => $this->input->post("kebutuhan_perempuan_" . $row->parent . "_" . $row->kode),
				"kekurangan_laki" => $this->input->post("kekurangan_laki_" . $row->parent . "_" . $row->kode),
				"kekurangan_perempuan" => $this->input->post("kekurangan_perempuan_" . $row->parent . "_" . $row->kode)
			);
		}
		$this->db->insert_batch("rl2_ketenagaan", $data);
		return $data;
	}
	function rl32_rawatdarurat($tahun)
	{
		$data = array();
		$this->db->select("k.laporan,pt.keputusan,k.nama, count(*) as jumlah");
		$this->db->where("pt.tindak_lanjut", "rujuk");
		$this->db->group_start();
		$this->db->where("pr.keadaan_pulang!=", "4");
		$this->db->or_where("pr.keadaan_pulang!=", "5");
		$this->db->group_end();
		$this->db->where("year(pt.tanggal)", $tahun);
		$this->db->join("pasien_ralan pr", "pr.no_pasien=pt.no_rm and pr.no_reg=pt.no_reg", "inner");
		$this->db->join("keputusan k", "k.kode=pt.keputusan", "inner");
		$q = $this->db->get("pasien_triage pt");
		foreach ($q->result() as $key) {
			if (isset($data["total_rujuk"][$key->keputusan])) {
				$data["total_rujuk"][$key->keputusan] += $key->jumlah;
			} else
				$data["total_rujuk"][$key->keputusan] = $key->jumlah;
		}
		$this->db->select("k.laporan,pt.keputusan,k.nama, count(*) as jumlah");
		$this->db->where("pt.tindak_lanjut", "ralan");
		$this->db->group_start();
		$this->db->where("pr.keadaan_pulang!=", "4");
		$this->db->or_where("pr.keadaan_pulang!=", "5");
		$this->db->group_end();
		$this->db->where("year(pt.tanggal)", $tahun);
		$this->db->join("pasien_ralan pr", "pr.no_pasien=pt.no_rm and pr.no_reg=pt.no_reg", "inner");
		$this->db->join("keputusan k", "k.kode=pt.keputusan", "inner");
		$this->db->group_by("k.laporan");
		$q = $this->db->get("pasien_triage pt");
		foreach ($q->result() as $key) {
			if (isset($data["total_nonrujuk"][$key->keputusan])) {
				$data["total_ralan"][$key->keputusan] += $key->jumlah;
			} else
				$data["total_ralan"][$key->keputusan] = $key->jumlah;
		}
		$this->db->select("k.laporan,pt.keputusan,k.nama, count(*) as jumlah");
		$this->db->where("pt.tindak_lanjut", "ranap");
		$this->db->group_start();
		$this->db->where("pr.keadaan_pulang!=", "4");
		$this->db->or_where("pr.keadaan_pulang!=", "5");
		$this->db->group_end();
		$this->db->where("year(pt.tanggal)", $tahun);
		$this->db->join("pasien_inap pr", "pr.no_rm=pt.no_rm and pr.no_reg=pt.no_reg", "inner");
		$this->db->join("keputusan k", "k.kode=pt.keputusan", "inner");
		$this->db->group_by("k.laporan");
		$q = $this->db->get("pasien_triage pt");
		foreach ($q->result() as $key) {
			if (isset($data["total_nonrujuk"][$key->keputusan])) {
				$data["total_ranap"][$key->keputusan] += $key->jumlah;
			} else
				$data["total_ranap"][$key->keputusan] = $key->jumlah;
		}
		$this->db->select("k.laporan,pt.keputusan,k.nama, count(*) as jumlah");
		$this->db->where("pt.tindak_lanjut", "ralan");
		$this->db->group_start();
		$this->db->where("pr.keadaan_pulang", "4");
		$this->db->or_where("pr.keadaan_pulang", "5");
		$this->db->group_end();
		$this->db->where("year(pt.tanggal)", $tahun);
		$this->db->join("pasien_ralan pr", "pr.no_pasien=pt.no_rm and pr.no_reg=pt.no_reg", "inner");
		$this->db->join("keputusan k", "k.kode=pt.keputusan", "inner");
		$this->db->group_by("k.laporan");
		$q = $this->db->get("pasien_triage pt");
		foreach ($q->result() as $key) {
			if (isset($data["total_matiigd"][$key->keputusan])) {
				$data["total_matiigd"][$key->keputusan] += $key->jumlah;
			} else
				$data["total_matiigd"][$key->keputusan] = $key->jumlah;
		}
		$this->db->select("k.laporan,pt.keputusan,k.nama, count(*) as jumlah");
		$this->db->where("pt.triage", "D.O.A");
		$this->db->where("year(pt.tanggal)", $tahun);
		$this->db->join("keputusan k", "k.kode=pt.keputusan", "inner");
		$this->db->group_by("k.laporan");
		$q = $this->db->get("pasien_triage pt");
		foreach ($q->result() as $key) {
			if (isset($data["total_doa"][$key->keputusan])) {
				$data["total_doa"][$key->keputusan] += $key->jumlah;
			} else
				$data["total_doa"][$key->keputusan] = $key->jumlah;
		}
		return $data;
	}
	function getpasien_inos($tgl1, $tgl2)
	{
		$this->db->select("i.*,r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs,p.jenis_kelamin,m.nama as diagnosa_penyakit,p.tgl_lahir,n.spesialisasi,n.tanggal as tgl_inos,n.jenis_inos,s.keterangan as spesialisasi");
		if ($tgl1 != "" or $tgl2 != "") {
			$this->db->where("i.tgl_masuk>=", date("Y-m-d", strtotime($tgl1)));
			$this->db->where("i.tgl_masuk<=", date("Y-m-d", strtotime($tgl2)));
		}
		$this->db->join("pasien p", "p.no_pasien=i.no_rm");
		$this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
		$this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
		$this->db->join("master_icd m", "m.kode=i.diagnosa_masuk", "left");
		$this->db->join("inos n", "n.no_reg=i.no_reg", "inner");
		$this->db->join("spesialisasi_ruanginap s", "s.kode=n.spesialisasi", "left");
		$this->db->order_by("no_reg,no_rm", "desc");
		$query = $this->db->get("pasien_inap i");
		$data = array();
		foreach ($query->result() as $row) {
			$data["data"][$row->no_reg] = $row;
			$data["inos"][$row->no_reg][$row->jenis_inos] = $row;
		}
		return $data;
	}
	function kunjunganralan($tgl1, $tgl2)
	{
		$this->db->select("pr.*,p.nama_pasien,p.no_bpjs,g.kode,pk.briging");
		$this->db->where("date(pr.tanggal)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pr.tanggal)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->where("pr.layan!=", 2);
		$this->db->join("pasien p", "p.no_pasien=pr.no_pasien");
		$this->db->join("grouper_ralan_icd9 g", "g.no_reg=pr.no_reg");
		$this->db->join("poliklinik pk", "pk.kode=pr.tujuan_poli");
		$query = $this->db->get("pasien_ralan pr");
		return $query;
	}
	function kunjunganranap($tgl1, $tgl2)
	{
		$this->db->select("pr.*,p.nama_pasien,p.no_bpjs,g.kode");
		$this->db->where("date(pr.tgl_keluar)>=", date("Y-m-d", strtotime($tgl1)));
		$this->db->where("date(pr.tgl_keluar)<=", date("Y-m-d", strtotime($tgl2)));
		$this->db->join("pasien p", "p.no_pasien=pr.no_rm");
		$this->db->join("grouper_inap_icd9 g", "g.no_reg=pr.no_reg");
		$query = $this->db->get("pasien_inap pr");
		return $query;
	}
	function gettindakan($tindakan)
	{
		if ($tindakan == "lab") {
			$q = $this->db->get("tarif_lab");
		} else {
			$q = $this->db->get("tarif_radiologi");
		}
		return $q;
	}
	function laporanradlab($tindakan, $tgl1, $tgl2)
	{
		if ($tindakan == "lab") {
			$q = $this->db->get("tarif_lab");
		} else {
			$q = $this->db->get("tarif_radiologi");
		}
		return $q;
	}
	function getpoliklinik()
	{
		$this->db->order_by("kode");
		return $this->db->get("poliklinik");
	}
	function getlaprl12_kunjungan($tgl1, $tgl2)
	{
		$t1 = date("Y-m-d", strtotime($tgl1));
		$t2 = date("Y-m-d", strtotime($tgl2));
		$q 		= $this->getpoliklinik();
		$data 	= array();
		$this->db->select("count(*) as jumlah,tujuan_poli,rl12");
		$this->db->join("gol_pasien gp", "gp.id_gol=pr.gol_pasien");
		$this->db->where("date(tanggal)>=", $t1);
		$this->db->where("date(tanggal)<=", $t2);
		$this->db->group_by("pr.tujuan_poli,rl12");
		$this->db->where("pr.layan<>", "2");
		$q1		= $this->db->get("pasien_ralan pr");
		foreach ($q1->result() as $value) {
			$data[$value->tujuan_poli][$value->rl12] = $value->jumlah;
		}
		return $data;
	}
	function getlaprl12_pengunjung($tgl1, $tgl2)
	{
		$t1 = date("Y-m-d", strtotime($tgl1));
		$t2 = date("Y-m-d", strtotime($tgl2));
		$q 		= $this->getpoliklinik();
		$data 	= array();
		$this->db->select("count(no_pasien) as pasien,tujuan_poli,rl12");
		$this->db->join("gol_pasien gp", "gp.id_gol=pr.gol_pasien");
		$this->db->where("date(tanggal)>=", $t1);
		$this->db->where("date(tanggal)<=", $t2);
		$this->db->where("rl12", "UMUMBPJS");
		$this->db->group_by("no_pasien");
		$this->db->where("pr.layan<>", "2");
		$q1		= $this->db->get("pasien_ralan pr");
		foreach ($q1->result() as $value) {
			$data[$value->tujuan_poli] = $value->jumlah;
		}
		return $data;
	}
	function getinos($ruangan, $b, $thn)
	{
		$this->db->select("i.*,n.tanggal,n.pasien_tirah,n.terpasang,n.oprasi,r.nama_ruangan as ruangan");
		$this->db->join("inos n", "n.no_reg=i.no_reg", "left");
		$this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
		if ($ruangan != "all") {
			$this->db->where("r.kode_bagian", $ruangan);
		}
		$this->db->order_by("i.no_reg,i.tgl_masuk");
		$this->db->group_by("i.no_reg");
		$q = $this->db->get("pasien_inap i");
		$data = array();
		foreach ($q->result() as $key) {
			$data["list"][date("d-m-Y", strtotime($key->tgl_masuk))] = $key;
			// $tgl_masuk = date("Y-m-d", strtotime($key->tgl_masuk));
			$tgl_keluar = ($key->tgl_keluar == "" || $key->tgl_keluar == null) ? "kosong" : date("Y-m-d", strtotime($key->tgl_keluar));
			$tgl_masuk = ($key->tgl_masuk == "" || $key->tgl_masuk == null) ? "kosong" : date("Y-m-d", strtotime($key->tgl_masuk));
			if (isset($data["lama"][$tgl_keluar][$tgl_masuk])) $data["lama"][$tgl_keluar][$tgl_masuk] += 1;
			else $data["lama"][$tgl_keluar][$tgl_masuk] = 1;
			if (isset($data["baru"][$key->tgl_masuk])) $data["baru"][$key->tgl_masuk] += 1;
			else $data["baru"][$key->tgl_masuk] = 1;
			// if (isset($data["lama"][$tgl_keluar])) $data["lama"][$tgl_keluar] += 1;
			// else $data["lama"][$tgl_keluar] = 1;
			if ($key->pasien_tirah == "Ya") {
				if (isset($data["tirahya"][date("d-m-Y", strtotime($key->tanggal))])) $data["tirahya"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["tirahya"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			} else {
				if (isset($data["tirahtdk"][date("d-m-Y", strtotime($key->tanggal))])) $data["tirahtdk"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["tirahtdk"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			}
			if (strpos($key->terpasang, "INFUS") !== FALSE) {
				if (isset($data["infus"][date("d-m-Y", strtotime($key->tanggal))])) $data["infus"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["infus"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			} else
				if (strpos($key->terpasang, "CVC") !== FALSE) {
				if (isset($data["cvc"][date("d-m-Y", strtotime($key->tanggal))])) $data["cvc"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["cvc"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			} else
				if (strpos($key->terpasang, "UC") !== FALSE) {
				if (isset($data["uc"][date("d-m-Y", strtotime($key->tanggal))])) $data["uc"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["uc"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			} else
				if (strpos($key->terpasang, "VENTILATOR") !== FALSE) {
				if (isset($data["ventilator"][date("d-m-Y", strtotime($key->tanggal))])) $data["ventilator"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["ventilator"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			}
			if ($key->oprasi == "Ya") {
				if (isset($data["operasiya"][date("d-m-Y", strtotime($key->tanggal))])) $data["operasiya"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["operasiya"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			} else {
				if (isset($data["operasitdk"][date("d-m-Y", strtotime($key->tanggal))])) $data["operasitdk"][date("d-m-Y", strtotime($key->tanggal))] += 1;
				else $data["operasitdk"][date("d-m-Y", strtotime($key->tanggal))] = 1;
			}
			if (isset($data[$key->jenis_inos][date("d-m-Y", strtotime($key->tanggal))])) $data[$key->jenis_inos][date("d-m-Y", strtotime($key->tanggal))] += 1;
			else $data[$key->jenis_inos][date("d-m-Y", strtotime($key->tanggal))] = 1;
		}
		return $data;
	}
	function getruangan()
	{
		$this->db->group_by("sensus");
		$q = $this->db->get("ruangan");
		$data = array();
		foreach ($q->result() as $row) {
			$data[$row->sensus] = $row;
		}
		return $data;
	}
	function getjumlahinos()
	{
		$this->db->select("i.*,n.tanggal,n.pasien_tirah,n.terpasang,n.oprasi,r.nama_ruangan as ruangan");
		// $this->db->where("ISNULL(tgl_keluar)", 1);
		$this->db->join("pasien p", "p.no_pasien=i.no_rm");
		$this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
		$this->db->join("pasien_inap i", "i.no_reg=n.no_reg", "inner");
		$this->db->order_by("n.no_reg,n.tanggal");
		$q = $this->db->get("inos n");
		return $q;
	}
	function sensusharian($ruangan, $b, $thn)
	{
		$this->db->select("i.*,g.jenis,r.nama_ruangan as ruangan");
		$this->db->join("gol_pasien g", "g.id_gol=i.id_gol", "left");
		$this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
		// $this->db->join("kamar k", "k.kode_ruangan=i.kode_ruangan and k.kode_kamar=i.kode_kamar and k.kode_kelas=i.kode_kelas and k.no_bed=i.no_bed", "inner");
		if ($ruangan != "all") {
			if ($ruangan == "covid") {
				$this->db->where("i.kode_kelas",11);
				$this->db->where("i.kode_ruangan!=",19);
			} else
			if ($ruangan == "08" || $ruangan == "07" || $ruangan == "06") {
				$this->db->where("i.kode_kelas",$ruangan);
			} else
			if ($ruangan == "vip") {
				$this->db->group_start();
				$this->db->where("i.kode_kelas","02");
				$this->db->or_where("i.kode_kelas","03");
				$this->db->or_where("i.kode_kelas","04");
				$this->db->or_where("i.kode_kelas","51");
				$this->db->or_where("i.kode_kelas","52");
				$this->db->or_where("i.kode_kelas","53");
				$this->db->group_end();
			} else {
				$this->db->where("r.sensus", $ruangan);
			}
		}
		$this->db->order_by("i.no_reg,i.tgl_masuk");
		$this->db->group_by("i.no_reg");
		$q = $this->db->get("pasien_inap i");
		$data = array();
		foreach ($q->result() as $key) {
			$data["list"][date("d-m-Y", strtotime($key->tgl_masuk))] = $key;
			$tgl_keluar = ($key->tgl_keluar == "" || $key->tgl_keluar == null) ? "kosong" : date("Y-m-d", strtotime($key->tgl_keluar));
			$tgl_masuk = ($key->tgl_masuk == "" || $key->tgl_masuk == null) ? "kosong" : date("Y-m-d", strtotime($key->tgl_masuk));
			if (isset($data["lama"][$tgl_keluar][$tgl_masuk][$key->id_gol])) $data["lama"][$tgl_keluar][$tgl_masuk][$key->id_gol] += 1;
			else $data["lama"][$tgl_keluar][$tgl_masuk][$key->id_gol] = 1;
			if (isset($data["baru"][$key->tgl_masuk][$key->id_gol])) $data["baru"][$key->tgl_masuk][$key->id_gol] += 1;
			else $data["baru"][$key->tgl_masuk][$key->id_gol] = 1;

			if (isset($data["lama"][$tgl_keluar][$tgl_masuk][$key->jenis])) $data["lama"][$tgl_keluar][$tgl_masuk][$key->jenis] += 1;
			else $data["lama"][$tgl_keluar][$tgl_masuk][$key->jenis] = 1;
			if (isset($data["baru"][$key->tgl_masuk][$key->jenis])) $data["baru"][$key->tgl_masuk][$key->jenis] += 1;
			else $data["baru"][$key->tgl_masuk][$key->jenis] = 1;

			if (isset($data["pulang"][$tgl_keluar][$key->status_pulang][$key->id_gol])) $data["pulang"][$tgl_keluar][$key->status_pulang][$key->id_gol] += 1;
			else $data["pulang"][$tgl_keluar][$key->status_pulang][$key->id_gol] = 1;
			if (isset($data["pulang"][$tgl_keluar][$key->status_pulang][$key->jenis])) $data["pulang"][$tgl_keluar][$key->status_pulang][$key->jenis] += 1;
			else $data["pulang"][$tgl_keluar][$key->status_pulang][$key->jenis] = 1;

			if (isset($data["meninggal"][$tgl_keluar][$key->keadaan_pulang][$key->id_gol])) $data["meninggal"][$tgl_keluar][$key->keadaan_pulang][$key->id_gol] += 1;
			else $data["meninggal"][$tgl_keluar][$key->keadaan_pulang][$key->id_gol] = 1;
			if (isset($data["meninggal"][$tgl_keluar][$key->keadaan_pulang][$key->jenis])) $data["meninggal"][$tgl_keluar][$key->keadaan_pulang][$key->jenis] += 1;
			else $data["meninggal"][$tgl_keluar][$key->keadaan_pulang][$key->jenis] = 1;
		}
		return $data;
	}
}
