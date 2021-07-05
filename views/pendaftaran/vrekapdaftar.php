<script>
    $(document).ready(function(){
        $('#myTable').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $('#myTable1').fixedHeaderTable({ height: '500', altClass: 'odd', footer: true});
        $("tr#data:first").addClass("bg-gray");
        var tgl1 = $("input[name='tgl1']").val();
        var tgl2 = $("input[name='tgl2']").val();
        var jenis = $("select[name='jenis']").val();
        var umur = $("input[name='umur']").val();
        var url = tgl1+"/"+tgl2+"/"+jenis+"/"+umur;
        $("#rekap").load("<?php echo site_url('pendaftaran/listrekap');?>/"+url);
        $("table tr#data ").click(function(){
            $("table tr#data ").removeClass("bg-gray");
            $(this).addClass("bg-gray");
        });
        $(".tampil").click(function(){
            var tgl1 = $("input[name='tgl1']").val();
            var tgl2 = $("input[name='tgl2']").val();
            var jenis = $("select[name='jenis']").val();
            var umur = $("input[name='umur']").val();
            var url = tgl1+"/"+tgl2+"/"+jenis+"/"+umur;
            $("#rekap").load("<?php echo site_url('pendaftaran/listrekap');?>/"+url);
            return false;
        });
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1']").datepicker({ dateFormat : formattgl });
        $("input[name='tgl2']").datepicker({ dateFormat : formattgl });
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2">Tanggal</label>
                        <div class="col-sm-4">
                            <input type="text" name="tgl1" class="form-control" value="<?php echo date('d-m-Y');?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="tgl2" class="form-control" value="<?php echo date('d-m-Y');?>">
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">Umur</label>
                        <div class="col-sm-4">
                            <select name='jenis' class='form-control'>
                                <option value="">---</option>
                                <option value="lebihbesar">Lebih besar dari</option>
                                <option value="lebihkecil">Lebih kecil dari</option>
                                <option value="samadengan">Sama dengan</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="umur" class="form-control">
                        </div>
                        <div class="col-sm-">
                            <button type="submit" name="Submit" class="tampil btn btn-primary bt-outline">
                                <i class='fa fa-search'></i> View
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <?php echo $this->session->flashdata('message');?>
        <div class="box-body">
            <span id=rekap></span>
        </div>
    </div>
</div>