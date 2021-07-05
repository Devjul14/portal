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
            $(".notif_kb").html(message);
        } else {
            $(document).attr("title", title);
            $(".notif_kb").html("");
        }
        setInterval(function(){ 
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var baris = $("input[name='baris']").val();
            var hal = $("select[name='hal']").val();
            view_kb(tgl1,tgl2,baris,hal);
            notif_kb(tgl1,tgl2,baris,hal);
        }, delay);
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
		$("a.edit").click(function(){
            var id = $(".bg-gray").attr("href");
			window.location = "<?php echo site_url('pendaftaran/addpasienbaru/n/n')?>/"+id;
            return false;
        });
    });
    var view_kb = function(tgl1,tgl2,baris,hal){
        var arrayData = {tgl1: tgl1, tgl2: tgl2, baris: baris, hal: hal};
        $.ajax({
            url: "<?php echo site_url('pasienkb/view_kb');?>", 
            type: 'POST', 
            data: arrayData, 
            success: function(hasil){
                $(".view_kb").html(hasil);
            }
        });
    };
    var notif_kb = function(tgl1,tgl2,baris,hal){
        var arrayData = {tgl1: tgl1, tgl2: tgl2, baris: baris, hal: hal};
        $.ajax({
            url: "<?php echo site_url('pasienkb/notif_kb');?>", 
            type: 'POST', 
            data: arrayData, 
            success: function(jmlrec){
                var title = "<?php echo $title;?>";
                var message = "<div class=notif><div class='callout callout-warning'><p>Ada <strong class='text-red'>"+jmlrec+" pasien</strong> yang belum diperiksa</p></div></div>";
                if (jmlrec>0){
                    $(".jmlrec").html(jmlrec);
                    $(document).attr("title", "("+jmlrec+") "+title);
                    $('.notif_kb').fadeIn('slow').delay(3000).fadeOut(100);
                    $('#chatAudio')[0].play();
                    $(".notif_kb").html(message);
                } else {
                    $(document).attr("title", title);
                    $(".notif_kb").html("");
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
<div class="notif_kb"></div>
<div class="col-xs-12">
	<?php echo $this->session->flashdata('message');?>
	<?php echo form_open("pasienkb",array("id"=>"formcari"));?>
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
                    <label class="control-label col-xs-2">Tampilan perhalaman</label>
                    <div class="col-xs-10">
                    	<div class="input-group">
                    		<input type=text name=baris size=3 value='<?php echo $baris;?>' class="form-control">
                    		<span class="input-group-btn"><button type="submit" name="Submit" class="btn btn-info"><i class='fa fa-search'></i>&nbsp;View</button></span>
  						</div>
  					</div>
  				</div>
  				<div class="form-group">
                    <label class="control-label col-xs-2">Ke Halaman</label>
                    <div class="col-xs-5">
			 			<select name=hal class="form-control">
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
	<?php echo form_close();?>
	<div class="box box-primary">
		<div class="box-body">
			<div class="view_kb">
				<table id="myTable" class="table table-bordered">
					<thead>
						<tr class="bg-navy">
						   <th width="49px">No</th>
						   <th width="100px" class='text-center'>Tgl</th>
						   <th width="69px" class='text-center'>No. KK</th>
						   <th width="130px" class='text-center'>No. Pasien</th>
						   <th>Nama</th>
						   <th width="50" class='text-center'>P</th>
						   <th width="50" class='text-center'>C</th>
						   <th width="180">Layanan</th>
						   <th width="130">Medis</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i = $posisi;
							$no_kk = '';
							foreach ($q->result() as $row){
								$i++;
								echo "<tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
									  <td class=text-center>".$i."</td>
									  <td class=text-center>".date("d-m-Y",strtotime($row->tanggal))."</td>";
								if ($no_kk<>$row->no_kk){ 
									echo "<td class=text-center>".$row->no_kk."</td>";
									$no_kk = $row->no_kk;
								}
								else
									echo "<td class=text-center>&nbsp;</td>";
								echo "<td class=text-center>".$row->no_pasien."</td>
									  <td>
											".anchor("pasienkb/pasienkbdetail/".$row->id_pendaftaran."/".$row->id_pasien,$row->nama_pasien,array("class"=>"btn btn-success btn-sm"))."&nbsp;&nbsp;".
											  anchor("pasienkb/batalperiksa/".$row->id_pendaftaran,"BATAL",array("class"=>"btn btn-danger btn-sm"))."
									  </td>
									  <td class=text-center>".$row->isperiksa."</td>
									  <td class=text-center>".$row->iscatat."</td>
									  <td class=text-center>".$row->layanan."</td>
									  <td class=text-center>".$row->nama_paramedis."</td>
									  </tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>