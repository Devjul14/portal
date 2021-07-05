<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rekap Rawat Jalan || SIMRS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
  <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="<?php echo base_url();?>js/jquery.js"></script>
  <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
  <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
  <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
  <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
  <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
  <script src="<?php echo base_url();?>js/html2canvas.js"></script>
  <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />
</head>
<body class="hold-transition sidebar-mini skin-blue sidebar-fixed sidebar-collapse">
  <script>
  setTimeout('location.href=\"klinik"' ,60000);
  </script>
  <div class="col-xs-12">
  <div class="box box-solid">
    <div class="box-body no-padding">
      <div class="row">
        <div class="col-xs-12">
        <h1 align="center" style="font-size: 50px"><b>DISPLAY RAWAT JALAN<b></h1>
          </div>
        <div class="col-xs-6">
          <div class="table-responsive">
              <table class="table table-bordered">
                  <thead>
                      <tr class='bg-navy'>
                          <th class="text-center bg-yellow" style="vertical-align: middle"><b>No.</b></th>
                          <th class="text-center bg-purple" style="vertical-align: middle"><b>Poliklinik</b></th>
                          <th class="text-center bg-red" style="vertical-align: middle">A</th>
                          <th class="text-center bg-blue" style="vertical-align: middle">B</th>
                          <th class="text-center bg-green" style="vertical-align: middle">C</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                          $i = 1;
                          $hide = "";
                          $baru_ralan = $lama_ralan = $reguler_ralan = $eks_ralan =$dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan = 0;
                          foreach ($t as $key => $data) {
                            if ($i<12){
                              if ($data->kode != "0102031" && $data->kode != "0102024" && $data->kode != "0102023" && $data->kode != "0102022" && $data->kode != "0102022" && $data->kode != "0102036" && $data->kode != "0102035" && $data->kode != "0102030" && $data->kode != "0102025" && $data->kode != "0102028" && $data->kode != "0102031" && $data->kode != "0102012" && $data->kode != "0102026"){
                              $jml = isset($p[$data->kode]) ? $p[$data->kode] : 0;
                              echo "<tr jml='".$jml."' id='data' tindakan='".$data->kode."' nama_tindakan='".$data->keterangan."'>";
                              echo "<td class='text-center bg-yellow'>".($i++)."</td>";
                              echo "<td>".str_replace("KLINIK","",$data->keterangan)."</td>";
                                  echo "<td class='text-center bg-red'>".(isset($p[$data->kode][0]) ? $p[$data->kode][0] : 0)."</td>";
                                  echo "<td class='text-center bg-blue'>".(isset($p[$data->kode][1]) ? $p[$data->kode][1] : 0)."</td>";
                              $jumlah_ralan = (isset($p[$data->kode][0]) ? $p[$data->kode][0] : 0)+(isset($p[$data->kode][1]) ? $p[$data->kode][1] : 0);
                              echo "<td class='text-center bg-green'>".$jumlah_ralan."</td>";
                              echo "</tr>";
                            }
                            }
                          }
                      ?>
                  </tbody>
              </table>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="table-responsive">
                <table class="table table-bordered" >
                    <thead>
                        <tr class='bg-navy'>
                            <th class="text-center bg-yellow" style="vertical-align: middle">No.</th>
                            <th class="text-center bg-purple" style="vertical-align: middle">Poliklinik</th>
                            <th class="text-center bg-red" style="vertical-align: middle">A</th>
                            <th class="text-center bg-blue" style="vertical-align: middle">B</th>
                            <th class="text-center bg-green" style="vertical-align: middle">C</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $hide = "";
                            $baru_ralan = $lama_ralan = $reguler_ralan = $eks_ralan =$dinas_ralan = $umum_ralan = $bpjs_ralan = $prsh_ralan = 0;
                            foreach ($t as $key => $data) {
                                if ($data->kode != "0102031" && $data->kode != "0102024" && $data->kode != "0102023" && $data->kode != "0102022" && $data->kode != "0102022" && $data->kode != "0102036" && $data->kode != "0102035" && $data->kode != "0102030" && $data->kode != "0102025" && $data->kode != "0102028" && $data->kode != "0102031" && $data->kode != "0102012" && $data->kode != "0102026"){
                                  if ($i>11){
                                $jml = isset($p[$data->kode]) ? $p[$data->kode] : 0;
                                echo "<tr jml='".$jml."' id='data' tindakan='".$data->kode."' nama_tindakan='".$data->keterangan."'>";
                                echo "<td class='text-center bg-yellow'>".$i."</td>";
                                echo "<td>".str_replace("KLINIK","",$data->keterangan)."</td>";
                                    echo "<td class='text-center bg-red'>".(isset($p[$data->kode][0]) ? $p[$data->kode][0] : 0)."</td>";
                                    echo "<td class='text-center bg-blue'>".(isset($p[$data->kode][1]) ? $p[$data->kode][1] : 0)."</td>";
                                $jumlah_ralan = (isset($p[$data->kode][0]) ? $p[$data->kode][0] : 0)+(isset($p[$data->kode][1]) ? $p[$data->kode][1] : 0);
                                echo "<td class='text-center bg-green'>".$jumlah_ralan."</td>";
                                echo "</tr>";
                                }
                                $i++;
                              }
                            }

                        ?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
      <div class="form-group text-center">
        <div class="col-md-4">
          <button class="btn btn-lg bg-red">A</button>
            <b style="font-size: 20px">&nbsp;&nbsp;BELUM DIPERIKSA</b>
            <div class="clearfix">&nbsp;</div>
        </div>
        <div class="col-md-4">
          <button class="btn btn-lg bg-blue">B</button>
            <b style="font-size: 20px">&nbsp;&nbsp;SUDAH DIPERIKSA</b>
            <div class="clearfix">&nbsp;</div>
        </div>
        <div class="col-md-4">
          <button class="btn btn-lg bg-green">C</button>
            <b style="font-size: 20px">&nbsp;&nbsp;TOTAL</b>
        </div>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
    th, td {
        padding-left: 5px;
        padding-right: 5px;
        font-size: 25px;
    },
    .table-bordered {
    border: 1px solid #000000;
    },
    b {
    font-size: 25px;
    }
    </style>
</body>
</html>
