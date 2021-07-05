<?php if ($this->session->userdata("idstatus") == 21) : ?>
    <li class="treeview <?php echo ($menu == 'home' ? 'active' : ''); ?>">
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
            <?php echo "<li>" . anchor("lab/rekap_full/all", "Labotarium") . "</li>"; ?>
        </ul>
    </li>
    <li class="<?php echo ($menu == 'retensi' ? 'active' : ''); ?>">
        <?php echo anchor("retensi", "<i class='fa fa-minus'></i><span class='nav-label'>Retensi</span>"); ?>
    </li>
    <li class="<?php echo ($menu == 'user' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran", "<i class='fa fa-user-plus'></i><span class='nav-label'>Daftar Pasien Baru</span>"); ?>
    </li>
    <li class="<?php echo ($menu == 'ralan' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran/rawat_jalan", "<i class='fa fa-ambulance'></i><span class='nav-label'>Rawat Jalan</span>"); ?>
    </li>
    <li class="<?php echo ($menu == 'inap' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran/rawat_inap", "<i class='fa fa-bed'></i><span class='nav-label'>Rawat Inap</span>"); ?>
    </li>
    <li class="treeview <?php echo ($menu == 'laporan' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Laporan</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview <?php echo ($menu == 'laporan' ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>RL</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php
                    echo "<li>".anchor("laporan/list_rl12","RL 1.2")."</li>";
                    echo "<li>" . anchor("laporan/list_rl2a_ralan", "RL2B") . "</li>";
                    echo "<li>" . anchor("laporan/list_rl2a", "RL2A") . "</li>";
                    echo "<li>" . anchor("laporan/list_rl2a1", "RL2A 1") . "</li>";
                    echo "<li>" . anchor("laporan/list_rl3a", "RL3A") . "</li>";
                    echo "<li>" . anchor("laporan/rl2_ketenagaan", "RL2 Ketenagaan" . "</li>");
                    echo "<li>" . anchor("laporan/rl32_rawatdarurat", "RL3.2 Rawat Darurat" . "</li>");
                    ?>
                </ul>
            </li>
            <li class="treeview <?php echo ($menu == 'laporan' ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>XKR</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php
                    echo "<li>" . anchor("laporan/xkr15", "XKR 15") . "</li>";
                    echo "<li>" . anchor("laporan/xkr14", "XKR 14") . "</li>";
                    echo "<li>" . anchor("laporan/xkr13", "XKR 13") . "</li>";
                    ?>
                </ul>
            </li>
            <?php
            echo "<li>" . anchor("laporan/daftarpasien", "Daftar Pasien") . "</li>";
            echo "<li>" . anchor("laporan/covid", "Laporan Covid");
            ?>
        </ul>
    </li>
<?php elseif ($this->session->userdata("idstatus") == 22) : ?>
    <li class="treeview <?php echo ($menu == 'home' ? 'active' : ''); ?>">
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
            <?php echo "<li>" . anchor("lab/rekap_full/all", "Labotarium") . "</li>"; ?>
        </ul>
    </li>
    <li class="<?php echo ($menu == 'ralan' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran/rawat_jalan", "<i class='fa fa-ambulance'></i><span class='nav-label'>Rawat Jalan</span>"); ?>
    </li>
<?php elseif ($this->session->userdata("idstatus") == 23) : ?>
    <li class="treeview <?php echo ($menu == 'home' ? 'active' : ''); ?>">
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
            <?php echo "<li>" . anchor("lab/rekap_full/all", "Labotarium") . "</li>"; ?>
        </ul>
    </li>
    <li class="<?php echo ($menu == 'inap' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran/rawat_inap", "<i class='fa fa-bed'></i><span class='nav-label'>Rawat Inap</span>"); ?>
    </li>
