<?php
Class fungsi {
	function angka2bulan ($angka, $pendek = false) {
	    $namabulan = array('','Januari','Februari','Maret','April',
	                       'Mei','Juni','Juli','Agustus',
	                       'September','Oktober','November','Desember');
	    if ($pendek) {
	        return substr($namabulan[$angka],0,3);
	    } else {
	        return $namabulan[$angka];
	    }
	}
    function angka2hari ($angka, $pendek = false) {
        $namahari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
        if ($pendek) {
            return substr($namahari[$angka],0,3);
        } else {
            return $namahari[$angka];
        }
    }
	function buatkalender($bulan, $tahun,$data = array(), $paramkal = array(), $paramtgl = array()){
        list($tgls,$blns,$thns) = explode("-",date("j-n-Y"));
        $ts = mktime(1,1,1,$bulan,1,$tahun);
        $hp = date("w",$ts);
        $jh = date("t",$ts);
        $lebarkal = "";
        $nh = array("M","S","S","R","K","J","S");
        $kosong = "";
        if (isset($paramkal["lebar"])) $lebarkal = 'width="' . $paramkal["lebar"] . '"';
        if (isset($paramkal["namahari"])) {
            if ($paramkal["namahari"] == "singkat") {
                $nh = array("MIN","SEN","SEL","RAB","KAM","JUM","SAB");
            }
            if ($paramkal["namahari"] == "panjang") {
                $nh = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
            }
        }
        if (isset($paramkal["kosong"])) $kosong = $paramkal["kosong"];
        $c  = '<table class="table table-bordered" ' . $lebarkal . '>' . "\n";
        $c .= '<tr class="bg-orange text-center text-bold">' . "\n";
        $c .= '<td width="10%">' . $nh[0] . '</td>';
        $c .= '<td width="15%">' . $nh[1] . '</td>';
        $c .= '<td width="15%">' . $nh[2] . '</td>';
        $c .= '<td width="15%">' . $nh[3] . '</td>';
        $c .= '<td width="15%">' . $nh[4] . '</td>';
        $c .= '<td width="15%">' . $nh[5] . '</td>';
        $c .= '<td width="15%">' . $nh[6] . '</td>';
        $c .= '</tr>' . "\n";
        $k = 0;
        while ($k < $hp) {
            if ($k == 0) {
                $c .= "<tr>\n";
            }
            $c .= "<td>&nbsp;</td>\n";
            $k++;
        }
        for ($i = 1; $i <= $jh; $i++) {
            if ($k == 0) {
                $c .= "<tr>\n";
            }
            $class = 'class="bg-info text-right"';
            $label = 'label-info';
            if ($k == 0) {
                $class = 'class="bg-danger text-right"';
                $label = 'label-danger';
            }
            if (isset($paramtgl[$i])) {
                switch ($paramtgl[$i]) {
                    case 1 : $class = 'class="bg-danger text-right"'; $label = 'label-warning'; break;
                }
            }
            if ($i == $tgls && $bulan == $blns && $tahun == $thns) {
                $class = 'class="bg-success text-right"';
                $label = 'label-success';
            }
            $c .= "<td valign=\"top\" $class><p class='label $label'>" . $i . "</p>";
            if (isset($data[$i])) {
                $c .= "<br>\n";
                $c .= $data[$i];
            } elseif ($kosong != "") {
                $c .= "<br>\n";
                $c .= $kosong;
            }
            $c .= "</td>\n";
            $k++;
            if ($k > 6) {
                $c .= "</tr>\n";
                $k = 0;
            }
        }
        if ($k != 0) {
            $c .= "</tr>\n";
        }
        $c .= "</table>\n";
        return $c;
    }
    function detik2pecahan ($detik, $panjang = 2, $pakaitanda = false) {
	    $detik < 0 ? $tanda = "-" : $tanda = "+";
	    $detik = abs($detik);
	    $j = 0;
	    $m = 0;
	    if ($detik > 3599) {
	        $j = floor($detik / 3600);
	        $detik = $detik % 3600;
	    }
	    if ($detik > 59) {
	        $m = floor($detik / 60);
	        $detik = $detik % 60;
	    }
	    $d = $detik;
	    $j = str_pad($j,2,'0',STR_PAD_LEFT);
	    $m = str_pad($m,2,'0',STR_PAD_LEFT);
	    $d = str_pad($d,2,'0',STR_PAD_LEFT);
	    if ($panjang == 1) {
	        $waktu = $j;
	    } elseif ($panjang == 2) {
	        $waktu = $j . ':' . $m;
	    } else {
	        $waktu = $j . ':' . $m . ':' . $d;
	    }
	    if ($pakaitanda) $waktu = $tanda . $waktu;
	    return $waktu;
	}
    function apakahmasadepan($tanggal) {
        $jawab = false;
        list($thns,$blns,$tgls) = explode(" ",date("Y n j"));
        list($thn,$bln,$tgl) = explode("-",$tanggal);
        if ($thn > $thns) {
            $jawab = true;
        } elseif ($thn == $thns && $bln > $blns) {
            $jawab = true;
        } elseif ($thn == $thns && $bln == $blns && $tgl > $tgls) {
            $jawab = true;
        }
        return $jawab;
    }
    function hitunghakcuti ($nip) {
        $hakcuti = 10;
        return $hakcuti;
    }
    function hitungjamlembur ($jamaktual, $jenishari) {
        $jamkalkulasi = 0;
        switch ($jenishari) {
    
            case 0 : /* hari kerja */
            if ($jamaktual > 1) {
                $jamkalkulasi = 1.5 + (($jamaktual - 1) * 2);
            } else {
                $jamkalkulasi = $jamaktual * 1.5;
            }
            break;
    
            case 1 : /* hari libur / minggu */
            if ($jamaktual > 8) {
                $jamkalkulasi = 17 + (($jamaktual - 8) * 4);
            } elseif ($jamaktual > 7) {
                $jamkalkulasi = 14 + (($jamaktual - 7) * 3);
            } else {
                $jamkalkulasi = $jamaktual * 2;
            }
            break;
    
            case 2 : /* hari libur di hari sabtu (hari kerja pendek) */
            if ($jamaktual > 6) {
                $jamkalkulasi = 13 + (($jamaktual - 6) * 4);
            } elseif ($jamaktual > 5) {
                $jamkalkulasi = 10 + (($jamaktual - 5) * 3);
            } else {
                $jamkalkulasi = $jamaktual * 2;
            }
            break;
    
            case 3 : /* hari raya */
            if ($jamaktual > 7) {
                $jamkalkulasi = 21 + (($jamaktual - 7) * 4);
            } else {
                $jamkalkulasi = $jamaktual * 3;
            }
            break;
    
            case 4 : /* hari raya di hari sabtu (hari kerja pendek) */
            if ($jamaktual > 5) {
                $jamkalkulasi = 15 + (($jamaktual - 5) * 4);
            } else {
                $jamkalkulasi = $jamaktual * 3;
            }
            break;
    
        }
    
        return $jamkalkulasi;
    
    }
}
?>