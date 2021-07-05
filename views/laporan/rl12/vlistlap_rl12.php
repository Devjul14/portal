<script>
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(e){
        // window.print();
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".print").click(function(){
            var id = $(".bg-gray").attr("href");
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('laporan/rl12')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("laporan/list_rl12");?>/"+tgl1+"/"+tgl2;
        });
        // $(".search").click(function(){
        //     var tgl1 = $("[name='tgl1']").val();
        //     var tgl2 = $("[name='tgl2']").val();
        //     var arrayData = {tgl1: tgl1,tgl2: tgl2};
        //     $.ajax({
        //         url: "<?php echo site_url('laporan/search');?>", 
        //         type: 'POST', 
        //         data: arrayData, 
        //         success: function(){
        //             location.reload();
        //         }
        //     });
        // });
    });  
</script>
<body>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal</label>
                        <div class="col-md-2">
                                <input type="text" class="form-control" name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" autocomplete="off"/>
                        </div>
                        <div class="col-md-2">
                                <input type="text" class="form-control" name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" autocomplete="off"/>   
                        </div>
                        <div class="col-md-1">
                            <div class="pull-left">
                                 <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="print btn btn-success pull-right" type = "button" ><i class="fa fa-print"></i>&nbsp;Cetak</button>   
                        </div>
                </div>
            </div>
            <table  width="100%" align="right" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        DATA PASIEN RAWAT JALAN
                    </td>
                    <td></td>
                </tr>
                <?php
                    $bulan = array(
                                "",
                                "JANUARI",
                                "FEBRUARI",
                                "MARET",
                                "APRIL",
                                "MEI",
                                "JUNI",
                                "JULI",
                                "AGUSTUS",
                                "SEPTEMBER",
                                "OKTOBER",
                                "NOPEMBER",
                                "DESEMBER"
                            );
                ?>
                <tr>
                    <td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." - ".date("d-m-Y",strtotime($tgl2)); ?></td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2">TAHUN : <?php echo date("Y") ?></td>
                </tr>
            </table>
            <br>
            <table border="1" cellspacing="0" cellpadding="1" width="100%">
                <thead>
                    <tr>
                        <td width="30" rowspan="4" class='text-center'>No</td>
                        <td rowspan="3" class="text-center">Jenis Pelayanan Rawat Jalan</td>
                        <td width="300" colspan = "12" class='text-center'>Jumlah Pengunjung</td>
                        <td width="300" colspan = "12" class='text-center'>Jumlah Kunjungan</td>
                        <td width="200" colspan = "4" class='text-center'>Tindak Lanjut Pelayanan</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center">Angkatan Darat</td>
                        <td colspan="4" class="text-center">Angkatan Lain</td>
                        <td colspan="2" class="text-center">BPJS</td>
                        <td rowspan="2" class="text-center">PASIEN UMUM</td>
                        <td rowspan="2" class="text-center">JML</td>

                        <td colspan="4" class="text-center">Angkatan Darat</td>
                        <td colspan="4" class="text-center">Angkatan Lain</td>
                        <td colspan="2" class="text-center">BPJS</td>
                        <td rowspan="2" class="text-center">PASIEN UMUM</td>
                        <td rowspan="2" class="text-center">JML</td>

                        <td rowspan="2" class="text-center">RUJUKAN</td>
                        <td rowspan="2" class="text-center">RAWAT INAP</td>
                        <td rowspan="2" class="text-center">LAIN LAIN</td>
                        <td rowspan="2" class="text-center">JML</td>
                    </tr>
                    <tr>
                        <td class="text-center">MIL</td>
                        <td class="text-center">PNS</td>
                        <td class="text-center">KEL</td>
                        <td class="text-center">JML</td>

                        <td class="text-center">MIL</td>
                        <td class="text-center">PNS</td>
                        <td class="text-center">KEL</td>
                        <td class="text-center">JML</td>

                        <td class="text-center">PURN</td>
                        <td class="text-center">UMUM</td>

                        <td class="text-center">MIL</td>
                        <td class="text-center">PNS</td>
                        <td class="text-center">KEL</td>
                        <td class="text-center">JML</td>

                        <td class="text-center">MIL</td>
                        <td class="text-center">PNS</td>
                        <td class="text-center">KEL</td>
                        <td class="text-center">JML</td>

                        <td class="text-center">PURN</td>
                        <td class="text-center">UMUM</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    <?php foreach ($p->result() as $value): ?>
                        <?php $i++; ?>
                        <?php
                            $miltniad_pengunjung           = (isset($q1[$value->kode]) ? $q1[$value->kode] : "-"); 
                            // $sipiltniad_pengunjung         = (isset($q1[$value->kode]["SIPILTNIAD"]) ? $q1[$value->kode]["SIPILTNIAD"] : "-"); 
                            // $keltniad_pengunjung           = (isset($q1[$value->kode]["KELTNIAD"]) ? $q1[$value->kode]["KELTNIAD"] : "-"); 
                            // $jmltniad_pengunjung           = ($miltniad_pengunjung+$sipiltniad_pengunjung+$keltniad_pengunjung);

                            // $millain_pengunjung            = (isset($q1[$value->kode]["MILLAIN"]) ? $q1[$value->kode]["MILLAIN"] : "-"); 
                            // $sipillain_pengunjung          = (isset($q1[$value->kode]["SIPILLAIN"]) ? $q1[$value->kode]["SIPILLAIN"] : "-"); 
                            // $kellain_pengunjung            = (isset($q1[$value->kode]["KELLAIN"]) ? $q1[$value->kode]["KELLAIN"] : "-"); 
                            // $jmllain_pengunjung            = ($millain_pengunjung+$sipillain_pengunjung+$kellain_pengunjung);

                            // $purnbpjs_pengunjung           = (isset($q1[$value->kode]["PURNBPJS"]) ? $q1[$value->kode]["PURNBPJS"] : "-"); 
                            // $umumbpjs_pengunjung           = (isset($q1[$value->kode]["UMUMBPJS"]) ? $q1[$value->kode]["UMUMBPJS"] : "-"); 

                            // $umumperusahaan_pengunjung     = (isset($q1[$value->kode]["UMUMPERUSAHAAN"]) ? $q1[$value->kode]["UMUMPERUSAHAAN"] : "-"); 

                            // $jml_pengunjung                = $jmltniad_pengunjung+$jmllain_pengunjung+$purnbpjs_pengunjung+$umumbpjs_pengunjung+$umumperusahaan_pengunjung;

                        ?>
                        <?php
                            $miltniad           = (isset($q[$value->kode]["MILTNIAD"]) ? $q[$value->kode]["MILTNIAD"] : "-"); 
                            $sipiltniad         = (isset($q[$value->kode]["SIPILTNIAD"]) ? $q[$value->kode]["SIPILTNIAD"] : "-"); 
                            $keltniad           = (isset($q[$value->kode]["KELTNIAD"]) ? $q[$value->kode]["KELTNIAD"] : "-"); 
                            $jmltniad           = ($miltniad+$sipiltniad+$keltniad);

                            $millain            = (isset($q[$value->kode]["MILLAIN"]) ? $q[$value->kode]["MILLAIN"] : "-"); 
                            $sipillain          = (isset($q[$value->kode]["SIPILLAIN"]) ? $q[$value->kode]["SIPILLAIN"] : "-"); 
                            $kellain            = (isset($q[$value->kode]["KELLAIN"]) ? $q[$value->kode]["KELLAIN"] : "-"); 
                            $jmllain            = ($millain+$sipillain+$kellain);

                            $purnbpjs           = (isset($q[$value->kode]["PURNBPJS"]) ? $q[$value->kode]["PURNBPJS"] : "-"); 
                            $umumbpjs           = (isset($q[$value->kode]["UMUMBPJS"]) ? $q[$value->kode]["UMUMBPJS"] : "-"); 

                            $umumperusahaan     = (isset($q[$value->kode]["UMUMPERUSAHAAN"]) ? $q[$value->kode]["UMUMPERUSAHAAN"] : "-"); 

                            $jml                = $jmltniad+$jmllain+$purnbpjs+$umumbpjs+$umumperusahaan;

                        ?>
                        <tr>
                            <td class="text-center"><?=$i;?>.</td>
                            <td><?=$value->keterangan;?></td>
                            <td class="text-center"><?=$miltniad_pengunjung;?></td>
                            <td class="text-center"><?=$sipiltniad_pengunjung;?></td>
                            <td class="text-center"><?=$keltniad_pengunjung;?></td>
                            <td class="text-center"><?=$jmltniad_pengunjung;?></td>
                            <td class="text-center"><?=$millain_pengunjung;?></td>
                            <td class="text-center"><?=$sipillain_pengunjung;?></td>
                            <td class="text-center"><?=$kellain_pengunjung;?></td>
                            <td class="text-center"><?=$jmllain_pengunjung;?></td>
                            <td class="text-center"><?=$purnbpjs_pengunjung;?></td>
                            <td class="text-center"><?=$umumbpjs_pengunjung;?></td>
                            <td class="text-center"><?=$umumperusahaan_pengunjung;?></td>
                            <td class="text-center"><?=$jml_pengunjung;?></td>

                            <td class="text-center"><?=$miltniad;?></td>
                            <td class="text-center"><?=$sipiltniad;?></td>
                            <td class="text-center"><?=$keltniad;?></td>
                            <td class="text-center"><?=$jmltniad;?></td>
                            <td class="text-center"><?=$millain;?></td>
                            <td class="text-center"><?=$sipillain;?></td>
                            <td class="text-center"><?=$kellain;?></td>
                            <td class="text-center"><?=$jmllain;?></td>
                            <td class="text-center"><?=$purnbpjs;?></td>
                            <td class="text-center"><?=$umumbpjs;?></td>
                            <td class="text-center"><?=$umumperusahaan;?></td>
                            <td class="text-center"><?=$jml;?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style type="text/css">
    html, body {
        /*display: block;*/
        /*font-family: "dotmatrik";*/
        /*width: 20cm; height: 13cm;*/
    }
    .pull-right {
        float: right;
    }
    .pull-left {
        float: left;
    }
    th, td{
        /*font-family: "dotmatrik";*/
    }
    td {
        font-size: 12px;
    }
    th {
        font-size: 12px;
        font-weight: bold;
    }
    .text-right{
        /*align:right;*/
    }
    textarea{
        /*font-size: 12px;*/
    }
    /*@page{
        width: 20cm; height: 13cm;
    }*/
</style>
</body>
</html>