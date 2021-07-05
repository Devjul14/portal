    <li class="treeview <?php echo ($menu == 'urset' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Urset</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("suket/listkematian", "Rekap Surat Kematian") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listkelahiran", "Rekap Surat Kelahiran") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listberitamasukperawatan", "Masuk Perawatan") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listberitalepasperawatan", "Lepas Perawatan") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listsuratketerangandokter", "Keterangan Dokter") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listsuratistirahatsakit", "Istirahat Sakit") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listsuratmasuksekretariat", "Masuk Sekretariat") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listsurat_b_keluarsekretariat", "B Keluar Sekretariat") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listsprin_keluar", "Sprin Keluar") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listnarkoba", "Keterangan Narkoba") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listjiwa", "Keterangan Sehat Jiwa") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listrujukan_ralan", "Rujukan") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listcutitahunan", "Cuti Tahunan") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/listmou", "MOU") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/list_ba", "NO B.A") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/list_se", "SE Keluar") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/list_nokep", "NO Kep") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/list_noketkeluar", "NO Ket Keluar") . "</li>"; ?>
            <?php echo "<li>" . anchor("suket/list_kontrak", "SP-Kontrak") . "</li>"; ?>
        </ul>
    </li>