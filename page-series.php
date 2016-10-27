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
			<div class="pre-sermon-list">
				<div class="pre-sermon-buttons">
					<a href="/sermons"><button>View By Date</button></a>
				</div>
				<div class="subscribe-buttons"><a href="https://geo.itunes.apple.com/us/podcast/buffalo-covenant-church-sermon/id1041139383?mt=2" style="display:inline-block;overflow:hidden;background:no-repeat;width: 100px;height: 40px;margin-right: 10px;"><img src="https://linkmaker.itunes.apple.com/images/badges/en-us/badge_itunes-lrg.svg"></a><a href="http://www.subscribeonandroid.com/buffalocov.libsyn.com/rss" style="display:inline-block;overflow:hidden;width: 108px;height: 41px;margin-right: 10px;"><img src="/wp-content/uploads/2016/10/sub-android.png"></a><a href="http://buffalocov.libsyn.com/rss" style="display:inline-block;overflow:hidden;width: 100px;height: 40px;"><img src="/wp-content/uploads/2016/10/rss@3x-82b6c168c05c2371ea3d094139a343dc.png"></a>
				</div>
			</div>
			<div class="clear"></div>
			<?php
			// 	while ( have_posts() ) : the_post();

			// 		get_template_part( 'template-parts/content', 'page' );

			// 	endwhile; // End of the loop.
		    $terms = get_terms( array(
			    'taxonomy' => 'series',
			    'hide_empty' => false,
			) );
			foreach ( $terms as $term ) {
				$posts_array = get_posts(
				    array(
				        'posts_per_page' => 1,
				        'post_type' => 'attachment',
				        'tax_query' => array(
				            array(
				                'taxonomy' => 'series',
				                'field' => 'term_id',
				                'terms' => $term->term_id,
				            )
				        )
				    )
				);
				$thumb_src = $posts_array[0]->guid;
				
				$posts_array = get_posts(
				    array(
				        'posts_per_page' => 1,
				        'post_type' => 'sermon',
				        'tax_query' => array(
				            array(
				                'taxonomy' => 'series',
				                'field' => 'term_id',
				                'terms' => $term->term_id,
				            )
				        )
				    )
				);
				$last_post_date = date("M j, Y" , strtotime($posts_array[0]->post_date));

				$posts_array = get_posts(
				    array(
				        'posts_per_page' => 1,
				        'order' => 'ASC',
				        'post_type' => 'sermon',
				        'tax_query' => array(
				            array(
				                'taxonomy' => 'series',
				                'field' => 'term_id',
				                'terms' => $term->term_id,
				            )
				        )
				    )
				);
				$first_post_date = date("M j, Y" , strtotime($posts_array[0]->post_date));
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="sermon-series">
						<div class="series-thumbnail">
							<a href="/series/<?php echo $term->slug ?>"><img src="<?php echo $thumb_src ?>"></a>
						</div>
						<div class="series-title">
							<h2 class="entry-title"><a href="/series/<?php echo $term->slug ?>"><?php echo $term->name ?></a></h2>
						</div>
						<div class="series-dates"><span><?php echo $first_post_date ?></span> - <span><?php echo $last_post_date ?></div>
					</div>
				</article><?php
			}?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
