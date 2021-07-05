<style type="text/css">
    .seleksi{
        background-color: #cfd7e6;
    }
</style>
<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('adminpuskes/formposyandu');?>";
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".seleksi").attr("href");;
            var url = "<?php echo site_url('adminpuskes/formposyandu');?>/"+id;
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".hapus").click(function(){
            var id = $(".seleksi").attr("href");
            var url = "<?php echo site_url('adminpuskes/hapusposyandu');?>/"+id;
            window.location = url;
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
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <!-- <button class="add btn btn-primary"><i class="fa fa-plus"></i></button>
                    <button class="edit btn btn-warning"><i class="fa fa-edit"></i></button>
                    <button class="hapus btn btn-danger"><i class="fa fa-minus"></i></button> -->    
                    <button class="add btn btn-outline btn-primary  dim" type="button"><i class="fa fa-plus"></i></button>
                    <button class="edit btn btn-outline btn-warning  dim" type="button"><i class="fa fa-edit"></i></button>
                    <button class="hapus btn btn-outline btn-danger  dim" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th class="text-center">Nama Posyandu</th>
                            <th width="200" class="text-center">Kecamatan</th>
                            <th width="100" class="text-center">RW</th>
                            <th width="300" class="text-center">Kelurahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							if ($q1->num_rows()<=0){
								echo "<tr><td colspan=5>Data Masih Kosong</td></tr>";
							} else {
								$i=1;
								$id_kecamatan = $id_kelurahan = $id_rw = "";
								foreach($q1->result() as $row){
									echo "<tr id=data href='".$row->id_posyandu."'>";
									if ($id_kecamatan<>$row->id_kecamatan){
										echo "<td>".($i++)."</td>";
										echo "<td>".$row->nama_kecamatan."</td>";
										$id_kecamatan = $row->id_kecamatan;
									}
									else
										echo "<td>&nbsp;</td><td>&nbsp;</td>";
									if ($id_kelurahan<>$row->id_kelurahan){
										echo "<td>".$row->nama_kelurahan."</td>";
										$id_kelurahan = $row->id_kelurahan;
									}
									else
										echo "<td>&nbsp;</td>";
									if ($id_rw<>$row->id_rw){
										echo "<td>".$row->nama_rw."</td>";
										$id_rw = $row->id_rw;
									}
									else
										echo "<td>&nbsp;</td>";
									echo  "<td>".$row->nama_posyandu."</td></tr>";
								}
							}
							?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>