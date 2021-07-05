<?php
class Tracer extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->Model('Mtracer');
  }
  function index(){
    $this->load->view('vtracer');
  }
  function getjob(){
    $d = $this->Mtracer->getjob();
    echo json_encode($d);
    if ($d["status"]>0) $no_reg = $d["data"]->no_reg; else $no_reg = "";
    $this->Mtracer->getdone($no_reg);
  }
  function getkamar(){
    $data = "20337";
    $secretKey = "4tW3926623";
    date_default_timezone_set('UTC');
    $url = "https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/read/1019R002/1/100";
    $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
    $encodedSignature = base64_encode($signature);
    $curl = curl_init();
    $header = array(
      "X-cons-id : ".$data.",
      X-signature : ".$encodedSignature.",
      X-timestamp : ".$tStamp.",
      Content-Type: Application/x-www-form-urlencoded",
    );
    # $json = json_encode($arr);
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      # CURLOPT_POST => true,
      # CURLOPT_POSTFIELDS => $json,
      CURLOPT_HTTPHEADER => array(
        "Accept: */*",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "X-cons-id: ".$data." ",
        "X-signature: ".$encodedSignature." ",
        "X-timestamp: ".$tStamp." ",
        "Content-Type: Application/x-www-form-urlencoded ",
        "cache-control: no-cache",
      ),
    ));
    $response = curl_exec($curl);
    $msg = json_decode($response,true);
    $html = "";
    foreach ($msg["response"]["list"] as $key => $value){
      $html .= "<ul>";
      foreach ($value as $key1 => $value1){
        $html .= "<li>".$key1." => ".$value1."</li>";
      }
      $html .= "</ul>";
    }
    echo $html;
  }
  function hapuskamar($kelas,$ruang){
    $data = "20337";
    $secretKey = "4tW3926623";
    date_default_timezone_set('UTC');
    $url = "https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/delete/1019R002";
    $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
    $encodedSignature = base64_encode($signature);
    $curl = curl_init();
    $header = array(
      "X-cons-id : ".$data.",
      X-signature : ".$encodedSignature.",
      X-timestamp : ".$tStamp.",
      Content-Type: Application/x-www-form-urlencoded",
    );
    $arr = array("kodekelas" =>$kelas,"koderuang" => $ruang);
    $json = json_encode($arr);
    $encodedSignature = base64_encode($signature);

    $ch = curl_init();
    $headers = array(
      'X-cons-id: '.$data .'',
      'X-timestamp: '.$tStamp.'' ,
      'X-signature: '.$encodedSignature.'',
      'Content-Type: Application/JSON',
      'Accept: Application/JSON'
    );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    var_dump ($content);
  }
  function updatekamar(){
    $data = "20337";
    $secretKey = "4tW3926623";
    date_default_timezone_set('UTC');
    $url = "https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/1019R002";
    $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
    $encodedSignature = base64_encode($signature);
    $curl = curl_init();
    $header = array(
      "X-cons-id : ".$data.",
      X-signature : ".$encodedSignature.",
      X-timestamp : ".$tStamp.",
      Content-Type: Application/x-www-form-urlencoded",
    );
    $this->db->select("k.kode_ruangan,r.nama_ruangan,kl.kode_kelas,kl.kode_kelas_bpjs2,count(*) as kapasitas");
    $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
    $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
    $this->db->group_by("k.kode_ruangan,kl.kode_kelas_bpjs2");
    $q = $this->db->get("kamar k");
    foreach ($q->result() as $row){
      $this->db->where("k.kode_ruangan",$row->kode_ruangan);
      $this->db->where("kl.kode_kelas_bpjs2",$row->kode_kelas_bpjs2);
      $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
      $this->db->where("k.status_kamar","KOSONG");
      $n = $this->db->get("kamar k");
      $tersedia = $n->num_rows();
      $arr = array(
        "kodekelas"=>$row->kode_kelas_bpjs2,
        "koderuang"=>$row->kode_ruangan,
        "namaruang"=>$row->nama_ruangan,
        "kapasitas"=>$row->kapasitas,
        "tersedia"=>$tersedia,
        "tersediapria"=>"0",
        "tersediawanita"=>"0",
        "tersediapriawanita"=>$row->kapasitas,
      );
      $json = json_encode($arr);
      $encodedSignature = base64_encode($signature);
      $ch = curl_init();
      $headers = array(
        'X-cons-id: '.$data .'',
        'X-timestamp: '.$tStamp.'' ,
        'X-signature: '.$encodedSignature.'',
        'Content-Type: Application/JSON',
        'Accept: Application/JSON'
      );
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $content = curl_exec($ch);
      $err = curl_error($ch);
      var_dump ($content);
    }
  }
  function createkamar(){
    $data = "20337";
    $secretKey = "4tW3926623";
    date_default_timezone_set('UTC');
    $url = "https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/create/1019R002";
    $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
    $encodedSignature = base64_encode($signature);
    $ch = curl_init();
    $header = array(
      "X-cons-id : ".$data.",
      X-signature : ".$encodedSignature.",
      X-timestamp : ".$tStamp.",
      Content-Type: Application/x-www-form-urlencoded",
    );
    $this->db->select("k.kode_ruangan,r.nama_ruangan,k.kode_kelas_bpjs2,count(*) as kapasitas");
    $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
    // $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
    $this->db->group_by("k.kode_ruangan,k.kode_kelas_bpjs2");
    // $this->db->where("k.kode_ruangan","15");
    $q = $this->db->get("kamar k");
    foreach ($q->result() as $row){
      $arr = array(
        "kodekelas"=>$row->kode_kelas_bpjs2,
        "koderuang"=>$row->kode_ruangan,
        "namaruang"=>$row->nama_ruangan,
        "kapasitas"=>$row->kapasitas,
        "tersedia"=>"0",
        "tersediapria"=>"0",
        "tersediawanita"=>"0",
        "tersediapriawanita"=>"0"
      );
      $json = json_encode($arr);
      $headers = array(
        'X-cons-id: '.$data .'',
        'X-timestamp: '.$tStamp.'' ,
        'X-signature: '.$encodedSignature.'',
        'Content-Type: Application/JSON',
        'Accept: Application/JSON'
      );
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $content = curl_exec($ch);
      $err = curl_error($ch);
      // curl_close($ch);
      var_dump ($content);
    }
  }
  function rekap_radiologi(){
    $data = array();
    $tgl1 = date("Y-m-d");
    $tgl2 = date("Y-m-d");
    $this->db->select("k.kode_tarif,k.asal,p.status_pasien,p.jenis,p.gol_pasien,k.jam_radiologi");
    $this->db->where("layan!=",2);
    $this->db->like("k.kode_tarif","R",'after');
    $this->db->where("date(p.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
    $this->db->where("date(p.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
    $this->db->join("kasir k","k.no_reg=p.no_reg","inner");
    $sql = $this->db->get("pasien_ralan p");
    foreach ($sql->result() as $key) {
      if (isset($data["tindakan"][$key->kode_tarif]))
      $data["tindakan"][$key->kode_tarif] += 1;
      else
      $data["tindakan"][$key->kode_tarif] = 1;
      if ($key->jenis=="R"){
        if (isset($data["REGULER"][$key->kode_tarif]))
        $data["REGULER"][$key->kode_tarif] += 1;
        else
        $data["REGULER"][$key->kode_tarif] = 1;
      } else
      if ($key->jenis=="E"){
        if (isset($data["EKSEKUTIF"][$key->kode_tarif]))
        $data["EKSEKUTIF"][$key->kode_tarif] += 1;
        else
        $data["EKSEKUTIF"][$key->kode_tarif] = 1;
      }
      if ($key->status_pasien=="BARU"){
        if (isset($data["BARU"][$key->kode_tarif]))
        $data["BARU"][$key->kode_tarif] += 1;
        else
        $data["BARU"][$key->kode_tarif] = 1;
      } else
      if ($key->status_pasien=="LAMA"){
        if (isset($data["LAMA"][$key->kode_tarif]))
        $data["LAMA"][$key->kode_tarif] += 1;
        else
        $data["LAMA"][$key->kode_tarif] = 1;
      }
      if ($key->jam_radiologi!="0000-00-00 00:00:00"){
        if (isset($data["EKS"][$key->kode_tarif]))
        $data["EKS"][$key->kode_tarif] += 1;
        else
        $data["EKS"][$key->kode_tarif] = 1;
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
      if (($key->gol_pasien>=404 && $key->gol_pasien<=410) || ($key->gol_pasien>=415 && $key->gol_pasien<=417) || ($key->gol_pasien==3133)){
        if (isset($data["DINAS"][$key->kode_tarif]))
        $data["DINAS"][$key->kode_tarif] += 1;
        else
        $data["DINAS"][$key->kode_tarif] = 1;
      } else
      if ($key->gol_pasien==11){
        if (isset($data["UMUM"][$key->kode_tarif]))
        $data["UMUM"][$key->kode_tarif] += 1;
        else
        $data["UMUM"][$key->kode_tarif] = 1;
      } else
      if (($key->gol_pasien>=400 && $key->gol_pasien<=403) || ($key->gol_pasien>=411 && $key->gol_pasien<=414) || ($key->gol_pasien>=418 && $key->gol_pasien<=420)){
        if (isset($data["BPJS"][$key->kode_tarif]))
        $data["BPJS"][$key->kode_tarif] += 1;
        else
        $data["BPJS"][$key->kode_tarif] = 1;
      } else
      if (($key->gol_pasien==12) || ($key->gol_pasien==13) || ($key->gol_pasien>=16 && $key->gol_pasien<=18)){
        if (isset($data["PRSH"][$key->kode_tarif]))
        $data["PRSH"][$key->kode_tarif] += 1;
        else
        $data["PRSH"][$key->kode_tarif] = 1;
      }
    }
    $list = array();
    foreach ($data["tindakan"] as $key => $value) {
      $n = $this->db->get_where("rekap_radiologi",["tanggal"=>$tgl1,"kode_tindakan"=>$key]);
      $list = array(
        "tanggal" => date("Y-m-d",strtotime($tgl1)),
        "kode_tindakan" => $key,
        "asaldr_ralan" => (isset($data["DR"][$key]) ? $data["DR"][$key] : 0),
        "asalmanual_ralan" => (isset($data["MANUAL"][$key]) ? $data["MANUAL"][$key] : 0),
        "ekspertisi_ralan" => (isset($data["EKS"][$key]) ? $data["EKS"][$key] : 0),
        "dinas_ralan" => (isset($data["DINAS"][$key]) ? $data["DINAS"][$key] : 0),
        "umum_ralan" => (isset($data["UMUM"][$key]) ? $data["UMUM"][$key] : 0),
        "bpjs_ralan" => (isset($data["BPJS"][$key]) ? $data["BPJS"][$key] : 0),
        "prsh_ralan" => (isset($data["PRSH"][$key]) ? $data["PRSH"][$key] : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_radiologi",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("kode_tindakan",$key);
        $this->db->update("rekap_radiologi",$list);
      }
    }
    $data = array();
    $this->db->select("k.kode_tarif,k.asal,pa.id_gol,k.jam_radiologi");
    $this->db->like("k.kode_tarif","R",'after');
    $this->db->where("date(k.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
    $this->db->where("date(k.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
    $this->db->join("kasir_inap k","k.no_reg=p.no_reg","inner");
    $this->db->join("pasien pa","pa.no_pasien = p.no_rm","left");
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
      if ($key->jam_radiologi!="0000-00-00 00:00:00"){
        if (isset($data["PEMERIKSAAN"][$key->kode_tarif]))
        $data["PEMERIKSAAN"][$key->kode_tarif] += 1;
        else
        $data["PEMERIKSAAN"][$key->kode_tarif] = 1;
      }
    }
    $list = array();
    foreach ($data["tindakan"] as $key => $value) {
      $n = $this->db->get_where("rekap_radiologi",["tanggal"=>$tgl1,"kode_tindakan"=>$key]);
      $list = array(
        "tanggal" => date("Y-m-d",strtotime($tgl1)),
        "kode_tindakan" => $key,
        "asaldr_inap" => (isset($data["DR"][$key]) ? $data["DR"][$key] : 0),
        "asalmanual_inap" => (isset($data["MANUAL"][$key]) ? $data["MANUAL"][$key] : 0),
        "ekspertisi_inap" => (isset($data["PEMERIKSAAN"][$key]) ? $data["PEMERIKSAAN"][$key] : 0),
        "dinas_inap" => (isset($data["DINAS"][$key]) ? $data["DINAS"][$key] : 0),
        "umum_inap" => (isset($data["UMUM"][$key]) ? $data["UMUM"][$key] : 0),
        "bpjs_inap" => (isset($data["BPJS"][$key]) ? $data["BPJS"][$key] : 0),
        "prsh_inap" => (isset($data["PRSH"][$key]) ? $data["PRSH"][$key] : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_radiologi",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("kode_tindakan",$key);
        $this->db->update("rekap_radiologi",$list);
      }
    }
  }
  function rekap_lab(){
    $data = array();
    $tgl1 = date("Y-m-d");
    $tgl2 = date("Y-m-d");
    $this->db->select("k.metode_swab,k.no_reg,k.kode_tarif,k.asal,p.status_pasien,p.jenis,p.gol_pasien,k.jam_lab");
    $this->db->where("layan!=",2);
    $this->db->like("k.kode_tarif","L",'after');
    $this->db->where("date(p.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
    $this->db->where("date(p.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
    $this->db->join("kasir k","k.no_reg=p.no_reg","inner");
    $sql = $this->db->get("pasien_ralan p");
    foreach ($sql->result() as $key) {
      if ($key->kode_tarif=="L158" || $key->kode_tarif=="L160" || $key->kode_tarif=="L047"){
          $s = $this->db->get_where("ekspertisi_lab",["no_reg"=>$key->no_reg,"kode_tindakan"=>$key->kode_tarif]);
          if ($s->num_rows()>0){
            $srow = $s->row();
            $hasil = $srow->hasil;
            if (strtolower($hasil)=="reaktif") $hasil = "positif";
            if (strtolower($hasil)=="non reaktif") $hasil = "negatif";
            if (isset($data[strtolower($hasil)][$key->kode_tarif]))
            $data[strtolower($hasil)][$key->kode_tarif] += 1;
            else
            $data[strtolower($hasil)][$key->kode_tarif] = 1;
          }
      }
      if (isset($data["tindakan"][$key->kode_tarif]))
      $data["tindakan"][$key->kode_tarif] += 1;
      else
      $data["tindakan"][$key->kode_tarif] = 1;
      if ($key->jenis=="R"){
        if (isset($data["REGULER"][$key->kode_tarif]))
        $data["REGULER"][$key->kode_tarif] += 1;
        else
        $data["REGULER"][$key->kode_tarif] = 1;
      } else
      if ($key->jenis=="E"){
        if (isset($data["EKSEKUTIF"][$key->kode_tarif]))
        $data["EKSEKUTIF"][$key->kode_tarif] += 1;
        else
        $data["EKSEKUTIF"][$key->kode_tarif] = 1;
      }
      if ($key->status_pasien=="BARU"){
        if (isset($data["BARU"][$key->kode_tarif]))
        $data["BARU"][$key->kode_tarif] += 1;
        else
        $data["BARU"][$key->kode_tarif] = 1;
      } else
      if ($key->status_pasien=="LAMA"){
        if (isset($data["LAMA"][$key->kode_tarif]))
        $data["LAMA"][$key->kode_tarif] += 1;
        else
        $data["LAMA"][$key->kode_tarif] = 1;
      }
      if ($key->jam_lab!="0000-00-00 00:00:00"){
        if (isset($data["EKS"][$key->kode_tarif]))
        $data["EKS"][$key->kode_tarif] += 1;
        else
        $data["EKS"][$key->kode_tarif] = 1;
      } else {
        if ($key->kode_tarif=="L158" || $key->kode_tarif=="160"){
          if ($key->metode_swab!=""){
            if (isset($data["EKS"][$key->kode_tarif]))
            $data["EKS"][$key->kode_tarif] += 1;
            else
            $data["EKS"][$key->kode_tarif] = 1;
          }
        }
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
      if (($key->gol_pasien>=404 && $key->gol_pasien<=410) || ($key->gol_pasien>=415 && $key->gol_pasien<=417) || ($key->gol_pasien==3133)){
        if (isset($data["DINAS"][$key->kode_tarif]))
        $data["DINAS"][$key->kode_tarif] += 1;
        else
        $data["DINAS"][$key->kode_tarif] = 1;
      } else
      if ($key->gol_pasien==11){
        if (isset($data["UMUM"][$key->kode_tarif]))
        $data["UMUM"][$key->kode_tarif] += 1;
        else
        $data["UMUM"][$key->kode_tarif] = 1;
      } else
      if (($key->gol_pasien>=400 && $key->gol_pasien<=403) || ($key->gol_pasien>=411 && $key->gol_pasien<=414) || ($key->gol_pasien>=418 && $key->gol_pasien<=420)){
        if (isset($data["BPJS"][$key->kode_tarif]))
        $data["BPJS"][$key->kode_tarif] += 1;
        else
        $data["BPJS"][$key->kode_tarif] = 1;
      } else
      if (($key->gol_pasien==12) || ($key->gol_pasien==13) || ($key->gol_pasien>=16 && $key->gol_pasien<=18)){
        if (isset($data["PRSH"][$key->kode_tarif]))
        $data["PRSH"][$key->kode_tarif] += 1;
        else
        $data["PRSH"][$key->kode_tarif] = 1;
      }
    }
    $list = array();
    foreach ($data["tindakan"] as $key => $value) {
      $n = $this->db->get_where("rekap_lab",["tanggal"=>$tgl1,"kode_tindakan"=>$key]);
      $list = array(
        "tanggal" => date("Y-m-d",strtotime($tgl1)),
        "kode_tindakan" => $key,
        "ekspertisi_ralan" => (isset($data["EKS"][$key]) ? $data["EKS"][$key] : 0),
        "dinas_ralan" => (isset($data["DINAS"][$key]) ? $data["DINAS"][$key] : 0),
        "umum_ralan" => (isset($data["UMUM"][$key]) ? $data["UMUM"][$key] : 0),
        "bpjs_ralan" => (isset($data["BPJS"][$key]) ? $data["BPJS"][$key] : 0),
        "prsh_ralan" => (isset($data["PRSH"][$key]) ? $data["PRSH"][$key] : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_lab",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("kode_tindakan",$key);
        $this->db->update("rekap_lab",$list);
      }
    }
    $data = array();
    $this->db->select("k.metode_swab,k.no_reg,k.kode_tarif,k.asal,pa.id_gol,k.jam_lab");
    $this->db->like("k.kode_tarif","L",'after');
    $this->db->where("date(k.tanggal)>=",date("Y-m-d",strtotime($tgl1)));
    $this->db->where("date(k.tanggal)<=",date("Y-m-d",strtotime($tgl2)));
    $this->db->join("kasir_inap k","k.no_reg=p.no_reg","inner");
    $this->db->join("pasien pa","pa.no_pasien = p.no_rm","left");
    $sql = $this->db->get("pasien_inap p");
    foreach ($sql->result() as $key) {
      if ($key->kode_tarif=="L158" || $key->kode_tarif=="L160" || $key->kode_tarif=="L047"){
          $s = $this->db->get_where("ekspertisi_labinap",["no_reg"=>$key->no_reg,"kode_tindakan"=>$key->kode_tarif]);
          if ($s->num_rows()>0){
            $srow = $s->row();
            $hasil = $srow->hasil;
            if (strtolower($hasil)=="reaktif" || strpos(strtolower($hasil),"positif")!==false ) $hasil = "positif";
            if (strtolower($hasil)=="non reaktif" || strpos(strtolower($hasil),"negatif")!==false) $hasil = "negatif";
            if (strtolower($hasil)=="") $hasil = "kosong";
            if (isset($data[strtolower($hasil)][$key->kode_tarif]))
            $data[strtolower($hasil)][$key->kode_tarif] += 1;
            else
            $data[strtolower($hasil)][$key->kode_tarif] = 1;
          }
      }
      if (isset($data["tindakan"][$key->kode_tarif]))
      $data["tindakan"][$key->kode_tarif] += 1;
      else
      $data["tindakan"][$key->kode_tarif] = 1;

      if (($key->id_gol>=404 && $key->id_gol<=410) || ($key->id_gol>=415 && $key->id_gol<=417) || ($key->id_gol==3133)){
        if (isset($data["DINAS"][$key->kode_tarif]))
        $data["DINAS"][$key->kode_tarif] += 1;
        else
        $data["DINAS"][$key->kode_tarif] = 1;
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
      if ($key->kode_tarif=="L158" || $key->kode_tarif=="160"){
        if ($key->jam_lab!="0000-00-00 00:00:00" && $key->metode_swab!=""){
          if (isset($data["PEMERIKSAAN"][$key->kode_tarif]))
          $data["PEMERIKSAAN"][$key->kode_tarif] += 1;
          else
          $data["PEMERIKSAAN"][$key->kode_tarif] = 1;
        }
      } else {
        if ($key->jam_lab!="0000-00-00 00:00:00"){
          if (isset($data["PEMERIKSAAN"][$key->kode_tarif]))
          $data["PEMERIKSAAN"][$key->kode_tarif] += 1;
          else
          $data["PEMERIKSAAN"][$key->kode_tarif] = 1;
        }
      }
    }
    $list = array();
    foreach ($data["tindakan"] as $key => $value) {
      $n = $this->db->get_where("rekap_lab",["tanggal"=>$tgl1,"kode_tindakan"=>$key]);
      $list = array(
        "tanggal" => date("Y-m-d",strtotime($tgl1)),
        "kode_tindakan" => $key,
        "ekspertisi_inap" => (isset($data["PEMERIKSAAN"][$key]) ? $data["PEMERIKSAAN"][$key] : 0),
        "dinas_inap" => (isset($data["DINAS"][$key]) ? $data["DINAS"][$key] : 0),
        "umum_inap" => (isset($data["UMUM"][$key]) ? $data["UMUM"][$key] : 0),
        "bpjs_inap" => (isset($data["BPJS"][$key]) ? $data["BPJS"][$key] : 0),
        "prsh_inap" => (isset($data["PRSH"][$key]) ? $data["PRSH"][$key] : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_lab",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d",strtotime($tgl1)));
        $this->db->where("kode_tindakan",$key);
        $this->db->update("rekap_lab",$list);
      }
    }
  }
  function rekap_bedmapping(){
    $this->db->select("r.kode_ruangan_a,kl.kode_kelas_bpjs,kl.kode_kelas_dashboard,k.no_bed,count(*) as bed");
    $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
    $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
    $this->db->group_by("r.kode_ruangan_a,kode_kelas_dashboard");
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
    $this->db->where("k.status_kamar","KOSONG");
    $q = $this->db->get("kamar k");
    foreach ($q->result() as $key) {
        $data[$key->kode_ruangan_a][$key->kode_kelas_dashboard]["C"] = $key->bed;
        if (isset($data["kelas"][$key->kode_kelas_dashboard]['C']))
            $data["kelas"][$key->kode_kelas_dashboard]['C'] += $key->bed;
        else
            $data["kelas"][$key->kode_kelas_dashboard]['C'] = $key->bed;
    }
    foreach ($data["ruang"] as $key => $value) {
        $r = $this->db->get_where("rekap_bedmapping",["tanggal"=>date("Y-m-d"),"kode_ruangan"=>$key]);
        if ($r->num_rows()<=0){
          $list = array("tanggal"=>date("Y-m-d"),"kode_ruangan"=>$key);
          $this->db->insert("rekap_bedmapping",$list);
        }
        foreach ($data[$key] as $kelas => $val) {
          foreach ($val as $abj => $bed) {
            $l = array(
              $kelas."_".strtolower($abj) => $bed
            );
            $this->db->where("tanggal",date("Y-m-d"));
            $this->db->where("kode_ruangan",$key);
            $this->db->update("rekap_bedmapping",$l);
          }
        }
    }
  }
  function rekap_pasienranap(){
    $data = array();
    $this->db->select("p2.id_gol,r.kode_ruangan_a,count(*) as jumlah,gp.jenis as jenis");
    $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
    $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
    $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
    $this->db->where("isnull(tgl_keluar)",1);
    $this->db->group_by("p2.id_gol,r.kode_ruangan_a");
    $p = $this->db->get("pasien_inap p2");
    foreach ($p->result() as $key) {
        if ($key->jenis=="DINAS"){
            if (isset($data["DINAS"][$key->kode_ruangan_a]))
                $data["DINAS"][$key->kode_ruangan_a] += $key->jumlah;
            else
                $data["DINAS"][$key->kode_ruangan_a] =  $key->jumlah;
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
    }
    $now = date("Y-m-d");
    $this->db->select("r.kode_ruangan_a,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
    $this->db->join("ruangan r","r.kode_ruangan=p2.kode_ruangan","inner");
    $this->db->where("isnull(tgl_keluar)",1);
    $p = $this->db->get("pasien_inap p2");
    foreach ($p->result() as $key) {
      if (isset($data["HP"][$key->kode_ruangan_a]))
          $data["HP"][$key->kode_ruangan_a] += $key->hp;
      else
          $data["HP"][$key->kode_ruangan_a] =  $key->hp;
    }
    $list = array();
    $this->db->select("r.kode_ruangan_a,k.kode_ruangan,r.nama_ruangan,kl.nama_kelas,k.kode_kelas,count(*) as bed");
    $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
    $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
    $this->db->group_by("r.kode_ruangan_a");
    $this->db->order_by("k.kode_ruangan,r.nama_ruangan");
    $r = $this->db->get("kamar k");
    foreach ($r->result() as $row) {
      $n = $this->db->get_where("rekap_pasienranap",["tanggal"=>date("Y-m-d"),"kode_ruangan"=>$row->kode_ruangan_a]);
      $dinas = (isset($data["DINAS"][$row->kode_ruangan_a]) ? $data["DINAS"][$row->kode_ruangan_a] : 0);
      $umum = (isset($data["UMUM"][$row->kode_ruangan_a]) ? $data["UMUM"][$row->kode_ruangan_a] : 0);
      $bpjs = (isset($data["BPJS"][$row->kode_ruangan_a]) ? $data["BPJS"][$row->kode_ruangan_a] : 0);
      $prsh = (isset($data["PRSH"][$row->kode_ruangan_a]) ? $data["PRSH"][$row->kode_ruangan_a] : 0);
      $bed = $row->bed;
      $list = array(
        "tanggal" => date("Y-m-d"),
        "kode_ruangan" => $row->kode_ruangan_a,
        "tt" => $row->bed,
        "dinas" => (isset($data["DINAS"][$row->kode_ruangan_a]) ? $data["DINAS"][$row->kode_ruangan_a] : 0),
        "umum" => (isset($data["UMUM"][$row->kode_ruangan_a]) ? $data["UMUM"][$row->kode_ruangan_a] : 0),
        "bpjs" => (isset($data["BPJS"][$row->kode_ruangan_a]) ? $data["BPJS"][$row->kode_ruangan_a] : 0),
        "prsh" => (isset($data["PRSH"][$row->kode_ruangan_a]) ? $data["PRSH"][$row->kode_ruangan_a] : 0),
        "hari_perawatan" =>(isset($data["HP"][$row->kode_ruangan_a]) ? $data["HP"][$row->kode_ruangan_a] : 0),
        "bor" => ($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_pasienranap",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d"));
        $this->db->where("kode_ruangan",$row->kode_ruangan_a);
        $this->db->update("rekap_pasienranap",$list);
      }
    }
  }
  function rekap_pasienranap_kelas(){
    $data = array();
    $this->db->select("p2.id_gol,r.kode_kelas_dashboard,count(*) as jumlah,gp.jenis as jenis");
    $this->db->join("kelas r","r.kode_kelas=p2.kode_kelas","inner");
    $this->db->join("pasien p1","p1.no_pasien=p2.no_rm","inner");
    $this->db->join("gol_pasien gp","gp.id_gol=p2.id_gol");
    $this->db->where("isnull(tgl_keluar)",1);
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
    }
    $now = date("Y-m-d");
    $this->db->select("r.kode_kelas_dashboard,(TIMESTAMPDIFF(DAY,p2.tgl_masuk,'".$now."')+1) AS hp");
    $this->db->join("kelas r","r.kode_kelas=p2.kode_kelas","inner");
    $this->db->where("isnull(tgl_keluar)",1);
    $p = $this->db->get("pasien_inap p2");
    foreach ($p->result() as $key) {
      if (isset($data["HP"][$key->kode_kelas_dashboard]))
          $data["HP"][$key->kode_kelas_dashboard] += $key->hp;
      else
          $data["HP"][$key->kode_kelas_dashboard] =  $key->hp;
    }
    $this->db->select(" COUNT(kamar.kode_kelas) AS bed, kelas.kode_kelas_dashboard as kode_kelas_dashboard");
    $this->db->join("kamar","kamar.kode_kelas=kelas.kode_kelas","left");
    $this->db->group_by("kelas.kode_kelas_dashboard");
    $this->db->order_by("kelas.kode_kelas");
    $k = $this->db->get("kelas");
    foreach ($k->result() as $row) {
      $n = $this->db->get_where("rekap_pasienranap_kelas",["tanggal"=>date("Y-m-d"),"kode_kelas"=>$row->kode_kelas_dashboard]);
      $dinas = (isset($data["DINAS"][$row->kode_kelas_dashboard]) ? $data["DINAS"][$row->kode_kelas_dashboard] : 0);
      $umum = (isset($data["UMUM"][$row->kode_kelas_dashboard]) ? $data["UMUM"][$row->kode_kelas_dashboard] : 0);
      $bpjs = (isset($data["BPJS"][$row->kode_kelas_dashboard]) ? $data["BPJS"][$row->kode_kelas_dashboard] : 0);
      $prsh = (isset($data["PRSH"][$row->kode_kelas_dashboard]) ? $data["PRSH"][$row->kode_kelas_dashboard] : 0);
      $bed = $row->bed;
      $list = array(
        "tanggal" => date("Y-m-d"),
        "kode_kelas" => $row->kode_kelas_dashboard,
        "tt" => $row->bed,
        "dinas" => $dinas,
        "umum" => $umum,
        "bpjs" => $bpjs,
        "prsh" => $prsh,
        "hari_perawatan" =>(isset($data["HP"][$row->kode_kelas_dashboard]) ? $data["HP"][$row->kode_kelas_dashboard] : 0),
        "bor" => ($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_pasienranap_kelas",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d"));
        $this->db->where("kode_kelas",$row->kode_kelas_dashboard);
        $this->db->update("rekap_pasienranap_kelas",$list);
      }
    }
  }
  function rekap_pasienpulang(){
    $tgl1 = date("Y-m-d");
    $tgl2 = date("Y-m-d");
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
    $list = array();
    $this->db->select("r.kode_ruangan_a,k.kode_ruangan,r.nama_ruangan,kl.nama_kelas,k.kode_kelas,count(*) as bed");
    $this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
    $this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
    $this->db->group_by("r.kode_ruangan_a");
    $this->db->order_by("k.kode_ruangan,r.nama_ruangan");
    $r = $this->db->get("kamar k");
    $dinas = $umum = $bpjs = $prsh = array();
    foreach ($r->result() as $row) {
      $n = $this->db->get_where("rekap_pasienpulang",["tanggal"=>date("Y-m-d"),"kode_ruangan"=>$row->kode_ruangan_a]);
      for ($i=1; $i <= 4 ; $i++) {
        $dinas[$i] = (isset($data["DINAS"][$row->kode_ruangan_a][$i]) ? $data["DINAS"][$row->kode_ruangan_a][$i] : 0);
        $umum[$i] = (isset($data["UMUM"][$row->kode_ruangan_a][$i]) ? $data["UMUM"][$row->kode_ruangan_a][$i] : 0);
        $bpjs[$i] = (isset($data["BPJS"][$row->kode_ruangan_a][$i]) ? $data["BPJS"][$row->kode_ruangan_a][$i] : 0);
        $prsh[$i] = (isset($data["PRSH"][$row->kode_ruangan_a][$i]) ? $data["PRSH"][$row->kode_ruangan_a][$i] : 0);
      }
      $bed = $row->bed;
      $list = array(
        "tanggal" => date("Y-m-d"),
        "kode_ruangan" => $row->kode_ruangan_a,
        "tt" => $row->bed,
        "sehat_dinas" => $dinas[1],
        "sehat_umum"  => $umum[1],
        "sehat_bpjs"  => $bpjs[1],
        "sehat_prsh"  => $prsh[1],
        "paksa_dinas" => $dinas[2],
        "paksa_umum"  => $umum[2],
        "paksa_bpjs"  => $bpjs[2],
        "paksa_prsh"  => $prsh[2],
        "rujuk_dinas" => $dinas[3],
        "rujuk_umum"  => $umum[3],
        "rujuk_bpjs"  => $bpjs[3],
        "rujuk_prsh"  => $prsh[3],
        "meninggal_dinas" => $dinas[4],
        "meninggal_umum"  => $umum[4],
        "meninggal_bpjs"  => $bpjs[4],
        "meninggal_prsh"  => $prsh[4],
        "hari_perawatan" =>(isset($data["HP"][$row->kode_ruangan_a]) ? $data["HP"][$row->kode_ruangan_a] : 0)
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_pasienpulang",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d"));
        $this->db->where("kode_ruangan",$row->kode_ruangan_a);
        $this->db->update("rekap_pasienpulang",$list);
      }
    }
  }
  function rekap_igd(){
    $tgl1 = date("Y-m-d");
    $tgl2 = date("Y-m-d");
    $data = array();
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
      $n = $this->db->get_where("rekap_igd",["tanggal"=>date("Y-m-d")]);
      $dinas = (isset($data["DINAS"]["0102030"]) ? $data["DINAS"]["0102030"] : 0);
      $umum = (isset($data["UMUM"]["0102030"]) ? $data["UMUM"]["0102030"] : 0);
      $bpjs = (isset($data["BPJS"]["0102030"]) ? $data["BPJS"]["0102030"] : 0);
      $prsh = (isset($data["PRSH"]["0102030"]) ? $data["PRSH"]["0102030"] : 0);
      $reguler = (isset($data["REGULER"]["0102030"]) ? $data["REGULER"]["0102030"] : 0);
      $eksekutif = (isset($data["EKSEKUTIF"]["0102030"]) ? $data["EKSEKUTIF"]["0102030"] : 0);
      $baru = (isset($data["BARU"]["0102030"]) ? $data["BARU"]["0102030"] : 0);
      $lama = (isset($data["LAMA"]["0102030"]) ? $data["LAMA"]["0102030"] : 0);
      $list = array(
        "tanggal" => date("Y-m-d"),
        "baru_ralan" => $baru,
        "lama_ralan" => $lama,
        "reguler_ralan" => $reguler,
        "eksekutif_ralan" => $eksekutif,
        "dinas_ralan" => $dinas,
        "umum_ralan" => $umum,
        "bpjs_ralan" => $bpjs,
        "prsh_ralan" => $prsh,
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_igd",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d"));
        $this->db->update("rekap_igd",$list);
      }
      $data = array();
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
      $n = $this->db->get_where("rekap_igd",["tanggal"=>date("Y-m-d")]);
      $dinas = (isset($data["DINAS"]) ? $data["DINAS"] : 0);
      $umum = (isset($data["UMUM"]) ? $data["UMUM"] : 0);
      $bpjs = (isset($data["BPJS"]) ? $data["BPJS"] : 0);
      $prsh = (isset($data["PRSH"]) ? $data["PRSH"] : 0);
      $reguler = (isset($data["REGULER"]) ? $data["REGULER"] : 0);
      $eksekutif = (isset($data["EKSEKUTIF"]) ? $data["EKSEKUTIF"] : 0);
      $baru = (isset($data["BARU"]) ? $data["BARU"] : 0);
      $lama = (isset($data["LAMA"]) ? $data["LAMA"] : 0);
      $list = array(
        "tanggal" => date("Y-m-d"),
        "baru_inap" => $baru,
        "lama_inap" => $lama,
        "reguler_inap" => $reguler,
        "eksekutif_inap" => $eksekutif,
        "dinas_inap" => $dinas,
        "umum_inap" => $umum,
        "bpjs_inap" => $bpjs,
        "prsh_inap" => $prsh,
      );
      if ($n->num_rows()<=0){
        $this->db->insert("rekap_igd",$list);
      } else {
        $this->db->where("tanggal",date("Y-m-d"));
        $this->db->update("rekap_igd",$list);
      }
  }
}
?>
