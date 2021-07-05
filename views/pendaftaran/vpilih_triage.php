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
        $("tr.ambil").dblclick(function(){
            var kode = $(this).attr('kode');
            var nama = $(this).attr('nama');
            var survei_primer = $(this).attr('survei_primer');
            var pernafasan = $(this).attr('pernafasan');
            var sirkulasi = $(this).attr('sirkulasi');
            var waktu = $(this).attr('waktu');
            var jalan_nafas = $(this).attr('jalan_nafas');
            var gangguan = $(this).attr('gangguan');
            var kesadaran = $(this).attr('kesadaran');
            var nyeri = $(this).attr('nyeri');
            var doa = $(this).attr('doa');
            window.opener.$("input[name='kode_triage']").val(kode);
            window.opener.$("input[name='triage']").val(nama);
            window.opener.$("input[name='waktu']").val(waktu);
            window.opener.$("input[name='jalan_nafas']").val(jalan_nafas);
            window.opener.$("input[name='survei_primer']").val(survei_primer);
            window.opener.$("input[name='kesadaran']").val(kesadaran);
            window.opener.$("input[name='nyeri']").val(nyeri);
            window.opener.$("textarea[name='pernafasan']").val(pernafasan);
            window.opener.$("textarea[name='sirkulasi']").val(sirkulasi);
            window.opener.$("textarea[name='gangguan']").val(gangguan);
            window.opener.$("textarea[name='doa']").val(doa);
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
                            <th width="50">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Jalan Nafas</th>
                            <th>Survei Primer</th>
                            <th class="text-center">Pernafasan</th>
                            <th class="text-center">Sirkulasi</th>
                            <th class="text-center">Gangguan</th>
                            <th class="text-center">Kesadaran</th>
                            <th class="text-center">Nyeri</th>
                            <th class="text-center">D.O.A</th>

                        </tr>        
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach ($q->result() as $data) {
                               $i++;
                               echo "
                                    <tr id=data class='ambil' kode='".$data->kode."' nama='".$data->nama."' pernafasan='".$data->pernafasan."' survei_primer = '".$data->survei_primer."' sirkulasi = '".$data->sirkulasi."' waktu = '".$data->waktu."' jalan_nafas = '".$data->jalan_nafas."' gangguan = '".$data->gangguan."' kesadaran = '".$data->kesadaran."' nyeri = '".$data->nyeri."' doa = '".$data->doa."'>
                                        <td>".$data->kode."</td>
                                        <td>".$data->nama."</td>
                                        <td>".$data->waktu."</td>
                                        <td>".$data->jalan_nafas."</td>
                                        <td>".$data->survei_primer."</td>
                                        <td>".$data->pernafasan."</td>
                                        <td>".$data->sirkulasi."</td>
                                        <td>".$data->gangguan."</td>
                                        <td>".$data->kesadaran."</td>
                                        <td>".$data->nyeri."</td>
                                        <td>".$data->doa."</td>
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