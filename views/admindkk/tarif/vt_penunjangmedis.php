<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('tarif/form_penunjangmedis');?>";
            window.location = url;
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");;
            var url = "<?php echo site_url('tarif/form_penunjangmedis');?>/"+id;
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
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover" id="myTable">
                    <thead>
                        <tr class="bg-navy">
                            <th width="50">No</th>
                            <th width="150" class="text-center">Kode</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Tarif</th>
                            <th class="text-center">RS</th>
                            <th class="text-center">DR</th>
                            <th class="text-center">PT</th>
                            <th class="text-center">ST</th>
                            <th class="text-center">BB</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach ($q->result() as $data) {
                                $i++;
                                echo "<tr id=data href='".$data->kode."'>
                                        <td>".$i."</td>
                                        <td>".$data->kode."</td>
                                        <td>".$data->ket."</td>
                                        <td>".number_format($data->tarif, 0, ",", ".")."</td>
                                        <td>".number_format($data->rs, 0, ",", ".")."</td>
                                        <td>".number_format($data->dr, 0, ",", ".")."</td>
                                        <td>".number_format($data->pt, 0, ",", ".")."</td>
                                        <td>".number_format($data->st, 0, ",", ".")."</td>
                                        <td>".number_format($data->bb, 0, ",", ".")."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
          <div class="box-footer with-border">
                <div class="pull-right">
                    <div class="btn-group"> 
                        <button class="add btn btn-primary  dim" type="button"><i class="fa fa-plus"></i></button>
                        <button class="edit btn btn-warning  dim" type="button"><i class="fa fa-edit"></i></button>
                        <!-- <button class="hapus btn btn-danger  dim" type="button"><i class="fa fa-trash"></i></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>