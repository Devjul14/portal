<script>
    $(document).ready(function(){
        $(".edit").click(function(){
            var id = $(this).attr("data");
            window.location = "<?php echo site_url('postingan/formposting');?>/"+id;
            return false;
        });
        $(".new").click(function(){
            window.location = "<?php echo site_url('postingan/formposting');?>";
            return false;
        });
        $(".hapus").click(function(){
            $('.modalhapus').modal('show');
			var id=$(this).attr("data");
			$("[name='id_hapus']").val(id);
		});
        $(".hapus_konten").click(function(){
            var id_hapus = $("[name='id_hapus']").val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url("postingan/hapus");?>",
                data : {id: id_hapus},
                success: function(data){
                    location.reload();
                }
            });
        })
    });
</script>
	<div class="col-sm-12">
		<div class="box box-info">
            <div class="box-header"><button class='new btn btn-sm btn-success'><i class='fa fa-plus'></i>&nbsp;New Article</button></div>
            <div class="box-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered" id="myTable">
						<thead>
							<tr class="bg-navy">
								<th width="10px">No</th>
                	    	    <th>Title</th>
                	    	    <th>Slug</th>
                	    	    <th width="100px" class='text-center'>#</th>
                	    	</tr>
                	    </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach ($q->result() as $row) {
                                    echo "<tr>";
                                    echo "<td>".($i++)."</td>";
                                    echo "<td>".$row->title."</td>";
                                    echo "<td>".$row->slug."</td>";
                                    echo "<td class='text-center'>";
                                    echo "<div class='btn-group'>";
                                    echo "<button class='edit btn btn-sm btn-warning' data='".$row->id."'><i class='fa fa-edit'></i></button>";
                                    echo "<button class='hapus btn btn-sm btn-danger' data='".$row->id."'><i class='fa fa-minus'></i></button>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade modalhapus" id="ModalHapusItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <h4 class="modal-title" id="myModalLabel">Hapus Artikel</h4>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">           
                    <input type="hidden" name="id_hapus">
                    <p>Apakah Anda yakin mau menghapus artikel ?</p>              
                </div>
                <div class="modal-footer">
                    <button class="hapus_konten btn btn-danger" id="hapus_item">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>