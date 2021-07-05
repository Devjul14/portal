<link href="<?php echo base_url();?>css/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.7.2.custom.min.js"></script>
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
			window.location = "<?php echo site_url('kia/ancdetailedit')?>/"+id;
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
<div class="row-fluid">
<div class="span12">
<?php echo $this->session->flashdata('message');?>
<div class="subnav">
	<div class='span12'>
		<div class='text-center'><h4><?php echo $judul;?>&nbsp;&nbsp;</h4></div>
	</div>
</div>
<?php echo form_open("kia/listpasien_anc",array("id"=>"formcari"));?>
<div class="widget-box">
	<div class="widget-content">
<table id="data colums" class="table table-condensed form">
  <tr>
	<td width=150px>Tanggal Daftar</td>
    <td><input type=text name=tgl1 value='<?php echo $tgl1;?>' style="width:100">&nbsp;&nbsp;s/d&nbsp;&nbsp;<input type=text name=tgl2 value='<?php echo $tgl2;?>'  style="width:100"></td>
  </tr>
  <tr>
	<td width=150px>Nama</td>
    <td><input type=text name=nama value='<?php echo $nama;?>'></td>
  </tr>
  <tr>
    <td>Tampilan perhalaman</td>
    <td><input type=text name=baris size=3 value='<?php echo $baris;?>'>&nbsp;&nbsp;<button type="submit" name="Submit" class="btn" style='margin-top:-10px'><i class='icon-search'></i>&nbsp;View</button></td>
  </tr>
<tr>
	<th colspan=4>
			Ke Halaman <select name=hal style="width:100">
			<?php
				for($i=1;$i<=$npage;$i++){
					if($i==$hal) $sel=" selected "; else $sel=""; 
					echo "<option value='".$i."'" . $sel ."> $i </option>";
				}
			?>
			</select>
			&nbsp;<input type=button name=prev value='Prev' class="btn" style='margin-top:-10px'>
			&nbsp;<input type=button name=next value='Next' class="btn" style='margin-top:-10px'>
	</th>
</tr>
</table>
</div></div>
<table id="data colums" class="table table-bordered">
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
					<button type='button' class='edit btn btn-success' value='".$row->id_pendaftaran."/".$row->id_pasien."'><i class='icon-edit'></i></button>
					<button type='button' class='hapus btn btn-danger' value='".$row->id_pasien."'><i class='icon-remove'></i></button>
			  </td>
		</tr>";
	}
?>
</table>
</div>
</div>