<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url(); ?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url(); ?>js/html2canvas.js"></script>
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />
</head>
<table class="no-border" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td rowspan="2" align="left" style="vertical-align:middle">
            <img src="<?php echo base_url("img/Logo.png") ?>">
        </td>
        <td>
            <h2>PERSONIL RUMAH SAKIT TK III CIREMAI CIREBON </h2>
        </td>

    </tr>
</table>

<table class="table-julia">
    <tr>
        <td><b>Riwayat Hidup Pegawai</b><br><b>Data Pokok</b></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;NIP / NRP<span style="float:right">:</td>
        <td><?php echo $p->id_perawat; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Nama<span style="float:right">:</td>
        <td><?php echo $p->nama_perawat; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Tempat / Tanggal Lahir<span style="float:right">:</td>
        <td><?php echo $p->tgl_lahir; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Jenis Kelamin<span style="float:right">:</td>
        <td><?php echo $p->jenis_kelamin; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Pangkat / Gol<span style="float:right">:</td>
        <td><?php echo $p->id_pangkat; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;TMT Pangkat<span style="float:right">:</td>
        <td><?php echo $p->tmt; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;CPNS TMT<span style="float:right">:</td>
        <td><?php echo $pkt->row()->tmt; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;CPNS SK<span style="float:right">:</td>
        <td><a href='<?php echo base_url()."file_pdf/suket/".$pns->row()->filepdf; ?>' target='blank'><?php echo base_url()."file_pdf/suket/".$pns->row()->filepdf; ?></a></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;TNI / PNS TMT<span style="float:right">:</td>
        <td><?php echo $p->tmt; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;TNI / PNS SK<span style="float:right">:</td>
        <td><a href='<?php echo base_url()."file_pdf/suket/".$awl->row()->filepdf; ?>' target='blank'><?php echo base_url()."file_pdf/suket/".$awl->row()->filepdf; ?></a></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Agama<span style="float:right">:</td>
        <td><?php echo $p->agama; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Jenis Pegawai<span style="float:right">:</td>
        <td><?php echo $p->jenistenaga; ?></td>
    </tr>
    </table>

