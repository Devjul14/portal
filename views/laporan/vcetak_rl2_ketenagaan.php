<script>
    window.print();
</script>
<table class="laporan" width="100%">
    <thead class="bg-navy">
        <tr>
            <!-- <th>Kode RS</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Nama RS</th> -->
            <th>Tahun</th>
            <th>Kode</th>
            <th>Kualifikasi Pendidikan</th>
            <th>Keadaan Laki-Laki</th>
            <th>Keadaan Perempuan</th>
            <th>Kebutuhan Laki-Laki</th>
            <th>Kebutuhan Perempuan</th>
            <th>Kekurangan Laki-Laki</th>
            <th>Kekurangan Perempuan</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($k["parent"] as $key => $value) {
                echo "<tr class='bg-orange'>";
                // echo "<td>3274020</td>";
                // echo "<td>KOTA CIREBON</td>";
                // echo "<td>JAWA BARAT</td>";
                // echo "<td>RS CIREMAI</td>";
                echo "<td>".$tahun."</td>";
                echo "<td>".$key."</td>";
                echo "<td>".$value->keterangan."</td>";
                echo "<td class='text-right'>".(isset($p[0][$key]) ? $p[0][$key]->keadaan_laki : 0)."</td>";
                echo "<td class='text-right'>".(isset($p[0][$key]) ? $p[0][$key]->keadaan_perempuan : 0)."</td>";
                echo "<td class='text-right'>".(isset($p[0][$key]) ? $p[0][$key]->kebutuhan_laki : 0)."</td>";
                echo "<td class='text-right'>".(isset($p[0][$key]) ? $p[0][$key]->kebutuhan_perempuan : 0)."</td>";
                echo "<td class='text-right'>".(isset($p[0][$key]) ? $p[0][$key]->kekurangan_laki : 0)."</td>";
                echo "<td class='text-right'>".(isset($p[0][$key]) ? $p[0][$key]->kekurangan_perempuan : 0)."</td>";
                echo "</tr>";
                foreach ($k['child'][$key] as $kode => $row) {
                    echo "<tr>";
                    // echo "<td>3274020</td>";
                    // echo "<td>KOTA CIREBON</td>";
                    // echo "<td>JAWA BARAT</td>";
                    // echo "<td>RS CIREMAI</td>";
                    echo "<td>".$tahun."</td>";
                    echo "<td>".$kode."</td>";
                    echo "<td>".$row->keterangan."</td>";
                    echo "<td class='text-right'>".(isset($p[$key][$kode]) ? $p[$key][$kode]->keadaan_laki : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p[$key][$kode]) ? $p[$key][$kode]->keadaan_perempuan : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p[$key][$kode]) ? $p[$key][$kode]->kebutuhan_laki : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p[$key][$kode]) ? $p[$key][$kode]->kebutuhan_perempuan : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p[$key][$kode]) ? $p[$key][$kode]->kekurangan_laki : 0)."</td>";
                    echo "<td class='text-right'>".(isset($p[$key][$kode]) ? $p[$key][$kode]->kekurangan_perempuan : 0)."</td>";
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>
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