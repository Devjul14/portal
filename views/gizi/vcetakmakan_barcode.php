<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
<script src="<?php echo base_url();?>js/jquery.js"></script>
<script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
<?php
    $content = "";
    // $content .= '<tr><td style="font-family: arial;">No.RM</td><td style="font-family: arial;font-size:14px">'.$q1->no_rm.'</td></tr>';
    // $content .= '<tr><td style="font-family: arial;" colspan="2">'.($q1->nama_pasien=="" ? "" : substr($q1->nama_pasien, 0,21)).'</td></tr>';
    // $content .= '<tr><td style="font-family: arial;">'.($q1->jenis_kelamin=="L" ? "LAKI-LAKI" : "PEREMPUAN").'</td><td style="font-family: arial;">'.date("d-m-Y",strtotime($q1->tgl_lahir)).'</td></tr>';
    // $content .= '<tr><td style="font-family: arial;">'.$q1->ruangan.'</td><td style="font-family: arial;">'.$q1->kelas.' ['.$q1->kode_kamar.'/'.$q1->no_bed.']</td></tr>';
    $content .= '<tr><td style="vertical-align:top;align:left;float:left" colspan="2"><span class="barcode" id="barcode"></span></td></tr>';
    // 
?>
<?php
	$no_reg = '';
	$koma = '';
    foreach($q->result() as $data){
    	$no_reg .=$koma.$data->no_reg;
    	$koma = ',';

        // echo "<input type='hidden' name='no_reg' class='text-center' value=".$data->no_reg."></td>";
		
        // echo "   <section class='invoice no-border hide' id='invoice'> ";
        // echo "        <div style='width:16cm;height:3cm;display: block;'>";
        echo "            <div style='float: left;width:7cm; margin-left:0.5cm; display: block; margin-top:7px';>";
        echo "                <table cellspacing='1' cellpadding='1' width='100%' style='font-size:11px;'>";
        echo "                    <tbody class='konten_print'> ";
        echo "		<tr><td style='font-family: arial;'>No.RM</td><td style='font-family: arial;font-size:15px'>".$data->no_rm."</td></tr>";
        echo "  <tr><td style='font-family: arial; font-size:13;' colspan='2'>".($data->nama_pasien=='' ? '' : substr($data->nama_pasien, 0,21))."</td></tr>";
		echo " <tr><td style='font-family: arial;'>".($data->jenis_kelamin=='L' ? 'LAKI-LAKI' : 'PEREMPUAN')."</td><td style='font-family: arial;'>".date('d-m-Y',strtotime($data->tgl_lahir))."</td></tr> ";
		echo " <tr><td style='font-family: arial; font-size:13px;'>".$data->nama_ruangan."</td><td style='font-family: arial;'>".$data->nama_kelas." <span style='font-size:15px'>[".$data->kode_kamar."/".$data->no_bed."]</span></td></tr> ";
		echo " <tr><td style='vertical-align:top;align:left;float:left; margin-bottom:7px;'><span class='barcode' id='barcode'></span></td><td style='font-family: arial; font-size:14px;'><font style='letter-spacing:2px;font-size:16px'>".$data->diet."</font><font style='letter-spacing:2px;font-size:16px'> ".$data->menu."</font></td></tr>";
        echo "						</tbody>";
        echo "                </table>";
        echo "            </div>";
  //       echo "            <div style='float: left;width:7cm;margin-left:1cm;display: block;'>";
  //       echo "                <table cellspacing='1' cellpadding='1' width='100%' style='font-size:11px;'>";
  //       echo "                    <tbody class='konten_print'> ";
  //       echo "		<tr><td style='font-family: arial;'>No.RM</td><td style='font-family: arial;font-size:14px'>".$data->no_rm."</td></tr>";
  //       echo "  <tr><td style='font-family: arial;' colspan='2'>".($data->nama_pasien=='' ? '' : substr($data->nama_pasien, 0,21))."</td></tr>";
		// echo " <tr><td style='font-family: arial;'>".($data->jenis_kelamin=='L' ? 'LAKI-LAKI' : 'PEREMPUAN')."</td><td style='font-family: arial;'>".date('d-m-Y',strtotime($data->tgl_lahir))."</td></tr> ";
		// echo " <tr><td style='font-family: arial;'>".$data->nama_ruangan."</td><td style='font-family: arial;'>".$data->nama_kelas." [".$data->kode_kamar."/".$data->no_bed."]</td></tr> ";
		// echo " <tr><td style='vertical-align:top;align:left;float:left'><span class='barcode' id='barcode'></span></td><td style='font-family: arial; font-size:14px;'><font color='red';>".$data->diet."</font><font color='green'> ".$data->menu."</font></td></tr>";
  //       echo " </tbody>";
  //       echo "                </table>";
  //       echo "            </div>";
        // echo "        </div>";
        // echo"<script type='text/javascript'>";
        // echo"$(document).ready(function(){";
        // echo"    var no_reg =  $data->no_reg";
            // $(".barcode").barcode(no_reg.substring(no_reg.length - 6, no_reg.length),"code128",{fontSize: 12,showHRI: true,marginHRI: 0,barHeight:40,barWidth: 1, moduleSize: 5});
        // echo"    $('.barcode').barcode(no_reg,'code128',{fontSize: 15,showHRI: true,marginHRI: 0,barHeight:28,barWidth: 1, moduleSize: 5});";
        // echo"    window.print();";
            // window.close();
        // echo "})";
        // echo"</script>";
        }    
        echo "<input type='hidden' name='no_reg' class='text-center' value=".$no_reg."></td>";
