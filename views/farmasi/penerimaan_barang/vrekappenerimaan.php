<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/adminlte.css">
<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/font-awesome.css">
<script src="<?php echo base_url();?>/cetak/js/jquery.js"></script>
<style type="text/css">
    body, table th, td {
        font-size: 14px;
    }
    .borderless td, .borderless th {
        border: none;
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
    <h5>
        <b>
        DETASEMEN KESEHATAN WILAYAH 03.04.03
        <br>
        <u>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI</u>
        </b>
    </h5>
    <br>
    <br>
    <center>
        <h4>
            <b>BERITA ACARA PEMERIKSAAN BARANG</b>
            <p>PERIODE : <?php echo $tanggal1 ?> s/d <?php echo $tanggal2 ?></p>
        </h4>
    </center>
    <?php 
        $tgl = date('d', strtotime($tanggal2));
        $tahun = date('Y', strtotime($tanggal2));
        function bulan($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
            return $bulan[ (int)$pecahkan[1] ];
        }
    ?>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada hari ini, <b>Kamis Tanggal <?php echo $this->terbilang->eja($tgl) ?> Bulan <?php echo bulan($tanggal2) ?> Tahun <?php echo $this->terbilang->eja($tahun) ?></b> kami yang bertanda tangan di bawah ini :
    </p>
    <table width="100%">
        <tr>
            <th>NAMA</th>
            <th>PANGKAT/CORPS</th>
            <th>NIP/NRP</th>
        </tr>
        <tr>
            <td>1. Agus Sepkuri, AMK</td>
            <td>Peltu</td>
            <td>NRP.21970232820676</td>
        </tr>
        <tr>
            <td>2. Tuti Suprihatin, S.Kep</td>
            <td>Penata Tk.I-III/d</td>
            <td>NIP.196608291987032002</td>
        </tr>
        <tr>
            <td>3. Ciptadi, A.Md.Kep</td>
            <td>Penda Tk.I-III/b</td>
            <td>NIP.197201011994011001</td>
        </tr>
    </table>
    <br>

    <p align="justify">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan Surat Perintah Kepala Rumkit Tk III 03.06.01 Ciremai Nomor : Sprin / 54 / II / 2017, Surat Perintah Kakesdam III/Siliwangi Nomor : Sprin / 58 / I / 2017 tanggal 27 Januari 2017, tentang Tim Komisi Penerimaan dan Penilaian Barang/Materiil dan Jasa Pengadaan BEkkes Rumkit Tk III 03.06.01 Ciremai. Menerangkan dengan sesungguhnya bahawa berdasarkan hasil pemeriksaan dan penerimaan terhadap pengadaan Bekkes TA.2019, yang dilaksanakan oleh:
        <br> 
        <?php
            $a=0;
            foreach ($q->result() as $val) {
                $a++;
                echo $a.". <b>".$val->nama_supplier."</b>";
                echo "<br>";
            }
        ?>
        <br>
        yang dikirim/diserahkan dengan faktur:
        <br>
        <?php
            $i = 0;
            foreach ($q->result() as $value) {
                $i++;
                echo $i.". <b>".$value->no_faktur."</b> Tanggal ".$value->tanggal;
                echo "<br>";
            }

        ?>
        dinyatakan baik dan lengkap(daftar barang tersebut dibawah ini).
    </p>
    <div class="invoice-info">
        <div class="row">
            <div class="col-sm-12">
                <table class='table table-condensed table-bordered'>
                    <tr class="bg-navy">
                        <th width="50px">NO</th>
                        <th class='text-center'>NAMA BARANG</th>
                        <th class='text-center'>SPESIFIKASI</th>
                        <th class='text-center' width='80px'>QTY</th>
                        <th class='text-center' width='100px'>SATUAN</th>
                        <th class='text-center' width='100px'>KETERANGAN</th>

                    </tr>
                    <?php
                    	$total = 
                        $i = 0;
                        foreach ($q->result() as $value) {
                            $i++;
                            $j = ($value->harga*$value->jumlah);
                            echo " 
                                <tr>
                                    <td>".$i."</td>
                                    <td>".$value->nama."</td>
                                    <td></td>
                                    <td align='right'>".$value->jumlah."</td>
                                    <td>".$value->satuan."</td>
                                    <td>".$value->satuan."</td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>
            <div class="col-sm-12 no-print">
                <div class="pull-right">
                    <button class="print btn btn-default">Print</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <table  border=0 width="100%">
                <tr>
                    <th class="text-center" width="40%">Yang Menerima</th>
                    <th width="20%">&nbsp;</th>
                    <th>Pejabat Penerima Hasil Peerjaan/Tim Komisi:</th>
                </tr>
                <tr>
                    <th class="text-center">Kepala Instalasi Farmasi,</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>1. Agus Sepkuri, AMK</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Peltu NRP. 21970232820676 ..............................</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>2. Tuti Suprihatin, S.Kep</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Penata Tk.1-III/d</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>NIP. 196608291987032002 ..............................</th>
                </tr>
                <tr>
                    <th class="text-center">Wiwin Machwar ,S.Farmi,Apt</th>
                    <th>&nbsp;</th>
                    <th>3. Ciptadi, A.Md.Kep</th>
                </tr>
                <tr>
                    <th class="text-center">PNS III/a NIP.197003042001122003</th>
                    <th>&nbsp;</th>
                    <th>Penata Muda Tk.1-III/b</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>NIP. 197201011994011001 ..............................</th>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <table  border=0 width="100%">
                <tr>
                    <th  width="25%">&nbsp;</th>
                    <th width="40%" class="text-center">Mengetahui:</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">Kepala Rumah Sakit Ciremai,</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">dr. Andre Novan</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">Mayor Ckm NRP. 1101000201171</th>
                    <th>&nbsp;</th>
                </tr>
            </table>
        </div>
    </div>
</section>