<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('tarif/form_operasi');?>";
            window.location = url;
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");;
            var url = "<?php echo site_url('tarif/form_operasi');?>/"+id;
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
                            <!-- <th width="50">No</th> -->
                            <th width="150" class="text-center">Kode</th>
                            <th class="text-center">Nama Tindakan</th>
                            <th class="text-center">Kelas 1</th>
                            <th class="text-center">Kelas 2</th>
                            <th class="text-center">Kelas 3</th>
                            <th class="text-center">VIP 3</th>
                            <th class="text-center">VIP 2</th>
                            <th class="text-center">VIP 1</th>
                            <th class="text-center">Super VIP</th>
                            <th class="text-center">VIP Deluxe</th>
                            <th class="text-center">VIP Premium</th>
                            <th class="text-center">VIP Executive</th>
                            <th class="text-center">ICU</th>
                            <th class="text-center">Nicu</th>
                            <th class="text-center">Bayi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // $i=0;
                            foreach ($q->result() as $data) {
                                // $i++;
                                echo "<tr id=data href='".$data->kode."'>
                                        
                                        <td class='text-center'>".$data->kode."</td>
                                        <td>".$data->nama_tindakan."</td>
                                        <td>".number_format($data->kelas1, 0, ",", ".")."</td>
                                        <td>".number_format($data->kelas2, 0, ",", ".")."</td>
                                        <td>".number_format($data->kelas3, 0, ",", ".")."</td>
                                        <td>".number_format($data->vip3, 0, ",", ".")."</td>
                                        <td>".number_format($data->vip2, 0, ",", ".")."</td>
                                        <td>".number_format($data->vip1, 0, ",", ".")."</td>
                                        <td>".number_format($data->supervip, 0, ",", ".")."</td>
                                        <td>".number_format($data->vip_deluxe, 0, ",", ".")."</td>
                                        <td>".number_format($data->vip_premium, 0, ",", ".")."</td>
                                        <td>".number_format($data->vip_executive, 0, ",", ".")."</td>
                                        <td>".number_format($data->icu, 0, ",", ".")."</td>
                                        <td>".number_format($data->nicu, 0, ",", ".")."</td>
                                        <td>".number_format($data->bayi, 0, ",", ".")."</td>
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