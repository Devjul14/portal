<?php  

/*  

* Class : Terbilang  

* Spell quantity numbers in Indonesian or Malay Language  

* author: huda m elmatsani, 21 September 2004, freeware  

*  

* example:  

* $bilangan = new Terbilang;  

* echo $bilangan->eja(12415);  

* result: dua belas ribu empat ratus lima belas  

*/  

Class Terbilang {

    function bilang() {
        $this->dasar = array(1=>'satu','dua','tiga','empat','lima','enam',
        'tujuh','delapan','sembilan');

        $this->angka = array(1000000000,1000000,1000,100,10,1);
        $this->satuan = array('milyar','juta','ribu','ratus','puluh','');
    }

    function eja($n) {
        $dasar = array(1=>'satu','dua','tiga','empat','lima','enam',
        'tujuh','delapan','sembilan');
        $angka = array(1000000000,1000000,1000,100,10,1);
        $satuan = array('milyar','juta','ribu','ratus','puluh','');
    $i=0;
	$str = "";
    while($n!=0){

        $count = (int)($n/$angka[$i]);

        if($count>=10) $str .= $this->eja($count). " ".$satuan[$i]." ";
        else if($count > 0 && $count < 10)
            $str .= $dasar[$count] . " ".$satuan[$i]." ";


            $n -= $angka[$i] * $count;
            $i++;
        }
        $str = preg_replace("/satu puluh (\w+)/i","\\1 belas",$str);
        $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i","se\\1",$str);


        return ucwords($str);
    }
}
?>