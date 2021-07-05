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
        $("tr.poliklinik").dblclick(function(){
            var kode = $(this).attr('kode');

            var keterangan = $(this).attr('keterangan');
            window.opener.$("input[name='kode_tujuan']").val(kode);
            window.opener.$("input[name='tujuan']").val(keterangan);

            window.opener.$("input[name='poli_kode']").val(kode);
            window.opener.$("input[name='poliklinik']").val(keterangan);
            $.ajax({
                url : "<?php echo base_url();?>pendaftaran/ambildatadokter",
                dataType: "text",
                method : "POST",
                data : {kode: kode},
                success: function(data){
                    window.opener.$("#select").empty();
                    // window.opener.$("#select").select2('val','');
                    data = "<option value=''>---Pilih Dokter---</option>"+data;
                    window.opener.$("#select").append(data);
                    console.log(data);
                    close();
                }
            });
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
                            <th  class="text-center">Poliklinik</th>
                            <th width="200" class="text-center">Briging</th>
                        </tr>        
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach ($q->result() as $data) {
                               $i++;
                               echo "
                                    <tr id=data class='poliklinik' kode='".$data->kode."' keterangan='".$data->keterangan."' briging='".$data->briging."' >
                                        <td>".$i."</td>
                                        <td>".$data->keterangan."</td>
                                        <td>".$data->briging."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>