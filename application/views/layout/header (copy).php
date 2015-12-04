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
    <link href="<?=base_url('assets/css/override.css')?>" rel="stylesheet">
    


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/material.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/ripples.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <style type="text/css">

       
</style>
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

                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" data-target="#" class="dropdown-toggle"
                        data-toggle="dropdown">
                        <img src="<?=base_url('assets/images/user.png')?>" class=" profile img-responsive img-circle" >  <?=$user->first_name?>

                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <?php 
                        if($this->session->userdata('is_admin')){
                            ?>
                            <li><a href="<?=site_url('admin/dashboard')?>"><i class="fa fa-dashboard"></i> Admin</a></li>
                            <?php
                        }
                        ?>
                            <li><a href="<?=site_url('dashboard/profile')?>"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="<?=site_url('auth/logout')?>"><i class="fa fa-sign-out"> </i> Logout</a></li>
                        </ul>
                    </li>


                </ul>
            </div>
        </div>
    </header>