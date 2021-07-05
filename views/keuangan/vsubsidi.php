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
            var url = "<?php echo site_url("keuangan/subsidi");?>/"+tgl;
            window.location = url;
        })
        $(".cetak").click(function(){
            var tgl = $("[name='tgl']").val();
            var url = "<?php echo site_url('keuangan/cetak_subsidi')?>/"+tgl;
            openCenteredWindow(url);
        });
        $(".excel").click(function(){
            var tgl = $("[name='tgl']").val();
            var url = "<?php echo site_url('keuangan/excel_subsidi')?>/"+tgl;
            window.location = url;
        });
        $(".cetakdetail").click(function(){
            var pelayanan = $("[name='pelayanan']").val();
            var tgl = $("[name='tgl']").val();
            var url = "<?php echo site_url('keuangan/cetakdetail_subsidi')?>/"+tgl+"/"+pelayanan;
            openCenteredWindow(url);
        });
        $(".exceldetail").click(function(){
            var pelayanan = $("[name='pelayanan']").val();
            var tgl = $("[name='tgl']").val();
            var url = "<?php echo site_url('keuangan/exceldetail_subsidi')?>/"+tgl+"/"+pelayanan;
            window.location = url;
        });
        $(".detail").click(function(){
            var pelayanan = $(this).attr("pelayanan");
            listpasien(pelayanan);
        });
    });
    function listpasien(pelayanan){
        $(".modaldetail").modal("show");
        $(".listdetail").html("");
        $("[name='pelayanan']").val(pelayanan);
        var tgl = $("[name='tgl']").val();
        var html = "";
        $.ajax({
            url : "<?php echo base_url();?>keuangan/detailpasien",
            method : "POST",
            data : {pelayanan: pelayanan,tgl: tgl},
            success: function(data){
                $.each(JSON.parse(data),function(key,val){
                    html += "<tr>";
                    html += "<td>"+(key+1)+"</td>";
                    html += "<td>"+val.no_reg+"</td>";
                    html += "<td>"+val.nama_pasien+"</td>";
                    html += "<td>"+val.gol_pasien+"</td>";
                    html += "<td>"+val.poliklinik+"</td>";
                    html += "</tr>";
                });
                console.log(html);
                $(".listdetail").html(html);
            },
            error: function(data){
                console.log(data);
            }           
        });
    }
