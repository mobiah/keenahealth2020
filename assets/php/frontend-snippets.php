<?php

	add_shortcode( 'keena_video', function( $input ) {

		$output = '';

		if ( isset( $input['vimeo_id'] ) )
			$output = '<div class="embed-video"><iframe src="https://player.vimeo.com/video/'. $input['vimeo_id'] .'" width="640" height="360" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';

		return $output;
	} );

	function binarym_blog_tags() {
		?>
		<div class="post-tags clearfix">

			<span class="share-post">
				<span class="share-post-title">Share</span>
				<a href="https://www.linkedin.com/shareArticle?url=<?php echo esc_attr( get_the_permalink() ); ?>&amp;mini=true"><i class="fab fa-linkedin"></i></a>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr( get_the_permalink() ); ?>"><i class="fab fa-facebook"></i></a>
				<a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr( get_the_permalink() ); ?>&amp;via="><i class="fab fa-twitter"></i></a>
			</span>

			<?php
				if ( has_tag() ) {
			?>
				<p class="post-tags-title">Tags:</p>
				<p class="post-tags-list"><?php binarym_show_tags(); ?></p>
			<?php
				}
			?>
		</div>
		<?php
	}

	function binarym_show_tags() {
		$post_tags = wp_get_post_tags( get_the_ID() );

		foreach( $post_tags as $pag ) {

			if ( isset( $first_tag_done ) ) {
				echo ' &bull; ';
			}

			echo $pag->name;

			$first_tag_done = true;
		}
	}

	function binarym_cat_option( $display_options, $feature = '' ) {

		if ( !is_array( $display_options ) || empty( $feature ) )
			return false;

		if ( in_array( $feature, $display_options ) )
			return true;

	}

	function binarym_category_header( $show_categories ) {

		if ( !$show_categories )
			return;

		global $queried_term;
		$current_ID = $queried_term->term_id;

		$post_cats = wp_get_post_categories( get_the_ID() );

		foreach( $post_cats as $pat ) {

			if ( $pat == $current_ID )
				continue;

			$cat_name = get_cat_name( $pat );
			break;
		}

		if ( isset( $cat_name ) && !empty( $cat_name ) )
			echo '<h6>'.$cat_name.'</h6>';

	}

	function binarym_cache_buster( $file ) {
		return filemtime( get_template_directory() . $file );
	}

	function binarym_post_thumbnail( $size = 'post-thumbnail' ) {

		if ( has_post_thumbnail() ) {

			the_post_thumbnail( $size );

		} else {

			$hero_title = get_field('hero_title');
			$hero_sub_title = get_field('hero_sub_title');

			if ( !empty( $hero_title ) && !empty( $hero_sub_title ) ) {

				if ( is_array( $size ) ) {
					$image_name = 'placeholder-'.$size[0].'x'.$size[1].'.png';
					$class = 'post-box-hero';
				} else {
					$image_name = 'placeholder-'.$size.'.png';
					$class = $size;
				}

				if ( file_exists( get_template_directory() . '/public/images/placeholders/' . $image_name ) )
					$placeholder_img = '<img class="placeholder-backdrop" src="'.get_template_directory_uri() .'/public/images/placeholders/'.$image_name.'">';
			?>
				<div class="hero-placeholder bg-steel-blue <?php echo $class; ?>">
					<?php echo isset( $placeholder_img ) ? $placeholder_img : ''; ?>

					<div class="placeholder-title px-4 px-md-5">
						<h5 class="title"><?php echo $hero_title; ?></h5>
						<h6 class="sub-title"><?php echo $hero_sub_title; ?></h6>
					</div>

					<img class="placeholder-ornament" src="<?php echo get_template_directory_uri(); ?>/public/images/bg-plus-post-default.svg" alt="">
				</div>
			<?php
			} else {

				if ( is_array( $size ) )
					$image_name = 'binarym-'.$size[0].'x'.$size[1].'.png';
				else
					$image_name = 'binarym-'.$size.'.png';

				if ( file_exists( get_template_directory() . '/public/images/placeholders/' . $image_name ) )
					echo '<img src="'.get_template_directory_uri() .'/public/images/placeholders/'.$image_name.'">';

			}

		}

	}

	function binarym_shorter_string( $default, $default_short, $length ) {

		// roll over to shorter option when available.
		if ( strlen( $default ) > $length && !empty( $default_short ) )
			$default = $default_short;

		// trim if we still need to be shorter.
		if ( strlen( $default ) > $length )
			$default = substr( $default, 0, $length-2 ) . '&hellip;';

		return $default;

	}

	function binarym_excerpt( $length = 40, $short_excerpt = null ) {

		$excerpt_return = '';
		$excerpt_array = array();

		if ( !empty( $short_excerpt ) )
			$excerpt_array = explode(' ', $short_excerpt );

		if ( count( $excerpt_array ) < 10 )
			$excerpt_array = explode(' ', get_the_excerpt() );

		if ( count( $excerpt_array ) < 10 )
			$excerpt_array = explode(' ', get_the_content() );

		if ( count( $excerpt_array ) < 10 )
			return '<p>Please view full post.</p>';

		for ( $x=0; $x < $length; $x++ ) {

			if ( isset( $excerpt_array[ $x ] ) )
				$excerpt_return .= $excerpt_array[ $x ] . ' ';

		}

		return '<p>' . trim( $excerpt_return, ' .,!?' ) . '...</p>';
	}

	function binarym_get_menu_title( $location ) {

		$locations = get_nav_menu_locations();
		$menu_object = ( isset($locations[$location] ) ) ? wp_get_nav_menu_object( $locations[$location] ) : null;
		$menu_title = ( isset( $menu_object->name ) ) ? $menu_object->name : '';

		return esc_html( $menu_title );

	}

	function binarym_numbers_from_string( $input ) {
		return preg_replace( "/[^0-9]/", '', $input );
	}

	function binarym_phone() {

		$phone = '<a href="tel:+'. binarym_numbers_from_string( get_option('options_phone_number') ) .'"';


		$phone .= ' class="phone_number"';

		$phone .= '>'. get_option('options_phone_number') .'</a>';

		return $phone;

	}

	function binarym_email() {

		$email = '<a href="mailto:'. get_option('options_email_address') .'"';

		$email .= ' class="email_address"';

		$email .= '>'. get_option('options_email_address') .'</a>';

		return $email;

	}

	function binarym_search_nav() {
		global $wpdb;

		$search_id = $wpdb->get_var("select post_id from ".$wpdb->prefix."postmeta, ".$wpdb->prefix."posts where meta_key = '_wp_page_template' and meta_value = 'page-search.php' and ".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id and ".$wpdb->prefix."posts.post_status = 'publish' limit 1");

		if ( isset( $search_id ) && $search_id > 0 )
			$search_link = get_permalink( $search_id );

		if ( isset( $search_link ) && $search_link !== false )
			return '<a href="'.$search_link.'" class="search"><i class="fas fa-search"></i></a>';


	}

	function binarym_first_block_background() {

		$background_style = '';

		if ( get_page_template_slug() === 'template-blocks.php' ) {

			$background_color = get_post_meta( get_the_ID(), 'content_block_0_background_color', true );

			if ( isset( $background_color ) )
				$background_style = ' style="background-color:'. $background_color .'"';

		}

		return $background_style;
	}

	function binarym_breadcrumbs() {

		if ( is_front_page() )
			return;

		?>
		<div<?php echo binarym_first_block_background(); ?>>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="breadcrumbs pt-5">
							<?php binarym_breadcrumbs_nav(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php

	}

	function binarym_breadcrumbs_nav() {

		if ( is_front_page() )
			return;

		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb(  );
			return;
		}

		echo '<a href="/">Home</a> / ';

		if ( is_page() ) {

			$page_ancestors = get_ancestors( get_the_ID(), 'page', 'post_type' );

			if ( count( $page_ancestors ) > 0 ) {

				$ancestors = array_reverse( $page_ancestors );

				foreach( $ancestors as $ancestor )
					echo '<a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a> / ';

			}

			echo get_the_title( get_the_ID() );

		}

		else if ( is_single() ) {
			// add category & ancestors
			$category = get_the_category();

			binarym_category_breadcrumbs( $category[0]->term_id );

			echo '<a href="'. get_category_link( $category[0]->term_id ) .'">'. get_cat_name( $category[0]->term_id ) .'</a> / ';

			// add post
			echo get_the_title( get_the_ID() );
		}

		else if ( is_category() ) {

			global $wp_query;

			binarym_category_breadcrumbs( $wp_query->get_queried_object()->term_id );

			// add category
			echo $wp_query->get_queried_object()->name;
		}

		else if ( is_search() ) {
			echo 'Search';
		}

		else if ( is_404() ) {
			echo 'Page Not Found';
		}


	}

	function binarym_category_breadcrumbs( $cat_id ) {
		$category_ancestors = get_ancestors( $cat_id , 'category' );

		if ( count( $category_ancestors ) > 0 ) {

			$ancestors = array_reverse( $category_ancestors );

			foreach( $ancestors as $ancestor )
				echo '<a href="'. get_category_link( $ancestor ) .'">'. get_cat_name( $ancestor ) .'</a> / ';

		}
	}

	function binarym_get_social_links() {
		$social = get_field( 'profiles', 'option' );

		if ( $social ) :

			$social_links = array();

			foreach ( $social as $s ) {

				$social_links[] = array(
					'slug' => $s['site']['value'],
					'name' => $s['site']['label'],
					'link' => $s['profile_url'],
				);

			}

		endif;

		return $social_links;
	}

	function binarym_social_links_shortcode( $atts ) {
		$social_links = '';

		$social = get_field( 'profiles', 'option' );

		if ( $social ) {
			$social_links .= '<ul class="social-link-list">';
			foreach ( $social as $s ) {
				$social_links .= '<li class="social-link-item">';
				$social_links .= '<a href="'. $s['profile_url'] .'"><i class="fab fa-'. $s['site']['value'] .' fa-fw"></i>';
				$social_links .= $s['site']['label'];
				$social_links .= '</a>';
				$social_links .= '</li>';
			}
			$social_links .= '</ul>';
		}

		return $social_links;
	}
	add_shortcode( 'social_links', 'binarym_social_links_shortcode' );

	function binarym_company_details_shortcode( $atts ) {

		$a = shortcode_atts( array(
			'type' => '',
			'svg' => false,
		), $atts );

		if ( $atts['type'] == 'phone' ) {
			$output = get_field( 'phone_number', 'option' );

		} elseif ( $atts['type'] == 'email' ) {
			$output = get_field( 'email_address', 'option' );


		} elseif ( $atts['type'] == 'logo' ) {

			if ( get_field( 'logo', 'option' ) ) {

				if ( isset( $atts['svg'] ) && $atts['svg'] == true ) {
					$output = binarym_inline_svg( get_field( 'logo', 'option' ), true );
				} else {
					$output = get_field( 'logo', 'option' );
				}

			} else {
				$output = '<img class="d-inline-block" src="' . get_template_directory_uri() . '/public/img/logo.svg">';
			}
		}

		return $output;
	}
	add_shortcode( 'company_details', 'binarym_company_details_shortcode' );


	add_filter( 'widget_text', 'do_shortcode' );


	// Get an array of raw menu data that we can output however the heck we want.
	function binarym_get_nav_menu( $theme_location ) {

		$theme_locations = get_nav_menu_locations();

		if ( empty( $theme_locations[$theme_location] ) )
			return;

		$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );

		if ( empty( $menu_obj->term_id ) )
			return;

		$menu_items = wp_get_nav_menu_items( $menu_obj->term_id );
		$menu = array();

		foreach ( $menu_items as $key => $item ) {

			if ( $item->menu_item_parent == 0 ) {

				$menu[$item->ID] = $item;
				$parent_id = $item->ID;
				$children = array();

			} elseif ( $item->menu_item_parent == $parent_id ) {

				$children[] = $item;
				$menu[$parent_id]->children = $children;

			}
		}

		return $menu;

	}


	// Format nav menu output and display.
	// Pluggable function. Can be overridden in child theme to allow for custom menu output.
	if ( ! function_exists ( 'binarym_display_nav_menu' ) ) {

		function binarym_display_nav_menu( $theme_location, $navbar_nav = false, $dropdowns = false ) {

			$menu = binarym_get_nav_menu( $theme_location );

			if ( empty( $menu ) )
				return;

			$post_id = get_the_ID();

			// echo $post_id;

			// echo '<pre>' . print_r( $menu, true ) . '</pre>';

			?>

			<ul class="<?php echo $navbar_nav == true ? 'navbar-nav' : 'nav'; ?>">

			<?php foreach ( $menu as $item ) : ?>

				<?php
					$active = '';
					$classes = '';

					if ( $item->object_id == $post_id ) {
						$active = 'current-menu-item';
					}

					$classes = implode( ' ', $item->classes );
				?>

				<?php if ( $item->children && $dropdowns == true ) : ?>

					<li class="nav-item dropdown <?php echo $classes; ?>">

						<a class="nav-link dropdown-toggle <?php echo $active; ?>" data-toggle="dropdown" href="<?php echo $item->url; ?>">
							<?php echo $item->title; ?>
						</a>

						<div class="dropdown-menu">
							<?php foreach( $item->children as $child ) { ?>

								<?php
									$active = '';
									if ( $child->object_id == $post_id ) {
										$active = 'current-menu-item';
									}
								?>

								<a href="<?php echo $child->url; ?>" class="dropdown-item <?php echo $active; ?>"><?php echo $child->title; ?></a>
							<?php } ?>
						</div>

					</li>

				<?php elseif ( $item->children ) : ?>

					<li class="nav-item <?php echo $classes; ?>">

						<a class="nav-link" href="<?php echo $item->url; ?>">
							<?php echo $item->title; ?>
						</a>

						<ul class="nav">
							<?php foreach( $item->children as $child ) { ?>
								<li class="nav-item">
									<a href="<?php echo $child->url; ?>" class="nav-link"><?php echo $child->title; ?></a>
								</li>
							<?php } ?>
						</ul>

					</li>

				<?php else : ?>

					<li class="nav-item <?php echo $classes; ?>">
						<a class="nav-link <?php echo $active; ?>" href="<?php echo $item->url; ?>">
							<?php echo $item->title; ?>
						</a>
					</li>

				<?php endif; ?>

			<?php endforeach; ?>

				<?php
					if ( $theme_location == 'primary-nav' ) {
					?>
					<li class="nav-item nav-item-search">
						<a data-toggle="collapse" href="#searchbar" class="nav-link search-toggle float-right"><i class="fa fa-search" aria-hidden="true"></i></a>
					</li>
					<?php
					}
				?>

			</ul><!-- .navbar-nav -->

		<?php
		}
	}

// This is an attempt to inject inline SVGs from the media library (rather than treating them as images.
// Useful for controlling colors and whatnot without having to upload a bunch of variants.
function binarym_inline_svg( $url, $echo = true ) {

	if ( ! $url ) {
		return;
	}

	ob_start();
	$path = parse_url( $url, PHP_URL_PATH );
	include $_SERVER['DOCUMENT_ROOT'] . $path;
	$contents = ob_get_clean();

	if ( $echo == true ) {
		echo $contents;
	} else {
		return $contents;
	}
}


// Add some helper classes to images inserted via WYSIWYG editor.
add_filter( 'get_image_tag_class', function( $class, $id, $align, $size ) {
	$data = wp_get_attachment_metadata( $id );
	$type = $data['sizes']['thumbnail']['mime-type'];

	if ( $data['width'] > $data['height'] ) {
		$class .= ' img-landscape';
	} else {
		$class .= ' img-portrait';
	}

	if ( $type == 'image/svg+xml' ) {
		$class .= ' img-type-svg';
	}

	return $class;
}, 10, 4 );
