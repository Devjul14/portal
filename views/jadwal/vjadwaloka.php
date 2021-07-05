<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Jadwal Operasi || SIMRS</title>
	    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
	    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	    <script src="<?php echo base_url();?>js/jquery.js"></script>
	    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
	    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
	    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
	    <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
	    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
	    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
	    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
	    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
	    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    	<link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
  	</head>
	<body class="hold-transition sidebar-mini skin-blue sidebar-fixed sidebar-collapse">
		<script>
			setTimeout('location.href=\"jadwaloka"' ,60000);
		</script>
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 align="center">JADWAL OPERASI</h3>
                    <h5 align="right">
                        <?php
                            $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                            echo $hari[date("w")].", ".date("d-m-Y");
                        ?>
                    </h5>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr class="bg-green">
                                <th class='text-center'>No</th>
                                <th class='text-center'>No. Reg</th>
                                <th class='text-center'>Ruangan</th>
                                <th class='text-center'>Kamar</th>
                                <th class='text-center'>Dokter</th>
                                <th class='text-center'>Jam Masuk</th>
                                <th class='text-center'>Kamar Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i =0;
                                foreach ($q->result() as $value) {
                                    $i++;
                                    $tgl=substr($value->tanggal,8,2);
                                    $bln=substr($value->tanggal,5,2);
                                    $thn=substr($value->tanggal,0,4);
                                    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
                                    switch($info){
                                        case '0': $hari = "Minggu"; break;
                                        case '1': $hari = "Senin"; break;
                                        case '2': $hari = "Selasa"; break;
                                        case '3': $hari = "Rabu"; break;
                                        case '4': $hari = "Kamis"; break;
                                        case '5': $hari = "Jumat"; break;
                                        case '6': $hari = "Sabtu"; break;
                                    };
                                    $t1 = new DateTime('today');
                                    $t2 = new DateTime($value->tgl_lahir);
                                    $y  = $t1->diff($t2)->y;
                                    $m  = $t1->diff($t2)->m;
                                    $d  = $t1->diff($t2)->d;
                                    $status = "";
                                    if ($value->laporan==""){
                                        if (date("H:i:s")>date("H:i:s",strtotime($value->jam_masuk))){
                                            $status = "<div class='label label-success'>Proses</div>";
                                        } else {
                                            $status = "<div class='label label-warning'>Menunggu</div>";
                                        }
                                    }
                                    echo "
                                        <tr id=data href='".$value->kode_oka."' nama ='".$value->nama."'>
                                            <td class='text-center'>".$i."</td>
                                            <td class='text-center'>".$value->no_reg."</td>
                                            <td>".(isset($ruang[$value->ruangan]) ? $ruang[$value->ruangan] : (isset($poli[$qk[$value->no_reg]]) ? $poli[$qk[$value->no_reg]] : ""))."</td>
                                            <td>".(isset($qk[$value->no_reg]) ? "-" : (isset($kamar[$value->kamar]) ? $kamar[$value->kamar] : "")."/".$value->no_bed)."</td>
                                            <td class='text-center'>".(isset($dokter[$value->dokter_operasi]) ? $dokter[$value->dokter_operasi] : "")."</td>
                                            <td class='text-center'>".$value->jam_masuk."</td>
                                            <td class='text-center'>".$value->kamar_operasi."</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url();?>plugins/fastclick/fastclick.min.js"></script>
		<script src="<?php echo base_url();?>js/app.min.js"></script>
		<script src="<?php echo base_url();?>js/demo.js"></script>
	</body>
</html>
