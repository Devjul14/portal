<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">

    <script src="<?php echo base_url(); ?>js/jslama/js/jquery-1.7.2.min.js"></script>
	<!--app-->
    <script src="<?php echo base_url(); ?>js/jslama/js/script.js"></script>
	<!--jquery ui-->
    <script src="<?php echo base_url(); ?>js/jslama/js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/jquery-ui-1.7.2.custom.min.js"></script>
    <!--bootstrap-->
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-tab.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-popover.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-button.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_url(); ?>js/jslama/js/bootstrap-typeahead.js"></script>

</head>
<style type="text/css">
    .seleksi{
        background-color: #cfd7e6;
    }
</style>
<script>
    $(document).ready(function(){
        $("table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
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
		$(".simpan").click(function(){
			var nama_obat = $("input[name='cari']").val();
			changeData(nama_obat);
		});
		$("tr#selek").dblclick(function(){
			close();
			var url = $(this).attr("href");
			var id = url.split("/");
			window.opener.$("input[name='id_obat']").val(id[0]);
			window.opener.$("input[name='nama_obat']").val(id[1]);
			return false;
		});
    });
var changeData = function(strkode){
	var arrayData = {nama_obat: strkode};
	$.ajax({
		url: "<?php echo site_url('umum/simpanobat');?>", 
		type: 'POST', 
		data: arrayData, 
		success: function(){
			$("#formcari").trigger("submit");
		}
	});
};
</script>

<body>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	        	<div class="ibox-title">
	        		<div class="form-horizontal">
	        			<div class='form-group'>
	                        <div class='col-sm-4'></div>
	                        <label class='col-sm-4'>
	                        	<h2 align=center>Obat</h2>
	                        </label>
	                        <div class='col-sm-4'></div>
	                    </div>
	                </div>
	        	</div>
	            <div class="ibox-content" >
	            	<?php echo form_open("umum/cariobat",array("id"=>"formcari"));?>
	                <div class="form-horizontal">
	                	<div class="form-group">
                            <label class="col-sm-2">
                            	Nama Obat
                            </label>
	                        <div class="col-sm-4">
	                        	<input type=text name=cari  value="<?php echo $cari;?>" class="form-control">

	                        </div>
	                        <div class="col-sm-4">
	                        	<a href="#" class="btn btn-primary btn-outline simpan" ><i class='fa fa-plus'></i>&nbsp;Save</a>
	                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2">
                            	Per-Halaman
                            </label>
	                        <div class="col-sm-4">
	                        	<input type=text name=baris value="<?php echo $baris;?>" class="form-control">

	                        </div>
	                        <div class="col-sm-4">
	                        	<button type="submit" name="Submit" class="btn btn-outline btn-primary">
	                        		<i class='fa fa-search'></i>&nbsp;View</button>
	                        </div>
                        </div>
                        <?php echo form_close();?>
                        <table class="table table-hover">
                        	<tr>
							   <th width="49" >No</th>
							   <th>Nama Obat</th>
							 </tr>
							<?php
								$i = $posisi;
								foreach ($q->result() as $row){
									$i++;
									echo "<tr id=selek href='".$row->id_obat."/".$row->nama_obat."'>
										  <td>".$i."</td>
										  <td>".$row->nama_obat."</td>
										  </tr>";
								}
							?>
                        </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url();?>js/inspinia.js"></script>
<script src="<?php echo base_url();?>js/plugins/pace/pace.min.js"></script>

<script src="<?php echo base_url();?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

</body>

</html>