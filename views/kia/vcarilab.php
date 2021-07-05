<!DOCTYPE html>
<html>
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
    <link rel="icon" href="<?php echo base_url();?>img/logo.ico" type="image/x-icon" />
</head>
<script>
    $(document).ready(function(){
    	$('#myTable').fixedHeaderTable({ height: '300', altClass: 'odd', footer: true});
        $("table tr#data:first").addClass("bg-gray");
        $("table tr#data").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
		$(".caricc").click(function(){
			close();
			var url = $(this).val();
			var id = url.split("/");
			window.opener.$("input[name='kodecc']").val(id[0]);
			window.opener.$("input[name='namacc']").val(id[1]);
			return false;
		});
		$(".atas").click(function(){
			window.history.back()
		});
		$("tr#data").dblclick(function(){
			close();
			var url = $(this).attr("href");
			var id = url.split("/");
			window.opener.$("input[name='id_lab']").val(id[0]);
			window.opener.$("input[name='nama_lab']").val(id[1]);
			return false;
		});
    })
</script>
<body>
	<div class="row margin">
	    <div class="col-xs-12">
	        <div class="box box-primary">
	        	<div class="box-header"><h3>Laboratorium</h3></div>
	            <div class="box-body">
	            	<?php echo form_open("kia/carilab",array("id"=>"formcari"));?>
	                <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Per-Halaman</label>
	                        <div class="col-sm-10">
	                        	<div class="input-group">
	                        		<input type=text name=baris value="<?php echo $baris;?>" class="form-control">
	                        		<span class="input-group-btn"><button type="submit" name="Submit" class="btn btn-primary"><i class='fa fa-search'></i></button></span>
	                        	</div>
	                        </div>
                        </div>
                        <?php echo form_close();?>
                        <table class="table table-hover table-bordered table-striped" id="myTable">
                        	<thead>
                        		<tr class='bg-navy'>
								   <th width="49" >No</th>
								   <th>Nama Lab</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$i = $posisi;
								foreach ($q->result() as $row){
									$i++;
									echo "<tr id=data href='".$row->id_lab."/".$row->nama_lab."'>
										  <td>".$i."</td>
										  <td>".$row->nama_lab."</td>
										  </tr>";
								}
							?>
							</tbody>
                        </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>