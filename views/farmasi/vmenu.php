<li class="<?php echo ($menu=='dashboard' ? 'active' : '');?>">
    <?php echo anchor("farmasi","<i class='fa fa-dashboard'></i><span class='nav-label'>Dashboard</span>"); ?>
</li>
<li class="treeview <?php echo ($menu=='master' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-file"></i>
        <span>Master</span>
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
        <?php echo "<li>" . anchor("laporan/sensusharian", "Sensus Harian");?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=='transaksi' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-exchange"></i>
        <span>Transaksi</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
        <?php echo "<li>".anchor("stok_opname/list_stokopname","Stok Opname")."</li>";?>
        <?php echo "<li>".anchor("permintaan/pengajuan_depo","Pengajuan")."</li>";?>
        <?php echo "<li>".anchor("rk/rencana_kebutuhan","Rencana Kebutuhan")."</li>";?>
        <?php echo "<li>".anchor("permintaan/permintaan_obat","Permintaan")."</li>";?>
        <?php echo "<li>".anchor("pemesanan/pemesanan_obat","Pemesanan")."</li>";?>
        <?php echo "<li>".anchor("penerimaan/penerimaan_barang","Penerimaan")."</li>";?>
        <?php echo "<li>".anchor("pembayaran/pembayaran_barang","Pembayaran")."</li>";?>
        <?php echo "<li>".anchor("distribusi/distribusi_obat","Distribusi")."</li>";?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=='apotek' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-medkit"></i>
        <span>Apotek</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
        <?php echo "<li>".anchor("apotek_farmasi/list_igd","IGD")."</li>";?>
        <?php echo "<li>".anchor("apotek_farmasi/list_ralan","Rawat Jalan")."</li>";?>
        <?php echo "<li>".anchor("apotek_farmasi/list_inap","Rawat Inap")."</li>";?>
        <?php echo "<li>".anchor("penjualan_apotek","Penjualan Apotek")."</li>";?>
    </ul>
</li>
<!-- <li class="treeview <?php echo ($menu=='master_bu' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-file"></i>
        <span>Master Barang Umum</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
        <?php echo "<li>".anchor("master_bu/supplier","Supplier")."</li>";?>
        <?php echo "<li>".anchor("master_bu/kategori","Kategori")."</li>";?>
        <?php echo "<li>".anchor("master_bu/satuan_besar","Satuan Besar")."</li>";?>
        <?php echo "<li>".anchor("master_bu/satuan_kecil","Satuan Kecil")."</li>";?>
        <?php echo "<li>".anchor("master_bu/depo_bu","Depo Barang Umum")."</li>";?>
        <?php echo "<li>".anchor("master_bu/barang_umum","Master Barang Umum")."</li>";?>
    </ul>
</li> -->
<!-- <li class="treeview <?php echo ($menu=='transaksi_bu' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-exchange"></i>
        <span>Transaksi Barang Umum</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
        <?php echo "<li>".anchor("pengajuan_bu/pengajuan","Pengajuan")."</li>";?>
        <?php echo "<li>".anchor("rk_bu/rencana_kebutuhan","Rencana Kebutuhan")."</li>";?>
        <?php echo "<li>".anchor("permintaan_bu/permintaan_bu","Permintaan")."</li>";?>
        <?php echo "<li>".anchor("pemesanan_bu/pemesanan","Pemesanan")."</li>";?>
        <?php echo "<li>".anchor("penerimaan_bu/penerimaan","Penerimaan")."</li>";?>
        <?php echo "<li>".anchor("pembayaran_bu/pembayaran","Pembayaran")."</li>";?>
        <?php echo "<li>".anchor("distribusi_bu/distribusi","Distribusi")."</li>";?>
    </ul>
</li> -->
