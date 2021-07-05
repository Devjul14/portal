<script>

    $(document).ready(function() {

        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});

        $("tr#data:first").addClass("bg-gray");

        $("table tr#data ").click(function(){

            $("table tr#data ").removeClass("bg-gray");

            $(this).addClass("bg-gray");

        });

        $(".add").click(function(){

            var url = "<?php echo site_url('ruangan/formkamar');?>";

            window.location = url;

            return false; 

        });

        $(".view").click(function(){

            var id = $(this).attr("href");

            var url = "<?php echo site_url('inap/ruanganpasien');?>/"+id;

            // alert(url);

            window.location = url;

            return false; 

        });


        $(".edit").click(function(){

            var id = $(".bg-gray").attr("href");

            var no_bed= $(".bg-gray").attr("no_bed");

            var url = "<?php echo site_url('ruangan/formkamar');?>/"+id+"/"+no_bed;

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
            var no_bed= $(".bg-gray").attr("no_bed");
            window.location="<?php echo site_url('inap/hapuskamar');?>/"+id+"/"+no_bed;
            return false;
        });
        $("select[name='kode_ruangan']").change(function(){
            var kode_ruangan    =   $(this).val();
            var kode_kelas      =   $("select[name='kode_kelas']").val();
            var url = "<?php echo site_url('inap/pasien');?>/"+kode_ruangan+"/"+kode_kelas;
            window.location = url;
            return false; 

        });
        $("select[name='kode_kelas']").change(function(){
            var kode_ruangan    =   $("select[name='kode_ruangan']").val();
            var kode_kelas      =   $(this).val();
            var url = "<?php echo site_url('inap/pasien');?>/"+kode_ruangan+"/"+kode_kelas;
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
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-12">
                            Ruangan
                        </label>
                        <div class="col-xs-12">
                            <select name="kode_ruangan" class="form-control">
                                <option value="---">---</option>
                                <?php
                                    foreach ($q1->result() as $val1) {
                                        echo "
                                            <option value='".$val1->kode_ruangan."' ".($kode_ruangan==$val1->kode_ruangan ? "selected" : "").">".$val1->nama_ruangan."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12">
                            Kelas
                        </label>
                        <div class="col-xs-12">
                            <select name="kode_kelas" class="form-control">
                                <option value="---">---</option>
                                <?php
                                    foreach ($q2->result() as $val2) {
                                        echo "
                                            <option value='".$val2->kode_kelas."' ".($kode_kelas==$val2->kode_kelas ? "selected" : "").">".$val2->nama_kelas."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-hover" id="myTable">

                    <thead>

                        <tr class="bg-navy">

                            <th width="50">No</th>
                            <th width="150" class="text-center">Kode Kamar</th>
                            <th width="150" class="text-center">Ruangan</th>
                            <th width="150" class="text-center">Kelas</th>
                            <th class="text-center">Nama Kamar</th>
                            <th width="100" class="text-center">No Bed</th>
                            <th width="150" class="text-center">Tarif Kamar</th>
                            <th width="150" class="text-center">Status Kamar</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php  

                            $i=0;

                            foreach ($q->result() as $data) {
                                if ($data->status_kamar=="KOSONG") {
                                    $label = "<label class='label label-success'>KOSONG</label>";
                                } else {
                                    $label = "<label class='label label-danger'>ISI</label>";
                                }
                                

                                $i++;

                                echo "<tr id=data href='".$data->kode_kamar."' no_bed='".$data->no_bed."'>

                                        <td>".$i."</td>

                                        <td>".$data->kode_kamar."</td>

                                        <td>".$data->nama_ruangan."</td>

                                        <td>".$data->nama_kelas."</td>

                                        <td>".$data->nama_kamar."</td>

                                        <td>".$data->no_bed."</td>

                                        <td>Rp. ".number_format($data->tarif_kamar,0,',','.')."</td>

                                         <td> <button href='".$data->kode_kelas."/".$data->kode_ruangan."' class='view btn btn-primary'><i class='fa fa-search'></i> Lihat Pasien</button></td>


                                    </tr>

                                ";

                            }

                        ?>

                    </tbody>

                </table>

            </div>

          <div class="box-footer with-border">

         <!--        <div class="pull-right">

                    <div class="btn-group">   

                        <button class="add btn btn-primary  dim" type="button"><i class="fa fa-plus"></i></button>

                        <button class="edit btn btn-warning  dim" type="button"><i class="fa fa-edit"></i></button>

                        <button class="hapus btn btn-danger  dim" type="button"><i class="fa fa-trash"></i></button>

                    </div>

                </div> -->

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