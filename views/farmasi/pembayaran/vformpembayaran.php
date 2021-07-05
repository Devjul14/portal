<?php
  if ($q1) {
    $no_invoice       = $q1->no_invoice;
    $no_faktur        = $q1->no_faktur;
    $tgl_deadline     = $q1->tgl_deadline;
    $tanggal          = $q1->tanggal;

    $nama_bayar       = $q1->nama_bayar;
    $pangkat_bayar    = $q1->pangkat_bayar;
    $nrp_bayar        = $q1->nrp_bayar;
    $jabatan_bayar    = $q1->jabatan_bayar;

    $nama_penerima    = $q1->nama_penerima;
    $pangkat_penerima = $q1->pangkat_penerima;
    $jabatan_penerima = $q1->jabatan_penerima;
    $alamat_penerima  = $q1->alamat_penerima;

    $tahun_anggaran   = $q1->tahun_anggaran;
    $mata_anggaran    = $q1->mata_anggaran;
    $jenis_pengeluaran= $q1->jenis_pengeluaran;
    $terima_dari      = $q1->terima_dari;
    $keperluan        = $q1->keperluan;
    $keterangan       = $q1->keterangan;

    $r                = "disabled";
  } else {
    $no_invoice       = $row->no_invoice;
    $no_faktur        = $row->no_faktur;
    $tgl_deadline     = $row->tgl_deadline;
    $tanggal          = date("d/m/Y");
    $r                = 
    $nama_bayar       = "";
    $pangkat_bayar    = "";
    $nrp_bayar        = "";
    $jabatan_bayar    = "";

    $nama_penerima    = "";
    $pangkat_penerima = "";
    $jabatan_penerima = "";
    $alamat_penerima  = "";

    $tahun_anggaran   = "";
    $mata_anggaran    = "";
    $jenis_pengeluaran= "";
    $terima_dari      = "";
    $keperluan        = "";
    $keterangan       = "";
  }

?>
<script>
  var mywindow;
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth/2) - (width/2));
        var top = parseInt((screen.availHeight/2) - (height/2));
        var windowFeatures = "width=" + width + ",height=" + height +
                             ",status,resizable,left=" + left + ",top=" + top +
                             ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
  $(document).ready(function(){
    $(".print").click(function(){
        var no_penerimaan        = $("[name='no_penerimaan']").val();
        var no_pembayaran        = $("[name='no_pembayaran']").val();
        var url                  = "<?php echo site_url('pembayaran/cetak_kwitansi')?>/"+no_penerimaan+"/"+no_pembayaran;
        openCenteredWindow(url);
        return false;
    });
    $(".back").click(function(){
      window.location = "<?php echo site_url('pembayaran/pembayaran_barang')?>";
      return false;
    });
    $(".btnsimpan").click(function(){
      $(".modal").show();
    });
    $(".tidak").click(function(){
      $(".modal").hide();
    });
  }); 
