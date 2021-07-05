<script>
  var mywindow;

  function openCenteredWindow(url) {
    var width = 1200;
    var height = 500;
    var left = parseInt((screen.availWidth / 2) - (width / 2));
    var top = parseInt((screen.availHeight / 2) - (height / 2));
    var windowFeatures = "width=" + width + ",height=" + height +
    ",status,resizable,left=" + left + ",top=" + top +
    ",screenX=" + left + ",screenY=" + top + ",scrollbars";
    mywindow = window.open(url, "subWind", windowFeatures);
  }
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table th.tgl ").mouseover(function(event) {
            $("table th.tgl ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('personalia/formjadwalperawat');?>";
            window.location = url;
            // alert(url);
            return false;
        });
        $(".edit").click(function(){
            var id = $("tr.bg-gray").attr("href");
            var bagian = $("[name='bagian']").val();
            var url = "<?php echo site_url('personalia/formjadwalperawat');?>/"+id+"/"+bagian;
            window.location = url;
            // alert(url);
            return false;
        });
        $("[name='bulan']").change(function(){
            var bln = $(this).val();
            var tahun = $("[name='tahun']").val();
            var url = "<?php echo site_url('admindkk/liburnasional');?>/"+bln+"/"+tahun;
            window.location = url;
            // alert(url);
            return false;
        });
        $("[name='tahun']").change(function(){
            var tahun = $(this).val();
            var bln = $("[name='bulan']").val();
            var url = "<?php echo site_url('admindkk/liburnasional');?>/"+bln+"/"+tahun;
            window.location = url;
            // alert(url);
            return false;
        });
        $(".search").click(function(){
            var bln = $("[name='bulan']").val();
            var bagian = $("[name='bagian']").val();
            var url = "<?php echo site_url('personalia/jadwal_perawat');?>/"+bln+"/"+bagian;
            window.location = url;
            return false;
        });
        $("[name='bagian']").change(function(){
            var bln = $("[name='bulan']").val();
            var bagian = $("[name='bagian']").val();
            var url = "<?php echo site_url('personalia/jadwal_perawat');?>/"+bln+"/"+bagian;
            window.location = url;
            // alert(url);
            return false;
        });

        $("table th.tgl ").click(function(){
            $("[name='keterangan']").val("");
            var tgl = "00"+$(this).attr("hari");
            tgl = tgl.slice(-2, tgl.length);
            var bln = "00"+$("[name='bulan']").val();
            bln = bln.slice(-2, bln.length);
            var tahun = $("[name='tahun']").val();
            tgl = tgl+"-"+bln+"-"+tahun;
            $("[name='tgl']").val(tgl);
            $.ajax({
                type  : "POST",
                url   : "<?php echo site_url('admindkk/getliburnasional');?>/"+tgl,
                success : function(result){
                    var h = JSON.parse(result);
                    $("[name='keterangan']").val(h.keterangan);
                },
                error: function(result){
                    alert(result);
                }
            });
            $(".modal").show();
       });
       $(".tidak").click(function(){
           $(".modal").hide();
       });
       $(".ya").click(function(){
             var tgl = $("[name='tgl']").val();
             var keterangan = $("[name='keterangan']").val();
               $.ajax({
                   type  : "POST",
                   data  : {tanggal:tgl,keterangan:keterangan},
                   url   : "<?php echo site_url('admindkk/simpanliburnasional');?>",
                   success : function(result){
                       location.reload();
                   },
                   error: function(result){
                       alert(result);
                   }
               });
           return false;
       });
       $(".cetakjadwal").click(function() {
            var bln = $("[name='bulan']").val();
            var bagian = $("[name='bagian']").val();
            var url = "<?php echo site_url('personalia/cetakjadwal');?>/"+bln+"/"+bagian;
            openCenteredWindow(url);
            // alert(url);
            return false;
        });
    });
</script>

    <div class="col-xs-12">
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
            <div class="box-header with-border">
              <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Bulan</label>
                    <div class="col-sm-2">
                      <select class="form-control" name="bulan">
                          <?php
                            $bln = array("",
                                     "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
                            foreach ($bln as $key => $value) {
                              if ($key>0)
                              echo "<option value='".$key."' ".($b==$key ? "selected" : "").">".$value."</option>";
                            }
                          ?>
                      </select>
                    </div>
                    <label class="col-sm-2 control-label">Tahun</label>
                    <div class="col-sm-2">
                      <select class="form-control" name="tahun">
                          <?php
                            for ($i = date("Y"); $i > (date("Y")-10); $i--) {
                              echo "<option value='".$i."' ".($tahun==$i ? "selected" : "").">".$i."</option>";
                            }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-2">
                     <button class="search btn bg-gray  dim" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
              </div>
           </div>
           <?php
            $tahun = date("Y");
            $jml = cal_days_in_month(CAL_GREGORIAN, $b, $tahun);
           ?>
            <div class="box-body">
                <table class="table table-bordered table-responsive" id="myTable2">
                    <thead>
                        <tr class="bg-navy">
                            <th class="text-center" colspan="<?php echo $jml;?>">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <?php
                            for ($i = 1; $i <=$jml; $i++) {
                              $b = substr("00".$b,-2);
                              $d = substr("00".$i,-2);
                              $tanggal = $t."-".$b."-".$d;
                              $bg = isset($libur[$tanggal]) ? "style='background-color:#f0aea780'" : "";
                              echo "<th class='text-center tgl' width='50px' hari='".$i."' ".$bg.">".$i."</th>";
                            }
                          ?>
                     </tr>
                    </tbody>
                </table>
            </div>
    </div>
   <div class='modal'>
   <div class='modal-dialog'>
       <div class='modal-content'>
           <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;LIBUR NASIONAL</h4></div>
           <div class='modal-body'>
             <div class="form-horizontal">
               <div class="form-group">
                   <label class="col-sm-2 control-label">Tanggal</label>
                   <div class="col-sm-10"><input type="text" name="tgl" class="form-control" readonly></div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10"><input type="text" name="keterangan" class="form-control"></div>
             </div>
           </div>
           <div class='modal-footer'>
               <button class="ya btn btn-sm btn-danger">Simpan</button>
                <button class="tidak btn btn-sm btn-success">Batal</button>
           </div>
       </div>
   </div>
</div>
