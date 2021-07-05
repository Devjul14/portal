<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Bed Mapping || SIMRS</title>
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
			setTimeout('location.href=\"bedmapping"' ,60000);
		</script>
		<div class="box box-primary">
	        <div class="box-header">
	        	<h3 align="center">KETERSEDIAAN TEMPAT TIDUR</h3>
	        </div>
	        <div class="box-body no-padding">
	            <div class="table-responsive">
	                <table class="warna table table-hover table-striped table-bordered">
	                    <thead>
	                        <tr>
	                            <th class="text-center bg-maroon" style="vertical-align: middle" rowspan="2">Ruangan</th>
	                            <?php 
	                                $i = 1;
	                                foreach ($kelas->result() as $key) {
	                                    echo "<th class='text-center bg-maroon' ".($i%2>0 ? "style='opacity:.75'" : "")." colspan='4'>".str_replace("_", " ", strtoupper($key->kode_kelas_dashboard))."</th>";
	                                    $i++;
	                                }
	                            ?>
	                            <th class="text-center bg-maroon" style="vertical-align: middle" rowspan="2">Jumlah</th>
	                        </tr>
	                        <tr>
	                            <?php
	                                $jumlah = $kelas->num_rows()-1;
	                                $string = array("","A","B","C","D");
	                                $bgcolor = array("","bg-blue","bg-green","bg-orange","bg-red");
	                                foreach ($kelas->result() as $key) {
	                                    for($i=1;$i<$jumlah;$i++){
	                                        echo "<th class='text-center ".$bgcolor[$i]."'>".$string[$i]."</th>";
	                                    }
	                                }
	                            ?>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                            foreach($r->result() as $data){
	                                echo "<tr>";
	                                echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
	                                $string = array("","A","B","C","D");
	                                $bgcolor = array("","#00acd6","#008d4c","#e08e0b","#d73925","#00acd6");
	                                foreach ($kelas->result() as $key) {
	                                    for($i=1;$i<$jumlah;$i++){
	                                        echo "<th class='text-center'>".(isset($bed[$data->kode_ruangan_a][$key->kode_kelas_dashboard][$string[$i]]) ? $bed[$data->kode_ruangan_a][$key->kode_kelas_dashboard][$string[$i]] : "-")."</th>";
	                                    }
	                                }
	                                echo "<th class='text-center'>".(isset($bed["ruang"][$data->kode_ruangan_a]) ? $bed["ruang"][$data->kode_ruangan_a] : "-")."</th>";
	                                echo "</tr>";
	                            }
	                            echo "<tr class='bg-maroon'>";
	                            echo "<th class='text-center'>JUMLAH</th>";
	                            $string = array("","A","B","C","D");
	                            $bgcolor = array("","#00acd6","#008d4c","#e08e0b","#d73925","#00acd6");
	                            $j = 0;
	                            foreach ($kelas->result() as $key) {
	                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['A']) ? $bed["kelas"][$key->kode_kelas_dashboard]['A'] : "-")."</th>";
	                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['B']) ? $bed["kelas"][$key->kode_kelas_dashboard]['B'] : "-")."</th>";
	                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['C']) ? $bed["kelas"][$key->kode_kelas_dashboard]['C'] : "-")."</th>";
	                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['D']) ? $bed["kelas"][$key->kode_kelas_dashboard]['D'] : "-")."</th>";
	                                $j+= (isset($bed["kelas"][$key->kode_kelas_dashboard]['A']) ? $bed["kelas"][$key->kode_kelas_dashboard]['A'] : 0);

	                            }
	                            echo "<th class='text-center'>".$j."</th>";
	                            echo "</tr>";
	                        ?>
	                    </tbody>
	                </table>
	            </div>
	        </div>
	        <div class="box-footer"> 
	        	<div class="form-group col-md-6 text-center">
	        		<div class="col-md-6">
	        			<button class="btn bg-blue">A</button>
	        				<b>TOTAL TEMPAT TIDUR	</b>
	        		</div>
	        		<div class="col-md-6">
	        			<button class="btn bg-green">B</button>
	        				<b>ISI	</b>
	        		</div>
	        	</div>	
	        	<div class="form-group col-md-6 text-center	">
	        		<div class="col-md-6">
	        			<button class="btn bg-orange">C</button>
	        				<b>KOSONG	</b>
	        		</div>
	        		<div class="col-md-6">
	        			<button class="btn bg-red">D</button>
	        				<b>BOOKING	</b>
	        		</div>
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
