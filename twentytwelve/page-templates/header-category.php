<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<!--header-category.php-->
<body <?php body_class(); ?>>

<div id="page" class="hfeed site category-page">
	<header id="category-head" class="site-header" role="banner">
		<div id="header_content" class="center_content ">
			<div id="head-sidebar">
					<div id="header_sidebar"><?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?><?php dynamic_sidebar( 'sidebar-4' ); ?><?php endif; ?></div>
			</div>
			<div id="main-bar">
				<div id="site-id">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<div id="logo"><img src="http://salonika.telesto.gr/wp-content/themes/twentytwelve/inc/logo.jpg" alt="logo"></div>
					</a>
				</div>
				<div id="header_nav_container">
					<div class="header_spacer"></div>
					<nav id="site-navigation_top" class="main-navigation in_ribbon" role="navigation">
						<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
						<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'header_top', 'menu_class' => 'nav-menu' ) ); ?>
					</nav><!-- #site-navigation -->
					<hr style="clear:both;" class="in_ribbon">
					<nav id="site-navigation_bottom" class="main-navigation in_ribbon" role="navigation">
						<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
						<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'header_bottom', 'menu_class' => 'nav-menu' ) ); ?>
					</nav><!-- #site-navigation -->
					<div class="header_spacer"></div>
				</div>
		</div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
		</div>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
<!-- /header-category.php-->
