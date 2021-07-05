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
        $("[name='poli']").select2();
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
            var golpas = $("[name='golpas']").val();
            var url = "<?php echo site_url('kasir/cetak_keuangan')?>/"+tgl1+"/"+tgl2+"/"+golpas;
            openCenteredWindow(url);
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var golpas = $("[name='golpas']").val();
            var frm = $("[name='frm']").val();
            window.location = "<?php echo site_url("kasir/keuangan");?>/"+tgl1+"/"+tgl2+"/"+golpas;
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
                    <div class="col-md-2">
                        <select class="form-control" name='golpas'>
                            <option value="all">---</option>
                            <option value='UMUM' <?php echo ($golpas=="UMUM" ? "selected" : "");?>>UMUM</option>
                            <option value='PERUSAHAAN' <?php echo ($golpas=="PERUSAHAAN" ? "selected" : "");?>>PERUSAHAAN</option>
                            <option value='BPJS' <?php echo ($golpas=="BPJS" ? "selected" : "");?>>BPJS</option>
                        </select>
                    </div>
                    <div class="col-md-2"><button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i> Search</button></div>
                    <div class="col-md-1">
                        <button class="print btn btn-success pull-right" type = "button" ><i class="fa fa-print"></i>&nbsp;Cetak</button>   
                    </div>
                </div>
            </div>
            <table  width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        LAPORAN SHARING
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr class="bg-navy">
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>No Reg</th>
                            <th>No RM</th>
                            <th>Nama</th>
                            <th>Gol. Pasien</th>
                            <th class="text-center">Sharing</th>
                            <th class="text-center">BLU</th>
                            <th class="text-center">Kodal</th>
                            <th class="text-center">COB</th>
                            <th class="text-center">Perusahaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no_reg = "";
                            $i = 1;
                            $jumlah = 0;
                            foreach ($q->result() as $row) {
                                if ($row->gol_pasien==11){
                                    $str_golpas = "UMUM";
                                } else 
                                if ($row->gol_pasien>=12 && $row->gol_pasien<=18){
                                    $str_golpas = "PERUSAHAAN";
                                } else {
                                    $str_golpas = "BPJS";
                                }
                                if ($golpas!="all"){
                                    if ($golpas==$str_golpas){
                                        echo "<tr>";
                                        echo "<td>".($i++)."</td>";
                                        echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                                        echo "<td>".$row->no_reg."</td>";
                                        echo "<td>".$row->no_pasien."</td>";
                                        echo "<td>".$row->nama_pasien."</td>";
                                        echo "<td>".$row->ket_golpas."</td>";
                                        echo "<td class='text-right'>".number_format($row->sharing,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($row->sharing-$row->blu,0,',','.')."</td>";
                                        echo "<td class='text-right'>".number_format($row->cob,0,',','.')."</td>";
                                        echo "<td>".$row->nama_perusahaan."</td>";
                                        echo "</tr>";
                                        $jumlah += ($row->sharing-$row->blu);
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td>".($i++)."</td>";
                                    echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                                    echo "<td>".$row->no_reg."</td>";
                                    echo "<td>".$row->no_pasien."</td>";
                                    echo "<td>".$row->nama_pasien."</td>";
                                    echo "<td>".$row->ket_golpas."</td>";
                                    echo "<td class='text-right'>".number_format($row->sharing,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($row->sharing-$row->blu,0,',','.')."</td>";
                                    echo "<td class='text-right'>".number_format($row->cob,0,',','.')."</td>";
                                    echo "<td>".$row->nama_perusahaan."</td>";
                                    echo "</tr>";
                                    $jumlah += ($row->sharing-$row->blu);
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-navy">
                            <th colspan=6>JUMLAH</th>
                            <th style='text-align:right' colspan=3><?php echo number_format($jumlah,0,',','.');?></th>
                            <th colspan=2></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>