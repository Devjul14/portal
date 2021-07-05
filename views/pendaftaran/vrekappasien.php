<script>
var mywindow;
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
    $(document).ready(function(){
        $('#myTable').fixedHeaderTable({ height: '250', altClass: 'odd', footer: true});
        $('#myTable1').fixedHeaderTable({ height: '250', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        var tgl1 = $("input[name='tgl1']").val();
        var tgl2 = $("input[name='tgl2']").val();
        var jenis = $("select[name='jenis']").val();
        var umur = $("input[name='umur']").val();
        var url = tgl1+"/"+tgl2+"/"+jenis+"/"+umur;
        $("#rekap").load("<?php echo site_url('pendaftaran/listrekap');?>/"+url);
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".tampil").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var jenis = $("select[name='jenis']").val();
            var umur = $("input[name='umur']").val();
            var url = tgl1+"/"+tgl2+"/"+jenis+"/"+umur;
            $("#rekap").load("<?php echo site_url('pendaftaran/listrekap');?>/"+url);
            return false;
        });
        $(".cari").click(function(){
            var id = "<?php echo $this->session->userdata('id_puskesmas');?>";
            var url = "<?php echo site_url('pendaftaran/caripasien');?>/"+id;
            openCenteredWindow(url);
            return false;
        });
        $("input[name='no_kk']").change(function(){
            var no_kk = $(this).val();
            var id_puskesmas = "<?php echo $this->session->userdata('id_puskesmas');?>";
            $("#nama_pasien").load("<?php echo site_url('pendaftaran/getlistpasien');?>/"+id_puskesmas+"/"+no_kk);
            $("#nama_kk").load("<?php echo site_url('pendaftaran/getnamakk');?>/"+id_puskesmas+"/"+no_kk+"/Y");
            return false;
        });
        $(".tampil").click(function(){
            var id_pasien = $("select[name='nama_pasien']").val();
            window.location = "<?php echo site_url('pendaftaran/listrekap_pasien');?>/"+id_pasien;
            return false;
        });
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group"><label class="col-xs-3 control-label">No KK</label>
                    <div class="col-xs-9">
                        <div class="input-group">
                            <input type="text" name="no_kk" class='input-left form-control'>
                            <span class="input-group-btn"><button type='button' class='cari btn btn-right btn-info'><i class='fa fa-search'></i></button></span>
                        </div>
                    </div>
                </div>
                <div class="form-group"><label class="col-xs-3 control-label">Nama KK</label>
                    <div class="col-xs-9">
                        <span id=nama_kk><input type="text" name="namakk" class="form-control"></span>
                    </div>
                </div>
                <div class="form-group"><label class="col-xs-3 control-label">Nama Pasien</label>
                    <div class="col-xs-9">
                        <span id="nama_pasien"><select name="nama_pasien" class="form-control"></select></span>
                    </div>
                </div>
                <div class="form-group"><label class="col-xs-3 control-label"></label>
                    <div class="col-xs-9">
                        <button class="tampil btn btn-info"><i class='fa fa-search'></i>&nbsp;View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <?php echo $this->session->flashdata('message');?>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover " id="myTable" >
                <thead>
                    <tr class='bg-navy'>
                        <th width="20px">No</th>
                        <th>Nama Layanan</th>
                        <th width="130px" class='text-center'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                    foreach ($q1->result() as $row){
                        $i++;
                        if(!isset($jumlah[$row->id_layanan])) $jum = 0; else $jum = $jumlah[$row->id_layanan];
                        echo "<tr id=data>
                                <td class='text-center'>".$i."</td>
                                <td>".$row->layanan."</td>
                                <td class='text-center'>".$jum."</td>
                             </tr>";
                    }
                ?>
                </tbody>
            </table>
            <table class="table table-striped table-bordered table-hover " id="myTable1" >
                <thead>
                    <tr class="bg-navy">
                        <th width="20px">No</th>
                        <th>Status Pembayaran</th>
                        <th width="130px" class='text-center'>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 0;
                    foreach ($q2->result() as $row){
                        $i++;
                        if(!isset($jml[$row->status_pembayaran])) $jum = 0; else $jum = $jml[$row->status_pembayaran];
                        echo "<tr id=data>
                                <td class='text-center'>".$i."</td>
                                <td>".$row->status_pembayaran."</td>
                                <td class='text-center'>".$jum."</td>
                             </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>