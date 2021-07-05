<script>
var mywindow;
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(){
    	$('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
		$("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
		$("select[name='hal']").change(function(){
			$("#formcari").submit();
			return false;
		});
		$("input[name='next']").click(function(){
			var hal = $("select[name='hal']").val();
			hal++;
			$("select[name='hal']").val(hal);
			$("#formcari").submit();
			return false;
		});
		$("input[name='prev']").click(function(){
			var hal = $("select[name='hal']").val();
			hal--;
			$("select[name='hal']").val(hal);
			$("#formcari").submit();
			return false;
		});
		$("input[name='no_kk']").change(function(){
			var no_kk = $(this).val();
			var id_puskesmas = $("select[name='id_puskesmas']").val();
			$("#nama_pasien").load("<?php echo site_url('pendaftaran/getlistpasien');?>/"+id_puskesmas+"/"+no_kk);
			$("#nama_kk").load("<?php echo site_url('pendaftaran/getnamakk');?>/"+id_puskesmas+"/"+no_kk+"/Y");
			return false;
		});
		var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl
        });
			$("input[name='tgl2']").datepicker({
            dateFormat : formattgl
        });
		$("table#cari td a").click(function(){
			close();
			var url = $(this).attr("href");
			window.opener.$("input[name='no_kk']").val(url);
			window.opener.$("input[name='no_kk']").change();
			return false;
		});
		$(".edit").click(function(){
            var id = $(this).val();
			window.location = "<?php echo site_url('kia/bumildetail')?>/"+id;
            return false;
        });
        $(".hapus").click(function(){
            var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapusbumildetail')?>/"+id;
            return false;
        });
    })
</script>
<div class="col-xs-12">
	<?php echo $this->session->flashdata('message');?>
	<?php echo form_open("kia/listbumil",array("id"=>"formcari"));?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-2">Tanggal Daftar</label>
    				<div class="col-xs-5"><input type=text name=tgl1 value='<?php echo $tgl1;?>' class="form-control"></div>
    				<div class="col-xs-5"><input type=text name=tgl2 value='<?php echo $tgl2;?>' class="form-control"></div>
  				</div>
  				<div class="form-group">
					<label class="control-label col-xs-2">Nama</label>
    				<div class="col-xs-10"><input type=text name=nama value='<?php echo $nama;?>' class="form-control"></div>
    			</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Tampilan perhalaman</label>
    				<div class="col-xs-10">
    					<div class="input-group">
							<input type=text name=baris size=3 value='<?php echo $baris;?>' class="form-control">
							<span class="input-group-btn"><button type="submit" name="Submit" class="btn btn-info"><i class='fa fa-search'></i></button></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Ke Halaman</label>
    				<div class="col-xs-6">
    					<select name=hal class="form-control">
							<?php
								for($i=1;$i<=$npage;$i++){
									if($i==$hal) $sel=" selected "; else $sel=""; 
									echo "<option value='".$i."'" . $sel ."> $i </option>";
								}
							?>
						</select>
					</div>
					<div class="col-xs-4">
						<div class="btn-group">
							<button type="button" name=prev class="btn btn-warning">Prev</button>
							<button type="button" name=next class="btn btn-warning">Next</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
	<div class="box box-primary">
		<div class="box-body">
			<table id="myTable" class="table table-bordered table-striped">
				<thead>
					<tr class="bg-navy">
					   <th width="49" class="text-center">No</th>
					   <th width="130" class="text-center">No. Pasien</th>
					   <th>Nama</th>
					   <th width="100">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i = $posisi;
					$no_kk = '';
					foreach ($q->result() as $row){
						$i++;
						echo "<tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
							  <td class='text-center'>".$i."</td>
							  <td class='text-center'>".$row->no_pasien."</td>
							  <td>".$row->nama_pasien."</td>
							  <td align=center>
									<button type='button' class='edit btn btn-success btn-sm' value='".$row->id_pendaftaran."/".$row->id_pasien."'><i class='fa fa-edit'></i></button>
									<button type='button' class='hapus btn btn-danger btn-sm' value='".$row->id_pasien."'><i class='fa fa-remove'></i></button>
							  </td>
						</tr>";
					}
				?>
				</tbody>
			</table>
		</div>
	</div>