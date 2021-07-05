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
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
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
            var bagian = $("[name='bagian']").val();
            var url = "<?php echo site_url('personalia/jadwal_perawat');?>/"+bln+"/"+bagian;
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

        $(".hapus").click(function(){
           $(".modal").show();
       });
       $(".tidak").click(function(){
           $(".modal").hide();
       });
       $(".ya").click(function(){
            var id= $(".bg-gray").attr("href");
            window.location="<?php echo site_url('personalia/hapusjadwalperawat');?>/"+id;
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
                  <label class="col-sm-2 control-label">Ruangan</label>
                  <div class="col-sm-2">
                    <select class="form-control" name="bagian">
                        <?php
                            foreach($bag->result() as $key){
                              echo "<option value='".$key->kode_bagian."' ".($bagian==$key->kode_bagian ? "selected" : "").">".$key->nama_ruangan."</option>";
                            }
                            echo "<option value='kontrole' ".($bagian=="kontrole" ? "selected" : "").">KONTROLE</option>";
                            // echo "<option value='kepala' ".($bagian=="kepala" ? "selected" : "").">KEPALA</option>";
                            // echo "<option value='waka' ".($bagian=="waka" ? "selected" : "").">WAKA</option>";
                        ?>
                    </select>
                  </div>
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
                <table class="table table-bordered table-hover table-responsive" id="myTable2">
                    <thead>
                        <tr class="bg-navy">
                            <th rowspan="2">No</th>
                            <th class="text-center" rowspan="2" width='250px'>Nama Perawat</th>
                            <th class="text-center" colspan="<?php echo $jml;?>">Tanggal</th>
                        </tr>
                        <tr class="bg-navy">
                            <?php
                              for ($i = 1; $i <=$jml; $i++) {
                                echo "<th class='text-center' width='50px'>".$i."</th>";
                              }
                            ?>
                       </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach ($p->result() as $data) {
                                if ($bagian=="kontrole"){
                                  $i++;
                                echo "<tr id=data href='".$data->id_perawat."'>
                                        <td>".$i."</td>
                                        <td>".$data->nama_perawat."</td>";
                                        for ($d = 1; $d <=$jml; $d++) {
                                          $bl = substr("00".$b,-2);
                                          $dt = substr("00".$d,-2);
                                          $tanggal = date("Y")."-".$bl."-".$dt;
                                          $hari = date("w",strtotime($tanggal));
                                          $hasil = $bg = "";
                                          if ($q[$bagian][$data->id_perawat]["tgl".$d]["shift1"]=="on")
                                            $hasil = "P";
                                          else if ($q[$bagian][$data->id_perawat]["tgl".$d]["shift2"]=="on")
                                            $hasil = "X";
                                          else if ($q[$bagian][$data->id_perawat]["tgl".$d]["lepas"]=="on")
                                              $hasil = "LP";
                                          else if ($q[$bagian][$data->id_perawat]["tgl".$d]["libur"]=="on"){
                                            $hasil = "L";
                                          }
                                          else if ($q[$bagian][$data->id_perawat]["tgl".$d]["sakit"]=="on"){
                                            $hasil = "S";
                                          }
                                          else if ($q[$bagian][$data->id_perawat]["tgl".$d]["cuti"]=="on"){
                                            $hasil = "C";
                                          }
                                          else if ($q[$bagian][$data->id_perawat]["tgl".$d]["dd"]=="on"){
                                            $hasil = "DD";
                                          }
                                          else if ($q[$bagian][$data->id_perawat]["tgl".$d]["dl"]=="on"){
                                            $hasil = "DL";
                                          }
                                          if ($hari==0)
                                            $bg = "#f0aea780";
                                          else if($hari==6){
                                            $bg = "#0173b76e";
                                          }
                                          $bg = isset($libur[$tanggal]) ? "#f0aea780'" : $bg;
                                          echo "<th class='text-center' style='background-color:".$bg."'>".$hasil."</th>";
                                        }
                                echo "</tr>";
                              } else {
                                  $i++;
                                  echo "<tr id=data href='".$data->id_perawat."'>
                                  <td>".$i."</td>
                                  <td>".$data->nama_perawat."</td>";
                                  for ($d = 1; $d <=$jml; $d++) {
                                    $bl = substr("00".$b,-2);
                                    $dt = substr("00".$d,-2);
                                    $tanggal = date("Y")."-".$bl."-".$dt;
                                    $hari = date("w",strtotime($tanggal));
                                    $hasil = $bg = "";
                                    if ($data->kontrole==1) $bgn = "kontrole"; else $bgn = $data->bagian;
                                    if ($q[$bagian][$data->id_perawat]["tgl".$d]["shift1"]=="on")
                                    $hasil = "P";
                                    else if ($q[$bgn][$data->id_perawat]["tgl".$d]["shift2"]=="on")
                                    $hasil = "X";
                                    else if ($q[$bgn][$data->id_perawat]["tgl".$d]["lepas"]=="on")
                                    $hasil = "LP";
                                    else if ($q[$bgn][$data->id_perawat]["tgl".$d]["libur"]=="on"){
                                      $hasil = "L";
                                    }
                                    else if ($q[$bgn][$data->id_perawat]["tgl".$d]["sakit"]=="on"){
                                      $hasil = "S";
                                    }
                                    else if ($q[$bgn][$data->id_perawat]["tgl".$d]["cuti"]=="on"){
                                      $hasil = "C";
                                    }
                                    else if ($q[$bgn][$data->id_perawat]["tgl".$d]["dd"]=="on"){
                                      $hasil = "DD";
                                    }
                                    else if ($q[$bgn][$data->id_perawat]["tgl".$d]["dl"]=="on"){
                                      $hasil = "DL";
                                    }
                                    if ($hari==0)
                                    $bg = "#f0aea780";
                                    else if($hari==6){
                                      $bg = "#0173b76e";
                                    }
                                    $bg = isset($libur[$tanggal]) ? "#f0aea780'" : $bg;
                                    echo "<th class='text-center' style='background-color:".$bg."'>".$hasil."</th>";
                                  }
                                  echo "</tr>";
                              }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
          <div class="box-footer with-border">
                <div class="pull-right">
                    <div class="btn-group">
                        <!-- <button class="add btn btn-primary  dim" type="button"><i class="fa fa-plus"></i></button> -->
                        <button class="edit btn btn-warning  dim" type="button"><i class="fa fa-edit"></i></button>
                        <button class="cetakjadwal btn btn-success dim" type="button"><i class="fa  fa-file"></i></button>
                        <button class="hapus btn btn-danger  dim" type="button"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class='modal'>
   <div class='modal-dialog'>
       <div class='modal-content'>
           <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION</h4></div>
           <div class='modal-body'>Yakin akan menghapus data ?</div>
           <div class='modal-footer'>
               <button class="ya btn btn-sm btn-danger">Ya</button>
                <button class="tidak btn btn-sm btn-success">Tidak</button>
           </div>
       </div>
   </div>
</div>
