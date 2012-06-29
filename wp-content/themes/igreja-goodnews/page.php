<?php get_header(); ?>
<div class="inner">
    <div class="container">
    <div class="main">
	<?php the_breadcrumb(); ?>
    <div class="box_outer">
	<article class="cat_article">
	        <h1 class="cat_article_title page_title"><?php the_title(); ?></h1>
    <div class="single_article_content">
        <?php the_content(); ?>
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
    </div> <!--Box Outer-->
    </div> <!--End Main-->
        <aside class="sidebar">
	 <?php global $wp_query; $postid = $wp_query->post->ID; $cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);?>
	<?php if ($cus != '') { ?>
        <?php if ($cus[0] != '0') { ?>
             <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
	<?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
	<?php } ?>
        <?php } else { ?>
         <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Main sidebar')){ }else { ?>
        	<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'theme'); ?></p>
         <?php } ?>
    <?php } ?>
    </aside> <!--End Sidebar-->
    </div> <!--End Container-->
 <?php get_footer(); ?>