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
    $(document).ajaxStart(function () {
        $('.loading').show();
    }).ajaxStop(function () {
        $('.loading').hide();
        $(".modaldetail").modal("show");
    });
	$(document).ready(function(e){
		var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".print").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('laporan/cetakkunjunganranap')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".excel").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('laporan/excelkunjunganranap')?>/"+tgl1+"/"+tgl2;
            window.location = url;
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("laporan/kunjunganranap");?>/"+tgl1+"/"+tgl2;
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
                    <div class="col-md-2"><button class="search btn btn-sm btn-primary" type="button"> <i class="fa fa-search"></i> Search</button></div>
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
                        KUNJUNGAN RAWAT INAP
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
                            <th>No. SEP</th>
                            <th>Tgl. SEP</th>
                            <th>RIRJ</th>
                            <th>No. Kartu</th>
                            <th>MR</th>
                            <th>Nama Pasien</th>
                            <th>Diagnosa</th>
                            <th>Poli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach($q->result() as $row){
                                echo "<tr>";
                                echo "<td>".($i++)."</td>";
                                echo "<td>".$row->no_sjp."</td>";
                                echo "<td>".date("d-m-Y",strtotime($row->tgl_keluar))."</td>";
                                echo "<td>RI</td>";
                                echo "<td>".$row->no_bpjs."</td>";
                                echo "<td>".$row->no_rm."</td>";
                                echo "<td>".$row->nama_pasien."</td>";
                                echo "<td>".$row->kode."</td>";
                                echo "<td></td>";
                                echo "<tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>