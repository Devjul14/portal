<!DOCTYPE html>
<html>
<head>
    
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
  </head>
<script>
    $(document).ready(function() {

    });
</script>
    <?php 
        if ($q) {
            $a = explode(",", $q->mata);
            $b = explode(",", $q->lain);
            $action ="edit";
        }else{

        }
        $t1 = new DateTime('today');
        $t2 = new DateTime($q->tgl_lahir);
        $y  = $t1->diff($t2)->y;
        $m  = $t1->diff($t2)->m;
        $d  = $t1->diff($t2)->d;
    ?>
    <label style="font-size : 13px">DATASEMEN KESEHATAN WILAYAH 03.04.03<br></label><label style="font-size: 13px;">RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</label>
    <center><strong><h4 style="margin-top:0px; margin-bottom: 0px;">LAPORAN OPERASI KATARAK DEWASA</h4></strong></center>
    <table border="1" width="100%" rules="rows" cellspacing="0" cellpadding="1">
        <tr>
            <th align="left">Nama</th>
            <td colspan="3"> : <?php echo $q->nama?></td>
            <th align="left">Umur</th>
            <td> : <?php echo $y."Tahun&nbsp;&nbsp;/&nbsp;&nbsp;".$q->jk?></td>
            <th align="left">Tanggal Operasi</th>
            <td> : <?php echo $q->tanggal?></td>
        </tr>
        <tr>
            <th align="left">Mata</th>
            <td>
                <label> <input type="checkbox" name="mata1" value="1"  <?php echo (($a[0] == "1") ? "checked" : "")?>>OD &nbsp;&nbsp;<?php echo $b[12]?></label>
            </td>
            <td colspan="2">
                <label><input type="checkbox" name="mata2" value="1" <?php echo (($a[1] == "1") ? "checked" : "")?>>OS&nbsp;&nbsp;<?php echo $b[13]?></label>
            </td>
            <th align="left">Operator</th>
            <td colspan="3">: <?php echo $q->nama_dokter?></td>
        </tr>
        <tr>
            <th align="left">Pemeriksa</th>
            <td colspan="3"> : <?php echo $q->nama_anastesi?></td>
            <th align="left">Asisten</th>
            <td colspan="3"> : <?php echo $q->nama_operasi?></td>
        </tr>
        <tr>
            <th align="left">Diagnosa Sementara</th>
            <td colspan="3"> : <?php echo $q->diagnosa?></td>
            <th align="left">Anesthesiologist</th>
            <td colspan="3"> : <?php echo $q->nama_danastesi?></td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th align="left">Ektaksi Lensa</th>
            <td>
                <label> <input type="checkbox" name="mata3" value="1" <?php echo (($a[2] == "1") ? "checked" : "")?>>Phaco</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata4" value="1" <?php echo (($a[3] == "1") ? "checked" : "")?>>SICS</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata5" value="1" <?php echo (($a[4] == "1") ? "checked" : "")?>>ECCE</label>
            </td>
        </tr>
        <tr>
            <th align="left">Anesthesi</th>
            <td>
                <label> <input type="checkbox" name="mata6" value="1" <?php echo (($a[5] == "1") ? "checked" : "")?>>Subtenon</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata7" value="1" <?php echo (($a[6] == "1") ? "checked" : "")?>>Topikal</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata8" value="1" <?php echo (($a[7] == "1") ? "checked" : "")?>>NU</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata9" value="1" <?php echo (($a[8] == "1") ? "checked" : "")?>>Peribulbar</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata10" value="1" <?php echo (($a[9] == "1") ? "checked" : "")?>>Lidocain 2%</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata11" value="1" <?php echo (($a[10] == "1") ? "checked" : "")?>>Murcain 0,5%</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata12" value="1" <?php echo (($a[11] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[0] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Akinese</th>
            <td>
                <label> <input type="checkbox" name="mata13" value="1" <?php echo (($a[12] == "1") ? "checked" : "")?>>O'Brien</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata14" value="1" <?php echo (($a[13] == "1") ? "checked" : "")?>>Van Lini</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata15" value="1" <?php echo (($a[14] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[1] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Flat Konungtiva</th>
            <td>
                <label> <input type="checkbox" name="mata16" value="1" <?php echo (($a[15] == "1") ? "checked" : "")?>>Basis Fomiks</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata17" value="1" <?php echo (($a[16] == "1") ? "checked" : "")?>>Basis Limbal</label>
            </td>
        </tr>
        <tr>
            <th align="left">Inssisi</th>
            <td>
                <strong><?php echo $b[2] ?>mm</strong>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata18" value="1" <?php echo (($a[17] == "1") ? "checked" : "")?>>Kornea</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata19" value="1" <?php echo (($a[18] == "1") ? "checked" : "")?>>Lambus</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata20" value="1" <?php echo (($a[19] == "1") ? "checked" : "")?>>Tanpa Jahitan</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata21" value="1" <?php echo (($a[20] == "1") ? "checked" : "")?>>Linier</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata22" value="1" <?php echo (($a[21] == "1") ? "checked" : "")?>>Frown</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata23" value="1" <?php echo (($a[22] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[3] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Alat</th>
            <td>
                <label> <input type="checkbox" name="mata24" value="1" <?php echo (($a[23] == "1") ? "checked" : "")?>>Pisau Bedah</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata25" value="1" <?php echo (($a[24] == "1") ? "checked" : "")?>>Silet</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata26" value="1" <?php echo (($a[25] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[4] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Diskesi lameter (Tunnel) Alat</th>
            <td>
                <label> <input type="checkbox" name="mata27" value="1" <?php echo (($a[26] == "1") ? "checked" : "")?>>Disc Blade</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata28" value="1" <?php echo (($a[27] == "1") ? "checked" : "")?>>Cressent knife</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata29" value="1" <?php echo (($a[28] == "1") ? "checked" : "")?>>One Port</label>
            </td>
        
            <td>
                <label><input type="checkbox" name="mata30" value="1" <?php echo (($a[29] == "1") ? "checked" : "")?>>Side Port</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata31" value="1" <?php echo (($a[30] == "1") ? "checked" : "")?>>Stab Knife</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata32" value="1" <?php echo (($a[31] == "1") ? "checked" : "")?>>Keratome knife</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata33" value="1" <?php echo (($a[32] == "1") ? "checked" : "")?>>Two Port</label>
            </td>
        </tr>
        <tr>
            <th align="left">Kapsulomi Anterior</th>
            <td>
                <label> <input type="checkbox" name="mata35" value="1" <?php echo (($a[35] == "1") ? "checked" : "")?>>Can Opener</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata36" value="1" <?php echo (($a[36] == "1") ? "checked" : "")?>>Cristmas Tree</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata37" value="1" <?php echo (($a[37] == "1") ? "checked" : "")?>>Linear</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata38" value="1" <?php echo (($a[38] == "1") ? "checked" : "")?>>C.C.C</label>
            </td>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata39" value="1" <?php echo (($a[39] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[6] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">EKEK -Espresi Nukleus</th>
            <td>
                <label> <input type="checkbox" name="mata40" value="1" <?php echo (($a[40] == "1") ? "checked" : "")?>>Teknik Bimanual</label>
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                <label><input type="checkbox" name="mata41" value="1" <?php echo (($a[41] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[7] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Lain - Lain</th>
            <td>
                <label> <input type="checkbox" name="mata42" value="1" <?php echo (($a[42] == "1") ? "checked" : "")?>>EKIK</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata43" value="1" <?php echo (($a[43] == "1") ? "checked" : "")?>>I - A</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata44" value="1" <?php echo (($a[44] == "1") ? "checked" : "")?>>CLE</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata45" value="1" <?php echo (($a[45] == "1") ? "checked" : "")?>>Kapsulomi Posterior</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata46" value="1" <?php echo (($a[46] == "1") ? "checked" : "")?>>Irdektomi Jam</label>
            </td>
            <td>
                <strong><?php echo $b[8] ?></strong>
            </td>
            <td>
                <label> <input type="checkbox" name="mata47" value="1" <?php echo (($a[47] == "1") ? "checked" : "")?>>Sinechiolysis</label>
            </td>
            </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata48" value="1" <?php echo (($a[48] == "1") ? "checked" : "")?>>Spinterotomi</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata49" value="1" <?php echo (($a[49] == "1") ? "checked" : "")?>>Jahitan Iris</label>
            </td>
            </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata50" value="1" <?php echo (($a[50] == "1") ? "checked" : "")?>>Virektomi Anterior</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata51" value="1" <?php echo (($a[51] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[9] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Cairan Irigasi</th>
            <td>
                <label> <input type="checkbox" name="mata52" value="1" <?php echo (($a[52] == "1") ? "checked" : "")?>>RL</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata53" value="1" <?php echo (($a[53] == "1") ? "checked" : "")?>>B.S.S</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata54" value="1" <?php echo (($a[54] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[10] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Fhaco</th>
            <td>
                <label> <input type="checkbox" name="mata55" value="1" <?php echo (($a[55] == "1") ? "checked" : "")?>>Metode 1 Tangan</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata56" value="1" <?php echo (($a[56] == "1") ? "checked" : "")?>>Metode 2 Tangan</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata57" value="1" <?php echo (($a[57] == "1") ? "checked" : "")?>>Cara BMB</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata58" value="1" <?php echo (($a[58] == "1") ? "checked" : "")?>>Cara BMD</label>
            </td>
        </tr>
        <tr>
            <th align="left">L.I.O</th>
            <td>
                <label> <input type="checkbox" name="mata60" value="1" <?php echo (($a[59] == "1") ? "checked" : "")?>>B.M.B</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata61" value="1" <?php echo (($a[60] == "1") ? "checked" : "")?>>B.M.D</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata62" value="1" <?php echo (($a[61] == "1") ? "checked" : "")?>>Diputar</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata63" value="1" <?php echo (($a[62] == "1") ? "checked" : "")?>>Tidak Diputar</label>
            </td>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata64" value="1" <?php echo (($a[63] == "1") ? "checked" : "")?>>Horizontal</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata65" value="1" <?php echo (($a[64] == "1") ? "checked" : "")?>>J Loop</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata66" value="1" <?php echo (($a[65] == "1") ? "checked" : "")?>>C Loop</label>
            </td>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata67" value="1" <?php echo (($a[66] == "1") ? "checked" : "")?>>Dilipat</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata68" value="1" <?php echo (($a[67] == "1") ? "checked" : "")?>>Sulcus Silindris</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata69" value="1" <?php echo (($a[68] == "1") ? "checked" : "")?>>Dalam Kantung Kapsul / In The Bag</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label><input type="checkbox" name="mata87" value="1" <?php echo (($a[86] == "1") ? "checked" : "")?>>Diluar Kantung Kapsul</label>
            </td>
            <td>
                
            </td>
            <td>
                <strong><?php echo $b[4] ?></strong>
            </td>
        </tr>
        <tr>
            <th align="left">Cairan Viskoclastik</th>
            <td>
                <label> <input type="checkbox" name="mata70" value="1" <?php echo (($a[69] == "1") ? "checked" : "")?>>Healon</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata71" value="1" <?php echo (($a[70] == "1") ? "checked" : "")?>>Viscoat</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata72" value="1" <?php echo (($a[71] == "1") ? "checked" : "")?>>Starvisc</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata73" value="1" <?php echo (($a[72] == "1") ? "checked" : "")?>>Catgel</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata74" value="1" <?php echo (($a[73] == "1") ? "checked" : "")?>>Survisc</label>
            </td>
            <td>
                <label><input type="checkbox" name="mata75" value="1" <?php echo (($a[74] == "1") ? "checked" : "")?>>Rohtovisc</label>
            </td>
        </tr>
        <tr>
            <th align="left">Benang</th>
            <td>
                <label> <input type="checkbox" name="mata76" value="1" <?php echo (($a[75] == "1") ? "checked" : "")?>>Vicry 8-0</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata77" value="1" <?php echo (($a[76] == "1") ? "checked" : "")?>>VGA 8-0</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata78" value="1" <?php echo (($a[77] == "1") ? "checked" : "")?>>Ethylon 10-0</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata79" value="1" <?php echo (($a[78] == "1") ? "checked" : "")?>>Dermalon 10-0</label>
            </td>
        </tr>
        <tr>
            <th align="left">TIO Pra Bedah</th>
            <td>
                <label> <input type="checkbox" name="mata80" value="1" <?php echo (($a[79] == "1") ? "checked" : "")?>><17,3 mmHg</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata81" value="1" <?php echo (($a[80] == "1") ? "checked" : "")?>>>20,6 mmHg</label>
            </td>
        </tr>
        <tr>
            <th align="left">Komplikasi</th>
            <td>
                <label> <input type="checkbox" name="mata82" value="1" <?php echo (($a[81] == "1") ? "checked" : "")?>>Tidak</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata83" value="1" <?php echo (($a[82] == "1") ? "checked" : "")?>>Ada</label>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <label> <input type="checkbox" name="mata84" value="1" <?php echo (($a[83] == "1") ? "checked" : "")?>>Prolaps Viterus</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata85" value="1" <?php echo (($a[84] == "1") ? "checked" : "")?>>Pendarahan</label>
            </td>
            <td>
                <label> <input type="checkbox" name="mata86" value="1" <?php echo (($a[85] == "1") ? "checked" : "")?>>Lain - Lain</label>
            </td>
            <td>
                <strong><?php echo $b[11] ?></strong>
            </td>
        </tr>
        
    </table>
    <table width="100%">
        <tr>
            <th align="left">Keterangan :</th>
        </tr>
            <th align="left">C.C.C</th>
            <th align="left">: Cintinous Curiviliner Capsul</th>
            <th align="left">CLE</th>
            <th align="left" colspan="2">: Clear Lens Extractive</th>
        </tr>
        <tr>
            <th align="left">EKEK</th>
            <th align="left">: Ekstraksi Katarak ekstra Kapsul</th>
            <th align="left">LIO</th>
            <th align="left" colspan="2">: Lensa Intra Okuler</th>
        </tr>
        <tr>
            <th align="left">EKIK</th>
            <th align="left" >: Ekstraksi Katarak Intra Kapsul</th>
            <th align="left">BMB</th>
            <th align="left" colspan="2">: Bilik Mata Belakang</th>
        </tr>
        <tr>
            <th align="left">I-A</th>
            <th align="left">: Irigasi Aspirasi</th>
            <th align="left">BMD</th>
            <th align="left">: Bilik Mata Depan</th>
        </tr>
    </table>
    <br>
    <div style="margin-left: 70%" align="center">
        <label>
            <stong>Operator
            <br><br><br>
            <?php echo $q->nama_dokter?></stong>
    </label>
    </div>
<style>
    *{
        padding-left : 5px;
        padding-right: 5px;
    }
    table, td,th{
        font-family: sans-serif;
        padding: 0px; margin:0px;
        font-size: 13px;
    }
    /*input.text{
        height:5px;
    }*/
</style>