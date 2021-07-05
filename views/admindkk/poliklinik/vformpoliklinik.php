<script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(".back").click(function(){
            var url = "<?php echo site_url('poliklinik/view');?>";
            window.location = url;
            return false; 
        });
           var formattgl = "yy-mm-dd";
        // $("input[name='tgl']").datepicker({
        //     dateFormat : formattgl,
        //     changeMonth: true,
        //     changeYear: true
        // });
        // $("select[name='id_kecamatan']").select2();
    });
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
<?php
    if ($q) {
        $kode=$q->kode;
        $keterangan=$q->keterangan;
        $briging=$q->briging;
        $kasir=$q->kasir;
        // $status=$q->status;
        // if ($q->briging=="as") $kb1 = "selected"; else $kb1 = "";
        // if ($q->briging=="int") $kb2 = "selected"; else $kb2 = "";
        // if ($q->briging=="na") $kb3 = "selected"; else $kb3 = "";
        // if ($q->hari_buka=="senin") $hb1 = "selected"; else $hb1 = "";
        // if ($q->hari_buka=="selasa") $hb2 = "selected"; else $hb2 = "";
        // if ($q->hari_buka=="rabu") $hb3 = "selected"; else $hb3 = "";
        // if ($q->hari_buka=="kamis") $hb4 = "selected"; else $hb4 = "";
        // if ($q->hari_buka=="jumat") $hb5 = "selected"; else $hb5 = "";
        // if ($q->hari_buka=="sabtu") $hb6 = "selected"; else $hb6 = "";
        // if ($q->hari_buka=="minggu") $hb7 = "selected"; else $hb7 = "";
        $r = "readonly";
        $aksi = "edit";
    } else {
        $kode=
        $keterangan=
        $briging=
        $kasir=
        // $status=
        // $hb1= $hb2= $hb3= $hb4= $hb5= $hb6= $hb7=
        $kb1= $kb2= $kb3=
        $r = "";
        $aksi = "simpan";
    }
    // echo $aksi;
?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open("poliklinik/simpanpoliklinik/".$aksi,array("class"=>"form-horizontal"));?>
                    <input type="hidden" name="kode_poliklinik" value='<?=$kode;?>'>
                  <div class="form-group">
                       <label class="col-sm-2 control-label">Kode</label>
                       <div class="col-sm-10">
                            <input type="text" name="kode_poliklinik" class="form-control" value="<?=$kode;?>"  <?php echo $r ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama poliklinik</label>
                       <div class="col-sm-10">
                            <input type="text" name="nama_poliklinik" class="form-control" value="<?=$keterangan;?>">
                        </div>
                   </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Briging</label>
                       <div class="col-sm-10">
                            <input type="text" name="briging" class="form-control" value="<?=$briging;?>">
                        </div>
                   </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Kasir</label>
                       <div class="col-sm-10">
                            <input type="text" name="kasir" class="form-control" value="<?=$kasir;?>">
                        </div>
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