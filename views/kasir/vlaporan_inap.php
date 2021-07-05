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
            var frm = $("[name='frm']").val();
            var url = "<?php echo site_url('kasir/cetak_laporan_inap')?>/"+frm+"/"+tgl1+"/"+tgl2+"/"+golpas;
            openCenteredWindow(url);
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var golpas = $("[name='golpas']").val();
            var frm = $("[name='frm']").val();
            window.location = "<?php echo site_url("kasir/laporan_inap");?>/"+frm+"/"+tgl1+"/"+tgl2+"/"+golpas;
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
                        <select class="form-control" name='frm'>
                            <option value='all' <?php echo ($frm=="all" ? "selected" : "");?>>---</option>
                            <option value='0' <?php echo ($frm=="0" ? "selected" : "");?>>PELAYANAN</option>
                            <option value='1' <?php echo ($frm=="1" ? "selected" : "");?>>APOTEK</option>
                            <option value='2' <?php echo ($frm=="2" ? "selected" : "");?>>SHARING</option>
                            <option value='3' <?php echo ($frm=="3" ? "selected" : "");?>>PARSIAL</option>
                        </select>
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
                        LAPORAN RAWAT INAP
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
                            <th class="text-center">Jumlah</th>
                            <?php if($frm=="all") :?>
                            <th class="text-center">Sharing</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no_reg = "";
                            $i = 1;
                            $jumlah = 0;
                            $blu = 0;
                            if ($frm=="all" || $frm==0 || $frm==1 || $frm==2){
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
                                            echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                            echo "<td>".$row->no_reg."</td>";
                                            echo "<td>".$row->no_pasien."</td>";
                                            echo "<td>".$row->nama_pasien."</td>";
                                            echo "<td>".$row->ket_golpas."</td>";
                                            echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                            if ($frm=="all")
                                                echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                            echo "</tr>";
                                            $jumlah += $row->jumlah;
                                            $blu += $row->blu;
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td>".($i++)."</td>";
                                        echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                        echo "<td>".$row->no_reg."</td>";
                                        echo "<td>".$row->no_pasien."</td>";
                                        echo "<td>".$row->nama_pasien."</td>";
                                        echo "<td>".$row->ket_golpas."</td>";
                                        echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                        if ($frm=="all")
                                                echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                        echo "</tr>";
                                        $jumlah += $row->jumlah;
                                        $blu += $row->blu;
                                    }
                                }
                            }  
                            if ($frm=="all" || $frm==1){
                                if ($golpas=="all" || $golpas=="UMUM"){
                                    foreach ($a->result() as $row) {
                                        $str_golpas = "UMUM";
                                        echo "<tr>";
                                        echo "<td>".($i++)."</td>";
                                        echo "<td>".date("d-m-Y",strtotime($row->tanggal))."</td>";
                                        echo "<td>".$row->no_reg."</td>";
                                        echo "<td>".$row->no_rm."</td>";
                                        echo "<td>".$row->nama_pasien."</td>";
                                        echo "<td>".$str_golpas."</td>";
                                        echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                        echo "</tr>";
                                        $jumlah += $row->jumlah;
                                    }
                                }
                            }  
                            if ($frm=="all" || $frm==3){
                                foreach ($p->result() as $row) {
                                    if ($row->gol_pasien==11){
                                        $str_golpas = "UMUM";
                                    } else 
                                    if ($row->gol_pasien>=12 && $row->gol_pasien<=18){
                                        $str_golpas = "PERUSAHAAN";
                                    } else {
                                        $str_golpas = "BPJS";
                                    }
                                    if ($no_reg!=$row->no_reg){
                                        if ($golpas!="all"){
                                            if ($golpas==$str_golpas){
                                                echo "<tr>";
                                                echo "<td>".($i++)."</td>";
                                                echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                                echo "<td>".$row->no_reg."</td>";
                                                echo "<td>".$row->no_pasien."</td>";
                                                echo "<td>".$row->nama_pasien."</td>";
                                                echo "<td>".$row->ket_golpas."</td>";
                                                echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                                if ($frm=="all")
                                                    echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                                echo "</tr>";
                                                $jumlah += $row->jumlah;
                                                $blu += $row->blu;
                                            }
                                        } else {
                                            echo "<tr>";
                                            echo "<td>".($i++)."</td>";
                                            echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                            echo "<td>".$row->no_reg."</td>";
                                            echo "<td>".$row->no_pasien."</td>";
                                            echo "<td>".$row->nama_pasien."</td>";
                                            echo "<td>".$row->ket_golpas."</td>";
                                            echo "<td class='text-right'>".number_format($row->jumlah,0,',','.')."</td>";
                                            if ($frm=="all")
                                                    echo "<td class='text-right'>".number_format($row->blu,0,',','.')."</td>";
                                            echo "</tr>";
                                            $jumlah += $row->jumlah;
                                            $blu += $row->blu;
                                        }
                                    }
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-navy">
                            <th colspan=6>JUMLAH</th>
                            <th class="text-right"><?php echo number_format($jumlah,0,',','.');?></th>
                            <?php
                                if ($frm=="all"){
                                    echo "<th class='text-right'>".number_format($blu,0,',','.')."</th>";
                                }
                            ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>