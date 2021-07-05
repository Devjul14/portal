<li class="<?php echo ($menu=='kecamatan' ? 'active' : '');?>">
    <?php echo anchor("admindkk/kecamatan","<i class='fa fa-bank'></i><span class='nav-label'>Kecamatan</span>"); ?>
</li>
<li class="<?php echo ($menu=='puskesmas' ? 'active' : '');?>">
    <?php echo anchor("admindkk/puskesmas","<i class='fa fa-hospital-o'></i><span class='nav-label'>Puskesmas</span>"); ?>
</li>
<li class="<?php echo ($menu=='layanan' ? 'active' : '');?>">
    <?php echo anchor("admindkk/layanan","<i class='fa fa-stethoscope'></i><span class='nav-label'>Layanan</span>"); ?>
</li>
<li class="<?php echo ($menu=='tindakan' ? 'active' : '');?>">
    <?php echo anchor("admindkk/tindakan","<i class='fa fa-user-md'></i><span class='nav-label'>Tindakan</span>"); ?>
</li>
<li class="<?php echo ($menu=='user' ? 'active' : '');?>">
    <?php echo anchor("admindkk","<i class='fa fa-users'></i><span class='nav-label'>Manajemen User</span>"); ?>
</li>