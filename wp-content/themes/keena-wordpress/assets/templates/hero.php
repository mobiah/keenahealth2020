<?php

	if ( is_home() ) {

		$hero_headline = get_the_title( get_option( 'page_for_posts' ) );
		$hero_text = get_the_excerpt( get_option( 'page_for_posts' ) );

	} else if ( is_404() ) {

		$hero_headline = get_option('options_404_page_hero_headline');
		$hero_text = get_option('options_404_page_hero_text');

	} else {
		$hero_image_id = get_post_meta( get_the_ID(), 'hero_image', true );
		$hero_headline = get_post_meta( get_the_ID(), 'hero_headline', true );
		$hero_text = get_post_meta( get_the_ID(), 'hero_text', true );
		$hero_tall = get_post_meta( get_the_ID(), 'hero_tall', true );

	}

	if ( is_singular( 'career' ) )
		$hero_text = get_post_meta( get_the_ID(), 'location', true );

	if ( is_singular( 'post' ) ) {
		
		$author_id = get_post_field( 'post_author', get_the_ID() );
		$hero_text = get_the_author_meta( 'display_name', $author_id ) . '&nbsp; &bull; &nbsp;' . get_the_time('F j, Y');

	}

	$insights = false;
	$is_case_study = '';

	if ( is_singular( 'insights' ) ) {

		$insights = true;
		$case_study_org = get_post_meta( get_the_ID(), 'case_study_org', true );
		$is_case_study = 'case-study';
	}

	if ( isset( $hero_image_id ) ) {

		$hero_image_src = wp_get_attachment_image_src( $hero_image_id, 'full' );

		if ( is_array( $hero_image_src ) )
			$hero_image = ' style="background-image: url(' . $hero_image_src['0'] . ');"';

	}

	if ( !isset( $hero_image ) )
		$hero_image = '';

	if ( !isset( $hero_tall ) )
		$hero_tall = '';

	if ( empty( $hero_headline ) )
		$hero_headline = get_the_title();
?>

<div class="hero<?php echo ( $hero_tall == 1 ? ' hero-splash' : '' ); ?>"
    <?php echo binarym_first_block_background(); ?>>

    <div class="hero-background">

        <?php if ( $hero_image ) : ?>
        <div class="hero-background-image" <?php echo $hero_image; ?>></div>
        <?php endif; ?>

    </div>

    <?php

	if ($insights) {?>
    <div class="container hero-content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="hero-column">
                        <h1 class="hero-heading"><?php echo $hero_headline; ?></h1>
                        <hr class="small-divider">
                        <h1 class="case-study-title"><?php echo $hero_text; ?></h1>
                        <hr class="small-divider">
                        <p class="hero-organization"><?php echo $case_study_org; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
	} else {?>
    <div class="container hero-content">
        <div class="row">
            <div class="hero-column">
                <h1 class="hero-heading"><?php echo $hero_headline; ?></h1>
                <hr class="small-divider">
                <?php echo wpautop( $hero_text ); ?>
            </div>
        </div>
    </div>
    <?php
	}

	?>

</div><!-- .hero -->