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

<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/buffalo-covenant-theme/images/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/wp-content/themes/buffalo-covenant-theme/images/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/wp-content/themes/buffalo-covenant-theme/images/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/wp-content/themes/buffalo-covenant-theme/images/manifest.json">
<link rel="mask-icon" href="/wp-content/themes/buffalo-covenant-theme/images/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="/wp-content/themes/buffalo-covenant-theme/images/favicon.ico">
<meta name="msapplication-config" content="/wp-content/themes/buffalo-covenant-theme/images/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
<script>
  (function(d) {
    var config = {
      kitId: 'udh7lbz',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
</head>

<body <?php if ( is_front_page() ){ body_class(); } else { body_class("back-page"); } ?>>
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
				            <img src="<?php echo get_theme_mod('header_mobile_poster') ?>" alt="">
				        </div>
				    </div>
				</div>
				<div class="home-title"><?php dynamic_sidebar( 'home-title-sidebar' ); ?></div>
				<div class="sermon-player-wrapper">
					<div class="sermon-player">
						<?php $sermon = get_latest_sermon(); ?>
						<div class="sermon-player-latest">
							<div class="sermon-player-latest-text">Latest Message</div>
							<div class="sermon-player-latest-date"><?php echo $sermon['date']; ?></div>
						</div>
						<div class="sermon-player-title">
							<div class="sermon-player-title-text">
								<a href="<?php echo $sermon['link']; ?>"><?php echo $sermon['title']; ?></a>
							</div>
							<?php if ($sermon['speaker']) : ?>
								<div class="sermon-player-speaker">by <?php echo $sermon['speaker']; ?></div>
							<?php endif; ?>
						</div>
						<div class="sermon-player-button">
							<a href="<?php echo $sermon['link']; ?>">
								<button><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve"><path d="M405.2,232.9L126.8,67.2c-3.4-2-6.9-3.2-10.9-3.2c-10.9,0-19.8,9-19.8,20H96v344h0.1c0,11,8.9,20,19.8,20  c4.1,0,7.5-1.4,11.2-3.4l278.1-165.5c6.6-5.5,10.8-13.8,10.8-23.1C416,246.7,411.8,238.5,405.2,232.9z"/></svg>Play</button>
							</a>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="poster page">
					<?php if (!is_post_type_archive() && !is_tax() && has_post_thumbnail()) : ?>
						<?php echo get_the_post_thumbnail() ?>
					<? else : ?>
			            <img src="<?php echo get_theme_mod('header_video_poster') ?>" alt="">
			        <?php endif; ?>
			        <header class="entry-header">
			        <?php if (!get_post_meta( $post->ID, 'hide_page_title', true )) :
						if ( !is_front_page() && !is_post_type_archive() && !is_tax() ) :
							the_title( '<h1 class="entry-title">', '</h1>' ); 
						elseif (is_post_type_archive() && !is_tax()) :
							?><h1 class="entry-title"><?php echo post_type_archive_title(); ?></h1><?php
						elseif (is_tax()) :
							$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							?><h1 class="entry-title"><?php echo $term->name; ?></h1><?php
						endif;
					endif;?>
					</header>
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
			<?php if ( wp_is_mobile() ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_id' => 'mobile-menu' ) ); ?>
			<?php else : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			<?php endif; ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
