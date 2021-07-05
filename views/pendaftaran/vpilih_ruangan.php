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
        $("tr.kamar").dblclick(function(){
            var kruangan = $(this).attr('kruangan');
            var ruangan = $(this).attr('ruangan');
            var kkelas = $(this).attr('kkelas');
            var kelas = $(this).attr('kelas');
            var kkamar = $(this).attr('kkamar');
            var nama_kamar = $(this).attr('nama_kamar');
            var no_bed = $(this).attr('no_bed');
            // var jumlah = $(this).attr('jumlah');
            window.opener.$("input[name='kode_ruangan']").val(kruangan);
            window.opener.$("input[name='ruangan']").val(ruangan);
            window.opener.$("input[name='kode_kelas']").val(kkelas);
            window.opener.$("input[name='kelas']").val(kelas);
            window.opener.$("input[name='kode_kamar']").val(kkamar);
            window.opener.$("input[name='kamar']").val(nama_kamar);
            window.opener.$("input[name='no_bed']").val(no_bed);
            // window.opener.$("input[name='jumlah']").val(jumlah);
            // var url = "<?php echo site_url('pendaftaran/viewinap');?>";
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
                            <th width="200" class="text-center">Ruangan</th>
                            <th width="200" class="text-center">Kelas</th>
                            <th width="200" class="text-center">Kamar</th>
                            <th width="200" class="text-center">No Bed</th>
                            <!-- <th width="200" class="text-center">Jumlah</th> -->
                        </tr>        
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach ($q->result() as $data) {
                               $i++;
                               echo "
                                    <tr id=data class='kamar' kruangan='".$data->kruangan."' ruangan='".$data->ruangan."' kkelas='".$data->kkelas."' kelas='".$data->kelas."' kkamar='".$data->kode_kamar."' nama_kamar='".$data->nama_kamar."' no_bed='".$data->no_bed."' jumlah='".$data->tarif_kamar."'>
                                        <td>".$i."</td>
                                        <td>".$data->ruangan."</td>
                                        <td>".$data->kelas."</td>
                                        <td>".$data->nama_kamar."</td>
                                        <td>".$data->no_bed."</td>
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