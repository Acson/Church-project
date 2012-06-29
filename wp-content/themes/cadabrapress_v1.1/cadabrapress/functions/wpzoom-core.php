<?php
 /* Register Sidebars  */
 

register_sidebar( array(
	'name' => 'Sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="padder">'
) );

register_sidebar( array(
	'name' => 'Footer Widgets',
	'description' => 'Do not place here following widgets: WPZOOM: Social Widget, WPZOOM: Tabbed Widget',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
) );


/* Custom Menu (WP 3.0+) */
if (function_exists('register_nav_menus')) {
register_nav_menus( array(
 		'secondary' => __( 'Top Menu', 'wpzoom' ),
 		'primary' => __( 'Main Menu', 'wpzoom' ),
		'tertiary' => __( 'Tags Menu (under Main Menu)', 'wpzoom' ),
 	) );
}

/* Post Thumbnail (WP 2.9+) */
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 9999, 9999, true ); // Normal post thumbnails, set to maximum size, then will be cropped with TimThumb script
}

 
 
/* Custom Background (WP 3.0+) */   
if (function_exists('add_custom_background')) {
	add_custom_background();
}


/* Enabling Localization */

load_theme_textdomain( 'wpzoom', TEMPLATEPATH.'/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);



/* Reset default WP styling for [gallery] shortcode */   
add_filter('gallery_style', create_function('$a', 'return "
<div class=\'gallery\'>";'));

if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '');
    wp_enqueue_script('jquery');
}

 
function excerpt_tabs() {
    return (int) get_option("wpzoom_excerpt_tabs") ? (int) get_option("wpzoom_excerpt_tabs") : 15;
}

function excerpt_feat() {
    return (int) get_option("wpzoom_excerpt_feat") ? (int) get_option("wpzoom_excerpt_feat") : 30;
}

/* Custom lenght for the_excerpt */ 
function new_excerpt_length($length) {
	return (int) get_option("wpzoom_excerpt") ? (int) get_option("wpzoom_excerpt") : 40;
}
add_filter('excerpt_length', 'new_excerpt_length');


/* Getting rid off annoying [...] from excerpt's end. */ 
function trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'trim_excerpt');


/* This allows to display only exact count of comments, without trackbacks */ 
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($get_comments);
 		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
add_filter('get_comments_number', 'comment_count', 0);

 
/* This will enable to insert [shortcodes] inside Text Widgets*/
add_filter('widget_text', 'do_shortcode');

 

/* Function that redirects you to WPZOOM Options Panel when theme is activated */    
if (is_admin() && $_GET['activated'] == 'true') {
    header("Location: admin.php?page=wpzoom_options");
}


/* WPZOOM Options Panel */
if (is_admin() && $_GET['page'] == 'wpzoom_options') {
    add_action('admin_head', 'wpzoom_admin_css');
    wp_enqueue_script('tabs', get_bloginfo('template_directory').'/wpzoom_admin/simpletabs.js');
}


$functions_path = TEMPLATEPATH . '/wpzoom_admin/';
require_once ($functions_path . 'admin_functions.php');
$homepath = get_bloginfo('stylesheet_directory');

add_action('admin_menu', 'wpzoom_add_admin');

function wpzoom_admin_css() {
    echo '
    <link rel="stylesheet" type="text/css" media="screen" href="'.get_bloginfo('template_directory').'/wpzoom_admin/options.css" />
    ';
}

?>