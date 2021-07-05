<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
<script src="<?php echo base_url();?>js/jquery.js"></script>
<script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
<?php
    $content = "";
    $content .= '<tr><td style="font-family: arial;">No.RM</td><td style="font-family: arial;font-size:18px;letter-spacing:2px">'.$q->no_rm.'</td></tr>';
    $content .= '<tr><td style="font-family: arial;" colspan="2">'.($q->nama_pasien=="" ? "" : substr($q->nama_pasien, 0,21)).'</td></tr>';
    $content .= '<tr><td style="font-family: arial;">'.($q->jenis_kelamin=="L" ? "LAKI-LAKI" : "PEREMPUAN").'</td><td style="font-family: arial;">'.date("d-m-Y",strtotime($q->tgl_lahir)).'</td></tr>';
    $content .= '<tr><td style="font-family: arial;">'.$q->ruangan.'</td><td style="font-family: arial;">'.$q->kelas.' ['.$q->kode_kamar.'/'.$q->no_bed.']</td></tr>';
    $content .= '<tr><td style="vertical-align:top;align:left;float:left" colspan="2"><span class="barcode" id="barcode"></span></td></tr>';
?>
<section class="invoice no-border hide" id="invoice">
    <div style="width:16cm;height:3cm;display: block;">
        <div style="float: left;width:7cm; margin-left:0cm; display: block;">
            <table cellspacing="1" cellpadding="1" width="100%" style="font-size:11px;">
                <tbody class="konten_print"><?php echo $content;?></tbody>
            </table>
        </div>
        <div style="float: left;width:7cm;margin-left:1cm;display: block;">
            <table cellspacing="1" cellpadding="1" width="100%" style="font-size:11px;">
                <tbody class="konten_print"><?php echo $content;?></tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        var no_pasien = "<?php echo $no_pasien;?>";
        var no_reg = "<?php echo $no_reg;?>";
        $(".barcode").barcode(no_reg,"code128",{fontSize: 15,showHRI: true,marginHRI: 0,barHeight:28,barWidth: 1, moduleSize: 5});
        window.print();
    })
</script>
<style type="text/css">
    html, body {
        width: 16cm; 
        height: 3cm;
        display: block;
        margin-left: 0.3cm;
    }
    td {
        font-size: 12px;
        /*font-weight: bold;*/
        word-spacing: 0.05cm;
    }
    th {
        font-size: 12px;
        /*font-weight: bold;*/
        word-spacing: 0.05cm;
    }
    @page {
      size: 16cm 3cm;
        margin-left: 0.3cm;
    }
    .barcode > div{
        font-family: arial;
        margin-top: 0px;
        line-height: 23px;
        float: center;
    }
</style>