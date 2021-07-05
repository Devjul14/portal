<div class="col-xs-12 margin">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Pasien</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo $q->nama_pasien ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">No Reg</label>
                <div class="col-sm-4">
                    <input type="text" name="no_reg" class="form-control" readonly value="<?php echo $no_reg ?>">
                </div>
                <label class="col-sm-2 control-label">No RM</label>
                <div class="col-sm-3">
                    <input type="text" name="no_pasien" class="form-control" readonly value="<?php echo $no_pasien ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Tgl Lahir</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_pasien" class="form-control" readonly value="<?php echo ($q->tgl_lahir=="" ? "" : date("d-m-Y",strtotime($q->tgl_lahir))); ?>">
                </div>
            </div>
        </div>
    </div>
</div>