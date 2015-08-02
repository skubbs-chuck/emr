<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $site_name . ' - ' . $title ?></title>
        <link rel="icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="<?php echo $description ?>">
        <meta name="keywords" content="<?php echo $keywords ?>">
        <meta name="author" content="<?php echo $author ?>">
        <script type="text/javascript"> window.base_url = <?php echo json_encode(base_url()); ?>; </script>
    <?php echo $HOOK_HEADER ?>
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
<body class="skin-blue fixed">
<div class="wrapper">
<header class="main-header">
    <a href="<?php echo base_url() ?>" class="logo">
        <span class="logo-mini"><b>EMR</b></span>
        <span class="logo-lg"><b>Skubbs</b> EMR</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $tpl_url; ?>img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $user->first_name . ' ' . $user->last_name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            
                            <img src="<?php echo $tpl_url; ?>img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo $user->first_name . ' ' . $user->last_name; ?> - <?php echo $user->specialty ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url() . 'user/profile' ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url() . 'user/logout' ?>" class="btn btn-default btn-flat">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php include_once $inc_left_column; ?>