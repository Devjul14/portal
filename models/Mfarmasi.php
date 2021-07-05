<?php
class Mfarmasi extends CI_Model{
   function __construct()
    {
        parent::__construct();
    }
   	function getobat_m($page,$offset){
       	$cari = $this->session->userdata('cari_obat');
        $this->db->select("f.kode,f.nama,f.pak1,f.isi,f.hrg_jual");
       	$this->db->like("nama",$cari);
       	$this->db->or_like("f.kode",$cari);
       	$q = $this->db->get("farmasi_data_obat f",$page,$offset);
       	return $q;
    }
    function getobat_detail($kode){
        $this->db->select("f.*");
        $this->db->where("kode",$kode);
       	$q = $this->db->get("farmasi_data_obat f");
       	return $q->row();
    }
    function getsatuan(){
    	return $this->db->get("satuan");
    }
    function getsatuanobat_besar(){
    	$this->db->where("jenis_satuan","B");
    	return $this->db->get("satuan_obat");
    }
    function getsatuanobat_kecil(){
    	$this->db->where("jenis_satuan","K");
    	return $this->db->get("satuan_obat");
    }
    function getsatuan_besar(){
    	return $this->db->get("satuan_besar");
    }
    function getobat_master(){
       	$cari = $this->session->userdata('cari_obat');
        $this->db->select("f.kode,f.nama,f.pak1,f.isi,f.hrg_jual");
       	$this->db->like("nama",$cari);
       	$this->db->or_like("f.kode",$cari);
       	$this->db->order_by("nama");
       	$q = $this->db->get("farmasi_data_obat f");
       	return $q;
       }
    function getpembelian($page,$offset){
    	$nama = $this->session->userdata('cari_nama');
    	$tgl1 = $this->session->userdata('tgl1');
    	$tgl2 = $this->session->userdata('tgl2');
    	if($nama != ""){
    		$this->db->where("supllier",$nama);
    	}
    	if($tgl1 != "" OR $tgl2 != ""){
    		$this->db->where("p.tanggal>=",date("Y-m-d",strtotime($tgl1)));
    		$this->db->where("p.tanggal>=",date("Y-m-d",strtotime($tgl2)));
    	}
    	$this->db->select("p.*, s.nama as nama_supplier, s.kode as ksupplier");
    	$this->db->join("supplier s","s.kode = p.supplier","left");
    	$q = $this->db->get("pembelian p",$page,$offset);
    	return $q;
    }
    function getpembelian_master(){
    	$nama = $this->session->userdata('cari_nama');
    	$tgl1 = $this->session->userdata('tgl1');
    	$tgl2 = $this->session->userdata('tgl2');
    	if($nama != ""){
    		$this->db->where("supllier",$nama);
    	}
    	if($tgl1 != "" OR $tgl2 != ""){
    		$this->db->where("p.tanggal>=",date("Y-m-d",strtotime($tgl1)));
    		$this->db->where("p.tanggal>=",date("Y-m-d",strtotime($tgl2)));
    	}
    	$this->db->select("p.*, s.nama as nama_supplier, s.kode as ksupplier");
    	$this->db->join("supplier s","s.kode = p.supplier","left");
    	$q = $this->db->get("pembelian p");
    	return $q;
    }
    function getpembelian_detail($kode){
    	$this->db->select("p.*, s.nama, s.kode as ksupplier");
    	$this->db->where("kode", $kode);
    	$this->db->join("supplier s", "s.kode = p.supplier","left");
    	$q = $this->db->get("pembelian p");
    	return $q;
    }
    function getitem_pembelian($kode){
    	$this->db->where("kode",$kode);
    	$q = $this->db->get("itempembelian");
    	return $q;
    }
    // function getobat(){
    // 	return $this->db->get("farmasi_data_obat");
    // }

