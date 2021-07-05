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
    	var delay = 5000; //Your delay in milliseconds
    	var jmlrec = <?php echo $jmlrec;?>;
        var title = "<?php echo $title;?>";
        var message = "<div class=notif><div class='callout callout-warning'><p>Ada <strong class='text-red'>"+jmlrec+" pasien</strong> yang belum diperiksa</p></div></div>";
        if (jmlrec>0){
            $(document).attr("title", "("+jmlrec+") "+title);
            $(".notif_kia").html(message);
        } else {
            $(document).attr("title", title);
            $(".notif_kia").html("");
        }
        setInterval(function(){ 
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var baris = $("input[name='baris']").val();
            var hal = $("select[name='hal']").val();
            view_kia(tgl1,tgl2,baris,hal);
            notif_kia(tgl1,tgl2,baris,hal);
        }, delay);
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
		$("a.edit").click(function(){
            var id = $(".seleksi").attr("href");
			window.location = "<?php echo site_url('pendaftaran/addpasienbaru/n/n')?>/"+id;
            return false;
        });
    });
    var view_kia = function(tgl1,tgl2,baris,hal){
        var arrayData = {tgl1: tgl1, tgl2: tgl2, baris: baris, hal: hal};
        $.ajax({
            url: "<?php echo site_url('kia/view_kia');?>", 
            type: 'POST', 
            data: arrayData, 
            success: function(hasil){
                $(".view_kia").html(hasil);
            }
        });
    };
    var notif_kia = function(tgl1,tgl2,baris,hal){
        var arrayData = {tgl1: tgl1, tgl2: tgl2, baris: baris, hal: hal};
        $.ajax({
            url: "<?php echo site_url('kia/notif_kia');?>", 
            type: 'POST', 
            data: arrayData, 
            success: function(jmlrec){
                var title = "<?php echo $title;?>";
                var message = "<div class=notif><div class='callout callout-warning'><p>Ada <strong class='text-red'>"+jmlrec+" pasien</strong> yang belum diperiksa</p></div></div>";
                if (jmlrec>0){
                    $(".jmlrec").html(jmlrec);
                    $(document).attr("title", "("+jmlrec+") "+title);
                    $('.notif_kia').fadeIn('slow').delay(3000).fadeOut(100);
                    $('#chatAudio')[0].play();
                    $(".notif_kia").html(message);
                } else {
                    $(document).attr("title", title);
                    $(".notif_kia").html("");
                }
            }
        });
    };
</script>
<style type="text/css">
.notif > .callout {
	position: fixed;
  	right: 0;
  	bottom: 0;
  	margin-right: 30px;
  	z-index: 1050;
}
</style>
<audio id="chatAudio">
	<source src="<?php echo base_url();?>sound/audio.mp3" type="audio/mp3">
</audio>
<div class='notif_kia'></div>
<div class="col-xs-12">
	<?php
	    if($this->session->flashdata('message')){
	        $pesan=explode('-', $this->session->flashdata('message'));
	        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
	        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	        <b>".$pesan[1]."</b>
	        </div>";
	    }
	?>
	<?php echo form_open("kia",array("id"=>"formcari"));?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-xs-2">Tanggal Daftar</label>
                    <div class="col-xs-5">
						<input type=text name=tgl1 value='<?php echo $tgl1;?>' class="form-control">
					</div>
					<div class="col-xs-5">
						<input type=text name=tgl2 value='<?php echo $tgl2;?>' class="form-control">
					</div>
				</div>
				<div class="form-group">
                    <label class="control-label col-xs-2">Tampil perhalaman</label>
                    <div class="col-xs-5">
                    	<input type=text name=baris size=3 value='<?php echo $baris;?>' class="form-control">
                    </div>
                    <div class="col-xs-5">
                    	<button type="submit" name="Submit" class="btn btn-primary"><i class='icon-search'></i>&nbsp;View</button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-2">Ke Halaman</label>
					<div class="col-xs-5">
                    	<select name=hal class='form-control'>
							<?php
								for ($i=1;$i<=$npage;$i++){
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
	<?php echo form_close();?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="view_kia">
				<table id="myTable" class="table table-bordered">
					<thead>
						<tr class="bg-navy">
   							<th width="49">No</th>
   							<th class="text-center" width="100">Tanggal</th>
   							<th width="69">No. KK</th>
   							<th class="text-center" width="100">No. Pasien</th>
   							<th>Nama</th>
   							<th class="text-center" width="20">P</th>
   							<th class="text-center" width="20">C</th>
   							<th class="text-center" width="130">Layanan</th>
   							<th class="text-center" width="100">Medis</th>
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
									  <td class='text-center'>".date("d-m-Y",strtotime($row->tanggal))."</td>";
								if ($no_kk<>$row->no_kk){ 
									echo "<td class='text-center'>".$row->no_kk."</td>";
									$no_kk = $row->no_kk;
								}
								else
									echo "<td class='text-center'>&nbsp;</td>";
								echo "<td class='text-center'>".$row->no_pasien."</td>
									  <td>"
									  		."<strong>".$row->nama_pasien."</strong>&nbsp;&nbsp;"
									  		."<div class='pull-right'>"
									  		.anchor("kia/ancdetailadd/".$row->id_pendaftaran."/".$row->id_pasien,"PERIKSA",array("class"=>"btn btn-sm btn-info"))."&nbsp;&nbsp;"
									  		.anchor("kia/ancinapadd/".$row->id_pendaftaran."/".$row->id_pasien,"INAP",array("class"=>"btn  btn-sm btn-success"))."&nbsp;&nbsp;"
									  		.anchor("kia/batalperiksa/".$row->id_pendaftaran,"BATAL",array("class"=>"btn  btn-sm btn-danger"))
									  		."</div>".
									  "</td>
									  <td class='text-center'>".$row->isperiksa."</td>
									  <td class='text-center'>".$row->iscatat."</td>
									  <td class='text-center'>".$row->layanan."</td>
									  <td class='text-center'>".$row->nama_paramedis."</td>
									  </tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>