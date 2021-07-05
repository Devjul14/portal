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
    $("tr.data_kelas").click(function(){
        $(".viewpasien").modal("show");
        $(".listpasien").html("");
        $("th.status_pulang").addClass("hide");
        $(".judulmodal").html("List Dashboard Pangkat");
        var kelas = $(this).attr("kelas");
        $.ajax({
            url   : "<?php echo site_url("home/listpasieninap_kelas");?>",
            type : "POST",
            data: {kelas:kelas},
            success: function(result){
                console.log(result);
                var echo = '';
                var no = 1;
                $.each(JSON.parse(result),function(key,val){
                    echo += "<tr>";
                    echo += "<td class='text-center'>"+(no++)+"</td>";
                    echo += "<td class='text-center'>"+val.no_rm+"</td>";
                    echo += "<td class='text-center'>"+val.no_reg+"</td>";
                    echo += "<td>"+val.nama_pasien+"</td>";
                    echo += "<td>"+val.nama_kelas+"</td>";
                    echo += "<td class='text-center'>"+val.kode_kamar+"</td>";
                    echo += "<td class='text-center'>"+val.no_bed+"</td>";
                    echo += "<td>"+val.gol_ket+"</td>";
                    echo += "<td>"+val.hp+"</td>";
                    echo += "</tr>";
                });
                $(".listpasien").html(echo);
            },
            error: function(result){
                console.log(result);
            }
        });
        });
    });
</script>
<div class="col-sm-12">
  <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title"><b>Dashboard Pangkat</b></h3>
          <!-- <div class="pull-right">
              <div class="form-horizontal">
                  <div class="form-group">
                      <label class="col-md-2 control-label">Tanggal</label>
                      <div class="col-md-3">
                              <input type="text" class="form-control" name="tgl1" value="<?php echo date("d-m-Y",strtotime($tgl1));?>" autocomplete="off"/>
                      </div>
                      <div class="col-md-3">
                              <input type="text" class="form-control" name="tgl2" value="<?php echo date("d-m-Y",strtotime($tgl2));?>" autocomplete="off"/>
                      </div>
                      <div class="col-md-1">
                          <div class="pull-left">
                               <button class="search btn btn-primary" type="button"> <i class="fa fa-search"></i></button>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <button class="print btn btn-success pull-right" type = "button" ><i class="fa fa-print"></i>&nbsp;Cetak</button>
                      </div>
                  </div>
              </div>
          </div> -->
      </div>
      <div class="box-body no-padding">
          <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped">
                  <thead>
                      <tr class='bg-green'>
                          <th class="text-center" style="vertical-align: middle" rowspan="2">Pangkat</th>
                          <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                          foreach($p->result() as $key){
                                  // $bed = $key->bed;

                                  echo "<tr class='data_kelas' kelas='".$key->pangkat_dashboard."'>";
                                  echo "<td class='text-center'>".str_replace("_", " ", strtoupper($key->pangkat_dashboard))."</td>";
                                  echo "<td class='text-center'></td>";
                                  echo "</tr>";
                                  $total += $key->bed;

                              // }
                          }
                      ?>
                  </tbody>
                  <!-- <tfoot>
                      <tr class='bg-green'>
                          <th>Jumlah Pangkat</th>
                          <th class='text-right'><?php echo $total;?></th>

                      </tr>
                  </tfoot> -->
              </table>
          </div>
      </div>
  </div>
</div>
<div class='modal viewpasien'>
    <div class='modal-dialog' style="width:80%">
        <div class='modal-content'>
            <div class="modal-header bg-green"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;<span class="judulmodal"></span></h4></div>
            <div class='modal-body'>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover " id="myTable">
                        <thead>
                            <tr class="bg-navy">
                                <th width="10%" class='text-center'>No</th>
                                <th class="text-center">Nama</th>
                                <th class='text-center'>Pangkat</th>
                            </tr>
                        </thead>
                        <tbody class="listpasien"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
