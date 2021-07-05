<li class="<?php echo ($menu=='posyandu' ? 'active' : '');?>">
    <?php echo anchor("adminpuskes/posyandu","<i class='fa fa-bank'></i><span class='nav-label'>Posyandu</span>"); ?>
</li>
<li class="<?php echo ($menu=='binaan' ? 'active' : '');?>">
    <?php echo anchor("adminpuskes/binaan","<i class='fa fa-home'></i><span class='nav-label'>SD Binaan</span>"); ?>
</li>
<li class="<?php echo ($menu=='paramedis' ? 'active' : '');?>">
    <?php echo anchor("adminpuskes/paramedis","<i class='fa fa-stethoscope'></i><span class='nav-label'>Paramedis</span>"); ?>
</li>
<li class="<?php echo ($menu=='user' ? 'active' : '');?>">
    <?php echo anchor("adminpuskes","<i class='fa fa-users'></i><span class='nav-label'>Manajemen User</span>"); ?>
</li>