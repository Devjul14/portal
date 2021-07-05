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
        $("select[name='kelas']").change(function(){
            var id = $(this).val();
            var url = "<?php echo site_url('inap/ruangan');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".add").click(function(){
            var id = $("select[name='kelas']").val();
            var url = "<?php echo site_url('inap/formruangan');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".seleksi").attr("href");;
            var url = "<?php echo site_url('inap/formruangan');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".hapus").click(function(){
            var id = $(".seleksi").attr("href");
            var url = "<?php echo site_url('inap/hapusruangan');?>/"+id;
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
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2">
                            Kelas
                        </label>
                        <div class="col-md-10">
                            <select class="form-control" name="kelas">
                                <option value="all">-- Semua --</option>
                                <?php  
                                    foreach ($q1->result() as $kls) {
                                        echo "
                                            <option value='".$kls->id_kelas."' ".($id_kelas==$kls->id_kelas ? "selected" : "").">".$kls->nama_kelas."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>                    
                </div>
                <div class="ibox-tools">
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
                            <th width="100" class="text-center">Id Ruangan</th>
                            <th class="text-center">Nama Ruangan</th>
                            <th width="200" class="text-center">No Bed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $i=0;
                            foreach ($q->result() as $data) {
                                $i++;
                                echo "<tr id=data href='".$data->id_kelas."/".$data->id_ruangan."'>
                                        <td>".$i."</td>
                                        <td>".$data->id_ruangan."</td>
                                        <td>".$data->nama_ruangan."</td>
                                        <td>".$data->no_bed."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>