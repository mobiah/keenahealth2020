<div <?php binarym_bg_builder(); ?>>

    <div class="container">
        <!-- Format the document if user has js disabled -->
        <noscript>
            <style>
            .insights-blocks-container {
                display: grid;
                grid-template-columns: 32% 32% 32%;
                grid-gap: 20px;
            }

            .insights-blocks {
                min-height: 220px;
                max-height: 250px;
                overflow: hidden;
            }

            .insights-header {
                padding-bottom: 15px;
            }

            .ins-desc,
            #filter-show {
                display: none;
            }

            .brochure-insights .insights-blocks {
                max-height: 333px;
            }
            </style>
        </noscript>
        <!-- End noscript -->

        <?php binarym_before_content_block(); ?>
        <div class="row justify-content-<?php the_sub_field('block_alignment'); ?>" id="published-insights">
            <div class="col-md-<?php the_sub_field('content_width'); ?>">
                <div class="all-insights-section">

                    <?php

                    function addClasses($class_array)
                    {
                        $classes .= 'class="';
                        foreach ($class_array as $term) {
                            $classes .=  strtolower($term->slug) . " ";
                            $count++;
                        }

                        $classes .= '"';
                        echo $classes;
                    }

                    function separateTerms($replace, $replace_with, $input)
                    {
                        $count = 0;
                        if (!empty($input)) {
                            foreach ($input as $term) {
                                echo 'data-category-' . $count . '="' . str_replace($replace, $replace_with, $term->name) . '" ';
                                $count++;
                            }
                        }
                    }

                    function separateUnderscore($replace, $replace_with, $input)
                    {
                        return strtoupper(str_replace($replace, $replace_with, $input));
                    }

                    $page_url = get_permalink();

                    // Get and store our category in a variable
                    $cat = get_sub_field_object('publications');
                    
                    $choices = $cat['choices'];
                    $value = $cat['value'];
                    $label = $cat['choices'][$value];
                    $filter = get_sub_field('filter');
                    $format = get_sub_field('format');
                    $is_slideshow = 'false';
                    $slideshow = 'grid';

                    $card_middle_opener = '<div class="card-middle"><div class="card-content"><p class="h3 title">';
                    $card_description = '<p class="ins-desc">';
                    $card_middle_closer = '</div></div>';

                    if ($format === 'Slideshow') {
                        $filter = 'Hide';
                        $is_slideshow = 'true';
                        $slideshow = 'slideshow';
                    }

                    $term = get_sub_field('insight_group');
                    
                    // Query ALL Insights posts
                    $grouped_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'meta_key' => 'insight_badge_parent',
                        'orderby' => 'meta_key insight_badge_parent',
                    );
					
					$home_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'category__and' => 145,
                        'meta_key' => 'insight_badge_parent',
                        'orderby' => 'meta_key insight_badge_parent',
                        'order' => 'ASC'
                    );

                    $wp_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'category__and' => 141,
                        'tag__and' => $term,
                        'meta_key' => 'insight_badge_parent',
                        'orderby' => 'meta_key insight_badge_parent',
                        'order' => 'ASC'
                    );

                    $cs_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'category__and' => 143,
                        'tag__and' => $term,
                        'meta_key' => 'insight_badge_parent',
                        'orderby' => 'meta_key insight_badge_parent',
                        'order' => 'ASC'
                    );

                    $ss_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'category__and' => 142,
                        'tag__and' => $term,
                        'meta_key' => 'insight_badge_parent',
                        'orderby' => 'meta_key insight_badge_parent',
                        'order' => 'ASC'
                    );

                    $bc_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'category__and' => 144,
                        'tag__and' => $term,
                        'meta_key' => 'insight_badge_parent',
                        'orderby' => 'meta_key insight_badge_parent',
                        'order' => 'ASC'
                    );

                    $page_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'tag__and' => $term,
                        'meta_key' => 'insight_badge_parent',
                        'orderby' => 'meta_key insight_badge_parent',
                        'order' => 'ASC'
                    );


                    $loop = new WP_Query($page_insights);

                    if( $term ): 

                    if ($format === 'Slideshow') {
                        
                            echo '<div class="solutions-insights-container">';

                            if ($loop->have_posts()) :
                                while ($loop->have_posts()) : $loop->the_post();

                                $the_title = get_the_title();
                                $post_id = get_queried_object_id();
                                $tags = wp_get_post_tags($post->ID);
                                $cat = get_the_category();
                                $cat_name = $cat[0]->name;

                                if ($cat[0]->name === 'home featured insights') {
                                    $cat_name = $cat[1]->name;
                                }

                                if (have_rows('insight')) :
                                    while (have_rows('insight')) : the_row();
                                        // Get sub field values.
                                        $media = get_sub_field('insight_media');
                                        $url = $media['url'];
                                        $parent = get_sub_field('badge_parent');
                                        $link_url = get_sub_field('insight_link');

                                        if ($media && $link_url) {
                                            $url = $media['url'];
                                        } elseif ($media && !$link_url) {
                                            $url = $media['url'];
                                        } elseif ($link_url && !$media) {
                                            $url = $link_url;
                                        } else {
                                            $url = $media['url'];
                                        }

                                        // run this through function above to remove underscores and update the value
                                        $parent = separateUnderscore('_', ' ', $parent);

                                    endwhile;
                                endif;
                                $excerpt = get_the_excerpt();
                                
                                if (!$the_title || !$url) {
                                    continue;
                                }

                                ?>


                    <div class="solutions-insights">
                        <div class="insights-blocks" <?php echo separateTerms(' ', '-', $tags); ?>>
                            <div class="card-top">
                                <p class="badge associate">
                                    <span><?php echo $parent; ?></span>
                                </p>
                                <p class="h3 mt-3"><?php echo $the_title;?></p>
                            </div>
                            <div class="card-middle">
                                <?php
                                if (has_excerpt()) {
                                    echo the_excerpt();
                                } elseif ($excerpt) {
                                    echo $excerpt;
                                } else {
                                    echo '';
                                }
                            ?>
                            </div>
                            <div class="card-bottom">
                                <hr />
                                <a href="<?php echo $url;?>" target="_blank" class="btn">READ
                                    <?php echo $cat_name;?></a>
                            </div>
                        </div>
                    </div>

                    <?php
                            
                                endwhile;
                            else :
                                _e( 'Sorry, no posts were found.', 'keena-wordpress' );
                            endif;
                            wp_reset_postdata();
                       
                        echo '</div>';

                    } else {

                    // If set to Solution Types, display all insight posts
                    
                    ?>

                    <form action="<?php echo $page_url . '#published-insights'; ?>" method="post"
                        id="filter-<?php echo strtolower($filter); ?>" class="insights-filter">
                        <div>
                            <div id="solutionsFilter" class="mb-4">
                                <label for="<?php echo $cat['key']; ?>">Filter By: </label>
                                <div class="dropdown">
                                    <select id="insightsDropdown">
                                        <option value="All Keena Insights">All Keena Insights</option>
                                        <option value="Advisory Services">Advisory Services</option>
                                        <option value="EHR Barcode Reader">EHR Barcode Reader</option>
                                        <option value="Chart2PDF">Chart2PDF</option>
                                        <option value="Conversion and Archival">Conversion and Archival</option>
                                        <option value="Data Management and Analytics">Data Management and Analytics
                                        </option>
                                        <option value="InteleFiler">InteleFiler</option>
                                        <option value="Interfaces and Interoperability">Interfaces and Interoperability
                                        </option>
                                        <option value="LiveArchive">LiveArchive</option>
                                        <option value="Patient Engagement">Patient Engagement</option>
                                        <option value="Population Health">Population Health</option>
                                        <option value="System and Business Automation">System and Business Automation
                                        </option>
                                        <option value="Workflow Efficiency">Workflow Efficiency</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="filter" class="insights-grouped-slideshow insights-grid insights">

                        <?php
                        $header_opener = '<div class="insights-header"><div><img src="';
                        $header_fs_closer = '" alt="" width="100%" class="alignleft size-full img-portrait"/></div>';
                        $header_title = '<div><p class="h1 single-insights-title">';
                        $header_ss_closer = '</p><hr /></div></div>';
                        $associate_opener = '<p class="badge associate"><span>';
                        $associate_closer = '</span></p>';

                        // WHITEPAPER LOOP
                        $loop = new WP_Query($wp_insights);
                       
                        if ($loop->have_posts()) :

                            $whitepaper_icon = "/wp-content/uploads/2023/02/whitepaper-icon.png";
                            echo '<div class="insights-whitepapers ins-sec">';
                            echo $header_opener;
                            echo $whitepaper_icon;
                            echo $header_fs_closer;
                            echo $header_title.'Whitepapers'.$header_ss_closer;

                            echo '<div class="insights-blocks-container wp-insights">';

                            while ($loop->have_posts()) : $loop->the_post();

                                $title = get_the_title();
                               
                                $post_id = get_queried_object_id();
                                $tags = wp_get_post_tags($post->ID);
                                $whitepaper_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                $cat = get_the_category();
                                $cat_name = $cat[0]->name;

                                if ($cat[0]->name === 'home featured insights') {
                                    $cat_name = $cat[1]->name;
                                }

                                if (have_rows('insight')) :
                                    while (have_rows('insight')) : the_row();
                                        // Get sub field values.
                                        $media = get_sub_field('insight_media');
                                        $url = $media['url'];
                                        $parent = get_sub_field('badge_parent');
                                        $link_url = get_sub_field('insight_link');
                                        if ($media && $link_url) {
                                            $url = $media['url'];
                                        } elseif ($media && !$link_url) {
                                            $url = $media['url'];
                                        } elseif ($link_url && !$media) {
                                            $url = $link_url;
                                        } else {
                                            $url = $media['url'];
                                        }

                                        // run this through function above to remove underscores and update the value
                                        $parent = separateUnderscore('_', ' ', $parent);

                                    endwhile;
                                endif;

                                $excerpt = get_the_excerpt();

                            if (!$url) {
                                continue;
                            }

                            ?>
                        <div <?php echo addClasses($tags); ?>>
                            <div class="insights-blocks" <?php echo separateTerms(' ', '-', $tags); ?>>
                                <div class="card-top">
                                    <div class="insight-img">
                                        <?php echo $associate_opener.$parent.$associate_closer; ?>
                                        <?php
                                        if ($whitepaper_img) {
                                        ?>
                                        <div class="whitepaper-img"
                                            style="background-image:url('<?php echo $whitepaper_img; ?>');">
                                        </div>
                                        <?php
                                        } else {
                                            ?>
                                        <div class="wp-img"
                                            style="background-image:url('/wp-content/uploads/2023/02/ehr-migration-journal-background-imagery-tube-1.jpg');">
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php echo $card_middle_opener . $title.'</p>' . $card_description.$excerpt.'</p>' . $card_middle_closer;?>
                                <div class="card-bottom">
                                    <hr />
                                    <a href="<?php echo $url;?>" target="_blank" class="btn">READ
                                        <?php echo $cat_name;?></a>
                                </div>
                            </div>
                        </div>

                        <?php

                                endwhile;
                                echo '</div>';
                                echo '</div>';
                            else :
                                // _e('<p class="no-insights-found">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                            endif;
                            wp_reset_postdata();

						// CASE STUDY LOOP
                        $loop = new WP_Query($cs_insights);

                        if ($loop->have_posts()) :
                            $case_study_icon = '/wp-content/uploads/2023/02/case-study-icon.png';
                            echo '<div class="insights-case-studies ins-sec">';

                            echo $header_opener;
                            echo $case_study_icon;
                            echo $header_fs_closer;
                            echo $header_title.'Case Studies'.$header_ss_closer;
                            echo '<div class="insights-blocks-container cs-insights">';

                            while ($loop->have_posts()) : $loop->the_post();

                                $title = get_the_title();
                                
                                $post_id = get_queried_object_id();
                                $tags = wp_get_post_tags($post->ID);
                                $cat = get_the_category();
                                $cat_name = $cat[0]->name;

                                if ($cat[0]->name === 'home featured insights') {
                                   $cat_name = $cat[1]->name;
                                }

                                $card_middle_open = '<div class="card-middle"><div class="card-content">';
                                $card_middle_close = '</div></div>';

                                if (have_rows('insight')) :
                                    while (have_rows('insight')) : the_row();
                                        // Get sub field values.
                                        $parent = get_sub_field('badge_parent');
                                        $media = get_sub_field('insight_media');
                                        $benefits = get_sub_field('benefits');
                                        $url = $media['url'];
                                        $link_url = get_sub_field('insight_link');
                                        if ($media && $link_url) {
                                            $url = $media['url'];
                                        } elseif ($media && !$link_url) {
                                            $url = $media['url'];
                                        } elseif ($link_url && !$media) {
                                            $url = $link_url;
                                        } else {
                                            $url = $media['url'];
                                        }

                                        // run this through function above to remove underscores and update the value
                                        $parent = separateUnderscore('_', ' ', $parent);

                                    endwhile;
                                endif;

                                $excerpt = get_the_excerpt();
                                
                                
                                if (!$url) {
                                    continue;
                                }
                            ?>

                        <div <?php echo addClasses($tags); ?>>

                            <div class="insights-blocks" <?php echo separateTerms(' ', '-', $tags); ?>>
                                <div class="card-top">
                                    <?php echo $associate_opener.$parent.$associate_closer; ?>
                                    <p class="h3 title"> <?php echo $title; ?></p>
                                    <?php if (has_excerpt()) { ?>
                                    <p class="ins-desc"><?php echo $excerpt; ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php echo $card_middle_open.$benefits.$card_middle_close;?>

                                <div class="card-bottom">
                                    <hr />
                                    <a href="<?php echo $url;?>" target="_blank" class="btn">READ
                                        <?php echo $cat_name;?></a>
                                </div>
                            </div>
                        </div>
                        <?php

                            endwhile;
                            echo '</div>';
                            echo '</div>';
                        else :
                            // _e('<p class="no-insights-found">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                        endif;
                        wp_reset_postdata();

                            // SALES SHEETS
                            $loop = new WP_Query($ss_insights);

                            if ($loop->have_posts()) :
                                $sales_sheet_icon = '/wp-content/uploads/2023/02/sales-sheet-icon.png';
                                echo '<div class="insights-sales-sheets ins-sec">';

                                echo $header_opener;
                                echo $sales_sheet_icon;
                                echo $header_fs_closer;
                                echo $header_title.'Sales Sheets'.$header_ss_closer;
                                echo '<div class="insights-blocks-container ss-insights">';

                                while ($loop->have_posts()) : $loop->the_post();

                                    $title = get_the_title();
                                    
                                    $tags = wp_get_post_tags($post->ID);
                                    $post_id = get_queried_object_id();
                                    $cat = get_the_category();
                                    $cat_name = $cat[0]->name;

                                    if ($cat[0]->name === 'home featured insights') {
                                        $cat_name = $cat[1]->name;
                                    }

                                    if (have_rows('insight')) :
                                        while (have_rows('insight')) : the_row();
                                            // Get sub field values.
                                            $parent = get_sub_field('badge_parent');
                                            $media = get_sub_field('insight_media');
                                            $url = $media['url'];
                                            $link_url = get_sub_field('insight_link');
                                            if ($media && $link_url) {
                                                $url = $media['url'];
                                            } elseif ($media && !$link_url) {
                                                $url = $media['url'];
                                            } elseif ($link_url && !$media) {
                                                $url = $link_url;
                                            } else {
                                                $url = $media['url'];
                                            }

                                            // run this through function above to remove underscores and update the value
                                            $parent = separateUnderscore('_', ' ', $parent);

                                        endwhile;
                                    endif;

                                    $content = get_the_content();

                                    if (!$url) {
                                        continue;
                                    }
                                ?>
                        <div <?php echo addClasses($tags); ?>>
                            <div class="insights-blocks" <?php echo separateTerms(' ', '-', $tags); ?>>
                                <div class="card-top">
                                    <?php echo $associate_opener.$parent.$associate_closer; ?>
                                </div>
                                <?php echo $card_middle_opener . $title . $card_middle_secondary . $card_middle_closer;?>
                                <div class="card-bottom">
                                    <hr />
                                    <a href="<?php echo $url;?>" target="_blank" class="btn">READ
                                        <?php echo $cat_name;?></a>
                                </div>
                            </div>
                        </div>
                        <?php

                            endwhile;
                            echo '</div>';
                            echo '</div>';
                        else :
                            // _e('<p class="no-insights-found">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                        endif;

                        wp_reset_postdata();

                        // BROCHURES
                        $loop = new WP_Query($bc_insights);

                            if ($loop->have_posts()) :
                                echo '<div class="insights-brochures ins-sec">';
                                $brochure_icon = '/wp-content/uploads/2023/02/brochure-icon.png';

                                echo $header_opener;
                                echo $brochure_icon;
                                echo $header_fs_closer;
                                echo $header_title.'Brochures'.$header_ss_closer;
                                echo '<div class="insights-blocks-container brochure-insights">';

                                while ($loop->have_posts()) : $loop->the_post();

                                    $title = get_the_title();
                                    
                                    $tags = wp_get_post_tags($post->ID);
                                    $cat = get_the_category();
                                    $cat_name = $cat[0]->name;
                                    
                                    $post_id = get_queried_object_id();
                                    $brochure_img = get_the_post_thumbnail_url(get_the_ID(), 'large');

                                    if ($cat[0]->name === 'home featured insights') {
                                       $cat_name = $cat[1]->name;
                                    }

                                    if (have_rows('insight')) :
                                        while (have_rows('insight')) : the_row();
                                            // Get sub field values.
                                            $parent = get_sub_field('badge_parent');
                                            $media = get_sub_field('insight_media');
                                            $url = $media['url'];
                                            $link_url = get_sub_field('insight_link');
                                            if ($media && $link_url) {
                                                $url = $media['url'];
                                            } elseif ($media && !$link_url) {
                                                $url = $media['url'];
                                            } elseif ($link_url && !$media) {
                                                $url = $link_url;
                                            } else {
                                                $url = $media['url'];
                                            }

                                            // run this through function above to remove underscores and update the value
                                            $parent = separateUnderscore('_', ' ', $parent);

                                        endwhile;
                                    endif;

                                    $excerpt = get_the_excerpt();

                                    if (!$url) {
                                        continue;
                                    }

                            ?>
                        <div <?php echo addClasses($tags); ?>>
                            <div class="insights-blocks" <?php echo separateTerms(' ', '-', $tags); ?>>
                                <div class="card-top">
                                    <div class="insight-img">
                                        <?php
                                        if ($brochure_img) {
                                        ?>
                                        <div class="brochure-img"
                                            style="background-image:url('<?php echo $brochure_img; ?>');">
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php echo $card_middle_opener . $title.'</p>' . $card_description.$excerpt.'</p>' . $card_middle_closer;?>
                                <div class="card-bottom">
                                    <hr />
                                    <a href="<?php echo $url;?>" target="_blank" class="btn">READ
                                        <?php echo $cat_name;?></a>
                                </div>
                            </div>
                        </div>

                        <?php
                            endwhile;
                            echo '</div>';
                            echo '</div>';
                        else :
                            // _e('<p class="no-insights-found">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                        endif;

                        wp_reset_postdata();

                        ?>
                    </div>
                    <?php
                }
                ?>
                </div>
                <?php 
                 endif; 
                ?>
            </div>
        </div><!-- .row -->
    </div>
</div>
<?php binarym_block_ornament(); ?>
</div>