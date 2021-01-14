</main>

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
<!-- 01101101 -->
</body>
</html>
