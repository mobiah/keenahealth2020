<div <?php binarym_bg_builder(); ?>>
	<div class="container">
    <?php
			binarym_before_content_block();
		?>
		<div class="row justify-content-<?php the_sub_field('block_alignment'); ?>">
			<div class="col-md-<?php the_sub_field( 'content_width' ); ?>">
               	
<?php
					$cat = get_sub_field( 'publications' );
					if ($cat == 'advisory services') :
                        
                        if ( is_active_sidebar( 'sidebar_widget_area_3' ) ) :
                            dynamic_sidebar( 'sidebar_widget_area_3' );
                        endif;
                    endif;

                        if ($cat == 'conversion and archival'):
                            if ( is_active_sidebar( 'sidebar_widget_area_4' ) ) :
                                dynamic_sidebar( 'sidebar_widget_area_4' );
                            endif;
                        endif;

                        if ($cat == 'data analytics and management'):
                            if ( is_active_sidebar( 'sidebar_widget_area_5' ) ) :
                                dynamic_sidebar( 'sidebar_widget_area_5' );
                            endif;
                        endif;

                        if ($cat == 'interfaces and interoperability'):
                            if ( is_active_sidebar( 'sidebar_widget_area_6' ) ) :
                                dynamic_sidebar( 'sidebar_widget_area_6' );
                            endif;
                        endif;

                        if ($cat == 'patient engagement'):
                            if ( is_active_sidebar( 'sidebar_widget_area_7' ) ) :
                                dynamic_sidebar( 'sidebar_widget_area_7' );
                            endif;
                        endif;

                        if ($cat == 'population health'):
                            if ( is_active_sidebar( 'sidebar_widget_area_8' ) ) :
                                dynamic_sidebar( 'sidebar_widget_area_8' );
                            endif;
                        endif;

                        if ($cat == 'system and business automation'):
                            if ( is_active_sidebar( 'sidebar_widget_area_9' ) ) :
                                dynamic_sidebar( 'sidebar_widget_area_9' );
                            endif;
                        endif;

                        if ($cat == 'workflow efficiency') :
                            if ( is_active_sidebar( 'sidebar_widget_area_10' ) ) :
                                dynamic_sidebar( 'sidebar_widget_area_10' );
                            endif;
                        endif;
?>                        
				</div><!-- .row -->
			</div>
		</div>
	<?php binarym_block_ornament(); ?>
</div>
