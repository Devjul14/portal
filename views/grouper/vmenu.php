<li class="treeview <?php echo ($menu=='home' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
        <?php echo "<li>" . anchor("home", "Grafik") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/pelayanan", "Pelayanan") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/prosedur_masuk", "Prosedur Masuk") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/cara_masuk", "Cara Masuk") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/indeksalamat", "Indeks Alamat") . "</li>"; ?>
        <?php echo "<li>" . anchor("home/covid", "Covid-19") . "</li>"; ?>
        <?php echo "<li>" . anchor("radiologi/rekap_full/all", "Radiologi") . "</li>"; ?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=='grouper' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-object-group"></i>
        <span>Grouper</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
      <?php echo "<li>" . anchor("grouper/grouper_ralan", "Rawat Jalan") . "</li>"; ?>
      <?php echo "<li>" . anchor("grouper/grouper_inap", "Rawat Inap") . "</li>"; ?>
      <?php echo "<li>" . anchor("grouper/rekaplupis", "Rekap Lupis") . "</li>"; ?>
      <?php echo "<li>" . anchor("grouper/rekapobatkronis", "Rekap Obat Kronis") . "</li>"; ?>
      <?php echo "<li>" . anchor("grouper/rekap_klaim", "Rekap Klaim") . "</li>"; ?>
    </ul>
</li>
