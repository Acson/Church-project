<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php 
	global $avia_config;

	/*
	 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
	 * located in framework/php/function-set-avia-frontend.php
	 */
	 if (function_exists('avia_set_follow')) { echo avia_set_follow(); }
	 
?>


<!-- page title, displayed in your browser bar -->
<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>


<!-- add feeds, pingback and stuff-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> RSS2 Feed" href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- add css stylesheets -->	
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/projekktor/theme/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/<?php avia_option('stylesheet', 'light-skin.css'); ?>" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/slideshow.css" type="text/css" media="screen"/>


<?php

	/* add javascript */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'avia-default' );
	wp_enqueue_script( 'avia-prettyPhoto' );
	wp_enqueue_script( 'avia-html5-video' );
	wp_enqueue_script( 'avia-fade-slider' );


	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
	
?>

<!-- plugin and theme output with wp_head() -->
<?php 

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	 
	wp_head();
?>

<!-- custom.css file: use this file to add your own styles and overwrite the theme defaults -->
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css" type="text/css" media="screen"/>
<!--[if lt IE 8]>
<style type='text/css'> .one_fourth	{ width:21.5%;} </style>
<![endif]-->

</head>



<body id="top" <?php body_class(avia_get_option('boxed'). " ".avia_get_browser()); ?>>
	<div id='wrap_all'>
	
		<!-- ####### HEAD CONTAINER ####### -->
			<div class='container_wrap' id='header'>
			
				<div class='submenu'>
				
					<div class='container'>
						<?php
						/*
						*	display the main navigation menu
						*   modify the output in your wordpress admin backend at appearance->menus
						*/
						$args = array('theme_location'=>'avia2', 'fallback_cb' => '', 'max_columns'=>4);
						wp_nav_menu($args); 
						?>
					
					
						<ul class="social_bookmarks">
							<li class='rss'><a href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>"><?php _e('Subscribe to our RSS Feed', 'avia_framework')?></a></li>
							<?php 
							if($twitter = avia_get_option('twitter')) echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>".__('Follow us on Twitter', 'avia_framework')."</a></li>";
							if($facebook = avia_get_option('facebook')) echo "<li class='facebook'><a href='".$facebook."'>".__('Join our Facebook Group', 'avia_framework')."</a></li>";
							 ?>
								
						</ul>
						<!-- end social_bookmarks-->
						<div class='ribbon'></div>
					</div>
					
				</div>
				
				<div class='container'>
					
					<?php  
					/*
					*	display the theme logo by checking if the default css defined logo was overwritten in the backend.
					*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
					*/
					echo avia_logo();
					
					
					// shows a partner image
					if($advertising = avia_get_option('head_advertising', false, false, true))
					{	
						$extraClass = "";
						if(strpos($advertising, '<img') === false && strpos($advertising, '<script') === false) $extraClass = 'paim_framed';
						echo "<div class='paim ".$extraClass."'>".$advertising."</div>";
					}
					?>
				
				
				</div>
				
				<div class='main_menu'>
				
					<div class='container'>
					
						<?php
						/*
						*	display the main navigation menu
						*   modify the output in your wordpress admin backend at appearance->menus
						*/
						$args = array('theme_location'=>'avia', 'fallback_cb' => 'avia_fallback_menu', 'max_columns'=>4);
						wp_nav_menu($args); 
						?> 
						
						
					<span class='search_site'>
							<?php 
							/*
							*	display the theme search form
							*   the tempalte file that is called is searchform.php in case you want to edit it
							*/
							get_search_form(); 
							?>
						
						</span>	
					</div>
					<!-- end container-->
					
				</div>
				
				
				
				
			</div>
			<!-- end container_wrap_header -->
			
			<!-- ####### END HEAD CONTAINER ####### -->
			
			

			