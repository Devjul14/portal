<!DOCTYPE html>
<html>
    <script>
        window.print();
    </script>
<body>
<table class="laporan" border="1" width="100%">
    <thead class="bg-gray">
        <tr>
            <!-- <th>Kode RS</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Nama RS</th> -->
            <th>Tahun</th>
            <th>No</th>
            <th>Jenis Pelayanan</th>
            <th>Total Rujukan</th>
            <th>Total Nonrujukan</th>
            <th>Tindak Lanjut Pelayanan Dirawat</th>
            <th>Tindak Lanjut Pelayanan Pulang</th>
            <th>Mati di IGD</th>
            <th>DOA</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($k as $key => $value) {
                echo "<tr>";
                // echo "<td>3274020</td>";
                // echo "<td>KOTA CIREBON</td>";
                // echo "<td>JAWA BARAT</td>";
                // echo "<td>RS CIREMAI</td>";
                echo "<td>".$tahun."</td>";
                echo "<td>".$key."</td>";
                echo "<td>".$value."</td>";
                echo "<td class='text-right'>".number_format($q["total_rujuk"][$key],0)."</td>";
                echo "<td class='text-right'>".number_format($q["total_ralan"][$key]+$q["total_ranap"][$key],0)."</td>";
                echo "<td class='text-right'>".number_format($q["total_ralan"][$key],0)."</td>";
                echo "<td class='text-right'>".number_format($q["total_ranap"][$key],0)."</td>";
                echo "<td class='text-right'>".number_format($q["total_matiigd"][$key],0)."</td>";
                echo "<td class='text-right'>".number_format($q["total_doa"][$key],0)."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
</body>
</html>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
    }
    .laporan > thead > tr > th,
    .laporan > tbody > tr > th,
    .laporan > tfoot > tr > th,
    .laporan > thead > tr > td,
    .laporan > tbody > tr > td,
    .laporan > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .laporan > caption + thead > tr:first-child > th,
    .laporan > colgroup + thead > tr:first-child > th,
    .laporan > thead:first-child > tr:first-child > th,
    .laporan > caption + thead > tr:first-child > td,
    .laporan > colgroup + thead > tr:first-child > td,
    .laporan > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .laporan td,
    .laporan th {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }
</style>