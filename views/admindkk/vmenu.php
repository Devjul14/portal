<?php if ($this->session->userdata("idstatus") == 14) : ?>
<!-- <li class="treeview <?php echo ($menu=="master" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-file-text-o'></i> <span>Data Master</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("umur","<i class='fa fa-list'></i><span>Umur</span>")."</li>"; ?>
        <?php echo "<li>".anchor("kawin","<i class='fa fa-list'></i><span>Kawin</span>")."</li>"; ?>
        <?php echo "<li>".anchor("pendidikan","<i class='fa fa-list'></i><span>Umur</span>")."</li>"; ?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=="pasien" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-user'></i> <span>Pasien</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("pasien","<i class='fa fa-file-text-o'></i><span>Registrasi Pasien</span>")."</li>"; ?>
    </ul>
</li> -->
<!-- <li class="treeview <?php echo ($menu=='home' ? 'active' : '');?>">
    <?php echo anchor($this->session->userdata('controller/home'),"<i class='fa fa-dashboard'></i><span class='nav-label'>Dashboard</span>"); ?>
</li> -->
<li class="treeview <?php echo ($menu=='setup' ? 'active' : '');?>">
    <?php echo anchor($this->session->userdata('controller'),"<i class='fa fa-building'></i><span class='nav-label'>Setup RS</span>"); ?>
</li>
<li class="treeview <?php echo ($menu=='galeri' ? 'active' : '');?>">
    <?php echo anchor($this->session->userdata('controller')."/galeri","<i class='fa fa-photo'></i><span class='nav-label'>Galeri</span>"); ?>
</li>
<li class="treeview <?php echo ($menu=='liburnasional' ? 'active' : '');?>">
    <?php echo anchor($this->session->userdata('controller')."/liburnasional","<i class='fa fa-calendar-times-o'></i><span class='nav-label'>Libur Nasional</span>"); ?>
</li>
<li class="treeview <?php echo ($menu=='komentar' ? 'active' : '');?>">
    <?php echo anchor($this->session->userdata('controller')."/komentar","<i class='fa fa-calendar-times-o'></i><span class='nav-label'>Komentar</span>"); ?>
</li>
<li class="treeview <?php echo ($menu=="master" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-bars'></i> <span>Master</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("admindkk/golpasien","<i class='fa fa-file-text-o'></i><span>Golongan Pasien</span>")."</li>"; ?>
        <?php echo "<li>".anchor("admindkk/pangkat","<i class='fa fa-file-text-o'></i><span>Pangkat</span>")."</li>"; ?>
        <?php echo "<li>".anchor("admindkk/kesatuan","<i class='fa fa-file-text-o'></i><span>Kesatuan</span>")."</li>"; ?>
        <?php echo "<li>".anchor("admindkk/cabang","<i class='fa fa-file-text-o'></i><span>Cabang</span>")."</li>"; ?>
        <?php echo "<li>".anchor("admindkk/ketcabang","<i class='fa fa-file-text-o'></i><span>Keterangan Cabang</span>")."</li>"; ?>
        <?php echo "<li>".anchor("admindkk/soap","<i class='fa fa-file-text-o'></i><span>SOAP</span>")."</li>"; ?>
        <?php echo "<li>".anchor("admindkk/ujifungsi","<i class='fa fa-file-text-o'></i><span>Uji Fungsi</span>")."</li>"; ?>
    </ul>
</li>

<li class="treeview <?php echo ($menu=="ruangan" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-bed'></i> <span>Ruangan</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("ruangan/view","<i class='fa fa-file-text-o'></i><span>Ruangan</span>")."</li>"; ?>
        <?php echo "<li>".anchor("ruangan/kelas","<i class='fa fa-file-text-o'></i><span>Kelas</span>")."</li>"; ?>
        <?php echo "<li>".anchor("ruangan/kamar","<i class='fa fa-file-text-o'></i><span>Kamar</span>")."</li>"; ?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=="dokter" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-stethoscope'></i> <span>Dokter</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("dokter/gelar_depan","<i class='fa fa-file-text-o'></i><span>Gelar Depan</span>")."</li>"; ?>
        <?php echo "<li>".anchor("dokter/gelar_belakang","<i class='fa fa-file-text-o'></i><span>Gelar Belakang</span>")."</li>"; ?>
    	<?php echo "<li>".anchor("dokter/kelompok","<i class='fa fa-file-text-o'></i><span>Kelompok Dokter</span>")."</li>"; ?>
        <?php echo "<li>".anchor("dokter/view","<i class='fa fa-file-text-o'></i><span>Data Dokter</span>")."</li>"; ?>
        <?php echo "<li>".anchor("dokter/jadwal_dokter","<i class='fa fa-file-text-o'></i><span>Jadwal Dokter</span>")."</li>"; ?>
    </ul>
