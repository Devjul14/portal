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
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $("tr.pangkat").dblclick(function(){
            var id_pangkat = $(this).attr('id_pangkat');
            var nama_pangkat = $(this).attr('nama_pangkat');

            window.opener.$("input[name='pangkat']").val(id_pangkat);
            window.opener.$("input[name='nama_pangkat']").val(nama_pangkat);

            var id_kesatuan = $(this).attr('id_kesatuan');
            var nama_kesatuan = $(this).attr('nama_kesatuan');


            window.opener.$("input[name='kesatuan']").val(id_kesatuan);
            window.opener.$("input[name='nama_kesatuan']").val(nama_kesatuan);

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
                            <th width="100" class="text-center">Id Pangkat</th>
                            <th class="text-center">Nama Pangkat</th>
                            <th width="100" class="text-center">Id Kesatuan</th>
                            <th width="250" class="text-center">Nama Kesatuan</th>
                        </tr>        
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach ($q->result() as $data) {
                               $i++;
                               echo "
                                    <tr id=data class='pangkat' id_pangkat='".$data->id_pangkat."' nama_pangkat='".$data->keterangan."' id_kesatuan='".$data->id_kesatuan."' nama_kesatuan='".$data->nama_kesatuan."'>
                                        <td>".$i."</td>
                                        <td>".$data->id_pangkat."</td>
                                        <td>".$data->keterangan."</td>
                                        <td>".$data->id_kesatuan."</td>
                                        <td>".$data->nama_kesatuan."</td>
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