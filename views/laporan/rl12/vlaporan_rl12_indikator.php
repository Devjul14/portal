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
                        <div class="btn-group">
                            <button type="submit" class="view btn btn-success">View</button>
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
                    <th>BOR</th>
                    <th>LOS</th>
                    <th>BTO</th>
                    <th>TOI</th>
                    <th>NDR</th>
                    <th>GDR</th>
                    <th>Ratakunjungan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($k["parent"] as $key => $value) {
                        
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>