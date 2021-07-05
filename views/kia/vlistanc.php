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
		$("tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
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
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
			$("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
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
<style>
	table.form td {
		vertical-align: middle;
		border:none;
		padding: 0px;
	}
	table.form th {
		vertical-align: top;
		padding: 10 0 0 0;
	}
</style>
<div class="col-xs-12">
	<?php echo $this->session->flashdata('message');?>
	<div class="box box-primary">
		<div class='box-header'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
		<?php echo form_open("kia/listbumil",array("id"=>"formcari"));?>
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-3">Tanggal Daftar</label>
					<div class="col-xs-4"><input type=text name=tgl1 value='<?php echo $tgl1;?>' style="width:100"></div>
					<div class='col-xs-5'><input type=text name=tgl2 value='<?php echo $tgl2;?>'  style="width:100"></div>
				</div>
	  			<div class="form-group">
					<label class="control-label col-xs-3">Tampilan perhalaman</label>
					<div class="col-xs-4"><input type=text name=baris size=3 value='<?php echo $baris;?>'>
					<div class="col-xs-5"><button type="submit" name="Submit" class="btn" style='margin-top:-10px'><i class='icon-search'></i>&nbsp;View</button></div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-3">Ke Halaman</label>
					<div class="col-xs-4">
						<select name=hal style="width:100">
						<?php
							for($i=1;$i<=$npage;$i++){
								if($i==$hal) $sel=" selected "; else $sel=""; 
								echo "<option value='".$i."'" . $sel ."> $i </option>";
							}
						?>
						</select>
					</div>
					<div class="col-xs-5">
						<div class="btn-group">
							<button name=prev class="btn btn-warning">Prev</button>
							<button name=next class="btn btn-warning">Next</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-body">
			<table id="data colums" class="table table-bordered table-striped">
			<?php echo form_close();?>
			<tr>
			   <th width="49" >No</th>
			   <th width="83" >No. Pasien</th>
			   <th>Nama</th>
			   <th width="100" >&nbsp;</th>
			 </tr>
			</tr>
			<?php
				$i = $posisi;
				$no_kk = '';
				foreach ($q->result() as $row){
					$i++;
					echo "<tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
						  <td align=center>".$i."</td>
						  <td align=right>".$row->no_pasien."</td>
						  <td>".$row->nama_pasien."</td>
						  <td align=center>
								<button type='button' class='edit btn btn-success' value='".$row->id_pendaftaran."'><i class='icon-edit'></i></button>
								<button type='button' class='hapus btn btn-danger' value='".$row->id_pendaftaran."'><i class='icon-remove'></i></button>
						  </td>
					</tr>";
				}
			?>
			</table>
		</div>
	</div>
</div>