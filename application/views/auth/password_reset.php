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
     .card-header{
        background-image: url("<?=base_url('assets/images/background1.png')?>");
        /*background-size: cover;*/
         height: 50px;
         text-align: center;
     }
     .card-title {
    color: #ffffff;
    font-size: 20px;
    font-weight: bold;
    padding: 12px;
    text-transform: uppercase;
}
    </style>
</head>
<body>
    <?php
    $this->load->view('notifications');
    ?>

}

<div class="container">
   <div class="row">
       <div class="col-md-offset-4 col-md-4">
           <div class="card">
           <div class="card-container">
               <div class="card-header">
                   <div class="card-title">
                   Change your pasword
                        </div>
            </div>
                   <div class="card-body">
                    <form  method="post" action=<?=current_url()?>>
                        <div class="form-group <?=(form_error('password')) ? 'has-error' :''?>">
                            <input type="password"  class="form-control floating-label" name="password" placeholder="New password" value="<?=set_value('password')?>">
                            <small class="text-danger"><?= form_error('password')?></small>
                        </div>
                        <div class="form-group <?=(form_error('conpassword')) ? 'has-error' :''?>">
                            <input type="password"  class="form-control floating-label" name="conpassword" placeholder="Conform password" value="<?=set_value('password')?>">
                            <small class="text-danger"><?= form_error('conpassword')?></small>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">Reset password</button>
                    </form><!-- /form -->
                    </div>
</div>
        </div>
    </div>
</div>
</div>
</body>
</html>