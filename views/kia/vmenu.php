<li class="<?php echo ($menu=='bumil' ? 'active' : '');?>">
    <a href="#"><i class="fa fa-list-alt"></i><span>Ibu Hamil</span><i class='fa fa-angle-left pull-right'></i></a>
	<ul class="treeview-menu">
		<?php echo "<li>".anchor("kia","<i class='fa fa-arrow-circle-right'></i>&nbsp;Pendaftaran Bumil")."</li>";?>
		<?php echo "<li>".anchor("kia/listbumil","<i class='fa fa-arrow-circle-right'></i>&nbsp;Data Bumil")."</li>";?>
		<?php echo "<li>".anchor("kia/persalinan","<i class='fa fa-arrow-circle-right'></i>&nbsp;Tambah Persalinan")."</li>";?>
		<?php echo "<li>".anchor("persalinan","<i class='fa fa-arrow-circle-right'></i>&nbsp;List Persalinan")."</li>";?>
		<?php echo "<li>".anchor("kia/partograf","<i class='fa fa-arrow-circle-right'></i>&nbsp;Partograf")."</li>";?>
		<?php echo "<li>".anchor("kia/listpasien_anc","<i class='fa fa-arrow-circle-right'></i>&nbsp;Data ANC")."</li>";?>
	</ul>
</li>
<li class="<?php echo ($menu=='mtbm' ? 'active' : '');?>">
    <a href="#"><i class="fa fa-heartbeat"></i><span>MTBM</span><i class='fa fa-angle-left pull-right'></i></a>
	<ul class="treeview-menu">
		<?php echo "<li>".anchor("kia/mtbm","<i class='fa fa-arrow-circle-right'></i>&nbsp;Pendaftaran MTBM")."</li>";?>
		<?php echo "<li>".anchor("kia/listmtbm","<i class='fa fa-arrow-circle-right'></i>&nbsp;Data MTBM")."</li>";?>
	</ul>
</li>
<li class="<?php echo ($menu=='kb' ? 'active' : '');?>">
    <a href="#"><i class="fa fa-users"></i><span>Keluarga Berencana</span><i class='fa fa-angle-left pull-right'></i></a>
	<ul class="treeview-menu">
		<?php echo "<li>".anchor("pasienkb","<i class='fa fa-arrow-circle-right'></i>&nbsp;Pendaftaran KB")."</li>";?>
		<?php echo "<li>".anchor("pasienkb/listkb","<i class='fa fa-arrow-circle-right'></i>&nbsp;Data KB")."</li>";?>
		<!--<?php echo "<li>".anchor("karyawan/rekening","<i class='fa fa-arrow-circle-right'></i>&nbsp;Data KB (Detail)")."</li>";?>-->
    </ul>
</li>
<li class="<?php echo ($menu=='bblr' ? 'active' : '');?>">
    <a href="#"><i class="fa fa-frown-o"></i><span>BBLR</span><i class='fa fa-angle-left pull-right'></i></a>
	<ul class="treeview-menu">
		<?php echo "<li>".anchor("kia/listbblr","<i class='fa fa-arrow-circle-right'></i>&nbsp;Data BBLR")."</li>";?>
    </ul>
</li>