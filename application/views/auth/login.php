<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/material/dist/css/material-fullpalette.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/material/dist/css/ripples.css') ?>" rel="stylesheet">

    <!--Override CSS goes here which will overrite Bootstrap style with its selector-->
    <link href="<?= base_url('assets/css/login.css') ?>" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/material.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/ripples.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <style type="text/css">
    .btn-group  .btn{
        width:50%;
    }
    </style>
</head>
<body>
    <?php
    $this->load->view('notifications');
    ?>



<div class="container">
   <div class="row">
       <div class="col-md-offset-4 col-md-4">
       <div class="card card-container">
            
            <img id="profile-img" class="profile-img-card" src="<?= base_url('assets/images/user.png')?>" />
            <p id="profile-name" class="profile-name-card"></p>
            <form  method="post" action=<?=current_url()?>>
                <div class="form-group <?=(form_error('email')) ? 'has-error' :''?>">
                <input type="text"  class="form-control floating-label" name="email" placeholder="Username" >
                <small class="text-danger"><?= form_error('email')?></small>
                </div>
                <div class="form-group <?= (form_error('password')) ? 'has-error' : ''?>">
                <input type="password"  name="password" class="form-control floating-label" placeholder="Password">
                <small class="text-danger"><?= form_error('password')?></small>
                </div>
                <div class="form-group">
                            <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-info"><i class="fa fa-sign-in"></i> Sign in</button>
                            <a href="<?=site_url('auth/signup')?>" class="btn btn-primary"><i class="fa fa-edit"></i> Register</a>
                             </div>
                             </div>
            </form><!-- /form -->
            <a href="<?=site_url('auth/forgot_password')?>" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
       </div>
   </div>
</div><!-- /container -->


</body>
</html>