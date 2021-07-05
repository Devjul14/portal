<script type="text/javascript">
    $(document).ready(function(e){
        var formattgl = "dd-mm-yy";
        $("input[name='periode']").datepicker({
            dateFormat : formattgl,
        });
        $(".back").click(function(){
            var url = "<?php echo site_url('parkir');?>";
            window.location = url;
            return false;
        })
    });
</script>
<?php
	if ($q->num_rows()>0){
		$row = $q->row();
		$id = $row->id;
		$periode = date("d-m-Y",strtotime($row->periode));
		$penerima = $row->penerima;
		$pemberi = $row->pemberi;
        $shift = $row->shift;
		$jumlah = number_format($row->jumlah,0,',','.');
		$action = "edit";
	} else {
		$id  = $penerima = $pemberi = $jumlah = "";
        $shift = 1;
		$periode = date("d-m-Y");
		$action = "simpan";
	}
?>
<div class="col-md-12">
    <div class="box box-primary">
    	<?php echo form_open("parkir/simpan/".$action);?>
        <div class="box-body">
        	<div class="form-horizontal">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group">
                    <label class="col-md-2 control-label">Periode</label>
                    <div class="col-md-10">
                        <input type="text"  class="form-control" name='periode' value="<?php echo $periode;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Shift</label>
                    <div class="col-md-10">
                        <input type="number" min=1  class="form-control" name='shift' value="<?php echo $shift;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Pemberi</label>
                    <div class="col-md-10">
                        <input type="text"  class="form-control" name='pemberi' value="<?php echo $pemberi;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Penerima</label>
                    <div class="col-md-10">
                        <input type="text"  class="form-control" name='penerima' value="<?php echo $penerima;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jumlah</label>
                    <div class="col-md-10">
                        <input type="text"  class="form-control" name='jumlah' value="<?php echo $jumlah;?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
        	<div class="pull-right">
                <div class="btn-group">
                    <button class="back btn btn-warning" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                    <button class="simpan btn btn-success" type="submit"> Simpan</button>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
    </div>
</div>