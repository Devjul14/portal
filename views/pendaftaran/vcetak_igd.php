<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>css/AdminLTE.css"> -->
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/select2/select2.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url(); ?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url(); ?>js/html2canvas.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo base_url(); ?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url() ?>js/library.js"></script>
</head>
<script>
    $(document).ready(function() {
        getttd1();
        getassesmen();
    });

    function getttd1() {
        var ttd = "<?php echo site_url('ttddokter/getttddokterlab/' . $q->id_dokter_igd); ?>";
        $('.ttd_qrcode_igd').qrcode({
            width: 80,
            height: 80,
            text: ttd
        });
    }

    function getassesmen() {
        var no_reg = "<?php echo $no_reg; ?>";
        $(".tempat").empty();
        var html = '<img src="<?php echo base_url() . '/img/igd.jpg'; ?>" style="width:100%">';
        $(".tempat").html(html);
        if ($(".tempat").offset() != undefined) {
            var xtempat = parseInt($(".tempat").offset().left);
            var ytempat = parseInt($(".tempat").offset().top);
        }
        $.ajax({
            url: "<?php echo site_url('assesmen/getassesmen'); ?>",
            type: 'POST',
            data: {
                no_reg: no_reg,
                asal: "assesmen"
            },
            success: function(result) {
                var result = JSON.parse(result);
                console.log(result);
                $.each(result, function(key, value) {
                    var dataText = $(".tempat");
                    var xcor = parseInt(value.xcor) + xtempat - 20;
                    var ycor = parseInt(value.ycor) + ytempat - 20;
                    var dataInputField = $('<div style="position:absolute;left:' + (xcor) + 'px;top:' + (ycor) + 'px"><button class="titik btn btn-xs btn-danger ' + xcor + 'x' + ycor + '" luka="' + value.luka + '"  keterangan="' + value.keterangan + '"><i class="fa fa-close"></i></button>&nbsp;<span class="text-bold text-green s' + xcor + 'x' + ycor + '">' + value.luka + ' (' + value.keterangan + ')</span></div>');
                    dataText.append(dataInputField);
                });
                if ($(".tempat").offset() != undefined) {
                    getimage();
                } else {
                    window.print();
                }
            },
            error: function(result) {
                console.log(result);
            }
        });
    }

    function getimage() {
        html2canvas(document.getElementById("tempat")).then(function(canvas) {
            var imagedata = canvas.toDataURL('image/jpg');
            var html = '<img src="' + imagedata + '" style="width:100%">';
            $(".tempat").html(html);
            setTimeout(window.print(), 10000);
        });
    }
</script>
<?php
$pem = explode(",", $q->pemeriksaan_fisik);
$kelainan = explode("|", $q->kelainan);
?>
<table width="100%" cellspacing="0" cellpadding="0" border=0>
    <tr>
        <td align="right">
            RM 05. 1/RI/RSC
        </td>
    </tr>
</table>
<table border="1" width="100%" cellspacing="0" cellpadding="1">
    <tr>
        <td rowspan="8" align="center"><img src="<?php echo base_url("img/Logo.png") ?>"><br><b>RS CIREMAI</b></td>
        <td rowspan="8" colspan="2" align="center">
            <h4 style="margin-top:0px; margin-bottom: 0px;">ASSESMEN AWAL MEDIS <br><?php echo ($status == "ralan" ? "POLIKLINIK" : "INSTALASI GAWAT DARURAT"); ?></h4>
        </td>
        <td><strong>No. Rekam Medik</strong></td>
        <td colspan="10"><strong><?php echo $q->no_rm ?></strong></td>
    </tr>
    <tr>
        <td> <strong>No. Registrasi</strong></td>
        <td colspan="10"> <strong><?php echo $q->no_reg ?></strong></td>
    </tr>
    <tr>
        <td> <strong>Nama</strong></td>
        <td colspan="10"> <strong><?php echo $q->nama_pasien ?></strong></td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td>
        <td colspan="10"> <strong><?php echo date("d-m-Y", strtotime($q->tgl_lahir)); ?></strong></td>
    </tr>
    <tr>
        <td>Tanggal Masuk</td>
        <td colspan="10"><?php echo date("d-m-Y", strtotime($q->tanggal_masuk)) ?></td>
    </tr>
    <tr>
        <td>Jam Masuk</td>
        <td colspan="10"><?php echo $q->jam_masuk ?></td>
    </tr>
    <tr>
        <td>Jam Periksa</td>
        <td colspan="10"><?php echo $q->jam_periksa ?></td>
    </tr>
    <tr>
        <td>Jam Keluar IGD</td>
        <td colspan="10"><?php echo $q->jam_keluar_igd ?></td>
    </tr>
    <tr>
        <th align="center">Nyeri</th>
        <th align="center">Lokasi</th>
        <th align="center">Frekuensi</th>
        <th align="center">Durasi</th>
        <th align="center">Resiko Jatuh</th>
        <th align="center">Kedatangan</th>
        <th align="center">Pengirim</th>
        <th align="center">Riwayat Alergi</th>
        <th align="center">Skrining Gizi Awal</th>
    </tr>
    <tr>
        <td align="center"><?php echo $q->nyeri ?></td>
        <td align="center"><?php echo $q->lokasi ?></td>
        <td align="center"><?php echo $q->frekuensi ?></td>
        <td align="center"><?php echo $q->durasi ?></td>
        <td align="center"><?php echo $q->resiko_jatuh ?></td>
        <td align="center"><?php echo $q->kedatangan ?></td>
        <td align="center"><?php echo $q->pengirim ?></td>
        <td align="center"><?php echo $q->riwayat_alergi ?></td>
        <td align="center"><?php echo $q->skrining_gizi ?></td>
    </tr>
