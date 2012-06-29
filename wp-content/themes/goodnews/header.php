<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php wp_title(' - ', true, 'right'); bloginfo('name'); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
//show description
mom_show_description();
//show robots
mom_show_robots();
// Creating the canonical URL
mom_canonical_url();
//Stylesheet
mom_create_stylesheet();
?>
<?php if(of_get_option('theme_skin') == 'dark') { ?>
<link href='<?php echo MOM_CSS; ?>/dark.css' rel='stylesheet' type='text/css'>
<?php } ?>
<link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'> 
<!-- Custom favicon -->
<?php if ( of_get_option('custom_favicon') != 'false') { ?>
<link rel="shortcut icon" href="<?php echo of_get_option('custom_favicon'); ?>" />
<?php } ?>

<!-- feeds, pingback -->
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (of_get_option('feedburner')!= false) { echo of_get_option('feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

    <!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php include MOM_FW . '/option_js.php'; ?>
<?php include MOM_FW . '/option_css.php'; ?>
</head>
<body>
    <?php if ( is_page_template('fixed-home.php') ) { ?>
    <?php if ( of_get_option('fixed_bg') != false ) { ?>
    <img alt="Home" src="<?php echo of_get_option('fixed_bg');?>" id="full_bg">
    <?php } ?>
    <?php } else { ?>
<?php if(of_get_option('theme_layout') == 'fixed') { ?>
    <?php if ( of_get_option('fixed_bg') != false ) { ?>
<img alt="Home" src="<?php echo of_get_option('fixed_bg');?>" id="full_bg">
<?php } ?>
    <?php } ?>
    <?php } ?>
    <div class="fixed">
<div id="top" class="top_bar">
    <div class="inner">
     <?php if ( has_nav_menu( 'topnav' ) ) { ?>
			     <?php  wp_nav_menu ( array( 'menu_class' => 'top_nav','container'=> 'ul', 'theme_location' => 'topnav' )); ?>
			     <?php } else { ?>
			     	<ul class="top_nav">
			     	  <?php wp_list_pages(array(
					  	'title_li' => false
					  )); ?>
			     	 </ul> <!--Top Nav-->

     <?php } ?>
    
    <div class="search_box">
        <?php include TEMPLATEPATH . '/searchform.php'; ?>
    </div> <!--Search Box-->
    </div> <!--End Inner-->
</div> <!--End Topbar-->

<header id="header">
    <div class="top_line"></div>
<div class="inner">
    <div class="logo">
<a href="<?php echo home_url(); ?>">
	<?php if(of_get_option('logo_img')){ ?>
	<img src="<?php echo of_get_option('logo_img'); ?>" alt="<?php bloginfo('name'); ?>" />
	<?php } else { ?>
	<img src="<?php echo MOM_IMG; ?>/logo.png" alt="<?php bloginfo('name'); ?>" />
    <?php } ?>
</a>
    </div> <!--End Logo-->
    <?php include TEMPLATEPATH . '/banner.php'; ?>
</div> <!--Inner-->
</header> <!--End Header-->
<nav id="navigation">
    <div class="nav_wrap">
    <div class="inner">
     <?php if ( has_nav_menu( 'main' ) ) { ?>
			     <?php  wp_nav_menu ( array( 'menu_class' => 'nav','container'=> 'ul', 'theme_location' => 'main' )); ?>
			     <?php } else { ?>
			     	<ul class="nav">
                    	<li class="home"><a href="<?php echo home_url(); ?>"><?php _e('Home', 'theme'); ?></a></li>
			     	  <?php wp_list_categories(array(
					  	'title_li' => false,
						'hierarchical' => 1
					  )); ?>
			     	 </ul> <!--Top Nav-->

     <?php } ?>
    </div> <!--Inner-->
    </div> <!--End Nav Wrap-->
</nav> <!--End Navigation-->
<?php news_ticker() ?>