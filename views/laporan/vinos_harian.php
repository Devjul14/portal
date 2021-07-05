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
        $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("laporan/inos_harian");?>/"+tgl1+"/"+tgl2;
        });
        $(".print").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('laporan/cetakinos_harian')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".excel").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('laporan/excelinos_harian')?>/"+tgl1+"/"+tgl2;
            window.location = url;
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
                            <input type="text" class="form-control input-sm" name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control input-sm" name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" autocomplete="off"/>   
                    </div>
                    <div class="col-md-2"><button class="search btn btn-primary btn-sm" type="button"> <i class="fa fa-search"></i> Search</button></div>
                    <div class="col-md-2">
                        <div class="btn-group">
                            <button type="button" class="print btn btn-sm btn-info"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
                            <button type="button" class="excel btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel</button>
                        </div>
                    </div>
                </div>
            </div>
            <table  width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        INOS HARIAN
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="width:2000px">
                    <thead>
                        <tr class="bg-navy">
                            <td rowspan="2" class='text-center' width="30px">No</td>
                            <td rowspan="2" class='text-center' width="150px">Nama</td>
                            <td rowspan="2" class='text-center' width="100px">Diagnosa Penyakit</td>
                            <td rowspan="2" class='text-center' width="100px">JK / Umur</td>
                            <td rowspan="2" class='text-center' width="100px">NO RM</td>
                            <td rowspan="2" class='text-center' width="100px">Tgl Masuk</td>
                            <td rowspan="2" class='text-center' width="100px">Tgl Keluar</td>
                            <td colspan="<?php echo ($q->num_rows()*2);?>" class='text-center' width="<?php echo ($q->num_rows()*2*100)."px";?>">Jenis Infeksi Rumah Sakit</td>
                        </tr>
                        <tr class="bg-navy">
                            <?php
                                foreach ($q->result() as $value) {
                                    echo "
                                        <td class='text-center' width=100px>".$value->kode."</td>
                                        <td class='text-center' width=100px>Tgl Kejadian</td>
                                    ";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach ($row["data"] as $key => $value) {
                                $t1 = new DateTime('today');
                                $t2 = new DateTime($value->tgl_lahir);
                                $y  = $t1->diff($t2)->y;
                                $m  = $t1->diff($t2)->m;
                                $d  = $t1->diff($t2)->d;
                                $i++;
                                echo "
                                    <tr id=data>
                                        <td>".$i."</td>
                                        <td>".$value->nama_pasien."</td>
                                        <td>".$value->diagnosa_penyakit."</td>
                                        <td class='text-center'>".$value->jenis_kelamin." / ".$y.' Tahun'."</td>
                                        <td>".$value->no_rm."</td>
                                        <td class='text-center'>".date('d-m-Y',strtotime($value->tgl_masuk))."</td>
                                        <td class='text-center'>".($value->tgl_keluar ? date('d-m-Y',strtotime($value->tgl_keluar)) : "-")."</td>";
                                    foreach ($q->result() as $val) {
                                        $inos = isset($row["inos"][$key][$val->kode]) ? $row["inos"][$key][$val->kode] : "";
                                        if ($inos!=""){
                                            echo "
                                                <td class='text-center'>".$inos->spesialisasi."</td>
                                                <td class='text-center'>".date("d-m-Y",strtotime($inos->tgl_inos))."</td>
                                            ";
                                        } else {
                                            echo "
                                                <td class='text-center'>-</td>
                                                <td class='text-center'>-</td>
                                            ";
                                        }
                                    }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>