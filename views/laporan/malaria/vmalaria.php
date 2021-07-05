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
            var url = "<?php echo site_url('laporan/cetakxkr15')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("laporan/xkr15");?>/"+tgl1+"/"+tgl2;
        });
    });  
</script>
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
                        LAPORAN KASUS MALARIA
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
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <br>
            <ol>
            <li>Jumlah Kasus<br><br>
            <table border="1" class="laporan" width="100%">
                <thead>
                    <tr>
                        <td class='text-center'>No</td>
                        <td colspan="2" class='text-center'>STATUS</td>
                        <td class='text-center'>JML KASUS SEBELUMNYA</td>
                        <td class="text-center">JML KASUS BARU</td>
                        <td class="text-center">PROSES PENGOBATAN</td>
                        <td class="text-center">SEMBUH</td>
                        <td class="text-center">MENINGGAL</td>
                        <td class="text-center">TOTAL</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="3" class='text-right'>1.</td>
                        <td rowspan="3">MILITER</td>
                        <td>SATPUR</td>
                        <td class="text-right"><?php echo (isset($s["SATPUR"]) ? $s["SATPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATPUR"]) ? $p["SATPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATPUR"]) ? $p["SATPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SEMBUH"]["SATPUR"]) ? $p["SEMBUH"]["SATPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["MENINGGAL"]["SATPUR"]) ? $p["MENINGGAL"]["SATPUR"] : "");?></td>
                        <?php 
                            $jumlah = (isset($p["SEMBUH"]["SATPUR"]) ? $p["SEMBUH"]["SATPUR"] : 0)+
                            (isset($p["MENINGGAL"]["SATPUR"]) ? $p["MENINGGAL"]["SATPUR"] : 0);
                        ?>
                        <td class='text-right'><?php echo $jumlah;?></td>
                    </tr>
                    <tr>
                        <td>SATBANPUR</td>
                        <td class="text-right"><?php echo (isset($s["SATBANPUR"]) ? $s["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SEMBUH"]["SATBANPUR"]) ? $p["SEMBUH"]["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["MENINGGAL"]["SATBANPUR"]) ? $p["MENINGGAL"]["SATBANPUR"] : "");?></td>
                        <?php 
                            $jumlah = (isset($p["SEMBUH"]["SATBANPUR"]) ? $p["SEMBUH"]["SATBANPUR"] : 0)+
                            (isset($p["MENINGGAL"]["SATBANPUR"]) ? $p["MENINGGAL"]["SATBANPUR"] : 0);
                        ?>
                        <td class='text-right'><?php echo $jumlah;?></td>
                    </tr>
                    <tr>
                        <td>SATBANMIN</td>
                        <td class="text-right"><?php echo (isset($s["SATBANPUR"]) ? $s["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SEMBUH"]["SATBANPUR"]) ? $p["SEMBUH"]["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["MENINGGAL"]["SATBANPUR"]) ? $p["MENINGGAL"]["SATBANPUR"] : "");?></td>
                        <?php 
                            $jumlah = (isset($p["SEMBUH"]["SATBANPUR"]) ? $p["SEMBUH"]["SATBANPUR"] : 0)+
                            (isset($p["MENINGGAL"]["SATBANPUR"]) ? $p["MENINGGAL"]["SATBANPUR"] : 0);
                        ?>
                        <td class='text-right'><?php echo $jumlah;?></td>
                    </tr>
                    <tr>
                        <td class='text-right'>2.</td>
                        <td colspan="2">PNS/ TBS</td>
                        <td class="text-right"><?php echo (isset($s["PNS"]) ? $s["PNS"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["PNS"]) ? $p["PNS"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["PNS"]) ? $p["PNS"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SEMBUH"]["PNS"]) ? $p["SEMBUH"]["PNS"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["MENINGGAL"]["PNS"]) ? $p["MENINGGAL"]["PNS"] : "");?></td>
                        <?php 
                            $jumlah = (isset($p["SEMBUH"]["PNS"]) ? $p["SEMBUH"]["PNS"] : 0)+
                            (isset($p["MENINGGAL"]["PNS"]) ? $p["MENINGGAL"]["PNS"] : 0);
                        ?>
                        <td class='text-right'><?php echo $jumlah;?></td>
                    </tr>
                    <tr>
                        <td class='text-right'>3.</td>
                        <td colspan="2">KELUARGA TNI</td>
                        <td class="text-right"><?php echo (isset($s["KELUARGA"]) ? $s["KELUARGA"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["KELUARGA"]) ? $p["KELUARGA"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["KELUARGA"]) ? $p["KELUARGA"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SEMBUH"]["KELUARGA"]) ? $p["SEMBUH"]["KELUARGA"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["MENINGGAL"]["KELUARGA"]) ? $p["MENINGGAL"]["KELUARGA"] : "");?></td>
                        <?php 
                            $jumlah = (isset($p["SEMBUH"]["KELUARGA"]) ? $p["SEMBUH"]["KELUARGA"] : 0)+
                            (isset($p["MENINGGAL"]["KELUARGA"]) ? $p["MENINGGAL"]["KELUARGA"] : 0);
                        ?>
                        <td class='text-right'><?php echo $jumlah;?></td>
                    </tr>
                    <tr>
                        <td class='text-right'>4.</td>
                        <td colspan="2">UMUM</td>
                        <td class="text-right"><?php echo (isset($s["UMUM"]) ? $s["UMUM"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["UMUM"]) ? $p["UMUM"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["UMUM"]) ? $p["UMUM"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["SEMBUH"]["UMUM"]) ? $p["SEMBUH"]["UMUM"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["MENINGGAL"]["UMUM"]) ? $p["MENINGGAL"]["UMUM"] : "");?></td>
                        <?php 
                            $jumlah = (isset($p["SEMBUH"]["UMUM"]) ? $p["SEMBUH"]["UMUM"] : 0)+
                            (isset($p["MENINGGAL"]["UMUM"]) ? $p["MENINGGAL"]["UMUM"] : 0);
                        ?>
                        <td class='text-right'><?php echo $jumlah;?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">JUMLAH</td>
                        <td class='text-right'></td>
                        <td class='text-right'></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            </li>
            <li>Jumlah Kasus Menurut Kelompok Umur<br><br>
                <table border="1" class="laporan" width="100%">
                    <thead>
                        <tr>
                            <td class='text-center'>No</td>
                            <td class='text-center'>UMUR</td>
                            <td class='text-center'>JML KASUS SEBELUMNYA</td>
                            <td class="text-center">JML KASUS BARU</td>
                            <td class="text-center">PROSES PENGOBATAN</td>
                            <td class="text-center">SEMBUH</td>
                            <td class="text-center">MENINGGAL</td>
                            <td class="text-center">TOTAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. </td>
                            <td>0-11 Bln</td>
                            <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                            <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2. </td>
                            <td>1-4 Thn</td>
                            <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                            <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3. </td>
                            <td>5-9 Thn</td>
                            <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                            <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4. </td>
                            <td>10-14 Thn</td>
                            <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                            <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5. </td>
                            <td>15-54 Thn</td>
                            <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                            <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>6. </td>
                            <td>> 54 Thn</td>
                            <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                            <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jumlah</td>
                            <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                            <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </li>
            </ol>
        </div>
    </div>
</div>
<style type="text/css">
    table.laporan {border-collapse: collapse;}
    .laporan td    {padding: 6px;}
</style>