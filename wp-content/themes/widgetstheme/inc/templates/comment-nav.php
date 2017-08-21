<nav class="comment__navigation" role="navigation">
	<h3><?php esc_html_e('Kommentar Navigation', 'widgetstheme'); ?></h3>
	<div class="grid">
		<div class="col"><?php previous_comments_link(esc_html__('Prev Comments', 'widgetstheme')); ?></div>
		<div class="col"><?php next_comments_link(esc_html__('Next Comments', 'widgetstheme')); ?></div>
	</div>
</nav>