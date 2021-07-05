<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
<script src="<?php echo base_url();?>js/jquery.js"></script>
<script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
<?php
    $content = "";
    foreach ($q->result() as $value) {
        $content .= '<tr><td style="font-family: sans-serif;" colspan="2">'.substr($value->nama_dokter,0,15).'<span style="font-family: sans-serif;float:right"><font style= "font-size:13px !important;">('.$value->no_antrian.')</font></span></td></tr>';
        $content .= '<tr><td colspan="2" style="font-family: sans-serif;">'.$value->nama_poli.'</td></tr>';
        $content .= '<tr><td style="font-family: sans-serif;">No.RM</td><td style="font-family: sans-serif;">: '.$value->no_pasien.'</td></tr>';
        $content .= '<tr><td style="font-family: sans-serif;">No.Reg</td><td style="font-family: sans-serif;">: '.$value->no_reg.'</td></tr>';
        $content .= '<tr><td style="font-family: sans-serif;" colspan="2">'.($value->nama_pasien=="" ? "" : substr($value->nama_pasien, 0,21)).'</td></tr>';
    }
?>
<section class="invoice no-border hide" id="invoice">
    <?php if ($status=="RADIOLOGI"): ?>
        <div style="width:16cm;height:3cm;display: block;">
            <div style="float: left;width:7cm; margin-left:0cm; display: block;">
                <table cellspacing="1" cellpadding="1" width="100%" style="font-size:11px;">
                    <tbody class="konten_print"><?php echo $content;?></tbody>
                    <tfoot>
                        <tr><td colspan="2"><span class="barcode" id="barcode"></span></td></tr>
                    </tfoot>
                </table>
            </div>
            <div style="float: left;width:7cm;margin-left:1cm;display: block;">
                <table cellspacing="1" cellpadding="1" width="100%" style="font-size:11px;">
                    <tbody class="konten_print"><?php echo $content;?></tbody>
                    <tfoot>
                        <tr><td colspan="2"><span class="barcode" id="barcode"></span></td></tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <style type="text/css">
            html, body {
                width: 17cm; 
                height: 3cm;
                display: block;
                margin-left: 0.3cm;
            }
            td {
                font-size: 15px;
                /*font-weight: bold;*/
                word-spacing: 0.05cm;
            }
            th {
                font-size: 15px;
                /*font-weight: bold;*/
                word-spacing: 0.05cm;
            }
            @page {
              size: 17cm 3cm;
                margin-left: 0.3cm;
            }
        </style>
    <?php else: ?>
        <div style="width:14cm;height:2.59cm;display: block;">
            <div style="float: left;width:3.5cm; margin-left:-0.5cm; display: block;">
                <table cellspacing="1" cellpadding="1" width="100%" style="font-size:11px;">
                    <tbody class="konten_print"><?php echo $content;?></tbody>
                    <tfoot>
                        <tr><td colspan="2"><span class="barcode" id="barcode"></span></td></tr>
                    </tfoot>
                </table>
            </div>
            <div style="float: left;width:3.5cm;margin-left:2cm;display: block;">
                <table cellspacing="1" cellpadding="1" width="100%" style="font-size:11px;">
                    <tbody class="konten_print"><?php echo $content;?></tbody>
                    <tfoot>
                        <tr><td colspan="2"><span class="barcode" id="barcode"></span></td></tr>
                    </tfoot>
                </table>
            </div>
            <div style="float: left;width:3.5cm;margin-left:2cm;display: block;">
                <table cellspacing="1" cellpadding="1" width="100%" style="font-size:11px;">
                    <tbody class="konten_print"><?php echo $content;?></tbody>
                    <tfoot>
                        <tr><td colspan="2"><span class="barcode" id="barcode"></span></td></tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <style type="text/css">
            html, body {
                width: 17cm; 
                height: 2.59cm;
                display: block;
                margin-left: 0.3cm;
            }
            td {
                font-size: 10px;
                /*font-weight: bold;*/
                word-spacing: 0.05cm;
            }
            th {
                font-size: 10px;
                /*font-weight: bold;*/
                word-spacing: 0.05cm;
            }
            @page {
              size: 17cm 2.59cm;
                margin-left: 0.3cm;
            }
        </style>
    <?php endif ?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        var no_pasien = "<?php echo $no_pasien;?>";
        var no_reg = "<?php echo $no_reg;?>";
        $(".barcode").barcode(no_reg,"code128",{showHRI: false,barHeight:20,barWidth: 1, moduleSize: 5});
        window.print();
        // window.close();
    })
</script>