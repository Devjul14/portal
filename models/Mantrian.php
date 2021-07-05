<?php
class Mantrian extends CI_Model{
   	function __construct(){
        parent::__construct();
    }
    function getpoli(){
    	$this->db->order_by("keterangan");
    	$poli = $this->db->get("poliklinik");
    	return $poli;
    }
    function getgolpasien(){
        $this->db->order_by("id_gol");
        $q = $this->db->get("gol_pasien");
        return $q->result();
    }
    function getdokter(){
        $this->db->select("p.kode,d.id_dokter,d.nama_dokter,j.hari,j.jam,j.jam2");
        $this->db->join("jadwal_dokter j","jadwal_dokter j on j.id_poli=p.kode","inner");
    	$this->db->join("dokter d","d.id_dokter=j.id_dokter","inner");
    	$q = $this->db->get("poliklinik p");
    	$dokter = array();
    	foreach ($q->result() as $value) {
    		$dokter[$value->kode][$value->id_dokter]=$value;
    	}
    	return $dokter;
    }
    function getpasien(){
        $no_pasien = "000000".$this->input->post("no_pasien");
        $this->db->where("no_pasien",substr($no_pasien,-6));
        $q = $this->db->get("pasien")->row();
        $this->db->where("date(tanggal)",date("Y-m-d"));
        $this->db->where("no_pasien",$q->no_pasien);
        $this->db->where("tujuan_poli",$this->input->post("poli"));
        $this->db->where("layan !=", "2");
        $s = $this->db->get("pasien_ralan");
        if ($s->num_rows()>0){
            return "ada";
        } else {
            return $q;
        }
    }
    function getpasien_online(){
        // $no_pasien = "000000".$this->input->post("no_pasien");
        // $this->db->where("no_pasien",substr($no_pasien,-6));
        $this->db->where("no_pasien",$this->input->post("no_pasien"));
        $this->db->or_where("no_bpjs",$this->input->post("no_pasien"));
        $this->db->or_where("ktp",$this->input->post("no_pasien"));
        $q = $this->db->get("pasien")->row();
        $this->db->where("date(tanggal)",date("Y-m-d",strtotime($this->input->post("tgl_daftar"))));
        $this->db->where("no_pasien",$q->no_pasien);
        $this->db->where("tujuan_poli",$this->input->post("poli"));
        $this->db->where("layan !=", "2");
        $s = $this->db->get("pasien_ralan");
        if ($s->num_rows()>0){
            return "ada";
        } else {
            return $q;
        }
    }
    function getnoregsebelumnya(){
        $no_pasien = "000000".$this->input->post("no_pasien");
        $this->db->where("no_pasien",substr($no_pasien,-6));
        $this->db->order_by("tanggal","desc");
        $q = $this->db->get("pasien_ralan");
        return $q->result();
    }
    function getno_pasien_baru(){
        for ($i=1;$i<=300000;$i++){
            $n = sprintf("%06o",$i);
            $q = $this->db->get_where("pasien",array("no_pasien"=>$n));
            if ($q->num_rows()<=0){
                return $n;
                break;
            }
        }
    }
    function getno_antrian(){
        for ($i=1;$i<=999;$i++){
            $n = substr("000".$i,-3);
            $where = array(
                        "dokter_poli"=>$this->input->post("dokter"),
                        "jenis" => $this->input->post("jenis"),
                        "tujuan_poli" => $this->input->post("poli"),
                        "date(tanggal)" => date("Y-m-d"),
                        "no_antrian" => $n
                    );
            $q = $this->db->get_where("pasien_ralan",$where);
            if ($q->num_rows()<=0){
                return $n;
                break;
            }
        }
    }
    function simpan_pasien(){
        if ($this->input->post("status_pasien")=="BARU"){
            $noreg = date("Y-m-d H:i:s");
            $no = date("YmdHis",strtotime($noreg));
            // $no = $this->getno_pasien_baru();
            $data = array(
                        "id_pasien" => date("dmyHis"),
                        "no_pasien" => $no,
                        "id_gol" => $this->input->post("golpasien")
                    );
            $this->db->insert("pasien",$data);
            $no_pasien = $no;
            $nama_pasien = "";
            $no_antrian = $this->getno_antrian();
            $p = $this->db->get_where("poliklinik",["kode"=>$this->input->post("poli")])->row();
            $d = $this->db->get_where("dokter",["id_dokter"=>$this->input->post("dokter")])->row();

            $this->db->where("id_gol",$this->input->post("golpasien"));
            $gp  = $this->db->get("gol_pasien");
            $gol = $gp->row();

            $data = array(
                            "no_reg" => date("YmdHis",strtotime($noreg)),
                            "no_pasien" => $no_pasien,
                            "no_antrian" => $no_antrian,
                            "tujuan_poli" => $this->input->post("poli"),
                            "dokter_poli" => $this->input->post("dokter"),
                            "tanggal" => date("Y-m-d H:i:s",strtotime($noreg)),
                            "status_pasien" => $this->input->post("status_pasien"),
                            "jenis" => $this->input->post("jenis"),
                            "gol_pasien" => $this->input->post("golpasien"),
                            "status_bayar" => $this->input->post("status_bayar")=="LUNAS" ? "" : $this->input->post("status_bayar"),
                        );
        } else {
            $no_pasien = $this->input->post("no_pasien");
            $this->db->join("gol_pasien g","g.id_gol=p.id_gol");
            $q = $this->db->get_where("pasien p",["no_pasien"=>$no_pasien])->row();
            $nama_pasien = $q->nama_pasien;
            $status_bayar = $q->status;
            $gol_pasien = $q->id_gol;
            $t = $this->db->get_where("pasien_ttd",["no_pasien"=>$no_pasien]);
            if ($t->num_rows()>0){
                $this->db->where("no_pasien",$no_pasien);
                $dt = array("ttd"=>"data:image/png;base64,".$this->input->post("ttd"));
                $this->db->update("pasien_ttd",$dt);
            } else {
                $dt = array("no_pasien"=>$no_pasien,"ttd"=>"data:image/png;base64,".$this->input->post("ttd"));
                $this->db->insert("pasien_ttd",$dt);
            }
            $noreg = date("Y-m-d H:i:s");
            $no_antrian = $this->getno_antrian();
            $p = $this->db->get_where("poliklinik",["kode"=>$this->input->post("poli")])->row();
            $d = $this->db->get_where("dokter",["id_dokter"=>$this->input->post("dokter")])->row();

            $data = array(
                    "no_reg" => date("YmdHis",strtotime($noreg)),
                    "no_pasien" => $no_pasien,
                    "nama_pasien" => $nama_pasien,
                    "no_antrian" => $no_antrian,
                    "tujuan_poli" => $this->input->post("poli"),
                    "dokter_poli" => $this->input->post("dokter"),
                    "tanggal" => date("Y-m-d H:i:s",strtotime($noreg)),
                    "status_pasien" => $this->input->post("status_pasien"),
                    "jenis" => $this->input->post("jenis"),
                    "gol_pasien" => $gol_pasien,
                    "no_reg_sebelumnya" => $this->input->post("noregsebelumnya"),
                    "status_bayar" => $status_bayar,
                );
        }
        $this->db->insert("pasien_ralan",$data);
        $r = $this->db->get_where("pasien_ralan",["jenis"=>$this->input->post("jenis"),"tujuan_poli"=>$this->input->post("poli"), "date(tanggal)" => date("Y-m-d")]);
        $jumlah_pasien = substr("0000".$r->num_rows(),-3);
        $data = array(
                    "no_reg" => date("YmdHis",strtotime($noreg)),
                    "no_pasien" => $no_pasien,
                    "nama_pasien" => $nama_pasien,
                    "no_antrian" => $no_antrian,
                    "tujuan_poli" => $this->input->post("poli"),
                    "nama_poli" => $p->keterangan,
                    "dokter_poli" => $this->input->post("dokter"),
                    "nama_dokter" => $d->nama_dokter,
                    "tanggal" => date("Y-m-d H:i:s",strtotime($noreg)),
                    "status_pasien" => $this->input->post("status_pasien"),
                    "jumlah_pasien" => $jumlah_pasien,
                    "jenis" => $this->input->post("jenis")
                );
        $this->db->insert("jobprinter",$data);
        $t = $this->db->get_where("tarif_ralan",["kategori" => "pdf","kode_poli" => $this->input->post("poli")]);
        if ($t->num_rows()>0){
            $data = $t->row();
            if ($this->input->post('jenis')=="R") $tarif = $data->reguler; else $tarif = $data->executive;
            $dat = array(
                    "id" => date("dmyHis"),
                    "no_reg" => date("YmdHis",strtotime($noreg)),
                    "kode_tarif" => $data->kode_tindakan,
                    "jumlah" => $tarif,
                    "bayar" => 0
                 );
            $this->db->insert("kasir",$dat);
        }
        return array("tanggal" => date("d-m-Y H:i:s",strtotime($noreg)),"jumlah_pasien" => $jumlah_pasien,"no_pasien" => $no_pasien,"nama_pasien" => $nama_pasien,"kode_dokter" => $this->input->post("dokter"), "nama_dokter" => $d->nama_dokter,"no_antrian" => $no_antrian, "no_reg"=> date("YmdHis",strtotime($noreg)), "jenis"=>$this->input->post("jenis"),"poli" => $p->keterangan);
    }
    function getno_antrian_online(){
        for ($i=1;$i<=999;$i++){
            $n = substr("000".$i,-3);
            $where = array(
                        "dokter_poli"=>$this->input->post("dokter"),
                        "jenis" => $this->input->post("jenis"),
                        "tujuan_poli" => $this->input->post("poli"),
                        "date(tanggal)" => date("Y-m-d",strtotime($this->input->post("tgl_daftar"))),
                        "no_antrian" => $n
                    );
            $q = $this->db->get_where("pasien_ralan",$where);
            if ($q->num_rows()<=0){
                return $n;
                break;
            }
        }
    }
    function simpan_pasien_online(){
        if ($this->input->post("status_pasien")=="BARU"){
            $jam = date("H:i:s");
            $noreg = date("Y-m-d H:i:s",strtotime($this->input->post("tgl_daftar")." ".$jam));
            $no = date("YmdHis",strtotime($noreg));
            // $no = $this->getno_pasien_baru();
            $data = array(
                        "id_pasien" => date("dmyHis"),
                        "no_pasien" => $no,
                        "id_gol" => $this->input->post("golpasien")
                    );
            $this->db->insert("pasien",$data);
            $no_pasien = $no;
            $nama_pasien = "";
            $no_antrian = $this->getno_antrian_online();
            $p = $this->db->get_where("poliklinik",["kode"=>$this->input->post("poli")])->row();
            $d = $this->db->get_where("dokter",["id_dokter"=>$this->input->post("dokter")])->row();
            $data = array(
                    "no_reg" => date("YmdHis",strtotime($noreg)),
                    "no_pasien" => $no_pasien,
                    "no_antrian" => $no_antrian,
                    "tujuan_poli" => $this->input->post("poli"),
                    "dokter_poli" => $this->input->post("dokter"),
                    "tanggal" => date("Y-m-d H:i:s",strtotime($noreg)),
                    "status_pasien" => $this->input->post("status_pasien"),
                    "jenis" => $this->input->post("jenis"),
                    "status_bayar" => $this->input->post("status_bayar"),
                    "nohp" => $this->input->post("nohp")
                );
        } else {
            $no_pasien = $this->input->post("no_pasien");
            $this->db->join("gol_pasien g","g.id_gol=p.id_gol");
            $q = $this->db->get_where("pasien p",["no_pasien"=>$no_pasien])->row();
            $nama_pasien = $q->nama_pasien;
            $status_bayar = $q->status;
            $gol_pasien = $q->id_gol;
            $jam = date("H:i:s");
            $noreg = date("Y-m-d H:i:s",strtotime($this->input->post("tgl_daftar")." ".$jam));
            $no_antrian = $this->getno_antrian_online();
            $p = $this->db->get_where("poliklinik",["kode"=>$this->input->post("poli")])->row();
            $d = $this->db->get_where("dokter",["id_dokter"=>$this->input->post("dokter")])->row();

            $data = array(
                    "no_reg" => date("YmdHis",strtotime($noreg)),
                    "no_pasien" => $no_pasien,
                    "no_antrian" => $no_antrian,
                    "tujuan_poli" => $this->input->post("poli"),
                    "dokter_poli" => $this->input->post("dokter"),
                    "tanggal" => date("Y-m-d H:i:s",strtotime($noreg)),
                    "status_pasien" => $this->input->post("status_pasien"),
                    "jenis" => $this->input->post("jenis"),
                    "gol_pasien" => $gol_pasien,
                    "no_reg_sebelumnya" => $this->input->post("noregsebelumnya"),
                    "status_bayar" => $status_bayar,
                    "nohp" => $this->input->post("nohp")
                );
        }
        $this->db->insert("pasien_ralan",$data);
        $r = $this->db->get_where("pasien_ralan",["jenis"=>$this->input->post("jenis"),"tujuan_poli"=>$this->input->post("poli"), "date(tanggal)" => date("Y-m-d")]);
        $jumlah_pasien = substr("0000".$r->num_rows(),-3);
        $data = array(
                    "no_reg" => date("YmdHis",strtotime($noreg)),
                    "no_pasien" => $no_pasien,
                    "nama_pasien" => $nama_pasien,
                    "no_antrian" => $no_antrian,
                    "tujuan_poli" => $this->input->post("poli"),
                    "nama_poli" => $p->keterangan,
                    "dokter_poli" => $this->input->post("dokter"),
                    "nama_dokter" => $d->nama_dokter,
                    "tanggal" => date("Y-m-d H:i:s",strtotime($noreg)),
                    "status_pasien" => $this->input->post("status_pasien"),
                    "jumlah_pasien" => $jumlah_pasien,
                    "jenis" => $this->input->post("jenis")
                );
        $this->db->insert("jobprinter",$data);
        $t = $this->db->get_where("tarif_ralan",["kategori" => "pdf","kode_poli" => $this->input->post("poli")]);
        if ($t->num_rows()>0){
            $data = $t->row();
            if ($this->input->post('jenis')=="R") $tarif = $data->reguler; else $tarif = $data->executive;
            $dat = array(
                    "id" => date("dmyHis"),
                    "no_reg" => date("YmdHis",strtotime($noreg)),
                    "kode_tarif" => $data->kode_tindakan,
                    "jumlah" => $tarif,
                    "bayar" => 0
                 );
            $this->db->insert("kasir",$dat);
        }
        return array("tanggal" => date("d-m-Y H:i:s",strtotime($noreg)),"jumlah_pasien" => $jumlah_pasien,"no_pasien" => $no_pasien,"nama_pasien" => $nama_pasien,"kode_dokter" => $this->input->post("dokter"), "nama_dokter" => $d->nama_dokter,"no_antrian" => $no_antrian, "no_reg"=> date("YmdHis",strtotime($noreg)), "jenis"=>$this->input->post("jenis"),"poli" => $p->keterangan);
    }
    function maks(){
      $tgl = date("Y-m-d");
      $q = $this->db->get_where("jadwal_dokter",["id_dokter"=>$this->input->post("id_dokter"),"id_poli"=>$this->input->post("id_poli")]);
      $maks = $q->row_array();
      $hari = (int)(date("w",strtotime($tgl)));
      $jml = $maks["h".$hari];
      if ($jml!="" || $jml!=0){
        $q = $this->db->get_where("pasien_ralan",["date(tanggal)"=>$tgl,"tujuan_poli"=>$this->input->post("id_poli"),"dokter_poli"=>$this->input->post("id_dokter")]);
        if ($q->num_rows()<$jml) return "true"; else return "false";
      } return "true";
    }
}
?>