</script>
<?php
    $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-1 control-label">Periode</label>
                        <div class="col-md-2">
                                <input type="text" class="form-control input-sm" name="tgl" value="<?php echo date("m-Y",strtotime($tgl));?>" autocomplete="off"/>
                        </div>
                        <div class="col-md-2"><button class="search btn btn-sm btn-primary" type="button"> <i class="fa fa-search"></i> Search</button></div>
                        <div class="col-md-2">
                            <div class="btn-group">
                                <button type="button" class="cetak btn btn-sm btn-info"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
                                <button type="button" class="excel btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table  width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="2">
                        SUBSIDI RUMAH SAKIT KEPADA PASIEN DINAS
                    </td>
                    <td></td>
                </tr>
                <tr><td class="text-center" colspan="2">PERIODE : <?php echo $bulan[(int)date("m",strtotime($tgl))]." ".date("Y",strtotime($tgl)); ?></td></tr>
                <tr><td class="text-center" colspan="2">&nbsp;</td></tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr class="bg-navy">
                            <th class="text-center" style="vertical-align:middle" rowspan="3">No.</th>
                            <th class="text-center" style="vertical-align:middle" rowspan="3" width="200px">Uraian</th>
                            <th class="text-center" style="vertical-align:middle" rowspan="3">Jumlah Pasien Dinas</th>
                            <th class="text-center" style="vertical-align:middle" colspan="4">Subsidi Rumah Sakit</th>
                            <th class="text-center" style="vertical-align:middle" rowspan="2" colspan="2">Jumlah</th>
                        </tr>
                        <tr class="bg-navy">
                            <th class="text-center" colspan="2">Selisih Tarif RS dengan Tarif INA-CBG's</th>
                            <th class="text-center" colspan="2">Pasien Yang Tidak Bisa Diklaim Ke BPJS (INA-CBG's)</th>
                        </tr>
                        <tr class="bg-navy">
                            <th class="text-center" style="vertical-align:middle">Pasien (orang)</th>
                            <th class="text-center" style="vertical-align:middle">Jumlah (Rp)</th>
                            <th class="text-center" style="vertical-align:middle">Pasien (orang)</th>
                            <th class="text-center" style="vertical-align:middle">Jumlah (Rp)</th>
                            <th class="text-center" style="vertical-align:middle">Pasien (orang) (4+6)</th>
                            <th class="text-center" style="vertical-align:middle">Jumlah (Rp) (5+7)</th>
                        </tr>
                        <tr class="bg-navy">
                            <th class="text-center">1</th>
                            <th class="text-center">2</th>
                            <th class="text-center">3</th>
                            <th class="text-center">4</th>
                            <th class="text-center">5</th>
                            <th class="text-center">6</th>
                            <th class="text-center">7</th>
                            <th class="text-center">8</th>
                            <th class="text-center">9</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center"></th>
                            <th>Bulan <?php echo $bulan[(int)date("m",strtotime($tgl))]." ".date("Y",strtotime($tgl)); ?></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-right"></th>
                            <th class="text-center"></th>
                            <th class="text-right"></th>
                            <th class="text-center"></th>
                            <th class="text-right"></th>
                        </tr>
                        <tr class="detail" pelayanan="ralan">
                            <th class="text-center">1</th>
                            <th>Rawat Jalan</th>
                            <th class="text-center"><?php echo number_format($q["total_ralan"],0);?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_ralan"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_ralan"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["dinas_ralan"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["dinas_ralan"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"],0,',','.');?></th>
                        </tr>
                        <tr class="detail" pelayanan="ranap">
                            <th class="text-center">2</th>
                            <th>Rawat Inap</th>
                            <th class="text-center"><?php echo number_format($q["total_inap"],0);?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_inap"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["dinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["dinas_inap"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></th>
                        </tr>
                        <tr>
                            <th class="text-center"></th>
                            <th>Jumlah</th>
                            <th class="text-center"><?php echo number_format($q["total_ralan"]+$q["total_inap"],0);?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["dinas_ralan"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["dinas_ralan"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></th>
                        </tr>
                        <tr>
                            <th class="text-center">&nbsp;</th>
                            <th>&nbsp;</th>
                            <th class="text-center">&nbsp;</th>
                            <th class="text-center">&nbsp;</th>
                            <th class="text-right">&nbsp;</th>
                            <th class="text-center">&nbsp;</th>
                            <th class="text-right">&nbsp;</th>
                            <th class="text-center">&nbsp;</th>
                            <th class="text-right">&nbsp;</th>
                        </tr>
                        <tr>
                            <th class="text-center"></th>
                            <th>Total</th>
                            <th class="text-center"><?php echo number_format($q["total_ralan"]+$q["total_inap"],0);?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["dinas_ralan"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["dinas_ralan"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></th>
                            <th class="text-center"><?php echo number_format($q["nondinas_ralan"]["pasien"]+$q["dinas_ralan"]["pasien"]+$q["nondinas_inap"]["pasien"]+$q["dinas_inap"]["pasien"],0);?></th>
                            <th class="text-right"><?php echo number_format($q["nondinas_ralan"]["rupiah"]+$q["dinas_ralan"]["rupiah"]+$q["nondinas_inap"]["rupiah"]+$q["dinas_inap"]["rupiah"],0,',','.');?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:90%">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                Detail Pasien
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="pull-right">
                            <div class="btn-group">
                                <input type="hidden" name="pelayanan">
                                <button type="button" class="cetakdetail btn btn-sm btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
                                <button type="button" class="exceldetail btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel</button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                </div>
                <div class="table-responsive">
                    <input type="hidden" name="id_dokter">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class='bg-navy'>
                                <th>No</th>
                                <th>No. Reg</th>
                                <th>Nama Pasien</th>
                                <th class="text-center">Gol Pasien</th>
                                <th class="text-center">Poliklinik</th>
                            </tr>
                        </thead>
                        <tbody class="listdetail">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .ui-datepicker-month, .ui-datepicker-year{
        color: #1e1b1d;
    }
</style>