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
			<div class="articles">
				<?php
				// 	while ( have_posts() ) : the_post();

				// 		get_template_part( 'template-parts/content', 'page' );

				// 	endwhile; // End of the loop.
					$args = array(
					    'orderby'    => 'ID', 
					    'order'      => 'ASC',
					);
					$custom_terms = get_terms('staff-roles', $args);

					foreach($custom_terms as $custom_term) {
					    wp_reset_query();
					    $args = array('post_type' => 'staff',
					        'tax_query' => array(
					            array(
					                'taxonomy' => 'staff-roles',
					                'field' => 'slug',
					                'terms' => $custom_term->slug,
					            ),
					        ),
					        'order' => 'ASC',
					        'orderby' => 'menu_order',
					     );

					     $loop = new WP_Query($args);
					     if($loop->have_posts()) : ?>
					     	<div class="staff-group">
						        <h2><?php echo $custom_term->name ?></h2>

						        <?php while($loop->have_posts()) : $loop->the_post(); ?>
						        	<div class="staff-member" data-member-id="<?php echo get_the_ID() ?>">
						        		<div class="staff-member-pic">
							        		<?php echo get_the_post_thumbnail() ?>
							        	</div>
						        		<div class="staff-member-name"><?php echo get_the_title() ?></div>
						        		<div class="staff-member-title"><?php echo get_post_meta( get_the_ID(), "staff_title", true ) ?></div>
						        		<div class="staff-member-bio"><?php the_content() ?></div>
					        		</div><?php
						        endwhile;?>
						       </div><?php
					     endif;
					}
				?>
				<div id="staff-member-bio-container">
					<div id="staff-member-bio-pointer">
						<svg class="indicator-arrow" viewBox="0 0 256 60.391">
							<path class="shape" d="M256,60.391C158.059,60.391,128,0,128,0S97.943,60.391,0,60.391H256z"></path>
						</svg>
					</div>
					<div id="staff-member-bio-text"></div>
				</div>
			</div>
			<div class="sidebar">
				<?php dynamic_sidebar( 'pages-sidebar' ); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
