
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>plugins/select2/select2.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
</head>
<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 800;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
        $(":input.autonoreg").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = <?php echo json_encode($q1); ?>// Or get your JSON dynamically and load it into this variable
                $.each(data, function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label +" | "+object.nama_pasien);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                item = n[0];
                var nilai = map[item].label;
                $("input[name='no_pasien_baru']").val(map[item].id);
                return nilai;
            }
        });
    });
</script>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
        	<div class="form-horizontal">
                <?php
                    echo form_open("pendaftaran/simpanmigrasi/",array("id"=>"formsave","class"=>"form-horizontal"));
                ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">No RM Lama</label>
                    <div class="col-md-10">
                        <input type="text" readonly class="form-control" name='no_pasien_lama' readonly value="<?php echo $no_pasien_lama;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">No RM Baru</label>
                    <div class="col-md-4">
                        <input type="text" readonly class="form-control" name='no_pasien_baru'/>
                    </div>
                    <label class="col-md-2 control-label">No Reg Baru</label>
                    <div class="col-md-4">
                        <input type="text" class="autonoreg form-control" id='autonoreg' autocomplete="off" name='no_reg'/>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <button class="migrasi btn btn-primary">Migrasi</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>