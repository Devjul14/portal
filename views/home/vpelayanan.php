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
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var kode = dataText.attr('no_reg');
            var dataContent = dataText.text().trim();
            var jenis;
            if (dataText.hasClass("koding")){
                jenis = "koding";
            } else
            if (dataText.hasClass("billing")){
                jenis = "billing";
            }
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control '+jenis+'" />');
            dataText.before(dataInputField).hide();
            dataInputField.mask('000.000.000', {reverse: true});
            dataInputField.select();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val().replace(/\D/g,'');
                changeData(inputval,kode,jenis);
                $(this).remove();
                dateText.show();
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val().replace(/\D/g,'');
                    changeData(inputval,kode,jenis);
                    $(this).remove();
                    dateText.show();
                }
            });
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
            window.location = "<?php echo site_url("home/pelayanan");?>/"+tgl1+"/"+tgl2;
        });
        $("tr.data").click(function(){
            $(".viewpasien").modal("show");
            $(".listpasien").html("");
            $("th.status_pulang").addClass("hide");
            $(".judulmodal").html("List Pasien Rawat Inap");
            var ruangan = $(this).attr("ruangan");
            $.ajax({
                url   : "<?php echo site_url("home/listpasieninap");?>",
                type : "POST",
                data: {ruangan:ruangan},
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
                        echo += "<td>"+val.nama_kelas+"</td>";
                        echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                        echo += "<td class='text-center'>"+val.no_bed+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.hp+"</td>";
                        echo += "</tr>";
                    });
                    $(".listpasien").html(echo);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        $("tr.data_kelas").click(function(){
            $(".viewpasien").modal("show");
            $(".listpasien").html("");
            $("th.status_pulang").addClass("hide");
            $(".judulmodal").html("List Pasien Rawat Inap Berdasarkan Kelas");
            var kelas = $(this).attr("kelas");
            $.ajax({
                url   : "<?php echo site_url("home/listpasieninap_kelas");?>",
                type : "POST",
                data: {kelas:kelas},
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
                        echo += "<td>"+val.nama_kelas+"</td>";
                        echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                        echo += "<td class='text-center'>"+val.no_bed+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.hp+"</td>";
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
                url   : "<?php echo site_url("home/listpasieninap2");?>",
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
                        echo += "<td>"+val.nama_kelas+"</td>";
                        echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                        echo += "<td class='text-center'>"+val.no_bed+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.status_pulang+"</td>";
                        echo += "<td>"+val.hp+"</td>";
                        echo += "</tr>";
                    });
                    $(".listpasien").html(echo);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        $("tr.data2_kelas").click(function(){
            var tgl1 = $("[name='tgl1']").val();
            var tgl2 = $("[name='tgl2']").val();
            $(".viewpasien").modal("show");
            $(".listpasien").html("");
            $("th.status_pulang").removeClass("hide");
            $(".judulmodal").html("List Pasien Pulang Rawat Inap Berdasarkan Kelas");
            var kelas = $(this).attr("kelas");
            $.ajax({
                url   : "<?php echo site_url("home/listpasieninap2_kelas");?>",
                type : "POST",
                data: {kelas:kelas,tgl1:tgl1,tgl2:tgl2},
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
                        echo += "<td>"+val.nama_kelas+"</td>";
                        echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                        echo += "<td class='text-center'>"+val.no_bed+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.status_pulang+"</td>";
                        echo += "<td>"+val.hp+"</td>";
                        echo += "</tr>";
                    });
                    $(".listpasien").html(echo);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
    });
    var changeData = function(value,id,jenis){
        $.ajax({
            url: "<?php echo site_url('home/changedata_simulasi');?>",
            type: 'POST',
            data: {no_reg: id,value: value, jenis: jenis},
            success: function(){
                location.reload();
            },
            error: function(data){
                console.log(data);
            }
        });
    };
</script>
<div class="col-sm-12">
    <!-- <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Laporan Pasien Rawat Jalan</h3>
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
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Poliklinik</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Jenis</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th class="text-center">Baru</th>
                            <th class="text-center">Lama</th>
                            <th class="text-center">Reguler</th>
                            <th class="text-center">Eksekutif</th>
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
                            foreach($p->result() as $data){
                                if ($data->kode!="0102030"){
                                    echo "<tr>";
                                    echo "<td class='text-right'>".($i++)."</td>";
                                    echo "<td>".$data->keterangan."</td>";
                                    echo "<td class='text-right'>".(isset($poli["BARU"][$data->kode]) ? $poli["BARU"][$data->kode] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($poli["LAMA"][$data->kode]) ? $poli["LAMA"][$data->kode] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($poli["REGULER"][$data->kode]) ? $poli["REGULER"][$data->kode] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($poli["EKSEKUTIF"][$data->kode]) ? $poli["EKSEKUTIF"][$data->kode] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($poli["DINAS"][$data->kode]) ? $poli["DINAS"][$data->kode] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($poli["UMUM"][$data->kode]) ? $poli["UMUM"][$data->kode] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($poli["BPJS"][$data->kode]) ? $poli["BPJS"][$data->kode] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($poli["PRSH"][$data->kode]) ? $poli["PRSH"][$data->kode] : 0)."</td>";
                                    $jumlah = (isset($poli["DINAS"][$data->kode]) ? $poli["DINAS"][$data->kode] : 0)+
                                              (isset($poli["UMUM"][$data->kode]) ? $poli["UMUM"][$data->kode] : 0)+
                                              (isset($poli["BPJS"][$data->kode]) ? $poli["BPJS"][$data->kode] : 0)+
                                              (isset($poli["PRSH"][$data->kode]) ? $poli["PRSH"][$data->kode] : 0);
                                    $baru += (isset($poli["BARU"][$data->kode]) ? $poli["BARU"][$data->kode] : 0);
                                    $lama += (isset($poli["LAMA"][$data->kode]) ? $poli["LAMA"][$data->kode] : 0);
                                    $reguler += (isset($poli["REGULER"][$data->kode]) ? $poli["REGULER"][$data->kode] : 0);
                                    $eksekutif += (isset($poli["EKSEKUTIF"][$data->kode]) ? $poli["EKSEKUTIF"][$data->kode] : 0);
                                    $dinas += (isset($poli["DINAS"][$data->kode]) ? $poli["DINAS"][$data->kode] : 0);
                                    $umum += (isset($poli["UMUM"][$data->kode]) ? $poli["UMUM"][$data->kode] : 0);
                                    $bpjs += (isset($poli["BPJS"][$data->kode]) ? $poli["BPJS"][$data->kode] : 0);
                                    $prsh += (isset($poli["PRSH"][$data->kode]) ? $poli["PRSH"][$data->kode] : 0);
                                    echo "<td class='text-right'>".$jumlah."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                            <th colspan="2">Jumlah Pasien</th>
                            <th class="text-right"><?php echo $baru;?></th>
                            <th class="text-right"><?php echo $lama;?></th>
                            <th class="text-right"><?php echo $reguler;?></th>
                            <th class="text-right"><?php echo $eksekutif;?></th>
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
    </div> -->
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Laporan Ketersediaan Bed</h3></div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="warna table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center bg-maroon" style="vertical-align: middle" rowspan="2">Ruangan</th>
                            <?php
                                $i = 1;
                                foreach ($kelas->result() as $key) {
                                    echo "<th class='text-center bg-maroon' ".($i%2>0 ? "style='opacity:.75'" : "")." colspan='4'>".str_replace("_", " ", strtoupper($key->kode_kelas_dashboard))."</th>";
                                    $i++;
                                }
                            ?>
                            <th class="text-center bg-maroon" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr>
                            <?php
                                $jumlah = $kelas->num_rows()-1;
                                $string = array("","A","B","C","D");
                                $bgcolor = array("","bg-blue","bg-green","bg-orange","bg-red");
                                foreach ($kelas->result() as $key) {
                                    for($i=1;$i<$jumlah;$i++){
                                        echo "<th class='text-center ".$bgcolor[$i]."'>".$string[$i]."</th>";
                                    }
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($r->result() as $data){
                              if($data->kode_ruangan!=19){
                                echo "<tr>";
                                echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
                                $string = array("","A","B","C","D");
                                $bgcolor = array("","#00acd6","#008d4c","#e08e0b","#d73925","#00acd6");
                                foreach ($kelas->result() as $key) {
                                    for($i=1;$i<$jumlah;$i++){
                                        echo "<th class='text-center'>".(isset($bed[$data->kode_ruangan_a][$key->kode_kelas_dashboard][$string[$i]]) ? $bed[$data->kode_ruangan_a][$key->kode_kelas_dashboard][$string[$i]] : "-")."</th>";
                                    }
                                }
                                echo "<th class='text-center'>".(isset($bed["ruang"][$data->kode_ruangan_a]) ? $bed["ruang"][$data->kode_ruangan_a] : "-")."</th>";
                                echo "</tr>";
                              }
                            }
                            echo "<tr class='bg-maroon'>";
                            echo "<th class='text-center'>JUMLAH</th>";
                            $string = array("","A","B","C","D");
                            $bgcolor = array("","#00acd6","#008d4c","#e08e0b","#d73925","#00acd6");
                            $jumlah = 0;
                            foreach ($kelas->result() as $key) {
                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['A']) ? $bed["kelas"][$key->kode_kelas_dashboard]['A'] : "-")."</th>";
                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['B']) ? $bed["kelas"][$key->kode_kelas_dashboard]['B'] : "-")."</th>";
                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['C']) ? $bed["kelas"][$key->kode_kelas_dashboard]['C'] : "-")."</th>";
                                echo "<th class='text-center'>".(isset($bed["kelas"][$key->kode_kelas_dashboard]['D']) ? $bed["kelas"][$key->kode_kelas_dashboard]['D'] : "-")."</th>";
                                $jumlah += (isset($bed["kelas"][$key->kode_kelas_dashboard]['A']) ? $bed["kelas"][$key->kode_kelas_dashboard]['A'] : 0);
                            }
                            echo "<th class='text-center'>".$jumlah."</th>";
                            echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-3">
                    <p class='btn btn-primary btn-flat btn-block text-bold'>A : Jumlah TT</p>
            </div>
            <div class="col-sm-3">
                <p class='btn btn-success btn-flat btn-block text-bold'>B : Jumlah Kamar Isi</p>
            </div>
            <div class="col-sm-3">
                <p class='btn bg-orange btn-flat btn-block text-bold'>C : Jumlah Kamar Kosong</p>
            </div>
            <div class="col-sm-3">
                <p class='btn btn-danger btn-flat btn-block text-bold'>D : Jumlah Kamar Booking</p>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Laporan Pasien Rawat Inap</h3>
            <!-- <div class="pull-right">
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
            </div> -->
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-blue'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Ruangan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">TT</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Jaminan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Hari Perawatan</th>
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
                            $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = $jlm_hp = 0;
                            foreach($r->result() as $data){
                                if ($data->kode_ruangan!=19){
                                    $dinas = (isset($inap["DINAS"][$data->kode_ruangan_a]) ? $inap["DINAS"][$data->kode_ruangan_a] : 0);
                                    $umum = (isset($inap["UMUM"][$data->kode_ruangan_a]) ? $inap["UMUM"][$data->kode_ruangan_a] : 0);
                                    $bpjs = (isset($inap["BPJS"][$data->kode_ruangan_a]) ? $inap["BPJS"][$data->kode_ruangan_a] : 0);
                                    $prsh = (isset($inap["PRSH"][$data->kode_ruangan_a]) ? $inap["PRSH"][$data->kode_ruangan_a] : 0);
                                    $bed = $data->bed;
                                    echo "<tr class='data' ruangan='".$data->kode_ruangan_a."'>";
                                    echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
                                    echo "<td class='text-right'>".$data->bed."</td>";
                                    echo "<td class='text-right'>".$dinas."</td>";
                                    echo "<td class='text-right'>".$umum."</td>";
                                    echo "<td class='text-right'>".$bpjs."</td>";
                                    echo "<td class='text-right'>".$prsh."</td>";
                                    echo "<td class='text-right'>".($dinas+$umum+$bpjs+$prsh)."</td>";
                                    echo "<td class='text-right'>".$inap["HP"][$data->kode_ruangan_a]."</td>";
                                    echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    echo "</tr>";
                                    $jml_dinas += $dinas;
                                    $jml_umum += $umum;
                                    $jml_bpjs += $bpjs;
                                    $jml_prsh += $prsh;
                                    $jml_bed += $bed;
                                    $jml_hp += (isset($inap["HP"][$data->kode_ruangan_a]) ? $inap["HP"][$data->kode_ruangan_a] : 0);
                                }
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
                            <th class='text-right'><?php echo $jml_hp;?></th>
                            <th class='text-right'><?php echo($jml_bed>0 ? number_format(($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)?> %</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Laporan Pasien Rawat Inap Berdasarkan Kelas</h3>
            <!-- <div class="pull-right">
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
            </div> -->
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-orange'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Kelas</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">TT</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Jaminan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Hari Perawatan</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">BOR</th>
                        </tr>
                        <tr class='bg-orange'>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dinas = $umum = $bpjs = $prsh = 0;
                            $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = $jlm_hp = 0;
                            foreach($kls_tt->result() as $key){
                                    $bed = $key->bed;
                                    $dinas = (isset($inap_kelas["DINAS"][$key->kode_kelas_dashboard]) ? $inap_kelas["DINAS"][$key->kode_kelas_dashboard] : 0);
                                    $umum = (isset($inap_kelas["UMUM"][$key->kode_kelas_dashboard]) ? $inap_kelas["UMUM"][$key->kode_kelas_dashboard] : 0);
                                    $bpjs = (isset($inap_kelas["BPJS"][$key->kode_kelas_dashboard]) ? $inap_kelas["BPJS"][$key->kode_kelas_dashboard] : 0);
                                    $prsh = (isset($inap_kelas["PRSH"][$key->kode_kelas_dashboard]) ? $inap_kelas["PRSH"][$key->kode_kelas_dashboard] : 0);
                                    echo "<tr class='data_kelas' kelas='".$key->kode_kelas_dashboard."'>";
                                    echo "<td class='text-center'>".str_replace("_", " ", strtoupper($key->kode_kelas_dashboard))."</td>";
                                    echo "<td class='text-right'>".$key->bed."</td>";
                                    echo "<td class='text-right'>".$dinas."</td>";
                                    echo "<td class='text-right'>".$umum."</td>";
                                    echo "<td class='text-right'>".$bpjs."</td>";
                                    echo "<td class='text-right'>".$prsh."</td>";
                                    echo "<td class='text-right'>".($dinas+$umum+$bpjs+$prsh)."</td>";
                                    echo "<td class='text-right'>".$inap_kelas["HP"][$key->kode_kelas_dashboard]."</td>";
                                    echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    // echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    echo "</tr>";
                                    $total += $key->bed;
                                    $jml_dinas += $dinas;
                                    $jml_umum += $umum;
                                    $jml_bpjs += $bpjs;
                                    $jml_prsh += $prsh;
                                    $jml_bed += $bed;
                                    $jml_hp += (isset($inap_kelas["HP"][$data->kode_kelas_dashboard]) ? $inap_kelas["HP"][$data->kode_kelas_dashboard] : 0);
                                // }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-orange'>
                            <th>Jumlah Pasien</th>
                            <th class='text-right'><?php echo $total;?></th>
                            <th class='text-right'><?php echo $jml_dinas;?></th>
                            <th class='text-right'><?php echo $jml_umum;?></th>
                            <th class='text-right'><?php echo $jml_bpjs;?></th>
                            <th class='text-right'><?php echo $jml_prsh;?></th>
                            <th class='text-right'><?php echo ($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh);?></th>
                            <th class='text-right'><?php echo $jml_hp;?></th>
                            <th class='text-right'><?php echo($jml_bed>0 ? number_format(($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)?> %</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Laporan Anggota Keluarga Denkes & Rumkit Yang Dirawat</h3>
            <!-- <div class="pull-right">
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
            </div> -->
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-orange'>
                            <th class="text-center">No</th>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Kamar</th>
                            <th class="text-center">RM</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">JK</th>
                            <th class="text-center">Umur</th>
                            <th class="text-center">Hubungan Keluarga</th>
                            <th class="text-center">Pangkat</th>
                            <th class="text-center">Kesatuan</th>
                            <th class="text-center">Diagnosa Medis</th>
                            <th class="text-center">Dokter</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // $dinas = $umum = $bpjs = $prsh = 0;
                            // $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = $jlm_hp = 0;
                            $no = 1;
                            foreach($inap_denkes['list'] as $key){
                                    // $bed = $key->bed;
                                    // $dinas = (isset($inap_kelas["DINAS"][$key->kode_kelas_dashboard]) ? $inap_kelas["DINAS"][$key->kode_kelas_dashboard] : 0);
                                    // $umum = (isset($inap_kelas["UMUM"][$key->kode_kelas_dashboard]) ? $inap_kelas["UMUM"][$key->kode_kelas_dashboard] : 0);
                                    // $bpjs = (isset($inap_kelas["BPJS"][$key->kode_kelas_dashboard]) ? $inap_kelas["BPJS"][$key->kode_kelas_dashboard] : 0);
                                    // $prsh = (isset($inap_kelas["PRSH"][$key->kode_kelas_dashboard]) ? $inap_kelas["PRSH"][$key->kode_kelas_dashboard] : 0);
                                    echo "<tr>";
                                    $kamar = ($inap_denkes["kamar"][$key->no_reg]);
                                    $pangkat = ($inap_denkes["pangkat"][$key->no_reg]);
                                    $diagnosa_medis = ($inap_denkes["diagnosa_medis"][$key->no_reg]);
                                    $diagnosa_medis_2 = ($inap_denkes["diagnosa_medis_2"][$key->no_reg]);
                                    $id_dokter = ($inap_denkes["id_dokter"][$key->no_reg]);
                                    echo "<td class='text-center'>".$no++."</td>";
                                    echo "<td >".str_replace("ISOLASI", "", $key->ruangan)."</td>";
                                    echo "<td class='text-center'>".$kamar->nama_kamar." ".$kamar->no_bed."</td>";
                                    echo "<td class='text-center'>".$key->no_rm."</td>";
                                    echo "<td >".$key->nama_pasien."</td>";
                                    echo "<td class='text-center'>".$key->jenis_kelamin."</td>";
                                    echo "<td class='text-center'>".(date("Y") - date("Y",strtotime($key->tahun)))."th"."</td>";
                                    echo "<td class='text-center'>".($key->hubungan_keluarga == "1" ? "PS" : "").($key->hubungan_keluarga == "2" ? "AD Ayah ".$key->nama_pasangan." Ibu ".$key->ibu : "").($key->hubungan_keluarga == "3" ?"S/I D ".$key->nama_pasangan : "")."</td>";
                                    echo "<td class='text-center'>".$pangkat->keterangan." ".$key->nip."</td>";
                                    echo "<td class='text-left'>".substr($key->alamat,0,25)."</td>";
                                    echo "<td class='text-center'>".($diagnosa_medis->a == ""? $diagnosa_medis_2->diagnosa_akhir : $diagnosa_medis->a)."</td>";
                                    if ($key->masuk == "IGD" || $key->masuk == "UGD") {
                                        echo "<td >". $id_dokter->nama_dokter."</td>";
                                    }else{
                                        echo "<td >".$key->nama_dokter."</td>";
                                    }
                                    // echo "<td class='text-center'>".$dokter->dokter."</td>";
                                    // echo "<td class='text-right'>".$dinas."</td>";
                                    // echo "<td class='text-right'>".$umum."</td>";
                                    // echo "<td class='text-right'>".$bpjs."</td>";
                                    // echo "<td class='text-right'>".$prsh."</td>";
                                    // echo "<td class='text-right'>".($dinas+$umum+$bpjs+$prsh)."</td>";
                                    // echo "<td class='text-right'>".$inap_kelas["HP"][$key->kode_kelas_dashboard]."</td>";
                                    // echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    // echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    echo "</tr>";
                                    // $total += $key->bed;
                                    // $jml_dinas += $dinas;
                                    // $jml_umum += $umum;
                                    // $jml_bpjs += $bpjs;
                                    // $jml_prsh += $prsh;
                                    // $jml_bed += $bed;
                                    // $jml_hp += (isset($inap_kelas["HP"][$data->kode_kelas_dashboard]) ? $inap_kelas["HP"][$data->kode_kelas_dashboard] : 0);
                                // }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-orange'>
                            <!-- <th>Jumlah Pasien</th>
                            <th class='text-right'><?php echo $total;?></th>
                            <th class='text-right'><?php echo $jml_dinas;?></th>
                            <th class='text-right'><?php echo $jml_umum;?></th>
                            <th class='text-right'><?php echo $jml_bpjs;?></th>
                            <th class='text-right'><?php echo $jml_prsh;?></th>
                            <th class='text-right'><?php echo ($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh);?></th>
                            <th class='text-right'><?php echo $jml_hp;?></th>
                            <th class='text-right'><?php echo($jml_bed>0 ? number_format(($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)?> %</th> -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Laporan Penderita Dinas Keluarga TNI Lain Yang Dirawat</h3>
            <!-- <div class="pull-right">
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
            </div> -->
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-orange'>
                            <th class="text-center">No</th>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Kamar</th>
                            <th class="text-center">RM</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">JK</th>
                            <th class="text-center">Umur</th>
                            <th class="text-center">Hubungan Keluarga</th>
                            <th class="text-center">Pangkat</th>
                            <th class="text-center">Kesatuan</th>
                            <th class="text-center">Diagnosa Medis</th>
                            <th class="text-center">Dokter</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // $dinas = $umum = $bpjs = $prsh = 0;
                            // $jml_dinas = $jml_umum = $jml_bpjs = $jml_prsh = $jml_bed = $jlm_hp = 0;
                            $no = 1;
                            foreach($inap_nondenkes['list'] as $key){
                                    // $bed = $key->bed;
                                    // $dinas = (isset($inap_kelas["DINAS"][$key->kode_kelas_dashboard]) ? $inap_kelas["DINAS"][$key->kode_kelas_dashboard] : 0);
                                    // $umum = (isset($inap_kelas["UMUM"][$key->kode_kelas_dashboard]) ? $inap_kelas["UMUM"][$key->kode_kelas_dashboard] : 0);
                                    // $bpjs = (isset($inap_kelas["BPJS"][$key->kode_kelas_dashboard]) ? $inap_kelas["BPJS"][$key->kode_kelas_dashboard] : 0);
                                    // $prsh = (isset($inap_kelas["PRSH"][$key->kode_kelas_dashboard]) ? $inap_kelas["PRSH"][$key->kode_kelas_dashboard] : 0);
                                    if (!isset($inap_denkes['list'][$key->no_reg])){
                                    echo "<tr>";
                                    $kamar = ($inap_nondenkes["kamar"][$key->no_reg]);
                                    $pangkat = ($inap_nondenkes["pangkat"][$key->no_reg]);
                                    $diagnosa_medis = ($inap_nondenkes["diagnosa_medis"][$key->no_reg]);
                                    $diagnosa_medis_2 = ($inap_nondenkes["diagnosa_medis_2"][$key->no_reg]);
                                    $id_dokter = ($inap_nondenkes["id_dokter"][$key->no_reg]);
                                    echo "<td class='text-center'>".$no++."</td>";
                                    echo "<td >".str_replace("ISOLASI", "", $key->ruangan)."</td>";
                                    echo "<td class='text-center'>".$kamar->nama_kamar." ".$kamar->no_bed."</td>";
                                    echo "<td class='text-center'>".$key->no_rm."</td>";
                                    echo "<td >".$key->nama_pasien."</td>";
                                    echo "<td class='text-center'>".$key->jenis_kelamin."</td>";
                                    echo "<td class='text-center'>".(date("Y") - date("Y",strtotime($key->tahun)))."th"."</td>";
                                    echo "<td class='text-center'>".($key->hubungan_keluarga == "1" ? "PS" : "").($key->hubungan_keluarga == "2" ? "AD Ayah ".$key->nama_pasangan." Ibu ".$key->ibu : "").($key->hubungan_keluarga == "3" ?"S/I D ".$key->nama_pasangan : "")."</td>";

                                    echo "<td class='text-center'>".$pangkat->keterangan." ".$key->nip."</td>";
                                    echo "<td class='text-left'>".substr($key->alamat,0,25)."</td>";
                                    echo "<td class='text-center'>".($diagnosa_medis->a == ""? $diagnosa_medis_2->diagnosa_akhir : $diagnosa_medis->a)."</td>";
                                    if ($key->masuk == "IGD" || $key->masuk == "UGD") {
                                        echo "<td >". $id_dokter->nama_dokter."</td>";
                                    }else{
                                        echo "<td >".$key->nama_dokter."</td>";
                                    }
                                    // echo "<td class='text-center'>".$dokter->dokter."</td>";
                                    // echo "<td class='text-right'>".$dinas."</td>";
                                    // echo "<td class='text-right'>".$umum."</td>";
                                    // echo "<td class='text-right'>".$bpjs."</td>";
                                    // echo "<td class='text-right'>".$prsh."</td>";
                                    // echo "<td class='text-right'>".($dinas+$umum+$bpjs+$prsh)."</td>";
                                    // echo "<td class='text-right'>".$inap_kelas["HP"][$key->kode_kelas_dashboard]."</td>";
                                    // echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    // echo "<td class='text-right'>".($bed>0 ? number_format(($dinas+$umum+$bpjs+$prsh)/$bed*100,2) : 0)." %</td>";
                                    echo "</tr>";
                                    }
                                    // $total += $key->bed;
                                    // $jml_dinas += $dinas;
                                    // $jml_umum += $umum;
                                    // $jml_bpjs += $bpjs;
                                    // $jml_prsh += $prsh;
                                    // $jml_bed += $bed;
                                    // $jml_hp += (isset($inap_kelas["HP"][$data->kode_kelas_dashboard]) ? $inap_kelas["HP"][$data->kode_kelas_dashboard] : 0);
                                // }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-orange'>
                            <!-- <th>Jumlah Pasien</th>
                            <th class='text-right'><?php echo $total;?></th>
                            <th class='text-right'><?php echo $jml_dinas;?></th>
                            <th class='text-right'><?php echo $jml_umum;?></th>
                            <th class='text-right'><?php echo $jml_bpjs;?></th>
                            <th class='text-right'><?php echo $jml_prsh;?></th>
                            <th class='text-right'><?php echo ($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh);?></th>
                            <th class='text-right'><?php echo $jml_hp;?></th>
                            <th class='text-right'><?php echo($jml_bed>0 ? number_format(($jml_dinas+$jml_umum+$jml_bpjs+$jml_prsh)/$jml_bed*100,2) : 0)?> %</th> -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Laporan Pasien Rawat Lama</h3>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-maroon'>
                            <th class="text-center">No</th>
                            <th class="text-center" width="100px">Tgl Masuk</th>
                            <th class="text-center" width="125px">Ruangan</th>
                            <th class="text-center" width="100px">No. RM</th>
                            <th class="text-center" width="250px">Nama Pasien</th>
                            <th class="text-center">Diagnosa</th>
                            <th class="text-center" width="200px">Dokter DPJP</th>
                            <th class="text-center" width="70px">HP</th>
                            <th class="text-center">Koding</th>
                            <th class="text-center">Billing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($inaplama['list'] as $key){
                              $t1 = new DateTime('today');
                              $t2 = new DateTime($key->tgl_masuk);
                              $hp = $t1->diff($t2)->d;
                              if (!$key->covid){
                                if (($hp+1)>=6){
                                  echo "<tr>";
                                  $diagnosa_medis = ($inaplama["diagnosa_medis"][$key->no_reg]);
                                  $diagnosa_medis_2 = ($inaplama["diagnosa_medis_2"][$key->no_reg]);
                                  $id_dokter = ($inaplama["id_dokter"][$key->no_reg]);
                                  echo "<td class='text-center'>".$no++."</td>";
                                  echo "<td class='text-center'>".date("d-m-Y",strtotime($key->tgl_masuk))."</td>";
                                  echo "<td >".$key->ruangan."</td>";
                                  echo "<td class='text-center'>".$key->no_rm."</td>";
                                  echo "<td >".$key->nama_pasien."</td>";
                                  echo "<td>".($diagnosa_medis->a == ""? $diagnosa_medis_2->diagnosa_akhir : $diagnosa_medis->a)."</td>";
                                  if ($key->masuk == "IGD" || $key->masuk == "UGD") {
                                      echo "<td >". $id_dokter->nama_dokter."</td>";
                                  }else{
                                      echo "<td >".$key->nama_dokter."</td>";
                                  }
                                  echo "<td class='text-center'>".($hp+1)." hari</td>";
                                  echo "<td class='text-right'><a href='#' class='koding dataChange' no_reg='".$key->no_reg."'>".number_format($inaplama["simulasi"][$key->no_reg]->koding,0,',','.')."</a></td>";
                                  echo "<td class='text-right'><a href='#' class='billing dataChange' no_reg='".$key->no_reg."'>".number_format($inaplama["simulasi"][$key->no_reg]->billing,0,',','.')."</a></td>";
                                }
                              }
                            }
                        ?>
                    </tbody>
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
                            <th class="text-center" style="vertical-align: middle" rowspan="2">HP</th>
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
                            $total = 0;
                            $jumlah = 0;
                            $jml_hp = 0;
                            foreach($r->result() as $data){
                                if ($data->kode_ruangan!=19){
                                    echo "<tr class='data2' ruangan='".$data->kode_ruangan_a."'>";
                                    echo "<td>".str_replace("ISOLASI", "", $data->nama_ruangan)."</td>";
                                    echo "<td class='text-right'>".$data->bed."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][1]) ? $inap2["DINAS"][$data->kode_ruangan_a][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][1]) ? $inap2["UMUM"][$data->kode_ruangan_a][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][1]) ? $inap2["BPJS"][$data->kode_ruangan_a][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][1]) ? $inap2["PRSH"][$data->kode_ruangan_a][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][2]) ? $inap2["DINAS"][$data->kode_ruangan_a][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][2]) ? $inap2["UMUM"][$data->kode_ruangan_a][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][2]) ? $inap2["BPJS"][$data->kode_ruangan_a][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][2]) ? $inap2["PRSH"][$data->kode_ruangan_a][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][3]) ? $inap2["DINAS"][$data->kode_ruangan_a][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][3]) ? $inap2["UMUM"][$data->kode_ruangan_a][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][3]) ? $inap2["BPJS"][$data->kode_ruangan_a][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][3]) ? $inap2["PRSH"][$data->kode_ruangan_a][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["DINAS"][$data->kode_ruangan_a][4]) ? $inap2["DINAS"][$data->kode_ruangan_a][4] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["UMUM"][$data->kode_ruangan_a][4]) ? $inap2["UMUM"][$data->kode_ruangan_a][4] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["BPJS"][$data->kode_ruangan_a][4]) ? $inap2["BPJS"][$data->kode_ruangan_a][4] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2["PRSH"][$data->kode_ruangan_a][4]) ? $inap2["PRSH"][$data->kode_ruangan_a][4] : 0)."</td>";
                                    $jumlah = (isset($inap2["DINAS"][$data->kode_ruangan_a][1]) ? $inap2["DINAS"][$data->kode_ruangan_a][1] : 0)
                                              +(isset($inap2["UMUM"][$data->kode_ruangan_a][1]) ? $inap2["UMUM"][$data->kode_ruangan_a][1] : 0)
                                              +(isset($inap2["BPJS"][$data->kode_ruangan_a][1]) ? $inap2["BPJS"][$data->kode_ruangan_a][1] : 0)
                                              +(isset($inap2["PRSH"][$data->kode_ruangan_a][1]) ? $inap2["PRSH"][$data->kode_ruangan_a][1] : 0)
                                              +(isset($inap2["DINAS"][$data->kode_ruangan_a][2]) ? $inap2["DINAS"][$data->kode_ruangan_a][2] : 0)
                                              +(isset($inap2["UMUM"][$data->kode_ruangan_a][2]) ? $inap2["UMUM"][$data->kode_ruangan_a][2] : 0)
                                              +(isset($inap2["BPJS"][$data->kode_ruangan_a][2]) ? $inap2["BPJS"][$data->kode_ruangan_a][2] : 0)
                                              +(isset($inap2["PRSH"][$data->kode_ruangan_a][2]) ? $inap2["PRSH"][$data->kode_ruangan_a][2] : 0)
                                              +(isset($inap2["DINAS"][$data->kode_ruangan_a][3]) ? $inap2["DINAS"][$data->kode_ruangan_a][3] : 0)
                                              +(isset($inap2["UMUM"][$data->kode_ruangan_a][3]) ? $inap2["UMUM"][$data->kode_ruangan_a][3] : 0)
                                              +(isset($inap2["BPJS"][$data->kode_ruangan_a][3]) ? $inap2["BPJS"][$data->kode_ruangan_a][3] : 0)
                                              +(isset($inap2["PRSH"][$data->kode_ruangan_a][3]) ? $inap2["PRSH"][$data->kode_ruangan_a][3] : 0)
                                              +(isset($inap2["DINAS"][$data->kode_ruangan_a][4]) ? $inap2["DINAS"][$data->kode_ruangan_a][4] : 0)
                                              +(isset($inap2["UMUM"][$data->kode_ruangan_a][4]) ? $inap2["UMUM"][$data->kode_ruangan_a][4] : 0)
                                              +(isset($inap2["BPJS"][$data->kode_ruangan_a][4]) ? $inap2["BPJS"][$data->kode_ruangan_a][4] : 0)
                                              +(isset($inap2["PRSH"][$data->kode_ruangan_a][4]) ? $inap2["PRSH"][$data->kode_ruangan_a][4] : 0);
                                    echo "<td class='text-right'>".$inap2["HP"][$data->kode_ruangan_a]."</td>";
                                    echo "<td class='text-right'>".$jumlah."</td>";
                                    echo "</tr>";
                                    $total += $data->bed;
                                    for($i=1;$i<=4;$i++){
                                        if (isset($dinas[$i]))
                                            $dinas[$i] += (isset($inap2["DINAS"][$data->kode_ruangan_a][$i]) ? $inap2["DINAS"][$data->kode_ruangan_a][$i] : 0);
                                        else
                                            $dinas[$i] = (isset($inap2["DINAS"][$data->kode_ruangan_a][$i]) ? $inap2["DINAS"][$data->kode_ruangan_a][$i] : 0);
                                        if (isset($umum[$i]))
                                            $umum[$i] += (isset($inap2["UMUM"][$data->kode_ruangan_a][$i]) ? $inap2["UMUM"][$data->kode_ruangan_a][$i] : 0);
                                        else
                                            $umum[$i] = (isset($inap2["UMUM"][$data->kode_ruangan_a][$i]) ? $inap2["UMUM"][$data->kode_ruangan_a][$i] : 0);
                                        if (isset($bpjs[$i]))
                                            $bpjs[$i] += (isset($inap2["BPJS"][$data->kode_ruangan_a][$i]) ? $inap2["BPJS"][$data->kode_ruangan_a][$i] : 0);
                                        else
                                            $bpjs[$i] = (isset($inap2["BPJS"][$data->kode_ruangan_a][$i]) ? $inap2["BPJS"][$data->kode_ruangan_a][$i] : 0);
                                        if (isset($prsh[$i]))
                                            $prsh[$i] += (isset($inap2["PRSH"][$data->kode_ruangan_a][$i]) ? $inap2["PRSH"][$data->kode_ruangan_a][$i] : 0);
                                        else
                                            $prsh[$i] = (isset($inap2["PRSH"][$data->kode_ruangan_a][$i]) ? $inap2["PRSH"][$data->kode_ruangan_a][$i] : 0);
                                    }
                                    $jml_hp += (isset($inap2["HP"][$data->kode_ruangan_a]) ? $inap2["HP"][$data->kode_ruangan_a] : 0);
                                }
                            }
                            echo "<tr class='bg-green'>";
                                    echo "<th>Jumlah</th>";
                                    echo "<th class='text-right'>".$total."</th>";
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
                                    echo "<th class='text-right'>".$jml_hp."</th>";
                                    echo "<th class='text-right'>".$jumlah."</th>";
                                    echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Laporan Pasien Pulang Rawat Inap Berdasarkan Kelas</h3></div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-red'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Kelas</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">TT</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Pulang Sehat</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Pulang Paksa</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Rujuk RS Lain</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Meninggal</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">HP</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-red'>
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
                            $total = 0;
                            $jumlah = 0;
                            $jml_hp = 0;
                            foreach($kls_tt->result() as $data){
                                    echo "<tr class='data2_kelas' kelas='".$data->kode_kelas_dashboard."'>";
                                    echo "<td class='text-center'>".str_replace("_", " ", strtoupper($data->kode_kelas_dashboard))."</td>";
                                    echo "<td class='text-right'>".$data->bed."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][1] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][2] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][3] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][4] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][4] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][4] : 0)."</td>";
                                    echo "<td class='text-right'>".(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][4] : 0)."</td>";
                                    $jumlah = (isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][1] : 0)
                                              +(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][1] : 0)
                                              +(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][1] : 0)
                                              +(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][1]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][1] : 0)
                                              +(isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][2] : 0)
                                              +(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][2] : 0)
                                              +(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][2] : 0)
                                              +(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][2]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][2] : 0)
                                              +(isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][3] : 0)
                                              +(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][3] : 0)
                                              +(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][3] : 0)
                                              +(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][3]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][3] : 0)
                                              +(isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][4] : 0)
                                              +(isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][4] : 0)
                                              +(isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][4] : 0)
                                              +(isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][4]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][4] : 0);
                                    echo "<td class='text-right'>".$inap2_kelas["HP"][$data->kode_kelas_dashboard]."</td>";
                                    echo "<td class='text-right'>".$jumlah."</td>";
                                    echo "</tr>";
                                    $total += $data->bed;
                                    for($i=1;$i<=4;$i++){
                                        if (isset($dinas[$i])){
                                           $dinas[$i] += (isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][$i]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                        else{
                                           $dinas[$i] = (isset($inap2_kelas["DINAS"][$data->kode_kelas_dashboard][$i]) ? $inap2_kelas["DINAS"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                        if (isset($umum[$i])){
                                            $umum[$i] += (isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][$i]) ? $inap2_kelas["UMUM"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                        else{
                                           $umum[$i] = (isset($inap2_kelas["UMUM"][$data->kode_kelas_dashboard][$i]) ? $inap2["UMUM"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                        if (isset($bpjs[$i])){
                                           $bpjs[$i] += (isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][$i]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                        else{
                                           $bpjs[$i] = (isset($inap2_kelas["BPJS"][$data->kode_kelas_dashboard][$i]) ? $inap2_kelas["BPJS"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                        if (isset($prsh[$i])){
                                            $prsh[$i] += (isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][$i]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                        else{
                                            $prsh[$i] = (isset($inap2_kelas["PRSH"][$data->kode_kelas_dashboard][$i]) ? $inap2_kelas["PRSH"][$data->kode_kelas_dashboard][$i] : 0);
                                        }
                                    }
                                    $jml_hp += (isset($inap2_kelas["HP"][$data->kode_kelas_dashboard]) ? $inap2_kelas["HP"][$data->kode_kelas_dashboard] : 0);
                            }
                            echo "<tr class='bg-red '>";
                                    echo "<th>Jumlah</th>";
                                    echo "<th class='text-right'>".$total."</th>";
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
                                    echo "<th class='text-right'>".$jml_hp."</th>";
                                    echo "<th class='text-right'>".$jumlah."</th>";
                                    echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Laporan Pasien IGD</h3></div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr class='bg-navy'>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">No.</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Poliklinik</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Status</th>
                            <th class="text-center" style="vertical-align: middle" colspan="2">Jenis</th>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                        </tr>
                        <tr class='bg-navy'>
                            <th class="text-center">Baru</th>
                            <th class="text-center">Lama</th>
                            <th class="text-center">Reguler</th>
                            <th class="text-center">Eksekutif</th>
                            <th class="text-center">D</th>
                            <th class="text-center">U</th>
                            <th class="text-center">BPJS</th>
                            <th class="text-center">PRSH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $baru = $lama = $reguler = $eksekutif = $dinas = $umum = $bpjs = $prsh = 0;
                            echo "<tr>";
                            echo "<td class='text-right'>1. </td>";
                            echo "<td>Rawat Jalan</td>";
                            echo "<td class='text-right'>".(isset($poli["BARU"]["0102030"]) ? $poli["BARU"]["0102030"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($poli["LAMA"]["0102030"]) ? $poli["LAMA"]["0102030"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($poli["REGULER"]["0102030"]) ? $poli["REGULER"]["0102030"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($poli["EKSEKUTIF"]["0102030"]) ? $poli["EKSEKUTIF"]["0102030"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($poli["DINAS"]["0102030"]) ? $poli["DINAS"]["0102030"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0)."</td>";
                            $jumlah = (isset($poli["DINAS"]["0102030"]) ? $poli["DINAS"]["0102030"] : 0)+
                                      (isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0)+
                                      (isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0)+
                                      (isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0);
                            $baru += (isset($poli["BARU"]["0102030"]) ? $poli["BARU"]["0102030"] : 0);
                            $lama += (isset($poli["LAMA"]["0102030"]) ? $poli["LAMA"]["0102030"] : 0);
                            $reguler += (isset($poli["REGULER"]["0102030"]) ? $poli["REGULER"]["0102030"] : 0);
                            $eksekutif += (isset($poli["EKSEKUTIF"]["0102030"]) ? $poli["EKSEKUTIF"]["0102030"] : 0);
                            $dinas += (isset($poli["DINAS"]["0102030"]) ? $poli["DINAS"]["0102030"] : 0);
                            $umum += (isset($poli["UMUM"]["0102030"]) ? $poli["UMUM"]["0102030"] : 0);
                            $bpjs += (isset($poli["BPJS"]["0102030"]) ? $poli["BPJS"]["0102030"] : 0);
                            $prsh += (isset($poli["PRSH"]["0102030"]) ? $poli["PRSH"]["0102030"] : 0);
                            echo "<td class='text-right'>".$jumlah."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td class='text-right'>2.</td>";
                            echo "<td>Rawat Inap</td>";
                            echo "<td class='text-right'>".(isset($igd["BARU"]) ? $igd["BARU"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($igd["LAMA"]) ? $igd["LAMA"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($igd["REGULER"]) ? $igd["REGULER"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($igd["EKSEKUTIF"]) ? $igd["EKSEKUTIF"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($igd["DINAS"]) ? $igd["DINAS"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($igd["UMUM"]) ? $igd["UMUM"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($igd["BPJS"]) ? $igd["BPJS"] : 0)."</td>";
                            echo "<td class='text-right'>".(isset($igd["PRSH"]) ? $igd["PRSH"] : 0)."</td>";
                            $jumlah = (isset($igd["DINAS"]) ? $igd["DINAS"] : 0)+
                                      (isset($igd["UMUM"]) ? $igd["UMUM"] : 0)+
                                      (isset($igd["BPJS"]) ? $igd["BPJS"] : 0)+
                                      (isset($igd["PRSH"]) ? $igd["PRSH"] : 0);
                            $baru += (isset($igd["BARU"]) ? $igd["BARU"] : 0);
                            $lama += (isset($igd["LAMA"]) ? $igd["LAMA"] : 0);
                            $reguler += (isset($igd["REGULER"]) ? $igd["REGULER"] : 0);
                            $eksekutif += (isset($igd["EKSEKUTIF"]) ? $igd["EKSEKUTIF"] : 0);
                            $dinas += (isset($igd["DINAS"]) ? $igd["DINAS"] : 0);
                            $umum += (isset($igd["UMUM"]) ? $igd["UMUM"] : 0);
                            $bpjs += (isset($igd["BPJS"]) ? $igd["BPJS"] : 0);
                            $prsh += (isset($igd["PRSH"]) ? $igd["PRSH"] : 0);
                            echo "<td class='text-right'>".$jumlah."</td>";
                            echo "</tr>";
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                            <th colspan="2">Jumlah Pasien</th>
                            <th class="text-right"><?php echo $baru;?></th>
                            <th class="text-right"><?php echo $lama;?></th>
                            <th class="text-right"><?php echo $reguler;?></th>
                            <th class="text-right"><?php echo $eksekutif;?></th>
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
    </div> -->
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
                                <th class='text-center'>Kelas</th>
                                <th width="10%" class='text-center'>Kamar</th>
                                <th width="10%" class='text-center'>No. Bed</th>
                                <th class='text-center'>Golongan Pasien</th>
                                <th class='text-center status_pulang'>Status Pulang</th>
                                <th class='text-center'>HP</th>
                            </tr>
                        </thead>
                        <tbody class="listpasien"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
