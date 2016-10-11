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
				        <div class="filter"></div>
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
				<h1 class="site-title"><span>WELCOME</span><br><span>to Buffalo Covenant Church</span></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="logo">
			<img src="<?php echo get_theme_mod('header_light_logo') ?>" dark-logo="<?php echo get_theme_mod('header_dark_logo') ?>" alt="">
			</div>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'buffalo-covenant-theme' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
