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
        $(".add").click(function(){
            var url = "<?php echo site_url('adminpuskes/formparamedis');?>";
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".edit").click(function(){
            var id = $(".seleksi").attr("href");;
            var url = "<?php echo site_url('adminpuskes/formparamedis');?>/"+id;
            window.location = url;
            // alert(url);
            return false; 
        });
        $(".hapus").click(function(){
            var id = $(".seleksi").attr("href");
            var url = "<?php echo site_url('adminpuskes/hapusparamedis');?>/"+id;
            window.location = url;
            return false; 
        });
        $("select[name='id_jenisparamedis']").change(function(){
            var id = $(this).val();
            window.location = "<?php echo site_url('adminpuskes/paramedis')?>/"+id;
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
            <div class="ibox-content">
                <select name="id_jenisparamedis" class="form-control">
                    <option>-- Semua --</option>
                    <?php
                        foreach ($q2->result() as $row){
                            echo "<option value='".$row->id_jenisparamedis."' ".($row->id_jenisparamedis==$id_jenisparamedis ? "selected" : "").">".$row->jenis_paramedis."</option>";
                        }
                    ?>
                </select>  
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
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
                            <th class="text-center">Kel.Paramedis</th>
                            <th width="150" class="text-center">NIP</th>
                            <th width="200" class="text-center">Nama</th>
                            <th width="200" class="text-center">Layanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($q1->num_rows()<=0){
                                echo "<tr><td colspan=5>Data Masih Kosong</td></tr>";
                            } else {
                                $i=1;
                                $id_jenisparamedis = "";
                                foreach($q1->result() as $row){
                                    echo "<tr id=data href='".$row->id_paramedis."'>";
                                    if ($id_jenisparamedis<>$row->jenis_paramedis){
                                        echo "<td>".($i++)."</td>";
                                        echo "<td>".$row->nama_jenis_paramedis."</td>";
                                        $id_jenisparamedis = $row->jenis_paramedis;
                                    }
                                    else
                                        echo "<td>&nbsp;</td><td>&nbsp;</td>";
                                    echo "<td>".$row->nip."</td>
                                          <td>".$row->nama_paramedis."</td>
                                          <td>".$row->layanan."</td>
                                          </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>