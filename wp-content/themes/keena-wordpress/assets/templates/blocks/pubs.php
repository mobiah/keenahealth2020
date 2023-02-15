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
                    <div id="insights-loading"></div>

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

                    function excludeValues($exc_array, $match_against)
                    {
                        foreach ($exc_array as $exclude) {

                            if (strtolower($match_against) === strtolower(separateUnderscore('_', ' ', $exclude))) {
                                return true;
                            }
                        }
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

                    // get the excluded choices if any
                    $exclude_list = get_sub_field_object('exclude');
                    $excluded_options = $exclude_list['choices'];
                    $excluded_values = $exclude_list['value'];

                    if ($format === 'Slideshow') {
                        $filter = 'Hide';
                        $is_slideshow = 'true';
                        $slideshow = 'slideshow';
                    }

                    // Query SPECIFIC insights posts
                    $specific_insights = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value',
                        'order' => 'ASC',
                        'groups' => $label . ' Insights'
                    );

                    // Query GROUPED insights posts
                    $case_study_posts = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value',
                        'tag_id' => 102,
                        'order' => 'ASC',
                        'meta_key' => 'insight_badge_parent'
                    );

                    $white_paper_posts = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value',
                        'tag_id' => 108,
                        'order' => 'ASC',
                        'meta_key' => 'insight_badge_parent'
                    );

                    $sales_sheet_posts = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value',
                        'tag_id' => 106,
                        'order' => 'ASC',
                        'meta_key' => 'insight_badge_parent'
                    );

                    $brochure_posts = array(
                        'post_type' => 'insights',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'meta_value',
                        'tag_id' => 115,
                        'order' => 'ASC',
                        'meta_key' => 'insight_badge_parent'
                    );

                    // If set to Solution Types, display all insight posts
                    if ($label == 'Solution Types') {
                    ?>
                    <!--Filter Button-->
                    <form action="<?php echo $page_url . '#published-insights'; ?>" method="post"
                        id="filter-<?php echo strtolower($filter); ?>" class="insights-filter">
                        <div>
                            <div id="solutionsFilter" class="mb-4">
                                <label for="<?php echo $cat['key']; ?>">Filter By: </label>
                                <div class="dropdown">
                                    <?php
                                        echo '<select id="insightsDropdown" name="' . $cat['key'] . '">';
                                        foreach ($cat['choices'] as $k => $v) {
                                            if ($v == $_POST['field_62422e313f55b']) {
                                                echo '<option selected name="group" value="' . $v . '">' . $v . '</option>';
                                                continue;
                                            }
                                            echo '<option name="group" value="' . $v . '">' . $v . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--End Filter Button-->
                    <?php

                    } else {
                        echo '<div><div class="specific-insights-query"><p class="h2">' . $label . ' Insights</p><hr class="small-divider"/></div>';
                        echo '';
                        echo '<div id="no-insights-queried"></div></div>';
                    }
                    ?>

                    <div id="<?php echo strtolower(str_replace(' ', '-', $label)); ?>-filter"
                        class="insights-grouped-slideshow insights-grid insights">
                        <?php

                        // WHITEPAPER LOOP
                        
                        $loop = new WP_Query($white_paper_posts);

                        if ($loop->have_posts()) :

                            echo '<div class="insights-whitepapers ins-sec">';
                            ?>
                        <div class="insights-header">
                            <div>
                                <img src="/wp-content/uploads/2023/02/whitepaper-icon.png" alt="" width="100%"
                                    class="alignleft size-full img-portrait">
                            </div>
                            <div>
                                <p class="h1 single-insights-title">Whitepapers</p>
                                <hr />
                            </div>
                        </div>


                        <?php
                                echo '<div class="insights-blocks-container wp-insights">';
                                ?>
                        <?php

                                while ($loop->have_posts()) : $loop->the_post();

                                    $title = get_the_title();
                                    $taxonomy = 'groups';
                                    $terms = get_the_terms($post->ID, $taxonomy);
                                    $post_id = get_queried_object_id();
                                    $tags = wp_get_post_tags($post->ID);

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
                                    $trimmed = wp_trim_words($excerpt, 20, null);
                                ?>
                        <div <?php echo addClasses($terms); ?>>


                            <div class="insights-blocks" <?php echo separateTerms(' ', '-', $terms); ?>>
                                <div class="card-top">
                                    <div class="insight-img">
                                        <p class="mb-0 badge associate">
                                            <span>
                                                <?php echo $parent; ?>
                                            </span>
                                        </p>
                                        <div class="wp-img"
                                            style="background-image:url('/wp-content/uploads/2023/02/ehr-migration-journal-background-imagery-tube-1.jpg');">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-middle">
                                    <div class="card-content">
                                        <p class="h3 title"> <?php echo $title; ?></p>
                                        <p class="ins-desc"><?php echo $excerpt; ?></p>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <hr />
                                    <?php
									foreach ($tags as $tag) {
										$tag_link = get_tag_link($tag->term_id);
										if ($tag_link) {
											echo '<a href="' . $url . '" target="_blank" class="btn">READ ' . $tag->name . '</a>';
										}
									}
									?>
                                </div>
                            </div>
                        </div>

                        <?php

                                endwhile;
                                echo '</div></div>';
                            else :
                                _e('<p style="margin-top:8px;font-style:italic;">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                            endif;
                            wp_reset_postdata();



						// CASE STUDY LOOP
                        $loop = new WP_Query($case_study_posts);


                        if ($loop->have_posts()) :
                            echo '<div class="insights-case-studies ins-sec">';

                            echo '<div class="insights-header">';
                            echo '<div class="ins-img"><img src="/wp-content/uploads/2023/02/case-study-icon.png" alt="" width="100%" class="alignleft size-full img-portrait" ></div>';
                            echo '<div><p class="h1 single-insights-title">Case Studies</p><hr/></div>';
                            echo '</div>';
                        ?>

                        <?php
                            echo '<div class="insights-blocks-container cs-insights">';
                            while ($loop->have_posts()) : $loop->the_post();

                                $title = get_the_title();
                                $taxonomy = 'groups';
                                $terms = get_the_terms($post->ID, $taxonomy);
                                $post_id = get_queried_object_id();
                                $tags = wp_get_post_tags($post->ID);

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
                                $content = get_the_content();
                            ?>

                        <div <?php echo addClasses($terms); ?>>

                            <div class="insights-blocks" <?php echo separateTerms(' ', '-', $terms); ?>>
                                <div class="card-top">
                                    <p class="badge associate">
                                        <span><?php echo $parent; ?></span>
                                    </p>
                                    <p class="h3 title"> <?php echo $title; ?></p>
                                    <?php if (has_excerpt()) { ?>
                                    <p class="ins-desc"><?php echo $excerpt; ?></p>
                                    <?php
                                            }
                                            ?>
                                </div>
                                <div class="card-middle">
                                    <div class="card-content">
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <hr />
                                    <?php
                                            foreach ($tags as $tag) {
                                                $tag_link = get_tag_link($tag->term_id);
                                                if ($tag_link) {
                                                    echo '<a href="' . $url . '" target="_blank" class="btn">READ ' . $tag->name . '</a>';
                                                }
                                            }
                                            ?>
                                </div>
                            </div>
                        </div>
                        <?php

                            endwhile;
                            echo '</div></div>';
                        else :
                            _e('<p style="margin-top:8px;font-style:italic;">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                        endif;
                        wp_reset_postdata();

                            //
                            // SALES SHEETS 
                            //

                            $loop = new WP_Query($sales_sheet_posts);


                            if ($loop->have_posts()) :

                                echo '<div class="insights-sales-sheets ins-sec">';
                                ?>
                        <div class="insights-header">
                            <img src="/wp-content/uploads/2023/02/sales-sheet-icon.png" alt="" width="100%"
                                class="alignleft size-full img-portrait">

                            <?php
                                    echo '<div><p class="h1 single-insights-title">Sales Sheets</p><hr/></div>';
                                    echo '</div>';
                                    ?>
                            <?php
                                    echo '<div class="insights-blocks-container ss-insights">';

                                    while ($loop->have_posts()) : $loop->the_post();

                                        $title = get_the_title();
                                        $taxonomy = 'groups';
                                        $terms = get_the_terms($post->ID, $taxonomy);
                                        $tags = wp_get_post_tags($post->ID);

                                        $post_id = get_queried_object_id();

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
                                    ?>
                            <div <?php echo addClasses($terms); ?>>
                                <div class="insights-blocks" <?php echo separateTerms(' ', '-', $terms); ?>>
                                    <div class="card-top">
                                        <p class="mb-0 badge associate">
                                            <span class="">
                                                <?php echo $parent; ?>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="card-middle">
                                        <div class="card-content">
                                            <p class="h3 title"> <?php echo $title; ?></p>
                                            <p class="a-holder"></p>
                                        </div>
                                    </div>
                                    <div class="card-bottom">
                                        <hr />
                                        <?php
										foreach ($tags as $tag) {
											$tag_link = get_tag_link($tag->term_id);
											if ($tag_link) {
												echo '<a href="' . $url . '" target="_blank" class="btn">READ ' . $tag->name . '</a>';
											}
										}
                                            ?>
                                    </div>
                                </div>
                            </div>

                            <?php

                                    endwhile;
                                    echo '</div></div>';
                                else :
                                    _e('<p style="margin-top:8px;font-style:italic;">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                                endif;

                                wp_reset_postdata();
							
							
                                //
                                // BROCHURES
                                //

                                $loop = new WP_Query($brochure_posts);

                                echo '<div class="insights-brochures ins-sec">';
                                ?>
                            <div class="insights-header">
                                <img src="/wp-content/uploads/2023/02/brochure-icon.png" alt="" width="100%"
                                    class="alignleft size-full img-portrait">

                                <?php
                                    echo '<div><p class="h1 single-insights-title">Brochures</p><hr/></div>';
                                    echo '</div>';
                                    ?>

                                <?php
                                    if ($loop->have_posts()) :

                                        echo '<div class="insights-blocks-container brochure-insights">';

                                        while ($loop->have_posts()) : $loop->the_post();

                                            $title = get_the_title();
                                            $taxonomy = 'groups';
                                            $terms = get_the_terms($post->ID, $taxonomy);
                                            $tags = wp_get_post_tags($post->ID);

                                            $post_id = get_queried_object_id();
                                            $brochure_img = get_the_post_thumbnail_url(get_the_ID(), 'large');

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
                                    ?>
                                <div <?php echo addClasses($terms); ?>>
                                    <div class="insights-blocks" <?php echo separateTerms(' ', '-', $terms); ?>>
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
                                        <div class="card-middle">
                                            <div class="card-content">
                                                <p class="h3 title"> <?php echo $title; ?></p>
                                                <p class="ins-desc"><?php echo $excerpt; ?></p>
                                                <p class="a-holder"></p>
                                            </div>
                                        </div>
                                        <div class="card-bottom">
                                            <hr />
                                            <?php
											foreach ($tags as $tag) {
												$tag_link = get_tag_link($tag->term_id);
												if ($tag_link) {
													echo '<a href="' . $url . '" target="_blank" class="btn">READ ' . $tag->name . '</a>';
												}
                                                        }
                                                        ?>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                        endwhile;
                                        echo '</div>';
                                    else :
                                        _e('<p style="margin-top:8px;font-style:italic;">Sorry, no insights were found for this category.</p>', 'keena-wordpress');
                                    endif;
                                    echo '</div>';

                                    wp_reset_postdata();

                                    ?>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div>
            </div>
            <?php binarym_block_ornament(); ?>
        </div>