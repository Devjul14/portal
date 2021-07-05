<script src="<?php echo base_url();?>js/amcharts/amcharts.js"></script>
<script src="<?php echo base_url();?>js/amcharts/pie.js"></script>
<script src="<?php echo base_url();?>js/amcharts/serial.js"></script>
<link  type="text/css" href="<?php echo base_url();?>js/amcharts/plugins/export/export.css" rel="stylesheet">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="fa fa-heartbeat"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pasien</span>
                        <span class="info-box-number"><?php echo number_format($total_pasien,0,',','.');?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-user-md"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien Tahun Ini</span>
                        <span class="info-box-number">Jumlah<span class='pull-right'><?php echo number_format($pasien_thn["ralan"]+$pasien_thn["inap"],0,',','.');?></span></span>
                        <span class="info-box-text" style="font-size: 12px">Jalan<span class='pull-right'><?php echo number_format($pasien_thn["ralan"],0,',','.');?></span>
                        <span class="info-box-text" style="font-size: 12px">Inap<span class='pull-right'><?php echo number_format($pasien_thn["inap"],0,',','.');?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-stethoscope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien Bulan Ini</span>
                        <span class="info-box-number">Jumlah<span class='pull-right'><?php echo number_format($pasien_bln["ralan"]+$pasien_bln["inap"],0,',','.');?></span></span>
                        <span class="info-box-text" style="font-size: 12px">Jalan<span class='pull-right'><?php echo number_format($pasien_bln["ralan"],0,',','.');?></span>
                        <span class="info-box-text" style="font-size: 12px">Inap<span class='pull-right'><?php echo number_format($pasien_bln["inap"],0,',','.');?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-orange"><i class="fa fa-plus-square"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien Hari Ini</span>
                        <span class="info-box-number">Jumlah<span class='pull-right'><?php echo number_format($pasien_day["ralan"]+$pasien_day["inap"],0,',','.');?></span></span>
                        <span class="info-box-text" style="font-size: 12px">Jalan<span class='pull-right'><?php echo number_format($pasien_day["ralan"],0,',','.');?></span>
                        <span class="info-box-text" style="font-size: 12px">Inap<span class='pull-right'><?php echo number_format($pasien_day["inap"],0,',','.');?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-bed"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">BOR Hari Ini</span>
                        <span class="info-box-number">BOR<span class='pull-right'><?php echo $bor["bor"];?></span></span>
                        <span class="info-box-text" style="font-size: 12px">Bed Isi<span class='pull-right'><?php echo number_format($bor["jml_bed_kosong"],0,',','.');?></span>
                        <span class="info-box-text" style="font-size: 12px">Jumlah Bed<span class='pull-right'><?php echo number_format($bor["jml_bed"],0,',','.');?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-bed"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">BOR Covid Hari Ini</span>
                        <span class="info-box-number">BOR COVID-19<span class='pull-right'><?php echo $borc["bor"];?></span></span>
                        <span class="info-box-text" style="font-size: 12px">Bed Isi<span class='pull-right'><?php echo number_format($borc["jml_bed_kosong"],0,',','.');?></span>
                        <span class="info-box-text" style="font-size: 12px">Jumlah Bed<span class='pull-right'><?php echo number_format($borc["jml_bed"],0,',','.');?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK KUNJUNGAN PASIEN DALAM TAHUN</h3></div>
            <div class="box-body">
                <div id="chartdiv" style="height: 350px;"></div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>POLIKLINIK HARI INI</h3></div>
            <div class="box-body">
                <div id="chartdiv_poli" style="height: 550px;"></div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK KUNJUNGAN PASIEN PER TINDAKAN</h3></div>
            <div class="box-body">
                <div id="chartdiv_lab" style="height: 1650px;"></div>
            </div>
        </div>
    </div>
<style type="text/css">
    #chartdiv > div > div > a { display: none !important; }
    #chartdiv_poli > div > div > a { display: none !important; }
    #chartdiv_lab > div > div > a { display: none !important; }
    .ui-datepicker-month, .ui-datepicker-year{
        color: #1e1b1d;
    }
</style>
<script>
    $(document).ready(function() {
        console.log(<?php echo $graph;?>);
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
            "dataProvider": <?php echo $graph;?>,
            "valueAxes": [{
                    "id": "ralan",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Pasien Ralan/ Ranap",
                },{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Jumlah Pasien Ralan /bulan",
                "columnWidth":0.5,
                "valueField": "ralan",
                "valueAxis": "ralan",
                "lineColor": "#f56954",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Jumlah Pasien Ranap /bulan",
                "columnWidth":0.5,
                "valueField": "inap",
                "lineColor": "#3c8dbc",
                "valueAxis": "inap"
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "bulan",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90,
                "autoGridCount": true,
                "gridCount": 34
            },
            "export": {
                "enabled": true
             }
        });

        var chart = AmCharts.makeChart("chartdiv_poli", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 3,
                "position": "bottom",
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": <?php echo $poli;?>,
            "valueAxes": [{
                    "id": "ralan",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Pasien",
                },{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "fillAlphas" : 1,
                "fillColors" : "#00a65a",
                "lineColor" : "#00a65a",
                "lineThickness": 2,
                "type": "column",
                "title": "Jumlah Pasien",
                "columnWidth":0.5,
                "valueField": "ralan",
                "valueAxis": "ralan",
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "poli",
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

        var chart = AmCharts.makeChart("chartdiv_lab", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "position": "bottom",
                "useGraphSettings": true,
            },
            "startDuration": 0,
            "categoryAxis": {
              "gridPosition": "start",
              "position": "left"
            },
            "plotAreaFillAlphas": 0.1,
            "dataProvider": <?php echo $lab;?>,
            "graphs": [{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "type": "column",
                "fillAlphas": 0.8,
                "title": "Jumlah Pasien Ralan",
                "columnWidth":1,
                "valueField": "ralan",
                "valueAxis": "ralan",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "type": "column",
                "fillAlphas": 0.8,
                "title": "Jumlah Pasien Ranap",
                "columnWidth":1,
                "valueField": "inap",
                "valueAxis": "inap"
            }],
            "rotate": true,
            "categoryField": "tindakan",
            "export": {
                "enabled": true
             }
        });
    });
</script>