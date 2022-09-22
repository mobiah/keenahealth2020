<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title(''); ?></title>

    <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/public/images/icons/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#36414f">
    <meta name="msapplication-TileImage"
        content="<?php echo get_template_directory_uri(); ?>/public/images/icons/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo"
        content="<?php echo get_template_directory_uri(); ?>/public/images/icons/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo"
        content="<?php echo get_template_directory_uri(); ?>/public/images/icons/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo"
        content="<?php echo get_template_directory_uri(); ?>/public/images/icons/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo"
        content="<?php echo get_template_directory_uri(); ?>/public/images/icons/mstile-310x310.png" />
    <meta name="theme-color" content="#36414f">
	

    <?php
		wp_head();
	?>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>

<body <?php body_class(); ?>>

    <?php
		wp_body_open();
	?>

    <div id="searchbar" class="collapse">
        <div class="searchbar-container container">
            <form class="searchbar-form form-inline" action="/" method="GET">
                <button type="submit" class="btn btn-link-alt btn-plain searchbar-submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                <input type="text" class="searchbar-input form-control" name="s"
                    placeholder="What are you searching for?">
            </form>

            <div class="searchbar-close">
                <a data-toggle="collapse" href="#searchbar" class="btn btn-link-alt btn-plain searchbar-close-link">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div><!-- #searchbar -->

    <header id="site-header" class="">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                    <span class="logo-light">
                        <?php binarym_inline_svg( get_template_directory_uri() . '/public/images/logo-keena.svg' ); ?>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-text">Menu</span> <span class="navbar-toggler-icon"></span>
                </button>
				
                <div id="navbarNav" class="collapse navbar-collapse">
			
                    <?php 
				binarym_display_nav_menu( $theme_location = 'primary-nav', $navbar_nav = true, $dropdowns = true ); 
					

					// wp_nav_menu(
					// 	array(
					// 		'theme_location' => 'primary-nav',
					// 		'menu_class'     => 'navbar-nav',
					// 		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							
					// 	)
					// );
					?>

                </div>
            </div><!-- .container -->
        </nav> 
    </header>

    <main class="content" id="site-main">

        <?php
			if ( is_search() )
				get_template_part( 'assets/templates/hero-search' );
			else
				get_template_part( 'assets/templates/hero' );
		?>