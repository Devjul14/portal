<script>
    $(document).ready(function() { 
        $("[name='tgl']").datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'mm-yy',
            onClose: function(dateText, inst) { 
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
        });
        $("[name='tgl']").focus(function () {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });
        $(".search").click(function(){
            var tgl = $("[name='tgl']").val();
            var kota = $("[name='kota']").val();
            var url = "<?php echo site_url("keuangan/index");?>/"+tgl;
            window.location = url;
        })
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open("keuangan/simpan");?>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label">Tanggal</label>
                    <div class="col-md-2">
                            <input type="text" class="form-control" name="tgl" value="<?php echo date("m-Y",strtotime($tgl));?>" autocomplete="off"/>
                    </div>
                    <div class="col-md-2"><button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i> Search</button></div>
                    <div class="col-md-2"><button class="simpan btn btn-success" type="submit"> <i class="fa fa-save"></i> Simpan</button></div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr class="bg-navy">
                            <th class='text-center'>ID Dokter</th>
                            <th>Nama Dokter</th>
                            <th class='text-center'>Jasa</th>
                            <th class='text-center' width=150px>Jumlah Pajak (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rw = $q["detail"];
                            $tr = $q["tarifrs"];
                            $td = $q["tarifdokter"];
                            $tu = $q["tarifdokterumum"];
                            $gp = $q["golpas"];
                            $namatd = $q["namatarifdokter"];
                            foreach($d->result() as $row){
                                $total = 0;
                                $total_umum_ralan = $total_bpjs_ralan = $total_perusahaan_ralan = 0;
                                $total_umum_ranap = $total_bpjs_ranap = $total_perusahaan_ranap = 0;
                                foreach($rw[$row->id_dokter] as $rkey => $rvalue){
                                    foreach($rvalue as $ktarif => $val){
                                        if ($val->gol_pasien==11){
                                            $tarif_rs = $tr[$ktarif][$rkey];
                                        }
                                        else{
                                            $tarif_rs = $val->tarif_rumahsakit;
                                        }
                                        $persen = ($val->tarif_bpjs/$tarif_rs)*100;
                                        if ($val->tarif_bpjs=="") $persen = 100;
                                        $prs = $persen>100 ? 100 : round($persen,2);
                                        if ($namatd[$ktarif]=="PEMERIKSAAN DOKTER" && $val->gol_pasien==11)
                                            $bruto = (($tr[$ktarif][$rkey]*$prs)/100)*$tu[$ktarif]/100;  
                                        else  
                                            $bruto = (($tr[$ktarif][$rkey]*$prs)/100)*$td[$ktarif]/100;
                                        $total += $bruto;
                                    }
                                }
                                echo "<tr>";
                                echo "<td class='text-center'>".$row->id_dokter."</td>";
                                echo "<td>".$row->nama_dokter."</td>";
                                echo "<td class='text-right'>".number_format($total,0,',','.')."</td>";
                                echo "<td><input type='text' name='pajak[".$row->id_dokter."]' class='pajak form-control' value='".(isset($p[$row->id_dokter][$tgl]) ? $p[$row->id_dokter][$tgl] : 0)."'></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<style type="text/css">
    .ui-datepicker-month, .ui-datepicker-year{
        color: #1e1b1d;
    }
</style>