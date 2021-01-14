<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9 testimonial-item">
				<div class="testimonial-image">
					<?php echo wp_get_attachment_image( get_sub_field('testimonial_image'), 'thumbnail' ); ?>
					<img src="<?php echo get_sub_field( 'testimonial_image' )['sizes']['thumbnail']; ?>" alt="">
				</div>
				<div class="testimonial-quote">
					&ldquo;<?php echo get_sub_field('testimonial'); ?>&rdquo;
				</div>
				<hr class="small-divider">
				<div class="testimonial-citation">
					<span class="name"><?php echo get_sub_field('testimonial_name'); ?></span>
					<span class="title"><?php echo get_sub_field('testimonial_title'); ?></span>
					<span class="company"><?php echo get_sub_field('testimonial_company'); ?></span>
				</div>
			</div>
		</div>
	</div>
	<?php binarym_block_ornament(); ?>
</div>
