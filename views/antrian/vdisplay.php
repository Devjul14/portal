<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>DISPLAY ANTRIAN POLIKLINIK | SIMRS</title>
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
  	<script type="text/javascript">
	    $(document).ready(function(){
	        $(".menuawal").addClass("hide");
	        $('html, body').animate({
	            scrollTop: $(".bawah_ralan").offset().top-500
	        }, 500);
	        jenis = "ralan";
	        getpoli_ralan(jenis);
	        $(".list_poli_ralan").on("click",".pilihpoli",function(){
	            // $(".poli_ralan").addClass("hide");
	            // $(".dokter_ralan").removeClass("hide");
	            var kode = $(this).attr("kode");
	            var jenis = $(this).attr("jenis");
	            localStorage.setItem('kode',kode);
	            // getdokter_ralan(jenis,kode);
	            var url = "<?php echo site_url('displayantrian/antrian');?>/"+kode;
	            window.location = url;
	        });
	        $(".list_poli_ralan").on("click",".index_poli",function(){
	            $(".poli_ralan").addClass("hide");
	            $(".index_poli_ralan").removeClass("hide");
	            var kode = $(this).attr("kode");
	            var jenis = $(this).attr("jenis");
	            var nama_poli = $(this).attr("nama_poli");
	            localStorage.setItem('kode',kode);
	            $(".nama_poli").html(nama_poli);
	            gettarif_ralan(kode);
	        });
	        $('.listdokter_ralan').on('click',".lanjut",function(){
	            var kode_poli = $(this).attr("kode_poli");
	            var kode = $(this).attr("kode");
	            var url = "<?php echo site_url('displayantrian/antrian');?>/"+kode_poli+"/"+kode;
	            window.location = url;
	        });
	        $('.listdokter_ralan').on('click',".dokterdetail",function(){
	            $(".dokter_ralan").addClass("hide");
	            $(".jadwaldokter").removeClass("hide");
	            var id_dokter = $(this).attr("kode");
	            getdokterdetail(id_dokter);
	        });
	        $('.back_poli_ralan').click(function(){
	            $(".poli_ralan").removeClass("hide");
	            $(".dokter_ralan").addClass("hide");
	            localStorage.removeItem('dokter');
	        });
	        $('.back_home').click(function(){
	            window.history.back();
	        });
	    });
	    function getpoli_ralan(jenis){
		    var html = "";
		    $.ajax({
		        async : false,
		        url   : "<?php echo site_url('displayantrian/getpoli');?>",
		        type : "POST",
		        success: function(result){
		        	var data = JSON.parse(result);
		        	console.log(result);
		            $.each(data, function(key, value){
		                html += "<tr class='pol'>";
		                html += "<td>&nbsp;</td>";
		                html += "<td style='vertical-align:middle' class='text-bold'>"+value.keterangan+"</td>";
		                html += "<td class='text-right'><button kode='"+value.kode+"' jenis='"+jenis+"' class='pilihpoli btn btn-lg btn-success'><i class='fa fa-angle-double-right'></i></button></td>";
		                html += "</tr>";
		            });
		            $(".list_poli_ralan").html(html);
		        }
		    });
		}
		function getdokter_ralan(jenis,kode){
		    $.ajax({
		        url   : "<?php echo site_url('displayantrian/getdokterpoli');?>",
		        type : "POST",
		        data : {poli: kode},
		        success: function(result){
		            var content = "";
		            var ada = 0;
		            var data = JSON.parse(result);
		            $.each(data, function(key, value){
		                ada = 1;
		                content += "<input type='hidden' name='hari_"+value["id_dokter"]+"' value='"+value["hari"]+"'>";
		                content += "<input type='hidden' name='jam_"+value["id_dokter"]+"' value='"+value["jam"]+"'>";
		                content += "<tr class='pol'>";
		                content += "<td>&nbsp;</td>";
		                content += "<td style='vertical-align:middle' class='text-bold'>"+value["nama_dokter"]+"</td>";
		                content += "<td class='text-right'><button class='lanjut btn btn-lg btn-success' kode_poli='"+kode+"' kode='"+value["id_dokter"]+"'><i class='fa fa-angle-double-right'></i></button></td>";
		                content += "</tr>";
		            });
		            if (!ada){
		                content += "<tr class='pol'>";
		                content += "<td>&nbsp;</td>";
		                content += "<td style='vertical-align:middle'>&nbsp;</td>";
		                content += "<td class='text-right'>&nbsp;</td>";
		                content += "</tr>";
		            }
		            $(".listdokter_ralan").html(content);
		        },
		        error: function(result){
		            console.log(result);
		        }
		    });
		}
	</script>
	<body class="hold-transition lockscreen">
		<div class="bawah_ralan">
		    <div class="poli_ralan">
		        <div class="login-box">
		            <div class="box box-solid">
		                <div class="box-header text-center bg-navy">
		                    <h3 class="box-title">POLIKLINIK</h3>
		                </div>
		                <div class="box-body">
		                    <table class="table table-hover table-striped">
		                        <tbody class="list_poli_ralan"></tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="dokter_ralan hide">
		        <div class="login-box">
		            <div class="box box-solid">
		                <div class="box-header text-center bg-navy">
		                    <button class='back_poli_ralan btn btn-xs pull-left btn-warning'><i class='fa fa-angle-double-left'></i></button>
		                    <h3 class="box-title">NAMA DOKTER</h3>
		                </div>
		                <div class="box-body">
		                    <table class="table table-striped table-hover">
		                        <tbody class="listdokter_ralan"></tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</body>
</html>