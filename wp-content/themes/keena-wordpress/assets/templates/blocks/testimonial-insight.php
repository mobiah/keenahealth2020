<div <?php binarym_bg_builder(); ?>>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row d-flex align-items-center">
                    <div class="left-right-item col-md col-lg-3 left-right-content-1">
                        <div class="testimonial-title">
                            <p>TESTIMONIAL</p>
                            <p class="h1">What Our<br> Clients Are<br> Saying<br> About Us</p>
                        </div>
                    </div>
                    <div class="left-right-item col-md col-lg-9 left-right-content-2">
                        <div class="testimonial-text testimonial-text-red">
                            <p class="quote-init mb-0">“</p><br />
                            <div class="testimonial-quote testimonial-split-quote">
                                <?php echo get_sub_field('testimonial'); ?>&rdquo;
                            </div>
                            <div class="testimonial-citation">
                                <p class="name testimonial-author">&#8212;
                                    <?php echo get_sub_field('testimonial_name'); ?></p>
                                <p class="title testimonial-position"><?php echo get_sub_field('testimonial_title'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col-$content_width -->
        </div>
    </div>
    <?php binarym_block_ornament(); ?>
</div>