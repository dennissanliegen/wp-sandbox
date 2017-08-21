<?php /*

@package widgets-sandbox

*/

if( post_password_required() ){
	return;
}
?>

<div class="comment__section">
	<?php if( have_comments() ):?>
		
		<!-- Comments TITLE -->
		<h2 class="comments__title">
			<?php
				printf(
					esc_html( _nx('Ein Kommentar zu &ldquo;%2$s&rdquo;', '%1$s Kommentare zu &ldquo;%2$s&rdquo;', 'get_comments_number()', 'comments title', 'widgetstheme') ),
					number_format_i18n( get_comments_number() ),
					'<span>'.get_the_title().'</span>'
				);
			?>	
		</h2>

		<!-- Comments Pagination Top -->
		<?php tazBlog_get_comment_navigation(); ?>

		<!-- Comments -->
		<ol class="comment__list">
			<?php
				$args = array(
					'walker'             => null,
					'max_depth' 	       => 2,
					'sytle'     	       => 'ol',
					'callback'  	       => null,
					'end-callback'       => null,
					'type'               => 'all',
					'reply_text'         => 'antworten',
					'page'               => '',
					'per_page'           => 2,
					'avatar_size'        => 64,
					'reverse_top_level'  => true,
					'reverse_childer'    => null,
					'short_pink'         => false,
					'echo'               => true,
				);
				wp_list_comments( $args );
			?>
		</ol>

		<!-- Comments Pagination Bottom -->
		<?php tazBlog_get_comment_navigation(); ?>

		<!-- If Comments are closed! -->
		<?php if( !comments_open() && get_comments_number() ): ?>
			<p class="no__comments"><?php esc_html_e('Comments are closed.', 'widgetstheme' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>
	<?php 
		$args = array(
			'class_submit' => 'comment__submit__btn',
		);
		comment_form($args);
	?>
</div>
