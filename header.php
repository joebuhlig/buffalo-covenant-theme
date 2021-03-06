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
global $show_default_header;
global $hide_page_title;
global $page_title;
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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87474340-1', 'auto');
  ga('send', 'pageview');

</script>
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
				<div class="video-overlay"></div>
				<div class="home-title"><?php dynamic_sidebar( 'home-title-sidebar' ); ?></div>
				<div class="sermon-player-wrapper">
					<div class="sermon-player">
						<?php $sermon = get_latest_sermon(); ?>
						<div class="sermon-player-latest">
							<div class="sermon-player-latest-text">Latest Message</div>
							<div class="sermon-player-latest-date"><?php echo $sermon['date']; ?></div>
						</div>
						<img class="sermon-player-thumbnail" src="<?php echo $sermon['thumb_src']; ?>" >
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
								<button><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve"><path d="M405.2,232.9L126.8,67.2c-3.4-2-6.9-3.2-10.9-3.2c-10.9,0-19.8,9-19.8,20H96v344h0.1c0,11,8.9,20,19.8,20  c4.1,0,7.5-1.4,11.2-3.4l278.1-165.5c6.6-5.5,10.8-13.8,10.8-23.1C416,246.7,411.8,238.5,405.2,232.9z"/></svg></button>
							</a>
						</div>
					</div>
				</div>
			<?php else : ?>
				<?php if (!get_post_meta( $post->ID, 'hide_page_header_image', true )) : ?>
				<div class="poster page">
					<?php if ($show_default_header || !has_post_thumbnail()) : ?>
						<img id="header-img" desktop-src="<?php echo get_theme_mod('default_page_header') ?>" mobile-src="<?php if (get_post_meta( $post->ID, 'mobile_header', true)) : ?><?php echo esc_attr( get_post_meta( $post->ID, 'mobile_header', true) ) ?><? else : ?><?php echo get_theme_mod('default_page_header') ?><? endif; ?>" alt="">
					<?php else : ?>
						<img id="header-img" desktop-src="<?php echo the_post_thumbnail_url() ?>" mobile-src="<?php if (get_post_meta( $post->ID, 'mobile_header', true)) : ?><?php echo esc_attr( get_post_meta( $post->ID, 'mobile_header', true) ) ?><? else : ?><?php echo the_post_thumbnail_url() ?><? endif; ?>" alt="">
			        <? endif; ?>
			        <header class="entry-header">
			        <?php if (!$hide_page_title && !get_post_meta( $post->ID, 'hide_page_title', true )) : ?>
			        	<?php if ($page_title) : ?>
			        		<h1 class="entry-title"><?php echo $page_title; ?></h1>
			        	<?php else : ?>
				        	<h1 class="entry-title"><?php echo wp_title(""); ?></h1><?php
				        endif;
					endif;?>
					</header>
		        </div>
			<?php
			endif;
			endif;
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="light-logo" src="<?php echo get_theme_mod('header_light_logo') ?>" alt=""></a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="dark-logo" src="<?php echo get_theme_mod('header_dark_logo') ?>" alt=""></a>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<?php if (get_post_meta( $post->ID, 'hide_page_header_image', true )) : ?>
	<div id="content" class="site-content header-hidden">
	<?php else : ?>
	<div id="content" class="site-content">
	<? endif; ?>