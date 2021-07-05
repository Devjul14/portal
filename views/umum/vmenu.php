<li class="<?php echo ($menu=='dashboard' ? 'active' : '');?>">
    <?php echo anchor("farmasi","<i class='fa fa-dashboard'></i><span class='nav-label'>Dashboard</span>"); ?>
</li>
<li class="treeview <?php echo ($menu=='master_bu' ? 'active' : '');?>">
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
        <?php echo "<li>".anchor("master_bu/status_bu","Status")."</li>";?>
        <?php echo "<li>".anchor("master_bu/barang_umum","Master Barang Umum")."</li>";?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=='transaksi_bu' ? 'active' : '');?>">
    <a href="#">
        <i class="fa fa-exchange"></i>
        <span>Transaksi Barang Umum</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class="treeview-menu">
        <!-- <?php echo "<li>".anchor("stok_opname/list_stokopname","Stok Opname")."</li>";?> -->
        <?php echo "<li>".anchor("pengajuan_bu/pengajuan","Pengajuan")."</li>";?>
        <?php echo "<li>".anchor("rk_bu/rencana_kebutuhan","Rencana Kebutuhan")."</li>";?>
        <?php echo "<li>".anchor("permintaan_bu/permintaan_bu","Permintaan")."</li>";?>
        <?php echo "<li>".anchor("pemesanan_bu/pemesanan","Pemesanan")."</li>";?>
        <?php echo "<li>".anchor("penerimaan_bu/penerimaan","Penerimaan")."</li>";?>
        <?php echo "<li>".anchor("pembayaran_bu/pembayaran","Pembayaran")."</li>";?>
        <?php echo "<li>".anchor("distribusi_bu/distribusi","Distribusi")."</li>";?>
        <?php echo "<li>".anchor("distribusi_bu/inventaris","Inventaris")."</li>";?>
        <?php echo "<li>".anchor("distribusi_bu/history","History")."</li>";?>
    </ul>
</li>