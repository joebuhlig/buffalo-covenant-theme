<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$series = get_the_terms( $post, 'series');
		$speaker = get_the_terms( $post, 'speakers');
		if ($series){
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
		};?>
	<div class="sermon-thumbnail">
		<a href="<?php echo esc_url( get_permalink() ) ?>">
		<?php if ($series) : ?>
			<img src="<?php echo $thumb_src ?>">
		<?php else : ?>
			<img src="<?php echo get_theme_mod('default_sermon_logo') ?>">
		<? endif; ?>
		</a>
	</div>
	<div class="sermon-details"><?php
	if ( is_single() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;
	?>
		<div class="sermon-meta">
			<div class="sermon-meta-item"><?php echo get_the_date() ?></div>
			<?php if ($speaker) : ?>
			<div class="sermon-meta-item">by <a href="/speakers/<?php echo $speaker[0]->slug ?>"><?php echo $speaker[0]->name ?></a></div>
			<? endif; ?>
			<?php if ($series) : ?>
			<div class="sermon-meta-item"><span>Series:</span> <a href="/series/<?php echo $series[0]->slug ?>"><?php echo $series[0]->name ?></a></div>
			<? endif; ?>
		</div>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'buffalo-covenant-theme' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article>