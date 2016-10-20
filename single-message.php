<?php
/**
 * The template for displaying all single message posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Buffalo_Covenant_Theme
 */
$vimeo_id = get_post_meta(get_the_ID(), 'vimeo_link', true);
$podcast = get_podcast_episode(get_post_meta(get_the_ID(), 'podcast_guid', true));
if ($podcast) {
$audio_attrs = array(
    'src'      => $podcast["link"],
    'loop'     => '',
    'autoplay' => get_query_var('autoplay', false),
    'preload' => 'none'
);
}
$series = get_the_terms( $post, 'series');
$speaker = get_the_terms( $post, 'speakers');
$posts_array = get_posts(
    array(
        'posts_per_page' => -1,
        'post_type' => 'attachment',
        'tax_query' => array(
            array(
                'taxonomy' => 'series',
                'field' => 'term_id',
                'terms' => wp_list_pluck( $series, 'term_id' ),
            )
        )
    )
);
$thumb_src = $posts_array[0]->guid;
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article>
				<div class="message-archive-link"><a href="/messages/">← Back to Archive</a></div>
				<div class="message-thumbnail">
					<img src="<?php echo $thumb_src ?>">
				</div>
				<div class="message-meta">
					<div><h1><?php echo get_the_title() ?></h1></div>
					<span class="message-meta-item"><?php echo get_the_date() ?></span>
					<?php if ($speaker) : ?>
					<span class="message-meta-item"> • <a href="/speakers/<?php echo $speaker[0]->slug ?>"><?php echo $speaker[0]->name ?></a></span>
					<? endif; ?>
					<?php if ($series) : ?>
					<span class="message-meta-item"> • <span>Series:</span> <a href="/series/<?php echo $series[0]->slug ?>"><?php echo $series[0]->name ?></a></span>
					<? endif; 

					if ($podcast && $vimeo_id) : ?>
						<div class="message-medium-toggle"><button>Audio Only?</button></div>
					<?php endif;?>
				</div><?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					the_content();
					endwhile;
				else:
					_e('Sorry, no posts matched your criteria.');
				endif;
				if ($vimeo_id && $podcast) : ?>
					<div class="message-player show-video">
				<?php elseif ($vimeo_id && !$podcast) : ?>
					<div class="message-player show-video">
				<?php elseif (!$vimeo_id && $podcast) : ?>
					<div class="message-player show-audio">
				<?php endif;
				if ($vimeo_id) : ?>
					<div class="embed-vimeo-container"><iframe id="vimeoplayer" src="//player.vimeo.com/video/<?php echo $vimeo_id; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				<? endif;
				if ($podcast) :
					echo wp_audio_shortcode($audio_attrs);
				endif; ?>
				</div>
				<?php the_post_navigation(); ?>
			</article>
			<div class="sidebar">
				<?php dynamic_sidebar( 'pages-sidebar' ); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();