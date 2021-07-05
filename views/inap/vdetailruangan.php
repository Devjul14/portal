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

        $(".back").click(function(){

            var url = "<?php echo site_url('inap/ruangan');?>";

            window.location = url;

            // alert(url);

            return false; 

        });

        $(".add").click(function(){

            var kelas = $("input[name='kelas']").val();

            var ruangan = $("input[name='ruangan']").val();

            var url = "<?php echo site_url('inap/tambahpasienruangan');?>/"+kelas+"/"+ruangan;

            window.location = url;

            // alert(url);

            return false; 

        });

        $(".pulang").click(function(){

            var id = $("#data").attr("href");

            var kelas = $("input[name='kelas']").val();

            var ruangan = $("input[name='ruangan']").val();

            var url = "<?php echo site_url('inap/pulang');?>/"+id+"/"+kelas+"/"+ruangan;

            window.location = url;

            // alert(url);

            return false; 

        });

        $(".rawat").click(function(){

            var id = $("#data").attr("href");

            var kelas = $("input[name='kelas']").val();

            var ruangan = $("input[name='ruangan']").val();

            var url = "<?php echo site_url('inap/perawatanpasien');?>/"+id+"/"+kelas+"/"+ruangan;

            window.location = url;

            // alert(url);

            return false; 

        });

        $(".pindah").click(function(){

            var id = $(this).attr("href");

            var kelas = $("input[name='kelas']").val();

            var ruangan = $("input[name='ruangan']").val();

            var url = "<?php echo site_url('inap/pindahkamar');?>/"+id+"/"+kelas+"/"+ruangan;

            window.location = url;

            // alert(url);

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
    <div class="box-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                   <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-2">

                            Kelas

                        </label>

                        <div class="col-md-1">

                            :

                        </div>

                            <label class="col-md-9">

                            <?=$nama_kelas;?>

                            <input type="hidden" name="kelas" value="<?=$id_kelas;?>">

                        </label>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2">

                            Ruangan

                        </label>

                        <div class="col-md-1">

                            :

                        </div>

                        <label class="col-md-9">

                            <?=$nama_ruangan;?>

                            <input type="hidden" name="ruangan" value="<?=$id_ruangan;?>">

                        </label>

                    </div>

                </div>

            </div>

        </div>

        <div class="ibox float-e-margins">

            <div class="ibox-title">

                <h3>List Pasien </h3>

                <div class="ibox-tools">

                    <button class="add btn btn-outline btn-primary" type="button"><i class="fa fa-plus"></i> Tambah</button>

                    <button class="pulang btn btn-outline btn-danger" type="button"><i class="fa fa-minus"></i> Pulang</button>

                </div>

            </div>

            <div class="ibox-content">

                <table class="table table-bordered table-hover" id="myTable">

                    <thead>

                        <tr>

                            <th width="50" class="text-center">No</th>

                            <th class="text-center">Nama Pasien</th>

                            <th width="150" class="text-center">Tgl Masuk</th>

                            <th width="50" class="text-center">Aksi</th>

                            <th width="50" class="text-center">Pindah Kamar</th>

                            <th width="50" class="text-center">Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php  

                            $i=0;

                            foreach ($q->result() as $data) {

                                $i++;

                                switch ($data->status) {

                                    case 'P':

                                        $a = "<label class='label label-danger'>Pulang</label>";

                                        break;

                                    case 'M':

                                        $a = "<label class='label label-primary'>Ada</label>";

                                        break;

                                    case 'PINDAH':

                                        $a = "<label class='label label-warning'>PINDAH</label>";

                                        break;

                                    

                                    

                                }

                                echo "<tr id=data href='".$data->no_reg."'>

                                        <td>".$i."</td>

                                        <td>".$data->nama_pasien."</td>

                                        <td>".$data->tgl_masuk."</td>

                                        <td>

                                            <button class='rawat btn btn-primary' href='".$data->no_reg."'><i class='fa fa-stethoscope'></i> Perawatan</button>

                                        </td>

                                        <td>

                                            <button class='pindah btn btn-warning' href='".$data->idpasienkamar."'><i class='fa fa-bed'></i> Pindah</button>

                                        </td>

                                        <td>".$a."</td>

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