</script>
<section class="invoice">
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
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> Pembayaran
        <small class="pull-right">Tanggal: <?php echo date("d/m/Y") ?></small>
      </h2>
    </div>
  </div>
  <?php echo form_open("pembayaran/simpanpembayaran",array("id"=>"formsimpan"));?>
  <input type="hidden" name="no_penerimaan" class="form-control" readonly value="<?php echo $no_penerimaan ?>">
  <input type="hidden" name="no_pembayaran" class="form-control" readonly value="<?php echo $no_pembayaran ?>">
  <input type="hidden" name="jumlah_bayar" class="form-control" readonly value="<?php echo $row->total ?>">
  <div class="row invoice-info">
    <div class="col-sm-3 invoice-col">
      <div class="form-group">
        <label class="col-md-12">
          No Penerimaan :
        </label>
        <div class="col-md-12">
          <?php echo $no_penerimaan ?>
        </div>
      </div>
    </div>
    <div class="col-sm-3 invoice-col">
      <div class="form-group">
        <label class="col-md-12">
          No Pembayaran :
        </label>
        <div class="col-md-12">
          <?php echo $no_pembayaran ?>
        </div>
      </div>
    </div>
    <div class="col-sm-3 invoice-col">
      <div class="form-group">
        <label class="col-md-12">
          No Invoice :
        </label>
        <div class="col-md-12">
          <?php echo $no_invoice ?>
        </div>
      </div>
    </div>
    <div class="col-sm-3 invoice-col">
      <div class="form-group">
        <label class="col-md-12">
          No Faktur :
        </label>
        <div class="col-md-12">
          <?php echo $no_faktur ?>
        </div>
      </div>
    </div>
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nama Obat</th>
            <th>Batch</th>
            <th>ED</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Disc</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($q->result() as $value) {
              echo "
                <tr>
                  <td>".$value->nama."</td>
                  <td>".$value->batch."</td>
                  <td>".$value->expire_date."</td>
                  <td>".number_format($value->harga,0,',','.')."</td>
                  <td>".$value->jumlah."</td>
                  <td>".$value->disc."%</td>
                  <td align=right>".number_format($value->total_harga,0,',','.')."</td>
                </tr>
              ";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <!-- <p class="lead">Payment Methods:</p>
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
      </p> -->
    </div>
    <div class="col-xs-6">
      <p class="lead">Tanggal Deadline <?php echo date("d/m/Y",strtotime($tgl_deadline)) ?></p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td align="right"><?php echo number_format($row->jumlah,0,',','.') ?></td>
          </tr>
          <tr>
            <th>PPN (10%)</th>
            <td align="right"><?php echo number_format(($row->jumlah*10/100),0,',','.') ?></td>
          </tr>
          <tr>
            <th>Pph 22(1,5%)</th>
            <td align="right"><?php echo number_format(($row->jumlah*1.5/100),0,',','.') ?></td>
          </tr>
          <?php echo $total = ($row->total+($row->jumlah*1.5/100)); ?>
          <tr>
            <th>Total:</th>
            <td align="right"><?php echo number_format($total,0,',','.') ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <hr width="100%" style="border-top: 1px solid;">
  <div class="header">
    <h3>Yang Membayarkan</h3>
  </div>
  <div class="form-group">
    <label class="col-md-12">Nama</label>
    <div class="col-md-12">
      <input type="text" name="nama_bayar" class="form-control" value="<?php echo $nama_bayar ?>" <?php echo $r ?>>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Pangkat</label>
    <div class="col-md-12">
      <input type="text" name="pangkat_bayar" class="form-control" value="<?php echo $pangkat_bayar ?>" <?php echo $r ?>  >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">NRP</label>
    <div class="col-md-12">
      <input type="text" name="nrp_bayar" class="form-control" value="<?php echo $nrp_bayar ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Jabatan</label>
    <div class="col-md-12">
      <input type="text" name="jabatan_bayar" class="form-control" value="<?php echo $jabatan_bayar ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="header">
    <h3>Yang Menerima</h3>
  </div>
  <div class="form-group">
    <label class="col-md-12">Nama</label>
    <div class="col-md-12">
      <input type="text" name="nama_penerima" class="form-control" value="<?php echo $nama_penerima ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Pangkat</label>
    <div class="col-md-12">
      <input type="text" name="pangkat_penerima" class="form-control" value="<?php echo $pangkat_penerima ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Jabatan</label>
    <div class="col-md-12">
      <input type="text" name="jabatan_penerima" class="form-control" value="<?php echo $jabatan_penerima ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Alamat</label>
    <div class="col-md-12">
      <textarea class="form-control" name="alamat_penerima" <?php echo $r ?>><?php echo $alamat_penerima ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Tahun Anggaran</label>
    <div class="col-md-12">
      <input type="text" name="tahun_anggaran" class="form-control" value="<?php echo $tahun_anggaran ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Mata Anggaran</label>
    <div class="col-md-12">
      <input type="text" name="mata_anggaran" class="form-control" value="<?php echo $mata_anggaran ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Jenis Pengeluaran</label>
    <div class="col-md-12">
      <input type="text" name="jenis_pengeluaran" class="form-control" value="<?php echo $jenis_pengeluaran ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Terima Dari</label>
    <div class="col-md-12">
      <input type="text" name="terima_dari" class="form-control" value="<?php echo $terima_dari ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Keperluan</label>
    <div class="col-md-12">
      <input type="text" name="keperluan" class="form-control" value="<?php echo $keperluan ?>" <?php echo $r ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">Keterangan</label>
    <div class="col-md-12">
      <textarea class="form-control" name="keterangan" <?php echo $r ?>><?php echo $keterangan ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12">&nbsp;</label>
    <div class="col-md-12">
      &nbsp;
    </div>
  </div>
  <div class='modal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header bg-orange">
                <h4 class='modal-title'><i class="icon fa fa-warning"></i>&nbsp;&nbsp;Hapus</h4>
            </div>
            <div class='modal-body'>
                Lanjutkan pembayaran?
            </div>
            <div class='modal-footer'>
                <button class="ya btn btn-sm btn-danger">Ya</button>
                <button type="button" class="tidak btn btn-sm btn-success">Tidak</button>
            </div>
        </div>
    </div>
  </div>
  <div class="row no-print">
    <div class="col-xs-12">
      <?php if ($row->status=="0"): ?>
        <button type="button" class="btnsimpan btn btn-success pull-right">
          <i class="fa fa-credit-card"></i> Proses Pembayaran
        </button>
        <button type="button" class="back btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-arrow-left"></i> Back
        </button>
      <?php else: ?>
        <button type="button" class="print btn btn-primary pull-right">
          <i class="fa fa-print"></i> Cetak Kwitansi
        </button>
        <button type="button" class="back btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-arrow-left"></i> Back
        </button>
      <?php endif ?>
    </div>
  </div>
  <?php echo form_close(); ?>
</section>