</main>
<hr style="border-top:1px solid #95b8ac;margin-top:0;">
<footer class="site-footer">
    <!-- <div class="footer-widgets"> -->
    <div class="container">
        <div class="row">
            <div class="footer-nav">
                <?php binarym_display_nav_menu( $theme_location = 'footer-nav', $navbar_nav = false ); ?>
            </div>

            <div class="footer-widgets">
                <?php
						if ( is_active_sidebar( 'footer_widget_area_1' ) ) :
							dynamic_sidebar( 'footer_widget_area_1' );
						endif;
					?>
            </div>
        </div>
    </div>
    <!-- </div> -->
</footer>

<?php wp_footer(); ?>

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/25153478.js"></script>
<script type="text/javascript">
var link_tonew_tab = $('#navbarNav').children().children()[4];
$(link_tonew_tab).click(function(e) {
    e.preventDefault();
    var new_link = $(this).children().attr('href');
    window.open(new_link, '_blank');
});
</script>
<!-- End of HubSpot Embed Code -->
<!-- 01101101 -->
</body>

</html>