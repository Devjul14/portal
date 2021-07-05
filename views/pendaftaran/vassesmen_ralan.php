<script type="text/javascript">
	$(document).ready(function(){
		getassesmen();
		getluka();
		$('.ok').click(function() {
			var kode = $("[name='luka'] option:selected").val();
			var luka = $("[name='luka'] option:selected").text();
			var namaclass = $("[name='namaclass']").val();
			var keterangan = $("[name='keterangan']").val();
			$(".s"+namaclass).html(kode+" ("+keterangan+")");
			$("."+namaclass).attr("luka",kode);
			$("."+namaclass).attr("keterangan",keterangan);
			$(".modalnotif").modal("hide");
		});
		$('.back').click(function(){
			var no_rm = $("[name='no_rm']").val();
			var no_reg = $("[name='no_reg']").val();
            window.location = "<?php echo site_url('dokter/igdralan');?>/"+no_rm+"/"+no_reg;
        });
		$('.hapus').click(function() {
			var namaclass = $("[name='namaclass']").val();
			$(".s"+namaclass).remove();
			$("."+namaclass).remove();
			$(".modalnotif").modal("hide");
		});
		$('.simpan').click(function() {
			var item = {};
			var i = 0;
			var asal = "<?php echo $asal;?>";
			var xtempat = parseInt($('.tempat').offset().left);
			var ytempat = parseInt($('.tempat').offset().top);
			var no_reg = $("[name='no_reg']").val();
			$.each($(".titik"), function(key, value){
				var x = parseInt($(this).offset().left);
				var y = parseInt($(this).offset().top);
				var itemData = {no_reg:no_reg,xcor:x-xtempat,ycor:y-ytempat,luka:$(this).attr("luka"),keterangan:$(this).attr("keterangan"),asal:asal};
				item[i] = itemData;
            	i++;
			});
			$.ajax({
        	    url: "<?php echo site_url('assesmen/simpan');?>", 
        	    type: 'POST', 
        	    data: {item:item,no_reg:no_reg,asal:asal},
        	    success: function(result){
        	        console.log(result);
        	        location.reload();
        	    },
        	    error: function(result){
        	        console.log(result);
        	    }
        	});
			console.log(item);
		})
		$('.tempat').click(function(evt) {
			var ada = 0;
			var xcord = 0;
			var ycord = 0
			var xtempat = parseInt($(this).offset().left);
			var ytempat = parseInt($(this).offset().top);
			$.each($(".titik"), function(key, value){
				var x = parseInt($(this).offset().left);
				var y = parseInt($(this).offset().top);
				if (x<parseInt(evt.pageX) && parseInt(evt.pageX)<(x+30) && y<parseInt(evt.pageY) && parseInt(evt.pageY)<(y+30)){
					ada = 1;
					xcord = x-xtempat;
					ycord = y-ytempat;
				}
			});
			if (!ada){
            	evt.preventDefault();
            	var dataText = $(this);
            	var luka = getluka();
            	var dataInputField = $('<div style="position:absolute;left:'+(evt.pageX-xtempat-12)+'px;top:'+(evt.pageY-ytempat-12)+'px"><button class="titik btn btn-xs btn-danger '+(evt.pageX-xtempat-12)+'x'+(evt.pageY-ytempat-12)+'"><i class="fa fa-close"></i></button>&nbsp;<span class="ket text-bold text-green s'+(evt.pageX-xtempat-12)+'x'+(evt.pageY-ytempat-12)+'"></span></div>');
            	dataText.append(dataInputField);
            	$("[name='namaclass']").val((evt.pageX-xtempat-12)+'x'+(evt.pageY-ytempat-12));
            } else {
            	var luka = $(this).find("."+xcord+"x"+ycord).attr("luka");
            	var keterangan = $(this).find("."+xcord+"x"+ycord).attr("keterangan");
				$(".modalnotif").modal("show");
				$("[name='keterangan']").val(keterangan);
				$("[name='luka']").val(luka);
				$("[name='namaclass']").val(xcord+"x"+ycord);
            }
            $(".modalnotif").modal("show");
        });
	});
	function getassesmen(){
		var no_reg = $("[name='no_reg']").val();
		var asal = "<?php echo $asal;?>";
		$(".tempat").empty();
		var html = '<img src="<?php echo base_url().'/img/igd.jpg';?>" class="img" style="height:600px">';
		$(".tempat").html(html);
		$.ajax({
            url: "<?php echo site_url('assesmen/getassesmen');?>", 
            type: 'POST', 
            data:{no_reg:no_reg,asal:asal},
            success: function(result){
            	var result = JSON.parse(result);
                $.each(result, function(key, value){
					var dataText = $(".tempat");
            		var dataInputField = $('<div style="position:absolute;left:'+(value.xcor)+'px;top:'+(value.ycor)+'px"><button class="titik btn btn-xs btn-danger '+value.xcor+'x'+value.ycor+'" luka="'+value.luka+'"  keterangan="'+value.keterangan+'"><i class="fa fa-close"></i></button>&nbsp;<span class="text-bold text-green s'+value.xcor+'x'+value.ycor+'">'+value.luka+' ('+value.keterangan+')</span></div>');
            		dataText.append(dataInputField);
				});
            },
            error: function(result){
                console.log(result);
            }
        });
	}
	function getluka(){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('assesmen/getluka');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='luka' class='form-control'>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.kode+"'>"+value.keterangan+"</option>";
                })
                html += "</select><br>";
                html += "<p class='text-bold'>Keterangan</p><textarea name='keterangan' class='form-control'></textarea>";
                result = html;
            }
        });
        $(".listluka").html(result);
    };
</script>
<div class="modal fade modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-navy"></div>
            <div class="modal-body">
            	<input name='namaclass' type="hidden">
                <span class="listluka"></span>
            </div>
            <div class="modal-footer">
            	<button class="hapus btn btn-danger pull-left" type="button">Hapus</button>
                <button class="ok btn btn-success" type="button">OK</button>
            </div>
        </div>
    </div>
</div>	
<?php
	if ($q->num_rows()>0){
		$row = $q->row();
		$no_reg = $row->no_reg;
		$nama_pasien = $row->nama_pasien;
		$no_pasien = $row->no_pasien;
	} else {
		$no_reg = $nama_pasien = $no_pasien = "";
	}
?>
<div class="box box-primary">
	<div class="box-body">
	    <div class="form-horizontal">
	        <div class="form-group">
	            <label class="col-md-2 control-label">No. Reg</label>
	            <div class="col-md-2">
	                <input type="text" readonly class="form-control" name='no_reg' readonly value="<?php echo $no_reg;?>"/>
	            </div>
	            <label class="col-md-1 control-label">No. RM</label>
	            <div class="col-md-2">
	                <input type="text" readonly class="form-control" name='no_rm' readonly value="<?php echo $no_pasien;?>"/>
	            </div>
	            <label class="col-md-2 control-label">Nama Pasien</label>
	            <div class="col-md-3">
	                <input type="text" class="form-control" name='nama_pasien' value="<?php echo $nama_pasien;?>" readonly/>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<div class="table-responsive">
	<div class="tempat col-xs-12" id="tempat" style="padding:20px">
		<img src="<?php echo base_url().'/img/igd.jpg';?>" style="width:600px">
	</div>
</div>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
        	<div class="btn-group">
                <button class="back btn btn-sm btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
				<button class="btn btn-sm btn-success simpan"><i class="fa fa-save"></i>&nbsp;Simpan</button>
			</div>
		</div>
	</div>
</div>