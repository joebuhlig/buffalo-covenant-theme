<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buffalo_Covenant_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="articles">
			<h2>Subscribe to the Sermon Archives</h2>
			<div><a href="https://geo.itunes.apple.com/us/podcast/buffalo-covenant-church-sermon/id1041139383?mt=2" style="display:inline-block;overflow:hidden;background:no-repeat;width: 100px;height: 40px;margin-right: 10px;"><img src="https://linkmaker.itunes.apple.com/images/badges/en-us/badge_itunes-lrg.svg"></a><a href="http://www.subscribeonandroid.com/buffalocov.libsyn.com/rss" style="display:inline-block;overflow:hidden;width: 108px;height: 41px;margin-right: 10px;"><img src="/wp-content/uploads/2016/10/sub-android.png"></a><a href="http://buffalocov.libsyn.com/rss" style="display:inline-block;overflow:hidden;width: 100px;height: 40px;"><img src="/wp-content/uploads/2016/10/rss@3x-82b6c168c05c2371ea3d094139a343dc.png"></a></div>
			<?php
			if ( have_posts() ) : 
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'sermon' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
			</div>
			<div class="sidebar">
				<?php dynamic_sidebar( 'pages-sidebar' ); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
