<?php get_header(); ?>
<div class="inner">
    <div class="container">
    <?php if(of_get_option('feature_style') == 'full') { ?>
    <?php include TEMPLATEPATH . '/feature-full.php'; ?>
    <?php } ?>
    <div class="main">
    <?php if(of_get_option('feature_style') == 'default') { ?>
    <?php include TEMPLATEPATH . '/feature.php'; ?>
    <?php } ?>
    <?php include TEMPLATEPATH . '/latest-video.php'; ?>
    
    <?php if (of_get_option('theme_home') == 'blog') { ?>
        <?php query_posts(array('showposts' => get_option('posts_per_page'), 'paged' => $paged)); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php cat_article(); ?>
<?php endwhile; ?>
<?php  else:  ?>
<!-- Else in here -->
<?php  endif; ?>
<?php mom_pagination(); ?>
<?php wp_reset_query(); ?>
    <?php } else { ?>
    <?php include TEMPLATEPATH . '/news_boxes.php'; ?>
    <?php } ?>
    </div> <!--End Main-->
    <?php get_sidebar(); ?>
    </div> <!--End Container-->
 <?php get_footer(); ?>