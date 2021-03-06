<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="author" content="Diethelm Travel Group">
        <meta name="copyright" content="Copyright Diethelm Travel Management Limited. All rights reserved.">
        <meta name="theme-color" content="#DC3536">
        <meta name="msapplication-navbutton-color" content="#DC3536">
        <meta name="apple-mobile-web-app-status-bar-style" content="#DC3536">

        <title><?php wp_title('|', true, 'right'); ?></title>

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
        <div class="elite-nav">
            <img onclick="location.href='<?php echo get_site_url() ?>'" class="img-responsive elite-logo" src="<?php echo get_template_directory_uri() ?>/images/icon/logo.png" alt="">
            <div class="nav-header">
                   <?php wp_nav_menu( array( 'theme_location' => 'header-menu',) ); ?>
            </div>
       </div>