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
            var url = "<?php echo site_url('laporan/cetak_rl32_rawatdarurat')?>/"+tahun;
            openCenteredWindow(url);
        });
         $("[name='tahun']").change(function(){
            var tahun = $("[name='tahun']").val();
            window.location = "<?php echo site_url("laporan/rl32_rawatdarurat");?>/"+tahun;
        });
    });  
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
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
                        <button type="button" class="print btn btn-block btn-success"><i class="fa fa-print">&nbsp;&nbsp;Cetak</i></button>
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
                    <th>No</th>
                    <th>Jenis Pelayanan</th>
                    <th>Total Rujukan</th>
                    <th>Total Nonrujukan</th>
                    <th>Tindak Lanjut Pelayanan Dirawat</th>
                    <th>Tindak Lanjut Pelayanan Pulang</th>
                    <th>Mati di IGD</th>
                    <th>DOA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($k as $key => $value) {
                        echo "<tr>";
                        // echo "<td>3274020</td>";
                        // echo "<td>KOTA CIREBON</td>";
                        // echo "<td>JAWA BARAT</td>";
                        // echo "<td>RS CIREMAI</td>";
                        echo "<td>".$tahun."</td>";
                        echo "<td>".$key."</td>";
                        echo "<td>".$value."</td>";
                        echo "<td class='text-right'>".number_format($q["total_rujuk"][$key],0)."</td>";
                        echo "<td class='text-right'>".number_format($q["total_ralan"][$key]+$q["total_ranap"][$key],0)."</td>";
                        echo "<td class='text-right'>".number_format($q["total_ralan"][$key],0)."</td>";
                        echo "<td class='text-right'>".number_format($q["total_ranap"][$key],0)."</td>";
                        echo "<td class='text-right'>".number_format($q["total_matiigd"][$key],0)."</td>";
                        echo "<td class='text-right'>".number_format($q["total_doa"][$key],0)."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>