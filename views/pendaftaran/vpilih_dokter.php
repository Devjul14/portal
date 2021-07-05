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
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $("tr.dokter").dblclick(function(){
            var kode = $(this).attr('id_dokter');
            var keterangan = $(this).attr('nama_dokter');
            window.opener.$("input[name='kode_dokter']").val(kode);
            window.opener.$("input[name='dokter']").val(keterangan);
            // var url = "<?php echo site_url('pendaftaran/viewrjalan');?>";
            // openCenteredWindow(url);
            close();
     
            return false;
        });
    });
</script>
<body>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="bg-navy">
                            <th width="50">No</th>
                            <th width="200" class="text-center">Dokter</th>
                            <!-- <th class="text-center">Kelompok Dokter</th>
                            <th class="text-center">No. Sip</th>
                            <th class="text-center">No. Str</th> -->
                        </tr>        
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach ($q->result() as $data) {
                               $i++;
                               echo "
                                    <tr id=data class='dokter' id_dokter='".$data->id_dokter."' nama_dokter='".$data->nama_dokter."' kelompok_dokter='".$data->nama_kelompok."' no_sip='".$data->no_sip."' no_str='".$data->no_str."'>
                                        <td>".$i."</td>
                                        <td>".$data->nama_dokter."</td>
                                    </tr>
                                ";
                            }
                            // <td>".$data->nama_kelompok."</td>
                            //             <td>".$data->no_sip."</td>
                            //             <td>".$data->no_str."</td>
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>