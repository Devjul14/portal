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
        var id_aksi_bblr = $("select[name='id_aksi_bblr']").val();
        $(".detail_bblr").load("<?php echo site_url('kia/detail_bblr');?>/"+id_aksi_bblr);
		var formattgl = "dd-mm-yy";
		$("select[name='id_aksi_bblr']").change(function(){
			var id_aksi_bblr = $(this).val();
        	$(".detail_bblr").load("<?php echo site_url('kia/detail_bblr');?>/"+id_aksi_bblr);
        	return false;
		})
        $("input[name='tgl_haid_terakhir']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
		$("input[name='tgl_taksiran_persalinan']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
        $("select[name='id_detail_bblr']").change(function(){
        	alert($(this).val());
        	return false;
        });
        $(".cari").click(function(){
			var url = "<?php echo site_url('kia/carilab');?>";
			openCenteredWindow(url);
			return false;
		});
		$(".simpan").click(function(){
			var id_detail_bblr = $("select[name='id_detail_bblr']").val();
			$("input[name='id_detail_bblr2']").val(id_detail_bblr);
			$("#formsavelab").trigger("submit");
			return false;
		});
		$(".hapus").click(function(){
			var id = $(this).val();
			window.location = "<?php echo site_url('kia/hapusbblr');?>/"+id;
		});
    });
</script>
<style>
	.table td{
		border-top:0;
		font-size:14px;
	}
</style>
<div class="row-fluid">
<div class="span12">
<?php echo $this->session->flashdata('message');?>
<div class="subnav">
	<div class='span12'>
		<div class='text-center'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
	</div>
</div>
	<div class="widget-box">
		<div class="widget-content">
			<table class="table">
				<tr valign=top>
					<td width='150'>Asal Puskesmas</td>
					<td width=10>:</td>
					<td><?php echo $p->nama_puskesmas;?></td>
				</tr>
				<tr>
					<td>No. Pasien</td>
					<td>:</td>
					<td><?php echo $p->no_pasien;?></td>
				</tr>
				<tr>
					<td>Nama Pasien</td>
					<td>:</td>
					<td><?php echo $p->nama_pasien;?></td>
				</tr>
				<tr>
					<td>Umur</td>
					<td>:</td>
					<td><?php echo $this->Mpendaftaran->umur($p->tgl_lahir,$p->tanggal);?></td>
				</tr>
			</table>
		</div>
	</div>
<div class="row-fluid">
<div class="span12">
<table id="data colums" class="table table-bordered">
	<?php echo form_close();?>
	<tr>
   		<th width="20px" >No</th>
   		<th>Aksi BBLR</th>
   		<th>Detail BBLR</th>
   		<th>Nilai BBLR</th>
   		<th width=100>Action</th>
 	</tr>
 	<?php echo form_open("kia/simpanbblr",array("id"=>"formsavelab","class"=>"form-horizontal")); ?>
 	<tr>
		<td>&nbsp;</td>
		<td>
			<input type=hidden name="id_pendaftaran" value='<?php echo $id_pendaftaran;?>'>
			<input type=hidden name="id_bayi" value='<?php echo $id_bayi;?>'>
			<input type=hidden name="id_detail_bblr2">
			<select name="id_aksi_bblr">
				<?php
					foreach ($q1->result() as $row) {
						echo "<option value='".$row->id_aksi_bblr."'>".$row->nama_aksi_bblr."</option>";
					}
				?>
			</select>
		</td>
		<td>
			<span class="detail_bblr">
				<select name='id_detail_bblr'></select>
			</span>
		</td>
		<td>
			<input type=text name="nilai_detail_bblr">
		</td>
		<td style="text-align:center"><button name="Submit" class="btn simpan"><i class='icon-ok'></i>&nbsp;Save</button></td>
	</tr>
	<?php echo form_close();?>
	<?php
		$i = 0;
		foreach ($q->result() as $row){
			$i++;
			echo "<tr id='data' class='pasienlab'>
			  <td align=center>".$i."</td>
			  <td>".$row->nama_aksi_bblr."</td>
			  <td>".$row->nama_detail_bblr."</td>
			  <td>".$row->nilai_detail_bblr."</td>
			  <td style='text-align:center'>
			  	<button type='button' class='hapus btn btn-danger' value='".$id_pendaftaran."/".$id_bayi."'>
			  		<i class='icon-remove'></i>
			  	</button>
			  </td>
			  </tr>";
		}
	?>
</table>
</div>
</div>