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
    $(document).ajaxStart(function() {
        $(".loading").show();
    }).ajaxStop(function() {
        $(".loading").hide();
    });
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).on('change', '.btn-file-photo :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).ready(function() {
        $('.btn-file-photo :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
        $("[name='photo_file']").change(function(event){
            if (event.target.files[0].size<=250000){
                $('.photo').attr("src",URL.createObjectURL(event.target.files[0]));
                upload_photo();
            } else {
                alert("Ukuran foto tidak boleh lebih dari 250 Kb");
            }
        });
        $('.warna').each(function() {
            $('tr:odd',  this).addClass('disabled');
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({
            dateFormat : formattgl
        });
        $("[name='tindakan']").select2();
        $("input[name='tgl2']").datepicker({
            dateFormat : formattgl
        });
        $(".simpanfile").click(function(){
            simpanfile();
        });
        $('.modal_list').on('hidden.bs.modal', function (e) {
            location.reload();
        });
        $(".listdata").on('click',".dataChange", function(evt){
            // alert("coba");
            evt.preventDefault();
            var dataText = $(this);
            var mrn = dataText.attr('mrn');
            var admission_date = dataText.attr("admission_date");
            var dataContent = dataText.text().trim();
            var status = dataText.attr('status');
            var result = getstatus(status);
            var dataInputField = $(result);
            dataText.before(dataInputField).hide();
            dataInputField.select2();
            dataInputField.focus().change(function(){
                var inputval = dataInputField.val()
                changeData(inputval,mrn,admission_date);
                $(this).remove();
                dataText.show();
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val()
                    changeData(inputval,mrn,admission_date);
                    $(this).remove();
                    dataText.show();
                }
            });
        });
        $("tr.data").click(function(){
          $(".modal_list").modal("show");
          var bln = $(this).attr("bulan");
          $("[name='bln']").val(bln);
          $.ajax({
              type: "POST",
              data: {bln: bln},
              url: "<?php echo site_url('grouper/getrk_detail'); ?>",
              success: function(result) {
                  console.log(result);
                  $(".listdata").html(result);
              },
              error: function(result) {
                  console.log(result);
              }
          });
        });
        $(".upload").click(function(){
            $(".modal_upload").modal("show");
        });
        // $("[name='cari']").keypress(function() {
        //     var cari = $(this).val();
        //     $.ajax({
        //         url: "<?php echo site_url('grouper/caripasien');?>",
        //         type: 'POST',
        //         data: {cari: cari},
        //         success: function(no_rm){
        //           $(".listdata").html("");
        //           var bln = $("[name='bln']").val();
        //           if (no_rm=="kosong" || cari=="") no_rm = "";
        //           $.ajax({
        //               type: "POST",
        //               data: {bln: bln},
        //               url: "<?php echo site_url('grouper/getrk_detail'); ?>/"+no_rm,
        //               success: function(result) {
        //                   console.log(result);
        //                   $(".listdata").html(result);
        //               },
        //               error: function(result) {
        //                   console.log(result);
        //               }
        //           });
        //         }
        //     });
        // });
        $(".tmb_cari").click(function() {
            var cari = $("[name='cari']").val();
            $(".bodydata").removeClass("bg-gray");
            $.ajax({
                url: "<?php echo site_url('grouper/caripasien');?>",
                type: 'POST',
                data: {cari: cari},
                success: function(no_rm){
                  $(".listdata").html("");
                  if (no_rm=="kosong" || cari=="") no_rm = "";
                  var bln = $("[name='bln']").val();
                  $.ajax({
                      type: "POST",
                      data: {bln: bln},
                      url: "<?php echo site_url('grouper/getrk_detail'); ?>/"+no_rm,
                      success: function(result) {
                          console.log(result);
                          $(".listdata").html(result);
                      },
                      error: function(result) {
                          console.log(result);
                      }
                  });
                }
            });
        });
    });
    function upload_photo(){
        var files = document.getElementById("photo_file").files;
        var totalsize = 0;
        if (files.length > 0) {
          var file = files[0];
          totalsize = files[0].size;
        }
        console.log(files[0]);
        if (totalsize<=250000){
          var reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = function () {
              var imagedata = reader.result;
              $("[name='source_photo']").val(imagedata);
              $.ajax({
                  type: "POST",
                  data: {files: imagedata},
                  url: "<?php echo site_url('grouper/viewfile'); ?>",
                  success: function(result) {
                      console.log(result);
                      $(".list-file").html(result);
                  },
                  error: function(result) {
                      alert(result);
                  }
              });
          };
        } else {
            alert("Ukuran foto tidak boleh lebih dari 250 Kb");
        }
    }
    function simpanfile(){
        var files = document.getElementById("photo_file").files;
        var totalsize = 0;
        if (files.length > 0) {
          var file = files[0];
          totalsize = files[0].size;
        }
        if (totalsize<=250000){
          var reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = function () {
              var imagedata = reader.result;
              $("[name='source_photo']").val(imagedata);
              $.ajax({
                  type: "POST",
                  data: {files: imagedata},
                  url: "<?php echo site_url('grouper/simpanfile'); ?>",
                  success: function(result) {
                      // console.log(result);
                      alert("Data berhasil disimpan");
                      location.reload();
                  },
                  error: function(result) {
                      console.log(result);
                  }
              });
          };
        } else {
            alert("Ukuran foto tidak boleh lebih dari 250 Kb");
        }
    }
    function getstatus(val){
        var html = "<select name='status' class='form-control'>";
        html += "<option value='layak' "+(val=="layak" ? "selected" : "")+">LAYAK</option>";
        html += "<option value='tidak_layak' "+(val=="tidak_layak" ? "selected" : "")+">TIDAK LAYAK</option>";
        html += "<option value='pending' "+(val=="pending" ? "selected" : "")+">PENDING</option>";
        html += "</select>";
        result = html;
        return result;
    };
    var changeData = function(value,mrn,admission_date){
        $.ajax({
            url: "<?php echo site_url('grouper/ubahrk');?>",
            type: 'POST',
            data: {mrn: mrn,admission_date: admission_date,value: value},
            success: function(result){
                var bln = $("[name='bln']").val();
                $.ajax({
                    type: "POST",
                    data: {bln: bln},
                    url: "<?php echo site_url('grouper/getrk_detail'); ?>",
                    success: function(result) {
                        $(".listdata").html(result);
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });
            }
        });
    };
</script>
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-right">
              <button class="upload btn btn-success"><span class="fa fa-list"></span>&nbsp; Upload</button>
              <!-- <button class="cetak btn btn-primary"><span class="fa fa-print"></span> Cetak</button> -->
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class='bg-navy'>
                            <th class="text-center" style="vertical-align:middle" rowspan="2" width=200px>Bulan</th>
                            <th class="text-center" colspan="6">Rawat Jalan</th>
                            <th class="text-center" colspan="6">Rawat Inap</th>
                        </tr>
                        <tr class='bg-navy'>
                          <th class="text-center">Berkas</th>
                          <th class="text-center">Tarif RS</th>
                          <th class="text-center">Tarif BPJS</th>
                          <th class="text-center">layak</th>
                          <th class="text-center">tidak_layak</th>
                          <th class="text-center">Pending</th>
                          <th class="text-center">Berkas</th>
                          <th class="text-center">Tarif RS</th>
                          <th class="text-center">Tarif BPJS</th>
                          <th class="text-center">layak</th>
                          <th class="text-center">tidak_layak</th>
                          <th class="text-center">Pending</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $bulan = array(
                          "",
                          "Januari",
                          "Februari",
                          "Maret",
                          "April",
                          "Mei",
                          "Juni",
                          "Juli",
                          "Agustus",
                          "September",
                          "Oktober",
                          "Nopember",
                          "Desember",
                        );
                        foreach ($bulan as $key => $value) {
                          if ($value!=""){
                            echo "<tr class='data' bulan='".$key."'>";
                            echo "<td class='text-center'>".$value."</td>";
                            echo "<td class='text-center'>".(isset($rk["ralan"][$key]["total"]) ? $rk["ralan"][$key]["total"] : "-")."</td>";
                            echo "<td class='text-right'>".(isset($rk["ralan"][$key]["tarif_rs"]) ? number_format($rk["ralan"][$key]["tarif_rs"],0,',','.') : "-")."</td>";
                            echo "<td class='text-right'>".(isset($rk["ralan"][$key]["tarif_bpjs"]) ? number_format($rk["ralan"][$key]["tarif_bpjs"],0,',','.') : "-")."</td>";
                            echo "<td class='text-center'>".(isset($rk["ralan"][$key]["layak"]) ? $rk["ralan"][$key]["layak"] : "-")."</td>";
                            echo "<td class='text-center'>".(isset($rk["ralan"][$key]["tidak_layak"]) ? $rk["ralan"][$key]["tidak_layak"] : "-")."</td>";
                            echo "<td class='text-center'>".(isset($rk["ralan"][$key]["pending"]) ? $rk["ralan"][$key]["pending"] : "-")."</td>";
                            echo "<td class='text-center'>".(isset($rk["ranap"][$key]["total"]) ? $rk["ranap"][$key]["total"] : "-")."</td>";
                            echo "<td class='text-right'>".(isset($rk["ranap"][$key]["tarif_rs"]) ? number_format($rk["ranap"][$key]["tarif_rs"],0,',','.') : "-")."</td>";
                            echo "<td class='text-right'>".(isset($rk["ranap"][$key]["tarif_bpjs"]) ? number_format($rk["ranap"][$key]["tarif_bpjs"],0,',','.') : "-")."</td>";
                            echo "<td class='text-center'>".(isset($rk["ranap"][$key]["layak"]) ? $rk["ranap"][$key]["layak"] : "-")."</td>";
                            echo "<td class='text-center'>".(isset($rk["ranap"][$key]["tidak_layak"]) ? $rk["ranap"][$key]["tidak_layak"] : "-")."</td>";
                            echo "<td class='text-center'>".(isset($rk["ranap"][$key]["pending"]) ? $rk["ranap"][$key]["pending"] : "-")."</td>";
                            echo "</tr>";
                          }
                        }
                      ?>
                    </tbody>
                    <tfoot>
                        <tr class='bg-navy'>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
<div class='modal modal_upload no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-user"></i>&nbsp;&nbsp;Upload File&nbsp;<span class="nama_tindakan"></span></h4>
            </div>
            <div class='modal-body'>
                <div id="file-photo">
                    <div class="input-group">
                        <input type="hidden" name="source_photo">
                        <input type="text" class="form-control" readonly>
                        <span class="input-group-btn">
                            <span class="btn btn-warning btn-file-photo"><i class="fa fa-folder-open"></i><input type="file" name="photo_file" id="photo_file" class="form-control"></span>
                        </span>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="list-file table-responsive"></div>
            </div>
            <div class='modal-footer'>
                <div class='pull-right'>
                  <button type="button" class="btn btn-success simpanfile"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_list no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-user"></i>&nbsp;&nbsp;List Data&nbsp;<span class="nama_tindakan"></span></h4>
            </div>
            <div class='modal-body'>
                <div class="row">
                  <div class="col-xs-3 pull-right">
                    <div class="input-group input-group-sm">
                      <input type="text" name="cari" placeholder="pencarian..." class="form-control">
                      <span class="input-group-btn">
                        <button type="button" class="tmb_cari btn btn-info btn-flat"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
                      </span>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="bln">
                <div class="listdata table-responsive"></div>
            </div>
        </div>
    </div>
</div>
<div class='modal modal_cari no-print' role="dialog">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Pencarian</h4>
            </div>
            <div class='modal-body'>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input class="form-control" type="text" name="cari" placeholder="No RM/Nama Pasien"/>
                                <span class="input-group-btn">
                                    <button class="tmb_cari btn btn-success">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='loading modal'>
    <div class='text-center align-middle' style="margin-top: 200px">
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
        <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
            <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url();?>/img/load.gif" width="150px"></div>
            <div style="font-size:20px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Loading</div>
        </div>
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
    </div>
</div>
<style type="text/css">
    .modal-dialog{
        width:80%;
    }
    .btn.btn-file-photo > input[type='file'] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        opacity: 0;
        filter: alpha(opacity=0);
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>
