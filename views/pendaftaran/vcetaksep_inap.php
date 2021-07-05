<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
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
<?php
  $t1 = new DateTime('today');
  $t2 = new DateTime($row->tgl_lahir);
  $y  = $t1->diff($t2)->y;
  $m  = $t1->diff($t2)->m;
  $d  = $t1->diff($t2)->d;
  $umur = $y;
?>
<script>
	$(document).ready(function(){
        getttd();
    });
	function getttd(){
            var id_dokter = "<?php echo $row->dpjp;?>";
            var ttd = "<?php echo site_url('ttddokter/getttddokterlab');?>/"+id_dokter;
            $(".ttd_dpjp").qrcode({width: 100,height: 100, text:ttd});
            var status_pulang = "<?php echo $row->status_pulang;?>";
            var no_rm = "<?php echo $row->no_rm;?>";
            var no_reg = "<?php echo $row->no_reg;?>";
            var umur = "<?php echo $umur;?>";
            if (status_pulang==4 || umur<10){
              var ttd = "<?php echo site_url('ttddokter/getttdpasien');?>/"+no_rm;
            } else {
              var ttd = "<?php echo site_url('ttddokter/getttdkeluarga');?>/"+no_reg;
            }
            if (ttd!="") $(".ttd_pasien").qrcode({width: 100,height: 100, text:ttd});

    }
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
<?php
	// echo json_encode($rujukan);
	$nama = isset($rujukan->peserta->nama) ? $rujukan->peserta->nama : "";
    $pelayanan = isset($rujukan->jnsPelayanan) ? $rujukan->jnsPelayanan : "";
    $hakkelas = isset($rujukan->kelasRawat) ? $rujukan->kelasRawat : "";
    $no_rm = isset($rujukan->peserta->noMr) ? $rujukan->peserta->noMr : "";
    $jenis_kelamin = isset($rujukan->peserta->kelamin) ? $rujukan->peserta->kelamin : "";
    $jenispeserta = isset($rujukan->peserta->jnsPeserta) ? $rujukan->peserta->jnsPeserta : "";
    $tglkunjungan = isset($rujukan->tglSep) ? date("d-m-Y",strtotime($rujukan->tglSep)) : "";
    $norujukan = isset($rujukan->noKunjungan) ? $rujukan->noKunjungan : "";
    $provperujuk = isset($rujukan->provPerujuk->nama) ? $rujukan->provPerujuk->nama : "";
    $diag_awal = isset($rujukan->diagnosa) ? $rujukan->diagnosa : "";
    $polirujukan = isset($rujukan->poli) ? $rujukan->poli : "";
    $cob = isset($rujukan->cob->noAsuransi) ? ($rujukan->cob->noAsuransi==null ? 0 : 1) : "-";
    $tgllahir = isset($rujukan->peserta->tglLahir) ? date("d-m-Y",strtotime($rujukan->peserta->tglLahir)) : "-";
    $ppk = "";
    // if ($asal=="")
    // 	$ppk = ($ar==1 ? "Faskes 1" : "Faskes 2 (RS)");
    // else
    // 	$ppk= $ppkasal->response->faskes[0]->nama;
?>
<table class="table no-border" style="width:100%">
	<tr>
		<th align="center" colspan="6" class="text-center">SURAT ELEGIBILITAS PESERTA<br>RS TK III CIREMAI CIREBON<br><br></th>
	</tr>
	<tr>
		<td>No. SEP</td><td>:</td><td style="font-size: 17px"><?php echo $nosep;?></td>
		<td>Nomor RM</td><td>:</td><td style="font-size: 17px"><?php echo $no_rm." /&nbsp;&nbsp;&nbsp;".$no_reg;?></td>
	</tr>
	<tr>
		<td>Tgl. SEP</td><td>:</td><td><?php echo $tglkunjungan;?></td>
		<td>Peserta</td><td>:</td><td><?php echo $jenispeserta;?></td>
	</tr>
	<tr>
		<td>No. Kartu</td><td>:</td><td><?php echo $nobpjs;?></td>
		<td>COB</td><td>:</td><td><?php echo $cob;?></td>
	</tr>
	<tr>
		<td>Nama Peserta</td><td>:</td><td><?php echo $nama;?></td>
		<td>Jenis Rawat</td><td>:</td><td><?php echo $pelayanan;?></td>
	</tr>
	<tr>
		<td>Tgl. Lahir</td><td>:</td><td><?php echo $tgllahir;?></td>
		<td>Kelas Rawat</td><td>:</td><td><?php echo $hakkelas;?></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td><td>:</td><td><?php echo $jenis_kelamin;?></td>
		<td>Ruangan</td><td>:</td><td><?php echo $row->nama_ruangan;?></td>
	</tr>
	<tr>
		<td>Poli Tujuan</td><td>:</td><td><?php echo $polirujukan;?></td>
		<td>Kamar</td><td>:</td><td><?php echo $row->kode_kamar;?></td>
	</tr>
	<tr>
		<td>Asal Faskes Tk. I</td><td>:</td><td><?php echo $ppk?></td>
		<td>Kelas</td><td>:</td><td><?php echo $row->kode_kelas;?></td>
	</tr>
	<tr>
		<td>Diagnosa Awal</td><td>:</td><td><?php echo $diag_awal;?></td>
		<td>Bed</td><td>:</td><td><?php echo $row->no_bed;?></td>
	</tr>
	<tr><td colspan="6" style="border-top:1px solid">&nbsp;</td></tr>
</table>
<table class="table no-border" style="width:100%">
	<tr>
		<td align="center"><?php echo ($row->status_pulang==4 || $umur<10 ? "Keluarga" : "Pasien");?><br><span class='ttd_pasien'></span><br><br><?php echo ($row->status_pulang==4 ||$umur<10 ? $k->saksi : $row->nama_pasien);?></td>
		<td align="right">Dokter DPJP<br><span class='ttd_dpjp'></span><br><br><?php echo $row->nama_dokter;?></td>
	</tr>
</table>
<script type="text/javascript">
	window.print();
</script>
<style type="text/css">
    html, body {
        width: 20cm;
        display: block;
    }
    td {
        font-size: 13px;
        /*word-spacing: 0.05cm;*/
    }
    th {
        font-size: 13px;
        /*word-spacing: 0.05cm;*/
    }
    @page {
      size: 20cm 14cm;
    }
</style>
