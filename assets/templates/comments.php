<?php
	if ( post_password_required() )
		return;
?>

<?php
	comment_form( array(
		'title_reply' => '',
		'comment_notes_before' => '',
	) );
?>

<?php if (have_comments()) : ?>
<section id="comments" class="comments py-5">
	<div class="comment-list">
		<?php
			wp_list_comments( array(
				'style' => 'div',
				'short_ping' => true,
				'avatar_size' => 50,
				'walker' => new Bootstrap_Comment_Walker()
			));
		?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
			<nav>
				<ul class="pager">
					<?php if (get_previous_comments_link()) : ?>
						<li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
					<?php endif; ?>
					<?php if (get_next_comments_link()) : ?>
						<li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
					<?php endif; ?>
				</ul>
			</nav>
		<?php endif; ?>
</section>
<?php endif; // have_comments() ?>
