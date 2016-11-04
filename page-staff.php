<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buffalo_Covenant_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			// 	while ( have_posts() ) : the_post();

			// 		get_template_part( 'template-parts/content', 'page' );

			// 	endwhile; // End of the loop.
		    wp_reset_query();
		    $args = array('post_type' => 'staff',
		        'order' => 'ASC',
		        'orderby' => 'menu_order',
		        'posts_per_page' => 1000
		     );

		     $loop = new WP_Query($args);
		     if($loop->have_posts()) : ?>
		     	<div class="staff-group">
		        <?php while($loop->have_posts()) : $loop->the_post();
		        	get_template_part( 'template-parts/content', 'staff' );
		        endwhile;?>
		        </div><?php
		     endif;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
