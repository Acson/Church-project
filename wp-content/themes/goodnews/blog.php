<?php
/*
 Template Name: Blog
*/
?>
<?php get_header(); ?>
<div class="inner">
    <div class="container">
    <div class="main">
<?php include TEMPLATEPATH . '/feature.php'; ?>
<?php include TEMPLATEPATH . '/latest-video.php'; ?>
<?php query_posts(array('showposts' => get_option('posts_per_page'), 'paged' => $paged)); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php cat_article(); ?>
<?php endwhile; ?>
<?php  else:  ?>
<!-- Else in here -->
<?php  endif; ?>
<?php mom_pagination(); ?>
<?php wp_reset_query(); ?>
    </div> <!--End Main-->
    <?php get_sidebar(); ?>
    </div> <!--End Container-->
 <?php get_footer(); ?>