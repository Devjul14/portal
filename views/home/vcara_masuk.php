<script src="<?php echo base_url();?>js/amcharts/amcharts.js"></script>
<script src="<?php echo base_url();?>js/amcharts/pie.js"></script>
<script src="<?php echo base_url();?>js/amcharts/serial.js"></script>
<link  type="text/css" href="<?php echo base_url();?>js/amcharts/plugins/export/export.css" rel="stylesheet">
    <div class="col-xs-12">
        <div class="box box-primary" >
            <div class="box-header"><h3>GRAFIK CARA MASUK HARIAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div id="chartdiv" style="height : 400px;"></div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>TABEL GRAFIK CARA MASUK HARIAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr class='bg-navy'>
                            <th class="text-center" colspan="4">Sendiri</th>
                            <th class="text-center" colspan="4">RS</th>
                            <th class="text-center" colspan="4">Dokter</th>
                            <th class="text-center" colspan="4">Paramedis</th>
                            <th class="text-center" colspan="4">Puskesmas</th>
                            <th class="text-center" colspan="4">Kepolisian</th>
                            <th class="text-center" colspan="4">Lain</th>
                        </tr>
                        <tr class="bg-navy">
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
                        <tr>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Datang Sendiri"]["DINAS"]) ? $q2["Datang Sendiri"]["DINAS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Datang Sendiri"]["UMUM"]) ? $q2["Datang Sendiri"]["UMUM"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Datang Sendiri"]["BPJS"]) ? $q2["Datang Sendiri"]["BPJS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Datang Sendiri"]["PERUSAHAAN"]) ? $q2["Datang Sendiri"]["PERUSAHAAN"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan RS"]["DINAS"]) ? $q2["Rujukan RS"]["DINAS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan RS"]["UMUM"]) ? $q2["Rujukan RS"]["UMUM"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan RS"]["BPJS"]) ? $q2["Rujukan RS"]["BPJS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan RS"]["PERUSAHAAN"]) ? $q2["Rujukan RS"]["PERUSAHAAN"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Dokter"]["DINAS"]) ? $q2["Rujukan Dokter"]["DINAS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Dokter"]["UMUM"]) ? $q2["Rujukan Dokter"]["UMUM"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Dokter"]["BPJS"]) ? $q2["Rujukan Dokter"]["BPJS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Dokter"]["PERUSAHAAN"]) ? $q2["Rujukan Dokter"]["PERUSAHAAN"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Paramedis"]["DINAS"]) ? $q2["Rujukan Paramedis"]["DINAS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Paramedis"]["UMUM"]) ? $q2["Rujukan Paramedis"]["UMUM"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Paramedis"]["BPJS"]) ? $q2["Rujukan Paramedis"]["BPJS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Paramedis"]["PERUSAHAAN"]) ? $q2["Rujukan Paramedis"]["PERUSAHAAN"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Puskesmas"]["DINAS"]) ? $q2["Rujukan Puskesmas"]["DINAS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Puskesmas"]["UMUM"]) ? $q2["Rujukan Puskesmas"]["UMUM"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Puskesmas"]["BPJS"]) ? $q2["Rujukan Puskesmas"]["BPJS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Puskesmas"]["PERUSAHAAN"]) ? $q2["Rujukan Puskesmas"]["PERUSAHAAN"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Kepolisian"]["DINAS"]) ? $q2["Rujukan Kepolisian"]["DINAS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Kepolisian"]["UMUM"]) ? $q2["Rujukan Kepolisian"]["UMUM"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Kepolisian"]["BPJS"]) ? $q2["Rujukan Kepolisian"]["BPJS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Kepolisian"]["PERUSAHAAN"]) ? $q2["Rujukan Kepolisian"]["PERUSAHAAN"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Lain"]["DINAS"]) ? $q2["Rujukan Lain"]["DINAS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Lain"]["UMUM"]) ? $q2["Rujukan Lain"]["UMUM"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Lain"]["BPJS"]) ? $q2["Rujukan Lain"]["BPJS"] : "-");
                              ?>
                            </td>
                            <td class='text-center'>
                              <?php
                                echo (isset($q2["Rujukan Lain"]["PERUSAHAAN"]) ? $q2["Rujukan Lain"]["PERUSAHAAN"] : "-");
                              ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK CARA MASUK BULANAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div id="chartdiv_bulan" style="height : 400px"></div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>TABEL GRAFIK CARA MASUK BULANAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-responsive table-bordered">
                        <tr class='bg-navy'>
                            <th class="text-center" rowspan="2">Tanggal</th>
                            <th class="text-center" colspan="4">Sendiri</th>
                            <th class="text-center" colspan="4">RS</th>
                            <th class="text-center" colspan="4">Dokter</th>
                            <th class="text-center" colspan="4">Paramedis</th>
                            <th class="text-center" colspan="4">Puskesmas</th>
                            <th class="text-center" colspan="4">Kepolisian</th>
                            <th class="text-center" colspan="4">Lain</th>
                        </tr>
                        <tr class="bg-navy">
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
                        <?php
                            $hari = array("1","2","3","4","5","6","7","8","9","10",
                                            "11","12","13","14","15","16","17","18","19",
                                            "20","21","22","23","24","25","26","27","28","29","30");
                        ?>
                        <?php foreach ($hari as $key => $value): ?>
                            <tr>
                              <td class='text-center'>
                                <?php echo $value ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Datang Sendiri"]["DINAS"][$value]) ? $q["Datang Sendiri"]["DINAS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Datang Sendiri"]["UMUM"][$value]) ? $q["Datang Sendiri"]["UMUM"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Datang Sendiri"]["BPJS"][$value]) ? $q["Datang Sendiri"]["BPJS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Datang Sendiri"]["PERUSAHAAN"][$value]) ? $q["Datang Sendiri"]["PERUSAHAAN"][$value] : "-");
                                ?>
                              </td>

                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan RS"]["DINAS"][$value]) ? $q["Rujukan RS"]["DINAS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan RS"]["UMUM"][$value]) ? $q["Rujukan RS"]["UMUM"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan RS"]["BPJS"][$value]) ? $q["Rujukan RS"]["BPJS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan RS"]["PERUSAHAAN"][$value]) ? $q["Rujukan RS"]["PERUSAHAAN"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Dokter"]["DINAS"][$value]) ? $q["Rujukan Dokter"]["DINAS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Dokter"]["UMUM"][$value]) ? $q["Rujukan Dokter"]["UMUM"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Dokter"]["BPJS"][$value]) ? $q["Rujukan Dokter"]["BPJS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Dokter"]["PERUSAHAAN"][$value]) ? $q["Rujukan Dokter"]["PERUSAHAAN"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Paramedis"]["DINAS"][$value]) ? $q["Rujukan Paramedis"]["DINAS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Paramedis"]["UMUM"][$value]) ? $q["Rujukan Paramedis"]["UMUM"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Paramedis"]["BPJS"][$value]) ? $q["Rujukan Paramedis"]["BPJS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Paramedis"]["PERUSAHAAN"][$value]) ? $q["Rujukan Paramedis"]["PERUSAHAAN"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Puskesmas"]["DINAS"][$value]) ? $q["Rujukan Puskesmas"]["DINAS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Puskesmas"]["UMUM"][$value]) ? $q["Rujukan Puskesmas"]["UMUM"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Puskesmas"]["BPJS"][$value]) ? $q["Rujukan Puskesmas"]["BPJS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Puskesmas"]["PERUSAHAAN"][$value]) ? $q["Rujukan Puskesmas"]["PERUSAHAAN"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Kepolisian"]["DINAS"][$value]) ? $q["Rujukan Kepolisian"]["DINAS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Kepolisian"]["UMUM"][$value]) ? $q["Rujukan Kepolisian"]["UMUM"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Kepolisian"]["BPJS"][$value]) ? $q["Rujukan Kepolisian"]["BPJS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Kepolisian"]["PERUSAHAAN"][$value]) ? $q["Rujukan Kepolisian"]["PERUSAHAAN"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Lain"]["DINAS"][$value]) ? $q["Rujukan Lain"]["DINAS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Lain"]["UMUM"][$value]) ? $q["Rujukan Lain"]["UMUM"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Lain"]["BPJS"][$value]) ? $q["Rujukan Lain"]["BPJS"][$value] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q["Rujukan Lain"]["PERUSAHAAN"][$value]) ? $q["Rujukan Lain"]["PERUSAHAAN"][$value] : "-");
                                ?>
                              </td>
                            </tr>
                      <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>GRAFIK CARA MASUK TAHUNAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div id="chartdiv_tahun" style="height : 400px"></div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header"><h3>TABEL GRAFIK CARA MASUK TAHUNAN RAWAT INAP</h3></div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr class='bg-navy'>
                            <th class="text-center" rowspan="2">Bulan</th>
                            <th class="text-center" colspan="4">Sendiri</th>
                            <th class="text-center" colspan="4">RS</th>
                            <th class="text-center" colspan="4">Dokter</th>
                            <th class="text-center" colspan="4">Paramedis</th>
                            <th class="text-center" colspan="4">Puskesmas</th>
                            <th class="text-center" colspan="4">Kepolisian</th>
                            <th class="text-center" colspan="4">Lain</th>
                        </tr>
                        <tr class="bg-navy">
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
                        <?php
                            $bln = array("1","2","3","4","5","6","7","8","9","10",
                                            "11","12");
                        ?>
                        <?php foreach ($bln as $key1 => $value1): ?>
                            <?php
                                $bulan = array(
                                              '1'   => "Januari", 
                                              '2'   => "Februari",
                                              '3'   => "Maret",
                                              '4'   => "April",
                                              '5'   => "Mei",
                                              '6'   => "Juni",
                                              '7'   => "Juli",
                                              '8'   => "Agustus",
                                              '9'   => "September",
                                              '10'  => "Oktober",
                                              '11'  => "November",
                                              '12'  => "Desember",
                                            );
                            ?>
                            <tr>
                              <td>
                                <?php echo $bulan[$value1] ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Datang Sendiri"]["DINAS"][$value1]) ? $q1["Datang Sendiri"]["DINAS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Datang Sendiri"]["UMUM"][$value1]) ? $q1["Datang Sendiri"]["UMUM"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Datang Sendiri"]["BPJS"][$value1]) ? $q1["Datang Sendiri"]["BPJS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Datang Sendiri"]["PERUSAHAAN"][$value1]) ? $q1["Datang Sendiri"]["PERUSAHAAN"][$value1] : "-");
                                ?>
                              </td>

                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan RS"]["DINAS"][$value1]) ? $q1["Rujukan RS"]["DINAS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan RS"]["UMUM"][$value1]) ? $q1["Rujukan RS"]["UMUM"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan RS"]["BPJS"][$value1]) ? $q1["Rujukan RS"]["BPJS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan RS"]["PERUSAHAAN"][$value1]) ? $q1["Rujukan RS"]["PERUSAHAAN"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Dokter"]["DINAS"][$value1]) ? $q1["Rujukan Dokter"]["DINAS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Dokter"]["UMUM"][$value1]) ? $q1["Rujukan Dokter"]["UMUM"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Dokter"]["BPJS"][$value1]) ? $q1["Rujukan Dokter"]["BPJS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Dokter"]["PERUSAHAAN"][$value1]) ? $q1["Rujukan Dokter"]["PERUSAHAAN"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Paramedis"]["DINAS"][$value1]) ? $q1["Rujukan Paramedis"]["DINAS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Paramedis"]["UMUM"][$value1]) ? $q1["Rujukan Paramedis"]["UMUM"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Paramedis"]["BPJS"][$value1]) ? $q1["Rujukan Paramedis"]["BPJS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Paramedis"]["PERUSAHAAN"][$value1]) ? $q1["Rujukan Paramedis"]["PERUSAHAAN"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Puskesmas"]["DINAS"][$value1]) ? $q1["Rujukan Puskesmas"]["DINAS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Puskesmas"]["UMUM"][$value1]) ? $q1["Rujukan Puskesmas"]["UMUM"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Puskesmas"]["BPJS"][$value1]) ? $q1["Rujukan Puskesmas"]["BPJS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Puskesmas"]["PERUSAHAAN"][$value1]) ? $q1["Rujukan Puskesmas"]["PERUSAHAAN"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Kepolisian"]["DINAS"][$value1]) ? $q1["Rujukan Kepolisian"]["DINAS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Kepolisian"]["UMUM"][$value1]) ? $q1["Rujukan Kepolisian"]["UMUM"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Kepolisian"]["BPJS"][$value1]) ? $q1["Rujukan Kepolisian"]["BPJS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Kepolisian"]["PERUSAHAAN"][$value1]) ? $q1["Rujukan Kepolisian"]["PERUSAHAAN"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Lain"]["DINAS"][$value1]) ? $q1["Rujukan Lain"]["DINAS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Lain"]["UMUM"][$value1]) ? $q1["Rujukan Lain"]["UMUM"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Lain"]["BPJS"][$value1]) ? $q1["Rujukan Lain"]["BPJS"][$value1] : "-");
                                ?>
                              </td>
                              <td class='text-center'>
                                <?php
                                  echo (isset($q1["Rujukan Lain"]["PERUSAHAAN"][$value1]) ? $q1["Rujukan Lain"]["PERUSAHAAN"][$value1] : "-");
                                ?>
                              </td>
                            </tr>
                      <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<style type="text/css">
    #chartdiv > div > div > a { display: none !important; }
    #chartdiv_bulan > div > div > a { display: none !important; }
    #chartdiv_tahun > div > div > a { display: none !important; }
    .ui-datepicker-month, .ui-datepicker-year{
        color: #1e1b1d;
    }
