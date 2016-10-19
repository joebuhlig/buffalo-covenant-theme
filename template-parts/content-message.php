<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
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
		$thumb_src = $posts_array[0]->guid;?>
	<div class="message-thumbnail">
		<img src="<?php echo $thumb_src ?>">
	</div>
	<div class="message-details"><?php
	if ( is_single() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;
	?>
		<div class="message-meta">
			<span class="message-meta-item"><?php echo get_the_date() ?></span>
			<?php if ($speaker) : ?>
			<span class="message-meta-item"> • <a href="/speakers/<?php echo $speaker[0]->slug ?>"><?php echo $speaker[0]->name ?></a></span>
			<? endif; ?>
			<?php if ($series) : ?>
			<span class="message-meta-item"> • <span>Series:</span> <a href="/series/<?php echo $series[0]->slug ?>"><?php echo $series[0]->name ?></a></span>
			<? endif; ?>
		</div>

		<div class="entry-content">
			<?php
				// the_content( sprintf(
				// 	wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'buffalo-covenant-theme' ), array( 'span' => array( 'class' => array() ) ) ),
				// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
				// ) );

				// wp_link_pages( array(
				// 	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buffalo-covenant-theme' ),
				// 	'after'  => '</div>',
				// ) );
			?>
		</div><!-- .entry-content -->
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