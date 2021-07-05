<script type="text/javascript">
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
            var tahun = $("[name='tahun']").val();
            var url = "<?php echo site_url('laporan/cetak_rl2_ketenagaan')?>/"+tahun;
            openCenteredWindow(url);
        });
         $("[name='tahun'],[name='parent']").change(function(){
            var tahun = $("[name='tahun']").val();
            var parent = $("[name='parent']").val();
            window.location = "<?php echo site_url("laporan/rl2_ketenagaan");?>/"+parent+"/"+tahun;
        });
    });  
</script>
<div class="col-xs-12">
    <?php echo form_open("laporan/simpanrl2_ketenagaan");?>
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Kode</label>
                    <div class="col-md-4">
                        <select name='parent' class="form-control">
                        <?php
                            foreach ($n->result() as $row) {
                                echo "<option value='".$row->kode."' ".($parent==$row->kode ? "selected" : "").">".$row->keterangan."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <label class="col-md-1 control-label">Tahun</label>
                    <div class="col-md-2">
                        <select name='tahun' class="form-control">
                        <?php
                            $thn_ini = date("Y");
                            for ($i=($thn_ini-10);$i<=($thn_ini+10);$i++) {
                                echo "<option value='".$i."' ".($tahun==$i ? "selected" : "").">".$i."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="print btn btn-primary">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="laporan table table-bordered table-striped" width="100%">
            <thead class="bg-navy">
                <tr>
                    <!-- <th>Kode RS</th>
                    <th>Kota</th>
                    <th>Provinsi</th>
                    <th>Nama RS</th> -->
                    <th>Tahun</th>
                    <th>Kode</th>
                    <th>Kualifikasi Pendidikan</th>
                    <th>Keadaan Laki-Laki</th>
                    <th>Keadaan Perempuan</th>
                    <th>Kebutuhan Laki-Laki</th>
                    <th>Kebutuhan Perempuan</th>
                    <th>Kekurangan Laki-Laki</th>
                    <th>Kekurangan Perempuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($k["parent"] as $key => $value) {
                        echo "<tr class='bg-orange'>";
                        // echo "<td>3274020</td>";
                        // echo "<td>KOTA CIREBON</td>";
                        // echo "<td>JAWA BARAT</td>";
                        // echo "<td>RS CIREMAI</td>";
                        echo "<td>".$tahun."</td>";
                        echo "<td>".$key."</td>";
                        echo "<td>".$value->keterangan."</td>";
                        echo "<td class='text-right'><input type='number' value='".(isset($p[0][$key]) ? $p[0][$key]->keadaan_laki : 0)."' name='keadaan_laki_".$value->parent."_".$key."' class='form-control'></td>";
                        echo "<td class='text-right'><input type='number' value='".(isset($p[0][$key]) ? $p[0][$key]->keadaan_perempuan : 0)."' name='keadaan_perempuan_".$value->parent."_".$key."' class='form-control'></td>";
                        echo "<td class='text-right'><input type='number' value='".(isset($p[0][$key]) ? $p[0][$key]->kebutuhan_laki : 0)."' name='kebutuhan_laki_".$value->parent."_".$key."' class='form-control'></td>";
                        echo "<td class='text-right'><input type='number' value='".(isset($p[0][$key]) ? $p[0][$key]->kebutuhan_perempuan : 0)."' name='kebutuhan_perempuan_".$value->parent."_".$key."' class='form-control'></td>";
                        echo "<td class='text-right'><input type='number' value='".(isset($p[0][$key]) ? $p[0][$key]->kekurangan_laki : 0)."' name='kekurangan_laki_".$value->parent."_".$key."' class='form-control'></td>";
                        echo "<td class='text-right'><input type='number' value='".(isset($p[0][$key]) ? $p[0][$key]->kekurangan_perempuan : 0)."' name='kekurangan_perempuan_".$value->parent."_".$key."' class='form-control'></td>";
                        echo "</tr>";
                        foreach ($k['child'][$key] as $kode => $row) {
                            echo "<tr>";
                            // echo "<td>3274020</td>";
                            // echo "<td>KOTA CIREBON</td>";
                            // echo "<td>JAWA BARAT</td>";
                            // echo "<td>RS CIREMAI</td>";
                            echo "<td>".$tahun."</td>";
                            echo "<td>".$kode."</td>";
                            echo "<td>".$row->keterangan."</td>";
                            echo "<td class='text-right'><input type='number' value='".(isset($p[$key][$kode]) ? $p[$key][$kode]->keadaan_laki : 0)."' name='keadaan_laki_".$key."_".$kode."' class='form-control'></td>";
                            echo "<td class='text-right'><input type='number' value='".(isset($p[$key][$kode]) ? $p[$key][$kode]->keadaan_perempuan : 0)."' name='keadaan_perempuan_".$key."_".$kode."' class='form-control'></td>";
                            echo "<td class='text-right'><input type='number' value='".(isset($p[$key][$kode]) ? $p[$key][$kode]->kebutuhan_laki : 0)."' name='kebutuhan_laki_".$key."_".$kode."' class='form-control'></td>";
                            echo "<td class='text-right'><input type='number' value='".(isset($p[$key][$kode]) ? $p[$key][$kode]->kebutuhan_perempuan : 0)."' name='kebutuhan_perempuan_".$key."_".$kode."' class='form-control'></td>";
                            echo "<td class='text-right'><input type='number' value='".(isset($p[$key][$kode]) ? $p[$key][$kode]->kekurangan_laki : 0)."' name='kekurangan_laki_".$key."_".$kode."' class='form-control'></td>";
                            echo "<td class='text-right'><input type='number' value='".(isset($p[$key][$kode]) ? $p[$key][$kode]->kekurangan_perempuan : 0)."' name='kekurangan_perempuan_".$key."_".$kode."' class='form-control'></td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php echo form_close();?>
</div>