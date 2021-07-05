<script>
    $(document).ready(function(){
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
		$("a.formedit").click(function(){
            var id = $(".bg-gray").attr("href");
			window.location = "<?php echo site_url('admindkk/addtindakan')?>/"+id;
            return false;
        });
		$("a.hapus").click(function(){
            var id = $(".bg-gray").attr("href");
			window.location = "<?php echo site_url('admindkk/hapustindakan')?>/"+id;
            return false;
        });
		$("select[name='id_layanan']").change(function(){
            var id = $(this).val();
			window.location = "<?php echo site_url('admindkk/tindakan')?>/"+id;
            return false;
        });
    });
</script>
<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">		
				<div class="form-group">
					<label class="col-sm-1 control-label">Layanan</label>
					<div class="col-sm-11">
						<select name=id_layanan class="form-control">
						<option value=''>---Pilih---</option>
						<?php
							foreach ($q2->result() as $row){
								echo "<option value='".$row->id_layanan."' ".($id_layanan==$row->id_layanan ? "selected" : "").">".$row->layanan."</option>";
							}
						?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-body">
			<table class="table table-bordered table-striped">
			<tr class="bg-navy">
				<th width=5px>No.</th>
				<th>Layanan</th>
				<th>Tindakan</th>
				<th>Karcis</th>
			</tr>
			<?php
			if ($q1->num_rows()<=0){
				echo "<tr><td colspan='4'>Data Masih Kosong</td></tr>";
			} else {
				$i=$n=1;
				$id_layanan = "";
				foreach($q1->result() as $row){
					echo "<tr id=data href='".$row->id_tindakan."'>";
					if ($id_layanan<>$row->id_layanan){
						echo "<td>".($i++)."</td>";
						echo "<td>".$row->layanan."</td>";
						$id_layanan = $row->id_layanan;
						$n=1;
					}
					else
						echo "<td>&nbsp;</td><td>&nbsp;</td>";
					echo "<td>".($n++).". ".$row->nama_tindakan."</td>
						  <td style='text-align:right'>".number_format($row->karcis)."</td>
						  </tr>";
				}
			}
			?>
			</table>
		</div>
	</div>
</div>