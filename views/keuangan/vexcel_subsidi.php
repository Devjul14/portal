<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Kontribusi Dinas.xls");
    $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
?>
<table class="laporan" border=1 width="100%">
    <thead>
         <tr><th colspan="9" style="border:none;text-align:left" align="left">DEPARTEMEN KESEHATAN WILAYAH 03.04.03<br>RUMAH SAKIT TINGKAT III 03.06.01 CIREBON</th></tr>
         <tr><th colspan="9" style="border:none;text-align:center" align="center">SUBSIDI RUMAH SAKIT KEPADA PASIEN DINAS<br>PERIODE : <?php echo $bulan[(int)date("m",strtotime($tgl))]." ".date("Y",strtotime($tgl)); ?></th></tr>
        <tr><th colspan="9" style="border:none;text-align:center" align="center">&nbsp;</th></tr>
        <tr class="bg-navy">
            <th align="center;vertical-align:middle" align="center" rowspan="3">No.</th>
            <th align="center;vertical-align:middle" align="center" rowspan="3" width="200px">Uraian</th>
            <th align="center;vertical-align:middle" align="center" rowspan="3">Jumlah Pasien Dinas</th>
            <th align="center;vertical-align:middle" align="center" colspan="4">Subsidi Rumah Sakit</th>
            <th align="center;vertical-align:middle" align="center" rowspan="2" colspan="2">Jumlah</th>
        </tr>
        <tr class="bg-navy">
            <th align="center" colspan="2">Selisih Tarif RS dengan Tarif INA-CBG's</th>
            <th align="center" colspan="2">Pasien Yang Tidak Bisa Diklaim Ke BPJS (INA-CBG's)</th>
        </tr>
        <tr class="bg-navy">
            <th align="center;vertical-align:middle" align="center">Pasien (orang)</th>
            <th align="center;vertical-align:middle" align="center">Jumlah (Rp)</th>
            <th align="center;vertical-align:middle" align="center">Pasien (orang)</th>
            <th align="center;vertical-align:middle" align="center">Jumlah (Rp)</th>
            <th align="center;vertical-align:middle" align="center">Pasien (orang) (4+6)</th>
            <th align="center;vertical-align:middle" align="center">Jumlah (Rp) (5+7)</th>
        </tr>
        <tr class="bg-navy">
            <th align="center" align="center">1</th>
            <th align="center" align="center">2</th>
            <th align="center" align="center">3</th>
            <th align="center" align="center">4</th>
            <th align="center" align="center">5</th>
            <th align="center" align="center">6</th>
            <th align="center" align="center">7</th>
            <th align="center" align="center">8</th>
            <th align="center" align="center">9</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center"></td>
            <td>Bulan <?php echo $bulan[(int)date("m",strtotime($tgl))]." ".date("Y",strtotime($tgl)); ?></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="right"></td>
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Rawat Jalan</td>
            <td align="center"><?php echo round($q["total_ralan"],0);?></td>
            <td align="center"><?php echo round($q["nondinas_ralan"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["nondinas_ralan"]["rupiah"],0);?></td>
            <td align="center"><?php echo round($q["dinas_ralan"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["dinas_ralan"]["rupiah"],0);?></td>
            <td align="center"><?php echo round($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"],0);?></td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Rawat Inap</td>
            <td align="center"><?php echo round($q["total_inap"],0);?></td>
            <td align="center"><?php echo round($q["nondinas_inap"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["nondinas_inap"]["rupiah"],0);?></td>
            <td align="center"><?php echo round($q["dinas_inap"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["dinas_inap"]["rupiah"],0);?></td>
            <td align="center"><?php echo round($q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0);?></td>
        </tr>
        <tr>
            <td align="center"></td>
            <td>Jumlah</td>
            <td align="center"><?php echo round($q["total_ralan"]+$q["total_inap"],0);?></td>
            <td align="center"><?php echo round($q["nondinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["nondinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"],0);?></td>
            <td align="center"><?php echo round($q["dinas_ralan"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["dinas_ralan"]["rupiah"]+$q["dinas_inap"]["rupiah"],0);?></td>
            <td align="center"><?php echo round($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></td>
            <td align="right"><?php echo round($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0);?></td>
        </tr>
        <tr>
            <th align="center">&nbsp;</th>
            <th>&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="right">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="right">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="right">&nbsp;</th>
        </tr>
        <tr>
            <th align="center"></th>
            <th>Total</th>
            <th align="center"><?php echo round($q["total_ralan"]+$q["total_inap"],0);?></th>
            <th align="center"><?php echo round($q["nondinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"],0);?></th>
            <th align="right"><?php echo round($q["nondinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"],0);?></th>
            <th align="center"><?php echo round($q["dinas_ralan"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
            <th align="right"><?php echo round($q["dinas_ralan"]["rupiah"]+$q["dinas_inap"]["rupiah"],0);?></th>
            <th align="center"><?php echo round($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
            <th align="right"><?php echo round($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0);?></th>
        </tr>
    </tbody>
</table>