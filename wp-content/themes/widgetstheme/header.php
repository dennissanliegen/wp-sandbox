<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>
  <body>
	
	<header class="site-header">
		<div class="container">

			<nav id="site-navigation" class="main__navigation mega__menu navbar navbar-default navbar-megamenu" role="navigation">

				<div class="container-fluid">

						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

						<?php if( has_nav_menu('primary') ): ?>
							<?php
							  wp_nav_menu( array(
							    'theme_location'    => 'primary',
							    'menu_id'           => 'primary-menu',
							    'menu_class'        => 'nav navbar-nav navbar-right',
							    'walker'            => new walkernav(),
							  ));
							?>
						<?php endif; ?>

				</div><!-- container-fluid -->
			</nav>
		</div><!-- .container -->
	</header>