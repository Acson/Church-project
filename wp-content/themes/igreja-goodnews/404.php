<!DOCTYPE html>

<html>
<head>
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
<link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'> 
<!-- Custom favicon -->
<?php if ( of_get_option('custom_favicon') != 'false') { ?>
<link rel="shortcut icon" href="<?php echo of_get_option('custom_favicon'); ?>" />
<?php } ?>

<!-- feeds, pingback -->
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (of_get_option('feedburner')!= 'false') { echo of_get_option('feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
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
</head>

<body>

<div class="page_404">
<p style="font-weight:bold;"><?php _e('404 - Page not found!', 'theme'); ?></p>
<p><?php _e("Why don't you try the", 'theme'); ?> <a href="<?php echo home_url(); ?>"><?php _e('homepage?', 'theme'); ?></a></p>
</div>


</body>
</html>
