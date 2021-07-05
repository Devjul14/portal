<li class="treeview <?php echo ($menu=='home' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
        <?php echo "<li>" . anchor("home", "Grafik") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/pelayanan", "Rawat Inap") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/prosedur_masuk", "Prosedur Masuk") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/cara_masuk", "Cara Masuk") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/indeksalamat", "Indeks Alamat") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/covid", "Covid-19") . "</li>"; ?>
        <?php echo "<li>" . anchor("radiologi/rekap_full/all", "Radiologi") . "</li>"; ?>
        <?php echo "<li>" . anchor("lab/rekap_full/all", "Patologi Anatomi") . "</li>"; ?>
        <?php echo "<li>" . anchor("pa/rekap_full/all", "Patologi Anatomi") . "</li>"; ?>
        <?php echo "<li>" . anchor("Hemodialisa/rekap_full/all", "Haemodialisa") . "</li>"; ?>
        <?php echo "<li>" . anchor("gizi/rekap_full/all", "Gizi") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/rekap_full/all", "Poliklinik") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/igd", "IGD") . "</li>"; ?>
        <?php echo "<li>" . anchor("oka/rekap_full/all", "Oka") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/pasienrujuk", "Pasien Rujuk") . "</li>"; ?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=='kasir' ? 'active' : '');?>">
        <a href="#">
            <i class="fa fa-money"></i>
            <span>Kasir</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>".anchor("kasir/pembayaran_ralan","Rawat Jalan")."</li>";?>
            <?php echo "<li>".anchor("kasir/pembayaran_inap","Rawat Inap")."</li>";?>
            <?php echo "<li>".anchor("parkir","Parkir")."</li>";?>
            <?php echo "<li>".anchor("parkir/rekap","Rekap")."</li>";?>
        </ul>
    </li>
