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
                        LAPORAN PERAWATAN MONDOK
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
            <table border="1" class="laporan" width="100%">
                <thead>
                    <tr>
                        <td class='text-center'>No</td>
                        <td colspan="3" class='text-center'>GOLONGAN PERSONAL</td>
                        <td class='text-center'>JUMLAH PENDERITA</td>
                        <td class="text-center">JUMLAH PERAWATAN</td>
                        <td class="text-center">KETERANGAN</td>
                    </tr>
                    <tr>
                        <?php
                            for($i = 1; $i <= 7 ; $i++){
                                echo "<td class='text-center'>".$i."</td>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="5" class='text-right'>1.</td>
                        <td rowspan="5">BPJS TNI AD</td>
                        <td rowspan="3">MILITER</td>
                        <td>SATPUR</td>
                        <td class="text-right"><?php echo (isset($p["SATPUR"]) ? $p["SATPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-SATPUR"]) ? $p["S-SATPUR"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SATBANPUR</td>
                        <td class="text-right"><?php echo (isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SATBANMIN</td>
                        <td class="text-right"><?php echo (isset($p["SATBANMIN"]) ? $p["SATBANMIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-SATBANMIN"]) ? $p["S-SATBANMIN"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td class="text-right"><?php echo (isset($p["SIPILTNIAD"]) ? $p["SIPILTNIAD"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-SIPILTNIAD"]) ? $p["S-SIPILTNIAD"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td class="text-right"><?php echo (isset($p["KELTNIAD"]) ? $p["KELTNIAD"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-KELTNIAD"]) ? $p["S-KELTNIAD"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">JUMLAH</td>
                        <?php 
                            $jumlah = (isset($p["SATPUR"]) ? $p["SATPUR"] : 0)+(isset($p["SATBANPUR"]) ? $p["SATBANPUR"] : 0)+(isset($p["SATBANMIN"]) ? $p["SATBANMIN"] : 0)+
                                        (isset($p["SIPILTNIAD"]) ? $p["SIPILTNIAD"] : 0)+(isset($p["KELTNIAD"]) ? $p["KELTNIAD"] : 0);
                            $sjumlah = (isset($p["S-SATPUR"]) ? $p["S-SATPUR"] : 0)+(isset($p["S-SATBANPUR"]) ? $p["S-SATBANPUR"] : 0)+(isset($p["S-SATBANMIN"]) ? $p["S-SATBANMIN"] : 0)+
                                        (isset($p["S-SIPILTNIAD"]) ? $p["S-SIPILTNIAD"] : 0)+(isset($p["S-KELTNIAD"]) ? $p["S-KELTNIAD"] : 0);
                        ?>
                        <td class="text-right"><?php echo $jumlah;?></td>
                        <td class="text-right"><?php echo $sjumlah;?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3" class='text-right'>2.</td>
                        <td rowspan="3">BPJS TNI LAIN</td>
                        <td colspan="2">MILITER</td>
                        <td class="text-right"><?php echo (isset($p["MILLAIN"]) ? $p["MILLAIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-MILLAIN"]) ? $p["S-MILLAIN"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td class="text-right"><?php echo (isset($p["SIPILLAIN"]) ? $p["SIPILLAIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-SIPILLAIN"]) ? $p["S-SIPILLAIN"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td class="text-right"><?php echo (isset($p["KELLAIN"]) ? $p["KELLAIN"] : "");?></td>
                        <td class="text-right"><?php echo (isset($p["S-KELLAIN"]) ? $p["S-KELLAIN"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">JUMLAH</td>
                        <?php 
                            $jumlah2 = (isset($p["MILLAIN"]) ? $p["MILLAIN"] : 0)+(isset($p["SIPILLAIN"]) ? $p["SIPILLAIN"] : 0)+(isset($p["KELLAIN"]) ? $p["KELLAIN"] : 0);
                            $sjumlah2 = (isset($p["S-MILLAIN"]) ? $p["S-MILLAIN"] : 0)+(isset($p["S-SIPILLAIN"]) ? $p["S-SIPILLAIN"] : 0)+(isset($p["S-KELLAIN"]) ? $p["S-KELLAIN"] : 0);
                        ?>
                        <td class="text-right"><?php echo $jumlah2;?></td>
                        <td class="text-right"><?php echo $sjumlah2;?></td>
                        <td></td>
                    </tr>
                    <!-- <tr>
                        <td rowspan="3" class='text-right'>3.</td>
                        <td rowspan="3">BPJS TNI AU</td>
                        <td colspan="2">MILITER</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">JUMLAH</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3" class='text-right'>4.</td>
                        <td rowspan="3">POLRI</td>
                        <td colspan="2">MILITER</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">SIPIL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">KELUARGA</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">JUMLAH</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td class="text-right">5.</td>
                        <td colspan="3">PURNAWIRAWAN</td>
                        <td class='text-right'><?php echo (isset($p["PURNBPJS"]) ? $p["PURNBPJS"] : "");?></td>
                        <td class='text-right'><?php echo (isset($p["S-PURNBPJS"]) ? $p["S-PURNBPJS"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-right">6.</td>
                        <td colspan="3">BPJS DAN ASKES SELAIN TNI</td>
                        <td class='text-right'><?php echo (isset($p["UMUMBPJS"]) ? $p["UMUMBPJS"] : "");?></td>
                        <td class='text-right'><?php echo (isset($p["S-UMUMBPJS"]) ? $p["S-UMUMBPJS"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-right">7.</td>
                        <td colspan="3">UMUM DAN PERUSAHAAN</td>
                        <td class='text-right'><?php echo (isset($p["UMUMPERUSAHAAN"]) ? $p["UMUMPERUSAHAAN"] : "");?></td>
                        <td class='text-right'><?php echo (isset($p["S-UMUMPERUSAHAAN"]) ? $p["S-UMUMPERUSAHAAN"] : "");?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">JUMLAH</td>
                        <?php
                            $total = $jumlah+$jumlah2+(isset($p["PURNBPJS"]) ? $p["PURNBPJS"] : 0)+(isset($p["UMUMBPJS"]) ? $p["UMUMBPJS"] : 0)+(isset($p["UMUMPERUSAHAAN"]) ? $p["UMUMPERUSAHAAN"] : 0);
                            $stotal = $sjumlah+$sjumlah2+(isset($p["S-PURNBPJS"]) ? $p["S-PURNBPJS"] : 0)+(isset($p["S-UMUMBPJS"]) ? $p["S-UMUMBPJS"] : 0)+(isset($p["S-UMUMPERUSAHAAN"]) ? $p["S-UMUMPERUSAHAAN"] : 0);
                        ?>
                        <td class='text-right'><?php echo number_format($total,0,',','.');?></td>
                        <td class='text-right'><?php echo number_format($stotal,0,',','.');?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style type="text/css">
    table.laporan {border-collapse: collapse;}
    .laporan td    {padding: 6px;}
</style>