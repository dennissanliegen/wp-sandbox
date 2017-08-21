<?php

/*

@package dojotheme

  =====================================
    Theme Support Options
  =====================================
*/

add_theme_support('post-thumbnails');

/* Nav Menu Options */ 
function starter_register_nav_menu(){
	register_nav_menu( 'primary', 'Navigation Menu' );
}
add_action( 'after_setup_theme', 'starter_register_nav_menu' );

/* Activate HTML5 FEATURES */ 
add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form') );

/*
  =====================================
    General Options Page
  =====================================
*/
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'Widgets',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

  acf_add_options_sub_page(array(
		'page_title' 	=> 'Admin Dont Touch',
		'menu_title'	=> 'Admin',
		'parent_slug'	=> 'theme-general-settings',
	));
}

/*
  =====================================
    Allow SVG Media Uploader
  =====================================
*/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/*
  =====================================
    Single Post CUSTOM FUNCTIONS
  =====================================
*/

function tazBlog_get_comment_navigation(){
  // if( get_comment_pages_count() > 1 && get_option('page_comments') ):
  require( get_template_directory(). '/inc/templates/comment-nav.php' );
  // endif;
}