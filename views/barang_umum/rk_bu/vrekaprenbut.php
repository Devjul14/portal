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
                BAGIAN : Barang Umum
            </b>
        </h5>
    </div>
    <br>
    <br>
    <center>
        <h5>
            <b>RENCANA KEBUTUHAN BARANG</b>
            <p>PERIODE : <?php echo $tanggal1 ?> s/d <?php echo $tanggal2 ?></p>
        </h5>

    </center>
    <div class="invoice-info">
        <div class="row">
            <div class="col-sm-12">
                <table class='table table-condensed table-bordered'>
                    <tr class="bg-navy">
                        <th width="50px">NO</th>
                        <th class='text-center'>NAMA BARANG</th>
                        <th class='text-center'>MERK</th>
                        <th class='text-center' width='80px'>QTY</th>
                        <th class='text-center' width='100px'>SATUAN</th>
                        <!-- <th class='text-center' width='100px'>HARGA</th> -->
                        <th class='text-center' width='80px'>KET</th>

                    </tr>
                    <?php
                        $i = 0;
                        foreach ($q->result() as $value) {
                            $i++;
                            echo " 
                                <tr>
                                    <td>".$i."</td>
                                    <td>".$value->nama_bu."</td>
                                    <td></td>
                                    <td>".$value->jumlah."</td>
                                    <td>".$value->satuan_besar."</td>
                                    <td></td>
                                </tr>
                            ";
                            // <td>".number_format($value->hps,0,',','.')."</td>
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
                    <th class="text-center" width="30%">Disahkan Oleh,</th>
                    <th class="text-center">Menyetujui,</th>
                    <th class="text-center" width="30%">Yang Mengajukan,</th>
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
                    <th class="text-center">dr. Tetri Yuniawati, SP.M</th>
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
                    <th class="text-center" width="30%">&nbsp;</th>
                    <th class="text-center">Mengetahui,</th>
                    <th class="text-center" width="30%">&nbsp;</th>
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