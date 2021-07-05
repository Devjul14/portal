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

        var formattgl = "dd-mm-yyyy";

        $("input[name='tgl_pindah']").datepicker({ format : formattgl });

        // $(".back").click(function(){

        //     var url = "<?php echo site_url('inap/ruangan');?>";

        //     window.location = url;

        //     // alert(url);

        //     return false; 

        // });

        // $(".add").click(function(){

        //     var kelas = $("input[name='kelas']").val();

        //     var ruangan = $("input[name='ruangan']").val();

        //     var url = "<?php echo site_url('inap/tambahpasienruangan');?>/"+kelas+"/"+ruangan;

        //     window.location = url;

        //     // alert(url);

        //     return false; 

        // });

        // $(".pulang").click(function(){

        //     var id = $("#data").attr("href");

        //     var kelas = $("input[name='kelas']").val();

        //     var ruangan = $("input[name='ruangan']").val();

        //     var url = "<?php echo site_url('inap/pulang');?>/"+id+"/"+kelas+"/"+ruangan;

        //     window.location = url;

        //     // alert(url);

        //     return false; 

        // });

        // $(".rawat").click(function(){

        //     var id = $("#data").attr("href");

        //     var kelas = $("input[name='kelas']").val();

        //     var ruangan = $("input[name='ruangan']").val();

        //     var url = "<?php echo site_url('inap/perawatanpasien');?>/"+id+"/"+kelas+"/"+ruangan;

        //     // window.location = url;

        //     alert(url);

        //     return false; 

        // });

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

                    <?php echo form_open("inap/simpanpindahkamar",array("class"=>"form-horizontal"));?>

                    <div class="form-group">

                        <label class="col-md-2">

                            Pasien

                        </label>

                        <div class="col-md-1">

                            :

                        </div>

                        <label class="col-md-9">

                            <input type="text" name="nama_pasien" value="<?=$nama_pasien;?>" class="form-control" readonly>

                            <input type="hidden" name="id_pendaftaran" value="<?=$id;?>" class="form-control">

                            <input type="hidden" name="idpasien" value="<?=$idpasien;?>" class="form-control">

                        </label>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2">

                            Ruang / Kamar Lama

                        </label>

                        <div class="col-md-1">

                            :

                        </div>

                        <label class="col-md-9">

                            <input type="text" name="nama_ruangan" value="<?=$nama_ruangan;?>" class="form-control" readonly>

                            <input type="hidden" name="id_ruangan" value="<?=$id_ruangan;?>" class="form-control">

                            <input type="hidden" name="id_kelas" value="<?=$id_kelas;?>" class="form-control">

                        </label>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2">

                            Ruang / Kamar Baru

                        </label>

                        <div class="col-md-1">

                            :

                        </div>

                        <label class="col-md-9">

                            <select class="form-control" name="ruang_baru">

                                <?php  

                                    foreach ($q1->result() as $r) {

                                        echo "

                                            <option value='".$r->kode_ruangan."'>".$r->nama_ruangan." (".$r->no_bed.")</option>

                                        ";

                                    }

                                ?>

                            </select>

                        </label>

                    </div>

                    <div class="form-group">

                        <label class="col-md-2">

                            Tgl Pindah

                        </label>

                        <div class="col-md-1">

                            :

                        </div>

                        <div class="col-md-9">

                            <input type="text" name="tgl_pindah" class="form-control" value="<?=date('d-m-Y')?>">

                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">

                        <div class="col-sm-10 col-sm-offset-2">

                            <button class="btn btn-primary" type="submit">Simpan</button>

                        </div>

                    </div>

                    <?php echo form_close(); ?>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-12">

        <div class="ibox float-e-margins">

            <div class="ibox-content">

                <table class="table table-bordered table-hover" id="myTable">

                    <thead>

                        <tr>

                            <th width="50" class="text-center">No</th>

                            <th class="text-center">Tgl Pindah</th>

                            <th width="200" class="text-center">Ruangan Lama</th>

                            <th width="200" class="text-center">Ruangan Baru</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php  

                            $i=0;

                            foreach ($q3->result() as $data) {

                                $i++;

                                echo "<tr id=data >

                                        <td>".$i."</td>

                                        <td>".$this->tglindo->tgl($data->tgl_pindah,2)."</td>

                                        <td>".$data->rlama."</td>

                                        <td>".$data->rbaru."</td>

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