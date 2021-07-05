<script src="<?php echo base_url();?>js/amcharts/amcharts.js"></script>
<script src="<?php echo base_url();?>js/amcharts/pie.js"></script>
<script src="<?php echo base_url();?>js/amcharts/serial.js"></script>
<link  type="text/css" href="<?php echo base_url();?>js/amcharts/plugins/export/export.css" rel="stylesheet">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK PROSEDUR MASUK HARIAN RAWAT INAP</h3></div>
            <div class="box-body">
              <div id="chartdiv" style="height : 400px"></div>
            </div>
            <div class="box-footer">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr class="bg-navy">
                    <th colspan="4" class="text-center">IGD</th>
                    <th colspan="4" class="text-center">Langsung</th>
                    <th colspan="4" class="text-center">Poliklinik</th>
                  </tr>
                  <tr class="bg-navy">
                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>

                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>

                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["UGD"]["DINAS"]) ? $q2["UGD"]["DINAS"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["UGD"]["UMUM"]) ? $q2["UGD"]["UMUM"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["UGD"]["BPJS"]) ? $q2["UGD"]["BPJS"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["UGD"]["PERUSAHAAN"]) ? $q2["UGD"]["PERUSAHAAN"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Langsung"]["DINAS"]) ? $q2["Langsung"]["DINAS"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Langsung"]["UMUM"]) ? $q2["Langsung"]["UMUM"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Langsung"]["BPJS"]) ? $q2["Langsung"]["BPJS"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Langsung"]["PERUSAHAAN"]) ? $q2["Langsung"]["PERUSAHAAN"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Poliklinik"]["DINAS"]) ? $q2["Poliklinik"]["DINAS"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Poliklinik"]["UMUM"]) ? $q2["Poliklinik"]["UMUM"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Poliklinik"]["BPJS"]) ? $q2["Poliklinik"]["BPJS"] : "-");
                      ?>
                    </td>
                    <td class='text-center'>
                      <?php
                        echo (isset($q2["Poliklinik"]["PERUSAHAAN"]) ? $q2["Poliklinik"]["PERUSAHAAN"] : "-");
                      ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK PROSEDUR MASUK BULANAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div id="chartdiv_bulan" style="height : 400px"></div>
            </div>
            <div class="box-footer">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-navy">
                    <th class="text-center" rowspan="2">Tanggal</th>
                    <th class="text-center" colspan="4">IGD</th>
                    <th class="text-center" colspan="4">Langsung</th>
                    <th class="text-center" colspan="4">Poliklinik</th>
                  </tr>
                  <tr class="bg-navy">
                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>

                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>

                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $hari = array("1","2","3","4","5","6","7","8","9","10",
                                    "11","12","13","14","15","16","17","18","19",
                                    "20","21","22","23","24","25","26","27","28","29","30");
                  ?>
                  <?php foreach ($hari as $key => $value): ?>
                    <tr>
                      <td class='text-center'>
                        <?php echo $value ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["UGD"]["DINAS"][$value]) ? $q["UGD"]["DINAS"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["UGD"]["UMUM"][$value]) ? $q["UGD"]["UMUM"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["UGD"]["BPJS"][$value]) ? $q["UGD"]["BPJS"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["UGD"]["PERUSAHAAN"][$value]) ? $q["UGD"]["PERUSAHAAN"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Langsung"]["DINAS"][$value]) ? $q["Langsung"]["DINAS"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Langsung"]["UMUM"][$value]) ? $q["Langsung"]["UMUM"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Langsung"]["BPJS"][$value]) ? $q["Langsung"]["BPJS"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Langsung"]["PERUSAHAAN"][$value]) ? $q["Langsung"]["PERUSAHAAN"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Poliklinik"]["DINAS"][$value]) ? $q["Poliklinik"]["DINAS"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Poliklinik"]["UMUM"][$value]) ? $q["Poliklinik"]["UMUM"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Poliklinik"]["BPJS"][$value]) ? $q["Poliklinik"]["BPJS"][$value] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q["Poliklinik"]["PERUSAHAAN"][$value]) ? $q["Poliklinik"]["PERUSAHAAN"][$value] : "-");
                        ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- <input type="" value="<?php echo $langsung->langsung; ?>" name=""> -->
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK PROSEDUR MASUK TAHUNAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div id="chartdiv_tahun" style="height : 400px"></div>
            </div>
            <div class="box-footer">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-navy">
                    <th class="text-center" rowspan="2">Bulan</th>
                    <th class="text-center" colspan="4">IGD</th>
                    <th class="text-center" colspan="4">Langsung</th>
                    <th class="text-center" colspan="4">Poliklinik</th>
                  </tr>
                  <tr class="bg-navy">
                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>

                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>

                    <th class="text-center">DINAS</th>
                    <th class="text-center">UMUM</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PERUSAHAAN</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $bln = array("1","2","3","4","5","6","7","8","9","10",
                                    "11","12");
                  ?>
                  <?php foreach ($bln as $key1 => $value1): ?>
                    <?php
                      $bulan = array(
                                      '1'   => "Januari", 
                                      '2'   => "Februari",
                                      '3'   => "Maret",
                                      '4'   => "April",
                                      '5'   => "Mei",
                                      '6'   => "Juni",
                                      '7'   => "Juli",
                                      '8'   => "Agustus",
                                      '9'   => "September",
                                      '10'  => "Oktober",
                                      '11'  => "November",
                                      '12'  => "Desember",
                                    );
                    ?>
                    <tr>
                      <td class='text-center'>
                        <?php echo ($bulan[$value1]) ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["UGD"]["DINAS"][$value1]) ? $q1["UGD"]["DINAS"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["UGD"]["UMUM"][$value1]) ? $q1["UGD"]["UMUM"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["UGD"]["BPJS"][$value1]) ? $q1["UGD"]["BPJS"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["UGD"]["PERUSAHAAN"][$value1]) ? $q1["UGD"]["PERUSAHAAN"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Langsung"]["DINAS"][$value1]) ? $q1["Langsung"]["DINAS"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Langsung"]["UMUM"][$value1]) ? $q1["Langsung"]["UMUM"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Langsung"]["BPJS"][$value1]) ? $q1["Langsung"]["BPJS"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Langsung"]["PERUSAHAAN"][$value1]) ? $q1["Langsung"]["PERUSAHAAN"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Poliklinik"]["DINAS"][$value1]) ? $q1["Poliklinik"]["DINAS"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Poliklinik"]["UMUM"][$value1]) ? $q1["Poliklinik"]["UMUM"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Poliklinik"]["BPJS"][$value1]) ? $q1["Poliklinik"]["BPJS"][$value1] : "-");
                        ?>
                      </td>
                      <td class='text-center'>
                        <?php
                          echo (isset($q1["Poliklinik"]["PERUSAHAAN"][$value1]) ? $q1["Poliklinik"]["PERUSAHAAN"][$value1] : "-");
                        ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
        </div>
     <!--    <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK KUNJUNGAN PASIEN DALAM TAHUN</h3></div>
            <div class="box-body">
                <div id="chartdiv" style="height: 350px;"></div>
            </div>
        </div> -->
        <!-- <div class="box box-primary">
            <div class="box-header"><h3>POLIKLINIK HARI INI</h3></div>
            <div class="box-body">
                <div id="chartdiv_poli" style="height: 550px;"></div>
            </div>
        </div> -->
    </div>
<style type="text/css">
    #chartdiv > div > div > a { display: none !important; }
    #chartdiv_bulan > div > div > a { display: none !important; }
    #chartdiv_tahun > div > div > a { display: none !important; }
    .ui-datepicker-month, .ui-datepicker-year{
        color: #1e1b1d;
    }
</style>
<!-- Styles -->
<style>
#chartdiv {
  /*position: absolute;*/
  height: 500px;
}
/*#chartwrapper {
  position: relative;
  width: 200px;
  height: 200px;
}*/
/*#chartdiv {
  top: -30px;
  left: -30px;
  width : 260px;
  height : 260px;
}*/
</style>