    function getpasien_ralan($igd=false,$page,$offset){
		$poli_kode = $this->session->userdata("poli_kode");
		$kode_dokter = $this->session->userdata("kode_dokter");
		$tgl1 = $this->session->userdata("tgl1");
		$tgl2 = $this->session->userdata("tgl2");
		$no_pasien = $this->session->userdata("no_pasien");
		$no_reg = $this->session->userdata("no_reg");
		$nama = $this->session->userdata("nama");
		$this->db->select("pr.*,pol.keterangan as poli_asal,pol2.keterangan as poli_tujuan,p.nama_pasien as nama_pasien");
		// if ($no_pasien!="") {
		// 	$no_pasien = "000000".$no_pasien;
		// 	$this->db->where("p.no_pasien",substr($no_pasien,-6));
		// }
		$this->db->where("pr.layan!=","2");
		if ($igd){
			$this->db->where("pr.tujuan_poli","0102030");
		} else {
			$this->db->where("pr.tujuan_poli!=","0102030");
		}
		// if ($no_reg!="") {
		// 	$this->db->where("no_reg",$no_reg);
		// }
		// if ($nama!="") {
		// 	$this->db->like("p.nama_pasien",$nama);
		// }
		$this->db->group_start();
        $this->db->like("p.no_pasien",$no_pasien);
        $this->db->or_like("no_reg",$no_pasien);
        $this->db->or_like("no_bpjs",$no_pasien);
        $this->db->or_like("no_sjp",$no_pasien);
        $this->db->or_like("p.nama_pasien",$no_pasien);
        $this->db->group_end();
		if ($poli_kode!="") {
			$this->db->where("pr.tujuan_poli",$poli_kode);
		}
		if ($kode_dokter!="") {
			$this->db->where("pr.dokter_poli",$kode_dokter);
		}
		if ($tgl1!="" OR $tgl2!="") {
			$this->db->where("pr.tanggal>=",date("Y-m-d",strtotime($tgl1)));
            $this->db->where("pr.tanggal<=",date("Y-m-d",strtotime($tgl2)));
		}
		$this->db->order_by("no_reg","desc");
		$this->db->join("pasien p","p.no_pasien=pr.no_pasien");
		$this->db->join("poliklinik pol","pol.kode=pr.dari_poli","left");
		$this->db->join("poliklinik pol2","pol2.kode=pr.tujuan_poli","left");
		$query = $this->db->get("pasien_ralan pr",$page,$offset);
		return $query;
	}
	function getralan_detail($no_pasien,$no_reg){
		$this->db->select("pr.*,p.alamat,p.nama_pasien,pl.keterangan as poli");
		$this->db->join("pasien p","pr.no_pasien=p.no_pasien");
		$this->db->join("poliklinik pl","pl.kode=pr.tujuan_poli");
		$this->db->where("pr.no_pasien",$no_pasien);
		$this->db->where("pr.no_reg",$no_reg);
		$q = $this->db->get("pasien_ralan pr");
		return $q->row();
	}
	function getinap_detail($no_pasien,$no_reg){
		$this->db->select("pi.*,p.nama_pasien,r.nama_ruangan,k.nama_kelas");
		$this->db->join("pasien p","pi.no_rm=p.no_pasien");
		$this->db->join("jenis_kelamin jk","jk.jenis_kelamin=p.jenis_kelamin");
		$this->db->join("ruangan r","r.kode_ruangan=pi.kode_ruangan","left");
		$this->db->join("kelas k","k.kode_kelas=pi.kode_kelas","left");
		$this->db->join("dokter d","d.id_dokter=pi.dokter","left");
		$this->db->where("pi.no_rm",$no_pasien);
		$this->db->where("pi.no_reg",$no_reg);
		$q = $this->db->get("pasien_inap pi");
		return $q->row();
	}
	function getapotek($no_reg){
		$this->db->order_by("id,nama_obat");
		$q = $this->db->get_where("apotek",["no_reg" => $no_reg]);
		return $q;
	}
	function getapotek_inap($no_reg,$tgl1="",$tgl2=""){
		$this->db->order_by("tanggal,nama_obat");
		if ($tgl1!=""){
			$this->db->where("tanggal>=",date("Y-m-d",strtotime($tgl1)));
        	$this->db->where("tanggal<=",date("Y-m-d",strtotime($tgl2)));
        }
		$q = $this->db->get_where("apotek_inap",["no_reg" => $no_reg]);
		return $q;
	}
	function getapotek_detail($no_reg){
		$q = $this->db->get_where("transaksi_apotek",["no_reg"=>$no_reg]);
		return $q;
	}
	function getobat(){
		return $this->db->get("farmasi_data_obat");
	}
	function addobat(){
		$obat = $this->input->post("obat");
		$id = date("dmyHis");
		foreach ($obat as $key => $value) {
			$this->db->select("nama,pak2,hrg_jual");
			$t = $this->db->get_where("farmasi_data_obat",["kode" => $value]);
			if ($t->num_rows()>0){
				$q = $t->row();
				$data = array(
							"kode" => $id,
							"kode_barang" => $value,
							"nama_barang" => $q->nama,
							"qty" => 1,
							"satuan" => $q->pak2,
							"jumlah" => $q->hrg_jual
						);
				$this->db->insert("itempembelian",$data);
				$id++;
			}
		}
	}
	function addobat_inap(){
		$obat = $this->input->post("obat");
		$id = date("dmyHis");
		foreach ($obat as $key => $value) {
			$this->db->select("nama,pak2,hrg_jual");
			$t = $this->db->get_where("farmasi_data_obat",["kode" => $value]);
			if ($t->num_rows()>0){
				$q = $t->row();
				$data = array(
							"id" => $id,
							"tanggal" => date("Y-m-d",strtotime($this->input->post("tanggal"))),
							"no_reg" => $this->input->post("no_reg"),
							"kode_obat" => $value,
							"nama_obat" => $q->nama,
							"qty" => 1,
							"satuan" => $q->pak2,
							"jumlah" => $q->hrg_jual
						);
				$this->db->insert("apotek_inap",$data);
				$id++;
			}
		}
	}
	function changedata(){
		$this->db->select("hrg_jual");
		$q = $this->db->get_where("farmasi_data_obat",["kode"=>$this->input->post("obat")])->row();
		$this->db->where("id",$this->input->post("id"));
		$this->db->set("qty",$this->input->post("value"));
		$this->db->set("jumlah",$this->input->post("value")*$q->hrg_jual);
		$this->db->update("apotek");
	}
	function changedata_inap(){
		$this->db->select("hrg_jual");
		$q = $this->db->get_where("farmasi_data_obat",["kode"=>$this->input->post("obat")])->row();
		$this->db->where("id",$this->input->post("id"));
		$this->db->set("qty",$this->input->post("value"));
		$this->db->set("jumlah",$this->input->post("value")*$q->hrg_jual);
		$this->db->update("apotek_inap");
	}
	function hapusobat($kode){
		$this->db->where("kode",$kode);
		$this->db->delete("farmasi_data_obat");
	}
	function hapusobat_inap(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->delete("apotek_inap");
	}
	function simpanobat($action){
		$data = array(
			 		"kode" => $this->input->post("kode"),
	       			"nama" => $this->input->post("nama"),
	        		"pak1" => $this->input->post("satuan"),
	        		"isi" => $this->input->post("isi"),
	        		"hpp" => $this->input->post("hpp"),
	        		"hrg_jual" => $this->input->post("harga_jual"),
	        		"batch" => $this->input->post("batch"),
	        		"disc" => $this->input->post("disc"),
	        		"harga_satuan" => $this->input->post("harga_satuan"),
	        		"harga_gross" => $this->input->post("harga_gross"),
	        		"jumlah" => $this->input->post("jumlah"),
	        		"hrg_beli" => $this->input->post("harga_beli")
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("farmasi_data_obat",$data);
			break;
			case 'edit' :
				$this->db->where("kode", $this->input->post("kode"));
				$this->db->update("farmasi_data_obat",$data);
			break;
		}

	}
	function simpanobat_inap(){
		$dat = array();
		$disc_nominal = $this->input->post("disc_nominal");
		$bayar = $this->input->post("total");
		$q = $this->db->get_where("transaksi_apotek",["no_reg"=>$this->input->post("no_reg")]);
		if ($q->num_rows()>0){
			$q = $q->row();
			$id = $q->id;
			$dat = array(
					"jumlah_disc" => $disc_nominal,
					"jumlah_bayar" => $bayar
			);
			$this->db->where("no_reg",$this->input->post("no_reg"));
			$this->db->update('transaksi_apotek', $dat);
		} else {
			$id = date("dmyHis");
			$dat = array(
					"id" => $id,
					"tanggal" => date("Y-m-d"),
					"no_reg" => $this->input->post("no_reg"),
					"jumlah_disc" => $disc_nominal,
					"jumlah_bayar" => $bayar
			   );
			$this->db->insert('transaksi_apotek', $dat);
		}
		$q = $this->db->get_where("kasir_inap",["no_reg"=>$this->input->post("no_reg"),"kode_tarif"=>"FRM"]);
		if ($q->num_rows()>0){
			$dat = array(
				"jumlah" => $bayar
			);
			$this->db->where("no_reg",$this->input->post("no_reg"));
			$this->db->where("kode_tarif","FRM");
			$this->db->update('kasir_inap', $dat);
		} else {
			$dat = array(
				"id" => date("dmyHis"),
				"tanggal" => date("Y-m-d",strtotime($this->input->post("tanggal"))),
				"no_reg" => $this->input->post("no_reg"),
				"kode_tarif" => "FRM",
				"qty" => 1,
				"jumlah" => $bayar
			);
			$this->db->insert('kasir_inap', $dat);
		}
	}
	function getcetak($no_pasien,$no_reg){
		$this->db->select("p.*, d.nama_dokter as dokter, g.keterangan as golpas, pr.no_pasien as no_rekmed, pol.keterangan as poli, pr.no_reg as regis, ta.id as nota");
    	$this->db->join("pasien_ralan pr","pr.no_pasien=p.no_pasien","left");
    	$this->db->join("gol_pasien g","g.id_gol=p.id_gol","left");
    	$this->db->join("transaksi_apotek ta","ta.no_reg=pr.no_reg","left");
    	$this->db->join("poliklinik pol","pol.kode=pr.tujuan_poli","left");
    	$this->db->join("pangkat pan","pan.id_pangkat = p.id_pangkat","left");
    	$this->db->join("dokter d","d.id_dokter=pr.dokter_poli","left");
		$this->db->where("pr.no_pasien",$no_pasien);
		$this->db->where("pr.no_reg",$no_reg);
    	$q = $this->db->get("pasien p");
    	return $q->row();
    }
    function getcetak_inap($no_pasien,$no_reg){
		$this->db->select("p.*, g.keterangan as golpas, pr.no_rm, pr.no_reg as regis, ta.id as nota");
    	$this->db->join("pasien_inap pr","pr.no_rm=p.no_pasien","left");
    	$this->db->join("gol_pasien g","g.id_gol=p.id_gol","left");
    	$this->db->join("transaksi_apotek ta","ta.no_reg=pr.no_reg","left");
    	$this->db->join("pangkat pan","pan.id_pangkat = p.id_pangkat","left");
		$this->db->where("pr.no_rm",$no_pasien);
		$this->db->where("pr.no_reg",$no_reg);
		$this->db->where("pr.no_reg",$no_reg);
    	$q = $this->db->get("pasien p");
    	return $q->row();
    }
    function getnota(){		
    	$n=0;
		for ($i=1;$i<=300000;$i++){
			$q = $this->db->get_where("pasien_ralan",array("no_reg"=>$n));
			if ($q->num_rows()<=0){
				return $n;
				break;
			}
   		}
		
	}
	function getindustrifarmasi(){
		$q = $this->db->get("industri_farmasi");
       	return $q;
    }
    function getdata_industri($page,$offset){
       	$cari = $this->session->userdata('cari_industri');
       	if ($cari!="") {
       		$this->db->like("nama_industri",$cari);
       		$this->db->or_like("kode_industri",$cari);
       	}
       	$q = $this->db->get("industri_farmasi",$page,$offset);
       	return $q;
    }
    function getindustrifarmasi_detail($kode){
    	$this->db->where("kode_industri",$kode);
    	$q = $this->db->get("industri_farmasi");
    	return $q->row();
    }
    function simpanindustri($action){
		$data = array(
			 		"kode_industri" 	=> $this->input->post("kode_industri"),
	       			"nama_industri" 	=> $this->input->post("nama_industri"),
	        		"alamat_industri" 	=> $this->input->post("alamat_industri"),
	        		"kota_industri" 	=> $this->input->post("kota_industri"),
	        		"telepon_industri" 	=> $this->input->post("telepon_industri"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("industri_farmasi",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_industri", $this->input->post("kode_industri"));
				$this->db->update("industri_farmasi",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusindustri($kode){
		$this->db->where("kode_industri",$kode);
		$this->db->delete("industri_farmasi");
		return "danger-Data berhasil dihapus";
	}
	function getmaster_obat(){
	   	$cari = $this->session->userdata('cari_obat');
	   	$this->db->like("f.nama",$cari);
	   	$this->db->or_like("f.kode",$cari);
	   	$this->db->order_by("f.nama");
	   	$q = $this->db->get("farmasi_data_obat f");
	   	return $q;
	}
	function getdatamaster_obat($page,$offset){
       	$cari = $this->session->userdata('cari_obat');

       	// $this->db->select("o.*,so.nama_satuan,ko.nama_kategori,jo.nama_jenis,go.nama_golongan,if.nama_industri,lo.nama_lokasi");
       	// $this->db->join("satuan_obat so","so.kode_satuan=o.kode_satuan");
       	// $this->db->join("kategori_obat ko","ko.kode_kategori=o.kode_kategori");
       	// $this->db->join("jenis_obat jo","jo.kode_jenis=o.kode_jenis");
       	// $this->db->join("industri_farmasi if","if.kode_industri=o.kode_industri");
       	// $this->db->join("golongan_obat go","go.kode_golongan=o.kode_golongan");
       	// $this->db->join("lokasi_obat lo","lo.kode_lokasi=o.letak_barang");
       	$this->db->like("o.nama",$cari);
       	$this->db->or_like("o.kode",$cari);
       	$q = $this->db->get("farmasi_data_obat o",$page,$offset);
       	return $q;
    }
    function getmasterobat_detail($kode){
    	$this->db->where("kode",$kode);
    	$q = $this->db->get("farmasi_data_obat");
    	return $q->row();
    }
    function getsupplierfarmasi(){
		$q = $this->db->get("supplier_farmasi");
       	return $q;
    }
    function getdata_supplier($page,$offset){
       	$cari = $this->session->userdata('cari_supplier');
       	if ($cari!="") {
       		$this->db->like("nama_supplier",$cari);
       		$this->db->or_like("kode_supplier",$cari);
       	}
       	$q = $this->db->get("supplier_farmasi",$page,$offset);
       	return $q;
    }
    function getsupplierfarmasi_detail($kode){
    	$this->db->where("kode_supplier",$kode);
    	$q = $this->db->get("supplier_farmasi");
    	return $q->row();
    }
    function simpansupplier($action){
		$data = array(
			 		"kode_supplier" 		=> $this->input->post("kode_supplier"),
	       			"nama_supplier" 		=> $this->input->post("nama_supplier"),
	        		"alamat_supplier" 		=> $this->input->post("alamat_supplier"),
	        		"kota_supplier" 		=> $this->input->post("kota_supplier"),
	        		"telepon_supplier" 		=> $this->input->post("telepon_supplier"),
	        		"bank_supplier" 		=> $this->input->post("bank_supplier"),
	        		"rekening_supplier" 	=> $this->input->post("rekening_supplier"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("supplier_farmasi",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_supplier", $this->input->post("kode_supplier"));
				$this->db->update("supplier_farmasi",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapussupplier($kode){
		$this->db->where("kode_supplier",$kode);
		$this->db->delete("supplier_farmasi");
		return "danger-Data berhasil dihapus";
	}
	function getkategoriobat(){
		$q = $this->db->get("kategori_obat");
       	return $q;
    }
    function getdata_kategori($page,$offset){
       	$cari = $this->session->userdata('cari_kategori');
       	if ($cari!="") {
       		$this->db->like("nama_kategori",$cari);
       		$this->db->or_like("kode_kategori",$cari);
       	}
       	$q = $this->db->get("kategori_obat",$page,$offset);
       	return $q;
    }
    function getkategoriobat_detail($kode){
    	$this->db->where("kode_kategori",$kode);
    	$q = $this->db->get("kategori_obat");
    	return $q->row();
    }
    function simpankategori($action){
		$data = array(
			 		"kode_kategori" 		=> $this->input->post("kode_kategori"),
	       			"nama_kategori" 		=> $this->input->post("nama_kategori"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("kategori_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_kategori", $this->input->post("kode_kategori"));
				$this->db->update("kategori_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapuskategori($kode){
		$this->db->where("kode_kategori",$kode);
		$this->db->delete("kategori_obat");
		return "danger-Data berhasil dihapus";
	}

	function getsatuanobat(){
		$q = $this->db->get("satuan_obat");
       	return $q;
    }
    function getdata_satuan($page,$offset){
       	$cari = $this->session->userdata('cari_satuan');
       	if ($cari!="") {
       		$this->db->like("nama_satuan",$cari);
       		$this->db->or_like("kode_satuan",$cari);
       	}
       	$this->db->where("jenis_satuan","B");
       	$q = $this->db->get("satuan_obat",$page,$offset);
       	return $q;
    }
    function getsatuanobat_detail($kode){
    	$this->db->where("jenis_satuan","B");
    	$this->db->where("kode_satuan",$kode);
    	$this->db->where("jenis_satuan","B");
    	$q = $this->db->get("satuan_obat");
    	return $q->row();
    }
    function simpansatuan($action){
		$data = array(
			 		"kode_satuan" 		=> $this->input->post("kode_satuan"),
	       			"nama_satuan" 		=> $this->input->post("nama_satuan"),
	       			"jenis_satuan" 		=> "B",
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("satuan_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_satuan", $this->input->post("kode_satuan"));
				$this->db->update("satuan_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapussatuan($kode){
		$this->db->where("kode_satuan",$kode);
		$this->db->delete("satuan_obat");
		return "danger-Data berhasil dihapus";
	}

	function getjenisobat(){
		$q = $this->db->get("jenis_obat");
       	return $q;
    }
    function getdata_jenis($page,$offset){
       	$cari = $this->session->userdata('cari_jenis');
       	if ($cari!="") {
       		$this->db->like("nama_jenis",$cari);
       		$this->db->or_like("kode_jenis",$cari);
       	}
       	$q = $this->db->get("jenis_obat",$page,$offset);
       	return $q;
    }
    function getjenisobat_detail($kode){
    	$this->db->where("kode_jenis",$kode);
    	$q = $this->db->get("jenis_obat");
    	return $q->row();
    }
    function simpanjenis($action){
		$data = array(
			 		"kode_jenis" 		=> $this->input->post("kode_jenis"),
	       			"nama_jenis" 		=> $this->input->post("nama_jenis"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("jenis_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_jenis", $this->input->post("kode_jenis"));
				$this->db->update("jenis_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusjenis($kode){
		$this->db->where("kode_jenis",$kode);
		$this->db->delete("jenis_obat");
		return "danger-Data berhasil dihapus";
	}

	function getgolonganobat(){
		$q = $this->db->get("golongan_obat");
       	return $q;
    }
    function getdata_golongan($page,$offset){
       	$cari = $this->session->userdata('cari_golongan');
       	if ($cari!="") {
       		$this->db->like("nama_golongan",$cari);
       		$this->db->or_like("kode_golongan",$cari);
       	}
       	$q = $this->db->get("golongan_obat",$page,$offset);
       	return $q;
    }
    function getgolonganobat_detail($kode){
    	$this->db->where("kode_golongan",$kode);
    	$q = $this->db->get("golongan_obat");
    	return $q->row();
    }
    function simpangolongan($action){
		$data = array(
			 		"kode_golongan" 		=> $this->input->post("kode_golongan"),
	       			"nama_golongan" 		=> $this->input->post("nama_golongan"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("golongan_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_golongan", $this->input->post("kode_golongan"));
				$this->db->update("golongan_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusgolongan($kode){
		$this->db->where("kode_golongan",$kode);
		$this->db->delete("golongan_obat");
		return "danger-Data berhasil dihapus";
	}
	function simpanmaster_obat($action){
		$data = array(
			 		'kode' 			=> $this->input->post('kode'),
			        'nama'			=> $this->input->post('nama'),
			        'pak1'			=> $this->input->post('satuan_besar'),
			        'pak2'			=> $this->input->post('satuan_kecil'),
			        'isi'			=> $this->input->post('isi'),
			        'katkd'			=> $this->input->post('kode_kategori'),
			        'golkd'			=> $this->input->post('kode_golongan'),
			        // 'hrg_beli'		=> $this->input->post('harga_beli'),
			        // 'hrg_jual'		=> $this->input->post('harga_jual'),
			        'kelkd'			=> $this->input->post('kode_jenis'),
			        'pabkd'			=> $this->input->post('kode_klasifikasi'),
			        'kode_simak'	=> $this->input->post('kode_simak'),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("farmasi_data_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode", $this->input->post("kode"));
				$this->db->update("farmasi_data_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}
	}
	function hapusmaster_obat($kode){
		$this->db->where("kode",$kode);
		$this->db->delete("farmasi_data_obat");
		return "danger-Data berhasil dihapus";
	}
	function getlokasi_obat(){
		$q = $this->db->get("lokasi_obat");
		return $q;
	}

	function getmetode_racik(){
		$q = $this->db->get("metode_racik");
       	return $q;
    }
    function getdata_metoderacik($page,$offset){
       	$cari = $this->session->userdata('cari_metoderacik');
       	if ($cari!="") {
       		$this->db->like("nama_racik",$cari);
       		$this->db->or_like("kode_racik",$cari);
       	}
       	$q = $this->db->get("metode_racik",$page,$offset);
       	return $q;
    }
    function getmetoderacik_detail($kode){
    	$this->db->where("kode_racik",$kode);
    	$q = $this->db->get("metode_racik");
    	return $q->row();
    }
    function simpanmetode_racik($action){
		$data = array(
			 		"kode_racik" 		=> $this->input->post("kode_racik"),
	       			"nama_racik" 		=> $this->input->post("nama_racik"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("metode_racik",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_racik", $this->input->post("kode_racik"));
				$this->db->update("metode_racik",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusmetode_racik($kode){
		$this->db->where("kode_racik",$kode);
		$this->db->delete("metode_racik");
		return "danger-Data berhasil dihapus";
	}
	function getklasifikasiobat(){
		$q = $this->db->get("klasifikasi_obat");
       	return $q;
    }
    function getdata_klasifikasi($page,$offset){
       	$cari = $this->session->userdata('cari_klasifikasi');
       	if ($cari!="") {
       		$this->db->like("nama_klasifikasi",$cari);
       		$this->db->or_like("kode_klasifikasi",$cari);
       	}
       	$q = $this->db->get("klasifikasi_obat",$page,$offset);
       	return $q;
    }
    function getklasifikasi_detail($kode){
    	$this->db->where("kode_klasifikasi",$kode);
    	$q = $this->db->get("klasifikasi_obat");
    	return $q->row();
    }
    function simpanklasifikasi($action){
		$data = array(
			 		"kode_klasifikasi"		=> $this->input->post('kode_klasifikasi'),
	       			"nama_klasifikasi" 		=> $this->input->post("nama_klasifikasi"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("klasifikasi_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_klasifikasi", $this->input->post("kode_klasifikasi"));
				$this->db->update("klasifikasi_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusklasifikasi($kode){
		$this->db->where("kode_klasifikasi",$kode);
		$this->db->delete("klasifikasi_obat");
		return "danger-Data berhasil dihapus";
	}
	function getsatuan_kecil(){
		$q = $this->db->get("satuan_obat");
       	return $q;
    }
    function getdata_satuankecil($page,$offset){
       	$cari = $this->session->userdata('cari_satuankecil');
       	if ($cari!="") {
       		$this->db->like("nama_satuan",$cari);
       		$this->db->or_like("kode_satuan",$cari);
       	}
       	$this->db->where("jenis_satuan","K");
       	$q = $this->db->get("satuan_obat",$page,$offset);
       	return $q;
    }
    function getsatuankecil_detail($kode){
    	$this->db->where("jenis_satuan","K");
    	$this->db->where("kode_satuan",$kode);
    	$this->db->where("jenis_satuan","B");
    	$q = $this->db->get("satuan_obat");
    	return $q->row();
    }
    function simpansatuan_kecil($action){
		$data = array(
			 		"kode_satuan" 		=> $this->input->post("kode_satuan"),
	       			"nama_satuan" 		=> $this->input->post("nama_satuan"),
	       			"jenis_satuan" 		=> "K",
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("satuan_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_satuan", $this->input->post("kode_satuan"));
				$this->db->update("satuan_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapussatuan_kecil($kode){
		$this->db->where("kode_satuan",$kode);
		$this->db->delete("satuan_obat");
		return "danger-Data berhasil dihapus";
	}
	function getdepoobat(){
		$q = $this->db->get("depo_obat");
       	return $q;
    }
    function getdata_depo($page,$offset){
       	$cari = $this->session->userdata('cari_depo');
       	if ($cari!="") {
       		$this->db->like("nama_depo",$cari);
       		$this->db->or_like("kode_depo",$cari);
       	}
       	$q = $this->db->get("depo_obat",$page,$offset);
       	return $q;
    }
    function getdepo_detail($kode){
    	$this->db->where("kode_depo",$kode);
    	$q = $this->db->get("depo_obat");
    	return $q->row();
    }
    function simpandepo($action){
		$data = array(
			 		"kode_depo" 		=> $this->input->post("kode_depo"),
	       			"nama_depo" 		=> $this->input->post("nama_depo"),
	        	);
		switch($action){
			case 'simpan' :
				$this->db->insert("depo_obat",$data);
				return "success-Data berhasil disimpan";
			break;
			case 'edit' :
				$this->db->where("kode_depo", $this->input->post("kode_depo"));
				$this->db->update("depo_obat",$data);
				return "info-Data berhasil diubah";
			break;
		}

	}
	function hapusdepo($kode){
		$this->db->where("kode_depo",$kode);
		$this->db->delete("depo_obat");
		return "danger-Data berhasil dihapus";
	}
	function getkode_obat(){
        for ($i=1;$i<=300000;$i++){
            $n = substr("00000".$i, -6, 6);
            $q = $this->db->get_where("farmasi_data_obat",array("kode"=>$n));

            if ($q->num_rows()<=0){
                return $n;
                break;
            }
        }
    }
}
?>