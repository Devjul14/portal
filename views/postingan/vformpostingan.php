<link rel="stylesheet" href="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<?php
    if ($row){
        $id = $row->id;
        $title = $row->title;
        $slug = $row->slug;
        $content = $row->content;
        $status = $row->status;
        $controllers = $row->controllers;
        $action = "edit";
    } else {
        $id = 
        $title = 
        $slug = 
        $content = "";
        $controllers = "artikel";
        $status = "dinamis";
        $action = "simpan";
    }
?>
<script>
    $(document).ready(function(){
        $(".textarea").wysihtml5();
        $(".batal").click(function(){
            var url = "<?php echo site_url("postingan/posting");?>";
            window.location = url;
        });
        $("[name='title']").keyup(function(){
            var result = $(this).val().replace(/\s/g,"_").replace(/[^\w]/g, "");
            result = result.replace(/_/g,"-");
            $("[name='slug']").val(result);
        })
    });
</script>
	<div class="col-sm-12">
		<?php echo form_open('postingan/simpanposting/'.$action,array("id"=>"formsubmit"));?>
		<div class="box box-info">
			<div class="box-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-12 control-label">Title</label>
						<div class="col-sm-12">
							<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							<input type="hidden" name="controllers" value="<?php echo $controllers; ?>"/>
							<input type="hidden" name="status" value="<?php echo $status; ?>"/>
							<input class="form-control" type="text" name="title" value="<?php echo $title; ?>" required/>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-sm-12 control-label">Slug</label>
						<div class="col-sm-12">
							<input class="form-control" type="text" name="slug" value="<?php echo $slug; ?>" readonly/>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-sm-12 control-label">Content</label>
						<div class="col-sm-12">
							<br>
							<textarea class="textarea form-control" name="content" style="height:500px"><?php echo $content;?></textarea>
						</div>
					</div>
                </div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="submit" class="simpan btn btn-primary btn-md" title="Add"><i class="fa fa-save"></i></button>
	                    <button type="button" class="batal btn btn-danger btn-md" title="Batal"><i class="fa fa-times-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
    </div>