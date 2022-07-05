<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9 testimonial-item">
				<div class="testimonial-quote">
					<p class="testimonial-beginning-quotation">&ldquo;</p>
					<p><?php echo get_sub_field('testimonial'); ?>&rdquo;</p>
				</div>
				<hr class="small-divider my-1">
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
