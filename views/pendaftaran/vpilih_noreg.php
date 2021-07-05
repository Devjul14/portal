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
        $("tr.noreg_sebelumnya").dblclick(function(){
            var no_reg = $(this).attr('no_reg');
            var tujuan_poli = $(this).attr('tujuan_poli');
            var nama_poli = $(this).attr('nama_poli');

            window.opener.$("input[name='no_reg_sebelumnya']").val(no_reg);
            window.opener.$("input[name='kode_poli']").val(tujuan_poli);
            window.opener.$("input[name='poli']").val(nama_poli);
            close();
            return false;
        });
    });
</script>
<body>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php echo form_open("pendaftaran/pilihnoreg/",array("id"=>"formsave","class"=>"form-horizontal")); ?>
                    <div class="form-group">
                        <label class="col-md-12">
                            No Reg
                        </label>
                        <div class="col-md-12">
                            <input type="text" name="no_reg" class="form-control" autocomplete="off" value="<?php echo $no_reg; ?>">
                        </div>
                    </div>
                    <button class="cari btn btn-primary" type="submit">Cari</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="box-body">
                <?php if ($no_reg==""): ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-navy">
                                <th width="50">No</th>
                                <th width="150" class="text-center">NO REG</th>
                                <th class="text-center">Nama</th>
                                <th width="150" class="text-center">Poli</th>
                            </tr>        
                        </thead>
                    </table>
                <?php else: ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-navy">
                                <th width="50">No</th>
                                <th width="150" class="text-center">NO REG</th>
                                <th class="text-center">Nama</th>
                                <th width="150" class="text-center">Poli</th>
                            </tr>        
                        </thead>
                        <tbody>
                            <?php 
                                $i=0;
                                foreach ($q->result() as $data) {
                                   $i++;
                                   echo "
                                        <tr id=data class='noreg_sebelumnya' no_reg='".$data->no_reg."' tujuan_poli='".$data->tujuan_poli."'  nama_poli='".$data->nama_poli."'>
                                            <td>".$i."</td>
                                            <td>".$data->no_reg."</td>
                                            <td>".$data->nama_pasien."</td>
                                            <td>".$data->nama_poli."</td>
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