<!-- Resources -->
<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script> -->
<script src="https://www.amcharts.com/lib/3/plugins/animate/animate.min.js"></script>

<!-- Chart code -->
<script>
    $(document).ready(function() {
        console.log(<?php echo $graph;?>);
            var chartData = [
      [{
        "answer": "IGD",
        "value": <?php echo $ugd->ugd; ?>,
        "color": "#00bdae"
      }, {
        "answer": "Langsung",
        "value": <?php echo $langsung->langsung; ?>,
        "color": "#357cd2"
      }, {
        "answer": "Poliklinik",
        "value": <?php echo $poliklinik->poliklinik; ?>,
        "color": "#736dba"
      }]
    ];

    var chart = AmCharts.makeChart("chartdiv", {
      "type": "pie",
      "startDuration": 0,
      "theme": "none",
      "balloon":{
        "adjustBorderColor":false,
        "color":"#FFFFFF"
      },
      "addClassNames": true,
      "innerRadius": "30%",
      "pullOutRadius": 0,
      "autoMargins": false,
      "marginTop": 50,
      "marginBottom": 30,
      "marginLeft": 0,
      "marginRight": 0,
      "color": "#357cd2",
      "fontSize":16,
      "outlineThickness":2,
      "outlineAlpha":1,
      "dataProvider": chartData[0],
      "valueField": "value",
      "titleField": "answer",
      "colorField": "color",
        "listeners": [ {
        "event": "init",
        "method": function( e ) {
          var chart = e.chart, current = 0;
          
          function getCurrentData() {
            var data = chartData[current];
            current++;
            if (current > (chartData.length - 1) )
              current = 0;
            return data;
          }

          // function loop() {
          //   var data = getCurrentData();
          //   chart.animateData( data, {
          //     duration: 1000,
          //     complete: function() {
          //       setTimeout( loop, 2000 );
          //     }
          //   } );
          // }

          // loop();
        }
      } ]
    });
    console.log(<?php echo $graph;?>);
        var chart = AmCharts.makeChart("chartdiv_bulan", {
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
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Prosedur Masuk",
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
                "title": "Langsung",
                "columnWidth":0.5,
                "valueField": "lan",
                "valueAxis": "lan",
                "lineColor": "#3c8dbc",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Poliklinik",
                "columnWidth":0.5,
                "valueField": "pol",
                "valueAxis": "pol",
                "lineColor": "#32CD32",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "IGD",
                "columnWidth":0.5,
                "valueField": "inap",
                "lineColor": "#f56954",
                "valueAxis": "inap"
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "hari",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 360,
                "autoGridCount": true,
                "gridCount": 34
            },
            "export": {
                "enabled": true
             }
        });

    console.log(<?php echo $graph_tahun;?>);
        var chart = AmCharts.makeChart("chartdiv_tahun", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 3,
                "position": "bottom",
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": <?php echo $graph_tahun;?>,
            "valueAxes": [{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Prosedur Masuk",
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
                "title": "Langsung",
                "columnWidth":0.5,
                "valueField": "lan",
                "valueAxis": "lan",
                "lineColor": "#3c8dbc",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Poliklinik",
                "columnWidth":0.5,
                "valueField": "pol",
                "valueAxis": "pol",
                "lineColor": "#32CD32",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "IGD",
                "columnWidth":0.5,
                "valueField": "inap",
                "lineColor": "#f56954",
                "valueAxis": "inap"
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "hari",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 360,
                "autoGridCount": true,
                "gridCount": 34
            },
            "export": {
                "enabled": true
             }
        });

});
</script>