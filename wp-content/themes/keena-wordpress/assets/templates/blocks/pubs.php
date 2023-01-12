<div <?php binarym_bg_builder(); ?>>
    <div class="container">
        <?php binarym_before_content_block(); ?>
        <div class="row justify-content-<?php the_sub_field('block_alignment'); ?>" id="published-insights">
            <div class="col-md-<?php the_sub_field( 'content_width' ); ?>">

                <?php
                $page_url = get_permalink();
                
                // Get and store our category in a variable
                $cat = get_sub_field_object('publications');
                $choices = $cat['choices'];
                $value = $cat['value'];
                $label = $cat['choices'][ $value ];
                $filter = get_sub_field('filter');
                $format = get_sub_field('format');
                $is_slideshow = 'false';
                $slideshow = 'grid';

                if ($format === 'Slideshow') {
                    $filter = 'Hide';
                    $is_slideshow = 'true';
                    $slideshow = 'slideshow';
                } 

                function separateTerms($replace, $replace_with, $input) {
                    $count = 0;
                    if (!empty($input)) {
                        foreach ($input as $term) {
                            echo 'data-category-' . $count . '="' . str_replace($replace, $replace_with, $term->name) . '" ';
                            $count++;
                        }
                    }
                }

                function separateUnderscore($replace, $replace_with, $input) {
                    return strtoupper(str_replace($replace, $replace_with, $input));
                }
                ?>

                <!--Filter Button-->
                <form action="<?php echo $page_url . '#published-insights';?>" method="post"
                    id="filter-<?php echo strtolower($filter);?>">
                    <div>
                        <div id="solutionsFilter" class="mb-4">
                            <div>
                                <div>
                                    <p class="mr-3 mb-0">Filter By:</p>
                                </div>
                                <div class="dropdown">
                                    <?php 
                                    echo '<select id="insightsDropdown" name="' . $cat['key'] . '">';
                                    
                                    foreach( $cat['choices'] as $k => $v )
                                    {
                                        if ($v == $_POST['field_62422e313f55b']) {
                                            echo '<option selected name="group" value="' . $v . '">' . $v . '</option>';
                                            continue;
                                        }
                                        echo '<option name="group" value="' . $v . '">' . $v . '</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </div>
                                <div>
                                    <p id="clearSolutionsFilter" class="mb-0" style="color:#e43a20;opacity:0;">clear</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <div id="no-insights">
                    <p></p>
                </div>

                <div
                    class="insights-blocks-container insights-grouped-<?php echo $slideshow;?> insights-grid slick-<?php echo $is_slideshow;?>">
                    <?php
                
                 // Query ALL insights posts
                $all_insights = array(  
                    'post_type' => 'insights',
                    'post_status' => 'publish',
                    'posts_per_page' => -1, 
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'meta_key' => 'insight_badge_parent'
                );

                // Query SPECIFIC insights posts
                $group_insights = array(  
                    'post_type' => 'insights',
                    'post_status' => 'publish',
                    'posts_per_page' => -1, 
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'groups' => $label . ' Insights'
                );

                if ($label == 'Solution Types' || $filter == 'Show') {
                    $loop = new WP_Query( $all_insights );
                } else {
                    $loop = new WP_Query( $group_insights );
                }

                if ( $loop->have_posts() ) :
                while ( $loop->have_posts() ) : $loop->the_post();
                
                $title = get_the_title();
                $taxonomy = 'groups';
                $terms = get_the_terms( $post->ID , $taxonomy );
                $post_id = get_queried_object_id();


                if( have_rows('insight') ):
                    while( have_rows('insight') ): the_row(); 
                        // Get sub field values.
                        $type = get_sub_field('type');
                        $parent = get_sub_field('badge_parent');
                        $link = get_sub_field('link');

                        // run these through function above to remove underscores and update the value 
                        $type = separateUnderscore('_', ' ', $type);
                        $parent = separateUnderscore('_', ' ', $parent);
                        

                         // Set the images for each type
                         if ($type == 'CASE STUDY') {
                            $image = '/wp-content/uploads/2021/09/Asset-2.png';
                        } elseif ($type == 'WHITE PAPER') {
                            $image = '/wp-content/uploads/2021/09/Asset-8.png';
                        } elseif ($type == 'SALES SHEET') {
                            $image = '/wp-content/uploads/2021/09/Asset-6-1.png';
                        } else {
                            $image = '/wp-content/uploads/2021/09/Asset-6-1.png';
                        }
                        
                      endwhile; 
                endif; 
                ?>

                    <?php if (empty($link)) {
                        continue;
                        }
                        
                        $excerpt = get_the_excerpt();
                        $trimmed = wp_trim_words($excerpt, 20, null);
                                ?>
                    <div>
                        <div class="insights-blocks insights-case-study" <?php echo separateTerms(' ', '-', $terms);?>>
                            <p class="mb-0">
                                <span class="badge green">
                                    <?php echo $type;?>
                                </span>
                                <span class="badge associate">
                                    <?php echo $parent;?>
                                </span>
                            </p>
                            <hr style="border-top-color:#95b8ac;">
                            <div class="card-sections">
                                <div class="card-img">
                                    <img src="<?php echo $image;?>" alt="" width="77" height="80"
                                        class="alignleft size-full wp-image-1352 img-portrait" style="width:auto;">
                                </div>
                                <div class="card-content">
                                    <p class="h3"> <?php echo $title;?></p>
                                    <p class="ins-desc"><?php echo $trimmed;?></p>
                                    <p class="a-holder"></p>
                                    <a href="<?php echo $link;?>" target="_blank" class="btn">READ
                                        <?php echo $type;?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

                    endwhile;
                    else :
                        _e( 'Sorry, no insights were found for this category.', 'keena-wordpress' );
                    endif;
                    wp_reset_postdata(); 

                    ?>
                </div>
            </div><!-- .row -->
        </div>
    </div>
    <?php binarym_block_ornament(); ?>
</div>