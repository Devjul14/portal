<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/adminlte.css">
<link rel="stylesheet" href="<?php echo base_url();?>/cetak/css/font-awesome.css">
<script src="<?php echo base_url();?>/cetak/js/jquery.js"></script>
<style type="text/css">
    body, table th, td {
        font-size: 12px;
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
    <div class="pull-right">
        <h5>
            <b>
                BAGIAN : Farmasi
            </b>
        </h5>
    </div>
    <br>
    <br>
    <center>
        <h5>
            <?php
                $bulan = date("m",strtotime($q->periode));
                Switch ($bulan){
                    case 1 : $bulan="Januari";
                        Break;
                    case 2 : $bulan="Februari";
                        Break;
                    case 3 : $bulan="Maret";
                        Break;
                    case 4 : $bulan="April";
                        Break;
                    case 5 : $bulan="Mei";
                        Break;
                    case 6 : $bulan="Juni";
                        Break;
                    case 7 : $bulan="Juli";
                        Break;
                    case 8 : $bulan="Agustus";
                        Break;
                    case 9 : $bulan="September";
                        Break;
                    case 10 : $bulan="Oktober";
                        Break;
                    case 11 : $bulan="November";
                        Break;
                    case 12 : $bulan="Desember";
                        Break;
                }
            ?>
            <b>STOK OPNAME</b>
            <br>
            <p>PERIODE : <?php echo $bulan ?> <?php echo date("Y",strtotime($q->periode)) ?></p>
        </h5>
    </center>
    <br>
    <h5>
        <?php echo $q->nama_depo ?>
    </h5>
    <h5>
        Keterangan : <?php echo $q->keterangan ?>
    </h5>
    <h5>
        Jenis Obat : <?php echo $nj->nama_jenis ?>
    </h5>
    <div class="invoice-info">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="data">
                    <tr class="bg-navy">
                        <th width="50px">No</th>
                        <th width="100px" class="text-center">Kode Obat</th>
                        <th width="300px">Nama Obat</th>
                        <th width="150px" class="text-center">Stok Awal</th>
                        <th width="100px" class="text-center">Pemasukan</th>
                        <th width="100px" class="text-center">Pengeluaran</th>
                        <th width="100px" class="text-center">Stok Opname</th>
                        <th width="150px" class="text-center">Stok Real</th>
                        <th width="100px" class="text-center">Satuan Kecil</th>
                        <th width="200px" class="text-center">Jumlah</th>
                        <th width="300px" class="text-center">Keterangan</th>
                    </tr>
                    <?php 
                        $i = 0;
                        foreach ($so->result() as $val) {
                            $i++;
                            echo "
                                <tr>
                                    <td>".$i."</td>
                                    <td>".$val->kode_obat."</td>
                                    <td>".$val->nama."</td>
                                    <td>
                                        ".$val->stok_awal."
                                    </td>
                                    <td>
                                        ".$val->stok_pemasukan."
                                    </td>
                                    <td>
                                        ".$val->stok_pemakaian."
                                    </td>
                                    <td>
                                        ".$val->stok_so."
                                    </td>
                                    <td>
                                        ".$val->stok_real."
                                    </td>
                                    <td>
                                        ".$val->satuan_kecil."
                                    </td>
                                    <td>
                                        ".number_format($val->jumlah,0,',','.')."
                                    </td>
                                    <td>
                                        ".$val->keterangan."
                                    </td>
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
            <table  width="100%">
                <tr>
                    <th class="text-center" width="35%">Disahkan Oleh,</th>
                    <th class="text-center">Menyetujui,</th>
                    <th class="text-center" width="35%">Yang Mengajukan,</th>
                </tr>
                <tr>
                    <th class="text-center">Kabid Yanmed</th>
                    <th class="text-center">Kasi Renprogar</th>
                    <th class="text-center">Kepala Instalasi Farmasi,</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th class="text-center">dr. Tetri Yuniwati, SP.M</th>
                    <th class="text-center">Sunardi</th>
                    <th class="text-center">Wiwin Machwar, S.farm.,Apt.</th>
                </tr>
                <tr>
                    <th class="text-center">PNS IV/a NIP.196906302002122001</th>
                    <th class="text-center">PNS II/d NIP.198007102009121001</th>
                    <th class="text-center">PNS III/a NIP.197003042001122003</th>
                </tr>
            </table>
            <br>
            <br>
            <table  width="100%">
                <tr>
                    <th class="text-center" width="35%">&nbsp;</th>
                    <th class="text-center">Mengetahui,</th>
                    <th class="text-center" width="35%">&nbsp;</th>
                </tr>
                <tr>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">Kepala Rumah Sakit</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">dr. Andre Novan</th>
                    <th class="text-center"></th>
                </tr>
                <tr>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">Mayor Ckm NRP.11010002201171</th>
                    <th class="text-center"></th>
                </tr>
            </table>
        </div>
    </div>
</section>