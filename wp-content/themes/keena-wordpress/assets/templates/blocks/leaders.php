<div <?php binarym_bg_builder(); ?>>
    <div class="container">
        <?php
			binarym_before_content_block();
		?>
        <div class="row">
            <?php
			while ( have_rows('leaders') ) : the_row();

				$leader_contact_details = '';

				$phone = get_sub_field('phone');
				$leader_id = sanitize_title( get_sub_field('name') );
				if ( !empty( $phone ) )
					$leader_contact_details .= '<a href="tel:' . str_replace( array('.', ' ', '#' ), array( '', '', ',' ), $phone ). '">' . $phone . '</a><br>';

				$email = get_sub_field('email');

				if ( !empty( $email ) )
					$leader_contact_details .= '<a href="mailto:'.$email.'">'. $email .'</a><br>';

				$linkedin_url = get_sub_field('linkedin_url');

				if ( !empty( $linkedin_url ) )
					$leader_contact_details .= '<a href=" '. $linkedin_url .'"><i class="fab fa-linkedin-in"> </i><span>/</span>' . $leader_id . '</a>';

				

				if ( get_sub_field('featured_leader') == 1 ) {

				?>
            <div class="featured-leader col-12">
                <div class="row">
                    <div class="leader-details col-md-4 col-lg-3 text-center">
                        <?php echo wp_get_attachment_image( get_sub_field('photo'), 'leader-l', '', array( 'class' => 'leader-portrait mb-3') ); ?>
                        <h5 class="text-uppercase mb-0" style="letter-spacing:1px"><?php the_sub_field('name'); ?></h5>
                        <p class="mb-0"><?php the_sub_field('title'); ?></p>
                        <hr class="small-divider-xs">
                        <p class="leader-contact">
                            <?php echo $leader_contact_details; ?>
                        </p>
                    </div>

                    <div class="leader-bio col-md-8 col-lg-8">
                        <div id="<?php echo $leader_id; ?>-bio" class="bio">
                            <?php the_sub_field('biography'); ?>
                        </div>
                        <blockquote id="<?php echo $leader_id; ?>-bq">
                            <hr class="small-divider">
                            <p>"<?php the_sub_field('quote'); ?>"</p>
                            <footer>
                                <?php the_sub_field('name'); ?>
                            </footer>
                        </blockquote>
                    </div>

                    <div class="leader-quote col-12">
                        <blockquote>
                        <hr class="small-divider">
                            <p>"<?php the_sub_field('quote'); ?>"</p>
                            <footer>
                                <?php the_sub_field('name'); ?>
                            </footer>
                        </blockquote>
                    </div>

                </div>
                &nbsp;
            </div>
            <?php
				} else {
				?>
            <div class="non-featured-leader col-md-6 col-lg-3 text-center">
                <?php echo wp_get_attachment_image( get_sub_field('photo'), 'leader-l', '', array( 'class' => 'leader-portrait mb-3') ); ?>
                <h6 class="text-uppercase mb-0" style="letter-spacing:0.5px"><?php the_sub_field('name'); ?></h6>
                <p class="mb-0"><?php the_sub_field('title'); ?></p>

                <hr class="small-divider-xs">

                <p id="<?php echo $leader_id; ?>-contact" class="leader-contact"><?php echo $leader_contact_details; ?>
                </p>
            </div>
            <?php
				}

			endwhile;
			?>
        </div>
        <?php
			binarym_after_content_block();
		?>
    </div>
    <?php binarym_block_ornament(); ?>
</div><!-- .gallery -->

