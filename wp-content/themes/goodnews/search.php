<?php get_header(); ?>
<div class="inner">
    <div class="container">
    <div class="main">
<?php if ( have_posts() ) : ?>
         <div id="crumbs"><?php _e('Search results for', 'theme'); ?> "<?php echo $s; ?>" </div>
<?php while ( have_posts() ) : the_post(); ?>
 <?php cat_article(); ?>
<?php endwhile; ?>
<?php  else:  ?>
         <div id="crumbs"><?php _e('Your search for', 'theme'); ?> "<?php echo $s; ?>" <?php _e('did not match', 'theme'); ?></div>
	     <div class="box_outer">
	<article class="cat_article">
       <h1 class="cat_article_title page_title"><?php _e('A few suggestions', 'theme'); ?></h1>
    <div class="single_article_content">
	    <ul>
		<li><?php _e('Make sure all words are spelled correctly', 'theme'); ?></li>
		<li><?php _e('Try different keywords' , 'theme'); ?></li>
		<li><?php _e('Try more general keywords', 'theme'); ?></li>
	    </ul>
    </div> <!--Single Article content-->
    </article> <!--End Single Article-->
    </div> <!--Box Outer-->

<?php  endif; ?>
<?php mom_pagination(); ?>
<?php wp_reset_query(); ?>
    </div> <!--End Main-->
    <?php get_sidebar(); ?>
    </div> <!--End Container-->
 <?php get_footer(); ?>