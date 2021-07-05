<!DOCTYPE html>
<html>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
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
	<script>
		window.print();
	</script>
<body>
    <div class="margin">
    <table  width="100%" class="header-laporan" border="0">
        <tr>
            <td class="text-center" colspan="2">
                <h3>LAPORAN HARIAN COVID-19</h3>
            </td>
            <td></td>
        </tr>
        <tr><td width=150px>PETUGAS</td><td>: CITRA NURULRAMDHINI</td></tr>
        <tr><td>PUSKESMASI/ RS</td><td>: RS CIREMAI</td></tr>
        <tr><td>PERIODE</td><td>: <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
        <!-- <tr><td>TAHUN</td><td>: <?php echo date("Y",strtotime($tgl1))?></td></tr> -->
    </table>
    <table class="laporan" border=1 width="100%">
        <thead class="bg-gray">
            <tr>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">No.</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:220px'>Nama</div></th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:130px'>Ayah/ Pasangan</div></th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:100px'>Umur</div></th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">JK</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">HP</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">NIK</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">Pekerjaan</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:300px'>Alamat</div></th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">Kelurahan</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">Kecamatan</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3">ODP/PDP/POSITIF</th>
                <th class="text-center" style='vertical-align: middle;' colspan='3'>RIWAYAT PERJALANAN</th>
                <th class="text-center" style='vertical-align: middle;' colspan='5'>KELUHAN</th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:300px'>HASIL PENUNJANG</div></th>
                <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:300px'>KETERANGAN</div></th>
            </tr>
            <tr>                            
                <th class="text-center" style="vertical-align: middle;" rowspan="2">NEGARA/DAERAH</th>
                <th class="text-center" style="vertical-align: middle;" colspan="2">TANGGAL</th>
                <th class="text-center" style="vertical-align: middle;">DEMAM</th>
                <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>PANAS</div></th>
                <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>BATUK</div></th>
                <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>PILEK</div></th>
                <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>SESAK</div></th>
            </tr>
            <tr>
                <th class="text-center" style="vertical-align: middle;"><div style='width:100px'>PERGI</div></th>
                <th class="text-center" style="vertical-align: middle;"><div style='width:100px'>PULANG</div></th>
                <th class="text-center" style="vertical-align: middle;">TEMPERATUR</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                foreach ($n->result() as $row){
                    echo "<tr>";
                    echo "<td>".($i++)."</td>";
                    echo "<td>".$row->nama_pasien."<br>Tgl Masuk ".date("d-m-Y",strtotime($row->tanggal))."<br>Jam : ".$row->jam."</td>";
                    if ($row->hubungan_keluarga==1){
                        $kk = $row->nama_pasien;
                    } else 
                    if ($row->hubungan_keluarga==2){
                        $kk = $row->nama_pasangan;
                    } else {
                        if ($row->jenis_kelamin=="L")
                            $kk = $row->nama_pasien;
                        else {
                            $kk = $row->nama_pasangan;
                        }
                    } 
                    echo "<td>".$kk."</td>";
                    list($year,$month,$day) = explode("-",$row->tgl_lahir);
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
                    $umur = $year_diff." tahun ".$month_diff." bulan ".$day_diff." hari ";
                    echo "<td>".$umur."</td>";
                    echo "<td class='text-center'>".$row->jenis_kelamin."</td>";
                    echo "<td>".$row->telpon."</td>";
                    echo "<td>".$row->ktp."</td>";
                    echo "<td>".$row->pekerjaan."</td>";
                    echo "<td>".$row->alamat."</td>";
                    echo "<td>".$row->kelurahan."</td>";
                    echo "<td>".$row->kecamatan."</td>";
                    echo "<td class='text-center'>".$row->status."</td>";
                    echo "<td>".$row->province." ".$row->kota."</td>";
                    $t = explode(",", $row->tglresiko);
                    echo "<td>".$t[0]."</td>";
                    echo "<td>".$t[1]."</td>";
                    echo "<td class='text-center'>".$row->suhu." °C</td>";
                    $k = explode(",", $row->tglgejala);
                    echo "<td>".$k[1]."</td>";
                    echo "<td>".$k[2]."</td>";
                    echo "<td>".$k[3]."</td>";
                    echo "<td>".$k[4]."</td>";
                    echo "<td>";
                    if (isset($p["rad"][$row->no_reg])){
                        echo "<b>Radiologi</b><br>";
                        echo $p["rad"][$row->no_reg]->hasil_pemeriksaan;
                        echo "<br><br>";
                    }
                    if ($p["lab"][$row->no_reg]->num_rows()>0){
                        echo "<b>Lab</b><br>";
                        $sdata="";
                        $i=1;$n=1;
                        $judul = $namaanalys = $nip_dokter = $nama_dokter = "";
                        $nama_tindakan ="";
                        echo '<table cellspacing="2" cellpadding="1"  width="100%" align="right"border="0">
                                <tr>
                                    <th align="left" width="210"><strong>Jenis Pemeriksaan <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
                                    <th align="left"><strong>Hasil <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
                                </tr>';
                        foreach ($p["lab"][$row->no_reg]->result() as $row){
                            $merah = "";
                            $hasil = (float)$row->hasil;
                            if ($row->min_kritis!=""){
                                if ($hasil<=$row->min_kritis)
                                    $merah = "red";
                            }
                            if ($row->max_kritis!=""){
                                if ($hasil>=$row->max_kritis)
                                    $merah = "red";
                            }
                            if ($row->jenis_kelamin=="L") {
                                $rujukan = $row->pria;
                            } else {
                                $rujukan = $row->wanita;
                            }
                            if ($judul!=$row->judul){
                                $i = 1;
                                echo "<tr>";
                                echo "<td colspan='2'>".$row->judul."</td>";
                                echo "<tr>";
                            }
                            echo "<tr>";
                            echo "<td align='left'>&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;".$row->nama."</td>";
                            echo "<td align='left'><label class='text-".$merah."'>".$row->hasil."&nbsp;".$row->satuan."</label></td>";
                            echo "</tr>";
                            $judul = $row->judul;
                            $i++;   
                        }
                        echo "</table>";
                    }
                    echo "</td>";
                    echo "<td>";
                    if (isset($p["ket"][$row->no_reg])){
                        echo ($row->td=="" ? "" : "TD ka : ".$row->td." mmHg"); 
                        echo ($row->td2=="" ? "" : "<br>TD ki : ".$row->td2." mmHg"); 
                        echo ($row->nadi=="" ? "" : "<br>Nadi : ".$row->nadi." x/ mnt"); 
                        echo ($row->respirasi=="" ? "" : "<br>Respirasi : ".$row->respirasi." x/ mnt");
                        echo ($row->suhu=="" ? "" : "<br>Suhu : ".$row->suhu." °C");
                        echo ($row->spo2=="" ? "" : "<br>SpO2 : ".$row->spo2." %");
                        echo ($p["ket"][$row->no_reg]->bb!="" ? "<br>BB : ".$p["ket"][$row->no_reg]->bb." kg" : "");
                        echo ($p["ket"][$row->no_reg]->tb!="" ? "<br>TB : ".$p["ket"][$row->no_reg]->tb." cm" : "");
                        echo ($p["ket"][$row->no_reg]->s!="" ? "<br>S : <br>".$p["ket"][$row->no_reg]->s : "");
                        echo ($p["ket"][$row->no_reg]->o!="" ? "<br>O : <br>".$p["ket"][$row->no_reg]->o : "");
                        echo ($p["ket"][$row->no_reg]->a!="" ? "<br>A : <br>".$p["ket"][$row->no_reg]->a : "");
                        echo ($p["ket"][$row->no_reg]->p!="" ? "<br>P : <br>".$p["ket"][$row->no_reg]->p : "");
                    } "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
<style type="text/css">
    .laporan th,
    .laporan td {
        padding: 10px;
    }
    .header-laporan th,
    .header-laporan td {
        padding: 4px 4px 4px 0px;
    }
    .laporan td{
        vertical-align: top;
    }
</style>
</html>