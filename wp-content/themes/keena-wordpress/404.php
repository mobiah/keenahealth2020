<?php

	get_header();

	$fourohfour_title = get_option('options_404_page_title');
	$fourohfour_content = get_option('options_404_page_content');

?>

	<div class="container">
		<div class="row">
			<div class="col-12 py-5">
				<h1 class="page-title"><?php echo $fourohfour_title; ?></h1>
				<div class="page-body">
					<?php echo wpautop( $fourohfour_content ); ?>
				</div>
			</div>
		</div>
	</div>

<?php
	get_footer();
