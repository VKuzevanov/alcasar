<?php
/**
 * The header.php template for our theme
 *
 * @package WordPress
 * @subpackage Alcasar
 */
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="Ru-ru"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="Ru-ru"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="Ru-ru"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
            <?php
            	if (is_home()) : bloginfo('name'); 
            	else: wp_title('');
            	if (get_query_var('paged')) { echo ' - страница '.get_query_var('paged'); } '|' .bloginfo('name');
            	endif;
            ?>
        </title>

        <!-- @media screen -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- faviocn -->
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon"> 
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

        <!-- js -->
        <script src="<? bloginfo('template_directory'); ?>/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
		 <!-- wp_head -->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
    	
    <!--[if lt IE 8]>
	   <p class="browserupgrade">Вы используете <strong>старый браузер</strong>. Пожалуйста <a href="http://browsehappy.com/">обновитьебраузер</a> для нормального отображения сайта!</p>
	<![endif]-->
	<!-- header -->
    <?php include 'loader.php'; ?>
        <div class="site-wrap">
            <!-- HEADER-->
              <div rel="main" class="header-wrap">
                    <header class="site-header">
                           <div class="logo-wrap">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-w.png" alt="Строительная компания Алькасар">
                               <span class="site-name">
                                Строительная компания Алькасар
                                </span>
                           </div>                        
                          <!--nav-->
                           <nav class="site-menu">
                               <a class="toggle-menu" href="#">МЕНЮ</a>
                                <? wp_nav_menu( array( 'theme_location' => 'header_menu',
                            'items_wrap'=> '<ul id="hero-nav" class="%1$s"> %3$ s</ul>' ) ); ?>
                            </nav>
                    </header>
              </div>