<?php else : ?>
    <li class="treeview <?php echo ($menu == 'home' ? 'active' : ''); ?>">
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
            <?php echo "<li>" . anchor("lab/rekap_full/all", "Labotarium") . "</li>"; ?>
        </ul>
    </li>
    <li class="<?php echo ($menu == 'retensi' ? 'active' : ''); ?>">
        <?php echo anchor("retensi", "<i class='fa fa-minus'></i><span class='nav-label'>Retensi</span>"); ?>
    </li>
    <li class="<?php echo ($menu == 'user' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran", "<i class='fa fa-user-plus'></i><span class='nav-label'>Daftar Pasien Baru</span>"); ?>
    </li>
    <li class="<?php echo ($menu == 'ralan' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran/rawat_jalan", "<i class='fa fa-ambulance'></i><span class='nav-label'>Rawat Jalan</span>"); ?>
    </li>
    <li class="<?php echo ($menu == 'inap' ? 'active' : ''); ?>">
        <?php echo anchor("pendaftaran/rawat_inap", "<i class='fa fa-bed'></i><span class='nav-label'>Rawat Inap</span>"); ?>
    </li>
    <li class="treeview <?php echo ($menu == 'kasir' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-money"></i>
            <span>Kasir</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("kasir/pembayaran_ralan", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("kasir/pembayaran_inap", "Rawat Inap") . "</li>"; ?>
            <?php echo "<li>" . anchor("parkir", "Parkir") . "</li>"; ?>
            <?php echo "<li>" . anchor("parkir/rekap", "Rekap") . "</li>"; ?>
            <?php echo "<li>" . anchor("kasir/keuangan", "Sharing") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'keuangan' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-database"></i>
            <span>Keuangan</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("keuangan", "Pajak") . "</li>"; ?>
            <?php echo "<li>" . anchor("keuangan/feesharing", "Fee") . "</li>"; ?>
            <?php echo "<li>" . anchor("keuangan/pointsharing", "Point") . "</li>"; ?>
            <?php echo "<li>" . anchor("keuangan/hdsharing", "Haemodialisa") . "</li>"; ?>
            <?php echo "<li>" . anchor("keuangan/perawatsharing", "Asisten Anaestesi") . "</li>"; ?>
            <?php echo "<li>" . anchor("keuangan/subsidi", "Kontribusi Dinas") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'grouper' ? 'active' : ''); ?>">
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
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'apotek' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-medkit"></i>
            <span>Apotek</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("apotek/list_igd", "IGD") . "</li>"; ?>
            <?php echo "<li>" . anchor("apotek/list_ralan", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("apotek/list_inap", "Rawat Inap") . "</li>"; ?>
            <?php echo "<li>" . anchor("penjualan_apotek", "Penjualan Apotek") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'farmasi' || $menu == 'master' || $menu == 'transaksi' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-hourglass-half"></i>
            <span>Farmasi</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview <?php echo ($menu == 'farmasi' ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>Master</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo "<li>" . anchor("farmasi/industri", "Industri Farmasi") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/supplier", "Supplier Farmasi") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/kategori", "Kategori") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/satuan", "Satuan Besar") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/satuan_kecil", "Satuan Kecil") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/jenis", "Jenis") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/golongan", "Golongan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/klasifikasi", "Klasifikasi") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/metode_racik", "Metode Racik") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/masterobat", "Master Obat") . "</li>"; ?>
                    <?php echo "<li>" . anchor("farmasi/depo", "Depo Obat") . "</li>"; ?>
                </ul>
            </li>
            <li class="treeview <?php echo ($menu == 'farmasi' ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-exchange"></i>
                    <span>Transaksi</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo "<li>" . anchor("stok_opname/list_stokopname", "Stok Opname") . "</li>"; ?>
                    <?php echo "<li>" . anchor("permintaan/pengajuan_depo", "Pengajuan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("rk/rencana_kebutuhan", "Rencana Kebutuhan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("permintaan/permintaan_obat", "Permintaan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("pemesanan/pemesanan_obat", "Pemesanan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("penerimaan/penerimaan_barang", "Penerimaan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("pembayaran/pembayaran_barang", "Pembayaran") . "</li>"; ?>
                    <?php echo "<li>" . anchor("distribusi/distribusi_obat", "Distribusi") . "</li>"; ?>
                </ul>
            </li>
            <!-- <li class="treeview <?php echo ($menu == 'farmasi' ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-medkit"></i>
                    <span>Apotek</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo "<li>" . anchor("apotek_farmasi/list_igd", "IGD") . "</li>"; ?>
                    <?php echo "<li>" . anchor("apotek_farmasi/list_ralan", "Rawat Jalan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("apotek_farmasi/list_inap", "Rawat Inap") . "</li>"; ?>
                    <?php echo "<li>" . anchor("penjualan_apotek", "Penjualan Apotek") . "</li>"; ?>
                </ul>
            </li> -->
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'radiologi' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-hospital-o"></i>
            <span>Radiologi</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("radiologi/ralan", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("radiologi/inap", "Rawat Inap") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'lab' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-share-alt"></i>
            <span>Lab</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("lab/ralan", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("lab/inap", "Rawat Inap") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'pa' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-bullseye"></i>
            <span>Patologi Anatomi</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("pa/ralan", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("pa/inap", "Rawat Inap") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'gizi' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-balance-scale"></i>
            <span>Gizi</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("gizi/ralan", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("gizi/inap", "Rawat Inap") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'master_bu' || $menu == 'transaksi_bu'  ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-cube"></i>
            <span>Barang Umum</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview <?php echo ($menu == 'master_bu' ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>Master</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo "<li>" . anchor("master_bu/supplier", "Supplier") . "</li>"; ?>
                    <?php echo "<li>" . anchor("master_bu/kategori", "Kategori") . "</li>"; ?>
                    <?php echo "<li>" . anchor("master_bu/satuan_besar", "Satuan Besar") . "</li>"; ?>
                    <?php echo "<li>" . anchor("master_bu/satuan_kecil", "Satuan Kecil") . "</li>"; ?>
                    <?php echo "<li>" . anchor("master_bu/depo_bu", "Depo Barang") . "</li>"; ?>
                    <?php echo "<li>" . anchor("master_bu/status_bu", "Status") . "</li>"; ?>
                    <?php echo "<li>" . anchor("master_bu/barang_umum", "Master Barang") . "</li>"; ?>
                </ul>
            </li>
            <li class="treeview <?php echo ($menu == 'transaksi_bu' ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-exchange"></i>
                    <span>Transaksi</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <!-- <?php echo "<li>" . anchor("stok_opname/list_stokopname", "Stok Opname") . "</li>"; ?> -->
                    <?php echo "<li>" . anchor("pengajuan_bu/pengajuan", "Pengajuan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("rk_bu/rencana_kebutuhan", "Rencana Kebutuhan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("permintaan_bu/permintaan_bu", "Permintaan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("pemesanan_bu/pemesanan", "Pemesanan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("penerimaan_bu/penerimaan", "Penerimaan") . "</li>"; ?>
                    <?php echo "<li>" . anchor("pembayaran_bu/pembayaran", "Pembayaran") . "</li>"; ?>
                    <?php echo "<li>" . anchor("distribusi_bu/distribusi", "Distribusi") . "</li>"; ?>
                    <?php echo "<li>" . anchor("distribusi_bu/inventaris", "Inventaris") . "</li>"; ?>
                    <?php echo "<li>" . anchor("distribusi_bu/history", "History") . "</li>"; ?>
                </ul>
            </li>
        </ul>
    </li>
    <li class="<?php echo ($menu == 'oka' ? 'active' : ''); ?>">
        <?php echo anchor("oka", "<i class='fa fa-wheelchair'></i><span class='nav-label'>OK</span>"); ?>
    </li>
    <li class="treeview <?php echo ($menu == 'laporan' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Laporan</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>RL</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php
                    // echo "<li>".anchor("laporan/rl12_indikator","RL 1.2 Indikator")."</li>";
                    echo "<li>" . anchor("laporan/list_rl2a_ralan", "RL2B") . "</li>";
                    echo "<li>" . anchor("laporan/list_rl2a", "RL2A") . "</li>";
                    echo "<li>" . anchor("laporan/list_rl2a1", "RL2A 1") . "</li>";
                    echo "<li>" . anchor("laporan/list_rl3a", "RL3A") . "</li>";
                    echo "<li>" . anchor("laporan/rl2_ketenagaan", "RL2 Ketenagaan");
                    echo "<li>" . anchor("laporan/rl32_rawatdarurat", "RL3.2 Rawat Darurat");
                    echo "<li>" . anchor("laporan/list_rl12", "RL 1.2") . "</li>";
                    ?>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>XKR</span>
                    <i class='fa fa-angle-left pull-right'></i>
                </a>
                <ul class="treeview-menu">
                    <?php
                    echo "<li>" . anchor("laporan/xkr15", "XKR 15") . "</li>";
                    echo "<li>" . anchor("laporan/xkr14", "XKR 14") . "</li>";
                    echo "<li>" . anchor("laporan/xkr13", "XKR 13") . "</li>";
                    ?>
                </ul>
            </li>
            <?php
            echo "<li>" . anchor("laporan/inos_harian", "Inos Harian");
            echo "<li>" . anchor("laporan/daftarpasien", "Daftar Pasien") . "</li>";
            echo "<li>" . anchor("laporan/covid", "Laporan Covid");
            echo "<li>" . anchor("laporan/kunjunganralan", "Kunjungan Ralan");
            echo "<li>" . anchor("laporan/kunjunganranap", "Kunjungan Ranap");
            ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'dokter' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-user"></i>
            <span>Dokter</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <?php echo "<li>" . anchor("dokter/pasienigd", "IGD") . "</li>"; ?>
            </li>
            <?php echo "<li>" . anchor("dokter/rawat_jalandokter", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("dokter/rawat_inapdokter_ranap", "Rawat Inap") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'perawat' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>Perawat</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("dokter/rawat_inapdokter", "Triage") . "</li>"; ?>
            <?php echo "<li>" . anchor("perawat/pasienigd", "IGD") . "</li>"; ?>
            <?php echo "<li>" . anchor("perawat/pasienralan", "Rawat Jalan") . "</li>"; ?>
            <?php echo "<li>" . anchor("perawat/pasieninap", "Rawat Inap") . "</li>"; ?>
        </ul>
    </li>
    <li class="treeview <?php echo ($menu == 'urset' ? 'active' : ''); ?>">
        <a href="#">
            <i class="fa fa-newspaper-o"></i>
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
        </ul>
    </li>
<?php endif ?>