</table>
<br>
<table border="1" width="100%" cellspacing="0" cellpadding="1">
    <tr>
        <td colspan="2"><strong>Keputusan : </strong><?php echo $q->keputusan ?><strong> Jam : </strong><?php echo $q->waktu_keputusan ?> WIB</td>
    </tr>
    <?php if ($q->kode_keputusan == 2 || $q->kode_keputusan == 3) : ?>
        <tr>
            <td colspan="2">
                <div class="tempat row" id="tempat">
                    <img src="<?php echo base_url() . '/img/igd.jpg'; ?>" style="width:100%">
                </div>
            </td>
        </tr>
    <?php endif ?>
    <tr>
        <td colspan="2">
            <strong>Kronologis Kejadian : </strong> <?php echo $q->kronologis_kejadian ?>
            <br><strong>Riwayat Penyakit Terdahulu :</strong> <?php echo $q->riwayat_penyakit ?>
            <br><strong>Obat - obatan yang dikonsumsi :</strong> <?php echo $q->obat_dikonsumsi ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><strong>Observasi : </strong><?php echo $q->observasi ?>
            <br> <strong> Waktu : </strong><?php echo $q->waktu ?>
            <br> <strong> Assesment : </strong><?php echo $q->assesment ?>
            <div class="row">
                <div class="col-xs-1"><strong> S : </strong></div>
                <div class="col-xs-11" style="margin-left: 0px"><?php echo $q->s; ?></div>
            </div>
            <div class="row">
                <div class="col-xs-1"><strong> O : </strong></div>
                <div class="col-xs-11" style="margin-left: 0px"><?php echo $q->o; ?></div>
            </div>
            <br>
            <div class="margin" style="margin-left:30px">
                <table width="100%" cellspacing="0" cellpadding="1">
                    <tr>
                        <td align="left" colspan="2">Kesadaran : <?php echo $q->kesadaran; ?> GCS : <?php echo $q->gcs; ?></td>
                        <td align="left">E : <?php echo $q->e; ?></td>
                        <td align="left">V : <?php echo $q->v; ?></td>
                        <td align="left">M : <?php echo $q->m; ?></td>
                        <td colspan="3" align="left"></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo ($p1->td == "" ? "" : "TD ka : " . $p1->td . " mmHg"); ?></td>
                        <td align="left"><?php echo ($p1->td2 == "" ? "" : "TD ki : " . $p1->td2 . " mmHg"); ?></td>
                        <td align="left"><?php echo ($p1->nadi == "" ? "" : "Nadi : " . $p1->nadi . " x/ mnt"); ?></td>
                        <td align="left"><?php echo ($p1->respirasi == "" ? "" : "Respirasi : " . $p1->respirasi . " x/ mnt"); ?></td>
                        <td align="left"><?php echo ($p1->suhu == "" ? "" : "Suhu : " . $p1->suhu . " °C"); ?></td>
                        <td colspan="3" align="left"><?php echo ($p1->spo2 == "" ? "" : "SpO2 : " . $p1->spo2 . " %"); ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo ($q->bb == "" ? "" : "BB : " . $q->bb . " kg"); ?></td>
                        <td align="left"><?php echo ($q->tb == "" ? "" : "TB : " . $q->tb . " cm"); ?></td>
                        <td align="left"><?php echo ($q->lk == "" ? "" : "LK : " . $q->lk . " cm"); ?></td>
                        <td align="left"><?php echo ($q->ld == "" ? "" : "LD : " . $q->ld . " cm"); ?></td>
                        <td colspan="4" align="left"><?php echo ($q->lp == "" ? "" : "LP : " . $q->lp . " cm"); ?></td>
                    </tr>
                </table><br>
                <?php
                $ada = 0;
                for ($i = 0; $i <= 10; $i++) {
                    if (!$pem[$i]) {
                        $ada = 1;
                    }
                }
                if ($ada == 1) :
                ?>
                    <table width="100%" cellspacing="0" cellpadding="1">
                        <tr>
                            <th>Pemeriksaan</th>
                            <th>Kelainan</th>
                        </tr>
                        <?php if ($pem[0] != "1") : ?>
                            <tr>
                                <td width=200px>Kepala</td>
                                <td><?php echo (isset($kelainan[0]) ? ($pem[0] == "1" ? "" : $kelainan[0]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[1] != "1") : ?>
                            <tr>
                                <td>Mata</td>
                                <td><?php echo (isset($kelainan[1]) ? ($pem[1] == "1" ? "" : $kelainan[1]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[2] != "1") : ?>
                            <tr>
                                <td>THT</td>
                                <td><?php echo (isset($kelainan[2]) ? ($pem[2] == "1" ? "" : $kelainan[2]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[3] != "1") : ?>
                            <tr>
                                <td>Gigi Mulut</td>
                                <td><?php echo (isset($kelainan[3]) ? ($pem[3] == "1" ? "" : $kelainan[3]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[4] != "1") : ?>
                            <tr>
                                <td>Leher</td>
                                <td><?php echo (isset($kelainan[4]) ? ($pem[4] == "1" ? "" : $kelainan[4]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[5] != "1") : ?>
                            <tr>
                                <td>Thoraks</td>
                                <td><?php echo (isset($kelainan[5]) ? ($pem[5] == "1" ? "" : $kelainan[5]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[6] != "1") : ?>
                            <tr>
                                <td>Abdomen</td>
                                <td><?php echo (isset($kelainan[6]) ? ($pem[6] == "1" ? "" : $kelainan[6]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[7] != "1") : ?>
                            <tr>
                                <td>Ekstremitas Atas</td>
                                <td><?php echo (isset($kelainan[7]) ? ($pem[7] == "1" ? "" : $kelainan[7]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[8] != "1") : ?>
                            <tr>
                                <td>Ekstremitas Bawah</td>
                                <td><?php echo (isset($kelainan[8]) ? ($pem[8] == "1" ? "" : $kelainan[8]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[9] != "1") : ?>
                            <tr>
                                <td>Genitalia</td>
                                <td><?php echo (isset($kelainan[9]) ? ($pem[9] == "1" ? "" : $kelainan[9]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($pem[10] != "1") : ?>
                            <tr>
                                <td>Anus</td>
                                <td><?php echo (isset($kelainan[10]) ? ($pem[10] == "1" ? "" : $kelainan[10]) : ''); ?></td>
                            </tr>
                        <?php endif ?>
                    </table>
                <?php endif ?>
            </div>
            <br> <strong> A : </strong><?php echo $q->a ?>
            <br> <strong> P : </strong><?php echo $q->p ?>
            <br>
            <?php if ($k->num_rows() > 0) : ?>
                <div class="margin">
                    <strong>Konsul Dokter : </strong>
                    <table width="100%" cellspacing="2" cellpadding="1">
                        <tr>
                            <td>
                                <?php
                                $no = 1;
                                foreach ($k->result() as $key) {
                                    echo "<div class='col-md-12'>" . ($no++) . ". " . $dokter[$key->dokter_konsul];
                                    if ($key->dijawab) {
                                        echo ($key->via != "Diruangan" ? " dihubungi via" : "") . " " . $key->via;
                                    }
                                    echo ($key->via == "whatsapp" ? ($key->dijawab == 1 ? " Advice" : " Belum dijawab") : "") . "</div>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div><br>
            <?php endif ?>
            <div class="margin">
                <strong>Pemeriksaan Penunjang :</strong> <?php echo $q->pemeriksaan_penunjang ?><br>
                <table width="100%" cellspacing="0" cellpadding="1">
                    <tr>
                        <td class="text-left"><b>Radiologi</b></td>
                        <td class="text-left"><b>Lab</b></td>
                        <td class="text-left"><b>Lain</b></td>
                    </tr>
                    <?php
                    $n = 1;
                    echo "<tr id='data'>";
                    echo "<td valign='top'><ol style='padding-left:30px'>";
                    if (isset($p["rad"])) {
                        foreach ($p["rad"] as $key => $value) {
                            echo "<li>" . $value . "</li>";
                        }
                    }
                    echo "</ol></td>";
                    echo "<td valign='top'><ol style='padding-left:30px'>";
                    if (isset($p["lab"])) {
                        foreach ($p["lab"] as $key => $value) {
                            echo "<li>" . $value . "</li>";
                        }
                    }
                    echo "</ol></td>";
                    echo "<td valign='top'><ol style='padding-left:30px'>";
                    if (isset($p["lain"])) {
                        foreach ($p["lain"] as $key => $value) {
                            echo "<li>" . $value . "</li>";
                        }
                    }
                    echo "</ol></td>";
                    echo "</tr>";
                    ?>
                </table>
            </div>
            <div class="margin">
                <strong>Terapi :</strong>
                <table width="100%" cellspacing="2" cellpadding="1">
                    <tr>
                        <th width="50" class='text-center'>No</th>
                        <th>Nama Obat</th>
                        <th width="150">Aturan Pakai</th>
                        <th>Waktu</th>
                        <th>Cara</th>
                        <th class="text-right">Qty</th>
                    </tr>
                    <?php
                    $n = 1;
                    foreach ($a->result() as $data) {
                        echo "<tr id='data'>";
                        echo "<td class='text-center'>" . ($n++) . "</td>";
                        echo "<td>" . $data->nama_obat . "</td>";
                        echo "<td>" . $data->aturan . "</td>";
                        echo "<td>" . $data->nwaktu . "</td>";
                        echo "<td>" . $data->pagi . "-" . $data->siang . "-" . $data->sore . "-" . $data->malem . "-" . $data->ket_waktulainnya . "</td>";
                        echo "<td class='text-right'>" . $data->qty . " " . $data->satuan . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </td>
    </tr>
    </td>
    </tr>
    <tr>
        <td colspan="2" align="right" style="padding-right: 30px"><?php echo ($status == "ralan" ? "Dokter Poliklinik" : "Dokter Jaga IGD"); ?>
            <br>
            <div class="ttd_qrcode_igd"> </div>
            <br>
            <?php echo $q->dokter_igd ?>
        </td>
    </tr>
    <?php
    if ($q->tindak_lanjut == "ralan") {
        $tindak_lanjut = "Rawat Jalan";
    ?>
        <tr>
            <td colspan="2"><strong>
                    Tindak Lanjut : </strong><?php echo $tindak_lanjut ?>
            </td>
        </tr>
    <?php
    } else
            if ($q->tindak_lanjut == "ranap") {
        $tindak_lanjut = "Rawat Inap"; ?>
        <tr>
            <td colspan="2"><strong>Tindak Lanjut : </strong><?php echo $tindak_lanjut ?>
                <br><strong>Ruang : <?php echo $r->nama_ruangan; ?></strong>
                <strong>Kamar : <?php echo $r->nama_kamar . " Kelas : " . $r->nama_kelas . " Bed : " . $r->no_bed . " Klasifikasi : " . $r->klasifikasi; ?></strong>
            </td>
        </tr>
    <?php
    } else {
        $tindak_lanjut = "Rujuk"; ?>
        <tr>
            <td colspan="2"><strong>Tindak Lanjut : </strong><?php echo $tindak_lanjut ?>
                <br><strong>Rujuk Ke : </strong><?php echo $q->rujuk_ke ?>
                <br><strong>Alasan Rujuk : </strong><?php echo $q->alasan_rujuk ?>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<style>
    html {
        font-family: sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }

    * {
        padding-left: 5px;
        padding-right: 5px;
    }

    table,
    td,
    th {
        font-family: sans-serif;
        padding: 0px;
        margin: 0px;
        font-size: 13px;
    }

    /*input.text{
        height:5px;
    }*/
</style>