?>
    
</section>
<script type="text/javascript">
    $(document).ready(function(){

        var no_reg =  $("[name='no_reg']").val();
        var no = no_reg.split(",");
        // var noa = no[0] ;
        // alert(no[]);
        // .each(no, function(key, value) { 
        // 	alert(no[key]);
		// });
		// $.each(no, function() {
		//     alert(no);
		// });
		// $('[name = "no_reg"]').each(function (index, value) {
		// 	console.log('no_reg' + index + ':' + $(this).attr('id'));
		// 	});
   //      	$("[name = 'no_reg']").each(no_reg, function() {
		 //    	alert(no_reg);
        for(var i = 0; i < no.length; i++){

        	$(".barcode").barcode(no[i],"code128",{fontSize: 15,showHRI: true,marginHRI: 0,barHeight:28,barWidth: 1, moduleSize: 5});
            // var t = "<input type = 'text' value ='"+no[i]+"'>";
            // $(".barcode").html(t);
            // alert(no[i]);
            // document.write("<p>" + no[i] + "</p>");
        }
			// });

        window.print();



// var data = [ 
// 		 {"Id": 10004, "PageName": "club"}, 
// 		 {"Id": 10040, "PageName": "qaz"}, 
// 		 {"Id": 10059, "PageName": "jjjjjjj"}
// 		];

		// $.ex
		// $.each(data, function(i, item) {
		//     alert(item.PageName);
		// });
        // alert(no_reg);
        // $(".barcode").barcode(no_reg.substring(no_reg.length - 6, no_reg.length),"code128",{fontSize: 12,showHRI: true,marginHRI: 0,barHeight:40,barWidth: 1, moduleSize: 5});
        // window.close();
    })
</script>
<style type="text/css">
    html, body {
        width: 16cm; 
        height: 3cm;
        display: block;
        margin-left: 0.3cm;
        margin-top: -0.1cm;
    }
    td {
        font-size: 12px;
        font-weight: bold;
        word-spacing: 0.05cm;
    }
    th {
        font-size: 12px;
        font-weight: bold;
        word-spacing: 0.05cm;
    }
    @page {
      /*size: 16cm 3cm;
        margin-left: 0.3cm;*/
    }
    .barcode > div{
        font-family: arial;
        margin-top: 0px;
        line-height: 23px;
        float: center;
    }
</style>