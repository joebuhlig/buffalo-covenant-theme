<div class="staff-member" data-member-id="<?php echo get_the_ID() ?>">
	<div class="staff-member-pic">
		<?php echo get_the_post_thumbnail() ?>
	</div>
	<div class="staff-member-name"><?php echo get_the_title() ?></div>
	<div class="staff-member-title"><?php echo get_post_meta( get_the_ID(), "staff_title", true ) ?></div>
	<div class="staff-member-bio"><?php the_content() ?></div>
</div>