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
        $("tr.wilayah").dblclick(function(){
            var kelurahan = $(this).attr('kelurahan');
            var kecamatan = $(this).attr('kecamatan');
            var kota = $(this).attr('kota');
            var provinsi = $(this).attr('provinsi');

            var id_kelurahan = $(this).attr('id_kelurahan');
            var id_kecamatan = $(this).attr('id_kecamatan');
            var id_kota = $(this).attr('id_kota');
            var id_provinsi = $(this).attr('id_provinsi');

            window.opener.$("input[name='kelurahan']").val(kelurahan);
            window.opener.$("input[name='kecamatan']").val(kecamatan);
            window.opener.$("input[name='kota']").val(kota);
            window.opener.$("input[name='provinsi']").val(provinsi);

            window.opener.$("input[name='id_kelurahan']").val(id_kelurahan);
            window.opener.$("input[name='id_kecamatan']").val(id_kecamatan);
            window.opener.$("input[name='id_kota']").val(id_kota);
            window.opener.$("input[name='id_provinsi']").val(id_provinsi);
            close();
            return false;
        });
    });
</script>
<body>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php echo form_open("pendaftaran/pilihwilayah/".$jenis,array("id"=>"formsave","class"=>"form-horizontal")); ?>
                    <div class="form-group">
                        <label class="col-md-12">
                            Nama <?php echo $jenis ?>
                        </label>
                        <div class="col-md-12">
                            <input type="text" name="nama" class="form-control" autocomplete="off" value="<?php echo $nama; ?>">
                        </div>
                    </div>
                    <button class="cari btn btn-primary" type="submit">Cari</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="box-body">
                <?php if ($nama==""): ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-navy">
                                <th width="50">No</th>
                                <th width="150" class="text-center">Provinsi</th>
                                <th class="text-center">Kota/Kabupaten</th>
                                <th width="150" class="text-center">Kecamatan</th>
                                <th width="200" class="text-center">Desa/Kelurahan</th>
                            </tr>        
                        </thead>
                    </table>
                <?php else: ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-navy">
                                <th width="50">No</th>
                                <th width="150" class="text-center">Provinsi</th>
                                <th class="text-center">Kota/Kabupaten</th>
                                <th width="150" class="text-center">Kecamatan</th>
                                <th width="200" class="text-center">Desa/Kelurahan</th>
                            </tr>        
                        </thead>
                        <tbody>
                            <?php 
                                $i=0;
                                foreach ($q->result() as $data) {
                                   $i++;
                                   echo "
                                        <tr id=data class='wilayah' kelurahan='".$data->kelurahan."' kota='".$data->kota."'  kecamatan='".$data->kecamatan."' provinsi='".$data->provinsi."' id_kelurahan='".$data->id_kelurahan."' id_kota='".$data->id_kota."' id_kecamatan='".$data->id_kecamatan."' id_provinsi='".$data->id_provinsi."'>
                                            <td>".$i."</td>
                                            <td>".$data->provinsi."</td>
                                            <td>".$data->kota."</td>
                                            <td>".$data->kecamatan."</td>
                                            <td>".$data->kelurahan."</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>