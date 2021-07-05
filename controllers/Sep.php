<?php
class Sep extends CI_Controller{
    function __construct(){
        parent::__construct();
		$this->load->Model('Msep');
        if (($this->session->userdata('username') == NULL)||($this->session->userdata('password') == NULL))
        {
                $this->session->sess_destroy();
				redirect('login','refresh');
        }
    }
	function formsep($no_pasien,$no_reg,$nobpjs=""){
		$data["vmenu"] 			= "pendaftaran/vmenu";
		$data['menu']			= "ralan";
		$data["no_pasien"] 		= $no_pasien;
		$data["no_reg"] 		= $no_reg;
		$data["nobpjs"] 		= $nobpjs;
        $data["title"]        	= "SEP Rawat Jalan || RS CIREMAI";
        $data["title_header"] 	= "SEP Rawat Jalan";
        $data["content"] 		= "pendaftaran/vsep_ralan";
        $data["breadcrumb"]   	= "<li class='active'><strong>SEP Rawat Jalan</strong></li>";
        $data["row"]			= $this->Msep->getralan_detail($no_pasien,$no_reg);
        $data["rujukan"]		= isset($this->rujukan($nobpjs)->rujukan) ? $this->rujukan($nobpjs)->rujukan : "";
        $data["peserta"]        = isset($this->nokartu($nobpjs)->provUmum) ? $this->nokartu($nobpjs)->provUmum->kdProvider." | ".$this->nokartu($nobpjs)->provUmum->nmProvider : "";
        $data["ppkasal"]		= json_decode($this->api_vclaim("referensi_propinsi"))->response->list;
        $this->load->view('template',$data);
    }
    function cetaksep($no_reg,$no_pasien,$nobpjs,$nosep=""){
		$data["no_pasien"] 		= $no_pasien;
		$data["no_reg"] 		= $no_reg;
		$data["nosep"] 			= $nosep;
		$data["nobpjs"] 		= $nobpjs;
        // $data["asal"]            = $ppkasal;
        // $data["ar"]            = $asalrujukan;
        $data["m"]              = $this->Msep->getdiagnosa_ralan($no_reg);
        $data["tr"]              = $this->Msep->gettriage($no_reg);
        $data["t"]              = $this->Msep->gettindakan_ralan($no_reg);
        $data["k"]              = $this->Msep->getkeadaan_ralan($no_reg);
        $data["o"]              = $this->Msep->getterapi_ralan($no_reg);
        $data["p"]              = $this->Msep->getpasien($no_pasien);
        $data["rujukan"]		= ($this->carisep($nosep)!="" ? $this->carisep($nosep) : "");
        // $data["ppkasal"]        = json_decode($this->api_vclaim("referensi_faskes_".$ppkasal."_".$asalrujukan));
        $this->load->view('pendaftaran/vcetaksep',$data);
    }
	function formsep_inap($no_pasien,$no_reg,$nobpjs=""){
		$data["vmenu"] 			= "pendaftaran/vmenu";
		$data['menu']			= "inap";
		$data["no_pasien"] 		= $no_pasien;
		$data["no_reg"] 		= $no_reg;
		$data["nobpjs"] 		= $nobpjs;
        $data["title"]        	= "SEP Rawat Inap || RS CIREMAI";
        $data["title_header"] 	= "SEP Rawat Inap";
        $data["content"] 		= "pendaftaran/vsep_inap";
        $data["breadcrumb"]   	= "<li class='active'><strong>SEP Rawat Inap</strong></li>";
        $data["row"]			= $this->Msep->getinap_detail($no_pasien,$no_reg);
        $data["rujukan"]		= ($this->nokartu($nobpjs)!="") ? $this->nokartu($nobpjs) : "";
        $data["ppkasal"]        = isset($this->nokartu($nobpjs)->provUmum) ? $this->nokartu($nobpjs)->provUmum->kdProvider." | ".$this->nokartu($nobpjs)->provUmum->nmProvider : "";
        $data["propinsi"]		= json_decode($this->api_vclaim("referensi_propinsi"))->response->list;
        $this->load->view('template',$data);
    }
    function cetaksep_inap($no_reg,$no_pasien,$nobpjs,$nosep=""){
		$data["no_pasien"] 		= $no_pasien;
		$data["no_reg"] 		= $no_reg;
		$data["nosep"] 			= $nosep;
		$data["nobpjs"] 		= $nobpjs;
        // $data["asal"]            = $ppkasal;
        // $data["ar"]            = $asalrujukan;
        $data["row"]              = $this->Msep->getpasien_inap($no_pasien,$no_reg);
        $data["k"]              = $this->Msep->getkeluargapasien($no_pasien,$no_reg);
        $data["rujukan"]		= ($this->carisep($nosep)!="" ? $this->carisep($nosep) : "");
        // $data["ppkasal"]        = json_decode($this->api_vclaim("referensi_faskes_".$ppkasal."_".$asalrujukan));
        $this->load->view('pendaftaran/vcetaksep_inap',$data);
    }
    function diag_awal($kode){
    	$result = json_decode($this->api_vclaim("referensi_diagnosa_".$kode));
    	echo json_encode($result->response);
    }
    function kabupaten($kode){
    	$result = json_decode($this->api_vclaim("referensi_kabupaten_propinsi_".$kode));
    	echo json_encode($result->response->list);
    }
    function kecamatan($kode){
    	$result = json_decode($this->api_vclaim("referensi_kecamatan_kabupaten_".$kode));
    	echo json_encode($result->response->list);
    }
	function dpjp($kode,$tglpelayanan,$spesialis){
    	$result = json_decode($this->api_vclaim("referensi_dokter_pelayanan_".$kode."_tglPelayanan_".$tglpelayanan."_Spesialis_".$spesialis));
    	return $result->response->list[0]->kode;
    }
    function poli($kode){
    	$result = json_decode($this->api_vclaim("referensi_poli_".$kode));
    	echo json_encode($result->response);
    }
    function ppkasal($kode1,$kode2){
    	$result = json_decode($this->api_vclaim("referensi_faskes_".$kode1."_".$kode2));
    	echo json_encode($result->response);
    }
    function rujukan($nobpjs){
    	$result = json_decode($this->api_vclaim("Rujukan_Peserta_".$nobpjs));
    	return ($result==null ? "" : $result->response);
    }
    function carirujukan($nobpjs){
        $result = json_decode($this->api_vclaim("Rujukan_Peserta_".$nobpjs));
        var_dump($result==null ? "" : $result->response);
    }
    function nokartu($nobpjs){
        $tglsep = date("Y-m-d");
        $result = json_decode($this->api_vclaim("Peserta_nokartu_".$nobpjs."_tglSEP_".$tglsep));
        return ($result==null ? "" : $result->response->peserta);
    }
    function norujukan($norujukan){
        $result = json_decode($this->api_vclaim("Rujukan_".$norujukan));
        if (json_encode($result->response)=="null")
            $result = json_decode($this->api_vclaim("Rujukan_RS_".$norujukan));
        return $result->response;
    }
    function carisep($nosep){
        $result = json_decode($this->api_vclaim("SEP_".$nosep));
        // $norujukan =  $result->response->noRujukan;
        return $result->response;
    }
    function vclaim($nokartu){
    	// $nokartu = $this->input->post("nokartu");
    	$tglsep = date("Y-m-d",strtotime($this->input->post("tglsep")));
    	$ppkpelayanan = $this->input->post("ppkpelayanan");
    	$data = "20337";
  		$secretKey = "4tW3926623";
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
   		$encodedSignature = base64_encode($signature);
		$url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Rujukan/Peserta/".$nokartu;
    	$curl = curl_init();
    	$header = array(
    			"X-cons-id" => $data,
		    	"X-signature" => $encodedSignature,
		    	"X-timestamp" => $tStamp
		);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Accept: */*",
    			"Cache-Control: no-cache",
    			"Connection: keep-alive",
		    	"X-cons-id: ".$data." ",
		    	"X-signature: ".$encodedSignature." ",
		    	"X-timestamp: ".$tStamp,
		    	"cache-control: no-cache",
		  	),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		var_dump($response);
    }
    function api_vclaim($url){
    	$data = "20337";
  		$secretKey = "4tW3926623";
		date_default_timezone_set('UTC');
		$url = str_replace("_", "/", $url);
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
   		$encodedSignature = base64_encode($signature);
		$url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/".$url;
    	$curl = curl_init();
    	$header = array(
    			"X-cons-id" => $data,
		    	"X-signature" => $encodedSignature,
		    	"X-timestamp" => $tStamp
		);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Accept: */*",
    			"Cache-Control: no-cache",
    			"Connection: keep-alive",
		    	"X-cons-id: ".$data." ",
		    	"X-signature: ".$encodedSignature." ",
		    	"X-timestamp: ".$tStamp,
		    	"cache-control: no-cache",
		  	),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }
    function getsep(){
    	$no_rm = $this->input->post("no_rm");
    	$no_reg = $this->input->post("no_reg");
    	$nokartu = $this->input->post("no_bpjs");
        $this->Msep->updatesep($no_reg,$this->input->post("nosep"));
    	$provperujuk = $this->input->post("provperujuk");
        $asalrujukan = $this->input->post("asalrujukan");
    	$pelayanan = $this->input->post("pelayanan");
    	$hakkelas = $this->input->post("hakkelas");
    	$diag_awal = $this->input->post("diag_awal");
    	$polirujukan = $this->input->post("polirujukan");
    	$jenis = ($this->input->post("jenis")=="R" ? "0" : "1");
    	$cob = $this->input->post("cob");
    	$lakalantas = $this->input->post("lakalantas");
    	if ($lakalantas==0){
    		$penjamin =
    		$tglkejadian =
    		$keterangan = "";
    		$suplesi = "0";
    		$nosepsuplesi =
    		$kdpropinsi =
    		$kdkabupaten =
    		$kdkecamatan = "";
    	} else{
    		$penjamin = $this->input->post("penjamin");
    		$tglkejadian = date("Y-m-d",strtotime($this->input->post("tglkejadian")));
    		$keterangan = $this->input->post("keterangan");
    		$suplesi = $this->input->post("suplesi");
    		$nosepsuplesi = $this->input->post("nosepsuplesi");
    		$kdpropinsi = $this->input->post("kdpropinsi");
    		$kdkabupaten = $this->input->post("kdkabupaten");
    		$kdkecamatan = $this->input->post("kdkecamatan");
    	}
    	$nosurat = ($this->input->post("nosurat")==null ? substr($no_reg,-6) :$this->input->post("nosurat"));
    	$notelpon = $this->input->post("telpon");
    	$dpjp = ($this->input->post("dpjp")==null ? "" : $this->input->post("dpjp"));
    	$pilih = $this->input->post("pilih");
    	if ($pilih==2){
    		$ppkasal = $this->input->post("ppkasal");
    		$p = explode(" | ", $ppkasal);
            $diag_awal = $this->input->post("diag_awal2");
            $d = explode(" | ", $diag_awal);
    		$provperujuk = $p[0];
            $diag_awal = $d[0];
    		$tglkunjungan = date("Y-m-d",strtotime($this->input->post("tglkunjungan2")));
    		$norujukan = "1234567";
            $pelayanan = "2";
            $polirujukan = "IGD";
            $jenis = "0";
			$dpjp = $this->input->post("dpjp");
    	} else {
    		$tglkunjungan = $this->input->post("tglkunjungan");
    		$norujukan = $this->input->post("norujukan");
			$dpjp = $this->dpjp("2",$tglkunjungan,$polirujukan);
    	}
		$arr["request"]["t_sep"] = array(
										"noKartu" => $nokartu,
										"tglSep" => date("Y-m-d"),
										"ppkPelayanan" => "1019R002" /*(provPetunjuk dari rujukan)*/,
										"jnsPelayanan" => $pelayanan,/*1. rawat inap, 2. rawat jalan*/
										"klsRawat" => $hakkelas /*(hak_kelas dari rujukan)*/,
										"noMR" => $no_rm
									);
		$arr["request"]["t_sep"]["rujukan"] = array(
				    							"asalRujukan" => $asalrujukan,
				    							"tglRujukan" => $tglkunjungan /*(tglKunjungan dari rujukan)*/,
				    							"noRujukan" => $norujukan /*(noKunjungan dari rujukan)*/,
				    							"ppkRujukan" => $provperujuk /*(provperujuk-code dari rujukan)*/,
											);
		$arr["request"]["t_sep"]["catatan"] = "-";
		$arr["request"]["t_sep"]["diagAwal"] = $diag_awal;
		$arr["request"]["t_sep"]["poli"] = array(
					    "tujuan" =>  $polirujukan,
					    "eksekutif" => $jenis
					);
		$arr["request"]["t_sep"]["cob"]["cob"] = $cob;
		$arr["request"]["t_sep"]["katarak"]["katarak"] = "0";
		$arr["request"]["t_sep"]["jaminan"] = array(
						"lakaLantas" => $lakalantas,
						"lokasilaka" => "Cirebon");
		$arr["request"]["t_sep"]["jaminan"]["penjamin"] = array(
							"penjamin" => $penjamin,
							"tglKejadian" => $tglkejadian,
							"keterangan" => $keterangan);
		$arr["request"]["t_sep"]["jaminan"]["penjamin"]["suplesi"] = array(
								"suplesi" => $suplesi,
								"noSepSuplesi" => $nosepsuplesi);
		$arr["request"]["t_sep"]["jaminan"]["penjamin"]["suplesi"]["lokasiLaka"] = array(
									"kdPropinsi" => $kdpropinsi,
									"kdKabupaten" => $kdkabupaten,
									"kdKecamatan" => $kdkecamatan
								);

		$arr["request"]["t_sep"]["skdp"] = array(
						"noSurat" => $nosurat,
						"kodeDPJP" => $dpjp,
					);
		$arr["request"]["t_sep"]["noTelp"] = $notelpon;
		$arr["request"]["t_sep"]["user"] = "Coba Ws";
		$data = "20337";
  		$secretKey = "4tW3926623";
		date_default_timezone_set('UTC');
		$url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/1.1/insert";
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
		$json = json_encode($arr);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $json,
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
        if (isset($msg["metaData"]["code"])){

				if ($msg["metaData"]["message"]=="Sukses"){
					$nosep = $msg["response"]["sep"]["noSep"];
					$this->Msep->updatesep($no_reg,$nosep);
				} else {
					$nosep = substr($msg["metaData"]["message"],-19);
					if (substr($nosep, 0, 4)=="1019") $this->Msep->updatesep($no_reg,$nosep);
				}
				$this->session->set_flashdata("message","success|".$msg["metaData"]["message"]);
        } else {
        	$nosep = $msg["response"]["sep"]["noSep"];
        	$this->Msep->updatesep($no_reg,$nosep);
            $this->session->set_flashdata("message","success|".$msg["response"]["sep"]["noSep"]);
            // $this->session->set_flashdata("message","success|".json_encode($arr));
        }
        redirect("sep/formsep/".$no_rm."/".$no_reg."/".$nokartu);
    }
	function getsep_inap(){
    	$no_rm = $this->input->post("no_rm");
    	$no_reg = $this->input->post("no_reg");
    	$nokartu = $this->input->post("no_bpjs");
        $asalrujukan = "2";
        $this->Msep->updatesep_inap($no_reg,$this->input->post("nosep"));
    	$hakkelas = $this->input->post("hakkelas");
    	$jenis = ($this->input->post("jenis")=="R" ? "0" : "1");
    	$cob = $this->input->post("cob");
    	$lakalantas = $this->input->post("lakalantas");
    	if ($lakalantas==0){
    		$penjamin =
    		$tglkejadian =
    		$keterangan = "";
    		$suplesi = "0";
    		$nosepsuplesi =
    		$kdpropinsi =
    		$kdkabupaten =
    		$kdkecamatan = "";
    	} else{
    		$penjamin = $this->input->post("penjamin");
    		$tglkejadian = date("Y-m-d",strtotime($this->input->post("tglkejadian")));
    		$keterangan = $this->input->post("keterangan");
    		$suplesi = $this->input->post("suplesi");
    		$nosepsuplesi = $this->input->post("nosepsuplesi");
    		$kdpropinsi = $this->input->post("kdpropinsi");
    		$kdkabupaten = $this->input->post("kdkabupaten");
    		$kdkecamatan = $this->input->post("kdkecamatan");
    	}
    	$nosurat = ($this->input->post("nosurat")==null ? substr($no_reg,-6) :$this->input->post("nosurat"));
    	// $nosurat = random_string("numeric",6);
        $notelpon = $this->input->post("telpon");
    	$dpjp = ($this->input->post("dpjp")==null ? "" : $this->input->post("dpjp"));
    	$pilih = $this->input->post("pilih");
    	$ppkasal = $this->input->post("ppkasal");
        if ($ppkasal==""){
            $peserta = $this->nokartu($nobpjs);
            $ppkasal = $peserta["provUmum"]->kdProvider." | ".$peserta["provUmum"]->nmProvider;
        }
    	$p = explode(" | ", $ppkasal);
        $diag_awal = $this->input->post("diag_awal");
        $d = explode(" | ", $diag_awal);
    	$provperujuk = $p[0];
        $diag_awal = $d[0];
    	$tglkunjungan = date("Y-m-d",strtotime($this->input->post("tglkunjungan")));
    	$norujukan = random_string("numeric",12);
        $pelayanan = "1";
        $polirujukan = "IGD";
        $jenis = "0";
		$dpjp = $this->dpjp("1",$tglkunjungan,$polirujukan);
		$arr["request"]["t_sep"] = array(
										"noKartu" => $nokartu,
										"tglSep" => date("Y-m-d"),
										"ppkPelayanan" => "1019R002" /*(provPetunjuk dari rujukan)*/,
										"jnsPelayanan" => $pelayanan,/*1. rawat inap, 2. rawat jalan*/
										"klsRawat" => $hakkelas /*(hak_kelas dari rujukan)*/,
										"noMR" => $no_rm
									);
		$arr["request"]["t_sep"]["rujukan"] = array(
				    							"asalRujukan" => $asalrujukan,
				    							"tglRujukan" => $tglkunjungan /*(tglKunjungan dari rujukan)*/,
				    							"noRujukan" => $norujukan /*(noKunjungan dari rujukan)*/,
				    							"ppkRujukan" => $provperujuk /*(provperujuk-code dari rujukan)*/,
											);
		$arr["request"]["t_sep"]["catatan"] = "-";
		$arr["request"]["t_sep"]["diagAwal"] = $diag_awal;
		$arr["request"]["t_sep"]["poli"] = array(
					    "tujuan" =>  $polirujukan,
					    "eksekutif" => $jenis
					);
		$arr["request"]["t_sep"]["cob"]["cob"] = $cob;
		$arr["request"]["t_sep"]["katarak"]["katarak"] = "0";
		$arr["request"]["t_sep"]["jaminan"] = array(
						"lakaLantas" => $lakalantas,
						"lokasilaka" => "Cirebon");
		$arr["request"]["t_sep"]["jaminan"]["penjamin"] = array(
							"penjamin" => $penjamin,
							"tglKejadian" => $tglkejadian,
							"keterangan" => $keterangan);
		$arr["request"]["t_sep"]["jaminan"]["penjamin"]["suplesi"] = array(
								"suplesi" => $suplesi,
								"noSepSuplesi" => $nosepsuplesi);
		$arr["request"]["t_sep"]["jaminan"]["penjamin"]["suplesi"]["lokasiLaka"] = array(
									"kdPropinsi" => $kdpropinsi,
									"kdKabupaten" => $kdkabupaten,
									"kdKecamatan" => $kdkecamatan
								);

		$arr["request"]["t_sep"]["skdp"] = array(
						"noSurat" => $nosurat,
						"kodeDPJP" => $dpjp,
					);
		$arr["request"]["t_sep"]["noTelp"] = $notelpon;
		$arr["request"]["t_sep"]["user"] = "Coba Ws";
		$data = "20337";
  		$secretKey = "4tW3926623";
		date_default_timezone_set('UTC');
		$url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/1.1/insert";
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
		$json = json_encode($arr);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $json,
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
        if (isset($msg["metaData"]["code"])){

				if ($msg["metaData"]["message"]=="Sukses"){
					$nosep = $msg["response"]["sep"]["noSep"];
					$this->Msep->updatesep_inap($no_reg,$nosep);
				} else {
					$nosep = substr($msg["metaData"]["message"],-19);
					if (substr($nosep, 0, 4)=="1019") $this->Msep->updatesep_inap($no_reg,$nosep);
				}
				$this->session->set_flashdata("message","success|".$msg["metaData"]["message"]);
        } else {
        	$nosep = $msg["response"]["sep"]["noSep"];
        	$this->Msep->updatesep_inap($no_reg,$nosep);
            $this->session->set_flashdata("message","success|".$msg["response"]["sep"]["noSep"]);
            // $this->session->set_flashdata("message","success|".json_encode($arr));
        }
        redirect("sep/formsep_inap/".$no_rm."/".$no_reg."/".$nokartu);
    }
    function hapussep($no_rm,$no_reg,$nokartu,$nosep=""){
        $data = "20337";
        $secretKey = "4tW3926623";
        date_default_timezone_set('UTC');
        $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/Delete";
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
        $arr["request"]["t_sep"] = array(
                "noSep" => $nosep,
                "user" => "SUNANTO"
            );
        $json = json_encode($arr);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => $json,
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
        $nosep = "";
        $this->Msep->updatesep_inap($no_reg,$nosep);
        $this->session->set_flashdata("message","success|".$msg["response"]." berhasil dihapus");
        redirect("sep/formsep_inap/".$no_rm."/".$no_reg."/".$nokartu);
    }
    function getcaripasien_ralan(){
        $this->session->set_flashdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_flashdata("nama",$this->input->post("cari_nama"));
        $this->session->set_flashdata("no_reg",$this->input->post("cari_noreg"));
    }
	function getcaripasien_inap(){
        $this->session->set_flashdata("no_pasien",$this->input->post("cari_no"));
        $this->session->set_flashdata("nama",$this->input->post("cari_nama"));
        $this->session->set_flashdata("no_reg",$this->input->post("cari_noreg"));
    }
}
?>
