<script>
    $(document).ready(function(){
        $("#listdata table tr#data:first").addClass("seleksi");
        $("#listdata2 table tr#data:first").addClass("seleksi");
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("seleksi");
            $(this).addClass("seleksi");
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tanggal']").datepicker({
            dateFormat : formattgl,
        });
        $(".back").click(function(){
            window.location = "<?php echo site_url('distribusi_bu/distribusi')?>";
            return false;
        });
        $(".hapus").click(function(){
            var kode= $(this).attr("href");
            var depo_tujuan = $("[name='depo_tujuan']").val();
            window.location = "<?php echo site_url('distribusi_bu/hapusitem_distribusi')?>/"+kode+"/"+depo_tujuan;
            return false;
        });
        $("[name='nama']").typeahead({
            source: function(query, process) {
                objects = [];
                map = {};
                var data = $.ajax({
                    url : "<?php echo base_url();?>distribusi_bu/getbu",
                    method : "POST",
                    async: false,
                    data : {nama: query}
                }).responseText;
                $.each(JSON.parse(data), function(i, object) {
                    map[object.id] = object;
                    objects.push(object.id+" | "+object.label+" | "+ object.satuan+" | "+ object.stok);
                });
                process(objects);
            },
            delay: 0,
            updater: function(item) {
                var n = item.split(" | ");
                var no_distribusi= $("[name='no_distribusi']").val();
                var kode = n[0];
                // alert(no_distribusi);
                var depo_tujuan = $("[name='depo_tujuan']").val();
                $.ajax({
                    url : "<?php echo base_url();?>distribusi_bu/simpanitem_distribusi",
                    method : "POST",
                    data : {kode: kode,no_distribusi: no_distribusi,depo_tujuan: depo_tujuan},
                    success: function(data){
                         location.reload();
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
                return n[0];
            }
        });
        $('.dataChange').click(function(evt) {
            evt.preventDefault();
            var dataText = $(this);
            var depo_tujuan = $("[name='depo_tujuan']").val();
            var no_distribusi = dataText.attr('id');
            var kode = dataText.attr('kode');
            var dataContent = dataText.text().trim();
            var dataInputField = $('<input type="text" value="' + dataContent + '" class="form-control" />');
            dataInputField.select();
            dataText.before(dataInputField).hide();
            dataInputField.focus().blur(function(){
                var inputval = dataInputField.val();
                $(this).remove();
                changeData(inputval,no_distribusi,kode,depo_tujuan);
            }).keyup(function(evt) {
                if (evt.keyCode == 13) {
                    var inputval = dataInputField.val();
                    $(this).remove();
                    changeData(inputval,no_distribusi,kode,depo_tujuan);
                }
            });
        });
    });
    var changeData = function(value,no_distribusi,kode,depo_tujuan){
        $.ajax({
            url: "<?php echo site_url('distribusi_bu/changedata_distribusi');?>", 
            type: 'POST', 
            data: {no_distribusi: no_distribusi,kode: kode, value: value, depo_tujuan: depo_tujuan}, 
            success: function(){
               location.reload();
            }
        });
    };
</script>
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
<div class="col-md-12">
    <?php 
        if($this->session->flashdata('message')){
            $pesan = explode('-', $this->session->flashdata('message'));
            echo "
                <div class='alert alert-".$pesan[0]."' alert-dismissable>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <b style='font-size:25px'>".$pesan[1]."</b>
                </div>";
        }
    ?>
    <div class="box box-info">
        <?php echo form_open("distribusi_bu/simpanubahstatus",array("id"=>"formsimpan","class"=>"form-horizontal"));?>
        <div class="box-body">
            <div class="form-group">
                <label class="col-md-2">
                    No Distribusi
                </label>
                <div class="col-md-4">
                   <input type="text" name="no_distribusi" value="<?php echo $no_distribusi ?>" class='form-control' readonly>
                </div>
                <label class="col-md-2">
                    Kode BU
                </label>
                <div class="col-md-4">
                   <input type="text" name="kode_bu" value="<?php echo $kode_bu ?>" class='form-control' readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    Status
                </label>
                <div class="col-md-4">
                    <input type="hidden" name="status_lama" value="<?php echo $q->kode_status ?>">
                    <select name="status_baru" class="form-control">
                        <option>----------</option>
                        <?php
                            foreach ($sb->result() as $dt) {
                                echo "
                                    <option value='".$dt->kode_status."' ".($dt->kode_status==$q->kode_status ? "selected" : "").">".$dt->nama_status."</option>
                                ";
                            }
                        ?>
                   </select>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="save btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