</style>
<!-- Styles -->
<style>
#chartdiv {
  height: 500px;
}
</style>

<!-- Resources -->
<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script> -->
<!-- <script src="https://www.amcharts.com/lib/3/plugins/animate/animate.min.js"></script> -->

<!-- Chart code -->
<script>
    $(document).ready(function() {
        console.log(<?php echo $graph;?>);
            var chartData = [
      [{
        "answer": "Datang Sendiri",
        "value": <?php echo $sendiri->sendiri; ?>,
        "color": "#FF6347"
      }, {
        "answer": "Rujukan RS",
        "value": <?php echo $rs->rs; ?>,
        "color": "#357cd2"
      }, {
        "answer": "Rujukan Dokter",
        "value": <?php echo $dokter->dokter; ?>,
        "color": "#40E0D0"
      }, {
        "answer": "Rujukan Paramedis",
        "value": <?php echo $paramedis->paramedis; ?>,
        "color": "#FFB6C1"
      }, {
        "answer": "Rujukan Puskesmas",
        "value": <?php echo $puskesmas->puskesmas; ?>,
        "color": "#FFA07A"
      }, {
        "answer": "Rujukan Kepolisian",
        "value": <?php echo $kepolisian->kepolisian; ?>,
        "color": "#FFC0CB"
      },{
        "answer": "Rujukan Lain",
        "value": <?php echo $lain->lain; ?>,
        "color": "#DDA0DD"
      }]
    ];

    var chart = AmCharts.makeChart("chartdiv", {
      "type": "pie",
      "startDuration": 0,
      "theme": "none",
      "balloon":{
        "adjustBorderColor":false,
        "color":"#FFFFFF"
      },
      "addClassNames": true,
      "innerRadius": "30%",
      "pullOutRadius": 0,
      "autoMargins": false,
      "marginTop": 50,
      "marginBottom": 30,
      "marginLeft": 0,
      "marginRight": 0,
      "color": "#357cd2",
      "fontSize":16,
      "outlineThickness":2,
      "outlineAlpha":1,
      "dataProvider": chartData[0],
      "valueField": "value",
      "titleField": "answer",
      "colorField": "color",
        "listeners": [ {
        "event": "init",
        "method": function( e ) {
          var chart = e.chart, current = 0;
          
          function getCurrentData() {
            var data = chartData[current];
            current++;
            if (current > (chartData.length - 1) )
              current = 0;
            return data;
          }

          // function loop() {
          //   var data = getCurrentData();
          //   chart.animateData( data, {
          //     duration: 1000,
          //     complete: function() {
          //       setTimeout( loop, 2000 );
          //     }
          //   } );
          // }

          // loop();
        }
      } ]
    });
    console.log(<?php echo $graph;?>);
        var chart = AmCharts.makeChart("chartdiv_bulan", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 7,
                "position": "bottom",
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": <?php echo $graph;?>,
            "valueAxes": [{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Cara Masuk",
                },{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Sendiri",
                "columnWidth":0.5,
                "valueField": "inap",
                "valueAxis": "inap",
                "lineColor": "#3c8dbc",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "RS",
                "columnWidth":0.5,
                "valueField": "r",
                "valueAxis": "r",
                "lineColor": "#32CD32",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Dokter",
                "columnWidth":0.5,
                "valueField": "dok",
                "lineColor": "#f56954",
                "valueAxis": "dok"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Paramedis",
                "columnWidth":0.5,
                "valueField": "par",
                "lineColor": "#008080",
                "valueAxis": "par"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Puskesmas",
                "columnWidth":0.5,
                "valueField": "pus",
                "lineColor": "#F4A460",
                "valueAxis": "pus"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Kepolisian",
                "columnWidth":0.5,
                "valueField": "ke",
                "lineColor": "#FFA500",
                "valueAxis": "ke"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Lain",
                "columnWidth":0.5,
                "valueField": "lai",
                "lineColor": "#DA70D6",
                "valueAxis": "lai"
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "hari",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 360,
                "autoGridCount": true,
                "gridCount": 34
            },
            "export": {
                "enabled": true
             }
        });

    console.log(<?php echo $graph_tahun;?>);
        var chart = AmCharts.makeChart("chartdiv_tahun", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 7,
                "position": "bottom",
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": <?php echo $graph_tahun;?>,
            "valueAxes": [{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                    "title": "Cara Masuk",
                },{
                    "id": "inap",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left",
                }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Sendiri",
                "columnWidth":0.5,
                "valueField": "inap",
                "valueAxis": "inap",
                "lineColor": "#3c8dbc",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "RS",
                "columnWidth":0.5,
                "valueField": "r",
                "valueAxis": "r",
                "lineColor": "#32CD32",
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Dokter",
                "columnWidth":0.5,
                "valueField": "dok",
                "lineColor": "#f56954",
                "valueAxis": "dok"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Paramedis",
                "columnWidth":0.5,
                "valueField": "par",
                "lineColor": "#008080",
                "valueAxis": "par"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Puskesmas",
                "columnWidth":0.5,
                "valueField": "pus",
                "lineColor": "#F4A460",
                "valueAxis": "pus"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Kepolisian",
                "columnWidth":0.5,
                "valueField": "ke",
                "lineColor": "#FFA500",
                "valueAxis": "ke"
            },{
                "balloonText": "[[category]] : <b>[[value]]</b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineThickness": 2,
                "type": "smoothedLine",
                "title": "Lain",
                "columnWidth":0.5,
                "valueField": "lai",
                "lineColor": "#DA70D6",
                "valueAxis": "lai"
            }],
            "plotAreaFillAlphas": 0.1,
            "categoryField": "hari",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 360,
                "autoGridCount": true,
                "gridCount": 34
            },
            "export": {
                "enabled": true
             }
        });

});
</script>