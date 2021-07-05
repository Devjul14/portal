<script>
    $(document).ready(function() {
    //     // $("#myTable").fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
    //     $("table tr#data:first").addClass("bg-gray");
    //     $("table tr#data ").click(function(){
    //         $("tr#data").setSelection(4, true);
    //     });
        $(".back").click(function(){
            var url = "<?php echo site_url('adminpuskes/binaan');?>";
            window.location = url;
            // alert(url);
            return false; 
        });
        var id_kecamatan = $("select[name='id_kecamatan']").val();
		var url = "<?php echo site_url('adminpuskes/getkelurahan');?>/"+id_kecamatan;
		$("#kelurahan").load(url);
        $("a.save").click(function(){
            $("#formsave").trigger("submit");
            return false;
        });
		$("select[name='id_kecamatan']").change(function(){
            var id_kecamatan = $(this).val();
			var url = "<?php echo site_url('adminpuskes/getkelurahan');?>/"+id_kecamatan;
			$("#kelurahan").load(url);
			return false;
        });
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
	if ($q2) {
        $id_sd=$q2->id_sd;
        $nama_sd=$q2->nama_sd;
        $nama_sd=$q2->nama_sd;
        $id_kecamatan=$q2->id_kecamatan;
        $id_kelurahan=$q2->id_kelurahan;
        $aksi = "edit";
    } else {
        $id_sd=
        $nama_sd=
        $nama_sd=
        $id_kecamatan=
        $id_kelurahan="";
        $aksi = "simpan";
    }
	echo $aksi;
?>
<!-- <button class="back btn btn-outline btn-primary  dim" type="button"><i class="fa fa-arrow-left"></i></button> -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?php echo $title_header; ?>
            </div>
            <div class="ibox-content">
                <?php echo form_open("adminpuskes/simpanbinaan/".$aksi,array("class"=>"form-horizontal"));?>
                	<div class="form-group">
                        <label class="col-sm-2 control-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <select name="id_kecamatan" class="form-control">
								<?php 
									foreach($q1->result() as $row){
										echo "<option value='".$row->id_kecamatan."' ".($id_kecamatan==$row->id_kecamatan ? "selected" : "").">".$row->nama_kecamatan."</option>";
									}
								?>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <span id='kelurahan'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama SD</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_sd" class="form-control" value="<?=$nama_sd;?>">
                            <input type=hidden name=idlama value='<?=$id;?>'>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="back btn btn-white" type="reset">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                <?php echo form_close();?>            
            </div>
        </div>
    </div>
</div>