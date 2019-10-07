<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?> 
    </head>
    <body <?php body_class(); ?> >
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- navigation bar -->
        <div class="navigation-bar">
            <div class="container">

                <div class="row">
                    <div class="logo">
                    <a href="<?php echo home_url(); ?>">
                        Yacht Charter Compare
                    </a>
                    </div>
            
                    <div class="search-bar">
                        <!-- magn-glass icon with next to it the word search -->
                        <!-- this part will be hidden and slides out once hovered on the magnifying glass -->
                        <div class="search-wrap">
                        <?php get_search_form(); ?>
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>

        <?php 
            
            wp_nav_menu(array(
                'theme_location'    => 'primary-menu',
                'container'         => false,
                'items_wrap'        => '<ul id="menu" class="menu">%3$s</ul>',
                'walker'            => new Walker_Nav_Primary(),
        )); ?>
        