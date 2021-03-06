<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Collection</title>
    <link rel="shortcut icon" type="text/x-icon" href="<?= base_url('share.jpg') ?>"/>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/material/dist/css/material-fullpalette.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/material/dist/css/ripples.css') ?>" rel="stylesheet">
    <!--Bootstrap file input  -->
    <link href="<?=base_url('assets/plugins/bootstrap-fileinput-master/css/fileinput.min.css') ?>" media="all" rel="stylesheet" type="text/css" />

    <link href="<?=base_url('assets/css/override.css')?>" rel="stylesheet">
    <!-- X-editable -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/material.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/ripples.min.js') ?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap-fileinput-master/js/fileinput.min.js')?>"></script>
<!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK3S08d1fhYGMpyylmwf_iwPNfjhkbyaU&libraries=places" async defer></script>-->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
<!--    <script src="--><?//= base_url('assets/js/jquery.geocomplete.min.js') ?><!--"></script>-->
    <!-- X-editable -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

</head>
<body>

    <header>
        <div class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-default-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse navbar-inverse-collapse">
             <ul class="nav navbar-nav">

                 <?php
                 if ($this->session->userdata('logged_in')) {
                    if ($this->session->userdata('is_admin')) {
                        ?>
                        <li class="<?=($this->uri->segment(1) == 'admin')?'active':''?>"><a href="<?=site_url('/admin/dashboard')?>"><i class="fa fa-gear"></i> Admin <span class="sr-only">(current)</span></a></li>
                        <li class="<?=($this->uri->segment(1) == 'users')?'active':''?>"><a href="<?=site_url('/users')?>"><i class="fa fa-users"></i> Users <span class="sr-only">(current)</span></a></li>
                        
                        <?php
                    }else{
                        ?>
                        
                        <li class="<?=($this->uri->segment(1) == 'dashboard')?'active':''?>"><a href="<?=site_url('/')?>"><i class="fa fa-dashboard"></i> Dashboard <span class="sr-only">(current)</span></a></li>

                        <?php
                    }
                    ?>   
                    <?php
                }
                ?>



            </ul>


            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" data-target="#" class="dropdown-toggle"
                    data-toggle="dropdown">
                    
                    <img src="<?= ($user->profile_image)?base_url($user->profile_image) : base_url('assets/images/user.png')?>" class=" profile img-responsive img-circle" >  <?=$user->first_name?>
                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <li><a href="<?=site_url('dashboard/profile')?>"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="<?=site_url('auth/logout')?>"><i class="fa fa-sign-out"> </i> Logout</a></li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</header>