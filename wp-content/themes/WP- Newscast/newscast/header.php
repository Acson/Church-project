<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php global $k_option, $query_string; $k_option['custom']['real_query'] = $query_string; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">


<!-- basic meta tags -->
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php

   if (function_exists('khelper_follow_nofollow')) khelper_follow_nofollow();
// outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
// located in framework/helper_functions/lots_of_small_helpers.php

?>



<!-- title -->
<title><?php if (is_home()) { bloginfo('name'); ?><?php } elseif (is_category() || is_page() ||is_single()) { ?> <?php } ?><?php wp_title(''); ?></title>


<!-- feeds and pingback -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<!-- stylesheets -->
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php $skin = $k_option['general']['skin'] != '' ?  $k_option['general']['skin'] : 1; ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style<?php echo $skin; ?>.css" type="text/css" media="screen"/>


<!-- scripts -->

<!-- Internet Explorer 6 PNG Transparency Fix for all elements with class 'ie6fix' -->	
<!--[if IE 6]>
<script type='text/javascript' src='<?php echo get_bloginfo('template_url'); ?>/js/dd_belated_png.js'></script>
<script>DD_belatedPNG.fix('.ie6fix');</script>
<style>#footer ul li a, .sidebar ul li a {zoom:1;} #head #searchform, #head #searchform div {position:static;}
</style>
<![endif]-->

<?php 
######################################################################
# PHP scripts
######################################################################
// single post comment reply script by wordpress
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );


//wp-head hook, needed for plugins, do not delte
wp_head();

?>

<!-- meta tags, needed for javascript -->
<meta name="autorotate" content="<?php echo $k_option['mainpage']['slide_autorotate'];?>" />
<meta name="autorotateDelay" content="<?php echo $k_option['mainpage']['slide_duration']; ?>" />
<meta name="autorotateSpeed" content="<?php echo $k_option['mainpage']['slide_transition']; ?>" />
<meta name="temp_url" content="<?php echo get_bloginfo('template_url'); ?>" />


</head>

<?php 
######################################################################
# check for custom logo
######################################################################
if (isset($k_option['general']['logo']) && $k_option['general']['logo'] != '')
{
	$logo = '<img class="ie6fix" src="'.$k_option['general']['logo'] .'" alt="'.get_settings('home').'" />';
	$logoclass = '';
}
else // default logo
{
	$logo = get_bloginfo('name');
	$logoclass = 'logobg';
}

######################################################################
# check which page and apply classes to body
######################################################################
$k_body_class ='';

if (isset($k_option['custom']['bodyclass'])) $k_body_class = $k_option['custom']['bodyclass'];

?>

<body id='top' <?php body_class($k_body_class);?> >

	<div id='headwrap'>
		<!-- ###################################################################### -->
		<div id="head">
		<!-- ###################################################################### -->
		
			<h2 class="logo ie6fix <?php echo $logoclass; ?>"><a href="<?php echo get_settings('home'); ?>/"><?php echo $logo; ?></a></h2>
			
			
			<div class="nav_wrapper">
			<!-- Navigation for Pages starts here -->
			<?php 
				if(is_object($k_option['custom']['kriesi_menu_pages'])) 
				$k_option['custom']['kriesi_menu_pages']->display('Menu Manager Pages','show_basic');
			?>
			</div><!-- end nav_wrapper --> 
			
			
			<div class="catnav_wrapper">
			<!-- Navigation for Categories starts here -->
			<?php 
			if(is_object($k_option['custom']['kriesi_menu_cats'])) 
			$k_option['custom']['kriesi_menu_cats']->display('Menu Manager Categories','show_main_description'); 
			?>
			<!-- end catnav_wrapper: -->
			</div>
			
			
			<div id="headextras" class='rounded'>
			
				<?php get_search_form(); ?>
				
				<ul class="social_bookmarks">
					<?php if(isset($k_option['general']['contact_link']) && $k_option['general']['contact_link'] != '')
						{
							$contact_link = get_page_link($k_option['general']['contact_link']);
					  		echo "<li class='email'><a class='ie6fix' href='".$contact_link."'>E-mail</a></li>	";
						}
					?>
					<li class='rss'><a class='ie6fix' href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
					
					<?php if(isset($k_option['general']['acc_tw']) && $k_option['general']['acc_tw'] != '')
						  echo "<li class='twitter'><a class='ie6fix' href='http://twitter.com/".$k_option['general']['acc_tw']."'>Twitter</a></li>";
					?>
					
					
					<!-- there is room for 3 icons, below are predefined classes for others if you want to use them instead -->
					<!--
					<li class='flickr'><a class='ie6fix' href="#">flickr</a></li>
					<li class='facebook'><a class='ie6fix' href="#">Facebook</a></li>
					-->
					
				</ul><!-- end social_bookmarks-->
			
			<!-- end headextras: --> 
			</div>
			
			<?php 
			// submit news button
			if($k_option['contact']['membernews'] != 2) { 
				if(($k_option['contact']['membernews_who'] != 2 && current_user_can('level_0')) ||  $k_option['contact']['membernews_who'] == 2)
				{
			?>
					<a id='submit_news' rel="prettyPhoto" class='ie6fix' href="<?php echo get_bloginfo('template_url'); ?>/submit_news.php?iframe=true&amp;width=420&amp;height=580"><?php _e($k_option['contact']['submit_news_text'],'newscast'); ?></a>
			<?php 
				}
			} ?>
			
			
		<!-- ###################################################################### -->	
		</div><!-- end head -->
		<!-- ###################################################################### -->
		
	<!-- ###################################################################### -->	
	</div><!-- end headwrap -->
	<!-- ###################################################################### -->
		
		

	<!-- ###################################################################### -->
	<div id="contentwrap">
	<!-- ###################################################################### -->
        
