<script>
    $(document).ready(function() {
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".add").click(function(){
            var url = "<?php echo site_url('perawat/formperawat');?>";
            window.location = url;
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".bg-gray").attr("href");;
            var url = "<?php echo site_url('perawat/formperawat');?>/"+id;
            window.location = url;
            return false; 
        });
        $(".hapus").click(function(){
            $(".modal").show();
        });
        $(".tidak").click(function(){
            $(".modal").hide();
        });
        $(".ya").click(function(){
            var id= $(".bg-gray").attr("href");
            window.location="<?php echo site_url('perawat/hapusperawat');?>/"+id;
            return false;
        });
    });
</script>
<div class="col-md-12">
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
        <div class="box-body">
            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr class="bg-navy">
                        <th width="50">No</th>
                        <th width="150" class="text-center">Id Perawat</th>
                        <th class="text-center">Nama Perawat</th>
                        <th width="150" class="text-center">No Telpon</th>
                        <th width="200" class="text-center">Alamat</th>
                   </tr>
               </thead>
               <tbody>
                   <?php  
                       $i=0;
                       foreach ($q->result() as $data) {
                           $i++;
                           echo "
                                <tr id=data href='".$data->id_perawat."'>
                                    <td>".$i."</td>
                                    <td>".$data->id_perawat."</td>
                                    <td>".$data->nama_perawat."</td>
                                    <td>".$data->no_telepon."</td>
                                    <td>".$data->alamat."</td>
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
                    <button class="hapus btn btn-danger  dim" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange"><h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;NOTIFICATION</h4></div>
            <div class='modal-body'>Yakin akan menghapus data ?</div>
            <div class='modal-footer'>
                <button class="ya btn btn-sm btn-danger">Ya</button>
                <button class="tidak btn btn-sm btn-success">Tidak</button>
            </div>
        </div>
    </div>
</div>