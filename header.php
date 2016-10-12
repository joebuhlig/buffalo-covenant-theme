<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buffalo_Covenant_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'buffalo-covenant-theme' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() ) : ?>
				<div class="homepage-hero-module">
				    <div class="video-container">
				        <video autoplay loop class="fillWidth" poster="<?php echo get_theme_mod('header_video_poster') ?>">
				            <source src="<?php echo get_theme_mod('header_video_mp4') ?>" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
				            <source src="<?php echo get_theme_mod('header_video_webm') ?>" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
				            <source src="<?php echo get_theme_mod('header_video_ogv') ?>" type="video/ogg" />Your browser does not support the video tag. I suggest you upgrade your browser.
				            <img src="<?php echo get_theme_mod('header_video_poster') ?>" alt="">
				        </video>
				        <div class="poster hidden">
				            <img src="<?php echo get_theme_mod('header_video_poster') ?>" alt="">
				        </div>
				    </div>
				</div>
				<div class="home-title"><?php dynamic_sidebar( 'home-title-sidebar' ); ?></div>
			<?php else : ?>
				<div class="poster page">
		            <img src="<?php echo get_theme_mod('header_video_poster') ?>" alt="">
		        </div>
			<?php
			endif;
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="light-logo" src="<?php echo get_theme_mod('header_light_logo') ?>" alt=""></a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="dark-logo" src="<?php echo get_theme_mod('header_dark_logo') ?>" alt=""></a>
			</div>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<svg viewBox="0 0 18 15">
					<path d="M18,1.484c0,0.82-0.665,1.484-1.484,1.484H1.484C0.665,2.969,0,2.304,0,1.484l0,0C0,0.665,0.665,0,1.484,0 h15.031C17.335,0,18,0.665,18,1.484L18,1.484z"/>
					<path d="M18,7.516C18,8.335,17.335,9,16.516,9H1.484C0.665,9,0,8.335,0,7.516l0,0c0-0.82,0.665-1.484,1.484-1.484 h15.031C17.335,6.031,18,6.696,18,7.516L18,7.516z"/>
					<path d="M18,13.516C18,14.335,17.335,15,16.516,15H1.484C0.665,15,0,14.335,0,13.516l0,0 c0-0.82,0.665-1.484,1.484-1.484h15.031C17.335,12.031,18,12.696,18,13.516L18,13.516z"/>
			    </svg>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
