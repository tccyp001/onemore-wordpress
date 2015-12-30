<!DOCTYPE html>
<?php global $bpxl_goblog_options; ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if (!empty($bpxl_goblog_options['bpxl_favicon']['url'])) { ?>
<link rel="icon" href="<?php echo $bpxl_goblog_options['bpxl_favicon']['url']; ?>" type="image/x-icon" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<?php if($bpxl_goblog_options['bpxl_layout_type'] != '1') { $layout_class = ' boxed-layout'; } ?>
<body id="blog" <?php body_class('main'); ?>>
    <div id="st-container" class="st-container">
		<nav class="st-menu st-effect-4" id="menu-4">
			<div id="close-button"><i class="fa fa-times"></i></div>
			<div class="off-canvas-search">
				<div class="header-search off-search"><?php get_search_form(); ?></div>
			</div>
			<?php if ( has_nav_menu( 'main-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) );
            } ?>
		</nav>
        <div class="main-container<?php if($bpxl_goblog_options['bpxl_layout_type'] != '1') { echo $layout_class; } ?>">
            <div class="menu-pusher">
            <!-- START HEADER -->
                <header class="main-header clearfix<?php if ($bpxl_goblog_options['bpxl_sticky_menu'] == '1') { echo " header-down";} ?>  <?php bpxl_header_class(); ?>">
                    <div class="header clearfix">
                        <div class="container">
                            <div class="logo-wrap uppercase">
                                <?php if (!empty($bpxl_goblog_options['bpxl_logo']['url'])) { ?>
                                    <div id="logo" class="uppercase">
                                        <a href="<?php echo home_url(); ?>">
                                            <img src="<?php echo $bpxl_goblog_options['bpxl_logo']['url']; ?>" <?php if (!empty($bpxl_goblog_options['bpxl_retina_logo']['url'])) { echo 'data-at2x="'.$bpxl_goblog_options['bpxl_retina_logo']['url'].'"';} ?> alt="<?php bloginfo( 'name' ); ?>">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <?php if( is_front_page() || is_home() || is_404() ) { ?>
                                        <h1 id="logo" class="uppercase">
                                            <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                                        </h1>
                                    <?php } else { ?>
                                        <h2 id="logo" class="uppercase">
                                            <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                                        </h2>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($bpxl_goblog_options['bpxl_tagline'] == '1') { ?>
                                    <span class="description">
                                        <?php bloginfo( 'description' ); ?>
                                    </span>
                                <?php } ?>
                            </div><!--.logo-wrap-->
                            <div class="menu-btn off-menu fa fa-align-justify" data-effect="st-effect-4"></div>
                            <div class="main-navigation">
                                <div class="main-nav">
                                    <nav id="navigation" >
                                        <?php if ( has_nav_menu( 'main-menu' ) ) { /* if 'main-menu' exists then use custom menu else show pages */ ?>
                                        <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) ); ?>
                                        <?php } ?>
                                    </nav>
                                </div><!-- .main-nav -->
                            </div><!-- .main-navigation -->
                        </div><!-- .container -->
                    </div><!-- .header -->
                </header>
                <?php if ($bpxl_goblog_options['bpxl_sticky_menu'] == '1') { ?><div class="header-sticky"></div><?php } ?>
                    <?php
                        if($bpxl_goblog_options['bpxl_header_slider'] == '1') {
                            if($bpxl_goblog_options['bpxl_header_slider_pages'] == '1') {
                                if(is_home() || is_front_page()) {
                                    get_template_part('template-parts/header-slider');
                                }
                            } elseif($bpxl_goblog_options['bpxl_header_slider_pages'] == '2') {
                                get_template_part('template-parts/header-slider');
                            }
                        }
                    ?>
                <!-- END HEADER -->
                <div class="main-wrapper clearfix">
                    <div id="page">