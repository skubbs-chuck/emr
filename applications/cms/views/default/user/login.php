<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="<?php echo $description ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="author" content="<?php echo $author ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php echo $HOOK_HEADER ?>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url() ?>"><b>Skubbs</b> EMR</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Account Login</p>
            <?php if ($this->session->flashdata('alert_message')): ?>
                <div class="alert alert-danger">
                    <i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata('alert_message') ?>
                </div>
            <?php endif ?>
            
            <?php echo form_open('user/auth'); ?>
                <div class="form-group has-feedback">
                    <?php echo form_input(array('name' => 'username', 'placeholder' => 'Username', 'class' => 'form-control', 'required' => 'required')); ?>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?php echo form_password(array('name' => 'password', 'placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required')); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="checkbox text-right col-xs-12">
                        <label>
                            Keep me logged <ins></ins> <?php echo form_checkbox('remember_me', true); ?>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <?php foreach ($jsBottom as $src): ?>
        <script src="<?php echo $src ?>"></script>
    <?php endforeach ?>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>
</html>