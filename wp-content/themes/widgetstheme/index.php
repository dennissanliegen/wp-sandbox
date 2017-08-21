<?php /*

@package widgets-sandbox

*/
get_header();?>

<div class="page__content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php endwhile;  ?>
<?php endif; ?>
</div>

<?php get_footer(); ?>
