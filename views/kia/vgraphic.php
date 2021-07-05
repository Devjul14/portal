<script type="text/javascript" src="<?php echo base_url('js/jquery-1.7.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/highstock.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/modules/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/themes/grid.js'); ?>"></script>
<script>
var jml_series = "<?php echo $jml_series;?>";
switch(jml_series){
case '1' :
    new Highcharts.Chart({
            chart: {
                renderTo: 'chart',
                type: '<?php echo $tipe;?>'
            },
            title: {
                text: 'Partograf',
                x: -20
            },
            subtitle: {
                text: '<?php echo $subtitle;?>',
                x: -20
            },
            xAxis: {
                categories: <?php echo json_encode($ctg); ?>
            },
            yAxis: {
                title: {
                    text: '<?php echo $subtitle;?>'
                }
            },
            series: [{
                name: '<?php echo $series_title1;?>',
                data: <?php echo json_encode($data); ?>
            }]
        });
    break;
case '3' :
    new Highcharts.Chart({
            chart: {
                renderTo: 'chart',
                type: '<?php echo $tipe;?>'
            },
            title: {
                text: 'Partograf',
                x: -20
            },
            subtitle: {
                text: '<?php echo $subtitle;?>',
                x: -20
            },
            xAxis: {
                categories: <?php echo json_encode($ctg); ?>
            },
            yAxis: {
                title: {
                    text: '<?php echo $subtitle;?>'
                }
            },
            series: [{
                name: '<?php echo $series_title1;?>',
                data: <?php echo json_encode($data); ?>
            },{
                name: '<?php echo $series_title2;?>',
                data: <?php echo json_encode($data2); ?>
            },{
                name: '<?php echo $series_title3;?>',
                data: <?php echo json_encode($data3); ?>
            }
            ]
        });
    break;
}
 </script>
 <body>
 	<div id="body">
        <div id="chart"></div>
    </div>
 </body>