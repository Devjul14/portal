<script src="<?php echo base_url();?>js/amcharts/amcharts.js"></script>
<script src="<?php echo base_url();?>js/amcharts/pie.js"></script>
<script src="<?php echo base_url();?>js/amcharts/serial.js"></script>
<link  type="text/css" href="<?php echo base_url();?>js/amcharts/plugins/export/export.css" rel="stylesheet">
<script>
    $(document).ready(function() { 
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 3,
                "position": "bottom",
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": <?php echo $p;?>,
            "valueAxes": [{
                    "id": "jumlah",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Jumlah Pasien (%)",
                },{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]] : <b>[[value]]%</b>",
                "fillAlphas" : 1,
                "fillColors" : "#0073b7",
                "lineColor" : "#0073b7",
                "lineThickness": 2,
                "type": "column",
                "title": "Jumlah Pasien Kota (%)",
                "columnWidth":0.5,
                "valueField": "jumlah",
                "valueAxis": "jumlah",
            },
            {
                "balloonText": "[[category]] : <b>[[value]]%</b>",
                "fillAlphas" : 1,
                "fillColors" : "#00a65a",
                "lineColor" : "#00a65a",
                "lineThickness": 2,
                "type": "column",
                "title": "Jumlah Pasien Selain Kota Pilihan (%)",
                "columnWidth":0.5,
                "valueField": "selainjumlah",
                "valueAxis": "selainjumlah",
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "bulan",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90,
                "autoGridCount": false,
                "gridCount": 32
            },
            "export": {
                "enabled": true
             }
        });
        var chart = AmCharts.makeChart("chartdiv_pi", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 3,
                "position": "bottom",
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": <?php echo $pi;?>,
            "valueAxes": [{
                    "id": "jumlah",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Jumlah Pasien (%)",
                },{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]] : <b>[[value]]%</b>",
                "fillAlphas" : 1,
                "fillColors" : "#0073b7",
                "lineColor" : "#0073b7",
                "lineThickness": 2,
                "type": "column",
                "title": "Jumlah Pasien Kota (%)",
                "columnWidth":0.5,
                "valueField": "jumlah",
                "valueAxis": "jumlah",
            },
            {
                "balloonText": "[[category]] : <b>[[value]]%</b>",
                "fillAlphas" : 1,
                "fillColors" : "#00a65a",
                "lineColor" : "#00a65a",
                "lineThickness": 2,
                "type": "column",
                "title": "Jumlah Pasien Selain Kota Pilihan (%)",
                "columnWidth":0.5,
                "valueField": "selainjumlah",
                "valueAxis": "selainjumlah",
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "bulan",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90,
                "autoGridCount": false,
                "gridCount": 32
            },
            "export": {
                "enabled": true
             }
        });
        $("[name='tgl']").datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'dd-mm-yy',
            onClose: function(dateText, inst) { 
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
        $("[name='kota']").select2();
        $("[name='tgl']").focus(function () {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });
        $(".search").click(function(){
            var tgl = $("[name='tgl']").val();
            var kota = $("[name='kota']").val();
            var url = "<?php echo site_url("home/indeksalamat");?>/"+tgl+"/"+kota;
            window.location = url;
        })
    });
</script>
<?php
    $listkota = array();
    foreach($row->result() as $data){
        $listkota[$data->id_kota] = $data->name;
    }
    foreach($row_pi->result() as $data){
        $listkota[$data->id_kota] = $data->name;
    }
    ksort($listkota);
?>
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">Kota</label>
                    <div class="col-md-10">
                        <select name="kota" class="form-control">
                            <?php
                                foreach($listkota as $key => $data){
                                    echo "<option value='".$key."' ".($key==$kota ? "selected" : "").">".$data."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Bulan/ Tahun</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="tgl" value="<?php echo date("d-m-Y",strtotime($tgl));?>" autocomplete="off"/>
                            <span class="input-group-btn"><button type="button" class="search btn btn-info"><i class="fa fa-search"></i></button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <h4 class="box-title">Rawat Jalan</h4>
            <div class="col-md-8">
                <div id="chartdiv" style="height: 550px;"></div>
            </div>
            <div class="col-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped" id="myTable">
                        <thead>
                            <tr class='bg-navy'>
                                <th class="text-center" style="vertical-align: middle">No.</th>
                                <th class="text-center" style="vertical-align: middle">Nama Kota</th>
                                <th class="text-center" style="vertical-align: middle">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                $total = 0;
                                foreach($row->result() as $data){
                                    echo "<tr ".($data->id_kota==$kota ? "class='bg-orange'" : "").">";
                                    echo "<td width='20px' class='text-right'>".($i++)."</td>";
                                    echo "<td>".$data->name."</td>";
                                    echo "<td width='80px' class='text-right'>".$data->jumlah."</td>";
                                    echo "</tr>";
                                    $total += $data->jumlah;
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-navy">
                                <td colspan='2'>Jumlah</td>
                                <td class="text-right"><?php echo $total;?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Rawat Inap</h3></div>
        <div class="box-body">
            <div class="col-md-8">
                <div id="chartdiv_pi" style="height: 550px;"></div>
            </div>
            <div class="col-md-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped" id="myTable">
                        <thead>
                            <tr class='bg-navy'>
                                <th class="text-center" style="vertical-align: middle">No.</th>
                                <th class="text-center" style="vertical-align: middle">Nama Kota</th>
                                <th class="text-center" style="vertical-align: middle">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                $total = 0;
                                foreach($row_pi->result() as $data){
                                    echo "<tr ".($data->id_kota==$kota ? "class='bg-orange'" : "").">";
                                    echo "<td width='20px' class='text-right'>".($i++)."</td>";
                                    echo "<td>".$data->name."</td>";
                                    echo "<td width='80px' class='text-right'>".$data->jumlah."</td>";
                                    echo "</tr>";
                                    $total += $data->jumlah;
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-navy">
                                <td colspan='2'>Jumlah</td>
                                <td class="text-right"><?php echo $total;?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    #chartdiv > div > div > a { display: none !important; }
    #chartdiv_pi > div > div > a { display: none !important; }
    .ui-datepicker-month, .ui-datepicker-year{
        color: #1e1b1d;
    }
</style>