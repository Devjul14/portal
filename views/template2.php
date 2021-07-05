<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>

    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url();?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <script src="<?php echo base_url();?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">

    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo site_url(); ?>js/plugins/Bootstrap-3-Typeahead-master/ui.bootstrap.typeahead.js"></script>

</head>

<body>

<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url();?>img/profile_small.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $username; ?></strong>
                             </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="<?php echo ($menu=='home' ? 'active' : '');?>">
                <?php echo anchor($this->session->userdata('controller')."/home","<i class='fa fa-dashboard'></i><span class='nav-label'>Dashboard</span>"); ?>
            </li>
            <?php $this->load->view($vmenu);?>
        </ul>

    </div>
</nav>

<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Welcome to Hospital Management System</span>
            </li>
            <li>
                <a href="<?php echo site_url('login/logout');?>">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <?php echo $title_header; ?>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url($this->session->userdata('controller').'/home');?>">Home</a>
            </li>
            <?php echo $breadcrumb; ?>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?php $this->load->view($content);?>
    </div>
</div>
<div class="footer" >
    <div>
        <strong>Copyright</strong> <a href="https://trustme.co.id/">TrustMe</a> &copy; 2017 | we trust, respect and care
    </div>
</div>

</div>
</div>



<!-- Mainly scripts -->
<!-- <script src="<?php echo base_url();?>js/jquery-2.1.1.js"></script> -->
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url();?>js/inspinia.js"></script>
<script src="<?php echo base_url();?>js/plugins/pace/pace.min.js"></script>

<script src="<?php echo base_url();?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

</body>

</html>
