<?php /*

@package widgets-sandbox

*/
get_header();?>

<div class="single__content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
	<!-- Comments -->
	<?php if( comments_open() ):
		comments_template();
	endif; ?>
<?php endwhile;  ?>
<?php endif; ?>
</div>

<?php get_footer(); ?>
