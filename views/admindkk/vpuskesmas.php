<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('admindkk/formpuskesmas');?>";
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");;
            var url = "<?php echo site_url('admindkk/formpuskesmas');?>/"+id;
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".hapus").click(function(){
            var id = $(".bg-gray").attr("href");
            var url = "<?php echo site_url('admindkk/hapuspuskesmas');?>/"+id;
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
                    <button class="add btn btn-primary  dim" type="button"><i class="fa fa-plus"></i></button>
                    <button class="edit btn btn-warning  dim" type="button"><i class="fa fa-edit"></i></button>
                    <button class="hapus btn btn-danger  dim" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr class="bg-navy">
                        <th width="50" class="text-center">No</th>
                        <th width="200" class="text-center">Kecamatan</th>
                        <th class="text-center">Puskesmas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($q1->num_rows()<=0){
                            echo "
                                <tr>
                                    <td colspan=3>Data Masih Kosong</td>
                                </tr>";
                        } else {
                            $i=1;
                            $id_kecamatan = "";
                            foreach($q1->result() as $row){
                                echo "
                                    <tr id=data href='".$row->id_puskesmas."'>";
                                if ($id_kecamatan<>$row->id_kecamatan){
                                    echo "<td>".($i++)."</td>";
                                    echo "<td>".$row->nama_kecamatan."</td>";
                                    $id_kecamatan = $row->id_kecamatan;
                                    $n=1;
                                }
                                else
                                    echo "<td>&nbsp;</td><td>&nbsp;</td>";
                                echo "<td>".($n++).". ".$row->nama_puskesmas."</td>
                                      </tr>";
                            }
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>