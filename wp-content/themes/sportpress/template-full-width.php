<?php
/*
Template Name: Full Width
*/
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
 

<?php get_header(); ?>

<div id="frame">  

<div id="layout">
<div class="wrapper" id="wrapperMain">

  <div id="content" class="full-width">

	<div id="main">  

		<?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="metadata">
 			<div class="metainfo">
			
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				
				<div class="meta">
					<span><?php edit_post_link( __('Edit', 'wpzoom'), '', ''); ?></span>
 				</div>
			</div>
		</div><!-- end .metadata -->

		<div class="entry">
		
			<?php if (strlen($wpzoom_ad_content_imgpath) > 1 && $wpzoom_ad_content_select == 'Yes' && $wpzoom_ad_content_pos == 'Before') { echo '<div class="banner">'.stripslashes($wpzoom_ad_content_imgpath)."</div>"; }?>
		
			<?php the_content(); ?>
		
			<?php wp_link_pages(array('before' => '<p class="pages"><strong>'.__('Pages', 'wpzoom').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
 			<div class="cleaner">&nbsp;</div>
			
			<?php if (strlen($wpzoom_ad_content_imgpath) > 1 && $wpzoom_ad_content_select == 'Yes' && $wpzoom_ad_content_pos == 'After') { echo '<div class="banner">'.stripslashes($wpzoom_ad_content_imgpath)."</div>"; }?>

		</div><!-- end .entry -->
		
 		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria', 'wpzoom');?>.</p>
		<?php endif; ?>

		<div class="cleaner">&nbsp;</div>          
          
	</div><!-- end #main -->
 
	<div class="cleaner">&nbsp;</div>
</div><!-- end #content -->

</div><!-- end .wrapper -->
</div><!-- end #layout -->

<?php get_footer(); ?>