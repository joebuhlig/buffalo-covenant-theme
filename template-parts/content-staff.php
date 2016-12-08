<div class="staff-member<? if ("" != trim(get_the_content())) : ?> has-bio pointer<? endif; ?>" data-member-id="<?php echo get_the_ID() ?>">
	<div class="staff-member-pic-wrapper">
		<div class="staff-member-pic">
			<?php echo get_the_post_thumbnail() ?>
		</div>
		<div class="staff-member-info">
			<div class="staff-member-name"><?php echo get_the_title() ?></div>
			<div class="staff-member-title"><?php echo get_post_meta( get_the_ID(), "staff_title", true ) ?></div>
		</div>
	</div>
	<? if ("" != trim(get_the_content())) : ?>
	<div class="staff-member-bio"><?php the_content() ?></div>
	<? endif; ?>
</div>