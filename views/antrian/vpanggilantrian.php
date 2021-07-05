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
	<body class="hold-transition lockscreen">
		<?php if ($dp->num_rows()==1) : ?>
		<div class="satudokter">
			<div class="box box-solid">
		        <div class="box-header bg-gray">
		        	<div class="col-lg-3 col-xs-2 col-sm-2">
	                    <div class="logo_atas"><img src="<?php echo base_url();?>img/siliwangi.png" width="200px"></div>
	                </div>
	                <div class="col-lg-6 col-xs-8 col-sm-8">
			        	<h1 align="center" style="font-size: 60px"><b>ANTRIAN</b></h1>
			        	<h2 align="center"><b><?php echo $p->keterangan;?></b></h2>
			        	<h2 align="center"><b class="nama_dokter"><?php echo $d->nama_dokter;?></b></h2>
			        	<h2 align="center"><span class="tanggal text-green"></span><span class="clock text-green"></span></h2>
			        </div>
		        	<div class="col-lg-3 col-xs-2 col-sm-2">
	                    <div class="logo_atas text-right"><img src="<?php echo base_url();?>img/hesti.png" width="200px"></div>
	                </div>
		        </div>
		        <div class="box-body bg-gray">
		            <div class="row">
		            	<?php $i = 1;?>
		            	<?php foreach ($dp->result() as $row) : ?>
		            	<div class="col-md-4">
		            		<div class="box box-solid">
		            			<div class="box-header bg-navy"><h3 class="box-title"><?php echo $row->nama_dokter;?></h3></div>
		            			<div class="box-body no-padding">
				            		<div class="table-responsive">
					            		<table class="table table-bordered table-hover table-striped myTable_<?php echo $row->id_dokter;?>" id="myTable<?php echo $i;?>" >
							                <thead>
							                    <tr class="bg-blue">
							                        <th class='text-center' width="130px" style="font-size: 18px">No. Antrian</th>
							                        <th class='text-center' style="font-size: 18px">Nama</th>
							                    </tr>
							                </thead>
							                <tbody>
								                <?php
								                    $no_kk = '';
								                    foreach ($q[$row->id_dokter] as $key => $qrow){
								                        echo "<tr id=data class='no_".$qrow->no_reg."' no_rm='".$qrow->no_pasien."' no_reg='".$qrow->no_reg."' no_antrian='".$qrow->no_antrian."' nama_pasien='".strtoupper(substr($qrow->nama_pasien,0,15))."'>";
								                        echo "<td class='text-center'>".$qrow->no_antrian."</td>";
								                        echo "<td>".strtoupper($qrow->nama_pasien)."</td>";
								                        echo "</tr>";
								                    }
								                ?>
								            </tbody>
							            </table>
							        </div>
							    </div>
							</div>
		            	</div>
		            	<?php $i++; endforeach ?>
		            	<div class="col-md-8">
		            		<div class="box box-solid">
		            			<div class="box-header bg-purple">
			            			<div class="text-center">
			            				<span style="font-size:50px" class="box-title text-bold text-center">NO ANTRIAN</span>
			            			</div>
			            		</div>
			            		<div class="box-body">
			            			<div class="text-center margin">
			            				<p style="font-size:30px" class="box-title text-bold"><span class="text_no_antrian" style="font-size:180px"></span></p>
			            			</div>
		            			</div>
		            		</div>
		            		<div class="box box-solid bg-blue">
		            			<div class="box-header">
			            			<div class="pull-left margin">
			            				<p style="font-size:30px" class="box-title text-bold"><span class="no_rm" style="font-size:60px"></span></p>
			            			</div>
			            			<div class="pull-right margin">
			            				<p style="font-size:30px" class="box-title text-bold pull-right"><span class="nama_pasien" style="font-size:60px"></span></p>
			            			</div>
		            			</div>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</div>
		<?php elseif ($dp->num_rows()==2) :?>
		<div class="duadokter">
			<div class="box box-solid">
		        <div class="box-header bg-gray">
		        	<div class="col-lg-3 col-xs-2 col-sm-2">
	                    <div class="logo_atas"><img src="<?php echo base_url();?>img/siliwangi.png" width="200px"></div>
	                </div>
	                <div class="col-lg-6 col-xs-8 col-sm-8">
			        	<h1 align="center" style="font-size: 60px"><b>ANTRIAN</b></h1>
			        	<h2 align="center"><b><?php echo $p->keterangan;?></b></h2>
			        	<h2 align="center"><b class="nama_dokter"><?php echo $d->nama_dokter;?></b></h2>
			        	<h2 align="center"><span class="tanggal text-green"></span><span class="clock text-green"></span></h2>
			        </div>
		        	<div class="col-lg-3 col-xs-2 col-sm-2">
	                    <div class="logo_atas text-right"><img src="<?php echo base_url();?>img/hesti.png" width="200px"></div>
	                </div>
		        </div>
		        <div class="box-body bg-gray">
		            <div class="row">
		            	<?php $i = 1;?>
		            	<?php foreach ($dp->result() as $row) : ?>
		            	<div class="col-md-6 tabelantrian">
		            		<div class="box box-solid">
		            			<div class="box-header bg-navy"><h3 class="box-title"><?php echo $row->nama_dokter;?></h3></div>
		            			<div class="box-body no-padding">
				            		<div class="table-responsive">
					            		<table class="table table-bordered table-hover table-striped myTable_<?php echo $row->id_dokter;?>" id="myTable<?php echo $i;?>" >
							                <thead>
							                    <tr class="bg-blue">
							                        <th class='text-center' width="130px" style="font-size: 18px">No. Antrian</th>
							                        <th class='text-center' style="font-size: 18px">Nama</th>
							                    </tr>
							                </thead>
							                <tbody>
								                <?php
								                    $no_kk = '';
								                    foreach ($q[$row->id_dokter] as $key => $qrow){
								                        echo "<tr id=data class='no_".$qrow->no_reg."' no_rm='".$qrow->no_pasien."' no_reg='".$qrow->no_reg."' no_antrian='".$qrow->no_antrian."' nama_pasien='".strtoupper(substr($qrow->nama_pasien,0,15))."'>";
								                        echo "<td class='text-center'>".$qrow->no_antrian."</td>";
								                        echo "<td>".strtoupper($qrow->nama_pasien)."</td>";
								                        echo "</tr>";
								                    }
								                ?>
								            </tbody>
							            </table>
							        </div>
							    </div>
							</div>
		            	</div>
		            	<?php $i++; endforeach ?>
		            	<div class="col-md-12 displayantrian hide">
		            		<div class="box box-solid">
		            			<div class="box-header bg-purple">
			            			<div class="text-center">
			            				<span style="font-size:50px" class="box-title text-bold text-center">NO ANTRIAN</span>
			            			</div>
			            		</div>
			            		<div class="box-body">
			            			<div class="text-center margin">
			            				<p style="font-size:30px" class="box-title text-bold"><span class="text_no_antrian" style="font-size:180px"></span></p>
			            			</div>
		            			</div>
		            		</div>
		            		<div class="box box-solid bg-blue">
		            			<div class="box-header">
			            			<div class="pull-left margin">
			            				<p style="font-size:30px" class="box-title text-bold"><span class="no_rm" style="font-size:60px"></span></p>
			            			</div>
			            			<div class="pull-right margin">
			            				<p style="font-size:30px" class="box-title text-bold pull-right"><span class="nama_pasien" style="font-size:60px"></span></p>
			            			</div>
		            			</div>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</div>
		<?php elseif ($dp->num_rows()>2) :?>
		<div class="tigadokter">
			<div class="box box-solid">
		        <div class="box-header bg-gray">
		        	<div class="col-lg-3 col-xs-2 col-sm-2">
	                    <div class="logo_atas"><img src="<?php echo base_url();?>img/siliwangi.png" width="200px"></div>
	                </div>
	                <div class="col-lg-6 col-xs-8 col-sm-8">
			        	<h1 align="center" style="font-size: 60px"><b>ANTRIAN</b></h1>
			        	<h2 align="center"><b><?php echo $p->keterangan;?></b></h2>
			        	<h2 align="center"><b class="nama_dokter"><?php echo $d->nama_dokter;?></b></h2>
			        	<h2 align="center"><span class="tanggal text-green"></span><span class="clock text-green"></span></h2>
			        </div>
		        	<div class="col-lg-3 col-xs-2 col-sm-2">
	                    <div class="logo_atas text-right"><img src="<?php echo base_url();?>img/hesti.png" width="200px"></div>
	                </div>
		        </div>
		        <div class="box-body bg-gray">
		            <div class="row">
		            	<?php $i = 1;?>
		            	<?php foreach ($dp->result() as $row) : ?>
		            	<div class="col-md-4 tabelantrian">
		            		<div class="box box-solid">
		            			<div class="box-header bg-navy"><h3 class="box-title"><?php echo $row->nama_dokter;?></h3></div>
		            			<div class="box-body no-padding">
				            		<div class="table-responsive">
					            		<table class="table table-bordered table-hover table-striped myTable_<?php echo $row->id_dokter;?>" id="myTable<?php echo $i;?>" >
							                <thead>
							                    <tr class="bg-blue">
							                        <th class='text-center' width="130px" style="font-size: 18px">No. Antrian</th>
							                        <th class='text-center' style="font-size: 18px">Nama</th>
							                    </tr>
							                </thead>
							                <tbody>
								                <?php
								                    $no_kk = '';
								                    foreach ($q[$row->id_dokter] as $key => $qrow){
								                        echo "<tr id=data class='no_".$qrow->no_reg."' no_rm='".$qrow->no_pasien."' no_reg='".$qrow->no_reg."' no_antrian='".$qrow->no_antrian."' nama_pasien='".strtoupper(substr($qrow->nama_pasien,0,15))."'>";
								                        echo "<td class='text-center'>".$qrow->no_antrian."</td>";
								                        echo "<td>".strtoupper($qrow->nama_pasien)."</td>";
								                        echo "</tr>";
								                    }
								                ?>
								            </tbody>
							            </table>
							        </div>
							    </div>
							</div>
		            	</div>
		            	<?php $i++; endforeach ?>
		            	<div class="col-md-12 displayantrian hide">
		            		<div class="box box-solid">
		            			<div class="box-header bg-purple">
			            			<div class="text-center">
			            				<span style="font-size:50px" class="box-title text-bold text-center">NO ANTRIAN</span>
			            			</div>
			            		</div>
			            		<div class="box-body">
			            			<div class="text-center margin">
			            				<p style="font-size:30px" class="box-title text-bold"><span class="text_no_antrian" style="font-size:180px"></span></p>
			            			</div>
		            			</div>
		            		</div>
		            		<div class="box box-solid bg-blue">
		            			<div class="box-header">
			            			<div class="pull-left margin">
			            				<p style="font-size:30px" class="box-title text-bold"><span class="no_rm" style="font-size:60px"></span></p>
			            			</div>
			            			<div class="pull-right margin">
			            				<p style="font-size:30px" class="box-title text-bold pull-right"><span class="nama_pasien" style="font-size:60px"></span></p>
			            			</div>
		            			</div>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</div>
		<?php endif ?>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url();?>plugins/fastclick/fastclick.min.js"></script>
		<script src="<?php echo base_url();?>js/app.min.js"></script>
		<script src="<?php echo base_url();?>js/demo.js"></script>
		<script>	
			$(document).ready(function(){
				$('#myTable').fixedHeaderTable({ height: '490', altClass: 'odd', footer: true});
				$('#myTable1').fixedHeaderTable({ height: '490', altClass: 'odd', footer: true});
				$('#myTable2').fixedHeaderTable({ height: '490', altClass: 'odd', footer: true});
				$('#myTable3').fixedHeaderTable({ height: '490', altClass: 'odd', footer: true});
				startTime();
				gettanggal();
				setInterval(getantrian2,1000);
				var no_rm = $(".bg-maroon").attr("no_rm");
				$(".no_rm").html(no_rm);
				var no_antrian = $(".bg-maroon").attr("no_antrian");
				$(".text_no_antrian").html(no_antrian);
				var nama_pasien = $(".bg-maroon").attr("nama_pasien");
				$(".nama_pasien").html(nama_pasien);
			});
			function getantrian(){
				var poli = "<?php echo $poli;?>";
				var dokter = "<?php echo $dokter;?>";
				$("tr#data").removeClass("bg-maroon");
				$.ajax({
		            type  : "POST",
		            data  : {poli:poli,dokter: dokter},
		            url   : "<?php echo site_url('displayantrian/getpanggil');?>",
		            success : function(result){
		            	var data = JSON.parse(result);
		            	console.log(data["no_antrian"]);
		            	$(".no_"+data["no_antrian"]).addClass("bg-maroon");
		            	var no_rm = $(".bg-maroon").attr("no_rm");
						$(".no_rm").html(no_rm);
						var no_antrian = $(".bg-maroon").attr("no_antrian");
						$(".text_no_antrian").html(no_antrian);
						var nama_pasien = $(".bg-maroon").attr("nama_pasien");
						$(".nama_pasien").html(nama_pasien);
		            },
		            error: function(result){
		                console.log(result);
		            }
		        });
			}
			function getantrian2(){
				var poli = "<?php echo $poli;?>";
				$.ajax({
			        url   : "<?php echo site_url('displayantrian/getdokterpoli');?>",
			        type : "POST",
			        data : {poli: poli},
			        success: function(result){
			            var content = "";
			            var ada = 0;
			            var data = JSON.parse(result);
			            $.each(data, function(key, value){
			            	var n = key+1;
			            	antrian(n,poli,value["id_dokter"]);
						});
					}
				});
			}
			function antrian(n,poli,dokter){
				$("#myTable"+n+" tr#data").removeClass("bg-maroon");
				$.ajax({
		            type  : "POST",
		            data  : {poli:poli,dokter: dokter},
		            url   : "<?php echo site_url('displayantrian/getpanggil');?>",
		            success : function(result){
		            	var data = JSON.parse(result);
		            	if (data!=null){
		            		$(".myTable_"+dokter+" .no_"+data["no_reg"]).addClass("bg-maroon");
		            		$.each($(".myTable_"+dokter+" tr"),function(key,value){
		            			var no = parseInt($(this).attr("no_antrian"));
		            			console.log(no+" | "+data["no_antrian"]);
		            			if (no<parseInt(data["no_antrian"])){
		            				$(this).addClass("hide");
		            			} else {
		            				$(this).removeClass("hide");
		            			}
		            		});
		            		sedangpanggil(poli,n);
		            	}
		            },
		            error: function(result){
		                console.log(result);
		            }
		        });
			}
			function startTime() {
		        var today = new Date();
		        var h = today.getHours();
		        var m = today.getMinutes();
		        var s = today.getSeconds();
		        m = checkTime(m);
		        s = checkTime(s);
		        $(".clock").html(h + ":" + m + ":" + s);
		        var t = setTimeout(startTime, 500);
		    }
		    function checkTime(i) {
		        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		        return i;
		    }
			function sedangpanggil(poli,n){
				$.ajax({
		            type  : "POST",
		            data  : {poli:poli},
		            url   : "<?php echo site_url('displayantrian/sedangpanggil');?>",
		            success : function(result){
		            	var data = JSON.parse(result);
		            	var dokter_panggil = localStorage.getItem('dokter');
		            	var no_panggil = localStorage.getItem('no_panggil');
		            	var no_reg = localStorage.getItem('no_reg');
		            	if (dokter_panggil!=data["dokter"] || no_panggil!=data["no_antrian"] || no_reg!=data["no_reg"]){
		            		localStorage.setItem("dokter",data["dokter"]);
		            		localStorage.setItem("no_panggil",data["no_antrian"]);
		            		localStorage.setItem("no_reg",data["no_reg"]);
		            		$(".tabelantrian").addClass("hide");
		            		$(".displayantrian").removeClass("hide");
		            		var no_rm = $(".myTable_"+data["dokter"]+" .no_"+data["no_reg"]).attr("no_rm");
							$(".no_rm").html(no_rm);
							var no_antrian = $(".myTable_"+data["dokter"]+" .no_"+data["no_reg"]).attr("no_antrian");
							$(".text_no_antrian").html(no_antrian);
							var nama_pasien = $(".myTable_"+data["dokter"]+" .no_"+data["no_reg"]).attr("nama_pasien");
							$(".nama_pasien").html(nama_pasien);
							$(".nama_dokter").html(data["nama_dokter"]);
							setTimeout(function() {
								$(".tabelantrian").removeClass("hide");
				                $(".displayantrian").addClass("hide");
				                $(".nama_dokter").html("");
				            }, 25000);
		            	}
		            },
		            error: function(result){
		                console.log(result);
		            }
		        });
			}
			function gettanggal(){
		        var d = new Date();
		        var weekday = new Array(7);
		        weekday[0] = "Minggu";
		        weekday[1] = "Senin";
		        weekday[2] = "Selasa";
		        weekday[3] = "Rabu";
		        weekday[4] = "Kamis";
		        weekday[5] = "Jumat";
		        weekday[6] = "Sabtu";
		        var month = new Array();
		        month[0] = "Jan";
		        month[1] = "Feb";
		        month[2] = "Mar";
		        month[3] = "Apr";
		        month[4] = "Mei";
		        month[5] = "Jun";
		        month[6] = "Jul";
		        month[7] = "Agust";
		        month[8] = "Sept";
		        month[9] = "Okt";
		        month[10] = "Nov";
		        month[11] = "Des";
		        $(".tanggal").html(weekday[d.getDay()]+", "+d.getDate()+" "+month[d.getMonth()]+" "+d.getFullYear());
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
		<style type="text/css">
			#myTable td,#myTable1 td,#myTable2 td,#myTable3 td{
				font-size: 18px;
			}
			.tanggal{
	            text-align: center;
	            font-size: 20px;
	            font-weight: bold;
	            display: block;
	            color: #e0e0e0;
	        }
			.clock{
	            text-align: center;
	            font-size: 20px;
	            font-weight: bold;
	            display: block;
	            color: #e0e0e0;
	        }
		</style>
	</body>
</html>