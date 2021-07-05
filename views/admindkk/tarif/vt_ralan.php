<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('tarif/form_ralan');?>";
            window.location = url;
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");;
            var url = "<?php echo site_url('tarif/form_ralan');?>/"+id;
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
                            <th class="text-center">Nama Tindakan</th>
                            <th class="text-center">Reguler</th>
                            <th class="text-center">Executive</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach ($q->result() as $data) {
                                $i++;
                                echo "<tr id=data href='".$data->kode_tindakan."'>
                                        <td>".$i."</td>
                                        <td>".$data->kode_tindakan."</td>
                                        <td>".$data->nama_tindakan."</td>
                                        <td>".number_format($data->reguler, 0, ",", ".")."</td>
                                        <td>".number_format($data->executive, 0, ",", ".")."</td>
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