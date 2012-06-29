<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php wpzoom_titles(); ?></title>

<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php the_excerpt_rss(); ?>" />
<?php meta_post_keywords(); ?>
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php if (strlen($wpzoom_meta_desc) < 1) { bloginfo('description');} else {echo"$wpzoom_meta_desc";}?>" />
<?php meta_home_keywords(); ?>
<?php endif; ?>
<?php wpzoom_index(); ?>
<?php wpzoom_canonical(); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php wpzoom_rss(); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/dropdown.css" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie6.css" /><![endif]-->
<!--[if IE 7 ]><link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie7.css" /><![endif]-->
<?php if (strlen($wpzoom_misc_favicon) > 1 ) { ?><link rel="shortcut icon" href="<?php echo "$wpzoom_misc_favicon";?>" type="image/x-icon" /><?php } ?> 
<?php if ($wpzoom_sidebar == 'Left') { ?><style type="text/css">#sidebar { float:left; margin-right:10px;} </style> <?php } ?>
 
<?php remove_action('wp_print_styles', 'pagenavi_stylesheets'); ?>
<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>	
<?php wp_head(); ?>
<?php wpzoom_js("jquery.tools.min", "jcarousel",  "script", "dropdown", "tabber-minimized" ); ?>

</head>

<body>
<a name="top"></a>
 
	<div id="page-wrap">

		<div id="header">
			<div id="topbar" class="dropdown">
				<div class="rounded">
					 
					<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => 'topmenu', 'sort_column' => 'menu_order', 'theme_location' => 'secondary' ) ); ?>
 					
					<div class="user-bar">
						<?php if (!is_user_logged_in()) { ?><a href="#" class="login-link"><?php _e('Log in', 'wpzoom') ?></a> <?php if (get_option('users_can_register')) { ?>or <a href="<?php bloginfo('url') ?>/wp-login.php?action=register"><?php _e('Register', 'wpzoom') ?></a> <?php } ?>
					</div>
						
					<div class="login-form">
 						<div class="close"><a href="#"><?php _e('Close', 'wpzoom') ?></a></div>
						<form action="<?php bloginfo('url') ?>/wp-login.php" method="post">
							<fieldset>
								<div class="inputs">
									<div class="input">
 										<input type="text" name="log" id="log" onblur="if (this.value == '') {this.value = '<?php _e('Username', 'wpzoom') ?>';}" onfocus="if (this.value == '<?php _e('Username', 'wpzoom') ?>') {this.value = '';}"   value="<?php _e('Username', 'wpzoom') ?>"   />
									</div>
									<div class="input">
 										<input type="password" name="pwd" id="pwd"  onblur="if (this.value == '') {this.value = '<?php _e('Password', 'wpzoom') ?>';}" onfocus="if (this.value == '<?php _e('Password', 'wpzoom') ?>') {this.value = '';}" value="<?php _e('Password', 'wpzoom') ?>" />
									</div>
								</div>
								<div class="button">
									<input type="submit" name="submit" value="Log in" />
									<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
								</div>
								<div class="remember">
									<input name="rememberme" id="rememberme" class="rememberme" type="checkbox" checked="checked" value="forever" />
									<label for="rememberme"> <?php _e('Remember me', 'wpzoom') ?></label>
									
								</div>
								<div class="lost"><a href="<?php bloginfo('url') ?>/wp-login.php?action=lostpassword"><?php _e('Lost your password?', 'wpzoom') ?></a></div>
							</fieldset>
						</form>
					</div>
					
					<?php } else { ?>
 
					<a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>"><?php _e('Log out', 'wpzoom') ?></a>
					<a href="<?php bloginfo('url') ?>/wp-admin/"><?php _e('Dashboard', 'wpzoom') ?></a>
					</div>
					<?php }?>
						
					 
					<div class="clear"></div>
				</div> <!-- /.rounded -->
			
			</div><!-- /top-bar -->
			
			
			<div class="logo">
				<a href="<?php echo get_option('home'); ?>/">
					<?php if (strlen($wpzoom_misc_logo_path) > 1) { ?>
						<img src="<?php echo "$wpzoom_misc_logo_path";?>" alt="<?php bloginfo('name'); ?>" />
					<?php } else { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /><?php } ?>
				</a>
 				<?php if ($wpzoom_desc == 'Yes') {  ?><span>— <?php bloginfo('description'); ?></span>
				<?php } ?>
			</div>
			
			<div class="adv">
				<?php if (strlen($wpzoom_ad_head_imgpath) > 1 && $wpzoom_ad_head_select == 'Yes') {?>
					 <?php if (strlen($wpzoom_ad_head_imgpath) > 1) { echo stripslashes($wpzoom_ad_head_imgpath); }?> 
				<?php } ?>
			</div>
			
		
			<!-- Main Menu -->
			<div id="menu" class="dropdown">
				<div class="rounded">
					<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => 'mainmenu', 'sort_column' => 'menu_order', 'theme_location' => 'primary' ) ); ?>
					<div class="rss"><?php _e('Subscribe via', 'wpzoom') ?> <a href="<?php wpzoom_rss(); ?>"><?php _e('RSS Feed', 'wpzoom') ?></a></div>
						
					<div class="clear"></div>
					
					<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'depth' => '1', 'menu_class' => 'tagsmenu', 'sort_column' => 'menu_order', 'theme_location' => 'tertiary' ) ); ?>
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				
				</div>
			</div><!-- /menu -->

 		</div><!-- /header -->
 