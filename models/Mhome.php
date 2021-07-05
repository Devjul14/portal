<?php
class Mhome extends CI_Model{
   	function __construct(){
        parent::__construct();
    }
    function getpasien_ugd(){
        $this->db->select("count(*) as ugd");
        $this->db->where("p.prosedur_masuk","UGD");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_langsung(){
        $this->db->select("count(*) as langsung");
        $this->db->where("p.prosedur_masuk","Langsung");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_poliklinik(){
        $this->db->select("count(*) as poliklinik");
        $this->db->where("p.prosedur_masuk","Poliklinik");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_sendiri(){
        $this->db->select("count(*) as sendiri");
        $this->db->where("p.cara_masuk","Datang Sendiri");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_rs(){
        $this->db->select("count(*) as rs");
        $this->db->where("p.cara_masuk","Rujukan RS");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_dokter(){
        $this->db->select("count(*) as dokter");
        $this->db->where("p.cara_masuk","Rujukan Dokter");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_lain(){
        $this->db->select("count(*) as lain");
        $this->db->where("p.cara_masuk","Rujukan Lain");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_paramedis(){
        $this->db->select("count(*) as paramedis");
        $this->db->where("p.cara_masuk","Rujukan Paramedis");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_kepolisian(){
        $this->db->select("count(*) as kepolisian");
        $this->db->where("p.cara_masuk","Rujukan Kepolisian");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function getpasien_puskesmas(){
        $this->db->select("count(*) as puskesmas");
        $this->db->where("p.cara_masuk","Rujukan Puskesmas");
        $this->db->where("p.tgl_masuk",date("Y-m-d"));
        $q = $this->db->get("pasien_inap p");
        return $q->row();
    }
    function gettotalpasien(){
    	return $this->db->get("pasien")->num_rows();
    }
    function gettotalpasienthn(){
        $this->db->select("p2.no_reg");
    	$this->db->where("year(p2.tanggal)",date("Y"));
    	$this->db->where("layan!=",2);
    	$this->db->join("pasien p1","p1.no_pasien=p2.no_pasien","inner");
        $qty["ralan"] = $this->db->get("pasien_ralan p2")->num_rows();
        $this->db->select("p2.no_reg");
    	$this->db->where("year(p2.tgl_masuk)",date("Y"));
    	$this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
    	$qty["inap"] = $this->db->get("pasien_inap p2")->num_rows();
    	return $qty;
    }
    function gettotalpasienbln(){
        $this->db->select("p2.no_reg");
        $this->db->where("month(p2.tanggal)",date("m"));
        $this->db->where("year(p2.tanggal)",date("Y"));
    	$this->db->where("layan!=",2);
    	$this->db->join("pasien p1","p1.no_pasien=p2.no_pasien","inner");
        $qty["ralan"] = $this->db->get("pasien_ralan p2")->num_rows();
        $this->db->select("p2.no_reg");
        $this->db->where("month(p2.tgl_masuk)",date("m"));
        $this->db->where("year(p2.tgl_masuk)",date("Y"));
    	$this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
    	$qty["inap"] = $this->db->get("pasien_inap p2")->num_rows();
    	return $qty;
    }
    function gettotalpasienday(){
        $this->db->select("p2.no_reg");
    	$this->db->where("date(p2.tanggal)",date("Y-m-d"));
    	$this->db->where("layan!=",2);
    	$this->db->join("pasien p1","p1.no_pasien=p2.no_pasien","inner");
        $qty["ralan"] = $this->db->get("pasien_ralan p2")->num_rows();
        $this->db->select("p2.no_reg");
    	$this->db->where("date(p2.tgl_masuk)",date("Y-m-d"));
    	$this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
    	$qty["inap"] = $this->db->get("pasien_inap p2")->num_rows();
    	return $qty;
    }
    function getpasien(){
    	$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
    	$data = array();
    	foreach ($bulan as $bln => $value) {
    		$this->db->select("month(p2.tanggal) as bulan,count(*) as jumlah");
    		$this->db->where("layan!=",2);
    		$this->db->where("month(p2.tanggal)",$bln);
    		$this->db->group_by("month(p2.tanggal)");
    		$this->db->join("pasien p1","p1.no_pasien=p2.no_pasien","inner");
    		$q = $this->db->get("pasien_ralan p2")->row();
    		$jumlah = isset($q->jumlah) ? $q->jumlah : 0;
    		if ($bln>0)
    		$data["ralan"][$bln] = $jumlah;
    	}
    	foreach ($bulan as $bln => $value) {
    		$this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
    		$this->db->where("month(p2.tgl_masuk)",$bln);
    		$this->db->group_by("month(p2.tgl_masuk)");
    		$this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
    		$q = $this->db->get("pasien_inap p2")->row();
    		$jumlah = isset($q->jumlah) ? $q->jumlah : 0;
    		if ($bln>0)
    		$data["inap"][$bln] = $jumlah;
    	}
    	$d = array();
    	foreach ($data["ralan"] as $bln => $value) {
    		$d[] =  array("bulan"=>$bulan[$bln],"ralan"=>$value,"inap"=>$data["inap"][$bln]);
    	}
    	return $d;
    }
    function getpasien_prosedur(){
        $hari = array("","1","2","3","4","5","6","7","8","9","10",
                        "11","12","13","14","15","16","17","18","19",
                        "20","21","22","23","24","25","26","27","28","29","30");
        $data = array();
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.prosedur_masuk","UGD");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["inap"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.prosedur_masuk","Langsung");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["lan"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.prosedur_masuk","Poliklinik");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["pol"][$hr] = $jumlah;
        }
        $d = array();
        foreach ($data["inap"] as $hr => $value) {
            $d[] =  array("hari"=>$hari[$hr],"inap"=>$value, "lan"=>$data["lan"][$hr], "pol"=>$data["pol"][$hr]);
        }
        return $d;
    }
    function getpasien_prosedurtahun(){
        $bulan = array("","1","2","3","4","5","6","7","8","9","10",
                        "11","12");
        $data = array();
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.prosedur_masuk","UGD");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["inap"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.prosedur_masuk","Langsung");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["lan"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.prosedur_masuk","Poliklinik");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["pol"][$bln] = $jumlah;
        }
        $d = array();
        foreach ($data["inap"] as $bln => $value) {
            $d[] =  array("hari"=>$bulan[$bln],"inap"=>$value, "lan"=>$data["lan"][$bln], "pol"=>$data["pol"][$bln]);
        }
        return $d;
    }
    function getpasien_cara(){
        $hari = array("","1","2","3","4","5","6","7","8","9","10",
                        "11","12","13","14","15","16","17","18","19",
                        "20","21","22","23","24","25","26","27","28","29","30");
        $data = array();
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Datang Sendiri");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["inap"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("p2.cara_masuk","Rujukan RS");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["r"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan Dokter");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["dok"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan Paramedis");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["par"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("p2.cara_masuk","Rujukan Puskesmas");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["pus"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("p2.cara_masuk","Rujukan Kepolisian");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["ke"][$hr] = $jumlah;
        }
        foreach ($hari as $hr => $value) {
            $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah");
            $this->db->where("day(p2.tgl_masuk)",$hr);
            $this->db->where("month(tgl_masuk)",date("m"));
            $this->db->where("p2.cara_masuk","Rujukan Lain");
            $this->db->group_by("day(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($hr>0)
            $data["lai"][$hr] = $jumlah;
        }
        $d = array();
        foreach ($data["inap"] as $hr => $value) {
            $d[] =  array("hari"=>$hari[$hr],"inap"=>$value,"r"=>$data["r"][$hr],
                "dok"=>$data["dok"][$hr], "par"=>$data["par"][$hr], "pus"=>$data["pus"][$hr], "ke"=>$data["ke"][$hr],
                "lai"=>$data["lai"][$hr]);
        }
        return $d;
    }
     function getpasien_caratahun(){
        $bulan = array("","1","2","3","4","5","6","7","8","9","10",
                        "11","12");
        $data = array();
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Datang Sendiri");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["inap"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan RS");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["r"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan Dokter");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["dok"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan Paramedis");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["par"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan Puskesmas");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["pus"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan Kepolisian");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["ke"][$bln] = $jumlah;
        }
        foreach ($bulan as $bln => $value) {
            $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah");
            $this->db->where("month(p2.tgl_masuk)",$bln);
            $this->db->where("year(tgl_masuk)",date("Y"));
            $this->db->where("p2.cara_masuk","Rujukan Lain");
            $this->db->group_by("month(p2.tgl_masuk)");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $q = $this->db->get("pasien_inap p2")->row();
            $jumlah = isset($q->jumlah) ? $q->jumlah : 0;
            if ($bln>0)
            $data["lai"][$bln] = $jumlah;
        }
        $d = array();
        foreach ($data["inap"] as $bln => $value) {
            $d[] =  array("hari"=>$bulan[$bln],"inap"=>$value,"r"=>$data["r"][$bln],
                "dok"=>$data["dok"][$bln], "par"=>$data["par"][$bln], "pus"=>$data["pus"][$bln], "ke"=>$data["ke"][$bln],
                "lai"=>$data["lai"][$bln]);
        }
        return $d;
    }
    function getpasien_poli(){
    	$data = array();
    	$q = $this->db->get("poliklinik");
    	foreach ($q->result() as $value) {
    		$this->db->where("layan!=",2);
    		$this->db->where("date(p2.tanggal)",date("Y-m-d"));
    		$this->db->where("p2.tujuan_poli",$value->kode);
    		$this->db->join("pasien p1","p1.no_pasien=p2.no_pasien","inner");
    		$sql = $this->db->get("pasien_ralan p2");
    		$data[] = array("poli"=>$value->keterangan,"ralan"=>$sql->num_rows());
    	}
    	return $data;
    }
    function getruangan(){
        $this->db->select("r.kode_ruangan_a,k.kode_ruangan,r.nama_ruangan,kl.nama_kelas,k.kode_kelas,count(*) as bed");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
        $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
        $this->db->group_by("r.kode_ruangan_a");
        $this->db->order_by("k.kode_ruangan,r.nama_ruangan");
        return $this->db->get("kamar k");
    }
    function getruangan_covid(){
        $this->db->select("r.kode_ruangan_a,k.kode_ruangan,r.nama_ruangan,kl.nama_kelas,k.kode_kelas,count(*) as bed");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
        $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
        $this->db->group_by("r.kode_ruangan_a");
        $this->db->where("k.covid",1);
        $this->db->order_by("k.kode_ruangan,r.nama_ruangan");
        return $this->db->get("kamar k");
    }
    function getbed(){
        $this->db->select("r.kode_ruangan_a,kl.kode_kelas_bpjs,kl.kode_kelas_dashboard,k.no_bed,count(*) as bed");
        $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
        $this->db->group_by("r.kode_ruangan_a,kode_kelas_dashboard");
        $this->db->where("r.kode_ruangan!=","19");
        $this->db->order_by("k.kode_ruangan");
        $q = $this->db->get("kamar k");
        $data = array();
        foreach ($q->result() as $key) {
            $data[$key->kode_ruangan_a][$key->kode_kelas_dashboard]["A"] = $key->bed;
            if (isset($data["ruang"][$key->kode_ruangan_a]))
                $data["ruang"][$key->kode_ruangan_a] += $key->bed;
            else
                $data["ruang"][$key->kode_ruangan_a] = $key->bed;
            if (isset($data["kelas"][$key->kode_kelas_dashboard]['A']))
                $data["kelas"][$key->kode_kelas_dashboard]['A'] += $key->bed;
            else
                $data["kelas"][$key->kode_kelas_dashboard]['A'] = $key->bed;
        }
        $this->db->select("r.kode_ruangan_a,kl.kode_kelas_bpjs,kl.kode_kelas_dashboard,k.no_bed,count(*) as bed");
        $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
        $this->db->group_by("r.kode_ruangan_a,kode_kelas_dashboard");
        $this->db->order_by("k.kode_ruangan");
        $this->db->where("r.kode_ruangan!=","19");
        $this->db->where("k.status_kamar","ISI");
        $q = $this->db->get("kamar k");
        foreach ($q->result() as $key) {
            $data[$key->kode_ruangan_a][$key->kode_kelas_dashboard]["B"] = $key->bed;
            if (isset($data["kelas"][$key->kode_kelas_dashboard]['B']))
                $data["kelas"][$key->kode_kelas_dashboard]['B'] += $key->bed;
            else
                $data["kelas"][$key->kode_kelas_dashboard]['B'] = $key->bed;
        }
        $this->db->select("r.kode_ruangan_a,kl.kode_kelas_bpjs,kl.kode_kelas_dashboard,k.no_bed,count(*) as bed");
        $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
        $this->db->group_by("r.kode_ruangan_a,kode_kelas_dashboard");
        $this->db->order_by("k.kode_ruangan");
        $this->db->where("r.kode_ruangan!=","19");
        $this->db->where("k.status_kamar","KOSONG");
        $q = $this->db->get("kamar k");
        foreach ($q->result() as $key) {
            $data[$key->kode_ruangan_a][$key->kode_kelas_dashboard]["C"] = $key->bed;
            if (isset($data["kelas"][$key->kode_kelas_dashboard]['C']))
                $data["kelas"][$key->kode_kelas_dashboard]['C'] += $key->bed;
            else
                $data["kelas"][$key->kode_kelas_dashboard]['C'] = $key->bed;
        }
        return $data;
    }
    function getkelas_rinap_pasien(){
        $this->db->select("count(*) AS bed, kelas.kode_kelas_dashboard as kode_kelas_dashboard");
        $this->db->join("kamar","kamar.kode_kelas=kelas.kode_kelas","left");
        $this->db->where("kamar.kode_ruangan!=","19");
        $this->db->group_by("kelas.kode_kelas_dashboard");
        $this->db->order_by("kelas.kode_kelas");
        return $this->db->get("kelas");
    }
    function getkelas(){
        $this->db->group_by("kode_kelas_dashboard");
        $this->db->order_by("kode_kelas");
        return $this->db->get("kelas");
    }
    function getpoliklinik(){
        return $this->db->get("poliklinik");
    }
    function getpoliklinik_detail($kode){
        return $this->db->get_where("poliklinik",["kode"=>$kode])->row();
    }
    function getpasien_poli2($tgl1,$tgl2){
        $data = array();
        // $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
        // $q = $this->db->get("rekap_igd");
        // if($q->num_rows()<=0){
          $q = $this->db->get("poliklinik");
          foreach ($q->result() as $value) {
              $this->db->where("layan!=",2);
              $this->db->where("date(p2.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
              $this->db->where("date(p2.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
              $this->db->where("p2.tujuan_poli",$value->kode);
              $this->db->join("pasien p1","p1.no_pasien=p2.no_pasien","inner");
              $sql = $this->db->get("pasien_ralan p2");
              foreach ($sql->result() as $key) {
                  if ($key->jenis=="R"){
                      if (isset($data["REGULER"][$value->kode]))
                          $data["REGULER"][$value->kode] += 1;
                      else
                          $data["REGULER"][$value->kode] = 1;
                  } else
                  if ($key->jenis=="E"){
                      if (isset($data["EKSEKUTIF"][$value->kode]))
                          $data["EKSEKUTIF"][$value->kode] += 1;
                      else
                          $data["EKSEKUTIF"][$value->kode] = 1;
                  }
                  if ($key->status_pasien=="BARU"){
                      if (isset($data["BARU"][$value->kode]))
                          $data["BARU"][$value->kode] += 1;
                      else
                          $data["BARU"][$value->kode] = 1;
                  } else
                  if ($key->status_pasien=="LAMA"){
                      if (isset($data["LAMA"][$value->kode]))
                          $data["LAMA"][$value->kode] += 1;
                      else
                          $data["LAMA"][$value->kode] = 1;
                  }
                  if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                      if (isset($data["DINAS"][$value->kode]))
                          $data["DINAS"][$value->kode] += 1;
                      else
                          $data["DINAS"][$value->kode] = 1;
                  } else
                  if ($key->id_gol==11){
                      if (isset($data["UMUM"][$value->kode]))
                          $data["UMUM"][$value->kode] += 1;
                      else
                          $data["UMUM"][$value->kode] = 1;
                  } else
                  if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                      if (isset($data["BPJS"][$value->kode]))
                          $data["BPJS"][$value->kode] += 1;
                      else
                          $data["BPJS"][$value->kode] = 1;
                  } else
                  if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                      if (isset($data["PRSH"][$value->kode]))
                          $data["PRSH"][$value->kode] += 1;
                      else
                          $data["PRSH"][$value->kode] = 1;
                  }
              }
          }
        // } else {
        //   foreach ($q->result() as $key) {
        //     $data["BARU"]["0102030"] = $key->baru;
        //     $data["LAMA"]["0102030"] = $key->lama;
        //     $data["REGULER"]["0102030"] = $key->reguler;
        //     $data["EKSEKUTIF"]["0102030"] = $key->eksekutif;
        //     $data["DINAS_A"]["0102030"] = $key->dinas_a;
        //     $data["DINAS_PUR"]["0102030"] = $key->dinas_pur;
        //     $data["UMUM"]["0102030"] = $key->umum;
        //     $data["BPJS"]["0102030"] = $key->bpjs;
        //     $data["PRSH"]["0102030"] = $key->prsh;
        //   }
        // }
        return $data;
    }
    function getpasien_inap(){
            $this->db->select("p2.id_gol,r.kode_ruangan_a,count(*) as jumlah,gp.jenis as jenis,gp.pensiunan");
            $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
            $this->db->where("isnull(tgl_keluar)",1);
            $this->db->where("r.kode_ruangan!=",19);
            $this->db->group_by("p2.id_gol,r.kode_ruangan_a");
            $p = $this->db->get("pasien_inap p2");
            foreach ($p->result() as $key) {
                if ($key->jenis=="DINAS"){
                    if (isset($data["DINAS"][$key->kode_ruangan_a]))
                        $data["DINAS"][$key->kode_ruangan_a] += $key->jumlah;
                    else
                        $data["DINAS"][$key->kode_ruangan_a] =  $key->jumlah;
                    if ($key->pensiunan){
                      if (isset($data["DINAS_PUR"][$key->kode_ruangan_a]))
                          $data["DINAS_PUR"][$key->kode_ruangan_a] += $key->jumlah;
                      else
                          $data["DINAS_PUR"][$key->kode_ruangan_a] =  $key->jumlah;
                    } else {
                      if (isset($data["DINAS_A"][$key->kode_ruangan_a]))
                          $data["DINAS_A"][$key->kode_ruangan_a] += $key->jumlah;
                      else
                          $data["DINAS_A"][$key->kode_ruangan_a] =  $key->jumlah;
                    }
                } else
                if ($key->jenis=="UMUM"){
                    if (isset($data["UMUM"][$key->kode_ruangan_a]))
                        $data["UMUM"][$key->kode_ruangan_a] +=  $key->jumlah;
                    else
                        $data["UMUM"][$key->kode_ruangan_a] =  $key->jumlah;
                } else
                if ($key->jenis=="BPJS"){
                    if (isset($data["BPJS"][$key->kode_ruangan_a]))
                        $data["BPJS"][$key->kode_ruangan_a] +=  $key->jumlah;
                    else
                        $data["BPJS"][$key->kode_ruangan_a] =  $key->jumlah;
                } else
                if ($key->jenis=="PERUSAHAAN"){
                    if (isset($data["PRSH"][$key->kode_ruangan_a]))
                        $data["PRSH"][$key->kode_ruangan_a] +=  $key->jumlah;
                    else
                        $data["PRSH"][$key->kode_ruangan_a] =  $key->jumlah;
                }
                // if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                //     if (isset($data["DINAS"][$key->kode_ruangan_a]))
                //         $data["DINAS"][$key->kode_ruangan_a] += $key->jumlah;
                //     else
                //         $data["DINAS"][$key->kode_ruangan_a] =  $key->jumlah;
                // } else
                // if ($key->id_gol==11){
                //     if (isset($data["UMUM"][$key->kode_ruangan_a]))
                //         $data["UMUM"][$key->kode_ruangan_a] +=  $key->jumlah;
                //     else
                //         $data["UMUM"][$key->kode_ruangan_a] =  $key->jumlah;
                // } else
                // if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                //     if (isset($data["BPJS"][$key->kode_ruangan_a]))
                //         $data["BPJS"][$key->kode_ruangan_a] +=  $key->jumlah;
                //     else
                //         $data["BPJS"][$key->kode_ruangan_a] =  $key->jumlah;
                // } else
                // if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                //     if (isset($data["PRSH"][$key->kode_ruangan_a]))
                //         $data["PRSH"][$key->kode_ruangan_a] +=  $key->jumlah;
                //     else
                //         $data["PRSH"][$key->kode_ruangan_a] =  $key->jumlah;
                // }
            }
            $now = date("Y-m-d");
            $this->db->select("r.kode_ruangan_a,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
            $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
            $this->db->where("isnull(tgl_keluar)",1);
            $this->db->where("r.kode_ruangan!=",19);
            $p = $this->db->get("pasien_inap p2");
            foreach ($p->result() as $key) {
              if (isset($data["HP"][$key->kode_ruangan_a]))
                  $data["HP"][$key->kode_ruangan_a] += $key->hp;
              else
                  $data["HP"][$key->kode_ruangan_a] =  $key->hp;
            }
        return $data;
    }
    function getpasien_inap_jenis_kelas(){
            $this->db->select("p2.id_gol,r.kode_kelas_dashboard,count(*) as jumlah,gp.jenis as jenis");
            $this->db->join("kelas r","r.kode_kelas=p2.kode_kelas","inner");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
            $this->db->where("isnull(tgl_keluar)",1);
            $this->db->where("p2.kode_ruangan!=",19);
            $this->db->group_by("p2.id_gol,r.kode_kelas");
            $p = $this->db->get("pasien_inap p2");
            foreach ($p->result() as $key) {
                if ($key->jenis=="DINAS"){
                    if (isset($data["DINAS"][$key->kode_kelas_dashboard]))
                        $data["DINAS"][$key->kode_kelas_dashboard] += $key->jumlah;
                    else
                        $data["DINAS"][$key->kode_kelas_dashboard] =  $key->jumlah;
                } else
                if ($key->jenis=="UMUM"){
                    if (isset($data["UMUM"][$key->kode_kelas_dashboard]))
                        $data["UMUM"][$key->kode_kelas_dashboard] +=  $key->jumlah;
                    else
                        $data["UMUM"][$key->kode_kelas_dashboard] =  $key->jumlah;
                } else
                if ($key->jenis=="BPJS"){
                    if (isset($data["BPJS"][$key->kode_kelas_dashboard]))
                        $data["BPJS"][$key->kode_kelas_dashboard] +=  $key->jumlah;
                    else
                        $data["BPJS"][$key->kode_kelas_dashboard] =  $key->jumlah;
                } else
                if ($key->jenis=="PERUSAHAAN"){
                    if (isset($data["PRSH"][$key->kode_kelas_dashboard]))
                        $data["PRSH"][$key->kode_kelas_dashboard] +=  $key->jumlah;
                    else
                        $data["PRSH"][$key->kode_kelas_dashboard] =  $key->jumlah;
                }
                // if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                //     if (isset($data["DINAS"][$key->kode_ruangan_a]))
                //         $data["DINAS"][$key->kode_ruangan_a] += $key->jumlah;
                //     else
                //         $data["DINAS"][$key->kode_ruangan_a] =  $key->jumlah;
                // } else
                // if ($key->id_gol==11){
                //     if (isset($data["UMUM"][$key->kode_ruangan_a]))
                //         $data["UMUM"][$key->kode_ruangan_a] +=  $key->jumlah;
                //     else
                //         $data["UMUM"][$key->kode_ruangan_a] =  $key->jumlah;
                // } else
                // if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                //     if (isset($data["BPJS"][$key->kode_ruangan_a]))
                //         $data["BPJS"][$key->kode_ruangan_a] +=  $key->jumlah;
                //     else
                //         $data["BPJS"][$key->kode_ruangan_a] =  $key->jumlah;
                // } else
                // if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                //     if (isset($data["PRSH"][$key->kode_ruangan_a]))
                //         $data["PRSH"][$key->kode_ruangan_a] +=  $key->jumlah;
                //     else
                //         $data["PRSH"][$key->kode_ruangan_a] =  $key->jumlah;
                // }
            }
            $now = date("Y-m-d");
            $this->db->select("r.kode_kelas_dashboard,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
            $this->db->join("kelas r","r.kode_kelas=p2.kode_kelas","inner");
            $this->db->where("isnull(tgl_keluar)",1);
            $this->db->where("p2.kode_ruangan!=",19);
            $p = $this->db->get("pasien_inap p2");
            foreach ($p->result() as $key) {
              if (isset($data["HP"][$key->kode_kelas_dashboard]))
                  $data["HP"][$key->kode_kelas_dashboard] += $key->hp;
              else
                  $data["HP"][$key->kode_kelas_dashboard] =  $key->hp;
            }
        return $data;
    }
    function getpasien_inap_covid(){
        $this->db->select("p2.id_gol,p2.kode_ruangan,count(*) as jumlah,gp.jenis as jenis");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("kamar k","k.kode_ruangan=p2.kode_ruangan and k.kode_kamar=p2.kode_kamar and k.kode_kelas=p2.kode_kelas and k.no_bed=p2.no_bed","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("isnull(tgl_keluar)",1);
        $this->db->where("k.covid",1);
        $this->db->group_by("gp.jenis,k.kode_ruangan");
        $p = $this->db->get("pasien_inap p2");
        foreach ($p->result() as $key) {
            if ($key->jenis=="DINAS"){
                if (isset($data["DINAS"][$key->kode_ruangan]))
                    $data["DINAS"][$key->kode_ruangan] += $key->jumlah;
                else
                    $data["DINAS"][$key->kode_ruangan] =  $key->jumlah;
            } else
            if ($key->jenis=="UMUM"){
                if (isset($data["UMUM"][$key->kode_ruangan]))
                    $data["UMUM"][$key->kode_ruangan] +=  $key->jumlah;
                else
                    $data["UMUM"][$key->kode_ruangan] =  $key->jumlah;
            } else
            if ($key->jenis=="BPJS"){
                if (isset($data["BPJS"][$key->kode_ruangan]))
                    $data["BPJS"][$key->kode_ruangan] +=  $key->jumlah;
                else
                    $data["BPJS"][$key->kode_ruangan] =  $key->jumlah;
            } else
            if ($key->jenis=="PERUSAHAAN"){
                if (isset($data["PRSH"][$key->kode_ruangan]))
                    $data["PRSH"][$key->kode_ruangan] +=  $key->jumlah;
                else
                    $data["PRSH"][$key->kode_ruangan] =  $key->jumlah;
            }
        }
    return $data;
}
    function getlistpasien_inap(){
        $now = date("Y-m-d");
        $this->db->select("k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p2.id_gol,p1.nama_pasien,r.kode_ruangan_a,g.keterangan as gol_ket, (TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->where("isnull(tgl_keluar)",1);
        $this->db->where("kode_ruangan_a",$this->input->post("ruangan"));
        $p = $this->db->get("pasien_inap p2");
        return $p->result();
    }
    function getlistpasien_inap_kelas(){
        $now = date("Y-m-d");
        $this->db->select("k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p2.id_gol,p1.nama_pasien,r.kode_ruangan_a,g.keterangan as gol_ket,k.kode_kelas_dashboard as kode_kelas_dashboard, (TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->where("isnull(tgl_keluar)",1);
        $this->db->where("kode_kelas_dashboard",$this->input->post("kelas"));
        $p = $this->db->get("pasien_inap p2");
        return $p->result();
    }
    function getlistpasien_inap_covid(){
        $this->db->select("p1.jenis_kelamin,k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p2.id_gol,p1.nama_pasien,p2.kode_ruangan,g.keterangan as gol_ket,ap.status as status_covid");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("kamar km","km.kode_ruangan=p2.kode_ruangan and km.kode_kamar=p2.kode_kamar and km.kode_kelas=p2.kode_kelas and km.no_bed=p2.no_bed","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("assesmen_perawat ap","ap.no_reg=p2.no_reg","inner");
        $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->where("isnull(tgl_keluar)",1);
        $this->db->where("km.covid",1);
        $this->db->where("r.kode_ruangan_a",$this->input->post("ruangan_a"));
        $this->db->order_by("p2.kode_kamar,p2.no_bed","asc");
        $this->db->group_by("ap.no_reg");
        $p = $this->db->get("pasien_inap p2");
        return $p->result();
    }
    function getlistpasien_inap3_covid(){
        $data = array();
        $this->db->select("k.kode_kamar,k.no_bed");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
        $this->db->group_by("k.kode_kamar,k.no_bed");
        $k = $this->db->get_where("kamar k",["kode_ruangan_a"=>$this->input->post("ruangan_a")]);
        $data["kamar"] = $k->result();
        $this->db->select("p1.jenis_kelamin,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p2.kode_ruangan,ap.status as status_covid");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("kamar km","km.kode_ruangan=p2.kode_ruangan and km.kode_kamar=p2.kode_kamar and km.kode_kelas=p2.kode_kelas and km.no_bed=p2.no_bed","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("assesmen_perawat ap","ap.no_reg=p2.no_reg","inner");
        $this->db->where("isnull(tgl_keluar)",1);
        $this->db->where("km.covid",1);
        $this->db->where("r.kode_ruangan_a",$this->input->post("ruangan_a"));
        $this->db->group_by("ap.no_reg");
        $p = $this->db->get("pasien_inap p2");
        $data["list"] = array();
        foreach($p->result() as $row){
            $data["list"][$row->kode_kamar][$row->no_bed] = $row;
        }
        return $data;
    }
    function getpasien_denkes_rumkit(){
        $data = array();
        $this->db->select("p1.nip, p1.hubungan_keluarga, p1.nama_pasangan, p1.ibu, p2.no_reg as no_reg, p1.alamat as alamat, p1.id_pangkat, p2.id_gol as gol_pasien, p1.id_kesatuan, p2.no_rm as no_rm, p2.tgl_keluar as tgl_keluar, p2.nama_pasien as nama_pasien, r.nama_ruangan as ruangan, p2.kode_kamar as kode_kamar, p1.jenis_kelamin as jenis_kelamin, p2.kode_ruangan as kode_ruangan, p2.kode_kelas as kode_kelas, p2.no_bed as no_bed, p2.prosedur_masuk as masuk, p2.dokter, dk.nama_dokter, p1.tgl_lahir as tahun");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("dokter dk","dk.id_dokter=p2.dokter","inner");
        $this->db->where("isnull(p2.tgl_keluar)",1);
        $this->db->where('((p2.id_gol >= "404" AND p2.id_gol <= "410") OR (p2.id_gol >= "415" AND p2.id_gol <= "417") OR p2.id_gol = "3133" OR p2.id_gol = "412" OR p2.id_gol = "402" OR p2.id_gol = "421")');
        $this->db->group_start();
        $this->db->like('p1.alamat', 'rumkit');
        $this->db->or_like('p1.alamat', 'denkes');
        $this->db->group_end();
        $this->db->order_by("r.kode_ruangan_a","asc");
        $p = $this->db->get("pasien_inap p2");
        foreach($p->result() as $row){
            $data["list"][$row->no_reg] = $row;
            $q = $this->db->get_where("kamar",["kode_kamar"=>$row->kode_kamar, "kode_ruangan"=>$row->kode_ruangan, "kode_kelas"=>$row->kode_kelas, "no_bed"=>$row->no_bed]);
            $data["kamar"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $q = $this->db->get_where("pangkat",["id_pangkat"=>$row->id_pangkat]);
            $data["pangkat"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $q = $this->db->get_where("riwayat_pasien_inap",["no_reg"=>$row->no_reg]);
            $data["diagnosa_medis"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $q = $this->db->get_where("resume_pulang",["no_reg"=>$row->no_reg]);
            $data["diagnosa_medis_2"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $this->db->join("dokter dk","dk.id_dokter=rpi.dokter_konsul","inner");
            $q = $this->db->get_where("riwayat_pasien_inap rpi",["no_reg"=>$row->no_reg]);
            $data["id_dokter"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        }
        return $data;
    }
    function getpasien_nondenkes(){
        $data = array();
        $this->db->select("p1.nip, p1.hubungan_keluarga, p1.nama_pasangan, p1.ibu, p2.no_reg as no_reg, p1.alamat as alamat, p1.id_pangkat, p2.id_gol as gol_pasien, p1.id_kesatuan, p2.no_rm as no_rm, p2.tgl_keluar as tgl_keluar, p2.nama_pasien as nama_pasien, r.nama_ruangan as ruangan, p2.kode_kamar as kode_kamar, p1.jenis_kelamin as jenis_kelamin, p2.kode_ruangan as kode_ruangan, p2.kode_kelas as kode_kelas, p2.no_bed as no_bed, p2.prosedur_masuk as masuk, p2.dokter, dk.nama_dokter, p1.tgl_lahir as tahun");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("dokter dk","dk.id_dokter=p2.dokter","inner");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->where("isnull(p2.tgl_keluar)",1);
        $this->db->where("g.pensiunan",0);
        $this->db->where('((p2.id_gol >= "404" AND p2.id_gol <= "406") OR (p2.id_gol >= "408" AND p2.id_gol <= "410") OR (p2.id_gol >= "415" AND p2.id_gol <= "417") OR (p2.id_gol >= "421" AND p2.id_gol <= "423") OR p2.id_gol = "3133" OR p2.id_gol = "412" OR p2.id_gol = "422" OR p2.id_gol = "423")');
        // $this->db->group_start();
        // $this->db->where("p2.id_gol>=","404");
        // $this->db->where("p2.id_gol<=","410");
        // $this->db->group_end();
        // $this->db->group_start();
        // $this->db->where("p2.id_gol>=","415");
        // $this->db->where("p2.id_gol<=","417");
        // $this->db->group_end();
        // $this->db->where("p2.id_gol=","412");
        // $this->db->where("p2.id_gol=","3133");
        $this->db->group_start();
        $this->db->not_like('p1.alamat', 'rumkit');
        $this->db->or_not_like('p1.alamat', 'denkes');
        $this->db->group_end();
        // $this->db->order_by("r.kode_ruangan_a,g.pensiunan","asc");
        $this->db->order_by("g.pensiunan","asc");
        $p = $this->db->get("pasien_inap p2");
        foreach($p->result() as $row){
            $data["list"][$row->no_reg] = $row;
            $q = $this->db->get_where("kamar",["kode_kamar"=>$row->kode_kamar, "kode_ruangan"=>$row->kode_ruangan, "kode_kelas"=>$row->kode_kelas, "no_bed"=>$row->no_bed]);
            $data["kamar"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $q = $this->db->get_where("pangkat",["id_pangkat"=>$row->id_pangkat]);
            $data["pangkat"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $q = $this->db->get_where("riwayat_pasien_inap",["no_reg"=>$row->no_reg]);
            $data["diagnosa_medis"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $q = $this->db->get_where("resume_pulang",["no_reg"=>$row->no_reg]);
            $data["diagnosa_medis_2"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            $this->db->join("dokter dk","dk.id_dokter=rpi.dokter_konsul","inner");
            $q = $this->db->get_where("riwayat_pasien_inap rpi",["no_reg"=>$row->no_reg]);
            $data["id_dokter"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        }
        return $data;
    }
    function getpasien_inap2($tgl1="",$tgl2=""){
      $data = array();
        $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
        // $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
    		// $q = $this->db->get("rekap_haemodialisa");
    		// if($q->num_rows()<=0){
          $this->db->select("p2.id_gol,p2.status_pulang,r.kode_ruangan_a,count(*) as jumlah");
          $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
          $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
          $this->db->where("tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
          $this->db->where("tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
          $this->db->where("p2.status_pulang!=","");
          $this->db->group_by("p2.id_gol,r.kode_ruangan_a,p2.status_pulang");
          $p = $this->db->get("pasien_inap p2");
          $data = array();
          foreach ($p->result() as $key) {
              if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                  if (isset($data["DINAS"][$key->kode_ruangan_a][$key->status_pulang]))
                      $data["DINAS"][$key->kode_ruangan_a][$key->status_pulang] += $key->jumlah;
                  else
                      $data["DINAS"][$key->kode_ruangan_a][$key->status_pulang] =  $key->jumlah;
              } else
              if ($key->id_gol==11){
                  if (isset($data["UMUM"][$key->kode_ruangan_a][$key->status_pulang]))
                      $data["UMUM"][$key->kode_ruangan_a][$key->status_pulang] +=  $key->jumlah;
                  else
                      $data["UMUM"][$key->kode_ruangan_a][$key->status_pulang] =  $key->jumlah;
              } else
              if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                  if (isset($data["BPJS"][$key->kode_ruangan_a][$key->status_pulang]))
                      $data["BPJS"][$key->kode_ruangan_a][$key->status_pulang] +=  $key->jumlah;
                  else
                      $data["BPJS"][$key->kode_ruangan_a][$key->status_pulang] =  $key->jumlah;
              } else
              if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                  if (isset($data["PRSH"][$key->kode_ruangan_a][$key->status_pulang]))
                      $data["PRSH"][$key->kode_ruangan_a][$key->status_pulang] +=  $key->jumlah;
                  else
                      $data["PRSH"][$key->kode_ruangan_a][$key->status_pulang] =  $key->jumlah;
              }
          }
          $now = date("Y-m-d");
          $this->db->select("r.kode_ruangan_a,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
          $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
          $this->db->where("tgl_keluar =",$now);
          $p = $this->db->get("pasien_inap p2");
          foreach ($p->result() as $key) {
            if (isset($data["HP"][$key->kode_ruangan_a]))
                $data["HP"][$key->kode_ruangan_a] += $key->hp;
            else
                $data["HP"][$key->kode_ruangan_a] =  $key->hp;
          }
        // } else {
        //   foreach ($q->result() as $key) {
        //       $data["DINAS_PUR"][$key->kode_ruangan][1] = $key->sehat_dinas_pur;
        //       $data["DINAS_A"][$key->kode_ruangan][1] = $key->sehat_dinas_a;
        //       $data["UMUM"][$key->kode_ruangan][1] = $key->sehat_umum;
        //       $data["BPJS"][$key->kode_ruangan][1] = $key->sehat_bpjs;
        //       $data["PRSH"][$key->kode_ruangan][1] = $key->sehat_prsh;
        //
        //       $data["DINAS_PUR"][$key->kode_ruangan][2] = $key->paksa_dinas_pur;
        //       $data["DINAS_A"][$key->kode_ruangan][2] = $key->paksa_dinas_a;
        //       $data["UMUM"][$key->kode_ruangan][2] = $key->paksa_umum;
        //       $data["BPJS"][$key->kode_ruangan][2] = $key->paksa_bpjs;
        //       $data["PRSH"][$key->kode_ruangan][2] = $key->paksa_prsh;
        //
        //       $data["DINAS_PUR"][$key->kode_ruangan][3] = $key->rujuk_dinas_pur;
        //       $data["DINAS_A"][$key->kode_ruangan][3] = $key->rujuk_dinas_a;
        //       $data["UMUM"][$key->kode_ruangan][3] = $key->rujuk_umum;
        //       $data["BPJS"][$key->kode_ruangan][3] = $key->rujuk_bpjs;
        //       $data["PRSH"][$key->kode_ruangan][3] = $key->rujuk_prsh;
        //
        //       $data["DINAS_PUR"][$key->kode_ruangan][4] = $key->meninggal_dinas_pur;
        //       $data["DINAS_A"][$key->kode_ruangan][4] = $key->meninggal_dinas_a;
        //       $data["UMUM"][$key->kode_ruangan][4] = $key->meninggal_umum;
        //       $data["BPJS"][$key->kode_ruangan][4] = $key->meninggal_bpjs;
        //       $data["PRSH"][$key->kode_ruangan][4] = $key->meninggal_prsh;
        //
        //       $data["HP"][$key->kode_ruangan] = $key->hari_perawatan;
        //   }
        // }
        return $data;
    }
    function getpasien_inap2_kelas($tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
        $this->db->select("p2.id_gol,p2.status_pulang,r.kode_kelas_dashboard as kode_kelas_dashboard,count(*) as jumlah");
        $this->db->join("kelas r","r.kode_kelas=p2.kode_kelas","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->where("tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("p2.status_pulang!=","");
        $this->db->where("p2.kode_ruangan!=",19);
        $this->db->group_by("p2.id_gol,r.kode_kelas,p2.status_pulang");
        $p = $this->db->get("pasien_inap p2");
        $data = array();
        foreach ($p->result() as $key) {
            if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                if (isset($data["DINAS"][$key->kode_kelas_dashboard][$key->status_pulang]))
                    $data["DINAS"][$key->kode_kelas_dashboard][$key->status_pulang] += $key->jumlah;
                else
                    $data["DINAS"][$key->kode_kelas_dashboard][$key->status_pulang] =  $key->jumlah;
            } else
            if ($key->id_gol==11){
                if (isset($data["UMUM"][$key->kode_kelas_dashboard][$key->status_pulang]))
                    $data["UMUM"][$key->kode_kelas_dashboard][$key->status_pulang] +=  $key->jumlah;
                else
                    $data["UMUM"][$key->kode_kelas_dashboard][$key->status_pulang] =  $key->jumlah;
            } else
            if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                if (isset($data["BPJS"][$key->kode_kelas_dashboard][$key->status_pulang]))
                    $data["BPJS"][$key->kode_kelas_dashboard][$key->status_pulang] +=  $key->jumlah;
                else
                    $data["BPJS"][$key->kode_kelas_dashboard][$key->status_pulang] =  $key->jumlah;
            } else
            if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                if (isset($data["PRSH"][$key->kode_kelas_dashboard][$key->status_pulang]))
                    $data["PRSH"][$key->kode_kelas_dashboard][$key->status_pulang] +=  $key->jumlah;
                else
                    $data["PRSH"][$key->kode_kelas_dashboard][$key->status_pulang] =  $key->jumlah;
            }
        }
        $now = date("Y-m-d");
        $this->db->select("r.kode_kelas_dashboard as kode_kelas_dashboard,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
        $this->db->join("kelas r","r.kode_kelas=p2.kode_kelas","inner");
        $this->db->where("tgl_keluar =",$now);
        $this->db->where("p2.kode_ruangan!=",19);
        $p = $this->db->get("pasien_inap p2");
        foreach ($p->result() as $key) {
          if (isset($data["HP"][$key->kode_kelas_dashboard]))
              $data["HP"][$key->kode_kelas_dashboard] += $key->hp;
          else
              $data["HP"][$key->kode_kelas_dashboard] =  $key->hp;
        }
        return $data;
    }
    function getlistpasien_inap2(){
        $tgl1 = $this->input->post("tgl1")=="" ? date("d-m-Y") : $this->input->post("tgl1");
        $tgl2 = $this->input->post("tgl2")=="" ? date("d-m-Y") : $this->input->post("tgl2");
        $now = date("Y-m-d");
        $this->db->select("k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p1.nama_pasien,p2.id_gol,p2.status_pulang,r.kode_ruangan_a,g.keterangan as gol_ket,s.keterangan as status_pulang, (TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->join("status_pulang s","s.id=p2.status_pulang","inner");
        $this->db->where("tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("p2.status_pulang!=","");
        $this->db->where("kode_ruangan_a",$this->input->post("ruangan"));
        $p = $this->db->get("pasien_inap p2");
        return $p->result();
    }
    function getlistpasien_inap2_kelas(){
        $tgl1 = $this->input->post("tgl1")=="" ? date("d-m-Y") : $this->input->post("tgl1");
        $tgl2 = $this->input->post("tgl2")=="" ? date("d-m-Y") : $this->input->post("tgl2");
        $now = date("Y-m-d");
        $this->db->select("k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p1.nama_pasien,p2.id_gol,p2.status_pulang,r.kode_ruangan_a,g.keterangan as gol_ket,s.keterangan as status_pulang, k.kode_kelas_dashboard as kode_kelas_dashboard, (TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->join("status_pulang s","s.id=p2.status_pulang","inner");
        $this->db->where("tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("p2.status_pulang!=","");
        $this->db->where("kode_kelas_dashboard",$this->input->post("kelas"));
        $p = $this->db->get("pasien_inap p2");
        return $p->result();
    }
    function getlistpasien_inap2_covid(){
        $tgl1 = $this->input->post("tgl1")=="" ? date("d-m-Y") : $this->input->post("tgl1");
        $tgl2 = $this->input->post("tgl2")=="" ? date("d-m-Y") : $this->input->post("tgl2");
        $this->db->select("p1.jenis_kelamin,k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p1.nama_pasien,p2.id_gol,p2.status_pulang,p2.kode_ruangan,g.keterangan as gol_ket,s.keterangan as status_pulang,ap.status as status_covid");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
        $this->db->join("kamar km","km.kode_ruangan=p2.kode_ruangan and km.kode_kamar=p2.kode_kamar and km.kode_kelas=p2.kode_kelas and km.no_bed=p2.no_bed","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("assesmen_perawat ap","ap.no_reg=p2.no_reg","left");
        $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->join("status_pulang s","s.id=p2.status_pulang","inner");
        $this->db->where("tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("isnull(p2.status_pulang)",0);
        $this->db->where("km.covid",1);
        $this->db->group_by("ap.no_reg");
        $this->db->where("p2.kode_ruangan",$this->input->post("ruangan"));
        $this->db->order_by("p2.kode_kamar");
        $p = $this->db->get("pasien_inap p2");
        return $p->result();
    }
    function labrekap_ralan($tgl1="",$tgl2=""){
            $data = array();
            $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
            $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
            $this->db->select("k.kode_tarif,p.status_pasien,p.jenis,p.gol_pasien,count(*) as jumlah");
            $this->db->where("layan!=",2);
            $this->db->like("k.kode_tarif","L",'after');
            $this->db->where("date(p.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(p.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
            $this->db->join("kasir k","k.no_reg=p.no_reg","inner");
            $this->db->order_by("jumlah","desc");
            $this->db->group_by("kode_tarif");
            $sql = $this->db->get("pasien_ralan p");
            foreach ($sql->result() as $key) {
                if (isset($data[$key->kode_tarif]))
                    $data[$key->kode_tarif] += $key->jumlah;
                else
                    $data[$key->kode_tarif] = $key->jumlah;
            }
            return $data;
        }
    function labrekap_inap($tgl1="",$tgl2=""){
        $data = array();
        $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
        $this->db->select("k.kode_tarif,pa.id_gol,count(*) as jumlah");
        $this->db->like("k.kode_tarif","L",'after');
        $this->db->where("date(k.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(k.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->join("kasir_inap k","k.no_reg=p.no_reg","inner");
        $this->db->join("pasien pa","pa.no_pasien = p.no_rm","left");
        $this->db->order_by("jumlah","desc");
        $this->db->group_by("kode_tarif");
        $sql = $this->db->get("pasien_inap p");
        foreach ($sql->result() as $key) {
            if (isset($data[$key->kode_tarif]))
                $data[$key->kode_tarif] += $key->jumlah;
            else
                $data[$key->kode_tarif] = $key->jumlah;
        }
        return $data;
    }
    function gettindakan($tgl1="",$tgl2=""){
        $rekapralan = $this->labrekap_ralan($tgl1,$tgl2);
        $rekapinap = $this->labrekap_inap($tgl1,$tgl2);
        $data = array();
        $q = $this->db->get("tarif_lab");
        foreach ($q->result() as $value){
            $ralan = (isset($rekapralan[$value->kode_tindakan]) ? $rekapralan[$value->kode_tindakan] : 0);
            $inap = (isset($rekapinap[$value->kode_tindakan]) ? $rekapinap[$value->kode_tindakan] : 0);
            if ($ralan>0 || $inap>0)
                $data[] = array("tindakan"=>$value->nama_tindakan,"ralan"=>$ralan,"inap"=>$inap);
        }
        return $data;
    }
    function getpasienigdinap($tgl1,$tgl2){
        $data = array();
        // $this->db->where("layan!=",2);
        // $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
        // $q = $this->db->get("rekap_igd");
        // if($q->num_rows()<=0){
          $this->db->where("date(p2.tgl_masuk)>=",date("Y-m-d",strtotime($tgl1)));
          $this->db->where("date(p2.tgl_masuk)<=",date("Y-m-d",strtotime($tgl2)));
          $this->db->where("p2.prosedur_masuk","UGD");
          $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
          $sql = $this->db->get("pasien_inap p2");
          foreach ($sql->result() as $key) {
              if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                  if (isset($data["DINAS"]))
                      $data["DINAS"] += 1;
                  else
                      $data["DINAS"] = 1;
              } else
              if ($key->id_gol==11){
                  if (isset($data["UMUM"]))
                      $data["UMUM"] += 1;
                  else
                      $data["UMUM"] = 1;
              } else
              if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                  if (isset($data["BPJS"]))
                      $data["BPJS"] += 1;
                  else
                      $data["BPJS"] = 1;
              } else
              if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                  if (isset($data["PRSH"]))
                      $data["PRSH"] += 1;
                  else
                      $data["PRSH"] = 1;
              }
          }
        // } else {
        //   foreach ($q->result() as $key) {
        //     $data["BARU"] = $key->baru;
        //     $data["LAMA"] = $key->lama;
        //     $data["REGULER"] = $key->reguler;
        //     $data["EKSEKUTIF"] = $key->eksekutif;
        //     $data["DINAS_A"] = $key->dinas_a;
        //     $data["DINAS_PUR"] = $key->dinas_pur;
        //     $data["UMUM"] = $key->umum;
        //     $data["BPJS"] = $key->bpjs;
        //     $data["PRSH"] = $key->prsh;
        //   }
        // }
        return $data;
    }
    function getpasien_prosedur2(){
        $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah,gp.jenis as golongan,p2.prosedur_masuk");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("month(tgl_masuk)",date("m"));
        $this->db->where("year(tgl_masuk)",date("Y"));
        $this->db->group_by("day(p2.tgl_masuk),prosedur_masuk,gp.jenis");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $data[$key->prosedur_masuk][$key->golongan][$key->hari] = $key->jumlah;
        }
        return $data;
    }
    function getpasien_prosedurtahun2(){
        $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah,gp.jenis as golongan,p2.prosedur_masuk");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("year(tgl_masuk)",date("Y"));
        $this->db->group_by("month(p2.tgl_masuk),prosedur_masuk,gp.jenis");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $data[$key->prosedur_masuk][$key->golongan][$key->bulan] = $key->jumlah;
        }
        return $data;
    }
    function getpasien_prosedurtoday(){
        $this->db->select("count(*) as jumlah,gp.jenis as golongan,p2.prosedur_masuk");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("tgl_masuk",date("Y-m-d"));
        $this->db->group_by("prosedur_masuk,gp.jenis");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $prosedur_masuk = ($key->prosedur_masuk=="" ? "Langsung" : $key->prosedur_masuk);
            $data[$prosedur_masuk][$key->golongan] = $key->jumlah;
        }
        $this->db->select("count(*) as jumlah,gp.jenis as golongan,p2.prosedur_masuk,gp.pensiunan");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("tgl_masuk",date("Y-m-d"));
        $this->db->where("jenis","DINAS");
        $this->db->group_by("prosedur_masuk,gp.pensiunan");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $prosedur_masuk = ($key->prosedur_masuk=="" ? "Langsung" : $key->prosedur_masuk);
            if (!$key->pensiunan)
              $data[$prosedur_masuk]["DINAS_A"] = $key->jumlah;
            else
              $data[$prosedur_masuk]["DINAS_PUR"] = $key->jumlah;
        }
        return $data;
    }
    function getcarapasien_masuk(){
        $this->db->select("day(p2.tgl_masuk) as hari,count(*) as jumlah,gp.jenis as golongan,p2.cara_masuk");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("month(tgl_masuk)",date("m"));
        $this->db->where("year(tgl_masuk)",date("Y"));
        $this->db->group_by("day(p2.tgl_masuk),cara_masuk,gp.jenis");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $data[$key->cara_masuk][$key->golongan][$key->hari] = $key->jumlah;
        }
        return $data;
    }
    function getcarapasien_masuktahun(){
        $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah,gp.jenis as golongan,p2.cara_masuk");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("year(tgl_masuk)",date("Y"));
        $this->db->group_by("day(p2.tgl_masuk),cara_masuk,gp.jenis");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $data[$key->cara_masuk][$key->golongan][$key->bulan] = $key->jumlah;
        }
        return $data;
    }
    function getcarapasien_masuktoday(){
        $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah,gp.jenis as golongan,p2.cara_masuk,gp.pensiunan");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("tgl_masuk",date("Y-m-d"));
        $this->db->group_by("cara_masuk,gp.jenis");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $cara_masuk = ($key->cara_masuk=="" ? "Sendiri" : $key->cara_masuk);
            $data[$cara_masuk][$key->golongan] = $key->jumlah;
        }
        $this->db->select("month(p2.tgl_masuk) as bulan,count(*) as jumlah,gp.jenis as golongan,p2.cara_masuk,gp.pensiunan");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
        $this->db->where("tgl_masuk",date("Y-m-d"));
        $this->db->where("jenis","DINAS");
        $this->db->group_by("cara_masuk,gp.pensiunan");
        $q = $this->db->get("pasien_inap p2");
        foreach ($q->result() as $key) {
            $cara_masuk = ($key->cara_masuk=="" ? "Sendiri" : $key->cara_masuk);
            if (!$key->pensiunan)
              $data[$cara_masuk]["DINAS_A"] = $key->jumlah;
            else
              $data[$cara_masuk]["DINAS_PUR"] = $key->jumlah;
        }
        return $data;
    }
    function dispaypasien_poli($poli,$dokter=""){
        $this->db->select("p.no_bpjs,pr.*,pol.keterangan as poli_asal,pol2.keterangan as poli_tujuan,p.nama_pasien as nama_pasien, g.keterangan as gol_pasien");
        $this->db->where("pr.tujuan_poli",$poli);
        $this->db->where("pr.layan!=",2);
        $this->db->where("date(pr.tanggal)",date("Y-m-d"));
        // $this->db->where("date(pr.tanggal)","2020-08-07");
        if ($dokter!="") {
            $this->db->where("pr.dokter_poli",$dokter);
        }
        $this->db->order_by("pr.no_antrian","asc");
        $this->db->join("pasien p","p.no_pasien=pr.no_pasien");
        $this->db->join("gol_pasien g","g.id_gol=pr.gol_pasien","left");
        $this->db->join("poliklinik pol","pol.kode=pr.dari_poli","left");
        $this->db->join("poliklinik pol2","pol2.kode=pr.tujuan_poli","left");
        $query = $this->db->get("pasien_ralan pr");
        $data = array();
        foreach($query->result() as $row){
            $data[$row->dokter_poli][] = $row;
        }
        return $data;
    }
    function getkamar($kode_kamar, $kode_ruangan, $kode_kelas, $no_bed){
        $this->db->select("nama_kamar, no_bed");
        return $this->db->get_where("kamar",["kode_kamar"=>$kode_kamar, "kode_ruangan"=>$kode_ruangan, "kode_kelas"=>$kode_kelas, "no_bed"=>$no_bed])->row();
    }
    function getdokter($dokter){
        $this->db->select("nama_dokter");
        return $this->db->get_where("dokter",["id_dokter"=>$dokter])->row();
    }
    function getdokterpoli($poli){
        // $this->db->join("jadwal_dokter j","jadwal_dokter j on j.id_dokter=d.id_dokter","inner");
        // $this->db->where("j.id_poli",$poli);
        // $q = $this->db->get("dokter d");
        $harike = date('w');
        $this->db->join("jadwal_dokter j","jadwal_dokter j on j.id_dokter=d.id_dokter","inner");
        $this->db->where("j.id_poli",$poli);
        $this->db->where("substring_index(substring_index(hari,',',".($harike+1)."),',',-1)",1);
        $q = $this->db->get("dokter d");
        return $q;
    }
    function getpasien_covid($tgl1,$tgl2){
        $data = array();
        $this->db->select("ap.status,p2.gol_pasien as id_gol,count(*) as jml");
        $this->db->where("layan!=",2);
        $this->db->where("ap.jenis","ralan");
        $this->db->where("date(p2.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(p2.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->join("pasien_ralan p2","p2.no_reg=ap.no_reg","inner");
        $this->db->group_by("ap.status,id_gol");
        $sql = $this->db->get("assesmen_perawat ap");
        foreach ($sql->result() as $key) {
            if (isset($data["RALAN"][$key->status]))
                $data["RALAN"][$key->status] += $key->jml;
            else
                $data["RALAN"][$key->status] = $key->jml;
            if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                if (isset($data["DINAS"][$key->status]))
                    $data["DINAS"][$key->status] += $key->jml;
                else
                    $data["DINAS"][$key->status] = $key->jml;
            } else
            if ($key->id_gol==11){
                if (isset($data["UMUM"][$key->status]))
                    $data["UMUM"][$key->status] += $key->jml;
                else
                    $data["UMUM"][$key->status] = $key->jml;
            } else
            if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                if (isset($data["BPJS"][$key->status]))
                    $data["BPJS"][$key->status] += $key->jml;
                else
                    $data["BPJS"][$key->status] = $key->jml;
            } else
            if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                if (isset($data["PRSH"][$key->status]))
                    $data["PRSH"][$key->status] += $key->jml;
                else
                    $data["PRSH"][$key->status] = $key->jml;
            }
        }
        $this->db->select("ap.status,p2.id_gol,count(*) as jml");
        $this->db->where("layan!=",2);
        $this->db->where("ap.jenis","ranap");
        $this->db->where("date(p2.tgl_masuk)>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("date(p2.tgl_masuk)<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->join("pasien_inap p2","p2.no_reg=ap.no_reg","inner");
        $this->db->group_by("ap.status,id_gol");
        $sql = $this->db->get("assesmen_perawat ap");
        foreach ($sql->result() as $key) {
            if (isset($data["RANAP"][$key->status]))
                $data["RANAP"][$key->status] += $key->jml;
            else
                $data["RANAP"][$key->status] = $key->jml;
            if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                if (isset($data["DINAS"][$key->status]))
                    $data["DINAS"][$key->status] += $key->jml;
                else
                    $data["DINAS"][$key->status] = $key->jml;
            } else
            if ($key->id_gol==11){
                if (isset($data["UMUM"][$key->status]))
                    $data["UMUM"][$key->status] += $key->jml;
                else
                    $data["UMUM"][$key->status] = $key->jml;
            } else
            if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                if (isset($data["BPJS"][$key->status]))
                    $data["BPJS"][$key->status] += $key->jml;
                else
                    $data["BPJS"][$key->status] = $key->jml;
            } else
            if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                if (isset($data["PRSH"][$key->status]))
                    $data["PRSH"][$key->status] += $key->jml;
                else
                    $data["PRSH"][$key->status] = $key->jml;
            }
        }
        return $data;
    }
    function getbed_covid(){
        $this->db->select("k.kode_ruangan,r.kode_ruangan_a,k.no_bed,count(*) as bed");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan");
        $this->db->group_by("r.kode_ruangan_a");
        $this->db->order_by("k.kode_ruangan");
        $this->db->where("k.covid",1);
        $q = $this->db->get("kamar k");
        $data = array();
        foreach ($q->result() as $key) {
            $data[$key->kode_ruangan_a]['A'] = $key->bed;
            $data["ruang"][$key->kode_ruangan_a] = $key->bed;
            if (isset($data["kelas"]['A']))
                $data["kelas"]['A'] += $key->bed;
            else
                $data["kelas"]['A'] = $key->bed;
        }
        $this->db->select("k.kode_ruangan,r.kode_ruangan_a,k.no_bed,count(*) as bed");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan");
        $this->db->group_by("r.kode_ruangan_a");
        $this->db->order_by("k.kode_ruangan");
        $this->db->where("k.covid",1);
        $this->db->where("k.status_kamar","ISI");
        $q = $this->db->get("kamar k");
        foreach ($q->result() as $key) {
            $data[$key->kode_ruangan_a]["B"] = $key->bed;
            if (isset($data["kelas"]['B']))
                $data["kelas"]['B'] += $key->bed;
            else
                $data["kelas"]['B'] = $key->bed;
        }
        $this->db->select("k.kode_ruangan,r.kode_ruangan_a,k.no_bed,count(*) as bed");
        $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan");
        $this->db->group_by("r.kode_ruangan_a");
        $this->db->order_by("k.kode_ruangan");
        $this->db->where("k.covid",1);
        $this->db->where("k.status_kamar","KOSONG");
        $q = $this->db->get("kamar k");
        foreach ($q->result() as $key) {
            $data[$key->kode_ruangan_a]['C'] = $key->bed;
            if (isset($data["kelas"]['C']))
                $data["kelas"]['C'] += $key->bed;
            else
                $data["kelas"]['C'] = $key->bed;
        }
        return $data;
    }
    function getpasien_inap2_covid($tgl1="",$tgl2=""){
        $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
        $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
        $this->db->select("p2.id_gol,p2.status_pulang,km.kode_ruangan,count(*) as jumlah");
        $this->db->join("kamar km","km.kode_ruangan=p2.kode_ruangan and km.kode_kamar=p2.kode_kamar and km.kode_kelas=p2.kode_kelas and km.no_bed=p2.no_bed","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->where("tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
        $this->db->where("isnull(p2.status_pulang)",0);
        $this->db->where("km.covid",1);
        $this->db->group_by("p2.id_gol,p2.kode_ruangan,p2.status_pulang");
        $p = $this->db->get("pasien_inap p2");
        $data = array();
        foreach ($p->result() as $key) {
            if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
                if (isset($data["DINAS"][$key->kode_ruangan][$key->status_pulang][$key->status_pulang]))
                    $data["DINAS"][$key->kode_ruangan][$key->status_pulang] += $key->jumlah;
                else
                    $data["DINAS"][$key->kode_ruangan][$key->status_pulang] =  $key->jumlah;
            } else
            if ($key->id_gol==11){
                if (isset($data["UMUM"][$key->kode_ruangan][$key->status_pulang]))
                    $data["UMUM"][$key->kode_ruangan][$key->status_pulang] +=  $key->jumlah;
                else
                    $data["UMUM"][$key->kode_ruangan][$key->status_pulang] =  $key->jumlah;
            } else
            if (($key->id_gol>=400 && $key->id_gol<=403) || ($key->id_gol>=411 && $key->id_gol<=414) || ($key->id_gol>=418 && $key->id_gol<=420)){
                if (isset($data["BPJS"][$key->kode_ruangan][$key->status_pulang]))
                    $data["BPJS"][$key->kode_ruangan][$key->status_pulang] +=  $key->jumlah;
                else
                    $data["BPJS"][$key->kode_ruangan][$key->status_pulang] =  $key->jumlah;
            } else
            if (($key->id_gol==12) || ($key->id_gol==13) || ($key->id_gol>=16 && $key->id_gol<=18)){
                if (isset($data["PRSH"][$key->kode_ruangan][$key->status_pulang]))
                    $data["PRSH"][$key->kode_ruangan][$key->status_pulang] +=  $key->jumlah;
                else
                    $data["PRSH"][$key->kode_ruangan][$key->status_pulang] =  $key->jumlah;
            }
        }
        return $data;
    }
    function getswab(){
        $this->db->select("p2.no_reg,p2.no_rm,p1.nama_pasien,p2.tgl_masuk,g.keterangan as gol_ket,r.nama_ruangan,a.status");
        $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan");
        $this->db->join("kamar km","km.kode_ruangan=p2.kode_ruangan and km.kode_kamar=p2.kode_kamar and km.kode_kelas=p2.kode_kelas and km.no_bed=p2.no_bed","inner");
        $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
        $this->db->join("assesmen_perawat a","a.no_reg=p2.no_reg","left");
        $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
        $this->db->where("isnull(tgl_keluar)",1);
        $this->db->where("km.covid",1);
        $this->db->like("a.id","igd");
        $this->db->order_by("p2.no_reg");
        $p = $this->db->get("pasien_inap p2");
        $data = array();
        $data["pasien"] = $p->result();
        foreach ($p->result() as $row){
            $this->db->order_by("tanggal");
            $this->db->where("no_reg",$row->no_reg);
            $this->db->group_start();
            // $this->db->where("kode_tindakan","L150");
            $this->db->or_where("kode_tindakan","L158");
            $this->db->group_end();
            $g = $this->db->get("ekspertisi_labinap");
            foreach($g->result() as $rw){
                $data["list"][$row->no_reg][] = $rw;
            }
        }
        return $data;
    }
    function getbor(){
        $data = array();
        $inap = $this->getpasien_inap();
        $r = $this->getruangan();
        $dinas = $umum = $bpjs = $prsh = 0;
        $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = 0;
        foreach($r->result() as $val){
            if (($val->kode_ruangan<13 || $val->kode_ruangan>14) && $val->kode_ruangan!=16){
                $dinas = (isset($inap["DINAS"][$val->kode_ruangan_a]) ? $inap["DINAS"][$val->kode_ruangan_a] : 0);
                $umum = (isset($inap["UMUM"][$val->kode_ruangan_a]) ? $inap["UMUM"][$val->kode_ruangan_a] : 0);
                $bpjs = (isset($inap["BPJS"][$val->kode_ruangan_a]) ? $inap["BPJS"][$val->kode_ruangan_a] : 0);
                $prsh = (isset($inap["PRSH"][$val->kode_ruangan_a]) ? $inap["PRSH"][$val->kode_ruangan_a] : 0);
                $bed = $val->bed;
                $jml_dinas += $dinas;
                $jml_umum += $umum;
                $jml_bpjs += $bpjs;
                $jml_prsh += $prsh;
                $jml_bed += $bed;
            }
        }
        $data["jml_bed"] = $jml_bed;
        $data["jml_bed_kosong"] = $jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh;
        $data["bor"] = ($jml_bed>0 ? number_format(($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)." %";
        return $data;
    }
    function getbor_covid(){
        $data = array();
        $inap = $this->getpasien_inap_covid();
        $r = $this->getruangan_covid();
        $dinas = $umum = $bpjs = $prsh = 0;
        $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = 0;
        foreach($r->result() as $val){
            $dinas = (isset($inap["DINAS"][$val->kode_ruangan]) ? $inap["DINAS"][$val->kode_ruangan] : 0);
            $umum = (isset($inap["UMUM"][$val->kode_ruangan]) ? $inap["UMUM"][$val->kode_ruangan] : 0);
            $bpjs = (isset($inap["BPJS"][$val->kode_ruangan]) ? $inap["BPJS"][$val->kode_ruangan] : 0);
            $prsh = (isset($inap["PRSH"][$val->kode_ruangan]) ? $inap["PRSH"][$val->kode_ruangan] : 0);
            $bed = $val->bed;
            $jml_dinas += $dinas;
            $jml_umum += $umum;
            $jml_bpjs += $bpjs;
            $jml_prsh += $prsh;
            $jml_bed += $bed;
        }
        $data["jml_bed"] = $jml_bed;
        $data["jml_bed_kosong"] = $jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh;
        $data["bor"] = ($jml_bed>0 ? number_format(($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)." %";
        return $data;
    }
    function getpoliklinikrekap(){
        // poli yang tdak di ikutkan di rekap : lab,radiologi,hemadeolisa,igd,kedokteran dan kehakiman,pa,gizi
        $kode_sudah = array('0102024','0102025', '0102026','0102030','0102031','0102035','0102036');
        $this->db->where_not_in('kode', $kode_sudah);
        return $this->db->get("poliklinik");
    }
        function getpasien_rekap_full($tindakan,$tgl1,$tgl2){
            $data = array();
            //ralan
            $this->db->select("pr.tanggal,pr.no_pasien,pr.no_reg,pr.tujuan_poli,pr.dari_poli,pr.dokter_poli,pr.layan,p1.id_gol,pr.no_sjp");
            $this->db->where("pr.tujuan_poli",$tindakan);
            $this->db->where("pr.layan!=",2);
            $this->db->where("date(pr.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(pr.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
            $this->db->order_by('tanggal DESC');
            $this->db->join("pasien p1","p1.no_pasien=pr.no_pasien","inner");
            //$this->db->order_by("pr.no_reg");
            $query = $this->db->get("pasien_ralan pr");
            foreach ($query->result() as $row) {
                $data["list"][$row->no_reg] = $row;
                $q = $this->db->get_where("pasien",["no_pasien"=>$row->no_pasien]);
                $data["master"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                $q = $this->db->get_where("poliklinik",["kode"=>$row->tujuan_poli]);
                $data["pol2"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                $q = $this->db->get_where("poliklinik",["kode"=>$row->dari_poli]);
                $data["pol"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                $q = $this->db->get_where("dokter",["id_dokter"=>$row->dokter_poli]);
                $data["dokter"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                $q = $this->db->get_where("gol_pasien",["id_gol"=>$row->id_gol]);
                $data["golongan"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        //      $q = $this->db->order_by('hasil','desc')->get_where("ekspertisi_lab",["no_reg"=>$row->no_reg , "kode_tindakan"=>"$tindakan" ]);
        //      //$q = $this->db->get_where("ekspertisi_lab",["no_reg"=>$row->no_reg]);
                    // $data["ekspertisi_lab"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                    // }
            }
            //ranap
            //$this->db->select("k.no_reg,k.dokter_pengirim,pi.kode_ruangan,pi.kode_kelas,pi.kode_kamar,pi.status_pulang,pi.no_rm as no_pasien, k.pemeriksaan, k.tanggal");
        //  $this->db->where("k.kode_tarif",$tindakan);
        //  $this->db->where("date(k.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
        //  $this->db->where("date(k.tanggal)<=",date("Y-m-d",strtotime($tgl2)));;
        ////$this->db->order_by("k.no_reg");
        //  $this->db->join("kasir_inap k","k.no_reg=pi.no_reg","inner");
        //  $query = $this->db->get("pasien_inap pi");
        //  foreach ($query->result() as $row) {
        //      $data["list"][$row->no_reg] = $row;
        //      $q = $this->db->get_where("pasien",["no_pasien"=>$row->no_pasien]);
        //      $data["master"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        //      $q = $this->db->get_where("status_pulang s",["s.id"=>$row->status_pulang]);
        //      $data["status_pulang"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        //      $q = $this->db->get_where("ruangan r",["r.kode_ruangan"=> $row->kode_ruangan]);
        //      $data["ruangan"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        //      $q = $this->db->get_where("kelas kls",["kls.kode_kelas"=>$row->kode_kelas]);
        //      $data["kelas"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        //      $q = $this->db->get_where("kamar kmr",["kmr.kode_kamar"=>$row->kode_kamar,"kmr.kode_kelas"=>$row->kode_kelas, "kmr.kode_ruangan"=>$row->kode_ruangan]);
        //      $data["kamar"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        //      $q = $this->db->get_where("dokter",["id_dokter"=>$row->dokter_pengirim]);
        //      $data["dokter"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        // //   $q = $this->db->order_by('hasil','desc')->get_where("ekspertisi_labinap",["no_reg"=>$row->no_reg , "kode_tindakan"=>"$tindakan" ]);
        //   // $data["ekspertisi_lab"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
        //  }
            return $data;
        }
        function gettindakan_cetak($tindakan){
            if ($tindakan != "all") {
                $this->db->where("kode", $tindakan);
            }
            $q = $this->db->get("poliklinik");
            return $q;
        }
        function gettindakan_cetak2($tindakan){
            if ($tindakan != "all") {
                $this->db->where("kode", $tindakan);
            }
            $q = $this->db->get("poliklinik");
            return $q->row();
        }
        function getlistpasien_inap_igd(){
            $this->db->select("k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p2.id_gol,p1.nama_pasien,r.kode_ruangan_a,r.nama_ruangan,g.keterangan as gol_ket, pigd.a as diagnosa, dk.nama_dokter as nama_dokter");
            $this->db->join("pasien_igdinap pigd","pigd.no_reg=p2.no_reg","inner");
            $this->db->join("dokter dk","dk.id_dokter=p2.dokter","inner");
            $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
            $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
            $this->db->where("isnull(tgl_keluar)",1);
            $this->db->where("date(p2.tgl_masuk)>=",date("Y-m-d"));
            $this->db->where("date(p2.tgl_masuk)<=",date("Y-m-d"));
            $this->db->where("p2.prosedur_masuk","UGD");
            $p = $this->db->get("pasien_inap p2");
            return $p->result();
        }
        function getlistpasien_ralan_igd(){
            $this->db->select("p2.no_pasien,p2.no_reg,p2.gol_pasien,p1.nama_pasien,g.keterangan as gol_ket, pigd.a as diagnosa, dk.nama_dokter as nama_dokter");
            $this->db->join("pasien_igd pigd","pigd.no_reg=p2.no_reg","inner");
            $this->db->join("dokter dk","dk.id_dokter=p2.dokter_poli","inner");
            $this->db->join("gol_pasien g","g.id_gol=p2.gol_pasien","inner");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_pasien","inner");
            $this->db->where("date(p2.tanggal)>=",date("Y-m-d"));
            $this->db->where("date(p2.tanggal)<=",date("Y-m-d"));
            $this->db->where("p2.tujuan_poli","0102030");
            $p = $this->db->get("pasien_ralan p2");
            return $p->result();
        }
        function getpasien_inaplama(){
            $data = array();
            $this->db->select("p1.nip, k.covid, p2.no_reg as no_reg, p1.alamat as alamat, p1.id_pangkat, p2.id_gol as gol_pasien, p2.no_rm as no_rm, p2.tgl_masuk as tgl_masuk, p2.nama_pasien as nama_pasien, r.nama_ruangan as ruangan, p1.jenis_kelamin as jenis_kelamin, p2.kode_ruangan as kode_ruangan, p2.no_bed as no_bed, p2.prosedur_masuk as masuk, p2.dokter, dk.nama_dokter, p2.tarif_bpjs, p2.tarif_rumahsakit");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
            $this->db->join("kamar k","k.kode_kamar=p2.kode_kamar and k.kode_ruangan=p2.kode_ruangan and k.kode_kelas=p2.kode_kelas and k.no_bed=p2.no_bed","inner");
            $this->db->join("dokter dk","dk.id_dokter=p2.dokter","inner");
            $this->db->where("isnull(p2.tgl_keluar)",1);
            $this->db->order_by("r.kode_ruangan_a","asc");
            $p = $this->db->get("pasien_inap p2");
            foreach($p->result() as $row){
                $data["list"][$row->no_reg] = $row;
                $q = $this->db->get_where("riwayat_pasien_inap",["no_reg"=>$row->no_reg]);
                $data["diagnosa_medis"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                $q = $this->db->get_where("simulasi_koding",["no_reg"=>$row->no_reg]);
                $data["simulasi"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                $q = $this->db->get_where("resume_pulang",["no_reg"=>$row->no_reg]);
                $data["diagnosa_medis_2"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
                $this->db->join("dokter dk","dk.id_dokter=rpi.dokter_konsul","inner");
                $q = $this->db->get_where("riwayat_pasien_inap rpi",["no_reg"=>$row->no_reg]);
                $data["id_dokter"][$row->no_reg] = ($q->num_rows()>0 ? $q->row() : "");
            }
            return $data;
        }
        function getpasienrujuk(){
          $data = array();
          $this->db->select("pasien_ralan.*,concat('ralan') as jenis,tanggal as tgl_masuk,tanggal as jam_masuk,tanggal as tgl_keluar,tanggal as jam_keluar,tanggal as jam_keluar");
          $q = $this->db->get_where("pasien_ralan",["date(tanggal)"=>date("Y-m-d"),"layan!=",2]);
          foreach($q->result() as $row){
            $data["list"][$row->no_pasien][$row->no_reg] = $row;
            $n = $this->db->get_where("buku_rujukan",["no_pasien"=>$row->no_pasien,"no_reg"=>$row->no_reg]);
            if ($n->num_rows()>0){
              $data["br"][$row->no_pasien][$row->no_reg] = $n->row();
            }
            $n = $this->db->get_where("poliklinik",["kode"=>$row->tujuan_poli]);
            if ($n->num_rows()>0){
              $data["ruangan"][$row->no_pasien][$row->no_reg] = $n->row()->keterangan;
            }
            $n = $this->db->get_where("dokter",["id_dokter"=>$row->dokter_poli]);
            if ($n->num_rows()>0){
              $data["dpjp"][$row->no_pasien][$row->no_reg] = $n->row()->nama_dokter;
            }
            $n = $this->db->get_where("pasien",["no_pasien"=>$row->no_pasien]);
            if ($n->num_rows()>0){
              $data["master"][$row->no_pasien][$row->no_reg] = $n->row()->alamat;
            }
          }
          $this->db->select("pasien_inap.*,concat('ranap') as jenis");
          $q = $this->db->get_where("pasien_inap",["date(tgl_keluar)"=>date("Y-m-d"),"status_pulang"=>3]);
          foreach($q->result() as $row){
            $data["list"][$row->no_rm][$row->no_reg] = $row;
            $n = $this->db->get_where("buku_rujukan",["no_pasien"=>$row->no_rm,"no_reg"=>$row->no_reg]);
            if ($n->num_rows()>0){
              $data["br"][$row->no_rm][$row->no_reg] = $n->row();
            }
            $n = $this->db->get_where("ruangan",["kode_ruangan"=>$row->kode_ruangan]);
            if ($n->num_rows()>0){
              $data["ruangan"][$row->no_rm][$row->no_reg] = $n->row()->nama_ruangan;
            }
            $n = $this->db->get_where("dokter",["id_dokter"=>$row->dpjp]);
            if ($n->num_rows()>0){
              $data["dpjp"][$row->no_rm][$row->no_reg] = $n->row()->nama_dokter;
            }
            $n = $this->db->get_where("pasien",["no_pasien"=>$row->no_rm]);
            if ($n->num_rows()>0){
              $data["master"][$row->no_rm][$row->no_reg] = $n->row()->alamat;
            }
          }
          return $data;
        }
        function getkontrole(){
          $this->db->select("k.*,p.nama_perawat,p.ttd");
          $this->db->join("perawat p","p.id_perawat=k.id_perawat");
          $q = $this->db->get_where("kontrole k",["k.tanggal"=>date("Y-m-d")]);
          return $q->row();
        }
        function simpankontrole($action){
          $q = $this->db->get_where("kontrole",["tanggal"=>date("Y-m-d")]);
          if ($q->num_rows()>0) $action = "edit"; else $action="simpan";
          switch ($action) {
            case 'simpan':
              $data = array("tanggal"=>date("Y-m-d"),"kerusakan"=>$this->input->post("kerusakan"),"lainlain"=>$this->input->post("lainlain"),"id_perawat"=>$this->input->post("id_perawat"));
              $this->db->insert("kontrole",$data);
              break;
            case 'edit':
              $data = array("tanggal"=>date("Y-m-d"),"kerusakan"=>$this->input->post("kerusakan"),"lainlain"=>$this->input->post("lainlain"),"id_perawat"=>$this->input->post("id_perawat"));
              $this->db->where("tanggal",date("Y-m-d"));
              $this->db->update("kontrole",$data);
              break;
          }
          // $this->simpanrekap();
          return "seccess-Data berhasil disimpan";
        }
        function getpasien_inap_kontrole($tgl){
            $data = array();
            // $this->db->where("tanggal",date("Y-m-d",strtotime($tgl)));
            // $q = $this->db->get("rekap_pasienranap");
            // if($q->num_rows()<=0){
              $this->db->select("p2.id_gol,r.kode_ruangan_a,count(*) as jumlah,gp.jenis as jenis,gp.pensiunan,p2.kode_kelas");
              $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
              $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
              $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
              $this->db->where("isnull(tgl_keluar)",1);
              $this->db->where("r.kode_ruangan!=",19);
              $this->db->group_by("p2.id_gol,r.kode_ruangan_a,p2.kode_kelas");
              $p = $this->db->get("pasien_inap p2");
              foreach ($p->result() as $key) {
                  if ($key->jenis=="DINAS"){
                      if ($key->pensiunan){
                        if (isset($data["DINAS_PUR"][$key->kode_ruangan_a][$key->kode_kelas]))
                            $data["DINAS_PUR"][$key->kode_ruangan_a][$key->kode_kelas] += $key->jumlah;
                        else
                            $data["DINAS_PUR"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                      } else {
                        if (isset($data["DINAS_A"][$key->kode_ruangan_a][$key->kode_kelas]))
                            $data["DINAS_A"][$key->kode_ruangan_a][$key->kode_kelas] += $key->jumlah;
                        else
                            $data["DINAS_A"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                      }
                  } else
                  if ($key->jenis=="UMUM"){
                      if (isset($data["UMUM"][$key->kode_ruangan_a][$key->kode_kelas]))
                          $data["UMUM"][$key->kode_ruangan_a][$key->kode_kelas] +=  $key->jumlah;
                      else
                          $data["UMUM"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                  } else
                  if ($key->jenis=="BPJS"){
                      if (isset($data["BPJS"][$key->kode_ruangan_a][$key->kode_kelas]))
                          $data["BPJS"][$key->kode_ruangan_a][$key->kode_kelas] +=  $key->jumlah;
                      else
                          $data["BPJS"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                  } else
                  if ($key->jenis=="PERUSAHAAN"){
                      if (isset($data["PRSH"][$key->kode_ruangan_a][$key->kode_kelas]))
                          $data["PRSH"][$key->kode_ruangan_a][$key->kode_kelas] +=  $key->jumlah;
                      else
                          $data["PRSH"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                  }
              }
              $now = date("Y-m-d");
              $this->db->select("r.kode_ruangan_a,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp,p2.kode_kelas");
              $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
              $this->db->where("isnull(tgl_keluar)",1);
              $this->db->where("r.kode_ruangan!=",19);
              $p = $this->db->get("pasien_inap p2");
              foreach ($p->result() as $key) {
                if (isset($data["HP"][$key->kode_ruangan_a][$key->kode_kelas]))
                    $data["HP"][$key->kode_ruangan_a][$key->kode_kelas] += $key->hp;
                else
                    $data["HP"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->hp;
              }
            // } else {
            //   foreach ($q->result() as $key) {
            //       $data["DINAS_PUR"][$key->kode_ruangan][$key->kode_kelas] = $key->dinas_pur;
            //       $data["DINAS_A"][$key->kode_ruangan][$key->kode_kelas] = $key->dinas_a;
            //       $data["UMUM"][$key->kode_ruangan][$key->kode_kelas] = $key->umum;
            //       $data["BPJS"][$key->kode_ruangan][$key->kode_kelas] = $key->bpjs;
            //       $data["PRSH"][$key->kode_ruangan][$key->kode_kelas] = $key->prsh;
            //       $data["HP"][$key->kode_ruangan][$key->kode_kelas] = $key->hp;
            //   }
            // }
            return $data;
        }
        function getpasien_inap3_kontrole(){
            $this->db->select("p2.id_gol,r.kode_ruangan_a,count(*) as jumlah,gp.jenis as jenis,gp.pensiunan,p2.kode_kelas");
            $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
            // $this->db->where("isnull(tgl_keluar)",1);
            $this->db->where("tgl_masuk",date("Y-m-d"));
            $this->db->where("r.kode_ruangan!=",19);
            $this->db->group_by("p2.id_gol,r.kode_ruangan_a,p2.kode_kelas");
            $p = $this->db->get("pasien_inap p2");
            foreach ($p->result() as $key) {
                if ($key->jenis=="DINAS"){
                    if ($key->pensiunan){
                      if (isset($data["DINAS_PUR"][$key->kode_ruangan_a][$key->kode_kelas]))
                          $data["DINAS_PUR"][$key->kode_ruangan_a][$key->kode_kelas] += $key->jumlah;
                      else
                          $data["DINAS_PUR"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                    } else {
                      if (isset($data["DINAS_A"][$key->kode_ruangan_a][$key->kode_kelas]))
                          $data["DINAS_A"][$key->kode_ruangan_a][$key->kode_kelas] += $key->jumlah;
                      else
                          $data["DINAS_A"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                    }
                } else
                if ($key->jenis=="UMUM"){
                    if (isset($data["UMUM"][$key->kode_ruangan_a][$key->kode_kelas]))
                        $data["UMUM"][$key->kode_ruangan_a][$key->kode_kelas] +=  $key->jumlah;
                    else
                        $data["UMUM"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                } else
                if ($key->jenis=="BPJS"){
                    if (isset($data["BPJS"][$key->kode_ruangan_a][$key->kode_kelas]))
                        $data["BPJS"][$key->kode_ruangan_a][$key->kode_kelas] +=  $key->jumlah;
                    else
                        $data["BPJS"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                } else
                if ($key->jenis=="PERUSAHAAN"){
                    if (isset($data["PRSH"][$key->kode_ruangan_a][$key->kode_kelas]))
                        $data["PRSH"][$key->kode_ruangan_a][$key->kode_kelas] +=  $key->jumlah;
                    else
                        $data["PRSH"][$key->kode_ruangan_a][$key->kode_kelas] =  $key->jumlah;
                }
            }
            return $data;
        }
        function getruangan_kontrole(){
            $this->db->select("r.kode_ruangan_a,k.kode_ruangan,r.nama_ruangan,kl.nama_kelas,k.kode_kelas,count(*) as bed");
            $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
            $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
            $this->db->group_by("r.kode_ruangan_a,k.kode_kelas");
            $this->db->order_by("k.kode_ruangan,r.nama_ruangan,k.kode_kelas");
            $q = $this->db->get("kamar k");
            $data = array();
            foreach($q->result() as $row){
              $data[$row->kode_ruangan_a][$row->kode_kelas] = $row;
            }
            return $data;
        }
        function getlistpasienmeninggal_inap($tgl1,$tgl2){
            $now = date("Y-m-d");
            $this->db->select("k.nama_kelas,p2.kode_kamar,p2.no_bed,p2.no_rm,p2.no_reg,p1.nama_pasien,p2.id_gol,p2.status_pulang,r.kode_ruangan_a,g.keterangan as gol_ket,s.keterangan as status_pulang, (TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
            $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
            $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
            $this->db->join("kelas k","k.kode_kelas=p2.kode_kelas","inner");
            $this->db->join("gol_pasien g","g.id_gol=p2.id_gol","inner");
            $this->db->join("status_pulang s","s.id=p2.status_pulang","inner");
            $this->db->where("tgl_keluar>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("tgl_keluar<=",date("Y-m-d",strtotime($tgl2)));
            $this->db->where("p2.status_pulang","4");
            $p = $this->db->get("pasien_inap p2");
            return $p->result();
        }
        function gettarif_inap(){
    			$this->db->where("kode_tindakan", "hdl");
    			return $this->db->get("tarif_inap");
    		}
        function getlistpasienmeninggal($tgl1,$tgl2){
          $data = array();
          $this->db->select("s.no_reg,s.no_pasien as no_rm,p.dokter_poli as dpjp,p.tanggal as tgl_masuk,p.tanggal as tgl_keluar,p.tujuan_poli");
          $this->db->where("date(p.tanggal)",date("Y-m-d",strtotime($tgl1)));
          $this->db->where("s.jenis","ralan");
          $this->db->join("pasien_ralan p","p.no_reg=s.no_reg and p.no_pasien=s.no_pasien","inner");
          $p = $this->db->get("surat_kematian s");
          foreach($p->result() as $row){
            $data["list"][$row->no_rm][$row->no_reg] = $row;
            $q = $this->db->get_where("pasien",["no_pasien"=>$row->no_rm])->row();
            $data["master"][$row->no_rm][$row->no_reg] = $q;
            $q = $this->db->get_where("poliklinik",["kode"=>$row->tujuan_poli])->row();
            $data["ruangan"][$row->no_rm][$row->no_reg] = $q->keterangan;
            $q = $this->db->get_where("dokter",["id_dokter"=>$row->dpjp])->row();
            $data["dpjp"][$row->no_rm][$row->no_reg] = $q->nama_dokter;
            $q = $this->db->get_where("resume_pulang",["no_reg"=>$row->no_reg])->row();
            $data["dx"][$row->no_rm][$row->no_reg] = $q->diagnosa_akhir;
          }
          $this->db->select("s.no_reg,s.no_pasien as no_rm,p.dpjp,p.tgl_masuk,concat(p.tgl_keluar,' ',p.jam_keluar) as tgl_keluar,p.kode_ruangan");
          $this->db->where("date(p.tgl_keluar)",date("Y-m-d",strtotime($tgl1)));
          $this->db->where("s.jenis","ranap");
          $this->db->join("pasien_inap p","p.no_reg=s.no_reg and p.no_rm=s.no_pasien","inner");
          $p = $this->db->get("surat_kematian s");
          foreach($p->result() as $row){
            $data["list"][$row->no_rm][$row->no_reg] = $row;
            $q = $this->db->get_where("pasien",["no_pasien"=>$row->no_rm])->row();
            $data["master"][$row->no_rm][$row->no_reg] = $q;
            $q = $this->db->get_where("ruangan",["kode_ruangan"=>$row->kode_ruangan])->row();
            $data["ruangan"][$row->no_rm][$row->no_reg] = $q->nama_ruangan;
            $q = $this->db->get_where("dokter",["id_dokter"=>$row->dpjp])->row();
            $data["dpjp"][$row->no_rm][$row->no_reg] = $q->nama_dokter;
            $q = $this->db->get_where("resume_pulang",["no_reg"=>$row->no_reg])->row();
            $data["dx"][$row->no_rm][$row->no_reg] = $q->diagnosa_akhir;
          }
          return $data;
        }
        function rekap_ralan_full($tindakan,$tgl1="",$tgl2=""){
          $data = array();
          // $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
          // $q = $this->db->get("rekap_pasienralan");
          // if($q->num_rows()<=0){
            $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
            $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
            $this->db->select("p.status_pasien,p.jenis,p.gol_pasien,p.tujuan_poli,g.pensiunan");
            $this->db->join("gol_pasien g","g.id_gol=p.gol_pasien","inner");
            if ($tindakan!="all")
            $this->db->where("p.tujuan_poli =",$tindakan);
            $this->db->where("p.layan!=",2);
            $this->db->where("date(p.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(p.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
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
          //   foreach($q->result() as $key){
          //     $data["BARU"][$key->tujuan_poli] = $key->baru;
          //     $data["LAMA"][$key->tujuan_poli] = $key->lama;
          //     $data["REGULER"][$key->tujuan_poli] = $key->reguler;
          //     $data["EKSEKUTIF"][$key->tujuan_poli] = $key->eksekutif;
          //     $data["DINAS_A"][$key->tujuan_poli] = $key->dinas_a;
          //     $data["DINAS_PUR"][$key->tujuan_poli] = $key->dinas_pur;
          //     $data["UMUM"][$key->tujuan_poli] = $key->umum;
          //     $data["BPJS"][$key->tujuan_poli] = $key->bpjs;
          //     $data["PRSH"][$key->tujuan_poli] = $key->prsh;
          //   }
          // }
          return $data;
        }
        function gettindakan_full_rekap(){
            $data = array();
            $this->db->select("t.operasi ");
            $this->db->like("t.operasi","T",'after');
            $ralan = $this->db->get("oka t");
            foreach ($ralan->result() as $cari) {
                $cari_ralan = $cari->operasi;
                $this->db->select("tp.kode_tindakan as kode ,tp.nama_tindakan");
                $this->db->where_in('kode_tindakan', $cari_ralan);
                $query = $this->db->get("tarif_ralan tp");
                foreach ($query->result() as $row) {
                    $data["kode"][$row->kode] = $row;
                }
            }
            $this->db->select("tp.kode ,tp.nama_tindakan");
            $query = $this->db->get("tarif_operasi tp");
            foreach ($query->result() as $row) {
                $data["kode"][$row->kode] = $row;
            }
            return $data;
        }
        function rekap_inap_full($tindakan,$tgl1="",$tgl2=""){
            $data = array();
            $tgl1 = $tgl1=="" ? date("Y-m-d") : $tgl1;
            $tgl2 = $tgl2=="" ? date("Y-m-d") : $tgl2;
            $this->db->select("p.operasi,pa.id_gol as gol_pasien,g.pensiunan");
            if ($tindakan!="all") {
                $this->db->where("p.operasi",$tindakan);
            }
            $this->db->where("p.pelayanan","RANAP");
            $this->db->where("date(p.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("date(p.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
            $this->db->where("(p.laporan IS NOT NULL OR p.mata IS NOT NULL OR p.lain IS NOT NULL OR p.pterygium IS NOT NULL)");
            $this->db->join("pasien_inap pa","pa.no_reg = p.no_reg","inner");
            $this->db->join("gol_pasien g","g.id_gol = pa.id_gol","inner");
            $sql = $this->db->get("oka p");
            foreach ($sql->result() as $key) {
                if (isset($data["tindakan"][$key->operasi]))
                $data["tindakan"][$key->operasi] += 1;
                else
                $data["tindakan"][$key->operasi] = 1;
                if (($key->gol_pasien>=404 && $key->gol_pasien<=410) || ($key->gol_pasien>=415 && $key->gol_pasien<=417) || ($key->gol_pasien==3133)){
                    if (isset($data["DINAS"][$key->operasi]))
                    $data["DINAS"][$key->operasi] += 1;
                    else
                    $data["DINAS"][$key->operasi] = 1;
                    if ($key->pensiunan){
          						if (isset($data["DINAS_PUR"][$key->operasi]))
          						$data["DINAS_PUR"][$key->operasi] += 1;
          						else
          						$data["DINAS_PUR"][$key->operasi] = 1;
          					} else {
          						if (isset($data["DINAS_A"][$key->operasi]))
          						$data["DINAS_A"][$key->operasi] += 1;
          						else
          						$data["DINAS_A"][$key->operasi] = 1;
          					}
                } else
                if ($key->gol_pasien==11){
                    if (isset($data["UMUM"][$key->operasi]))
                    $data["UMUM"][$key->operasi] += 1;
                    else
                    $data["UMUM"][$key->operasi] = 1;
                } else
                if (($key->gol_pasien>=400 && $key->gol_pasien<=403) || ($key->gol_pasien>=411 && $key->gol_pasien<=414) || ($key->gol_pasien>=418 && $key->gol_pasien<=420)){
                    if (isset($data["BPJS"][$key->operasi]))
                    $data["BPJS"][$key->operasi] += 1;
                    else
                    $data["BPJS"][$key->operasi] = 1;
                } else
                if (($key->gol_pasien==12) || ($key->gol_pasien==13) || ($key->gol_pasien>=16 && $key->gol_pasien<=18)){
                    if (isset($data["PRSH"][$key->operasi]))
                    $data["PRSH"][$key->operasi] += 1;
                    else
                    $data["PRSH"][$key->operasi] = 1;
                }
            }
            return $data;
        }
        function simpanrekap(){
          $data = array();
          $r = $this->getruangan_kontrole();
          $inap = $this->getpasien_inap_kontrole();
          foreach ($r as $kode_ruangan_a => $value) {
            foreach ($value as $kode_kelas => $row) {
              $dinas_a = (isset($inap["DINAS_A"][$kode_ruangan_a][$kode_kelas]) ? $inap["DINAS_A"][$kode_ruangan_a][$kode_kelas] : 0);
              $dinas_pur = (isset($inap["DINAS_PUR"][$kode_ruangan_a][$kode_kelas]) ? $inap["DINAS_PUR"][$kode_ruangan_a][$kode_kelas] : 0);
              $umum = (isset($inap["UMUM"][$kode_ruangan_a][$kode_kelas]) ? $inap["UMUM"][$kode_ruangan_a][$kode_kelas] : 0);
              $bpjs = (isset($inap["BPJS"][$kode_ruangan_a][$kode_kelas]) ? $inap["BPJS"][$kode_ruangan_a][$kode_kelas] : 0);
              $prsh = (isset($inap["PRSH"][$kode_ruangan_a][$kode_kelas]) ? $inap["PRSH"][$kode_ruangan_a][$kode_kelas] : 0);
              $bed = $row->bed;
              if ($row->kode_ruangan!=19){
                $data[] = array(
                  "tanggal" => date("Y-m-d") ,
                  "kode_ruangan" =>  $row->kode_ruangan,
                  "kode_kelas" =>  $kode_kelas,
                  "tt" =>  $bed,
                  "dinas_a" =>  $dinas_a,
                  "dinas_pur" =>  $dinas_pur,
                  "umum" =>  $umum,
                  "bpjs" =>  $bpjs,
                  "prsh" =>  $prsh,
                  "hari_perawatan" =>  (int)$inap["HP"][$kode_ruangan_a][$kode_kelas],
                  "bor" =>  ($bed>0 ? number_format(($dinas_a+$dinas_pur+$umum+$bpjs+$prsh)/$bed*100,2) : 0),
                );
              }
            }
          }
          $n = $this->db->get_where("rekap_pasienranap",["tanggal"=>date("Y-m-d")]);
          if ($n->num_rows()>0){
            $this->db->where("tanggal",date("Y-m-d"));
            $this->db->delete("rekap_pasienranap");
          }
          $this->db->insert_batch("rekap_pasienranap",$data);
          $data = array();
          $t = $this->getpoliklinikrekap();
          $tgl1 = date("d-m-Y");
          $tgl2 = date("d-m-Y");
          $ralan = $this->rekap_ralan_full("all",$tgl1,$tgl2);
          $baru_ralan = $lama_ralan = $reguler_ralan = $eks_ralan =$dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan = 0;
          foreach($t->result() as $row){
              $jumlah_ralan = (isset($ralan["DINAS"][$row->kode]) ? $ralan["DINAS"][$row->kode] : 0)+
                        (isset($ralan["UMUM"][$row->kode]) ? $ralan["UMUM"][$row->kode] : 0)+
                        (isset($ralan["BPJS"][$row->kode]) ? $ralan["BPJS"][$row->kode] : 0)+
                        (isset($ralan["PRSH"][$row->kode]) ? $ralan["PRSH"][$row->kode] : 0);
              $baru_ralan = (isset($ralan["BARU"][$row->kode]) ? $ralan["BARU"][$row->kode] : 0);
              $lama_ralan = (isset($ralan["LAMA"][$row->kode]) ? $ralan["LAMA"][$row->kode] : 0);
              $eks_ralan = (isset($ralan["EKSEKUTIF"][$row->kode]) ? $ralan["EKSEKUTIF"][$row->kode] : 0);
              $reguler_ralan = (isset($ralan["REGULER"][$row->kode]) ? $ralan["REGULER"][$row->kode] : 0);
              $dinas_ralan = (isset($ralan["DINAS"][$row->kode]) ? $ralan["DINAS"][$row->kode] : 0);
              $dinas_a_ralan = (isset($ralan["DINAS_A"][$row->kode]) ? $ralan["DINAS_A"][$row->kode] : 0);
              $dinas_pur_ralan = (isset($ralan["DINAS_PUR"][$row->kode]) ? $ralan["DINAS_PUR"][$row->kode] : 0);
              $umum_ralan = (isset($ralan["UMUM"][$row->kode]) ? $ralan["UMUM"][$row->kode] : 0);
              $bpjs_ralan = (isset($ralan["BPJS"][$row->kode]) ? $ralan["BPJS"][$row->kode] : 0);
              $prsh_ralan = (isset($ralan["PRSH"][$row->kode]) ? $ralan["PRSH"][$row->kode] : 0);
              $data[] = array(
                "tanggal" => date("Y-m-d"),
                "kode_poli" => $row->kode,
                "baru" => $baru_ralan,
                "lama" => $lama_ralan,
                "reguler" => $reguler_ralan,
                "eksekutif" => $eks_ralan,
                "dinas_a" => $dinas_a_ralan,
                "dinas_pur" => $dinas_pur_ralan,
                "umum" => $umum_ralan,
                "bpjs" => $bpjs_ralan,
                "prsh" => $prsh_ralan,
              );
          }
          $n = $this->db->get_where("rekap_pasienralan",["tanggal"=>date("Y-m-d")]);
          if ($n->num_rows()>0){
            $this->db->where("tanggal",date("Y-m-d"));
            $this->db->delete("rekap_pasienralan");
          }
          $this->db->insert_batch("rekap_pasienralan",$data);
          $data = array();
          $poli = $this->getpasien_poli2($tgl1,$tgl2);
          $igd = $this->getpasienigdinap($tgl1,$tgl2);
          $jumlah = (isset($poli["DINAS_A"]["0102030"]) ? $poli["DINAS_A"]["0102030"] : 0)+
                    (isset($poli["DINAS_PUR"]["0102030"]) ? $poli["DINAS_PUR"]["0102030"] : 0)+
                    (isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0)+
                    (isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0)+
                    (isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0);
          $baru_ralan = (isset($poli["BARU"]["0102030"]) ? $poli["BARU"]["0102030"] : 0);
          $lama_ralan = (isset($poli["LAMA"]["0102030"]) ? $poli["LAMA"]["0102030"] : 0);
          $reguler_ralan = (isset($poli["REGULER"]["0102030"]) ? $poli["REGULER"]["0102030"] : 0);
          $eksekutif_ralan = (isset($poli["EKSEKUTIF"]["0102030"]) ? $poli["EKSEKUTIF"]["0102030"] : 0);
          $dinas_a_ralan = (isset($poli["DINAS_A"]["0102030"]) ? $poli["DINAS_A"]["0102030"] : 0);
          $dinas_pur_ralan = (isset($poli["DINAS_PUR"]["0102030"]) ? $poli["DINAS_PUR"]["0102030"] : 0);
          $umum_ralan = (isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0);
          $bpjs_ralan = (isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0);
          $prsh_ralan = (isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0);

          $jumlah += (isset($igd["DINAS_A"]) ? $igd["DINAS_A"] : 0)+
                    (isset($igd["DINAS_PUR"]) ? $igd["DINAS_PUR"] : 0)+
                    (isset($igd["UMUM"]) ? $igd["UMUM"] : 0)+
                    (isset($igd["BPJS"]) ? $igd["BPJS"] : 0)+
                    (isset($igd["PRSH"]) ? $igd["PRSH"] : 0);
          $baru_inap = (isset($igd["BARU"]) ? $igd["BARU"] : 0);
          $lama_inap = (isset($igd["LAMA"]) ? $igd["LAMA"] : 0);
          $reguler_inap = (isset($igd["REGULER"]) ? $igd["REGULER"] : 0);
          $eksekutif_inap = (isset($igd["EKSEKUTIF"]) ? $igd["EKSEKUTIF"] : 0);
          $dinas_a_inap = (isset($igd["DINAS_A"]) ? $igd["DINAS_A"] : 0);
          $dinas_pur_inap = (isset($igd["DINAS_PUR"]) ? $igd["DINAS_PUR"] : 0);
          $umum_inap = (isset($igd["UMUM"]) ? $igd["UMUM"] : 0);
          $bpjs_inap = (isset($igd["BPJS"]) ? $igd["BPJS"] : 0);
          $prsh_inap = (isset($igd["PRSH"]) ? $igd["PRSH"] : 0);
          $data[] = array(
            "tanggal" => date("Y-m-d"),
            "baru_ralan" => $baru_ralan,
            "lama_ralan" => $lama_ralan,
            "reguler_ralan" => $reguler_ralan,
            "eksekutif_ralan" => $eksekutif_ralan,
            "dinas_a_ralan" => $dinas_a_ralan,
            "dinas_pur_ralan" => $dinas_pur_ralan,
            "umum_ralan" => $umum_ralan,
            "bpjs_ralan" => $bpjs_ralan,
            "prsh_ralan" => $prsh_ralan,
            "baru_inap" => $baru_inap,
            "lama_inap" => $lama_inap,
            "reguler_inap" => $reguler_inap,
            "eksekutif_inap" => $eksekutif_inap,
            "dinas_a_inap" => $dinas_a_inap,
            "dinas_pur_inap" => $dinas_pur_inap,
            "umum_inap" => $umum_inap,
            "bpjs_inap" => $bpjs_inap,
            "prsh_inap" => $prsh_inap,
          );
          $n = $this->db->get_where("rekap_igd",["tanggal"=>date("Y-m-d")]);
          if ($n->num_rows()>0){
            $this->db->where("tanggal",date("Y-m-d"));
            $this->db->delete("rekap_igd");
          }
          $this->db->insert_batch("rekap_igd",$data);
          $to = $this->gettindakan_full_rekap();
          $p = $this->rekap_ralan_full("all",$tgl1,$tgl2);
          $p_inap = $this->rekap_inap_full("all",$tgl1,$tgl2);
          foreach($to["kode"] as $data){
              $jml = isset($p["tindakan"][$data->kode]) ? $p["tindakan"][$data->kode] : 0;
              $jml_inap = isset($p_inap["tindakan"][$data->kode]) ? $p_inap["tindakan"][$data->kode] : 0;
              $jumlah_ralan = (isset($p["DINAS"][$data->kode]) ? $p["DINAS"][$data->kode] : 0)+
                        (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0)+
                        (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0)+
                        (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
              $dinas_a_ralan += (isset($p["DINAS_A"][$data->kode]) ? $p["DINAS_A"][$data->kode] : 0);
              $dinas_pur_ralan += (isset($p["DINAS_PUR"][$data->kode]) ? $p["DINAS_PUR"][$data->kode] : 0);
              $umum_ralan += (isset($p["UMUM"][$data->kode]) ? $p["UMUM"][$data->kode] : 0);
              $bpjs_ralan += (isset($p["BPJS"][$data->kode]) ? $p["BPJS"][$data->kode] : 0);
              $prsh_ralan += (isset($p["PRSH"][$data->kode]) ? $p["PRSH"][$data->kode] : 0);
              $jumlah_inap = (isset($p_inap["DINAS"][$data->kode]) ? $p_inap["DINAS"][$data->kode] : 0)+
                        (isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0)+
                        (isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0)+
                        (isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0);
              $dinas_a_inap += (isset($p_inap["DINAS_A"][$data->kode]) ? $p_inap["DINAS_A"][$data->kode] : 0);
              $dinas_pur_inap += (isset($p_inap["DINAS_PUR"][$data->kode]) ? $p_inap["DINAS_PUR"][$data->kode] : 0);
              $umum_inap += (isset($p_inap["UMUM"][$data->kode]) ? $p_inap["UMUM"][$data->kode] : 0);
              $bpjs_inap += (isset($p_inap["BPJS"][$data->kode]) ? $p_inap["BPJS"][$data->kode] : 0);
              $prsh_inap += (isset($p_inap["PRSH"][$data->kode]) ? $p_inap["PRSH"][$data->kode] : 0);
          }
          $data = array();
          $data[] = array(
            "tanggal" => date("Y-m-d"),
            "kode_tindakan" => $data->kode,
            "dinas_a_ralan" => $dinas_a_ralan,
            "dinas_pur_ralan" => $dinas_pur_ralan,
            "umum_ralan" => $umum_ralan,
            "bpjs_ralan" => $bpjs_ralan,
            "prsh_ralan" => $prsh_ralan,
            "dinas_a_inap" => $dinas_a_inap,
            "dinas_pur_inap" => $dinas_pur_inap,
            "umum_inap" => $umum_inap,
            "bpjs_inap" => $bpjs_inap,
            "prsh_inap" => $prsh_inap,
          );
          $n = $this->db->get_where("rekap_kamarbedah",["tanggal"=>date("Y-m-d")]);
          if ($n->num_rows()>0){
            $this->db->where("tanggal",date("Y-m-d"));
            $this->db->delete("rekap_kamarbedah");
          }
          $this->db->insert_batch("rekap_kamarbedah",$data);

          $ph = $this->rekap_ralan_full("0102026",$tgl1,$tgl2);
          $ph_inap = $this->rekap_inap_full("hdl",$tgl1,$tgl2);
          $th = $this->gettarif_inap();
          $baru_ralan = $lama_ralan = $dr_ralan = $manual_ralan = $dinas_a_ralan = $dinas_pur_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan =
          $dr_inap = $manual_inap = $dinas_a_inap = $dinas_pur_inap = $umum_inap = $bpjs_inap = $prsh_inap = 0;
          $data = array();
          foreach($th->result() as $row){
              $jml = isset($ph["tindakan"]["0102026"]) ? $ph["tindakan"]["0102026"] : 0;
              $jml_inap = isset($ph_inap["tindakan"][$row->kode_tindakan]) ? $ph_inap["tindakan"][$row->kode_tindakan] : 0;
              $jumlah_ralan = (isset($ph["DINAS"]["0102026"]) ? $ph["DINAS"]["0102026"] : 0)+
                        (isset($ph["UMUM"]["0102026"]) ? $ph["UMUM"]["0102026"] : 0)+
                        (isset($ph["BPJS"]["0102026"]) ? $ph["BPJS"]["0102026"] : 0)+
                        (isset($ph["PRSH"]["0102026"]) ? $ph["PRSH"]["0102026"] : 0);
              $baru_ralan = (isset($ph["BARU"]["0102026"]) ? $ph["BARU"]["0102026"] : 0);
              $lama_ralan = (isset($ph["LAMA"]["0102026"]) ? $ph["LAMA"]["0102026"] : 0);
              $dinas_a_ralan = (isset($ph["DINAS_A"]["0102026"]) ? $ph["DINAS_A"]["0102026"] : 0);
              $dinas_pur_ralan = (isset($ph["DINAS_PUR"]["0102026"]) ? $ph["DINAS_PUR"]["0102026"] : 0);
              $umum_ralan = (isset($ph["UMUM"]["0102026"]) ? $ph["UMUM"]["0102026"] : 0);
              $bpjs_ralan = (isset($ph["BPJS"]["0102026"]) ? $ph["BPJS"]["0102026"] : 0);
              $prsh_ralan = (isset($ph["PRSH"]["0102026"]) ? $ph["PRSH"]["0102026"] : 0);
              $jumlah_inap = (isset($ph_inap["DINAS"][$row->kode_tindakan]) ? $ph_inap["DINAS"][$row->kode_tindakan] : 0)+
                        (isset($ph_inap["UMUM"][$row->kode_tindakan]) ? $ph_inap["UMUM"][$row->kode_tindakan] : 0)+
                        (isset($ph_inap["BPJS"][$row->kode_tindakan]) ? $ph_inap["BPJS"][$row->kode_tindakan] : 0)+
                        (isset($ph_inap["PRSH"][$row->kode_tindakan]) ? $ph_inap["PRSH"][$row->kode_tindakan] : 0);
              $dinas_a_inap = (isset($ph_inap["DINAS_A"][$row->kode_tindakan]) ? $ph_inap["DINAS_A"][$row->kode_tindakan] : 0);
              $dinas_pur_inap = (isset($ph_inap["DINAS_PUR"][$row->kode_tindakan]) ? $ph_inap["DINAS_PUR"][$row->kode_tindakan] : 0);
              $umum_inap = (isset($ph_inap["UMUM"][$row->kode_tindakan]) ? $ph_inap["UMUM"][$row->kode_tindakan] : 0);
              $bpjs_inap = (isset($ph_inap["BPJS"][$row->kode_tindakan]) ? $ph_inap["BPJS"][$row->kode_tindakan] : 0);
              $prsh_inap = (isset($ph_inap["PRSH"][$row->kode_tindakan]) ? $ph_inap["PRSH"][$row->kode_tindakan] : 0);
              $data[] = array(
                "tanggal" => date("Y-m-d"),
                "baru_ralan" => $baru_ralan,
                "lama_ralan" => $lama_ralan,
                "dinas_a_ralan" => $dinas_a_ralan,
                "dinas_pur_ralan" => $dinas_pur_ralan,
                "umum_ralan" => $umum_ralan,
                "bpjs_ralan" => $bpjs_ralan,
                "prsh_ralan" => $prsh_ralan,
                "dinas_a_inap" => $dinas_a_inap,
                "dinas_pur_inap" => $dinas_pur_inap,
                "umum_inap" => $umum_inap,
                "bpjs_inap" => $bpjs_inap,
                "prsh_inap" => $prsh_inap,
              );
          }
          $n = $this->db->get_where("rekap_haemodialisa",["tanggal"=>date("Y-m-d")]);
          if ($n->num_rows()>0){
            $this->db->where("tanggal",date("Y-m-d"));
            $this->db->delete("rekap_haemodialisa");
          }
          $this->db->insert_batch("rekap_haemodialisa",$data);
        }
    }
?>
