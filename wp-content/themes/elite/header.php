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
        <div class="camp-nav">
            <img onclick="location.href='<?php echo get_site_url() ?>'" class="img-responsive camp-logo" src="<?php echo get_template_directory_uri() ?>/images/icon/CAMP_logo.png" alt="">
            <div class="nav-header">
                 <div class="dropdown">
                   <button class="btn btn-border-gold dropdown-toggle" type="button" data-toggle="dropdown"><strong>Info </strong> menu</button>
                   <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'dropdown-menu' ) ); ?>
                   <!-- <ul class="dropdown-menu">
                     <li class="dropdown-header">Dropdown header 1</li>
                     <li><a href="#">HTML</a></li>
                     <li><a href="#">CSS</a></li>
                     <li><a href="#">JavaScript</a></li>
                     <li class="divider"></li>
                     <li class="dropdown-header">Dropdown header 2</li>
                     <li><a href="#">About Us</a></li>
                   </ul>  -->
                   <!-- <div class="select-box">
                        <select name="filter_date" id="filter_date" class="select-box">
                            <option value=""> <strong>Info for</strong> Parents </option>
                        </select>
                    </div> -->
                  </div>
                <a href="<?php echo get_site_url().'/find-a-camp' ?>" class="btn btn-border-gold margin-b-15">find a camp</a>
            </div>
       </div>