</li>
<li class="<?php echo ($menu=='perawat' ? 'active' : '');?>">
    <a href='#'>
        <i class='fa fa-users'></i> <span>Perawat</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("perawat/view","<i class='fa fa-file-text-o'></i><span>Perawat</span>")."</li>"; ?>
        <?php echo "<li>".anchor("personalia/jadwal_perawat","<i class='fa fa-file-text-o'></i><span>Jadwal Perawat</span>")."</li>"; ?>
        <?php echo "<li>".anchor("perawat/simpeg","<i class='fa fa-file-text-o'></i><span>Keluarga</span>")."</li>"; ?>
        <?php echo "<li>".anchor("perawat/pendidikan","<i class='fa fa-file-text-o'></i><span>Pendidikan</span>")."</li>"; ?>
    </ul>

</li>
<li class="<?php echo ($menu=='postingan' ? 'active' : '');?>">

    <?php echo anchor("postingan/posting","<i class='fa fa-edit'></i><span class='nav-label'>Info/ Promosi</span>"); ?>

</li>
<li class="treeview <?php echo ($menu=="petugas" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-user'></i> <span>Petugas</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("petugas/kasir","<i class='fa fa-file-text-o'></i><span>Kasir</span>")."</li>"; ?>
        <?php echo "<li>".anchor("petugas/lab","<i class='fa fa-file-text-o'></i><span>Lab</span>")."</li>"; ?>
        <?php echo "<li>".anchor("petugas/rekammedis","<i class='fa fa-file-text-o'></i><span>Rekam Medis</span>")."</li>"; ?>
    </ul>
</li>
<li class="<?php echo ($menu=='poliklinik' ? 'active' : '');?>">

    <?php echo anchor("poliklinik/view","<i class='fa fa-flask'></i><span class='nav-label'>Poliklinik</span>"); ?>

</li>
<li class="treeview <?php echo ($menu=="tarif" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-money'></i> <span>Tarif</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("tarif/tarif_ambulance","<i class='fa fa-money'></i><span>Tarif Ambulance</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_gizi","<i class='fa fa-money'></i><span>Tarif Gizi</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_inap","<i class='fa fa-money'></i><span>Tarif Inap</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_lab","<i class='fa fa-money'></i><span>Tarif Lab</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_operasi","<i class='fa fa-money'></i><span>Tarif Operasi</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_pa","<i class='fa fa-money'></i><span>Tarif PA</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_penunjangmedis","<i class='fa fa-money'></i><span>Tarif Penunjang Medis</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_radiologi","<i class='fa fa-money'></i><span>Tarif Radiologi</span>")."</li>"; ?>
        <?php echo "<li>".anchor("tarif/tarif_ralan","<i class='fa fa-money'></i><span>Tarif Ralan</span>")."</li>"; ?>
    </ul>
</li>
<li class="treeview <?php echo ($menu=="user" ? "active" : "") ?>">
    <a href='#'>
        <i class='fa fa-lock'></i> <span>User Management</span>
        <i class='fa fa-angle-left pull-right'></i>
    </a>
    <ul class='treeview-menu'>
        <?php echo "<li>".anchor("user/status_user","<i class='fa fa-list'></i><span>Status User</span>")."</li>"; ?>
        <?php echo "<li>".anchor("user/user_login","<i class='fa fa-list'></i><span>User Login</span>")."</li>"; ?>
    </ul>
</li>
<?php endif ?>
<!-- <?php
  if ($this->session->userdata("idstatus") == 31){
    echo "<li>".anchor("personalia","<i class='fa fa-dashboard'></i><span>Dashboard</span>")."</li>";
  }
?> -->
<!-- ini menu personalia -->
<?php if ($this->session->userdata("idstatus") == 31) : ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <i class='fa fa-angle-left pull-right'></i>
        </a>
        <ul class="treeview-menu">
            <?php echo "<li>" . anchor("personalia/d_pangkat", "Pangkat") . "</li>"; ?>
        </ul>
    </li>
<?php endif ?>
