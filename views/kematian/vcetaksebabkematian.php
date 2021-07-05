<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
    
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
  </head>
<script>
    $(document).ready(function(){
        getttd_saksi();
        getttd_pernyataan();
        getttd_prm();
		window.print();
    });

    function getttd_prm(){
        var ttd = "<?php echo site_url('ttddokter/getttdprm/'.$q2->petugas_rm);?>";
        $('.getttd_prm').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_saksi(){
        var ttd = "<?php echo site_url('persetujuan/getttd_saksi/'.$no_reg.'/'.$no_pasien);?>";
        $('.getttd_saksi').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_pernyataan(){
        var ttd = "<?php echo site_url('persetujuan/getttd_pernyataan/'.$no_reg.'/'.$no_pasien);?>";
        $('.getttd_pernyataan').qrcode({width: 80,height: 80, text:ttd});
    }
</script>
    <?php        
        function tgl($tgl,$tipe){
            $month = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            $xmonth = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nop","Des");
            $hari = substr($tgl,0,10);
            $jam = substr($tgl,11,5);
            $m = (int)(substr($tgl,5,2));
            $tmp = substr($tgl,8,2)." ".$month[$m]." ".substr($tgl,0,4);
            if ($tipe == 1)
            {
                $tmp = $tmp." - ".$jam;
            }
            elseif ($tipe == 2)
            {
                $tmp = $tmp;
            }
            if (substr($tgl,0,4)=='0000')
            {
                return "";
            }
            else
            {
                return $tmp;
            }
        }


        $t1 = new DateTime('today');
        $t2 = new DateTime($q->tgl_lahir);
        $y  = $t1->diff($t2)->y;
        $m  = $t1->diff($t2)->m;
        $d  = $t1->diff($t2)->d;

        list($year,$month,$day) = explode("-",$q->tgl_lahir);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($month_diff < 0) { 
            $year_diff--;
            $month_diff *= (-1);
        }
        elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
        if ($day_diff < 0) { 
            $day_diff *= (-1);
        }
        $umur = $year_diff;

        $pernyataan     = explode(",", $q2->pernyataan);
        $pernyataan0    = $pernyataan[0];
        $pernyataan1    = $pernyataan[1];
        $pernyataan2    = $pernyataan[2];
        $pernyataan3    = $pernyataan[3];
        $pernyataan4    = $pernyataan[4];
    ?>
    <h5><b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI CIREBON</b></h5>
    <br>
    <br>
    <p align="right">RM 02 / RI / RSC</p>
    <table width="100%" class="laporan1" border="1">
        <tr>
            <th width="30%" rowspan="3" style="text-align: center;vertical-align: middle;">SEBAB KEMATIAN</th>
            <th width="15%">Nama </th>
            <td width="15%" colspan="4">: Elsa (P)</td>
            <th width="25%">No RM </th>
            <td width="15%">: 11987</td>
        </tr>
        <tr>
            <th>Umur</th>
            <td colspan="4">: 20 Tahun</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <th>Ruang </th>
            <td>: Eldia</td>
            <th>Kelas</th>
            <td colspan="2">: 3</td>
            <th>NO Reg </th>
            <td>: 2020110292819</td>
        </tr>
        <tr>
            <table class="laporan1" width="100%" border="1">
                <tr>
                    <td  width="30%" class="text-center">I</td>
                    <td>&nbsp;</td>
                    <td width="40%">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <p>a. penyakit atau keadaan yang langsung mengakibatkan kematian.</p>
                        <p>b. penyakit-penyakit (bila ada) yang menjadi lantaran timbulnya sebab kematian tersebut pada a dengan menyebut penyakit yang menjadi pokok pangkal terakhir.</p>
                        <p>c. .............</p>
                    </td>
                    <td>
                        <p>a. ..................</p>
                        <p>penyakit tersebut dalam ruang a disebabkan oleh (atau akibat dari)</p>
                        <p>b. ..................</p>
                        <p>penyakit tersebut dalam ruang b disebabkan oleh (atau akibat dari)</p>
                        <p>c. .................</p>

                    </td>
                    <td>
                        <p>Lamanya (kira-kira) mulai sakit hingga meninggal dunia: </p>
                        <p>.......................................................</p>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">II</td>
                    <td>&nbsp;</td>
                    <td >&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <p>Penyakit-penyakit lain yang berani dan mempengaruhi pula kematian itu tetapi tidak ada hubungannya dengan penyakit-penyakit tersebut dalam I a . b . c</p>
                    </td>
                    <td>
                        <p>............................................................</p>
                    </td>
                    <td>
                        <p>............................................................</p>
                    </td>
                </tr>
                <tr>
                    <table class="laporan2" width="100%" border="1">
                        <tr>
                            <td colspan="3">
                                <p>Keterangan khusus untuk :</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                1. <b>MATI KARENA RUDAPAKSA</b> (Volent Death)  
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a. Macam rudapaksa
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. Cara kejadian rudapaksa
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; c. Sifat jelas (kerusakan tubuh)
                            </td>
                            <td colspan="2" align="left">
                                &nbsp;
                                <br>
                                a. Bunuh diri- pembunuhan- kecelakaan
                                <br>
                                b. ..........
                                <br>
                                c. ..........
                            </td>
                        </tr>
                        <tr>
                            <td>
                                2. <b>KLAHIRAN MATI</b> (stillbrith)  
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a. Apakah ini janin lahir mati
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. Sebab kelahiran mati
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                ya/tidak
                                <br>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                3. <b>PERSALINAN KEHAMILAN</b>
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a. Apakah ini peristiwa persalinan
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. Apakah ini peristiwa kehamilan
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                ya/tidak
                                <br>
                                ya/tidak
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4. <b>OPERASI</b>
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a. Apakah disini dilakukan operasi
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. Jenis operasi
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                ya/tidak
                                <br>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <table class="laporan2" width="100%" border="1">
                        <tr>
                            <td>
                                Catatan :
                            </td>
                        </tr>
                    </table>
                </tr>
                <tr>
                    <table class="laporan2" width="100%" border="1">
                       <tr>
                            <td align="center" width="50%">
                            </td>
                            <td align="center" >
                                <b>Dokter</b>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                
                            </td>
                            <td align="center">
                                <div class="getttd_saksi"> </div>
                                <br>
                                <?php echo $q2->saksi ?>
                            </td>
                        </tr>
                    </table>
                </tr>
            </table>
        </tr>
    </table>
    <!-- tr>
                            
                                
                        </tr> -->
<style>
    *{
        padding-left : 5px;
        padding-right: 5px;
    }
    table, td,th{
        font-family: sans-serif;
        /*padding: 0px; margin:0px;*/
        /*font-size: 13px;*/
    }
    /*input.text{
        height:5px;
    }*/
</style>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan > thead > tr > th,
    .laporan > tbody > tr > th,
    .laporan > tfoot > tr > th,
    .laporan > thead > tr > td,
    .laporan > tbody > tr > td,
    .laporan > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .laporan > caption + thead > tr:first-child > th,
    .laporan > colgroup + thead > tr:first-child > th,
    .laporan > thead:first-child > tr:first-child > th,
    .laporan > caption + thead > tr:first-child > td,
    .laporan > colgroup + thead > tr:first-child > td,
    .laporan > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .laporan td,
    .laporan th {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }



    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }
    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }
    .laporan2 > thead > tr > th,
    .laporan2 > tbody > tr > th,
    .laporan2 > tfoot > tr > th,
    .laporan2 > thead > tr > td,
    .laporan2 > tbody > tr > td,
    .laporan2 > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
    }
    .laporan2 > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 0px solid #ddd;
    }
    .laporan2 > caption + thead > tr:first-child > th,
    .laporan2 > colgroup + thead > tr:first-child > th,
    .laporan2 > thead:first-child > tr:first-child > th,
    .laporan2 > caption + thead > tr:first-child > td,
    .laporan2 > colgroup + thead > tr:first-child > td,
    .laporan2 > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan2 > tbody + tbody {
        border-top: 0px solid #ddd;
    }
    .laporan2 td,
    .laporan2 th {
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }
</style>