<table class="no-border" width="100%">
    <tr>
        <td><b>No. Identitas</b></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;No KTA<span style="float:right">:</td>
        <td><?php echo $p->no_kta; ?></td>
        <td>&nbsp;&nbsp;No KARIS/KARSU<span style="float:right">:</td>
        <td><?php echo $p->no_karis; ?></td> 
    </tr>
    <tr>
       <td>&nbsp;&nbsp;No LABEL<span style="float:right">:</td>
        <td><?php echo $p->no_label; ?></td>
        <td>&nbsp;&nbsp;No KTPA(ASABRI)<span style="float:right">:</td>
        <td><?php echo $p->no_ktpa; ?></td> 
    </tr>
    <tr>
       <td>&nbsp;&nbsp;No KARPEG(PNS)<span style="float:right">:</td>
        <td><?php echo $p->no_pns; ?></td>
        <td>&nbsp;&nbsp;No KARATU(KPI)<span style="float:right">:</td>
        <td><?php echo $p->no_kpi; ?></td>  
    </tr>
    <tr>
        <td>&nbsp;&nbsp;No NPWP<span style="float:right">:</td>
        <td><?php echo $p->npwp; ?></td>
        <td>&nbsp;&nbsp;No REGISTRASI<span style="float:right">:</td>
        <td><?php echo $p->no_regis; ?></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;No KTP<span style="float:right">:</td>
        <td><?php echo $p->ktp; ?></td>
        <td>&nbsp;&nbsp;No Randis<span style="float:right">:</td>
        <td><?php echo $p->no_randis; ?></td>
    </tr>
    <tr>
       <td>&nbsp;&nbsp;No BPJS<span style="float:right">:</td>
        <td><?php echo $p->no_bpjs; ?></td>
    </tr>
    <tr>
       <td><b>Data Lain-lain</b></td>
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Status Kawin<span style="float:right">:</td>
        <td><?php echo $p->kawin; ?></td>
        <td>&nbsp;&nbsp;Suku<span style="float:right">:</td>
        <td><?php echo $p->suku; ?></td> 
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Alamat<span style="float:right">:</td>
        <td><?php echo $p->alamat; ?></td>
        <td>&nbsp;&nbsp;Telepon<span style="float:right">:</td>
        <td><?php echo $p->no_telepon; ?></td> 
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Kode Pos<span style="float:right">:</td>
        <td><?php echo $p->kode_pos; ?></td>
        <td>&nbsp;&nbsp;Telepon<span style="float:right">:</td>
        <td><?php echo $p->no_telepon; ?></td>  
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Email<span style="float:right">:</td>
        <td><?php echo $p->email; ?></td>
    </tr>
    <tr>
       <td><b>Data Fisik</b></td>
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Tinggi / Berat Badan<span style="float:right">:</td>
        <td><?php echo $p->tb; ?>/<?php echo $p->bb; ?></td>
        <td>&nbsp;&nbsp;Bentuk Muka<span style="float:right">:</td>
        <td><?php echo $p->bentuk_muka; ?></td> 
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Ukuran Peci<span style="float:right">:</td>
        <td><?php echo $p->peci; ?></td>
        <td>&nbsp;&nbsp;Jenis Rambut<span style="float:right">:</td>
        <td><?php echo $p->jenis_rambut; ?></td> 
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Ukuran Baju<span style="float:right">:</td>
        <td><?php echo $p->baju; ?></td>
        <td>&nbsp;&nbsp;Warna Rambut<span style="float:right">:</td>
        <td><?php echo $p->warna_rambut; ?></td>  
    </tr>
    <tr>
       <td>&nbsp;&nbsp;Ukuran Sepatu<span style="float:right">:</td>
        <td><?php echo $p->sepatu; ?></td>
        <td>&nbsp;&nbsp;Golongan Darah<span style="float:right">:</td>
        <td><?php echo $p->gol_darah; ?></td> 
    </tr>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Riwayat Pangkat</b></td>
    </tr>
    <t>
       <td>No</td>
       <td>Pangkat</td> 
       <td>TMT Pangkat</td>
       <td>No SKEP / KEP</td>
       <td>TGL SKEP</td>
    </tr>
    <?php
    $i=0;
    foreach ($pkt->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->id_pangkat."</td>
        <td>".$data->tmt."</td>
        <td>".$data->sk_no."</td>
        <td>".$data->sk_tgl."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Riwayat Jabatan</b></td>
    </tr>
    <tr>
       <td>No</td>
       <td>Jabatan / Unit Kerja</td> 
       <td>TMT Jabatan</td>
       <td>No SKEP / KEP</td>
       <td>TGL SKEP</td>
    </tr>
    <?php
    $i=0;
    foreach ($jab->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->nama_jabatan."</td>
        <td>".$data->tmt."</td>
        <td>".$data->no_kep."</td>
        <td>".$data->tgl_skep."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Riwayat Pendidikan Umum</b></td>
    </tr>
    <tr>
       <td>No</td>
       <td>Tahun Lulus</td> 
       <td>Tempat</td>
       <td>Pendidikan</td>
       <td>No Ijasah</td>
    </tr>
    <?php
    $i=0;
    foreach ($pend->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->tahun."</td>
        <td>".$data->nama_sekolah."</td>
        <td>".$data->nama_pendidikan."</td>
        <td>".$data->no_ijasah."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Riwayat Diklat Struktural</b></td>
    </tr>
    <tr>
       <td>No</td>
       <td>Tahun</td> 
       <td>Nama Pelatihan</td>
       <td>Nomor</td>
       <td>Tanggal</td>
    </tr>
    <?php
    $i=0;
    foreach ($dik->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->tahun."</td>
        <td>".$data->diklat."</td>
        <td>".$data->nomor."</td>
        <td>".$data->tanggal."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Riwayat Kursus</b></td>
    </tr>
    <tr>
       <td>No</td>
       <td>Tahun</td> 
       <td>Nama Pelatihan</td>
       <td>No Sertifikat</td>
       <td>Penyelenggara</td>
       <td>JP</td>
       <td>Tanggal</td>
    </tr>
    <?php
    $i=0;
    foreach ($kur->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->tahun."</td>
        <td>".$data->nama."</td>
        <td>".$data->sk_no."</td>
        <td>".$data->penyelenggara."</td>
        <td>".$data->jam."</td>
        <td>".$data->tanggal."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Riwayat Pendidikan Militer</b></td>
    </tr>
    <tr>
       <td>No</td>
       <td>Tahun</td> 
       <td>Nama Pelatihan</td>
       <td>Nomor</td>
       <td>Tanggal</td>
    </tr>
    <?php
    $i=0;
    foreach ($m->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->tahun."</td>
        <td>".$data->militer."</td>
        <td>".$data->nomor."</td>
        <td>".$data->tanggal."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Riwayat Penugasan</b></td>
    </tr>
    <tr>
       <td>No</td>
       <td>Tahun</td> 
       <td>Lokasi</td>
       <td>Uraian</td>
    </tr>
    <?php
    $i=0;
    foreach ($pg->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->tahun."</td>
        <td>".$data->kota."</td>
        <td>".$data->uraian."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
       <td><b>Keluarga</b></td>
    </tr>
    <tr>
       <td>No</td>
       <td>NIK</td> 
       <td>Nama</td>
       <td>JK</td>
       <td>Hubungan</td>
       <td>TTL</td>
    </tr>
    <?php
    $i=0;
    foreach ($kel->result() as $data) {
        $i++;
        echo "<tr>
        <td>".$i."</td>                                        
        <td>".$data->nik."</td>
        <td>".$data->nama."</td>
        <td>".$data->jenis_kelamin."</td>
        <td>".$data->hubungan."</td>
        <td>".$data->tempat_lahir."/".$data->tgl_lahir."</td>
        </tr>
        ";
    }
    ?>
</table>
<table class="no-border" width="100%">
    <tr>
        <td align="center">
             Mengetahui
        </td>
        <td align="center">
             Tanggal <?php echo date("d-m-Y"); ?>
        </td>
    </tr>
    <tr>
        <td align="center">
            Kepala Rumah Sakit
        </td>
        <td align="center">
            Yang Bersangkutan
        </td>
    </tr>
    <tr>
        <td align="center">
            <div class="dokter_qrcode" align="center"> </div>
            <br>
            <br>
            <br>
           <?php echo $rs->karumkit; ?>
            <br>
            <?php echo $rs->pangkat; ?> NRP.<?php echo $rs->nrp; ?>
        </td>
       
        <td align="center">
            <div class="dokter_qrcode" align="center"> </div>
            <br>
            <br>
            <br>
            <?php echo $p->nama_perawat ?>
            <br>
            <?php echo $p->pangkat ?> NIP.<?php echo $p->id_perawat ?>
        </td>
    </tr>
</table>
<style type="text/css">
    * {
        padding-left: 5px;
        padding-right: 5px;
    }
    table,
    p {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    th {
        font-family: sans-serif;
        /*padding: 0px; margin:0px;*/
        /*font-size: 13px;*/
    }

    .no-border {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .no-border {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    .table-julia {
        padding: 8px;
        margin-bottom: 20px;
        line-height: 30px;
        font-size: 12px;
    }

    .no-border>thead>tr>th,
    .no-border>tbody>tr>th,
    .no-border>tfoot>tr>th,
    .no-border>thead>tr>td,
    .no-border>tbody>tr>td,
    .no-border>tfoot>tr>td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 2px solid #ddd;
    }

    .no-border>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }

    .no-border>caption+thead>tr:first-child>th,
    .no-border>colgroup+thead>tr:first-child>th,
    .no-border>thead:first-child>tr:first-child>th,
    .no-border>caption+thead>tr:first-child>td,
    .no-border>colgroup+thead>tr:first-child>td,
    .no-border>thead:first-child>tr:first-child>td {
        border-top: 0;
    }

    .no-border>tbody+tbody {
        border-top: 2px solid #ddd;
    }

    .no-border td,
    .no-border th {
        background-color: #fff !important;
        border: 0px solid #000 !important;
    }
</style>
