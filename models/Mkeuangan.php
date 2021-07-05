<?php
class Mkeuangan extends CI_Model{
    function __construct(){
      parent::__construct();
    }
    function getdokter(){
        $this->db->order_by("id_dokter");
        $q = $this->db->get("dokter");
        return $q;
    }
    function getdokter_array(){
		$this->db->select("id_dokter,nama_dokter");
		$q = $this->db->get("dokter");
		$data = array();
		foreach ($q->result() as $key) {
			$data[$key->id_dokter] = $key->nama_dokter;
		}
		return $data;
    }
    function getperawat_array(){
		$this->db->select("kode,nama");
		$q = $this->db->get("asisten_anastesi");
		$data = array();
		foreach ($q->result() as $key) {
			$data[$key->kode] = $key->nama;
		}
		return $data;
    }
    function getpajakdokter($tgl){
        $this->db->where("month(tanggal)",date("m",strtotime($tgl)));
        $this->db->where("year(tanggal)",date("Y",strtotime($tgl)));
		$q = $this->db->get("pajak");
		$data = array();
		foreach ($q->result() as $key) {
			$data[$key->id_dokter] = $key->jumlah;
		}
		return $data;
	}
    function getpajak($tgl){
        $this->db->where("tanggal",date("Y-m-d",strtotime($tgl)));
        $q = $this->db->get("pajak");
        $data = array();
        foreach ($q->result() as $key) {
            $data[$key->id_dokter][$key->tanggal] = $key->jumlah;
        }
        return $data; 
    }
    function simpan(){
        $this->db->where("tanggal",date("Y-m-d",strtotime("01-".$this->input->post("tgl"))));
        $this->db->delete("pajak");
        $jumlah = $this->input->post("pajak");
        $data = array();
        foreach ($jumlah as $key => $value) {
            $data[] = array(
                    "tanggal" => date("Y-m-d",strtotime("01-".$this->input->post("tgl"))),
                    "id_dokter" => $key,
                    "jumlah" => $value
                );
        }
        $this->db->insert_batch("pajak",$data);
    }
    function feesharing($tgl1,$tgl2){
		$data = array();
		$this->db->select("k.no_reg,k.kode_petugas,k.kode_tarif,k.jumlah");
		// $this->db->join("tarif_ralan tr","tr.kode_tindakan=k.kode_tarif","inner");
		// $this->db->join("pasien_ralan pr","pr.no_reg=k.no_reg","inner");
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')>=",date("Y-m-d",strtotime($tgl1)));
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("k.kode_tarif!=","FRM");
        $this->db->where("k.kode_tarif!=","T173");
        $this->db->where("k.kode_tarif!=","T292");
        $this->db->order_by("k.no_reg");
		$this->db->group_by("k.no_reg,k.kode_petugas,k.kode_tarif");
		$q = $this->db->get("kasir k");
		foreach($q->result() as $row){
            $this->db->select("pr.no_reg,pr.no_reg_sebelumnya,p.nama_pasien,pr.dokter_poli,pr.gol_pasien,(pr.tarif_bpjs+pr.obat_kronis) as tarif_bpjs,pr.tarif_rumahsakit,'ralan' as pelayanan");
            $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
            $this->db->where("pr.no_reg",$row->no_reg);
            $this->db->where("pr.layan!=",2);
            $this->db->where("pr.keadaan_pulang!=",6);
            $this->db->order_by("pr.no_reg");
            $p = $this->db->get("pasien_ralan pr");
            if ($p->num_rows()>0){
                $p = $p->row();
                if ($p->no_reg_sebelumnya!=""){
                    $this->db->select("'".$row->no_reg."' as no_reg,pr.no_reg_sebelumnya,p.nama_pasien,pr.dokter_poli,pr.gol_pasien,(pr.tarif_bpjs+pr.obat_kronis) as tarif_bpjs,pr.tarif_rumahsakit,'ralan' as pelayanan");
                    $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
                    $this->db->where("pr.no_reg",$p->no_reg_sebelumnya);
                    // $this->db->where("pr.layan!=","2");
                    // $this->db->where("pr.keadaan_pulang!=","6");
                    $this->db->order_by("pr.no_reg");
                    $n = $this->db->get("pasien_ralan pr");
                    if ($n->num_rows()>0) {
                        $p = $n->row();
                    }
                }
                if ($p->gol_pasien==11){
                    $str_golpas = "UMUM";
                } else 
                if ($p->gol_pasien>=12 && $p->gol_pasien<=18){
                    $str_golpas = "PERUSAHAAN";
                } else {
                    $str_golpas = "BPJS";
                }
                if ($row->kode_petugas==null || $row->kode_petugas==""){
                    $kode_petugas = $p->dokter_poli;
                } else {
                    $kode_petugas = $row->kode_petugas;
                }
                if (isset($data["pelayanan_ralan"][$kode_petugas][$str_golpas])){
                    $data["pelayanan_ralan"][$kode_petugas][$str_golpas] += $row->jumlah;
                } else {
                    $data["pelayanan_ralan"][$kode_petugas][$str_golpas] = $row->jumlah;
                }
                if (isset($data["tarifrs"][$row->kode_tarif][$row->no_reg])){
                    $data["tarifrs"][$row->kode_tarif][$row->no_reg] += $row->jumlah;
                } else {
                    $data["tarifrs"][$row->kode_tarif][$row->no_reg] = $row->jumlah;
                }
                if (!isset($data["tarifdokter"][$row->kode_tarif])){
                    $g = $this->db->get_where("tarif_ralan",["kode_tindakan"=>$row->kode_tarif]);
                    if ($g->num_rows()>0){
                        $grow = $g->row();
                        $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                        $data["tarifdokterumum"][$row->kode_tarif] = $grow->dokter_umum;
                        $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                    } else {
                        $g = $this->db->get_where("tarif_radiologi",["id_tindakan"=>$row->kode_tarif]);
                        if ($g->num_rows()>0){
                            $grow = $g->row();
                            $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                            $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                        } else {
                            $g = $this->db->get_where("tarif_lab",["kode_tindakan"=>$row->kode_tarif]);
                            if ($g->num_rows()>0){
                                $grow = $g->row();
                                $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                                $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                            } else {
                                $g = $this->db->get_where("tarif_penunjang_medis",["kode"=>$row->kode_tarif]);
                                if ($g->num_rows()>0){
                                    $grow = $g->row();
                                    $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                                    $data["namatarifdokter"][$row->kode_tarif] = $grow->ket;
                                } else {
                                    $data["tarifdokter"][$row->kode_tarif] = 0;
                                    $data["namatarifdokter"][$row->kode_tarif] = "";
                                }
                            }
                        }
                    }
                }
                $data["detail"][$kode_petugas][$row->no_reg][$row->kode_tarif] = $p;
                $data["golpas"][$row->no_reg] = $str_golpas;
            }
        }
        $this->db->select("k.no_reg,k.kode_petugas,k.kode_tarif,sum(k.qty*k.jumlah) as jumlah");
		// $this->db->join("pasien_inap pr","pr.no_reg=k.no_reg","inner");
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')>=",date("Y-m-d",strtotime($tgl1)));
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')<=",date("Y-m-d",strtotime($tgl2)));
		$this->db->where("k.kode_tarif!=","FRM");
		$this->db->where("k.kode_tarif!=","hdl");
		$this->db->where("k.kode_tarif!=","asisten_anaestesi");
		$this->db->group_by("k.no_reg,k.kode_petugas,k.kode_tarif");
		$q = $this->db->get("kasir_inap k");
		foreach($q->result() as $row){
            $this->db->select("pr.no_reg,p.nama_pasien,pr.dokter,pr.id_gol as gol_pasien,(pr.tarif_bpjs+pr.sharing+pr.obat_kronis) as tarif_bpjs,pr.tarif_rumahsakit,'ranap' as pelayanan"); 
            $this->db->join("pasien p","p.no_pasien=pr.no_rm","inner");
            $this->db->where("pr.no_reg",$row->no_reg);
            $this->db->order_by("pr.no_reg");
            $p = $this->db->get("pasien_inap pr");
            if ($p->num_rows()>0){
                $p = $p->row();
                if ($p->gol_pasien==11){
                    $str_golpas = "UMUM";
                } else 
                if ($p->gol_pasien>=12 && $p->gol_pasien<=18){
                    $str_golpas = "PERUSAHAAN";
                } else {
                    $str_golpas = "BPJS";
                }
                $kode_petugas = $row->kode_petugas;
                if (isset($data["pelayanan_inap"][$kode_petugas][$str_golpas])){
                    $data["pelayanan_inap"][$kode_petugas][$str_golpas] += $row->jumlah;
                } else {
                    $data["pelayanan_inap"][$kode_petugas][$str_golpas] = $row->jumlah;
                }
                if (isset($data["tarifrs"][$row->kode_tarif][$row->no_reg])){
                    $data["tarifrs"][$row->kode_tarif][$row->no_reg] += $row->jumlah;
                } else {
                    $data["tarifrs"][$row->kode_tarif][$row->no_reg] = $row->jumlah;
                }
                if (!isset($data["tarifdokter"][$row->kode_tarif])){
                    $g = $this->db->get_where("tarif_inap",["kode_tindakan"=>$row->kode_tarif]);
                    if ($g->num_rows()>0){
                        $grow = $g->row();
                        $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                        $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                    } else {
                        $g = $this->db->get_where("tarif_radiologi",["id_tindakan"=>$row->kode_tarif]);
                        if ($g->num_rows()>0){
                            $grow = $g->row();
                            $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                            $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                        } else {
                            $g = $this->db->get_where("tarif_lab",["kode_tindakan"=>$row->kode_tarif]);
                            if ($g->num_rows()>0){
                                $grow = $g->row();
                                $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                                $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                            } else {
                                $g = $this->db->get_where("tarif_penunjang_medis",["kode"=>$row->kode_tarif]);
                                if ($g->num_rows()>0){
                                    $grow = $g->row();
                                    $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                                    $data["namatarifdokter"][$row->kode_tarif] = $grow->ket;
                                } else {
                                    $g = $this->db->get_where("tarif_ralan",["kode_tindakan"=>$row->kode_tarif]);
                                    if ($g->num_rows()>0){
                                        $grow = $g->row();
                                        $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                                        $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                                    } else {
                                        $g = $this->db->get_where("tarif_opr",["kode_tindakan"=>$row->kode_tarif]);
                                        if ($g->num_rows()>0){
                                            $grow = $g->row();
                                            $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                                            $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                                        } else {
                                            $g = $this->db->get_where("tarif_operasi",["kode"=>$row->kode_tarif]);
                                            if ($g->num_rows()>0){
                                                $grow = $g->row();
                                                $data["tarifdokter"][$row->kode_tarif] = $grow->dokter;
                                                $data["namatarifdokter"][$row->kode_tarif] = $grow->nama_tindakan;
                                            } else {
                                                $data["tarifdokter"][$row->kode_tarif] = 0;
                                                $data["namatarifdokter"][$row->kode_tarif] = "";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $data["detail"][$kode_petugas][$row->no_reg][$row->kode_tarif] = $p;
                $data["golpas"][$row->no_reg] = $str_golpas;
            }
		}
		return $data;
    }
    function pointsharing($tgl1="",$tgl2=""){
        $data = array();
        $tgl1 = $tgl1=="" ? $this->input->post("tgl1") : $tgl1;
        $tgl2 = $tgl2=="" ? $this->input->post("tgl2") : $tgl2;
		$this->db->select("k.no_reg,k.kode_tarif,sum(k.jumlah) as jumlah");
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')>=",date("Y-m-d",strtotime($tgl1)));
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')<=",date("Y-m-d",strtotime($tgl2)));
        // $this->db->where("k.kode_tarif!=","FRM");
        // $this->db->where("k.kode_petugas!=","");
        $this->db->order_by("k.kode_tarif,k.no_reg");
		$this->db->group_by("k.kode_tarif,k.no_reg");
        $q = $this->db->get("kasir k");
        foreach($q->result() as $row){
            $this->db->select("pr.no_reg,pr.no_reg_sebelumnya,pr.gol_pasien,pr.tarif_bpjs");
            $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
            $this->db->where("pr.no_reg",$row->no_reg);
            $this->db->where("pr.layan!=","2");
            $this->db->where("pr.keadaan_pulang!=","6");
            $this->db->order_by("pr.no_reg");
            $p = $this->db->get("pasien_ralan pr");
            if ($p->num_rows()>0){
                $p = $p->row();
                if ($p->no_reg_sebelumnya!=""){
                    $this->db->select("'".$row->no_reg."' as no_reg,pr.no_reg_sebelumnya,p.nama_pasien,pr.dokter_poli,pr.gol_pasien,pr.tarif_bpjs,pr.tarif_rumahsakit,'ralan' as pelayanan");
                    $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
                    $this->db->where("pr.no_reg",$p->no_reg_sebelumnya);
                    $this->db->order_by("pr.no_reg");
                    $p = $this->db->get("pasien_ralan pr")->row();
                }
                if ($p->gol_pasien==11){
                    $str_golpas = "UMUM";
                    $persen = 100;
                    $data["jumlah_umum"] += $row->jumlah;
                } else 
                if ($p->gol_pasien>=12 && $p->gol_pasien<=18){
                    $str_golpas = "PERUSAHAAN";
                    $persen = 100;
                    $data["jumlah_perusahaan"] += $row->jumlah;
                } else {
                    $str_golpas = "BPJS";
                    $persen = 100;
                    $data["jumlah_bpjs"] += $row->jumlah;
                }
                $prs = $persen>100 ? 100 : round($persen,2);
                $bruto = (($row->jumlah*$prs)/100);
                if (isset($data["jumlah"][$row->kode_tarif])){
                    $data["jumlah"][$row->kode_tarif] += $bruto;
                } else {
                    $data["jumlah"][$row->kode_tarif] = $bruto;
                }
                $this->db->select("kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                $g = $this->db->get_where("tarif_ralan",["kode_tindakan"=>$row->kode_tarif]);
                if ($g->num_rows()>0){
                    $grow = $g->row();
                    $data["tarif"][$row->kode_tarif] = $grow;
                    if (isset($data["jml_ralan"][$row->kode_tarif][$str_golpas])){
                        $data["jml_ralan"][$row->kode_tarif][$str_golpas] += $bruto;
                    } else {
                        $data["jml_ralan"][$row->kode_tarif][$str_golpas] = $bruto;
                    }
                } else {
                    $this->db->select("id_tindakan as kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                    $g = $this->db->get_where("tarif_radiologi",["id_tindakan"=>$row->kode_tarif]);
                    if ($g->num_rows()>0){
                        $grow = $g->row();
                        $data["tarif"][$row->kode_tarif] = $grow;
                        if (isset($data["jml_ralan"][$row->kode_tarif][$str_golpas])){
                            $data["jml_ralan"][$row->kode_tarif][$str_golpas] += $bruto;
                        } else {
                            $data["jml_ralan"][$row->kode_tarif][$str_golpas] = $bruto;
                        }
                    } else {
                        $this->db->select("kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                        $g = $this->db->get_where("tarif_lab",["kode_tindakan"=>$row->kode_tarif]);
                        if ($g->num_rows()>0){
                            $grow = $g->row();
                            $data["tarif"][$row->kode_tarif] = $grow;
                            if (isset($data["jml_ralan"][$row->kode_tarif][$str_golpas])){
                                $data["jml_ralan"][$row->kode_tarif][$str_golpas] += $bruto;
                            } else {
                                $data["jml_ralan"][$row->kode_tarif][$str_golpas] = $bruto;
                            }
                        } else {
                            $this->db->select("kode as kode_tindakan,ket as nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                            $g = $this->db->get_where("tarif_penunjang_medis",["kode"=>$row->kode_tarif]);
                            if ($g->num_rows()>0){
                                $grow = $g->row();
                                $data["tarif"][$row->kode_tarif] = $grow;
                                if (isset($data["jml_ralan"][$row->kode_tarif][$str_golpas])){
                                    $data["jml_ralan"][$row->kode_tarif][$str_golpas] += $bruto;
                                } else {
                                    $data["jml_ralan"][$row->kode_tarif][$str_golpas] = $bruto;
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->db->select("k.no_reg,k.kode_tarif,sum(k.qty*k.jumlah) as jumlah");
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')>=",date("Y-m-d",strtotime($tgl1)));
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')<=",date("Y-m-d",strtotime($tgl2)));
        // $this->db->where("k.kode_tarif!=","FRM");
        // $this->db->where("k.kode_petugas!=","");
		$this->db->group_by("k.kode_tarif,k.no_reg");
		$q = $this->db->get("kasir_inap k");
		foreach($q->result() as $row){
            $this->db->select("pr.no_reg,pr.id_gol as gol_pasien,pr.tarif_bpjs"); 
            $this->db->join("pasien p","p.no_pasien=pr.no_rm","inner");
            $this->db->where("pr.no_reg",$row->no_reg);
            $this->db->order_by("pr.no_reg");
            $p = $this->db->get("pasien_inap pr");
            if ($p->num_rows()>0){
                $p = $p->row();
                if ($p->gol_pasien==11){
                    $str_golpas = "UMUM";
                    $persen = 100;
                } else 
                if ($p->gol_pasien>=12 && $p->gol_pasien<=18){
                    $str_golpas = "PERUSAHAAN";
                    $persen = 100;
                } else {
                    $str_golpas = "BPJS";
                    $persen = 100;
                }
                $prs = $persen>100 ? 100 : round($persen,2);
                $bruto = (($row->jumlah*$prs)/100);
                if (isset($data["jumlahranap"][$row->kode_tarif])){
                    $data["jumlahranap"][$row->kode_tarif] += $bruto;
                } else {
                    $data["jumlahranap"][$row->kode_tarif] = $bruto;
                }
                $g = $this->db->get_where("tarif_inap",["kode_tindakan"=>$row->kode_tarif]);
                if ($g->num_rows()>0){
                    $grow = $g->row();
                    $data["tarifranap"][$row->kode_tarif] = $grow;
                    if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                        $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                    } else {
                        $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                    }
                } else {
                    $this->db->select("id_tindakan as kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                    $g = $this->db->get_where("tarif_radiologi",["id_tindakan"=>$row->kode_tarif]);
                    if ($g->num_rows()>0){
                        $grow = $g->row();
                        $data["tarifranap"][$row->kode_tarif] = $grow;
                        if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                            $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                        } else {
                            $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                        }
                    } else {
                        $this->db->select("kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                        $g = $this->db->get_where("tarif_lab",["kode_tindakan"=>$row->kode_tarif]);
                        if ($g->num_rows()>0){
                            $grow = $g->row();
                            $data["tarifranap"][$row->kode_tarif] = $grow;
                            if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                                $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                            } else {
                                $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                            }
                        } else {
                            $this->db->select("kode as kode_tindakan,ket as nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                            $g = $this->db->get_where("tarif_penunjang_medis",["kode"=>$row->kode_tarif]);
                            if ($g->num_rows()>0){
                                $grow = $g->row();
                                $data["tarifranap"][$row->kode_tarif] = $grow;
                                if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                                    $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                                } else {
                                    $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                                }
                            } else {
                                $this->db->select("kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                                $g = $this->db->get_where("tarif_ralan",["kode_tindakan"=>$row->kode_tarif]);
                                if ($g->num_rows()>0){
                                    $grow = $g->row();
                                    $data["tarifranap"][$row->kode_tarif] = $grow;
                                    if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                                        $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                                    } else {
                                        $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                                    }
                                } else {
                                    $this->db->select("kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rumahsakit");
                                    $g = $this->db->get_where("tarif_opr",["kode_tindakan"=>$row->kode_tarif]);
                                    if ($g->num_rows()>0){
                                        $grow = $g->row();
                                        $data["tarifranap"][$row->kode_tarif] = $grow;
                                        if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                                            $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                                        } else {
                                            $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                                        }
                                    } else {
                                        $this->db->select("kode as kode_tindakan,nama_tindakan,dokter,perawat,administrasi,bhp,rs as rumahsakit,dr_ahli_anaestesi,asisten_operasi,asisten_anaestesi,dr_anak,asisten_dr_anak");
                                        $g = $this->db->get_where("tarif_operasi",["kode"=>$row->kode_tarif]);
                                        if ($g->num_rows()>0){
                                            $grow = $g->row();
                                            $data["tarifranap"][$row->kode_tarif] = $grow;
                                            if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                                                $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                                            } else {
                                                $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }
    function hdsharing($tgl1="",$tgl2=""){
        $data = array();
        $tgl1 = $tgl1=="" ? $this->input->post("tgl1") : $tgl1;
        $tgl2 = $tgl2=="" ? $this->input->post("tgl2") : $tgl2;
        $this->db->select("k.no_reg,k.kode_tarif,sum(k.jumlah) as jumlah");
        $this->db->select("tr.kode_tindakan,tr.nama_tindakan,tr.dokter,tr.perawat,tr.administrasi,tr.bhp,tr.rumahsakit,tr.tarif_bpjs");
        $this->db->join("tarif_ralan tr","tr.kode_tindakan=k.kode_tarif","inner");
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')>=",date("Y-m-d",strtotime($tgl1)));
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("k.kode_tarif!=","FRM");
        $this->db->where("tr.kode_poli","0102026");
        $this->db->order_by("k.no_reg");
		$this->db->group_by("k.kode_tarif,k.no_reg");
        $q = $this->db->get("kasir k");
        foreach($q->result() as $row){
            $this->db->select("pr.no_reg,pr.no_reg_sebelumnya,pr.gol_pasien,pr.tarif_bpjs");
            $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
            $this->db->where("pr.no_reg",$row->no_reg);
            $this->db->where("pr.layan!=","2");
            $this->db->where("pr.keadaan_pulang!=","6");
            $this->db->order_by("pr.no_reg");
            $p = $this->db->get("pasien_ralan pr");
            if ($p->num_rows()>0){
                $p = $p->row();
                if ($p->no_reg_sebelumnya!=""){
                    $this->db->select("'".$row->no_reg."' as no_reg,pr.no_reg_sebelumnya,p.nama_pasien,pr.dokter_poli,pr.gol_pasien,pr.tarif_bpjs,pr.tarif_rumahsakit,'ralan' as pelayanan");
                    $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
                    $this->db->where("pr.no_reg",$p->no_reg_sebelumnya);
                    $this->db->order_by("pr.no_reg");
                    $p = $this->db->get("pasien_ralan pr")->row();
                }
                if ($p->gol_pasien==11){
                    $str_golpas = "UMUM";
                    $persen = 100;
                    $data["jumlah_umum"] += $row->jumlah;
                    $bruto = $row->jumlah;
                } else 
                if ($p->gol_pasien>=12 && $p->gol_pasien<=18){
                    $str_golpas = "PERUSAHAAN";
                    $persen = 100;
                    $data["jumlah_perusahaan"] += $row->jumlah;
                    $bruto = $row->jumlah;
                } else {
                    $str_golpas = "BPJS";
                    $persen = 100;
                    $data["jumlah_bpjs"] += $row->tarif_bpjs;
                    $bruto = $row->tarif_bpjs;
                }
                if (isset($data["jumlah"][$row->kode_tarif])){
                    $data["jumlah"][$row->kode_tarif] += $bruto;
                } else {
                    $data["jumlah"][$row->kode_tarif] = $bruto;
                }
                $data["tarif"][$row->kode_tarif] = $row;
                if (isset($data["jml_ralan"][$row->kode_tarif][$str_golpas])){
                    $data["jml_ralan"][$row->kode_tarif][$str_golpas] += $bruto;
                } else {
                    $data["jml_ralan"][$row->kode_tarif][$str_golpas] = $bruto;
                }
            }
        }
        $this->db->select("k.no_reg,k.kode_tarif,sum(k.qty*k.jumlah) as jumlah");
        $this->db->select("tr.kode_tindakan,tr.nama_tindakan,tr.dokter,tr.perawat,tr.administrasi,tr.bhp,tr.rumahsakit,tr.tarif_bpjs");
        $this->db->join("tarif_inap tr","tr.kode_tindakan=k.kode_tarif","inner");
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')>=",date("Y-m-d",strtotime($tgl1)));
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("k.kode_tarif","hdl");
		$this->db->group_by("k.kode_tarif,k.no_reg");
		$q = $this->db->get("kasir_inap k");
		foreach($q->result() as $row){
            $this->db->select("pr.no_reg,pr.id_gol as gol_pasien,pr.tarif_bpjs"); 
            $this->db->join("pasien p","p.no_pasien=pr.no_rm","inner");
            $this->db->where("pr.no_reg",$row->no_reg);
            $this->db->order_by("pr.no_reg");
            $p = $this->db->get("pasien_inap pr");
            if ($p->num_rows()>0){
                if ($p->gol_pasien==11){
                    $str_golpas = "UMUM";
                    $persen = 100;
                    $data["jumlahranap_umum"] += $row->jumlah;
                    $bruto = $row->jumlah;
                } else 
                if ($p->gol_pasien>=12 && $p->gol_pasien<=18){
                    $str_golpas = "PERUSAHAAN";
                    $persen = 100;
                    $data["jumlahranap_perusahaan"] += $row->jumlah;
                    $bruto = $row->jumlah;
                } else {
                    $str_golpas = "BPJS";
                    $persen = 100;
                    $data["jumlahranap_bpjs"] += $row->jumlah;
                    $bruto = $row->tarif_bpjs;
                }
                if (isset($data["jumlah"][$row->kode_tarif])){
                    $data["jumlah"][$row->kode_tarif] += $bruto;
                } else {
                    $data["jumlah"][$row->kode_tarif] = $bruto;
                }
                $data["tarif"][$row->kode_tarif] = $row;
                if (isset($data["jml_ranap"][$row->kode_tarif][$str_golpas])){
                    $data["jml_ranap"][$row->kode_tarif][$str_golpas] += $bruto;
                } else {
                    $data["jml_ranap"][$row->kode_tarif][$str_golpas] = $bruto;
                }
            }
        }
        return $data;
    }
    function perawatsharing($tgl1,$tgl2){
		$data = array();
        $this->db->select("k.no_reg,k.kode_tarif,sum(k.qty*k.jumlah) as jumlah,a.asisten_anastesi");
        $this->db->join("oka a","a.no_reg=k.no_reg","inner");
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')>=",date("Y-m-d",strtotime($tgl1)));
		$this->db->where("date_format(k.no_reg,'%Y-%m-%d')<=",date("Y-m-d",strtotime($tgl2)));
		$this->db->where("k.kode_tarif","asisten_anaestesi");
		$this->db->group_by("k.no_reg,k.kode_tarif,a.asisten_anastesi");
		$q = $this->db->get("kasir_inap k");
		foreach($q->result() as $row){
            $this->db->select("pr.no_reg,p.nama_pasien,pr.dokter,pr.id_gol as gol_pasien,pr.tarif_bpjs,pr.tarif_rumahsakit,'ranap' as pelayanan"); 
            $this->db->join("pasien p","p.no_pasien=pr.no_rm","inner");
            $this->db->where("pr.no_reg",$row->no_reg);
            $this->db->order_by("pr.no_reg");
            $p = $this->db->get("pasien_inap pr");
            if ($p->num_rows()>0){
                $p = $p->row();
                if ($p->gol_pasien==11){
                    $str_golpas = "UMUM";
                } else 
                if ($p->gol_pasien>=12 && $p->gol_pasien<=18){
                    $str_golpas = "PERUSAHAAN";
                } else {
                    $str_golpas = "BPJS";
                }
                $kode_petugas = $row->asisten_anastesi;
                if (isset($data["pelayanan_inap"][$kode_petugas][$str_golpas])){
                    $data["pelayanan_inap"][$kode_petugas][$str_golpas] += $row->jumlah;
                } else {
                    $data["pelayanan_inap"][$kode_petugas][$str_golpas] = $row->jumlah;
                }
                if (isset($data["tarifrs"][$row->kode_tarif][$row->no_reg])){
                    $data["tarifrs"][$row->kode_tarif][$row->no_reg] += $row->jumlah;
                } else {
                    $data["tarifrs"][$row->kode_tarif][$row->no_reg] = $row->jumlah;
                }
                if (!isset($data["tarifasisten"][$row->kode_tarif])){
                    $g = $this->db->get_where("tarif_opr",["kode_tindakan"=>$row->kode_tarif]);
                    if ($g->num_rows()>0){
                        $grow = $g->row();
                        $data["tarifasisten"][$row->kode_tarif] = $grow->dokter;
                        $data["namatarifasisten"][$row->kode_tarif] = $grow->nama_tindakan;
                    } 
                }
                $data["detail"][$kode_petugas][$row->no_reg][$row->kode_tarif] = $p;
                $data["golpas"][$row->no_reg] = $str_golpas;
            }
		}
		return $data;
    }
    function getdokter_hd(){
        $q = $this->db->get_where("dokter_hd");
        $data = array();
		foreach ($q->result() as $key) {
			$data[$key->id_dokter] = $key;
		}
		return $data;
    }
    function subsidi($tgl1,$tgl2){
        $this->db->select("count(*) as jumlah,pr.gol_pasien,sum(pr.tarif_bpjs) as tarif_bpjs, sum(pr.tarif_rumahsakit) as tarif_rs,p.id_kesatuan");
        $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
        $this->db->where("date(pr.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(pr.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("pr.layan!=",2);
        $this->db->group_by("pr.gol_pasien");
        $this->db->group_start();
            $this->db->where('pr.gol_pasien','404');
            $this->db->or_where('pr.gol_pasien','405');
            $this->db->or_where('pr.gol_pasien','406'); 
            $this->db->or_where('pr.gol_pasien','408');
            $this->db->or_where('pr.gol_pasien','409');
            $this->db->or_where('pr.gol_pasien','410');
            $this->db->or_where('pr.gol_pasien','415');
            $this->db->or_where('pr.gol_pasien','416');
            $this->db->or_where('pr.gol_pasien','417');
            $this->db->or_group_start();
                $this->db->where('pr.gol_pasien','412'); 
                $this->db->where('p.id_kesatuan','2');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('pr.gol_pasien','419');
                $this->db->where('p.id_kesatuan','2');
            $this->db->group_end();
            $this->db->or_where('pr.gol_pasien','3133');
        $this->db->group_end();
        $q = $this->db->get("pasien_ralan pr");
        $data = array();
        foreach($q->result() as $row){
            if (isset($data["total_ralan"])){
                $data["total_ralan"] += $row->jumlah;
            } else {
                $data["total_ralan"] = $row->jumlah;
            }
            if ($row->gol_pasien=='3133'){
                if (isset($data["dinas_ralan"]["pasien"])){
                    $data["dinas_ralan"]["pasien"] += $row->jumlah;
                } else {
                    $data["dinas_ralan"]["pasien"] = $row->jumlah;
                }
                if (isset($data["dinas_ralan"]["rupiah"])){
                    $data["dinas_ralan"]["rupiah"] += $row->tarif_rs;
                } else {
                    $data["dinas_ralan"]["rupiah"] = $row->tarif_rs;
                }
            } else {
                if (isset($data["nondinas_ralan"]["pasien"])){
                    $data["nondinas_ralan"]["pasien"] += $row->jumlah;
                } else {
                    $data["nondinas_ralan"]["pasien"] = $row->jumlah;
                }
                $selisih = $row->tarif_rs-$row->tarif_bpjs;
                if (isset($data["nondinas_ralan"]["rupiah"])){
                    $data["nondinas_ralan"]["rupiah"] += $selisih;
                } else {
                    $data["nondinas_ralan"]["rupiah"] = $selisih;
                }
            }
        }
        $this->db->select("count(*) as jumlah,pr.id_gol as gol_pasien,sum(pr.tarif_bpjs) as tarif_bpjs, sum(pr.tarif_rumahsakit) as tarif_rs,p.id_kesatuan");
        $this->db->join("pasien p","p.no_pasien=pr.no_rm","inner");
        $this->db->where("pr.tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("pr.tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->group_by("pr.id_gol");
        $this->db->group_start();
            $this->db->where('pr.id_gol','404');
            $this->db->or_where('pr.id_gol','405');
            $this->db->or_where('pr.id_gol','406'); 
            $this->db->or_where('pr.id_gol','408');
            $this->db->or_where('pr.id_gol','409');
            $this->db->or_where('pr.id_gol','410');
            $this->db->or_where('pr.id_gol','415');
            $this->db->or_where('pr.id_gol','416');
            $this->db->or_where('pr.id_gol','417');
            $this->db->or_group_start();
                $this->db->where('pr.id_gol','412'); 
                $this->db->where('p.id_kesatuan','2');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('pr.id_gol','419');
                $this->db->where('p.id_kesatuan','2');
            $this->db->group_end();
            $this->db->or_where('pr.id_gol','3133');
        $this->db->group_end();
        $q = $this->db->get("pasien_inap pr");
        foreach($q->result() as $row){
            if (isset($data["total_inap"])){
                $data["total_inap"] += $row->jumlah;
            } else {
                $data["total_inap"] = $row->jumlah;
            }
            if ($row->gol_pasien=='3133'){
                if (isset($data["dinas_inap"]["pasien"])){
                    $data["dinas_inap"]["pasien"] += $row->jumlah;
                } else {
                    $data["dinas_inap"]["pasien"] = $row->jumlah;
                }
                if (isset($data["dinas_inap"]["rupiah"])){
                    $data["dinas_inap"]["rupiah"] += $row->tarif_rs;
                } else {
                    $data["dinas_inap"]["rupiah"] = $row->tarif_rs;
                }
            } else {
                if (isset($data["nondinas_inap"]["pasien"])){
                    $data["nondinas_inap"]["pasien"] += $row->jumlah;
                } else {
                    $data["nondinas_inap"]["pasien"] = $row->jumlah;
                }
                $selisih = $row->tarif_rs-$row->tarif_bpjs;
                if (isset($data["nondinas_inap"]["rupiah"])){
                    $data["nondinas_inap"]["rupiah"] += $selisih;
                } else {
                    $data["nondinas_inap"]["rupiah"] = $selisih;
                }
            }
        }
        return $data;
    }
    function detailpasien($tgl="",$pelayanan=""){
        if ($tgl==""){
            $tgl = $this->input->post("tgl")=="" ? date("Y-m")."-01" : date("Y-m-d",strtotime("01-".$this->input->post("tgl")));
            $pelayanan = $this->input->post("pelayanan");
        } else {
            $tgl = date("Y-m-d",strtotime("01-".$tgl));
        }
        $tgl1 = date("Y-m-d",strtotime($tgl));
        $hari = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime($tgl)), date("Y",strtotime($tgl)));
        $tgl2 = date("Y-m",strtotime($tgl))."-".$hari;
        if ($pelayanan=="ralan"){
            $this->db->select("p.nama_pasien,p.no_pasien,pr.no_reg,g.keterangan as gol_pasien,p.id_kesatuan,pol.keterangan as poliklinik");
            $this->db->join("pasien p","p.no_pasien=pr.no_pasien","inner");
            $this->db->join("gol_pasien g","g.id_gol=pr.gol_pasien","inner");
            $this->db->join("poliklinik pol","pol.kode=pr.tujuan_poli","left");
            $this->db->where("date(pr.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(pr.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
            $this->db->where("pr.layan!=",2);
            $this->db->group_start();
                $this->db->where('pr.gol_pasien','404');
                $this->db->or_where('pr.gol_pasien','405');
                $this->db->or_where('pr.gol_pasien','406'); 
                $this->db->or_where('pr.gol_pasien','408');
                $this->db->or_where('pr.gol_pasien','409');
                $this->db->or_where('pr.gol_pasien','410');
                $this->db->or_where('pr.gol_pasien','415');
                $this->db->or_where('pr.gol_pasien','416');
                $this->db->or_where('pr.gol_pasien','417');
                $this->db->or_group_start();
                    $this->db->where('pr.gol_pasien','412'); 
                    $this->db->where('p.id_kesatuan','2');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('pr.gol_pasien','419');
                    $this->db->where('p.id_kesatuan','2');
                $this->db->group_end();
                $this->db->or_where('pr.gol_pasien','3133');
            $this->db->group_end();
            $this->db->group_by("pr.no_reg");
            $this->db->order_by("pr.no_reg");
            $q = $this->db->get("pasien_ralan pr");
        } else {
            $this->db->select("p.nama_pasien,p.no_pasien,pr.no_reg,g.keterangan as gol_pasien,p.id_kesatuan,'-' as poliklinik");
            $this->db->join("pasien p","p.no_pasien=pr.no_rm","inner");
            $this->db->join("gol_pasien g","g.id_gol=pr.id_gol","inner");
            // $this->db->join("poliklinik pol","pol.kode=pr.tujuan_poli","inner");
            $this->db->where("pr.tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("pr.tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
            $this->db->group_start();
                $this->db->where('pr.id_gol','404');
                $this->db->or_where('pr.id_gol','405');
                $this->db->or_where('pr.id_gol','406'); 
                $this->db->or_where('pr.id_gol','408');
                $this->db->or_where('pr.id_gol','409');
                $this->db->or_where('pr.id_gol','410');
                $this->db->or_where('pr.id_gol','415');
                $this->db->or_where('pr.id_gol','416');
                $this->db->or_where('pr.id_gol','417');
                $this->db->or_group_start();
                    $this->db->where('pr.id_gol','412'); 
                    $this->db->where('p.id_kesatuan','2');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('pr.id_gol','419');
                    $this->db->where('p.id_kesatuan','2');
                $this->db->group_end();
                $this->db->or_where('pr.id_gol','3133');
            $this->db->group_end();
            $this->db->group_by("pr.no_reg");
            $this->db->order_by("pr.no_reg");
            $q = $this->db->get("pasien_inap pr");
        }
        return $q;
    }
}
?>