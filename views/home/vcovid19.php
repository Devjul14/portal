<script>
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
    $(document).ready(function() {
        $('.warna').each(function() {
            $('tr:odd',  this).addClass('disabled');
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".print").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var url = "<?php echo site_url('home/cetak_ralan')?>/"+tgl1+"/"+tgl2;
            openCenteredWindow(url);
        });
        $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            window.location = "<?php echo site_url("home/covid");?>/"+tgl1+"/"+tgl2;
        });
        $("tr.data").click(function(){
            $(".viewpasien").modal("show");
            $(".listpasien").html("");
            $("th.status_pulang").addClass("hide");
            $(".judulmodal").html("List Pasien Rawat Inap");
            var ruangan = $(this).attr("ruangan");
            var ruangan_a = $(this).attr("ruangan_a");
            $.ajax({
                url   : "<?php echo site_url("home/listpasieninap_covid");?>",
                type : "POST",
                data: {ruangan:ruangan,ruangan_a:ruangan_a},
                success: function(result){
                    console.log(result);
                    var echo = '';
                    var no = 1;
                    $.each(JSON.parse(result),function(key,val){
                        echo += "<tr>";
                        echo += "<td class='text-center'>"+(no++)+"</td>";
                        echo += "<td class='text-center'>"+val.no_rm+"</td>";
                        echo += "<td class='text-center'>"+val.no_reg+"</td>";
                        echo += "<td>"+val.nama_pasien+"</td>";
                        echo += "<td>"+val.jenis_kelamin+"</td>";
                        echo += "<td>"+val.nama_kelas+"</td>";
                        echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                        echo += "<td class='text-center'>"+val.no_bed+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.status_covid+"</td>";
                        echo += "</tr>";
                    });
                    $(".listpasien").html(echo);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        $("tr.data2").click(function(){
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            $(".viewpasien").modal("show");
            $(".listpasien").html("");
            $("th.status_pulang").removeClass("hide");
            $(".judulmodal").html("List Pasien Pulang Rawat Inap");
            var ruangan = $(this).attr("ruangan");
            $.ajax({
                url   : "<?php echo site_url("home/listpasieninap2_covid");?>",
                type : "POST",
                data: {ruangan:ruangan,tgl1:tgl1,tgl2:tgl2},
                success: function(result){
                    console.log(result);
                    var echo = '';
                    var no = 1;
                    $.each(JSON.parse(result),function(key,val){
                        echo += "<tr>";
                        echo += "<td class='text-center'>"+(no++)+"</td>";
                        echo += "<td class='text-center'>"+val.no_rm+"</td>";
                        echo += "<td class='text-center'>"+val.no_reg+"</td>";
                        echo += "<td>"+val.nama_pasien+"</td>";
                        echo += "<td>"+val.jenis_kelamin+"</td>";
                        echo += "<td>"+val.nama_kelas+"</td>";
                        echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                        echo += "<td class='text-center'>"+val.no_bed+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.status_pulang+"</td>";
                        echo += "<td>"+val.status_covid+"</td>";
                        echo += "</tr>";
                    });
                    $(".listpasien").html(echo);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        $("tr.data3").click(function(){
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            $(".viewpasien3").modal("show");
            $(".listpasien3").html("");
            $("th.status_pulang").removeClass("hide");
            $(".judulmodal").html("List Pasien Covid-19 Rawat Inap");
            var ruangan = $(this).attr("ruangan");
            var ruangan_a = $(this).attr("ruangan_a");
            $.ajax({
                url   : "<?php echo site_url("home/listpasieninap3_covid");?>",
                type : "POST",
                data: {ruangan:ruangan,ruangan_a:ruangan_a,tgl1:tgl1,tgl2:tgl2},
                success: function(result){
                    var data = JSON.parse(result);
                    var echo = '';
                    var no = 1;
                    var kamar = 0;
                    var bed = 0;
                    echo += '<tr class="bg-navy">'
                    echo += '<th width="10%" class="text-center" style="vertical-align:middle">No</th>';
                    echo += '<th class="text-center" style="vertical-align:middle">Kamar/ Bed</th>';
                    echo += '<th class="text-center">JK</th>';
                    echo += '<th class="text-center">Status</th>';
                    echo += '</tr>';
                    console.log(data["list"]);
                    $.each(data["kamar"],function(key,val){
                    	echo += '<tr>';
                    	echo += '<td class="text-center">'+(no++)+'</td>';
                    	echo += '<td class="text-center">'+val.kode_kamar+'/'+val.no_bed+'</td>';
                    	if (data["list"][val.kode_kamar]!=undefined){
                    		if ((data["list"][val.kode_kamar][val.no_bed]!=undefined)){
                    			echo += '<td class="text-center">'+data["list"][val.kode_kamar][val.no_bed]["jenis_kelamin"]+'</td>';
                    			echo += '<td class="text-center">'+data["list"][val.kode_kamar][val.no_bed]["status_covid"]+'</td>';
                    		}
                    		else echo += '<td class="text-center">-</td><td>-</td>';
                    	} else echo += '<td class="text-center">-</td><td>-</td>';
                        echo += "</tr>";
                    })
                    $(".listpasien3").html(echo);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
    });
</script>
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Laporan Pasien Covid-19</h3>
            <div class="pull-right">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tanggal</label>
                        <div class="col-md-3">
                                <input type="text" class="form-control" name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" autocomplete="off"/>
                        </div>
                        <div class="col-md-3">
                                <input type="text" class="form-control" name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" autocomplete="off"/>
                        </div>
                        <div class="col-md-1">
                            <div class="pull-left">
                                 <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="print btn btn-success pull-right" type = "button" ><i class="fa fa-print"></i>&nbsp;Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-navy'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">No.</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Klasifikasi</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Pelayanan</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th class="text-center">Rajal</th>
                            <th class="text-center">Ranap</th>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $baru = $lama = $reguler = $eksekutif = $dinas = $umum = $bpjs = $prsh = 0;
                            $p = array(
                                        "ODP",
                                        "PDP",
                                        "OTG",
                                        "CONFIRM",
                                        "POSITIF",
                                        "SUSPECT",
                                        "PROBLABLE",
                                        "DISCARDED",
                                        "MENINGGAL"
                                      );
                            foreach ($p as $key => $value) {
                                echo "<tr>";
                                echo "<td class='text-right'>".($i++)."</td>";
                                echo "<td>".$value."</td>";
                                echo "<td class='text-right'>".(isset($covid["RALAN"][$value]) ? $covid["RALAN"][$value] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($covid["RANAP"][$value]) ? $covid["RANAP"][$value] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($covid["DINAS"][$value]) ? $covid["DINAS"][$value] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($covid["UMUM"][$value]) ? $covid["UMUM"][$value] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($covid["BPJS"][$value]) ? $covid["BPJS"][$value] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($covid["PRSH"][$value]) ? $covid["PRSH"][$value] : 0)."</td>";
                                $jumlah = (isset($covid["RALAN"][$value]) ? $covid["RALAN"][$value] : 0)+
                                          (isset($covid["RANAP"][$value]) ? $covid["RANAP"][$value] : 0);
                                $ralan += (isset($covid["RALAN"][$value]) ? $covid["RALAN"][$value] : 0);
                                $ranap += (isset($covid["RANAP"][$value]) ? $covid["RANAP"][$value] : 0);
                                $dinas += (isset($covid["DINAS"][$value]) ? $covid["DINAS"][$value] : 0);
                                $umum += (isset($covid["UMUM"][$value]) ? $covid["UMUM"][$value] : 0);
                                $bpjs += (isset($covid["BPJS"][$value]) ? $covid["BPJS"][$value] : 0);
                                $prsh += (isset($covid["PRSH"][$value]) ? $covid["PRSH"][$value] : 0);
                                echo "<td class='text-right'>".$jumlah."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                            <th colspan="2">Jumlah Pasien</th>
                            <th class="text-right"><?php echo $ralan;?></th>
                            <th class="text-right"><?php echo $ranap;?></th>
                            <th class="text-right"><?php echo $dinas;?></th>
                            <th class="text-right"><?php echo $umum;?></th>
                            <th class="text-right"><?php echo $bpjs;?></th>
                            <th class="text-right"><?php echo $prsh;?></th>
                            <th class="text-right"><?php echo ($dinas+$umum+$bpjs+$prsh);?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Laporan Ketersediaan Bed</h3></div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="warna table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center bg-maroon" style="vertical-align: middle" rowspan="2">Ruangan</th>
                            <?php
                                $jumlah = $kelas->num_rows()-1;
                                $string = array("","Jumlah TT","Isi","Kosong","Booking");
                                $bgcolor = array("","bg-blue","bg-green","bg-orange","bg-red");
                                for($i=1;$i<$jumlah;$i++){
                                    echo "<th class='text-center ".$bgcolor[$i]."'>".$string[$i]."</th>";
                                }
                            ?>
                            <th class="text-center bg-maroon" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($rc->result() as $data){
                                echo "<tr class='data3' ruangan='".$data->kode_ruangan."' ruangan_a='".$data->kode_ruangan_a."'>";
                                echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
                                $string = array("","A","B","C","D");
                                $bgcolor = array("","bg-blue","bg-green","bg-orange","bg-red");
                                for($i=1;$i<$jumlah;$i++){
                                    echo "<th class='text-center ".$bgcolor[$i]."'>".(isset($bed[$data->kode_ruangan_a][$string[$i]]) ? $bed[$data->kode_ruangan_a][$string[$i]] : "-")."</th>";
                                    // echo "<th class='text-center ".$bgcolor[$i]."'>".(isset($bed[$data->kode_ruangan][$string[$i]]) ? $bed[$data->kode_ruangan][$string[$i]] : "-")."</th>";
                                }
                                echo "<th class='text-center'>".(isset($bed["ruang"][$data->kode_ruangan_a]) ? $bed["ruang"][$data->kode_ruangan_a] : "-")."</th>";
                                echo "</tr>";
                            }
                            echo "<tr class='bg-maroon'>";
                            echo "<th class='text-center'>JUMLAH</th>";
                            $string = array("","A","B","C","D");
                            $bgcolor = array("","#00acd6","#008d4c","#e08e0b","#d73925","#00acd6");
                            $jumlah = 0;
                            echo "<th class='text-center'>".(isset($bed["kelas"]['A']) ? $bed["kelas"]['A'] : "-")."</th>";
                            echo "<th class='text-center'>".(isset($bed["kelas"]['B']) ? $bed["kelas"]['B'] : "-")."</th>";
                            echo "<th class='text-center'>".(isset($bed["kelas"]['C']) ? $bed["kelas"]['C'] : "-")."</th>";
                            echo "<th class='text-center'>".(isset($bed["kelas"]['D']) ? $bed["kelas"]['D'] : "-")."</th>";
                            $jumlah += (isset($bed["kelas"]['A']) ? $bed["kelas"]['A'] : 0);
                            echo "<th class='text-center'>".$jumlah."</th>";
                            echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Laporan Pasien Rawat Inap</h3></div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-blue'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Ruangan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">TT</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Jaminan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">BOR</th>
                        </tr>
                        <tr class='bg-blue'>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dinas = $umum = $bpjs = $prsh = 0;
                            $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = 0;
                            foreach($rc->result() as $data){
                                    $dinas = (isset($inap["DINAS"][$data->kode_ruangan]) ? $inap["DINAS"][$data->kode_ruangan] : 0);
                                    $umum = (isset($inap["UMUM"][$data->kode_ruangan]) ? $inap["UMUM"][$data->kode_ruangan] : 0);
                                    $bpjs = (isset($inap["BPJS"][$data->kode_ruangan]) ? $inap["BPJS"][$data->kode_ruangan] : 0);
                                    $prsh = (isset($inap["PRSH"][$data->kode_ruangan]) ? $inap["PRSH"][$data->kode_ruangan] : 0);
                                    $bed = $data->bed;
                                    echo "<tr class='data' ruangan='".$data->kode_ruangan."' ruangan_a='".$data->kode_ruangan_a."'>";
                                    echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
                                    echo "<td class='text-right'>".$data->bed."</td>";
                                    echo "<td class='text-right'>".$dinas."</td>";
                                    echo "<td class='text-right'>".$umum."</td>";
                                    echo "<td class='text-right'>".$bpjs."</td>";
                                    echo "<td class='text-right'>".$prsh."</td>";
                                    echo "<td class='text-right'>".($dinas+$umum+$bpjs+$prsh)."</td>";
                                    echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    echo "</tr>";
                                    $jml_dinas += $dinas;
                                    $jml_umum += $umum;
                                    $jml_bpjs += $bpjs;
                                    $jml_prsh += $prsh;
                                    $jml_bed += $bed;
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-blue'>
                            <th>Jumlah Pasien</th>
                            <th class='text-right'><?php echo $jml_bed;?></th>
                            <th class='text-right'><?php echo $jml_dinas;?></th>
                            <th class='text-right'><?php echo $jml_umum;?></th>
                            <th class='text-right'><?php echo $jml_bpjs;?></th>
                            <th class='text-right'><?php echo $jml_prsh;?></th>
                            <th class='text-right'><?php echo ($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh);?></th>
                            <th class='text-right'><?php echo($jml_bed>0 ? number_format(($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)?> %</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Laporan Pasien Pulang Rawat Inap</h3></div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-green'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Ruangan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">TT</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Pulang Sehat</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Pulang Paksa</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Rujuk RS Lain</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Meninggal</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-green'>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dinas = array();
                            $umum = array();
                            $bpjs = array();
                            $prsh = array();
                            $status = array();
                            foreach($rc->result() as $data){
                                echo "<tr class='data2' ruangan='".$data->kode_ruangan."' ruangan_a='".$data->kode_ruangan_a."'>";
                                echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
                                echo "<td class='text-right'>".$data->bed."</td>";
                                echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan][1]) ? $inap2["DINAS"][$data->kode_ruangan][1] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan][1]) ? $inap2["UMUM"][$data->kode_ruangan][1] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan][1]) ? $inap2["BPJS"][$data->kode_ruangan][1] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan][1]) ? $inap2["PRSH"][$data->kode_ruangan][1] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan][2]) ? $inap2["DINAS"][$data->kode_ruangan][2] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan][2]) ? $inap2["UMUM"][$data->kode_ruangan][2] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan][2]) ? $inap2["BPJS"][$data->kode_ruangan][2] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan][2]) ? $inap2["PRSH"][$data->kode_ruangan][2] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan][3]) ? $inap2["DINAS"][$data->kode_ruangan][3] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan][3]) ? $inap2["UMUM"][$data->kode_ruangan][3] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan][3]) ? $inap2["BPJS"][$data->kode_ruangan][3] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan][3]) ? $inap2["PRSH"][$data->kode_ruangan][3] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan][4]) ? $inap2["DINAS"][$data->kode_ruangan][4] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan][4]) ? $inap2["UMUM"][$data->kode_ruangan][4] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan][4]) ? $inap2["BPJS"][$data->kode_ruangan][4] : 0)."</td>";
                                echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan][4]) ? $inap2["PRSH"][$data->kode_ruangan][4] : 0)."</td>";
                                $jumlah = (isset($inap2["DINAS"][$data->kode_ruangan][1]) ? $inap2["DINAS"][$data->kode_ruangan][1] : 0)
                                          +(isset($inap2["UMUM"][$data->kode_ruangan][1]) ? $inap2["UMUM"][$data->kode_ruangan][1] : 0)
                                          +(isset($inap2["BPJS"][$data->kode_ruangan][1]) ? $inap2["BPJS"][$data->kode_ruangan][1] : 0)
                                          +(isset($inap2["PRSH"][$data->kode_ruangan][1]) ? $inap2["PRSH"][$data->kode_ruangan][1] : 0)
                                          +(isset($inap2["DINAS"][$data->kode_ruangan][2]) ? $inap2["DINAS"][$data->kode_ruangan][2] : 0)
                                          +(isset($inap2["UMUM"][$data->kode_ruangan][2]) ? $inap2["UMUM"][$data->kode_ruangan][2] : 0)
                                          +(isset($inap2["BPJS"][$data->kode_ruangan][2]) ? $inap2["BPJS"][$data->kode_ruangan][2] : 0)
                                          +(isset($inap2["PRSH"][$data->kode_ruangan][2]) ? $inap2["PRSH"][$data->kode_ruangan][2] : 0)
                                          +(isset($inap2["DINAS"][$data->kode_ruangan][3]) ? $inap2["DINAS"][$data->kode_ruangan][3] : 0)
                                          +(isset($inap2["UMUM"][$data->kode_ruangan][3]) ? $inap2["UMUM"][$data->kode_ruangan][3] : 0)
                                          +(isset($inap2["BPJS"][$data->kode_ruangan][3]) ? $inap2["BPJS"][$data->kode_ruangan][3] : 0)
                                          +(isset($inap2["PRSH"][$data->kode_ruangan][3]) ? $inap2["PRSH"][$data->kode_ruangan][3] : 0)
                                          +(isset($inap2["DINAS"][$data->kode_ruangan][4]) ? $inap2["DINAS"][$data->kode_ruangan][4] : 0)
                                          +(isset($inap2["UMUM"][$data->kode_ruangan][4]) ? $inap2["UMUM"][$data->kode_ruangan][4] : 0)
                                          +(isset($inap2["BPJS"][$data->kode_ruangan][4]) ? $inap2["BPJS"][$data->kode_ruangan][4] : 0)
                                          +(isset($inap2["PRSH"][$data->kode_ruangan][4]) ? $inap2["PRSH"][$data->kode_ruangan][4] : 0);
                                echo "<td class='text-right'>".$jumlah."</td>";
                                echo "</tr>";
                                for($i=1;$i<=4;$i++){
                                    if (isset($dinas[$i]))
                                        $dinas[$i] += (isset($inap2["DINAS"][$data->kode_ruangan][$i]) ? $inap2["DINAS"][$data->kode_ruangan][$i] : 0);
                                    else
                                        $dinas[$i] = (isset($inap2["DINAS"][$data->kode_ruangan][$i]) ? $inap2["DINAS"][$data->kode_ruangan][$i] : 0);
                                    if (isset($umum[$i]))
                                        $umum[$i] += (isset($inap2["UMUM"][$data->kode_ruangan][$i]) ? $inap2["UMUM"][$data->kode_ruangan][$i] : 0);
                                    else
                                        $umum[$i] = (isset($inap2["UMUM"][$data->kode_ruangan][$i]) ? $inap2["UMUM"][$data->kode_ruangan][$i] : 0);
                                    if (isset($bpjs[$i]))
                                        $bpjs[$i] += (isset($inap2["BPJS"][$data->kode_ruangan][$i]) ? $inap2["BPJS"][$data->kode_ruangan][$i] : 0);
                                    else
                                        $bpjs[$i] = (isset($inap2["BPJS"][$data->kode_ruangan][$i]) ? $inap2["BPJS"][$data->kode_ruangan][$i] : 0);
                                    if (isset($prsh[$i]))
                                        $prsh[$i] += (isset($inap2["PRSH"][$data->kode_ruangan][$i]) ? $inap2["PRSH"][$data->kode_ruangan][$i] : 0);
                                    else
                                        $prsh[$i] = (isset($inap2["PRSH"][$data->kode_ruangan][$i]) ? $inap2["PRSH"][$data->kode_ruangan][$i] : 0);
                                }
                            }
                            echo "<tr class='bg-green'>";
                                    echo "<th>Jumlah</th>";
                                    echo "<th class='text-right'>&nbsp;</th>";
                                    echo "<th class='text-right'>".(isset($dinas[1]) ? $dinas[1] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($umum[1]) ? $umum[1] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($bpjs[1]) ? $bpjs[1] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($prsh[1]) ? $prsh[1] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($dinas[2]) ? $dinas[2] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($umum[2]) ? $umum[2] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($bpjs[2]) ? $bpjs[2] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($prsh[2]) ? $prsh[2] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($dinas[3]) ? $dinas[3] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($umum[3]) ? $umum[3] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($bpjs[3]) ? $bpjs[3] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($prsh[3]) ? $prsh[3] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($dinas[4]) ? $dinas[4] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($umum[4]) ? $umum[4] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($bpjs[4]) ? $bpjs[4] : 0)."</th>";
                                    echo "<th class='text-right'>".(isset($prsh[4]) ? $prsh[4] : 0)."</th>";
                                    $jumlah = (isset($dinas[1]) ? $dinas[1] : 0)+
                                              (isset($umum[1]) ? $umum[1] : 0)+
                                              (isset($bpjs[1]) ? $bpjs[1] : 0)+
                                              (isset($prsh[1]) ? $prsh[1] : 0)+
                                              (isset($dinas[2]) ? $dinas[2] : 0)+
                                              (isset($umum[2]) ? $umum[2] : 0)+
                                              (isset($bpjs[2]) ? $bpjs[2] : 0)+
                                              (isset($prsh[2]) ? $prsh[2] : 0)+
                                              (isset($dinas[3]) ? $dinas[3] : 0)+
                                              (isset($umum[3]) ? $umum[3] : 0)+
                                              (isset($bpjs[3]) ? $bpjs[3] : 0)+
                                              (isset($prsh[3]) ? $prsh[3] : 0)+
                                              (isset($dinas[4]) ? $dinas[4] : 0)+
                                              (isset($umum[4]) ? $umum[4] : 0)+
                                              (isset($bpjs[4]) ? $bpjs[4] : 0)+
                                              (isset($prsh[4]) ? $prsh[4] : 0);
                                    echo "<th class='text-right'>".$jumlah."</th>";
                                    echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Laporan Swab/ PCR</h3></div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped" width="2000px">
                    <thead>
                        <tr class='bg-navy'>
                        	<th class="text-center" style="vertical-align: middle" rowspan="2">No</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">No RM</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">No Reg</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Nama Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Hari Rawat</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Ruangan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Status</th>
                            <?php
                            	for($i=1;$i<=5;$i++){
                            		echo '<th class="text-center" style="vertical-align: middle" colspan="2">Swab '.$i.'</th>';
                            	}
                            ?>
                        </tr>
                        <tr class='bg-navy'>
                        	<?php
                            	for($i=1;$i<=5;$i++){
                            		echo '<th class="text-center" style="vertical-align: middle">Tanggal</th>';
                            		echo '<th class="text-center" style="vertical-align: middle">Hasil</th>';
                            	}
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        	$n = 1;
                            // echo json_encode($swab["list"]);
                            foreach ($swab["pasien"] as $key => $row) {
                            	$tgl1 = new DateTime($row->tgl_masuk);
                            	$tgl2 = new DateTime(date("Y-m-d"));
							    $rawat = $tgl2->diff($tgl1)->days+1;
                            	echo "<tr>";
                            	echo "<td>".($n++)."</td>";
                            	echo "<td>".$row->no_rm."</td>";
                            	echo "<td>".$row->no_reg."</td>";
                            	echo "<td>".$row->nama_pasien."</td>";
                              echo "<td>".$row->gol_ket."</td>";
                            	echo "<td class='text-center'>".$rawat."</td>";
                              echo "<td>".$row->nama_ruangan."</td>";
                              echo "<td>".$row->status."</td>";
                            	for($i=0;$i<5;$i++){
                            		if (isset($swab["list"][$row->no_reg][$i])){
                            			$r = $swab["list"][$row->no_reg][$i];
                            			$tanggal = date("d-m-Y",strtotime($r->tanggal));
                            			$hasil = $r->hasil;
                            		} else {
                            			$tanggal = $hasil = "";
                            		}
                            		echo '<td class="text-center" style="vertical-align: middle">'.$tanggal.'</td>';
                            		echo '<td class="text-center" style="vertical-align: middle">'.$hasil.'</td>';
                            	}
                            	echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class='modal viewpasien'>
    <div class='modal-dialog' style="width:80%">
        <div class='modal-content'>
            <div class="modal-header bg-red"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;<span class="judulmodal"></span></h4></div>
            <div class='modal-body'>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover " id="myTable">
                        <thead>
                            <tr class="bg-navy">
                                <th width="10%" class='text-center'>No</th>
                                <th width="10%" class='text-center'>Nomor RM</th>
                                <th class='text-center'>Nomor REG</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">JK</th>
                                <th class='text-center'>Kelas</th>
                                <th width="10%" class='text-center'>Kamar</th>
                                <th width="10%" class='text-center'>No. Bed</th>
                                <th class='text-center'>Golongan Pasien</th>
                                <th class='text-center status_pulang'>Status Pulang</th>
                                <th class='text-center'>Status Covid</th>
                            </tr>
                        </thead>
                        <tbody class="listpasien"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal viewpasien3'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-red"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;<span class="judulmodal"></span></h4></div>
            <div class='modal-body'>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover " id="myTable">
                        <tbody class="listpasien3"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
