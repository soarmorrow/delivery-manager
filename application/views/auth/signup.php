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
    <link href="<?= base_url('assets/css/signup.css') ?>" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/material.min.js') ?>"></script>
    <script src="<?= base_url('assets/material/dist/js/ripples.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</head>
<style type="text/css">
     .btn-group .btn {
            width: 50%;
        }

    
    
</style>
<body>
<?php
$this->load->view('notifications');
?>
    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign Up</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?=current_url()?>">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group <?=(form_error('first_name'))?'has-error':''?>">
                                        <input type="text" name="first_name" id="first_name" class="form-control input-sm floating-label" placeholder="First Name" value="<?=set_value('first_name')?>">
                                        <small class="text-danger"><?=form_error('first_name')?></small>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group <?=(form_error('last_name'))?'has-error':''?>">
                                        <input type="text" name="last_name" id="last_name" class="form-control input-sm floating-label" placeholder="Last Name" value="<?=set_value('last_name')?>">
                                        <small class="text-danger"><?=form_error('last_name')?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group <?=(form_error('username'))?'has-error':''?>">
                                <input type="text" name="username" id="username" class="form-control input-sm floating-label" placeholder="User name" value="<?=set_value('username')?>">
                                <small class="text-danger"><?=form_error('username')?></small>
                            </div>

                            <div class="form-group <?=(form_error('email'))?'has-error':''?>">
                                <input type="text" name="email" id="email" class="form-control input-sm floating-label" placeholder="Email Address" value="<?=set_value('email')?>">
                                <small class="text-danger"><?=form_error('email')?></small>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group <?=(form_error('password'))?'has-error':''?>">
                                        <input type="password" name="password" id="password" class="form-control input-sm floating-label" placeholder="Password">
                                        <small class="text-danger"><?=form_error('password')?></small>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group <?=(form_error('password_confirmation'))?'has-error':''?>">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm floating-label" placeholder="Confirm Password">
                                        <small class="text-danger"><?=form_error('password_confirmation')?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Register</button>
                            <a href="<?=site_url('auth/login')?>" class="btn btn-primary"><i class="fa fa-sign-in"></i> Sign in</a>
                             </div>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body> 
</html>           