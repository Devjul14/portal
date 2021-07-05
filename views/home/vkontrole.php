<link rel="stylesheet" href="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<?php
    if ($row){
        $kerusakan = $row->kerusakan;
        $lainlain = $row->lainlain;
        $action = "edit";
    } else {
        $kerusakan =
        $lainlain = "";
        $action = "simpan";
    }
?>
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
        $(".textarea").wysihtml5();
        $(".cetak").click(function(){
          var tanggal = $("[name='tanggal']").val();
          var url = "<?php echo site_url('home/cetakkontrole');?>/"+tanggal;
          openCenteredWindow(url);
        });
        $(".tmb_kontrole").click(function(){
            $("#formsubmit").submit();
        });
        $("#formsubmit").submit(function(e) {
            e.preventDefault();
            if($('.modal_kontrole').is(':visible')) {
              var password = $("[name='password_kontrole']").val();
              $.ajax({
                type: "POST",
                url: "<?php echo site_url("home/cekpassword");?>",
                data: {password: password}, // serializes the form's elements.
                success: function(result){
                    if (result!=""){
                      $('.loading').show();
                      $("[name='id_perawat']").val(result);
                      e.preventDefault();
                      var form = $("#formsubmit");
                      var url = form.attr('action');
                      $.ajax({
                          type: "POST",
                          url: url,
                          data: form.serialize(), // serializes the form's elements.
                          success: function(data){
                              // console.log(data);
                              location.reload();
                          },
                          error: function(data){
                            console.log(data);
                              // location.reload();
                          }
                      });
                    } else {
                      alert("Password tidak valid");
                    }
                  },
              });
            } else {
              $('.modal_kontrole').modal("show");
            }

        });
    });
</script>
<div class="col-sm-12">
  <?php echo form_open('home/simpankontrole/'.$action,array("id"=>"formsubmit"));?>
  <div class="box box-info">
    <div class="box-body">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-12 control-label">Tanggal</label>
          <div class="col-sm-12">
            <input type="hidden" name="id_perawat">
            <input class="form-control" type="text" name="tanggal" value="<?php echo date("d-m-Y"); ?>" readonly/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-12 control-label">Kerusakan</label>
          <div class="col-sm-12">
            <br>
            <textarea class="textarea form-control" name="kerusakan" style="height:200px"><?php echo $kerusakan;?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-12 control-label">Lain-lain</label>
          <div class="col-sm-12">
            <br>
            <textarea class="textarea form-control" name="lainlain" style="height:200px"><?php echo $lainlain;?></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <div class="pull-right">
        <div class="btn-group">
          <button type="submit" class="simpan btn btn-primary btn-md" title="Add"><i class="fa fa-save"></i></button>
          <button type="button" class="cetak btn btn-success btn-md" title="Cetak"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
        </div>
      </div>
    </div>
  </div>
  <?php echo form_close();?>
</div>
<div class='modal modal_kontrole no-print' role="dialog">
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class="modal-header bg-orange">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Petugas Kontrole</h4>
      </div>
      <div class='modal-body'>
        <div class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <div class="input-group">
                <input class="form-control" type="password" name="password_kontrole" placeholder="Masukan password petugas kontrole" />
                <span class="input-group-btn">
                  <button class="tmb_kontrole btn btn-success" type="button">Ok</button>
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
            <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url();?>img/load.gif" width="150px"></div>
            <div style="font-size:20px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Loading</div>
        </div>
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
    </div>
</div>
