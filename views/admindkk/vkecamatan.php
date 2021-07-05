<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('admindkk/formkecamatan');?>";
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");;
            var url = "<?php echo site_url('admindkk/formkecamatan');?>/"+id;
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('admindkk/hapususer');?>/"+id;
            window.location = url;
            return false; 
        });
    });
</script>
    <div class="col-xs-12">
        <?php
            if($this->session->flashdata('message')){
                $pesan=explode('-', $this->session->flashdata('message'));
                echo "<div class='alert alert-".$pesan[0]."' alert-dismissable>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>".$pesan[1]."</b>
                </div>";
            }
        
        ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="add btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                        <button class="edit btn btn-warning" type="button"><i class="fa fa-edit"></i></button>
                        <button class="hapus btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover" id="myTable">
                    <thead>
                        <tr class="bg-navy">
                            <th width="50" class="text-center">No</th>
                            <th class="text-center">Kecamatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $i=0;
                            foreach ($q->result() as $data) {
                                $i++;
                                echo "<tr id=data href='".$data->id_kecamatan."'>
                                        <td>".$i."</td>
                                        <td>".$data->nama_kecamatan."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>