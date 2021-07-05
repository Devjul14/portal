<script type="text/javascript">
    var mywindow;

    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth / 2) - (width / 2));
        var top = parseInt((screen.availHeight / 2) - (height / 2));
        var windowFeatures = "width=" + width + ",height=" + height +
            ",status,resizable,left=" + left + ",top=" + top +
            ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function(e) {
        var formattgl = "dd-mm-yy";
        $("input[name='tgl1'], [name='tgl1_rekap']").datepicker({
            dateFormat: formattgl,
        });
        $("input[name='tgl2'], [name='tgl2_rekap']").datepicker({
            dateFormat: formattgl,
        });
        rekapobatkronis();
        $(".search_rekap").click(function() {
            rekapobatkronis();
            return false;
        });
        $(".print_rekap").click(function() {
            var tgl1 = $("[name='tgl1_rekap']").val();
            var tgl2 = $("[name='tgl2_rekap']").val();
            var url = "<?php echo site_url('grouper/cetak_rekapobatkronis'); ?>/" + tgl1 + "/" + tgl2;
            openCenteredWindow(url);
            return false;
        });
    });
    $(document).ajaxStart(function() {
        $('.loading').show();
    }).ajaxStop(function() {
        $('.loading').hide();
    });

    function rekapobatkronis() {
        var tgl1_rekap = $("[name='tgl1_rekap']").val();
        var tgl2_rekap = $("[name='tgl2_rekap']").val();
        $.ajax({
            type: "POST",
            data: {
                tgl1_rekap: tgl1_rekap,
                tgl2_rekap: tgl2_rekap
            },
            url: "<?php echo site_url('grouper/getrekapobatkronis'); ?>",
            success: function(result) {
                result = JSON.parse(result);
                var html = '<table class="table table-hover table-striped" id="myTable_rekap" style="width: 200px;">';
                html += '<thead>';
                html += '    <tr class="bg-navy">';
                html += '        <th>No.</th>';
                html += '        <th>No. RM</th>';
                html += '        <th>No. Reg</th>';
                html += '        <th>No. BPJS</th>';
                html += '        <th>No. SEP</th>';
                html += '        <th>Nama</th>';

                html += '        <th>File PDF</th>';
                html += '        <th>Jumlah</th>';
                html += '    </tr>';
                html += '</thead>';
                html += '<tbody>';
                var i = 1;
                var total = 0;
                $.each(result, function(key, value) {
                    html += "<tr>";
                    html += "<td>" + (i++) + "</td>";
                    html += "<td>" + value.no_pasien + "</td>";
                    html += "<td>" + value.no_reg + "</td>";
                    html += "<td>" + (value.no_bpjs == null ? "-" : value.no_bpjs) + "</td>";
                    html += "<td>" + (value.no_sjp == null ? "-" : value.no_sjp) + "</td>";
                    html += "<td>" + value.nama_pasien + "</td>";
                    html += "<td>" + (value.file_pdf == null ? "-" : value.file_pdf) + "</td>";
                    html += "<td>" + (value.obat_kronis == null ? "0" : number_format(parseInt(value.obat_kronis), 0, ',', '.')) + "</td>";
                    html += "</tr>";
                    total += parseInt(value.obat_kronis);
                });
                html += '</tbody>';
                html += '<tfoot>';
                html += '<tr class="bg-navy">';
                html += '<th colspan="6">TOTAL</th>';
                html += '<th class="text-right">' + number_format(total, 0, ',', '.') + '</th>';
                html += '</tr>';
                html += '</tfoot>';
                $(".list_rekap").html(html);
                $(".jumlah").html("<b>TOTAL " + (i - 1) + " Record</b>");
                $("[name='total']").val(i - 1);
                $('#myTable_rekap').fixedHeaderTable({
                    height: '450',
                    width: '1400',
                    altClass: 'odd',
                    footer: true
                });
            },
            error: function(result) {
                console.log(result);
            }
        });
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <div class='form-horizontal'>
                <div class="form-group">
                    <label class="col-md-2 control-label">
                        Tanggal
                    </label>
                    <div class="col-md-3">
                        <input type=hidden name="total">
                        <input type="text" name="tgl1_rekap" class="form-control" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="tgl2_rekap" class="form-control" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">
                    </div>
                    <div class="col-md-1">
                        <button class="search_rekap btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="list_rekap table-responsive">
                <table class="table table-bordered table-hover" style="justify">
                    <thead>
                        <tr class="bg-navy">
                            <th>No.</th>
                            <th>No. RM</th>
                            <th>No. Reg</th>
                            <th>No. BPJS</th>
                            <th>No. SEP</th>

                            <th width="100px">File PDF</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<tr>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='modal-footer'>
            <div class="pull-left"><span class="jumlah"></span></div>
            <button class="print_rekap btn btn-success">Print</button>
        </div>
    </div>
</div>
<div class='loading modal'>
    <div class='text-center align-middle' style="margin-top: 200px">
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
        <div class="alert col-xs-6 col-sm-6 col-lg-2" style="background-color: white;border-radius: 10px;">
            <div class="overlay" style="font-size:50px;color:#696969"><img src="<?php echo base_url(); ?>/img/load.gif" width="150px"></div>
            <div style="font-size:20px;font-weight:bold;color:#696969;margin-top:-30px;margin-bottom:20px">Loading</div>
        </div>
        <div class="col-xs-3 col-sm-3 col-lg-5"></div>
    </div>
</div>