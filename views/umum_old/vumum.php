<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".notif_umum").hide();
        $("select[name='hal']").change(function(){
            $("#formcari").submit();
            return false;
        });
        var delay = 5000; //Your delay in milliseconds
        var jmlrec = <?php echo $jmlrec;?>;
        var title = "<?php echo $title;?>";
        var message = "<div class=notif><div class='callout callout-warning'><p>Ada <strong class='text-red'>"+jmlrec+" pasien</strong> yang belum diperiksa</p></div></div>";
        if (jmlrec>0){
            $(document).attr("title", "("+jmlrec+") "+title);
            $(".notif_umum").html(message);
        } else {
            $(document).attr("title", title);
            $(".notif_umum").html("");
        }
        setInterval(function(){ 
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var baris = $("input[name='baris']").val();
            var hal = $("select[name='hal']").val();
            view_umum(tgl1,tgl2,baris,hal);
            notif_umum(tgl1,tgl2,baris,hal);
        }, delay);
        $("button[name='next']").click(function(){
            var hal = $("select[name='hal']").val();
            hal++;
            $("select[name='hal']").val(hal);
            $("#formcari").submit();
            return false;
        });
        $("button[name='prev']").click(function(){
            var hal = $("select[name='hal']").val();
            hal--;
            $("select[name='hal']").val(hal);
            $("#formcari").submit();
            return false;
        });
        $("input[name='no_kk']").change(function(){
            var no_kk = $(this).val();
            var id_puskesmas = $("select[name='id_puskesmas']").val();
            $("#nama_pasien").load("<?php echo site_url('pendaftaran/getlistpasien');?>/"+id_puskesmas+"/"+no_kk);
            $("#nama_kk").load("<?php echo site_url('pendaftaran/getnamakk');?>/"+id_puskesmas+"/"+no_kk+"/Y");
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({ dateFormat : formattgl });
        $("input[name='tgl2']").datepicker({ dateFormat : formattgl });
    });
    var view_umum = function(tgl1,tgl2,baris,hal){
        var arrayData = {tgl1: tgl1, tgl2: tgl2, baris: baris, hal: hal};
        $.ajax({
            url: "<?php echo site_url('umum/view_umum');?>", 
            type: 'POST', 
            data: arrayData, 
            success: function(hasil){
                $(".view_umum").html(hasil);
            }
        });
    };
    var notif_umum = function(tgl1,tgl2,baris,hal){
        var arrayData = {tgl1: tgl1, tgl2: tgl2, baris: baris, hal: hal};
        $.ajax({
            url: "<?php echo site_url('umum/notif_umum');?>", 
            type: 'POST', 
            data: arrayData, 
            success: function(jmlrec){
                var title = "<?php echo $title;?>";
                var message = "<div class=notif><div class='callout callout-warning'><p>Ada <strong class='text-red'>"+jmlrec+" pasien</strong> yang belum diperiksa</p></div></div>";
                if (jmlrec>0){
                    $(".jmlrec").html(jmlrec);
                    $(document).attr("title", "("+jmlrec+") "+title);
                    $('.notif_umum').fadeIn('slow').delay(3000).fadeOut(100);
                    $('#chatAudio')[0].play();
                    $(".notif_umum").html(message);
                } else {
                    $(document).attr("title", title);
                    $(".notif_umum").html("");
                }
            }
        });
    };
</script>
<audio id="chatAudio">
    <source src="<?php echo base_url();?>sound/audio.mp3" type="audio/mp3">
</audio>
<style type="text/css">
    .notif > .callout {
        position: fixed;
        right: 0;
        bottom: 0;
        margin-right: 30px;
        z-index: 1050;
    }
</style>
    <div class="notif_umum"></div>
    <div class="col-lg-12">
        <?php
            if($this->session->flashdata('message')){
                $pesan=explode('-', $this->session->flashdata('message'));
                echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>".$pesan[1]."</b>
                </div>";
            }
        ?>
        <div class="box box-primary">
            <div class="box-body" >
                <div class="form-horizontal">
                <?php echo form_open("umum",array("id"=>"formcari"));?>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tanggal</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" name="tgl1" class="form-control" value="<?php echo $tgl1?>">
                                <span class="input-group-addon">s.d</span>
                                <input type="text" name="tgl2" class="form-control" value="<?php echo $tgl2?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tampilkan Perhalaman</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" name="baris" class="form-control" value="<?=$baris;?>">
                                <span class="input-group-btn"><button class="btn btn-success" type="submit"><i class="fa fa-search"></i> View</button></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Ke Halaman</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="hal">
                                <?php
                                    for($i=1;$i<=$npage;$i++){
                                        if($i==$hal) $sel=" selected "; else $sel=""; 
                                        echo "<option value='".$i."'" . $sel ."> $i </option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="box-footer">
                <div class="text-center">
                    <div class="btn-group">
                        <button class="btn btn-warning" type="button" name="prev"><i class="fa fa-arrow-left"></i> Prev</button>
                        <button class="btn btn-warning" type="button" name="next"><i class="fa fa-arrow-right"></i> Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="box box-primary">
            <?php echo form_close(); ?>
            <div class="box-body">
                <div class='view_umum'>
                <table class="table table-bordered table-hover" id="myTable">
                    <thead>
                        <tr class="bg-navy">
                           <th width="20" class="text-center">No</th>
                           <th width="100" class="text-center">Tgl</th>
                           <th width="69" class="text-center">No. KK</th>
                           <th width="120" class="text-center">No. Pasien</th>
                           <th class="text-center">Nama</th>
                           <th width="50" class="text-center">P</th>
                           <th width="50" class="text-center">C</th>
                           <th width="140" class="text-center">Layanan</th>
                           <th width="100" class="text-center">Medis</th>
                         </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = $posisi;
                            $no_kk = '';
                            foreach ($q->result() as $row){
                                $i++;
                                echo "<tr id=data href='".$row->no_kk."/".$row->id_pasien."'>
                                      <td align=center>".$i."</td>
                                      <td align=center>".$row->tanggal."</td>";
                                if ($no_kk<>$row->no_kk){ 
                                    echo "<td align=center>".$row->no_kk."</td>";
                                    $no_kk = $row->no_kk;
                                }
                                else
                                    echo "<td class=text-center>&nbsp;</td>";
                                echo "<td class=text-center>".$row->no_pasien."</td>
                                      <td>".anchor("umum/umumdetail/".$row->id_pendaftaran,$row->nama_pasien,array("class"=>"btn btn-sm btn-success"))."&nbsp;&nbsp;"
                                           .anchor("umum/batalperiksa/".$row->id_pendaftaran,"BATAL",array("class"=>"btn btn-sm btn-danger"))."</td>
                                      <td class=text-center>".$row->isperiksa."</td>
                                      <td class=text-center>".$row->iscatat."</td>
                                      <td class=text-center>".$row->layanan."</td>
                                      <td class=text-center>".$row->nama_paramedis."</td>
                                      </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>