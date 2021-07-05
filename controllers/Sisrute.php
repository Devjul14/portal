<?php
class Sisrute extends CI_Controller{
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
  		$secretKey = md5("S!rs2020!!");
		date_default_timezone_set('UTC');
		$url = "http://sirs.yankes.kemkes.go.id/sirsservice/ranap";
		$ch = curl_init();
		$this->db->select("k.kode_ruangan,r.nama_ruangan,kl.kode_kelas_bpjs2,count(*) as kapasitas");
		$this->db->join("ruangan r","r.kode_ruangan=k.kode_ruangan","inner");
		$this->db->join("kelas kl","kl.kode_kelas=k.kode_kelas","inner");
		$this->db->group_by("k.kode_ruangan,kl.kode_kelas_bpjs2,k.status_kamar");
		$this->db->where("k.kode_ruangan","15");
		$q = $this->db->get("kamar k");
        $arr_xml = "";
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
            $arr_xml .= '<xml version="1.0">';
            $arr_xml .= '<data>';
            $arr_xml .= '<kode_ruang>'.$row->kode_ruangan.'</kode_ruang>';
            $arr_xml .= '<tipe_pasien>'.$row->kode_kelas_bpjs2.'</tipe_pasien>';
            $arr_xml .= '<total_TT>'.$row->kapasitas.'</total_TT>';
            $arr_xml .= '<terpakai_male>'.$row->kapasitas.'</terpakai_male>';
            $arr_xml .= '<terpakai_female>30</terpakai_female>';
            $arr_xml .= '<kosong_male>4</kosong_male>';
            $arr_xml .= '<kosong_female>0</kosong_female>';
            $arr_xml .= '<waiting>40</waiting>';
            $arr_xml .= '<tgl_update>2014-04-21 08:04:09</tgl_update>';
            $arr_xml .= '</data>';
            $arr_xml .= '</xml>"';
			$json = json_encode($arr);
        	$headers = array(
        	    'X-rs-id: '.$data .'',
        	    'X-pass: '.$secretKey.'' ,
        	    'Content-Type: Application/XML',   
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
}
?>