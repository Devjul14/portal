<?php  
Class Buatopsi {

    function buat() {
        $this->dasar = array(1=>'satu','dua','tiga','empat','lima','enam',
        'tujuh','delapan','sembilan');

        $this->angka = array(1000000000,1000000,1000,100,10,1);
        $this->satuan = array('milyar','juta','ribu','ratus','puluh','');
    }

    function seleksi($nilai,$pilihan) {
    	$opsi = "";
		if (!(is_array($pilihan)))
		switch ($pilihan){
			case 'bulan' : $pilihan = array (1=>"Januari",2=>"Februari",3=>"Maret",4=>"April",5=>"Mei",6=>"Juni",7=>"Juli",8=>"Agustus",9=>"September",10=>"Oktober",11=>"November",12=>"Desember");
			break;
			case 'jeniskelamin' : $pilihan = $this->jeniskelamin();
			break;
			case 'statuskawin' : $pilihan = $this->statuskawin();
			break;
			case 'agama' : $pilihan = $this->agama();
			break;
			case 'golongandarah' : $pilihan = $this->golongandarah();
			break;
			case 'statuskerja' : $pilihan = $this->statuskerja();
			break;
			case 'tingkatpendidikan' : $pilihan = $this->tingkatpendidikan();
			break;
			case 'stratapendidikan' : $pilihan = $this->stratapendidikan();
			break;
			case 'kodekeluarga' : $pilihan = $this->kodekeluarga();
			break;
			case 'yatidak' : $pilihan = $this->yatidak();
			break;
			case 'jenispelanggaran' : $pilihan = $this->jenispelanggaran();
			break;
			case 'jenissk' : $pilihan = $this->jenissk();
			break;
			case 'jenishasil' : $pilihan = $this->jenishasil();
			break;
			case 'jenisnilai' : $pilihan = $this->jenisnilai();
			break;
			case 'jjoperator' : $pilihan = $this->jjoperator();
			break;
			case 'jjascdesc' : $pilihan = $this->jjascdesc();
			break;
			case 'jjabsen' : $pilihan = $this->jjabsen();
			break;
			case 'jns' : $pilihan = $this->jns();
			break;
			case 'hari' : $pilihan = $this->hari();
			break;
			case 'bln' : $pilihan = $this->bln();
			break;
			case 'level' : $pilihan = $this->level();
			break;
			case 'status' : $pilihan = $this->status();
			break;
			case 'perpindahan' : $pilihan = $this->perpindahan();
			break;
		}
		foreach ($pilihan as $key => $val) {
			$nilai == $key ? $sel = "selected" : $sel = "";
			$opsi .= "<option $sel value=\"$key\">$val</option>\n";
		}
		return $opsi;
    }
	function arrangenumber ($min, $max) {
		for ($i = $min; $i<=$max; $i++) {
			$y["$i"] = $i;
		}
    return $y;
	}
	function jeniskelamin(){
		$pilihan = array ("L"=>"Laki-laki","P"=>"Perempuan");
		return $pilihan;
	}
	function level(){
		$pilihan = array ("1"=>"Karyawan","2"=>"Dosen","3"=>"Karyawan dan Dosen");
		return $pilihan;
	}
	function perpindahan(){
		$pilihan = array ("Demosi"=>"Demosi","Promosi"=>"Promosi","Mutasi"=>"Mutasi","Rotasi"=>"Rotasi","Tetap"=>"Tetap");
		return $pilihan;
	}
	function status(){
		$pilihan = array ("Kopertis"=>"Kopertis","Yayasan"=>"Yayasan","Kontrak"=>"Kontrak","Luar Biasa"=>"Luar Biasa","NIDK"=>"NIDK");
		return $pilihan;
	}
	function statuskawin(){
		$pilihan = array ("T"=>"Tidak Kawin","K"=>"Kawin","D"=>"Duda","J"=>"Janda");
		return $pilihan;
	}
	function agama(){
		$pilihan = array ("-"=>"-","Islam"=>"Islam","Kristen"=>"Kristen","Hindu"=>"Hindu","Budha"=>"Budha");
		return $pilihan;
	}
	function golongandarah(){
		$pilihan = array("-"=>"-","A"=>"A","B"=>"B","O"=>"O","AB"=>"AB");
		return $pilihan;
	}
	function statuskerja(){
		$pilihan = array (""=>"--Pilih Status Kerja--",'DOSEN TETAP'=>'DOSEN TETAP','DOSEN PNS DPK'=>'DOSEN PNS DPK', 'DOSEN LUAR BIASA'=>'DOSEN LUAR BIASA','CALON DOSEN'=>'CALON DOSEN','TENAGA KEPENDIDIKAN'=>'TENAGA KEPENDIDIKAN','CALON TENAGA KEPENDIDIKAN'=>'CALON TENAGA KEPENDIDIKAN');
		return $pilihan;
	}
	function pensiun(){
		$pilihan = array (0=>'Aktif',1=>'Pensiun',2=>'Mengundurkan Diri',3=>'PHK',4=>'Meninggal');
		return $pilihan;
	}
	function tingkatpendidikan(){
		$pilihan = array("-","SD","SMP","SMA","D1","D2","D3","D4","S1","S2","S3");
		return $pilihan;
	}
	function stratapendidikan(){
		$pilihan = array("-"=>"-","SD"=>"SD","SMP"=>"SMP","SMA"=>"SMA","D1"=>"D1","D2"=>"D2","D3"=>"D3","D4"=>"D4","S1"=>"S1","S2"=>"S2","S3"=>"S3");
		return $pilihan;
	}
	function pendidikantingkat(){
		$pilihan = array("-"=>0,"SD"=>1,"SMP"=>2,"SMA"=>3,"D1"=>4,"D2"=>5,"D3"=>6,"D4"=>7,"S1"=>8,"S2"=>9,"S3"=>10);
		return $pilihan;
	}
	function kodekeluarga(){
		$pilihan = array ("TK"=>"TK","K"=>"K","K1"=>"K1","K2"=>"K2","K3"=>"K3","TK1"=>"TK1","TK2"=>"TK2","TK3"=>"TK3");
		return $pilihan;
	}
	function formatangka ($angka, $desimal=0, $lebar=0, $pad='kiri') {
		$PEMISAHDESIMAL = ',';
		$PEMISAHRIBUAN  = '.'; 
		$hasil = number_format($angka,$desimal,$PEMISAHDESIMAL,$PEMISAHRIBUAN);
		if ($lebar > 0) {
			if ($pad == "kiri") {
				$hasil = str_pad($hasil,$lebar," ",STR_PAD_LEFT);
			} else {
				$hasil = str_pad($hasil,$lebar," ");
			}
			$hasil = str_replace(" ","&nbsp;",$hasil);
		}
		return $hasil;
	}
	function yatidak(){
		$pilihan = array ("Tidak","Ya");
		return $pilihan;
	}
	function jenispelanggaran(){
		$pilihan = array ("SP1"=>"SP1","SP2"=>"SP2","SP3"=>"SP3","PHK"=>"PHK");
		return $pilihan;
	}
	function jenishasil(){
		$pilihan = array("Kurang","Cukup","Baik");
		return $pilihan;
	}
	function jenisnilai(){
		$pilihan = array ("A"=>"A","B"=>"B","C"=>"C","D"=>"D","E"=>"E");
		return $pilihan;
	}
	function jjoperator(){
		$pilihan = array("like"=>"Berisi","="=>"Sama Dengan",">"=>"Besar Dari","<"=>"Kecil Dari","<>"=>"Tidak Sama");
		return $pilihan;
	}
	function jjascdesc(){
		$pilihan = array("asc"=>"Naik","desc"=>"Turun");
		return $pilihan;
	}
	function jenissk(){
		$pilihan = array("Kurang","Cukup","Baik");
		return $pilihan;
	}
	function jjabsen(){
		$pilihan = array('Hadir','Cuti','Izin','Sakit','Tanpa Keterangan','Dinas Luar');
		return $pilihan;
	}
	function jns(){
		$pilihan = array ("0"=>"Hari Kerja","1"=>"Libur","2"=>"Libur Perusahaan","3"=>"Hari Raya");
		return $pilihan;
	}
	function hari(){
		$pilihan = array ("1"=>"Senin","2"=>"Selasa","3"=>"Rabu","4"=>"Kamis","5"=>"Jum'at","6"=>"Sabtu","0"=>"Minggu");
		return $pilihan;
	}
	function bln(){
		$pilihan = array ("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
		return $pilihan;
	}
}
?>