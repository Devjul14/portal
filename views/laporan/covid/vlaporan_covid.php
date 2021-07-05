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
	$(document).ready(function(e){
		var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl,
        });
            $("input[name='tgl2']").datepicker({
            dateFormat : formattgl,
        });
        $(".print").click(function(){
            var id = $(".bg-gray").attr("href");
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var golpas = $("[name='golpas']").val();
            var tingkat_status = $("[name='tingkat_status']").val();
            var url = "<?php echo site_url('laporan/cetakcovid')?>/"+tgl1+"/"+tgl2+"/"+golpas+"/"+tingkat_status;
            openCenteredWindow(url);
        });
         $(".search").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var golpas = $("[name='golpas']").val();
            var tingkat_status = $("[name='tingkat_status']").val();
            window.location = "<?php echo site_url("laporan/covid");?>/"+tgl1+"/"+tgl2+"/"+golpas+"/"+tingkat_status;
        });
    });  
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" autocomplete="off"/>   
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name='golpas'>
                            <option value="all">---</option>
                            <?php
                                foreach ($gp->result() as $key) {
                                    echo "<option value='".$key->status."' ".($golpas==$key->status ? "selected" : "").">".$key->keterangan."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name='tingkat_status'>
                            <option value="all">---</option>
                            <option <?php echo ($tingkat_status=="RINGAN" ? "selected" : "");?> value='RINGAN'>RINGAN</option>
                            <option <?php echo ($tingkat_status=="SEDANG" ? "selected" : "");?> value='SEDANG'>SEDANG</option>
                            <option <?php echo ($tingkat_status=="BERAT" ? "selected" : "");?> value='BERAT'>BERAT</option>
                        </select>
                    </div>
                    <div class="col-md-1"><button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button></div>
                    <div class="col-md-2">
                        <button class="print btn btn-success pull-right" type = "button" ><i class="fa fa-print"></i>&nbsp;Cetak</button>   
                    </div>
                </div>
            </div>
            <table  width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        LAPORAN HARIAN COVID-19
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo date("d-m-Y",strtotime($tgl1))." s.d ".date("d-m-Y",strtotime($tgl2)); ?></td></tr>
                <tr><td class="text-center" colspan="2">TAHUN : <?php echo date("Y",strtotime($tgl1))?></td></tr>
            </table>
            <div class="table-responsive">
                <table class="laporan table table-bordered table-striped" width="100%">
                    <thead class="bg-navy">
                        <tr>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">No.</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:220px'>Nama</div></th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:130px'>Kepala Keluarga</div></th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:100px'>Umur</div></th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">JK</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">HP</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">NIK</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">Pekerjaan</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:300px'>Alamat</div></th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">Kelurahan</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">Kecamatan</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3">ODP/PDP/POSITIF</th>
                            <th class="text-center" style='vertical-align: middle;' colspan='3'>RIWAYAT PERJALANAN</th>
                            <th class="text-center" style='vertical-align: middle;' colspan='5'>KELUHAN</th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:400px'>HASIL PENUNJANG</div></th>
                            <th class="text-center" style='vertical-align: middle;' rowspan="3"><div style='width:300px'>KETERANGAN</div></th>
                        </tr>
                        <tr>                            
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">NEGARA/DAERAH</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="2">TANGGAL</th>
                            <th class="text-center" style="vertical-align: middle;">DEMAM</th>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>PANAS</div></th>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>BATUK</div></th>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>PILEK</div></th>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2"><div style='width:80px'>SESAK</div></th>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;"><div style='width:100px'>PERGI</div></th>
                            <th class="text-center" style="vertical-align: middle;"><div style='width:100px'>PULANG</div></th>
                            <th class="text-center" style="vertical-align: middle;">TEMPERATUR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach ($n->result() as $row){
                                echo "<tr>";
                                echo "<td>".($i++)."</td>";
                                if ($row->hubungan_keluarga==1){
                                    $kk = $row->nama_pasien;
                                } else 
                                if ($row->hubungan_keluarga==2){
                                    $kk = $row->nama_pasangan;
                                } else {
                                    if ($row->jenis_kelamin=="L")
                                        $kk = $row->nama_pasien;
                                    else {
                                        $kk = $row->nama_pasangan;
                                    }
                                } 
                                echo "<td>".$row->nama_pasien."<br>Tgl Masuk ".date("d-m-Y",strtotime($row->tanggal))."<br>Jam : ".$row->jam."</td>";
                                echo "<td>".$kk."</td>";
                                list($year,$month,$day) = explode("-",$row->tgl_lahir);
                                $year_diff  = date("Y") - $year;
                                $month_diff = date("m") - $month;
                                $day_diff   = date("d") - $day;
                                if ($month_diff < 0) { 
                                    $year_diff--;
                                    $month_diff *= (-1);
                                }
                                elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
                                if ($day_diff < 0) { 
                                    $day_diff *= (-1);
                                }
                                $umur = $year_diff." tahun ".$month_diff." bulan ".$day_diff." hari ";
                                echo "<td>".$umur."</td>";
                                echo "<td class='text-center'>".$row->jenis_kelamin."</td>";
                                echo "<td>".$row->telpon."</td>";
                                echo "<td>".$row->ktp."</td>";
                                echo "<td>".$row->pekerjaan."</td>";
                                echo "<td>".$row->alamat."</td>";
                                echo "<td>".$row->kelurahan."</td>";
                                echo "<td>".$row->kecamatan."</td>";
                                echo "<td class='text-center'>".$row->status.", ".$row->tingkat_status.", ".$row->status_assesmen."</td>";
                                echo "<td>".$row->province." ".$row->kota."</td>";
                                $t = explode(",", $row->tglresiko);
                                echo "<td>".$t[0]."</td>";
                                echo "<td>".$t[1]."</td>";
                                echo "<td class='text-center'>".$row->suhu." °C</td>";
                                $k = explode(",", $row->tglgejala);
                                echo "<td>".$k[1]."</td>";
                                echo "<td>".$k[2]."</td>";
                                echo "<td>".$k[3]."</td>";
                                echo "<td>".$k[4]."</td>";
                                echo "<td>";
                                if (isset($p["rad"][$row->no_reg])){
                                    echo "<b>Radiologi</b><br>";
                                    echo $p["rad"][$row->no_reg]->hasil_pemeriksaan;
                                    echo "<br><br>";
                                }
                                if ($p["lab"][$row->no_reg]->num_rows()>0){
                                    echo "<b>Lab</b><br>";
                                    $sdata="";
                                    $i=1;$n=1;
                                    $judul = $namaanalys = $nip_dokter = $nama_dokter = "";
                                    $nama_tindakan ="";
                                    echo '<table cellspacing="2" cellpadding="1"  width="100%" align="right"border="0">
                                            <tr>
                                                <th align="left" width="210"><strong>Jenis Pemeriksaan <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
                                                <th align="left"><strong>Hasil <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
                                            </tr>';
                                    foreach ($p["lab"][$row->no_reg]->result() as $row){
                                        $merah = "";
                                        $hasil = (float)$row->hasil;
                                        if ($row->min_kritis!=""){
                                            if ($hasil<=$row->min_kritis)
                                                $merah = "red";
                                        }
                                        if ($row->max_kritis!=""){
                                            if ($hasil>=$row->max_kritis)
                                                $merah = "red";
                                        }
                                        if ($row->jenis_kelamin=="L") {
                                            $rujukan = $row->pria;
                                        } else {
                                            $rujukan = $row->wanita;
                                        }
                                        if ($judul!=$row->judul){
                                            $i = 1;
                                            echo "<tr>";
                                            echo "<td colspan='2'>".$row->judul."</td>";
                                            echo "<tr>";
                                        }
                                        echo "<tr>";
                                        echo "<td align='left'>&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;".$row->nama."</td>";
                                        echo "<td align='left'><label class='text-".$merah."'>".$row->hasil."&nbsp;".$row->satuan."</label></td>";
                                        echo "</tr>";
                                        $judul = $row->judul;
                                        $i++;   
                                    }
                                    echo "</table>";
                                }
                                echo "</td>";
                                echo "<td>";
                                if (isset($p["ket"][$row->no_reg])){
                                    echo ($row->td=="" ? "" : "TD ka : ".$row->td." mmHg"); 
                                    echo ($row->td2=="" ? "" : "<br>TD ki : ".$row->td2." mmHg"); 
                                    echo ($row->nadi=="" ? "" : "<br>Nadi : ".$row->nadi." x/ mnt"); 
                                    echo ($row->respirasi=="" ? "" : "<br>Respirasi : ".$row->respirasi." x/ mnt");
                                    echo ($row->suhu=="" ? "" : "<br>Suhu : ".$row->suhu." °C");
                                    echo ($row->spo2=="" ? "" : "<br>SpO2 : ".$row->spo2." %");
                                    echo ($p["ket"][$row->no_reg]->bb!="" ? "<br>BB : ".$p["ket"][$row->no_reg]->bb." kg" : "");
                                    echo ($p["ket"][$row->no_reg]->tb!="" ? "<br>TB : ".$p["ket"][$row->no_reg]->tb." cm" : "");
                                    echo ($p["ket"][$row->no_reg]->s!="" ? "<br>S : <br>".$p["ket"][$row->no_reg]->s : "");
                                    echo ($p["ket"][$row->no_reg]->o!="" ? "<br>O : <br>".$p["ket"][$row->no_reg]->o : "");
                                    echo ($p["ket"][$row->no_reg]->a!="" ? "<br>A : <br>".$p["ket"][$row->no_reg]->a : "");
                                    echo ($p["ket"][$row->no_reg]->p!="" ? "<br>P : <br>".$p["ket"][$row->no_reg]->p : "");

                                } "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>