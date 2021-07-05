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
            window.location = "<?php echo site_url("home/pelayanan");?>/"+tgl1+"/"+tgl2;
        });
        $("tr.ralan").click(function(){
            $(".viewpasien_ralan").modal("show");
            $(".listpasien_ralan").html("");
            $(".judulmodal").html("List Pasien Rawat Jalan");
            $.ajax({
                url   : "<?php echo site_url("home/listpasienralan_igd");?>",
                type : "POST",
                success: function(result){
                    console.log(result);
                    var echo = '';
                    var no = 1;
                    $.each(JSON.parse(result),function(key,val){
                        echo += "<tr>";
                        echo += "<td class='text-center'>"+(no++)+"</td>";
                        echo += "<td class='text-center'>"+val.no_pasien+"</td>";
                        echo += "<td class='text-center'>"+val.no_reg+"</td>";
                        echo += "<td>"+val.nama_pasien+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.diagnosa+"</td>";
                        echo += "<td>"+val.nama_dokter+"</td>";
                        echo += "</tr>";
                    });
                    $(".listpasien_ralan").html(echo);
                },
                error: function(result){
                    console.log(result);
                }
            });
        });
        $("tr.ranap").click(function(){
            $(".viewpasien").modal("show");
            $(".listpasien").html("");
            $("th.status_pulang").addClass("hide");
            $(".judulmodal").html("List Pasien Rawat Inap");
            $.ajax({
                url   : "<?php echo site_url("home/listpasieninap_igd");?>",
                type : "POST",
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
                        echo += "<td>"+val.nama_ruangan+"</td>";
                        echo += "<td>"+val.nama_kelas+"</td>";
                        echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                        echo += "<td class='text-center'>"+val.no_bed+"</td>";
                        echo += "<td>"+val.gol_ket+"</td>";
                        echo += "<td>"+val.diagnosa+"</td>";
                        echo += "<td>"+val.nama_dokter+"</td>";
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
</script>
<div class="col-sm-12">
    <div class="box box-primary">
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
                            echo "<tr class='ralan'>";
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
                            echo "<tr class='ranap'>";
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
    </div>
</div>
<div class='modal viewpasien_ralan'>
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
                                <th class='text-center'>Golongan Pasien</th>
                                <th class='text-center'>Diagnosa</th>
                                <th width="20%" class='text-center'>Dokter</th>
                            </tr>
                        </thead>
                        <tbody class="listpasien_ralan"></tbody>
                    </table>
                </div>
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
                                <th class='text-center'>Ruangan</th>
                                <th class='text-center'>Kelas</th>
                                <th width="10%" class='text-center'>Kamar</th>
                                <th width="10%" class='text-center'>No. Bed</th>
                                <th class='text-center'>Golongan Pasien</th>
                                <th class='text-center status_pulang'>Status Pulang</th>
                                <th class='text-center'>Diagnosa</th>
                                <th width="20%" class='text-center'>Dokter</th>
                            </tr>
                        </thead>
                        <tbody class="listpasien"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
