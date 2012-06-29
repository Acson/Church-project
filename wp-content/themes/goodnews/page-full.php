<?php
/*
    Template Name: Full Width Page
*/
?>
<?php get_header(); ?>
<div class="inner">
    <div class="container">
 <?php the_breadcrumb(); ?>
    <div class="box_outer">
    <article class="cat_article">
	        <h1 class="cat_article_title page_title"><?php the_title(); ?></h1>
    <div class="single_article_content">
        <?php the_content(); ?>
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
    </div>
    </div> <!--End Container-->
 <?php get_footer(); ?>