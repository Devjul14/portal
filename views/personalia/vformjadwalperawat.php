<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('personalia/jadwal_perawat');?>";
            window.location = url;
            return false;
        });
        var bulan = 1;
        var tahun = "<?php echo date("Y");?>";
        var id_perawat = "<?php echo $id_perawat;?>";
        var id_ruangan = "<?php echo $id_ruangan;?>";
        getbulan(id_perawat,id_ruangan,bulan,tahun);
        $(".bulan").click(function(){
            $(".bulan").prop('checked', false);
            $(this).prop('checked', true);
            var bulan = parseInt($(this).val());
            var tahun = parseInt($("[name='tahun']").val());
            $("[name='bulan']").val($(this).val());
            var id_perawat = "<?php echo $id_perawat;?>";
            var id_ruangan = "<?php echo $id_ruangan;?>";
            getbulan(id_perawat,id_ruangan,bulan,tahun);
            // return false;
        });
           var formattgl = "yy-mm-dd";
        $("input[name='tgl']").datepicker({
            dateFormat : formattgl,
            changeMonth: true,
            changeYear: true
        });
    });
    function getbulan(id_perawat,id_ruangan,bulan,tahun){
      $.ajax({
          type: "POST",
          data: {
              bulan: bulan,
              tahun: tahun,
              id_perawat: id_perawat,
              id_ruangan: id_ruangan
          },
          url: "<?php echo site_url('personalia/getjadwalperawatdetail'); ?>",
          success: function(result) {
            $(".tanggal").html(result);
          },
          error: function(result) {
              console.log(result);
          }
      });
    }
    function daysInMonth (month, year) {
      return new Date(year, month, 0).getDate();
  }
</script>
<?php
    if($this->session->flashdata('message')){
        $pesan=explode('-', $this->session->flashdata('message'));
        echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <b>".$pesan[1]."</b>
        </div>";
    }
?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo form_open("personalia/simpanjadwalperawat",array("class"=>"form-horizontal"));?>
            <input type="hidden" name="id_jadwal" value='<?=$id_jadwal;?>'>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Perawat</label>
                <div class="col-sm-10">
                    <input type="hidden" name='perawat' value='<?php echo $id_perawat;?>'>
                    <select class="form-control" disabled>
                     <?php
                         foreach ($p->result() as $value) {
                           echo "<option value='".$value->id_perawat."'".($id_perawat==$value->id_perawat ? "selected" : "").">".$value->nama_perawat."</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Ruangan</label>
                <div class="col-sm-10">
                    <input type="hidden" name='ruangan' value='<?php echo $id_ruangan;?>'>
                    <select class="form-control" disabled>
                     <?php
                         foreach ($p->result() as $value) {
                           echo "<option value='".$value->id_ruangan."'".($id_ruangan==$value->id_ruangan ? "selected" : "").">".$value->nama_ruangan."</option>";
                        }
                        echo "<option value='kontrole' ".($id_ruangan=="kontrole" ? "selected" : "").">KONTROLE</option>";
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tahun</label>
                <div class="col-sm-10">
                    <select name="tahun" class="form-control">
                     <?php
                         for ($i=date("Y"); $i >=date("Y")-20 ; $i--) {
                           echo "<option value='".$i."'>".$i."</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Bulan</label>
                <input type="hidden" name="bulan" value="1">
                <div class="col-sm-10">
                    <?php
                      $bulan = 1;
                      $bln = array("",
                               "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
                      foreach ($bln as $key => $value) {
                        if ($key>0)
                        echo '<input type="checkbox" class="bulan" name="'.$key.'" value="'.$key.'" '.($key==$bulan ? 'checked' : '').'> '.$value."&nbsp;&nbsp;";
                      }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><span class="tanggal"></span></div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <div class="btn-group">
                     <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button class="back btn btn-warning" type="reset">Batal</button>

                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

      </table>
    </div>
  </div>
</div>
