<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/adminlte.css">
<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/font-awesome.css">
<script src="<?php echo base_url();?>/cetak/js/jquery.js"></script>
<style type="text/css">
    body, table th, td {
        font-size: 18px;
    }
    .borderless td, .borderless th {
        border: none;
    }
    .vl {
  border-left: 1px solid black;
  height: 250px;
}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(".print").click(function(){
            window.print();
        })
    });
</script>
<section class="invoice">   
    <table width="100%">
        <tr>
            <th width="80%">KEUANGAN RUMKIT TK. III 03.06.01 CRIEMAI</th>
            <th>Bukti Kas No. : .................</th>
        </tr>
        <tr>
            <th>NOMINKU : 2.05.14</th>
            <th>Bukti : KU-17</th>
        </tr>
        <tr>
            <th><hr width="400px" style="border-top: 1px solid;" align="left"></th>
            <th><hr width="200px" style="border-top: 1px solid;" align="left"></th>
        </tr>
    </table>
    <br>
    <br>
    <center>
        <h2>
            <b><u>KWITANSI</u></b>
        </h2>
    </center>
    <table width="100%">
        <tr>
            <td>Tahun Anggaran</td>
            <td width="5%"> : </td>
            <td width="70%">
                <?php echo $q->tahun_anggaran ?>
            </td>
        </tr>
        <tr>
            <td>Mata Anggaran</td>
            <td> : </td>
            <td> <?php echo $q->mata_anggaran ?></td>
        </tr>
        <tr>
            <td>Jenis Pengeluaran</td>
            <td> : </td>
            <td> <?php echo $q->jenis_pengeluaran ?></td>
        </tr>
    </table>
    <hr width="100%" style="border-top: 1px solid;">
    <table width="100%">
        <tr>
            <td>Terima Dari</td>
            <td width="5%"> : </td>
            <td width="70%">
                <?php echo $q->terima_dari ?>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <?php echo $total = ($row->total+($row->jumlah*1.5/100)); ?>
            <td>Uang Sejumlah</td>
            <td width="5%"> : </td>
            <td width="70%">
                Rp. <?php echo number_format($total,0,',','.') ?>
            </td>
        </tr>
        <tr>
            <td>Untuk Keperluan</td>
            <td> : </td>
            <td>
                <?php echo $q->keperluan ?>
            </td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td> : </td>
            <td>
                Di sebelah terlampir : <?php echo $q->keterangan ?> helai surat / tanda bukti pembayaran
            </td>
        </tr>
    </table>
    <hr width="100%" style="border-top: 1px solid;">
    <table width="100%">
        <tr>
            <td align="center" width="50%" colspan="3">Cirebon, <?php echo date("d-m-Y",strtotime($q->tanggal)) ?></td>
            <td rowspan="6" width="10%" align="center">
                <div class="vl">
                	
                </div>
            </td>
            <td align="center" colspan="3"> Cirebon, <?php echo date("d-m-Y",strtotime($q->tanggal)) ?></td>
        </tr>
        <tr>
            <td align="center" colspan="3">Yang Membayarkan : </td>
            <td align="center" colspan="3">Yang Menerima :</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
            <td>Nama</td>
            <td>:</td>
            <td>
            	<?php echo $q->nama_penerima ?>
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?php echo $q->nama_bayar ?></td>
            <td>Pangkat</td>
            <td>:</td>
            <td><?php echo $q->pangkat_penerima ?></td>
        </tr>
        <tr>
            <td>Pangkat/NRP</td>
            <td>:</td>
            <td><?php echo $q->pangkat_bayar ?> / <?php echo $q->nrp_bayar ?></td>
            <td>Jabatan</td>
            <td>:</td>
            <td><?php echo $q->jabatan_penerima ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?php echo $q->jabatan_bayar ?></td>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $q->alamat_penerima ?></td>
        </tr>
    </table>
    <hr width="100%" style="border-top: 1px solid;">
    <table width="100%">
    	<tr>
            <td>Jumlah di Tagihan</td>
            <td width="10%"> Rp. </td>
            <td width="10%" align="right">
            	<?php echo number_format($row->jumlah,0,',','.') ?>
            </td>
        </tr>
        <tr>
            <td>Ppn 10%</td>
            <td> Rp. </td>
            <td align="right">
                <?php echo number_format(($row->jumlah*10/100),0,',','.') ?>
            </td>
        </tr>
        <tr>
            <td>Pph 22(1,5%)</td>
            <td> Rp. </td>
            <td align="right">
                <?php echo number_format(($row->jumlah*1.5/100),0,',','.') ?>
            </td>
        </tr>
    </table>
    <hr width="100%" style="border-top: 1px solid;">
    <table width="100%">
    	<tr>
            <!-- <?php echo $total = ($row->total+($row->jumlah*1.5/100)); ?> -->
            <td>Sisa di bayarkan</td>
            <td width="10%"> Rp. </td>
            <td width="10%" align="right">
                <?php echo number_format($total,0,',','.') ?>
            </td>
        </tr>
    </table>
</section>
<div class="col-sm-12 no-print">
    <div class="pull-right">
        <button class="print btn btn-default">Print</button>
    </div>
</div>