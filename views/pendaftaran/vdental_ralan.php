<script type="text/javascript">
	$(document).ready(function(){
		polygon(0,0,70,70,800,200);
        getdental();
        getpasien();
		$('.ok').click(function() {
            var no_reg = $("[name='no_reg']").val();
            var index = $("[name='index']").val();
			var kode = $("[name='dental'] option:selected").val();
			var dental = $("[name='dental'] option:selected").text();
            var color = $("[name='dental'] option:selected").attr("color");
			var keterangan = $("[name='keterangan']").val();
            var nomor = $("[name='nomor']").val();
            var icd10 = $("[name='icd10']").val();
            var icd = icd10.split(" | ");
            icd10 = icd[0];
            var icd10_keterangan = icd[1];
            // $.each($("polygon"),function(key,val){
            //     if (key==index){
            //         $(this).attr("kode",kode);
            //         $(this).attr("keterangan",keterangan);
            //         $(this).attr("icd10",icd[0]);
            //         $(this).attr("icd10_keterangan",icd[1]);
            //         $(this).attr("nomor",nomor);
            //         $(this).css("fill",color);
            //     }    
            // });
            var item = {};
            var itemData = {no_reg:no_reg,indeks:index,kode_tindakan:kode,keterangan:keterangan, icd10: icd10, icd10_keterangan: icd10_keterangan,nomor_gigi:nomor};
            item[0] = itemData;
            $.ajax({
                url: "<?php echo site_url('assesmen/simpan_dental');?>", 
                type: 'POST', 
                data: {item:item,no_reg:no_reg,indeks:index},
                success: function(result){
                    location.reload();
                },
                error: function(result){
                    console.log(result);
                }
            });
   //          $("[name='index']").val("");
			// $("[name='keterangan']").val("");
   //          $("[name='icd10']").val("");
   //          $("[name='nomor']").val("");
			// $(".modalnotif").modal("hide");
		});
        $(".modalnotif").on("hidden.bs.modal", function () {
            $("[name='index']").val("");
			$("[name='keterangan']").val("");
            $("[name='icd10']").val("");
            $("[name='nomor']").val("");
        });
		$('.back').click(function(){
			var no_rm = $("[name='no_rm']").val();
			var no_reg = $("[name='no_reg']").val();
            window.location = "<?php echo site_url('dokter/igdralan/assesmen');?>/"+no_rm+"/"+no_reg;
        });
        $('.polygon').mouseover(function() {
            $(this).find('path, polygon, circle').attr('fill', '#ccc');
        }).mouseleave(function() {
            $(this).find('path, polygon, circle').attr('fill', '#fff');
        });
        $('.polygon').on('click','polygon',function(){
            var no_rm = $("[name='no_rm']").val();
            var indeks = $(this).index();
            var nomor = $(this).attr("nomor");
            $(".modalnotif").modal("show");
            $("[name='index']").val(indeks);
            $("[name='nomor']").val(nomor);
            getpasien_dental_detail();
            $.ajax({
                url: "<?php echo site_url('assesmen/getpasien_dental_detail');?>", 
                type: 'POST', 
                data: {no_rm:no_rm,nomor:nomor},
                success: function(result){
                    result = JSON.parse(result);
                    var html = '';
                    $.each(result, function(key,value){
                        html += "<tr>";
                        html += "<td>"+tgl_indo(value.tanggal)+"</td>";
                        html += "<td class='text-center'>"+value.nomor_gigi+"</td>";
                        html += "<td>"+value.icd10+" | "+value.icd10_keterangan+"</td>";
                        html += "<td><span style='margin-top:2px;width:15px;height:15px;float:left;display:block;background-color:"+value.color+"'></span></td>";
                        html += "<td>"+value.keterangan_tindakan+"</td>";
                        html += "<tr>";
                    })
                    $(".listhistory").html(html);
                },
                error: function(result){
                    console.log(result);
                }
            });
        })
        $('.polygon').on('mouseover','polygon',function(){
        	var nomor = $(this).attr("nomor")
            $(".judul").html("Posisi "+(nomor==undefined ? "-" : nomor));
        })
        $("[name='icd10']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>grouper/geticd10",
                    method : "POST",
                    async: false,
                    data : {kode: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var no_reg= $("[name='no_reg']").val();
                var kode = n[0];
                return item;
            }
        });
		$('.hapus').click(function() {
			var index = $("[name='index']").val();
			$("[name='index']").val("");
			$("[name='keterangan']").val("");
            $.each($("polygon"),function(key,val){
                if (key==index){
                    $(this).removeAttr("kode");
                    $(this).removeAttr("keterangan");
                    $(this).css("fill","#ffffff");
                }    
            });
            $(".modalnotif").modal("hide");
		});
		$('.simpan').click(function() {
            var no_reg = $("[name='no_reg']").val();
			var item = {};
			var i = 0;
			$.each($("polygon"),function(key,val){
                var kode = $(this).attr("kode");
                var keterangan = $(this).attr("keterangan");
                var icd10 = $(this).attr("icd10");
                var icd10_keterangan = $(this).attr("icd10_keterangan");
                var nomor = $(this).attr("nomor");
                if (kode!=undefined){
                    var itemData = {no_reg:no_reg,indeks:key,kode_tindakan:kode,keterangan:keterangan, icd10: icd10, icd10_keterangan: icd10_keterangan,nomor_gigi:nomor};
                    item[key] = itemData;
                }
            });
			$.ajax({
        	    url: "<?php echo site_url('assesmen/simpan_dental');?>", 
        	    type: 'POST', 
        	    data: {item:item,no_reg:no_reg},
        	    success: function(result){
        	        location.reload();
        	    },
        	    error: function(result){
        	        console.log(result);
        	    }
        	});
			// console.log(item);
		})
	});
    function tgl_indo(tgl,tipe=1){
        var date = tgl.substring(tgl.length,tgl.length-2);
        if (tipe==1)
            var bln = tgl.substring(5,7);
        else
            var bln = tgl.substring(4,6);
        var thn = tgl.substring(0,4);
        return date+"-"+bln+"-"+thn;
    }
    function getpasien_dental_detail(){
        var no_rm = $("[name='no_rm']").val();
        var no_reg = $("[name='no_reg']").val();
        var indeks = $("[name='index']").val();
        $.ajax({
            url: "<?php echo site_url('assesmen/getpasien_dental_detail');?>/"+no_reg, 
            type: 'POST', 
            data: {no_rm:no_rm,indeks:indeks},
            success: function(result){
                var result = JSON.parse(result);
                console.log(indeks);
                $.each(result,function(key,val){
                    $("[name='icd10']").val(val.icd10+" | "+val.icd10_keterangan);
                    $("[name='keterangan']").val(val.keterangan);
                    $("[name='dental']").val(val.kode_tindakan);
                });
            },
            error: function(result){
                console.log(result);
            }
        });
    }
    function getpasien(){
        var no_rm = $("[name='no_rm']").val();
        $.ajax({
            url: "<?php echo site_url('assesmen/getpasien_dental');?>", 
            type: 'POST', 
            data: {no_rm:no_rm},
            success: function(result){
                var result = JSON.parse(result);
                $.each(result,function(key1,val1){
                    $.each($("polygon"),function(key,val){
                        if (key==val1["indeks"]){
                            $(this).attr("kode",val1["kode_tindakan"]);
                            $(this).attr("keterangan",val1["keterangan"]);
                            var colors = val1["color"];
                            $(this).css("fill",colors);
                        }
                    });
                });
            },
            error: function(result){
                console.log(result);
            }
        });
    }
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
	function getdental(){
        var result = false;
        $.ajax({
            url: "<?php echo site_url('assesmen/getdental');?>", 
            type: 'POST',
            async: false, 
            success: function(data){
                var html = "<select name='dental' class='form-control'>";
                $.each(JSON.parse(data), function(key, value){
                    html += "<option value='"+value.kode+"' color='"+value.color+"'>"+value.keterangan+"</option>";
                })
                html += "</select><br>";
                html += "<p class='text-bold'>Keterangan</p><textarea name='keterangan' class='form-control'></textarea>";
                result = html;
            }
        });
        $(".listdental").html(result);
    };
    function polygon(x,y,w,h,width,height){
        var html = '';
        html += '<svg viewbox=" 0 0 '+width+' '+height+'">';
        var n = 18;
        for(i=0;i<5;i++){
            html += '<polygon nomor="'+(n-i)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n-i)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n-i)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n-i)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n-i)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n-i)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            x += (w*0.6);
        }
        n = 13;
        for(i=0;i<6;i++){
        	if (i<=2) n = 13-i; else n = 18+i;
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.35*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
        	x += (w*0.6);
        }
        n = 24;
        for(i=0;i<4;i++){
            html += '<polygon nomor="'+(n+i)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n+i)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n+i)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n+i)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n+i)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n+i)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
          	x += (w*0.6);
        }
        n = 28;
        for(i=0;i<1;i++){
        	html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+'  '+(0.35*w+x)+','+(0.15*h+y)+' '+(0.15*w+x)+','+(0.15*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	    	html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.15*w+x)+','+(0.15*h+y)+'  '+(0.15*w+x)+','+(0.35*h+y)+' '+(x)+','+(0.5*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.15*w+x)+','+(0.15*h+y)+' '+(0.15*w+x)+','+(0.35*h+y)+'  '+(0.35*w+x)+','+(0.35*h+y)+' '+(0.35*w+x)+','+(0.15*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	    	html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+'  '+(0.35*w+x)+','+(0.35*h+y)+' '+(0.35*w+x)+','+(0.15*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	    	html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.15*w+x)+','+(0.35*h+y)+'  '+(0.35*w+x)+','+(0.35*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
        }
        x = (3*w*0.6);
        y = 50; 
        for(i=0;i<2;i++){
        	if (i<2) n = 55-i;
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            x += (w*0.6);
        }
        for(i=0;i<6;i++){
        	if (i<3) n = 53-i; else n = 58+i;
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.35*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
        	x += (w*0.6);
        }
        for(i=0;i<2;i++){
        	if (i<2) n = 64+i;
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            x += (w*0.6);
        }
        x = (3*w*0.6);
        y = 100; 
        for(i=0;i<2;i++){
        	if (i<2) n = 85-i;
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            x += (w*0.6);
        }
        for(i=0;i<6;i++){
        	if (i<3) n = 83-i; else n = 68+i;
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.35*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
        	x += (w*0.6);
        }
        for(i=0;i<2;i++){
        	if (i<2) n = 74-i;
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            x += (w*0.6);
        }
        x = 0;
        y = 150;
        for(i=0;i<5;i++){
        	if (i<5) n = 48-i;
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            x += (w*0.6);
        }
        for(i=0;i<6;i++){
        	if (i<3) n = 43-i; else n = 28+i;
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.35*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	        html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+'  '+(0.35*w+x)+','+(0.25*h+y)+' '+(0.15*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
        	x += (w*0.6);
        }
        for(i=0;i<4;i++){
        	if (i<4) n = 34+i;
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.1*w+x)+','+(0.1*h+y)+' '+(0.1*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.4*w+x)+','+(0.1*h+y)+' '+(0.4*w+x)+','+(0.4*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+' '+(0.25*w+x)+','+(0.25*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
          	x += (w*0.6);
        }
        for(i=0;i<1;i++){
        	if (i<1) n = 37-i;
        	html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.5*w+x)+','+(y)+'  '+(0.35*w+x)+','+(0.15*h+y)+' '+(0.15*w+x)+','+(0.15*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	    	html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(y)+' '+(0.15*w+x)+','+(0.15*h+y)+'  '+(0.15*w+x)+','+(0.35*h+y)+' '+(x)+','+(0.5*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
            html += '<polygon nomor="'+(n)+'" points="'+(0.15*w+x)+','+(0.15*h+y)+' '+(0.15*w+x)+','+(0.35*h+y)+'  '+(0.35*w+x)+','+(0.35*h+y)+' '+(0.35*w+x)+','+(0.15*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	    	html += '<polygon nomor="'+(n)+'" points="'+(0.5*w+x)+','+(y)+' '+(0.5*w+x)+','+(0.5*h+y)+'  '+(0.35*w+x)+','+(0.35*h+y)+' '+(0.35*w+x)+','+(0.15*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
	    	html += '<polygon nomor="'+(n)+'" points="'+(x)+','+(0.5*h+y)+' '+(0.15*w+x)+','+(0.35*h+y)+'  '+(0.35*w+x)+','+(0.35*h+y)+' '+(0.5*w+x)+','+(0.5*h+y)+'" style="fill:rgb(255, 255, 255);stroke:black;stroke-width:1" />';
        }
        html += '</svg>';
        $(".polygon").html(html);
    }
</script>
<div class="modal fade modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:80%">
        <div class="modal-content">
            <div class="modal-body">
            	<div class="row no-padding">
	            	<div class="col-md-3">
		            	<input name='index' type="hidden">
                        <input name='nomor' type="hidden">
		                <p class="text-bold">Diagnosa</p>
		                <input type="text" name="icd10" class="form-control" autocomplete="off"><br>
		                <p class="text-bold">Tindakan</p>
		                <span class="listdental"></span>
		            </div>
		            <div class="col-md-9">
		            	<div class="table-responsive">
			            	<table class="table table-hover">
			            		<thead>
				            		<tr class="bg-navy">
				            			<th width="100px">Tanggal</th>
                                        <th width="80px">No. Gigi</th>
				            			<th>Diagnosa</th>
                                        <th width="20px">&nbsp;</th>
				            			<th>Tindakan</th>
				            		</tr>
				            	</thead>
				            	<tbody class="listhistory"></tbody>
			            	</table>
			            </div>
		            </div>
		        </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4">
                    <div class="row">
                        <button class="ok btn btn-success pull-left" type="button">Simpan</button>
                        <!-- <button class="hapus btn btn-danger pull-left" type="button">Hapus</button> -->
                    </div>
                </div>
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
<div class="col-md-12">
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
</div>
<div class="col-lg-9 col-md-12">
	<div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title"><p class="text-center judul">Posisi 18</p></h3></div>
		<div class="box-body">
            <div class="table-responsive">
                <div class="polygon"></div>
            </div>
        </div>
        <div class="box-footer">
        <div class="btn-group">
            <button class="back btn btn-sm btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
            <!-- <button class="btn btn-sm btn-success simpan"><i class="fa fa-save"></i>&nbsp;Simpan</button> -->
        </div>
    </div>
    </div>
</div>
<div class="col-lg-3 col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Keterangan</h3></div>
        <div class="box-body">
            <ul style="list-style:none;margin-left:-30px">
            <?php 
                foreach ($d as $value) {
                    echo "<li><span style='margin-top:2px;width:15px;height:15px;float:left;display:block;background-color:".$value->color."'></span>&nbsp;&nbsp;".$value->keterangan."</li>";
                }
            ?>
            </ul>
        </div>
	</div>
</div>