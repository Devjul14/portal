<li class="<?php echo ($menu=='pendaftaran' ? 'active' : '');?>">
    <?php echo anchor("umum","<i class='fa fa-bank'></i><span class='nav-label'>Data Pendaftaran</span>"); ?>
</li>
<li class="<?php echo ($menu=='rekammedis' ? 'active' : '');?>">
    <?php echo anchor("umum/listumum","<i class='fa fa-hospital-o'></i><span class='nav-label'>Data Rekam Medis</span>"); ?>
</li>